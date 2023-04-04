<?php
	include 'conn.php';
	session_start();
	$conn = $pdo->open();

	$output = '';	
			

		try{
			$total = 0;
			$stmt = $conn->prepare("SELECT *, cart.id AS cartid FROM cart LEFT JOIN product ON product.prod_id=cart.prod_id WHERE user_id=:user order by cart.id desc");
			$stmt->execute(['user'=>$_SESSION['id']]);
			foreach($stmt as $row){
				
				$subtotal = $row['prod_wprice']*$row['quantity'];
				$total += $subtotal;
				$output .= "
					<tr>
						<td><button type='button' data-id='".$row['cartid']."' class='btn btn-danger btn-flat cart_delete'><i class='glyphicon glyphicon-trash text-white'></i></button></td>
						
						<td>
						".$row['prod_name']."
						<input type='hidden' name='product_id[]' value='".$row['prod_id']."'>
   						 <input type='hidden' name='product_price[]' value='".$row['prod_wprice']."'>
						</td>
						<td>".number_format($row['prod_wprice'], 2)."</td>
						<td class='input-group'>
							<span class='input-group-btn'>
            					<button type='button' id='minus' class='btn btn-default btn-flat minus' data-id='".$row['cartid']."'><i class='fas fa-minus text-blue'></i></button>
            				</span>
            				<input  type='text' class='form-control cart-item' name='product_qty[]' value='".$row['quantity']."' id='qty_".$row['cartid']."' data-id='".$row['cartid']."'>
				            <span class='input-group-btn'>
				                <button type='button' id='add' class='btn btn-default btn-flat add' data-id='".$row['cartid']."'><i class='fas fa-plus text-blue'></i>
				                </button>
				            </span>
						</td>
						<td>".number_format($subtotal, 2)."</td>
					</tr>
				";
			}
			$output .= "
				<tr>
					<td colspan='4' align='right'><b>Total (GHc)</b></td>
					<td><b>".number_format($total, 2)."</b></td>
				<tr>
			";

		}
		catch(PDOException $e){
			$output .= $e->getMessage();
		}

	$pdo->close();
	echo json_encode($output);

?>

