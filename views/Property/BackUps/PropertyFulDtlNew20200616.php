 <?php include "header.php"; 
 \login\loginClass::Init();
 $checkSession = \login\loginClass::CheckUserSessionIp();
 ?>

<?php
$ProprtyId = $_REQUEST["id"];
$RecentAnalyse   	= isset($_REQUEST["RecentAnalyse"]) ? $_REQUEST["RecentAnalyse"] : "";



\Property\PropertyClass::Init();

$user_id   = \settings\session\sessionClass::GetSessionDisplayName();

    $CW_Auto_id				            = isset($_REQUEST["CW_Auto_id"]) 					? isset($_REQUEST["CW_Auto_id"])             : "0";
	$ip_glb_client_fee					= isset($_REQUEST["Ip_Glb_Client_Fee"])             ? isset($_REQUEST["Ip_Glb_Client_Fee"])             : "0";
	$ReservationDeposit					= isset($_REQUEST["Reservation_Deposit"])           ? isset($_REQUEST["Reservation_Deposit"])           : "0";
	$Conveyancingfees					= isset($_REQUEST["Conveyancing_Fees"])             ? isset($_REQUEST["Conveyancing_Fees"])             : "0";
	$Landregistryfees        		    = isset($_REQUEST["Landregistry_Fees"])             ? isset($_REQUEST["Landregistry_Fees"])             : "0";
	$Engrossmentfees        	        = isset($_REQUEST["Engrossment_Fees"])              ? isset($_REQUEST["Engrossment_Fees"])              : "0";
	$MortgageType        	            = isset($_REQUEST["Mortgage_Type"])                 ? isset($_REQUEST["Mortgage_Type"])                 : "0";
	$MortgageLendingVal   			    = isset($_REQUEST["Mortgage_Lending_Val"])          ? isset($_REQUEST["Mortgage_Lending_Val"])          : "0"; 
	$MortgageRate   	                = isset($_REQUEST["Mortgage_Rate"])                 ? isset($_REQUEST["Mortgage_Rate"])                 : "0";
	$MortgageLongTerm   		    	= isset($_REQUEST["Mortgage_Long_Term"])            ? isset($_REQUEST["Mortgage_Long_Term"])            : "0";
	$Finalcapitalpayment   		        = isset($_REQUEST["Final_Capital_Payment"])         ? isset($_REQUEST["Final_Capital_Payment"])         : "0";
	$Stampduty   			            = isset($_REQUEST["Stamp_Duty"])                    ? isset($_REQUEST["Stamp_Duty"])                    : "0";
	$LiquidExpatbrokercosts   		    = isset($_REQUEST["Liquid_Expatbroker_Costs"])      ? isset($_REQUEST["Liquid_Expatbroker_Costs"])      : "0";
	$Lenderarrangementfee   			= isset($_REQUEST["Lender_Arrangement_Fee"])        ? isset($_REQUEST["Lender_Arrangement_Fee"])        : "0";
	$Valuationfee   			        = isset($_REQUEST["Valuation_Fee"])                 ? isset($_REQUEST["Valuation_Fee"])                 : "0";
	$Furniturepack   					= isset($_REQUEST["Furniture_Pack"])                ? isset($_REQUEST["Furniture_Pack"])                : "0";
	$CompleteTenantfee   				= isset($_REQUEST["Complete_Tenant_Fee"])           ? isset($_REQUEST["Complete_Tenant_Fee"])           : "0";
	$CompleteTenantagreementfee   		= isset($_REQUEST["Complete_Tenantagreement_Fee"])  ? isset($_REQUEST["Complete_Tenantagreement_Fee"])  : "0";
	$CompleteHandoverfee   				= isset($_REQUEST["Complete_Handover_Fee"])         ? isset($_REQUEST["Complete_Handover_Fee"])         : "0";
	$CompleteInventoryfee   			= isset($_REQUEST["Complete_Inventory_Fee"])        ? isset($_REQUEST["Complete_Inventory_Fee"])        : "0";
	$CompleteReferenceCheck   			= isset($_REQUEST["Complete_Reference_Check"])      ? isset($_REQUEST["Complete_Reference_Check"])      : "0";
	$ClientFeeRebateComp   				= isset($_REQUEST["ClientFee_Rebate_Comp"])         ? isset($_REQUEST["ClientFee_Rebate_Comp"])         : "0";
	$ServiceCharge   				    = isset($_REQUEST["Service_Charge"])                ? isset($_REQUEST["Service_Charge"])                : "0";
	$TenantManagementFee   				= isset($_REQUEST["Tenant_Management_Fee"])         ? isset($_REQUEST["Tenant_Management_Fee"])         : "0";
	$GroundRent   				    	= isset($_REQUEST["Ground_Rent"])                   ? isset($_REQUEST["Ground_Rent"])                   : "0";   
	
	
	$GroundRentRemarks 					= isset($_REQUEST["GroundRentRemarks"])                 		? isset($_REQUEST["GroundRentRemarks"])              	: "0";  
    $GroundRentSecAmt					= isset($_REQUEST["GroundRentSecAmt"])                 		    ? isset($_REQUEST["GroundRentSecAmt"])                  : "0";  
    $GroundRentAmt						= isset($_REQUEST["GroundRentAmt"])                 			? isset($_REQUEST["GroundRentAmt"])                     : "0";  
    $TenantManagementFeeRemarks			= isset($_REQUEST["GroundRentRemarks"])                 		? isset($_REQUEST["GroundRentRemarks"])                 : "0";  
    $TenantManagementFeeSecAmt			= isset($_REQUEST["TenantManagementFeeSecAmt"])                 ? isset($_REQUEST["TenantManagementFeeSecAmt"])         : "0";  
    $TenantManagementFeeAmt				= isset($_REQUEST["TenantManagementFeeAmt"])                 	? isset($_REQUEST["TenantManagementFeeAmt"])            : "0";  
    $ServiceChargeRemarks				= isset($_REQUEST["ServiceChargeRemarks"])                 	    ? isset($_REQUEST["ServiceChargeRemarks"])              : "0";  
    $ServiceChargeSecAmt				= isset($_REQUEST["ServiceChargeSecAmt"])                 	    ? isset($_REQUEST["ServiceChargeSecAmt"])               : "0";  
    $ServiceChargeAmt					= isset($_REQUEST["ServiceChargeAmt"])                 		    ? isset($_REQUEST["ServiceChargeAmt"])                  : "0";  
    $GrossYield							= isset($_REQUEST["GrossYield"])                 				? isset($_REQUEST["GrossYield"])                    	: "0";  
    $EstGrsRentalIncomeAmt				= isset($_REQUEST["EstGrsRentalIncomeAmt"])                 	? isset($_REQUEST["EstGrsRentalIncomeAmt"])             : "0";  
    $EstGrsRentalIncome					= isset($_REQUEST["EstGrsRentalIncome"])                 		? isset($_REQUEST["EstGrsRentalIncome"])                : "0";  
    $TotalMortgageAmountSecAmount		= isset($_REQUEST["TotalMortgageAmountSecAmount"])              ? isset($_REQUEST["TotalMortgageAmountSecAmount"])      : "0";  
    $TotalMortgageAmount				= isset($_REQUEST["TotalMortgageAmount"])                 	    ? isset($_REQUEST["TotalMortgageAmount"])               : "0";  
    $TotalEquityRequiredSecAmount		= isset($_REQUEST["TotalEquityRequiredSecAmount"])              ? isset($_REQUEST["TotalEquityRequiredSecAmount"])      : "0";  
    $TotalEquityRequired				= isset($_REQUEST["TotalEquityRequired"])                 	    ? isset($_REQUEST["TotalEquityRequired"])               : "0";  
    $ClientFeeRebateCompRemarks			= isset($_REQUEST["ClientFeeRebateCompRemarks"])                ? isset($_REQUEST["ClientFeeRebateCompRemarks"])        : "0";  
    $ClientFeeRebateCompSecAmt			= isset($_REQUEST["ClientFeeRebateCompSecAmt"])                 ? isset($_REQUEST["ClientFeeRebateCompSecAmt"])         : "0";  
    $ClientFeeRebateCompAmt				= isset($_REQUEST["ClientFeeRebateCompAmt"])                 	? isset($_REQUEST["ClientFeeRebateCompAmt"])            : "0";  
    $CompleteReferenceCheckRemarks		= isset($_REQUEST["CompleteReferenceCheckRemarks"])             ? isset($_REQUEST["CompleteReferenceCheckRemarks"])     : "0";  
    $CompleteReferenceCheckSecAmt		= isset($_REQUEST["CompleteReferenceCheckSecAmt"])              ? isset($_REQUEST["CompleteReferenceCheckSecAmt"])      : "0";  
    $CompleteReferenceCheckAmt			= isset($_REQUEST["CompleteReferenceCheckAmt"])                 ? isset($_REQUEST["CompleteReferenceCheckAmt"])         : "0";  
    $CompleteInventoryfeeRemarks		= isset($_REQUEST["CompleteInventoryfeeRemarks"])               ? isset($_REQUEST["CompleteInventoryfeeRemarks"])       : "0";  
    $CompleteInventoryfeeSecAmt			= isset($_REQUEST["CompleteInventoryfeeSecAmt"])                ? isset($_REQUEST["CompleteInventoryfeeSecAmt"])        : "0";  
    $CompleteInventoryfeeAmt			= isset($_REQUEST["CompleteInventoryfeeAmt"])                   ? isset($_REQUEST["CompleteInventoryfeeAmt"])           : "0";  
    $CompleteHandoverfeeRemarks			= isset($_REQUEST["CompleteHandoverfeeRemarks"])                ? isset($_REQUEST["CompleteHandoverfeeRemarks"])        : "0";  
    $CompleteHandoverfeeSecAmt			= isset($_REQUEST["CompleteHandoverfeeSecAmt"])                 ? isset($_REQUEST["CompleteHandoverfeeSecAmt"])         : "0";  
    $CompleteHandoverfeeAmt				= isset($_REQUEST["CompleteHandoverfeeAmt"])                 	? isset($_REQUEST["CompleteHandoverfeeAmt"])            : "0";  
    $CompleteTenantagreementfeeRemarks	= isset($_REQUEST["CompleteTenantagreementfeeRemarks"])      	? isset($_REQUEST["CompleteTenantagreementfeeRemarks"]) : "0";  
    $CompleteTenantagreementfeeSecAmt	= isset($_REQUEST["CompleteTenantagreementfeeSecAmt"])       	? isset($_REQUEST["CompleteTenantagreementfeeSecAmt"])  : "0";  
    $CompleteTenantagreementfeeAmt		= isset($_REQUEST["CompleteTenantagreementfeeAmt"])          	? isset($_REQUEST["CompleteTenantagreementfeeAmt"])     : "0";  
    $CompleteTenantfeeRemarks			= isset($_REQUEST["CompleteTenantfeeRemarks"])               	? isset($_REQUEST["CompleteTenantfeeRemarks"])          : "0";  
    $CompleteTenantfeeSecAmt			= isset($_REQUEST["CompleteTenantfeeSecAmt"])                	? isset($_REQUEST["CompleteTenantfeeSecAmt"])           : "0";  
    $CompleteTenantfeeAmt				= isset($_REQUEST["CompleteTenantfeeAmt"])                   	? isset($_REQUEST["CompleteTenantfeeAmt"])              : "0";  
    $FurniturepackRemarks				= isset($_REQUEST["FurniturepackRemarks"])                  	? isset($_REQUEST["FurniturepackRemarks"])              : "0";  
    $FurniturepackSecAmt				= isset($_REQUEST["FurniturepackSecAmt"])                 	    ? isset($_REQUEST["FurniturepackSecAmt"])               : "0";  
    $FurniturepackAmt					= isset($_REQUEST["FurniturepackAmt"])                 		    ? isset($_REQUEST["FurniturepackAmt"])                  : "0";  
    $ValuationfeeRemarks				= isset($_REQUEST["ValuationfeeRemarks"])                 	    ? isset($_REQUEST["ValuationfeeRemarks"])               : "0";  
    $ValuationfeeSecAmt					= isset($_REQUEST["ValuationfeeSecAmt"])                 		? isset($_REQUEST["ValuationfeeSecAmt"])                : "0";  
    $ValuationfeeAmt					= isset($_REQUEST["ValuationfeeAmt"])                 		    ? isset($_REQUEST["ValuationfeeAmt"])                   : "0";  
    $LenderarrangementfeeRemarks		= isset($_REQUEST["LenderarrangementfeeRemarks"])               ? isset($_REQUEST["LenderarrangementfeeRemarks"])       : "0";  
    $LenderarrangementfeeSecAmt			= isset($_REQUEST["LenderarrangementfeeSecAmt"])                ? isset($_REQUEST["LenderarrangementfeeSecAmt"])        : "0";  
    $LenderarrangementfeeAmt			= isset($_REQUEST["LenderarrangementfeeAmt"])                   ? isset($_REQUEST["LenderarrangementfeeAmt"])           : "0";  
    $LiquidExpatbrokercostsRemarks		= isset($_REQUEST["LiquidExpatbrokercostsRemarks"])             ? isset($_REQUEST["LiquidExpatbrokercostsRemarks"])     : "0";  
    $LiquidExpatbrokercostsSecAmt		= isset($_REQUEST["LiquidExpatbrokercostsSecAmt"])              ? isset($_REQUEST["LiquidExpatbrokercostsSecAmt"])      : "0";  
    $LiquidExpatbrokercostsAmt			= isset($_REQUEST["LiquidExpatbrokercostsAmt"])                 ? isset($_REQUEST["LiquidExpatbrokercostsAmt"])         : "0";  
    $StampdutyRemarks					= isset($_REQUEST["StampdutyRemarks"])                 		    ? isset($_REQUEST["StampdutyRemarks"])                  : "0";  
    $StampdutySecAmt					= isset($_REQUEST["StampdutySecAmt"])                 		    ? isset($_REQUEST["StampdutySecAmt"])                   : "0";  
    $StampdutyAmt						= isset($_REQUEST["StampdutyAmt"])                 			    ? isset($_REQUEST["StampdutyAmt"])                   	: "0";  
    $FinalcapitalpaymentRemarks			= isset($_REQUEST["FinalcapitalpaymentRemarks"])                ? isset($_REQUEST["FinalcapitalpaymentRemarks"])        : "0";  
    $FinalcapitalpaymentSecAmt			= isset($_REQUEST["FinalcapitalpaymentSecAmt"])                 ? isset($_REQUEST["FinalcapitalpaymentSecAmt"])         : "0";  
    $FinalcapitalpaymentAmt				= isset($_REQUEST["FinalcapitalpaymentAmt"])                 	? isset($_REQUEST["FinalcapitalpaymentAmt"])            : "0";  
    $FurtherDepositSecAmt				= isset($_REQUEST["FurtherDepositSecAmt"])                 	    ? isset($_REQUEST["FurtherDepositSecAmt"])              : "0";  
    $FurtherDepositAmt					= isset($_REQUEST["FurtherDepositAmt"])                 		? isset($_REQUEST["FurtherDepositAmt"])                 : "0";  
    $PaymentResExcSecAmount				= isset($_REQUEST["PaymentResExcSecAmount"])                 	? isset($_REQUEST["PaymentResExcSecAmount"])            : "0";  
    $PaymentResExcAmount				= isset($_REQUEST["PaymentResExcAmount"])                 	    ? isset($_REQUEST["PaymentResExcAmount"])               : "0";  
    $LandregistryfeesRemarks			= isset($_REQUEST["LandregistryfeesRemarks"])                   ? isset($_REQUEST["LandregistryfeesRemarks"])           : "0";  
    $LandregistryfeesSecAmt				= isset($_REQUEST["LandregistryfeesSecAmt"])                 	? isset($_REQUEST["LandregistryfeesSecAmt"])            : "0";  
    $LandregistryfeesAmt				= isset($_REQUEST["LandregistryfeesAmt"])                 	    ? isset($_REQUEST["LandregistryfeesAmt"])               : "0";  
    $ConveyancingfeesRemarks			= isset($_REQUEST["ConveyancingfeesRemarks"])                   ? isset($_REQUEST["ConveyancingfeesRemarks"])           : "0";  
    $ConveyancingfeesSecAmt				= isset($_REQUEST["ConveyancingfeesSecAmt"])                 	? isset($_REQUEST["ConveyancingfeesSecAmt"])            : "0";  
    $ConveyancingfeesAmt				= isset($_REQUEST["ConveyancingfeesAmt"])                 	    ? isset($_REQUEST["ConveyancingfeesAmt"])               : "0";  
    $ReservationDepositRemarks			= isset($_REQUEST["ReservationDepositRemarks"])                 ? isset($_REQUEST["ReservationDepositRemarks"])         : "0";  
    $ReservationDepositSecAmt			= isset($_REQUEST["ReservationDepositSecAmt"])                  ? isset($_REQUEST["ReservationDepositSecAmt"])          : "0";  
    $ReservationDepositAmt				= isset($_REQUEST["ReservationDepositAmt"])                 	? isset($_REQUEST["ReservationDepositAmt"])             : "0";  
    $ipglbclientfeeRemarks				= isset($_REQUEST["ipglbclientfeeRemarks"])                 	? isset($_REQUEST["ipglbclientfeeRemarks"])             : "0";  
    $ipglbclientfeeSecAmt				= isset($_REQUEST["ipglbclientfeeSecAmt"])                  	? isset($_REQUEST["ipglbclientfeeSecAmt"])              : "0";  
    $ipglbclientfeeAmt					= isset($_REQUEST["ipglbclientfeeAmt"])                 		? isset($_REQUEST["ipglbclientfeeAmt"])                 : "0";  
    $Unit					            = isset($_REQUEST["Unit"])                 		                ? isset($_REQUEST["Unit"])                              : "17";  
    $RentalGuarantee					= isset($_REQUEST["RentalGuarantee"])                 		    ? isset($_REQUEST["RentalGuarantee"])                   : "No"; 
    $FurniturePackReq					= isset($_REQUEST["FurniturePackReq"])                 		    ? isset($_REQUEST["FurniturePackReq"])                  : "No"; 
    $firsttimebuyer					    = isset($_REQUEST["firsttimebuyer"])                 		    ? isset($_REQUEST["firsttimebuyer"])                    : "No"; 
    $EngrossmentfeesAmt				    = isset($_REQUEST["EngrossmentfeesAmt"])                 		? isset($_REQUEST["EngrossmentfeesAmt"])                : "0"; 
    $EngrossmentfeesSecAmt			    = isset($_REQUEST["EngrossmentfeesSecAmt"])                 	? isset($_REQUEST["EngrossmentfeesSecAmt"])             : "0"; 
    $EngrossmentfeesRemarks				= isset($_REQUEST["EngrossmentfeesRemarks"])                 	? isset($_REQUEST["EngrossmentfeesRemarks"])            : "0"; 
    $vatpercentage				        = isset($_REQUEST["vatpercentage"])                 	? isset($_REQUEST["vatpercentage"])            : "0"; 








$Propertyrows = self::GetPropertiesDatas($ProprtyId,'','');

foreach ($Propertyrows as $Propertyrow) 
{
   
   $ProjectName					= $Propertyrow["project_name"]      ? $Propertyrow["project_name"]     : "";
   $building					= $Propertyrow["building"]          ? $Propertyrow["building"]         : "";
   $apartment_no				= $Propertyrow["apartment_no"]      ? $Propertyrow["apartment_no"]     : "";
   $UnitSize					= $Propertyrow["land_area"]         ? $Propertyrow["land_area"]        : "0";
   $UnitType					= $Propertyrow["no_of_bedrooms"]    ? $Propertyrow["no_of_bedrooms"]   : "0";
   $Purchaseprice			    = $Propertyrow["dpo_rate"]          ? $Propertyrow["dpo_rate"]        : "0";
   $DuvalDynamicPrice			= $Propertyrow["dpo_rate"]          ? $Propertyrow["dpo_rate"]        : "0";
   $MarketPrice			        = $Propertyrow["start_rate"]          ? $Propertyrow["start_rate"]        : "0";
   
   $countryid			        = $Propertyrow["country"]           ? $Propertyrow["country"]         : "";
   $weeklyRent			        = $Propertyrow["weekly_rent"]      ? $Propertyrow["weekly_rent"]         : "";
   $WeeklyRental                = $weeklyRent;
   //   
  
  	//echo "countryid=$countryid"; 

   
}
    //$Purchaseprice  =   '163000';
    // $UnitSize       =   '574';
    //$UnitType       =   '1';
    //$weeklyRent     =   '182.44';
    

$ChkCntArr               			= \DBConn\DBConnection::getQueryFetchColumn("(SELECT CURRENCY FROM country_master WHERE COUNTRY_CODE ='{$countryid}')");
$Currency             				= $ChkCntArr["0"];
		
//echo "Currency== " .$Currency;
//exit();


$rows = \Property\PropertyClass::GetPropertiesAnayserData($countryid);
foreach ($rows as $row) 
{
    
                     
    //echo "hii";

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
	$vatpercentage   				    = $row["vat_percentage"]                ? $row["vat_percentage"]                   : "0";
	
	

}
    //$MortgageRate    =   '3.79';
   //'$ServiceCharge   = '1.65';

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
    
    
    $PaymentOnCompleteion               =   floatval($FinalcapitalpaymentAmt) + floatval($StampdutyAmt) + floatval($LiquidExpatbrokercostsAmt) + floatval($LenderarrangementfeeAmt) + floatval($ValuationfeeAmt)
                                            + floatval($FurniturepackAmt) + floatval($CompleteTenantfeeAmt) + floatval($CompleteTenantagreementfeeAmt) + floatval($CompleteHandoverfeeAmt) + floatval($CompleteInventoryfeeAmt)
                                            + floatval($CompleteReferenceCheckAmt) + floatval($ClientFeeRebateCompAmt);
                                            
                                            
    $FurtherDepositAmt                  =   floatval($Purchaseprice)  * 0 ;
                                            
                                            
    $TotalEquityRequired                =   floatval($PaymentResExcAmount) + floatval($PaymentOnCompleteion) + floatval($FurtherDepositAmt);
    
    if ( $MortgageType != "None"){
        
        $MortgageLendingValPercentage        =    floatval($MortgageLendingVal) / 100;
        $TotalMortgageAmount                 =    floatval($Purchaseprice) *   floatval($MortgageLendingValPercentage);

    }else{
        
        $TotalMortgageAmount                =   0;
    }
     
 
 
     
     $EstGrsRentalIncome                    =  round(floatval($weeklyRent) * 4.33); 
     
    // echo 'EstGrsRentalIncome=' .$EstGrsRentalIncome;
    
     $GrossYieldTemp                        =  (floatval($EstGrsRentalIncome) * 12) / floatval($Purchaseprice);
     $GrossYield                            =  number_format(floatval($GrossYieldTemp)  * 100,1);
     
     
    
    $ServiceChargeAmt                       = - round( floatval($ServiceCharge) * floatval($UnitSize)   / 12 );
    

   
    $vatpercentageTemp                      =  floatval($vatpercentage) / 100;
    
    //echo 'vatpercentageTemp-'+ $vatpercentageTemp;
    
    $TenantManagementFeeAmt                 =  -  round((floatval($EstGrsRentalIncome) *  floatval($TenantManagementFee) /100)  * ( 1 + floatval($vatpercentageTemp)));
    
    $GroundRentTemp                         =  (floatval($Purchaseprice) * 0.1) / 12;
    $GroundRent                             =  round(floatval($GroundRentTemp) / 100);
    
    $GroundRentAmt                          =  - floatval($GroundRent); 
    
    
    $NetMonthlyExpenses                     =   floatval($ServiceChargeAmt) +  floatval($TenantManagementFeeAmt) + floatval($GroundRentAmt);
    
    
    $ScndMonthlyExpenses                    =   floatval($NetMonthlyExpenses) +  floatval($EstGrsRentalIncome);
    
    
    $NetYeildTemp                           =   (floatval($ScndMonthlyExpenses) * 12) / floatval($Purchaseprice);
    $NetYeild                               =   round(floatval($NetYeildTemp) * 100,1);
    
    $MortgageTypeIntersetOnly               =  -335; // hardCored
    
    $ProjNetMonthPostion                    =  floatval($MortgageTypeIntersetOnly) + floatval($ScndMonthlyExpenses);
    
    
    
       
    $Paymentonreservation                   =    floatval($PaymentResExcAmount);
    $FurtherdepositTotal                    =    floatval($FurtherDepositAmt);
    $PaymentPropComp                        =    floatval($PaymentOnCompleteion);
    $TotalEquiltyRequiredVal                =    floatval($TotalEquityRequired);
    
    
    $MortgagePrincipleTotal                 =    floatval($TotalMortgageAmount);
    $Projectedmonthlycash                  =    floatval($ProjNetMonthPostion); 
    $MortgageInterestOnly                  =    floatval($MortgageTypeIntersetOnly); 
    $MonthlyIncome                         =    floatval($ScndMonthlyExpenses);
    
   // =-J59*E64*(1+Inputs!K47)
   
   
    //Yasir / 23-May-2020 / Hardcode Analyzer Input Values (start)
    $Income						= 100000;
    
    if (!isset($MarketPrice))
        $MarketPrice			= 550000;
        
    if (!isset($DuvalDynamicPrice))
        $DuvalDynamicPrice		= 500000;
        
    if (!isset($WeeklyRental))
        $WeeklyRental			= 750;
        
        
    $StampDuty					= 0;
    $TransferFees				= 80;
    $LegalFees					= 1000;
    $TotalPurchaseCost			= 501080;
    $ResetrvationFees			= 2500;
    $StagePay1Per				= 10;
    $StagePay1Amt				= 50000;
    $StagePay2Per				= 0;
    $StagePay2Amt				= 0;
    $LoanAmountPer				= 80;
    $Topup						= 47500;
    
    
        
    $VacancyRate				= 2;
    $LettingFeeRate				= 2;
    $ManagementFees				= 8;
    $CouncilPropertyTax			= 1000;
    $CodyCorporateServiceChg	= 1000;
    $LandLeaseRentPa			= 300;
    $InsurancePa				= 1000;
    $RepairandMaintenance		= 1.5;
    $CleaningPerMonth			= 250;
    $GardeningPerMonth			= 150;
    $ServiceContractsPa			= 200;
    $Other						= 0;
    $LTV						= 80;
    $InitialLoanAmt				= 400000;
    $InterestRate				= 4.5;
    $TermYears					= 30;
    $CPI						= 2;
    $RentalGrowth				= 2.5;
    $CapitalGrowth				= 2;
    $FixturesValue				= 20000;
    $FixturesLife				= 20;
    $FurnitureValue				= 10000;
    $FurnitureLife				= 10;
    //Yasir / 23-May-2020 / Hardcode Analyzer Input Values ( end )
    
    //Yasir / 10-Jul-2020 / UK Analyzer..
    $SecondHomeInvestment       = "";
    $OwnerOccupier              = ""; 
    $LeaseRegistration          = "";
    
    //Yasir / 10-Jul-2020 / AU Analyzer
    $MortgageRegistration       = "";
    $LandTransfer               = ""; 
    $BuildingValue              = 300000;
    $BuildingLife               = 40;
    
    $countryid = "AU";  //hardcode for testing
    if ($countryid == "UK"){
        $DuvalPriceReadOnly     = "readonly";
        $DuvalDynamicPrice      = 0;
        $TransferFees           = 0;
    }
    else if ($countryid == "AU"){
        $DuvalPriceReadOnly     = "readonly";
        $DuvalDynamicPrice      = 0;
        $TransferFees           = 0;
    }
    else{
        $DuvalPriceReadOnly     = "";
    }
?>



   <div class="row no-gutters">
      <div class="col-12">
         <div class="analyser-section">
            <form class="dpo-form"  action="<?php echo SITE_BASE_URL;?>/Property/propertysave.html?buttonaction=<?php echo $action;?>&user_id=<?php echo $user_id;?>&property_id=<?php echo $ProprtyId;?>" method="post">
                <input type="hidden" name="countryid" id="countryid" value="<?php echo $countryid;?>" />
               <div id="analyser">
                  <!--loan and purchase -->
                  <h3>Inputs</h3>
                  <section>
                     <div class="row">
                        <div class="col-12">
                           <!-- purchase details-->
                           <div class="card my-12">
                              <div class="card-body">
                                 <h4 class="card-title">Financial Analysis for <?php echo $countryid; ?>: </h4>
                                 <div class="table-responsive">
                                    <?php if ($countryid == "UK"){ ?>
                                    <h4 class="card-title">Purchase Price: </h4>
                                    <table class="table">
                                     <tr>
                                        <td width="50%">Owner Occupier</td>
                                        <td width="50%"><input class="form-control" type='type' name='OwnerOccupier' id='OwnerOccupier' rel='calculate' value='<?php echo $OwnerOccupier; ?>'></td>
                                     </tr>
                                     <tr>
                                        <td>Investment or Second Home</td>
                                        <td>
                                            <input class="form-control" type='type' name='SecondHomeInvestment' id='SecondHomeInvestment' rel='calculate' value='<?php echo $SecondHomeInvestment; ?>'>
                                            <input type="hidden" name="Resident" id="Resident" value="" />
                                            <input type="hidden" name="ResidentInvestor" id="ResidentInvestor" value="" />
                                            
                                        </td>
                                     </tr>
                                    </table>
                                    <?php } ?>
                                    
                                    <?php if ($countryid == "AU"){ ?>
                                    <h4 class="card-title">DuVal Dynamic Price: </h4>
                                    <table class="table">
                                     <tr>
                                        <td width="50%">Location</td>
                                        <td width="50%">
                                            <?php echo \Html\Elements\InputsClass::plotArrayCombo( "AuLocation", "AU_LOCATIONS", $AuLocation, "Select", "class='form-control input-default' rel='calculate' "); ?>
                                        </td>
                                     </tr>
                                     <tr>
                                        <td>DuVal Dynamic Price</td>
                                        <td>
                                            <input class="form-control" type='type' name='AUDynamicPrice' id='AUDynamicPrice' rel='calculate' value='<?php echo $AUDynamicPrice; ?>'>
                                            <input type="hidden" name="Resident" id="Resident" value="" />
                                        </td>
                                     </tr>
                                    </table>
                                    <?php } ?>
                                    
                                    <table class="table">
                                     <tr>
                                        <td width="50%">Income</td>
                                        <td width="50%"><input class="form-control" type='type' name='Income' id='Income' rel='calculate' value='<?php echo $Income; ?>'></td>
                                     </tr>
                                     <tr>
                                        <td>Market Price</td>
                                        <td><input class="form-control" type='type' name='MarketPrice' id='MarketPrice' rel='calculate' value='<?php echo $MarketPrice; ?>'></td>
                                     </tr>
                                     <tr>
                                        <td>DuVal Dynamic Price ™</td>
                                        <td><input class="form-control" type='type' name='DuvalDynamicPrice' id='DuvalDynamicPrice' rel='calculate' value='<?php echo $DuvalDynamicPrice; ?>' <?php echo $DuvalPriceReadOnly; ?>></td>
                                     </tr>
                                     <tr>
                                        <td>Stamp Duty</td>
                                        <td><input class="form-control" type='type' name='StampDuty' id='StampDuty' rel='calculate' value='<?php echo $StampDuty; ?>' readonly></td>
                                     </tr>
                                     
                                     <?php if ($countryid == "UK"){ ?>
                                     <tr>
                                        <td>Lease Registration</td>
                                        <td><input class="form-control" type='type' name='LeaseRegistration' id='LeaseRegistration' rel='calculate' value='<?php echo $LeaseRegistration; ?>' readonly></td>
                                     </tr>
                                     <?php } ?>
                                     
                                     
                                     <?php if ($countryid == "NZ"){ ?>
                                     <tr>
                                        <td>Transfer Fees</td>
                                        <td><input class="form-control" type='type' name='TransferFees' id='TransferFees' rel='calculate' value='<?php echo $TransferFees; ?>' readonly></td>
                                     </tr>
                                     <?php } ?>
                                     
                                     <?php if ($countryid == "AU"){ ?>
                                     <tr>
                                        <td>Mortgage Registration</td>
                                        <td><input class="form-control" type='type' name='MortgageRegistration' id='MortgageRegistration' rel='calculate' value='<?php echo $MortgageRegistration; ?>' readonly></td>
                                     </tr>
                                     <tr>
                                        <td>Land Transfer</td>
                                        <td><input class="form-control" type='type' name='LandTransfer' id='LandTransfer' rel='calculate' value='<?php echo $LandTransfer; ?>' readonly></td>
                                     </tr>
                                     <?php } ?>
                                     
                                     <tr>
                                        <td>Legal Fees</td>
                                        <td><input class="form-control" type='type' name='LegalFees' id='LegalFees' rel='calculate' value='<?php echo $LegalFees; ?>'></td>
                                     </tr>
                                     <tr>
                                        <td>Total Purchase Cost</td>
                                        <td><input class="form-control" type='type' name='TotalPurchaseCost' id='TotalPurchaseCost' rel='calculate' value='<?php echo $TotalPurchaseCost; ?>' readonly></td>
                                     </tr>
                                  </table>
                                 </div>
                              </div>
                           </div>
                           <!-- end purchase details-->
                        </div>
                     </div>
                     <div class="analyser-submit-section">
                       <div class="btn-div text-right">
                          <a id="right" class="btn btn-outline-dark" href="#next">Payments <i class="fa fa-chevron-right"></i></a>
                       </div>
                     </div>
                  </section>
                  <!-- end loan and purchase -->
                  <!-- Rent & Expenses -->
                  <h3>Payments </h3>
                  <section>
                     <!-- purchase details-->
                     <div class="card my-4">
                        <div class="card-body">
                           <h4 class="card-title">Payments </h4> 
                           <div class="table-responsive">
                              <table class="table">
                                     <tr>
                                        <td>Reservation Fee</td>
                                        <td><input class="form-control" type='type' name='ResetrvationFees' id='ResetrvationFees' rel='calculate' value='<?php echo $ResetrvationFees; ?>'></td>
                                        <td>&nbsp;&nbsp;</td>
                                     </tr>
                                     <tr>
                                        <td>Stage Payment 1 (%)</td>
                                        <td><input class="form-control" type='type' name='StagePay1Per' id='StagePay1Per' rel='calculate' value='<?php echo $StagePay1Per; ?>'></td>
                                        <td><input class="form-control" type='text' name='StagePay1Amt' id='StagePay1Amt' readonly rel='calculate' value='<?php echo $StagePay1Amt; ?>'>&nbsp;&nbsp;</td>
                                     </tr>
                                     <tr>
                                        <td>Stage Payment 2 (%)</td>
                                        <td><input class="form-control" type='type' name='StagePay2Per' id='StagePay2Per' rel='calculate' value='<?php echo $StagePay2Per; ?>'></td>
                                        <td><input class="form-control" type='text' name='StagePay2Amt' id='StagePay2Amt' readonly rel='calculate' value='<?php echo $StagePay2Amt; ?>'>&nbsp;&nbsp;</td>
                                     </tr>
                                     <tr>
                                        <td>Loan Amount (%)</td>
                                        <td><input class="form-control" type='type' name='LoanAmountPer' id='LoanAmountPer' rel='calculate' value='<?php echo $LoanAmountPer; ?>'></td>
                                        <td>&nbsp;&nbsp;</td>
                                     </tr>
                                     <tr>
                                        <td>Top Up </td>
                                        <td><input class="form-control" type='type' name='Topup' id='Topup' rel='calculate' value='<?php echo $Topup; ?>' readonly></td>
                                        <td>&nbsp;&nbsp;</td>
                                     </tr>
                                  </table>
                           </div>
                        </div>
                     </div>
                     
                     
                     <!-- end ASSIGN AN ENTITY -->
                     <div class="row">
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-left">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fa fa-chevron-left"></i> Inputs</a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-right">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Rental Rate <i class="fa fa-chevron-right"></i> </a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                      </div>
                  </section>
                  <!-- End Rent & Expenses -->
                  <!-- Tax & MArket -->
                  <h3>Rental Rate</h3>
                  <section>
                     <!-- ASSIGN AN ENTITY -->
                     <div class="card my-4">
                        <div class="card-body">
                           <h4 class="card-title">Rental Rate</h4> 
                           <div class="table-responsive">
                              <table class="table">
                                 <tr>
                                    <td>Weekly Rental</td>
                                    <td><input class="form-control" type='type' name='WeeklyRental' id='WeeklyRental' rel='calculate' value='<?php echo $WeeklyRental; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Vacancy Rate (%)</td>
                                    <td><input class="form-control" type='type' name='VacancyRate' id='VacancyRate' rel='calculate' value='<?php echo $VacancyRate; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                     <!-- end ASSIGN AN ENTITY -->
                     <div class="row">
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-left">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fa fa-chevron-left"></i> Payments</a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-right">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Expenses <i class="fa fa-chevron-right"></i> </a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                      </div>
                  </section>
                  <!-- End Tax & MArket -->
                  <!-- Investment Return -->
                  <h3>Expenses</h3>
                  <section>
                     <!-- ASSIGN AN ENTITY -->
                     <div class="card my-4">
                        <div class="card-body">
                           <h4 class="card-title">Expenses</h4> 
                           <div class="table-responsive">
                              <table class="table">
                                 <tr>
                                    <td>Letting Fees (%)</td>
                                    <td><input class="form-control" type='type' name='LettingFeeRate' id='LettingFeeRate' rel='calculate' value='<?php echo $LettingFeeRate; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Management Fees (%)</td>
                                    <td><input class="form-control" type='type' name='ManagementFees' id='ManagementFees' rel='calculate' value='<?php echo $ManagementFees; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Council/Property Tax (p.a.)</td>
                                    <td><input class="form-control" type='type' name='CouncilPropertyTax' id='CouncilPropertyTax' rel='calculate' value='<?php echo $CouncilPropertyTax; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Body Corporate/Strata/Service Charge (p.a.)</td>
                                    <td><input class="form-control" type='type' name='CodyCorporateServiceChg' id='CodyCorporateServiceChg' rel='calculate' value='<?php echo $CodyCorporateServiceChg; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Land Lease/Ground Rent (p.a.)</td>
                                    <td><input class="form-control" type='type' name='LandLeaseRentPa' id='LandLeaseRentPa' rel='calculate' value='<?php echo $LandLeaseRentPa; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Insurance (p.a.)</td>
                                    <td><input class="form-control" type='type' name='InsurancePa' id='InsurancePa' rel='calculate' value='<?php echo $InsurancePa; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Repairs and Maintenance (%)</td>
                                    <td><input class="form-control" type='type' name='RepairandMaintenance' id='RepairandMaintenance' rel='calculate' value='<?php echo $RepairandMaintenance; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Cleaning (per month)</td>
                                    <td><input class="form-control" type='type' name='CleaningPerMonth' id='CleaningPerMonth' rel='calculate' value='<?php echo $CleaningPerMonth; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Gardening (per month)</td>
                                    <td><input class="form-control" type='type' name='GardeningPerMonth' id='GardeningPerMonth' rel='calculate' value='<?php echo $GardeningPerMonth; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Service Contracts (p.a.)</td>
                                    <td><input class="form-control" type='type' name='ServiceContractsPa' id='ServiceContractsPa' rel='calculate' value='<?php echo $ServiceContractsPa; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Other </td>
                                    <td><input class="form-control" type='type' name='Other' id='Other' rel='calculate' value='<?php echo $Other; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                     <!-- end Investment Return -->
                     <div class="row">
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-left">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fa fa-chevron-left"></i> Snap Shot</a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-right">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Estimated monthly income <i class="fa fa-chevron-right"></i></a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                      </div>
                  </section>
                  <!-- End Tax & MArket -->
                  
                  
                  <!--Estimated monthly income -->
                  <h3>Mortgage Information</h3>
                  <section>
                     <!-- Mortgage Information -->
                     <div class="card my-4">
                        <div class="card-body">
                           <h4 class="card-title">Mortgage Information</h4> 
                           <div class="table-responsive">
                              <table class="table ">
                                 <tr>
                                    <td>LTV (%)</td>
                                    <td><input class="form-control" type='type' name='LTV' id='LTV' rel='calculate' value='<?php echo $LTV; ?>' readonly /></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Initial Loan Amount</td>
                                    <td><input class="form-control" type='type' name='InitialLoanAmt' id='InitialLoanAmt' rel='calculate' value='<?php echo $InitialLoanAmt; ?>' readonly /></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Interest Rate (%)</td>
                                    <td><input class="form-control" type='type' name='InterestRate' id='InterestRate' rel='calculate' value='<?php echo $InterestRate; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Term (Years)</td>
                                    <td><input class="form-control" type='type' name='TermYears' id='TermYears' rel='calculate' value='<?php echo $TermYears; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                        <!-- end Estimated monthly income -->
                     </div>
                     <div class="row">
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-left">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fa fa-chevron-left"></i> Estimated monthly income</a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-right">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Results <i class="fa fa-chevron-right"></i></a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                      </div> 
                  </section>
                  <!-- End Estimated monthly income -->
                  
                  
                  <!--Estimated monthly income -->
                  <h3>Growth Factors</h3>
                  <section>
                     <!-- Growth Factors -->
                     <div class="card my-4">
                        <div class="card-body">
                           <h4 class="card-title">Growth Factors</h4> 
                           <div class="table-responsive">
                              <table class="table ">
                                 <tr>
                                    <td>CPI (%)</td>
                                    <td><input class="form-control" type='type' name='CPI' id='CPI' rel='calculate' value='<?php echo $CPI; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Rental Growth (%)</td>
                                    <td><input class="form-control" type='type' name='RentalGrowth' id='RentalGrowth' rel='calculate' value='<?php echo $RentalGrowth; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Capital Growth (%)</td>
                                    <td><input class="form-control" type='type' name='CapitalGrowth' id='CapitalGrowth' rel='calculate' value='<?php echo $CapitalGrowth; ?>'></td>
                                    <td>&nbsp;&nbsp;</td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                        <!-- end Growth Factors -->
                     </div>
                     <div class="row">
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-left">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fa fa-chevron-left"></i> Estimated monthly income</a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-right">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Results <i class="fa fa-chevron-right"></i></a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                      </div> 
                  </section>
                  <!-- End Growth Factors -->
                  
                  
                  <!--Depreciation -->
                  <h3>Depreciation</h3>
                  <section>
                     <!-- Depreciation -->
                     <div class="card my-4">
                        <div class="card-body">
                           <h4 class="card-title">Depreciation</h4> 
                           <div class="table-responsive">
                              <table class="table ">
                                 <tr>
                                    <td>&nbsp;</td>
                                    <td><strong>Value</strong></td>
                                    <td><strong>Life</strong></td>
                                 </tr>
                                 <?php if ($countryid == "AU"){ ?>
                                 <tr>
                                    <td>Building</td>
                                    <td><input class="form-control" type='type' name='BuildingValue' id='BuildingValue' rel='calculate' value='<?php echo $BuildingValue; ?>'></td>
                                    <td><input class="form-control" type='type' name='BuildingLife' id='BuildingLife' rel='calculate' value='<?php echo $BuildingLife; ?>'></td>
                                 </tr>
                                 <?php } ?>
                                 <tr>
                                    <td>Fixtures</td>
                                    <td><input class="form-control" type='type' name='FixturesValue' id='FixturesValue' rel='calculate' value='<?php echo $FixturesValue; ?>'></td>
                                    <td><input class="form-control" type='type' name='FixturesLife' id='FixturesLife' rel='calculate' value='<?php echo $FixturesLife; ?>'></td>
                                 </tr>
                                 <tr>
                                    <td>Furniture</td>
                                    <td><input class="form-control" type='type' name='FurnitureValue' id='FurnitureValue' rel='calculate' value='<?php echo $FurnitureValue; ?>'></td>
                                    <td><input class="form-control" type='type' name='FurnitureLife' id='FurnitureLife' rel='calculate' value='<?php echo $FurnitureLife; ?>'></td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                        <!-- end Depreciation -->
                     </div>
                     <div class="row">
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-left">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fa fa-chevron-left"></i> Estimated monthly income</a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-right">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Results <i class="fa fa-chevron-right"></i></a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                      </div> 
                  </section>
                  <!-- End Depreciation -->
                  
                  
                  <!-- Results -->
                  <h3>Results</h3>
                  <section class="my-4">
                     <div class="row mb-4">
                        <div class="col-6 col-xxl-6">
                           <div class="card">
                           </div>
                        </div>
                        <div class="col-6 col-xxl-6" style='display:none;'>
                           <div class="card">
                              <div class="card-header">
                                 <div class="widget-title row pb-3">
                                    <div class="col text-left align-self-center">
                                       <h3>SUMMARY INPUT</h3>
                                    </div>
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
                                       <thead class="thead-dark">
                                          <tr>
                                             <th>Show all years (0-10) </th>
                                             <th>Today</th>
                                             <th>Year 1</th>
                                             <th>Year 3</th>
                                             <th>Year 5</th>
                                             <th>Year 10</th>
                                          </tr>
                                       </thead>
                                       <tr class="heading-seprator bg-light">
                                          <td colspan="6">OVERVIEW</td>
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
                              <div class="btn-div text-left">
                                 <ul class="list-inline" style='display:none;'>
                                    <li class="list-inline-item"> <button class="btn btn-outline-dark" type="submit">Add to saved</button></li>
                                    <li class="list-inline-item"> <button class="btn btn-outline-dark" type="submit">Move to Portfolio Tracker</button></li>
                                    <li class="list-inline-item"> <button class="btn btn-outline-dark" type="submit">Edit</button></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-3">
                           <div class="analyser-submit-section">
                              <div class="btn-div text-right">
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


<script type="text/javascript" src="<?php echo SITE_BASE_URL; ?>assets/plugins/jquery-steps/jquery-steps.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>

<script>


       $(document).on("keyup blur", "input[numeric='true']:enabled:not([readonly])", function (e) {

           //JS_NumberChk(this);

       });



        var FnNulltoAmt = function(Value){
            if (isNaN(parseFloat(Value)))
                Value = 0;
                
            return parseFloat(Value);
        };
        
        var FnCheckNull = function(Value){
            if (Value == undefined)
                Value = "";
                
            return Value;
        };
        
        
          
    $(document).ready(function(){
        $(document).on("blur change", "[rel='calculate']", function(){
    		CalcFn();
    	});
    	
        $(document).on("click", "#analyser .last", function(){   //#analyser-t-3
            //alert();
            
            Obj     = $(".final-table").closest(".card-body");
            
            datavalues = $(".dpo-form").serialize();
            
           //console.log(datavalues);
           firsttimebuyer   = FnCheckNull( $("[name='firsttimebuyer']").val() ); 
           RentalGuarantee  = FnCheckNull( $("[name='RentalGuarantee']").val() ); 
           FurniturePackReq = FnCheckNull( $("[name='FurniturePackReq']").val() ); 
           UnitSize         = FnCheckNull( $("[name='UnitSize']").val() ); 
           UnitType         = FnCheckNull( $("[name='UnitType']").val() ); 
           Purchaseprice    = FnCheckNull( $("[name='Purchaseprice']").val() ); 
           
           other_datas  = "&Purchaseprice=" + Purchaseprice + "&firsttimebuyer=" + firsttimebuyer + "&RentalGuarantee=" + RentalGuarantee + "&FurniturePackReq=" + FurniturePackReq + "&UnitSize=" + UnitSize + "&UnitType=" + UnitType; 
            
            $.ajax({
					type: "POST",
					url:"<?php echo SITE_BASE_URL;?>ajax/AnalyzerResult.html",
					data: datavalues + other_datas
				}).done(function( data ) {
				    //alert(data)
                    Obj.html(data);
                });
            
        });
        

        $("#analyser").steps({
         headerTag: "h3",
         bodyTag: "section",
         enableAllSteps: true,
         enablePagination: false,
         transitionEffect: 1,
         transitionEffectSpeed: 200,
         titleTemplate: '#title#',
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
    });
    
    var GetUKResidentValueFn = function( FnValue ){
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
    
    var GetUKLandLeaseRegisterAmt = function(FnValue){
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
    
    var UkCalcFn = function(){
      OwnerOccupier             = FnNulltoAmt( $("#OwnerOccupier").val() ); 
      SecondHomeInvestment      = FnNulltoAmt( $("#SecondHomeInvestment").val() ); 
      
      ForeignInvestor           = 0 //Not used in excel
      
      ObjDuvalDynamicPrice      = $("#DuvalDynamicPrice"); 
      ObjResident               = $("#Resident");
      ObjResidentInvestor       = $("#ResidentInvestor");
      ObjStampDuty              = $("#StampDuty");
      ObjLeaseRegistration      = $("#LeaseRegistration");
      
      
      DuvalDynamicPrice         = OwnerOccupier + SecondHomeInvestment;
      $("#DuvalDynamicPrice").val( DuvalDynamicPrice );
      
      //Resident (Row 15) =SUMPRODUCT(--(C14>{125000;250000;925000;1500000}),(C14-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})    //C14 is Owner Occupier..
      Resident                  = GetUKResidentValueFn(OwnerOccupier);
      ObjResident.val(Resident); 
      
      //Resident Investor (Row 16) =SUMPRODUCT(--(C15>{125000;250000;925000;1500000}),(C15-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})+(C15*0.03)    //C15 is Investment or Second Home
      ResidentInvestor          = GetUKResidentValueFn(SecondHomeInvestment) + (SecondHomeInvestment * 0.03) ; 
      ObjResidentInvestor.val(ResidentInvestor);
      
      //Stamp Duty =SUM(C4:C6) => Resident + ResidentInvestor + ForeignInvestor
      StampDuty                 = Resident + ResidentInvestor;
      ObjStampDuty.val( Math.round(StampDuty) );
      
      LeaseRegistration         = GetUKLandLeaseRegisterAmt(DuvalDynamicPrice);
      ObjLeaseRegistration.val(LeaseRegistration);
    };
    
    
    var AuCalcFn = function(){
        AuLocation                  =  $("#AuLocation").val() ; 
        AUDynamicPrice              = FnNulltoAmt( $("#AUDynamicPrice").val() ); 
        
        ForeignInvestor             = 0 //Not used in excel
        
        ObjDuvalDynamicPrice        = $("#DuvalDynamicPrice"); 
        ObjResident                 = $("#Resident");
        ObjLandTransfer             = $("#LandTransfer");
        ObjStampDuty                = $("#StampDuty");
        ObjMortgageRegistration     = $("#MortgageRegistration");
        
        Resident                    = 0; 
        MortgageReg                 = 0;
        LandTransfer                = 0;
        
        console.log("AuLocation=" + AuLocation)
        
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
          
        }
        else if(AuLocation == "NSW"){
            /*
            =ROUND(
                    IF(D13>3040000, (ROUNDUP((D13-3040000)/100,0)*7)+152505,
                    IF(D13 > 1013000, (ROUNDUP((D13-1013000)/100,0)*5.5) + 41017,
                    IF(D13 > 304000,  (ROUNDUP((D13-304000)/100,0)*4.5) + 9112,
                    IF(D13 > 81000,  (ROUNDUP((D13-81000)/100,0)*3.5) + 1307,
                    IF(D13 > 30000,  (ROUNDUP((D13-30000)/100,0)*1.75) + 415,
                    IF(D13 > 14000,  (ROUNDUP((D13-14000)/100,0)*1.5) + 175,
                    IF(D13 <14000, (ROUNDUP((D13)/100,0)*1.25) ))))))),)
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
        }
        
        //console.log("Resident=" + Resident);
        
        ObjDuvalDynamicPrice.val( AUDynamicPrice );
        ObjResident.val( Resident );
        ObjLandTransfer.val( LandTransfer );
        ObjStampDuty.val( Resident );
        ObjMortgageRegistration.val( MortgageReg );
        
        
        /*
        DuvalDynamicPrice         = OwnerOccupier + SecondHomeInvestment;
        $("#DuvalDynamicPrice").val( DuvalDynamicPrice );
        
        //Resident (Row 15) =SUMPRODUCT(--(C14>{125000;250000;925000;1500000}),(C14-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})    //C14 is Owner Occupier..
        Resident                  = GetUKResidentValueFn(OwnerOccupier);
        ObjResident.val(Resident); 
        
        //Resident Investor (Row 16) =SUMPRODUCT(--(C15>{125000;250000;925000;1500000}),(C15-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})+(C15*0.03)    //C15 is Investment or Second Home
        ResidentInvestor          = GetUKResidentValueFn(SecondHomeInvestment) + (SecondHomeInvestment * 0.03) ; 
        ObjResidentInvestor.val(ResidentInvestor);
        
        //Stamp Duty =SUM(C4:C6) => Resident + ResidentInvestor + ForeignInvestor
        StampDuty                 = Resident + ResidentInvestor;
        ObjStampDuty.val( Math.round(StampDuty) );
        
        LeaseRegistration         = GetUKLandLeaseRegisterAmt(DuvalDynamicPrice);
        ObjLeaseRegistration.val(LeaseRegistration);
        */
    };
  
	

	var CalcFn = function(){
	    <?php 
	    if ($countryid == "UK"){
	        echo "UkCalcFn(); ";     
	    }
	    ?>
	    
	    <?php 
	    if ($countryid == "AU"){
	        echo "AuCalcFn(); ";     
	    }
	    ?>
	    
	    
	    
		DuvalDynamicPrice		= FnNulltoAmt( $("#DuvalDynamicPrice").val() ); 
		StampDuty				= FnNulltoAmt( $("#StampDuty").val() ); 
		LegalFees				= FnNulltoAmt( $("#LegalFees").val() ); 
		StagePay1Per			= FnNulltoAmt( $("#StagePay1Per").val() ); 
		StagePay2Per			= FnNulltoAmt( $("#StagePay2Per").val() ); 
		LoanAmountPer			= FnNulltoAmt( $("#LoanAmountPer").val() ); 
		LeaseRegistration		= FnNulltoAmt( $("#LeaseRegistration").val() ); 
		ResetrvationFees		= FnNulltoAmt( $("#ResetrvationFees").val() ); 
		MortgageRegistration    = FnNulltoAmt( $("#MortgageRegistration").val() ); 
		LandTransfer            = FnNulltoAmt( $("#LandTransfer").val() ); 
		
		
		LTV						= LoanAmountPer; 
        TransferFees		    = 0; 

		ObjTotalPurchaseCost	= $("#TotalPurchaseCost"); 
		ObjTransferFees			= $("#TransferFees");
		ObjStagePay1Amt			= $("#StagePay1Amt");
		ObjStagePay2Amt			= $("#StagePay2Amt");
		ObjTopup				= $("#Topup");
		ObjInitialLoanAmt		= $("#InitialLoanAmt");
		ObjLTV                  = $("#LTV");
        
        <?php if (countryid == "UK"){ ?>
		if (parseFloat(DuvalDynamicPrice) > 1)
			TransferFees		= 80
		<?php } ?>
		
		ObjTransferFees.val(TransferFees);
		

		TotalPurchaseCost		= parseFloat(DuvalDynamicPrice) + parseFloat(StampDuty) + parseFloat(LegalFees) + parseFloat(TransferFees) + parseFloat(LeaseRegistration) + MortgageRegistration + LandTransfer;
		ObjTotalPurchaseCost.val(TotalPurchaseCost); 
		
		//console.log(TotalPurchaseCost);

		StagePay1Amt			= parseFloat(DuvalDynamicPrice) * parseFloat(StagePay1Per) / 100; 
		StagePay2Amt			= parseFloat(DuvalDynamicPrice) * parseFloat(StagePay2Per) / 100; 

		Topup					= ((100 - LoanAmountPer) * DuvalDynamicPrice / 100) - ResetrvationFees - StagePay1Amt - StagePay2Amt; 
		InitialLoanAmt			= LTV * DuvalDynamicPrice / 100; 

		ObjStagePay1Amt.val(StagePay1Amt);
		ObjStagePay2Amt.val(StagePay2Amt);
		ObjTopup.val(Topup);
		ObjInitialLoanAmt.val(InitialLoanAmt);
		ObjLTV.val(LTV); 
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