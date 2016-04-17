<?php

use Symfony\Component\HttpFoundation\Request;

/**
 **********************************
 * REGISTER APPLICATION ROUTES HERE
 **********************************
 */


$app->get('/', 'app\controllers\IndexController::index');
$app->get('/login', 'app\controllers\IndexController::login');
$app->get('/logout', 'app\controllers\IndexController::logout');


# User area
$app->get('/home', 'app\controllers\UserController::index')->before('app\Middleware::user');
$app->get('/home/pages', 'app\controllers\UserController::pages')->before('app\Middleware::user');
$app->get('/home/pages/{page_id}', 'app\controllers\PageController::index')->before('app\Middleware::user')->before('app\Middleware::page');
$app->get('/home/pages/{page_id}/events', 'app\controllers\PageController::events')->before('app\Middleware::user')->before('app\Middleware::page');


# Admin area
# TODO

// Error handler
$app->error(function(\Exception $e, $code) use ($app) {	
	$error = array('error' => $e->getMessage());
		return $app->json($error);
});