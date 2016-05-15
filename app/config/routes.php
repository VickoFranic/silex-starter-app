<?php

use Symfony\Component\HttpFoundation\Request;

/**
 **********************************
 * REGISTER APPLICATION ROUTES HERE
 **********************************
 */

# API
 $app->post('/api/user/pages', 'app\controllers\api\PageController::events');
 $app->get('/api/users', 'app\controllers\api\UserController::allUsers');
$app->get('/api/pages/{facebook_id}', 'app\controllers\api\UserController::pages');

 $app->post('/api/user/notifications', 'app\controllers\api\PageController::latestPagesNotifications');


//$app->get('/home/pages/{page_id}', 'app\controllers\PageController::index')->before('app\Middleware::user')->before('app\Middleware::page');
//$app->get('/home/pages/{page_id}/events', 'app\controllers\PageController::events')->before('app\Middleware::user')->before('app\Middleware::page');



# User area
$app->get('/', 'app\controllers\IndexController::index');
$app->get('/login', 'app\controllers\IndexController::login');
$app->get('/logout', 'app\controllers\IndexController::logout');
$app->get('/home', 'app\controllers\UserController::index')->before('app\Middleware::user');


# Admin area
# TODO


// Error handler
$app->error(function(\Exception $e, $code) use ($app) {	
	$error = array('error' => $e->getMessage());
		return $app->json($error);
});