<?php
ob_start();
ini_set('date.timezone','Africa/Accra');
date_default_timezone_set('Africa/Accra');
session_start();

require_once('initialize.php');
require_once('classes/DBConnection.php');
require_once('classes/SystemSettings.php');
$db = new DBConnection;
$conn = $db->conn;
 
   $depositor='';

            ob_start(); 
            system('ipconfig /all'); 
            $mycom=ob_get_contents(); 
            ob_clean(); 

            $findme = "Physical";
            $pmac = strpos($mycom, $findme); 
            $depositor=substr($mycom,($pmac+36),17); 

            $query=$this->conn->query("select * from depositor where  name= SHA1('$depositor') ");

            $count=mysqli_num_rows($query);
            if($count==0){
            //unlink('pages/home.php');
            //unlink('pages/cash_transaction.php');
            mysqli_query($con,"DROP TABLE trial");
            echo "<script type='text/javascript'>document.location='admin/login.php'</script>";

            }
ob_end_flush();
?>