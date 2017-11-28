<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\CurrencyConverter\Currency;

class CurrencyController extends Controller
{

	public function clearCurrencies()
	{
		Currency::truncate();
		return redirect()->action(
			'Home\CurrencyController@getCurrencies'
		);
	}

	public function getCurrencies()
	{
		$orderedCurrencies = Currency::getOrdered('iso_4217', Currency::ORDER_ASC);
		
		$response = response($orderedCurrencies, 200)
				->header('Content-Type',  'application/json; charset=UTF-8');
				
		return $response;
	}
	
    public function updateCurrencies(Request $request)
    {
		$input = $request->input();
		$rates = $input['rates'];
		$names = $input['names'];
		
		Currency::updateAll($rates, $names);
		
		return redirect()->action(
			'Home\CurrencyController@getCurrencies'
		);
    }
}
