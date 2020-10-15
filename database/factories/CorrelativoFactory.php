<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Correlativo as Correlativo;
use Faker\Generator as Faker;

$factory->define(Correlativo::class, function (Faker $faker) {
    $beneficiarios = App\Beneficiario::pluck('id')->toArray();
    return [
        'municipio_id' => $faker->numberBetween(1, App\Municipio::count()),
        'n_partida' => $faker->randomNumber($nbDigits = 3, $strict = false).'-'.$faker->randomNumber($nbDigits = 2, $strict = false).'-'.$faker->randomNumber($nbDigits = 2, $strict = false).'-'.$faker->randomNumber($nbDigits = 2, $strict = false),
        'proyecto' => 'ZONA',
        'beneficiario_id' => $faker->randomElement($beneficiarios),
        'orden_compra' => $faker->numberBetween($min = 0, $max = 999)
        
    ];
});
