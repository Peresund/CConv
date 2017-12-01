<?php

namespace App\Models\CurrencyConverter;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	
	const STRUCTURE = [
				'id',
				'iso_4217',
				'name',
				'date_created',
				'date_modified',
				'rate'
	];
	
	const ORDER_ASC = 'ASC';
	const ORDER_DESC = 'DESC';
	
	const ISO_4217_LENGTH = 3;
	const NAME_LENGTH = 255;
	const ALPHABET_SIZE = 26;
	const MAX_CURRENCY_CODES = Currency::ALPHABET_SIZE*Currency::ALPHABET_SIZE*Currency::ALPHABET_SIZE;

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
			$currency = Currency::firstOrNew(['iso_4217' => $key]);
			$currency->name = $names[$key];
			$currency->rate = $value;
			$currency->save();
		}
	}
	
	private static function intToLetter($integer) {
		return chr($integer+65);
	}
	
	public static function createCurrencyCode($fromInteger) {
		$currencyCode = "";
		
		for ($position = 0; $position < Currency::ISO_4217_LENGTH; $position++) {
			$remainder = $fromInteger % Currency::ALPHABET_SIZE;
			$fromInteger = floor($fromInteger / Currency::ALPHABET_SIZE);
			$currencyCode = Currency::intToLetter($remainder) . $currencyCode;
		}
		
		return $currencyCode;
	}
}
