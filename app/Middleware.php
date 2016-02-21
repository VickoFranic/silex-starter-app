<?php 

namespace app;

use Silex\Application;
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
	 	// Use for seomthing else
	}

 }