<?php

namespace App\Exceptions\API;

use \Exception;
use App\Messages\ResponseMessageContainer;
use App\Messages\Errors\APIRequestInvalidMessage;

class APIRequestInvalidException extends Exception implements ResponseMessageContainer
{

	const EXCEPTION_MESSAGE = 'Received status "%s" %s while trying to request the API: %s';

	protected $request;
	protected $status;
	protected $statusMessage;
	protected $responseMessage;

	/**
	 * Construct a new invalid request exception instance
	 *
	 * @param  string  $request The API request being invalid
	 * @param  string  $status The status code received
	 * @param  string  $statusMessage The status message received
	 * @param  \Exception $previous [optional] <br /> The previous exception
	 * 
	 * @return void
	 */
	public function __construct($request, $status, $statusMessage, Exception $previous = null)
	{
		parent::__construct('', 0, $previous);

		$this->request = $request;
		$this->status = $status;
		$this->statusMessage = $statusMessage;
		$this->message = $this->formatMessage($request, $status, $statusMessage, $previous);
		$this->responseMessage = new APIRequestInvalidMessage($this->message);
	}

	/**
	 * Format the invalid request error message
	 *
	 * @param  string  $request The API request being invalid
	 * @param  string  $status The status code received
	 * @param  string  $statusMessage The status message received
	 * @param  \Exception $previous The previous exception
	 * 
	 * @return string A formatted exception message.
	 */
	protected function formatMessage($request, $status, $statusMessage, $previous)
	{
		return ($previous ? $previous->getMessage() . ' ' : '') .
				sprintf(self::EXCEPTION_MESSAGE, $status, ($statusMessage ? ' with message "' . $statusMessage . '"' : ''), $request);
	}

	/**
	 * Get the faulty API request
	 *
	 * @return string
	 */
	public function getRequest()
	{
		return $this->request;
	}

	/**
	 * Get the status of the response
	 *
	 * @return string
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Get the status message of the response
	 *
	 * @return string
	 */
	public function getStatusMessage()
	{
		return $this->statusMessage;
	}

	/**
	 * Get the response message object
	 * 
	 * @return APIRequestInvalidMessage
	 */
	public function getResponseMessage()
	{
		return $this->responseMessage;
	}

}
