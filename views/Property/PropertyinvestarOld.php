<?php 
//ini_set("output_buffering","ON");
//ob_start();
//echo "in";
////ob_flush();
//echo ini_get("output_buffering");

//exit;

//ob_implicit_flush(true);
//ob_end_flush();

@ini_set('output_buffering','Off');
@ini_set('zlib.output_compression',0);
@ini_set('implicit_flush',1);
@ob_end_clean();
set_time_limit(0);
ob_start();


//echo "Header Starts";
ob_flush(); flush();

include "header.php";

if (1 == 2){
?>
    <!-- include.php contents (starts) -->
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DU VAL PRIVATE OFFICE</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/ico" sizes="16x16" href="<?php echo SITE_BASE_URL;?>dashboard/assets/img/favicon.ico">
        <!-- main stylesheets -->
        <link href="<?php echo SITE_BASE_URL;?>dashboard/assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>dashboard/assets/css/main.css">
        
        
        <!-- wysihtml5 -->
        <link rel="stylesheet" href="<?php echo SITE_BASE_URL;?>assets/plugins/wysihtml5/css/bootstrap-wysihtml5.css" />
        <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/js/modernizr-3.6.0.min.js"></script>
        <!-- icheck -->
        <link href="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/icheck/skins/all.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>dashboard/assets/icons/icofont/icofont.min.css">
        <?php
        /*
        
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>dashboard/assets/icons/font-awessome/font-awesome.min.css">
        */
        ?>
    
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css">
          <!-- Common JS -->
        <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/common/common.min.js"></script>
        
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="666360874265-78llhedddolcdjv5g9h3m3artaqklaao.apps.googleusercontent.com">
        
        
    </head>
    
    <body>
    
        <div id="main-wrapper-1234">
            
            
            <?php include'HeaderBar.php'; ?>
            <?php include'SideBar.php'; ?>
           
    
            <!-- content body -->
            <div class="content-body">
                <div class="container-fluid">
    <!-- include.php contents (end) -->

<?php
} 

//ob_end_clean();



//echo "Header Ends";
ob_flush(); flush();

\login\loginClass::Init();
$checkSession = \login\loginClass::CheckUserSessionIp();

\Property\PropertyClass::Init();
$countryId = isset($_REQUEST["country"]) ? $_REQUEST["country"] : "";

$CountryLng = isset($_REQUEST["CountryLng"]) ? $_REQUEST["CountryLng"] : "0"; // Arzath - 2020-09-01
$CountryLat = isset($_REQUEST["CountryLat"]) ? $_REQUEST["CountryLat"] : "0"; // Arzath - 2020-09-01

$MultiPropertyVal   = $_REQUEST["MultiPropertyVal"] ? $_REQUEST["MultiPropertyVal"] : "";
$MultiPropertyValNew   = $_REQUEST["MultiPropertyValNew"] ? $_REQUEST["MultiPropertyValNew"] : "";
$MultiPropertyValOther   = $_REQUEST["MultiPropertyValOther"] ? $_REQUEST["MultiPropertyValOther"] : "";


$ChkCodeArr                         = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_CODE_NEW FROM country_master WHERE COUNTRY_CODE ='{$countryId}')");
$CountryCodeNew                      = $ChkCodeArr["0"];
   
 
$countryNameArr              			= \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_NAME FROM country_master WHERE `COUNTRY_CODE` ='" .$countryId."')");
$countryName            				= $countryNameArr["0"];
//echo $countryName ;

//country_map_url


$rows = \Property\PropertyClass::getCountryDatas($countryId,'');
foreach ($rows as $row) 
{
    
    $countryName = $row["COUNTRY_NAME"];
    $CountryUrl  = $row["country_map_url"];
    $CountryLatDB  = $row["Country_Lat"];
    $CountryLngDB  = $row["Country_Lng"];

}

if($CountryLng == 0){
    
    $CountryLng = $CountryLngDB;
}

if($CountryLat == 0)
{
    $CountryLat = $CountryLatDB;
}

//echo 'CountryLat='. $CountryLat .'<br>';
//echo '$CountryLng='. $CountryLng .'<br>';



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
    
    $ChkCodeArr                         = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_CODE_NEW FROM country_master WHERE COUNTRY_CODE ='{$Propcountrycode}')");
    $CountryCodeNew                      = $ChkCodeArr["0"];
       
    
}


 $ChkCntArr  = \DBConn\DBConnection::getQueryFetchColumn("(SELECT CURRENCY FROM country_master WHERE COUNTRY_CODE ='{$countryId}')");
$Currency   = $ChkCntArr["0"];


$ChkSymbolArr   = \DBConn\DBConnection::getQueryFetchColumn("(SELECT Currency_Symbol FROM country_master WHERE COUNTRY_CODE ='{$countryId}')");
$CurrencySym    = $ChkSymbolArr["0"] ;

if($countryId == "3")
    $CurrencySym = "£";

$MapCurrecncy = $CurrencySym ." ".$Currency;




$TodayDate = date("d-m-Y");


$datasource     = isset($_REQUEST["datasource"]) ? $_REQUEST["datasource"] : "PriPaid";
$BuildType      = isset($_REQUEST["BuildType"]) ? $_REQUEST["BuildType"] : "STANDARD";
$propertyType   = isset($_REQUEST["propertyType"]) ? $_REQUEST["propertyType"] : "A";
$bedrooms       = isset($_REQUEST["bedrooms"]) ? $_REQUEST["bedrooms"] : "-1";

$datefilter       = isset($_REQUEST["datefilter"]) ? $_REQUEST["datefilter"] : "01-01-2020 - 01-15-2020";

$datefilter1       = isset($_REQUEST["datefilter1"]) ? $_REQUEST["datefilter1"] : $TodayDate;
$datefilter2       = isset($_REQUEST["datefilter2"]) ? $_REQUEST["datefilter2"] : $TodayDate;

/*

echo "datasource=" .$datasource;
echo "BuildType=" .$BuildType;
echo "propertyType=" .$propertyType;
echo "datefilter=" .$datefilter;
*/

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
<!-- main content -->
<div class="content">
    <!-- Added by Yasir for suggestions (Start) -->
    <form name="frmSearch" id="frmSearch" method="post" action="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=<?php echo $countryId; ?>"  onsubmit="return validateForm()"  >
        
        <div class="row">
            <div class="col-lg-12">
                <div id="loading" style=" border:1px solid grey; background:yellow; position:fixed; top:300px; left:500px; width:500px; height:100px; margin:0 auto; text-align:center; vertical-align:center; z-index:10001; ">
                	<div style=" padding-top:40px;">
                		<strong>Please wait while we are loading... </strong>
                	</div>
                </div>
            </div>
        </div>
              
        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    
                    <?php
                    
                       if($countryId == "3"){
                           
                           $ImagSrc = "uk.png";
                       }elseif($countryId == "2"){
                           $ImagSrc = "australia.png";
                           
                       }elseif($countryId == "1"){
                           
                           $ImagSrc = "newzealand.png";
                       }else{
                           
                           $ImagSrc = "newzealand.png";
                       }
                    
                    ?>
                    
                    
                    
                    
                    <h4>Search global data <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/img/<?php echo $ImagSrc; ?>" class="img-fluid" alt="" width="50px"></h4>
                  </div>
              <div class="card-body">
                  
                <div class="row">
                    
                    <!--<div class="col-6">
                      <div class="form-group">
                        <input class="form-control" type="text" name="" placeholder="Country">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <input class="form-control" type="text" name="" placeholder="City">
                      </div>
                    </div>-->

              </div>
              
              <div class="row">
                  <div class="col">
                    <div class="form-group">
                          <input class="form-control" type="text" name="Subrub" id="Suburb" placeholder="Search" value="<?php echo $Subrub;?>" />
                     </div>
                   </div>
             </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                    <?php
                    /*
                    echo \Html\Elements\InputsClass::plotCombo( "SubrubDp", array(), "SELECT location_id as id, suburb as description FROM tbl_suburb where ifnull(is_activated, 'Y')='Y'", 
                                                                $SubrubDp, "Select Suburb", "class='form-control input-default'"); 
                    */
                    ?>
                    <div class="loader-text-box">
                        <input class="form-control class_sub" type="text" name="Subrub" id="Suburb" placeholder="Suburb" value="<?php echo $Subrub;?>" autocomplete="off" />
                        <input class="form-control" type="hidden" name="LocationId" id="LocationId" placeholder="LocationId" value="<?php echo $LocationId;?>" >
                        <input class="form-control" type="hidden" name="myportfoliocountry" id="myportfoliocountry"  value="<?php echo $CountryCodeNew;?>" >
                        <input class="form-control" type="hidden" name="CountryLng" id="CountryLng"  value="<?php echo $CountryLng;?>" >
                        <input class="form-control" type="hidden" name="CountryLat" id="CountryLat"  value="<?php echo $CountryLat;?>" >
                
                        <div class="icon-container LoaderSuburb" style='display:none;' >
                            <i class="loader"></i>
                        </div>
                    </div>
                    
              </div>
            </div>
            

            <div class="col">
              <div class="form-group">
                    <div class="loader-text-box">
                        <input class="form-control" type="text" name="Street" id="Street" placeholder="Street"  value="<?php echo $Street;?>" autocomplete="off" />
                      <input class="form-control" type="hidden" name="StreetId" id="StreetId" placeholder="StreetId"  value="<?php echo $StreetId;?>" >
                      <input class="form-control" type="hidden" name="stateId" id="stateId" placeholder="stateId"  value="<?php echo $stateId;?>" >
                    <div class="icon-container LoaderStreet" style='display:none;' >
                        <i class="loader"></i>
                      </div>
                    </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <input class="form-control" type="text" name="Zipcode" id="Zipcode" placeholder="Post Code" value="<?php echo $Zipcode;?>" >
                      <input class="form-control" type="hidden" name="ZipcodeId" id="ZipcodeId" placeholder="ZipcodeId" value="<?php echo $ZipcodeId;?>" >
              </div>
            </div>
          </div>
          
          <!---------------------------------- Arzath 2020-05-30 ------------------------------------------>
          <?php
          ob_flush(); flush(); //Yasir / 30-Aug-2020
          //exit; 
          
          if( $countryId == "3"){
          ?>
          
          
          
            <div class="row">
               <div class="col-lg-12">
                  <div class="card filter-card">
                      <div class="card-header">
                         <b> Date Range  </b> 
                      </div>
                      <div class="card-body">
                        <input class="custom-form-control datepicker" type="text" name="datefilter1" value="<?php echo $datefilter1; ?>" />
                        <input class="custom-form-control datepicker" type="text" name="datefilter2" value="<?php echo $datefilter2; ?>" />
                     </div>
                  </div>
               </div>
            </div>
          
            <div class="row">
                
                
                 <div class="col-md-12">
                  <div class="form-group row">
                     <label for="" class="col-md-12 col-form-label">Transactional</label>
                    <div class="col-md-12 d-flex justify-content-between">
                        
                        
                      <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasource" value='PriPaid' <?php if ($datasource == "PriPaid" ) { ?> checked <?php }?>   type="checkbox" id="PricePaid" >
                        <label class="form-check-label" for="PricePaid">Price Paid</label>
                      </div>
                      
                     <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasource" value='Discnt' <?php if ($datasource == "Discnt" ) { ?> checked <?php }?>   type="checkbox" id="Discount" >
                        <label class="form-check-label" for="Discount">Discount</label>
                      </div>
                      
                       <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasource" value='GrsYld' <?php if ($datasource == "GrsYld" ) { ?> checked <?php }?>   type="checkbox" id="GrossYield" >
                        <label class="form-check-label" for="GrsYld">Gross Yield</label>
                      </div>
                       <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasource" value='PriAsk' <?php if ($datasource == "PriAsk" ) { ?> checked <?php }?>   type="checkbox" id="PriceAsked" >
                        <label class="form-check-label" for="PriceAsked">Price Asked</label>
                      </div>
                       <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasource" value='RentAsk' <?php if ($datasource == "RentAsk" ) { ?> checked <?php }?>   type="checkbox" id="RentAsking" >
                        <label class="form-check-label" for="RentAsking">Rent Asking</label>
                      </div>
                       <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasource" value='sqfiRent' <?php if ($datasource == "sqfiRent" ) { ?> checked <?php }?>   type="checkbox" id="sqfiRent" >
                        <label class="form-check-label" for="sqfiRent">£ Per Ft<sup>2</sup> - Rent</label>
                      </div>
                      
                       <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasource" value='sqfiSales' <?php if ($datasource == "sqfiSales" ) { ?> checked <?php }?>   type="checkbox" id="sqfiSales" >
                        <label class="form-check-label" for="sqfiSales">£ Per Ft<sup>2</sup> - Sales</label>
                      </div>
                      
                    </div>
                  </div>
                </div>
                
                
                <div class="col-md-12">
                  <div class="form-group row">
                     <label for="" class="col-md-12 col-form-label">Property Specific</label>
                    <div class="col-md-12 d-flex justify-content-between">
                        
                        
                      <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasourceNew" value='DaysMarRent' <?php if ($datasource == "DaysMarRent" ) { ?> checked <?php }?>  checked type="checkbox" id="DaysMarRent" >
                        <label class="form-check-label" for="DaysMarRent">Days on Market - Rent</label>
                      </div>
                      
                     <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasourceNew" value='PropSize' <?php if ($datasource == "PropSize" ) { ?> checked <?php }?>   type="checkbox" id="PropSize" >
                        <label class="form-check-label" for="PropSize">Property Size</label>
                      </div>
                      
                       <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasourceNew" value='DaysMarSales' <?php if ($datasource == "DaysMarSales" ) { ?> checked <?php }?>   type="checkbox" id="DaysMarSales" >
                        <label class="form-check-label" for="DaysMarSales">Days on Market - Sales</label>
                      </div>
                       <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasourceNew" value='RentList' <?php if ($datasource == "RentList" ) { ?> checked <?php }?>   type="checkbox" id="RentList" >
                        <label class="form-check-label" for="RentList">Rent Listing</label>
                      </div>
                       <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasourceNew" value='NewRentList' <?php if ($datasource == "NewRentList" ) { ?> checked <?php }?>   type="checkbox" id="NewRentList" >
                        <label class="form-check-label" for="NewRentList">New Rent Listing</label>
                      </div>
                       <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasourceNew" value='SalesList' <?php if ($datasource == "SalesList" ) { ?> checked <?php }?>   type="checkbox" id="SalesList" >
                        <label class="form-check-label" for="SalesList">Sales Listing</label>
                      </div>
                      
                       <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasourceNew" value='NewSalesList' <?php if ($datasource == "NewSalesList" ) { ?> checked <?php }?>   type="checkbox" id="NewSalesList" >
                        <label class="form-check-label" for="NewSalesList">New Sales Listing</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one">
                        <input class="form-check-input" name="datasourceNew" value='SalesTrans' <?php if ($datasource == "SalesTrans" ) { ?> checked <?php }?>   type="checkbox" id="SalesTrans" >
                        <label class="form-check-label" for="SalesTrans">Sales Transactions</label>
                      </div>
                      
                    </div>
                  </div>
                </div>
 
                
                
                
                
                
                
                <div class="col-md-12">
                  <div class="form-group row">
                      
                      <label for="" class="col-md-12 col-form-label">Other's</label>
                    
                    <div class="col-md-12 d-flex justify-content-between">
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='162' <?php if ($datasource == "162" ) { ?> checked <?php }?>   type="checkbox" id="AreaLeverage" >
                        <label class="form-check-label" for="AreaLeverage">Area Leverage</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='161' <?php if ($datasource == "161" ) { ?> checked <?php }?>   type="checkbox" id="MortgageDebtPerCapita" >
                        <label class="form-check-label" for="MortgageDebtPerCapita">Mortgage Debt Per Capita</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='431' <?php if ($datasource == "431" ) { ?> checked <?php }?>   type="checkbox" id="HomelessnessCount" >
                        <label class="form-check-label" for="HomelessnessCount">Homelessness Count</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='473' <?php if ($datasource == "473" ) { ?> checked <?php }?>   type="checkbox" id="TotalPopulation" >
                        <label class="form-check-label" for="TotalPopulation">Total Population</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='163' <?php if ($datasource == "163" ) { ?> checked <?php }?>   type="checkbox" id="CreditScore" >
                        <label class="form-check-label" for="CreditScore">Credit Score</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='470' <?php if ($datasource == "470" ) { ?> checked <?php }?>   type="checkbox" id="AntiSocialBehaviour" >
                        <label class="form-check-label" for="AntiSocialBehaviour">Anti-Social Behaviour</label>
                      </div>
                      
                    </div>
                    
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-group row">
                  
                    <div class="col-md-12 d-flex justify-content-between">
                        
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='469' <?php if ($datasource == "469" ) { ?> checked <?php }?>   type="checkbox" id="BicycleTheft" >
                        <label class="form-check-label" for="BicycleTheft">Bicycle Theft</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='466' <?php if ($datasource == "466" ) { ?> checked <?php }?>   type="checkbox" id="Burglary" >
                        <label class="form-check-label" for="Burglary">Burglary</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='497' <?php if ($datasource == "497" ) { ?> checked <?php }?>   type="checkbox" id="CrimesofDishonesty" >
                        <label class="form-check-label" for="CrimesofDishonesty">Crimes of Dishonesty</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='462' <?php if ($datasource == "462" ) { ?> checked <?php }?>   type="checkbox" id="CriminalDamageandArson" >
                        <label class="form-check-label" for="CriminalDamageandArson">Criminal Damage and Arson</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='465' <?php if ($datasource == "465" ) { ?> checked <?php }?>   type="checkbox" id="DrugRelated" >
                        <label class="form-check-label" for="DrugRelated">Drug Related</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='460' <?php if ($datasource == "460" ) { ?> checked <?php }?>   type="checkbox" id="OtherCrime" >
                        <label class="form-check-label" for="OtherCrime">Other Crime</label>
                      </div>
                      
                     
                    </div>
                  </div>
                </div>
                
                
                <div class="col-md-12">
                  <div class="form-group row">
                  
                    <div class="col-md-12 d-flex justify-content-between">
                        
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='498' <?php if ($datasource == "498" ) { ?> checked <?php }?>   type="checkbox" id="OtherCrimes" >
                        <label class="form-check-label" for="OtherCrimes">Other Crimes</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='472' <?php if ($datasource == "472" ) { ?> checked <?php }?>   type="checkbox" id="OtherTheft" >
                        <label class="form-check-label" for="OtherTheft">Other Theft</label>
                      </div>
                      
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='463' <?php if ($datasource == "463" ) { ?> checked <?php }?>   type="checkbox" id="PossessionofWeapons" >
                        <label class="form-check-label" for="PossessionofWeapons">Possession of Weapons</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2 ">
                        <input class="form-check-input" name="datasourceOther" value='457' <?php if ($datasource == "457" ) { ?> checked <?php }?>   type="checkbox" id="PublicDisorderWeaponsCrime" >
                        <label class="form-check-label" for="PublicDisorderWeaponsCrime">Public Disorder and Weapons Crime</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='467' <?php if ($datasource == "467" ) { ?> checked <?php }?>   type="checkbox" id="PublicOrder" >
                        <label class="form-check-label" for="PublicOrder">Public Order</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='471' <?php if ($datasource == "471" ) { ?> checked <?php }?>   type="checkbox" id="Shoplifting" >
                        <label class="form-check-label" for="Shoplifting">Shoplifting</label>
                      </div>
                      
                     
                    </div>
                  </div>
                </div>
                
                
                <div class="col-md-12">
                  <div class="form-group row">
                  
                    <div class="col-md-12 d-flex justify-content-between">
                        
                        
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='468' <?php if ($datasource == "468" ) { ?> checked <?php }?>   type="checkbox" id="TheftfromthePerson" >
                        <label class="form-check-label" for="TheftfromthePerson">Theft from the Person</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='458' <?php if ($datasource == "458" ) { ?> checked <?php }?>   type="checkbox" id="VehicleCrime" >
                        <label class="form-check-label" for="VehicleCrime">Vehicle Crime</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='496' <?php if ($datasource == "496" ) { ?> checked <?php }?>   type="checkbox" id="ViolentandSexualCrimes" >
                        <label class="form-check-label" for="ViolentandSexualCrimes">Violent and Sexual Crimes</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='461' <?php if ($datasource == "461" ) { ?> checked <?php }?>   type="checkbox" id="ViolentCrime" >
                        <label class="form-check-label" for="ViolentCrime">Violent Crime</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='489' <?php if ($datasource == "489" ) { ?> checked <?php }?>   type="checkbox" id="Apprenticeship" >
                        <label class="form-check-label" for="Apprenticeship">Apprenticeship</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='452' <?php if ($datasource == "452" ) { ?> checked <?php }?>   type="checkbox" id="GoodFacilities" >
                        <label class="form-check-label" for="GoodFacilities">Good Facilities</label>
                      </div>
                   
                      
                    </div>
                  </div>
                </div>
                
                
                <div class="col-md-12">
                  <div class="form-group row">
                  
                    <div class="col-md-12 d-flex justify-content-between">
                        
                        
                         <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='454' <?php if ($datasource == "454" ) { ?> checked <?php }?>   type="checkbox" id="InadequateFacilities" >
                        <label class="form-check-label" for="InadequateFacilities">Inadequate Facilities</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='455' <?php if ($datasource == "455" ) { ?> checked <?php }?>   type="checkbox" id="NotYetInspected" >
                        <label class="form-check-label" for="NotYetInspected">Not Yet Inspected</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='451' <?php if ($datasource == "451" ) { ?> checked <?php }?>   type="checkbox" id="OutstandingFacilities" >
                        <label class="form-check-label" for="OutstandingFacilities">Outstanding Facilities</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='434' <?php if ($datasource == "434" ) { ?> checked <?php }?>   type="checkbox" id="ReportedCrimes" >
                        <label class="form-check-label" for="ReportedCrimes">Reported Crimes</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='464' <?php if ($datasource == "464" ) { ?> checked <?php }?>   type="checkbox" id="Robbery" >
                        <label class="form-check-label" for="Robbery">Robbery</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='453' <?php if ($datasource == "453" ) { ?> checked <?php }?>   type="checkbox" id="SatisfactoryFacilities" >
                        <label class="form-check-label" for="SatisfactoryFacilities">Satisfactory Facilities</label>
                      </div>
                      
                    </div>
                  </div>
                </div>
                
                
                
                <div class="col-md-12">
                  <div class="form-group row">
                  
                    <div class="col-md-12 d-flex justify-content-between">
                        
                        <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='456' <?php if ($datasource == "456" ) { ?> checked <?php }?>   type="checkbox" id="UnemploymentLevel" >
                        <label class="form-check-label" for="UnemploymentLevel">Unemployment Level</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='550' <?php if ($datasource == "550" ) { ?> checked <?php }?>   type="checkbox" id="Shared" >
                        <label class="form-check-label" for="Shared">Shared</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='428' <?php if ($datasource == "428" ) { ?> checked <?php }?>   type="checkbox" id="BroadbandSpeed" >
                        <label class="form-check-label" for="BroadbandSpeed">Broadband Speed</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='430' <?php if ($datasource == "430" ) { ?> checked <?php }?>   type="checkbox" id="NoBusinessClosures" >
                        <label class="form-check-label" for="NoBusinessClosures">No. of Business Closures</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='429' <?php if ($datasource == "429" ) { ?> checked <?php }?>   type="checkbox" id="NoNewBusinesses" >
                        <label class="form-check-label" for="NoNewBusinesses">No. of New Businesses</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='555' <?php if ($datasource == "555" ) { ?> checked <?php }?>   type="checkbox" id="NetMigration" >
                        <label class="form-check-label" for="NetMigration">Net Migration</label>
                      </div>
                      
                     
                    </div>
                  </div>
                </div>
                
                
                 <div class="col-md-12">
                  <div class="form-group row">
                  
                    <div class="col-md-12 d-flex justify-content-between">
                        
                        
                       <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='556' <?php if ($datasource == "556" ) { ?> checked <?php }?>   type="checkbox" id="NetMigrationPercentagePopulation" >
                        <label class="form-check-label" for="NetMigrationPercentagePopulation">Net Migration as Percentage of Population</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='436' <?php if ($datasource == "436" ) { ?> checked <?php }?>   type="checkbox" id="MeanIncome" >
                        <label class="form-check-label" for="MeanIncome">Mean Income</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='160' <?php if ($datasource == "160" ) { ?> checked <?php }?>   type="checkbox" id="DebtPerBuilding" >
                        <label class="form-check-label" for="DebtPerBuilding">Debt Per Building</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='500' <?php if ($datasource == "500" ) { ?> checked <?php }?>   type="checkbox" id="MortgageLending" >
                        <label class="form-check-label" for="MortgageLending">Mortgage Lending</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='433' <?php if ($datasource == "433" ) { ?> checked <?php }?>   type="checkbox" id="RepossessionsCount" >
                        <label class="form-check-label" for="RepossessionsCount">Repossessions Count</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='435' <?php if ($datasource == "435" ) { ?> checked <?php }?>   type="checkbox" id="BusStationsStops" >
                        <label class="form-check-label" for="BusStationsStops">Bus Stations and Stops</label>
                      </div>
                    
                    </div>
                  </div>
                </div>
                
                
                <div class="col-md-12">
                  <div class="form-group row">
                  
                    <div class="col-md-12 d-flex justify-content-between">
                        
                
                        <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='432' <?php if ($datasource == "432" ) { ?> checked <?php }?>   type="checkbox" id="NationalRailStations" >
                        <label class="form-check-label" for="NationalRailStations">National Rail Stations</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='159' <?php if ($datasource == "159" ) { ?> checked <?php }?>   type="checkbox" id="Dwellings" >
                        <label class="form-check-label" for="Dwellings">Dwellings</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='166' <?php if ($datasource == "166" ) { ?> checked <?php }?>   type="checkbox" id="ProportionRenting" >
                        <label class="form-check-label" for="ProportionRenting">Proportion Renting</label>
                      </div>
                      
                      <div class="form-check form-check-inline checkbox-one col-md-2">
                        <input class="form-check-input" name="datasourceOther" value='167' <?php if ($datasource == "167" ) { ?> checked <?php }?>   type="checkbox" id="ProportionSelling" >
                        <label class="form-check-label" for="ProportionSelling">Proportion Selling</label>
                      </div>
                       
                      <div class="form-check form-check-inline checkbox-one col-md-2">&nbsp;</div>
                       <div class="form-check form-check-inline checkbox-one col-md-2">&nbsp;</div>
                      
                     </div>
                  </div>
                </div>
                
                
                
                
             </div>
            <?php
                
                
            }
            
            ?>
            
            <!---------------------------------- Arzath 2020-05-30 ------------------------------------------>
          <!--<div class="row">
            <div class="col">
              <div class="form-group">
                <input type="text" class="form-control" name="" placeholder="Estimated yield">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <input type="text" class="form-control" name="" placeholder="Min Price range">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <input type="text" class="form-control" name="" placeholder="Max Price range">
              </div>
            </div>
          </div>-->
         <!-- <div class="row">
            <div class="col">
              <div class="form-group">
                <input type="text" class="form-control" name="" placeholder="Discount from market value">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <input type="text" class="form-control" name="" placeholder="Completion date">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <input type="text" class="form-control" name="" placeholder="Number of beds">
              </div>
            </div>
          </div>-->
                  <div class="text-center mr-auto">
                    <input class="btn btn-primary  SearchBtn" type="submit" name="SearchBtn" id="SearchBtn" value="Search">
                    <input type="hidden" name="countryId" id="countryId" value="<?php echo $countryId; ?>">
                    <input type='hidden' name='MultiPropertyVal' id='MultiPropertyVal' value="<?php echo $MultiPropertyVal; ?>" >
                    <input type='hidden' name='MultiPropertyValNew' id='MultiPropertyValNew' value="<?php echo $MultiPropertyValNew; ?>" >
                    <input type='hidden' name='MultiPropertyValOther' id='MultiPropertyValOther' value="<?php echo $MultiPropertyValOther; ?>" >
                                       
                    
                    
                    <?php if ($LocationId != ""){ ?>
                        <input class="btn btn-primary  SearchBtn" type="button" name="PdfBtn" id="PdfBtn" value="Make PDF" onclick="PDFBtnFn()">
                    <?php } ?>
                    
                  </div>
                  
              </div>
               
              
              
            </div>
        </div>
      </div>
    </form>
    <!-- Added by Yasir for suggestions ( End ) -->
    
    <?php ob_flush(); flush(); //exit;?>
    
     <div class="row mb-3">
          <!-- property location  -->
          <div class="col-12 col-lg-12">
             <div  class="card">
               <div class="card-header">
                 <div class="row">
                    <div class="col align-self-center">
                       <h4 class="t3 fw-500"><?php echo $countryName; ?></h4>
                    </div>
                       <div class="col text-right">
                        <a  class="btn btn-success" href="<?php echo SITE_BASE_URL;?>Property/Projects.html?country=<?php echo $countryId; ?>">View Projects</a>
                      </div>
                 </div> 
               </div>
               <div class="card-body">
                   
                   
                 <?php
                 
                 if($countryId == "3"){
                     
                  ?> 
                  
                
                    
                    <!--<iframe src="https://www.google.com/maps/embed?pb=<?php // echo $CountryUrl; ?>" width="100%" height="500" frameborder="0" style="border:0;" allowfullscreen=""></iframe>-->
                    
                    <div id='mapContainer1'>
                        <?php //\api\apiClass::getMapBoxScriptRender($countryId,"MAPFIRST");  ?>
                        <div id="map"></div>
                        
                         <script>
                         function initAutocomplete() {
        
                            //alert();
                            
                            var map;
                            var CountryLat  = eval("<?php echo $CountryLat; ?>");
                            var CountryLng  = eval("<?php echo $CountryLng; ?>");
                            var LocationId  = $("#LocationId").val();
                              
                            if(LocationId != ""){
                                ZoonVal = 13
                            }else{
                                ZoonVal = 5
                            }
                    
                           
                            var map = new google.maps.Map(document.getElementById('map'), {
                              center: {lat: CountryLat, lng: CountryLng},
                              zoom: ZoonVal,
                              mapTypeId: 'roadmap'
                            });
                    
                            // Create the search box and link it to the UI element.
                            //var input = document.getElementById('Subrub');
                            var input = document.getElementById('pac-input');
                            var searchBox = new google.maps.places.SearchBox(input);
                            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                    
                            // Bias the SearchBox results towards current map's viewport.
                            map.addListener('bounds_changed', function() {
                              searchBox.setBounds(map.getBounds());
                            });
                    
                            var markers = [];
                            // Listen for the event fired when the user selects a prediction and retrieve
                            // more details for that place.
                            searchBox.addListener('places_changed', function() {
                              var places = searchBox.getPlaces();
                    
                              if (places.length == 0) {
                                return;
                              }
                    
                              // Clear out the old markers.
                              markers.forEach(function(marker) {
                                marker.setMap(null);
                              });
                              markers = [];
                    
                              // For each place, get the icon, name and location.
                              var bounds = new google.maps.LatLngBounds();
                              places.forEach(function(place) {
                                if (!place.geometry) {
                                  console.log("Returned place contains no geometry");
                                  return;
                                }
                                var icon = {
                                  url: place.icon,
                                  size: new google.maps.Size(71, 71),
                                  origin: new google.maps.Point(0, 0),
                                  anchor: new google.maps.Point(17, 34),
                                  scaledSize: new google.maps.Size(25, 25)
                                };
                    
                                // Create a marker for each place.
                                markers.push(new google.maps.Marker({
                                  map: map,
                                  icon: icon,
                                  title: place.name,
                                  position: place.geometry.location
                                }));
                    
                                if (place.geometry.viewport) {
                                  // Only geocodes have viewport.
                                  bounds.union(place.geometry.viewport);
                                } else {
                                  bounds.extend(place.geometry.location);
                                }
                              });
                              map.fitBounds(bounds);
                            });
                      }
                      
                      </script>
                       <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmPfnhPm0JDemtnhAaJGdOldwe8NiKS8w&libraries=places&callback=initAutocomplete" async defer></script>
                       
                       
                <?php
                     
                 }
                 else
                 {
                     
                ?>
        
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
                top: 10px;
                }
                .mapboxgl-ctrl-geocoder {
                min-width: 100%;
                }
                </style>
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
                zoom: 7,
                placeholder: 'Enter search e.g.',
                });
                console.log(feature);
                new mapboxgl.Marker().setLngLat(feature.center).addTo(map);
                }
                });
                
                </script>  

            <?php
                     
                 }
                ?>


                        
                    <div>
                    
                    
                </div>
             </div>
          </div>
          <!-- end property location-->
          
       </div>
    
    
<?php if ($LocationId != "" && $countryId != "3" ){ 
    
            if ( $countryId == "2"){
                
                $propertyTypeId ="1";
                
            }else{
                $propertyTypeId ="6";
            }
            
            
    
    
    ?>

        
        <!-- Graph / Yasir (Start) -->
        <div class="row no-gutters">
          <div class="col-lg-6 col-md-12 col-12 pr-md-3 pr-0">
            <div class="card h-100 mb-0">
              <div class="card-header">
                <h4 class="card-title">Recent Median Sale Prices</h4>
              </div>
              <div class="card-body">
                
                            <!-- <nav class="navbar navbar-expand-sm bg-white navbar-light">
                              <ul class="navbar-nav">
                                <li class="nav-item">
                                  <a class="nav-link widget-title" href="#">Recent Median Sale Prices</a>
                                </li>
                              </ul>
                              <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                  <a class="nav-link" href="#">12 Month Avg</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#"><i class="fa fa-download fa-lg"></i></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#"><i class="fa fa-download fa-lg"></i></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#"><i class="fa fa-download fa-lg"></i></a>
                                </li>
                              </ul>
                            </nav> -->
                         <div class="table-wrapper">
                                <table class="analysis-table table table-striped mb-0">
                                  <thead>
                                     <tr>
                                      <td>&nbsp;</td>
                                      <td align="right"><?php echo $Subrub; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Period </td>
                                      <td align="right">Median Price (<?php echo $MapCurrecncy; ?>) </td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                       <?php //include_once("corelogic-json-test.php"); 
                                        
                                        $MedianTablArr  =  \api\apiClass::ShowMedianTableValueApi($LocationId,$StreetId,$ZipcodeId,$propertyTypeId); 
                                         foreach($MedianTablArr as $MedianTabl){
                                                
                                                $Datas       = $MedianTabl["date"];
                                            $Datas2          = $MedianTabl["value"];
                                        ?>
                                            <tr>
                                               <td><?php echo $Datas; ?></td>
                                               <td align="right">$ <?php echo number_format(round($Datas2),0); ?></td>
                                            </tr>
                                        <?php
                                         }
                                        ?>
                                  </tbody>
                                </table>
                          </div>
              </div>
            </div>
          </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card h-100 mb-0">
                    <div class="card-body">                          
                       <div class="chart-wrapper">
                        <div id="medianChart"></div>
                      </div>
                    </div>
                </div>
            </div>
        
             <div class="col-lg-6 col-md-12 col-sm-12 mt-30 pr-md-3 pr-0">
               <div class="card h-100 mb-0">
                <div class="card-header">
                   <h4 class="card-title">Change in Median Price</h4>
                </div>
                 <div class="card-body">
                  
                                                        
                            <div class="table-wrapper">
                                <table class="analysis-table table table-striped mb-0">
                                  <thead>
                                     <tr>
                                      <td>&nbsp;</td>
                                      <td align="right"><?php echo $Subrub; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Period </td>
                                      <td align="right">% Change</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                            
                                    <?php //include_once("corelogic-json-test.php"); 
                                                
                                    $MedianTablArr  =  \api\apiClass::ChangeMedianPriceTableVal($LocationId,$StreetId,$ZipcodeId,$propertyTypeId); 
                                     foreach($MedianTablArr as $MedianTabl){
                                            
                                            $Datas       = $MedianTabl["date"];
                                        $Datas2      = $MedianTabl["value"];
                                    ?>
                                        <tr>
                                           <td><?php echo $Datas; ?></td>
                                           <td align="right"><?php echo number_format($Datas2,3); ?> %</td>
                                        </tr>
                                    <?php
                                     }
                                    ?>
                                </tbody>
                            </table>
                      </div>
                    </div>
                 </div>
               </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mt-30">
                <div class="card h-100 mb-0">
                    <div class="card-body">                            
                    <div class="chart-wrapper">
                      <div id="changemedianprice"></div>
                    </div>
                </div>
            </div>
        </div>
      </div>
        
        
        <div class="row no-gutters mt-30">
            <div class="col-lg-6 col-md-12 col-sm-12 pr-md-3 pr-0">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Average Rental Statistics</h4>
                  </div>
                    <div class="card-body">
                        <div class="chart-wrapper">
                          <div id="rentalstatistics"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card ">
                  <div class="card-header">
                    <h4 class="card-title">Rental Rate Observations</h4>
                  </div>
                    <div class="card-body">
                          
                          <div class="chart-wrapper">
                        <div id="rentalrateobservation"></div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 pr-md-3 pr-0">
                <div class="card ">
                  <div class="card-header">
                    <h4 class="card-title">Change in Rental Rate</h4>
                  </div>
                    <div class="card-body">
                        <div class="chart-wrapper">
                          <div id="changerenatalrate"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card h-100">
                  <div class="card-header"><h4 class="card-title">Value Based Gross Rental Yield</h4></div>
                    <div class="card-body">
                            <div class="chart-wrapper">
                          <div id="grossrentalyield"></div>
                        </div>
                        </div>
                    
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 pr-md-3 pr-0">
                <div class="card h-100">
                  <div class="card-header">
                    <h4 class="card-title">Household Structure</h4>
                  </div>
                    <div class="card-body">
                        <div class="chart-wrapper">
                      <div id="census"></div>
                    </div>
                  </div>                    
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Age Ratio</h4>
                  </div>
                    <div class="card-body">
                        
                        <div class="chart-wrapper">
                          <div id="AgeRatio"></div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-lg-6 col-md-12 col-sm-12 pr-md-3 pr-0">
               <div class="card h-100 mb-0">
                <div class="card-header">
                   <h4 class="card-title">Household Income</h4>
                </div>
                 <div class="card-body">
                  
                                                        
                            <div class="table-wrapper">
                                <table class="analysis-table table table-striped mb-0">
                                  <thead>
                                     <tr>
                                      <td>Income Range</td>
                                      <td align="right"><?php echo $Subrub; ?></td>
                                    </tr>
                                  </thead>
                                  <tbody>
                            
                                    <?php //include_once("corelogic-json-test.php"); 
                                    
                                     if ( $countryId == "2"){
                                        $MetricsHouseholdIncome ="105";
                                    }else{
                                        $MetricsHouseholdIncome ="117";
                                    }
                                             
                                     $HouseholdIncomeArr  =  \api\apiClass::HouseholdIncomeTableVal($LocationId,$StreetId,$ZipcodeId,$propertyTypeId,$MetricsHouseholdIncome); 
                                     
                                     //echo "<pre>"; print_r($HouseholdIncomeArr); echo "</pre>";
                                     
                                     foreach($HouseholdIncomeArr as $HouseholdIncomeTbl){
                                            
                                        $Datas       = $HouseholdIncomeTbl["metricTypeShort"];
                                        $Datas2      = $HouseholdIncomeTbl["value"];
                                    ?>
                                        <tr>
                                           <td><?php echo $Datas; ?></td>
                                           <td align="right"><?php echo number_format($Datas2); ?> %</td>
                                        </tr>
                                    <?php
                                     }
                                    ?>
                                </tbody>
                            </table>
                      </div>
                    </div>
                 </div>
               </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mt-30">
                <div class="card h-100 mb-0">
                    <div class="card-body">    
                    <h4 class="card-title">Household Income</h4>
                    <div class="chart-wrapper">
                      <div id="HouseholdIncome"></div>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-lg-6 col-md-12 col-sm-12 pr-md-3 pr-0">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">Education By Qualification</h4>
                        <div class="chart-wrapper">
                      <div id="EducationByQf"></div>
                    </div>
                  </div>                    
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">Education By Occupation</h4>
                        <div class="chart-wrapper">
                      <div id="EducationByOccpation"></div>
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

            <div class="col-lg-6 col-md-12 col-sm-12 pr-md-3 pr-0" <?php echo $StyleHide; ?> >
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">Education By Level</h4>
                        <div class="chart-wrapper">
                      <div id="EducationByLevel"></div>
                    </div>
                  </div>                    
                </div>
            </div>
            
            
        </div>
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.15.5/apexcharts.min.js"></script>
    
        
        <?php //include_once("corelogic-json-test.php"); 
        
      
        
        
            echo \api\apiClass::ShowMedianMapApi($LocationId,$StreetId,$ZipcodeId,$Subrub,"",$propertyTypeId,$countryId); 
            
            
            echo \api\apiClass::ChangeMedianPriceApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId);
            
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
          
        
            echo \api\apiClass::RentalStatisticsApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$MetricsRentalStatics,$countryId);
             echo \api\apiClass::RentalRateObservationApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$MetricsRentalRate,$countryId);
            echo \api\apiClass::ChangerenatalRateApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$MetricsChangerenatalRate,$countryId);
            echo \api\apiClass::GrossRentalYieldApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$MetricsGrossRentalYield,$countryId);
            
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
            
            echo \api\apiClass::ShowCensusHouseholdMapApi("formap", $LocationId, "8", $MetricsShowCensusHousehold);
            echo \api\apiClass::AgeRatioApi("formap", $LocationId, "8", $MetricsAgeRatio);
            echo \api\apiClass::HouseholdIncomeApi("formap", $LocationId, "8", $MetricsHouseholdIncome);
            echo \api\apiClass::EducationByQfApi("formap", $LocationId, "8", $MetricsEducationByQf);
            echo \api\apiClass::EducationByOccpationApi("formap", $LocationId, "8", $MetricsEducationByOccpation);
            echo \api\apiClass::EducationByLevelApi("formap", $LocationId, "8", "116");
            
            //$RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $metricGroupId = "118"
        ?>
        
        
        <?php /*
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card" style='align:center'>
                    <div class="card-body">
                            <h4 class="card-title">Household  Structure</h4>
                            <div class="chart-wrapper">
                                 <div id="payingCosts"></div>
                            </div>
                        </div>
                    
                    
                </div>
            </div>
        </div>
        
        <script type="text/javascript">
        
             var options = {
          series: [20, 55, 25],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['Loan Occupant', 'Share Accommodation', 'Other'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#payingCosts"), options);
        chart.render();
        </script>
        <?php */?>
    <?php 
            
     } 
     elseif($LocationId != "" && $countryId == "3"){
         echo "<!-- Test  Start= " . date("Y-m-d H:i:s") . "-->"; 
         //ob_get_flush();
         ob_flush(); flush(); // send buffer output
         //exit;
          $IsALl= true;
          
    if( $IsALl == true )
    {
    ?>
        <div class="row" >
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                             <div class="table-responsive quartiles">
                              
                                    <?php //include_once("corelogic-json-test.php"); 
                                    
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
                                         
                                         echo "<!-- Test  After PeopleAndPopulationApiClass =  " .date("Y-m-d H:i:s") . " -->";
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
                              <table class="analysis-table table table-striped" align='center' >
                                    <tr align='center' >
                                        <th>People and Population Overview</th>
                                        <th>Median Age</th>
                                        <th>Population Density (England & Wales)</th>
                                        <th>Higher Education or Equivalent</th>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <td align='center' ><?php echo number_format($TotalPopulation); ?></td>
                                        <td align='center' ><?php echo round(floatval($TotMedianAgeVal) / $jNew); ?></td>
                                        <td align='center' ><?php echo number_format($TotPopulationDensity); ?></td>
                                        <td align='center' ><?php echo floatval($TotHigherEducationEQI) / floatval($jNew); ?>%</td>
                                    </tr>
                                    
                              </table>
                         
                    </div>
                    
                    
                    
                  </div>                    
                </div>
            </div>
        </div>
        
        
        <div class="row" >
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Population</h4>
                        <div class="chart-wrapper">
                        <div id="Population"></div>
                    </div>
                  </div>                    
                </div>
            </div>
        </div>
        
        <?php
        

        
         echo \api\apiClass::PopulationApiUK($LocationId,$datefilter1,$datefilter2); // Arzath - 2020-08-18
         
         echo "<!-- Test  PopulationApiUK= " . date("Y-m-d H:i:s") . "-->";
         ob_flush(); flush(); // send buffer output
         //exit;
    }
         
    if( $IsALl == true )
    {
    ?>
                
        <!---------------------------------------------------New--------------------------------------------------->
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Education By Level</h4>
                        <div class="chart-wrapper">
                      <div id="EducationByLevel"></div>
                    </div>
                  </div>                    
                </div>
            </div>
        </div>
        
        <?php
            
             // echo \api\apiClass::PopulationApiUK($LocationId,$datefilter1,$datefilter2); // Arzath - 2020-08-18
             echo \api\apiClass::EducationByLevelApiUK($LocationId,$datefilter1,$datefilter2);
             echo "<!-- Test  EducationByLevelApiUK = " . date("Y-m-d H:i:s") . " -->";
             ob_flush(); flush(); // send buffer output
             //exit;
             

        
        ?>
        
        
         <!---------------------------------------------------Mortgage Affordability--------------------------------------------------->
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Mortgage Affordability</h4>
                        <div class="chart-wrapper">
                      <div id="MortgageAffordability"></div>
                    </div>
                  </div>                    
                </div>
            </div>
        </div>
        <?php
            
             echo \api\apiClass::MortgageAffordabilityUK($LocationId,$datefilter1,$datefilter2,"MortgageAffordability");
            echo "<!-- Test  MortgageAffordabilityUK = " . date("Y-m-d H:i:s") . " -->";
            ob_flush(); flush(); // send buffer output
        
        ?>
        <!---------------------------------------------------Mortgage Affordability--------------------------------------------------->
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Income Age</h4>
                        <div class="chart-wrapper">
                      <div id="IncomeAge"></div>
                    </div>
                  </div>                    
                </div>
            </div>
        </div>
        <?php
            
             echo \api\apiClass::MortgageAffordabilityUK($LocationId,$datefilter1,$datefilter2,"IncomeAge");
            echo "<!-- Test  MortgageAffordabilityUK = " . date("Y-m-d H:i:s") . " -->";
            ob_flush(); flush(); // send buffer output
    }   
         
        
    if($MultiPropertyVal != "" &&  $IsALl == true)      
    {
       
         $IsTransactionalValue = 1;
         
        ?>
         
         
          <div class="row result-filter">
              <div class="col-lg-12 col-md-12 col-sm-12">   
                <div class="accordion accordion-membership mt-4">
                    
                    <div class="card">
             
                             
                         <div class="card-header">
                            <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne<?php echo $IsTransactionalValue; ?>" aria-expanded="true" aria-controls="collapseOne">
                               <i class="fa" aria-hidden="true"></i>
                               Transactional
                            </h5>
                         </div>
                         
                         <div id="collapseOne<?php echo $IsTransactionalValue; ?>" class="collapse" data-parent="">
                             
                
        <?php
                   
            //echo 'MultiPropertyVal='. $MultiPropertyVal;
            

         //$MultiPropertyVal = "Discnt,GrsYld";
         $DatasourceArr =  explode(",",$MultiPropertyVal);
        
        $m=1;
        
        foreach($DatasourceArr as $DataSrc){
            
        //$DataSrc = "Discnt";
            
        //if ($DataSrc == "Discnt"){
        
         //Discnt,GrsYld,PriAsk,RentAsk,sqfiRent,sqfiSales,PriPaid
                                  
         // DaysMarRent,PropSize,DaysMarSales,RentList,NewRentList,SalesList,NewSalesList,SalesTrans
        
                if( $DataSrc == "Discnt"){
                  
                    $ProductName      = "Average Discount (Sales)";
                    
                    $IsTransactional = true;
                }
                  
                if( $DataSrc == "GrsYld"){
                   
                    $ProductName = "Average Gross Yield Per Month";
                    
                     $IsTransactional = true;
                }
                    
                if( $DataSrc == "PriAsk"){
                  
                    $ProductName = "Average Asking Price (Sales)";
                    
                    $IsTransactional = true;
                }
                
                if( $DataSrc == "RentAsk"){
                   
                     $ProductName = "Average Asking Monthly Rental";
                     
                      $IsTransactional = true;
                }
                    
                if( $DataSrc == "sqfiRent"){
                   
                    $ProductName = "Average Annual Asking Rent £ per ft²";
                    
                    $IsTransactional = true;
                }
                    
                if( $DataSrc == "sqfiSales"){
                  
                    $ProductName = "Average Asking Price £ per ft² (Sales)";
                    
                    $IsTransactional = true;
                }
                    
                if( $DataSrc == "PriPaid"){
                   
                    $ProductName = "Average Price Paid (Sales)";
                    
                    $IsTransactional = true; 
                }
                    
                if( $DataSrc == "DaysMarRent"){
                   
                    $ProductName = "Average Days on Market (Rentals)";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "PropSize"){
                   
                    $ProductName = "Average Area (Rentals)";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "DaysMarSales"){
                    
                    $ProductName = "Average days on Market (Sales)";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "RentList"){
                    
                    $ProductName = "Rent Listing Month";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "NewRentList"){
                    
                    $ProductName = "Number of new Rental Listing's per Month";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "SalesList"){
                    
                    $ProductName = "Sales Listing";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "NewSalesList"){
                    
                    $ProductName = "Number of new Sales Listing's per Month";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "SalesTrans"){
                    
                    $ProductName = "Sales Transactions";
                    
                    $IsPropertySpecific = true;
                }
            
         

        ?>
           
                       
                         
                         
                         
                            <div class="card-body">
                                 <h4 class="card-title"><?php echo $ProductName; ?></h4>
                              <div class="col-md-12">
                                   <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                      <a class="nav-link active" id="chart-tab" data-toggle="tab" href="#chartTab<?php echo $m;?>" role="tab" aria-controls="home" aria-selected="true">Charts</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="quartiles-tab" data-toggle="tab" href="#quartilesTab<?php echo $m;?>" role="tab" aria-controls="profile" aria-selected="false">Quartiles</a>
                                    </li>
                                   <!-- <li class="nav-item">
                                      <a class="nav-link" id="price-paid-tab" data-toggle="tab" href="#pricePaidTab" role="tab" aria-controls="contact" aria-selected="false">Flat Price Paid Secondary</a>
                                    </li>-->
                                  </ul>
                                  <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="chartTab<?php echo $m;?>" role="tabpanel" aria-labelledby="chart-tab">
                                       <div class="card">
                                         <div class="card-header">
                                           <div class="card-action">
                                             <div class="float-left">
                                               <h6>&nbsp;</h6>
                                             </div>
                                             <div class="float-right">
                                               <ul class="nav">
                                                  <li class="nav-list"><i class="fa fa-download"></i></li>
                                                  <li class="nav-list"><i class="fa fa-save"></i></li>
                                                  <li class="nav-list"><input type="checkbox" name="iCheck" class="icheckCheckbox"></li>
                                               </ul>
                                             </div>
                                             <div class="clearfix"></div>
                                           </div>
                                         </div>
                                         <div class="card-body">
                                           <div id="chart<?php echo $m;?>"></div>
                                         </div>
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="quartilesTab<?php echo $m;?>" role="tabpanel" aria-labelledby="quartiles-tab">
                                      <div class="card">
                                        <div class="card-header">
                                         <div class="card-action">
                                           <div class="float-left">
                                             <h6>&nbsp;</h6>
                                           </div>
                                           <div class="float-right">
                                             <ul class="nav">
                                                <li class="nav-list"><i class="fa fa-download"></i></li>
                                                <li class="nav-list"><i class="fa fa-save"></i></li>
                                                <li class="nav-list"><input type="checkbox" name="iCheck" class="icheckCheckbox"></li>
                                             </ul>
                                           </div>
                                           <div class="clearfix"></div>
                                         </div>
                                       </div>
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
                                                  
                                                  <?php //include_once("corelogic-json-test.php"); 
                                                                        
                                                    //$productDetailsArr  =  \api\apiClass::ProductFeatureApiUk("forDet",$LocationId,$DataSrc,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$m);
                                                    
                                                    $DecimalPrint=0;
                                                    $Rounddcml =0;
                                                    
                                                    if ($DataSrc == "PriAsk" || $DataSrc == "RentAsk" || $DataSrc == "sqfiRent" || $DataSrc == "sqfiSales" || $DataSrc == "PriPaid" || $DataSrc == "NewRentList"  || $DataSrc == "NewSalesList" || $DataSrc == "SalesTrans" || $DataSrc == "PropSize" ){ 
                                                        
                                               
                                                       
                                                     
                                                       
                                                        $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValue("forDet",$LocationId,$DataSrc,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$m);
                                                         $DecimalPrint=0;
                                                    }else{
                                                        
                                                        if( $DataSrc == 'Discnt' || $DataSrc == 'DaysMarRent'  || $DataSrc == 'DaysMarSales' || $DataSrc == 'RentList' || $DataSrc == 'SalesList' ){
                                                            
                                                             $dcml = 1;
                                                            
                                                        }else{
                                                            
                                                             $dcml = 2;
                                                        }
                                                        
                                                       //echo "ProductFeatureApiUkDecimal= " . date("Y-m-d H:i:s");
                                                        $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkDecimal("forDet",$LocationId,$DataSrc,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$m,$dcml);
                                                         $DecimalPrint=2;
                                                    }
                                                    
                                                    echo "<!-- Test  ProductFeatureApiUkValue or ProductFeatureApiUkDecimal= " . date("Y-m-d H:i:s") . " -->";
                                                    ob_flush(); flush(); // send buffer output
                                                    //exit;
                                                    //echo "<pre>"; print_r($productDetailsArr); echo "</pre>"; 
                                                    $productDetailsArr = array_reverse($productDetailsArr);
                                                    
                                                     //echo "<pre>"; print_r($productDetailsArr); echo "</pre>"; 
                                                     //exit;
                                                    foreach($productDetailsArr as $RsDet){
                         
                                                            $MonthYr            = $RsDet["MonthYr"] ;
                                                            $NinthPercentile    = $RsDet["NinthPercentile"] ? $RsDet["NinthPercentile"] : "0";
                                                            $UpperQuartile      = $RsDet["UpperQuartile"] ? $RsDet["UpperQuartile"] : "0";
                                                            $Median             = $RsDet["Median"] ? $RsDet["Median"] : "0";
                                                            $LowerQuartile      = $RsDet["LowerQuartile"] ? $RsDet["LowerQuartile"] : "0";
                                                            $Supply             = $RsDet["Supply"] ? $RsDet["Supply"] : "0";
                                                            
                                                    ?>
                                                    
                                                        <tr>
                                                          <td><?php echo $MonthYr; ?></td>
                                                          <td><?php echo number_format($NinthPercentile,$DecimalPrint); ?></td>
                                                          <td><?php echo number_format($UpperQuartile,$DecimalPrint); ?></td>
                                                          <td><?php echo number_format($Median,$DecimalPrint); ?></td>
                                                          <td><?php echo number_format($LowerQuartile,$DecimalPrint); ?></td>
                                                          <td><?php echo number_format($Supply,$DecimalPrint); ?></td>
                                                        </tr>
                                                    
                                                    
                                                    <?php
                                                          
                                                     }
                          
                                                    ?>
                                               
                                                
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                      <!--<div class="card">
                                        <div class="card-header">
                                         <div class="card-action">
                                           <div class="float-left">
                                             <h6>card heading</h6>
                                           </div>
                                           <div class="float-right">
                                             <ul class="nav">
                                                <li class="nav-list"><i class="fa fa-download"></i></li>
                                                <li class="nav-list"><i class="fa fa-save"></i></li>
                                                <li class="nav-list"><input type="checkbox" name="iCheck" class="icheckCheckbox"></li>
                                             </ul>
                                           </div>
                                           <div class="clearfix"></div>
                                         </div>
                                       </div>
                                    </div>-->
                                    
                                    <div class="tab-pane fade" id="pricePaidTab" role="tabpanel" aria-labelledby="price-paid-tab">
                                      
                                    </div>
                                  </div> 
                                  </div>
                                </div>
                                
                                </div>
                        
                        
            <?php  
            
                if ($DataSrc == "PriAsk" || $DataSrc == "RentAsk" || $DataSrc == "sqfiRent" || $DataSrc == "sqfiSales" || $DataSrc == "PriPaid" || $DataSrc == "NewRentList"  || $DataSrc == "NewSalesList" || $DataSrc == "SalesTrans" || $DataSrc == "PropSize" ){ 
                                           
                    echo \api\apiClass::ProductFeatureApiUkValue("formap",$LocationId,$DataSrc,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$m);
                }else{
                    
                    if( $DataSrc == 'Discnt' || $DataSrc == 'DaysMarRent' || $DataSrc == 'DaysMarSales' || $DataSrc == 'RentList' || $DataSrc == 'SalesList' ){
                        
                         $dcml = 1;
                        
                    }else{
                        
                         $dcml = 2;
                    }
                    
                   
                   echo \api\apiClass::ProductFeatureApiUkDecimal("formap",$LocationId,$DataSrc,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$m,$dcml);
                }
                
                echo "<!-- Test  ProductFeatureApiUkValue or ProductFeatureApiUkDecimal = " . date("Y-m-d H:i:s") . "-->";
                ob_flush(); flush(); // send buffer output
                //exit;
            
                 
            $m++;
            }
                //echo "MultiPropertyVal=". $MultiPropertyVal . "<br>"; 

            ?>
                
      
                                    </div>
                         
                         
                         
                         
                         
                         
                    
                            </div>
                        </div>
                    </div>
                </div>
<?php
                
    }
    
    
    if($MultiPropertyValNew != "" &&  $IsALl == true)      
    {
 
?>             
        <!---------------------------------------------------New  ---------------------------------------------->
        
        
        <div class="row result-filter">
              <div class="col-lg-12 col-md-12 col-sm-12">   
                <div class="accordion accordion-membership mt-4">
                    
                    <div class="card">
             
                             
                         <div class="card-header">
                            <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne">
                               <i class="fa" aria-hidden="true"></i>
                               Property Specific
                            </h5>
                         </div>
                         
                         <div id="collapseOne2" class="collapse" data-parent="">
                             
                
        <?php
        
        //echo 'MultiPropertyValNew='. $MultiPropertyValNew;
                   
         
       //$MultiPropertyValNew = "DaysMarRent";
         $DatasourceArrNew =  explode(",",$MultiPropertyValNew);
        
        $n=100;
        
        foreach($DatasourceArrNew as $DataSrc){
            
        //$DataSrc = "Discnt";
            
        //if ($DataSrc == "Discnt"){
        
         //Discnt,GrsYld,PriAsk,RentAsk,sqfiRent,sqfiSales,PriPaid
                                  
         // DaysMarRent,PropSize,DaysMarSales,RentList,NewRentList,SalesList,NewSalesList,SalesTrans
        
                if( $DataSrc == "Discnt"){
                  
                    $ProductName      = "Average Discount (Sales)";
                    
                    $IsTransactional = true;
                }
                  
                if( $DataSrc == "GrsYld"){
                   
                    $ProductName = "Average Gross Yield Per Month";
                    
                     $IsTransactional = true;
                }
                    
                if( $DataSrc == "PriAsk"){
                  
                    $ProductName = "Average Asking Price (Sales)";
                    
                    $IsTransactional = true;
                }
                
                if( $DataSrc == "RentAsk"){
                   
                     $ProductName = "Average Asking Monthly Rental";
                     
                      $IsTransactional = true;
                }
                    
                if( $DataSrc == "sqfiRent"){
                   
                    $ProductName = "Average Annual Asking Rent £ per ft²";
                    
                    $IsTransactional = true;
                }
                    
                if( $DataSrc == "sqfiSales"){
                  
                    $ProductName = "Average Asking Price £ per ft² (Sales)";
                    
                    $IsTransactional = true;
                }
                    
                if( $DataSrc == "PriPaid"){
                   
                    $ProductName = "Average Price Paid (Sales)";
                    
                    $IsTransactional = true; 
                }
                    
                if( $DataSrc == "DaysMarRent"){
                   
                    $ProductName = "Average Days on Market (Rentals)";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "PropSize"){
                   
                    $ProductName = "Average Area (Rentals)";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "DaysMarSales"){
                    
                    $ProductName = "Average days on Market (Sales)";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "RentList"){
                    
                    $ProductName = "Rent Listing Month";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "NewRentList"){
                    
                    $ProductName = "Number of new Rental Listing's per Month";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "SalesList"){
                    
                    $ProductName = "Sales Listing";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "NewSalesList"){
                    
                    $ProductName = "Number of new Sales Listing's per Month";
                    
                    $IsPropertySpecific = true;
                }
                    
                if( $DataSrc == "SalesTrans"){
                    
                    $ProductName = "Sales Transactions";
                    
                    $IsPropertySpecific = true;
                }
            
         

        ?>
           
                       
                         
                         
                         
                            <div class="card-body">
                                 <h4 class="card-title"><?php echo $ProductName; ?></h4>
                              <div class="col-md-12">
                                   <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                      <a class="nav-link active" id="chart-tab" data-toggle="tab" href="#chartTab<?php echo $n;?>" role="tab" aria-controls="home" aria-selected="true">Charts</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="quartiles-tab" data-toggle="tab" href="#quartilesTab<?php echo $n;?>" role="tab" aria-controls="profile" aria-selected="false">Quartiles</a>
                                    </li>
                                   <!-- <li class="nav-item">
                                      <a class="nav-link" id="price-paid-tab" data-toggle="tab" href="#pricePaidTab" role="tab" aria-controls="contact" aria-selected="false">Flat Price Paid Secondary</a>
                                    </li>-->
                                  </ul>
                                  <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="chartTab<?php echo $n;?>" role="tabpanel" aria-labelledby="chart-tab">
                                       <div class="card">
                                         <div class="card-header">
                                           <div class="card-action">
                                             <div class="float-left">
                                               <h6>&nbsp;</h6>
                                             </div>
                                             <div class="float-right">
                                               <ul class="nav">
                                                  <li class="nav-list"><i class="fa fa-download"></i></li>
                                                  <li class="nav-list"><i class="fa fa-save"></i></li>
                                                  <li class="nav-list"><input type="checkbox" name="iCheck" class="icheckCheckbox"></li>
                                               </ul>
                                             </div>
                                             <div class="clearfix"></div>
                                           </div>
                                         </div>
                                         <div class="card-body">
                                           <div id="chart<?php echo $n;?>"></div>
                                         </div>
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="quartilesTab<?php echo $n;?>" role="tabpanel" aria-labelledby="quartiles-tab">
                                      <div class="card">
                                        <div class="card-header">
                                         <div class="card-action">
                                           <div class="float-left">
                                             <h6>&nbsp;</h6>
                                           </div>
                                           <div class="float-right">
                                             <ul class="nav">
                                                <li class="nav-list"><i class="fa fa-download"></i></li>
                                                <li class="nav-list"><i class="fa fa-save"></i></li>
                                                <li class="nav-list"><input type="checkbox" name="iCheck" class="icheckCheckbox"></li>
                                             </ul>
                                           </div>
                                           <div class="clearfix"></div>
                                         </div>
                                       </div>
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
                                                  
                                                  <?php //include_once("corelogic-json-test.php"); 
                                                                        
                                                    //$productDetailsArr  =  \api\apiClass::ProductFeatureApiUk("forDet",$LocationId,$DataSrc,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$n);
                                                    
                                                    $DecimalPrint=0;
                                                    $Rounddcml =0;
                                                    
                                                    if ($DataSrc == "PriAsk" || $DataSrc == "RentAsk" || $DataSrc == "sqfiRent" || $DataSrc == "sqfiSales" || $DataSrc == "PriPaid" || $DataSrc == "NewRentList"  || $DataSrc == "NewSalesList" || $DataSrc == "SalesTrans" || $DataSrc == "PropSize" ){ 
                                                        
                                               
                                                       
                                                     
                                                       
                                                        $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValue("forDet",$LocationId,$DataSrc,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$n);
                                                         $DecimalPrint=0;
                                                    }else{
                                                        
                                                        if( $DataSrc == 'Discnt' || $DataSrc == 'DaysMarRent'  || $DataSrc == 'DaysMarSales' || $DataSrc == 'RentList' || $DataSrc == 'SalesList' ){
                                                            
                                                             $dcml = 1;
                                                            
                                                        }else{
                                                            
                                                             $dcml = 2;
                                                        }
                                                        
                                                       //echo "ProductFeatureApiUkDecimal= " . date("Y-m-d H:i:s");
                                                        $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkDecimal("forDet",$LocationId,$DataSrc,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$n,$dcml);
                                                         $DecimalPrint=2;
                                                    }
                                                    
                                                    echo "<!-- Test  ProductFeatureApiUkValue or ProductFeatureApiUkDecimal= " . date("Y-m-d H:i:s") . " -->";
                                                    ob_flush(); flush(); // send buffer output
                                                    //exit;
                                                    //echo "<pre>"; print_r($productDetailsArr); echo "</pre>"; 
                                                    $productDetailsArr = array_reverse($productDetailsArr);
                                                    
                                                     //echo "<pre>"; print_r($productDetailsArr); echo "</pre>"; 
                                                     //exit;
                                                    foreach($productDetailsArr as $RsDet){
                         
                                                            $MonthYr            = $RsDet["MonthYr"] ;
                                                            $NinthPercentile    = $RsDet["NinthPercentile"] ? $RsDet["NinthPercentile"] : "0";
                                                            $UpperQuartile      = $RsDet["UpperQuartile"] ? $RsDet["UpperQuartile"] : "0";
                                                            $Median             = $RsDet["Median"] ? $RsDet["Median"] : "0";
                                                            $LowerQuartile      = $RsDet["LowerQuartile"] ? $RsDet["LowerQuartile"] : "0";
                                                            $Supply             = $RsDet["Supply"] ? $RsDet["Supply"] : "0";
                                                            
                                                    ?>
                                                    
                                                        <tr>
                                                          <td><?php echo $MonthYr; ?></td>
                                                          <td><?php echo number_format($NinthPercentile,$DecimalPrint); ?></td>
                                                          <td><?php echo number_format($UpperQuartile,$DecimalPrint); ?></td>
                                                          <td><?php echo number_format($Median,$DecimalPrint); ?></td>
                                                          <td><?php echo number_format($LowerQuartile,$DecimalPrint); ?></td>
                                                          <td><?php echo number_format($Supply,$DecimalPrint); ?></td>
                                                        </tr>
                                                    
                                                    
                                                    <?php
                                                          
                                                     }
                          
                                                    ?>
                                               
                                                
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                      <!--<div class="card">
                                        <div class="card-header">
                                         <div class="card-action">
                                           <div class="float-left">
                                             <h6>card heading</h6>
                                           </div>
                                           <div class="float-right">
                                             <ul class="nav">
                                                <li class="nav-list"><i class="fa fa-download"></i></li>
                                                <li class="nav-list"><i class="fa fa-save"></i></li>
                                                <li class="nav-list"><input type="checkbox" name="iCheck" class="icheckCheckbox"></li>
                                             </ul>
                                           </div>
                                           <div class="clearfix"></div>
                                         </div>
                                       </div>
                                    </div>-->
                                    
                                    <div class="tab-pane fade" id="pricePaidTab" role="tabpanel" aria-labelledby="price-paid-tab">
                                      
                                    </div>
                                  </div> 
                                  </div>
                                </div>
                                
                                </div>
                        
                        
            <?php  
            
                if ($DataSrc == "PriAsk" || $DataSrc == "RentAsk" || $DataSrc == "sqfiRent" || $DataSrc == "sqfiSales" || $DataSrc == "PriPaid" || $DataSrc == "NewRentList"  || $DataSrc == "NewSalesList" || $DataSrc == "SalesTrans" || $DataSrc == "PropSize" ){ 
                                           
                    echo \api\apiClass::ProductFeatureApiUkValue("formap",$LocationId,$DataSrc,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$n);
                }else{
                    
                    if( $DataSrc == 'Discnt' || $DataSrc == 'DaysMarRent' || $DataSrc == 'DaysMarSales' || $DataSrc == 'RentList' || $DataSrc == 'SalesList' ){
                        
                         $dcml = 1;
                        
                    }else{
                        
                         $dcml = 2;
                    }
                    
                   
                   echo \api\apiClass::ProductFeatureApiUkDecimal("formap",$LocationId,$DataSrc,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$n,$dcml);
                }
                
                echo "<!-- Test  ProductFeatureApiUkValue or ProductFeatureApiUkDecimal = " . date("Y-m-d H:i:s") . "-->";
                ob_flush(); flush(); // send buffer output
                //exit;
            
                 
            $n++;
            }
                //echo "MultiPropertyVal=". $MultiPropertyVal . "<br>"; 
    
            ?>
                
      
                                    </div>



                            </div>
                        </div>
                    </div>
                </div>
    <?php
    
    }
    
    if($MultiPropertyValOther != "" && $IsALl == true )
    {
        
    ?>
         
        
        <div class="row result-filter">
          <div class="col-lg-12 col-md-12 col-sm-12">   
            <div class="accordion accordion-membership mt-4">
                
                <div class="card">
         
                         
                     <div class="card-header">
                        <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOneOther" aria-expanded="true" aria-controls="collapseOne">
                           <i class="fa" aria-hidden="true"></i>
                           Other's
                        </h5>
                     </div>
                     
                     <div id="collapseOneOther" class="collapse" data-parent="">
                             
                
        <?php
                   
         
         $DatasourceOtherArr =  explode(",",$MultiPropertyValOther);
        
        $P=1;
        
        foreach($DatasourceOtherArr as $DataSrc)
        {
            // echo 'MultiPropertyValOther=New';
    
                
                $IndexQry = "SELECT auto_id, api_id, api_name, display_name,graphpoint FROM api_common_details WHERE api_id = '{$DataSrc}' ";
                
                $Rows = \DBConn\DBConnection::getQuery( $IndexQry );
                            
                foreach($Rows as $Row){
                    
                    $ProductName = $Row["display_name"];
                    $graphpoint = $Row["graphpoint"];
                }
            
              // SELECT auto_id, api_id, api_name, display_name FROM api_common_details WHERE 1

        ?>
                        <div class="row" >
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $ProductName; ?></h4>
                                        <div class="chart-wrapper">
                                        <div id="AppGraph<?php echo $DataSrc; ?>"></div>
                                    </div>
                                  </div>                    
                                </div>
                            </div>
                        </div>
           
                           
                        
            <?php  
            
                     echo \api\apiClass::FeatureCommonApiUkValue("formap",$LocationId,$DataSrc,$datefilter1,$datefilter2,$m,$ProductName,$graphpoint);
                
                    
                    
                    echo "<!-- Test  FeatureCommonApiUkValue  = " . date("Y-m-d H:i:s") . "-->";
                    ob_flush(); flush(); // send buffer output
                    //exit;
                
                     
                $P++;
            
            }
            
        
                //echo "MultiPropertyVal=". $MultiPropertyVal . "<br>"; 

            ?>
                
      
                                    </div>
                    
                            </div>
                        </div>
                    </div>
                </div>
                
        <!---------------------------------------------------New  ---------------------------------------------->
        
        
  
   <?php 
    }

   } 
   
   
   ?>    
    
       

</div>
<!-- end main content -->
<script>
    

    
    function PDFBtnFn(){
        LocationId = $("[name='LocationId']").val();
        StreetId = $("[name='StreetId']").val();
        ZipcodeId = $("[name='ZipcodeId']").val();
        
        //console.log( "<?php echo SITE_BASE_URL;?>/Property/AreaProfilePdf.html?LocationId=" + LocationId + "&StreetId=" + StreetId + "&ZipcodeId=" + ZipcodeId);
        //return false; 
        
        window.location.href = "<?php echo SITE_BASE_URL;?>/Property/AreaProfilePdf.html?LocationId=" + LocationId + "&StreetId=" + StreetId + "&ZipcodeId=" + ZipcodeId;
    }
    
    $(document).on("change", "#SubrubDp", function(){
        Text1 = $("#SubrubDp option:selected").text();
        Val1  = $(this).val();
        
      // console.log(Text1);
       // console.log(Val1);
        alert(Text1);
        //alert()
        
        $("[name='Subrub']").val( Text1 );
        $("#LocationId").val(Val1);
        
    });
    
    $(document).on("click", ".SearchBtn", function(){
        
        //alert(document.getElementById("LocationId").value);
        if(document.getElementById("LocationId").value=="")
        {
            alert("Select Subrub from the list");
            return false;
        }
    });
    

    
    function validateForm() {
        
            if(document.getElementById("LocationId").value=="")
            {
                alert("Select Subrub from the list");
                return false;
            }
            
            
            var countryId =  $("#countryId").val();
            
            //alert('countryId='+countryId)
            
            
            if (countryId == "3"  ){
                
                 PropertyCheckedFn();
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
    
    	for(i=0;i<=MultiPropertyValOtherId.length-1;i++){ 
    
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
    	
    //	alert(MultiPropertyVal);
    	
    	
    	
    	
    	
    	
    	
    	$("#loading").show();
    	
    
     }

    
</script>

<!-- Date Picker Plugin JavaScript -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 
  $('.icheckRadio').iCheck({
    checkboxClass: 'icheckbox_minimal',
    radioClass: 'iradio_minimal',
    increaseArea: '20%' // optional
  });

  $('.icheckCheckbox').iCheck({
    checkboxClass: 'icheckbox_flat-red',
    radioClass: 'icheck_minimal',
    increaseArea: '20%' // optional
  });


  $('.icheckBtn').each(function(){
    var self = $(this),
      label = self.next(),
      label_text = label.text();

    label.remove();
    self.iCheck({
      checkboxClass: 'icheckbox_line',
      radioClass: 'iradio_line',
      insert: '<div class="icheck_line-icon"></div>' + label_text
    });
  });

});
/*

$(document).on("click", "#Apply2,#Apply1", function(){
        if(document.getElementById("LocationId").value=="")
        {
            alert("Select Subrub from the list");
            return false;
        }
    });

 $("#Apply2,#Apply1").on("click",function(e){
     
   
    countryId       = $("[name='countryId']").val();
    datasource      = $("input[name='datasource']:checked").val();
    BuildType       = $("input[name='BuildType']:checked").val();
    bedrooms        = $('select[name=bedrooms] option').filter(':selected').val();
    //$( "#myselect option:selected" ).text();
    propertyType    = $("input[name='propertyType']:checked").val();
    LocationId      = $("[name='LocationId']").val();
    Subrub          = $("[name='Subrub']").val();
    datefilter      = $("[name='datefilter']").val();
    
    
    

    
    if (LocationId == ""){
        
        alert("Please add Location");
        return false;
    }
    
    /*
    alert("countryId="+countryId);
    alert("datasource="+datasource);
    alert("BuildType="+BuildType);
    alert("bedrooms="+bedrooms);
     alert("propertyType="+propertyType);
    alert("LocationId="+LocationId);
     alert("Subrub="+Subrub);
  
    // alert("datefilter="+datefilter);
   
   //return false;
   


    window.location.href = "<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=" + countryId + "&datasource=" + datasource + "&BuildType=" + BuildType +"&bedrooms="+bedrooms +"&LocationId="+ LocationId +"&Subrub="+Subrub +"&propertyType="+propertyType+"&datefilter="+datefilter;
    //window.location.reload();
     
 });
*/
$('.dropdown-menu .nav-pills .nav-link').on("click.bs.dropdown", function (e) { 
    $(this).tab('show'); 
    e.stopPropagation(); 
});

$('.filter-box').on("click.bs.dropdown", function (e) {  
    e.stopPropagation(); 
});
/*
$(function() {

  $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      showDropdowns: true,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
  
  
  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });






});
*/

    
    function ClearAllFn(){
    	var MultiPropertyId = document.getElementsByName("datasource");
    	k=0;
    
    	for(i=0;i<=MultiPropertyId.length-1;i++){ 
    	    MultiPropertyId[i].checked = false;
    	} 
    	
    }
  
  
  $("#loading").hide();

</script>
    


<?php include"footer.php"; 

 \api\apiClass::getLatLongAddress();


//ob_end_flush();
?>


