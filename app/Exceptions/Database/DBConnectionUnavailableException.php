<?php

namespace App\Exceptions\Database;

use \PDOException;
use App\Messages\ResponseMessageContainer;
use App\Messages\Errors\DBConnectionUnavailableMessage;

class DBConnectionUnavailableException extends PDOException implements ResponseMessageContainer
{

	const EXCEPTION_MESSAGE = 'Failed to connect to Database connection: %s';

	protected $dbConnectionName;
	protected $responseMessage;

	/**
	 * Construct a new database connection unavailable exception instance
	 *
	 * @param  string  $dbConnectionName The database connection being unavailable
	 * @param  \PDOException $previous The previous exception
	 * 
	 * @return void
	 */
	public function __construct($dbConnectionName, PDOException $previous = null)
	{
		parent::__construct('', 0, $previous);

		$this->dbConnectionName = $dbConnectionName;
		$this->message = $this->formatMessage($dbConnectionName, $previous);
		$this->responseMessage = new DBConnectionUnavailableMessage($this->message);
	}

	/**
	 * Format the error message
	 *
	 * @param  string  $DBConnectionName The database connection being unavailable
	 * @param  \PDOException $previous The previous exception
	 * 
	 * @return string A formatted exception message.
	 */
	protected function formatMessage($DBConnectionName, $previous)
	{
		return ($previous ? $previous->getMessage() . ' ' : '') .
				sprintf(self::EXCEPTION_MESSAGE, $DBConnectionName);
	}

	/**
	 * Get the name for the DB connection
	 *
	 * @return string
	 */
	public function getDBConnection()
	{
		return $this->dbConnectionName;
	}

	/**
	 * Get the response message object
	 * 
	 * @return DBConnectionUnavailableMessage
	 */
	public function getResponseMessage()
	{
		return $this->responseMessage;
	}

}
