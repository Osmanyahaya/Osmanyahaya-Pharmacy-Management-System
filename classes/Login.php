<?php
require_once '../config.php';
class Login extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;

		parent::__construct();
		ini_set('display_error', 1);
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function index(){
		echo "<h1>Access Denied</h1> <a href='".base_url."'>Go Back.</a>";
	}
	public function save_log($data=array()){
        // Data array paramateres
            // user_id = user unique id
            // action_made = action made by the user
            
        if(count($data) > 0){
            extract($data);
            $sql = "INSERT INTO `logs` (`user_id`,`action_made`) VALUES ('{$user_id}','{$action_made}')";
            $save = $this->conn->query($sql);
            if(!$save){
                die($sql." <br> ERROR:".$this->conn->error);
            }
        }
        return true;
    }
	public function login(){
		extract($_POST);

		$stmt = $this->conn->prepare("SELECT * from users where username = ? and password = ? ");
		$password = md5($password);
		$stmt->bind_param('ss',$username,$password);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
			foreach($result->fetch_array() as $k => $v){
				if(!is_numeric($k) && $k != 'password'){
					$this->settings->set_userdata($k,$v);
				}

			}
			$this->settings->set_userdata('login_type',1);
			$log['user_id'] = $this->settings->userdata('id');
            $log['action_made'] = "Logged in the system.";
            // audit log
            $this->save_log($log);
		return json_encode(array('status'=>'success'));

		}else{
		return json_encode(array('status'=>'incorrect','last_qry'=>"SELECT * from users where username = '$username' and password = md5('$password') "));
		}
	}
	public function logout(){
		$log['user_id'] = $this->settings->userdata('id');
        $log['action_made'] = "Logged out.";
        $this->save_log($log);
		if($this->settings->sess_des()){
			redirect('admin/login.php');
		}
	}
	function login_agent(){
		extract($_POST);
		$stmt = $this->conn->prepare("SELECT * from agent_list where email = ? and `password` = ? and delete_flag = 0 ");
		$password = md5($password);
		$stmt->bind_param('ss',$email,$password);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
			$res = $result->fetch_array();
			if($res['status'] == 1){
				foreach($res as $k => $v){
					$this->settings->set_userdata($k,$v);
				}
				$this->settings->set_userdata('login_type',2);
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = 'Your Account has been blocked.';
			}
		}else{
		$resp['status'] = 'failed';
		$resp['msg'] = 'Incorrect Email or Password';
		}
		if($this->conn->error){
			$resp['status'] = 'failed';
			$resp['_error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	public function logout_agent(){
		if($this->settings->sess_des()){
			redirect('agent');
		}
	}
}
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$auth = new Login();
switch ($action) {
	case 'login':
		echo $auth->login();
		break;
	case 'logout':
		echo $auth->logout();
		break;
	case 'login_agent':
		echo $auth->login_agent();
		break;
	case 'logout_agent':
		echo $auth->logout_agent();
		break;
	case 'save_log':
        $log['user_id'] = $_SESSION['id'];
        $log['action_made'] = $_POST['action_made'];
        echo $action->save_log($log);
    break;
	default:
		echo $auth->index();
		break;
}

