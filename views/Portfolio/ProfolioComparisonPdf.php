<?php

   $id                  = \settings\session\sessionClass::GetSessionDisplayName();
   $MultiPropertyVal    = $_REQUEST["PropertyCnt"] ? $_REQUEST["PropertyCnt"] : "";
   $ViewCompare         = $_REQUEST["ViewCompare"] ? $_REQUEST["ViewCompare"] : "";
   

 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DU VAL SERVICES</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL; ?>assets/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL; ?>assets/css/style.css">
  <style>
    input[sub_total='true'],input[mortgage_total='true'], input[readonly]{
    background:#ebf6ea; 
    }
    
    body {
      background: rgb(204,204,204);
      font-size: 14px; 
    }
    
    header .navbar{
    	padding: 10px 0px;
    }
    .section-heading{
    	margin-bottom: 30px;
    }
    .section-heading hr {
        margin-top: 0;
        border-top: 2px solid #D5DBDB;
    }
    
    header .navbar-light .navbar-nav .nav-link {
        color: rgb(0,0,0);
        font-weight: 700;
        font-size: 18px;
        text-align: right;
    }
    header .navbar-light .navbar-nav .nav-link small{
    	color: rgba(0,0,0,.5);
    	font-weight: 500;
    }
    
    label, .col-form-label{
    	font-weight: 400;
    	text-transform: capitalize;
    	font-size: 14px;
    }
    .box{
    	font-size: 18px;
    	line-height: 30px;
    	font-weight: 700;
    	color: #fff;
    	padding: 25px 10px;
    	border-radius: 10px;
    }
    
    
    .table-wrapper table > tbody > tr > td + td, .table-wrapper table > thead > tr > th + th{
      text-align: right;
    }
    .center-table .table td, .center-table .table th{
    	text-align: center;
    }
    .center-table .table th, .center-table .table > thead > tr > td{
    	border: 0;
    }
    
    tr td:first-child,
    tr td:last-child {
        /* styles */
    }
    .table td, .table th{
    	font-size: 14px;
    }
    .letter-input{
    	width: 100%;
        border-width: 0px 0px 1px 0px;
        border-style: dashed;
        margin-bottom: 0px;
    }
    .letter-label{
    	line-height: 14px;
    }
    
    .invoice{
    	width: 100%;
    	border-width: 0px 0px 1px 0px;
    	border-radius: 0px;
    	margin-bottom: 0px;
    }
    
    .initial-box{
    	padding: 25px;
    	border: 1px solid #000;
    }
    
    .roadmap-list .list-group-item{
    	background-color: transparent;
    	font-size: 22px;
    	border: none;
    	color: #000;
    	font-weight: 700;
    }
    
    .roadmap-list .list-group-item small{
    	font-size: 12px;
    }
    form h5, .heading-secondary{
    	font-size: 16px;
    	font-weight: 500;
    	margin: 15px 0px 30px 0px;
    }
    .section-heading h4 {
        line-height: 32px;
        font-size: 22px;
    }
    .float-button {
    position: fixed;
    right: -45px;
    top: 48%;
    /* transition: all 0.2s ease-in 0s; */
    z-index: 9999;
    cursor: pointer;
    transform: rotate(-90deg);
    }
    .btn-float{
    	background-color: #f15a5d;
    	border: 1px solid #f15a5d;
    	border-radius: 0;
    	color: #fff;
    	letter-spacing: 2px;
    }
    .btn-float:hover{
    	background-color: #4842E5;
    	border: 1px solid #4842E5;
    	color: #fff;
    }
    @media only screen and (max-width: 660px) {
    	.float-button {
        position: fixed;
        right: 0px;
        bottom: 0px;
        transform: rotate(0deg);
        top: unset;
        width: 100%;
        z-index: 1;
      }
      .btn-float{
        width: 100%;
        display: block;
      }
    }
    
    </style>
</head>
<body>
    <header>
      <div class="container">
        <nav class="navbar navbar-light" style='background-color:black' >
          <a class="navbar-brand" href="#"><img src="<?php echo SITE_BASE_URL; ?>assets/img/prop-tech-logo.png" class="img-fluid" width="150px"></a>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" style='color:white'  href="#">INVESTMENT <br><small>COMPARISONS</small></a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
  <!-- start section -->
  <div class="main mt-5">
      <section>
        <div class="container">
            <div class="row"  >
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Investment  Comparisons</h4>
                        <div class="">
                          <table class="table table-bordered table-striped mb-0">
                              
                              <?php
                              
                                echo $id;
                                //echo $MultiPropertyVal;
                                
                           
                                 $TempArr = array();
                                 \Property\PropertyClass::Init();
                                    
                                $PropertyComparison = \Property\PropertyClass::GetPropertyComparison("","",$MultiPropertyVal,"",$ViewCompare,"Y");
                                 
                              
                                
                                $J = 1;
                                foreach($PropertyComparison as $PropCmp){
                                      $autoid                                   = $PropCmp["autoid"]           ? $PropCmp["autoid"] : "" ;
                                      $TempArr["UNIT_NO_".$J]                   = $PropCmp["UNIT_NO"]           ? $PropCmp["UNIT_NO"] : "" ;
                                      $TempArr["property_name_".$J]             = $PropCmp["property_name"]     ? $PropCmp["property_name"] : "" ;
                                      $TempArr["location_name_".$J]             = $PropCmp["location_name"]     ? $PropCmp["location_name"] : "" ;
                                      $TempArr["country_name_".$J]              = $PropCmp["country_name"]      ? $PropCmp["country_name"] : "" ;
                                      $TempArr["country_id_".$J]                = $PropCmp["country_id"]        ? $PropCmp["country_id"] : "" ;
                                      $currtemp                                 = $PropCmp["baseCur"]           ? $PropCmp["baseCur"] : "" ;
                                      $TempArr["baseCur_".$J]                   = $currtemp;
                                      $duvaldynamicprice                        = $PropCmp["duvaldynamicprice"] ? $PropCmp["duvaldynamicprice"] : "0" ;
                                      $TempArr["duvaldynamicprice_".$J]         = $duvaldynamicprice;
                                      $TempArr["PropertyList_".$J]              = $J;
                                      
                                      $stampdutyTemp                            = $PropCmp["stampduty"] ? $PropCmp["stampduty"] : "0" ;
                                      $mortgageregistrationTemp                 = $PropCmp["mortgageregistration"] ? $PropCmp["mortgageregistration"] : "0" ;
                                      $transferfeesTemp                         = $PropCmp["transferfees"] ? $PropCmp["transferfees"] : "0" ;
                                     
                                      
                                      $UsdExRate = "";
                                      $UsdExRateArr =  \Property\PropertyClass::GetCurrExrate("USD",$currtemp);
                                      foreach($UsdExRateArr as $UsdEx){
                                          $UsdExRate = $UsdEx["RATE"] ? $UsdEx["RATE"] :"1";
                                      }
                                      
                                     // echo 'UsdExRate='. $UsdExRate ."<br>";
                                      
                                      
                                      
                                      
                                      if ($UsdExRate == "")
                                        $UsdExRate = 1;
                                        
                                        $TempArr["ExchangeRate_".$J]              = $UsdExRate;
                                        
                                        
                                        
                                       // echo 'UsdExRate='.$UsdExRate.'<br>';
                                        
                                        \ajax\ajaxClass::Init();
                                       $Prop  =  \ajax\ajaxClass::AnalyzerResult($autoid,"ARRAY");
                                       
                                       
                                       //echo "<pre>"; print_r($Prop); echo "</pre>";
        
                                      
                                      if ( $PropCmp["country_id"] == "2"){
                                          
                                          $TempArr["PurhcasePrice_".$J]             = round(floatval(round($duvaldynamicprice,0)) / floatval($UsdExRate),0);
                                          $TempArr["stampduty_".$J]                 = round(floatval($stampdutyTemp) / floatval($UsdExRate),0);
                                          $TempArr["mortgageregistration_".$J]      = round(floatval($mortgageregistrationTemp) / floatval($UsdExRate),0);
                                          $TempArr["transferfees_".$J]              = round(floatval($transferfeesTemp) / floatval($UsdExRate),0);
                                          $TempArr["TotalCashRequirement_".$J]      = round(floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate),0);
                                          
                                          
                                          
                                      }elseif ( $PropCmp["country_id"] == "1"){
                                          $TempArr["PurhcasePrice_".$J]            = round(floatval(round($duvaldynamicprice,0)) / floatval($UsdExRate),0);
                                          $TempArr["stampduty_".$J]                = round(floatval($stampdutyTemp),0) ;
                                          $TempArr["mortgageregistration_".$J]     = 0;
                                          $TempArr["transferfees_".$J]             = round(floatval($transferfeesTemp) / floatval($UsdExRate),0);
                                          $TempArr["TotalCashRequirement_".$J]     = round(floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate),0);
                                          
                                      }elseif ($PropCmp["country_id"] == "3"){
                                        
                                         $TempArr["PurhcasePrice_".$J]              = round(floatval(round($duvaldynamicprice,0)) / floatval($UsdExRate),0);
                                          $TempArr["stampduty_".$J]                 = round(floatval($stampdutyTemp) / floatval($UsdExRate),0);
                                          $TempArr["mortgageregistration_".$J]      = round(floatval($mortgageregistrationTemp) / floatval($UsdExRate),0);
                                          $TempArr["transferfees_".$J]              = 0;
                                          $TempArr["TotalCashRequirement_".$J]      = round(floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate),0);
                                     }else{
                                         
                                           $TempArr["PurhcasePrice_".$J]            = 0;
                                           $TempArr["stampduty_".$J]                = 0;
                                           $TempArr["mortgageregistration_".$J]     = 0;
                                           $TempArr["transferfees_".$J]             = 0;
                                           $TempArr["TotalCashRequirement_".$J]     = 0;
                                     }
                                      
        
                                        
                                        
                                        $TempArr["cpi_".$J]                         =  $PropCmp["cpi"] ? $PropCmp["cpi"] : "0" ;
                                        $TempArr["rentalgrowth_".$J]                =  $PropCmp["rentalgrowth"] ? $PropCmp["rentalgrowth"] : "0" ;
                                        $TempArr["capitalgrowth_".$J]               =  $PropCmp["capitalgrowth"] ? $PropCmp["capitalgrowth"] : "0" ;
                                         
                                        $TempArr["IRR_".$J]                         =  $Prop[0]["IRR"];
                                        $TempArr["IRRAfterTax_".$J]                 =  $Prop[0]["IRRAfterTax"];
                                        
                                         //echo 'Irr='. $Prop[0]["IRR"] .'<br>';   
                                        
                                        $TempArr["NetCashFlowAfterTax_".$J]          =   round($Prop[1]["NetCashFlowAfterTax"],0).",".round($Prop[2]["NetCashFlowAfterTax"],0).",".round($Prop[3]["NetCashFlowAfterTax"],0).","
                                                                                            .round($Prop[4]["NetCashFlowAfterTax"],0).",".round($Prop[5]["NetCashFlowAfterTax"],0).",".round($Prop[6]["NetCashFlowAfterTax"],0).",".round($Prop[7]["NetCashFlowAfterTax"],0)
                                                                                            .",".round($Prop[8]["NetCashFlowAfterTax"],0).",".round($Prop[9]["NetCashFlowAfterTax"],0).",".round($Prop[10]["NetCashFlowAfterTax"],0);
              
                                                                                            
                                                                                            
                                        $TempArr["TotalAnnualReturnAfterTax_".$J]           =   round($Prop[1]["TotalAnnualReturnAfterTax"],0).",".round($Prop[2]["TotalAnnualReturnAfterTax"],0).",".round($Prop[3]["TotalAnnualReturnAfterTax"],0).","
                                                                                            .round($Prop[4]["TotalAnnualReturnAfterTax"],0).",".round($Prop[5]["TotalAnnualReturnAfterTax"],0).",".round($Prop[6]["TotalAnnualReturnAfterTax"],0).",".round($Prop[7]["TotalAnnualReturnAfterTax"],0)
                                                                                            .",".round($Prop[8]["TotalAnnualReturnAfterTax"],0).",".round($Prop[9]["TotalAnnualReturnAfterTax"],0).",".round($Prop[10]["TotalAnnualReturnAfterTax"],0);
                                       
                                        $TempArr["Equity_".$J]                              =   round($Prop[1]["Equity"],0).",".round($Prop[2]["Equity"],0).",".round($Prop[3]["Equity"],0).",".round($Prop[4]["Equity"],0).",".round($Prop[5]["Equity"],0).",".round($Prop[6]["Equity"],0).
                                                                                                ",".round($Prop[7]["Equity"],0).",".round($Prop[8]["Equity"],0).",".round($Prop[9]["Equity"],0).",".round($Prop[10]["Equity"],0);
                                       
                                        
              
        
                         
                                      
                                      
                                      $J++;
                                }
                                
                              
                              
                                $IndexQry = "select 
                                            '' as Headers,
                                            'Property List' as columns ,
                                            'PropertyList_' as feildname,
                                            'Text' as datatype
                                            from dual
                                            union all
                                            select 
                                            'Address' as Headers,
                                            '' as columns ,
                                            '' as feildname,
                                            'Text' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'Unit No' as columns ,
                                            'UNIT_NO_' as feildname,
                                            'Text' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'Property' as columns ,
                                            'property_name_' as feildname,
                                            'Text' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'City' as columns  ,
                                            'location_name_' as feildname,
                                            'Text' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'State/County' as columns ,
                                            'country_name_' as feildname,
                                            'Text' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'Country' as columns ,
                                            'country_name_' as feildname,
                                            'Text' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'Exchange Rate (USD)' as columns ,
                                            'ExchangeRate_' as feildname,
                                            'Text' as datatype
                                            from dual
                                            union all
                                            select 
                                            'Purchase Information' as Headers,
                                            '' as columns ,
                                            '' as feildname,
                                            'Text' as datatype
                                            from dual
                                             union all
                                            select 
                                            '' as Headers,
                                            'Purhcase Price' as columns ,
                                            'PurhcasePrice_' as feildname,
                                            'No' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'Stamp Duty' as columns ,
                                            'stampduty_' as feildname,
                                            'No' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'Mortgage/Lease Registration' as columns ,
                                            'mortgageregistration_' as feildname,
                                            'No' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'Transfer Fees' as columns ,
                                            'transferfees_' as feildname,
                                            'No' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'Total Cash Requirement' as columns ,
                                            'TotalCashRequirement_' as feildname,
                                            'No' as datatype
                                            from dual
                                            union all
                                            select 
                                            'Growth' as Headers,
                                            '' as columns ,
                                            '' as feildname,
                                            'No' as datatype
                                            from dual
                                             union all
                                            select 
                                            '' as Headers,
                                            'CPI' as columns ,
                                            'cpi_' as feildname,
                                            'No' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'Rental Growth' as columns ,
                                            'rentalgrowth_' as feildname,
                                            'No' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'Capital Growth' as columns ,
                                            'capitalgrowth_' as feildname,
                                            'No' as datatype
                                            from dual
                                            union all
                                            select 
                                            'IRR' as Headers,
                                            '' as columns ,
                                            '' as feildname,
                                            'No' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'IRR' as columns ,
                                            'IRR_' as feildname,
                                            'Text' as datatype
                                            from dual
                                            union all
                                            select 
                                            '' as Headers,
                                            'IRR (after tax)' as columns ,
                                            'IRRAfterTax_' as feildname,
                                            'No' as datatype
                                            from dual";
             
                              
        
        
                                $Rows = \DBConn\DBConnection::getQuery( $IndexQry );
                                
                                foreach($Rows as $Row){
                                    
                                    
                                    if ( $Row["Headers"] !="" ){
                                        
                                    ?>
                                        <tr class="bg-dark">
                                          <th colspan="6"><?php echo  $Row["Headers"]; ?></th>
                                        </tr>
                                    <?php
                                        
                                    }else{
                                    ?>
                                         <tr>
                                          <td><?php echo $Row["columns"]; ?></td>
                                          <?php
                                               $feildname = $Row["feildname"]; 
                                               $datatype = $Row["datatype"]; 
                                               for($k=1; $k < $J; $k++){
                                                   
                                                    if ( $datatype == "No"){
                                                        
                                                    ?>  
                                                        <td><?php echo number_format($TempArr[$feildname.$k]); ?></td>
                                                    <?php
                                                    }else{
                                                    
                                                    ?>
                                                        <td><?php echo $TempArr[$feildname.$k]; ?></td>
                                                    <?php
                                                    }     
                                          ?>
                                                
                                          <?php
                                                }
                                          ?>
                                        </tr>
                                    
                                    <?php
                                    }
                                    
                                }
                             
                              
                                       for($m=1; $m < $J; $m++){
                                                           
                                                           
                                        ?>
                                            <input type='hidden' name='NetCashFlowAfterTaxGraph_<?php echo $m; ?>' id='NetCashFlowAfterTaxGraph_<?php echo $m; ?>' value='<?php echo $TempArr["NetCashFlowAfterTax_".$m];  ?>' >
                                            <input type='hidden' name='TotalAnnualReturnAfterTaxGraph_<?php echo $m; ?>' id='TotalAnnualReturnAfterTaxGraph_<?php echo $m; ?>' value='<?php echo $TempArr["TotalAnnualReturnAfterTax_".$m];  ?>' >
                                            <input type='hidden' name='EquityGraph_<?php echo $m; ?>' id='EquityGraph_<?php echo $m; ?>' value='<?php echo $TempArr["Equity_".$m];  ?>' >
                                            
                                         <?php
                                        }
                                           
                                             
                            ?>
                                    <input type='hidden' name='TotalCount' id='TotalCount' value='<?php echo $m-1;  ?>' >
                                    
                          </table>
                        </div>
                      </div>
                    </div>
                    
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Annual Cashflow</h4>
                        <canvas class="" id="annualCashFlow"></canvas>
                      </div>
                    </div>
                    
                    
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Total Annual Reuturn(After Tax)</h4>
                        <canvas class="" id="annualReturn"></canvas>
                      </div>
                    </div>
                    
                    
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Estimate Equity</h4>
                        <canvas class="" id="estimateEquity"></canvas>
                      </div>
                    </div>
              </div>
          </div>
        </div>
      </section>
    </div>
  
    <div class="float-button">
    	 <button type="button" class="btn btn-float" id="save_pdf">SAVE PDF</button>
    </div>

</body> 
</html>

<script src="<?php echo SITE_BASE_URL; ?>assets/plugins/common/common.min.js"></script>
 <!-- Timeline Chart Resources Arzath - 2020-02-02 -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!-- jqplot chart -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/jquery.jqplot.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/plugins/jqplot.mekkoRenderer.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/plugins/jqplot.mekkoAxisRenderer.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/plugins/jqplot.canvasTextRenderer.min.js"></script>

<script type="text/javascript">
 
 $(document).ready(function(){
     $(document).on("click", "#save_pdf", function(){
         SavePdfFn(); 
     }); 
 });
 
 function SavePdfFn(){
     window.location.href = "<?php echo SITE_BASE_URL . "Portfolio/PortfolioPdfLocation.html"; ?>"; //save_pdf 
 }

</script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
<!-- apexchart -->
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/js/apexcharts.min.js"></script>
  <!-- owl crousal -->
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/owl-crousal/js/owl.carousel.min.js"></script>
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/chartjs/Chart.bundle.js"></script>
<script type="text/javascript">
   //Annual Cash Flow
   var ctx = document.getElementById("annualCashFlow");
   
   var TotalCount =  document.getElementById("TotalCount").value; 
   
   
    for( i=1; i <= parseFloat(TotalCount); i++){
                   
        NetCashFlowAfterTaxGraph        = $("#NetCashFlowAfterTaxGraph_"+i).val();
        TotalAnnualReturnAfterTaxGraph  = $("#TotalAnnualReturnAfterTaxGraph_"+i).val();
        TotalEquityGraphGraph           = $("#EquityGraph_"+i).val();
        
       
       // alert(NetCashFlowAfterTaxGraph);
           if (parseFloat(i)==1){
               
                
               PropertySting= '{ label: "Property A", data: ['+NetCashFlowAfterTaxGraph+'],backgroundColor: "rgba(138,155,240,0.0)", borderWidth: 2, borderColor: "#8a9bf0", pointRadius: 0, }';
               TotalAnnualReturnAfterTaxGraphSring = '{ label: "Property A", data: ['+TotalAnnualReturnAfterTaxGraph+'],backgroundColor: "rgba(138,155,240,0.0)", borderWidth: 2, borderColor: "#8a9bf0", pointRadius: 0, }';
               TotalestimateEquity =  '{ label: "Property A", data: ['+TotalEquityGraphGraph+'],backgroundColor: "rgba(138,155,240,1)", borderWidth: 2, borderColor: "#8a9bf0", pointRadius: 0, }';
               
           }else if(parseFloat(i)==2){
               
               //PropertySting  = PropertySting + ", { label: 'Property B', data: ["+NetCashFlowAfterTaxGraph+"],backgroundColor: 'rgba(240,165,91,0.0)', borderWidth: 2, borderColor: '#F0A55B', pointRadius: 0, }"
                PropertySting    = PropertySting + ', { label: "Property B", data: ['+NetCashFlowAfterTaxGraph+'],backgroundColor: "rgba(240,165,91,0.0)", borderWidth: 2, borderColor: "#F0A55B", pointRadius: 0, }';
                TotalAnnualReturnAfterTaxGraphSring = TotalAnnualReturnAfterTaxGraphSring +' , { label: "Property B", data: ['+TotalAnnualReturnAfterTaxGraph+'],backgroundColor: "rgba(240,165,91,0.0)", borderWidth: 2, borderColor: "#F0A55B", pointRadius: 0, }';
                TotalestimateEquity = TotalestimateEquity +' , { label: "Property B", data: ['+TotalEquityGraphGraph+'],backgroundColor: "rgba(240,165,91,1)", borderWidth: 2, borderColor: "#F0A55B", pointRadius: 0, }';
             
           }else if(parseFloat(i)==3){
               
               //PropertySting = PropertySting + ", { label: 'Property C', data: ["+NetCashFlowAfterTaxGraph+"],backgroundColor: 'rgba(43,212,54,0.0)', borderWidth: 2, borderColor: '#2AD436', pointRadius: 0, }"
                PropertySting    = PropertySting + ', { label: "Property C", data: ['+NetCashFlowAfterTaxGraph+'],backgroundColor: "rgba(43,212,54,0.0)", borderWidth: 2, borderColor: "#2AD436", pointRadius: 0, }';
                TotalAnnualReturnAfterTaxGraphSring = TotalAnnualReturnAfterTaxGraphSring +' , { label: "Property C", data: ['+TotalAnnualReturnAfterTaxGraph+'],backgroundColor: "rgba(43,212,54,0.0)", borderWidth: 2, borderColor: "#2AD436", pointRadius: 0, }';
                TotalestimateEquity = TotalestimateEquity +' , { label: "Property C", data: ['+TotalEquityGraphGraph+'],backgroundColor: "rgba(43,212,54,1, 46, 38, 60)", borderWidth: 2, borderColor: "#2AD436", pointRadius: 0, }';
              
           }else{
              // PropertySting = PropertySting + ", { label: 'Property D', data: ["+NetCashFlowAfterTaxGraph+"],backgroundColor: 'rgba(138,155,240,0.0)', borderWidth: 2, borderColor: '#8a9bf0', pointRadius: 0, }"
                PropertySting = PropertySting + ', { label: "Property D", data: ['+NetCashFlowAfterTaxGraph+'],backgroundColor: "rgba(138,155,240,0.0)", borderWidth: 2, borderColor: "#8a9bf0", pointRadius: 0, }';
                TotalAnnualReturnAfterTaxGraphSring = TotalAnnualReturnAfterTaxGraphSring +' , { label: "Property D", data: ['+TotalAnnualReturnAfterTaxGraph+'],backgroundColor: "rgba(138,155,240,0.0)", borderWidth: 2, borderColor: "#8a9bf0", pointRadius: 0, }';
                TotalestimateEquity = TotalestimateEquity +' , { label: "Property D", data: ['+TotalEquityGraphGraph+'],backgroundColor: "rgba(138,155,240,1)", borderWidth: 2, borderColor: "#8a9bf0", pointRadius: 0, }';
           }
       
   }
   //console.log(PropertySting);

   ctx.height = 100;
   var myChart = new Chart(ctx, {
       type: 'line',
       data: {
           labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
           type: 'line',
   
           datasets: //
                    eval("[" + PropertySting + "]")
                    //{ label: "Property A", data: [-1228,-549,149,864,1599,2353,3126,3577,2952,3358],backgroundColor: "rgba(138,155,240,0.0)", borderWidth: 2, borderColor: "#8a9bf0", pointRadius: 0 }, { label: "Property B", data: [-1228,-549,149,864,1599,2353,3126,3535,2736,3090],backgroundColor: "rgba(240,165,91,0.0)", borderWidth: 2, borderColor: "#F0A55B", pointRadius: 0 }
                  /*  { 
                        label: "Property A", 
                        data: [-1228,-549,149,864,1599,2353,3126,3577,2952,3358],
                        backgroundColor: "rgba(138,155,240,0.0)",
                        borderWidth: 2, borderColor: "#8a9bf0", 
                        pointRadius: 0, 
                        
                    }, {
                        
                        label: "Property B", 
                        data: [-1228,-549,149,864,1599,2353,3126,3535,2736,3090],
                        backgroundColor: "rgba(240,165,91,0.0)", 
                        borderWidth: 2,
                        borderColor: "#F0A55B", 
                        pointRadius: 0, 
                        
                    }*/
               

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
                       display: false,
                       labelString: 'Month'
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
                       labelString: 'Value'
                   }
               }]
           },
           title: {
               display: false,
           }
       }
   });

   //Estimate Equity
   var ctx = document.getElementById("annualReturn");
   ctx.height = 100;
   var myChart = new Chart(ctx, {
       type: 'line',
       data: {
           labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
           type: 'line',
   
           datasets: eval("[" + TotalAnnualReturnAfterTaxGraphSring + "]")
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
                       display: false,
                       labelString: 'Month'
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
                       labelString: 'Value'
                   }
               }]
           },
           title: {
               display: false,
           }
       }
   });


   // Rental Return
   var ctx = document.getElementById("estimateEquity");
   ctx.height = 100;
   var myChart = new Chart(ctx, {
       type: 'bar',
       data: {
           labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
           type: 'line',
   
           datasets: eval("[" + TotalestimateEquity + "]")
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
                       display: false,
                       labelString: 'Month'
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
                       labelString: 'Value'
                   }
               }]
           },
           title: {
               display: false,
           }
       }
   });


    
</script>
