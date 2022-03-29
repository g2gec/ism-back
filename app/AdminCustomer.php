<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminCustomer extends Model
{
    protected $fillable = [
        'customer_type',
        'membership_id',
        'seller_id',
        'membership_number',
        'document',
        'duration',
        'cost',
        'name',
        'surname',
        'email',
        'phone',
        'country',
        'city',
        'type_accommodation',
        'accommodation_name',
        'accommodation_address',
        'filename',
        'status'
    ];

    /**
     * Get the user that owns the AdminCustomer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    /**
     * Get the user that owns the AdminCustomer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
