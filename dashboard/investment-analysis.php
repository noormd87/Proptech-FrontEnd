<?php include"header.php"; ?>
<link rel="stylesheet" type="text/css" href="assets/plugins/flexslider/css/flexslider.min.css">
  
  <h2 class="page-title">Run an Investment Analysis</h2>
   <form action="" class="analysis-form" method="post" accept-charset="utf-8">
     <div class="tab-content-one">
        <div class="row no-gutters">
          <div class="col-lg-8">
            <ul class="nav nav-tabs tab-style-one" id="typeTab" role="tablist">
             <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#inputTab" role="tab" >Inputs</a>
             </li>
             <li class="nav-item">
                <a class="nav-link"  data-toggle="tab" href="#paymentsTab" role="tab" >Payments</a>
             </li>
             <li class="nav-item">
                <a class="nav-link"  data-toggle="tab" href="#rentalTab" role="tab" >Rental Information</a>
             </li>
             <li class="nav-item">
                <a class="nav-link"  data-toggle="tab" href="#expensesTab" role="tab" >Expenses</a>
             </li>
             <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#mortgageTab" role="tab" >Mortgage Information</a>
             </li>
             <li class="nav-item">
                <a class="nav-link"  data-toggle="tab" href="#growthTab" role="tab">Growth Factors</a>
             </li>
             <li class="nav-item">
                <a class="nav-link"  data-toggle="tab" href="#depreciationTab" role="tab">Depreciation</a>
             </li>
             <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#resultsTab" role="tab">Results</a>
             </li>
          </ul>
        </div>
        </div>
        <div class="tab-content" id="typeTabContent">
          <!-- input tab -->
          <div class="tab-pane fade show active" id="inputTab">
            <div class="row">
              <div class="col-lg-8">
                <div class="card">
                  <div  class="card-body">
                  <h5 class="sm-heading">Financial Analysis for NZ:</h5>
                  <div class="table-wrap border-spacing">
                    <div class="col-wrap col-wrap-3">
                      Existing Gross Income (excluding this property) ($ NZD)
                    </div>
                    <div class="col-wrap col-wrap-1">
                      <input type="text" name="" class="form-control">
                    </div>
                  </div>
                  <div class="table-wrap border-spacing">
                    <div class="col-wrap col-wrap-3">
                      DuVal Dynamic Price ™ ($ NZD)
                    </div>
                    <div class="col-wrap col-wrap-1">
                      <input type="text" name="" class="form-control">
                    </div>
                  </div>
                  <div class="table-wrap border-spacing">
                    <div class="col-wrap col-wrap-3">
                      Market Price ($ NZD)
                    </div>
                    <div class="col-wrap col-wrap-1">
                      <input type="text" name="" class="form-control">
                    </div>
                  </div>
                  <div class="table-wrap border-spacing">
                    <div class="col-wrap col-wrap-3">
                      Stamp Duty ($ NZD)
                    </div>
                    <div class="col-wrap col-wrap-1">
                      <input type="text" name="" class="form-control">
                    </div>
                  </div>
                  <div class="table-wrap border-spacing">
                    <div class="col-wrap col-wrap-3">
                      Transfer Fees ($ NZD)
                    </div>
                    <div class="col-wrap col-wrap-1">
                      <input type="text" name="" class="form-control">
                    </div>
                  </div>
                  <div class="table-wrap border-spacing">
                    <div class="col-wrap col-wrap-3">
                      Legal Fees ($ NZD)
                    </div>
                    <div class="col-wrap col-wrap-1">
                      <input type="text" name="" class="form-control">
                    </div>
                  </div>
                  <div class="table-wrap py-5">
                    <div class="col-wrap col-wrap-3">
                     Total Purchase Cost ($ NZD)
                    </div>
                    <div class="col-wrap col-wrap-1">
                      <input type="text" name="" class="form-control">
                    </div>
                  </div>

                  <div class="absoulte-btn">
                    <a class="btn btn-outline-primary" href="#" title="">Click to Proceed <i class="icofont-caret-right"></i></a>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-lg-4 align-self-center">
          <div class="px-5">
            <img src="assets/img/property-investment-guide.png" alt="" class="img-fluid">
          </div>
        </div>
            </div>
          </div><!-- end input tab -->
          <!-- payment tab -->
          <div class="tab-pane fade" id="paymentsTab">
            <div class="row">
              <div class="col-lg-8">
                <div class="card">
            <div  class="card-body">
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Reservation Fee ($ NZD)
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Stage Payment 1
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Stage Payment 2
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Loan Amount (%)
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Top Up for Mortgage ($ NZD)
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="absoulte-btn">
                <a class="btn btn-outline-primary" href="#" title="">Click to Proceed <i class="icofont-caret-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 align-self-center">
          <div class="px-5">
            <img src="assets/img/property-investment-guide.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
          </div><!-- end payment tab -->
          <!-- Rental Information -->
          <div class="tab-pane fade" id="rentalTab">
            <div class="row">
              <div class="col-lg-8">
                <div class="card">
            <div class="card-body">
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Weekly Rental ($ NZD)
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Vacancy Rate (%)
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="absoulte-btn">
              <a class="btn btn-outline-primary" href="#" title="">Click to Proceed <i class="icofont-caret-right"></i></a>
            </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 align-self-center">
          <div class="px-5">
            <img src="assets/img/property-investment-guide.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
            
          </div><!-- End Rental Information -->
          <!-- Expenses -->
          <div class="tab-pane fade" id="expensesTab">
            <div class="row">
              <div class="col-lg-8">
                <div class="card">
            <div class="card-body">
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Letting Fees (%)
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Management Fees (%)
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Council Rates ($ NZD) p.a.
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Body Corporate ($ NZD) p.a.
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Land Lease ($ NZD) p.a.
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Insurance ($ NZD) p.a.
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Repairs and Maintenance (%)
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Cleaning ($ NZD) per month
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Gardening ($ NZD) per month
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Service Contract ($ NZD) p.a.
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Other ($ NZD)
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="absoulte-btn">
                <a class="btn btn-outline-primary" href="#" title="">Click to Proceed <i class="icofont-caret-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 align-self-center">
          <div class="px-5">
            <img src="assets/img/property-investment-guide.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
          </div><!-- End Expenses -->
          <!-- Mortgage Information -->
          <div class="tab-pane fade" id="mortgageTab" role="tabpanel" aria-labelledby="typeD-tab">
            <div class="row">
              <div class="col-lg-8">
                <div class="card">
            <div class="card-body">
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  LTV (%)
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Initial Loan Amount ($ NZD)
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Interest Rate (%)
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Term (Years)
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-3">
                  Interest Only/Principal & Interest
                </div>
                <div class="col-wrap col-wrap-1">
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="absoulte-btn">
                <a class="btn btn-outline-primary" href="#" title="">Click to Proceed <i class="icofont-caret-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 align-self-center">
          <div class="px-5">
            <img src="assets/img/property-investment-guide.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
          </div><!-- End Mortgage Information -->
          <!-- Growth Factors -->
          <div class="tab-pane fade" id="growthTab" role="tabpanel" aria-labelledby="typeD-tab">
            <div class="row">
              <div class="col-lg-8">
                <div class="card">
            <div class="card-body">
              <div class="table-wrap border-spacing">
              <div class="col-wrap col-wrap-3">
                CPI (%)
              </div>
              <div class="col-wrap col-wrap-1">
                <input type="text" name="" class="form-control">
              </div>
            </div>
            <div class="table-wrap border-spacing">
              <div class="col-wrap col-wrap-3">
                Rental Growth (%)
              </div>
              <div class="col-wrap col-wrap-1">
                <input type="text" name="" class="form-control">
              </div>
            </div>
            <div class="table-wrap border-spacing">
              <div class="col-wrap col-wrap-3">
                Capital Growth (%)
              </div>
              <div class="col-wrap col-wrap-1">
                <input type="text" name="" class="form-control">
              </div>
            </div>
            <div class="absoulte-btn">
              <a class="btn btn-outline-primary" href="#" title="">Click to Proceed <i class="icofont-caret-right"></i></a>
            </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 align-self-center">
          <div class="px-5">
            <img src="assets/img/property-investment-guide.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
          </div><!-- end Growth Factors -->
          <!-- Depreciation -->
          <div class="tab-pane fade" id="depreciationTab" role="tabpanel" aria-labelledby="typeD-tab">
            <div class="row">
              <div class="col-lg-8">
                <div class="card">
            <div class="card-body">
              <div class="table-wrap border-spacing">
                <div class="col-wrap col-wrap-2">
                  Fixtures
                </div>
                <div class="col-wrap col-wrap-1 pr-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Value ($ NZD)</span>
                    </div>
                    <input type="text" name="" class="form-control">
                  </div>
                </div>
                <div class="col-wrap col-wrap-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Useful Life (years)</span>
                    </div>
                    <input type="text" name="" class="form-control">
                  </div>
                </div>
              </div>
            <div class="table-wrap border-spacing">
              <div class="col-wrap col-wrap-2">
                Capital Growth (%)
              </div>
              <div class="col-wrap col-wrap-1 pr-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Value ($ NZD)</span>
                  </div>
                  <input type="text" name="" class="form-control">
                </div>
              </div>
              <div class="col-wrap col-wrap-1">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Useful Life (years)</span>
                  </div>
                  <input type="text" name="" class="form-control">
                </div>
              </div>
            </div>
            <div class="absoulte-btn">
              <a class="btn btn-outline-primary" href="#" title="">Click to Proceed <i class="icofont-caret-right"></i></a>
            </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 align-self-center">
          <div class="px-5">
            <img src="assets/img/property-investment-guide.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
          </div><!-- end Depreciation -->
          <!-- Result -->
          <div class="tab-pane fade" id="resultsTab" role="tabpanel" aria-labelledby="typeD-tab">
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-card">
                      <h4 class="mb-2">Overview</h4>
                      <div class="table-responsive">
                        <table class="analysis-table table table-striped">
                          <tbody>
                            <tr>
                              <td>Purchase Price</td>
                              <td>527,728</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>Total Initial Cash Requirements</td>
                              <td>101,080</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>Effective Stamp Duty Rate</td>
                              <td>0%</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>Capital Growth Rate</td>
                              <td></td>
                              <td>2%</td>
                              <td>2%</td>
                              <td>2%</td>
                              <td>2%</td>
                              <td>2%</td>
                              <td>2%</td>
                              <td>2%</td>
                              <td>2%</td>
                              <td>2%</td>
                              <td>2%</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="text-right">
                        <a class="btn btn-light" href="#"><i class="icofont-chart-bar-graph"></i> View Graph </a>
                      </div>
                    </div>
                    <div class="table-card">
                      <h4 class="mb-2">Equity</h4>
                      <div class="table-responsive">
                        <table class="analysis-table table table-striped">
                          <tbody>
                            <tr>
                              <td>Purchase Price</td>
                              <td>527,778</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                            </tr>
                            <tr>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="text-right">
                        <a class="btn btn-light" href="#"><i class="icofont-chart-bar-graph"></i> View Graph </a>
                      </div>
                    </div>
                    <div class="table-card">
                      <h4 class="mb-2">Annual Income</h4>
                      <div class="table-responsive">
                        <table class="analysis-table table table-striped">
                          <tbody>
                            <tr>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                            </tr>
                            <tr>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="text-right">
                        <a class="btn btn-light" href="#"><i class="icofont-chart-bar-graph"></i> View Graph </a>
                      </div>
                    </div>
                    <div class="table-card">
                      <h4 class="mb-2">Annual Income</h4>
                      <div class="table-responsive">
                        <table class="analysis-table table table-striped">
                          <tbody>
                            <tr>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                            </tr>
                            <tr>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                              <td>Purchase Price</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="text-right">
                        <a class="btn btn-light" href="#"><i class="icofont-chart-bar-graph"></i> View Graph </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- end Result -->
        </div>
      </div>
    </form>
 


  
  

<?php include"footer.php"; ?>