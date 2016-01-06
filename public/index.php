<?php	

/*
*****************************************
* THIS FILE CREATES NEW SILEX APPLICATION
*****************************************
*/

define('APP_PATH', realpath('..'));

require_once APP_PATH . '/vendor/autoload.php';

// Configuration file
$config = include APP_PATH . '/app/config/config.php';

$app = new Silex\Application();

// Get debug setup info from config
$app['debug'] = $config['debug'];

// Service providers
include APP_PATH . '/app/config/services.php';

// Application routes
include APP_PATH . '/app/config/routes.php';

// Run Silex app
$app->run();

