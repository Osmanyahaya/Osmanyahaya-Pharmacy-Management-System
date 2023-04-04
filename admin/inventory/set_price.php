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

		<div class="container-fluid">
  <form action="" id="set-price-form">
    <input type="hidden" name ="prod_id" value="<?php echo isset($prod_id) ? $prod_id : '' ?>">
    <div class="form-group">
      <label for="quantity" class="control-label">Select Product</label>
      <select class="form-control select2" id="productprice"  name="prod_id" required>
        <option selected value="<?php echo isset($prod_id) ? $prod_id : '' ?>"> <?php echo isset($prod_name) ? $prod_name : '' ?></option>
                        
                      <?php
             $product_qry = $conn->query("SELECT * FROM `product`");
             
                  while($row=mysqli_fetch_array($product_qry)){
              ?>
                    <option disabled value="<?php echo $row['prod_id'];?>"><?php echo $row['prod_name'];?></option>
              <?php }?>
                    </select>
    </div>
    <div class="form-group">
      <label for="prod_cprice" class="control-label">New Cost Price</label>
      <input type="text" name="prod_cprice" id="date_created"  class="form-control form-control-sm rounded-0 text-right" onkeypress="return isNumberKey(event)" value="<?php echo isset($prod_cprice) ? $prod_cprice : '0' ?>"  required/>
    </div>
    <div class="form-group">
      <label for="prod_price" class="control-label">New Retail Price</label>
      <input type="text" name="prod_price" id="date_created" class="form-control form-control-sm rounded-0 text-right" onkeypress="return isNumberKey(event)" value="<?php echo isset($prod_price) ? $prod_price : '0' ?>"  required/>
    </div>
    <div class="form-group">
      <label for="prod_wprice" class="control-label">New Wholesale Price</label>
      <input type="text" name="prod_wprice" id="date_created" class="form-control form-control-sm rounded-0 text-right" onkeypress="return isNumberKey(event)" value="<?php echo isset($prod_wprice) ? $prod_wprice : '' ?>"  required/>
    </div>
  </form>
</div>
<script>
	$(document).ready(function(){
		$('#set-price-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_price_change",
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
        $('select#productprice').select2({
    placeholder:"Select product here",
    width:'100%',
    containerCssClass:'form-control form-control-sm rounded-0'
})

    })

  function isNumberKey(event)
{ var charCode = (event.which) ? event.which : event.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    if(event.target.value.indexOf('.') >=0 && charCode == 46)
        return false;

    return true;
}
//
function addItem(){
    if($('#product_sel').val() == null)
    return false;
    var id = $('#product_sel').val()
    if($('#product-list tbody tr input[name="product_id[]"][value="'+id+'"]').length > 0){
        alert_toast("Product already on the list.","error")
        return false;
    }
    var name = $('#product_sel option[value="'+id+'"]').text()
    var price = $('#product_sel option[value="'+id+'"]').attr('data-price')
    var prodqty = $('#product_sel option[value="'+id+'"]').attr('data-qty')
    var tr = $($('noscript#product-clone').html()).clone()
    tr.find('input[name="product_id[]"]').val(id)
    tr.find('input[name="product_price[]"]').val(price)
    tr.find('.product_name').text(name)
    tr.find('.product_price').text(parseFloat(price).toLocaleString())
    tr.find('.product_total').text(parseFloat(price).toLocaleString())
    $('#product-list tbody').append(tr)
    calc_product()
    tr.find('.rem-product').click(function(){
        if(confirm("Are you sure to remove "+name+" from product list?") === true){
            tr.remove()
            calc_product()
        }
    })
    tr.find('[name="product_qty[]"]').on('input change', function(){
        var qty = $(this).val()
        //var qty2 =$(this).val()
        if(qty>prodqty){
           alert_toast("Quanity Picked More Than Available",'error');
        //return false;
        //$(this).val(qty2)
        }
        
        qty = qty > 0 ? qty : 0
        var total = parseFloat(qty) * parseFloat(price)
        tr.find('.product_total').text(parseFloat(total).toLocaleString())
        calc_product()

    })
    $('#product_sel').val('').trigger("change")
}
//
</script>