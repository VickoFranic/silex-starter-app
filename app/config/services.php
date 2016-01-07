<?php

/*
*****************************************************
* REGISTER ALL SERVICE PROVIDERS FOR APPLICATION HERE
*****************************************************
*/

$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path'	=> APP_PATH . '/app/views',
));

// Controllers as a service - Silex philosophy
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

// app\controllers\IndexController
$app['index.controller'] = $app->share(function() use ($app) {
	return new app\controllers\IndexController( $app['twig'] );
});