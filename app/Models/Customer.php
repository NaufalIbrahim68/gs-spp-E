<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone_number',
        'address',
        'district_id',
        'status',
        'date_of_birth',
        'gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
