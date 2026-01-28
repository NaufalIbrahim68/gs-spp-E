<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use PDF;
class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer.district.city.province'])->orderBy('created_at', 'DESC');

        if (request()->q != '') {
            $orders = $orders->where(function ($q) {
                $q->where('customer_name', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('invoice', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('customer_address', 'LIKE', '%' . request()->q . '%');
            });
        }

        if (request()->status != '') {
            $orders = $orders->where('status', 'LIKE', '%' . request()->status . '%');
        }

        $orders = $orders->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function detail($invoice)
    {
        $order = Order::with(['customer.district.city.province', 'payment', 'orderDetail.product'])
            ->where('invoice', $invoice)
            ->first();

        return view('admin.orders.detail', compact('order'));
    }

    public function acceptPayment($id)
    {
        $order = Order::with(['payment'])
            ->where('id', $id)
            ->first();
        $order->payment()->update(['status' => 1]);
        $order->update(['status' => 2]);

        return redirect(route('admin.orders.detail', $order->invoice))->with('success', 'Berhasil Menerima Pesanan');
    }

    public function shippingOrder(Request $req)
    {
        $req->validate([
            'tracking_number' => 'required',
        ]);

        $order = Order::with(['customer'])->find($req->order_id);

        $order->update([
            'tracking_number' => $req->tracking_number,
            'status' => 3,
        ]);

        return back()->with('success', 'Berhasil mengirim resi');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->orderDetail()->delete();
        $order->payment()->delete();
        $order->delete();

        return back()->with('success', 'Data Berhasil dihapus');
    }

    public function return($invoice)
    {
        $order = Order::with(['customer'])
            ->where('invoice', $invoice)
            ->first();

        return view('admin.orders.return', compact('order'));
    }

    public function approveReturn(Request $req)
    {
        $req->validate([
            'status' => 'required',
        ]);

        $order = Order::find($req->order_id);

        $order->return()->update([
            'status' => $req->status,
        ]);
        $order->update(['status' => 4]);

        return back()->with('success', 'Berhasil');
    }

    public function print($invoice)
    {
        $order = Order::with(['customer.district.city.province', 'payment', 'orderDetail.product'])
            ->where('invoice', $invoice)
            ->first();

        $pdf = PDF::loadView('admin.orders.print', compact('order'));

        return $pdf->stream();
    }
}
