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


ob_flush(); flush();
?>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" />

<form name="frmSearch" id="frmSearch" method="post" action="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=<?php echo $countryId; ?>"  onsubmit="return validateForm()"  >   
    <!-- Right Wrapper Start -->
    <div class="right-wrapper">
        <!-- Inner Content Start-->
        <div class="inner-wrapper">
            <!-- Search Bar Start -->
            <div class="search-time-holder">
                <div class="search-bar">
                   
                    <div class="input-group">
                        <select class="form-control" name="choose" id="choose">
                            <option value="all">All</option>
                            <option value="1">Other</option>
                            <option value="2">Other</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Rental Investment">
                    </div>
                </div>
                <div class="time-slots">
                    <div class="single-time">
                        <p>03:24</p>
                        <small>pst</small>
                    </div>
                    <div class="single-time">
                        <p>03:24</p>
                        <small>pst</small>
                    </div>
                    <div class="single-time">
                        <p>03:24</p>
                        <small>pst</small>
                    </div>
                    <button class="btn btn-dark">Add<br>Clock</button>
                </div>
            </div>
            <!-- Search Bar End -->
            
             <!-- Location Header  Start -->
            <div class="search-time-holder">
                <div class="search-bar">
                    <div class="input-group">
                        <input class="form-control class_sub" type="text" name="Subrub" id="Suburb" placeholder="Suburb" value="<?php echo $Subrub;?>" autocomplete=off />
                        <input class="form-control" type="hidden" name="LocationId" id="LocationId" placeholder="LocationId" value="<?php echo $LocationId;?>" >
                        <input class="form-control" type="hidden" name="myportfoliocountry" id="myportfoliocountry"  value="<?php echo $CountryCodeNew;?>" >
                        <input class="form-control" type="hidden" name="CountryLng" id="CountryLng"  value="<?php echo $CountryLng;?>" >
                        <input class="form-control" type="hidden" name="CountryLat" id="CountryLat"  value="<?php echo $CountryLat;?>" >
                        <input class="form-control" type="hidden" name="CenterPoint1" id="CenterPoint1"  value="<?php echo $CenterPoint1;?>" >
                        <input class="form-control" type="hidden" name="CenterPoint2" id="CenterPoint2"  value="<?php echo $CenterPoint2;?>" >
                        
                        <div class="icon-container LoaderSuburb" style='display:none;' >
                            <i class="loader"></i>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="time-slots">
                    <div class="d-inline-flex align-items-center">
                        <input class="custom-form-control datepicker" type="text" name="datefilter1" value="<?php echo $datefilter1; ?>" />
                    </div>
                    <div class="d-inline-flex align-items-center">
                        <input class="custom-form-control datepicker" type="text" name="datefilter2" value="<?php echo $datefilter2; ?>" />
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </div>
            </div>
            <!-- Location Header End -->
            
            
            <?php 
            
            if($LocationId != "")
            {
            
            ?>
          

            <div class="residential-data">
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
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#lno">Land & Ownership</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#planning">Planning</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#scout">Scout</a>
                    </li>
                </ul>
                
                <?php
                     ob_flush(); flush();
                     $OverViewDataSrc="SalesOverView";
                     
                     //PriPaid,sqfiSales,Discnt,GrsYld,SalesList,SalesTrans
                     
                     $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValueAjax("forDet",$LocationId,$OverViewDataSrc,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$m);
                    
                     $TotalPriPaid = 0;
                     $TotalsqfiSales = 0;
                     $TotalDiscnt = 0;
                     $TotalGrsYld = 0;
                     $TotalSalesList = 0;
                     $TotalSalesTrans = 0;
                     $m = 0;
                     foreach($productDetailsArr as $RsPD){
                         
                          $DatasourcePoint           = isset($RsPD["datasource"]) ? $RsPD["datasource"] : "0"; 
                          
                          if($DatasourcePoint == "PriPaid" ){
                               $MedianPriPaid         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                               $TotalPriPaid          = floatval($TotalPriPaid) + floatval($MedianPriPaid);
                               $m++;
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
                          }
                          
                          if($DatasourcePoint == "SalesTrans" ){
                               $MedianSalesTrans         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                               $TotalSalesTrans          = floatval($TotalSalesTrans) + floatval($MedianSalesTrans);
                          }
                         
                     }
                     
                     $PricePaid             =  $TotalPriPaid / $m;
                     $scift                 =  $TotalsqfiSales / $m;
                     $PaidDiscount          =  $TotalDiscnt / $m;
                     $GrossYield            =  $TotalGrsYld / $m;
                     $SalesListing          =  $TotalSalesList / $m;
                     $SalesTransactions     =  $TotalSalesTrans / $m;
                     
                     ob_flush(); flush();
                     
                      
                     
                     //PriPaid,sqfiSales,Discnt,GrsYld,SalesList,SalesTrans
                     
                     $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValueAjax("forDet",$LocationId,$OverViewDataSrc,$BuildType,1,$propertyType,$datefilter1,$datefilter2,$m);
                    
                     $TotalPriPaidBd1 = 0;
                     $TotalsqfiSalesBd1 = 0;
                     $TotalDiscntBd1 = 0;
                     $TotalGrsYldBd1 = 0;
                     $TotalSalesListBd1 = 0;
                     $TotalSalesTransBd1 = 0;
                     $n = 0;
                     foreach($productDetailsArr as $RsPD){
                         
                          $DatasourcePoint           = isset($RsPD["datasource"]) ? $RsPD["datasource"] : "0"; 
                          
                          if($DatasourcePoint == "PriPaid" ){
                               $MedianPriPaid         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                               $TotalPriPaidBd1          = floatval($TotalPriPaidBd1) + floatval($MedianPriPaid);
                               $n++;
                          }
                          
                          if($DatasourcePoint == "sqfiSales" ){
                               $MediansqfiSales         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                               $TotalsqfiSalesBd1          = floatval($TotalsqfiSalesBd1) + floatval($MediansqfiSales);
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
                          
                          if($DatasourcePoint == "SalesTrans" ){
                               $MedianSalesTrans         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                               $TotalSalesTransBd1          = floatval($TotalSalesTransBd1) + floatval($MedianSalesTrans);
                          }
                         
                     }
                     
                     $PricePaidBd1             =  $TotalPriPaidBd1 / $n;
                     $sciftBd1                 =  $TotalsqfiSalesBd1 / $n;
                     $PaidDiscountBd1          =  $TotalDiscntBd1 / $n;
                     $GrossYieldBd1            =  $TotalGrsYldBd1 / $n;
                     $SalesListingBd1          =  $TotalSalesListBd1 / $n;
                     $SalesTransactionsBd1     =  $TotalSalesTransBd1 / $n;
                     
                     ob_flush(); flush();
                     
                       //PriPaid,sqfiSales,Discnt,GrsYld,SalesList,SalesTrans
                     
                     $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValueAjax("forDet",$LocationId,$OverViewDataSrc,$BuildType,2,$propertyType,$datefilter1,$datefilter2,$m);
                    
                     $TotalPriPaidBd2 = 0;
                     $TotalsqfiSalesBd2 = 0;
                     $TotalDiscntBd2 = 0;
                     $TotalGrsYldBd2 = 0;
                     $TotalSalesListBd2 = 0;
                     $TotalSalesTransBd2 = 0;
                     $n = 0;
                     foreach($productDetailsArr as $RsPD){
                         
                          $DatasourcePoint           = isset($RsPD["datasource"]) ? $RsPD["datasource"] : "0"; 
                          
                          if($DatasourcePoint == "PriPaid" ){
                               $MedianPriPaid         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                               $TotalPriPaidBd2          = floatval($TotalPriPaidBd2) + floatval($MedianPriPaid);
                               $n++;
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
                         
                     }
                     
                     $PricePaidBd2             =  $TotalPriPaidBd2 / $n;
                     $sciftBd2                 =  $TotalsqfiSalesBd2 / $n;
                     $PaidDiscountBd2          =  $TotalDiscntBd2 / $n;
                     $GrossYieldBd2            =  $TotalGrsYldBd2 / $n;
                     $SalesListingBd2          =  $TotalSalesListBd2 / $n;
                     $SalesTransactionsBd2     =  $TotalSalesTransBd2 / $n;
                     
                     ob_flush(); flush();
                     
                     
                      //PriPaid,sqfiSales,Discnt,GrsYld,SalesList,SalesTrans
                     
                     $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValueAjax("forDet",$LocationId,$OverViewDataSrc,$BuildType,3,$propertyType,$datefilter1,$datefilter2,$m);
                    
                     $TotalPriPaidBd3 = 0;
                     $TotalsqfiSalesBd3 = 0;
                     $TotalDiscntBd3 = 0;
                     $TotalGrsYldBd3 = 0;
                     $TotalSalesListBd3 = 0;
                     $TotalSalesTransBd3 = 0;
                     $n = 0;
                     foreach($productDetailsArr as $RsPD){
                         
                          $DatasourcePoint           = isset($RsPD["datasource"]) ? $RsPD["datasource"] : "0"; 
                          
                          if($DatasourcePoint == "PriPaid" ){
                               $MedianPriPaid         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                               $TotalPriPaidBd3          = floatval($TotalPriPaidBd3) + floatval($MedianPriPaid);
                               $n++;
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
                         
                     }
                     
                     $PricePaidBd3             =  $TotalPriPaidBd3 / $n;
                     $sciftBd3                 =  $TotalsqfiSalesBd3 / $n;
                     $PaidDiscountBd3          =  $TotalDiscntBd3 / $n;
                     $GrossYieldBd3            =  $TotalGrsYldBd3 / $n;
                     $SalesListingBd3          =  $TotalSalesListBd3 / $n;
                     $SalesTransactionsBd3     =  $TotalSalesTransBd3 / $n;
                     
                     ob_flush(); flush();
                     
                     
                     
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
                                        </div>
                                    </div>
                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills sub-pills">
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
                                                <select name="type" id="type" class="form-control">
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
                                                            £/scift 
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
                                                            Listings 
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
                                                                £ <?php echo number_format(round($scift)); ?>
                                                            </td>
                                                            <td>
                                                                £ <?php echo number_format(round($PricePaid)); ?> 
                                                            </td>
                                                            <td>
                                                                <?php echo number_format($PaidDiscount,2); ?>% 
                                                            </td>
                                                            <td>
                                                                <?php echo number_format($GrossYield,2); ?>% 
                                                            </td>
                                                            <td>
                                                                <?php echo round($SalesListing); ?> 
                                                            </td>
                                                            <td>
                                                                 <?php echo number_format(round($SalesTransactions)); ?> 
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </thead>
                                            </table>


                                            <h1 class="hero-title-dark sm-title">Property Availability
                                                <select name="type" id="type" class="form-control">
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
                                                            £/scift 
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
                                                            Listings 
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
                                                                £ <?php echo number_format(round($scift)); ?>
                                                            </td>
                                                            <td>
                                                                £ <?php echo number_format(round($PricePaid)); ?> 
                                                            </td>
                                                            <td>
                                                                <?php echo number_format($PaidDiscount,2); ?>% 
                                                            </td>
                                                            <td>
                                                                <?php echo number_format($GrossYield,2); ?>% 
                                                            </td>
                                                            <td>
                                                                <?php echo round($SalesListing); ?> 
                                                            </td>
                                                            <td>
                                                                 <?php echo number_format(round($SalesTransactions)); ?> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                1 Bed
                                                            </td>
                                                            <td>
                                                                £ <?php echo number_format(round($sciftBd1)); ?>
                                                            </td>
                                                            <td>
                                                                £ <?php echo number_format(round($PricePaidBd1)); ?> 
                                                            </td>
                                                            <td>
                                                                <?php echo number_format($PaidDiscountBd1,2); ?>% 
                                                            </td>
                                                            <td>
                                                                <?php echo number_format($GrossYieldBd1,2); ?>% 
                                                            </td>
                                                            <td>
                                                                <?php echo round($SalesListingBd1); ?> 
                                                            </td>
                                                            <td>
                                                                 <?php echo number_format(round($SalesTransactionsBd1)); ?> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                2 Bed 
                                                            </td>
                                                             <td>
                                                                £ <?php echo number_format(round($sciftBd2)); ?>
                                                            </td>
                                                            <td>
                                                                £ <?php echo number_format(round($PricePaidBd2)); ?> 
                                                            </td>
                                                            <td>
                                                                <?php echo number_format($PaidDiscountBd2,2); ?>% 
                                                            </td>
                                                            <td>
                                                                <?php echo number_format($GrossYieldBd2,2); ?>% 
                                                            </td>
                                                            <td>
                                                                <?php echo round($SalesListingBd2); ?> 
                                                            </td>
                                                            <td>
                                                                 <?php echo number_format(round($SalesTransactionsBd2)); ?> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                3 Bed 
                                                            </td>
                                                             <td>
                                                                £ <?php echo number_format(round($sciftBd3)); ?>
                                                            </td>
                                                            <td>
                                                                £ <?php echo number_format(round($PricePaidBd3)); ?> 
                                                            </td>
                                                            <td>
                                                                <?php echo number_format($PaidDiscountBd3,2); ?>% 
                                                            </td>
                                                            <td>
                                                                <?php echo number_format($GrossYieldBd3,2); ?>% 
                                                            </td>
                                                            <td>
                                                                <?php echo round($SalesListingBd3); ?> 
                                                            </td>
                                                            <td>
                                                                 <?php echo number_format(round($SalesTransactionsBd3)); ?> 
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </thead>
                                            </table>

                                            <h1 class="hero-title-dark sm-title">Property Availability
                                                <select name="type" id="type" class="form-control">
                                                    <option value="flat">12 Month Aug</option>
                                                    <option value="flat">Sep</option>
                                                </select>
                                            </h1>
                                            <img src="<?php echo SITE_BASE_URL;?>assets/images/bar-chart.png" class="w-100" alt="">

                                        </div>
                                        <div class="tab-pane fade" id="rent">
                                            <div class="text-center p-5 bg-light">Content Here</div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="map-holder">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9954.279217250398!2d-0.0258909!3d51.4109588!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xff78487d944ad93!2sBeckenham%20Junction%20station!5e0!3m2!1sen!2s!4v1601024516348!5m2!1sen!2s" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                      
                       
                        $DataSrcVal        = "162,160,500,161,163,436,431,433,456,496,497,498,496,497,498,435,432,159,428";
                        $FeatureCommonApiUkAjaxARR = \api\apiClass::FeatureCommonApiUkValueAjax("forTbl",$LocationId,$DataSrcVal,$datefilter1,$datefilter2);
                        
                        //echo "<pre>"; print_r($FeatureCommonApiUkAjaxARR); echo "</pre>"; 
                        //exit;
                        
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
                            $BroadbandSpeed         = isset($RsUkAjax["BroadbandSpeed"]) ? $RsUkAjax["BroadbandSpeed"] : "0";
                            
                            
                        }
                        
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
                                                <select name="type" id="type" class="form-control">
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
                                                <select name="type" id="type" class="form-control">
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
                                                <select name="type" id="type" class="form-control">
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
                                                <select name="type" id="type" class="form-control">
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
                                                <select name="type" id="type" class="form-control">
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
                                                <select name="type" id="type" class="form-control">
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
                                                            Broadband Speed
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
                                                                <?php echo round($BroadbandSpeed); ?> mbps 
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </thead>
                                            </table>
                                            <h1 class="hero-title-dark sm-title">Braodband Speed - May 15 - Mar 20
                                                <select name="type" id="type" class="form-control">
                                                    <option value="flat">12 Month Aug</option>
                                                    <option value="flat">Sep</option>
                                                </select>
                                            </h1>
                                            <img src="<?php echo SITE_BASE_URL;?>assets/images/random-graph.png" class="w-100 mb-3" alt="">

                                            <h1 class="hero-title-dark sm-title">Braodband Speed - May 15 - Mar 20
                                                <select name="type" id="type" class="form-control">
                                                    <option value="flat">12 Month Aug</option>
                                                    <option value="flat">Sep</option>
                                                </select>
                                            </h1>
                                            <img src="<?php echo SITE_BASE_URL;?>assets/images/random-graph.png" class="w-100 mb-3" alt="">

                                            
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
                                                <select name="type" id="type" class="form-control">
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
                                                <select name="type" id="type" class="form-control">
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
                                                <select name="type" id="type" class="form-control">
                                                    <option value="flat">12 Month Aug</option>
                                                    <option value="flat">Sep</option>
                                                </select>
                                            </h1>
                                            <img src="/assets/images/random-graph.png" class="w-100 mb-3" alt="">
                                            -->

                                        </div>  
                                        <div class="tab-pane" id="economics">
                                            <h1 class="hero-title-dark sm-title">Mortgage
                                                <select name="type" id="type" class="form-control">
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
                                                <select name="type" id="type" class="form-control">
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
                                                <select name="type" id="type" class="form-control">
                                                    <option value="flat">12 Month Aug</option>
                                                    <option value="flat">Sep</option>
                                                </select>
                                            </h1>
                                            <img src="<?php echo SITE_BASE_URL;?>assets/images/huge-graph.png" class="w-100 mb-3" alt="">

                                        </div>  
                                        <div class="tab-pane active" id="deprivation">
                                            
                                            <h1 class="hero-title-dark sm-title">Deprivation
                                                <select name="type" id="type" class="form-control">
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
                                                <select name="type" id="type" class="form-control">
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
                                                <select name="type" id="type" class="form-control">
                                                    <option value="flat">12 Month Aug</option>
                                                    <option value="flat">Sep</option>
                                                </select>
                                            </h1>
                                            <img src="<?php echo SITE_BASE_URL;?>assets/images/huge-graph.png" class="w-100 mb-3" alt="">
                                            
                                           
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="map-holder">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9954.279217250398!2d-0.0258909!3d51.4109588!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xff78487d944ad93!2sBeckenham%20Junction%20station!5e0!3m2!1sen!2s!4v1601024516348!5m2!1sen!2s" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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
                                                <select name="type" id="type" class="form-control">
                                                    <option value="flat">12 Month Aug</option>
                                                    <option value="flat">Sep</option>
                                                </select>
                                            </h1>
                                            <img src="<?php echo SITE_BASE_URL;?>assets/images/huge-graph.png" class="w-100 mb-3" alt="">
                                            <h1 class="hero-title-dark sm-title">Flat Sales Listings Distribution May 15 - Mar 20
                                                <select name="type" id="type" class="form-control">
                                                    <option value="flat">12 Month Aug</option>
                                                    <option value="flat">Sep</option>
                                                </select>
                                            </h1>
                                            <img src="<?php echo SITE_BASE_URL;?>assets/images/huge-graph.png" class="w-100 mb-3" alt="">
                                        </div>
                                        <div class="tab-pane fade" id="quartiles">
                                            <div class="text-center p-5 bg-light">
                                                content here
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="fsl">
                                            <div class="text-center p-5 bg-light">
                                                content here
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>         
                            <div class="col-xl-6">
                                <div class="map-holder">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9954.279217250398!2d-0.0258909!3d51.4109588!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xff78487d944ad93!2sBeckenham%20Junction%20station!5e0!3m2!1sen!2s!4v1601024516348!5m2!1sen!2s" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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
                                                
                                           // echo 'SoldPriceSqft=='. $soldPriceSqft .'<>br'
                
                                    ?>
                                  
                                            <div class="single-property">
                                                <h1 class="hero-title-dark sm-title"><?php echo $address; ?>
                                                    <select name="type" id="type" class="form-control">
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
                                                                <p><i class="fas fa-bed"></i> <?php echo $bedRooms;?> Bed <i class="fal fa-car"></i> 1 Car Park <i class="fal fa-bath"></i> <?php echo $bathRooms;?> Bath</p>
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
                                <div class="map-holder">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9954.279217250398!2d-0.0258909!3d51.4109588!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xff78487d944ad93!2sBeckenham%20Junction%20station!5e0!3m2!1sen!2s!4v1601024516348!5m2!1sen!2s" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="lno">
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
                                        <div class="land-owner-map">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9954.279217250398!2d-0.0258909!3d51.4109588!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xff78487d944ad93!2sBeckenham%20Junction%20station!5e0!3m2!1sen!2s!4v1601024516348!5m2!1sen!2s" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <!-- Detail View MAP -->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h1 class="hero-title-dark sm-title">Property Details
                                            <select name="type" id="type" class="form-control">
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
                                        <div class="map-holder">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9954.279217250398!2d-0.0258909!3d51.4109588!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xff78487d944ad93!2sBeckenham%20Junction%20station!5e0!3m2!1sen!2s!4v1601024516348!5m2!1sen!2s" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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
    
        function validateForm() {
        
            if(document.getElementById("LocationId").value=="")
            {
                alert("Select Subrub from the list");
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
    </script>


<?php include "footer.php"; ?>