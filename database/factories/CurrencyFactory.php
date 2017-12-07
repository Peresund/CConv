<?php

namespace App\Database\Factories;

use Faker\Generator as Faker;
use App\Models\CurrencyConverter\Currency;
use Carbon\Carbon;

$factory->define(Currency::class, function (Faker $faker) {
	static $nextRow = 0;
	
	$year = 2015;
	$month = rand(1, 12);
	$day = rand(1, 28);

	$date = Carbon::create($year,$month ,$day , 0, 0, 0);
	
    return [
		'iso_4217' => Currency::generateCurrencyCode($nextRow++),
        'name' => str_random(mt_rand(1, 30)),
		'rate' => (mt_rand(1, mt_getrandmax()) / (mt_getrandmax()/5)),
		'date_created' => $date
    ];
});