<?php
	include 'conn.php';
session_start();
	$conn = $pdo->open();

	$output = array('error'=>false);
	$id = $_POST['id'];

	if(isset($_SESSION['id'])){
		try{
			$stmt = $conn->prepare("DELETE FROM cart");
			$stmt->execute();
			$output['message'] = 'Deleted';
			
		}
		catch(PDOException $e){
			$output['message'] = $e->getMessage();
		}
	}
	
	

	$pdo->close();
	echo json_encode($output);

?>