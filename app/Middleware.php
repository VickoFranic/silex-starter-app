<?php 

namespace app;

use Silex\Application;
use app\repositories\PagesRepository;
use Symfony\Component\HttpFoundation\Request;

 /**
 * Custom application middleware
 */
 
 class Middleware
 {
 	/**
 	 * User middleware. Redirect to index page if user not logged in
 	 */
	function user(Request $req, Application $app)
	{
	 	if (! $app['session']->get('user')) {
	 		return $app->redirect('/');
	 	}
	}

 	/**
 	 * Page middleware. Redirect to pages list if page doesn`t belong to logged in user.
 	 */
	function page(Request $req, Application $app)
	{
		/**
		 * app\repositories\PagesRepository
		 */
		$pr = $app['repositories.pages'];
		$user = $app['session']->get('user');

		if (! $pr->pageBelongsToUser($user->facebook_id, $req->get('page_id')) ) {
			return $app->redirect('/home/pages');
		}

	}

 }