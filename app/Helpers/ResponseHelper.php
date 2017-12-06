<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

/**
 * 
 */
class ResponseHelper {
	
	/**
	 * Generates an error response containing the error message, and logs the more <br />
	 * detailed exception message, if provided
	 * 
	 * @param string $message The user-friendly message
	 * @param \Exception $exceptionToLog The exception to use for detailed logging
	 * 
	 * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory A plain
	 * text response with status 500 containing the user-friendly error <br />
	 * message with the header "X-Error-Known=true", indicating that the <br />
	 * error message is not auto-generated.
	 */
	public static function generateErrorResponse($message, $exceptionToLog = null) {
		if ($exceptionToLog) {
			Log::error($exceptionToLog->getMessage());
		}
		return response($message, 500)
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
	public static function generateJson($object) {
		return response($object->toJson(), 200)
				->header('Content-Type',  'application/json; charset=UTF-8');
	}
}