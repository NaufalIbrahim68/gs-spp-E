<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function return()
    {
        return $this->hasOne(OrderReturn::class);
    }


    public function getStatusLabelAttribute()
    {
        if ($this->status == 0 || $this->status == 1) {
            return '<span class="badge badge-secondary">Pending</span>';
        } elseif ($this->status == 2) {
            return '<span class="badge badge-info">Packed</span>';
        } elseif ($this->status == 3) {
            $shippingLabel = ucfirst(str_replace('_', ' ', $this->shipping_status));
            $badgeClass = 'badge-warning';
            if ($this->shipping_status == 'delivered') {
                $badgeClass = 'badge-success';
            }
            return '<span class="badge ' . $badgeClass . '">' . $shippingLabel . '</span>';
        }
        return '<span class="badge badge-success">Delivered</span>';
    }
}
