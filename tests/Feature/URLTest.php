<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class URLTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
	
    public function testHome()
    {
        $response = $this->get('/home/');

        $response->assertStatus(200);
    }
}
