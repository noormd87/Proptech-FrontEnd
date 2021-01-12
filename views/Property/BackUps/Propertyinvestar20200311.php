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
                <div class="row">
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
                    
                    <iframe src="https://www.google.com/maps/embed?pb=<?php echo $CountryUrl; ?>" width="100%" height="500" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
             </div>
          </div>
          <!-- end property location-->
          
       </div>
    
    
    <?php if ($LocationId != ""){ ?>

        
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
                                      <td align="right">Median Price</td>
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
                                               <td align="right"><?php echo $Datas2; ?></td>
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
                                           <td align="right"><?php echo $Datas2; ?></td>
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
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.15.5/apexcharts.min.js"></script>
    
        
        <?php //include_once("corelogic-json-test.php"); 
            echo \api\apiClass::ShowMedianMapApi($LocationId,$StreetId,$ZipcodeId,$Subrub); 
            echo \api\apiClass::ChangeMedianPriceApi($LocationId,$StreetId,$ZipcodeId,$Subrub);
            echo \api\apiClass::RentalStatisticsApi($LocationId,$StreetId,$ZipcodeId,$Subrub);
            echo \api\apiClass::RentalRateObservationApi($LocationId,$StreetId,$ZipcodeId,$Subrub);
            echo \api\apiClass::ChangerenatalRateApi($LocationId,$StreetId,$ZipcodeId,$Subrub);
            echo \api\apiClass::GrossRentalYieldApi($LocationId,$StreetId,$ZipcodeId,$Subrub);
            
            //echo "LocationId=$LocationId";
            echo \api\apiClass::ShowCensusHouseholdMapApi("formap", $LocationId, "8", "118");
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
    <?php } ?>    
    
 

</div>
<!-- end main content -->
<?php include"footer.php"; ?>