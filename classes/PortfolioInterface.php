<?php


namespace Portfolio;

interface PortfolioInterface {
    //put your code here
    
    
}

class PortfolioClass implements PortfolioInterface{
     public static $SearchBtn, $LocationId, $Subrub, $Street, $StreetId, $stateId, $Zipcode, $ZipcodeId, $Suburb,$UploadedFiles; 
     public static $IsPdf;
    
	public static function Portfolio(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/portfolio.php" );
    }
	public static function InvestorLibrary(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/InvestorLibrary.php" );
    }
    public static function Portfolio2(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/portfolio2.php" );
    }
    public static function Init(){
         self::GetFormValues();
         
         //self::$TotalAddRows    = 3;
    }
    public static function portfolioLeases(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/portfolioLeases.php" );
    }
     public static function portfolioVacancies(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/portfolioVacancies.php" );
    }
     public static function portfolioAccounts(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/portfolioAccounts.php" );
    }
    public static function portfolioAgency(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/portfolioAgency.php" );
    }
    public static function portfolioAgency2(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/portfolioAgency2.php" );
    }
    public static function PropertyView(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/PropertyView.php" );
    }
    
    public static function MyPortfolio(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/MyProtfolioProperty.php" );
    }
    
    
    public static function AddFiles(){
		\Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 

		self::GetFormValues();
		self::GetMyFolderDbValues();

		//echo "Id =" . self::$Id;

	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/MyFolderFilesAdd.php" );
	}	
	
	public static function PortfolioResult(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/PortfolioResult.php" );
    }
    
    public static function ProtfolioPropDetails(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/ProtfolioPropDetails.php" );
    }
    
    
    public static function ProfolioComparisonPdf(){
        
        
        self::Init();
        \Html\HtmlClass::init();
        //echo self::$IsPdf;
         if (self::$IsPdf != "Y"){
            \settings\session\sessionClass::CheckSession();
        }

        
        
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/ProfolioComparisonPdf.php" );
    }
    
    public static function PortfolioPdfLocation(){
        
        self::Init();
         \Html\HtmlClass::init();
         if (self::$IsPdf != "Y"){
            \settings\session\sessionClass::CheckSession();
        }

        
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/PortfolioPdfLocation.php" );
    }
    
    public static function GetFormValues(){
        
        
        self::$IsPdf         = isset($_REQUEST["IsPdf"]) ? $_REQUEST["IsPdf"] : "";
    }
    
    
    

    
    public static function GetPropertyTypeDatas(){
        
       $IndexQry	= "SELECT
                        property_type_id, property_type
                    FROM
                        property_type
                    ORDER BY
                        property_type_id " ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    public static function GetPropertyViewDatas(){
        
       $IndexQry	= "select auto_id,unit_no,street_no,city,state,pincode,pt.property_type,pt.property_type_id,bedroom,bathroom,carspace
 from portfolio_Property pp,property_type pt where pt.property_type_id=pp.property_type " ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    public static function SaveProperty(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        $ArrQueries             = array();
        $MaxIdArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(auto_id), 0) + 1 Portfolio_ID FROM portfolio_Property)");
        $MaxId                  = $MaxIdArr["0"];
        
                                    
            $UnitNo   = $_REQUEST["UnitNo"]; 
			$StreetNo=$_REQUEST["StreetNo"]; 
			$City=$_REQUEST["City"]; 
			$State=$_REQUEST["State"]; 
			$Pincode=$_REQUEST["Pincode"]; 
			$PropertyType=$_REQUEST["PropertyType"]; 
			$Bedroom=$_REQUEST["Bedroom"]; 
			$Bathroom=$_REQUEST["Bathroom"]; 
			$Carspace=$_REQUEST["Carspace"]; 
			
    			$queryStr="insert into portfolio_Property(auto_id,unit_no,street_no,city,state,pincode,property_type,bedroom,bathroom,carspace) values
    			(:auto_id,:unit_no,:street_no,:city,:state,:pincode,:property_type,:bedroom,:bathroom,:carspace)";
    
    				$ColValarray = array("auto_id" => $MaxId, "unit_no"=>$UnitNo, "street_no"=>$StreetNo,
    				"city"=>$City, "state"=>$State, "pincode"=>$Pincode, "property_type"=>$PropertyType,
    				"bedroom"=>$Bedroom, "bathroom"=>$Bathroom, "carspace"=>$Carspace) ; 
    				$Queryarray = array($queryStr,$ColValarray);
    
    				$ArrQueries[]=$Queryarray;
             
        
        $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
        
        
        \Html\HtmlClass::Init();
        include "header.php";

        echo '	<div id="content">';
        echo	'<div class="widget-title pl-4">
                       <h3>Portfolio My property- save</h3>
                     </div>';
        echo '		<div class="container">
                            <div class="grid-24">';
        
        if ($Msg == "success"){
            $Msg    =   "Saved Successfully. <br><br>";
        }
        else{
            $Msg    =   "There is a error while save.";
        }
        
        echo '                  <div class="notify notify-success">
                                     <h3 align="center"><br/>' . $Msg .'</h3>
                                    
                                </div>';

        echo '			</div>
                                </div>
                        </div>';

        //\Html\HtmlClass::TopNavBar(); 

        //\Html\HtmlClass::Footer(); 

        echo '</body></html>';
    }
    
  /*----------------- Arzath 2020-03-03 -------------------*/
    public static function GetCountryData($IsAll = ""){
        
        if ($IsAll != "")
            $strWhr = " 1=1";
        else
            $strWhr = "IS_ACTIVATE ='Y' ";
        
        $IndexQry	= "SELECT COUNTRY_CODE, 
                            COUNTRY_NAME, CURRENCY, 
                            IMAGE FROM country_master WHERE ".$strWhr ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    
    

    
    public static function PortfolioPropertysave(){
		
		 \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();  
		
	    $user_id   = \settings\session\sessionClass::GetSessionDisplayName();
	    
	     $Mode  = isset($_REQUEST["Mode"]) ?   $_REQUEST["Mode"] : "";
	     
	     
	    $property_id   						= $_REQUEST["property_id"]; 
	    $buttonaction   						= $_REQUEST["buttonaction"]; 
	    
	   
	    $UploadedImagefile                   = isset($_REQUEST["UploadedImagefile"]) ?      $_REQUEST["UploadedImagefile"] : "";

	    
	     $Imagefile = \Portfolio\PortfolioClass::myfolderfileupload();
	    
	   

  
        $Managementfee                      = isset($_REQUEST["Managementfee"]) ?         $_REQUEST["Managementfee"] : "0";
        $Adminstrationfee                   = isset($_REQUEST["Adminstrationfee"]) ?      $_REQUEST["Adminstrationfee"] : "0";
        $PropertyMaintenance                = isset($_REQUEST["PropertyMaintenance"]) ?   $_REQUEST["PropertyMaintenance"] : "0";
        $Ratesvalue                         = isset($_REQUEST["Ratesvalue"]) ?            $_REQUEST["Ratesvalue"] : "0";
        $BodyCorporatefee                   = isset($_REQUEST["BodyCorporatefee"]) ?      $_REQUEST["BodyCorporatefee"] : "0";
        $PropertyValueCurrent               = isset($_REQUEST["PropertyValueCurrent"]) ?  $_REQUEST["PropertyValueCurrent"] : "0";
        $Rentperweek                        = isset($_REQUEST["Rentperweek"]) ?         $_REQUEST["Rentperweek"] : "0";
        
        
        $myportfoliocountry   	            = isset($_REQUEST["myportfoliocountry"]) ? $_REQUEST["myportfoliocountry"] : "";
        $MyPortfolioPropAddress  	        = isset($_REQUEST["MyPortfolioPropAddress"]) ? $_REQUEST["MyPortfolioPropAddress"] : "";
        $no_of_parkingspace					= isset($_REQUEST["no_of_parkingspace"]) ? $_REQUEST["no_of_parkingspace"] : "0";
    	$no_of_bedrooms						= isset($_REQUEST["no_of_bedrooms"]) ? $_REQUEST["no_of_bedrooms"] : "0";
    	$no_of_bathroom						= isset($_REQUEST["no_of_bathroom"]) ? $_REQUEST["no_of_bathroom"] : "0";
    	$MyPortfolioPropertyType			= isset($_REQUEST["MyPortfolioPropertyType"]) ? $_REQUEST["MyPortfolioPropertyType"] : "";
    	$MyPortfolioLandArea		    	= isset($_REQUEST["MyPortfolioLandArea"]) ? $_REQUEST["MyPortfolioLandArea"] : "";
    	
    	$CapitalGrowth		    	        = isset($_REQUEST["CapitalGrowth"]) ? $_REQUEST["CapitalGrowth"] : "";
    	$YearlyRentalGrowth		            = isset($_REQUEST["YearlyRentalGrowth"]) ? $_REQUEST["YearlyRentalGrowth"] : "";
    	$PercentageYeildRo		            = isset($_REQUEST["PercentageYeildRo"]) ? $_REQUEST["PercentageYeildRo"] : "";
    	
    	
    	$myportfolioCurrency		        = isset($_REQUEST["myportfolioCurrency"]) ? $_REQUEST["myportfolioCurrency"] : "";
    	$MyPortFolioName		            = isset($_REQUEST["MyPortFolioName"]) ? $_REQUEST["MyPortFolioName"] : "";
    	$DateBought		                    = isset($_REQUEST["DateBought"]) ? $_REQUEST["DateBought"] : "";
    	$DateCompletion		                = isset($_REQUEST["DateCompletion"]) ? $_REQUEST["DateCompletion"] : "";
    	$UnitNumber	                        = isset($_REQUEST["UnitNumber"]) ? $_REQUEST["UnitNumber"] : "";
    	
    	$PricePaid	                        = isset($_REQUEST["PricePaid"]) ? $_REQUEST["PricePaid"] : "";
    	$CurrentValue                       = isset($_REQUEST["CurrentValue"]) ? $_REQUEST["CurrentValue"] : "";
    	$GroundRent	                        = isset($_REQUEST["GroundRent"]) ? $_REQUEST["GroundRent"] : "";
    	$OtherCosts	                        = isset($_REQUEST["OtherCosts"]) ? $_REQUEST["OtherCosts"] : "";
    	
    	
    	if ( $DateBought != "" ){
    	    
    	    $DateBought                         = \Portfolio\PortfolioClass::convertDate($DateBought, "%Y-%m-%d");
    	}
    	
    	
    	if ( $DateBought != "" ){
    	    
    	    $DateCompletion                         = \Portfolio\PortfolioClass::convertDate($DateCompletion, "%Y-%m-%d");
    	}
    
    	
    	
    	
    	if ($Imagefile == ""){
    	    
    	    $Imagefile = "";
    	}
    
    	/* Not in Use Start */
    	
        $property_purchase_value_price   	= isset($_REQUEST["property_purchase_value_price"]) ? $_REQUEST["property_purchase_value_price"] : "0";
        $loan_purchase_deposit   			= isset($_REQUEST["loan_purchase_deposit"]) ? $_REQUEST["loan_purchase_deposit"] : "0";
        $loan_purchase_market_value   		= isset($_REQUEST["loan_purchase_market_value"]) ? $_REQUEST["loan_purchase_market_value"] : "0";
        $loan_purchase_amount   			= isset($_REQUEST["loan_purchase_amount"]) ? $_REQUEST["loan_purchase_amount"] : "0";
        $other_exp_capital   				= isset($_REQUEST["other_exp_capital"]) ? $_REQUEST["other_exp_capital"] : "0";
        $other_exp_slicitor_cost   			= isset($_REQUEST["other_exp_slicitor_cost"]) ? $_REQUEST["other_exp_slicitor_cost"] : "0";
        $other_exp_stamping_cost   			= isset($_REQUEST["other_exp_stamping_cost"]) ? $_REQUEST["other_exp_stamping_cost"] : "0";
        $other_exp_other   					= isset($_REQUEST["other_exp_other"]) ? $_REQUEST["other_exp_other"] : "0";
        $arr_rental_type   					= isset($_REQUEST["arr_rental_type"]) ? $_REQUEST["arr_rental_type"] : "0";
        $arr_annual_rr   					= isset($_REQUEST["arr_annual_rr"]) ? $_REQUEST["arr_annual_rr"] : "0";
        $arr_weekly_rents   				= isset($_REQUEST["arr_weekly_rents"]) ? $_REQUEST["arr_weekly_rents"] : "0";
        $arr_total_annual_rent   			= isset($_REQUEST["arr_total_annual_rent"]) ? $_REQUEST["arr_total_annual_rent"] : "0";
        $ape_rates   						= isset($_REQUEST["ape_rates"]) ? $_REQUEST["ape_rates"] : "0";
        $ape_body_corporate   				= isset($_REQUEST["ape_body_corporate"]) ? $_REQUEST["ape_body_corporate"] : "0";
        $ape_land_lease_fee   				= isset($_REQUEST["ape_land_lease_fee"]) ? $_REQUEST["ape_land_lease_fee"] : "0";
        $ape_insurance   					= isset($_REQUEST["ape_insurance"]) ? $_REQUEST["ape_insurance"] : "0";
        $ape_letting_fees   				= isset($_REQUEST["ape_letting_fees"]) ? $_REQUEST["ape_letting_fees"] : "0";
        $ape_management_fees   				= isset($_REQUEST["ape_management_fees"]) ? $_REQUEST["ape_management_fees"] : "0";
        $ape_repairs_maitenance   			= isset($_REQUEST["ape_repairs_maitenance"]) ? $_REQUEST["ape_repairs_maitenance"] : "0";
        $ape_gardening   					= isset($_REQUEST["ape_gardening"]) ? $_REQUEST["ape_gardening"] : "0";
        $ape_cleaning   					= isset($_REQUEST["ape_cleaning"]) ? $_REQUEST["ape_cleaning"] : "0";
        $ape_service_contract   			= isset($_REQUEST["ape_service_contract"]) ? $_REQUEST["ape_service_contract"] : "0";
        $ape_other   						= isset($_REQUEST["ape_other"]) ? $_REQUEST["ape_other"] : "0";
        $ae_property_belong   				= isset($_REQUEST["ae_property_belong"]) ? $_REQUEST["ae_property_belong"] : "0";
        $ae_entity_rows   					= isset($_REQUEST["ae_entity_rows"]) ? $_REQUEST["ae_entity_rows"] : "0";
        $mf_customer_price_index   			= isset($_REQUEST["mf_customer_price_index"]) ? $_REQUEST["mf_customer_price_index"] : "0";
        $mf_capital_growth   				= isset($_REQUEST["mf_capital_growth"]) ? $_REQUEST["mf_capital_growth"] : "0";
        $mf_land_tax  						= isset($_REQUEST["mf_land_tax"]) ? $_REQUEST["mf_land_tax"] : "0";
        $de_calculate_depreciation   		= isset($_REQUEST["de_calculate_depreciation"]) ? $_REQUEST["de_calculate_depreciation"] : "0";
        $de_construction_year_completed   	= isset($_REQUEST["de_construction_year_completed"]) ? $_REQUEST["de_construction_year_completed"] : "0";
        $de_recent_renovations   			= isset($_REQUEST["de_recent_renovations"]) ? $_REQUEST["de_recent_renovations"] : "0";
        $de_estimate_land_value   			= isset($_REQUEST["de_estimate_land_value"]) ? $_REQUEST["de_estimate_land_value"] : "0";
        $loan_value_ratio_growth   			= isset($_REQUEST["loan_value_ratio_growth"]) ? $_REQUEST["loan_value_ratio_growth"] : "0";
        $ae_entity_selected   				= isset($_REQUEST["ae_entity_selected"]) ? $_REQUEST["ae_entity_selected"] : "0";
        $ape_pricipal_interest   			= isset($_REQUEST["ape_pricipal_interest"]) ? $_REQUEST["ape_pricipal_interest"] : "0";
		$loan_pricipal_interest   			= isset($_REQUEST["loan_pricipal_interest"]) ? $_REQUEST["loan_pricipal_interest"] : "0";
		$loan_length_year   				= isset($_REQUEST["loan_length_year"]) ? $_REQUEST["loan_length_year"] : "0";
		$loan_length_month   				= isset($_REQUEST["loan_length_month"]) ? $_REQUEST["loan_length_month"] : "0";
		$loan_esatblishment_fee   			= isset($_REQUEST["loan_esatblishment_fee"]) ? $_REQUEST["loan_esatblishment_fee"] : "0";
		$loan_amount_loan   				= isset($_REQUEST["loan_amount_loan"]) ? $_REQUEST["loan_amount_loan"] : "0";
		$loan_interset_rate   				= isset($_REQUEST["loan_interset_rate"]) ? $_REQUEST["loan_interset_rate"] : "0";
		$loan_other_loan_costs   			= isset($_REQUEST["loan_other_loan_costs"]) ? $_REQUEST["loan_other_loan_costs"] : "0";
		$loan_valuation_fees   				= isset($_REQUEST["loan_valuation_fees"]) ? $_REQUEST["loan_valuation_fees"] : "0"; 
		
		/*  -- End --*/
		
		$property_master_auto_id   			= $_REQUEST["property_master_auto_id"];
		
		$locationname   			        = $_REQUEST["Subrub"] ? $_REQUEST["Subrub"] : ""; 
		$locationid   			            = $_REQUEST["LocationId"] ? $_REQUEST["LocationId"] : "0"; 
		
		if ($MyPortfolioPropAddress !="" )
            $MyPortfolioPropAddress             = addslashes($MyPortfolioPropAddress);
            
            
        if ($MyPortfolioPropertyType !="" )  
            $MyPortfolioPropertyType            = addslashes($MyPortfolioPropertyType);
            
         if ($locationname !="" )  
            $locationname                       = addslashes($locationname);
          
        if ($MyPortFolioName !="" )  
            $MyPortFolioName                    = addslashes($MyPortFolioName);  
            
        if ($UnitNumber !="" )  
            $UnitNumber                         = addslashes($UnitNumber);  
          
          
         

		
        $SQLArr             				= array();
		
		$ChkCntArr               			= \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(property_master_auto_id) AS property_master_auto_id FROM my_portfolio_property_hdr WHERE `user_id` ='" .$user_id. "' AND PROPERTY_ID='" .$property_id. "')");
        $ChkValue             				= $ChkCntArr["0"];
        
        


		if (  $ChkValue   == 0){
		    
    		 if ( $property_id  == "" ){
                
            	$MaxProIdArr               		= \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(property_id), 0) + 1 property_id FROM my_portfolio_property_hdr)");
                $property_id                    = $MaxProIdArr["0"];
                
            }
	
    		$MaxIdArr               			= \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(property_master_auto_id), 0) + 1 property_master_auto_id FROM my_portfolio_property_hdr)");
            $propertymasterauto_id              = $MaxIdArr["0"];
    	 	 
    		 $SQLQuery						    = "INSERT INTO my_portfolio_property_hdr(property_master_auto_id, user_id, property_id, property_purchase_value_price, 
    												loan_purchase_deposit, loan_purchase_market_value, loan_purchase_amount, other_exp_capital, 
    												other_exp_slicitor_cost, other_exp_stamping_cost, other_exp_other, arr_rental_type, arr_annual_rr, 
    												arr_weekly_rents, arr_total_annual_rent, ape_pricipal_interest, ape_rates, ape_body_corporate, 
    												ape_land_lease_fee, ape_insurance, ape_letting_fees, ape_management_fees, ape_repairs_maitenance,
    												ape_gardening, ape_cleaning, ape_service_contract, ape_other, ae_property_belong, ae_entity_rows , 
    												ae_entity_selected, mf_customer_price_index, mf_capital_growth , mf_land_tax, de_calculate_depreciation, 
    												de_construction_year_completed, de_recent_renovations, de_estimate_land_value, loan_value_ratio_growth, 
    												last_updated_by, last_updated_date,country_code, myportfolio_propaddr, myportfolio_parkingspace, myportfolio_bedrooms,
    												myportfolio_bathroom, myportfolio_proptype, myportfolio_land_area, management_fee, adminstration_fee,  property_maintenance ,
    												rates_value, body_corporate_fee, property_value_current, rent_perweek, image_file	,location_id , location_name ,
    												est_portfolio_growth, est_rental_growth , Yield_ROI , myportfolio_propname , Unit_Number , myportfolio_Currency ,purschase_date ,completion_date ,
    												Price_Paid ,  Current_Value  , Ground_Rent  , Other_Costs ) 
    												VALUES ('" .$propertymasterauto_id. "','" .$user_id. "','" .$property_id. "','" .$property_purchase_value_price. "'
    												,'" .$loan_purchase_deposit. "','" .$loan_purchase_market_value. "','" .$loan_purchase_amount. "','" .$other_exp_capital. "'
    												,'" .$other_exp_slicitor_cost. "','" .$other_exp_stamping_cost. "','" .$other_exp_other. "','" .$arr_rental_type. "','" .$arr_annual_rr. "','" .$arr_weekly_rents. "','" .$arr_total_annual_rent. "','" .$ape_pricipal_interest. "'
    												,'" .$ape_rates. "','" .$ape_body_corporate. "','" .$ape_land_lease_fee. "','" .$ape_insurance. "'
    												,'" .$ape_letting_fees. "','" .$ape_management_fees. "','" .$ape_repairs_maitenance. "','" .$ape_gardening. "'
    												,'" .$ape_cleaning. "','" .$ape_service_contract. "','" .$ape_other. "','" .$ae_property_belong. "'
    												, '" .$ae_entity_rows. "','" .$ae_entity_selected. "','" .$mf_customer_price_index. "','" .$mf_capital_growth. "' ,'" .$mf_land_tax. "','" .$de_calculate_depreciation. "','" .$de_construction_year_completed. "','" .$de_recent_renovations. "','" .$de_estimate_land_value. "'
    												,'" .$loan_value_ratio_growth. "'	,'" .$user_id. "',CURRENT_TIMESTAMP,'{$myportfoliocountry}','{$MyPortfolioPropAddress}',
    												'{$no_of_parkingspace}','{$no_of_bedrooms}','{$no_of_bathroom}','{$MyPortfolioPropertyType}' 	, '{$MyPortfolioLandArea}'  , '{$Managementfee}'  ,
    												'{$Adminstrationfee}' 	, '{$PropertyMaintenance}'  , '{$Ratesvalue}'  , '{$BodyCorporatefee}' 
    												, '{$PropertyValueCurrent}'  , '{$Rentperweek}'   , '{$Imagefile}'  , '{$locationid}'  , '{$locationname}'  , '{$CapitalGrowth}'
    												,'{$YearlyRentalGrowth}' , '{$PercentageYeildRo}' , '{$MyPortFolioName}' , '{$UnitNumber}' , '{$myportfolioCurrency}'
    												, '{$DateBought}' , '{$DateCompletion}' , '{$PricePaid}'  , '{$CurrentValue}'  , '{$GroundRent}'  , '{$OtherCosts}'  )";
    												
    								
    												
    		$SQLArr[]						 =  $SQLQuery;
    		
	
		}else{
			
			if ( $Imagefile == "" && $UploadedImagefile !="" ){
			    
			    $Imagefile = $UploadedImagefile;
			    
			}
			
			
			
    		$SQLQuery  					= "UPDATE my_portfolio_property_hdr SET 	last_updated_by='" .$user_id. "',last_updated_date=CURRENT_TIMESTAMP ,country_code = '{$myportfoliocountry}',
    		                                    myportfolio_propaddr = '{$MyPortfolioPropAddress}', myportfolio_parkingspace ='{$no_of_parkingspace}',	 myportfolio_bedrooms = '{$no_of_bedrooms}',
    		                                    myportfolio_bathroom='{$no_of_bathroom}',	myportfolio_proptype='{$MyPortfolioPropertyType}'  , myportfolio_land_area='{$MyPortfolioLandArea}', 
    		                                    management_fee='{$Managementfee}', adminstration_fee='{$Adminstrationfee}',  property_maintenance='{$PropertyMaintenance}' ,
    												rates_value='{$Ratesvalue}', body_corporate_fee='{$BodyCorporatefee}', property_value_current='{$PropertyValueCurrent}', 
    												rent_perweek='{$Rentperweek}', image_file='{$Imagefile}' ,location_id='{$locationid}'  , location_name='{$locationname}' ,
    												est_portfolio_growth = '{$CapitalGrowth}' , est_rental_growth = '{$YearlyRentalGrowth}' , Yield_ROI = '{$PercentageYeildRo}' ,
    												myportfolio_propname = '{$MyPortFolioName}' , Unit_Number = '{$UnitNumber}' , myportfolio_Currency = '{$myportfolioCurrency}' ,
    												purschase_date = '{$DateBought}' ,completion_date = '{$DateCompletion}' , Price_Paid = '{$PricePaid}' ,  Current_Value = '{$CurrentValue}' ,
    												Ground_Rent = '{$GroundRent}' , Other_Costs  = '{$OtherCosts}'
    												WHERE  user_id ='" .$user_id. "' AND PROPERTY_ID='" .$property_id. "'  ";	
    			//echo 'SQLArr1' .$SQLQuery. '<br>'; 
    		
    	
    	   $SQLArr[]						= $SQLQuery;	
    		

		}
		
	    //echo 'SQLArr1' .$SQLQuery. '<br>';
	    //exit();
	

		$Msg = \DBConn\DBConnection::RunQuery($SQLArr); 
		
	
	
	
        //include "header.php";
        
        
        $Listpath =  SITE_BASE_URL. "Portfolio/MyPortfolio.html?buttonaction=Edit&property_id=" .$property_id; 
        
        
        header("Location: ".$Listpath); /* Redirect browser */
        exit();
        

        echo '	<div id="content">';
        
        echo	'<div class="widget-title pl-4">
                       <h3>Portfolio My property- save</h3>
                     </div>';
        echo '		<div class="container">
                            <div class="grid-24">';
        
        if ($Msg == "success"){
            $Msg    =   "Saved Successfully. <br><br>  <a href='" .$Listpath. "'>back</a><br><br>";
        }
        else{
            $Msg    =   "There is a error while save.";
        }
        
        echo '                  <div class="notify notify-success">
                                     <h3 align="center"><br/>' . $Msg .'</h3>
                                    
                                </div>';

        echo '			</div>
                                </div>
                        </div>';

        //\Html\HtmlClass::TopNavBar(); 
        //\Html\HtmlClass::Footer(); 

        echo '</body></html>';
        
		/*
			
		 $Listpath =  SITE_BASE_URL. "Portfolio/Portfolio.html"; 
		 
		 header('location:' .$Listpath);
		
		*/

		
	}
	
	
	
	public static function GetDBValues($Id,$user_id){
        
         $IndexQry	= " SELECT property_master_auto_id, user_id, property_id, country_code, location_id , location_name, myportfolio_propaddr, myportfolio_parkingspace, myportfolio_bedrooms,
                                myportfolio_bathroom, myportfolio_proptype, myportfolio_land_area, management_fee, adminstration_fee, property_maintenance, rates_value,
                                body_corporate_fee, property_value_current, rent_perweek, image_file, property_purchase_value_price, loan_purchase_deposit,
                                loan_purchase_market_value, loan_purchase_amount, other_exp_capital, other_exp_slicitor_cost, other_exp_stamping_cost,
                                other_exp_other, arr_rental_type, arr_annual_rr, arr_weekly_rents, arr_total_annual_rent, ape_pricipal_interest, ape_rates,
                                ape_body_corporate, ape_land_lease_fee, ape_insurance, ape_letting_fees, ape_management_fees, ape_repairs_maitenance,
                                ape_gardening, ape_cleaning, ape_service_contract, ape_other, ae_property_belong, ae_entity_rows, ae_entity_selected, mf_customer_price_index,
                                mf_capital_growth, mf_land_tax, de_calculate_depreciation, de_construction_year_completed, de_recent_renovations, de_estimate_land_value,
                                loan_value_ratio_growth, last_updated_by, last_updated_date,est_portfolio_growth, est_rental_growth ,myportfolio_propname , Unit_Number , myportfolio_Currency ,purschase_date ,completion_date   
                                , Price_Paid ,  Current_Value  , Ground_Rent  , Other_Costs
                                FROM my_portfolio_property_hdr 
                            WHERE user_id ='" .$user_id. "' AND PROPERTY_ID ='" .$Id. "' order by property_master_auto_id 	" ;
                            
                            //echo $IndexQry;
                            
 
		 return \DBConn\DBConnection::getQuery($IndexQry); 
		
		
	}
	
	
   public static function GetDBDtlValues($Id){
		

        $IndexQry	= " SELECT property_dtl_auto_id, property_master_auto_id, loan_pricipal_interest, loan_length_year, loan_length_month, loan_amount_loan, 
                                loan_esatblishment_fee, loan_interset_rate, loan_other_loan_costs, loan_valuation_fees FROM my_portfolio_property_dtl
                                WHERE property_master_auto_id ='" .$Id. "'  order by property_master_auto_id  " ;
		
      
		 return \DBConn\DBConnection::getQuery($IndexQry); 
		 
		
		
	}
	
	public static function getPropertyDetails($user_id,$DateVal = "N"){
	    
	    if ( $DateVal == "CP") {
	        
	        $strWhere = " and completion_date <= NOW() ";
	    }else if ( $DateVal == "NP") {
	        
	        $strWhere = " and completion_date >= NOW() ";
	    }else{
	        
	        $strWhere = "";
	    }
	    
	     
	    
	     $IndexQry	= "SELECT property_id, country_name,location_id , location_name, myportfolio_propaddr, myportfolio_parkingspace, myportfolio_bedrooms,
                                myportfolio_bathroom, myportfolio_proptype, myportfolio_land_area, management_fee, adminstration_fee, property_maintenance, rates_value,
                                body_corporate_fee, property_value_current, rent_perweek, image_file,est_portfolio_growth , est_rental_growth ,Yield_ROI , cm.country_code ,
                                myportfolio_propname , Unit_Number , myportfolio_Currency ,date_format(purschase_date, '%d/%m/%Y') purschase_date ,date_format(completion_date, '%d/%m/%Y') completion_date  , Price_Paid ,  Current_Value  , Ground_Rent  , Other_Costs
                                FROM my_portfolio_property_hdr mpph,
                                country_master cm WHERE mpph.country_code = cm.country_code and user_id ='{$user_id}' " .$strWhere;
	     
	     //echo $IndexQry;
	     
	     
	     return \DBConn\DBConnection::getQuery($IndexQry); 
	    
	}
	
	/*
	public static function PropertyGetDetails(){
	    

	
	    $propertyid =  $_REQUEST["propertyid"] ?  $_REQUEST["propertyid"] : "";
	    $id         =  $_REQUEST["id"] ?  $_REQUEST["id"] : "";
	    
	    
	    
	   
	    if ( $propertyid != "" ){
	       $propertyid  = str_replace("," ,"','", $propertyid);
	       $StrProWhr   = "  and property_id in ('{$propertyid}') ";
	        
	    }else{
	       $StrProWhr = ""; 
   
	    }
	    
 // isset($_REQUEST["CapitalGrowthRate"]) ? $_REQUEST["CapitalGrowthRate"] : 0;
	    
	    $IndexQry	= " SELECT sum(IFNULL(property_value_current,0)) as propertyValue , count(property_id) as cnt , sum(IFNULL(Yield_ROI,0)) as Yield_ROI,
	                    sum(IFNULL(rent_perweek,0)) as rent_perweek , sum(IFNULL(est_portfolio_growth,0)) as est_portfolio_growth 
	                    FROM my_portfolio_property_hdr WHERE user_id = '{$id}' "  .$StrProWhr;
	     

	   $PropertyHdrRow = \DBConn\DBConnection::getQuery($IndexQry); 	
	 
	   
	   //echo $PropertyHdrRow;
	  // exit();

        foreach ($PropertyHdrRow as $row) 
        { 
           $propertyValue   = floatval($row["propertyValue"] ? $row["propertyValue"] :"0");
           $cnt             = floatval($row["cnt"] ? $row["cnt"] :"0" );
           $Yeildroi        = floatval($row["Yield_ROI"] ? $row["Yield_ROI"] :"0" );
           $rent_perweek    = floatval($row["rent_perweek"] ? $row["rent_perweek"] :"0");
           $Portfoliogrowth    = floatval($row["est_portfolio_growth"] ? $row["est_portfolio_growth"] :"0");
           
           
           
           $rentannual      = floatval($rent_perweek) * 52 ;
        }
	    
			
    	$NewUser_Arr = array( 
    	                        array(
        	                            "propertyValue" => $propertyValue,
        								"Property" => $cnt ,
        								"Yeildroi" => $Yeildroi,
        								"rentannual" => $rentannual,
        								"Portfoliogrowth" => $Portfoliogrowth
        							)
    						); 
								
	    //echo sizeof($NewUser_Arr);
			

	     return json_encode($NewUser_Arr); 
  
	}
	
	*/
		public static function PropertyGetDetails(){
	    

	
	    $propertyid =  $_REQUEST["propertyid"] ?  $_REQUEST["propertyid"] : "";
	    $id         =  $_REQUEST["id"] ?  $_REQUEST["id"] : "";
	    $IsSameCurr =  $_REQUEST["IsSameCurr"] ?  $_REQUEST["IsSameCurr"] : "";
	    
	    
	    
         \Property\PropertyClass::Init();
        $rows = \Property\PropertyClass::GetPropertyComparison("","",$propertyid);
        
        //echo "<pre>"; print_r($rows); echo "</pre>";
        //exit;
        
        $cnt=1;
        $TotalPropertyValue = 0;
        $Totalrentperweek  = 0;
        $TotalYieldroi  = 0;
        $Totalportfoliogrowth = 0;
        $TotalGrossIncome = 0;
        $Totalweeklyrental = 0;
        
        $PropReached = 1;
        
        foreach ($rows as $row) 
        {
            $ProprtyId  = $row["property_id"];
            $autoid     = $row["autoid"];
            $Countryname = $row["country_name"];
            $locationame = $row["location_name"] ?$row["location_name"] :"";
            $imagefile   = $row["image_file"] ? $row["image_file"] : "notupload";
            $income      = $row["income"] ? $row["income"] : "0";
            $countryid = $row["country_id"];
            $currtemp    = $row["baseCur"]  ? $row["baseCur"] : "" ;
           
           
          if($IsSameCurr == "2") 
        {
          $UsdExRate = "";
          $UsdExRateArr =  \Property\PropertyClass::GetCurrExrate("USD",$currtemp);
          foreach($UsdExRateArr as $UsdEx){
              $UsdExRate = $UsdEx["RATE"] ? $UsdEx["RATE"] :"1";
          }
              
              if ($UsdExRate == "")
                $UsdExRate = 1;
                
                $CurrencySym = "$" ;
                $Currency = "USD";
                $MapCurrecncy = $CurrencySym ." ".$Currency;
            
          }else{
              $UsdExRate = 1;
              
                $ChkCntArr  = \DBConn\DBConnection::getQueryFetchColumn("(SELECT CURRENCY FROM country_master WHERE COUNTRY_CODE ='{$countryid}')");
                $Currency   = $ChkCntArr["0"];
              
              
                $ChkSymbolArr   = \DBConn\DBConnection::getQueryFetchColumn("(SELECT Currency_Symbol FROM country_master WHERE COUNTRY_CODE ='{$countryid}')");
                $CurrencySym    = $ChkSymbolArr["0"] ;
                
                if($CountryId == "3")
                    $CurrencySym = "£";
              
              
    
                $MapCurrecncy = $CurrencySym ." ".$Currency;
          }  
                
            
             \ajax\ajaxClass::Init();
            $Prop           =  \ajax\ajaxClass::AnalyzerResult($autoid,"ARRAY");
            $GrossIncome        =  floatval($Prop[1]["GrossIncome"]);
            $MortgagePayment    =  floatval($Prop[1]["MortgagePayment"]);
            
                
            $PropertyValue            =  floatval($Prop[1]["PropertyValue"]) / floatval($UsdExRate);
            $GrossIncome              =  floatval($Prop[1]["GrossIncome"]) / floatval($UsdExRate) ;
            $OperatigExpTotal         =  floatval($Prop[1]["OperatigExpTotal"]) / floatval($UsdExRate) ;
      
            
            $lettingfeerate    =  $row["lettingfeerate"] ? $row["lettingfeerate"] : "0"; 
            $managementfees    =  $row["managementfees"] ? $row["managementfees"] : "0"; 
            $councilpropertytax    =  $row["councilpropertytax"] ? $row["councilpropertytax"] : "0"; 
            $codycorporateservicechg    =  $row["codycorporateservicechg"] ? $row["codycorporateservicechg"] : "0"; 
            $landleaserentpa    =  $row["landleaserentpa"] ? $row["landleaserentpa"] : "0"; 
            $insurancepa    =  $row["insurancepa"] ? $row["insurancepa"] : "0"; 
            $repairandmaintenance    =  $row["repairandmaintenance"] ? $row["repairandmaintenance"] : "0"; 
            $cleaningpermonth    =  $row["cleaningpermonth"] ? $row["cleaningpermonth"] : "0"; 
            $gardeningpermonth    =  $row["gardeningpermonth"] ? $row["gardeningpermonth"] : "0"; 
            $servicecontractspa    =  $row["servicecontractspa"] ? $row["servicecontractspa"] : "0"; 
            $other          =  $row["other"] ? $row["other"] : "0"; 
            
             $fixturesvalue         =  $row["fixturesvalue"] ? $row["fixturesvalue"] : "0"; 
             $fixtureslife         =  $row["fixtureslife"] ? $row["fixtureslife"] : "0"; 
             $furniturevalue         =  $row["furniturevalue"] ? $row["furniturevalue"] : "0"; 
             $furniturelife         =  $row["furniturelife"] ? $row["furniturelife"] : "0"; 
             $weeklyrental         =  $row["weeklyrental"] ? $row["weeklyrental"] : "0"; 
             $capitalgrowth         =  $row["capitalgrowth"] ? $row["capitalgrowth"] : "0"; 
             
             
             $Totalweeklyrental     = floatval($Totalweeklyrental) + floatval($weeklyrental) ;
             
             $Totalportfoliogrowth = floatval($Totalportfoliogrowth) + floatval($capitalgrowth);
            
            
            //=(Inputs!$B$51)*(1/Inputs!$C$51)
            
            $TotalGrossIncome        = floatval($TotalGrossIncome)  + ($GrossIncome);
            
            $fixturesfitting    = @(floatval($fixturesvalue) * (1 / floatval($fixtureslife)));
            $funitures          = @(floatval($furniturevalue) * (1 / floatval($furniturelife)));
            
            $TotalPropertyValue = floatval($TotalPropertyValue)  + $PropertyValue;
            
            
            $Annualexpensestemp = floatval($lettingfeerate)  + floatval($managementfees) + floatval($councilpropertytax) + floatval($codycorporateservicechg) + floatval($landleaserentpa) + floatval($insurancepa) 
                            + floatval($repairandmaintenance)   + floatval($cleaningpermonth) + floatval($gardeningpermonth) + floatval($servicecontractspa) + floatval($other);
                            
                            
            $Annualexpenses    = floatval($Annualexpensestemp) + floatval($MortgagePayment)   + floatval($fixturesfitting)  + floatval($funitures) ;
            
            $TotalAnnualexpenses =  floatval($TotalAnnualexpenses) +  floatval($Annualexpenses);
            
            $cnt++;
            
              //echo floatval($UsdExRate);
    
            $NetAnnualReturn          =  $GrossIncome - $OperatigExpTotal;
            
            $NetCashFlow              =  floatval($Prop[1]["NetCashFlow"]) / floatval($UsdExRate) ;
            $NetCashFlowAfterTax      =  floatval($Prop[1]["NetCashFlowAfterTax"]) / floatval($UsdExRate) ;
            
            $TotalInitialCashCost     =  floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate);
            $MortgagePayment          =  floatval($Prop[1]["MortgagePayment"]) / floatval($UsdExRate) ;
            
            $ROI                      = ($NetCashFlowAfterTax / $TotalInitialCashCost)*100 ;
            
            
            $TotalYieldroi           = $TotalYieldroi + $ROI;
            
            
            
            
            
        }
            $propcnt = $cnt - 1;
            //$TotalYieldroi = floatval($TotalGrossIncome) /  ( floatval($TotalPropertyValue) / 100);
            $Totalrentperweek = floatval($Totalweeklyrental) * 53;
            $Totalportfoliogrowth = floatval($Totalportfoliogrowth) / floatval($propcnt);
			
    	$NewUser_Arr = array( 
    	                        array(
        	                            "propertyValue" => $TotalPropertyValue,
        								"Property" => $propcnt ,
        								"Yeildroi" => $TotalYieldroi,
        								"rentannual" => $Totalrentperweek,
        								"Portfoliogrowth" => $Totalportfoliogrowth
        							)
    						); 
								
	    //echo sizeof($NewUser_Arr);
			

	     return json_encode($NewUser_Arr); 
  
	}
	
	public static function myfolderfileupload(){
       
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        

        if (isset($_FILES["UploadFile"]["tmp_name"])){
            //echo "in";
            $tmpname = $_FILES["UploadFile"]["tmp_name"];
            $filename = $_FILES["UploadFile"]["name"];
            $actfilename = str_replace(",", "_", $filename); 
            $UplFilePath = "uploads/portfolioimage/" . $actfilename; 
            
            if (move_uploaded_file($tmpname, $UplFilePath) ){
                if (self::$UploadedFiles == ""){
                    self::$UploadedFiles = $actfilename;
                }
                else{
                    self::$UploadedFiles = self::$UploadedFiles . "," . $actfilename;
                }

				//echo self::$UploadedFiles;
            }
        }else{
            
            $filename = "";
            
        }
        
		return $filename;

    }
    
     public static function GetCurrecnyConverstion($TotalValue,$PropertyCountryCode,$Currency){
		

            $PropCountryArr               	= \DBConn\DBConnection::getQueryFetchColumn("(SELECT CURRENCY FROM country_master WHERE COUNTRY_CODE = '{$PropertyCountryCode}')");
            $PropertyCurrency               = $PropCountryArr["0"];
            
            //echo $TotalValue;
            //echo $Currency;
            
            if ($Currency == ""){
                
                $Currency = $PropertyCountryCode;
            }
       
            
            if ($PropertyCurrency == $Currency){
                
                $TotalExchangeValue =  round($TotalValue);
            }else{
               
                 //$TodayDate  = date("Y-m-d");
                 $TodayDate = '2020-03-18';
                 $TodayExcRateArr              = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(*) AS CNT FROM api_currency_exchange WHERE base_currency ='{$PropertyCurrency}' AND currency='{$Currency}' AND updated_date ='{$TodayDate}')");
                 $ISTodayExcRate               = $TodayExcRateArr["0"];
                 
              
                 if( $ISTodayExcRate < 1 ){
                     \api\apiClass::Init();
                     $createExchnageRate  =  \api\apiClass::GetCurrExrateDatas("EUR"); 
                     
                      //echo '$createExchnageRate=' . $createExchnageRate;

                 }
                 

                 
                  $ExchangeRate = \Portfolio\PortfolioClass::GetExchangeRate($PropertyCurrency,$Currency,$TodayDate);
               
                 
                  $TotalExchangeValue  =   round(floatval($TotalValue) * floatval($ExchangeRate),0);
                
            }
            
                 
           //echo 'TotalExchangeValue=' . $TotalExchangeValue;
            
            //exit();
            
                 //$TotalExchangeValue = \Portfolio\PortfolioClass::GetMoneyFormat($TotalExchangeValue);
            
            //echo 'TotalExchangeValue=' . $TotalExchangeValue;
          
 
		     return $TotalExchangeValue;
		 
		
		
	}
	
	 public static function GetExchangeRate($PropertyCurrency,$Currency,$TodayDate){
	     
	     $RATE = 1;
       
        $IndexQry	= "    SELECT
                                base_currency,currency,RATE,updated_date
                            FROM
                                api_currency_exchange a
                            where updated_date=(select MAX(updated_date) from api_currency_exchange b where a.base_currency=b.base_currency)  
                                and a.base_currency='".$PropertyCurrency."'  and  currency = '{$Currency}' and   updated_date ='{$TodayDate}'  " ;
                            
        $Countryrows = \DBConn\DBConnection::getQuery( $IndexQry ); 
                             
                               foreach ($Countryrows as $Countryrow) 
                               {
                                   $RATE        =$Countryrow["RATE"];
                                  // $Currencies= $Countryrow["currency"];
                                    
                               }
          
        return $RATE;
                        
    }
    
     public static function GetMoneyFormat($number){
         
         
        // let's print the international format for the en_US locale
        setlocale(LC_MONETARY, 'en_US');
         $FormatAmt =  money_format('%!i', $number) . "\n";
         
         return $FormatAmt;
         
     }
    
    public static function convertDate($date , $dateFormat = '%d-%m-%Y %H:%M:%S'){
		$date       = str_replace("/" , "-" , $date);
		$timestamp  = strftime($date);
		return strftime($dateFormat , strtotime($timestamp));
    }


    public static function GetCurrencySymbol(){
	    

	
	    
	    $Currency            =  $_REQUEST["Currency"] ?  $_REQUEST["Currency"] : "";
	    $CountryCode         =  $_REQUEST["CountryCode"] ?  $_REQUEST["CountryCode"] : "";
	    

	    $IndexQry	=  " SELECT COUNTRY_CODE, 
                            COUNTRY_NAME, CURRENCY, 
                            IMAGE , Currency_Symbol FROM country_master WHERE IS_ACTIVATE ='Y' and CURRENCY ="  .$Currency ;
                            
      //  echo $IndexQry;
       // exit();
	     

	   $CurrencyRow = \DBConn\DBConnection::getQuery($IndexQry); 	
	 

        foreach ($CurrencyRow as $row) 
        { 
           $CurrencySymbol   = $row["Currency_Symbol"] ? $row["Currency_Symbol"] :"$";
  
        }
	 
	    if ( $CurrencySymbol == "" )
	        $CurrencySymbol = "$";
	        
			
    	$NewUser_Arr = array( 
    	                        array(
        	                            "CurrencySymbol" => $CurrencySymbol
        							)
    						); 
								
	    //echo sizeof($NewUser_Arr);
			

	     return json_encode($NewUser_Arr);
  
	}
    
    /*------------------------------------*/
    
}	