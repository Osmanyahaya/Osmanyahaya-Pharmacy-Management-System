<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `service_transaction_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
        
        if(isset($user_id) && is_numeric($user_id)){
            $user = $conn->query("SELECT concat(firstname,' ', lastname) as `name` FROM `users` where id = '{$user_id}' ");
            if($user->num_rows > 0){
                $user_name = $user->fetch_array()['name'];
            }
        }
    }else{
        echo '<script> alert("Unknown Transaction\'s ID."); location.replace("./?page=transactions"); </script>';
    }
}else{
    echo '<script> alert("Transaction\'s ID is required to access the page."); location.replace("./?page=transactions"); </script>';
}
?>
<div class="content py-3">
    <div class="card card-outline card-navy rounded-0 shadow">
        <div class="card-header">
            <h4 class="card-title">Transaction Details: <b><?= isset($code) ? $code : "" ?></b></h4>
            <div class="card-tools">
                <a href="./?page=transactions" class="btn btn-default border btn-sm"><i class="fa fa-angle-left"></i> Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="container" id="printout">
                <div class="row mb-0">
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Transaction Code</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($code) ? $code : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Client Name</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($client_name) ? $client_name : '' ?></div>
                    <div class="col-3 py-1 px-2 border border-navy bg-gradient-navy mb-0"><b>Attendered By</b></div>
                    <div class="col-9 py-1 px-2 border mb-0"><?= isset($user_name) ? $user_name : '' ?></div>
                </div>
                <div class="clear-fix mb-2"></div>
                <hr>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <fieldset>
                        <legend>Products</legend>
                        <div class="clear-fix mb-2"></div>
                        <table class="table table-striped table-bordered" id="service-list">
                            <colgroup>
                                <col width="70%">
                                <col width="30%">
                            </colgroup>
                            <thead>
                                <tr class="bg-gradient-navy">
                                    <th class="text-center">Service</th>
                                    <th class="text-center">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $service_amount = 0;
                                $ts_qry = $conn->query("SELECT ts.*, s.name as `service` FROM `transaction_services` ts inner join `service_list` s on ts.service_id = s.id where ts.`transaction_id` = '{$id}' ");
                                while($row = $ts_qry->fetch_assoc()):
                                    $service_amount += $row['price'];
                                ?>
                                <tr>
                                    <td><?= $row['service'] ?></td>
                                    <td class="text-right service_price"><?= format_num($row['price']) ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr class="">
                                    <th  class="text-right">Grant Total</th>
                                    <th class="text-right" id="product_total"><?= isset($product_total) ? number_format($product_total,2): 0 ?></th>
                                </tr>
                                <tr class="">
                                    <th  class="text-right">Cash Tendered</th>
                                    <th class="text-right" id="product_total"><?= isset($cash_tendered) ? number_format($cash_tendered,2): 0 ?></th>
                                </tr>
                                <tr class="">
                                    <th  class="text-right">Balance</th>
                                    <th class="text-right" id="balance"><?= isset($balance) ? number_format($balance,2): 0 ?></th>
                                </tr>
                                <tr class="">
                                    <th  class="text-right">Discount</th>
                                    <th class="text-right" id="product_total"><?= isset($discount) ? number_format($discount,2): 0 ?></th>
                                </tr>
                                <tr class="bg-gradient-secondary">
                                    <th  class="text-right">Total Payable Amount</th>
                                    <th class="text-right" id="product_total"><?= isset($amount) ? number_format($amount,2): 0 ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </fieldset>
                    <div class="clear-fix mb-3"></div>
                

                <div class="row justify-content-center">
                
                <a class="btn btn-primary bg-gradient-primary border col-lg-3 col-md-2 col-sm-12 col-xs-12 rounded-pill" href="./?page=service_transactions/manage_transaction&id=<?= isset($id) ? $id : '' ?>"><i class="fa fa-edit"></i> Edit</a>
                <button class="btn btn-light bg-gradient-light border col-lg-3 col-md-2 col-sm-12 col-xs-12 rounded-pill" id="print"><i class="fa fa-print"></i> Print</button>
                <button class="btn btn-danger bg-gradient-danger border col-lg-3 col-md-2 col-sm-12 col-xs-12 rounded-pill" id="delete_transaction" type="button"><i class="fa fa-trash"></i> Delete </button>
            </div>
                </div>
                <hr>
                
            </div>
            <hr>
            
        </div>
    </div>
</div>
<noscript id="print-header">
    <div class="d-flex w-100">
        <div class="col-2 text-center">
            <img style="height:.8in;width:.8in!important;object-fit:cover;object-position:center center" src="<?= validate_image($_settings->info('logo')) ?>" alt="" class="w-100 img-thumbnail rounded-circle">
        </div>
        <div class="col-8 text-center">
            <div style="line-height:1em">
                <h4 class="text-center"><?= $_settings->info('name') ?></h4>
                <h3 class="text-center"><b>Transaction Details</b></h3>
            </div>
        </div>
    </div>
    <hr>
</noscript>
<script>
$(function(){
    $('#print').click(function(){
        var head = $('head').clone()
        var p = $('#printout').clone()
        var phead = $($('noscript#print-header').html()).clone()
        var el = $('<div>')
        el.append(head)
        el.find('title').text("Transaction Details-Print View")
        el.append(phead)
        el.append(p)
        el.find('.bg-gradient-navy').css({'background':'#001f3f linear-gradient(180deg, #26415c, #001f3f) repeat-x !important','color':'#fff'})
        el.find('.bg-gradient-secondary').css({'background':'#6c757d linear-gradient(180deg, #828a91, #6c757d) repeat-x !important','color':'#fff'})
        el.find('tr.bg-gradient-navy').attr('style',"color:#000")
        el.find('tr.bg-gradient-secondary').attr('style',"color:#000")
        start_loader();
        var nw = window.open("", "_blank", "width="+($(window).width() * .8)+", height="+($(window).height() * .8)+", left="+($(window).width() * .1)+", top="+($(window).height() * .1))
                 nw.document.write(el.html())
                 nw.document.close()
                 setTimeout(()=>{
                     nw.print()
                     setTimeout(()=>{
                        nw.close()
                        end_loader()
                     },300)
                 },500)
    })
    $('#update_status').click(function(){
        uni_modal("Update transaction Status", "transactions/update_status.php?id=<?= isset($id) ? $id : '' ?>")
    })
    $('#delete_transaction').click(function(){
        _conf("Are you sure to delete this transaction permanently?","delete_transaction",[])
    })
})
function delete_transaction($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_transaction",
			method:"POST",
			data:{id: '<?= isset($id) ? $id : "" ?>'},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.replace('./?page=transactions');
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>