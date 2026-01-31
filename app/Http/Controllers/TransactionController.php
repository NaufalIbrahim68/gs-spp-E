<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Customer;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function getCarts()
    {
        $carts = json_decode(request()->cookie('gold-carts'), true);
        $carts = $carts != '' ? $carts : [];

        return $carts;
    }

    public function getSubtotal()
    {
        $carts = $this->getCarts();
        $subtotal = collect($carts)->sum(function ($i) {
            return $i['product_price'] * $i['qty'];
        });

        return $subtotal;
    }

    public function addToCart(Request $req)
    {
        $req->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer',
        ]);

        $carts = $this->getCarts();

        if ($carts && array_key_exists($req->product_id, $carts)) {
            $carts[$req->product_id]['qty'] += $req->qty;
        } else {
            $product = Product::find($req->product_id);
            $carts[$product->id] = [
                'qty' => $req->qty,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_slug' => $product->slug,
                'product_price' => $product->price,
                'product_image' => $product->image,
            ];
        }

        $cookie = cookie('gold-carts', json_encode($carts), 2880);

        return back()->cookie($cookie)->with('success', 'Berhasil menambah produk ke keranjang');
    }

    public function listCart()
    {
        $carts = $this->getCarts();
        $subtotal = $this->getSubtotal();

        return view('front.list_cart', compact('carts', 'subtotal'));
    }

    public function updateCart(Request $req)
    {
        $carts = $this->getCarts();

        foreach ($req->product_id as $key => $value) {
            if ($req->qty[$key] == 0) {
                unset($carts[$value]);
            } else {
                $carts[$value]['qty'] = $req->qty[$key];
            }
        }

        $cookie = cookie('gold-carts', json_encode($carts), 2880);

        return back()->cookie($cookie)->with('success', 'Berhasil Memperbarui Keranjang ');
    }

    public function deleteCart($id)
    {
        $carts = $this->getCarts();

        if (Product::where('id', $id)->exists() && $carts != null) {
            unset($carts[$id]);
            $cookie = cookie('gold-carts', json_encode($carts), 2880);
            return back()->cookie($cookie)->with('success', 'Berhasil Memperbarui Keranjang ');
        }

        return back();
    }


    public function checkout()
    {
        $carts = $this->getCarts();

        if (auth()->check() && $carts != null) {
            // SIMULATION: Restrict to Jawa Tengah
            $provinces = Province::where('name', 'LIKE', '%Jawa Tengah%')->get();
            $carts = $this->getCarts();
            $subtotal = $this->getSubtotal();

            return view('front.checkout', compact('provinces', 'carts', 'subtotal'));
        }

        return $carts == null ? back()->with('error', 'Keranjang Anda Masih Kosong') : back()->with('error', 'Silahkan Login Terlebih Dahulu');
    }
    public function getCity()
    {
        // SIMULATION: Restrict to specific cities in Jawa Tengah
        $city = City::where('province_id', request()->province_id)
            ->where(function ($q) {
                $q->where('name', 'LIKE', '%Cilacap%')
                  ->orWhere('name', 'LIKE', '%Banyumas%') // Purwokerto usually under Banyumas
                  ->orWhere('name', 'LIKE', '%Purbalingga%');
            })
            ->orderBy('type', 'ASC')
            ->get();
        return response()->json(['status' => 'success', 'data' => $city]);
    }
    public function getDistrict()
    {
        $district = District::where('city_id', request()->city_id)->orderBy('name', 'ASC')->get();
        return response()->json(['status' => 'success', 'data' => $district]);
    }

    public function prosesCheckout(Request $req)
    {
        $req->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:15',
            'email' => 'required|email',
            'customer_address' => 'required|string',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'shipping_method' => 'required|in:regular,express',
        ]);


        DB::beginTransaction();
        try {
            if (!auth()->check()) {
                return back()->with('error', 'Silahkan Login Terlebih dahulu');
            }

            $carts = $this->getCarts();
            $subtotal = $this->getSubtotal();

            // Calculate Shipping Cost
            $city = City::find($req->city_id);
            $cityName = strtolower($city->name);
            $shippingCost = 0;

            if (str_contains($cityName, 'cilacap')) {
                $shippingCost = $req->shipping_method == 'express' ? 20000 : 10000;
            } elseif (str_contains($cityName, 'purwokerto') || str_contains($cityName, 'banyumas')) {
                 // Purwokerto is often under Banyumas, enabling both just in case
                $shippingCost = $req->shipping_method == 'express' ? 30000 : 20000;
            } elseif (str_contains($cityName, 'purbalingga')) {
                $shippingCost = $req->shipping_method == 'express' ? 40000 : 30000;
            } else {
                // Default fallback if simulation city not matched (optional)
                $shippingCost = $req->shipping_method == 'express' ? 50000 : 25000;
            }

            $customer = Customer::find(auth()->user()->customer->id);

            if ($customer->status == false) {
                $customer->update([
                    'address' => $req->customer_address,
                    'district_id' => $req->district_id,
                    'status' => true,
                ]);
            }

            $order = Order::create([
                'invoice' => Str::random(4) . '-' . time(),
                'customer_id' => $customer->id,
                'customer_name' => $req->customer_name,
                'customer_phone' => $req->customer_phone,
                'customer_address' => $req->customer_address,
                'district_id' => $req->district_id,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'shipping_method' => $req->shipping_method,
                'shipping_status' => 'pending',
            ]);

            foreach ($carts as $item) {
                $product = Product::find($item['product_id']);
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'price' => $item['product_price'],
                    'qty' => $item['qty'],
                    'weight' => $product->weight,
                ]);
            }

            DB::commit();

            $carts = [];
            $cookie = cookie('gold-carts', json_encode($carts), 2880);

            return redirect(route('front.finish_checkout', $order->invoice))->cookie($cookie);
        } catch (\Exception $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

    public function checkoutFinish($invoice)
    {
        $order = Order::with(['orderDetail.product'])
            ->where('invoice', $invoice)
            ->first();

        if ($order) {
            // IDOR Protection: Ensure only the owner can see the success page
            if (auth()->check() && $order->customer_id !== auth()->user()->customer->id) {
                return redirect()->route('front.index')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }

            return view('front.checkout_finish', compact('order'));
        }

        return redirect()->route('front.index')->with('error', 'Invoice tidak ditemukan.');
    }
}
