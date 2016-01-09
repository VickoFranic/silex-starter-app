<?php 

/*
******************************************************
* THIS IS MAIN CONFIGURATION FILE FOR THE APPLICATION
******************************************************
*/	
	return [
		// Change to false for production !
		'debug'	=> true,

		//database configuration
		'database' => array(
			'driver'	=> 'pdo_mysql',
			'dbname'	=> 'your_database_name',
			'host'		=> 'localhost',
			'user'		=> 'root',
			'password'	=> 'root'
		),


	];
