<?php
	include 'conn.php';
	session_start();
	$conn = $pdo->open();

	$output = array('list'=>'','count'=>0);

	
		try{
			$stmt = $conn->prepare("SELECT *, product.prod_name AS prodname FROM cart LEFT JOIN product ON product.prod_id=cart.prod_id WHERE user_id=:user_id");
			$stmt->execute(['user_id'=>$_SESSION['id']]);
			foreach($stmt as $row){
				$output['count']++;
				
				$productname = (strlen($row['prodname']) > 30) ? substr_replace($row['prodname'], '...', 27) : $row['prodname'];
				$output['list'] .= "
					<li>
						<a href='product.php?product=".$row['prod_name']."'>
							
		                    <p>".$productname."</p>
						</a>
					</li>
				";
			}
		}
		catch(PDOException $e){
			$output['message'] = $e->getMessage();
		}

	$pdo->close();
	echo json_encode($output);

?>

