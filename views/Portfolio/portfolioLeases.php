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
                  <img src="<?php echo SITE_BASE_URL;?>assets/img/arrears-icon.png"><br><span>Arrears</span></a></li>
               <li class="nav-item"><a class="nav-link" href="portfolioLeases.html"><img src="<?php echo SITE_BASE_URL;?>assets/img/leases.png"><br><span>Leases</span></a></li>
               <li class="nav-item"><a class="nav-link" href="portfolioVacancies.html"><img src="<?php echo SITE_BASE_URL;?>assets/img/vacancies.png"><br><span>Vacancies</span></a></li>
               <li class="nav-item"><a class="nav-link" href="portfolioAccounts.html"><img src="<?php echo SITE_BASE_URL;?>assets/img/accounts.png"><br><span>Accounts</span></a></li>
               <li class="nav-item"><a class="nav-link" href="portfolioAgency.html"><img src="<?php echo SITE_BASE_URL;?>assets/img/agency.png"><br><span>Agency</span></a></li>
            </ul>
         </div>
      </div>
   </div>


   <div class="row no-gutters">
      <!-- Leases Chart -->
      <div class="col-3 col-xxl-3 equal-h-card mb-5">
         <div class="card-nav" id="fullscreen">
            <nav class="navbar navbar-expand-sm bg-b1">
              <ul class="navbar-nav mr-auto">
                <li class="nav-list">
                  <a class="nav-link" href="#">Leases</a>
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">
                <li class="nav-list">
                  <a class="nav-link requestfullscreen" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/maxmize-icon.png" alt="Maximize"></a><a href="#" class="exitfullscreen" style="display: none"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/minimize-icon.png" alt="Maximize"></a>
                </li>
              </ul>
            </nav>
            <div id="leasesChart"></div>
         </div>
      </div>
      <!-- End Leases Chart -->

      <!-- Rent review chart -->
      <div class="col-3 col-xxl-3 equal-h-card mb-5">
         <div class="card-nav" id="fullscreen">
            <nav class="navbar navbar-expand-sm bg-b1">
              <ul class="navbar-nav mr-auto">
                <li class="nav-list">
                  <a class="nav-link" href="#">Rent Review</a>
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">
                <li class="nav-list">
                  <a class="nav-link requestfullscreen" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/maxmize-icon.png" alt="Maximize"></a><a href="#" class="exitfullscreen" style="display: none"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/minimize-icon.png" alt="Maximize"></a>
                </li>
              </ul>
            </nav>
            <div id="rentReviewChart"></div>
         </div>
      </div>
      <!-- End Rent review chart -->

      <!-- Expiring Leases -->
      <div class="col-6 col-xxl-6 equal-h-card mb-5">
         <div class="card-nav" id="fullscreen">
            <nav class="navbar navbar-expand-sm bg-b1">
              <ul class="navbar-nav mr-auto">
                <li class="nav-list">
                  <a class="nav-link" href="#">Expiring Leases</a>
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">
                <li class="nav-list">
                  <a class="nav-link requestfullscreen" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/maxmize-icon.png" alt="Maximize"></a><a href="#" class="exitfullscreen" style="display: none"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/minimize-icon.png" alt="Maximize"></a>
                </li>
              </ul>
            </nav>
            <div class="row">
               <div class="col">
                  <div id="expiringChart"></div>
               </div>
               <div class="col chart-progress align-self-center">
                  <div class="chart-progress-box">
                     <div class="progress-text">
                        <span class="progress-type">0-30 days</span>
                        <span class="progress-completed">100</span>
                     </div>
                     <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        </div>
                     </div>
                  </div>

                  <div class="chart-progress-box">
                     <div class="progress-text">
                        <span class="progress-type">31-60 days</span>
                        <span class="progress-completed">60</span>
                     </div>
                     <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        </div>
                     </div>
                  </div>

                  <div class="chart-progress-box">
                     <div class="progress-text">
                        <span class="progress-type">61-90 days</span>
                        <span class="progress-completed">60</span>
                     </div>
                     <div class="progress">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        </div>
                     </div>
                  </div>
        

               </div>
            </div>
         </div>
      </div>
      <!-- End Expiring Leases -->

      <!-- Upcoming Rent Review Chart -->
      <div class="col-6 col-xxl-6 equal-h-card mb-5">
         <div class="card-nav" id="fullscreen">
            <nav class="navbar navbar-expand-sm bg-b1">
              <ul class="navbar-nav mr-auto">
                <li class="nav-list">
                  <a class="nav-link" href="#">Up coming Rent Review</a>
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">
                <li class="nav-list">
                  <a class="nav-link requestfullscreen" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/maxmize-icon.png" alt="Maximize"></a><a href="#" class="exitfullscreen" style="display: none"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/minimize-icon.png" alt="Maximize"></a>
                </li>
              </ul>
            </nav>
            <div class="row">
               <div class="col">
                  <div id="upRentChart"></div>
               </div>
               <div class="col chart-progress align-self-center">
                  <div class="chart-progress-box">
                     <div class="progress-text">
                        <span class="progress-type">0-30 days</span>
                        <span class="progress-completed">100</span>
                     </div>
                     <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        </div>
                     </div>
                  </div>

                  <div class="chart-progress-box">
                     <div class="progress-text">
                        <span class="progress-type">31-60 days</span>
                        <span class="progress-completed">60</span>
                     </div>
                     <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        </div>
                     </div>
                  </div>

                  <div class="chart-progress-box">
                     <div class="progress-text">
                        <span class="progress-type">61-90 days</span>
                        <span class="progress-completed">60</span>
                     </div>
                     <div class="progress">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        </div>
                     </div>
                  </div>
        

               </div>
            </div>      
         </div>
      </div>
      <!-- End Expiring Leases -->

      <!-- Expired Leases -->
      <div class="col-6 col-xxl-6 equal-h-card mb-5">
         <div class="card-nav" id="fullscreen">
            <nav class="navbar navbar-expand-sm bg-b1">
              <ul class="navbar-nav mr-auto">
                <li class="nav-list">
                  <a class="nav-link" href="#">Expired Leases</a>
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">
                <li class="nav-list">
                  <a class="nav-link requestfullscreen" href="#"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/maxmize-icon.png" alt="Maximize"></a><a href="#" class="exitfullscreen" style="display: none"><img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/minimize-icon.png" alt="Maximize"></a>
                </li>
              </ul>
            </nav>
            <div class="row">
               <div class="col">
                  <div id="expiredLeasesChart"></div>
               </div>
               <div class="col chart-progress align-self-center">
                  <div class="chart-progress-box">
                     <div class="progress-text">
                        <span class="progress-type">0-30 days</span>
                        <span class="progress-completed">100</span>
                     </div>
                     <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        </div>
                     </div>
                  </div>

                  <div class="chart-progress-box">
                     <div class="progress-text">
                        <span class="progress-type">31-60 days</span>
                        <span class="progress-completed">60</span>
                     </div>
                     <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        </div>
                     </div>
                  </div>

                  <div class="chart-progress-box">
                     <div class="progress-text">
                        <span class="progress-type">61-90 days</span>
                        <span class="progress-completed">60</span>
                     </div>
                     <div class="progress">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        </div>
                     </div>
                  </div>
        

               </div>
            </div>
         </div>
      </div>
      <!-- End Expiring Leases -->
   </div>
</div>
<!-- end main content -->
<?php include"footer.php"; ?>