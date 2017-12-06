<?php

namespace App\Helpers;

use \DB;
use \PDOException;
use App\Exceptions\Database\DBConnectionUnavailableException;

class DBConnectionHelper {
	
	public static function ensureConnected() {
		try {
			DB::connection()->getPdo();
		}
		catch (PDOException $e) {
			throw new DBConnectionUnavailableException(self::getName(), $e);
		}
	}
	
	public static function getName() {
		return DB::connection()->getName();
	}
}
