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
   
   //$countryid  = "AU";
   
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
            <div id="" class="">

               <!-- results -->	
               <div class="">

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

                           

                           <div class="">
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
                                    <td width="50%">Resident Status</td>
                                    <td width="50%">
                                       <input type="radio" name="ResidentStatus" id="ResidentStatus1" value="Resident" checked >
                                       <label for="ResidentStatus1">Resident</label>
                                       
                                       <input type="radio" name="ResidentStatus" id="ResidentStatus2" value="NRI" >
                                       <label for="ResidentStatus2">NRI</label>
                                    </td>
                                 </tr>
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



<div class="row">
	<div class="form-group col-md-4">
		<label>Income</label>
		<input class="form-control" type='type' name='Income' id='Income' rel='calculate' value='<?php echo $Income; ?>'>
	</div>
	<div class="form-group col-md-4">
		<label>Market Price</label>
		<input class="form-control" type='type' name='MarketPrice' id='MarketPrice' rel='calculate' value='<?php echo $MarketPrice; ?>'>
	</div>
	<div class="form-group col-md-4">
		<label>DuVal Dynamic Price ™</label>
		<input class="form-control" type='type' name='DuvalDynamicPrice' id='DuvalDynamicPrice' rel='calculate' value='<?php echo $DuvalDynamicPrice; ?>' <?php echo $DuvalPriceReadOnly; ?>>
	</div>
	<div class="form-group col-md-4">
		<label>Stamp Duty</label>
		<input class="form-control" type='type' name='StampDuty' id='StampDuty' rel='calculate' value='<?php echo $StampDuty; ?>' >
	</div>
	<?php if ($countryid == "GB"){ ?>
	 <div class="form-group col-md-4">
	    <label>Lease Registration</label>
	    <input class="form-control" type='type' name='LeaseRegistration' id='LeaseRegistration' rel='calculate' value='<?php echo $LeaseRegistration; ?>' readonly>
	 </div>
	 <?php } ?>
	 <?php if ($countryid == "NZ"){ ?>
	 <div class="form-group col-md-4">
	    <label>Transfer Fees</label>
	    <input class="form-control" type='type' name='TransferFees' id='TransferFees' rel='calculate' value='<?php echo $TransferFees; ?>' readonly>
	 </div>
	 <?php } ?>
	 <?php if ($countryid == "AU"){ ?>
	 <div class="form-group col-md-4">
	    <label>Mortgage Registration</label>
	    <input class="form-control" type='type' name='MortgageRegistration' id='MortgageRegistration' rel='calculate' value='<?php echo $MortgageRegistration; ?>' readonly>
	 </div>
	 <div class="form-group col-md-4">
	    <label>Land Transfer</label>
	    <input class="form-control" type='type' name='LandTransfer' id='LandTransfer' rel='calculate' value='<?php echo $LandTransfer; ?>' readonly>
	 </div>
	 <?php } ?>
	 <div class="form-group col-md-4">
	    <label>Legal Fees</label>
	    <input class="form-control" type='type' name='LegalFees' id='LegalFees' rel='calculate' value='<?php echo $LegalFees; ?>'>
	 </div>
	 <div class="form-group col-md-4">
	    <div>Total Purchase Cost</div>
	    <input class="form-control" type='type' name='TotalPurchaseCost' id='TotalPurchaseCost' rel='calculate' value='<?php echo $TotalPurchaseCost; ?>' readonly>
	 </div>
</div>

                              
                                 
                              
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
					         <div class="row">
					               <div class="form-group col-md-4">
					                  <label>Reservation Fee</label>
					                  <input class="form-control" type='type' name='ResetrvationFees' id='ResetrvationFees' rel='calculate' value='<?php echo $ResetrvationFees; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Stage Payment 1 (%)</label>
					                  <input class="form-control" type='type' name='StagePay1Per' id='StagePay1Per' rel='calculate' value='<?php echo $StagePay1Per; ?>'>
					                  <input class="form-control mt-2" type='text' name='StagePay1Amt' id='StagePay1Amt' readonly rel='calculate' value='<?php echo $StagePay1Amt; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Stage Payment 2 (%)</label>
					                  <input class="form-control" type='type' name='StagePay2Per' id='StagePay2Per' rel='calculate' value='<?php echo $StagePay2Per; ?>'>
					                  <input class="form-control mt-2" type='text' name='StagePay2Amt' id='StagePay2Amt' readonly rel='calculate' value='<?php echo $StagePay2Amt; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Loan Amount (%)</label>
					                  <input class="form-control" type='type' name='LoanAmountPer' id='LoanAmountPer' rel='calculate' value='<?php echo $LoanAmountPer; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Top Up </label>
					                  <input class="form-control" type='type' name='Topup' id='Topup' rel='calculate' value='<?php echo $Topup; ?>' readonly>
					               </div>
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
					         <div class="row">
				               <div class="form-group col-md-4">
				                  <label>Weekly Rental</label>
				                  <input class="form-control" type='type' name='WeeklyRental' id='WeeklyRental' rel='calculate' value='<?php echo $WeeklyRental; ?>'>
				               </div>
				               <div class="form-group col-md-4">
				                  <label>Vacancy Rate (%)</label>
				                  <input class="form-control" type='type' name='VacancyRate' id='VacancyRate' rel='calculate' value='<?php echo $VacancyRate; ?>'>
				               </div>
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
					         <div class="row">
					               <div class="form-group col-md-4">
					                  <label>Letting Fees (%)</label>
					                  <input class="form-control" type='type' name='LettingFeeRate' id='LettingFeeRate' rel='calculate' value='<?php echo $LettingFeeRate; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Management Fees (%)</label>
					                  <input class="form-control" type='type' name='ManagementFees' id='ManagementFees' rel='calculate' value='<?php echo $ManagementFees; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Council/Property Tax (p.a.)</label>
					                  <input class="form-control" type='type' name='CouncilPropertyTax' id='CouncilPropertyTax' rel='calculate' value='<?php echo $CouncilPropertyTax; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Body Corporate/Strata/Service Charge (p.a.)</label>
					                  <input class="form-control" type='type' name='CodyCorporateServiceChg' id='CodyCorporateServiceChg' rel='calculate' value='<?php echo $CodyCorporateServiceChg; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Land Lease/Ground Rent (p.a.)</label>
					                  <input class="form-control" type='type' name='LandLeaseRentPa' id='LandLeaseRentPa' rel='calculate' value='<?php echo $LandLeaseRentPa; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Insurance (p.a.)</label>
					                  <input class="form-control" type='type' name='InsurancePa' id='InsurancePa' rel='calculate' value='<?php echo $InsurancePa; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Repairs and Maintenance (%)</label>
					                  <input class="form-control" type='type' name='RepairandMaintenance' id='RepairandMaintenance' rel='calculate' value='<?php echo $RepairandMaintenance; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Cleaning (per month)</label>
					                  <input class="form-control" type='type' name='CleaningPerMonth' id='CleaningPerMonth' rel='calculate' value='<?php echo $CleaningPerMonth; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Gardening (per month)</label>
					                  <input class="form-control" type='type' name='GardeningPerMonth' id='GardeningPerMonth' rel='calculate' value='<?php echo $GardeningPerMonth; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Service Contracts (p.a.)</label>
					                  <input class="form-control" type='type' name='ServiceContractsPa' id='ServiceContractsPa' rel='calculate' value='<?php echo $ServiceContractsPa; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Other </label>
					                  <input class="form-control" type='type' name='Other' id='Other' rel='calculate' value='<?php echo $Other; ?>'>
					               </div>
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
					         <div class="row">
					               <div class="form-group col-md-4">
					                  <label>LTV (%)</label>
					                  <input class="form-control" type='type' name='LTV' id='LTV' rel='calculate' value='<?php echo $LTV; ?>' readonly />
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Initial Loan Amount</label>
					                  <input class="form-control" type='type' name='InitialLoanAmt' id='InitialLoanAmt' rel='calculate' value='<?php echo $InitialLoanAmt; ?>' readonly />
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Interest Rate (%)</label>
					                  <input class="form-control" type='type' name='InterestRate' id='InterestRate' rel='calculate' value='<?php echo $InterestRate; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Term (Years)</label>
					                  <input class="form-control" type='type' name='TermYears' id='TermYears' rel='calculate' value='<?php echo $TermYears; ?>'>
					               </div>
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
					         <div class="row">
					               <div class="form-group col-md-4">
					                  <label>CPI (%)</label>
					                  <input class="form-control" type='type' name='CPI' id='CPI' rel='calculate' value='<?php echo $CPI; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Rental Growth (%)</label>
					                  <input class="form-control" type='type' name='RentalGrowth' id='RentalGrowth' rel='calculate' value='<?php echo $RentalGrowth; ?>'>
					               </div>
					               <div class="form-group col-md-4">
					                  <label>Capital Growth (%)</label>
					                  <input class="form-control" type='type' name='CapitalGrowth' id='CapitalGrowth' rel='calculate' value='<?php echo $CapitalGrowth; ?>'>
					               </div>
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



<div class="row">
	<?php if ($countryid == "AU"){ ?>
   <div class="form-group col-md-4">
      <label>Building</label>
      <input class="form-control" type='type' name='BuildingValue' id='BuildingValue' rel='calculate' value='<?php echo $BuildingValue; ?>'>
      <td>
         <input class="form-control mt-2" type='type' name='BuildingLife' id='BuildingLife' rel='calculate' value='<?php echo $BuildingLife; ?>'>
   </div>
   <?php } ?>
                  <div class="col-lg-12">
                     <label for="">Fixtures</label>
                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                           <span class="input-group-text">Value</span>
                        </div>
                        <input class="form-control" type='type' name='FixturesValue' id='FixturesValue' rel='calculate' value='<?php echo $FixturesValue; ?>'>
                     </div>
                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                           <span class="input-group-text">Life</span>
                        </div>
                        <input class="form-control" type='type' name='FixturesLife' id='FixturesLife' rel='calculate' value='<?php echo $FixturesLife; ?>'>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="">Furninute</label>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text">Value</span>
                           </div>
                           <input class="form-control" type='type' name='FurnitureValue' id='FurnitureValue' rel='calculate' value='<?php echo $FurnitureValue; ?>'>
                        </div>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text">Life</span>
                           </div>
                           <input class="form-control" type='type' name='FurnitureLife' id='FurnitureLife' rel='calculate' value='<?php echo $FurnitureLife; ?>'>
                        </div>
                     </div>
                  </div>
               </div>


					        
					      </div>
					      <!-- end Depreciation -->
					   </div>
					</div>
	               </div>
            </div>
            <!-- analyse button -->
            <button type="button" class="btn btn-primary" name="" id="analyseNow">ANALYSE</button>
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
   
    
   
    other_datas         = "&Purchaseprice=" + Purchaseprice + "&firsttimebuyer=" + firsttimebuyer + "&RentalGuarantee=" + RentalGuarantee + "&FurniturePackReq=" + FurniturePackReq + "&UnitSize=" + UnitSize + "&UnitType=" + UnitType; 
   
    */
   
    
   
    
   
    return datavalues;
   
   }; 
   
    
   
      
   
   $(document).ready(function(){
       CalcFn(); 
   
        $(document).on("blur change", "[rel='calculate']", function(){
       
            CalcFn();
       
        });
       
   
   
        $(document).on("click", "#analyseNow", function(){   //#analyser-t-3
       
            //alert();
       
            
       
            Obj     = $(".final-table").closest(".card-body");
       
            
       
            
       
            /*
       
            datavalues = $(".dpo-form").serialize();
       
            
       
           
       
           firsttimebuyer   = FnCheckNull( $("[name='firsttimebuyer']").val() ); 
       
           RentalGuarantee  = FnCheckNull( $("[name='RentalGuarantee']").val() ); 
       
           FurniturePackReq = FnCheckNull( $("[name='FurniturePackReq']").val() ); 
       
           UnitSize         = FnCheckNull( $("[name='UnitSize']").val() ); 
       
           UnitType         = FnCheckNull( $("[name='UnitType']").val() ); 
       
           Purchaseprice    = FnCheckNull( $("[name='Purchaseprice']").val() ); 
       
           
       
           other_datas  = "&Purchaseprice=" + Purchaseprice + "&firsttimebuyer=" + firsttimebuyer + "&RentalGuarantee=" + RentalGuarantee + "&FurniturePackReq=" + FurniturePackReq + "&UnitSize=" + UnitSize + "&UnitType=" + UnitType; 
       
            */
       
            
       
            pass_data       = GetPostDatasFn(); 
       
            
       
            $.ajax({
       
       type: "POST",
       
       url:"<?php echo SITE_BASE_URL;?>ajax/AnalyzerResult.html",
       
       data: pass_data
       
       }).done(function( data ) {
       
        //alert(data)
                    $("html,body").animate({ scrollTop: 0 }, "slow");  
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
   
   
   
   
   
   var AddToMyPortfolioFn = function(){
   
    pass_data       = GetPostDatasFn(); 
   
        
   
    $.ajax({
   
   type: "POST",
   
   url:"<?php echo SITE_BASE_URL;?>ajax/SaveAnalyzer.html",
   
   data: pass_data
   
   }).done(function( data ) {
   
   //alert(data)
   
            //Obj.html(data);
   
            alert(data); 
   
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
   
   
   
   ForeignInvestor           = 0 //Not used in excel
   
   
   
   ObjDuvalDynamicPrice      = $("#DuvalDynamicPrice"); 
   
   ObjResident               = $("#Resident");
   
   ObjResidentInvestor       = $("#ResidentInvestor");
   
   ObjNonResidentInvestor    = $("#NonResidentInvestor");
   
   ObjStampDuty              = $("#StampDuty");
   
   ObjLeaseRegistration      = $("#LeaseRegistration");
   
   
   
   
   
   DuvalDynamicPrice         = OwnerOccupier + SecondHomeInvestment + NonResidentInvestorAmt;
   
   $("#DuvalDynamicPrice").val( DuvalDynamicPrice );
   
   
   
   //Resident (Row 15) =SUMPRODUCT(--(C14>{125000;250000;925000;1500000}),(C14-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})    //C14 is Owner Occupier..
   
   Resident                  = GetGBResidentValueFn(OwnerOccupier);
   
   ObjResident.val(Resident); 
   
   
   
   //Resident Investor (Row 16) =SUMPRODUCT(--(C15>{125000;250000;925000;1500000}),(C15-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})+(C15*0.03)    //C15 is Investment or Second Home
   
   ResidentInvestor          = GetGBResidentValueFn(SecondHomeInvestment) + (SecondHomeInvestment * 0.03) ; 
   
   ObjResidentInvestor.val(ResidentInvestor);
   
   
   
   //Resident Investor (Row 16) =SUMPRODUCT(--(C15>{125000;250000;925000;1500000}),(C15-{125000;250000;925000;1500000}),{0.02;0.03;0.05;0.02})+(C15*0.03)    //C15 is Investment or Second Home
   
   NonResidentInvestor       = GetGBResidentValueFn(NonResidentInvestorAmt) + (NonResidentInvestorAmt * 0.05) ; 
   
   ObjNonResidentInvestor.val(NonResidentInvestor);
   
   
   
   //Stamp Duty =SUM(C4:C6) => Resident + ResidentInvestor + ForeignInvestor
   
   StampDuty                 = Resident + ResidentInvestor + NonResidentInvestor;
   
   ObjStampDuty.val( Math.round(StampDuty) );
   
   
   
   LeaseRegistration         = GetGBLandLeaseRegisterAmt(DuvalDynamicPrice);
   
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
   
      
           
              if (AUDynamicPrice > 1){
           
                MortgageReg          = 143.50; 
           
                LandTransfer         = 143.50; 
           
              }
           
      
   
      
   
    }else if(AuLocation == "NT"){
   
            /*
       
                              =ROUND(
       
                  IF(E13 >= 5000000,  0.0495   * (E13),
       
                  IF(E13 >= 3000000, 0.0575  * (E13),
       
                  IF(E13 >= 525000, 0.0495  * (E13),
       
                  IF(E13 <= 525000,  (0.06571441*(E13/1000)*(E13/1000)) + 15  * (E13 / 1000),
       
                  )))),)
       
            */
   
   
   
              if (AUDynamicPrice >= 5000000){
           
                  Resident          = Math.round( 0.0495  * Math.ceil(AUDynamicPrice)); 
           
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
   
        /*=ROUND(
   
              IF(F13 > 1000000, (ROUNDUP((F13-1000000)/100,0)*5.75) + 38025,
   
              IF(F13 > 540000,  (ROUNDUP((F13-540000)/100,0)*4.5) + 17325,
   
              IF(F13 > 75000,  (ROUNDUP((F13-75000)/100,0)*3.5) + 1050,
   
              IF(F13 > 5000,  (ROUNDUP((F13-5000)/100,0)*1.5),
   
              IF(F13 <5000, 0))))),)
   
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
   
      
   
                  if (AUDynamicPrice > 1){
               
                    MortgageReg          = 192; 
               
                    LandTransfer         = Math.round( (Math.ceil((AUDynamicPrice - 180000) / 10000) * 36) ) + 192; 
                  }
       
        
   
        
   
        //console.log((AUDynamicPrice - 180000) / 10000);
   
        //alert((AUDynamicPrice - 180000) / 10000));
   
       // =IF(F2>0,(((((ROUNDUP((B17-180000)/10000,0))*36)+192))))
   
       
   
      }else if(AuLocation == "SA"){
   
        /*=ROUND(
   
              IF(G13>500000, (ROUNDUP((G13-500000)/100,0)*5.5)+21330,
   
              IF(G13 > 300000, (ROUNDUP((G13-300000)/100,0)*5) + 11330,
   
              IF(G13 > 250000,  (ROUNDUP((G13-250000)/100,0)*4.75) + 8955,
   
              IF(G13 > 200000,  (ROUNDUP((G13-200000)/100,0)*4.25) + 6830,
   
              IF(G13 > 100000,  (ROUNDUP((G13-100000)/100,0)*4) + 2830,
   
              IF(G13 > 50000,  (ROUNDUP((G13-50000)/100,0)*3.5) + 1080,
   
              IF(G13 > 30000,  (ROUNDUP((G13-30000)/100,0)*3) + 480,
   
             IF(G13 > 12000,  (ROUNDUP((G13-12000)/100,0)*2) + 120,
   
              IF(G13 <12000, (ROUNDUP((G13)/100,0)*1) ))))))))),)
   
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
           
              
           
              if (AUDynamicPrice > 1){
           
                MortgageReg          = 138.51; 
           
                LandTransfer         = 212.22;
           
              }
           
      

   
    }else if(AuLocation == "VIC"){
   
        /*=ROUND(IF(I13>960001,I13*0.055,
   
        
   
        IF(I13>130001,(0.014*25000)+(0.024*(130000-25000))+(0.06*(I13-130000)),
   
        
   
        IF(I13>25001,(0.014*25000)+(0.024*(I13-25000)),I13*0.014))),)
   
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
   
    
   
    ObjDuvalDynamicPrice.val( AUDynamicPrice );
   
    ObjResident.val( Resident );
   
    ObjLandTransfer.val( LandTransfer );
   
    ObjStampDuty.val( Resident );
   
    ObjMortgageRegistration.val( MortgageReg );
   
    
   
    
   
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
          if ($countryid == "GB"){
          
              echo "GBCalcFn(); ";     
          
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
       
        
       
        <?php if ($countryid == "NZ"){ ?>
       
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