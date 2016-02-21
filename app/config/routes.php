<?php

use Symfony\Component\HttpFoundation\Request;

/**
 **********************************
 * REGISTER APPLICATION ROUTES HERE
 **********************************
 */

# Guest area
$app->get('/', 'app\controllers\IndexController::index');
$app->get('/login', 'app\controllers\IndexController::login');

# User area
$app->get('/home', 'app\controllers\UserController::index')->before('app\Middleware::user');
$app->get('/home/pages', 'app\controllers\UserController::pages');

# Admin area
# TODO

// Error handler
$app->error(function(\Exception $e, $code) use ($app) {	
	$error = array('error' => $e->getMessage());
		return $app->json($error);
});