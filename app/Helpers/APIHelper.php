<?php

namespace App\Helpers;

use App\Exceptions\API\NotConnectableException;
use App\Exceptions\API\InvalidRequestException;

class APIHelper {
	
	private static function getRequestData($oxrRequest) {
		$curlHandle = curl_init($oxrRequest);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);

		$json = curl_exec($curlHandle);
		curl_close($curlHandle);
		if ($json === FALSE) {
			throw new NotConnectableException($oxrRequest); 
		}
		
		return $json;
	}
	
	private static function getOxrRequest($oxrRequest) {
		$json = self::getRequestData($oxrRequest);
		$result = json_decode($json);
		
		//Verify data
		$status = (property_exists($result, 'status') ? $result->status : 200);
		if ($status !== 200) {
			$message = (property_exists($result, 'message') ? $result->message : null);
			throw new InvalidRequestException($oxrRequest, $result->status, $message);
		}
		
		return $result;
	}
	
	public static function getOxrRemainingRequests() {
		$oxrRequest = config('services.oxr.usage') . config('services.oxr.key');
		
		$result = self::getOxrRequest($oxrRequest);

		return $result->data->usage->requests_remaining;
	}
	
	public static function getOxrRates() {
		$oxrRequest = config('services.oxr.latest') . config('services.oxr.key');
		
		$result = self::getOxrRequest($oxrRequest);

		return $result->rates;
	}
	
	public static function getOxrNames() {
		$oxrRequest = config('services.oxr.currencies');

		$result = self::getOxrRequest($oxrRequest);

		return $result;
	}
}
