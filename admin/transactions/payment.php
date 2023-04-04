<?php
require_once('../../config.php');

if(isset($_GET['id'])){
$cid=$_GET['id'];
	 
}
?>
<div class="container-fluid">
	<form action="" id="transaction-form" name="autoSumForm">
		<input type="hidden" name ="patient_id" value="<?php echo $cid ?>">
		<div class="form-group">
			<?php

             $query=$conn->query("select * from patient where patient_id='$cid' order by patient_id desc LIMIT 0,1");
              $row=mysqli_fetch_array($query);
       		$first=$row['first_name'];
         	$last=$row['othernames'];
         	$cname= $last .' '.$first;
         	?> 
			<label for="cname" class="control-label">Patient Name: </label>
			<label for="cname" class="control-label"><?php echo $cname ?></label>
			
		</div>
		<div class="form-group">
			<label for="name" class="control-label">Total Amount</label>
			<input type="text" style="text-align:right" class="form-control" id="total2" name="total" placeholder="Total" 
                 onFocus="startCalc();" onBlur="stopCalc();"  tabindex="5" readonly  >
		
		</div>
		<div class="form-group">
			<label for="discount" class="control-label">Discount</label>
			<input type="text" class="form-control text-right" id="discount" name="discount" value="0" tabindex="6" placeholder="Discount (Ghc)" onFocus="startCalc();" onBlur="stopCalc();" onkeypress="return isNumberKey(event)">
			<input type="hidden" style="text-align:right" class="form-control" id="amount" name="amount" placeholder="Amount Due" value="0" readonly>
		</div>
		<div class="form-group">
			<label for="price" class="control-label">Cash Tendered</label>
			<input type="tex" style="text-align:right" class="form-control" autocomplete="off" onFocus="startCalc();" onBlur="stopCalc();"  id="cash" name="cash_tendered" placeholder="Cash Tendered" required onkeypress="return isNumberKey(event)">
		</div>
		<div class="form-group">
			<label for="change" class="control-label">Balance</label>
			<input type="text" style="text-align:right" readonly="" class="form-control" id="change" name="balance" placeholder="Change">
		</div>
		
		
	</form>
</div>
<script>
	$(document).ready(function(){
		var patientid = $('#patient-id').val();
		
		 var total = $('#total').val();
		$('#total2').val(total);
		$('#cid').val(patientid);
    //console.log(total);
		$('#service-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_service",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.reload()
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})


	})

  function startCalc(){
  interval = setInterval("calc()",1);
}
function calc(){
  one = document.autoSumForm.total.value;
  two = document.autoSumForm.discount.value; 
  three = (one * 1) - (two * 1);
  document.autoSumForm.amount.value = three.toFixed(2);

  four = document.autoSumForm.cash_tendered.value; 
  five=(four * 1) - (three * 1);
  document.autoSumForm.change.value = five.toFixed(2);
}

function stopCalc(){
  clearInterval(interval);
}
function myFunction(){
    one = document.autoSumForm.total.value;
    document.autoSumForm.amount.value = one;
}

$('#transaction-form').submit(function(e){
e.preventDefault();
var _this = $(this)
 $('.err-msg').remove();
start_loader();
$.ajax({
	url:_base_url_+"classes/Master.php?f=save_transaction",
	data: new FormData($(this)[0]),
    cache: false,
    contentType: false,
    processData: false,
    method: 'POST',
    type: 'POST',
    dataType: 'json',
	error:err=>{
		
		alert_toast("An error occured",'error');
		end_loader();
	},
	success:function(resp){
		if(typeof resp =='object' && resp.status == 'success'){
            //console.log(resp);
			location.href = "./?page=transactions/view_details&id="+resp.tid+"&cid="+resp.cid
		}else if(resp.status == 'failed' && !!resp.msg){
            console.log(resp.error);
            var el = $('<div>')
                el.addClass("alert alert-danger err-msg").text(resp.msg)
                _this.prepend(el)
                el.show('slow')
                $("html, body,.modal").scrollTop(0);
                end_loader()
        }else{
			alert_toast("An error occured",'error');
			end_loader();
		}
	}
})
})





</script>