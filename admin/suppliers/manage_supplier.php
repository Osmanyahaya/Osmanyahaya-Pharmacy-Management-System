<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `supplier` where supplier_id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="content py-5 px-3 bg-gradient-info">
	<h2><b><?= isset($supplier_id) ? "Update Category Details" : "New Category Entry" ?></b></h2>
</div>
<div class="row mt-lg-n4 mt-md-n4 justify-content-center">
	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
		<div class="card rounded-0">
			<div class="card-body">

				<div class="container-fluid">
					<form action="" id="supplier-form">
						<input type="hidden" name ="supplier_id" value="<?php echo isset($supplier_id) ? $supplier_id : '' ?>">
						<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label for="name" class="control-label">Name</label>
							<input type="text" name="supplier_name" id="name" class="form-control form-control-sm rounded-0" value="<?php echo isset($supplier_name) ? $supplier_name : ''; ?>"  required/>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label for="name" class="control-label">Address</label>
							<textarea class="form-control form-control-sm rounded-0 pull-right" name="supplier_address">
								<?php echo isset($supplier_address) ? $supplier_address : ''; ?>
							</textarea>
							
						</div>
						<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label for="name" class="control-label">Contact</label>
							<input type="text" name="supplier_contact" id="contact" class="form-control form-control-sm rounded-0" value="<?php echo isset($supplier_contact) ? $supplier_contact : ''; ?>"  required/>
						</div>
						
						
					</form>
				</div>
			</div>
			<div class="card-footer py-1 text-center">
				<button class="btn btn-primary btn-sm bg-gradient-primary btn-flat" form="supplier-form"><i class="fa fa-save"></i> Save</button>
				<a class="btn btn-light btn-sm bg-gradient-light border btn-flat" href="./?page=suppliers"><i class="fa fa-times"></i> Cancel</a>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#supplier-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_supplier",
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
						//location.replace('./?page=suppliers')
						location.reload()
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").scrollTop(0);
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