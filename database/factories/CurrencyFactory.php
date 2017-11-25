<?php

use Faker\Generator as Faker;
use App\Models\CurrencyConverter\Currency;

$factory->define(Currency::class, function (Faker $faker) {
	
    return [
		'iso_4217' => str_random(3),
        'name' => str_random(256),
		'date_created' => $faker->dateTime,
		'date_modified' => $faker->dateTime,
		'rate' => (mt_rand(1, mt_getrandmax()) / 1000000000.0),
    ];
});