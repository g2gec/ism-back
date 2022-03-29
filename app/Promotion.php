<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'title',
        'from',
        'to',
        'description',
        'term_conditions',
        'valid_for',
        'total_cost',
        'url_file'
    ];

    /**
     * Get all of the comments for the Promotion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servicePromotions()
    {
        return $this->hasMany(ServicePromotion::class);
    }
}
