<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\CurrencyConverter\Currency;

use App\Helpers\DBConnectionHelper;
use App\Helpers\ResponseHelper;

use \Exception;
use \PDOException;
use Illuminate\Database\QueryException;
use App\Exceptions\API\APIConnectionUnavailableException;
use App\Exceptions\API\APIQuotaEmptyException;
use App\Exceptions\API\APIRequestInvalidException;
use App\Exceptions\Database\DBConnectionUnavailableException;

use App\Messages\Errors\CurrencyGetErrorMessage;
use App\Messages\Errors\CurrencyUpdateErrorMessage;
use App\Messages\Errors\CurrencyClearErrorMessage;

/**
 * The controller handling the currency requests for the home page
 */
class CurrencyController extends Controller
{
	/**
	 * Get the currencies in the currencies table.
	 * 
	 * @return Response On success, will return a response containing all the
	 * currencies in the database.<br />
	 * On failure, will return an error message describing the failure.
	 */
	public function getCurrencies()
	{
		try {
			DBConnectionHelper::ensureConnected();
		}
		catch (DBConnectionUnavailableException $ex) {
			return ResponseHelper::generateErrorResponse($ex->getResponseMessage());
		}
		
		try {
			$column = 'iso_4217';
			$order = Currency::ORDER_ASC;
			$orderedCurrencies = Currency::orderBy($column, $order)->get();
		}
		catch(PDOException $ex) {
			$errorMessage = new CurrencyGetErrorMessage($ex->getMessage() . ' Error-code: "' . implode($ex->errorInfo) . '"');
			return ResponseHelper::generateErrorResponse($errorMessage);
		}
		catch(Exception $ex) { //Unknown problem occured
			$errorMessage = new CurrencyGetErrorMessage($ex->getMessage());
			return ResponseHelper::generateErrorResponse($errorMessage);
		}
		
		return ResponseHelper::generateJson($orderedCurrencies);
	}
	
	/**
	 * Update the currencies table, retrieving the latest current currency data
	 * from the API
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
			return ResponseHelper::generateErrorResponse($ex->getResponseMessage());
		}
		
		try {
			Currency::updateAll();
		}
		catch(APIConnectionUnavailableException $ex) {
			return ResponseHelper::generateErrorResponse($ex->getResponseMessage());
		}
		catch(APIQuotaEmptyException $ex) {
			return ResponseHelper::generateErrorResponse($ex->getResponseMessage());
		}
		catch(APIRequestInvalidException $ex) {
			return ResponseHelper::generateErrorResponse($ex->getResponseMessage());
		}
		catch (Exception $ex) {  //Unknown problem occured
			$errorMessage = new CurrencyUpdateErrorMessage($ex->getMessage());
			return ResponseHelper::generateErrorResponse($errorMessage);
		}
		
		return CurrencyController::getCurrencies();
    }

	/**
	 * Empty the currency table
	 * 
	 * @return Response On success, will return a response containing all the
	 * currencies in the database.<br />
	 * On failure, will return an error message describing the failure.
	 */
	public function clearCurrencies()
	{
		try {
			DBConnectionHelper::ensureConnected();
		}
		catch (DBConnectionUnavailableException $ex) {
			return ResponseHelper::generateErrorResponse($ex->getResponseMessage());
		}
		
		try {
			Currency::truncate();
		}
		catch(Exception $ex) {  //Unknown problem occured
			$errorMessage = new CurrencyClearErrorMessage($ex->getMessage());
			return ResponseHelper::generateErrorResponse($errorMessage);
		}
		
		return CurrencyController::getCurrencies();
	}
}
