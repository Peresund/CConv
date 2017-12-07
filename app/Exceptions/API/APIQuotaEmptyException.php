<?php

namespace App\Exceptions\API;

use \Exception;
use App\Messages\ResponseMessageContainer;
use App\Messages\Errors\APIQuotaEmptyMessage;

class APIQuotaEmptyException extends Exception implements ResponseMessageContainer
{

	const EXCEPTION_MESSAGE = 'The request quota for the API was less than or equal to 0';

	protected $responseMessage;

	/**
	 * Construct a new empty quota exception instance
	 *
	 * @param  \Exception $previous The previous exception
	 * 
	 * @return void
	 */
	public function __construct(Exception $previous = null)
	{
		parent::__construct('', 0, $previous);

		$this->message = $this->formatMessage($previous);
		$this->responseMessage = new APIQuotaEmptyMessage($this->message);
	}

	/**
	 * Format the error message
	 *
	 * @param  string  $request The invalid request
	 * @param  \Exception $previous The previous exception
	 * 
	 * @return string A formatted exception message.
	 */
	protected function formatMessage($previous)
	{
		return ($previous ? $previous->getMessage() . ' ' : '') . self::EXCEPTION_MESSAGE;
	}

	/**
	 * Get the response message object
	 * 
	 * @return APIQuotaEmptyMessage
	 */
	public function getResponseMessage()
	{
		return $this->responseMessage;
	}

}
