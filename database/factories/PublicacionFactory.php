<?php

use Faker\Generator as Faker;
use Carbon\Carbon;


$factory->define(App\Models\Publicacion::class, function (Faker $faker) {
    return [
        'PUBL_TITULO'       => mb_strtoupper($faker->text($maxNbChars = 50)),
        'PUBL_DESCRIPCION'  => mb_strtoupper($faker->text($maxNbChars = 300)),
        'PUBL_LATITUD'      => $faker->randomFloat($nbMaxDecimals = 6, $min = -90, $max = 90) ,
        'PUBL_LONGITUD'     => $faker->randomFloat($nbMaxDecimals = 6, $min = -180, $max = 180) ,
        'PUBL_FECHACREADO'  => $faker->dateTimeBetween($startDate = '-3 weeks', $endDate = 'now'),
        'PUBL_CREADOPOR'    => 'TEST',
    ];
});


$factory->define(App\Models\Comentario::class, function (Faker $faker) {
    return [
        'COME_DESCRIPCION'  => mb_strtoupper($faker->text($maxNbChars = 300)),
        'COME_FECHACREADO'  => $faker->dateTimeBetween($startDate = '-1 days', $endDate = 'now'),
        'COME_CREADOPOR'    => 'TEST',
    ];
});

