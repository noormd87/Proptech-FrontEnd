<?php 
include"header.php";
$user_id   = \settings\session\sessionClass::GetSessionDisplayName();
$user_id   = \settings\session\sessionClass::GetSessionDisplayName();
$currentCurrency     = $_SESSION["BaseCurrency"]        ? $_SESSION["BaseCurrency"]     : "NZD";
$MultiPropertyVal    = $_REQUEST["MultiPropertyVal"]    ? $_REQUEST["MultiPropertyVal"] : "";
$compareVal          = $_REQUEST["compareVal"]          ? $_REQUEST["compareVal"]       : "N";
$ViewCompare         = $_REQUEST["ViewCompare"]         ? $_REQUEST["ViewCompare"]      : "";
$IsSameCurr          = $_REQUEST["IsSameCurr"]          ? $_REQUEST["IsSameCurr"]       : "2";

// if($_SERVER['REQUEST_METHOD'] == "POST")
// {
//     echo "<pre>";
//     print_r($_REQUEST);
//     die();
// }Net Annual Income

// else
// {
//     echo "Deadly";
//     die();
// }
?>

<!-- apexchart -->  
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/apexcharts/css/apexcharts.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/apexcharts/css/apexcharts.min.css.map">
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/apexcharts/js/apexcharts.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/chartjs/Chart.bundle.js"></script>
<div class="inner-wrapper">
    <?php
    if ( $ViewCompare=="R" )
    {
        ?>
        <div class="row mt-4">
            <div class="col-12">
                <h1 class="hero-title-dark">Investment Comparison
                    <div class="from-group">
                        <label for="crn">Currency : (<?php echo $currentCurrency; ?>)</label>
                    </div>
                </h1>
                <div class="projects-panel">
                    <table class="table table-bordered table-striped mb-0">
                    <?php
                        $TempArr = array();
                        \Property\PropertyClass::Init();
                        $PropertyComparison = \Property\PropertyClass::GetPropertyComparison("","","","",$ViewCompare);
                        $J = 1;
                        $PrevCountryId ="";
                        $IsSameCountry = "Y";
                        foreach($PropertyComparison as $PropCmp)
                        {
                            if($_SERVER['REQUEST_METHOD'] == "POST")
                            {
                                for($i = 0; $i < sizeof($MultiPropertyVal); $i++)
                                {
                                    if($PropCmp['autoid'] == $MultiPropertyVal[$i])
                                    {
                                        $autoid                                   = $PropCmp["autoid"]           ? $PropCmp["autoid"] : "" ;
                                        $TempArr["UNIT_NO_".$J]                   = $PropCmp["UNIT_NO"]           ? $PropCmp["UNIT_NO"] : "" ;
                                        $TempArr["property_name_".$J]             = $PropCmp["property_name"]     ? $PropCmp["property_name"] : "" ;
                                        $TempArr["property_Address_".$J]          = $PropCmp["property_desc"]     ? $PropCmp["property_desc"] : "" ;
                                        $TempArr["location_name_".$J]             = $PropCmp["location_name"]     ? $PropCmp["location_name"] : "" ;
                                        $TempArr["country_name_".$J]              = $PropCmp["country_name"]      ? $PropCmp["country_name"] : "" ;
                                        $CountryId                                = $PropCmp["country_id"]        ? $PropCmp["country_id"] : "" ;
                                        $propertyid                               = $PropCmp["property_id"]        ? $PropCmp["property_id"] : "" ;
                                        $TempArr["country_id_".$J]                = $CountryId;
                                        if ( $PrevCountryId != "")
                                        {
                                            if ($PrevCountryId != $CountryId)
                                            {
                                                $IsSameCountry= "N";
                                            }
                                        }
                                        $currtemp                                 = $PropCmp["baseCur"]           ? $PropCmp["baseCur"] : "" ;
                                        $TempArr["baseCur_".$J]                   = $currtemp;
                                        $duvaldynamicprice                        = $PropCmp["duvaldynamicprice"] ? $PropCmp["duvaldynamicprice"] : "0" ;  
                                        $DelUrl = "<a href='". SITE_BASE_URL ."Property/PropertyDelete.html?id=".$propertyid ."&countryid=". $CountryId ."&autoid=". $autoid ."&IsProtFolio=Y&ViewCompare=R'>Delete</a>";
                                        if($J==1)
                                        {
                                            $propertydetails = "<b>Property A </b>".$DelUrl;
                                        }
                                        elseif($J==2)
                                        {
                                            $propertydetails  = "<b>Property B </b>".$DelUrl; 
                                        }
                                        elseif($J==3)
                                        {
                                            $propertydetails  = "<b>Property C </b>".$DelUrl; 
                                        }
                                        elseif($J==4)
                                        {
                                            $propertydetails  = "<b>Property D </b>".$DelUrl; 
                                        }
                                        elseif($J==5)
                                        {
                                            $propertydetails  = "<b>Property E </b>".$DelUrl; 
                                        }
                                        elseif($J==6)
                                        {
                                            $propertydetails  = "<b>Property F </b>".$DelUrl; 
                                        }
                                        $TempArr["property_details_".$J]            = $propertydetails;
                                        $TempArr["duvaldynamicprice_".$J]           = $duvaldynamicprice;
                                        $TempArr["PropertyList_".$J]                = $J;
                                        $stampdutyTemp                              = $PropCmp["stampduty"] ? $PropCmp["stampduty"] : "0" ;
                                        $mortgageregistrationTemp                   = $PropCmp["mortgageregistration"] ? $PropCmp["mortgageregistration"] : "0" ;
                                        if ( $mortgageregistrationTemp == "" || $mortgageregistrationTemp == "0")
                                        {
                                            $mortgageregistrationTemp               = $PropCmp["leaseregistration"] ? $PropCmp["leaseregistration"] : "0" ;
                                        }
                                        $transferfeesTemp                           = $PropCmp["transferfees"] ? $PropCmp["transferfees"] : "0" ;
                                        if ( $transferfeesTemp == "" || $transferfeesTemp == "0")
                                        {
                                            $transferfeesTemp                       = $PropCmp["landtransfer"] ? $PropCmp["landtransfer"] : "0" ;
                                        }
                                        $IndexQry = " SELECT currency_id,symbol,country_code FROM currency_master WHERE currency_id ='{$currentCurrency}' ";
                                        $RowsArr = \DBConn\DBConnection::getQuery( $IndexQry );
                                        print_r($RowsArr);
                                        die;
                                        foreach($RowsArr as $Rows)
                                        {
                                            print_r($rows);
                                            // $Currency       = $Rows["currency_id"];
                                            // $CurrencySym    = $Rows["symbol"];
                                            // $countrycode    = $Rows["country_code"];
                                            // if($countrycode == "3")
                                            // {
                                            //     $CurrencySym = "Â£";
                                            // }
                                            // elseif($countrycode == "5")
                                            // {
                                            //     $CurrencySym = "â‚¬";
                                            // }    
                                        }
                                        die;
                                        $MapCurrecncy = $CurrencySym ." ".$Currency;
                                        $UsdExRateArr =  \Property\PropertyClass::GetCurrExrate($currentCurrency,$currtemp);
                                        foreach($UsdExRateArr as $UsdEx)
                                        {
                                            $UsdExRate = $UsdEx["RATE"] ? $UsdEx["RATE"] :"1";
                                        }
                                        if ($UsdExRate == "")
                                        {
                                            $UsdExRate = 1;
                                        }
                                        $TempArr["ExchangeRate_".$J]              = $UsdExRate;
                                        \ajax\ajaxClass::Init();
                                        $Prop  =  \ajax\ajaxClass::AnalyzerResult($autoid,"ARRAY");
                                        if ( $PropCmp["country_id"] == "2")
                                        {
                                            $TempArr["PurhcasePrice_".$J]             = round(floatval(round($duvaldynamicprice,0)) / floatval($UsdExRate),0);
                                            $TempArr["stampduty_".$J]                 = round(floatval($stampdutyTemp) / floatval($UsdExRate),0);
                                            $TempArr["mortgageregistration_".$J]      = round(floatval($mortgageregistrationTemp) / floatval($UsdExRate),0);
                                            $TempArr["transferfees_".$J]              = round(floatval($transferfeesTemp) / floatval($UsdExRate),0);
                                            $TempArr["TotalCashRequirement_".$J]      = round(floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate),0);
                                        }
                                        elseif ( $PropCmp["country_id"] == "1")
                                        {
                                            $TempArr["PurhcasePrice_".$J]            = round(floatval(round($duvaldynamicprice,0)) / floatval($UsdExRate),0);
                                            $TempArr["stampduty_".$J]                = round(floatval($stampdutyTemp),0) ;
                                            $TempArr["mortgageregistration_".$J]     = round(floatval($mortgageregistrationTemp) / floatval($UsdExRate),0);
                                            $TempArr["transferfees_".$J]             = round(floatval($transferfeesTemp) / floatval($UsdExRate),0);
                                            $TempArr["TotalCashRequirement_".$J]     = round(floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate),0);
                                        }
                                        elseif ($PropCmp["country_id"] == "3")
                                        {
                                            $TempArr["PurhcasePrice_".$J]             = round(floatval(round($duvaldynamicprice,0)) / floatval($UsdExRate),0);
                                            $TempArr["stampduty_".$J]                 = round(floatval($stampdutyTemp) / floatval($UsdExRate),0);
                                            $TempArr["mortgageregistration_".$J]      = round(floatval($mortgageregistrationTemp) / floatval($UsdExRate),0);
                                            $TempArr["transferfees_".$J]              = 0;
                                            $TempArr["TotalCashRequirement_".$J]      = round(floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate),0);
                                        }
                                        else
                                        {
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
                                        $TempArr["NetCashFlowAfterTax_".$J]         =  round($Prop[1]["NetCashFlowAfterTax"] / floatval($UsdExRate),0) .",".round($Prop[2]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[3]["NetCashFlowAfterTax"] / floatval($UsdExRate),0)."," .round($Prop[4]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[5]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[6]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[7]["NetCashFlowAfterTax"] / floatval($UsdExRate),0) .",".round($Prop[8]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[9]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[10]["NetCashFlowAfterTax"] / floatval($UsdExRate),0);
                                        $TempArr["TotalAnnualReturnAfterTax_".$J]   =  round($Prop[1]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[2]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[3]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0)."," .round($Prop[4]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[5]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[6]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[7]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0) .",".round($Prop[8]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[9]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[10]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0);
                                        $TempArr["Equity_".$J]                      =  round($Prop[1]["Equity"] / floatval($UsdExRate),0).",".round($Prop[2]["Equity"] / floatval($UsdExRate),0).",".round($Prop[3]["Equity"] / floatval($UsdExRate),0).",".round($Prop[4]["Equity"] / floatval($UsdExRate),0).",".round($Prop[5]["Equity"] / floatval($UsdExRate),0).",".round($Prop[6]["Equity"] / floatval($UsdExRate),0). ",".round($Prop[7]["Equity"] / floatval($UsdExRate),0).",".round($Prop[8]["Equity"] / floatval($UsdExRate),0).",".round($Prop[9]["Equity"] / floatval($UsdExRate),0).",".round($Prop[10]["Equity"] / floatval($UsdExRate),0);
                                        $PrevCountryId = $CountryId;      
                                        $J++;
                                    }
                                }
                            }
                            else
                            {
                                $autoid                                   = $PropCmp["autoid"]           ? $PropCmp["autoid"] : "" ;
                                $TempArr["UNIT_NO_".$J]                   = $PropCmp["UNIT_NO"]           ? $PropCmp["UNIT_NO"] : "" ;
                                $TempArr["property_name_".$J]             = $PropCmp["property_name"]     ? $PropCmp["property_name"] : "" ;
                                $TempArr["property_Address_".$J]          = $PropCmp["property_desc"]     ? $PropCmp["property_desc"] : "" ;
                                $TempArr["location_name_".$J]             = $PropCmp["location_name"]     ? $PropCmp["location_name"] : "" ;
                                $TempArr["country_name_".$J]              = $PropCmp["country_name"]      ? $PropCmp["country_name"] : "" ;
                                $CountryId                                = $PropCmp["country_id"]        ? $PropCmp["country_id"] : "" ;
                                $propertyid                               = $PropCmp["property_id"]        ? $PropCmp["property_id"] : "" ;
                                $TempArr["country_id_".$J]                = $CountryId;
                                if ( $PrevCountryId != "")
                                {
                                    if ($PrevCountryId != $CountryId)
                                    {
                                        $IsSameCountry= "N";
                                    }
                                }
                                $currtemp                                 = $PropCmp["baseCur"]           ? $PropCmp["baseCur"] : "" ;
                                $TempArr["baseCur_".$J]                   = $currtemp;
                                $duvaldynamicprice                        = $PropCmp["duvaldynamicprice"] ? $PropCmp["duvaldynamicprice"] : "0" ;  
                                $DelUrl = "<a href='". SITE_BASE_URL ."Property/PropertyDelete.html?id=".$propertyid ."&countryid=". $CountryId ."&autoid=". $autoid ."&IsProtFolio=Y&ViewCompare=R'>Delete</a>";
                                if($J==1)
                                {
                                    $propertydetails = "<b>Property A </b>".$DelUrl;
                                }
                                elseif($J==2)
                                {
                                    $propertydetails  = "<b>Property B </b>".$DelUrl; 
                                }
                                elseif($J==3)
                                {
                                    $propertydetails  = "<b>Property C </b>".$DelUrl; 
                                }
                                elseif($J==4)
                                {
                                    $propertydetails  = "<b>Property D </b>".$DelUrl; 
                                }
                                elseif($J==5)
                                {
                                    $propertydetails  = "<b>Property E </b>".$DelUrl; 
                                }
                                elseif($J==6)
                                {
                                    $propertydetails  = "<b>Property F </b>".$DelUrl; 
                                }
                                $TempArr["property_details_".$J]            = $propertydetails;
                                $TempArr["duvaldynamicprice_".$J]           = $duvaldynamicprice;
                                $TempArr["PropertyList_".$J]                = $J;
                                $stampdutyTemp                              = $PropCmp["stampduty"] ? $PropCmp["stampduty"] : "0" ;
                                $mortgageregistrationTemp                   = $PropCmp["mortgageregistration"] ? $PropCmp["mortgageregistration"] : "0" ;
                                if ( $mortgageregistrationTemp == "" || $mortgageregistrationTemp == "0")
                                {
                                    $mortgageregistrationTemp               = $PropCmp["leaseregistration"] ? $PropCmp["leaseregistration"] : "0" ;
                                }
                                $transferfeesTemp                           = $PropCmp["transferfees"] ? $PropCmp["transferfees"] : "0" ;
                                if ( $transferfeesTemp == "" || $transferfeesTemp == "0")
                                {
                                    $transferfeesTemp                       = $PropCmp["landtransfer"] ? $PropCmp["landtransfer"] : "0" ;
                                }
                                $IndexQry = " SELECT currency_id,symbol,country_code FROM currency_master WHERE currency_id ='{$currentCurrency}' ";
                                $RowsArr = \DBConn\DBConnection::getQuery( $IndexQry );
                                foreach($RowsArr as $Rows)
                                {
                                    $Currency       = $Rows["currency_id"];
                                    $CurrencySym    = $Rows["symbol"];
                                    $countrycode    = $Rows["country_code"];
                                    if($countrycode == "3")
                                    {
                                        $CurrencySym = "Â£";
                                    }
                                    elseif($countrycode == "5")
                                    {
                                        $CurrencySym = "â‚¬";
                                    }    
                                }
                                $MapCurrecncy = $CurrencySym ." ".$Currency;
                                $UsdExRateArr =  \Property\PropertyClass::GetCurrExrate($currentCurrency,$currtemp);
                                foreach($UsdExRateArr as $UsdEx)
                                {
                                    $UsdExRate = $UsdEx["RATE"] ? $UsdEx["RATE"] :"1";
                                }
                                if ($UsdExRate == "")
                                {
                                    $UsdExRate = 1;
                                }
                                $TempArr["ExchangeRate_".$J]              = $UsdExRate;
                                \ajax\ajaxClass::Init();
                                $Prop  =  \ajax\ajaxClass::AnalyzerResult($autoid,"ARRAY");
                                if ( $PropCmp["country_id"] == "2")
                                {
                                    $TempArr["PurhcasePrice_".$J]             = round(floatval(round($duvaldynamicprice,0)) / floatval($UsdExRate),0);
                                    $TempArr["stampduty_".$J]                 = round(floatval($stampdutyTemp) / floatval($UsdExRate),0);
                                    $TempArr["mortgageregistration_".$J]      = round(floatval($mortgageregistrationTemp) / floatval($UsdExRate),0);
                                    $TempArr["transferfees_".$J]              = round(floatval($transferfeesTemp) / floatval($UsdExRate),0);
                                    $TempArr["TotalCashRequirement_".$J]      = round(floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate),0);
                                }
                                elseif ( $PropCmp["country_id"] == "1")
                                {
                                    $TempArr["PurhcasePrice_".$J]            = round(floatval(round($duvaldynamicprice,0)) / floatval($UsdExRate),0);
                                    $TempArr["stampduty_".$J]                = round(floatval($stampdutyTemp),0) ;
                                    $TempArr["mortgageregistration_".$J]     = round(floatval($mortgageregistrationTemp) / floatval($UsdExRate),0);
                                    $TempArr["transferfees_".$J]             = round(floatval($transferfeesTemp) / floatval($UsdExRate),0);
                                    $TempArr["TotalCashRequirement_".$J]     = round(floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate),0);
                                }
                                elseif ($PropCmp["country_id"] == "3")
                                {
                                    $TempArr["PurhcasePrice_".$J]             = round(floatval(round($duvaldynamicprice,0)) / floatval($UsdExRate),0);
                                    $TempArr["stampduty_".$J]                 = round(floatval($stampdutyTemp) / floatval($UsdExRate),0);
                                    $TempArr["mortgageregistration_".$J]      = round(floatval($mortgageregistrationTemp) / floatval($UsdExRate),0);
                                    $TempArr["transferfees_".$J]              = 0;
                                    $TempArr["TotalCashRequirement_".$J]      = round(floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate),0);
                                }
                                else
                                {
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
                                $TempArr["NetCashFlowAfterTax_".$J]         =  round($Prop[1]["NetCashFlowAfterTax"] / floatval($UsdExRate),0) .",".round($Prop[2]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[3]["NetCashFlowAfterTax"] / floatval($UsdExRate),0)."," .round($Prop[4]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[5]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[6]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[7]["NetCashFlowAfterTax"] / floatval($UsdExRate),0) .",".round($Prop[8]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[9]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[10]["NetCashFlowAfterTax"] / floatval($UsdExRate),0);
                                $TempArr["TotalAnnualReturnAfterTax_".$J]   =  round($Prop[1]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[2]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[3]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0)."," .round($Prop[4]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[5]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[6]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[7]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0) .",".round($Prop[8]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[9]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[10]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0);
                                $TempArr["Equity_".$J]                      =  round($Prop[1]["Equity"] / floatval($UsdExRate),0).",".round($Prop[2]["Equity"] / floatval($UsdExRate),0).",".round($Prop[3]["Equity"] / floatval($UsdExRate),0).",".round($Prop[4]["Equity"] / floatval($UsdExRate),0).",".round($Prop[5]["Equity"] / floatval($UsdExRate),0).",".round($Prop[6]["Equity"] / floatval($UsdExRate),0). ",".round($Prop[7]["Equity"] / floatval($UsdExRate),0).",".round($Prop[8]["Equity"] / floatval($UsdExRate),0).",".round($Prop[9]["Equity"] / floatval($UsdExRate),0).",".round($Prop[10]["Equity"] / floatval($UsdExRate),0);
                                $PrevCountryId = $CountryId;      
                                $J++;
                            }
                        }
                        if($IsSameCurr == "2")
                        {    
                            $ExrateUsd = "(USD)";    
                        }
                        else
                        {
                            $ExrateUsd = $currtemp;
                        }
                        $IndexQry = "select 
                                    'Analysed Properties' as Headers,
                                    '' as columns ,
                                    '' as feildname,
                                    'Text' as datatype,
                                    '' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    '' as columns ,
                                    'property_details_' as feildname,
                                    'Text' as datatype,
                                    '' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    'Property' as columns ,
                                    'property_name_' as feildname,
                                    'Text' as datatype,
                                    '' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    'Property Address' as columns ,
                                    'property_Address_' as feildname,
                                    'Text' as datatype,
                                    '' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    'Location' as columns  ,
                                    'location_name_' as feildname,
                                    'Text' as datatype,
                                    '' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    'Country' as columns ,
                                    'country_name_' as feildname,
                                    'Text' as datatype,
                                    '' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    'Exchange Rate' as columns ,
                                    'ExchangeRate_' as feildname,
                                    'Text' as datatype,
                                    '' as Rateper
                                    from dual
                                    union all
                                    select 
                                    'Purchase Information' as Headers,
                                    '' as columns ,
                                    '' as feildname,
                                    'Text' as datatype,
                                    '' as Rateper
                                    from dual
                                     union all
                                    select 
                                    '' as Headers,
                                    'Purhcase Price' as columns ,
                                    'PurhcasePrice_' as feildname,
                                    'No' as datatype,
                                    '' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    'Stamp Duty' as columns ,
                                    'stampduty_' as feildname,
                                    'No' as datatype,
                                    '' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    'Mortgage/Lease Registration' as columns ,
                                    'mortgageregistration_' as feildname,
                                    'No' as datatype,
                                    '' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    'Transfer Fees' as columns ,
                                    'transferfees_' as feildname,
                                    'No' as datatype,
                                    '' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    'Total Cash Requirement' as columns ,
                                    'TotalCashRequirement_' as feildname,
                                    'No' as datatype,
                                    '' as Rateper
                                    from dual
                                    union all
                                    select 
                                    'Growth Rates' as Headers,
                                    '' as columns ,
                                    '' as feildname,
                                    'No' as datatype,
                                    '' as Rateper
                                    from dual
                                     union all
                                    select 
                                    '' as Headers,
                                    'CPI' as columns ,
                                    'cpi_' as feildname,
                                    'format2' as datatype,
                                    'Percentage' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    'Rental Growth' as columns ,
                                    'rentalgrowth_' as feildname,
                                    'format2' as datatype,
                                    'Percentage' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    'Capital Growth' as columns ,
                                    'capitalgrowth_' as feildname,
                                    'format2' as datatype,
                                    'Percentage' as Rateper
                                    from dual
                                    union all
                                    select 
                                    'IRR' as Headers,
                                    '' as columns ,
                                    '' as feildname,
                                    'No' as datatype,
                                    '' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    'IRR' as columns ,
                                    'IRR_' as feildname,
                                    'format2' as datatype,
                                    'Percentage' as Rateper
                                    from dual
                                    union all
                                    select 
                                    '' as Headers,
                                    'IRR (after tax)' as columns ,
                                    'IRRAfterTax_' as feildname,
                                    'format2' as datatype,
                                    'Percentage' as Rateper
                                    from dual";
                        $Rows = \DBConn\DBConnection::getQuery( $IndexQry );
                        foreach($Rows as $Row)
                        {
                            if ( $Row["Headers"] !="" )
                            {
                                ?>
                                <tr>
                                    <th colspan="6"><h1 class="hero-title-dark"><?php echo $Row["Headers"]; ?></h1></th>
                                </tr>
                                <?php    
                            }
                            else
                            {
                                ?>
                                <tr>
                                    <td><?php echo $Row["columns"]; ?></td>
                                    <?php
                                    $feildname   = $Row["feildname"];
                                    $datatype    = $Row["datatype"]; 
                                    $Rateper     = $Row["Rateper"];
                                    for($k=1; $k < $J; $k++)
                                    {
                                        if($Rateper == "Percentage")
                                        {
                                            $Rateperval = "%";
                                        }
                                        else
                                        {
                                            $Rateperval = "";
                                        }
                                        if ( $datatype == "format2")
                                        {
                                            ?>
                                            <td><?php echo number_format($TempArr[$feildname.$k],2); echo $Rateperval; ?></td>
                                            <?php
                                        }
                                        elseif ( $datatype == "No")
                                        {
                                            ?>
                                            <td><?php echo number_format($TempArr[$feildname.$k]); echo $Rateperval; ?></td>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <td><?php echo $TempArr[$feildname.$k]; ?></td>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tr>
                                <?php
                            }    
                        }
                        for($m=1; $m < $J; $m++)
                        {
                            ?>
                            <input type='hidden' name='NetCashFlowAfterTaxGraph_<?php echo $m; ?>' id='NetCashFlowAfterTaxGraph_<?php echo $m; ?>' value='<?php echo $TempArr["NetCashFlowAfterTax_".$m];  ?>' >
                            <input type='hidden' name='TotalAnnualReturnAfterTaxGraph_<?php echo $m; ?>' id='TotalAnnualReturnAfterTaxGraph_<?php echo $m; ?>' value='<?php echo $TempArr["TotalAnnualReturnAfterTax_".$m];  ?>' >
                            <input type='hidden' name='EquityGraph_<?php echo $m; ?>' id='EquityGraph_<?php echo $m; ?>' value='<?php echo $TempArr["Equity_".$m];  ?>' >
                            <?php
                        }
                        ?>
                        <input type='hidden' name='TotalCount' id='TotalCount' value='<?php echo $m-1;  ?>' >
                        <input type='hidden' name='IsSameCountry' id='IsSameCountry' value='<?php echo $IsSameCountry;  ?>' >
                        <input type='hidden' name='ExrateUsd' id='ExrateUsd' value='<?php echo $ExrateUsd;  ?>' >        
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h1 class="hero-title-dark">Investment Comparison</h1>
                <div class="projects-panel">
                    <div id="annualCashFlowchart"></div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h1 class="hero-title-dark">Total Annual Return (after tax)</h1>
                <div class="projects-panel">
                    <div id="annualReturnchart"></div>
                </div>
            </div>
        </div>
        <div class="row mt-4" >
            <div class="col-12">
                <h1 class="hero-title-dark">Estimated Equity</h1>
                <div class="projects-panel">
                    <div id="estimateEquitychart"></div>
                </div>
            </div>
        </div>
        <div class="float-button" >
        	 <button type="button" class="btn btn-orange" id="save_pdf">SAVE PDF</button>
          </div>
        <?php
    }
    else
    {
        ?>
        <div class="panel panel-black mt-0">
            <div class="panel-title">
                <h2>My Portfolio</h2>
                <span class="action"> 
                    <div class="btn-group" role="group">
                        <a href="<?php echo SITE_BASE_URL;?>Portfolio/ProtfolioPropDetails.html?IsProtFolio=Y" class="add-prop-link"><i class="fas fa-plus"></i> Add New Property</a>
                    </div>
                </span>
            </div>
            <div class="portfolio-panel" >
                <div class="row">
                    <?php
                    $property_check = 0;
                    $portfolio_value = 0;
                    $totalRoi = 0;
                    $totalGRoss = 0;
                    \Property\PropertyClass::Init();
                    $rows = \Property\PropertyClass::GetPropertyComparison("","","","",$ViewCompare);
                    $i=1;
                    $TotalPropertyValue         = 0;
                    $Totalrentperweek           = 0;
                    $TotalYieldroi              = 0;
                    $Totalportfoliogrowth       = 0;
                    $TotalGrossIncome           = 0;
                    $Totalweeklyrental          = 0;
                    $TotalNetAnnualReturn       = 0;
                    $PropReached                = 1;
                    $TotalNetCashFlow           = 0;
                    $TotalYieldroi              = 0;
                    $TotalOperatigExpTotal      = 0;
                    $post                       = 0;
                    foreach ($rows as $row) 
                    {
                        $post++;
                        
                        if($post == 4)
                        {
                            $post = 0;
                        }
                        
                        $ProprtyId      = $row["propertyid"];
                        $autoid         = $row["autoid"];
                        $Countryname    = $row["country_name"];
                        $countryid      = $row["country_id"];
                        $locationame    = $row["location_name"] ?$row["location_name"] :"";
                        $imagefile      = $row["image_file"] ? $row["image_file"] : "notupload";
                        $income         = $row["income"] ? $row["income"] : "0";
                        $property_desc  = $row["property_desc"] ? $row["property_desc"] : "";
                        $currtemp       = $row["baseCur"]  ? $row["baseCur"] : "NZD" ;
                        $UsdExRate      = "";
                        $IndexQry       = " SELECT currency_id,symbol,country_code FROM currency_master WHERE currency_id ='{$currentCurrency}' ";
                        $RowsArr        = \DBConn\DBConnection::getQuery( $IndexQry );
                        foreach($RowsArr as $Rows)
                        {
                            $Currency       = $Rows["currency_id"];
                            $CurrencySym    = $Rows["symbol"];
                            $countrycode    = $Rows["country_code"];
                        }
                        if($Currency == "EUR"){
                            $CurrencySym = "\xE2\x82\xAc";
                        }
                        if($Currency == "RMB"){
                            $CurrencySym = "¥";
                        }
                        if($Currency == "GBP"){
                            $CurrencySym = "£";
                        }
                        $MapCurrecncy = $CurrencySym ." ".$Currency;
                        $UsdExRateArr =  \Property\PropertyClass::GetCurrExrate($currentCurrency,$currtemp);
                        foreach($UsdExRateArr as $UsdEx)
                        {
                            $UsdExRate = $UsdEx["RATE"] ? $UsdEx["RATE"] :"1";
                        }
                        if ($UsdExRate == "")
                        {
                            $UsdExRate = 1;
                        }
                        $initialloanamt             = $row["initialloanamt"] ?  $row["initialloanamt"] : "0";
                        $interestrate               = $row["interestrate"] ?  $row["interestrate"] : "0";
                        $initialloanamt             = floatval($initialloanamt) / floatval($UsdExRate);
                        $FinanceCosts               = ((($interestrate / 12) * $initialloanamt) * 12) /100;
                        \ajax\ajaxClass::Init();
                        $Prop                       = \ajax\ajaxClass::AnalyzerResult($autoid,"ARRAY");
                        $PropertyValue              = floatval($Prop[1]["PropertyValue"]) / floatval($UsdExRate);
                        $GrossIncome                = floatval($Prop[1]["GrossIncome"]) / floatval($UsdExRate) ;
                        $OperatigExpTotal           = floatval($Prop[1]["OperatigExpTotal"]) / floatval($UsdExRate) ;
                        $NetAnnualReturn            = $GrossIncome - $OperatigExpTotal;
                        $NetCashFlow                = floatval($Prop[1]["NetCashFlow"]) / floatval($UsdExRate) ;
                        $NetCashFlowAfterTax        = floatval($Prop[1]["NetCashFlowAfterTax"]) / floatval($UsdExRate) ;
                        $TotalInitialCashCost       = floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate);
                        $MortgagePayment            = floatval($Prop[1]["MortgagePayment"]) / floatval($UsdExRate) ;
    
                        if($TotalInitialCashCost>0){
                            $ROI    = ($NetCashFlowAfterTax / $TotalInitialCashCost)* 100 ;
                        } else {
                            $ROI    = "0" ;
                        }
                        $TotalYieldroi              = $TotalYieldroi + $ROI;
                        $TotalOperatigExpTotal      = floatval($TotalOperatigExpTotal) + floatval($OperatigExpTotal);
                        $lettingfeerate             = $row["lettingfeerate"]            ? $row["lettingfeerate"]            : "0"; 
                        $managementfees             = $row["managementfees"]            ? $row["managementfees"]            : "0"; 
                        $councilpropertytax         = $row["councilpropertytax"]        ? $row["councilpropertytax"]        : "0"; 
                        $codycorporateservicechg    = $row["codycorporateservicechg"]   ? $row["codycorporateservicechg"]   : "0"; 
                        $landleaserentpa            = $row["landleaserentpa"]           ? $row["landleaserentpa"]           : "0"; 
                        $insurancepa                = $row["insurancepa"]               ? $row["insurancepa"]               : "0"; 
                        $repairandmaintenance       = $row["repairandmaintenance"]      ? $row["repairandmaintenance"]      : "0"; 
                        $cleaningpermonth           = $row["cleaningpermonth"]          ? $row["cleaningpermonth"]          : "0"; 
                        $gardeningpermonth          = $row["gardeningpermonth"]         ? $row["gardeningpermonth"]         : "0"; 
                        $servicecontractspa         = $row["servicecontractspa"]        ? $row["servicecontractspa"]        : "0"; 
                        $other                      = $row["other"]                     ? $row["other"]                     : "0"; 
                        $fixturesvalue              = $row["fixturesvalue"]             ? $row["fixturesvalue"]             : "0"; 
                        $fixtureslife               = $row["fixtureslife"]              ? $row["fixtureslife"]              : "0"; 
                        $furniturevalue             = $row["furniturevalue"]            ? $row["furniturevalue"]            : "0"; 
                        $furniturelife              = $row["furniturelife"]             ? $row["furniturelife"]             : "0"; 
                        $weeklyrental               = $row["weeklyrental"]              ? $row["weeklyrental"]              : "0"; 
                        $capitalgrowth              = $row["capitalgrowth"]             ? $row["capitalgrowth"]             : "0"; 
                        $checked = false;
                        $ids[] = $autoid;
                        if($_SERVER['REQUEST_METHOD'] == "POST")
                        {
                            if(isset($_POST['prop_ID']))
                            {
                                foreach($_POST['prop_ID'] as $prop)
                                {
                                    
                                    if($prop == $autoid)
                                    {
                                        $checked = true;
                                        $property_check++;
                                        $portfolio_value += $PropertyValue;
                                        $totalRoi += $ROI;
                                        $totalGRoss += $GrossIncome;
                                        $Totalweeklyrental          = floatval($Totalweeklyrental) + floatval($weeklyrental) ;
                                        $Totalportfoliogrowth       = floatval($Totalportfoliogrowth) + floatval($capitalgrowth);
                                        $TotalGrossIncome           = floatval($TotalGrossIncome)  + ($GrossIncome);
                                        $TotalNetAnnualReturn       = floatval($TotalNetAnnualReturn)  + ($NetAnnualReturn);
                                        $TotalNetCashFlow           = floatval($TotalNetCashFlow)  + ($NetCashFlow);
                                        $TotalNetCashFlowAfterTax   = floatval($TotalNetCashFlowAfterTax)  + floatval($NetCashFlowAfterTax);
                                        $fixturesfitting            = @(floatval($fixturesvalue) * (1 / floatval($fixtureslife)));
                                        $funitures                  = @(floatval($furniturevalue) * (1 / floatval($furniturelife)));
                                        $TotalPropertyValue         = floatval($TotalPropertyValue)  + floatval($PropertyValue);
                                        $Annualexpensestemp         = floatval($lettingfeerate)  + floatval($managementfees) + floatval($councilpropertytax) + floatval($codycorporateservicechg) + floatval($landleaserentpa) + floatval($insurancepa) + floatval($repairandmaintenance)   + floatval($cleaningpermonth) + floatval($gardeningpermonth) + floatval($servicecontractspa) + floatval($other);        
                                        $Annualexpenses             = floatval($Annualexpensestemp) + floatval($MortgagePayment)   + floatval($fixturesfitting)  + floatval($funitures) ;
                                        $TotalAnnualexpenses        = floatval($TotalAnnualexpenses) +  floatval($Annualexpenses);
                                    }
                                }
                            }
                        }
                        else
                        {
                            $checked = true;
                            $property_check++;
                            $portfolio_value += $PropertyValue;
                            $totalRoi += $ROI;
                            $totalGRoss += $GrossIncome;
                            $Totalweeklyrental          = floatval($Totalweeklyrental) + floatval($weeklyrental) ;
                            $Totalportfoliogrowth       = floatval($Totalportfoliogrowth) + floatval($capitalgrowth);
                            $TotalGrossIncome           = floatval($TotalGrossIncome)  + ($GrossIncome);
                            $TotalNetAnnualReturn       = floatval($TotalNetAnnualReturn)  + ($NetAnnualReturn);
                            $TotalNetCashFlow           = floatval($TotalNetCashFlow)  + ($NetCashFlow);
                            $TotalNetCashFlowAfterTax   = floatval($TotalNetCashFlowAfterTax)  + floatval($NetCashFlowAfterTax);
                            $fixturesfitting            = @(floatval($fixturesvalue) * (1 / floatval($fixtureslife)));
                            $funitures                  = @(floatval($furniturevalue) * (1 / floatval($furniturelife)));
                            $TotalPropertyValue         = floatval($TotalPropertyValue)  + floatval($PropertyValue);
                            $Annualexpensestemp         = floatval($lettingfeerate)  + floatval($managementfees) + floatval($councilpropertytax) + floatval($codycorporateservicechg) + floatval($landleaserentpa) + floatval($insurancepa) + floatval($repairandmaintenance)   + floatval($cleaningpermonth) + floatval($gardeningpermonth) + floatval($servicecontractspa) + floatval($other);        
                            $Annualexpenses             = floatval($Annualexpensestemp) + floatval($MortgagePayment)   + floatval($fixturesfitting)  + floatval($funitures) ;
                            $TotalAnnualexpenses        = floatval($TotalAnnualexpenses) +  floatval($Annualexpenses);
                        }
                        ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="p-box <?= ($checked) ? 'pbox-checked' : '' ; ?>"><!-- pbox-checked-->
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h4>Avenue Apartment</h4>  
                                    <div class="acts">
                                     <input type="checkbox" <?= ($checked) ? 'checked' : '' ; ?> onchange="get_value('<?= $autoid; ?>', 'PropertyChecked<?php echo $i; ?>');" class="input_check" name="PropertyChecked"  id="PropertyChecked<?php echo $i; ?>"  value='<?php echo $autoid; ?>'  >
                                        <div class="dropdown">
                                            <button type="button" class="btn" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="<?php echo SITE_BASE_URL;?>Property/PropertyDelete.html?id=<?php echo $ProprtyId;?>&countryid=<?php echo $countryid;?>&autoid=<?php echo $autoid;?>&IsProtFolio=Y">Delete</a>
                                                <a class="dropdown-item" href="<?php echo SITE_BASE_URL;?>Property/PortfolioFulDtl.html?id=<?php echo $ProprtyId;?>&countryid=<?php echo $countryid;?>&autoid=<?php echo $autoid;?>&IsProtFolio=Y&edit=Y">Edit</a>
                                            </div>
                                        </div>
                                    </div>   
                                   
                                </div>
                                <?php
                                if($countryid == 3)
                                {
                                    ?>
                                    <img src="https://duvalknowledge.com/latest-dpo/dashboard/assets/images/uk-search-bg.jpg" class="w-100" alt="">
                                    <?php
                                }
                                if($countryid == 1)
                                {
                                    ?>
                                    <img src="https://duvalknowledge.com/latest-dpo/dashboard/assets/images/nz-search-bg.jpg" class="w-100" alt="">
                                    <?php
                                }
                                if($countryid == 2)
                                {
                                    ?>
                                    <img src="https://duvalknowledge.com/latest-dpo/dashboard/assets/images/au-search-bg.jpg" class="w-100" alt="">
                                    <?php
                                }
                                ?>
                                
                                <table class="table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Country</td>
                                            <td><?= $Countryname; ?></td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td><?php echo  $property_desc; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Annual Income</td>
                                            <td><?= number_format(round($TotalGrossIncome,0));?></td>
                                        </tr>
                                        <tr>
                                            <td>Market Value (E)</td>
                                            <td><?= number_format(round($PropertyValue,0),0);?></td>
                                        </tr>
                                        <tr>
                                            <td>Gross Yield</td>
                                            <td>5%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                        if ($i > 3)
                        {
                            $PropReached = 0;
                        }
                        $i++;
                    }
                    ?>
                    <form id="checkBox" method="post" action="">
                        <div class="form_value">
                            <?php
                            if($_SERVER['REQUEST_METHOD'] == "POST")
                            {
                                if(isset($_POST[prop_ID]))
                                {
                                    foreach($_POST['prop_ID'] as $prop)
                                    {
                                        ?>
                                        <input type="hidden" name="prop_ID[]" value="<?= $prop; ?>" id="propID<?= $prop; ?>" >
                                        <?php
                                    }
                                }
                            }
                            else
                            {
                                if (count($ids)>0) {
                                foreach($ids as $chk_id)
                                {
                                    ?>
                                    <input type="hidden" name="prop_ID[]" value="<?= $chk_id; ?>" id="propID<?= $chk_id; ?>" >
                                    <?php
                                }}
                            }
                            ?>
                        </div>
                    </form>
                    <?php
                    $K = $i - 1 ;
                   // echo $K;
                    if($post >= 0 && $K<4)
                    {
                        for ($i = $post; $i < 4 ; $i++ )
                        {
                        ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="p-box placeholder-box">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h4>Avenue Apartment</h4>                                  
                                    <input type="checkbox" class="input_check" name="" id="" value="checkedValue">
                                </div>
                                <img src="<?= SITE_BASE_URL;?>dashboard/assets/images/dummy.png" class="w-100" alt="">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Country</td>
                                            <td>New Zealand</td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td>Auckland</td>
                                        </tr>
                                        <tr>
                                            <td>Annual Income</td>
                                            <td>$30,000</td>
                                        </tr>
                                        <tr>
                                            <td>Market Value (E)</td>
                                            <td>$600,000</td>
                                        </tr>
                                        <tr>
                                            <td>Gross Yield</td>
                                            <td>5%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                        }
                    }
                    ?>
                </div>
                <div class="col-12">
                    <div class="more">
                        <a href="#">
                            <i class="fas fa-arrow-to-bottom"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $Totalrentperweek = floatval($Totalweeklyrental) * 53;   
        $PropList = floatval($i)-1;   
        if ( floatval($TotalPropertyValue) > 0)
        {
            $Totalportfoliogrowth = floatval($Totalportfoliogrowth) / floatval($PropList);
        }
        else
        {
            $Totalportfoliogrowth = 0;
        }   
        if ( floatval($TotalYieldroi) > 0 && $PropList > 0)
        {
            $TotalYieldroi  = $TotalYieldroi / $PropList;
        }
        ?>
        <input type='hidden' name='Totalportfoliogrowth' id='Totalportfoliogrowth' value='<?php echo round($Totalportfoliogrowth); ?>' >
        <div class="row mt-4 buds">
            <div class="col-xl-3 col-md-6">
                <h1 class="hero-title-dark bud-title">My Properties <span><?= $property_check; ?></span></h1>
                <!--<div class="graph-panel">-->
                <!--    <canvas id="project-bar"></canvas>-->
                <!--</div>-->
                <script>
                    // var ctx = document.getElementById("project-bar");
                    // ctx.height = 100;
                    // var myChart = new Chart(ctx, {
                    //     type: 'bar',
                    //     data: {
                    //         labels: ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB",],
                    //         datasets: [{
                    //             label: '',
                    //             data: [5, 6, 4.5, 5.5, 3, 6, 4.5, 6, 8, 3, 5.5, 4, 6, 9, 12, 4, 3, 6, 4.5, 6, 8, 4.5, 5, 6, 4.5, 5.5,],
                    //             backgroundColor: '#4c84ff',
                    //         }]
                    //     },
                    //     options: {
                    //         legend: {
                    //             display: false
                    //         },
                    //         scales: {
                    //             xAxes: [{
                    //                 gridLines: {
                    //                     drawBorder: false,
                    //                     display: false
                    //                 },
                    //                 ticks: {
                    //                     display: false,
                    //                     beginAtZero: true
                    //                 },
                    //                 barPercentage: 1,
                    //                 categoryPercentage: 0.2
                    //             }],
                    //             yAxes: [{
                    //                 gridLines: {
                    //                     drawBorder: false,
                    //                     display: false
                    //                 },
                    //                 ticks: {
                    //                     display: false,
                    //                     beginAtZero: true
                    //                 },
                    //             }]
                    //         },
                    //         tooltips: {
                    //             enabled: false
                    //         }
                    //     }
                    // });
                </script>
            </div>
            <div class="col-xl-3 col-md-6 mt-4 mt-md-0">
                <h1 class="hero-title-dark bud-title"> Portfolio Value  <span id='TotalPropertyValue' >$<?php echo number_format($portfolio_value,0); ?></span></h1>
                <!--<div class="graph-panel">-->
                <!--    <canvas id="top-product"></canvas>-->
                    <input type='hidden' name='TotalPropertyValueHidden' id='TotalPropertyValueHidden' value='<?php echo round($portfolio_value); ?>' >
                <!--</div>-->
                <script>
                    // var ctx = document.getElementById("top-product");
                    // ctx.height = 100;
                    // var myChart = new Chart(ctx, {
                    //     type: 'line',
                    //     data: {
                    //         labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
                    //         type: 'line',
                
                    //         datasets: [{
                    //             label: "My First dataset",
                    //             data: [28, 35, 54, 38, 26, 62, 50],
                    //             backgroundColor: "rgba(108, 52, 131,0.35)",
                    //             borderColor: "#5B2C6F",
                    //             borderWidth: 3,
                    //             strokeColor: "#FF4961",
                    //             capBezierPoints: !0,
                    //             pointColor: "#fff",
                    //             pointBorderColor: "#C39BD3",
                    //             pointBackgroundColor: "#FFF",
                    //             pointBorderWidth: 3,
                    //             pointRadius: 5,
                    //             pointHoverBackgroundColor: "#FFF",
                    //             pointHoverBorderColor: "#FF4961",
                    //             pointHoverRadius: 7
                    //         }]
                    //     },
                    //     options: {
                    //         responsive: true,
                    //         tooltips: {
                    //             enabled: false,
                    //         },
                    //         legend: {
                    //             display: false,
                    //             position: 'top',
                    //             labels: {
                    //                 usePointStyle: true,
                
                    //             },
                
                
                    //         },
                    //         scales: {
                    //             xAxes: [{
                    //                 display: false,
                    //                 gridLines: {
                    //                     display: false,
                    //                     drawBorder: false
                    //                 },
                    //                 scaleLabel: {
                    //                     display: false,
                    //                     labelString: 'Month'
                    //                 }
                    //             }],
                    //             yAxes: [{
                    //                 display: false,
                    //                 gridLines: {
                    //                     display: false,
                    //                     drawBorder: false
                    //                 },
                    //                 scaleLabel: {
                    //                     display: true,
                    //                     labelString: '$ USD'
                    //                 }
                    //             }]
                    //         },
                    //         title: {
                    //             display: false,
                    //         }
                    //     }
                    // });
                </script>
            </div>
            <div class="col-xl-3 col-md-6 mt-4 mt-xl-0">
                <h1 class="hero-title-dark bud-title">ROI<span id="TotalYieldroi"><?php echo number_format($totalRoi,2); ?>%</span></h1>
                <!--<div class="graph-panel">-->
                <!--    <canvas id="expenses-graph-new"></canvas>-->
                <!--</div>-->
                <script>
                    // var ctx = document.getElementById("expenses-graph-new");
                    // ctx.height = 100;
                    // var myChart = new Chart(ctx, {
                    //     type: 'line',
                    //     data: {
                    //         labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
                    //         type: 'line',
                
                    //         datasets: [{
                    //             label: "My First dataset",
                    //             data: [32, 45, 36, 48, 46, 42, 55],
                    //             backgroundColor: "rgba(133,133,255,0.35)",
                    //             borderColor: "#EC7063",
                    //             borderWidth: 3,
                    //             strokeColor: "#FF4961",
                    //             capBezierPoints: !0,
                    //             pointColor: "#fff",
                    //             pointBorderColor: "#EC7063",
                    //             pointBackgroundColor: "#FFF",
                    //             pointBorderWidth: 3,
                    //             pointRadius: 5,
                    //             pointHoverBackgroundColor: "#FFF",
                    //             pointHoverBorderColor: "#FF4961",
                    //             pointHoverRadius: 7
                    //         }]
                    //     },
                    //     options: {
                    //         responsive: true,
                    //         tooltips: {
                    //             enabled: false,
                    //         },
                    //         legend: {
                    //             display: false,
                    //             position: 'top',
                    //             labels: {
                    //                 usePointStyle: true,
                
                    //             },
                
                
                    //         },
                    //         scales: {
                    //             xAxes: [{
                    //                 display: false,
                    //                 gridLines: {
                    //                     display: false,
                    //                     drawBorder: false
                    //                 },
                    //                 scaleLabel: {
                    //                     display: false,
                    //                     labelString: 'Month'
                    //                 }
                    //             }],
                    //             yAxes: [{
                    //                 display: false,
                    //                 gridLines: {
                    //                     display: false,
                    //                     drawBorder: false
                    //                 },
                    //                 scaleLabel: {
                    //                     display: true,
                    //                     labelString: '$ USD'
                    //                 }
                    //             }]
                    //         },
                    //         title: {
                    //             display: false,
                    //         }
                    //     }
                    // });
                </script>
            </div>
             <?php
            if ($TotalGrossIncome > 0)
            {
                $OperationalLeakage = (round($TotalOperatigExpTotal) / round($TotalGrossIncome)) * 100;
            }   
            else
            {
                $OperationalLeakage = 0;
            }
            ?>
            <div class="col-xl-3 col-md-6 mt-4 mt-xl-0">
                <h1 class="hero-title-dark bud-title">Operational Leakage<span id="TotalYieldroi"><?php echo number_format($OperationalLeakage,2); ?>%</span></h1>
                <!--<div class="graph-panel">-->
                <!--    <canvas id="btc-income"></canvas>-->
                <!--</div>-->
                <script>
                    // var ctx = document.getElementById("btc-income");
                    // ctx.height = 100;
                    // var myChart = new Chart(ctx, {
                    //     type: 'line',
                    //     data: {
                    //         labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
                    //         type: 'line',
                    //         datasets: [{
                    //             label: "My First dataset",
                    //             data: [28, 35, 36, 48, 46, 42, 60],
                    //             backgroundColor: "rgba(133,133,255,0.35)",
                    //             borderColor: "#5B2C6F",
                    //             borderWidth: 3,
                    //             strokeColor: "#FF4961",
                    //             capBezierPoints: !0,
                    //             pointColor: "#fff",
                    //             pointBorderColor: "#FF4961",
                    //             pointBackgroundColor: "#FFF",
                    //             pointBorderWidth: 3,
                    //             pointRadius: 5,
                    //             pointHoverBackgroundColor: "#FFF",
                    //             pointHoverBorderColor: "#FF4961",
                    //             pointHoverRadius: 7
                    //         }]
                    //     },
                    //     options: {
                    //         responsive: true,
                    //         tooltips: {
                    //             enabled: false,
                    //         },
                    //         legend: {
                    //             display: false,
                    //             position: 'top',
                    //             labels: {
                    //                 usePointStyle: true,
                
                    //             },
                    //         },
                    //         scales: {
                    //             xAxes: [{
                    //                 display: false,
                    //                 gridLines: {
                    //                     display: false,
                    //                     drawBorder: false
                    //                 },
                    //                 scaleLabel: {
                    //                     display: false,
                    //                     labelString: 'Month'
                    //                 }
                    //             }],
                    //             yAxes: [{
                    //                 display: false,
                    //                 gridLines: {
                    //                     display: false,
                    //                     drawBorder: false
                    //                 },
                    //                 scaleLabel: {
                    //                     display: true,
                    //                     labelString: '$ USD'
                    //                 }
                    //             }]
                    //         },
                    //         title: {
                    //             display: false,
                    //         }
                    //     }
                    // });
                </script>
            </div>
        </div>
        <div class="row mt-4 buds">
           
            <div class="col-xl-3 col-md-6">
                <h1 class="hero-title-dark bud-title">Gross Annual Rental<span id="TotalGrossIncome">$<?php echo number_format($totalGRoss,0); ?></span></h1>
                <!--<div class="graph-panel">-->
                <!--    <canvas id="expenses-graph"></canvas>-->
                    <script>
                        // var ctx = document.getElementById("expenses-graph");
                        // ctx.height = 100;
                        // var myChart = new Chart(ctx, {
                        //     type: 'line',
                        //     data: {
                        //         labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
                        //         type: 'line',
                    
                        //         datasets: [{
                        //             label: "My First dataset",
                        //             data: [32, 45, 36, 48, 46, 42, 55],
                        //             backgroundColor: "rgba(133,133,255,0.35)",
                        //             borderColor: "#EC7063",
                        //             borderWidth: 3,
                        //             strokeColor: "#FF4961",
                        //             capBezierPoints: !0,
                        //             pointColor: "#fff",
                        //             pointBorderColor: "#EC7063",
                        //             pointBackgroundColor: "#FFF",
                        //             pointBorderWidth: 3,
                        //             pointRadius: 5,
                        //             pointHoverBackgroundColor: "#FFF",
                        //             pointHoverBorderColor: "#FF4961",
                        //             pointHoverRadius: 7
                        //         }]
                        //     },
                        //     options: {
                        //         responsive: true,
                        //         tooltips: {
                        //             enabled: false,
                        //         },
                        //         legend: {
                        //             display: false,
                        //             position: 'top',
                        //             labels: {
                        //                 usePointStyle: true,
                    
                        //             },
                    
                    
                        //         },
                        //         scales: {
                        //             xAxes: [{
                        //                 display: false,
                        //                 gridLines: {
                        //                     display: false,
                        //                     drawBorder: false
                        //                 },
                        //                 scaleLabel: {
                        //                     display: false,
                        //                     labelString: 'Month'
                        //                 }
                        //             }],
                        //             yAxes: [{
                        //                 display: false,
                        //                 gridLines: {
                        //                     display: false,
                        //                     drawBorder: false
                        //                 },
                        //                 scaleLabel: {
                        //                     display: true,
                        //                     labelString: '$ USD'
                        //                 }
                        //             }]
                        //         },
                        //         title: {
                        //             display: false,
                        //         }
                        //     }
                        // });
                    </script>
                <!--</div>-->
            </div>
            
            <div class="col-xl-3 col-md-6 mt-4 mt-md-0">
                <h1 class="hero-title-dark bud-title">Net Annual Income <span id="TotalNetAnnualReturn"><?php echo $CurrencySym; ?><?php echo number_format($TotalNetAnnualReturn,0); ?></span></h1>
                <!--<div class="graph-panel">-->
                <!--    <canvas id="project-bar-new"></canvas>-->
                <!--</div>-->
                <script>
                    // var ctx = document.getElementById("project-bar-new");
                    // ctx.height = 100;
                    // var myChart = new Chart(ctx, {
                    //     type: 'bar',
                    //     data: {
                    //         labels: ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB",],
                    //         datasets: [{
                    //             label: '',
                    //             data: [5, 6, 4.5, 5.5, 3, 6, 4.5, 6, 8, 3, 5.5, 4, 6, 9, 12, 4, 3, 6, 4.5, 6, 8, 4.5, 5, 6, 4.5, 5.5,],
                    //             backgroundColor: '#4c84ff',
                    //         }]
                    //     },
                    //     options: {
                    //         legend: {
                    //             display: false
                    //         },
                    //         scales: {
                    //             xAxes: [{
                    //                 gridLines: {
                    //                     drawBorder: false,
                    //                     display: false
                    //                 },
                    //                 ticks: {
                    //                     display: false, // hide main x-axis line
                    //                     beginAtZero: true
                    //                 },
                    //                 barPercentage: 1,
                    //                 categoryPercentage: 0.2
                    //             }],
                    //             yAxes: [{
                    //                 gridLines: {
                    //                     drawBorder: false, // hide main y-axis line
                    //                     display: false
                    //                 },
                    //                 ticks: {
                    //                     display: false,
                    //                     beginAtZero: true
                    //                 },
                    //             }]
                    //         },
                    //         tooltips: {
                    //             enabled: false
                    //         }
                    //     }
                    // });
    
                </script>
            </div>
            <?php
            $TotalNetCashFlow = $TotalNetAnnualReturn - $FinanceCosts;
            ?>
            <div class="col-xl-3 col-md-6 mt-4 mt-xl-0">
                <h1 class="hero-title-dark bud-title">Net Annual Income<br>(after finance costs)<span id="TotalNetCashFlow"><?php echo $CurrencySym; ?><?php echo number_format($TotalNetCashFlow,0); ?></span></h1>
                <!--<div class="graph-panel">-->
                <!--    <canvas id="top-product-new"></canvas>-->
                <!--</div>-->
                <script>
                    // var ctx = document.getElementById("top-product-new");
                    // ctx.height = 100;
                    // var myChart = new Chart(ctx, {
                    //     type: 'line',
                    //     data: {
                    //         labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
                    //         type: 'line',
                
                    //         datasets: [{
                    //             label: "My First dataset",
                    //             data: [28, 35, 54, 38, 26, 62, 50],
                    //             backgroundColor: "rgba(108, 52, 131,0.35)",
                    //             borderColor: "#5B2C6F",
                    //             borderWidth: 3,
                    //             strokeColor: "#FF4961",
                    //             capBezierPoints: !0,
                    //             pointColor: "#fff",
                    //             pointBorderColor: "#C39BD3",
                    //             pointBackgroundColor: "#FFF",
                    //             pointBorderWidth: 3,
                    //             pointRadius: 5,
                    //             pointHoverBackgroundColor: "#FFF",
                    //             pointHoverBorderColor: "#FF4961",
                    //             pointHoverRadius: 7
                    //         }]
                    //     },
                    //     options: {
                    //         responsive: true,
                    //         tooltips: {
                    //             enabled: false,
                    //         },
                    //         legend: {
                    //             display: false,
                    //             position: 'top',
                    //             labels: {
                    //                 usePointStyle: true,
                
                    //             },
                    //         },
                    //         scales: {
                    //             xAxes: [{
                    //                 display: false,
                    //                 gridLines: {
                    //                     display: false,
                    //                     drawBorder: false
                    //                 },
                    //                 scaleLabel: {
                    //                     display: false,
                    //                     labelString: 'Month'
                    //                 }
                    //             }],
                    //             yAxes: [{
                    //                 display: false,
                    //                 gridLines: {
                    //                     display: false,
                    //                     drawBorder: false
                    //                 },
                    //                 scaleLabel: {
                    //                     display: true,
                    //                     labelString: '$ USD'
                    //                 }
                    //             }]
                    //         },
                    //         title: {
                    //             display: false,
                    //         }
                    //     }
                    // });
                </script>
            </div>
            <div class="col-xl-3 col-md-6 mt-4 mt-xl-0">
                <h1 class="hero-title-dark bud-title">Net Annual Income<br>(after finance costs and tax)<span id="TotalNetCashFlowAfterTax"><?php echo $CurrencySym; ?><?php echo number_format($TotalNetCashFlowAfterTax,0); ?></span></h1>
                <!--<div class="graph-panel">-->
                <!--    <canvas id="btc-income-new"></canvas>-->
                <!--</div>-->
                <script>
                    // var ctx = document.getElementById("btc-income-new");
                    // ctx.height = 100;
                    // var myChart = new Chart(ctx, {
                    //     type: 'line',
                    //     data: {
                    //         labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
                    //         type: 'line',
                
                    //         datasets: [{
                    //             label: "My First dataset",
                    //             data: [28, 35, 36, 48, 46, 42, 60],
                    //             backgroundColor: "rgba(133,133,255,0.35)",
                    //             borderColor: "#5B2C6F",
                    //             borderWidth: 3,
                    //             strokeColor: "#FF4961",
                    //             capBezierPoints: !0,
                    //             pointColor: "#fff",
                    //             pointBorderColor: "#FF4961",
                    //             pointBackgroundColor: "#FFF",
                    //             pointBorderWidth: 3,
                    //             pointRadius: 5,
                    //             pointHoverBackgroundColor: "#FFF",
                    //             pointHoverBorderColor: "#FF4961",
                    //             pointHoverRadius: 7
                    //         }]
                    //     },
                    //     options: {
                    //         responsive: true,
                    //         tooltips: {
                    //             enabled: false,
                    //         },
                    //         legend: {
                    //             display: false,
                    //             position: 'top',
                    //             labels: {
                    //                 usePointStyle: true,
                
                    //             },
                    //         },
                    //         scales: {
                    //             xAxes: [{
                    //                 display: false,
                    //                 gridLines: {
                    //                     display: false,
                    //                     drawBorder: false
                    //                 },
                    //                 scaleLabel: {
                    //                     display: false,
                    //                     labelString: 'Month'
                    //                 }
                    //             }],
                    //             yAxes: [{
                    //                 display: false,
                    //                 gridLines: {
                    //                     display: false,
                    //                     drawBorder: false
                    //                 },
                    //                 scaleLabel: {
                    //                     display: true,
                    //                     labelString: '$ USD'
                    //                 }
                    //             }]
                    //         },
                    //         title: {
                    //             display: false,
                    //         }
                    //     }
                    // });
                </script>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h1 class="hero-title-dark">Forecast Portfolio Value</h1>
                <div class="graph-panel">
                    <div id="growthChart"></div>
                </div>
                <script>
                    var PropertyChartFn = function(isload)
                    {
                        if ( isload == undefined)
                        {
                            isload = false;
                        }
                        var propval             = $("#TotalPropertyValueHidden").val();
                        var portfoliogrowth     = $("#Totalportfoliogrowth").val();
                        var portfoliogrowthtemp = parseFloat(portfoliogrowth) / 100;
                        for( i=1; i <=10; i++)
                        {
                            if ( i == 1 )
                            {
                                TotalValSer = propval;
                                Year =i ;
                            }
                            else
                            {
                                propval     = Math.round(parseFloat(propval) + (parseFloat(propval) * parseFloat(portfoliogrowthtemp)))
                                TotalValSer = TotalValSer + "," + propval
                                Year  = Year +","+ i;
                            }
                        }
                        TotalValSer 	= eval("[" + TotalValSer + "]");
                        Year 	        = eval("[" + Year + "]");
                        var options = {
                        chart: {
                            height: 500,
                            type: 'area',
                            shadow: {
                                enabled: false,
                                color: '#bbb',
                                top: 3,
                                left: 2,
                                blur: 3,
                                opacity: 1
                            },
                            toolbar:{
                              show:false
                            },
                        },dataLabels: {
                            enabled: true,
                            formatter: function (value)
                            {
                                return "<?php echo $CurrencySym; ?> " + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            },
                            style: {
                                fontSize: '14px',
                                fontFamily: 'Poppins, sans-serif',
                                fontWeight: 'bold',
                                colors: undefined
                            },
                            background: {
                                enabled: true,
                                foreColor: '#fff',
                                padding: 5,
                                borderRadius: 0,
                                borderWidth: 1,
                                borderColor: '#fff',
                                opacity: 0.9,
                            },
                        },
                        stroke: {
                            width: 7,   
                            curve: 'smooth'
                        },
                        series: [{
                            name: 'Forecast Value ',
                            data: TotalValSer
                        }],
                        xaxis: {
                            type: 'Years',
                            categories: Year,
                            title: {
                				text: 'Year'
                            }
                        },
                        yaxis: {
                            type: 'Property Rate <?php echo $MapCurrecncy; ?>',
                            title: {
                    			text: 'Property Rate (<?php echo $MapCurrecncy; ?>) '
                            },
                            labels: {
                                show:true,
                                formatter: function (value)
                                {
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                                }
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
                                    return '<?php echo $CurrencySym; ?> ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                                }
                            },   
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shade: 'dark',
                                gradientToColors: [ '#FDD835'],
                                shadeIntensity: 1,
                                type: 'horizontal',
                                opacityFrom: 1,
                                opacityTo: 1,
                                stops: [0, 100, 100, 100]
                            },
                            },
                            markers: {
                                size: 4,
                                opacity: 0.9,
                                colors: ["#FFA41B"],
                                strokeColor: "#fff",
                                strokeWidth: 2,
                                hover: {
                                    size: 7,
                                }
                            },
                            responsive: [{
                                breakpoint: 1440,
                                options: {
                                    chart: {
                                        height: 350,
                                    }
                                }
                            }]
                        }
                        if (!isload)
                        {
                            $("#growthChart").html("");
                        }
                        var chart = new ApexCharts(
                            document.querySelector("#growthChart"),
                            options
                        );
                        chart.render();
                    }
                </script>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h1 class="hero-title-dark">Current Portfolio</h1>
                <div class="projects-panel">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="completed-projects">
                            <thead>
                                <tr>
                                    <td>Purchase Date</td>
                                    <td>Unit Number</td>
                                    <td>Name</td>
                                    <td>Country</td>
                                    <td>Annual Gross Rental $</td>
                                    <td>Operating Expenses $</td>
                                    <td>Finance Costs $</td>
                                    <td>Net Income (after tax) $</td> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                \Property\PropertyClass::Init();
                                $rows = \Property\PropertyClass::GetPropertyComparison("","","","",$ViewCompare);
                                $IsSameCountry = "Y";
                                $PrevCountryId = "";
                                foreach ($rows as $row) 
                                {
                                    $autoid                 = $row["autoid"] ? $row["autoid"] : "" ;
                                    $MyPortFolioName        = $row["property_name"] ?  $row["property_name"] : "";
                                    $Countryname            = $row["country_name"];
                                    $PropertyCountryCode    = $row["country_id"];
                                    $CountryId              = $row["country_id"];
                                    $UnitNumber             = $row["UNIT_NO"] ?  $row["UNIT_NO"] : "";
                                    $DateBought             = $row["purschase_date"] ?  $row["purschase_date"] : "";
                                    $DateCompletion         = $row["completion_date"] ?  $row["completion_date"] : "";
                                    $PricePaid              = $row["marketprice"] ?  $row["marketprice"] : "0";
                                    $CurrentValue           = $row["duvaldynamicprice"] ?  $row["duvaldynamicprice"] : "0";
                                    $ProprtyId              = $row["property_id"];
                                    $weeklyrental           = $row["weeklyrental"] ?  $row["weeklyrental"] : "0";
                                    $TotalRentperweek       = floatval($weeklyrental) * 52;
                                    $managementfee          = round($row["managementfees"] ? $row["managementfees"] : "0");
                                    $adminstrationfee       = 0;
                                    $GroundRent             = $row["landleaserentpa"] ?  $row["landleaserentpa"] : "0";
                                    $OtherCosts             = $row["other"] ?  $row["other"] : "0";
                                    $ltv                    = $row["ltv"] ?  $row["ltv"] : "0";
                                    $interestrate           = $row["interestrate"] ?  $row["interestrate"] : "0";
                                    $initialloanamt         = $row["initialloanamt"] ?  $row["initialloanamt"] : "0";
                                    $currtemp               = $row["baseCur"]  ? $row["baseCur"] : "1" ;
                                    if ( $PrevCountryId != "")
                                    {
                                        if ($PrevCountryId != $CountryId)
                                        {
                                            $IsSameCountry= "N";
                                        }
                                    }
                                    $IndexQry = " SELECT currency_id,symbol,country_code FROM currency_master WHERE currency_id ='{$currentCurrency}' ";
                                    $RowsArr = \DBConn\DBConnection::getQuery( $IndexQry );
                                    foreach($RowsArr as $Rows)
                                    {
                                        $Currency       = $Rows["currency_id"];
                                        $CurrencySym    = $Rows["symbol"];
                                        $countrycode    = $Rows["country_code"];
                                        if($countrycode == "3")
                                        {
                                            $CurrencySym = "Ãƒâ€šÃ‚Â£";
                                        }
                                        elseif($countrycode == "5")
                                        {
                                            $CurrencySym = "ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬";
                                        }
                                    }
                                    $MapCurrecncy = $CurrencySym ." ".$Currency;
                                    $UsdExRateArr =  \Property\PropertyClass::GetCurrExrate($currentCurrency,$currtemp);
                                    foreach($UsdExRateArr as $UsdEx)
                                    {
                                        $UsdExRate = $UsdEx["RATE"] ? $UsdEx["RATE"] :"1";
                                    }
                                    if ($UsdExRate == "")
                                    {
                                        $UsdExRate = 1;
                                    }
                                    $initialloanamt =  floatval($initialloanamt) / floatval($UsdExRate);                 
                                    $FinanceCosts           = ((($interestrate / 12) * $initialloanamt) * 12) /100;
                                    \ajax\ajaxClass::Init();
                                    $Prop           =  \ajax\ajaxClass::AnalyzerResult($autoid,"ARRAY");
                                    $PropertyValue            =  floatval($Prop[1]["PropertyValue"])/ floatval($UsdExRate);
                                    $GrossIncome              =  floatval($Prop[1]["GrossIncome"]) / floatval($UsdExRate);
                                    $MortgagePayment          =  floatval($Prop[1]["MortgagePayment"])/ floatval($UsdExRate);
                                    $OperatigExpTotal         =  floatval($Prop[1]["OperatigExpTotal"])/ floatval($UsdExRate);
                                    $NetAnnualReturn          =  $GrossIncome - $OperatigExpTotal;                
                                    $NetCashFlow              =  floatval($Prop[1]["NetCashFlow"])/ floatval($UsdExRate);
                                    $NetCashFlowAfterTax      =  floatval($Prop[1]["NetCashFlowAfterTax"])/ floatval($UsdExRate);
                                    $TotalInitialCashCost     =  floatval($Prop[0]["TotalInitialCashCost"])/ floatval($UsdExRate);
                                    if($TotalInitialCashCost>0){
                                        $ROI    = $NetCashFlowAfterTax / $TotalInitialCashCost ;
                                    } else {
                                        $ROI    = "0" ;
                                    }
                                    
                                    $TotalYieldroi           = $TotalYieldroi + $ROI;
                                    ?> 
                                    <tr>
                                        <td align=left><?php echo $DateBought; ?></td>
                                        <td align=left><?php echo $UnitNumber; ?></td>
                                        <td align=left><?php echo $MyPortFolioName; ?></td>
                                        <td align=left><?php echo $Countryname; ?></td>
                                        <td align=right><?php echo number_format($GrossIncome,0); ?></td>
                                        <td align=right><?php echo number_format($OperatigExpTotal,0); ?></td>
                                        <td align=right><?php echo number_format($FinanceCosts,0); ?></td>
                                        <td align=right><?php echo number_format($NetCashFlowAfterTax,0); ?></td>                 
                                    </tr>
                                    <?php
                                    $PrevCountryId = $CountryId;
                                }
                                ?>
                            </tbody>
                            <input type='hidden' name='IsSameCountry' id='IsSameCountry'  value='<?php echo $IsSameCountry;  ?>' >
                            <input type='hidden' name='ExrateUsd' id='ExrateUsd' value='<?php echo $ExrateUsd;  ?>' >
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h1 class="hero-title-dark">Yet to Complete Properties</h1>
                <div class="projects-panel">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="completed-projects">
                            <thead>
                                <tr>
                                    <td>Purchase Date</td>
                                    <td>Estimated Completion Date</td>
                                    <td>Unit Number</td>
                                    <td>Name</td>
                                    <td>Country</td>
                                    <td>Purchase Price $</td>
                                    <td>Current Market Value $</td>
                                    <td>Estimated Annual Rental Income $</td>
                                    <td>Estimated Gross Yield</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                \Property\PropertyClass::Init();
                                $rows = \Property\PropertyClass::GetPropertyComparison("","","","NP",$ViewCompare);
                                $IsSameCountry = "Y";
                                $PrevCountryId = "";
                                foreach ($rows as $row) 
                                {
                                    $autoid                 = $row["autoid"] ? $row["autoid"] : "" ;
                                    $MyPortFolioName        = $row["property_name"] ?  $row["property_name"] : "";
                                    $Countryname            = $row["country_name"];
                                    $PropertyCountryCode    = $row["country_id"];
                                    $CountryId              = $row["country_id"];
                                    $UnitNumber             = $row["UNIT_NO"] ?  $row["UNIT_NO"] : "";
                                    $DateBought             = $row["purschase_date"] ?  $row["purschase_date"] : "";
                                    $DateCompletion         = $row["completion_date"] ?  $row["completion_date"] : "";
                                    $PricePaid              = $row["marketprice"] ?  $row["marketprice"] : "0";
                                    $CurrentValue           = $row["duvaldynamicprice"] ?  $row["duvaldynamicprice"] : "0";
                                    $ProprtyId              = $row["property_id"];
                                    $weeklyrental           = $row["weeklyrental"] ?  $row["weeklyrental"] : "0";
                                    $TotalRentperweek       = floatval($weeklyrental) * 52;
                                    $managementfee          = round($row["managementfees"] ? $row["managementfees"] : "0");
                                    $adminstrationfee       = 0;
                                    $GroundRent             = $row["landleaserentpa"] ?  $row["landleaserentpa"] : "0";
                                    $OtherCosts             = $row["other"] ?  $row["other"] : "0";
                                    $ltv                    = $row["ltv"] ?  $row["ltv"] : "0";
                                    $interestrate           = $row["interestrate"] ?  $row["interestrate"] : "0";
                                    $initialloanamt         = $row["initialloanamt"] ?  $row["initialloanamt"] : "0";
                                    $currtemp               = $row["baseCur"]  ? $row["baseCur"] : "1" ;
                                    if ( $PrevCountryId != "")
                                    {
                                        if ($PrevCountryId != $CountryId)
                                        {
                                            $IsSameCountry= "N";
                                        }
                                    }
                                    $IndexQry = " SELECT currency_id,symbol,country_code FROM currency_master WHERE currency_id ='{$currentCurrency}' ";
                                    $RowsArr = \DBConn\DBConnection::getQuery( $IndexQry );
                                    foreach($RowsArr as $Rows)
                                    {
                                        $Currency       = $Rows["currency_id"];
                                        $CurrencySym    = $Rows["symbol"];
                                        $countrycode    = $Rows["country_code"];
                                        if($countrycode == "3")
                                        {
                                            $CurrencySym = "Ãƒâ€šÃ‚Â£";
                                        }
                                        elseif($countrycode == "5")
                                        {
                                            $CurrencySym = "ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬";
                                        }
                                    }
                                    $MapCurrecncy = $CurrencySym ." ".$Currency;
                                    $UsdExRateArr =  \Property\PropertyClass::GetCurrExrate($currentCurrency,$currtemp);
                                    foreach($UsdExRateArr as $UsdEx)
                                    {
                                        $UsdExRate = $UsdEx["RATE"] ? $UsdEx["RATE"] :"1";
                                    }
                                    if ($UsdExRate == "")
                                    {
                                        $UsdExRate = 1;
                                    }
                                    $initialloanamt =  floatval($initialloanamt) / floatval($UsdExRate);                 
                                    $FinanceCosts           = ((($interestrate / 12) * $initialloanamt) * 12) /100;
                                    \ajax\ajaxClass::Init();
                                    $Prop                       =  \ajax\ajaxClass::AnalyzerResult($autoid,"ARRAY");
                                    $PropertyValue              =  floatval($Prop[1]["PropertyValue"])/ floatval($UsdExRate);
                                    $GrossIncome                =  floatval($Prop[1]["GrossIncome"]) / floatval($UsdExRate);
                                    $MortgagePayment            =  floatval($Prop[1]["MortgagePayment"])/ floatval($UsdExRate);
                                    $OperatigExpTotal           =  floatval($Prop[1]["OperatigExpTotal"])/ floatval($UsdExRate);
                                    $NetAnnualReturn            =  $GrossIncome - $OperatigExpTotal;                
                                    $NetCashFlow                =  floatval($Prop[1]["NetCashFlow"])/ floatval($UsdExRate);
                                    $NetCashFlowAfterTax        =  floatval($Prop[1]["NetCashFlowAfterTax"])/ floatval($UsdExRate);
                                    $TotalInitialCashCost       =  floatval($Prop[0]["TotalInitialCashCost"])/ floatval($UsdExRate);
                                    if($TotalInitialCashCost>0){
                                        $ROI    = $NetCashFlowAfterTax / $TotalInitialCashCost ;
                                    } else {
                                        $ROI    = "0" ;
                                    }
                                    
                                    $TotalYieldroi           = $TotalYieldroi + $ROI;
                                    ?> 
                                    <tr>
                                        <td align=left><?= $DateBought; ?></td>
                                        <td align=left><?= $DateCompletion; ?></td>
                                        <td align=left><?= $UnitNumber; ?></td>
                                        <td align=left><?= $MyPortFolioName; ?></td>
                                        <td align=left><?= $Countryname; ?></td>
                                        <td align=left><?= $PricePaid; ?></td>
                                        <td align=left><?= $CurrentValue;?></td>
                                        <td align=left><?= $TotalRentperweek;?></td>
                                        <td align=right>5%</td>
                                    </tr>
                                    <?php
                                    $PrevCountryId = $CountryId;
                                }
                                ?>
                            </tbody>
                            <input type='hidden' name='IsSameCountry' id='IsSameCountry'  value='<?php echo $IsSameCountry;  ?>' >
                            <input type='hidden' name='ExrateUsd' id='ExrateUsd' value='<?php echo $ExrateUsd;  ?>' >
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
        
    }    
    ?>
</div>
<?php include"footer.php"; ?>

<script type="text/javascript">
    <?php
    if ( $ViewCompare=="R" )
    {
        ?>
        var TotalCount =  document.getElementById("TotalCount").value;
        for( i=1; i <= parseFloat(TotalCount); i++)
        {
            NetCashFlowAfterTaxGraph        = $("#NetCashFlowAfterTaxGraph_"+i).val();
            TotalAnnualReturnAfterTaxGraph  = $("#TotalAnnualReturnAfterTaxGraph_"+i).val();
            TotalEquityGraphGraph           = $("#EquityGraph_"+i).val();
            if (parseFloat(i)==1)
            {
                PropertyStringNew = "{ name: 'Property A', data: ["+NetCashFlowAfterTaxGraph+"] }  ";    
                TotalAnnualReturnGraphNew = "{ name: 'Property A', data: ["+TotalAnnualReturnAfterTaxGraph+"] }  ";     
                TotalestimateEquityNew = "{ name: 'Property A', data: ["+TotalEquityGraphGraph+"] }  ";     
                PropertySting= '{ label: "Property A", data: ['+NetCashFlowAfterTaxGraph+'],backgroundColor: "rgba(138,155,240,0.0)", borderWidth: 2, borderColor: "#8a9bf0", pointRadius: 0, }';
                TotalAnnualReturnAfterTaxGraphSring = '{ label: "Property A", data: ['+TotalAnnualReturnAfterTaxGraph+'],backgroundColor: "rgba(138,155,240,0.0)", borderWidth: 2, borderColor: "#8a9bf0", pointRadius: 0, }';
                TotalestimateEquity =  '{ label: "Property A", data: ['+TotalEquityGraphGraph+'],backgroundColor: "rgba(138,155,240,1)", borderWidth: 2, borderColor: "#8a9bf0", pointRadius: 0, }';   
            }
            else if(parseFloat(i)==2)
            {
                PropertyStringNew = PropertyStringNew + ", { name: 'Property B', data: ["+NetCashFlowAfterTaxGraph+"] }  ";  
                TotalAnnualReturnGraphNew = TotalAnnualReturnGraphNew + ", { name: 'Property B', data: ["+TotalAnnualReturnAfterTaxGraph+"] }  ";  
                TotalestimateEquityNew = TotalestimateEquityNew + ", { name: 'Property B', data: ["+TotalEquityGraphGraph+"] }  ";
                PropertySting    = PropertySting + ', { label: "Property B", data: ['+NetCashFlowAfterTaxGraph+'],backgroundColor: "rgba(240,165,91,0.0)", borderWidth: 2, borderColor: "#F0A55B", pointRadius: 0, }';
                TotalAnnualReturnAfterTaxGraphSring = TotalAnnualReturnAfterTaxGraphSring +' , { label: "Property B", data: ['+TotalAnnualReturnAfterTaxGraph+'],backgroundColor: "rgba(240,165,91,0.0)", borderWidth: 2, borderColor: "#F0A55B", pointRadius: 0, }';
                TotalestimateEquity = TotalestimateEquity +' , { label: "Property B", data: ['+TotalEquityGraphGraph+'],backgroundColor: "rgba(240,165,91,1)", borderWidth: 2, borderColor: "#F0A55B", pointRadius: 0, }'; 
            }
            else if(parseFloat(i)==3)
            {
                PropertyStringNew = PropertyStringNew + " , { name: 'Property C', data: ["+NetCashFlowAfterTaxGraph+"] }  ";   
                TotalAnnualReturnGraphNew = TotalAnnualReturnGraphNew + " , { name: 'Property C', data: ["+TotalAnnualReturnAfterTaxGraph+"] }  ";   
                TotalestimateEquityNew = TotalestimateEquityNew + " , { name: 'Property C', data: ["+TotalEquityGraphGraph+"] }  ";
                PropertySting    = PropertySting + ', { label: "Property C", data: ['+NetCashFlowAfterTaxGraph+'],backgroundColor: "rgba(43,212,54,0.0)", borderWidth: 2, borderColor: "#2AD436", pointRadius: 0, }';
                TotalAnnualReturnAfterTaxGraphSring = TotalAnnualReturnAfterTaxGraphSring +' , { label: "Property C", data: ['+TotalAnnualReturnAfterTaxGraph+'],backgroundColor: "rgba(43,212,54,0.0)", borderWidth: 2, borderColor: "#2AD436", pointRadius: 0, }';
                TotalestimateEquity = TotalestimateEquity +' , { label: "Property C", data: ['+TotalEquityGraphGraph+'],backgroundColor: "rgba(43,212,54,1, 46, 38, 60)", borderWidth: 2, borderColor: "#2AD436", pointRadius: 0, }';  
            }
            else
            {
                PropertyStringNew = PropertyStringNew + ", { name: 'Property D', data: ["+NetCashFlowAfterTaxGraph+"] } ";   
                TotalAnnualReturnGraphNew = TotalAnnualReturnGraphNew + ", { name: 'Property D', data: ["+TotalAnnualReturnAfterTaxGraph+"] } ";   
                TotalestimateEquityNew = TotalestimateEquityNew + ", { name: 'Property D', data: ["+TotalEquityGraphGraph+"] } "; 
                PropertySting = PropertySting + ', { label: "Property D", data: ['+NetCashFlowAfterTaxGraph+'],backgroundColor: "rgba(138,155,240,0.0)", borderWidth: 2, borderColor: "#8a9bf0", pointRadius: 0, }';
                TotalAnnualReturnAfterTaxGraphSring = TotalAnnualReturnAfterTaxGraphSring +' , { label: "Property D", data: ['+TotalAnnualReturnAfterTaxGraph+'],backgroundColor: "rgba(138,155,240,0.0)", borderWidth: 2, borderColor: "#8a9bf0", pointRadius: 0, }';
                TotalestimateEquity = TotalestimateEquity +' , { label: "Property D", data: ['+TotalEquityGraphGraph+'],backgroundColor: "rgba(138,155,240,1)", borderWidth: 2, borderColor: "#8a9bf0", pointRadius: 0, }';
            }
        }
        var options = {
            series:   eval("[" + PropertyStringNew + "]") ,
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
                    text:  '<?php echo $MapCurrecncy; ?>',
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
                title: {
                    text: 'Year',
                    style: {
                        fontSize:  '18px',
                        fontWeight:  'bold',
                        fontFamily:  undefined,
                        color:  '#263238'
                    },
                },
                categories:  ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
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
                        return '<?php echo $CurrencySym ?>' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    }
                },
            },
        };
        var chart = new ApexCharts(document.querySelector('#annualCashFlowchart'), options);
        chart.render();
        
        
        
        var options = {
            series:   eval("[" + TotalAnnualReturnGraphNew + "]") ,
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
                    text: '<?php echo $MapCurrecncy; ?>',
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
                title: {
                    text: 'Year',
                    style: {
                        fontSize:  '18px',
                        fontWeight:  'bold',
                        fontFamily:  undefined,
                        color:  '#263238'
                    },
                },
                categories:  ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
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
                        return '<?php echo $CurrencySym ?>' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    }
                },
            },
        };
        var chart = new ApexCharts(document.querySelector('#annualReturnchart'), options);
        chart.render();
        
        
        var options = {
            series:   eval("[" + TotalestimateEquityNew + "]") ,
            chart: {
                height: 350,
                type: 'bar'
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
                    text: '<?php echo $MapCurrecncy; ?>',
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
                title: {
                    text: 'Year',
                    style: {
                        fontSize:  '18px',
                        fontWeight:  'bold',
                        fontFamily:  undefined,
                        color:  '#263238'
                    },
                },
                categories:  ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
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
                        return '<?php echo $CurrencySym ?>' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    }
                },
            },
        };
        var chart = new ApexCharts(document.querySelector('#estimateEquitychart'), options);
        chart.render();    
        <?php
    }
    ?>
    
    
    function get_value(property_ID,field_id)
    {
        if($("#"+field_id).prop('checked')) {
            if($("#propID"+property_ID).val() != null && $("#propID"+property_ID).val() != "")
            {
                
            }
            else
            {
                var inpt = '<input type="hidden" name="prop_ID[]" value="'+property_ID+'" id="propID'+property_ID+'">  ';
                $(".form_value").append(inpt);
            }
        }
        else
        {
            $("#propID"+property_ID).remove();
        }
        $("#checkBox").submit();
    }
    $(document).ready(function()
    {
        var id = "<?php echo $user_id; ?>" ;
        IsSameCountryFn();
        var PropertyCheckedFn = function()
        { 
            var MultiPropertyVal="";
    	    var MultiPropertyId = document.getElementsByName("PropertyChecked");
    	    k=0;
    	    for(i=0;i<=MultiPropertyId.length-1;i++)
    	    {
    		    if(MultiPropertyId[i].checked == true)
    		    {
    		        if ( MultiPropertyVal == "")
    		        {
    		            MultiPropertyVal =  MultiPropertyId[i].value ;
    		            $("#compare").hide();
    		            $("#compareVal").val("N");
    		            $("#MultiPropertyVal").val(MultiPropertyVal);
    		        }
    		        else
    		        {
    		            MultiPropertyVal = MultiPropertyVal + "," + MultiPropertyId[i].value ;
    		            $("#compare").show();
    		            $("#compareVal").val("Y");
    		            $("#MultiPropertyVal").val(MultiPropertyVal);
    		        } 
    			    k++;
    		    }
    	    }
    	    if (parseFloat(k) > 4)
    	    {
    	        $("#IsEligible").val("N");
    	    }
    	    var IsEligible =   $("#IsEligible").val();
    	    if(IsEligible=="")
    	    {
    	        IsEligible = "N";
    	    }
            if(IsEligible == "N")
            {
                //PropertyCheckedNewFn();
            }
        }
        var PropertyCheckedNewFn = function()
        {
            var MultiPropertyVal="";
    	    var MultiPropertyId = document.getElementsByName("PropertyChecked");
    	    for(i=0;i<=MultiPropertyId.length-1;i++)
    	    {
    		    if(MultiPropertyId[i].checked == true)
    		    {
    		        if ( MultiPropertyVal == "")
    		        {
    		            MultiPropertyVal =  MultiPropertyId[i].value ;
    		        }
    		        else
    		        {
    		            MultiPropertyVal = MultiPropertyVal + "," + MultiPropertyId[i].value ;
    		        }
    		    }
    	    }
    	    if ( MultiPropertyVal != "" )
    	    {
    	        var CurrencieVal = $("#CurrencieVal").val();
    	        var testdata = {
                    "propertyid"   : MultiPropertyVal,
                    "id"           : id,
                    "IsSameCurr"    : CurrencieVal
                };
                $.ajax({               
                    url: "<?php echo SITE_BASE_URL;?>/Portfolio/PropertyGetDetails.html",
                    type: "POST",
                    dataType : "json",
                    data:testdata,
                    success : function(data)
                    {
                        $.each(data, function(index, value)
                        {
                            $("#property").html(GetCurrencyConvert(value.Property));
                            $("#TotalPropertyValue").html(GetCurrencyConvert(value.propertyValue));
                            $("#TotalYieldroi").html(GetCurrencyDecimal(value.Yeildroi));
                            $("#Totalrentperweek").html(GetCurrencyConvert(value.rentannual));
                            $("#Totalportfoliogrowth").html(GetCurrencyConvert(value.Portfoliogrowth));
                            propertyValue = Math.round(value.propertyValue);
                            $("#TotalPropertyValueHidden").val(propertyValue);
                            PropertyChartFn();
                        });
                    }
                });
    	    }
    	    else
    	    {
                $("#property").html(0);
                $("#TotalPropertyValue").html(0);
                $("#TotalYieldroi").html(0);
                $("#Totalrentperweek").html(0);
                $("#Totalportfoliogrowth").html(0);
                $("#TotalPropertyValueHidden").val(0);
    	        PropertyChartFn();
    	    }
        }
        if ($(".property-card-body input:checkbox:checked").length > 0)
        {
            $('.icheckbox_square-blue').css('opacity','1');
            PropertyCheckedFn();
        }
        else
        {
            $('.icheckbox_square-blue').css('opacity','0');
            PropertyCheckedFn();
        }
        $('.property-card-body').click(function ()
        {
            $(this).find('input[type=checkbox]').prop("checked", !$(this).find('input[type=checkbox]').prop("checked"));
            $('.property-check').iCheck('update').checked;
            if ($(".property-card-body input:checkbox:checked").length > 0)
            {
                $('.icheckbox_square-blue').css('opacity','1');
                PropertyCheckedFn();
            }
            else
            {
                $('.icheckbox_square-blue').css('opacity','0');
                PropertyCheckedFn();
            }
        });
        PropertyChartFn(true);
    });
    var FnNulltoEmpty = function(Value)
    {
        if (Value == undefined)
        {
            Value = "";
        }
        return Value;
    };
    var IsSameCountryFn = function()
    {
        var IsSameCountry = FnNulltoEmpty($("#IsSameCountry").val());
        if (IsSameCountry == "" || IsSameCountry == undefined )
        {
            IsSameCountry = "N";
        }
        if(IsSameCountry == "Y") { }
        var ExrateUsd = $("#ExrateUsd").val();
        $("#ExrateUsdId").html(ExrateUsd);
    };
    $(document).ready(function(){
        $(".dropdown").each(function(){
            $(".dropdown .btn").on('click', function(){
                if((this).parent().hasClass('opened-drop'))
                {
                    $(this).parent().removeClass('opened-drop');
                } else {
                    $(this).parent().addClass('opened-drop');
                }
            });
        });
    });
</script>
<!-- jqplot chart -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/jquery.jqplot.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/plugins/jqplot.mekkoRenderer.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/plugins/jqplot.mekkoAxisRenderer.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.9/plugins/jqplot.canvasTextRenderer.min.js"></script>


