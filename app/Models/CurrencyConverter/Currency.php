<?php

namespace App\Models\CurrencyConverter;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\APIHelper;
use App\Exceptions\API\APIQuotaEmptyException;

class Currency extends Model
{
	/*
	 * Model structure data
	 */
	const ISO_4217_LENGTH = 3;
	const NAME_LENGTH = 256;
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
	public $timestamps = false;  //Ignore creating default timestamps
	protected $fillable = [   //Database columns that can be set manually
		'iso_4217', 'name', 'rate',
	];

	/**
	 * Get the latest currency data from the OXR API and update or fill the currency table
	 * 
	 * @throws APIQuotaEmptyException if the OXR plan's quota is empty
	 */
	public static function updateAll()
	{
		$remaining = APIHelper::getOxrRemainingRequests();
		if ($remaining <= 0)
		{
			throw new APIQuotaEmptyException();
		}

		$rates = APIHelper::getOxrRates();
		$names = APIHelper::getOxrNames();

		foreach ($rates as $key => $value)
		{
			$currency = self::firstOrNew(['iso_4217' => $key]);
			$currency->name = $names->$key;
			$currency->rate = $value;
			$currency->save();
		}
	}

	/**
	 * Convert the integer given to a representing uppercase ASCII letter
	 * 
	 * @param int $integer The integer to be converted to ASCII
	 * @return string The ASCII representation of the int
	 */
	private static function intToLetter($integer)
	{
		return chr($integer + 65);
	}

	/**
	 * Generate a currency code from the given integer
	 * 
	 * @param int $currencyId The integer id to be used for generating a
	 * unique currency code. Must be from 0 to MAX_CURRENCY_CODES-1.
	 * 
	 * @return string A unique currency code
	 */
	public static function generateCurrencyCode($currencyId)
	{
		$currencyCode = "";

		for ($position = 0; $position < self::ISO_4217_LENGTH; $position++)
		{
			$remainder = $currencyId % self::ALPHABET_SIZE;
			$currencyId = floor($currencyId / self::ALPHABET_SIZE);
			$currencyCode = self::intToLetter($remainder) . $currencyCode;
		}

		return $currencyCode;
	}

}
