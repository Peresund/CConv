<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
}
