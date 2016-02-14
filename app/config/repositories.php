<?php 

/*
*****************************************************
* REGISTER ALL SERVICE PROVIDERS FOR APPLICATION HERE
*****************************************************
*/

$app['repositories.user'] = $app->share(function() use ($app) {
	return new app\repositories\UserRepository( $app['db'] );
});