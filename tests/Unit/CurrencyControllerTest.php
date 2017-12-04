<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\CurrencyConverter\Currency;
use Faker\Generator;
use \CurrencyTableSeeder;

class CurrencyControllerTest extends TestCase
{

	private $N_CURRENCIES = 10;

//	fwrite(STDERR, print_r($json, TRUE));

	public function testGET_GetCurrencies_IfTableEmpty_ReturnsEmpty()
	{
		Currency::truncate();

		$response = $this->get('/getCurrencies');

		$response->assertJsonCount(0);
	}

	public function testGET_GetCurrencies_IfTablePopulated_ReturnsPopulated()
	{
		Currency::truncate();
		$seeder = new CurrencyTableSeeder;
		$seeder->run();

		$response = $this->json('GET', '/getCurrencies');

		$response->assertJsonCount(Currency::count());
	}

	public function testGET_GetCurrencies_IfTablePopulated_ReturnsStructured()
	{
		Currency::truncate();
		$seeder = new CurrencyTableSeeder;
		$seeder->run();

		$response = $this->json('GET', '/getCurrencies');

		$response->assertJsonStructure([
			Currency::STRUCTURE
		]);
	}

//	public function testPOST_UpdateCurrencies_IfTableEmpty_UpdatesTable()
//	{
//		Currency::truncate();
//		(new Generator)->seed(0);
//		$currencyFactory = factory(Currency::class, $this->N_CURRENCIES);
//		$currencies = $currencyFactory->make();
//
//		foreach ($currencies as $value)
//		{
//			$updateData['rates'][$value->iso_4217] = $value->rate;
//			$updateData['names'][$value->iso_4217] = $value->name;
//		}
//
//		$this->json('POST', '/updateCurrencies', $updateData);
//
//		foreach ($currencies as $value)
//		{
//			$this->assertDatabaseHas('currencies', [
//				'iso_4217' => $value->iso_4217,
//				'name' => $value->name,
//				'rate' => $value->rate
//			]);
//		}
//	}
//
//	public function testPOST_UpdateCurrencies_IfTablePopulated_UpdatesTable()
//	{
//		Currency::truncate();
//		$seeder = new CurrencyTableSeeder;
//		$seeder->run();
//		(new Generator)->seed(1);
//		$currencyFactory = factory(Currency::class, $this->N_CURRENCIES);
//		$currencies = $currencyFactory->make();
//
//		foreach ($currencies as $value)
//		{
//			$updateData['rates'][$value->iso_4217] = $value->rate;
//			$updateData['names'][$value->iso_4217] = $value->name;
//		}
//
//		$this->json('POST', '/updateCurrencies', $updateData);
//
//		foreach ($currencies as $value)
//		{
//			$this->assertDatabaseHas('currencies', [
//				'iso_4217' => $value->iso_4217,
//				'name' => $value->name,
//				'rate' => $value->rate
//			]);
//		}
//	}

//	public function testPOST_ClearCurrencies_IfTablePopulated_ClearsTable()
//	{
//		Currency::truncate();
//		$seeder = new CurrencyTableSeeder;
//		$seeder->size = $this->N_CURRENCIES;
//		$seeder->run();
//
//		$this->json('POST', '/clearCurrencies');
//
//		for ($index = 0; $index < $this->N_CURRENCIES; $index++)
//		{
//			$this->assertDatabaseMissing('currencies', [
//				'id' => $index
//			]);
//		}
//	}

}
