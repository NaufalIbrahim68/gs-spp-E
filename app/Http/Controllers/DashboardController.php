<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $orders = Order::where('customer_id', auth()->user()->customer->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);


        return view('customer.dashboard', compact('orders'));
    }
}
