<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = [
        'type_seller',
        'name',
        'surname',
        'address',
        'document',
        'phone',
        'email',
        'discount',
        'advisor_permit'
    ];

    /**
     * Get all of the comments for the Seller
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customer()
    {
        return $this->hasMany(AdminCustomer::class, 'seller_id');
    }
}
