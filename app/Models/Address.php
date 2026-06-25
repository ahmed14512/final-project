<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
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
    ];

    public function user(){
    return $this->belongsTo(User::class);
    }
}


