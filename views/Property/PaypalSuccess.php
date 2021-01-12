<?php include "header.php";?>

<?php

if(!empty($_GET['paymentID']) && !empty($_GET['token']) && !empty($_GET['payerID']) && !empty($_GET['pid']) ){     // Get transaction information from URL
    //  $item_number = $_GET['item_number'];
    //  $txn_id = $_GET['tx'];
    //  $payment_gross = $_GET['amt'];
    //  $currency_code = $_GET['cc'];
    //  $payment_status = $_GET['st'];
    //  $rowsells = \Property\PropertyClass::savePapalOrder($txn_id,$item_number,$item_name='',$payment_gross,$currency_code,$payment_status);
    $paymentID = $_GET['paymentID'];
    $token = $_GET['token'];
    $payerID = $_GET['payerID'];
    $productID = $_GET['pid']; 
    $userId = $_GET['uid']; 
    
    $rowsells = \Property\PropertyClass::validate($paymentID, $token, $payerID, $productID,$userId);
    if(!empty($rowsells)){
    ?>  
    <h3>Your payment was successful.</h3>
    <p>TXN ID: <?php echo $rowsells->id; ?></p>
    <p>Paid Amount: <?php echo $rowsells->transactions[0]->amount->details->subtotal.' '.$rowsells->transactions[0]->amount->currency; ?></p>
    <p>Payment Status: <?php echo $rowsells->state; ?></p>
    <p>Payment Date: <?php echo $rowsells->create_time; ?></p>
<?php        
}else{
    echo '<p>Payment was unsuccessful</p>';
}
?>
  <?php
    }else{
?>
<div class="row">

 <div class="col-12">
   <div class="card">
   <div class="card-body">
     <div class="mb-30">
         <h4>Your have successfully Ordered</h4>

     </div>

    </div>
    </div>
   </div>
 </div>

<?php } ?>
<?php include"footer.php"; ?>
