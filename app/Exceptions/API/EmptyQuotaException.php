<?php

namespace App\Exceptions\API;

use \Exception;

class EmptyQuotaException extends Exception {
	
    /**
     * Create a new empty quota exception instance
     *
     * @param  \Exception $previous The previous exception
	 * 
     * @return void
     */
	 public function __construct(Exception $previous = null) {
        parent::__construct('', 0, $previous);
		
        $this->message = $this->formatMessage($previous);
    }

    /**
     * Format the request error message
     *
     * @param  string  $request The invalid request
     * @param  \Exception $previous The previous exception
	 * 
     * @return string A formatted exception message.
     */
    protected function formatMessage($previous)
    {
        return ($previous ? $previous->getMessage() . ' ' : '') .
				'The request quota for the API was less than or equal to 0';
    }
}
