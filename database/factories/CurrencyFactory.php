<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    static $rate;

    return [
		'iso_4217' => $faker->unique()->currencyCode,
        'name' => $faker->name,
		'date_created' => $faker->dateTime,
		'date_modified' => $faker->dateTime,
		'rate' => $rate ?: $rate = (mt_rand(1, mt_getrandmax()) / 100000000.0),
    ];
});
