<?php 

namespace app\controllers\Api;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use app\controllers\ControllerBase;

class UserController extends ControllerBase
{
	/**
	 * User pages
	 */
	public function pages( Request $request,  Application $app )
	{
		$us = $app['services.user'];
		$ps = $app['services.pages'];

		$facebook_id = $request->get('facebook_id');
		$user = $us->getUserByFacebookId($facebook_id);

		return $this->successResponse($ps->getPagesForUser($user));
	}

	public function allUsers( Request $request,  Application $app )
	{
		$ur = $app['repositories.user'];

		$users = $ur->findAll();

		if ($users)
			return $this->successResponse($users);
	}
}