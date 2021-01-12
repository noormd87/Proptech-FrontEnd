 <?php include "header.php"; ?>
<!-- main content -->
<div class="content">

<?php
$ProprtyId = $_REQUEST["id"];
$RecentAnalyse   	= isset($_REQUEST["RecentAnalyse"]) ? $_REQUEST["RecentAnalyse"] : "";



\Property\PropertyClass::Init();

$user_id   = \settings\session\sessionClass::GetSessionDisplayName();



$ChkCntArr               			= \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(property_master_auto_id) AS property_master_auto_id FROM property_details_master WHERE `user_id` ='" .$user_id. "' AND PROPERTY_ID='" .$ProprtyId. "')");
$ChkValue             				= $ChkCntArr["0"];
		
if ( $ChkValue == 0 ){
$action    =  "Add"	;
}else{
$action    =  "Edit";
}	


	$property_purchase_value_price   	= isset($_REQUEST["property_purchase_value_price"]) ? $_REQUEST["property_purchase_value_price"] : "";
	$loan_purchase_deposit   			= isset($_REQUEST["loan_purchase_deposit"]) ? $_REQUEST["loan_purchase_deposit"] : "10";
	$loan_purchase_market_value   		= isset($_REQUEST["loan_purchase_market_value"]) ? $_REQUEST["loan_purchase_market_value"] : "0";
	$loan_purchase_amount   			= isset($_REQUEST["loan_purchase_amount"]) ? $_REQUEST["loan_purchase_amount"] : "0";
	$other_exp_capital   				= isset($_REQUEST["other_exp_capital"]) ? $_REQUEST["other_exp_capital"] : "0";
	$other_exp_slicitor_cost   			= isset($_REQUEST["other_exp_slicitor_cost"]) ? $_REQUEST["other_exp_slicitor_cost"] : "1000";
	$other_exp_stamping_cost   			= isset($_REQUEST["other_exp_stamping_cost"]) ? $_REQUEST["other_exp_stamping_cost"] : "0";
	$other_exp_other   					= isset($_REQUEST["other_exp_other"]) ? $_REQUEST["other_exp_other"] : "0";
	$arr_rental_type   					= isset($_REQUEST["arr_rental_type"]) ? $_REQUEST["arr_rental_type"] : "";
	$arr_annual_rr   					= isset($_REQUEST["arr_annual_rr"]) ? $_REQUEST["arr_annual_rr"] : "0";
	$arr_weekly_rents   				= isset($_REQUEST["arr_weekly_rents"]) ? $_REQUEST["arr_weekly_rents"] : "0";
	$arr_total_annual_rent   			= isset($_REQUEST["arr_total_annual_rent"]) ? $_REQUEST["arr_total_annual_rent"] : "0";
	$ape_Pricipal_interest   			= isset($_REQUEST["ape_Pricipal_interest"]) ? $_REQUEST["ape_Pricipal_interest"] : "0";
	$ape_rates   						= isset($_REQUEST["ape_rates"]) ? $_REQUEST["ape_rates"] : "0";
	$ape_body_corporate   				= isset($_REQUEST["ape_body_corporate"]) ? $_REQUEST["ape_body_corporate"] : "0";
	$ape_land_lease_fee   				= isset($_REQUEST["ape_land_lease_fee"]) ? $_REQUEST["ape_land_lease_fee"] : "0";
	$ape_insurance   					= isset($_REQUEST["ape_insurance"]) ? $_REQUEST["ape_insurance"] : "0";
	$ape_letting_fees   				= isset($_REQUEST["ape_letting_fees"]) ? $_REQUEST["ape_letting_fees"] : "0";
	$ape_management_fees   				= isset($_REQUEST["ape_management_fees"]) ? $_REQUEST["ape_management_fees"] : "10";
	$ape_repairs_maitenance   			= isset($_REQUEST["ape_repairs_maitenance"]) ? $_REQUEST["ape_repairs_maitenance"] : "0";
	$ape_gardening   					= isset($_REQUEST["ape_gardening"]) ? $_REQUEST["ape_gardening"] : "0";
	$ape_service_contract   			= isset($_REQUEST["ape_service_contract"]) ? $_REQUEST["ape_service_contract"] : "0";
	$ape_other   						= isset($_REQUEST["ape_other"]) ? $_REQUEST["ape_other"] : "0";
	$ae_property_belong   				= isset($_REQUEST["ae_property_belong"]) ? $_REQUEST["ae_property_belong"] : "";
	$ae_entity_rows   					= isset($_REQUEST["ae_entity_rows"]) ? $_REQUEST["ae_entity_rows"] : "0";
	$mf_customer_price_index   			= isset($_REQUEST["mf_customer_price_index"]) ? $_REQUEST["mf_customer_price_index"] : "10";
	$mf_capital_growth   				= isset($_REQUEST["mf_capital_growth"]) ? $_REQUEST["mf_capital_growth"] : "10";
	$mf_land_tax  						= isset($_REQUEST["mf_land_tax"]) ? $_REQUEST["mf_land_tax"] : "0";
	$de_calculate_depreciation   		= isset($_REQUEST["de_calculate_depreciation"]) ? $_REQUEST["de_calculate_depreciation"] : "0";
	$de_construction_year_completed   	= isset($_REQUEST["de_construction_year_completed"]) ? $_REQUEST["de_construction_year_completed"] : "0";
	$de_recent_renovations   			= isset($_REQUEST["de_recent_renovations"]) ? $_REQUEST["de_recent_renovations"] : "0";
	$de_estimate_land_value   			= isset($_REQUEST["de_estimate_land_value"]) ? $_REQUEST["de_estimate_land_value"] : "0";
	$loan_value_ratio_growth   			= isset($_REQUEST["loan_value_ratio_growth"]) ? $_REQUEST["loan_value_ratio_growth"] : "10";
	$ape_cleaning   					= isset($_REQUEST["ape_cleaning"]) ? $_REQUEST["ape_cleaning"] : "0";
	$loan_pricipal_interest   			= isset($_REQUEST["loan_pricipal_interest"]) ? $_REQUEST["loan_pricipal_interest"] : "0";
	$loan_length_year   				= isset($_REQUEST["loan_length_year"]) ? $_REQUEST["loan_length_year"] : "0";
	$loan_length_month   				= isset($_REQUEST["loan_length_month"]) ? $_REQUEST["loan_length_month"] : "0";
	$loan_esatblishment_fee   			= isset($_REQUEST["loan_esatblishment_fee"]) ? $_REQUEST["loan_esatblishment_fee"] : "500";
	$loan_amount_loan   				= isset($_REQUEST["loan_amount_loan"]) ? $_REQUEST["loan_amount_loan"] : "0";
	$loan_interset_rate   				= isset($_REQUEST["loan_interset_rate"]) ? $_REQUEST["loan_interset_rate"] : "5";
	$loan_other_loan_costs   			= isset($_REQUEST["loan_other_loan_costs"]) ? $_REQUEST["loan_other_loan_costs"] : "0";
	$loan_valuation_fees   				= isset($_REQUEST["loan_valuation_fees"]) ? $_REQUEST["loan_valuation_fees"] : "500";
	$property_master_auto_id   			= isset($_REQUEST["property_master_auto_id"]) ? $_REQUEST["property_master_auto_id"] : "0";
	
	
	//echo 'loan_purchase_amount==' .$loan_purchase_amount;



$rows = \Property\PropertyClass::GetPropertiesDatas($ProprtyId,'');
foreach ($rows as $row) 
{
    
    //echo "hii";
    
	//$property_address					= $row["property_address"];
	//$country_code						= $row["country_code"];
	$no_of_parkingspace					= $row["no_of_parkingspace"];
	$no_of_bedrooms						= $row["no_of_bedrooms"] ? $row["no_of_bedrooms"] : "";
	$no_of_bathroom						= $row["no_of_bathroom"];
	$property_image						= $row["property_image"];
	$Rate        		                = $row["rate"] ? $row["rate"] : "1";
	$StartRate        	                = $row["start_rate"]  ? $row["start_rate"] : "1";
	$DpoRate        	                = $row["dpo_rate"] ? $row["dpo_rate"] : "";
	$property_master_auto_id   			= $row["property_master_auto_id"];
	$property_purchase_value_price   	= $row["property_purchase_value_price"] ? $row["property_purchase_value_price"] : "";
	$loan_purchase_deposit   			= $row["loan_purchase_deposit"] ? $row["loan_purchase_deposit"] : "10";
	$loan_purchase_market_value   		= $Rate;
	$loan_purchase_amount   			= $StartRate;
	$other_exp_capital   				= $row["other_exp_capital"] ? $row["other_exp_capital"] : "0";
	$other_exp_slicitor_cost   			= $row["other_exp_slicitor_cost"] ? $row["other_exp_slicitor_cost"] : "1000";
	$other_exp_stamping_cost   			= $row["other_exp_stamping_cost"] ? $row["other_exp_stamping_cost"] : "0";
	$other_exp_other   					= $row["other_exp_other"] ? $row["other_exp_other"] : "0";
	$arr_rental_type   					= $row["arr_rental_type"] ? $row["arr_rental_type"] : "";
	$arr_annual_rr   					= $row["arr_annual_rr"] ? $row["arr_annual_rr"] : "0";
	$arr_weekly_rents   				= $row["weekly_rent"] ? $row["weekly_rent"] : "0";
	$arr_total_annual_rent   			= $row["arr_total_annual_rent"] ? $row["arr_total_annual_rent"] : "0";
	$ape_pricipal_interest   			= $row["ape_pricipal_interest"] ? $row["ape_pricipal_interest"] : "0";
	$ape_rates   						= $row["ape_rates"] ? $row["ape_rates"] : "0";
	$ape_body_corporate   				= $row["ape_body_corporate"] ? $row["ape_body_corporate"] : "0";
	$ape_land_lease_fee   				= $row["ape_land_lease_fee"] ? $row["ape_land_lease_fee"] : "0";
	$ape_insurance   					= $row["ape_insurance"] ? $row["ape_insurance"] : "0";
	$ape_letting_fees   				= $row["ape_letting_fees"] ? $row["ape_letting_fees"] : "0";
	$ape_management_fees   				= $row["ape_management_fees"] ? $row["ape_management_fees"] : "10";
	$ape_repairs_maitenance   			= $row["ape_repairs_maitenance"] ? $row["ape_repairs_maitenance"] : "0";
	$ape_gardening   					= $row["ape_gardening"] ? $row["ape_gardening"] : "0";
	$ape_service_contract   			= $row["ape_service_contract"] ? $row["ape_service_contract"] : "0";
	$ape_other   						= $row["ape_other"] ? $row["ape_other"] : "0";
	$ae_property_belong   				= $row["ae_property_belong"] ? $row["ae_property_belong"] : "";
	$ae_entity_rows   					= $row["ae_entity_rows"] ? $row["ae_entity_rows"] : "0";
	$mf_customer_price_index   			= $row["mf_customer_price_index"] ? $row["mf_customer_price_index"] : "10";
	$mf_capital_growth   				= $row["mf_capital_growth"] ? $row["mf_capital_growth"] : "10";
	$mf_land_tax  						= $row["mf_land_tax"] ? $row["mf_land_tax"] : "0";
	$de_calculate_depreciation   		= $row["de_calculate_depreciation"] ? $row["de_calculate_depreciation"] : "0";
	$de_construction_year_completed   	= $row["de_construction_year_completed"] ? $row["de_construction_year_completed"] : "0";
	$de_recent_renovations   			= $row["de_recent_renovations"] ? $row["de_recent_renovations"] : "0";
	$de_estimate_land_value   			= $row["de_estimate_land_value"] ? $row["de_estimate_land_value"] : "0";
	$loan_value_ratio_growth   			= $row["loan_value_ratio_growth"] ? $row["loan_value_ratio_growth"] : "10";
	//echo 'loan_purchase_amount=='	.$loan_purchase_amount;
}

$PrtyChkArr               				= \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(property_master_auto_id) AS CNT FROM property_details_master WHERE PROPERTY_ID='".$ProprtyId."')");
$PrtyCnt             					= $PrtyChkArr["0"];
	
if ( $PrtyCnt  > 0 && $RecentAnalyse =="Y" )	
{
	
	$GetDbVals = \Property\PropertyClass::GetDBValues($ProprtyId,$user_id);
	foreach ($GetDbVals as $GetDbVal) 
	{
		$property_master_auto_id   			= $GetDbVal["property_master_auto_id"];
		$property_purchase_value_price   	= $GetDbVal["property_purchase_value_price"] ? $GetDbVal["property_purchase_value_price"] : "" ;
		$loan_purchase_deposit   			= $GetDbVal["loan_purchase_deposit"] ? $GetDbVal["loan_purchase_deposit"] : "0" ;
		$loan_purchase_market_value   		= $GetDbVal["loan_purchase_market_value"] ? $GetDbVal["loan_purchase_market_value"] : "0" ;
		$loan_purchase_amount   			= $GetDbVal["loan_purchase_amount"] ? $GetDbVal["loan_purchase_amount"] : "0" ;
		$other_exp_capital   				= $GetDbVal["other_exp_capital"] ? $GetDbVal["other_exp_capital"] : "0" ;
		$other_exp_slicitor_cost   			= $GetDbVal["other_exp_slicitor_cost"] ? $GetDbVal["other_exp_slicitor_cost"] : "0" ;
		$other_exp_stamping_cost   			= $GetDbVal["other_exp_stamping_cost"] ? $GetDbVal["other_exp_stamping_cost"] : "0" ;
		$other_exp_other   					= $GetDbVal["other_exp_other"] ? $GetDbVal["other_exp_other"] : "0" ;
		$arr_rental_type   					= $GetDbVal["arr_rental_type"] ? $GetDbVal["arr_rental_type"] : "" ;
		$arr_annual_rr   					= $GetDbVal["arr_annual_rr"] ? $GetDbVal["arr_annual_rr"] : "0" ;
		$arr_weekly_rents   				= $GetDbVal["arr_weekly_rents"] ? $GetDbVal["arr_weekly_rents"] : "0" ;
		$arr_total_annual_rent   			= $GetDbVal["arr_total_annual_rent"] ? $GetDbVal["arr_total_annual_rent"] : "0" ;
		$ape_pricipal_interest   			= $GetDbVal["ape_pricipal_interest"] ? $GetDbVal["ape_pricipal_interest"] : "0" ;
		$ape_rates   						= $GetDbVal["ape_rates"] ? $GetDbVal["ape_rates"] : "0" ;
		$ape_body_corporate   				= $GetDbVal["ape_body_corporate"] ? $GetDbVal["ape_body_corporate"] : "0" ;
		$ape_land_lease_fee   				= $GetDbVal["ape_land_lease_fee"] ? $GetDbVal["ape_land_lease_fee"] : "0" ;
		$ape_insurance   					= $GetDbVal["ape_insurance"] ? $GetDbVal["ape_insurance"] : "0" ;
		$ape_letting_fees   				= $GetDbVal["ape_letting_fees"] ? $GetDbVal["ape_letting_fees"] : "0" ;
		$ape_management_fees   				= $GetDbVal["ape_management_fees"] ? $GetDbVal["ape_management_fees"] : "10" ;
		$ape_repairs_maitenance   			= $GetDbVal["ape_repairs_maitenance"] ? $GetDbVal["ape_repairs_maitenance"] : "0" ;
		$ape_gardening   					= $GetDbVal["ape_gardening"] ? $GetDbVal["ape_gardening"] : "0" ;
		$ape_service_contract   			= $GetDbVal["ape_service_contract"] ? $GetDbVal["ape_service_contract"] : "0" ;
		$ape_other   						= $GetDbVal["ape_other"] ? $GetDbVal["ape_other"] : "0" ;
		$ae_property_belong   				= $GetDbVal["ae_property_belong"] ? $GetDbVal["ae_property_belong"] : "" ;
		$ae_entity_rows   					= $GetDbVal["ae_entity_rows"] ? $GetDbVal["ae_entity_rows"] : "0" ;
		$mf_customer_price_index   			= $GetDbVal["mf_customer_price_index"] ? $GetDbVal["mf_customer_price_index"] : "10" ;
		$mf_capital_growth   				= $GetDbVal["mf_capital_growth"] ? $GetDbVal["mf_capital_growth"] : "10" ;
		$mf_land_tax  						= $GetDbVal["mf_land_tax"] ? $GetDbVal["mf_land_tax"] : "0" ;
		$de_calculate_depreciation   		= $GetDbVal["de_calculate_depreciation"] ? $GetDbVal["de_calculate_depreciation"] : "0" ;
		$de_construction_year_completed   	= $GetDbVal["de_construction_year_completed"] ? $GetDbVal["de_construction_year_completed"] : "0" ;
		$de_recent_renovations   			= $GetDbVal["de_recent_renovations"] ? $GetDbVal["de_recent_renovations"] : "0" ;
		$de_estimate_land_value   			= $GetDbVal["de_estimate_land_value"] ? $GetDbVal["de_estimate_land_value"] : "0" ;
		$loan_value_ratio_growth   			= $GetDbVal["loan_value_ratio_growth"] ? $GetDbVal["loan_value_ratio_growth"] : "10" ;
		
	}

	if ( $property_master_auto_id != "" ){

		$GetDbDtlVals = \Property\PropertyClass::GetDBDtlValues($property_master_auto_id);
		foreach ($GetDbDtlVals as $GetDbDtlVal) 
		{
			$loan_pricipal_interest   			= $GetDbDtlVal["loan_pricipal_interest"] ? $GetDbDtlVal["loan_pricipal_interest"] : "0";
			$loan_length_year   				= $GetDbDtlVal["loan_length_year"] ? $GetDbDtlVal["loan_length_year"] : "0";
			$loan_length_month   				= $GetDbDtlVal["loan_length_month"] ? $GetDbDtlVal["loan_length_month"] : "0";
			$loan_esatblishment_fee   			= $GetDbDtlVal["loan_esatblishment_fee"] ? $GetDbDtlVal["loan_esatblishment_fee"] : "0";
			$loan_amount_loan   				= $GetDbDtlVal["loan_amount_loan"] ? $GetDbDtlVal["loan_amount_loan"] : "0";
			$loan_interset_rate   				= $GetDbDtlVal["loan_interset_rate"] ? $GetDbDtlVal["loan_interset_rate"] : "10";
			$loan_other_loan_costs   			= $GetDbDtlVal["loan_other_loan_costs"] ? $GetDbDtlVal["loan_other_loan_costs"] : "0";
			$loan_valuation_fees   				= $GetDbDtlVal["loan_valuation_fees"] ? $GetDbDtlVal["loan_valuation_fees"] : "0";
			
		}

	}

}

//Get Default Values 




?>

<div class="row">
   <!-- property content -->
   <div class="col-lg-8">
      <div class="card h-100 mb-0">
         <div class="card-body">
            <div class="card-title"><a class="text-dark" href="#">
                <h4 class="heading-primary"><?php echo $row["apartment_no"]; ?>|<?php echo $row["building"]; ?>|<?php echo $row["project_name"]; ?> | <?php echo $row["country"]; ?></h4>
              </a>
              <!-- <h5 class="mt-2 text-success"><?php //echo $Projectrow["PROJECT_DESCRIPTION"]?></h5> --></div>
            <!--<div class="row mt-30">-->
            <!--   <div class="col-lg-4 border-right-1">-->
            <!--      <a href="#" class="text-center d-block text-muted">-->
            <!--         <img src="<?php //echo SITE_BASE_URL;?>assets/img/icon/parking-icon.png" class="img-fluid">-->
            <!--         <div>-->
            <!--            <span class="f-s-12 text-muted">Parking</span>-->
            <!--            <span class="p-l-10 p-r-10 text-muted">|</span>-->
            <!--            <span class="f-s-12 text-muted">1</span>-->
            <!--         </div>-->
            <!--      </a>-->
            <!--   </div>-->
            <!--   <div class="col-lg-4 border-right-1">-->
            <!--      <a href="#" class="text-center d-block text-muted">-->
            <!--         <img src="<?php //echo SITE_BASE_URL;?>assets/img/icon/bedroom-icon.png" class="img-fluid">-->
            <!--         <div>-->
            <!--            <span class="f-s-12 text-muted">Bedroom</span>-->
            <!--            <span class="p-l-10 p-r-10 text-muted">|</span>-->
            <!--            <span class="f-s-12 text-muted">3</span>-->
            <!--         </div>-->
            <!--      </a>-->
            <!--   </div>-->
            <!--   <div class="col-lg-4">-->
            <!--      <a href="#" class="text-center d-block text-muted">-->
            <!--         <img src="<?php //echo SITE_BASE_URL;?>assets/img/icon/bathroom-icon.png" class="img-fluid">-->
            <!--         <div>-->
            <!--            <span class="f-s-12 text-muted">Bathroom</span>-->
            <!--            <span class="p-l-10 p-r-10 text-muted">|</span>-->
            <!--            <span class="f-s-12 text-muted">2</span>-->
            <!--         </div>-->
            <!--      </a>-->
            <!--   </div>-->
            <!--</div>-->
            <div class="row">
              <div class="col-lg-6">
                <div class="basic-list-group">
                   <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         Project
                         <span class="badge">Cross Stanford</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Client Name
                         <span class="badge">&nbsp;</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         Client Country
                         <span class="badge">Hong Kong</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         If other please specify  
                         <span class="badge"></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         Unit
                         <span class="badge"> 
                                <select class="form-control" name="ae_property_belong" id="ae_property_belong" >
                                    <option value="">Unit</option>
                                    <?php
                                        for($i=1; $i<=40; $i++){
                                    ?>
                                         <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                        </span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         Lawyer
                         <span class="badge"><input type='text' name='Lawyer' id='Lawyer' value=''>&nbsp;&nbsp;</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         First-time buyer
                         <span class="badge">
                             <select class="form-control" name="firsttimebuyer" id="firsttimebuyer" >
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                            </select>
                         </span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         Rental Guarantee
                         <span class="badge">
                             <select class="form-control" name="RentalGuarantee" id="RentalGuarantee" >
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                            </select>
                         </span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         Furniture pack
                         <span class="badge">
                              <select class="form-control" name=" FurniturePack" id="FurniturePack" >
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                            </select>
                         </span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         Unit size (sqf)
                         <span class="badge"><input type='text' name='UnitSize' id='UnitSize' value=''>&nbsp;&nbsp;</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         Unit type (beds)
                         <span class="badge"><input type='text' name='UnitType' id='UnitType' value=''>&nbsp;&nbsp;</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         Purchase price
                         <span class="badge"><input type='text' name='Purchaseprice' id='Purchaseprice' value=''>&nbsp;&nbsp;</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         Conversion from GBP to
                         <span class="badge"><input type='text' name='ConversionCurrency' id='ConversionCurrency' value=''>&nbsp;&nbsp;</span>
                      </li>
 
                   </ul>
                </div>
              </div>
              <div class="col-lg-6">
                <div>
                  <div class="text-right">
                    <h2 class="f-s-30 m-b-0 oswald text-warning">22</h2>
                    <span class="f-w-600"> Total Property</span>
                  </div>
                    <div class="m-t-30">
                        <h4 class="f-w-600 oswald text-danger">11</h4>
                        <h6 class="m-t-10 text-muted">Available Property
                            <span class="pull-right">50%</span>
                        </h6>
                        <div class="progress m-t-15 h-6px">
                            <div role="progressbar" class="progress-bar bg-warning wow animated progress-animated w-50pc h-6px">
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end property content -->
   <!-- <div class="col-lg-4">
     <div class="card mb-0 h-100">
       <div class="card-body">
         <div class="">
           <div id="medianChart"></div>
         </div>
       </div>
     </div>
   </div> -->
   <!-- property sidebar -->
   <div class="col-lg-4">
      <div class="card rating-card h-100 mb-0">
         <div class="card-body">
            <a href="#">
               <div class="">
                  <img src="<?php echo SITE_BASE_URL;?>assets/img/avenue_prop_img_001.jpg" class="img-fluid preview-img-thumb" width="100%">
               </div>
            </a>
            <!-- <div class="rating row no-gutters">
               <div class="rating-btn col-8">
                  <button class="btn btn-link"><i class="fa fa-star"></i></button>
                  <button class="btn btn-link"><i class="fa fa-star"></i></button>
                  <button class="btn btn-link"><i class="fa fa-star"></i></button>
                  <button class="btn btn-link"><i class="fa fa-star"></i></button>
                  <button class="btn btn-link btn-disable"><i class="fa fa-star"></i></button>
               </div>
               <div class="col-4 text-right align-self-center">
                  <div class="user-review-count">(12,775)</div>
               </div>
            </div> -->
         </div>
         <div class="card-footer">
            <div class="property-nav">
               <a href="#" class="btn btn-primary btn-block">save brochure to my folder</a>
               <!--<a href="property-analyser.php" class="btn btn-primary btn-block">ANALYSE IN FULL</a>-->
               <!--<a href="<?php //echo SITE_BASE_URL;?>Property/Properties.html?country=<?php// echo $country;?>&project_id=<?php //echo $Projectrow["PROJECT_ID"]?>" class="btn btn-primary btn-block">PROPERTY Details</a>-->
            </div>
         </div>
      </div>
   </div>
   <!-- end property sidebar -->
</div>




   <div class="row no-gutters">
      <div class="col-12">
         <div class="analyser-section">
            <form class="dpo-form"  action="<?php echo SITE_BASE_URL;?>/Property/propertysave.html?buttonaction=<?php echo $action;?>&user_id=<?php echo $user_id;?>&property_id=<?php echo $ProprtyId;?>" method="post"   >
               <div id="analyser">
                  <!--loan and purchase -->
                  <h3>Purchase details and Costs</h3>
                  <section>
                     <div class="row">
                        <div class="col-12">
                           <!-- purchase details-->
                           <div class="card my-12">
                              <div class="card-header">
                                 <div class="card-title">
                                    INITIAL COSTS
                                 </div>
                              </div>
                              <div class="card-body">
                                 <div class="row">
                                    <table width='100%'>
                                        <tr>
                                            <th colspan=2>&nbsp;</th>
                                            <th>GBP</th>
                                            <th>HKD</th>
                                            <th>Additional Notes</th>
                                        </tr>
                                        <tr>
                                            <td>IP Global client fee</td>
                                            <td><input type='text' name='ipgloclientfee' id='ipgloclientfee' value=''>&nbsp;&nbsp;Per Unit</td>
                                            <td><input type='text' name='ipgloclientfeeAmt' id='ipgloclientfeeAmt' value=''>&nbsp;&nbsp;</td>
                                            <td><input type='text' name='ipgloclientfeeSecAmt' id='ipgloclientfeeAmt' value=''>&nbsp;&nbsp;</td>
                                            <td><textarea name='ipgloclientfeeRemarks' id='ipgloclientfeeRemarks'  rows=5 cols=15 ></textarea></td>
                                        </tr>
                                         <tr>
                                            <td>Reservation Deposit</td>
                                            <td><input type='text' name='ReservationDeposit' id='ReservationDeposit' value=''>&nbsp;&nbsp;of Purchase Price</td>
                                            <td><input type='text' name='ReservationDepositAmt' id='ReservationDepositAmt' value=''>&nbsp;&nbsp;</td>
                                            <td><input type='text' name='ReservationDepositSecAmt' id='ReservationDepositSecAmt' value=''>&nbsp;&nbsp;</td>
                                            <td><textarea name='ReservationDepositRemarks' id='ReservationDepositRemarks'  rows=5 cols=15 ></textarea></td>
                                        </tr>
                                         <tr>
                                            <td>Conveyancing fees(Inc VAT)</td>
                                            <td><input type='text' name='Conveyancingfees' id='Conveyancingfees' value=''>&nbsp;&nbsp;based on Riseam Sharples</td>
                                            <td><input type='text' name='ConveyancingfeesAmt' id='ConveyancingfeesAmt' value=''>&nbsp;&nbsp;</td>
                                            <td><input type='text' name='ConveyancingfeesSecAmt' id='ConveyancingfeesSecAmt' value=''>&nbsp;&nbsp;</td>
                                            <td><textarea name='ConveyancingfeesRemarks' id='ConveyancingfeesRemarks'  rows=5 cols=15 ></textarea></td>
                                        </tr>
                                         <tr>
                                            <td>Land registry fees</td>
                                            <td><input type='text' name='Landregistryfees' id='Landregistryfees' value=''>&nbsp;&nbsp;based on UK Dpt of Land Reg. Req</td>
                                            <td><input type='text' name='LandregistryfeesAmt' id='LandregistryfeesAmt' value=''>&nbsp;&nbsp;</td>
                                            <td><input type='text' name='LandregistryfeesSecAmt' id='LandregistryfeesSecAmt' value=''>&nbsp;&nbsp;</td>
                                            <td><textarea name='LandregistryfeesRemarks' id='LandregistryfeesRemarks'  rows=5 cols=15 ></textarea></td>
                                        </tr>
                                         <tr>
                                            <td>Engrossment fees</td>
                                            <td><input type='text' name='Engrossmentfees' id='Engrossmentfees' value=''>&nbsp;&nbsp;Per Unit</td>
                                            <td><input type='text' name='EngrossmentfeesAmt' id='EngrossmentfeesAmt' value=''>&nbsp;&nbsp;</td>
                                            <td><input type='text' name='EngrossmentfeesSecAmt' id='EngrossmentfeesAmt' value=''>&nbsp;&nbsp;</td>
                                            <td><textarea name='EngrossmentfeesRemarks' id='EngrossmentfeesRemarks'  rows=5 cols=15 ></textarea></td>
                                        </tr>
                                        <tr>
                                            <td colspan=2>Payment on Reservation Exchange</td>
                                            <td align='right' >0<input type='hidden' name='PaymentResExcAmount' id='PaymentResExcAmount' value=''></td>
                                            <td align='right' >0<input type='hidden' name='PaymentResExcSecAmount' id='PaymentResExcSecAmount' value=''></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                         <tr>
                                            <td colspan=2>Further 0% Deposit(0 weekd after exchange)</td>
                                            <td align='right' >0<input type='hidden' name='PaymentResExcAmount' id='PaymentResExcAmount' value=''></td>
                                            <td align='right' >0<input type='hidden' name='PaymentResExcSecAmount' id='PaymentResExcSecAmount' value=''></td>
                                            <td>&nbsp;</td>
                                        </tr>
       
                                     </table> 
                                 </div>
                              </div>
                           </div>
                           <!-- end purchase details-->
                         
                           <div class="analyser-submit-section">
                              <div class="btn-div text-right pt-4">
                                 <a id="right" class="btn btn-outline-dark" href="#next">Mortgage Requirements  <i class="fa fa-chevron-right"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
                  <!-- end loan and purchase -->
                  <!-- Rent & Expenses -->
                  <h3>Mortgage Requirements </h3>
                  <section>
                     <!-- purchase details-->
                     <div class="card my-4">
                        <div class="card-header">
                           <div class="card-title">Mortgage Requirements </div>
                        </div> 
                        <div class="card-body">
                                 <div class="row">
                                    <table width='100%'>
                                        
                                        <tr>
                                            <td>Mortgage Type</td>
                                            <td>
                                                <select name='MortgageType' id='MortgageType' >
                                                    <option value='IntersertOnly'>Intersert Only</option>
                                                    <option value='Repayment'>Repayment</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mortgage Lending Value</td>
                                            <td><input type='type' name='MortgageLendingVal' id='MortgageLendingVal' value='65'>%</td>
                                        </tr>
                                        <tr>
                                            <td>Mortgage Rate</td>
                                            <td><input type='type' name='MortgageRate' id='MortgageRate' value='40'></td>
                                        </tr>
                                        <tr>
                                            <td>Loan Term (Yrs)</td>
                                            <td><input type='type' name='MortgageLongTerm' id='MortgageLongTerm' value='25'></td>
                                        </tr>
                                         
       
                                     </table> 
                                 </div>
                         
                       
                     </div>
                     <!-- end purchase details-->
                  
                     <div class="row">
                        <div class="col-9">
                           <div class="analyser-submit-section">
                              <div class="btn-div text-left pt-4">
                                 <ul class="list-inline">
                                    <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fa fa-chevron-left"></i> Purchase details and Costs</a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-3">
                           <div class="analyser-submit-section">
                              <div class="btn-div text-right pt-4">
                                 <ul class="list-inline">
                                    <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Final costs at completion<i class="fa fa-chevron-right"></i></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
                  <!-- End Rent & Expenses -->
                  <!-- Tax & MArket -->
                  <h3>Final costs at completion</h3>
                  <section>
                     <!-- ASSIGN AN ENTITY -->
                     <div class="card my-4">
                        <div class="card-header">
                           <div class="card-title">Final costs at completion</div>
                        </div>
                        <div class="card-body">
                           <div class="row">
                               
                               <table width='100%'>
                                    
                                    <tr>
                                        <td>Final capital payment</td>
                                        <td><input type='text' name='ipgloclientfee' id='ipgloclientfee' value=''>&nbsp;&nbsp;Per Unit</td>
                                        <td><input type='text' name='ipgloclientfeeAmt' id='ipgloclientfeeAmt' value=''>&nbsp;&nbsp;</td>
                                        <td><input type='text' name='ipgloclientfeeSecAmt' id='ipgloclientfeeAmt' value=''>&nbsp;&nbsp;</td>
                                        <td><textarea name='ipgloclientfeeRemarks' id='ipgloclientfeeRemarks'  rows=5 cols=15 ></textarea></td>
                                    </tr>
                                     <tr>
                                        <td>Stamp duty</td>
                                        <td><input type='text' name='ReservationDeposit' id='ReservationDeposit' value=''>&nbsp;&nbsp;of Purchase Price</td>
                                        <td><input type='text' name='ReservationDepositAmt' id='ReservationDepositAmt' value=''>&nbsp;&nbsp;</td>
                                        <td><input type='text' name='ReservationDepositSecAmt' id='ReservationDepositSecAmt' value=''>&nbsp;&nbsp;</td>
                                        <td><textarea name='ReservationDepositRemarks' id='ReservationDepositRemarks'  rows=5 cols=15 ></textarea></td>
                                    </tr>
                                     <tr>
                                        <td>Liquid Expat broker costs</td>
                                        <td><input type='text' name='Conveyancingfees' id='Conveyancingfees' value=''>&nbsp;&nbsp;based on Riseam Sharples</td>
                                        <td><input type='text' name='ConveyancingfeesAmt' id='ConveyancingfeesAmt' value=''>&nbsp;&nbsp;</td>
                                        <td><input type='text' name='ConveyancingfeesSecAmt' id='ConveyancingfeesSecAmt' value=''>&nbsp;&nbsp;</td>
                                        <td><textarea name='ConveyancingfeesRemarks' id='ConveyancingfeesRemarks'  rows=5 cols=15 ></textarea></td>
                                    </tr>
                                     <tr>
                                        <td>Lender arrangement fee</td>
                                        <td><input type='text' name='Landregistryfees' id='Landregistryfees' value=''>&nbsp;&nbsp;based on UK Dpt of Land Reg. Req</td>
                                        <td><input type='text' name='LandregistryfeesAmt' id='LandregistryfeesAmt' value=''>&nbsp;&nbsp;</td>
                                        <td><input type='text' name='LandregistryfeesSecAmt' id='LandregistryfeesSecAmt' value=''>&nbsp;&nbsp;</td>
                                        <td><textarea name='LandregistryfeesRemarks' id='LandregistryfeesRemarks'  rows=5 cols=15 ></textarea></td>
                                    </tr>
                                     <tr>
                                        <td>Valuation fee (Inc. VAT)</td>
                                        <td><input type='text' name='Engrossmentfees' id='Engrossmentfees' value=''>&nbsp;&nbsp;Per Unit</td>
                                        <td><input type='text' name='EngrossmentfeesAmt' id='EngrossmentfeesAmt' value=''>&nbsp;&nbsp;</td>
                                        <td><input type='text' name='EngrossmentfeesSecAmt' id='EngrossmentfeesAmt' value=''>&nbsp;&nbsp;</td>
                                        <td><textarea name='EngrossmentfeesRemarks' id='EngrossmentfeesRemarks'  rows=5 cols=15 ></textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2>Furniture pack (Inc. VAT)</td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcAmount' id='PaymentResExcAmount' value=''></td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcSecAmount' id='PaymentResExcSecAmount' value=''></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                       <tr>
                                        <td colspan=2>Complete Tenant find fee (Inc. VAT)</td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcAmount' id='PaymentResExcAmount' value=''></td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcSecAmount' id='PaymentResExcSecAmount' value=''></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan=2>Complete Tenant agreement fee (Inc. VAT)</td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcAmount' id='PaymentResExcAmount' value=''></td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcSecAmount' id='PaymentResExcSecAmount' value=''></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan=2>Complete Handover fee (Inc. VAT)</td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcAmount' id='PaymentResExcAmount' value=''></td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcSecAmount' id='PaymentResExcSecAmount' value=''></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan=2>Complete Inventory fee (Inc. VAT)</td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcAmount' id='PaymentResExcAmount' value=''></td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcSecAmount' id='PaymentResExcSecAmount' value=''></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan=2>Complete Reference Check (inc. VAT)</td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcAmount' id='PaymentResExcAmount' value=''></td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcSecAmount' id='PaymentResExcSecAmount' value=''></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan=2>Client Fee Rebate on Completion </td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcAmount' id='PaymentResExcAmount' value=''></td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcSecAmount' id='PaymentResExcSecAmount' value=''></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan=2>Payment On Completion</td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcAmount' id='PaymentResExcAmount' value=''></td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcSecAmount' id='PaymentResExcSecAmount' value=''></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan=2>Total Equity Required</td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcAmount' id='PaymentResExcAmount' value=''></td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcSecAmount' id='PaymentResExcSecAmount' value=''></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan=2>Mortgage Amount</td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcAmount' id='PaymentResExcAmount' value=''></td>
                                        <td align='right' >0<input type='hidden' name='PaymentResExcSecAmount' id='PaymentResExcSecAmount' value=''></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                 
                                   
   
                                 </table>
                           
                        </div>
                     </div>
                     <!-- end ASSIGN AN ENTITY -->
                     
                     
                     
                     <div class="row">
                        <div class="col-9">
                           <div class="analyser-submit-section">
                              <div class="btn-div text-left pt-4">
                                 <ul class="list-inline">
                                    <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fa fa-chevron-left"></i> Rent & Expense</a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-3">
                           <div class="analyser-submit-section">
                              <div class="btn-div text-right pt-4">
                                 <ul class="list-inline">
                                    <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next"> Result <i class="fa fa-chevron-right"></i></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
                  <!-- End Tax & MArket -->
                  <!-- Results -->
                  <h3>Results</h3>
                  <section class="my-4">
                     <div class="row mb-4">
                        <div class="col-6 col-xxl-6 equal-h-card px-0 bg-white">
                           <div class="card">
                              <div class="card-header">
                                 <div class="widget-title row pb-3">
                                   <div class="col text-left align-self-center"><h3>VARIABLES</h3></div>
                                    <!-- <div class="col text-right"><a class="btn btn-info" href="#">ADD NEW PROPERTY</a></div> -->
                                 </div>
                              </div>
                              <div class="card-body">
                                 <div class="range-form-group text-center">
                                    <div class="form-group">
                                       <label>Loan to value ratio target(%) *</label>
                                       <div class="input-icon ml-auto mr-auto" style="max-width: 350px;">
                                          <input class="touchspin1" type="text" value="<?php echo $loan_value_ratio_growth; ?>" name="loan_value_ratio_growth" id="loan_value_ratio_growth">
                                       </div>
                                       <div class="range-container">
                                          <input type="range" min="0" max="100" step="1" value="<?php echo $loan_value_ratio_growth; ?>" id="loan_value_ratio_growthRange">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-6 col-xxl-6 equal-h-card px-0 bg-white" style='display:none;'>
                           <div class="card">
                              <div class="card-header">
                                 <div class="widget-title row pb-3">
                                   <div class="col text-left align-self-center"><h3>SUMMARY INPUT</h3></div>
                                    <!-- <div class="col text-right"><a class="btn btn-info" href="#">ADD NEW PROPERTY</a></div> -->
                                 </div>
                              </div>
                                 <div class="card-body">
                                    <table class="table summary-table">
                                       <tbody>
                                          <tr>
                                             <td>10yr internal rate of return</td>
                                             <td>70.06%</td>
                                          </tr>
                                          <tr>
                                             <td>Purchase costs </td>
                                             <td>$62,000</td>
                                          </tr>
                                          <tr>
                                             <td>Property purchase price </td>
                                             <td>$800,000</td>
                                          </tr>
                                          <tr>
                                             <td>Loan costs</td>
                                             <td>$1,000</td>
                                          </tr>
                                          <tr>
                                             <td>10yr total growth </td>
                                             <td>88.04%</td>
                                          </tr>
                                          <tr>
                                             <td>Deposit </td>
                                             <td>$80,000</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                        </div>
                     </div>
                     <div class="row">
                        <?php
                        $CapitalGrowthRate  = 6; 
                        ?>
                        <div class="col-12">
                           <div class="table-wrapper">
                              <div class="card">
                                  <input type="hidden" name="CapitalGrowthRate" id="CapitalGrowthRate" value="<?php echo $CapitalGrowthRate; ?>" />
                                  
                                 <div class="card-body">
                                     
                                        <table class="table final-table">
                                            <thead>
                                            <tr>
                                               <td>Show all years (0-10) </td>
                                               <td>Today</td>
                                               <td>Year 1</td>
                                               <td>Year 3</td>
                                               <td>Year 5</td>
                                               <td>Year 10</td>
                                            </tr>
                                         </thead>
                                         <tr class="heading-seprator bg-light-blue">
                                            <td colspan="6">OVERVIEW</td>
                                         </tr>
                                         <tr>
                                            <td>Capital growth rate %</td>
                                            <td>8.29</td>
                                            <td>8.29</td>
                                            <td>8.29</td>
                                            <td>8.29</td>
                                            <td>8.29</td>
                                         </tr>
                                         <tr>
                                            <td>Consumer price index %</td>
                                            <td>2.00</td>
                                            <td>2.00</td>
                                            <td>2.00</td>
                                            <td>2.00</td>
                                            <td>2.00</td>
                                         </tr>
                                         <tr>
                                            <td>Property market value $</td>
                                            <td>649,000</td>
                                            <td>702,802</td>
                                            <td>825,157</td>
                                            <td>966,466</td>
                                            <td>1,439,223</td>
                                         </tr>
                                         <tr>
                                            <td>Amount of loan $ </td>
                                            <td>649,000</td>
                                            <td>649,000</td>
                                            <td>649,000</td>
                                            <td>649,000</td>
                                            <td>649,000</td>
                                         </tr>
                                         <tr class="heading-seprator bg-light-blue">
                                            <td>STATISTICS</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                         </tr>
                                         <tr>
                                            <td>Equity in property $</td>
                                            <td>0</td>
                                            <td>53,802</td>
                                            <td>175,157</td>
                                            <td>317,466</td>
                                            <td>790,223</td>
                                         </tr>
                                         <tr>
                                            <td>Loan to value ratio %</td>
                                            <td>100</td>
                                            <td>92.34</td>
                                            <td>78.75</td>
                                            <td>67.15</td>
                                            <td>45.09</td>
                                         </tr>
                                         <tr>
                                            <td>Surplus equity to reinvest $</td>
                                            <td class="text-danger">(129,800)</td>
                                            <td class="text-danger">(86,758)</td>
                                            <td>10,325</td>
                                            <td>124,173</td>
                                            <td>502,379</td>
                                         </tr>
                                         <tr>
                                            <td>Buying power $</td>
                                            <td class="text-danger">(649,000)</td>
                                            <td class="text-danger">(433,792)</td>
                                            <td>51,627</td>
                                            <td>620,863</td>
                                            <td>2,511,894</td>
                                         </tr>
                                         <tr>
                                            <td>Rental income $</td>
                                            <td>645pw</td>
                                            <td>32,250</td>
                                            <td>33,553</td>
                                            <td>34,908</td>
                                            <td>38,542</td>
                                         </tr>
                                         <tr>
                                            <td>Gross yield %</td>
                                            <td></td>
                                            <td>4.97</td>
                                            <td>5,17</td>
                                            <td>5,38</td>
                                            <td>5,94</td>
                                         </tr>
                                         <tr>
                                            <td>Net yield %</td>
                                            <td></td>
                                            <td>3.72</td>
                                            <td>3.87</td>
                                            <td>4.03</td>
                                            <td>4.44</td>
                                         </tr>
                                         <tr class="heading-seprator bg-light-blue">
                                            <td colspan="6">CASH DEDUCTIONS</td>
                                         </tr>
                                         <tr>
                                            <td>Property expenses $</td>
                                            <td>0.00%</td>
                                            <td>8,515</td>
                                            <td>8,443</td>
                                            <td>8,784</td>
                                            <td>9,698</td>
                                         </tr>
                                         <tr class="heading-seprator bg-light-blue">
                                            <td colspan="6">Loan 1</td>
                                         </tr>
                                         <tr>
                                            <td>Interest rate %</td>
                                            <td>4.50</td>
                                            <td>4.50</td>
                                            <td>4.50</td>
                                            <td>4.50</td>
                                            <td>4.50</td>
                                         </tr>
                                         <tr>
                                            <td>Interest payments $</td>
                                            <td>0</td>
                                            <td>29,205</td>
                                            <td>29,205</td>
                                            <td>29,205</td>
                                            <td>29,205</td>
                                         </tr>
                                         <tr>
                                            <td>Principal payments $</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                         </tr>
                                         <tr>
                                            <td>Pre-tax cash flow p/a $</td>
                                            <td></td>
                                            <td class="text-danger">(50,070)</td>
                                            <td class="text-danger">(4,095)</td>
                                            <td class="text-danger">(3,080)</td>
                                            <td class="text-danger">(361)</td>
                                         </tr>
                                         <tr>
                                            <td>Pre-tax cash flow p/w $</td>
                                            <td></td>
                                            <td class="text-danger">(97)</td>
                                            <td class="text-danger">(79)</td>
                                            <td class="text-danger">(59)</td>
                                            <td class="text-danger">(7)</td>
                                         </tr>
                                         <tr class="heading-seprator bg-light-blue">
                                            <td>NON-CASH DEDUCTIONS</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                         </tr>
                                         <tr>
                                            <td>Depreciation $</td>
                                            <td></td>
                                            <td>10,088</td>
                                            <td>5,674</td>
                                            <td>3,152</td>
                                            <td>757</td>
                                         </tr>
                                         <tr class="heading-seprator bg-light-blue">
                                            <td>SUMMARY</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                         </tr>
                                         <tr>
                                            <td>Total deductions $</td>
                                            <td></td>
                                            <td>47,408</td>
                                            <td>43,332</td>
                                            <td>41,181</td>
                                            <td>39,660</td>
                                         </tr>
                                         <tr>
                                            <td>Net profit/loss $</td>
                                            <td></td>
                                            <td class="text-danger">(15,158)</td>
                                            <td class="text-danger">(9,769)</td>
                                            <td class="text-danger">(6,272)</td>
                                            <td class="text-danger">(1,118)</td>
                                         </tr>
                                         <tr>
                                            <td>Tax refund $</td>
                                            <td></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                         </tr>
                                         <tr>
                                            <td>After tax cash flow p/a $ </td>
                                            <td></td>
                                            <td class="text-danger">(5,070)</td>
                                            <td class="text-danger">(4,095)</td>
                                            <td class="text-danger">(3,080)</td>
                                            <td class="text-danger">(361)</td>
                                         </tr>
                                         <tr>
                                            <td>After tax cash flow p/w $</td>
                                            <td></td>
                                            <td class="text-danger">(97)</td>
                                            <td class="text-danger">(79)</td>
                                            <td class="text-danger">(59)</td>
                                            <td class="text-danger">(7)</td>
                                         </tr>
                                      </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-9">
                           <div class="analyser-submit-section">
                              <div class="btn-div text-left pt-4">
                                 <ul class="list-inline">									
                                    <li class="list-inline-item"> <button class="btn btn-outline-dark" type="submit">Add to saved</button></li>
                                    <li class="list-inline-item"> <button class="btn btn-outline-dark" type="submit">Move to Portfolio Tracker</button></li>
                                    <li class="list-inline-item"> <button class="btn btn-outline-dark" type="submit">Edit</button></li>                                   
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-3">
                           <div class="analyser-submit-section">
                              <div class="btn-div text-right pt-4">
                                 <ul class="list-inline">
                                    <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Graph <i class="fa fa-chevron-right"></i></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
                  <!-- End Results -->
               </div>
            </form>
         </div>
      </div>
   </div>
</div>


<script>
    var FnNulltoAmt = function(Value){
        if (isNaN(parseFloat(Value)))
            Value = 0;
            
        return Value;
    };
    
    WhichRadioSelected = "ratepercentage";
    
    /*
    $(window).load(function(){
        CalcLoanPurchaseCost();
    });
    */
    
   /* $(window).on("load", function (e) {
        //alert()
        //CalcLoanPurchaseCost();
    });
    */
    
    $(document).ready(function(){
        $(document).on("click", "#analyser .last", function(){   //#analyser-t-3
            //alert();
            
            Obj     = $("#analyser-p-3 .final-table").closest(".card-body");
            
            datavalues = $(".dpo-form").serialize();
            
            //console.log('datavalues='+datavalues);
            //alert("hii");
            
            $.ajax({
					type: "POST",
					url:"https://duvalknowledge.com/PropTech/ajax/AnalyzerResult.html",
					data: datavalues 
				}).done(function( data ) {
                    Obj.html(data);
                });
            
        });
        
        $('#property_purchase_value_price').on('ifChecked', function(event){
  			//alert(this.value);
  			OnClickRadio(this);
		});

		$('#property_purchase_value_percent').on('ifChecked', function(event){
  			//alert(this.value);
  			OnClickRadio(this);
		});
		
		
		$('#loan_interest').on('ifChecked', function(event){
  			//alert(this.value);
  			OnClickRadio(this);
		});
		
		$('#loan_principal').on('ifChecked', function(event){
  			//alert(this.value);
  			OnClickRadio(this);
		});
		
		
		
        /*$(document).on("click", ".PropertyPurhaseValDiv", function(){
           // alert();
        });*/
        
        $(document).on("blur", "[calc='loan_purchase_cost']", function(){
            //console.log("in");
            CalcLoanPurchaseCost();
        });
        
        $(document).on("blur", "[calc='AnnualPropertyExpense']", function(){
            //console.log("in");
            FnCalcAnnualPropertyExpense();
        });
        
        /*$(document).on("blur", "#arr_annual_rr", function(){
            $("#arr_weekly_rents").val("");
            $("#TotalAnnualRentSpan").text("$" + this.value);
        });*/
        
        $(document).on("blur", "#arr_weekly_rents,#arr_annual_rr,#arr_weekly_rentsRange,#arr_annual_rrRange", function(){
            
            arr_weekly_rents    = FnNulltoAmt( $("#arr_weekly_rents").val() ); 
          
            arr_annual_rr       = FnNulltoAmt( $("#arr_annual_rr").val() ); 
            
            //$("#arr_annual_rr").val(AnnualRent);
            
            AnnualRent = parseFloat(arr_weekly_rents) * parseFloat(arr_annual_rr);
            
            $("#TotalAnnualRentSpan").text("$" + AnnualRent);
        });
        
        
        $(document).on("blur", "#loan_amount_loan,#loan_purchase_deposit,#loan_amount_loanRange,#loan_purchase_depositRange", function(){
            FnDepositLoansMsg();
            
            /*
            LoanValue                       = FnNulltoAmt( $("#loan_amount_loan").val() ); 
            PurchaseAmount                  = FnNulltoAmt( $("#loan_purchase_amount").val() ); 
            DepositAmount                   = FnNulltoAmt( $("#loan_purchase_deposit").val() ); 
            
            //<h2 id="H2DepositLoanMsg">Deposit & loans are $1,000 <br> less than purchase costs</h2>
            
            if (parseFloat(PurchaseAmount) > (parseFloat(LoanValue) + parseFloat(DepositAmount)) ){
                DepLoanDiff                 = parseFloat(PurchaseAmount) - parseFloat(LoanValue) - parseFloat(DepositAmount);
                $("#H2DepositLoanMsg").html("Deposit & loans are $" + DepLoanDiff + " <br> less than purchase costs");
            }
            else if(parseFloat(PurchaseAmount) < (parseFloat(LoanValue) + parseFloat(DepositAmount)) ){
                DepLoanDiff                 = parseFloat(LoanValue) + parseFloat(DepositAmount) - parseFloat(PurchaseAmount);
                $("#H2DepositLoanMsg").html("Deposit & loans are $" + DepLoanDiff + " <br> greater than purchase costs");
            }
            else{
                $("#H2DepositLoanMsg").html("");
            }
            */
            
            
            
        }); 
        
        
        
    });
    
   

    var OnClickRadio = function(e){
            //alert();
            
            CurVal = e.value; 
            PurchaseAmt = FnNulltoAmt( $("#loan_purchase_amount").val());
            DepositAmt  = FnNulltoAmt( $("#loan_purchase_deposit").val() );
            
            
            if (WhichRadioSelected != CurVal){
            
                if (e.value == "rateamount"){
                    DepositAmt = Math.round( parseFloat(PurchaseAmt) * parseFloat(DepositAmt) / 100)
                }
                else{
                    DepositAmt =  (parseFloat(DepositAmt) / parseFloat(PurchaseAmt)) *100
                }
                
                $("#loan_purchase_deposit").val(DepositAmt);
                WhichRadioSelected = e.value;
            }
            
            FnDepositLoansMsg();
        };
        
        var FnDepositLoansMsg = function(){
            LoanValue                       = FnNulltoAmt( $("#loan_amount_loan").val() ); 
            PurchaseAmount                  = FnNulltoAmt( $("#loan_purchase_amount").val() ); 
            DepositAmount                   = FnNulltoAmt( $("#loan_purchase_deposit").val() ); 
            TotalCosts                      = FnNulltoAmt( $("#TotalCosts").val() ); 
            
            
            AmountPercentType               = $("[name='property_purchase_value_price']:checked").val();
            
            if (AmountPercentType == "ratepercentage"){
                DepositAmount       = Math.round( parseFloat(PurchaseAmount) * parseFloat(DepositAmount) / 100 ); 
            }
            
            //console.log("loan_purchase_deposit=" + loan_purchase_deposit +",loan_purchase_deposit=" + loan_purchase_deposit +",loan_purchase_deposit=" + loan_purchase_deposit)
            
            
            //<h2 id="H2DepositLoanMsg">Deposit & loans are $1,000 <br> less than purchase costs</h2>
            
            //console.log('DepositAmount='+ parseFloat(LoanValue) + parseFloat(DepositAmount) );
           // console.log('LoanValue='+LoanValue);
//console.log('TotalCosts='+TotalCosts);
        

            
            if (parseFloat(TotalCosts) > (parseFloat(LoanValue) + parseFloat(DepositAmount)) ){
                DepLoanDiff                 = parseFloat(TotalCosts) - parseFloat(LoanValue) - parseFloat(DepositAmount);
                $("#H2DepositLoanMsg").html("Deposit & loans are $" + DepLoanDiff + " <br> less than purchase costs");
            }
            else if(parseFloat(TotalCosts) < (parseFloat(LoanValue) + parseFloat(DepositAmount)) ){
                
                
                DepLoanDiff                 = parseFloat(LoanValue) + parseFloat(DepositAmount) - parseFloat(TotalCosts);
                $("#H2DepositLoanMsg").html("Deposit & loans are $" + DepLoanDiff + " <br> greater than purchase costs");
            }
            else{
                $("#H2DepositLoanMsg").html("");
            }
        };
        
        
        var CalcLoanPurchaseCost = function(){
            var TotalPurchaseCost           = 0;
            
            loan_purchase_deposit           = FnNulltoAmt( $("#loan_purchase_deposit").val() );
            
            //console.log('loan_purchase_deposit='+loan_purchase_deposit);
            
            //ratepercentage, rateamount
            //property_purchase_value_percent loan_purchase_amount
            
            //alert(loan_purchase_deposit)
            //loan_purchase_market_value		= FnNulltoAmt( $("#loan_purchase_market_value-value").val() );
            
            loan_purchase_amount			= FnNulltoAmt($("#loan_purchase_amount").val());
            
            //console.log('loan_purchase_amount='+loan_purchase_amount);
            
            
            AmountPercentType               = $("[name='property_purchase_value_price']:checked").val();
            
             //console.log('AmountPercentType='+AmountPercentType);
            
            if (AmountPercentType == "ratepercentage"){
                LoanPurchaseDepositTemp       = Math.round( parseFloat(loan_purchase_amount) * parseFloat(loan_purchase_deposit) / 100 ); 
                //alert()
            }
            else{
                LoanPurchaseDepositTemp = loan_purchase_deposit;
            }
            
           // console.log('LoanPurchaseDepositTemp='+LoanPurchaseDepositTemp);
            
            other_exp_capital				= FnNulltoAmt( $("#other_exp_capital").val() );
            other_exp_slicitor_cost			= FnNulltoAmt( $("#other_exp_slicitor_cost").val() );
            other_exp_other					= FnNulltoAmt( $("#other_exp_other").val() );
            
            
            //loan_length_year				= FnNulltoAmt( $("#loan_length_year").val() );
            //loan_amount_loan				= FnNulltoAmt( $("#loan_amount_loan").val() );
            loan_esatblishment_fee			= FnNulltoAmt( $("#loan_esatblishment_fee").val() );
            //loan_length_month				= FnNulltoAmt( $("#loan_length_month").val() );
            //loan_interset_rate				= FnNulltoAmt( $("#loan_interset_rate").val() );
            loan_other_loan_costs			= FnNulltoAmt( $("#loan_other_loan_costs").val() );
            loan_valuation_fees				= FnNulltoAmt( $("#loan_valuation_fees").val() );
            
           
            /*
           console.log('loan_purchase_amount='+loan_purchase_amount);
            console.log('other_exp_capital='+other_exp_capital);
            console.log('other_exp_slicitor_cost='+other_exp_slicitor_cost);
            console.log('other_exp_other='+other_exp_other);
            console.log('loan_esatblishment_fee='+loan_esatblishment_fee);
             console.log('loan_other_loan_costs='+loan_other_loan_costs);
            console.log('loan_valuation_fees='+loan_valuation_fees);
        
                */
           
            TotalPurchaseCost               = parseFloat(loan_purchase_amount) + parseFloat(other_exp_capital) + parseFloat(other_exp_slicitor_cost) + parseFloat(other_exp_other) + parseFloat(loan_esatblishment_fee) + parseFloat(loan_other_loan_costs) + parseFloat(loan_valuation_fees)
            //alert(loan_purchase_amount);
            
            
            
            
            $("#TotalCosts").val(TotalPurchaseCost); 
            
            $("#TotalCostsH2Text").text("Costs: $" + TotalPurchaseCost);
            
            TotalLoanAmt                    = parseFloat(TotalPurchaseCost) - parseFloat(LoanPurchaseDepositTemp);
            
            $("#loan_amount_loanRange").val(TotalLoanAmt)
            $("#loan_amount_loan").val(TotalLoanAmt)
            
            //alert()
            
            //loan_amount_loan
            
            FnDepositLoansMsg();
        }
    
    var FnCalcAnnualPropertyExpense = function(){
        var TotalPropertyExp		= 0;
        
        ape_rates					= FnNulltoAmt( $("#ape_rates").val() );
        ape_body_corporate			= FnNulltoAmt( $("#ape_body_corporate").val() );
        ape_land_lease_fee			= FnNulltoAmt( $("#ape_land_lease_fee").val() );
        ape_insurance				= FnNulltoAmt( $("#ape_insurance").val() );
        ape_letting_fees			= FnNulltoAmt( $("#ape_letting_fees").val() );
        ape_management_fees			= FnNulltoAmt( $("#ape_management_fees").val() );
        
        
        ape_repairs_maitenance		= FnNulltoAmt( $("#ape_repairs_maitenance").val() );
        ape_gardening				= FnNulltoAmt( $("#ape_gardening").val() );
        ape_cleaning				= FnNulltoAmt( $("#ape_cleaning").val() );
        ape_service_contract		= FnNulltoAmt( $("#ape_service_contract").val() );
        ape_other					= FnNulltoAmt( $("#ape_other").val() );
        
        TotalPropertyExp            = parseFloat(ape_rates) + parseFloat(ape_body_corporate) + parseFloat(ape_land_lease_fee) + parseFloat(ape_insurance) + parseFloat(ape_letting_fees) + parseFloat(ape_management_fees) + parseFloat(ape_repairs_maitenance) + parseFloat(ape_gardening) + parseFloat(ape_cleaning) + parseFloat(ape_service_contract) + parseFloat(ape_other)
        
        $("#TotalPropertyExp").val(TotalPropertyExp); 
		$("#H2TotalPropertyExp").text("$" + TotalPropertyExp);
    };
    
</script>
<!-- end main content -->
<?php include"footer.php"; ?>

<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/jquery-steps/jquery-steps.min.js"></script>
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/bootstrap-touchpin/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/bootstrap-touchpin/bootstrap-touchpin-init.js"></script>
<script type="text/javascript">
   
      // --------------------------------------
   //analyser section
   //---------------------------------------
  
   $("#analyser").steps({
     headerTag: "h3",
     bodyTag: "section",
     enableAllSteps: true,
     enablePagination: false,
     transitionEffect: 1,
     transitionEffectSpeed: 200,
     titleTemplate: '<span class="number">#index#</span> #title#',
     loadingTemplate: '<span class="spinner"></span> #text#',
   });
   
   $(document).delegate('#right', 'click', function () {
     var a = $(".wizard").steps("next");
     if (!a) {
       $(".wizard").steps("finish");
     }
   });
   $(document).delegate('#left', 'click', function () {
     var a = $(".wizard").steps("previous");
     if (!a) {
       $(".wizard").steps("finish");
     }
   });
   
   //dropdown input number spinner input
   $(".touchspin1").TouchSpin({
     min: 0,
         max: 100,
         boostat: 5,
         maxboostedstep: 10,
         // postfix: '%',
         buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
         buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
   });
   $(".touchspin2").TouchSpin({
         min: 0,
         max: 1000000,
         boostat: 5,
         maxboostedstep: 10,
         // prefix: '$',
         buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
         buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
   });
   $(".touchspin4").TouchSpin({
         min: 0,
         max: 1000,
         boostat: 5,
         maxboostedstep: 10,
         buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
         buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
   });
   
   
   $(".bedroom-input").TouchSpin({
     min: 0,
     max: 2000000,
     verticalbuttons: true,
     prefix: '<img src="<?php echo SITE_BASE_URL;?>assets/img/bedroom-icon.png">',
     buttondown_class: 'btn-spinner btn-spinner-down',
     buttonup_class: 'btn-spinner btn-spinner-up'
   });
   $(".bathroom-input").TouchSpin({
     min: 0,
     max: 2000000,
     verticalbuttons: true,
     prefix: '<img src="<?php echo SITE_BASE_URL;?>assets/img/bathroom-icon.png">',
     buttondown_class: 'btn-spinner btn-spinner-down',
     buttonup_class: 'btn-spinner btn-spinner-up'
   });
   $(".carpark-input").TouchSpin({
     min: 0,
     max: 2000000,
     verticalbuttons: true,
     prefix: '<img src="<?php echo SITE_BASE_URL;?>assets/img/parking-icon.png">',
     buttondown_class: 'btn-spinner btn-spinner-down',
     buttonup_class: 'btn-spinner btn-spinner-up'
   });
   $(".touchspin3").TouchSpin({
     min: 0,
     max: 2000000,
     boostat: 5,
      maxboostedstep: 10,
      buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
      buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
   });
   $(".touchspin5").TouchSpin({
         min: 0,
         max: 12,
         boostat: 5,
         maxboostedstep: 10,
         buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
         buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
   });
   
   $(".touchspin6").TouchSpin({
         min: 0,
         max: 50000,
         boostat: 5,
         maxboostedstep: 10,
         buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
         buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
   });
   
    $(".touchspin7").TouchSpin({
         min: 0,
         max: 5000,
         boostat: 5,
         maxboostedstep: 10,
         buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
         buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
   });
   
   
    
    $(".touchspin8").TouchSpin({
         min: 0,
         max: 10000,
         boostat: 5,
         maxboostedstep: 10,
         buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
         buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
   });
   
      
    $(".touchspin9").TouchSpin({
         min: 0,
         max: 2000,
         boostat: 5,
         maxboostedstep: 10,
         buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
         buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
   });
   
     $(".touchspin10").TouchSpin({
         min: 0,
         max: 53,
         boostat: 5,
         maxboostedstep: 10,
         buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
         buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
   });
   
    $(".touchspin11").TouchSpin({
         min: 0,
         max: 3000,
         boostat: 5,
         maxboostedstep: 10,
         buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
         buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
   });
   
    $(".touchspin12").TouchSpin({
         min: 0,
         max: 10,
         boostat: 5,
         maxboostedstep: 10,
         buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
         buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
   });
   
   
   
   
   
   

   
  $(document).ready(function () {
      

    	/*----------------------------------------*/
    //var depositValue = $('#depositRange');
    //$("#loan_purchase_deposit").val($("#loan_purchase_depositRange").val());
	// Read value on change
	//$("#loan_purchase_deposit").val($("#loan_purchase_depositRange").val());
	
	
	//var depositValue = $('#loan_purchase_depositRange');
   // $("#loan_purchase_deposit").val($("#loan_purchase_depositRange").val());
   
    $("#loan_purchase_depositRange").mousemove(function (event) {
      $("#loan_purchase_deposit").val($(this).val());
    });
    
    $('#loan_purchase_deposit').on('change', function(){
        $('#loan_purchase_depositRange').val($('#loan_purchase_deposit').val());
      });
     $('#loan_purchase_deposit').on('keyup', function(){
        $('#loan_purchase_depositRange').val($('#loan_purchase_deposit').val());
      });
    
     

    //Market Value

    //var mrktVal = $('#loan_purchase_market_valueRange').val();
    // $("#loan_purchase_market_value").val(mrktVal);
    $("#loan_purchase_market_valueRange").mousemove(function (event) {
      $("#loan_purchase_market_value").val($(this).val());
    });
    $('#loan_purchase_market_value').on('change', function(){
        $('#loan_purchase_market_valueRange').val($('#loan_purchase_market_value').val());
      });
     $('#loan_purchase_market_value').on('keyup', function(){
        $('#loan_purchase_market_valueRange').val($('#loan_purchase_market_value').val());
      });
      





    
    $("#loan_purchase_amountRange").mousemove(function (event) {
      $("#loan_purchase_amount").val($(this).val());
    });
      $('#loan_purchase_amount').on('change', function(){
        $('#loan_purchase_amountRange').val($('#loan_purchase_amount').val());
      });
     $('#loan_purchase_amount').on('keyup', function(){
        $('#loan_purchase_amountRange').val($('#loan_purchase_amount').val());
      });
	
	
	
	/*---------------------------------------- */
	
	//Capital improvement at purchase($)
    $("#other_exp_capitalRange").mousemove(function (event) {
      $("#other_exp_capital").val($(this).val());
    });
    $('#other_exp_capital').on('change', function(){
        $('#other_exp_capitalRange').val($('#other_exp_capital').val());
      });
     $('#other_exp_capital').on('keyup', function(){
        $('#other_exp_capitalRange').val($('#other_exp_capital').val());
      });
	

    // slicitor_costRange
    $("#other_exp_slicitor_costRange").mousemove(function (event) {
      $("#other_exp_slicitor_cost").val($(this).val());

    });
        $('#other_exp_slicitor_cost').on('change', function(){
        $('#other_exp_slicitor_costRange').val($('#other_exp_slicitor_cost').val());
      });
     $('#other_exp_slicitor_cost').on('keyup', function(){
        $('#other_exp_slicitor_costRange').val($('#other_exp_slicitor_cost').val());
      });
	
	
	
	//Other($)
    $("#other_exp_otherRange").mousemove(function (event) {
      $("#other_exp_other").val($(this).val());

    });
	
	$('#other_exp_other').on('change', function(){
        $('#other_exp_otherRange').val($('#other_exp_other').val());
      });
     $('#other_exp_other').on('keyup', function(){
        $('#other_exp_otherRange').val($('#other_exp_other').val());
      });
      
	
	//Amount of loan ($)*

    $("#loan_amount_loanRange").mousemove(function (event) {
      $("#loan_amount_loan").val($(this).val());

    });
    $('#loan_amount_loan').on('change', function(){
        $('#loan_amount_loanRange').val($('#loan_amount_loan').val());
      });
     $('#loan_amount_loan').on('keyup', function(){
        $('#loan_amount_loanRange').val($('#loan_amount_loan').val());
      });
      
 
	//Establishment fee ($)*
    $("#loan_esatblishment_feeRange").mousemove(function (event) {
      $("#loan_esatblishment_fee").val($(this).val());

    });
     $('#loan_esatblishment_fee').on('change', function(){
        $('#loan_esatblishment_feeRange').val($('#loan_esatblishment_fee').val());
      });
     $('#loan_esatblishment_fee').on('keyup', function(){
        $('#loan_esatblishment_feeRange').val($('#loan_esatblishment_fee').val());
      });
	
	//Interest rate (%)
    $("#loan_interset_rateRange").mousemove(function (event) {
      $("#loan_interset_rate").val($(this).val());
    });
	  $('#loan_interset_rate').on('change', function(){
        $('#loan_interset_rateRange').val($('#loan_interset_rate').val());
      });
     $('#loan_interset_rate').on('keyup', function(){
        $('#loan_interset_rateRange').val($('#loan_interset_rate').val());
      });
      
      
	//loan_other_loan_costs
    $("#loan_other_loan_costsRange").mousemove(function (event) {
      $("#loan_other_loan_costs").val($(this).val());

    });
     $('#loan_other_loan_costs').on('change', function(){
        $('#loan_other_loan_costsRange').val($('#loan_other_loan_costs').val());
      });
     $('#loan_other_loan_costs').on('keyup', function(){
        $('#loan_other_loan_costsRange').val($('#loan_other_loan_costs').val());
      });
      
	
	//loan_valuation_fees
    $("#loan_valuation_feesRange").mousemove(function (event) {
      $("#loan_valuation_fees").val($(this).val());
    });
	 $('#loan_valuation_fees').on('change', function(){
        $('#loan_valuation_feesRange').val($('#loan_valuation_fees').val());
      });
     $('#loan_valuation_fees').on('keyup', function(){
        $('#loan_valuation_feesRange').val($('#loan_valuation_fees').val());
      });
      
      
	
	//arr_annual_rr
    $("#arr_annual_rrRange").mousemove(function (event) {
      $("#arr_annual_rr").val($(this).val());
    });
    
     $('#arr_annual_rr').on('change', function(){
        $('#arr_annual_rrRange').val($('#arr_annual_rr').val());
      });
     $('#arr_annual_rr').on('keyup', function(){
        $('#arr_annual_rrRange').val($('#arr_annual_rr').val());
      });
      
	
	//arr_weekly_rents
    $("#arr_weekly_rentsRange").mousemove(function (event) {
      $("#arr_weekly_rents").val($(this).val());
    });
	
	 $('#arr_weekly_rents').on('change', function(){
        $('#arr_weekly_rentsRange').val($('#arr_weekly_rents').val());
      });
     $('#arr_weekly_rents').on('keyup', function(){
        $('#arr_weekly_rentsRange').val($('#arr_weekly_rents').val());
      });
      
      

	//ape_rates
    $("#ape_ratesRange").mousemove(function (event) {
      $("#ape_rates").val($(this).val());
    });
	$('#ape_rates').on('change', function(){
        $('#ape_ratesRange').val($('#ape_rates').val());
      });
     $('#ape_rates').on('keyup', function(){
        $('#ape_ratesRange').val($('#ape_rates').val());
      });
      
      
	//ape_body_corporate
    $("#ape_body_corporateRange").mousemove(function (event) {
      $("#ape_body_corporate").val($(this).val());
    });
    $('#ape_body_corporate').on('change', function(){
        $('#ape_body_corporateRange').val($('#ape_body_corporate').val());
      });
     $('#ape_body_corporate').on('keyup', function(){
        $('#ape_body_corporateRange').val($('#ape_body_corporate').val());
      });
      
      
	
	//ape_land_lease_fee
    $("#ape_land_lease_feeRange").mousemove(function (event) {
      $("#ape_land_lease_fee").val($(this).val());
    });
     $('#ape_land_lease_fee').on('change', function(){
        $('#ape_land_lease_feeRange').val($('#ape_land_lease_fee').val());
      });
     $('#ape_land_lease_fee').on('keyup', function(){
        $('#ape_land_lease_feeRange').val($('#ape_land_lease_fee').val());
      });
      
	
	//ape_insurance
    $("#ape_insuranceRange").mousemove(function (event) {
      $("#ape_insurance").val($(this).val());

    });
     $('#ape_insurance').on('change', function(){
        $('#ape_insuranceRange').val($('#ape_insurance').val());
      });
     $('#ape_insurance').on('keyup', function(){
        $('#ape_insuranceRange').val($('#ape_insurance').val());
      });
      
      
	
	//ape_letting_fees
    $("#ape_letting_feesRange").mousemove(function (event) {
      $("#ape_letting_fees").val($(this).val());

    });
    
     $('#ape_letting_fees').on('change', function(){
        $('#ape_letting_feesRange').val($('#ape_letting_fees').val());
      });
     $('#ape_letting_fees').on('keyup', function(){
        $('#ape_letting_feesRange').val($('#ape_letting_fees').val());
      });
      
      
	
	//ape_management_fees
    $("#ape_management_feesRange").mousemove(function (event) {
      $("#ape_management_fees").val($(this).val());

    });
    
      $('#ape_management_fees').on('change', function(){
        $('#ape_management_feesRange').val($('#ape_management_fees').val());
      });
     $('#ape_management_fees').on('keyup', function(){
        $('#ape_management_feesRange').val($('#ape_management_fees').val());
      });
      
	
	//ape_repairs_maitenance
    $("#ape_repairs_maitenanceRange").mousemove(function (event) {
      $("#ape_repairs_maitenance").val($(this).val());

    });
    
    $('#ape_repairs_maitenance').on('change', function(){
        $('#ape_repairs_maitenanceRange').val($('#ape_repairs_maitenance').val());
      });
     $('#ape_repairs_maitenance').on('keyup', function(){
        $('#ape_repairs_maitenanceRange').val($('#ape_repairs_maitenance').val());
      });
      
      
	
	//ape_gardening
    $("#ape_gardeningRange").mousemove(function (event) {
      $("#ape_gardening").val($(this).val());

    });
    
      $('#ape_gardening').on('change', function(){
        $('#ape_gardeningRange').val($('#ape_gardening').val());
      });
     $('#ape_gardening').on('keyup', function(){
        $('#ape_gardeningRange').val($('#ape_gardening').val());
      });
      
      
	
	
	//ape_cleaning
    $("#ape_cleaningRange").mousemove(function (event) {
      $("#ape_cleaning").val($(this).val());

    });
    
    $('#ape_cleaning').on('change', function(){
        $('#ape_cleaningRange').val($('#ape_cleaning').val());
      });
     $('#ape_cleaning').on('keyup', function(){
        $('#ape_cleaningRange').val($('#ape_cleaning').val());
      });
      
      
	
	//ape_service_contract
    $("#ape_service_contractRange").mousemove(function (event) {
      $("#ape_service_contract").val($(this).val());

    });
    
     $('#ape_service_contract').on('change', function(){
        $('#ape_service_contractRange').val($('#ape_service_contract').val());
      });
     $('#ape_service_contract').on('keyup', function(){
        $('#ape_service_contractRange').val($('#ape_service_contract').val());
      });
      
	
	
	//ape_other
    $("#ape_otherRange").mousemove(function (event) {
      $("#ape_other").val($(this).val());

    });
    
      $('#ape_other').on('change', function(){
        $('#ape_otherRange').val($('#ape_other').val());
      });
     $('#ape_other').on('keyup', function(){
        $('#ape_otherRange').val($('#ape_other').val());
      });
      

	
		//ape_other
    $("#ae_entity_rowsRange").mousemove(function (event) {
      $("#ae_entity_rows").val($(this).val());

    });
          
      $('#ae_entity_rows').on('change', function(){
        $('#ae_entity_rowsRange').val($('#ae_entity_rows').val());
      });
     $('#ae_entity_rows').on('keyup', function(){
        $('#ae_entity_rowsRange').val($('#ae_entity_rows').val());
      });
      
      
      
	
		//mf_customer_price_index
    $("#mf_customer_price_indexRange").mousemove(function (event) {
      $("#mf_customer_price_index").val($(this).val());

    });
    
       $('#mf_customer_price_index').on('change', function(){
        $('#mf_customer_price_indexRange').val($('#mf_customer_price_index').val());
      });
     $('#mf_customer_price_index').on('keyup', function(){
        $('#mf_customer_price_indexRange').val($('#mf_customer_price_index').val());
      });
      
      
      
	
	
		//mf_capital_growth
    $("#mf_capital_growthRange").mousemove(function (event) {
      $("#mf_capital_growth").val($(this).val());

    });
       $('#mf_capital_growth').on('change', function(){
        $('#mf_capital_growthRange').val($('#mf_capital_growth').val());
      });
     $('#mf_capital_growth').on('keyup', function(){
        $('#mf_capital_growthRange').val($('#mf_capital_growth').val());
      });
  
      
      
	
		//mf_land_tax
    $("#mf_land_taxRange").mousemove(function (event) {
      $("#mf_land_tax").val($(this).val());

    });
      $('#mf_land_tax').on('change', function(){
        $('#mf_land_taxRange').val($('#mf_land_tax').val());
      });
     $('#mf_land_tax').on('keyup', function(){
        $('#mf_land_taxRange').val($('#mf_land_tax').val());
      });
      
	
	
		//de_construction_year_completed
    $("#de_construction_year_completedRange").mousemove(function (event) {
      $("#de_construction_year_completed").val($(this).val());

    });
      $('#de_construction_year_completed').on('change', function(){
        $('#de_construction_year_completedRange').val($('#de_construction_year_completed').val());
      });
     $('#de_construction_year_completed').on('keyup', function(){
        $('#de_construction_year_completedRange').val($('#de_construction_year_completed').val());
      });
      
      
      
		//de_estimate_land_value
    $("#de_estimate_land_valueRange").mousemove(function (event) {
      $("#de_estimate_land_value").val($(this).val());

    });
    
      $('#de_estimate_land_value').on('change', function(){
        $('#de_estimate_land_valueRange').val($('#de_estimate_land_value').val());
      });
     $('#de_estimate_land_value').on('keyup', function(){
        $('#de_estimate_land_valueRange').val($('#de_estimate_land_value').val());
      });
      
      
      
		//loan_value_ratio_growth
    $("#loan_value_ratio_growthRange").mousemove(function (event) {
      $("#loan_value_ratio_growth").val($(this).val());

    });
    
      $('#loan_value_ratio_growth').on('change', function(){
        $('#loan_value_ratio_growthRange').val($('#loan_value_ratio_growth').val());
      });
     $('#loan_value_ratio_growth').on('keyup', function(){
        $('#loan_value_ratio_growthRange').val($('#loan_value_ratio_growth').val());
      });
      
	
   
   //range configration with text box
   $("input[type=range]").mousemove(function (e) {
     var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));
     var percent = val * 100;
   
     $(this).css('background-image',
       '-webkit-gradient(linear, left top, right top, ' +
       'color-stop(' + percent + '%, #df7164), ' +
       'color-stop(' + percent + '%, #F5D0CC)' +
       ')');
     $(this).css('background-image',
       '-moz-linear-gradient(left center, #DF7164 0%, #DF7164 ' + percent + '%, #F5D0CC ' + percent + '%, #F5D0CC 100%)');
   });
    
         CalcLoanPurchaseCost();
   });
   
   
   
   
</script>
