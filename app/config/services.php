<?php

use Facebook\Facebook;

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

$app->register(new Silex\Provider\SessionServiceProvider());

/*
*************************
* USER DEFINED SERVICES
*************************
*/

# REPOSITORIES

$app['repositories.user'] = $app->share(function() use ($app) {
	return new app\repositories\UserRepository( $app['db'] );
});

$app['repositories.pages'] = $app->share(function() use ($app) {
	return new app\repositories\PagesRepository( $app['db'] );
});

$app['repositories.facebook'] = $app->share(function() use ($app, $config) {
	$fb = new Facebook($config['facebook']);
	return new app\repositories\FacebookRepository( $fb, $config, $app['services.user'], $app['repositories.pages'], $app );
});

# SERVICES

$app['middleware'] = $app->share(function() {
	return new app\Middleware();
});

$app['services.user'] = $app->share(function() use ($app) {
	return new app\services\UserService( $app['repositories.user'] );
});

$app['services.pages'] = $app->share(function() use ($app) {
	return new app\services\PagesService( $app['repositories.pages'] );
});

$app['services.facebook'] = $app->share(function() use ($app) {
	return new app\services\FacebookService( $app['repositories.facebook'], $app['services.user'], $app['services.pages'] );
});
