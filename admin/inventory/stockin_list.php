<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title"> Stockin List</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid mb-3">
            <fieldset class="px-2 py-1 border">
               
                <div class="container-fluid">
                    <form action="" id="filter-form">
                        <div class="row align-items-end">
                            
                            
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    
                                    <button class="btn btn-light btn-sm bg-gradient-light rounded-0 border" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </fieldset>
		</div>
        <div class="container-fluid" id="printout">
			<table class="table table-hover table-striped table-bordered">

				
				<thead>
					<tr>
						<th>#</th>
                        <th>Date/Day</th>
                        <th>Stock ID</th>
                        <th>Invoice</th>
						<th>Supplier</th>
						<th>Amount</th>
                        <th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
                    $qry = $conn->query("SELECT * from stock_list natural join supplier order by date_created desc limit 200");
                    while($row = $qry->fetch_assoc()):
                       
					?>
						<tr>

							<td class="text-center">
                                 <?php echo $i++; ?>
                             </td>
                             <td><?= date("M d, Y", strtotime($row['date_created'])) ?></td>
                                 <td><?= $row['sid'] ?></td>
                                 <td><?= $row['invoice'] ?></td>
                                 <td><?= $row['supplier_name'] ?></td>
							
							<td class='text-right'><?= number_format($row['amount'],2) ?></td>
                            <td align="center">
                                <a class="btn btn-default bg-gradient-light btn-flat btn-sm" href="?page=inventory/stockin_items&id=<?php echo $row['sid'] ?>&supplier=<?php echo $row['supplier_name'] ?>&date=<?php echo $row['date_created'] ?>&invoice=<?php echo $row['invoice'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                            </td>
						</tr>
					<?php endwhile; ?>
				</tbody>
                
			</table>
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
