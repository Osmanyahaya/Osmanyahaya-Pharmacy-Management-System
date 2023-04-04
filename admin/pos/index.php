<?php 
//require_once('../../config.php');
//include_once("../escpos/Escpos.php");
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `transaction_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
        
        if(isset($user_id) && is_numeric($user_id)){
            $user = $conn->query("SELECT concat(firstname,' ', lastname) as `name` FROM `users` where id = '{$user_id}' ");
            if($user->num_rows > 0){
                $user_name = $user->fetch_array()['name'];
            }
        }
        
    }else{
        echo '<script> alert("Unknown Transaction\'s ID."); location.replace("./?page=transactions"); </script>';
    }
}else{
    echo '<script> alert("Transaction\'s ID is required to access the page."); location.replace("./?page=transactions"); </script>';
}
        $comName=$_settings->info('name');
        $address=$_settings->info('address');
        $contact=$_settings->info('contact');

         
          $sales_id=isset($code) ? $code : '';
           $date=isset($date_created) ? $date_created : '';
          $tendered=isset($cash_tendered) ? $cash_tendered : '';
          $change=isset($cash_change) ? $cash_change : '';
          $discount=isset($discount) ? $discount : '';
           $custname=isset($client_id) ? $client_id : '';
           $staff= isset($user_name) ? $user_name : '';

 try{

       $connector = new WindowsPrintConnector('smb://DESKTOP-DMVPDMJ/POSP');
                    $printer = new Escpos($connector);
                    $printer -> setJustification(Escpos::JUSTIFY_CENTER);
                    $printer -> setFont(Escpos::FONT_B);
                    $printer -> setEmphasis(true);
                    $printer -> text(" ".$comName." \n");
                    $printer -> text(" ".$address." \n");
                    
                    $printer -> text(" Phone: ".$contact." \n");
                    $printer -> text("Invoice: #".$sales_id." \n");
                    $printer -> text("Customer: #".$custname." \n");
                 
                    $printer -> setEmphasis(false);
                   
                     $printer -> setJustification(Escpos::JUSTIFY_RIGHT);
                    $printer -> text("Item            Price          Amount \n");
                    $printer -> text("---------------------------------- \n");
                  
        
        $grand=0;
        $tp_qry = $conn->query("SELECT tp.*, p.prod_name as `product`, tp.price as price FROM `transaction_products` tp inner join `product` p on tp.product_id = p.prod_id where tp.`transaction_id` = '{$id}'");
        while($row = $tp_qry->fetch_assoc()):
            $total= $row['qty']*$row['price'];
            $grand=$grand+$total;
            $proname= substr($row['product'],0, 15);

                    ///
                         
                  $printer ->text($proname."...      " .$row['qty']. " @ " .$row['price']. "   GHc"." ".sprintf('%.2f',$total)."\n");
                    //var_dump($items);

                endwhile; 
                         
                         $printer -> text("................................................\n");
                    
                    $printer -> text("Sub Total : "."GHC  ".sprintf('%.2f',$grand)."\n");
                    
                
                         $printer ->text("Discount :".sprintf('%.2f',$discount)."%"."\n");

                         $printer ->text("Total Paid :"." ".sprintf('%.2f',$grand-$discount)."\n");
                
                    $printer ->text("Cash Tendered : "." ".sprintf('%.2f',$tendered)."\n");
                    $printer -> setEmphasis(true);
                    $printer ->text("Balance : "." ".sprintf('%.2f',$change)."\n");
                    $printer -> setEmphasis(false);
                    
                     $printer -> setJustification(Escpos::JUSTIFY_CENTER);
                    
                    // $printer -> text("Goods Sold are not returnable \n"); 
                    $printer -> text("Staff: ".$staff."\n"); 
                        $printer -> text(date('l jS F Y h:i A') . "\n");
                         
                    $printer -> text("Thank You for Your Purchase \n"); 
 
                    $printer -> text("Goods Purchased are not returnable\n"); 
                    
                    $printer -> setEmphasis(true);
                    $printer -> text("Deloped by O.y Tech :(+233)243856882/509997797 \n");

                    $printer -> setEmphasis(false);
                    
                   
                    $printer -> cut();

                    /* Close printer */
                    $printer -> close();
                    echo "<script type='text/javascript'>alert('Receipt Printed!');</script>";
                    echo "<script>window.location='./?page=cart/manage_cart'</script>";
                   //header("location: cash_transaction.php");
                   // echo "<b>Great Receipt Was Printed</b>";
                } 
                catch(Exception $e) {
                    echo "ERROR!!! Couldn't print: " . $e -> getMessage() . "\n";
                }
