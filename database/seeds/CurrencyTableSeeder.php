<?php

use Illuminate\Database\Seeder;
use App\Models\CurrencyConverter\Currency;
use Faker\Generator;

class CurrencyTableSeeder extends Seeder
{
	public $size = 20;
	
    /**
     * Run the table seed.
     *
     * @return void
     */
    public function run()
    {
		Currency::truncate();
		
		(new Generator)->seed(0);
		$currencyFactory = factory(Currency::class, $this->size);
		$currencyFactory->create();
    }
}
