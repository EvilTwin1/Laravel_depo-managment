<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Car;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Car::class, function (Faker $faker) {
    return [
        //
        'number' => $faker->randomNumber($nbDigits = NULL, $strict = false),
        'driver_name' => $faker->name,
    ];
});
