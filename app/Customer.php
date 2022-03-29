<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'customer_type', // 1 -> Customers // 2 -> providers
        'first_name',
        'last_name',
        'country',
        'city',
        'phone',
        'email',
        'accommodation_name',
        'accommodation_address',
        'type_accommodation',
        'accommodation_name',
        'accommodation_address',
        'filename'
    ];
}
