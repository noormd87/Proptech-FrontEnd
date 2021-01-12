<?php include"header.php"; ?>

<?php


$ProprtyId 			= $_REQUEST["property_id"] ? $_REQUEST["property_id"] : "";
$action 			= $_REQUEST["buttonaction"] ? $_REQUEST["buttonaction"] : "";


\Portfolio\PortfolioClass::Init();

$user_id   = \settings\session\sessionClass::GetSessionDisplayName();


//$SearchBtn      = \Property\PropertyClass::$SearchBtn; Rent Per Year 
$LocationId     = \Property\PropertyClass::$LocationId;
$Subrub         = \Property\PropertyClass::$Subrub;

$ChkCntArr               			= \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(property_master_auto_id) AS property_master_auto_id FROM my_portfolio_property_hdr WHERE `user_id` ='" .$user_id. "' AND PROPERTY_ID='" .$ProprtyId. "')");
$ChkValue             				= $ChkCntArr["0"];


    $myportfoliocountry   	            = isset($_REQUEST["myportfoliocountry"]) ?      $_REQUEST["myportfoliocountry"] : "1";
    $MyPortfolioPropAddress   	        = isset($_REQUEST["MyPortfolioPropAddress"]) ?  $_REQUEST["MyPortfolioPropAddress"] : "";
    $no_of_parkingspace					= isset($_REQUEST["no_of_parkingspace"]) ?      $_REQUEST["no_of_parkingspace"] : "0";
	$no_of_bedrooms						= isset($_REQUEST["no_of_bedrooms"]) ?          $_REQUEST["no_of_bedrooms"] : "0";
	$no_of_bathroom						= isset($_REQUEST["no_of_bathroom"]) ?          $_REQUEST["no_of_bathroom"] : "0";
	$MyPortfolioPropertyType			= isset($_REQUEST["MyPortfolioPropertyType"]) ? $_REQUEST["MyPortfolioPropertyType"] : "";


	$MyPortfolioLandArea		    	= isset($_REQUEST["MyPortfolioLandArea"]) ?   $_REQUEST["MyPortfolioLandArea"] : "";
    $Managementfee                      = isset($_REQUEST["Managementfee"]) ?         $_REQUEST["Managementfee"] : "0";
    $Adminstrationfee                   = isset($_REQUEST["Adminstrationfee"]) ?      $_REQUEST["Adminstrationfee"] : "0";
    $PropertyMaintenance                = isset($_REQUEST["PropertyMaintenance"]) ?   $_REQUEST["PropertyMaintenance"] : "0";
    $Ratesvalue                         = isset($_REQUEST["Ratesvalue"]) ?            $_REQUEST["Ratesvalue"] : "0";
    $BodyCorporatefee                   = isset($_REQUEST["BodyCorporatefee"]) ?      $_REQUEST["BodyCorporatefee"] : "0";
    $PropertyValueCurrent               = isset($_REQUEST["PropertyValueCurrent"]) ?  $_REQUEST["PropertyValueCurrent"] : "0";
    $Rentperweek                        = isset($_REQUEST["Rentperweek"]) ?          $_REQUEST["Rentperweek"] : "0";
    $Imagefile                          = isset($_REQUEST["Imagefile"]) ?             $_REQUEST["Imagefile"] : "";
    $UploadedImagefile                  = isset($_REQUEST["UploadedImagefile"]) ?     $_REQUEST["UploadedImagefile"] : "";
    
    $YearlyRentalGrowth                 = isset($_REQUEST["YearlyRentalGrowth"]) ?     $_REQUEST["YearlyRentalGrowth"] : "0";
    $CapitalGrowth                      = isset($_REQUEST["CapitalGrowth"]) ?     $_REQUEST["CapitalGrowth"] : "0";
     
    $myportfolioCurrency                = isset($_REQUEST["myportfolioCurrency"]) ? $_REQUEST["myportfolioCurrency"] : "";
    $MyPortFolioName                    = isset($_REQUEST["MyPortFolioName"]) ? $_REQUEST["MyPortFolioName"] : "";
    $DateBought                         = isset($_REQUEST["DateBought"]) ?  $_REQUEST["DateBought"] : "";
    $DateCompletion                     = isset($_REQUEST["DateCompletion"]) ?  $_REQUEST["DateCompletion"] : "";
    $UnitNumber                         = isset($_REQUEST["UnitNumber"]) ?  $_REQUEST["UnitNumber"] : "";
    
    $PricePaid                          = isset($_REQUEST["PricePaid"]) ?  $_REQUEST["PricePaid"] : "";
    $CurrentValue                       = isset($_REQUEST["CurrentValue"]) ?  $_REQUEST["CurrentValue"] : "";
    $GroundRent                         = isset($_REQUEST["GroundRent"]) ?  $_REQUEST["GroundRent"] : "";
    $OtherCosts                         = isset($_REQUEST["OtherCosts"]) ?  $_REQUEST["OtherCosts"] : "";
    
                           



  if ( $action == "Edit" ) {
        
       // echo 'ProprtyId=' .$ProprtyId. "<br>" ;
        // echo 'user_id=' .$user_id. "<br>" ;
     
    
        $GetDbVals = \Portfolio\PortfolioClass::GetDBValues($ProprtyId,$user_id);
    	foreach ($GetDbVals as $GetDbVal) 
    	{
    	       
    		$property_master_auto_id   			= $GetDbVal["property_master_auto_id"];
    
        	$myportfoliocountry   	            = $GetDbVal["country_code"] ?           $GetDbVal["country_code"] : "";
            $MyPortfolioPropAddress   	        = $GetDbVal["myportfolio_propaddr"] ?   $GetDbVal["myportfolio_propaddr"] : "";
            $no_of_parkingspace					= $GetDbVal["myportfolio_parkingspace"] ? $GetDbVal["myportfolio_parkingspace"] : "0";
        	$no_of_bedrooms						= $_REQUEST["myportfolio_bedrooms"] ? $GetDbVal["myportfolio_bedrooms"] : "0";
        	$no_of_bathroom						= $GetDbVal["myportfolio_bathroom"] ? $GetDbVal["myportfolio_bathroom"] : "0";
        	$MyPortfolioPropertyType			= $GetDbVal["myportfolio_proptype"] ? $GetDbVal["myportfolio_proptype"] : "";
        	 
    
        	$MyPortfolioLandArea		    	= $GetDbVal["myportfolio_land_area"] ? $GetDbVal["myportfolio_land_area"] : "0";   
            $Managementfee                      = $GetDbVal["management_fee"] ? $GetDbVal["management_fee"] : "0";   
            $Adminstrationfee                   = $GetDbVal["adminstration_fee"] ? $GetDbVal["adminstration_fee"] : "0";  
            $PropertyMaintenance                = $GetDbVal["property_maintenance"] ? $GetDbVal["property_maintenance"] : "0";  
            $Ratesvalue                         = $GetDbVal["rates_value"] ? $GetDbVal["rates_value"] : "0"; 
            $BodyCorporatefee                   = $GetDbVal["body_corporate_fee"] ? $GetDbVal["body_corporate_fee"] : "0";  
            $PropertyValueCurrent               = $GetDbVal["property_value_current"] ? $GetDbVal["property_value_current"] : "0"; 
            $Rentperweek                        = $GetDbVal["rent_perweek"] ? $GetDbVal["rent_perweek"] : "0";  
            $UploadedImagefile                  = $GetDbVal["image_file"] ?  $GetDbVal["image_file"] : "notupload"; 
            
            $LocationId                        = $GetDbVal["location_id"] ? $GetDbVal["location_id"] : "";  
            $Subrub                            = $GetDbVal["location_name"] ?  $GetDbVal["location_name"] : ""; 
            
            $CapitalGrowth                      = $GetDbVal["est_portfolio_growth"] ?  $GetDbVal["est_portfolio_growth"] : ""; 
            $YearlyRentalGrowth                 = $GetDbVal["est_rental_growth"] ?  $GetDbVal["est_rental_growth"] : ""; 
            
            $myportfolioCurrency                = $GetDbVal["myportfolio_Currency"] ?  $GetDbVal["myportfolio_Currency"] : "";
            $MyPortFolioName                    = $GetDbVal["myportfolio_propname"] ?  $GetDbVal["myportfolio_propname"] : "";
            $DateBought                         = $GetDbVal["purschase_date"] ?  $GetDbVal["purschase_date"] : "";
            $DateCompletion                     = $GetDbVal["completion_date"] ?  $GetDbVal["completion_date"] : "";
            $UnitNumber                         = $GetDbVal["Unit_Number"] ?  $GetDbVal["Unit_Number"] : "";
            
            $PricePaid                          = $GetDbVal["Price_Paid"] ?  $GetDbVal["Price_Paid"] : "";
            $CurrentValue                       = $GetDbVal["Current_Value"] ?  $GetDbVal["Current_Value"] : "";
            $GroundRent                         = $GetDbVal["Ground_Rent"] ?  $GetDbVal["Ground_Rent"] : "";
            $OtherCosts                         = $GetDbVal["Other_Costs"] ?  $GetDbVal["Other_Costs"] : "";
            
            
            
    	}
	
  }

 
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			
				<form class="dpo-form"  action="<?php echo SITE_BASE_URL;?>/Portfolio/PortfolioPropertysave.html?buttonaction=<?php echo $action;?>&property_id=<?php echo $ProprtyId;?>&Mode=upload" method="post" enctype="multipart/form-data"  onsubmit="return validateForm()" >
	                <div id="saveProperty">
	               	  <!-- summary -->
	               	  <h3>Summary</h3>
	               	  <section>
	               	  	<div class="row">
	               	  		<div class="col-12">
	               	  			<div class="card">
	               	  				<div class="card-body">
		               	  				<div class="row">
				               	  			<div class="col-md-4">
				               	  				<div class="form-group">
				               	  					<label>Country</label>
					               	  				<select class="form-control" name="myportfoliocountry" id="myportfoliocountry" >
					               	  				     <?php
                                                            \Portfolio\PortfolioClass::Init();
                                                            $rows = \Portfolio\PortfolioClass::GetCountryData();
                                                            foreach ($rows as $row) 
                                                            {
                                                            ?>
                                                            <option value="<?php echo $row["COUNTRY_CODE"]; ?>"  <?php if( $myportfoliocountry == $row["COUNTRY_CODE"] ) {?>   selected <?php } ?>  > <?php echo $row["COUNTRY_NAME"]; ?> </option>
                                                            <?php
                                                            }
                                                            
                                                            ?>
					               	  					
					               	  				
					               	  				</select>
				               	  				</div>
				               	  			</div>
				               	  			<div class="col-md-4">
				               	  				<div class="form-group">
				               	  					<label>Property Name</label>
				               	  					<input class="form-control" type="text" name="MyPortFolioName" id ="MyPortFolioName" value="<?php echo $MyPortFolioName; ?>" >
				               	  				</div>
				               	  			</div>
				               	  			<div class="col-md-4">
				               	  				<div class="form-group">
				               	  					<label>Property Address</label>
				               	  					<input class="form-control" type="text" name="MyPortfolioPropAddress" id ="MyPortfolioPropAddress" value="<?php echo $MyPortfolioPropAddress; ?>" >
				               	  				</div>
				               	  			</div>
				               	  		</div>
				               	  		<div class="row"> 
				               	  		    <div class="col-md-3">
				               	  				<div class="form-group">
				               	  					<label>Currency</label>
					               	  				<select class="form-control" name="myportfolioCurrency" id="myportfolioCurrency" >
					               	  				     <?php
                                                            \Portfolio\PortfolioClass::Init();
                                                            $rows = \Portfolio\PortfolioClass::GetCountryData();
                                                            foreach ($rows as $row) 
                                                            {
                                                            ?>
                                                            <option value="<?php echo $row["CURRENCY"]; ?>"  <?php if( $myportfolioCurrency == $row["CURRENCY"] ) {?>   selected <?php } ?>  > <?php echo $row["CURRENCY"]; ?> </option>
                                                            <?php
                                                            }
                                                            
                                                            ?>
					               	  					
					               	  				
					               	  				</select>
				               	  				</div>
				               	  			</div>
				               	  			<div class="col-3">
				               	  				<div class="form-group">
				               	  					<label>Unit Number</label>
				               	  					<input class="form-control" type="text" name="UnitNumber" id ="UnitNumber" value="<?php echo $UnitNumber; ?>" >
				               	  				</div>
				               	  			</div>
				               	  			<div class="col-3">
				               	  				<div class="form-group">
				               	  					<label>Date Bought</label>
				               	  					<input class="form-control date_picker" type="text" placeholder="dd/mm/yy" autocomplete='off' name="DateBought" id ="DateBought" value="<?php echo $DateBought; ?>" >
				               	  				
				               	  				</div>
				               	  			</div>
				               	  			<div class="col-3">
				               	  				<div class="form-group">
				               	  					<label>Date of Completion</label>
				               	  					 <div class="input-group">
                                                        <input type="text" name="DateCompletion" id="DateCompletion"  placeholder="dd/mm/yy" autocomplete='off'  class="form-control date_picker" value="<?php echo $DateCompletion; ?>">
                                                    </div>
				               	  				</div>
				               	  			</div>
				               	  		</div>
				               	  		<div class="row"> 
				               	  			<div class="col-3">
				               	  				<div class="form-group">
				               	  					<label>Property Type</label>
				               	  					<input class="form-control" type="text" name="MyPortfolioPropertyType" id ="MyPortfolioPropertyType" value="<?php echo $MyPortfolioPropertyType; ?>" >
				               	  				</div>
				               	  			</div>
				               	  			<div class="col-3">
				               	  				<div class="form-group">
				               	  					<label>Land area (m²)</label>
				               	  					<input class="form-control" type="text" name="MyPortfolioLandArea" id ="MyPortfolioLandArea" value="<?php echo $MyPortfolioLandArea; ?>" >
				               	  				</div>
				               	  			</div>
				               	  			<div class="col">
				               	  				<label>&nbsp;</label>
				               	  				<div class="input-group mb-3">
												    <div class="input-group-prepend">
												      <span class="input-group-text"><i class="fa fa-bed"></i></span>
												    </div>
												    <input type="number" class="form-control" name="no_of_bedrooms" id ="no_of_bedrooms" value="<?php echo $no_of_bedrooms; ?>"  >
												</div>
				               	  			</div>
				               	  			<div class="col">
				               	  				<label>&nbsp;</label>
				               	  				<div class="input-group mb-3">
												    <div class="input-group-prepend">
												      <span class="input-group-text"><i class="fa fa-bath"></i></span>
												    </div>
												    <input type="number" class="form-control" name="no_of_bathroom" id ="no_of_bathroom" value="<?php echo $no_of_bathroom; ?>"  >
												</div>
				               	  			</div>
				               	  			<div class="col">
				               	  				<label>&nbsp;</label>
				               	  				<div class="input-group mb-3">
												    <div class="input-group-prepend">
												      <span class="input-group-text"><i class="fa fa-car"></i></span>
												    </div>
												    <input type="number" class="form-control" name="no_of_parkingspace" id ="no_of_parkingspace" value="<?php echo $no_of_parkingspace; ?>"  >
												</div>
				               	  			</div>
				               	  		</div>
				               	  		
				               	  		
				               	  		<div class="row"> 
				               	  			<div class="col-3">
				               	  				<div class="form-group">
				               	  					<label>Price Paid</label>
				               	  					<input class="form-control" type="text" name="PricePaid" id ="PricePaid" value="<?php echo $PricePaid; ?>" > 
				               	  				</div>
				               	  			</div>
				               	  			<div class="col-3">
				               	  				<div class="form-group">
				               	  					<label>Current Value</label>
				               	  					<input class="form-control" type="text" name="CurrentValue" id ="CurrentValue" value="<?php echo $CurrentValue; ?>" >
				               	  				</div>
				               	  			</div>
				               	  			<div class="col-3">
				               	  				<div class="form-group">
				               	  					<label>Ground Rent</label>
				               	  					<input class="form-control" type="text" name="GroundRent" id ="GroundRent" value="<?php echo $GroundRent; ?>" >
				               	  				</div>
				               	  			</div>
				               	  			<div class="col-3">
				               	  				<div class="form-group">
				               	  					<label>Other Costs</label>
				               	  					<input class="form-control" type="text" name="OtherCosts" id ="OtherCosts" value="<?php echo $OtherCosts; ?>" >
				               	  				</div>
				               	  			</div>
				               	  		</div>
				               	  		
				               	  		
				               	  		
				               	  		
				               	  		
				               	  		
				               	  		
				               	  		<div class="row"> 
				               	  			<div class="col-3">
				               	  				<div class="form-group">
				               	  					<label>Location</label>
				               	  					  <input class="form-control" type="text" name="Subrub" id="Suburb" placeholder="Suburb" value="<?php echo $Subrub;?>" />
                                                      <input class="form-control" type="hidden" name="LocationId" id="LocationId" placeholder="LocationId" value="<?php echo $LocationId;?>" >
				               	  				</div>
				               	  			</div>
				               	  			
				               	  			<!-- purchase details-->
    	                   
    	                                   
    	                               
    	                                    
    	                                    <!-- Management Fee -->
    	                                    <div class="col-12 col-md-4 col-lg-4 range-form-group">
    	                                       <div class="form-group">
    	                                          <label>Management Fee's  %</label>
    												<input class="form-control" type="text" value="<?php echo $Managementfee; ?>" name="Managementfee" id="Managementfee"  calc='TotalExpense'  >
    	                                       </div>
    	                                    </div>
    	                                    
    	                                     <div class="col-12 col-md-4 col-lg-4"> 
				               	  				<div class="form-group">
				               	  					<label>Management Fee's per Year <span id='MangmentFeeSymbol'>$</span> </label>
				               	  					<input class="form-control" type="text" name="TotalManagementFee" id ="TotalManagementFee"  readonly calc='TotalExpense' >
				               	  				</div>
				               	  			</div>
				               	  			
    	                                    <!-- end market value-->
    	                                    
    	                                    <!-- Adminstration fee -->
    	                                    <div class="col-12 col-md-4 col-lg-4 range-form-group">
    	                                       <div class="form-group">
    	                                          <label> Adminstration fee Year <span id='AdminstrationSymbol'>$</span></label>
    												<input class="form-control" type="text" value="<?php echo $Adminstrationfee; ?>" name="Adminstrationfee" id="Adminstrationfee"  calc='TotalExpense' >
    	                                       </div>
    	                                    </div>
    	                                    <!-- end Adminstration fee-->
    	                                    
    	                                    <!-- Property Maintenance  -->
    	                                    <div class="col-12 col-md-4 col-lg-4 range-form-group">
    	                                       <div class="form-group">
    	                                          <label>Property Maintenance </label>
    												<input class="form-control" type="text" value="<?php echo $PropertyMaintenance; ?>" name="PropertyMaintenance" id="PropertyMaintenance"  calc='TotalExpense' >
    	                                       </div>
    	                                    </div>
    	                                    <!-- end Property Maintenance --> 
    	                                    
    	                                   
    	                                    <!-- Rates $ value -->
    	                                    <div class="col-12 col-md-4 col-lg-4 range-form-group">
    	                                       <div class="form-group">
    	                                          <label>Rates <span id='RatesSymbol'>$</span> value</label>
    												<input class="form-control" type="text" value="<?php echo $Ratesvalue; ?>" name="Ratesvalue" id="Ratesvalue"  calc='TotalExpense' >
    	                                       </div>
    	                                    </div>
    	                                    <!-- end Rates $ value--> 
    	                                    
    	                                     
    	                                    <!-- Body Corporate fee $ Value -->
    	                                    <div class="col-12 col-md-4 col-lg-4 range-form-group">
    	                                       <div class="form-group">
    	                                          <label>Body Corporate fee <span id='BodyCorporateSymbol'>$</span> Value</label>
    												<input class="form-control" type="text" value="<?php echo $BodyCorporatefee; ?>" name="BodyCorporatefee" id="BodyCorporatefee"  calc='TotalExpense' >
    	                                       </div>
    	                                    </div>
    	                                    <!-- end Body Corporate fee $ Value -->
    	                                    
    	                                    
    	                                    <!-- Property Value $$ (current) -->
    	                                    <div class="col-12 col-md-4 col-lg-4 range-form-group">
    	                                       <div class="form-group">
    	                                          <label>Property Value <span id='PropertySymbol'>$</span></label>
    												<input class="form-control" type="text" value="<?php echo $PropertyValueCurrent; ?>" name="PropertyValueCurrent" id="PropertyValueCurrent" calc='TotalExpense' >
    	                                       </div>
    	                                    </div>
    	                                    <!-- end Property Value $$ (current) --> 
    	                                    
    	                                    <!-- Rent per week $$ (current) -->
    	                                    <div class="col-12 col-md-4 col-lg-4 range-form-group">
    	                                       <div class="form-group">
    	                                          <label>Rent per week <span id='RentPerWeekSymbol'>$</span> (current)</label>
    												<input class="form-control" type="text" value="<?php echo $Rentperweek; ?>" name="Rentperweek" id="Rentperweek"  >
    	                                       </div>
    	                                    </div>
    	                                    
    	                                    
    	                                     <div class="col-12 col-md-4 col-lg-4">
				               	  				<div class="form-group">
				               	  					<label>Rent Per Year <span id='RentPerYearSymbol'>$</span> </label>
				               	  					<input class="form-control" type="text" name="TotalRentperweek" id ="TotalRentperweek"  readonly >
				               	  				</div>
				               	  			</div>
				               	  			
    	                                    <!-- end Rent per week $$ (current) --> 
    	                                    
    	                                   <!-- 5-10 Yr Capital Growth -->
    	                                    <div class="col-12 col-md-4 col-lg-4 range-form-group">
    	                                       <div class="form-group">
    	                                          <label>5-10 Yr Capital Growth</label>
    												<input class="form-control" type="text" value="<?php echo $CapitalGrowth; ?>" name="CapitalGrowth" id="CapitalGrowth"  >
    	                                       </div>
    	                                    </div>
    	                                    <!-- 5-10 Yr Capital Growth -->    
    	                                    
    	                                    
    	                                      <!-- Yearly rental growth -->
    	                                    <div class="col-12 col-md-4 col-lg-4 range-form-group">
    	                                       <div class="form-group">
    	                                          <label>Yearly rental growth</label>
    												<input class="form-control" type="text" value="<?php echo $YearlyRentalGrowth; ?>" name="YearlyRentalGrowth" id="YearlyRentalGrowth"  >
    	                                       </div>
    	                                    </div>
    	                                   
    	                                    
    	                                    <!-- Yearly rental growth -->  
    	                                     <div class="col-12 col-md-4 col-lg-4">
				               	  				<div class="form-group">
				               	  					<label>Total Expense <span id='TotalExpenseSymbol'>$</span> </label>
				               	  					<input class="form-control" type="text" name="TotalExpense" id ="TotalExpense"  readonly >
				               	  				</div>
				               	  			</div>
    	                                    
    	                                    
    	                                    
    	                                   	<div class="col-lg-4 col-md-5 col-sm-12 col-12">
                                				<div class="form-group">
                                					<label><b>image</b></label>
                                                    <input type="file" class="form-control mandate" name="UploadFile" id="UploadFile" Maxlength=200  value="<?php echo $UploadFile; ?>" ><span id='fp'></span>
                                                    
                                                    <?php
                                                    if ( $UploadedImagefile != "notupload" ){
                                                        
                                                    ?>
                                                     <a href='<?php SITE_BASE_URL ."uploads/portfolioimage/" .$imagefile; ?>'><?php echo $UploadedImagefile;?></a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <input type='hidden' name="UploadedImagefile" id="UploadedImagefile"  value="<?php echo $UploadedImagefile; ?>" >
                                                    
                                				</div>
                                			</div>
                                			
                                			
                                            <div class="col-9">
                                               <div class="analyser-submit-section">
                                                  <div class="btn-div text-left pt-4">
                                                     <ul class="list-inline">									
                                                        <li class="list-inline-item"> <button class="btn btn-outline-dark" type="submit">Add to saved</button></li>
                                                         <input type='hidden' name="ButtonAction" id="ButtonAction"  value="<?php echo $action; ?>" >
                                                         <input type='hidden' name="PercentageYeildRo" id="PercentageYeildRo"   >
                                                        
                                                        
                                                        
                                                  </div>
                                               </div>
                                            </div>
                	                                    
    	                                    
    	                                   
    	                          
    	                           <!-- end purchase details-->
				               	  			
                                          
                                          
                                          
                                            
                                            
                                            
				               	  		</div>
				               	  		
				               	  		
		               	  			</div>
	               	  			</div>
	               	  		</div>
	               	  	</div>
	               	  </section>
	               	  <!-- end summary -->	
	                  
	               </div>
	            </form>
			</div>
		</div>
	</div>
</div>

<!-- end row -->

<script>
        var FnNulltoAmt = function(Value){
            if (isNaN(parseFloat(Value)))
                Value = 0;
                
            return Value;
        };
    
       $(document).on("blur", "#PropertyValueCurrent", function(){
           CalcManagementfeeFn();
            FnCalcYeildRo();
          
       });
       
        $(document).on("blur", "#Rentperweek", function(){
            
            CalcRentPerWeekFn();
             FnCalcYeildRo();
            
               
        });
        
          $(document).on("blur", "#Managementfee", function(){
            
            CalcManagementfeeFn();
             FnCalcYeildRo();
            
               
        });
        
        
         $(document).on("blur", "[calc='TotalExpense']", function(){
            
            FnCalcTotalExpense();
             FnCalcYeildRo();
        });
        
           
     
           
           
      var CalcRentPerWeekFn = function(){
          
           RentPerWeek = FnNulltoAmt( $("#Rentperweek").val());
             
           TotRentPerWeek  = parseFloat(RentPerWeek) * 52;
             
            $("#TotalRentperweek").val(Math.round(TotRentPerWeek));
            
            CalcManagementfeeFn();
        
     };
     
     var CalcManagementfeeFn = function(){
         
          TotRentPerWeek        = FnNulltoAmt( $("#TotalRentperweek").val());
          Managementfee         = FnNulltoAmt( $("#Managementfee").val());
          
          Managementfeetemp      = parseFloat(Managementfee) / 100;
          
          
          TotalManagementFee    = parseFloat(TotRentPerWeek) * parseFloat(Managementfeetemp);

         $("#TotalManagementFee").val(Math.round(TotalManagementFee));
         
     };
     
     
     var FnCalcTotalExpense = function(){
         
          TotalManagementFee        = FnNulltoAmt( $("#TotalManagementFee").val());
          Adminstrationfee          = FnNulltoAmt( $("#Adminstrationfee").val());
          PropertyMaintenance       = FnNulltoAmt( $("#PropertyMaintenance").val());
          Ratesvalue                = FnNulltoAmt( $("#Ratesvalue").val());
          BodyCorporatefee          = FnNulltoAmt( $("#BodyCorporatefee").val());
         
        
         TotalExpense               = parseFloat(TotalManagementFee) + parseFloat(Adminstrationfee) + parseFloat(PropertyMaintenance) + parseFloat(Ratesvalue) + parseFloat(BodyCorporatefee);
         
         $("#TotalExpense").val(Math.round(TotalExpense));
     };
     
     
    var FnCalcYeildRo = function(){
        
    
         TotalRentperweek        = FnNulltoAmt( $("#TotalRentperweek").val());
         PropertyValueCurrent    = FnNulltoAmt( $("#PropertyValueCurrent").val());
         TotalExpense            = FnNulltoAmt( $("#TotalExpense").val());
         
         //console.log('TotalRentperweek='+TotalRentperweek)
        // console.log('PropertyValueCurrent='+PropertyValueCurrent)
         //console.log('TotalExpense='+TotalExpense)
         
    
         YeildRo = parseFloat(( parseFloat(TotalRentperweek) - parseFloat(TotalExpense) ) /  parseFloat(PropertyValueCurrent),2) * 100
         
         PercentageYeildRo = Math.round(YeildRo)
          $("#PercentageYeildRo").val(Math.round(PercentageYeildRo));
         
         // console.log('YeildRo='+Math.round(YeildRo))
         
     };
       
    
     
   
     

</script>

<?php include"footer.php"; ?>


<!--  jquery steps -->
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/jquery-steps/jquery-steps.min.js"></script>
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/bootstrap-touchpin/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/bootstrap-touchpin/bootstrap-touchpin-init.js"></script>
<script src="<?php echo SITE_BASE_URL; ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  // --------------------------------------
  //analyser section
  //---------------------------------------
  /*
  $("#saveProperty").steps({
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
        max: 10000,
        boostat: 5,
        maxboostedstep: 10,
        // prefix: '$',
        buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
        buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
  });
  
  
  $(".touchspin3").TouchSpin({
        min: 0,
        max: 1000000,
        boostat: 5,
        maxboostedstep: 10,
        // prefix: '$',
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
 
 
 

  
  $(document).ready(function () {
  
    
    //ManagementfeeRange
    $("#ManagementfeeRange").mousemove(function (event) {
      $("#Managementfee").val($(this).val());

    });
    
    $('#Managementfee').on('change', function(){
        $('#ManagementfeeRange').val($('#Managementfee').val());
    });
    
    $('#Managementfee').on('keyup', function(){
        $('#ManagementfeeRange').val($('#Managementfee').val());
    });
	
	//Adminstrationfee
   
    $("#AdminstrationfeeRange").mousemove(function (event) {
      $("#Adminstrationfee").val($(this).val());

    });
    
    $('#Adminstrationfee').on('change', function(){
        $('#AdminstrationfeeRange').val($('#Adminstrationfee').val());
    });
    
    $('#Adminstrationfee').on('keyup', function(){
        $('#AdminstrationfeeRange').val($('#Adminstrationfee').val());
    });
	
   
     //PropertyMaintenance
   
   
    $("#PropertyMaintenanceRange").mousemove(function (event) {
      $("#PropertyMaintenance").val($(this).val());

    });
    
    $('#PropertyMaintenance').on('change', function(){
        $('#PropertyMaintenanceRange').val($('#PropertyMaintenance').val());
    });
    
    $('#PropertyMaintenance').on('keyup', function(){
        $('#PropertyMaintenanceRange').val($('#PropertyMaintenance').val());
    });
	
	//Ratesvalue
	
     $("#RatesvalueRange").mousemove(function (event) {
      $("#Ratesvalue").val($(this).val());

    });
    
    $('#Ratesvalue').on('change', function(){
        $('#RatesvalueRange').val($('#Ratesvalue').val());
    });
    
    $('#Ratesvalue').on('keyup', function(){
        $('#RatesvalueRange').val($('#Ratesvalue').val());
    });
   
   
   //BodyCorporatefee
   
     $("#BodyCorporatefeeRange").mousemove(function (event) {
      $("#BodyCorporatefee").val($(this).val());

    });
    
    $('#BodyCorporatefee').on('change', function(){
        $('#BodyCorporatefeeRange').val($('#BodyCorporatefee').val());
    });
    
    $('#BodyCorporatefee').on('keyup', function(){
        $('#BodyCorporatefeeRange').val($('#BodyCorporatefee').val());
    });
   
   //PropertyValueCurrent
   
   $("#PropertyValueCurrentRange").mousemove(function (event) {
      $("#PropertyValueCurrent").val($(this).val());

    });
    
    $('#PropertyValueCurrent').on('change', function(){
        $('#PropertyValueCurrentRange').val($('#PropertyValueCurrent').val());
    });
    
    $('#PropertyValueCurrent').on('keyup', function(){
        $('#PropertyValueCurrentRange').val($('#PropertyValueCurrent').val());
    });
   
   //Rentperweek 
     $("#RentperweekRange").mousemove(function (event) {
      $("#Rentperweek").val($(this).val());

    });
    
    $('#Rentperweek').on('change', function(){
        $('#RentperweekRange').val($('#Rentperweek').val());
    });
    
    $('#Rentperweek').on('keyup', function(){
        $('#RentperweekRange').val($('#Rentperweek').val());
    });
   
   
   
      //CapitalGrowth 
     $("#CapitalGrowthRange").mousemove(function (event) {
      $("#CapitalGrowth").val($(this).val());

    });
    
    $('#CapitalGrowth').on('change', function(){
        $('#CapitalGrowthRange').val($('#CapitalGrowth').val());
    });
    
    $('#CapitalGrowth').on('keyup', function(){
        $('#CapitalGrowthRange').val($('#CapitalGrowth').val());
    });
   
   
   //YearlyRentalGrowthRange
   
     $("#YearlyRentalGrowthRange").mousemove(function (event) {
      $("#YearlyRentalGrowth").val($(this).val());

    });
    
    $('#YearlyRentalGrowth').on('change', function(){
        $('#YearlyRentalGrowthRange').val($('#YearlyRentalGrowth').val());
    });
    
    $('#YearlyRentalGrowth').on('keyup', function(){
        $('#YearlyRentalGrowthRange').val($('#YearlyRentalGrowth').val());
    });
    
    $('#myportfolioCurrency').on('change', function(){
        CurrencyValidationFn();
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
   
   
   
   
     var ActionVal =   $("#ButtonAction").val();
     
     if ( ActionVal == "Edit") {
         
         CalcManagementfeeFn();
         CalcRentPerWeekFn();
         CalcManagementfeeFn();
         FnCalcTotalExpense();
         FnCalcYeildRo();
         
     }
   
   
   
   
   
   
   
   });
   
   */
   
   
    function validateForm() {
        
        
        var MyPortFolioName         =  $("#MyPortFolioName").val();
        var DateBought              =  $("#DateBought").val();
        var DateCompletion          =  $("#DateCompletion").val();
        var PricePaid               =  $("#PricePaid").val();
        var CurrentValue            =  $("#CurrentValue").val();
        var GroundRent              =  $("#GroundRent").val();
        var Rentperweek             =  $("#Rentperweek").val();
        var PropertyValueCurrent    =  $("#PropertyValueCurrent").val();
        
        
        if (MyPortFolioName == "" ){
            
            alert("Please Fill Property Name");
            $("#MyPortFolioName").focus();
            return false;
            
        }
        
        if (DateBought == "" ){
            
            alert("Please Fill Date Bought");
            $("#DateBought").focus();
            return false;
            
        }
        
        if (DateCompletion == "" ){
            
            alert("Please Fill Date Completion");
             $("#DateCompletion").focus();
            return false;
            
        }
        
        if (PricePaid == "" ){
            
            alert("Please Fill Price Paid");
             $("#PricePaid").focus();
            return false;
            
        }
        
        if (CurrentValue == "" ){
            
            alert("Please Fill Current Value");
             $("#CurrentValue").focus();
            return false;
            
        }
        
        if (GroundRent == "" ){
            
            alert("Please Fill Ground Rent");
             $("#GroundRent").focus();
            return false;
            
        }
        
        if (Rentperweek == "" ){
            
            alert("Please Fill Rent Per Week");
             $("#Rentperweek").focus();
            return false;
            
        }
        
        if (PropertyValueCurrent == "" ){
            
            alert("Please Fill Property Value");
             $("#PropertyValueCurrent").focus();
            return false;
            
        }
        
        
        
        
        
        
        
        
        var fuData = document.getElementById('UploadFile');
        var FileUploadPath = fuData.value;

        //To check if user upload any file
        if (FileUploadPath == '') {
            //alert("Please upload an image");

        } 
        else 
        {
            var oFile = document.getElementById("UploadFile").files[0]; // <input type="file" id="fileUpload" accept=".jpg,.png,.gif,.jpeg"/>

            if (oFile.size > 2097152) // 2 mb for bytes.
            {
                alert("File size must under 2mb!");
                return;
            }
            
            var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
        
            //The file uploaded is an image
            
            if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
        
                // To Display
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fuData.files[0]);
                }
        
            } 
                    //The file upload is NOT an image
            else {
                alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
                    
            }
        }
        
        
         
    }
   
   
  $(document).ready(function(){
   
   $(".date_picker").datepicker({
   
       dateFormat: 'dd/mm/yy',
   
       //defaultDate: '+1w',
   
       changeMonth: false,
   
       numberOfMonths: 1,
   
       showOn: 'both'
   
   });
   

   });


  var CurrencyValidationFn = function(){
         
            console.log('myportfoliocountry='+ $("#myportfoliocountry").val() );
             console.log('myportfolioCurrency='+ $("#myportfolioCurrency").val() );
             
            var CurrencySymbol = "$";
             
            var myportfoliocountry =  $("#myportfoliocountry").val();
            var myportfolioCurrency =  $("#myportfolioCurrency").val();
            
            
            if (myportfolioCurrency == "NZD"  ){
                
                CurrencySymbol = "$";
                
            }else if(myportfolioCurrency == "GBP"  ){
                
                CurrencySymbol = "£";
                
            }else if(myportfolioCurrency == "AUD"  ){
                
                CurrencySymbol = "$";
            }
            
            
            
            $("#MangmentFeeSymbol").html(CurrencySymbol);
            $("#AdminstrationSymbol").html(CurrencySymbol);
            $("#RatesSymbol").html(CurrencySymbol);
            $("#BodyCorporateSymbol").html(CurrencySymbol);
            $("#PropertySymbol").html(CurrencySymbol);
            $("#RentPerWeekSymbol").html(CurrencySymbol);
            $("#RentPerYearSymbol").html(CurrencySymbol);
            $("#TotalExpenseSymbol").html(CurrencySymbol);
            
            
            /*
            
            var testdata = {
                "CountryCode"           :  $("#myportfoliocountry").val() ,
                "Currency"              :  $("#myportfolioCurrency").val()
            };
     
             $.ajax({               
                        url: "https://duvalknowledge.com/PropTech/Portfolio/GetCurrencySymbol.html",
                         type: "POST",
                         dataType : "json",
                         data:testdata,
                        success : function(data){
                             //console.log(data.length);
                            $.each(data, function(index, value){  
                               
                              // console.log('CurrencySymbol='+ value.CurrencySymbol);
                               
                                $("#MangmentFeeSymbol").html(value.CurrencySymbol);
                                $("#AdminstrationSymbol").html(value.CurrencySymbol);
                                $("#RatesSymbol").html(value.CurrencySymbol);
                                $("#BodyCorporateSymbol").html(value.CurrencySymbol);
                                $("#PropertySymbol").html(value.CurrencySymbol);
                                $("#RentPerWeekSymbol").html(value.CurrencySymbol);
                                $("#RentPerYearSymbol").html(value.CurrencySymbol);
                                $("#TotalExpenseSymbol").html(value.CurrencySymbol);
                                
                                
                                
                            });
                        }
                     }); 

            */
     }


</script>