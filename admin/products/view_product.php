<?php

require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `product` natural join category where prod_id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
    #cimg{
        width:100%;
        max-height:20vh;
        object-fit:scale-down;
        object-position:center center
    }
</style>
<div class="container-fluid">
    
	<dl>
        <table  class="table table-bordered table-striped">
                    <thead>
                       <tr>
                        
                        <th>Product Number</th> <th><?php echo $prod_id;?></th>
                      </tr>
                      <tr>
                      
                        
                        <th>Product Name</th> <th><?php echo $prod_name;?></th>
                      </tr>
                       
                        <tr>
                      
                        
                        <th>Brand Code</th> <th><?php echo $prod_desc;?></th>
                      </tr>
                       
                                  <tr>
                      
                        
                        <th>Category</th> <th><?php echo $cat_name;?></th>
                      </tr>
                      <tr>
                      
                        
                        <th>Retail Price</th> <th><?php echo number_format($prod_price,2);?></th>
                      </tr>
                      <tr>
                      
                        
                       <th>Wholesale Price</th> <th><?php echo number_format($prod_wprice,2);?></th>
                      </tr>
                    
                      <tr>
                      
                        
                        <th>Cost Price</th> <th><?php echo number_format($prod_cprice,2);?></th>
                      </tr>
                       <tr>
                      
                        
                        <th>Quantity Left</th> <th><?php echo $prod_qty;?></th>
                      </tr>
                       <tr>
                      
                        
                        <th>Reorder level</th> <th><?php echo $reorder;?></th>
                      </tr>
                      <tr>
                      
                        
                        <th>Expiry Date <th><?php echo $exdate;?></th>
                      </tr>
                  </table>
    </dl>
    <div class="clear-fix my-3"></div>
    <div class="text-right">
        <button class="btn btn-sm btn-dark bg-gradient-dark btn-flat" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>