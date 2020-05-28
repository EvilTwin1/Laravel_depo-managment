<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Autopark;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Autopark::class, function (Faker $faker) {
    return [
        //
        'name' => 'Autopark -' . ' ' . '"' . $faker->word . '"',
        'address' => $faker->streetAddress,
        'work_time' => '09:00-18:00',
    ];
});

