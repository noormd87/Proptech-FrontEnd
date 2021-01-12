<?php 



@ini_set('output_buffering','Off');

@ini_set('zlib.output_compression',0);

@ini_set('implicit_flush',1);

@ob_end_clean();

set_time_limit(0);

ob_start();



//echo "Header Ends";

ob_flush(); flush();

include "header.php"; 



//echo "Header Ends";

ob_flush(); flush();



\login\loginClass::Init();

$checkSession = \login\loginClass::CheckUserSessionIp();



\Property\PropertyClass::Init();

$countryId = isset($_REQUEST["country"]) ? $_REQUEST["country"] : "";



$CountryLng = isset($_REQUEST["CountryLng"]) ? $_REQUEST["CountryLng"] : "0"; // Arzath - 2020-09-01

$CountryLat = isset($_REQUEST["CountryLat"]) ? $_REQUEST["CountryLat"] : "0"; // Arzath - 2020-09-01

$CenterPoint1 = isset($_REQUEST["CenterPoint1"]) ? $_REQUEST["CenterPoint1"] : "0"; // Arzath - 2020-09-01

$CenterPoint2 = isset($_REQUEST["CenterPoint2"]) ? $_REQUEST["CenterPoint2"] : "0"; // Arzath - 2020-09-01





$MultiPropertyVal           = $_REQUEST["MultiPropertyVal"]         ? $_REQUEST["MultiPropertyVal"]      : "";

$MultiPropertyValNew        = $_REQUEST["MultiPropertyValNew"]      ? $_REQUEST["MultiPropertyValNew"]   : "";

$MultiPropertyValOther      = $_REQUEST["MultiPropertyValOther"]    ? $_REQUEST["MultiPropertyValOther"] : "";





$ChkCodeArr                 = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_CODE_NEW FROM country_master WHERE COUNTRY_CODE ='{$countryId}')");

$CountryCodeNew             = $ChkCodeArr["0"];

   

 

$countryNameArr              = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_NAME FROM country_master WHERE `COUNTRY_CODE` ='" .$countryId."')");

$countryName            	= $countryNameArr["0"];





$rows = \Property\PropertyClass::getCountryDatas($countryId,'');

foreach ($rows as $row) 

{

    $countryName    = $row["COUNTRY_NAME"];

    $CountryUrl     = $row["country_map_url"];

    $CountryLatDB   = $row["Country_Lat"];

    $CountryLngDB   = $row["Country_Lng"];

}



if($CountryLng == 0){

    $CountryLng = $CountryLngDB;

}



if($CountryLat == 0)

{

    $CountryLat = $CountryLatDB;

}





$SearchBtn          = \Property\PropertyClass::$SearchBtn; 

$LocationId         = \Property\PropertyClass::$LocationId;

$Subrub             = \Property\PropertyClass::$Subrub;

$SubrubDp           = \Property\PropertyClass::$SubrubDp;



$Street             = \Property\PropertyClass::$Street;

$StreetId           = \Property\PropertyClass::$StreetId;

$PropertyIds        = \Property\PropertyClass::$PropertyIds;

$stateId            = \Property\PropertyClass::$stateId;

$Zipcode            = \Property\PropertyClass::$Zipcode;

$ZipcodeId          = \Property\PropertyClass::$ZipcodeId;

$Propcountrycode    = \Property\PropertyClass::$Propcountrycode;



if ($Propcountrycode != ""){

    

$ChkCodeArr         = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_CODE_NEW FROM country_master WHERE COUNTRY_CODE ='{$Propcountrycode}')");

$CountryCodeNew     = $ChkCodeArr["0"];

}



$ChkCntArr          = \DBConn\DBConnection::getQueryFetchColumn("(SELECT CURRENCY FROM country_master WHERE COUNTRY_CODE ='{$countryId}')");

$Currency           = $ChkCntArr["0"];

$ChkSymbolArr       = \DBConn\DBConnection::getQueryFetchColumn("(SELECT Currency_Symbol FROM country_master WHERE COUNTRY_CODE ='{$countryId}')");

$CurrencySym        = $ChkSymbolArr["0"] ;



if($countryId == "3")

    $CurrencySym    = "£";



$MapCurrecncy       = $CurrencySym ." ".$Currency;

$TodayDate          = date("d-m-Y");

$datasource         = isset($_REQUEST["datasource"])    ? $_REQUEST["datasource"]   : "PriPaid";

$BuildType          = isset($_REQUEST["BuildType"])     ? $_REQUEST["BuildType"]    : "STANDARD";

$propertyType       = isset($_REQUEST["propertyType"])  ? $_REQUEST["propertyType"] : "A";

$bedrooms           = isset($_REQUEST["bedrooms"])      ? $_REQUEST["bedrooms"]     : "-1";

$datefilter         = isset($_REQUEST["datefilter"])    ? $_REQUEST["datefilter"]   : "01-01-2020 - 01-15-2020";

$datefilter1        = isset($_REQUEST["datefilter1"])   ? $_REQUEST["datefilter1"]  : $TodayDate;

$datefilter2        = isset($_REQUEST["datefilter2"])   ? $_REQUEST["datefilter2"]  : $TodayDate;

$SuburbLocation        = isset($_REQUEST["SuburbLocation"])   ? $_REQUEST["SuburbLocation"]  : "SB";



ob_flush(); flush();

?>

<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" />

<!-- apexchart -->  

<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/apexcharts/css/apexcharts.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/apexcharts/css/apexcharts.min.css.map">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.15.5/apexcharts.min.js"></script>



<style type="text/css" >

      /* Always set the map height explicitly to define the size of the div

       * element that contains the map. */

      #map {

        height: 500px;

        width: 100%;

      }

      

      #map1{

        height: 500px;

        width: 100%; 

      }

      #map2{

        height: 500px;

        width: 100%; 

      }

      #map3{

        height: 500px;

        width: 100%; 

      }

      #map4{

        height: 500px;

        width: 100%; 

      }

      #map5{

        height: 500px;

        width: 100%; 

      }
      
      #map6{

        height: 300px;

        width: 100%; 

      }

      

      /* Optional: Makes the sample page fill the window. */

     

      #description {

        font-family: Roboto;

        font-size: 15px;

        font-weight: 300;

      }



      #infowindow-content .title {

        font-weight: bold;

      }



      #infowindow-content {

        display: none;

      }



      #map #infowindow-content {

        display: inline;

      }

      #map1 #infowindow-content {

        display: inline;

      }

      #map2 #infowindow-content {

        display: inline;

      }

      #map3 #infowindow-content {

        display: inline;

      }

      #map4 #infowindow-content {

        display: inline;

      }

      #map5 #infowindow-content {

        display: inline;

      }

      #map6 #infowindow-content {

        display: inline;

      }

  



      .pac-card {

        margin: 10px 10px 0 0;

        border-radius: 2px 0 0 2px;

        box-sizing: border-box;

        -moz-box-sizing: border-box;

        outline: none;

        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);

        background-color: #fff;

        font-family: Roboto;

      }



      #pac-container {

        padding-bottom: 12px;

        margin-right: 12px;

      }



      .pac-controls {

        display: inline-block;

        padding: 5px 11px;

      }



      .pac-controls label {

        font-family: Roboto;

        font-size: 13px;

        font-weight: 300;

      }



      #pac-input {

        background-color: #fff;

        font-family: Roboto;

        font-size: 15px;

        font-weight: 300;

        margin-left: 12px;

        padding: 0 11px 0 13px;

        text-overflow: ellipsis;

        width: 400px;

      }



      #pac-input:focus {

        border-color: #4d90fe;

      }



      #title {

        color: #fff;

        background-color: #4d90fe;

        font-size: 25px;

        font-weight: 500;

        padding: 6px 12px;

      }

      #target {

        width: 345px;

      }

      

      

      .filter-box {

          padding: 15px;

          background-color: #fff;

          box-shadow: 0px 3px 10px rgba(0,0,0,.1);

          border-radius: 5px;

          min-width: 350px;

        }

        .filter-box-inner{

          max-width: 350px;

        }

        .filter-box-inner .form-group {

            margin-bottom: 5px;

        }

        

        .btn-block-group{

            display: flex !important;

        }

        .btn-block-group .btn{

          width: 100%;

        }

        

        .btn-block-group .iradio_line {

            width: 100%;

            border-radius: 0;

            background-color: #007bff;

            margin-top: 0px;

            padding: 7px 5px 7px 20px;

        }

        .iradio_line.checked {

          background-color: #0069d9;  

        }

        .btn-block-group .iradio_line:hover{

          background-color: #0069d9;

        }

        

        .btn-block-group .icheckbox_line .icheck_line-icon, .btn-block-group .iradio_line .icheck_line-icon {

            left: 5px;

        }

        

        .filter-card label,.filter-card .btn,.filter-card .form-control{

          font-size: 12px;

        }

        .filter-card .form-control{

          min-height: 30px;

        }

        .filter-card .nav-link {

            display: block;

            padding: 7px 1rem;

        }

        .filter-card .dropdown,.dropdown-group{

          display: inline-block;

        }

        .custom-form-control{

          border-radius: 5px;

          padding: 5px 10px;

          border: 1px solid #eee;

          min-height: 34px;

        }

        .nav .nav-list:not(:last-child){

          padding-right: 15px;

        }

        .quartiles tr td{

          font-size: 12px;

          line-height: 18px;

        }

        .result-filter .card-header {

            padding: 1.25rem 1.25rem 0 1.25rem;

            background-color: #fff;

        }

        

        .loader-text-box{position: relative}

        .icon-container {

          position: absolute;

          right: 10px;

          top: calc(50% - 10px);

        }

        .loader {

          position: relative;

          height: 20px;

          width: 20px;

          display: inline-block;

          animation: around 5.4s infinite;

        }

        

        @keyframes around {

          0% {

            transform: rotate(0deg)

          }

          100% {

            transform: rotate(360deg)

          }

        }

        

        .loader::after, .loader::before {

          content: "";

          background: white;

          position: absolute;

          display: inline-block;

          width: 100%;

          height: 100%;

          border-width: 2px;

          border-color: #333 #333 transparent transparent;

          border-style: solid;

          border-radius: 20px;

          box-sizing: border-box;

          top: 0;

          left: 0;

          animation: around 0.7s ease-in-out infinite;

        }

        

        .loader::after {

          animation: around 0.7s ease-in-out 0.1s infinite;

          background: transparent;

        }



        

       

    </style>

    

<?php

ob_flush(); flush();

?>



<form name="frmSearch" id="frmSearch" method="post" action="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=<?php echo $countryId; ?>"  onsubmit="return validateForm()"  >   

    <!-- Right Wrapper Start -->

    <div class="right-wrapper">

        <!-- Inner Content Start-->

        <div class="inner-wrapper"> 

             <!-- Location Header  Start -->
             
             <?php
             
                if($Subrub != "" || $Street != "" )
                   $ImageHide = "none;"
             ?>

             <div class="global-search" style="

            

            <?php

            if($_SERVER['REQUEST_METHOD'] != "POST")

            {

                if($countryId == 3)

                {

                    ?>

                        background-image:url('<?= SITE_BASE_URL;?>dashboard/assets/images/uk-search-bg.png');

                    

                    <?php

                }

                if($countryId == 2)

                {

                    ?>

                    background-image:url('<?= SITE_BASE_URL;?>dashboard/assets/images/au-search-bg.png');

                    <?php

                }

                if($countryId == 1)

                {

                    ?>

                        background-image:url('<?= SITE_BASE_URL;?>dashboard/assets/images/nz-search-bg.png');

                    <?php

                }

            }

            ?>

            

            display:<?php echo $ImageHide ?>">
                 
              <?php

            if($_SERVER['REQUEST_METHOD'] != "POST")

            {

                if($countryId == 3)

                {

                    ?>

                        <div class="text" style=" display:<?php echo $ImageHide ?>" >

                         <h1>United Kingdom</h1>
                         
                     </div>
                    

                    <?php

                }

                if($countryId == 2)

                {

                    ?>

                   <div class="text" style=" display:<?php echo $ImageHide ?>" >

                         <h1>Australia</h1>
                         
                 </div>

                    <?php

                }

                if($countryId == 1)

                {

                    ?>

                        <div class="text" style=" display:<?php echo $ImageHide ?>" >

                             <h1>New Zealand</h1>
                             
                         </div>

                    <?php

                }

            }

            ?>


                <div class="search-time-holder">

                    <div class="search-bar">
                        
                        

                        <div class="input-group loader-text-box" id="SubrubLocationBox" >
                            <select class="custom-form-control" name="SuburbLocation" id="SuburbLocation" <?php if($countryId == 3){ ?> style='display:none;' <?php   } ?> >
                                <option value="SB">Suburb</option>
                                <option value="AD">Address</option>
                            </select>

                            <input class="form-control class_sub" type="text" name="Subrub" id="Suburb" placeholder="Suburb" value="<?php echo $Subrub;?>" autocomplete=off />

                            <input class="form-control" type="hidden" name="LocationId" id="LocationId" placeholder="LocationId" value="<?php echo $LocationId;?>" >

                            <input class="form-control" type="hidden" name="myportfoliocountry" id="myportfoliocountry"  value="<?php echo $CountryCodeNew;?>" >

                            <input class="form-control" type="hidden" name="CountryLng" id="CountryLng"  value="<?php echo $CountryLng;?>" >

                            <input class="form-control" type="hidden" name="CountryLat" id="CountryLat"  value="<?php echo $CountryLat;?>" >

                            <input class="form-control" type="hidden" name="CenterPoint1" id="CenterPoint1"  value="<?php echo $CenterPoint1;?>" >

                            <input class="form-control" type="hidden" name="CenterPoint2" id="CenterPoint2"  value="<?php echo $CenterPoint2;?>" >

                            <input class="form-control" type="hidden" name="bedrooms" id="bedrooms"  value="<?php echo $bedrooms;?>" >

                            <div class="icon-container LoaderSuburb d-none">

                                <i class="loader"></i>

                            </div>

                        </div>
                        
                        <div class="input-group loader-text-box" id="StreetLocationBox" style='display:none;'>

                            <input class="form-control" type="text" name="Street" id="Street" placeholder="Street"  value="<?php echo $Street;?>" autocomplete="off" />
                            <input class="form-control" type="hidden" name="StreetId" id="StreetId" placeholder="StreetId"  value="<?php echo $StreetId;?>" >
                            <input class="form-control" type="hidden" name="stateId" id="stateId" placeholder="stateId"  value="<?php echo $stateId;?>" >
                            <input class="form-control" type="hidden" name="PropertyIds" id="PropertyIds" placeholder="PropertyIds"  value="<?php echo $PropertyIds;?>" >
                                   

                            <div class="icon-container LoaderSuburb d-none">

                                <i class="loader"></i>

                            </div>

                        </div>
                        
                        
                        <?php

                        if($countryId != 3)

                        {

                            ?>

                            <button type="submit" class="btn btn-orange">Search</button>

                            <?php

                        }

                        ?>

                    </div>

                     <?php

                        if($countryId == 3)

                        {

                            ?>

                            <div class="time-slots date-drops">

                                <div class="group-drops">

                                    <input class="form-control datepicker" type="text" name="datefilter1" id="datefilter1" placeholder="from"/>

                                    <input class="form-control datepicker" type="text" name="datefilter2" id="datefilter2" placeholder="to" />

                                </div>

                                <button type="submit" class="btn btn-orange">Search</button>

                            </div>

                            <?php

                        }

                    ?>

                </div>

             </div>

            <!-- Location Header End -->

            

            

            <?php 

            

            if($LocationId != "" && $countryId == 3)

            {

            

            ?>

          



            <div class="residential-data mt-0">

                <h1 class="hero-title-dark">Property Availability</h1>

                <!-- Nav tabs -->

                <ul class="nav nav-pills main-pills">

                    <li class="nav-item">

                        <a class="nav-link active" data-toggle="pill" href="#overview">Overview</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" data-toggle="pill" href="#demographics">Demographics</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" data-toggle="pill" href="#analyse">Analyse</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" data-toggle="pill" href="#properties">Properties</a>

                    </li>

                    <li class="nav-item" style='display:none;'>

                        <a class="nav-link" data-toggle="pill" href="#lno">Land & Ownership</a>

                    </li>

                    <!--<li class="nav-item">-->

                    <!--    <a class="nav-link" data-toggle="pill" href="#planning">Planning</a>-->

                    <!--</li>-->

                    <!--<li class="nav-item">-->

                    <!--    <a class="nav-link" data-toggle="pill" href="#scout">Scout</a>-->

                    <!--</li>-->

                </ul>

                

                <?php

                     ob_flush(); flush();

                     $OverViewDataSrc="SalesOverView";

                     

                     $TempArr = array();

                     $TempSalesListArr = array();

                     

                     //PriPaid,sqfiSales,Discnt,GrsYld,SalesList,SalesTrans,DaysMarSales

                     

                     $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValueAjax("forDet",$LocationId,$OverViewDataSrc,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$m);

                    

                     $TotalPriPaid = 0;

                     $TotalsqfiSales = 0;

                     $TotalDiscnt = 0;

                     $TotalGrsYld = 0;

                     $TotalSalesList = 0;

                     $TotalSalesTrans = 0;

                     $TotalsqfiRent = 0;

                     $TotalRentList = 0;

                     $TotalDaysMarSales = 0;

                     $TotalDaysMarSalesGraph = "";

                     $TotalGraphPricePaid = "";

                     $MonthdateTemp = "";

                     $TotalSalesListGraph = "";

                     $m = 0;

                     foreach($productDetailsArr as $RsPD){

                         

                          $DatasourcePoint           = isset($RsPD["datasource"]) ? $RsPD["datasource"] : "0"; 

                          

                          $DataMonthYr               = isset($RsPD["MonthYr"]) ? $RsPD["MonthYr"] : ""; 

                       

                           

                           

                          

                          if($DatasourcePoint == "PriPaid" ){

                               $MedianPriPaid         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalPriPaid          = floatval($TotalPriPaid) + floatval($MedianPriPaid);

                               $m++;

                               

                               if ( $TotalGraphPricePaid == "" )

                                {

                                    $TotalGraphPricePaid = round($MedianPriPaid);

                                }

                                else

                                {

                                    $TotalGraphPricePaid = round($MedianPriPaid). "," .$TotalGraphPricePaid;

                                }

                                

                                if ( $MonthdateTemp == "" ){

                                     $MonthdateTemp = $DataMonthYr;

                                }else{

                                     $MonthdateTemp = $DataMonthYr ."','". $MonthdateTemp ;

                                }

                          }

                          

                          if($DatasourcePoint == "sqfiSales" ){

                               $MediansqfiSales         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalsqfiSales          = floatval($TotalsqfiSales) + floatval($MediansqfiSales);

                          }

                          

                          if($DatasourcePoint == "Discnt" ){

                               $MedianDiscnt         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalDiscnt          = floatval($TotalDiscnt) + floatval($MedianDiscnt);

                          }

                          

                          if($DatasourcePoint == "GrsYld" ){

                               $MedianGrsYld         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalGrsYld          = floatval($TotalGrsYld) + floatval($MedianGrsYld);

                          }

                          

                          if($DatasourcePoint == "SalesList" ){

                               $MedianSalesList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalSalesList          = floatval($TotalSalesList) + floatval($MedianSalesList);

                               

                                if ( $TotalSalesListGraph == "" )

                                {

                                    $TotalSalesListGraph = round($MedianSalesList);

                                }

                                else

                                {

                                    $TotalSalesListGraph = round($MedianSalesList). "," .$TotalSalesListGraph;

                                }

                                

                                

                                  

                               $NinthPercentileSales    = isset($RsPD["NinthPercentile"]) ? $RsPD["NinthPercentile"] : "0";

                               $UpperQuartileSales      = isset($RsPD["UpperQuartile"]) ? $RsPD["UpperQuartile"] : "0";

                               $LowerQuartileSales      = isset($RsPD["LowerQuartile"]) ? $RsPD["LowerQuartile"] : "0";

                               $SupplySales             = isset($RsPD["Supply"]) ? $RsPD["Supply"] : "0";

                               

                               $TempSalesListArr[] = array(  

                                                    "MonthDate_".$m => $DataMonthYr,

                                                    "NinthPercentile_".$m => $NinthPercentileSales, 

                                                    "UpperQuartile_".$m => $UpperQuartileSales , 

                                                    "LowerQuartile_".$m => $LowerQuartileSales , 

                                                    "Supply_".$m => $SupplySales , 

                                                    "Median_".$m => $MedianDaysMarSales  

                                                ); 

                          }

                          

                          if($DatasourcePoint == "SalesTrans" ){

                               $MedianSalesTrans         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalSalesTrans          = floatval($TotalSalesTrans) + floatval($MedianSalesTrans);

                          }

                         

                         if($DatasourcePoint == "sqfiRent" ){

                               $MediansqfiRent         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalsqfiRent          = floatval($TotalsqfiRent) + floatval($MediansqfiRent);

                          }

                          

                          if($DatasourcePoint == "RentList" ){

                               $MedianRentList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalRentList        = floatval($TotalRentList) + floatval($MedianRentList);

                          }

                          

                          if($DatasourcePoint == "DaysMarSales" ){

                               $MedianDaysMarSales   = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalDaysMarSales   = floatval($TotalDaysMarSales) + floatval($MedianDaysMarSales);

                               

                               $NinthPercentileSales    = isset($RsPD["NinthPercentile"]) ? $RsPD["NinthPercentile"] : "0";

                               $UpperQuartileSales      = isset($RsPD["UpperQuartile"]) ? $RsPD["UpperQuartile"] : "0";

                               $LowerQuartileSales      = isset($RsPD["LowerQuartile"]) ? $RsPD["LowerQuartile"] : "0";

                               $SupplySales             = isset($RsPD["Supply"]) ? $RsPD["Supply"] : "0";

                               

                               $TempArr[] = array(  

                                                    "MonthDate_".$m => $DataMonthYr,

                                                    "NinthPercentile_".$m => $NinthPercentileSales, 

                                                    "UpperQuartile_".$m => $UpperQuartileSales , 

                                                    "LowerQuartile_".$m => $LowerQuartileSales , 

                                                    "Supply_".$m => $SupplySales , 

                                                    "Median_".$m => $MedianDaysMarSales  

                                                ); 

                        

                               

                                if ( $TotalDaysMarSalesGraph == "" )

                                {

                                    $TotalDaysMarSalesGraph = round($MedianDaysMarSales);

                                }

                                else

                                {

                                    $TotalDaysMarSalesGraph = round($MedianDaysMarSales). "," .$TotalDaysMarSalesGraph;

                                }

                          }

                          

                      

                          

                          

                     }

                     

                     if($m >0)$PricePaid             =  $TotalPriPaid / $m;

                     if($m >0)$scift                 =  $TotalsqfiSales / $m;

                     if($m >0)$PaidDiscount          =  $TotalDiscnt / $m;

                     if($m >0)$GrossYield            =  $TotalGrsYld / $m;

                     if($m >0)$SalesListing          =  $TotalSalesList / $m;

                     if($m >0)$SalesTransactions     =  $TotalSalesTrans / $m;

                     if($m >0)$sqfiRent              =  $TotalsqfiRent / $m;

                     if($m >0)$RentList              =  $TotalRentList / $m;

                     

                     $TempEachArr           = $TempArr;

                     $TempSalesList         = $TempSalesListArr;

                     

                     ob_flush(); flush();

                     

                      

                     

                     //PriPaid,sqfiSales,Discnt,GrsYld,SalesList,SalesTrans

                     

                     $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValueAjax("forDet",$LocationId,$OverViewDataSrc,$BuildType,1,$propertyType,$datefilter1,$datefilter2,$m);

                    

                     $TotalPriPaidBd1 = 0;

                     $TotalsqfiSalesBd1 = 0;

                     $TotalDiscntBd1 = 0;

                     $TotalGrsYldBd1 = 0;

                     $TotalSalesListBd1 = 0;

                     $TotalSalesTransBd1 = 0;

                     $TotalsqfiRentBd1 = 0;

                     $TotalRentListBd1 = 0;

                     $TotalGraphPricePaid1 = "";

                     $n = 0;

                     foreach($productDetailsArr as $RsPD){

                         

                          $DatasourcePoint           = isset($RsPD["datasource"]) ? $RsPD["datasource"] : "0"; 

                          

                          if($DatasourcePoint == "PriPaid" ){

                               $MedianPriPaid         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalPriPaidBd1          = floatval($TotalPriPaidBd1) + floatval($MedianPriPaid);

                               $n++;

                               

                                if ( $TotalGraphPricePaid1 == "" )

                                {

                                    $TotalGraphPricePaid1 = round($MedianPriPaid);

                                }

                                else

                                {

                                    $TotalGraphPricePaid1 =  $TotalGraphPricePaid1. "," .round($MedianPriPaid);

                                }

                                

                          }

                          

                          if($DatasourcePoint == "sqfiSales" ){

                               $MediansqfiSales         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalsqfiSalesBd1          = floatval($TotalsqfiSalesBd1) + floatval($MediansqfiSales);

                          }

                          

                          if($DatasourcePoint == "sqfiRent" ){

                               $MediansqfiRent         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalsqfiRentBd1          = floatval($TotalsqfiRentBd1) + floatval($MediansqfiRent);

                          }

                         

                          if($DatasourcePoint == "Discnt" ){

                               $MedianDiscnt         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalDiscntBd1          = floatval($TotalDiscntBd1) + floatval($MedianDiscnt);

                          }

                          

                          if($DatasourcePoint == "GrsYld" ){

                               $MedianGrsYld         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalGrsYldBd1          = floatval($TotalGrsYldBd1) + floatval($MedianGrsYld);

                          }

                          

                          if($DatasourcePoint == "SalesList" ){

                               $MedianSalesList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalSalesListBd1          = floatval($TotalSalesListBd1) + floatval($MedianSalesList);

                          }

                          

                          if($DatasourcePoint == "RentList" ){

                               $MedianRentList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalRentListBd1    = floatval($TotalRentListBd1) + floatval($MedianRentList);

                          }

                          

                          

                          if($DatasourcePoint == "SalesTrans" ){

                               $MedianSalesTrans         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalSalesTransBd1          = floatval($TotalSalesTransBd1) + floatval($MedianSalesTrans);

                          }

                         

                     }

                     

                    

                    

                     

                     if($n >0)$PricePaidBd1             =  $TotalPriPaidBd1 / $n;

                     if($n >0)$sciftBd1                 =  $TotalsqfiSalesBd1 / $n;

                     if($n >0)$PaidDiscountBd1          =  $TotalDiscntBd1 / $n;

                     if($n >0)$GrossYieldBd1            =  $TotalGrsYldBd1 / $n;

                     if($n >0)$SalesListingBd1          =  $TotalSalesListBd1 / $n;

                     if($n >0)$SalesTransactionsBd1     =  $TotalSalesTransBd1 / $n;

                     if($n >0)$sqfiRentBd1              =  $TotalsqfiRentBd1 / $n;

                     if($n >0)$RentListBd1              =  $TotalRentListBd1 / $n;

                     



                     

                     ob_flush(); flush();

                     

                       //PriPaid,sqfiSales,Discnt,GrsYld,SalesList,SalesTrans

                     

                     $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValueAjax("forDet",$LocationId,$OverViewDataSrc,$BuildType,2,$propertyType,$datefilter1,$datefilter2,$m);

                    

                     $TotalPriPaidBd2 = 0;

                     $TotalsqfiSalesBd2 = 0;

                     $TotalDiscntBd2 = 0;

                     $TotalGrsYldBd2 = 0;

                     $TotalSalesListBd2 = 0;

                     $TotalSalesTransBd2 = 0;

                     $TotalsqfiRentBd2 = 0;

                     $TotalRentListBd2 = 0;

                     $TotalGraphPricePaid2 = "";

                     $n = 0;

                     foreach($productDetailsArr as $RsPD){

                         

                          $DatasourcePoint           = isset($RsPD["datasource"]) ? $RsPD["datasource"] : "0"; 

                          

                          if($DatasourcePoint == "PriPaid" ){

                               $MedianPriPaid         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalPriPaidBd2          = floatval($TotalPriPaidBd2) + floatval($MedianPriPaid);

                               $n++;

                               

                               if ( $TotalGraphPricePaid2 == "" )

                                {

                                    $TotalGraphPricePaid2 = round($MedianPriPaid);

                                }

                                else

                                {

                                    $TotalGraphPricePaid2 = $TotalGraphPricePaid2. "," .round($MedianPriPaid) ;

                                }

                          }

                          

                          if($DatasourcePoint == "sqfiSales" ){

                               $MediansqfiSales         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalsqfiSalesBd2          = floatval($TotalsqfiSalesBd2) + floatval($MediansqfiSales);

                          }

                          

                          if($DatasourcePoint == "Discnt" ){

                               $MedianDiscnt         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalDiscntBd2          = floatval($TotalDiscntBd2) + floatval($MedianDiscnt);

                          }

                          

                          if($DatasourcePoint == "GrsYld" ){

                               $MedianGrsYld         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalGrsYldBd2          = floatval($TotalGrsYldBd2) + floatval($MedianGrsYld);

                          }

                          

                          if($DatasourcePoint == "SalesList" ){

                               $MedianSalesList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalSalesListBd2          = floatval($TotalSalesListBd2) + floatval($MedianSalesList);

                          }

                          

                          if($DatasourcePoint == "SalesTrans" ){

                               $MedianSalesTrans         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalSalesTransBd2          = floatval($TotalSalesTransBd2) + floatval($MedianSalesTrans);

                          }

                          

                          if($DatasourcePoint == "sqfiRent" ){

                               $MediansqfiRent         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalsqfiRentBd2        = floatval($TotalsqfiRentBd2) + floatval($MediansqfiRent);

                          }

                          

                          if($DatasourcePoint == "RentList" ){

                               $MedianRentList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalRentListBd2        = floatval($TotalRentListBd2) + floatval($MedianRentList);

                          }

                         

                     }

                     

                     if($n >0)$PricePaidBd2             =  $TotalPriPaidBd2 / $n;

                     if($n >0)$sciftBd2                 =  $TotalsqfiSalesBd2 / $n;

                     if($n >0)$PaidDiscountBd2          =  $TotalDiscntBd2 / $n;

                     if($n >0)$GrossYieldBd2            =  $TotalGrsYldBd2 / $n;

                     if($n >0)$SalesListingBd2          =  $TotalSalesListBd2 / $n;

                     if($n >0)$SalesTransactionsBd2     =  $TotalSalesTransBd2 / $n;

                     if($n >0)$sqfiRentBd2              =  $TotalsqfiRentBd2 / $n;

                     if($n >0)$RentListBd2              =  $TotalRentListBd2 / $n;

                     

                     ob_flush(); flush();

                     

                     

                      //PriPaid,sqfiSales,Discnt,GrsYld,SalesList,SalesTrans

                     

                     $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValueAjax("forDet",$LocationId,$OverViewDataSrc,$BuildType,3,$propertyType,$datefilter1,$datefilter2,$m);

                    

                     $TotalPriPaidBd3 = 0;

                     $TotalsqfiSalesBd3 = 0;

                     $TotalDiscntBd3 = 0;

                     $TotalGrsYldBd3 = 0;

                     $TotalSalesListBd3 = 0;

                     $TotalSalesTransBd3 = 0;

                     $TotalsqfiRentBd3 = 0;

                     $TotalRentListBd3 = 0;

                     $TotalGraphPricePaid3 = "";

                     $n = 0;

                     foreach($productDetailsArr as $RsPD){

                         

                          $DatasourcePoint           = isset($RsPD["datasource"]) ? $RsPD["datasource"] : "0"; 

                          

                          if($DatasourcePoint == "PriPaid" ){

                               $MedianPriPaid         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalPriPaidBd3          = floatval($TotalPriPaidBd3) + floatval($MedianPriPaid);

                               $n++;

                               

                               if ( $TotalGraphPricePaid3 == "" )

                                {

                                    $TotalGraphPricePaid3 = round($MedianPriPaid);

                                }

                                else

                                {

                                    $TotalGraphPricePaid3 = round($MedianPriPaid). "," . $TotalGraphPricePaid3;

                                }

                          }

                          

                          if($DatasourcePoint == "sqfiSales" ){

                               $MediansqfiSales         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalsqfiSalesBd3          = floatval($TotalsqfiSalesBd3) + floatval($MediansqfiSales);

                          }

                          

                          if($DatasourcePoint == "Discnt" ){

                               $MedianDiscnt         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalDiscntBd3          = floatval($TotalDiscntBd3) + floatval($MedianDiscnt);

                          }

                          

                          if($DatasourcePoint == "GrsYld" ){

                               $MedianGrsYld         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalGrsYldBd3          = floatval($TotalGrsYldBd3) + floatval($MedianGrsYld);

                          }

                          

                          if($DatasourcePoint == "SalesList" ){

                               $MedianSalesList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalSalesListBd3          = floatval($TotalSalesListBd3) + floatval($MedianSalesList);

                          }

                          

                          if($DatasourcePoint == "SalesTrans" ){

                               $MedianSalesTrans         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalSalesTransBd3          = floatval($TotalSalesTransBd3) + floatval($MedianSalesTrans);

                          }

                          

                           if($DatasourcePoint == "sqfiRent" ){

                               $MediansqfiRent         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalsqfiRentBd3        = floatval($TotalsqfiRentBd3) + floatval($MediansqfiRent);

                          }

                          

                          if($DatasourcePoint == "RentList" ){

                               $MedianRentList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";

                               $TotalRentListBd3        = floatval($TotalRentListBd3) + floatval($MedianRentList);

                          }

                         

                     }

                     

                     if($n >0)$PricePaidBd3             =  $TotalPriPaidBd3 / $n;

                     if($n >0)$sciftBd3                 =  $TotalsqfiSalesBd3 / $n;

                     if($n >0)$PaidDiscountBd3          =  $TotalDiscntBd3 / $n;

                     if($n >0)$GrossYieldBd3            =  $TotalGrsYldBd3 / $n;

                     if($n >0)$SalesListingBd3          =  $TotalSalesListBd3 / $n;

                     if($n >0)$SalesTransactionsBd3     =  $TotalSalesTransBd3 / $n;

                     if($n >0)$sqfiRentBd3              =  $TotalsqfiRentBd3 / $n;

                     if($n >0)$RentListBd3              =  $TotalRentListBd3 / $n;

                     ob_flush(); flush(); 

                     

                     

                     //echo 'TotalGraphPricePaid3='. $TotalGraphPricePaid3.'<br>';

                   //   echo 'TotalGraphPricePaid2='. $TotalGraphPricePaid2.'<br>';

                     //  echo 'TotalGraphPricePaid1='. $TotalGraphPricePaid1.'<br>';

                      //  echo 'TotalGraphPricePaid='. $TotalGraphPricePaid.'<br>';

                        

                     

                ?>



                <!-- Tab panes -->

                <div class="tab-content">

                    <div class="tab-pane active" id="overview">

                        <div class="row no-gutters">

                            <div class="col-xl-6">

                                <div class="rd-content">

                                    

                                    <div class="place-type">

                                        <h4><?php echo $Subrub;?></h4>

                                        <select name="type" id="type" class="form-control">

                                            <option value="flat">Flat</option>

                                            <option value="flat">House</option>

                                        </select>

                                        <div class="build">

                                            <div class="form-check-inline">

                                                <label class="form-check-label">

                                                    Build Type

                                                </label>

                                            </div>

                                            <div class="form-check-inline">

                                                <label class="form-check-label">

                                                    <input type="radio" checked class="form-check-input" value='STANDARD' name="BuildType">All

                                                </label>

                                            </div>

                                            <div class="form-check-inline">

                                                <label class="form-check-label">

                                                    <input type="radio" class="form-check-input" value='SECONDARY' name="BuildType">Secondary

                                                </label>

                                            </div>

                                            <div class="form-check-inline disabled">

                                                <label class="form-check-label">

                                                    <input type="radio" class="form-check-input" value='NEW_BUILD' name="BuildType">New Build

                                                </label>

                                            </div>

                                            <div class="d-inline-block">

                                                <input type="button" class="btn btn-orange" onclick="BuildTypeFN()" value="Confirm" >

                                            </div>

                                        </div>

                                    </div>

                                    <!-- Nav pills -->

                                    <ul class="nav nav-pills sub-pills" style='display:none'>

                                        <li class="nav-item">

                                            <a class="nav-link active" data-toggle="pill" href="#sales">SALES</a>

                                        </li>

                                        <li class="nav-item">

                                            <a class="nav-link" data-toggle="pill" href="#rent">RENT</a>

                                        </li>

                                    </ul>

                                    

                                    <!-- Tab panes -->

                                    <div class="tab-content">

                                        <div class="tab-pane active" id="sales">

                                            <h1 class="hero-title-dark sm-title">Property Availability

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>


                                            <table class="table table-striped text-center">

                                                <thead>

                                                    <tr>

                                                        <th>

                                                            &nbsp;

                                                        </th>

                                                        <th>

                                                            Sales £/sqft 

                                                        </th>
                                                        
                                                        <th>

                                                            Rent £/sqft 

                                                        </th>

                                                        <th>

                                                            Paid Price 

                                                        </th>

                                                        <th>

                                                            Paid Discount 

                                                        </th>

                                                        <th>

                                                            Gross Yield 

                                                        </th>

                                                        <th>

                                                           Sales Listings 

                                                        </th>
                                                        
                                                         <th>

                                                           Rent Listings 

                                                        </th>

                                                        <th>

                                                            Transactions 

                                                        </th>

                                                    </tr>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                Studio

                                                            </td>

                                                            <td>

                                                                £ <span class="scift"><?php echo number_format(round($scift)); ?></span>

                                                            </td>
                                                            
                                                            <td>

                                                                £ <span class="scift"><?php echo number_format(round($sqfiRent)); ?></span>

                                                            </td>

                                                            <td>

                                                                £ <span class="PricePaid"><?php echo number_format(round($PricePaid)); ?></span>

                                                            </td>

                                                            <td>

                                                                <span class="PaidDiscount"><?php echo number_format($PaidDiscount,2); ?></span>% 

                                                            </td>

                                                            <td>

                                                                <span class="GrossYield"><?php echo number_format($GrossYield,2); ?></span>% 

                                                            </td>

                                                            <td>

                                                                <span class="SalesListing"><?php echo round($SalesListing); ?></span> 

                                                            </td>
                                                            
                                                            <td>

                                                                <span class="SalesListing"><?php echo round($RentList); ?></span> 

                                                            </td>

                                                            <td>

                                                                 <span class="SalesTransactions"><?php echo number_format(round($SalesTransactions)); ?></span> 

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td>

                                                                1 Bed

                                                            </td>

                                                            <td>

                                                                £ <span class="sciftBd1"><?php echo number_format(round($sciftBd1)); ?></span>

                                                            </td>
                                                            
                                                             <td>

                                                                £ <span class="scift"><?php echo number_format(round($sqfiRentBd1)); ?></span>

                                                            </td>


                                                            <td>

                                                                £ <span class="PricePaidBd1"><?php echo number_format(round($PricePaidBd1)); ?></span>

                                                            </td>

                                                            <td>

                                                                <span class="PaidDiscountBd1"><?php echo number_format($PaidDiscountBd1,2); ?></span>% 

                                                            </td>

                                                            <td>

                                                                <span class="GrossYieldBd1"><?php echo number_format($GrossYieldBd1,2); ?></span>% 

                                                            </td>

                                                            <td>

                                                                <span class="SalesListingBd1"><?php echo round($SalesListingBd1); ?></span> 

                                                            </td>
                                                            
                                                            <td>

                                                                <span class="SalesListing"><?php echo round($RentListBd1); ?></span> 

                                                            </td>

                                                            <td>

                                                                 <span class="SalesTransactionsBd1"><?php echo number_format(round($SalesTransactionsBd1)); ?></span> 

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td>

                                                                2 Bed 

                                                            </td>

                                                             <td>

                                                                £ <span class="sciftBd2"><?php echo number_format(round($sciftBd2)); ?></span>

                                                            </td>
                                                            
                                                            <td>

                                                                £ <span class="scift"><?php echo number_format(round($sqfiRentBd2)); ?></span>

                                                            </td>

                                                            <td>

                                                                £ <span class="PricePaidBd2"><?php echo number_format(round($PricePaidBd2)); ?></span> 

                                                            </td>

                                                            <td>

                                                                <span class="PaidDiscountBd2"><?php echo number_format($PaidDiscountBd2,2); ?></span>% 

                                                            </td>

                                                            <td>

                                                                <span class="GrossYieldBd2"><?php echo number_format($GrossYieldBd2,2); ?></span>% 

                                                            </td>

                                                            <td>

                                                                <span class="SalesListingBd2"><?php echo round($SalesListingBd2); ?></span> 

                                                            </td>
                                                            
                                                            <td>

                                                                <span class="SalesListing"><?php echo round($RentListBd2); ?></span> 

                                                            </td>

                                                            <td>

                                                                 <span class="SalesTransactionsBd2"><?php echo number_format(round($SalesTransactionsBd2)); ?></span>

                                                            </td>

                                                        </tr>

                                                        <tr>

                                                            <td>

                                                                3 Bed 

                                                            </td>

                                                             <td>

                                                                £ <span class="sciftBd3"><?php echo number_format(round($sciftBd3)); ?></span>

                                                            </td>
                                                            
                                                            <td>

                                                                £ <span class="scift"><?php echo number_format(round($sqfiRentBd3)); ?></span>

                                                            </td>

                                                            <td>

                                                                £ <span class="PricePaidBd3"><?php echo number_format(round($PricePaidBd3)); ?></span> 

                                                            </td>

                                                            <td>

                                                                <span class="PaidDiscountBd3"><?php echo number_format($PaidDiscountBd3,2); ?></span>% 

                                                            </td>

                                                            <td>

                                                                <span class="GrossYieldBd3"><?php echo number_format($GrossYieldBd3,2); ?></span>% 

                                                            </td>

                                                            <td>

                                                                <span class="SalesListingBd3"><?php echo round($SalesListingBd3); ?></span> 

                                                            </td>
                                                            
                                                            <td>

                                                                <span class="SalesListing"><?php echo round($RentListBd3); ?></span> 

                                                            </td>

                                                            <td>

                                                                 <span class="SalesTransactionsBd3"><?php echo number_format(round($SalesTransactionsBd3)); ?></span> 

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </thead>

                                            </table>



                                            <h1 class="hero-title-dark sm-title">Property Availability

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <div class="container">

                                                 <div class="card">

                                                    <div class="card-body">

                                                         <div id="columnchart"></div>

                                                    </div>

                                                </div>

                                            </div>



                                        </div>

                                    

                                    </div>

                                </div>

                            </div>

                            

                            <div class="col-xl-6">

                                <script src="https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js"></script>

                                <link href="https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css" rel="stylesheet" />

                                <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>

                                <link

                                rel="stylesheet"

                                href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"

                                type="text/css"

                                />

                                <!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->

                                <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>

                                <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>

                                <style>

                                    .geocoder {

                                        position: absolute;

                                        z-index: 1;

                                        width: 50%;

                                        left: 50%;

                                        margin-left: -25%;

                                        top: 60px;

                                    }

                                    .mapboxgl-ctrl-geocoder {

                                        min-width: 100%;

                                    }

                                </style>

                                <div id="map"></div>

                                <script src="https://unpkg.com/es6-promise@4.2.4/dist/es6-promise.auto.min.js"></script>

                                <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>

                                

                                <script>

                                	// TO MAKE THE MAP APPEAR YOU MUST

                                	// ADD YOUR ACCESS TOKEN FROM

                                	// https://account.mapbox.com

                                	var CountryLat  = "<?php echo $CountryLat; ?>";

                                    var CountryLng  = "<?php echo $CountryLng; ?>";

                                    

                                    var CountryLatLag   =   eval("["+CountryLng+","+CountryLat+"]");

                                    //console.log(CountryLatLag);

                                	mapboxgl.accessToken = 'pk.eyJ1IjoiY3B5YWRhdiIsImEiOiJjaWVtaGtwMmkwMDc5cnNrbXQwMGRheHZqIn0.tlEUXj14r-jWmk3Nkh075g';

                                    var map = new mapboxgl.Map({

                                    container: 'map', // container id

                                    style: 'mapbox://styles/mapbox/streets-v11', // style URL

                                    center: CountryLatLag, // starting position [lng, lat]

                                    zoom: 9 // starting zoom

                                    });

                                </script>

                            </div>

                            

                        </div>

                    </div>

                    <?php

                      

                       

                        $DataSrcVal        = "162,160,500,161,163,436,431,433,456,496,497,498,496,497,498,435,432,159,428,434";

                        $FeatureCommonApiUkAjaxARR = \api\apiClass::FeatureCommonApiUkValueAjax("forTbl",$LocationId,$DataSrcVal,$datefilter1,$datefilter2);

                        

                        //echo "<pre>"; print_r($FeatureCommonApiUkAjaxARR); echo "</pre>"; 

                        //exit;

                        

                        $TotalBraodbandSpeed = 0;

                        

                        foreach($FeatureCommonApiUkAjaxARR as $RsUkAjax){

                            

                     

                            

                            $AreaLeverage           = isset($RsUkAjax["AreaLeverage"]) ? $RsUkAjax["AreaLeverage"] : "0"; 

                            $DebtPerBuilding        = isset($RsUkAjax["DebtPerBuilding"]) ? $RsUkAjax["DebtPerBuilding"] : "0";

                            $MortgageLending        = isset($RsUkAjax["MortgageLending"]) ? $RsUkAjax["MortgageLending"] : "0";

                            $MortgageDebtPerCapital = isset($RsUkAjax["MortgageDebtPerCapital"]) ? $RsUkAjax["MortgageDebtPerCapital"] : "0";

                            $CreditScore            = isset($RsUkAjax["CreditScore"]) ? $RsUkAjax["CreditScore"] : "0";

                            $MeanIncome             = isset($RsUkAjax["MeanIncome"]) ? $RsUkAjax["MeanIncome"] : "0";

                            $HomelessnessCount      = isset($RsUkAjax["HomelessnessCount"]) ? $RsUkAjax["HomelessnessCount"] : "0";

                            $RepossessionsCount     = isset($RsUkAjax["RepossessionsCount"]) ? $RsUkAjax["RepossessionsCount"] : "0";

                            $UnemploymentLevel      = isset($RsUkAjax["UnemploymentLevel"]) ? $RsUkAjax["UnemploymentLevel"] : "0";

                            $ViolentSexualCrimes    = isset($RsUkAjax["ViolentSexualCrimes"]) ? $RsUkAjax["ViolentSexualCrimes"] : "0";

                            $CrimesDishonesty       = isset($RsUkAjax["CrimesDishonesty"]) ? $RsUkAjax["CrimesDishonesty"] : "0";

                            $OtherCrimes            = isset($RsUkAjax["OtherCrimes"]) ? $RsUkAjax["OtherCrimes"] : "0";

                            $BusStationsStops       = isset($RsUkAjax["BusStationsStops"]) ? $RsUkAjax["BusStationsStops"] : "0";

                            $NationalRailStations   = isset($RsUkAjax["NationalRailStations"]) ? $RsUkAjax["NationalRailStations"] : "0";

                            $Dwellings              = isset($RsUkAjax["Dwellings"]) ? $RsUkAjax["Dwellings"] : "0";

                            $BraodbandSpeed         = isset($RsUkAjax["BraodbandSpeed"]) ? $RsUkAjax["BraodbandSpeed"] : "0";

                            $BroadbandSpeedGraph    = isset($RsUkAjax["BroadbandSpeedGraph"]) ? $RsUkAjax["BroadbandSpeedGraph"] : "";

                            $MonthDetailGraph       = isset($RsUkAjax["MonthDetailGraph"]) ? $RsUkAjax["MonthDetailGraph"] : "";

                            $MeanIncomeGraph        = isset($RsUkAjax["MeanIncomeGraph"]) ? $RsUkAjax["MeanIncomeGraph"] : "";

                            $ReportedCrimesGraph    = isset($RsUkAjax["ReportedCrimes"]) ? $RsUkAjax["ReportedCrimes"] : "";

                            

                            

                        }

                        

                        //echo '$ReportedCrimesGraph='. $ReportedCrimesGraph .'<br>';

                       

                    

                        

                        ob_flush(); flush();

                        //echo 'AreaLeverage='. $AreaLeverage;

                    ?>

                    

                    

                    <div class="tab-pane fade" id="demographics">

                        <div class="row no-gutters">

                            <div class="col-xl-6">

                                <div class="rd-content">

                                    

                                    <div class="place-type">

                                        <h4><?php echo $Subrub;?></h4>

                                    </div>

                                    <!-- Nav pills -->

                                    <ul class="nav nav-pills sub-pills">

                                        <li class="nav-item">

                                            <a class="nav-link" data-toggle="pill" href="#pnp">PEOPLE & POPULATION</a>

                                        </li>

                                        <li class="nav-item">

                                            <a class="nav-link" data-toggle="pill" href="#la">LOCAL AREA</a>

                                        </li>

                                        <li class="nav-item">

                                            <a class="nav-link" data-toggle="pill" href="#education">EDUCATION</a>

                                        </li>

                                        <li class="nav-item">

                                            <a class="nav-link" data-toggle="pill" href="#economics">ECONOMICS</a>

                                        </li>

                                        <li class="nav-item">

                                            <a class="nav-link active" data-toggle="pill" href="#deprivation">DEPRIVATION</a>

                                        </li>

                                    </ul>

                                    

                                    <!-- Tab panes -->

                                    <div class="tab-content">

                                            <?php //include_once("corelogic-json-test.php"); 

                                            

                                            //echo 'LocationId='. $LocationId .'<br>';

                                            //echo 'datefilter1='. $datefilter1 .'<br>';

                                            //echo 'datefilter2='. $datefilter2 .'<br>';

                                    

                                            $TotMedianAgeVal = 0;

                                            $TotPopulationDensity = 0;

                                            $TotHigherEducationEQI =0;

                                            $TotPopulationAgeAbove85= 0;

                                            $TotPopulationAgeBet8084= 0;

                                            $TotPopulationAgeBet7579= 0;

                                            $TotPopulationAgeBet7074= 0;

                                            $TotPopulationAgeBet6569= 0;

                                            $TotPopulationAgeBet6064= 0;

                                            $TotPopulationAgeBet5559= 0;

                                            $TotPopulationAgeBet5054= 0;

                                            $TotPopulationAgeBet4549= 0;

                                            $TotPopulationAgeBet4044= 0;

                                            $TotPopulationAgeBet3539= 0;

                                            $TotPopulationAgeBet3034= 0;

                                            $TotPopulationAgeBet2529= 0;

                                            $TotPopulationAgeBet2024= 0;

                                            $TotPopulationAgeLess20 =0;

                                            $i = 1;

                                            $j = 1;

                                            

                                            $PeopleAndPopulationArr  =  \api\apiClass::PeopleAndPopulationApiClass($LocationId,$datefilter1,$datefilter2); 

                                             //echo "<pre>"; print_r($PeopleAndPopulationArr); echo "</pre>"; 

                                             

                                            

                                             ob_flush(); flush(); // send buffer output

                                             //exit;

                                             

                                             

                                             

                                             

                                            foreach($PeopleAndPopulationArr as $RsPap){

                                                    

                                                    //420,157,493,474,475,476,477,478,479,480,481,482,483,484,485,486,487,488

                                                    

                                                    if ($RsPap["420"] == 420) { 

                                                    

                                                        $MedianAgeVal           = isset($RsPap["420_Val"]) ? $RsPap["420_Val"] : "0";

                                                       $TotMedianAgeVal         = floatval($TotMedianAgeVal) + floatval($MedianAgeVal);

                                                       

                                                       $j++;

                                                       //echo 'TotMedianAgeVal='. $TotMedianAgeVal .'<br>';

                                                      

                                                    }

                                                    

                                                    if ($RsPap["157"] == 157) { 

                                                    

                                                        $PopulationDensity       = isset($RsPap["157_Val"]) ? $RsPap["157_Val"] : "0";

                                                        $TotPopulationDensity    = floatval($TotPopulationDensity) + floatval($PopulationDensity);

                                                      

                                                    }

                                                    

                                                    

                                                    if ($RsPap["493"] == 493) { 

                                                    

                                                        $HigherEducationEQI     = isset($RsPap["493_Val"]) ? $RsPap["493_Val"] : "0";

                                                        $TotHigherEducationEQI  = floatval($TotHigherEducationEQI) + floatval($HigherEducationEQI);

                                                        

                                                        //echo $HigherEducationEQI . '<br>';

                                                      

                                                    }

                                                    

                                                    

                                                    

                                                    if ($RsPap["474"] == 474) { 

                                                    

                                                        $PopulationAgeLess20     = isset($RsPap["474_Val"]) ? $RsPap["474_Val"] : "0";

                                                        $TotPopulationAgeLess20  = floatval($TotPopulationAgeLess20) + floatval($PopulationAgeLess20);

                                                        

                                                        //echo 'TotPopulationAgeLess20='. $TotPopulationAgeLess20 .'<br>';

                                                      

                                                    }

                                                    

                                                    if ($RsPap["475"] == 475) { 

                                                    

                                                        $PopulationAgeBet2024     = isset($RsPap["475_Val"]) ? $RsPap["475_Val"] : "0";

                                                        $TotPopulationAgeBet2024  = floatval($TotPopulationAgeBet2024) + floatval($PopulationAgeBet2024);

                                                      

                                                    }

                                                    

                                                    if ($RsPap["476"] == 476) { 

                                                    

                                                        $PopulationAgeBet2529     = isset($RsPap["476_Val"]) ? $RsPap["476_Val"] : "0";

                                                        $TotPopulationAgeBet2529  = floatval($TotPopulationAgeBet2529) + floatval($PopulationAgeBet2529);

                                                      

                                                    }

                                                    

                                                    if ($RsPap["477"] == 477) { 

                                                    

                                                        $PopulationAgeBet3034     = isset($RsPap["477_Val"]) ? $RsPap["477_Val"] : "0";

                                                        $TotPopulationAgeBet3034  = floatval($TotPopulationAgeBet3034) + floatval($PopulationAgeBet3034);

                                                      

                                                    }

                                                    

                                                    if ($RsPap["478"] == 478) { 

                                                    

                                                        $PopulationAgeBet3539     = isset($RsPap["478_Val"]) ? $RsPap["478_Val"] : "0";

                                                        $TotPopulationAgeBet3539  = floatval($TotPopulationAgeBet3539) + floatval($PopulationAgeBet3539);

                                                      

                                                    }

                                                   

                                                    

                                                    if ($RsPap["479"] == 479) { 

                                                    

                                                        $PopulationAgeBet4044     = isset($RsPap["479_Val"]) ? $RsPap["479_Val"] : "0";

                                                        $TotPopulationAgeBet4044  = floatval($TotPopulationAgeBet4044) + floatval($PopulationAgeBet4044);

                                                      

                                                    }

                                                    

                                                    if ($RsPap["480"] == 480) { 

                                                    

                                                        $PopulationAgeBet4549     = isset($RsPap["480_Val"]) ? $RsPap["480_Val"] : "0";

                                                        $TotPopulationAgeBet4549  = floatval($TotPopulationAgeBet4549) + floatval($PopulationAgeBet4549);

                                                      

                                                    }

                                                    

                                                    if ($RsPap["481"] == 481) { 

                                                    

                                                        $PopulationAgeBet5054     = isset($RsPap["481_Val"]) ? $RsPap["481_Val"] : "0";

                                                        $TotPopulationAgeBet5054  = floatval($TotPopulationAgeBet5054) + floatval($PopulationAgeBet5054);

                                                      

                                                    }

                                                    

                                                    if ($RsPap["482"] == 482) { 

                                                    

                                                        $PopulationAgeBet5559     = isset($RsPap["482_Val"]) ? $RsPap["482_Val"] : "0";

                                                        $TotPopulationAgeBet5559  = floatval($TotPopulationAgeBet5559) + floatval($PopulationAgeBet5559);

                                                      

                                                    }

                                                    

                                                    if ($RsPap["483"] == 483) { 

                                                    

                                                        $PopulationAgeBet6064     = isset($RsPap["483_Val"]) ? $RsPap["483_Val"] : "0";

                                                        $TotPopulationAgeBet6064  = floatval($TotPopulationAgeBet6064) + floatval($PopulationAgeBet6064);

                                                      

                                                    }

                                                    

                                                     if ($RsPap["484"] == 484) { 

                                                    

                                                        $PopulationAgeBet6569     = isset($RsPap["484_Val"]) ? $RsPap["484_Val"] : "0";

                                                        $TotPopulationAgeBet6569  = floatval($TotPopulationAgeBet6569) + floatval($PopulationAgeBet6569);

                                                      

                                                    }

                                                    

                                                    if ($RsPap["485"] == 485) { 

                                                    

                                                        $PopulationAgeBet7074     = isset($RsPap["485_Val"]) ? $RsPap["485_Val"] : "0";

                                                        $TotPopulationAgeBet7074  = floatval($TotPopulationAgeBet7074) + floatval($PopulationAgeBet7074);

                                                      

                                                    }

                                                    

                                                    

                                                    

                                                    if ($RsPap["486"] == 486 ) { 

                                                    

                                                        $PopulationAgeBet7579     = isset($RsPap["486_Val"]) ? $RsPap["486_Val"] : "0";

                                                        $TotPopulationAgeBet7579  = floatval($TotPopulationAgeBet7579) + floatval($PopulationAgeBet7579);

                                                      

                                                    }

                                                    

                                                    if ($RsPap["487"] == 487 ) { 

                                                    

                                                        $PopulationAgeBet8084     = isset($RsPap["487_Val"]) ? $RsPap["487_Val"] : "0";

                                                        $TotPopulationAgeBet8084  = floatval($TotPopulationAgeBet8084) + floatval($PopulationAgeBet8084);

                                                      

                                                    }

                                                    

                                                    if ($RsPap["488"] == 488 ) { 

                                                    

                                                        $PopulationAgeAbove85     = isset($RsPap["488_Val"]) ? $RsPap["488_Val"] : "0";

                                                        $TotPopulationAgeAbove85  = floatval($TotPopulationAgeAbove85) + floatval($PopulationAgeAbove85);

                                                      

                                                    }

                                 

                                                  $i++;

                                             }

                                             

                                             //echo 'j='. $j;

                                             

                                             $jNew = $j - 1;

                                             

                                             

                                             //echo $TotPopulationAgeLess20;

                                             

                                            

                                             $TotalPopulation =  floatval($TotPopulationAgeLess20) +  floatval($TotPopulationAgeBet2024) + floatval($TotPopulationAgeBet2529) + floatval($TotPopulationAgeBet3034) 

                                            					 + floatval($TotPopulationAgeBet3539) + floatval($TotPopulationAgeBet4044)+ floatval($TotPopulationAgeBet4549) + floatval($TotPopulationAgeBet5054)

                                            					 + floatval($TotPopulationAgeBet5559) + floatval($TotPopulationAgeBet6064)+ floatval($TotPopulationAgeBet6569) + floatval($TotPopulationAgeBet7074) 

                                            					 + floatval($TotPopulationAgeBet7579) + floatval($TotPopulationAgeBet8084) + floatval($TotPopulationAgeAbove85);

                                            					 

                                            					 

                                            if ($jNew == "" || $jNew == 0)

                                                    $jNew = 1;

                                    ?>

                                        <div class="tab-pane fade" id="pnp">

                                            <h1 class="hero-title-dark sm-title">People & Population Overview

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>



                                            <table class="table table-striped text-center">

                                                <thead>

                                                    <tr>

                                                        <th>

                                                            Total Population

                                                        </th>

                                                        <th>

                                                            Median Age

                                                        </th>

                                                        <th>

                                                            Population Density <small>(England & Wales 2011)</small>

                                                        </th>

                                                        <th>

                                                            Higher Education or Equivalent

                                                        </th>

                                                    </tr>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                <?php echo number_format($TotalPopulation); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo round(floatval($TotMedianAgeVal) / $jNew); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo number_format($TotPopulationDensity); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo floatval($TotHigherEducationEQI) / floatval($jNew); ?>% 

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </thead>

                                            </table>





                                            <h1 class="hero-title-dark sm-title">Population: Age 0 to 34

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>



                                            <table class="table table-striped text-center">

                                                <thead>

                                                    <tr>

                                                        <th>

                                                            < 20

                                                        </th>

                                                        <th>

                                                            20 to 24

                                                        </th>

                                                        <th>

                                                            25 to 29

                                                        </th>

                                                        <th>

                                                            30 to 34

                                                        </th>

                                                    </tr>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                <?php echo number_format($TotPopulationAgeLess20); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo number_format($TotPopulationAgeBet2024); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo number_format($TotPopulationAgeBet2529); ?>

                                                            </td>

                                                            <td>

                                                               <?php echo number_format($TotPopulationAgeBet3034); ?>

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </thead>

                                            </table>





                                            <h1 class="hero-title-dark sm-title">Population: Age 35 to 54

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>



                                            <table class="table table-striped text-center">

                                                <thead>

                                                    <tr>

                                                        <th>

                                                            35 to 39

                                                        </th>

                                                        <th>

                                                            40 to44

                                                        </th>

                                                        <th>

                                                            45 to 49

                                                        </th>

                                                        <th>

                                                            50 to 54

                                                        </th>

                                                    </tr>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                <?php echo number_format($TotPopulationAgeBet3539); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo number_format($TotPopulationAgeBet4044); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo number_format($TotPopulationAgeBet4549); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo number_format($TotPopulationAgeBet5054); ?>

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </thead>

                                            </table>





                                            <h1 class="hero-title-dark sm-title">Population: Age 55 to 74

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>



                                            <table class="table table-striped text-center">

                                                <thead>

                                                    <tr>

                                                        <th>

                                                           54 to 59

                                                        </th>

                                                        <th>

                                                            60 to 64

                                                        </th>

                                                        <th>

                                                            65 to 69

                                                        </th>

                                                        <th>

                                                            70 to 74

                                                        </th>

                                                    </tr>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                 <?php echo number_format($TotPopulationAgeBet5559); ?>

                                                            </td>

                                                            <td>

                                                                 <?php echo number_format($TotPopulationAgeBet6064); ?>

                                                            </td>

                                                            <td>

                                                                  <?php echo number_format($TotPopulationAgeBet6569); ?>

                                                            </td>

                                                            <td>

                                                                 <?php echo number_format($TotPopulationAgeBet7074); ?>

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </thead>

                                            </table>

                                            

                                            <h1 class="hero-title-dark sm-title">Population: Age 75 to 85+

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>



                                            <table class="table table-striped text-center">

                                                <thead>

                                                    <tr>

                                                        <th>

                                                           75 to 79

                                                        </th>

                                                        <th>

                                                            80 to 84

                                                        </th>

                                                        <th>

                                                            85+

                                                        </th>

                                                        <th>

                                                            &nbsp;

                                                        </th>

                                                    </tr>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                 <?php echo number_format($TotPopulationAgeBet7579); ?>

                                                            </td>

                                                            <td>

                                                                 <?php echo number_format($TotPopulationAgeBet8084); ?>

                                                            </td>

                                                            <td>

                                                                  <?php echo number_format($TotPopulationAgeAbove85); ?>

                                                            </td>

                                                            <td>

                                                                 &nbsp;

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </thead>

                                            </table>





                                        </div>

                                        <div class="tab-pane fade" id="la">

                                            <h1 class="hero-title-dark sm-title">Local Overview

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <table class="table table-striped text-center">

                                                <thead>

                                                    <tr>

                                                        <th>

                                                            Bus Station & Stops

                                                        </th>

                                                        <th>

                                                            National Rail Stations

                                                        </th>

                                                        <th>

                                                            Dwellings

                                                        </th>

                                                        <th>

                                                            Braodband Speed

                                                        </th>

                                                    </tr>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                <?php echo round($BusStationsStops); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo round($NationalRailStations); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo number_format($Dwellings,2); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo round($BraodbandSpeed); ?> mbps 

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </thead>

                                            </table>

                                            <h1 class="hero-title-dark sm-title">Braodband Speed 

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <div class="container">

                                                 <div class="card">

                                                    <div class="card-body">

                                                        <div class="chart-wrapper">

                                                            <div id="BraodbandSpeed"></div>

                                                         </div>

                                                    </div>

                                                    

                                                </div>

                                            </div>



                                            

                                        </div>  

                                        

                                        <?php

                                           $EducationByLevelApiUKArr  =  \api\apiClass::EducationByLevelApiUK($LocationId,$datefilter1,$datefilter2,"Tbl"); 

                                             //echo "<pre>"; print_r($EducationByLevelApiUKArr); echo "</pre>"; 

                                             ob_flush(); flush(); // send buffer output

                                             //exit;

                                             

                                            foreach($EducationByLevelApiUKArr as $RsEdulApi)

                                            {

                                                

                                                 $GCSEDorLessEquivalentTempTotal            = isset($RsEdulApi["GCSEDorLessEquivalentTempTotal"]) ? $RsEdulApi["GCSEDorLessEquivalentTempTotal"] : "0";

                                                 $GCSEDorgrtrEquivalentTempTotal            = isset($RsEdulApi["GCSEDorgrtrEquivalentTempTotal"]) ? $RsEdulApi["GCSEDorgrtrEquivalentTempTotal"] : "0";

                                                 $ALevelorEquivalentTempTotal               = isset($RsEdulApi["ALevelorEquivalentTempTotal"]) ? $RsEdulApi["ALevelorEquivalentTempTotal"] : "0";

                                                 $HigherEducationorEquivalentTempTotal      = isset($RsEdulApi["HigherEducationorEquivalentTempTotal"]) ? $RsEdulApi["HigherEducationorEquivalentTempTotal"] : "0";

                                                 $NoQualificationsTempTotal                 = isset($RsEdulApi["NoQualificationsTempTotal"]) ? $RsEdulApi["NoQualificationsTempTotal"] : "0";

                                                 $OtherQualificationsTempTotal              = isset($RsEdulApi["OtherQualificationsTempTotal"]) ? $RsEdulApi["OtherQualificationsTempTotal"] : "0";

                                                 $DateCount                                 = isset($RsEdulApi["DateCount"]) ? $RsEdulApi["DateCount"] : "0";

                                                

                                            }

                                        

                                         

                                        ?>

                                        <div class="tab-pane fade" id="education">

                                            <h1 class="hero-title-dark sm-title">Education Level

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <table class="table table-striped text-center">

                                                <thead>

                                                    <tr>

                                                        <th>

                                                            GCSE &lt;D<br><small>or Equivalent</small>

                                                        </th>

                                                        <th>

                                                            GCSE &lt;D<br><small>or Equivalent</small>

                                                        </th>

                                                        <th>

                                                            A level<br><small>or Equivalent</small>

                                                        </th>

                                                        <th>

                                                            Higher Education<br><small>or Equivalent</small>

                                                        </th>

                                                        <th>

                                                            No Qualifications

                                                        </th>

                                                        <th>

                                                            Other<br>Qualifications

                                                        </th>

                                                    </tr>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                <?php echo $GCSEDorLessEquivalentTempTotal; ?>%

                                                            </td>

                                                            <td>

                                                                <?php echo $GCSEDorgrtrEquivalentTempTotal; ?>%

                                                            </td>

                                                            <td>

                                                                <?php echo $ALevelorEquivalentTempTotal; ?>%

                                                            </td>

                                                            <td>

                                                                <?php echo $HigherEducationorEquivalentTempTotal; ?>

                                                            </td>

                                                            <td>

                                                                <?php echo $NoQualificationsTempTotal; ?>%

                                                            </td>

                                                            <td>

                                                                <?php echo $OtherQualificationsTempTotal; ?>%

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </thead>

                                            </table>

                                            <h1 class="hero-title-dark sm-title">Education Level

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <div class="card-body">

                                                <h4 class="card-title">Education By Level</h4>

                                                <div class="chart-wrapper">

                                                    <div id="EducationByLevel"></div>

                                                </div>

                                             </div>

                                             

                                             <?php

            

                                                     echo \api\apiClass::EducationByLevelApiUK($LocationId,$datefilter1,$datefilter2);

                                                     echo "<!-- Test  EducationByLevelApiUK = " . date("Y-m-d H:i:s") . " -->";

                                                     ob_flush(); flush(); // send buffer output

                                                     //exit;



                                                ?>

                                            

                                            <!--

                                            <h1 class="hero-title-dark sm-title">Education Level

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <img src="/assets/images/random-graph.png" class="w-100 mb-3" alt="">

                                            -->



                                        </div>  

                                        <div class="tab-pane" id="economics">

                                            <h1 class="hero-title-dark sm-title">Mortgage

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <table class="table table-striped text-center">

                                                <thead>

                                                    <tr>

                                                        <th>

                                                            Area Leverage

                                                        </th>

                                                        <th>

                                                            Debt Per Building

                                                        </th>

                                                        <th>

                                                            Mortgage Lending

                                                        </th>

                                                        <th>

                                                            Mortgage Debt Per Capital

                                                        </th>

                                                    </tr>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                <?php echo round($DebtPerBuilding,2); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo number_format(round($AreaLeverage)); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo number_format(round($MortgageLending)); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo number_format(round($MortgageDebtPerCapital)); ?>

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </thead>

                                            </table>

                                            <h1 class="hero-title-dark sm-title">Socioeconomics

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <table class="table table-striped text-center">

                                                <thead>

                                                    <tr>

                                                        <th>

                                                            Credit Score

                                                        </th>

                                                        <th>

                                                            Mean Income

                                                        </th>

                                                    </tr>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                <?php echo round($CreditScore,2); ?>

                                                            </td>

                                                            <td>

                                                                £&nbsp;<?php echo number_format(round($MeanIncome)); ?>

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </thead>

                                            </table>

                                            <h1 class="hero-title-dark sm-title">Monthly Income - May 15 - Marc 20

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <div class="container">

                                                 <div class="card">

                                                    <div class="card-body">

                                                        <div class="chart-wrapper">

                                                            <div id="MeanIncomeGraphId"></div>

                                                         </div>

                                                    </div>

                                                    

                                                </div>

                                            </div>



                                        </div>  

                                        <div class="tab-pane active" id="deprivation">

                                            

                                            <h1 class="hero-title-dark sm-title">Deprivation

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <table class="table table-striped text-center">

                                                <thead>

                                                    <tr>

                                                        <th>

                                                            Homelessness Count

                                                        </th>

                                                        <th>

                                                            Repossessions Count

                                                        </th>

                                                        <th>

                                                            Unemployment Level

                                                        </th>

                                                    </tr>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                <?php echo number_format($HomelessnessCount); ?>%

                                                            </td>

                                                            <td>

                                                                <?php echo number_format($RepossessionsCount); ?>%

                                                            </td>

                                                            <td>

                                                                <?php echo number_format($UnemploymentLevel); ?>

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </thead>

                                            </table>



                                            <h1 class="hero-title-dark sm-title">Crime Level By Group

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <table class="table table-striped text-center">

                                                <thead>

                                                    <tr>

                                                        <th>

                                                            Violent and Sexual Crimes

                                                        </th>

                                                        <th>

                                                            Crimes of Dishonesty

                                                        </th>

                                                        <th>

                                                            Other Crimes

                                                        </th>

                                                    </tr>

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                <?php echo round($ViolentSexualCrimes); ?>

                                                            </td>

                                                            <td>

                                                               <?php echo round($CrimesDishonesty); ?>

                                                            </td>

                                                            <td>

                                                                <?php echo round($OtherCrimes); ?>

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </thead>

                                            </table>



                                            <h1 class="hero-title-dark sm-title">Crime Level

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <div class="container">

                                                 <div class="card">

                                                    <div class="card-body">

                                                        <div class="chart-wrapper">

                                                            <div id="CrimeLevelGraph"></div>

                                                         </div>

                                                    </div>

                                                    

                                                </div>

                                            </div>

                                            

                                           

                                        </div>  

                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-6" >

                                <div id='mapContainer'>   

                                   

                                    <div id="map1"></div>

                                    <script>

                                    	// TO MAKE THE MAP APPEAR YOU MUST

                                    	// ADD YOUR ACCESS TOKEN FROM

                                    	// https://account.mapbox.com

                                        //console.log(CountryLatLag);

                                    	mapboxgl.accessToken = 'pk.eyJ1IjoiY3B5YWRhdiIsImEiOiJjaWVtaGtwMmkwMDc5cnNrbXQwMGRheHZqIn0.tlEUXj14r-jWmk3Nkh075g';

                                        var map1 = new mapboxgl.Map({

                                        container: 'map1', // container id

                                        style: 'mapbox://styles/mapbox/streets-v11', // style URL

                                        center: CountryLatLag, // starting position [lng, lat]

                                        zoom: 9 // starting zoom

                                        });

                                    </script>

                                </div>

                            </div>

                            

                        </div>

                    </div>

                    <div class="tab-pane fade" id="analyse">

                        <div class="row no-gutters">



                            <div class="col-xl-6">

                                <div class="rd-content">

                                    

                                    <div class="place-type">

                                        <h4><?php echo $Subrub;?></h4>

                                    </div>

                                    <!-- Nav pills -->

                                    <ul class="nav nav-pills sub-pills">

                                        <li class="nav-item">

                                            <a class="nav-link active" data-toggle="pill" href="#charts">CHARTS</a>

                                        </li>

                                        <li class="nav-item">

                                            <a class="nav-link" data-toggle="pill" href="#quartiles">Quartiles</a>

                                        </li>

                                        <li class="nav-item">

                                            <a class="nav-link" data-toggle="pill" href="#fsl">Flat Sales Listings</a>

                                        </li>

                                    </ul>

                                    <div class="tab-content">

                                        <div class="tab-pane active" id="charts">

                                            <h1 class="hero-title-dark sm-title">Flat Days on Market - Sales vs Flat Sales Listings

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            

                                            <div class="container">

                                                 <div class="card">

                                                    <div class="card-body">

                                                         <div id="columnchart1"></div>

                                                    </div>

                                                </div>

                                            </div>

                                            

                                            <h1 class="hero-title-dark sm-title">Flat Sales Listings Distribution May 15 - Mar 20

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            

                                             <div class="container">

                                                 <div class="card">

                                                    <div class="card-body">

                                                         <div id="FlatSalesListings"></div>

                                                    </div>

                                                </div>

                                            </div>

                                            

                                            

                                        </div>

                                        <div class="tab-pane fade" id="quartiles">

                                            <h1 class="hero-title-dark sm-title">Flat Days on Market - Sales

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <div class="card-body">

                                              <div class="table-responsive quartiles">

                                                <table class="analysis-table table table-striped">

                                                  <thead>

                                                    <tr>

                                                      <td>Date</td>

                                                      <td>90th Percentile</td>

                                                      <td>Upper Quartile</td>

                                                      <td>Median</td>

                                                      <td>Lower Quartile</td>

                                                      <td>Supply</td>

                                                    </tr>

                                                  </thead>

                                                  <tbody>

                                                      

                                                      <?php 

                                                        $DecimalPrint=0;

                                                        $Rounddcml =0;

                                                        $i = 1;

                                                        //echo '<pre>'; print_r($TempEachArr); echo '</pre>';

                                                       // exit;

                                                        foreach($TempEachArr as $RsDet)

                                                        {

                                                        ?>

                                                                <tr>

                                                                  <td><?php echo $RsDet["MonthDate_".$i]; ?></td>

                                                                  <td><?php echo $RsDet["NinthPercentile_".$i]; ?></td>

                                                                  <td><?php echo $RsDet["UpperQuartile_".$i]; ?></td>

                                                                  <td><?php echo $RsDet["Median_".$i]; ?></td>

                                                                  <td><?php echo $RsDet["Median_".$i]; ?></td>

                                                                  <td><?php echo $RsDet["Supply_".$i]; ?></td>

                                                                </tr>

                                                        <?php

                                                            $i++;

                                                         }

                                                        ?>

                                                  </tbody>

                                                </table>

                                              </div>

                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="fsl">

                                            <h1 class="hero-title-dark sm-title">Flat Sales Listing

                                                <select name="type" id="type" class="form-control" style='display:none' >

                                                    <option value="flat">12 Month Aug</option>

                                                    <option value="flat">Sep</option>

                                                </select>

                                            </h1>

                                            <div class="card-body">

                                              <div class="table-responsive quartiles">

                                                <table class="analysis-table table table-striped">

                                                  <thead>

                                                    <tr>

                                                      <td>Date</td>

                                                      <td>90th Percentile</td>

                                                      <td>Upper Quartile</td>

                                                      <td>Median</td>

                                                      <td>Lower Quartile</td>

                                                      <td>Supply</td>

                                                    </tr>

                                                  </thead>

                                                  <tbody>

                                                      

                                                      <?php 

                                                        $DecimalPrint=0;

                                                        $Rounddcml =0;

                                                        $i = 1;

                                                        //echo '<pre>'; print_r($TempSalesList); echo '</pre>';

                                                        //exit;

                                                        foreach($TempSalesList as $RsDetList)

                                                        {

                                                        ?>

                                                                <tr>

                                                                  <td><?php echo $RsDetList["MonthDate_".$i]; ?></td>

                                                                  <td><?php echo $RsDetList["NinthPercentile_".$i]; ?></td>

                                                                  <td><?php echo $RsDetList["UpperQuartile_".$i]; ?></td>

                                                                  <td><?php echo $RsDetList["Median_".$i]; ?></td>

                                                                  <td><?php echo $RsDetList["Median_".$i]; ?></td>

                                                                  <td><?php echo $RsDetList["Supply_".$i]; ?></td>

                                                                </tr>

                                                        <?php

                                                            $i++;

                                                         }

                                                        ?>

                                                  </tbody>

                                                </table>

                                              </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>         

                            <div class="col-xl-6">

                                <div id='mapContainer'>

                                    <div id="map2"></div>

                                     <script>

                                    	// TO MAKE THE MAP APPEAR YOU MUST

                                    	// ADD YOUR ACCESS TOKEN FROM

                                    	// https://account.mapbox.com

                                        //console.log(CountryLatLag);

                                    	mapboxgl.accessToken = 'pk.eyJ1IjoiY3B5YWRhdiIsImEiOiJjaWVtaGtwMmkwMDc5cnNrbXQwMGRheHZqIn0.tlEUXj14r-jWmk3Nkh075g';

                                        var map2 = new mapboxgl.Map({

                                        container: 'map2', // container id

                                        style: 'mapbox://styles/mapbox/streets-v11', // style URL

                                        center: CountryLatLag, // starting position [lng, lat]

                                        zoom: 9 // starting zoom

                                        });

                                    </script>

                            

                                </div>

                            </div>

                        </div>

                    </div>

                    

                    <div class="tab-pane fade" id="properties">

                        <div class="row no-gutters">



                            <div class="col-xl-6">

                                <div class="rd-content">

                                    

                                    <div class="place-type">

                                        <h4><?php echo $Subrub;?></h4>

                                    </div>

                                    

                                  

                                    <?php

                        

                                        //CountryLng,CountryLat,CenterPoint1,CenterPoint2,$datefilter1,$datefilter2

                                        

                                        $PropertyImageAjaxARR = \api\apiClass::PropertyImageAjax("forDet",$LocationId,$CountryLng,$CountryLat,$CenterPoint1,$CenterPoint2,$datefilter1,$datefilter2);

                                            

                                         

                                        ob_flush(); flush();

                                        

                                        if($PropertyImageAjaxARR != "")

                                        

                                        {

                                        

    

                                        

                                         foreach($PropertyImageAjaxARR as $RsProImg)

                                            {

                                                

                                                 $address           = $RsProImg["address"] ? $RsProImg["address"] : "";

                                                 $askingPrice       = $RsProImg["askingPrice"] ? $RsProImg["askingPrice"] : "0";

                                                 $askingPriceSqft   = $RsProImg["askingPriceSqft"] ? $RsProImg["askingPriceSqft"] : "0";

                                                 $askingRent        = $RsProImg["askingRent"] ? $RsProImg["askingRent"] : "0";

                                                 $askingRentSqft    = $RsProImg["askingRentSqft"] ? $RsProImg["askingRentSqft"] : "0";

                                                 $bedRooms          = $RsProImg["bedRooms"] ? $RsProImg["bedRooms"] : "1";

                                                 $bathRooms         = $RsProImg["bathRooms"] ? $RsProImg["bathRooms"] : "1";

                                                 $dateAppeared      = $RsProImg["dateAppeared"] ? $RsProImg["dateAppeared"] : "";

                                                 $dateSold          = $RsProImg["dateSold"] ? $RsProImg["dateSold"] : "";

                                                 $ownership         = $RsProImg["ownership"] ? $RsProImg["ownership"] : "";

                                                 $estimatedPrice    = $RsProImg["estimatedPrice"] ? $RsProImg["estimatedPrice"] : "0";

                                                 $estimatedRent     = $RsProImg["estimatedRent"] ? $RsProImg["estimatedRent"] : "0";

                                                 $images            = $RsProImg["images"] ? $RsProImg["images"] : "";

                                                 $latitude          = $RsProImg["latitude"] ? $RsProImg["latitude"] : "";

                                                 $longitude         = $RsProImg["longitude"] ? $RsProImg["longitude"] : "";

                                                 $postcode          = $RsProImg["postcode"] ? $RsProImg["postcode"] : "";

                                                 $rentalYield       = $RsProImg["rentalYield"] ? $RsProImg["rentalYield"] : "0";

                                                 $size              = $RsProImg["size"] ? $RsProImg["size"] : "";

                                                 $soldPrice         = $RsProImg["soldPrice"] ? $RsProImg["soldPrice"] : "0";

                                                 $soldPriceSqft     = $RsProImg["soldPriceSqft"] ? $RsProImg["soldPriceSqft"] : "0";

                                                 $value             = $RsProImg["value"] ? $RsProImg["value"] : "0";

                                                 $agentName         = $RsProImg["agentName"] ? $RsProImg["agentName"] : "";

                                                 $agentAddress      = $RsProImg["agentAddress"] ? $RsProImg["agentAddress"] : "";

                                                 $description       = $RsProImg["description"] ? $RsProImg["description"] : "";

                                               

                                           // echo 'SoldPriceSqft=='. $soldPriceSqft .'<>br'

                

                                    ?>

                                  

                                            <div class="single-property">

                                                <h1 class="hero-title-dark sm-title"><?php echo $address; ?>

                                                    <select name="type" id="type" class="form-control" style='display:none' >

                                                        <option value="flat">12 Month Aug</option>

                                                        <option value="flat">Sep</option>

                                                    </select>

                                                </h1>

                                                <h3>£<?php echo number_format(round($soldPrice)); ?> <small>Sold: <?php echo $dateSold; ?></small></h3>

                                                <div class="row">

                                                    <div class="col-lg-4">

                                                        <?php

                                                            if($images != "" )

                                                            {

                                                        ?>

                                                            <img src="<?php echo $images;?>" class="w-100" alt="">

                                                        <?php

                                                            }

                                                            else{

                                                        ?>

                                                            <img src="<?php echo SITE_BASE_URL;?>assets/images/s-prop.png" class="w-100" alt="">

                                                        <?php

                                                            }

                                                        ?>

                                                    </div>

                                                    <div class="col-lg-8">

                                                        <div class="row">

                                                            <div class="col-12">

                                                                <p><i class="fas fa-bed"></i> <?php echo $bedRooms;?> Bed <i class="fal fa-bath"></i> <?php echo $bathRooms;?> Bath</p>

                                                            </div>

                                                            <!--<div class="col-xl-6">

                                                                <img src="<?php echo SITE_BASE_URL;?>assets/images/bar-chart.png" class="w-100" alt="">

                                                            </div>

                                                            -->

                                                            <div class="col-xl-6">

                                                                <table class="table table-striped">

                                                                    <tr>

                                                                        <td>

                                                                            £/sqft

                                                                        </td>

                                                                        <td>

                                                                            £ <?php echo number_format($soldPriceSqft);?> 

                                                                        </td>

                                                                    </tr>

                                                                    <tr>

                                                                        <td>

                                                                            Est Rent

                                                                        </td>

                                                                        <td>

                                                                            <?php echo number_format($estimatedRent);?> 

                                                                        </td>

                                                                    </tr>

                                                                    <tr>

                                                                        <td>

                                                                            Est Yield

                                                                        </td>

                                                                        <td>

                                                                            <?php echo $rentalYield;?> %

                                                                        </td>

                                                                    </tr> 

                                                                    <tr>

                                                                        <td>

                                                                            Size

                                                                        </td>

                                                                        <td>

                                                                            <?php echo $size;?> 

                                                                        </td>

                                                                    </tr>

                                                                    <tr>

                                                                        <td>

                                                                            Value

                                                                        </td>

                                                                        <td>

                                                                            <?php echo number_format($value);?>  

                                                                        </td>

                                                                    </tr>

                                                                    <tr>

                                                                        <td>

                                                                            Asking Price

                                                                        </td>

                                                                        <td>

                                                                            <?php echo number_format($askingPrice);?> 

                                                                        </td> 

                                                                    </tr>

                                                                </table>

                                                            </div>

                                                            <div class="col-xl-6">

                                                                <table class="table table-striped">

                                                                    <tr>

                                                                        <td>

                                                                            Asking Rent

                                                                        </td>

                                                                        <td>

                                                                            £ <?php echo number_format($askingRent);?> 

                                                                        </td>

                                                                    </tr>

                                                                    <tr>

                                                                        <td>

                                                                            Asking Rent Sqft

                                                                        </td>

                                                                        <td>

                                                                            <?php echo number_format($askingRentSqft);?> 

                                                                        </td>

                                                                    </tr>

                                                                   

                                                                </table>

                                                            </div>

                                                            

                                                        </div>

                                                    </div>

                                                    <div class="col-lg-12">

                                                        <div class="col-xl-12">

                                                            <table class="table table-striped">

                                                                <tr>

                                                                    <tr>

                                                                        <td>

                                                                            Agent Name 

                                                                        </td>

                                                                        <td>

                                                                           <?php echo $agentName;?> 

                                                                        </td>

                                                                    </tr>

                                                                    <tr>

                                                                        <td>

                                                                            Agent Address

                                                                        </td>

                                                                        <td>

                                                                            <?php echo $agentAddress;?> 

                                                                        </td>

                                                                    </tr>

                                                                    <td>

                                                                        Full Description

                                                                    </td>

                                                                    <td>

                                                                        <?php echo $description;?> 

                                                                    </td>

                                                                </tr> 

                                                              

                                                            </table>

                                                        </div>

                                                    </div>

                                                    

                                                </div>

                                                <div class="more" style='display:none;' >

                                                    <a href="#">

                                                        See more info <i class="fal fa-chevron-down"></i>

                                                    </a>

                                                </div>

                                            </div>

                                            <?php

                                            }

                                        }

                                        ?>

                                        

                                  

                                </div>

                            </div> 

                            <div class="col-xl-6">

                                <div id='mapContainer'>

                                <div id="map3"></div>

                                    <script>

                                    	// TO MAKE THE MAP APPEAR YOU MUST

                                    	// ADD YOUR ACCESS TOKEN FROM

                                    	// https://account.mapbox.com

                                        //console.log(CountryLatLag);

                                    	mapboxgl.accessToken = 'pk.eyJ1IjoiY3B5YWRhdiIsImEiOiJjaWVtaGtwMmkwMDc5cnNrbXQwMGRheHZqIn0.tlEUXj14r-jWmk3Nkh075g';

                                        var map3 = new mapboxgl.Map({

                                        container: 'map3', // container id

                                        style: 'mapbox://styles/mapbox/streets-v11', // style URL

                                        center: CountryLatLag, // starting position [lng, lat]

                                        zoom: 9 // starting zoom

                                        });

                                    </script>

                                </div>

                            </div>

                            

                        </div>

                    </div>

                    <div class="tab-pane fade" id="lno" style='display:none;' >

                        <div class="col-12">

                            <div class="rd-content">

                               

                                <div class="ownership-title">

                                    <div class="otitle">

                                        <h4><?php echo $Subrub;?></h4>

                                        <select name="type" id="type" class="form-control">

                                            <option value="flat">Flat</option>

                                            <option value="flat">House</option>

                                        </select>

                                    </div>

                                    <div class="r-flex">

                                        <div class="d-inline-flex switch-filters">

                                            <div class="custom-control custom-switch">

                                                <input type="checkbox" class="custom-control-input" id="lo">

                                                <label class="custom-control-label" for="lo">Land Ownership</label>

                                            </div>

                                            <div class="custom-control custom-switch">

                                                <input type="checkbox" class="custom-control-input" id="scov">

                                                <label class="custom-control-label" for="scov">Site Coverage</label>

                                            </div>

                                        </div>

                                        <div class="color-hints">

                                            <div class="hint">

                                                <div class="color-dot vanilla"></div>

                                                <span>Business</span>

                                            </div>

                                            <div class="hint">

                                                <div class="color-dot berry"></div>

                                                <span>Country Council</span>

                                            </div>

                                            <div class="hint">

                                                <div class="color-dot blue"></div>

                                                <span>Housing Association</span>

                                            </div>

                                            <div class="hint">

                                                <div class="color-dot yellow"></div>

                                                <span>Local Authority</span>

                                            </div>

                                            <div class="hint">

                                                <div class="color-dot green"></div>

                                                <span>Mixed</span>

                                            </div>

                                            <div class="hint">

                                                <div class="color-dot orange"></div>

                                                <span>Non Profit</span>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!-- Full Width View MAP -->

                                

                                <div class="row d-none">

                                    <div class="col-12">

                                        <div id='mapContainer'>

                                            <div id="map4"></div>

                                           <script>

                                            	// TO MAKE THE MAP APPEAR YOU MUST

                                            	// ADD YOUR ACCESS TOKEN FROM

                                            	// https://account.mapbox.com

                                                //console.log(CountryLatLag);

                                            	mapboxgl.accessToken = 'pk.eyJ1IjoiY3B5YWRhdiIsImEiOiJjaWVtaGtwMmkwMDc5cnNrbXQwMGRheHZqIn0.tlEUXj14r-jWmk3Nkh075g';

                                                var map4 = new mapboxgl.Map({

                                                container: 'map4', // container id

                                                style: 'mapbox://styles/mapbox/streets-v11', // style URL

                                                center: CountryLatLag, // starting position [lng, lat]

                                                zoom: 9 // starting zoom

                                                });

                                            </script>

                                        </div>

                                    </div>

                                </div>

                                <!-- Detail View MAP -->

                                <div class="row">

                                    <div class="col-lg-6">

                                        <h1 class="hero-title-dark sm-title">Property Details

                                            <select name="type" id="type" class="form-control" style='display:none' >

                                                <option value="flat">12 Month Aug</option>

                                                <option value="flat">Sep</option>

                                            </select>

                                        </h1>



                                        <table class="table table-striped property-details-table">

                                            <tr>

                                                <td>

                                                    <strong>Title Number</strong>

                                                    <span>SGL147259</span>

                                                </td>

                                                <td>

                                                    <strong>Address</strong>

                                                    <span>15 Aldersmead Road Beckenham Bromley BR3 INA</span>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>

                                                    <strong>Proprietor</strong>

                                                    <span>-</span>

                                                </td>

                                                <td>

                                                    <strong>Proprietor Address</strong>

                                                    <span>-</span>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>

                                                    <strong>Tenure</strong>

                                                    <span>Freehold</span>

                                                </td>

                                                <td>

                                                    <div class="info-poper">

                                                        <i class="fas fa-question-circle"></i>

                                                    </div>

                                                    <strong>Owenership</strong>

                                                    <span>Private</span>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>

                                                    <strong>Site Area</strong>

                                                    <span>5,990 sqft</span>

                                                </td>

                                                <td>

                                                    <div class="info-poper">

                                                        <i class="fas fa-question-circle"></i>

                                                    </div>

                                                    <strong>Building Area</strong>

                                                    <span>1,520 sqft</span>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>

                                                    <div class="info-poper">

                                                        <i class="fas fa-question-circle"></i>

                                                    </div>

                                                    <strong>Building Height</strong>

                                                    <span>11m</span>

                                                </td>

                                                <td>

                                                    <div class="info-poper">

                                                        <i class="fas fa-question-circle"></i>

                                                    </div>

                                                    <strong>Site Coverage</strong>

                                                    <span>25.4%</span>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>

                                                    <div class="info-poper">

                                                        <i class="fas fa-question-circle"></i>

                                                    </div>

                                                    <strong>Flood Risk Level</strong>

                                                    <span>3</span>

                                                </td>

                                                <td>

                                                    <div class="info-poper">

                                                        <i class="fas fa-question-circle"></i>

                                                    </div>

                                                    <strong>Flood Defence</strong>

                                                    <span>Flood Defence Not Present</span>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>

                                                    <div class="info-poper">

                                                        <i class="fas fa-question-circle"></i>

                                                    </div>

                                                    <strong>Planning Use Classes</strong>

                                                    <span>-</span>

                                                </td>

                                                <td>

                                                    <div class="info-poper">

                                                        <i class="fas fa-question-circle"></i>

                                                    </div>

                                                    <a href="#"><i class="fal fa-edit"></i> Title Plan ></a>

                                                </td>

                                            </tr>

                                        </table>

                                    </div>

                                    <div class="col-lg-6">

                                         <div id='mapContainer'>

                                            <div id="map5"></div>

                                            <script>

                                            	// TO MAKE THE MAP APPEAR YOU MUST

                                            	// ADD YOUR ACCESS TOKEN FROM

                                            	// https://account.mapbox.com

                                                //console.log(CountryLatLag);

                                            	mapboxgl.accessToken = 'pk.eyJ1IjoiY3B5YWRhdiIsImEiOiJjaWVtaGtwMmkwMDc5cnNrbXQwMGRheHZqIn0.tlEUXj14r-jWmk3Nkh075g';

                                                var map5 = new mapboxgl.Map({

                                                container: 'map5', // container id

                                                style: 'mapbox://styles/mapbox/streets-v11', // style URL

                                                center: CountryLatLag, // starting position [lng, lat]

                                                zoom: 9 // starting zoom

                                                });

                                            </script>

                                        </div>

                                        

                                    </div>

                                </div>

                            </div>

                        </div>  

                    </div>

                    <div class="tab-pane fade" id="planning">

                        <div class="col-12">

                            <div class="rd-content">

                                <div class="ownership-title">

                                    <div class="otitle">

                                        <h4><?php echo $Subrub;?></h4>

                                        <select name="type" id="type" class="form-control">

                                            <option value="flat">Flat</option>

                                            <option value="flat">House</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-12">

                                        <div class="text-dark bg-light text-center p-5 m-5">

                                            <h1>PLANNING PHASE 2</h1>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="tab-pane fade" id="scout">

                        <div class="col-12">

                            <div class="rd-content">

                                <div class="ownership-title">

                                    <div class="otitle">

                                        <h4><?php echo $Subrub;?></h4>

                                        <select name="type" id="type" class="form-control">

                                            <option value="flat">Flat</option>

                                            <option value="flat">House</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-12">

                                        <div class="text-dark bg-light text-center p-5 m-5">

                                            <h1>SCOUT PHASE 2</h1>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            

            <?php

            

              ob_flush(); flush();

            }

            

            else if($LocationId != "" )

            

            {

              ob_flush(); flush();
              
              if($SuburbLocation == "SB")
              {

            ?>

             <!-- Inner Content Start-->
                

                <div class="grd-content">

                    <div class="row">

                        <div class="col-12">

                            <h1 class="hero-title-dark">Suburb Report - <?php echo $Subrub;?></h1>

                            <div class="vector-panel d-none">

                                <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/vector.png" class="w-100" alt="">

                            </div>

                        </div>

                    </div>

                    <div class="row mt-4">

                        <div class="col-12">

                            <h1 class="hero-title-dark">Area Profile</h1>

                            <div class="text-panel">

                                <div class="row">

                                    <div class="col-lg-6">

                                        <ul>

                                            <li>

                                                The size of <?php echo $Subrub;?> is approximately 3 square kilometres

                                            </li>

                                            <li>

                                                By 2013 the population was 3,216 showing a population growth of 56.0% in the area during that time.

                                            </li>

                                            <li>

                                                The predominant age group in <?php echo $Subrub;?> is 20-29 years. In general, people in <?php echo $Subrub;?> work in a service and sales occupation.

                                            </li>

                                            <li>

                                                Currently the median sales price of houses in the area is $890,000.

                                            </li>

                                        </ul>

                                    </div>

                                    <div class="col-lg-6">

                                        <script src="https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js"></script>

                                        <link href="https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css" rel="stylesheet" />

                                        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>

                                        <link

                                        rel="stylesheet"

                                        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"

                                        type="text/css"

                                        />

                                        <!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->

                                        <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>

                                        <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>

                                        <div id="map"></div>

                                        <script src="https://unpkg.com/es6-promise@4.2.4/dist/es6-promise.auto.min.js"></script>

                                        <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>

                                         

                                        <script>

                                                mapboxgl.accessToken = 'pk.eyJ1IjoiY3B5YWRhdiIsImEiOiJjaWVtaGtwMmkwMDc5cnNrbXQwMGRheHZqIn0.tlEUXj14r-jWmk3Nkh075g';

                                                var mapboxClient = mapboxSdk({ accessToken: mapboxgl.accessToken });

                                                var Suburb = $("#Suburb").val();

                                                //alert(Suburb);

                                                if(Suburb !=''){

                                                  var sub = Suburb;

                                                }else{

                                                 var sub = '<?php echo $CountryCodeNew; ?>';

                                                }

                                                

                                                //alert("sub="+sub);

                                                mapboxClient.geocoding

                                                .forwardGeocode({

                                                query: sub,

                                                autocomplete: false,

                                                limit: 1

                                                })

                                                .send()

                                                .then(function(response) {

                                                if (

                                                response &&

                                                response.body &&

                                                response.body.features &&

                                                response.body.features.length

                                                ) {

                                                var feature = response.body.features[0];

                                                 

                                                var map = new mapboxgl.Map({

                                                container: 'map',

                                                style: 'mapbox://styles/mapbox/streets-v11',

                                                center: feature.center,

                                                zoom: 11,

                                                placeholder: 'Enter search e.g.',

                                                });

                                                //console.log(feature);

                                                new mapboxgl.Marker().setLngLat(feature.center).addTo(map);

                                                }

                                                });

                                        

                                        </script>  

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row mt-4" style='display:none;' >

                        <div class="col-12">

                            <h1 class="hero-title-dark">Demographics</h1>

                            <div class="dg-panel">

                                <div class="row">

                                    <div class="col-xl-3 col-md-6">

                                        <div class="d-flex">

                                            <div class="icon">

                                                <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/people-group'.png" alt="">

                                            </div>

                                            <div class="text">

                                                <h1>3,216</h1>

                                                <span>Population</span>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xl-3 col-md-6">

                                        <div class="d-flex">

                                            <div class="icon">

                                                <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/upwards.png" alt="">

                                            </div>

                                            <div class="text">

                                                <h1>56%</h1>

                                                <span>Population<br>Growth</span>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xl-3 col-md-6">

                                        <div class="d-flex">

                                            <div class="icon">

                                                <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/distance.png" alt="">

                                            </div>

                                            <div class="text">

                                                <h1>3Km<small>2</small></h1>

                                                <span><?php echo $Subrub;?> AREA</span>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xl-3 col-md-6">

                                        <img src="assets/images/age-rate.png" class="w-100" alt="">

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

                        </div>

                    </div>

                    <?php //include_once("corelogic-json-test.php"); 

                    ob_flush(); flush();

                     if ( $countryId == "2"){

                        $propertyTypeId ="1";

                    }else{

                        $propertyTypeId ="6";

                    }

                                        

                    $MedianTablArr  =  \api\apiClass::ShowMedianTableValueApi($LocationId,$StreetId,$ZipcodeId,$propertyTypeId); 

                     $i =0;

                     $TotalMedianSale = 0;

                     foreach($MedianTablArr as $MedianTabl){

                            

                            $Datas      = $MedianTabl["date"];

                            $Datas2     = $MedianTabl["value"] ? $MedianTabl["value"]  : 0;

                            $TotalMedianSale = $TotalMedianSale + $Datas2 ;

                            $i++;

                              

                     }

                     if($i >0 )

                        $TotalMedianSale  = $TotalMedianSale / $i;

                     

                   ob_flush(); flush();

                     

                     

                    if ( $countryId == "2"){

                

                        $MetricsRentalStatics ="49";

                        $MetricsRentalRate ="50";

                        $MetricsChangerenatalRate ="47";

                        $MetricsGrossRentalYield ="10";

                        

                        

                    }else{

                        $MetricsRentalStatics ="77";

                        $MetricsRentalRate ="78";

                        $MetricsChangerenatalRate ="79";

                        $MetricsGrossRentalYield ="80";

                    }

                    

                    $StreetId = "";

                    $ZipcodeId ="";

           

                    

                    $MedianRentTablArr  =  \api\apiClass::RentalStatisticsApiAjax($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$MetricsRentalStatics,$countryId);

                    

                    

                     $i =0;

                     $TotalRentalSale = 0;

                     foreach($MedianRentTablArr as $MedianRent){

                            

                            $Datas      = $MedianRent["date"];

                            $Datas2     = $MedianRent["value"] ? $MedianRent["value"]  : 0;

                            $TotalRentalSale = $TotalRentalSale + $Datas2 ;

                            $i++;

                     }

                     if($i>0)

                        $TotalRentalSale  = $TotalRentalSale / $i;

                        

                    ob_flush(); flush();

                     

                    ?>
                    
                     <div class="row mt-4">

                        <div class="col-12">

                            <h1 class="hero-title-dark"><?php echo $Subrub;?> - Median Sale & Rent Prices</h1>

                            <div class="sr-panel d-none">

                                <div class="row">

                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <!--- Tab Start---->
                    
                    <div class="residential-data mt-3">
            
                        
                
                        <!-- Nav tabs -->
        
                        <ul class="nav nav-pills main-pills">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#SalesStatisticsTab">Sales Statistics</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#RentalStatisticsTab">Rental Statistics</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#HouseholdStatisticsTab">Household Statistics</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#EducationStatisticsTab">Education Statistics</a>
                            </li>
                            
                        </ul>
            
                        <?php
        
                             ob_flush(); flush();
        
                        ?>
            
                            <!-- Tab panes -->
                             
                        <div class="tab-content">
                                <div class="tab-pane active" id="SalesStatisticsTab">
            
                                    <div class="row no-gutters">
            
                                        <div class="col-xl-6">
                                            <div class="rd-content">
                                                <h1 class="hero-title-dark">Recent Median Sale Prices</h1>
                                                <div class="container">
                                                     <div class="card">
                                                        <div class="card-body">
                                                             <div id="medianChart"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="sr-panel">
                                                <div class="row">
                                                    <div class="amount-box">
                                                        <span class="yellow-span">RECENT MEDIAN SALE PRICES</span>
                                                        <div class="amount">
                                                            <span class="big">[</span>$<?php echo number_format($TotalMedianSale); ?><span class="big">]</span>
                                                        </div>
                                                    </div>
                                                 </div>
                                                 <div class="row">
                                                    <div class="amount-box">
                                                        <span class="red-span">Recent Median Rental (per week)</span>
                                                        <div class="amount">
                                                            <span class="big">[</span>$<?php echo number_format($TotalRentalSale); ?><span class="big">]</span>
                                                        </div>
                                                    </div>
                                                   </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>                     
            					
        					<?php
                                ob_flush(); flush();                     
                            ?>
                                <div class="tab-pane fade" id="RentalStatisticsTab">
                                    <div class="row no-gutters">
                                        <div class="col-xl-6">
                                            <div class="rd-content">
                                                <h1 class="hero-title-dark sm-title">Average Rental Statistics</h1>
                                                <div class="container">
    
                                                     <div class="card">
    
                                                        <div class="card-body">
    
                                                             <div id="rentalstatistics"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-xl-6">
                                           <div class="rd-content">
                                                 <h1 class="hero-title-dark sm-title">Rental Rate Observations </h1>
                                                <div class="container">
                                                     <div class="card">
                                                        <div class="card-body">
                                                             <div id="rentalrateobservation"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                         <div class="col-xl-6">
                                            <div class="rd-content">
                                                <h1 class="hero-title-dark sm-title">Change in Rental Rate</h1>
                                                <div class="container">
    
                                                     <div class="card">
    
                                                        <div class="card-body">
    
                                                             <div id="changerenatalrate"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-xl-6">
                                           <div class="rd-content">
                                                 <h1 class="hero-title-dark sm-title">Value Based Gross Rental Yield</h1>
                                                <div class="container">
                                                     <div class="card">
                                                        <div class="card-body">
                                                             <div id="grossrentalyield"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>      
                            <?php
                                ob_flush(); flush();                     
                            ?>
                                <div class="tab-pane fade" id="HouseholdStatisticsTab">
            
                                    <div class="row no-gutters">
            
                                        <div class="col-xl-6">
                                            <div class="rd-content">
                                                <h1 class="hero-title-dark sm-title">Household Income</h1>
                                                <div class="container">
    
                                                     <div class="card">
    
                                                        <div class="card-body">
    
                                                             <div id="HouseholdIncome"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-xl-6">
                                           <div class="rd-content">
                                                 <h1 class="hero-title-dark sm-title">Age Ratio</h1>
                                                <div class="container">
                                                     <div class="card">
                                                        <div class="card-body">
                                                             <div id="AgeRatio"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-6">
                                           <div class="rd-content">
                                                 <h1 class="hero-title-dark sm-title">Household Structure</h1>
                                                <div class="container">
                                                     <div class="card">
                                                        <div class="card-body">
                                                             <div id="census"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>      
                            <?php
                                ob_flush(); flush();                     
                            ?>
                                
                                <div class="tab-pane fade" id="EducationStatisticsTab">
            
                                    <div class="row no-gutters">
            
                                        <div class="col-xl-6">
                                            <div class="rd-content">
                                                <h1 class="hero-title-dark sm-title">Education By Qualification</h1>
                                                <div class="container">
                                                     <div class="card">
                                                        <div class="card-body">
                                                             <div id="EducationByQf"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-xl-6">
                                           <div class="rd-content">
                                                 <h1 class="hero-title-dark sm-title">Education By Occupation</h1>
                                                <div class="container">
                                                     <div class="card">
                                                        <div class="card-body">
                                                             <div id="EducationByOccpation"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <?php

                                        if ( $countryId == "2")
                                            $StyleHide = " Style='display:none;' ";
                                        else
                                            $StyleHide ="";
                                        
    
                                        ?>

                                        
                                        <div class="col-xl-6" <?php echo $StyleHide; ?> >
                                           <div class="rd-content">
                                                 <h1 class="hero-title-dark sm-title">Education By Level</h1>
                                                <div class="container">
                                                     <div class="card">
                                                        <div class="card-body">
                                                             <div id="EducationByLevel"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <?php

                                        ob_flush(); flush();

                                        echo \api\apiClass::ShowMedianMapApi($LocationId,$StreetId,$ZipcodeId,$Subrub,"",$propertyTypeId,$countryId); 

                                        ?>
                                        
                                    </div>
                                </div>    
                                
                            <?php
                                ob_flush(); flush();                     
                            ?>   
                            
                              
                                
                        </div>
                    </div>
                    <!-- Tab End ----->
                    
                    
                       
                  
                   
                   
                        

                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.15.5/apexcharts.min.js"></script>

    

        

                        <?php 

                            

                            if ( $countryId == "2"){

                                

                                $MetricsRentalStatics ="49";

                                $MetricsRentalRate ="50";

                                $MetricsChangerenatalRate ="47";

                                $MetricsGrossRentalYield ="10";

                                

                                

                            }else{

                                $MetricsRentalStatics ="77";

                                $MetricsRentalRate ="78";

                                $MetricsChangerenatalRate ="79";

                                $MetricsGrossRentalYield ="80";

                            }

                            

                            ob_flush(); flush();

                            echo \api\apiClass::RentalStatisticsApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$MetricsRentalStatics,$countryId);

                            ob_flush(); flush();

                             echo \api\apiClass::RentalRateObservationApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$MetricsRentalRate,$countryId);

                            ob_flush(); flush();

                            echo \api\apiClass::ChangerenatalRateApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$MetricsChangerenatalRate,$countryId);

                            ob_flush(); flush();

                            echo \api\apiClass::GrossRentalYieldApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$MetricsGrossRentalYield,$countryId);

                            ob_flush(); flush();

                            //echo "LocationId=$LocationId";

                            

                            if ( $countryId == "2"){

                                

                                $MetricsShowCensusHousehold ="107";

                                $MetricsAgeRatio ="100";

                                $MetricsHouseholdIncome ="105";

                                $MetricsEducationByQf ="103";

                                $MetricsEducationByOccpation ="119";

                                

                            }else{

                                $MetricsShowCensusHousehold ="118";

                                $MetricsAgeRatio ="113";

                                $MetricsHouseholdIncome ="117";

                                 $MetricsEducationByQf ="114";

                                 $MetricsEducationByOccpation ="115";

                               

                            }

                            

                            

                             ob_flush(); flush();

                            echo \api\apiClass::AgeRatioApi("formap", $LocationId, "8", $MetricsAgeRatio);

                             ob_flush(); flush();

                            echo \api\apiClass::HouseholdIncomeApi("formap", $LocationId, "8", $MetricsHouseholdIncome);

                             ob_flush(); flush();

                            echo \api\apiClass::EducationByQfApi("formap", $LocationId, "8", $MetricsEducationByQf);

                             ob_flush(); flush();

                            echo \api\apiClass::EducationByOccpationApi("formap", $LocationId, "8", $MetricsEducationByOccpation);

                             ob_flush(); flush();

                            echo \api\apiClass::EducationByLevelApi("formap", $LocationId, "8", "116");

                            ob_flush(); flush();

                            echo \api\apiClass::ShowCensusHouseholdMapApi("formap", $LocationId, "8", $MetricsShowCensusHousehold);
                            
                            ob_flush(); flush();
                            

                        ?>
                        
                        <div class="row mt-12">
    
                            <div class="col-12">
    
                                <h1 class="hero-title-dark">CopyRights</h1>
                                
                                <div class="text-panel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p style="word-break: break-all;">
                                                <?php
                                                    echo \api\apiClass::CopyRightsApiDetails($countryId,"C");
                                                    
                                                      ob_flush(); flush();
                                                ?>
                                            </p>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                             <div class="col-12">
    
                                <h1 class="hero-title-dark">Disclaimers</h1>
                                
                                <div class="text-panel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php
                                                echo \api\apiClass::CopyRightsApiDetails($countryId,"D");
                                                
                                                  ob_flush(); flush();
                                            ?>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>

                <?php
                }
                else
                {
                    
                    ob_flush(); flush();
                    
                ?>
                   
                        <div class="grd-content">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="hero-title-dark">Suburb Report - <?php echo $Street;?></h1>
                                    <div class="vector-panel">
                                        <img src="assets/images/vector-blue.png" class="w-100" alt="">
                                    </div>
                                </div>
                            </div>
                            <?php
                            
                           // echo 'PropertyIds='.$PropertyIds;
                                
                                $productDetailsArr  =  \api\apiClass::PropertyDetailsApi($PropertyIds);
                                
                                foreach($productDetailsArr as $PDArr)
                                {
                                      $locallyFormattedAddress  = $PDArr["locallyFormattedAddress"] ;
                                      $longitude                = $PDArr["longitude"] ;
                                      $latitude                 = $PDArr["latitude"] ;
                                    
                                }
                                
                                
                                ob_flush(); flush();
                                
                                $PropertyDetailSiteArr  =  \api\apiClass::PropertyDetailSite($PropertyIds);
                                
                                $MaxLandValue = 0;
                                $MinLandValue = 0;
                                $AverageValue = 0;
                                
                                $i =1;
                                
                                foreach($PropertyDetailSiteArr as $PSiteArr)
                                {
                                      $PropertyDate     = $PSiteArr["PropertyDate"] ;
                                      $Propertytype     = $PSiteArr["Propertytype"] ;
                                      $valuationNumber  = $PSiteArr["valuationNumber"] ;
                                      $assessmentDate   = $PSiteArr["assessmentDate"] ;
                                      $value            = $PSiteArr["value"] ;
                                      $zoneDescriptionLocal  = $PSiteArr["zoneDescriptionLocal"] ;
                                      
                                      $AverageValue     = $AverageValue + $value;
                                  
                                      if($value >  $MaxLandValue  && $value != 0  )
                                      {
                                          
                                          $MaxLandValue = $value;
                                         
                                      }
                                      
                                   
                                      
                                      $i++;
                                    
                                } 
                                
                                $j = $i-1;
                                
                    
                               
                                $EstimatedValue = $AverageValue /$j;

                            ?>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h1 class="hero-title-dark">Project Overview - Avenue Apartments</h1>
                                </div>
                                <div class="col-12">
                                    <div class="p-overview-panel">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="descript-text">
                                                    <h5>Description</h5>
                                                    <p>&nbsp;</p>
                                                </div>
                                                <table class="table table-striped property-details-table centered-text">
                                                    <tr>
                                                        <td>
                                                            <span>Estimated Value</span> 
                                                            <strong>$<?php echo number_format(round($EstimatedValue)); ?></strong>
                                                        </td>
                                                        <td>
                                                            <span>Valuation Date</span>
                                                            <strong><?php echo $PropertyDate; ?></strong>
                                                        </td>
                                                        <td>
                                                            <span>Estimated Price Range</span>
                                                            <strong>$<?php echo number_format(round($EstimatedValue)); ?> - $<?php echo $MaxLandValue; ?></strong>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    
                                                           ob_flush(); flush();
                                
                                                            $PropertyDetailCoreArr  =  \api\apiClass::PropertyDetailCore($PropertyIds);
                                                            
                                                            $TotalValue = 0;
                                                            $AverageValue = 0;
                                                            
                                                            foreach($PropertyDetailCoreArr as $PCoreArr)
                                                            {
                                                                  $CategoryType             = $PCoreArr["CategoryType"] ;
                                                                  $CategorySubType          = $PCoreArr["CategorySubType"] ;
                                                                  $CategorySubTypeShort     = $PCoreArr["CategorySubTypeShort"] ;
                                                                  $beds                     = $PCoreArr["beds"] ;
                                                                  $baths                    = $PCoreArr["baths"] ;
                                                                  $carSpaces                = $PCoreArr["carSpaces"] ;
                                                                  $lockUpGarages            = $PCoreArr["lockUpGarages"] ;
                                                                  $landArea                 = $PCoreArr["landArea"] ;
                                                                  $isCalculatedLandArea     = $PCoreArr["isCalculatedLandArea"] ;
                                                                  $landAreaSource           = $PCoreArr["landAreaSource"] ;
                                                                  
                                                                
                                                            }
                                                            
                                                            
                                                            
                                                           
                                                           ob_flush(); flush();
                                
                                                            $PropertyDetailadditionalArr  =  \api\apiClass::PropertyDetailadditional($PropertyIds);
                                                            
                                              
                                                            
                                                            foreach($PropertyDetailadditionalArr as $PAddArr)
                                                            {
                                                                  $floorArea        = $PAddArr["floorArea"] ;
                                                                  $siteCover        = $PAddArr["siteCover"] ;
                                                                  $unitsOfUse       = $PAddArr["unitsOfUse"] ;
                                                                  $salesGroupId     = $PAddArr["salesGroupId"] ;
                                                                  $salesGroupName   = $PAddArr["salesGroupName"] ;
                                                            }
                                                            
                                                            ob_flush(); flush();
   
   
          
                                                            
                                                
                                                            
                                                    ?>
                                                    <tr>
                                                        <td colspan="3">
                                                            <span>Category</span>
                                                            <strong><?php echo $CategoryType; ?></strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <div class="px-4">
                                                                <span class="d-inline-block w-100 text-left">Property Attributes</span>
                                                                <div class="prop-attrs d-flex align-items-center justify-content-between">
                                                                    <div class="attr">
                                                                        <i class="fas fa-bed"></i>
                                                                        <span><?php echo $beds; ?></span>
                                                                    </div>
                                                                    <div class="attr">
                                                                        <i class="fas fa-bath"></i>
                                                                        <span><?php echo $baths; ?></span>
                                                                    </div>
                                                                    <div class="attr">
                                                                        <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/park.svg" alt="">
                                                                        <span><?php echo $carSpaces; ?></span>
                                                                    </div>
                                                                    <div class="attr">
                                                                        <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/floor-area.svg" alt="">
                                                                        <span>Floor Area <br> <?php echo $floorArea; ?> m<sup>2</sup> </span>
                                                                    </div>
                                                                    <div class="attr">
                                                                        <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/land-area.svg" alt="">
                                                                        <span>Land Area <br> <?php echo $landArea; ?> m<sup>2</sup> </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <div id="property-gallary" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        
                                                        <?php
                                                        
                                                                $PropertyDetailImagesArr  =  \api\apiClass::PropertyDetailImage($PropertyIds);
                                                            
                                                                //echo "<pre>"; print_r($PropertyDetailImagesArr); echo "</pre>"; 
                                        
                                                                //exit;
                        
                                                                $k = 1;
                                                                
                                                                foreach($PropertyDetailImagesArr as $PImageArr)
                                                                {
                                                                      $basePhotoUrl         = $PImageArr["basePhotoUrl"] ;
                                                                      $digitalAssetType     = $PImageArr["digitalAssetType"] ;
                                                                      $largePhotoUrl        = $PImageArr["largePhotoUrl"] ;
                                                                      $mediumPhotoUrl       = $PImageArr["mediumPhotoUrl"] ;
                                                                      $scanDate             = $PImageArr["scanDate"] ;
                                                                      $thumbnailPhotoUrl    = $PImageArr["thumbnailPhotoUrl"] ;
                                                                      
                                                                      if($basePhotoUrl != "")
                                                                      {
                                                                      
                                                        ?>
                                                            
                                                                        <div class="carousel-item <?php if($k==1) {?>active <?php } ?>">
                                                                            <div class="img-holder">
                                                                                <img src="<?php echo $largePhotoUrl;?>" class="img-fluid" alt="">
                                                                            </div>
                                                                        </div>
                                                            
                                                        <?php
                                                                      
                                                                      
                                                                         $k++;
                                                                      }
                                                                     
                                                                }
                                                                
                                                                ob_flush(); flush();
                                                                
                                                                if($k == 1)
                                                                {
                                                        ?>
                                                                    <div class="carousel-item active">
                                                                        <div class="img-holder">
                                                                            <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/big-image.png" class="img-fluid" alt="">
                                                                        </div>
                                                                    </div>
                                                        
                                                        <?php
                                                                    
                                                                }
       
                                                        ?>
                          
                                                        
                                                        
                                                        
                                                    
                                                      
                                                    </div>
                                                    <!--<ul class="carousel-indicators" style='display:none;'>
                                                        <li data-target="#property-gallary" data-slide-to="0" class="active">
                                                            <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/thumbnail.png" class="img-fluid" alt="">
                                                        </li>
                                                        <li data-target="#property-gallary" data-slide-to="1">
                                                            <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/thumbnail.png" class="img-fluid" alt="">
                                                        </li>
                                                        <li data-target="#property-gallary" data-slide-to="2">
                                                            <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/thumbnail.png" class="img-fluid" alt="">
                                                        </li>
                                                        <li data-target="#property-gallary" data-slide-to="3">
                                                            <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/thumbnail.png" class="img-fluid" alt="">
                                                        </li>
                                                        <li data-target="#property-gallary" data-slide-to="4">
                                                            <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/thumbnail.png" class="img-fluid" alt="">
                                                        </li>
                                                    </ul>-->
                                                    <br>
                                                </div>
                                                <div class="row gutters-5 mb-4 px-3">
                                                    <div class="col-lg-6">
                                                                 

                                                        <script src="https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js"></script>
                        
                                                        <link href="https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css" rel="stylesheet" />
                        
                                                        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
                        
                                                        <link
                        
                                                        rel="stylesheet"
                        
                                                        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"
                        
                                                        type="text/css"
                        
                                                        />
                        
                                                        <!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
                        
                                                        <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
                        
                                                        <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
                        
                                                        <style>
                        
                                                            .geocoder {
                        
                                                                position: absolute;
                        
                                                                z-index: 1;
                        
                                                                width: 50%;
                        
                                                                left: 50%;
                        
                                                                margin-left: -25%;
                        
                                                                top: 60px;
                        
                                                            }
                        
                                                            .mapboxgl-ctrl-geocoder {
                        
                                                                min-width: 100%;
                        
                                                            }
                        
                                                        </style>
                        
                                                        <div id="map6"></div>
                        
                                                        <script src="https://unpkg.com/es6-promise@4.2.4/dist/es6-promise.auto.min.js"></script>
                        
                                                        <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
                        
                                                        
                        
                                                        <script>
                        
                                                        	// TO MAKE THE MAP APPEAR YOU MUST
                        
                                                        	// ADD YOUR ACCESS TOKEN FROM
                        
                                                        	// https://account.mapbox.com
                        
                                                        	var CountryLat  = "<?php echo $latitude; ?>";
                        
                                                            var CountryLng  = "<?php echo $longitude; ?>";
                        
                                                            
                        
                                                            var CountryLatLag   =   eval("["+CountryLng+","+CountryLat+"]");
                        
                                                            //console.log(CountryLatLag);
                        
                                                        	mapboxgl.accessToken = 'pk.eyJ1IjoiY3B5YWRhdiIsImEiOiJjaWVtaGtwMmkwMDc5cnNrbXQwMGRheHZqIn0.tlEUXj14r-jWmk3Nkh075g';
                        
                                                            var map6 = new mapboxgl.Map({
                        
                                                            container: 'map6', // container id
                        
                                                            style: 'mapbox://styles/mapbox/streets-v11', // style URL
                        
                                                            center: CountryLatLag, // starting position [lng, lat]
                        
                                                            zoom: 9 // starting zoom
                        
                                                            });
                        
                                                        </script>
                                    
                                                                

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="avm">
                                                            <h5>Automative Valuation Model Report</h5>
                                                            <div class="d-flex align-items-start">
                                                                <div class="text">
                                                                    <p>Click on the download report to get your Automative Valuation Model Report for your property</p>
                                                                </div>
                                                                <div class="download">
                                                                    <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/avm.svg" alt="">
                                                                    <button class="btn btn-download">Download Report</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php
                            
                                ob_flush(); flush();
                                
                                $PropertyDetailCurrentArr  =  \api\apiClass::PropertyDetailCurrent($PropertyIds);
                                
                                $TotalValue = 0;
                                $AverageValue = 0;
                                
                                foreach($PropertyDetailCurrentArr as $PCurrentArr)
                                {
                                      $Owner         = $PCurrentArr["Owner"] ;
                                      $Title         = $PCurrentArr["Title"] ;
                                    
                                }
                                
                                ob_flush(); flush();
                                
                                $PropertyDetailLastArr  =  \api\apiClass::PropertyDetailLast($PropertyIds);
                                
                                $TotalValue = 0;
                                $AverageValue = 0;
                                
                                foreach($PropertyDetailLastArr as $PLastArr)
                                {
                                      $lastOfficalPrice         = $PLastArr["lastOfficalPrice"] ;
                                      $settlementDate           = $PLastArr["settlementDate"] ;
                                      $LastOfficialSaleType     = $PLastArr["LastOfficialSaleType"] ;
                                      $netPrice                 = $PLastArr["netPrice"] ;
                                      $chattelsPrice             = $PLastArr["chattelsPrice"] ;
                                    
                                }
                                
                                ob_flush(); flush();
                             
                                
                                
                            ?>
        
                            <div class="row mt-4">
                                <div class="col-xl-6">
                                    <h1 class="hero-title-dark">Property Detail</h1>
                                    <div class="pd-panel mb-4">
                                        <table class="table">
                                            <tr>
                                                <td>Owners</td>
                                                <th><?php echo $Owner; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Certificate Of Title</td>
                                                <th><?php echo $Title; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Last Official Sale Price</td>
                                                <th><?php echo number_format(round($lastOfficalPrice)); ?></th>
                                            </tr> 
                                            <tr>
                                                <td>Last Official Sale Date</td>
                                                <th><?php echo $settlementDate; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Last Official Sale Type</td>
                                                <th><?php echo $LastOfficialSaleType; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Sale Tenure</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Purchase Relationship</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Tile Profil e/ GOOD</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Chattels</td>
                                                <th><?php echo $chattelsPrice; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Rating Valuations</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Land Value</td>
                                                <th>$<?php echo number_format(round($EstimatedValue));?></th>
                                            </tr>
                                            <tr>
                                                <td>Improvements</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Value Valuation Date</td>
                                                <th><?php echo $assessmentDate; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Valuation Address</td>
                                                <th><?php echo $zoneDescriptionLocal;?></th>
                                            </tr>
                                            <tr>
                                                <td>Valuation Reference</td>
                                                <th><?php echo $valuationNumber;?></th>
                                            </tr>
                                            <tr>
                                                <td>Legal Description</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>TA Name</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Tenure</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Parking Frees1andlng</td>
                                                <th><?php echo $carSpaces; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Land Use</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Zoning</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Floor Area</td>
                                                <th><?php echo $floorArea; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Land Area</td>
                                                <th><?php echo $landArea; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Bedrooms</td>
                                                <th><?php echo $beds; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Building Age</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Category</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Wall Material</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Roof Material</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Contour</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td>Deck</td>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <h1 class="hero-title-dark">Radius Search</h1>
        
                                    <div class="distance-panel mb-4">
                                        <div class="d-range">
                                            <label for="customRange">Distance</label>
                                            <input type="range" class="custom-range" id="customRange" name="points1">
                                            <p class="d-flex justify-content-between mb-5">
                                                <span>100m</span>
                                                <span>250m</span>
                                                <span>500m</span>
                                                <span>750m</span>
                                                <span>1Km</span>
                                                <span>2Km</span>
                                                <span>2Km+</span>
                                            </p>
                                        </div>
                                        <div class="d-flex align-items-center mb-4">
                                            <label for="" class="mb-0 mr-3">Sold In The Last</label>
                                            <select name="" id="" class="form-control">
                                                <option value="6">6 Months</option>
                                                <option value="6">6 Months</option>
                                                <option value="6">6 Months</option>
                                                <option value="6">6 Months</option>
                                                <option value="6">6 Months</option>
                                            </select>    
                                        </div>
                                        <div class="d-flex align-items-center mb-4">
                                            <label for="" class="mb-0 mr-3">Listed In The Last</label>
                                            <select name="" id="" class="form-control">
                                                <option value="6">No Listing Filter</option>
                                                <option value="6">6 Months</option>
                                                <option value="6">6 Months</option>
                                                <option value="6">6 Months</option>
                                                <option value="6">6 Months</option>
                                            </select>    
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="d-flex align-items-center mb-4">
                                                    <label for="" class="mb-0 mr-3">Of the Type</label>
                                                    <select name="" id="" class="form-control">
                                                        <option value="6">All</option>
                                                        <option value="6">6 Months</option>
                                                        <option value="6">6 Months</option>
                                                        <option value="6">6 Months</option>
                                                        <option value="6">6 Months</option>
                                                    </select>    
                                                </div>
                                            </div>
                                            <div class="col-xl-6" style="margin-top:-30px;">
                                                <label for="">Options</label>
                                                <div class="form-check">
                                                  <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
                                                    Highlight subject property
                                                  </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button class="btn btn-orange ml-auto">Start Radius Search</button>
                                            </div>
                                        </div>
                                    </div>
        
                                    <h1 class="hero-title-dark">Details for this Property</h1>
                                    <div class="checks-panel">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp1" name="cp-checks">
                                            <label class="custom-control-label" for="cp1">Property Summary</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp2" name="cp-checks">
                                            <label class="custom-control-label" for="cp2">Market Watch</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="c3p" name="cp-checks">
                                            <label class="custom-control-label" for="c3p">Title Report <i class="far fa-file-pdf"></i></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp4" name="cp-checks">
                                            <label class="custom-control-label" for="cp4">Recent Sales within 1km of property <i class="far fa-file-pdf"></i></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp5" name="cp-checks">
                                            <label class="custom-control-label" for="cp5">Valuation and Previous Sales <i class="far fa-file-pdf"></i></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp6" name="cp-checks">
                                            <label class="custom-control-label" for="cp6">Valuation Report <i class="far fa-file-pdf"></i></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp7" name="cp-checks">
                                            <label class="custom-control-label" for="cp7">Title Transactions <i class="far fa-file-pdf"></i></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp8" name="cp-checks">
                                            <label class="custom-control-label" for="cp8">Survey Report <i class="far fa-file-pdf"></i></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp9" name="cp-checks">
                                            <label class="custom-control-label" for="cp9">Building Consents Report <i class="far fa-file-pdf"></i></label>
                                        </div>
                                        <div class="contained">
                                            <h5>Imagery</h5>
                                            <div class="custom-control custom-checkbox bt-1">
                                                <input type="checkbox" class="custom-control-input" id="cp10" name="cp-checks">
                                                <label class="custom-control-label" for="cp10">Property Boundary Map <i class="far fa-file-pdf"></i></label>
                                            </div>
                                            <div class="custom-control custom-checkbox bb-1">
                                                <input type="checkbox" class="custom-control-input" id="cp11" name="cp-checks">
                                                <label class="custom-control-label" for="cp11">Aerial photo and boundary map <i class="far fa-file-pdf"></i></label>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp12" name="cp-checks">
                                            <label class="custom-control-label" for="cp12">Schools and Zones </label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp13" name="cp-checks">
                                            <label class="custom-control-label" for="cp13">Market Rent <i class="far fa-file-pdf"></i></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp14" name="cp-checks">
                                            <label class="custom-control-label" for="cp14">Statistics NZ Community Profile <i class="far fa-file-pdf"></i></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp15" name="cp-checks">
                                            <label class="custom-control-label" for="cp15">Statistics NZ Building Consents</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp16" name="cp-checks">
                                            <label class="custom-control-label" for="cp16">Auckland City Website</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp17" name="cp-checks">
                                            <label class="custom-control-label" for="cp17">Regional Website</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cp18" name="cp-checks">
                                            <label class="custom-control-label" for="cp18">Companies Office</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="row mt-12">
    
                            <div class="col-12">
    
                                <h1 class="hero-title-dark">CopyRights</h1>
                                
                                <div class="text-panel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p style="word-break: break-all;">
                                                <?php
                                                    echo \api\apiClass::CopyRightsApiDetails($countryId,"C");
                                                    
                                                      ob_flush(); flush();
                                                ?>
                                            </p>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                             <div class="col-12">
    
                                <h1 class="hero-title-dark">Disclaimers</h1>
                                
                                <div class="text-panel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php
                                                echo \api\apiClass::CopyRightsApiDetails($countryId,"D");
                                                
                                                  ob_flush(); flush();
                                            ?>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        </div>

                    <!-- Inner Content End-->
                
                <?php
                }
                ?>

            </div>

            <!-- Inner Content End-->

            <?php

            }

            ?>



            </div>

            <!-- Inner Content End-->

            

            

            

        </div>

        <!-- Right Wrapper End -->

    </div>

    

</form>

    

    <!-- Date Picker Plugin JavaScript -->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>



    <script src="assets/js/jquery.js"></script>

    <script src="assets/js/bootstrap.js"></script>

    <script src="assets/js/owl.js"></script>

    <script src="assets/js/custom.js"></script>

    

    <script type='text/javascript' >

        
         $(document).on("change", "#SuburbLocation", function(){
               
        	    SuburbLocationFn();
        });



        $(document).ready(function() {
            SuburbLocationFn();
           
            

            GraphFunctionPricepaid();

            GraphFunctionBraodband();

            GraphFunctionMeanIncome();

            GraphFunctionReportedCrime();

            GraphFunctionSalesDayListing();

            GraphFunctionFlatSalesListings();

        });

        
        var SuburbLocationFn = function(){
            
            
            
            var SuburbLocation = $("#SuburbLocation").val();
            

            
            if(SuburbLocation == "SB")
            {
                $("#SubrubLocationBox").show();
                $("#StreetLocationBox").hide();
            }
            else
            {
                $("#SubrubLocationBox").hide();
                $("#StreetLocationBox").show();
            }
            
        }

        var GraphFunctionPricepaid = function(){

            

            var MonthdateTemp      = "<?php echo $MonthdateTemp; ?>";

            var GraphPricePaid     = "<?php echo $TotalGraphPricePaid; ?>";

            var GraphPricePaid1    = "<?php echo $TotalGraphPricePaid1; ?>";

            var GraphPricePaid2    = "<?php echo $TotalGraphPricePaid2; ?>";

            var GraphPricePaid3    = "<?php echo $TotalGraphPricePaid3; ?>";

                                         

            

    

            TotalMonthdateTemp 			= eval("['"+ MonthdateTemp +"']");

        	TotalGraphPricePaid 		= eval("[" + GraphPricePaid + "]");

        	TotalGraphPricePaid1 		= eval("[" + GraphPricePaid1 + "]");

        	TotalGraphPricePaid2 		= eval("[" + GraphPricePaid2 + "]");

        	TotalGraphPricePaid3 	    = eval("[" + GraphPricePaid3 + "]");

        	

        

        

    	  var options = {

    

    			  series: [{

    

    			  type: 'column',	

    

    			  name: '1 Bed Flat Price Paid Secondary',

    

    			  data: TotalGraphPricePaid1

    

    			}, {

    

    				type: 'column',	

    

    			  name: '2 Bed Flat Price Paid Secondary',

    

    			  data: TotalGraphPricePaid2

    

    			}, {

    

    				type: 'column',

    

    			  name: '3 Bed Flat Price Paid Secondary',

    

    			  data: TotalGraphPricePaid3

    

    			}

    			],

    

    			  chart: {

    			  type: 'line',

    			  stacked:false,

    			  height: 550

    			},

    			title: {

    				text: 'Price Paid',

    				align: 'center',

    				margin: 10,

    				offsetX: 0,

    				offsetY: 0,

    				floating: false,

    					style: {

    					  fontSize:  '22px',

    					  color:  '#263238'

    					},

    				},

    

    			legend: {

    				show: true,

    				showForSingleSeries: false,

    				showForNullSeries: true,

    				showForZeroSeries: true,

    				position: 'bottom',

    				horizontalAlign: 'center', 

    				floating: false,

    				fontSize: '16px',

    				formatter: undefined,

    				inverseOrder: false,

    				width: undefined,

    				height: 50,

    				tooltipHoverFormatter: undefined,

    				offsetX: 0,

    				offsetY: 0,

    				labels: {

    					colors: undefined,

    					useSeriesColors: true

    				},

    			},

    			plotOptions: {

    			  bar: {

    				horizontal: false,

    				columnWidth: '100%',

    			  },

    			},

    			dataLabels: {

    			  enabled: false

    			},

    			stroke: {

    			  show: true,

    			  width: 2,

    			  colors: ['transparent']

    			},

    			xaxis: {

    			  categories: TotalMonthdateTemp,

    			},

    			yaxis: {

    			  title: {

    				text: undefined

    			  },

                  labels: {

                    formatter: function (value) {

                      return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); 

                    },

                    style: {

                      color: '#3f51b5'

                    }

                  }

    			},

    			fill: {

    			  opacity: 1

    			},

    			tooltip: {

    			  y: {

    				formatter: function (val) {

    				  return "$ " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')

    				}

    			  }

    			}

    		};

    

    	var chart = new ApexCharts(document.querySelector("#columnchart"), options);

    	chart.render();

    



        }

        

        var GraphFunctionBraodband = function(){

            

            

            

            var MonthdateTemp               = "<?php echo $MonthDetailGraph; ?>";

            var BraodbandSpeedGraph              = "<?php echo $BroadbandSpeedGraph; ?>";

            



            TotalMonthdateTemp 			    = eval("['"+ MonthdateTemp +"']");

        	TotalBroadbandSpeedGraph 		= eval("[" + BraodbandSpeedGraph + "]");

        	

        //	alert(TotalMonthdateTemp);

        //	alert(TotalBroadbandSpeedGraph);

        	

              var colors9 = ['#685F25'];

              var options = {

              chart: {

                toolbar:{

                  show:false

                },

                height: 380,

                type: 'bar',

                stacked: false

              },

              plotOptions: {

                bar: {

                  horizontal: false,

                  columnWidth: '50px',

                  endingShape: 'flat',

                  colors: {

                      backgroundBarColors: ['#eee'],

                      backgroundBarOpacity: 1,

                  },

                },

              },

              colors: colors9,

              dataLabels: {

                enabled: false

              },

              series: [

                {

                  name: 'Broad Band', 

                  type: 'column',

                  data: TotalBroadbandSpeedGraph

                }

              ],

              xaxis: {

                categories: TotalMonthdateTemp,

                title: {

                    text: 'Month',

                    style: {

                      fontSize:  '10 px',

                      fontWeight:  'normal',

                      fontFamily:  undefined,

                      color:  '#263238'

                    },

                  }

              },

              yaxis: [

                {

                  axisTicks: {

                    show: true

                  },

                  axisBorder: {

                    show: true,

                    color: '#3f51b5'

                  },

                  labels: {

                    formatter: function (value) {

                      return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); ;

                    },

                    style: {

                      color: '#3f51b5'

                    }

                  },

                  title: {

                    text: 'Braodband Speed',

                    style: {

                      fontSize:  '10 px',

                      fontWeight:  'normal',

                      fontFamily:  undefined,

                      color:  '#263238'

                    },

                  }

                },

                {

                  axisTicks: {

                    show: false

                  },

                  axisBorder: {

                    show: false,

                    color: '#FFA600'

                  },

                  labels: {

                    show: false,

                    style: {

                      color: '#FFA600'

                    }

                  }

                }

              ],

              tooltip: {

                followCursor: true,

                    y: {

                      formatter: function(y) {

                        if (typeof y !== 'undefined') {

                          return Math.round(y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); 

                        }

                        return y;

                      }

                    },

                    x: {

                        show:true,

                        formatter: function (value) {

                          return value;

                        }

                      }

              },

              markers: {

                size: 5,

                hover: {

                  size: 9

                }

              }

            };

            

            var chart = new ApexCharts(document.querySelector('#BraodbandSpeed'), options);

            

            chart.render();

                    

             

        }

        

        var GraphFunctionMeanIncome = function(){

            

            

            var MonthdateTemp      = "<?php echo $MonthDetailGraph; ?>";

            var MeanIncomeGraphNew     = "<?php echo $MeanIncomeGraph; ?>";

     

                                         

            

    

            TotalMonthdateTemp 			= eval("['"+ MonthdateTemp +"']");

        	TotalMeanIncomeGraph 		= eval("[" + MeanIncomeGraphNew + "]");

        	



        	

              var colors9 = ['#685F25'];

              var options = {

              chart: {

                toolbar:{

                  show:false

                },

                height: 380,

                type: 'bar',

                stacked: false

              },

              plotOptions: {

                bar: {

                  horizontal: false,

                  columnWidth: '50px',

                  endingShape: 'flat',

                  colors: {

                      backgroundBarColors: ['#eee'],

                      backgroundBarOpacity: 1,

                  },

                },

              },

              colors: colors9,

              dataLabels: {

                enabled: false

              },

              series: [

                {

                  name: 'Mean Income', 

                  type: 'column',

                  data: TotalMeanIncomeGraph

                }

              ],

              xaxis: {

                categories: TotalMonthdateTemp,

                title: {

                    text: 'Month',

                    style: {

                      fontSize:  '10 px',

                      fontWeight:  'normal',

                      fontFamily:  undefined,

                      color:  '#263238'

                    },

                  }

              },

              yaxis: [

                {

                  axisTicks: {

                    show: true

                  },

                  axisBorder: {

                    show: true,

                    color: '#3f51b5'

                  },

                  labels: {

                    formatter: function (value) {

                      return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); ;

                    },

                    style: {

                      color: '#3f51b5'

                    }

                  },

                  title: {

                    text: 'Income',

                    style: {

                      fontSize:  '10 px',

                      fontWeight:  'normal',

                      fontFamily:  undefined,

                      color:  '#263238'

                    },

                  }

                },

                {

                  axisTicks: {

                    show: false

                  },

                  axisBorder: {

                    show: false,

                    color: '#FFA600'

                  },

                  labels: {

                    show: false,

                    style: {

                      color: '#FFA600'

                    }

                  }

                }

              ],

              tooltip: {

                followCursor: true,

                    y: {

                      formatter: function(y) {

                        if (typeof y !== 'undefined') {

                          return Math.round(y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); 

                        }

                        return y;

                      }

                    },

                    x: {

                        show:true,

                        formatter: function (value) {

                          return value;

                        }

                      }

              },

              markers: {

                size: 5,

                hover: {

                  size: 9

                }

              }

            };

            

            var chart = new ApexCharts(document.querySelector('#MeanIncomeGraphId'), options);

            

            chart.render();

                    

  

        }

        

        

        

        var GraphFunctionReportedCrime = function(){

            

            

            var MonthdateTemp               = "<?php echo $MonthDetailGraph; ?>";

            var ReportedCrimesGraphNew     = "<?php echo $ReportedCrimesGraph; ?>";

     



            TotalMonthdateTemp 			= eval("['"+ MonthdateTemp +"']");

        	TotalReportedCrimesGraph 	= eval("[" + ReportedCrimesGraphNew + "]");

        	



        	

              var colors9 = ['#685F25'];

              var options = {

              chart: {

                toolbar:{

                  show:false

                },

                height: 380,

                type: 'bar',

                stacked: false

              },

              plotOptions: {

                bar: {

                  horizontal: false,

                  columnWidth: '50px',

                  endingShape: 'flat',

                  colors: {

                      backgroundBarColors: ['#eee'],

                      backgroundBarOpacity: 1,

                  },

                },

              },

              colors: colors9,

              dataLabels: {

                enabled: false

              },

              series: [

                {

                  name: 'Crime', 

                  type: 'column',

                  data: TotalReportedCrimesGraph

                }

              ],

              xaxis: {

                categories: TotalMonthdateTemp,

                title: {

                    text: 'Month',

                    style: {

                      fontSize:  '10 px',

                      fontWeight:  'normal',

                      fontFamily:  undefined,

                      color:  '#263238'

                    },

                  }

              },

              yaxis: [

                {

                  axisTicks: {

                    show: true

                  },

                  axisBorder: {

                    show: true,

                    color: '#3f51b5'

                  },

                  labels: {

                    formatter: function (value) {

                      return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); ;

                    },

                    style: {

                      color: '#3f51b5'

                    }

                  },

                  title: {

                    text: 'Income',

                    style: {

                      fontSize:  '10 px',

                      fontWeight:  'normal',

                      fontFamily:  undefined,

                      color:  '#263238'

                    },

                  }

                },

                {

                  axisTicks: {

                    show: false

                  },

                  axisBorder: {

                    show: false,

                    color: '#FFA600'

                  },

                  labels: {

                    show: false,

                    style: {

                      color: '#FFA600'

                    }

                  }

                }

              ],

              tooltip: {

                followCursor: true,

                    y: {

                      formatter: function(y) {

                        if (typeof y !== 'undefined') {

                          return Math.round(y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); 

                        }

                        return y;

                      }

                    },

                    x: {

                        show:true,

                        formatter: function (value) {

                          return value;

                        }

                      }

              },

              markers: {

                size: 5,

                hover: {

                  size: 9

                }

              }

            };

            

            var chart = new ApexCharts(document.querySelector('#CrimeLevelGraph'), options);

            

            chart.render();

                    

  

        }

        

         var GraphFunctionSalesDayListing = function(){

            

                var MonthdateTemp      = "<?php echo $MonthdateTemp; ?>";

                var DaysMarSalesGraph  = "<?php echo $TotalDaysMarSalesGraph; ?>";

                var SalesListGraph    = "<?php echo $TotalSalesListGraph; ?>";

                                             

                

        

                TotalMonthdateTemp 			= eval("['"+ MonthdateTemp +"']");

            	TotalDaysMarSalesGraph 		= eval("[" + DaysMarSalesGraph + "]");

            	TotalSalesListGraph 		= eval("[" + SalesListGraph + "]");

            	

            

            

        	  var options = {

        

        		 series: [

        			      {

        

        			  type: 'column',

        			  name: 'Days on Market - Sales',

        			  data: TotalDaysMarSalesGraph

        

        			},{

        

        			  type: 'column',

        			  name: 'Flat Sales Listings',

        			  data: TotalSalesListGraph

        

        			}

        			],

        

        			  chart: {

        			  type: 'line',

        			  stacked:false,

        			  height: 550

        			},

        			title: {

        				text: 'Flat Sales Days on Market vs Listings',

        				align: 'center',

        				margin: 10,

        				offsetX: 0,

        				offsetY: 0,

        				floating: false,

        					style: {

        					  fontSize:  '22px',

        					  color:  '#263238'

        					},

        				},

        

        			legend: {

        				show: true,

        				showForSingleSeries: false,

        				showForNullSeries: true,

        				showForZeroSeries: true,

        				position: 'bottom',

        				horizontalAlign: 'center', 

        				floating: false,

        				fontSize: '16px',

        				formatter: undefined,

        				inverseOrder: false,

        				width: undefined,

        				height: 50,

        				tooltipHoverFormatter: undefined,

        				offsetX: 0,

        				offsetY: 0,

        				labels: {

        					colors: undefined,

        					useSeriesColors: true

        				},

        			},

        			plotOptions: {

        			  bar: {

        				horizontal: false,

        				columnWidth: '100%',

        			  },

        			},

        			dataLabels: {

        			  enabled: false

        			},

        			stroke: {

        			  show: true,

        			  width: 2,

        			  colors: ['transparent']

        			},

        			xaxis: {

        			  categories: TotalMonthdateTemp,

        			},

        			yaxis: {

        			  title: {

        				text: undefined

        			  },

                      labels: {

                        formatter: function (value) {

                          return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); 

                        },

                        style: {

                          color: '#3f51b5'

                        }

                      }

        			},

        			fill: {

        			  opacity: 1

        			},

        			tooltip: {

        			  y: {

        				formatter: function (val) {

        				  return "$ " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')

        				}

        			  }

        			}

        		};

        

        	var chart = new ApexCharts(document.querySelector("#columnchart1"), options);

        	chart.render();

    



        }

        

         var GraphFunctionFlatSalesListings = function(){

            

            

            var MonthdateTemp            = "<?php echo $MonthdateTemp; ?>";

            var SalesListGraphNew       = "<?php echo $TotalSalesListGraph; ?>";

     



            TotalMonthdateTemp 			= eval("['"+ MonthdateTemp +"']");

        	TotalSalesListGraph 	    = eval("[" + SalesListGraphNew + "]");

        	



        	

              var colors9 = ['#685F25'];

              var options = {

              chart: {

                toolbar:{

                  show:false

                },

                height: 380,

                type: 'bar',

                stacked: false

              },

              plotOptions: {

                bar: {

                  horizontal: false,

                  columnWidth: '50px',

                  endingShape: 'flat',

                  colors: {

                      backgroundBarColors: ['#eee'],

                      backgroundBarOpacity: 1,

                  },

                },

              },

              colors: colors9,

              dataLabels: {

                enabled: false

              },

              series: [

                {

                  name: 'Flat Sales Listings Distribution', 

                  type: 'column',

                  data: TotalSalesListGraph

                }

              ],

              xaxis: {

                categories: TotalMonthdateTemp,

                title: {

                    text: 'Month',

                    style: {

                      fontSize:  '10 px',

                      fontWeight:  'normal',

                      fontFamily:  undefined,

                      color:  '#263238'

                    },

                  }

              },

              yaxis: [

                {

                  axisTicks: {

                    show: true

                  },

                  axisBorder: {

                    show: true,

                    color: '#3f51b5'

                  },

                  labels: {

                    formatter: function (value) {

                      return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); ;

                    },

                    style: {

                      color: '#3f51b5'

                    }

                  },

                  title: {

                    text: 'Flat Sales Listings Distribution',

                    style: {

                      fontSize:  '10 px',

                      fontWeight:  'normal',

                      fontFamily:  undefined,

                      color:  '#263238'

                    },

                  }

                },

                {

                  axisTicks: {

                    show: false

                  },

                  axisBorder: {

                    show: false,

                    color: '#FFA600'

                  },

                  labels: {

                    show: false,

                    style: {

                      color: '#FFA600'

                    }

                  }

                }

              ],

              tooltip: {

                followCursor: true,

                    y: {

                      formatter: function(y) {

                        if (typeof y !== 'undefined') {

                          return Math.round(y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); 

                        }

                        return y;

                      }

                    },

                    x: {

                        show:true,

                        formatter: function (value) {

                          return value;

                        }

                      }

              },

              markers: {

                size: 5,

                hover: {

                  size: 9

                }

              }

            };

            

            var chart = new ApexCharts(document.querySelector('#FlatSalesListings'), options);

            

            chart.render();

                    

  

        }

	

        function validateForm() {

        

            if(document.getElementById("LocationId").value=="")

            {

                alert("Select Suburb from the list");

                return false;

            }

            

            

            var countryId =  $("#countryId").val();

            

            //alert('countryId='+countryId)

            

            

            if (countryId == "3"  ){

                

                // PropertyCheckedFn();

            }

    

           

        }

        

        var PropertyCheckedFn = function(){

   

    //function PropertyCheckedFn(){

         

        var MultiPropertyVal="";

    	var MultiPropertyId = document.getElementsByName("datasource");

    	k=0;

    

    	for(i=0;i<=MultiPropertyId.length-1;i++){ 

    

    		if(MultiPropertyId[i].checked == true){

    		    if ( MultiPropertyVal == ""){

    		        MultiPropertyVal =  MultiPropertyId[i].value ;

    		      

    		    }else{

    		        MultiPropertyVal = MultiPropertyVal + "," + MultiPropertyId[i].value ;

    		        

    		    } 

    			k++;

    		}

    		

    	} 

    	

    	

    	var MultiPropertyValNew="";

    	var MultiPropertyNewId = document.getElementsByName("datasourceNew");

    	M=0;

    

    	for(i=0;i<=MultiPropertyNewId.length-1;i++){ 

    

    		if(MultiPropertyNewId[i].checked == true){

    		    if ( MultiPropertyValNew == ""){

    		        MultiPropertyValNew =  MultiPropertyNewId[i].value ;

    		      

    		    }else{

    		        MultiPropertyValNew = MultiPropertyValNew + "," + MultiPropertyNewId[i].value ;

    		        

    		    } 

    			M++;

    		}

    		

    	} 

    	

       var MultiPropertyValOther="";

    	var MultiPropertyValOtherId = document.getElementsByName("datasourceOther");

    	P=0;

    

    	for(i=0;i<=MultiPropertyValOtherId.length-1;i++)

    	{ 

    

    		if(MultiPropertyValOtherId[i].checked == true){

    		    if ( MultiPropertyValOther == ""){

    		        MultiPropertyValOther =  MultiPropertyValOtherId[i].value ;

    		      

    		    }else{

    		        MultiPropertyValOther = MultiPropertyValOther + "," + MultiPropertyValOtherId[i].value ;

    		        

    		    } 

    			P++;

    		}

    	} 



    	

    	if (k==0 && M==0 && P == 0 ){

    	    //alert("Please select atleast Transactional");

    	    //return false;

    	}else{

    	    

    	    $("#MultiPropertyVal").val(MultiPropertyVal);

        	$("#MultiPropertyValNew").val(MultiPropertyValNew);

        	$("#MultiPropertyValOther").val(MultiPropertyValOther);

    	}



    	$("#loading").show();

    	

    

     }

     

     

      function BuildTypeFN(){

         

         OverViewAjaxFN();

        

     }

    

    

     var OverViewAjaxFN = function(){

         



                LocationId      = $("#LocationId").val();

                OverViewDataSrc = "SalesOverView";

                BuildType       = $("input[name=BuildType]:checked").val();

                bedrooms        = $("#bedrooms").val();

                propertyType    = '<?php echo $propertyType; ?>';

                datefilter1     = $("#datefilter1").val();

                datefilter2     = $("#datefilter2").val();

                

            /*   

                console.log('LocationId'+LocationId);

                console.log('OverViewDataSrc'+OverViewDataSrc);

                console.log('BuildType'+BuildType);

                console.log('bedrooms'+bedrooms);

                console.log('propertyType'+propertyType);

                console.log('datefilter1'+datefilter1);

                console.log('datefilter2'+datefilter2);

            */

               var Formdata = {

                   "LocationId" : LocationId,

                   "OverViewDataSrc": OverViewDataSrc,

                   "BuildType": BuildType,

                   "bedrooms": bedrooms,

                   "propertyType": propertyType,

                   "datefilter1": datefilter1,

                   "datefilter2": datefilter2

               };

               

               //console.log('<?php echo SITE_BASE_URL;?>api/OverviewSalesRentAjax.html');

          

            

                $.ajax({

                url: '<?php echo SITE_BASE_URL;?>api/OverviewSalesRentAjax.html',

                method: "POST",

                dataType: 'json',

                data: Formdata,

                success: function (data) {

                    

                        $(".scift").html(data.scift);

                        $(".PricePaid").html(data.PricePaid);

                        $(".PaidDiscount").html(data.PaidDiscount);

                        $(".GrossYield").html(data.GrossYield);

                        $(".SalesListing").html(data.SalesListing);

                        $(".SalesTransactions").html(data.SalesTransactions);

                        

                        $(".sciftBd1").html(data.sciftBd1);

                        $(".PricePaidBd1").html(data.PricePaidBd1);

                        $(".PaidDiscountBd1").html(data.PaidDiscountBd1);

                        $(".GrossYieldBd1").html(data.GrossYieldBd1);

                        $(".SalesListingBd1").html(data.SalesListingBd1);

                        $(".SalesTransactionsBd1").html(data.SalesTransactionsBd1);

                        

                        $(".sciftBd2").html(data.sciftBd2);

                        $(".PricePaidBd2").html(data.PricePaidBd2);

                        $(".PaidDiscountBd2").html(data.PaidDiscountBd2);

                        $(".GrossYieldBd2").html(data.GrossYieldBd2);

                        $(".SalesListingBd2").html(data.SalesListingBd2);

                        $(".SalesTransactionsBd2").html(data.SalesTransactionsBd2);

                        

                        

                        $(".sciftBd3").html(data.sciftBd3);

                        $(".PricePaidBd3").html(data.PricePaidBd3);

                        $(".PaidDiscountBd3").html(data.PaidDiscountBd3);

                        $(".GrossYieldBd3").html(data.GrossYieldBd3);

                        $(".SalesListingBd3").html(data.SalesListingBd3);

                        $(".SalesTransactionsBd3").html(data.SalesTransactionsBd3);

                        

                        $(".sqfiRent").html(data.sqfiRent);

                        $(".RentList").html(data.RentList);

                        

                        $(".sqfiRentBd1").html(data.sqfiRentBd1);

                        $(".RentListBd1").html(data.RentListBd1);

                        

                        

                        $(".sqfiRentBd2").html(data.sqfiRentBd2);

                        $(".RentListBd2").html(data.RentListBd2);

                        

                        $(".sqfiRentBd3").html(data.sqfiRentBd3);

                        $(".RentListBd3").html(data.RentListBd3);

                        

                        //GraphFunctionPricepaid();

                   

                    }

                });

                

            

        }

        

       

     

    



         

     

    

    </script>





<?php include "footer.php"; ?>