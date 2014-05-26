<?php 

class DATABASE_CONFIG {

	public $default = array(
		'driver' => 'mysql', 
		'persistent' => true, 
		'host' => 'localhost', 
		'login' => 'root', 
		'password' => 'ABC!@#', 
		'database' => 'qicake', 
		'encoding'=> 'utf8', 
		'prefix' => ''
	);

	public $test = array(
		'driver' => 'mysql',
		'persistent' => true,
		'host' => 'localhost',
		'login' => 'root',
		'password' => 'root',
		'database' => 'test',
		'encoding'=> 'utf8',
		'prefix' => ''
	);

	public $stat = array(
		'driver' => 'mysql',
		'persistent' => true,
		'host' => 'localhost',
		'login' => 'username',
		'password' => 'password',
		'database' => 'logoloto',
		'encoding'=> 'utf8',
		'prefix' => ''
	);
}
?>
