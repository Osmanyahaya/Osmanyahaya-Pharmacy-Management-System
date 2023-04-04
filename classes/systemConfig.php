<?php
 $con= new mysqli('localhost','root','','oytech_db')or die("Could not connect to mysql".mysqli_error($con));
$depositor='';
ob_start(); 
system('ipconfig /all'); 
$mycom=ob_get_contents(); 
ob_clean(); 
$findme = "Physical";
$pmac = strpos($mycom, $findme); 
$depositor=substr($mycom,($pmac+36),17); 
mysqli_query($con,"CREATE TABLE depositor (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL)")or die(mysqli_error());

mysqli_query($con,"INSERT INTO depositor (name) VALUES(SHA1('$depositor'))");

?>