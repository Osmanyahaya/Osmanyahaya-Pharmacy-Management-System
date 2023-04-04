<?php

require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `product` where prod_id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
	#cimg{
		width:100%;
		max-height:20vh;
		object-fit:scale-down;
		object-position:center center;
	}
</style>
<div class="container-fluid">
	<form action="" id="product-form">
		<div class="row" >
			<div class="col-md-6">
				<input type="hidden" name ="prod_id" value="<?php echo isset($prod_id) ? $prod_id : '' ?>">
		<div class="form-group">
			<label for="name" class="control-label">Product Name</label>
			<input type="text" name="prod_name" id="name" class="form-control form-control-sm rounded-0" value="<?php echo isset($prod_name) ? $prod_name : ''; ?>"  required/>
		</div>
			</div>

		<div class="col-md-6">
			<div class="form-group">
			<label for="description" class="control-label">Brand Code</label>
			<input type="text" name="prod_desc" id="name" class="form-control form-control-sm rounded-0" value="<?php echo isset($prod_desc) ? $prod_desc : ''; ?>"  />
			
		</div>
		</div>
			
		</div>
		
		<div class="row" >
			<div class="col-md-6">
				<input type="hidden" name ="prod_id" value="<?php echo isset($prod_id) ? $prod_id : '' ?>">
		<div class="form-group">
			<label for="price" class="control-label">Retail Price</label>
			<input type="number" name="prod_price" id="price" class="form-control form-control-sm rounded-0 text-right" value="<?php echo isset($prod_price) ? $prod_price : ''; ?>"  required/>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="price" class="control-label">Wholesale Price</label>
			<input type="number" name="prod_wprice" id="price" class="form-control form-control-sm rounded-0 text-right" value="<?php echo isset($prod_wprice) ? $prod_wprice : ''; ?>">
		</div>
	</div>
</div>
		<div class="row" >
			<div class="col-md-6">
			<div class="form-group">
			<label for="price" class="control-label">Cost Price</label>
			<input type="number" name="prod_cprice" id="price" class="form-control form-control-sm rounded-0 text-right" value="<?php echo isset($prod_cprice) ? $prod_cprice : ''; ?>"  required/>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="price" class="control-label">Quantity</label>
			<input type="number" name="prod_qty" id="price" class="form-control form-control-sm rounded-0 text-right" value="<?php echo isset($prod_qty) ? $prod_qty : ''; ?>" />
		</div>
	</div>
</div>
	<div class="row">
		<div class="col-md-6">
		<div class="form-group">
			<label for="price" class="control-label">Reorder Level</label>
			<input type="number" name="reorder" id="price" class="form-control form-control-sm rounded-0 text-right" value="<?php echo isset($reoder) ? $reorder : ''; ?>"  required/>
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
			<label for="price" class="control-label">Expiry Date</label>
			<input type="date" name="exdate" id="price" class="form-control form-control-sm rounded-0 text-right" value="<?php echo isset($exdate) ? $exdate : ''; ?>"  required/>
		</div>
	</div>
</div>
		<div class="form-group">
			<label for="status" class="control-label">Category</label>
			<select name="cat_id" id="status" class="form-control form-control-sm rounded-0" required>
				<?php
            
              $queryc=$conn->query("select * from category order by cat_name")or die(mysqli_error());
                while($rowc=mysqli_fetch_array($queryc)){
                ?>
                  <option value="<?php echo $rowc['cat_id'];?>"><?php echo $rowc['cat_name'];?></option>
                <?php }?>
			</select>
		</div>
		
	</form>
</div>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }
	        reader.readAsDataURL(input.files[0]);
	    }else{
				$('#cimg').attr('src', "<?= validate_image(isset($image_path) ? $image_path : '') ?>");
		}
	}
	$(document).ready(function(){
		$('#product-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_product",
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
                            $("html, body,.modal").scrollTop(0);
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
					}
				}
			})
		})

	})
</script>