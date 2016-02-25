<?php 

namespace app\controllers;

use Silex\Application;

class PageController extends ControllerBase
{
	/**
	 * Page index. 
	 * Get page facebook info.
	 */
	public function index( Application $app )
	{
		/**
		 * app\repositories\PagesRepository
		 */
		$pr = $app['repositories.pages'];

		$user = $app['session']->get('user');
		$page = $pr->findPageById($app['request']->get('page_id'));

		if ( $user->facebook_id != $page['user_id'] ) {
			return $app->redirect('/home/pages');
		}

		return $this->successResponse($page);
	}

}