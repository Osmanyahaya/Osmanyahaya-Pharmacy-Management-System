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
}else{
echo '<script> alert("Unknown Transaction\'s ID."); location.replace("./?page=transactions"); </script>';
}
}
?>
<div class="content py-3">
<div class="container-fluid">
<div class="card card-outline card-outline rounded-0 shadow blur">
    <div class="card-header">
        <h5 class="card-title"><?= isset($id) ? "Update ". $code . " Service Transaction" : "New Service Transaction" ?></h5>
    </div>
    
                <hr>
                <div class="row">
                    
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                        <div style="ml-4" class="card ml-2">
                        <form action="" id="transaction-form" name="autoSumForm">
                         <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">   
                    <fieldset class="ml-2 mr-2">
                        <legend>Services</legend>
                        <div class="row align-items-end">
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                <div class="form-group mb-0">
                                    <label for="product_sel" class="control-label">Select Service</label>
                <select onchange="addService()" id="service_sel" class="form-control form-control-sm rounded">
                                <option value="" disabled selected></option>
                                <?php 
                                $service_qry = $conn->query("SELECT * FROM `service_list` order by `name`");
                                while($row = $service_qry->fetch_assoc()):
                                ?>
                                <option value="<?= $row['id'] ?>" data-price = "<?= $row['price'] ?>"><?= $row['name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <button class="btn btn-default bg-gradient-navy btn-sm rounded-0" type="button" id="add_service"><i class="fa fa-plus"></i> Add</button>
                            </div>
                        </div>
                        <div class="clear-fix mb-2"></div>
                        <table class="table table-striped table-bordered" id="service-list">
                            
            <thead>
                            <tr class="bg-gradient-navy">
                                <th class="text-center"></th>
                                <th class="text-center">Service</th>
                                <th class="text-center">Price</th>
                            </tr>
                        </thead>
                            <tbody>
                            <?php 
                        $service_amount = 0;
                        if(isset($id)):
                        $ts_qry = $conn->query("SELECT ts.*, s.name as `service` FROM `transaction_services` ts inner join `service_list` s on ts.service_id = s.id where ts.`transaction_id` = '{$id}' ");
                        while($row = $ts_qry->fetch_assoc()):
                            $service_amount += $row['price'];
                        ?>
                        <tr>
                            <td class="text-center">
                                <button class="btn btn-outline-danger btn-sm rounded-0 rem-service" type="button"><i class="fa fa-times"></i></button>
                            </td>
                            <td>
                                <input type="hidden" name="service_id[]" value="<?= $row['service_id'] ?>">
                                <input type="hidden" name="service_price[]" value="<?= $row['price'] ?>">
                                <span class="service_name"><?= $row['service'] ?></span>
                            </td>
                            <td class="text-right service_price"><?= format_num($row['price']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                        <?php endif; ?>
        </tbody>
        <tfoot>
            <tr class="bg-gradient-secondary">
                    <th colspan="2" class="text-center">Total</th>
                    <th class="text-right" id="service_total"><?= isset($service_amount) ? format_num($service_amount): 0 ?></th>
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

<noscript id="service-clone">
<tr>
<td class="text-center">
    <button class="btn btn-outline-danger btn-sm rounded-0 rem-service" type="button"><i class="fa fa-times"></i></button>
</td>
<td>
    <input type="hidden" name="service_id[]" value="">
    <input type="hidden" name="service_price[]" value="0">
    <span class="service_name"></span>
</td>
<td class="text-right service_price"></td>
</tr>
</noscript>

<script>
function calc_total_amount(){
var total = 0;
$('#service-list tbody tr').each(function(){
    total += parseFloat($(this).find('[name="service_price[]"]').val())
})

$('[name="amount"]').val(parseFloat(total))
$('#amount').text(parseFloat(total).toLocaleString('en-US'))
$('#displaytotal').val('Ghc '+total);
$('#total').val(total);
}
function calc_service(){
var total = 0;
$('#service-list tbody tr').each(function(){
    total += parseFloat($(this).find('[name="service_price[]"]').val())
})
$('#service_total').text(parseFloat(total).toLocaleString('en-US'))
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
$('#service-list tbody tr').find('.rem-service').click(function(){
    var tr = $(this).closest('tr')
    if(confirm("Are you sure to remove "+(tr.find('.service_name').text())+" from service list?") === true){
        tr.remove()
        calc_service()
    }
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

$('#transaction-form').submit(function(e){
    e.preventDefault();
    var _this = $(this)
     $('.err-msg').remove();
    start_loader();
    $.ajax({
        url:_base_url_+"classes/Master.php?f=save_service_transaction",
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
                location.href = "./?page=service_transactions/view_details&id="+resp.tid
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
<script type="text/javascript">
    function addService(){
    if($('#service_sel').val() == null)
    return false;
    var id = $('#service_sel').val()
    if($('#service-list tbody tr input[name="service_id[]"][value="'+id+'"]').length > 0){
        alert("Service already on the list.")
        return false;
    }
    var name = $('#service_sel option[value="'+id+'"]').text()
    var price = $('#service_sel option[value="'+id+'"]').attr('data-price')
    var tr = $($('noscript#service-clone').html()).clone()
    tr.find('input[name="service_id[]"]').val(id)
    tr.find('input[name="service_price[]"]').val(price)
    tr.find('.service_name').text(name)
    tr.find('.service_price').text(parseFloat(price).toLocaleString())
    $('#service-list tbody').append(tr)
    calc_service()
    tr.find('.rem-service').click(function(){
        if(confirm("Are you sure to remove "+name+" from service list?") === true){
            tr.remove()
            calc_service()
        }
    })
    $('#service_sel').val('').trigger("change")
}
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