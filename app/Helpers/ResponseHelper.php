<?php

namespace App\Helpers;

use App\Messages\ResponseMessage;

class ResponseHelper
{

	/**
	 * Generates an error response containing the user-friendly error message and logs
	 * the more detailed logging message
	 * 
	 * @param App\Messages\ResponseMessage $errorMessage The object containing the message data
	 * 
	 * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory A plain
	 * text response with status 500 containing the user-friendly error
	 * message with the header "X-Error-Known=true", indicating that the
	 * error message is not auto-generated.
	 */
	public static function generateErrorResponse(ResponseMessage $errorMessage)
	{
		$errorMessage->Log();
		return response($errorMessage->getUserMessage(), 500)
						->header('Content-Type', 'text/plain')
						->header('X-Error-Known', 'true');
	}

	/**
	 * Generates a response containing the object's data
	 * 
	 * @param \Illuminate\Contracts\Support\Jsonable $object The Jsonable object to send with the response
	 * 
	 * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory A JSON
	 * response with status 200 containing the object's data.
	 */
	public static function generateJson($object)
	{
		return response($object->toJson(), 200)
						->header('Content-Type', 'application/json; charset=UTF-8');
	}

}
