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
	$other_exp_slicitor_cost   			= isset($_REQUEST["other_exp_slicitor_cost"]) ? $_REQUEST["other_exp_slicitor_cost"] : "0";
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
	$loan_esatblishment_fee   			= isset($_REQUEST["loan_esatblishment_fee"]) ? $_REQUEST["loan_esatblishment_fee"] : "0";
	$loan_amount_loan   				= isset($_REQUEST["loan_amount_loan"]) ? $_REQUEST["loan_amount_loan"] : "0";
	$loan_interset_rate   				= isset($_REQUEST["loan_interset_rate"]) ? $_REQUEST["loan_interset_rate"] : "0";
	$loan_other_loan_costs   			= isset($_REQUEST["loan_other_loan_costs"]) ? $_REQUEST["loan_other_loan_costs"] : "0";
	$loan_valuation_fees   				= isset($_REQUEST["loan_valuation_fees"]) ? $_REQUEST["loan_valuation_fees"] : "0";
	$property_master_auto_id   			= isset($_REQUEST["property_master_auto_id"]) ? $_REQUEST["property_master_auto_id"] : "0";
	
	
	



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
	$Rate        		                = $row["rate"] ? $row["rate"] : "";
	$StartRate        	                = $row["start_rate"]  ? $row["start_rate"] : "";
	$DpoRate        	                = $row["dpo_rate"] ? $row["dpo_rate"] : "";
	$property_master_auto_id   			= $row["property_master_auto_id"];
	$property_purchase_value_price   	= $row["property_purchase_value_price"] ? $row["property_purchase_value_price"] : "";
	$loan_purchase_deposit   			= $row["loan_purchase_deposit"] ? $row["loan_purchase_deposit"] : "10";
	$loan_purchase_market_value   		= $Rate;
	$loan_purchase_amount   			= $StartRate;
	$other_exp_capital   				= $row["other_exp_capital"] ? $row["other_exp_capital"] : "0";
	$other_exp_slicitor_cost   			= $row["other_exp_slicitor_cost"] ? $row["other_exp_slicitor_cost"] : "0";
	$other_exp_stamping_cost   			= $row["other_exp_stamping_cost"] ? $row["other_exp_stamping_cost"] : "0";
	$other_exp_other   					= $row["other_exp_other"] ? $row["other_exp_other"] : "0";
	$arr_rental_type   					= $row["arr_rental_type"] ? $row["arr_rental_type"] : "";
	$arr_annual_rr   					= $row["arr_annual_rr"] ? $row["arr_annual_rr"] : "0";
	$arr_weekly_rents   				= $row["arr_weekly_rents"] ? $row["arr_weekly_rents"] : "0";
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
	//echo 	$loan_purchase_deposit;
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
	<div class="col-lg-8">
		<div class="card h-100 mb-0">
      <div class="card-body">
         <div class="row">
            <!-- property overview -->
            <div class="col-9">
               <div class="title-area">
                  <h4 class="heading-primary"><?php echo $row["apartment_no"]; ?>|<?php echo $row["building"]; ?>|<?php echo $row["project_name"]; ?> | <?php echo $row["country"]; ?></h4>
               </div>
               <div class="row mt-30">
               <div class="col-lg-4 border-right-1">
                  <a href="#" class="text-center d-block text-muted">
                     <img src="<?php echo SITE_BASE_URL;?>assets/img/icon/parking-icon.png" class="img-fluid">
                     <div>
                        <span class="f-s-12 text-muted">Parking</span>
                        <span class="p-l-10 p-r-10 text-muted">|</span>
                        <span class="f-s-12 text-muted"><?php echo $no_of_parkingspace; ?></span>
                     </div>
                  </a>
               </div>
               <div class="col-lg-4 border-right-1">
                  <a href="#" class="text-center d-block text-muted">
                     <img src="<?php echo SITE_BASE_URL;?>assets/img/icon/bedroom-icon.png" class="img-fluid">
                     <div>
                        <span class="f-s-12 text-muted">Bedroom</span>
                        <span class="p-l-10 p-r-10 text-muted">|</span>
                        <span class="f-s-12 text-muted"><?php echo $no_of_bedrooms; ?></span>
                     </div>
                  </a>
               </div>
               <div class="col-lg-4">
                  <a href="#" class="text-center d-block text-muted">
                     <img src="<?php echo SITE_BASE_URL;?>assets/img/icon/bathroom-icon.png" class="img-fluid">
                     <div>
                        <span class="f-s-12 text-muted">Bathroom</span>
                        <span class="p-l-10 p-r-10 text-muted">|</span>
                        <span class="f-s-12 text-muted"><?php echo $no_of_bathroom; ?></span>
                     </div>
                  </a>
               </div>
            </div>
           
               	<div class="row">
	               <div class="col-lg-8 mt-30">
	                  <div class="basic-list-group">
	                     <ul class="list-group list-group-flush">
	                        <li class="list-group-item d-flex justify-content-between align-items-center">
	                           Median listing price 
	                           <span class="badge">N/A</span>
	                        </li>
	                        <li class="list-group-item d-flex justify-content-between align-items-center">
	                           1 yr listing price growth 
	                           <span class="badge">+1.4%</span>
	                        </li>
	                        <li class="list-group-item d-flex justify-content-between align-items-center">
	                           Median weekly rent 
	                           <span class="badge">$695</span>
	                        </li>
	                        <li class="list-group-item d-flex justify-content-between align-items-center">
	                           Median gross yield  
	                           <span class="badge">8%</span>
	                        </li>
	                     </ul>
	                  </div>
	               </div>
	            </div>
	        </div><!-- end col-9-->    
            <!-- end property overview-->
      </div>
   </div>
	</div>
</div><!-- end property content-->
   <!-- property sidebar -->
   <div class="col-lg-4">
      <div class="card rating-card h-100 mb-0">
         <div class="card-body">
            <a href="#">
               <div class="">
                  <img src="<?php echo SITE_BASE_URL;?>assets/img/avenue_prop_img_001.jpg" class="img-fluid">
               </div>
            </a>
            <div class="rating row no-gutters">
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
            </div>
         </div>
         <div class="card-footer">
            <div class="property-nav">
               <a href="#" class="btn btn-primary btn-block">save brochure to my folder</a>
               <a href="property-details.php" class="btn btn-primary btn-block">PROPERTY Details</a>
            </div>
         </div>
      </div>
   </div>
   <!-- end property sidebar -->
   <!-- rating and preview -->
    <!-- <div class="col-3 rating-col">
       <div class="ratingcol-inner">
          <div class="preview-box">
             <div class="preview-img">
                <img src="<?php //echo SITE_BASE_URL;?>uploads/propertyimage/<?php //echo $row["property_image"]; ?>" class="img-fluid preview-img-thumb">
                  <?php
                   //$Proimagerows = self::GetPropertyImages($row["project_id"],$row["floor_type"]);
        			//foreach ($Proimagerows as $Proimagerow) 
        			//{
        			    //$imageFileName=$Proimagerow["image"];?>
        			    <a class="preview-link" data-fancybox="gallery" href="<?php //echo SITE_BASE_URL;?>uploads/propertyimage/<?php //echo $imageFileName;?>"><img src="<?php //echo SITE_BASE_URL;?>uploads/propertyimage/expand.png" class="img-fluid"></a>
        			<?php
        			//}?>
             </div>
          </div>
          <div class="rating-box">
             <div class="stars">
                <nav class="navbar navbar-expand-sm">
                   <ul class="navbar-nav">
                      <li class="nav-item"><span class="fa fa-star"></span>
                         <span class="fa fa-star"></span>
                         <span class="fa fa-star"></span>
                         <span class="fa fa-star"></span>
                         <span class="fa fa-star empty-star"></span>
                      </li>
                   </ul>
                   <ul class="nav navbar-nav ml-auto">  
                      <span class="rating-number">(12,775)</span>
                   </ul>
                </nav>
             </div>
             <div class="customer-rating">
                <h4>Customer-rating</h4>
             </div>
             <div class="property-action mt-5">
             <div class="property-btn-group">
                <a class="btn btn-outline-primary btn-block" href="javascript:void(0)" onclick="AddToMyFolderFn('brochure1.pdf')">Save Brochure to My Folder</a>
                <a class="btn btn-outline-primary btn-block" target="blank" href="http://duvalknowledge.com/dpo/uploads/brochure/brochure1.pdf">Download Brochure</a>
             </div>
          </div>
          </div>
       </div>
    </div> -->
    <!-- end rating and preview -->
   </div>


   <div class="row no-gutters">
      <div class="col-12">
         <div class="analyser-section">
            <form class="dpo-form"  action="<?php echo SITE_BASE_URL;?>/Property/propertysave.html?buttonaction=<?php echo $action;?>&user_id=<?php echo $user_id;?>&property_id=<?php echo $ProprtyId;?>" method="post"   >
               <div id="analyser">
                  <!--loan and purchase -->
                  <h3>Loan & purchase Costs</h3>
                  <section>
                     <div class="row">
                        <div class="col-12">
                           <!-- purchase details-->
                           <div class="card my-4">
                              <div class="card-header">
                                 <div class="card-title">
                                    PURCHASE DETAILS
                                 </div>
                              </div>
                              <?php
                         
                              
                                if ( $property_purchase_value_price == "" ){
                                    
                                    $PurchasePriceChecked = "checked";
                                    
                                }else{
                                    
                                     $PurchasePriceChecked = "";
                                }
                               
                              ?>
                              <div class="card-body">
                                 <div class="row">
                                      <div class="col-6 col-md-4 col-lg-4 mb-3">
                                        <input type="radio" <?php if($property_purchase_value_price=="rateamount"){?> Checked <?php }?> value="rateamount" name="property_purchase_value_price" id="property_purchase_value_price"  onclick="OnClickRadio(this);"  > 
                                        <label for="property_purchase_value_price">Enter as $ value</label>
                                     </div>
                                     <div class="col-6 mb-3">
                                        <input type="radio" <?php if($property_purchase_value_price=="ratepercentage"){?> Checked <?php }?>  value="ratepercentage" name="property_purchase_value_price" id="property_purchase_value_percent"  onclick="OnClickRadio(this);" <?php echo  $PurchasePriceChecked;?> >
                                        <label for="property_purchase_value_percent">Enter as % of property purchase price</label>
                                     </div>
                                 </div>
                                 <div class="row">
                                    <!-- deposit percentage-->
                                    <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                       <div class="form-group">
                                          <label>Deposit(%) *</label>
                                          <div class="input-icon">
                                             <input class="touchspin1" type="text" value="<?php echo $loan_purchase_deposit; ?>"  name="loan_purchase_deposit" id="loan_purchase_deposit" calc="loan_purchase_cost">
                                             
                                             <input type="hidden" name="LoanPurchaseDepositTemp" id="LoanPurchaseDepositTemp" value=""  min="5" />
                                          </div>
                                          <div class="range-container">
                                             <input type="range" min="0" max="100" step="1" value="<?php echo $loan_purchase_deposit; ?>" id="loan_purchase_depositRange" calc='loan_purchase_cost' >
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end deposit percentage-->
                                    <!-- market value-->
                                    <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">  
                                       <div class="form-group">
                                          <label>Market Value($)</label>
                                          <input class="touchspin1" type="text" value="<?php echo $loan_purchase_market_value; ?>" name="loan_purchase_market_value" id="loan_purchase_market_value" calc="loan_purchase_cost">
                                          <div class="range-container">
                                             <input type="range" min="0" max="1000000" step="1" value="<?php echo $loan_purchase_market_value; ?>" id="loan_purchase_market_valueRange" calc='loan_purchase_cost' >
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end market value-->
                                    <!-- purchase amount-->
                                    <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                       <div class="form-group">
                                          <label>Purchase amount($)</label>
                                          <input class="touchspin1" type="text" value="<?php echo $loan_purchase_amount; ?>" name="loan_purchase_amount" id="loan_purchase_amount" calc="loan_purchase_cost">
                                          <div class="range-container">
                                             <input type="range" min="0" max="1000000" step="1" value="<?php echo $loan_purchase_amount; ?>" id="loan_purchase_amountRange" calc='loan_purchase_cost'>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end purchase amount-->
                                 </div>
                              </div>
                           </div>
                           <!-- end purchase details-->
                           <!-- other expense -->
                           <div class="card mb-4">
                              <div class="card-header">
                                 <div class="card-title">
                                    OTHER EXPENSES
                                 </div>
                              </div>
                              <div class="card-body">
                                 <div class="row">
                                    <!-- capital improvement -->
                                    <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                       <div class="form-group">
                                          <label>Capital improvement at purchase($) *</label>
                                          <input class="touchspin1" type="text" value="<?php echo $other_exp_capital; ?>" name="other_exp_capital" id="other_exp_capital" calc="loan_purchase_cost">
                                          <div class="range-container">
                                             <input type="range" min="0" max="100" step="1" value="<?php echo $other_exp_capital; ?>" id="other_exp_capitalRange" calc='loan_purchase_cost'>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end capital improvement-->
                                    <!-- solicitor cost-->
                                    <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                       <div class="form-group">
                                          <label>Solicitor’s cost ($)*</label>
                                          <input class="touchspin1" type="text" value="<?php echo $other_exp_slicitor_cost; ?>" name="other_exp_slicitor_cost" id="other_exp_slicitor_cost" calc="loan_purchase_cost">
                                          <div class="range-container">
                                             <input type="range" min="0" max="100" step="1" value="<?php echo $other_exp_slicitor_cost; ?>" id="other_exp_slicitor_costRange" calc='loan_purchase_cost'>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end solicitor cost-->
                                    <!-- stamping fee-->
                                    <!-- <div class="col-4 range-form-group">
                                       <div class="form-group">
                                          <label>Stamping fee($)</label>
                                          <input class="touchspin1" type="text" value="" name="other_exp_stamping_cost" id="other_exp_stamping_cost" >
                                          <div class="range-container">
                                             <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                          </div>
                                       </div>
                                    </div> -->
                                    <!-- end stamping fee-->
                                    <!-- other -->
                                    <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                       <div class="form-group">
                                          <label>Other($) *</label>
                                          <input class="touchspin1" type="text" value="<?php echo $other_exp_other; ?>" name="other_exp_other" id="other_exp_other" calc="loan_purchase_cost">
                                          <div class="range-container">
                                             <input type="range" min="0" max="10000" step="1" value="<?php echo $other_exp_other; ?>" id="other_exp_otherRange" calc='loan_purchase_cost' >
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end other-->
                                 </div>
                              </div>
                           </div>
                           <!-- end other expense -->
                          <!-- Dynamic loan tabs -->
                           <div class="card dynamic-tabs mb-4">
                              <div class="card-header">
                                 <ul class="nav nav-tabs dynamic-tabs-list" role="tablist">
                                    <li><a class="active" href="#contact_01" data-toggle="tab">Loan 1</a> </li>
                                    <li><a href="#" class="add-contact"><i class="fa fa-plus-circle fa-lg"></i></a> </li>
	                             </ul>
                              </div>
                               <?php
                         
                              
                                if ( $loan_pricipal_interest == "" ){
                                    
                                    $loanprincipalinterseteChecked = "checked";
                                    
                                }else{
                                    
                                     $loanprincipalinterseteChecked = "";
                                }
                               
                              ?>
                              
                              <div class="card-body">
                                 <div class="tab-content">
                                    <div class="tab-pane active" id="contact_01">
                                       <div class="" id="anaBody">
                                          <div class="row">
                                               <div class="col-4 mb-3">
                                                <input type="radio" <?php if($loan_pricipal_interest=="io"){?> Checked <?php }?>  value="io" name="loan_pricipal_interest" id="loan_interest"  calc="loan_purchase_cost">
                                                 <label for="loan_interest">Interest Only</label>
                                              </div>
                                              <div class="col-6 mb-3">
                                                <input type="radio" <?php if($loan_pricipal_interest=="pi"){?> Checked <?php }?>   value="pi" name="loan_pricipal_interest" id="loan_principal" calc="loan_purchase_cost"> 
                                                 <label for="loan_principal">Principal & interest</label>
                                              </div>
                                          </div>
                                          <div class="row">
                                             <!-- loan length -->
                                             <div class="col-12 col-md-4 col-lg-4 col-xxl-4 range-form-group">
                                                <div class="form-group">
                                                   <label>Loan length*</label>
                                                   <div class="row mb-4">
                                                      <div class="col-9">
                                                         <input class="touchspin4" type="text" value="<?php echo $loan_length_year; ?>" name="loan_length_year" id="loan_length_year" calc="loan_purchase_cost"> 
                                                      </div>
                                                      <label class="col-form-label col-3">years &</label>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-9">
                                                         <input class="touchspin1" type="text" value="<?php echo $loan_length_month; ?>" name="loan_length_month" id="loan_length_month" calc="loan_purchase_cost">
                                                      </div>
                                                      <label class="col-form-label col-3">month</label>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end loan length-->
                                             <!-- amount of loan -->
                                             <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                                <div class="form-group">
                                                   <label>Amount of loan ($)*</label>
                                                   <input class="touchspin1" type="text" value="<?php echo $loan_amount_loan; ?>" name="loan_amount_loan" id="loan_amount_loan" >
                                                   <div class="range-container">
                                                      <input type="range" min="0" max="10000" step="1" value="<?php echo $loan_amount_loan; ?>" id="loan_amount_loanRange">
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end amount of loan-->
                                             <!-- Establishment fee -->
                                             <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                                <div class="form-group">
                                                   <label>Establishment fee ($)*</label>
                                                   <input class="touchspin1" type="text" value="<?php echo $loan_esatblishment_fee; ?>" name="loan_esatblishment_fee" id="loan_esatblishment_fee" calc="loan_purchase_cost" >
                                                   <div class="range-container">
                                                      <input type="range" min="0" max="10000" step="1" value="<?php echo $loan_esatblishment_fee; ?>" id="loan_esatblishment_feeRange" calc="loan_purchase_cost" >
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end Establishment fee-->
                                             <!-- interest rate -->
                                             <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                                <div class="form-group">
                                                   <label>Interest rate (%)*</label>
                                                   <input class="touchspin1" type="text" value="<?php echo $loan_interset_rate; ?>" name="loan_interset_rate" id="loan_interset_rate" calc="loan_purchase_cost">
                                                   <div class="range-container">
                                                      <input type="range" min="0" max="10000" step="1" value="<?php echo $loan_interset_rate; ?>" id="loan_interset_rateRange" calc="loan_purchase_cost" >
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end intrerest rate-->
                                             <!-- other -->
                                             <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                                <div class="form-group">
                                                   <label>Other loan costs ($)</label>
                                                   <input class="touchspin1" type="text" value="<?php echo $loan_other_loan_costs; ?>" name="loan_other_loan_costs" id="loan_other_loan_costs" calc="loan_purchase_cost">
                                                   <div class="range-container">
                                                      <input type="range" min="0" max="10000" step="1" value="<?php echo $loan_other_loan_costs; ?>" id="loan_other_loan_costsRange" calc="loan_purchase_cost" >
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end other-->
                                             <!-- other -->
                                             <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                                <div class="form-group">
                                                   <label>Valuation fees ($)</label>
                                                   <input class="touchspin1" type="text" value="<?php echo $loan_valuation_fees; ?>" name="loan_valuation_fees" id="loan_valuation_fees" calc="loan_purchase_cost">
                                                   <div class="range-container">
                                                      <input type="range" min="0" max="10000" step="1" value="<?php echo $loan_valuation_fees; ?>" id="loan_valuation_feesRange" calc="loan_purchase_cost" >
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end other-->
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              
                           </div>
                           <!-- end dunamic loan tabs-->
                           <!-- final card-->
                           <div class="card final-card bg-b1">
                              <div class="row ">
                                 <div class="col text-left align-self-center">
                                    <div class="text-wrapper">
                                       <h2>Total Purchase</h2>
                                    </div>
                                 </div>
                                 <div class="col text-center align-self-center">
                                    <div class="text-wrapper">
                                       <h2 id="TotalCostsH2Text">Costs: $000,000</h2>
                                       <input type="hidden" name="TotalCosts" id="TotalCosts" value="" >
                                    </div>
                                 </div>
                                 <div class="col text-right align-self-center">
                                    <div class="text-wrapper">
                                       <h2 id="H2DepositLoanMsg"></h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- end final card-->
                           <div class="analyser-submit-section">
                              <div class="btn-div text-right pt-4">
                                 <a id="right" class="btn btn-outline-dark" href="#next">Rent & Expense <i class="fa fa-chevron-right"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
                  <!-- end loan and purchase -->
                  <!-- Rent & Expenses -->
                  <h3>Rent & Expenses</h3>
                  <section>
                     <!-- purchase details-->
                     <div class="card my-4">
                        <div class="card-header">
                           <div class="card-title">ANNUAL RENTAL RETURNS</div>
                        </div> 
                         <?php
                         
                            if ( $arr_rental_type == "" ){
                                
                                $arrrentaltypeChecked = "checked";
                                
                            }else{
                                
                                 $arrrentaltypeChecked = "";
                            }
                           
                          ?>
                        <div class="card-body">
                           <div class="row">
                               
                              <div class="col-2">
                                 <label>Rental Type:</label>
                              </div>
                              <div class="col-4 mb-3">
                                 <div class="i-checks">
                                     <input type="radio" <?php if($arr_rental_type=="longterm"){?> Checked <?php }?> value="longterm" name="arr_rental_type" id="longterm"  <?php echo $arrrentaltypeChecked; ?> >
                                    <label for="longterm">Resident long term</label>
                                 </div>
                              </div>
                              <div class="col-4 mb-3">
                                 <div class="i-checks">
                                     <input type="radio" <?php if($arr_rental_type=="holidayrental"){?> Checked <?php }?>  value="holidayrental" name="arr_rental_type" id="holidayrental" >
                                     <label for="holidayrental">Holiday rental</label> 
                                 </div>
                              </div>
                              
                              
                              
                           </div>
                           
                           
                           
                           <div class="row">
                              <!-- deposit percentage-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                 <div class="form-group">
                                    <label>Rate of occupancy (wks)</label>
                                    <div class="input-icon">
                                       <input class="touchspin1" type="text" value="<?php echo $arr_annual_rr; ?>" name="arr_annual_rr" id="arr_annual_rr">
                                    </div>
                                    <div class="range-container">
                                       <input type="range" min="0" max="53" step="1" value="<?php echo $arr_annual_rr; ?>" id="arr_annual_rrRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end deposit percentage-->
                              <!-- market value-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Weekly rents($)</label>
                                    <input class="touchspin1" type="text" value="<?php echo $arr_weekly_rents; ?>" name="arr_weekly_rents" id="arr_weekly_rents" >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $arr_weekly_rents; ?>" id="arr_weekly_rentsRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end market value-->
                              <div class="col-12">
                                 <label>Total annual rent: <span id="TotalAnnualRentSpan">$0</span></label>
								 
                                 <div class="note">
                                    <p>Please note:    You can only enter rental values for either residential or holiday rental, not both. Whichever screen you complete and keep as the selected (visible) option will be the rental type used for analysis.</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end purchase details-->
                     <!-- other expense -->
                     <div class="card mb-4">
                        <div class="card-header">
                           <div class="card-title">ANNUAL PROPERTY EXPENSES</div>
                        </div> 
                        <div class="card-body">
                           <div class="row">
                              <!-- capital improvement -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                 <div class="form-group">
                                    <label>Rates($) *</label>
                                    <input class="touchspin1" type="text" value="<?php echo $ape_rates; ?>" name="ape_rates" id="ape_rates" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $ape_rates; ?>" id="ape_ratesRange"calc='AnnualPropertyExpense' >
                                    </div>
                                 </div>
                              </div>
                              <!-- end capital improvement-->
                              <!-- solicitor cost-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Body corporate($) *</label>
                                    <input class="touchspin1" type="text" value="<?php echo $ape_body_corporate; ?>" name="ape_body_corporate" id="ape_body_corporate" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $ape_body_corporate; ?>" id="ape_body_corporateRange" calc='AnnualPropertyExpense' >
                                    </div>
                                 </div>
                              </div>
                              <!-- end solicitor cost-->
                              <!-- stamping fee-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Land lease fee($)*</label>
                                    <input class="touchspin1" type="text" value="<?php echo $ape_land_lease_fee; ?>" name="ape_land_lease_fee" id="ape_land_lease_fee" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $ape_land_lease_fee; ?>" id="ape_land_lease_feeRange" calc='AnnualPropertyExpense' >
                                    </div>
                                 </div>
                              </div>
                              <!-- end stamping fee-->
                              <!-- other -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                 <div class="form-group">
                                    <label>Insurance ($) *</label>
                                    <input class="touchspin1" type="text" value="<?php echo $ape_insurance; ?>" name="ape_insurance" id="ape_insurance" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $ape_insurance; ?>" id="ape_insuranceRange" calc='AnnualPropertyExpense'>
                                    </div>
                                 </div>
                              </div>
                              <!-- end other-->
                              <!-- Letting fees($)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Letting fees($)*</label>
                                    <input class="touchspin1" type="text" value="<?php echo $ape_letting_fees; ?>" name="ape_letting_fees" id="ape_letting_fees" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $ape_letting_fees; ?>" id="ape_letting_feesRange" calc='AnnualPropertyExpense' >
                                    </div>
                                 </div>
                              </div>
                              <!-- end Letting fees($)*-->
                              <!-- Management fees(%)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Management fees(%)*</label>
                                    <input class="touchspin1" type="text" value="<?php echo $ape_management_fees; ?>" name="ape_management_fees" id="ape_management_fees" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="0" max="100" step="1" value="<?php echo $ape_management_fees; ?>" id="ape_management_feesRange" calc='AnnualPropertyExpense' >
                                    </div>
                                 </div>
                              </div>
                              <!-- end Management fees(%)*-->
                              <!-- Repairs/maintenance($)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                 <div class="form-group">
                                    <label>Repairs/maintenance($)*</label>
                                    <input class="touchspin1" type="text" value="<?php echo $ape_repairs_maitenance; ?>" name="ape_repairs_maitenance" id="ape_repairs_maitenance" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $ape_repairs_maitenance; ?>" id="ape_repairs_maitenanceRange" calc='AnnualPropertyExpense' >
                                    </div>
                                 </div>
                              </div>
                              <!-- end Repairs/maintenance($)*-->
                              <!-- Gardening($)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Gardening($)*</label>
                                    <input class="touchspin1" type="text" value="<?php echo $ape_gardening; ?>" name="ape_gardening" id="ape_gardening" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $ape_gardening; ?>" id="ape_gardeningRange" calc='AnnualPropertyExpense' >
                                    </div>
                                 </div>
                              </div>
                              <!-- end Gardening($)*-->
                              <!-- Cleaning($)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Cleaning($)*</label>
                                    <input class="touchspin1" type="text" value="<?php echo $ape_cleaning; ?>" name="ape_cleaning" id="ape_cleaning" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $ape_cleaning; ?>" id="ape_cleaningRange" calc='AnnualPropertyExpense' >
                                    </div>
                                 </div>
                              </div>
                              <!-- end Cleaning($)*-->
                              <!-- Service contract($)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                 <div class="form-group">
                                    <label>Service contract($)*</label>
                                    <input class="touchspin1" type="text" value="<?php echo $ape_service_contract; ?>" name="ape_service_contract" id="ape_service_contract" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $ape_service_contract; ?>" id="ape_service_contractRange" calc='AnnualPropertyExpense' >
                                    </div>
                                 </div>
                              </div>
                              <!-- end Service contract($)*-->
                              <!-- Other($)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Other($)*</label>
                                    <input class="touchspin1" type="text" value="<?php echo $ape_other; ?>" name="ape_other" id="ape_other" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $ape_other; ?>" id="ape_otherRange" calc='AnnualPropertyExpense' >
                                    </div>
                                 </div>
                              </div>
                              <!-- end Other($)*-->
                           </div>
                        </div>
                     </div>
                     <!-- end other expense -->
                     <div class="card final-card bg-b1">
                        <div class="row ">
                           <div class="col text-left align-self-center">
                              <div class="text-wrapper">
                                 <h2>Total annual property expenses</h2>
                              </div>
                           </div>
                           <div class="col text-center align-self-center">
                              <div class="text-wrapper">
                                 <!-- <h2>Costs: $182,000</h2> -->
                              </div>
                           </div>
                           <div class="col text-right align-self-center">
                              <div class="text-wrapper">
                                  <input type="hidden" name="TotalPropertyExp" id="TotalPropertyExp" value=""  />
                                 <h2 id="H2TotalPropertyExp">$1,000</h2>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-9">
                           <div class="analyser-submit-section">
                              <div class="btn-div text-left pt-4">
                                 <ul class="list-inline">
                                    <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fa fa-chevron-left"></i> Loan & Purchase costs</a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-3">
                           <div class="analyser-submit-section">
                              <div class="btn-div text-right pt-4">
                                 <ul class="list-inline">
                                    <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Tax & Market <i class="fa fa-chevron-right"></i></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
                  <!-- End Rent & Expenses -->
                  <!-- Tax & MArket -->
                  <h3>Tax & Market</h3>
                  <section>
                     <!-- ASSIGN AN ENTITY -->
                     <div class="card my-4">
                        <div class="card-header">
                           <div class="card-title">ASSIGN AN ENTITY</div>
                        </div>
                        <div class="card-body">
                           <div class="row">
                              <!-- his property belong to entity -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3">
                                 <div class="select-box">
                                    <div class="form-group">
                                       <label>This property belong to entity</label>
                                       <div class="select-group">
                                          <select class="select-css" name="ae_property_belong" id="ae_property_belong" >
                                             <option>Property Ownership</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- end his property belong to entity-->
                              <!-- Entity rows-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Entity owns</label>
                                    <input class="touchspin1" type="text" value="<?php echo $ae_entity_rows; ?>" name="ae_entity_rows" id="ae_entity_rows" >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $ae_entity_rows; ?>" id="ae_entity_rowsRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Entity rows-->
                              <!-- Entity Selected-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1">
                                 <div class="entity-wrapper">
                                    <h3>Entity Selected</h3>
                                    <p>Personal Ownership <a href="#">(view)</a></p>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNewEntity">Create a new</button>
                                 </div>
                              </div>
                              <!-- end Entity Selected-->
                           </div>
                        </div>
                     </div>
                     <!-- end ASSIGN AN ENTITY -->
                     <!-- MARKET FACTORS -->
                     <div class="card mb-4">
                        <div class="card-header">
                           <div class="card-title">MARKET FACTORS</div>
                        </div>
                        <div class="card-body">
                           <div class="row">
                              <!-- Entity rows-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                 <div class="form-group">
                                    <label>Consumer price index (%)*</label>
                                    <input class="touchspin1" type="text" value="<?php echo $mf_customer_price_index; ?>" name="mf_customer_price_index" id="mf_customer_price_index" >
                                    <div class="range-container">
                                       <input type="range" min="0" max="100" step="1" value="<?php echo $mf_customer_price_index; ?>" id="mf_customer_price_indexRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Entity rows-->
                              <!-- Entity rows-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Capital growth(%)*</label>
                                    <input class="touchspin1" type="text" value="<?php echo $mf_capital_growth; ?>" name="mf_capital_growth" id="mf_capital_growth" >
                                    <div class="range-container">
                                       <input type="range" min="0" max="100" step="1" value="<?php echo $mf_capital_growth; ?>" id="mf_capital_growthRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Entity rows-->
                              <!-- Land Tax-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Land tax ($)</label>
                                    <input class="touchspin1" type="text" value="<?php echo $mf_land_tax; ?>" name="mf_land_tax" id="mf_land_tax" >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $mf_land_tax; ?>" id="mf_land_taxRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Land Tax-->
                           </div>
                        </div>
                     </div>
                     <!-- end MARKET FACTORS -->
                     <!-- DEPRECIATION ESTIMATION -->
                     <div class="card mb-4">
                        <div class="card-header">
                           <div class="card-title">DEPRECIATION ESTIMATION</div>
                        </div>
                        <div class="card-body">
                           <div class="row">
                              <div class="col-12">
                                 <div class="i-checks">
                                    <label><input type="radio" <?php if($de_calculate_depreciation=="cd"){?> Checked <?php }?>  value="cd" name="de_calculate_depreciation" id="de_calculate_depreciation" checked> Calculate depreciation</label>
                                 </div>
                              </div>
                              <!-- Construction year-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                 <div class="form-group">
                                    <label>Construction year completed*</label>
                                    <input class="touchspin1" type="text" value="<?php echo $de_construction_year_completed; ?>" name="de_construction_year_completed" id="de_construction_year_completed" >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $de_construction_year_completed; ?>" id="de_construction_year_completedRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Construction year-->
                              <!-- Recent renovation-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="select-box">
                                    <div class="form-group">
                                       <label>Recent renovations</label>
                                       <div class="select-group">
                                          <select class="select-css">
                                             <option>None</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- end Recent renovation-->
                              <!-- Construction year-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Your estimate of land value($)</label>
                                    <input class="touchspin1" type="text" value="<?php echo $de_estimate_land_value; ?>" name="de_estimate_land_value" id="de_estimate_land_value" >
                                    <div class="range-container">
                                       <input type="range" min="0" max="10000" step="1" value="<?php echo $de_estimate_land_value; ?>" id="de_estimate_land_valueRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Construction year-->
                              <div class="col-4">
                                 <div class="seagars-logo">
                                    <h4>Powered by</h4>
                                    <img src="<?php echo SITE_BASE_URL; ?>assets/img/seagars-logo.png" class="img-fluid">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end DEPRECIATION ESTIMATION  -->
                     <div class="card final-card bg-b1">
                        <div class="row ">
                           <div class="col text-left align-self-center">
                              <div class="text-wrapper">
                                 <h2>Total annual property expenses</h2>
                              </div>
                           </div>
                           <div class="col text-center align-self-center">
                              <div class="text-wrapper">
                                 <!-- <h2>Costs: $182,000</h2> -->
                              </div>
                           </div>
                           <div class="col text-right align-self-center">
                              <div class="text-wrapper">
                                 <h2>$1,000</h2>
                              </div>
                           </div>
                        </div>
                     </div>
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
                                          <input type="range" min="0" max="10000" step="1" value="<?php echo $loan_value_ratio_growth; ?>" id="loan_value_ratio_growthRange">
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
            
            console.log('datavalues='+datavalues);
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
    
    /*
    
    $(document).ready(function(){
        
            CalcLoanPurchaseCost();
        
    });
    */
    
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
            
            
            AmountPercentType               = $("[name='property_purchase_value_price']:checked").val();
            
            if (AmountPercentType == "ratepercentage"){
                DepositAmount       = Math.round( parseFloat(PurchaseAmount) * parseFloat(DepositAmount) / 100 ); 
            }
            
            //console.log("loan_purchase_deposit=" + loan_purchase_deposit +",loan_purchase_deposit=" + loan_purchase_deposit +",loan_purchase_deposit=" + loan_purchase_deposit)
            
            
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
            
             console.log('AmountPercentType='+AmountPercentType);
            
            if (AmountPercentType == "ratepercentage"){
                LoanPurchaseDepositTemp       = Math.round( parseFloat(loan_purchase_amount) * parseFloat(loan_purchase_deposit) / 100 ); 
                //alert()
            }
            else{
                LoanPurchaseDepositTemp = loan_purchase_deposit;
            }
            
            
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
         max: 1000000000000000000,
         boostat: 5,
         maxboostedstep: 10,
         // prefix: '$',
         buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
         buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
   });
   $(".touchspin4").TouchSpin({
         min: 0,
         max: 100,
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
     verticalbuttons: true,
     buttondown_class: 'btn-spinner btn-spinner-down',
     buttonup_class: 'btn-spinner btn-spinner-up'
   });
   
   
   
   

   
  $(document).ready(function () {
  
    
    	/*----------------------------------------*/
    //var depositValue = $('#depositRange');
    //$("#loan_purchase_deposit").val($("#loan_purchase_depositRange").val());
	// Read value on change
	//$("#loan_purchase_deposit").val($("#loan_purchase_depositRange").val());
	var depositValue = $('#loan_purchase_depositRange');
    $("#loan_purchase_deposit").val($("#loan_purchase_depositRange").val());
    $("#loan_purchase_depositRange").mousemove(function (event) {
      $("#loan_purchase_deposit").val($(this).val());
    });

    //Market Value
	var mrktValValue = $('#loan_purchase_market_valueRange');
    $("#loan_purchase_market_value").val($("#loan_purchase_market_valueRange").val());
    $("#loan_purchase_market_valueRange").mousemove(function (event) {
      $("#loan_purchase_market_value").val($(this).val());

    });

    //Purchase Amount
	var loan_purchase_amountValue = $('#loan_purchase_amountRange');
    $("#loan_purchase_amount").val($("#loan_purchase_amountRange").val());
    $("#loan_purchase_amountRange").mousemove(function (event) {
      $("#loan_purchase_amount").val($(this).val());

    });
	
	/*---------------------------------------- */
	
	//Capital improvement at purchase($)
    $("#other_exp_capitalRange").mousemove(function (event) {
      $("#other_exp_capital").val($(this).val());

    });
	

    // slicitor_costRange
    $("#other_exp_slicitor_costRange").mousemove(function (event) {
      $("#other_exp_slicitor_cost").val($(this).val());

    });
	
	
	//Other($)
    $("#other_exp_otherRange").mousemove(function (event) {
      $("#other_exp_other").val($(this).val());

    });
	
	
	//Amount of loan ($)*

    $("#loan_amount_loanRange").mousemove(function (event) {
      $("#loan_amount_loan").val($(this).val());

    });
	
	
	//Establishment fee ($)*
    $("#loan_esatblishment_feeRange").mousemove(function (event) {
      $("#loan_esatblishment_fee").val($(this).val());

    });
	
	//Interest rate (%)
    $("#loan_interset_rateRange").mousemove(function (event) {
      $("#loan_interset_rate").val($(this).val());
    });
	
	//loan_other_loan_costs
    $("#loan_other_loan_costsRange").mousemove(function (event) {
      $("#loan_other_loan_costs").val($(this).val());

    });
	
	//loan_valuation_fees
    $("#loan_valuation_feesRange").mousemove(function (event) {
      $("#loan_valuation_fees").val($(this).val());
    });
	
	
	//arr_annual_rr
    $("#arr_annual_rrRange").mousemove(function (event) {
      $("#arr_annual_rr").val($(this).val());
    });
	
	//arr_weekly_rents
    $("#arr_weekly_rentsRange").mousemove(function (event) {
      $("#arr_weekly_rents").val($(this).val());
    });
	

	//ape_rates
    $("#ape_ratesRange").mousemove(function (event) {
      $("#ape_rates").val($(this).val());
    });
	
	//ape_body_corporate
    $("#ape_body_corporateRange").mousemove(function (event) {
      $("#ape_body_corporate").val($(this).val());
    });
	
	//ape_land_lease_fee
    $("#ape_land_lease_feeRange").mousemove(function (event) {
      $("#ape_land_lease_fee").val($(this).val());
    });
	
	//ape_insurance
    $("#ape_insuranceRange").mousemove(function (event) {
      $("#ape_insurance").val($(this).val());

    });
	
	//ape_letting_fees
    $("#ape_letting_feesRange").mousemove(function (event) {
      $("#ape_letting_fees").val($(this).val());

    });
	
	//ape_management_fees
    $("#ape_management_feesRange").mousemove(function (event) {
      $("#ape_management_fees").val($(this).val());

    });
	
	//ape_repairs_maitenance
    $("#ape_repairs_maitenanceRange").mousemove(function (event) {
      $("#ape_repairs_maitenance").val($(this).val());

    });
	
	//ape_gardening
    $("#ape_gardeningRange").mousemove(function (event) {
      $("#ape_gardening").val($(this).val());

    });
	
	
	//ape_cleaning
    $("#ape_cleaningRange").mousemove(function (event) {
      $("#ape_cleaning").val($(this).val());

    });
	
	//ape_service_contract
    $("#ape_service_contractRange").mousemove(function (event) {
      $("#ape_service_contract").val($(this).val());

    });
	
	
	//ape_other
    $("#ape_otherRange").mousemove(function (event) {
      $("#ape_other").val($(this).val());

    });
	
		//ape_other
    $("#ae_entity_rowsRange").mousemove(function (event) {
      $("#ae_entity_rows").val($(this).val());

    });
	
		//mf_customer_price_index
    $("#mf_customer_price_indexRange").mousemove(function (event) {
      $("#mf_customer_price_index").val($(this).val());

    });
	
	
		//mf_capital_growth
    $("#mf_capital_growthRange").mousemove(function (event) {
      $("#mf_capital_growth").val($(this).val());

    });
	
		//mf_land_tax
    $("#mf_land_taxRange").mousemove(function (event) {
      $("#mf_land_tax").val($(this).val());

    });
	
	
		//de_construction_year_completed
    $("#de_construction_year_completedRange").mousemove(function (event) {
      $("#de_construction_year_completed").val($(this).val());

    });
		//de_estimate_land_value
    $("#de_estimate_land_valueRange").mousemove(function (event) {
      $("#de_estimate_land_value").val($(this).val());

    });
		//loan_value_ratio_growth
    $("#loan_value_ratio_growthRange").mousemove(function (event) {
      $("#loan_value_ratio_growth").val($(this).val());

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
   
   });
   
   
   
   
</script>
