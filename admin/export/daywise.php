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
						<th>Date/Day</th>
						<th>Total</th>
				</tr>
			<tbody>
	";
	
				$total = 0;
				$day = 0;
					$i = 1;
                    $query = $conn->query("SELECT *, sum(amount) as total from transaction_list where date(date_created) BETWEEN '{$from}' and '{$to}' group by date(date_created) order by unix_timestamp(date_updated) ") or die(mysqli_errno());
	while($fetch = $query->fetch_array()){
		$day = $fetch['total'];
		$total += $fetch['total'];
		
	$output .= "
				<tr>
					<td>".$i++."</td>
					<td>".$fetch['date_created']."</td>
					
					<td>".number_format($day,2)."</td>
				</tr>
	";
	}
	
	$output .="
			</tbody>
			<tfoot>
                    <th class='py-1 text-center' colspan='2'>Total Sales</th>
                    <th class='py-1 text-right'>". number_format($total,2)."</th>
                </tfoot>
			
		</table>
	";
	
	echo $output;
	
	
?>