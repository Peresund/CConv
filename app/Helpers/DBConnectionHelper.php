<?php

namespace App\Helpers;

use \DB;
use \PDOException;
use App\Exceptions\Database\DBConnectionUnavailableException;

class DBConnectionHelper {
	
	/**
	 * Ensure the database is connected
	 * 
	 * @throws DBConnectionUnavailableException if the database is not connected
	 */
	public static function ensureConnected() {
		try {
			DB::connection()->getPdo();
		}
		catch (PDOException $e) {
			throw new DBConnectionUnavailableException(self::getName(), $e);
		}
	}
	
	/**
	 * Get the database connection name
	 * 
	 * @return string The name of the database connection
	 */
	public static function getName() {
		return DB::connection()->getName();
	}
}
