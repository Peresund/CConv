<?php

namespace App\Messages;

/**
 * An object containing a response message
 */
interface ResponseMessageContainer
{

	/**
	 * Get the response message object
	 * 
	 * @return ResponseMessage
	 */
	public function getResponseMessage();
}
