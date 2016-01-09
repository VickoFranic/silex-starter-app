<?php

/*
*****************************************************
* REGISTER ALL SERVICE PROVIDERS FOR APPLICATION HERE
*****************************************************
*/

// $app['twig']
$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path'	=> APP_PATH . '/app/views',
));

// $app['db']
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
	'db.options' => $config['database'],
));

$app['repository.book'] = $app->share(function() use ($app) {
	return new app\repositories\BookRepository( $app['db'] );
});