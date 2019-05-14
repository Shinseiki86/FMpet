<?php

use Faker\Generator as Faker;
use Carbon\Carbon;


$factory->define(App\Models\Persona::class, function (Faker $faker) {
    return [
        'PERS_NUMEROIDENTIFICACION' => $faker->unique()->ean8,
        'PERS_NOMBRE'               => $faker->firstName,
        'PERS_APELLIDO'             => $faker->lastName,
        'PERS_TELEFONO'             => $faker->numberBetween($min = 3100000000, $max = 3209999999) ,
        'PERS_DIRECCION'            => $faker->address,
        'PERS_CORREO'               => $faker->unique()->safeEmail,
        'PERS_CREADOPOR'            => 'TEST',
    ];
});


$factory->define(App\Models\Mascota::class, function (Faker $faker) {
    return [
        'MASC_NOMBRE'    => $faker->word,
        'MASC_EDAD'      => $faker->numberBetween($min = 0, $max = 255) ,
        'MASC_CREADOPOR' => 'TEST',
    ];
});
