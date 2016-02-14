<?php

/*
*****************************************************
* REGISTER ALL SERVICE PROVIDERS FOR APPLICATION HERE
*****************************************************
*/

// $app['db']
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
	'db.options' => $config['database'],
));

// $app['twig']
$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path'	=> APP_PATH . '/app/views',
));