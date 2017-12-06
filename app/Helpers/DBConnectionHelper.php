<?php

namespace App\Helpers;

use \Exception;
use \DB;
use \PDOException;

class DBConnectionHelper {
	
	public static function isConnected() {
		try {
			DB::connection()->getPdo();
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}
	
	public static function getName() {
		return DB::connection()->getName();
	}
}
