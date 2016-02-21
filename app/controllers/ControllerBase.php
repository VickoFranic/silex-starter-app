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
	 * @var $code
	 * @return JSON
	 */
	public function successResponse($data, $code = 200)
	{
		return json_encode(['data' => $data, 'code' => $code]);
	}

	/**
	 * Error response
	 * 
	 * @var $data
	 * @var $code
	 * @return JSON
	 */
	public function errorResponse($data = [], $code = [])
	{
		return json_encode(['data' => $data, 'code' => $code]);
	}
}