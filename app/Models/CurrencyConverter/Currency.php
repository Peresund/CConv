<?php

namespace App\Models\CurrencyConverter;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	const ORDER_ASC = 'ASC';
	const ORDER_DESC = 'DESC';

	public $timestamps = false;
	
    protected $fillable = [
        'iso_4217', 'name', 'rate',
    ];
	
	public static function getOrdered($row, $order) {
		$currencies = Currency::orderBy($row, $order)->get();
		return $currencies->toJson();
	}
	
	public static function updateAll($rates, $names) {
		foreach($rates as $key => $value) {
			$currency = Currency::firstOrNew(array('iso_4217' => $key));
			$currency->name = $names[$key];
			$currency->rate = $value;
			$currency->save();
		}
	}
}
