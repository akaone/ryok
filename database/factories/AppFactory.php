<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\App;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'platform' => $faker->randomElement(['ANDROID', 'IOS', 'WEB', 'HYBRIDE']),
        'state' => $faker->randomElement(['PENDING', 'ACTIVATED', 'DEACTIVATED']),
    ];
});


$factory->state(App::class, 'MOBILE', function (Faker $faker) {
    return [
        'name' => $faker->name,
        'platform' => $faker->randomElement(['ANDROID', 'IOS']),
        'state' => $faker->randomElement(['PENDING', 'ACTIVATED', 'DEACTIVATED']),
        'package_name' => Str::random(36),
    ];
});