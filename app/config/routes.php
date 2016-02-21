<?php

/**
 **********************************
 * REGISTER APPLICATION ROUTES HERE
 **********************************
 */

$app->get('/', 'app\controllers\IndexController::index');
$app->get('/login', 'app\controllers\IndexController::login');

$app->get('/home', 'app\controllers\UserController::index');
$app->get('/home/pages', 'app\controllers\UserController::pages');


// Error handler
$app->error(function(\Exception $e, $code) use ($app) {	
	$error = array('error' => $e->getMessage());
		return $app->json($error);
});