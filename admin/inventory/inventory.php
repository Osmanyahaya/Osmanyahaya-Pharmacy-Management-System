<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php $date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d"); ?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">Inventory Report</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid mb-3">
              <button class="btn btn-light btn-sm bg-gradient-light rounded-0 border pull-right" type="button"  id="print"><i class="fa fa-print"></i> Print</button>
              <a href="export/inventory.php" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Export to Excel</a>
            
		</div>
        <div class="container-fluid" id="printout">
			<table class="table table-hover table-striped table-bordered">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="25%">
					<col width="10%">
					<col width="10%">
					<col width="15%">
				</colgroup>
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
				</thead>
				<tbody>
					<?php 
                    $ctotal = 0;
                    $sumctotal = 0;
                    $stotal = 0;
                    $sumstotal = 0;
					$i = 1;
                    $qry = $conn->query("SELECT * FROM Product");
                    while($row = $qry->fetch_assoc()):
                        $stotal = $row['prod_price'] * $row['prod_qty'];
                        $ctotal = $row['prod_cprice'] * $row['prod_qty'];
                         $sumctotal+=$ctotal;
                          $sumstotal+=$stotal;
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?= $row['prod_name'] ?></td>
							<td>
                                <?= number_format($row['prod_price'],2)?>
                            </td>
							<td>
                                 <?= number_format($row['prod_cprice'],2)?>                     
                            </td>
                            <td>
                                 <?= $row['prod_qty']?>                     
                            </td>
                            <td>
                                 <?= number_format($stotal,2)?>                     
                            </td>
                            <td>
                                 <?= number_format($ctotal,2)?>                     
                            </td>
							
						</tr>
					<?php endwhile; ?>
				</tbody>
                <tfoot>
                    <tr>
                    <th class="py-1 text-center" colspan="6">Total Pojected sales Amount</th>
                    <th class="py-1 text-right"><?= number_format($sumstotal,2) ?></th>
                    </tr>
                    <tr>
                    <th class="py-1 text-center" colspan="6">Total Cost Amount</th>
                    <th class="py-1 text-right"><?= number_format($sumctotal,2) ?></th>
                    </tr>
                    <tr>
                    <th class="py-1 text-center" colspan="6">Total Profit Projected</th>
                    <th class="py-1 text-right"><?= number_format($sumstotal-$sumctotal,2) ?></th>
                    </tr>
                </tfoot>
			</table>
		</div>
	</div>
</div>
<noscript id="print-header">
    <div>
    <div class="d-flex w-100">
        <div class="col-2 text-center">
            <img style="height:.8in;width:.8in!important;object-fit:cover;object-position:center center" src="<?= validate_image($_settings->info('logo')) ?>" alt="" class="w-100 img-thumbnail rounded-circle">
        </div>
        <div class="col-8 text-center">
            <div style="line-height:1em">
                <h4 class="text-center mb-0"><?= $_settings->info('name') ?></h4>
                <h3 class="text-center mb-0"><b>Total Inventory</b></h3>
                <div class="text-center">as of</div>
                <h4 class="text-center mb-0"><b><?= date("F d, Y", strtotime($date)) ?></b></h4>
            </div>
        </div>
    </div>
    <hr>
    </div>
</noscript>
<script>
	$(document).ready(function(){
		$('#filter-form').submit(function(e){
            e.preventDefault()
            location.href = "./?page=inventory/inventory"
        })
        $('#print').click(function(){
            var h = $('head').clone()
            var ph = $($('noscript#print-header').html()).clone()
            var p = $('#printout').clone()
            h.find('title').text('Inventory Report')

            start_loader()
            var nw = window.open("", "_blank", "width="+($(window).width() * .8)+", height="+($(window).height() * .8)+", left="+($(window).width() * .1)+", top="+($(window).height() * .1))
                     nw.document.querySelector('head').innerHTML = h.html()
                     nw.document.querySelector('body').innerHTML = ph.html()
                     nw.document.querySelector('body').innerHTML += p[0].outerHTML
                     nw.document.close()
                     setTimeout(() => {
                         nw.print()
                         setTimeout(() => {
                             nw.close()
                             end_loader()
                         }, 300);
                     }, 300);
        })
	})
	
</script>