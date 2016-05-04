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
	public function pages(Request $request,  Application $app )
	{
		$us = $app['services.user'];
		$ps = $app['services.pages'];

		$token = $request->get('access_token');
		$user = $us->getUserByAccessToken($token);

		return $this->successResponse($ps->getPagesForUser($user));
	}
}