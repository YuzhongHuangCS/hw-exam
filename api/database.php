<?php
	if(defined('SAE_APPNAME')){
		$conn = new mysqli(SAE_MYSQL_HOST_M, SAE_MYSQL_USER, SAE_MYSQL_PASS, SAE_MYSQL_DB, SAE_MYSQL_PORT);
	} else{
		$conn = new mysqli('localhost', 'who', 'hY7XfCnEBYNqzmfS', 'who');
	}

	if($conn->connect_error) {
		die('Database connection failed: ' . $conn->connect_error);
	}

	$conn->query('set character set "utf8"');
	$conn->query('set names "utf8"');
