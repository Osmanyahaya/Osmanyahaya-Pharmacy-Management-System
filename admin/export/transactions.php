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
						<th>Date Created</th>
						<th>Transaction ID</th>
						<th>Customer Name</th>
						<th>Amount</th>
						
				</tr>
			<tbody>
	";				$i=1;
					
	$query = $conn->query("SELECT * FROM `transaction_list` order by unix_timestamp(date_updated) desc limit 250") or die(mysqli_errno());
	while($fetch = $query->fetch_array()){
		
		
	$output .= "
				<tr>
					<td>".$i++."</td>
					<td>".$fetch['date_updated']."</td>
					<td>".$fetch['code']."</td>
					<td>".$fetch['client_id']."</td>
					<td>".$fetch['amount']."</td>
					
				</tr>
	";
	}
	
	$output .="
			</tbody>
			
			
		</table>
	";
	
	echo $output;
	
	
?>