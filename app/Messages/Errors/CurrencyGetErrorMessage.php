<?php

namespace App\Messages\Errors;

use App\Messages\ResponseMessage;

/**
 * Message to be displayed when an unknown error has occured while trying to
 * get all currencies from the database
 */
class CurrencyGetErrorMessage extends ResponseMessage
{

	const USER_MESSAGE = "An unknown error occured while getting currencies.";
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
