<?php

namespace App\Messages\Errors;

use App\Messages\ResponseMessage;

/**
 * Message to be displayed when the server can't make any more requests to
 * the API
 */
class APIQuotaEmptyMessage extends ResponseMessage
{

	const USER_MESSAGE = "The server's currency API quota has run out.";
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
