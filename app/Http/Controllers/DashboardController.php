<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $customerId = auth()->user()->customer->id;
        
        $orders = Order::where('customer_id', $customerId)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        // Calculate statistics
        $totalOrders = Order::where('customer_id', $customerId)->count();
        
        $totalSpending = Order::where('customer_id', $customerId)
            ->where('status', 4) // Only completed orders
            ->sum('subtotal');
        
        $pendingOrders = Order::where('customer_id', $customerId)
            ->where('status', 0)
            ->count();
        
        $processingOrders = Order::where('customer_id', $customerId)
            ->whereIn('status', [1, 2, 3])
            ->count();
        
        $completedOrders = Order::where('customer_id', $customerId)
            ->where('status', 4)
            ->count();

        return view('customer.dashboard', compact(
            'orders',
            'totalOrders',
            'totalSpending',
            'pendingOrders',
            'processingOrders',
            'completedOrders'
        ));
    }
}
