<?php include"header.php"; ?>
<!-- owl crousal -->
<link rel="stylesheet" type="text/css" href="assets/plugins/owl-crousal/css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/owl-crousal/css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/owl-crousal/css/owl.transitions.min.css">
<!-- apexchart -->  
<link rel="stylesheet" type="text/css" href="assets/plugins/apexcharts/css/apexcharts.min.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/apexcharts/css/apexcharts.min.css.map">
<script type="text/javascript" src="assets/plugins/owl-crousal/js/owl.carousel.min.js"></script>
<script src="assets/plugins/chartjs/Chart.bundle.js"></script>
<style type="text/css" media="screen">
   <i class="icofont-listing-box"></i>
</style>
<form action="" id="" class="" method="">
   <div class="row">
      <div class="col-12">
         <!-- Portfolio Property Grid View -->
         <div class="title-wrapper row">
           <div class="col">
             <div class="">
               <h2 class="page-title">My Portfolio</h2>
             </div>
           </div>
         </div>
         <div class="card">
            <div class="card-header" >
               <div class="row">
                  <div class="col">
                     <h4 class="t3 fw-500">My Portfolio</h4>
                  </div>
                     <div class="col">
                      <div class="filter-wrapper">
                        <ul class="filter-nav">
                           <li><a class="btn btn-primary text-white" href="#" title="">Go to my portfolio</a></li>
                          <li class=""><a href="#" class="common_selector" id="list_view"><i class="fa fa-list-ul" aria-hidden="true"></i> List View</a></li>
                          <li class=""><a href="#" class="common_selector" id="grid_view"><i class="fa fa-th-large" aria-hidden="true"></i> Grid View</a></li>
                        </ul>
                      </div>
                    </div>
               </div>
            </div>
         </div>
         <div class="portfolio-carousal" id="gridView">
            <ul id="lightSlider">
               <li>
                  <div class="card" id="property001">
                     <div class="card-body">
                        <div class="select-box">
                           <div class="pull-left">
                              <input type="checkbox" class="check property-check" name=""> Avenue Apartment
                           </div>
                           <div class="pull-right">
                              <div class="dropdown portfolio-dropdown">
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
                        </div>
                        <div class="clearfix"></div>
                        <div class="property-card-img">
                           <img src="assets/img/portfolio-img-thumb.png" class="img-responsive">
                        </div>
                        <div class="property-card-list">
                           <ul class="list-group">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Country
                                 <span class="">New Zealand</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 City
                                 <span class="">Auckland</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Annual Income
                                 <span class="">$30,000</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Market Value (E)
                                 <span class="">$600,000</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Gross Yield
                                 <span class="">5%</span>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="card" id="property002">
                     <div class="card-body">
                        <div class="select-box">
                           <div class="pull-left">
                              <input type="checkbox" class="check property-check" name=""> Avenue Apartment
                           </div>
                           <div class="pull-right">
                              <div class="dropdown portfolio-dropdown">
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
                        </div>
                        <div class="clearfix"></div>
                        <div class="property-card-img">
                           <img src="assets/img/portfolio-img-thumb.png" class="img-responsive">
                        </div>
                        <div class="property-card-list">
                           <ul class="list-group">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Country
                                 <span class="">New Zealand</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 City
                                 <span class="">Auckland</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Annual Income
                                 <span class="">$30,000</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Market Value (E)
                                 <span class="">$600,000</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Gross Yield
                                 <span class="">5%</span>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="card disabled-div" id="property003">
                     <div class="card-body" disabled>
                        <div class="select-box">
                           <div class="pull-left">
                              <input type="checkbox" class="check property-check" name=""> Avenue Apartment
                           </div>
                           <div class="pull-right">
                              <div class="dropdown portfolio-dropdown">
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
                        </div>
                        <div class="clearfix"></div>
                        <div class="property-card-img">
                           <img src="assets/img/portfolio-placeholder.jpg" class="img-responsive">
                        </div>
                        <div class="property-card-list">
                           <ul class="list-group">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Country
                                 <span class="">New Zealand</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 City
                                 <span class="">Auckland</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Annual Income
                                 <span class="">$30,000</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Market Value (E)
                                 <span class="">$600,000</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Gross Yield
                                 <span class="">5%</span>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="card disabled-div" id="property003">
                     <div class="card-body" disabled>
                        <div class="select-box">
                           <div class="pull-left">
                              <input type="checkbox" class="check property-check" name=""> Avenue Apartment
                           </div>
                           <div class="pull-right">
                              <div class="dropdown portfolio-dropdown">
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
                        </div>
                        <div class="clearfix"></div>
                        <div class="property-card-img">
                           <img src="assets/img/portfolio-placeholder.jpg" class="img-responsive">
                        </div>
                        <div class="property-card-list">
                           <ul class="list-group">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Country
                                 <span class="">New Zealand</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 City
                                 <span class="">Auckland</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Annual Income
                                 <span class="">$30,000</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Market Value (E)
                                 <span class="">$600,000</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Gross Yield
                                 <span class="">5%</span>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="card disabled-div" id="property003">
                     <div class="card-body" disabled>
                        <div class="select-box">
                           <div class="pull-left">
                              <input type="checkbox" class="check property-check" name=""> Avenue Apartment
                           </div>
                           <div class="pull-right">
                              <div class="dropdown portfolio-dropdown">
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
                        </div>
                        <div class="clearfix"></div>
                        <div class="property-card-img">
                           <img src="assets/img/portfolio-placeholder.jpg" class="img-responsive">
                        </div>
                        <div class="property-card-list">
                           <ul class="list-group">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Country
                                 <span class="">New Zealand</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 City
                                 <span class="">Auckland</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Annual Income
                                 <span class="">$30,000</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Market Value (E)
                                 <span class="">$600,000</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Gross Yield
                                 <span class="">5%</span>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="card disabled-div" id="property003">
                     <div class="card-body" disabled>
                        <div class="select-box">
                           <div class="pull-left">
                              <input type="checkbox" class="check property-check" name=""> Avenue Apartment
                           </div>
                           <div class="pull-right">
                              <div class="dropdown portfolio-dropdown">
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
                        </div>
                        <div class="clearfix"></div>
                        <div class="property-card-img">
                           <img src="assets/img/placeholder-img.png" class="img-responsive">
                        </div>
                        <div class="property-card-list">
                           <ul class="list-group">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Country
                                 <span class="">New Zealand</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 City
                                 <span class="">Auckland</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Annual Income
                                 <span class="">$30,000</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Market Value (E)
                                 <span class="">$600,000</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Gross Yield
                                 <span class="">5%</span>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
         <!-- End Portfolio Property Grid View -->
         <!-- Portfolio Property List View -->
         <div class="portfolio-carousal" id="listView">
            <div class="table-responsive">
              <table class="table portfolio-table  mb-0">
                <tr>
                  <td align="top">
                    <div class="row no-gutters">
                      <div class="col-auto pr-2">
                        <div class="">
                           <img src="assets/img/trendin-property.png" class="img-responsive">
                        </div>
                        
                      </div>
                      <div class="col">
                        <div class="portfolio-list-inner">
                          <p class="">Property Name</p>
                          <h5 class="">Avenue Apartment</h5>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner">
                      <p class="">Country</p>
                      <h5 class="">New Zealand</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner">
                      <p class="">City</p>
                      <h5 class="">Auckland</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner">
                      <p class="">Annual Income</p>
                      <h5 class="">$30,000</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner text-center">
                      <p class="">Market Value (E)</p>
                      <h5 class="">$600,000</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner text-center">
                      <p class="">Gross Yield</p>
                      <h5 class="">5%</h5>
                    </div>
                  </td>
                  <td class="align-middle">
                      <div class="list-view-action">
                        <div class="d-inline-block">
                          <input type="checkbox" class="check property-check" name="">
                        </div>
                        <div class="dropdown portfolio-dropdown d-inline-block">
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
                  </td>
                </tr>

                <tr>
                  <td align="top">
                    <div class="row no-gutters">
                      <div class="col-auto pr-2">
                        <div class="">
                           <img src="assets/img/trendin-property.png" class="img-responsive">
                        </div>
                        
                      </div>
                      <div class="col">
                        <div class="portfolio-list-inner">
                          <p class="">Property Name</p>
                          <h5 class="">Avenue Apartment</h5>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner">
                      <p class="">Country</p>
                      <h5 class="">New Zealand</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner">
                      <p class="">City</p>
                      <h5 class="">Auckland</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner">
                      <p class="">Annual Income</p>
                      <h5 class="">$30,000</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner text-center">
                      <p class="">Market Value (E)</p>
                      <h5 class="">$600,000</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner text-center">
                      <p class="">Gross Yield</p>
                      <h5 class="">5%</h5>
                    </div>
                  </td>
                  <td class="align-middle">
                      <div class="list-view-action">
                        <div class="d-inline-block">
                          <input type="checkbox" class="check property-check" name="">
                        </div>
                        <div class="dropdown portfolio-dropdown d-inline-block">
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
                  </td>
                </tr>
                <tr>
                  <td align="top">
                    <div class="row no-gutters">
                      <div class="col-auto pr-2">
                        <div class="">
                           <img src="assets/img/trendin-property.png" class="img-responsive">
                        </div>
                        
                      </div>
                      <div class="col">
                        <div class="portfolio-list-inner">
                          <p class="">Property Name</p>
                          <h5 class="">Avenue Apartment</h5>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner">
                      <p class="">Country</p>
                      <h5 class="">New Zealand</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner">
                      <p class="">City</p>
                      <h5 class="">Auckland</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner">
                      <p class="">Annual Income</p>
                      <h5 class="">$30,000</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner text-center">
                      <p class="">Market Value (E)</p>
                      <h5 class="">$600,000</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner text-center">
                      <p class="">Gross Yield</p>
                      <h5 class="">5%</h5>
                    </div>
                  </td>
                  <td class="align-middle">
                      <div class="list-view-action">
                        <div class="d-inline-block">
                          <input type="checkbox" class="check property-check" name="">
                        </div>
                        <div class="dropdown portfolio-dropdown d-inline-block">
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
                  </td>
                </tr>
                <tr>
                  <td align="top">
                    <div class="row no-gutters">
                      <div class="col-auto pr-2">
                        <div class="">
                           <img src="assets/img/trendin-property.png" class="img-responsive">
                        </div>
                        
                      </div>
                      <div class="col">
                        <div class="portfolio-list-inner">
                          <p class="">Property Name</p>
                          <h5 class="">Avenue Apartment</h5>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner">
                      <p class="">Country</p>
                      <h5 class="">New Zealand</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner">
                      <p class="">City</p>
                      <h5 class="">Auckland</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner">
                      <p class="">Annual Income</p>
                      <h5 class="">$30,000</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner text-center">
                      <p class="">Market Value (E)</p>
                      <h5 class="">$600,000</h5>
                    </div>
                  </td>
                  <td>
                    <div class="portfolio-list-inner text-center">
                      <p class="">Gross Yield</p>
                      <h5 class="">5%</h5>
                    </div>
                  </td>
                  <td class="align-middle">
                      <div class="list-view-action">
                        <div class="d-inline-block">
                          <input type="checkbox" class="check property-check" name="">
                        </div>
                        <div class="dropdown portfolio-dropdown d-inline-block">
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
                  </td>
                </tr> 
              </table>
            </div>
         </div>
         <!-- End Portfolio Property Grid View -->
      </div>
   </div>
   <!-- Reserve , Favourite Propert , Favourite Project  Tabs-->
  <div class="card m-t-3">
    <div class="card-header py-0">
      <div class="row">
        <div class="col-md-8">
          <nav class="card-tab">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">My Reserved Property(s)</a>
              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">My Favourite Property(s)</a>
              <a class="nav-item nav-link" id="nav-Project-tab" data-toggle="tab" href="#nav-Project" role="tab" aria-controls="nav-Project" aria-selected="false">My Favourite Project(s) </a>
            </div>
          </nav>
        </div>
      </div>
    </div>
    
    <div class="tab-content card-body" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <?php
               $cond1=" and pd.reserved_by='".$LoginUserId."' ";
               \Property\PropertyClass::Init();
               $rows1 = \Property\PropertyClass::GetPropertiesDatas('','',$cond1);
               $j = 1;
               foreach ($rows1 as $row1)
               {
                $effective_date=$row1["effective_date"];
                $projectName=$row1["project_name"];
                $country=$row1["country"];
                $CountryCodeNew=$row1["Country_Code_New"];
                $ProjectIdd=$row1["project_id"];
                $floortype=$row1["floor_type"];
                $CountryName=$row1["COUNTRY_NAME"];
                $Projectcurrency=$row1["currency"];
                $expiry_date=$row1["expiry_date"];
                $NoOfProperty=$row1["No_of_property"];
                $NoOfAvProperty=$row1["No_of_Av_property"];
                $image_file=$row1["image_file"];
                if($Currency==$Projectcurrency)
                {
                  $Xrate=1;
                }
                else
                {
                   $Xraterows = \Property\PropertyClass::GetCurrExrate($Projectcurrency,$Currency);
                   $j = 1;
                   foreach ($Xraterows as $Xraterow)
                   {
                       $Xrate=$Xraterow["RATE"];
                   }
                }
                if($Xrate=="" || $Xrate==null){
                  $Xrate=1;
                }
                  //echo $Xrate;
                $date = date("Y-m-d h:i:s");
                $effective_date1 = strtotime($effective_date);
                $expiry_date1 = strtotime($expiry_date);
                $date1 = strtotime($date);
                $diff = abs($expiry_date1 - $date1);
                
                //sahil code
                    $createDate = new DateTime($expiry_date);
                    $strip = $createDate->format('Y-m-d');
                    //end here
    
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24)
                                                 / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 -
                               $months*30*60*60*24)/ (60*60*24));
    
                $days1 = floor(($diff - $years * 365*60*60*24)/ (60*60*24));
                $hours = floor(($diff - $years * 365*60*60*24
                         - $months*30*60*60*24 - $days*60*60*24)
                                                     / (60*60));
                $minutes = floor(($diff - $years * 365*60*60*24
                           - $months*30*60*60*24 - $days*60*60*24
                                            - $hours*60*60)/ 60);
                $seconds = floor(($diff - $years * 365*60*60*24
                           - $months*30*60*60*24 - $days*60*60*24
                                  - $hours*60*60 - $minutes*60));
                if($Currency=="NZD"){
                    $Prefix="NZ $";
                }
                elseif($Currency=="AUD"){
                    $Prefix="AU $";
                }
                elseif($Currency=="GBP"){
                    $Prefix="£";
                }
                else
                {
                    $Prefix=$Currency." ";
                }

               ?>
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-lg-4 col-md-4">
                <div class="">
                  <h4><?php echo $projectName;?> | <?php echo $CountryName;?></h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div>
                  <ul class="inline-lists">
                    <li class="pr-3"><img src="assets/img/bed.png" class="img-fluid pr-1" alt=""> <?php echo $row1["no_of_bedrooms"];?> BED</li>
                    <li class="pr-3"><img src="assets/img/car.png" class="img-fluid pr-1" alt=""> <?php echo $row1["no_of_parkingspace"];?> Car park</li>
                    <li><img src="assets/img/bath.png" class="img-fluid pr-1" alt=""> <?php echo $row1["no_of_bathroom"];?> Bath</li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="text-right">
                  <p class="mb-0"><span class="fs-14">Total Property</span> <b class="t3 fw-500"><?php echo $NoOfProperty;?></b></p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-5">
                <div class="property-row">
                  <div class="property-col">
                    <div class="property-thumb">
                      <img src="<?php echo SITE_BASE_URL; ?>uploads/projectimage/<?php echo $image_file; ?>" class="img-fluid" alt="">
                    </div>
                  </div>
                  <div class="property-col">
                      <div class="property-details">
                          <div class="detail-list mb-3 bg-box bg-light-warning fw-500">
                            <div class="col-first">Retail Asking Price</div>
                            <span><?php echo $Prefix." ".number_format(round($row1["start_rate"]*$Xrate,2));?></span>
                          </div>
                          <div class="detail-list mb-3 mb-3 bg-box bg-light-danger fw-500">
                            <div class="col-first">Current Price</div>
                            <span><?php echo $Prefix." ".number_format(round($row1["dynamic_rate"]*$Xrate,2));?></span>
                          </div>
                          <div class="detail-list mb-3 mb-3 bg-box bg-light-primary fw-500">
                            <div class="col-first">Discount</div>
                            <span><?php echo $Prefix." ".number_format(round(($row1["lockin_rate"]-$row1["dynamic_rate"])*$Xrate,2));?></span>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-7">
                <div class="row">
                  <div class="col-md-8">
                    <div class="prop-info">
                      <p class="text-two fw-500">Du Val Dynamic Price</p>
                      <h4 class="text-lg-one fw-600 text-right"><?php echo $Prefix." ".number_format(round($row1["dpo_rate"]*$Xrate,2));?></h4>
                      <div class="">
                        <!-- Strike Price Chart -->
                        <canvas id="lineChart<?php echo $j;?>"></canvas>
                      </div>
                      <?php
                       $DynamicRaterows = \Property\PropertyClass::GetPropertiesDynamicFlow($ProjectIdd,$row1["property_id"]);
                       $Label='[';
                       $Value='[';
                       foreach ($DynamicRaterows as $DynamicRaterow)
                       {
                           if($Label=='[')
                           {
                                $Label=$Label.(intval($DynamicRaterow["version_no"])-1);
                                $Value=$Value.$DynamicRaterow["dynamic_rate"];
                           }
                           else
                           {
                               $Label=$Label.','.(intval($DynamicRaterow["version_no"])-1);
                               $Value=$Value.','.$DynamicRaterow["dynamic_rate"];
                           }
                       }
                       $Label=$Label.']';
                       $Value=$Value.']';
                       //echo $Label.'<br>';
                       //echo $Value;
                      ?>
                      <script type="text/javascript">
                       var ctx = document.getElementById("lineChart<?php echo $j;?>");
                       ctx.height = 100;
                       var myChart = new Chart(ctx, {
                           type: 'line',
                           data: {
                               labels: <?php echo $Label;?>,
                               type: 'line',
                       
                               datasets: [{
                                   label: "Property Status)",
                                    borderColor: "#ED6161",
                                    borderWidth: 1,
                                    pointBorderWidth: 5,
                                    pointHoverRadius: 5,
                                    borderDash: [5,3],
                                    backgroundColor: ["#85BE1A"],
                                    data: <?php echo $Value;?>,
                                    fill: false,
                               }]
                           },
                           options: {
                               responsive: true,
                               tooltips: {
                                   enabled: false,
                               },
                               legend: {
                                   display: false,
                                   labels: {
                                       usePointStyle: false,
                       
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
                                           display: false,
                                           labelString: 'Month'
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
                                           labelString: 'Value'
                                       }
                                   }]
                               },
                               title: {
                                   display: false,
                               }
                           }
                       });
                    
                    </script>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="prop-info">
                      <div class="h4 mb-15 fs-14">Closing In</div>
                      <div class="">
                          <div class="timer-wrapper">
                            <div data-countdown="<?php echo $strip ?>" class="count-skin"></div>
                          </div>
                        </div>
                      <p class="text-center"><small>Until Release to the Market</small></p>

                      <div class="meter bg-danger">
                        <span class="" style="width:70%; background-color: #C70000"></span>
                      </div>
                      <div class="progress-text mt-3">
                        <h5 class="text-left text-three text-red1 pull-left">Reserved <span><?php echo floatval($NoOfProperty-$NoOfAvProperty);?></span></h5> <h5 class="text-right text-three text-red2 pull-right">Available <span><?php echo $NoOfAvProperty;?></span></h5>
                      </div>

                      <div class="prop-action">
                        <a class="btn btn-success" href="<?php echo SITE_BASE_URL; ?>Property/PropertyFullDtl.html?id=<?php echo $row1["property_id"]; ?>" title="">Analyse Property</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
           $j=$j+1;
           }
           if($j==1)
           {
               echo '<div class="card-header">No Records</div>';
           }
           ?>
      </div>
      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        <?php
               $condFav=" and pd.property_id in (Select property_id from Add_favorite_property where user_id='".$LoginUserId."') ";
               \Property\PropertyClass::Init();
               $rows1 = \Property\PropertyClass::GetPropertiesDatas('','',$condFav);
               $k = 1;
               foreach ($rows1 as $row1)
               {
                $effective_date=$row1["effective_date"];
                $projectName=$row1["project_name"];
                $country=$row1["country"];
                $CountryCodeNew=$row1["Country_Code_New"];
                $ProjectIdd=$row1["project_id"];
                $floortype=$row1["floor_type"];
                $CountryName=$row1["country_name"];
                $Projectcurrency=$row1["currency"];
                $expiry_date=$row1["expiry_date"];
                $NoOfProperty=$row1["No_of_property"];
                $NoOfAvProperty=$row1["No_of_Av_property"];
                $image_file=$row1["image_file"];
                if($Currency==$Projectcurrency)
                {
                  $Xrate=1;
                }
                else
                {
                   $Xraterows = \Property\PropertyClass::GetCurrExrate($Projectcurrency,$Currency);
                   $j = 1;
                   foreach ($Xraterows as $Xraterow)
                   {
                       $Xrate=$Xraterow["RATE"];
                   }
                }
                if($Xrate=="" || $Xrate==null){
                  $Xrate=1;
                }
                  //echo $Xrate;
                $date = date("Y-m-d h:i:s");
                $effective_date1 = strtotime($effective_date);
                $expiry_date1 = strtotime($expiry_date);
                $date1 = strtotime($date);
                $diff = abs($expiry_date1 - $date1);
                
                //sahil code
                $createDate = new DateTime($expiry_date);
                $strip = $createDate->format('Y-m-d');
                //end here
    
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24)
                                                 / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 -
                               $months*30*60*60*24)/ (60*60*24));
    
                $days1 = floor(($diff - $years * 365*60*60*24)/ (60*60*24));
                $hours = floor(($diff - $years * 365*60*60*24
                         - $months*30*60*60*24 - $days*60*60*24)
                                                     / (60*60));
                $minutes = floor(($diff - $years * 365*60*60*24
                           - $months*30*60*60*24 - $days*60*60*24
                                            - $hours*60*60)/ 60);
                $seconds = floor(($diff - $years * 365*60*60*24
                           - $months*30*60*60*24 - $days*60*60*24
                                  - $hours*60*60 - $minutes*60));
                if($Currency=="NZD"){
                    $Prefix="NZ $";
                }
                elseif($Currency=="AUD"){
                    $Prefix="AU $";
                }
                elseif($Currency=="GBP"){
                    $Prefix="£";
                }
                else
                {
                    $Prefix=$Currency." ";
                }

               ?>
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-lg-4 col-md-4">
                <div class="">
                  <h4><?php echo $projectName;?> | <?php echo $CountryName;?></h4>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div>
                  <ul class="inline-lists">
                    <li class="pr-3"><img src="assets/img/bed.png" class="img-fluid pr-1" alt=""> <?php echo $row1["no_of_bedrooms"];?> BED</li>
                    <li class="pr-3"><img src="assets/img/car.png" class="img-fluid pr-1" alt=""> <?php echo $row1["no_of_parkingspace"];?> Car park</li>
                    <li><img src="assets/img/bath.png" class="img-fluid pr-1" alt=""> <?php echo $row1["no_of_bathroom"];?> Bath</li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="text-right">
                  <p class="mb-0"><span class="fs-14">Total Property</span> <b class="t3 fw-500"><?php echo $NoOfProperty;?></b></p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-5">
                <div class="property-row">
                  <div class="property-col">
                    <div class="property-thumb">
                      <img src="<?php echo SITE_BASE_URL; ?>uploads/projectimage/<?php echo $image_file; ?>" class="img-fluid" alt="">
                    </div>
                  </div>
                  <div class="property-col">
                      <div class="property-details">
                          <div class="detail-list mb-3 bg-box bg-light-warning fw-500">
                            <div class="col-first">Retail Asking Price</div>
                            <span><?php echo $Prefix." ".number_format(round($row1["start_rate"]*$Xrate,2));?></span>
                          </div>
                          <div class="detail-list mb-3 mb-3 bg-box bg-light-danger fw-500">
                            <div class="col-first">Current Price</div>
                            <span><?php echo $Prefix." ".number_format(round($row1["dynamic_rate"]*$Xrate,2));?></span>
                          </div>
                          <div class="detail-list mb-3 mb-3 bg-box bg-light-primary fw-500">
                            <div class="col-first">Discount</div>
                            <span><?php echo $Prefix." ".number_format(round(($row1["lockin_rate"]-$row1["dynamic_rate"])*$Xrate,2));?></span>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-7">
                <div class="row">
                  <div class="col-md-8">
                    <div class="prop-info">
                      <p class="text-two fw-500">Du Val Dynamic Price</p>
                      <h4 class="text-lg-one fw-600 text-right"><?php echo $Prefix." ".number_format(round($row1["dpo_rate"]*$Xrate,2));?></h4>
                      <div class="">
                        <!-- Strike Price Chart -->
                        <canvas id="lineChartFav<?php echo $k;?>"></canvas>
                      </div>
                      <?php
                       $DynamicRaterows = \Property\PropertyClass::GetPropertiesDynamicFlow($ProjectIdd,$row1["property_id"]);
                       $Label='[';
                       $Value='[';
                       foreach ($DynamicRaterows as $DynamicRaterow)
                       {
                           if($Label=='[')
                           {
                                $Label=$Label.(intval($DynamicRaterow["version_no"])-1);
                                $Value=$Value.$DynamicRaterow["dynamic_rate"];
                           }
                           else
                           {
                               $Label=$Label.','.(intval($DynamicRaterow["version_no"])-1);
                               $Value=$Value.','.$DynamicRaterow["dynamic_rate"];
                           }
                       }
                       $Label=$Label.']';
                       $Value=$Value.']';
                       //echo $Label.'<br>';
                       //echo $Value;
                      ?>
                      <script type="text/javascript">
                       var ctx = document.getElementById("lineChartFav<?php echo $k;?>");
                       ctx.height = 100;
                       var myChart = new Chart(ctx, {
                           type: 'line',
                           data: {
                               labels: <?php echo $Label;?>,
                               type: 'line',
                       
                               datasets: [{
                                   label: "Property Status)",
                                    borderColor: "#ED6161",
                                    borderWidth: 1,
                                    pointBorderWidth: 5,
                                    pointHoverRadius: 5,
                                    borderDash: [5,3],
                                    backgroundColor: ["#85BE1A"],
                                    data: <?php echo $Value;?>,
                                    fill: false,
                               }]
                           },
                           options: {
                               responsive: true,
                               tooltips: {
                                   enabled: false,
                               },
                               legend: {
                                   display: false,
                                   labels: {
                                       usePointStyle: false,
                       
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
                                           display: false,
                                           labelString: 'Month'
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
                                           labelString: 'Value'
                                       }
                                   }]
                               },
                               title: {
                                   display: false,
                               }
                           }
                       });
                    
                    </script>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="prop-info">
                      <div class="h4 mb-15 fs-14">Closing In</div>
                      <div class="">
                          <div class="timer-wrapper">
                            <div data-countdown="<?php echo $strip ?>" class="count-skin"></div>  
                            <!--<div class="days-wrap timer-inner">-->
                            <!--  <div class="timer-skin-sm"><?php //echo $days1;?></div>-->
                            <!--  <span class="text-sm">Days</span>-->
                            <!--</div>-->
                            <!--<div class="hour-wrap timer-inner">-->
                            <!--  <div class="timer-skin-sm"><?php //echo $hours;?></div>-->
                            <!--  <span class="text-sm">Hours</span>-->
                            <!--</div>-->
                            <!--<div class="minute-wrap timer-inner">-->
                            <!--   <div class="timer-skin-sm"><?php //echo $minutes;?></div>-->
                            <!--   <span class="text-sm">Mins</span>-->
                            <!--</div>-->
                            <!--<div class="second-wrap timer-inner">-->
                            <!--  <div class="timer-skin-sm"><?php //echo $seconds;?></div>-->
                            <!--  <span class="text-sm">Secs</span>-->
                            <!--</div>-->
                          </div>
                        </div>
                      <p class="text-center"><small>Until Release to the Market</small></p>

                      <div class="meter bg-danger">
                        <span class="" style="width:70%; background-color: #C70000"></span>
                      </div>
                      <div class="progress-text mt-3">
                        <h5 class="text-left text-three text-red1 pull-left">Reserved <span><?php echo floatval($NoOfProperty-$NoOfAvProperty);?></span></h5> <h5 class="text-right text-three text-red2 pull-right">Available <span><?php echo $NoOfAvProperty;?></span></h5>
                      </div>

                      <div class="prop-action">
                        <a class="btn btn-success" href="<?php echo SITE_BASE_URL; ?>Property/PropertyFullDtl.html?id=<?php echo $row1["property_id"]; ?>" title="">Analyse Property</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
           $k=$k+1;
           $j=$j+1;
           }
           if($k==1)
           {
               echo '<div class="card-header">No Records</div>';
           }
           ?>
      </div>
      <div class="tab-pane fade" id="nav-Project" role="tabpanel" aria-labelledby="nav-Project-tab">
          
        <?php
        $condFavPj=" AND pj.project_id in (Select project_id from Add_favorite_project where user_id='".$LoginUserId."') ";
        $rowFavs = \Property\PropertyClass::GetPorjectDatas('','',$condFavPj);
        $p = 1;
        foreach ($rowFavs as $rowFav)
        {
            $rowFavsells = \Property\PropertyClass::ProjectSellingDtl($rowFav["PROJECT_ID"]);
            $effective_date=$rowFav["effective_date"];
            $Country=$rowFav["country_name"];
            $CountryCodeNew=$row["Country_Code_New"];
            $expiry_date=$rowFav["expiry_date"];
            $date = date("Y-m-d h:i:s");
            $effective_date1 = strtotime($effective_date);
            $expiry_date1 = strtotime($expiry_date);
            $date1 = strtotime($date);
            $diff = abs($expiry_date1 - $date1);
            
            //sahil code
            $createDate = new DateTime($expiry_date);
            $strip = $createDate->format('Y-m-d');
            //end here

            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24)
                                           / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 -
                         $months*30*60*60*24)/ (60*60*24));
            $days1 = floor(($diff - $years * 365*60*60*24 )/ (60*60*24));

            $hours = floor(($diff - $years * 365*60*60*24
                   - $months*30*60*60*24 - $days*60*60*24)
                                               / (60*60));
            $minutes = floor(($diff - $years * 365*60*60*24
                     - $months*30*60*60*24 - $days*60*60*24
                                      - $hours*60*60)/ 60);
            $seconds = floor(($diff - $years * 365*60*60*24
                     - $months*30*60*60*24 - $days*60*60*24
                            - $hours*60*60 - $minutes*60));
                foreach ($rowFavsells as $rowFavsell)
                {
                    $reservedCount=$rowFavsell["reserved_count"];
                    $soldCount=$rowFavsell["sold_count"];
                    $totalCount=$rowFavsell["total_count"];
                    $AvailableCount=$totalCount-$reservedCount;
                    $Start_dynamin_price=$rowFavsell["Start_dynamin_price"];
                    $one_bet=$rowFavsell["one_bet"];
                    $two_bet=$rowFavsell["two_bet"];
                    $three_bet=$rowFavsell["three_bet"];
                    $Weekly_rent=$rowFavsell["Weekly_rent"];
                    $Projcurr=$rowFav["currency"];
                    if($Currency=="NZD"){
                        $Prefix="NZ $";
                    }
                    elseif($Currency=="AUD"){
                        $Prefix="AU $";
                    }
                    elseif($Currency=="GBP"){
                        $Prefix="£";
                    }
                    else
                    {
                        $Prefix=$Currency." ";
                    }
                    //echo "====>".$Prefix;
                    if($totalCount=='' ||$totalCount=='0' || $totalCount==null)
                    {
                        $totalCount=1;
                    }
                    if($Currency==$Projcurr)
                      {
                          $Xrate=1;
                      }
                      else
                      {
                           $Xraterows = \Property\PropertyClass::GetCurrExrate($Projcurr,$Currency);
                           $j = 1;
                           foreach ($Xraterows as $Xraterow)
                           {
                               $Xrate=$Xraterow["RATE"];
                           }
                      }
                      if($Xrate=="" || $Xrate==null){
                          $Xrate=1;
                      }
                }
                ?>  
        <div class="trending-project mb-3">
            <div class="trending-project-thumb">
              <img src="<?php echo SITE_BASE_URL; ?>uploads/projectimage/<?php echo $rowFav["image_file"];?>" alt="" class="img-fluid">
            </div>
            <div class="trending-project-details">
               <div class="project-title">
                  <h4 class="float-left"><?php echo $rowFav["PROJECT_NAME"];?></h4>
                  <h4 class="float-right"><?php echo $Country;?></h4>
                  <div class="clearfix"></div>
                </div>

                <div class="row">
                    <div class="col-lg-5 col-md-5">
                      <div class="project-details-inner">
                          <div class="d-flex justify-content-start trend-row">
                            <div class="ternding-first-col"><h4>Start Price</h4></div>
                            <div class="ternding-last-col"><h4><?php echo $Prefix." ".round($Start_dynamin_price*$Xrate);?></h4></div>
                          </div> 
                          <div class="d-flex justify-content-start trend-row">
                          <div class="ternding-first-col"><h4>Reserved</h4></div>
                          <div class="price-progressbar ternding-last-col">
                            <p class="progress-label" style="width:<?php echo round(($reservedCount/$totalCount)*100);?>%" data-value="<?php echo round(($reservedCount/$totalCount)*100);?>"><?php echo $reservedCount;?></p>
                            <progress max="100" value="<?php echo round(($reservedCount/$totalCount)*100);?>" class="price-progress">
                                <div class="progress-bar">
                                    <span style="width: <?php echo round(($reservedCount/$totalCount)*100);?>%"><?php $reservedCount?></span>
                                </div>
                            </progress>
                          </div>
                        </div> 
                        <div class="d-flex justify-content-start trend-row">
                          <div class="ternding-first-col"><h4>Time Left</h4></div>
                          <div class="timer-wrapper ternding-last-col">
                              <div data-countdown="<?php echo $strip ?>" class="count-skin"></div>
                            <!--<div class="days-wrap timer-inner">-->
                            <!--  <div class="timer-skin-sm"><?php //echo $days1;?></div>-->
                            <!--  <span class="text-sm">Days</span>-->
                            <!--</div>-->
                            <!--<div class="hour-wrap timer-inner">-->
                            <!--  <div class="timer-skin-sm"><?php //echo $hours;?></div>-->
                            <!--  <span class="text-sm">Hours</span>-->
                            <!--</div>-->
                            <!--<div class="minute-wrap timer-inner">-->
                            <!--   <div class="timer-skin-sm"><?php //echo $minutes;?></div>-->
                            <!--   <span class="text-sm">Mins</span>-->
                            <!--</div>-->
                            <!--<div class="second-wrap timer-inner">-->
                            <!--  <div class="timer-skin-sm"><?php //echo $seconds;?></div>-->
                            <!--  <span class="text-sm">Secs</span>-->
                            <!--</div>-->
                          </div>
                        </div>
                     </div>
                    </div>
                    <div class="col-lg-5 col-md-4 p-0">
                       <div class="d-flex justify-content-between flex-wrap">
                          <div class="widget-one">
                             <div class="row no-gutters">
                                <div class="col-6 align-self-end">
                                   <img src="assets/img/bed.png" class="img-fluid" alt=""><br>
                                   <p>1 Bedroom</p>
                                </div>
                                <div class="col-6 text-right">
                                   <h2><?php echo $one_bet;?></h2>
                                   <p>Available</p>
                                </div>
                             </div>
                          </div>
                          <div class="widget-one">
                             <div class="row no-gutters">
                                <div class="col-6 align-self-end">
                                   <img src="assets/img/bed.png" class="img-fluid" alt=""><br>
                                   <p>2 Bedroom</p>
                                </div>
                                <div class="col-6 text-right">
                                   <h2><?php echo $two_bet;?></h2>
                                   <p>Available</p>
                                </div>
                             </div>
                          </div>
                          <div class="widget-one">
                             <div class="row no-gutters">
                                <div class="col-6 align-self-end">
                                   <img src="assets/img/bed.png" class="img-fluid" alt=""><br>
                                   <p>3 Bedroom</p>
                                </div>
                                <div class="col-6 text-right">
                                   <h2><?php echo $three_bet;?></h2>
                                   <p>Available</p>
                                </div>
                             </div>
                          </div>
                          <div class="widget-one">
                             <div class="row no-gutters">
                                <div class="col-3 align-self-end">
                                </div>
                                <div class="col-9 text-right">
                                   <h2><?php echo $days1;?></h2>
                                   <p>Days Left</p>
                                </div>
                             </div>
                          </div>
                          <div class="widget-one">
                             <div class="row no-gutters">
                                <div class="col-2 align-self-end">
                                </div>
                                <div class="col-10 text-right">
                                   <h2><?php echo $Weekly_rent." ".$Projcurr;?></h2>
                                   <p>Estimated Weekly Rent</p>
                                </div>
                             </div>
                          </div>
                          <div class="widget-one">
                             <div class="row no-gutters">
                                <div class="col-3 align-self-end">
                                </div>
                                <div class="col-9 text-right">
                                   <h2>8%</h2>
                                   <p>Estimated Yield</p>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                      <div class="trending-project-action">
                        <h4>Status</h4>
                        <ul class="status-list">
                          <li <?php if($AvailableCount>0){?>class="active"<?php }?> >Available</li>
                          <li <?php if($AvailableCount<1){?>class="active"<?php }?>>Not Available</li>
                        </ul>
                        <a href="<?php echo SITE_BASE_URL;?>Property/ProjectView.html?project_id=<?php echo $rowFav["PROJECT_ID"];?>" class="btn btn-action mt-4">Take Action</a>
                        </div> 
                    </div>
                </div>
            </div>
          </div>
        <?php
         $p=$p+1;
         }if($p==1)
         {
             echo "<div><b>No Records</b></div>";
         }
         ?>  
          
      </div>
    </div>
  </div>
  <!-- End Reserve , Favourite Propert , Favourite Project  Tabs-->
</form>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css">
<?php include"footer.php"; ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
     $('#lightSlider').lightSlider({
         item:4,
         loop:false,
         slideMove:1,
         easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
         slideMargin:15,
         speed:600,
         enableDrag:false,
         responsive : [
             {
                 breakpoint:800,
                 settings: {
                     item:3,
                     slideMove:1,
                     slideMargin:4,
                   }
             },
             {
                 breakpoint:480,
                 settings: {
                     item:2,
                     slideMove:1,
                     slideMargin:4,
                   }
             }
         ]
     });
   });
</script>
<!-- owl crousal -->
<!-- dataTables -->
<script src="assets/plugins/datatables/datatables.min.js"></script>
<script src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/jszip.min.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/pdfmake.min.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/datatables-init.js"></script>
<script>
   $('.data-table').dataTable({
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       // dom: 'Bfrtip',
       // buttons: [
       //     'excelHtml5',
       //     'csvHtml5',
       //     'pdfHtml5'
       // ]
   });
   
   $('.data-table2').dataTable({
       "lengthMenu": [[5, 15, 50, -1], [5, 15, 50, "All"]],
       // dom: 'Bfrtip',
       // buttons: [
       //     'excelHtml5',
       //     'csvHtml5',
       //     'pdfHtml5'
       // ]
   });
</script>





<script>
$(document).ready(function(){
    
      $('#listView').hide();
      $('#list_view').on('click',
        function() {
          $('#listView').fadeIn(1500);
          $('#gridView').fadeOut(700);
        });

      $('#grid_view').on('click',
        function() {
          $('#listView').fadeOut(700);
          $('#gridView').fadeIn(1500);
      });  

});
</script>

<script src="assets/plugins/jquery.countdown-2.0.4/jquery.countdown.min.js"></script>
<script>
  $('[data-countdown]').each(function() {
  var $this = $(this), finalDate = $(this).data('countdown');
  $this.countdown(finalDate, function(event) {
    $this.html(event.strftime(''
    + '<div><span>%d</span> <p>days</p></div>'
    + '<div><span>%H</span> <p>hours</p></div>'
    + '<div><span>%M</span> <p>min</p></div>'));
  });
});
</script>