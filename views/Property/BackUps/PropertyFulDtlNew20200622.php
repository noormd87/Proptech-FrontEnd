 <?php include "header.php"; 

 \login\loginClass::Init();

 $checkSession = \login\loginClass::CheckUserSessionIp();

 ?>



<?php

$ProprtyId  = $_REQUEST["id"];

$autoid     = $_REQUEST["autoid"] ? $_REQUEST["autoid"] : "";



$RecentAnalyse   	= isset($_REQUEST["RecentAnalyse"]) ? $_REQUEST["RecentAnalyse"] : "";







\Property\PropertyClass::Init();



$user_id   = \settings\session\sessionClass::GetSessionDisplayName();



/*

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

$vatpercentage				        = isset($_REQUEST["vatpercentage"])                 	        ? isset($_REQUEST["vatpercentage"])                     : "0"; 

$Resident				            = isset($_REQUEST["Resident"])                 	                ? isset($_REQUEST["Resident"])                          : ""; 

$ResidentInvestor				    = isset($_REQUEST["ResidentInvestor"])                 	        ? isset($_REQUEST["ResidentInvestor"])                  : ""; 

*/







//echo $ProprtyId;





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





if (!isset($countryid)){

    $countryid                  = isset($_REQUEST["countryid"]) ? $_REQUEST["countryid"] : "";

}



$LocationId                     = isset($_REQUEST["LocationId"]) ? $_REQUEST["LocationId"] : "";

$MyPortFolioName                = isset($_REQUEST["MyPortFolioName"]) ? $_REQUEST["MyPortFolioName"] : "";

$Subrub                         = isset($_REQUEST["Subrub"]) ? $_REQUEST["Subrub"] : "";

$MyPortfolioPropAddress         = isset($_REQUEST["MyPortfolioPropAddress"]) ? $_REQUEST["MyPortfolioPropAddress"] : "";





//https://duvalknowledge.com/PropTech/Property/PropertyFullDtl.html?id=&countryid=NZ&LocationId=&MyPortFolioName=tyedt&Subrub=&MyPortfolioPropAddress= Url link



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

   

   

   

   //Arsath Changes - Start / 19-Jun-2020

    $ChkPropAnsArr               	= \DBConn\DBConnection::getQueryFetchColumn("(SELECT count(*) FROM property_analyzer_inputs where userid='{$user_id}' and propertyid='{$ProprtyId}')");

    $PropAnsArr             		= $ChkPropAnsArr["0"]; // Arzath - 2020-06-18

    

    //echo 'PropAnsArr='. $PropAnsArr;



    if( $PropAnsArr > 0) {

        

        //echo "Enter";

        $rows = \Property\PropertyClass::GetPropertyComparison("",$ProprtyId,$autoid);

        foreach ($rows as $row) 

        {

            

                             

            //echo "hii";

        

        //$autoid				            = $row["autoid"];

        	$property_id 				= isset($row["propertyid"])                 ? $row["propertyid"] : "";

            $LocationId				= isset($row["LocationId"])                 ? $row["LocationId"] : "";

            $MyPortFolioName			= isset($row["property_name"])              ? $row["property_name"] : "";

            $Subrub				    = isset($row["location_name"])            ? $row["location_name"] : "";

            $MyPortfolioPropAddress   = isset($row["property_desc"])              ? $row["property_desc"] : "";

            $CountryId                        = isset($row["country_id"])              ? $row["country_id"] : "";



        	$OwnerOccupier					= $row["owneroccupier"]                 ? $row["owneroccupier"]         : "0";

        	$SecondHomeInvestment			= $row["secondhomeinvestment"]          ? $row["secondhomeinvestment"]  : "0";

        	$AUDynamicPrice					= $row["audynamicprice"]                ? $row["audynamicprice"]        : "0";

        	$Resident        		        = $row["resident"]                      ? $row["resident"]              : "0";

        	$ResidentInvestor        	    = $row["residentinvestor"]              ? $row["residentinvestor"]      : "0";

        	$NonResidentInvestor            = $row["NonResidentInvestor"]           ? $row["NonResidentInvestor"]   : "0";

        	$NonResidentInvestorAmt         = $row["NonResidentInvestorAmt"]        ? $row["NonResidentInvestorAmt"]: "0";

        	

        	$Purchaseprice        	      = $row["duvaldynamicprice"]             ? $row["duvaldynamicprice"]                : "0";

        	$Income        	              = $row["income"]                        ? $row["income"]                : "0";

        	$MarketPrice  			      = $row["marketprice"]                   ? $row["marketprice"]           : "0"; 

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

            $StagePay2Amt                   = $row["StagePay2Amt"]                  ? $row["StagePay2Amt"]   : "0";

            $LoanAmountPer                  = $row["stagepay2amt"]                  ? $row["stagepay2amt"]   : "0";

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

                    	

        	

            //echo 'autoid='.	$autoid	;

        }

    }

   //Arsath Changes - End   / 19-Jun-2020

   

   

    //Yasir / 23-May-2020 / Hardcode Analyzer Input Values (start)

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

    

    //$countryid = "AU";  //hardcode for testing

    if ($countryid == "GB"){

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

            <form class="dpo-form"  action="<?php echo SITE_BASE_URL;?>/Property/propertysave.html?buttonaction=<?php echo $action;?>&property_id=<?php echo $ProprtyId;?>" method="post">

                <input type="hidden" name="countryid" id="countryid" value="<?php echo $countryid;?>" />

                <input type="hidden" name="property_id" id="property_id" value="<?php echo $ProprtyId;?>" />

                

                <input type="hidden" name="LocationId" id="LocationId" value="<?php echo $LocationId;?>" />

                <input type="hidden" name="MyPortFolioName" id="MyPortFolioName" value="<?php echo $MyPortFolioName;?>" />

                <input type="hidden" name="SubrubSubrub" id="Subrub" value="<?php echo $Subrub;?>" />

                <input type="hidden" name="MyPortfolioPropAddress" id="MyPortfolioPropAddress" value="<?php echo $MyPortfolioPropAddress;?>" />

                

                
               <!-- analyser section --> 
               <div id="" class="">




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



               	<div class="accordion accordion-membership mt-4">
      <div class="card">
         <div class="card-header">
            <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
               <i class="fa" aria-hidden="true"></i>
               Inputs
            </h5>
         </div>
         <div id="collapseOne" class="collapse show" data-parent="">
            <div class="card-body">

                                 <h4 class="card-title">Financial Analysis for <?php echo $countryid; ?>: </h4>

                                 <div class="table-responsive">

                                    <?php if ($countryid == "GB"){ ?>

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

                                            <input type="hidden" name="Resident" id="Resident" value="<?php echo $Resident; ?>" />

                                            <input type="hidden" name="ResidentInvestor" id="ResidentInvestor" value="<?php echo $ResidentInvestor; ?>" />

                                            <input type="hidden" name="NonResidentInvestor" id="NonResidentInvestor" value="<?php echo $NonResidentInvestor; ?>" />

                                            

                                        </td>

                                     </tr>

                                     <tr>

                                        <td width="50%">Non Resident Investment</td>

                                        <td width="50%"><input class="form-control" type='type' name='NonResidentInvestorAmt' id='NonResidentInvestorAmt' rel='calculate' value='<?php echo $NonResidentInvestorAmt; ?>'></td>

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

                                     

                                     <?php if ($countryid == "GB"){ ?>

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
      </div>
      <div class="card">
         <div class="card-header">
            <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo5" aria-expanded="false" aria-controls="collapseTwo5">
               <i class="fa" aria-hidden="true"></i>
               Payments
            </h5>
         </div>
         <div id="collapseTwo5" class="collapse" data-parent="">
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
      </div>
      <div class="card">
         <div class="card-header">
            <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseThree6" aria-expanded="false" aria-controls="collapseThree6">
               <i class="fa" aria-hidden="true"></i>
               Rental Rate
            </h5>
         </div>
         <div id="collapseThree6" class="collapse" data-parent="">
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
      </div>
      <div class="card">
         <div class="card-header">
            <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
               <i class="fa" aria-hidden="true"></i>
               Expenses
            </h5>
         </div>
         <div id="collapse4" class="collapse" data-parent="#accordion4">
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
      </div>
      <div class="card">
         <div class="card-header">
            <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
               <i class="fa" aria-hidden="true"></i>
               Mortgage Information
            </h5>
         </div>
         <div id="collapse5" class="collapse" data-parent="#accordion5">
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
         </div>
      </div>
      <div class="card">
         <div class="card-header">
            <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
               <i class="fa" aria-hidden="true"></i>
               Growth Factors
            </h5>
         </div>
         <div id="collapse6" class="collapse" data-parent="#accordion6">
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
      </div>
      <div class="card">
         <div class="card-header">
            <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
               <i class="fa" aria-hidden="true"></i>
               Depreciation
            </h5>
         </div>
         <div id="collapse7" class="collapse" data-parent="#accordion7">
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
      </div>
   </div>
                  

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

        

        

    var GetPostDatasFn = function(){

        datavalues          = $(".dpo-form").serialize();

        

        /*

        firsttimebuyer      = FnCheckNull( $("[name='firsttimebuyer']").val() ); 

        RentalGuarantee     = FnCheckNull( $("[name='RentalGuarantee']").val() ); 

        FurniturePackReq    = FnCheckNull( $("[name='FurniturePackReq']").val() ); 

        UnitSize            = FnCheckNull( $("[name='UnitSize']").val() ); 

        UnitType            = FnCheckNull( $("[name='UnitType']").val() ); 

        Purchaseprice       = FnCheckNull( $("[name='Purchaseprice']").val() ); 

        

        other_datas         = "&Purchaseprice=" + Purchaseprice + "&firsttimebuyer=" + firsttimebuyer + "&RentalGuarantee=" + RentalGuarantee + "&FurniturePackReq=" + FurniturePackReq + 