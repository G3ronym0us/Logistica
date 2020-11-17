<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Catalogo;
use Faker\Generator as Faker;

$factory->define(Catalogo::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'unidad_medida' => $faker->randomElement($array = array ('UNIDAD','RESMA','DOCENA')),
        'valor' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10)
    ];
});
