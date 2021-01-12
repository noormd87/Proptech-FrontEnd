<?php include "header.php"; ?>
<!-- Breadcrumb area --->
<div class="breadcrumb-area">
   <nav aria-label="breadcrumb" role="navigation">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="index.php">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page">Portfolio</li>
      </ol>
   </nav>
</div>
<!-- end breadcrumb area-->
<!-- main content -->
<div class="content">
   <div class="row">
      <div class="col-12">
         <div class="porfolio-navbar">
            <ul class="nav nav-pills nav-justified">
               <li class="nav-item"><a class="nav-link active" href="portfolio.html">
                  <img src="<?php echo SITE_BASE_URL;?>assets/img/arrears-icon.png"><br><span>Arrears</span></a>
               </li>
               <li class="nav-item"><a class="nav-link" href="portfolioLeases.html"><img src="<?php echo SITE_BASE_URL;?>assets/img/leases.png"><br><span>Leases</span></a></li>
               <li class="nav-item"><a class="nav-link" href="portfolioVacancies.html"><img src="<?php echo SITE_BASE_URL;?>assets/img/vacancies.png"><br><span>Vacancies</span></a></li>
               <li class="nav-item"><a class="nav-link" href="portfolioAccounts.html"><img src="<?php echo SITE_BASE_URL;?>assets/img/accounts.png"><br><span>Accounts</span></a></li>
               <li class="nav-item"><a class="nav-link" href="portfolioAgency.html"><img src="<?php echo SITE_BASE_URL;?>assets/img/agency.png"><br><span>Agency</span></a></li>
            </ul>
         </div>
      </div>
   </div>
   <form class="add_property" name=form1 action="<?php echo SITE_BASE_URL;?>Portfolio/SaveProperty.html" method="post" enctype="multipart/form-data">
       <input name=formcount value=0 type=hidden />
      <section class="panel-section">
         <div class="panel panel-primary">
            <div class="panel-heading clearfix">Tags
               <div class="pull-right">
                  <a class="collapse-btn" data-toggle="collapse" data-target="#tags"
                  aria-expanded="false" aria-controls="tags"><i class="fas fa-minus-circle"></i></a>
               </div>
            </div>
            <div class="panel-body collapse show" id="tags">
               <div class="form-group">
                  <label>Property Area</label>
                  <select class="form-control">
                     <option>none</option>
                  </select>
               </div>
            </div>
         </div>
      </section>

      <section class="panel-section">
         <div class="panel panel-secondary">
            <div class="panel-heading clearfix">Ownership
               <div class="pull-right">
                  <a class="collapse-btn" data-toggle="collapse" data-target="#ownership"
                  aria-expanded="false" aria-controls="ownership"><i class="fas fa-minus-circle"></i></a>
               </div>
            </div>
            <div class="panel-body collapse show" id="ownership">
               <div class="form-group">
                  <label>Select on Ownership</label>
                  <select class="form-control">
                     <option>None</option>
                  </select>
               </div>
            </div>
         </div>
      </section>
      
      <section class="panel-section">   
         <div class="panel panel-primary">
            <div class="panel-heading clearfix">Property information  &nbsp;<a   href='<?php echo SITE_BASE_URL;?>Portfolio/PropertyView.html'>View Property</a>
               <div class="pull-right">
                  <a class="collapse-btn" data-toggle="collapse" data-target="#propertyInfo"
                  aria-expanded="false" aria-controls="propertyInfo"><i class="fas fa-minus-circle"></i></a>
               </div>
            </div>
            <div class="panel-body collapse show" id="propertyInfo">
               <div class="row">
                        <div class="col-3">
                           <div class="input-box">
                              <div class="radio-group">
                                 <div class="radio radio-primary">
                                    <input type="radio" name="payment_run" id="paymentRun" value="all" checked>
                                    <label for="paymentRun">
                                    Residential
                                    </label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="input-box">
                              <div class="radio-group">
                                 <div class="radio radio-primary">
                                    <input type="radio" name="ownership" id="ownership" value="all">
                                    <label for="ownership">
                                    Commercial
                                    </label>
                                 </div>
                              </div>
                           </div>
                        </div>


                        <div class="col-12">
                           <div class="form-group">
                              <label>Search</label>
                              <div class="input-group">
                                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                  <span class="input-group-text" id="basic-text1"><i class="fas fa-search"
                                      aria-hidden="true"></i></span>
                                </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-6">
                           <div class="form-group">
                              <label>Unit No.</label>
                              <input type="text" class="form-control" name="UnitNo">
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                              <label>Street No.</label>
                              <input type="text" class="form-control" name="StreetNo">
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="form-group">
                              <label>City</label>
                              <input type="text" class="form-control" name="City">
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                              <label>State</label>
                              <input type="text" class="form-control" name="State">
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                              <label>Pincode</label>
                              <input type="text" class="form-control" name="Pincode">
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="form-group">
                              <label>Property Type</label>
                              <select class="form-control input-lg" name="PropertyType">
                                 <option>Select your property</option>
                                 <?php
                                    \Portfolio\PortfolioClass::Init();
                                    $rows = \Portfolio\PortfolioClass::GetPropertyTypeDatas();
                                    $i = 1;
                                    foreach ($rows as $row) 
                                    {
                                    ?>
                                    <option value=<?php echo $row["property_type_id"];?>><?php echo $row["property_type"];?></option>
                                     <?php
                                    }?> 
                              </select>
                              <i class="fas fa-chevron-down"></i>
                           </div>
                        </div>

                        <div class="col-4">
                           <div class="form-group">
                              <label>Bedroom</label>
                              <div class="input-icon input-icon-group">
                                 <input class="bedroom-input" type="text" value="" name="Bedroom" id="Bedroom">
                              </div>
                           </div>
                        </div>
                        <div class="col-4">
                           <div class="form-group">
                              <label>Bathroom</label>
                              <div class="input-icon input-icon-group">
                                 <input class="bathroom-input" type="text" value="" name="Bathroom" id="Bathroom">
                              </div>
                           </div>
                        </div>
                        <div class="col-4">
                           <div class="form-group">
                              <label>Carspace</label>
                              <div class="input-icon input-icon-group">
                                 <input class="carpark-input" type="text" value="" name="Carspace" id="Carspace">
                              </div>
                           </div>
                        </div>
            </div>
         </div>
      </section>
      
      <!-- fees panel section -->
      <section class="panel-section">   
         <div class="panel panel-secondary">
            <div class="panel-heading clearfix">Fees
               <div class="pull-right">
                  <a class="collapse-btn" data-toggle="collapse" data-target="#fees"
                  aria-expanded="false" aria-controls="fees"><i class="fas fa-minus-circle"></i></a>
               </div>
            </div>
            <div class="panel-body collapse show" id="fees">
               <div class="row">
                  <div class="col-4">
                     <div class="form-group input-lg">
                        <select class="form-control">
                           <option>Inspection Fee(Inspection Closed, $34.50)</option>
                        </select>
                        <i class="fas fa-chevron-down"></i>
                     </div>
                  </div>
                  <div class="col-4 align-self-center">
                     <div class="form-group">
                      <p>Insepection Closed</p>
                    </div>
                  </div>
                  <div class="col-2">
                     <div class="form-group">
                         <input type="text" class="form-control" id="" placeholder="$350.50">
                       </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-4">
                     <div class="form-group input-lg">
                        <select class="form-control">
                           <option>Management Fee(Rent Receipted, 8.62%)</option>
                        </select>
                        <i class="fas fa-chevron-down"></i>
                     </div>
                  </div>
                  <div class="col-4 align-self-center">
                     <div class="form-group">
                      <p>Rent Receipted</p>
                    </div>
                  </div>
                  <div class="col-2">
                     <div class="form-group">
                         <input type="text" class="form-control" id="" placeholder="8.26%">
                       </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end fees panel section -->

      <div class="form-submit pull-right">
         <input class="btn btn-warning" type="submit" name="save" value="Save">
      </div>
      <div class="clearfix"></div>
   </form>
</div>
<!-- end main content -->
<?php include"footer.php"; ?>