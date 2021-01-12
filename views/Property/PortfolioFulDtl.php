<?php
include "header.php"; 
\login\loginClass::Init();
$checkSession           = \login\loginClass::CheckUserSessionIp();
$ProprtyId              = $_REQUEST["id"];
$autoid                 = $_REQUEST["autoid"] ? $_REQUEST["autoid"] : "";
$myportfoliocountry     = isset($_REQUEST["myportfoliocountry"]) ? $_REQUEST["myportfoliocountry"] : "";
$countryid              = $_REQUEST["countryid"] ? $_REQUEST["countryid"] : "";
$ViewCompare            = $_REQUEST["ViewCompare"] ? $_REQUEST["ViewCompare"] : "";
if ($countryid == "")
{
    $countryid = $myportfoliocountry;
}
$DateBought = date('d/m/Y');
$RecentAnalyse   	= $_REQUEST["RecentAnalyse"] ? $_REQUEST["RecentAnalyse"] : "";
$IsProtFolio   	    = $_REQUEST["IsProtFolio"] ? $_REQUEST["IsProtFolio"] : "";
if ( $RecentAnalyse == "Y")
{
    $FlagValue = "R";
}
else if ( $RecentAnalyse == "Y")
{
    $FlagValue = "P";
}
else
{
    $FlagValue = "N";
}
$DateBought   	    = $_REQUEST["DateBought"] ? $_REQUEST["DateBought"] : $DateBought;
$DateCompletion   	= $_REQUEST["DateCompletion"] ? $_REQUEST["DateCompletion"] : "";
if ( $countryid == "3")
{
    $hideDep = "Style='display:none;'";
}
else
{
    $hideDep = "";
}
if  ( $IsProtFolio == "Y")
{
    $HideDate = "";
}
else
{
    $HideDate = "Style='display:none;'";
}
\Property\PropertyClass::Init();
$user_id   = \settings\session\sessionClass::GetSessionDisplayName();
if ($ProprtyId != "")
{
    $Propertyrows = self::GetPropertiesDatas($ProprtyId,'','');
    foreach ($Propertyrows as $Propertyrow)   
    {   
        $ProjectName                = $Propertyrow["project_name"]          ? $Propertyrow["project_name"]          : "";
        $building                   = $Propertyrow["building"]              ? $Propertyrow["building"]              : "";
        $apartment_no               = $Propertyrow["apartment_no"]          ? $Propertyrow["apartment_no"]          : "";
        $UnitSize                   = $Propertyrow["land_area"]             ? $Propertyrow["land_area"]             : "0";
        $UnitType                   = $Propertyrow["no_of_bedrooms"]        ? $Propertyrow["no_of_bedrooms"]        : "0";
        $Purchaseprice              = $Propertyrow["dpo_rate"]              ? $Propertyrow["dpo_rate"]              : "0";
        $DuvalDynamicPrice          = $Propertyrow["dpo_rate"]              ? $Propertyrow["dpo_rate"]              : "0";
        $MarketPrice                = $Propertyrow["start_rate"]            ? $Propertyrow["start_rate"]            : "0";
        $countryid                  = $Propertyrow["country"]               ? $Propertyrow["country"]               : "";
        $weeklyRent	                = $Propertyrow["weekly_rent"]           ? $Propertyrow["weekly_rent"]           : "";  
        $DateCompletion	            = $Propertyrow["completion_date"]       ? $Propertyrow["completion_date"]       : "";
        $CouncilPropertyTax         = $Propertyrow["Est_Counci_Tax"]        ? $Propertyrow["Est_Counci_Tax"]        : "";
        $CodyCorporateServiceChg    = $Propertyrow["Est_Service_Charge"]    ? $Propertyrow["Est_Service_Charge"]    : "";
        $LandLeaseRentPa            = $Propertyrow["Est_Ground_Rent"]       ? $Propertyrow["Est_Ground_Rent"]       : "";
        $ResetrvationFees           = $Propertyrow["Reservation_Fee"]       ? $Propertyrow["Reservation_Fee"]       : "";
        $StagePay1Per               = $Propertyrow["Stage_Payment1"]        ? $Propertyrow["Stage_Payment1"]        : "";
        $StagePay2Amt               = $Propertyrow["Stage_Payment2"]        ? $Propertyrow["Stage_Payment2"]        : "";
        $WeeklyRental               = $weeklyRent;
    }   
}
if (!isset($countryid))
{
    $countryid                  = isset($_REQUEST["countryid"]) ? $_REQUEST["countryid"] : "";
}
$IsAuGbNz                       = false;
if ($countryid == "2" || $countryid == "3" || $countryid == "1")
{
    $IsAuGbNz                   = true;
}
$LocationId                     = isset($_REQUEST["LocationId"]) ? $_REQUEST["LocationId"] : "";
$MyPortFolioName                = isset($_REQUEST["MyPortFolioName"]) ? $_REQUEST["MyPortFolioName"] : "";
$Subrub                         = isset($_REQUEST["Subrub"]) ? $_REQUEST["Subrub"] : "";
$MyPortfolioPropAddress         = isset($_REQUEST["MyPortfolioPropAddress"]) ? $_REQUEST["MyPortfolioPropAddress"] : "";
$ChkCntArr               		= \DBConn\DBConnection::getQueryFetchColumn("(SELECT CURRENCY FROM country_master WHERE COUNTRY_CODE ='{$countryid}')");
$Currency             			= $ChkCntArr["0"];
$ChkSymbolArr               	= \DBConn\DBConnection::getQueryFetchColumn("(SELECT Currency_Symbol FROM country_master WHERE COUNTRY_CODE ='{$countryid}')");
$CurrencySym             		= $ChkSymbolArr["0"] ."&nbsp;".$Currency;
$ChkCodeArr                     = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_CODE_NEW FROM country_master WHERE COUNTRY_CODE ='{$countryid}')");
$CountryCodeNew                 = $ChkCodeArr["0"];
$rows = \Property\PropertyClass::GetPropertiesAnayserData($countryid);
foreach ($rows as $row) 
{
    $CW_Auto_id				            = $row["CW_Auto_id"];
   	$ip_glb_client_fee					= $row["Ip_Glb_Client_Fee"]             ? $row["Ip_Glb_Client_Fee"]             : "0";
   	$ReservationDeposit					= $row["Reservation_Deposit"]           ? $row["Reservation_Deposit"]           : "0";
   	$Conveyancingfees					= $row["Conveyancing_Fees"]             ? $row["Conveyancing_Fees"]             : "0";
   	$Landregistryfees        		    = $row["Landregistry_Fees"]             ? $row["Landregistry_Fees"]             : "0";
   	$Engrossmentfees        	        = $row["Engrossment_Fees"]              ? $row["Engrossment_Fees"]              : "0";
   	$MortgageType        	            = $row["Mortgage_Type"]                 ? $row["Mortgage_Type"]                 : "0";
   	$MortgageLendingVal   			    = $row["Mortgage_Lending_Val"]          ? $row["Mortgage_Lending_Val"]         : "0"; 
   	$MortgageRate   	                = $row["Mortgage_Rate"]                 ? $row["Mortgage_Rate"]                 : "0";
   	$MortgageLongTerm   		    	= $row["Mortgage_Long_Term"]            ? $row["Mortgage_Long_Term"]            : "0";
   	$Finalcapitalpayment   		        = $row["Final_Capital_Payment"]         ? $row["Final_Capital_Payment"]         : "0";
   	$Stampduty   			            = $row["Stamp_Duty"]                    ? $row["Stamp_Duty"]                    : "0";
   	$LiquidExpatbrokercosts   		    = $row["Liquid_Expatbroker_Costs"]      ? $row["Liquid_Expatbroker_Costs"]      : "0";
   	$Lenderarrangementfee   			= $row["Lender_Arrangement_Fee"]        ? $row["Lender_Arrangement_Fee"]        : "0";
   	$Valuationfee   			        = $row["Valuation_Fee"]                 ? $row["Valuation_Fee"]                 : "0";
   	$Furniturepack   					= $row["Furniture_Pack"]                ? $row["Furniture_Pack"]                : "0";
   	$CompleteTenantfee   				= $row["Complete_Tenant_Fee"]           ? $row["Complete_Tenant_Fee"]           : "0";
   	$CompleteTenantagreementfee   		= $row["Complete_Tenantagreement_Fee"]  ? $row["Complete_Tenantagreement_Fee"]  : "0";
   	$CompleteHandoverfee   				= $row["Complete_Handover_Fee"]         ? $row["Complete_Handover_Fee"]         : "0";
   	$CompleteInventoryfee   			= $row["Complete_Inventory_Fee"]        ? $row["Complete_Inventory_Fee"]        : "0";
   	$CompleteReferenceCheck   			= $row["Complete_Reference_Check"]      ? $row["Complete_Reference_Check"]      : "0";
   	$ClientFeeRebateComp   				= $row["ClientFee_Rebate_Comp"]         ? $row["ClientFee_Rebate_Comp"]         : "0";
   	$ServiceCharge   				    = $row["Service_Charge"]                ? $row["Service_Charge"]                : "0";
   	$TenantManagementFee   				= $row["Tenant_Management_Fee"]         ? $row["Tenant_Management_Fee"]         : "0";
   	$GroundRent   				    	= $row["Ground_Rent"]                   ? $row["Ground_Rent"]                   : "0";
   	$vatpercentage   				    = $row["vat_percentage"]                ? $row["vat_percentage"]                : "0";
}
$ipglbclientfeeAmt                  =  - floatval($ip_glb_client_fee)  ;
$ResDepositPercntage                =    floatval($ReservationDeposit) / 100;
$ReservationDepositAmt              =    -(floatval($Purchaseprice) *   floatval($ResDepositPercntage));
$ConveyancingfeesAmt                =  - floatval($Conveyancingfees)  ;
$LandregistryfeesAmt                =  - floatval($Landregistryfees)  ;
$EngrossmentfeesAmt                 =  - floatval($Engrossmentfees)  ;
$PaymentResExcAmount                =   floatval($ipglbclientfeeAmt) +  floatval($ReservationDepositAmt) +  floatval($ConveyancingfeesAmt) +  floatval($LandregistryfeesAmt) +  floatval($EngrossmentfeesAmt);
$FinalcapitalpaymentAmt             =  - ( floatval($Purchaseprice) * floatval($Finalcapitalpayment)  / 100  );
$StampdutyAmt                       =  - floatval($Stampduty)  ;
$LiquidExpatbrokercostsAmt          =  - floatval($LiquidExpatbrokercosts)  ;
$LenderarrangementfeeAmt            =  - floatval($Lenderarrangementfee)  ;
$ValuationfeeAmt                    =  - floatval($Valuationfee)  ;
$FurniturepackAmt                   =  - floatval($Furniturepack)  ;
$CompleteTenantfeeAmt               =  - floatval($CompleteTenantfee)  ;
$CompleteTenantagreementfeeAmt      =  - floatval($CompleteTenantagreementfee)  ;
$CompleteHandoverfeeAmt             =  - floatval($CompleteHandoverfee)  ;
$CompleteInventoryfeeAmt            =  - floatval($CompleteInventoryfee)  ;
$CompleteReferenceCheckAmt          =  - floatval($CompleteReferenceCheck)  ;
$ClientFeeRebateCompAmt             =    floatval($ClientFeeRebateComp)  ;
$PaymentOnCompleteion               =   floatval($FinalcapitalpaymentAmt) + floatval($StampdutyAmt) + floatval($LiquidExpatbrokercostsAmt) + floatval($LenderarrangementfeeAmt) + floatval($ValuationfeeAmt) + floatval($FurniturepackAmt) + floatval($CompleteTenantfeeAmt) + floatval($CompleteTenantagreementfeeAmt) + floatval($CompleteHandoverfeeAmt) + floatval($CompleteInventoryfeeAmt) + floatval($CompleteReferenceCheckAmt) + floatval($ClientFeeRebateCompAmt);
$FurtherDepositAmt                  =   floatval($Purchaseprice)  * 0 ;
$TotalEquityRequired                =   floatval($PaymentResExcAmount) + floatval($PaymentOnCompleteion) + floatval($FurtherDepositAmt);
if ( $MortgageType != "None")
{
    $MortgageLendingValPercentage        =    floatval($MortgageLendingVal) / 100;
    $TotalMortgageAmount                 =    floatval($Purchaseprice) *   floatval($MortgageLendingValPercentage);
}
else
{
    $TotalMortgageAmount                =   0;
}
$EstGrsRentalIncome                     =  round(floatval($weeklyRent) * 4.33); 
$ServiceChargeAmt                       = - round( floatval($ServiceCharge) * floatval($UnitSize)   / 12 );
$vatpercentageTemp                      =  floatval($vatpercentage) / 100;
$TenantManagementFeeAmt                 =  -  round((floatval($EstGrsRentalIncome) *  floatval($TenantManagementFee) /100)  * ( 1 + floatval($vatpercentageTemp)));
$GroundRentTemp                         =  (floatval($Purchaseprice) * 0.1) / 12;
$GroundRent                             =  round(floatval($GroundRentTemp) / 100);
$GroundRentAmt                          =  - floatval($GroundRent); 
$NetMonthlyExpenses                     =   floatval($ServiceChargeAmt) +  floatval($TenantManagementFeeAmt) + floatval($GroundRentAmt);
$ScndMonthlyExpenses                    =   floatval($NetMonthlyExpenses) +  floatval($EstGrsRentalIncome);
$MortgageTypeIntersetOnly               =  -335;
$ProjNetMonthPostion                    =  floatval($MortgageTypeIntersetOnly) + floatval($ScndMonthlyExpenses);
$Paymentonreservation                   =    floatval($PaymentResExcAmount);
$FurtherdepositTotal                    =    floatval($FurtherDepositAmt);
$PaymentPropComp                        =    floatval($PaymentOnCompleteion);
$TotalEquiltyRequiredVal                =    floatval($TotalEquityRequired);
$MortgagePrincipleTotal                 =    floatval($TotalMortgageAmount);
$Projectedmonthlycash                  =    floatval($ProjNetMonthPostion); 
$MortgageInterestOnly                  =    floatval($MortgageTypeIntersetOnly); 
$MonthlyIncome                         =    floatval($ScndMonthlyExpenses);
if ($autoid != "" || $propertyid != "" )
{
    if ($autoid != "")
    {
        $strWher .= " and autoid='{$autoid}' ";
    }
    if ($propertyid != "")
    {
        $strWher .= " and propertyid='{$propertyid}' ";
    }
    $ChkPropAnsArr               	= \DBConn\DBConnection::getQueryFetchColumn("(SELECT count(*) FROM property_analyzer_inputs where userid='{$user_id}' ". $strWher ." )");
    $PropAnsArr             		= $ChkPropAnsArr["0"];
    
    // echo "(SELECT count(*) FROM property_analyzer_inputs where userid='{$user_id}' ". $strWher ." )";
    // die();
}
else
{
    $PropAnsArr = 0;
}
if( $PropAnsArr > 0)
{
    $rows = \Property\PropertyClass::GetPropertyComparison("",$ProprtyId,$autoid,"",$ViewCompare);
    foreach ($rows as $row)
    {
        $property_id 				= isset($row["propertyid"])                 ? $row["propertyid"] : "";
        $LocationId				= isset($row["LocationId"])                 ? $row["LocationId"] : "";
        $MyPortFolioName			= isset($row["property_name"])              ? $row["property_name"] : "";
        $Subrub				    = isset($row["location_name"])            ? $row["location_name"] : "";
        $MyPortfolioPropAddress   = isset($row["property_desc"])              ? $row["property_desc"] : "";
        $CountryId                        = isset($row["country_id"])              ? $row["country_id"] : "";
        $CountryCodeNew                  = isset($row["COUNTRY_CODE_NEW"])              ? $row["COUNTRY_CODE_NEW"] : "";
        $OwnerOccupier					= $row["owneroccupier"]                 ? $row["owneroccupier"]         : "0";
        $SecondHomeInvestment			= $row["secondhomeinvestment"]          ? $row["secondhomeinvestment"]  : "0";
        $AUDynamicPrice					= $row["audynamicprice"]                ? $row["audynamicprice"]        : "0";
        $Resident        		        = $row["resident"]                      ? $row["resident"]              : "";
        $ResidentInvestor        	    = $row["residentinvestor"]              ? $row["residentinvestor"]      : "";
        $NonResidentInvestor            = $row["NonResidentInvestor"]           ? $row["NonResidentInvestor"]   : "0";
        $NonResidentInvestorAmt         = $row["NonResidentInvestorAmt"]        ? $row["NonResidentInvestorAmt"]: "0";
        $Purchaseprice        	      = $row["duvaldynamicprice"]             ? $row["duvaldynamicprice"]                : "0";
        $Income        	              = $row["income"]                        ? $row["income"]                : "0";
        $MarketPrice  			             =       $row["marketprice"]           ?   $row["marketprice"] : "0"; 
        $DuvalDynamicPrice   	          = $row["duvaldynamicprice"]             ? $row["duvaldynamicprice"]     : "0";
        $StampDuty				      = $row["stampduty"]                     ? $row["stampduty"]             : "0";
        $LeaseRegistration		      = $row["leaseregistration"]             ? $row["leaseregistration"]   : "0";
        $TransferFees                   = $row["transferfees"]                  ? $row["transferfees"]   : "0";
        $MortgageRegistration           = $row["mortgageregistration"]          ? $row["mortgageregistration"]   : "0";
        $LandTransfer                   = $row["landtransfer"]                  ? $row["landtransfer"]   : "0";
        $LegalFees                      = $row["legalfees"]                     ? $row["legalfees"]                 : "0";
        $TotalPurchaseCost              = $row["totalpurchasecost"]             ? $row["totalpurchasecost"]   : "0";
        $ResetrvationFees               = $row["resetrvationfees"]              ? $row["resetrvationfees"]   : "0";
        $StagePay1Per                   = $row["stagepay1per"]                  ? $row["stagepay1per"]   : "0";
        $StagePay1Amt                   = $row["stagepay1amt"]                  ? $row["stagepay1amt"]   : "0";
        $StagePay2Per                   = $row["stagepay2per"]                  ? $row["stagepay2per"]   : "0";
        $StagePay2Amt                   = $row["stagepay2amt"]                  ? $row["stagepay2amt"]   : "0";
        $LoanAmountPer                  = $row["loanamountper"]                  ? $row["loanamountper"]   : "0";
        $Topup                          = $row["topup"]                         ? $row["topup"]   : "0";
        $WeeklyRental	                  = $row["weeklyrental"]                  ? $row["weeklyrental"]   : "0";
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
        $AnnualRental				      = $row["weeklyrental"]                   ? $row["weeklyrental"]   : "0"; 
        $CapitalGrowthRate			 = isset($row["CapitalGrowthRate"]) 	  ? $row["CapitalGrowthRate"] : "0"; 
        $firsttimebuyer 						= isset($row["firsttimebuyer"]) 			? $row["firsttimebuyer"] : "";  
        $RentalGuarantee 						= isset($row["RentalGuarantee"]) 			? $row["RentalGuarantee"] : "";  
        $FurniturePackReq 					= isset($row["FurniturePackReq"]) 			? $row["FurniturePackReq"] : "";  
        $UnitSize 							= isset($row["UnitSize"]) 					? $row["UnitSize"] : "";  
        $UnitType  							= isset($row["UnitType "]) 				? $row["UnitType "] : "";   
        $DateBought  							= $row["purschase_date"] 				? $row["purschase_date"] : "";   
        $DateCompletion  							= $row["completion_date"]				? $row["completion_date"] : "";   
        $IntOrPrincipalInt                     =  $row["IntOrPrincipalInt"]				? $row["IntOrPrincipalInt"] : "";   
        $ResidentStatus                     =  $row["ResidentStatus"]				? $row["ResidentStatus"] : "";  
        $HavePersonalAllowance  			= $row["HavePersonalAllowance"]		? $row["HavePersonalAllowance"] : "";   
        $UkResidentStatus  			    = $row["UkResidentStatus"]		? $row["UkResidentStatus"] : "";
    }
}
if ($IsAuGbNz)
{
    if ( $Income == "")
    {
        $Income						= 0;
    }
    if (floatval($MarketPrice) == 0)
    {
        $MarketPrice			= 0;
    }
    if (!isset($DuvalDynamicPrice))
    {
        $DuvalDynamicPrice		= 0;
    }
    if (floatval($WeeklyRental) == 0)
    {
        $WeeklyRental			= 0;
    }
    if (!isset($StampDuty))                  $StampDuty					= 0;
    if (!isset($TransferFees))               $TransferFees				= 0;
    if (!isset($LegalFees))                  $LegalFees					= 0;
    if (!isset($TotalPurchaseCost))          $TotalPurchaseCost			= 0;
    if (!isset($ResetrvationFees))           $ResetrvationFees			= 0;
    if (!isset($StagePay1Per))               $StagePay1Per				= 0;
    if (!isset($StagePay1Amt))               $StagePay1Amt				= 0;
    if (!isset($StagePay2Per))               $StagePay2Per				= 0;
    if (!isset($StagePay2Amt))               $StagePay2Amt				= 0;
    if (!isset($LoanAmountPer))              $LoanAmountPer				= 0;
    if (!isset($Topup))                      $Topup						= 0;
    if (!isset($VacancyRate))                $VacancyRate				= 0;
    if (!isset($LettingFeeRate))             $LettingFeeRate				= 0;
    if (!isset($ManagementFees))             $ManagementFees				= 0;
    if (!isset($CouncilPropertyTax))         $CouncilPropertyTax			= 0;
    if (!isset($CodyCorporateServiceChg))    $CodyCorporateServiceChg	= 0;
    if (!isset($LandLeaseRentPa))            $LandLeaseRentPa			= 0;
    if (!isset($InsurancePa))                $InsurancePa				= 0;
    if (!isset($RepairandMaintenance))       $RepairandMaintenance		= 0;
    if (!isset($CleaningPerMonth))           $CleaningPerMonth			= 0;
    if (!isset($GardeningPerMonth))          $GardeningPerMonth			= 0;
    if (!isset($ServiceContractsPa))         $ServiceContractsPa			= 0;
    if (!isset($Other))                      $Other						= 0;
    if (!isset($LTV))                        $LTV						= 0;
    if (!isset($InitialLoanAmt))             $InitialLoanAmt				= 0;
    if (!isset($InterestRate))               $InterestRate				= 0;
    if (!isset($TermYears))                  $TermYears					= 0;
    if (!isset($CPI))                        $CPI						= 0;
    if (!isset($RentalGrowth))               $RentalGrowth				= 0;
    if (!isset($CapitalGrowth))              $CapitalGrowth				= 0;
    if (!isset($FixturesValue))              $FixturesValue				= 0;
    if (!isset($FixturesLife))               $FixturesLife				= 0;
    if (!isset($FurnitureValue))             $FurnitureValue				= 0;
    if (!isset($FurnitureLife))              $FurnitureLife				= 0;
    if (!isset($FurnitureLife))              $SecondHomeInvestment       = "";
    if (!isset($FurnitureLife))              $OwnerOccupier              = ""; 
    if (!isset($FurnitureLife))              $LeaseRegistration          = "";
    if (!isset($MortgageRegistration))       $MortgageRegistration       = "";
    if (!isset($LandTransfer))               $LandTransfer               = ""; 
    if (!isset($BuildingValue))              $BuildingValue              = 0;
    if (!isset($BuildingLife))               $BuildingLife               = 0;
    if (!isset($IntOrPrincipalInt))          $IntOrPrincipalInt               = "PrinicipalAndInterest";
    if (!isset($ResidentStatus))          $ResidentStatus               = "Resident";
    if (!isset($HavePersonalAllowance))          $HavePersonalAllowance               = "NO";
    if (!isset($UkResidentStatus))          $UkResidentStatus               = "OO";
    if ($countryid == "3")
    {
        $DuvalPriceReadOnly     = "readonly";
        if ( $DuvalDynamicPrice == "")
        {
            $DuvalDynamicPrice      = 0;
        }
        $TransferFees           = 0;
        $TopUpReadonly           = "readonly";
        $ColorChange = " style='background: #d0f2cc;' ";
    }
    else if ($countryid == "2")
    {
        $DuvalPriceReadOnly     = "readonly";
        $AUDynamicPrice          = $DuvalDynamicPrice     ;
        $TransferFees           = 0;
        $TopUpReadonly           = "readonly";
        $ColorChange = " style='background: #d0f2cc;' ";
    }
    else
    {
        $DuvalPriceReadOnly     = "";
        $TopUpReadonly           = "readonly";
        $ColorChange = "";
    }
}
?>
<style>
    select#AuLocation {
    background: #d0f2cc;
}
</style>
<!-- datepicker -->
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL; ?>dashboard/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css">  
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL; ?>dashboard/assets/plugins/flexslider/css/flexslider.min.css">
<div class="inner-wrapper">
    <form class="analysis-form" accept-charset="utf-8" action="<?php echo SITE_BASE_URL;?>ajax/AnalyzerResult.html?dt=<?php echo date("YmdHis");?>&page=html&id=<?= $ProprtyId; ?><?= (isset($_REQUEST['edit'])) ? '&edit=Y' : '';?>" method="post" >
        <div class="tab-content-one">
            <input type="hidden" name="countryid" id="countryid" value="<?php echo $countryid;?>" />
            <input type="hidden" name="property_id" id="property_id" value="<?php echo $ProprtyId;?>" />
            <input type="hidden" name="LocationId" id="LocationId" value="<?php echo $LocationId;?>" />
            <input type="hidden" name="autoid" id="autoid" value="<?php echo $autoid;?>" />
            <input type="hidden" name="MyPortFolioName" id="MyPortFolioName" value="<?php echo $MyPortFolioName;?>" />
            <input type="hidden" name="Subrub" id="Subrub" value="<?php echo $Subrub;?>" />
            <input type="hidden" name="FlagValue" id="FlagValue" value="<?php echo $FlagValue;?>" />
            <input type="hidden" name="MyPortfolioPropAddress" id="MyPortfolioPropAddress" value="<?php echo $MyPortfolioPropAddress;?>" />
            <div class="investment-panels">
                <div class="text-panel">
                    <h5>To add a new property to your portfolio, enter the information below and press Finish.</h5>
                    <p>Instructions:</p>
                    <p><span>1.</span> Simply fill in the information in the green boxes</p> 
                    <p><span>2.</span> If you don’t know the requested information simply leave the field blank and we will assume it is zero</p>
                </div>
                <h1 class="hero-title-dark">Purchase Information
                    <div class="from-group">
                        <label for="crn">Currency</label>
                        <select name="" id="" class="form-control">
                            <?php 
                            \login\loginClass::Init();
                            $Countryrows = \Masters\MastersClass::GetCurrencyDtl('');
                            $i = 1;
                            foreach ($Countryrows as $Countryrow) 
                            {
                                $Currencies=$Countryrow["currency_id"];
                            ?>
                            <option <?= ($Currency == $Currencies) ? 'selected' : '';?> value="<?php echo $Currencies;?>"><?php echo $Currencies;?></option>
                            <?php       
                            }
                            ?>
                        </select>
                    </div>
                </h1>
                <div class="fields-panel">
                    <p>Enter the information below about the cost of the property you are buying. Where you have existing income in
country you will need to enter this in order to accurately determine your specific income tax costs.</p>
                    <?php 
                    if( $IsProtFolio == "Y" || $RecentAnalyse == "Y" )
                    {
                        $ChkNameArr   = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_NAME FROM country_master WHERE COUNTRY_CODE ='{$countryid}')");
                        $CountryName    = $ChkNameArr["0"];
                        ?>
                        <div class="row">
                            <h4 class="card-title col-md-12" style="margin-top:20px;">Financial Analysis for: </h4>
                            <div class="form-group col-md-3">
                                <label><b>Country</b></label><br>
                                <label><?php echo $CountryName; ?></label>
                            </div>
                            <div class="form-group col-md-3">
                                <label><b>Property Name</b></label><br>
                                <label><?php echo $MyPortFolioName; ?></label>
                            </div>
                            <div class="form-group col-md-3">
                                <label><b>Property Address</b></label><br>
                                <label><?php echo $MyPortfolioPropAddress; ?></label>
                            </div>
                            <div class="form-group col-md-3">
                                <label><b>Location</b></label><br>
                                <label><?php echo $Subrub; ?></label>
                            </div>
                        </div>
                        <?php 
                    }
                    ?> 
                    <?php
                    if($countryid == "1")
                    {
                        ?>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Original Purchase Price <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control DuvalDynamicPrice" style='background: #d0f2cc;'  type='text' <?php echo $ColorChange; ?> name='DuvalDynamicPrice' id='DuvalDynamicPrice' rel='calculate' value='<?php echo number_format($DuvalDynamicPrice); ?>' <?php echo $DuvalPriceReadOnly; ?>>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Estimated Current Value <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control MarketPrice" style='background: #d0f2cc;'  type='text' name='MarketPrice' id='MarketPrice' rel='calculate' value='<?php echo number_format($MarketPrice); ?>'>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group" <?php echo $HideDate;?>>
                                    <label for="">Purchase Date</label>
                                    <input class="form-control date_picker" style='background: #d0f2cc;'  type="text" placeholder="dd/mm/yy" autocomplete='off' name="DateBought" id ="DateBought" value="<?php echo $DateBought; ?>" >
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Existing Gross in County Income (excluding this property) <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control Income" style='background: #d0f2cc;'  type='text' name='Income' id='Income' rel='calculate' value='<?php echo $Income; ?>'>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Stamp Duty (paid when purchased) <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control StampDuty" style='background: #d0f2cc;'   type='text' name='StampDuty'  id='StampDuty' rel='calculate' value='<?php echo number_format($StampDuty); ?>' >
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Transfer Fees <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control TransferFees" style='background: #d0f2cc;'   type='text' name='TransferFees' id='TransferFees' rel='calculate' value='<?php echo $TransferFees; ?>' >
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Legal Fees <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control LegalFees" style='background: #d0f2cc;'  type='text' name='LegalFees' rel='calculate' value='<?php echo $LegalFees; ?>'>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Total Purchase Cost <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control TotalPurchaseCost" style="background:#fff;" type='text' name='TotalPurchaseCost' id='TotalPurchaseCost' rel='calculate' value='<?php echo $TotalPurchaseCost; ?>' readonly>
                                </div>
                            </div>
                        </div>
                      
                        <?php
                    }
                    else if($countryid == "2")
                    {
                        ?>
                        <div class="row">
                            <div class="col-12 mt-5">
                                <h4>Residential Tax Status</h4>
                                <div class="radio-checks">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="ResidentStatus" id="ResidentStatus1" value="Resident" <?php if($ResidentStatus =="Resident" ) {?> checked <?php } ?> >
                                            Australian Tax Resident
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="ResidentStatus" id="ResidentStatus2" value="NRI" <?php if($ResidentStatus =="NRI" ) {?> checked <?php } ?> >
                                            Foreign Tax Resident
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">State</label>
                                    <?php echo \Html\Elements\InputsClass::plotArrayCombo( "AuLocation", "AU_LOCATIONS", $AuLocation, "Select", "class='form-control input-default' rel='calculate' "); ?>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Original Purchase Price<!--Du Val Dynamic Price ™--> <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control AUDynamicPrice" style='background: #d0f2cc;'  type='text' name='AUDynamicPrice' id='AUDynamicPrice' rel='calculate' value='<?php echo $AUDynamicPrice; ?>'>
                                    <input type="hidden" name="Resident" id="Resident" value="" />
                                    <input type="hidden" name="DuvalDynamicPrice" id="DuvalDynamicPrice" value="<?php echo $DuvalDynamicPrice; ?>" />
                                </div>
                            </div>
                            <?php 
                                //<div class="col-xl-3 col-md-6">
                                //<div class="form-group">
                                 //   <label for="">State</label>
                                 //   <?php echo \Html\Elements\InputsClass::plotArrayCombo( "AuLocation", "AU_LOCATIONS", $AuLocation, "Select", "class='form-control input-default' rel='calculate' "); //
                                //</div>
                            //</div>
                            ?>
                        </div>
                        <div class="row">
                            
                            <?php 
                            if ($IsAuGbNz){
                                if(1==2)
                                {
                            ?>
                                <div class="col-xl-3 col-md-6">
                                    <div class="form-group">
                                        <label for="">Original Purchase Price ™ <?php //echo $CurrencySym; ?></label>
                                        <input class="form-control DuvalDynamicPrice" style='background: #d0f2cc;'  type='text' <?php echo $ColorChange; ?> name='DuvalDynamicPrice' id='DuvalDynamicPrice' rel='calculate' value='<?php echo number_format($DuvalDynamicPrice); ?>' <?php echo $DuvalPriceReadOnly; ?>>
                                    </div>
                                </div>
                            <?php    
                                }
                            ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Estimated Current Value <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control MarketPrice" style='background: #d0f2cc;'  type='text' name='MarketPrice' id='MarketPrice' rel='calculate' value='<?php echo number_format($MarketPrice); ?>'>
                                </div>
                            </div>
                            
                            <?php
                            }
                            else if(1==2)
                            {
                            ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Original Purchase Price <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control DuvalDynamicPrice" style='background: #d0f2cc;'  type='text' <?php echo $ColorChange; ?> name='DuvalDynamicPrice' id='DuvalDynamicPrice' rel='calculate' value='<?php echo $DuvalDynamicPrice; ?>' <?php echo $DuvalPriceReadOnly; ?>>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group" <?php echo $HideDate;?>>
                                    <label for="">Purchase Date</label>
                                    <input class="form-control date_picker" style='background: #d0f2cc;'  type="text" placeholder="dd/mm/yy" autocomplete='off' name="DateBought" id ="DateBought" value="<?php echo $DateBought; ?>" >
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Existing Gross in County Income (excluding this property) <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control Income" style='background: #d0f2cc;'  type='text' name='Income' id='Income' rel='calculate' value='<?php echo $Income; ?>'>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Stamp Duty (paid when purchased) <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control StampDuty" style='background: #d0f2cc;'   type='text' name='StampDuty'  id='StampDuty' rel='calculate' value='<?php echo number_format($StampDuty); ?>' >
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Land Transfer <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control LandTransfer" style='background: #d0f2cc;'   type='text' name='LandTransfer' id='LandTransfer' rel='calculate' value='<?php echo $LandTransfer; ?>' >
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Legal Fees <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control LegalFees" style='background: #d0f2cc;'  type='text' name='LegalFees' id='LegalFees' rel='calculate' value='<?php echo $LegalFees; ?>'>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Mortgage Registration <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control MortgageRegistration" style='background: #d0f2cc;'   type='text' name='MortgageRegistration' id='MortgageRegistration' rel='calculate' value='<?php echo $MortgageRegistration; ?>' >
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Total Purchase Cost <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control TotalPurchaseCost" style="background:#fff;" type='text' name='TotalPurchaseCost' id='TotalPurchaseCost' rel='calculate' value='<?php echo $TotalPurchaseCost; ?>' readonly>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group" style='display:none;'>
                                    <label for="">Completion Date</label>
                                    <input class="form-control date_picker" type="text" placeholder="dd/mm/yy" autocomplete='off' name="DateCompletion" id ="DateCompletion" value="<?php echo $DateCompletion; ?>" >
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    else if($countryid == "3")
                    {
                        if ($UkResidentStatus == "OO")
                        {
                            $OwnerOccupier   = $DuvalDynamicPrice;
                        }
                        else if ($UkResidentStatus == "RI")
                        {
                            $SecondHomeInvestment   = $DuvalDynamicPrice;
                        }
                        else if ($UkResidentStatus == "NR")
                        {
                            $NonResidentInvestorAmt   = $DuvalDynamicPrice;
                        }
                        else
                        {
                            $UkResidentStatus = "OO";
                            $OwnerOccupier   = $DuvalDynamicPrice;
                        }
                        ?>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <input type="radio" name="UkResidentStatus" id="UkResidentStatus1" value="OO" <?php if($UkResidentStatus =="OO" ) {?> checked <?php } ?>  > 
                                    <label for="UkResidentStatus1">Owner Occupier</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <input type="radio" name="UkResidentStatus" id="UkResidentStatus2" value="RI" <?php if($UkResidentStatus =="RI" ) {?> checked <?php } ?> >
                                    <label for="UkResidentStatus2">Investment or Second Home</label>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <input type="radio" name="UkResidentStatus" id="UkResidentStatus3" value="NR" <?php if($UkResidentStatus =="NR" ) {?> checked <?php } ?> >
                                    <label for="UkResidentStatus3">Non Resident Investment</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-md-6 OwnerOccupier" style='display:none;'>
                                <div class="form-group "  >
                                    <label for="OwnerOccupier">Original Purchase Price <!--Du Val Dynamic Price ™--> <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control OwnerOccupier" style="background: #d0f2cc;" type='text' name='OwnerOccupier' id='OwnerOccupier' rel='calculate' value='<?php echo $OwnerOccupier; ?>'>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 SecondHomeInvestment"  style='display:none;'>
                                <div class="form-group ">
                                    <label for="SecondHomeInvestment">Original Purchase Price<?php //echo $CurrencySym; ?></label>
                                    <input class="form-control" style="background: #d0f2cc;" type='text' name='SecondHomeInvestment' id='SecondHomeInvestment' rel='calculate' value='<?php echo $SecondHomeInvestment; ?>'>
                                    <input type="hidden" name="Resident" id="Resident" value="<?php echo $Resident; ?>" />
                                    <input type="hidden" name="ResidentInvestor" id="ResidentInvestor" value="<?php echo $ResidentInvestor; ?>" />
                                    <input type="hidden" name="NonResidentInvestor" id="NonResidentInvestor" value="<?php echo $NonResidentInvestor; ?>" />
                                    <input type="hidden" name="DuvalDynamicPrice" id="DuvalDynamicPrice" value="<?php echo $DuvalDynamicPrice; ?>" />
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6N onResidentInvestorAmt" style='display:none;'>
                                <div class="form-group ">
                                    <label for="NonResidentInvestorAmt">Du Val Dynamic Price ™ <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control" style="background: #d0f2cc;" type='text' name='NonResidentInvestorAmt' id='NonResidentInvestorAmt' rel='calculate' value='<?php echo $NonResidentInvestorAmt; ?>'>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 NonResidentInvestorAmt" style='display:none;'>
                                <div class="form-group ">
                                    <label for="">Do you have a Personal Tax Allowance?</label>
                                    <?php echo \Html\Elements\InputsClass::plotArrayCombo( "HavePersonalAllowance", "yes_no", $HavePersonalAllowance, "", "class='form-control input-default'"); ?>
                                </div>
                            </div>
                    
                           
                            <?php
                            if ($IsAuGbNz){
                                if(1==2)
                                {
                            ?>
                                <div class="col-xl-3 col-md-6">
                                    <div class="form-group">
                                        <label for="">Original Purchase Price ™ <?php //echo $CurrencySym; ?></label>
                                        <input class="form-control DuvalDynamicPrice" style="background: #d0f2cc;" type='text' <?php echo $ColorChange; ?> name='DuvalDynamicPrice' id='DuvalDynamicPrice' rel='calculate' value='<?php echo $DuvalDynamicPrice; ?>' <?php echo $DuvalPriceReadOnly; ?>>
                                    </div>
                                </div>                            
                            <?php 
                                }
                            ?>
                            <?php
                            }
                            else if(1==2)
                            {
                            ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Original Purchase Price <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control DuvalDynamicPrice" style="background: #d0f2cc;" type='text' <?php echo $ColorChange; ?> name='DuvalDynamicPrice' id='DuvalDynamicPrice' rel='calculate' value='<?php echo number_format($DuvalDynamicPrice); ?>' <?php echo $DuvalPriceReadOnly; ?>>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Estimated Current Value <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control MarketPrice" style="background: #d0f2cc;" type='text' name='MarketPrice' id='MarketPrice' rel='calculate' value='<?php echo number_format($MarketPrice); ?>'>
                                </div>
                            </div> 
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group" <?php echo $HideDate;?>>
                                    <label for="">Purchase Date</label>
                                    <input class="form-control date_picker" style="background: #d0f2cc;" type="text" placeholder="dd/mm/yy" autocomplete='off' name="DateBought" id ="DateBought" value="<?php echo $DateBought; ?>" >
                                </div>
                            </div>
                             <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Existing Gross in County Income (excluding this property) <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control Income" style="background: #d0f2cc;" type='text' name='Income' id='Income' rel='calculate' value='<?php echo $Income; ?>'>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Legal Fees <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control LegalFees" style="background: #d0f2cc;" type='text' name='LegalFees' id='LegalFees' rel='calculate' value='<?php echo $LegalFees; ?>'>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Stamp Duty (paid when purchased) <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control StampDuty" style="background: #d0f2cc;" type='text' name='StampDuty'  id='StampDuty' rel='calculate' value='<?php echo number_format($StampDuty); ?>' >
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Lease Registration <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control LeaseRegistration" style="background: #d0f2cc;" type='text' name='LeaseRegistration' id='LeaseRegistration' rel='calculate' value='<?php echo $LeaseRegistration; ?>'>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Total Purchase Cost <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control TotalPurchaseCost" style="background:#fff;" type='text' name='TotalPurchaseCost' id='TotalPurchaseCost' rel='calculate' value='<?php echo $TotalPurchaseCost; ?>' readonly>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group" style='display:none;'>
                                    <label for="">Completion Date</label>
                                    <input class="form-control date_picker" style="background: #d0f2cc;" type="text" placeholder="dd/mm/yy" autocomplete='off' name="DateCompletion" id ="DateCompletion" value="<?php echo $DateCompletion; ?>" >
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    else
                    {
                        if (!$IsAuGbNz )
                        {
                            ?>
                            <div class="row">
                                <h4>Residential Tax Status</h4>
                                <div class="radio-checks">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="ResidentStatus" id="ResidentStatus1" value="Resident" <?php if($ResidentStatus =="Resident" ) {?> checked <?php } ?> >
                                            Resident
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="ResidentStatus" id="ResidentStatus2" value="NRI" <?php if($ResidentStatus =="NRI" ) {?> checked <?php } ?> >
                                            NRI
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Existing Gross Income (excluding this property) <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control Income" type='text' name='Income' id='Income' rel='calculate' value='<?php echo $Income; ?>'>
                                </div>
                            </div>
                            <?php
                            if ($IsAuGbNz)
                            {
                            ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Estimated Current Value <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control MarketPrice" type='text' name='MarketPrice' id='MarketPrice' rel='calculate' value='<?php echo number_format($MarketPrice); ?>'>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Purchase Price ™ <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control DuvalDynamicPrice" type='text' <?php echo $ColorChange; ?> name='DuvalDynamicPrice' id='DuvalDynamicPrice' rel='calculate' value='<?php echo number_format($DuvalDynamicPrice); ?>' <?php echo $DuvalPriceReadOnly; ?>>
                                </div>
                            </div>
                            <?php
                            }
                            else
                            {
                            ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Purchase Price <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control DuvalDynamicPrice" type='text' <?php echo $ColorChange; ?> name='DuvalDynamicPrice' id='DuvalDynamicPrice' rel='calculate' value='<?php echo number_format($DuvalDynamicPrice); ?>' <?php echo $DuvalPriceReadOnly; ?>>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Stamp Duty (paid when purchased) <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control StampDuty"  type='text' name='StampDuty'  id='StampDuty' rel='calculate' value='<?php echo number_format($StampDuty); ?>' >
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Mortgage Registration <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control MortgageRegistration" type='text' name='MortgageRegistration' id='MortgageRegistration' rel='calculate' value='<?php echo $MortgageRegistration; ?>' >
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Transfer Fee/Lease Registration <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control TransferFees" type='text' name='TransferFees' id='TransferFees' rel='calculate' value='<?php echo $TransferFees; ?>' >
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Legal Fees <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control LegalFees" type='text' name='LegalFees' id='LegalFees' rel='calculate' value='<?php echo $LegalFees; ?>'>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label for="">Total Purchase Cost <?php //echo $CurrencySym; ?></label>
                                    <input class="form-control TotalPurchaseCost" style="background: #d0f2cc;" type='text' name='TotalPurchaseCost' id='TotalPurchaseCost' rel='calculate' value='<?php echo $TotalPurchaseCost; ?>' readonly>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group" <?php echo $HideDate;?>>
                                    <label for="">Purchase Date</label>
                                    <input class="form-control date_picker" type="text" placeholder="dd/mm/yy" autocomplete='off' name="DateBought" id ="DateBought" value="<?php echo $DateBought; ?>" >
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group" style='display:none;'>
                                    <label for="">Completion Date</label>
                                    <input class="form-control date_picker" type="text" placeholder="dd/mm/yy" autocomplete='off' name="DateCompletion" id ="DateCompletion" value="<?php echo $DateCompletion; ?>" >
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <h1 class="hero-title-dark">Mortgage Information
                    <!--<div class="from-group">-->
                    <!--    <label for="crn">Currency</label>-->
                    <!--    <select name="" id="" class="form-control">-->
                    <!--        <option value="s" selected>$ NZD</option>-->
                    <!--        <option value="s">$ UZD</option>-->
                    <!--    </select>-->
                    <!--</div>-->
                </h1>
                <div class="fields-panel">
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label>Original Deposit (%)</label>
                                <input class="form-control LoanAmountPer" style='background: #d0f2cc;' type='text' name='LoanAmountPer' id='LoanAmountPer' rel='calculate'  value='<?php echo $LoanAmountPer; ?>'>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label>Original Mortgage Amount<?php //echo $CurrencySym; ?></label>
                                <input class="form-control Topup" type='text' style='background: #d0f2cc;' name='Topup' id='Topup' rel='calculate' value='<?php echo $Topup; ?>' <?php echo $TopUpReadonly; ?> >
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label>Interest Rate (%)</label>
                                <input class="form-control" type='text' style='background: #d0f2cc;' name='InterestRate' id='InterestRate' rel='calculate' value='<?php echo $InterestRate; ?>'>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label><?php echo ($IsAuGbNz == true) ? "" : "Remaining"; ?>Term (Years)</label>
                                <input class="form-control" type='text' style='background: #d0f2cc;' name='TermYears' id='TermYears' rel='calculate' value='<?php echo $TermYears; ?>'>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <h4>Interest Only/Principal & Interest</h4>
                            <div class="radio-checks">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="IntOrPrincipalInt" id="IntOrPrincipalInt1" value="InterestOnly"  <?php if($IntOrPrincipalInt =="InterestOnly" ) {?> checked <?php } ?> >
                                        Interest Only
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="IntOrPrincipalInt" id="IntOrPrincipalInt2" value="PrinicipalAndInterest" <?php if($IntOrPrincipalInt =="PrinicipalAndInterest" ) {?> checked <?php } ?> >
                                        Principal & Interest
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="hero-title-dark">Rental Information
                    <!--<div class="from-group">-->
                    <!--    <label for="crn">Currency</label>-->
                    <!--    <select name="" id="" class="form-control">-->
                    <!--        <option value="s" selected>$ NZD</option>-->
                    <!--        <option value="s">$ UZD</option>-->
                    <!--    </select>-->
                    <!--</div>-->
                </h1>
                <div class="fields-panel">
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label>Weekly Rental <?php //echo $CurrencySym; ?></label>
                                <input class="form-control WeeklyRental" style='background: #d0f2cc;' type='text' name='WeeklyRental' id='WeeklyRental' rel='calculate' value='<?php echo $WeeklyRental; ?>'>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label>Vacancy Rate (%)</label>
                                <input class="form-control VacancyRate" style='background: #d0f2cc;' type='text' name='VacancyRate' id='VacancyRate' rel='calculate' value='<?php echo $VacancyRate; ?>'>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="hero-title-dark">Expenses
                    <!--<div class="from-group">-->
                    <!--    <label for="crn">Currency</label>-->
                    <!--    <select name="" id="" class="form-control">-->
                    <!--        <option value="s" selected>$ NZD</option>-->
                    <!--        <option value="s">$ UZD</option>-->
                    <!--    </select>-->
                    <!--</div>-->
                </h1>
                <div class="fields-panel">
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label>Letting Fees (%)</label>
                                <input class="form-control LettingFeeRate" style='background: #d0f2cc;' type='text' name='LettingFeeRate' id='LettingFeeRate' rel='calculate' value='<?php echo $LettingFeeRate; ?>'>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label>Management Fees (%)</label>
                                <input class="form-control ManagementFees" style='background: #d0f2cc;' type='text' name='ManagementFees' id='ManagementFees' rel='calculate' value='<?php echo $ManagementFees; ?>'>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label> Council Rates <?php //echo $CurrencySym; ?> (p.a.)</label>
                                <input class="form-control CouncilPropertyTax" style='background: #d0f2cc;' type='text' name='CouncilPropertyTax' id='CouncilPropertyTax' rel='calculate' value='<?php echo $CouncilPropertyTax; ?>'>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <?php if ($countryid == "2") { ?>
                                    <label>Body/Strata Corporate <?php //echo $CurrencySym; ?> (p.a.)</label>
                                <?php } else if ($countryid == "3") { ?>
                                    <label>Service Charge <?php //echo $CurrencySym; ?> (p.a.)</label>
                                <?php } else { ?>
                                    <label>Body Corporate <?php //echo $CurrencySym; ?> (p.a.)</label>
                                <?php  } ?>
                                <input class="form-control CodyCorporateServiceChg" style='background: #d0f2cc;' type='text' name='CodyCorporateServiceChg' id='CodyCorporateServiceChg' rel='calculate' value='<?php echo $CodyCorporateServiceChg; ?>'>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label><?php if($countryid == "3") { echo "Ground Rent"; } else { echo "Land Lease"; } ?> <?php //echo $CurrencySym; ?> (p.a.)</label>
                                <input class="form-control LandLeaseRentPa" style='background: #d0f2cc;' type='text' name='LandLeaseRentPa' id='LandLeaseRentPa' rel='calculate' value='<?php echo $LandLeaseRentPa; ?>'>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label>Insurance <?php //echo $CurrencySym; ?>(p.a.)</label>
                                <input class="form-control InsurancePa" style='background: #d0f2cc;' type='text' name='InsurancePa' id='InsurancePa' rel='calculate' value='<?php echo $InsurancePa; ?>'>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label>Repairs and Maintenance (%)</label>
                                <input class="form-control RepairandMaintenance" style='background: #d0f2cc;' type='text' name='RepairandMaintenance' id='RepairandMaintenance' rel='calculate' value='<?php echo $RepairandMaintenance; ?>'>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label>Cleaning <?php //echo $CurrencySym; ?> (per month)</label>
                                <input class="form-control CleaningPerMonth" style='background: #d0f2cc;' type='text' name='CleaningPerMonth' id='CleaningPerMonth' rel='calculate' value='<?php echo $CleaningPerMonth; ?>'>
                            </div> 
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label>Gardening <?php //echo $CurrencySym; ?> (per month)</label>
                                <input class="form-control GardeningPerMonth" style='background: #d0f2cc;' type='text' name='GardeningPerMonth' id='GardeningPerMonth' rel='calculate' value='<?php echo $GardeningPerMonth; ?>'>
                            </div>  
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label>Service Contract <?php //echo $CurrencySym; ?> (p.a.)</label>
                                <input class="form-control ServiceContractsPa" style='background: #d0f2cc;' type='text' name='ServiceContractsPa' id='ServiceContractsPa' rel='calculate' value='<?php echo $ServiceContractsPa; ?>'>
                            </div>  
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label>Other <?php //echo $CurrencySym; ?>  (p.a.)</label>
                                <input class="form-control Other" type='text' style='background: #d0f2cc;' name='Other' id='Other' rel='calculate' value='<?php echo $Other; ?>'>
                            </div> 
                        </div>
                    </div>
                </div>
                <!--<h1 class="hero-title-dark">Mortgage Information-->
                    <!--<div class="from-group">-->
                    <!--    <label for="crn">Currency</label>-->
                    <!--    <select name="" id="" class="form-control">-->
                    <!--        <option value="s" selected>$ NZD</option>-->
                    <!--        <option value="s">$ UZD</option>-->
                    <!--    </select>-->
                    <!--</div>-->
                <!--</h1>-->
                <div class="fields-panel" style='display:none;'>
                    <div class="row" >
                        <div class="col-xl-3 col-md-6" >
                            <div class="form-group">
                                <label>LTV (%)</label>
                                <input class="form-control" type='text' name='LTV' id='LTV' rel='calculate' value='<?php echo $LTV; ?>' <?php echo ($IsAuGbNz == true) ? "readonly" : ""; ?> />
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label><?php echo ($IsAuGbNz == true) ? "Initial" : "Remaining"; ?> Loan Amount <?php //echo $CurrencySym; ?></label>
                                <input class="form-control InitialLoanAmt" type='text' name='InitialLoanAmt' id='InitialLoanAmt' rel='calculate' value='<?php echo $InitialLoanAmt; ?>' <?php echo ($IsAuGbNz == true) ? "readonly" : ""; ?> />
                            </div>
                        </div>
                        
                    </div>
                </div>
                <h1 class="hero-title-dark">Growth Factors
                    <!--<div class="from-group">-->
                    <!--    <label for="crn">Currency</label>-->
                    <!--    <select name="" id="" class="form-control">-->
                    <!--        <option value="s" selected>$ NZD</option>-->
                    <!--        <option value="s">$ UZD</option>-->
                    <!--    </select>-->
                    <!--</div>-->
                </h1>
                <div class="fields-panel">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>CPI (%)</label>
                                <input class="form-control CPI" style='background: #d0f2cc;' type='text' name='CPI' id='CPI' rel='calculate' value='<?php echo $CPI; ?>'>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Rental Growth (%)</label>
                                <input class="form-control RentalGrowth" style='background: #d0f2cc;' type='text' name='RentalGrowth' id='RentalGrowth' rel='calculate' value='<?php echo $RentalGrowth; ?>'>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Capital Growth (%)</label>
                                <input class="form-control CapitalGrowth" style='background: #d0f2cc;' type='text' name='CapitalGrowth' id='CapitalGrowth' rel='calculate' value='<?php echo $CapitalGrowth; ?>'>
                            </div>
                        </div>
                    </div>
                <h1 class="hero-title-dark" <?php echo $hideDep; ?>>Depreciation
                    <!--<div class="from-group">-->
                    <!--    <label for="crn">Currency</label>-->
                    <!--    <select name="" id="" class="form-control">-->
                    <!--        <option value="s" selected>$ NZD</option>-->
                    <!--        <option value="s">$ UZD</option>-->
                    <!--    </select>-->
                    <!--</div>-->
                </h1>
                <div class="fields-panel" <?php echo $hideDep; ?>>
                    <div class="row">
                        <?php if ($countryid == "2"){ ?>
                        <div class="form-group col-md-3">
                            <label>Building Value <?php //echo $CurrencySym; ?></label>
                            <input class="form-control BuildingValue" style='background: #d0f2cc;'  type='text' name='BuildingValue' id='BuildingValue' rel='calculate' value='<?php echo $BuildingValue; ?>'>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Remaining Useful Life (Years)</label>
                            <input class="form-control" type='text' style='background: #d0f2cc;'  name='BuildingLife' id='BuildingLife' rel='calculate' value='<?php echo $BuildingLife; ?>'>
                        </div>
                        <div class="form-group col-md-6"></div>
                        <?php } ?>
                        <div class="form-group col-md-3">
                            <label>Fixtures Value <?php //echo $CurrencySym; ?></label>
                            <input class="form-control FixturesValue" style='background: #d0f2cc;'  type='text' name='FixturesValue' id='FixturesValue' rel='calculate' value='<?php echo $FixturesValue; ?>'>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Remaining Useful Life (Years)</label>
                            <input class="form-control" type='text' style='background: #d0f2cc;'  name='FixturesLife' id='FixturesLife' rel='calculate' value='<?php echo $FixturesLife; ?>'>
                        </div>
                        <div class="form-group col-md-6"></div>
                        <div class="form-group col-md-3">
                            <label>Furniture Value <?php //echo $CurrencySym; ?></label>
                            <input class="form-control FurnitureValue" style='background: #d0f2cc;'  type='text' name='FurnitureValue' id='FurnitureValue' rel='calculate' value='<?php echo $FurnitureValue; ?>'>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Remaining Useful Life (Years)</label>
                            <input class="form-control" type='text' style='background: #d0f2cc;'  name='FurnitureLife' id='FurnitureLife' rel='calculate' value='<?php echo $FurnitureLife; ?>'>
                        </div>
                        <div class="form-group col-md-6"></div>
                    </div>
                </div>
                <div class="text-panel">
                    <button class="btn btn-orange ml-auto">Finish</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?php echo SITE_BASE_URL; ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>
<script type="text/javascript" >
      $(document).ready(function(){
   
          $('.analysis-form input[type=text]').on('keyup', function(){
               $(this).css("color","black");
           });
                   
             $('.date_picker').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
  
   });
   
   $(document).on("keyup blur", "input[numeric='true']:enabled:not([readonly])", function (e) {
   
   
   
       //JS_NumberChk(this);
   
   
   
   });
   
   
   //UkResidentStatus
   
   $(document).on('change','input[name=UkResidentStatus]',function(e){
       
       UkResidentStatusFn();
      
   });
   
   
   var UkResidentStatusFn = function(){
       
       
       var UkResidentStatus = $("input[name='UkResidentStatus']:checked").val();
       
       //alert("UkResidentStatus="+UkResidentStatus);
       
        if (UkResidentStatus == "OO"){
            $(".OwnerOccupier").show();
            $(".SecondHomeInvestment").hide();
            $(".NonResidentInvestorAmt").hide();
            
            $("#SecondHomeInvestment").val("");
            $("#Resident").val("");
            $("#ResidentInvestor").val("");
            $("#NonResidentInvestor").val("");
            
            $("#NonResidentInvestorAmt").val("");
            $("#HavePersonalAllowance").val("NO");
            
            
            
        }
        else if (UkResidentStatus == "RI"){
            $(".OwnerOccupier").hide();
            $(".SecondHomeInvestment").show();
            $(".NonResidentInvestorAmt").hide();
            
            
            $("#OwnerOccupier").val("");
            $("#NonResidentInvestorAmt").val("");
            $("#HavePersonalAllowance").val("NO");
            
        }
        else if (UkResidentStatus == "NR"){
            $(".OwnerOccupier").hide();
            $(".SecondHomeInvestment").hide();
            $(".NonResidentInvestorAmt").show();
            
            $("#OwnerOccupier").val("");
            $("#SecondHomeInvestment").val("");
            $("#Resident").val("");
            $("#ResidentInvestor").val("");
            $("#NonResidentInvestor").val("");
            
            
        }
       
       CalcFn(); 
       
   }
   
   
    var FnNulltoAmt = function(Value){
        
        if (Value == undefined)
            Value = "";
            
        Value = Value.replace(/,/g, "");
   
        if (isNaN(parseFloat(Value)))
   
            Value = 0;
   
            
   
        return parseFloat(Value);
   
    };
   
    
   
    var FnCheckNull = function(Value){
   
        if (Value == undefined)
   
            Value = "";
   
            
   
        return Value;
   
    };
   
    
   
    
   
   var GetPostDatasFn = function(){
   
    datavalues          = $(".analysis-form").serialize();
    return datavalues;
   
   }; 
   
    
   
      
   
   $(document).ready(function(){

            function formatNumber (num) {
                return  num.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
            }
            $(".MarketPrice").on("change", function(event) {
                 $(".MarketPrice").val(formatNumber($(".MarketPrice").val()));
            });  
            $(".Income").on("change", function(event) {
                  $(".Income").val(formatNumber($(".Income").val()));
             });  
             $(".DuvalDynamicPrice").on("change", function(event) {
                  $(".DuvalDynamicPrice").val(formatNumber($(".DuvalDynamicPrice").val()));
             });  
             $(".LegalFees").on("change", function(event) {
                  $(".LegalFees").val(formatNumber($(".LegalFees").val()));
             });  
             $(".StampDuty").on("change", function(event) {
                  $(".StampDuty").val(formatNumber($(".StampDuty").val()));
             }); 

             $(".ResetrvationFees").on("change", function(event) {
                  $(".ResetrvationFees").val(formatNumber($(".ResetrvationFees").val()));
             }); 

             $(".StagePay1Per").on("change", function(event) {
                  $(".StagePay1Per").val(formatNumber($(".StagePay1Per").val()));
             }); 
             $(".StagePay2Per").on("change", function(event) {
                  $(".StagePay2Per").val(formatNumber($(".StagePay2Per").val()));
             }); 
             $(".InitialLoanAmt").on("change", function(event) {
                  $(".InitialLoanAmt").val(formatNumber($(".InitialLoanAmt").val()));
             }); 

             $(".ManagementFees").on("change", function(event) {
                  $(".ManagementFees").val(formatNumber($(".ManagementFees").val()));
             }); 
             $(".InsurancePa").on("change", function(event) {
                  $(".InsurancePa").val(formatNumber($(".InsurancePa").val()));
             }); 
             $(".ManagementFees").on("change", function(event) {
                  $(".ManagementFees").val(formatNumber($(".ManagementFees").val()));
             }); 
             $(".CodyCorporateServiceChg").on("change", function(event) {
                  $(".CodyCorporateServiceChg").val(formatNumber($(".CodyCorporateServiceChg").val()));
             }); 
             $(".CleaningPerMonth").on("change", function(event) {
                  $(".CleaningPerMonth").val(formatNumber($(".CleaningPerMonth").val()));
             }); 
             $(".GardeningPerMonth").on("change", function(event) {
                  $(".GardeningPerMonth").val(formatNumber($(".GardeningPerMonth").val()));
             }); 

             $(".Other").on("change", function(event) {
                  $(".Other").val(formatNumber($(".Other").val()));
             });
             
             $(".WeeklyRental").on("change", function(event) {
                  $(".WeeklyRental").val(formatNumber($(".WeeklyRental").val()));
             }); 
             $(".VacancyRate").on("change", function(event) {
                  $(".VacancyRate").val(formatNumber($(".VacancyRate").val()));
             }); 
             $(".LettingFeeRate").on("change", function(event) {
                  $(".LettingFeeRate").val(formatNumber($(".LettingFeeRate").val()));
             }); 

             $(".FurnitureValue").on("change", function(event) {
                  $(".FurnitureValue").val(formatNumber($(".FurnitureValue").val()));
             }); 
              
             $(".ServiceContractsPa").on("change", function(event) {
                  $(".ServiceContractsPa").val(formatNumber($(".ServiceContractsPa").val()));
             }); 
             $(".BuildingValue").on("change", function(event) {
                  $(".BuildingValue").val(formatNumber($(".BuildingValue").val()));
             }); 
             $(".FixturesValue").on("change", function(event) {
                  $(".FixturesValue").val(formatNumber($(".FixturesValue").val()));
             }); 
             $(".CouncilPropertyTax").on("change", function(event) {
                  $(".CouncilPropertyTax").val(formatNumber($(".CouncilPropertyTax").val()));
             }); 
             $(".LandLeaseRentPa").on("change", function(event) {
                  $(".LandLeaseRentPa").val(formatNumber($(".LandLeaseRentPa").val()));
             }); 
             $(".RepairandMaintenance").on("change", function(event) {
                  $(".RepairandMaintenance").val(formatNumber($(".RepairandMaintenance").val()));
             }); 
             $(".CPI").on("change", function(event) {
                  $(".CPI").val(formatNumber($(".CPI").val()));
             }); 
             $(".RentalGrowth").on("change", function(event) {
                  $(".RentalGrowth").val(formatNumber($(".RentalGrowth").val()));
             }); 
             $(".CapitalGrowth").on("change", function(event) {
                  $(".CapitalGrowth").val(formatNumber($(".CapitalGrowth").val()));
             }); 
             
            $("#OwnerOccupier").on("change", function(event) {
                $("#OwnerOccupier").val(formatNumber($("#OwnerOccupier").val()));
            }); 
            $("#SecondHomeInvestment").on("change", function(event) {
                $("#SecondHomeInvestment").val(formatNumber($("#SecondHomeInvestment").val()));
            }); 
            $("#NonResidentInvestorAmt").on("change", function(event) {
                $("#NonResidentInvestorAmt").val(formatNumber($("#NonResidentInvestorAmt").val()));
            }); 
             $("#AUDynamicPrice").on("change", function(event) {
                $("#AUDynamicPrice").val(formatNumber($("#AUDynamicPrice").val()));
            }); 
            
            
            //OwnerOccupier,SecondHomeInvestment,NonResidentInvestorAmt
             
        <?php 
          if ($countryid == "3"){
          
              echo "UkResidentStatusFn(); ";     
          
          }
          
        ?>
             
        

       CalcFn(); 
   
        $(document).on("blur change", "[rel='calculate']", function(){
            
            CalcFn();
       
        });
        
        
         $(document).on("keyup change", "#LoanAmountPer", function(){
       
           LoanAmountPer  = FnNulltoAmt($("#LoanAmountPer").val());
           
           if(parseFloat(LoanAmountPer) > 100 ){
               
               $("#LoanAmountPer").val("");
           }
       
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
       
       
   
   });
   
   
   
   
   
   var AddToMyPortfolioFn = function(){
   
    pass_data       = GetPostDatasFn(); 
   
        
   
    $.ajax({
   
   type: "POST",
   
   url:"<?php echo SITE_BASE_URL;?>ajax/SaveAnalyzer.html",
   
   data: pass_data
   
   }).done(function( data ) {
   
   //alert(data)
   
            //Obj.html(data);
           // alert(data);
            
            if( parseFloat(data) < 0 ){
                
                
                 alert("Error on Save.."); 
            }else{
                
                 if( parseFloat(data) > 0 )
                    $("#RecentAnalysisCnt").html(data);
                    
                    
                  alert("Saved Successfully."); 
                  
                  
                  
                  
                    
            }
   
           
   
        });
   
   };
   
   
   
   
   
   var GetGBResidentValueFn = function( FnValue ){
   
   ResidentRet               = 0;
   
   
   
   if (FnValue > 125000)
   
    ResidentRet             = ResidentRet + ((FnValue-125000) * 0.02);
   
    
   
   if (FnValue > 250000)
   
    ResidentRet             = ResidentRet + ((FnValue-250000) * 0.03);
   
    
   
   if (FnValue > 925000)
   
    ResidentRet             = ResidentRet + ((FnValue-925000) * 0.05);
   
    
   
   if (FnValue > 1500000)
   
    ResidentRet             = ResidentRet + ((FnValue-1500000) * 0.02);
   
    
   
    
   
   return parseFloat(ResidentRet); 
   
   };
   
   
   
   var GetGBnONResidentValueFn = function( FnValue ){
   
    //=SUMPRODUCT(--(B14>{125000;250000;925000;1500000}),(B14-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})+(B14*0.05)
   
   ResidentRet               = 0;
   
   
   
   if (FnValue > 125000)
   
    ResidentRet             = ResidentRet + ((FnValue-125000) * 0.02);
   
    
   
   if (FnValue > 250000)
   
    ResidentRet             = ResidentRet + ((FnValue-250000) * 0.03);
   
    
   
   if (FnValue > 925000)
   
    ResidentRet             = ResidentRet + ((FnValue-925000) * 0.05);
   
    
   
   if (FnValue > 1500000)
   
    ResidentRet             = ResidentRet + ((FnValue-1500000) * 0.02);
   
    
   
    
   
   return parseFloat(ResidentRet); 
   
   };
   
   
   
   
   
   var GetGBLandLeaseRegisterAmt = function(FnValue){
   
    //=IF(C2>=1000000,910, IF(C2>=500000,540, IF(C2>=200000,270, IF(C2>=100000,190, IF(C2>1,190)))))
   
    RegisterAmt             = 0;
   
    
   
    if (FnValue >= 1000000)
   
        RegisterAmt         = 910;
   
    else if(FnValue >= 500000)
   
        RegisterAmt         = 540;
   
    else if(FnValue >= 200000)
   
        RegisterAmt         = 270;
   
    else if(FnValue > 1)
   
        RegisterAmt         = 190;
   
        
   
    return parseFloat(RegisterAmt); 
   
   }; 
   
   
   
   var GBCalcFn = function(){
   
       OwnerOccupier             = FnNulltoAmt( $("#OwnerOccupier").val() ); 
       
       SecondHomeInvestment      = FnNulltoAmt( $("#SecondHomeInvestment").val() ); 
       
       NonResidentInvestorAmt    = FnNulltoAmt( $("#NonResidentInvestorAmt").val() ); 
       
       //alert(OwnerOccupier);
       
       ForeignInvestor           = 0 //Not used in excel
       
       
       
       ObjDuvalDynamicPrice      = $("#DuvalDynamicPrice"); 
       
       ObjResident               = $("#Resident");
       
       ObjResidentInvestor       = $("#ResidentInvestor");
       
       ObjNonResidentInvestor    = $("#NonResidentInvestor");
       
       ObjStampDuty              = $("#StampDuty");
       
       ObjLeaseRegistration      = $("#LeaseRegistration");
       
       
       
       
       
       DuvalDynamicPrice         = OwnerOccupier + SecondHomeInvestment + NonResidentInvestorAmt;
       
       $("#DuvalDynamicPrice").val(Math.round(DuvalDynamicPrice).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ","));
       
       
       
       //Resident (Row 15) =SUMPRODUCT(--(C14>{125000;250000;925000;1500000}),(C14-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})    //C14 is Owner Occupier..
       
       Resident                  = GetGBResidentValueFn(OwnerOccupier);
       
       ObjResident.val(Math.round(Resident).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")); 
       
       
       
       //Resident Investor (Row 16) =SUMPRODUCT(--(C15>{125000;250000;925000;1500000}),(C15-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})+(C15*0.03)    //C15 is Investment or Second Home
       
       ResidentInvestor          = GetGBResidentValueFn(SecondHomeInvestment) + (SecondHomeInvestment * 0.03) ; 
       ObjResidentInvestor.val(Math.round(ResidentInvestor).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ","));
       
       
       //Resident Investor (Row 16) =SUMPRODUCT(--(C15>{125000;250000;925000;1500000}),(C15-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})+(C15*0.03)    //C15 is Investment or Second Home
       
       NonResidentInvestor       = GetGBResidentValueFn(NonResidentInvestorAmt) + (NonResidentInvestorAmt * 0.05) ; 
       ObjNonResidentInvestor.val(Math.round(NonResidentInvestor).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ","));
       
       
       
       //Stamp Duty =SUM(C4:C6) => Resident + ResidentInvestor + ForeignInvestor
       
       StampDuty                 = Resident + ResidentInvestor + NonResidentInvestor;
       
       //ObjStampDuty.val( Math.round(StampDuty).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") );
       
       
       
       LeaseRegistration         = GetGBLandLeaseRegisterAmt(DuvalDynamicPrice);
       ObjLeaseRegistration.val(Math.round(LeaseRegistration).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ","));
       
   };
   
   
   
   
   
   var AuCalcFn = function(){
   
    AuLocation                  =  $("#AuLocation").val() ; 
   
    AUDynamicPrice              = FnNulltoAmt( $("#AUDynamicPrice").val() ); 
    
    AUDynamicPrice              = FnNulltoAmt( $("#AUDynamicPrice").val() ); 
   
    ResidentStatus               = FnCheckNull($("input[name='ResidentStatus']:checked").val());
    //alert(ResidentStatus);
    //console.log('ResidentStatus='+ResidentStatus);
   
    ForeignInvestor             = 0 //Not used in excel
   
    
   
    ObjDuvalDynamicPrice        = $("#DuvalDynamicPrice"); 
   
    ObjResident                 = $("#Resident");
   
    ObjLandTransfer             = $("#LandTransfer");
   
    ObjStampDuty                = $("#StampDuty");
   
    ObjMortgageRegistration     = $("#MortgageRegistration");
   
    
   
    Resident                    = 0; 
   
    MortgageReg                 = 0;
   
    LandTransfer                = 0;
   
    
   
    //console.log("AuLocation=" + AuLocation)
   
    
   
    if (AuLocation == "ACT"){
   
              /*
           
              ROUND(
           
              IF(C13>1455000, (ROUNDUP((C13-1455000)/100,0)*4.54),
           
              IF(C13 > 1000000, (ROUNDUP((C13-100000)/100,0)*6.4) + 36950,
           
              IF(C13 > 750000,  (ROUNDUP((C13-750000)/100,0)*5.9) + 22200,
           
              IF(C13 > 500000,  (ROUNDUP((C13-500000)/100,0)*4.32) + 11400,
           
              IF(C13 > 300000,  (ROUNDUP((C13-300000)/100,0)*3.4) + 4600,
           
              IF(C13 > 200000,  (ROUNDUP((C13-200000)/100,0)*2.2) + 2400,
           
              IF(C13 <200000, (ROUNDUP((C13)/100,0)*1.2) ))))))),)
           
              */
           
      
   
                  if (AUDynamicPrice > 1455000){
               
                      Resident          = Math.round( Math.ceil((AUDynamicPrice - 1455000) / 100) * 4.54); 
               
                  }
               
                  else if(AUDynamicPrice > 1000000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 100000) / 100) * 6.4) ) + 36950; 
               
                  }
               
                  else if(AUDynamicPrice > 750000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 750000) / 100) * 5.9) ) + 22200; 
               
                  }
               
                  else if(AUDynamicPrice > 500000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 500000) / 100) * 4.32) ) + 11400; 
               
                  }
               
                  else if(AUDynamicPrice > 300000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 300000) / 100) * 3.4) ) + 4600; 
               
                  }
               
                  else if(AUDynamicPrice > 200000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 200000) / 100) * 2.2) ) + 2400; 
               
                  }
               
                  else{
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice ) / 100) * 1.2) ) ; 
               
                  }
   
      
               
                  if (AUDynamicPrice > 1){
               
                    MortgageReg          = 153; 
               
                    LandTransfer         = 409; 
               
                  }
               
      
   
    }else if(AuLocation == "NSW"){
   
                /*
				Resident:

                =ROUND(
           
                        IF(D13>3040000, (ROUNDUP((D13-3040000)/100,0)*7)+152505,
           
                        IF(D13 > 1013000, (ROUNDUP((D13-1013000)/100,0)*5.5) + 41017,
           
                        IF(D13 > 304000,  (ROUNDUP((D13-304000)/100,0)*4.5) + 9112,
           
                        IF(D13 > 81000,  (ROUNDUP((D13-81000)/100,0)*3.5) + 1307,
           
                        IF(D13 > 30000,  (ROUNDUP((D13-30000)/100,0)*1.75) + 415,
           
                        IF(D13 > 14000,  (ROUNDUP((D13-14000)/100,0)*1.5) + 175,
           
                        IF(D13 <14000, (ROUNDUP((D13)/100,0)*1.25) ))))))),)


				NRI: 

				=ROUND(
						IF(D13>=3040000,(ROUNDUP((D13-3040000)/100,0)*7)+152505,
						IF(D13>=1013000,(ROUNDUP((D13-1013000)/100,0)*5.5)+41017,
						IF(D13>=304000,(ROUNDUP((D13-304000)/100,0)*4.5)+9112,
						IF(D13>=81000,(ROUNDUP((D13-81000)/100,0)*3.5)+1307,
						IF(D13>=30000,(ROUNDUP((D13-30000)/100,0)*1.75)+415,
						IF(D13>=14000,(ROUNDUP((D13-14000)/100,0)*1.5)+175,
						IF(D13<=14000,(ROUNDUP((D13)/100,0)*1.25)))))))),)+(D13*0.08)
           
                */
   
   
   
				if (AUDynamicPrice > 3040000){
				  Resident          = Math.round( Math.ceil((AUDynamicPrice - 3040000) / 100) * 7) + 152505; 
				}
				else if(AUDynamicPrice > 1013000){
				  Resident          = Math.round( (Math.ceil((AUDynamicPrice - 1013000) / 100) * 5.5) ) + 41017; 
				}
				else if(AUDynamicPrice > 304000){
				  Resident          = Math.round( (Math.ceil((AUDynamicPrice - 304000) / 100) * 4.5) ) + 9112; 
				}
				else if(AUDynamicPrice > 81000){
				  Resident          = Math.round( (Math.ceil((AUDynamicPrice - 81000) / 100) * 3.5) ) + 1307; 
				}
				else if(AUDynamicPrice > 30000){
				  Resident          = Math.round( (Math.ceil((AUDynamicPrice - 30000) / 100) * 1.75) ) + 415; 
				}
				else if(AUDynamicPrice > 14000){
				  Resident          = Math.round( (Math.ceil((AUDynamicPrice - 14000) / 100) * 1.5) ) + 175; 
				}
				else{
				  Resident          = Math.round( (Math.ceil((AUDynamicPrice ) / 100) * 1.25) ) ; 
				}

				//NRI Handling...
				if (ResidentStatus == "NRI"){
					Resident		= parseFloat(Resident) + (AUDynamicPrice*0.08); 
				}
   
      
           
              if (AUDynamicPrice > 1){
           
                MortgageReg          = 143.50; 
           
                LandTransfer         = 143.50; 
           
              }
           
      
   
      
   
    }else if(AuLocation == "NT"){
   
            /*
				  //Resident: 

                  =ROUND(
       
                  IF(E13 >= 5000000,  0.0495   * (E13),
       
                  IF(E13 >= 3000000, 0.0575  * (E13),
       
                  IF(E13 >= 525000, 0.0495  * (E13),
       
                  IF(E13 <= 525000,  (0.06571441*(E13/1000)*(E13/1000)) + 15  * (E13 / 1000),
       
                  )))),)


				  //NRI
				  =ROUND(
					  IF(E13 >= 5000000,  0.0595   * (E13),
					  IF(E13 >=3000000, 0.0575  * (E13),
					  IF(E13 >=525000, 0.0495  * (E13),
					  IF(E13 <= 525000,  (0.06571441*(E13/1000)*(E13/1000)) + 15  * (E13 / 1000),
					  )))),)
       
            */
   
   
   
              if (AUDynamicPrice >= 5000000){
				  if (ResidentStatus == "NRI"){	//NRI Handling...
					  MultiplyVal	= 0.0495
				  }
				  else{
					  MultiplyVal	= 0.0595
				  }
                  Resident          = Math.round( parseFloat(MultiplyVal)  * Math.ceil(AUDynamicPrice)); 
           
              }
           
              else if(AUDynamicPrice >= 3000000){
           
                  Resident          = Math.round( 0.0575  * Math.ceil(AUDynamicPrice)); 
           
              }
           
              else if(AUDynamicPrice >= 525000){
           
                  Resident          = Math.round( 0.0495  * Math.ceil(AUDynamicPrice)); 
           
              }
           
              else if(AUDynamicPrice <= 525000 ){
           
                  Resident          = Math.round((0.06571441 * (Math.ceil(AUDynamicPrice)/1000) * (Math.ceil(AUDynamicPrice)/1000) ) + (15 * (Math.ceil(AUDynamicPrice)/1000))); 
           
              }
   
      
   
               if (AUDynamicPrice > 1){
           
                MortgageReg          = 149; 
           
                LandTransfer         = 149; 
           
              }
           
      
   
   
   
    }else if(AuLocation == "QLD"){
   
        /*
		Resident : 

		=ROUND(
   
              IF(F13 > 1000000, (ROUNDUP((F13-1000000)/100,0)*5.75) + 38025,
   
              IF(F13 > 540000,  (ROUNDUP((F13-540000)/100,0)*4.5) + 17325,
   
              IF(F13 > 75000,  (ROUNDUP((F13-75000)/100,0)*3.5) + 1050,
   
              IF(F13 > 5000,  (ROUNDUP((F13-5000)/100,0)*1.5),
   
              IF(F13 <5000, 0))))),)
		

		NRI:
		=ROUND(
	  IF(F13 >= 1000000, (ROUNDUP((F13-1000000)/100,0)*5.75) + 38025,
	  IF(F13 >= 540000,  (ROUNDUP((F13-540000)/100,0)*4.5) + 17325,
	  IF(F13 >= 75000,  (ROUNDUP((F13-75000)/100,0)*3.5) + 1050,
	  IF(F13 >= 5000,  (ROUNDUP((F13-5000)/100,0)*1.5),
	  IF(F13 <=5000, 0))))),)+(F13*0.07)
        */
   
   
   
                   if (AUDynamicPrice > 1000000){
               
                      Resident          = Math.round( Math.ceil((AUDynamicPrice - 1000000) / 100) * 5.75) + 38025; 
               
                  }
               
                  else if(AUDynamicPrice > 540000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 540000) / 100) * 4.5) ) + 17325; 
               
                  }
               
                  else if(AUDynamicPrice > 75000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 75000) / 100) * 3.5) ) + 1050; 
               
                  }
               
                  else if(AUDynamicPrice > 5000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 5000) / 100) * 1.5) ); 
               
                  }
               
                  else if(AUDynamicPrice < 5000){
               
                      Resident          = 0 ; 
               
                  }


				  if (ResidentStatus == "NRI"){	//NRI Handling...
					  Resident			= parseFloat(Resident) + (parseFloat(AUDynamicPrice) * 0.07);
				  }
   
      
   
                  if (AUDynamicPrice > 1){
               
                    MortgageReg          = 192; 
               
                    LandTransfer         = Math.round( (Math.ceil((AUDynamicPrice - 180000) / 10000) * 36) ) + 192; 
                  }
       
        
   
        
   
        //console.log((AUDynamicPrice - 180000) / 10000);
   
        //alert((AUDynamicPrice - 180000) / 10000));
   
       // =IF(F2>0,(((((ROUNDUP((B17-180000)/10000,0))*36)+192))))
   
       
   
      }else if(AuLocation == "SA"){
   
        /*Resident:
			=ROUND(
   
              IF(G13>500000, (ROUNDUP((G13-500000)/100,0)*5.5)+21330,
   
              IF(G13 > 300000, (ROUNDUP((G13-300000)/100,0)*5) + 11330,
   
              IF(G13 > 250000,  (ROUNDUP((G13-250000)/100,0)*4.75) + 8955,
   
              IF(G13 > 200000,  (ROUNDUP((G13-200000)/100,0)*4.25) + 6830,
   
              IF(G13 > 100000,  (ROUNDUP((G13-100000)/100,0)*4) + 2830,
   
              IF(G13 > 50000,  (ROUNDUP((G13-50000)/100,0)*3.5) + 1080,
   
              IF(G13 > 30000,  (ROUNDUP((G13-30000)/100,0)*3) + 480,
   
             IF(G13 > 12000,  (ROUNDUP((G13-12000)/100,0)*2) + 120,
   
              IF(G13 <12000, (ROUNDUP((G13)/100,0)*1) ))))))))),)
		

		NRI:
		=ROUND(
			  IF(G13>500000, (ROUNDUP((G13-500000)/100,0)*5.5)+21330,
			  IF(G13 > 300000, (ROUNDUP((G13-300000)/100,0)*5) + 11330,
			  IF(G13 > 250000,  (ROUNDUP((G13-250000)/100,0)*4.75) + 8955,
			  IF(G13 > 200000,  (ROUNDUP((G13-200000)/100,0)*4.25) + 6830,
			  IF(G13 > 100000,  (ROUNDUP((G13-100000)/100,0)*4) + 2830,
			  IF(G13 > 50000,  (ROUNDUP((G13-50000)/100,0)*3.5) + 1080,
			  IF(G13 > 30000,  (ROUNDUP((G13-30000)/100,0)*3) + 480,
			 IF(G13 > 12000,  (ROUNDUP((G13-12000)/100,0)*2) + 120,
			  IF(G13 <12000, (ROUNDUP((G13)/100,0)*1) ))))))))),)+(G13*0.07)
        */
   
   
               
                  if (AUDynamicPrice > 500000){
               
                      Resident          = Math.round( Math.ceil((AUDynamicPrice - 500000) / 100) * 5.5) + 21330; 
               
                  }
               
                  else if(AUDynamicPrice > 300000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 300000) / 100) * 5) ) + 11330; 
               
                  }
               
                  else if(AUDynamicPrice > 250000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 250000) / 100) * 4.75) ) + 8955; 
               
                  }
               
                  else if(AUDynamicPrice > 200000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 200000) / 100) * 4.25) ) + 6830; 
               
                  }
               
                  else if(AUDynamicPrice > 100000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 100000) / 100) * 4) ) + 2830; 
               
                  }
               
                  else if(AUDynamicPrice > 50000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 50000) / 100) * 3.5) ) + 1080; 
               
                  }
               
                  else if(AUDynamicPrice > 30000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 30000) / 100) * 3) ) + 480; 
               
                  }
               
                   else if(AUDynamicPrice > 12000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice - 12000) / 100) * 2) ) + 120; 
               
                  }
               
                  else if(AUDynamicPrice < 12000){
               
                      Resident          = Math.round( (Math.ceil((AUDynamicPrice) / 100) * 1) ) ; 
               
                  }


				  if (ResidentStatus == "NRI"){	//NRI Handling...
					  Resident			= parseFloat(Resident) + (parseFloat(AUDynamicPrice) * 0.07);
				  }
   
      
   
                if (AUDynamicPrice > 1){
               
                    MortgageReg          = 170; 

                    if (AUDynamicPrice > 50000){
               
                        LandTransfer          = Math.round( Math.ceil((AUDynamicPrice - 50000) / 10000) * 86.5) + 293; 
               
                    }
               
                    else if(AUDynamicPrice > 40000){
               
                         LandTransfer          = 293; 
               
                    }
               
                    else if(AUDynamicPrice > 20000){
               
                         LandTransfer          = 208; 
               
                    }
               
                    else if(AUDynamicPrice > 5000){
               
                         LandTransfer          = 190; 
               
                    }
               
                    else if(AUDynamicPrice > 1){
               
                         LandTransfer          = 170; 
               
                    }else{
               
                        LandTransfer          = 0; 
               
                        
               
                    }
               
                }
   
        
   
        //console.log((AUDynamicPrice - 180000) / 10000);
   
        //alert((AUDynamicPrice - 180000) / 10000));
   
       // =IF(F2>0,(((((ROUNDUP((B17-180000)/10000,0))*36)+192))))
   
       
   
      }else if(AuLocation == "TAS"){
   
                /*=ROUND(
           
                  IF(H13>725000, (ROUNDUP((H13-725000)/100,0)*4.5)+27810,
           
                  IF(H13 > 375000, (ROUNDUP((H13-375000)/100,0)*4.25) + 12935,
           
                  IF(H13 > 200000,  (ROUNDUP((H13-200000)/100,0)*4) + 5935,
           
                  IF(H13 > 75000,  (ROUNDUP((H13-75000)/100,0)*3.5) + 1560,
           
                  IF(H13 > 25000,  (ROUNDUP((H13-25000)/100,0)*2.25) + 435,
           
                  IF(H13 > 3000,  (ROUNDUP((H13-3000)/100,0)*1.75) + 50,
           
                  IF(H13 >1, (50) ))))))),)




				  =ROUND(
					IF(H13>=725000,(ROUNDUP((H13-725000)/100,0)*4.5)+27810,
					IF(H13>375000,(ROUNDUP((H13-375000)/100,0)*4.25)+12935,
					IF(H13>=200000,(ROUNDUP((H13-200000)/100,0)*4)+5935,
					IF(H13>=75000,(ROUNDUP((H13-75000)/100,0)*3.5)+1560,
					IF(H13>=25000,(ROUNDUP((H13-25000)/100,0)*2.25)+435,
					IF(H13>=3000,(ROUNDUP((H13-3000)/100,0)*1.75)+50,
					IF(H13>1,(50)))))))),)+(H13*0.08)
           
                */
           
           
           
              if (AUDynamicPrice > 725000){
           
                  Resident          = Math.round( Math.ceil((AUDynamicPrice - 725000) / 100) * 4.5) + 27810; 
           
              }
           
              else if(AUDynamicPrice > 375000){
           
                  Resident          = Math.round( (Math.ceil((AUDynamicPrice - 375000) / 100) * 4.25) ) + 12935; 
           
              }
           
              else if(AUDynamicPrice > 200000){
           
                  Resident          = Math.round( (Math.ceil((AUDynamicPrice - 200000) / 100) * 4) ) + 5935; 
           
              }
           
              else if(AUDynamicPrice > 75000){
           
                  Resident          = Math.round( (Math.ceil((AUDynamicPrice - 75000) / 100) * 3.5) ) + 1560; 
           
              }
           
              else if(AUDynamicPrice > 25000){
           
                  Resident          = Math.round( (Math.ceil((AUDynamicPrice - 25000) / 100) * 2.25) ) + 435; 
           
              }
           
              else if(AUDynamicPrice > 3000){
           
                  Resident          = Math.round( (Math.ceil((AUDynamicPrice - 3000) / 100) * 1.75) ) + 50; 
           
              }
           
              else if(AUDynamicPrice > 1){
           
                  Resident          = 50; 
           
              }
           
              else {
           
                  Resident          = 0 ; 
           
              }


			  if (ResidentStatus == "NRI"){	//NRI Handling...
				  Resident			= parseFloat(Resident) + (parseFloat(AUDynamicPrice) * 0.08);
			  }
           
              
           
              if (AUDynamicPrice > 1){
           
                MortgageReg          = 138.51; 
           
                LandTransfer         = 212.22;
           
              }
           
      

   
    }else if(AuLocation == "VIC"){
   
        /*=ROUND(IF(I13>960001,I13*0.055,
        IF(I13>130001,(0.014*25000)+(0.024*(130000-25000))+(0.06*(I13-130000)),
        IF(I13>25001,(0.014*25000)+(0.024*(I13-25000)),I13*0.014))),)
		

		=ROUND(IF(I13>960001,I13*0.055,IF(I13>130001,(0.014*25000)+(0.024*(130000-25000))+(0.06*(I13-130000)),IF(I13>25001,(0.014*25000)+(0.024*(I13-25000)),I13*0.014))),)+(I13*0.08)
        */
   
   
   
          if (AUDynamicPrice > 960001){
       
              Resident          = Math.round( Math.ceil(AUDynamicPrice) * 0.055); 
       
          }
       
          else if(AUDynamicPrice > 130001){
       
              Resident          = Math.round( (0.014*25000) + (0.024*(130000-25000)) + (0.06*(Math.ceil(AUDynamicPrice)-130000) ) ); 
       
          }
       
          else if(AUDynamicPrice > 25001){
       
              Resident          = Math.round( (0.014*25000) + (0.024*(Math.ceil(AUDynamicPrice)-25000)) ); 
       
          }
       
          else {
       
              Resident          = Math.round(Math.ceil(AUDynamicPrice)*0.014) ; 
       
          }
   
		  
		  if (ResidentStatus == "NRI"){	//NRI Handling...
			  Resident			= parseFloat(Resident) + (parseFloat(AUDynamicPrice) * 0.08);
		  }


   
          if (AUDynamicPrice > 1){
       
            MortgageReg          = 119.7; 
       
            LandTransfer         = Math.round( (Math.ceil(AUDynamicPrice) / 1000 ) * 2.34) + 98.5;
       
            
       
            //=IF(I2>0, (((I2/1000)*2.34)+98.5))
       
          }


		  
   
   
   
   
   
    }else if(AuLocation == "WA"){
   
        /*=ROUND(
   
              IF(J13 > 725000, (ROUNDUP((J13-725000)/100,0)*5.15) + 28453,
   
              IF(J13 > 360000,  (ROUNDUP((J13-360000)/100,0)*4.75) + 11115,
   
              IF(J13 > 150000,  (ROUNDUP((J13-150000)/100,0)*3.8) + 3135,
   
              IF(J13 > 120000,  (ROUNDUP((J13-120000)/100,0)*2.85) + 2280,
   
              IF(J13 >1, (ROUNDUP((J13)/100,0)*1.9)))))),)




			=ROUND(
				  IF(J13 > 725000, (ROUNDUP((J13-725000)/100,0)*5.15) + 28453,
				  IF(J13 > 360000,  (ROUNDUP((J13-360000)/100,0)*4.75) + 11115,
				  IF(J13 > 150000,  (ROUNDUP((J13-150000)/100,0)*3.8) + 3135,
				  IF(J13 > 120000,  (ROUNDUP((J13-120000)/100,0)*2.85) + 2280,
				  IF(J13 >1, (ROUNDUP((J13)/100,0)*1.9)))))),)+(J13*0.07)
   
        */
   
   
   
               if (AUDynamicPrice > 725000){
           
                  Resident          = Math.round( Math.ceil((AUDynamicPrice - 725000) / 100) * 5.15) + 28453; 
           
              }
           
              else if(AUDynamicPrice > 360000){
           
                  Resident          = Math.round( (Math.ceil((AUDynamicPrice - 360000) / 100) * 4.75) ) + 11115; 
           
              }
           
              else if(AUDynamicPrice > 150000){
           
                  Resident          = Math.round( (Math.ceil((AUDynamicPrice - 150000) / 100) * 3.8) ) + 3135; 
           
              }
           
              else if(AUDynamicPrice > 120000){
           
                  Resident          = Math.round( (Math.ceil((AUDynamicPrice - 120000) / 100) * 2.85) ) + 2280; 
           
              }
           
              else if(AUDynamicPrice > 1){
           
                  Resident          = Math.round( (Math.ceil((AUDynamicPrice) / 100) * 1.9) ); 
           
              }
           
              else {
           
                  Resident          = 0 ; 
           
              }



			  if (ResidentStatus == "NRI"){	//NRI Handling...
				  Resident			= parseFloat(Resident) + (parseFloat(AUDynamicPrice) * 0.07);
			  }
           
      
   
              if (AUDynamicPrice > 1){
           
                MortgageReg          = 174.7; 
           
                //LandTransfer         = Math.round( (Math.ceil(AUDynamicPrice) / 1000 ) * 2.34) + 98.5;
           
                
           
                
           
                         if (AUDynamicPrice > 2000000){
                   
                            LandTransfer          = Math.round(Math.ceil(564.7) + (Math.ceil(AUDynamicPrice) /100000) * 20 ); 
                   
                        }
                   
                        else if(AUDynamicPrice > 1900001){
                   
                             LandTransfer          = 564.7; 
                   
                        }
                   
                        else if(AUDynamicPrice > 1800001){
                   
                             LandTransfer          = 544.7; 
                   
                        }
                   
                        else if(AUDynamicPrice > 1700001){
                   
                             LandTransfer          = 524.7; 
                   
                        }
                   
                        else if(AUDynamicPrice > 1600001){
                   
                             LandTransfer          = 504.7; 
                   
                        }
                   
                        else if(AUDynamicPrice > 1500001){
                   
                             LandTransfer          = 484.7; 
                   
                        }
                   
                        else if(AUDynamicPrice > 1400001){
                   
                             LandTransfer          = 464.7; 
                   
                        }
                   
                        else if(AUDynamicPrice > 1300001){
                   
                             LandTransfer          = 444.7; 
                   
                        }
                   
                        else if(AUDynamicPrice > 1200001){
                   
                             LandTransfer          = 424.7; 
                   
                        }
                   
                        else if(AUDynamicPrice > 1100001){
                   
                             LandTransfer          = 404.7; 
                   
                        }
                   
                        else if(AUDynamicPrice > 1000001){
                   
                             LandTransfer          = 384.7; 
                   
                        }
                   
                        else if(AUDynamicPrice > 900001){
                   
                             LandTransfer          = 364.7; 
                   
                        }
                   
                        else if(AUDynamicPrice > 800001){
                   
                             LandTransfer          = 344.7; 
                   
                        }
                   
                        else if(AUDynamicPrice > 700001){
                   
                             LandTransfer          = 324.7; 
                   
                        }
                   
                        else if(AUDynamicPrice > 600001){
                   
                             LandTransfer          = 304.7; 
                   
                        }
                   
                         else if(AUDynamicPrice > 500001){
                   
                             LandTransfer          = 284.7; 
                   
                        }
                   
                         else if(AUDynamicPrice > 400001){
                   
                             LandTransfer          = 264.7; 
                   
                        }
                   
                         else if(AUDynamicPrice > 300001){
                   
                             LandTransfer          = 244.7; 
                   
                        }
                   
                         else if(AUDynamicPrice > 200001){
                   
                             LandTransfer          = 224.7; 
                   
                        }
                   
                         else if(AUDynamicPrice > 120001){
                   
                             LandTransfer          = 124.7; 
                   
                        }
                   
                         else if(AUDynamicPrice > 85001){
                   
                             LandTransfer          = 184.7; 
                   
                        }
                   
                         else if(AUDynamicPrice > 1){
                   
                             LandTransfer          = 174.7; 
                   
                        }
                   
                        
                   
                        
                   
                        else{
                   
                            LandTransfer          = 0; 
                   
                            
                   
                        }
                   
           
           
            }
   
    
    }
    //console.log("Resident=" + Resident);
   
   //console.log(LandTransfer);
   
  // Resident = Math.round(Resident)
    
   
    ObjDuvalDynamicPrice.val( Math.round(AUDynamicPrice).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") );
   
    ObjResident.val( Math.round(Resident).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") );
   
    //ObjLandTransfer.val( Math.round(LandTransfer).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") );
   
    //ObjStampDuty.val( Math.round(Resident).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") );
   
    //ObjMortgageRegistration.val( Math.round(MortgageReg).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") );
   
    
   
    
   
    /*
   
    DuvalDynamicPrice         = OwnerOccupier + SecondHomeInvestment;
   
    $("#DuvalDynamicPrice").val( DuvalDynamicPrice );
   
    
   
    //Resident (Row 15) =SUMPRODUCT(--(C14>{125000;250000;925000;1500000}),(C14-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})    //C14 is Owner Occupier..
   
    Resident                  = GetGBResidentValueFn(OwnerOccupier);
   
    ObjResident.val(Resident); 
   
    
   
    //Resident Investor (Row 16) =SUMPRODUCT(--(C15>{125000;250000;925000;1500000}),(C15-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})+(C15*0.03)    //C15 is Investment or Second Home
   
    ResidentInvestor          = GetGBResidentValueFn(SecondHomeInvestment) + (SecondHomeInvestment * 0.03) ; 
   
    ObjResidentInvestor.val(ResidentInvestor);
   
    
   
    //Stamp Duty =SUM(C4:C6) => Resident + ResidentInvestor + ForeignInvestor
   
    StampDuty                 = Resident + ResidentInvestor;
   
    ObjStampDuty.val( Math.round(StampDuty) );
   
    
   
    LeaseRegistration         = GetGBLandLeaseRegisterAmt(DuvalDynamicPrice);
   
    ObjLeaseRegistration.val(LeaseRegistration);
   
    */
   
   };
   
   
   
   
   
   
   
   var CalcFn = function(){
   
       <?php 
          if ($countryid == "3"){
          
              echo "GBCalcFn(); ";     
          
          }
          
          ?>
       
       
       
       <?php 
          if ($countryid == "2"){
          
              echo "AuCalcFn(); ";     
          
          }
          
          ?>
   
   
   
   
   
   
   
       DuvalDynamicPrice		= FnNulltoAmt( $("#DuvalDynamicPrice").val()); 
       
       StampDuty				= FnNulltoAmt( $("#StampDuty").val() ); 
       
       LegalFees				= FnNulltoAmt( $("#LegalFees").val() ); 
       
       StagePay1Per			= FnNulltoAmt( $("#StagePay1Per").val() ); 
       
       StagePay2Per			= FnNulltoAmt( $("#StagePay2Per").val() ); 
       
       LoanAmountPer			= FnNulltoAmt( $("#LoanAmountPer").val() ); 
       
       LeaseRegistration		= FnNulltoAmt( $("#LeaseRegistration").val() ); 
       
    //   ResetrvationFees		= FnNulltoAmt( $("#ResetrvationFees").val() ); 
       
       MortgageRegistration    = FnNulltoAmt( $("#MortgageRegistration").val() ); 
       
       LandTransfer            = FnNulltoAmt( $("#LandTransfer").val() ); 
       
       
       //NonResidentInvestorAmt   = FnNulltoAmt( $("#NonResidentInvestorAmt").val() ); 
       
       ObjLTV                  = $("#LTV");
       
       
       <?php if ($IsAuGbNz){ ?>
            LTV				    = LoanAmountPer; 
            ObjLTV.val(LTV); 
       <?php } else { ?>
            LTV				    = ObjLTV.val(); 
       <?php } ?>
       
        
       
       
       
       ObjTotalPurchaseCost	= $("#TotalPurchaseCost"); 
       
       ObjTransferFees			= $("#TransferFees");
       
       ObjStagePay1Amt			= $("#StagePay1Amt");
       
       ObjStagePay2Amt			= $("#StagePay2Amt");
       
       ObjTopup				= $("#Topup");
       
       ObjInitialLoanAmt		= $("#InitialLoanAmt");
       
       
       
       <?php if ($IsAuGbNz){ ?>
            TransferFees	    = 0; 
       
            <?php if ($countryid == "1"){ ?>
            if (parseFloat(DuvalDynamicPrice) > 1)
                TransferFees    = 80
       
            <?php } ?>
       
            //ObjTransferFees.val(TransferFees);
        <?php } else{ ?>
            TransferFees	    = FnNulltoAmt( ObjTransferFees.val() ); 
        <?php } ?>
   
   
   
   
   
       TotalPurchaseCost		= parseFloat(DuvalDynamicPrice) + parseFloat(StampDuty) + parseFloat(LegalFees) + parseFloat(TransferFees) + parseFloat(LeaseRegistration) + MortgageRegistration + LandTransfer;
       
       ObjTotalPurchaseCost.val(Math.round(TotalPurchaseCost).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ","));  
       
       
       
       //console.log(TotalPurchaseCost);
       
       
       
       StagePay1Amt			= parseFloat(DuvalDynamicPrice) * parseFloat(StagePay1Per) / 100; 
       
       StagePay2Amt			= parseFloat(DuvalDynamicPrice) * parseFloat(StagePay2Per) / 100; 
       
       
       
       //console.log('Topup='+Topup);
       /*
       console.log('LoanAmountPer='+LoanAmountPer);
       console.log('DuvalDynamicPrice='+DuvalDynamicPrice);
       console.log('ResetrvationFees='+ResetrvationFees);
       console.log('StagePay1Amt='+StagePay1Amt);
       console.log('StagePay2Amt='+StagePay2Amt);
       */
        
        //Topup		    = ((100 - LoanAmountPer) * DuvalDynamicPrice / 100) - ResetrvationFees - StagePay1Amt - StagePay2Amt; 
        
        //Purchase Price – (Purchase Price x Loan Amount)
        
        Topup = Math.round(parseFloat(DuvalDynamicPrice) - ( parseFloat(DuvalDynamicPrice) * (LoanAmountPer / 100) ));
        
        //console.log('Topup='+(100 - LoanAmountPer));
      //console.log('Topup='+Topup);
        
       
        ObjTopup.val(Math.round(Topup).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ","));
           
       
       InitialLoanAmt			= LTV * DuvalDynamicPrice / 100; 
       ObjStagePay1Amt.val(Math.round(StagePay1Amt).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")); 
       ObjStagePay2Amt.val(Math.round(StagePay2Amt).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ","));
       ObjInitialLoanAmt.val(Math.round(InitialLoanAmt).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ","));
       
       
   
   };
   
   
   
   
   
   
   
</script>
<!-- end main content -->
<?php include"footer.php"; ?>
</script>
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Terminology</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p>Content Body</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<?php
//echo number_format(156570.64646,1 , ".", "");