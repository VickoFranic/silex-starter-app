<?php

namespace app\controllers;

use Silex\Application;

/**
 * Index controller 
 *
 */
class IndexController extends ControllerBase
{
	/**
	 * Index action
	 */
	public function index( Application $app )
	{

		// User repository
		$ur = $app['repositories.user'];

		// Get all users from DB
		$users = $ur->findAll();

		if ($users) {
			return $this->successResponse($users, 201);
		}
		return $this->errorResponse('Users not found', 404);
	}

}