<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php  
$sid = isset($_GET['id']) ? $_GET['id'] : '';
$supplier = isset($_GET['supplier']) ? $_GET['supplier'] : '';
$date=date("M d, Y", strtotime($_GET['date']));
$invoice = isset($_GET['invoice']) ? $_GET['invoice'] : '';

//$to = isset($_GET['to']) ? $_GET['to'] : '';
?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">Stock-In Invoice  </h3>
		<span class="justify" ><?php if($_settings->userdata('type') == 1 ): ?>
				<form id="stockEditForm">
					<input type="hidden" value="<?php echo $sid ?>" name="sid">
                   
                        <button class="btn btn-info bg-gradient-info border rounded-pill" form="stockEditForm" id="stockEditForm" type="submit"><i class="fa fa-edit"></i> Edit </button>
                   
                </form> 
                
                 <?php endif;?>

        </span>
		<span class="card-title float-right">
        		Invoice #: <?php echo $invoice ?>
        	</span>
	</div>
	<div class="card-body">
		<div class="container-fluid mb-3">
           
		</div>
        <div class="container-fluid" id="printout">
        	
        	<span class="card-title float-left">
        		Supplier:  <?php echo $supplier ?>
        	</span>
        	<span class="card-title float-right">
        		Date: <?php echo $date ?>
        	</span>
			<table class="table table-hover table-striped">
				
				<thead>
					<tr>
						<th>#</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Qty</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php 
                    $total = 0;
					$i = 1;
                    $qry = $conn->query("select * from stockin natural join product where  stockin_id='$sid' order by qty desc");
                    
                    while($row = $qry->fetch_assoc()):
                        $total += $row['cost_price'] * $row['qty'];
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							
							<td>
                                <?= $row['prod_name'] ?>
                            </td>
							
							<td class='text-right'><?= number_format($row['cost_price']) ?></td>
							<td class='text-right'><?= $row['qty'] ?></td>
							<td class='text-right'><?= number_format($row['cost_price'] * $row['qty']) ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
                <tfoot>
                    <th class="py-1 text-center" colspan="4">Total Cost</th>
                    <th class="py-1 text-right"><?= number_format($total,2) ?></th>
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
                <h4 class="text-center mb-0"><b>Sales Report as of <?= date("F d, Y", strtotime($from)) ?> to <?= date("F d, Y", strtotime($to)) ?> </b></h4>
                
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
            location.href = "./?page=reports/stockin_report&"+$(this).serialize()
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
	
$(function(){

  $('#stockEditForm').submit(function(e){
    e.preventDefault();
    var stock = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: _base_url_+"classes/Master.php?f=stock_edit",
        data: stock,
        dataType: 'json',
        success: function(resp){
           
        if(resp.status == 'success'){
                    
              location.replace('./?page=inventory');      
        
            }else if(resp.status == 'failed'){
                console.log(resp.msg);
                alert_toast(resp.msg,'error');
               
                   
                    end_loader()
            }else{
                console.log(resp);
                alert_toast("An error mm occured",'error');
               
                    
                end_loader();
            }
        }
    });
  });



});
</script>