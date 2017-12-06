<?php

namespace App\Messages\Errors;

use App\Messages\ResponseMessage;

/**
 * Message to be displayed when the API request is invalid
 */
class APIRequestInvalidMessage extends ErrorMessage
{

	const USER_MESSAGE = "The currency API refused the request.";
	const ERROR_LEVEL = parent::LOG_LEVEL_WARNING;

	/**
	 * Construct a new user-friendly error message.
	 * 
	 * @param string $logMessage Message to be logged
	 * 
	 * @return void
	 */
	public function __construct($logMessage)
	{
		parent::__construct(self::USER_MESSAGE, $logMessage, self::ERROR_LEVEL);
	}

}
