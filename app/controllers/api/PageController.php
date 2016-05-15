<?php 

namespace app\controllers\api;

use Silex\Application;
use app\models\UserPages;
use Symfony\Component\HttpFoundation\Request;
use app\controllers\ControllerBase;

class PageController extends ControllerBase
{
	/**
	 * Get all page events from facebook for user
	 */
	public function events( Request $request, Application $app )
	{
		$us = $app['services.user'];
		$ps = $app['services.pages'];

		$token = $request->get('access_token');
		$user = $us->getUserByAccessToken($token);

		$user_pages = UserPages::findByUserId($user->facebook_id, $app);

		/**
		 * app\services\FacebookService
		 */
		$fs = $app['services.facebook'];

		$events = [];
		foreach ($user_pages as $page) {
			$pageEvents = $fs->getEventsForPageId($page->page_id);
			$events[] = $page;
		}

		return $this->successResponse($events);
	}

	public function latestPagesNotifications(Request $request, Application $app)
	{
		$us = $app['services.user'];
		$ps = $app['services.pages'];

		$token = $request->get('access_token');
		$user = $us->getUserByAccessToken($token);

		$pages = $ps->getPagesForUser($user);

		/**
		 * app\services\FacebookServices
		 */
		$fs = $app['services.facebook'];

		$notifications = $fs->getLatestNotificationForPages($user->facebook_id, $pages);

		return $this->successResponse($notifications);
	}

}