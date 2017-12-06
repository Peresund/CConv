<?php

namespace App\Messages;

interface ResponseMessageContainer
{

	/**
	 * Get the message response object
	 * 
	 * @return ResponseMessage
	 */
	public function getMessageResponse();
}
