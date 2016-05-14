<?php 

namespace app\controllers;

/**
* ControllerBase
*/
class ControllerBase
{
	/**
	 * Success response
	 * 
	 * @var $data
	 * @return JSON
	 */
	public function successResponse($data)
	{
		return json_encode($data);
	}

	/**
	 * Error response
	 * 
	 * @var $data
	 * @var $code
	 * @return JSON
	 */
	public function errorResponse($message = 'Error', $code = '500')
	{
		return json_encode([$message, $code]);
	}
}