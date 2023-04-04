<?php 
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM `transaction_list` where id = '{$_GET['id']}' ");
if($qry->num_rows > 0){
$res = $qry->fetch_array();
foreach($res as $k => $v){
    if(!is_numeric($k)){
        $$k = $v;
    }
}
}else{
echo '<script> alert("Unknown Transaction\'s ID."); location.replace("./?page=transactions"); </script>';
}
}
?>
<div class="content py-3">
<div class="container-fluid">
<div class="card card-outline card-outline rounded-0 shadow blur">
    <div class="card-header">
        <h5 class="card-title"><?= isset($id) ? "Update ". $code . " Transaction" : "New Transaction" ?></h5>
    </div>
    
                <hr>
                <div class="row">
                    
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                        <div style="ml-4" class="card ml-2">
                        <form action="" id="transaction-form" name="autoSumForm">
                         <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
                         <input type="hidden" name="type" value="1">   
                    <fieldset class="ml-2 mr-2">
                        <legend>Products</legend>
                        <div class="row align-items-end">
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                <div class="form-group mb-0">
                                    <label for="product_sel" class="control-label">Select Product</label>
                                    <select onchange="addItem()" id="product_sel" class="form-control form-control-sm rounded">
                                        <option value="" disabled selected></option>
                                <?php 
                                $product_qry = $conn->query("SELECT * FROM `product`");
                                while($row = $product_qry->fetch_assoc()):
                                ?>
                                        <option value="<?= $row['prod_id'] ?>" data-price = "<?= $row['prod_price'] ?>"data-qty ="<?= $row['prod_qty'] ?>"><?= $row['prod_name']  ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <button class="btn btn-default bg-gradient-navy btn-sm rounded-0" type="button" id="add_product"><i class="fa fa-plus"></i> Add</button>
                            </div>
                        </div>
                        <div class="clear-fix mb-2"></div>
                        <table class="table table-striped table-bordered" id="product-list">
                            <colgroup>
                                <col width="5%">
                                <col width="40%">
                                <col width="15%">
                                <col width="20%">
                                <col width="20%">
                            </colgroup>
                            <thead>
                                <tr class="bg-gradient-navy">
                                    <th class="text-center"></th>
                                    <th class="text-center">Item Name</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $product_total = 0;
                                if(isset($id)):
                                $tp_qry = $conn->query("SELECT tp.*, p.prod_name as `product` FROM `transaction_products` tp inner join `product` p on tp.product_id = p.prod_id where tp.`transaction_id` = '{$id}' ");
                                while($row = $tp_qry->fetch_assoc()):
                                    $product_total += ($row['price'] * $row['qty']);
                            ?>
                                <tr>
                                    <td class="text-center">
                                        <button class="btn btn-outline-danger btn-sm rounded-0 rem-product" type="button"><i class="fa fa-times"></i></button>
                                    </td>
                                    <td>
                                        <input type="hidden" name="product_id[]" value="<?= $row['product_id'] ?>">
                                        <input type="hidden" name="product_price[]" value="<?= $row['price'] ?>">
                                        <span class="product_name"><?= $row['product'] ?></span>
                                    </td>
                                    <td class=""><input type="number" min="1" class="form-control form-control-sm rounded-0 text-right" name="product_qty[]" value="<?= $row['qty'] ?>"></td>
                                    <td class="text-right product_price"><?= $row['price'] ?></td>
                                    <td class="text-right product_total"><?= number_format(($row['price'] * $row['qty']),2) ?></td>
                                </tr>
                            <?php endwhile; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-secondary">
                                    <th colspan="4" class="text-center">Total</th>
                                    <th class="text-right" id="product_total"><?= isset($product_total) ? number_format($product_total,2): 0 ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </fieldset>
                    
                </div>
</div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                   <div class="card">
               
                <div class="card-body">
                    <fieldset>
                        
          <div class="row">
           <div class="col-md-12">
              
              <div class="form-group">
              <label for="date">Total Amount Payable</label>
              <input type="text" class="form-control" style="text-align:right;color: red; font-weight: 10px;"  value="<?= isset($product_total) ? format_num($product_total): 0 ?>" id="displaytotal"  placeholder="Total" 
                 onFocus="startCalc();" onBlur="stopCalc();"  tabindex="5" readonly>
                <input type="hidden" style="text-align:right" class="form-control" id="total" name="total"  placeholder="Total" 
                 onFocus="startCalc();" onBlur="stopCalc();"  tabindex="5" readonly>

                
              </div><!-- /.form group -->
              <div class="form-group">
           
              <label for="date">Discount</label>
                <input type="text" class="form-control text-right" id="discount" name="discount" value="<?= isset($discount) ? $discount : 0 ?>" tabindex="6" placeholder="Discount (Ghc)" onFocus="startCalc();" onBlur="stopCalc();" onkeypress="return isNumberKey(event)">
              </div><!-- /.form group -->
              <div class="form-group">
                <input type="hidden" style="text-align:right" class="form-control" id="amount" name="amount" value="<?= isset($amount) ? $amount : "" ?>" placeholder="Amount Due" readonly>
              
              </div><!-- /.form group -->
              
             
              <div class="form-group" id="tendered">
               
                <input type="tex" style="text-align:right" class="form-control" autocomplete="off" onFocus="startCalc();" onBlur="stopCalc();" value="<?= isset($cash_tendered) ? $cash_tendered : "" ?>"  id="cash_tendered" name="cash_tendered" placeholder="Cash Tendered by Customer" value="" required="" onkeypress="return isNumberKey(event)">
              </div><!-- /.form group -->
              <div class="form-group" id="change">
                <label for="date">Balance</label><br>
                <input type="text" style="text-align:right" readonly="" class="form-control" id="changed" value="<?= isset($balance) ? $balance : "" ?>" name="balance" placeholder="Change/Balance">
              </div><!-- /.form group -->

              <div class="form-group" id="tendered">
                
                <input type="text"  class="form-control"   id="client_name" value="<?= isset($client_name) ? $client_name : "###" ?>" name="client_name" placeholder="Enetr Customer Here">
              </div><!-- /.form group -->



          </div>
          
          

        </div>  
               
                  
                 
                      <button class="btn btn-lg btn-block btn-primary" id="salecompl" form="transaction-form"   tabindex="7">
                        Save Transaction
                      </button>
                        
                       <a href="./?page=transactions">
                        
            <button type="submit" class="btn btn-lg btn-danger btn-block" id="cart-trash" type="reset"  tabindex="8" style="margin-top:8px;">
                       Cancel
                      </button>
              
        </a> 
    </fieldset>
        </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                </div>

            </div>
            
            <hr>
            
          
        </div>
    </div>
    
</div>
</div>
</div>

<noscript id="product-clone">
<tr>
<td class="text-center">
    <button class="btn btn-outline-danger btn-sm rounded-0 rem-product" type="button"><i class="fa fa-times"></i></button>
</td>
<td>
    <input type="hidden" name="product_id[]" value="">
    <input type="hidden" name="product_price[]" value="0">
    <span class="product_name"></span>
</td>
<td class=""><input type="number" min="1" class="form-control form-control-sm rounded-0 text-right" name="product_qty[]" value="1"></td>
<td class="text-right product_price"></td>
<td class="text-right product_total"></td>
</tr>
</noscript>
<script>
function calc_total_amount(){
var total = 0;

$('#product-list tbody tr').each(function(){
    var qty = $(this).find('[name="product_qty[]"]').val()
    qty = qty > 0 ? qty : 0
    total += (parseFloat($(this).find('[name="product_price[]"]').val()) * parseFloat(qty))
})
$('[name="amount"]').val(parseFloat(total))
$('#displaytotal').val('Ghc '+total);
$('#total').val(total);
}

function calc_product(){
var total = 0;

$('#product-list tbody tr').each(function(){
    var qty = $(this).find('[name="product_qty[]"]').val()
    qty = qty > 0 ? qty : 0
    total += (parseFloat($(this).find('[name="product_price[]"]').val()) * parseFloat(qty))
})
$('#product_total').text(parseFloat(total).toLocaleString('en-US'))
calc_total_amount()
}
$(function(){
$('select#mechanic_id').select2({
    placeholder:"Select Mechanic here",
    width:'100%',
    containerCssClass:'form-control form-control-sm rounded-0'
})
$('#service_sel').select2({
    placeholder:"Select service here",
    width:'100%',
    containerCssClass:'form-control form-control-sm rounded-0'
})
$('#product_sel').select2({
    placeholder:"Select product here",
    width:'100%',
    containerCssClass:'form-control form-control-sm rounded-0'
})

$('#product-list tbody tr').find('.rem-product').click(function(){
    var tr = $(this).closest('tr')
    if(confirm("Are you sure to remove "+(tr.find('.product_name').text())+" from product list?") === true){
        tr.remove()
        calc_product()
    }
})
$('#product-list tbody tr').find('[name="product_qty[]"]').on('input change', function(){
    var tr = $(this).closest('tr')
    var qty = $(this).val()
    qty = qty > 0 ? qty : 0
    var total = parseFloat(qty) * parseFloat(price)
    tr.find('.product_total').text(parseFloat(total).toLocaleString())
    calc_product()

})

$('#add_product').click(function(){
    if($('#product_sel').val() == null)
    return false;
    var id = $('#product_sel').val()
    if($('#product-list tbody tr input[name="product_id[]"][value="'+id+'"]').length > 0){
        alert("Product already on the list.")
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
        var qty2 =$(this).val()
        if(qty>prodqty){
           alert_toast("Quantity Picked More Than Normal.","error")
        return false;
        $(this).val(qty2)
        }
        
        qty = qty > 0 ? qty : 0
        var total = parseFloat(qty) * parseFloat(price)
        tr.find('.product_total').text(parseFloat(total).toLocaleString())
        calc_product()

    })
    $('#product_sel').val('').trigger("change")
})
$('#product-list, #service-list').find('td, th').addClass('px-2 py-1 align-middle')
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
			console.log(err)
			alert_toast("An error occured",'error');
			end_loader();
		},
		success:function(resp){
			if(typeof resp =='object' && resp.status == 'success'){
				location.href = "./?page=transactions/view_details&id="+resp.tid
			}else if(resp.status == 'failed' && !!resp.msg){
                console.log(resp.error);
                var el = $('<div>')
                    el.addClass("alert alert-danger err-msg").text(resp.msg)
                    _this.prepend(el)
                    el.show('slow')
                    $("html, body,.modal").scrollTop(0);
                    end_loader()
            }else{
                console.log(resp);
				alert_toast("An error occured",'error');
				end_loader();
			}
		}
	})
})
})
</script>
<script type="text/javascript">
    ///
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


///

</script>
<script type="text/javascript">
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
  document.autoSumForm.balance.value = five.toFixed(2);

  
}
function stopCalc(){
  clearInterval(interval);
}
function myFunction(){
    one = document.autoSumForm.total.value;
    document.autoSumForm.amount.value = one;
}

function isNumberKey(event)
{ var charCode = (event.which) ? event.which : event.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    if(event.target.value.indexOf('.') >=0 && charCode == 46)
        return false;

    return true;
}
</script>