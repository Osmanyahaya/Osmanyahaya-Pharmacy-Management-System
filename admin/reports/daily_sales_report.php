<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php $date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d"); ?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">Daily Sales Report</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid mb-3">
            <fieldset class="px-2 py-1 border">
                <legend class="w-auto px-3">Filter</legend>
                <div class="container-fluid">
                    <form action="" id="filter-form">
                        <div class="row align-items-end">
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="date" class="control-label">Choose Date</label>
                                    <input type="date" class="form-control form-control-sm rounded-0" name="date" id="date" value="<?= date("Y-m-d", strtotime($date)) ?>" required="required">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm bg-gradient-primary rounded-0"><i class="fa fa-filter"></i> Filter</button>
                                    <button class="btn btn-light btn-sm bg-gradient-light rounded-0 border" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                                    <a href="export/adaily.php?date=<?php echo $date?>" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Export to Excel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </fieldset>
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
						<th>DateTime</th>
						<th>Invoice</th>
						<th>Product Name</th>
						<th>Qty</th>
                        <th>C. Price</th>
                        <th>S. Price</th>
						<th>Sub Total Cost</th>
                        <th>Sub Total Price</th>
					</tr>
				</thead>
				<tbody>
					<?php 


                        $sql1 = $conn->query("SELECT SUM(discount) as discount FROM transaction_list where date(date_created)='$date'");

                        $row = $sql1->fetch_assoc();
                        $discount = $row['discount'];

                    $total = 0;
                    $cost_total = 0;
					$i = 1;
                    $qry = "SELECT tp.*,tl.code, tl.client_id,pl.prod_name as product,tl.date_created,sum(tp.qty) as qty FROM `transaction_products` tp inner join transaction_list tl on tp.transaction_id = tl.id or tp.transaction_id = tl.code inner join product pl on tp.product_id = pl.prod_id where date(tl.date_created) = '{$date}' group by pl.prod_id order by unix_timestamp(tl.date_updated) asc";
                        $result = $conn->query($qry);
                    if (!$result) {
                        throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
                            }
                    while($row = $result->fetch_assoc()):
                        $total += $row['price'] * $row['qty'];
                        $cost_total += $row['cost_price'] * $row['qty'];
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?= date("M d, Y H:i", strtotime($row['date_created'])) ?></td>
							<td>
                                <div style="line-height:1em">
                                    <div><small><?= $row['code'] ?></small></div>
                                    
                                </div>
                            </td>
							<td><?= $row['product'] ?></td>
                            <td class='text-right'><?= $row['qty'] ?></td>
							<td class='text-right'><?= number_format($row['cost_price'],2) ?></td>
                            <td class='text-right'><?= number_format($row['price'],2) ?></td>
							<td class='text-right'><?= number_format($row['cost_price'] * $row['qty'],2) ?></td>
                            <td class='text-right'><?= number_format($row['price'] * $row['qty'],2) ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
               
                <tfoot>
                    <th class="py-1 text-right" colspan="8">Profit Margin</th>
                    <th class="py-1 text-right text-red"><?= number_format(($total-$discount)-$cost_total,2) ?></th>
                  
                    
                </tfoot>
                 <tfoot>
                    <th class="py-1 text-right " colspan="7">Grant Total</th>
                    <th class="py-1 text-right"><?= number_format($cost_total,2) ?></th>
                    <th class="py-1 text-right "><?= number_format($total-$discount,2) ?></th>

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
                <h4 class="text-center mb-0"><?= $_settings->info('address') ?></h4>
                <h4 class="text-center mb-0"><?= $_settings->info('contact') ?></h4>
                <h3 class="text-center mb-0"><b>Daily Sales Report</b></h3>
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
            location.href = "./?page=reports/daily_sales_report&"+$(this).serialize()
        })
        $('#print').click(function(){
            var h = $('head').clone()
            var ph = $($('noscript#print-header').html()).clone()
            var p = $('#printout').clone()
            h.find('title').text('Daily Sales Report - Print View')

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