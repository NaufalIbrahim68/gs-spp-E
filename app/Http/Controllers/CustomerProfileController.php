<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerProfileUpdateRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Models\Customer;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerProfileController extends Controller
{
    /**
     * Display customer profile page
     */
    public function profile()
    {
        $customer = auth()->user()->customer;
        $districts = District::with(['city.province'])->get();
        
        return view('customer.profile', compact('customer', 'districts'));
    }

    /**
     * Display customer settings page
     */
    public function settings()
    {
        $customer = auth()->user()->customer;
        
        return view('customer.settings', compact('customer'));
    }

    /**
     * Update customer profile
     */
    public function updateProfile(CustomerProfileUpdateRequest $request)
    {
        try {
            $customer = auth()->user()->customer;
            
            $data = $request->validated();
            
            $customer->update($data);
            
            return redirect()->route('customer.profile')
                ->with('success', 'Profil berhasil diperbarui!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui profil: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update customer password
     */
    public function updatePassword(PasswordUpdateRequest $request)
    {
        try {
            $user = auth()->user();
            
            // Update password
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            
            return redirect()->route('customer.settings')
                ->with('success', 'Password berhasil diperbarui!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui password: ' . $e->getMessage());
        }
    }
}
