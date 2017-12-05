<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\CurrencyConverter\Currency;

class CurrencyController extends Controller
{

	public function getCurrencies()
	{
		$orderedCurrencies = Currency::getOrdered('iso_4217', Currency::ORDER_ASC);
		
		$response = response($orderedCurrencies, 200)
				->header('Content-Type',  'application/json; charset=UTF-8');
				
		return $response;
	}
	
    public function updateCurrencies()
    {
		Currency::updateAll();
		
		return CurrencyController::getCurrencies();
    }

	public function clearCurrencies()
	{
		Currency::truncate();
		
		return CurrencyController::getCurrencies();
	}
}
