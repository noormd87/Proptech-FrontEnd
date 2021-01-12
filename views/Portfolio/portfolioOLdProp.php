<?php include"header.php"; ?>

<?php
$user_id   = \settings\session\sessionClass::GetSessionDisplayName();


$currentCurrency     =  $_SESSION["BaseCurrency"];
$MultiPropertyVal    = $_REQUEST["MultiPropertyVal"] ? $_REQUEST["MultiPropertyVal"] : "";
$compareVal          = $_REQUEST["compareVal"] ? $_REQUEST["compareVal"] : "N";
$ViewCompare         = $_REQUEST["ViewCompare"] ? $_REQUEST["ViewCompare"] : "";
$IsSameCurr          = $_REQUEST["IsSameCurr"] ? $_REQUEST["IsSameCurr"] : "2";


?>

<!-- owl crousal -->
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/owl-crousal/css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/owl-crousal/css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/owl-crousal/css/owl.transitions.min.css">

<!-- apexchart -->  
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/css/apexcharts.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/css/apexcharts.min.css.map">

<form action="#" id="" class="" method="post" name='frm'>
  <!-- start row -->
  <div class="row">
    <div class="col-12">
      <div class="card">
          <div class="card-body">
              <div class="pull-left">
                <h4 class="card-title mb-0 mt-2">
                  Properties
                </h4>
              </div>
              <div class="pull-right">
               
                <?php
                
                    if($ViewCompare != "R"){
                ?>
                    <span id='compare'style='display:none;' class="btn btn-primary" onclick='compareFn()' >Compare</span>
                    <a class="btn btn-primary" href="<?php echo SITE_BASE_URL;?>Portfolio/ProtfolioPropDetails.html?IsProtFolio=Y">ADD NEW</a>
                <?php
                    }else
                    {
                 ?>      
                    <span style='display:none;' id='compareCurrency' class="btn btn-primary">
                        <label>Currency</label>
                        <select class="form-control-text" name='CurrencieVal' id='CurrencieVal' onchange='compareCurrencyFn()'>
                          <option value="2" <?php if($IsSameCurr == "2"){ ?> selected<?php } ?> >Global Comparison</option> 
                          <option value="1" <?php if($IsSameCurr == "1"){ ?> selected<?php } ?> >Country Comparison</option> 
                        </select>
                    </span>        
                    <span id='compare' class="btn btn-primary" onclick='compareBackFn()' >Back</span>    
                <?php      
                    }
                ?>
                <input type='hidden' name='MultiPropertyVal' id='MultiPropertyVal' value="<?php echo $MultiPropertyVal; ?>">
                <input type='hidden' name='compareVal' id='compareVal' value="<?php echo $compareVal; ?>">
                 <input type='hidden' name='ViewCompare' id='ViewCompare' value="<?php echo $ViewCompare; ?>">
                <input type='hidden' name='IsEligible' id='IsEligible' >
                
                
                
                <!-- <div class="dropdown custom-dropdown pull-right">MultiPropertyVal
                    <div data-toggle="dropdown">
                        <i class="ti-more-alt rotate-90 d-inline-block c-pointer"></i>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item f-s-12">Details</a>
                        <a href="save-property.php" class="dropdown-item f-s-12">Add New</a>
                        <a href="#" class="dropdown-item f-s-12">Refresh</a>
                    </div>
                </div> -->
              </div>
              <div class="clearfix"></div>
              
          </div>
      </div>          
    </div>
  </div>
  <?php
  
       if($ViewCompare == "R"){
           
           $HidePropertyList = " style='display:none;' ";
       }
   //$HidePropertyList ="";
   
   ?>


  <div class="row" <?php echo $HidePropertyList; ?> >
    <div class="col-12">
      <div class="mb-30">
        <ul id="lightSlider">
            
 <?php
 
 
 \Property\PropertyClass::Init();
$rows = \Property\PropertyClass::GetPropertyComparison("","","","",$ViewCompare);

//echo "<pre>"; print_r($rows); echo "</pre>";
//exit;

$i=1;
$TotalPropertyValue = 0;
$Totalrentperweek  = 0;
$TotalYieldroi  = 0;
$Totalportfoliogrowth = 0;
$TotalGrossIncome = 0;
$Totalweeklyrental = 0;

$PropReached = 1;

foreach ($rows as $row) 
{
    $ProprtyId  = $row["propertyid"];
    $autoid     = $row["autoid"];
    $Countryname = $row["country_name"];
    $countryid = $row["country_id"];
    
    
    $locationame = $row["location_name"] ?$row["location_name"] :"";
    $imagefile   = $row["image_file"] ? $row["image_file"] : "notupload";
    $income      = $row["income"] ? $row["income"] : "0";
    
    
     \ajax\ajaxClass::Init();
    $Prop           =  \ajax\ajaxClass::AnalyzerResult($autoid,"ARRAY");
    $GrossIncome        =  floatval($Prop[1]["GrossIncome"]);
    $MortgagePayment    =  floatval($Prop[1]["MortgagePayment"]);
    
   /* 
    echo "<pre>"; print_r($Prop); echo "</pre>";
    exit;
    
        SELECT `autoid`, `propertyid`, `userid`, `owneroccupier`, `secondhomeinvestment`, `audynamicprice`, `resident`, `residentinvestor`, `income`, `marketprice`, `duvaldynamicprice`, 
        `stampduty`, `leaseregistration`, `transferfees`, `mortgageregistration`, `landtransfer`, `legalfees`, `totalpurchasecost`, `resetrvationfees`, `stagepay1per`, `stagepay1amt`, 
        `stagepay2per`, `stagepay2amt`, `loanamountper`, `topup`, `weeklyrental`, `vacancyrate`, `lettingfeerate`, `managementfees`, `councilpropertytax`, `codycorporateservicechg`,
        `landleaserentpa`, `insurancepa`, `repairandmaintenance`, `cleaningpermonth`, `gardeningpermonth`, `servicecontractspa`, `other`, `ltv`, `initialloanamt`, `interestrate`, 
        `termyears`, `cpi`, `rentalgrowth`, `capitalgrowth`, `buildingvalue`, `buildinglife`, `fixturesvalue`, `fixtureslife`, `furniturevalue`, `furniturelife`, `country_id`, 
        `country_name`, `location_name`, `property_name`, `property_desc` FROM `property_analyzer_inputs` WHERE 1
    */
    
    $lettingfeerate    =  $row["lettingfeerate"] ? $row["lettingfeerate"] : "0"; 
    $managementfees    =  $row["managementfees"] ? $row["managementfees"] : "0"; 
    $councilpropertytax    =  $row["councilpropertytax"] ? $row["councilpropertytax"] : "0"; 
    $codycorporateservicechg    =  $row["codycorporateservicechg"] ? $row["codycorporateservicechg"] : "0"; 
    $landleaserentpa    =  $row["landleaserentpa"] ? $row["landleaserentpa"] : "0"; 
    $insurancepa    =  $row["insurancepa"] ? $row["insurancepa"] : "0"; 
    $repairandmaintenance    =  $row["repairandmaintenance"] ? $row["repairandmaintenance"] : "0"; 
    $cleaningpermonth    =  $row["cleaningpermonth"] ? $row["cleaningpermonth"] : "0"; 
    $gardeningpermonth    =  $row["gardeningpermonth"] ? $row["gardeningpermonth"] : "0"; 
    $servicecontractspa    =  $row["servicecontractspa"] ? $row["servicecontractspa"] : "0"; 
    $other          =  $row["other"] ? $row["other"] : "0"; 
    
     $fixturesvalue         =  $row["fixturesvalue"] ? $row["fixturesvalue"] : "0"; 
     $fixtureslife         =  $row["fixtureslife"] ? $row["fixtureslife"] : "0"; 
     $furniturevalue         =  $row["furniturevalue"] ? $row["furniturevalue"] : "0"; 
     $furniturelife         =  $row["furniturelife"] ? $row["furniturelife"] : "0"; 
     $weeklyrental         =  $row["weeklyrental"] ? $row["weeklyrental"] : "0"; 
     $capitalgrowth         =  $row["capitalgrowth"] ? $row["capitalgrowth"] : "0"; 
     
     
     $Totalweeklyrental     = floatval($Totalweeklyrental) + floatval($weeklyrental) ;
     
     $Totalportfoliogrowth = floatval($Totalportfoliogrowth) + floatval($capitalgrowth);
    
    
    //=(Inputs!$B$51)*(1/Inputs!$C$51)
    
    $TotalGrossIncome        = floatval($TotalGrossIncome)  + ($GrossIncome);
    
    $fixturesfitting    = @(floatval($fixturesvalue) * (1 / floatval($fixtureslife)));
    $funitures          = @(floatval($furniturevalue) * (1 / floatval($furniturelife)));
    
    $TotalPropertyValue = floatval($TotalPropertyValue)  + ($row["marketprice"] ? $row["marketprice"] : "0");
    
    
    $Annualexpensestemp = floatval($lettingfeerate)  + floatval($managementfees) + floatval($councilpropertytax) + floatval($codycorporateservicechg) + floatval($landleaserentpa) + floatval($insurancepa) 
                    + floatval($repairandmaintenance)   + floatval($cleaningpermonth) + floatval($gardeningpermonth) + floatval($servicecontractspa) + floatval($other);
                    
                    
    $Annualexpenses    = floatval($Annualexpensestemp) + floatval($MortgagePayment)   + floatval($fixturesfitting)  + floatval($funitures) ;
    
    $TotalAnnualexpenses =  floatval($TotalAnnualexpenses) +  floatval($Annualexpenses);
    
   
  // echo 'ProprtyId='.$ProprtyId;
 ?> 
  
<li>
      <div class="property-card" id="property001">
              <div class="property-card-body">
                <div class="select-box">
                  <div class="pull-left" >
                  <input type="checkbox" class="check property-check" checked name="PropertyChecked"  id="PropertyChecked<?php echo $i; ?>"  value='<?php echo $autoid; ?>'    > <!-- -->
                </div>
                <div class="pull-right">
                  <div class="dropdown custom-dropdown">
                      <div data-toggle="dropdown">
                          <i class="ti-more-alt rotate-90 d-inline-block c-pointer"></i>
                      </div>
                      <div class="dropdown-menu dropdown-menu-right">
                          
                           <?php 
                                if($ViewCompare != "R"){
                            ?>
                          
                            <a href="<?php echo SITE_BASE_URL;?>Property/PropertyFullDtl.html?id=<?php echo $ProprtyId;?>&countryid=<?php echo $countryid;?>&autoid=<?php echo $autoid;?>&IsProtFolio=Y&ViewCompare=<?php echo $ViewCompare; ?>" class="dropdown-item f-s-12">Edit</a>
                          <?php 
                                }
                            ?>
                              <a href="<?php echo SITE_BASE_URL;?>Property/PropertyFullDtl.html?id=<?php echo $ProprtyId;?>&countryid=<?php echo $countryid;?>&autoid=<?php echo $autoid;?>&IsProtFolio=Y&ViewCompare=<?php echo $ViewCompare; ?>" class="dropdown-item f-s-12">Edit</a>
                          
                          <a href="<?php echo SITE_BASE_URL;?>Property/PropertyDelete.html?id=<?php echo $ProprtyId;?>&countryid=<?php echo $countryid;?>&autoid=<?php echo $autoid;?>&IsProtFolio=Y&ViewCompare=<?php echo $ViewCompare; ?>" class="dropdown-item f-s-12">Delete</a>
                          <!--<a href="#" class="dropdown-item f-s-12">Delete</a>-->
                          <!--<a href="#" class="dropdown-item f-s-12">Analyse</a>-->
                      </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                </div>
                <div class="property-card-img">
                    
                    <?php
                    
                        if ( $imagefile == "notupload" ){
                            
                            $ImageSrc = SITE_BASE_URL ."assets/img/placeholder-img.png";
                        }else{
                            
                            $ImageSrc = SITE_BASE_URL ."uploads/portfolioimage/" .$imagefile;
                        }
                    
                           
                    ?>
                    
                    
                  <img src="<?php echo $ImageSrc;?>" class="img-responsive">
                </div>
                <div class="property-card-table">
                  <table class="table">
                    <tr>
                      <td>Country</td>
                      <td><?php echo  $Countryname; ?></td>
                    </tr>
                    <tr>
                      <td>Location</td>
                      <td><?php echo  $locationame; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
  </li>
  
<?php   

        if ($i > 3){
            
            $PropReached = 0;
            
        }


    $i++;
}


 $K = $i - 1 ;
 
 //echo 'K=' .$K. '<br>';

$PropCnt = 4 - $K;

// echo 'PropCnt=' .$PropCnt. '<br>';
 //echo '$PropReached=' .$PropReached. '<br>';


if ($PropReached == 1){
    
    for($j=1;$j<=$PropCnt;$j++){
        
        
    ?>
    
        <li>
          <div class="property-card" id="property001">
              <div class="property-card-body">
                <div class="select-box">
                  <div class="pull-left" >
                </div>
                <div class="pull-right">
                  <!--<div class="dropdown custom-dropdown">
                      <div data-toggle="dropdown">
                          <i class="ti-more-alt rotate-90 d-inline-block c-pointer"></i>
                      </div>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a href="#" class="dropdown-item f-s-12">Edit</a>
                          <a href="#" class="dropdown-item f-s-12">Delete</a>
                          <!--<a href="#" class="dropdown-item f-s-12">Analyse</a>--
                      </div>
                  </div>-->
                </div>
                <div class="clearfix"></div>
                </div>
                <div class="property-card-img">
                    
                    <?php
                    
                     $ImageSrc = SITE_BASE_URL ."assets/img/placeholder-img.png";
                           
                    ?>
                    
                    
                  <img src="<?php echo $ImageSrc;?>" class="img-responsive">
                </div>
                <div class="property-card-table">
                  <table class="table">
                    <tr>
                      <td>Country</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Location</td>
                      <td></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
        </li>
    
    <?php
        
    }
    
}

 ?>
</ul>
      </div>
    </div>
  </div>

    <!--<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Properties status</h4>
          <div class="row">
            <div class="col-lg-6">
                    <div class="card mb-0">
                        <div class="card-body p-0">
                            <img src="assets/img/avenue_prop_img_001.jpg" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-0">
                        <div class="card-body">
                            <h2 class="f-s-30 m-b-0">Avenues Apartment</h2>
                            <span class="f-w-600"> Project Completed</span>
                            <div class="row justify-content-between m-t-30">
                                <div class="col border-right-1">
                                    <p class="m-b-10 f-s-13">GDV</p>
                                    <h5 class="f-w-600">$65 M</h5>
                                </div>
                                <div class="col border-right-1">
                                    <p class="m-b-10 f-s-13">UNITS</p>
                                    <h5 class="f-w-600">119</h5>
                                </div>
                                <div class="col">
                                    <p class="m-b-10 f-s-13">COMPLETION</p>
                                    <h5 class="f-w-600">Complete</h5>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <h6 class="m-t-10 text-muted">Completion
                                    <span class="pull-right">100%</span>
                                </h6>
                                <div class="progress m-t-15 h-6px">
                                    <div role="progressbar" class="progress-bar bg-primary wow animated progress-animated w-100pc h-6px">
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
  </div>-->


  <!-- start  row -->
  <!-- <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
              <div class="card-body">
                  <div class="card-title">
                      <h4>Reports</h4>
                  </div>
                  <div class="chart-wrapper">
                      <div id="columnchart"></div>
                  </div>
              </div>
          </div>
      </div>
  </div> -->
  <!-- end row -->

<?php
//$compareVal = "N";
 if ( $compareVal == "Y" ){
?>
      <!-- start  row -->
    
      <div class="row"  >
          <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Investment Comparison</h4>
                    <div class="">
                      <table class="table table-bordered table-striped mb-0">
                          
                          <?php
                          
                            //echo $MultiPropertyVal;
                          
                             $TempArr = array();
                             \Property\PropertyClass::Init();
                            $PropertyComparison = \Property\PropertyClass::GetPropertyComparison("","",$MultiPropertyVal,"",$ViewCompare);
                            
                            $J = 1;
                            $PrevCountryId ="";
                            $IsSameCountry = "Y";
                            foreach($PropertyComparison as $PropCmp){
                                  $autoid                                   = $PropCmp["autoid"]           ? $PropCmp["autoid"] : "" ;
                                  $TempArr["UNIT_NO_".$J]                   = $PropCmp["UNIT_NO"]           ? $PropCmp["UNIT_NO"] : "" ;
                                  $TempArr["property_name_".$J]             = $PropCmp["property_name"]     ? $PropCmp["property_name"] : "" ;
                                  $TempArr["property_Address_".$J]          = $PropCmp["property_desc"]     ? $PropCmp["property_desc"] : "" ;
                                  $TempArr["location_name_".$J]             = $PropCmp["location_name"]     ? $PropCmp["location_name"] : "" ;
                                  $TempArr["country_name_".$J]              = $PropCmp["country_name"]      ? $PropCmp["country_name"] : "" ;
                                  $CountryId                                = $PropCmp["country_id"]        ? $PropCmp["country_id"] : "" ;
                                  $propertyid                               = $PropCmp["property_id"]        ? $PropCmp["property_id"] : "" ;
                                  
                                  
                                  $TempArr["country_id_".$J]                = $CountryId;
                                  
                                  if ( $PrevCountryId != ""){
                                      
                                      if ($PrevCountryId != $CountryId)
                                            $IsSameCountry= "N";
                                      
                                  }
                                  
                                  
                                  
                                  $currtemp                                 = $PropCmp["baseCur"]           ? $PropCmp["baseCur"] : "" ;
                                  $TempArr["baseCur_".$J]                   = $currtemp;
                                  $duvaldynamicprice                        = $PropCmp["duvaldynamicprice"] ? $PropCmp["duvaldynamicprice"] : "0" ;
                                  
                                  
                                  $DelUrl = "<a href='". SITE_BASE_URL ."Property/PropertyDelete.html?id=".$propertyid ."&countryid=". $CountryId ."&autoid=". $autoid ."&IsProtFolio=Y&ViewCompare=R'>Delete</a>";
                                  
                                  
                                  if($J==1)
                                    $propertydetails = "Property A ".$DelUrl;
                                  elseif($J==2)
                                   $propertydetails  = "Property B ".$DelUrl; 
                                  elseif($J==3)
                                   $propertydetails  = "Property C ".$DelUrl; 
                                  elseif($J==4)
                                   $propertydetails  = "Property D ".$DelUrl; 
                                  elseif($J==5)
                                   $propertydetails  = "Property E ".$DelUrl; 
                                  elseif($J==6)
                                   $propertydetails  = "Property F ".$DelUrl; 
                                  
                                  $TempArr["property_details_".$J]           = $propertydetails;
                                  
                                  //echo 'duvaldynamicprice='.$duvaldynamicprice;
                                  $TempArr["duvaldynamicprice_".$J]         = $duvaldynamicprice;
                                  $TempArr["PropertyList_".$J]              = $J;
                                  
                                  $stampdutyTemp                            = $PropCmp["stampduty"] ? $PropCmp["stampduty"] : "0" ;
                                  
                                  $mortgageregistrationTemp                 = $PropCmp["mortgageregistration"] ? $PropCmp["mortgageregistration"] : "0" ;
                                  
                                  if ( $mortgageregistrationTemp == "" || $mortgageregistrationTemp == "0")
                                        $mortgageregistrationTemp                 = $PropCmp["leaseregistration"] ? $PropCmp["leaseregistration"] : "0" ;
                                  
                                  
                                  
                                  $transferfeesTemp                         = $PropCmp["transferfees"] ? $PropCmp["transferfees"] : "0" ;
                                 
                                  
                                  if($IsSameCurr == "2") 
                                  {
                                      $UsdExRate = "";
                                      $UsdExRateArr =  \Property\PropertyClass::GetCurrExrate("USD",$currtemp);
                                      foreach($UsdExRateArr as $UsdEx){
                                          $UsdExRate = $UsdEx["RATE"] ? $UsdEx["RATE"] :"1";
                                      }
                                      
                                      if ($UsdExRate == "")
                                        $UsdExRate = 1;
                                        
                                      $MapCurrecncy = "$ USD";
                                    
                                  }else{
                                      $UsdExRate = 1;
                                      
                                        $ChkCntArr  = \DBConn\DBConnection::getQueryFetchColumn("(SELECT CURRENCY FROM country_master WHERE COUNTRY_CODE ='{$CountryId}')");
                                        $Currency   = $ChkCntArr["0"];
                                      
                                      
                                        $ChkSymbolArr   = \DBConn\DBConnection::getQueryFetchColumn("(SELECT Currency_Symbol FROM country_master WHERE COUNTRY_CODE ='{$CountryId}')");
                                        $CurrencySym    = $ChkSymbolArr["0"] ;
                                        
                                        if($CountryId == "3")
                                            $CurrencySym = "£";
                                      
                                      

                                        $MapCurrecncy = $CurrencySym ." ".$Currency;
                                  }  
                                  
                                  //echo $MapCurrecncy;
                                    
                                    
                                    
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
                                    // echo $autoid;
                                     
                                     /*
                                     if($autoid == "3")
                                           echo round($Prop[1]["NetCashFlowAfterTax"],0).",".round($Prop[2]["NetCashFlowAfterTax"],0).",".round($Prop[3]["NetCashFlowAfterTax"],0).","
                                                                                        .round($Prop[4]["NetCashFlowAfterTax"],0).",".round($Prop[5]["NetCashFlowAfterTax"],0).",".round($Prop[6]["NetCashFlowAfterTax"],0).",".round($Prop[7]["NetCashFlowAfterTax"],0)
                                                                                        .",".round($Prop[8]["NetCashFlowAfterTax"],0).",".round($Prop[9]["NetCashFlowAfterTax"],0).",".round($Prop[10]["NetCashFlowAfterTax"],0);
                                    
                                         */    
                                     
                                     
                                     
                                    
                                    $TempArr["NetCashFlowAfterTax_".$J]          =   round($Prop[1]["NetCashFlowAfterTax"] / floatval($UsdExRate),0) .",".round($Prop[2]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[3]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).","
                                                                                        .round($Prop[4]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[5]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[6]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[7]["NetCashFlowAfterTax"] / floatval($UsdExRate),0)
                                                                                        .",".round($Prop[8]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[9]["NetCashFlowAfterTax"] / floatval($UsdExRate),0).",".round($Prop[10]["NetCashFlowAfterTax"] / floatval($UsdExRate),0);
          
                                                                                        
                                                                                        
                                    $TempArr["TotalAnnualReturnAfterTax_".$J]           =   round($Prop[1]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[2]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[3]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).","
                                                                                        .round($Prop[4]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[5]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[6]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[7]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0)
                                                                                        .",".round($Prop[8]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[9]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0).",".round($Prop[10]["TotalAnnualReturnAfterTax"] / floatval($UsdExRate),0);
                                   
                                    $TempArr["Equity_".$J]                              =   round($Prop[1]["Equity"] / floatval($UsdExRate),0).",".round($Prop[2]["Equity"] / floatval($UsdExRate),0).",".round($Prop[3]["Equity"] / floatval($UsdExRate),0).",".round($Prop[4]["Equity"] / floatval($UsdExRate),0).",".round($Prop[5]["Equity"] / floatval($UsdExRate),0).",".round($Prop[6]["Equity"] / floatval($UsdExRate),0).
                                                                                            ",".round($Prop[7]["Equity"] / floatval($UsdExRate),0).",".round($Prop[8]["Equity"] / floatval($UsdExRate),0).",".round($Prop[9]["Equity"] / floatval($UsdExRate),0).",".round($Prop[10]["Equity"] / floatval($UsdExRate),0);
                                   
                                    
          
    
                     
                                  $PrevCountryId = $CountryId;
                                  
                                  $J++;
                            }
                            
                            if($IsSameCurr == "2") {
                                
                                $ExrateUsd = "(USD)";
                                
                            }else{
                                
                                $ExrateUsd = "";
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
                                        'Exchange Rate {$ExrateUsd}' as columns ,
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
                                           $feildname   = $Row["feildname"]; 
                                           $datatype    = $Row["datatype"]; 
                                           $Rateper     = $Row["Rateper"]; 
                                           
                                           for($k=1; $k < $J; $k++){
                                               
                                               
                                               if($Rateper == "Percentage"){
                                                   $Rateperval = "%";
                                               }else{
                                                   $Rateperval = "";
                                               }
                                               
                                               
                                               
                                               if ( $datatype == "format2"){
                                                    
                                                ?>  
                                                    <td><?php echo number_format($TempArr[$feildname.$k],2); echo $Rateperval; ?></td>
                                                <?php
                                                }elseif ( $datatype == "No"){
                                                    
                                                ?>  
                                                    <td><?php echo number_format($TempArr[$feildname.$k]); echo $Rateperval; ?></td>
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
                                <input type='hidden' name='IsSameCountry' id='IsSameCountry' value='<?php echo $IsSameCountry;  ?>' >
                                
                                
                      </table>
                    </div>
                  </div>
                </div>
                
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Annual Cashflow (after tax)</h4>
                    <canvas class="" id="annualCashFlow"></canvas>
                  </div>
                </div>
                
                
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Total Annual Return (after tax)</h4>
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
      
      <div class="float-button" >
    	 <button type="button" class="btn btn-float" id="save_pdf">SAVE PDF</button>
      </div>
  
  <?php
  
  }else{
      
       //$TotalPropertyValue,$TotalAnnualexpenses,$TotalGrossIncome
       
       //(Gross Income) / property value* x 100
       
       if ( floatval($TotalPropertyValue) > 0){
       
       $TotalYieldroi = floatval($TotalGrossIncome) /  ( floatval($TotalPropertyValue) / 100);
       
       }else{
           
          $TotalYieldroi = 0; 
       }
       
       $Totalrentperweek = floatval($Totalweeklyrental) * 53;
       
       $PropList = floatval($i)-1;
       
       if ( floatval($TotalPropertyValue) > 0){
       
         $Totalportfoliogrowth = floatval($Totalportfoliogrowth) / floatval($PropList);
       }else{
           
            $Totalportfoliogrowth = 0;
       }
  ?>
  
  
         <!-- start row -->
  <div class="row" >
    <div class="col-lg-3 no-card-border">
      <div class="card">
          <div class="card-body">
              <div class="m-t-15 text-center">
                  <h2 class="f-s-40 text-primary"><span id="property"><?php echo $i-1; ?></span></h2>
                  <p class="f-s-18">My Properties</p>
              </div>
              <canvas id="project-bar"></canvas> 
          </div>
      </div>
    </div>
    
    <div class="col-lg-3 no-card-border">
      <div class="card">
          <div class="card-body">
              <div class="m-t-15 text-center">
                  <h2 class="f-s-40 text-primary"><span id='TotalPropertyValue' ><?php echo number_format($TotalPropertyValue,0); ?></span></h2>
                  <p class="f-s-18">Property Value</p>
                  <input type='hidden' name='TotalPropertyValueHidden' id='TotalPropertyValueHidden' value='<?php echo $TotalPropertyValue; ?>' >
              </div>
              <canvas id="top-product"></canvas>
          </div>
      </div>
    </div>

    <div class="col-lg-3 no-card-border">
      <div class="card">
          <div class="card-body">
              <div class="m-t-15 text-center">
                  <h2 class="f-s-40 text-primary"><span id="TotalYieldroi"><?php echo round($TotalYieldroi); ?></span>%</h2> 
                  <p class="f-s-18">Yield / ROI</p>
                  <input type='hidden' name='Totalportfoliogrowth' id='Totalportfoliogrowth' value='<?php echo $Totalportfoliogrowth; ?>' >
              </div>

              <canvas id="expenses-graph"></canvas>
          </div>
      </div>
    </div>
    <div class="col-lg-3 no-card-border">
      <div class="card">
          <div class="card-body">
              <div class="m-t-15 text-center">
                  <h2 class="f-s-40 text-primary"><span id="Totalrentperweek"><?php echo number_format($Totalrentperweek,0); ?></span></h2>
                  <p class="f-s-18">Rent Annual</p>
              </div>

              <canvas id="btc-income"></canvas>
          </div>
      </div>
    </div>
  </div>
  <!-- end row -->

  <!-- start  row -->
  <!-- <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
              <div class="card-body">
                  <div class="card-title">
                      <h4>Reports</h4>
                  </div>
                  <div class="chart-wrapper">
                      <div id="columnchart"></div>
                  </div>
              </div>
          </div>
      </div>
  </div> -->
  <!-- end row -->


  <!-- start  row -->
  <div class="row"   > 
      <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
              <div class="card-body">
                  <h4 class="pull-left">10 Year Growth</h4>
                  <div class="dropdown custom-dropdown pull-right">
                      <div data-toggle="dropdown">
                          <i class="ti-more-alt rotate-90 d-inline-block c-pointer"></i>
                      </div>
                      <!--
                      <div class="dropdown-menu dropdown-menu-right">
                          <a href="#" class="dropdown-item f-s-12">10 Year Growth</a>
                          <a href="#" class="dropdown-item f-s-12">5 Year Growth</a>
                          <a href="#" class="dropdown-item f-s-12">Refresh</a>
                      </div>
                      -->
                  </div>
                  <div class="clearfix"></div>
                  <div class="chart-wrapper">
                      <div id="growthChart"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- end row -->

  <!-- start  row -->

  <div class="row"  >
      <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
              <div class="card-body">
                  <div class="card-title">
                      Completed Project's
                  </div> 
                  <div class="table-wrapper table-responsive">
                      <table class="table table-hover table-striped table-bordered data-table">
                          <thead>
                              <tr>
                                 <th>Name</th>
                                 <th>Country</th>
                                 <th>Unit Number</th>
                                 <th>Date bought</th>
                                 <th>Date Completion</th>
                                 <th>Price Paid </th>
                                 <th>Current Value</th>
                                 <th>Annual Rent</th>
                                 <th>Management Fee %</th>
                                 <th>Body Corporate Fee $</th>
                                 <th>Ground Rent $</th>
                                 <th>Other Costs $</th>
                                 <th>Gross Yield </th>
                                 <th>Net Yield</th>
                              </tr>
                          </thead>
                          <tbody>
                              
                              <?php
                                
                                 \Property\PropertyClass::Init();
                                $rows = \Property\PropertyClass::GetPropertyComparison("","","","CP",$ViewCompare);
                                
                                //echo "<pre>"; print_r($rows); echo "</pre>";
                                //exit;
                                foreach ($rows as $row) 
                                {
                                    $MyPortFolioName        = $row["property_name"] ?  $row["property_name"] : "";
                                    $Countryname            = $row["country_name"];
                                    $PropertyCountryCode    = $row["country_id"];
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
                                     
                                    
                                    
                                     \ajax\ajaxClass::Init();
                                    $Prop           =  \ajax\ajaxClass::AnalyzerResult($autoid,"ARRAY");
                                    $GrossIncome        =  floatval($Prop[1]["GrossIncome"]);
                                    $MortgagePayment    =  floatval($Prop[1]["MortgagePayment"]);
                                    $lettingfeerate    =  $row["lettingfeerate"] ? $row["lettingfeerate"] : "0"; 
                                    $managementfees    =  $row["managementfees"] ? $row["managementfees"] : "0"; 
                                    $councilpropertytax    =  $row["councilpropertytax"] ? $row["councilpropertytax"] : "0"; 
                                    $codycorporateservicechg    =  $row["codycorporateservicechg"] ? $row["codycorporateservicechg"] : "0"; 
                                    $landleaserentpa    =  $row["landleaserentpa"] ? $row["landleaserentpa"] : "0"; 
                                    $insurancepa    =  $row["insurancepa"] ? $row["insurancepa"] : "0"; 
                                    $repairandmaintenance    =  $row["repairandmaintenance"] ? $row["repairandmaintenance"] : "0"; 
                                    $cleaningpermonth    =  $row["cleaningpermonth"] ? $row["cleaningpermonth"] : "0"; 
                                    $gardeningpermonth    =  $row["gardeningpermonth"] ? $row["gardeningpermonth"] : "0"; 
                                    $servicecontractspa    =  $row["servicecontractspa"] ? $row["servicecontractspa"] : "0"; 
                                    $other          =  $row["other"] ? $row["other"] : "0"; 
                                    
                                     $fixturesvalue         =  $row["fixturesvalue"] ? $row["fixturesvalue"] : "0"; 
                                     $fixtureslife         =  $row["fixtureslife"] ? $row["fixtureslife"] : "0"; 
                                     $furniturevalue         =  $row["furniturevalue"] ? $row["furniturevalue"] : "0"; 
                                     $furniturelife         =  $row["furniturelife"] ? $row["furniturelife"] : "0"; 
                                     $weeklyrental         =  $row["weeklyrental"] ? $row["weeklyrental"] : "0"; 
                                     $capitalgrowth         =  $row["capitalgrowth"] ? $row["capitalgrowth"] : "0"; 
                                     
                                     
                                     

                                    
                                    $fixturesfitting    = @(floatval($fixturesvalue) * (1 / floatval($fixtureslife)));
                                    $funitures          = @(floatval($furniturevalue) * (1 / floatval($furniturelife)));
                                    
                                    $TotalPropertyValue = floatval($TotalPropertyValue)  + ($row["marketprice"] ? $row["marketprice"] : "0");
                                    
                                    
                                    $Annualexpensestemp = floatval($lettingfeerate)  + floatval($managementfees) + floatval($councilpropertytax) + floatval($codycorporateservicechg) + floatval($landleaserentpa) + floatval($insurancepa) 
                                                    + floatval($repairandmaintenance)   + floatval($cleaningpermonth) + floatval($gardeningpermonth) + floatval($servicecontractspa) + floatval($other);
                                                    
                                                    
                                    $Annualexpenses    = floatval($Annualexpensestemp) + floatval($MortgagePayment)   + floatval($fixturesfitting)  + floatval($funitures) ;
                                    

                                    $Grossrentalyield = round(floatval($GrossIncome) / floatval($CurrentValue) * 100) ;
                                    $Netrentalyield   = round(( floatval($Annualexpenses) - floatval($Annualexpenses) )   / floatval($CurrentValue) * 100) ;
                                    
                                 
                                    
                                   if ( $currentCurrency != "" ) {
                                  
                                        $managementfee              =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($managementfee,$PropertyCountryCode,$currentCurrency);
                                        $adminstrationfee           =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($adminstrationfee,$PropertyCountryCode,$currentCurrency);
                                        $propertymaintenance        =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($propertymaintenance,$PropertyCountryCode,$currentCurrency);
                                        $ratesvalue                 =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($ratesvalue,$PropertyCountryCode,$currentCurrency);
                                        $bodycorporatefee           =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($bodycorporatefee,$PropertyCountryCode,$currentCurrency);
                                        $rentperweek                =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($rentperweek,$PropertyCountryCode,$currentCurrency);
                                        //$propertyvaluecurrent       =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($propertyvaluecurrent,$PropertyCountryCode,$currentCurrency);
                                        
                                   }
                                   
                                   
                                    
                                    
                                 ?> 
                               
                                  <tr>
                                     <td align=left><?php echo $MyPortFolioName; ?></td>
                                     <td align=left><?php echo $Countryname; ?></td>
                                     <td align=left><?php echo $UnitNumber; ?></td>
                                     <td align=left><?php echo $DateBought; ?></td>
                                     <td align=left><?php echo $DateCompletion; ?></td>
                                     <td align=right><?php echo number_format($PricePaid,0); ?></td>
                                     <td align=right><?php echo number_format($CurrentValue,0); ?></td>
                                     <td align=right><?php echo number_format($TotalRentperweek,0); ?></td>
                                     <td align=right><?php echo number_format($managementfee,0); ?></td>
                                     <td align=right><?php echo number_format($adminstrationfee,0); ?></td>
                                     <td align=right><?php echo number_format($GroundRent,0); ?></td>
                                     <td align=right><?php echo number_format($OtherCosts,0); ?></td>
                                     <td align=right><?php echo $Grossrentalyield; ?></td>
                                     <td align=right><?php echo $Netrentalyield; ?></td>
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
  </div>
  
<!-- End  row -->
  
  <!-- start  row -->

  <div class="row" >
      <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
              <div class="card-body">
                  <div class="card-title">
                      Yet to Complete Project's
                  </div>
                  <div class="table-wrapper table-responsive">
                      <table class="table table-hover table-striped table-bordered data-table">
                          <thead>
                              <tr>
                                 <th>Name</th>
                                 <th>Country</th>
                                 <th>Unit Number</th>
                                 <th>Date bought</th>
                                 <th>Date Completion</th>
                                 <th>Price Paid </th>
                                 <th>Current Value</th>
                                 <th>Annual Rent</th>
                                 <th>Management Fee %</th>
                                 <th>Body Corporate Fee $</th>
                                 <th>Ground Rent $</th>
                                 <th>Other Costs $</th>
                                 <th>Gross Yield </th>
                                 <th>Net Yield</th>
                              </tr>
                          </thead>
                          <tbody>
                                <?php
                                
                                 \Property\PropertyClass::Init();
                                $rows = \Property\PropertyClass::GetPropertyComparison("","","","NP",$ViewCompare);
                                
                                //echo "<pre>"; print_r($rows); echo "</pre>";
                                //exit;
                                foreach ($rows as $row) 
                                {
                                    $MyPortFolioName        = $row["property_name"] ?  $row["property_name"] : "";
                                    $Countryname            = $row["country_name"];
                                    $PropertyCountryCode    = $row["country_id"];
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
                                    
                                    
                                    
                                     \ajax\ajaxClass::Init();
                                    $Prop           =  \ajax\ajaxClass::AnalyzerResult($autoid,"ARRAY");
                                    $GrossIncome        =  floatval($Prop[1]["GrossIncome"]);
                                    $MortgagePayment    =  floatval($Prop[1]["MortgagePayment"]);
                                    $lettingfeerate    =  $row["lettingfeerate"] ? $row["lettingfeerate"] : "0"; 
                                    $managementfees    =  $row["managementfees"] ? $row["managementfees"] : "0"; 
                                    $councilpropertytax    =  $row["councilpropertytax"] ? $row["councilpropertytax"] : "0"; 
                                    $codycorporateservicechg    =  $row["codycorporateservicechg"] ? $row["codycorporateservicechg"] : "0"; 
                                    $landleaserentpa    =  $row["landleaserentpa"] ? $row["landleaserentpa"] : "0"; 
                                    $insurancepa    =  $row["insurancepa"] ? $row["insurancepa"] : "0"; 
                                    $repairandmaintenance    =  $row["repairandmaintenance"] ? $row["repairandmaintenance"] : "0"; 
                                    $cleaningpermonth    =  $row["cleaningpermonth"] ? $row["cleaningpermonth"] : "0"; 
                                    $gardeningpermonth    =  $row["gardeningpermonth"] ? $row["gardeningpermonth"] : "0"; 
                                    $servicecontractspa    =  $row["servicecontractspa"] ? $row["servicecontractspa"] : "0"; 
                                    $other          =  $row["other"] ? $row["other"] : "0"; 
                                    
                                     $fixturesvalue         =  $row["fixturesvalue"] ? $row["fixturesvalue"] : "0"; 
                                     $fixtureslife         =  $row["fixtureslife"] ? $row["fixtureslife"] : "0"; 
                                     $furniturevalue         =  $row["furniturevalue"] ? $row["furniturevalue"] : "0"; 
                                     $furniturelife         =  $row["furniturelife"] ? $row["furniturelife"] : "0"; 
                                     $weeklyrental         =  $row["weeklyrental"] ? $row["weeklyrental"] : "0"; 
                                     $capitalgrowth         =  $row["capitalgrowth"] ? $row["capitalgrowth"] : "0"; 
                                     

                                    
                                    $fixturesfitting    = @(floatval($fixturesvalue) * (1 / floatval($fixtureslife)));
                                    $funitures          = @(floatval($furniturevalue) * (1 / floatval($furniturelife)));
                                    
                                    $TotalPropertyValue = floatval($TotalPropertyValue)  + ($row["marketprice"] ? $row["marketprice"] : "0");
                                    
                                    
                                    $Annualexpensestemp = floatval($lettingfeerate)  + floatval($managementfees) + floatval($councilpropertytax) + floatval($codycorporateservicechg) + floatval($landleaserentpa) + floatval($insurancepa) 
                                                    + floatval($repairandmaintenance)   + floatval($cleaningpermonth) + floatval($gardeningpermonth) + floatval($servicecontractspa) + floatval($other);
                                                    
                                                    
                                    $Annualexpenses    = floatval($Annualexpensestemp) + floatval($MortgagePayment)   + floatval($fixturesfitting)  + floatval($funitures) ;
                                    

                                    $Grossrentalyield = round(floatval($GrossIncome) / floatval($CurrentValue) * 100) ;
                                    $Netrentalyield   = round(( floatval($Annualexpenses) - floatval($Annualexpenses) )   / floatval($CurrentValue) * 100) ;
                                    
                                 
                                    
                                   if ( $currentCurrency != "" ) {
                                  
                                        $managementfee              =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($managementfee,$PropertyCountryCode,$currentCurrency);
                                        $adminstrationfee           =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($adminstrationfee,$PropertyCountryCode,$currentCurrency);
                                        $propertymaintenance        =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($propertymaintenance,$PropertyCountryCode,$currentCurrency);
                                        $ratesvalue                 =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($ratesvalue,$PropertyCountryCode,$currentCurrency);
                                        $bodycorporatefee           =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($bodycorporatefee,$PropertyCountryCode,$currentCurrency);
                                        $rentperweek                =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($rentperweek,$PropertyCountryCode,$currentCurrency);
                                        //$propertyvaluecurrent       =  \Portfolio\PortfolioClass::GetCurrecnyConverstion($propertyvaluecurrent,$PropertyCountryCode,$currentCurrency);
                                        
                                   }
                                   
                                    
                                 ?> 
                               
                                 <tr>
                                     <td align=left><?php echo $MyPortFolioName; ?></td>
                                     <td align=left><?php echo $Countryname; ?></td>
                                      <td align=left><?php echo $UnitNumber; ?></td>
                                     <td align=left><?php echo $DateBought; ?></td>
                                     <td align=left><?php echo $DateCompletion; ?></td>
                                      <td align=right><?php echo number_format($PricePaid,0); ?></td>
                                     <td align=right><?php echo number_format($CurrentValue,0); ?></td>
                                     <td align=right><?php echo number_format($TotalRentperweek,0); ?></td>
                                     <td align=right><?php echo number_format($managementfee,0); ?></td>
                                     <td align=right><?php echo number_format($adminstrationfee,0); ?></td>
                                     <td align=right><?php echo number_format($GroundRent,0); ?></td>
                                     <td align=right><?php echo number_format($OtherCosts,0); ?></td>
                                     <td align=right><?php echo $Grossrentalyield; ?></td>
                                     <td align=right><?php echo $Netrentalyield; ?></td>
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
  </div>
 <!-- End  row -->
   
  <?php   
  }
  
  ?>
 <!-- End  row -->
  
</form>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css">

<?php include"footer.php"; ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>

<!-- apexchart -->
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/js/apexcharts.min.js"></script>

<script type="text/javascript">


function GetCurrencyConvert(number){
    
    if (number == "" || number == undefined)
        number = 0
    
  return   new Intl.NumberFormat().format(number)
}

function compareFn(){
    
    //var MultiPropertyVal    = $("#MultiPropertyVal").val();
   var IsEligible          = $("#IsEligible").val();
   
   if ( IsEligible == "N"){
       
       alert("More than 4 Property is not Eligible to Compare");
       return false;
   }
    
    document.frm.action='<?php echo SITE_BASE_URL;?>Portfolio/Portfolio.html';
    document.frm.submit();
    
    //alert();
    
}

function compareBackFn(){
    
    document.frm.action='<?php echo SITE_BASE_URL;?>Portfolio/ProtfolioPropDetails.html?RecentAnalyse=Y';
    document.frm.submit();
    
}
function compareCurrencyFn(){
    
    var CurrencieVal = $("#CurrencieVal").val();
    
    document.frm.action='<?php echo SITE_BASE_URL;?>Portfolio/Portfolio.html?ViewCompare=R&IsEligible=Y&compareVal=Y&IsSameCurr='+CurrencieVal;
    document.frm.submit();
    
   
}



  
 $(document).ready(function() {
  
     var id = "<?php echo $user_id; ?>" ;
     
     IsSameCountryFn();
     
     //console.log('UserId='+UserId)
   
         
    var PropertyCheckedFn = function(){
   
    //function PropertyCheckedFn(){
         
        var MultiPropertyVal="";
    	var MultiPropertyId = document.getElementsByName("PropertyChecked");
    	k=0;
    	for(i=0;i<=MultiPropertyId.length-1;i++){ 
    
    		if(MultiPropertyId[i].checked == true){
    		    
    		    if ( MultiPropertyVal == ""){
    		        MultiPropertyVal =  MultiPropertyId[i].value ;
    		        $("#compare").hide();
    		        $("#compareVal").val("N");
    		        $("#MultiPropertyVal").val(MultiPropertyVal);
    		    }else{
    		        MultiPropertyVal = MultiPropertyVal + "," + MultiPropertyId[i].value ;
    		        $("#compare").show();
    		        $("#compareVal").val("Y");
    		       $("#MultiPropertyVal").val(MultiPropertyVal);
    		    } 
    			k++;
    		}	
    		//alert(MultiPropertyVal);
    		//alert(i);

    		
    	} 
    	
    	
    	if (parseFloat(k) > 4){
    	    
    	     $("#IsEligible").val("N");
    	}
    	
    	  var IsEligible =   $("#IsEligible").val();
    	  
    	  if(IsEligible=="")
    	    IsEligible = "N";
 
          if(IsEligible == "N"){
           PropertyCheckedNewFn();
          }
     }
     
     
     var PropertyCheckedNewFn = function(){
   
    //function PropertyCheckedFn(){
    
  
        var MultiPropertyVal="";
    	var MultiPropertyId = document.getElementsByName("PropertyChecked");
    	
    	//alert("MultiPropertyVal="+MultiPropertyId.length);
    	for(i=0;i<=MultiPropertyId.length-1;i++){ 
    
    		if(MultiPropertyId[i].checked == true){
    		    
    		    if ( MultiPropertyVal == ""){
    		        MultiPropertyVal =  MultiPropertyId[i].value ;
    		    }else{
    		        MultiPropertyVal = MultiPropertyVal + "," + MultiPropertyId[i].value ;
    		    } 
    			
    		}	
    		
    	} 
    	//alert("MultiPropertyVal="+MultiPropertyVal);
    	//console.log('MultiPropertyVal='+MultiPropertyVal)
    	//console.log('id='+id)
    	
    	
    
    	
    	if ( MultiPropertyVal != "" ) {
    	    
    	    var testdata = {
                "propertyid"   : MultiPropertyVal,
                "id"           : id
            };
            
 
            $.ajax({               
                url: "https://duvalknowledge.com/PropTech/Portfolio/PropertyGetDetails.html",
                 type: "POST",
                 dataType : "json",
                 data:testdata,
                success : function(data){
                    // console.log(data.length);
                    $.each(data, function(index, value){  
                      $("#property").html(GetCurrencyConvert(value.Property));
                        $("#TotalPropertyValue").html(GetCurrencyConvert(value.propertyValue));
                        $("#TotalYieldroi").html(GetCurrencyConvert(value.Yeildroi));
                        $("#Totalrentperweek").html(GetCurrencyConvert(value.rentannual));
                        $("#Totalportfoliogrowth").html(GetCurrencyConvert(value.Portfoliogrowth));
                        $("#TotalPropertyValueHidden").val(value.propertyValue);
                        
                        PropertyChartFn();
                        
                        
                    });
                }
             }); 
    	    
    	}else{
    	        
    	         $("#property").html(0);
                $("#TotalPropertyValue").html(0);
                $("#TotalYieldroi").html(0);
                $("#Totalrentperweek").html(0);
                $("#Totalportfoliogrowth").html(0);
                $("#TotalPropertyValueHidden").val(0);
                
    	    
    	        PropertyChartFn();
    	        
    	}
    	
        

           
     }
     

      
    $('#lightSlider').lightSlider({
        item:4,
        loop:false,
        slideMove:2,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed:600,
        responsive : [
            {
                breakpoint:800,
                settings: {
                    item:3,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:480,
                settings: {
                    item:2,
                    slideMove:1
                  }
            }
        ]
    });

  
    if ($(".property-card-body input:checkbox:checked").length > 0)
      {
         //alert("hii");
        $('.icheckbox_square-blue').css('opacity','1');
         PropertyCheckedFn();
      }
      else
      {
        //alert("hii1");
        $('.icheckbox_square-blue').css('opacity','0');
        PropertyCheckedFn();
      }
    
   /* 
   $(document).on("click", ".property-card-body [type='checkbox']", function(){
        alert();     
    });
    */
    
    $('.property-card-body').click(function ()
    
    {
          //alert("hii5");
        
          $(this).find('input[type=checkbox]').prop("checked", !$(this).find('input[type=checkbox]').prop("checked"));
    
          $('.property-check').iCheck('update').checked;
    
          if ($(".property-card-body input:checkbox:checked").length > 0)
          {
             //alert("hii3");
            $('.icheckbox_square-blue').css('opacity','1');
            PropertyCheckedFn();
          }
          else
          {
            //alert("hii4");
            $('.icheckbox_square-blue').css('opacity','0');
           PropertyCheckedFn();
          }
          
           

    });
    
    PropertyChartFn(true);
});

 var FnNulltoEmpty = function(Value){
        
        if (Value == undefined)
            Value = "";
   
        return Value;
   
    };


var IsSameCountryFn = function(){
    
    //alert("enter");
    
    var IsSameCountry = FnNulltoEmpty($("#IsSameCountry").val());
    
    //alert(IsSameCountry);
    
    if (IsSameCountry == "")
        IsSameCountry = "N";
        
        
     if(IsSameCountry == "Y")  {
         
         $("#compareCurrency").show();
         
     }
    
    
    
    
};

 var PropertyChartFn = function(isload){  
        
        if ( isload == undefined)
            isload = false;
  
        var propval             = $("#TotalPropertyValueHidden").val();
        var portfoliogrowth     = $("#Totalportfoliogrowth").val();
        var portfoliogrowthtemp = parseFloat(portfoliogrowth) / 100;
        
        
        
         
        for( i=1; i <=10; i++){
    
            if ( i == 1 ){
               
                TotalValSer = propval;
                 Year =i ;
            }else{
                
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
        },
        stroke: {
            width: 7,   
            curve: 'smooth'
        },
        series: [{
            name: 'Growth Rate',
            data: TotalValSer
        }],
        xaxis: {
            type: '10 Years Growth',
            categories: Year,
             title: {

				text: '10 Years Growth'
             }
        },
        yaxis: {
            type: 'Property Rate',
             title: {

				text: 'Property Rate'
             }
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
        
        if (!isload) {
            $("#growthChart").html("");
        }
        
        var chart = new ApexCharts(
            document.querySelector("#growthChart"),
            options
        );
        
        chart.render();
        
    }
    
</script>


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
        datasets: eval("[" + PropertySting + "]")
    },
    options: {
        responsive: true,
        legend: {
            display: true,
            labels: {
                usePointStyle: false,
            },
        },
        tooltips: {
          mode: 'index',
          intersect: false,
          beginAtZero: true,
          callbacks: {
                label: function(tooltipItem, data) {
                    return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                },
            },
          },

       hover: {
          mode: 'nearest',
          intersect: true,
           callbacks: {
              label: function(tooltipItem, data) {
                  return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              },
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
                    labelString: '<?php echo $MapCurrecncy; ?>',
                },
                ticks: {
                    beginAtZero: true,
                    userCallback: function(value, index, values) {
                        value = value.toString();
                        value = value.split(/(?=(?:...)*$)/);
                        value = value.join(',');
                        return value;
                    }
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
           legend: {
               display: true,
               labels: {
                   usePointStyle: false,
               },
   
   
           },
           tooltips: {
              mode: 'index',
              intersect: false,
              beginAtZero: true,
              callbacks: {
                label: function(tooltipItem, data) {
                    return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                },
            },
          },
           hover: {
              mode: 'nearest',
              intersect: true,
               callbacks: {
                  label: function(tooltipItem, data) {
                      return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                  },
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
                           labelString: '<?php echo $MapCurrecncy; ?>',
                       },
                       ticks: {
    beginAtZero:true,
    userCallback: function(value, index, values) {
        value = value.toString();
        value = value.split(/(?=(?:...)*$)/);
        value = value.join(',');
        return value;
    }
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
           legend: {
               display: true,
               labels: {
                   usePointStyle: false,
               },
   
   
           },
            tooltips: {
              mode: 'index',
              intersect: false,
              beginAtZero: true,
              callbacks: {
                label: function(tooltipItem, data) {
                    return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                },
            },
          },
           hover: {
              mode: 'nearest',
              intersect: true,
               callbacks: {
                  label: function(tooltipItem, data) {
                      return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                  },
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
                           labelString: '<?php echo $MapCurrecncy; ?>',
                       },
                       ticks: {
    beginAtZero:true,
    userCallback: function(value, index, values) {
        value = value.toString();
        value = value.split(/(?=(?:...)*$)/);
        value = value.join(',');
        return value;
    }
}
               }]
           },
           title: {
               display: false,
           }
       }
   });


    
</script>


<!-- owl crousal -->
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/owl-crousal/js/owl.carousel.min.js"></script>



<script src="<?php echo SITE_BASE_URL;?>assets/plugins/chartjs/Chart.bundle.js"></script>
<script type="text/javascript">
  // Project Bar

    var ctx = document.getElementById("project-bar");
    ctx.height = 100;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB",],
            datasets: [{
                label: '',
                data: [5, 6, 4.5, 5.5, 3, 6, 4.5, 6, 8, 3, 5.5, 4, 6, 9, 12, 4, 3, 6, 4.5, 6, 8, 4.5, 5, 6, 4.5, 5.5,],
                backgroundColor: '#4c84ff',
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        drawBorder: false,
                        display: false
                    },
                    ticks: {
                        display: false, // hide main x-axis line
                        beginAtZero: true
                    },
                    barPercentage: 1,
                    categoryPercentage: 0.2
                }],
                yAxes: [{
                    gridLines: {
                        drawBorder: false, // hide main y-axis line
                        display: false
                    },
                    ticks: {
                        display: false,
                        beginAtZero: true
                    },
                }]
            },
            tooltips: {
                enabled: false
            }
        }
    });



    //Expenses Graph
    var ctx = document.getElementById("top-product");
    ctx.height = 100;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
            type: 'line',

            datasets: [{
                label: "My First dataset",
                data: [28, 35, 54, 38, 26, 62, 50],
                backgroundColor: "rgba(108, 52, 131,0.35)",
                borderColor: "#5B2C6F",
                borderWidth: 3,
                strokeColor: "#FF4961",
                capBezierPoints: !0,
                pointColor: "#fff",
                pointBorderColor: "#C39BD3",
                pointBackgroundColor: "#FFF",
                pointBorderWidth: 3,
                pointRadius: 5,
                pointHoverBackgroundColor: "#FFF",
                pointHoverBorderColor: "#FF4961",
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            tooltips: {
                enabled: false,
            },
            legend: {
                display: false,
                position: 'top',
                labels: {
                    usePointStyle: true,

                },


            },
            scales: {
                xAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: '$ USD'
                    }
                }]
            },
            title: {
                display: false,
            }
        }
    });


    var ctx = document.getElementById("expenses-graph");
    ctx.height = 100;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
            type: 'line',

            datasets: [{
                label: "My First dataset",
                data: [32, 45, 36, 48, 46, 42, 55],
                backgroundColor: "rgba(133,133,255,0.35)",
                borderColor: "#EC7063",
                borderWidth: 3,
                strokeColor: "#FF4961",
                capBezierPoints: !0,
                pointColor: "#fff",
                pointBorderColor: "#EC7063",
                pointBackgroundColor: "#FFF",
                pointBorderWidth: 3,
                pointRadius: 5,
                pointHoverBackgroundColor: "#FFF",
                pointHoverBorderColor: "#FF4961",
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            tooltips: {
                enabled: false,
            },
            legend: {
                display: false,
                position: 'top',
                labels: {
                    usePointStyle: true,

                },


            },
            scales: {
                xAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: '$ USD'
                    }
                }]
            },
            title: {
                display: false,
            }
        }
    });


    var ctx = document.getElementById("btc-income");
    ctx.height = 100;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
            type: 'line',

            datasets: [{
                label: "My First dataset",
                data: [28, 35, 36, 48, 46, 42, 60],
                backgroundColor: "rgba(133,133,255,0.35)",
                borderColor: "#5B2C6F",
                borderWidth: 3,
                strokeColor: "#FF4961",
                capBezierPoints: !0,
                pointColor: "#fff",
                pointBorderColor: "#FF4961",
                pointBackgroundColor: "#FFF",
                pointBorderWidth: 3,
                pointRadius: 5,
                pointHoverBackgroundColor: "#FFF",
                pointHoverBorderColor: "#FF4961",
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            tooltips: {
                enabled: false,
            },
            legend: {
                display: false,
                position: 'top',
                labels: {
                    usePointStyle: true,

                },


            },
            scales: {
                xAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: '$ USD'
                    }
                }]
            },
            title: {
                display: false,
            }
        }
    });

  
</script>

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
         window.location.href = "<?php echo SITE_BASE_URL . "Portfolio/Portfolio.html??ViewCompare=R&IsEligible=Y&compareVal=Y"; ?>"; //save_pdf 
         
     }
     
       
 </script>


