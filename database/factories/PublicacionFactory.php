<?php

use Faker\Generator as Faker;
use Carbon\Carbon;


$factory->define(App\Models\Publicacion::class, function (Faker $faker) {
    return [
        'PUBL_TITULO'       => mb_strtoupper($faker->text($maxNbChars = 50)),
        'PUBL_DESCRIPCION'  => mb_strtoupper($faker->text($maxNbChars = 300)),
        'PUBL_LATITUD'      => $faker->randomFloat($nbMaxDecimals = 6, $min = -90, $max = 90) ,
        'PUBL_LONGITUD'     => $faker->randomFloat($nbMaxDecimals = 6, $min = -180, $max = 180) ,
        'PUBL_CREADOPOR'    => 'TEST',
    ];
});

