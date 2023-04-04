<?php
	include 'conn.php';
	session_start();

	
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN product on product.prod_id=cart.prod_id WHERE user_id=:user_id");
		$stmt->execute(['user_id'=>$_SESSION['id']]);

		$total = 0;
		foreach($stmt as $row){
			$subtotal = $row['prod_wprice'] * $row['quantity'];
			$total += $subtotal;
		}

		$pdo->close();

		echo json_encode($total);
	
?>