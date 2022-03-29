<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ParticipantMessage;
use Faker\Generator as Faker;

$factory->define(ParticipantMessage::class, function (Faker $faker) {

    return [
        'chat_messages_id' => $faker->word,
        'participants_id' => $faker->word,
        'avatar' => $faker->word,
        'name' => $faker->word,
        'username' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
