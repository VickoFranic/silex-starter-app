<?php 

namespace app\controllers;

use Silex\Application;

class UserController extends ControllerBase
{
	
	function __construct()
	{
		# code...
	}

	/**
	 * User home
	 */
	public function index( Application $app )
	{
		return $this->successResponse($app['session']->get('user'));	
	}

	public function pages( Application $app )
	{
		/**
		 * app\services\UserService
		 */
		$fb = $app['services.facebook'];

		$user = $app['session']->get('user');
		if(! $user) {
			return $app->redirect('/');
		}

		return $this->successResponse($fb->getPagesForUser($user));
	}
}