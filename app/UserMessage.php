<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{

    protected $table = "user_messages";

    public function message() {
        return $this->hasMany(Message::class);
    }

    public function message_group() {
        return $this->belongsTo(MessageGroup::class);
    }
}
