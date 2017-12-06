<?php

namespace App\Messages;

class LogMessages {
	/**
	 * Message to be logged when the server can't connect to the database.
	 */
	const DB_NOT_CONNECTED = 'An error occured while connecting to the server\'s database. Please try again later.';
	
	/**
	 * Message to be logged when an unknown error has occured while trying to
	 * update the currencies database table.
	 */
	const CURRENCY_UPDATE = 'An unknown error occured while updating currencies.';
	
	/**
	 * Message to be logged when an unknown error has occured while trying to
	 * get all currencies from the database.
	 */
	const CURRENCY_GET = 'An unknown error occured while getting currencies.';
	
	/**
	 * Message to be logged when an unknown error has occured while trying to
	 * clear the currencies database table.
	 */
	const CURRENCY_CLEAR = 'An unknown error occured while clearing currencies.';
}
