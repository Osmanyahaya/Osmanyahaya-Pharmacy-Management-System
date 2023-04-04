<?php

    //error_reporting(0);

	include 'backup_function.php';
		
		$server = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'mypharmacy_db';

		
		backDb($server, $username, $password, $dbname);

		exit();
		
	

?>