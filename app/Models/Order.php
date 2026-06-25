<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'city',
        'zip_code',
        'street_address',
        'subtotal',
        'shipping',
        'total',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

     public function getOrderNumberAttribute()
    {
        return str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }
}

 
