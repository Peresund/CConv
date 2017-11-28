<?php

use Illuminate\Database\Seeder;
use App\Models\CurrencyConverter\Currency;
use Faker\Generator;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Currency::truncate();
		
		(new Generator)->seed(0);
		factory(Currency::class, 10)->create();
    }
}
