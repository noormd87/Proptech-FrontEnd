<?php include "header.php";
\login\loginClass::Init();
$checkSession = \login\loginClass::CheckUserSessionIp();
?>
<?php
\Property\PropertyClass::Init();
$countryId = isset($_REQUEST["country"]) ? $_REQUEST["country"] : "";
 
$countryNameArr              			= \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_NAME FROM country_master WHERE `COUNTRY_CODE` ='" .$countryId."')");
$countryName            				= $countryNameArr["0"];
//echo $countryName ;

//country_map_url

$rows = \Property\PropertyClass::getCountryDatas($countryId,'');
foreach ($rows as $row) 
{
    
    $countryName = $row["COUNTRY_NAME"];
    $CountryUrl  = $row["country_map_url"];
    $CountryLat  = $row["Country_Lat"];
    $CountryLng  = $row["Country_Lng"];

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


$datasource     = isset($_REQUEST["datasource"]) ? $_REQUEST["datasource"] : "PriPaid";
$BuildType      = isset($_REQUEST["BuildType"]) ? $_REQUEST["BuildType"] : "STANDARD";
$propertyType   = isset($_REQUEST["propertyType"]) ? $_REQUEST["propertyType"] : "A";
$bedrooms       = isset($_REQUEST["bedrooms"]) ? $_REQUEST["bedrooms"] : "-1";


//echo "datasource=" .$datasource;
//echo "BuildType=" .$BuildType;
//echo "propertyType=" .$propertyType;
//echo "bedrooms=" .$bedrooms;

?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- apexchart -->  
<link rel="stylesheet" type="text/css" href="assets/plugins/apexcharts/css/apexcharts.min.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/apexcharts/css/apexcharts.min.css.map">
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
    </style>
<!-- main content -->
<div class="content">
    <!-- Added by Yasir for suggestions (Start) -->
    <form name="frmSearch" id="frmSearch" method="post" action="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=<?php echo $countryId; ?>">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
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
                    <input class="form-control" type="text" name="Subrub" id="Suburb" placeholder="Subrub" value="<?php echo $Subrub;?>" />
                    <input class="form-control" type="hidden" name="LocationId" id="LocationId" placeholder="LocationId" value="<?php echo $LocationId;?>" >
                    <input class="form-control" type="hidden" name="myportfoliocountry" id="myportfoliocountry"  value="<?php echo $Propcountrycode;?>" >
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <input class="form-control" type="text" name="Street" id="Street" placeholder="Street"  value="<?php echo $Street;?>" >
                      <input class="form-control" type="hidden" name="StreetId" id="StreetId" placeholder="StreetId"  value="<?php echo $StreetId;?>" >
                      <input class="form-control" type="hidden" name="stateId" id="stateId" placeholder="stateId"  value="<?php echo $stateId;?>" >
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <input class="form-control" type="text" name="Zipcode" id="Zipcode" placeholder="Zip Code" value="<?php echo $Zipcode;?>" >
                      <input class="form-control" type="hidden" name="ZipcodeId" id="ZipcodeId" placeholder="ZipcodeId" value="<?php echo $ZipcodeId;?>" >
              </div>
            </div>
          </div>
          
          <!---------------------------------- Arzath 2020-05-30 ------------------------------------------>
          <?php
          if($LocationId != "" && $countryId == "UK"){
          ?>
          <div class="row">
               <div class="col-lg-12">
                  <div class="card filter-card">
                     <div class="card-body">
                     <!--
                      <select class="custom-form-control" name="">
                        <option value="">Location</option>
                        <option value="">New Zealand</option>
                        <option value="">New Zealand</option>
                        <option value="">New Zealand</option>
                        <option value="">New Zealand</option> 
                      </select>
                      -->
                      <input class="custom-form-control" type="text" name="datefilter" value="01/01/2018 - 01/15/2018" />
                      <div class="dropdown-group">
                        <div class="dropdown">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Price Paid
                          </button>
                          <div class="dropdown-menu filter-box">
                            <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="pills-transactional-tab" data-toggle="pill" href="#pills-transactional" role="tab" aria-controls="pills-transactional" aria-selected="true">Transactional</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="pills-property-tab" data-toggle="pill" href="#pills-property" role="tab" aria-controls="pills-property" aria-selected="false">Property Specific</a>
                              </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                              <div class="tab-pane fade show active" id="pills-transactional" role="tabpanel" aria-labelledby="pills-transactional-tab">
                                <div class="filter-box-inner">
                                  <div class="row">
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='Discnt' <?php if ($datasource == "Discnt" ) { ?> checked <?php }?> class="icheckRadio">
                                      <label>Discount</label>
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='GrsYld' <?php if ($datasource == "GrsYld" ) { ?> checked <?php }?> class="icheckRadio">
                                      <label>Gross Yield</label>
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='PriAsk' <?php if ($datasource == "PriAsk" ) { ?> checked <?php }?> class="icheckRadio">
                                      <label>Price Asked</label>
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='RentAsk' <?php if ($datasource == "RentAsk" ) { ?> checked <?php }?> class="icheckRadio">
                                      <label>Rent Asking</label>
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='sqfiRent'  <?php if ($datasource == "sqfiRent" ) { ?> checked <?php }?> class="icheckRadio">
                                      <label>$/sqfi - Rent</label>
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='sqfiSales' <?php if ($datasource == "sqfiSales" ) { ?> checked <?php }?>  class="icheckRadio">
                                      <label>$/sqfi - Sales</label>
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='PriPaid' <?php if ($datasource == "PriPaid" ) { ?> checked <?php }?> class="icheckRadio">
                                      <label>Price Paid</label>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="">Build Type</label>
                                    <div class="btn-block-group btn-group">
                                      <input type="radio" name="BuildType" value='STANDARD' <?php if ($BuildType == "STANDARD" ) { ?> checked <?php }?>  class="icheckBtn">
                                      <label>All</label>
            
                                      <input type="radio" name="BuildType" value='SECONDARY' <?php if ($BuildType == "SECONDARY" ) { ?> checked <?php }?> class="icheckBtn">
                                        <label>Secondary</label>
            
                                        <input type="radio" name="BuildType" value='NEW_BUILD'  <?php if ($BuildType == "NEW_BUILD" ) { ?> checked <?php }?> class="icheckBtn">
                                        <label>New Built</label>
                                      <div class="icheck-group">
                                      </div>
                                      <div class="icheck-group">
                                      </div>
                                      <div class="icheck-group">
                                        
                                      </div>
                                    </div>
                                  </div>
            
                                  <div class="form-group">
                                    <label for="">Property Type</label>
                                    <div class="btn-block-group btn-group">
                                      <input type="radio" name="propertyType" value='A'  <?php if ($propertyType == "A" ) { ?> checked <?php } ?>  class="icheckBtn">
                                      <label>Meidan</label>
            
                                      <input type="radio" name="propertyType" value='F' <?php if ($propertyType == "F" ) { ?> checked <?php } ?> class="icheckBtn">
                                        <label>Flat</label>
            
                                        <input type="radio" name="propertyType"  value='S' <?php if ($propertyType == "S" ) { ?> checked <?php } ?>  class="icheckBtn">
                                        <label>Semi</label>
            
                                        <input type="radio" name="propertyType" value='D' <?php if ($propertyType == "D" ) { ?> checked <?php } ?> class="icheckBtn">
                                        <label>Detached</label>
            
                                        <input type="radio" name="propertyType" value='T' <?php if ($propertyType == "T" ) { ?> checked <?php } ?> class="icheckBtn">
                                        <label>Terraced</label>
                                      <div class="icheck-group">
                                        
                                      </div>
                                      <div class="icheck-group">
                                        
                                      </div>
                                      <div class="icheck-group">
                                        
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="">Number of rooms</label>
                                    <select name="bedrooms" class="form-control">
                                      <option value="-1" <?php if ($bedrooms == "-1" ) { ?> selected <?php } ?> >ALL</option>
                                      <option value="1"  <?php if ($bedrooms == "1" ) { ?> selected <?php } ?> >1</option>
                                      <option value="2"  <?php if ($bedrooms == "2" ) { ?> selected <?php } ?> >2</option>
                                      <option value="3"  <?php if ($bedrooms == "3" ) { ?> selected <?php } ?> >3</option>
                                      <option value="4"  <?php if ($bedrooms == "4" ) { ?> selected <?php } ?> >4</option>
                                      <option value="5"  <?php if ($bedrooms == "5" ) { ?> selected <?php } ?>>5</option>
                                    </select>
                                  </div>
                                  
                                  <hr>
            
                                  <div class="row">
                                    <div class="col text-left">
                                      <button class="btn btn-default" id="Remove1" name="Remove" type="button">Remove</button>
                                    </div>
                                    <div class="col text-right">
                                      <button class="btn btn-success" id="Apply1" name="Apply"  type="button">Apply</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="pills-property" role="tabpanel" aria-labelledby="pills-property-tab">
                                <div class="filter-box-inner">
                                  <div class="row">
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='DaysMarRent' <?php if ($datasource == "DaysMarRent" ) { ?> checked <?php }?>  class="icheckRadio">
                                      <label>Days on Market - Rent</label>
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='PropSize' <?php if ($datasource == "PropSize" ) { ?> checked <?php }?> class="icheckRadio">
                                      <label>Property Size</label>
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='DaysMarSales' <?php if ($datasource == "DaysMarSales" ) { ?> checked <?php }?>  class="icheckRadio">
                                      <label>Days on Market - Sales</label>
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='RentList' <?php if ($datasource == "RentList" ) { ?> checked <?php }?> class="icheckRadio">
                                      <label>Rent Listing</label>
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='NewRentList' <?php if ($datasource == "NewRentList" ) { ?> checked <?php }?> class="icheckRadio">
                                      <label>New Rent Listing</label>
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='SalesList' <?php if ($datasource == "SalesList" ) { ?> checked <?php }?> class="icheckRadio">
                                      <label>Sales Listing</label>
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='NewSalesList' <?php if ($datasource == "NewSalesList" ) { ?> checked <?php }?>   class="icheckRadio">
                                      <label>New Sales Listing</label>
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="radio" name="datasource" value='SalesTrans' <?php if ($datasource == "SalesTrans" ) { ?> checked <?php }?>  class="icheckRadio">
                                      <label>Sales Transactions</label>
                                    </div>
                                  </div>
                                  <!--
                                  <div class="form-group">
                                    <label for="">Build Type</label>
                                    <div class="btn-block-group btn-group">
            
                                      <input type="radio" name="BuildType" value='STANDARD' <?php if ($BuildType == "STANDARD" ) { ?> checked <?php }?>  class="icheckBtn">
                                      <label>All</label>
            
                                      <input type="radio" name="BuildType" value='SECONDARY' <?php if ($BuildType == "SECONDARY" ) { ?> checked <?php }?> class="icheckBtn">
                                        <label>Secondary</label>
            
                                        <input type="radio" name="BuildType" value='NEW_BUILD'  <?php if ($BuildType == "NEW_BUILD" ) { ?> checked <?php }?> class="icheckBtn">
                                        <label>New Built</label>
                                      <div class="icheck-group">
                                        
                                      </div>
                                      <div class="icheck-group">
                                        
                                      </div>
                                      <div class="icheck-group">
                                        
                                      </div>
                                    </div>
                                  </div>
                                
                                  <div class="form-group">
                                    <label for="">Property Type</label>
                                    <div class="btn-block-group btn-group">
                                      <input type="radio" name="propertyType" value='A'  <?php if ($propertyType == "A" ) { ?> checked <?php } ?>  class="icheckBtn">
                                      <label>Meidan</label>
            
                                      <input type="radio" name="propertyType" value='F' <?php if ($propertyType == "F" ) { ?> checked <?php } ?> class="icheckBtn">
                                        <label>Flat</label>
            
                                        <input type="radio" name="propertyType"  value='S' <?php if ($propertyType == "S" ) { ?> checked <?php } ?>  class="icheckBtn">
                                        <label>Semi</label>
            
                                        <input type="radio" name="propertyType" value='D' <?php if ($propertyType == "D" ) { ?> checked <?php } ?> class="icheckBtn">
                                        <label>Detached</label>
            
                                        <input type="radio" name="propertyType" value='T' <?php if ($propertyType == "T" ) { ?> checked <?php } ?> class="icheckBtn">
                                        <label>Terraced</label>
                                      <div class="icheck-group">
                                        
                                      </div>
                                      <div class="icheck-group">
                                        
                                      </div>
                                      <div class="icheck-group">
                                        
                                      </div>
                                    </div>
                                  </div>
                                  
                                   <div class="form-group">
                                    <label for="">Number of rooms</label>
                                    <select name="bedrooms" class="form-control">
                                      <option value="-1" <?php if ($bedrooms == "-1" ) { ?> selected <?php } ?> >ALL</option>
                                      <option value="1"  <?php if ($bedrooms == "1" ) { ?> selected <?php } ?> >1</option>
                                      <option value="2"  <?php if ($bedrooms == "2" ) { ?> selected <?php } ?> >2</option>
                                      <option value="3"  <?php if ($bedrooms == "3" ) { ?> selected <?php } ?> >3</option>
                                      <option value="4"  <?php if ($bedrooms == "4" ) { ?> selected <?php } ?> >4</option>
                                      <option value="5"  <?php if ($bedrooms == "5" ) { ?> selected <?php } ?>>5</option>
                                    </select>
                                  </div>
                                  -->
                                     
                                  <hr>
            
                                  <div class="row">
                                    <div class="col text-left">
                                      <button class="btn btn-default" id="Remove2" name="Remove" type="button">Remove</button>
                                    </div>
                                    <div class="col text-right">
                                      <button class="btn btn-success" id="Apply2" name="Apply"  type="button">Apply</button>
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
            <input class="btn btn-secondary  SearchBtn" type="submit" name="SearchBtn" id="SearchBtn" value="search">
            <input type="hidden" name="countryId" id="countryId" value="<?php echo $countryId; ?>">
            
            
            <?php if ($LocationId != ""){ ?>
                <input class="btn btn-secondary  SearchBtn" type="button" name="PdfBtn" id="PdfBtn" value="Make PDF" onclick="PDFBtnFn()">
            <?php } ?>
            
          </div>


                
                  
              </div>
            </div>
        </div>
      </div>
    </form>
    <!-- Added by Yasir for suggestions ( End ) -->
    
     <div class="row">
          <!-- property location  -->
          <div class="col-12 col-lg-12">
             <div  class="card">
               <div class="card-body">
                    <div class="widget-title mb-2">
                      <div class="d-inline-block card-title"><h4><?php echo $countryName; ?></h4></div>
                      <div  class="pull-right"> <a  class="btn btn-sm btn-info" href="<?php echo SITE_BASE_URL;?>Property/Projects.html?country=<?php echo $countryId; ?>">View Projects</a></div>
                      <div class="clearfix"></div>
                    </div>
                    
                    <!--<iframe src="https://www.google.com/maps/embed?pb=<?php // echo $CountryUrl; ?>" width="100%" height="500" frameborder="0" style="border:0;" allowfullscreen=""></iframe>-->
                    
                    <div id='mapContainer'>
                        <?php \api\apiClass::getMapScript($countryId,"MAPFIRST");  ?>
                        <?php /*<input id="pac-input" class="controls" type="text" placeholder="Search Box">
                        <div id="map"></div>
                        
                         <script>
                         function initAutocomplete() {
        
                        alert();
                        
                        var map;
                        
                        var CountryLat  = eval("<?php echo $CountryLat; ?>");
                        var CountryLng  = eval("<?php echo $CountryLng; ?>");
                        
                
                       // alert('CountryLat='+ CountryLat )
                       // alert('CountryLng='+ CountryLng )
                        
                        //{lat: -41.4362, lng: 168.6493},
                       
                        var map = new google.maps.Map(document.getElementById('map'), {
                          center: {lat: -37.0082476, lng: 174.7850358},
                          zoom: 13,
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
                       <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmPfnhPm0JDemtnhAaJGdOldwe8NiKS8w&libraries=places&callback=initAutocomplete"
         async defer></script>
         */?>
                        
                    <div>
                    
                    
                </div>
             </div>
          </div>
          <!-- end property location-->
          
       </div>
    
    
    <?php if ($LocationId != "" && $countryId != "UK" ){ ?>

        
        <!-- Graph / Yasir (Start) -->
        <div class="row">
          <div class="col-lg-6 col-md-12 col-12">
            <div class="card h-100 mb-0">
              <div class="card-body">
                <h4 class="card-title">Recent Median Sale Prices</h4>
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
                                <table class="table mb-0">
                                  <thead>
                                     <tr>
                                      <td>&nbsp;</td>
                                      <td align="right"><?php echo $Subrub; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Period </td>
                                      <td align="right">Median Price $</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                       <?php //include_once("corelogic-json-test.php"); 
                                        
                                        $MedianTablArr  =  \api\apiClass::ShowMedianTableValueApi($LocationId,$StreetId,$ZipcodeId); 
                                         foreach($MedianTablArr as $MedianTabl){
                                                
                                                $Datas       = $MedianTabl["date"];
                                            $Datas2      = $MedianTabl["value"];
                                        ?>
                                            <tr>
                                               <td><?php echo $Datas; ?></td>
                                               <td align="right">$ <?php echo $Datas2; ?></td>
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
        </div>
        
        
         
        <div class="row">
             <div class="col-lg-6 col-md-12 col-sm-12 mt-30">
               <div class="card h-100 mb-0">
                 <div class="card-body">
                   <h4 class="card-title">Change in Median Price</h4>
                                                        
                            <div class="table-wrapper">
                                <table class="table mb-0">
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
                                                
                                    $MedianTablArr  =  \api\apiClass::ChangeMedianPriceTableVal($LocationId,$StreetId,$ZipcodeId); 
                                     foreach($MedianTablArr as $MedianTabl){
                                            
                                            $Datas       = $MedianTabl["date"];
                                        $Datas2      = $MedianTabl["value"];
                                    ?>
                                        <tr>
                                           <td><?php echo $Datas; ?></td>
                                           <td align="right"><?php echo $Datas2; ?> %</td>
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
        
        
        <div class="row mt-30">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Rental Statistics</h4>
                        <div class="chart-wrapper">
                          <div id="rentalstatistics"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                          <h4 class="card-title">Rental Rate Observations</h4>
                          <div class="chart-wrapper">
                        <div id="rentalrateobservation"></div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                        <nav class="navbar navbar-expand-sm bg-white navbar-light">
                          <h4 class="card-title">Change in Rental Rate</h4>
                        </nav>
                        <div class="chart-wrapper">
                          <div id="changerenatalrate"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                            <h4 class="card-title">Value Based Gross Rental Yield</h4>
                            <div class="chart-wrapper">
                          <div id="grossrentalyield"></div>
                        </div>
                        </div>
                    
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Household Structure</h4>
                        <div class="chart-wrapper">
                      <div id="census"></div>
                    </div>
                  </div>                    
                </div>
            </div>
        </div>
        
        
         <div class="row mt-30">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Age Ratio</h4>
                        <div class="chart-wrapper">
                          <div id="AgeRatio"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="row">
             <div class="col-lg-6 col-md-12 col-sm-12 mt-30">
               <div class="card h-100 mb-0">
                 <div class="card-body">
                   <h4 class="card-title">Household Income</h4>
                                                        
                            <div class="table-wrapper">
                                <table class="table mb-0">
                                  <thead>
                                     <tr>
                                      <td>Income Range</td>
                                      <td align="right"><?php echo $Subrub; ?></td>
                                    </tr>
                                  </thead>
                                  <tbody>
                            
                                    <?php //include_once("corelogic-json-test.php"); 
                                                
                                    $HouseholdIncomeArr  =  \api\apiClass::HouseholdIncomeTableVal($LocationId,$StreetId,$ZipcodeId); 
                                     foreach($HouseholdIncomeArr as $HouseholdIncomeTbl){
                                            
                                            $Datas       = $HouseholdIncomeTbl["metricTypeShort"];
                                           $Datas2       = $HouseholdIncomeTbl["value"];
                                    ?>
                                        <tr>
                                           <td><?php echo $Datas; ?></td>
                                           <td align="right"><?php echo $Datas2; ?> %</td>
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
                      <div id="HouseholdIncome"></div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      
      
            
        <div class="row mt-30">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Education By Qualification</h4>
                        <div class="chart-wrapper">
                      <div id="EducationByQf"></div>
                    </div>
                  </div>                    
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Education By Occupation</h4>
                        <div class="chart-wrapper">
                      <div id="EducationByOccpation"></div>
                    </div>
                  </div>                    
                </div>
            </div>
        </div>
        
        
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
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.15.5/apexcharts.min.js"></script>
    
        
        <?php //include_once("corelogic-json-test.php"); 
        
        //echo "LocationId=" .$LocationId;
            echo \api\apiClass::ShowMedianMapApi($LocationId,$StreetId,$ZipcodeId,$Subrub); 
            echo \api\apiClass::ChangeMedianPriceApi($LocationId,$StreetId,$ZipcodeId,$Subrub);
            echo \api\apiClass::RentalStatisticsApi($LocationId,$StreetId,$ZipcodeId,$Subrub);
             echo \api\apiClass::RentalRateObservationApi($LocationId,$StreetId,$ZipcodeId,$Subrub);
            echo \api\apiClass::ChangerenatalRateApi($LocationId,$StreetId,$ZipcodeId,$Subrub);
            echo \api\apiClass::GrossRentalYieldApi($LocationId,$StreetId,$ZipcodeId,$Subrub);
            
            //echo "LocationId=$LocationId";
            
            echo \api\apiClass::ShowCensusHouseholdMapApi("formap", $LocationId, "8", "118");
            echo \api\apiClass::AgeRatioApi("formap", $LocationId, "8", "113");
            echo \api\apiClass::HouseholdIncomeApi("formap", $LocationId, "8", "117");
            echo \api\apiClass::EducationByQfApi("formap", $LocationId, "8", "114");
            echo \api\apiClass::EducationByOccpationApi("formap", $LocationId, "8", "115");
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
     elseif($LocationId != "" && $countryId == "UK"){
    ?>
        <div class="row" style='display:none;'>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Education By Level</h4>
                        <div class="chart-wrapper">
                          <div id="Population">
                              <table>
                                    <tr>
                                        <th>People and Population Overview</th>
                                        <th>Median Age</th>
                                        <th>Population Density (England & Wales)</th>
                                        <th>Higher Education or Equivalent</th>
                                    </tr>
                                    <?php //include_once("corelogic-json-test.php"); 
                                                
                                    $PeopleAndPopulationArr  =  \api\apiClass::PeopleAndPopulationApiClass($LocationId); 
                                     //echo "<pre>"; print_r($PeopleAndPopulationArr); echo "</pre>"; 
                                    foreach($PeopleAndPopulationArr as $RsPap){
                                            
                                            //420,157,493,474,475,476,477,478,479,480,481,482,483,484,485,486,487,488
                                            
                                            $MedianAgeVal           = $RsPap["420_Val"];
                                            $PopulationDensity      = $RsPap["157_Val"];
                                            $HigherEducationEQI     = $RsPap["493_Val"];
                                            $PopulationAgeLess20    = $RsPap["474_Val"];
                                            $PopulationAgeBet2024   = $RsPap["475_Val"];
                                            $PopulationAgeBet2529   = $RsPap["476_Val"];
                                            $PopulationAgeBet3034   = $RsPap["477_Val"];
                                            $PopulationAgeBet3539   = $RsPap["478_Val"];
                                            $PopulationAgeBet4044   = $RsPap["479_Val"];
                                            $PopulationAgeBet4549   = $RsPap["480_Val"];
                                            $PopulationAgeBet5054   = $RsPap["481_Val"];
                                            $PopulationAgeBet5559   = $RsPap["482_Val"];
                                            $PopulationAgeBet6064   = $RsPap["483_Val"];
                                            $PopulationAgeBet6569   = $RsPap["484_Val"];
                                            $PopulationAgeBet7074   = $RsPap["485_Val"];
                                            $PopulationAgeBet7579   = $RsPap["486_Val"];
                                            $PopulationAgeBet8084   = $RsPap["487_Val"];
                                            $PopulationAgeAbove85   = $RsPap["488_Val"];
                                          
                                            
                                          
                                     }
                                     //echo 'MedianAge='. $MedianAge;
                                    // echo 'MedianAgeVal='. $MedianAgeVal;
                                    ?>
                                    
                                   
                                   
                              </table>
                              
                          </div>
                    </div>
                  </div>                    
                </div>
            </div>
        </div>
        

        <div class="row result-filter">
          <div class="col-md-12">
           <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="chart-tab" data-toggle="tab" href="#chartTab" role="tab" aria-controls="home" aria-selected="true">Charts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="quartiles-tab" data-toggle="tab" href="#quartilesTab" role="tab" aria-controls="profile" aria-selected="false">Quartiles</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="price-paid-tab" data-toggle="tab" href="#pricePaidTab" role="tab" aria-controls="contact" aria-selected="false">Flat Price Paid Secondary</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="chartTab" role="tabpanel" aria-labelledby="chart-tab">
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
                   <div id="chart2"></div>
                 </div>
               </div>
            </div>
            <div class="tab-pane fade" id="quartilesTab" role="tabpanel" aria-labelledby="quartiles-tab">
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
                    <table class="table table-striped">
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
                                                
                            $productDetailsArr  =  \api\apiClass::ProductFeatureApiUk("forDet",$LocationId,$datasource,$BuildType,$bedrooms,$propertyType);
                             //echo "<pre>"; print_r($productDetailsArr); echo "</pre>"; 
                             //exit;
                            foreach($productDetailsArr as $RsDet){
 
                                    $MonthYr            = $RsDet["MonthYr"];
                                    $NinthPercentile    = $RsDet["NinthPercentile"];
                                    $UpperQuartile      = $RsDet["UpperQuartile"];
                                    $Median             = $RsDet["Median"];
                                    $LowerQuartile      = $RsDet["LowerQuartile"];
                                    $Supply             = $RsDet["Supply"];
                                    
                            ?>
                            
                                <tr>
                                  <td><?php echo $MonthYr; ?></td>
                                  <td><?php echo $NinthPercentile; ?></td>
                                  <td><?php echo $UpperQuartile; ?></td>
                                  <td><?php echo $Median; ?></td>
                                  <td><?php echo $LowerQuartile; ?></td>
                                  <td><?php echo $Supply; ?></td>
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
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.15.5/apexcharts.min.js"></script>
  
   <?php 
         echo \api\apiClass::ProductFeatureApiUk("formap",$LocationId,$datasource,$BuildType,$bedrooms,$propertyType);
         echo \api\apiClass::EducationByLevelApiUK($LocationId);
         
         
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
        
        //alert()
        
        $("[name='Subrub']").val( Text1 );
        $("#LocationId").val(Val1);
        
    });
    
    $(document).on("click", ".SearchBtn", function(){
        if(document.getElementById("LocationId").value=="")
        {
            alert("Select Subrub from the list");
            return false;
        }
    });
    

    
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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

 $("#Apply2,#Apply1").on("click",function(e){
     
   
    countryId       = $("[name='countryId']").val();
    datasource      = $("input[name='datasource']:checked").val();
    BuildType       = $("input[name='BuildType']:checked").val();
    bedrooms        = $('select[name=bedrooms] option').filter(':selected').val();
    //$( "#myselect option:selected" ).text();
    propertyType    = $("input[name='propertyType']:checked").val();
    LocationId      = $("[name='LocationId']").val();
    Subrub          = $("[name='Subrub']").val();
    

    
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
   
   return false;
   
    */

    window.location.href = "<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=" + countryId + "&datasource=" + datasource + "&BuildType=" + BuildType +"&bedrooms="+bedrooms +"&LocationId="+ LocationId +"&Subrub="+Subrub +"&propertyType="+propertyType;
    //window.location.reload();
     
 });

$('.dropdown-menu .nav-pills .nav-link').on("click.bs.dropdown", function (e) { 
    $(this).tab('show'); 
    e.stopPropagation(); 
});

$('.filter-box').on("click.bs.dropdown", function (e) {  
    e.stopPropagation(); 
});

$(function() {

  $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      showDropdowns: true,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
  
  
  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });






});


</script>
    


<?php include"footer.php"; 

 \api\apiClass::getLatLongAddress();

?>


