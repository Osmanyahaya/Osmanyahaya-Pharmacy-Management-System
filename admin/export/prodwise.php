<?php
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=file.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");

	require_once('../../config.php');

	$from=$_GET['from'];
	$to=$_GET['to'];
	$output = "";
	
	$output .="
	<body style='border: 1px solid #ccc'> 
		<table>
			<thead>
				<tr>
					<th>#</th>
						<th>DateTime</th>
						<th>Invoice</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Qty</th>
						<th>Total</th>
				</tr>
			<tbody>
	";
	
				$total = 0;
				$sumtotal = 0;
					$i = 1;
                    $query = $conn->query("SELECT tp.*,tl.code, tl.client_id,pl.prod_name as product,tl.date_created,sum(tp.qty) as qty FROM `transaction_products` tp inner join transaction_list tl on tp.transaction_id = tl.id inner join product pl on tp.product_id = pl.prod_id where date(tl.date_created) BETWEEN '{$from}' and '{$to}' group by pl.prod_id order by unix_timestamp(tl.date_updated) asc ") or die(mysqli_errno());
	while($fetch = $query->fetch_array()){
		$total = $fetch['price'] * $fetch['qty'];
		$sumtotal += $total;
		
	$output .= "
				<tr>
					<td>".$i++."</td>
					<td>".$fetch['date_created']."</td>
					<td>".$fetch['code']."</td>
					<td>".$fetch['product']."</td>
					<td>".$fetch['price']."</td>
					<td>".$fetch['qty']."</td>
					<td>".$total."</td>
				</tr>
	";
	}
	
	$output .="
			</tbody>
			<tfoot>
                    <th class='py-1 text-center' colspan='6'>Total Sales</th>
                    <th class='py-1 text-right'>". number_format($sumtotal,2)."</th>
                </tfoot>
			
		</table>
	";
	
	echo $output;
	
	
?>