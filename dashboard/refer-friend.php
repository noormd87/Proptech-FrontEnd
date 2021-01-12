<?php include"header.php"; ?>
<link rel="stylesheet" type="text/css" href="assets/plugins/flexslider/css/flexslider.min.css">
  
  <div class="title-wrapper row">
   <div class="col">
     <div class="">
       <h2 class="page-title">Available Property / Avenue Apartments</h2>
     </div>
   </div>
   <div class="col">
   </div>
 </div>
  <div class="card">
    <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="flexslider thumb-slider">
              <ul class="slides">
                <li data-thumb="assets/img/mve_001.png">
                  <img src="assets/img/advisor-slider.png" />
                </li>
                <li data-thumb="assets/img/flex-thumb.png">
                  <img src="assets/img/advisor-slider.png" />
                </li>
                <li data-thumb="assets/img/mve_001.png">
                  <img src="assets/img/advisor-slider.png" />
                </li>
                <li data-thumb="assets/img/flex-thumb.png">
                  <img src="assets/img/advisor-slider.png" />
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-8">
            <div class="row no-gutters h-100">
              <div class="col-12 mt-4">
                <div class="refer-progress">
                  <ul class="row">
                    <div class="col-lg-3">
                      <div class="progress-box">
                        <h3 class="text-lg-two">20000</h3>
                      </div>
                      <p class="text-center text-two mt-3">Total Points</p>
                    </div>
                    <div class="col-lg-3 offset-lg-3">
                      <div class="progress-box">
                        <h3 class="text-lg-two">20</h3>
                      </div>
                      <p class="text-center text-two mt-3">Total Referred</p>
                    </div>
                    <div class="col-lg-3">
                      <div class="progress-box">
                        <h3 class="text-lg-two">19</h3>
                      </div>
                      <p class="text-center text-two mt-3">Total Joined</p>
                    </div>
                  </ul>
                </div>
              </div>
              <div class="col-12 align-self-end mt-4">
                <div class="row">
                    <div class="col-12">
                      <h4 class="mb-3">Copy link & Share</h4>
                    </div>
                    <div class="col-md-5 form-group">
                      <input type="text" class="form-control" name="" placeholder="James.bond@bond.com">
                    </div>
                    <div class="col-md-3 form-group">
                      <button type="" class="btn btn-outline-primary">Copy</button>
                    </div>
                    <div class="col-md-3 form-group">
                      <button type="" class="btn btn-outline-primary">Refer a Friend</button>
                    </div>
                    <div class="col-12">
                      <a href="#"><img src="assets/img/facebook.png" alt=""></a>
                      <a href="#"><img src="assets/img/linkedin.png" alt=""></a>
                      <a href="#"><img src="assets/img/twitter.png" alt=""></a>
                      <a href="#"><img src="assets/img/instagram.png" alt=""></a>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>    
  </div>


  <!-- Refer History-->
  <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col align-self-center">
            <h4 class="card-title">Refer History</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="refer-history table">
               <thead>
                 <tr>
                  <td></td>
                  <td>Point you received</td>
                  <td>Refer Date</td>
                  <td>Joined Date</td>
                  <td>Stats</td>
                </tr>
               </thead>
               <tbody>
                <tr>
                    <td>
                      <div class="">
                      <img src="assets/img/kenyon-thumb.png" class="img-fluid" alt=""> Kenyon Clarke
                      </div>
                    </td>
                   <td>6900</td>
                   <td>2-2-2020</td>
                   <td>2-3-202</td>
                   <td>Active</td>
                </tr>
                <tr>
                    <td>
                      <div class="">
                      <img src="assets/img/kenyon-thumb.png" class="img-fluid" alt=""> Kenyon Clarke
                      </div>
                    </td>
                   <td>6900</td>
                   <td>2-2-2020</td>
                   <td>2-3-202</td>
                   <td>Active</td>
                </tr>
                <tr>
                    <td>
                      <div class="">
                      <img src="assets/img/kenyon-thumb.png" class="img-fluid" alt=""> Kenyon Clarke
                      </div>
                    </td>
                   <td>6900</td>
                   <td>2-2-2020</td>
                   <td>2-3-202</td>
                   <td>Active</td>
                </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
  <!-- end available property -->


<?php include"footer.php"; ?>

<script src="assets/plugins/chartjs/Chart.bundle.js"></script>
<script>
//chart1
  new Chart(document.getElementById("doughnut-chart"), {
    type: 'doughnut',
    data: {
      labels: ["Available", "Not Available"],
      datasets: [
        {
          label: "Property Status)",
          backgroundColor: ["#85BE1A", "#C70000"],
          data: [30,70]
        }
      ]
    },
    responsive: true,
    options: {
      legend: {
        display: false
      },
      title: {
        display: false,
        text: 'Property Status'
      }
    }
});  
//linechart
var ctx = document.getElementById("lineChart");
   ctx.height = 100;
   var myChart = new Chart(ctx, {
       type: 'line',
       data: {
           labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
           type: 'line',
   
           datasets: [{
               label: "Property Status)",
                borderColor: "#ED6161",
                borderWidth: 1,
                pointBorderWidth: 5,
                pointHoverRadius: 5,
                borderDash: [5,0],
                backgroundColor: ["#85BE1A"],
                data: [80,70,50,90,50,20,40],
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

<script src="assets/plugins/flexslider/js/flexslider.js"></script>
<script>
  $(document).ready(function() {
    $('.flexslider').flexslider({
      animation: "slide",
      controlNav: "thumbnails"
    });
  });
</script>



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

