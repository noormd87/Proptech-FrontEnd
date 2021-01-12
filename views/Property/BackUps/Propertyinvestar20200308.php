<?php include "header.php"; ?>
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
    
}


$SearchBtn      = \Property\PropertyClass::$SearchBtn; 
$LocationId     = \Property\PropertyClass::$LocationId;
$Subrub         = \Property\PropertyClass::$Subrub;
$Street         = \Property\PropertyClass::$Street;
$StreetId       = \Property\PropertyClass::$StreetId;
$stateId        = \Property\PropertyClass::$stateId;
$Zipcode        = \Property\PropertyClass::$Zipcode;
$ZipcodeId      = \Property\PropertyClass::$ZipcodeId;


?>
<!-- main content -->
<div class="content">
    <!-- Added by Yasir for suggestions (Start) -->
    <form name="frmSearch" id="frmSearch" method="post" action="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=<?php echo $countryId; ?>">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <di class="row">
                  <div class="col">
                    <div class="">
                      <input class="form-control" type="text" name="Subrub" id="Suburb" placeholder="Subrub" value="<?php echo $Subrub;?>" />
                      <input class="form-control" type="hidden" name="LocationId" id="LocationId" placeholder="LocationId" value="<?php echo $LocationId;?>" >
                      
                    </div>
                  </div>
                  <div class="col">
                    <div class="">
                      <input class="form-control" type="text" name="Street" id="Street" placeholder="Street"  value="<?php echo $Street;?>" >
                      <input class="form-control" type="hidden" name="StreetId" id="StreetId" placeholder="StreetId"  value="<?php echo $StreetId;?>" >
                      <input class="form-control" type="hidden" name="stateId" id="stateId" placeholder="stateId"  value="<?php echo $stateId;?>" >
                    </div>
                  </div>
                  <div class="col">
                    <div class="">
                      <input class="form-control" type="text" name="Zipcode" id="Zipcode" placeholder="Zip Code" value="<?php echo $Zipcode;?>" >
                      <input class="form-control" type="hidden" name="ZipcodeId" id="ZipcodeId" placeholder="ZipcodeId" value="<?php echo $ZipcodeId;?>" >
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="">
                      <input class="btn btn-secondary btn-block" type="submit" name="SearchBtn" id="SearchBtn" value="search">
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </form>
    <!-- Added by Yasir for suggestions ( End ) -->
    
    
    <?php if ($LocationId != ""){ ?>

        <div class="row">
          <!-- property location  -->
          <div class="col-12">
             <div  class="card">
              <div class="card-header pb-3">
                <div class="widget-title row">
                  <div class="col text-left"><h3><?php echo $countryName; ?></h3></div>
                  <div  class="col text-right"> <a  class="btn btn-info" href="<?php echo SITE_BASE_URL;?>Property/Projects.html?country=<?php echo $countryId; ?>">View Projects</a></div>
                </div>
              </div>
              <div class="clearfix"></div>
               <div class="card-body">
                    <iframe src="https://www.google.com/maps/embed?pb=<?php echo $CountryUrl; ?>" width="100%" height="500" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
             </div>
          </div>
          <!-- end property location-->
          
       </div>
       
       
       
       
       
    
       <!-- Sort property list in location -->
       <div class="row">
          <div class="col-12">
            <div class="property-overview" id="">
              <div class="sort-property">
                <form action="post" method="post">
                  <div class="sort-nav">
                    <nav class="navbar navbar-expand-sm">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="#">Bethnall Green E2</a>
                        </li>
                      </ul>
                      <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="#">All Properties</a>
                        </li>
                        <li class="nav-list pl-5">
                          <a class="nav-link" href="#">Buld Type:</a>
                        </li>
                        <li class="nav-list">
                          <a class="nav-link" href="#">
                            <div class="radio">
                              <input type="radio" name="build_type" id="build_type1" value="all" checked>
                                <label for="build_type1">
                                    All
                                </label>
                            </div>
                          </a>
                        </li>
                        <li class="nav-list">
                          <a class="nav-link" href="#">
                            <div class="radio">
                              <input type="radio" name="build_type" id="build_type2" value="secondary">
                                <label for="build_type2">
                                    Secondary
                                </label>
                            </div>
                          </a>
                        </li>
                        <li class="nav-list">
                          <a class="nav-link" href="#">
                            <div class="radio">
                              <input type="radio" name="build_type" id="build_type3" value="new_built">
                                <label for="build_type3">
                                    New Built
                                </label>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                  <div class="result-property">
                    <!-- overview property type -->
                    <div class="property-action-bar" id="fullscreen">
                      <nav class="navbar navbar-expand-sm bg-b1">
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-list">
                            <a class="nav-link" href="#">Overview by Property Type</a>
                          </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                          <li class="nav-list">
                            <a class="nav-link" href="#">12 Month Avg</a>
                          </li>
                          <li class="nav-list">
                            <a class="nav-link" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/download-icon.png" alt="download-icon"></a>
                          </li>
                          <li class="nav-list">
                            <a class="nav-link" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/save-icon.png" alt="Save"></a>
                          </li>
                          <li class="nav-list">
                            <a class="nav-link requestfullscreen" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/maxmize-icon.png" alt="Maximize"></a><a href="#" class="exitfullscreen" style="display: none"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/minimize-icon.png" alt="Maximize"></a>
                          </li>
                        </ul>
                      </nav>
                      <div class="table-wrapper">
                        <table class="table">
                          <thead>
                            <tr>
                              <td></td>
                              <td>£/sqft Paid</td>
                              <td>Price Paid </td>
                              <td>Discount</td>
                              <td>Gross Yield</td>
                              <td>Listings</td>
                              <td>Transactions</td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Studio</td>
                              <td>£742</td>
                              <td>£250.147</td>
                              <td>1.3%</td>
                              <td>4.2%</td>
                              <td>6</td>
                              <td>0</td>
                            </tr>
                            <tr>
                              <td>Flat</td>
                              <td>£681</td>
                              <td>£434.215</td>
                              <td>4.0%</td>
                              <td>4.6%</td>
                              <td>297</td>
                              <td>18</td>
                            </tr>
                            <tr>
                              <td>Terraced</td>
                              <td>£874</td>
                              <td>£867.691</td>
                              <td>1.5%</td>
                              <td>4.1%</td>
                              <td>23</td>
                              <td>2</td>
                            </tr>
                            <tr>
                              <td>Semi-Detached</td>
                              <td>£830</td>
                              <td>£590.000</td>
                              <td>N/A</td>
                              <td>4.3%</td>
                              <td>1</td>
                              <td>1</td>
                            </tr>
                            <tr>
                              <td>Detached</td>
                              <td>£634</td>
                              <td>£1140.000</td>
                              <td>1.5%</td>
                              <td>6.7%</td>
                              <td>4</td>
                              <td>N/A</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- end overview property type-->
                    <!-- price-medians -->
                    <div class="property-action-bar  " id="fullscreen">
                      <nav class="navbar navbar-expand-sm bg-g1">
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-list">
                            <a class="nav-link" href="#">Overview by Property Type</a>
                          </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                          <li class="nav-list">
                            <a class="nav-link" href="#">12 Month Avg</a>
                          </li>
                          <li class="nav-list">
                            <a class="nav-link" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/download-icon.png" alt="download-icon"></a>
                          </li>
                          <li class="nav-list">
                            <a class="nav-link" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/save-icon.png" alt="Save"></a>
                          </li>
                          <li class="nav-list">
                            <a class="nav-link requestfullscreen" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/maxmize-icon.png" alt="Maximize"></a><a href="#" class="exitfullscreen" style="display: none"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/minimize-icon.png" alt="Maximize"></a>
                          </li>
                        </ul>
                      </nav>
                      <div class="table-wrapper">
                        <table class="table prop-type-table">
                          <thead>
                            <tr>
                              <td>Median Price Paid</td>
                              <td>12 Month change</td>
                              <td>Median discount</td>
                              <td>Transactions</td>
                              <td>£/sqft Paid</td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>£448,264</td>
                              <td>-5%</td>
                              <td>3.5%</td>
                              <td>20</td>
                              <td>£703</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- end price-medians-->
                    <!-- end overview property type-->
                    <!-- sales by property type -->
                    <div class="property-action-bar" id="fullscreen">
                      <nav class="navbar navbar-expand-sm bg-b2">
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-list">
                            <a class="nav-link" href="#">Overview by Property Type</a>
                          </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                          <li class="nav-list">
                            <a class="nav-link" href="#">12 Month Avg</a>
                          </li>
                          <li class="nav-list">
                            <a class="nav-link" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/download-icon.png" alt="download-icon"></a>
                          </li>
                          <li class="nav-list">
                            <a class="nav-link" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/save-icon.png" alt="Save"></a>
                          </li>
                          <li class="nav-list">
                            <a class="nav-link requestfullscreen" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/maxmize-icon.png" alt="Maximize"></a><a href="#" class="exitfullscreen" style="display: none"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/minimize-icon.png" alt="Maximize"></a>
                          </li>
                        </ul>
                      </nav>
                      <div class="chart-wrapper">
                        <div class="chart-div" id="columnchart"></div>
                      </div>
                    </div>
                    <!-- end sales by property type-->
    
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div><!-- end Sort property list in location -->
        
        
        
        
        
        <!-- Graph / Yasir (Start) -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card widget-card">
                    <div class="card-header">
                        <div class="">
                            <nav class="navbar navbar-expand-sm bg-white navbar-light">
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
                            </nav>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-wrapper">
                          <div id="medianChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.15.5/apexcharts.min.js"></script>
    
        
        <?php //include_once("corelogic-json-test.php"); 
        echo \api\apiClass::ShowMedianMapApi(); 
        ?>
        
    <?php } ?>    
    
    <?php /*
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.15.5/apexcharts.min.js"></script>
    <script type="text/javascript">
        //column chart
      var colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560'];
      var options = {
        chart: {
          toolbar: {
            show: false
          },
          height: 500,
          type: 'bar',
          events: {
            click: function (chart, w, e) {
              console.log(chart, w, e)
            }
          },
        },
        colors: colors,
        plotOptions: {
          bar: {
            columnWidth: '35%',
            distributed: true
          }
        },
        dataLabels: {
          enabled: false,
        },
        series: [{
          name: 'net',
          data: [800, 900, 650, 830]
        }],
        xaxis: {
          categories: ['Flat Price Paid', 'Semi Detached Price Paid', 'Terrace House Price Paid', 'Detached Price Paid'],
          labels: {
            style: {
              colors: colors,
              fontSize: '14px'
            }
          }
        },
      }
    
      var columnChart = new ApexCharts(
        document.querySelector("#columnchart"),
        options
      );
    
      columnChart.render();
    </script>
    <?php */?>
    <!-- Graph / Yasir ( End ) -->
    
    
    

</div>
<!-- end main content -->
<?php include"footer.php"; ?>