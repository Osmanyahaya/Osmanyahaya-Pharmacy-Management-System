    <?php
$user=$_settings->userdata('id'); 
if(isset($_SESSION['sid'])){

    
$qry = $conn->query("SELECT * FROM `stock_list` where sid = '{$_SESSION['sid']}' ");
if($qry->num_rows > 0){
$res = $qry->fetch_array();
foreach($res as $k => $v){
    if(!is_numeric($k)){
        $$k = $v;
    }
}

}else{
echo '<script> alert("Unknown Stock\'s ID."); location.replace("./?page=inventory"); </script>';
}

    $sid= $_SESSION['sid'];
    unset($_SESSION['sid']);
    
}
?>
    <style>
    #cimg{
    width:15em !important;
    height:15em;
    object-fit:scale-down;
    object-position:center center
    }
    </style>
    <div class="container-fluid content px-3 py-4 bg-gradient-navy">
    
    <h5 ><?= isset($sid) ? "Update ". $sid . " Stock" : "New Stock" ?></h5>
   
    </div>
    <div class="row justify-content-center mt-n4">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mx-sm-1 mx-xs-1">
    <div class="card rounded-0 shadow">
        <div class="card-header">
           
    
               
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <fieldset class="card">
                   
                    <hr>
                    <form action="" id="stock-in-form">
                        
                  <div class="form-group">
                    
                    <div class="input-group col-lg-8 col-md-8 col-sm-12 col-xs-12">
                      <select class="form-control select2" name="prod_id" required>
                        <option selected="selected" value="" disabled>Pick Item to Stock</option>
                      <?php
            $product_qry = $conn->query("SELECT * FROM `product`");
            if(isset($_GET['id']) && $_GET['id'] > 0){
            $qry = $conn->query("SELECT * from `stockin` where stockin_id = '{$_GET['id']}' ");
            if($qry->num_rows > 0){
            foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
                  while($row=mysqli_fetch_array($product_qry)){
              ?>
                    <option value="<?php echo $row['prod_id'];?>"><?php echo $row['prod_name'];?></option>
              <?php }?>
                    </select>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
            
         <div class="form-group">
                   
                    <div class="input-group col-lg-8 col-md-8 col-sm-12 col-xs-12">
                      <input type="date" class="form-control pull-right" id="prod)exdate" name="prod_exdate" placeholder="Expiry Date">
                      
                    </div><!-- /.input group -->
                    <small style="margin-left: 8px" class="text-muted"><i>Pick Expiry Date</i></small>
                  </div><!-- /.form group -->
          
                  <div class="form-group">
                    
                    <div class="input-group col-lg-8 col-md-8 col-sm-12 col-xs-12">
                      <input type="number" class="form-control pull-right" id="date" name="qty" placeholder="Quantity" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <div class="input-group">
                      <button form="stock-in-form" class="btn btn-primary mr-2"  >
                        Add
                      </button>
                      <button type="reset" class="btn btn-danger" >
                        Clear
                      </button>
                    </div>
                  </div><!-- /.form group -->
                </form>
                </fieldset>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                <form id="stock-save">
                <div  class="form-group">
                     <input type="hidden" name="id" value="<?= isset($sid) ? $sid : '' ?>">
              <label for="date">Supplier</label>
              <select class="form-control select2"  name="supplier_id" required>
                <option value="0" selected >Select Supplier</option>
                <?php
            
                $supl_qry = $conn->query("SELECT * FROM `supplier`");
                while($row2=mysqli_fetch_array($supl_qry)){
                ?>
                  <option value="<?php echo $row2['supplier_id'];?>"><?php echo $row2['supplier_name'];?></option>
                <?php }?>
              </select>
                
              </div><!-- /.form group -->
              

              <div class="form-group" id="tendered">
                
                <input type="text"  class="form-control"   id="invoice" value="<?= isset($invoice) ? $ivoice : "" ?>" name="invoice" placeholder="Enter Invoice Number" required>
              </div><!-- /.form group -->
          </div>
        </div>  
            </div>
            </div>
            <div  class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <fieldset class="card">
                   
            <table class="table table-hover table-striped table-bordered" id="list">
                        <thead>
                         <tr >
    
                         <th>S/N</th>
                         <th>Product Name</th>
                         <th>Exp. Date</th>
                         <th>S. Price</th>
                         <th>C. Price</th>
                         <th>Qty</th>
                         <th>T. Cost</th>
                          <th>Action</th>   
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total=0;
                            $sumtotal=0;
                            $n=1;
                            $inv_qry = $conn->query("SELECT * FROM `stockin_cart` natural join product order by stockin_id desc");
                            while($row = $inv_qry->fetch_assoc()):
                                $total =$row['prod_cprice']*$row['qty'];
                                  $sumtotal =$sumtotal+$total;
                            ?>
                            <tr>
                               <td class="align-middle"><?= $n ?></td>
                                <td class="align-middle"><?= $row['prod_name'] ?></td>
                                
                                <td class="align-middle"><?= date("M d, Y", strtotime($row['prod_exdate'])) ?></td>
                                <td class="align-middle"><?= $row['prod_price'] ?></td>
                                <td class="align-middle"><?= $row['prod_cprice'] ?></td>
        
                                 
                                    <td >
                                    <input type="text" name="" class="form-control cart-item" id="sprice_<?php echo $row['stockin_id']?>"
                                    data-id="<?php echo $row['stockin_id']?>"
                                    value="<?php echo $row['qty']?>"
                                    >
                                    </td>
                                     <td class="align-middle"><?= $total ?></td>

                               
                                <td >

                                    <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['prod_id'] ?>" data-qty="<?php echo $row['qty']?>" data-pid="<?php echo $row['prod_id'] ?>"><span class="fa fa-edit text-info"></span> Update Price</a>
                                         <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['stockin_id'] ?>" data-qty="<?php echo $row['qty']?>" data-pid="<?php echo $row['prod_id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                    </div>
                                </td>
                              
                            </tr>
                            <?php $n++; endwhile; ?>
                            <tr>
                                
                                  <td><input type="hidden" name="amount" value="<?php echo $sumtotal?>"></td>
                                   <td></td>
                                    <td></td>
                                     <td></td>
                                      <td></td>
                                      
                                         <td>Total Cost of Items</td>
                                  <td >
                                    
                                    <?php echo number_format($sumtotal,2) ?>
                                </td>
                                <td><button form="stock-save" class="btn btn-primary mr-2"  >
                        Save
                      </button></td>
                      </form>
                            </tr>
                            <?php if($inv_qry->num_rows <= 0): ?>
                            <tr>
                                <th colspan="3">No data</th>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                            </table>
                        </fieldset>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
    $(function(){
    $('#create_new').click(function(){
        uni_modal('<i class="far fa-plus-square"></i> Change Product Price', 'inventory/set_price.php?')
    })
    $('.edit_data').click(function(){
        uni_modal('<i class="far fa-edit-square"></i> Edit Stock-In', 'inventory/set_price.php?id=<?= isset($id) ? $id : '' ?>&id='+$(this).attr('data-id'))

        
    })
    $('.delete_data').click(function(){
    	_conf("Are you sure to delete this Stock permanently?","delete_stockin",[$(this).attr('data-id'),$(this).attr('data-qty'),$(this).attr('data-pid')],)
    })
    })
    function delete_stockin($id,$qty,$prodid){
    start_loader();
    $.ajax({
    	url:_base_url_+"classes/Master.php?f=delete_stockin",
    	method:"POST",
    	data:{id: $id,qty: $qty,prodid: $prodid},
    	dataType:"json",
    	error:err=>{
    		console.log(err)
    		alert_toast("An error occured.",'error');
    		end_loader();
    	},
    	success:function(resp){
    		if(typeof resp== 'object' && resp.status == 'success'){
    			location.reload();
    		}else{
    			alert_toast("An error occured.",'error');
    			end_loader();
    		}
    	}
    })
    }
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

    })


    $(document).ready(function(){
        
        $('#stock-in-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
             $('.err-msg').remove();
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=stockin_cart_add",
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
                        console.log(resp.msg);
                        alert_toast("An error occured",'error');
                        end_loader();
                    }
                }
            })
        })

$('#stock-save').submit(function(e){
            e.preventDefault();
            var _this = $(this)
             
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
                        console.log(resp.msg);
                        alert_toast("An error occured",'error');
                        end_loader();
                    }
                }
            })
        })
    })
    function addItem(){
    if($('#productlist').val() == null)
    return false;
    var id = $('#productlist').val()
        uni_modal('<i class="far fa-edit-square"></i> Set Price', 'inventory/set_price.php?id='+id)



    $('#productlist').val('').trigger("change")
}
$(function(){
  $(document).on('change', '.cart-item', function(e){
    e.preventDefault();
      //var id = $(this);
      //id = id.attr("id");
      var id = $(this).data('id');

    var qty = $('#sprice_'+id).val();

    $.ajax({
      type: 'POST',
      url: _base_url_+"classes/Master.php?f=stockin_cart_update",
      data: {
        id: id,
        qty: qty,
      },
      dataType: 'json',
      success: function(response){
        if(!response.error){
           location.reload(true)
        }else{
          getDetails();
          
          alert_toast(response.message,'error');
        }
  
      }
    });
  });
  });
</script>
 