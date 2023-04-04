<?php
	include 'conn.php';
	session_start();

	$conn = $pdo->open();

	$output = array('error'=>false);

	$id = $_POST['id'];
	$quantity = $_POST['quantity'];

	if(isset($_SESSION['id'])){
		$user=$_SESSION['id'];
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM cart WHERE user_id=:user_id AND prod_id=:product_id");
		$stmt->execute(['user_id'=>$user, 'product_id'=>$id]);
		$row = $stmt->fetch();
		if($row['numrows'] < 1){
			try{
				$stmt = $conn->prepare("SELECT prod_qty FROM product WHERE  prod_id=:prod_id");
					$stmt->execute(['prod_id'=>$id]);
					$qtyrow = $stmt->fetch();
					$qty = $qtyrow['prod_qty'];
					
					if($quantity<$qty || $quantity==$qty ){

						$stmt = $conn->prepare("INSERT INTO cart (user_id, prod_id, quantity) VALUES (:user_id, :product_id, :quantity)");
						$stmt->execute(['user_id'=>$user, 'product_id'=>$id, 'quantity'=>$quantity]);
						$output['message'] = 'Item added to cart';
						}else{
							$output['error'] = true;
							$output['message'] = 'Quantity Picked More Than Available';
						}
				
				
			}
			catch(PDOException $e){
				$output['error'] = true;
				$output['message'] = $e->getMessage();
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Product already in cart';
		}
	}
	else{
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
		}

		$exist = array();

		foreach($_SESSION['cart'] as $row){
			array_push($exist, $row['productid']);
		}

		if(in_array($id, $exist)){
			$output['error'] = true;
			$output['message'] = 'Product already in cart';
		}
		else{
			$data['productid'] = $id;
			$data['quantity'] = $quantity;

			if(array_push($_SESSION['cart'], $data)){
				$output['message'] = 'Item added to cart';
			}
			else{
				$output['error'] = true;
				$output['message'] = 'Cannot add item to cart';
			}
		}

	}

	$pdo->close();
	echo json_encode($output);

?>