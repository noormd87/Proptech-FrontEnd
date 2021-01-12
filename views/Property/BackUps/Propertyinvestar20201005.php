<?php include "header.php"; 

//echo "Header Ends";
ob_flush(); flush();

\login\loginClass::Init();
$checkSession = \login\loginClass::CheckUserSessionIp();

\Property\PropertyClass::Init();
$countryId = isset($_REQUEST["country"]) ? $_REQUEST["country"] : "";

$CountryLng = isset($_REQUEST["CountryLng"]) ? $_REQUEST["CountryLng"] : "0"; // Arzath - 2020-09-01
$CountryLat = isset($_REQUEST["CountryLat"]) ? $_REQUEST["CountryLat"] : "0"; // Arzath - 2020-09-01

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



?>

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
                    <button type="submit" class="btn btn-default">Search</button>
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

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="overview">
                        <div class="row no-gutters">
                            <div class="col-xl-6">
                                <div class="rd-content">
                                    <div class="search-bar loader-text-box"> 
                                        <div class="input-group">
                                            <input class="form-control class_sub" type="text" name="Subrub" id="Suburb" placeholder="Suburb" value="<?php echo $Subrub;?>" autocomplete=off />
                                            <input class="form-control" type="hidden" name="LocationId" id="LocationId" placeholder="LocationId" value="<?php echo $LocationId;?>" >
                                            <input class="form-control" type="hidden" name="myportfoliocountry" id="myportfoliocountry"  value="<?php echo $CountryCodeNew;?>" >
                                            <input class="form-control" type="hidden" name="CountryLng" id="CountryLng"  value="<?php echo $CountryLng;?>" >
                                            <input class="form-control" type="hidden" name="CountryLat" id="CountryLat"  value="<?php echo $CountryLat;?>" >
                                            
                                            <div class="icon-container LoaderSuburb" style='display:none;' >
                                                <i class="loader"></i>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-default">Search</button>
                                    </div>
                                    <div class="d-inline-flex align-items-center rd-filters">
                                        <select class="form-control" name="loc" id="loc">
                                            <option value="selected" selected disabled>Location</option>
                                            <option value="s">Any Location</option>
                                            <option value="1">Any Location</option>
                                            <option value="s2">Any Location</option>
                                            <option value="s3">Any Location</option>
                                        </select>
                                        <div class="d-inline-flex align-items-center">
                                            <select class="form-control" name="date" id="sdate">
                                                <option value="selected" selected disabled>Start Date</option>
                                                <option value="s">1 May</option>
                                                <option value="s">2 May</option>
                                                <option value="s">3 May</option>
                                                <option value="s">4 May</option>
                                            </select>
                                            <span>to</span>
                                            <select class="form-control" name="date" id="edate">
                                                <option value="selected" selected disabled>End Date</option>
                                                <option value="s">4 June</option>
                                                <option value="s">5 June</option>
                                                <option value="s">6 June</option>
                                                <option value="s">7 June</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="place-type">
                                        <h4>Beckenham BR3</h4>
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
                                                    <input type="radio" class="form-check-input" name="optradio">All
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="optradio">Secondary
                                                </label>
                                            </div>
                                            <div class="form-check-inline disabled">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="optradio">New Build
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
                                                                £558 
                                                            </td>
                                                            <td>
                                                                £234.917 
                                                            </td>
                                                            <td>
                                                                0.8% 
                                                            </td>
                                                            <td>
                                                                18.6% 
                                                            </td>
                                                            <td>
                                                                2 
                                                            </td>
                                                            <td>
                                                                0 
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
                                                                £558 
                                                            </td>
                                                            <td>
                                                                £234.917 
                                                            </td>
                                                            <td>
                                                                0.8% 
                                                            </td>
                                                            <td>
                                                                18.6% 
                                                            </td>
                                                            <td>
                                                                2 
                                                            </td>
                                                            <td>
                                                                0 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                1 Bed 
                                                            </td>
                                                            <td>
                                                                £494 
                                                            </td>
                                                            <td>
                                                                £263.854 
                                                            </td>
                                                            <td>
                                                                1.9% 
                                                            </td>
                                                            <td>
                                                                4.4% 
                                                            </td>
                                                            <td>
                                                                39 
                                                            </td>
                                                            <td>
                                                                5 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                2 Bed 
                                                            </td>
                                                            <td>
                                                                £477 
                                                            </td>
                                                            <td>
                                                                £366.781 
                                                            </td>
                                                            <td>
                                                                6.3% 
                                                            </td>
                                                            <td>
                                                                4.2% 
                                                            </td>
                                                            <td>
                                                                67 
                                                            </td>
                                                            <td>
                                                                10 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                3 Bed 
                                                            </td>
                                                            <td>
                                                                £507 
                                                            </td>
                                                            <td>
                                                                £539.063 
                                                            </td>
                                                            <td>
                                                                3.0% 
                                                            </td>
                                                            <td>
                                                                4.1% 
                                                            </td>
                                                            <td>
                                                                12 
                                                            </td>
                                                            <td>
                                                                2 
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
                                            <img src="assets/images/bar-chart.png" class="w-100" alt="">

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
                    <div class="tab-pane fade" id="demographics">
                        <div class="row no-gutters">
                            <div class="col-xl-6">
                                <div class="rd-content">
                                    <div class="search-bar">
                                        <div class="input-group">
                                            <input type="text" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-default">Search</button>
                                    </div>
                                    <div class="d-inline-flex align-items-center rd-filters">
                                        <select class="form-control" name="loc" id="loc">
                                            <option value="selected" selected disabled>Location</option>
                                            <option value="s">Any Location</option>
                                            <option value="1">Any Location</option>
                                            <option value="s2">Any Location</option>
                                            <option value="s3">Any Location</option>
                                        </select>
                                        <div class="d-inline-flex align-items-center">
                                            <select class="form-control" name="date" id="sdate">
                                                <option value="selected" selected disabled>Start Date</option>
                                                <option value="s">1 May</option>
                                                <option value="s">2 May</option>
                                                <option value="s">3 May</option>
                                                <option value="s">4 May</option>
                                            </select>
                                            <span>to</span>
                                            <select class="form-control" name="date" id="edate">
                                                <option value="selected" selected disabled>End Date</option>
                                                <option value="s">4 June</option>
                                                <option value="s">5 June</option>
                                                <option value="s">6 June</option>
                                                <option value="s">7 June</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="place-type">
                                        <h4>Beckenham BR3</h4>
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
                                                                50,800
                                                            </td>
                                                            <td>
                                                                40
                                                            </td>
                                                            <td>
                                                                39
                                                            </td>
                                                            <td>
                                                                22 
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
                                                                50,800
                                                            </td>
                                                            <td>
                                                                40
                                                            </td>
                                                            <td>
                                                                39
                                                            </td>
                                                            <td>
                                                                22 
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </thead>
                                            </table>


                                            <h1 class="hero-title-dark sm-title">Population: Age 35 to 59
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
                                                                50,800
                                                            </td>
                                                            <td>
                                                                40
                                                            </td>
                                                            <td>
                                                                39
                                                            </td>
                                                            <td>
                                                                22 
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </thead>
                                            </table>


                                            <h1 class="hero-title-dark sm-title">Population: Age 60 to 85+
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
                                                                50,800
                                                            </td>
                                                            <td>
                                                                40
                                                            </td>
                                                            <td>
                                                                39
                                                            </td>
                                                            <td>
                                                                22 
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
                                                                Broadband Speed
                                                            </td>
                                                            <td>
                                                                12
                                                            </td>
                                                            <td>
                                                                23.184
                                                            </td>
                                                            <td>
                                                                59 mbps 
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
                                            <img src="assets/images/random-graph.png" class="w-100 mb-3" alt="">

                                            <h1 class="hero-title-dark sm-title">Braodband Speed - May 15 - Mar 20
                                                <select name="type" id="type" class="form-control">
                                                    <option value="flat">12 Month Aug</option>
                                                    <option value="flat">Sep</option>
                                                </select>
                                            </h1>
                                            <img src="assets/images/random-graph.png" class="w-100 mb-3" alt="">

                                            
                                        </div>  
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
                                                                14.1%
                                                            </td>
                                                            <td>
                                                                12.1%
                                                            </td>
                                                            <td>
                                                                11.7%
                                                            </td>
                                                            <td>
                                                                40%
                                                            </td>
                                                            <td>
                                                                4.8%
                                                            </td>
                                                            <td>
                                                                40%
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
                                            <img src="assets/images/loop-chart.png" class="w-100 mb-3" alt="">

                                            <h1 class="hero-title-dark sm-title">Education Level
                                                <select name="type" id="type" class="form-control">
                                                    <option value="flat">12 Month Aug</option>
                                                    <option value="flat">Sep</option>
                                                </select>
                                            </h1>
                                            <img src="assets/images/random-graph.png" class="w-100 mb-3" alt="">

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
                                                                14.1%
                                                            </td>
                                                            <td>
                                                                12.1%
                                                            </td>
                                                            <td>
                                                                11.7%
                                                            </td>
                                                            <td>
                                                                40%
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
                                                                780
                                                            </td>
                                                            <td>
                                                                £6,625
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
                                            <img src="assets/images/huge-graph.png" class="w-100 mb-3" alt="">

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
                                                                14.1%
                                                            </td>
                                                            <td>
                                                                12.1%
                                                            </td>
                                                            <td>
                                                                11.7%
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
                                                                20
                                                            </td>
                                                            <td>
                                                               99
                                                            </td>
                                                            <td>
                                                                173
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
                                            <img src="assets/images/huge-graph.png" class="w-100 mb-3" alt="">
                                            
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
                                                                20
                                                            </td>
                                                            <td>
                                                                99
                                                            </td>
                                                            <td>
                                                                173
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </thead>
                                            </table>
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
                                    <div class="search-bar">
                                        <div class="input-group">
                                            <input type="text" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-default">Search</button>
                                    </div>
                                    <div class="d-inline-flex align-items-center rd-filters">
                                        <select class="form-control" name="loc" id="loc">
                                            <option value="selected" selected disabled>Location</option>
                                            <option value="s">Any Location</option>
                                            <option value="1">Any Location</option>
                                            <option value="s2">Any Location</option>
                                            <option value="s3">Any Location</option>
                                        </select>
                                        <div class="d-inline-flex align-items-center">
                                            <select class="form-control" name="date" id="sdate">
                                                <option value="selected" selected disabled>Start Date</option>
                                                <option value="s">1 May</option>
                                                <option value="s">2 May</option>
                                                <option value="s">3 May</option>
                                                <option value="s">4 May</option>
                                            </select>
                                            <span>to</span>
                                            <select class="form-control" name="date" id="edate">
                                                <option value="selected" selected disabled>End Date</option>
                                                <option value="s">4 June</option>
                                                <option value="s">5 June</option>
                                                <option value="s">6 June</option>
                                                <option value="s">7 June</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="place-type">
                                        <h4>Beckenham BR3</h4>
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
                                            <img src="assets/images/huge-graph.png" class="w-100 mb-3" alt="">
                                            <h1 class="hero-title-dark sm-title">Flat Sales Listings Distribution May 15 - Mar 20
                                                <select name="type" id="type" class="form-control">
                                                    <option value="flat">12 Month Aug</option>
                                                    <option value="flat">Sep</option>
                                                </select>
                                            </h1>
                                            <img src="assets/images/huge-graph.png" class="w-100 mb-3" alt="">
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
                                    <div class="search-bar">
                                        <div class="input-group">
                                            <input type="text" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-default">Search</button>
                                    </div>
                                    <div class="d-inline-flex align-items-center rd-filters">
                                        <select class="form-control" name="loc" id="loc">
                                            <option value="selected" selected disabled>Location</option>
                                            <option value="s">Any Location</option>
                                            <option value="1">Any Location</option>
                                            <option value="s2">Any Location</option>
                                            <option value="s3">Any Location</option>
                                        </select>
                                        <div class="d-inline-flex align-items-center">
                                            <select class="form-control" name="date" id="sdate">
                                                <option value="selected" selected disabled>Start Date</option>
                                                <option value="s">1 May</option>
                                                <option value="s">2 May</option>
                                                <option value="s">3 May</option>
                                                <option value="s">4 May</option>
                                            </select>
                                            <span>to</span>
                                            <select class="form-control" name="date" id="edate">
                                                <option value="selected" selected disabled>End Date</option>
                                                <option value="s">4 June</option>
                                                <option value="s">5 June</option>
                                                <option value="s">6 June</option>
                                                <option value="s">7 June</option>
                                            </select>
                                        </div>
                                        <select class="form-control" name="date" id="edate">
                                            <option value="selected" selected disabled>Property Filters</option>
                                            <option value="s">Filter 1</option>
                                            <option value="s">Filter 2</option>
                                            <option value="s">Filter 3</option>
                                        </select>
                                    </div>
                                    <div class="place-type">
                                        <h4>Beckenham BR3</h4>
                                    </div>
                                    <div class="single-property">
                                        <h1 class="hero-title-dark sm-title">Flat 5, KensingtonCOurt, 8, Kemerton Road, Beckenham - BR3 ^NJ
                                            <select name="type" id="type" class="form-control">
                                                <option value="flat">12 Month Aug</option>
                                                <option value="flat">Sep</option>
                                            </select>
                                        </h1>
                                        <h3>£370,625 <small>Sold: Feb 19th 2020</small></h3>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <img src="assets/images/s-prop.png" class="w-100" alt="">
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p><i class="fas fa-bed"></i> 2 Bed <i class="fal fa-car"></i> 1 Car Park <i class="fal fa-bath"></i> 1 Bath</p>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <img src="assets/images/bar-chart.png" class="w-100" alt="">
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <table class="table table-striped">
                                                            <tr>
                                                                <td>
                                                                    £/sqft
                                                                </td>
                                                                <td>
                                                                    £394
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Est Rent
                                                                </td>
                                                                <td>
                                                                    4.2%
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Est Yield
                                                                </td>
                                                                <td>
                                                                    4.2%
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    £/sqft
                                                                </td>
                                                                <td>
                                                                    £394
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Est Rent
                                                                </td>
                                                                <td>
                                                                    4.2%
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Est Yield
                                                                </td>
                                                                <td>
                                                                    4.2%
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="more">
                                            <a href="#">
                                                See more info <i class="fal fa-chevron-down"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="single-property">
                                        <h1 class="hero-title-dark sm-title">Flat 5, KensingtonCOurt, 8, Kemerton Road, Beckenham - BR3 ^NJ
                                            <select name="type" id="type" class="form-control">
                                                <option value="flat">12 Month Aug</option>
                                                <option value="flat">Sep</option>
                                            </select>
                                        </h1>
                                        <h3>£370,625 <small>Sold: Feb 19th 2020</small></h3>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <img src="assets/images/s-prop.png" class="w-100" alt="">
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p><i class="fas fa-bed"></i> 2 Bed <i class="fal fa-car"></i> 1 Car Park <i class="fal fa-bath"></i> 1 Bath</p>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <img src="assets/images/bar-chart.png" class="w-100" alt="">
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <table class="table table-striped">
                                                            <tr>
                                                                <td>
                                                                    £/sqft
                                                                </td>
                                                                <td>
                                                                    £394
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Est Rent
                                                                </td>
                                                                <td>
                                                                    4.2%
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Est Yield
                                                                </td>
                                                                <td>
                                                                    4.2%
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    £/sqft
                                                                </td>
                                                                <td>
                                                                    £394
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Est Rent
                                                                </td>
                                                                <td>
                                                                    4.2%
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Est Yield
                                                                </td>
                                                                <td>
                                                                    4.2%
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="more">
                                            <a href="#">
                                                See more info <i class="fal fa-chevron-down"></i>
                                            </a>
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
                    <div class="tab-pane fade" id="lno">
                        <div class="col-12">
                            <div class="rd-content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="search-bar">
                                            <div class="input-group">
                                                <input type="text" class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-default">Search</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-inline-flex align-items-center rd-filters">
                                    <select class="form-control" name="loc" id="loc">
                                        <option value="selected" selected disabled>Location</option>
                                        <option value="s">Any Location</option>
                                        <option value="1">Any Location</option>
                                        <option value="s2">Any Location</option>
                                        <option value="s3">Any Location</option>
                                    </select>
                                    <div class="d-inline-flex align-items-center">
                                        <select class="form-control" name="date" id="sdate">
                                            <option value="selected" selected disabled>Start Date</option>
                                            <option value="s">1 May</option>
                                            <option value="s">2 May</option>
                                            <option value="s">3 May</option>
                                            <option value="s">4 May</option>
                                        </select>
                                        <span>to</span>
                                        <select class="form-control" name="date" id="edate">
                                            <option value="selected" selected disabled>End Date</option>
                                            <option value="s">4 June</option>
                                            <option value="s">5 June</option>
                                            <option value="s">6 June</option>
                                            <option value="s">7 June</option>
                                        </select>
                                    </div>
                                    <select class="form-control" name="date" id="edate">
                                        <option value="selected" selected disabled>Property Filters</option>
                                        <option value="s">Filter 1</option>
                                        <option value="s">Filter 2</option>
                                        <option value="s">Filter 3</option>
                                    </select>
                                </div>
                                <div class="ownership-title">
                                    <div class="otitle">
                                        <h4>Beckenham BR3</h4>
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
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="search-bar">
                                            <div class="input-group">
                                                <input type="text" class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-default">Search</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-inline-flex align-items-center rd-filters">
                                    <select class="form-control" name="loc" id="loc">
                                        <option value="selected" selected disabled>Location</option>
                                        <option value="s">Any Location</option>
                                        <option value="1">Any Location</option>
                                        <option value="s2">Any Location</option>
                                        <option value="s3">Any Location</option>
                                    </select>
                                    <div class="d-inline-flex align-items-center">
                                        <select class="form-control" name="date" id="sdate">
                                            <option value="selected" selected disabled>Start Date</option>
                                            <option value="s">1 May</option>
                                            <option value="s">2 May</option>
                                            <option value="s">3 May</option>
                                            <option value="s">4 May</option>
                                        </select>
                                        <span>to</span>
                                        <select class="form-control" name="date" id="edate">
                                            <option value="selected" selected disabled>End Date</option>
                                            <option value="s">4 June</option>
                                            <option value="s">5 June</option>
                                            <option value="s">6 June</option>
                                            <option value="s">7 June</option>
                                        </select>
                                    </div>
                                    <select class="form-control" name="date" id="edate">
                                        <option value="selected" selected disabled>Property Filters</option>
                                        <option value="s">Filter 1</option>
                                        <option value="s">Filter 2</option>
                                        <option value="s">Filter 3</option>
                                    </select>
                                </div>
                                <div class="ownership-title">
                                    <div class="otitle">
                                        <h4>Beckenham BR3</h4>
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
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="search-bar">
                                            <div class="input-group">
                                                <input type="text" class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-default">Search</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-inline-flex align-items-center rd-filters">
                                    <select class="form-control" name="loc" id="loc">
                                        <option value="selected" selected disabled>Location</option>
                                        <option value="s">Any Location</option>
                                        <option value="1">Any Location</option>
                                        <option value="s2">Any Location</option>
                                        <option value="s3">Any Location</option>
                                    </select>
                                    <div class="d-inline-flex align-items-center">
                                        <select class="form-control" name="date" id="sdate">
                                            <option value="selected" selected disabled>Start Date</option>
                                            <option value="s">1 May</option>
                                            <option value="s">2 May</option>
                                            <option value="s">3 May</option>
                                            <option value="s">4 May</option>
                                        </select>
                                        <span>to</span>
                                        <select class="form-control" name="date" id="edate">
                                            <option value="selected" selected disabled>End Date</option>
                                            <option value="s">4 June</option>
                                            <option value="s">5 June</option>
                                            <option value="s">6 June</option>
                                            <option value="s">7 June</option>
                                        </select>
                                    </div>
                                    <select class="form-control" name="date" id="edate">
                                        <option value="selected" selected disabled>Property Filters</option>
                                        <option value="s">Filter 1</option>
                                        <option value="s">Filter 2</option>
                                        <option value="s">Filter 3</option>
                                    </select>
                                </div>
                                <div class="ownership-title">
                                    <div class="otitle">
                                        <h4>Beckenham BR3</h4>
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

            </div>
            <!-- Inner Content End-->
        </div>
        <!-- Right Wrapper End -->

    </div>


    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/custom.js"></script>


<?php include "footer.php"; ?>