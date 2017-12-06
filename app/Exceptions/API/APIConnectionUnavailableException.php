<?php

namespace App\Exceptions\API;

use \Exception;
use App\Messages\ResponseMessageContainer;
use App\Messages\Errors\APIConnectionUnavailableMessage;

class APIConnectionUnavailableException extends Exception implements ResponseMessageContainer
{

	protected $url;
	protected $responseMessage;

	/**
	 * Construct a new API connection unavailable exception instance
	 *
	 * @param  string  $url The URL being unavailable
	 * @param  \Exception $previous The previous exception
	 * 
	 * @return void
	 */
	public function __construct($url, Exception $previous = null)
	{
		parent::__construct('', 0, $previous);

		$this->url = $url;
		$this->message = $this->formatMessage($url, $previous);
		$this->responseMessage = new APIConnectionUnavailableMessage($this->message);
	}

	/**
	 * Format the error message
	 *
	 * @param  string  $url The URL being unavailable
	 * @param  \Exception $previous The previous exception
	 * 
	 * @return string A formatted exception message.
	 */
	protected function formatMessage($url, $previous)
	{
		return ($previous ? $previous->getMessage() . ' ' : '') .
				'Failed to connect to URL: ' . $url;
	}

	/**
	 * Get the URL for the API connection
	 *
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Get the message response object
	 * 
	 * @return APIConnectionUnavailableMessage
	 */
	public function getMessageResponse()
	{
		return $this->responseMessage;
	}

}
