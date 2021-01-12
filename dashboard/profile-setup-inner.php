<?php include"header.php"; ?>

<!-- Bootstrap Datepicker -->
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css">

<div class="title-wrapper row">
   <div class="col">
     <div class="">
       <h2 class="page-title">Home Page</h2>
     </div>
   </div>
</div>
<div class="row no-gutters">
  <div class="col-md-12">
    <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6">
              <h4 class="card-title fs-29 py-3 t3">Want to get the most out of the PropTech platform?</h4>
              <p class="mb-0 light-secondary">Enter the details of your current portfolio and get live data on it’s performance using our Portfolio Analysis tool.</p>
            </div>
            <div class="col-md-6 align-self-center">
              <a class="btn btn-outline-primary br-2" href="#" title="">SAVE</a>
              <a class="btn btn-outline-primary br-2" href="#" title="">SKIP</a>
              <a class="btn btn-outline-primary br-2 next-icon" href="#" title="">NEXT</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form class="form-style-one" action="" method="get" accept-charset="utf-8">
            <div class="form-group">
              <label for="">Property Name</label>
              <input type="text" class="form-control" name="" placeholder="Property Name">
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Unit Number</label>
                  <input type="text" class="form-control" name="" placeholder="Unit Number">
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Street Name</label>
                  <input type="text" class="form-control" name="" placeholder="Street Name">
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Suburb</label>
                  <input type="text" class="form-control" name="" placeholder="Suburb">
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">City</label>
                  <select name="" class="form-control">
                    <option value=""></option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Country</label>
                  <select name="" class="form-control caret">
                    <option value="">New Zealand</option>
                  </select>
                  <i class="icofont-caret-down"></i>
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Post Code</label>
                  <input type="text" class="form-control" name="" placeholder="Post Code">
                </div>
              </div>
            </div>
            <hr>
            <h4 class="fs-10">Property Details</h4>
            <div class="row mt-4">
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Property Type</label>
                  <input type="text" class="form-control" name="" placeholder="Property Type">
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Land area (FT or M)</label>
                  <select name="" class="form-control">
                    <option value="">Land area</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-5 col-md-4">
                <div class="row">
                  <div class="col-md-4 form-group">
                    <label for="">Bed</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                          <img src="assets/img/bed.png" class="img-fluid" alt="">
                      </div>
                      <select name="" class="form-control caret">
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4</option>
                      </select>
                      <i class="icofont-caret-down"></i>
                    </div>
                  </div>
                  <div class="col-md-4 form-group">
                    <label for="">Bathroom</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                          <img src="assets/img/bath.png" class="img-fluid" alt="">
                      </div>
                      <select name="" class="form-control caret">
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4</option>
                      </select>
                      <i class="icofont-caret-down"></i>
                    </div>
                  </div>
                  <div class="col-md-4 form-group">
                    <label for="">Car Park</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                          <img src="assets/img/car.png" class="img-fluid" alt="">
                      </div>
                      <select name="" class="form-control caret">
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4</option>
                      </select>
                      <i class="icofont-caret-down"></i>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Date Purchased</label>
                  <input type="text" class="form-control datepicker" name="" placeholder="Start Date">
                </div>
              </div>

              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Date of Completion</label>
                  <input type="text" class="form-control datepicker" name="" placeholder="Start Date">
                </div>
              </div>

              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Purchase Price</label>
                  <div class="input-group">
                      <div class="input-group-addon currency-picker">
                          <select name="" class="form-control caret">
                            <option value="">$ NZ</option>
                            <option value="">USD</option>
                          </select>
                          <i class="icofont-caret-down"></i>
                      </div>
                        <input type="text" class="form-control" name="" placeholder="Price Paid">
                    </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Current Value</label>
                  <div class="input-group">
                      <div class="input-group-addon currency-picker">
                          <select name="" class="form-control caret">
                            <option value="">$ NZ</option>
                            <option value="">USD</option>
                          </select>
                          <i class="icofont-caret-down"></i>
                      </div>
                        <input type="text" class="form-control" name="" placeholder="Current Value">
                    </div>
                </div>
              </div>
            </div>

            <hr>
            <h4 class="fs-10">Income</h4>

            <div class="row mt-4">
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Annual Rental</label>
                  <div class="input-group">
                      <div class="input-group-addon currency-picker">
                          <select name="" class="form-control caret">
                            <option value="">$ NZ</option>
                            <option value="">USD</option>
                          </select>
                          <i class="icofont-caret-down"></i>
                      </div>
                        <input type="text" class="form-control" name="" placeholder="Annual Rental">
                    </div>
                </div>
              </div>
              <div class="col-12">
                <hr>
                <h4 class="mb-4">Expenses</h4>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Rates $ value</label>
                  <input type="text" class="form-control" name="" placeholder="Rates $ value">
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Ground Rent</label>
                  <input type="text" class="form-control" name="" placeholder="Ground Rent">
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Management Fee’s</label>
                  <div class="row">
                    <div class="col">
                      <div class="input-group">
                        <div class="input-group-addon">
                            %
                        </div>
                          <input type="text" class="form-control" name="" placeholder="">
                      </div>
                    </div>
                    <div class="col">
                      <div class="input-group">
                        <div class="input-group-addon">
                            $
                        </div>
                          <input type="text" class="form-control" name="" placeholder="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Adminstration fee Year $</label>
                  <input type="text" class="form-control" name="" placeholder="Adminstration fee Year $">
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Property Maintenance</label>
                  <input type="text" class="form-control" name="" placeholder="Property Maintenance">
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Other Costs</label>
                  <input type="text" class="form-control" name="" placeholder="Other Costs">
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Body Corporate fee $ Value</label>
                  <input type="text" class="form-control" name="" placeholder="Body Corporate fee $ Value">
                </div>
              </div>
              <div class="col-12"></div>
              <div class="col-lg-3 col-md-4">
                <div class="bg-danger-secondary text-white p-3 br-4 total-input">
                  <ul class="nav">
                    <li class="text-three pr-4">Total Expense $</li>
                    <li class="text-three">$45,666.00</li>
                  </ul>
                </div>
              </div>
              <div class="col-12">
                <hr>
              </div>
            </div>
            <h4 class="fs-10">Forecast</h4>
            <div class="row mt-4">
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">5-10 Yr Capital Growth</label>
                  <input type="text" class="form-control" name="" placeholder="5-10 Yr Capital Growth">
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Yearly rental growth</label>
                  <input type="text" class="form-control" name="" placeholder="Yearly rental growth">
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                  <label for="">Rates $ value</label>
                  <input type="text" class="form-control" name="" placeholder="Rates $ value">
                </div>
              </div>
              <div class="col-lg-6 offset-lg-6 col-md-12 offset-md-0 mt-5">
                <a class="btn btn-outline-primary br-2" href="#" title="">SAVE</a>
                <a class="btn btn-outline-primary br-2" href="#" title="">SKIP</a>
                <a class="btn btn-outline-primary br-2 next-icon" href="#" title="">NEXT</a>
              </div>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>



<?php include"footer.php"; ?>


<!-- datepicker -->
<script type="text/javascript" src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {    
        //datepicker
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });
    });
</script>