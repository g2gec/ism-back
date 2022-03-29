<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Membresia;
use Faker\Generator as Faker;

$factory->define(Membresia::class, function (Faker $faker) {

    return [
        'diseno_tarjeta' => $faker->text,
        'nombre_membresia' => $faker->word,
        'fecha_fin_membresia' => $faker->word,
        'precio_membresia' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
