<?php
  include"header.php";
  \login\loginClass::Init();
  $checkSession        = \login\loginClass::CheckUserSessionIp();

  // echo "<pre>"; print_r($_POST); print_r($LoginUserId); die();

  $item_name = $_POST['item_name'];
  $item_number = $_POST['item_number'];
  $payment_status = $_POST['payment_status'];
  $payment_amount = $_POST['mc_gross'];
  $payment_currency = $_POST['mc_currency'];
  $payer_email = $_POST['payer_email'];
  $txn_id = $_POST['txn_id'];
  $receiver_email = $_POST['receiver_email'];
  $property_id = $_POST['property_id'];
  $project_id = $_POST['project_id'];
  $queryStr = "update property_project_reserve set txn_id=:txn_id,payment_done=:payment_done where payment_id=:payment_id";
  $ColValarray = array("txn_id" => $txn_id, "payment_done" => 1, "payment_id" => $_POST['id']);
  $Queryarray = array($queryStr, $ColValarray);
  $ArrQueries[] = $Queryarray;
  $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
  $lockin_rateArr   = \DBConn\DBConnection::getQueryFetchColumn("(SELECT (rate-((rate-dpo_rate)*( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID AND reserved_by is NOT NULL )/IFNULL(pj.no_of_property,1))) AS dynamic_rate FROM property_details pd,project pj Where pj.project_id=pd.project_id and pd.property_id = ".$property_id.")");
  $lockin_rate    = $lockin_rateArr["0"];
  $queryStr = "update property_details set reserved_by=:reserved_by,lockin_rate=:lockin_rate where property_id=:property_id";
  $ColValarray = array("reserved_by" => $LoginUserId, "lockin_rate" => $lockin_rate, "property_id" => $property_id);
  $Queryarray = array($queryStr, $ColValarray);
  $ArrQueries[] = $Queryarray;
  $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
    ?>
  <div class="congrats-container">
    <div class="congrats-box w-100">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <h2>CONGRATULATIONS!<br>YOU'VE RESERVED<br>YOUR APARTMENT!</h2>
          <p>Congratulations! You've completed the online process. Your portfolio advisor will review your reservation, sign to confirm all is in order and return a copy to you via XXXXX. </p>
          <p>We will notify you once the strike price is hit and you can watch the Dynamic Price (the price of your unit) fall as more members reserve apartments. We will send your reservation agreement to your solicitor who will be in touch with you directly to take you through the next steps of the conveyancing process. </p>
          <p>In the meantime, you can also share this amazing investment opportunity with your friends and family. The more people who reserve, the greater discount you all get.</p>
        </div>
        <div class="col-lg-4">
          <div class="img-holder">
              <img src="<?= SITE_BASE_URL; ?>dashboard/assets/images/rv.png" class="w-100 img-fluid" alt="">
            </div>
        </div>
        <div class="col-12">
          <a href="<?= SITE_BASE_URL;?>/Property/ProjectView.html?project_id=<?= $project_id; ?>" class="btn btn-blue d-block ml-auto">Go Back</a>
        </div>
      </div>
    </div>
  </div>
  <?php include"footer.php"; ?>