<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Color;
use Faker\Generator as Faker;

$factory->define(Color::class, function (Faker $faker) {

    $color = $faker->unique()->colorName;

    return [
        'name' => $color,
    ];
});
