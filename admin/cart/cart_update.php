<?php
	include 'conn.php';
session_start();
	$conn = $pdo->open();

	$output = array('error'=>false);



	if(isset($_SESSION['id'])){
		$id = $_POST['id'];
	$qty = $_POST['qty'];
	$oldqty =0;
		try{
				
			$stmt = $conn->prepare("SELECT * FROM cart natural join product WHERE id=:cart_id");
					$stmt->execute(['cart_id'=>$id]);
					$qtyrow = $stmt->fetch();
					$oldqty = $qtyrow['prod_qty'];
					if($qty<$oldqty || $qty==$oldqty ){
			$stmt = $conn->prepare("UPDATE cart SET quantity=:quantity WHERE id=:id");
			$stmt->execute(['quantity'=>$qty, 'id'=>$id]);
			$output['oldqty'] = $oldqty;
			$output['message'] = 'Updated';
			}
			else{
				$output['error'] = true;
			$output['message'] = 'Quantity Picked More Than Available';
			}
			
		}
		catch(PDOException $e){
			$output['message'] = $e->getMessage();
		}
	}
	else{
		foreach($_SESSION['cart'] as $key => $row){
			if($row['productid'] == $id){
				$_SESSION['cart'][$key]['quantity'] = $qty;
				$output['message'] = 'Updated';
			}
		}
	}

	$pdo->close();
	echo json_encode($output);

?>