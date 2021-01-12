<?php
if (isset($_REQUEST['id']) && isset($_REQUEST['ProjectId']) && $_REQUEST['id'] != null && $_REQUEST['id'] != "" && $_REQUEST['ProjectId'] != null && $_REQUEST['ProjectId'] != "")
{
  	$property_id = $_REQUEST['id'];
	$project_id = $_REQUEST['ProjectId'];
	include"header.php";
	\login\loginClass::Init();
  	$checkSession = \login\loginClass::CheckUserSessionIp();
  	$Projectrows = \Property\PropertyClass::GetPorjectDatas('', $propject_id);
  	foreach ($Projectrows as $Projectrow)
  	{
  		$idd = uniqid();
  		$ArrQueries = array();
  		$queryStr = "Insert Into property_project_reserve(`payment_id`,`user_id`, `property_id`, `project_id`, `reservation_fees`, `txt_sign_one`, `txt_sign_two`, `txt_purchase_one`, `txt_purchase_two`, `cnic_pur_one`, `date_pur_one`, `cnic_pur_two`, `date_pur_two`, `sales_person_vendor`, `cea_registration`, `estate_agent`, `cea_license`, `txt_witness_date`)
                                values(:payment_id,:user_id, :property_id, :project_id, :reservation_fees, :txt_sign_one, :txt_sign_two, :txt_purchase_one, :txt_purchase_two, :cnic_pur_one, :date_pur_one, :cnic_pur_two, :date_pur_two, :sales_person_vendor, :cea_registration, :estate_agent, :cea_license, :txt_witness_date)";

  		$ColValarray = array("user_id" => $LoginUserId,
      		"property_id" => $property_id,
      		"project_id" => $project_id,
      		"payment_id" => $idd,
      		"reservation_fees" => $_REQUEST['reservation_fees'],
      		"txt_sign_one" => $_REQUEST['txt_sign_one'],
      		"txt_sign_two" => $_REQUEST['txt_sign_two'],
      		"txt_purchase_one" => $_REQUEST['txt_purchase_one'],
      		"txt_purchase_two" => $_REQUEST['txt_purchase_two'],
      		"cnic_pur_one" => $_REQUEST['cnic_pur_one'],
      		"date_pur_one" => $_REQUEST['date_pur_one'],
      		"cnic_pur_two" => $_REQUEST['cnic_pur_two'],
      		"date_pur_two" => $_REQUEST['date_pur_two'],
      		"sales_person_vendor" => $_REQUEST['sales_person_vendor'],
      		"cea_registration" => $_REQUEST['cea_registration'],
      		"estate_agent" => $_REQUEST['estate_agent'],
      		"cea_license" => $_REQUEST['cea_license'],
      		"txt_witness_date" => $_REQUEST['txt_witness_date']);
  		$Queryarray = array($queryStr, $ColValarray);
  		$ArrQueries[] = $Queryarray;
  		$Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
  		?>
  		<div class="congrats-container rfee">
    		<div class="congrats-box w-100">
      			<h3>Reservation Fee <?php if(!empty($_REQUEST['reservation_fees'])){
        			echo $Projectrow['currency'].$_REQUEST['reservation_fees'];} 
        			else{
        			echo $Projectrow['currency']."2500";
      				} ?>
				</h3>
				<?php
				$Projectrow['currency'] = 'USD';
				?>
      			<div class="row flex-grow-1">
        			<div class="rfee-box w-100">
          				<div class="row">
            				<div class="col-lg-8">
              					<p> You have agreed to purchase the property when it reaches the Strike Price or less. If the price of the property does not fall and meet the strike price, don’t worry your reservation fee is fully refundable. </p>
              					<p> If the strike price is met, your reservation fee is non-refundable should you decide not to purchase the property. The reservation fee you pay will form part of the deposit you pay on exchange of contracts. </p>
            				</div>
            				<div class="col-lg-4">
              					<div class="img-holder">
                					<img src="<?= SITE_BASE_URL; ?>dashboard/assets/images/house2.png" class="w-100 d-block ml-auto" alt="">
              					</div>
            				</div>
          				</div>
          				<div class="col-12">
          					<div id="smart-button-container">
      							<div style="text-align: left;">
      								<div id="paypal-button-container"></div>
      							</div>
    						</div>
    						<script src="https://www.paypal.com/sdk/js?client-id=AUcz13X2rIXFOjLx0l9pWCjWU0aBnFtV_jYI5Pi12e703vz4fxiM_QwqhilV5a5KIV3BVfCub0QhLpZE"></script>
    						<script>
    							// paypal.Buttons().render('#paypal-button-container');
    							paypal.Buttons({
								    createOrder: function(data, actions) {
								      	// This function sets up the details of the transaction, including the amount and line item details.
								      	return actions.order.create({
								        	purchase_units: [{
								          		amount: {
								            		value: '<?= $_REQUEST['reservation_fees'] ?>'
								          		}
								        	}]
								      	});
								    },
								    onApprove: function(data, actions) {
								      	// This function captures the funds from the transaction.
								      	return actions.order.capture().then(function(details) {
								        	$("#tnx_id").val(details.id);
								        	$("#payer_email").val(details.payer.email_address);
								        	$("#payment_currency").val(details.purchase_units[0].amount.currency_code);
								        	$("#payment_status").val(details.status);
								        	alert('Transaction completed by ' + details.payer.name.given_name);
								        	$("#final_form").submit();
								      	});
								    }
								}).render('#paypal-button-container');
	    					</script>
	    					<form action="<?= SITE_BASE_URL;?>Property/ReserveEnd.html" method="post" id="final_form">
	    						<input type="hidden" name="item_name" value="Project Reservation Fee">
	    						<input type="hidden" name="item_number" value="<?= $idd ?>">
	    						<input type="hidden" name="payment_status" value="" id="payment_status">
	    						<input type="hidden" name="mc_gross" value="">
	    						<input type="hidden" name="mc_currency" value="" id="payment_currency">
	    						<input type="hidden" name="payer_email" value="" id="payer_email">
	    						<input type="hidden" name="txn_id" value="" id="tnx_id">
	    						<input type="hidden" name="receiver_email" value="">
	    						<input type="hidden" name="property_id" value="<?= $property_id ?>">
	    						<input type="hidden" name="project_id" value="<?= $project_id ?>">
	    						<input type="hidden" name="id" value="<?= $idd; ?>">

	    					</form>

	    					

            				<!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr"  method="post">
              					<input type="hidden" name="notify_url" value="<?php echo SITE_BASE_URL; ?>paypal.php?project_id=&property_id=&id=<?= $idd ?>&user_id=<?=$LoginUserId?>"/>
              					<input type="hidden" name="cmd" value="_xclick" /> 
              					<input type="hidden" name="business" value="troy@duvalproptech.com" /> 
              					<input type="hidden" name="item_name" value="Project ID <?= $propject_id ?>, Property ID <?= $property_id ?>" />
              					<input type="hidden" name="rm" value="2" />
              					<input type="hidden" name="currency_code" value="USD" />
              					<input type="hidden" name="item_number" value="<?= $idd ?>"/>
              					<input type="hidden" name="return" value="<?php echo SITE_BASE_URL; ?>Property/ReserveEnd.html?ProjectId=<?= $propject_id ?>&id=<?= $property_id ?>" /> 
              					<input type="hidden" class="form-control" id="amount" name="amount" value="">
              					<input type="hidden" name="cancel_return" value="<?php echo SITE_BASE_URL; ?>ReserveWizardthird.html?ProjectId=<?= $propject_id ?>&id=<?= $property_id ?>" />
                				<button class="btn btn-blue" id="payment" name="submit" alt="Make payments with PayPal  its fast, free and secure!" type="submit">Make Payment</button>
              					<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
            				</form> -->
          				</div>
        			</div>
      			</div>
    		</div>
  		</div>
  		<?php include"footer.php"; ?>
  		<?php
  	}
}
else
{
	echo "<script>window.history.go(-1)</script>";
}
?>