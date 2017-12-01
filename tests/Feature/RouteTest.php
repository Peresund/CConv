<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use App\Models\CurrencyConverter\Currency;

class RouteTest extends TestCase
{

	public function testGET_Index_StatusOK()
	{
		$response = $this->get('/');

		$response->assertStatus(Response::HTTP_OK);
	}

	public function testGET_Index_ReturnsHomeIndex()
	{
		$response = $this->get('/');

		$response->assertViewIs("home.index");
	}

	public function testGET_GetCurrencies_IfTableEmpty_StatusOK()
	{
		Currency::truncate();

		$response = $this->get('/getCurrencies');

		$response->assertStatus(Response::HTTP_OK);
	}

	public function testGET_GetCurrencies_IfTablePopulated_StatusOK()
	{
		$seeder = new \DatabaseSeeder;
		$seeder->run();

		$response = $this->get('/getCurrencies');

		$response->assertStatus(Response::HTTP_OK);
	}

	public function testPOST_UpdateCurrencies_IfJsonEmpty_ReturnsInternalError()
	{
		$updateData = [];

		$response = $this->json('POST', '/updateCurrencies', $updateData);

		$response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
	}

	public function testPOST_UpdateCurrencies_IfJsonPopulated_Redirects()
	{
		$updateData = [
			'rates' => ['AAA' => '0.1', 'BBB' => '0.2'],
			'names' => ['AAA' => 'AAA Currency', 'BBB' => 'BBB Currency']
		];

		$response = $this->json('POST', '/updateCurrencies', $updateData);

		$response->assertRedirect('/getCurrencies');
	}

	public function testPOST_ClearCurrencies_IfTableEmpty_Redirects()
	{
		Currency::truncate();

		$response = $this->json('POST', '/clearCurrencies');

		$response->assertRedirect('/getCurrencies');
	}

	public function testPOST_ClearCurrencies_IfTablePopulated_Redirects()
	{
		$seeder = new \DatabaseSeeder;
		$seeder->run();

		$response = $this->json('POST', '/clearCurrencies');

		$response->assertRedirect('/getCurrencies');
	}

}
