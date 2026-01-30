<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use PDF;
class DashboardController extends Controller{
    public function index(){
        $product = Product::count();
        $order = Order::where('status', 2)->count();
        $income = Order::where('status', 4)->sum('subtotal');
        $date = Carbon::now()->subDays(7);
        $customer = User::where('created_at', '>=', $date)->count();
        
        // Additional statistics
        $totalCustomers = User::where('role', 'customer')->count();
        $pendingPayments = Order::where('status', 1)->count();
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 4)->count();
        
        // Recent orders
        $recentOrders = Order::with(['customer'])
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();
        
        // Monthly revenue for chart (last 6 months)
        $monthlyRevenue = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $revenue = Order::where('status', 4)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('subtotal');
            $monthlyRevenue[] = [
                'month' => $month->format('M'),
                'revenue' => $revenue
            ];
        }

        return view('admin.dashboard', compact(
            'product', 
            'order', 
            'income', 
            'date', 
            'customer',
            'totalCustomers',
            'pendingPayments',
            'totalOrders',
            'completedOrders',
            'recentOrders',
            'monthlyRevenue'
        ));
    }

    public function orderReport(){
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode('-', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $orders = Order::with('customer.district')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        return view('admin.report.order', compact('orders'));
    }

    public function orderReportPdf($dateRange){
        $date = explode('+', $dateRange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $order = Order::with(['customer.district'])
            ->whereBetween('created_at', [$start, $end])
            ->get();
        $pdf = PDF::loadView('admin.report.order_pdf', compact('order', 'date'));

        return $pdf->stream();
    }
}
