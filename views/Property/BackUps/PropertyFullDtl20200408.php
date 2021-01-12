 <?php include "header.php"; ?>

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








$Propertyrows = self::GetPropertiesDatas($ProprtyId,'','');

foreach ($Propertyrows as $Propertyrow) 
{
   
   $ProjectName					= $Propertyrow["project_name"]      ? $Propertyrow["project_name"]     : "";
   $building					= $Propertyrow["building"]          ? $Propertyrow["building"]         : "";
   $apartment_no				= $Propertyrow["apartment_no"]      ? $Propertyrow["apartment_no"]     : "";
   $UnitSize					= $Propertyrow["land_area"]         ? $Propertyrow["land_area"]        : "0";
   $UnitType					= $Propertyrow["no_of_bedrooms"]    ? $Propertyrow["no_of_bedrooms"]   : "0";
   $Purchaseprice			    = $Propertyrow["dpo_rate"]           ? $Propertyrow["dpo_rate"]        : "0";
   $countryid			        = $Propertyrow["country"]            ? $Propertyrow["country"]         : "";
  
  	

   
}


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

}


    $ipglbclientfeeAmt                  =  - floatval($ip_glb_client_fee)  ;
    
    $ResDepositPercntage                =    floatval($ReservationDeposit) / 100;
    $ReservationDepositAmt              =    -(floatval($Purchaseprice) *   floatval($ResDepositPercntage));
    
    $ConveyancingfeesAmt                =  - floatval($Conveyancingfees)  ;
    
    $LandregistryfeesAmt                =  - floatval($Landregistryfees)  ;
     
    $EngrossmentfeesAmt                 =  - floatval($Engrossmentfees)  ;
    
    $PaymentResExcAmount                =   floatval($ipglbclientfeeAmt) +  floatval($ReservationDepositAmt) +  floatval($ConveyancingfeesAmt) +  floatval($LandregistryfeesAmt) +  floatval($EngrossmentfeesAmt);

    
    $FinalcapitalpaymentAmt             =  - (floatval($Finalcapitalpayment)  *  floatval($Purchaseprice));
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
     
 
    
    $Paymentonreservation                   =    floatval($PaymentResExcAmount);
    $FurtherdepositTotal                    =    floatval($FurtherDepositAmt);
    $PaymentPropComp                        =    floatval($PaymentOnCompleteion);
    $TotalEquiltyRequiredVal                =    floatval($TotalEquityRequired);
    $MortgagePrincipleTotal                 =    floatval($TotalMortgageAmount);
    
     $Projectedmonthlycash                  =   0;
     $MortgageInterestOnly                  =   0;
     $MonthlyIncome                         =   0;
    


/*$PrtyChkArr               				= \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(property_master_auto_id) AS CNT FROM property_details_master WHERE PROPERTY_ID='".$ProprtyId."')");
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
*/


?>

<div class="row">
   <!-- property content -->
   <div class="col-lg-8">
      <div class="card h-100 mb-0">
         <div class="card-body">
            <div class="card-title"><a class="text-dark" href="#">
                <h4 class="heading-primary"><?php echo $apartment_no; ?>|<?php echo $building; ?>|<?php echo $ProjectName; ?> | <?php echo $countryid; ?></h4>
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

              <div class="form-row mt-3">
                  <div class="form-group col-6">
                      <label>Project</label>
                      <input class="form-control" type="text" name="" value="<?php echo $building;?>" readonly>
                  </div>  
                  <div class="form-group col-md-2">
                      <label>Unit</label>
                      <select class="form-control" name="Unit" id="Unit" >
                        <option value="">Unit</option>
                        <?php
                            for($i=1; $i<=40; $i++){
                        ?>
                             <option value="<?php echo $i; ?>" <?php if( $i == $Unit ) { ?> selected <?php } ?>  > <?php echo $i; ?> </option>
                        <?php
                            }
                        ?>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                        <label>First-time buyer</label>
                        <select class="form-control" name="firsttimebuyer" id="firsttimebuyer" >
                            <option value="No"  <?php if( $firsttimebuyer == "No" ) { ?> selected <?php } ?>  >No</option>
                            <option value="Yes" <?php if( $firsttimebuyer == "Yes" ) { ?> selected <?php } ?>  >Yes</option>
                        </select>
                  </div>
                  <div class="form-group col-md-4">
                        <label>Rental Guarantee</label>
                        <select class="form-control" name="RentalGuarantee" id="RentalGuarantee" >
                            <option value="No"  <?php if( $RentalGuarantee == "No" ) { ?> selected <?php } ?>  >No</option>
                            <option value="Yes" <?php if( $RentalGuarantee ==  "Yes" ) { ?> selected <?php } ?>  >Yes</option>
                        </select>
                  </div>
                  <div class="form-group col-md-4">
                        <label>Furniture pack</label>
                        <select class="form-control" name="FurniturePackReq" id="FurniturePackReq" >
                            <option value="No"  <?php if( $FurniturePackReq == "No" ) { ?> selected <?php } ?>  >No</option>
                            <option value="Yes" <?php if( $FurniturePackReq == "Yes" ) { ?> selected <?php } ?> >Yes</option>
                            
                        </select>
                  </div>
                  <div class="form-group col-md-4">
                      <label>Unit size (sqf)</label>
                      <input class="form-control" type='text' name='UnitSize' id='UnitSize' value='<?php echo $UnitSize; ?>'>
                  </div>
                  <div class="form-group col-md-4">
                      <label>Unit type (beds)</label>
                      <input class="form-control" type='text' name='UnitType' id='UnitType' value='<?php echo $UnitType; ?>'>
                  </div>
                  <div class="form-group col-md-4">
                      <label>Purchase price</label>
                      <input class="form-control" type='text' name='Purchaseprice' id='Purchaseprice' value='<?php echo $Purchaseprice; ?>'>
                  </div>
                  <!-- <div class="form-group col-md-8">
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
                  </div> -->
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
                              <div class="card-body">
                                 <h4 class="card-title">Initial Costs</h4>
                                 <div class="table-responsive">
                                    <table class="table">
                                       <tr>
                                          <th colspan=2>&nbsp;</th>
                                          <th><?Php echo $Currency; ?></th>
                                          <th style='display:none;' >HKD</th>
                                          <th>Additional Notes</th>
                                       </tr>
                                       <tr>
                                          <td>IP Global client fee</td>
                                          <td>
                                          <div class="input-group">
                                            <input class="form-control" type='text' name='pglbclientfee' id='ipglbclientfee' numeric='true' value='<?php echo $ip_glb_client_fee; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Per Unit</span>
                                              </div>
                                            </div>
                                          </td>
                                          <td><input class="form-control" type='text' name='ipglbclientfeeAmt' id='ipglbclientfeeAmt' numeric='true' value='<?php echo $ipglbclientfeeAmt; ?>'>&nbsp;&nbsp;</td>
                                          <td style='display:none;'><input class="form-control" type='text' name='ipglbclientfeeSecAmt' id='ipglbclientfeeSecAmt' numeric='true' value='<?php echo $ipglbclientfeeSecAmt; ?>'>&nbsp;&nbsp;</td>
                                          <td><textarea class="form-control" name='ipglbclientfeeRemarks' id='ipglbclientfeeRemarks'  rows="2" cols=15 ><?php echo $ipglbclientfeeRemarks; ?></textarea></td>
                                       </tr>
                                       <tr>
                                          <td>Reservation Deposit</td>
                                          <td>

                                            <div class="input-group">
                                                <input class="form-control" type='text' name='ReservationDeposit' id='ReservationDeposit' value='<?php echo $ReservationDeposit; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">of Purchase Price</span>
                                              </div>
                                            </div>    

                                          </td>
                                          <td><input class="form-control" type='text' name='ReservationDepositAmt' id='ReservationDepositAmt' value='<?php echo $ReservationDepositAmt; ?>'>&nbsp;&nbsp;</td>
                                          <td style='display:none;' ><input type='text' name='ReservationDepositSecAmt' id='ReservationDepositSecAmt' value='<?php echo $ReservationDepositSecAmt; ?>'>&nbsp;&nbsp;</td>
                                          <td><textarea class="form-control" name='ReservationDepositRemarks' id='ReservationDepositRemarks'  rows="2" cols=15 ><?php echo $ReservationDepositRemarks; ?></textarea></td>
                                       </tr>
                                       <tr>
                                          <td>Conveyancing fees(Inc VAT)</td>
                                          <td>
                                          <div class="input-group">
                                            <input class="form-control" type='text' name='Conveyancingfees' id='Conveyancingfees' value='<?php echo $Conveyancingfees; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">based on Riseam Sharples</span>
                                              </div>
                                            </div>  

                                          </td>
                                          <td><input class="form-control" type='text' name='ConveyancingfeesAmt' id='ConveyancingfeesAmt' value='<?php echo $ConveyancingfeesAmt; ?>'>&nbsp;&nbsp;</td>
                                          <td style='display:none;' ><input type='text' name='ConveyancingfeesSecAmt' id='ConveyancingfeesSecAmt' value='<?php echo $ConveyancingfeesSecAmt; ?>'>&nbsp;&nbsp;</td>
                                          <td><textarea class="form-control" name='ConveyancingfeesRemarks' id='ConveyancingfeesRemarks'  rows="2" cols=15 ><?php echo $ConveyancingfeesRemarks; ?></textarea></td>
                                       </tr>
                                       <tr>
                                          <td>Land registry fees</td>
                                          <td>

                                          <div class="input-group">
                                                <div class="input-group-append">
                                                    <input class="form-control" type='text' name='Landregistryfees' id='Landregistryfees' value='<?php echo $Landregistryfees; ?>'>
                                                <span class="input-group-text" id="basic-addon2">based on UK Dpt of Land Reg. Req</span>
                                              </div>
                                            </div>  
                                          </td>
                                          <td><input class="form-control" type='text' name='LandregistryfeesAmt' id='LandregistryfeesAmt' value='<?php echo $LandregistryfeesAmt; ?>'>&nbsp;&nbsp;</td>
                                          <td style='display:none;'><input class="form-control" type='text' name='LandregistryfeesSecAmt' id='LandregistryfeesSecAmt' value='<?php echo $LandregistryfeesSecAmt; ?>'>&nbsp;&nbsp;</td>
                                          <td><textarea class="form-control" name='LandregistryfeesRemarks' id='LandregistryfeesRemarks'  rows="2" cols=15 ><?php echo $LandregistryfeesRemarks; ?></textarea></td>
                                       </tr>
                                       <tr>
                                          <td>Engrossment fees</td>
                                          <td>

                                          <div class="input-group">
                                                <input class="form-control" type='text' name='Engrossmentfees' id='Engrossmentfees' value='<?php echo $Engrossmentfees; ?>'>
                                                <div class="input-group-append">
                                                    
                                                    <span class="input-group-text" id="basic-addon2">Per Unit</span>
                                                </div>
                                            </div>  
                                          </td>
                                          <td><input class="form-control" type='text' name='EngrossmentfeesAmt' id='EngrossmentfeesAmt' value='<?php echo $EngrossmentfeesAmt; ?>'>&nbsp;&nbsp;</td>
                                          <td style='display:none;' ><input type='text' name='EngrossmentfeesSecAmt' id='EngrossmentfeesSecAmt' value='<?php echo $EngrossmentfeesSecAmt; ?>'>&nbsp;&nbsp;</td>
                                          <td><textarea class="form-control" name='EngrossmentfeesRemarks' id='EngrossmentfeesRemarks'  rows="2" cols=15 ><?php echo $EngrossmentfeesRemarks; ?></textarea></td>
                                       </tr>
                                       <tr>
                                          <td colspan=2>Payment on Reservation Exchange</td>
                                          <td><?php echo $PaymentResExcAmount; ?><input class="form-control"  type='hidden' name='PaymentResExcAmount' id='PaymentResExcAmount' value='<?php echo $PaymentResExcAmount; ?>'></td>
                                          <td style='display:none;' align='right' >0<input class="form-control" type='hidden' name='PaymentResExcSecAmount' id='PaymentResExcSecAmount' value='<?php echo $PaymentResExcSecAmount; ?>'></td>
                                          <td>&nbsp;</td>
                                       </tr>
                                       <tr style='display:none;' >
                                          <td colspan=2>Further 0% Deposit(0 weekd after exchange)</td>
                                          <td ><?php echo $FurtherDepositAmt; ?><input class="form-control" type='hidden' name='FurtherDepositAmt' id='FurtherDepositAmt' value='<?php echo $FurtherDepositAmt; ?>'></td>
                                          <td style='display:none;'  align='right' >0<input type='hidden' name='FurtherDepositSecAmt' id='FurtherDepositSecAmt' value='<?php echo $FurtherDepositSecAmt; ?>'></td>
                                          <td>&nbsp;</td>
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
                          <a id="right" class="btn btn-outline-dark" href="#next">Mortgage Requirements <i class="fa fa-chevron-right"></i></a>
                       </div>
                     </div>
                  </section>
                  <!-- end loan and purchase -->
                  <!-- Rent & Expenses -->
                  <h3>Mortgage Requirements </h3>
                  <section>
                     <!-- purchase details-->
                     <div class="card my-4">
                        <div class="card-body">
                           <h4 class="card-title">Mortgage Requirements </h4> 
                           <div class="table-responsive">
                              <table class="table">
                                 <tr>
                                    <td>Mortgage Type</td>
                                    <td>
                                       <select class="form-control" name='MortgageType' id='MortgageType' >
                                          <option value='None' <?php if( $MortgageType == "None" ) { ?> selected <?php } ?>  >None</option>
                                          <option value='IntersertOnly' <?php if( $MortgageType == "IntersertOnly" ) { ?> selected <?php } ?>  >Intersert Only</option>
                                          <option value='Repayment'     <?php if( $MortgageType == "Repayment" ) { ?> selected <?php } ?>  >Repayment</option>
                                       </select>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Mortgage Lending Value</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='type' name='MortgageLendingVal' id='MortgageLendingVal' value='<?php echo $MortgageLendingVal; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">%</span>
                                              </div>
                                            </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Mortgage Rate</td>
                                    <td><input class="form-control" type='type' name='MortgageRate' id='MortgageRate' value='<?php echo $MortgageRate; ?>'></td>
                                 </tr>
                                 <tr>
                                    <td>Loan Term (Yrs)</td>
                                    <td><input class="form-control" type='type' name='MortgageLongTerm' id='MortgageLongTerm' value='<?php echo $MortgageLongTerm; ?>'></td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                     <!-- end purchase details-->
                     <div class="row">
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-left">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fa fa-chevron-left"></i> Mortgage Requirements</a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-right">
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
                        <div class="card-body">
                           <h4 class="card-title">Final costs at completion</h4> 
                           <div class="table-responsive">
                              <table class="table">
                                 <tr>
                                    <td>Final capital payment</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='Finalcapitalpayment' id='Finalcapitalpayment' value='<?php echo $Finalcapitalpayment; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">of Purchase Price</span>
                                              </div>
                                            </div>    
                                    </td>
                                    <td><input class="form-control" type='text' name='FinalcapitalpaymentAmt' id='FinalcapitalpaymentAmt' value='<?php echo $FinalcapitalpaymentAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td style='display:none;' ><input class="form-control" type='text' name='FinalcapitalpaymentSecAmt' id='FinalcapitalpaymentSecAmt' value='<?php echo $FinalcapitalpaymentSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='FinalcapitalpaymentRemarks' id='FinalcapitalpaymentRemarks'  rows="2" cols=15 ><?php echo $FinalcapitalpaymentRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td>Stamp duty</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='Stampduty' id='Stampduty' value='<?php echo $Stampduty; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Based on the Purchase Price</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='StampdutyAmt' id='StampdutyAmt' value='<?php echo $StampdutyAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td style='display:none;' ><input type='text' name='StampdutySecAmt' id='StampdutySecAmt' value='<?php echo $StampdutySecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='StampdutyRemarks' id='StampdutyRemarks'  rows="2" cols=15 ><?php echo $StampdutyRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td>Liquid Expat broker costs</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='LiquidExpatbrokercosts' id='LiquidExpatbrokercosts' value='<?php echo $LiquidExpatbrokercosts; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">of the Loan Amount</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='LiquidExpatbrokercostsAmt' id='LiquidExpatbrokercostsAmt' value='<?php echo $LiquidExpatbrokercostsAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td style='display:none;' ><input class="form-control" type='text' name='LiquidExpatbrokercostsSecAmt' id='LiquidExpatbrokercostsSecAmt' value='<?php echo $LiquidExpatbrokercostsSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='LiquidExpatbrokercostsRemarks' id='LiquidExpatbrokercostsRemarks'  rows="2" cols=15 ><?php echo $LiquidExpatbrokercostsRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td>Lender arrangement fee</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='Lenderarrangementfee' id='Lenderarrangementfee' value='<?php echo $Lenderarrangementfee; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">of the Loan Amount</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='LenderarrangementfeeAmt' id='LenderarrangementfeeAmt' value='<?php echo $LenderarrangementfeeAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td style='display:none;' ><input class="form-control" type='text' name='LenderarrangementfeeSecAmt' id='LenderarrangementfeeSecAmt' value='<?php echo $LenderarrangementfeeSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='LenderarrangementfeeRemarks' id='LenderarrangementfeeRemarks'  rows="2" cols=15 ><?php echo $LenderarrangementfeeRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td>Valuation fee (Inc. VAT)</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='Valuationfee' id='Valuationfee' value='<?php echo $Valuationfee; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Based on the Purchase Price</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='ValuationfeeAmt' id='ValuationfeeAmt' value='<?php echo $ValuationfeeAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td style='display:none;' ><input type='text' name='ValuationfeeSecAmt' id='ValuationfeeSecAmt' value='<?php echo $ValuationfeeSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='ValuationfeeRemarks' id='ValuationfeeRemarks'  rows="2" cols=15 ><?php echo $ValuationfeeRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td>Furniture pack (Inc. VAT)</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='Furniturepack' id='Furniturepack' value='<?php echo $Furniturepack; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Based on Unit Type</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='FurniturepackAmt' id='FurniturepackAmt' value='<?php echo $FurniturepackAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td style='display:none;' ><input class="form-control" type='text' name='FurniturepackSecAmt' id='FurniturepackSecAmt' value='<?php echo $FurniturepackSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='FurniturepackRemarks' id='FurniturepackRemarks'  rows="2" cols=15 ><?php echo $FurniturepackRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td>Complete Tenant find fee (Inc. VAT)</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='CompleteTenantfee' id='CompleteTenantfee' value='<?php echo $CompleteTenantfee; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Based on 1 Tenaunt</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='CompleteTenantfeeAmt' id='CompleteTenantfeeAmt' value='<?php echo $CompleteTenantfeeAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td style='display:none;' ><input class="form-control" type='text' name='CompleteTenantfeeSecAmt' id='CompleteTenantfeeSecAmt' value='<?php echo $CompleteTenantfeeSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='CompleteTenantfeeRemarks' id='CompleteTenantfeeRemarks'  rows="2" cols=15 ><?php echo $CompleteTenantfeeRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td>Complete Tenant agreement fee (Inc. VAT)</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='CompleteTenantagreementfee ' id='CompleteTenantagreementfee' value='<?php echo $CompleteTenantagreementfee; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Based on 1 Tenaunt</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='CompleteTenantagreementfeeAmt' id='CompleteTenantagreementfeeAmt' value='<?php echo $CompleteTenantagreementfeeAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td style='display:none;' ><input class="form-control" type='text' name='CompleteTenantagreementfeeSecAmt' id='CompleteTenantagreementfeeSecAmt' value='<?php echo $CompleteTenantagreementfeeSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='CompleteTenantagreementfeeRemarks' id='CompleteTenantagreementfeeRemarks'  rows="2" cols=15 ><?php echo $CompleteTenantagreementfeeRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td>Complete Handover fee (Inc. VAT)</td>
                                    <td>

                                        <div class="input-group">
                                            <input class="form-control" type='text' name='CompleteHandoverfee' id='CompleteHandoverfee' value='<?php echo $CompleteHandoverfee; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Based on Unit Type</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='CompleteHandoverfeeAmt' id='CompleteHandoverfeeAmt' value='<?php echo $CompleteHandoverfeeAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td style='display:none;' ><input class="form-control" type='text' name='CompleteHandoverfeeSecAmt' id='CompleteHandoverfeeSecAmt' value='<?php echo $CompleteHandoverfeeSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='CompleteHandoverfeeRemarks' id='CompleteHandoverfeeRemarks'  rows="2" cols=15 ><?php echo $CompleteHandoverfeeRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td>Complete Inventory fee (Inc. VAT)</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='CompleteInventoryfee' id='CompleteInventoryfee' value='<?php echo $CompleteInventoryfee; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Based on Unit Type</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='CompleteInventoryfeeAmt' id='CompleteInventoryfeeAmt' value='<?php echo $CompleteInventoryfeeAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td style='display:none;' ><input class="form-control" type='text' name='CompleteInventoryfeeSecAmt' id='CompleteInventoryfeeSecAmt' value='<?php echo $CompleteInventoryfeeSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='CompleteInventoryfeeRemarks' id='CompleteInventoryfeeRemarks'  rows="2" cols=15 ><?php echo $CompleteInventoryfeeRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td>Complete Reference Check (inc. VAT)</td>
                                    <td>

                                        <div class="input-group">
                                            <input class="form-control" type='text' name='CompleteReferenceCheck' id='CompleteReferenceCheck' value='<?php echo $CompleteReferenceCheck; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Based on 1 Tenaunt</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='CompleteReferenceCheckAmt' id='CompleteReferenceCheckAmt' value='<?php echo $CompleteReferenceCheckAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td style='display:none;' ><input class="form-control" type='text' name='CompleteReferenceCheckSecAmt' id='CompleteReferenceCheckSecAmt' value='<?php echo $CompleteReferenceCheckSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='CompleteReferenceCheckRemarks' id='CompleteReferenceCheckRemarks'  rows="2" cols=15 ><?php echo $CompleteReferenceCheckRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td>Client Fee Rebate on Completion </td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='ClientFeeRebateComp' id='ClientFeeRebateComp' value='<?php echo $ClientFeeRebateComp; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Per Unit</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='ClientFeeRebateCompAmt' id='ClientFeeRebateCompAmt' value='<?php echo $ClientFeeRebateCompAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td style='display:none;' ><input class="form-control" type='text' name='ClientFeeRebateCompSecAmt' id='ClientFeeRebateCompSecAmt' value='<?php echo $ClientFeeRebateCompSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='ClientFeeRebateCompRemarks' id='ClientFeeRebateCompRemarks'  rows="2" cols=15 ><?php echo $ClientFeeRebateCompRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td >Payment On Completeion</td>
                                    <td ><?php echo $PaymentOnCompleteion;?><input class="form-control" type='hidden' name='PaymentOnCompleteion' id='PaymentOnCompleteion' value='<?php echo $PaymentOnCompleteion; ?>'></td>
                                    <td align='right' style='display:none;' >0<input class="form-control" type='hidden' name='PaymentOnCompleteionSecAmount' id='PaymentOnCompleteionSecAmount' value='<?php echo $PaymentOnCompleteionSecAmount; ?>'></td>
                                    <td>&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Total Equity Required</td>
                                    <td ><?php echo $TotalEquityRequired; ?><input class="form-control" type='hidden' name='TotalEquityRequired' id='TotalEquityRequired' value='<?php echo $TotalEquityRequired; ?>'></td>
                                    <td align='right' >0<input class="form-control" type='hidden' name='TotalEquityRequiredSecAmount' id='TotalEquityRequiredSecAmount' value='<?php echo $TotalEquityRequiredSecAmount; ?>'></td>
                                    <td>&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Mortgage Amount</td>
                                    <td><?php echo $TotalMortgageAmount; ?><input class="form-control" type='hidden' name='TotalMortgageAmount' id='TotalMortgageAmount' value='<?php echo $TotalMortgageAmount; ?>'></td>
                                    <td align='right' >0<input type='hidden' name='TotalMortgageAmountSecAmount' id='TotalMortgageAmountSecAmount' value='<?php echo $TotalMortgageAmountSecAmount; ?>'></td>
                                    <td>&nbsp;</td>
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
                                     <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fa fa-chevron-left"></i> Final costs at completion</a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                         <div class="col-6">
                            <div class="analyser-submit-section">
                               <div class="btn-div text-right">
                                  <ul class="list-inline">
                                     <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Sanp Shot <i class="fa fa-chevron-right"></i> </a></li>
                                  </ul>
                               </div>
                            </div>
                         </div>
                      </div>
                  </section>
                  <!-- End Tax & MArket -->
                  <!-- Investment Return -->
                  <h3>Snap Shot</h3>
                  <section>
                     <!-- ASSIGN AN ENTITY -->
                     <div class="card my-4">
                        <div class="card-body">
                           <h4 class="card-title">Snap Shot</h4> 
                           <div class="table-responsive">
                              <table class="table">
                                 <tr>
                                    <td>Payment on reservation</td>
                                    <td><?php echo $Paymentonreservation; ?><input class="form-control" type='hidden' name='Paymentonreservation' id='Paymentonreservation' value='<?php echo $Paymentonreservation; ?>'></td>
                                    <td>Mortgage principle</td>
                                    <td><?php echo $MortgagePrincipleTotal; ?><input class="form-control" type='hidden' name='MortgagePrincipleTotal' id='MortgagePrincipleTotal' value='<?php echo $MortgagePrincipleTotal; ?>'></td>
                                 </tr>
                                 <tr>
                                    <td>Further deposit</td>
                                    <td><?php echo $FurtherdepositTotal; ?><input class="form-control" type='hidden' name='FurtherdepositTotal' id='FurtherdepositTotal' value='<?php echo $FurtherdepositTotal; ?>'></td>
                                    <td>Monthly income</td>
                                    <td><?php echo $MonthlyIncome; ?><input class="form-control" type='hidden' name='MonthlyIncome' id='MonthlyIncome' value='<?php echo $MonthlyIncome; ?>'></td>
                                 </tr>
                                 <tr>
                                    <td>Payment on property completion</td>
                                    <td><?php echo $PaymentPropComp; ?><input class="form-control" type='hidden' name='PaymentPropComp' id='PaymentPropComp' value='<?php echo $PaymentPropComp; ?>'></td>
                                    <td>Mortgage Interest Only</td>
                                    <td><?php echo $MortgageInterestOnly; ?><input class="form-control" type='hidden' name='MortgageInterestOnly' id='MortgageInterestOnly' value='<?php echo $MortgageInterestOnly; ?>'></td>
                                 </tr>
                                 <tr>
                                    <td>Total Equilty Required</td>
                                    <td><?php echo $TotalEquiltyRequiredVal; ?><input class="form-control" type='hidden' name='TotalEquiltyRequiredVal' id='TotalEquiltyRequiredVal' value='<?php echo $TotalEquiltyRequiredVal; ?>'></td>
                                    <td>Projected monthly cash pos.</td>
                                    <td><?php echo $Projectedmonthlycash; ?><input class="form-control" type='hidden' name='Projectedmonthlycash' id='Projectedmonthlycash' value='<?php echo $Projectedmonthlycash; ?>'></td>
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
                  <h3>Estimated monthly income</h3>
                  <section>
                     <!-- Estimated monthly income -->
                     <div class="card my-4">
                        <div class="card-body">
                           <h4 class="card-title">Estimated monthly income</h4> 
                           <div class="table-responsive">
                              <table class="table ">
                                 <tr>
                                    <td>Estimated Gross Rental Income</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='EstGrsRentalIncome' id='EstGrsRentalIncome' value='<?php echo $EstGrsRentalIncome; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Per Unit</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='EstGrsRentalIncomeAmt' id='EstGrsRentalIncomeAmt' value='<?php echo $EstGrsRentalIncomeAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td>&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Gross Yield</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='GrossYield' id='GrossYield' value='<?php echo $GrossYield; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Per Unit</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td colspan=2>&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>Service Charge</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='ServiceCharge' id='ServiceCharge' value='<?php echo $ServiceCharge; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Per Unit</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='ServiceChargeAmt' id='ServiceChargeAmt' value='<?php echo $ServiceChargeAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><input class="form-control" type='text' name='ServiceChargeSecAmt' id='ServiceChargeSecAmt' value='<?php echo $ServiceChargeSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='ServiceChargeRemarks' id='ServiceChargeRemarks'  rows="2" cols=15 ><?php echo $ServiceChargeRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td>Tenant Management Fee</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='TenantManagementFee' id='TenantManagementFee' value='<?php echo $TenantManagementFee; ?>'>
                                                <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">of Purchase Price</span>
                                              </div>
                                            </div>
                                    </td>
                                    <td><input class="form-control" type='text' name='TenantManagementFeeAmt' id='TenantManagementFeeAmt' value='<?php echo $TenantManagementFeeAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><input class="form-control" type='text' name='TenantManagementFeeSecAmt' id='TenantManagementFeeSecAmt' value='<?php echo $TenantManagementFeeSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='TenantManagementFeeRemarks' id='TenantManagementFeeRemarks'  rows="2" cols=15 ><?php echo $TenantManagementFeeRemarks; ?></textarea></td>
                                 </tr>
                                 <tr>
                                    <td>Ground Rent</td>
                                    <td>
                                        <div class="input-group">
                                            <input class="form-control" type='text' name='GroundRent' id='GroundRent' value='<?php echo $GroundRent; ?>'>
                                            <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">based on Riseam Sharples</span>
                                          </div>
                                        </div>

                                    </td>
                                    <td><input class="form-control" type='text' name='GroundRentAmt' id='GroundRentAmt' value='<?php echo $GroundRentAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><input class="form-control" type='text' name='GroundRentSecAmt' id='GroundRentSecAmt' value='<?php echo $GroundRentSecAmt; ?>'>&nbsp;&nbsp;</td>
                                    <td><textarea class="form-control" name='GroundRentRemarks' id='GroundRentRemarks'  rows="2" cols="15" ><?php echo $GroundRentRemarks; ?></textarea></td>
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
                  <!-- Results -->
                  <h3>Results</h3>
                  <section class="my-4">
                     <div class="row mb-4">
                        <div class="col-6 col-xxl-6">
                           <div class="card">
                              <div class="card-body">
                                 <h4 class="card-title">VARIABLES</h4>
                                 <div class="range-form-group text-center">
                                    <div class="form-group">
                                       <label>Loan to value ratio target(%) *</label>
                                       <div class="input-icon ml-auto mr-auto" style="max-width: 350px;">
                                          <input class="touchspin1 form-control" type="text" value="<?php echo $loan_value_ratio_growth; ?>" name="loan_value_ratio_growth" id="loan_value_ratio_growth">
                                       </div>
                                       <div class="range-container">
                                          <input type="range" min="0" max="100" step="1" value="<?php echo $loan_value_ratio_growth; ?>" id="loan_value_ratio_growthRange">
                                       </div>
                                    </div>
                                 </div>
                              </div>
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
                        <?php
                           $CapitalGrowthRate  = 6; 
                           ?>
                        <div class="col-12">
                           <div class="table-wrapper">
                              <div class="card">
                                 <input type="hidden" name="CapitalGrowthRate" id="CapitalGrowthRate" value="<?php echo $CapitalGrowthRate; ?>" />
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
                                       <tr class="heading-seprator bg-light">
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
                                       <tr class="heading-seprator bg-light">
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
                                       <tr class="heading-seprator bg-light">
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
                                       <tr class="heading-seprator bg-light">
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
                                       <tr class="heading-seprator bg-light">
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
                              <div class="btn-div text-left">
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
<script>


       $(document).on("keyup blur", "input[numeric='true']:enabled:not([readonly])", function (e) {

           JS_NumberChk(this);

       });



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


   
   
   
   
</script>
