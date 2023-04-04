<?php
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=file.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");

	require_once('../../config.php');

	
	$output = "";
	
	$output .="
	<body style='border: 1px solid #ccc'> 
		<table>
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Cost Price</th>
					<th>Retail Price</th>
					<th>Wholesale Price</th>
					<th>Quantity</th>
				</tr>
			<tbody>
	";
	
	$query = $conn->query("SELECT * FROM `product`") or die(mysqli_errno());
	while($fetch = $query->fetch_array()){
		
	$output .= "
				<tr>
					<td>".$fetch['prod_name']."</td>
					<td>".$fetch['prod_cprice']."</td>
					<td>".$fetch['prod_price']."</td>
					<td>".$fetch['prod_wprice']."</td>
					<td>".$fetch['prod_qty']."</td>
				</tr>
	";
	}
	
	$output .="
			</tbody>
			
		</table>
	";
	
	echo $output;
	
	
?>