<?php include "header.php"; ?>
<!-- main content -->
<div class="content">

<?php
$ProprtyId = $_REQUEST["id"];

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
	$loan_purchase_deposit   			= isset($_REQUEST["loan_purchase_deposit"]) ? $_REQUEST["loan_purchase_deposit"] : "";
	$loan_purchase_market_value   		= isset($_REQUEST["loan_purchase_market_value"]) ? $_REQUEST["loan_purchase_market_value"] : "";
	$loan_purchase_amount   			= isset($_REQUEST["loan_purchase_amount"]) ? $_REQUEST["loan_purchase_amount"] : "";
	$other_exp_capital   				= isset($_REQUEST["other_exp_capital"]) ? $_REQUEST["other_exp_capital"] : "";
	$other_exp_slicitor_cost   			= isset($_REQUEST["other_exp_slicitor_cost"]) ? $_REQUEST["other_exp_slicitor_cost"] : "";
	$other_exp_stamping_cost   			= isset($_REQUEST["other_exp_stamping_cost"]) ? $_REQUEST["other_exp_stamping_cost"] : "";
	$other_exp_other   					= isset($_REQUEST["other_exp_other"]) ? $_REQUEST["other_exp_other"] : "";
	$arr_rental_type   					= isset($_REQUEST["arr_rental_type"]) ? $_REQUEST["arr_rental_type"] : "";
	$arr_annual_rr   					= isset($_REQUEST["arr_annual_rr"]) ? $_REQUEST["arr_annual_rr"] : "";
	$arr_weekly_rents   				= isset($_REQUEST["arr_weekly_rents"]) ? $_REQUEST["arr_weekly_rents"] : "";
	$arr_total_annual_rent   			= isset($_REQUEST["arr_total_annual_rent"]) ? $_REQUEST["arr_total_annual_rent"] : "";
	$ape_Pricipal_interest   			= isset($_REQUEST["ape_Pricipal_interest"]) ? $_REQUEST["ape_Pricipal_interest"] : "";
	$ape_rates   						= isset($_REQUEST["ape_rates"]) ? $_REQUEST["ape_rates"] : "";
	$ape_body_corporate   				= isset($_REQUEST["ape_body_corporate"]) ? $_REQUEST["ape_body_corporate"] : "";
	$ape_land_lease_fee   				= isset($_REQUEST["ape_land_lease_fee"]) ? $_REQUEST["ape_land_lease_fee"] : "";
	$ape_insurance   					= isset($_REQUEST["ape_insurance"]) ? $_REQUEST["ape_insurance"] : "";
	$ape_letting_fees   				= isset($_REQUEST["ape_letting_fees"]) ? $_REQUEST["ape_letting_fees"] : "";
	$ape_management_fees   				= isset($_REQUEST["ape_management_fees"]) ? $_REQUEST["ape_management_fees"] : "";
	$ape_repairs_maitenance   			= isset($_REQUEST["ape_repairs_maitenance"]) ? $_REQUEST["ape_repairs_maitenance"] : "";
	$ape_gardening   					= isset($_REQUEST["ape_gardening"]) ? $_REQUEST["ape_gardening"] : "";
	$ape_service_contract   			= isset($_REQUEST["ape_service_contract"]) ? $_REQUEST["ape_service_contract"] : "";
	$ape_other   						= isset($_REQUEST["ape_other"]) ? $_REQUEST["ape_other"] : "";
	$ae_property_belong   				= isset($_REQUEST["ae_property_belong"]) ? $_REQUEST["ae_property_belong"] : "";
	$ae_entity_rows   					= isset($_REQUEST["ae_entity_rows"]) ? $_REQUEST["ae_entity_rows"] : "";
	$mf_customer_price_index   			= isset($_REQUEST["mf_customer_price_index"]) ? $_REQUEST["mf_customer_price_index"] : "";
	$mf_capital_growth   				= isset($_REQUEST["mf_capital_growth"]) ? $_REQUEST["mf_capital_growth"] : "";
	$mf_land_tax  						= isset($_REQUEST["mf_land_tax"]) ? $_REQUEST["mf_land_tax"] : "";
	$de_calculate_depreciation   		= isset($_REQUEST["de_calculate_depreciation"]) ? $_REQUEST["de_calculate_depreciation"] : "";
	$de_construction_year_completed   	= isset($_REQUEST["de_construction_year_completed"]) ? $_REQUEST["de_construction_year_completed"] : "";
	$de_recent_renovations   			= isset($_REQUEST["de_recent_renovations"]) ? $_REQUEST["de_recent_renovations"] : "";
	$de_estimate_land_value   			= isset($_REQUEST["de_estimate_land_value"]) ? $_REQUEST["de_estimate_land_value"] : "";
	$loan_value_ratio_growth   			= isset($_REQUEST["loan_value_ratio_growth"]) ? $_REQUEST["loan_value_ratio_growth"] : "";
	$ape_cleaning   					= isset($_REQUEST["ape_cleaning"]) ? $_REQUEST["ape_cleaning"] : "";
	$loan_pricipal_interest   			= isset($_REQUEST["loan_pricipal_interest"]) ? $_REQUEST["loan_pricipal_interest"] : "";
	$loan_length_year   				= isset($_REQUEST["loan_length_year"]) ? $_REQUEST["loan_length_year"] : "";
	$loan_length_month   				= isset($_REQUEST["loan_length_month"]) ? $_REQUEST["loan_length_month"] : "";
	$loan_esatblishment_fee   			= isset($_REQUEST["loan_esatblishment_fee"]) ? $_REQUEST["loan_esatblishment_fee"] : "";
	$loan_amount_loan   				= isset($_REQUEST["loan_amount_loan"]) ? $_REQUEST["loan_amount_loan"] : "";
	$loan_interset_rate   				= isset($_REQUEST["loan_interset_rate"]) ? $_REQUEST["loan_interset_rate"] : "";
	$loan_other_loan_costs   			= isset($_REQUEST["loan_other_loan_costs"]) ? $_REQUEST["loan_other_loan_costs"] : "";
	$loan_valuation_fees   				= isset($_REQUEST["loan_valuation_fees"]) ? $_REQUEST["loan_valuation_fees"] : "";
	
	
$GetDbVals = \Property\PropertyClass::GetDBValues($ProprtyId,$user_id);
foreach ($GetDbVals as $GetDbVal) 
{
	
	$property_purchase_value_price   	= $GetDbVal["property_purchase_value_price"];
	$loan_purchase_deposit   			= $GetDbVal["loan_purchase_deposit"];
	$loan_purchase_market_value   		= $GetDbVal["loan_purchase_market_value"];
	$loan_purchase_amount   			= $GetDbVal["loan_purchase_amount"] ;
	$other_exp_capital   				= $GetDbVal["other_exp_capital"];
	$other_exp_slicitor_cost   			= $GetDbVal["other_exp_slicitor_cost"];
	$other_exp_stamping_cost   			= $GetDbVal["other_exp_stamping_cost"];
	$other_exp_other   					= $GetDbVal["other_exp_other"];
	$arr_rental_type   					= $GetDbVal["arr_rental_type"];
	$arr_annual_rr   					= $GetDbVal["arr_annual_rr"];
	$arr_weekly_rents   				= $GetDbVal["arr_weekly_rents"] ;
	$arr_total_annual_rent   			= $GetDbVal["arr_total_annual_rent"];
	$ape_Pricipal_interest   			= $GetDbVal["ape_Pricipal_interest"];
	$ape_rates   						= $GetDbVal["ape_rates"];
	$ape_body_corporate   				= $GetDbVal["ape_body_corporate"];
	$ape_land_lease_fee   				= $GetDbVal["ape_land_lease_fee"];
	$ape_insurance   					= $GetDbVal["ape_insurance"];
	$ape_letting_fees   				= $GetDbVal["ape_letting_fees"];
	$ape_management_fees   				= $GetDbVal["ape_management_fees"];
	$ape_repairs_maitenance   			= $GetDbVal["ape_repairs_maitenance"];
	$ape_gardening   					= $GetDbVal["ape_gardening"];
	$ape_service_contract   			= $GetDbVal["ape_service_contract"];
	$ape_other   						= $GetDbVal["ape_other"];
	$ae_property_belong   				= $GetDbVal["ae_property_belong"];
	$ae_entity_rows   					= $GetDbVal["ae_entity_rows"];
	$mf_customer_price_index   			= $GetDbVal["mf_customer_price_index"];
	$mf_capital_growth   				= $GetDbVal["mf_capital_growth"];
	$mf_land_tax  						= $GetDbVal["mf_land_tax"];
	$de_calculate_depreciation   		= $GetDbVal["de_calculate_depreciation"];
	$de_construction_year_completed   	= $GetDbVal["de_construction_year_completed"];
	$de_recent_renovations   			= $GetDbVal["de_recent_renovations"];
	$de_estimate_land_value   			= $GetDbVal["de_estimate_land_value"];
	$loan_value_ratio_growth   			= $GetDbVal["loan_value_ratio_growth"];
	
}


$GetDbDtlVals = \Property\PropertyClass::GetDBDtlValues($property_master_auto_id);
foreach ($GetDbDtlVals as $GetDbDtlVal) 
{
	$loan_pricipal_interest   			= $GetDbDtlVal["loan_pricipal_interest"];
	$loan_length_year   				= $GetDbDtlVal["loan_length_year"];
	$loan_length_month   				= $GetDbDtlVal["loan_length_month"];
	$loan_esatblishment_fee   			= $GetDbDtlVal["loan_esatblishment_fee"];
	$loan_amount_loan   				= $GetDbDtlVal["loan_amount_loan"];
	$loan_interset_rate   				= $GetDbDtlVal["loan_interset_rate"];
	$loan_other_loan_costs   			= $GetDbDtlVal["loan_other_loan_costs"];
	$loan_valuation_fees   				= $GetDbDtlVal["loan_valuation_fees"];
	
}


//Get Default Values 

if (!isset($loan_purchase_amount))
    $loan_purchase_amount               = "";

if (!isset($loan_purchase_deposit))
    $loan_purchase_deposit              = "";



if ($loan_purchase_amount == ""){
    $loan_purchase_amount               = "10000";
}


if ($loan_purchase_deposit == ""){
    $loan_purchase_deposit              = "10";
}


$rows = \Property\PropertyClass::GetPropertiesDatas($ProprtyId,'');
$i = 1;
foreach ($rows as $row) 
{
?>
<section class="mt-5">
   <div class="card">
      <div class="card-body">
         <div class="row">
            <!-- property overview -->
            <div class="col-9">
               <div class="title-area">
                  <h2 class="heading-primary"><?php echo $row["property_address"]; ?> | <?php echo $row["country_code"]; ?></h2>
               </div>
               <div class="row">
                  <div class="col-12 col-xxl-12">
                     <ul class="list-inline facility-card-list">
                        <li class="list-inline-item">
                           <div class="card facility-card">
                              <div class="card-body">
                                 <div class="row no-gutters">
                                    <div class="col-7 facility-left-col">
                                       <div class="facility-icon">
                                          <img src="<?php echo SITE_BASE_URL;?>assets/img/parking-icon.png" class="img-fluid">
                                       </div>
                                       <span class="facility-text">
                                       PARKING
                                       </span>
                                    </div>
                                    <div class="col-5 facility-right-col parking-bg">
                                       <div class="facility-quantity"><?php echo $row["no_of_parkingspace"]; ?></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </li>
                        <li class="list-inline-item">
                           <div class="card facility-card">
                              <div class="card-body">
                                 <div class="row no-gutters">
                                    <div class="col-7 facility-left-col">
                                       <div class="facility-icon">
                                          <img src="<?php echo SITE_BASE_URL;?>assets/img/bedroom-icon.png" class="img-fluid">
                                       </div>
                                       <span class="facility-text">
                                       ROOM
                                       </span>
                                    </div>
                                    <div class="col-5 facility-right-col room-bg">
                                       <div class="facility-quantity"><?php echo $row["no_of_bedrooms"]; ?></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </li>
                        <li class="list-inline-item">
                           <div class="card facility-card">
                              <div class="card-body">
                                 <div class="row no-gutters">
                                    <div class="col-7 facility-left-col">
                                       <div class="facility-icon">
                                          <img src="<?php echo SITE_BASE_URL;?>assets/img/bathroom-icon.png" class="img-fluid">
                                       </div>
                                       <span class="facility-text">
                                       ROOM
                                       </span>
                                    </div>
                                    <div class="col-5 facility-right-col bathroom-bg">
                                       <div class="facility-quantity"><?php echo $row["no_of_bathroom"]; ?></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </div>
                  <div class="col-8 mt-3">
                     <div class="">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>OVERVIEW</th>
                              <th>Year 1</th>
                              <th>Year 3</th>
                              <th>Year 5</th>
                              <th>Year 10</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Cash flow p/a (pre-tax)</td>
                              <td class="text-warning">($6,268)</td>
                              <td class="text-warning">($4,777)</td>
                              <td class="text-warning">($3,196)</td>
                              <td>$1,192</td>
                           </tr>
                           <tr>
                              <td>Cash flow p/a (after-tax)</td>
                              <td class="text-warning">($6,268)</td>
                              <td class="text-warning">($4,777)</td>
                              <td class="text-warning">($3,196)</td>
                              <td>$1,192</td>
                           </tr>
                           <tr>
                              <td>Gross yield</td>
                              <td>5.04%</td>
                              <td>5.35%</td>
                              <td>5.67%</td>
                              <td>6.58%</td>
                           </tr>
                           <tr>
                              <td>Net yield</td>
                              <td>3.59%</td>
                              <td>3.81%</td>
                              <td>4.05%</td>
                              <td>4.69%</td>
                           </tr>
                           <tr>
                              <td>Total returns (cash & growth)</td>
                              <td>$34,531</td>
                              <td>$113,309</td>
                              <td>$206,217</td>
                              <td>$510,925</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  </div>
               </div>
            </div>
            <!-- end property overview-->
            <!-- rating and preview -->
            <div class="col-3 rating-col">
               <div class="ratingcol-inner">
                  <div class="preview-box">
                     <div class="preview-img">
                        <img src="<?php echo SITE_BASE_URL;?>assets/img/<?php echo $row["property_image"]; ?>" class="img-fluid preview-img-thumb">
                        <a class="preview-link" data-fancybox="gallery" href="<?php echo SITE_BASE_URL;?>assets/img/moratge-thumb.jpg"><img src="<?php echo SITE_BASE_URL;?>assets/img/expand.png" class="img-fluid"></a>
                        <a class="preview-link" data-fancybox="gallery" href="<?php echo SITE_BASE_URL;?>assets/img/moratge-thumb002.jpg"><img src="<?php echo SITE_BASE_URL;?>assets/img/expand.png" class="img-fluid"></a>
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
            </div>
            <!-- end rating and preview -->
         </div>
      </div>
   </div>
</section>

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
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-4 mb-3">
                                       <div class="i-checks ">
                                          <label class="PropertyPurhaseValDiv"><input type="radio" value="rateamount" name="property_purchase_value_price" id="property_purchase_value_price" onclick="OnClickRadio(this);" > Enter as $ value</label>
                                       </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                       <div class="i-checks ">
                                          <label class="PropertyPurhaseValDiv"><input type="radio" value="ratepercentage" name="property_purchase_value_price" id="property_purchase_value_percent" checked onclick="OnClickRadio(this);" > Enter as % of property purchase price</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <!-- deposit percentage-->
                                    <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                       <div class="form-group">
                                          <label>Deposit(%) *</label>
                                          <div class="input-icon">
                                             <input class="touchspin3" type="text" value="10" name="loan_purchase_deposit" id="loan_purchase_deposit" calc="loan_purchase_cost">
                                             
                                             <input type="hidden" name="LoanPurchaseDepositTemp" id="LoanPurchaseDepositTemp" value=""  min="5" />
                                          </div>
                                          <div class="range-container">
                                             <input type="range" min="1" max="100" step="1" value="10" id="depositRange">
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end deposit percentage-->
                                    <!-- market value-->
                                    <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                       <div class="form-group">
                                          <label>Market Value($)</label>
                                          <input class="touchspin3" type="text" value="680000" name="loan_purchase_market_value-value" id="loan_purchase_market_value" calc="loan_purchase_cost">
                                          <div class="range-container">
                                             <input type="range" min="1" max="100000" step="10" value="" id="mrktValRange">
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end market value-->
                                    <!-- purchase amount-->
                                    <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                       <div class="form-group">
                                          <label>Purchase amount($)</label>
                                          <input class="touchspin3" type="text" value="680000" name="loan_purchase_amount" id="loan_purchase_amount" calc="loan_purchase_cost">
                                          <div class="range-container">
                                             <input type="range" min="100" max="1000000" step="1" value="" id="prchsAmntRange">
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
                                          <input class="touchspin3" type="text" value="0" name="other_exp_capital" id="other_exp_capital" calc="loan_purchase_cost">
                                          <div class="range-container">
                                             <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end capital improvement-->
                                    <!-- solicitor cost-->
                                    <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                       <div class="form-group">
                                          <label>Solicitor’s cost ($)*</label>
                                          <input class="touchspin3" type="text" value="1000" name="other_exp_slicitor_cost" id="other_exp_slicitor_cost" calc="loan_purchase_cost">
                                          <div class="range-container">
                                             <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end solicitor cost-->
                                    <!-- stamping fee-->
                                    <!-- <div class="col-4 range-form-group">
                                       <div class="form-group">
                                          <label>Stamping fee($)</label>
                                          <input class="touchspin3" type="text" value="" name="other_exp_stamping_cost" id="other_exp_stamping_cost" >
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
                                          <input class="touchspin3" type="text" value="0" name="other_exp_other" id="other_exp_other" calc="loan_purchase_cost">
                                          <div class="range-container">
                                             <input type="range" min="1" max="100" step="1" value="15" id="customRange">
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
                                    <li><a class="active" href="#contact_01" data-toggle="tab">Loan 1</a>
                                    </li>
                                    <li><a href="#" class="add-contact"><i class="fas fa-plus-circle"></i></a>
                                    </li>
                                 </ul>
                              </div>
                              <div class="card-body">
                                 <div class="tab-content">
                                    <div class="tab-pane active" id="contact_01">
                                       <div class="" id="anaBody">
                                          <div class="row">
                                             <div class="col-4 mb-3">
                                                <div class="i-checks">
                                                   <label><input type="radio" value="io" name="loan_pricipal_interest  " id="loan_pricipal_interest  " checked calc="loan_purchase_cost"> Interest Only</label>
                                                </div>
                                             </div>
                                             <div class="col-6 mb-3">
                                                <div class="i-checks">
                                                   <label><input type="radio" value="pi" name="loan_pricipal_interest  " id="loan_pricipal_interest  " calc="loan_purchase_cost"> Principal & interest</label>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <!-- loan length -->
                                             <div class="col-12 col-md-4 col-lg-4 col-xxl-4 range-form-group">
                                                <div class="form-group">
                                                   <label>Loan length*</label>
                                                   <div class="row">
                                                      <div class="col-9">
                                                         <input class="touchspin3" type="text" value="30" name="loan_length_year" id="loan_length_year" calc="loan_purchase_cost"> 
                                                      </div>
                                                      <label class="col-form-label col-3">years &</label>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-9">
                                                         <input class="touchspin3" type="text" value="0" name="loan_length_month" id="loan_length_month" calc="loan_purchase_cost">
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
                                                   <input class="touchspin3" type="text" value="614000" name="loan_amount_loan" id="loan_amount_loan" >
                                                   <div class="range-container">
                                                      <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end amount of loan-->
                                             <!-- Establishment fee -->
                                             <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                                <div class="form-group">
                                                   <label>Establishment fee ($)*</label>
                                                   <input class="touchspin3" type="text" value="500" name="loan_esatblishment_fee" id="loan_esatblishment_fee" calc="loan_purchase_cost" >
                                                   <div class="range-container">
                                                      <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end Establishment fee-->
                                             <!-- interest rate -->
                                             <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                                <div class="form-group">
                                                   <label>Interest rate (%)*</label>
                                                   <input class="touchspin3" type="text" value="5" name="loan_interset_rate" id="loan_interset_rate" calc="loan_purchase_cost">
                                                   <div class="range-container">
                                                      <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end intrerest rate-->
                                             <!-- other -->
                                             <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                                <div class="form-group">
                                                   <label>Other loan costs ($)</label>
                                                   <input class="touchspin3" type="text" value="0" name="loan_other_loan_costs" id="loan_other_loan_costs" calc="loan_purchase_cost">
                                                   <div class="range-container">
                                                      <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- end other-->
                                             <!-- other -->
                                             <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                                <div class="form-group">
                                                   <label>Valuation fees ($)</label>
                                                   <input class="touchspin3" type="text" value="500" name="loan_valuation_fees" id="loan_valuation_fees" calc="loan_purchase_cost">
                                                   <div class="range-container">
                                                      <input type="range" min="1" max="100" step="1" value="15" id="customRange">
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
                                       <h2 id="TotalCostsH2Text">Costs: $682,000</h2>
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
                                 <a id="right" class="btn btn-outline-dark" href="#next">Rent & Expense <i class="fas fa-chevron-right"></i></a>
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
                        <div class="card-body">
                           <div class="row">
                              <div class="col-2">
                                 <label>Rental Type:</label>
                              </div>
                              <div class="col-4 mb-3">
                                 <div class="i-checks">
                                    <label><input type="radio" value="longterm" name="arr_rental_type" id="arr_rental_type"  checked> Resident long term</label>
                                 </div>
                              </div>
                              <div class="col-4 mb-3">
                                 <div class="i-checks">
                                    <label><input type="radio" value="holidayrental" name="arr_rental_type" id="arr_rental_type" > Holiday rental</label>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <!-- deposit percentage-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                 <div class="form-group">
                                    <label>Rate of occupancy (wks)</label>
                                    <div class="input-icon">
                                       <input class="touchspin3" type="text" value="52" name="arr_annual_rr" id="arr_annual_rr">
                                    </div>
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="depositRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end deposit percentage-->
                              <!-- market value-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Weekly rents($)</label>
                                    <input class="touchspin3" type="text" value="660" name="arr_weekly_rents" id="arr_weekly_rents" >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
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
                                    <input class="touchspin3" type="text" value="2550" name="ape_rates" id="ape_rates" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end capital improvement-->
                              <!-- solicitor cost-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Body corporate($) *</label>
                                    <input class="touchspin3" type="text" value="2500" name="ape_body_corporate" id="ape_body_corporate" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end solicitor cost-->
                              <!-- stamping fee-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Land lease fee($)*</label>
                                    <input class="touchspin3" type="text" value="0" name="ape_land_lease_fee" id="ape_land_lease_fee" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end stamping fee-->
                              <!-- other -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                 <div class="form-group">
                                    <label>Insurance ($) *</label>
                                    <input class="touchspin3" type="text" value="0" name="ape_insurance" id="ape_insurance" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end other-->
                              <!-- Letting fees($)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Letting fees($)*</label>
                                    <input class="touchspin3" type="text" value="0" name="ape_letting_fees" id="ape_letting_fees" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Letting fees($)*-->
                              <!-- Management fees(%)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Management fees(%)*</label>
                                    <input class="touchspin3" type="text" value="9" name="ape_management_fees" id="ape_management_fees" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Management fees(%)*-->
                              <!-- Repairs/maintenance($)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                 <div class="form-group">
                                    <label>Repairs/maintenance($)*</label>
                                    <input class="touchspin3" type="text" value="1700" name="ape_repairs_maitenance" id="ape_repairs_maitenance" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Repairs/maintenance($)*-->
                              <!-- Gardening($)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Gardening($)*</label>
                                    <input class="touchspin3" type="text" value="0" name="ape_gardening" id="ape_gardening" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Gardening($)*-->
                              <!-- Cleaning($)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Cleaning($)*</label>
                                    <input class="touchspin3" type="text" value="0" name="ape_cleaning" id="ape_cleaning" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Cleaning($)*-->
                              <!-- Service contract($)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                 <div class="form-group">
                                    <label>Service contract($)*</label>
                                    <input class="touchspin3" type="text" value="0" name="ape_service_contract" id="ape_service_contract" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Service contract($)*-->
                              <!-- Other($)* -->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Other($)*</label>
                                    <input class="touchspin3" type="text" value="0" name="ape_other" id="ape_other" calc='AnnualPropertyExpense' >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
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
                                    <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fas fa-chevron-left"></i> Loan & Purchase costs</a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-3">
                           <div class="analyser-submit-section">
                              <div class="btn-div text-right pt-4">
                                 <ul class="list-inline">
                                    <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Tax & Market <i class="fas fa-chevron-right"></i></a></li>
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
                                    <input class="touchspin3" type="text" value="100" name="ae_entity_rows" id="ae_entity_rows" >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
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
                                    <input class="touchspin3" type="text" value="3" name="mf_customer_price_index" id="mf_customer_price_index" >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Entity rows-->
                              <!-- Entity rows-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Capital growth(%)*</label>
                                    <input class="touchspin3" type="text" value="6" name="mf_capital_growth" id="mf_capital_growth" >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
                                    </div>
                                 </div>
                              </div>
                              <!-- end Entity rows-->
                              <!-- Land Tax-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 offset-xxl-1 range-form-group">
                                 <div class="form-group">
                                    <label>Land tax ($)</label>
                                    <input class="touchspin3" type="text" value="0" name="mf_land_tax" id="mf_land_tax" >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="0" id="customRange">
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
                                    <label><input type="radio" value="cd" name="de_calculate_depreciation" id="de_calculate_depreciation" checked> Calculate depreciation</label>
                                 </div>
                              </div>
                              <!-- Construction year-->
                              <div class="col-12 col-md-4 col-lg-4 col-xxl-3 range-form-group">
                                 <div class="form-group">
                                    <label>Construction year completed*</label>
                                    <input class="touchspin3" type="text" value="2020" name="de_construction_year_completed" id="de_construction_year_completed" >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
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
                                    <input class="touchspin3" type="text" value="255000" name="de_estimate_land_value" id="de_estimate_land_value" >
                                    <div class="range-container">
                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
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
                                    <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fas fa-chevron-left"></i> Rent & Expense</a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-3">
                           <div class="analyser-submit-section">
                              <div class="btn-div text-right pt-4">
                                 <ul class="list-inline">
                                    <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next"> Result <i class="fas fa-chevron-right"></i></a></li>
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
                                          <input class="touchspin3" type="text" value="<?php echo $loan_value_ratio_growth; ?>" name="loan_value_ratio_growth" id="loan_value_ratio_growth">
                                       </div>
                                       <div class="range-container">
                                          <input type="range" min="1" max="100" step="1" value="15" id="depositRange">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-6 col-xxl-6 equal-h-card px-0 bg-white">
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
                        <div class="col-12">
                           <div class="table-wrapper">
                              <div class="card">
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
                                    <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Graph <i class="fas fa-chevron-right"></i></a></li>
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
<?php 
    $i++;
} ?>

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
    
    $(window).on("load", function (e) {
        //alert()
        //CalcLoanPurchaseCost();
    });
    
    $(document).ready(function(){
        
        
        $('#property_purchase_value_price').on('ifChecked', function(event){
  			//alert(this.value);
  			OnClickRadio(this);
		});

		$('#property_purchase_value_percent').on('ifChecked', function(event){
  			//alert(this.value);
  			OnClickRadio(this);
		});
		
        
        $(document).on("click", ".PropertyPurhaseValDiv", function(){
            alert();
        });
        
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
        
        $(document).on("blur", "#arr_weekly_rents,#arr_annual_rr", function(){
            arr_weekly_rents = FnNulltoAmt( $("#arr_weekly_rents").val() ); 
            arr_annual_rr = FnNulltoAmt( $("#arr_annual_rr").val() ); 
            
            //$("#arr_annual_rr").val(AnnualRent);
            
            AnnualRent = parseFloat(arr_weekly_rents) * parseFloat(arr_annual_rr);
            
            $("#TotalAnnualRentSpan").text("$" + AnnualRent);
        });
        
        
        $(document).on("blur", "#loan_amount_loan,#loan_purchase_deposit", function(){
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
            DepositAmt = FnNulltoAmt( $("#loan_purchase_deposit").val() );
            
            
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
            
            
            
            //ratepercentage, rateamount
            
            
            //property_purchase_value_percent
            
            //alert(loan_purchase_deposit)
            //loan_purchase_market_value		= FnNulltoAmt( $("#loan_purchase_market_value-value").val() );
            loan_purchase_amount			= FnNulltoAmt( $("#loan_purchase_amount").val() );
            
            
            AmountPercentType               = $("[name='property_purchase_value_price']:checked").val();
            
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
