<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function delete_img(){
		extract($_POST);
		if(is_file($path)){
			if(unlink($path)){
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['error'] = 'failed to delete '.$path;
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = 'Unkown '.$path.' path';
		}
		return json_encode($resp);
	}
	function save_service(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `service_list` where `name` = '{$name}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Service Name already exists.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `service_list` set {$data} ";
		}else{
			$sql = "UPDATE `service_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$bid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Service successfully saved.";
			else
				$resp['msg'] = " Service successfully updated.";
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	//
	function save_expense(){
		$_POST['user_id'] = $this->settings->userdata('id');
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('expense_id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		
		if(empty($expense_id)){
			$sql = "INSERT INTO `expense` set {$data} ";
		}else{
			$sql = "UPDATE `expense` set {$data} where expense_id = '{$expense_id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$bid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Expense successfully saved.";
			else
				$resp['msg'] = " Expense successfully updated.";
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	//
	function update_todo(){
		$id=$_POST['id'];
		
			$sql = "UPDATE `task` set status='Done' where task_id = '$id' ";
			$save = $this->conn->query($sql);
		if($save){
			
			$resp['status'] = 'success';
			
			$resp['msg'] = "Task Updated.";
			
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	//
	function delete_todo(){
		$id=$_POST['id'];
		
			$sql = "DELETE FROM `task` where task_id = '$id'";
			$save = $this->conn->query($sql);
		if($save){
			
			$resp['status'] = 'success';
			
			$resp['msg'] = "Task Deleted.";
			
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	//
	function save_todo(){
		$_POST['user_id'] = $this->settings->userdata('id');
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('task_id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `task` where `task` = '{$task}' ".(!empty($task_id) ? " and task_id != {$task_id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Todo already exists.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `task` set {$data} ";
		}else{
			$sql = "UPDATE `task` set {$data} where task_id = '{$task_id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Task successfully saved.";
			else
				$resp['msg'] = " Todo successfully updated.";
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_service(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `service_list` set `delete_flag` = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Service successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	//
	function delete_expense(){
		$id=$_POST['id'];
		$del = $this->conn->query("DELETE  FROM expense where expense_id = '$id'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Expense successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	//
	function save_mechanic(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `mechanic_list` where `firstname` = '{$firstname}' and `middlename` = '{$middlename}' and `lastname` = '{$lastname}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Mechanic already exists.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `mechanic_list` set {$data} ";
		}else{
			$sql = "UPDATE `mechanic_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$bid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Mechanic successfully saved.";
			else
				$resp['msg'] = " Mechanic successfully updated.";
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_mechanic(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `mechanic_list` set `delete_flag` = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Mechanic successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_product(){
		
		
		extract($_POST);

		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('prod_id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `product` where `prod_name` = '{$prod_name}' ".(!empty($prod_id) ? " and prod_id != {$prod_id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Product Name already exists.";
			return json_encode($resp);
			exit;
		}
		if(empty($prod_id)){
			$sql = "INSERT INTO `product` set {$data} ";
		}else{
			$sql = "UPDATE `product` set {$data} where prod_id = '{$prod_id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$pid = !empty($prod_id) ? $prod_id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($prod_id))
				$resp['msg'] = "New Product successfully saved.";
			else
				$resp['msg'] = " Product successfully updated.";
			if(!empty($_FILES['img']['tmp_name'])){
				$dir = 'uploads/products/';
				if(!is_dir(base_app.$dir))
				mkdir(base_app.$dir);
				$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
				$fname = $dir.$pid.".png";
				$accept = array('image/jpeg','image/png');
				if(!in_array($_FILES['img']['type'],$accept)){
					$resp['msg'] .= "Image file type is invalid";
				}
				if($_FILES['img']['type'] == 'image/jpeg')
					$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
				elseif($_FILES['img']['type'] == 'image/png')
					$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
				if(!$uploadfile){
					$resp['msg'] .= "Image is invalid";
				}
				list($width, $height) = getimagesize($_FILES['img']['tmp_name']);
				if($width > 640 || $height > 480){
					if($width > $height){
						$perc = ($width - 640) / $width;
						$width = 640;
						$height = $height - ($height * $perc);
					}else{
						$perc = ($height - 480) / $height;
						$height = 480;
						$width = $width - ($width * $perc);
					}
				}
				$temp = imagescale($uploadfile,$width,$height);
				if(is_file(base_app.$fname))
				unlink(base_app.$fname);
				$upload =imagepng($temp,base_app.$fname,6);
				if($upload){
					$this->conn->query("UPDATE `product_list` set image_path = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$pid}' ");
				}
				imagedestroy($temp);
			}
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function save_istockin(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `stockin` set {$data} ";
		}else{
			$sql = "UPDATE `stockin` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$bid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Stock has been saved successfully.";
			else
				$resp['msg'] = " Stock has been updated successfully.";
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_stockin(){
		extract($_POST);
		$qty=$_POST['qty'];
		$prodid=$_POST['prodid'];
		$resp['error'] = $prodid;
		$del = $this->conn->query("DELETE FROM `stockin_cart` where stockin_id = '{$id}'");

		if($del){
			$this->conn->query("UPDATE `product` SET prod_qty=prod_qty-'$qty' where prod_id = '{$prodid}'");
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Stock has been deleted successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function delete_product(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `product` where prod_id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Product successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	///
	function save_transaction(){
		
		if(empty($_POST['id'])){
			$_POST['user_id'] = $this->settings->userdata('id');
			$userid=$this->settings->userdata('id');
			$prefix = date("ymd");
			$code = sprintf("%'.04d", 1);
			while(true){
				$check = $this->conn->query("SELECT * FROM `transaction_list` where code = '{$prefix}{$code}' ")->num_rows;
				if($check > 0){
					$code = sprintf("%'.04d", abs($code) + 1);
				}else{
					$_POST['code'] = $prefix.$code;
					break;
				}
			}
		}
		extract($_POST);
		$tid=$_POST['code'];
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id')) && !is_array($_POST[$k])){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$this->conn->begin_transaction();
		try {

		if(empty($id)){
			$sql = "INSERT INTO `transaction_list` set {$data}";
		}else{
			$sql = "UPDATE `transaction_list` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		//transaction id
		$tid=0;
		if($save){
			$tid = $this->conn->insert_id;
			$query=$this->conn->query("select * from cart where user_id='$userid'");
		foreach ($query as $row)
		{
			$pid=$row['prod_id'];	
 			$qty=$row['quantity'];
 			$price=$row['price'];
			
			$save2= $this->conn->query("INSERT INTO transaction_products(product_id,qty,transaction_id,price) VALUES('$pid','$qty','$tid','$price')");

			$update =$this->conn->query("UPDATE product SET prod_qty=prod_qty-'$qty' where prod_id='$pid'"); 
		}
		  	
		
		$delete=$this->conn->query("DELETE FROM cart WHERE user_id='$userid' ");
				
		}



		
		if( $this->conn->commit()){
			$resp['tid'] = $tid;
			$resp['status'] = 'success';
			$resp['msg'] = "New Transaction successfully saved.";
		}

		
		
		} 
		catch (mysqli_sql_exception $exception) 
		{
		$this->conn->rollback();

		throw $exception;
		$resp['msg'] = "Transaction has failed save.";
		$this->settings->set_flashdata('error',$resp['msg']);
			return json_encode($resp);
		
		}	
		
			
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	//
	function save_stockin(){
		
		if(empty($_POST['id'])){
			$_POST['user_id'] = $this->settings->userdata('id');
			$userid=$this->settings->userdata('id');
			$prefix = date("ym");
			$code = sprintf("%'.03d", 1);
			while(true){
				$check = $this->conn->query("SELECT * FROM `stock_list` where sid = '{$prefix}{$code}'")->num_rows;
				if($check > 0){
					$code = sprintf("%'.03d", abs($code) + 1);
				}else{
					$_POST['sid'] = $prefix.$code;
					break;
				}
			}
		}
		extract($_POST);
		$sid=$_POST['sid'];
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id')) && !is_array($_POST[$k])){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$this->conn->begin_transaction();
		try {
		if(empty($id)){
			$sql = "INSERT INTO `stock_list` set{$data}";
		}else{
			$sql = "UPDATE `stock_list` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		//transaction id
		if($save){
			$exdate='';$exdate2='';
			$query=$this->conn->query("select * from stockin_cart where	user_id='$userid	'");
				foreach ($query as $row){
					$pid=$row['prod_id'];	
 					$qty=$row['qty'];
 					$costprice=$row['cost_price'];
 					$supplier=$row['supplier_id'];
 					$exdate3=$row['prod_exdate'];

					if(!empty($exdate3)){
					$exdate = $exdate3;
					$exdate2=date('Y-m-d', strtotime($exdate. '-31 days'));
					$this->conn->query("UPDATE product SET exdate='$exdate',exdate2='$exdate2' where prod_id='$pid'");
					 	$exdate3='';
							}

					 $this->conn->query("INSERT INTO stockin(prod_id,qty,supplier_id,prod_exdate,stockin_id,cost_price) VALUES('$pid','$qty','$supplier','$exdate','$sid','$costprice')");

					$update =$this->conn->query("UPDATE product SET prod_qty=prod_qty+'$qty' where prod_id='$pid'"); 
		}
		  	
		
		$delete=$this->conn->query("DELETE FROM stockin_cart where user_id='$userid'");
				
		}
		
		if( $this->conn->commit()){
			$resp['sid'] = $sid;
			$resp['data'] = $data;
			$resp['status'] = 'success';
			$resp['msg'] = "New Stock successfully saved.";
		}

		
		
		} 
		catch (mysqli_sql_exception $exception) 
		{
		$this->conn->rollback();

		throw $exception;
		$resp['msg'] = "Transaction has failed save.";
		$this->settings->set_flashdata('error',$resp['msg']);
			return json_encode($resp);
		
		}	
		
			
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	//
	/*function save_transaction(){
		if(empty($_POST['id'])){
			$_POST['user_id'] = $this->settings->userdata('id');
			$userid=$this->settings->userdata('id');
			$prefix = date("ymd");
			$code = sprintf("%'.04d", 1);
			while(true){
				$check = $this->conn->query("SELECT * FROM `transaction_list` where code = '{$prefix}{$code}' ")->num_rows;
				if($check > 0){
					$code = sprintf("%'.04d", abs($code) + 1);
				}else{
					$_POST['code'] = $prefix.$code;
					break;
				}
			}
		}
		extract($_POST);
		$tid=$_POST['code'];
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id')) && !is_array($_POST[$k])){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$this->conn->begin_transaction();
		try {

		if(empty($id)){
			$sql = "INSERT INTO `transaction_list` set {$data} ";
		}else{
			$sql = "UPDATE `transaction_list` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		//transaction id
		$tid=0;
		if($save){
			$tid = $this->conn->insert_id;
			$query=$this->conn->query("select * from cart where user_id='$userid'");
		foreach ($query as $row)
		{
			$pid=$row['prod_id'];	
 			$qty=$row['quantity'];
			
			$save2= $this->conn->query("INSERT INTO transaction_products(product_id,qty,transaction_id) VALUES('$pid','$qty','$tid')");

			$update =$this->conn->query("UPDATE product SET prod_qty=prod_qty-'$qty' where prod_id='$pid'"); 
		}	  	
		
		$delete=$this->conn->query("DELETE FROM cart ");
		}
		
		if( $this->conn->commit()){
			$resp['tid'] = $tid;
			$resp['status'] = 'success';
			$resp['msg'] = "New Transaction successfully saved.";
		}

		} 
		catch (mysqli_sql_exception $exception) 
		{
		$this->conn->rollback();

		throw $exception;
		$resp['msg'] = "Transaction has failed save.";
		$this->settings->set_flashdata('error',$resp['msg']);
			return json_encode($resp);
		
		}	
		
			
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}*/


	//
	function save_bills(){

		$pid=$_POST['patientkkk_id'];
		if(empty($_POST['id'])){
			$_POST['user_id'] = $this->settings->userdata('id');
			$userid=$this->settings->userdata('id');
			$prefix = date("ymd");
			$code = sprintf("%'.04d", 1);
			while(true){
				$check = $this->conn->query("SELECT * FROM `transaction_list` where code = '{$prefix}{$code}' ")->num_rows;
				if($check > 0){
					$code = sprintf("%'.04d", abs($code) + 1);
				}else{
					$_POST['code'] = $prefix.$code;
					break;
				}
			}
		}
		extract($_POST);
		$tid=$_POST['code'];
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id')) && !is_array($_POST[$k])){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}

		$this->conn->autocommit(FALSE);
		
		if(empty($id)){
			$sql = "INSERT INTO `transaction_list` set {$data}";
		}else{
			$sql = "UPDATE `transaction_list` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		//transaction id
		$tid=0;
		if($save){
			$tid = $this->conn->insert_id;
			$query=$this->conn->query("select * from pres_cart where patient_id='$pid'");
		foreach ($query as $row)
		{
			$proid=$row['prod_id'];	
 			$qty=$row['quantity'];

 			$save2= $this->conn->query("INSERT INTO transaction_products(product_id,qty,transaction_id) VALUES('$proid','$qty','$tid')");

			$update =$this->conn->query("UPDATE product SET prod_qty=prod_qty-'$qty' where prod_id='$proid'"); 
		}
		//Service Transaction save
		$query=$this->conn->query("select * from service_cart where patient_id='$pid'");
		foreach ($query as $row)
		{
			$serviceid=$row['service_id'];	
			$save2= $this->conn->query("INSERT INTO transaction_services(service_id,transaction_id) VALUES('$serviceid','$tid')");
		}	  	
		
		$this->conn->query("DELETE FROM pres_cart WHERE patient_id='$pid'");
			$this->conn->query("DELETE FROM service_cart WHERE patient_id='$pid' ");
		}
		//transaction id

		if($this->conn->commit()){
			$resp['tid'] = $tid;
			$resp['cid'] = $pid;
			$resp['status'] = 'success';
			$resp['msg'] = "New Transaction successfully saved.";
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
		}
		else{
			$resp['status'] = 'failed';
			$resp['msg'] = "Transaction has failed save.";
		$this->settings->set_flashdata('error',$resp['msg']);
			return json_encode($resp);
		}
	}
	//save Patient
	function save_patient(){
			$date = date("Y-m-d H:i:s");

			$_POST['user_id'] = $this->settings->userdata('id');
			$prefix = date("Y");
			$code = sprintf("%'.04d", 1);
			while(true){
				$check = $this->conn->query("SELECT * FROM `patient` where patient_id = '{$prefix}{$code}' ")->num_rows;
				if($check > 0){
					$code = sprintf("%'.04d", abs($code) + 1);
				}else{
					$_POST['patient_id'] = $prefix.$code;
					break;
				}
			}
		$_POST['date_created']=$date;
		extract($_POST);

		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id')) && !is_array($_POST[$k])){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$this->conn->autocommit(FALSE);
		//$this->conn->begin_transaction();
		

		if(empty($id)){
			$sql = "INSERT INTO `patient` set {$data}";
		}else{
			$sql = "UPDATE `patient` set {$data} where id = '{$id}' ";
		}

		$this->conn->query($sql);
		//transaction id
		if ($this->conn->commit()) {
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Patient successfully saved.";
			else
				$resp['msg'] = "Patient successfully updated.";
		$this->settings->set_flashdata('err',$resp['msg']);
			return json_encode($resp);
			exit();	
		}
		else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
			$resp['msg'] = "Transaction has failed save.";	
		}
		
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
		$this->conn -> close();
	}
		//save Patient
	function save_vital_sign(){
			//get today's date and time store in the Post array
			$date = date("Y-m-d H:i:s");
			$_POST['user_id'] = $this->settings->userdata('id');
			$userid=$this->settings->userdata('id');
			
		$_POST['date_created']=$date;
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id')) && !is_array($_POST[$k])){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$this->conn->begin_transaction();
		try {

		if(empty($id)){
			$sql = "INSERT INTO `vital_sign` set {$data}";
		}else{
			$sql = "UPDATE `vital_sign	` set {$data} where vital_tbl_id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		//transaction id
		
		if( $this->conn->commit()){
			$resp['status'] = 'success';
			$resp['msg'] = "Data successfully saved.";
		}
		} 
		catch (mysqli_sql_exception $exception) 
		{
		$this->conn->rollback();

		throw $exception;
		$resp['msg'] = "Saving has failed.";
		$this->settings->set_flashdata('error',$resp['msg']);
			return json_encode($resp);
		
		}	
	if($resp['status'] == 'success'){
			$this->settings->set_flashdata('success',$resp['msg']);
					return json_encode($resp);
	}
}

	function add_to_cart(){
			$resp = array('status'=>'','msg'=>'');

			$id = $_POST['prodid'];
			$quantity = $_POST['quantity'];
			$user=$this->settings->userdata('id');
			
				$check = $this->conn->query("SELECT * FROM `cart` where prod_id='$id'")->num_rows;
				if($check < 1){
					$stmt = $this->conn->query("SELECT prod_qty,prod_price FROM product WHERE  prod_id='$id'");
					$row = $stmt->fetch_assoc();
					$qty = $row['prod_qty'];
					$price = $row['prod_price'];
			
					if($quantity<$qty || $quantity==$qty ){

						$stmt = $this->conn->query("INSERT INTO cart (user_id, prod_id, quantity,price) VALUES ('$user', '$id', '$quantity','$price')");
						$resp['status'] ='success';
						$resp['msg'] = 'Item added to cart';
						}
						else{
							$resp['status'] = 'failed';
							$resp['msg'] = "Quantity Picked More Than Available";
						}
					

				}

				else{
					$resp['status'] = 'failed';
			
					$resp['msg'] = "Product already exists.";
				}
			
			return json_encode($resp);
	}
	//
	function add_to_prescription_cart(){
			$resp = array('status'=>'','msg'=>'');
			$pid = $_POST['pid'];
			$id = $_POST['prodid'];
			$quantity = $_POST['qty'];
			$user=$this->settings->userdata('id');
				$check = $this->conn->query("SELECT * FROM `pres_cart` where prod_id='$id' and patient_id='$pid'")->num_rows;
				if($check < 1){
					$stmt = $this->conn->query("SELECT prod_qty FROM product WHERE  prod_id='$id'");
					$row = $stmt->fetch_assoc();
					$qty = $row['prod_qty'];
			
					if($quantity<$qty || $quantity==$qty ){

						$stmt = $this->conn->query("INSERT INTO pres_cart (user_id, prod_id,patient_id,quantity) VALUES ('$user', '$id', '$pid','$quantity')");
						$resp['status'] ='success';
						$resp['msg'] = 'Item added to cart';
						}
						else{
							$resp['status'] = 'failed';
							$resp['msg'] = "Quantity Picked More Than Available";
						}
					

				}

				else{
					$resp['status'] = 'failed';
			
					$resp['msg'] = " Product already exists.";
				}
			
			return json_encode($resp);

	}
	//

	//
	function add_to_service_cart(){
			$pid=$_SESSION['bpid'];
			$resp = array('status'=>'','msg'=>'');
			$id = $_POST['serviceid'];
			//$quantity = $_POST['quantity'];
			$user=$this->settings->userdata('id');
			
				$check = $this->conn->query("SELECT * FROM `service_cart` where service_id='$id'")->num_rows;
				if($check < 1){

						$stmt = $this->conn->query("INSERT INTO service_cart (user_id, service_id,patient_id) VALUES ('$user', '$id','$pid')");
						$resp['status'] ='success';
						$resp['msg'] = 'Item added to cart';

				}

				else{
					$resp['status'] = 'failed';
			
					$resp['msg'] = " Product already exists.";
				}
			
			return json_encode($resp);
	}
	//

	function save_service_transaction(){
		if(empty($_POST['id'])){
			
			$_POST['user_id'] = $this->settings->userdata('id');
			$prefix = date("ymd");
			$code = sprintf("%'.04d", 1);
			while(true){
				$check = $this->conn->query("SELECT * FROM `service_transaction_list` where code = '{$prefix}{$code}' ")->num_rows;
				if($check > 0){
					$code = sprintf("%'.04d", abs($code) + 1);
				}else{
					$_POST['code'] = $prefix.$code;
					break;
				}
			}
		}
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id')) && !is_array($_POST[$k])){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		
		if(empty($id)){
			$sql = "INSERT INTO `service_transaction_list` set {$data} ";
		}else{
			$sql = "UPDATE `service_transaction_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$tid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['tid'] = $tid;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Transaction successfully saved.";
			else
				$resp['msg'] = " Transaction successfully updated.";
			
			if(isset($service_id)){
				$data = "";
				foreach($service_id as $k =>$v){
					$sid = $v;
					$price = $this->conn->real_escape_string($service_price[$k]);
					if(!empty($data)) $data .= ", ";
					$data .= "('{$tid}', '{$sid}', '{$price}')";
				}
				if(!empty($data)){
					$this->conn->query("DELETE FROM `transaction_services` where transaction_id = '{$tid}'");
					$sql_service = "INSERT INTO `transaction_services` (`transaction_id`, `service_id`, `price`) VALUES {$data}";
					$save_services = $this->conn->query($sql_service);
					if(!$save_services){
						$resp['status'] = 'failed';
						$resp['sql'] = $sql_service;
						$resp['error'] = $this->conn->error;
						if(empty($id)){
							$resp['msg'] = "Transaction has failed save.";
							$this->conn->query("DELETE FROM `transaction_services` where transaction_id = '{$tid}'");
						}else{
							$resp['msg'] = "Transaction has failed update.";
						}
						return json_encode($resp);
					}
				}
			}
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	//
	function stockin_cart_add(){
		$sql2='';
		$_POST['user_id'] = $this->settings->userdata('id');
		if(isset($_POST['qty'])){
		$qty2=$this->conn->real_escape_string($_POST['qty']);
		}
		if(isset($_POST['prod_exdate'])){
		$exdate=$this->conn->real_escape_string($_POST['prod_exdate']);
		}
		$prodid=$_POST['prod_id'];
		$query=$this->conn->query("select * from product where	prod_id='$prodid'");
				foreach ($query as $row){
					$_POST['cost_price']=$row['prod_cprice'];	
 				}
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}

		if(empty($id)){
			
			$sql = "INSERT INTO `stockin_cart` set {$data}";
			
			
		}else{
			$sql = "UPDATE `stockin_cart` set {$data} where stockin_id = '{$stockin_id}' ";
			$sql2 = "UPDATE `product` set prod_qty=prod_qty-'$qty2' where prod_id = '{$prod_id}' ";
		
		}
			$save = $this->conn->query($sql);
		if($save){
			$bid = !empty($stockin_id) ? $stockin_id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($stockin_id))
				$resp['msg'] = "Item added to stock cart.";
			else
				$resp['msg'] = "Updated successfully.";
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	//
	/*function delete_transaction(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `transaction_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Transaction successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}*/
	//
	function save_price_change(){
		$prodid=$this->conn->real_escape_string($_POST['prod_id']);
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('prod_id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		
			$sql = "UPDATE `product` set {$data}  where prod_id = '{$prodid}' ";
		
			$save = $this->conn->query($sql);
			
		if($save){
			
			$resp['status'] = 'success';
			
		$resp['msg'] = " Product price has been updated successfully.";
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	//
	function save_consulting(){
		$date = date("Y-m-d H:i:s");
		$_POST['date_created']=$date;
			$_POST['user_id'] = $this->settings->userdata('id');
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('prod_id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		
			$sql = "INSERT INTO `consulting` set {$data}";
		
			$save = $this->conn->query($sql);
			
		if($save){
			
			$resp['status'] = 'success';
			
		$resp['msg'] = "Data saved successfully.";
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	//
	function delete_transaction(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `transaction_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Transaction successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	//
	function update_status(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `transaction_list` set `status` = '{$status}' where id = '{$id}'");
		if($update){
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "Transaction's status has failed to update.";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success', 'Transaction\'s Status has been updated successfully.');
		return json_encode($resp);
	}



function get_cart_details(){
	$output=array('tabledata'=>'','product_total'=>0);
	
	$user= $this->settings->userdata('id');

	$prodtotal = 0; $subtotal = 0;
			$stmt = $this->conn->query("SELECT *, cart.id AS cartid FROM cart LEFT JOIN product ON product.prod_id=cart.prod_id WHERE user_id='$user' order by cart.id desc");
			foreach($stmt as $row){
				
				$subtotal = $row['prod_price']*$row['quantity'];
				$prodtotal += $subtotal;
				$output['tabledata'].= "
					<tr>
						<td><button type='button' data-id='".$row['cartid']."' class='btn btn-danger btn-flat cart_delete'><i class='fas fa-trash text-white'></i></button></td>
						
						<td>
						".$row['prod_name']."
						<input type='hidden' name='product_id[]' value='".$row['prod_id']."'>
   						 <input type='hidden' name='product_price[]' value='".$row['prod_price']."'>
						</td>
						<td>".number_format($row['prod_price'], 2)."</td>
						<td class='input-group'>
							<span class='input-group-btn'>
            					<button type='button' id='minus' class='btn btn-default btn-flat minus' data-id='".$row['cartid']."'><i class='fas fa-minus text-blue'></i></button>
            				</span>
            				<input  type='text' class='form-control cart-item' size='5px' name='product_qty[]' value='".$row['quantity']."' id='qty_".$row['cartid']."' data-id='".$row['cartid']."'>
				            <span class='input-group-btn'>
				                <button type='button' id='add' class='btn btn-default btn-flat add' data-id='".$row['cartid']."'><i class='fas fa-plus text-blue'></i>
				                </button>
				            </span>
						</td>
						<td class='sub-total'>".number_format($subtotal, 2)."</td>
					</tr>
				";
			}
			$output['tabledata'] .= "
				<tr>
					<td colspan='4' align='right'><b>Total (GHc)</b></td>
					<td><b>".number_format($prodtotal, 2)."</b></td>
				<tr>
			";

		


		$output['product_total']=round($prodtotal,2);
	echo json_encode($output);


}

///
function get_bills_details(){
	$output=array('product_tabledata'=>'','service_tabledata'=>'','product_total'=>0,'service_total'=>0);
	$pid=$_SESSION['bpid'];
	$user= $this->settings->userdata('id');
	
	$prodtotal = 0; $subtotal = 0;
			$stmt = $this->conn->query("SELECT *, pres_cart.id AS cartid FROM pres_cart LEFT JOIN product ON product.prod_id=pres_cart.prod_id WHERE patient_id='$pid' order by pres_cart.id desc");
			foreach($stmt as $row){
				
				$subtotal = $row['prod_price']*$row['quantity'];
				$prodtotal += $subtotal;
				$output['product_tabledata'].= "
					<tr>
						
						
						<td>
						".$row['prod_name']."
						
   						 
						</td>
						<td>".number_format($row['prod_price'], 2)."</td>
						<td >
							
            				".$row['quantity']." 
						</td>
						<td class='sub-total'>".number_format($subtotal, 2)."</td>
					</tr>
				";
			}
			$output['product_tabledata'] .= "
				<tr>
					<td colspan='3' align='right'><b>Total (GHc)</b></td>
					<td><b>".number_format($prodtotal, 2)."</b></td>
				<tr>
			";

		//Service Table Data
			$servtotal = 0; $subtotal = 0;
			$stmt = $this->conn->query("SELECT *, service_cart.id AS cartid FROM service_cart LEFT JOIN service_list ON service_list.id=service_cart.service_id WHERE patient_id='$pid' order by service_cart.id desc");
			foreach($stmt as $row){
				
				$subtotal = $row['price'];
				$servtotal += $subtotal;
				$output['service_tabledata'].= "
					<tr>
						<td><button type='button' data-id='".$row['cartid']."' class='btn btn-danger btn-flat cart-delete'><i class='fas fa-trash text-white'></i></button></td>
						
						<td>
						".$row['name']."
						<input type='hidden' name='product_id[]' value='".$row['id']."'>
   					
						</td>
						<td class='service-price'>".number_format($row['price'], 2)."</td>
						
					</tr>
				";
			}
			$output['service_tabledata'] .= "
				<tr>
					<td colspan='2' align='right'><b>Total (GHc)</b></td>
					<td><b>".number_format($servtotal, 2)."</b></td>
				<tr>
			";

		$output['service_total']=round($servtotal,2);


		$output['product_total']=round($prodtotal,2);
	echo json_encode($output);


}
///
function get_pharm_details(){
	//session_start();
	$output=array('product_tabledata'=>'','product_total'=>0);
	$pid=$_SESSION['ppid'];
	$prodtotal = 0; $subtotal = 0; $subtotal2 = 0;

			$stmt = $this->conn->query("SELECT *, pres_cart.id AS cartid FROM pres_cart LEFT JOIN product ON product.prod_id=pres_cart.prod_id WHERE patient_id='$pid' order by pres_cart.id desc");
			foreach($stmt as $row){
				$status= $row['status'] ? "<span  data-id='".$row['cartid']."' class='btn btn-success btn-flat'><i class='fas fa-check text-white'></i></span>" : "<button type='button' data-id='".$row['cartid']."' class='btn btn-success btn-flat cart_status'><i class='fas fa-plus text-white'></i></button>";
				
				$subtotal = $row['prod_price']*$row['quantity'];
				if($row['status']==1){
					$subtotal2 = $row['prod_price']*$row['quantity'];
					$prodtotal += $subtotal2;
				}
				
				$output['product_tabledata'].= "
					<tr>
					<td>".$status."</td>
						<td>
						".$row['prod_name']."
						<input type='hidden' name='product_id[]' value='".$row['prod_id']."'>
   						 <input type='hidden' name='product_price[]' value='".$row['prod_price']."'>
						</td>
						<td>".number_format($row['prod_price'], 2)."</td>
						<td class='input-group'>
							
            				<input  type='number' class='form-control cart-item' name='product_qty[]' value='".$row['quantity']."' id='qty_".$row['cartid']."' data-id='".$row['cartid']."'>
				            
						</td>
						<td class='sub-total'>".number_format($subtotal, 2)."</td>
					</tr>
				";
			}
			$output['product_tabledata'] .= "
				<tr>
					<td colspan='4' align='right'><b>Total (GHc)</b></td>
					<td><b>".number_format($prodtotal, 2)."</b></td>
				<tr>
			";

		$output['product_total']=round($prodtotal,2);
	echo json_encode($output);


}
function get_todolist(){
	//session_start();
	$output=array('todolist'=>'');
	$user= $this->settings->userdata('id');
	

			$stmt = $this->conn->query("SELECT * FROM todolist WHERE user_id='$user'");
			
				foreach($stmt as $row){
					$status= $row['status'] ? '<input checked type="checkbox" value="'.$row['status'].'" name="todo'.$row['id'].'" id="todoCheck'.$row['id'].'">' : '<input  type="checkbox" value="'.$row['status'].'" name="todo'.$row['id'].'" id="todoCheck'.$row['id'].'">';
				$output['todolist'].= '
				<li>
          
                   <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <div  class="icheck-primary d-inline ml-2">
                      '.$status.'
                      <label for="todoCheck'.$row['id'].'"></label>
                    </div>
                    
                    <span class="text" >'.$row['description'].'</span>
                   
                  </li>
				';
			}
			
	echo json_encode($output);
}
///
function get_prescart_details(){
	$output=array('product_tabledata'=>'');
	$pid=$_SESSION['dppid'];
	$user= $this->settings->userdata('id');

	$prodtotal = 0; $subtotal = 0;
			$stmt = $this->conn->query("SELECT *, pres_cart.id AS cartid FROM pres_cart LEFT JOIN product ON product.prod_id=pres_cart.prod_id WHERE patient_id='$pid' order by pres_cart.id desc");
			foreach($stmt as $row){
				$output['product_tabledata'].= "
					<tr>
						<td><button type='button' data-id='".$row['cartid']."' class='btn btn-danger btn-flat cart_delete'><i class='fas fa-trash text-white'></i></button></td>
						
						<td>

						".substr($row['prod_name'],0, 25)."...
						<input type='hidden' name='product_id[]' value='".$row['prod_id']."'>
   						 <input type='hidden' name='product_price[]' value='".$row['prod_price']."'>
						</td>
						
						<td width='5px' class='input-group'>
							
            				<input  type='number' min='1' size='5' class='cart-item form-control' name='product_qty[]' value='".$row['quantity']."' id='qty_".$row['cartid']."' data-id='".$row['cartid']."'>
				            
						</td>
						
					</tr>
				";
			}
		
	echo json_encode($output);
}
/*function get_service_cart_details(){
	$output=array('tabledata'=>'','toatl'=>0);
	
	$user= $this->settings->userdata('id');

	$servtotal = 0; $subtotal = 0;
			$stmt = $this->conn->query("SELECT *, service_cart.id AS cartid FROM service_cart LEFT JOIN service_list ON service_list.id=service_cart.service_id WHERE user_id='$user' order by service_cart.id desc");
			foreach($stmt as $row){
				
				$subtotal = $row['price'];
				$servtotal += $subtotal;
				$output['tabledata'].= "
					<tr>
						<td><button type='button' data-id='".$row['cartid']."' class='btn btn-danger btn-flat cart-delete'><i class='glyphicon glyphicon-trash text-white'></i></button></td>
						
						<td>
						".$row['name']."
						<input type='hidden' name='product_id[]' value='".$row['id']."'>
   					
						</td>
						<td class='service-price'>".number_format($row['price'], 2)."</td>
						
					</tr>
				";
			}
			$output['tabledata'] .= "
				<tr>
					<td colspan='2' align='right'><b>Total (GHc)</b></td>
					<td><b>".number_format($servtotal, 2)."</b></td>
				<tr>
			";

		$output['total']=round($servtotal,2);
	echo json_encode($output);

}*/
//

function cart_update(){
			
	$id = $_POST['id'];
	$qty = $_POST['qty'];
	$oldqty =0;
	$output = array('error'=>false);
			$stmt = $this->conn->query("SELECT * FROM cart natural join product WHERE id='$id'");
					$qtyrow = $stmt->fetch_assoc();
					$oldqty = $qtyrow['prod_qty'];
					if($qty<$oldqty || $qty==$oldqty ){
						$stmt = $this->conn->query("UPDATE cart SET quantity='$qty' WHERE id='$id'");
						
						$output['oldqty'] = $oldqty;
						$output['message'] = 'Updated';
					}
			else{
				$output['error'] = true;
			$output['message'] = 'Quantity Picked More Than Available';
			}
			
		
		echo json_encode($output);
	}
	///
	function pharm_update(){
			
	$id = $_POST['id'];
	$qty = $_POST['qty'];
	$oldqty =0;
	$output = array('error'=>false);
			$stmt = $this->conn->query("SELECT * FROM pres_cart natural join product WHERE id='$id'");
					$qtyrow = $stmt->fetch_assoc();
					$oldqty = $qtyrow['prod_qty'];
					if($qty<$oldqty || $qty==$oldqty ){
						$stmt = $this->conn->query("UPDATE pres_cart SET quantity='$qty' WHERE id='$id'");
						
						$output['oldqty'] = $oldqty;
						$output['message'] = 'Updated';
					}
			else{
				$output['error'] = true;
			$output['message'] = 'Quantity Picked More Than Available';
			}
			
		
		echo json_encode($output);
	}
	///
	function stockin_cart_update(){
			
	$id = $_POST['id'];
	$qty = $_POST['qty'];
	
	$output = array('error'=>false);
			
						$stmt = $this->conn->query("UPDATE stockin_cart SET qty='$qty' WHERE stockin_id='$id'");
						$output['message'] = 'Updated';
	
		echo json_encode($output);
	}
	///
	

	function give_pres(){
		$id = $_POST['id'];
				$output = array('error'=>false);
				$stmt = $this->conn->query("UPDATE pres_cart SET status=1 WHERE id='$id'");
					$output['message'] = 'Updated';
					echo json_encode($output);
	}
	///
	function pres_cart_update(){
			
		$id = $_POST['id'];
	$qty = $_POST['qty'];
	$oldqty =0;
		
				$output = array('error'=>false);
			$stmt = $this->conn->query("SELECT * FROM pres_cart natural join product WHERE id='$id'");
					$qtyrow = $stmt->fetch_assoc();
					$oldqty = $qtyrow['prod_qty'];
					if($qty<$oldqty || $qty==$oldqty ){
						$stmt = $this->conn->query("UPDATE pres_cart SET quantity='$qty' WHERE id='$id'");
						
						$output['oldqty'] = $oldqty;
						$output['message'] = 'Updated';
					}
			else{
				$output['error'] = true;
			$output['message'] = 'Quantity Picked More Than Available';
			}
			
		
		echo json_encode($output);
	}

	function delete_cart_item(){
	$output = array('error'=>false);
	$id = $_POST['id'];
	
			$stmt = $this->conn->query("DELETE FROM cart WHERE id='$id'");
			
			$output['message'] = 'Deleted';	
	echo json_encode($output);	
	}
	function delete_service_cart_item(){
	$output = array('error'=>false);
	$id = $_POST['id'];
	
			$stmt = $this->conn->query("DELETE FROM service_cart WHERE id='$id'");
			
			$output['message'] = 'Deleted';	
	echo json_encode($output);	
	}
	
	function delete_prescart_item(){
	$output = array('error'=>false);
	$id = $_POST['id'];
	
			$stmt = $this->conn->query("DELETE FROM pres_cart WHERE id='$id'");
			
			$output['message'] = 'Deleted';	
	echo json_encode($output);	
	}

}
$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'delete_img':
		echo $Master->delete_img();
	break;
	case 'delete_cart_item':
		echo $Master->delete_cart_item();
	break;
	case 'delete_expense':
		echo $Master->delete_expense();
	break;
	case 'delete_service_cart_item':
		echo $Master->delete_service_cart_item();
	break;
	case 'cart_update':
		echo $Master->cart_update();
	break;
	case 'stockin_cart_update':
		echo $Master->stockin_cart_update();
	break;
	case 'give_pres':
		echo $Master->give_pres();
	break;
	case 'save_service':
		echo $Master->save_service();
		break;
	case 'save_expense':
		echo $Master->save_expense();
		break;
		case 'save_bills':
		echo $Master->save_bills();
		break;
		case 'save_patient':
		echo $Master->save_patient();
		break;


	case 'get_cart_details':
		echo $Master->get_cart_details();
	break;
	case 'get_todolist':
		echo $Master->get_todolist();
	break;
	case 'get_pharm_details':
		echo $Master->get_pharm_details();
	break;
	case 'get_bills_details':
		echo $Master->get_bills_details();
	break;
	case 'pres_cart_update':
		echo $Master->pres_cart_update();
	break;
	case 'save_consulting':
		echo $Master->save_consulting();
	break;
	case 'pharm_update':
		echo $Master->pharm_update();
	break;
	case 'get_service_cart_details':
		echo $Master->get_service_cart_details();
	break;
	case 'add_to_cart':
		echo $Master->add_to_cart();
	break;
	case 'save_vital_sign':
		echo $Master->save_vital_sign();
	break;
	case 'add_to_service_cart':
		echo $Master->add_to_service_cart();
	break;
	case 'delete_service':
		echo $Master->delete_service();
	break;
	case 'delete_prescart_item':
		echo $Master->delete_prescart_item();
	break;
	
	case 'save_mechanic':
		echo $Master->save_mechanic();
	break;
	case 'add_to_prescription_cart':
		echo $Master->add_to_prescription_cart();
	break;
	case 'delete_mechanic':
		echo $Master->delete_mechanic();
	break;
	case 'save_stockin':
		echo $Master->save_stockin();
	break;
	case 'save_product':
		echo $Master->save_product();
	break;
	case 'delete_product':
		echo $Master->delete_product();
	break;

	case 'get_prescart_details':
		echo $Master->get_prescart_details();
	break;
	case 'save_price_change':
		echo $Master->save_price_change();
	break;
	case 'save_inventory':
		echo $Master->save_inventory();
	break;
	case 'delete_stockin':
		echo $Master->delete_stockin();
	break;
	case 'save_todo':
		echo $Master->save_todo();
	break;
	case 'update_todo':
		echo $Master->update_todo();
	break;
	case 'delete_todo':
		echo $Master->delete_todo();
	break;
	case 'save_transaction':
		echo $Master->save_transaction();
	break;
	case 'save_service_transaction':
		echo $Master->save_service_transaction();
	break;
	case 'stockin_cart_add':
		echo $Master->stockin_cart_add();
	break;
	case 'delete_transaction':
		echo $Master->delete_transaction();
	break;
	case 'update_status':
		echo $Master->update_status();
	break;
	default:
		// echo $sysset->index();
		break;
}