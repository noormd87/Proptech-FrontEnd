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

$MaxYrs             = $ClsSales::$RemainRetireYrs;
//echo $MaxYrs;
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
	$LoadStyle = "";
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
				<div style="text-align:right">
					<select name="Link<?php echo $i;?>" rel="Links" client_id="<?php echo $Id; ?>" >
						<option value="">Select</option>
						 <option value="pdc" <?php if ($FieldType == "pdc") echo "selected"; ?>>Purchase Decision Calc</option>
						<option value="MLC" <?php if ($FieldType == "MLC") echo "selected"; ?>>Monthly LOC Calc</option>
						<option value="FBC" <?php if ($FieldType == "FBC") echo "selected"; ?>>Fixed Bal Calc</option>
						<option value="iec" <?php if ($FieldType == "iec") echo "selected"; ?>>Income Expense Calc</option>
						<option value="pcc" <?php if ($FieldType == "pcc") echo "selected"; ?>>Property Cost Calc</option>
						<option value="bcc" <?php if ($FieldType == "bcc") echo "selected"; ?>>Borrowing Capacity Calc</option>
						<option value="FBC" link_type="purchaseDecision/reportingincomenetworth">Reporting Income Net Worth</option>

						<option value="RM" <?php if ($FieldType == "RM") echo "selected"; ?>>Reporting Mortgage</option>
						<option value="RAA" <?php if ($FieldType == "RAA") echo "selected"; ?>>Reporting Asset Accumulation</option>
						<option value="FBC" link_type="purchaseDecision/ReportingNetWorthatRetirement">Reporting Net Worth at Retirement</option>
						<option value="NWC" <?php if ($FieldType == "NWC") echo "selected"; ?>>Net Worth Calc</option>
						<option value="AAC" <?php if ($FieldType == "AAC") echo "selected"; ?>>Asset Accumulation Calc</option>
						<option value="dn" <?php if ($FieldType == "dn") echo "selected"; ?>>Depn Calc</option>

						<option value="TotalTradLoans" link_type="reports/TotalTradLoans">Total Trad Loans</option>
						<option value="noninvloan1" link_type="reports/noninvloan1">Non Investment Loans 1</option>
						<option value="noninvloan2" link_type="reports/noninvloan2">Non Investment Loans 2</option>
						<option value="noninvloan3" link_type="reports/noninvloan3">Non Investment Loans 3</option>
						<option value="invloan1" link_type="reports/invloan1">Investment Loans 1</option>
						<option value="invloan2" link_type="reports/invloan2">Investment Loans 2</option>
						<option value="invloan3" link_type="reports/invloan3">Investment Loans 3</option>

						
						
					</select>
				</div>
				<br />



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

					/*$DefaultValArr		= array("NonDeductibleExpEveryYr"  		=> "100", 
												"NoOfInvestPropertyOwned"		=> "1", 
												"OneOffCashCost"				=> "1", 
												"PurchasePropertyIfQualifyYes"	=> "1"
											   );      *///Commented by Arzath in Live 14-12-2019
                    
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
                    $InvestmentGrowthRate       = $ValueArr["InvestmentGrowthRate"] ?? "";
					$NonDedLOCIntRate			= floatval($ValueArr["NonDedLOCIntRate"] ?? 0);
				
					// Arzath Start
					$Client1KiwisaverRate		= floatval($ValueArr["Client1KiwisaverRate"] ?? 0);
					$Client2KiwisaverRate		= floatval($ValueArr["Client2KiwisaverRate"] ?? 0);
					 
                    
                    
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
							<input type='hidden' name='InvestmentGrowthRate' id='InvestmentGrowthRate' value='{$InvestmentGrowthRate}' />
							<input type='hidden' name='NonDedLOCIntRate' id='NonDedLOCIntRate' value='{$NonDedLOCIntRate}' />

							<!-- Arzath Start-->
							<input type='hidden' name='PurchaseProp' id='PurchaseProp' value='1' />
							<input type='hidden' name='Client1KiwisaverRate' id='Client1KiwisaverRate' value='4' />
							<input type='hidden' name='Client2KiwisaverRate' id='Client2KiwisaverRate' value='4' />
                            
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
                                                    
                                            echo "<th style='{$TdStyle}' cat_name='{$Field_Cat}'>{$ArrFields2["FIELD_DESC"]}</th>";
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
										
										/*  Arzath - 2019-12-05 */
										$ValueArr["AACYear"] = $i;
										$ValueArr["NWCYear"] = $i;
										$ValueArr["RMYear"] = $i;
										$ValueArr["EndofYear"] = $i + 1;
										
                                        
                                        
                                        
                                        
                                        
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
                                                    $IsSaveField= $ArrFields2["SAVE_UPDATE_FIELD"] ?? "";
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
                                                        echo "<td style='{$TdStyle}' cat_name='{$Field_Cat}'>
                                                                <input  type='text' name='{$FieldName}' save_upd_field='{$IsSaveField}'
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

		URL					= "<?php echo SITE_BASE_URL; ?>purchaseDecision/save.html?dt=<?php echo date("YmdHis"); ?>&id=<?php echo $Id; ?>";
		console.log("URL=" + URL)
		save_upd_fields		= $("[save_upd_field='Y'][month='0']").map(function(){ return $(this).attr("year") + "~" + $(this).attr("rel") + "~" + this.value }).get();

		//$.post( URL, { 'update_values[]': save_upd_fields } )
			
		$("#loading").html("<div style=' padding-top:40px;'><strong>Saving Data... </strong></div>");
		// Send the data using post
		var posting = $.post( URL, { 'update_values[]': save_upd_fields } );

		// Put the results in a div
		posting.done(function( data ) {
			//alert(data);
			$("#loading").html("<div style=' padding-top:40px;'><strong>Saving Saved successfully... </strong></div>");
			$("#loading").hide(); 
		});


		//$("#loading").hide(); 
	});

    $(document).ready(function(){
		$(document).on("change", "[rel='Links']", function(){
			id = $(this).attr("client_id");
			menu_name = this.value;
			

			link_type = $(this).find('option:selected').attr("link_type");
			query_str = $(this).find('option:selected').attr("query_str");
			
			if (query_str == undefined){
				query_str = "";
			}
			
			if (query_str != ""){
				query_str = "&" + query_str;
			}

			if (link_type == undefined){
				$("[cat_name]").hide();
				$("[cat_name='" + menu_name + "']").show();
			}
			else{
				//window.location.href = "<?php echo SITE_BASE_URL; ?>" + link_type + ".html?d=<?php echo time(); ?>&id=" + id + query_str; 
				window.open("<?php echo SITE_BASE_URL; ?>" + link_type + ".html?d=<?php echo time(); ?>&id=" + id + query_str, '_blank'); 
			}
			
			//console.log("<?php echo SITE_BASE_URL; ?>" + link_type + ".html?d=<?php echo time(); ?>&id=" + id + query_str);
			//return false; 
			
			//
		});

        //$(document).on("keyup blur", "[rel='NonDeductibleExpEveryYr'], [rel='NoOfInvestPropertyOwned'], [rel='NoOfInvestPropertyOwned'], [rel='OneOffCashCost']", function(){
        
        $(document).on("blur", "input:not([readonly])", function(){
            //console.log(this.name);
			$("#loading").html("<div style=' padding-top:40px;'><strong>Calculating...</strong></div>");


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
	 
		originalPercentagValue          	= 0			

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
		NonDedLOCIntRate			= CheckIsNaN( $("[name='NonDedLOCIntRate']").val() );

        FixedInterestRate		= CheckIsNaN( $("[name='FixedInterestRate']").val() );
		

		// ============= Arzath ========= 
		PurchaseProp			= CheckIsNaN( $("[name='PurchaseProp']").val() );
		TaxDedLOCIntRate		= CheckIsNaN( $("[name='TaxDedLOCIntRate']").val() );
		InvestmentGrowthRate	= CheckIsNaN( $("[name='InvestmentGrowthRate']").val() );
		Client1KiwisaverRate	= CheckIsNaN( $("[name='Client1KiwisaverRate']").val() );
		Client2KiwisaverRate	= CheckIsNaN( $("[name='Client2KiwisaverRate']").val() );
		
		
        
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
				TotalSal				= TotSalary;
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
				 
				
				DSRAmt                  = Math.round( ( parseFloat(TotSalary) * (parseFloat(DSRSalary)/100) ) + ( parseFloat(TotalRent) * (parseFloat(DSRRent)/100) ) );
				ObjDSRAmt               = FnTrObj.find("[rel='DSRAmt']");
				ObjDSRAmt.val( DSRAmt );
				
				//B/Cap DSR - BCC END => BCapDSR  = Q5/LOCTestRate (Q5 is DSRAmt)
				BCapDSR                 = Math.round( parseFloat(DSRAmt) / parseFloat(LOCTestRate/100) );
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
				CurInvPropIncome				= CurInvPropInc;
				ObjCurInvPropIncome             = FnTrObj.find("[rel='CurInvPropIncome']"); 
				ObjCurInvPropIncome.val(CurInvPropIncome);
				
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

				//console.log("TotalNonInvLoanBal=" + TotalNonInvLoanBal)
				
				
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
				

			/* Arzath Start 0 VALUE ===================================*/

				OpenBal	= parseFloat(TotalNonInvLoanBal)			
				if ( parseFloat(TotalNonInvLoanBal) > 0 ) {
					MlcDepositNetCashRentalIncome =  Math.round(parseFloat(IecNetCashIncome) / 12) ;	
					
				}else{
					
					MlcDepositNetCashRentalIncome = 0
				}
							
				ObjMlcDepositNetCashRentalIncome		= FnTrObj.find("[rel='MlcDepositNetCashRentalIncome']");
				ObjMlcDepositNetCashRentalIncome.val(MlcDepositNetCashRentalIncome);
												
										
				//GB//=IFERROR(VLOOKUP(EW16,PurchaseDecisionCalc!$B$4:$E$424,4,FALSE),0)	
					//IFERROR(VLOOKUP(MlcYrStart,InflationAdjustPdcEnd,FALSE),0)
								
				InflationAdjustPdcEnd			= CheckIsNaN( $("[name='InflationAdjustPdcEnd']").val() );
				NonDeductibleWithdrawDrawdones	= InflationAdjustPdcEnd;
				ObjNonDeductibleWithdrawDrawdones	= FnTrObj.find("[rel='NonDeductibleWithdrawDrawdones']");
				ObjNonDeductibleWithdrawDrawdones.val(NonDeductibleWithdrawDrawdones);

							
			
				
				//Subtotal///=FA17-FB17-FC17-FD17+FE17 //OpenBal - Deposits - LumpSum
				
				Subtotal								=	parseFloat(OpenBal) - parseFloat(Deposits) - parseFloat(LumpSum) - parseFloat(MlcDepositNetCashRentalIncome) + parseFloat(NonDeductibleWithdrawDrawdones)  
				

				//GD//=IF(PurchaseDecisionCalc!GA16=0,(VLOOKUP(PurchaseDecisionCalc!EX16,PurchaseDecisionCalc!$AF$4:$AN$424,9,FALSE))/12,0) Old
				
				
				
				//MLC Open Bal (MlcOpenBal)	=> =TotalInvLoanBal
				MlcOpenBal						= TotalInvLoanBal;
				ObjMlcOpenBal					= FnTrObj.find("[rel='MlcOpenBal']");
				ObjMlcOpenBal.val(MlcOpenBal);
				
				
				//Deposits - Net Contribution + Current Loan Payments	
				//DepositNetContribution  	New			
				//=IF(FA17>0,IF(FF17<0,-FF17,0),TotalOffsetSurplus/12*(1+NetWageGrowthRate)^($EX17))
				//IF(OpenBal>0,IF(SubTotal<0,-SubTotal,0),TotalOffsetSurplus/12*(1+NetWageGrowthRate)^(MlcYr)) LumpSumDeposit
				//=IF(FA5>0,IF(FF5<0,-FF5,0),TotalOffsetSurplus/12*(1+NetWageGrowthRate)^($EX5))
				if ( parseFloat(OpenBal) > 0 ) {
					if ( parseFloat(Subtotal) < 0){
						
						DepositNetContribution = -parseFloat(Subtotal)
					}else{
						DepositNetContribution = 0
					}					
				}else{
					DepositNetContributionPow = Math.pow(( 1 + ( parseFloat(NetWageGrowthRate) / 100 ) ) , parseFloat(CurYr) );					
					DepositNetContribution  = Math.round(((parseFloat(TotalOffsetSurplus) / 100) /12) * parseFloat(DepositNetContributionPow)) 
				}
					
				//console.log('DepositNetContribution='+DepositNetContribution);
				ObjDepositNetContribution		= FnTrObj.find("[rel='DepositNetContribution']");
				ObjDepositNetContribution.val(DepositNetContribution);	
				
				
				//Lump Sum Deposit //IF(FA6>0,0,LumpSumDeposit) // 
				//IF(OpenBal>0,0,LumpSumDeposit)
					
				if (LumpSumDeposit == "")
					LumpSumDeposit = 0
				
				if ( parseFloat(OpenBal) > 0 ) {
					
					LumpSumDeposit 				= 0
				} else{
					LumpSumDeposit 				= LumpSumDeposit
					
				}
				
				ObjLumpSumDeposit						= FnTrObj.find("[rel='LumpSumDeposit']");
				ObjLumpSumDeposit.val(LumpSumDeposit);	
				
				
				
				
				//Deposits - Net Cash Rental Income
				//=IF(FD17=0,(VLOOKUP(EX17,$AF$5:$AN$425,9,FALSE))/12,0)
				//IF(FD8=0,(VLOOKUP(EX8,$AF$6:$AN$426,9,FALSE))/12,0)					
				//IF(PMlcDepositNetCashRentalIncome=0,(VLOOKUP(MlcYr,IecNetCashIncome,FALSE))/12,0)
				
				if (parseFloat(MlcDepositNetCashRentalIncome) == 0) {
					DepositNetCashRentalIncome  		=	Math.round(parseFloat(IecNetCashIncome) / 12) ;	

				}else{
					DepositNetCashRentalIncome			= 0
				}
				
				ObjDepositNetCashRentalIncome			= FnTrObj.find("[rel='DepositNetCashRentalIncome']");
				ObjDepositNetCashRentalIncome.val(DepositNetCashRentalIncome);		

				//Withdrawals / Drawdowns
				//	//=IFERROR(VLOOKUP(EW5,$B$5:$HV$425,10,FALSE),0)
				WithdrawalsDrawdowns					= Math.round(DrawdownReqn)
				ObjWithdrawalsDrawdowns					= FnTrObj.find("[rel='WithdrawalsDrawdowns']");
				ObjWithdrawalsDrawdowns.val(WithdrawalsDrawdowns);		
				

				
				//GH//Balance before interest//=GC16-GG16-GF16-GD16+GE16
				//Balance before interest
				//=FG17-FH17-FI17-FJ17+FK17

				
				BalanceBeforeInterest			=  Math.round(parseFloat(MlcOpenBal) - parseFloat(DepositNetContribution) - parseFloat(LumpSumDeposit) - parseFloat(DepositNetCashRentalIncome) + parseFloat(WithdrawalsDrawdowns))
				
				ObjBalanceBeforeInterest		= FnTrObj.find("[rel='BalanceBeforeInterest']");
				ObjBalanceBeforeInterest.val(BalanceBeforeInterest);	

				//Fixed Loan Balance =IF(PurchaseDecisionCalc!FA4>0,GH4,(VLOOKUP((PurchaseDecisionCalc!EX4+1),PurchaseDecisionCalc!$FD$4:$FN$435,11))+(SUMIFS(PurchaseDecisionCalc!$FX$4:$FX$435,PurchaseDecisionCalc!$FE$4:$FE$435,PurchaseDecisionCalc!FE4)))

				//=IF((FL5)<0.1,0,IF(VLOOKUP(EX5,$EW$5:$FA$434,5)>0,FL5,
				
				//VLOOKUP(EX5,$EW$5:$FG$434,11)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AN$425,9)+
				//(VLOOKUP(EX5,$EW$5:$FG$434,11)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AN$425,9))*FixedInterestRate))
				//IF((BalanceBeforeInterest)<0.1,0,IF(VLOOKUP(MlcYr,OpenBal)>0,BalanceBeforeInterest,VLOOKUP(MlcYr,MlcOpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome)+(VLOOKUP(MlcYr,MlcOpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome))*FixedInterestRate))
				
			  if ( parseFloat(BalanceBeforeInterest) < 0.1 ) {
				  
				  MlcFixedLoanBalance = 0
				  
			  }else{
				  
				  
				  if ( parseFloat(OpenBal) > 0 ) {
					  
					  MlcFixedLoanBalance	= BalanceBeforeInterest;
				  }else{
					  
					MlcFixedLoanBalancEPlus					= parseFloat(TotalOffsetSurplus);
					MlcFixedLoanBalancEPow					= Math.pow((1+(parseFloat(NetWageGrowthRate)/100)), parseFloat(CurYr));
					MlcFixedLoanBalancTotal					= Math.round(parseFloat(MlcFixedLoanBalancEPlus) * parseFloat(MlcFixedLoanBalancEPow));
					  
					  MlcFixedLoanBalance	= parseFloat(OpenBal) - parseFloat(MlcFixedLoanBalancTotal) - parseFloat(IecNetCashIncome) + (parseFloat(OpenBal) - parseFloat(MlcFixedLoanBalancTotal) - parseFloat(IecNetCashIncome) ) * parseFloat(FixedInterestRate) / 100
				  }
				  
			  }
		
		
		
				
			ObjMlcFixedLoanBalance			= FnTrObj.find("[rel='MlcFixedLoanBalance']");
			ObjMlcFixedLoanBalance.val(MlcFixedLoanBalance);


				
			//Fixed Loan Interest => =GI4*FixedInterestRate/12		MlcFixedLoanInterest = MlcFixedLoanBalance * FixedInterestRate /12
			MlcFixedLoanInterest			= parseFloat(MlcFixedLoanBalance) * (parseFloat(FixedInterestRate)/100) / 12;
			ObjMlcFixedLoanInterest			= FnTrObj.find("[rel='MlcFixedLoanInterest']");
			ObjMlcFixedLoanInterest.val(MlcFixedLoanInterest);



			//Line of Credit Balance//=IF(FM5<0,FL5,FL5-FM5)
			//LineOfCreditBalance => =BalanceBeforeInterest-MlcFixedLoanBalance
		
			if ( parseFloat(MlcFixedLoanBalance) < 0 ){
				MlcLineOfCreditBalance		= parseFloat(MlcFixedLoanBalance);
				
			}else{
			MlcLineOfCreditBalance			= parseFloat(BalanceBeforeInterest) - parseFloat(MlcFixedLoanBalance);
			}
			ObjMlcLineOfCreditBalance		= FnTrObj.find("[rel='MlcLineOfCreditBalance']");
			ObjMlcLineOfCreditBalance.val(MlcLineOfCreditBalance);

			
			//Old//LOC Interest => =IF(GJ4<0,0,GJ4)*TaxDedLOCIntRate/12			MlcLOCInterest = IF(MlcLineOfCreditBalance<0,0,MlcLineOfCreditBalance)*TaxDedLOCIntRate/12 
			//=IF(FO5<0,0,FO5)*TaxDedLOCIntRate/12
			
			if (parseFloat(MlcLineOfCreditBalance) < 0){
				MlcLOCInterest_Temp			= 0;
			}
			else{
				MlcLOCInterest_Temp			= MlcLineOfCreditBalance;
			}

			MlcLOCInterest					= parseFloat(MlcLOCInterest_Temp) * ( parseFloat(MlcLOCInterest_Temp) /100 ) /12;
			ObjMlcLOCInterest				= FnTrObj.find("[rel='MlcLOCInterest']");
			ObjMlcLOCInterest.val(MlcLOCInterest);

			
			//Total Ded Int => =GK4+GL4			TotalDedInt	= MlcFixedLoanInterest + MlcLOCInterest
			//=FN5+FP5
			TotalDedInt						= parseFloat(MlcFixedLoanInterest) + parseFloat(MlcLOCInterest);
			ObjTotalDedInt					= FnTrObj.find("[rel='TotalDedInt']");
			ObjTotalDedInt.val(TotalDedInt);

			//=FL5+FR5
			
			//old//Total Ded Interest Charge => =IF(GU4>0,0,GM4)		TotalDedInterestCharge = IF(ClosingBal>0,0,TotalDedInt)
			//New//=IF(FA5>0,0,FQ5)
		
			if (parseFloat(OpenBal) > 0){
				TotalDedInterestCharge			= 0;
			}
			else{
				TotalDedInterestCharge			= TotalDedInt;
			}
			ObjTotalDedInterestCharge			= FnTrObj.find("[rel='TotalDedInterestCharge']");
			ObjTotalDedInterestCharge.val(TotalDedInterestCharge);	

			//MlcClosingBal

			
			//Closing Balance => =GH4+GX4		MlcClosingBal = BalanceBeforeInterest + TotalDedInterestCharge
			MlcClosingBal						= parseFloat(BalanceBeforeInterest) + parseFloat(TotalDedInterestCharge);
			ObjMlcClosingBal					= FnTrObj.find("[rel='MlcClosingBal']");
			ObjMlcClosingBal.val(MlcClosingBal);	
			
			//Investment Interest//=IF(FA5>0,FQ5,0) InvestmentInterest
			
			//Investment Interest	=> =IF(FA4>0,PurchaseDecisionCalc!GM4,0)		InvestmentInterest = IF(TotalNonInvLoanBal>0,TotalDedInt,0)
				
			if (parseFloat(OpenBal) > 0){
				InvestmentInterest			= TotalDedInt;
			}
			else{
				InvestmentInterest			= 0;
			}
			ObjInvestmentInterest			= FnTrObj.find("[rel='InvestmentInterest']");
			ObjInvestmentInterest.val(InvestmentInterest);
		
			
			//Balance before interest mlc end //MlcBalanceBeforeInterest
			//=FF5+FT5
			
			MlcBalanceBeforeInterest 		= parseFloat(Subtotal) + parseFloat(InvestmentInterest)
			ObjMlcBalanceBeforeInterest		= FnTrObj.find("[rel='MlcBalanceBeforeInterest']");
			ObjMlcBalanceBeforeInterest.val(MlcBalanceBeforeInterest);

			
			
			//FixedLoanBalance
			//=IF($FA5<0.1,0,(VLOOKUP($EX5,$EW$5:$FA$434,5)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AP$425,9))+FM5*FixedInterestRate+(VLOOKUP($EX5,$EW$5:$FA$434,5)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AP$425,9))*FixedInterestRate)
			//IF(OpenBal<0.1,0,(VLOOKUP(MlcYr,OpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome))+FM7*FixedInterestRate+(VLOOKUP(MlcYr,OpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome))*FixedInterestRate)
			
				
		  if ( parseFloat(OpenBal) < 0.1 ) {
			  
			  FixedLoanBalance = 0
			  
		  }else{
			  
			 FixedLoanBalancEPow = Math.pow(( 1 + ( parseFloat(NetWageGrowthRate) / 100 ) ) , parseFloat(CurYr) );					
			 FixedLoanBalancTotal  = Math.round((parseFloat(TotalOffsetSurplus) ) * parseFloat(FixedLoanBalancEPow)) 
					
				
			  FixedLoanBalancecal1	= 	parseFloat(OpenBal) - parseFloat(FixedLoanBalancTotal) - parseFloat(IecNetCashIncome) 
			  FixedLoanBalancecal2 	=   MlcFixedLoanBalance *  parseFloat(FixedInterestRate) / 100
			  FixedLoanBalancecal3 	=	(parseFloat(OpenBal) - parseFloat(FixedLoanBalancTotal) - parseFloat(IecNetCashIncome) ) * parseFloat(FixedInterestRate) / 100
				

			  FixedLoanBalance		=	parseFloat(FixedLoanBalancecal1) +  parseFloat(FixedLoanBalancecal2) + parseFloat(FixedLoanBalancecal3)
		  }
		
		
			ObjFixedLoanBalance					= FnTrObj.find("[rel='FixedLoanBalance']");
			ObjFixedLoanBalance.val(FixedLoanBalance);	

			//=IF(FV5<0,0,FV5*FixedInterestRate/12) FixedLoanInterest
			//FixedLoanInterest = IF(FixedLoanBalance<0,0,FixedLoanBalance*FixedInterestRate/12)
			
			if (parseFloat(FixedLoanBalance) < 0){
				FixedLoanInterest				= 0;
			}
			else{
				FixedLoanInterest				= Math.round(parseFloat(FixedLoanBalance) * (parseFloat(FixedInterestRate) / 100) /12);
			}
			ObjFixedLoanInterest				= FnTrObj.find("[rel='FixedLoanInterest']");
			ObjFixedLoanInterest.val(FixedLoanInterest);
			//=IF(FV5<0,FU5,FU5-FV5)		
			//LineOfCreditBalance
			//Line of Credit Balance => =PurchaseDecisionCalc!GO4-GP4			LineOfCreditBalance = MlcBalanceBeforeInterest - FixedLoanBalance
			//=IF(FV5<0,FU5,FU5-FV5)
			if ( FixedLoanBalance < 0){
				
				LineOfCreditBalance		=  parseFloat(MlcBalanceBeforeInterest)
			}else{
				LineOfCreditBalance		=  parseFloat(MlcBalanceBeforeInterest)
			}
		
			LineOfCreditBalance					= (parseFloat(MlcBalanceBeforeInterest) - parseFloat(FixedLoanBalance)).toFixed(2);
			ObjLineOfCreditBalance				= FnTrObj.find("[rel='LineOfCreditBalance']");
			ObjLineOfCreditBalance.val(Math.round(LineOfCreditBalance));	


			//LOC Interest => =IF(GQ4<0,0,GQ4)*NonDedLOCIntRate/12		LOCInterest = IF(LineOfCreditBalance<0,0,LineOfCreditBalance)*NonDedLOCIntRate/12
			//=IF(FX5<0,0,FX5)*NonDedLOCIntRate/12
			if (parseFloat(LineOfCreditBalance) < 0){
				LOCInterest_Temp				= 0;
			}
			else{
				LOCInterest_Temp				= LineOfCreditBalance;
			}
			LOCInterest							= (parseFloat(LOCInterest_Temp) * (parseFloat(NonDedLOCIntRate) / 100) / 12).toFixed(2);
			ObjLOCInterest						= FnTrObj.find("[rel='LOCInterest']");
			ObjLOCInterest.val(Math.round(LOCInterest));	

			//Total Non Ded Int => =GR4+GS4		TotalNonDedInt = FixedLoanInterest + LOCInterest
			TotalNonDedInt						= (parseFloat(FixedLoanInterest) + parseFloat(LOCInterest)).toFixed(2)
			ObjTotalNonDedInt					= FnTrObj.find("[rel='TotalNonDedInt']");
			ObjTotalNonDedInt.val(Math.round(TotalNonDedInt));	
			

			//Closing Balance	=> =IF(PurchaseDecisionCalc!GO4<0,0,PurchaseDecisionCalc!GO4+GT4)	
			//ClosingBal = IF(MlcBalanceBeforeInterest<0,0,MlcBalanceBeforeInterest+TotalNonDedInt)	
			//New//=IF(FU5<0,0,FU5+FZ5)

			if (parseFloat(MlcBalanceBeforeInterest) < 0){
				ClosingBal						= 0;
			}
			else{
				ClosingBal						= (parseFloat(MlcBalanceBeforeInterest) + parseFloat(TotalNonDedInt)).toFixed(2); 
			}

			ObjClosingBal						= FnTrObj.find("[rel='ClosingBal']");
			ObjClosingBal.val(Math.round(ClosingBal));	
			
			
			
			//Total Tax Ded Int => =GM4		TotalTaxDedInt = TotalDedInt 
			TotalTaxDedInt						= parseFloat(TotalDedInt);
			ObjTotalTaxDedInt					= FnTrObj.find("[rel='TotalTaxDedInt']");
			ObjTotalTaxDedInt.val(TotalTaxDedInt);


			//Total Tax Ded Int => =GM4		TotalTaxDedInt = TotalDedInt  =GC5+FZ5
			TotalIntMlc						= parseFloat(TotalTaxDedInt) + parseFloat(TotalNonDedInt);
			ObjTotalIntMlc					= FnTrObj.find("[rel='TotalIntMlc']");
			ObjTotalIntMlc.val(Math.round(TotalIntMlc));

			FrstClosingBal					=	ClosingBal
			FrstMlcClosingBal				=	MlcClosingBal
			$(".tr_year_month[year='" + CurYr + "']:not([month='0'])").each(function(){	//Month wise Calculation for First Year - Part1 - Yasir
				FnMonTrObj					= $(this);
				CurMonth					= CheckIsNaN( FnMonTrObj.find("[rel='MlcYr']").attr("month") );
				
				//FA//Open Bal//=IF(PurchaseDecisionCalc!GT15>0,PurchaseDecisionCalc!GT15,0)  '		
				if (parseFloat(ClosingBal) > 0) {
					OpenBal				= Math.round(ClosingBal)
				}
				else{
					OpenBal				= 0;
				}				
				ObjOpenBal	= FnMonTrObj.find("[rel='OpenBal']");
				ObjOpenBal.val(OpenBal);	
					
					
					
				if (parseFloat(OpenBal) > 0){
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
	
				ObjDeposits                     = FnMonTrObj.find("[rel='Deposits']");
				ObjDeposits.val(Deposits);
					
				ObjLumpSumDeposit               = FnMonTrObj.find("[rel='LumpSum']");
				ObjLumpSumDeposit.val(LumpSum);
				
			
				if ( parseFloat(TotalNonInvLoanBal) > 0 ) {
					MlcDepositNetCashRentalIncome =  Math.round(parseFloat(IecNetCashIncome) / 12) ;	
					
				}else{
					
					MlcDepositNetCashRentalIncome = 0
				}
							
				ObjMlcDepositNetCashRentalIncome		= FnMonTrObj.find("[rel='MlcDepositNetCashRentalIncome']");
				ObjMlcDepositNetCashRentalIncome.val(MlcDepositNetCashRentalIncome);
													
											
					//GB//=IFERROR(VLOOKUP(EW16,PurchaseDecisionCalc!$B$4:$E$424,4,FALSE),0)	
						//IFERROR(VLOOKUP(MlcYrStart,InflationAdjustPdcEnd,FALSE),0)
									
				InflationAdjustPdcEnd			= CheckIsNaN( $("[name='InflationAdjustPdcEnd']").val() );
				NonDeductibleWithdrawDrawdones	= InflationAdjustPdcEnd;
				ObjNonDeductibleWithdrawDrawdones	= FnMonTrObj.find("[rel='NonDeductibleWithdrawDrawdones']");
				ObjNonDeductibleWithdrawDrawdones.val(NonDeductibleWithdrawDrawdones);

								
				
					
				//Subtotal///=FA17-FB17-FC17-FD17+FE17 //OpenBal - Deposits - LumpSum
					
				Subtotal								=	parseFloat(OpenBal) - parseFloat(Deposits) - parseFloat(LumpSum) - parseFloat(MlcDepositNetCashRentalIncome) + parseFloat(NonDeductibleWithdrawDrawdones)  
					
				
				//MLC Open Bal (MlcOpenBal)	=> =MlcClosingBal
				//=IF(FS5<0,0,FS5)
				if (parseFloat(MlcClosingBal) < 0) {
					MlcOpenBal					=	0
				}else{
					MlcOpenBal						= MlcClosingBal;					
				}
				
				ObjMlcOpenBal					= FnMonTrObj.find("[rel='MlcOpenBal']");
				ObjMlcOpenBal.val(MlcOpenBal);
					
					
				//=IF(FA6>0,IF(FF6<0,-FF6,0),TotalOffsetSurplus/12*(1+NetWageGrowthRate)^($EX6))
				if ( parseFloat(OpenBal) > 0 ) {
					if ( parseFloat(Subtotal) < 0){
						
						DepositNetContribution = -parseFloat(Subtotal)
					}else{
						DepositNetContribution = 0
					}					
				}else{
					DepositNetContributionPow = Math.pow(( 1 + ( parseFloat(NetWageGrowthRate) / 100 ) ) , parseFloat(CurYr) );					
					DepositNetContribution  = Math.round(((parseFloat(TotalOffsetSurplus) / 100) /12) * parseFloat(DepositNetContributionPow)) 
				}
					
				//console.log('DepositNetContribution='+DepositNetContribution);
				ObjDepositNetContribution		= FnMonTrObj.find("[rel='DepositNetContribution']");
				ObjDepositNetContribution.val(DepositNetContribution);	
				
					
				//Lump Sum Deposit //IF(FA6>0,0,LumpSumDeposit) // 
				//IF(OpenBal>0,0,LumpSumDeposit)
					
				if (LumpSumDeposit == "")
					LumpSumDeposit = 0
				
				if ( parseFloat(OpenBal) > 0 ) {
					
					LumpSumDeposit 				= 0
				} else{
					LumpSumDeposit 				= LumpSumDeposit
					
				}
				
				ObjLumpSumDeposit						= FnMonTrObj.find("[rel='LumpSumDeposit']");
				ObjLumpSumDeposit.val(LumpSumDeposit);	
					
					
					
					
				//Deposits - Net Cash Rental Income
				//=IF(FD17=0,(VLOOKUP(EX17,$AF$5:$AN$425,9,FALSE))/12,0)
				//IF(FD8=0,(VLOOKUP(EX8,$AF$6:$AN$426,9,FALSE))/12,0)					
				//IF(PMlcDepositNetCashRentalIncome=0,(VLOOKUP(MlcYr,IecNetCashIncome,FALSE))/12,0)
				
				if (parseFloat(MlcDepositNetCashRentalIncome) == 0) {
					DepositNetCashRentalIncome  		=	Math.round(parseFloat(IecNetCashIncome) / 12) ;	

				}else{
					DepositNetCashRentalIncome			= 0
				}
				
				ObjDepositNetCashRentalIncome			= FnMonTrObj.find("[rel='DepositNetCashRentalIncome']");
				ObjDepositNetCashRentalIncome.val(DepositNetCashRentalIncome);		

				//Withdrawals / Drawdowns
				//	//=IFERROR(VLOOKUP(EW5,$B$5:$HV$425,10,FALSE),0)
				DrawdownReqn							=	0
				WithdrawalsDrawdowns					= Math.round(DrawdownReqn)
				ObjWithdrawalsDrawdowns					= FnMonTrObj.find("[rel='WithdrawalsDrawdowns']");
				ObjWithdrawalsDrawdowns.val(WithdrawalsDrawdowns);		
					

				
				//GH//Balance before interest//=GC16-GG16-GF16-GD16+GE16
				//Balance before interest
				//=FG17-FH17-FI17-FJ17+FK17

				
				BalanceBeforeInterest			=  Math.round(parseFloat(MlcOpenBal) - parseFloat(DepositNetContribution) - parseFloat(LumpSumDeposit) - parseFloat(DepositNetCashRentalIncome) + parseFloat(WithdrawalsDrawdowns))
				
				ObjBalanceBeforeInterest		= FnMonTrObj.find("[rel='BalanceBeforeInterest']");
				ObjBalanceBeforeInterest.val(BalanceBeforeInterest);	

				//Fixed Loan Balance =IF(PurchaseDecisionCalc!FA4>0,GH4,(VLOOKUP((PurchaseDecisionCalc!EX4+1),PurchaseDecisionCalc!$FD$4:$FN$435,11))+(SUMIFS(PurchaseDecisionCalc!$FX$4:$FX$435,PurchaseDecisionCalc!$FE$4:$FE$435,PurchaseDecisionCalc!FE4)))

				//=IF((FL5)<0.1,0,IF(VLOOKUP(EX5,$EW$5:$FA$434,5)>0,FL5,
				
				//VLOOKUP(EX5,$EW$5:$FG$434,11)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AN$425,9)+
				//(VLOOKUP(EX5,$EW$5:$FG$434,11)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AN$425,9))*FixedInterestRate))
				//IF((BalanceBeforeInterest)<0.1,0,IF(VLOOKUP(MlcYr,OpenBal)>0,BalanceBeforeInterest,VLOOKUP(MlcYr,MlcOpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome)+(VLOOKUP(MlcYr,MlcOpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome))*FixedInterestRate))
					
				if ( parseFloat(BalanceBeforeInterest) < 0.1 ) {
					  
					  MlcFixedLoanBalance = 0
					  
				 }else{
					  
					  
					  if ( parseFloat(OpenBal) > 0 ) {
						  
						  MlcFixedLoanBalance	= BalanceBeforeInterest;
					  }else{
						  
						MlcFixedLoanBalancEPlus					= parseFloat(TotalOffsetSurplus);
						MlcFixedLoanBalancEPow					= Math.pow((1+(parseFloat(NetWageGrowthRate)/100)), parseFloat(CurYr));
						MlcFixedLoanBalancTotal					= Math.round(parseFloat(MlcFixedLoanBalancEPlus) * parseFloat(MlcFixedLoanBalancEPow));
						  
						  MlcFixedLoanBalance	= parseFloat(OpenBal) - parseFloat(MlcFixedLoanBalancTotal) - parseFloat(IecNetCashIncome) + (parseFloat(OpenBal) - parseFloat(MlcFixedLoanBalancTotal) - parseFloat(IecNetCashIncome) ) * parseFloat(FixedInterestRate) / 100
					  }
					  
				 }
			
			
			
					
				ObjMlcFixedLoanBalance			= FnMonTrObj.find("[rel='MlcFixedLoanBalance']");
				ObjMlcFixedLoanBalance.val(MlcFixedLoanBalance);


					
				//Fixed Loan Interest => =GI4*FixedInterestRate/12		MlcFixedLoanInterest = MlcFixedLoanBalance * FixedInterestRate /12
				MlcFixedLoanInterest			= parseFloat(MlcFixedLoanBalance) * (parseFloat(FixedInterestRate)/100) / 12;
				ObjMlcFixedLoanInterest			= FnMonTrObj.find("[rel='MlcFixedLoanInterest']");
				ObjMlcFixedLoanInterest.val(MlcFixedLoanInterest);



				//Line of Credit Balance//=IF(FM5<0,FL5,FL5-FM5)
				//LineOfCreditBalance => =BalanceBeforeInterest-MlcFixedLoanBalance
			
				if ( parseFloat(MlcFixedLoanBalance) < 0 ){
					MlcLineOfCreditBalance		= parseFloat(MlcFixedLoanBalance);
					
				}else{
				MlcLineOfCreditBalance			= parseFloat(MlcFixedLoanBalance) - parseFloat(MlcFixedLoanBalance);
				}
				ObjMlcLineOfCreditBalance		= FnMonTrObj.find("[rel='MlcLineOfCreditBalance']");
				ObjMlcLineOfCreditBalance.val(MlcLineOfCreditBalance);

				
				//Old//LOC Interest => =IF(GJ4<0,0,GJ4)*TaxDedLOCIntRate/12			MlcLOCInterest = IF(MlcLineOfCreditBalance<0,0,MlcLineOfCreditBalance)*TaxDedLOCIntRate/12 
				//=IF(FO5<0,0,FO5)*TaxDedLOCIntRate/12
				
				if (parseFloat(MlcLineOfCreditBalance) < 0){
					MlcLOCInterest_Temp			= 0;
				}
				else{
					MlcLOCInterest_Temp			= MlcLineOfCreditBalance;
				}

				MlcLOCInterest					= parseFloat(MlcLOCInterest_Temp) * ( parseFloat(MlcLOCInterest_Temp) /100 ) /12;
				ObjMlcLOCInterest				= FnMonTrObj.find("[rel='MlcLOCInterest']");
				ObjMlcLOCInterest.val(MlcLOCInterest);

				
				//Total Ded Int => =GK4+GL4			TotalDedInt	= MlcFixedLoanInterest + MlcLOCInterest
				//=FN5+FP5
				TotalDedInt						= parseFloat(MlcFixedLoanInterest) + parseFloat(MlcLOCInterest);
				ObjTotalDedInt					= FnMonTrObj.find("[rel='TotalDedInt']");
				ObjTotalDedInt.val(TotalDedInt);

				//=FL5+FR5
				
				//old//Total Ded Interest Charge => =IF(GU4>0,0,GM4)		TotalDedInterestCharge = IF(ClosingBal>0,0,TotalDedInt)
				//New//=IF(FA5>0,0,FQ5)
					//=IF(GA6>0,0,FQ6)
			
				if (parseFloat(MlcClosingBal) > 0){
					TotalDedInterestCharge			= 0;
				}
				else{
					TotalDedInterestCharge			= TotalDedInt;
				}
				ObjTotalDedInterestCharge			= FnMonTrObj.find("[rel='TotalDedInterestCharge']");
				ObjTotalDedInterestCharge.val(TotalDedInterestCharge);	

				//MlcClosingBal

				
				//Closing Balance => =GH4+GX4		MlcClosingBal = BalanceBeforeInterest + TotalDedInterestCharge
				MlcClosingBal						= parseFloat(BalanceBeforeInterest) + parseFloat(TotalDedInterestCharge);
				ObjMlcClosingBal					= FnMonTrObj.find("[rel='MlcClosingBal']");
				ObjMlcClosingBal.val(MlcClosingBal);	
				
				//Investment Interest//=IF(FA5>0,FQ5,0) InvestmentInterest
				
				//Investment Interest	=> =IF(FA4>0,PurchaseDecisionCalc!GM4,0)		InvestmentInterest = IF(TotalNonInvLoanBal>0,TotalDedInt,0)
					
				if (parseFloat(OpenBal) > 0){
					InvestmentInterest			= TotalDedInt;
				}
				else{
					InvestmentInterest			= 0;
				}
				ObjInvestmentInterest			= FnMonTrObj.find("[rel='InvestmentInterest']");
				ObjInvestmentInterest.val(Math.round(InvestmentInterest));
			
				
				//Balance before interest mlc end //MlcBalanceBeforeInterest
				//=FF5+FT5
				
				MlcBalanceBeforeInterest 		= parseFloat(Subtotal) + parseFloat(InvestmentInterest)
				ObjMlcBalanceBeforeInterest		= FnMonTrObj.find("[rel='MlcBalanceBeforeInterest']");
				ObjMlcBalanceBeforeInterest.val(MlcBalanceBeforeInterest);

				
				
				//FixedLoanBalance
				//=IF($FA5<0.1,0,(VLOOKUP($EX5,$EW$5:$FA$434,5)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AP$425,9))+FM5*FixedInterestRate+(VLOOKUP($EX5,$EW$5:$FA$434,5)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AP$425,9))*FixedInterestRate)
				//IF(OpenBal<0.1,0,(VLOOKUP(MlcYr,OpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome))+FM7*FixedInterestRate+(VLOOKUP(MlcYr,OpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome))*FixedInterestRate)
				
				//=IF($FA17<0.1,0,(VLOOKUP($EX17,$EW$5:$FA$434,5)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX17)-VLOOKUP($EX17,$AF$5:$AP$425,9))+FM17*FixedInterestRate+(VLOOKUP($EX17,$EW$5:$FA$434,5)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX17)-VLOOKUP($EX17,$AF$5:$AP$425,9))*FixedInterestRate)	
				 
				if ( parseFloat(OpenBal) < 0.1 ) {
					  
					  FixedLoanBalance = 0
					  
				  }else{
					  
					 FixedLoanBalancEPow = Math.pow(( 1 + ( parseFloat(NetWageGrowthRate) / 100 ) ) , parseFloat(CurYr) );					
					 FixedLoanBalancTotal  = Math.round((parseFloat(TotalOffsetSurplus) ) * parseFloat(FixedLoanBalancEPow)) 
							
						
					  FixedLoanBalancecal1	= 	parseFloat(OpenBal) - parseFloat(FixedLoanBalancTotal) - parseFloat(IecNetCashIncome) 
					  FixedLoanBalancecal2 	=   MlcFixedLoanBalance *  parseFloat(FixedInterestRate) / 100
					  FixedLoanBalancecal3 	=	(parseFloat(OpenBal) - parseFloat(FixedLoanBalancTotal) - parseFloat(IecNetCashIncome) ) * parseFloat(FixedInterestRate) / 100
						

					  FixedLoanBalance		=	parseFloat(FixedLoanBalancecal1) +  parseFloat(FixedLoanBalancecal2) + parseFloat(FixedLoanBalancecal3)
				  }
			
			
				ObjFixedLoanBalance					= FnMonTrObj.find("[rel='FixedLoanBalance']");
				ObjFixedLoanBalance.val(Math.round(FixedLoanBalance));	

				//=IF(FV5<0,0,FV5*FixedInterestRate/12) FixedLoanInterest
				//FixedLoanInterest = IF(FixedLoanBalance<0,0,FixedLoanBalance*FixedInterestRate/12)
				
				if (parseFloat(FixedLoanBalance) < 0){
					FixedLoanInterest				= 0;
				}
				else{
					FixedLoanInterest				= Math.round(parseFloat(FixedLoanBalance) * (parseFloat(FixedInterestRate) / 100) /12);
				}
				ObjFixedLoanInterest				= FnMonTrObj.find("[rel='FixedLoanInterest']");
				ObjFixedLoanInterest.val(FixedLoanInterest);
				//=IF(FV5<0,FU5,FU5-FV5)		
				//LineOfCreditBalance
				//Line of Credit Balance => =PurchaseDecisionCalc!GO4-GP4			LineOfCreditBalance = MlcBalanceBeforeInterest - FixedLoanBalance
				//=IF(FV5<0,FU5,FU5-FV5)
				if ( FixedLoanBalance < 0){
					
					LineOfCreditBalance		=  parseFloat(MlcBalanceBeforeInterest)
				}else{
					LineOfCreditBalance		=  parseFloat(MlcBalanceBeforeInterest)
				}
			
				LineOfCreditBalance					= (parseFloat(MlcBalanceBeforeInterest) - parseFloat(FixedLoanBalance)).toFixed(2);
				ObjLineOfCreditBalance				= FnMonTrObj.find("[rel='LineOfCreditBalance']");
				ObjLineOfCreditBalance.val(Math.round(LineOfCreditBalance));	


				//LOC Interest => =IF(GQ4<0,0,GQ4)*NonDedLOCIntRate/12		LOCInterest = IF(LineOfCreditBalance<0,0,LineOfCreditBalance)*NonDedLOCIntRate/12
				//=IF(FX6<0,0,FX6)*TaxDedLOCIntRate/12
				if (parseFloat(LineOfCreditBalance) < 0){
					LOCInterest_Temp				= 0;
				}
				else{
					LOCInterest_Temp				= LineOfCreditBalance;
				}
				LOCInterest							= (parseFloat(LOCInterest_Temp) * (parseFloat(TaxDedLOCIntRate) / 100) / 12).toFixed(2);
				ObjLOCInterest						= FnMonTrObj.find("[rel='LOCInterest']");
				ObjLOCInterest.val(Math.round(LOCInterest));	

				//Total Non Ded Int => =GR4+GS4		TotalNonDedInt = FixedLoanInterest + LOCInterest
				TotalNonDedInt						= (parseFloat(FixedLoanInterest) + parseFloat(LOCInterest)).toFixed(2)
				ObjTotalNonDedInt					= FnMonTrObj.find("[rel='TotalNonDedInt']");
				ObjTotalNonDedInt.val(Math.round(TotalNonDedInt));	
				

				//Closing Balance	=> =IF(PurchaseDecisionCalc!GO4<0,0,PurchaseDecisionCalc!GO4+GT4)	
				//ClosingBal = IF(MlcBalanceBeforeInterest<0,0,MlcBalanceBeforeInterest+TotalNonDedInt)	
				//New//=IF(FU5<0,0,FU5+FZ5)

				if (parseFloat(MlcBalanceBeforeInterest) < 0){
					ClosingBal						= 0;
				}
				else{
					ClosingBal						= (parseFloat(MlcBalanceBeforeInterest) + parseFloat(TotalNonDedInt)).toFixed(2); 
				}

				ObjClosingBal						= FnMonTrObj.find("[rel='ClosingBal']");
				ObjClosingBal.val(Math.round(ClosingBal));	
				
				
				
				//Total Tax Ded Int => =GM4		TotalTaxDedInt = TotalDedInt 
				TotalTaxDedInt						= parseFloat(TotalDedInt);
				ObjTotalTaxDedInt					= FnMonTrObj.find("[rel='TotalTaxDedInt']");
				ObjTotalTaxDedInt.val(TotalTaxDedInt);


				//Total Tax Ded Int => =GM4		TotalTaxDedInt = TotalDedInt  =GC5+FZ5
				TotalIntMlc						= parseFloat(TotalTaxDedInt) + parseFloat(TotalNonDedInt);
				ObjTotalIntMlc					= FnMonTrObj.find("[rel='TotalIntMlc']");
				ObjTotalIntMlc.val(Math.round(TotalIntMlc));
				
			
			});
				//CurTDedDebt
				
				MlcGW5								= DepositNetContribution;
				ObjMlcGW5							= FnTrObj.find("[rel='MlcGW5']");
				ObjMlcGW5.val(MlcGW5);

				//Depn Claim - iec start => DepnClaim		DepnClaim = TotalFFDepn
				TotalFFDepn							= FFDepnTotal;
				DepnClaim							= parseFloat(TotalFFDepn);
				ObjDepnClaim						= FnTrObj.find("[rel='DepnClaim']");
				ObjDepnClaim.val(DepnClaim);


				//Profit Before Interest => =PurchaseDecisionCalc!AN4-HD4		ProfitBeforeInterest = IecNetCashIncome - DepnClaim
				ProfitBeforeInterest				= parseFloat(IecNetCashIncome) - parseFloat(DepnClaim);
				ObjProfitBeforeInterest				= FnTrObj.find("[rel='ProfitBeforeInterest']");
				ObjProfitBeforeInterest.val(ProfitBeforeInterest);


				//Tax Deductible Interest => =SUMIFS(PurchaseDecisionCalc!$GM$4:$GM$435,PurchaseDecisionCalc!$EX$4:$EX$435,PurchaseDecisionCalc!AF4)
				//TaxDeductibleInterest = TotalDedInt * 12 //
				TaxDeductibleInterest				= parseFloat(TotalDedInt) * 12;
				ObjTaxDeductibleInterest			= FnTrObj.find("[rel='TaxDeductibleInterest']");
				ObjTaxDeductibleInterest.val(TaxDeductibleInterest);

				//Cash Profit (Loss) => =PurchaseDecisionCalc!AN4-HF4
				//CashProfitLoss = IecNetCashIncome - TaxDeductibleInterest
				CashProfitLoss						= parseFloat(IecNetCashIncome) - parseFloat(TaxDeductibleInterest);
				ObjCashProfitLoss					= FnTrObj.find("[rel='CashProfitLoss']");
				ObjCashProfitLoss.val(CashProfitLoss);


				//Taxable Profit (Loss) => =HG4-HD4		TaxableProfitLoss = DepnClaim - CashProfitLoss
				TaxableProfitLoss					= parseFloat(CashProfitLoss) - parseFloat(DepnClaim);
				ObjTaxableProfitLoss				= FnTrObj.find("[rel='TaxableProfitLoss']");
				ObjTaxableProfitLoss.val(TaxableProfitLoss);


				//Cumulative Profits (Los ses) iec end	=> =+HH4		CumulativeProfitLoss = TaxableProfitLoss
				CumulativeProfitLoss				= TaxableProfitLoss;
				ObjCumulativeProfitLoss				= FnTrObj.find("[rel='CumulativeProfitLoss']");
				ObjCumulativeProfitLoss.val(CumulativeProfitLoss);

				
				//Current T/Ded Debt BCC ST => =IF(VLOOKUP(PurchaseDecisionCalc!$F4,PurchaseDecisionCalc!FZ$4:$GY$435,20,FALSE)<0,0,VLOOKUP(PurchaseDecisionCalc!$F4,PurchaseDecisionCalc!FZ$4:$GY$435,20,FALSE))
				//=IF(LOCInterest<0,0,LOCInterest) ClosingBal CurTDedDebt
				//=IF(R17>AE17,AE17-GN17,R17-GN17)
				if ( parseFloat(FrstMlcClosingBal) < 0 ) {
					CurTDedDebt						 =	 0
					
				}else{
					CurTDedDebt						 =	 parseFloat(FrstMlcClosingBal)
				}
//Current T/Ded Debt BCC ST
				ObjCurTDedDebt					= FnTrObj.find("[rel='CurTDedDebt']");
				ObjCurTDedDebt.val(CurTDedDebt);

				//CurTotalDebt
				//Current Total Debt => =HK4+VLOOKUP(PurchaseDecisionCalc!$F4,PurchaseDecisionCalc!FZ$4:$GY$435,7,FALSE)
				//CurTotalDebt => CurTDedDebt = LumpSumDeposit
				CurTotalDebt					= parseFloat(CurTDedDebt) + parseFloat(FrstClosingBal);
				ObjCurTotalDebt					= FnTrObj.find("[rel='CurTotalDebt']");
				ObjCurTotalDebt.val(CurTotalDebt);


				//Current Surplus / Deficit => =IF(PurchaseDecisionCalc!R4>PurchaseDecisionCalc!AE4,PurchaseDecisionCalc!AE4-HL4,PurchaseDecisionCalc!R4-HL4)
				//CurSurplusDeficit = IF(BCapDSR>BCapLVR,BCapLVR-CurTotalDebt,BCapDSR-CurTotalDebt)
				//=GM5+VLOOKUP($F5,EW$5:$GA$436,31,FALSE)
				//=IF(R5>AE5,AE5-GN5,R5-GN5)
				if (parseFloat(BCapDSR) > parseFloat(BCapLVR) ){
					CurSurplusDeficit			= parseFloat(BCapLVR) - parseFloat(CurTotalDebt);
				}
				else{
					CurSurplusDeficit			= parseFloat(BCapDSR) - parseFloat(CurTotalDebt);
				}
				
				ObjCurSurplusDeficit			= FnTrObj.find("[rel='CurSurplusDeficit']");
				ObjCurSurplusDeficit.val(Math.round(CurSurplusDeficit));


				//If Extra Prop => =PurchaseDecisionCalc!L4+1		IfExtraProp = Properties + 1
				IfExtraProp						= parseFloat(NoOfInvestPropertyOwned) + 1;
				ObjIfExtraProp					= FnTrObj.find("[rel='IfExtraProp']");
				ObjIfExtraProp.val(IfExtraProp);

				//HO => IfRent => (PurchaseDecisionCalc!J5*HN5)+PurchaseDecisionCalc!N5	(Rent*IfExtraProp) +CurrentRent
				IfRent							= ( parseFloat(Rent) * parseFloat(IfExtraProp) ) + parseFloat(CurrentRent);
				ObjIfRent						= FnTrObj.find("[rel='IfRent']");
				ObjIfRent.val(IfRent);


				//IfDsrAmt	=> (PurchaseDecisionCalc!I5*DSRSalary)+(PurchaseDecisionCalc!N5*DSRRent)+(HO5*DSRRent)		(TotalSal*DSRSalary)+(CurrentRent*DSRRent)+(IfRent*DSRRent)
				IfDsrAmt						= Math.round( (parseFloat(TotalSal) * parseFloat(DSRSalary) )+( parseFloat(CurrentRent) * parseFloat(DSRRent) )+( parseFloat(IfRent) * parseFloat(DSRRent) ) ) / 100;
				ObjIfDsrAmt						= FnTrObj.find("[rel='IfDsrAmt']");
				ObjIfDsrAmt.val(IfDsrAmt);

				//IfBcDsr	HP5/LOCTestRate	IfDsrAmt/LOCTestRate
				IfBcDsr							= Math.round( parseFloat(IfDsrAmt) / (parseFloat(LOCTestRate) / 100) );
				ObjIfBcDsr						= FnTrObj.find("[rel='IfBcDsr']");
				ObjIfBcDsr.val(IfBcDsr);


				//IfBcLvr	((PurchaseDecisionCalc!$T5*HN5)+PurchaseDecisionCalc!$O5)*MaxLVR	((Assumptions_F3*IfExtraProp)+CurrentPropVal)*MaxLVR
				IfBcLvr							= ((parseFloat(Assumptions_F3) * parseFloat(IfExtraProp) )+ parseFloat(CurrentPropVal) )* parseFloat(MaxLVR) /	100;
				ObjIfBcLvr						= FnTrObj.find("[rel='IfBcLvr']");
				ObjIfBcLvr.val(IfBcLvr);

				//IfDebt	HL5+PurchaseDecisionCalc!V5	CurTotalDebt+Loan
				IfDebt							= parseFloat(CurTotalDebt) + parseFloat(Loan);
				ObjIfDebt						= FnTrObj.find("[rel='IfDebt']");
				ObjIfDebt.val(IfDebt);


				//IfSurplusDeficit	IF(HQ5>HR5,HR5-HS5,HQ5-HS5)	IF(IfBcDsr>IfBcLvr,IfBcLvr-IfDebt,IfBcDsr-IfDebt)
				if (parseFloat(IfBcDsr) > parseFloat(IfBcLvr)){
					IfSurplusDeficit			= parseFloat(IfBcLvr) - parseFloat(IfDebt);
				}
				else{
					IfSurplusDeficit			= parseFloat(IfBcDsr) - parseFloat(IfDebt);
				}
				
				ObjIfSurplusDeficit				= FnTrObj.find("[rel='IfSurplusDeficit']");
				ObjIfSurplusDeficit.val(Math.round(IfSurplusDeficit));


				//If2ExtraProp	HN5+1	IfExtraProp+1
				If2ExtraProp					= parseFloat(IfExtraProp) + 1;
				ObjIf2ExtraProp					= FnTrObj.find("[rel='If2ExtraProp']");
				ObjIf2ExtraProp.val(If2ExtraProp);


				//BCCIfRent	(PurchaseDecisionCalc!J5*HU5)+PurchaseDecisionCalc!N5	(Rent*If2ExtraProp)+CurrentRent
				BCCIfRent						= ( parseFloat(Rent) * parseFloat(If2ExtraProp) ) + parseFloat(CurrentRent);
				ObjBCCIfRent					= FnTrObj.find("[rel='BCCIfRent']");
				ObjBCCIfRent.val(BCCIfRent);


				//BCCIfDsrAmt	(PurchaseDecisionCalc!I5*DSRSalary)+(HV5*DSRRent)	(TotalSal*DSRSalary)+(BCCIfRent*DSRRent)
				BCCIfDsrAmt						= Math.round ( ( parseFloat(TotalSal) * parseFloat(DSRSalary) / 100 ) + ( parseFloat(BCCIfRent) * (parseFloat(DSRRent)/100) ) );
				ObjBCCIfDsrAmt					= FnTrObj.find("[rel='BCCIfDsrAmt']");
				ObjBCCIfDsrAmt.val(BCCIfDsrAmt);


				//Bcc1IfBcDsr	HW5/LOCTestRate	BCCIfDsrAmt/LOCTestRate
				Bcc1IfBcDsr						= Math.round( parseFloat(BCCIfDsrAmt) / (parseFloat(LOCTestRate)/100) );
				ObjBcc1IfBcDsr					= FnTrObj.find("[rel='Bcc1IfBcDsr']");
				ObjBcc1IfBcDsr.val(Bcc1IfBcDsr);


				//BCCIfBcLvr	((PurchaseDecisionCalc!T5*HU5)+PurchaseDecisionCalc!O5)*MaxLVR	((PurchaseValue*If2ExtraProp)+CurrentPropVal)*MaxLVR
				BCCIfBcLvr						= Math.round( (parseFloat(Assumptions_F3) * parseFloat(If2ExtraProp)  + parseFloat(CurrentPropVal) ) * (parseFloat(MaxLVR) / 100) );
				ObjBCCIfBcLvr					= FnTrObj.find("[rel='BCCIfBcLvr']");
				ObjBCCIfBcLvr.val(BCCIfBcLvr);


				//BCCIfDebt	HS5+PurchaseDecisionCalc!$V5	IfDebt+Loan
				BCCIfDebt						= Math.round( parseFloat(IfDebt) + parseFloat(Loan) );
				ObjBCCIfDebt					= FnTrObj.find("[rel='BCCIfDebt']");
				ObjBCCIfDebt.val(BCCIfDebt);

				//BCCIfSurplusDeficit	IF(HX5>HY5,HY5-HZ5,HX5-HZ5)	IF(Bcc1IfBcDsr>BCCIfBcLvr,BCCIfBcLvr-BCCIfDebt,Bcc1IfBcDsr-BCCIfDebt)
				if ( parseFloat(Bcc1IfBcDsr) > parseFloat(BCCIfBcLvr) ){
					BCCIfSurplusDeficit			= parseFloat(BCCIfBcLvr) - parseFloat(BCCIfDebt);
				}
				else{
					BCCIfSurplusDeficit			= parseFloat(Bcc1IfBcDsr) - parseFloat(BCCIfDebt);
				}
				ObjBCCIfSurplusDeficit			= FnTrObj.find("[rel='BCCIfSurplusDeficit']");
				ObjBCCIfSurplusDeficit.val(BCCIfSurplusDeficit);


				//If3ExtraProp	HU5+1	If2ExtraProp+1
				If3ExtraProp					= parseFloat(If2ExtraProp) + 1;
				ObjIf3ExtraProp					= FnTrObj.find("[rel='If3ExtraProp']");
				ObjIf3ExtraProp.val(If3ExtraProp);


				//BCC2IfRent	(PurchaseDecisionCalc!$J5*IB5)+PurchaseDecisionCalc!$N5	(Rent*If3ExtraProp)+CurrentRent
				BCC2IfRent						= (parseFloat(Rent) * parseFloat(If3ExtraProp)) + parseFloat(CurrentRent) ;
				ObjBCC2IfRent					= FnTrObj.find("[rel='BCC2IfRent']");
				ObjBCC2IfRent.val(BCC2IfRent);


				//BCC2IfDsrAmt	(PurchaseDecisionCalc!$I5*DSRSalary)+(IC5*DSRRent)	(TotalSal*DSRSalary)+(BCC2IfRent*DSRRent)
				BCC2IfDsrAmt					= Math.round( (parseFloat(TotalSal) * parseFloat(DSRSalary) / 100 ) + ( parseFloat(BCC2IfRent) * parseFloat(DSRRent) / 100) );
				ObjBCC2IfDsrAmt					= FnTrObj.find("[rel='BCC2IfDsrAmt']");
				ObjBCC2IfDsrAmt.val(BCC2IfDsrAmt);


				//Bcc2IfBcDsr	ID5/LOCTestRate	BCC2IfDsrAmt/LOCTestRate
				Bcc2IfBcDsr						= Math.round( parseFloat(BCC2IfDsrAmt) / ( parseFloat(LOCTestRate) / 100) );
				ObjBcc2IfBcDsr					= FnTrObj.find("[rel='Bcc2IfBcDsr']");
				ObjBcc2IfBcDsr.val(Bcc2IfBcDsr);


				//BCC2IfBcLvr	((PurchaseDecisionCalc!$T5*IB5)+PurchaseDecisionCalc!$O5)*MaxLVR	((PurchaseValue*If3ExtraProp)+CurrentPropVal)*MaxLVR
				BCC2IfBcLvr						= Math.round(  ( (parseFloat(Assumptions_F3) * parseFloat(If3ExtraProp)) + parseFloat(CurrentPropVal) ) * ( parseFloat(MaxLVR) / 100) );
				ObjBCC2IfBcLvr					= FnTrObj.find("[rel='BCC2IfBcLvr']");
				ObjBCC2IfBcLvr.val(BCC2IfBcLvr);


				//BCC2IfDebt	HZ5+PurchaseDecisionCalc!$V5	BCCIfDebt+Loan
				BCC2IfDebt						= Math.round( parseFloat(BCCIfDebt) + parseFloat(Loan) );
				ObjBCC2IfDebt					= FnTrObj.find("[rel='BCC2IfDebt']");
				ObjBCC2IfDebt.val(BCC2IfDebt);

				
				//BCC2IfsurplusDeficit	IF(IE5>IF5,IF5-IG5,IE5-IG5)	IF(Bcc2IfBcDsr>BCC2IfBcLvr,BCC2IfBcLvr-BCC2IfDebt,Bcc2IfBcDsr-BCC2IfDebt)
				if (parseFloat(Bcc2IfBcDsr) > parseFloat(BCC2IfBcLvr) ){
					BCC2IfsurplusDeficit		= Math.round( parseFloat(BCC2IfBcLvr) - parseFloat(BCC2IfDebt) );
				}
				else
					BCC2IfsurplusDeficit		= Math.round( parseFloat(Bcc2IfBcDsr) - parseFloat(BCC2IfDebt) );
				
				ObjBCC2IfsurplusDeficit			= FnTrObj.find("[rel='BCC2IfsurplusDeficit']");
				ObjBCC2IfsurplusDeficit.val(BCC2IfsurplusDeficit);


				//BccCurSurplusDeficit	HM5	CurSurplusDeficit
				BccCurSurplusDeficit			= CurSurplusDeficit;
				ObjBccCurSurplusDeficit			= FnTrObj.find("[rel='BccCurSurplusDeficit']");
				ObjBccCurSurplusDeficit.val(Math.round(BccCurSurplusDeficit));
				

				//Plus1PropSurplusDeficit	HT5	IfSurplusDeficit
				Plus1PropSurplusDeficit			= IfSurplusDeficit;
				ObjPlus1PropSurplusDeficit		= FnTrObj.find("[rel='Plus1PropSurplusDeficit']");
				ObjPlus1PropSurplusDeficit.val(Math.round(Plus1PropSurplusDeficit));


				//Plus2PropSurplusDeficit	IA5	BCCIfSurplusDeficit
				Plus2PropSurplusDeficit			= BCCIfSurplusDeficit;
				ObjPlus2PropSurplusDeficit		= FnTrObj.find("[rel='Plus2PropSurplusDeficit']");
				ObjPlus2PropSurplusDeficit.val(Plus2PropSurplusDeficit);


				//Plus3PropSurplusDeficit	IH5	BCC2IfsurplusDeficit
				Plus3PropSurplusDeficit			= BCC2IfsurplusDeficit;
				ObjPlus3PropSurplusDeficit		= FnTrObj.find("[rel='Plus3PropSurplusDeficit']");
				ObjPlus3PropSurplusDeficit.val(Plus3PropSurplusDeficit);

				
				//AffordChecker	IF(PurchaseDecisionCalc!HM5<0,"Can't Afford","")	IF(CurSurplusDeficit<0,"Can't Afford","")
				if (parseFloat(CurSurplusDeficit) < 0){
					AffordChecker				= "Can't Afford";
				}
				else{
					AffordChecker				= "";
				}
				
				ObjAffordChecker				= FnTrObj.find("[rel='AffordChecker']");
				ObjAffordChecker.val(AffordChecker);


				//Qualify	IF(PurchaseDecisionCalc!HT5>0,"Yes","")	IF(IfSurplusDeficit>0,"Yes","")
				if (parseFloat(IfSurplusDeficit) > 0){
					Qualify						= "Yes";
				}
				else{
					Qualify						= "";
				}
				
				ObjQualify						= FnTrObj.find("[rel='Qualify']");
				ObjQualify.val(Qualify);


				//NonDeductibleLoanBal	VLOOKUP($B5,PurchaseDecisionCalc!$FZ$5:$GT$436,3)	VLOOKUP(YearPDTStart,NonDeductibleWithdrawDrawdones)
				//=VLOOKUP($B5,$EW$5:$GA$436,31)
				
				NonDeductibleLoanBal			= FrstClosingBal;
				ObjNonDeductibleLoanBal			= FnTrObj.find("[rel='NonDeductibleLoanBal']");
				ObjNonDeductibleLoanBal.val(NonDeductibleLoanBal);


				//TaxDeductibleLoanBal	VLOOKUP($B5,PurchaseDecisionCalc!$FZ$5:$GW$436,17)	VLOOKUP(YearPDTStart,ClosingBal)
				//=VLOOKUP($B5,$EW$5:$GA$436,23)
				TaxDeductibleLoanBal			= FrstMlcClosingBal;
				ObjTaxDeductibleLoanBal			= FnTrObj.find("[rel='TaxDeductibleLoanBal']");
				ObjTaxDeductibleLoanBal.val(TaxDeductibleLoanBal);


				ObjNoOfInvestPropertyOwned 	= 	FnTrObj.find("[rel='NoOfInvestPropertyOwned']");

				//Arzath your code will ends here..
				
				// NEXT FEILDS START
						
				// Reporting Mortage Start
				//Traditional Strategy  // =TotalTradLoans!T3 Values Comes from  TotalTradLoans File
					
				TraditionalStrategy					= 412658     //  Valhardcore
				ObjTraditionalStrategy      		= FnTrObj.find("[rel='TraditionalStrategy']");
				ObjTraditionalStrategy.val(TraditionalStrategy);
				
				
				//Non Deductible Balance //  //=VLOOKUP($A3,PurchaseDecisionCalc!$FV$5:$GC$436,17)
				TotalTaxDedInt						= 0 	//  Valhardcore
				
				NonDeductibleBalance				= parseFloat(TotalTaxDedInt)     //  Valhardcore
				ObjNonDeductibleBalance     		= FnTrObj.find("[rel='NonDeductibleBalance']");
				ObjNonDeductibleBalance.val(NonDeductibleBalance);
				
		
				//Tax Deductible Balance //  //==VLOOKUP($A3,PurchaseDecisionCalc!$GB$5:$GV$436,30)
				
				var TaxDeductibleBalance 			= 0
				
				ObjTaxDeductibleBalance    		= FnTrObj.find("[rel='TaxDeductibleBalance']");
				ObjTaxDeductibleBalance.val(TaxDeductibleBalance);
				
				
				//Total Debt Balance // `=C3+D3

				TotalDebtBalance					= parseFloat(NonDeductibleBalance) +  parseFloat(TaxDeductibleBalance)   
				ObjTotalDebtBalance    		= FnTrObj.find("[rel='TotalDebtBalance']");
				ObjTotalDebtBalance.val(TotalDebtBalance);
				

				//Projected Yearly Advantage//=B3-C3
					
				ProjectedYearlyAdvantage			= parseFloat(TraditionalStrategy) -  parseFloat(NonDeductibleBalance)   
				ObjProjectedYearlyAdvantage    		= FnTrObj.find("[rel='ProjectedYearlyAdvantage']");
				ObjProjectedYearlyAdvantage.val(ProjectedYearlyAdvantage);

						
				
				//Traditional Strategy//=TotalTradLoans!K2
					
				EYITraditionalStrategy				= 18804 // Valhardcore
				ObjEYITraditionalStrategy   		= FnTrObj.find("[rel='EYITraditionalStrategy']");
				ObjEYITraditionalStrategy.val(EYITraditionalStrategy);

						
				//Suggested Strategy//=SUMIFS(PurchaseDecisionCalc!GF5:GF436,PurchaseDecisionCalc!$EX$5:$EX$436,A3)
					
				SuggestedStrategy					= 16435 // Valhardcore
				ObjSuggestedStrategy  		= FnTrObj.find("[rel='SuggestedStrategy']");
				ObjSuggestedStrategy.val(SuggestedStrategy);
			

				
				/// ASSEMENT CALC started =CurrentInvestmentAssets
				
				//op bal //=CurrentInvestmentAssets  ==> Value comes from query
				
				CurrentInvestmentAssets				=	56600   //  Valhardcore
				ObjAACopbal     					= FnTrObj.find("[rel='AACopbal']");
				ObjAACopbal.val(CurrentInvestmentAssets);
				
				//additions //=PurchaseDecisionCalc!G5*Client1KiwisaverRate+PurchaseDecisionCalc!H5*Client2KiwisaverRate
				//					Salary1,                   Salary2
				//Client1KiwisaverRate				=	4   	//  Valhardcore
				//Client2KiwisaverRate				=	4		//  Valhardcore
				
				
				additions							= ( parseFloat(Salary1) *  (parseFloat(Client1KiwisaverRate) / 100)  ) +  ( parseFloat(Salary2) * (parseFloat(Client2KiwisaverRate) / 100 ) )
				
				//console.log('Salary1='+parseFloat(Salary1) * parseFloat(Client1KiwisaverRate) / 100 );
				//console.log('Salary2='+ parseFloat(Salary2) * (parseFloat(Client2KiwisaverRate) / 100 ) );			
				//console.log('Client1KiwisaverRate='+ parseFloat(Client1KiwisaverRate) / 100);				
				//console.log('Client2KiwisaverRate='+parseFloat(Client2KiwisaverRate) / 100);

				Objadditions    					= FnTrObj.find("[rel='additions']");
				Objadditions.val(Math.round(additions));
				
				//growth //=(B3+C3)*InvestmentGrowthRate B3== >  CurrentInvestmentAssets  C3 ==> additions
				
				//console.log('CurrentInvestmentAssets='+CurrentInvestmentAssets);
				//console.log('additions='+additions);			
				//console.log('InvestmentGrowthRate='+ parseFloat(InvestmentGrowthRate) / 100);				
				//console.log('Client2KiwisaverRate='+parseFloat(Client2KiwisaverRate) / 100);

				growth								= ( parseFloat(CurrentInvestmentAssets) + parseFloat(additions) ) * parseFloat(InvestmentGrowthRate) / 100
				Objgrowth    						= FnTrObj.find("[rel='growth']");
				Objgrowth.val(Math.round(growth));


				//cl bal //=SUM(B4:D4)

				AACclbal							=  parseFloat(CurrentInvestmentAssets) + parseFloat(additions) + parseFloat(growth) 
				ObjAACclbal    						= FnTrObj.find("[rel='AACclbal']");
				ObjAACclbal.val(Math.round(AACclbal));


				//house value //=F3+(F3*InvestmentGrowthRate) F3 = > Oth Value
				houseValue							=	800000	//  Valhardcore
				houseValue							=  parseFloat(houseValue)
				ObjhouseValue   					= FnTrObj.find("[rel='houseValue']");
				ObjhouseValue.val(Math.round(houseValue));

				
				//total prop value//=PurchaseDecisionCalc!T17*PurchaseDecisionCalc!IR17

				totalpropvalue						=  parseFloat(Assumptions_F3) * parseFloat(NoOfInvestPropertyOwned) 
				Objtotalpropvalue   				= FnTrObj.find("[rel='totalpropvalue']");
				Objtotalpropvalue.val(Math.round(totalpropvalue));
				
				
				//add kiwisaver//=H4+E4
				
				addkiwisaver						=  parseFloat(totalpropvalue) + parseFloat(AACclbal) 
				Objaddkiwisaver  					= FnTrObj.find("[rel='addkiwisaver']");
				Objaddkiwisaver.val(Math.round(addkiwisaver));
				
				
				/// ASSEMENT CALC Ended
				
				
				//Net Worth Calc Started
				
				
				//Total Lifestyle Assets 
					
				TotalLifestyleAssets				=  parseFloat(houseValue) 
				ObjTotalLifestyleAssets 			= FnTrObj.find("[rel='TotalLifestyleAssets']");
				ObjTotalLifestyleAssets.val(Math.round(TotalLifestyleAssets));
				
				
					//Net Worth Calc//Total Investment Assets //=AssetAccumCalc!I4
					
				TotalInvestmentAssets				=  parseFloat(addkiwisaver) 
				ObjTotalInvestmentAssets 			= FnTrObj.find("[rel='TotalInvestmentAssets']");
				ObjTotalInvestmentAssets.val(Math.round(TotalInvestmentAssets));
				
				
				
				
				//Net Worth Calc//Total Investment Assets //=B4+C4 ( Total Lifestyle Assets  + Total Investment Assets)
					
				TotalAssets							=  parseFloat(TotalLifestyleAssets) +  parseFloat(TotalInvestmentAssets) 
				ObjTotalAssets 						= FnTrObj.find("[rel='TotalAssets']");
				ObjTotalAssets.val(Math.round(TotalAssets));
				
				
				//Total Liabilities//=PurchaseDecisionCalc!HK17
				
			
				TotalLiabilities					=  parseFloat(CurTotalDebt) 
				ObjTotalLiabilities					= FnTrObj.find("[rel='TotalLiabilities']");
				ObjTotalLiabilities.val(Math.round(TotalLiabilities));
				
				//Net Worth//=D2-E2
								
				NetWorth							=  parseFloat(TotalAssets)  - parseFloat(TotalLiabilities) 
				ObjNetWorth							= FnTrObj.find("[rel='NetWorth']");
				ObjNetWorth.val(Math.round(NetWorth));
				
		
				//Income perannum (Active)//=PurchaseDecisionCalc!I5 IncomeperannumPassive
					
				IncomeperannumActive				=  parseFloat(TotSalary) 
				ObjIncomeperannumActive				= FnTrObj.find("[rel='IncomeperannumActive']");
				ObjIncomeperannumActive.val(Math.round(IncomeperannumActive));
				
				//Income per annum (Passive)//=PurchaseDecisionCalc!AI5+PurchaseDecisionCalc!AH5
				IncomeperannumPassive				=  parseFloat(IecRentalIncome) + parseFloat(CurInvPropInc)
				ObjIncomeperannumPassive			= FnTrObj.find("[rel='IncomeperannumPassive']");
				ObjIncomeperannumPassive.val(Math.round(IncomeperannumPassive));
				
				//Annual Cash Increase (Decrease)//=PurchaseDecisionCalc!HF5
				AnnualCashIncreaseDecrease			=  parseFloat(CashProfitLoss) 
				ObjAnnualCashIncreaseDecrease		= FnTrObj.find("[rel='AnnualCashIncreaseDecrease']");
				ObjAnnualCashIncreaseDecrease.val(Math.round(AnnualCashIncreaseDecrease));
				
				//=PurchaseDecisionCalc!IQ5*PurchaseDecisionCalc!T5
				PropertiesCost						=  parseFloat(PurchasePropertyQualify) * parseFloat(Assumptions_F3) 
				ObjPropertiesCost					= FnTrObj.find("[rel='PropertiesCost']");
				ObjPropertiesCost.val(Math.round(PropertiesCost));
				
				
				//Cap Gain//=AssetAccumCalc!H4-J3
						
				CapGain								=  parseFloat(totalpropvalue) - parseFloat(PropertiesCost) 
				ObjCapGain							= FnTrObj.find("[rel='CapGain']");
				ObjCapGain.val(Math.round(CapGain));
				
				//Net Worth Calc Ended
				
				// Reporting Mortage Ended
				
				// Reporting Asset Accum Start
				
				//Asset value//=AssetAccumCalc!E3 
				
				CSAssetvalue						=  parseFloat(AACclbal)
				ObjCSAssetvalue						= FnTrObj.find("[rel='CSAssetvalue']");
				ObjCSAssetvalue.val(Math.round(CSAssetvalue));
					
				//CS Debt//=TotalTradLoans!T2
				CSDebt								=  412658 // Valhardcore
				ObjCSDebt							= FnTrObj.find("[rel='CSDebt']");
				ObjCSDebt.val(Math.round(CSDebt));

				//Net Position//=B4-C4	
				
				CSNetPosition						=  parseFloat(CSAssetvalue) - parseFloat(CSDebt) 
				ObjCSNetPosition					= FnTrObj.find("[rel='CSNetPosition']");
				ObjCSNetPosition.val(Math.round(CSNetPosition));
					
				
				//Net Position//=B4-C4	
				
				CSNetPosition						=  parseFloat(CSAssetvalue) - parseFloat(CSDebt) 
				ObjCSNetPosition					= FnTrObj.find("[rel='CSNetPosition']");
				ObjCSNetPosition.val(Math.round(CSNetPosition));
					
				
				//No. of Props //=PurchaseDecisionCalc!IR17+CurNoInvProps
				CurNoInvProps						=	0				
				NoofProps							=  parseFloat(NoOfInvestPropertyOwned) + parseFloat(CurNoInvProps) 
				ObjNoofProps						= FnTrObj.find("[rel='NoofProps']");
				ObjNoofProps.val(Math.round(NoofProps));
				
				
				//SS Asset value //=AssetAccumCalc!I4		
				SSAssetvalue						=  parseFloat(addkiwisaver) 
				ObjSSAssetvalue						= FnTrObj.find("[rel='SSAssetvalue']");
				ObjSSAssetvalue.val(Math.round(SSAssetvalue));
				
				//SS//Debt//=PurchaseDecisionCalc!HK5
				
				SSDebt								=  parseFloat(CurTotalDebt) 
				ObjSSDebt							= FnTrObj.find("[rel='SSDebt']");
				ObjSSDebt.val(Math.round(SSDebt));
				
				
					
				//SS//Debt//=F4-G4
				
				SSNetPosition						=  parseFloat(SSAssetvalue) - parseFloat(SSDebt)
				ObjSSNetPosition					= FnTrObj.find("[rel='SSNetPosition']");
				ObjSSNetPosition.val(Math.round(SSNetPosition));
				
				
				//	// Reporting Asset Accum Ended
				
			
				LumpSumDeposit = 0 //  Valhardcore
				OpenBal			=	1
				if ( parseFloat(OpenBal) > 0 ) {
					
					LumpSumDeposit 				= 0
				} else{
					LumpSumDeposit 				= LumpSumDeposit
					
				}
				
				ObjLumpSumDeposit						= FnTrObj.find("[rel='LumpSumDeposit']");
				ObjLumpSumDeposit.val(LumpSumDeposit);	
				
				
				
				//
				

			}	//End of 0th Year...
			else{
				
				//console.log('CurYr=='+CurYr);
				FnTrObj					= $(this);
				
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

				
				//==================================== Start ===============   
				
				PurchasePropertyQualify = CheckIsNaN( FnTrObj.find("[rel='PurchasePropertyIfQualifyYes']").val() );														// Valhardcore			
				
				//ObjPurchasePropertyIfQualifyYes  	= FnTrObj.find("[rel='PurchasePropertyIfQualifyYes']");
				//ObjPurchasePropertyIfQualifyYes.val(PurchasePropertyQualify);
				
				NoOfInvestPropertyOwned				=	parseFloat(NoOfInvestPropertyOwned) + parseFloat(PurchasePropertyQualify)
				ObjNoOfInvestPropertyOwned 			= FnTrObj.find("[rel='NoOfInvestPropertyOwned']");
				ObjNoOfInvestPropertyOwned.val(NoOfInvestPropertyOwned);
				
				//console.log('CurYr='+CurYr);
					
				Properties							= parseFloat(NoOfInvestPropertyOwned);
				ObjProperties           			= FnTrObj.find("[rel='Properties']");
				ObjProperties.val(Properties);
				
				
				//J//=AnnualRentalIncome*((1+RentIncreaseRate)^($F16))
				
				
				
				RentPow 				= Math.pow( (1 + (parseFloat(RentIncreaseRate) / 100)), parseInt(CurYr) );
				Rent                    = parseFloat(AnnualRentalIncome) * parseFloat(RentPow) ;
				ObjRent.val( Math.round(Rent) );
				
				
				//M//=(J16*L16)
				ObjNewRent              = FnTrObj.find("[rel='NewRent']");
				NewRent                 = parseFloat(Rent) * parseFloat(Properties);
				ObjNewRent.val(NewRent);
				
				
				// =$AH$4*((1+RentIncreaseRate)^(AF16-1)) 
					
				IncrementrentalratePow 			= Math.pow( 1 + ( parseFloat(RentIncreaseRate)/100), (parseInt(CurYr) - 1) )  ;
				CurInvPropIncome          		= Math.round(parseFloat(CurInvPropIncome) * parseFloat(IncrementrentalratePow));

				console.log("IncrementrentalratePow=" + IncrementrentalratePow)
				ObjCurInvPropIncome             = FnTrObj.find("[rel='CurInvPropIncome']"); 
				ObjCurInvPropIncome.val(CurInvPropIncome);
				
				
			
				//N// =CurInvPropInc*((1+RentIncreaseRate)^($F16))                                                // Value comes 2 

				console.log("Arzath => CurInvPropInc = " + CurInvPropInc)
				//CurInvPropInc
				CurrentRentPow 			= Math.pow( (1 + (parseFloat(RentIncreaseRate) / 100) ), parseInt(CurYr) );	
				CurrentRent         	= parseFloat(CurInvPropInc) * parseFloat(CurrentRentPow);
				ObjCurrentRent          = FnTrObj.find("[rel='CurrentRent']");
				ObjCurrentRent.val(CurrentRent);
					
				

				//O//=O4+(O4*InvestmentGrowthRate)
				CurrentPropVal          = parseFloat(CurrentPropVal) + ( parseFloat(CurrentPropVal) * parseFloat(InvestmentGrowthRate) /100);
				ObjCurrentPropVal       = FnTrObj.find("[rel='CurrentPropVal']");
				ObjCurrentPropVal.val(CurrentPropVal);
				
				
				
				//TotalRent = M16+N16
				TotalRent               = parseFloat(NewRent) + parseFloat(CurrentRent);
				ObjTotalRent            = FnTrObj.find("[rel='TotalRent']");
				ObjTotalRent.val(Math.round(TotalRent));
				
				
				//=(I16*DSRSalary)+(P16*DSRRent)
				
				//Q//=(I16*DSRSalary)+(P16*DSRRent)
				

				DSRAmt                  =  ( parseFloat(TotSalary) * (parseFloat(DSRSalary)/100) ) + ( parseFloat(TotalRent) * (parseFloat(DSRRent)/100) )
				ObjDSRAmt               = FnTrObj.find("[rel='DSRAmt']");
				ObjDSRAmt.val(Math.round( DSRAmt));
				//console.log('DSRAmt='+DSRAmt);
				
				//console.log("TotSalary=" + TotSalary + ", DSRSalary=" + DSRSalary + ", TotalRent=" + TotalRent + ", DSRRent=" + DSRRent);
							
				
				//=Q16/LOCTestRate)
				BCapDSR                 = Math.round( (parseFloat(DSRAmt) / parseFloat(LOCTestRate/100)));
				ObjBCapDSR              = FnTrObj.find("[rel='BCapDSR']");
				ObjBCapDSR.val(BCapDSR);
				
				//console.log("DSRAmt=" + DSRAmt + ", LOCTestRate=" + LOCTestRate + ", TotalRent=" + TotalRent + ", DSRRent=" + DSRRent);
			
				//T//Purchase Value // =(T4+(T4*InvestmentGrowthRate))	
				//console.log('InvestmentGrowthRate'+ parseFloat(InvestmentGrowthRate) /100 );
				Assumptions_F3          	= ( parseFloat(Assumptions_F3) + ( parseFloat(Assumptions_F3) * ( parseFloat(InvestmentGrowthRate) /100) )).toFixed(2)
				ObjPurchaseValue        	= FnTrObj.find("[rel='PurchaseValue']");
				ObjPurchaseValue.val(Assumptions_F3);
				
			
				// Purchase Costs  
				
				//U//Purchase Costs //=(U4+(U4*InflationRate))	
				Assumptions_F4          	= ( parseFloat(Assumptions_F4) + ( parseFloat(Assumptions_F4) * (parseFloat(InflationRate)/100)  ) ).toFixed(2);
				ObjPurchaseCost         	= FnTrObj.find("[rel='PurchaseCost']");
				ObjPurchaseCost.val(Assumptions_F4);
				
				//Loan//=SUM(T16:U16)
				Loan                    	= (parseFloat(Assumptions_F3) + parseFloat(Assumptions_F4)).toFixed(2) ;
				ObjLoan                 	= FnTrObj.find("[rel='Loan']");
				ObjLoan.val(Loan);
				
				
				//K//=IF(IR16>0,IR16*PurchaseDecisionCalc!V16,0)

				//console.log('Loan='+Loan);
				//console.log('PurchasePropertyQualify='+PurchasePropertyQualify);
				if (parseFloat(PurchasePropertyQualify) > 0){
					DrawdownReqn                = parseFloat(PurchasePropertyQualify) * parseFloat(Loan);
				}
				else{
					DrawdownReqn                = 0;
				}
				ObjDrawdownReqn                 = FnTrObj.find("[rel='DrawdownReqn']"); 
				ObjDrawdownReqn.val(DrawdownReqn);
				
				
				
				
				//W//Rental//Rental Income//=(W4+(W4*RentIncreaseRate))			 

				if ( CurYr == 1){
					
					RentalIncomeVal			=	AnnualRentalIncome
				}else{
					
					RentalIncomeVal			=	RentalIncome
				}
			
				RentalIncome          		= ( parseFloat(RentalIncomeVal) + ( parseFloat(RentalIncomeVal) * ( parseFloat(RentIncreaseRate)/100 ) ));				
				ObjRentalIncome         	= FnTrObj.find("[rel='RentalIncome']");
				ObjRentalIncome.val(Math.round(RentalIncome));
				
				//console.log('AnnualRentalIncome='+AnnualRentalIncome+'RentIncreaseRate='+RentIncreaseRate);
				
				//X//Management Fee  => =W16*RentalMgmtFee    (W16 = Rental Income)

				ManagementFee           = ( parseFloat(RentalIncome) * (parseFloat(RentalMgmtFee) / 100) ).toFixed(0);
				ObjManagementFee        = FnTrObj.find("[rel='ManagementFee']");
				ObjManagementFee.val(ManagementFee);
				
				//Y//Net Rental Income After Agents Fees (Y5) =>=W16-X16  
				
				
				NetRentalIncomeAfterAgentFees       = Math.round(parseFloat(RentalIncome) - (parseFloat(ManagementFee)));
				ObjNetRentalIncomeAfterAgentFees    = FnTrObj.find("[rel='NetRentalIncomeAfterAgentFees']");
				ObjNetRentalIncomeAfterAgentFees.val(NetRentalIncomeAfterAgentFees);
				

				//Z//=(Z4+(Z4*InflationRate))
				CashRentalExpenses          	= Math.round( parseFloat(CashRentalExpenses) + ( parseFloat(CashRentalExpenses) * (parseFloat(InflationRate) /100) ) );		
				ObjCashRentalExpenses   = FnTrObj.find("[rel='CashRentalExpenses']");
				ObjCashRentalExpenses.val(CashRentalExpenses);
				
				//One off Cash Costs

				OneOffCashCost 			= CheckIsNaN( FnTrObj.find("[rel='OneOffCashCost']").val() );        
				//ObjNetCashIncome        = FnTrObj.find("[rel='OneOffCashCost']");
				//ObjNetCashIncome.val(OneOffCashCost);
				
				//AB//Net Cash Income//=W16-Z16-AA16  RentalIncome -cashrentexpense-on off cash

				NetCashIncome           		= Math.round(parseFloat(RentalIncome) - parseFloat(CashRentalExpenses) - parseFloat(OneOffCashCost));
				ObjNetCashIncome        		= FnTrObj.find("[rel='NetCashIncome']");
				ObjNetCashIncome.val(NetCashIncome);
				
				//AC//=(AC4+(AC4*InflationRate)) //Fixtures & Fittings Depn First Year (AC4) => =InitialFixFitCost*FixFitDepnRate
				//FixtureFittingsDepnFirstYr      = percentageRate( FixtureFittingsDepnFirstYr, InflationRate );  // function Added);
				FixtureFittingsDepnFirstYr      = Math.round(parseFloat(FixtureFittingsDepnFirstYr) + ( parseFloat(FixtureFittingsDepnFirstYr) * (parseFloat(InflationRate)/100)) );
				ObjFixtureFittingsDepnFirstYr   = FnTrObj.find("[rel='FixtureFittingsDepnFirstYr']");
				ObjFixtureFittingsDepnFirstYr.val(FixtureFittingsDepnFirstYr );


				//AD//Net Rental Profit before int first year - pcc end //=AB16-AC16				
				//Net Rental Profit before int first year - pcc end => Net Cash Income - Fixtures & Fittings Depn First Year
				NetRentalProfitIntFirstYr       = Math.round(parseFloat(NetCashIncome) - parseFloat(FixtureFittingsDepnFirstYr));
				ObjNetRentalProfitIntFirstYr    = FnTrObj.find("[rel='NetRentalProfitIntFirstYr']");
				ObjNetRentalProfitIntFirstYr.val(NetRentalProfitIntFirstYr);
				
	

				//AE//=((PurchaseDecisionCalc!T16*L16)+O16)*MaxLVR
				//((PurchaseValue * Properties)+curentPropVa)* 
				BCapLVR                         = ( ( parseFloat(Assumptions_F3) * parseFloat(Properties) ) + parseFloat(CurrentPropVal) ) * (parseFloat(MaxLVR)/100);
				//console.log("Assumptions_F3=" + Assumptions_F3 + ", NoOfInvestPropertyOwned=" + NoOfInvestPropertyOwned + ", CurrentPropVal=" + CurrentPropVal + ", MaxLVR=" + MaxLVR);
				ObjBCapLVR                      = FnTrObj.find("[rel='BCapLVR']"); 
				ObjBCapLVR.val(BCapLVR);
				
				
				//IEC - cur inv prop income =CurInvPropInc 
				
			
				IecNoOfInvestPropertyOwned	=   NoOfInvestPropertyOwned  			
				
				ObjIecNoOfInvestPropertyOwned = FnTrObj.find("[rel='IecNoOfInvestPropertyOwned']");
				ObjIecNoOfInvestPropertyOwned.val(IecNoOfInvestPropertyOwned);
				
		
				
				//=$AG16*PurchaseDecisionCalc!W16
	
				IecRentalIncome                 = Math.round(parseFloat(IecNoOfInvestPropertyOwned) * parseFloat(RentalIncome));
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
				
				
				//=$AG16*PurchaseDecisionCalc!AA4
				IedcOneOffCashCost              = parseFloat(IecNoOfInvestPropertyOwned) * parseFloat(OneOffCashCost);
				//alert(IecNoOfInvestPropertyOwned)
				ObjIedcOneOffCashCost           = FnTrObj.find("[rel='IedcOneOffCashCost']");
				ObjIedcOneOffCashCost.val(IedcOneOffCashCost);
				
					
				//=$AG16*PurchaseDecisionCalc!AB16+AH16
				IecNetCashIncome                = parseFloat(IecNoOfInvestPropertyOwned) * parseFloat(NetCashIncome) + parseFloat(CurInvPropInc);
				ObjIecNetCashIncome             = FnTrObj.find("[rel='IecNetCashIncome']");
				ObjIecNetCashIncome.val(IecNetCashIncome);
				
				//console.log('IecNoOfInvestPropertyOwned='+ IecNoOfInvestPropertyOwned + 'NetCashIncome='+NetCashIncome +'CurInvPropInc='+ CurInvPropInc)
				
				// =AS16+AV16+AY16+BB16+BE16+BH16+BK16+BN16+BQ16+BT16+BW16+BZ16+CC16+CF16+CI16+CL16+CO16+CR16+CU16+CX16+DA16+DD16+DG16+DJ16+DM16+DP16+DS16+DV16+DY16+EB16+EE16+EH16+EK16+
				// ====================================== Startet  20191122 =====================================
				// TotalFFCost
				
				
				//// ============================ // Valhardcore Check with YAsir ===================================================
				
				
				FFCostTotal                     = 0;
				FFDepnTotal                     = 0;
				FFDbvTotal                      = 0;
				
				PrevYr 							= (parseInt(CurYr) - 1);
				
				//alert('PurchasePropertyQualify=='+PurchasePropertyQualify)
				
				console.log('FFCost='+CurYr+'===='+FFCost)
				console.log('FFDepn='+CurYr+'===='+FFDepn)
				console.log('FFDbv='+CurYr+'===='+FFDbv)
				
				for (dn = 0; dn <= parseInt(CurYr); dn++){
					
					 if ( dn == CurYr ){
						if (parseFloat(CurYr) < 3){
							CurYrTemp			= CurYr;
						}
						else{
							CurYrTemp			= parseFloat(CurYr) - 1;
						}
						
						//AV// =InitialFixFitCost*((1+InflationRate)^($AO16))*PurchaseDecisionCalc!$IR16 PurchasePropertyIfQualifyYes
						//=InitialFixFitCost*((1+InflationRate)^($AO42-1))*PurchaseDecisionCalc!$IR42
						//=IF(AV16>1,AV16,0)
						FFCostValPowMath			= Math.pow((1+(parseFloat(InflationRate)/100)), parseFloat(CurYrTemp)) 
						if ( PurchasePropertyQualify == "")
							PurchasePropertyQualify	=	0
						FFCost						= Math.round(parseFloat(InitialFixFitCost) * parseFloat(FFCostValPowMath) * parseFloat(PurchasePropertyQualify))
						ObjFFCost                   = FnTrObj.find("[rel='FFCost"+ dn +"'][month='0']");
						ObjFFCost.val(FFCost);
						
						
						//AW//=AV16*FixFitDepnRate 
						
						//console.log('FixFitDepnRate=='+FixFitDepnRate);FFCost
						FFDepn                     	= Math.round(parseFloat(FFCost) * (parseFloat(FixFitDepnRate) / 100))
						ObjFFDepn                   = FnTrObj.find("[rel='FFDepn"+ dn +"'][month='0']");
						ObjFFDepn.val(FFDepn);
						
						//AX//=AV16-AW16						
						FFDbv                       = Math.round(parseFloat(FFCost) - parseFloat(FFDepn));					
						ObjFFDbv                    = FnTrObj.find("[rel='FFDbv"+ dn +"'][month='0']");
						ObjFFDbv.val(FFDbv);
						
						
					}
					else{
						FFCost						= CheckIsNaN( $("[rel='FFCost" + dn + "'][month='0'][year='"+ PrevYr+"']").val() );
						FFDepn						= CheckIsNaN( $("[rel='FFDepn" + dn + "'][month='0'][year='"+ PrevYr+"']").val() );
						FFDbv						= CheckIsNaN( $("[rel='FFDbv" + dn + "'][month='0'][year='"+ PrevYr+"']").val() );

						//=IF(AS4>1,AS4,0)
						if ( parseFloat(FFCost) > 0 ){
							FFCost					= Math.round(FFCost)
						}else{
							FFCost					= 0
							
						}	
						ObjFFCost                   = FnTrObj.find("[rel='FFCost"+ dn +"'][month='0']");
						ObjFFCost.val(FFCost);
						
						//FF Depn   => =IF((AS16*FixFitDepnRate)>AU4,AU4,AS16*FixFitDepnRate)
						FFDepnVal                    = parseFloat(FFCost) * parseFloat(FixFitDepnRate) / 100;
						if ( parseFloat(FFDepnVal) >  parseFloat(FFDbv) ) {
							FFDepn					= Math.round(parseFloat(FFDbv))
						}else{
							FFDepn					= Math.round(parseFloat(FFDepnVal))
						}						
						ObjFFDepn                   = FnTrObj.find("[rel='FFDepn"+ dn +"'][month='0']");
						ObjFFDepn.val(FFDepn);
						
						//=AU4-AT16
						FFDbv                       = Math.round(parseFloat(FFDbv) - parseFloat(FFDepn));					
						ObjFFDbv                    = FnTrObj.find("[rel='FFDbv"+ dn +"'][month='0']");
						ObjFFDbv.val(FFDbv);
						
					}
					
					FFCostTotal                 = Math.round(parseFloat(FFCostTotal) + parseFloat(FFCost));
					FFDepnTotal                 = Math.round(parseFloat(FFDepnTotal) + parseFloat(FFDepn));
					FFDbvTotal                  = Math.round(parseFloat(FFDbvTotal) + parseFloat(FFDbv));   
				}
				
				ObjTotalFFCost                  = FnTrObj.find("[rel='TotalFFCost']");
				ObjTotalFFDepn                  = FnTrObj.find("[rel='TotalFFDepn']");
				ObjTotalFFBv                    = FnTrObj.find("[rel='TotalFFBv']");
				
				ObjTotalFFCost.val(FFCostTotal);
				ObjTotalFFDepn.val(FFDepnTotal);
				ObjTotalFFBv.val(FFDbvTotal);
				
				//====================================================
	
				YrPDCEnd						= CurYr	
				ObjYrPDCEnd            			= FnTrObj.find("[rel='YrPDCEnd']");
				ObjYrPDCEnd.val(YrPDCEnd);
				 
				 

				//FA//Open Bal//=IF(PurchaseDecisionCalc!GT15>0,PurchaseDecisionCalc!GT15,0)  '	ClosingBal Last Zero 	
				if (parseFloat(ClosingBal) > 0) {
					OpenBal				= Math.round(ClosingBal)
				}
				else{
					OpenBal				= 0;
				}				
				ObjOpenBal	= FnTrObj.find("[rel='OpenBal']");
				ObjOpenBal.val(OpenBal);				
				//FB//Deposits - Net Contribution + Current Loan Payments
				//=IF(FA16>0,TotalOffsetSurplus/12*(1+NetWageGrowthRate)^($EX16),0)		
					
				
				if (parseFloat(OpenBal) > 0){ 
					DepositSurPlus				= parseFloat(TotalOffsetSurplus) / 12
					DepositsPow                 = Math.pow((1+(parseFloat(NetWageGrowthRate)/100)), parseFloat(CurYr))   ;
					Deposits					= Math.round(parseFloat(DepositSurPlus) * parseFloat(DepositsPow));
					LumpSum						= 0;
				}
				else{
					Deposits                    = 0;
					LumpSum						= 0;
				}
				
				ObjDeposits	= FnTrObj.find("[rel='Deposits']");
				ObjDeposits.val(Deposits);	
				
				ObjLumpSum	= FnTrObj.find("[rel='LumpSum']");
				ObjLumpSum.val(LumpSum);	
				
								
							
				//GA//=IF(FA16>0,(VLOOKUP($EX16,PurchaseDecisionCalc!$AF$4:$AN$424,9,FALSE))/12,0)
					
							
				if ( parseFloat(OpenBal) > 0 ) {
					MlcDepositNetCashRentalIncome =  Math.round(parseFloat(IecNetCashIncome) / 12) ;	
					
				}else{
					
					MlcDepositNetCashRentalIncome = 0
				}
							
				ObjMlcDepositNetCashRentalIncome		= FnTrObj.find("[rel='MlcDepositNetCashRentalIncome']");
				ObjMlcDepositNetCashRentalIncome.val(MlcDepositNetCashRentalIncome);
												
							
							
				//GB//=IFERROR(VLOOKUP(EW16,PurchaseDecisionCalc!$B$4:$E$424,4,FALSE),0)	
					//IFERROR(VLOOKUP(MlcYrStart,InflationAdjustPdcEnd,FALSE),0)
	
					
				if ( InflationAdjustPdcEnd == null || InflationAdjustPdcEnd == "" ){					
					NonDeductibleWithdrawDrawdones		=	0
				}else{
					NonDeductibleWithdrawDrawdones		=	Math.round(InflationAdjustPdcEnd)
				}
				
				ObjNonDeductibleWithdrawDrawdones		= FnTrObj.find("[rel='NonDeductibleWithdrawDrawdones']");
				ObjNonDeductibleWithdrawDrawdones.val(NonDeductibleWithdrawDrawdones);
							
			
				
				//Subtotal///=FA17-FB17-FC17-FD17+FE17 //OpenBal - Deposits - LumpSum
				//
				
				Subtotal								=	parseFloat(OpenBal) - parseFloat(Deposits) - parseFloat(LumpSum) - parseFloat(MlcDepositNetCashRentalIncome) + parseFloat(NonDeductibleWithdrawDrawdones)  
				
				
				//IF(MlcClosingBal<0,0,MlcClosingBal)  
					
				//MlcOpenBal
				//GC//=GY15		
				//=IFERROR(VLOOKUP(EW17,$B$5:$E$425,4,FALSE),0)
				if ( parseFloat(MlcClosingBal) < 0 ) { 
					MlcOpenBal							=	0	
				}else{
					MlcOpenBal							=	MlcClosingBal	
				}
				ObjMlcOpenBal							= FnTrObj.find("[rel='MlcOpenBal']");
				ObjMlcOpenBal.val(MlcOpenBal);		


				//GD//=IF(PurchaseDecisionCalc!GA16=0,(VLOOKUP(PurchaseDecisionCalc!EX16,PurchaseDecisionCalc!$AF$4:$AN$424,9,FALSE))/12,0) Old
				
				
				//Deposits - Net Contribution + Current Loan Payments	
				//DepositNetContribution  	New			
				//=IF(FA17>0,IF(FF17<0,-FF17,0),TotalOffsetSurplus/12*(1+NetWageGrowthRate)^($EX17))
				//IF(OpenBal>0,IF(SubTotal<0,-SubTotal,0),TotalOffsetSurplus/12*(1+NetWageGrowthRate)^(MlcYr)) LumpSumDeposit
				
				if ( parseFloat(OpenBal) > 0 ) {
					if ( parseFloat(Subtotal) < 0){
						
						DepositNetContribution = -parseFloat(Subtotal)
					}else{
						DepositNetContribution = 0
					}					
				}else{
					DepositNetContributionPow = Math.pow(( 1 + ( parseFloat(NetWageGrowthRate) / 100 ) ) , parseFloat(CurYr) );					
					DepositNetContribution  = Math.round(((parseFloat(TotalOffsetSurplus) / 100) /12) * parseFloat(DepositNetContributionPow)) 
				}
					
				//console.log('DepositNetContribution='+DepositNetContribution);
				ObjDepositNetContribution		= FnTrObj.find("[rel='DepositNetContribution']");
				ObjDepositNetContribution.val(DepositNetContribution);	
				
				
				//Lump Sum Deposit //IF(FA6>0,0,LumpSumDeposit) // 
				//IF(OpenBal>0,0,LumpSumDeposit)
					
				if (LumpSumDeposit == "")
					LumpSumDeposit = 0
				
				if ( parseFloat(OpenBal) > 0 ) {
					
					LumpSumDeposit 				= 0
				} else{
					LumpSumDeposit 				= LumpSumDeposit
					
				}
				
				ObjLumpSumDeposit						= FnTrObj.find("[rel='LumpSumDeposit']");
				ObjLumpSumDeposit.val(LumpSumDeposit);	
				
				
				
				//Deposits - Net Cash Rental Income
				//=IF(FD17=0,(VLOOKUP(EX17,$AF$5:$AN$425,9,FALSE))/12,0)
				//IF(FD8=0,(VLOOKUP(EX8,$AF$6:$AN$426,9,FALSE))/12,0)					
				//IF(PMlcDepositNetCashRentalIncome=0,(VLOOKUP(MlcYr,IecNetCashIncome,FALSE))/12,0)
				
				if (parseFloat(MlcDepositNetCashRentalIncome) == 0) {
					DepositNetCashRentalIncome  		=	Math.round(parseFloat(IecNetCashIncome) / 12) ;	

				}else{
					DepositNetCashRentalIncome			= 0
				}
				
				ObjDepositNetCashRentalIncome			= FnTrObj.find("[rel='DepositNetCashRentalIncome']");
				ObjDepositNetCashRentalIncome.val(DepositNetCashRentalIncome);		

				//GE//=IFERROR(VLOOKUP(PurchaseDecisionCalc!EW16,PurchaseDecisionCalc!$B$4:$IS$424,10,FALSE),0)
				
				WithdrawalsDrawdowns					= Math.round(DrawdownReqn)
				ObjWithdrawalsDrawdowns					= FnTrObj.find("[rel='WithdrawalsDrawdowns']");
				ObjWithdrawalsDrawdowns.val(WithdrawalsDrawdowns);		
				

				
				//GH//Balance before interest//=GC16-GG16-GF16-GD16+GE16
				//Balance before interest
				//=FG17-FH17-FI17-FJ17+FK17
				
				
				BalanceBeforeInterest			=  Math.round(parseFloat(MlcOpenBal) - parseFloat(DepositNetContribution) - parseFloat(LumpSumDeposit) - parseFloat(DepositNetCashRentalIncome) + parseFloat(WithdrawalsDrawdowns))
				
				ObjBalanceBeforeInterest		= FnTrObj.find("[rel='BalanceBeforeInterest']");
				ObjBalanceBeforeInterest.val(BalanceBeforeInterest);	
				//IF((FL7)<0.1,0,IF(VLOOKUP(EX7,$EW$6:$FA$435,5)>0,FL7,VLOOKUP(EX7,$EW$6:$FG$435,11)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX7)-VLOOKUP($EX7,$AF$6:$AN$426,9)+(VLOOKUP(EX7,$EW$6:$FG$435,11)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX7)-VLOOKUP($EX7,$AF$6:$AN$426,9))*FixedInterestRate))
				//IF((BalanceBeforeInterest)<0.1,0,IF(VLOOKUP(MlcYr,OpenBal)>0,BalanceBeforeInterest,VLOOKUP(MlcYr,MlcOpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome)+(VLOOKUP(MlcYr,MlcOpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome))*FixedInterestRate))
				
			
				 if ( parseFloat(BalanceBeforeInterest) < 0.1 ) {
				  
					  MlcFixedLoanBalance = 0
					  
				  }else{
					  
					  
					  if ( parseFloat(OpenBal) > 0 ) {
						  
						  MlcFixedLoanBalance	= BalanceBeforeInterest;
					  }else{
						  
						MlcFixedLoanBalancEPlus					= parseFloat(TotalOffsetSurplus);
						MlcFixedLoanBalancEPow					= Math.pow((1+(parseFloat(NetWageGrowthRate)/100)), parseFloat(CurYr));
						MlcFixedLoanBalancTotal					= Math.round(parseFloat(MlcFixedLoanBalancEPlus) * parseFloat(MlcFixedLoanBalancEPow));
						  
						  MlcFixedLoanBalance	= parseFloat(OpenBal) - parseFloat(MlcFixedLoanBalancTotal) - parseFloat(IecNetCashIncome) + (parseFloat(OpenBal) - parseFloat(MlcFixedLoanBalancTotal) - parseFloat(IecNetCashIncome) ) * parseFloat(FixedInterestRate) / 100
					  }
					  
				  }
			

				ObjMlcFixedLoanBalance			= FnTrObj.find("[rel='MlcFixedLoanBalance']");
				ObjMlcFixedLoanBalance.val(MlcFixedLoanBalance);


				
				//GJ//Line of Credit Balance//=GH15-GI15 
				// MlcFixedLoanInterest =FM17*FixedInterestRate/12
				
				//GK//Fixed Loan Interest//=GI16*FixedInterestRate/12 MlcFixedLoanBalance
				
				MlcFixedLoanInterest			= Math.round(parseFloat(MlcFixedLoanBalance) * (parseFloat(FixedInterestRate)/100) /12)
				
				ObjMlcFixedLoanInterest			= FnTrObj.find("[rel='MlcFixedLoanInterest']");
				ObjMlcFixedLoanInterest.val(MlcFixedLoanInterest);	
				
				
				//===================== MlcLineOfCreditBalance
						//Line of Credit Balance//=IF(FM5<0,FL5,FL5-FM5)
							
					//LineOfCreditBalance => =BalanceBeforeInterest-MlcFixedLoanBalance
					
					//console.log('MlcFixedLoanBalance='+MlcFixedLoanBalance);
				
					if ( parseFloat(MlcFixedLoanBalance) < 0 ){
						MlcLineOfCreditBalance		= parseFloat(MlcFixedLoanBalance);
						
					}else{
						MlcLineOfCreditBalance			= parseFloat(MlcFixedLoanBalance) - parseFloat(MlcFixedLoanBalance);
					}
					ObjMlcLineOfCreditBalance		= FnTrObj.find("[rel='MlcLineOfCreditBalance']");
					ObjMlcLineOfCreditBalance.val(MlcLineOfCreditBalance);

					
					//Old//LOC Interest => =IF(GJ4<0,0,GJ4)*TaxDedLOCIntRate/12			MlcLOCInterest = IF(MlcLineOfCreditBalance<0,0,MlcLineOfCreditBalance)*TaxDedLOCIntRate/12 
					//=IF(FO5<0,0,FO5)*TaxDedLOCIntRate/12
					//=IF(FO17<0,0,FO17)*TaxDedLOCIntRate/12
					
					if (parseFloat(MlcLineOfCreditBalance) < 0){
						MlcLOCInterest_Temp			= 0;
					}
					else{
						MlcLOCInterest_Temp			= MlcLineOfCreditBalance;
					}

					MlcLOCInterest					= parseFloat(MlcLOCInterest_Temp) * ( parseFloat(MlcLOCInterest_Temp) /100 ) /12;
					ObjMlcLOCInterest				= FnTrObj.find("[rel='MlcLOCInterest']");
					ObjMlcLOCInterest.val(MlcLOCInterest);

					
					//Total Ded Int => =GK4+GL4			TotalDedInt	= MlcFixedLoanInterest + MlcLOCInterest
					//=FN5+FP5
					TotalDedInt						= parseFloat(MlcFixedLoanInterest) + parseFloat(MlcLOCInterest);
					ObjTotalDedInt					= FnTrObj.find("[rel='TotalDedInt']");
					ObjTotalDedInt.val(TotalDedInt);

					//=FL5+FR5
					
					//old//Total Ded Interest Charge => =IF(GU4>0,0,GM4)		TotalDedInterestCharge = IF(ClosingBal>0,0,TotalDedInt)
					//New//=IF(FA5>0,0,FQ5)
				
					if (parseFloat(OpenBal) > 0){
						TotalDedInterestCharge			= 0;
					}
					else{
						TotalDedInterestCharge			= TotalDedInt;
					}
					ObjTotalDedInterestCharge			= FnTrObj.find("[rel='TotalDedInterestCharge']");
					ObjTotalDedInterestCharge.val(TotalDedInterestCharge);	

					//MlcClosingBal

					
					//Closing Balance => =GH4+GX4		MlcClosingBal = BalanceBeforeInterest + TotalDedInterestCharge
					MlcClosingBal						= parseFloat(BalanceBeforeInterest) + parseFloat(TotalDedInterestCharge);
					ObjMlcClosingBal					= FnTrObj.find("[rel='MlcClosingBal']");
					ObjMlcClosingBal.val(MlcClosingBal);	
					
					//Investment Interest//=IF(FA5>0,FQ5,0) InvestmentInterest
					
					//Investment Interest	=> =IF(FA4>0,PurchaseDecisionCalc!GM4,0)		InvestmentInterest = IF(TotalNonInvLoanBal>0,TotalDedInt,0)
						
					if (parseFloat(OpenBal) > 0){
						InvestmentInterest			= TotalDedInt;
					}
					else{
						InvestmentInterest			= 0;
					}
					ObjInvestmentInterest			= FnTrObj.find("[rel='InvestmentInterest']");
					ObjInvestmentInterest.val(Math.round(InvestmentInterest));
				
					
					//Balance before interest mlc end //MlcBalanceBeforeInterest
					//=FF5+FT5
					
					MlcBalanceBeforeInterest 		= parseFloat(Subtotal) + parseFloat(InvestmentInterest)
					ObjMlcBalanceBeforeInterest		= FnTrObj.find("[rel='MlcBalanceBeforeInterest']");
					ObjMlcBalanceBeforeInterest.val(MlcBalanceBeforeInterest);

					
					
					//FixedLoanBalance
					//=IF($FA5<0.1,0,(VLOOKUP($EX5,$EW$5:$FA$434,5)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AP$425,9))+FM5*FixedInterestRate+(VLOOKUP($EX5,$EW$5:$FA$434,5)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AP$425,9))*FixedInterestRate)
					//IF(OpenBal<0.1,0,(VLOOKUP(MlcYr,OpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome))+FM7*FixedInterestRate+(VLOOKUP(MlcYr,OpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome))*FixedInterestRate)
					
						
					  if ( parseFloat(OpenBal) < 0.1 ) {
						  
						  FixedLoanBalance = 0
						  
					  }else{
						  
						 FixedLoanBalancEPow = Math.pow(( 1 + ( parseFloat(NetWageGrowthRate) / 100 ) ) , parseFloat(CurYr) );					
						 FixedLoanBalancTotal  = Math.round((parseFloat(TotalOffsetSurplus) ) * parseFloat(FixedLoanBalancEPow)) 
								
							
						  FixedLoanBalancecal1	= 	parseFloat(OpenBal) - parseFloat(FixedLoanBalancTotal) - parseFloat(IecNetCashIncome) 
						  FixedLoanBalancecal2 	=   MlcFixedLoanBalance *  parseFloat(FixedInterestRate) / 100
						  FixedLoanBalancecal3 	=	(parseFloat(OpenBal) - parseFloat(FixedLoanBalancTotal) - parseFloat(IecNetCashIncome) ) * parseFloat(FixedInterestRate) / 100
							

						  FixedLoanBalance		=	parseFloat(FixedLoanBalancecal1) +  parseFloat(FixedLoanBalancecal2) + parseFloat(FixedLoanBalancecal3)
					  }
					
				
					ObjFixedLoanBalance					= FnTrObj.find("[rel='FixedLoanBalance']");
					ObjFixedLoanBalance.val(Math.round(FixedLoanBalance));	

					//=IF(FV5<0,0,FV5*FixedInterestRate/12) FixedLoanInterest
					//FixedLoanInterest = IF(FixedLoanBalance<0,0,FixedLoanBalance*FixedInterestRate/12)
					
					if (parseFloat(FixedLoanBalance) < 0){
						FixedLoanInterest				= 0;
					}
					else{
						FixedLoanInterest				= Math.round(parseFloat(FixedLoanBalance) * (parseFloat(FixedInterestRate) / 100) /12);
					}
					ObjFixedLoanInterest				= FnTrObj.find("[rel='FixedLoanInterest']");
					ObjFixedLoanInterest.val(FixedLoanInterest);
					//=IF(FV5<0,FU5,FU5-FV5)		
					//LineOfCreditBalance
					//Line of Credit Balance => =PurchaseDecisionCalc!GO4-GP4			LineOfCreditBalance = MlcBalanceBeforeInterest - FixedLoanBalance
					//=IF(FV5<0,FU5,FU5-FV5)
					if ( FixedLoanBalance < 0){
						
						LineOfCreditBalance		=  parseFloat(MlcBalanceBeforeInterest)
					}else{
						LineOfCreditBalance		=  parseFloat(MlcBalanceBeforeInterest)
					}
				
					LineOfCreditBalance					= (parseFloat(MlcBalanceBeforeInterest) - parseFloat(FixedLoanBalance)).toFixed(2);
					ObjLineOfCreditBalance				= FnTrObj.find("[rel='LineOfCreditBalance']");
					ObjLineOfCreditBalance.val(Math.round(LineOfCreditBalance));	


					//LOC Interest => =IF(GQ4<0,0,GQ4)*NonDedLOCIntRate/12		LOCInterest = IF(LineOfCreditBalance<0,0,LineOfCreditBalance)*NonDedLOCIntRate/12
					//=IF(FX5<0,0,FX5)*NonDedLOCIntRate/12
					if (parseFloat(LineOfCreditBalance) < 0){
						LOCInterest_Temp				= 0;
					}
					else{
						LOCInterest_Temp				= LineOfCreditBalance;
					}
					LOCInterest							= (parseFloat(LOCInterest_Temp) * (parseFloat(NonDedLOCIntRate) / 100) / 12).toFixed(2);
					ObjLOCInterest						= FnTrObj.find("[rel='LOCInterest']");
					ObjLOCInterest.val(Math.round(LOCInterest));	

					//Total Non Ded Int => =GR4+GS4		TotalNonDedInt = FixedLoanInterest + LOCInterest
					TotalNonDedInt						= (parseFloat(FixedLoanInterest) + parseFloat(LOCInterest)).toFixed(2)
					ObjTotalNonDedInt					= FnTrObj.find("[rel='TotalNonDedInt']");
					ObjTotalNonDedInt.val(Math.round(TotalNonDedInt));	
					

					//Closing Balance	=> =IF(PurchaseDecisionCalc!GO4<0,0,PurchaseDecisionCalc!GO4+GT4)	
					//ClosingBal = IF(MlcBalanceBeforeInterest<0,0,MlcBalanceBeforeInterest+TotalNonDedInt)	
					//New//=IF(FU5<0,0,FU5+FZ5)

					if (parseFloat(MlcBalanceBeforeInterest) < 0){
						ClosingBal						= 0;
					}
					else{
						ClosingBal						= (parseFloat(MlcBalanceBeforeInterest) + parseFloat(TotalNonDedInt)).toFixed(2); 
					}

					ObjClosingBal						= FnTrObj.find("[rel='ClosingBal']");
					ObjClosingBal.val(Math.round(ClosingBal));	
					
					
					
					//Total Tax Ded Int => =GM4		TotalTaxDedInt = TotalDedInt 
					TotalTaxDedInt						= parseFloat(TotalDedInt);
					ObjTotalTaxDedInt					= FnTrObj.find("[rel='TotalTaxDedInt']");
					ObjTotalTaxDedInt.val(Math.round(TotalTaxDedInt));


					//Total Tax Ded Int => =GM4		TotalTaxDedInt = TotalDedInt  =GC5+FZ5
					TotalIntMlc						= parseFloat(TotalTaxDedInt) + parseFloat(TotalNonDedInt);
					ObjTotalIntMlc					= FnTrObj.find("[rel='TotalIntMlc']");
					ObjTotalIntMlc.val(Math.round(TotalIntMlc));

					FrstClosingBal					=	ClosingBal
					FrstMlcClosingBal				=	MlcClosingBal
						
						
				//==========================
				
	
				$(".tr_year_month[year='"+ CurYr +"']:not([month='0'])").each(function(){
					FnMonTrObj					= $(this);
					CurMonth					= CheckIsNaN( FnMonTrObj.find("[rel='MlcYr']").attr("month") );		
					
						
				//FA//Open Bal//=IF(PurchaseDecisionCalc!GT15>0,PurchaseDecisionCalc!GT15,0)  '		
				if (parseFloat(ClosingBal) > 0) {
					OpenBal				= Math.round(ClosingBal)
				}
				else{
					OpenBal				= 0;
				}				
				ObjOpenBal	= FnMonTrObj.find("[rel='OpenBal']");
				ObjOpenBal.val(OpenBal);	
					
					
					
				if (parseFloat(OpenBal) > 0){
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
	
				ObjDeposits                     = FnMonTrObj.find("[rel='Deposits']");
				ObjDeposits.val(Deposits);
					
				ObjLumpSumDeposit               = FnMonTrObj.find("[rel='LumpSum']");
				ObjLumpSumDeposit.val(LumpSum);
				
			
				if ( parseFloat(TotalNonInvLoanBal) > 0 ) {
					MlcDepositNetCashRentalIncome =  Math.round(parseFloat(IecNetCashIncome) / 12) ;	
					
				}else{
					
					MlcDepositNetCashRentalIncome = 0
				}
							
				ObjMlcDepositNetCashRentalIncome		= FnMonTrObj.find("[rel='MlcDepositNetCashRentalIncome']");
				ObjMlcDepositNetCashRentalIncome.val(MlcDepositNetCashRentalIncome);
													
											
					//GB//=IFERROR(VLOOKUP(EW16,PurchaseDecisionCalc!$B$4:$E$424,4,FALSE),0)	
						//IFERROR(VLOOKUP(MlcYrStart,InflationAdjustPdcEnd,FALSE),0)
									
				InflationAdjustPdcEnd			= CheckIsNaN( $("[name='InflationAdjustPdcEnd']").val() );
				NonDeductibleWithdrawDrawdones	= InflationAdjustPdcEnd;
				ObjNonDeductibleWithdrawDrawdones	= FnMonTrObj.find("[rel='NonDeductibleWithdrawDrawdones']");
				ObjNonDeductibleWithdrawDrawdones.val(NonDeductibleWithdrawDrawdones);

								
				
					
				//Subtotal///=FA17-FB17-FC17-FD17+FE17 //OpenBal - Deposits - LumpSum
					
				Subtotal								=	parseFloat(OpenBal) - parseFloat(Deposits) - parseFloat(LumpSum) - parseFloat(MlcDepositNetCashRentalIncome) + parseFloat(NonDeductibleWithdrawDrawdones)  
					
				
				//MLC Open Bal (MlcOpenBal)	=> =MlcClosingBal
				//=IF(FS5<0,0,FS5)
				if (parseFloat(MlcClosingBal) < 0) {
					MlcOpenBal					=	0
				}else{
					MlcOpenBal						= MlcClosingBal;					
				}
				
				ObjMlcOpenBal					= FnMonTrObj.find("[rel='MlcOpenBal']");
				ObjMlcOpenBal.val(MlcOpenBal);
					
					
				//=IF(FA6>0,IF(FF6<0,-FF6,0),TotalOffsetSurplus/12*(1+NetWageGrowthRate)^($EX6))
				if ( parseFloat(OpenBal) > 0 ) {
					if ( parseFloat(Subtotal) < 0){
						
						DepositNetContribution = -parseFloat(Subtotal)
					}else{
						DepositNetContribution = 0
					}					
				}else{
					DepositNetContributionPow = Math.pow(( 1 + ( parseFloat(NetWageGrowthRate) / 100 ) ) , parseFloat(CurYr) );					
					DepositNetContribution  = Math.round(((parseFloat(TotalOffsetSurplus) / 100) /12) * parseFloat(DepositNetContributionPow)) 
				}
					
				//console.log('DepositNetContribution='+DepositNetContribution);
				ObjDepositNetContribution		= FnMonTrObj.find("[rel='DepositNetContribution']");
				ObjDepositNetContribution.val(DepositNetContribution);	
				
					
				//Lump Sum Deposit //IF(FA6>0,0,LumpSumDeposit) // 
				//IF(OpenBal>0,0,LumpSumDeposit)
					
				if (LumpSumDeposit == "")
					LumpSumDeposit = 0
				
				if ( parseFloat(OpenBal) > 0 ) {
					
					LumpSumDeposit 				= 0
				} else{
					LumpSumDeposit 				= LumpSumDeposit
					
				}
				
				ObjLumpSumDeposit						= FnMonTrObj.find("[rel='LumpSumDeposit']");
				ObjLumpSumDeposit.val(LumpSumDeposit);	
					
					
					
					
				//Deposits - Net Cash Rental Income
				//=IF(FD17=0,(VLOOKUP(EX17,$AF$5:$AN$425,9,FALSE))/12,0)
				//IF(FD8=0,(VLOOKUP(EX8,$AF$6:$AN$426,9,FALSE))/12,0)					
				//IF(PMlcDepositNetCashRentalIncome=0,(VLOOKUP(MlcYr,IecNetCashIncome,FALSE))/12,0)
				
				if (parseFloat(MlcDepositNetCashRentalIncome) == 0) {
					DepositNetCashRentalIncome  		=	Math.round(parseFloat(IecNetCashIncome) / 12) ;	

				}else{
					DepositNetCashRentalIncome			= 0
				}
				
				ObjDepositNetCashRentalIncome			= FnMonTrObj.find("[rel='DepositNetCashRentalIncome']");
				ObjDepositNetCashRentalIncome.val(DepositNetCashRentalIncome);		

				//Withdrawals / Drawdowns
				//	//=IFERROR(VLOOKUP(EW5,$B$5:$HV$425,10,FALSE),0)
				DrawdownReqn							=	0
				WithdrawalsDrawdowns					= Math.round(DrawdownReqn)
				ObjWithdrawalsDrawdowns					= FnMonTrObj.find("[rel='WithdrawalsDrawdowns']");
				ObjWithdrawalsDrawdowns.val(WithdrawalsDrawdowns);		
					

				
				//GH//Balance before interest//=GC16-GG16-GF16-GD16+GE16
				//Balance before interest
				//=FG17-FH17-FI17-FJ17+FK17

				
				BalanceBeforeInterest			=  Math.round(parseFloat(MlcOpenBal) - parseFloat(DepositNetContribution) - parseFloat(LumpSumDeposit) - parseFloat(DepositNetCashRentalIncome) + parseFloat(WithdrawalsDrawdowns))
				
				ObjBalanceBeforeInterest		= FnMonTrObj.find("[rel='BalanceBeforeInterest']");
				ObjBalanceBeforeInterest.val(BalanceBeforeInterest);	

				//Fixed Loan Balance =IF(PurchaseDecisionCalc!FA4>0,GH4,(VLOOKUP((PurchaseDecisionCalc!EX4+1),PurchaseDecisionCalc!$FD$4:$FN$435,11))+(SUMIFS(PurchaseDecisionCalc!$FX$4:$FX$435,PurchaseDecisionCalc!$FE$4:$FE$435,PurchaseDecisionCalc!FE4)))

				//=IF((FL5)<0.1,0,IF(VLOOKUP(EX5,$EW$5:$FA$434,5)>0,FL5,
				
				//VLOOKUP(EX5,$EW$5:$FG$434,11)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AN$425,9)+
				//(VLOOKUP(EX5,$EW$5:$FG$434,11)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AN$425,9))*FixedInterestRate))
				//IF((BalanceBeforeInterest)<0.1,0,IF(VLOOKUP(MlcYr,OpenBal)>0,BalanceBeforeInterest,VLOOKUP(MlcYr,MlcOpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome)+(VLOOKUP(MlcYr,MlcOpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome))*FixedInterestRate))
					
				if ( parseFloat(BalanceBeforeInterest) < 0.1 ) {
					  
					  MlcFixedLoanBalance = 0
					  
				 }else{
					  
					  
					  if ( parseFloat(OpenBal) > 0 ) {
						  
						  MlcFixedLoanBalance	= BalanceBeforeInterest;
					  }else{
						  
						MlcFixedLoanBalancEPlus					= parseFloat(TotalOffsetSurplus);
						MlcFixedLoanBalancEPow					= Math.pow((1+(parseFloat(NetWageGrowthRate)/100)), parseFloat(CurYr));
						MlcFixedLoanBalancTotal					= Math.round(parseFloat(MlcFixedLoanBalancEPlus) * parseFloat(MlcFixedLoanBalancEPow));
						  
						  MlcFixedLoanBalance	= parseFloat(OpenBal) - parseFloat(MlcFixedLoanBalancTotal) - parseFloat(IecNetCashIncome) + (parseFloat(OpenBal) - parseFloat(MlcFixedLoanBalancTotal) - parseFloat(IecNetCashIncome) ) * parseFloat(FixedInterestRate) / 100
					  }
					  
				 }
			
			
			
					
				ObjMlcFixedLoanBalance			= FnMonTrObj.find("[rel='MlcFixedLoanBalance']");
				ObjMlcFixedLoanBalance.val(MlcFixedLoanBalance);


					
				//Fixed Loan Interest => =GI4*FixedInterestRate/12		MlcFixedLoanInterest = MlcFixedLoanBalance * FixedInterestRate /12
				MlcFixedLoanInterest			= parseFloat(MlcFixedLoanBalance) * (parseFloat(FixedInterestRate)/100) / 12;
				ObjMlcFixedLoanInterest			= FnMonTrObj.find("[rel='MlcFixedLoanInterest']");
				ObjMlcFixedLoanInterest.val(Math.round(MlcFixedLoanInterest));



				//Line of Credit Balance//=IF(FM5<0,FL5,FL5-FM5)
				//LineOfCreditBalance => =BalanceBeforeInterest-MlcFixedLoanBalance
			
				if ( parseFloat(MlcFixedLoanBalance) < 0 ){
					MlcLineOfCreditBalance		= parseFloat(MlcFixedLoanBalance);
					
				}else{
				MlcLineOfCreditBalance			= parseFloat(MlcFixedLoanBalance) - parseFloat(MlcFixedLoanBalance);
				}
				ObjMlcLineOfCreditBalance		= FnMonTrObj.find("[rel='MlcLineOfCreditBalance']");
				ObjMlcLineOfCreditBalance.val(Math.round(MlcLineOfCreditBalance));

				
				//Old//LOC Interest => =IF(GJ4<0,0,GJ4)*TaxDedLOCIntRate/12			MlcLOCInterest = IF(MlcLineOfCreditBalance<0,0,MlcLineOfCreditBalance)*TaxDedLOCIntRate/12 
				//=IF(FO5<0,0,FO5)*TaxDedLOCIntRate/12
				
				if (parseFloat(MlcLineOfCreditBalance) < 0){
					MlcLOCInterest_Temp			= 0;
				}
				else{
					MlcLOCInterest_Temp			= MlcLineOfCreditBalance;
				}

				MlcLOCInterest					= parseFloat(MlcLOCInterest_Temp) * ( parseFloat(MlcLOCInterest_Temp) /100 ) /12;
				ObjMlcLOCInterest				= FnMonTrObj.find("[rel='MlcLOCInterest']");
				ObjMlcLOCInterest.val(Math.round(MlcLOCInterest));

				
				//Total Ded Int => =GK4+GL4			TotalDedInt	= MlcFixedLoanInterest + MlcLOCInterest
				//=FN5+FP5
				TotalDedInt						= parseFloat(MlcFixedLoanInterest) + parseFloat(MlcLOCInterest);
				ObjTotalDedInt					= FnMonTrObj.find("[rel='TotalDedInt']");
				ObjTotalDedInt.val(Math.round(TotalDedInt));

				//=FL5+FR5
				
				//old//Total Ded Interest Charge => =IF(GU4>0,0,GM4)		TotalDedInterestCharge = IF(ClosingBal>0,0,TotalDedInt)
				//New//=IF(FA5>0,0,FQ5)
					//=IF(GA6>0,0,FQ6)
			
				if (parseFloat(MlcClosingBal) > 0){
					TotalDedInterestCharge			= 0;
				}
				else{
					TotalDedInterestCharge			= TotalDedInt;
				}
				ObjTotalDedInterestCharge			= FnMonTrObj.find("[rel='TotalDedInterestCharge']");
				ObjTotalDedInterestCharge.val(TotalDedInterestCharge);	

				//MlcClosingBal

				
				//Closing Balance => =GH4+GX4		MlcClosingBal = BalanceBeforeInterest + TotalDedInterestCharge
				MlcClosingBal						= parseFloat(BalanceBeforeInterest) + parseFloat(TotalDedInterestCharge);
				ObjMlcClosingBal					= FnMonTrObj.find("[rel='MlcClosingBal']");
				ObjMlcClosingBal.val(MlcClosingBal);	
				
				//Investment Interest//=IF(FA5>0,FQ5,0) InvestmentInterest
				
				//Investment Interest	=> =IF(FA4>0,PurchaseDecisionCalc!GM4,0)		InvestmentInterest = IF(TotalNonInvLoanBal>0,TotalDedInt,0)
					
				if (parseFloat(OpenBal) > 0){
					InvestmentInterest			= TotalDedInt;
				}
				else{
					InvestmentInterest			= 0;
				}
				ObjInvestmentInterest			= FnMonTrObj.find("[rel='InvestmentInterest']");
				ObjInvestmentInterest.val(Math.round(InvestmentInterest));
			
				
				//Balance before interest mlc end //MlcBalanceBeforeInterest
				//=FF5+FT5
				
				MlcBalanceBeforeInterest 		= parseFloat(Subtotal) + parseFloat(InvestmentInterest)
				ObjMlcBalanceBeforeInterest		= FnMonTrObj.find("[rel='MlcBalanceBeforeInterest']");
				ObjMlcBalanceBeforeInterest.val(Math.round(MlcBalanceBeforeInterest));

				
				
				//FixedLoanBalance
				//=IF($FA5<0.1,0,(VLOOKUP($EX5,$EW$5:$FA$434,5)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AP$425,9))+FM5*FixedInterestRate+(VLOOKUP($EX5,$EW$5:$FA$434,5)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX5)-VLOOKUP($EX5,$AF$5:$AP$425,9))*FixedInterestRate)
				//IF(OpenBal<0.1,0,(VLOOKUP(MlcYr,OpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome))+FM7*FixedInterestRate+(VLOOKUP(MlcYr,OpenBal)-TotalOffsetSurplus*(1+NetWageGrowthRate)^(MlcYr)-VLOOKUP(MlcYr,IecNetCashIncome))*FixedInterestRate)
				
				//=IF($FA17<0.1,0,(VLOOKUP($EX17,$EW$5:$FA$434,5)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX17)-VLOOKUP($EX17,$AF$5:$AP$425,9))+FM17*FixedInterestRate+(VLOOKUP($EX17,$EW$5:$FA$434,5)-TotalOffsetSurplus*(1+NetWageGrowthRate)^($EX17)-VLOOKUP($EX17,$AF$5:$AP$425,9))*FixedInterestRate)	
				 
				if ( parseFloat(OpenBal) < 0.1 ) {
					  
					  FixedLoanBalance = 0
					  
				  }else{
					  
					 FixedLoanBalancEPow = Math.pow(( 1 + ( parseFloat(NetWageGrowthRate) / 100 ) ) , parseFloat(CurYr) );					
					 FixedLoanBalancTotal  = Math.round((parseFloat(TotalOffsetSurplus) ) * parseFloat(FixedLoanBalancEPow)) 
							
						
					  FixedLoanBalancecal1	= 	parseFloat(OpenBal) - parseFloat(FixedLoanBalancTotal) - parseFloat(IecNetCashIncome) 
					  FixedLoanBalancecal2 	=   MlcFixedLoanBalance *  parseFloat(FixedInterestRate) / 100
					  FixedLoanBalancecal3 	=	(parseFloat(OpenBal) - parseFloat(FixedLoanBalancTotal) - parseFloat(IecNetCashIncome) ) * parseFloat(FixedInterestRate) / 100
						

					  FixedLoanBalance		=	parseFloat(FixedLoanBalancecal1) +  parseFloat(FixedLoanBalancecal2) + parseFloat(FixedLoanBalancecal3)
				  }
			
			
				ObjFixedLoanBalance					= FnMonTrObj.find("[rel='FixedLoanBalance']");
				ObjFixedLoanBalance.val(Math.round(FixedLoanBalance));	

				//=IF(FV5<0,0,FV5*FixedInterestRate/12) FixedLoanInterest
				//FixedLoanInterest = IF(FixedLoanBalance<0,0,FixedLoanBalance*FixedInterestRate/12)
				
				if (parseFloat(FixedLoanBalance) < 0){
					FixedLoanInterest				= 0;
				}
				else{
					FixedLoanInterest				= Math.round(parseFloat(FixedLoanBalance) * (parseFloat(FixedInterestRate) / 100) /12);
				}
				ObjFixedLoanInterest				= FnMonTrObj.find("[rel='FixedLoanInterest']");
				ObjFixedLoanInterest.val(FixedLoanInterest);
				//=IF(FV5<0,FU5,FU5-FV5)		
				//LineOfCreditBalance
				//Line of Credit Balance => =PurchaseDecisionCalc!GO4-GP4			LineOfCreditBalance = MlcBalanceBeforeInterest - FixedLoanBalance
				//=IF(FV5<0,FU5,FU5-FV5)
				if ( FixedLoanBalance < 0){
					
					LineOfCreditBalance		=  parseFloat(MlcBalanceBeforeInterest)
				}else{
					LineOfCreditBalance		=  parseFloat(MlcBalanceBeforeInterest)
				}
			
				LineOfCreditBalance					= (parseFloat(MlcBalanceBeforeInterest) - parseFloat(FixedLoanBalance)).toFixed(2);
				ObjLineOfCreditBalance				= FnMonTrObj.find("[rel='LineOfCreditBalance']");
				ObjLineOfCreditBalance.val(Math.round(LineOfCreditBalance));	


				//LOC Interest => =IF(GQ4<0,0,GQ4)*NonDedLOCIntRate/12		LOCInterest = IF(LineOfCreditBalance<0,0,LineOfCreditBalance)*NonDedLOCIntRate/12
				//=IF(FX6<0,0,FX6)*TaxDedLOCIntRate/12
				if (parseFloat(LineOfCreditBalance) < 0){
					LOCInterest_Temp				= 0;
				}
				else{
					LOCInterest_Temp				= LineOfCreditBalance;
				}
				LOCInterest							= (parseFloat(LOCInterest_Temp) * (parseFloat(TaxDedLOCIntRate) / 100) / 12).toFixed(2);
				ObjLOCInterest						= FnMonTrObj.find("[rel='LOCInterest']");
				ObjLOCInterest.val(Math.round(LOCInterest));	

				//Total Non Ded Int => =GR4+GS4		TotalNonDedInt = FixedLoanInterest + LOCInterest
				TotalNonDedInt						= (parseFloat(FixedLoanInterest) + parseFloat(LOCInterest)).toFixed(2)
				ObjTotalNonDedInt					= FnMonTrObj.find("[rel='TotalNonDedInt']");
				ObjTotalNonDedInt.val(Math.round(TotalNonDedInt));	
				

				//Closing Balance	=> =IF(PurchaseDecisionCalc!GO4<0,0,PurchaseDecisionCalc!GO4+GT4)	
				//ClosingBal = IF(MlcBalanceBeforeInterest<0,0,MlcBalanceBeforeInterest+TotalNonDedInt)	
				//New//=IF(FU5<0,0,FU5+FZ5)

				if (parseFloat(MlcBalanceBeforeInterest) < 0){
					ClosingBal						= 0;
				}
				else{
					ClosingBal						= (parseFloat(MlcBalanceBeforeInterest) + parseFloat(TotalNonDedInt)).toFixed(2); 
				}

				ObjClosingBal						= FnMonTrObj.find("[rel='ClosingBal']");
				ObjClosingBal.val(Math.round(ClosingBal));	
				
				
				
				//Total Tax Ded Int => =GM4		TotalTaxDedInt = TotalDedInt 
				TotalTaxDedInt						= parseFloat(TotalDedInt);
				ObjTotalTaxDedInt					= FnMonTrObj.find("[rel='TotalTaxDedInt']");
				ObjTotalTaxDedInt.val(Math.round(TotalTaxDedInt));


				//Total Tax Ded Int => =GM4		TotalTaxDedInt = TotalDedInt  =GC5+FZ5
				TotalIntMlc						= parseFloat(TotalTaxDedInt) + parseFloat(TotalNonDedInt);
				ObjTotalIntMlc					= FnMonTrObj.find("[rel='TotalIntMlc']");
				ObjTotalIntMlc.val(Math.round(TotalIntMlc));
				

					
				});
				

				//=PurchaseDecisionCalc!AQ16
				DepnClaim                			= Math.round(FFDepnTotal)
				ObjDepnClaim             			= FnTrObj.find("[rel='DepnClaim']");
				ObjDepnClaim.val(DepnClaim);
				

				//=PurchaseDecisionCalc!AN16-HD16
				//=AN17-GF17
				
				ProfitBeforeInterest              	= Math.round(parseFloat(IecNetCashIncome) - parseFloat(DepnClaim)) ;
				ObjProfitBeforeInterest         	= FnTrObj.find("[rel='ProfitBeforeInterest']");
				ObjProfitBeforeInterest.val(ProfitBeforeInterest);
				
				//
				//=SUMIFS(PurchaseDecisionCalc!$GL$4:$GL$435,PurchaseDecisionCalc!$EX$4:$EX$435,PurchaseDecisionCalc!AF16) TotalTotalDedInt
				TaxDeductibleInterest				= parseFloat(TotalDedInt) * 12; 
				ObjTaxDeductibleInterest         	= FnTrObj.find("[rel='TaxDeductibleInterest']");
				ObjTaxDeductibleInterest.val(TaxDeductibleInterest);
				
				
				//=PurchaseDecisionCalc!AN16-HE16 =AN17-GH17
				CashProfitLoss						= Math.round(parseFloat(IecNetCashIncome) - parseFloat(TaxDeductibleInterest))  
				ObjCashProfitLoss         			= FnTrObj.find("[rel='CashProfitLoss']");
				ObjCashProfitLoss.val(CashProfitLoss);
				
				
				//=HF16-HC16
				TaxableProfitLoss					= Math.round(parseFloat(CashProfitLoss) - parseFloat(DepnClaim))  
				ObjTaxableProfitLoss         		= FnTrObj.find("[rel='TaxableProfitLoss']");
				ObjTaxableProfitLoss.val(TaxableProfitLoss);
				
				
				//==+HI4+HH16
						
				CumulativeProfitLoss				= Math.round(parseFloat(CumulativeProfitLoss) + parseFloat(TaxableProfitLoss))  
				ObjCumulativeProfitLoss         	= FnTrObj.find("[rel='CumulativeProfitLoss']");
				ObjCumulativeProfitLoss.val(CumulativeProfitLoss);
				
				
								
				//HK//=IF(VLOOKUP(PurchaseDecisionCalc!$F16,PurchaseDecisionCalc!FY$4:$GX$435,20,FALSE)<0,0,VLOOKUP(PurchaseDecisionCalc!$F16,PurchaseDecisi
				

				
				if ( parseFloat(FrstMlcClosingBal) < 0 ) {
					CurTDedDebt						 =	 0
					
				}else{
					CurTDedDebt						 =	 parseFloat(FrstMlcClosingBal)
				}		
				ObjCurTDedDebt         				= FnTrObj.find("[rel='CurTDedDebt']");
				ObjCurTDedDebt.val(CurTDedDebt);
				
				
				//HL//=HK16+VLOOKUP(PurchaseDecisionCalc!$F16,PurchaseDecisionCalc!FZ$4:$GY$435,7,FALSE)
				//=GM17+VLOOKUP($F17,EW$5:$GA$436,31,FALSE)
				CurTotalDebt					= parseFloat(CurTDedDebt) + parseFloat(FrstClosingBal);	
				ObjCurTotalDebt         			= FnTrObj.find("[rel='CurTotalDebt']");
				ObjCurTotalDebt.val(CurTotalDebt);

				//HM//	=IF(PurchaseDecisionCalc!R16>PurchaseDecisionCalc!AE16,PurchaseDecisionCalc!AE16-HL16,PurchaseDecisionCalc!R16-HL16)
				//CurSurplusDeficit
				if ( parseFloat(BCapDSR) > parseFloat(BCapLVR) ){
					CurSurplusDeficit				=	Math.round(parseFloat(BCapLVR) - parseFloat(CurTotalDebt))
				}else{
					CurSurplusDeficit				=	Math.round(parseFloat(BCapDSR) - parseFloat(CurTotalDebt))	
				}
			
				ObjCurSurplusDeficit         		= FnTrObj.find("[rel='CurSurplusDeficit']");
				ObjCurSurplusDeficit.val(CurSurplusDeficit);
				
				//HN//=PurchaseDecisionCalc!L16+1 
				
				IfExtraProp							= Math.round(parseFloat(Properties) + 1)  			
				ObjIfExtraProp         				= FnTrObj.find("[rel='IfExtraProp']");
				ObjIfExtraProp.val(IfExtraProp);
				
				//HO///=(PurchaseDecisionCalc!J16*HN16)+PurchaseDecisionCalc!N16
				
				IfRent								= Math.round(( parseFloat(Rent) * parseFloat(IfExtraProp) )  + parseFloat(CurrentRent))				
				ObjIfRent         					= FnTrObj.find("[rel='IfRent']");
				ObjIfRent.val(IfRent);
				
				//HP//=(PurchaseDecisionCalc!I16*DSRSalary)+(PurchaseDecisionCalc!N16*DSRRent)+(HO16*DSRRent)
				
				IfDsrAmt							= Math.round(( parseFloat(TotSalary) * ( parseFloat(DSRSalary)/100) )  + ( parseFloat(CurrentRent)	* (parseFloat(DSRRent)/100) )	+ ( parseFloat(IfRent)	* (parseFloat(DSRRent)/100) ))
				ObjIfDsrAmt         				= FnTrObj.find("[rel='IfDsrAmt']");
				ObjIfDsrAmt.val(IfDsrAmt);
				
				//HQ//=HP16/LOCTestRate
				
				IfBcDsr								= Math.round( parseFloat(IfDsrAmt) / ( parseFloat(LOCTestRate) / 100 ) )  
				ObjIfBcDsr        					= FnTrObj.find("[rel='IfBcDsr']");
				ObjIfBcDsr.val(IfBcDsr);

				//=((PurchaseDecisionCalc!T16*HM16)+PurchaseDecisionCalc!O16)*MaxLVR
					
				IfBcLvr								= Math.round(( (parseFloat(Assumptions_F3) * parseFloat(IfExtraProp))  + parseFloat(CurrentPropVal)) * (parseFloat(MaxLVR)/100))
				ObjIfBcLvr        					= FnTrObj.find("[rel='IfBcLvr']");
				ObjIfBcLvr.val(IfBcLvr);
				
				//=HK16+PurchaseDecisionCalc!V16
				
				IfDebt								= Math.round(parseFloat(CurTotalDebt) + parseFloat(Loan)) 
				ObjIfDebt        					= FnTrObj.find("[rel='IfDebt']");
				ObjIfDebt.val(IfDebt);
				
				//HS//=IF(HP16>HQ16,HQ16-HR16,HP16-HR16)
					
				if(parseFloat(IfBcDsr) > parseFloat(IfBcLvr)) {
					IfSurplusDeficit				= Math.round(parseFloat(IfBcLvr)	- parseFloat(IfDebt))		
				}else{
					IfSurplusDeficit				= Math.round(parseFloat(IfBcDsr)	- parseFloat(IfDebt)) 	
				}
				ObjIfSurplusDeficit        			= FnTrObj.find("[rel='IfSurplusDeficit']");
				ObjIfSurplusDeficit.val(IfSurplusDeficit);
				
				//HT//=HM16+1
				If2ExtraProp						= Math.round(parseFloat(IfExtraProp) + 1 ) 
				ObjIf2ExtraProp        				= FnTrObj.find("[rel='If2ExtraProp']");
				ObjIf2ExtraProp.val(If2ExtraProp);
				
				//HU//=(PurchaseDecisionCalc!J16*HT16)+PurchaseDecisionCalc!N16
				BCCIfRent							= Math.round(( parseFloat(Rent) * parseFloat(If2ExtraProp) )  + parseFloat(CurrentRent))		
				ObjBCCIfRent        				= FnTrObj.find("[rel='BCCIfRent']");
				ObjBCCIfRent.val(BCCIfRent);
				

				
				//HV//=(PurchaseDecisionCalc!I16*DSRSalary)+(HU16*DSRRent)
				BCCIfDsrAmt							= Math.round(( parseFloat(TotSalary) * parseFloat(DSRSalary) )  + (parseFloat(BCCIfRent) * parseFloat(DSRRent)	))	
				ObjBCCIfRent        				= FnTrObj.find("[rel='BCCIfDsrAmt']");
				ObjBCCIfRent.val(BCCIfDsrAmt);
				
				
				//HW//=HV16/LOCTestRate
				Bcc1IfBcDsr							=  Math.round( parseFloat(BCCIfDsrAmt) / ( parseFloat(LOCTestRate) / 100 ) ) 
				ObjBcc1IfBcDsr        				= FnTrObj.find("[rel='Bcc1IfBcDsr']");
				ObjBcc1IfBcDsr.val(Bcc1IfBcDsr);
				
				
				//HX//=((PurchaseDecisionCalc!T16*HT16)+PurchaseDecisionCalc!O16)*MaxLVR
				BCCIfBcLvr							= Math.round(( (parseFloat(Assumptions_F3) * parseFloat(If2ExtraProp))  + parseFloat(CurrentPropVal)) * (parseFloat(MaxLVR)/100))
				ObjBCCIfBcLvr        				= FnTrObj.find("[rel='BCCIfBcLvr']");
				ObjBCCIfBcLvr.val(BCCIfBcLvr);
				
				//HY//=HR16+PurchaseDecisionCalc!V16
				BCCIfDebt							= Math.round(parseFloat(IfDebt) + parseFloat(Loan)) 
				ObjBCCIfDebt        				= FnTrObj.find("[rel='BCCIfDebt']");
				ObjBCCIfDebt.val(BCCIfDebt);
				
				//HZ//=IF(HW16>HX16,HX16-HY16,HW16-HY16)
					
				if(parseFloat(Bcc1IfBcDsr) > parseFloat(BCCIfBcLvr)) {
					BCCIfSurplusDeficit				= Math.round(parseFloat(BCCIfBcLvr)	- parseFloat(BCCIfDebt))		
				}else{
					BCCIfSurplusDeficit				= Math.round(parseFloat(Bcc1IfBcDsr)	- parseFloat(BCCIfDebt)) 	
				}					
				ObjBCCIfSurplusDeficit        		= FnTrObj.find("[rel='BCCIfSurplusDeficit']");
				ObjBCCIfSurplusDeficit.val(BCCIfSurplusDeficit);
				
				
				//IA//=IF(HW16>HX16,HX16-HY16,HW16-HY16)
					
				if(parseFloat(Bcc1IfBcDsr) > parseFloat(BCCIfBcLvr)) {
					BCCIfSurplusDeficit				= Math.round(parseFloat(BCCIfBcLvr)	- parseFloat(BCCIfDebt)) 		
				}else{
					BCCIfSurplusDeficit				= Math.round(parseFloat(Bcc1IfBcDsr)	- parseFloat(BCCIfDebt)) 	
				}					
				ObjBCCIfSurplusDeficit        		= FnTrObj.find("[rel='BCCIfSurplusDeficit']");
				ObjBCCIfSurplusDeficit.val(BCCIfSurplusDeficit);
				
				
				//IA//=HT16+1
				If3ExtraProp						= Math.round(parseFloat(If2ExtraProp) + 1)  
				ObjIf3ExtraProp        				= FnTrObj.find("[rel='If3ExtraProp']");
				ObjIf3ExtraProp.val(If3ExtraProp);
				
				//IB//=(PurchaseDecisionCalc!$J16*IA16)+PurchaseDecisionCalc!$N16
				BCC2IfRent							= Math.round(( parseFloat(Rent) * parseFloat(If3ExtraProp) )  + parseFloat(CurrentRent))		
				ObjBCC2IfRent        				= FnTrObj.find("[rel='BCC2IfRent']");
				ObjBCC2IfRent.val(BCC2IfRent);
				
				
				
				//IC//=(PurchaseDecisionCalc!$I16*DSRSalary)+(IB16*DSRRent)
				BCC2IfDsrAmt						= Math.round(( parseFloat(TotSalary) * parseFloat(DSRSalary) )  + (parseFloat(BCC2IfRent) * parseFloat(DSRRent)	))	
				ObjBCC2IfDsrAmt        				= FnTrObj.find("[rel='BCC2IfDsrAmt']");
				ObjBCC2IfDsrAmt.val(BCC2IfDsrAmt);
				
				
				//ID//=IC16/LOCTestRate
				Bcc2IfBcDsr							=  Math.round( parseFloat(BCC2IfDsrAmt) / ( parseFloat(LOCTestRate) / 100 ) ) 
				ObjBcc2IfBcDsr       				= FnTrObj.find("[rel='Bcc2IfBcDsr']");
				ObjBcc2IfBcDsr.val(Bcc2IfBcDsr);
				
				
				//IE//=((PurchaseDecisionCalc!$T16*IA16)+PurchaseDecisionCalc!$O16)*MaxLVR
				BCC2IfBcLvr							= Math.round(((parseFloat(Assumptions_F3) * parseFloat(If3ExtraProp))  + parseFloat(CurrentPropVal)) * (parseFloat(MaxLVR)/100))
				ObjBCC2IfBcLvr        				= FnTrObj.find("[rel='BCC2IfBcLvr']");
				ObjBCC2IfBcLvr.val(BCC2IfBcLvr);
				
				//IF//=HY16+PurchaseDecisionCalc!$V16
				BCC2IfDebt							= Math.round(parseFloat(BCCIfDebt) + parseFloat(Loan)) 
				ObjBCC2IfDebt       				= FnTrObj.find("[rel='BCC2IfDebt']");
				ObjBCC2IfDebt.val(BCC2IfDebt);
				
				
				//IG//=IF(ID16>IE16,IE16-IF16,ID16-IF16)
					
				if(parseFloat(Bcc2IfBcDsr) > parseFloat(BCC2IfBcLvr)) {
					BCC2IfsurplusDeficit			= Math.round(parseFloat(BCC2IfBcLvr)	- parseFloat(BCC2IfDebt)) 		
				}else{
					BCC2IfsurplusDeficit			= Math.round(parseFloat(Bcc2IfBcDsr)	- parseFloat(BCC2IfDebt)) 	
				}					
				ObjBCC2IfsurplusDeficit        		= FnTrObj.find("[rel='BCC2IfsurplusDeficit']");
				ObjBCC2IfsurplusDeficit.val(BCC2IfsurplusDeficit);
				
				//IH ==  nULL
				
				
				//II//=PurchaseDecisionCalc!F28
				Year								= CheckIsNaN(FnTrObj.find("[rel='BccYrStart']").val()) + 1 ; 
				ObjYear        						= FnTrObj.find("[rel='Year']");
				ObjYear.val(Year);
				
				//IJ//=HL16
				BccCurSurplusDeficit				= Math.round(CurSurplusDeficit) 
				ObjBccCurSurplusDeficit        		= FnTrObj.find("[rel='BccCurSurplusDeficit']");
				ObjBccCurSurplusDeficit.val(BccCurSurplusDeficit);
				
				
				//IK//=HS16
				Plus1PropSurplusDeficit				= Math.round(IfSurplusDeficit) 
				ObjPlus1PropSurplusDeficit        	= FnTrObj.find("[rel='Plus1PropSurplusDeficit']");
				ObjPlus1PropSurplusDeficit.val(Plus1PropSurplusDeficit);
				
				//IL//=HZ16
				Plus2PropSurplusDeficit				= Math.round(BCCIfSurplusDeficit)
				ObjPlus2PropSurplusDeficit        	= FnTrObj.find("[rel='Plus2PropSurplusDeficit']");
				ObjPlus2PropSurplusDeficit.val(Plus2PropSurplusDeficit);
				
				
				//IM//=IG16
				Plus3PropSurplusDeficit				= Math.round(BCC2IfsurplusDeficit) 
				ObjPlus3PropSurplusDeficit        	= FnTrObj.find("[rel='Plus3PropSurplusDeficit']");
				ObjPlus3PropSurplusDeficit.val(Plus3PropSurplusDeficit);
				
				
				//IN//
				NoToPurchase						= 0; 
				ObjNoToPurchase        				= FnTrObj.find("[rel='NoToPurchase']");
				ObjNoToPurchase.val(NoToPurchase);
				
				//IO//=IF(PurchaseDecisionCalc!HL16<0,"Can't Afford","")
				
				if (parseFloat(CurSurplusDeficit) < 0) {
					AffordChecker					= "Can't Afford"
				}else{
					AffordChecker					= ""
				}
				
				ObjAffordChecker        			= FnTrObj.find("[rel='AffordChecker']");
				ObjAffordChecker.val(AffordChecker);
				
				//IO//=IF(PurchaseDecisionCalc!HS16>0,"Yes","")
					
				if (parseFloat(IfSurplusDeficit) > 0) {
					Qualify							= "Yes"
				}else{
					Qualify							= ""
				}
				ObjQualify        					= FnTrObj.find("[rel='Qualify']");
				ObjQualify.val(Qualify);
				
				
				//NonDeductibleLoanBal	VLOOKUP($B5,PurchaseDecisionCalc!$FZ$5:$GT$436,3)	VLOOKUP(YearPDTStart,NonDeductibleWithdrawDrawdones)
				//=VLOOKUP($B5,$EW$5:$GA$436,31)
				
				NonDeductibleLoanBal			= FrstClosingBal;
				ObjNonDeductibleLoanBal			= FnTrObj.find("[rel='NonDeductibleLoanBal']");
				ObjNonDeductibleLoanBal.val(NonDeductibleLoanBal);


				//TaxDeductibleLoanBal	VLOOKUP($B5,PurchaseDecisionCalc!$FZ$5:$GW$436,17)	VLOOKUP(YearPDTStart,ClosingBal)
				//=VLOOKUP($B5,$EW$5:$GA$436,23)
				TaxDeductibleLoanBal			= FrstMlcClosingBal;
				ObjTaxDeductibleLoanBal			= FnTrObj.find("[rel='TaxDeductibleLoanBal']");
				ObjTaxDeductibleLoanBal.val(TaxDeductibleLoanBal);


				ObjNoOfInvestPropertyOwned 	= 	FnTrObj.find("[rel='NoOfInvestPropertyOwned']");
				
				
				// Reporting Mortage Start
				//Traditional Strategy  // =TotalTradLoans!T3 Values Comes from  TotalTradLoans File
					
				TraditionalStrategy					= 404769     //  Valhardcore
				ObjTraditionalStrategy      		= FnTrObj.find("[rel='TraditionalStrategy']");
				ObjTraditionalStrategy.val(TraditionalStrategy);
				
				
				//Non Deductible Balance //  //=VLOOKUP($A3,PurchaseDecisionCalc!$FV$5:$GC$436,17)

				NonDeductibleBalance				= parseFloat(TotalTaxDedInt)     //  Valhardcore
				ObjNonDeductibleBalance     		= FnTrObj.find("[rel='NonDeductibleBalance']");
				ObjNonDeductibleBalance.val(NonDeductibleBalance);
				
		
				//Tax Deductible Balance //  //==VLOOKUP($A3,PurchaseDecisionCalc!$GB$5:$GV$436,30)
				
				var TaxDeductibleBalance 			= 0
				
				ObjTaxDeductibleBalance    		= FnTrObj.find("[rel='TaxDeductibleBalance']");
				ObjTaxDeductibleBalance.val(TaxDeductibleBalance);
				
				
				//Total Debt Balance // `=C3+D3

				TotalDebtBalance					= parseFloat(NonDeductibleBalance) +  parseFloat(TaxDeductibleBalance)   
				ObjTotalDebtBalance    		= FnTrObj.find("[rel='TotalDebtBalance']");
				ObjTotalDebtBalance.val(TotalDebtBalance);
				

				//Projected Yearly Advantage//=B3-C3
					
				ProjectedYearlyAdvantage			= parseFloat(TraditionalStrategy) -  parseFloat(NonDeductibleBalance)   
				ObjProjectedYearlyAdvantage    		= FnTrObj.find("[rel='ProjectedYearlyAdvantage']");
				ObjProjectedYearlyAdvantage.val(ProjectedYearlyAdvantage);

						
				
				//Traditional Strategy//=TotalTradLoans!K2
					
				EYITraditionalStrategy				= 18804 // Valhardcore
				ObjEYITraditionalStrategy   		= FnTrObj.find("[rel='EYITraditionalStrategy']");
				ObjEYITraditionalStrategy.val(EYITraditionalStrategy);

						
				//Suggested Strategy//=SUMIFS(PurchaseDecisionCalc!GF5:GF436,PurchaseDecisionCalc!$EX$5:$EX$436,A3)
		
				SuggestedStrategy					= parseFloat(SuggestedStrategy) + parseFloat(SuggestedStrategy)
				ObjSuggestedStrategy  				= FnTrObj.find("[rel='SuggestedStrategy']");
				ObjSuggestedStrategy.val(SuggestedStrategy);
			
				
				// Reporting Mortage Ended
				
				//	// Reporting Asset Accum Start
				
				//	// Reporting Asset Accum Ended
				
				
				
				/// ASSEMENT CALC started
				
				//op bal //=CurrentInvestmentAssets  ==> Value comes from query
				
				CurrentInvestmentAssets				=	AACclbal   
				ObjAACopbal     					= FnTrObj.find("[rel='AACopbal']");
				ObjAACopbal.val(CurrentInvestmentAssets);
				
				//additions //=PurchaseDecisionCalc!G5*Client1KiwisaverRate+PurchaseDecisionCalc!H5*Client2KiwisaverRate
				//					Salary1,                   Salary2
				//Client1KiwisaverRate				=	4
				//Client2KiwisaverRate				=	4
				
				
				additions							= ( parseFloat(Salary1) *  (parseFloat(Client1KiwisaverRate) / 100)  ) +  ( parseFloat(Salary2) * (parseFloat(Client2KiwisaverRate) / 100 ) )
				
				//console.log('Salary1='+parseFloat(Salary1) * parseFloat(Client1KiwisaverRate) / 100 );
				//console.log('Salary2='+ parseFloat(Salary2) * (parseFloat(Client2KiwisaverRate) / 100 ) );			
				//console.log('Client1KiwisaverRate='+ parseFloat(Client1KiwisaverRate) / 100);				
				//console.log('Client2KiwisaverRate='+parseFloat(Client2KiwisaverRate) / 100);

				Objadditions    					= FnTrObj.find("[rel='additions']");
				Objadditions.val(Math.round(additions));
				
				//growth //=(B3+C3)*InvestmentGrowthRate B3== >  CurrentInvestmentAssets  C3 ==> additions
				
				//console.log('CurrentInvestmentAssets='+CurrentInvestmentAssets);
				//console.log('additions='+additions);			
				//console.log('InvestmentGrowthRate='+ parseFloat(InvestmentGrowthRate) / 100);				
				//console.log('Client2KiwisaverRate='+parseFloat(Client2KiwisaverRate) / 100);

				growth								= ( parseFloat(CurrentInvestmentAssets) + parseFloat(additions) ) * parseFloat(InvestmentGrowthRate) / 100
				Objgrowth    						= FnTrObj.find("[rel='growth']");
				Objgrowth.val(Math.round(growth));


				//cl bal //=SUM(B4:D4)

				AACclbal							=  parseFloat(CurrentInvestmentAssets) + parseFloat(additions) + parseFloat(growth) 
				ObjAACclbal    						= FnTrObj.find("[rel='AACclbal']");
				ObjAACclbal.val(Math.round(AACclbal));


				//house value //=F3+(F3*InvestmentGrowthRate) F3 = > Oth Value
				houseValue							=  parseFloat(houseValue) + ( parseFloat(houseValue) *  (parseFloat(InvestmentGrowthRate) / 100) )
				ObjhouseValue   					= FnTrObj.find("[rel='houseValue']");
				ObjhouseValue.val(Math.round(houseValue));

				
				//total prop value//=PurchaseDecisionCalc!T17*PurchaseDecisionCalc!IR17

				totalpropvalue						=  parseFloat(Assumptions_F3) * parseFloat(NoOfInvestPropertyOwned) 
				Objtotalpropvalue   				= FnTrObj.find("[rel='totalpropvalue']");
				Objtotalpropvalue.val(Math.round(totalpropvalue));
				
				
				//add kiwisaver//=H4+E4
				
				addkiwisaver						=  parseFloat(totalpropvalue) + parseFloat(AACclbal) 
				Objaddkiwisaver  					= FnTrObj.find("[rel='addkiwisaver']");
				Objaddkiwisaver.val(Math.round(addkiwisaver));
				
				
				/// ASSEMENT CALC Ended
				
				
				//Net Worth Calc Started
				
				
				//Total Lifestyle Assets 
					
				TotalLifestyleAssets				=  parseFloat(houseValue) 
				ObjTotalLifestyleAssets 			= FnTrObj.find("[rel='TotalLifestyleAssets']");
				ObjTotalLifestyleAssets.val(Math.round(TotalLifestyleAssets));
				
				
					//Net Worth Calc//Total Investment Assets //=AssetAccumCalc!I4
					
				TotalInvestmentAssets				=  parseFloat(addkiwisaver) 
				ObjTotalInvestmentAssets 			= FnTrObj.find("[rel='TotalInvestmentAssets']");
				ObjTotalInvestmentAssets.val(Math.round(TotalInvestmentAssets));
				
				
				
				
				//Net Worth Calc//Total Investment Assets //=B4+C4 ( Total Lifestyle Assets  + Total Investment Assets)
					
				TotalAssets							=  parseFloat(TotalLifestyleAssets) +  parseFloat(TotalInvestmentAssets) 
				ObjTotalAssets 						= FnTrObj.find("[rel='TotalAssets']");
				ObjTotalAssets.val(Math.round(TotalAssets));
				
				
				//Total Liabilities//=PurchaseDecisionCalc!HK17
				
					
				TotalLiabilities					=  parseFloat(CurTotalDebt) 
				ObjTotalLiabilities					= FnTrObj.find("[rel='TotalLiabilities']");
				ObjTotalLiabilities.val(Math.round(TotalLiabilities));
				
				//Net Worth//=D3-E3
								
				NetWorth							=  parseFloat(TotalAssets)  - parseFloat(TotalLiabilities) 
				ObjNetWorth							= FnTrObj.find("[rel='NetWorth']");
				ObjNetWorth.val(Math.round(NetWorth));
				
		
				//Income perannum (Active)//=PurchaseDecisionCalc!I17
					
				IncomeperannumActive				=  parseFloat(TotSalary) 
				ObjIncomeperannumActive				= FnTrObj.find("[rel='IncomeperannumActive']");
				ObjIncomeperannumActive.val(Math.round(IncomeperannumActive));
				
				//Income per annum (Passive)//=PurchaseDecisionCalc!AI17+PurchaseDecisionCalc!AH17
					
				IncomeperannumPassive				=  parseFloat(IecRentalIncome) + parseFloat(CurInvPropInc)
				ObjIncomeperannumPassive			= FnTrObj.find("[rel='IncomeperannumPassive']");
				ObjIncomeperannumPassive.val(Math.round(IncomeperannumPassive));
				
				//Annual Cash Increase (Decrease)//=PurchaseDecisionCalc!HF17
					
				AnnualCashIncreaseDecrease			=  parseFloat(CashProfitLoss) 
				ObjAnnualCashIncreaseDecrease		= FnTrObj.find("[rel='AnnualCashIncreaseDecrease']");
				ObjAnnualCashIncreaseDecrease.val(Math.round(AnnualCashIncreaseDecrease));
				
				//=PurchaseDecisionCalc!IQ17*PurchaseDecisionCalc!T17+J2 t17 ==>Purchase Value
				
				PropertiesCost						=  parseFloat(PurchasePropertyQualify) * (parseFloat(Assumptions_F3) +  parseFloat(PropertiesCost))
				ObjPropertiesCost					= FnTrObj.find("[rel='PropertiesCost']");
				ObjPropertiesCost.val(Math.round(PropertiesCost));
				
				
				//Cap Gain//=AssetAccumCalc!H4-J3
						
				CapGain								=  parseFloat(totalpropvalue) - parseFloat(PropertiesCost) 
				ObjCapGain					= FnTrObj.find("[rel='CapGain']");
				ObjCapGain.val(Math.round(CapGain));
				
				//Net Worth Calc Ended
				
				
				// Reporting Asset Accum Start
				
				//Asset value//=AssetAccumCalc!E3
				
				CSAssetvalue						=  parseFloat(AACclbal)
				ObjCSAssetvalue						= FnTrObj.find("[rel='CSAssetvalue']");
				ObjCSAssetvalue.val(Math.round(CSAssetvalue));
					
				//CS Debt//=TotalTradLoans!T2
				CSDebt								=  412658 // Valhardcore
				ObjCSDebt							= FnTrObj.find("[rel='CSDebt']");
				ObjCSDebt.val(Math.round(CSDebt));

				//Net Position//=B4-C4	
				
				CSNetPosition						=  parseFloat(CSAssetvalue) - parseFloat(CSDebt) 
				ObjCSNetPosition					= FnTrObj.find("[rel='CSNetPosition']");
				ObjCSNetPosition.val(Math.round(CSNetPosition));
					

					
				
				//No. of Props //=PurchaseDecisionCalc!IR17+CurNoInvProps
				CurNoInvProps						=	0				
				NoofProps							=  parseFloat(NoOfInvestPropertyOwned) + parseFloat(CurNoInvProps) 
				ObjNoofProps						= FnTrObj.find("[rel='NoofProps']");
				ObjNoofProps.val(Math.round(NoofProps));
				
				
				//SS Asset value //=AssetAccumCalc!I4		
				SSAssetvalue						=  parseFloat(addkiwisaver) 
				ObjSSAssetvalue						= FnTrObj.find("[rel='SSAssetvalue']");
				ObjSSAssetvalue.val(Math.round(SSAssetvalue));
				
				//SS//Debt//=PurchaseDecisionCalc!HK5
				
				SSDebt								=  parseFloat(CurTotalDebt) 
				ObjSSDebt							= FnTrObj.find("[rel='SSDebt']");
				ObjSSDebt.val(Math.round(SSDebt));
				
				
					
				//SS//Debt//=F4-G4
				
				SSNetPosition						=  parseFloat(SSAssetvalue) - parseFloat(SSDebt)
				ObjSSNetPosition					= FnTrObj.find("[rel='SSNetPosition']");
				ObjSSNetPosition.val(Math.round(SSNetPosition));
				
				
				//	// Reporting Asset Accum Ended
				/*
					RAAEndofYear	
					RAACSAssetvalue	
					RAACSDebt
					RAACSNetPosition
					RAANoofProps
					RAASSAssetvalue
					RAASSDebt
					RAASSNetPosition
				
				*/
				
			// NEw FEILDS END
				
				
				
				
				
				
				
				
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