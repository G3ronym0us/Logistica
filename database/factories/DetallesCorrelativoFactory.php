<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DetallesCorrelativo;
use Faker\Generator as Faker;

$factory->define(DetallesCorrelativo::class, function (Faker $faker) {
    return [
        'correlativo_id' => $faker->numberBetween(1, App\Correlativo::count()),
        'catalogo_id' => $faker->numberBetween(1, App\Correlativo::count()),
        'cantidad' => $faker->numberBetween($min = 0, $max = 99),
        'subtotal' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000)
    ];
});
