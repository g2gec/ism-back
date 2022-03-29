<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicePromotion extends Model
{
    protected $fillable = [
        'promotion_id',
        'service',
        'service_discount',
        'fixed_value'
    ];

    /**
     * Get the user that owns the Promotion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
