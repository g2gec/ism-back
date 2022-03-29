<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {

    return [
        'chat_messages_id' => $faker->word,
        'attachments' => $faker->word,
        'body' => $faker->text,
        'contentType' => $faker->word,
        'createdAt' => $faker->date('Y-m-d H:i:s'),
        'senderId' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
