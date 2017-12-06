<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\CurrencyConverter\Currency;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Messages\ErrorMessages;
use App\Helpers\DBConnectionHelper;
use App\Helpers\ResponseHelper;
use App\Exceptions\API\NotConnectableException;
use App\Exceptions\API\EmptyQuotaException;
use App\Exceptions\API\InvalidRequestException;

class CurrencyController extends Controller
{
	/**
	 * Gets the currencies in the currencies table.
	 * 
	 * @return Response On success, will return a response containing all currencies in database.<br />
	 * On failure, will return an error message describing the failure.
	 */
	public function getCurrencies()
	{
		if (!DBConnectionHelper::isConnected()) {
			Log::error('Database ' . DBConnectionHelper::getName() .  ' not connected when getting currencies.');
			return ResponseHelper::generateErrorResponse(ErrorMessages::DB_NOT_CONNECTED);
		}
		
		$column = 'iso_4217';
		$order = Currency::ORDER_ASC;
		try {
			$orderedCurrencies = Currency::orderBy($column, $order)->get();
		}
		catch(QueryException $e) { //Unknown query problem occured
			return ResponseHelper::generateErrorResponse(ErrorMessages::CURRENCY_GET, $e);
		}
		
		return ResponseHelper::generateJson($orderedCurrencies);
	}
	
	/**
	 * Updates the currencies table, retrieving the current currency data
	 * from the API.
	 * 
	 * @return Response On success, will return a response containing all the
	 * currencies in the database.<br />
	 * On failure, will return an error message describing the failure.
	 */
    public function updateCurrencies()
    {
		if (!DBConnectionHelper::isConnected()) {
			Log::error('Database ' . DBConnectionHelper::getName() .  ' not connected when getting currencies.');
			return ResponseHelper::generateErrorResponse(ErrorMessages::DB_NOT_CONNECTED);
		}
		
		try {
			Currency::updateAll();
		}
		catch (QueryException $e) {		//Unknown query problem occured
			return ResponseHelper::generateErrorResponse(ErrorMessages::CURRENCY_UPDATE, $e);
		}
		catch(NotConnectableException $e) {
			return ResponseHelper::generateErrorResponse(ErrorMessages::API_NOT_CONNECTABLE, $e);
		}
		catch(EmptyQuotaException $e) {
			return ResponseHelper::generateErrorResponse(ErrorMessages::API_QUOTA_EMPTY, $e);
		}
		catch(InvalidRequestException $e) {
			return ResponseHelper::generateErrorResponse(ErrorMessages::API_INVALID_REQUEST, $e);
		}
		
		return CurrencyController::getCurrencies();
    }

	/**
	 * Empties the currencies table.
	 * 
	 * @return Response On success, will return a response containing all currencies in database.<br />
	 * On failure, will return an error message describing the failure.
	 */
	public function clearCurrencies()
	{
		if (!DBConnectionHelper::isConnected()) {
			Log::error('Database ' . DBConnectionHelper::getName() .  ' not connected when getting currencies.');
			return ResponseHelper::generateErrorResponse(ErrorMessages::DB_NOT_CONNECTED);
		}
		
		try {
			Currency::truncate();
		}
		catch(QueryException $e) {		//Unknown query problem occured
			return ResponseHelper::generateErrorResponse(ErrorMessages::CURRENCY_CLEAR, $e);
		}
		
		return CurrencyController::getCurrencies();
	}
}
