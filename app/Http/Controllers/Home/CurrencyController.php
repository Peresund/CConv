<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\CurrencyConverter\Currency;

use App\Helpers\DBConnectionHelper;
use App\Helpers\ResponseHelper;

use Illuminate\Database\QueryException;
use App\Exceptions\API\APIConnectionUnavailableException;
use App\Exceptions\API\APIQuotaEmptyException;
use App\Exceptions\API\APIRequestInvalidException;
use App\Exceptions\Database\DBConnectionUnavailableException;

use App\Messages\Errors\CurrencyGetErrorMessage;

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
		try {
			DBConnectionHelper::ensureConnected();
		}
		catch (DBConnectionUnavailableException $ex) {
			return ResponseHelper::generateErrorResponse($ex->getMessageResponse());
		}
		
		$column = 'iso_4217';
		$order = Currency::ORDER_ASC;
		try {
			$orderedCurrencies = Currency::orderBy($column, $order)->get();
		}
		catch(QueryException $ex) { //Unknown query problem occured
			$errorMessage = new CurrencyGetErrorMessage($ex->getMessage());
			return ResponseHelper::generateErrorResponse($errorMessage);
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
		try {
			DBConnectionHelper::ensureConnected();
		}
		catch (DBConnectionUnavailableException $ex) {
			return ResponseHelper::generateErrorResponse($ex->getMessageResponse());
		}
		
		try {
			Currency::updateAll();
		}
		catch (QueryException $ex) {		//Unknown query problem occured
			return ResponseHelper::generateErrorResponse($ex->getMessageResponse());
		}
		catch(APIConnectionUnavailableException $ex) {
			return ResponseHelper::generateErrorResponse($ex->getMessageResponse());
		}
		catch(APIQuotaEmptyException $ex) {
			return ResponseHelper::generateErrorResponse($ex->getMessageResponse());
		}
		catch(APIRequestInvalidException $ex) {
			return ResponseHelper::generateErrorResponse($ex->getMessageResponse());
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
		try {
			DBConnectionHelper::ensureConnected();
		}
		catch (DBConnectionUnavailableException $ex) {
			return ResponseHelper::generateErrorResponse($ex->getMessageResponse());
		}
		
		try {
			Currency::truncate();
		}
		catch(QueryException $ex) {		//Unknown query problem occured
			return ResponseHelper::generateErrorResponse($ex->getMessageResponse());
		}
		
		return CurrencyController::getCurrencies();
	}
}
