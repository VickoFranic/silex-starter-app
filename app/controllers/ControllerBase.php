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
	public function successResponse($data, $code = [])
	{
		return json_encode(['data' => $data]);
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