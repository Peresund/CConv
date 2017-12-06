<?php

namespace App\Messages\Errors;

use App\Messages\ResponseMessage;

/**
 * Message to be displayed when the server can't connect to the API
 */
class APIConnectionUnavailableMessage extends ResponseMessage
{

	const USER_MESSAGE = "The currency API server was not connectable. Please try again later.";
	const ERROR_LEVEL = parent::LOG_LEVEL_CRITICAL;

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
