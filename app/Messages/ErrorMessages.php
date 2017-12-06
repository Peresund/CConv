<?php

namespace App\Messages;

class ErrorMessages {
	/**
	 * Error to be displayed when the server can't connect to the database
     *
     * @const string
	 */
	const DB_NOT_CONNECTED = 'An error occured while connecting to the server\'s database. Please try again later.';
	
	/**
	 * Error to be displayed when the API is unconnectable
     *
     * @const string
	 */
	const API_NOT_CONNECTABLE = "An error occured while carrying out the request.";
	
	/**
	 * Error to be displayed when the server can't make any more requests to
	 * the API
     *
     * @const string
	 */
	const API_QUOTA_EMPTY = "The server's API quota has run out.";
	
	/**
	 * Error to be displayed when the API request is invalid
     *
     * @const string
	 */
	const API_INVALID_REQUEST = "An error occured while carrying out the request.";
	
	/**
	 * Error to be displayed when an unknown error has occured while trying to
	 * update the currencies database table
     *
     * @const string
	 */
	const CURRENCY_UPDATE = 'An unknown error occured while updating currencies.';
	
	/**
	 * Error to be displayed when an unknown error has occured while trying to
	 * get all currencies from the database
     *
     * @const string
	 */
	const CURRENCY_GET = 'An unknown error occured while getting currencies.';
	
	/**
	 * Error to be displayed when an unknown error has occured while trying to
	 * clear the currencies database table
     *
     * @const string
	 */
	const CURRENCY_CLEAR = 'An unknown error occured while clearing currencies.';
}
