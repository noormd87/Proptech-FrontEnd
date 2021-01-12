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
      <!-- Pay Ownership -->
      <section class="panel-section">
         <form action="" method="" enctype="multipart/form-data">
            <div class="panel panel-primary">
               <div class="panel-heading clearfix">Pay Ownership
                  <div class="pull-right">
                     <a class="collapse-btn data-toggle="collapse" data-target="#ownershipPanel"
                     aria-expanded="false" aria-controls="ownershipPanel"><i class="fas fa-minus-circle"></i></a>
                  </div>
               </div>
               <div class="panel-body collapse show" id="ownershipPanel">
                  <div class="row">
                     <div class="col-3">
                        <div class="input-box">
                           <h5>Payment Run</h5>
                           <div class="radio-group">
                              <div class="radio radio-primary">
                                 <input type="radio" name="payment_run" id="paymentRun" value="all" checked>
                                 <label for="paymentRun">
                                 Payments & Statements
                                 </label>
                              </div>
                           </div>
                           <div class="radio-group">
                              <div class="radio radio-primary">
                                 <input type="radio" name="payment_run" id="paymentRun2" value="all" checked>
                                 <label for="paymentRun2">
                                 Payments Only
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="input-box">
                           <h5>Preselect Ownership</h5>
                           <div class="radio-group">
                              <div class="radio radio-primary">
                                 <input type="radio" name="ownership" id="ownership" value="all">
                                 <label for="ownership">
                                 Owership with funds or transactions
                                 </label>
                              </div>
                           </div>
                           <div class="radio-group">
                              <div class="radio radio-primary">
                                 <input type="radio" name="ownership" id="ownership2" value="all">
                                 <label for="ownership2">
                                 Ownership with funds
                                 </label>
                              </div>
                           </div>
                           <div class="radio-group">
                              <div class="radio radio-primary">
                                 <input type="radio" name="ownership" id="ownership3" value="all" checked>
                                 <label for="ownership3">
                                 All Ownership
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-12">
                        <hr>
                        <div class="form-submit">
                           <input class="btn btn-warning" type="submit" name="save" value="Save">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </section>
      <!-- End Pay Ownership -->
      <!-- Ownership to process -->
      <section class="panel-section">
         <form action="" method="" enctype="multipart/form-data">
             <div class="panel panel-secondary">
               <div class="panel-heading clearfix">Ownership to process
                  <div class="pull-right">
                     <a class="collapse-btn" data-toggle="collapse" data-target="#ownershipProcessPanel"
                     aria-expanded="false" aria-controls="ownershipProcessPanel"><i class="fas fa-minus-circle"></i></a>
                  </div>
               </div>
               <div class="panel-body collapse show" id="ownershipProcessPanel">
                 <form>
                    <div class="table-ownership">
                        <table class="table">
                           <thead>
                              <tr>
                                 <th> 
                                    <div class="form-group">
                                       <label>This property belong to entity</label>
                                       <div class="select-group">
                                          <select class="form-select">
                                             <option>--- Select ---</option>
                                          </select>
                                       </div>
                                    </div>
                                 </th>
                                 <th>
                                    <div class="form-group">
                                       <label>Balance</label>
                                       <div class="select-group">
                                          <select class="form-select">
                                             <option>--- Select ---</option>
                                          </select>
                                       </div>
                                    </div>
                                 </th>
                                 <th>
                                    <div class="form-group">
                                       <label>Fees</label>
                                       <div class="select-group">
                                          <select class="form-select">
                                             <option>--- Select ---</option>
                                          </select>
                                       </div>
                                    </div>
                                 </th>
                                 <th>
                                    <div class="form-group">
                                       <label>Withheld</label>
                                       <div class="select-group">
                                          <select class="form-select">
                                             <option>--- Select ---</option>
                                          </select>
                                       </div>
                                    </div>
                                 </th>
                                 <th>
                                    <div class="form-group">
                                       <label>Available</label>
                                       <div class="select-group">
                                          <select class="form-select">
                                             <option>--- Select ---</option>
                                          </select>
                                       </div>
                                    </div>
                                 </th>
                                 <th>
                                     <div class="form-group">
                                       <label>Available</label>
                                       <div class="select-group">
                                          <select class="form-select">
                                             <option>--- Select ---</option>
                                          </select>
                                       </div>
                                    </div>  
                                 </th>
                                 <th>
                                    <div class="form-group">
                                       <label>Pay amount</label>
                                       <div class="select-group">
                                          <select class="form-select">
                                             <option>--- Select ---</option>
                                          </select>
                                       </div>
                                    </div>
                                 </td>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>Hilside Crossing LP</td>
                                 <td>$595.00</td>
                                 <td>-$53.61</td>
                                 <td>$0.00</td>
                                 <td>-$53.61</td>
                                 <td>$595.00</td>
                                 <td>-$53.61</td>
                                 <td><a  class="delete_row" href=""><i class="fa fa-times-circle-o" aria-hidden="true"></i></a></td>
                              </tr>
                              <tr>
                                 <td>Investment Portfolio Management LP</td>
                                 <td>$35,975.50</td>
                                 <td>-$3,277.47</td>
                                 <td>-$320.75</td>
                                 <td>-$3,277.47</td>
                                 <td>$35,975.50</td>
                                 <td>-$3,277.47</td>
                                 <td><a  class="delete_row" href=""><i class="fa fa-times-circle-o" aria-hidden="true"></i></a></td>
                              </tr>
                              <tr>
                                 <td>Investment Ownership Funds LP</td>
                                 <td>$22,805.71</td>
                                 <td>-$1,956.78</td>
                                 <td>-$50.00</td>
                                 <td>-$1,956.78</td>
                                 <td>$22,805.71</td>
                                 <td>-$1,956.78</td>
                                 <td><a  class="delete_row" href=""><i class="fa fa-times-circle-o" aria-hidden="true"></i></a></td>
                              </tr>
                              <tr>
                                 <td>Investment Payment Transaction</td>
                                 <td>$27,385.37</td>
                                 <td>-$2,428.25</td>
                                 <td>-$411.85</td>
                                 <td>-$2,428.25</td>
                                 <td>$27,385.37</td>
                                 <td>-$2,428.25</td>
                                 <td><a  class="delete_row" href=""><i class="fa fa-times-circle-o" aria-hidden="true"></i></a></td>
                              </tr>
                              <tr>
                                 <td>Trans Tasman Pacific Partnership LP</td>
                                 <td>$148.07</td>
                                 <td>-$5,645.50</td>
                                 <td>$25.00</td>
                                 <td>-$5,645.50</td>
                                 <td>$148.07</td>
                                 <td>-$5,645.50</td>
                                 <td><a  class="delete_row" href=""><i class="fa fa-times-circle-o" aria-hidden="true"></i></a></td>
                              </tr>
                              <tr>
                                 <td>Payment Ownership</td>
                                 <td>$1,270.00</td>
                                 <td>-$13.50</td>
                                 <td>$0.00</td>
                                 <td>-$13.50</td>
                                 <td>$1,270.00</td>
                                 <td>-$13.50</td>
                                 <td><a class="delete_row" href=""><i class="fa fa-times-circle-o" aria-hidden="true"></i></a></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <div class="form-submit pt-5">
                        <input class="btn btn-warning" type="submit" name="save" value="Process payments and Statements">
                     </div>
                 </form>
               </div>
            </div>
         </form>
      </section>
      <!-- End Ownership to process -->
   </div>
</div>
<!-- end main content -->
<?php include"footer.php"; ?>