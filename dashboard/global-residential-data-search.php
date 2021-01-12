<?php include"header.php"; ?>

<form action="global-residential-data-result.php" method="post" accept-charset="utf-8">
  <div class="row no-gutters">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <h4>Search global data <img src="assets/img/uk.png" class="img-fluid" alt="" width="50px"></h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3 col-md-4 form-group">
                <label for="">City</label>
                <input type="text" class="form-control" name="" placeholder="City">
              </div>
              <div class="col-lg-3 col-md-4 form-group">
                <label for="">Street</label>
                <input type="text" class="form-control" name="" placeholder="Street">
              </div>
              <div class="col-lg-3 col-md-4 form-group">
                <label for="">Suburb</label>
                <input type="text" class="form-control" name="" placeholder="Suburb">
              </div>
              <div class="col-lg-3 col-md-4 form-group">
                <label for="">Post Code</label>
                <input type="text" class="form-control" name="" placeholder="Post Code">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-4 form-group">
                <label for="">Filter</label>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="01-01-2020 - 01-15-2020">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Price Paid</button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                      <div role="separator" class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-4 offset-lg-5 col-md-4 offset-md-0" style="margin-top: 32px;">
                <input type="submit" class="btn btn-primary" name="" placeholder="">
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-12">
      <div class="card h-100">
        <div class="card-body">
          <div class="Vector-map-js">
              <div id="worldMap" class="vmap"><h1 class="">MAP</h1></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>



<?php include"footer.php"; ?>
