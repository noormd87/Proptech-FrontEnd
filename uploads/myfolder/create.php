<?php
ob_start();

\Html\HtmlClass::Init();

echo \Html\HtmlClass::GetHeaderTemplate();
echo \Html\HtmlClass::GetSearchBar();
echo \Html\HtmlClass::GetSidebar();

$action             = $_REQUEST["action"] ?? "";

$ClsSales           = "\\PurchaseDecision\\PurchaseDecisionClass";
$clientDate         = $ClsSales::$clientDate;
$Shift              = $ClsSales::$Shift;

$noOfClient         = $ClsSales::$noOfClient;
$InvestStartDt      = $ClsSales::$InvestStartDt;
$InvestStartDtConv  = $ClsSales::$InvestStartDtConvert;
$FieldType          = $ClsSales::$FieldType; //field_type

        
$HdrArray           = array ("pdc" => "Purchase Decision Calc",
                             "MLC" => "Monthly LOC Calc", 
                             "bcc" => "Borrowing Capacity Calc", 
                             "pcc" => "Property Cost Calc", 
                             "iec" => "Income Expense Calc", 
                             "dn"  => "Depn Calc", 
                             "FBC" => "Fixed Bal Calc");


//echo "InvestStartDt={$InvestStartDt}";

$Id                 = $ClsSales::$Id;

$TotalAddRows       = 3;

$Today = date("Y-m-d");
$AgeArr = array();

$Url                = "client/save.html";

if ($action == "edit"){
    $Url            = "client/update.html?d=" . date("YmdHis") . "&id={$Id}";
}



if ($action == "edit" ) {
    $HdrValuesArray     = $ClsSales::$HdrValuesArray;
}

$MaxYrs             = 2;
$MaxMonth           = 11;
?>
<style>
    input[sub_total='true'],input[mortgage_total='true']{
        background:#ebf6ea; 
    }
    
    input[type='text']:not([readonly]){
        background:#e5eeef; 
    }
</style>

<?php
ob_flush();
flush();
 

if ($FieldType == "all"){
	$LoadStyle = "";
}
else{
	$LoadStyle = "display:none; ";
}
?>

<div id="loading" style="<?php echo $LoadStyle;?> border:1px solid grey; background:yellow; position:fixed; top:300px; left:500px; width:500px; height:100px; margin:0 auto; text-align:center; vertical-align:center; z-index:10001; ">
	<div style=" padding-top:40px;">
		<strong>Please wait while we are loading... </strong>
	</div>
</div>

<div id="content">
    <?php
    echo \Html\HtmlClass::PrintFormHeaderName("Purchase Decision Calculator");
    ?>
    <div class="container">
        <div class="grid-24">
            <form class="form uniformForm" name="form1" method="post" action="<?php echo SITE_BASE_URL . $Url; ?>">		
                <?php
                if ($action == "edit"){
                    $DontCallTaxAjax = "Y";
                }
                else{
                    $DontCallTaxAjax = "N";
                }
                ?>
                
                <input type="hidden" name="DontCallTaxAjax" id="DontCallTaxAjax" rel="DontCallTaxAjax" 
                       value="<?php echo $DontCallTaxAjax;?>" />
                <input type="hidden" name="noOfClient" id="noOfClient" rel="noOfClient" 
                       value="<?php echo $noOfClient;?>" />
                <input type="hidden" name="InvestStartDt" id="InvestStartDt" rel="InvestStartDt" 
                       value="<?php echo $InvestStartDt;?>" />
                
                <div class="widget widget-table">		
                    <div class="widget-header">
                        <span class="icon-list"></span>
                        <h3 class="icon chart">
                            <?php echo $HdrArray[$FieldType] ?? "Purchase Decision Calc"; ?>
                        </h3>		
                    </div>
                    
                    <?php
                    $FirstRowFields     = array("Salary1", "Salary2", "Salary3", "Salary4", "Salary5", "TotalSal", "Rent", 
                                                "CurrentRent", "CurrentPropVal", "MlcDate");
                    
                    //Getting values for First Row Fields (Start)
                    $ValueArr           = $ClsSales::GetAssumptionArray();

					$DefaultValArr		= array("NonDeductibleExpEveryYr"		=> "100", 
												"NoOfInvestPropertyOwned"		=> "1", 
												"OneOffCashCost"				=> "1", 
												"PurchasePropertyIfQualifyYes"	=> "1"
											   );
                    
                    //echo "<pre>"; print_r($ValueArr); echo "</pre>";
                    
                    $RentIncreaseRate           = floatval($ValueArr["RentIncreaseRate"] ?? 0);
                    $AnnualRentalIncome         = floatval($ValueArr["AnnualRentalIncome"] ?? 0);
                    $CurrentPropertyVal         = floatval($ValueArr["CurrentPropertyVal"] ?? 0);
                    $CurrentInvPropVal          = floatval($ValueArr["CurrentInvPropVal"] ?? 0);
                    $DSRSalary                  = floatval($ValueArr["DSRSalary"] ?? 0);
                    $DSRRent                    = floatval($ValueArr["DSRRent"] ?? 0);
                    $LOCTestRate                = floatval($ValueArr["LOCTestRate"] ?? 0);
                    $InitialInvPropPurchPrice   = floatval($ValueArr["InitialInvPropPurchPrice"] ?? 0);
                    $InitialInvPropPurchCosts   = floatval($ValueArr["InitialInvPropPurchCosts"] ?? 0);
                    $RentalMgmtFee              = floatval($ValueArr["RentalMgmtFee"] ?? 0);
                    $Assumptions_F3             = $InitialInvPropPurchPrice;
                    $Assumptions_F4             = $InitialInvPropPurchCosts; 
                    $CashPropertyExpenses       = floatval($ValueArr["CashPropertyExpenses"] ?? 0);
                    $InitialFixFitCost          = floatval($ValueArr["InitialFixFitCost"] ?? 0);
                    $FixFitDepnRate             = floatval($ValueArr["FixFitDepnRate"] ?? 0);
                    $MaxLVR                     = floatval($ValueArr["MaxLVR"] ?? 0);
                    $CurInvPropInc              = floatval($ValueArr["CurInvPropInc"] ?? 0);
                    $StartDt                    = $ValueArr["StartDt"] ?? "";
                    $StartDtConvert             = $ValueArr["StartDtConvert"] ?? "";
                    $TotalNonInvLoanBal         = $ValueArr["TotalNonInvLoanBal"] ?? "";
                    $TotalInvLoanBal            = $ValueArr["TotalInvLoanBal"] ?? "";
                    $TotalOffsetSurplus         = $ValueArr["TotalOffsetSurplus"] ?? "";
                    $NetWageGrowthRate          = $ValueArr["NetWageGrowthRate"] ?? "";
                    $FixedInterestRate          = $ValueArr["FixedInterestRate"] ?? "";
                    $TaxDedLOCIntRate           = $ValueArr["TaxDedLOCIntRate"] ?? "";
                    $LumpSumDeposit             = $ValueArr["LumpSumDeposit"] ?? "";
                    $InflationRate              = $ValueArr["InflationRate"] ?? "";
                    $YearsToRetirement          = $ValueArr["YearsToRetirement"] ?? "";
                    
                    
                    echo "  <input type='hidden' name='MaxYrs' id='MaxYrs' value='{$MaxYrs}' />
                            <input type='hidden' name='MaxMonth' id='MaxMonth' value='{$MaxMonth}' />
                            <input type='hidden' name='RentIncreaseRate' id='RentIncreaseRate' value='{$RentIncreaseRate}' />
                            <input type='hidden' name='AnnualRentalIncome' id='AnnualRentalIncome' value='{$AnnualRentalIncome}' />
                            <input type='hidden' name='CurrentPropertyVal' id='CurrentPropertyVal' value='{$CurrentPropertyVal}' />
                            <input type='hidden' name='CurrentInvPropVal' id='CurrentInvPropVal' value='{$CurrentInvPropVal}' />
                            <input type='hidden' name='DSRSalary' id='DSRSalary' value='{$DSRSalary}' />
                            <input type='hidden' name='DSRRent' id='DSRRent' value='{$DSRRent}' />
                            <input type='hidden' name='LOCTestRate' id='LOCTestRate' value='{$LOCTestRate}' />
                            <input type='hidden' name='Assumptions_F3' id='Assumptions_F3' value='{$Assumptions_F3}' />
                            <input type='hidden' name='Assumptions_F4' id='Assumptions_F4' value='{$Assumptions_F4}' />
                            <input type='hidden' name='RentalMgmtFee' id='RentalMgmtFee' value='{$RentalMgmtFee}' />
                            <input type='hidden' name='CashPropertyExpenses' id='CashPropertyExpenses' value='{$CashPropertyExpenses}' />
                            <input type='hidden' name='InitialFixFitCost' id='InitialFixFitCost' value='{$InitialFixFitCost}' />
                            <input type='hidden' name='FixFitDepnRate' id='FixFitDepnRate' value='{$FixFitDepnRate}' />
                            <input type='hidden' name='MaxLVR' id='MaxLVR' value='{$MaxLVR}' />
                            <input type='hidden' name='CurInvPropInc' id='CurInvPropInc' value='{$CurInvPropInc}' />
                            <input type='hidden' name='StartDt' id='StartDt' value='{$StartDt}' />
                            <input type='hidden' name='TotalNonInvLoanBal' id='TotalNonInvLoanBal' value='{$TotalNonInvLoanBal}' />
                            <input type='hidden' name='TotalInvLoanBal' id='TotalInvLoanBal' value='{$TotalInvLoanBal}' />
                            <input type='hidden' name='TotalOffsetSurplus' id='TotalOffsetSurplus' value='{$TotalOffsetSurplus}' />
                            <input type='hidden' name='NetWageGrowthRate' id='NetWageGrowthRate' value='{$NetWageGrowthRate}' />
                            <input type='hidden' name='FixedInterestRate' id='FixedInterestRate' value='{$FixedInterestRate}' />
                            <input type='hidden' name='TaxDedLOCIntRate' id='TaxDedLOCIntRate' value='{$TaxDedLOCIntRate}' />
                            <input type='hidden' name='LumpSumDeposit' id='LumpSumDeposit' value='{$LumpSumDeposit}' />
                            <input type='hidden' name='InflationRate' id='InflationRate' value='{$InflationRate}' />
                            <input type='hidden' name='YearsToRetirement' id='YearsToRetirement' value='{$YearsToRetirement}' />

							<!-- Arzath Start-->
							<input type='hidden' name='PurchaseProp' id='PurchaseProp' value='1' />
                            
                         ";
                    
                    $ValueArr["MlcDate_0"] = $StartDt;
                    $ValueArr["Rent_0"] = floatval($AnnualRentalIncome) * pow( (1+floatval($RentIncreaseRate)/100), 1 );
                    $ValueArr["CurrentPropVal_0"] = floatval($CurrentPropertyVal) +floatval($CurrentInvPropVal);
                    
                    //print_r($ValueArr);
                    $SalaryQry          = " SELECT inc.ANNUAL_TOTAL, dtl.SEQ_NO
                                            FROM client_income_details inc
                                                 LEFT JOIN client_dtls dtl
                                                    ON inc.CLIENT_DTL_AUTO_ID = dtl.CLIENT_DTL_AUTO_ID
                                            WHERE     inc.LED_AUTO_ID = '17'
                                                  AND dtl.CLIENT_AUTO_ID = '{$Id}'
                                                  AND dtl.SEQ_NO <> 0";
                    $RsSalary           = \DBConn\DBConnection::getQueryFetchAll($SalaryQry);

                    foreach ($RsSalary as $index => $row) {
                        $SeqNo                          = $row["SEQ_NO"];
                        $AnnualTotal                    = $row["ANNUAL_TOTAL"];
                        $ValueArr["Salary{$SeqNo}_0"]   = $AnnualTotal;
                    }
                     
                    //TotalSal 
                    
                    $ValueArr["TotalSal_0"]             = floatval($ValueArr["Salary1_0"] ?? 0) + 
                                                          floatval($ValueArr["Salary2_0"] ?? 0) + 
                                                          floatval($ValueArr["Salary3_0"] ?? 0) + 
                                                          floatval($ValueArr["Salary4_0"] ?? 0) + 
                                                          floatval($ValueArr["Salary5_0"] ?? 0);
                            
                    
                    
                    
                    
                    
                    //Getting values for First Row Fields ( End )


                    $FieldsQry          = "SELECT * FROM tbl_purchase_decision_fields order by SORT_ORDER";
                    $RsFields           = \DBConn\DBConnection::getQueryFetchAll($FieldsQry);
                    
                    $ArrFields          = array();

                    foreach ($RsFields as $index => $row) {
                        $ArrFields[]    = $row;
                    }
                    
                    //echo "<pre>"; print_r($ArrFields); echo "</pre>";
                    ?>

                    <div class="widget-content">
                        <div id="MainDiv" style="overflow:auto; height: 400px">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <?php
                                        foreach($ArrFields as $ArrFields2){
                                            $Field_Cat  = $ArrFields2["FIELD_CATEGORY"] ?? "";

                                            if ($FieldType != $Field_Cat and $FieldType != "all")
                                                $TdStyle = "display:none;";
                                            else
                                                $TdStyle = "";
                                                    
                                            echo "<th style='{$TdStyle}'>{$ArrFields2["FIELD_DESC"]}</th>";
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $MonthCount = 0;
                                    
                                    for ($i = 0; $i <= intval($MaxYrs); $i++){        //Year Loop - Start
                                        $ValueArr["YearPDTStart"] = $i;
                                        $ValueArr["BccYrStart"] = $i;
                                        $ValueArr["YearPCC"] = $i;
                                        $ValueArr["YearIec"] = $i;
                                        $ValueArr["MlcYrStart"] = $i;
                                        $ValueArr["MlcYr"] = $i;
                                        $ValueArr["FBCYrSt"] = $i;
                                        $ValueArr["FBCYr"] = $i;
                                        $ValueArr["YearDn"] = $i;
                                        $ValueArr["YrPDCEnd"] = $i;
                                        
                                        
                                        
                                        
                                        
                                        for ($j = 0; $j <= intval($MaxMonth); $j++){   //Month Loop - Start
                                            $ValueArr["FBCMonth"] = $j;
                                            $ValueArr["MlcMonth"] = $j;
                                            
                                            $MlcDate  = \OtherFn\OtherFnClass::DateAdd($StartDtConvert , $MonthCount . " month", "d/m/Y");
                                            $ValueArr["MlcDate"]  = $MlcDate;
                                            $MonthCount++;


                                            if ($FieldType == "MLC"){
                                                $TrStyle = "";
                                            }
                                            else{
                                                if ($j == 0  or $FieldType == "all")
                                                    $TrStyle = "";
                                                else
                                                    $TrStyle = "display:none;";
                                            }                                            
                                    ?>
                                    <tr class="tr_year_month" style="<?php echo $TrStyle; ?>" year="<?php echo $i;?>" month="<?php echo $j;?>">
                                                <?php
                                                foreach($ArrFields as $ArrFields2){
                                                    $IsMonthly  = $ArrFields2["IS_MONTHLY_FIELD"] ?? "";
                                                    $FieldId    = $ArrFields2["FIELD_ID"];
                                                    $Rel        = $ArrFields2["FIELD_NAME"] ?? "";
                                                    $Field_Cat  = $ArrFields2["FIELD_CATEGORY"] ?? "";
                                                    $FieldName  = "";
                                                    $FieldValue = "";
                                                    
                                                    //$FieldType
                                                    
                                                    if ($FieldType != $Field_Cat and $FieldType != "all")
                                                        $TdStyle = "display:none;";
                                                    else
                                                        $TdStyle = "";
                                                    
                                                    $IsReadOnly = $ArrFields2["IS_READONLY"] ?? "N";
                                                    
                                                    if ($IsReadOnly == "Y")
                                                        $ReadOnlyStr = "readonly";
                                                    else
                                                        $ReadOnlyStr = "";
                                                    
                                                    if ($IsMonthly == "")
                                                        $IsMonthly = "N";
                                                    
                                                    if ($Rel != ""){
                                                        $FieldName  = $Rel;

                                                        $FieldValue = $ValueArr[$FieldName] ?? "";

                                                        $FieldName      = $FieldName . "_{$i}";
                                                        if ($IsMonthly == "Y"){
                                                            $FieldName  = $FieldName . "_{$j}";
                                                        }
                                                        
                                                        if ($i == 0){    //Get first row values
                                                            if (in_array($Rel, $FirstRowFields)){
                                                                $FieldValue = $ValueArr["{$Rel}_0"] ?? "";
															}

															//echo $Rel . "<br>";

															if ($Rel == "NonDeductibleExpEveryYr" or $Rel == "NoOfInvestPropertyOwned" or $Rel == "OneOffCashCost" or $Rel == "PurchasePropertyIfQualifyYes"){ 
																if ($FieldValue == "" ){
																	$FieldValue	= $DefaultValArr[$Rel] ?? "";
																}
															}


															/*$DefaultValArr		= array("NonDeductibleExpEveryYr"		=> "100", 
																"NoOfInvestPropertyOwned"		=> "1", 
																"OneOffCashCost"				=> "1", 
																"PurchasePropertyIfQualifyYes"	=> "1"
															   );*/
                                                        }
                                                    }
                                                    
                                                    if ( $j > 0 and $IsMonthly == "N"){
                                                        echo "<td style='{$TdStyle}'></td>";
                                                    }
                                                    else{
                                                        echo "<td style='{$TdStyle}'>
                                                                <input  type='text' name='{$FieldName}' 
                                                                        id='{$FieldName}' year='{$i}' month='{$j}'
                                                                        rel='{$Rel}' size='10' {$ReadOnlyStr}
                                                                        value='{$FieldValue}' field_id='{$FieldId}' />
                                                              </td>";
                                                    }
                                                }
                                                ?>
                                            </tr>
                                    <?php 
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>	

                


                <div>
                    <?php if ($action == "create"){?>
                        <button class="btn btn-purple btn-small " >
                            <span class="icon-mail"></span>Save
                        </button>
                    <?php 
                    }
                    if ($action == "edit"){?>
                        <button class="btn btn-purple btn-small " >
                            <span class="icon-mail"></span>Update
                        </button>
                    <?php } ?>
                </div>





            </form>





        </div>



    </div> <!-- .container -->

</div>
<?php
\Html\HtmlClass::TopNavBar();

\Html\HtmlClass::Footer();
?>




<script language="javascript">
	$(window).load(function(){
		$("[rel='NonDeductibleExpEveryYr'][month='0'][year='0']").trigger("blur");
		$("#loading").hide(); 
	});

    $(document).ready(function(){
        //$(document).on("keyup blur", "[rel='NonDeductibleExpEveryYr'], [rel='NoOfInvestPropertyOwned'], [rel='NoOfInvestPropertyOwned'], [rel='OneOffCashCost']", function(){
        
        $(document).on("keyup blur", "input:not([readonly])", function(){
            //console.log(this.name);
            TrObj = $(this).closest("tr");
            CalculateFn( $(this).attr("rel") ); //TrObj , 
        });
        
    });


	function percentageRate(MainValue, PercentageValue) { 
		
		if (MainValue === undefined ) {
			MainValue = 0;
		  } 
		if (PercentageValue === undefined ) {
			PercentageValue = 0;
		  } 
	 
		originalPercentagValue          	= ( parseFloat(MainValue) + ( (parseFloat(MainValue) / 100) * parseFloat(PercentageValue))).toFixed(2);				

		return originalPercentagValue;
	} 
    
    
    var CalculateFn = function( FnObjRel ){	//FnTrObj , 
		
		if (FnObjRel == "NonDeductibleExpEveryYr"){
			$("[rel='NonDeductibleExpEveryYr'][month='0']").each(function(){
				if ( $(this).attr("year") == "0" ){
					ValNonDeductibleExpEveryYr = this.value; 
				}
				else{
					this.value	= ValNonDeductibleExpEveryYr
				}
			});
		}

        MaxMonth                = CheckIsNaN( $("[name='MaxMonth']").val() ); 
        MaxYrs                  = CheckIsNaN( $("[name='MaxYrs']").val() ); 
        
        AnnualRentalIncome      = CheckIsNaN( $("[name='AnnualRentalIncome']").val() ); 
        RentIncreaseRate        = CheckIsNaN( $("[name='RentIncreaseRate']").val() ); 
        CurInvPropInc           = CheckIsNaN( $("[name='CurInvPropInc']").val() ); 
        CurrentPropertyVal      = CheckIsNaN( $("[name='CurrentPropertyVal']").val() ); 
        CurrentInvPropVal       = CheckIsNaN( $("[name='CurrentInvPropVal']").val() ); 
        DSRSalary               = CheckIsNaN( $("[name='DSRSalary']").val() ); 
        DSRRent                 = CheckIsNaN( $("[name='DSRRent']").val() );
        LOCTestRate             = CheckIsNaN( $("[name='LOCTestRate']").val() );
        Assumptions_F3          = CheckIsNaN( $("[name='Assumptions_F3']").val() );
        Assumptions_F4          = CheckIsNaN( $("[name='Assumptions_F4']").val() );
        CashPropertyExpenses    = CheckIsNaN( $("[name='CashPropertyExpenses']").val() );
        RentalMgmtFee           = CheckIsNaN( $("[name='RentalMgmtFee']").val() );
        InitialFixFitCost       = CheckIsNaN( $("[name='InitialFixFitCost']").val() );
        FixFitDepnRate          = CheckIsNaN( $("[name='FixFitDepnRate']").val() );
        MaxLVR                  = CheckIsNaN( $("[name='MaxLVR']").val() );
        InflationRate           = CheckIsNaN( $("[name='InflationRate']").val() );
        TotalNonInvLoanBal      = CheckIsNaN( $("[name='TotalNonInvLoanBal']").val() );
        TotalInvLoanBal			= CheckIsNaN( $("[name='=TotalInvLoanBal']").val() );
        TotalOffsetSurplus      = CheckIsNaN( $("[name='TotalOffsetSurplus']").val() );
        NetWageGrowthRate       = CheckIsNaN( $("[name='NetWageGrowthRate']").val() );
        LumpSumDeposit			= CheckIsNaN( $("[name='LumpSumDeposit']").val() );
        YearsToRetirement		= CheckIsNaN( $("[name='YearsToRetirement']").val() );
        TaxDedLOCIntRate		= CheckIsNaN( $("[name='TaxDedLOCIntRate']").val() );


        FixedInterestRate		= CheckIsNaN( $("[name='FixedInterestRate']").val() );
		

		// ============= Arzath =========
		PurchaseProp			= CheckIsNaN( $("[name='PurchaseProp']").val() );
		TaxDedLOCIntRate		= CheckIsNaN( $("[name='TaxDedLOCIntRate']").val() );
        

        $(".tr_year_month[month='0']").each(function(){
			FnTrObj					= $(this);

			CurMon                  = CheckIsNaN( FnTrObj.find("[rel='YearPDTStart']").attr("month") );
			CurYr                   = CheckIsNaN( FnTrObj.find("[rel='YearPDTStart']").attr("year") );
			
			
			ObjSalary1                 = FnTrObj.find("[rel='Salary1']"); 
			ObjSalary2                 = FnTrObj.find("[rel='Salary2']"); 
			ObjSalary3                 = FnTrObj.find("[rel='Salary3']"); 
			ObjSalary4                 = FnTrObj.find("[rel='Salary4']"); 
			ObjSalary5                 = FnTrObj.find("[rel='Salary5']"); 

			
			ObjTotalSal             = FnTrObj.find("[rel='TotalSal']");
			ObjRent                 = FnTrObj.find("[rel='Rent']");
			
			if (parseInt(CurYr) == 0){
				Salary1                 = CheckIsNaN( ObjSalary1.val() ); 
				Salary2                 = CheckIsNaN( ObjSalary2.val() ); 
				Salary3                 = CheckIsNaN( ObjSalary3.val() ); 
				Salary4                 = CheckIsNaN( ObjSalary4.val() ); 
				Salary5                 = CheckIsNaN( ObjSalary5.val() ); 
				
				$Year                   = CheckIsNaN( FnTrObj.find("[rel='BccYrStart']").val() );       //$F5
				OneOffCashCost          = CheckIsNaN( FnTrObj.find("[rel='OneOffCashCost']").val() );             //AA5
				PurchasePropertyQualify = CheckIsNaN( FnTrObj.find("[rel='PurchasePropertyIfQualifyYes']").val() );
				
				//Salary
				
				TotSalary               = (Salary1 + Salary2 + Salary3 + Salary4 + Salary5).toFixed(2);
				ObjTotalSal.val(TotSalary);
				
				//Rent BCC End  //=AnnualRentalIncome*((1+RentIncreaseRate)^(F5))
				Rent                    = (parseFloat(AnnualRentalIncome) * ( Math.pow( 1 + parseFloat(RentIncreaseRate), parseInt($Year) ) ) ).toFixed(2)
				
				console.log("Rent = " + Rent + ", AnnualRentalIncome=" + AnnualRentalIncome + ", RentIncreaseRate=" + RentIncreaseRate)
				ObjRent.val( Rent );
				
				
				NoOfInvestPropertyOwned = CheckIsNaN( FnTrObj.find("[rel='NoOfInvestPropertyOwned']").val() ); 
				
				ObjProperties           = FnTrObj.find("[rel='Properties']");
				ObjProperties.val(NoOfInvestPropertyOwned);
				
				ObjIecNoOfInvestPropertyOwned = FnTrObj.find("[rel='IecNoOfInvestPropertyOwned']");
				ObjIecNoOfInvestPropertyOwned.val(NoOfInvestPropertyOwned);
				
				ObjNewRent              = FnTrObj.find("[rel='NewRent']");
				NewRent                 = parseFloat(Rent) * parseFloat(NoOfInvestPropertyOwned);
				
				console.log("NoOfInvestPropertyOwned = " + NoOfInvestPropertyOwned + ", AnnualRentalIncome=" + AnnualRentalIncome + ", RentIncreaseRate=" + RentIncreaseRate)
				ObjNewRent.val(NewRent);
				
				//Current Rent Calc => =CurInvPropInc*((1+RentIncreaseRate)^($F5))
				CurrentRent             = parseFloat(CurInvPropInc) * ( Math.pow( (1+parseFloat(RentIncreaseRate)), parseInt($Year) ) ).toFixed(2);
				
				ObjCurrentRent          = FnTrObj.find("[rel='CurrentRent']");
				ObjCurrentRent.val(CurrentRent);
				
				//=CurrentPropertyVal+CurrentInvPropVal
				CurrentPropVal          = parseFloat(CurrentPropertyVal) + parseFloat(CurrentInvPropVal);
				ObjCurrentPropVal       = FnTrObj.find("[rel='CurrentPropVal']");
				ObjCurrentPropVal.val( CurrentPropVal );
				
				//TotalRent = M5+N5
				TotalRent               = (parseFloat(NewRent) + parseFloat(CurrentRent)).toFixed(2);
				ObjTotalRent            = FnTrObj.find("[rel='TotalRent']");
				ObjTotalRent.val(TotalRent);
				
				
				//=(I5*DSRSalary)+(P5*DSRRent)
				 
				
				DSRAmt                  = ( parseFloat(TotSalary) * (parseFloat(DSRSalary)/100) ) + ( parseFloat(TotalRent) * (parseFloat(DSRRent)/100) )
				ObjDSRAmt               = FnTrObj.find("[rel='DSRAmt']");
				ObjDSRAmt.val( DSRAmt );
				
				//B/Cap DSR - BCC END => BCapDSR  = Q5/LOCTestRate (Q5 is DSRAmt)
				BCapDSR                 = parseFloat(DSRAmt) / parseFloat(LOCTestRate/100);
				ObjBCapDSR              = FnTrObj.find("[rel='BCapDSR']");
				ObjBCapDSR.val( BCapDSR );
				
				//Purchase Value
				ObjPurchaseValue        = FnTrObj.find("[rel='PurchaseValue']");
				ObjPurchaseValue.val(Assumptions_F3);
				
				// Purchase Costs  
				ObjPurchaseCost         = FnTrObj.find("[rel='PurchaseCost']");
				ObjPurchaseCost.val(Assumptions_F4);
				
				//Loan
				Loan                    = parseFloat(Assumptions_F3) + parseFloat(Assumptions_F4) ;
				ObjLoan                 = FnTrObj.find("[rel='Loan']");
				ObjLoan.val(Loan);
				
				
				ObjRentalIncome         = FnTrObj.find("[rel='RentalIncome']");
				ObjRentalIncome.val(AnnualRentalIncome);
				
				
				//Management Fee (X5)  => W5*RentalMgmtFee      (W5 = Rental Income)
				ManagementFee           = (parseFloat(AnnualRentalIncome) * (parseFloat(RentalMgmtFee) / 100)).toFixed(0);
				ObjManagementFee        = FnTrObj.find("[rel='ManagementFee']");
				ObjManagementFee.val(ManagementFee);
				
				//Net Rental Income After Agents Fees (Y5) => W5-X5   (X5 = Management Fee)
				NetRentalIncomeAfterAgentFees       = parseFloat(AnnualRentalIncome) - (parseFloat(ManagementFee) );
				ObjNetRentalIncomeAfterAgentFees    = FnTrObj.find("[rel='NetRentalIncomeAfterAgentFees']");
				ObjNetRentalIncomeAfterAgentFees.val(NetRentalIncomeAfterAgentFees);
				
				//alert("NetRentalIncomeAfterAgentFees=" + NetRentalIncomeAfterAgentFees)
				
				//Cash Rental Expenses (Z5) => CashPropertyExpenses
				CashRentalExpenses      = parseFloat(CashPropertyExpenses)
				ObjCashRentalExpenses   = FnTrObj.find("[rel='CashRentalExpenses']");
				ObjCashRentalExpenses.val( CashRentalExpenses );
				
				//Net Cash Income => =W5-Z5-AA5  (AA5 = OneOffCashCost)
				NetCashIncome           = parseFloat(AnnualRentalIncome) - parseFloat(CashRentalExpenses) - parseFloat(OneOffCashCost);
				ObjNetCashIncome        = FnTrObj.find("[rel='NetCashIncome']");
				ObjNetCashIncome.val( NetCashIncome );
				
				//Fixtures & Fittings Depn First Year (AC5) => =InitialFixFitCost*FixFitDepnRate
				FixtureFittingsDepnFirstYr      = parseFloat(InitialFixFitCost) * parseFloat(FixFitDepnRate) / 100;
				ObjFixtureFittingsDepnFirstYr   = FnTrObj.find("[rel='FixtureFittingsDepnFirstYr']");
				ObjFixtureFittingsDepnFirstYr.val( FixtureFittingsDepnFirstYr );
				
				console.log("FixtureFittingsDepnFirstYr=" + FixtureFittingsDepnFirstYr);
				console.log(ObjFixtureFittingsDepnFirstYr);
				
				
				//Net Rental Profit before int first year - pcc end => Net Cash Income - Fixtures & Fittings Depn First Year
				NetRentalProfitIntFirstYr       = parseFloat(NetCashIncome) - parseFloat(FixtureFittingsDepnFirstYr);
				ObjNetRentalProfitIntFirstYr    = FnTrObj.find("[rel='NetRentalProfitIntFirstYr']");
				ObjNetRentalProfitIntFirstYr.val(NetRentalProfitIntFirstYr);
				
				
				//Drawdown required PDC STEND=> =IF(AE5>0,AE5*PurchaseDecisionCalc!V5,0)    AE5 = Purchase Property? Enter # if qualify is yes, PurchaseDecisionCalc!V5 = Loan
				if (parseFloat(PurchasePropertyQualify) > 0){
					DrawdownReqn                = parseFloat(PurchasePropertyQualify) * parseFloat(Loan);
				}
				else{
					DrawdownReqn                = 0;
				}
				
				ObjDrawdownReqn                 = FnTrObj.find("[rel='DrawdownReqn']"); 
				ObjDrawdownReqn.val(DrawdownReqn);

				console.log(ObjDrawdownReqn);
				
				
				//B/Cap LVR - Bcc start end => =((PurchaseDecisionCalc!T5*L5)+O5)*MaxLVR    
				//T5 = Purchase Value(Assumptions_F3), L5 = Properties(NoOfInvestPropertyOwned), O5 = Current Prop Val
				BCapLVR                         = ( (parseFloat(Assumptions_F3) * parseFloat(NoOfInvestPropertyOwned)) + parseFloat(CurrentPropVal) ) * (parseFloat(MaxLVR)/100);
				
				console.log("Assumptions_F3=" + Assumptions_F3 + ", NoOfInvestPropertyOwned=" + NoOfInvestPropertyOwned + ", CurrentPropVal=" + CurrentPropVal + ", MaxLVR=" + MaxLVR);
				ObjBCapLVR                      = FnTrObj.find("[rel='BCapLVR']"); 
				ObjBCapLVR.val(BCapLVR);
				
				
				//IEC - cur inv prop income =CurInvPropInc
				ObjCurInvPropIncome             = FnTrObj.find("[rel='CurInvPropIncome']"); 
				ObjCurInvPropIncome.val(CurInvPropInc);
				
				//IEC - Rental Income => $AI5*PurchaseDecisionCalc!W5   AI5 = NoOfInvestPropertyOwned, W5 = Rental Income
				IecRentalIncome                 = parseFloat(NoOfInvestPropertyOwned) * parseFloat(AnnualRentalIncome);
				ObjIecRentalIncome              = FnTrObj.find("[rel='IecRentalIncome']"); 
				ObjIecRentalIncome.val(IecRentalIncome);
				
				//IEC Management Fee => =$AI5*PurchaseDecisionCalc!X5
				IecManagementFee                = parseFloat(NoOfInvestPropertyOwned) * parseFloat(ManagementFee);
				ObjIecManagementFee             = FnTrObj.find("[rel='IecManagementFee']"); 
				ObjIecManagementFee.val(IecManagementFee);
				
				//IEC Net Rental Income After Agents Fees => $AI5*PurchaseDecisionCalc!Y5   Y5 = NetRentalIncomeAfterAgentFees
				IecNewRentalIncome              = parseFloat(NoOfInvestPropertyOwned) * parseFloat(NetRentalIncomeAfterAgentFees);
				ObjIecNewRentalIncome           = FnTrObj.find("[rel='IecNewRentalIncome']");
				ObjIecNewRentalIncome.val(IecNewRentalIncome)
				
				//IEC - Cash Rental Expenses => $AI5*PurchaseDecisionCalc!AA5   AA5 = CashRentalExpenses (CashPropertyExpenses)
				IecCashRentalExpenses           = parseFloat(NoOfInvestPropertyOwned) * parseFloat(CashPropertyExpenses)
				ObjIecCashRentalExpenses        = FnTrObj.find("[rel='IecCashRentalExpenses']"); 
				ObjIecCashRentalExpenses.val(IecCashRentalExpenses);
				
				
				//One off Cash Costs => =$AI5*PurchaseDecisionCalc!AA5
				IedcOneOffCashCost              = parseFloat(NoOfInvestPropertyOwned) * parseFloat(OneOffCashCost);
				ObjIedcOneOffCashCost           = FnTrObj.find("[rel='IedcOneOffCashCost']");
				ObjIedcOneOffCashCost.val(IedcOneOffCashCost);
				
				
				//Net Cash Income iec end => 
				IecNetCashIncome                = parseFloat(NoOfInvestPropertyOwned) * parseFloat(NetCashIncome) + parseFloat(CurInvPropInc);
				ObjIecNetCashIncome             = FnTrObj.find("[rel='IecNetCashIncome']");
				ObjIecNetCashIncome.val(IecNetCashIncome);
				
				FFCostTotal                     = 0;
				FFDepnTotal                     = 0;
				FFDbvTotal                      = 0;
				
				for (dn = 0; dn <= parseInt(CurYr); dn++){
					//FF Cost => InitialFixFitCost*((1+InflationRate)^($AQ5))*PurchaseDecisionCalc!$AE5
					FFCostPow                   = (Math.pow((1+(parseFloat(InflationRate)/100)), parseFloat(dn)));
					console.log("PurchasePropertyQualify=" + PurchasePropertyQualify)
					FFCost                      = parseFloat(InitialFixFitCost) * parseFloat(FFCostPow) * parseFloat(PurchasePropertyQualify);
					ObjFFCost                   = FnTrObj.find("[rel='FFCost" + dn + "']");
					ObjFFCost.val(FFCost);
					
					//FF Depn   => AU5*FixFitDepnRate
					FFDepn                      = parseFloat(FFCost) * parseFloat(FixFitDepnRate) / 100;
					ObjFFDepn                   = FnTrObj.find("[rel='FFDepn" + dn + "']");
					ObjFFDepn.val(FFDepn);
					
					FFDbv                       = parseFloat(FFCost) - parseFloat(FFDepn);
					ObjFFDbv                    = FnTrObj.find("[rel='FFDBV" + dn + "']");
					ObjFFDbv.val(FFDbv);
					
					FFCostTotal                 = parseFloat(FFCostTotal) + parseFloat(FFCost);
					FFDepnTotal                 = parseFloat(FFDepnTotal) + parseFloat(FFDepn);
					FFDbvTotal                  = parseFloat(FFDbvTotal) + parseFloat(FFDbv);   
				}
				
				ObjTotalFFCost                  = FnTrObj.find("[rel='TotalFFCost']");
				ObjTotalFFDepn                  = FnTrObj.find("[rel='TotalFFDepn']");
				ObjTotalFFBv                    = FnTrObj.find("[rel='TotalFFBv']");
				
				ObjTotalFFCost.val(FFCostTotal);
				ObjTotalFFDepn.val(FFDepnTotal);
				ObjTotalFFBv.val(FFDbvTotal);
				
				
				//Open Bal => TotalNonInvLoanBal
				ObjOpenBal                      = FnTrObj.find("[rel='OpenBal']");
				ObjOpenBal.val(TotalNonInvLoanBal);

				console.log("TotalNonInvLoanBal=" + TotalNonInvLoanBal)
				
				
				if (parseFloat(TotalNonInvLoanBal) > 0){
					//Deposits - Net Contribution + Current Loan Payments => =IF(FC5>0,TotalOffsetSurplus/   12*(1+NetWageGrowthRate)^($EZ5)    ,0)
					OffSurp						= parseFloat(TotalOffsetSurplus) / 12;
					DepositPow					= Math.pow( (1+ (parseFloat(NetWageGrowthRate) /100) ) , parseFloat(CurYr) );
					Deposits                    = Math.round( parseFloat(OffSurp) / parseFloat(DepositPow) );

					//Lump Sum Deposit - MLC END => IF(FC5>0,LumpSumDeposit,0)
					LumpSum						= LumpSumDeposit
				}
				else{
					Deposits                    = 0;
					LumpSum						= 0;
				}

				
				
				
				ObjDeposits                     = FnTrObj.find("[rel='Deposits']");
				ObjDeposits.val(Deposits);
				
				ObjLumpSumDeposit               = FnTrObj.find("[rel='LumpSum']");
				ObjLumpSumDeposit.val(LumpSum);
				

				//NonDedOpBal
				NonDedOpBal						= TotalNonInvLoanBal;
				ObjNonDedOpBal					= FnTrObj.find("[rel='NonDedOpBal']");
				ObjNonDedOpBal.val(NonDedOpBal);

				ObjContributions				= FnTrObj.find("[rel='Contributions']");
				ObjContributions.val(Deposits);


				//net cash inputs => =IF(FI5>0,VLOOKUP(FG5,PurchaseDecisionCalc!$AH$5:$AP$425,9)/12,0) 
				//NetCashInputs					= 1695 		//Hardcoded.. Need to work on this, couldnt understand the formula...
				NetCashInputs					= Math.round( parseFloat(IecNetCashIncome) / 12 );
				ObjNetCashInputs				= FnTrObj.find("[rel='NetCashInputs']");
				ObjNetCashInputs.val(NetCashInputs);


				//DedLOCOpBal => =TotalInvLoanBal
				DedLOCOpBal						= TotalInvLoanBal;
				ObjDedLOCOpBal					= FnTrObj.find("[rel='DedLOCOpBal']");
				ObjDedLOCOpBal.val(DedLOCOpBal);


				OpBalContributeNetCash			= parseFloat(NonDedOpBal)  - parseFloat(Deposits) - parseFloat(NetCashInputs);
				

				

				//invint => =IF((FI5-FJ5-FK5)>0,PurchaseDecisionCalc!FU5*FixedInterestRate/12,0)
				IntInv							= 1766;	//Hardcoded
				WD								= 0;	//Hardcoded

				
				//Int - Actual Position 
				//Int => =IF(((FG4-FH4-FI4+FJ4+FK4)*FixedInterestRate/12)<0,0,(FG4-FH4-FI4+FJ4+FK4)*FixedInterestRate/12)  => NonDedOpBal, Deposits, NetCashInputs, IntInv, WD, FixedInterestRate
				if ( parseFloat(OpBalContributeNetCash) +  parseFloat(IntInv) + parseFloat(WD) > 0 ){
					Int							= Math.round( (parseFloat(OpBalContributeNetCash) +  parseFloat(IntInv) + parseFloat(WD)) * (parseFloat(FixedInterestRate)/100 ) / 12 );
				}
				else{
					Int							= 0;
				}

				ObjInt							= FnTrObj.find("[rel='Int']");
				ObjInt.val(Int);



				//ClBal => =IF(FG4-FH4-FI4+FL4+FJ4+FK4<0,FG4-FH4-FI4+FL4+FK4,FG4-FH4-FI4+FL4+FJ4+FK4)
				//ClBal => =IF(OpBalContributeNetCash+Int+IntInv+WD<0,OpBalContributeNetCash+Int+WD,OpBalContributeNetCash+Int+IntInv+WD)

				ClBalTemp						= parseFloat(OpBalContributeNetCash) + parseFloat(Int) + parseFloat(IntInv) + parseFloat(WD);

				if (parseFloat(ClBalTemp) < 0){
					ClBal						= parseFloat(OpBalContributeNetCash) + parseFloat(WD) + parseFloat(Int);
				}
				else{
					ClBal						= parseFloat(ClBalTemp);
				}
				
				ObjClBal						= FnTrObj.find("[rel='ClBal']");
				ObjClBal.val(ClBal);



				//DedLOCOpBal - Contributions (Ded_Contributions)	=> =IF(PurchaseDecisionCalc!FG4>0,0,(TotalOffsetSurplus*(1+NetWageGrowthRate)^PurchaseDecisionCalc!FE4)/12)+IF((PurchaseDecisionCalc!FG4-PurchaseDecisionCalc!FH4-PurchaseDecisionCalc!FI4)<0,-PurchaseDecisionCalc!FM4,0)
				
				if (parseFloat(NonDedOpBal) > 0){
					Ded_Contributions			= 0;
				}
				else{
					Ded_Contributions_Pow		= Math.pow( (parseFloat(TotalOffsetSurplus) * ( 1 + ( parseFloat(NetWageGrowthRate) / 100 ) )) , parseFloat(CurYr) );

					//NonDedOpBal, Contributions, NetCashInputs    ,   ClBal

					if (parseFloat(NonDedOpBal) - parseFloat(Deposits) - parseFloat(NetCashInputs) < 0 ){
						Ded_Contributions_Temp	= -1 * parseFloat(ClBal);
					}

					Ded_Contributions			= parseFloat(Ded_Contributions_Pow) + parseFloat(Ded_Contributions_Temp);
				}

				ObjDed_Contributions			= FnTrObj.find("[rel='Ded_Contributions']");
				ObjDed_Contributions.val(Ded_Contributions);


				//Ded_NetCashInputs => =IF(PurchaseDecisionCalc!FG4>0,0,VLOOKUP(PurchaseDecisionCalc!FE4,PurchaseDecisionCalc!$AF$4:$AN$424,9)/12)    if (NonDedOpBal >0, 0, IecNetCashIncome)
				
				if (parseFloat(NonDedOpBal) > 0){
					Ded_NetCashInputs			= 0;
				}
				else{
					Ded_NetCashInputs			= IecNetCashIncome;
				}
				ObjDed_NetCashInputs			= FnTrObj.find("[rel='Ded_NetCashInputs']");
				ObjDed_NetCashInputs.val(Ded_NetCashInputs);


				//Ded_WD => =IFERROR(VLOOKUP(PurchaseDecisionCalc!FD4,PurchaseDecisionCalc!$B$4:$IR$424,10,FALSE),0)	CurYr, DrawdownReqn
				Ded_WD							= DrawdownReqn;
				ObjDed_WD						= FnTrObj.find("[rel='Ded_WD']");
				ObjDed_WD.val(Ded_WD);

				
				//Ded_Int =>	=IF(((FN4-FO4-FP4+FQ4)*FixedInterestRate/12)<0,0,(FN4-FO4-FP4+FQ4)*FixedInterestRate/12)	 DedLOCOpBal, Ded_Contributions, Ded_NetCashInputs, Ded_WD
				Ded_Int_Temp					= parseFloat(DedLOCOpBal) - parseFloat(Ded_Contributions) - parseFloat(Ded_NetCashInputs) + parseFloat(Ded_WD);
				Ded_Int							= parseFloat(Ded_Int_Temp) * ( parseFloat(FixedInterestRate) /100 ) / 12;
				if (parseFloat(Ded_Int) < 0){
					Ded_Int						= 0;
				}
				ObjDed_Int						= FnTrObj.find("[rel='Ded_Int']");
				ObjDed_Int.val(Ded_Int);


				//Ded_ClBal => =FN4-FO4-FP4+FR4+FQ4			Ded_Int_Temp + Ded_Int
				Ded_ClBal						= parseFloat(Ded_Int_Temp) + parseFloat(Ded_Int);
				ObjDed_ClBal					= FnTrObj.find("[rel='Ded_ClBal']");
				ObjDed_ClBal.val(Ded_ClBal);

				//FBCStart => =VLOOKUP((PurchaseDecisionCalc!FE4+1),PurchaseDecisionCalc!$FD$4:$FN$435,11)
				FBCStart						= Ded_ClBal;
				ObjFBCStart						= FnTrObj.find("[rel='FBCStart']");
				ObjFBCStart.val(FBCStart);


				//FBCFX (No Caption in Excel after FBC ST) => ==PurchaseDecisionCalc!FT4-FV4		Ded_ClBal - FBCStart
				FBCFX							= parseFloat(Ded_ClBal) - parseFloat(FBCStart)
				ObjFBCFX						= FnTrObj.find("[rel='FBCFX']");
				ObjFBCFX.val(FBCFX);


				//FBCFY (After FBCFX field) => =FW5*TaxDedLOCIntRate/12			FBCFX *TaxDedLOCIntRate/12	 
				FBCFY							= parseFloat(FBCFX) * (parseFloat(TaxDedLOCIntRate) / 100) / 12
				ObjFBCFY						= FnTrObj.find("[rel='FBCFY']");
				ObjFBCFY.val(FBCFY);


				//FBCEnd => =PurchaseDecisionCalc!FT5-FX5	Ded_ClBal - FBCFY
				FBCEnd							= parseFloat(Ded_ClBal) - parseFloat(FBCFY);
				ObjFBCEnd						= FnTrObj.find("[rel='FBCEnd']");
				ObjFBCEnd.val(FBCEnd);	


				//=IF((FG4-FH4-FI4)>0,PurchaseDecisionCalc!FT4*FixedInterestRate/12,0)		Ded_ClBal
				//=IF((OpBalContributeNetCash)>0,Ded_ClBal*FixedInterestRate/12,0)		
				//IntInv						= 0;	//Hardcoded

				if ( parseFloat(OpBalContributeNetCash) > 0){
					IntInv						= Math.round(parseFloat(Ded_ClBal) * (parseFloat(FixedInterestRate) / 100) /12);
				}
				else{
					IntInv						= 0;
				}

				ObjIntInv						= FnTrObj.find("[rel='IntInv']");
				ObjIntInv.val(IntInv);
				



				//Deposits - Net Cash Rental Income mlc ST (DepositNetCashRentalIncome) => =IF(FA4>0,(VLOOKUP($EX4,PurchaseDecisionCalc!$AF$4:$AN$424,9,FALSE))/12,0)		
				//IF(DedLOCOpBal>0,(IecNetCashIncome)/12,0)
				DepositNetCashRentalIncome		= Math.round(parseFloat(IecNetCashIncome) / 12);
				if (parseFloat(DedLOCOpBal) < 0){
					DepositNetCashRentalIncome	= 0;
				}
				ObjDepositNetCashRentalIncome	= FnTrObj.find("[rel='DepositNetCashRentalIncome']");
				ObjDepositNetCashRentalIncome.val(DepositNetCashRentalIncome);



				//Non Deductible Withdrawals / Drawdowns => =IFERROR(VLOOKUP(EW4,PurchaseDecisionCalc!$B$4:$E$424,4,FALSE),0)		=IFERROR(DrawdownReqn,0)
				//IF(OpenBal>0,IecNetCashIncome/12,0) 
				InflationAdjustPdcEnd			= CheckIsNaN( $("[name='InflationAdjustPdcEnd']").val() );
				NonDeductibleWithdrawDrawdones	= InflationAdjustPdcEnd;
				ObjNonDeductibleWithdrawDrawdones	= FnTrObj.find("[rel='NonDeductibleWithdrawDrawdones']");
				ObjNonDeductibleWithdrawDrawdones.val(NonDeductibleWithdrawDrawdones);

				

				$(".tr_year_month[year='" + CurYr + "']:not([month='0'])").each(function(){
					FnMonTrObj					= $(this);
					CurMonth					= CheckIsNaN( FnMonTrObj.find("[rel='MlcYr']").attr("month") );

					if (ClBal > 0){
						NonDedOpBal				= ClBal;
					}
					else
						NonDedOpBal				= 0;

					ObjNonDedOpBal	= FnMonTrObj.find("[rel='NonDedOpBal']");
					ObjNonDedOpBal.val(NonDedOpBal);


					//=IF(FG5>0,(TotalOffsetSurplus/12)*(1+NetWageGrowthRate)^FE5,0)		IF(NonDedOpBal>0,(TotalOffsetSurplus/12)*(1+NetWageGrowthRate)^CurYr,0);


					if (parseFloat(NonDedOpBal) > 0){
						Contributions				= Deposits
					}
					else{
						Contributions				= 0;
					}

					ObjContributions				= FnMonTrObj.find("[rel='Contributions']");
					ObjContributions.val(Contributions);

					//NetCashInputs => =IF(FG5>0,VLOOKUP(FE5,PurchaseDecisionCalc!$AF$4:$AN$424,9)/12,0)	IF(NonDedOpBal>0,IecNetCashIncome/12,0)
					if (parseInt(NonDedOpBal) > 0){
						NetCashInputs				= Math.round(parseFloat(IecNetCashIncome) / 12);
					}
					else{
						NetCashInputs				= 0;
					}

					ObjNetCashInputs				= FnMonTrObj.find("[rel='NetCashInputs']");
					ObjNetCashInputs.val(NetCashInputs);


					//WD => =IFERROR(VLOOKUP(#REF!,PurchaseDecisionCalc!$B$4:$E$424,4,FALSE),0) InflationAdjustPdcEnd
					ObjWD							= FnMonTrObj.find("[rel='WD']");
					ObjWD.val(WD);

					//intint =IF((FG5-FH5-FI5)>0,PurchaseDecisionCalc!FT5*FixedInterestRate,0)


					//DedLOCOpBal => =IF(FS4<0,0,FS4)		IF(Ded_ClBal<0,0,Ded_ClBal)	(Prev Row Values)
					DedLOCOpBal								= Ded_ClBal;
					ObjDedLOCOpBal							= FnMonTrObj.find("[rel='DedLOCOpBal']");
					ObjDedLOCOpBal.val(DedLOCOpBal);

					//Ded_Contributions => =IF(PurchaseDecisionCalc!FG5>0,0, (TotalOffsetSurplus*(1+NetWageGrowthRate)^PurchaseDecisionCalc!FE5)/12) + IF((PurchaseDecisionCalc!FG5-PurchaseDecisionCalc!FH5-PurchaseDecisionCalc!FI5)<0,-PurchaseDecisionCalc!FM5,0)
					//Ded_Contributions => =IF(NonDedOpBal>0,0, (TotalOffsetSurplus*(1+NetWageGrowthRate)^CurYr)/12) + IF((NonDedOpBal-Contributions-NetCashInputs)<0,-ClBal,0)

					if (parseFloat(NonDedOpBal) < 0 ){
						Ded_Contributions_Pow		= Math.pow( (parseFloat(TotalOffsetSurplus) * ( 1 + ( parseFloat(NetWageGrowthRate) / 100 ) )) , parseFloat(CurYr) );
						Ded_Contributions_Temp1		= parseFloat(Ded_Contributions_Pow) / 12;						
					}
					else{
						Ded_Contributions_Temp1		= 0; //This calculation is confusing, so hardcoded to 0
					}

					if (parseFloat(NonDedOpBal) - parseFloat(Contributions) - parseFloat(NetCashInputs) < 0 ){
						Ded_Contributions_Temp	= -1 * parseFloat(ClBal);
					}
					else{
						Ded_Contributions_Temp	= 0;
					}

					Ded_Contributions			= parseFloat(Ded_Contributions_Temp1) + parseFloat(Ded_Contributions_Temp);

					
					ObjDed_Contributions		= FnMonTrObj.find("[rel='Ded_Contributions']");
					ObjDed_Contributions.val(Ded_Contributions);

					//net cash inputs (Ded_NetCashInputs) => =IF(NonDedOpBal>0,0,IecNetCashIncome/12) 

					if (parseInt(NonDedOpBal) < 0){
						Ded_NetCashInputs		= parseFloat(IecNetCashIncome) / 12;
					}
					else{
						Ded_NetCashInputs		= 0;
					}

					ObjDed_NetCashInputs		= FnMonTrObj.find("[rel='Ded_NetCashInputs']");
					ObjDed_NetCashInputs.val(Ded_NetCashInputs);


					//Ded_WD => =IFERROR(VLOOKUP(PurchaseDecisionCalc!FD4,PurchaseDecisionCalc!$B$4:$IS$424,10,FALSE),0)
					//Ded_WD => ==IFERROR(VLOOKUP(PurchaseDecisionCalc!FD5,PurchaseDecisionCalc!$B$4:$IS$424,10,FALSE),0)
					//Ded_WD => =IFERROR(VLOOKUP(CurYr,DrawdownReqn),0)

					Ded_WD						= 0;
					
					ObjDed_WD					= FnMonTrObj.find("[rel='Ded_WD']");
					ObjDed_WD.val(Ded_WD);


					//Ded_Int => =IF(((FN5-FP5-FQ5+FR5)*FixedInterestRate/12)<0,0,(FN5-FP5-FQ5+FR5)*FixedInterestRate/12)
					//Ded_Int => =IF(((DedLOCOpBal-Ded_Contributions-Ded_NetCashInputs+Ded_WD)*FixedInterestRate/12)<0,0,(DedLOCOpBal-ObjDed_Contributions-Ded_NetCashInputs+Ded_WD)*FixedInterestRate/12)
					Ded_Int_Temp				= (parseFloat(DedLOCOpBal) - parseFloat(Ded_Contributions) + parseFloat(Ded_NetCashInputs) + parseFloat(Ded_WD)) * (parseFloat(FixedInterestRate) / 100) / 12;

					if (parseFloat(Ded_Int_Temp) < 0){
						Ded_Int_Temp			= 0;
					}

					ObjDed_Int					= FnMonTrObj.find("[rel='Ded_Int']");
					ObjDed_Int.val(Ded_Int);


					//Cl Bal FBC End => =IF(PurchaseDecisionCalc!FG5>0,FT4+FR5,IF(FT4-FP5-FQ5+FS5+FR5<0,0,FT4-FP5-FQ5+FS5+FR5))
					//Cl Bal FBC End => =IF(Ded_ClBal>0,Ded_ClBal(prev row)+Ded_WD, IF(Ded_ClBal-Ded_Contributions-IecNetCashIncome+Ded_Int+Ded_WD<0,0,Ded_ClBal-Ded_Contributions-IecNetCashIncome+Ded_Int+Ded_WD))

					Ded_ClBal_Temp				= parseFloat(Ded_ClBal) - parseFloat(Ded_Contributions) - parseFloat(IecNetCashIncome) + parseFloat(Ded_Int) + parseFloat(Ded_WD);

					if (parseInt(NonDedOpBal) > 0){
						Ded_ClBal_Temp1			= parseFloat(Ded_ClBal) + parseFloat(Ded_Contributions);
					}
					else{
						if (parseFloat(Ded_ClBal_Temp) < 0){
							Ded_ClBal_Temp1		= 0;
						}
						else{
							Ded_ClBal_Temp1		= parseFloat(Ded_ClBal) - parseFloat(Ded_Contributions) - parseFloat(IecNetCashIncome) + parseFloat(Ded_Int) + parseFloat(Ded_WD);
						}
					}

					Ded_ClBal					= Ded_ClBal_Temp1;	
					ObjDed_ClBal				= FnMonTrObj.find("[rel='Ded_ClBal']");
					ObjDed_ClBal.val(Ded_ClBal);


					//FBCStart => =VLOOKUP((PurchaseDecisionCalc!FE5+1),PurchaseDecisionCalc!$FD$4:$FN$435,11)
					FBCStart					= DedLOCOpBal;
					ObjFBCStart					= FnMonTrObj.find("[rel='FBCStart']");
					ObjFBCStart.val(FBCStart);


					//inv int (Int)	=> =IF((FG5-FH5-FI5)>0,PurchaseDecisionCalc!FT5*FixedInterestRate,0)		
					//IF((NonDedOpBal-Contributions-NetCashInputs)>0,Ded_ClBal*FixedInterestRate,0)
					if ( parseFloat(NonDedOpBal) - parseFloat(Contributions) - parseFloat(NetCashInputs) > 0 ){
						IntInv						= Math.round(parseFloat(Ded_ClBal) * (parseFloat(FixedInterestRate) / 100));
					}
					else{
						IntInv						= 0;
					}

					ObjIntInv						= FnMonTrObj.find("[rel='IntInv']");
					ObjIntInv.val(IntInv);

					//Int => =IF(((FG5-FH5-FI5+FJ5+FK5)*FixedInterestRate/12)<0,0,(FG5-FH5-FI5+FJ5+FK5)*FixedInterestRate/12)
					//Int => =IF(((NonDedOpBal-Contributions-NetCashInputs+IntInv+WD)*FixedInterestRate/12)<0,0,(NonDedOpBal-Contributions-NetCashInputs+IntInv+WD)*FixedInterestRate/12)
					IntTemp							= parseFloat(NonDedOpBal) - parseFloat(Contributions) - parseFloat(NetCashInputs) + parseFloat(IntInv) + parseFloat(WD);
					IntTemp1						= parseFloat(IntTemp) * (parseFloat(FixedInterestRate) / 100) / 12;

					console.log("parseFloat(IntTemp)=" + parseFloat(IntTemp))

					if (parseFloat(IntTemp1) < 0){
						Int							= 0;
					}
					else{
						Int							= Math.round( IntTemp1 );
					}

					ObjInt							= FnMonTrObj.find("[rel='Int']");
					ObjInt.val(Int);

					OpBalContributeNetCash			= parseFloat(NonDedOpBal)  - parseFloat(Contributions) - parseFloat(NetCashInputs);


					//ClBal => =IF(FG5-FH5-FI5+FL5+FJ5+FK5<0,FG5-FH5-FI5+FL5+FK5,FG5-FH5-FI5+FL5+FJ5+FK5)
					ClBalTemp						= parseFloat(OpBalContributeNetCash) + parseFloat(Int) + parseFloat(IntInv) + parseFloat(WD);

					if (parseFloat(ClBalTemp) < 0){
						ClBal						= parseFloat(OpBalContributeNetCash) + parseFloat(WD) + parseFloat(Int);
					}
					else{
						ClBal						= parseFloat(ClBalTemp);
					}
					
					ObjClBal						= FnMonTrObj.find("[rel='ClBal']");
					ObjClBal.val(ClBal);

					
					//FBCFX (No Caption in Excel after FBC ST) => =PurchaseDecisionCalc!FT5-FV5		Ded_ClBal - FBCStart
					FBCFX							= parseFloat(Ded_ClBal) - parseFloat(FBCStart)
					ObjFBCFX						= FnMonTrObj.find("[rel='FBCFX']");
					ObjFBCFX.val(FBCFX);


					//FBCFY (After FBCFX field) => =FW5*TaxDedLOCIntRate/12			FBCFX *TaxDedLOCIntRate/12	 
					FBCFY							= parseFloat(FBCFX) * (parseFloat(TaxDedLOCIntRate) / 100) / 12
					ObjFBCFY						= FnMonTrObj.find("[rel='FBCFY']");
					ObjFBCFY.val(FBCFY);

	
					//FBCEnd => =PurchaseDecisionCalc!FT5-FX5	Ded_ClBal - FBCFY
					FBCEnd							= parseFloat(Ded_ClBal) - parseFloat(FBCFY);
					ObjFBCEnd						= FnMonTrObj.find("[rel='FBCEnd']");
					ObjFBCEnd.val(FBCEnd);	


					//=VLOOKUP((PurchaseDecisionCalc!FE4+1),PurchaseDecisionCalc!$FD$4:$FN$435,11)


					//  => =IF(FA5>0,(VLOOKUP($EX5,PurchaseDecisionCalc!$AF$4:$AN$424,9,FALSE))/12,0)		=IF(FA5>0,(NetCashIncome)/12,0)
				});


				//DedLOCOpBal	
				
				ObjNoOfInvestPropertyOwned 	= 	FnTrObj.find("[rel='NoOfInvestPropertyOwned']");



			}	//End of 0th Year...
			else{

				//Arzath your code will starts here..
				//Arzath your code will starts here..
				
				//Sal1 => IF(F29>YearsToRetirement,0,(G5+(G5*NetWageGrowthRate)))	F29 = CurYear
				//console.log("YearsToRetirement=" + YearsToRetirement)
				if ( parseFloat(CurYr) > parseFloat(YearsToRetirement) ){
					Salary1							= 0;
				}
				else{
					Salary1							= parseFloat(Salary1) + (parseFloat(Salary1) * parseFloat(NetWageGrowthRate) / 100);
				}
				
				ObjSalary1.val(Salary1); 
				
				
				// Sal2 =IF(F29>YearsToRetirement,0,(H5+(H5*NetWageGrowthRate)))
					
				if ( parseFloat(CurYr) > parseFloat(YearsToRetirement) ){
					Salary2							= 0;
				}
				else{
					Salary2							= parseFloat(Salary2) + (parseFloat(Salary2) * parseFloat(NetWageGrowthRate) / 100);
				}
				
				ObjSalary2.val(Salary2); 
				
					
				if ( parseFloat(CurYr) > parseFloat(YearsToRetirement) ){
					Salary3							= 0;
				}
				else{
					Salary3							= parseFloat(Salary3) + (parseFloat(Salary3) * parseFloat(NetWageGrowthRate) / 100);
				}
				
				ObjSalary3.val(Salary3); 
				
					
				if ( parseFloat(CurYr) > parseFloat(YearsToRetirement) ){
					Salary4							= 0;
				}
				else{
					Salary4							= parseFloat(Salary4) + (parseFloat(Salary4) * parseFloat(NetWageGrowthRate) / 100);
				}
				
				ObjSalary4.val(Salary4); 
				
					
				if ( parseFloat(CurYr) > parseFloat(YearsToRetirement) ){
					Salary5							= 0;
				}
				else{
					Salary5							= parseFloat(Salary5) + (parseFloat(Salary5) * parseFloat(NetWageGrowthRate) / 100);
				}
				
				ObjSalary5.val(Salary5); 
				
				TotSalary               = (Salary1 + Salary2 + Salary3 + Salary4 + Salary5).toFixed(2);
				ObjTotalSal.val(TotSalary);
				
				// =AnnualRentalIncome*((1+RentIncreaseRate)^($F17))
				
				//=AnnualRentalIncome*((1+RentIncreaseRate)^($F16))
				
				//console.log('RentIncreaseRate=='+ RentIncreaseRate);
				
				
				//==================================== Start ===============
				
				Incrementrentalrate = ( Math.pow( 1 + parseFloat(RentIncreaseRate), parseInt(CurYr) ) ) ;
				
				//Rent                    = parseFloat(AnnualRentalIncome) + (  ( parseFloat(AnnualRentalIncome) /100 ) * ( Math.pow( 1 + parseFloat(RentIncreaseRate), parseInt(CurYr) ) ) ).toFixed(2)

				//console.log('Incrementrentalrate=='+Incrementrentalrate);
				//console.log('CurYr=='+CurYr);
				
				Rent          = parseFloat(AnnualRentalIncome) + ( (parseFloat(AnnualRentalIncome) / 100) * parseFloat(Incrementrentalrate));
				
				//console.log("Rent = " + Rent + ", AnnualRentalIncome=" + AnnualRentalIncome + ", RentIncreaseRate=" + RentIncreaseRate)
				ObjRent.val(Rent);
				

				/*Rent                    = (parseFloat(AnnualRentalIncome) * ( Math.pow( 1 + parseFloat(RentIncreaseRate), parseInt(CurYr) ) ) ).toFixed(2)
				
				console.log('Rent+='+Rent);
				//console.log("Rent = " + Rent + ", AnnualRentalIncome=" + AnnualRentalIncome + ", RentIncreaseRate=" + RentIncreaseRate +"CurYr=="+ CurYr)
				ObjRent.val(Rent);
				*/
				
				
				
				// =IF(IQ17>0,IQ17*PurchaseDecisionCalc!V17,0)  Valhardcore
				
				if(parseFloat(PurchaseProp) > 0 ) {
					
					//NoOfInvestPropertyOwned = CheckIsNaN( FnTrObj.find("[rel='NoOfInvestPropertyOwned']").val() ); 					
					TotPurchaseProp				=	549060;
					ObjNoOfInvestPropertyOwned.val(TotPurchaseProp);
				}else{
					TotPurchaseProp = 0;
					
					
					ObjNoOfInvestPropertyOwned.val(TotPurchaseProp);
				}
				
				//console.log(Properties); Valhardcore
				Properties = 1;
				ObjProperties           = FnTrObj.find("[rel='Properties']");
				ObjProperties.val(Properties);
				
			
				ObjNewRent              = FnTrObj.find("[rel='NewRent']");
				NewRent                 = parseFloat(Rent) * parseFloat(Properties);
				ObjNewRent.val(NewRent);
				
				
				//Current Rent Calc => =CurInvPropInc*((1+RentIncreaseRate)^($F5))
				//console.log('CurInvPropInc'+CurInvPropInc);
				//console.log('RentIncreaseRate'+RentIncreaseRate);
				console.log('CurYr'+CurYr);
				
				
				// =CurInvPropInc*((1+RentIncreaseRate)^($F16))  Valhardcore
				Incrementrentalrate = ( Math.pow( 1 + parseFloat(RentIncreaseRate), parseInt(CurYr) ) ) ;
				CurrentRent          = parseFloat(CurInvPropInc) + ( (parseFloat(CurInvPropInc) / 100) * parseFloat(Incrementrentalrate));

				//CurrentRent             = parseFloat(CurInvPropInc) * ( Math.pow( (1+parseFloat(RentIncreaseRate)), parseInt(CurYr) ) ).toFixed(2);
				//console.log('CurrentRent'+ CurrentRent);
				
				ObjCurrentRent          = FnTrObj.find("[rel='CurrentRent']");
				ObjCurrentRent.val(CurrentRent);
					
				
				InvestmentGrowthRate = 4				
				//console.log('InvestmentGrowthRate'+ parseFloat(InvestmentGrowthRate) /100 );
				CurrentPropVal          = parseFloat(CurrentPropVal) + ( (parseFloat(CurrentPropVal) / 100) * parseFloat(InvestmentGrowthRate));
				
				
				//console.log('CurrentInvPropValCalc'+ (parseFloat(CurrentPropVal) / 100) * parseFloat(InvestmentGrowthRate));
				
				ObjCurrentPropVal       = FnTrObj.find("[rel='CurrentPropVal']");
				ObjCurrentPropVal.val( CurrentPropVal );
				
				//TotalRent = M16+N16
				TotalRent               = (parseFloat(NewRent) + parseFloat(CurrentRent)).toFixed(2);
				ObjTotalRent            = FnTrObj.find("[rel='TotalRent']");
				ObjTotalRent.val(TotalRent);
				
				
				//=(I16*DSRSalary)+(P16*DSRRent)
				
				//=(I16*DSRSalary)+(P16*DSRRent)
				

				 
				
				DSRAmt                  =  ( ( parseFloat(TotSalary) * (parseFloat(DSRSalary)/100) ) + ( parseFloat(TotalRent) * (parseFloat(DSRRent)/100) )).toFixed(2);
				ObjDSRAmt               = FnTrObj.find("[rel='DSRAmt']");
				ObjDSRAmt.val(DSRAmt);
				//console.log('DSRAmt='+DSRAmt);
				
				
				//=Q16/LOCTestRate)
				BCapDSR                 = (parseFloat(DSRAmt) / parseFloat(LOCTestRate/100)).toFixed(2);
				ObjBCapDSR              = FnTrObj.find("[rel='BCapDSR']");
				ObjBCapDSR.val(BCapDSR);
				
			
				//Purchase Value	
				//console.log('InvestmentGrowthRate'+ parseFloat(InvestmentGrowthRate) /100 );
				Assumptions_F3          	= (parseFloat(Assumptions_F3) + ( (parseFloat(Assumptions_F3) / 100) * parseFloat(InvestmentGrowthRate))).toFixed(2);
				ObjPurchaseValue        	= FnTrObj.find("[rel='PurchaseValue']");
				ObjPurchaseValue.val(Assumptions_F3);
				
			
				// Purchase Costs  
				InflationRate     			=	2  // Valhardcore
				//=(U4+(U4*InflationRate))	
				Assumptions_F4          	= (parseFloat(Assumptions_F4) + ( (parseFloat(Assumptions_F4) / 100) * parseFloat(InflationRate))).toFixed(2);
				ObjPurchaseCost         	= FnTrObj.find("[rel='PurchaseCost']");
				ObjPurchaseCost.val(Assumptions_F4);
				
				//Loan
				Loan                    	= parseFloat(Assumptions_F3) + parseFloat(Assumptions_F4) ;
				ObjLoan                 	= FnTrObj.find("[rel='Loan']");
				ObjLoan.val(Loan);
				
				
				//=(W4+(W4*RentIncreaseRate))
				
				RentIncreaseRate     			=	2  // Valhardcore
				//=(U4+(U4*InflationRate))	
				AnnualRentalIncome          	= (parseFloat(AnnualRentalIncome) + ( (parseFloat(AnnualRentalIncome) / 100) * parseFloat(RentIncreaseRate))).toFixed(2);				
				ObjRentalIncome         	= FnTrObj.find("[rel='RentalIncome']");
				ObjRentalIncome.val(AnnualRentalIncome);
				
				
				//Management Fee (X5)  => W5*RentalMgmtFee      (W5 = Rental Income)
				
				//console.log('RentalMgmtFee='+RentalMgmtFee);
				
				ManagementFee           = (parseFloat(AnnualRentalIncome) * (parseFloat(RentalMgmtFee) / 100)).toFixed(0);
				ObjManagementFee        = FnTrObj.find("[rel='ManagementFee']");
				ObjManagementFee.val(ManagementFee);
				
				//Net Rental Income After Agents Fees (Y5) => W5-X5   (X5 = Management Fee)
				NetRentalIncomeAfterAgentFees       = parseFloat(AnnualRentalIncome) - (parseFloat(ManagementFee) );
				ObjNetRentalIncomeAfterAgentFees    = FnTrObj.find("[rel='NetRentalIncomeAfterAgentFees']");
				ObjNetRentalIncomeAfterAgentFees.val(NetRentalIncomeAfterAgentFees);
				
				//alert("NetRentalIncomeAfterAgentFees=" + NetRentalIncomeAfterAgentFees)
				
				//Cash Rental Expenses (Z5) => CashPropertyExpenses
				
				//=(U4+(U4*InflationRate))	
				CashRentalExpenses          	= (parseFloat(CashRentalExpenses) + ( (parseFloat(CashRentalExpenses) / 100) * parseFloat(InflationRate))).toFixed(2);
				
				ObjCashRentalExpenses   = FnTrObj.find("[rel='CashRentalExpenses']");
				ObjCashRentalExpenses.val( CashRentalExpenses );
				
				
				
				//console.log('OneOffCashCost='+OneOffCashCost);
				
				OneOffCashCost 			=  0  // Valhardcore
				ObjNetCashIncome        = FnTrObj.find("[rel='OneOffCashCost']");
				ObjNetCashIncome.val(OneOffCashCost);
				
				
				//Net Cash Income => =W5-Z5-AA5  (AA5 = OneOffCashCost)
				
				//=W16-Z16-AA16  RentalIncome -cashrentexpense-on off cash

				NetCashIncome           		= parseFloat(AnnualRentalIncome) - parseFloat(CashRentalExpenses) - parseFloat(OneOffCashCost);
				ObjNetCashIncome        		= FnTrObj.find("[rel='NetCashIncome']");
				ObjNetCashIncome.val(NetCashIncome);
				
				//=(AC4+(AC4*InflationRate))
				
				//console.log('FixtureFittingsDepnFirstYr='+FixtureFittingsDepnFirstYr);
				//console.log('InflationRate='+InflationRate);
				
				//Fixtures & Fittings Depn First Year (AC5) => =InitialFixFitCost*FixFitDepnRate
				FixtureFittingsDepnFirstYr      = percentageRate( FixtureFittingsDepnFirstYr, InflationRate );  // function Added);
				ObjFixtureFittingsDepnFirstYr   = FnTrObj.find("[rel='FixtureFittingsDepnFirstYr']");
				ObjFixtureFittingsDepnFirstYr.val(FixtureFittingsDepnFirstYr );
					
				// =AB16-AC16
				//netcashincome - fixtyresandfitting
				
				//Net Rental Profit before int first year - pcc end => Net Cash Income - Fixtures & Fittings Depn First Year
				NetRentalProfitIntFirstYr       = (parseFloat(NetCashIncome) - parseFloat(FixtureFittingsDepnFirstYr)).toFixed(2);
				ObjNetRentalProfitIntFirstYr    = FnTrObj.find("[rel='NetRentalProfitIntFirstYr']");
				ObjNetRentalProfitIntFirstYr.val(NetRentalProfitIntFirstYr);
				
				
				
				ObjPurchasePropertyIfQualifyYes  = FnTrObj.find("[rel='PurchasePropertyIfQualifyYes']");
				ObjPurchasePropertyIfQualifyYes.val(PurchasePropertyQualify);
			
				
				//Drawdown required PDC STEND=> =IF(AE5>0,AE5*PurchaseDecisionCalc!V5,0)    AE5 = Purchase Property? Enter # if qualify is yes, PurchaseDecisionCalc!V5 = Loan
				if (parseFloat(PurchasePropertyQualify) > 0){
					DrawdownReqn                = parseFloat(PurchasePropertyQualify) * parseFloat(Loan);
				}
				else{
					DrawdownReqn                = 0;
				}
				
				ObjDrawdownReqn                 = FnTrObj.find("[rel='DrawdownReqn']"); 
				ObjDrawdownReqn.val(DrawdownReqn);
				

				//=((PurchaseDecisionCalc!T16*L16)+O16)*MaxLVR
				//((PurchaseValue * Properties)+curentPropVa)* 

				BCapLVR                         = ( (parseFloat(Assumptions_F3) * parseFloat(Properties)) + parseFloat(CurrentPropVal) ) * (parseFloat(MaxLVR)/100);
				
				console.log("Assumptions_F3=" + Assumptions_F3 + ", NoOfInvestPropertyOwned=" + NoOfInvestPropertyOwned + ", CurrentPropVal=" + CurrentPropVal + ", MaxLVR=" + MaxLVR);
				ObjBCapLVR                      = FnTrObj.find("[rel='BCapLVR']"); 
				ObjBCapLVR.val(BCapLVR);
				
				
				//IEC - cur inv prop income =CurInvPropInc 
				
				
				
				IecNoOfInvestPropertyOwned = 1  // Valhardcore
				
				ObjIecNoOfInvestPropertyOwned = FnTrObj.find("[rel='IecNoOfInvestPropertyOwned']");
				ObjIecNoOfInvestPropertyOwned.val(IecNoOfInvestPropertyOwned);
				
					// =CurInvPropInc*((1+RentIncreaseRate)^($F16))  Valhardcore
				Incrementrentalrate 			= ( Math.pow( 1 + parseFloat(RentIncreaseRate), parseInt(CurYr) ) ) ;
				CurrentRent          			= parseFloat(CurInvPropInc) + ( (parseFloat(CurInvPropInc) / 100) * parseFloat(Incrementrentalrate));
				ObjCurInvPropIncome             = FnTrObj.find("[rel='CurInvPropIncome']"); 
				ObjCurInvPropIncome.val(CurInvPropInc);
				
				

				IecRentalIncome                 = parseFloat(IecNoOfInvestPropertyOwned) * parseFloat(AnnualRentalIncome);
				ObjIecRentalIncome              = FnTrObj.find("[rel='IecRentalIncome']"); 
				ObjIecRentalIncome.val(IecRentalIncome);
				
				
				IecManagementFee                = parseFloat(IecNoOfInvestPropertyOwned) * parseFloat(ManagementFee);
				ObjIecManagementFee             = FnTrObj.find("[rel='IecManagementFee']"); 
				ObjIecManagementFee.val(IecManagementFee);
				
	
				IecNewRentalIncome              = parseFloat(IecNoOfInvestPropertyOwned) * parseFloat(NetRentalIncomeAfterAgentFees);
				ObjIecNewRentalIncome           = FnTrObj.find("[rel='IecNewRentalIncome']");
				ObjIecNewRentalIncome.val(IecNewRentalIncome)
				
		
				//=$AG16*PurchaseDecisionCalc!Z16
				IecCashRentalExpenses           = parseFloat(IecNoOfInvestPropertyOwned) * parseFloat(CashRentalExpenses)
				ObjIecCashRentalExpenses        = FnTrObj.find("[rel='IecCashRentalExpenses']"); 
				ObjIecCashRentalExpenses.val(IecCashRentalExpenses);
				
				
				
				IedcOneOffCashCost              = parseFloat(IecNoOfInvestPropertyOwned) * parseFloat(OneOffCashCost);
				ObjIedcOneOffCashCost           = FnTrObj.find("[rel='IedcOneOffCashCost']");
				ObjIedcOneOffCashCost.val(IedcOneOffCashCost);
				
					
				//=$AG16*PurchaseDecisionCalc!AB16+AH16
				IecNetCashIncome                = parseFloat(IecNoOfInvestPropertyOwned) * parseFloat(NetCashIncome) + parseFloat(CurInvPropInc);
				ObjIecNetCashIncome             = FnTrObj.find("[rel='IecNetCashIncome']");
				ObjIecNetCashIncome.val(IecNetCashIncome);
				
				// =AS16+AV16+AY16+BB16+BE16+BH16+BK16+BN16+BQ16+BT16+BW16+BZ16+CC16+CF16+CI16+CL16+CO16+CR16+CU16+CX16+DA16+DD16+DG16+DJ16+DM16+DP16+DS16+DV16+DY16+EB16+EE16+EH16+EK16+
				// ====================================== Startet  20191122 =====================================
				// TotalFFCost

				FFCostTotal                     = 0;
				FFDepnTotal                     = 0;
				FFDbvTotal                      = 0;
			
				for (dn = 0; dn <= parseInt(CurYr); dn++){
					//FF Cost => InitialFixFitCost*((1+InflationRate)^($AQ5))*PurchaseDecisionCalc!$AE5
					//console.log(dn);
					
					FFCostNew               =	FnTrObj.find("[rel='FFCost"+ dn +"']").val();
					FFDepn               	=	FnTrObj.find("[rel='FFDepn"+ dn +"']").val();
					FFDbv               	=	FnTrObj.find("[rel='FFDbv"+ dn +"']").val();
					
					if ( dn == 0 ){
						
						if ( FFCostNew > 0 ){
							FFCost				=	FFCostNew	
						}else{
							FFCost				=	0
						}
						
					}else{
						// =InitialFixFitCost*((1+InflationRate)^($AO16))*PurchaseDecisionCalc!$IQ16						
						//FFCost                  = parseFloat(InitialFixFitCost) * parseFloat(FFCostPow) * parseFloat(PurchasePropertyQualify);
						FFCost             		= (parseFloat(InitialFixFitCost) * ( Math.pow( (1+parseFloat(InflationRate)), parseInt($Year) ) ) *(parseFloat(IecNoOfInvestPropertyOwned))).toFixed(2);
				
					}
					
					//FFCostPow                   = (Math.pow((1+(parseFloat(InflationRate)/100)), parseFloat(dn)));
					console.log("FFCostNew=" + FFCost)
					ObjFFCost                   = FnTrObj.find("[rel='FFCost" + dn + "']");
					ObjFFCost.val(FFCost);
					
					//=IF((AS16*FixFitDepnRate)>AU4,AU4,AS16*FixFitDepnRate)
					
				
					
					if ( parseFloat(FFDepn) > parseFloat(FFDbv) ) {
						
						FFDepn					= 	parseFloat(FFDbv);
					}else{
						
						FFDepn                  = ( parseFloat(FFCost) )  * ( parseFloat(FixFitDepnRate) / 100).toFixed(2) ;
					}
					ObjFFDepn                   = FnTrObj.find("[rel='FFDepn" + dn + "']");
					ObjFFDepn.val(FFDepn);
					
					
					FFDbv                       = parseFloat(FFCost) - parseFloat(FFDepn);
					ObjFFDbv                    = FnTrObj.find("[rel='FFDBV" + dn + "']");
					ObjFFDbv.val(FFDbv);
					
					FFCostTotal                 = parseFloat(FFCostTotal) + parseFloat(FFCost);
					FFDepnTotal                 = parseFloat(FFDepnTotal) + parseFloat(FFDepn);
					FFDbvTotal                  = parseFloat(FFDbvTotal) + parseFloat(FFDbv);   
				
				}
				
				ObjTotalFFCost                  = FnTrObj.find("[rel='TotalFFCost']");
				ObjTotalFFDepn                  = FnTrObj.find("[rel='TotalFFDepn']");
				ObjTotalFFBv                    = FnTrObj.find("[rel='TotalFFBv']");
				
				ObjTotalFFCost.val(FFCostTotal);
				ObjTotalFFDepn.val(FFDepnTotal);
				ObjTotalFFBv.val(FFDbvTotal);
				
				ClosingBal                    	= FnTrObj.find("[rel='ClosingBal']").val();
				if ( ClosingBal == undefined){
					ClosingBal 				  	= 0;
				}
				if ( ClosingBal == null){
					ClosingBal 				  	= 1;
				}
				 
				
				YrPDCEnd						= CurYr	
				ObjYrPDCEnd            			= FnTrObj.find("[rel='YrPDCEnd']");
				ObjYrPDCEnd.val(YrPDCEnd);
				 
				 
				
				LastYr 							= CurYr - 1;
				LastMonth						= MaxMonth;
				
				//=IF(PurchaseDecisionCalc!GT4>0,PurchaseDecisionCalc!GT4,0)
				var  LastClosingbalance			= $('#ClosingBal_'+LastYr+'_'+LastMonth).val();
				var  LastClBal					= $('#ClBal_'+LastYr+'_'+LastMonth).val();
				var  LastClBal1					= $('#ClBal_'+LastYr+'_'+LastMonth).val(); //  need to change FS15
				
				
				if (LastClosingbalance == null)
					LastClosingbalance = 0
				
				if (LastClosingbalance == '')
					LastClosingbalance = 1
				if (LastClBal == '')
					LastClBal =399466
				
				//console.log('FixedInterestRate='+FixedInterestRate);

				for (mn = 0; mn <= parseInt(MaxMonth); mn++){
					
					
					if ( LastClosingbalance > 0){
						TotalNonInvLoanBal 		= LastClosingbalance
						
					}else{
						TotalNonInvLoanBal		= 0;
						
					}
					//ObjOpenBal                      = FnTrObj.find("[name='OpenBal'+LastYr+"_"+LastMonth]");
					//ObjOpenBal.val(TotalNonInvLoanBal);
					
					console.log('CurYr='+CurYr);
					$('#OpenBal_'+CurYr+'_'+mn).val(TotalNonInvLoanBal);
					
					
					if (parseFloat(TotalNonInvLoanBal) > 0){ // If it comes correctly then it wil wor TotalOffsetSurplus
					//Deposits - Net Contribution + Current Loan Payments => =IF(FC5>0,TotalOffsetSurplus/   12*(1+NetWageGrowthRate)^($EZ5)    ,0)
						Deposits					= parseFloat(TotalOffsetSurplus) / 12;
					//DepositPow					= Math.pow( (1+ (parseFloat(NetWageGrowthRate) /100) ) , parseFloat(CurYr) );
						Deposits                    = Math.round(percentageRate(Deposits,NetWageGrowthRate )) ;
					//Lump Sum Deposit - MLC END => IF(FC5>0,LumpSumDeposit,0)
						LumpSum						= LumpSumDeposit;
					}
					else{
						Deposits                    = 0;
						LumpSum						= 0;
					}
					
					$('#Deposits_'+CurYr+'_'+mn).val(Deposits);
					$('#LumpSum_'+CurYr+'_'+mn).val(LumpSum);
					
					if(LastClBal < 0 ){
						NonDedOpBal					= 0						
					}else{
						NonDedOpBal					= LastClBal
					}
					
					
					//console.log('NonDedOpBal='+NonDedOpBal);
					
					$('#NonDedOpBal_'+CurYr+'_'+mn).val(NonDedOpBal);
				

					// =IF(FG16>0,(TotalOffsetSurplus/12)*(1+NetWageGrowthRate)^FE16,0)
					if (parseFloat(NonDedOpBal) > 0){ // If it comes correctly then it wil wor TotalOffsetSurplus
						Contributions			=	parseFloat(TotalOffsetSurplus) / 12;
						Contributions               = Math.round(percentageRate(Contributions,NetWageGrowthRate )) ;
					}
					else{
						Contributions				= 0;
					}
					$('#Contributions_'+CurYr+'_'+mn).val(Contributions);
				
					NetCashInputs					= 1695		//Need to work on this, couldnt understand the formula...
					$('#NetCashInputs_'+CurYr+'_'+mn).val(NetCashInputs);

					TotalNCN						= (parseFloat(NonDedOpBal) - parseFloat(Contributions) - parseFloat(NetCashInputs));
					//=IF((FG16-FH16-FI16)>0,PurchaseDecisionCalc!FS16*FixedInterestRate/12,0)
						
					ClBal	=	549060
					if( TotalNCN > 0 ){
						Int  = 0
					}else{
						Int  = 1
					}
					
					IntInv 							= 1830 								// Valhardcore
					$('#IntInv_'+CurYr+'_'+mn).val(IntInv);	// Valhardcore
					WD								= 1
					$('#WD_'+CurYr+'_'+mn).val(WD);

					//=IF(((FG16-FH16-FI16+FJ16+FK16)*FixedInterestRate/12)<0,0,(FG16-FH16-FI16+FJ16+FK16)*FixedInterestRate/12)
						

					var TotalData1 						= ( (parseFloat(TotalNCN) + parseFloat(IntInv) + parseFloat(WD)) * FixedInterestRate / 12 );
					
					//console.log('TotalData1='+ TotalData1);
					
					if (TotalData1 < 0) {
						Int							= 0
					}else{
						Int							= TotalData1	
					}
						
					$('#Int_'+CurYr+'_'+mn).val(Int);
					
					//=IF(FG16-FH16-FI16+FL16+FJ16+FK16<0,   FG16-FH16-FI16+FL16+FK16,     FG16-FH16-FI16+FL16+FJ16+FK16)

					

					var TotalData2						=  parseFloat(TotalNCN) + parseFloat(IntInv) + parseFloat(WD) + parseFloat(Int) ;
		
					
					//console.log('TotalData2='+TotalData2);
					if (TotalData2 < 0){
						ClBal						= parseFloat(TotalNCN) + parseFloat(Int) + parseFloat(WD)
					}else{
						ClBal						= parseFloat(TotalNCN) + parseFloat(Int) + parseFloat(WD) + parseFloat(IntInv) 
					}
					$('#ClBal_'+CurYr+'_'+mn).val(ClBal);
					
					//=IF(FS15<0,0,FS15)
					

					ClBalfbc	=	549060
					if( ClBalfbc < 0 ){
						DedLOCOpBal  = 0
					}else{
						DedLOCOpBal  = ClBalfbc
					}
					$('#DedLOCOpBal_'+CurYr+'_'+mn).val(DedLOCOpBal);
					
					
					//=IF(PurchaseDecisionCalc!FG16>0,0,
					//(TotalOffsetSurplus*(1+NetWageGrowthRate)^PurchaseDecisionCalc!FE16)/12)+
					//IF((PurchaseDecisionCalc!FG16-PurchaseDecisionCalc!FH16-PurchaseDecisionCalc!FI16)<0,-PurchaseDecisionCalc!FM16,0)
										
					if ( NonDedOpBal > 0) {
						Contributions1Pow =  Math.pow( (1+ (parseFloat(NetWageGrowthRate) /100) ),parseFloat(CurYr)); 
						Contributions1	  =  ( parseFloat(TotalOffsetSurplus) * (Contributions1Pow)) / 12 
						
						if ( (parseFloat(NonDedOpBal) - parseFloat(Contributions) - parseFloat(NetCashInputs)) < 0 ) {
							TotContributions1 = Contributions1 - parseFloat(ClBal)
						}else{
							TotContributions1 = 0
						}
						

					}else{
						TotContributions1 	  = 0
					}
					//console.log(TotContributions1);
					
					// $('#Contributions_'+CurYr+'_'+mn).val(TotContributions1);
					
					//=IF(PurchaseDecisionCalc!FG17>0,0,VLOOKUP(PurchaseDecisionCalc!FE17,PurchaseDecisionCalc!$AF$4:$AN$424,9)/12)
					NetCashInputs1	=  1
					if (NonDedOpBal > 0){
						NetCashInputs1 =  1
					}else{
						
						NetCashInputs1 =  1
					}
					// $('#Contributions_'+CurYr+'_'+mn).val(NetCashInputs1);
					WD1								= 1
					//$('#WD_'+CurYr+'_'+mn).val(WD1);
			
					//=IF(((FN16-FO16-FP16+FQ16)*FixedInterestRate/12)<0,0,(FN16-FO16-FP16+FQ16)*FixedInterestRate/12)
					
					TotalData3 			=	( parseFloat(DedLOCOpBal) - parseFloat(TotContributions1) - parseFloat(NetCashInputs1) + parseFloat(WD1) ) * (FixedInterestRate/100) /12 ;
					
				
					if (TotalData3 < 0 ){
						
						Int1		=	0
					}else{
						Int1		=	TotalData3
						
					}
				
					//$('#Int1'+CurYr+'_'+mn).val(Int1);
					
					//=IF(PurchaseDecisionCalc!FG16>0,FS15+FQ16,IF(FS15-FO16-FP16+FR16+FQ16<0,0,FS15-FO16-FP16+FR16+FQ16))
					TotalData4			=	parseFloat(DedLOCOpBal) - parseFloat(TotContributions1) - parseFloat(NetCashInputs1) + parseFloat(WD1) + parseFloat(Int1) 
					if ( NonDedOpBal > 0 ){
						CalBal1 	=	parseFloat(LastClBal1) + parseFloat(WD1)
					}
					else if(TotalData4 < 0) {
						CalBal1		=	0
					}else{
						CalBal1		=	TotalData4
					}
					CalBal1 		= 	569060 // Valhardcore
					//$('#CalBal1'+CurYr+'_'+mn).val(CalBal1);
					FBCStart =  549060
					$('#FBCStart_'+CurYr+'_'+mn).val(FBCStart);

					console.log('CalBal1='+CalBal1);
					//LastClBal1
					console.log('FBCStart='+FBCStart);
					FBCFX			=	parseFloat(CalBal1) - parseFloat(FBCStart)
					console.log('FBCFX='+FBCFX);
					$('#FBCFX_'+CurYr+'_'+mn).val(FBCFX);
				
					//=FV16*TaxDedLOCIntRate/12
					TaxDedLOCIntRate	=	40  // Valhardcore
				
					FBCFY			=	((parseFloat(FBCFX) * parseFloat(TaxDedLOCIntRate/100)) / 12).toFixed(2);
					$('#FBCFY_'+CurYr+'_'+mn).val(FBCFY);
					
					//=PurchaseDecisionCalc!FS16-FW16
					FBCEnd			=	(parseFloat(NonDedOpBal) - parseFloat(FBCFY)).toFixed(2);
					$('#FBCEnd_'+CurYr+'_'+mn).val(FBCEnd);
				
				
					//=IF(FA16>0,(VLOOKUP($EX16,PurchaseDecisionCalc!$AF$4:$AN$424,9,FALSE))/12,0)
						
					
					DepositNetCashRentalIncome			=	1,729
				
					if ( TotalNonInvLoanBal > 0){
						DepositNetCashRentalIncome		= DepositNetCashRentalIncome
					}else{
						DepositNetCashRentalIncome		=	0
					} 
					$('#DepositNetCashRentalIncome_'+CurYr+'_'+mn).val(DepositNetCashRentalIncome);
					
					//=IFERROR(VLOOKUP(EW15,PurchaseDecisionCalc!$B$4:$E$424,4,FALSE),0)
					NonDeductibleWithdrawDrawdones		=	1
					$('#NonDeductibleWithdrawDrawdones_'+CurYr+'_'+mn).val(NonDeductibleWithdrawDrawdones);
					
					
					FixedLoanBalance = 3,96,568
					$('#FixedLoanBalance_'+CurYr+'_'+mn).val(FixedLoanBalance);
				
					//=GX15

					$('#OpenBal_'+CurYr+'_'+mn).val(LastClosingbalance);
					
					//=IF(PurchaseDecisionCalc!FZ16=0,(VLOOKUP(PurchaseDecisionCalc!EX16,PurchaseDecisionCalc!$AF$4:$AN$424,9,FALSE))/12,0)
					DepositNetCashRentalIncome1			=	1
					$('#DepositNetCashRentalIncome_'+CurYr+'_'+mn).val(DepositNetCashRentalIncome1);
					
					//=IFERROR(VLOOKUP(PurchaseDecisionCalc!EW16,PurchaseDecisionCalc!$B$4:$IR$424,10,FALSE),0)
					WithdrawalsDrawdowns			=	5,49,060
					$('#WithdrawalsDrawdowns_'+CurYr+'_'+mn).val(WithdrawalsDrawdowns);
					
					
					LumpSumDeposit					=	0
					$('#LumpSumDeposit_'+CurYr+'_'+mn).val(LumpSumDeposit);
					
					
						
					//=IF(PurchaseDecisionCalc!FA16>0,
					//IF((PurchaseDecisionCalc!FA16-PurchaseDecisionCalc!FB16-PurchaseDecisionCalc!FC16-PurchaseDecisionCalc!FZ16+PurchaseDecisionCalc!GA16)<0,
					//PurchaseDecisionCalc!FA16-PurchaseDecisionCalc!FB16-PurchaseDecisionCalc!FC16-PurchaseDecisionCalc!FZ16+PurchaseDecisionCalc!GA16-GS16,0),TotalOffsetSurplus/12*(1+NetWageGrowthRate)^(PurchaseDecisionCalc!$EX16))
					
					//GS16 Need to Work Yasir
					if ( parseFloat(TotalNonInvLoanBal) > 0){
						DepositNetContributionChk = parseFloat(TotalNonInvLoanBal) - parseFloat(Deposits) - parseFloat(LumpSum) - parseFloat(DepositNetCashRentalIncome) + parseFloat(NonDeductibleWithdrawDrawdones)
						if ( DepositNetContributionChk < 0) {
							
							DepositNetContribution	=	DepositNetContributionChk
						}else{
							
							
						}
					}else{
						//TotalOffsetSurplus/12*(1+NetWageGrowthRate)^(PurchaseDecisionCalc!$EX16)
					}
					
					
					//=GB16-GF16-GE16-GC16+GD16
					BalanceBeforeInterest			=	parseFloat(LastClosingbalance) - parseFloat(DepositNetContribution) - parseFloat(DepositNetCashRentalIncome1) - parseFloat(DepositNetCashRentalIncome) + parseFloat(WithdrawalsDrawdowns)
					$('#BalanceBeforeInterest_'+CurYr+'_'+mn).val(BalanceBeforeInterest);
					
					
					FixedLoanBalance				=	5,490,60
					$('#FixedLoanBalance_'+CurYr+'_'+mn).val(FixedLoanBalance);
					
					
					//=GG16-GH16
					
					LineOfCreditBalance				=	parseFloat(BalanceBeforeInterest) - parseFloat(FixedLoanBalance) 
					$('#LineOfCreditBalance_'+CurYr+'_'+mn).val(LineOfCreditBalance);
					
					//=GH16*FixedInterestRate/12
					FixedLoanInterest				=	(parseFloat(FixedLoanBalance) *  (FixedInterestRate/100)) /12
					$('#FixedLoanInterest_'+CurYr+'_'+mn).val(FixedLoanInterest);
					
					
					//=IF(GI16<0,0,GI16)*TaxDedLOCIntRate/12
					
					if ( LineOfCreditBalance < 0) {
						LineOfCreditBalance			=	0
					}else{
						LOCInterest					=	parseFloat(LineOfCreditBalance) * (TaxDedLOCIntRate / 100) /12
					}
					
					$('#LOCInterest_'+CurYr+'_'+mn).val(LOCInterest);
					
					
					//=GJ16+GK16
					
					TotalDedInt						=	parseFloat(FixedLoanInterest) + parseFloat(LOCInterest)
					
					$('#TotalDedInt_'+CurYr+'_'+mn).val(TotalDedInt);
					
					
					//=IF(FA16>0,PurchaseDecisionCalc!GL16,0) 
						
					if ( LastClosingbalance > 0){
						TotalDedInterestCharge		= TotalDedInt
					}else{
						TotalDedInterestCharge		=	0
					} 
					$('#TotalDedInterestCharge_'+CurYr+'_'+mn).val(TotalDedInterestCharge);
				
				
				
				}
				//Arzath your code will ends here..
				
				
			}
		});
    };
    
    var CheckIsNaN = function(FnValue){
        if (isNaN(parseFloat(FnValue)))
            FnValue = 0;
        
        return parseFloat(FnValue);
    };
        


</script>

</body>
</html>

<?php ob_end_flush(); ?>