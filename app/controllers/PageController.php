<?php 

namespace app\controllers;

use Silex\Application;

class PageController extends ControllerBase
{
	/**
	 * Page index. 
	 * Get page data from db.
	 */
	public function index( Application $app )
	{
		/**
		 * app\repositories\PagesRepository
		 */
		$pr = $app['repositories.pages'];

		$user = $app['session']->get('user');
		$page = $pr->findPageById($app['request']->get('page_id'));

		return $this->successResponse($page);
	}

	/**
	 * Get all page events from facebook
	 */
	public function events( Application $app )
	{
		/**
		 * app\repositories\PagesRepository
		 */
		$pr = $app['repositories.pages'];

		/**
		 * app\services\FacebookService
		 */
		$fs = $app['services.facebook'];

		$user = $app['session']->get('user');
		$page = $pr->findPageById($app['request']->get('page_id'));

		return $fs->getEventsForPage($page);

	}
}