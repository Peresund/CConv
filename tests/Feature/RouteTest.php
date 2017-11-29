<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\CurrencyConverter\Currency;

class RouteTest extends TestCase
{
    public function testIndexRouteOK()
    {
        $response = $this->get('/');

		$response->assertStatus(200);
    }
	
    public function testGetCurrenciesRouteOK()
    {
        $response = $this->get('/getCurrencies');

		$response->assertStatus(200);
    }
	
    public function testUpdateCurrenciesRouteRedirects()
    {
		$updateData = [
			'rates'	=> ['AAA' => '0.1', 'BBB' => '0.2'],
			'names' => ['AAA' => 'AAA Currency', 'BBB' => 'BBB Currency']
		];
		
		$response = $this->json('POST', '/updateCurrencies', $updateData);

        $response->assertRedirect('/getCurrencies');
    }
	
    public function testClearCurrenciesRouteRedirects()
    {
		$response = $this->json('POST', '/clearCurrencies');

        $response->assertRedirect('/getCurrencies');
    }
}
