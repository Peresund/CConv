<?php

namespace App\Models\CurrencyConverter;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	
	/*
	 * Model database structure data
	 */
	const ISO_4217_LENGTH = 3;
	const NAME_LENGTH = 255;
	const STRUCTURE = [
				'id',
				'iso_4217',
				'name',
				'date_created',
				'date_modified',
				'rate'
	];
	
	/*
	 * Argument options for ordering
	 */
	const ORDER_ASC = 'ASC';
	const ORDER_DESC = 'DESC';
	
	/*
	 * Standard calculation data for currency template creation
	 */
	const ALPHABET_SIZE = 26;
	const MAX_CURRENCY_CODES = Currency::ALPHABET_SIZE*Currency::ALPHABET_SIZE*Currency::ALPHABET_SIZE;

	/*
	 * Eloquent creation settings
	 */
	public $timestamps = false;			//Ignore creating default timestamps
    protected $fillable = [				//Database rows that can be set manually
        'iso_4217', 'name', 'rate',
    ];
	
	/**
	 * Get all currencies from the DB in a certain order
	 */
	public static function getOrdered($row, $order) {
		$currencies = Currency::orderBy($row, $order)->get();
		return $currencies->toJson();
	}
	
	public static function getOxrRates() {
		$oxrUrl = config('services.oxr.latest') . config('services.oxr.key');

		//Open CURL session
		$ch = curl_init($oxrUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		//Get the data and close session
		$json = curl_exec($ch);
		curl_close($ch);
		$oxrLatest = json_decode($json);

		return $oxrLatest->rates;
	}
	
	public static function getOxrNames() {
		$oxrUrl = config('services.oxr.currencies');

		//Open CURL session
		$ch = curl_init($oxrUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		//Get the data and close session
		$json = curl_exec($ch);
		curl_close($ch);
		$oxrCurrencies = json_decode($json);

		return $oxrCurrencies;
	}
	
	public static function updateAll() {
		$rates = Currency::getOxrRates();
		$names = Currency::getOxrNames();
		
		foreach($rates as $key => $value) {
			$currency = Currency::firstOrNew(['iso_4217' => $key]);
			$currency->name = $names->$key;
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
