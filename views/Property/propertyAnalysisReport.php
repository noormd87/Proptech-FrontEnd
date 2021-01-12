<?php
include "header.php";


// echo "<pre>";
// print_r($_POST);
// die();


if ($Compare == "COMPARE")
{
    self::PropComp($autoid);
}
else
{
    if($autoid!="")
    {
        self::getDbValues($autoid);
    }
    else
    {
        self::Init();
    }
}
$ProprtyId                              = $_REQUEST["id"];
$ArrQueries                             = array();
$user_id                                = \settings\session\sessionClass::GetSessionDisplayName();
$property_id                            = self::$property_id;
$createddate                            = date("Y-m-d H:i:s");
$QueryStr                               = " delete from property_analyzer where propertyid = :propertyid, userid = :userid"; 
$ColValArr                              = array("propertyid" => $user_id, "propertyid" => $property_id);              
$QueryArr                               = array($QueryStr, $ColValArr);
$ArrQueries[]                           = $QueryArr;
$FlagValue                              = isset( $_REQUEST["FlagValue"]) ?  $_REQUEST["FlagValue"] : ""; 
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
$MortgageArr							= self::CalculateMortgage( $InitialLoanAmt, $InterestRate, $TermYears ); 
$CashFlowArr							= self::CashFlow( $InitialLoanAmt, $InterestRate, $TermYears );
$TotalInitialCashCost					= $CashFlowArr["1"]["TotalInitialCashCost"];
$EffectiveStampDutyRate					= $CashFlowArr["1"]["EffectiveStampDutyRate"];
$IRRArray								= array();
$IRRAfterTaxArray						= array();
foreach($CashFlowArr as $TempIRRArray)
{
	$IRRArray[]							= floatval($TempIRRArray["IRRTotalAnnualReturn"]);
	$IRRAfterTaxArray[]					= floatval($TempIRRArray["IRRTotalAnnualReturnAfterTax"]);
}
$f										= new \FinancialInterface\Financial();
$IRR									= number_format( $f->IRR($IRRArray) * 100, 2, ".", "");
$IRRAfterTax							= number_format( $f->IRR($IRRAfterTaxArray) * 100, 2, ".", "");
for ($i = 0; $i <= 10; $i++)
{
	if ($i == 0)
	{
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
	else
	{
	    $PrevPropertyValue              = $PropertyValue;
		$PropertyValue					= floatval($PropertyValue) + (floatval($PropertyValue) * floatval($CapitalGrowth) / 100 ) ;
		$ArryPtr						= (intval($i) * 12) - 1; 
		$ArrCount						= sizeof($MortgageArr);
		if (self::$IntOrPrincipalInt == "InterestOnly")
		{
		    $OutstandingMortgage	    = floatval($InitialLoanAmt); 
		}
		else
		{
		    $OutstandingMortgage	    = floatval(isset($MortgageArr[$ArryPtr]["CloseBal"]) ? $MortgageArr[$ArryPtr]["CloseBal"] : 0); 
		}
		$GrossIncome					= $CashFlowArr[$i]["GrossIncome"]; 
		if ($PropertyValue > 0)
		{    
		    $LoanToValue				= round(floatval($OutstandingMortgage) / floatval($PropertyValue) * 100);
		}
		else
		{ 
		    $LoanToValue				= 0;
		}
		$Equity							= floatval($PropertyValue) - floatval($OutstandingMortgage);
        $PropertyValForSurpEqui         = $InitialPropertyValue;
        if ($CountryId == "2")
        {
            $PropertyValForSurpEqui     = $PrevPropertyValue;
            $SurplusEquRate             = 0.2;
        }
        else if ($CountryId == "3")
        {
            $SurplusEquRate             = 0.3;
        }
        else
        {
            $SurplusEquRate             = 0.2;
        }
		$SurplusEquityBasedLTV			= $Equity - ($PropertyValForSurpEqui * floatval($SurplusEquRate));
		$AnnualAppn						= floatval(isset($MortgageArr[$ArryPtr]["AnnualAppn"]) ? $MortgageArr[$ArryPtr]["AnnualAppn"] : 0);
		$TotalAnnualReturn              = $AnnualAppn;
		$NetCashFlow					= floatval($CashFlowArr[$i]["NetCashFlow"]);
		if ($CountryId == "1")
		{
		    $MortgagePayment			= floatval(isset($CashFlowArr[$i]["MortgagePayment"]) ? $CashFlowArr[$i]["MortgagePayment"] : 0);
		    $AnnualInterest				= floatval(isset($MortgageArr[$ArryPtr]["AnnualInterest"]) ? $MortgageArr[$ArryPtr]["AnnualInterest"] : 0);
		    $AnnualPrincipal			= floatval(isset($MortgageArr[$ArryPtr]["AnnualPrincipal"]) ? $MortgageArr[$ArryPtr]["AnnualPrincipal"] : 0);
		}
		else
		{
		    $MortgagePayment			= floatval(isset($MortgageArr[$ArryPtr]["Payable"]) ? $MortgageArr[$ArryPtr]["Payable"] : 0);
		    $AnnualInterest				= floatval(isset($MortgageArr[$ArryPtr]["AnnualInterest"]) ? $MortgageArr[$ArryPtr]["AnnualInterest"] : 0);
		    $AnnualPrincipal			= floatval(isset($MortgageArr[$ArryPtr]["AnnualPrincipal"]) ? $MortgageArr[$ArryPtr]["AnnualPrincipal"] : 0);
		}
		$OperatigExpTotal				= floatval($CashFlowArr[$i]["OperatigExpTotal"]);
		$NonCashExpenses				= floatval($CashFlowArr[$i]["NonCashExpenses"]);
		$EstimatedTax					= floatval($CashFlowArr[$i]["TaxPayable"]);
		$TaxLossCfwdBalance				= floatval($CashFlowArr[$i]["TaxLossCfwdBalance"]);
		$NetCashFlowAfterTax			= floatval($NetCashFlow) - floatval($EstimatedTax);
		if ($CountryId == "2")
		{
		    $TotalAnnualReturn          = $TotalAnnualReturn + $NetCashFlow;
		}
		else if ($CountryId == "3")
		{
		    $TotalAnnualReturn          = $TotalAnnualReturn + $NetCashFlow;
		}
		else if ($CountryId == "1")
		{
		    $TotalAnnualReturn          = $TotalAnnualReturn + $GrossIncome - $OperatigExpTotal - $MortgagePayment; //MortgagePayment
		    
		}
		$TotalAnnualReturnAfterTax		= floatval($CashFlowArr[$i]["TotalAnnualReturnAfterTax"]);
	}
	$PurchasePriceTemp          = ($PurchasePrice == "") ? 0 : self::RoundAndFormat(floatval($PurchasePrice) );
	$TotalInitialCashCostTemp   = ($TotalInitialCashCost == "") ? 0 : self::RoundAndFormat(floatval($TotalInitialCashCost) );
    $TempArr = array(
        "propertyid" 						=> $property_id,
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
    $ColValArr  = array(
        "key_id" 						    => intval($i),
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
    $QueryStr = " insert into property_analyzer set propertyid = :propertyid, userid = :userid, year_no=:year_no, PurchasePrice = :PurchasePrice, 
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
if ( $HtmlArr == "ARRAY" )
{
    return $ValueArrColArr;
    exit;
}
else
{
	$Msg                        = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
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
    $SurplusEquityBasedLTVClass0        =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["SurplusEquityBasedLTV"]);
    $SurplusEquityBasedLTVClass1        =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["SurplusEquityBasedLTV"]);
    $SurplusEquityBasedLTVClass2        =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["SurplusEquityBasedLTV"]);
    $SurplusEquityBasedLTVClass3        =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["SurplusEquityBasedLTV"]);
    $SurplusEquityBasedLTVClass4        =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["SurplusEquityBasedLTV"]);
    $SurplusEquityBasedLTVClass5        =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["SurplusEquityBasedLTV"]);
    $SurplusEquityBasedLTVClass6        =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["SurplusEquityBasedLTV"]);
    $SurplusEquityBasedLTVClass7        =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["SurplusEquityBasedLTV"]);
    $SurplusEquityBasedLTVClass8        =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["SurplusEquityBasedLTV"]);
    $SurplusEquityBasedLTVClass9        =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["SurplusEquityBasedLTV"]);
    $SurplusEquityBasedLTVClass10       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["SurplusEquityBasedLTV"]);
    $AnnualAppnClass0                   =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["AnnualAppn"]);
    $AnnualAppnClass1                   =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["AnnualAppn"]);
    $AnnualAppnClass2                   =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["AnnualAppn"]);
    $AnnualAppnClass3                   =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["AnnualAppn"]);
    $AnnualAppnClass4                   =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["AnnualAppn"]);
    $AnnualAppnClass5                   =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["AnnualAppn"]);
    $AnnualAppnClass6                   =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["AnnualAppn"]);
    $AnnualAppnClass7                   =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["AnnualAppn"]);
    $AnnualAppnClass8                   =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["AnnualAppn"]);
    $AnnualAppnClass9                   =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["AnnualAppn"]);
    $AnnualAppnClass10                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["AnnualAppn"]);
    $NetCashFlowClass0                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["NetCashFlow"]);
    $NetCashFlowClass1                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["NetCashFlow"]);
    $NetCashFlowClass2                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["NetCashFlow"]);
    $NetCashFlowClass3                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["NetCashFlow"]);
    $NetCashFlowClass4                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["NetCashFlow"]);
    $NetCashFlowClass5                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["NetCashFlow"]);
    $NetCashFlowClass6                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["NetCashFlow"]);
    $NetCashFlowClass7                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["NetCashFlow"]);
    $NetCashFlowClass8                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["NetCashFlow"]);
    $NetCashFlowClass9                  =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["NetCashFlow"]);
    $NetCashFlowClass10                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["NetCashFlow"]);
    $TotalAnnualReturnClass0            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["TotalAnnualReturn"]);
    $TotalAnnualReturnClass1            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["TotalAnnualReturn"]);
    $TotalAnnualReturnClass2            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["TotalAnnualReturn"]);
    $TotalAnnualReturnClass3            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["TotalAnnualReturn"]);
    $TotalAnnualReturnClass4            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["TotalAnnualReturn"]);
    $TotalAnnualReturnClass5            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["TotalAnnualReturn"]);
    $TotalAnnualReturnClass6            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["TotalAnnualReturn"]);
    $TotalAnnualReturnClass7            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["TotalAnnualReturn"]);
    $TotalAnnualReturnClass8            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["TotalAnnualReturn"]);
    $TotalAnnualReturnClass9            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["TotalAnnualReturn"]);
    $TotalAnnualReturnClass10           =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["TotalAnnualReturn"]);
    $EstimatedTaxClass0                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["EstimatedTax"]);
    $EstimatedTaxClass1                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["EstimatedTax"]);
    $EstimatedTaxClass2                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["EstimatedTax"]);
    $EstimatedTaxClass3                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["EstimatedTax"]);
    $EstimatedTaxClass4                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["EstimatedTax"]);
    $EstimatedTaxClass5                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["EstimatedTax"]);
    $EstimatedTaxClass6                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["EstimatedTax"]);
    $EstimatedTaxClass7                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["EstimatedTax"]);
    $EstimatedTaxClass8                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["EstimatedTax"]);
    $EstimatedTaxClass9                 =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["EstimatedTax"]);
    $EstimatedTaxClass10                =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["EstimatedTax"]);
    $EstCummulativeTaxCreditClass0      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["EstCummulativeTaxCredit"]);
    $EstCummulativeTaxCreditClass1      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["EstCummulativeTaxCredit"]);
    $EstCummulativeTaxCreditClass2      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["EstCummulativeTaxCredit"]);
    $EstCummulativeTaxCreditClass3      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["EstCummulativeTaxCredit"]);
    $EstCummulativeTaxCreditClass4      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["EstCummulativeTaxCredit"]);
    $EstCummulativeTaxCreditClass5      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["EstCummulativeTaxCredit"]);
    $EstCummulativeTaxCreditClass6      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["EstCummulativeTaxCredit"]);
    $EstCummulativeTaxCreditClass7      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["EstCummulativeTaxCredit"]);
    $EstCummulativeTaxCreditClass8      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["EstCummulativeTaxCredit"]);
    $EstCummulativeTaxCreditClass9      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["EstCummulativeTaxCredit"]);
    $EstCummulativeTaxCreditClass10     =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["EstCummulativeTaxCredit"]);
    $NetCashFlowAfterTaxClass0          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["NetCashFlowAfterTax"]);
    $NetCashFlowAfterTaxClass1          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["NetCashFlowAfterTax"]);
    $NetCashFlowAfterTaxClass2          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["NetCashFlowAfterTax"]);
    $NetCashFlowAfterTaxClass3          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["NetCashFlowAfterTax"]);
    $NetCashFlowAfterTaxClass4          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["NetCashFlowAfterTax"]);
    $NetCashFlowAfterTaxClass5          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["NetCashFlowAfterTax"]);
    $NetCashFlowAfterTaxClass6          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["NetCashFlowAfterTax"]);
    $NetCashFlowAfterTaxClass7          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["NetCashFlowAfterTax"]);
    $NetCashFlowAfterTaxClass8          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["NetCashFlowAfterTax"]);
    $NetCashFlowAfterTaxClass9          =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["NetCashFlowAfterTax"]);
    $NetCashFlowAfterTaxClass10         =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["NetCashFlowAfterTax"]);
    $TotalAnnualReturnAfterTaxClass0    =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["TotalAnnualReturnAfterTax"]);
    $TotalAnnualReturnAfterTaxClass1    =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["TotalAnnualReturnAfterTax"]);
    $TotalAnnualReturnAfterTaxClass2    =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["TotalAnnualReturnAfterTax"]);
    $TotalAnnualReturnAfterTaxClass3    =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["TotalAnnualReturnAfterTax"]);
    $TotalAnnualReturnAfterTaxClass4    =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["TotalAnnualReturnAfterTax"]);
    $TotalAnnualReturnAfterTaxClass5    =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["TotalAnnualReturnAfterTax"]);
    $TotalAnnualReturnAfterTaxClass6    =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["TotalAnnualReturnAfterTax"]);
    $TotalAnnualReturnAfterTaxClass7    =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["TotalAnnualReturnAfterTax"]);
    $TotalAnnualReturnAfterTaxClass8    =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["TotalAnnualReturnAfterTax"]);
    $TotalAnnualReturnAfterTaxClass9    =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["TotalAnnualReturnAfterTax"]);
    $TotalAnnualReturnAfterTaxClass10   =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["TotalAnnualReturnAfterTax"]);
    $NetCashFlowMonthClass0             =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["NetCashFlowMonth"]);
    $NetCashFlowMonthClass1             =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["NetCashFlowMonth"]);
    $NetCashFlowMonthClass2             =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["NetCashFlowMonth"]);
    $NetCashFlowMonthClass3             =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["NetCashFlowMonth"]);
    $NetCashFlowMonthClass4             =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["NetCashFlowMonth"]);
    $NetCashFlowMonthClass5             =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["NetCashFlowMonth"]);
    $NetCashFlowMonthClass6             =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["NetCashFlowMonth"]);
    $NetCashFlowMonthClass7             =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["NetCashFlowMonth"]);
    $NetCashFlowMonthClass8             =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["NetCashFlowMonth"]);
    $NetCashFlowMonthClass9             =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["NetCashFlowMonth"]);
    $NetCashFlowMonthClass10            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["NetCashFlowMonth"]);
    $TotalAnnualReturnMonthClass0       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["TotalAnnualReturnMonth"]);
    $TotalAnnualReturnMonthClass1       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["TotalAnnualReturnMonth"]);
    $TotalAnnualReturnMonthClass2       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["TotalAnnualReturnMonth"]);
    $TotalAnnualReturnMonthClass3       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["TotalAnnualReturnMonth"]);
    $TotalAnnualReturnMonthClass4       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["TotalAnnualReturnMonth"]);
    $TotalAnnualReturnMonthClass5       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["TotalAnnualReturnMonth"]);
    $TotalAnnualReturnMonthClass6       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["TotalAnnualReturnMonth"]);
    $TotalAnnualReturnMonthClass7       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["TotalAnnualReturnMonth"]);
    $TotalAnnualReturnMonthClass8       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["TotalAnnualReturnMonth"]);
    $TotalAnnualReturnMonthClass9       =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["TotalAnnualReturnMonth"]);
    $TotalAnnualReturnMonthClass10      =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["TotalAnnualReturnMonth"]);
    $EstimatedTaxMonthClass0            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["EstimatedTaxMonth"]);
    $EstimatedTaxMonthClass1            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["EstimatedTaxMonth"]);
    $EstimatedTaxMonthClass2            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["EstimatedTaxMonth"]);
    $EstimatedTaxMonthClass3            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["EstimatedTaxMonth"]);
    $EstimatedTaxMonthClass4            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["EstimatedTaxMonth"]);
    $EstimatedTaxMonthClass5            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["EstimatedTaxMonth"]);
    $EstimatedTaxMonthClass6            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["EstimatedTaxMonth"]);
    $EstimatedTaxMonthClass7            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["EstimatedTaxMonth"]);
    $EstimatedTaxMonthClass8            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["EstimatedTaxMonth"]);
    $EstimatedTaxMonthClass9            =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["EstimatedTaxMonth"]);
    $EstimatedTaxMonthClass10           =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["EstimatedTaxMonth"]);
    $NetCashFlowAfterTaxMonthClass0     =        \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["NetCashFlowAfterTaxMonth"]);
    $NetCashFlowAfterTaxMonthClass1     =        \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["NetCashFlowAfterTaxMonth"]);
    $NetCashFlowAfterTaxMonthClass2     =        \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["NetCashFlowAfterTaxMonth"]);
    $NetCashFlowAfterTaxMonthClass3     =        \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["NetCashFlowAfterTaxMonth"]);
    $NetCashFlowAfterTaxMonthClass4     =        \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["NetCashFlowAfterTaxMonth"]);
    $NetCashFlowAfterTaxMonthClass5     =        \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["NetCashFlowAfterTaxMonth"]);
    $NetCashFlowAfterTaxMonthClass6     =        \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["NetCashFlowAfterTaxMonth"]);
    $NetCashFlowAfterTaxMonthClass7     =        \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["NetCashFlowAfterTaxMonth"]);
    $NetCashFlowAfterTaxMonthClass8     =        \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["NetCashFlowAfterTaxMonth"]);
    $NetCashFlowAfterTaxMonthClass9     =        \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["NetCashFlowAfterTaxMonth"]);
    $NetCashFlowAfterTaxMonthClass10    =        \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["NetCashFlowAfterTaxMonth"]);
    $TotalAnnualReturnAfterTaxMonthClass0  =     \ajax\ajaxClass::BelowZeroColor($ValueArr[0]["TotalAnnualReturnAfterTaxMonth"]);
    $TotalAnnualReturnAfterTaxMonthClass1  =     \ajax\ajaxClass::BelowZeroColor($ValueArr[1]["TotalAnnualReturnAfterTaxMonth"]);
    $TotalAnnualReturnAfterTaxMonthClass2  =     \ajax\ajaxClass::BelowZeroColor($ValueArr[2]["TotalAnnualReturnAfterTaxMonth"]);
    $TotalAnnualReturnAfterTaxMonthClass3  =     \ajax\ajaxClass::BelowZeroColor($ValueArr[3]["TotalAnnualReturnAfterTaxMonth"]);
    $TotalAnnualReturnAfterTaxMonthClass4  =     \ajax\ajaxClass::BelowZeroColor($ValueArr[4]["TotalAnnualReturnAfterTaxMonth"]);
    $TotalAnnualReturnAfterTaxMonthClass5  =     \ajax\ajaxClass::BelowZeroColor($ValueArr[5]["TotalAnnualReturnAfterTaxMonth"]);
    $TotalAnnualReturnAfterTaxMonthClass6  =     \ajax\ajaxClass::BelowZeroColor($ValueArr[6]["TotalAnnualReturnAfterTaxMonth"]);
    $TotalAnnualReturnAfterTaxMonthClass7  =     \ajax\ajaxClass::BelowZeroColor($ValueArr[7]["TotalAnnualReturnAfterTaxMonth"]);
    $TotalAnnualReturnAfterTaxMonthClass8  =     \ajax\ajaxClass::BelowZeroColor($ValueArr[8]["TotalAnnualReturnAfterTaxMonth"]);
    $TotalAnnualReturnAfterTaxMonthClass9  =     \ajax\ajaxClass::BelowZeroColor($ValueArr[9]["TotalAnnualReturnAfterTaxMonth"]);
    $TotalAnnualReturnAfterTaxMonthClass10 =     \ajax\ajaxClass::BelowZeroColor($ValueArr[10]["TotalAnnualReturnAfterTaxMonth"]);
    $IRRClass                              =     \ajax\ajaxClass::BelowZeroColor($IRR);
    $IRRAfterTaxClass                      =     \ajax\ajaxClass::BelowZeroColor($IRRAfterTax);
    $CountryName ="";
    if( $CountryId != "")
    {
        $ChkNameArr   = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_NAME FROM country_master WHERE COUNTRY_CODE ='{$CountryId}')");
        $CountryName    = $ChkNameArr["0"];
    }
    if($FlagValue != "R")
    {
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
        $HiddenViewComapre = " Style='display:none;";
    }
    ?>
    <div class="inner-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php
                    if(!isset($_REQUEST['edit']))
                    {
                        ?>
                        <button class="btn btn-orange mb-2 ml-3" onclick="AddToMyPortfolioFn();" ><?= $addvalue;?></button>
                        <?php
                    }
                    else
                    {
                        ?>
                        <button class="btn btn-orange mb-2 ml-3" onclick="AddToMyPortfolioFn();" >Update Portfolio</button>
                        <?php
                    }
                    if($FlagValue == "R")
                    {
                    ?>
                    <a class="btn btn-orange mb-2 ml-3" href='<?= SITE_BASE_URL;?>Portfolio/Portfolio.html?ViewCompare=R&IsEligible=Y&compareVal=Y'>VIEW COMPARISON</a>
                    <?php
                    }
                    ?>
                    <a class="btn btn-orange mb-2 ml-3" href='<?= SITE_BASE_URL;?>/Portfolio/Portfolio.html'>Back to My Portfolio</a>
	                <a class="btn btn-orange mb-2 ml-3" href='<?= SITE_BASE_URL;?>Portfolio/ProtfolioPropDetails.html?<?= $addUrl; ?>'>BACK</a>
                </div>
                <div class="panel panel-black mt-0">
                    <?php
                    if ( $MyPortFolioName != "" || $MyPortfolioPropAddress != ""  || $Subrub != "" )
                    {
                    ?>
                    <div class="panel-title">
                        <h2>Search Property: <?= $PropDetails; ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
    						    <td><b>Country Name</b></td>
    						    <td><b>Property Name</b></td>
    						    <td><b>Property Address</b></td>
    						    <td><b>Location</b></td>
    					    </tr>
                        </thead>
                        <tbody>
                            <tr>
    						    <td><?= $CountryName ; ?></td>
    						    <td><?= $MyPortFolioName; ?></td>
    						    <td><?= $MyPortfolioPropAddress; ?></td>
    						    <td><?= $Subrub ; ?></td>
    					    </tr>
                        </tbody>
                    </table>
                    <?php
                    }
                    ?>
                    <div class="panel-title">
                        <h2>OVERVIEW</h2>
                        <!--<span class="action">View Graph or table -->
                        <!--    <div class="btn-group" role="group">-->
                        <!--        <button type="button" class="btn btn-light"><i class="fas fa-table"></i></button>-->
                        <!--        <button type="button" class="btn btn-light"><i class="fas fa-chart-bar"></i></button>-->
                        <!--    </div>-->
                        <!--</span>-->
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
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
                        <tbody>
                            <tr>
                                <td>Purchase Price</td>
                                <td <?= $PurchasePriceClass; ?> ><?= $ValueArr[0]["PurchasePrice"]; ?></td>
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
                                <td <?= $TotalInitialCashCostClass; ?>><?= $ValueArr[0]["TotalInitialCashCost"]; ?></td>
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
                                <td <?= $EffectiveStampDutyRateClass; ?> ><?= $ValueArr[0]["EffectiveStampDutyRate"]; ?> %</td>
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
                                <td <?= $CapitalGrowthClass1; ?> > <?= $ValueArr[1]["CapitalGrowth"] ; ?>%</td>
                                <td <?= $CapitalGrowthClass2; ?> > <?= $ValueArr[2]["CapitalGrowth"] ; ?>%</td>
                                <td <?= $CapitalGrowthClass3; ?> > <?= $ValueArr[3]["CapitalGrowth"] ; ?>%</td>
                                <td <?= $CapitalGrowthClass4; ?> > <?= $ValueArr[4]["CapitalGrowth"] ; ?>%</td>
                                <td <?= $CapitalGrowthClass5; ?> > <?= $ValueArr[5]["CapitalGrowth"] ; ?>%</td>
                                <td <?= $CapitalGrowthClass6; ?> > <?= $ValueArr[6]["CapitalGrowth"] ; ?>%</td>
                                <td <?= $CapitalGrowthClass7; ?> > <?= $ValueArr[7]["CapitalGrowth"] ; ?>%</td>
                                <td <?= $CapitalGrowthClass8; ?> > <?= $ValueArr[8]["CapitalGrowth"] ; ?>%</td>
                                <td <?= $CapitalGrowthClass9; ?> > <?= $ValueArr[9]["CapitalGrowth"] ; ?>%</td>
                                <td <?= $CapitalGrowthClass10 ; ?> > <?=$ValueArr[10]["CapitalGrowth"] ; ?>%</td>
                            </tr>
                            <tr>
                                <td>CPI</td>
                                <td></td>
                                <td <?= $CPIClass1; ?> > <?= $ValueArr[1]["CPI"] ; ?> %</td>
                                <td <?= $CPIClass2; ?> > <?= $ValueArr[2]["CPI"] ; ?> %</td>
                                <td <?= $CPIClass3; ?> > <?= $ValueArr[3]["CPI"] ; ?> %</td>
                                <td <?= $CPIClass4; ?> > <?= $ValueArr[4]["CPI"] ; ?> %</td>
                                <td <?= $CPIClass5; ?> > <?= $ValueArr[5]["CPI"] ; ?> %</td>
                                <td <?= $CPIClass6; ?> > <?= $ValueArr[6]["CPI"] ; ?> %</td>
                                <td <?= $CPIClass7; ?> > <?= $ValueArr[7]["CPI"] ; ?> %</td>
                                <td <?= $CPIClass8; ?> > <?= $ValueArr[8]["CPI"] ; ?> %</td>
                                <td <?= $CPIClass9; ?> > <?= $ValueArr[9]["CPI"] ; ?> %</td>
                                <td <?= $CPIClass10; ?> > <?= $ValueArr[10]["CPI"]; ?> %</td>
                            </tr>
                            <tr>
                                <td>Property Value</td>
                                <td <?= $PropertyValueClass0; ?> > <?= $ValueArr[0]["PropertyValue"] ; ?></td>
                                <td <?= $PropertyValueClass1; ?> > <?= $ValueArr[1]["PropertyValue"] ; ?></td>
                                <td <?= $PropertyValueClass2; ?> > <?= $ValueArr[2]["PropertyValue"] ; ?></td>
                                <td <?= $PropertyValueClass3; ?> > <?= $ValueArr[3]["PropertyValue"] ; ?></td>
                                <td <?= $PropertyValueClass4; ?> > <?= $ValueArr[4]["PropertyValue"] ; ?></td>
                                <td <?= $PropertyValueClass5; ?> > <?= $ValueArr[5]["PropertyValue"] ; ?></td>
                                <td <?= $PropertyValueClass6; ?> > <?= $ValueArr[6]["PropertyValue"] ; ?></td>
                                <td <?= $PropertyValueClass7; ?> > <?= $ValueArr[7]["PropertyValue"] ; ?></td>
                                <td <?= $PropertyValueClass8; ?> > <?= $ValueArr[8]["PropertyValue"] ; ?></td>
                                <td <?= $PropertyValueClass9; ?> > <?= $ValueArr[9]["PropertyValue"] ; ?></td>
                                <td <?= $PropertyValueClass10; ?> > <?= $ValueArr[10]["PropertyValue"]; ?></td>
                            </tr>
                            <tr>
                                <td>Outstanding Mortgage</td>
                                <td <?= $OutstandingMortgageClass0; ?> > <?= $ValueArr[0]["OutstandingMortgage"] ;?></td>
                                <td <?= $OutstandingMortgageClass1; ?> > <?= $ValueArr[1]["OutstandingMortgage"] ;?></td>
                                <td <?= $OutstandingMortgageClass2; ?> > <?= $ValueArr[2]["OutstandingMortgage"] ;?></td>
                                <td <?= $OutstandingMortgageClass3; ?> > <?= $ValueArr[3]["OutstandingMortgage"] ;?></td>
                                <td <?= $OutstandingMortgageClass4; ?> > <?= $ValueArr[4]["OutstandingMortgage"] ;?></td>
                                <td <?= $OutstandingMortgageClass5; ?> > <?= $ValueArr[5]["OutstandingMortgage"] ;?></td>
                                <td <?= $OutstandingMortgageClass6; ?> > <?= $ValueArr[6]["OutstandingMortgage"] ;?></td>
                                <td <?= $OutstandingMortgageClass7; ?> > <?= $ValueArr[7]["OutstandingMortgage"] ;?></td>
                                <td <?= $OutstandingMortgageClass8; ?> > <?= $ValueArr[8]["OutstandingMortgage"] ;?></td>
                                <td <?= $OutstandingMortgageClass9; ?> > <?= $ValueArr[9]["OutstandingMortgage"] ;?></td>
                                <td <?= $OutstandingMortgageClass10; ?> > <?= $ValueArr[10]["OutstandingMortgage"];?></td>
                            </tr>
                            <tr>
                                <td>Gross Income</td>
                                <td <?= $GrossIncomeClass0; ?> > <?= $ValueArr[0]["GrossIncome"] ; ?> </td>
                                <td <?= $GrossIncomeClass1; ?> > <?= $ValueArr[1]["GrossIncome"] ; ?> </td>
                                <td <?= $GrossIncomeClass2; ?> > <?= $ValueArr[2]["GrossIncome"] ; ?> </td>
                                <td <?= $GrossIncomeClass3; ?> > <?= $ValueArr[3]["GrossIncome"] ; ?> </td>
                                <td <?= $GrossIncomeClass4; ?> > <?= $ValueArr[4]["GrossIncome"] ; ?> </td>
                                <td <?= $GrossIncomeClass5; ?> > <?= $ValueArr[5]["GrossIncome"] ; ?> </td>
                                <td <?= $GrossIncomeClass6; ?> > <?= $ValueArr[6]["GrossIncome"] ; ?> </td>
                                <td <?= $GrossIncomeClass7; ?> > <?= $ValueArr[7]["GrossIncome"] ; ?> </td>
                                <td <?= $GrossIncomeClass8; ?> > <?= $ValueArr[8]["GrossIncome"] ; ?> </td>
                                <td <?= $GrossIncomeClass9; ?> > <?= $ValueArr[9]["GrossIncome"] ; ?> </td>
                                <td <?= $GrossIncomeClass10; ?> > <?= $ValueArr[10]["GrossIncome"]; ?> </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="panel-title">
                        <h2>Equity</h2>
                        <!--<span class="action">View Graph or table -->
                        <!--    <div class="btn-group" role="group">-->
                        <!--        <button type="button" class="btn btn-light"><i class="fas fa-table"></i></button>-->
                        <!--        <button type="button" class="btn btn-light"><i class="fas fa-chart-bar"></i></button>-->
                        <!--    </div>-->
                        <!--</span>-->
                    </div>
                    <table  class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <td>Loan to Value</td>
                                <td <?= $LoanToValueClass0; ?> > <?= $ValueArr[0]["LoanToValue"] ; ?> </td>
                                <td <?= $LoanToValueClass1; ?> > <?= $ValueArr[1]["LoanToValue"] ; ?> %</td>
                                <td <?= $LoanToValueClass2; ?> > <?= $ValueArr[2]["LoanToValue"] ; ?> %</td>
                                <td <?= $LoanToValueClass3; ?> > <?= $ValueArr[3]["LoanToValue"] ; ?> %</td>
                                <td <?= $LoanToValueClass4; ?> > <?= $ValueArr[4]["LoanToValue"] ; ?> %</td>
                                <td <?= $LoanToValueClass5; ?> > <?= $ValueArr[5]["LoanToValue"] ; ?> %</td>
                                <td <?= $LoanToValueClass6; ?> > <?= $ValueArr[6]["LoanToValue"] ; ?> %</td>
                                <td <?= $LoanToValueClass7; ?> > <?= $ValueArr[7]["LoanToValue"] ; ?> %</td>
                                <td <?= $LoanToValueClass8; ?> > <?= $ValueArr[8]["LoanToValue"] ; ?> %</td>
                                <td <?= $LoanToValueClass9; ?> > <?= $ValueArr[9]["LoanToValue"] ; ?> %</td>
                                <td <?= $LoanToValueClass10; ?> > <?= $ValueArr[10]["LoanToValue"]; ?> %</td>
                            </tr>
                            <tr>
                                <td>Equity</td>
                                <td <?= $EquityClass0; ?> > <?= $ValueArr[0]["Equity"] ; ?> </td>
                                <td <?= $EquityClass1; ?> > <?= $ValueArr[1]["Equity"] ; ?> </td>
                                <td <?= $EquityClass2; ?> > <?= $ValueArr[2]["Equity"] ; ?> </td>
                                <td <?= $EquityClass3; ?> > <?= $ValueArr[3]["Equity"] ; ?> </td>
                                <td <?= $EquityClass4; ?> > <?= $ValueArr[4]["Equity"] ; ?> </td>
                                <td <?= $EquityClass5; ?> > <?= $ValueArr[5]["Equity"] ; ?> </td>
                                <td <?= $EquityClass6; ?> > <?= $ValueArr[6]["Equity"] ; ?> </td>
                                <td <?= $EquityClass7; ?> > <?= $ValueArr[7]["Equity"] ; ?> </td>
                                <td <?= $EquityClass8; ?> > <?= $ValueArr[8]["Equity"] ; ?> </td>
                                <td <?= $EquityClass9; ?> > <?= $ValueArr[9]["Equity"] ; ?> </td>
                                <td <?= $EquityClass10; ?> > <?= $ValueArr[10]["Equity"]; ?> </td>
                            </tr>
                            <tr>
                                <td>Surplus Equity Based on LTV (80%)</td>
                                <td <?= $SurplusEquityBasedLTVClass0; ?> > <?= $ValueArr[0]["SurplusEquityBasedLTV"] ;?></td>
                                <td <?= $SurplusEquityBasedLTVClass1; ?> > <?= $ValueArr[1]["SurplusEquityBasedLTV"] ;?></td>
                                <td <?= $SurplusEquityBasedLTVClass2; ?> > <?= $ValueArr[2]["SurplusEquityBasedLTV"] ;?></td>
                                <td <?= $SurplusEquityBasedLTVClass3; ?> > <?= $ValueArr[3]["SurplusEquityBasedLTV"] ;?></td>
                                <td <?= $SurplusEquityBasedLTVClass4; ?> > <?= $ValueArr[4]["SurplusEquityBasedLTV"] ;?></td>
                                <td <?= $SurplusEquityBasedLTVClass5; ?> > <?= $ValueArr[5]["SurplusEquityBasedLTV"] ;?></td>
                                <td <?= $SurplusEquityBasedLTVClass6; ?> > <?= $ValueArr[6]["SurplusEquityBasedLTV"] ;?></td>
                                <td <?= $SurplusEquityBasedLTVClass7; ?> > <?= $ValueArr[7]["SurplusEquityBasedLTV"] ;?></td>
                                <td <?= $SurplusEquityBasedLTVClass8; ?> > <?= $ValueArr[8]["SurplusEquityBasedLTV"] ;?></td>
                                <td <?= $SurplusEquityBasedLTVClass9; ?> > <?= $ValueArr[9]["SurplusEquityBasedLTV"] ;?></td>
                                <td <?= $SurplusEquityBasedLTVClass10; ?> > <?= $ValueArr[10]["SurplusEquityBasedLTV"];?></td>
                            </tr>
                            <tr>
                                <td>Annual Appreciation</td>
                                <td <?= $AnnualAppnClass0; ?> > <?= $ValueArr[0]["AnnualAppn"] ;?> </td>
                                <td <?= $AnnualAppnClass1; ?> > <?= $ValueArr[1]["AnnualAppn"] ;?> </td>
                                <td <?= $AnnualAppnClass2; ?> > <?= $ValueArr[2]["AnnualAppn"] ;?> </td>
                                <td <?= $AnnualAppnClass3; ?> > <?= $ValueArr[3]["AnnualAppn"] ;?> </td>
                                <td <?= $AnnualAppnClass4; ?> > <?= $ValueArr[4]["AnnualAppn"] ;?> </td>
                                <td <?= $AnnualAppnClass5; ?> > <?= $ValueArr[5]["AnnualAppn"] ;?> </td>
                                <td <?= $AnnualAppnClass6; ?> > <?= $ValueArr[6]["AnnualAppn"] ;?> </td>
                                <td <?= $AnnualAppnClass7; ?> > <?= $ValueArr[7]["AnnualAppn"] ;?> </td>
                                <td <?= $AnnualAppnClass8; ?> > <?= $ValueArr[8]["AnnualAppn"] ;?> </td>
                                <td <?= $AnnualAppnClass9; ?> > <?= $ValueArr[9]["AnnualAppn"] ;?> </td>
                                <td <?= $AnnualAppnClass10; ?> > <?= $ValueArr[10]["AnnualAppn"];?> </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="panel-title">
                        <h2>Income Analysis</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-title">
                        <h2>Annual Income</h2>
                        <!--<span class="action">View Graph or table -->
                        <!--    <div class="btn-group" role="group">-->
                        <!--        <button type="button" class="btn btn-light"><i class="fas fa-table"></i></button>-->
                        <!--        <button type="button" class="btn btn-light"><i class="fas fa-chart-bar"></i></button>-->
                        <!--    </div>-->
                        <!--</span>-->
                    </div>
                    <table  class="table table-hover table-striped">
                        <tbody>
                            <tr>  
                                <td>Net Cashflow</td>
                                <td <?= $NetCashFlowClass0 ;?> > <?= $ValueArr[0]["NetCashFlow"] ; ?> </td>
                                <td <?= $NetCashFlowClass1 ;?> > <?= $ValueArr[1]["NetCashFlow"] ; ?> </td>
                                <td <?= $NetCashFlowClass2 ;?> > <?= $ValueArr[2]["NetCashFlow"] ; ?> </td>
                                <td <?= $NetCashFlowClass3 ;?> > <?= $ValueArr[3]["NetCashFlow"] ; ?> </td>
                                <td <?= $NetCashFlowClass4 ;?> > <?= $ValueArr[4]["NetCashFlow"] ; ?> </td>
                                <td <?= $NetCashFlowClass5 ;?> > <?= $ValueArr[5]["NetCashFlow"] ; ?> </td>
                                <td <?= $NetCashFlowClass6 ;?> > <?= $ValueArr[6]["NetCashFlow"] ; ?> </td>
                                <td <?= $NetCashFlowClass7 ;?> > <?= $ValueArr[7]["NetCashFlow"] ; ?> </td>
                                <td <?= $NetCashFlowClass8 ;?> > <?= $ValueArr[8]["NetCashFlow"] ; ?> </td>
                                <td <?= $NetCashFlowClass9 ;?> > <?= $ValueArr[9]["NetCashFlow"] ; ?> </td>
                                <td <?= $NetCashFlowClass10 ;?> > <?= $ValueArr[10]["NetCashFlow"]; ?> </td>
                            </tr>
                            <tr> 
                                <td>Total Annual Return</td>
                                <td <?= $TotalAnnualReturnClass0; ?> > <?= $ValueArr[0]["TotalAnnualReturn"] ; ?> </td>
                                <td <?= $TotalAnnualReturnClass1; ?> > <?= $ValueArr[1]["TotalAnnualReturn"] ; ?> </td>
                                <td <?= $TotalAnnualReturnClass2; ?> > <?= $ValueArr[2]["TotalAnnualReturn"] ; ?> </td>
                                <td <?= $TotalAnnualReturnClass3; ?> > <?= $ValueArr[3]["TotalAnnualReturn"] ; ?> </td>
                                <td <?= $TotalAnnualReturnClass4; ?> > <?= $ValueArr[4]["TotalAnnualReturn"] ; ?> </td>
                                <td <?= $TotalAnnualReturnClass5; ?> > <?= $ValueArr[5]["TotalAnnualReturn"] ; ?> </td>
                                <td <?= $TotalAnnualReturnClass6; ?> > <?= $ValueArr[6]["TotalAnnualReturn"] ; ?> </td>
                                <td <?= $TotalAnnualReturnClass7; ?> > <?= $ValueArr[7]["TotalAnnualReturn"] ; ?> </td>
                                <td <?= $TotalAnnualReturnClass8; ?> > <?= $ValueArr[8]["TotalAnnualReturn"] ; ?> </td>
                                <td <?= $TotalAnnualReturnClass9; ?> > <?= $ValueArr[9]["TotalAnnualReturn"] ; ?> </td>
                                <td <?= $TotalAnnualReturnClass10; ?> > <?= $ValueArr[10]["TotalAnnualReturn"]; ?> </td>
                            </tr>
                            <tr class='text-primary'>
                                <td>Estimated Tax</td>
                                <td <?= $EstimatedTaxClass0 ;?> > <?= $ValueArr[0]["EstimatedTax"] ;?> </td> 
                                <td <?= $EstimatedTaxClass1 ;?> > <?= $ValueArr[1]["EstimatedTax"] ;?> </td>
                                <td <?= $EstimatedTaxClass2 ;?> > <?= $ValueArr[2]["EstimatedTax"] ;?> </td>
                                <td <?= $EstimatedTaxClass3 ;?> > <?= $ValueArr[3]["EstimatedTax"] ;?> </td>
                                <td <?= $EstimatedTaxClass4 ;?> > <?= $ValueArr[4]["EstimatedTax"] ;?> </td>
                                <td <?= $EstimatedTaxClass5 ;?> > <?= $ValueArr[5]["EstimatedTax"] ;?> </td>
                                <td <?= $EstimatedTaxClass6 ;?> > <?= $ValueArr[6]["EstimatedTax"] ;?> </td>
                                <td <?= $EstimatedTaxClass7 ;?> > <?= $ValueArr[7]["EstimatedTax"] ;?> </td>
                                <td <?= $EstimatedTaxClass8 ;?> > <?= $ValueArr[8]["EstimatedTax"] ;?> </td>
                                <td <?= $EstimatedTaxClass9 ;?> > <?= $ValueArr[9]["EstimatedTax"] ;?> </td>
                                <td <?= $EstimatedTaxClass10 ;?> > <?= $ValueArr[10]["EstimatedTax"];?> </td>
                            </tr>
                            <tr class='text-primary'> 
                                <td>Estimated Cumulative Tax Credit(s)</td>
                                <td <?= $EstCummulativeTaxCreditClass0 ; ?> > <?= $ValueArr[0]["EstCummulativeTaxCredit"] ; ?> </td>
                                <td <?= $EstCummulativeTaxCreditClass1 ; ?> > <?= $ValueArr[1]["EstCummulativeTaxCredit"] ; ?> </td>
                                <td <?= $EstCummulativeTaxCreditClass2 ; ?> > <?= $ValueArr[2]["EstCummulativeTaxCredit"] ; ?> </td>
                                <td <?= $EstCummulativeTaxCreditClass3 ; ?> > <?= $ValueArr[3]["EstCummulativeTaxCredit"] ; ?> </td>
                                <td <?= $EstCummulativeTaxCreditClass4 ; ?> > <?= $ValueArr[4]["EstCummulativeTaxCredit"] ; ?> </td>
                                <td <?= $EstCummulativeTaxCreditClass5 ; ?> > <?= $ValueArr[5]["EstCummulativeTaxCredit"] ; ?> </td>
                                <td <?= $EstCummulativeTaxCreditClass6 ; ?> > <?= $ValueArr[6]["EstCummulativeTaxCredit"] ; ?> </td>
                                <td <?= $EstCummulativeTaxCreditClass7 ; ?> > <?= $ValueArr[7]["EstCummulativeTaxCredit"] ; ?> </td>
                                <td <?= $EstCummulativeTaxCreditClass8 ; ?> > <?= $ValueArr[8]["EstCummulativeTaxCredit"] ; ?> </td>
                                <td <?= $EstCummulativeTaxCreditClass9 ; ?> > <?= $ValueArr[9]["EstCummulativeTaxCredit"] ; ?> </td>
                                <td <?= $EstCummulativeTaxCreditClass10; ?> > <?= $ValueArr[10]["EstCummulativeTaxCredit"]; ?> </td>
                            </tr>
                            <tr>
                                <td>Net Cashflow (after tax)</td> 
                                <td <?= $NetCashFlowAfterTaxClass0 ; ?> > <?= $ValueArr[0]["NetCashFlowAfterTax"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxClass1 ; ?> > <?= $ValueArr[1]["NetCashFlowAfterTax"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxClass2 ; ?> > <?= $ValueArr[2]["NetCashFlowAfterTax"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxClass3 ; ?> > <?= $ValueArr[3]["NetCashFlowAfterTax"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxClass4 ; ?> > <?= $ValueArr[4]["NetCashFlowAfterTax"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxClass5 ; ?> > <?= $ValueArr[5]["NetCashFlowAfterTax"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxClass6 ; ?> > <?= $ValueArr[6]["NetCashFlowAfterTax"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxClass7 ; ?> > <?= $ValueArr[7]["NetCashFlowAfterTax"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxClass8 ; ?> > <?= $ValueArr[8]["NetCashFlowAfterTax"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxClass9 ; ?> > <?= $ValueArr[9]["NetCashFlowAfterTax"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxClass10; ?> > <?= $ValueArr[10]["NetCashFlowAfterTax"]; ?> </td>
                            </tr>
                            <tr>
                                <td>Total Annual Return (after tax)</td>
                                <td <?= $TotalAnnualReturnAfterTaxClass0 ; ?> > <?= $ValueArr[0]["TotalAnnualReturnAfterTax"] ;?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxClass1 ; ?> > <?= $ValueArr[1]["TotalAnnualReturnAfterTax"] ;?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxClass2 ; ?> > <?= $ValueArr[2]["TotalAnnualReturnAfterTax"] ;?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxClass3 ; ?> > <?= $ValueArr[3]["TotalAnnualReturnAfterTax"] ;?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxClass4 ; ?> > <?= $ValueArr[4]["TotalAnnualReturnAfterTax"] ;?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxClass5 ; ?> > <?= $ValueArr[5]["TotalAnnualReturnAfterTax"] ;?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxClass6 ; ?> > <?= $ValueArr[6]["TotalAnnualReturnAfterTax"] ;?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxClass7 ; ?> > <?= $ValueArr[7]["TotalAnnualReturnAfterTax"] ;?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxClass8 ; ?> > <?= $ValueArr[8]["TotalAnnualReturnAfterTax"] ;?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxClass9 ; ?> > <?= $ValueArr[9]["TotalAnnualReturnAfterTax"] ;?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxClass10; ?> > <?= $ValueArr[10]["TotalAnnualReturnAfterTax"];?> </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="panel-title">
                        <h2>Monthly Income</h2>
                        <!--<span class="action">View Graph or table -->
                        <!--    <div class="btn-group" role="group">-->
                        <!--        <button type="button" class="btn btn-light"><i class="fas fa-table"></i></button>-->
                        <!--        <button type="button" class="btn btn-light"><i class="fas fa-chart-bar"></i></button>-->
                        <!--    </div>-->
                        <!--</span>-->
                    </div>
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                            <td>Net Cashflow</td>
                                <td <?= $NetCashFlowMonthClass0 ;?> > <?= $ValueArr[0]["NetCashFlowMonth"] ; ?> </td>
                                <td <?= $NetCashFlowMonthClass1 ;?> > <?= $ValueArr[1]["NetCashFlowMonth"] ; ?> </td>
                                <td <?= $NetCashFlowMonthClass2 ;?> > <?= $ValueArr[2]["NetCashFlowMonth"] ; ?> </td>
                                <td <?= $NetCashFlowMonthClass3 ;?> > <?= $ValueArr[3]["NetCashFlowMonth"] ; ?> </td>
                                <td <?= $NetCashFlowMonthClass4 ;?> > <?= $ValueArr[4]["NetCashFlowMonth"] ; ?> </td>
                                <td <?= $NetCashFlowMonthClass5 ;?> > <?= $ValueArr[5]["NetCashFlowMonth"] ; ?> </td>
                                <td <?= $NetCashFlowMonthClass6 ;?> > <?= $ValueArr[6]["NetCashFlowMonth"] ; ?> </td>
                                <td <?= $NetCashFlowMonthClass7 ;?> > <?= $ValueArr[7]["NetCashFlowMonth"] ; ?> </td>
                                <td <?= $NetCashFlowMonthClass8 ;?> > <?= $ValueArr[8]["NetCashFlowMonth"] ; ?> </td>
                                <td <?= $NetCashFlowMonthClass9 ;?> > <?= $ValueArr[9]["NetCashFlowMonth"] ; ?> </td>
                                <td <?= $NetCashFlowMonthClass10;?> > <?= $ValueArr[10]["NetCashFlowMonth"]; ?> </td>
                            </tr>
                            <tr>
                            <td>Total Monthly Return</td>
                                <td <?= $TotalAnnualReturnMonthClass0 ; ?> ><?= $ValueArr[0]["TotalAnnualReturnMonth"] ; ?> </td> 
                                <td <?= $TotalAnnualReturnMonthClass1 ; ?> ><?= $ValueArr[1]["TotalAnnualReturnMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnMonthClass2 ; ?> ><?= $ValueArr[2]["TotalAnnualReturnMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnMonthClass3 ; ?> ><?= $ValueArr[3]["TotalAnnualReturnMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnMonthClass4 ; ?> ><?= $ValueArr[4]["TotalAnnualReturnMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnMonthClass5 ; ?> ><?= $ValueArr[5]["TotalAnnualReturnMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnMonthClass6 ; ?> ><?= $ValueArr[6]["TotalAnnualReturnMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnMonthClass7 ; ?> ><?= $ValueArr[7]["TotalAnnualReturnMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnMonthClass8 ; ?> ><?= $ValueArr[8]["TotalAnnualReturnMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnMonthClass9 ; ?> ><?= $ValueArr[9]["TotalAnnualReturnMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnMonthClass10; ?> ><?= $ValueArr[10]["TotalAnnualReturnMonth"]; ?> </td>
                            </tr>
                            <tr class='text-primary'>
                                <td>Estimated Monthly Tax</td>  
                                <td <?= $EstimatedTaxMonthClass0 ;?> > <?=$ValueArr[0]["EstimatedTaxMonth"] ; ?> </td>
                                <td <?= $EstimatedTaxMonthClass1 ;?> > <?=$ValueArr[1]["EstimatedTaxMonth"] ; ?> </td>
                                <td <?= $EstimatedTaxMonthClass2 ;?> > <?=$ValueArr[2]["EstimatedTaxMonth"] ; ?> </td>
                                <td <?= $EstimatedTaxMonthClass3 ;?> > <?=$ValueArr[3]["EstimatedTaxMonth"] ; ?> </td>
                                <td <?= $EstimatedTaxMonthClass4 ;?> > <?=$ValueArr[4]["EstimatedTaxMonth"] ; ?> </td>
                                <td <?= $EstimatedTaxMonthClass5 ;?> > <?=$ValueArr[5]["EstimatedTaxMonth"] ; ?> </td>
                                <td <?= $EstimatedTaxMonthClass6 ;?> > <?=$ValueArr[6]["EstimatedTaxMonth"] ; ?> </td>
                                <td <?= $EstimatedTaxMonthClass7 ;?> > <?=$ValueArr[7]["EstimatedTaxMonth"] ; ?> </td>
                                <td <?= $EstimatedTaxMonthClass8 ;?> > <?=$ValueArr[8]["EstimatedTaxMonth"] ; ?> </td>
                                <td <?= $EstimatedTaxMonthClass9 ;?> > <?=$ValueArr[9]["EstimatedTaxMonth"] ; ?> </td>
                                <td <?= $EstimatedTaxMonthClass10;?> > <?=$ValueArr[10]["EstimatedTaxMonth"]; ?> </td>
                            </tr>
                            <tr>
                                <td>Net Cashflow (after tax)</td>
                                <td <?= $NetCashFlowAfterTaxMonthClass0 ;?> > <?= $ValueArr[0]["NetCashFlowAfterTaxMonth"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxMonthClass1 ;?> > <?= $ValueArr[1]["NetCashFlowAfterTaxMonth"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxMonthClass2 ;?> > <?= $ValueArr[2]["NetCashFlowAfterTaxMonth"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxMonthClass3 ;?> > <?= $ValueArr[3]["NetCashFlowAfterTaxMonth"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxMonthClass4 ;?> > <?= $ValueArr[4]["NetCashFlowAfterTaxMonth"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxMonthClass5 ;?> > <?= $ValueArr[5]["NetCashFlowAfterTaxMonth"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxMonthClass6 ;?> > <?= $ValueArr[6]["NetCashFlowAfterTaxMonth"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxMonthClass7 ;?> > <?= $ValueArr[7]["NetCashFlowAfterTaxMonth"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxMonthClass8 ;?> > <?= $ValueArr[8]["NetCashFlowAfterTaxMonth"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxMonthClass9 ;?> > <?= $ValueArr[9]["NetCashFlowAfterTaxMonth"] ; ?> </td>
                                <td <?= $NetCashFlowAfterTaxMonthClass10;?> > <?= $ValueArr[10]["NetCashFlowAfterTaxMonth"]; ?> </td>
                            </tr>
                            <tr>
                                <td>Total Monthly Return (after tax)</td>
                                <td <?= $TotalAnnualReturnAfterTaxMonthClass0 ;?> > <?= $ValueArr[0]["TotalAnnualReturnAfterTaxMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxMonthClass1 ;?> > <?= $ValueArr[1]["TotalAnnualReturnAfterTaxMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxMonthClass2 ;?> > <?= $ValueArr[2]["TotalAnnualReturnAfterTaxMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxMonthClass3 ;?> > <?= $ValueArr[3]["TotalAnnualReturnAfterTaxMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxMonthClass4 ;?> > <?= $ValueArr[4]["TotalAnnualReturnAfterTaxMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxMonthClass5 ;?> > <?= $ValueArr[5]["TotalAnnualReturnAfterTaxMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxMonthClass6 ;?> > <?= $ValueArr[6]["TotalAnnualReturnAfterTaxMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxMonthClass7 ;?> > <?= $ValueArr[7]["TotalAnnualReturnAfterTaxMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxMonthClass8 ;?> > <?= $ValueArr[8]["TotalAnnualReturnAfterTaxMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxMonthClass9 ;?> > <?= $ValueArr[9]["TotalAnnualReturnAfterTaxMonth"] ; ?> </td>
                                <td <?= $TotalAnnualReturnAfterTaxMonthClass10;?> > <?= $ValueArr[10]["TotalAnnualReturnAfterTaxMonth"]; ?> </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="panel-title">
                        <h2>Return Analysis</h2>
                        <!--<span class="action">View Graph or table -->
                        <!--    <div class="btn-group" role="group">-->
                        <!--        <button type="button" class="btn btn-light"><i class="fas fa-table"></i></button>-->
                        <!--        <button type="button" class="btn btn-light"><i class="fas fa-chart-bar"></i></button>-->
                        <!--    </div>-->
                        <!--</span>-->
                    </div>
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <td>IRR</td>
                                <td <?= $IRRClass; ?> > <?= $IRR; ?> %</td>
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
                                <td <?= $IRRAfterTaxClass; ?> > <?= $IRRAfterTax; ?> %</td>  
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form class="analysis-form" accept-charset="utf-8" action="<?php echo SITE_BASE_URL;?>/Property/propertysave.html?buttonaction=<?php echo $action;?>&property_id=<?php echo $ProprtyId;?>" method="post" >
            <?php
            foreach($_POST as $key => $post)
            {
                ?>
                <input type="hidden" value="<?= $post; ?>" name="<?= $key; ?>">
                <?php
            }
            ?>
        </form>
        <?php
        $NetCashFlowSeries		                =	"";
        $EstimatedTaxSeries                     =   "";
        $NetCashFlowAfterTaxSeries              =   ""; 
        $TotalAnnualReturnSeries                =   ""; 
        $TotalAnnualReturnAfterTaxSeries        =   ""; 
        $PropertyValueSeries                    =   ""; 
        $OutstandingMortgageSeries              =   ""; 
        $Seperator				                =	"";
        for ($i = 1; $i <= 10; $i++)
        {
            if (intval($i) > 1)
            {
                $Seperator		                =	",";
            }
        	$NetCashFlowSeries	                =	$NetCashFlowSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["NetCashFlow"]));
            $EstimatedTaxSeries                 =   $EstimatedTaxSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["EstimatedTax"]));
            $NetCashFlowAfterTaxSeries          =   $NetCashFlowAfterTaxSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["NetCashFlowAfterTax"]));
            $TotalAnnualReturnSeries            =   $TotalAnnualReturnSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["TotalAnnualReturn"]));
            $TotalAnnualReturnAfterTaxSeries    =   $TotalAnnualReturnAfterTaxSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["TotalAnnualReturnAfterTax"]));
            $PropertyValueSeries                =   $PropertyValueSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["PropertyValue"]));
            $OutstandingMortgageSeries          =   $OutstandingMortgageSeries . $Seperator . floatval(str_replace(",", "", $ValueArr[$i]["OutstandingMortgage"]));
        }
    	$ChkCntArr               			= \DBConn\DBConnection::getQueryFetchColumn("(SELECT CURRENCY FROM country_master WHERE COUNTRY_CODE ='{$CountryId}')");
        $Currency             				= $ChkCntArr["0"];
    	$ChkSymbolArr               		= \DBConn\DBConnection::getQueryFetchColumn("(SELECT Currency_Symbol FROM country_master WHERE COUNTRY_CODE ='{$CountryId}')");
        $Symbol             			    = $ChkSymbolArr["0"];
        if ( $CountryId == "3")
        {
            $Symbol             	= "£";
        }
        $CurrencySym             	=  $Symbol ." ".$Currency;		
        ?>
        <div class="panel panel-black mt-0">
            <div class="panel-title">
                <h2>Annual Cashflow</h2>
            </div>
            <div id="chart"></div>
            <canvas id="canvas"></canvas>
        </div>
        <script type='text/javascript' src='<?= SITE_BASE_URL;?>dashboard/assets/plugins/apexcharts/js/apexcharts.min.js'></script>
        <script type='text/javascript'>
            var GetPostDatasFn = function(){
                datavalues          = $(".analysis-form").serialize();
                return datavalues;
            }; 
            var AddToMyPortfolioFn = function(){
                pass_data       = GetPostDatasFn(); 
                $.ajax({
                    type: "POST",
                    url:"<?php echo SITE_BASE_URL;?>ajax/SaveAnalyzer.html",
                    data: pass_data
                }).done(function( data ) {
                    if( parseFloat(data) < 0 ){
                        alert("Error on Save.."); 
                    }else{
                        if( parseFloat(data) >= 0 ){
                            alert("Saved Successfully."); 
                        }
                    }
                });
            };
            var options = {
                series: [{
                    name: 'Total Annual Return',
                    data: [<?= $TotalAnnualReturnSeries; ?>]
                },
                {
                    name: 'Total Annual Return (after tax)',
                    data: [<?= $TotalAnnualReturnAfterTaxSeries; ?>]
                },
                {
                    name: 'Net Cashflow',
                    data: [<?= $NetCashFlowSeries; ?>]
                },
                {
                    name: 'Net Cashflow (after tax)',
                    data: [<?= $NetCashFlowAfterTaxSeries; ?>]
                },
                {
                    name: 'Estimated Tax',
                    data: [<?= $EstimatedTaxSeries; ?>]
                }],
                chart:{
                    height: 450,
                    type: 'line'
                },
                dataLabels:{
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
                        colors: ['#f3f3f3', 'transparent'],
                        opacity: 0.5
                    },
                },
                yaxis: {
                    type: 'numeric',
                    title: {
                        text: '<?= $CurrencySym; ?>',
                        style: {
                            fontSize:  '18px',
                            fontWeight:  'bold',
                            fontFamily:  undefined,
                            color:  '#263238'
                        },
                    },
                    labels: {
                        show:true,
                        formatter: function (value)
                        {
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
                    title: {
                        text: 'Year',
                        style: {
                            fontSize:  '18px',
                            fontWeight:  'bold',
                            fontFamily:  undefined,
                            color:  '#263238'
                        },
                    },
                    categories:  ["1", "2", "3", "4", "5", "6", "7","8","9","10"],
                    formatter: function (value)
                    {
                        return value;
                    }
                },
                tooltip: {
                    x: {
                        show:true,
                        formatter: function (value)
                        {
                            return 'Year ' + value;
                        }
                    },
                    y: {
                        show:true,
                        formatter: function (value)
                        {
                            return '<?= $Symbol; ?>' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        }
                    },
                },
            };
            var chart = new ApexCharts(document.querySelector('#chart'), options);
            chart.render();
        </script>
        <script src='<?= SITE_BASE_URL;?>dashboard/assets/plugins/chartjs/Chart.bundle.js'></script>
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
                    labels: ["1", "2", "3", "4", "5", "6", "7","8","9","10"],
                    datasets: [{
                        label: 'Capital Value', // Name the series
                        data: [<?= $PropertyValueSeries; ?>], // Specify the data values array
                        fill: true,
                        fillColor : gradient,
                        borderColor: '#2196f3',
                        borderWidth: 1 // Specify bar border width
                    },
                    {
                        label: 'Outstanding Mortgage', // Name the series
                        data: [<?= $OutstandingMortgageSeries; ?>], // Specify the data values array
                        fill: true,
                        fillColor : gradient2,
                        borderColor: '#4CAF50', // Add custom color border (Line)
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
                            usePointStyle: false
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
                                labelString: '<?= $CurrencySym; ?>'
                            },
                            ticks: {
                                beginAtZero:true,
                                userCallback: function(value, index, values)
                                {
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
                        text: 'Capital Value versus Outstanding Mortgage',
                        fontSize: 26
                    }
                }
            });
        </script>
    </div>
<?php
}
?>