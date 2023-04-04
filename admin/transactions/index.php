<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">Transactions List</h3>
		<div class="card-tools">
			<a href="<?php echo base_url ?>admin/?page=cart/manage_cart" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
			<a href="export/transactions.php" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Export to Excel</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered">
				
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Transaction ID</th>
						<th>Customer Name</th>
						<th>Amount</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						
						$qry = $conn->query("SELECT * FROM `transaction_list` order by unix_timestamp(date_updated) desc limit 250");
						
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><p class="m-0 truncate-1"><?= date("M d, Y H:i", strtotime($row['date_updated'])) ?></p></td>
							<td><p class="m-0 truncate-1"><?= $row['code'] ?></p></td>
							<td><p class="m-0 truncate-1"><?= $row['client_id'] ?></p></td>
							<td class='text-right'><?= number_format($row['amount'],2) ?></td>
							
							<td align="center">
								<a class="btn btn-default bg-gradient-light btn-flat btn-sm" href="?page=transactions/view_details&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [5] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	
</script>