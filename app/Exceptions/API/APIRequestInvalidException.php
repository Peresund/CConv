<?php

namespace App\Exceptions\API;

use \Exception;
use App\Messages\ResponseMessageContainer;
use App\Messages\Errors\APIRequestInvalidMessage;

class APIRequestInvalidException extends Exception implements ResponseMessageContainer
{

	protected $request;
	protected $status;
	protected $statusMessage;
	protected $responseMessage;

	/**
	 * Construct a new invalid request exception instance
	 *
	 * @param  string  $request The API request being invalid
	 * @param  int  $status The status received
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
	 * @param  \Exception $previous The previous exception
	 * 
	 * @return string A formatted exception message.
	 */
	protected function formatMessage($request, $status, $statusMessage, $previous)
	{
		return ($previous ? $previous->getMessage() . ' ' : '') .
				'Received status "' . $status .
				($statusMessage ? '" with message "' . $statusMessage : '') .
				'" while trying to request the API: ' . $request;
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
	 * Get the message response object
	 * 
	 * @return APIRequestInvalidMessage
	 */
	public function getMessageResponse()
	{
		return $this->responseMessage;
	}

}
