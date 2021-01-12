<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ajax;

/**
 *
 * @author Farid
 */
interface ajaxInterface {
    //put your code here    
    //public static function GetVehicleList(); 
}

class ajaxClass implements ajaxInterface{
    private static $ProdId, $CustomerId, $BillBook, $FromDate, $ConvertFromDate, $Shift, $BillNo, $ProdName; 
    private static $Result; 
    private static $JsonResult, $ProdPriceId, $PurPrice, $SalesPrice, $TransId, $Salary, $Query, $Keyword,$Propcountrycode; 
    private static $property_id , $LocationId , $MyPortFolioName, $Subrub, $MyPortfolioPropAddress , $CountryId , $Income , $MarketPrice , $DuvalDynamicPrice ; 
    private static $StampDuty, $TransferFees, $LegalFees, $TotalPurchaseCost, $ResetrvationFees, $StagePay1Per, $StagePay1Amt, $StagePay2Per, $StagePay2Amt, $LoanAmountPer;
    private static $Topup, $WeeklyRental, $VacancyRate, $LettingFeeRate, $ManagementFees, $CouncilPropertyTax, $CodyCorporateServiceChg, $LandLeaseRentPa, $InsurancePa , $RepairandMaintenance ;
    private static $CleaningPerMonth , $GardeningPerMonth , $ServiceContractsPa , $Other , $LTV , $InitialLoanAmt , $InterestRate , $TermYears , $CPI, $RentalGrowth, $CapitalGrowth , $CapitalGrowthRate;
    private static $Purchaseprice , $firsttimebuyer, $RentalGuarantee , $FurniturePackReq, $UnitSize , $UnitType , $LeaseRegistration, $MortgageRegistration , $LandTransfer, $FixturesValue, $FixturesLife;
    private static $FurnitureValue , $FurnitureLife, $BuildingValue , $BuildingLife , $AnnualRental,$OwnerOccupier,$SecondHomeInvestment,$AUDynamicPrice,$Resident,$ResidentInvestor, $HavePersonalAllowance ;
    private static $DateBought,$DateCompletion, $ResidentStatus, $IntOrPrincipalInt, $UkResidentStatus;
    
    private static $IsAuGbNz; 

    public static function Init(){
        self::GetFormValues(); 
    }
    
    public static function GetFormValues(){
        

        self::$Query		        = isset($_REQUEST["passquery"]) ? $_REQUEST["passquery"] : "";
        self::$Keyword		        = isset($_REQUEST["query"]) ? $_REQUEST["query"] : "auck";
        self::$Propcountrycode		        = strtolower(isset($_REQUEST["Propcountrycode"]) ? $_REQUEST["Propcountrycode"] : "1"); //  Arzath - 2020-04-14
        
        //=========================================
        
        self::$property_id 							= isset($_REQUEST["property_id"])               ? $_REQUEST["property_id"] : "";
        self::$LocationId				            = isset($_REQUEST["LocationId"])                ? $_REQUEST["LocationId"] : "";
        self::$MyPortFolioName				        = isset($_REQUEST["MyPortFolioName"])           ? $_REQUEST["MyPortFolioName"] : "";
        self::$Subrub				            	= isset($_REQUEST["Subrub"])                    ? $_REQUEST["Subrub"] : "";
        self::$MyPortfolioPropAddress         	    = isset($_REQUEST["MyPortfolioPropAddress"])    ? $_REQUEST["MyPortfolioPropAddress"] : "";
        self::$CountryId				            = isset($_REQUEST["countryid"])                 ? $_REQUEST["countryid"] : ""; //countryid
        self::$Income 								= isset($_REQUEST["Income"])					? str_replace(",", "",$_REQUEST["Income"]) : 0; 
        self::$MarketPrice 							= isset($_REQUEST["MarketPrice"]) 				? str_replace(",", "",$_REQUEST["MarketPrice"])  : 0;
        self::$DuvalDynamicPrice 					= isset($_REQUEST["DuvalDynamicPrice"]) 		? str_replace(",", "",$_REQUEST["DuvalDynamicPrice"]) : 0; 
        
        //echo "CountryId=$CountryId";
        
        if (self::$CountryId == "2" || self::$CountryId == "3" || self::$CountryId == "1"){
           self::$IsAuGbNz                          = true;
        }
        else{
            self::$IsAuGbNz                         = false;
            self::$MarketPrice 				        = self::$DuvalDynamicPrice;
        }
        
        self::$StampDuty 							= isset($_REQUEST["StampDuty"]) 				? str_replace(",", "",$_REQUEST["StampDuty"]): 0; 
        self::$TransferFees 						= isset($_REQUEST["TransferFees"]) 				? str_replace(",", "",$_REQUEST["TransferFees"]) : 0; 
        self::$LegalFees 							= isset($_REQUEST["LegalFees"]) 				? str_replace(",", "",$_REQUEST["LegalFees"]): 0; 
        self::$TotalPurchaseCost 					= isset($_REQUEST["TotalPurchaseCost"]) 		? str_replace(",", "",$_REQUEST["TotalPurchaseCost"]) : 0; 
        self::$ResetrvationFees 					= isset($_REQUEST["ResetrvationFees"]) 			? str_replace(",", "",$_REQUEST["ResetrvationFees"]) : 0; 
        self::$StagePay1Per							= isset($_REQUEST["StagePay1Per"]) 				? str_replace(",", "",$_REQUEST["StagePay1Per"]) : 0; 
        self::$StagePay1Amt							= isset($_REQUEST["StagePay1Amt"]) 				? str_replace(",", "",$_REQUEST["StagePay1Amt"])  : 0; 
        self::$StagePay2Per							= isset($_REQUEST["StagePay2Per"]) 				? str_replace(",", "",$_REQUEST["StagePay2Per"]) : 0; 
        self::$StagePay2Amt							= isset($_REQUEST["StagePay2Amt"]) 				? str_replace(",", "",$_REQUEST["StagePay2Amt"]) : 0; 
        self::$LoanAmountPer						= isset($_REQUEST["LoanAmountPer"]) 			? str_replace(",", "",$_REQUEST["LoanAmountPer"]) : 0; 
        self::$Topup								= isset($_REQUEST["Topup"]) 					? str_replace(",", "",$_REQUEST["Topup"]) : 0; 
        self::$WeeklyRental							= isset($_REQUEST["WeeklyRental"]) 				? str_replace(",", "",$_REQUEST["WeeklyRental"]) : 0; 
        self::$VacancyRate							= isset($_REQUEST["VacancyRate"]) 				? str_replace(",", "",$_REQUEST["VacancyRate"])  : 0; 
        self::$LettingFeeRate						= isset($_REQUEST["LettingFeeRate"]) 			? str_replace(",", "",$_REQUEST["LettingFeeRate"]) : 0; 
        self::$ManagementFees						= isset($_REQUEST["ManagementFees"]) 			? str_replace(",", "",$_REQUEST["ManagementFees"]) : 0; 
        self::$CouncilPropertyTax 					= isset($_REQUEST["CouncilPropertyTax"]) 		? str_replace(",", "",$_REQUEST["CouncilPropertyTax"]) : 0; 
        self::$CodyCorporateServiceChg 				= isset($_REQUEST["CodyCorporateServiceChg"]) 	? str_replace(",", "",$_REQUEST["CodyCorporateServiceChg"]) : 0; 
        self::$LandLeaseRentPa 						= isset($_REQUEST["LandLeaseRentPa"]) 			?  str_replace(",", "",$_REQUEST["LandLeaseRentPa"]) : 0; 
        self::$InsurancePa 							= isset($_REQUEST["InsurancePa"]) 				? str_replace(",", "",$_REQUEST["InsurancePa"]): 0; 
        self::$RepairandMaintenance 				= isset($_REQUEST["RepairandMaintenance"]) 		? str_replace(",", "",$_REQUEST["RepairandMaintenance"]) : 0; 
        self::$CleaningPerMonth 					= isset($_REQUEST["CleaningPerMonth"]) 			? str_replace(",", "",$_REQUEST["CleaningPerMonth"]) : 0; 
        self::$GardeningPerMonth 					= isset($_REQUEST["GardeningPerMonth"]) 		? str_replace(",", "",$_REQUEST["GardeningPerMonth"]) : 0; 
        self::$ServiceContractsPa 					= isset($_REQUEST["ServiceContractsPa"]) 		? $_REQUEST["ServiceContractsPa"] : 0; 
        self::$Other 								= isset($_REQUEST["Other"]) 					? str_replace(",", "",$_REQUEST["Other"]) : 0; 
        self::$LTV 									= isset($_REQUEST["LTV"]) 						? $_REQUEST["LTV"] : 0; 
        self::$InitialLoanAmt						= isset($_REQUEST["InitialLoanAmt"]) 			? str_replace(",", "",$_REQUEST["InitialLoanAmt"]) : 0; 
        self::$InterestRate							= isset($_REQUEST["InterestRate"]) 				? $_REQUEST["InterestRate"] : 0; 
        self::$TermYears							= isset($_REQUEST["TermYears"]) 				? $_REQUEST["TermYears"] : 0; 
        self::$CPI									= isset($_REQUEST["CPI"]) 						? str_replace(",", "",$_REQUEST["CPI"]): 0; 
        self::$RentalGrowth							= isset($_REQUEST["RentalGrowth"]) 				? str_replace(",", "",$_REQUEST["RentalGrowth"]): 0; 
        self::$CapitalGrowth						= isset($_REQUEST["CapitalGrowth"]) 			? str_replace(",", "",$_REQUEST["CapitalGrowth"]): 0; 
        self::$CapitalGrowthRate					= isset($_REQUEST["CapitalGrowthRate"]) 		? $_REQUEST["CapitalGrowthRate"] : 0;  
        self::$Purchaseprice 						= isset($_REQUEST["Purchaseprice"]) 			? $_REQUEST["Purchaseprice"] : 0; 
        self::$firsttimebuyer 						= isset($_REQUEST["firsttimebuyer"]) 			? $_REQUEST["firsttimebuyer"] : "";  
        self::$RentalGuarantee 						= isset($_REQUEST["RentalGuarantee"]) 			? $_REQUEST["RentalGuarantee"] : "";  
        self::$FurniturePackReq 					= isset($_REQUEST["FurniturePackReq"]) 			? $_REQUEST["FurniturePackReq"] : "";  
        self::$UnitSize 							= isset($_REQUEST["UnitSize"]) 					? $_REQUEST["UnitSize"] : "";  
        self::$UnitType  							= isset($_REQUEST["UnitType "]) 				? $_REQUEST["UnitType "] : "";   
        self::$LeaseRegistration					= isset($_REQUEST["LeaseRegistration"]) 		? $_REQUEST["LeaseRegistration"] : 0; 
        self::$MortgageRegistration 				= isset($_REQUEST["MortgageRegistration"]) 		? $_REQUEST["MortgageRegistration"] : 0; 
        self::$LandTransfer  						= floatval(str_replace(",", "", isset($_REQUEST["LandTransfer"]) 			    ? $_REQUEST["LandTransfer"] : 0)); 
        self::$FixturesValue						= floatval(isset($_REQUEST["FixturesValue"])    ? str_replace(",", "",$_REQUEST["FixturesValue"]) : 0); 
        self::$FixturesLife							= floatval(isset($_REQUEST["FixturesLife"])     ? $_REQUEST["FixturesLife"] : 0); 
        self::$FurnitureValue						= floatval(isset($_REQUEST["FurnitureValue"])   ? str_replace(",", "",$_REQUEST["FurnitureValue"]) : 0); 
        self::$FurnitureLife						= floatval(isset($_REQUEST["FurnitureLife"])    ? str_replace(",", "",$_REQUEST["FurnitureLife"]) : 0); 
        self::$BuildingValue              			= floatval(isset($_REQUEST["BuildingValue"])    ? str_replace(",", "",$_REQUEST["BuildingValue"]) : 0); 
        self::$BuildingLife               			= floatval(isset($_REQUEST["BuildingLife"])     ? $_REQUEST["BuildingLife"] : 0); 
        self::$AnnualRental				            = floatval(isset($_REQUEST["WeeklyRental"])     ? $_REQUEST["WeeklyRental"] : 0); 

        self::$HavePersonalAllowance                = isset($_REQUEST["HavePersonalAllowance"])     ? $_REQUEST["HavePersonalAllowance"] : "";
        self::$DateBought                           = isset($_REQUEST["DateBought"])     ? $_REQUEST["DateBought"] : "";
        self::$DateCompletion                        = isset($_REQUEST["DateCompletion"])     ? $_REQUEST["DateCompletion"] : "";
        
        self::$UkResidentStatus                     =  isset($_REQUEST["UkResidentStatus"])     ? $_REQUEST["UkResidentStatus"] : "";
        
        self::$ResidentStatus                        = isset($_REQUEST["ResidentStatus"])     ? $_REQUEST["ResidentStatus"] : "";
        self::$IntOrPrincipalInt                     = isset($_REQUEST["IntOrPrincipalInt"])     ? $_REQUEST["IntOrPrincipalInt"] : "";
    }
    
     public static function getDbValues($autoid){
        
        // echo 'autoid='. $autoid .'<br>';
        
        \Property\PropertyClass::init();
        $rows = \Property\PropertyClass::GetPropertyComparison("","",$autoid);
        
        //echo "<pre>"; print_r($rows); echo "</pre>";
        
        foreach ($rows as $row) 
        {
            
                             
            //echo "hii";
            
           //echo 'mortgageregistration='. $row["mortgageregistration"] .'<br>'; 
  
            //echo 'marketprice='. $row["marketprice"] .'<br>'; 
            
        	//$autoid				            = $row["autoid"];
        	self::$property_id 				= isset($row["propertyid"])                 ? $row["propertyid"] : "";
            self::$LocationId				= isset($row["LocationId"])                 ? $row["LocationId"] : "";
            self::$MyPortFolioName			= isset($row["property_name"])              ? $row["property_name"] : "";
            self::$Subrub				    = isset($row["location_name"])            ? $row["location_name"] : "";
            self::$MyPortfolioPropAddress   = isset($row["property_desc"])              ? $row["property_desc"] : "";
            self::$CountryId                        = isset($row["country_id"])              ? $row["country_id"] : "";

        	self::$OwnerOccupier					= $row["owneroccupier"]                 ? $row["owneroccupier"]         : "0";
        	self::$SecondHomeInvestment			= $row["secondhomeinvestment"]          ? $row["secondhomeinvestment"]  : "0";
        	self::$AUDynamicPrice					= $row["audynamicprice"]                ? $row["audynamicprice"]        : "0";
        	self::$Resident        		        = $row["resident"]                      ? $row["resident"]              : "0";
        	self::$ResidentInvestor        	    = $row["residentinvestor"]              ? $row["residentinvestor"]      : "0";
        	
        	
        	self::$Purchaseprice        	      = $row["duvaldynamicprice"]             ? $row["duvaldynamicprice"]                : "0";
        	self::$Income        	              = $row["income"]                        ? $row["income"]                : "0";
        	self::$MarketPrice  			      = $row["marketprice"]                   ? $row["marketprice"]           : "0"; 
        	self::$DuvalDynamicPrice   	          = $row["duvaldynamicprice"]             ? $row["duvaldynamicprice"]     : "0";
        	
        	
        	    
        	self::$StampDuty				      = $row["stampduty"]                     ? $row["stampduty"]             : "0";
            self::$LeaseRegistration		      = $row["leaseregistration"]             ? $row["leaseregistration"]   : "0";
            self::$TransferFees                   = $row["transferfees"]                  ? $row["transferfees"]   : "0";
 
            self::$MortgageRegistration           = $row["mortgageregistration"]          ? $row["mortgageregistration"]   : "0";
            self::$LandTransfer                   = $row["landtransfer"]                  ? $row["landtransfer"]   : "0";
            self::$LegalFees                      = $row["legalfees"]                     ? $row["legalfees"]                 : "0";
            self::$TotalPurchaseCost              = $row["totalpurchasecost"]             ? $row["totalpurchasecost"]   : "0";
            self::$ResetrvationFees               = $row["resetrvationfees"]              ? $row["resetrvationfees"]   : "0";
            self::$StagePay1Per                   = $row["stagepay1per"]                  ? $row["stagepay1per"]   : "0";
            self::$StagePay1Amt                   = $row["stagepay1amt"]                  ? $row["stagepay1amt"]   : "0";
            self::$StagePay2Per                   = $row["stagepay2per"]                  ? $row["stagepay2per"]   : "0";
            self::$StagePay2Amt                   = $row["stagepay2amt"]                  ? $row["stagepay2amt"]   : "0";
            self::$LoanAmountPer                  = $row["loanamountper"]                  ? $row["loanamountper"]   : "0";
            self::$Topup                          = $row["topup"]                         ? $row["topup"]   : "0";
            self::$WeeklyRental	                  = $row["weeklyrental"]                  ? $row["weeklyrental"]   : "0";
            self::$VacancyRate                    = $row["vacancyrate"]                   ? $row["vacancyrate"]   : "0";
            self::$LettingFeeRate                 = $row["lettingfeerate"]                ? $row["lettingfeerate"]   : "0";
            self::$ManagementFees                 = $row["managementfees"]                ? $row["managementfees"]   : "0";
            self::$CouncilPropertyTax             = $row["councilpropertytax"]            ? $row["councilpropertytax"]   : "0";
            
            self::$CodyCorporateServiceChg        = $row["codycorporateservicechg"]       ? $row["codycorporateservicechg"]   : "0";
            self::$LandLeaseRentPa                = $row["landleaserentpa"]               ? $row["landleaserentpa"]   : "0";
            self::$InsurancePa                    = $row["insurancepa"]                   ? $row["insurancepa"]   : "0";
            self::$RepairandMaintenance           = $row["repairandmaintenance"]          ? $row["repairandmaintenance"]   : "0";
            self::$CleaningPerMonth               = $row["cleaningpermonth"]              ? $row["cleaningpermonth"]   : "0";
            self::$GardeningPerMonth              = $row["gardeningpermonth"]             ? $row["gardeningpermonth"]   : "0";
            self::$ServiceContractsPa             = $row["servicecontractspa"]            ? $row["servicecontractspa"]   : "0";
            self::$Other                          = $row["other"]                         ? $row["other"]   : "0";
            self::$LTV                            = $row["ltv"]                           ? $row["ltv"]   : "0";
            self::$InitialLoanAmt                 = $row["initialloanamt"]                ? $row["initialloanamt"]   : "0";
            self::$InterestRate                   = $row["interestrate"]                  ? $row["interestrate"]   : "0";
            self::$TermYears                      = $row["termyears"]                     ? $row["termyears"]   : "0";
            self::$CPI                            = $row["cpi"]                           ? $row["cpi"]   : "0";
            self::$RentalGrowth                   = $row["rentalgrowth"]                  ? $row["rentalgrowth"]   : "0";
            self::$CapitalGrowth                  = $row["capitalgrowth"]                 ? $row["capitalgrowth"]   : "0";
            self::$BuildingValue                  = $row["buildingvalue"]                 ? $row["buildingvalue"]   : "0";
            self::$BuildingLife                   = $row["buildinglife"]                  ? $row["buildinglife"]   : "0";
            self::$FixturesValue                  = $row["fixturesvalue"]                 ? $row["fixturesvalue"]   : "0";
            self::$FixturesLife                   = $row["fixtureslife"]                  ? $row["fixtureslife"]   : "0";
            self::$FurnitureValue                 = $row["furniturevalue"]                ? $row["furniturevalue"]   : "0";
            self::$FurnitureLife                  = $row["furniturelife"]                 ? $row["furniturelife"]   : "0";
            self::$AnnualRental				      = $row["weeklyrental"]                   ? $row["weeklyrental"]   : "0"; 
            self::$CapitalGrowthRate			 = isset($row["CapitalGrowthRate"]) 	  ? $row["CapitalGrowthRate"] : "0"; 
            
            self::$firsttimebuyer 						= isset($row["firsttimebuyer"]) 			? $row["firsttimebuyer"] : "";  
            self::$RentalGuarantee 						= isset($row["RentalGuarantee"]) 			? $row["RentalGuarantee"] : "";  
            self::$FurniturePackReq 					= isset($row["FurniturePackReq"]) 			? $row["FurniturePackReq"] : "";  
            self::$UnitSize 							= isset($row["UnitSize"]) 					? $row["UnitSize"] : "";  
            self::$UnitType  							= isset($row["UnitType "]) 				? $row["UnitType "] : "";   
            
            self::$DateBought  						= $row["purschase_date"]		? $row["purschase_date "] : "";   
            self::$DateCompletion  					= $row["completion_date "]		? $row["completion_date "] : "";   
            self::$HavePersonalAllowance  			= $row["HavePersonalAllowance"]		? $row["HavePersonalAllowance"] : "";   
            self::$UkResidentStatus  			    = $row["UkResidentStatus"]		? $row["UkResidentStatus"] : "";   

           
            //echo '===HavePersonalAllowance'. self::$HavePersonalAllowance.'<br>'; 
            //echo '===UkResidentStatus'. self::$UkResidentStatus.'<br>'; 
            //exit;
            
            
            
        }
        
       // exit;
        
    }
    
    
    
    public static function CalculateMortgage( $FnPrincipal, $FnIntrest, $FnMortgagePeriod ){
        //global $ClsFinance; 
        $f                          = new \FinancialInterface\Financial();
		$EmiTenure					= $FnMortgagePeriod * 12;
        $Payable					= $f->PMT((floatval($FnIntrest)/100)/12, $EmiTenure, $FnPrincipal);
        //$Payable					= \FinancialInterface\Financial->PMT((floatval($FnIntrest)/100)/12, $EmiTenure, $FnPrincipal);
		$CloseBal					= $FnPrincipal; 

		$MarketPrice 				= self::$MarketPrice;
		$CapitalGrowth			    = self::$CapitalGrowth; 
		$CapitalAppreciationPM		= ($CapitalGrowth/100) / 12; 

		//echo "MarketPrice={$MarketPrice}, CapitalGrowth={$CapitalGrowth}, CapitalAppreciationPM={$CapitalAppreciationPM}"; 

		$MonthlyAppn				= $MarketPrice * $CapitalAppreciationPM; 
		$GrossAppn					= $MonthlyAppn + $MarketPrice; 
        
        $RetArr                     = array(); 
		$AnnualAppn					= 0;
		$AnnualInterest				= 0;
		$AnnualPrincipal			= 0;
		$AnnualInterestOnly         = 0;
        
        for ($i =1; $i <= intval($EmiTenure); $i++){
			$Yr						= floor($i/12) + 1; 
            $Pmt                    = $f->IPMT((floatval($FnIntrest)/100)/12, $i, $EmiTenure, $FnPrincipal);
            $PrincipalRepay         = $Payable - $Pmt;

			$OpenBal				= $CloseBal;
			$CloseBal				= floatval($CloseBal) + floatval($PrincipalRepay); 

			if ($i > 1){
				$MonthlyAppn		= $GrossAppn * $CapitalAppreciationPM; 
				$GrossAppn			= $MonthlyAppn + $GrossAppn;
			}

			$AnnualAppn				= floatval($AnnualAppn) + floatval($MonthlyAppn);
			$AnnualInterest			= floatval($AnnualInterest) + floatval($Pmt);
			$AnnualPrincipal		= floatval($AnnualPrincipal) + floatval($PrincipalRepay);
			
			$InterestOnlyAmt        = ((floatval($FnIntrest)/100)/12) * floatval($FnPrincipal);
			$AnnualInterestOnly     = floatval($AnnualInterestOnly) + $InterestOnlyAmt; 

			if ($i % 12 == 0){
				$AnnualAppnVal		= $AnnualAppn;
				$AnnualInterestVal	= $AnnualInterest;
				$AnnualPrincipalVal	= $AnnualPrincipal;
				$AnnualIntOnlyVal   = $AnnualInterestOnly;

				$AnnualAppn			= 0; 
				$AnnualInterest		= 0;
				$AnnualPrincipal	= 0; 
                $AnnualInterestOnly = 0;
			}
			else{
				$AnnualAppnVal		= 0;
				$AnnualInterestVal	= 0;
				$AnnualPrincipalVal	= 0;
				$AnnualIntOnlyVal   = 0;
			}

			$TempArr				= array("Installment"		=> $i, 
											"Year"				=> $Yr,
											"OpenBal"			=> $OpenBal,
											"Interest"			=> $Pmt,
											"PrincipalRepay"	=> $PrincipalRepay,
											"Payable"			=> $Payable,
											"CloseBal"			=> $CloseBal,
											"MonthlyAppn"		=> $MonthlyAppn,
											"GrossAppn"			=> $GrossAppn,
											"AnnualAppn"		=> $AnnualAppnVal,
											"AnnualInterest"	=> $AnnualInterestVal,
											"AnnualPrincipal"	=> $AnnualPrincipalVal,
											
											"InterestOnly"      => $InterestOnlyAmt,
											"AnnualInterestOnly"=> $AnnualIntOnlyVal,
										   ); 
			$RetArr[]				= $TempArr; 
        }
        
        return $RetArr;
    }

	public static function GetTaxArr( $CountryId , $IsNRI = false){
	    //$CountryId					= self::$CountryId;
	    $HavePersonalAllowance      = self::$HavePersonalAllowance; 
	    $ResidentStatus             = self::$ResidentStatus;
	    
		$FnTaxArr					= array();
		
		//ResidentStatus
		
		
		
		if ($CountryId == "2" and $ResidentStatus == "Resident"){
    		$FnTaxArr[]				= array("start"	=> 1,		"end" => 18200,			"percent" => 0,     "slab_amt" => 0);
    		$FnTaxArr[]				= array("start"	=> 18201,	"end" => 37000,			"percent" => 19,    "slab_amt" => 0);
    		$FnTaxArr[]				= array("start"	=> 37001,	"end" => 90000,			"percent" => 32.50, "slab_amt" => 3572);
    		$FnTaxArr[]				= array("start"	=> 90001,	"end" => 180000,	    "percent" => 37,    "slab_amt" => 20797);
    		$FnTaxArr[]				= array("start"	=> 180001,	"end" => 99999999999,	"percent" => 45,    "slab_amt" => 54097);
		}
		else if ($CountryId == "2" and $ResidentStatus == "NRI"){
		    //echo "IN";
    		$FnTaxArr[]				= array("start"	=> 1,	    "end" => 90000,			"percent" => 32.50, "slab_amt" => 0);
    		$FnTaxArr[]				= array("start"	=> 90001,	"end" => 180000,	    "percent" => 37,    "slab_amt" => 29250);
    		$FnTaxArr[]				= array("start"	=> 180001,	"end" => 99999999999,	"percent" => 45,    "slab_amt" => 62550);
		}
		else if ($CountryId == "3"){
		    //=MAX(MAX(D13-150000,0)*0.45+MIN(MAX(D13-50000,0),150000-50000)*0.4+MIN(D13-12500,50000-12500)*0.2+MAX((MIN(D13,125000)-100000)/2,0)*0.4,0)
    		$FnTaxArr[]			    = array("start"	=> 1,		"end" => 37500,			"percent" => 20,    "slab_amt" => 7500);
    		$FnTaxArr[]			    = array("start"	=> 37501,	"end" => 150000,		"percent" => 40,    "slab_amt" => 52500);
    		$FnTaxArr[]			    = array("start"	=> 150001,	"end" => 99999999999,	"percent" => 45,    "slab_amt" => 0);
	    
		}
		else{
		    $FnTaxArr[]				= array("start"	=> 1,		"end" => 14000,			"percent" => 10.5,  "slab_amt" => 1470);
    		$FnTaxArr[]				= array("start"	=> 14001,	"end" => 48000,			"percent" => 17.5,  "slab_amt" => 7420);
    		$FnTaxArr[]				= array("start"	=> 48001,	"end" => 70000,			"percent" => 30,    "slab_amt" => 14020);
    		$FnTaxArr[]				= array("start"	=> 70001,	"end" => 99999999999,	"percent" => 33,     "slab_amt" => 0);
		}
		//print_r($FnTaxArr);
		return $FnTaxArr;
	}

	public static function CalculateTaxAmt( $FnTaxbaleAmt ){
		$CountryId					= self::$CountryId;
	    $HavePersonalAllowance      = self::$HavePersonalAllowance; 
	    $IsNRI                      = ($HavePersonalAllowance != "") ? true : false; 
	    
	    
	    //echo 'CountryId='.$CountryId;
	    //echo 'HavePersonalAllowance='.$HavePersonalAllowance;
	    //echo 'IsNRI='.$IsNRI."<br>";
	    
		$TaxArr						= self::GetTaxArr( $CountryId , $IsNRI ); 
		$RetTaxAmt					= 0; 
		
		
		
		//print_r($TaxArr);
		//echo "FnTaxbaleAmt=$FnTaxbaleAmt <br>";
		
		//$FnTaxbaleAmt = 100;
		//echo "FnTaxbaleAmt={$FnTaxbaleAmt}<br><br>";
		//echo "HavePersonalAllowance=$HavePersonalAllowance";
		//echo $UkResidentStatus;
		
		if ($CountryId == "3" and ( $HavePersonalAllowance == "YES" or self::$UkResidentStatus == "OO" or self::$UkResidentStatus == "RI") ){
		    //echo $FnTaxbaleAmt . "=> "; 
		    //echo max( array( floatval($FnTaxbaleAmt) - 150000, 0) ) * 0.45;
		    //echo min( array( max( array( floatval($FnTaxbaleAmt) - 50000,  0)), 150000-50000) ) * 0.4;
		    //echo min( array( floatval($FnTaxbaleAmt) - 12500, 50000 - 12500) ) * 0.2;  //MIN(D19-12500,50000-12500)*0.2
		    //echo floatval($FnTaxbaleAmt) - 12500;
		    //echo $FnTaxbaleAmt;
		    
		    //echo "<br>";
		    $RetTaxAmt              = max( array( floatval($FnTaxbaleAmt) - 150000, 0) ) * 0.45 + 
                                      min( array( max( array( floatval($FnTaxbaleAmt) - 50000,  0)), 150000-50000) ) * 0.4 + 
                                      min( array( floatval($FnTaxbaleAmt) - 12500, 50000 - 12500) ) * 0.2 + 
                                      max( array( (min( array(floatval($FnTaxbaleAmt), 125000) )-100000) / 2, 0 ) ) * 0.4 ; 
                                      
            if ($RetTaxAmt < 0 )
                $RetTaxAmt          = 0;
		    //MAX( MAX(D13-150000,0)*0.45+ MIN(MAX(D13-50000,0),150000-50000)*0.4+MIN(D13-12500,50000-12500)*0.2+MAX((MIN(D13,125000)-100000)/2,0)*0.4,0)
		    //MAX(MAX(D13-150000,0)*0.45+MIN(MAX(D13-50000,0),150000-50000)*0.4+MIN(D13-12500,50000-12500)*0.2+MAX((MIN(D13,125000)-100000)/2,0)*0.4,0)
		    
		    
		    //MAX(MAX(D13-150000,0)*0.45+MIN(MAX(D13-50000,0),150000-50000)*0.4+MIN(D13-12500,50000-12500)*0.2+MAX((MIN(D13,125000)-100000)/2,0)*0.4,0)
		}
		else{

    		foreach($TaxArr as $TempTaxArr){
    			$Start					= $TempTaxArr["start"];
    			$End					= $TempTaxArr["end"];
    			$Percent				= $TempTaxArr["percent"];
    			$SlabAmt				= $TempTaxArr["slab_amt"];
    
    			//echo "Start={$Start}, End={$End}, Percent={$Percent}<br>"; 
    			
    			
    
    			if (floatval($Start) > floatval($FnTaxbaleAmt) ){
    				$TempTaxAmt			= 0;
    			}
    			else if(floatval($FnTaxbaleAmt) >= floatval($Start) and floatval($FnTaxbaleAmt) <= floatval($End)){
    				$TempTaxAmt			= ( floatval($FnTaxbaleAmt) - floatval($Start) + 1) * floatval($Percent) / 100;
    				//echo "IIn between{$TempTaxAmt}<br>";
    			}
    			else if(floatval($Start) < floatval($FnTaxbaleAmt)){
    				if ($FnTaxbaleAmt > $End){
    				    $TempTaxAmt		= ( floatval($End) - floatval($Start) + 1) * floatval($Percent) / 100;
    				   // echo "In {$TempTaxAmt} <br>";
    				}
    				else{
    					$TempTaxAmt		= ( floatval($FnTaxbaleAmt) - floatval($Start) + 1) * floatval($Percent) / 100; //Looks it will not fall in this condition...
    					//echo "Out<br>";
    				}
    
    			}
    
    			$RetTaxAmt				= floatval($RetTaxAmt) + floatval($TempTaxAmt); 
    		}
		}

		//echo "FnTaxbaleAmt={$FnTaxbaleAmt}, RetTaxAmt={$RetTaxAmt}";

		return $RetTaxAmt; 
	}


	public static function CashFlow( $FnPrincipal, $FnIntrest, $FnMortgagePeriod ){
		$FnCashFlowArr				= array();
		
		//echo "FnPrincipal={$FnPrincipal},FnIntrest= {$FnIntrest}, FnMortgagePeriod={$FnMortgagePeriod}";

		$TempMortgageArr			= self::CalculateMortgage( $FnPrincipal, $FnIntrest, $FnMortgagePeriod ); 
		
		//Tax calculation for Existing Income 
		$Income						= self::$Income;
		//echo "Income=$Income";
		$TaxAmt						= self::CalculateTaxAmt($Income); 
		//echo "TaxAmt=$TaxAmt, Income=$Income<br>";
		
		
		$DuvalDynamicPrice 			= self::$DuvalDynamicPrice;
		$AnnualRental				= self::$AnnualRental * 52 ;
		$VacancyRate				= self::$VacancyRate;
		$RentalGrowth				= self::$RentalGrowth;
		

		//Fees Rate 
		$LettingFeeRate				= self::$LettingFeeRate;
		$ManagementFees				= self::$ManagementFees;
		$CouncilPropertyTax			= self::$CouncilPropertyTax;
		$CodyCorporateServiceChg	= self::$CodyCorporateServiceChg;
		$LandLeaseRentPa			= self::$LandLeaseRentPa;
		$InsurancePa				= self::$InsurancePa;
		$RepairandMaintenance		= self::$RepairandMaintenance;
		$CleaningPerMonth			= self::$CleaningPerMonth;
		$GardeningPerMonth			= self::$GardeningPerMonth;
		$ServiceContractsPa			= self::$ServiceContractsPa;
		$Other						= self::$Other;


		$FixturesValue				= self::$FixturesValue;
		$FixturesLife				= self::$FixturesLife;
		$FurnitureValue				= self::$FurnitureValue;
		$FurnitureLife				= self::$FurnitureLife;
		$BuildingValue              = self::$BuildingValue;
		$BuildingLife               = self::$BuildingLife;

		$Fixtures					= @($FixturesValue / $FixturesLife);
		$Furnitures					= @($FurnitureValue / $FurnitureLife);
		$Building                   = @($BuildingValue / $BuildingLife);
		
		$NonCashExpenses			= $Fixtures + $Furnitures + $Building;
		
		$CPI						= self::$CPI;



		$TransferFees				= self::$TransferFees;
		$LegalFees					= self::$LegalFees;
		$ResetrvationFees			= self::$ResetrvationFees;
		$StagePay1Amt				= self::$StagePay1Amt;
		$StagePay2Amt				= self::$StagePay2Amt;
		$Topup						= self::$Topup;
		
		$CountryId					= self::$CountryId;
		
		$LeaseRegistration		    = self::$LeaseRegistration;
		$MortgageRegistration 		= self::$MortgageRegistration;
		$LandTransfer  				= self::$LandTransfer;
		
		$StampDuty                  = self::$StampDuty;
		
		if ( $CountryId != "1")
	        	$TotalInitialCashCost		= $TransferFees + $LegalFees + $ResetrvationFees + $StagePay1Amt + $StagePay2Amt + $Topup + $LeaseRegistration + $MortgageRegistration + $LandTransfer + $StampDuty;
		else
		        $TotalInitialCashCost		= $TransferFees + $LegalFees + $ResetrvationFees + $StagePay1Amt + $StagePay2Amt + $Topup + $LeaseRegistration + $MortgageRegistration + $LandTransfer;
	
		
	//	echo "LandTransfer=$LandTransfer, TotalInitialCashCost=$TotalInitialCashCost, LegalFees=$LegalFees, ResetrvationFees=$ResetrvationFees, Topup=$Topup, StagePay1Amt=$StagePay1Amt, StagePay2Amt=$StagePay2Amt, LeaseRegistration=$LeaseRegistration, MortgageRegistration=$MortgageRegistration<br>";
		
		if ($CountryId == "2" ){
		    $TotalInitialCashCost   = $TotalInitialCashCost ;//+ $StampDuty;
        }
        
        
        if ($CountryId == "2" or $CountryId == "3"){
            $EffectiveStampDutyRate = @(round(($StampDuty / $DuvalDynamicPrice) * 100, 2));
        }
        else{
            $EffectiveStampDutyRate = 0;
        }
		//echo "TotalInitialCashCost={$TotalInitialCashCost}"; 
        //$FnCashFlowArr[0]			= array("EffectiveStampDutyRate" => $EffectiveStampDutyRate); 

		//Taxes Variable init
		$TaxLossCfwdBalance			= 0; 



		for ($i = 1; $i <= 10; $i++){
			$TempArr					= array(); 
			$ArryPtr					= (intval($i) * 12) - 1; 

			if ($i > 1){
				$AnnualRental			= (floatval($AnnualRental) * floatval($RentalGrowth) / 100) + floatval($AnnualRental); 
			}

			$Vacancy					= floatval($AnnualRental) * floatval($VacancyRate) / 100; 

			$GrossIncome				= floatval($AnnualRental) - floatval($Vacancy); 


			//Fees Values
			if ($i == 1){
				$LettingFeeAmt			= floatval($GrossIncome) * ($LettingFeeRate/100);
				$ManagementFeesAmt		= floatval($GrossIncome) * ($ManagementFees/100);
				$CouncilPropertyTaxAmt	= floatval($CouncilPropertyTax);
				$CodyCorporateServiceAmt= floatval($CodyCorporateServiceChg); 
				$LandLeaseRentPaAmt		= floatval($LandLeaseRentPa);
				$InsurancePaAmt			= floatval($InsurancePa);
				$RepairandMaintenanceAmt= floatval($GrossIncome) * ($RepairandMaintenance/100);
				$CleaningPerMonthAmt	= $CleaningPerMonth * 12;
				$GardeningPerMonthAmt	= $GardeningPerMonth * 12;
				$ServiceContractsPaAmt	= floatval($ServiceContractsPa);
				$OtherAmt				= floatval($Other);


				
			}
			else{
				$LettingFeeAmt			= floatval($GrossIncome) * ($LettingFeeRate/100);
				$ManagementFeesAmt		= floatval($GrossIncome) * ($ManagementFees/100);

				$CouncilPropertyTaxAmt	= $CouncilPropertyTaxAmt + ($CouncilPropertyTaxAmt * $CPI / 100);
				$CodyCorporateServiceAmt= $CodyCorporateServiceAmt + ($CodyCorporateServiceAmt * $CPI / 100);
				$LandLeaseRentPaAmt		= $LandLeaseRentPaAmt + ($LandLeaseRentPaAmt * $CPI / 100);
				$InsurancePaAmt			= $InsurancePaAmt + ($InsurancePaAmt * $CPI / 100);

				$RepairandMaintenanceAmt= floatval($GrossIncome) * ($RepairandMaintenance/100);
				$CleaningPerMonthAmt	= $CleaningPerMonthAmt + ($CleaningPerMonthAmt * $CPI / 100);
				$GardeningPerMonthAmt	= $GardeningPerMonthAmt + ($GardeningPerMonthAmt * $CPI / 100);
				$ServiceContractsPaAmt	= $ServiceContractsPaAmt + ($ServiceContractsPaAmt * $CPI / 100);
				$OtherAmt				= $OtherAmt + ($OtherAmt * $CPI / 100);


				
			}
            
            //echo "<pre>"; print_r($TempMortgageArr); echo "</pre>";

            if (self::$IntOrPrincipalInt == "InterestOnly"){
			    $MortgagePayment		= 12 * floatval(isset($TempMortgageArr[$ArryPtr]["InterestOnly"]) ? $TempMortgageArr[$ArryPtr]["InterestOnly"] : 0);
			    $AnnualInterest			= floatval(isset($TempMortgageArr[$ArryPtr]["AnnualInterestOnly"]) ? $TempMortgageArr[$ArryPtr]["AnnualInterestOnly"] : 0);
			    
			    //echo "MortgagePayment=$MortgagePayment, ArryPtr=$ArryPtr<br>";
            }
            else{
                $AnnualInterest			= -1 * floatval(isset($TempMortgageArr[$ArryPtr]["AnnualInterest"]) ? $TempMortgageArr[$ArryPtr]["AnnualInterest"] : 0);
                $MortgagePayment		= -12 * floatval(isset($TempMortgageArr[$ArryPtr]["Payable"]) ? $TempMortgageArr[$ArryPtr]["Payable"] : 0);
            }
			
			
			
			$AnnualPrincipal			= -1 * floatval(isset($TempMortgageArr[$ArryPtr]["AnnualPrincipal"]) ? $TempMortgageArr[$ArryPtr]["AnnualPrincipal"] : 0);

			$AnnualAppn					= floatval(isset($TempMortgageArr[$ArryPtr]["AnnualAppn"]) ? $TempMortgageArr[$ArryPtr]["AnnualAppn"] : 0);

			$OperatigExpTotal			= $LettingFeeAmt + $ManagementFeesAmt + $CouncilPropertyTaxAmt + $CodyCorporateServiceAmt + $LandLeaseRentPaAmt + $InsurancePaAmt + $RepairandMaintenanceAmt + $CleaningPerMonthAmt + $GardeningPerMonthAmt + $ServiceContractsPaAmt + $OtherAmt;



			$NetCashFlow				= $GrossIncome - $OperatigExpTotal - $MortgagePayment;

			
			//Taxes
			
			$PrevTaxLossCfwdBalance		= $TaxLossCfwdBalance;		//Prev Year Tax Loss Carry Forward
            
            if (self::$CountryId == "3"){
			    $PropertyGainLossTaxable= $GrossIncome - $OperatigExpTotal;//- $AnnualInterest - $NonCashExpenses;
            }
            else if (self::$CountryId == "2"){
			    $PropertyGainLossTaxable= floatval($Income) + round($GrossIncome) - round($OperatigExpTotal) - round($AnnualInterest) - round($NonCashExpenses);
            }
            else if (self::$CountryId == "1"){
			    $PropertyGainLossTaxable= floatval($Income) + round($GrossIncome) - round($OperatigExpTotal) - round($AnnualInterest) - round($NonCashExpenses);
			    //echo "PropertyGainLossTaxable=$PropertyGainLossTaxable<br>";
            }
            else{
                $PropertyGainLossTaxable= $GrossIncome - $OperatigExpTotal - $AnnualInterest - $NonCashExpenses;
            }
            
            
			
                
			
			/*
			$CurPeriodTaxableGain		= ($PropertyGainLossTaxable > 0) ? $PropertyGainLossTaxable : 0; 
			$CurPeriodTaxableLoss		= ($PropertyGainLossTaxable < 0) ? -1 * $PropertyGainLossTaxable : 0; 

			$TaxableGain				= $CurPeriodTaxableGain; 

			$TaxLossCfwdBalanceBEG		= $PrevTaxLossCfwdBalance; 
			$UtilisedTaxLoss			= min( array( floatval($PrevTaxLossCfwdBalance) , floatval($TaxableGain) ) );

			$TaxLossCfwdBalance			= floatval($PrevTaxLossCfwdBalance) + floatval($CurPeriodTaxableLoss) - floatval($UtilisedTaxLoss); 
			*/
			
			if (self::$CountryId == "2" and self::$ResidentStatus == "NRI"){
			    //echo "In<br>";
			    //echo "GrossIncome=$GrossIncome, OperatigExpTotal=$OperatigExpTotal, AnnualInterest=$AnnualInterest, NonCashExpenses=$NonCashExpenses<br>";
			    
			    $IncomeSubjecttoTax			= floatval($GrossIncome) - floatval($OperatigExpTotal) - floatval($AnnualInterest) - floatval($NonCashExpenses); 
			}
			else if (self::$CountryId == "3"){
			    //echo "In<br>";
			    //echo "GrossIncome=$GrossIncome, OperatigExpTotal=$OperatigExpTotal, AnnualInterest=$AnnualInterest, NonCashExpenses=$NonCashExpenses<br>";
			    
			    $IncomeSubjecttoTax			= floatval($GrossIncome) - floatval($OperatigExpTotal); // - floatval($AnnualInterest) - floatval($NonCashExpenses); 
			}
			else{
			    $IncomeSubjecttoTax			= floatval($GrossIncome) - floatval($OperatigExpTotal) - floatval($AnnualInterest) - floatval($NonCashExpenses); 
			    //$IncomeSubjecttoTax			= floatval($CurPeriodTaxableGain) - floatval($UtilisedTaxLoss); 
			}
			
			
			
			
			//echo "IncomeSubjecttoTax=$IncomeSubjecttoTax, CurPeriodTaxableGain=$CurPeriodTaxableGain, UtilisedTaxLoss=$UtilisedTaxLoss, CurPeriodTaxableGain=$CurPeriodTaxableGain<br>";
            
            //echo "i = {$i} => {$OperatigExpTotal}<br>";
			
			$TotalTaxableAfterProperty	= floatval($Income) + floatval($IncomeSubjecttoTax); 
			
		    /*
		    if ($i == 1){
               	echo "TotalTaxableAfterProperty=$TotalTaxableAfterProperty<br>";
            }
		    */
			
			$TaxDue						= self::CalculateTaxAmt($TotalTaxableAfterProperty);    //Error here
			$TotalTaxAfterProperty      = $TaxDue; 
			/*
			if ($i == 1){
               	echo "TaxDue=$TaxDue<br>";
            }
            */
			
			//echo "TotalTaxableAfterProperty=$TotalTaxableAfterProperty, TaxDue=$TaxDue<br>";
			
			if (self::$CountryId == "3"){
			    $TaxReleif              = $AnnualInterest * 0.2;
			    $TaxDue					= $TaxDue - floatval($TaxReleif);
			}
			
			
			$TaxDifferential			= floatval($TaxDue) - floatval($TaxAmt); 
			
			//echo "TaxDue=$TaxDue, TaxAmt=$TaxAmt<br>";
			
			if (self::$CountryId == "2" ){//and self::$ResidentStatus == "NRI"
			    $TaxDue					= $TaxDifferential;
			}
			else if (self::$CountryId == "1" || self::$CountryId == "3"){     //Note: Need to check all countries whether coming correct or not?
			    $TaxDue					= $TaxDifferential;
			}
			
		
			
			
			
			//Copied from top (start) ..
			if (self::$CountryId == "1" || self::$CountryId == "2" ){   //|| self::$CountryId == "3"
    			$CurPeriodTaxableGain		= ($TotalTaxableAfterProperty > 0) ? $TotalTaxableAfterProperty : 0; 
    			$CurPeriodTaxableLoss		= ($TotalTaxableAfterProperty < 0) ? -1 * $TotalTaxableAfterProperty : 0; 
    			
    			$TaxableGain				= $CurPeriodTaxableGain; 

    			$TaxLossCfwdBalanceBEG		= $PrevTaxLossCfwdBalance; 
    			$UtilisedTaxLoss			= min( array( floatval($PrevTaxLossCfwdBalance) , floatval($TaxableGain) ) );
    
    			$TaxLossCfwdBalance			= floatval($PrevTaxLossCfwdBalance) + floatval($CurPeriodTaxableLoss) - floatval($UtilisedTaxLoss); 
    			$TaxPayable                 = ($TaxDue > 0) ? $TaxDue : 0; //$CurPeriodTaxableGain - floatval($UtilisedTaxLoss); 
    			
    		
			}
			else if(self::$CountryId == "3"){
			   
			    $CurPeriodTaxableGain		= ($TaxDue > 0) ? $TaxDue : 0; 
    			$CurPeriodTaxableLoss		= ($TaxDue < 0) ? -1 * $TaxDue : 0; 
    			
    			
    			
    			
    			
    			$TaxableGain				= $CurPeriodTaxableGain; 

    			$TaxLossCfwdBalanceBEG		= $PrevTaxLossCfwdBalance; 
    			$UtilisedTaxLoss			= min( array( floatval($PrevTaxLossCfwdBalance) , floatval($TaxableGain) ) );
    
    			$TaxLossCfwdBalance			= floatval($PrevTaxLossCfwdBalance) + floatval($CurPeriodTaxableLoss) - floatval($UtilisedTaxLoss); 
    			$TaxPayable                 = $CurPeriodTaxableGain - floatval($UtilisedTaxLoss); 
    			
    			
			}
			else{
			    $CurPeriodTaxableGain		= ($TaxDue > 0) ? $TaxDue : 0; 
    			$CurPeriodTaxableLoss		= ($TaxDue < 0) ? -1 * $TaxDue : 0; 
    			
    			
    			
    			$TaxableGain				= $CurPeriodTaxableGain; 

    			$TaxLossCfwdBalanceBEG		= $PrevTaxLossCfwdBalance; 
    			$UtilisedTaxLoss			= min( array( floatval($PrevTaxLossCfwdBalance) , floatval($TaxableGain) ) );
    
    			$TaxLossCfwdBalance			= floatval($PrevTaxLossCfwdBalance) + floatval($CurPeriodTaxableLoss) - floatval($UtilisedTaxLoss); 
    			$TaxPayable                 = $CurPeriodTaxableGain - floatval($UtilisedTaxLoss); 
			}
			
			//echo "CurPeriodTaxableGain=$CurPeriodTaxableGain<br>";

			
			//Copied from top (end)
			
			
			
			//$CurPeriodTaxableLoss       = ($TaxDue < 0) ? $TaxDue * -1 : 0;
           // if ($i == 1){
             //echo "GrossIncome=$GrossIncome,AnnualAppn=$AnnualAppn,OperatigExpTotal=$OperatigExpTotal,MortgagePayment=$MortgagePayment,TaxPayable=$TaxPayable<br>";
            //}
             
			$TotalAnnualReturn			= floatval($GrossIncome) + floatval($AnnualAppn) - floatval($OperatigExpTotal) - floatval($MortgagePayment); 
			$TotalAnnualReturnAfterTax	= floatval($GrossIncome) + floatval($AnnualAppn) - floatval($OperatigExpTotal) - floatval($MortgagePayment) - floatval($TaxPayable);    //replaced $TaxDifferential
            //$TotalAnnualReturnAfterTax	= floatval($GrossIncome) + floatval($AnnualAppn) - floatval($OperatigExpTotal) - floatval($MortgagePayment) - floatval($TaxDifferential); 
            

			if ($i == 1){
			    if ($CountryId == "3"){
			        //echo "TotalInitialCashCost=$TotalInitialCashCost,TotalAnnualReturnAfterTax=$TotalAnnualReturnAfterTax<br>";
    				$IRRTotalAnnualReturn		= (-1 * floatval($TotalInitialCashCost) ) + floatval($TotalAnnualReturn); 
    				$IRRTotalAnnualReturnAfterTax= (-1 * floatval($TotalInitialCashCost) ) + floatval($TotalAnnualReturnAfterTax); 
    				
    				//echo "TotInitCashCost=>" . (-1 * floatval($TotalInitialCashCost) ) . ", TotalAnnualReturn=$TotalAnnualReturn<br>";
			    }
			    else if ($CountryId == "2"){   //Added Newly
			        //echo "TotalAnnualReturn=$TotalAnnualReturn";
			        $IRRTotalAnnualReturn		= (-1 * floatval($TotalInitialCashCost) ) + floatval($TotalAnnualReturn); 
    				$IRRTotalAnnualReturnAfterTax= (-1 * floatval($TotalInitialCashCost) ) + floatval($TotalAnnualReturnAfterTax); 
			    }
			    else{
			        $IRRTotalAnnualReturn		= (-1 * floatval($TotalInitialCashCost) ) + floatval($TotalAnnualReturn); 
    				$IRRTotalAnnualReturnAfterTax= (-1 * floatval($TotalInitialCashCost) ) + floatval($TotalAnnualReturnAfterTax); 
			    }
			}
			else{
			    //echo "TotalAnnualReturn=$TotalAnnualReturn<br>";
				$IRRTotalAnnualReturn			= $TotalAnnualReturn; 
				$IRRTotalAnnualReturnAfterTax	= $TotalAnnualReturnAfterTax; 
			}
            
            //echo 'IRRTotalAnnualReturnAfterTax='. $IRRTotalAnnualReturnAfterTax;


			$FnCashFlowArr[$i]			= array("TotalInitialCashCost"			=> $TotalInitialCashCost,
			                                    "EffectiveStampDutyRate"        => $EffectiveStampDutyRate,
												"Rent"							=> $AnnualRental, 
												"Vacancy"						=> $Vacancy,
												"GrossIncome"					=> $GrossIncome,

												"LettingFee"					=> $LettingFeeAmt,
												"ManagementFees"				=> $ManagementFeesAmt,
												"CouncilPropertyTax"			=> $CouncilPropertyTaxAmt,
												"CodyCorporateService"			=> $CodyCorporateServiceAmt,
												"LandLeaseRentPa"				=> $LandLeaseRentPaAmt,
												"InsurancePa"					=> $InsurancePaAmt,
												"RepairandMaintenance"			=> $RepairandMaintenanceAmt,
												"CleaningPerMonth"				=> $CleaningPerMonthAmt,
												"GardeningPerMonth"				=> $GardeningPerMonthAmt,
												"ServiceContractsPa"			=> $ServiceContractsPaAmt,
												"Other"							=> $OtherAmt,
												"OperatigExpTotal"				=> $OperatigExpTotal,

												"MortgagePayment"				=> $MortgagePayment,
												"AnnualInterest"				=> $AnnualInterest,
												"AnnualPrincipal"				=> $AnnualPrincipal,

												"Fixtures"						=> $Fixtures,
												"Furnitures"					=> $Furnitures,
												"NonCashExpenses"				=> $NonCashExpenses,

												"NetCashFlow"					=> $NetCashFlow,

												"AnnualAppn"					=> $AnnualAppn,
												
												"IncomeTaxWithoutProperty"		=> $TaxAmt,
												"PropertyGainLossTaxable"		=> $PropertyGainLossTaxable,
												"CurPeriodTaxableGain"			=> $CurPeriodTaxableGain,
												"CurPeriodTaxableLoss"			=> $CurPeriodTaxableLoss,

												"TaxableGain"					=> $CurPeriodTaxableGain,
												"TaxLossCfwdBal"				=> $PrevTaxLossCfwdBalance,
												"UtilisedTaxLoss"				=> $UtilisedTaxLoss,
												"TaxLossCfwdBalanceBEG"			=> $TaxLossCfwdBalanceBEG,
												"TaxLossCfwdBalance"			=> $TaxLossCfwdBalance, //NZ Intonly Error in this field
												"IncomeSubjecttoTax"			=> $IncomeSubjecttoTax,

												"TotalTaxableAfterProperty"		=> $TotalTaxableAfterProperty,
												"TotalTaxAfterProperty"         => $TotalTaxAfterProperty,
												"TaxReleif"                     => $TaxReleif, 
												"TaxDue"						=> $TaxDue,
												"TaxDifferential"				=> $TaxDifferential,
												
												"TaxPayable"                    => $TaxPayable, //Newly added

												"TotalAnnualReturn"				=> $TotalAnnualReturn,
												"TotalAnnualReturnAfterTax"		=> $TotalAnnualReturnAfterTax,
												"IRRTotalAnnualReturn"			=> $IRRTotalAnnualReturn,
												"IRRTotalAnnualReturnAfterTax"	=> $IRRTotalAnnualReturnAfterTax,
											   ); 
		}
		
		//echo "<pre>"; print_r($FnCashFlowArr); echo "</pre>"; 
        //echo "<pre>"; print_r($TempMortgageArr); echo "</pre>"; 

		return $FnCashFlowArr;
	}

	public static function RoundAndFormat( $FnValue, $DecimalPoints = 0, $ReturnEmptyIfZero = true){

		if ($ReturnEmptyIfZero == true and floatval($FnValue) == 0)
			return "";

		return number_format(round($FnValue), $DecimalPoints); 
	}
	

    
    public static function AnalyzerResult($autoid ="",$HtmlArr = "HTML",$Compare = "")
    {
        
        if(isset($_GET['page']) && $_GET['page'] == "html")
        {
            \Html\HtmlClass::init();
            \settings\session\sessionClass::CheckSession(); 
    	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/propertyAnalysisReport.php" );
        }
        else
        {
            if ($Compare == "COMPARE"){
        
            self::PropComp($autoid);
    	  
        }else{
            
                
    		if($autoid!=""){
    	       
    	        self::getDbValues($autoid);
    	    }else{
    	         self::Init();
    	    }
            
            
        }
		
		$ArrQueries                             = array();
		
		//print_r($_SESSION); 

		//$user_id                                = \settings\session\sessionClass::GetSessionUserName();  //Copied from other class, Need to check
		$user_id                                = \settings\session\sessionClass::GetSessionDisplayName();  //Original Id Arzath 2020-08-02
		
		
		//echo $user_id;
        $property_id                            =  self::$property_id;
        $createddate                            = date("Y-m-d H:i:s");
        
        $QueryStr                               = " delete from property_analyzer where propertyid = :propertyid, userid = :userid"; 
        $ColValArr                              = array("propertyid" => $user_id, "propertyid" => $property_id);              
        $QueryArr                               = array($QueryStr, $ColValArr);
		$ArrQueries[]                           = $QueryArr;
		
        $FlagValue                              = isset( $_REQUEST["FlagValue"]) ?  $_REQUEST["FlagValue"] : ""; 
		//POST Values
		//&LocationId=&MyPortFolioName=tyedt&Subrub=&MyPortfolioPropAddress
		
		//echo self::$MyPortFolioName;
		
		
		$LocationId				            	= self::$LocationId;
		$MyPortFolioName				        = self::$MyPortFolioName;
		$Subrub				            	    = self::$Subrub;
		$MyPortfolioPropAddress         	    = self::$MyPortfolioPropAddress;
		
		$CountryId				            	= self::$CountryId;
		$Income 								= self::$Income;
		$MarketPrice 							= self::$MarketPrice;
		
		$DuvalDynamicPrice 						= self::$DuvalDynamicPrice; 
		$StampDuty 								= self::$StampDuty;
		$TransferFees 							= self::$TransferFees;
		$LegalFees 								= self::$LegalFees;
		$TotalPurchaseCost 						= self::$TotalPurchaseCost;
		$ResetrvationFees 						= self::$ResetrvationFees;
		$StagePay1Per							= self::$StagePay1Per;
		$StagePay1Amt							= self::$StagePay1Amt;
		$StagePay2Per							= self::$StagePay2Per;
		$StagePay2Amt							= self::$StagePay2Amt;
		$LoanAmountPer							= self::$LoanAmountPer;
		$Topup									= self::$Topup;
		$WeeklyRental							= self::$WeeklyRental;
		$VacancyRate							= self::$VacancyRate;

		
		$LettingFeeRate							= self::$LettingFeeRate;
		$ManagementFees							= self::$ManagementFees;
		$CouncilPropertyTax 					= self::$CouncilPropertyTax;
		$CodyCorporateServiceChg 				= self::$CodyCorporateServiceChg;
		$LandLeaseRentPa 						= self::$LandLeaseRentPa;
		$InsurancePa 							= self::$InsurancePa;
		$RepairandMaintenance 					= self::$RepairandMaintenance;
		$CleaningPerMonth 						= self::$CleaningPerMonth;
		$GardeningPerMonth 						= self::$GardeningPerMonth; 
		$ServiceContractsPa 					= self::$ServiceContractsPa;
		$Other 									= self::$Other;


		$LTV 									= self::$LTV;
		$InitialLoanAmt							= self::$InitialLoanAmt;
		$InterestRate							= self::$InterestRate;
		$TermYears								= self::$TermYears;
		$CPI									= self::$CPI;
		$RentalGrowth							= self::$RentalGrowth;
		$CapitalGrowth							= self::$CapitalGrowth;
		//$CapitalGrowthRate					= isset($_REQUEST["CapitalGrowthRate"]) 		? $_REQUEST["CapitalGrowthRate"] : 0; 
		$Purchaseprice 							= self::$Purchaseprice;
		$firsttimebuyer 						= self::$firsttimebuyer;
		$RentalGuarantee 						= self::$RentalGuarantee;
		$FurniturePackReq 						= self::$FurniturePackReq;
		$UnitSize 								= self::$UnitSize;
		$UnitType  								= self::$UnitType;
		
		$LeaseRegistration					    = self::$LeaseRegistration;
		$MortgageRegistration 					= self::$MortgageRegistration;
		$LandTransfer  							= self::$LandTransfer; 
		
		$DateBought		                        = self::$DateBought; 
    	$DateCompletion		                    = self::$DateCompletion;  
		
		


		$PurchasePrice							= floatval($DuvalDynamicPrice); 
		$CashDeposits							= floatval($ResetrvationFees) + floatval($StagePay1Amt) + floatval($StagePay2Amt) + floatval($Topup); 
		$TotalInitialCashRequirement			= floatval($CashDeposits) + floatval($TransferFees) + floatval($LegalFees) + floatval($LeaseRegistration) + floatval($MortgageRegistration) + floatval($LandTransfer); 

		$InitialPropertyValue					= floatval(str_replace(",", "", $MarketPrice));
		
		

		
		//$InitialLoanAmt							= 400000;
		//$InterestRate							= 4.5;
		//$TermYears								= 30;
		
		//echo "$InitialLoanAmt => $InterestRate => $TermYears";
		$MortgageArr							= self::CalculateMortgage( $InitialLoanAmt, $InterestRate, $TermYears ); 

		$CashFlowArr							= self::CashFlow( $InitialLoanAmt, $InterestRate, $TermYears ); 

        //echo "<pre>"; print_r($CashFlowArr); echo "</pre>"; 
        
		$TotalInitialCashCost					= $CashFlowArr["1"]["TotalInitialCashCost"]; 
		
		
		$EffectiveStampDutyRate					= $CashFlowArr["1"]["EffectiveStampDutyRate"]; 
		
		//echo "<pre>"; print_r($CashFlowArr); echo "</pre>"; 
		//exit;
		

		//Get IRR , IRR(After Tax) - Start
		$IRRArray								= array();
		$IRRAfterTaxArray						= array();
		
		foreach($CashFlowArr as $TempIRRArray){
			$IRRArray[]							= floatval($TempIRRArray["IRRTotalAnnualReturn"]);
			$IRRAfterTaxArray[]					= floatval($TempIRRArray["IRRTotalAnnualReturnAfterTax"]);
		}

		$f										= new \FinancialInterface\Financial();
        $IRR									= number_format( $f->IRR($IRRArray) * 100, 2, ".", "");
        $IRRAfterTax							= number_format( $f->IRR($IRRAfterTaxArray) * 100, 2, ".", "");
		//Get IRR , IRR(After Tax) - End 
		
		//echo "InitialPropertyValue=$InitialPropertyValue<br>";
		
		for ($i = 0; $i <= 10; $i++){
			if ($i == 0){
				$PropertyValue					= $InitialPropertyValue;
				$OutstandingMortgage			= 0; 
				$GrossIncome					= 0; 
				$LoanToValue					= 0; 
				$Equity							= 0; 
				$SurplusEquityBasedLTV			= 0;

				$AnnualAppn						= 0;
				$MortgagePayment				= 0;
				$AnnualInterest					= 0;
				$AnnualPrincipal				= 0;
				$NetCashFlow					= 0;
				$OperatigExpTotal				= 0;

				$EstimatedTax					= 0; 
				$TaxLossCfwdBalance				= 0; 
				$NetCashFlowAfterTax			= 0;
				$TotalAnnualReturnAfterTax		= 0;
			}
			else{
			    $PrevPropertyValue              = $PropertyValue;
				$PropertyValue					= floatval($PropertyValue) + (floatval($PropertyValue) * floatval($CapitalGrowth) / 100 ) ;

				$ArryPtr						= (intval($i) * 12) - 1; 
				$ArrCount						= sizeof($MortgageArr);

				
				if (self::$IntOrPrincipalInt == "InterestOnly"){
				    $OutstandingMortgage	    = floatval($InitialLoanAmt); 
				}
				else{
				    $OutstandingMortgage	    = floatval(isset($MortgageArr[$ArryPtr]["CloseBal"]) ? $MortgageArr[$ArryPtr]["CloseBal"] : 0); 
				}
				
				
				
				$GrossIncome					= $CashFlowArr[$i]["GrossIncome"]; 
				if ($PropertyValue > 0)
				    $LoanToValue					= round(floatval($OutstandingMortgage) / floatval($PropertyValue) * 100);
				else
				    $LoanToValue					= 0;
				    
				$Equity							= floatval($PropertyValue) - floatval($OutstandingMortgage);
				
                $PropertyValForSurpEqui         = $InitialPropertyValue;
                
                if ($CountryId == "2"){
                    $PropertyValForSurpEqui     = $PrevPropertyValue;
                    $SurplusEquRate             = 0.2;
                }
                else if ($CountryId == "3"){
                    $SurplusEquRate             = 0.3;
                }
                else{
                    $SurplusEquRate             = 0.2;
                }
                
				$SurplusEquityBasedLTV			= $Equity - ($PropertyValForSurpEqui * floatval($SurplusEquRate)); 
                //$SurplusEquityBasedLTV		= $Equity - ($InitialPropertyValue * 0.2); 

				$AnnualAppn						= floatval(isset($MortgageArr[$ArryPtr]["AnnualAppn"]) ? $MortgageArr[$ArryPtr]["AnnualAppn"] : 0);
				$TotalAnnualReturn              = $AnnualAppn;
				$NetCashFlow					= floatval($CashFlowArr[$i]["NetCashFlow"]);
				
				
				
				//echo "TotalAnnualReturn=$TotalAnnualReturn, ";
				//echo "<pre>"; print_r($MortgageArr); echo "</pre>";
				//MortgagePayment
				if ($CountryId == "1"){
				    $MortgagePayment			= floatval(isset($CashFlowArr[$i]["MortgagePayment"]) ? $CashFlowArr[$i]["MortgagePayment"] : 0);
				    $AnnualInterest				= floatval(isset($MortgageArr[$ArryPtr]["AnnualInterest"]) ? $MortgageArr[$ArryPtr]["AnnualInterest"] : 0);
				    $AnnualPrincipal			= floatval(isset($MortgageArr[$ArryPtr]["AnnualPrincipal"]) ? $MortgageArr[$ArryPtr]["AnnualPrincipal"] : 0);
				}
				else{
				    $MortgagePayment			= floatval(isset($MortgageArr[$ArryPtr]["Payable"]) ? $MortgageArr[$ArryPtr]["Payable"] : 0);
				    $AnnualInterest				= floatval(isset($MortgageArr[$ArryPtr]["AnnualInterest"]) ? $MortgageArr[$ArryPtr]["AnnualInterest"] : 0);
				    $AnnualPrincipal			= floatval(isset($MortgageArr[$ArryPtr]["AnnualPrincipal"]) ? $MortgageArr[$ArryPtr]["AnnualPrincipal"] : 0);
				}
				
				
				
				$OperatigExpTotal				= floatval($CashFlowArr[$i]["OperatigExpTotal"]);
				$NonCashExpenses				= floatval($CashFlowArr[$i]["NonCashExpenses"]);

				$EstimatedTax					= floatval($CashFlowArr[$i]["TaxPayable"]);    //floatval($CashFlowArr[$i]["TaxDifferential"]);
				$TaxLossCfwdBalance				= floatval($CashFlowArr[$i]["TaxLossCfwdBalance"]);
				$NetCashFlowAfterTax			= floatval($NetCashFlow) - floatval($EstimatedTax);
				
				//echo "TaxLossCfwdBalance=$TaxLossCfwdBalance<br>";
				
				
				
				if ($CountryId == "2"){
				    $TotalAnnualReturn          = $TotalAnnualReturn + $NetCashFlow;
				}
				else if ($CountryId == "3"){
				    $TotalAnnualReturn          = $TotalAnnualReturn + $NetCashFlow;
				}else if ($CountryId == "1"){
				    //echo "TotalAnnualReturn=$TotalAnnualReturn , GrossIncome=$GrossIncome , OperatigExpTotal= $OperatigExpTotal , MortgagePayment= $MortgagePayment<br>";
				    $TotalAnnualReturn          = $TotalAnnualReturn + $GrossIncome - $OperatigExpTotal - $MortgagePayment; //MortgagePayment
				    
				}

				$TotalAnnualReturnAfterTax		= floatval($CashFlowArr[$i]["TotalAnnualReturnAfterTax"]);		
				
				
			}
			
			
			
			$PurchasePriceTemp          = ($PurchasePrice == "") ? 0 : self::RoundAndFormat(floatval($PurchasePrice) );
			$TotalInitialCashCostTemp   = ($TotalInitialCashCost == "") ? 0 : self::RoundAndFormat(floatval($TotalInitialCashCost) );
		
			
			
			$TempArr                = array("propertyid" 						=> $property_id,
                                    		"userid" 							=> $user_id,
                                    		"createddate" 						=> $createddate,
                                    		"PurchasePrice"						=> (intval($i) == 0) ? $PurchasePriceTemp : 0,
											"TotalInitialCashCost"				=> (intval($i) == 0) ? $TotalInitialCashCostTemp : 0,
											"EffectiveStampDutyRate"			=> (intval($i) == 0) ? $EffectiveStampDutyRate : 0,
											"CapitalGrowth"						=> (intval($i) == 0) ? 0 : $CapitalGrowth,
											"CPI"								=> (intval($i) == 0) ? 0 : $CPI,
											"PropertyValue"						=> ($PropertyValue == "") ? 0 : self::RoundAndFormat(floatval($PropertyValue)),
											"OutstandingMortgage"				=> (intval($i) == 0) ? "" : ($OutstandingMortgage == "") ? 0 : self::RoundAndFormat( $OutstandingMortgage),
											"GrossIncome"						=> (intval($i) == 0) ? "" : ($GrossIncome == "") ? 0 : self::RoundAndFormat($GrossIncome),
											"LoanToValue"						=> (intval($i) == 0) ? "" : ($LoanToValue == "") ? 0 : self::RoundAndFormat($LoanToValue),
											"Equity"							=> (intval($i) == 0) ? "" : ($Equity == "") ? 0 : self::RoundAndFormat( $Equity),
											"SurplusEquityBasedLTV"				=> (intval($i) == 0) ? "" : ($SurplusEquityBasedLTV == "") ? 0 : self::RoundAndFormat( $SurplusEquityBasedLTV),
											"OperatigExpTotal"					=> (intval($i) == 0) ? "" : ($OperatigExpTotal == "") ? 0 : self::RoundAndFormat( $OperatigExpTotal),
											"NonCashExpenses"					=> (intval($i) == 0) ? "" : ($NonCashExpenses == "") ? 0 : self::RoundAndFormat( $NonCashExpenses),
											"MortgagePayment"					=> (intval($i) == 0) ? "" : ($MortgagePayment == "") ? 0 : self::RoundAndFormat( $MortgagePayment),											
											"AnnualInterest"					=> (intval($i) == 0) ? "" : ($AnnualInterest == "") ? 0 : self::RoundAndFormat( $AnnualInterest),											
											"AnnualPrincipal"					=> (intval($i) == 0) ? "" : ($AnnualPrincipal == "") ? 0 : self::RoundAndFormat( $AnnualPrincipal),
											"NetCashFlow"						=> (intval($i) == 0) ? "" : ($NetCashFlow == "") ? 0 : self::RoundAndFormat( $NetCashFlow),
											"AnnualAppn"					    => (intval($i) == 0) ? "" : ($AnnualAppn == "") ? 0 : self::RoundAndFormat( $AnnualAppn),											
											"TotalAnnualReturn"					=> (intval($i) == 0) ? "" : ($TotalAnnualReturn == "") ? 0 : self::RoundAndFormat( $TotalAnnualReturn),											
											"EstimatedTax"						=> (intval($i) == 0) ? "" : ($EstimatedTax == "") ? 0 : self::RoundAndFormat( $EstimatedTax),
											"EstCummulativeTaxCredit"			=> (intval($i) == 0) ? "" : ($TaxLossCfwdBalance == "") ? 0 : self::RoundAndFormat( $TaxLossCfwdBalance),
											"NetCashFlowAfterTax"				=> (intval($i) == 0) ? "" : ($NetCashFlowAfterTax == "") ? 0 : self::RoundAndFormat( $NetCashFlowAfterTax),
											"TotalAnnualReturnAfterTax"			=> (intval($i) == 0) ? "" : ($TotalAnnualReturnAfterTax == "") ? 0 : self::RoundAndFormat( $TotalAnnualReturnAfterTax),
											"NetCashFlowMonth"					=> (intval($i) == 0) ? "" : ($NetCashFlow == "") ? 0 : self::RoundAndFormat( $NetCashFlow/12),
											"TotalAnnualReturnMonth"			=> (intval($i) == 0) ? "" : ($TotalAnnualReturn == "") ? 0 : self::RoundAndFormat( $TotalAnnualReturn/12),											
											"EstimatedTaxMonth"					=> (intval($i) == 0) ? "" : ($EstimatedTax == "") ? 0 : self::RoundAndFormat( $EstimatedTax/12),
											"EstCummulativeTaxCreditMonth"		=> (intval($i) == 0) ? "" : ($TaxLossCfwdBalance == "") ? 0 : self::RoundAndFormat( $TaxLossCfwdBalance/12),
											"NetCashFlowAfterTaxMonth"			=> (intval($i) == 0) ? "" : ($NetCashFlowAfterTax == "") ? 0 : self::RoundAndFormat( $NetCashFlowAfterTax/12),
											"TotalAnnualReturnAfterTaxMonth"	=> (intval($i) == 0) ? "" : ($TotalAnnualReturnAfterTax == "") ? 0 : self::RoundAndFormat( $TotalAnnualReturnAfterTax/12),
											"IRR"	                            => $IRR,
											"IRRAfterTax"	                    => $IRRAfterTax,
										   );
										   
										   
            $ColValArr              = array("key_id" 						    => intval($i),
                                    		"propertyid" 						=> $property_id,
                                    		"userid" 							=> $user_id,
                                    		"createddate" 						=> $createddate,
                                    		"year_no"						    => intval($i),
											"PurchasePrice"						=> (intval($i) == 0) ? floatval( $PurchasePrice ) : 0,
											"TotalInitialCashCost"				=> (intval($i) == 0) ? floatval( $TotalInitialCashCost ) : 0,
											"EffectiveStampDutyRate"			=> (intval($i) == 0) ? $EffectiveStampDutyRate : 0,
											"CapitalGrowth"						=> (intval($i) == 0) ? 0 : $CapitalGrowth,
											"CPI"								=> (intval($i) == 0) ? 0 : $CPI,
											"PropertyValue"						=> ($PropertyValue == "") ? 0 : floatval($PropertyValue) ,
											"OutstandingMortgage"				=> floatval( $OutstandingMortgage),
											"GrossIncome"						=> floatval( $GrossIncome),
											"LoanToValue"						=> floatval( $LoanToValue),
											"Equity"							=> floatval( $Equity),
											"SurplusEquityBasedLTV"				=> floatval( $SurplusEquityBasedLTV),
											"OperatigExpTotal"					=> floatval( $OperatigExpTotal),
											"NonCashExpenses"					=> floatval( $NonCashExpenses),
											"MortgagePayment"					=> floatval( $MortgagePayment),											
											"AnnualInterest"					=> floatval( $AnnualInterest),											
											"AnnualPrincipal"					=> floatval( $AnnualPrincipal),
											"NetCashFlow"						=> floatval( $NetCashFlow),
											"AnnualAppn"					    => floatval( $AnnualAppn),											
											"TotalAnnualReturn"					=> floatval( $TotalAnnualReturn),											
											"EstimatedTax"						=> floatval( $EstimatedTax),
											"EstCummulativeTaxCredit"			=> floatval( $TaxLossCfwdBalance),
											"NetCashFlowAfterTax"				=> floatval( $NetCashFlowAfterTax),
											"TotalAnnualReturnAfterTax"			=> floatval( $TotalAnnualReturnAfterTax),
											"NetCashFlowMonth"					=> floatval( $NetCashFlow/12),
											"TotalAnnualReturnMonth"			=> floatval( $TotalAnnualReturn/12),											
											"EstimatedTaxMonth"					=> floatval( $EstimatedTax/12),
											"EstCummulativeTaxCreditMonth"		=> floatval( $TaxLossCfwdBalance/12),
											"NetCashFlowAfterTaxMonth"			=> floatval( $NetCashFlowAfterTax/12),
											"TotalAnnualReturnAfterTaxMonth"	=> floatval( $TotalAnnualReturnAfterTax/12),
											"IRR"	                            => $IRR,
											"IRRAfterTax"	                    => $IRRAfterTax,
										   );
										   
										   
            $QueryStr               = " insert into property_analyzer set propertyid = :propertyid, userid = :userid, year_no=:year_no, PurchasePrice = :PurchasePrice, 
                                        TotalInitialCashCost = :TotalInitialCashCost, EffectiveStampDutyRate = :EffectiveStampDutyRate, CapitalGrowth = :CapitalGrowth, 
                                        CPI = :CPI, PropertyValue = :PropertyValue, OutstandingMortgage = :OutstandingMortgage, GrossIncome = :GrossIncome, 
                                        LoanToValue = :LoanToValue, Equity = :Equity, SurplusEquityBasedLTV = :SurplusEquityBasedLTV, OperatigExpTotal = :OperatigExpTotal, 
                                        NonCashExpenses = :NonCashExpenses, MortgagePayment = :MortgagePayment, AnnualInterest = :AnnualInterest, 
                                        AnnualPrincipal = :AnnualPrincipal, NetCashFlow = :NetCashFlow, AnnualAppn = :AnnualAppn, TotalAnnualReturn = :TotalAnnualReturn, 
                                        EstimatedTax = :EstimatedTax, EstCummulativeTaxCredit = :EstCummulativeTaxCredit, NetCashFlowAfterTax = :NetCashFlowAfterTax, 
                                        TotalAnnualReturnAfterTax = :TotalAnnualReturnAfterTax, NetCashFlowMonth = :NetCashFlowMonth, TotalAnnualReturnMonth = :TotalAnnualReturnMonth, 
                                        EstimatedTaxMonth = :EstimatedTaxMonth, EstCummulativeTaxCreditMonth = :EstCummulativeTaxCreditMonth, NetCashFlowAfterTaxMonth = :NetCashFlowAfterTaxMonth, 
                                        TotalAnnualReturnAfterTaxMonth = :TotalAnnualReturnAfterTaxMonth, createddate = :createddate"; 
                                        
            $QueryArr               =   array($QueryStr, $ColValArr);
			$ArrQueries[]           =   $QueryArr;
			
			$ValueArr[]          = $TempArr;
			$ValueArrColArr[]    = $ColValArr;
		}
		
		//echo "<pre>"; print_r($ValueArr); echo "</pre>";
		
		
	    if ( $HtmlArr == "ARRAY" ) {
	          
	          return $ValueArrColArr;
	          exit;
	        
	    }else{
    		
    		$Msg                        = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
    		
    		if ($Msg == "success"){
                //$Msg    =   "Inserted Successfully.";
            }
            else{
                //$Msg    =    "Error on Insert";
            }
            
            
            //$ChkCntArr               			= \DBConn\DBConnection::getQueryFetchColumn("(SELECT CURRENCY FROM country_master WHERE COUNTRY_CODE ='{$countryid}')");
           // $Currency             				= $ChkCntArr["0"];
    		
            //https://duvalknowledge.com/PropTech/Property/PropertyFullDtl.html?id=&countryid=NZ&LocationId=&MyPortFolioName=tyedt&Subrub=&MyPortfolioPropAddress= Url link
                
                 \ajax\ajaxClass::Init();
            
                $PurchasePriceClass                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["PurchasePrice"]); 
                $TotalInitialCashCostClass          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["TotalInitialCashCost"]); 
                $EffectiveStampDutyRateClass        =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["EffectiveStampDutyRate"]); 
                
                $CapitalGrowthClass1                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["CapitalGrowth"]); 
                $CapitalGrowthClass2                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["CapitalGrowth"]); 
                $CapitalGrowthClass3                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["CapitalGrowth"]); 
                $CapitalGrowthClass4                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["CapitalGrowth"]); 
                $CapitalGrowthClass5                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["CapitalGrowth"]); 
                $CapitalGrowthClass6                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["CapitalGrowth"]); 
                $CapitalGrowthClass7                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["CapitalGrowth"]); 
                $CapitalGrowthClass8                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["CapitalGrowth"]); 
                $CapitalGrowthClass9                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["CapitalGrowth"]); 
                $CapitalGrowthClass10               =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["CapitalGrowth"]); 
                
                
                $CPIClass1                          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["CPI"]);
                $CPIClass2                          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["CPI"]);
                $CPIClass3                          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["CPI"]);
                $CPIClass4                          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["CPI"]);
                $CPIClass5                          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["CPI"]);
                $CPIClass6                          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["CPI"]);
                $CPIClass7                          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["CPI"]);
                $CPIClass8                          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["CPI"]);
                $CPIClass9                          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["CPI"]);
                $CPIClass10                         =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["CPI"]);
                
                $PropertyValueClass0                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["PropertyValue"]);
                $PropertyValueClass1                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["PropertyValue"]);
                $PropertyValueClass2                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["PropertyValue"]);
                $PropertyValueClass3                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["PropertyValue"]);
                $PropertyValueClass4                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["PropertyValue"]);
                $PropertyValueClass5                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["PropertyValue"]);
                $PropertyValueClass6                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["PropertyValue"]);
                $PropertyValueClass7                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["PropertyValue"]);
                $PropertyValueClass8                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["PropertyValue"]);
                $PropertyValueClass9                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["PropertyValue"]);
                $PropertyValueClass10               =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["PropertyValue"]);
                
                //echo 'OutstandingMortgage='. $ValueArr[0]["OutstandingMortgage"];
                
                $OutstandingMortgageClass0          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["OutstandingMortgage"]);
                $OutstandingMortgageClass1          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["OutstandingMortgage"]);
                $OutstandingMortgageClass2          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["OutstandingMortgage"]);
                $OutstandingMortgageClass3          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["OutstandingMortgage"]);
                $OutstandingMortgageClass4          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["OutstandingMortgage"]);
                $OutstandingMortgageClass5          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["OutstandingMortgage"]);
                $OutstandingMortgageClass6          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["OutstandingMortgage"]);
                $OutstandingMortgageClass7          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["OutstandingMortgage"]);
                $OutstandingMortgageClass8          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["OutstandingMortgage"]);
                $OutstandingMortgageClass9          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["OutstandingMortgage"]);
                $OutstandingMortgageClass10         =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["OutstandingMortgage"]);
                
                $GrossIncomeClass0                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["GrossIncome"]);
                $GrossIncomeClass1                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["GrossIncome"]);
                $GrossIncomeClass2                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["GrossIncome"]);
                $GrossIncomeClass3                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["GrossIncome"]);
                $GrossIncomeClass4                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["GrossIncome"]);
                $GrossIncomeClass5                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["GrossIncome"]);
                $GrossIncomeClass6                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["GrossIncome"]);
                $GrossIncomeClass7                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["GrossIncome"]);
                $GrossIncomeClass8                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["GrossIncome"]);
                $GrossIncomeClass9                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["GrossIncome"]);
                $GrossIncomeClass10                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["GrossIncome"]);
                
                $LoanToValueClass0                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["LoanToValue"]);
                $LoanToValueClass1                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["LoanToValue"]);
                $LoanToValueClass2                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["LoanToValue"]);
                $LoanToValueClass3                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["LoanToValue"]);
                $LoanToValueClass4                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["LoanToValue"]);
                $LoanToValueClass5                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["LoanToValue"]);
                $LoanToValueClass6                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["LoanToValue"]);
                $LoanToValueClass7                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["LoanToValue"]);
                $LoanToValueClass8                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["LoanToValue"]);
                $LoanToValueClass9                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["LoanToValue"]);
                $LoanToValueClass10                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["LoanToValue"]);
                
                $EquityClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["Equity"]);
                $EquityClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["Equity"]);
                $EquityClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["Equity"]);
                $EquityClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["Equity"]);
                $EquityClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["Equity"]);
                $EquityClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["Equity"]);
                $EquityClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["Equity"]);
                $EquityClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["Equity"]);
                $EquityClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["Equity"]);
                $EquityClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["Equity"]);
                $EquityClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["Equity"]);
                        
                
                $SurplusEquityBasedLTVClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["SurplusEquityBasedLTV"]);
                $SurplusEquityBasedLTVClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["SurplusEquityBasedLTV"]);
                $SurplusEquityBasedLTVClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["SurplusEquityBasedLTV"]);
                $SurplusEquityBasedLTVClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["SurplusEquityBasedLTV"]);
                $SurplusEquityBasedLTVClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["SurplusEquityBasedLTV"]);
                $SurplusEquityBasedLTVClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["SurplusEquityBasedLTV"]);
                $SurplusEquityBasedLTVClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["SurplusEquityBasedLTV"]);
                $SurplusEquityBasedLTVClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["SurplusEquityBasedLTV"]);
                $SurplusEquityBasedLTVClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["SurplusEquityBasedLTV"]);
                $SurplusEquityBasedLTVClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["SurplusEquityBasedLTV"]);
                $SurplusEquityBasedLTVClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["SurplusEquityBasedLTV"]);
                
                
                $AnnualAppnClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["AnnualAppn"]);
                $AnnualAppnClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["AnnualAppn"]);
                $AnnualAppnClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["AnnualAppn"]);
                $AnnualAppnClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["AnnualAppn"]);
                $AnnualAppnClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["AnnualAppn"]);
                $AnnualAppnClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["AnnualAppn"]);
                $AnnualAppnClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["AnnualAppn"]);
                $AnnualAppnClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["AnnualAppn"]);
                $AnnualAppnClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["AnnualAppn"]);
                $AnnualAppnClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["AnnualAppn"]);
                $AnnualAppnClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["AnnualAppn"]);
                
                
                $NetCashFlowClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["NetCashFlow"]);
                $NetCashFlowClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["NetCashFlow"]);
                $NetCashFlowClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["NetCashFlow"]);
                $NetCashFlowClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["NetCashFlow"]);
                $NetCashFlowClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["NetCashFlow"]);
                $NetCashFlowClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["NetCashFlow"]);
                $NetCashFlowClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["NetCashFlow"]);
                $NetCashFlowClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["NetCashFlow"]);
                $NetCashFlowClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["NetCashFlow"]);
                $NetCashFlowClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["NetCashFlow"]);
                $NetCashFlowClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["NetCashFlow"]);
                
                
                $TotalAnnualReturnClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["TotalAnnualReturn"]);
                $TotalAnnualReturnClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["TotalAnnualReturn"]);
                $TotalAnnualReturnClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["TotalAnnualReturn"]);
                $TotalAnnualReturnClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["TotalAnnualReturn"]);
                $TotalAnnualReturnClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["TotalAnnualReturn"]);
                $TotalAnnualReturnClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["TotalAnnualReturn"]);
                $TotalAnnualReturnClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["TotalAnnualReturn"]);
                $TotalAnnualReturnClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["TotalAnnualReturn"]);
                $TotalAnnualReturnClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["TotalAnnualReturn"]);
                $TotalAnnualReturnClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["TotalAnnualReturn"]);
                $TotalAnnualReturnClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["TotalAnnualReturn"]);
                
                
                $EstimatedTaxClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["EstimatedTax"]);
                $EstimatedTaxClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["EstimatedTax"]);
                $EstimatedTaxClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["EstimatedTax"]);
                $EstimatedTaxClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["EstimatedTax"]);
                $EstimatedTaxClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["EstimatedTax"]);
                $EstimatedTaxClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["EstimatedTax"]);
                $EstimatedTaxClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["EstimatedTax"]);
                $EstimatedTaxClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["EstimatedTax"]);
                $EstimatedTaxClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["EstimatedTax"]);
                $EstimatedTaxClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["EstimatedTax"]);
                $EstimatedTaxClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["EstimatedTax"]);
                
                
                
                
                $EstCummulativeTaxCreditClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["EstCummulativeTaxCredit"]);
                $EstCummulativeTaxCreditClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["EstCummulativeTaxCredit"]);
                $EstCummulativeTaxCreditClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["EstCummulativeTaxCredit"]);
                $EstCummulativeTaxCreditClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["EstCummulativeTaxCredit"]);
                $EstCummulativeTaxCreditClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["EstCummulativeTaxCredit"]);
                $EstCummulativeTaxCreditClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["EstCummulativeTaxCredit"]);
                $EstCummulativeTaxCreditClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["EstCummulativeTaxCredit"]);
                $EstCummulativeTaxCreditClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["EstCummulativeTaxCredit"]);
                $EstCummulativeTaxCreditClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["EstCummulativeTaxCredit"]);
                $EstCummulativeTaxCreditClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["EstCummulativeTaxCredit"]);
                $EstCummulativeTaxCreditClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["EstCummulativeTaxCredit"]);
                
                
                $NetCashFlowAfterTaxClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["NetCashFlowAfterTax"]);
                $NetCashFlowAfterTaxClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["NetCashFlowAfterTax"]);
                $NetCashFlowAfterTaxClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["NetCashFlowAfterTax"]);
                $NetCashFlowAfterTaxClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["NetCashFlowAfterTax"]);
                $NetCashFlowAfterTaxClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["NetCashFlowAfterTax"]);
                $NetCashFlowAfterTaxClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["NetCashFlowAfterTax"]);
                $NetCashFlowAfterTaxClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["NetCashFlowAfterTax"]);
                $NetCashFlowAfterTaxClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["NetCashFlowAfterTax"]);
                $NetCashFlowAfterTaxClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["NetCashFlowAfterTax"]);
                $NetCashFlowAfterTaxClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["NetCashFlowAfterTax"]);
                $NetCashFlowAfterTaxClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["NetCashFlowAfterTax"]);
                
                
                $TotalAnnualReturnAfterTaxClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["TotalAnnualReturnAfterTax"]);
                $TotalAnnualReturnAfterTaxClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["TotalAnnualReturnAfterTax"]);
                $TotalAnnualReturnAfterTaxClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["TotalAnnualReturnAfterTax"]);
                $TotalAnnualReturnAfterTaxClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["TotalAnnualReturnAfterTax"]);
                $TotalAnnualReturnAfterTaxClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["TotalAnnualReturnAfterTax"]);
                $TotalAnnualReturnAfterTaxClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["TotalAnnualReturnAfterTax"]);
                $TotalAnnualReturnAfterTaxClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["TotalAnnualReturnAfterTax"]);
                $TotalAnnualReturnAfterTaxClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["TotalAnnualReturnAfterTax"]);
                $TotalAnnualReturnAfterTaxClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["TotalAnnualReturnAfterTax"]);
                $TotalAnnualReturnAfterTaxClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["TotalAnnualReturnAfterTax"]);
                $TotalAnnualReturnAfterTaxClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["TotalAnnualReturnAfterTax"]);
                
                
                $NetCashFlowMonthClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["NetCashFlowMonth"]);
                $NetCashFlowMonthClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["NetCashFlowMonth"]);
                $NetCashFlowMonthClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["NetCashFlowMonth"]);
                $NetCashFlowMonthClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["NetCashFlowMonth"]);
                $NetCashFlowMonthClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["NetCashFlowMonth"]);
                $NetCashFlowMonthClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["NetCashFlowMonth"]);
                $NetCashFlowMonthClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["NetCashFlowMonth"]);
                $NetCashFlowMonthClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["NetCashFlowMonth"]);
                $NetCashFlowMonthClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["NetCashFlowMonth"]);
                $NetCashFlowMonthClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["NetCashFlowMonth"]);
                $NetCashFlowMonthClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["NetCashFlowMonth"]);
                
                
                $TotalAnnualReturnMonthClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["TotalAnnualReturnMonth"]);
                $TotalAnnualReturnMonthClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["TotalAnnualReturnMonth"]);
                $TotalAnnualReturnMonthClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["TotalAnnualReturnMonth"]);
                $TotalAnnualReturnMonthClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["TotalAnnualReturnMonth"]);
                $TotalAnnualReturnMonthClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["TotalAnnualReturnMonth"]);
                $TotalAnnualReturnMonthClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["TotalAnnualReturnMonth"]);
                $TotalAnnualReturnMonthClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["TotalAnnualReturnMonth"]);
                $TotalAnnualReturnMonthClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["TotalAnnualReturnMonth"]);
                $TotalAnnualReturnMonthClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["TotalAnnualReturnMonth"]);
                $TotalAnnualReturnMonthClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["TotalAnnualReturnMonth"]);
                $TotalAnnualReturnMonthClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["TotalAnnualReturnMonth"]);
                
                
                $EstimatedTaxMonthClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["EstimatedTaxMonth"]);
                $EstimatedTaxMonthClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["EstimatedTaxMonth"]);
                $EstimatedTaxMonthClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["EstimatedTaxMonth"]);
                $EstimatedTaxMonthClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["EstimatedTaxMonth"]);
                $EstimatedTaxMonthClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["EstimatedTaxMonth"]);
                $EstimatedTaxMonthClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["EstimatedTaxMonth"]);
                $EstimatedTaxMonthClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["EstimatedTaxMonth"]);
                $EstimatedTaxMonthClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["EstimatedTaxMonth"]);
                $EstimatedTaxMonthClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["EstimatedTaxMonth"]);
                $EstimatedTaxMonthClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["EstimatedTaxMonth"]);
                $EstimatedTaxMonthClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["EstimatedTaxMonth"]);
                
                
                $NetCashFlowAfterTaxMonthClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["NetCashFlowAfterTaxMonth"]);
                $NetCashFlowAfterTaxMonthClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["NetCashFlowAfterTaxMonth"]);
                $NetCashFlowAfterTaxMonthClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["NetCashFlowAfterTaxMonth"]);
                $NetCashFlowAfterTaxMonthClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["NetCashFlowAfterTaxMonth"]);
                $NetCashFlowAfterTaxMonthClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["NetCashFlowAfterTaxMonth"]);
                $NetCashFlowAfterTaxMonthClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["NetCashFlowAfterTaxMonth"]);
                $NetCashFlowAfterTaxMonthClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["NetCashFlowAfterTaxMonth"]);
                $NetCashFlowAfterTaxMonthClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["NetCashFlowAfterTaxMonth"]);
                $NetCashFlowAfterTaxMonthClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["NetCashFlowAfterTaxMonth"]);
                $NetCashFlowAfterTaxMonthClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["NetCashFlowAfterTaxMonth"]);
                $NetCashFlowAfterTaxMonthClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["NetCashFlowAfterTaxMonth"]);
                
                
                $TotalAnnualReturnAfterTaxMonthClass0                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["TotalAnnualReturnAfterTaxMonth"]);
                $TotalAnnualReturnAfterTaxMonthClass1                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["TotalAnnualReturnAfterTaxMonth"]);
                $TotalAnnualReturnAfterTaxMonthClass2                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["TotalAnnualReturnAfterTaxMonth"]);
                $TotalAnnualReturnAfterTaxMonthClass3                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["TotalAnnualReturnAfterTaxMonth"]);
                $TotalAnnualReturnAfterTaxMonthClass4                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["TotalAnnualReturnAfterTaxMonth"]);
                $TotalAnnualReturnAfterTaxMonthClass5                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["TotalAnnualReturnAfterTaxMonth"]);
                $TotalAnnualReturnAfterTaxMonthClass6                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["TotalAnnualReturnAfterTaxMonth"]);
                $TotalAnnualReturnAfterTaxMonthClass7                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["TotalAnnualReturnAfterTaxMonth"]);
                $TotalAnnualReturnAfterTaxMonthClass8                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["TotalAnnualReturnAfterTaxMonth"]);
                $TotalAnnualReturnAfterTaxMonthClass9                       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["TotalAnnualReturnAfterTaxMonth"]);
                $TotalAnnualReturnAfterTaxMonthClass10                      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["TotalAnnualReturnAfterTaxMonth"]);
                
                $IRRClass                                                   =        \ajax\ajaxClass::BelowZeroColor($IRR);
                $IRRAfterTaxClass                                           =        \ajax\ajaxClass::BelowZeroColor($IRRAfterTax);
                     
                     $CountryName ="";
               if( $CountryId != "")    {
                
                    $ChkNameArr   = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_NAME FROM country_master WHERE COUNTRY_CODE ='{$CountryId}')");
                    $CountryName    = $ChkNameArr["0"];
               }
               
               
               if ( $MyPortFolioName != "" || $MyPortfolioPropAddress != ""  || $Subrub != "" )
	             {
               
                   $PropDetails = " <table width='100%' class='table table-bordered final-table'>
                    		              <tr>
                    						 <td><b>Country Name</b></td>
                    						 <td><b>Property Name</b></td>
                    						 <td><b>Property Address</b></td>
                    						 <td><b>Location</b></td>
                    					  </tr>
                    					   <tr>
                    						 <td> ". $CountryName . "</td>
                    						 <td> ". $MyPortFolioName ."</td>
                    						 <td>". $MyPortfolioPropAddress ."</td>
                    						 <td>". $Subrub . "</td>
                    					  </tr>
                		            </table>";
	             }
	             
	             
	            //$TodayDate = date('Y-m-d');
               // $ChkAnalysisArr     = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(*) AS CNT FROM property_analyzer_inputs WHERE fromflag ='R' AND userid ='{$user_id}' and DATE_FORMAT(created_date, '%Y-%m-%d') ='{$TodayDate}')");
                //$RecentAnaysisCnt   = $ChkAnalysisArr["0"]; // Arzath - 2020-08-02
               
                //echo $user_id;
                
                //echo $FlagValue;
                
               
                    
                
                
                
                if($FlagValue != "R"){
                  $addvalue="ADD TO MY PORTFOLIO ";
                  $HiddenViewComapre = " Style='display:none;'  ";
                  $HiddenSaveProp = "";
                  $addUrl ="IsProtFolio=Y";
                }
                else
                {
                  $addvalue="ADD TO COMPARE";
                  $addUrl ="RecentAnalyse=Y";
                   $HiddenSaveProp = " Style='display:none;'  ";
                  $HiddenViewComapre = "";
                }
                  
    		echo "	<div class='table-responsive'>
    		            
    		            
    		            <button type='button' class='btn btn-primary' ><a href='javascript:AddToMyPortfolioFn();' style='font-size: 1.5em;color:white;' >". $addvalue ."</a></button> &nbsp;&nbsp;
    		            <button type='button' class='btn btn-primary' ". $HiddenSaveProp ." ><a href='". SITE_BASE_URL ."Portfolio/Portfolio.html' style='font-size: 1.5em;color:white;' >SAVED PROPERTIES</a></button>
    		            <button type='button' class='btn btn-primary' ". $HiddenViewComapre ." ><a href='". SITE_BASE_URL ."Portfolio/Portfolio.html?ViewCompare=R&IsEligible=Y&compareVal=Y' style='font-size: 1.5em;color:white;' >VIEW COMPARISON</a></button>
    		            <button type='button' class='btn btn-primary' ><a href='". SITE_BASE_URL ."Portfolio/ProtfolioPropDetails.html?".$addUrl."' style='font-size: 1.5em;color:white;' >BACK</a></button>
    		           
    		            
    		            
    		            ". $PropDetails ."
    				   <table width='100%' class='table table-bordered final-table'>
    					  <thead class='bg-dark'>
    						 <tr>
    							<td>Show all years (0-10) </td>
    							<td>Today</td>
    							<td>1</td>
    							<td>2</td>
    							<td>3</td>
    							<td>4</td>
    							<td>5</td>
    							<td>6</td>
    							<td>7</td>
    							<td>8</td>
    							<td>9</td>
    							<td>10</td>
    						 </tr>
    					  </thead>
    					  <tr class='heading-seprator bg-light'>
    						 <th colspan='12'>OVERVIEW</th>
    					  </tr>
    					  <tr>
    						 <td>Purchase Price</td>
    						 <td ". $PurchasePriceClass ." >" . $ValueArr[0]["PurchasePrice"] . "</td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    					  </tr>
    					  <tr>
    						 <td>Total Initial Cash Requirement</td>
    						 <td ". $TotalInitialCashCostClass .">" .  $ValueArr[0]["TotalInitialCashCost"] . "</td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    					  </tr>
    					  <tr>
    						 <td>Effective Stamp Duty Rate</td>
    						 <td ". $EffectiveStampDutyRateClass ." >" .  $ValueArr[0]["EffectiveStampDutyRate"] . "%</td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    						 <td></td>
    					  </tr>
    					  <tr>
    						 <td>Capital Growth Rate</td>
    						 <td></td>
    						 <td ". $CapitalGrowthClass1 .">" .  $ValueArr[1]["CapitalGrowth"] . "%</td>
    						 <td ". $CapitalGrowthClass2 .">" .  $ValueArr[2]["CapitalGrowth"] . "%</td>
    						 <td ". $CapitalGrowthClass3 .">" .  $ValueArr[3]["CapitalGrowth"] . "%</td>
    						 <td ". $CapitalGrowthClass4 .">" .  $ValueArr[4]["CapitalGrowth"] . "%</td>
    						 <td ". $CapitalGrowthClass5 .">" .  $ValueArr[5]["CapitalGrowth"] . "%</td>
    						 <td ". $CapitalGrowthClass6 .">" .  $ValueArr[6]["CapitalGrowth"] . "%</td>
    						 <td ". $CapitalGrowthClass7 .">" .  $ValueArr[7]["CapitalGrowth"] . "%</td>
    						 <td ". $CapitalGrowthClass8 .">" .  $ValueArr[8]["CapitalGrowth"] . "%</td>
    						 <td ". $CapitalGrowthClass9 .">" .  $ValueArr[9]["CapitalGrowth"] . "%</td>
    						 <td ". $CapitalGrowthClass10 .">" .  $ValueArr[10]["CapitalGrowth"] . "%</td>
    					  </tr>
    					  <tr>
    						 <td>CPI</td>
    						 <td></td>
    						 <td ".$CPIClass1.">" .  $ValueArr[1]["CPI"] . "%</td>
    						 <td ".$CPIClass2.">" .  $ValueArr[2]["CPI"] . "%</td>
    						 <td ".$CPIClass3.">" .  $ValueArr[3]["CPI"] . "%</td>
    						 <td ".$CPIClass4.">" .  $ValueArr[4]["CPI"] . "%</td>
    						 <td ".$CPIClass5.">" .  $ValueArr[5]["CPI"] . "%</td>
    						 <td ".$CPIClass6.">" .  $ValueArr[6]["CPI"] . "%</td>
    						 <td ".$CPIClass7.">" .  $ValueArr[7]["CPI"] . "%</td>
    						 <td ".$CPIClass8.">" .  $ValueArr[8]["CPI"] . "%</td>
    						 <td ".$CPIClass9.">" .  $ValueArr[9]["CPI"] . "%</td>
    						 <td ".$CPIClass10.">" .  $ValueArr[10]["CPI"] ."%</td>
    					  </tr>
    					  <tr>
    						 <td>Property Value</td>
    						 <td ". $PropertyValueClass0 .">" .  $ValueArr[0]["PropertyValue"] . "</td>
    						 <td ". $PropertyValueClass1 .">" .  $ValueArr[1]["PropertyValue"] . "</td>
    						 <td ". $PropertyValueClass2 .">" .  $ValueArr[2]["PropertyValue"] . "</td>
    						 <td ". $PropertyValueClass3 .">" .  $ValueArr[3]["PropertyValue"] . "</td>
    						 <td ". $PropertyValueClass4 .">" .  $ValueArr[4]["PropertyValue"] . "</td>
    						 <td ". $PropertyValueClass5 .">" .  $ValueArr[5]["PropertyValue"] . "</td>
    						 <td ". $PropertyValueClass6 .">" .  $ValueArr[6]["PropertyValue"] . "</td>
    						 <td ". $PropertyValueClass7 .">" .  $ValueArr[7]["PropertyValue"] . "</td>
    						 <td ". $PropertyValueClass8 .">" .  $ValueArr[8]["PropertyValue"] . "</td>
    						 <td ". $PropertyValueClass9 .">" .  $ValueArr[9]["PropertyValue"] . "</td>
    						 <td ". $PropertyValueClass10 .">" . $ValueArr[10]["PropertyValue"] ."</td>
    					  </tr>
    					  <tr>
    						 <td>Outstanding Mortgage</td>
    						 <td ". $OutstandingMortgageClass0 .">" .  $ValueArr[0]["OutstandingMortgage"] . "</td>
    						 <td ". $OutstandingMortgageClass1 .">" .  $ValueArr[1]["OutstandingMortgage"] . "</td>
    						 <td ". $OutstandingMortgageClass2 .">" .  $ValueArr[2]["OutstandingMortgage"] . "</td>
    						 <td ". $OutstandingMortgageClass3 .">" .  $ValueArr[3]["OutstandingMortgage"] . "</td>
    						 <td ". $OutstandingMortgageClass4 .">" .  $ValueArr[4]["OutstandingMortgage"] . "</td>
    						 <td ". $OutstandingMortgageClass5 .">" .  $ValueArr[5]["OutstandingMortgage"] . "</td>
    						 <td ". $OutstandingMortgageClass6 .">" .  $ValueArr[6]["OutstandingMortgage"] . "</td>
    						 <td ". $OutstandingMortgageClass7 .">" .  $ValueArr[7]["OutstandingMortgage"] . "</td>
    						 <td ". $OutstandingMortgageClass8 .">" .  $ValueArr[8]["OutstandingMortgage"] . "</td>
    						 <td ". $OutstandingMortgageClass9 .">" .  $ValueArr[9]["OutstandingMortgage"] . "</td>
    						 <td ". $OutstandingMortgageClass10 .">" .  $ValueArr[10]["OutstandingMortgage"] ."</td>
    					  </tr>
    					  <tr>
    						 <td>Gross Income</td>
    						 <td ". $GrossIncomeClass0 .">" .  $ValueArr[0]["GrossIncome"] . "</td>
    						 <td ". $GrossIncomeClass1 .">" .  $ValueArr[1]["GrossIncome"] . "</td>
    						 <td ". $GrossIncomeClass2 .">" .  $ValueArr[2]["GrossIncome"] . "</td>
    						 <td ". $GrossIncomeClass3 .">" .  $ValueArr[3]["GrossIncome"] . "</td>
    						 <td ". $GrossIncomeClass4 .">" .  $ValueArr[4]["GrossIncome"] . "</td>
    						 <td ". $GrossIncomeClass5 .">" .  $ValueArr[5]["GrossIncome"] . "</td>
    						 <td ". $GrossIncomeClass6 .">" .  $ValueArr[6]["GrossIncome"] . "</td>
    						 <td ". $GrossIncomeClass7 .">" .  $ValueArr[7]["GrossIncome"] . "</td>
    						 <td ". $GrossIncomeClass8 .">" .  $ValueArr[8]["GrossIncome"] . "</td>
    						 <td ". $GrossIncomeClass9 .">" .  $ValueArr[9]["GrossIncome"] . "</td>
    						 <td ". $GrossIncomeClass10 .">" .  $ValueArr[10]["GrossIncome"] ."</td>
    					  </tr>
    					  <tr class='heading-seprator bg-light'>
    						 <th colspan='12'>Equity</th>
    					  </tr>
    					  <tr>
    						 <td>Loan to Value</td>
    						 <td ". $LoanToValueClass0 .">" .  $ValueArr[0]["LoanToValue"] . "</td>
    						 <td ". $LoanToValueClass1 .">" .  $ValueArr[1]["LoanToValue"] . "%</td>
    						 <td ". $LoanToValueClass2 .">" .  $ValueArr[2]["LoanToValue"] . "%</td>
    						 <td ". $LoanToValueClass3 .">" .  $ValueArr[3]["LoanToValue"] . "%</td>
    						 <td ". $LoanToValueClass4 .">" .  $ValueArr[4]["LoanToValue"] . "%</td>
    						 <td ". $LoanToValueClass5 .">" .  $ValueArr[5]["LoanToValue"] . "%</td>
    						 <td ". $LoanToValueClass6 .">" .  $ValueArr[6]["LoanToValue"] . "%</td>
    						 <td ". $LoanToValueClass7 .">" .  $ValueArr[7]["LoanToValue"] . "%</td>
    						 <td ". $LoanToValueClass8 .">" .  $ValueArr[8]["LoanToValue"] . "%</td>
    						 <td ". $LoanToValueClass9 .">" .  $ValueArr[9]["LoanToValue"] . "%</td>
    						 <td ". $LoanToValueClass10 .">" .  $ValueArr[10]["LoanToValue"] ."%</td>
    					  </tr>
    					  <tr>
    						 <td>Equity</td>
    						 <td ". $EquityClass0 .">" .  $ValueArr[0]["Equity"] . "</td>
    						 <td ". $EquityClass1 .">" .  $ValueArr[1]["Equity"] . "</td>
    						 <td ". $EquityClass2 .">" .  $ValueArr[2]["Equity"] . "</td>
    						 <td ". $EquityClass3 .">" .  $ValueArr[3]["Equity"] . "</td>
    						 <td ". $EquityClass4 .">" .  $ValueArr[4]["Equity"] . "</td>
    						 <td ". $EquityClass5 .">" .  $ValueArr[5]["Equity"] . "</td>
    						 <td ". $EquityClass6 .">" .  $ValueArr[6]["Equity"] . "</td>
    						 <td ". $EquityClass7 .">" .  $ValueArr[7]["Equity"] . "</td>
    						 <td ". $EquityClass8 .">" .  $ValueArr[8]["Equity"] . "</td>
    						 <td ". $EquityClass9 .">" .  $ValueArr[9]["Equity"] . "</td>
    						 <td ". $EquityClass10 .">" .  $ValueArr[10]["Equity"] ."</td>
    					  </tr>
    					  <tr>
    						 <td>Surplus Equity Based on LTV (80%)</td>
    						 <td ". $SurplusEquityBasedLTVClass0 .">" .  $ValueArr[0]["SurplusEquityBasedLTV"] . "</td>
    						 <td ". $SurplusEquityBasedLTVClass1 .">" .  $ValueArr[1]["SurplusEquityBasedLTV"] . "</td>
    						 <td ". $SurplusEquityBasedLTVClass2 .">" .  $ValueArr[2]["SurplusEquityBasedLTV"] . "</td>
    						 <td ". $SurplusEquityBasedLTVClass3 .">" .  $ValueArr[3]["SurplusEquityBasedLTV"] . "</td>
    						 <td ". $SurplusEquityBasedLTVClass4 .">" .  $ValueArr[4]["SurplusEquityBasedLTV"] . "</td>
    						 <td ". $SurplusEquityBasedLTVClass5 .">" .  $ValueArr[5]["SurplusEquityBasedLTV"] . "</td>
    						 <td ". $SurplusEquityBasedLTVClass6 .">" .  $ValueArr[6]["SurplusEquityBasedLTV"] . "</td>
    						 <td ". $SurplusEquityBasedLTVClass7 .">" .  $ValueArr[7]["SurplusEquityBasedLTV"] . "</td>
    						 <td ". $SurplusEquityBasedLTVClass8 .">" .  $ValueArr[8]["SurplusEquityBasedLTV"] . "</td>
    						 <td ". $SurplusEquityBasedLTVClass9 .">" .  $ValueArr[9]["SurplusEquityBasedLTV"] . "</td>
    						 <td ". $SurplusEquityBasedLTVClass10 .">" .  $ValueArr[10]["SurplusEquityBasedLTV"] ."</td>
    					  </tr>
    					  <tr>
    						 <td>Annual Appreciation</td>
    						 <td ". $AnnualAppnClass0 .">" .  $ValueArr[0]["AnnualAppn"] . "</td>
    						 <td ". $AnnualAppnClass1 .">" .  $ValueArr[1]["AnnualAppn"] . "</td>
    						 <td ". $AnnualAppnClass2 .">" .  $ValueArr[2]["AnnualAppn"] . "</td>
    						 <td ". $AnnualAppnClass3 .">" .  $ValueArr[3]["AnnualAppn"] . "</td>
    						 <td ". $AnnualAppnClass4 .">" .  $ValueArr[4]["AnnualAppn"] . "</td>
    						 <td ". $AnnualAppnClass5 .">" .  $ValueArr[5]["AnnualAppn"] . "</td>
    						 <td ". $AnnualAppnClass6 .">" .  $ValueArr[6]["AnnualAppn"] . "</td>
    						 <td ". $AnnualAppnClass7 .">" .  $ValueArr[7]["AnnualAppn"] . "</td>
    						 <td ". $AnnualAppnClass8 .">" .  $ValueArr[8]["AnnualAppn"] . "</td>
    						 <td ". $AnnualAppnClass9 .">" .  $ValueArr[9]["AnnualAppn"] . "</td>
    						 <td ". $AnnualAppnClass10 .">" .  $ValueArr[10]["AnnualAppn"] ."</td>
    					  </tr>
    					  <tr class='heading-seprator bg-light'>
    						 <th colspan='12'>Income Analysis</th>
    					  </tr>
    					  <tr class='heading-seprator bg-light'>
    						 <th colspan='12'>Annual Income</th>
    					  </tr>
    					  <tr>  
    						 <td>Net Cashflow</td>
    						 <td ". $NetCashFlowClass0 .">" .  $ValueArr[0]["NetCashFlow"] . "</td> 
    						 <td ". $NetCashFlowClass1 .">" .  $ValueArr[1]["NetCashFlow"] . "</td>
    						 <td ". $NetCashFlowClass2 .">" .  $ValueArr[2]["NetCashFlow"] . "</td>
    						 <td ". $NetCashFlowClass3 .">" .  $ValueArr[3]["NetCashFlow"] . "</td>
    						 <td ". $NetCashFlowClass4 .">" .  $ValueArr[4]["NetCashFlow"] . "</td>
    						 <td ". $NetCashFlowClass5 .">" .  $ValueArr[5]["NetCashFlow"] . "</td>
    						 <td ". $NetCashFlowClass6 .">" .  $ValueArr[6]["NetCashFlow"] . "</td>
    						 <td ". $NetCashFlowClass7 .">" .  $ValueArr[7]["NetCashFlow"] . "</td>
    						 <td ". $NetCashFlowClass8 .">" .  $ValueArr[8]["NetCashFlow"] . "</td>
    						 <td ". $NetCashFlowClass9 .">" .  $ValueArr[9]["NetCashFlow"] . "</td>
    						 <td ". $NetCashFlowClass10 .">" .  $ValueArr[10]["NetCashFlow"] ."</td>
    					  </tr>
    					  <tr> 
    						 <td>Total Annual Return</td>
    						 <td ". $TotalAnnualReturnClass0 .">" .  $ValueArr[0]["TotalAnnualReturn"] . "</td>
    						 <td ". $TotalAnnualReturnClass1 .">" .  $ValueArr[1]["TotalAnnualReturn"] . "</td>
    						 <td ". $TotalAnnualReturnClass2 .">" .  $ValueArr[2]["TotalAnnualReturn"] . "</td>
    						 <td ". $TotalAnnualReturnClass3 .">" .  $ValueArr[3]["TotalAnnualReturn"] . "</td>
    						 <td ". $TotalAnnualReturnClass4 .">" .  $ValueArr[4]["TotalAnnualReturn"] . "</td>
    						 <td ". $TotalAnnualReturnClass5 .">" .  $ValueArr[5]["TotalAnnualReturn"] . "</td>
    						 <td ". $TotalAnnualReturnClass6 .">" .  $ValueArr[6]["TotalAnnualReturn"] . "</td>
    						 <td ". $TotalAnnualReturnClass7 .">" .  $ValueArr[7]["TotalAnnualReturn"] . "</td>
    						 <td ". $TotalAnnualReturnClass8 .">" .  $ValueArr[8]["TotalAnnualReturn"] . "</td>
    						 <td ". $TotalAnnualReturnClass9 .">" .  $ValueArr[9]["TotalAnnualReturn"] . "</td>
    						 <td ". $TotalAnnualReturnClass10 .">" .  $ValueArr[10]["TotalAnnualReturn"] ."</td>
    					  </tr>
    					  <tr class='text-primary'>
    						 <td>Estimated Tax</td>
    						 <td ". $EstimatedTaxClass0 .">" .  $ValueArr[0]["EstimatedTax"] . "</td> 
    						 <td ". $EstimatedTaxClass1 .">" .  $ValueArr[1]["EstimatedTax"] . "</td>
    						 <td ". $EstimatedTaxClass2 .">" .  $ValueArr[2]["EstimatedTax"] . "</td>
    						 <td ". $EstimatedTaxClass3 .">" .  $ValueArr[3]["EstimatedTax"] . "</td>
    						 <td ". $EstimatedTaxClass4 .">" .  $ValueArr[4]["EstimatedTax"] . "</td>
    						 <td ". $EstimatedTaxClass5 .">" .  $ValueArr[5]["EstimatedTax"] . "</td>
    						 <td ". $EstimatedTaxClass6 .">" .  $ValueArr[6]["EstimatedTax"] . "</td>
    						 <td ". $EstimatedTaxClass7 .">" .  $ValueArr[7]["EstimatedTax"] . "</td>
    						 <td ". $EstimatedTaxClass8 .">" .  $ValueArr[8]["EstimatedTax"] . "</td>
    						 <td ". $EstimatedTaxClass9 .">" .  $ValueArr[9]["EstimatedTax"] . "</td>
    						 <td ". $EstimatedTaxClass10 .">" . $ValueArr[10]["EstimatedTax"] ."</td>
    					  </tr>
    					  <tr class='text-primary'> 
    						 <td>Estimated Cumulative Tax Credit(s)</td>
    						 <td ". $EstCummulativeTaxCreditClass0 .">" .  $ValueArr[0]["EstCummulativeTaxCredit"] . "</td>
    						 <td ". $EstCummulativeTaxCreditClass1 .">" .  $ValueArr[1]["EstCummulativeTaxCredit"] . "</td>
    						 <td ". $EstCummulativeTaxCreditClass2 .">" .  $ValueArr[2]["EstCummulativeTaxCredit"] . "</td>
    						 <td ". $EstCummulativeTaxCreditClass3 .">" .  $ValueArr[3]["EstCummulativeTaxCredit"] . "</td>
    						 <td ". $EstCummulativeTaxCreditClass4 .">" .  $ValueArr[4]["EstCummulativeTaxCredit"] . "</td>
    						 <td ". $EstCummulativeTaxCreditClass5 .">" .  $ValueArr[5]["EstCummulativeTaxCredit"] . "</td>
    						 <td ". $EstCummulativeTaxCreditClass6 .">" .  $ValueArr[6]["EstCummulativeTaxCredit"] . "</td>
    						 <td ". $EstCummulativeTaxCreditClass7 .">" .  $ValueArr[7]["EstCummulativeTaxCredit"] . "</td>
    						 <td ". $EstCummulativeTaxCreditClass8 .">" .  $ValueArr[8]["EstCummulativeTaxCredit"] . "</td>
    						 <td ". $EstCummulativeTaxCreditClass9 .">" .  $ValueArr[9]["EstCummulativeTaxCredit"] . "</td>
    						 <td ". $EstCummulativeTaxCreditClass10 .">" . $ValueArr[10]["EstCummulativeTaxCredit"] ."</td>
    					  </tr>
    					  <tr>
    						 <td>Net Cashflow (after tax)</td> 
    						 <td ". $NetCashFlowAfterTaxClass0 .">" .  $ValueArr[0]["NetCashFlowAfterTax"] . "</td> 
    						 <td ". $NetCashFlowAfterTaxClass1 .">" .  $ValueArr[1]["NetCashFlowAfterTax"] . "</td>
    						 <td ". $NetCashFlowAfterTaxClass2 .">" .  $ValueArr[2]["NetCashFlowAfterTax"] . "</td>
    						 <td ". $NetCashFlowAfterTaxClass3 .">" .  $ValueArr[3]["NetCashFlowAfterTax"] . "</td>
    						 <td ". $NetCashFlowAfterTaxClass4 .">" .  $ValueArr[4]["NetCashFlowAfterTax"] . "</td>
    						 <td ". $NetCashFlowAfterTaxClass5 .">" .  $ValueArr[5]["NetCashFlowAfterTax"] . "</td>
    						 <td ". $NetCashFlowAfterTaxClass6 .">" .  $ValueArr[6]["NetCashFlowAfterTax"] . "</td>
    						 <td ". $NetCashFlowAfterTaxClass7 .">" .  $ValueArr[7]["NetCashFlowAfterTax"] . "</td>
    						 <td ". $NetCashFlowAfterTaxClass8 .">" .  $ValueArr[8]["NetCashFlowAfterTax"] . "</td>
    						 <td ". $NetCashFlowAfterTaxClass9 .">" .  $ValueArr[9]["NetCashFlowAfterTax"] . "</td>
    						 <td ". $NetCashFlowAfterTaxClass10 .">" . $ValueArr[10]["NetCashFlowAfterTax"] ."</td>
    					  </tr>
    					  <tr>
    						 <td>Total Annual Return (after tax)</td>
    						 <td ". $TotalAnnualReturnAfterTaxClass0 .">" .  $ValueArr[0]["TotalAnnualReturnAfterTax"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxClass1 .">" .  $ValueArr[1]["TotalAnnualReturnAfterTax"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxClass2 .">" .  $ValueArr[2]["TotalAnnualReturnAfterTax"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxClass3 .">" .  $ValueArr[3]["TotalAnnualReturnAfterTax"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxClass4 .">" .  $ValueArr[4]["TotalAnnualReturnAfterTax"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxClass5 .">" .  $ValueArr[5]["TotalAnnualReturnAfterTax"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxClass6 .">" .  $ValueArr[6]["TotalAnnualReturnAfterTax"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxClass7 .">" .  $ValueArr[7]["TotalAnnualReturnAfterTax"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxClass8 .">" .  $ValueArr[8]["TotalAnnualReturnAfterTax"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxClass9 .">" .  $ValueArr[9]["TotalAnnualReturnAfterTax"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxClass10 .">" . $ValueArr[10]["TotalAnnualReturnAfterTax"] ."</td>
    					  </tr>
    					  <tr class='heading-seprator bg-light'>
    						 <th colspan='12'>Monthly Income</th>
    					  </tr>
    					  <tr>
    						 <td>Net Cashflow</td>
    						 <td ". $NetCashFlowMonthClass0 .">" .  $ValueArr[0]["NetCashFlowMonth"] . "</td>
    						 <td ". $NetCashFlowMonthClass1 .">" .  $ValueArr[1]["NetCashFlowMonth"] . "</td>
    						 <td ". $NetCashFlowMonthClass2 .">" .  $ValueArr[2]["NetCashFlowMonth"] . "</td>
    						 <td ". $NetCashFlowMonthClass3 .">" .  $ValueArr[3]["NetCashFlowMonth"] . "</td>
    						 <td ". $NetCashFlowMonthClass4 .">" .  $ValueArr[4]["NetCashFlowMonth"] . "</td>
    						 <td ". $NetCashFlowMonthClass5 .">" .  $ValueArr[5]["NetCashFlowMonth"] . "</td>
    						 <td ". $NetCashFlowMonthClass6 .">" .  $ValueArr[6]["NetCashFlowMonth"] . "</td>
    						 <td ". $NetCashFlowMonthClass7 .">" .  $ValueArr[7]["NetCashFlowMonth"] . "</td>
    						 <td ". $NetCashFlowMonthClass8 .">" .  $ValueArr[8]["NetCashFlowMonth"] . "</td>
    						 <td ". $NetCashFlowMonthClass9 .">" .  $ValueArr[9]["NetCashFlowMonth"] . "</td>
    						 <td ". $NetCashFlowMonthClass10 .">" . $ValueArr[10]["NetCashFlowMonth"] ."</td>
    					  </tr>
    					  <tr>
    						 <td>Total Monthly Return</td>
    						 <td ". $TotalAnnualReturnMonthClass0 .">" .  $ValueArr[0]["TotalAnnualReturnMonth"] . "</td> 
    						 <td ". $TotalAnnualReturnMonthClass1 .">" .  $ValueArr[1]["TotalAnnualReturnMonth"] . "</td>
    						 <td ". $TotalAnnualReturnMonthClass2 .">" .  $ValueArr[2]["TotalAnnualReturnMonth"] . "</td>
    						 <td ". $TotalAnnualReturnMonthClass3 .">" .  $ValueArr[3]["TotalAnnualReturnMonth"] . "</td>
    						 <td ". $TotalAnnualReturnMonthClass4 .">" .  $ValueArr[4]["TotalAnnualReturnMonth"] . "</td>
    						 <td ". $TotalAnnualReturnMonthClass5 .">" .  $ValueArr[5]["TotalAnnualReturnMonth"] . "</td>
    						 <td ". $TotalAnnualReturnMonthClass6 .">" .  $ValueArr[6]["TotalAnnualReturnMonth"] . "</td>
    						 <td ". $TotalAnnualReturnMonthClass7 .">" .  $ValueArr[7]["TotalAnnualReturnMonth"] . "</td>
    						 <td ". $TotalAnnualReturnMonthClass8 .">" .  $ValueArr[8]["TotalAnnualReturnMonth"] . "</td>
    						 <td ". $TotalAnnualReturnMonthClass9 .">" .  $ValueArr[9]["TotalAnnualReturnMonth"] . "</td>
    						 <td ". $TotalAnnualReturnMonthClass10 .">" . $ValueArr[10]["TotalAnnualReturnMonth"] ."</td>
    					  </tr>
    					  <tr class='text-primary'>
    						 <td>Estimated Monthly Tax</td>  
    						 <td ". $EstimatedTaxMonthClass0 .">" .  $ValueArr[0]["EstimatedTaxMonth"] . "</td>
    						 <td ". $EstimatedTaxMonthClass1 .">" .  $ValueArr[1]["EstimatedTaxMonth"] . "</td>
    						 <td ". $EstimatedTaxMonthClass2 .">" .  $ValueArr[2]["EstimatedTaxMonth"] . "</td>
    						 <td ". $EstimatedTaxMonthClass3 .">" .  $ValueArr[3]["EstimatedTaxMonth"] . "</td>
    						 <td ". $EstimatedTaxMonthClass4 .">" .  $ValueArr[4]["EstimatedTaxMonth"] . "</td>
    						 <td ". $EstimatedTaxMonthClass5 .">" .  $ValueArr[5]["EstimatedTaxMonth"] . "</td>
    						 <td ". $EstimatedTaxMonthClass6 .">" .  $ValueArr[6]["EstimatedTaxMonth"] . "</td>
    						 <td ". $EstimatedTaxMonthClass7 .">" .  $ValueArr[7]["EstimatedTaxMonth"] . "</td>
    						 <td ". $EstimatedTaxMonthClass8 .">" .  $ValueArr[8]["EstimatedTaxMonth"] . "</td>
    						 <td ". $EstimatedTaxMonthClass9 .">" .  $ValueArr[9]["EstimatedTaxMonth"] . "</td>
    						 <td ". $EstimatedTaxMonthClass10 .">" . $ValueArr[10]["EstimatedTaxMonth"] ."</td>
    					  </tr>
    					  <tr>
    						 <td>Net Cashflow (after tax)</td>
    						 <td ". $NetCashFlowAfterTaxMonthClass0 .">" .  $ValueArr[0]["NetCashFlowAfterTaxMonth"] . "</td>
    						 <td ". $NetCashFlowAfterTaxMonthClass1 .">" .  $ValueArr[1]["NetCashFlowAfterTaxMonth"] . "</td>
    						 <td ". $NetCashFlowAfterTaxMonthClass2 .">" .  $ValueArr[2]["NetCashFlowAfterTaxMonth"] . "</td>
    						 <td ". $NetCashFlowAfterTaxMonthClass3 .">" .  $ValueArr[3]["NetCashFlowAfterTaxMonth"] . "</td>
    						 <td ". $NetCashFlowAfterTaxMonthClass4 .">" .  $ValueArr[4]["NetCashFlowAfterTaxMonth"] . "</td>
    						 <td ". $NetCashFlowAfterTaxMonthClass5 .">" .  $ValueArr[5]["NetCashFlowAfterTaxMonth"] . "</td>
    						 <td ". $NetCashFlowAfterTaxMonthClass6 .">" .  $ValueArr[6]["NetCashFlowAfterTaxMonth"] . "</td>
    						 <td ". $NetCashFlowAfterTaxMonthClass7 .">" .  $ValueArr[7]["NetCashFlowAfterTaxMonth"] . "</td>
    						 <td ". $NetCashFlowAfterTaxMonthClass8 .">" .  $ValueArr[8]["NetCashFlowAfterTaxMonth"] . "</td>
    						 <td ". $NetCashFlowAfterTaxMonthClass9 .">" .  $ValueArr[9]["NetCashFlowAfterTaxMonth"] . "</td>
    						 <td ". $NetCashFlowAfterTaxMonthClass10 .">" . $ValueArr[10]["NetCashFlowAfterTaxMonth"] ."</td>
    					  </tr>
    					  <tr>
    						 <td>Total Monthly Return (after tax)</td>
    						 <td ". $TotalAnnualReturnAfterTaxMonthClass0 .">" .  $ValueArr[0]["TotalAnnualReturnAfterTaxMonth"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxMonthClass1 .">" .  $ValueArr[1]["TotalAnnualReturnAfterTaxMonth"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxMonthClass2 .">" .  $ValueArr[2]["TotalAnnualReturnAfterTaxMonth"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxMonthClass3 .">" .  $ValueArr[3]["TotalAnnualReturnAfterTaxMonth"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxMonthClass4 .">" .  $ValueArr[4]["TotalAnnualReturnAfterTaxMonth"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxMonthClass5 .">" .  $ValueArr[5]["TotalAnnualReturnAfterTaxMonth"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxMonthClass6 .">" .  $ValueArr[6]["TotalAnnualReturnAfterTaxMonth"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxMonthClass7 .">" .  $ValueArr[7]["TotalAnnualReturnAfterTaxMonth"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxMonthClass8 .">" .  $ValueArr[8]["TotalAnnualReturnAfterTaxMonth"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxMonthClass9 .">" .  $ValueArr[9]["TotalAnnualReturnAfterTaxMonth"] . "</td>
    						 <td ". $TotalAnnualReturnAfterTaxMonthClass10 .">" . $ValueArr[10]["TotalAnnualReturnAfterTaxMonth"] ."</td>
    					  </tr>
    					  <tr class='heading-seprator bg-light'>
    						 <th colspan='12'>Return Analysis</th>
    					  </tr>
    					  <tr>
    						 <td>IRR</td>
    						 <td ". $IRRClass .">" .  $IRR . "%</td>  
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    					  </tr>
    					  <tr>
    						 <td>IRR (after tax)</td>
    						 <td ". $IRRAfterTaxClass .">" .  $IRRAfterTax . "%</td>  
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    						 <td>&nbsp;</td>
    					  </tr>
    				   </table>
    				</div>";
    				
    				
            $NetCashFlowSeries		                =	"";
            $EstimatedTaxSeries                     =   "";
            
            $NetCashFlowAfterTaxSeries              =   ""; 
            $TotalAnnualReturnSeries                =   ""; 
            $TotalAnnualReturnAfterTaxSeries        =   ""; 
            $PropertyValueSeries                    =   ""; 
            $OutstandingMortgageSeries              =   ""; 
    
            $Seperator				                =	"";
            
            for ($i = 1; $i <= 10; $i++){
            	if (intval($i) > 1)
            		$Seperator		                =	",";
            
            	$NetCashFlowSeries	                =	$NetCashFlowSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["NetCashFlow"]));
                $EstimatedTaxSeries                 =   $EstimatedTaxSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["EstimatedTax"]));
                $NetCashFlowAfterTaxSeries          =   $NetCashFlowAfterTaxSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["NetCashFlowAfterTax"]));
                $TotalAnnualReturnSeries            =   $TotalAnnualReturnSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["TotalAnnualReturn"]));
                $TotalAnnualReturnAfterTaxSeries    =   $TotalAnnualReturnAfterTaxSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["TotalAnnualReturnAfterTax"]));
                
                
                $PropertyValueSeries                =   $PropertyValueSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["PropertyValue"]));
                $OutstandingMortgageSeries          =   $OutstandingMortgageSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["OutstandingMortgage"]));
            }
    			  
    			  
    		//"RentalIncome"          => number_format( (intval($i) == 0) ? 0 : $RentalIncome, 2),
    		//"RentalYield"
    		
    		//$CapitalApprStr1        = implode(",", $CapitalApprArr1); 
    		//$CapitalApprStr3        = implode(",", $CapitalApprecRateArr);   
    		
    		//exit; 
    		
    		$ChkCntArr               			= \DBConn\DBConnection::getQueryFetchColumn("(SELECT CURRENCY FROM country_master WHERE COUNTRY_CODE ='{$CountryId}')");
            $Currency             				= $ChkCntArr["0"];
    		
    		$ChkSymbolArr               		= \DBConn\DBConnection::getQueryFetchColumn("(SELECT Currency_Symbol FROM country_master WHERE COUNTRY_CODE ='{$CountryId}')");
            $Symbol             			    = $ChkSymbolArr["0"];
            
            if ( $CountryId == "3")
    				$Symbol             	= "£";	
    				
    				
    		$CurrencySym             	=  $Symbol ." ".$Currency;		
    			  
    		echo '  <br><br>
    		        <h4 class="card-title">Annual Cashflow</h4>
    				<div id="chart"></div>';
    				
    	
            echo '  <h4 class="card-title">Capital Value versus Outstanding Mortgage</h4>
                        <div><canvas id="canvas"></canvas></div>';
                    
                   
                    
            echo " <script type='text/javascript' src='". SITE_BASE_URL ."assets/plugins/apexcharts/js/apexcharts.min.js'></script>
                    <script type='text/javascript'>
                            var options = {
                              series: [{
                              name: 'Total Annual Return',
                              data: [" . $TotalAnnualReturnSeries . "]
                            },{
                              name: 'Total Annual Return (after tax)',
                              data: [" . $TotalAnnualReturnAfterTaxSeries . "]
                            },
                              {
                              name: 'Net Cashflow',
                              data: [". $NetCashFlowSeries ."]
                            },{
                              name: 'Net Cashflow (after tax)',
                              data: [" . $NetCashFlowAfterTaxSeries . "]
                            },
                            
                            {
                              name: 'Estimated Tax',
                              data: [" . $EstimatedTaxSeries . "]
                            }],
                              chart: {
                              height: 450,
                              type: 'line'
                            },
                            dataLabels: {
                              enabled: false
                            },
                            stroke: {
                              curve: 'smooth',
                              lineCap: 'butt',
                              colors: undefined,
                              width: 3,
                              dashArray: 0, 
                            },
                            grid: {
                              row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                              },
                            },
                            yaxis: {
                              type: 'numeric',
                              title: {
                                text: '". $CurrencySym ."',
                                style: {
                                  fontSize:  '18px',
                                  fontWeight:  'bold',
                                  fontFamily:  undefined,
                                  color:  '#263238'
                                },
                              },
                              labels: {
                                show:true,
                                formatter: function (value) {
                                  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                                }
                              },
                    
                            },
                    
                            legend: {
                              position: 'bottom',
                              horizontalAlign: 'center',
                              offsetY: -5,
                              offsetX: -5
                            },
                            xaxis: {
                              // type: 'datetime',
                              title: {
                                text: 'Year',
                                style: {
                                  fontSize:  '18px',
                                  fontWeight:  'bold',
                                  fontFamily:  undefined,
                                  color:  '#263238'
                                },
                              },
                              categories:  [\"1\", \"2\", \"3\", \"4\", \"5\", \"6\", \"7\",\"8\",\"9\",\"10\"],
                              formatter: function (value) {
                                return value;
                              }
                            },
                            tooltip: {
                              x: {
                                show:true,
                                formatter: function (value) {
                                  return 'Year ' + value;
                                }
                              },
                               y: {
                                show:true,
                                formatter: function (value) {
                                  return '{$Symbol} ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                                }
                              },
                            },
                    
                            };
                    
                            var chart = new ApexCharts(document.querySelector('#chart'), options);
                            chart.render();
                            </script>";
                            
    				
    			echo "<script src='" . SITE_BASE_URL . "assets/plugins/chartjs/Chart.bundle.js'></script>
                     <script>
                              var ctx = document.getElementById('canvas').getContext('2d');
                              ctx.height = 250;
                              
                              var gradient = ctx.createLinearGradient(0, 0, 0, 400);
                                  gradient.addColorStop(0, 'rgba(33,150,243,1)');   
                                  gradient.addColorStop(1, 'rgba(33,150,243,.5)');
                              var gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
                                  gradient2.addColorStop(0, 'rgba(76,175,80,1)');   
                                  gradient2.addColorStop(1, 'rgba(76,175,80,.5)');    
                        
                                var myChart = new Chart(ctx, {
                                    type: 'line',
                                          data: {
                                              labels: [\"1\", \"2\", \"3\", \"4\", \"5\", \"6\", \"7\",\"8\",\"9\",\"10\"],
                                              datasets: [{
                                                  label: 'Capital Value', // Name the series
                                                  data: [". $PropertyValueSeries ."], // Specify the data values array
                                                  fill: true,
                                                  fillColor : gradient,
                                                  borderColor: '#2196f3', // Add custom color border (Line)
                                                  //backgroundColor: 'rgba(33,150,243,.1)', // Add custom color background (Points and Fill)
                                                  borderWidth: 1 // Specify bar border width
                                              },
                                              
                                                        {
                                                  label: 'Outstanding Mortgage', // Name the series
                                                  data: [". $OutstandingMortgageSeries ."], // Specify the data values array
                                                  fill: true,
                                                  fillColor : gradient2,
                                                  borderColor: '#4CAF50', // Add custom color border (Line)
                                                  //backgroundColor: '#4CAF50', // Add custom color background (Points and Fill)
                                                  borderWidth: 1 // Specify bar border width
                                              }]
                                          },
                                          options: {
                                           responsive: true,
                                           tooltips: {
                                               enabled: false,
                                           },
                                           legend: {
                                               display: true,
                                               labels: {
                                                   usePointStyle: false,
                                   
                                               },
                                   
                                   
                                           },
                                             scales: {
                                                 xAxes: [{
                                                     display: true,
                                                     gridLines: {
                                                         display: true,
                                                         drawBorder: true
                                                     },
                                                     scaleLabel: {
                                                         display: true,
                                                         labelString: 'Year'
                                                     }
                                                 }],
                                                 yAxes: [{
                                                     display: true,
                                                     gridLines: {
                                                         display: true,
                                                         drawBorder: true
                                                     },
                                                     scaleLabel: {
                                                         display: true,
                                                         labelString: '". $CurrencySym ."'
                                                     },
                                                     ticks: {
                                    beginAtZero:true,
                                    userCallback: function(value, index, values) {
                                        value = value.toString();
                                        value = value.split(/(?=(?:...)*$)/);
                                        value = value.join(',');
                                        return value;
                                    }
                                }
                             }]
                         },
                         title: {
                             display: true,
                             text: 'Capital Value versus Outstanding Mortgage'
                         }
                     }
                  });
                
                </script>
            ";
            
            
            
    				
    	    }
        }
    }
        



    public static function SaveAnalyzer(){
        $userid = \settings\session\sessionClass::GetSessionDisplayName();  //Copied from other class, Need to check
        
        
        $autoid = isset( $_REQUEST["autoid"]) ?  $_REQUEST["autoid"] : ""; 
        $propertyid             = isset( $_REQUEST["property_id"]) ?  $_REQUEST["property_id"] : ""; 
        $owneroccupier          = isset( $_REQUEST["owneroccupier"]) ?  $_REQUEST["owneroccupier"] : ""; 
        $secondhomeinvestment   = isset( $_REQUEST["secondhomeinvestment"]) ?  $_REQUEST["secondhomeinvestment"] : ""; 
        $audynamicprice         = isset( $_REQUEST["AUDynamicPrice"]) ?  $_REQUEST["AUDynamicPrice"] : 0; 
        $resident               = isset( $_REQUEST["Resident"]) ?  $_REQUEST["Resident"] : 0; 
        $residentinvestor       = isset( $_REQUEST["residentinvestor"]) ?  $_REQUEST["residentinvestor"] : 0; 
        $income                 = isset( $_REQUEST["Income"]) ?  str_replace(",", "",$_REQUEST["Income"]) : 0; 
        $marketprice            = isset( $_REQUEST["MarketPrice"]) ? str_replace(",",'',$_REQUEST["MarketPrice"]) : 0; 
        $duvaldynamicprice      = isset( $_REQUEST["DuvalDynamicPrice"]) ?  str_replace(",", "",$_REQUEST["DuvalDynamicPrice"]) : 0; 
        $stampduty              = isset($_REQUEST["StampDuty"]) ? str_replace(",", "",$_REQUEST["StampDuty"]) : 0; 
        $leaseregistration      = floatval(isset( $_REQUEST["LeaseRegistration"]) ?  $_REQUEST["LeaseRegistration"] : 0); 
        $transferfees           = isset( $_REQUEST["TransferFees"]) ?  $_REQUEST["TransferFees"] : 0; 
        $mortgageregistration   = isset( $_REQUEST["MortgageRegistration"]) ?  $_REQUEST["MortgageRegistration"] : 0; 
        $landtransfer           = isset($_REQUEST["LandTransfer"]) ?  $_REQUEST["LandTransfer"] : 0; 
        $legalfees              = isset($_REQUEST["LegalFees"]) ?  str_replace(",", "",$_REQUEST["LegalFees"]) : 0; 
        $totalpurchasecost      = isset($_REQUEST["TotalPurchaseCost"]) ?  $_REQUEST["TotalPurchaseCost"] : 0; 
        $resetrvationfees       = isset($_REQUEST["ResetrvationFees"]) ?  $_REQUEST["ResetrvationFees"] : 0; 
        $stagepay1per           = isset($_REQUEST["StagePay1Per"]) ?  $_REQUEST["StagePay1Per"] : 0; 
        $stagepay1amt           = isset($_REQUEST["StagePay1Amt"]) ?  $_REQUEST["StagePay1Amt"] : 0; 
        $stagepay2per           = isset($_REQUEST["StagePay2Per"]) ?  $_REQUEST["StagePay2Per"] : 0; 
        $stagepay2amt           = isset($_REQUEST["StagePay2Amt"]) ?  $_REQUEST["StagePay2Amt"] : 0; 
        $loanamountper          = isset($_REQUEST["LoanAmountPer"]) ?  $_REQUEST["LoanAmountPer"] : 0; 
        $topup                  = isset($_REQUEST["Topup"]) ?  $_REQUEST["Topup"] : 0; 
        $weeklyrental           = isset($_REQUEST["WeeklyRental"]) ?  $_REQUEST["WeeklyRental"] : 0; 
        $vacancyrate            = isset($_REQUEST["VacancyRate"]) ?  $_REQUEST["VacancyRate"] : 0; 
        $lettingfeerate         = isset($_REQUEST["LettingFeeRate"]) ?  $_REQUEST["LettingFeeRate"] : 0; 
        $managementfees         = isset($_REQUEST["ManagementFees"]) ?  $_REQUEST["ManagementFees"] : 0; 
        $councilpropertytax     = isset( $_REQUEST["CouncilPropertyTax"]) ?  $_REQUEST["CouncilPropertyTax"] : 0; 
        $codycorporateservicechg    = isset( $_REQUEST["CodyCorporateServiceChg"]) ?  $_REQUEST["CodyCorporateServiceChg"] : 0; 
        $landleaserentpa            = isset( $_REQUEST["LandLeaseRentPa"]) ?  $_REQUEST["LandLeaseRentPa"] : 0; 
        $insurancepa                = isset( $_REQUEST["InsurancePa"]) ?  $_REQUEST["InsurancePa"] : 0; 
        $repairandmaintenance       = isset( $_REQUEST["RepairandMaintenance"]) ?  $_REQUEST["RepairandMaintenance"] : 0; 
        $cleaningpermonth           = isset( $_REQUEST["CleaningPerMonth"]) ?  $_REQUEST["CleaningPerMonth"] : 0; 
        $gardeningpermonth          = isset( $_REQUEST["GardeningPerMonth"]) ?  $_REQUEST["GardeningPerMonth"] : 0; 
        $servicecontractspa         = isset( $_REQUEST["ServiceContractsPa"]) ?  $_REQUEST["ServiceContractsPa"] : 0; 
        $other                      = isset( $_REQUEST["Other"]) ?  $_REQUEST["Other"] : 0; 
        $ltv                        = isset( $_REQUEST["LTV"]) ?  $_REQUEST["LTV"] : 0; 
        $initialloanamt             = isset( $_REQUEST["InitialLoanAmt"]) ?  $_REQUEST["InitialLoanAmt"] : 0; 
        $interestrate               = isset( $_REQUEST["InterestRate"]) ?  $_REQUEST["InterestRate"] : 0; 
        $termyears                  = isset( $_REQUEST["TermYears"]) ?  $_REQUEST["TermYears"] : 0; 
        $cpi                        = isset( $_REQUEST["CPI"]) ?  $_REQUEST["CPI"] : 0; 
        $rentalgrowth               = isset( $_REQUEST["RentalGrowth"]) ?  $_REQUEST["RentalGrowth"] : 0; 
        $capitalgrowth              = isset( $_REQUEST["CapitalGrowth"]) ?  $_REQUEST["CapitalGrowth"] : 0; 
        $buildingvalue              = isset( $_REQUEST["BuildingValue"]) ?  $_REQUEST["BuildingValue"] : 0; 
        $buildinglife               = isset( $_REQUEST["BuildingLife"]) ?  $_REQUEST["BuildingLife"] : 0; 
        $fixturesvalue              = floatval(isset( $_REQUEST["FixturesValue"]) ?  $_REQUEST["FixturesValue"] : 0); 
        $fixtureslife               = floatval(isset( $_REQUEST["FixturesLife"]) ?  $_REQUEST["FixturesLife"] : 0); 
        $furniturevalue             = floatval(isset( $_REQUEST["FurnitureValue"]) ?  $_REQUEST["FurnitureValue"] : 0); 
        $furniturelife              = floatval(isset( $_REQUEST["FurnitureLife"]) ?  $_REQUEST["FurnitureLife"] : 0); 
        $country_id                 = isset( $_REQUEST["countryid"]) ?  $_REQUEST["countryid"] : ""; 
        $country_name               = isset( $_REQUEST["country_name"]) ?  $_REQUEST["country_name"] : ""; 
        $location_name              = isset( $_REQUEST["Subrub"]) ?  $_REQUEST["Subrub"] : ""; 
        $property_name              = isset( $_REQUEST["MyPortFolioName"]) ?  $_REQUEST["MyPortFolioName"] : ""; 
        $property_desc              = isset( $_REQUEST["MyPortfolioPropAddress"]) ?  $_REQUEST["MyPortfolioPropAddress"] : ""; 
        
        $IntOrPrincipalInt          = isset( $_REQUEST["IntOrPrincipalInt"]) ?  $_REQUEST["IntOrPrincipalInt"] : "PrinicipalAndInterest"; 
        $ResidentStatus             = isset( $_REQUEST["ResidentStatus"]) ?  $_REQUEST["ResidentStatus"] : ""; 
        $FlagValue                  = isset( $_REQUEST["FlagValue"]) ?  $_REQUEST["FlagValue"] : ""; 
        $HavePersonalAllowance      = isset( $_REQUEST["HavePersonalAllowance"]) ?  $_REQUEST["HavePersonalAllowance"] : ""; 
        $UkResidentStatus           = isset( $_REQUEST["UkResidentStatus"]) ?  $_REQUEST["UkResidentStatus"] : ""; 
         
        
        
        $purschase_date		     = isset($_REQUEST["DateBought"]) ? $_REQUEST["DateBought"] : "";
    	$completion_date		 = isset($_REQUEST["DateCompletion"]) ? $_REQUEST["DateCompletion"] : "";
        
        
        
    	
      // un format number resetrvationfees
        if($owneroccupier  != "" )
        	$owneroccupier = str_replace(",","",$owneroccupier);
        
        if($secondhomeinvestment  != "" )
        	$secondhomeinvestment = str_replace(",","",$secondhomeinvestment);
        	
        if($audynamicprice  != "" )
        	$audynamicprice = str_replace(",","",$audynamicprice);
        
        if($resident  != "" )
        	$resident = str_replace(",","",$resident);
        	
        if($residentinvestor  != "" )
        	$residentinvestor = str_replace(",","",$residentinvestor);
        	
        if($income  != "" )
        	$income = str_replace(",","",$income);
        	
        if($marketprice  != "" )
        	$marketprice = str_replace(",","",$marketprice);
        	
        if($duvaldynamicprice  != "" )
        	$duvaldynamicprice = str_replace(",","",$duvaldynamicprice);
        	
        if($stampduty  != "" )
        	$stampduty = str_replace(",","",$stampduty);
        	
        if($leaseregistration  != "" )
        	$leaseregistration = str_replace(",","",$leaseregistration);
        	
        if($transferfees  != "" )
        	$transferfees = str_replace(",","",$transferfees);
        	
        if($mortgageregistration  != "" )
        	$mortgageregistration = str_replace(",","",$mortgageregistration);
        	
        if($landtransfer  != "" )
        	$landtransfer = str_replace(",","",$landtransfer);
        	
        if($legalfees  != "" )
        	$legalfees = str_replace(",","",$legalfees);
        	
        if($totalpurchasecost  != "" )
        	$totalpurchasecost = str_replace(",","",$totalpurchasecost);
        	
        if($resetrvationfees  != "" )
        	$resetrvationfees = str_replace(",","",$resetrvationfees);
        	
        if($stagepay1per  != "" )
        	$stagepay1per = str_replace(",","",$stagepay1per);
        	
        if($stagepay1amt  != "" )
        	$stagepay1amt = str_replace(",","",$stagepay1amt);
        	
        if($stagepay2per  != "" )
        	$stagepay2per = str_replace(",","",$stagepay2per);
        	
        if($stagepay2amt  != "" )
        	$stagepay2amt = str_replace(",","",$stagepay2amt);
        	
        if($loanamountper  != "" )
        	$loanamountper = str_replace(",","",$loanamountper);
        	
        if($topup  != "" )
        	$topup = str_replace(",","",$topup);
        	
        if($weeklyrental  != "" )
        	$weeklyrental = str_replace(",","",$weeklyrental);
        	
        if($vacancyrate  != "" )
        	$vacancyrate = str_replace(",","",$vacancyrate);
        	
        if($lettingfeerate  != "" )
        	$lettingfeerate = str_replace(",","",$lettingfeerate);
        	
        if($managementfees  != "" )
        	$managementfees = str_replace(",","",$managementfees);
        	
        if($councilpropertytax  != "" )
        	$councilpropertytax = str_replace(",","",$councilpropertytax);
        	
        if($codycorporateservicechg  != "" )
        	$codycorporateservicechg = str_replace(",","",$codycorporateservicechg);
        	
        if($landleaserentpa  != "" )
        	$landleaserentpa = str_replace(",","",$landleaserentpa);
        	
        if($insurancepa  != "" )
        	$insurancepa = str_replace(",","",$insurancepa);
        	
        if($repairandmaintenance  != "" )
        	$repairandmaintenance = str_replace(",","",$repairandmaintenance);
        	
        if($cleaningpermonth  != "" )
        	$cleaningpermonth = str_replace(",","",$cleaningpermonth);
        	
        if($gardeningpermonth  != "" )
        	$gardeningpermonth = str_replace(",","",$gardeningpermonth);
        	
        if($servicecontractspa  != "" )
        	$servicecontractspa = str_replace(",","",$servicecontractspa);
        	
        if($other  != "" )
        	$other = str_replace(",","",$other);
        	
        if($ltv  != "" )
        	$ltv = str_replace(",","",$ltv);
        	
        if($initialloanamt  != "" )
        	$initialloanamt = str_replace(",","",$initialloanamt);
        	
        if($interestrate  != "" )
        	$interestrate = str_replace(",","",$interestrate);
        	
        if($termyears  != "" )
        	$termyears = str_replace(",","",$termyears);
        	
        if($cpi  != "" )
        	$cpi = str_replace(",","",$cpi);
        	
        if($rentalgrowth  != "" )
        	$rentalgrowth = str_replace(",","",$rentalgrowth);
        	
        if($buildingvalue  != "" )
        	$buildingvalue = str_replace(",","",$buildingvalue);
        	
        if($buildinglife  != "" )
        	$buildinglife = str_replace(",","",$buildinglife);
        	
        if($fixturesvalue  != "" )
        	$fixturesvalue = str_replace(",","",$fixturesvalue);
        	
        if($fixtureslife  != "" )
        	$fixtureslife = str_replace(",","",$fixtureslife);
        	
        if($furniturevalue  != "" )
        	$furniturevalue = str_replace(",","",$furniturevalue);
        	
        if($furniturelife  != "" )
        	$furniturelife = str_replace(",","",$furniturelife);
        	
      
      //un format nuber
      
      $TodayDate = date('d/m/Y');
    	
 
    	if ( $purschase_date != "" ){
    	    
    	    $purschase_date                = \ajax\ajaxClass::convertDate($purschase_date, "%Y-%m-%d");
    	}else{
    	    
    	    $purschase_date = \ajax\ajaxClass::convertDate($TodayDate, "%Y-%m-%d");
    	}

    	
    	if ( $completion_date != "" ){
    	    
    	    //echo "completion_date1=".$completion_date;
    	    
    	    $completion_date                = \ajax\ajaxClass::convertDate($completion_date, "%Y-%m-%d");
    	}else{
    	   // echo "completion_date2=".$completion_date;
    	    $completion_date = \ajax\ajaxClass::convertDate($TodayDate, "%Y-%m-%d");
    	}
    	
        
        if ( $owneroccupier == "")
            $owneroccupier = 0;
            
        if ( $secondhomeinvestment == "")
            $secondhomeinvestment = 0;
        
        if ( $audynamicprice == "")
            $audynamicprice = 0;
        
        if ( $resident == "")
            $resident = 0;
        
        if ( $residentinvestor == "")
            $residentinvestor = 0;
        
        
        if ( $income == "")
            $income = 0;
            
        if ( $marketprice == "")
            $marketprice = 0;
        
        if ( $duvaldynamicprice == "")
            $duvaldynamicprice = 0;
        
        if ( $leaseregistration == "")
            $leaseregistration = 0;
            
        if ( $transferfees == "")
            $transferfees = 0;
            
        if ( $mortgageregistration == "")
            $mortgageregistration = 0;
        
       if ( $landtransfer == "")
            $landtransfer = 0;
       
        if ( $totalpurchasecost == "")
            $totalpurchasecost = 0;
        
        if ( $stampduty == "")
            $stampduty = 0;
            
         if ( $legalfees == "")
            $legalfees = 0;
            
        if ( $resetrvationfees == "")
            $resetrvationfees = 0;
            
        if ( $stagepay1per == "")
            $stagepay1per = 0;
          
        if ( $stagepay1amt == "")
            $stagepay1amt = 0;
             
        if ( $stagepay2per == "")
            $stagepay2per = 0;
             
         if ( $stagepay2amt == "")
            $stagepay2amt = 0;
        
        if ( $loanamountper == "")
            $loanamountper = 0;
            
        if ( $weeklyrental == "")
            $weeklyrental = 0;
            
        if ( $vacancyrate == "")
            $vacancyrate = 0;
        if ( $lettingfeerate == "")
            $lettingfeerate = 0;   
        if ( $managementfees == "")
            $managementfees = 0;   
        if ( $councilpropertytax == "")
            $councilpropertytax = 0;  
        if ( $codycorporateservicechg == "")
            $codycorporateservicechg = 0;  
        if ( $landleaserentpa == "")
            $landleaserentpa = 0;  
        if ( $insurancepa == "")
            $insurancepa = 0;  
        if ( $repairandmaintenance == "")
            $repairandmaintenance = 0;  
        
        if ( $cleaningpermonth == "")
            $cleaningpermonth = 0;  
        
        if ( $gardeningpermonth == "")
            $gardeningpermonth = 0;  
        
        if ( $servicecontractspa == "")
            $servicecontractspa = 0;  
            
        if ( $other == "")
            $other = 0;  
            
        if ( $ltv == "")
            $ltv = 0;  
            
        if ( $initialloanamt == "")
            $initialloanamt = 0;  

        if ( $interestrate == "")
            $interestrate = 0;  
            
        if ( $termyears == "")
            $termyears = 0;  
            
          if ( $cpi == "")
            $cpi = 0;  
        
          if ( $rentalgrowth == "")
            $rentalgrowth = 0;  
            
          if ( $capitalgrowth == "")
            $capitalgrowth = 0;  
            
          if ( $buildingvalue == "")
            $buildingvalue = 0;  
            
        if ( $buildinglife == "")
            $buildinglife = 0;  
            
        if ( $fixturesvalue == "")
            $fixturesvalue = 0;  
            
        if ( $fixtureslife == "")
            $fixtureslife = 0;  
            
        if ( $furniturevalue == "")
            $furniturevalue = 0;  
            
        if ( $furniturelife == "")
            $furniturelife = 0;  
        
         if( $IntOrPrincipalInt == "" ) 
            $IntOrPrincipalInt ="PrinicipalAndInterest";
            
        if( $ResidentStatus == "" ) 
            $ResidentStatus ="";
            
        if($HavePersonalAllowance == "")   
            $HavePersonalAllowance = "NO";
        
        if($UkResidentStatus == "")   
            $UkResidentStatus = "";
            
            
            
        $edit = true;
        if($autoid == "")
        {
            $ChkCntArr          = \DBConn\DBConnection::getQueryFetchColumn("(SELECT ifnull(max(autoid), 0)+1 autoid  FROM property_analyzer_inputs)");
            $autoid             = $ChkCntArr["0"];
            $edit = false;
        }
       
       $ArrQueries     = array();
       
       if ( $propertyid != ""){
        
            
            
            $ColValArr       = array("propertyid" => $propertyid, 
                                    "userid" => $userid);
                                    
            $QueryStr               = " delete from property_analyzer_inputs where propertyid = :propertyid and userid = :userid"; 
                                        
            $QueryArr               =   array($QueryStr, $ColValArr);
    		$ArrQueries[]           =   $QueryArr;
		
       }
                                
        
        $ColValArr       = array(
            "autoid" => $autoid, 
            "propertyid" => $propertyid, 
            "userid" => $userid, 
            "owneroccupier" => $owneroccupier, 
            "secondhomeinvestment" => $secondhomeinvestment, 
            "audynamicprice" => $audynamicprice, 
            "resident" => $resident, 
            "residentinvestor" => $residentinvestor, 
            "income" => $income, 
            "marketprice" => $marketprice, 
            "duvaldynamicprice" => $duvaldynamicprice, 
            "stampduty" => $stampduty, 
            "leaseregistration" => $leaseregistration, 
            "transferfees" => $transferfees, 
            "mortgageregistration" => $mortgageregistration, 
            "landtransfer" => $landtransfer, 
            "legalfees" => $legalfees, 
            "totalpurchasecost" => $totalpurchasecost, 
            "resetrvationfees" => $resetrvationfees, 
            "stagepay1per" => $stagepay1per, 
            "stagepay1amt" => $stagepay1amt, 
            "stagepay2per" => $stagepay2per, 
            "stagepay2amt" => $stagepay2amt, 
            "loanamountper" => $loanamountper, 
            "topup" => $topup, 
            "weeklyrental" => $weeklyrental, 
            "vacancyrate" => $vacancyrate, 
            "lettingfeerate" => $lettingfeerate, 
            "managementfees" => $managementfees, 
            "councilpropertytax" => $councilpropertytax, 
            "codycorporateservicechg" => $codycorporateservicechg, 
            "landleaserentpa" => $landleaserentpa, 
            "insurancepa" => $insurancepa, 
            "repairandmaintenance" => $repairandmaintenance, 
            "cleaningpermonth" => $cleaningpermonth, 
            "gardeningpermonth" => $gardeningpermonth, 
            "servicecontractspa" => $servicecontractspa, 
            "other" => $other, 
            "ltv" => $ltv, 
            "initialloanamt" => $initialloanamt, 
            "interestrate" => $interestrate, 
            "termyears" => $termyears, 
            "cpi" => $cpi, 
            "rentalgrowth" => $rentalgrowth, 
            "capitalgrowth" => $capitalgrowth, 
            "buildingvalue" => $buildingvalue, 
            "buildinglife" => $buildinglife, 
            "fixturesvalue" => $fixturesvalue, 
            "fixtureslife" => $fixtureslife, 
            "furniturevalue" => $furniturevalue, 
            "furniturelife" => $furniturelife, 
            "country_id" => $country_id, 
            "country_name" => $country_name, 
            "location_name" => $location_name, 
            "property_name" => $property_name, 
            "property_desc" => $property_desc, 
            "purschase_date" => $purschase_date, 
            "completion_date" => $completion_date, 
            "IntOrPrincipalInt" => $IntOrPrincipalInt, 
            "ResidentStatus" => $ResidentStatus, 
            "fromflag" => $FlagValue,
            "HavePersonalAllowance" => $HavePersonalAllowance,
            "UkResidentStatus" => $UkResidentStatus,
        );
        if($edit)
        {
            $QueryStr = " UPDATE property_analyzer_inputs SET propertyid = :propertyid, userid =:userid, owneroccupier = :owneroccupier, secondhomeinvestment = :secondhomeinvestment, audynamicprice = :audynamicprice, resident = :resident,
            residentinvestor = :residentinvestor, income = :income , marketprice = :marketprice, duvaldynamicprice = :duvaldynamicprice, stampduty = :stampduty, leaseregistration = :leaseregistration, transferfees = :transferfees, mortgageregistration = :mortgageregistration, 
            landtransfer = :landtransfer, legalfees = :legalfees, totalpurchasecost = :totalpurchasecost, resetrvationfees = :resetrvationfees, stagepay1per = :stagepay1per, stagepay1amt = :stagepay1amt, stagepay2per = :stagepay2per, stagepay2amt = :stagepay2amt, loanamountper = :loanamountper, 
            topup = :topup, weeklyrental = :weeklyrental, vacancyrate = :vacancyrate, lettingfeerate = :lettingfeerate, managementfees = :managementfees, councilpropertytax = :councilpropertytax, codycorporateservicechg = :codycorporateservicechg, landleaserentpa = :landleaserentpa, 
            insurancepa = :insurancepa, repairandmaintenance = :repairandmaintenance, cleaningpermonth = :cleaningpermonth, gardeningpermonth = :gardeningpermonth, servicecontractspa = :servicecontractspa, other = :other, ltv = :ltv, initialloanamt = :initialloanamt, interestrate = :interestrate, 
            termyears = :termyears, cpi = :cpi, rentalgrowth = :rentalgrowth, capitalgrowth = :capitalgrowth, buildingvalue = :buildingvalue, buildinglife = :buildinglife, fixturesvalue = :fixturesvalue, fixtureslife = :fixtureslife, furniturevalue = :furniturevalue, furniturelife = :furniturelife, 
            country_id = :country_id, country_name = :country_name, location_name = :location_name, property_name = :property_name, property_desc = :property_desc,purschase_date = :purschase_date, completion_date = :completion_date,IntOrPrincipalInt = :IntOrPrincipalInt,ResidentStatus = :ResidentStatus,
            fromflag = :fromflag, HavePersonalAllowance = :HavePersonalAllowance, UkResidentStatus = :UkResidentStatus WHERE autoid = :autoid ";
        }
        else
        {
            $QueryStr = " insert into property_analyzer_inputs(autoid, propertyid, userid, owneroccupier, secondhomeinvestment, audynamicprice, resident, 
            residentinvestor, income, marketprice, duvaldynamicprice, stampduty, leaseregistration, transferfees, mortgageregistration, 
            landtransfer, legalfees, totalpurchasecost, resetrvationfees, stagepay1per, stagepay1amt, stagepay2per, stagepay2amt, loanamountper, 
            topup, weeklyrental, vacancyrate, lettingfeerate, managementfees, councilpropertytax, codycorporateservicechg, landleaserentpa, 
            insurancepa, repairandmaintenance, cleaningpermonth, gardeningpermonth, servicecontractspa, other, ltv, initialloanamt, interestrate, 
            termyears, cpi, rentalgrowth, capitalgrowth, buildingvalue, buildinglife, fixturesvalue, fixtureslife, furniturevalue, furniturelife, 
            country_id, country_name, location_name, property_name, property_desc,purschase_date, completion_date,IntOrPrincipalInt,ResidentStatus,
            fromflag, HavePersonalAllowance, UkResidentStatus) values(:autoid, :propertyid, :userid, :owneroccupier, :secondhomeinvestment, :audynamicprice, :resident, :residentinvestor, :income, 
            :marketprice, :duvaldynamicprice, :stampduty, :leaseregistration, :transferfees, :mortgageregistration, :landtransfer, :legalfees, 
            :totalpurchasecost, :resetrvationfees, :stagepay1per, :stagepay1amt, :stagepay2per, :stagepay2amt, :loanamountper, :topup, :weeklyrental, 
            :vacancyrate, :lettingfeerate, :managementfees, :councilpropertytax, :codycorporateservicechg, :landleaserentpa, :insurancepa, 
            :repairandmaintenance, :cleaningpermonth, :gardeningpermonth, :servicecontractspa, :other, :ltv, :initialloanamt, :interestrate, 
            :termyears, :cpi, :rentalgrowth, :capitalgrowth, :buildingvalue, :buildinglife, :fixturesvalue, :fixtureslife, :furniturevalue, 
            :furniturelife, :country_id, :country_name, :location_name, :property_name, :property_desc, :purschase_date, :completion_date, :IntOrPrincipalInt, 
            :ResidentStatus, :fromflag, :HavePersonalAllowance, :UkResidentStatus)";
        }
        $QueryArr               =   array($QueryStr, $ColValArr);
		$ArrQueries[]           =   $QueryArr;
		$Msg                        = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
		
		
		
		
	
		if ($Msg == "success"){
		    
		    $TodayDate = date('Y-m-d');
                        
            $ChkAnalysisArr     = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(*) AS CNT FROM property_analyzer_inputs WHERE fromflag ='R' AND userid ='{$userid}' and DATE_FORMAT(created_date, '%Y-%m-%d') ='{$TodayDate}')");
            $RecentAnaysisCnt   = $ChkAnalysisArr["0"]; // Arzath - 2020-08-02
            
           
                            
            $Msg    =   $RecentAnaysisCnt;
        }
        else{
            $Msg    =    -1;
        }
                           
         echo $Msg;                  
    }
    
    
    
    
    public static function AnalyzerResultBackup(){
	    self::Init();
        
        //echo "<pre>"; print_r($_REQUEST); echo "</pre>"; 
        
        //Constants
        $DisposalYr                     = 5; 
        $FutureDepositRate1             = 25;
		$FutureDepositRate2             = 0;
		$FurniturePackAmt               = -4200; 
		$DisposableCostPer              = 2;
		$DisposableCostPlusVat          = 2.4; 
		
		$BrokerEstArrangeFees           = 995;
		$LenderEstArrangeFees           = 1060;
		$AllowableInterestDedRate       = 75;
		$IncomeTaxRate                  = 0; 
		$CGTRate1                       = 0;
		$CGTRate2                       = 0;
		$CgtExempt                      = 11300; 
		
		$MortgageType                   = "IntrestOnly"; 
		$MortgageAmtPer                 = 65; 
		
		
        $ServiceChgPsf                  = isset($_REQUEST["ServiceCharge"]) ? $_REQUEST["ServiceCharge"] : 0; 
        $TenantManagementFeeRate        = isset($_REQUEST["TenantManagementFee"]) ? $_REQUEST["TenantManagementFee"] : 0; 
        $GroundRentAmt                  = isset($_REQUEST["GroundRentAmt"]) ? $_REQUEST["GroundRentAmt"] : 0; 
        
        
        $CapitalGrowthRate              = isset($_REQUEST["CapitalGrowthRate"]) ? $_REQUEST["CapitalGrowthRate"] : 0;
        $CapitalGrowthRate              = number_format($CapitalGrowthRate, 2); 
        //$RentalPriceIndex             = number_format(2, 2);
        $ChattelsValue                  = 30000; 
        
        $arr_weekly_rents               = isset($_REQUEST["arr_weekly_rents"]) ? $_REQUEST["arr_weekly_rents"] : 0;
        $EstGrsRentalIncome             = isset($_REQUEST["EstGrsRentalIncome"]) ? $_REQUEST["EstGrsRentalIncome"] : 0;

		//echo "EstGrsRentalIncome=" . $EstGrsRentalIncome;
        
        
        $loan_purchase_market_value     = isset($_REQUEST["loan_purchase_market_value"]) ? $_REQUEST["loan_purchase_market_value"] : 0;
        $CorporateFees                  = isset($_REQUEST["ape_body_corporate"]) ? $_REQUEST["ape_body_corporate"] : 0;
        $Rates                          = isset($_REQUEST["ape_rates"]) ? $_REQUEST["ape_rates"] : 0;
        
        $InterestRate                   = floatval( isset($_REQUEST["loan_interset_rate"]) ? $_REQUEST["loan_interset_rate"] : 0 );
        
        
        $ValueArr                       = array();

		$RentalGrowthArr			    = array(0, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3); 
		$CapitalApprecRateArr		    = array(0, 2.5, 2.5, 3, 3.5, 3.5, 3.5, 3.5, 3.5, 3.5, 3.5); 

		$MarketRentEscalation		    = array(0, 1.38, 1.42, 1.46, 1.51, 1.56, 1.60, 1.65, 1.70, 1.75, 1.80); 
		
		$Purchaseprice                  = isset($_REQUEST["Purchaseprice"]) ? $_REQUEST["Purchaseprice"] : 0; 
		$UnitSize                       = isset($_REQUEST["UnitSize"]) ? $_REQUEST["UnitSize"] : 0; 
		
		
		$ipglbclientfeeAmt              = isset($_REQUEST["ipglbclientfeeAmt"]) ? $_REQUEST["ipglbclientfeeAmt"] : 0; 
		$ReservationDepositAmt          = isset($_REQUEST["ReservationDepositAmt"]) ? $_REQUEST["ReservationDepositAmt"] : 0; 
		$ConveyancingfeesAmt            = isset($_REQUEST["ConveyancingfeesAmt"]) ? $_REQUEST["ConveyancingfeesAmt"] : 0; 
		$LandregistryfeesAmt            = isset($_REQUEST["LandregistryfeesAmt"]) ? $_REQUEST["LandregistryfeesAmt"] : 0; 
		$EngrossmentfeesAmt             = isset($_REQUEST["EngrossmentfeesAmt"]) ? $_REQUEST["EngrossmentfeesAmt"] : 0; 
		
		
		//Final costs at completion
		$FinalcapitalpaymentAmt         = isset($_REQUEST["FinalcapitalpaymentAmt"]) ? $_REQUEST["FinalcapitalpaymentAmt"] : 0; 
		$StampdutyAmt                   = isset($_REQUEST["StampdutyAmt"]) ? $_REQUEST["StampdutyAmt"] : 0; 
		$LiquidExpatbrokercostsAmt      = isset($_REQUEST["LiquidExpatbrokercostsAmt"]) ? $_REQUEST["LiquidExpatbrokercostsAmt"] : 0; 
		$LenderarrangementfeeAmt        = isset($_REQUEST["LenderarrangementfeeAmt"]) ? $_REQUEST["LenderarrangementfeeAmt"] : 0; 
		$ValuationfeeAmt                = isset($_REQUEST["ValuationfeeAmt"]) ? $_REQUEST["ValuationfeeAmt"] : 0; 
		$FurniturepackAmt               = isset($_REQUEST["FurniturepackAmt"]) ? $_REQUEST["FurniturepackAmt"] : 0; 
		$CompleteTenantfeeAmt           = isset($_REQUEST["CompleteTenantfeeAmt"]) ? $_REQUEST["CompleteTenantfeeAmt"] : 0; 
		$CompleteTenantagreementfeeAmt  = isset($_REQUEST["CompleteTenantagreementfeeAmt"]) ? $_REQUEST["CompleteTenantagreementfeeAmt"] : 0; 
		$CompleteHandoverfeeAmt         = isset($_REQUEST["CompleteHandoverfeeAmt"]) ? $_REQUEST["CompleteHandoverfeeAmt"] : 0; 
		$CompleteInventoryfeeAmt        = isset($_REQUEST["CompleteInventoryfeeAmt"]) ? $_REQUEST["CompleteInventoryfeeAmt"] : 0; 
		$CompleteReferenceCheckAmt      = isset($_REQUEST["CompleteReferenceCheckAmt"]) ? $_REQUEST["CompleteReferenceCheckAmt"] : 0; 
		$ClientFeeRebateCompAmt         = isset($_REQUEST["ClientFeeRebateCompAmt"]) ? $_REQUEST["ClientFeeRebateCompAmt"] : 0; 
		
		$MortgageLendingVal             = isset($_REQUEST["MortgageLendingVal"]) ? $_REQUEST["MortgageLendingVal"] : 0; 
		$MortgageRate                   = isset($_REQUEST["MortgageRate"]) ? $_REQUEST["MortgageRate"] : 0; 
		$MortgageLongTerm               = isset($_REQUEST["MortgageLongTerm"]) ? $_REQUEST["MortgageLongTerm"] : 0; 
		$MortgageType                   = isset($_REQUEST["MortgageType"]) ? $_REQUEST["MortgageType"] : 0; 
		
		$MortgageArr                    = self::CalculateMortgage( $MortgageLendingVal, $MortgageRate, $MortgageLongTerm ); 
		
		
		//echo "<pre>"; print_r($MortgageArr); echo "</pre>"; 
		
		
		$RentalIncGraphArr1             = array(); 
		$RentalIncGraphArr2             = array(); 
		
		$CapitalApprArr1                = array();
		$CapitalApprArr2                = array();
		$CapitalApprArr3                = array();
		
        
        for ($i = 0; $i <= 10; $i++){
            if ($i == 0){
                $RentalIncome           = floatval($EstGrsRentalIncome) * 52;	//changed
                $RentPerWeek            = $EstGrsRentalIncome;					//changed
                
                //Market capital escalation => Purchase Price / Unit Size
                $MarketCapitalEsc       = floatval($Purchaseprice) / floatval($UnitSize);   
                
                $CapitalAppreciate      = 0; 
                $PropertyPriceYrEnd     = 0;
                
                $SaleProceedYrEnd5      = 0; 
                $SaleProceedYrEnd10     = 0; 
                
                $TotalIncome5YrEnd      = 0; 
                
                
                //Expenses
                $ExpPurchasePrice       = -1 * floatval($Purchaseprice) * (floatval($FutureDepositRate1) + floatval($FutureDepositRate1)); 
                $AcquisitionCosts       = -1 * (floatval($ipglbclientfee) + floatval($Conveyancingfees) + floatval($Landregistryfees) + floatval($Engrossmentfees)); 
                $ServiceChg             = 0; 
                $TenantManagementFee    = floatval($RentalIncome) * floatval($TenantManagementFeeRate); 
                
                $RentalYield            = 0;
                $CummulaticeGrowth      = 0; 
                
                $CapitalApprArr1[]      = $Purchaseprice;
                $CapitalApprArr2[]      = $CummulaticeGrowth;
                
                $SaleCost5YrEnd         = 0;
                $SaleCost10YrEnd        = 0;
                
                
                
                $MortgageDrawdown       = 0; 
                $MortgageFees           = 0; 
                $PrincipalRepay         = 0; 
                
                $Intrest                = 0; 
                $OutstandingPrincipal   = 0;
                
                $TotalExpenses5Yr       = $TempExpenses + floatval($SaleCost5YrEnd);
                $TotalExpenses10Yr      = $TempExpenses + floatval($SaleCost10YrEnd);
                
                
                //Taxes
                $IncomeTaxPurpose       = 0;
                
                $TempExpenses           = floatval($Purchaseprice) + floatval($AcquisitionCosts) + floatval($FurniturePackAmt) + floatval($ServiceChg) + 
                                          floatval($TenantManagementFee) + floatval($GroundRentAmt) + floatval($MortgageFees) + floatval($PrincipalRepay);
                                      
                $TotalIntDeductible     = 0;
                $TaxableIncome          = floatval($IncomeTaxPurpose) + floatval($TotalIntDeductible);
                $TaxableIncAllowance    = ($TaxableIncome < 11500) ? 0 : $TaxableIncome; 
                $IncomeTaxAmt           = ($TaxableIncome < 0) ? 0 : $TaxableIncAllowance * floatval($IncomeTaxRate) / 100; 
                
                //floatval($SaleProceedYrEnd5) + floatval($RentalIncome) + 
                
                $NetCashFlowTemp        = floatval($Purchaseprice) + floatval($AcquisitionCosts) + floatval($FurniturePackAmt) + floatval($ServiceChg) + 
                                          floatval($TenantManagementFee) + floatval($GroundRentAmt) + floatval($MortgageDrawdown) + 
                                          floatval($SaleProceedYrEnd5) + floatval($RentalIncome);
                                          
                
                $NetCashFlowB4MortgageYr5= floatval($NetCashFlowTemp);
                $CummulativeB4MortgageYr5= $NetCashFlowB4MortgageYr5;
                
                
                $NetCashFlowB4MortgageYr10= $NetCashFlowTemp;                       
                $CummulativeB4MortgageYr10= $NetCashFlowB4MortgageYr10;
                
                
                
                
                $NetCashFlowAfterMortYr5  = floatval($NetCashFlowB4MortgageYr5) + floatval($MortgageFees) + floatval($Intrest) - floatval($MortgageDrawdown);
                $NetCashFlowAfterCummulativeYr5 = $NetCashFlowAfterMortYr5; 
                
                $NetCashFlowAfterMortYr10 = floatval($NetCashFlowB4MortgageYr10) + floatval($MortgageFees) + floatval($Intrest) - floatval($MortgageDrawdown);
                $NetCashFlowAfterCummulativeYr10 = $NetCashFlowAfterMortYr10; 
                
            }
            else{
                $RentalPriceIndex	    = $MarketRentEscalation[$i]; 
                $CapitalApprecRate      = $CapitalApprecRateArr[$i];

                $RentalIncome           = floatval($RentalIncome) + (floatval($RentalIncome) * floatval($RentalPriceIndex) / 100);
                $RentPerWeek            = floatval($RentalIncome) / 12;
                
                
                //Market capital escalation => MarketCapitalEsc + Purchase Price / Unit Size
                
                $MarketCapitalEsc       = floatval($MarketCapitalEsc) * (1 + ($CapitalApprecRate / 100) ); 
                
                //echo "CapitalApprecRate=$CapitalApprecRate";
                if (intval($i) == 1)
                    $PrevPropertyPriceYrEnd  = $Purchaseprice;
                else
                    $PrevPropertyPriceYrEnd  = $PropertyPriceYrEnd;
                
                
                $CapitalAppreciate      = (floatval($MarketCapitalEsc) * floatval($UnitSize)) - floatval($Purchaseprice); 
                
                $PropertyPriceYrEnd     = floatval($CapitalAppreciate) + floatval($Purchaseprice); 
                
                $CummulaticeGrowth      = floatval($PrevPropertyPriceYrEnd) / floatval($PropertyPriceYrEnd) * 100; 
                
                $SaleProceedYrEnd5      = (intval($i) == 5) ? $PropertyPriceYrEnd : 0; 
                $SaleProceedYrEnd10     = (intval($i) == 10) ? $PropertyPriceYrEnd : 0; 
                
                if (intval($i) <= 5){
                    $TotalIncome5YrEnd  = floatval($RentalIncome) + floatval($SaleProceedYrEnd5); 
                }
                else{
                    $TotalIncome5YrEnd  = 0; 
                }
                
                $TotalIncome10YrEnd     = floatval($RentalIncome) + floatval($TotalIncome10YrEnd); 
                
                if (intval($i) == 1){
                    $AcquisitionCosts   = -1 * (floatval($StampdutyAmt) + floatval($ValuationfeeAmt) + floatval($CompleteTenantfeeAmt) + floatval($CompleteTenantagreementfeeAmt) + floatval($CompleteHandoverfeeAmt) + floatval($CompleteInventoryfeeAmt) + floatval($CompleteReferenceCheckAmt)); 
                }
                else{
                    $AcquisitionCosts   = 0; 
                }
                
                $ServiceChg             = floatval($UnitSize) * floatval($ServiceChgPsf); 
                $TenantManagementFee    = floatval($RentalIncome) * floatval($TenantManagementFeeRate); 
                
                if (intval($i) == 5){
                    $SaleCost5YrEnd     = floatval($SaleProceedYrEnd5) * ( floatval($DisposableCostPer) / 100 ) * ( 1 + (floatval($DisposableCostPlusVat) / 100 ) );
                }
                else{
                    $SaleCost5YrEnd     = 0;
                }
                
                if (intval($i) == 10){
                    $SaleCost10YrEnd    = floatval($SaleProceedYrEnd10) * ( floatval($DisposableCostPer) / 100 ) * ( 1 + (floatval($DisposableCostPlusVat) / 100 ) );
                }
                else{
                    $SaleCost10YrEnd    = 0;
                }
                
                $RentalYield            = number_format((floatval($RentalIncome) / floatval($Purchaseprice))*100, 2);
                
                $RentalIncGraphArr1[]   = number_format($RentalIncome, 2, ".", "");
                $RentalIncGraphArr2[]   = number_format($RentalYield, 1, ".", "");
                
                $CapitalApprArr1[]      = number_format($PropertyPriceYrEnd, 2, ".", "");
                $CapitalApprArr2[]      = number_format($CummulaticeGrowth, 1, ".", "");
                
                if (intval($i) == 1){
                    if ($MortgageType == "None"){
                        $MortgageDrawdown   = 0; 
                    }
                    else{
                        $MortgageDrawdown   = -1 * floatval($Purchaseprice) * floatval($MortgageAmtPer) / 100; 
                    }
                }
                else{
                    $MortgageDrawdown       = 0; 
                }
                
                if (intval($i) == 1){
                    if (floatval($MortgageDrawdown) < 0){
                        $MortgageFees       = floatval($BrokerEstArrangeFees) + floatval($LenderEstArrangeFees); 
                    }
                    else{
                        $MortgageFees       = 0; 
                    }
                }
                else{
                    $MortgageFees           = 0; 
                }
                
                if ($MortgageType == "None"){
                    $PrincipalRepay         = 0; 
                }
                else{
                    $PrincipalRepay         = 0; //Need to work on this later...
                }
                
                if (intval($i) == 1){
                    $MortArrPtr             = 0;
                }
                else{
                    $MortArrPtr             = (($i-1) * 12) - 1;
                }
                
                if ($MortgageType == "IntersertOnly"){
                    $FirstMonIntrest        = isset($MortgageArr[0]["Interest"]) ? $MortgageArr[0]["Interest"] : 0; 
                    $Intrest                = floatval($FirstMonIntrest) * 12;
                    
                    $OutstandingPrincipal   = -1 * floatval($MortgageLendingVal); 
                }
                else{
                    $Intrest                = 0; 
                    $OutstandingPrincipal   = floatval($OutstandingPrincipal) + floatval($PrincipalRepay) + floatval($MortgageDrawdown); 
                }
                
                $TempExpenses               = floatval($Purchaseprice) + floatval($AcquisitionCosts) + floatval($FurniturePackAmt) + floatval($ServiceChg) + 
                                              floatval($TenantManagementFee) + floatval($GroundRentAmt) + floatval($MortgageFees) + floatval($PrincipalRepay);
                                      
                $TotalExpenses5Yr           = $TempExpenses + floatval($SaleCost5YrEnd);
                $TotalExpenses10Yr          = $TempExpenses + floatval($SaleCost10YrEnd);
                
                
                
                $NetCashFlowTemp            = floatval($Purchaseprice) + floatval($AcquisitionCosts) + floatval($FurniturePackAmt) + floatval($ServiceChg) + 
                                              floatval($TenantManagementFee) + floatval($GroundRentAmt) + floatval($MortgageDrawdown) + 
                                              floatval($SaleProceedYrEnd5) + floatval($RentalIncome);
                
                if (floatval($i) <= 5){
                    $NetCashFlowB4MortgageYr5= floatval($NetCashFlowTemp);
                    $CummulativeB4MortgageYr5= floatval($CummulativeB4MortgageYr5) + floatval($NetCashFlowB4MortgageYr5);
                }
                else{
                    $NetCashFlowB4MortgageYr5= 0;
                    $CummulativeB4MortgageYr5= 0;
                }
                
                $NetCashFlowB4MortgageYr10  = $NetCashFlowTemp;                       
                $CummulativeB4MortgageYr10  = floatval($CummulativeB4MortgageYr10) + floatval($NetCashFlowB4MortgageYr10);
                
                
                
                if (floatval($i) <= 5){
                    $NetCashFlowAfterMortYr5  = floatval($NetCashFlowB4MortgageYr5) + floatval($MortgageFees) + floatval($Intrest) - floatval($MortgageDrawdown);
                    $NetCashFlowAfterCummulativeYr5 = floatval($NetCashFlowAfterCummulativeYr5) + floatval($NetCashFlowAfterMortYr5); 
                }
                else{
                    $NetCashFlowAfterMortYr5  = 0;
                    $NetCashFlowAfterCummulativeYr5 = 0; 
                }
                
                $NetCashFlowAfterMortYr10 = floatval($NetCashFlowB4MortgageYr10) + floatval($MortgageFees) + floatval($Intrest) - floatval($MortgageDrawdown);
                $NetCashFlowAfterCummulativeYr10 = $NetCashFlowAfterMortYr10; 
                
                
                //Taxes
                $IncomeTaxPurpose           = floatval($RentalIncome) + floatval($FurniturePackAmt) + floatval($ServiceChg) + floatval($TenantManagementFee) + floatval($GroundRentAmt);
                $TotalIntDeductible         = floatval($Intrest) * floatval($AllowableInterestDedRate) / 100;
                $TaxableIncome              = floatval($IncomeTaxPurpose) + floatval($TotalIntDeductible);
                $TaxableIncAllowance        = ($TaxableIncome < 11500) ? 0 : $TaxableIncome; 
                $IncomeTaxAmt               = ($TaxableIncome < 0) ? 0 : $TaxableIncAllowance * floatval($IncomeTaxRate) / 100; 
                $CapitalGainYr5             = ($i == 5) ? floatval($SaleProceedYrEnd5) - floatval($Purchaseprice) : 0;
                $CapitalGainYr5Exempt       = (floatval($CapitalGainYr5) > 0) ? $CapitalGainYr5 - floatval($CgtExempt) : 0;  
                
                if ($i == 5){
                    if ($CapitalGainYr5Exempt > 33500){
                        $CapitalGain5YrTax  = (($CapitalGainYr5Exempt - 33500) * floatval($CGTRate2) / 100) + (33500 * floatval($CGTRate1) / 100); 
                    }
                    else{
                        $CapitalGain5YrTax  = $CapitalGainYr5Exempt * floatval($CGTRate1) / 100; 
                    }
                }
                else{
                    $CapitalGain5YrTax      = 0;
                }
                
                $CapitalGainYr10            = ($i == 5) ? floatval($SaleProceedYrEnd10) - floatval($Purchaseprice) : 0;
                $CapitalGainYr10Exempt      = (floatval($CapitalGainYr10) > 0) ? $CapitalGainYr10 - floatval($CgtExempt) : 0;  
                
                if ($i == 10){
                    if ($CapitalGainYr10Exempt > 33500){
                        $CapitalGain10YrTax  = (($CapitalGainYr10Exempt - 33500) * floatval($CGTRate2) / 100) + (33500 * floatval($CGTRate1) / 100); 
                    }
                    else{
                        $CapitalGain10YrTax  = $CapitalGainYr10Exempt * floatval($CGTRate1) / 100; 
                    }
                }
                else{
                    $CapitalGain10YrTax      = 0;
                }
                
            }
            
            
            
            
            
            $RentalIncGraphStr1     = implode(",", $RentalIncGraphArr1);
            $RentalIncGraphStr2     = implode(",", $RentalIncGraphArr2);
            
            $CapitalApprStr1        = implode(",", $CapitalApprArr1); 
            $CapitalApprStr2        = implode(",", $CapitalApprArr2);  
            $CapitalApprStr3        = implode(",", $CapitalApprecRateArr);  
            
            
            
            $TempArr                = array("RentalIncome"          => number_format( (intval($i) == 0) ? 0 : $RentalIncome, 2, ".", ""),
                                            "RentalYield"           => number_format( $RentalYield,  2, ".", ""),
                                            "PropertyValue"         => number_format( (intval($i) == 0) ? 0 : $Purchaseprice, 2, ".", ""),
                                            "CapitalAppreciate"     => number_format( $CapitalAppreciate, 2, ".", ""),
                                            "PropertyPriceYrEnd"    => number_format( $PropertyPriceYrEnd, 2, ".", ""),
                                            "SaleProceedYrEnd5"     => number_format( $SaleProceedYrEnd5, 2, ".", ""),
                                            "SaleProceedYrEnd10"    => number_format( $SaleProceedYrEnd10, 2, ".", ""),
                                            "TotalIncome5YrEnd"     => number_format( $TotalIncome5YrEnd, 2, ".", ""),
                                            "TotalIncome10YrEnd"    => number_format( $TotalIncome10YrEnd, 2, ".", ""),
                                            "AcquisitionCosts"      => number_format( $AcquisitionCosts,  2, ".", ""),
                                            "FurniturePackAmt"      => number_format( (intval($i) == 1) ? 0 : $FurniturePackAmt,  2, ".", ""),
                                            "ServiceChg"            => number_format( $ServiceChg,  2, ".", ""),
                                            "TenantManagementFee"   => number_format( $TenantManagementFee,  2, ".", ""),
                                            "GroundRentAmt"         => number_format( $GroundRentAmt,  2, ".", ""),
                                            "SaleCost5YrEnd"        => number_format( $SaleCost5YrEnd,  2, ".", ""),
                                            "SaleCost10YrEnd"       => number_format( $SaleCost10YrEnd,  2, ".", ""),
                                            
                                            "MortgageDrawdown"      => number_format( $MortgageDrawdown,  2, ".", ""),
                                            "MortgageFees"          => number_format( $MortgageFees,  2, ".", ""),
                                            "PrincipalRepay"        => number_format( $PrincipalRepay,  2, ".", ""),
                                            "Intrest"               => number_format( $Intrest,  2, ".", ""),
                                            "OutstandingPrincipal"  => number_format( $OutstandingPrincipal,  2, ".", ""),
                                            "TotalExpenses5Yr"      => number_format( $TotalExpenses5Yr,  2, ".", ""),
                                            "TotalExpenses10Yr"     => number_format( $TotalExpenses10Yr,  2, ".", ""),
                                            
                                            "NetCashFlowB4MortgageYr5"=> number_format( $NetCashFlowB4MortgageYr5,  2, ".", ""),
                                            "CummulativeB4MortgageYr5"=> number_format( $CummulativeB4MortgageYr5,  2, ".", ""),
                                            "NetCashFlowB4MortgageYr10"=> number_format( $NetCashFlowB4MortgageYr10,  2, ".", ""),
                                            "CummulativeB4MortgageYr10"=> number_format( $CummulativeB4MortgageYr10,  2, ".", ""),
                                            
                                          
                
                                            
                                            "IncomeTaxPurpose"      => number_format( $IncomeTaxPurpose,  2, ".", ""),
                                            "TotalIntDeductible"    => number_format( $TotalIntDeductible,  2, ".", ""),
                                            "TaxableIncome"         => number_format( $TaxableIncome,  2, ".", ""),
                                            "TaxableIncAllowance"   => number_format( $TaxableIncAllowance,  2, ".", ""),
                                            "IncomeTaxAmt"          => number_format( $IncomeTaxAmt,  2, ".", ""),
                                            
                                            "CapitalGainYr5"        => number_format( $CapitalGainYr5,  2, ".", ""),
                                            "CapitalGainYr5Exempt"  => number_format( $CapitalGainYr5Exempt,  2, ".", ""),
                                            "CapitalGain5YrTax"     => number_format( $CapitalGain5YrTax,  2, ".", ""),
                                            "CapitalGainYr10"       => number_format( $CapitalGainYr10,  2, ".", ""),
                                            "CapitalGainYr10Exempt" => number_format( $CapitalGainYr10Exempt,  2, ".", ""),
                                            "CapitalGain10YrTax"    => number_format( $CapitalGain10YrTax,  2, ".", ""),
            
                                            
                                            
                                           );
            
            $ValueArr[]             = $TempArr;
        }
        
        echo "<pre>"; print_r($ValueArr); echo "</pre>";
		
		$YearStr					= ""; 
		$YearNoStr					= ""; 
		$RentalGrowthStr			= ""; 
		$CapitalApprRateStr			= ""; 


		for ($i = 0; $i <= 10; $i++){ 
			$YearNoStr				.= "	<td>{$i}</td>";
			
			if (intval($i) > 0 ){
				$YearStr			.= "	<td>{$i}</td>";
				$RentalGrowthStr	.= "	<td>{$RentalGrowthArr[$i]}</td>";
				$CapitalApprRateStr	.= "	<td>{$CapitalApprecRateArr[$i]}</td>";
			}
		}
        

		echo "	<table class='table final-table'>
    				<thead>
						<tr style='font-weight:bold; '>
							<td>&nbsp;</td>
							<td>Year</td>
							{$YearStr}
						</tr>

						 <tr style='font-weight:bold; '>
						 	<td>Forecast Rental Growth Rate pa</td>
						 	<td>* Rent growth projected by JLL</td>
							{$RentalGrowthStr}
						 </tr>

						 <tr style='font-weight:bold; '>
						 	<td>Forecast Capital Appreciation Rate pa</td>
						 	<td>* Capital growth projected by JLL</td>
							{$CapitalApprRateStr}
						 </tr>
    			 </thead>

				 <tbody>
					 <tr class='heading-seprator bg-light-blue'>
						<td>a. Income & Capital Appreciation</td>
						<td>{$YearNoStr}</td>
					 </tr>
					 
					 <tr>
						<td>income</td>
						<td>Construction</td>
						<td colspan=10>{$ValueArr[10]["RentalIncome"]}</td>
					 </tr>


					 <tr>
						<td>Rental income $</td>
						<td>{$ValueArr[0]["RentalIncome"]}</td>
						<td>{$ValueArr[1]["RentalIncome"]}</td>
						<td>{$ValueArr[2]["RentalIncome"]}</td>
						<td>{$ValueArr[3]["RentalIncome"]}</td>
						<td>{$ValueArr[4]["RentalIncome"]}</td>
						<td>{$ValueArr[5]["RentalIncome"]}</td>
						<td>{$ValueArr[6]["RentalIncome"]}</td>
						<td>{$ValueArr[7]["RentalIncome"]}</td>
						<td>{$ValueArr[8]["RentalIncome"]}</td>
						<td>{$ValueArr[9]["RentalIncome"]}</td>
						<td>{$ValueArr[10]["RentalIncome"]}</td>
					 </tr>

					 <tr>
						<td>Property Value - Year Beginning</td>
						<td>&nbsp;</td>
						<td>{$ValueArr[1]["PropertyValue"]}</td>
						<td>{$ValueArr[2]["PropertyValue"]}</td>
						<td>{$ValueArr[3]["PropertyValue"]}</td>
						<td>{$ValueArr[4]["PropertyValue"]}</td>
						<td>{$ValueArr[5]["PropertyValue"]}</td>
						<td>{$ValueArr[6]["PropertyValue"]}</td>
						<td>{$ValueArr[7]["PropertyValue"]}</td>
						<td>{$ValueArr[8]["PropertyValue"]}</td>
						<td>{$ValueArr[9]["PropertyValue"]}</td>
						<td>{$ValueArr[10]["PropertyValue"]}</td>
					 </tr>

					 <tr>
						<td>Capital Appreciation</td>
						<td>{$ValueArr[1]["CapitalAppreciate"]}</td>
						<td>{$ValueArr[2]["CapitalAppreciate"]}</td>
						<td>{$ValueArr[3]["CapitalAppreciate"]}</td>
						<td>{$ValueArr[4]["CapitalAppreciate"]}</td>
						<td>{$ValueArr[5]["CapitalAppreciate"]}</td>
						<td>{$ValueArr[6]["CapitalAppreciate"]}</td>
						<td>{$ValueArr[7]["CapitalAppreciate"]}</td>
						<td>{$ValueArr[8]["CapitalAppreciate"]}</td>
						<td>{$ValueArr[9]["CapitalAppreciate"]}</td>
						<td>{$ValueArr[10]["CapitalAppreciate"]}</td>
					 </tr>

					 <tr>
						<td>Property Value - Year End</td>
						<td>{$ValueArr[1]["PropertyPriceYrEnd"]}</td>
						<td>{$ValueArr[2]["PropertyPriceYrEnd"]}</td>
						<td>{$ValueArr[3]["PropertyPriceYrEnd"]}</td>
						<td>{$ValueArr[4]["PropertyPriceYrEnd"]}</td>
						<td>{$ValueArr[5]["PropertyPriceYrEnd"]}</td>
						<td>{$ValueArr[6]["PropertyPriceYrEnd"]}</td>
						<td>{$ValueArr[7]["PropertyPriceYrEnd"]}</td>
						<td>{$ValueArr[8]["PropertyPriceYrEnd"]}</td>
						<td>{$ValueArr[9]["PropertyPriceYrEnd"]}</td>
						<td>{$ValueArr[10]["PropertyPriceYrEnd"]}</td>
					 </tr>
					 
					 <tr>
						<td>Sale Proceeds Year 5 - Year End</td>
						<td>{$ValueArr[1]["SaleProceedYrEnd5"]}</td>
						<td>{$ValueArr[2]["SaleProceedYrEnd5"]}</td>
						<td>{$ValueArr[3]["SaleProceedYrEnd5"]}</td>
						<td>{$ValueArr[4]["SaleProceedYrEnd5"]}</td>
						<td>{$ValueArr[5]["SaleProceedYrEnd5"]}</td>
						<td>{$ValueArr[6]["SaleProceedYrEnd5"]}</td>
						<td>{$ValueArr[7]["SaleProceedYrEnd5"]}</td>
						<td>{$ValueArr[8]["SaleProceedYrEnd5"]}</td>
						<td>{$ValueArr[9]["SaleProceedYrEnd5"]}</td>
						<td>{$ValueArr[10]["SaleProceedYrEnd5"]}</td>
					 </tr>
					 
					 
					 <tr>
						<td>Sale Proceeds Year 10 - Year End</td>
						<td>{$ValueArr[1]["SaleProceedYrEnd10"]}</td>
						<td>{$ValueArr[2]["SaleProceedYrEnd10"]}</td>
						<td>{$ValueArr[3]["SaleProceedYrEnd10"]}</td>
						<td>{$ValueArr[4]["SaleProceedYrEnd10"]}</td>
						<td>{$ValueArr[5]["SaleProceedYrEnd10"]}</td>
						<td>{$ValueArr[6]["SaleProceedYrEnd10"]}</td>
						<td>{$ValueArr[7]["SaleProceedYrEnd10"]}</td>
						<td>{$ValueArr[8]["SaleProceedYrEnd10"]}</td>
						<td>{$ValueArr[9]["SaleProceedYrEnd10"]}</td>
						<td>{$ValueArr[10]["SaleProceedYrEnd10"]}</td>
					 </tr>
					 
					 <tr>
						<td>Total Income Year 5 - Year End</td>
						<td>{$ValueArr[1]["TotalIncome5YrEnd"]}</td>
						<td>{$ValueArr[2]["TotalIncome5YrEnd"]}</td>
						<td>{$ValueArr[3]["TotalIncome5YrEnd"]}</td>
						<td>{$ValueArr[4]["TotalIncome5YrEnd"]}</td>
						<td>{$ValueArr[5]["TotalIncome5YrEnd"]}</td>
						<td>{$ValueArr[6]["TotalIncome5YrEnd"]}</td>
						<td>{$ValueArr[7]["TotalIncome5YrEnd"]}</td>
						<td>{$ValueArr[8]["TotalIncome5YrEnd"]}</td>
						<td>{$ValueArr[9]["TotalIncome5YrEnd"]}</td>
						<td>{$ValueArr[10]["TotalIncome5YrEnd"]}</td>
					 </tr>
					 
					 <tr>
						<td>Total Income Year 10 - Year End</td>
						<td>{$ValueArr[1]["TotalIncome10YrEnd"]}</td>
						<td>{$ValueArr[2]["TotalIncome10YrEnd"]}</td>
						<td>{$ValueArr[3]["TotalIncome10YrEnd"]}</td>
						<td>{$ValueArr[4]["TotalIncome10YrEnd"]}</td>
						<td>{$ValueArr[5]["TotalIncome10YrEnd"]}</td>
						<td>{$ValueArr[6]["TotalIncome10YrEnd"]}</td>
						<td>{$ValueArr[7]["TotalIncome10YrEnd"]}</td>
						<td>{$ValueArr[8]["TotalIncome10YrEnd"]}</td>
						<td>{$ValueArr[9]["TotalIncome10YrEnd"]}</td>
						<td>{$ValueArr[10]["TotalIncome10YrEnd"]}</td>
					 </tr>
					 
				</tbody>
    			 
    		  </table>";
    		  
    		  
        //"RentalIncome"          => number_format( (intval($i) == 0) ? 0 : $RentalIncome, 2),
        //"RentalYield"
        
        //$CapitalApprStr1        = implode(",", $CapitalApprArr1); 
        //$CapitalApprStr3        = implode(",", $CapitalApprecRateArr);   
        
        
                                            
              
		echo '  <!--<h4 class="card-title">Rental Growth & Yield</h4>-->
                <div id="chart1"></div>';
                
                
        echo '  <!--<h4 class="card-title">Illustrative property value and capital appreciation</h4>-->
                <div id="chart2"></div>';
        
        
        echo "  <!-- <script src='https://cdn.jsdelivr.net/npm/apexcharts'></script> -->
                <script>
                    var options = {
                      series: [{
                      name: 'Rental Income',
                      type: 'column',
                      data: [" . $RentalIncGraphStr1 . "]
                      //data: [9480, 9764, 10057, 10409, 10722, 11043, 11375, 11716, 12067, 12429]
                    }, {
                      name: 'Rental Yield',
                      type: 'line',
                      data: [" . $RentalIncGraphStr2 . "]
                      //data: [5.8, 6, 6.2, 6.4, 6.6, 6.8, 7, 7.2, 7.4, 7.6]
                    }],
                      chart: {
                      height: 350,
                      type: 'line',
                    },
                    stroke: {
                      width: [0, 4]
                    },
                    title: {
                      text: 'Rental Growth & Yield'
                    },
                    dataLabels: {
                      enabled: true,
                      enabledOnSeries: [1]
                    },
                    labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                    xaxis: {
                      // type: 'datetime'
                    },
                    yaxis: [{
                      title: {
                        text: 'Rental GBP',
                      },
                    
                    }, {
                      opposite: true,
                      title: {
                        text: 'Rental Yield(%)'
                      }
                    }]
                    };
            
                    var chart = new ApexCharts(document.querySelector('#chart1'), options);
                    chart.render();
                </script>
                <script>
                    var options = {
                      series: [{
                      name: 'Rental Income',
                      type: 'column',
                      data: [" . $CapitalApprStr1 . "]
                      //data: [9480, 9764, 10057, 10409, 10722, 11043, 11375, 11716, 12067, 12429]
                    }, {
                      name: 'Rental Yield',
                      type: 'line',
                      data: [" . $CapitalApprStr2 . "]
                      //data: [5.8, 6, 6.2, 6.4, 6.6, 6.8, 7, 7.2, 7.4, 7.6]
                    }, {
                      name: 'Rental Yiel 2d',
                      type: 'line',
                      data: [" . $CapitalApprStr3 . "]
                      //data: [5.8, 6, 6.2, 6.4, 6.6, 6.8, 7, 7.2, 7.4, 7.6]
                    }],
                      chart: {
                      height: 350,
                      type: 'line',
                    },
                    stroke: {
                      width: [0, 4]
                    },
                    title: {
                      text: 'Illustrative property value and capital appreciation'
                    },
                    dataLabels: {
                      enabled: true,
                      enabledOnSeries: [1]
                    },
                    labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                    xaxis: {
                      // type: 'datetime'
                    },
                    yaxis: [{
                      title: {
                        text: 'Rental GBP',
                      },
                    
                    }, {
                      opposite: true,
                      title: {
                        text: 'Rental Yield(%)'
                      }
                    }]
                    };
            
                    var chart = new ApexCharts(document.querySelector('#chart2'), options);
                    chart.render();
                </script>
                
                
                <script>
                   /* var options = {
                      series: [{
                      name: 'Rental Income',
                      type: 'column',
                      data: [" . $CapitalApprStr1 . "]
                    }, {
                      name: 'Rental Yield',
                      type: 'line',
                      data: [" . $CapitalApprStr2 . "]
                    }],
                      chart: {
                      height: 350,
                      type: 'line',
                    },
                    stroke: {
                      width: [0, 4]
                    },
                    title: {
                      text: 'Rental Growth & Yiled'
                    },
                    dataLabels: {
                      enabled: true,
                      enabledOnSeries: [1]
                    },
                    labels: ['0', 1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                    xaxis: {
                      // type: 'datetime'
                    },
                    yaxis: [{
                      title: {
                        text: 'Rental GBP',
                      },
                    
                    }, {
                      opposite: true,
                      title: {
                        text: 'Rental Yield(%)'
                      }
                    }]
                    };
            
                    var chart = new ApexCharts(document.querySelector('#chart2'), options);
                    chart.render();*/
                </script>
                "; 
        
	}
    
    
    
    public static function AnalyzerResultOld(){
	    self::Init();
        
        //echo "<pre>"; print_r($_REQUEST); echo "</pre>"; 
        
        $CapitalGrowthRate          = isset($_REQUEST["CapitalGrowthRate"]) ? $_REQUEST["CapitalGrowthRate"] : 0;
        $CapitalGrowthRate          = number_format($CapitalGrowthRate, 2); 
        $RentalPriceIndex           = number_format(2, 2);
        $ChattelsValue              = 30000; 
        
        $arr_weekly_rents           = isset($_REQUEST["arr_weekly_rents"]) ? $_REQUEST["arr_weekly_rents"] : 0;
        
        
        $loan_purchase_market_value = isset($_REQUEST["loan_purchase_market_value"]) ? $_REQUEST["loan_purchase_market_value"] : 0;
        $CorporateFees              = isset($_REQUEST["ape_body_corporate"]) ? $_REQUEST["ape_body_corporate"] : 0;
        $Rates                      = isset($_REQUEST["ape_rates"]) ? $_REQUEST["ape_rates"] : 0;
        
        $InterestRate               = floatval( isset($_REQUEST["loan_interset_rate"]) ? $_REQUEST["loan_interset_rate"] : 0 );
        
        
        $ValueArr                   = array();
        
        for ($i = 0; $i <= 10; $i++){
            if ($i == 0){
                $MarketValue        = $loan_purchase_market_value;
                $LoanAmt            = floatval($MarketValue) * 0.80;
                $Deposit            = floatval($MarketValue) - floatval($LoanAmt);
                $DepositDisp        = number_format( $Deposit, 2 );
                $ChattelsValueDisp  = number_format( $ChattelsValue, 2 );
                
                $EquityInProp       = floatval($MarketValue) - floatval($LoanAmt);
                $FirstEquityInProp  = $EquityInProp;
                
                 if ( $MarketValue > 0){
                      $LoanRatio          = round( (floatval($LoanAmt) / floatval($MarketValue)) * 100 );
                      
                } else{
                      $LoanRatio          = round( (floatval($LoanAmt) / 1) * 100 ); // Arzath - 2020-03-04
                }
                //$LoanRatio          = round( (floatval($LoanAmt) / floatval($MarketValue)) * 100 );
                
                $SurplusEqu80       = (floatval($MarketValue) * 0.80) - floatval($LoanAmt);
                $RentalIncome       = floatval($arr_weekly_rents) * 52;
                $RentPerWeek        = $arr_weekly_rents;
                
                if ( $MarketValue > 0){
                      $GrossYield         = (floatval($RentalIncome) / floatval($MarketValue) ) * 100;
                }  else{
                      $GrossYield         = (floatval($RentalIncome) / 1) * 100;
                }
                
                //$GrossYield         = (floatval($RentalIncome) / floatval($MarketValue) ) * 100;
                $PropertyMgmt       = (floatval($RentalIncome) * 9.9) / 100;
                $CorporateFees      = floatval($CorporateFees); 
                
                $TotalPropExpense   = floatval($PropertyMgmt) + floatval($CorporateFees) + floatval($Rates);
                $InterestPayment    = floatval($LoanAmt) * floatval($InterestRate) / 100; 
                $PreTaxCashFlowPa   = floatval($RentalIncome) - floatval($InterestPayment) - floatval($TotalPropExpense);
                $PreTaxCashFlowPw   = ceil(floatval($PreTaxCashFlowPa) / 52);
                
                $Depreciation       = floatval($ChattelsValue) / 10;
                
                $TaxLossCarryFwd    = 0;
                
                $NonCashDedTotal    = floatval($Depreciation) + floatval($TaxLossCarryFwd);
                $TotalDeduction     = floatval($InterestPayment) + floatval($TotalPropExpense) + floatval($NonCashDedTotal);
                $NetProfitLoss      = floatval($RentalIncome) - floatval($TotalDeduction);
                
                $TaxPer28           = 0;
                $AfterTaxCashPa     = floatval($PreTaxCashFlowPa) - floatval($TaxPer28);
                $AfterTaxCashPw     = floatval($AfterTaxCashPa) / 52;
                
                $CashAvailDistribution = $AfterTaxCashPa;
                
                //CashAvailDistribution, CashAccBal, TotalReturn, ROICummulative
                $CashAccBal         = $CashAvailDistribution;
                
                $TotalReturn        = $CashAccBal;
                
                if ( $EquityInProp > 0) {
                     $ROICummulative     = round( (floatval($TotalReturn) / floatval($EquityInProp))*100 );
                }else{
                    $ROICummulative     = round( (floatval($TotalReturn) / 1)*100 );
                }
                
               // $ROICummulative     = round( (floatval($TotalReturn) / floatval($EquityInProp))*100 );
            }
            else{
                $MarketValue        = (floatval($MarketValue) * floatval($CapitalGrowthRate) / 100) + floatval($MarketValue);
                $DepositDisp        = "";
                $ChattelsValueDisp  = ""; 
                
                
                
                $EquityInProp       = floatval($MarketValue) - floatval($LoanAmt);
                 
                if ( $MarketValue > 0){
                     $LoanRatio          = round( (floatval($LoanAmt) / floatval($MarketValue)) * 100 );
                }else{
                     $LoanRatio          = round( (floatval($LoanAmt) / 1) * 100 );
                }
               // $LoanRatio          = round( (floatval($LoanAmt) / floatval($MarketValue)) * 100 );
                
                $SurplusEqu80       = (floatval($MarketValue) * 0.80) - floatval($LoanAmt);
                $RentalIncome       = floatval($RentalIncome) + (floatval($RentalIncome) * floatval($RentalPriceIndex) / 100);
                $RentPerWeek        = floatval($RentalIncome) / 12;
                
                 if ( $LoanAmt > 0){
                      $GrossYield         = (floatval($RentalIncome) / floatval($LoanAmt) ) * 100;
                }  else{
                      $GrossYield         = (floatval($RentalIncome) / 1 ) * 100;
                }
               // $GrossYield         = (floatval($RentalIncome) / floatval($LoanAmt) ) * 100;
                
                
                $PropertyMgmt       = (floatval($RentalIncome) * 8) / 100;
                
                $TotalPropExpense   = floatval($PropertyMgmt) + floatval($CorporateFees) + floatval($Rates);
                $InterestPayment    = floatval($LoanAmt) * floatval($InterestRate) / 100; 
                $PreTaxCashFlowPa   = floatval($RentalIncome) - floatval($InterestPayment) - floatval($TotalPropExpense);
                $PreTaxCashFlowPw   = ceil(floatval($PreTaxCashFlowPa) / 52);
                
                $TaxLossCarryFwd    = $NetProfitLoss;
                
                $NonCashDedTotal    = floatval($Depreciation) + floatval($TaxLossCarryFwd);
                $TotalDeduction     = floatval($InterestPayment) + floatval($TotalPropExpense) + floatval($NonCashDedTotal);
                $NetProfitLoss      = floatval($RentalIncome) - floatval($TotalDeduction);
                
                $TaxPer28           = floatval($NetProfitLoss) * 28 / 100; 
                
                $AfterTaxCashPa     = floatval($PreTaxCashFlowPa) - floatval($TaxPer28);
                $AfterTaxCashPw     = floatval($AfterTaxCashPa) / 52;
                
                $CashAvailDistribution = $AfterTaxCashPa;
                $CashAccBal         = floatval($CashAccBal) + floatval($CashAvailDistribution);
                
                $TotalReturn        = floatval($CashAccBal) + floatval($EquityInProp) - floatval($FirstEquityInProp);
                
                
                if ( $LoanAmt > 0){
                     $ROICummulative     = round( (floatval($TotalReturn) / floatval($Deposit))*100 );
                }  else{
                     $ROICummulative     = round( (floatval($TotalReturn) / 1)*100 );
                }
                
                //$ROICummulative     = round( (floatval($TotalReturn) / floatval($Deposit))*100 );
            }
            
            $TempArr                = array("MarketValue"       => number_format( floatval($MarketValue), 2 ), 
                                            "LoanAmt"           => number_format($LoanAmt, 2),
                                            "Deposit"           => $Deposit,
                                            "DepositDisp"       => $DepositDisp,
                                            "ChattelsValue"     => $ChattelsValue,
                                            "ChattelsValueDisp" => $ChattelsValueDisp,
                                            "EquityInProp"      => number_format($EquityInProp, 2),
                                            "LoanRatio"         => $LoanRatio,
                                            "SurplusEqu80"      => $SurplusEqu80,
                                            "RentalIncome"      => number_format($RentalIncome, 2),
                                            "RentPerWeek"       => number_format($RentPerWeek, 2),
                                            "GrossYield"        => number_format($GrossYield, 2),
                                            "PropertyMgmt"      => number_format($PropertyMgmt, 2),
                                            "CorporateFees"     => number_format($CorporateFees, 2),
                                            "Rates"             => number_format(floatval($Rates), 2),
                                            "TotalPropExpense"  => number_format(floatval($TotalPropExpense), 2),
                                            "InterestRate"      => number_format(floatval($InterestRate), 2),
                                            "InterestPayment"   => number_format($InterestPayment, 2),
                                            "PreTaxCashFlowPa"  => number_format($PreTaxCashFlowPa, 2),
                                            "PreTaxCashFlowPw"  => number_format($PreTaxCashFlowPw, 2),
                                            "Depreciation"      => number_format($Depreciation, 2),
                                            
                                            "TaxLossCarryFwd"   => number_format($TaxLossCarryFwd, 2),
                                            "NonCashDedTotal"   => number_format($NonCashDedTotal, 2),
                                            "TotalDeduction"    => number_format($TotalDeduction, 2),
                                            "NetProfitLoss"     => number_format($NetProfitLoss, 2),
                                            "TaxPer28"          => number_format($TaxPer28, 2),
                                            "AfterTaxCashPa"    => number_format($AfterTaxCashPa, 2),
                                            "AfterTaxCashPw"    => number_format($AfterTaxCashPw, 2),
                                            "CashAvailDistribution" => number_format($CashAvailDistribution, 2),
                                            "CashAccBal"        => number_format($CashAccBal, 2),
                                            "TotalReturn"       => number_format($TotalReturn, 2),
                                            "ROICummulative"    => $ROICummulative
                                            
                                           );
            
            $ValueArr[]             = $TempArr;
        }
        
        //echo "<pre>"; print_r($ValueArr); echo "</pre>"; 
        

		echo "	<table class='table final-table'>
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
    			 <tr class='heading-seprator bg-light-blue'>
    				<td colspan='6'>OVERVIEW</td>
    			 </tr>
    			 <tr>
    				<td>Capital growth rate %</td>
    				<td>{$CapitalGrowthRate}</td>
    				<td>{$CapitalGrowthRate}</td>
    				<td>{$CapitalGrowthRate}</td>
    				<td>{$CapitalGrowthRate}</td>
    				<td>{$CapitalGrowthRate}</td>
    			 </tr>
    			 <tr>
    				<td>Auckland rental price index %</td>
    				<td>{$RentalPriceIndex}</td>
    				<td>{$RentalPriceIndex}</td>
    				<td>{$RentalPriceIndex}</td>
    				<td>{$RentalPriceIndex}</td>
    				<td>{$RentalPriceIndex}</td>
    			 </tr>
    			 <tr>
    				<td>Property market value $</td>
    				<td>{$ValueArr[0]["MarketValue"]}</td>
    				<td>{$ValueArr[1]["MarketValue"]}</td>
    				<td>{$ValueArr[3]["MarketValue"]}</td>
    				<td>{$ValueArr[5]["MarketValue"]}</td>
    				<td>{$ValueArr[10]["MarketValue"]}</td>
    			 </tr>
    			 <tr>
    				<td>Amount of loan $ </td>
    				<td>{$ValueArr[0]["LoanAmt"]}</td>
    				<td>{$ValueArr[0]["LoanAmt"]}</td>
    				<td>{$ValueArr[0]["LoanAmt"]}</td>
    				<td>{$ValueArr[0]["LoanAmt"]}</td>
    				<td>{$ValueArr[0]["LoanAmt"]}</td>
    			 </tr>
    			 
    			 <tr>
    				<td>Deposit </td>
    				<td>{$ValueArr[0]["DepositDisp"]}</td>
    				<td>&nbsp;</td>
    				<td>&nbsp;</td>
    				<td>&nbsp;</td>
    				<td>&nbsp;</td>
    			 </tr>
    			 
    			 <tr>
    				<td>Chattels value </td>
    				<td>{$ValueArr[0]["ChattelsValueDisp"]}</td>
    				<td>&nbsp;</td>
    				<td>&nbsp;</td>
    				<td>&nbsp;</td>
    				<td>&nbsp;</td>
    			 </tr>
    			 
    			 
    			 <tr class='heading-seprator bg-light-blue'>
    				<td>STATISTICS</td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    			 </tr>
    			 <tr>
    				<td>Equity in property $</td>
    				<td>{$ValueArr[0]["EquityInProp"]}</td>
    				<td>{$ValueArr[1]["EquityInProp"]}</td>
    				<td>{$ValueArr[3]["EquityInProp"]}</td>
    				<td>{$ValueArr[5]["EquityInProp"]}</td>
    				<td>{$ValueArr[10]["EquityInProp"]}</td>
    			 </tr>
    			 <tr>
    				<td>Loan to value ratio %</td>
    				<td>{$ValueArr[0]["LoanRatio"]}</td>
    				<td>{$ValueArr[1]["LoanRatio"]}</td>
    				<td>{$ValueArr[3]["LoanRatio"]}</td>
    				<td>{$ValueArr[5]["LoanRatio"]}</td>
    				<td>{$ValueArr[10]["LoanRatio"]}</td>
    			 </tr>
    			 <tr>
    				<td>Surplus equity to reinvest $</td>
    				<td>{$ValueArr[0]["SurplusEqu80"]}</td><!-- class='text-danger' -->
    				<td class='text-danger'>{$ValueArr[1]["SurplusEqu80"]}</td>
    				<td>{$ValueArr[3]["SurplusEqu80"]}</td>
    				<td>{$ValueArr[5]["SurplusEqu80"]}</td>
    				<td>{$ValueArr[10]["SurplusEqu80"]}</td>
    			 </tr>
    			 
    			 <!--
    			 <tr>
    				<td>Buying power $</td>
    				<td class='text-danger'>(649,000)</td>
    				<td class='text-danger'>(433,792)</td>
    				<td>51,627</td>
    				<td>620,863</td>
    				<td>2,511,894</td>
    			 </tr>
    			 -->
    			 
    			 <tr>
    				<td>Rental income $</td>
    				<td>{$ValueArr[0]["RentalIncome"]}</td>
    				<td>{$ValueArr[1]["RentalIncome"]}</td>
    				<td>{$ValueArr[3]["RentalIncome"]}</td>
    				<td>{$ValueArr[5]["RentalIncome"]}</td>
    				<td>{$ValueArr[10]["RentalIncome"]}</td>
    			 </tr>
    			 
    			 <tr>
    				<td>Rental Per Week $</td>
    				<td>{$ValueArr[0]["RentPerWeek"]}</td>
    				<td>{$ValueArr[1]["RentPerWeek"]}</td>
    				<td>{$ValueArr[3]["RentPerWeek"]}</td>
    				<td>{$ValueArr[5]["RentPerWeek"]}</td>
    				<td>{$ValueArr[10]["RentPerWeek"]}</td>
    			 </tr>
    			 
    			 <tr>
    				<td>Gross yield %</td>
    				<td>{$ValueArr[0]["GrossYield"]}</td>
    				<td>{$ValueArr[1]["GrossYield"]}</td>
    				<td>{$ValueArr[3]["GrossYield"]}</td>
    				<td>{$ValueArr[5]["GrossYield"]}</td>
    				<td>{$ValueArr[10]["GrossYield"]}</td>
    			 </tr>
    			 <tr>
    				<td>Net yield %</td>
    				<td>{$ValueArr[0]["GrossYield"]}</td>
    				<td>{$ValueArr[1]["GrossYield"]}</td>
    				<td>{$ValueArr[3]["GrossYield"]}</td>
    				<td>{$ValueArr[5]["GrossYield"]}</td>
    				<td>{$ValueArr[10]["GrossYield"]}</td>
    			 </tr>
    			 <tr class='heading-seprator bg-light-blue'>
    				<td colspan='6'>CASH DEDUCTIONS</td>
    			 </tr>
    			 <tr>
    				<td>Property Management $</td>
    				<td>{$ValueArr[0]["PropertyMgmt"]}</td>
    				<td>{$ValueArr[1]["PropertyMgmt"]}</td>
    				<td>{$ValueArr[3]["PropertyMgmt"]}</td>
    				<td>{$ValueArr[5]["PropertyMgmt"]}</td>
    				<td>{$ValueArr[10]["PropertyMgmt"]}</td>
    			 </tr>
    			 
    			 <tr>
    				<td>Body corporate fee $</td>
    				<td>{$ValueArr[0]["CorporateFees"]}</td>
    				<td>{$ValueArr[1]["CorporateFees"]}</td>
    				<td>{$ValueArr[3]["CorporateFees"]}</td>
    				<td>{$ValueArr[5]["CorporateFees"]}</td>
    				<td>{$ValueArr[10]["CorporateFees"]}</td>
    			 </tr>
    			 
    			 <tr>
    				<td>Rates $</td>
    				<td>{$ValueArr[0]["Rates"]}</td>
    				<td>{$ValueArr[1]["Rates"]}</td>
    				<td>{$ValueArr[3]["Rates"]}</td>
    				<td>{$ValueArr[5]["Rates"]}</td>
    				<td>{$ValueArr[10]["Rates"]}</td>
    			 </tr>
    			 
    			 <tr>
    				<td>Total property expenses $</td>
    				<td>{$ValueArr[0]["TotalPropExpense"]}</td>
    				<td>{$ValueArr[1]["TotalPropExpense"]}</td>
    				<td>{$ValueArr[3]["TotalPropExpense"]}</td>
    				<td>{$ValueArr[5]["TotalPropExpense"]}</td>
    				<td>{$ValueArr[10]["TotalPropExpense"]}</td>
    			 </tr>
    			 
    			 
    			 
    			 
    			 <tr class='heading-seprator bg-light-blue'>
    				<td colspan='6'>Loan 1</td>
    			 </tr>
    			 <tr>
    				<td>Interest rate %</td>
    				<td>{$ValueArr[0]["InterestRate"]}</td>
    				<td>{$ValueArr[1]["InterestRate"]}</td>
    				<td>{$ValueArr[3]["InterestRate"]}</td>
    				<td>{$ValueArr[5]["InterestRate"]}</td>
    				<td>{$ValueArr[10]["InterestRate"]}</td>
    			 </tr>
    			 <tr>
    				<td>Interest payments $</td>
    				<td>{$ValueArr[0]["InterestPayment"]}</td>
    				<td>{$ValueArr[1]["InterestPayment"]}</td>
    				<td>{$ValueArr[3]["InterestPayment"]}</td>
    				<td>{$ValueArr[5]["InterestPayment"]}</td>
    				<td>{$ValueArr[10]["InterestPayment"]}</td>
    			 </tr>
    			 
    			 <tr>
    				<td>Pre-tax cash flow p/a $</td>
    				<td>{$ValueArr[0]["PreTaxCashFlowPa"]}</td>
    				<td>{$ValueArr[1]["PreTaxCashFlowPa"]}</td>
    				<td>{$ValueArr[3]["PreTaxCashFlowPa"]}</td>
    				<td>{$ValueArr[5]["PreTaxCashFlowPa"]}</td>
    				<td>{$ValueArr[10]["PreTaxCashFlowPa"]}</td>
    			 </tr>
    			 <tr>
    				<td>Pre-tax cash flow p/w $</td>
    				<td>{$ValueArr[0]["PreTaxCashFlowPw"]}</td>
    				<td>{$ValueArr[1]["PreTaxCashFlowPw"]}</td>
    				<td>{$ValueArr[3]["PreTaxCashFlowPw"]}</td>
    				<td>{$ValueArr[5]["PreTaxCashFlowPw"]}</td>
    				<td>{$ValueArr[10]["PreTaxCashFlowPw"]}</td>
    			 </tr>
    			 <tr class='heading-seprator bg-light-blue'>
    				<td>NON-CASH DEDUCTIONS</td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    			 </tr>
    			 <tr>
    				<td>Depreciation $</td>
    				<td>{$ValueArr[0]["Depreciation"]}</td>
    				<td>{$ValueArr[1]["Depreciation"]}</td>
    				<td>{$ValueArr[3]["Depreciation"]}</td>
    				<td>{$ValueArr[5]["Depreciation"]}</td>
    				<td>{$ValueArr[10]["Depreciation"]}</td>
    			 </tr>
    			 
    			 <tr>
    				<td>Tax loss (carried forward)</td>
    				<td>{$ValueArr[0]["TaxLossCarryFwd"]}</td>
    				<td>{$ValueArr[1]["TaxLossCarryFwd"]}</td>
    				<td>{$ValueArr[3]["TaxLossCarryFwd"]}</td>
    				<td>{$ValueArr[5]["TaxLossCarryFwd"]}</td>
    				<td>{$ValueArr[10]["TaxLossCarryFwd"]}</td>
    			 </tr>
    			 
    			 <tr>
    				<td>&nbsp;</td>
    				<td>{$ValueArr[0]["NonCashDedTotal"]}</td>
    				<td>{$ValueArr[1]["NonCashDedTotal"]}</td>
    				<td>{$ValueArr[3]["NonCashDedTotal"]}</td>
    				<td>{$ValueArr[5]["NonCashDedTotal"]}</td>
    				<td>{$ValueArr[10]["NonCashDedTotal"]}</td>
    			 </tr>
    			 

    			 <tr class='heading-seprator bg-light-blue'>
    				<td>SUMMARY</td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    			 </tr>
    			 <tr>
    				<td>Total deductions $</td>
    				<td>{$ValueArr[0]["TotalDeduction"]}</td>
    				<td>{$ValueArr[1]["TotalDeduction"]}</td>
    				<td>{$ValueArr[3]["TotalDeduction"]}</td>
    				<td>{$ValueArr[5]["TotalDeduction"]}</td>
    				<td>{$ValueArr[10]["TotalDeduction"]}</td>
    			 </tr>
    			 <tr>
    				<td>Net profit/loss $</td>
    				<td>{$ValueArr[0]["NetProfitLoss"]}</td>
    				<td>{$ValueArr[1]["NetProfitLoss"]}</td>
    				<td>{$ValueArr[3]["NetProfitLoss"]}</td>
    				<td>{$ValueArr[5]["NetProfitLoss"]}</td>
    				<td>{$ValueArr[10]["NetProfitLoss"]}</td>
    			 </tr>
    			 <tr>
    				<td>Tax 28%</td>
    				<td>{$ValueArr[0]["TaxPer28"]}</td>
    				<td>{$ValueArr[1]["TaxPer28"]}</td>
    				<td>{$ValueArr[3]["TaxPer28"]}</td>
    				<td>{$ValueArr[5]["TaxPer28"]}</td>
    				<td>{$ValueArr[10]["TaxPer28"]}</td>
    			 </tr>
    			 <tr>
    				<td>After tax cash flow p/a $ </td>
    				<td>{$ValueArr[0]["AfterTaxCashPa"]}</td>
    				<td>{$ValueArr[1]["AfterTaxCashPa"]}</td>
    				<td>{$ValueArr[3]["AfterTaxCashPa"]}</td>
    				<td>{$ValueArr[5]["AfterTaxCashPa"]}</td>
    				<td>{$ValueArr[10]["AfterTaxCashPa"]}</td>
    			 </tr>
    			 <tr>
    				<td>After tax cash flow p/w $</td>
    				<td>{$ValueArr[0]["AfterTaxCashPw"]}</td>
    				<td>{$ValueArr[1]["AfterTaxCashPw"]}</td>
    				<td>{$ValueArr[3]["AfterTaxCashPw"]}</td>
    				<td>{$ValueArr[5]["AfterTaxCashPw"]}</td>
    				<td>{$ValueArr[10]["AfterTaxCashPw"]}</td>
    			 </tr>
    			 
    			 <tr>
    				<td>Cash available for distribution / debt amortisation</td>
    				<td>{$ValueArr[0]["CashAvailDistribution"]}</td>
    				<td>{$ValueArr[1]["CashAvailDistribution"]}</td>
    				<td>{$ValueArr[3]["CashAvailDistribution"]}</td>
    				<td>{$ValueArr[5]["CashAvailDistribution"]}</td>
    				<td>{$ValueArr[10]["CashAvailDistribution"]}</td>
    			 </tr>
    			 
    			 <tr>
    				<td>Cash accumulated balance</td>
    				<td>{$ValueArr[0]["CashAccBal"]}</td>
    				<td>{$ValueArr[1]["CashAccBal"]}</td>
    				<td>{$ValueArr[3]["CashAccBal"]}</td>
    				<td>{$ValueArr[5]["CashAccBal"]}</td>
    				<td>{$ValueArr[10]["CashAccBal"]}</td>
    			 </tr>
    			 
    			 <tr>
    				<td>Total Return</td>
    				<td>{$ValueArr[0]["TotalReturn"]}</td>
    				<td>{$ValueArr[1]["TotalReturn"]}</td>
    				<td>{$ValueArr[3]["TotalReturn"]}</td>
    				<td>{$ValueArr[5]["TotalReturn"]}</td>
    				<td>{$ValueArr[10]["TotalReturn"]}</td>
    			 </tr>
    			 
    			 <tr>
    				<td>ROI (cumulative)</td>
    				<td>{$ValueArr[0]["ROICummulative"]}</td>
    				<td>{$ValueArr[1]["ROICummulative"]}</td>
    				<td>{$ValueArr[3]["ROICummulative"]}</td>
    				<td>{$ValueArr[5]["ROICummulative"]}</td>
    				<td>{$ValueArr[10]["ROICummulative"]}</td>
    			 </tr>
    			 
    		  </table>";
    		  
    		  
    	
		
        /*
        self::$Result       = \DBConn\DBConnection::getQuery( $SQL );
        
        self::$JsonResult   =   array(); 
        
        foreach(self::$Result as $row){
            self::$JsonResult[] = array("PAGE_LINK"   => $row["country_code"], "DESCRIPTION"  => $row["country_name"] );
        }
        
        header('Content-Type: application/json');
        echo json_encode(self::$JsonResult); 
        */
        
	}
	
	
	
    
    
    public static function test_cron(){
        $queryStr="insert into cron_test(cron_run_time) values (:cron_run_time)";


		$ColValarray = array("cron_run_time" => date("Y-m-d H:i:s")) ; 
		$Queryarray = array($queryStr,$ColValarray);

		$ArrQueries[]=$Queryarray;
        $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
    }
    public static function test_cronejob(){
        self::Init();
        $SQL = "SELECT usr.id,usr.USER_ID,usr.FIRST_NAME,usr.LAST_NAME,usr.SUBSCRIPTION_ID,
		usr.CURRNT_POINTS,usr.CREATED_ON,usr.CREATED_ON,
		usr.CREATED_USER,usr.ACTIVE_STATUS,usr.user_type_id,usrac.USER_ID as acountuserid,
		usrac.CARDHOLDER_NAME,usrac.CARD_NUMBER,usrac.CVV,usrac.EXPIRATION_DATE,usrac.COUNTRY,
        usrac.ADDRESS1,usrac.ADDRESS2,usrac.CITY,usrac.POSTAL_CODE,usrac.STATE,usrac.EMAIL_ADDRESS_FOR_INVOICE,usrac.COMPANY_NAME
		 FROM user_master usr 
		LEFT JOIN user_account_details usrac ON usr.id = usrac.USER_ID
		 WHERE usr.user_type_id='C'"; 

        self::$Result       = \DBConn\DBConnection::getQuery( $SQL );
		self::$JsonResult   =   array(); 
		$arr = array();
		foreach(self::$Result as $row){
			
		// 	self::$JsonResult[] = array("USER_ID"   => $row["USER_ID"], 
		// 	"FIRST_NAME" => $row["FIRST_NAME"],
		// 	"LAST_NAME"  => $row["LAST_NAME"],
		// 	"SUBSCRIPTION_ID"   => $row["SUBSCRIPTION_ID"],
		// 	"CURRNT_POINTS"        => $row["CURRNT_POINTS"],
		// 	"CREATED_ON"      => $row["CREATED_ON"],
		// 	"CREATED_USER"      => $row["CREATED_USER"],
		// 	"ACTIVE_STATUS"      => $row["ACTIVE_STATUS"],
		// 	"user_type_id"      => $row["user_type_id"],
		// 	"CARDHOLDER_NAME"      => $row["CARDHOLDER_NAME"],
		// 	"CARD_NUMBER"      => $row["CARD_NUMBER"],
		// 	"EXPIRATION_DATE"      => $row["EXPIRATION_DATE"],
		// 	"CVV"      => $row["CVV"],
		// 	"COUNTRY"      => $row["COUNTRY"],
		// 	"ADDRESS1"      => $row["ADDRESS1"],
		// 	"ADDRESS2"      => $row["ADDRESS2"],
		// 	"CITY"      => $row["CITY"],
		// 	"POSTAL_CODE"      => $row["POSTAL_CODE"],
		// 	"EMAIL_ADDRESS_FOR_INVOICE"      => $row["EMAIL_ADDRESS_FOR_INVOICE"],
		// 	"COMPANY_NAME"      => $row["COMPANY_NAME"],
		// 	"STATE"=> $row["STATE"]
		//    ); 
		   
		   $SQLSUBS = "SELECT * from subscription_details WHERE SUBSCRIPTION_ID =".$row["SUBSCRIPTION_ID"]; 
		   self::$Result       = \DBConn\DBConnection::getQuery( $SQLSUBS );
		   self::$JsonResult   =   array(); 
		   foreach(self::$Result as $row1){
			// $monthDate = $row["CREATED_ON"];
			if( $row["CREATED_ON"] != '0000-00-00'){
				$old_date = $row["CREATED_ON"];
                  if($row1["PERIOD_CODE"] == 'M'){
					$next_due_date_month = date('Y-m-d', strtotime($old_date. ' +30 days'));
					$date1 = date_create(date('Y-m-d')); // format of yyyy-mm-dd
				    $date2 = date_create($next_due_date_month); // format of yyyy-mm-dd
					$dateDiff = date_diff($date1, $date2);
					
					if($dateDiff->d == '0'){
						/**********Deduct money monthly base */
						$name = $row["CARDHOLDER_NAME"]; 
						  $nameArr = explode(' ', $name); 
						  $firstName = !empty($nameArr[0])?$nameArr[0]:''; 
						  $lastName = !empty($nameArr[1])?$nameArr[1]:''; 
						  $city = $row["CITY"]; 
						  $zipcode = $row["POSTAL_CODE"]; 
						  $countryCode = $row["COUNTRY"]; 
						  // Card details 
						  $creditCardNumber = trim(str_replace(" ","",$row["CARD_NUMBER"])); 
						  $creditCardType = 'Visa'; 
						  $expDate = explode('-',$row["EXPIRATION_DATE"]);
						  $expYear = $expDate['0']; 
						  $expMonth = $expDate['1']; 
						  $cvv =$row["CVV"]; 
						//   $paypalParams = array( 
						// 	  'paymentAction' => 'Sale', 
						// 	  'itemNumber' => '1', 
						// 	  'itemName' => 'sale', 
						// 	  'amount' => 10, 
						// 	  'currencyCode' => $currency, 
						// 	  'creditCardType' => $creditCardType, 
						// 	  'creditCardNumber' => $creditCardNumber, 
						// 	  'expMonth' => $expMonth, 
						// 	  'expYear' => $expYear, 
						// 	  'cvv' => $cvv, 
						// 	  'firstName' => $firstName, 
						// 	  'lastName' => $lastName, 
						// 	  'city' => $city, 
						// 	  'zip'    => $zipcode, 
						// 	  'countryCode' => $countryCode 
						//   ); 

						$creditCardNumber = '4032037707354318';
						$expMonth ='04';
						$expYear ='25';
						$cvv ='1234';

						  $payment_type = 'Sale';
						  $request  = 'METHOD=DoDirectPayment';
						  $request .= '&VERSION=51.0';
						  $request .= '&USER='.PAYPAL_USERNAME; // your paypal pro username
						  $request .= '&PWD='.PAYPAL_PASSWORD; //your paypal pro password  
						  $request .= '&SIGNATURE='.PAYPAL_SIGNATURE;  ////your paypal signature password  
						  $request .= '&CUSTREF=' . (int)$row['id'];
						  $request .= '&PAYMENTACTION=' . $payment_type;
						  $request .= '&AMT='.'10';
						  $request .= '&CREDITCARDTYPE=' . $creditCardType;
						  $request .= '&ACCT=' . urlencode(str_replace(' ', '', $creditCardNumber));
						 // $request .= '&CARDSTART=' . urlencode($_POST['cc_start_date_month'] . $_POST['cc_start_date_year']);
						  $request .= '&EXPDATE=' . urlencode($expMonth . $expYear);
						  $request .= '&CVV2=' . urlencode($cvv);
						//   if ($_POST['cc_type'] == 'SWITCH' || $_POST['cc_type'] == 'SOLO') { 
						// 	  $request .= '&CARDISSUE=' . urlencode($_POST['cc_issue']);
						//   }  
						  $request .= '&FIRSTNAME=' . urlencode($firstName);
						  $request .= '&LASTNAME=' . urlencode($lastName);
						  $request .= '&EMAIL=' . urlencode($row['USER_ID']);
						  $request .= '&PHONENUM=' . urlencode($row['PHONE_NO']);
						  $request .= '&IPADDRESS=' . urlencode($_SERVER['REMOTE_ADDR']);
						  $request .= '&STREET=' . urlencode($row1['ADDRESS1']);
						  $request .= '&CITY=' . urlencode($city);
						  $request .= '&STATE=' . urlencode($row1['STATE']);
						  $request .= '&ZIP=' . urlencode($zipcode);
						  $request .= '&COUNTRYCODE=' . urlencode($countryCode);
						  $request .= '&CURRENCYCODE=' . urlencode('USD');
						  $curl = curl_init('https://api-3t.sandbox.paypal.com/nvp');
						  curl_setopt($curl, CURLOPT_PORT, 443);
						  curl_setopt($curl, CURLOPT_HEADER, 0);
						  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
						  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
						  curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
						  curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
						  curl_setopt($curl, CURLOPT_POST, 1);
						  curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
						  $response = curl_exec($curl);
							curl_close($curl);
							$filename = time().'data.txt';
							$fp = fopen($filename,'w');
							fwrite($fp, $response);
                            $response_info = array();
                             parse_str($response, $response_info);

                             echo "<pre>"; print_r($response_info ); die;
						 /************End  */
					}
				  }
				  if($row1["PERIOD_CODE"] == 'Y'){
					$futureDateYear=date('Y-m-d', strtotime('+1 year', strtotime($old_date)) );
					$date1 = date_create(date('Y-m-d')); // format of yyyy-mm-dd
				    $date2 = date_create($futureDateYear); // format of yyyy-mm-dd
					$dateDiff = date_diff($date1, $date2);
					if($dateDiff->d == '0'){
						  /********* deduct money yearly base */
						  $name = $row["CARDHOLDER_NAME"]; 
						  $nameArr = explode(' ', $name); 
						  $firstName = !empty($nameArr[0])?$nameArr[0]:''; 
						  $lastName = !empty($nameArr[1])?$nameArr[1]:''; 
						  $city = $row["CITY"]; 
						  $zipcode = $row["POSTAL_CODE"]; 
						  $countryCode = $row["COUNTRY"]; 
						  // Card details 
						  $creditCardNumber = trim(str_replace(" ","",$row["CARD_NUMBER"])); 
						  $creditCardType = ''; 
						  $expDate = explode('-',$row["EXPIRATION_DATE"]);
						  $expYear = $expDate['0']; 
						  $expMonth = $expDate['1']; 
						  $cvv =$row["CVV"]; 
						//   $paypalParams = array( 
						// 	  'paymentAction' => 'Sale', 
						// 	  'itemNumber' => '1', 
						// 	  'itemName' => 'sale', 
						// 	  'amount' => 10, 
						// 	  'currencyCode' => $currency, 
						// 	  'creditCardType' => $creditCardType, 
						// 	  'creditCardNumber' => $creditCardNumber, 
						// 	  'expMonth' => $expMonth, 
						// 	  'expYear' => $expYear, 
						// 	  'cvv' => $cvv, 
						// 	  'firstName' => $firstName, 
						// 	  'lastName' => $lastName, 
						// 	  'city' => $city, 
						// 	  'zip'    => $zipcode, 
						// 	  'countryCode' => $countryCode 
						//   ); 
						  $payment_type = 'Sale';
						  $request  = 'METHOD=DoDirectPayment';
						  $request .= '&VERSION=51.0';
						  $request .= '&USER='.PAYPAL_USERNAME; // your paypal pro username
						  $request .= '&PWD='.PAYPAL_PASSWORD; //your paypal pro password  
						  $request .= '&SIGNATURE='.PAYPAL_SIGNATURE;  ////your paypal signature password  
						  $request .= '&CUSTREF=' . (int)$row['id'];
						  $request .= '&PAYMENTACTION=' . $payment_type;
						  $request .= '&AMT='.'10';
						  $request .= '&CREDITCARDTYPE=' . $creditCardType;
						  $request .= '&ACCT=' . urlencode(str_replace(' ', '', $creditCardNumber));
						 // $request .= '&CARDSTART=' . urlencode($_POST['cc_start_date_month'] . $_POST['cc_start_date_year']);
						  $request .= '&EXPDATE=' . urlencode($expMonth . $expYear);
						  $request .= '&CVV2=' . urlencode($cvv);
						//   if ($_POST['cc_type'] == 'SWITCH' || $_POST['cc_type'] == 'SOLO') { 
						// 	  $request .= '&CARDISSUE=' . urlencode($_POST['cc_issue']);
						//   }  
						  $request .= '&FIRSTNAME=' . urlencode($firstName);
						  $request .= '&LASTNAME=' . urlencode($lastName);
						  $request .= '&EMAIL=' . urlencode($row['USER_ID']);
						  $request .= '&PHONENUM=' . urlencode($row['PHONE_NO']);
						  $request .= '&IPADDRESS=' . urlencode($_SERVER['REMOTE_ADDR']);
						  $request .= '&STREET=' . urlencode($row1['ADDRESS1']);
						  $request .= '&CITY=' . urlencode($city);
						  $request .= '&STATE=' . urlencode($row1['STATE']);
						  $request .= '&ZIP=' . urlencode($zipcode);
						  $request .= '&COUNTRYCODE=' . urlencode($countryCode);
						  $request .= '&CURRENCYCODE=' . urlencode('USD');
						  $curl = curl_init('https://api-3t.sandbox.paypal.com/nvp');
						  curl_setopt($curl, CURLOPT_PORT, 443);
						  curl_setopt($curl, CURLOPT_HEADER, 0);
						  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
						  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
						  curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
						  curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
						  curl_setopt($curl, CURLOPT_POST, 1);
						  curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
						  $response = curl_exec($curl);
						  curl_close($curl);
						  $response_info = array(); 
						  /*************End  */
					  }

				   }
				
				 $arr[] = array(
					 "date"=>$next_due_date_month,
					 "id" =>  $row["USER_ID"],
					 'yeardate' =>$futureDateYear,
					 'diff'=>$dateDiff->d,
					 "code"=>$row1["PERIOD_CODE"]
				  );
			
			}			 
			/************Paypal payment gateway ***** */
		    
			// Call PayPal API 
		//	$response = $paypal->paypalCall($paypalParams); 
		//	$paymentStatus = strtoupper($response["ACK"]); 
			
		   }
		  
		}
		echo "<pre>"; print_r($arr); 
	}

    public static function suburb(){
        self::Init();
        
        $JsonRet            = file_get_contents("https://api-uat.corelogic.asia/access/oauth/token?client_id=jqhrXN8FIcA8LgMHvijARfAqzy0PD2Cp&client_secret=qWSAAO7n0XPjhMvT&grant_type=client_credentials");
        
        $JsonDecode         = json_decode($JsonRet); 
        
        $token              = $JsonDecode->access_token;
        
        $curl               = curl_init();
        
        if (is_numeric(self::$Propcountrycode)){
            $ChkAnalysisArr     = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_CODE_NEW FROM country_master WHERE COUNTRY_CODE ='" . self::$Propcountrycode . "' )");
            self::$Propcountrycode   = strtolower($ChkAnalysisArr["0"]); // Arzath - 2020-08-02
           // echo "code=>" . self::$Propcountrycode;
           // exit;
        }
        
        $Url                = "https://api-uat.corelogic.asia/property/".self::$Propcountrycode."/v2/suggest.json?q=" . self::$Keyword;
        
        //echo $Url;
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $Url, //. self::$Query
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          /*CURLOPT_POSTFIELDS => array(
                                    'grant_type' => 'authorization_code', 
                                    'code' => $token
                                    ), */
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $token,
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Length: 0"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          $RetArr = array(); 
        } else {
            //ECH
          $RetDecode = json_decode($response); 
          
             //echo "<pre>"; print_r($RetDecode); echo "</pre>";
           //exit;
          

          $SuggestArr = array();
          
          $CountryLng = 0; // Arzath - 2020-09-01
          $CountryLat = 0; // Arzath - 2020-09-01
          
          foreach($RetDecode->suggestions as $RetArr1){
              $RetArr[] = array("countryId"    => $RetArr1->countryId, 
                                 "localityId"   => $RetArr1->localityId, 
                                 "stateId"   => $RetArr1->stateId, 
                                 "streetId"   => $RetArr1->streetId, 
                                 "suggestion"   => $RetArr1->suggestion, 
                                 "suggestionType"   => $RetArr1->suggestionType ,
                                 "countrylng"   => $CountryLng, // Arzath - 2020-09-01
                                 "countrylat"   => $CountryLat  // Arzath - 2020-09-01
                                );
              
          }
          
        }
        
        header('Content-Type: application/json');
        echo json_encode($RetArr); 
    }
    
    
    public static function address(){
        self::Init();
        
        $JsonRet            = file_get_contents("https://api-uat.corelogic.asia/access/oauth/token?client_id=jqhrXN8FIcA8LgMHvijARfAqzy0PD2Cp&client_secret=qWSAAO7n0XPjhMvT&grant_type=client_credentials");
        
        $JsonDecode         = json_decode($JsonRet); 
        
        $token              = $JsonDecode->access_token;
        
        $curl               = curl_init();
        
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-uat.corelogic.asia/property/".self::$Propcountrycode."/v2/suggest.json?q=".self::$Keyword."&suggestionTypes=address&limit=10" , //. self::$Query
          //https://api-uat.corelogic.asia/sandbox/property/au/v2/suggest.json?q=auck&suggestionTypes=address&limit=10
          //localityId
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          /*CURLOPT_POSTFIELDS => array(
                                    'grant_type' => 'authorization_code', 
                                    'code' => $token
                                    ), */
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $token,
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Length: 0"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        //echo "<pre>"; print_r($response); echo "</pre>";
        //exit;
        
        curl_close($curl);
        
        if ($err) {
          $RetArr = array(); 
        } else {
          $RetDecode = json_decode($response); 

          $SuggestArr = array();
          
        
          foreach($RetDecode->suggestions as $RetArr1){
              
              
              $RetArr[] = array("countryId"    => $RetArr1->countryId, 
                                 "localityId"   => $RetArr1->localityId, 
                                 "stateId"   => $RetArr1->stateId, 
                                 "streetId"   => $RetArr1->streetId, 
                                 "suggestion"   => $RetArr1->suggestion, 
                                 "suggestionType"   => $RetArr1->suggestionType , 
                                 "postcodeId"   => $RetArr1->postcodeId, 
                                 "propertyId"   => $RetArr1->propertyId 
                                );              
          }
          
        }
        
        header('Content-Type: application/json');
        echo json_encode($RetArr); 
    }
    
    
     public static function addressUK(){
        self::Init();
        
       $MainKeyword = self::$Keyword;
        
        $encodedAuth        = "TnpBd09qSTVZbVV6WW1aaFltSTNZMkkzTVRKaVl6a3dOMlU1TWpCak9EQmhaV1poOg==";
        $curl                = curl_init();
        $Url                = "https://api.realyse.com/v1/geometry/addresses";
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $Url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\"areaName\":\"{$MainKeyword}\",\"mode\":\"Postcode\" }" ); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Basic ". $encodedAuth , 'Content-Type: text/plain'));

        //curl_setopt($ch, CURLOPT_HTTPHEADER,     array("Authorization: Basic ". $encodedAuth, 'Content-Type: text/plain')); 
        
        $response   =curl_exec ($ch);
        $err        = curl_error($curl);
        
        curl_close($curl);
        
  
        if ($err) {
          $RetArr = array(); 
            
        } else {
     
          $RetDecode = json_decode($response); 
          
          $SuggestArr = array();
          
          foreach($RetDecode->data as $RetArr1){
              $RetArr[] = array("countryId"         => "",               
                                 "localityId"       => $RetArr1->name, 
                                 "stateId"          => "",//$RetArr1->stateId, 
                                 "streetId"         => $RetArr1->name,//$RetArr1->streetId, 
                                 "suggestion"       => $RetArr1->areaName, 
                                 "suggestionType"   => $RetArr1->lod->id, //$RetArr1->suggestionType 
                                 "postcodeId"       => "", 
                                 "propertyId"       => ""
                                );
              
          }
          
        }
        
        header('Content-Type: application/json');
        echo json_encode($RetArr); 
    }
    
    
    
    public static function zipcode(){
        self::Init();
        
        $JsonRet            = file_get_contents("https://api-uat.corelogic.asia/access/oauth/token?client_id=jqhrXN8FIcA8LgMHvijARfAqzy0PD2Cp&client_secret=qWSAAO7n0XPjhMvT&grant_type=client_credentials");
        
        $JsonDecode         = json_decode($JsonRet); 
        
        $token              = $JsonDecode->access_token;
        
        $curl               = curl_init();
        
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-uat.corelogic.asia/property/nz/v2/suggest.json?q=au&suggestionTypes=postcode&limit=10" , //. self::$Query
          //https://api-uat.corelogic.asia/sandbox/property/au/v2/suggest.json?q=auck&suggestionTypes=postcode&limit=10

          //https://api-uat.corelogic.asia/sandbox/property/au/v2/suggest.json?q=auck&suggestionTypes=address&limit=10
          //localityId
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          /*CURLOPT_POSTFIELDS => array(
                                    'grant_type' => 'authorization_code', 
                                    'code' => $token
                                    ), */
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $token,
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Length: 0"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          $RetArr = array(); 
        } else {
          $RetDecode = json_decode($response); 

          $SuggestArr = array();
          
          foreach($RetDecode->suggestions as $RetArr1){
              //echo "<pre>"; print_r($RetArr1); echo "</pre>"; 
              
              $RetArr[] = array("countryId"    => $RetArr1->countryId, 
                                 "localityId"   => $RetArr1->localityId, 
                                 "stateId"   => $RetArr1->stateId, 
                                 "streetId"   => $RetArr1->streetId, 
                                 "suggestion"   => $RetArr1->suggestion, 
                                 "suggestionType"   => $RetArr1->suggestionType , 
                                 "postcodeId"   => $RetArr1->postcodeId, 
                                 "propertyId"   => $RetArr1->propertyId 
                                );              
          }
          
        }
        
        header('Content-Type: application/json');
        echo json_encode($RetArr); 
    }
    
    
    
	public static function menus(){
		self::Init();
        $SQL                = "SELECT project_id, project_name,country as from_type FROM project 
                               WHERE project_name like '%" . self::$Query . "%' LIMIT 20 
                               union 
                               SELECT path,menu_name,'MASTER' as from_type from menu
                               WHERE menu_name like '%" . self::$Query . "%' LIMIT 20
                               union 
                               SELECT country_code,country_name,'COUNTRY' as from_type from country_master
                               WHERE country_name like '%" . self::$Query . "%' LIMIT 20"; //Ghouse-29-01-2020

		
        self::$Result       = \DBConn\DBConnection::getQuery( $SQL );
        
        self::$JsonResult   =   array(); 
        
        foreach(self::$Result as $row){
			//Property/PropertDtl.html?id=1
			if ($row["from_type"]=='MASTER')//Ghouse-29-01-2020
			{
			    self::$JsonResult[] = array("PAGE_LINK"   => SITE_BASE_URL . $row["project_id"] , "DESCRIPTION"   => $row["project_name"]);
			}
            else if ($row["from_type"]=='COUNTRY')//Ghouse-29-01-2020
			{
			    self::$JsonResult[] = array("PAGE_LINK"   => SITE_BASE_URL . "Property/PropertyInvestar.html?country={$row["project_id"]}", "DESCRIPTION"   => $row["project_name"]);
			}
            else
            {
                self::$JsonResult[] = array("PAGE_LINK"   => SITE_BASE_URL . "Property/Properties.html?project_id={$row["project_id"]}&country={$row["from_type"]}", "DESCRIPTION"   => $row["project_name"]); 
                //self::$JsonResult[] = array("PAGE_LINK"   => SITE_BASE_URL . "Property/PropertDtl.html?id={$row["project_id"]}", "DESCRIPTION"   => $row["project_name"]); 
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode(self::$JsonResult); 
	}
	
	

	public static function Project(){//Ghouse-04-02-2020
		self::Init();
        $SQL                = "SELECT project_id,project_name from project
                               WHERE project_name like '%" . self::$Query . "%' LIMIT 20"; 

		
        self::$Result       = \DBConn\DBConnection::getQuery( $SQL );
        
        self::$JsonResult   =   array(); 
        
        foreach(self::$Result as $row){
            self::$JsonResult[] = array("PAGE_LINK"   => $row["project_id"], "DESCRIPTION"  => $row["project_name"] );
        }
        
        header('Content-Type: application/json');
        echo json_encode(self::$JsonResult); 
	}
    
    public static function GetLedgerOpenBalance(){
        self::Init();
        $SQL                = "SELECT CASE WHEN OPEN_DEBIT > OPEN_CREDIT THEN (OPEN_DEBIT - OPEN_CREDIT) * -1 ELSE OPEN_CREDIT - OPEN_DEBIT END AS OPEN_AMT FROM TBL_LEDGER 
                               WHERE LED_ID = '" . self::$CustomerId . "' ";

		
        self::$Result       = \DBConn\DBConnection::getQuery( $SQL );
        
        self::$JsonResult   =   array(); 
        
        foreach(self::$Result as $row){
			$OpenAmt		=	number_format( floatval($row["OPEN_AMT"]), 2);
            self::$JsonResult[] = array("open_balance"   => $OpenAmt); 
        }
        
        header('Content-Type: application/json');
        echo json_encode(self::$JsonResult); 
    }
    
    
    public static function GetUnpaidBill(){
        self::Init();
       
        self::$Result       = \receipt\receiptClass::GetUnpaidBillQry(self::$CustomerId);
        
        
        
        self::$JsonResult   =   array(); 
        
        foreach(self::$Result as $row){
            self::$JsonResult[] = array("bill_no"   => $row["BILLNO"], 
                                        "total_amt" => $row["TOTALAMT"],
                                        "paid_amt"  => $row["PAIDAMT"],
                                        "bal_amt"   => $row["BALAMT"],
                                        "id"        => $row["TRANS_ID"],
                                        "date1"      => $row["ACTIONDATE"]
                                       ); 
        }
        
        header('Content-Type: application/json');
        echo json_encode(self::$JsonResult);
    }
    
    public static function  GetProductInfo(){
        self::Init(); 
        $SQL                = "SELECT PROD.PROD_ID, PROD.ProdName, PROD.QtyUnit, PROD.PumpType, PROD.SalesType,
                                      PROD.OpenStock, PROD.ProdType, PROD.GST_HSN_CODE, PROD.UNITS_PER_QTY,
                                      GST.VALID_FROM, 
                                      IFNULL(GST.GST_PERCENT, 0) AS GST_PERCENT, 
                                      IFNULL(GST.IGST_PERCENT, 0) AS IGST_PERCENT, 
                                      IFNULL(GST.CGST_PERCENT, 0) AS CGST_PERCENT, 
                                      IFNULL(GST.SGST_PERCENT, 0) AS SGST_PERCENT, 
                                      IFNULL(FnGetPurPrice(PROD.PROD_ID, '" . self::$ConvertFromDate . "'), PROD.SalesPrice)
										  PurchasePrice,
									  IFNULL(FnGetSalesPrice(PROD.PROD_ID, '" . self::$ConvertFromDate . "'), PROD.SalesPrice)
										  SalesPrice
                                FROM PRODUCTS PROD
                                     LEFT JOIN PRODUCTS_GST_DETAILS GST
                                        ON     PROD.PROD_ID = GST.PRODUCT_ID
                                           AND GST.VALID_FROM =
                                               (SELECT MAX(GST1.VALID_FROM)
                                                FROM PRODUCTS_GST_DETAILS GST1
                                                WHERE     GST1.PRODUCT_ID = GST.PRODUCT_ID
                                                      AND GST1.VALID_FROM <= '" . self::$ConvertFromDate . "')
                                WHERE 1 = 1 AND PROD.PROD_ID = '" . self::$ProdId . "'";
                
        self::$Result       = \DBConn\DBConnection::getQuery( $SQL );
        
        self::$JsonResult   =   array(); 
        
        foreach(self::$Result as $row){
            self::$JsonResult[] = array("id"                => $row["PROD_ID"], 
                                        "prod_name"         => $row["ProdName"], 
                                        "qty_unit"          => $row["QtyUnit"], 
                                        "pump_type"         => $row["PumpType"], 
                                        "open_stock"        => $row["OpenStock"], 
                                        "prod_type"         => $row["ProdType"], 
                                        "hsn_code"          => $row["GST_HSN_CODE"], 
                                        "units_per_qty"     => $row["UNITS_PER_QTY"], 
                                        "valid_from"        => $row["VALID_FROM"], 
                                        "gst_per"           => $row["GST_PERCENT"], 
                                        "igst_per"          => $row["IGST_PERCENT"], 
                                        "cgst_per"          => $row["CGST_PERCENT"], 
                                        "sgst_per"          => $row["SGST_PERCENT"], 
                                        "pur_price"         => $row["PurchasePrice"], 
                                        "sales_price"       => $row["SalesPrice"]
                                       ); 
        }
        
        header('Content-Type: application/json');
        echo json_encode(self::$JsonResult); 
        
    }
    
    
     public static function suburbUK(){
        self::Init();
        
        //$JsonRet            = file_get_contents("https://api-uat.corelogic.asia/access/oauth/token?client_id=jqhrXN8FIcA8LgMHvijARfAqzy0PD2Cp&client_secret=qWSAAO7n0XPjhMvT&grant_type=client_credentials");
        
        //$JsonDecode         = json_decode($JsonRet); 
        
        //$token              = $JsonDecode->access_token;
        
        //echo self::$Keyword;
        $MainKeyword = self::$Keyword;
        
        $encodedAuth        = "TnpBd09qSTVZbVV6WW1aaFltSTNZMkkzTVRKaVl6a3dOMlU1TWpCak9EQmhaV1poOg==";
        $curl                = curl_init();
        $Url                = "https://api.realyse.com/v1/geometry/addresses";
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $Url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\"areaName\":\"{$MainKeyword}\",\"mode\":\"Council\" }" ); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Basic ". $encodedAuth , 'Content-Type: text/plain'));

        //curl_setopt($ch, CURLOPT_HTTPHEADER,     array("Authorization: Basic ". $encodedAuth, 'Content-Type: text/plain')); 
        
        $response   =curl_exec ($ch);
        $err        = curl_error($curl);
        
        curl_close($curl);
        
  
        if ($err) {
          $RetArr = array(); 
            
        } else {
     
          $RetDecode = json_decode($response); 
          
          //echo '<pre>'; print_r($RetDecode); echo '</pre>';
          //exit;
          
          $SuggestArr = array();
          
          foreach($RetDecode->data as $RetArr1){
              
              //echo '<pre>'; print_r($RetArr1->geometry->geometry->coordinates[0][0][0][0]); echo '</pre>';
             // echo '<pre>'; print_r($RetArr1->geometry->geometry->coordinates[0][0][0][1]); echo '</pre>';
              
              $CountryLng = isset($RetArr1->geometry->geometry->coordinates[0][0][0][0]) ? $RetArr1->geometry->geometry->coordinates[0][0][0][0] : 0; // Arzath - 2020-09-01
              $CountryLat = isset($RetArr1->geometry->geometry->coordinates[0][0][0][1]) ? $RetArr1->geometry->geometry->coordinates[0][0][0][1] : 0; // Arzath - 2020-09-01
              
              $CenterPoint1 = isset($RetArr1->center->coordinates[0]) ? $RetArr1->center->coordinates[0] : 0;
              $CenterPoint2 = isset($RetArr1->center->coordinates[1]) ? $RetArr1->center->coordinates[0] : 0;
              
              $RetArr[] = array("countryId"    => "",//$RetArr1->countryId, 
                                 "localityId"   => $RetArr1->name, 
                                 "stateId"   => "",//$RetArr1->stateId, 
                                 "streetId"   => "",//$RetArr1->streetId, 
                                 "suggestion"   => $RetArr1->areaName, 
                                 "suggestionType"   => "" ,//$RetArr1->suggestionType ,
                                 "countrylng"   => $CountryLng, // Arzath - 2020-09-01
                                 "countrylat"   => $CountryLat, // Arzath - 2020-09-01
                                 "CenterPoint1"   => $CenterPoint1, 
                                 "CenterPoint2"   => $CenterPoint2
                                );
              
          }
          
        }
        
        header('Content-Type: application/json');
        echo json_encode($RetArr); 
        
        
        
    }
    
    
    public static function  GetAnalyzerValidation($ProprtyId,$countryid=""){
		
		/*
		LegalFees				= FnNulltoAmt( $("#LegalFees").val() ); 
		StagePay1Per			= FnNulltoAmt( $("#StagePay1Per").val() ); 
		StagePay2Per			= FnNulltoAmt( $("#StagePay2Per").val() ); 
		LoanAmountPer			= FnNulltoAmt( $("#LoanAmountPer").val() ); 
		LeaseRegistration		= FnNulltoAmt( $("#LeaseRegistration").val() ); 
		ResetrvationFees		= FnNulltoAmt( $("#ResetrvationFees").val() );
		MortgageRegistration    = FnNulltoAmt( $("#MortgageRegistration").val() ); 
		LandTransfer            = FnNulltoAmt( $("#LandTransfer").val() ); 
		*/
		
	//	$countryid = "2";
	//	$ProprtyId = "41";
		//============================= Property Details Start ============================
		\Property\PropertyClass::init();
		$Propertyrows = \Property\PropertyClass::GetPropertiesDatas($ProprtyId,'','');
		
		       
  
                   
		foreach ($Propertyrows as $Propertyrow) 

		{
		   $ProjectName					= $Propertyrow["project_name"]      ? $Propertyrow["project_name"]     : "";
		   $ProprtyId					= $Propertyrow["property_id"]      ? $Propertyrow["property_id"]     : "";
		   $building					= $Propertyrow["building"]          ? $Propertyrow["building"]         : "";
		   $apartment_no				= $Propertyrow["apartment_no"]      ? $Propertyrow["apartment_no"]     : "";
		   $UnitSize					= $Propertyrow["land_area"]         ? $Propertyrow["land_area"]        : "0";
		   $UnitType					= $Propertyrow["no_of_bedrooms"]    ? $Propertyrow["no_of_bedrooms"]   : "0";
		   $Purchaseprice			    = $Propertyrow["dpo_rate"]          ? $Propertyrow["dpo_rate"]         : "0";
		   $DuvalDynamicPrice			= $Propertyrow["dpo_rate"]          ? $Propertyrow["dpo_rate"]         : "0";
		   $MarketPrice			        = $Propertyrow["start_rate"]          ? $Propertyrow["start_rate"]     : "0";   
		   $countryid			        = $Propertyrow["country"]           ? $Propertyrow["country"]          : "";
		   $weeklyRent			        = $Propertyrow["weekly_rent"]      ? $Propertyrow["weekly_rent"]       : "";
		   $location_id			        = $Propertyrow["location_id"]      ? $Propertyrow["location_id"]       : "";
		   $subrub			            = $Propertyrow["subrub"]      ? $Propertyrow["subrub"]       : "";
		   $project_description			= $Propertyrow["project_description"]      ? $Propertyrow["project_description"]       : "";
		   
		   
		   
		   $WeeklyRental                = $weeklyRent;
		}
		
		//============================= Property Details End ============================
		
		//echo "DuvalDynamicPrice===".$DuvalDynamicPrice;

		
		//==========================  Default Property Start =========================================
		$rows = \Property\PropertyClass::Getproperty_analyzer_defaults($countryid);
		
		 /*SELECT country_id, income, marketprice, duvaldynamicprice, stampduty, leaseregistration, transferfees, mortgageregistration, landtransfer, legalfees, totalpurchasecost,
		                    resetrvationfees, stagepay1per, stagepay1amt, stagepay2per, stagepay2amt, loanamountper, topup, weeklyrental, vacancyrate, lettingfeerate, managementfees, councilpropertytax,
		                    codycorporateservicechg, landleaserentpa, insurancepa, repairandmaintenance, cleaningpermonth, gardeningpermonth, servicecontractspa, other, ltv, initialloanamt, interestrate, 
		                    termyears, cpi, rentalgrowth, capitalgrowth, buildingvalue, buildinglife, fixturesvalue, fixtureslife, furniturevalue, furniturelife, OwnerOccupier, SecondHomeInvestment, 
		                    NonResidentInvestorAmt */
		                 
		               
		                    
    		$isDefaultAnalyzer = false;

		foreach ($rows as $row) 

		{
            $isDefaultAnalyzer = true;

        	$OwnerOccupier					= $row["OwnerOccupier"]                 ? $row["OwnerOccupier"]         : "0";
        	$SecondHomeInvestment			= $row["SecondHomeInvestment"]          ? $row["SecondHomeInvestment"]  : "0";
        	$AUDynamicPrice					= $DuvalDynamicPrice;
        	$Resident        		        = $row["resident"]                      ? $row["resident"]              : "0";
        	$ResidentInvestor        	    = $row["residentinvestor"]              ? $row["residentinvestor"]      : "0";
        	$Purchaseprice        	        = $row["duvaldynamicprice"]             ? $row["duvaldynamicprice"]                : "0";
        	$Income        	                = $row["income"]                        ? $row["income"]                : "0";
        	$MarketPrice  			        = $MarketPrice; 
        	$DuvalDynamicPrice   	        = $DuvalDynamicPrice;
        	$StampDuty				        = $row["stampduty"]                     ? $row["stampduty"]             : "0";
            $LeaseRegistration		        = $row["leaseregistration"]             ? $row["leaseregistration"]   : "0";
            $TransferFees                   = $row["transferfees"]                  ? $row["transferfees"]   : "0";
            $MortgageRegistration           = $row["mortgageregistration"]          ? $row["mortgageregistration"]   : "0";
            $LandTransfer                   = $row["landtransfer"]                  ? $row["landtransfer"]   : "0";
            $LegalFees                      = $row["legalfees"]                     ? $row["legalfees"]                 : "0";
            $TotalPurchaseCost              = $row["totalpurchasecost"]             ? $row["totalpurchasecost"]   : "0";
            $ResetrvationFees               = $row["resetrvationfees"]              ? $row["resetrvationfees"]   : "0";
            $StagePay1Per                   = $row["stagepay1per"]                  ? $row["stagepay1per"]   : "0";
            $StagePay1Amt                   = $row["stagepay1amt"]                  ? $row["stagepay1amt"]   : "0";
            $StagePay2Per                   = $row["stagepay2per"]                  ? $row["stagepay2per"]   : "0";
            $StagePay2Amt                   = $row["StagePay2Amt"]                  ? $row["StagePay2Amt"]   : "0";
            $LoanAmountPer                  = $row["loanamountper"]                  ? $row["loanamountper"]   : "0";
            $Topup                          = $row["topup"]                         ? $row["topup"]   : "0";
            $WeeklyRental	                = $row["weeklyrental"]                  ? $row["weeklyrental"]   : "0";
            $VacancyRate                    = $row["vacancyrate"]                   ? $row["vacancyrate"]   : "0";
            $LettingFeeRate                 = $row["lettingfeerate"]                ? $row["lettingfeerate"]   : "0";
            $ManagementFees                 = $row["managementfees"]                ? $row["managementfees"]   : "0";
            $CouncilPropertyTax             = $row["councilpropertytax"]            ? $row["councilpropertytax"]   : "0";
            $CodyCorporateServiceChg        = $row["codycorporateservicechg"]       ? $row["codycorporateservicechg"]   : "0";
            $LandLeaseRentPa                = $row["landleaserentpa"]               ? $row["landleaserentpa"]   : "0";
            $InsurancePa                    = $row["insurancepa"]                   ? $row["insurancepa"]   : "0";
            $RepairandMaintenance           = $row["repairandmaintenance"]          ? $row["repairandmaintenance"]   : "0";
            $CleaningPerMonth               = $row["cleaningpermonth"]              ? $row["cleaningpermonth"]   : "0";
            $GardeningPerMonth              = $row["gardeningpermonth"]             ? $row["gardeningpermonth"]   : "0";
            $ServiceContractsPa             = $row["servicecontractspa"]            ? $row["servicecontractspa"]   : "0";
            $Other                          = $row["other"]                         ? $row["other"]   : "0";
            $LTV                            = $row["ltv"]                           ? $row["ltv"]   : "0";
            $InitialLoanAmt                 = $row["initialloanamt"]                ? $row["initialloanamt"]   : "0";
            $InterestRate                   = $row["interestrate"]                  ? $row["interestrate"]   : "0";
            $TermYears                      = $row["termyears"]                     ? $row["termyears"]   : "0";
            $CPI                            = $row["cpi"]                           ? $row["cpi"]   : "0";
            $RentalGrowth                   = $row["rentalgrowth"]                  ? $row["rentalgrowth"]   : "0";
            $CapitalGrowth                  = $row["capitalgrowth"]                 ? $row["capitalgrowth"]   : "0";
            $BuildingValue                  = $row["buildingvalue"]                 ? $row["buildingvalue"]   : "0";
            $BuildingLife                   = $row["buildinglife"]                  ? $row["buildinglife"]   : "0";
            $FixturesValue                  = $row["fixturesvalue"]                 ? $row["fixturesvalue"]   : "0";
            $FixturesLife                   = $row["fixtureslife"]                  ? $row["fixtureslife"]   : "0";
            $FurnitureValue                 = $row["furniturevalue"]                ? $row["furniturevalue"]   : "0";
            $FurnitureLife                  = $row["furniturelife"]                 ? $row["furniturelife"]   : "0";
            $AnnualRental				    = $row["weeklyrental"]                   ? $row["weeklyrental"]   : "0"; 
            $CapitalGrowthRate			    = isset($row["CapitalGrowthRate"]) 	  ? $row["CapitalGrowthRate"] : "0"; 
            
            $firsttimebuyer 				= isset($row["firsttimebuyer"]) 			? $row["firsttimebuyer"] : "";  
            $RentalGuarantee 				= isset($row["RentalGuarantee"]) 			? $row["RentalGuarantee"] : "";  
            $FurniturePackReq 				= isset($row["FurniturePackReq"]) 			? $row["FurniturePackReq"] : "";  
            $UnitSize 						= isset($row["UnitSize"]) 					? $row["UnitSize"] : "";  
            $UnitType  						= isset($row["UnitType "]) 				? $row["UnitType "] : "";   

		}
		
        $TempArr   = array(); 
        
        
        
        if ($isDefaultAnalyzer){
            
           // echo $isDefaultAnalyzer;
           
     
            
                $StagePay1Amt = floatval($DuvalDynamicPrice) * (floatval($StagePay1Per) / 100);
                $StagePay2Amt = floatval($DuvalDynamicPrice) * (floatval($StagePay2Per) / 100);
            
            
            if ( $countryid == "3"){
                
            	$ForeignInvestor           	= 0;
    			//$DuvalDynamicPrice         	= $OwnerOccupier + $SecondHomeInvestment + $NonResidentInvestorAmt; // Hidded arzath
    		    $Resident                  	= self::GetGBResidentValueFn($OwnerOccupier);
    		    $ResidentInvestor          	= self::GetGBResidentValueFn($SecondHomeInvestment) + ($SecondHomeInvestment * 0.03) ; 
    			//Resident Investor (Row 16) =SUMPRODUCT(--(C15>{125000;250000;925000;1500000}),(C15-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})+(C15*0.03)    //C15 is Investment or Second Home
    			$NonResidentInvestor       = self::GetGBResidentValueFn($NonResidentInvestorAmt) + ($NonResidentInvestorAmt * 0.05) ; 
    			$StampDuty                 = $Resident + $ResidentInvestor + $NonResidentInvestor;
    			$LeaseRegistration         = self::GetGBLandLeaseRegisterAmt($DuvalDynamicPrice);
        			//$StampDuty                   ="93760";
        			
            }
            
            $LTV						    = $LoanAmountPer; 
            $Topup					        = ((100 - floatval($LoanAmountPer)) * floatval($DuvalDynamicPrice) / 100) - floatval($ResetrvationFees) - floatval($StagePay1Amt) - floatval($StagePay2Amt); 
    
    		$InitialLoanAmt			        = floatval($LTV) * floatval($DuvalDynamicPrice) / 100; 
		
            
            $TotalPurchaseCost		        = floatval($DuvalDynamicPrice) + floatval($StampDuty) + floatval($LegalFees) + floatval($TransferFees) + floatval($LeaseRegistration) + floatval($MortgageRegistration) + floatval($LandTransfer);
    
            
            
                $TempArr[]                = array("property_id"          => $ProprtyId,
        									"LocationId"          		=> $location_id,
        									"MyPortFolioName"          	=> $ProjectName,
        									"Subrub"          			=> $subrub,
        									"MyPortfolioPropAddress"    => $project_description,
        									"CountryId"          		=> $countryid,
        									"Income"          			=> $Income,
        									"MarketPrice"          		=> $MarketPrice,
        									"DuvalDynamicPrice"         => $DuvalDynamicPrice,
        									"StampDuty"          		=> $StampDuty,
        									"TransferFees"          	=> $TransferFees,
        									"LegalFees"          		=> $LegalFees,  /* Common Values*/
        									"TotalPurchaseCost"         => $TotalPurchaseCost,
        									"ResetrvationFees"          => $ResetrvationFees, /* Common Values*/
        									"StagePay1Per"          	=> $StagePay1Per, /* Common Values*/
        									"StagePay1Amt"          	=> $StagePay1Amt,
        									"StagePay2Per"          	=> $StagePay2Per,/* Common Values*/
        									"StagePay2Amt"          	=> $StagePay2Amt,
        									"LoanAmountPer"          	=> $LoanAmountPer,/* Common Values*/
        									"Topup"          			=> $Topup, 
        									"WeeklyRental"          	=> $WeeklyRental,
        									"VacancyRate"          		=> $VacancyRate,    /* Common Values*/
        									"LettingFeeRate"          	=> $LettingFeeRate, /* Common Values*/
        									"ManagementFees"          	=> $ManagementFees, /* Common Values*/
        									"CouncilPropertyTax"        => $CouncilPropertyTax, /* Common Values*/
        									"CodyCorporateServiceChg"   => $CodyCorporateServiceChg, /* Common Values*/
        									"LandLeaseRentPa"           => $LandLeaseRentPa, /* Common Values*/
        									"InsurancePa"          		=> $InsurancePa, /* Common Values*/
        									"RepairandMaintenance"      => $RepairandMaintenance, /* Common Values*/
        									"CleaningPerMonth"          => $CleaningPerMonth, /* Common Values*/
        									"GardeningPerMonth"         => $GardeningPerMonth, /* Common Values*/
        									"ServiceContractsPa"        => $ServiceContractsPa, /* Common Values*/
        									"Other"          			=> $Other, /* Common Values*/
        									"LTV"          				=> $LTV,
        									"InitialLoanAmt"          	=> $InitialLoanAmt,
        									"InterestRate"          	=> $InterestRate,  /* Common Values*/
        									"TermYears"          		=> $TermYears, /* Common Values*/
        									"CPI"          				=> $CPI, /* Common Values*/
        									"RentalGrowth"          	=> $RentalGrowth, /* Common Values*/
        									"CapitalGrowth"          	=> $CapitalGrowth, /* Common Values*/
        									//"CapitalGrowthRate"         => $CapitalGrowthRate,
        									"Purchaseprice"          	=> $Purchaseprice,
        									"firsttimebuyer"          	=> $firsttimebuyer, /* Common Values*/
        									"RentalGuarantee"          	=> $RentalGuarantee, /* Common Values*/
        									"FurniturePackReq"          => $FurniturePackReq, /* Common Values*/
        									"UnitSize"          		=> $UnitSize, /* Common Values*/
        									"LeaseRegistration"         => $LeaseRegistration,
        									"MortgageRegistration"      => $MortgageRegistration,
        									"LandTransfer"          	=> $LandTransfer,
        									"FixturesValue"          	=> $FixturesValue,/* Common Values*/
        									"FixturesLife"          	=> $FixturesLife, /* Common Values*/
        									"FurnitureValue"          	=> $FurnitureValue, /* Common Values*/
        									"FurnitureLife"          	=> $FurnitureLife, /* Common Values*/
        									"BuildingValue"          	=> $BuildingValue, /* Common Values*/
        									"BuildingLife"          	=> $BuildingLife, /* Common Values*/
        									"AnnualRental"          	=> $WeeklyRental,
        									"OwnerOccupier"          	=> $OwnerOccupier,
        									"SecondHomeInvestment"     => $SecondHomeInvestment,
        									"Resident"                  => $Resident,
        									"ResidentInvestor"         => $ResidentInvestor
        									
        									
        									
        									
        									
        									);
									
	    
	    
	                return $TempArr;
            
        }
        
             //	echo "DuvalDynamicPrice===".$DuvalDynamicPrice;

		//==========================  Default Property End =========================================
				
				
			//$ChkPropAnsArr               	= \DBConn\DBConnection::getQueryFetchColumn("(SELECT count(*) FROM property_analyzer_inputs where userid='{$user_id}' and propertyid='{$ProprtyId}')");
			//$PropAnsArr             		= $ChkPropAnsArr["0"]; // Arzath - 2020-06-18

		//==========================  Default Hardcored Value Start ================================
				
		   if ($Income == "")		
			    $Income						= 100000;

			

			if (floatval($MarketPrice) == 0)
				$MarketPrice			= 550000;

			if (!isset($DuvalDynamicPrice))
				$DuvalDynamicPrice		= 500000;

			if (floatval($WeeklyRental) == 0)
				$WeeklyRental			= 750;

			if (isset($StampDuty))                  $StampDuty					= 0;

			if (isset($TransferFees))               $TransferFees				= 80;

			if (isset($LegalFees))                  $LegalFees					= 1000;

			if (isset($TotalPurchaseCost))          $TotalPurchaseCost			= 501080;

			if (isset($ResetrvationFees))           $ResetrvationFees			= 2500;

			if (isset($StagePay1Per))               $StagePay1Per				= 10;

			if (isset($StagePay1Amt))               $StagePay1Amt				= 50000;

			if (isset($StagePay2Per))               $StagePay2Per				= 0;

			if (isset($StagePay2Amt))               $StagePay2Amt				= 0;

			if (isset($LoanAmountPer))              $LoanAmountPer				= 80;

			if (isset($LoanAmountPer))              $Topup						= 47500;

			if (isset($VacancyRate))                $VacancyRate				= 2;

			if (isset($LettingFeeRate))             $LettingFeeRate				= 2;

			if (isset($ManagementFees))             $ManagementFees				= 8;

			if (isset($CouncilPropertyTax))         $CouncilPropertyTax			= 1000;

			if (isset($CodyCorporateServiceChg))    $CodyCorporateServiceChg	= 1000;

			if (isset($LandLeaseRentPa))            $LandLeaseRentPa			= 300;

			if (isset($InsurancePa))                $InsurancePa				= 1000;

			if (isset($RepairandMaintenance))       $RepairandMaintenance		= 1.5;

			if (isset($CleaningPerMonth))           $CleaningPerMonth			= 250;

			if (isset($GardeningPerMonth))          $GardeningPerMonth			= 150;

			if (isset($ServiceContractsPa))         $ServiceContractsPa			= 200;

			if (isset($Other))                      $Other						= 0;

			if (isset($LTV))                        $LTV						= 80;

			if (isset($InitialLoanAmt))             $InitialLoanAmt				= 400000;

			if (isset($InterestRate))               $InterestRate				= 4.5;

			if (isset($TermYears))                  $TermYears					= 30;

			if (isset($CPI))                        $CPI						= 2;

			if (isset($RentalGrowth))               $RentalGrowth				= 2.5;

			if (isset($CapitalGrowth))              $CapitalGrowth				= 2;

			if (isset($FixturesValue))              $FixturesValue				= 20000;

			if (isset($FixturesLife))               $FixturesLife				= 20;

			if (isset($FurnitureValue))             $FurnitureValue				= 10000;

			if (isset($FurnitureLife))              $FurnitureLife				= 10;

			//Yasir / 23-May-2020 / Hardcode Analyzer Input Values ( end )

			//Yasir / 10-Jul-2020 / GB Analyzer..

			if (isset($FurnitureLife))              $SecondHomeInvestment       = "";

			if (isset($FurnitureLife))              $OwnerOccupier              = ""; 

			if (isset($FurnitureLife))              $LeaseRegistration          = "";

			//Yasir / 10-Jul-2020 / AU Analyzer

			if (isset($MortgageRegistration))       $MortgageRegistration       = "";

			if (isset($LandTransfer))               $LandTransfer               = ""; 

			if (isset($BuildingValue))              $BuildingValue              = 300000;

			if (isset($BuildingLife))               $BuildingLife               = 40;

			//$countryid = "2";  //hardcode for testing

				
		//==========================  Default Hardcored Value Start ================================	
		

		
		if ($countryid == "3"){ 
		
	
			$ForeignInvestor           	= 0;
			//$DuvalDynamicPrice         	= $OwnerOccupier + $SecondHomeInvestment + $NonResidentInvestorAmt; // Hidded arzath
		    $Resident                  	= self::GetGBResidentValueFn($OwnerOccupier);
		    $ResidentInvestor          	= self::GetGBResidentValueFn($SecondHomeInvestment) + ($SecondHomeInvestment * 0.03) ; 
			//Resident Investor (Row 16) =SUMPRODUCT(--(C15>{125000;250000;925000;1500000}),(C15-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})+(C15*0.03)    //C15 is Investment or Second Home
			$NonResidentInvestor       = self::GetGBResidentValueFn($NonResidentInvestorAmt) + ($NonResidentInvestorAmt * 0.05) ; 
			$StampDuty                 = $Resident + $ResidentInvestor + $NonResidentInvestor;
			$LeaseRegistration         = self::GetGBLandLeaseRegisterAmt($DuvalDynamicPrice);
			//$StampDuty                   ="93760";


		}
		
		
		
		
		if ($countryid == "2"){ 
		
			// $AuLocation                  =  $("#AuLocation").val() ; 

			$AUDynamicPrice              = "";

			$ForeignInvestor             = 0; //Not used in excel

			
		/*
			ObjDuvalDynamicPrice        = $("#DuvalDynamicPrice"); 

			ObjResident                 = $("#Resident");

			ObjLandTransfer             = $("#LandTransfer");

			ObjStampDuty                = $("#StampDuty");

			ObjMortgageRegistration     = $("#MortgageRegistration");
		*/
			

			$Resident                    = 0;
			$MortgageReg                 = 0;
			$LandTransfer                = 0;

            $AuLocation = "ACT";
			if ($AuLocation == "ACT"){
			  

        			  if ($AUDynamicPrice > 1455000){
        				  $Resident          = round( ceil(($AUDynamicPrice - 1455000) / 100) * 4.54); 
        			  }else if($AUDynamicPrice > 1000000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 100000) / 100) * 6.4) ) + 36950; 
        			  }else if($AUDynamicPrice > 750000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 750000) / 100) * 5.9) ) + 22200; 
        			  }else if($AUDynamicPrice > 500000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 500000) / 100) * 4.32) ) + 11400; 
        			  }else if($AUDynamicPrice > 300000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 300000) / 100) * 3.4) ) + 4600; 
        			  }else if($AUDynamicPrice > 200000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 200000) / 100) * 2.2) ) + 2400; 
        			  }else{
        				  $Resident          = round( (ceil(($AUDynamicPrice ) / 100) * 1.2) ) ; 
        			  }
        			  
        			  if ($AUDynamicPrice > 1){
        				$MortgageReg          = 153; 
        				$LandTransfer         = 409; 
        			  }

			  

			}else if($AuLocation == "NSW"){

        			  if ($AUDynamicPrice > 3040000){
        				  $Resident          = round( ceil(($AUDynamicPrice - 3040000) / 100) * 7) + 152505; 
        			  }else if($AUDynamicPrice > 1013000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 1013000) / 100) * 5.5) ) + 41017; 
        			  } else if($AUDynamicPrice > 304000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 304000) / 100) * 4.5) ) + 9112; 
        			  }else if($AUDynamicPrice > 81000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 81000) / 100) * 3.5) ) + 1307; 
        			  }else if($AUDynamicPrice > 30000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 30000) / 100) * 1.75) ) + 415; 
        			  } else if($AUDynamicPrice > 14000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 14000) / 100) * 1.5) ) + 175; 
        			  }else{
        				  $Resident          = round( (ceil(($AUDynamicPrice ) / 100) * 1.25) ) ; 
        			  }
        
        			  if ($AUDynamicPrice > 1){
        				$MortgageReg          = 143.50; 
        				$LandTransfer         = 143.50; 
        			  }


			}else if($AuLocation == "NT"){

        			  if ($AUDynamicPrice >= 5000000){
        				  $Resident          = round( 0.0495  * ceil($AUDynamicPrice)); 
        			  }else if($AUDynamicPrice >= 3000000){
        				  $Resident          = round( 0.0575  * ceil($AUDynamicPrice));
        			  }else if($AUDynamicPrice >= 525000){
        				  $Resident          = round( 0.0495  * ceil($AUDynamicPrice));
        			  }else if($AUDynamicPrice <= 525000 ){
        				  $Resident          = round((0.06571441 * (ceil($AUDynamicPrice)/1000) * (ceil($AUDynamicPrice)/1000) ) + (15 * (ceil($AUDynamicPrice)/1000))); 
        			  }
        
        			   if ($AUDynamicPrice > 1){
        				$MortgageReg          = 149; 
        				$LandTransfer         = 149; 
        			  }

			}else if($AuLocation == "QLD"){

        			   if ($AUDynamicPrice > 1000000){
        				  $Resident          = round( ceil(($AUDynamicPrice - 1000000) / 100) * 5.75) + 38025; 
        			  }else if($AUDynamicPrice > 540000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 540000) / 100) * 4.5) ) + 17325; 
        			  }else if($AUDynamicPrice > 75000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 75000) / 100) * 3.5) ) + 1050; 
        			  }else if($AUDynamicPrice > 5000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 5000) / 100) * 1.5) ); 
        			  }else if($AUDynamicPrice < 5000){
        				  $Resident          = 0 ; 
        			  }

        			  if ($AUDynamicPrice > 1){
        				$MortgageReg          = 192; 
        				$LandTransfer         = round( (ceil(($AUDynamicPrice - 180000) / 10000) * 36) ) + 192; 
        			  }


			  }else if($AuLocation == "SA"){


        			  if ($AUDynamicPrice > 500000){
        				  $Resident          = round( ceil(($AUDynamicPrice - 500000) / 100) * 5.5) + 21330;
        			  }else if($AUDynamicPrice > 300000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 300000) / 100) * 5) ) + 11330; 
        			  } else if($AUDynamicPrice > 250000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 250000) / 100) * 4.75) ) + 8955;
        			  }else if($AUDynamicPrice > 200000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 200000) / 100) * 4.25) ) + 6830; 
        			  }else if($AUDynamicPrice > 100000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 100000) / 100) * 4) ) + 2830; 
        			  }else if($AUDynamicPrice > 50000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 50000) / 100) * 3.5) ) + 1080; 
        			  }else if($AUDynamicPrice > 30000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 30000) / 100) * 3) ) + 480; 
        			  }else if($AUDynamicPrice > 12000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 12000) / 100) * 2) ) + 120; 
        			  }else if($AUDynamicPrice < 12000){
        				  $Resident          = round( (ceil(($AUDynamicPrice) / 100) * 1) ) ; 
        			  }

			  

        			  if ($AUDynamicPrice > 1){
        
        				$MortgageReg          = 170; 
        
        				if ($AUDynamicPrice > 50000){
        					$LandTransfer          = round( ceil(($AUDynamicPrice - 50000) / 10000) * 86.5) + 293; 
        				}else if($AUDynamicPrice > 40000){
        					 $LandTransfer          = 293; 
        				}else if($AUDynamicPrice > 20000){
        					 $LandTransfer          = 208; 
        				}else if($AUDynamicPrice > 5000){
        					 $LandTransfer          = 190; 
        				}else if($AUDynamicPrice > 1){
        					 $LandTransfer          = 170; 
        				}else{
        					$LandTransfer          = 0; 
        
        				}
        				
        			  }



			  }else if($AuLocation == "TAS"){

        			  if ($AUDynamicPrice > 725000){
        				  $Resident          = round( ceil(($AUDynamicPrice - 725000) / 100) * 4.5) + 27810; 
        			  }else if($AUDynamicPrice > 375000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 375000) / 100) * 4.25) ) + 12935; 
        			  }else if($AUDynamicPrice > 200000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 200000) / 100) * 4) ) + 5935; 
        			  } else if($AUDynamicPrice > 75000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 75000) / 100) * 3.5) ) + 1560; 
        
        			  }else if($AUDynamicPrice > 25000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 25000) / 100) * 2.25) ) + 435; 
        
        			  }else if($AUDynamicPrice > 3000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 3000) / 100) * 1.75) ) + 50; 
        
        			  }else if($AUDynamicPrice > 1){
        				  $Resident          = 50; 
        			  }else 
        				  $Resident          = 0 ; 
        			  }
			  
        
        			  if ($AUDynamicPrice > 1){
        				$MortgageReg          = 138.51; 
        
        				$LandTransfer         = 212.22;
        			  }


		 

			    }else if($AuLocation == "VIC"){


        			  if ($AUDynamicPrice > 960001){
        				  $Resident          = round( ceil($AUDynamicPrice) * 0.055); 
        			  } else if($AUDynamicPrice > 130001){
        				  $Resident          = round( (0.014*25000) + (0.024*(130000-25000)) + (0.06*(ceil($AUDynamicPrice)-130000) ) ); 
        			  }else if($AUDynamicPrice > 25001){
        				  $Resident          = round( (0.014*25000) + (0.024*(ceil($AUDynamicPrice)-25000)) ); 
        			  } else {
        				  $Resident          = round(ceil($AUDynamicPrice)*0.014) ; 
        			  }


        			  if ($AUDynamicPrice > 1){
        				$MortgageReg          = 119.7; 
        				$LandTransfer         = round( (ceil($AUDynamicPrice) / 1000 ) * 2.34) + 98.5;
        				//=IF(I2>0, (((I2/1000)*2.34)+98.5))
        
        			  }


			    }else if($AuLocation == "WA"){


        			   if ($AUDynamicPrice > 725000){
        				  $Resident          = round( ceil(($AUDynamicPrice - 725000) / 100) * 5.15) + 28453;
        			  }else if($AUDynamicPrice > 360000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 360000) / 100) * 4.75) ) + 11115; 
        			  }else if($AUDynamicPrice > 150000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 150000) / 100) * 3.8) ) + 3135; 
        			  }else if($AUDynamicPrice > 120000){
        				  $Resident          = round( (ceil(($AUDynamicPrice - 120000) / 100) * 2.85) ) + 2280; 
        			  }else if($AUDynamicPrice > 1){
        				  $Resident          = round( (ceil(($AUDynamicPrice) / 100) * 1.9) ); 
        			  }else {
        				  $Resident          = 0 ; 
        			  }

			  

    			    if ($AUDynamicPrice > 1){
    				    $MortgageReg          = 174.7; 
    
        				 if ($AUDynamicPrice > 2000000){
        					$LandTransfer          = round(ceil(564.7) + (ceil($AUDynamicPrice) /100000) * 20 ); 
        
        				}else if($AUDynamicPrice > 1900001){
        
        					 $LandTransfer          = 564.7; 
        
        				}else if($AUDynamicPrice > 1800001){
        
        					 $LandTransfer          = 544.7; 
        
        				}else if($AUDynamicPrice > 1700001){
        
        					 $LandTransfer          = 524.7; 
        
        				}else if($AUDynamicPrice > 1600001){
        
        					 $LandTransfer          = 504.7; 
        
        				}else if($AUDynamicPrice > 1500001){
        
        					 $LandTransfer          = 484.7; 
        
        				}else if($AUDynamicPrice > 1400001){
        
        					 $LandTransfer          = 464.7; 
        
        				}else if($AUDynamicPrice > 1300001){
        
        					 $LandTransfer          = 444.7; 
        
        				}else if($AUDynamicPrice > 1200001){
        
        					 $LandTransfer          = 424.7; 
        
        				}else if($AUDynamicPrice > 1100001){
        
        					 $LandTransfer          = 404.7; 
        
        				}else if($AUDynamicPrice > 1000001){
        
        					 $LandTransfer          = 384.7; 
        
        				}else if($AUDynamicPrice > 900001){
        
        					 $LandTransfer          = 364.7; 
        
        				}else if($AUDynamicPrice > 800001){
        
        					 $LandTransfer          = 344.7; 
        
        				}else if($AUDynamicPrice > 700001){
        
        					 $LandTransfer          = 324.7; 
        
        				}else if($AUDynamicPrice > 600001){
        
        					 $LandTransfer          = 304.7; 
        
        				}else if($AUDynamicPrice > 500001){
        
        					 $LandTransfer          = 284.7; 
        
        				}else if($AUDynamicPrice > 400001){
        
        					 $LandTransfer          = 264.7; 
        
        				}else if($AUDynamicPrice > 300001){
        
        					 $LandTransfer          = 244.7; 
        
        				}else if($AUDynamicPrice > 200001){
        
        					 $LandTransfer          = 224.7; 
        
        				}else if($AUDynamicPrice > 120001){
        
        					 $LandTransfer          = 124.7; 
        
        				}else if($AUDynamicPrice > 85001){
        
        					 $LandTransfer          = 184.7; 
        
        				} else if($AUDynamicPrice > 1){
        					 $LandTransfer          = 174.7; 
        				}
        				else{
        					$LandTransfer          = 0; 
        				}
    		
    		        }
    		        
    		        
    		        $DuvalDynamicPrice = $AUDynamicPrice;
    		        $Resident = $Resident;
    		        $StampDuty = $Resident;
    		        $MortgageRegistration = $MortgageReg;
    		        

		
			    }

		
		
		
		
		
    		$LTV						= $LoanAmountPer; 
 
    		
    		if ($countryid == "3"){ 
    
    			if (floatval($DuvalDynamicPrice) > 1){
    
    				$TransferFees		= 80;
    
    			} 
    		}
    		
    		
    		$TotalPurchaseCost		= floatval($DuvalDynamicPrice) + floatval($StampDuty) + floatval($LegalFees) + floatval($TransferFees) + floatval($LeaseRegistration) + floatval($MortgageRegistration) + floatval($LandTransfer);
    
    		$StagePay1Amt			= floatval($DuvalDynamicPrice) * floatval($StagePay1Per) / 100; 
    
    		$StagePay2Amt			= floatval($DuvalDynamicPrice) * floatval($StagePay2Per) / 100; 
    
    
    
    		$Topup					= ((100 - floatval($LoanAmountPer)) * floatval($DuvalDynamicPrice) / 100) - floatval($ResetrvationFees) - floatval($StagePay1Amt) - floatval($StagePay2Amt); 
    
    		$InitialLoanAmt			= floatval($LTV) * floatval($DuvalDynamicPrice) / 100; 
		
		
		
		
             $TempArr[]                = array("property_id"          	=> $ProprtyId,
        									"LocationId"          		=> $location_id,
        									"MyPortFolioName"          	=> $ProjectName,
        									"Subrub"          			=> $subrub,
        									"MyPortfolioPropAddress"    => $project_description,
        									"CountryId"          		=> $countryid,
        									"Income"          			=> $Income,
        									"MarketPrice"          		=> $MarketPrice,
        									"DuvalDynamicPrice"         => $DuvalDynamicPrice,
        									"StampDuty"          		=> $StampDuty,
        									"TransferFees"          	=> $TransferFees,
        									"LegalFees"          		=> $LegalFees,  /* Common Values*/
        									"TotalPurchaseCost"         => $TotalPurchaseCost,
        									"ResetrvationFees"          => $ResetrvationFees, /* Common Values*/
        									"StagePay1Per"          	=> $StagePay1Per, /* Common Values*/
        									"StagePay1Amt"          	=> $StagePay1Amt,
        									"StagePay2Per"          	=> $StagePay2Per,/* Common Values*/
        									"StagePay2Amt"          	=> $StagePay2Amt,
        									"LoanAmountPer"          	=> $LoanAmountPer,/* Common Values*/
        									"Topup"          			=> $Topup, 
        									"WeeklyRental"          	=> $WeeklyRental,
        									"VacancyRate"          		=> $VacancyRate,    /* Common Values*/
        									"LettingFeeRate"          	=> $LettingFeeRate, /* Common Values*/
        									"ManagementFees"          	=> $ManagementFees, /* Common Values*/
        									"CouncilPropertyTax"        => $CouncilPropertyTax, /* Common Values*/
        									"CodyCorporateServiceChg"   => $CodyCorporateServiceChg, /* Common Values*/
        									"LandLeaseRentPa"           => $LandLeaseRentPa, /* Common Values*/
        									"InsurancePa"          		=> $InsurancePa, /* Common Values*/
        									"RepairandMaintenance"      => $RepairandMaintenance, /* Common Values*/
        									"CleaningPerMonth"          => $CleaningPerMonth, /* Common Values*/
        									"GardeningPerMonth"         => $GardeningPerMonth, /* Common Values*/
        									"ServiceContractsPa"        => $ServiceContractsPa, /* Common Values*/
        									"Other"          			=> $Other, /* Common Values*/
        									"LTV"          				=> $LTV,
        									"InitialLoanAmt"          	=> $InitialLoanAmt,
        									"InterestRate"          	=> $InterestRate,  /* Common Values*/
        									"TermYears"          		=> $TermYears, /* Common Values*/
        									"CPI"          				=> $CPI, /* Common Values*/
        									"RentalGrowth"          	=> $RentalGrowth, /* Common Values*/
        									"CapitalGrowth"          	=> $CapitalGrowth, /* Common Values*/
        									//"CapitalGrowthRate"         => $CapitalGrowthRate,
        									"Purchaseprice"          	=> $Purchaseprice,
        									"firsttimebuyer"          	=> $firsttimebuyer, /* Common Values*/
        									"RentalGuarantee"          	=> $RentalGuarantee, /* Common Values*/
        									"FurniturePackReq"          => $FurniturePackReq, /* Common Values*/
        									"UnitSize"          		=> $UnitSize, /* Common Values*/
        									"LeaseRegistration"         => $LeaseRegistration,
        									"MortgageRegistration"      => $MortgageRegistration,
        									"LandTransfer"          	=> $LandTransfer,
        									"FixturesValue"          	=> $FixturesValue,/* Common Values*/
        									"FixturesLife"          	=> $FixturesLife, /* Common Values*/
        									"FurnitureValue"          	=> $FurnitureValue, /* Common Values*/
        									"FurnitureLife"          	=> $FurnitureLife, /* Common Values*/
        									"BuildingValue"          	=> $BuildingValue, /* Common Values*/
        									"BuildingLife"          	=> $BuildingLife, /* Common Values*/
        									"AnnualRental"          	=> $WeeklyRental
        									
        									);
									
	    
	    
	                return $TempArr;
	    
	    
	
    }
    
    

	
	public static function GetGBResidentValueFn(){

      $ResidentRet               = 0;

      if ($FnValue > 125000){
        $ResidentRet             = $ResidentRet + (($FnValue-125000) * 0.02);

      }
      if ($FnValue > 250000){
        $ResidentRet             = $ResidentRet + (($FnValue-250000) * 0.03);
      }


      if ($FnValue > 925000){
        $ResidentRet             = $ResidentRet + (($FnValue-925000) * 0.05);
      } 

      if ($FnValue > 1500000){
        $ResidentRet             = $ResidentRet + (($FnValue-1500000) * 0.02);
      }
      
      return $ResidentRet; 

    }
	
	public static function  GetGBLandLeaseRegisterAmt($FnValue) {


        $RegisterAmt             = 0;

        if ($FnValue >= 1000000){
            $RegisterAmt         = 910;
        }
            
        else if($FnValue >= 500000){
            $RegisterAmt         = 540;
        }

        else if($FnValue >= 200000){
            $RegisterAmt         = 270;
        }

        else if($FnValue > 1){
            $RegisterAmt         = 190;
        }

            

        return floatval($RegisterAmt); 

	}
	
	
	
	public static function PropComp(){
        
        \ajax\ajaxClass::init();
        $rows = \ajax\ajaxClass::GetAnalyzerValidation($PropertyId,$countryid);
      
        foreach ($rows as $row) 
        {
            

        	//$autoid				            = $row["autoid"];
        	self::$property_id 				    = isset($row["property_id"])                 ? $row["property_id"] : "";
            self::$LocationId				    = isset($row["LocationId"])                 ? $row["LocationId"] : "";
            self::$MyPortFolioName			    = isset($row["MyPortFolioName"])              ? $row["MyPortFolioName"] : "";
            self::$Subrub				        = isset($row["Subrub"])            ? $row["Subrub"] : "";
            self::$MyPortfolioPropAddress       = isset($row["MyPortfolioPropAddress"])              ? $row["MyPortfolioPropAddress"] : "";
            self::$CountryId                    = isset($row["CountryId"])              ? $row["CountryId"] : "";

        	self::$OwnerOccupier				= $row["OwnerOccupier"]                 ? $row["OwnerOccupier"]         : "0";
        	self::$SecondHomeInvestment			= $row["SecondHomeInvestment"]          ? $row["SecondHomeInvestment"]  : "0";
        	self::$AUDynamicPrice				= $row["audynamicprice"]                ? $row["audynamicprice"]        : "0";
        	self::$Resident        		        = $row["Resident"]                      ? $row["Resident"]              : "0";
        	self::$ResidentInvestor        	    = $row["ResidentInvestor"]              ? $row["ResidentInvestor"]      : "0";
        	
        	
        	self::$Purchaseprice        	      = $row["DuvalDynamicPrice"]             ? $row["DuvalDynamicPrice"]                : "0";
        	self::$Income        	              = $row["Income"]                        ? $row["Income"]                : "0";
        	self::$MarketPrice  			      = $row["MarketPrice"]                   ? $row["MarketPrice"]           : "0"; 
        	self::$DuvalDynamicPrice   	          = $row["DuvalDynamicPrice"]             ? $row["DuvalDynamicPrice"]     : "0";
        	self::$StampDuty				      = $row["StampDuty"]                     ? $row["StampDuty"]             : "0";
            self::$LeaseRegistration		      = $row["LeaseRegistration"]             ? $row["LeaseRegistration"]   : "0";
            self::$TransferFees                   = $row["TransferFees"]                  ? $row["TransferFees"]   : "0";
 
            self::$MortgageRegistration           = $row["MortgageRegistration"]          ? $row["MortgageRegistration"]   : "0";
            self::$LandTransfer                   = $row["LandTransfer"]                  ? $row["LandTransfer"]   : "0";
            self::$LegalFees                      = $row["LegalFees"]                     ? $row["LegalFees"]                 : "0";
            self::$TotalPurchaseCost              = $row["TotalPurchaseCost"]             ? $row["TotalPurchaseCost"]   : "0";
            self::$ResetrvationFees               = $row["ResetrvationFees"]              ? $row["ResetrvationFees"]   : "0";
            self::$StagePay1Per                   = $row["StagePay1Per"]                  ? $row["StagePay1Per"]   : "0";
            self::$StagePay1Amt                   = $row["StagePay1Amt"]                  ? $row["StagePay1Amt"]   : "0";
            self::$StagePay2Per                   = $row["StagePay2Per"]                  ? $row["StagePay2Per"]   : "0";
            self::$StagePay2Amt                   = $row["StagePay2Amt"]                  ? $row["StagePay2Amt"]   : "0";
            self::$LoanAmountPer                  = $row["LoanAmountPer"]                  ? $row["LoanAmountPer"]   : "0";
            self::$Topup                          = $row["Topup"]                         ? $row["Topup"]   : "0";
            self::$WeeklyRental	                  = $row["WeeklyRental"]                  ? $row["WeeklyRental"]   : "0";
            self::$VacancyRate                    = $row["VacancyRate"]                   ? $row["VacancyRate"]   : "0";
            self::$LettingFeeRate                 = $row["LettingFeeRate"]                ? $row["LettingFeeRate"]   : "0";
            self::$ManagementFees                 = $row["ManagementFees"]                ? $row["ManagementFees"]   : "0";
            self::$CouncilPropertyTax             = $row["CouncilPropertyTax"]            ? $row["CouncilPropertyTax"]   : "0";
            
            self::$CodyCorporateServiceChg        = $row["CodyCorporateServiceChg"]       ? $row["CodyCorporateServiceChg"]   : "0";
            self::$LandLeaseRentPa                = $row["LandLeaseRentPa"]               ? $row["LandLeaseRentPa"]   : "0";
            self::$InsurancePa                    = $row["InsurancePa"]                   ? $row["InsurancePa"]   : "0";
            self::$RepairandMaintenance           = $row["RepairandMaintenance"]          ? $row["RepairandMaintenance"]   : "0";
            self::$CleaningPerMonth               = $row["CleaningPerMonth"]              ? $row["CleaningPerMonth"]   : "0";
            self::$GardeningPerMonth              = $row["GardeningPerMonth"]             ? $row["GardeningPerMonth"]   : "0";
            self::$ServiceContractsPa             = $row["ServiceContractsPa"]            ? $row["ServiceContractsPa"]   : "0";
            self::$Other                          = $row["Other"]                         ? $row["Other"]   : "0";
            self::$LTV                            = $row["LTV"]                           ? $row["LTV"]   : "0";
            self::$InitialLoanAmt                 = $row["InitialLoanAmt"]                ? $row["InitialLoanAmt"]   : "0";
            self::$InterestRate                   = $row["InterestRate"]                  ? $row["InterestRate"]   : "0";
            self::$TermYears                      = $row["TermYears"]                     ? $row["TermYears"]   : "0";
            self::$CPI                            = $row["CPI"]                           ? $row["CPI"]   : "0";
            self::$RentalGrowth                   = $row["RentalGrowth"]                  ? $row["RentalGrowth"]   : "0";
            self::$CapitalGrowth                  = $row["CapitalGrowth"]                 ? $row["CapitalGrowth"]   : "0";
            self::$BuildingValue                  = $row["BuildingValue"]                 ? $row["BuildingValue"]   : "0";
            self::$BuildingLife                   = $row["BuildingLife"]                  ? $row["BuildingLife"]   : "0";
            self::$FixturesValue                  = $row["FixturesValue"]                 ? $row["FixturesValue"]   : "0";
            self::$FixturesLife                   = $row["FixturesLife"]                  ? $row["FixturesLife"]   : "0";
            self::$FurnitureValue                 = $row["FurnitureValue"]                ? $row["FurnitureValue"]   : "0";
            self::$FurnitureLife                  = $row["FurnitureLife"]                 ? $row["FurnitureLife"]   : "0";
            self::$AnnualRental				      = $row["WeeklyRental"]                   ? $row["WeeklyRental"]   : "0"; 
            self::$CapitalGrowthRate			 = isset($row["CapitalGrowthRate"]) 	  ? $row["CapitalGrowthRate"] : "0"; 
            
            self::$firsttimebuyer 						= isset($row["firsttimebuyer"]) 			? $row["firsttimebuyer"] : "";  
            self::$RentalGuarantee 						= isset($row["RentalGuarantee"]) 			? $row["RentalGuarantee"] : "";  
            self::$FurniturePackReq 					= isset($row["FurniturePackReq"]) 			? $row["FurniturePackReq"] : "";  
            self::$UnitSize 							= isset($row["UnitSize"]) 					? $row["UnitSize"] : "";  
            self::$UnitType  							= isset($row["UnitType "]) 				? $row["UnitType "] : "";   
            
            //echo '==='. self::$Purchaseprice;
            
        }
        
        
    }
    
    
    public static function convertDate($date , $dateFormat = '%d-%m-%Y %H:%M:%S'){
        
        
		$date       = str_replace("/" , "-" , $date);
			
		$timestamp  = strftime($date);
		
		return strftime($dateFormat , strtotime($timestamp));
    }
    
    
     public static function BelowZeroColor($Value1){ // Arzath - 2020-07-16
        
        //echo 'Value1'. $Value1;
        
        if ($Value1=="")
            $Value1 = 1;
            
            
            
            
        if( $Value1 < 0){
            
            $stylecolor = " style='color:red'; ";
        }else{
            
            $stylecolor = "";
        }
            
            
        return  $stylecolor;
            
    }
    
    
}

