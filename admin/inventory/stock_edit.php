<?php
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `stockin` natural join product where stockin_id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }

$qry = $conn->query("SELECT * from `stockin` natural join supplier where stockin_id = '{$_GET['id']}'");
while($row = $qry->fetch_assoc()){
    $supplier_id=$row['supplier_id'];
    $supplier_name=$row['supplier_name'];
}
}

    
    

?>
<div class="container-fluid">
	<form  action="" id="edit-form">
		<input type="hidden" name ="stockin_id" value="<?php echo isset($stockin_id) ? $stockin_id : '' ?>">
		<input type="hidden" name ="stockin_id" value="<?php echo isset($stockin_id) ? $stockin_id : '' ?>">
  
                  <div class="form-group">
                    <label for="date">Product Name</label>
                    <div class="input-group col-lg-8 col-md-8 col-sm-12 col-xs-12">
                      <select class="form-control select2" value="<?php echo isset($prod_id) ? $prod_id : 0; ?>" name="prod_id" required>
                        <option selected="selected" value="<?php echo isset($prod_id) ? $prod_id : 0; ?>"><?php echo isset($prod_name) ? $prod_name : 0; ?></option>
                      <?php
             $product_qry = $conn->query("SELECT * FROM `product`");
             
                  while($row=mysqli_fetch_array($product_qry)){
              ?>
                    <option value="<?php echo $row['prod_id'];?>"><?php echo $row['prod_name'];?></option>
              <?php }?>
                    </select>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
          <label for="date">Supplier</label>
          <div class="input-group col-lg-8 col-md-8 col-sm-12 col-xs-12">
              <select class="form-control select2"  name="supplier" required>
              	<option selected="selected" value="<?php echo isset($supplier_id) ? $supplier_id : 0; ?>"><?php echo isset($supplier_name) ? $supplier_name : 0; ?></option>
                <?php
            
                $supl_qry = $conn->query("SELECT * FROM `supplier`");
                while($row2=mysqli_fetch_array($supl_qry)){
                ?>
                  <option value="<?php echo $row2['supplier_id'];?>"><?php echo $row2['supplier_name'];?></option>
                <?php }?>
              </select>
          </div>
        </div> 
         <div class="form-group">
                    <label for="date">Expiry Date</label>
                    <div class="input-group col-lg-8 col-md-8 col-sm-12 col-xs-12">
                      <input type="date" class="form-control pull-right" id="date" name="exdate" value="<?php echo isset($exdate) ? $exdate : 0; ?>" placeholder="Expiry Date">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
          
                  <div class="form-group">
                    <label for="date">Quantity</label>
                    <div class="input-group col-lg-8 col-md-8 col-sm-12 col-xs-12">
                      <input type="number" class="form-control pull-right" value="<?php echo isset($qty) ? $qty : 0; ?>" id="date" name="qty" placeholder="Quantity" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->


                 
                
                  
                </form>
	</form>
</div>
<script>
	$(document).ready(function(){
		$('#edit-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_stockin",
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
	$(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

    })
