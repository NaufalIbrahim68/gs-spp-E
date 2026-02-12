<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function detailOrder($invoice)
    {
        if (Order::where('invoice', $invoice)->exists()) {
            $order = Order::with(['district.city.province', 'orderDetail', 'orderDetail.product', 'payment'])
                ->where('invoice', $invoice)
                ->first();

            // IDOR Protection: Check if the order belongs to the authenticated user's customer record
            if ($order->customer_id != auth()->user()->customer->id) {
                return redirect()->route('customer.dashboard')->with('error', 'Anda tidak memiliki akses ke pesanan ini.');
            }

            return view('customer.detail', compact('order'));
        }

        return redirect()->route('customer.dashboard')->with('error', 'Pesanan tidak ditemukan.');
    }

    public function payment()
    {
        $cekInvoice = Order::where('invoice', request()->invoice)->exists();
        $cekUser = Order::where('invoice', '=', request()->invoice)
            ->where('customer_id', auth()->user()->customer->id)
            ->count();

        if ($cekInvoice != 0 && $cekUser != 0) {
            $order = Order::where('invoice', request()->invoice)->first();
            return view("customer.payment", compact('order'));
        }

        return back();
    }

    public function paymentStore(Request $req)
    {
        $req->validate([
            'invoice'       => 'required|exists:orders,invoice',
            'name'          => 'required|string',
            'transfer_to'   => 'required|string',
            'transfer_date' => 'required',
            'amount'        => 'required|integer',
            'proof'         => 'required|image|mimes:jpg,png,jpeg,webp,svg'
        ]);

        DB::beginTransaction();
        try {

            $order = Order::where('invoice', $req->invoice)->first();

            $totalAmount = $order->subtotal + $order->shipping_cost;

            if ($req->amount != $totalAmount) {
                return back()->with('error', 'Jumlah Transfer Kurang Dari Tagihan Pemesanan (Total: ' . number_format($totalAmount) . ')');
            }

            if ($order->status == 0 && $req->hasFile('proof')) {
                $file = $req->file('proof');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('asset/payment', $filename);


                Payment::create([
                    'order_id'      => $order->id,
                    'name'          => $req->name,
                    'transfer_to'   => $req->transfer_to,
                    'transfer_date' => Carbon::parse($req->transfer_date)->format('Y-m-d'),
                    'amount'        => $req->amount,
                    'proof'         => $filename,
                    'status'        => false,
                ]);

                $order->update(['status' => 1]);
                DB::commit();

                return redirect()->route('customer.dashboard')->with("success", "Pesanan Dikonfirmasi");
            }
        } catch (\Exception $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
        }
    }

    public function acceptOrder(Request $req)
    {
        $order = Order::find($req->order_id);
        if ($order->where("customer_id", auth()->user()->customer->id)->exists()) {
            $order->update(['status' => 4]);

            return back()->with('success', 'Pesanan Anda Selesai');
        }

        return back()->with('error', 'Bukan Pesanan Anda');
    }
}
