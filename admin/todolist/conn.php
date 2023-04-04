<?php
	$conn = new mysqli("localhost", "root", "", "oytech_db");
	
	if(!$conn){
		die("Error: Cannot connect to the database");
	}
?>