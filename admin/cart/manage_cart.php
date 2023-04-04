<?php
$user=$_settings->userdata('id'); 
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

$query=$conn->query("select * from transaction_products where transaction_id='$id'");
        foreach ($query as $row)
        {
            $pid=$row['product_id'];   
            $qty=$row['qty'];
            $price=$row['price'];
            $conn->query("INSERT INTO cart(prod_id,quantity,price,user_id) VALUES('$pid','$qty','$price','$user')");
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
                    
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div style="ml-4" class="card ml-2">
                         
                    <fieldset class="ml-2 mr-2">
                        <form id="productForm">
                            <input type="hidden" value="1" name="quantity">
                        <div class="row align-items-end">
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                <div class="form-group mb-0">
                                    
                                    <select onchange="addToCart()" id="product_sel" class="form-control form-control-sm rounded" name="prodid">
                                        <option value="" disabled selected></option>
                                <?php 
                                $product_qry = $conn->query("SELECT * FROM `product`");
                                while($row = $product_qry->fetch_assoc()):
                                ?>
                            <option value="<?= $row['prod_id'] ?>" data-price = "<?= $row['prod_price'] ?>"data-qty ="<?= $row['prod_qty'] ?>">
                                <?= $row['prod_name'].' |price '.$row['prod_price']. '| Qty '.$row['prod_qty']  ?>
                                    
                                </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <button class="btn btn-default bg-gradient-primary btn-sm rounded-0" type="button" form="productForm" id="add_product"><i class="fa fa-plus"></i> Add</button>

                            </div>
                        </div>
                        </form>
                        <div class="clear-fix mb-2"></div>
                          <br>
                            <br>
                        <table class="table table-striped table-bordered" id="product-list">
                            <form action="" id="transaction-form" name="autoSumForm">
                         <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
                         <input type="hidden" name="type" value="1">  
                            
                            <thead>
                                <tr >
                                    <th class="text-center"></th>
                                    <th class="text-center">Item Name</th>
                                    <th class="text-center">Price(Ghc)</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                           
                                <tbody id='tbody'>
                  
                           
                            </tbody >
                            
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
             
              <input type="text" class="form-control" style="text-align:right;color: red; font-weight: 10px;"  value="<?= isset($product_total) ? format_num($product_total): 0 ?>" id="displaytotal"  placeholder="Total" 
                 onFocus="startCalc();" onBlur="stopCalc();"  tabindex="5" readonly>
                <input type="hidden" style="text-align:right" class="form-control" id="total" name="total"  placeholder="Total" 
                 onFocus="startCalc();" onBlur="stopCalc();"  tabindex="5" readonly>

                
              </div><!-- /.form group -->
              <div class="form-group">
            <div class="form-group" id="tendered">
               
                <input type="tex" style="text-align:right" class="form-control" autocomplete="off" onFocus="startCalc();" onBlur="stopCalc();" value="<?= isset($cash_tendered) ? $cash_tendered : "" ?>"  id="cash_tendered" name="cash_tendered" placeholder="Enter Cash" value="" required="" onkeypress="return isNumberKey(event)">
              </div><!-- /.form group -->
              <div class="form-group" id="tendered">
                
                <input type="text"  class="form-control"   id="client_name" value="<?= isset($client_name) ? $client_name : "" ?>" name="client_id" placeholder="Enetr Customer Here">
              </div><!-- /.form group -->
           
              <label for="date">Discount</label>
                <input type="text" class="form-control text-right" id="discount" name="discount" value="<?= isset($discount) ? $discount : 0 ?>" tabindex="6" placeholder="Discount (Ghc)" onFocus="startCalc();" onBlur="stopCalc();" onkeypress="return isNumberKey(event)">
              </div><!-- /.form group -->
              <div class="form-group">
                 <label for="date">Total Amount Payable</label>
                <input type="text" style="text-align:right" class="form-control" id="amount" name="amount" value="<?= isset($amount) ? $amount : "" ?>" placeholder="Amount Due" readonly>
              
              </div><!-- /.form group -->
              
             
              
              <div class="form-group" id="change">
                <label for="date">Balance</label><br>
                <input type="text" style="text-align:right" readonly="" class="form-control" id="changed" value="<?= isset($balance) ? $balance : "" ?>" name="balance" placeholder="Balance">
              </div><!-- /.form group -->

              



          </div>
          
          

        </div>  
               
                  
                 
                      <button class="btn btn-lg btn-block btn-primary" id="salecompl" form="transaction-form"   tabindex="7">
                        Save Transaction
                      </button>
                        
                       <a href="./?page=transactions">
                        
            <button   class="btn btn-lg btn-danger btn-block" id="cart-trash" type="reset"  tabindex="8" style="margin-top:8px;">
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
                //location.href = "./pos?id="+resp.tid
                location.href = "./?page=pos/&id="+resp.tid
               //location.href = "./?page=cart/manage_cart"
				//location.href = "./?page=transactions/view_details&id="+resp.tid
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
///
<script type="text/javascript">
    $(function(){
  $(document).on('click', '#cart-trash', function(e){
    e.preventDefault();
    var id = $('#form-cart-trash').serialize();
    $.ajax({
      type: 'POST',
      url:  _base_url_+"admin/cart/cart_trash.php",
      data: {id:id},
      dataType: 'json',
      success: function(response){
        if(!response.error){
          getDetails();
          
        }
      }
    });
  });
  

  $(document).on('click', '.minus', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var qty = $('#qty_'+id).val();
    if(qty>1){
      qty--;
    }
    $('#qty_'+id).val(qty);
    $.ajax({
      type: 'POST',
      url: _base_url_+"classes/Master.php?f=cart_update",
      data: {
        id: id,
        qty: qty,
      },
      dataType: 'json',
      success: function(response){
        if(!response.error){
          getDetails();
          
        }
      }
    });
  });
  $(document).on('click', '.cart_delete', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
      type: 'POST',
      url: _base_url_+"classes/Master.php?f=delete_cart_item",
      data: {id:id},
      dataType: 'json',
      success: function(response){
        if(!response.error){
          getDetails();
         
        }
      }
    });
  });

  $(document).on('click', '.add', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var qty = $('#qty_'+id).val();
    //oldqty = $('#oldqty').val();
    qty++;

    $.ajax({
      type: 'POST',
      url: _base_url_+"classes/Master.php?f=cart_update",
      data: {
        id: id,
        qty: qty,
      },
      dataType: 'json',
     success: function(response){
        if(!response.error){
          getDetails();
          
        }else{

            alert_toast(response.message,'error');
         
        }
  
      }
    });
  });

  getDetails();

});
  $(function(){
  $(document).on('change', '.cart-item', function(e){
    

      //var id = $(this);
      //id = id.attr("id");
      var id = $(this).data('id');

    var qty = $('#qty_'+id).val(); 
    $.ajax({
      type: 'POST',
      url: _base_url_+"classes/Master.php?f=cart_update",
      data: {
        id: id,
        qty: qty,
      },
      dataType: 'json',
      success: function(response){
        if(!response.error){
          getDetails();
        }else{
          getDetails();
          
          alert_toast(response.message,'error');
        }
  
      }
    });
  });
  });

function getDetails(){
  $.ajax({
    type: 'POST',
    url: _base_url_+"classes/Master.php?f=get_cart_details",
    dataType: 'json',
    success: function(response){
      $('#tbody').html(response.tabledata);
     total = response.product_total;
      $('#total').val(total);
      $('#displaytotal').val('Ghc '+total);
    }
  });
}


$(function(){
  $('#add').click(function(e){
    e.preventDefault();
    var quantity = $('#quantity').val();
    quantity++;
    $('#quantity').val(quantity);
  });
  $('#minus').click(function(e){
    e.preventDefault();
    var quantity = $('#quantity').val();
    if(quantity > 1){
      quantity--;
    }
    $('#quantity').val(quantity);
  });

});

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
<script>
$(function(){

  $('#productForm').submit(function(e){
    e.preventDefault();
    var product = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: _base_url_+"classes/Master.php?f=add_to_cart",
        data: product,
        dataType: 'json',
        success: function(resp){
           
        if(resp.status == 'success'){
                    getDetails();
                    
                alert_toast(resp.msg,'success')
            }else if(resp.status == 'failed'){
                console.log(resp.msg);
                alert_toast(resp.msg,'error');
                getDetails();
                   
                    end_loader()
            }else{
                console.log(resp);
                alert_toast("An error mm occured",'error');
                getDetails();
                    
                end_loader();
            }
        }
    });
  });



});


function addToCart(){
var product = $('#productForm').serialize();
    $.ajax({
        url:_base_url_+"classes/Master.php?f=add_to_cart",
        data: product,
        type: 'POST',
        dataType: 'json',
        error:err=>{
            console.log(err)
            alert_toast("An error occured",'error');
            end_loader();

        },
        success:function(resp){
            if(resp.status == 'success'){
                    getDetails();
                    
                alert_toast(resp.msg,'success')
            }else if(resp.status == 'failed'){
                console.log(resp.msg);
                alert_toast(resp.msg,'error');
                getDetails();
                   
                    end_loader()
            }else{
                console.log(resp);
                alert_toast("An error mm occured",'error');
                getDetails();
                    
                end_loader();
            }
        }

    })
    }

$(function(){
  $(document).on('click', '#cart-trash', function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: _base_url_+"classes/Master.php?f=cart_trash",
      dataType: 'json',
      success: function(resp){
        if(resp.status == 'success'){
        alert_toast(resp.msg,'success')

        }
      }
    })
  })
   })
</script>