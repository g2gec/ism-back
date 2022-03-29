<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'name',
        'expiration_date',
        'price',
        'motor',
        'discount',
        'file'
    ];

    /**
     * Get all of the comments for the Membership
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adminCustomers()
    {
        return $this->hasMany(AdminCustomer::class);
    }
}
