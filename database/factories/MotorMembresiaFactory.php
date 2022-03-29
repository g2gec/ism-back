<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MotorMembresia;
use Faker\Generator as Faker;

$factory->define(MotorMembresia::class, function (Faker $faker) {

    return [
        'membresia_id' => $faker->randomDigitNotNull,
        'motor_membresia_id' => $faker->randomDigitNotNull,
        'descuento_motor_membresia' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
