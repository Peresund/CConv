<?php

namespace App\Helpers;

use App\Exceptions\API\APIConnectionUnavailableException;
use App\Exceptions\API\APIRequestInvalidException;
use Illuminate\Support\Facades\Log;

class APIHelper
{

	/**
	 * Execute the request and get the data
	 * 
	 * @param string $oxrRequest The OXR request URL
	 * 
	 * @return string A string containing the JSON data 
	 * 
	 * @throws APIConnectionUnavailableException if the connection is unavailable
	 */
	private static function getRequestData($oxrRequest)
	{
		$curlHandle = curl_init($oxrRequest);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);

		$json = curl_exec($curlHandle);
		curl_close($curlHandle);
		if ($json === FALSE)
		{
			throw new APIConnectionUnavailableException($oxrRequest);
		}

		return $json;
	}

	/**
	 * Get and verify the JSON data
	 * 
	 * @param string $oxrRequest The OXR request URL
	 * 
	 * @return Object An object containing the JSON response data.
	 * 
	 * @throws APIRequestInvalidException if the request is invalid
	 * 
	 */
	private static function getOxrRequest($oxrRequest)
	{
		$json = self::getRequestData($oxrRequest);
		$result = json_decode($json);

		//Verify data
		$status = (property_exists($result, 'status') ? $result->status : 200);
		if ($status !== 200)
		{
			Log::debug(PHP_EOL . 'Request: ' . $oxrRequest . PHP_EOL . 'Response: ' . $json);
			$message = (property_exists($result, 'message') ? $result->message : null);
			throw new APIRequestInvalidException($oxrRequest, $result->status, $message);
		}

		return $result;
	}
	
	/**
	 * Get the number of requests remaining from the OXR API usage statistics
	 * 
	 * @return int The number of requests remaining for the OXR plan
	 */
	public static function getOxrRemainingRequests()
	{
		$oxrRequest = config('services.oxr.usage') . config('services.oxr.key');

		$result = self::getOxrRequest($oxrRequest);

		return intval($result->data->usage->requests_remaining);
	}

	/**
	 * Get the latest currency rates data from the OXR API
	 * 
	 * @return Object An object containing the latest OXR rates
	 */
	public static function getOxrRates()
	{
		$oxrRequest = config('services.oxr.latest') . config('services.oxr.key');

		$result = self::getOxrRequest($oxrRequest);

		return $result->rates;
	}
	
	/**
	 * Get the currency names data from the OXR API
	 * 
	 * @return Object An object containing the OXR currency names
	 */
	public static function getOxrNames()
	{
		$oxrRequest = config('services.oxr.currencies');

		$result = self::getOxrRequest($oxrRequest);

		return $result;
	}

}
