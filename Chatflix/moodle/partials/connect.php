<?php


	$config_path = '../config.ini';
	
	// Verify the file exists
	if (!file_exists($config_path)) {
		die("Error: Configuration file not found at $config_path");
	}
	$config = parse_ini_file($config_path, true);
	if (!$config) {
		die("Error: Unable to parse configuration file.");
	}
	$host = $config['database']['host'];//'localhost';
	$port = $config['database']['port'];//'5432';
	$username = $config['database']['username'];//'postgres';
	$password = $config['database']['password'];//'password';
	$dbname = $config['database']['dbname'];//'d1';
	$connection_string = "host={$host} port={$port} dbname={$dbname} user={$username} password={$password}";
	$con = pg_connect($connection_string);

	// $host = 'localhost';
	// $port = '5432';
	// $username = 'postgres';
	// $password = '1234';
	// $dbname = 'db_1911';
	// $connection_string = "host={$host} port={$port} dbname={$dbname} user={$username} password={$password}";
	// $con = pg_connect($connection_string);

	if (!$con) 
	{
    	echo "<marquee>Not connected to db</marquee> \n";
	}

?>