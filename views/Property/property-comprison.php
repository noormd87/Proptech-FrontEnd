<?php include"header.php";
 \login\loginClass::Init();
 $checkSession = \login\loginClass::CheckUserSessionIp();
 $user_id   = \settings\session\sessionClass::GetSessionDisplayName();
 
 
 \Property\PropertyClass::Init();
 $PropertyComparison = self::GetPropertyComparison($user_id);



?>


<div class="card">
  <div class="card-body">
    <h4 class="card-title">Investent  Comparisons</h4>
    <div class="">
      <table class="table table-bordered table-striped mb-0">
        

        <tr>
          <td></td>
          <td>Property A</td>
          <td>Property B</td>
          <td>Property C</td>
        </tr>

        
        <tr class="bg-dark">
          <th colspan="4">Address</th>
        </tr>
        <tr>
          <td>Unit No</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Property </td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>City</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>State/County</td>
          <td>South Australia</td>
          <td>N/A</td>
          <td>N/A</td>
        </tr>
        <tr>
          <td>Country</td>
          <td>Australia</td>
          <td>New Zealand</td>
          <td>United Kingdom</td>
        </tr>
        <tr class="bg-dark">
          <th colspan="4">Purchase Information</th>
        </tr>
        <tr>
          <td>Purhcase Price </td>
          <td>6,84,932</td>
          <td>6,36,943</td>
          <td>6,25,000</td>
        </tr>
        <tr>
          <td>Stamp Duty </td>
          <td>81,390</td>
          <td>0</td>
          <td>50,000</td>
        </tr>
        <tr>
          <td>Mortgage/Lease Registration</td>
          <td>116</td>
          <td></td>
          <td>675</td>
        </tr>
        <tr>
          <td>Transfer Fees</td>
          <td>5,829</td>
          <td>51</td>
          <td></td>
        </tr>
        <tr>
          <th>Total Cash Requirement</th>
          <th>3,27,747</th>
          <th>1,91,771</th>
          <th>2,70,675</th>
        </tr>
        <tr class="bg-dark">
          <th colspan="4">Growth</th>
        </tr>
        <tr>
          <th>CPI</th>
          <td>2.00%</td>
          <td>2.00%</td>
          <td>2.00%</td>
        </tr>
        <tr>
          <th>Rental Growth</th>
          <td>2.50%</td>
          <td>2.50%</td>
          <td>2.50%</td>
        </tr>
        <tr>
          <th>Capital Growth</th>
          <td>5.00%</td>
          <td>5.00%</td>
          <td>5.00%</td>
        </tr>
        <tr class="bg-dark">
          <th colspan="4">IRR</th>
        </tr>
        <tr>
          <th>IRR</th>
          <td>10.46%</td>
          <td>23.73%</td>
          <td>11.13%</td>
        </tr>
        <tr>
          <th>IRR (after tax)</th>
          <td>10.33%</td>
          <td>22.90%</td>
          <td>10.11%</td>
        </tr>
      </table>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Annual Cashflow</h4>
    <canvas class="" id="annualCashFlow"></canvas>
  </div>
</div>


<div class="card">
  <div class="card-body">
    <h4 class="card-title">Total Annual Reuturn(After Tax)</h4>
    <canvas class="" id="annualReturn"></canvas>
  </div>
</div>


<div class="card">
  <div class="card-body">
    <h4 class="card-title">Estimate Equity</h4>
    <canvas class="" id="estimateEquity"></canvas>
  </div>
</div>


<?php include"footer.php"; ?>


<script src="assets/plugins/chartjs/Chart.bundle.js"></script>
<script type="text/javascript">
   //Annual Cash Flow
   var ctx = document.getElementById("annualCashFlow");
   ctx.height = 100;
   var myChart = new Chart(ctx, {
       type: 'line',
       data: {
           labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
           type: 'line',
   
           datasets: [{
               label: "Property A",
               data: [50, 2600, 4600, 4700, 5200, 5400, 6000, 6500, 7000, 7500],
               backgroundColor: "rgba(138,155,240,0.0)",
               borderWidth: 2,
               borderColor: "#8a9bf0",
               pointRadius: 0,
           },{
               label: "Property B",
               data: [6000, 3600, 5600, 5000, 5600, 4800, 7000, 8000, 9000, 10000],
               backgroundColor: "rgba(240,165,91,0.0)",
               borderWidth: 2,
               borderColor: "#F0A55B",
               pointRadius: 0,
           },{
               label: "Property C",
               data: [7000, 4600, 6600, 6000, 6600, 5800, 8000, 9000,10000,10500],
               backgroundColor: "rgba(43,212,54,0.0)",
               borderWidth: 2,
               borderColor: "#2AD436",
               pointRadius: 0,
           }]
       },
       options: {
           responsive: true,
           tooltips: {
               enabled: false,
           },
           legend: {
               display: true,
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

   //Estimate Equity
   var ctx = document.getElementById("annualReturn");
   ctx.height = 100;
   var myChart = new Chart(ctx, {
       type: 'line',
       data: {
           labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
           type: 'line',
   
           datasets: [{
               label: "Property A",
               data: [50, 26, 46, 40, 46, 38, 60],
               backgroundColor: "rgba(138,155,240,0.0)",
               borderWidth: 2,
               borderColor: "#8a9bf0",
               pointRadius: 0,
           },{
               label: "Property B",
               data: [60, 36, 56, 50, 56, 48, 70],
               backgroundColor: "rgba(240,165,91,0)",
               borderWidth: 2,
               borderColor: "#F0A55B",
               pointRadius: 0,
           },{
               label: "Property C",
               data: [70, 46, 66, 60, 66, 58, 80],
               backgroundColor: "rgba(43,212,54,0)",
               borderWidth: 2,
               borderColor: "#2AD436",
               pointRadius: 0,
           }]
       },
       options: {
           responsive: true,
           tooltips: {
               enabled: false,
           },
           legend: {
               display: true,
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


   // Rental Return
   var ctx = document.getElementById("estimateEquity");
   ctx.height = 100;
   var myChart = new Chart(ctx, {
       type: 'bar',
       data: {
           labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
           type: 'line',
   
           datasets: [{
               label: "Property A",
               data: [50, 26, 46, 40, 46, 38, 60],
               backgroundColor: "rgba(138,155,240,1)",
               borderWidth: 2,
               borderColor: "#8a9bf0",
               pointRadius: 0,
           },{
               label: "Property B",
               data: [60, 36, 56, 50, 56, 48, 70],
               backgroundColor: "rgba(240,165,91,1)",
               borderWidth: 2,
               borderColor: "#F0A55B",
               pointRadius: 0,
           },{
               label: "Property C",
               data: [70, 46, 66, 60, 66, 58, 80],
               backgroundColor: "rgba(43,212,54,1)",
               borderWidth: 2,
               borderColor: "#2AD436",
               pointRadius: 0,
           }]
       },
       options: {
           responsive: true,
           tooltips: {
               enabled: false,
           },
           legend: {
               display: true,
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