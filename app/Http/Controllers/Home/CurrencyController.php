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
		$currencies = Currency::orderBy('iso_4217', 'ASC')->get();
		return $currencies->toJson();
	}
	
    public function updateCurrencies(Request $request)
    {
		$input = $request->input();
		$rates = $input['rates'];
		$names = $input['names'];
		
		foreach($rates as $key => $value) {
			$currency = Currency::firstOrNew(array('iso_4217' => $key));
			$currency->name = $names[$key];
			$currency->rate = $value;
			$currency->save();
		}
		
		return redirect()->action(
			'Home\CurrencyController@getCurrencies'
		);
    }
}
