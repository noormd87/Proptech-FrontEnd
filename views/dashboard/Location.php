<?php include "header.php"; 

$CountryCode=$_REQUEST["CountryCode"];
$CountryName=$_REQUEST["CountryName"];

?>

<!-- main content -->
<div class="content">
   <div class="row">
      <!-- property location  -->
      <div class="col-12">
        <div class="title-area">
          <h2 class="heading-primary"><?PHP echo $CountryName ?></h2><a class="btn analyser-submit bg-orange" href="<?php echo SITE_BASE_URL;?>Property/Properties.html?country=<?PHP echo $CountryCode ?>">View Projects <i class="fa fa-chevron-right"></i></a>
          <input class="form-control" type="hidden" id="CountryCode" name="CountryCode" size='2'  value="<?PHP echo $CountryCode ?>"   />
          
        </div>
         <div  class="map-box" style="height: 600px;"></div>
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
    

</div>
<!-- end main content -->
<?php include"footer.php"; ?>