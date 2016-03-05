<?php 

namespace app\controllers;

use Silex\Application;

class UserController extends ControllerBase
{
	/**
	 * User home
	 */
	public function index( Application $app )
	{
		$us = $app['services.user'];

		return $this->successResponse($us->getCurrentUser($app));	
	}

	/**
	 * User pages
	 */
	public function pages( Application $app )
	{
		$fb = $app['services.facebook'];
		$us = $app['services.user'];

		$user = $us->getCurrentUser($app);

		return $this->successResponse($fb->getPagesForUser($user));
	}
}