<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('user')
            ->whereHas('user', function($query) {
                $query->where('role', 'customer');
            })
            ->withCount('orders')
            ->paginate(10);

        return view('admin.customer', compact('customers'));
    }

    public function destroy($id)
    {
        $customer = Customer::with(['user'])->where('id', $id)->first();
        $customer->user()->delete();
        $customer->delete();

        return back()->with('success', 'Berhasil Menghapus Data');
    }
}
