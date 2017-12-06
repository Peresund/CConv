<?php

namespace App\Exceptions\API;

use \Exception;

class InvalidRequestException extends Exception {
	
    /**
     * The invalid request
     *
     * @var string
     */
	 protected $request;
	 
    /**
     * The status of the response
     *
     * @var string
     */
	 protected $status;
	 
    /**
     * The status message of the response
     *
     * @var string
     */
	 protected $statusMessage;

    /**
     * Create a new invalid request exception instance
     *
     * @param  string  $request The invalid request
     * @param  int  $status The status received
     * @param  string  $statusMessage The status message received
     * @param  \Exception $previous [optional] <br /> The previous exception
	 * 
     * @return void
     */
	 public function __construct($request, $status, $statusMessage, Exception $previous = null) {
        parent::__construct('', 0, $previous);
		
        $this->request = $request;
		$this->status = $status;
		$this->statusMessage = $statusMessage;
        $this->message = $this->formatMessage($request, $status, $statusMessage, $previous);
    }

    /**
     * Format the request error message
     *
     * @param  string  $request The invalid request
     * @param  \Exception $previous The previous exception
	 * 
     * @return string A formatted exception message.
     */
    protected function formatMessage($request, $status, $statusMessage, $previous)
    {
        return ($previous ? $previous->getMessage() . ' ' : '') .
				'Received status "'  . $status .
				($statusMessage ? '" with message "' . $statusMessage : '') .
				'" while trying to request the API: ' . $request;
    }

    /**
     * Get the SQL for the query
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->sql;
    }
}
