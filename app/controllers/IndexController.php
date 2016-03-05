<?php

namespace app\controllers;

use Silex\Application;

class IndexController extends ControllerBase
{
	/**
	 * Index page
	 */
	public function index( Application $app )
	{

		$fb = $app['services.facebook'];
		return $this->successResponse($fb->loginUrl());
	}

	/** 
	 * Login callback
	 */
	public function login( Application $app )
	{
		$fb = $app['services.facebook'];
		$user = $fb->getUser();

		if (! $user) {
			return $app->redirect('/');
		}

		$app['session']->set('user', $user);

		return $app->redirect('/home');
	}
}