<?php

namespace app\controllers;

use Silex\Application;

/**
 * Index controller 
 *
 */

class IndexController
{
	
	/**
	 * Home page action - renders Twig template with all books in database
	 */
	public function index( Application $app )
	{
		// Book repository
		$br = $app['repository.book'];

		// Get all books from DB
		$books = $br->findAll();

		return $app['twig']->render('home.twig', ['books' => $books]);
	}
	
}