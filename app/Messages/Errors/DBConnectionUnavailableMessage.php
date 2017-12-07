<?php

namespace App\Messages\Errors;

use App\Messages\ResponseMessage;

/**
 * Message to be displayed when the server can't connect to the database
 */
class DBConnectionUnavailableMessage extends ResponseMessage
{

	const USER_MESSAGE = "An error occured while connecting to the server's database. Please try again later.";
	const LOG_MESSAGE = "Database %s not connected when trying to get currencies.";
	const ERROR_LEVEL = parent::LOG_LEVEL_ALERT;

	protected $dbConnectionName;

	/**
	 * Construct a new user-friendly error message.
	 * 
	 * @param string $dbConnectionName The database connection name
	 * 
	 * @return void
	 */
	public function __construct($dbConnectionName)
	{
		parent::__construct(self::USER_MESSAGE, sprintf(self::LOG_MESSAGE, $dbConnectionName), self::ERROR_LEVEL);

		$this->dbConnectionName = $dbConnectionName;
	}

	/**
	 * Get the name of the faulty database connection
	 * 
	 * @return string The name of the faulty database connection
	 */
	public function getDatabaseConnection()
	{
		return $this->dbConnectionName;
	}

}
