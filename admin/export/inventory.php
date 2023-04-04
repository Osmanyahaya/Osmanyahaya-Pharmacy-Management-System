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
					<th>#</th>
						<th>Product Name</th>
						<th>Selling Price</th>
                        <th>Cost Price</th>
						<th>Qty</th>
                        <th>Total S. Price</th>
						<th>Total C. Price</th>
				</tr>
			<tbody>
	";				$i=1;
					$ctotal = 0;
                    $sumctotal = 0;
                    $stotal = 0;
                    $sumstotal = 0;
	$query = $conn->query("SELECT * FROM `product`") or die(mysqli_errno());
	while($fetch = $query->fetch_array()){
		$stotal += $fetch['prod_price'] * $fetch['prod_qty'];
         $ctotal += $fetch['prod_cprice'] * $fetch['prod_qty'];
         $sumctotal+=$ctotal;
          $sumstotal+=$stotal;
		
	$output .= "
				<tr>
					<td>".$fetch['prod_name']."</td>
					<td>".$fetch['prod_cprice']."</td>
					<td>".$fetch['prod_price']."</td>
					<td>".$fetch['prod_wprice']."</td>
					<td>".$fetch['prod_qty']."</td>
					<td>".$stotal."</td>
					<td>".$ctotal."</td>
				</tr>
	";
	}
	
	$output .="
			</tbody>
			<tfoot>
                    <tr>
                    <th class='py-1 text-center' colspan='6'>Total Pojected sales Amount</th>
                    <th class='py-1 text-right'>".number_format($sumstotal,2)."</th>
                    </tr>
                    <tr>
                    <th class='py-1 text-center' colspan='6'>Total Cost Amount</th>
                    <th class='py-1 text-right'>". number_format($sumctotal,2)."</th>
                    </tr>
                    <tr>
                    <th class='py-1 text-center' colspan='6'>Total Profit Projected</th>
                    <th class='py-1 text-right'>". number_format($sumstotal-$sumctotal,2)."</th>
                    </tr>
                </tfoot>
			
		</table>
	";
	
	echo $output;
	
	
?>