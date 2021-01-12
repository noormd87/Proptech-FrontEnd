<?php include"header.php"; ?>

<?php
$user_id   = \settings\session\sessionClass::GetSessionDisplayName();
?>

<!-- owl crousal -->
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/owl-crousal/css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/owl-crousal/css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/owl-crousal/css/owl.transitions.min.css">


<!-- apexchart -->  
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/css/apexcharts.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/css/apexcharts.min.css.map">

<form action="" id="" class="" method="">
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
                <a class="btn btn-primary" href="<?php echo SITE_BASE_URL;?>Portfolio/MyPortfolio.html">ADD NEW</a>
                <!-- <div class="dropdown custom-dropdown pull-right">
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


  <div class="row">
    <div class="col-12">
      <div class="mb-30">
        <ul id="lightSlider">
            
 <?php
 
 
 \Portfolio\PortfolioClass::Init();
$rows = \Portfolio\PortfolioClass::getPropertyDetails($user_id);



$i=1;
$TotalPropertyValue = 0;
$Totalrentperweek  = 0;
foreach ($rows as $row) 
{
    $ProprtyId = $row["property_id"];
    $Countryname = $row["country_name"];
    $locationame = $row["location_name"];
    $imagefile      = $row["image_file"] ? $row["image_file"] : "notupload";
    
    
    
    $Managementfee                      = $row["management_fee"];
    $Adminstrationfee                   = $row["adminstration_fee"];
    $PropertyMaintenance                = $row["property_maintenance"];
    $Ratesvalue                         = $row["rates_value"];
    $BodyCorporatefee                   = $row["body_corporate_fee"];
    $PropertyValueCurrent               = $row["property_value_current"];
    $rent_perweek                       = $row["rent_perweek"];
    
    $TotalRentperweek                   = floatval($rent_perweek) * 52;
    
    
    $TotalMangementFeetemp              = floatval($Managementfee) / 100;
    $TotalMangementFee                  = floatval($TotalRentperweek) * floatval($TotalMangementFeetemp) ;
    
    $TotalExapense                      = floatval($TotalMangementFee) + floatval($Adminstrationfee) + floatval($PropertyMaintenance) + floatval($Ratesvalue) + floatval($BodyCorporatefee);
    
    $YieldROI                           = (floatval($TotalRentperweek)  - floatval($TotalExapense) ) /  floatval($PropertyValueCurrent) ;
    
  
    $CapitalGrowth                     = $row["est_portfolio_growth"];
    $YearlyRentalGrowth                 = $row["est_rental_growth"];
    
 
 
    
    
    $propertyvaluecurrent = $row["property_value_current"] ? $row["property_value_current"] : "0";
    $rentperweek = $row["rent_perweek"] ? $row["rent_perweek"] : "0";
    
    $TotalPropertyValue     = floatval ($TotalPropertyValue) + floatval ($propertyvaluecurrent);
    $Totalrentperweek       = floatval ($Totalrentperweek) + floatval ($rentperweek);
    
 ?> 
  
<li>
      <div class="property-card" id="property001">
              <div class="property-card-body">
                <div class="select-box">
                  <div class="pull-left">
                  <input type="checkbox" class="check property-check" name="">
                </div>
                <div class="pull-right">
                  <div class="dropdown custom-dropdown">
                      <div data-toggle="dropdown">
                          <i class="ti-more-alt rotate-90 d-inline-block c-pointer"></i>
                      </div>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a href="<?php echo SITE_BASE_URL;?>/Portfolio/MyPortfolio.html?buttonaction=Edit&property_id=<?php echo $ProprtyId;?>" class="dropdown-item f-s-12">Edit</a>
                          <a href="#" class="dropdown-item f-s-12">Delete</a>
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
    $i++;
}
 
 ?>
  
 <!-- <li>
      <div class="property-card" id="property002">
              <div class="property-card-body">
                <div class="select-box">
                  <div class="pull-left">
                  <input type="checkbox" class="check property-check" name="">
                </div>
                <div class="pull-right">
                  <div class="dropdown custom-dropdown">
                      <div data-toggle="dropdown">
                          <i class="ti-more-alt rotate-90 d-inline-block c-pointer"></i>
                      </div>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a href="#" class="dropdown-item f-s-12">Edit</a>
                          <a href="#" class="dropdown-item f-s-12">Delete</a>
                          <a href="#" class="dropdown-item f-s-12">Analyse</a>
                      </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                </div>
                <div class="property-card-img">
                  <img src="<?php// echo SITE_BASE_URL;?>assets/img/avenue_prop_img_001.jpg" class="img-responsive">
                </div>
                <div class="property-card-table">
                  <table class="table">
                    <tr>
                      <td>Country</td>
                      <td>New Zealand</td>
                    </tr>
                    <tr>
                      <td>Location</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Purchase Date</td>
                      <td></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
  </li>
  <li>
      <div class="property-card disabled-div" id="property003">
              <div class="property-card-body" disabled>
                <div class="select-box">
                  <div class="pull-left">
                  <input type="checkbox" class="check" name="">
                </div>
                <div class="pull-right">
                  <div class="dropdown custom-dropdown">
                      <div data-toggle="dropdown">
                          <i class="ti-more-alt rotate-90 d-inline-block c-pointer"></i>
                      </div>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a href="#" class="dropdown-item f-s-12">Edit</a>
                          <a href="#" class="dropdown-item f-s-12">Delete</a>
                          <a href="#" class="dropdown-item f-s-12">Analyse</a>
                      </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                </div>
                <div class="property-card-img">
                  <img src="<?php// echo SITE_BASE_URL;?>assets/img/placeholder-img.png" class="img-responsive">
                </div>
                <div class="property-card-table">
                  <table class="table">
                    <tr>
                      <td>Country</td>
                      <td>New Zealand</td>
                    </tr>
                    <tr>
                      <td>Location</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Purchase Date</td>
                      <td></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
  </li>
  <li>
      <div class="property-card disabled-div" id="property003">
              <div class="property-card-body" disabled>
                <div class="select-box">
                  <div class="pull-left">
                  <input type="checkbox" class="check" name="">
                </div>
                <div class="pull-right">
                  <div class="dropdown custom-dropdown">
                      <div data-toggle="dropdown">
                          <i class="ti-more-alt rotate-90 d-inline-block c-pointer"></i>
                      </div>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a href="#" class="dropdown-item f-s-12">Edit</a>
                          <a href="#" class="dropdown-item f-s-12">Delete</a>
                          <a href="#" class="dropdown-item f-s-12">Analyse</a>
                      </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                </div>
                <div class="property-card-img">
                  <img src="<?php echo SITE_BASE_URL;?>assets/img/placeholder-img.png" class="img-responsive">
                </div>
                <div class="property-card-table">
                  <table class="table">
                    <tr>
                      <td>Country</td>
                      <td>New Zealand</td>
                    </tr>
                    <tr>
                      <td>Location</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Purchase Date</td>
                      <td></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
  </li>
  <li>
      <div class="property-card disabled-div" id="property003">
              <div class="property-card-body" disabled>
                <div class="select-box">
                  <div class="pull-left">
                  <input type="checkbox" class="check" name="">
                </div>
                <div class="pull-right">
                  <div class="dropdown custom-dropdown">
                      <div data-toggle="dropdown">
                          <i class="ti-more-alt rotate-90 d-inline-block c-pointer"></i>
                      </div>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a href="#" class="dropdown-item f-s-12">Edit</a>
                          <a href="#" class="dropdown-item f-s-12">Delete</a>
                          <a href="#" class="dropdown-item f-s-12">Analyse</a>
                      </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                </div>
                <div class="property-card-img">
                  <img src="<?php echo SITE_BASE_URL;?>assets/img/placeholder-img.png" class="img-responsive">
                </div>
                <div class="property-card-table">
                  <table class="table">
                    <tr>
                      <td>Country</td>
                      <td>New Zealand</td>
                    </tr>
                    <tr>
                      <td>Location</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Purchase Date</td>
                      <td></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
  </li>
  <li>
      <div class="property-card disabled-div" id="property003">
              <div class="property-card-body" disabled>
                <div class="select-box">
                  <div class="pull-left">
                  <input type="checkbox" class="check" name="">
                </div>
                <div class="pull-right">
                  <div class="dropdown custom-dropdown">
                      <div data-toggle="dropdown">
                          <i class="ti-more-alt rotate-90 d-inline-block c-pointer"></i>
                      </div>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a href="#" class="dropdown-item f-s-12">Edit</a>
                          <a href="#" class="dropdown-item f-s-12">Delete</a>
                          <a href="#" class="dropdown-item f-s-12">Analyse</a>
                      </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                </div>
                <div class="property-card-img">
                  <img src="<?php echo SITE_BASE_URL;?>assets/img/placeholder-img.png" class="img-responsive">
                </div>
                <div class="property-card-table">
                  <table class="table">
                    <tr>
                      <td>Country</td>
                      <td>New Zealand</td>
                    </tr>
                    <tr>
                      <td>Location</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Purchase Date</td>
                      <td></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
  </li>-->
</ul>
      </div>
    </div>
  </div>

    <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Properties status</h4>
          <div class="row">
            <div class="col-lg-6">
                    <div class="card mb-0">
                        <div class="card-body p-0">
                            <img src="<?php echo SITE_BASE_URL; ?>assets/img/avenue_prop_img_001.jpg" class="img-fluid">
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
  </div>

  <!-- start row -->
  <div class="row">
    <div class="col-lg-3 no-card-border">
      <div class="card">
          <div class="card-body">
              <div class="m-t-15 text-center">
                  <h2 class="f-s-40 text-primary"><?php echo $i-1; ?></h2>
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
                  <h2 class="f-s-40 text-primary"><?php echo $TotalPropertyValue; ?></h2>
                  <p class="f-s-18">Property Value</p>
              </div>

              <canvas id="top-product"></canvas>
          </div>
      </div>
    </div>

    <div class="col-lg-3 no-card-border">
      <div class="card">
          <div class="card-body">
              <div class="m-t-15 text-center">
                  <h2 class="f-s-40 text-primary">5%</h2>
                  <p class="f-s-18">Yield / ROI</p>
              </div>

              <canvas id="expenses-graph"></canvas>
          </div>
      </div>
    </div>
    <div class="col-lg-3 no-card-border">
      <div class="card">
          <div class="card-body">
              <div class="m-t-15 text-center">
                  <h2 class="f-s-40 text-primary"><?php echo $Totalrentperweek; ?></h2>
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
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
              <div class="card-body">
                  <h4 class="pull-left">10 Year Growth</h4>
                  <div class="dropdown custom-dropdown pull-right">
                      <div data-toggle="dropdown">
                          <i class="ti-more-alt rotate-90 d-inline-block c-pointer"></i>
                      </div>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a href="#" class="dropdown-item f-s-12">10 Year Growth</a>
                          <a href="#" class="dropdown-item f-s-12">5 Year Growth</a>
                          <a href="#" class="dropdown-item f-s-12">Refresh</a>
                      </div>
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

  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
              <div class="card-body">
                  <!-- <div class="card-title">
                      Leases
                  </div> -->
                  <div class="table-wrapper table-responsive">
                      <table class="table table-hover table-striped table-bordered data-table">
                          <thead>
                              <tr>
                                 <th>Location</th>
                                 <th>Management Fee</th>
                                 <th>Adminstration Fee</th>
                                 <th>Property Maintenance</th>
                                 <th>Rates</th>
                                 <th>Body Corporate Fee</th>
                                 <th>Rent / week</th>
                                 <th>Property Value</th>
                              </tr>
                          </thead>
                          <tbody>
                              
                              <?php
                              
                               \Portfolio\PortfolioClass::Init();
                                $rows = \Portfolio\PortfolioClass::getPropertyDetails($user_id );
                                foreach ($rows as $row) 
                                {
                                    $ProprtyId = $row["property_id"];
                                    $Countryname = $row["country_name"];
                                    $managementfee = $row["management_fee"];
                                    $adminstrationfee = $row["adminstration_fee"];
                                    $propertymaintenance = $row["property_maintenance"];
                                    $ratesvalue = $row["rates_value"];
                                    $bodycorporatefee = $row["body_corporate_fee"];
                                    $rentperweek = $row["rent_perweek"];
                                    $propertyvaluecurrent = $row["property_value_current"];
                          
                                    
                                 ?> 
                               
                                  <tr>
                                     <td><?php echo $Countryname; ?></td>
                                     <td><?php echo $managementfee; ?>%</td>
                                     <td>$<?php echo $adminstrationfee; ?></td>
                                     <td>$<?php echo $propertymaintenance; ?></td>
                                     <td>$<?php echo $ratesvalue; ?></td>
                                     <td>$<?php echo $bodycorporatefee; ?></td>
                                     <td>$<?php echo $rentperweek; ?></td>
                                     <td>$<?php echo $propertyvaluecurrent; ?></td>
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

  
</form>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css">





<?php include"footer.php"; ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
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

    $('.icheckbox_square-blue').css('opacity','0');
    $('.property-card-body').click(function ()
    {
       $(this).find('input[type=checkbox]').prop("checked", !$(this).find('input[type=checkbox]').prop("checked"));

       var chckValue = $('.property-check').iCheck('update')[0].checked;

       if(chckValue == true){
        $('.icheckbox_square-blue').css('opacity','1');
       }else{
        $('.icheckbox_square-blue').css('opacity','0');
       }

    });

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


    //Top Product 
    // var ctx = document.getElementById("top-product");
    // ctx.height = 100;
    // var myChart = new Chart(ctx, {
    //     type: 'line',
    //     data: {
    //         labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
    //         type: 'line',

    //         datasets: [{
    //             label: "My First dataset",
    //             data: [50, 26, 36, 30, 46, 38, 60],
    //             backgroundColor: "rgba(133,133,255,0.35)",
    //             borderColor: "#7342cf",
    //             pointRadius: 0,
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         tooltips: {
    //             enabled: false,
    //         },
    //         legend: {
    //             display: false,
    //             labels: {
    //                 usePointStyle: false,

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
    //                     labelString: 'Value'
    //                 }
    //             }]
    //         },
    //         title: {
    //             display: false,
    //         }
    //     }
    // });


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
                        labelString: 'Value'
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
                        labelString: 'Value'
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
                        labelString: 'Value'
                    }
                }]
            },
            title: {
                display: false,
            }
        }
    });

    //BTC Income 
    // var ctx = document.getElementById("btc-income");
    // ctx.height = 100;
    // var myChart = new Chart(ctx, {
    //     type: 'line',
    //     data: {
    //         labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
    //         type: 'line',

    //         datasets: [{
    //             label: "My First dataset",
    //             data: [50, 26, 36, 30, 46, 38, 60],
    //             backgroundColor: "rgba(133,122,255,0.35)",
    //             borderColor: "#FF4961",
    //             pointRadius: 0,
    //             lineTension: 0,
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         tooltips: {
    //             enabled: false,
    //         },
    //         legend: {
    //             display: false,
    //             labels: {
    //                 usePointStyle: false,

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
    //                     labelString: 'Value'
    //                 }
    //             }]
    //         },
    //         title: {
    //             display: false,
    //         }
    //     }
    // });
</script>


<!-- apexchart -->
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/js/apexcharts.min.js"></script>

<script type="text/javascript">

//----------------------------------
//--------10 year Growth
//----------------------------------

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
        name: 'Groth Rate',
        data: [400000, 300000, 1000000, 900000, 2900000, 1900000, 2200000, 900000, 1200000, 700000]
    }],
    xaxis: {
        type: '10 Years Growth',
        categories: ['1/11/20010', '2/11/2011', '3/11/2012', '4/11/2013', '5/11/2014', '6/11/2015', '7/11/2016', '8/11/2017', '9/11/2018', '10/11/2019', '11/11/2020'],
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
    // yaxis: {
    //     min: 0,
    //     max: 4000000,
    //     title: {
    //         text: 'Capital Grain',
    //         style: {
    //           fontSize: '16px',
    //           fontFamily: 'Raleway',
    //         },
    //     },                
    // },
    responsive: [{
      breakpoint: 1440,
      options: {
        chart: {
          height: 350,
        }
      }
    }]
}

var chart = new ApexCharts(
    document.querySelector("#growthChart"),
    options
);

chart.render();



//----------------------------------
//--------column chart
//----------------------------------

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
    legend:{
      show:true,
      position: 'bottom',
      horizontalAlign: 'center',
      fontSize : 16,
      fontFamily : 'Raleway',
      height:30,
      offsetX: 0,
      offsetY: 0,
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
        show:false,
        rotate: -45,
        style: {
          colors: colors,
          fontSize: '16px',
          cssClass: 'apexcharts-xaxis-label',
        }
      },
    },
  }

  var columnChart = new ApexCharts(
    document.querySelector("#columnchart"),
    options
  );

  columnChart.render();




</script>


