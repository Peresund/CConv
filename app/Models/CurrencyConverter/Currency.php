<?php

namespace App\Models\CurrencyConverter;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\APIHelper;
use App\Exceptions\API\EmptyQuotaException;

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
	const MAX_CURRENCY_CODES = self::ALPHABET_SIZE * self::ALPHABET_SIZE * self::ALPHABET_SIZE;

	/*
	 * Eloquent creation settings
	 */
	public $timestamps = false;		//Ignore creating default timestamps
	protected $fillable = [			//Database columns that can be set manually
		'iso_4217', 'name', 'rate',
	];

	public static function updateAll() {
		$remaining = APIHelper::getOxrRemainingRequests();
		if (intval($remaining) <= 0) {
			throw new EmptyQuotaException();
		}
		
		$rates = APIHelper::getOxrRates();
		$names = APIHelper::getOxrNames();
		
		foreach($rates as $key => $value) {
			$currency = self::firstOrNew(['iso_4217' => $key]);
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
		
		for ($position = 0; $position < self::ISO_4217_LENGTH; $position++) {
			$remainder = $fromInteger % self::ALPHABET_SIZE;
			$fromInteger = floor($fromInteger / self::ALPHABET_SIZE);
			$currencyCode = self::intToLetter($remainder) . $currencyCode;
		}
		
		return $currencyCode;
	}
}
