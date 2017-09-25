<?php

// This is the database connection configuration.
return array(
	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//	 uncomment the following lines to use a MySQL database
	'connectionString' => 'silva.computing.dundee.ac.uk;dbname=ip17team8db',
	'emulatePrepare' => true,
	'username' => 'ip17team8',
	'password' => '6593.ip17t.3956',
	'charset' => 'utf8',
);

//return array(
//	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
////	 uncomment the following lines to use a MySQL database
//	'connectionString' => 'mysql:host=localhost;dbname=mydb',
//	'emulatePrepare' => true,
//	'username' => 'root',
//	'password' => 'root',
//	'charset' => 'utf8',
//);