<?php	

/*
*****************************************
* THIS FILE CREATES NEW SILEX APPLICATION
*****************************************
*/

// Vendor autoloader
require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

// Configuration file
$config = include __DIR__ . '/../app/config/config.php';

// Application routes
include __DIR__ . '/../app/config/routes.php';

// Get debug setup info from config
$app['debug'] = $config['debug'];

// Run Silex app
$app->run();

