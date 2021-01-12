<?php include"header.php"; ?>

<form action="" method="get" accept-charset="utf-8">
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

  <div class="row no-gutters">
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>People and Population Overview</p>
        <h2>1136597</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Median Age</p>
        <h2>16</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Population Density <br>(England & Wales)</p>
        <h2>91.64</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pt-1">
      <div class="simple-widget h-100">
        <p>Higher Education or Equivalent</p>
        <h2>34.98</h2>
      </div>
    </div>
  </div>

  <h4 class="card-heading">Population 0 to 34</h4>
  <div class="row no-gutters">
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Age < 20</p>
        <h2>1136597</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Age 20 - 24</p>
        <h2>290205</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Age 25 - 29</p>
        <h2>121548</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pt-1">
      <div class="simple-widget h-100">
        <p>Age 30 - 34</p>
        <h2>137353</h2>
      </div>
    </div>
  </div>

  <h4 class="card-heading">Population 35 to 54</h4>
  <div class="row no-gutters">
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Age 35 - 39</p>
        <h2>111822</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Age 40 - 44</p>
        <h2>81561</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Age 45 - 49</p>
        <h2>70014</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pt-1">
      <div class="simple-widget h-100">
        <p>Age 50 - 54</p>
        <h2>61363</h2>
      </div>
    </div>
  </div>

  <h4 class="card-heading">Population 55 to 74</h4>
  <div class="row no-gutters">
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Age 55 - 59</p>
        <h2>50044</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Age 60 - 64</p>
        <h2>39006</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Age 65 - 69</p>
        <h2>29852</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pt-1">
      <div class="simple-widget h-100">
        <p>Age 70 - 74</p>
        <h2>22554</h2>
      </div>
    </div>
  </div>

  <h4 class="card-heading">Population 75 to 80+</h4>
  <div class="row no-gutters">
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Age 75 - 79</p>
        <h2>16449</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Age 80 - 84</p>
        <h2>12750</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pr-1 pt-1">
      <div class="simple-widget h-100">
        <p>Age 85+</p>
        <h2>11794</h2>
      </div>
    </div>
  </div>


  <div class="card mt-4">
    <div class="card-header">
      <h4 class="card-title">Charts</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card-header">
      <h4 class="card-title">Education By Level</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <canvas id="myChart2"></canvas>
        </div>
      </div>
    </div>
  </div>
</form>



<?php include"footer.php"; ?>

<script src="assets/plugins/chartjs/Chart.bundle.js"></script>
<script>
  // chart one
  var ctx = document.getElementById("myChart");
  ctx.height = 160;
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["2015-01", "2015-02", "2015-03", "2015-04", "2015-05", "2015-06", "2015-07", "2015-08", "2015-09", "2015-10", "2015-11", "2015-12"],
      datasets: [{
        label: '# of Population',
        data: [12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        xAxes: [{
          ticks: {
            maxRotation: 90,
            minRotation: 80
          }
        }],
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });

  //chart two
  var ctx = document.getElementById("myChart2");
  ctx.height = 160;
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["2015-01", "2015-02", "2015-03", "2015-04", "2015-05", "2015-06", "2015-07", "2015-08", "2015-09", "2015-10", "2015-11", "2015-12"],
      datasets: [{
        label: '# of Population',
        data: [12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        xAxes: [{
          ticks: {
            maxRotation: 90,
            minRotation: 80
          }
        }],
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
</script>
