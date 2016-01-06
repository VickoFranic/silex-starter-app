<?php

namespace app\controllers;

use Silex\Application;

class IndexController
{

	/**
	 * @var Silex\Application $app
	 */
	protected $app;


	public function __construct( Application $app )
	{
		$this->app = $app;
	}

	public function index()
	{
		return $this->app['twig']->render('hello.twig');
	}
	
}