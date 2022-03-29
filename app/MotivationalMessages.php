<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivationalMessages extends Model
{
    protected $table = "motivational_messages";
    protected $fillable = [
        'user_id',
        'message',
        'status',
        'url_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
