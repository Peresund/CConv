<?php

namespace App\Exceptions\API;

use \Exception;

class NotConnectableException extends Exception {
	
    /**
     * The unconnectable URL
     *
     * @var string
     */
	 protected $url;

    /**
     * Create a new unconnectable exception instance
     *
     * @param  string  $url The URL not being connectable
     * @param  \Exception $previous The previous exception
	 * 
     * @return void
     */
	 public function __construct($url, Exception $previous = null) {
        parent::__construct('', 0, $previous);
		
        $this->$url = $url;
        $this->message = $this->formatMessage($url, $previous);
    }

    /**
     * Format the URL error message
     *
     * @param  string  $url The URL being unconnectable
     * @param  \Exception $previous The previous exception
	 * 
     * @return string A formatted exception message.
     */
    protected function formatMessage($url, $previous)
    {
        return ($previous ? $previous->getMessage() . ' ' : '') .
				'Failed to connect to URL: ' . $url;
    }

    /**
     * Get the URL for the connection
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
