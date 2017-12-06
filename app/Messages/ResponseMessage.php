<?php

namespace App\Messages;

use Illuminate\Support\Facades\Log;

abstract class ResponseMessage
{

	/**
	 * System is unusable.
	 */
	const LOG_LEVEL_EMERGENCY = 8;

	/**
	 * Action must be taken immediately.
	 *
	 * Example: Entire website down, database unavailable, etc.
	 */
	const LOG_LEVEL_ALERT = 7;

	/**
	 * Critical conditions.
	 *
	 * Example: Application component unavailable, unexpected exception.
	 */
	const LOG_LEVEL_CRITICAL = 6;

	/**
	 * Runtime errors that do not require immediate action but should typically
	 * be logged and monitored.
	 */
	const LOG_LEVEL_ERROR = 5;

	/**
	 * Exceptional occurrences that are not errors.
	 *
	 * Example: Use of deprecated APIs, poor use of an API, undesirable things
	 * that are not necessarily wrong.
	 */
	const LOG_LEVEL_WARNING = 4;

	/**
	 * Normal but significant events.
	 */
	const LOG_LEVEL_NOTICE = 3;

	/**
	 * Interesting events.
	 *
	 * Example: User logs in, SQL logs.
	 */
	const LOG_LEVEL_INFO = 2;

	/**
	 * Detailed debug information.
	 */
	const LOG_LEVEL_DEBUG = 1;

	/**
	 * Logs with an arbitrary level.
	 */
	const LOG_LEVEL_LOG = 0;

	protected $userMessage;
	protected $logMessage;
	protected $level;

	/**
	 * Construct the response message
	 * 
	 * @param string $userMessage
	 * @param string $logMessage
	 * @param int $level
	 */
	protected function __construct($userMessage, $logMessage, $level)
	{
		$this->userMessage = $userMessage;
		$this->logMessage = $logMessage;
		$this->level = $level;
	}

	public function getUserMessage()
	{
		return $this->userMessage;
	}

	public function getLogMessage()
	{
		return $this->logMessage;
	}

	public function getLevel()
	{
		return $this->level;
	}

	public function Log()
	{
		switch ($this->level)
		{
			case self::LOG_LEVEL_LOG:
				Log::log($this->logMessage);
				break;
			case self::LOG_LEVEL_DEBUG:
				Log::debug($this->logMessage);
				break;
			case self::LOG_LEVEL_INFO:
				Log::info($this->logMessage);
				break;
			case self::LOG_LEVEL_NOTICE:
				Log::notice($this->logMessage);
				break;
			case self::LOG_LEVEL_WARNING:
				Log::warning($this->logMessage);
				break;
			case self::LOG_LEVEL_ERROR:
				Log::error($this->logMessage);
				break;
			case self::LOG_LEVEL_CRITICAL:
				Log::critical($this->logMessage);
				break;
			case self::LOG_LEVEL_ALERT:
				Log::alert($this->logMessage);
				break;
			case self::LOG_LEVEL_EMERGENCY:
				Log::emergency($this->logMessage);
				break;
		}
	}

}
