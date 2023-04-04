<?php
//require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `expense` where expense_id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="container-fluid">
	<form action="" id="service-form">
		<input type="hidden" name ="expense_id" value="<?php echo isset($expense_id) ? $expense_id : '' ?>">
		<div class="form-group">
			<label for="status" class="control-label">Description</label>
			<select name="type" id="type" class="form-control form-control-sm rounded-0" required>
			<option value="Salary" <?php echo isset($type) && $type == 'Salary' ? 'selected' : '' ?>>Salary</option>
			<option value="Cost of Electricity" <?php echo isset($type) && $type == 'Cost of Electricity' ? 'selected' : '' ?>>Cost of Electricity</option>
			<option value="Cost of Water" <?php echo isset($type) && $type == 'Cost of Water' ? 'selected' : '' ?>>Cost of Water</option>
			<option value="Cost of Maintenance" <?php echo isset($type) && $type == 'Cost of Maintenance' ? 'selected' : '' ?>>Cost of Maintenance</option>
			<option value="Miscellaneous Expenses" <?php echo isset($type) && $type == 'Miscellaneous Expenses' ? 'selected' : '' ?>>Miscellaneous Expenses</option>
			<option value="0" selected disabled>Select Expense Type</option>
			</select>
		</div>
		<div class="form-group">
			<label for="detail" class="control-label">More Info(If any)</label>
			<input type="text" name="details" id="name" class="form-control form-control-sm rounded-0" value="<?php echo isset($details) ? $details : ''; ?>"/>
		</div>
		
		<div class="form-group">
			<label for="price" class="control-label">Amount</label>
			<input type="number" name="amount" id="amount" class="form-control form-control-sm rounded-0 text-right" value="<?php echo isset($amount) ? $amount : ''; ?>"  required/>
		</div>
		<div class="form-group">
			<label for="detail" class="control-label">Date</label>
			<input type="date" name="date_added" id="date" class="form-control form-control-sm rounded-0" value="<?php echo isset($date_added) ? $date_added : ''; ?>"/>
		</div>
		
		
	</form>
</div>
<script>
	$(document).ready(function(){
		$('#service-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_expense",
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
</script>