<?php 

namespace app\controllers;

use Silex\Application;

class UserController extends ControllerBase
{
	/**
	 * User home - dashboard view
	 */
	public function index( Application $app )
	{
		$us = $app['services.user'];
		$ps = $app['services.pages'];

		$user = $us->getCurrentUser($app);
		$pages = $ps->getPagesForUser($user);

		return $app['twig']->render('/admin/main.twig', ['user' => $user, 'pages' => $pages ]);
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