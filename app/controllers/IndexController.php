<?php

namespace app\controllers;

use Silex\Application;

class IndexController
{

	/**
	 * @var \Twig_Environment
	 */
	protected $twig;


	public function __construct( \Twig_Environment $twig )
	{
		$this->twig = $twig;
	}

	public function index()
	{
		return $this->twig->render('hello.twig');
	}
	
}