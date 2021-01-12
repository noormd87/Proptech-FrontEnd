<?php include"header.php"; ?>
<!-- apexchart -->  
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/css/apexcharts.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/css/apexcharts.min.css.map">
<!-- property row -->
<form action="<?php echo SITE_BASE_URL;?>Property/Projects.html?project_id=<?php echo $_REQUEST["project_id"]; ?>&country=<?php echo $_REQUEST["country"]; ?>" method="post" class="" name='form1'>
<?php
 $country = $_REQUEST["country"];
 $project_id = $_REQUEST["project_id"];
 if($project_id=='' ||$project_id==null)
 {
     $project_id=1;
 }
 \Property\PropertyClass::Init();
 $Projectrows = \Property\PropertyClass::GetPorjectDatas($country,$project_id);
 $i = 1;
 foreach ($Projectrows as $Projectrow) 
     {
         $project_id = isset($Projectrow["PROJECT_ID"]) ? $Projectrow["PROJECT_ID"] : ""; 
     ?>
<div class="row">
   <!-- property content -->
   <div class="col-lg-4">
      <div class="card h-100 mb-0">
         <div class="card-body">
            <div class="card-title"><a class="text-dark" href="#">
                <?php echo $Projectrow["PROJECT_NAME"]?>
              </a>
              <h5 class="mt-2 text-success"><?php echo $Projectrow["PROJECT_DESCRIPTION"]?></h5></div>
            <!--<div class="row mt-30">-->
            <!--   <div class="col-lg-4 border-right-1">-->
            <!--      <a href="#" class="text-center d-block text-muted">-->
            <!--         <img src="<?php //echo SITE_BASE_URL;?>assets/img/icon/parking-icon.png" class="img-fluid">-->
            <!--         <div>-->
            <!--            <span class="f-s-12 text-muted">Parking</span>-->
            <!--            <span class="p-l-10 p-r-10 text-muted">|</span>-->
            <!--            <span class="f-s-12 text-muted">1</span>-->
            <!--         </div>-->
            <!--      </a>-->
            <!--   </div>-->
            <!--   <div class="col-lg-4 border-right-1">-->
            <!--      <a href="#" class="text-center d-block text-muted">-->
            <!--         <img src="<?php //echo SITE_BASE_URL;?>assets/img/icon/bedroom-icon.png" class="img-fluid">-->
            <!--         <div>-->
            <!--            <span class="f-s-12 text-muted">Bedroom</span>-->
            <!--            <span class="p-l-10 p-r-10 text-muted">|</span>-->
            <!--            <span class="f-s-12 text-muted">3</span>-->
            <!--         </div>-->
            <!--      </a>-->
            <!--   </div>-->
            <!--   <div class="col-lg-4">-->
            <!--      <a href="#" class="text-center d-block text-muted">-->
            <!--         <img src="<?php //echo SITE_BASE_URL;?>assets/img/icon/bathroom-icon.png" class="img-fluid">-->
            <!--         <div>-->
            <!--            <span class="f-s-12 text-muted">Bathroom</span>-->
            <!--            <span class="p-l-10 p-r-10 text-muted">|</span>-->
            <!--            <span class="f-s-12 text-muted">2</span>-->
            <!--         </div>-->
            <!--      </a>-->
            <!--   </div>-->
            <!--</div>-->
            <div class="basic-list-group">
               <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                     Median listing price 
                     <span class="badge">N/A</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                     1 yr listing price growth 
                     <span class="badge">+1.4%</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                     Median weekly rent 
                     <span class="badge">$695</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                     Median gross yield  
                     <span class="badge">8%</span>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <!-- end property content -->
   <!-- <div class="col-lg-4">
     <div class="card mb-0 h-100">
       <div class="card-body">
         <div class="">
           <div id="medianChart"></div>
         </div>
       </div>
     </div>
   </div> -->
   <!-- property sidebar -->
   <div class="col-lg-8">
      <div class="card rating-card h-100 mb-0">
         <div class="card-body">
            <a href="#">
               <div class="">
                  <img src="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $Projectrow["image_file"]; ?>" class="img-fluid preview-img-thumb" width="100%">
               </div>
            </a>
            <div class="rating row no-gutters">
               <div class="rating-btn col-8">
                  <button class="btn btn-link"><i class="fa fa-star"></i></button>
                  <button class="btn btn-link"><i class="fa fa-star"></i></button>
                  <button class="btn btn-link"><i class="fa fa-star"></i></button>
                  <button class="btn btn-link"><i class="fa fa-star"></i></button>
                  <button class="btn btn-link btn-disable"><i class="fa fa-star"></i></button>
               </div>
               <div class="col-4 text-right align-self-center">
                  <div class="user-review-count">(12,775)</div>
               </div>
            </div>
         </div>
         <div class="card-footer">
            <div class="property-nav">
               <a href="#" class="btn btn-primary btn-block">save brochure to my folder</a>
               <!--<a href="property-analyser.php" class="btn btn-primary btn-block">ANALYSE IN FULL</a>-->
               <!--<a href="<?php echo SITE_BASE_URL;?>Property/Properties.html?country=<?php echo $country;?>&project_id=<?php echo $Projectrow["PROJECT_ID"]?>" class="btn btn-primary btn-block">PROPERTY Details</a>-->
            </div>
         </div>
      </div>
   </div>
   <!-- end property sidebar -->
</div>
<!-- end property row -->
<!-- pricelist table -->
<!-- start row -->
<div class="row">
   <!-- start col -->
   <div class="col-12">
    <!-- accordion -->
      <div id="accordion" class="accordion mt-30">
        <div class="card mb-0">
            <div class="card-header collapsed" data-toggle="collapse" href="#collapsePricelistTable<?php echo $i;?>">
                <a class="card-title"> Pricelist </a>
            </div>
            <div id="collapsePricelistTable<?php echo $i;?>" class="card-body collapse" data-parent="#accordion">
                <div class="pricelist-table">
                   <div class="table-responsive">
                      <table class="data-table table table-hover table-striped mb-0">
                         <thead class="">
                            <tr>
                               <th>Building</th>
                               <th>APT No</th>
                               <th>Level</th>
                               <th>Aspect</th>
                               <th>Type</th>
                               <th>APT Size<br>(approx BOMA m2)</th>
                               <th>Approx Patio<br>Balcony (m2)</th>
                               <th>Car park</th>
                               <th>Bed</th>
                               <th>Bath</th>
                               <th>Price <br>GST Incl</th>
                               <th>Action</th>
                            </tr>
                         </thead>
                         <tbody class="tbody">
                          <?php
                          //echo $project_id;
                        	$cond.=" AND pj.project_id=$project_id";
                    		\Property\PropertyClass::Init();
                    		$rows = \Property\PropertyClass::GetPropertiesDatas('','',$cond);
                    		$j = 1;
                    		foreach ($rows as $row) 
                    		{
                    		?>
                            <tr>
                                <td><?php echo $row["building"];?></td>
                        		<td><?php echo $row["apartment_no"];?></td>
                        		<td><?php echo $row["level"];?></td>
                        		<td><?php echo $row["aspect"];?></td>
                        		<td><button class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#aspectModal<?php echo $project_id.$row["floor_type"];?>"><i class="fa fa-eye"></i> <?php echo $row["floor_type"];?></button></td>
                        		<!-- Modal -->
                                <div class="modal fade" id="aspectModal<?php echo $project_id.$row["floor_type"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Aspect</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="">
                                     <?php
                    					$Proimagerows = self::GetPropertyImages($project_id,$row["floor_type"]);
                    					foreach ($Proimagerows as $Proimagerow) 
                    					{
                    					$imageFileName=$Proimagerow["image"];
                    					?>
                                          <img src="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $imageFileName;?>" class="img-fluid">
                                        <?php
			                               }?> 
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <td><?php echo $row["land_area"];?></td>
                        		<td><?php echo $row["approx_patio_balcony"];?></td>
                        		<td><?php echo $row["no_of_parkingspace"];?></td>
                        		<td><?php echo $row["no_of_bedrooms"];?></td>
                        		<td><?php echo $row["no_of_bathroom"];?></td>
                        		
                                <td><?php echo round($row["dynamic_rate"],2);?></td>
                               <td>
                                   <a class="btn btn-secondary btn-sm" href="<?php echo SITE_BASE_URL; ?>Property/PropertyFullDtl.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $project_id; ?>">ANALYSE</a>
                                   <!--<a class="btn btn-success btn-sm" href="#">Reserve</a>-->
                                   <?php 
                                   if($row["sold_to"]!='' && $row["sold_to"]!=null && '1'=='2'){
                        			   echo "<span style='color:green;background-color:yellow'><b><br>PURCHASED</b></span>";
                        		   }
                        		   elseif($row["reserved_by"]==\settings\session\sessionClass::GetSessionDisplayName() && '1'=='2'){?>
                        		      <a class="btn btn-danger btn-sm" href="<?php echo SITE_BASE_URL; ?>Property/Cancel.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $project_id; ?>">Cancel</a>
                        		  
                        			   <?php 
                        				if($reservedCount==$totalCount){?>
                        				    <a class="btn btn-info btn-sm" href="<?php echo SITE_BASE_URL; ?>Property/Purchase.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $project_id; ?>">Purchase</a>
                        			   <?php
                        				}
                        		   }
                        			  elseif($row["reserved_by"]!="" &&$row["reserved_by"]!=null){
                        			  ?>
                        		            <button  class="btn btn-success btn-sm"  disabled> Reserve </button>
                        		   <?php }
                        		   else{?>
                        		        <a class="btn btn-success btn-sm" href="<?php echo SITE_BASE_URL; ?>Property/Reserve.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $project_id; ?>">Reserve</a>
                        		   <?php } ?>
                                </td>
                            </tr>
                            <?php
		                    }
		                    ?>
                         </tbody>
                      </table>
                   </div>
                </div>
              </div>
        </div>
      </div>
      <!-- end accordion -->
   </div>
   <!-- end col -->
</div>
<!-- end row -->
<!-- end pricelist table-->
<!-- capital grain -->
<div class="row mt-30">
   <!-- capital grain chart -->
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <h4 class="card-title">Capital Grain</h4>
            <div class="chart-wrapper">
               <div class="" id="capitalGrain1"></div>
            </div>
         </div>
      </div>
   </div>
   <!-- end property content -->
   <div class="col-12">
      <div class="card">
         <div class="card-body">
           <p class="para-primary mb-0"><span class="more">Each of the upper levels has been designed to maximise the sense of space. The generously sized windows reinforce this idea by providing abundant daylight and an exceptional outlook.<br><br>
            To maximise your view and privacy, the floor level apartments have been staggered in height and off-set in plan. Complimentary to this, you benefit from a privacy screen that provides solar and visual screening. <br><br>
            The upper levels of both buildings feature two bedroom apartments that are designed to maximise the sense of space within a compact, efficient plan. The exterior has generously sized windows to provide good outlook and daylight. <br><br>
            Where there is the possibility of overlooking, or a reduction in privacy between opposing or adjacent apartments, privacy screens have been provided on the decks. These can provide solar, in addition to visual, screening. On the street façade, the decks facing the road have been provided with extra sliding screens, to afford additional privacy to these apartments.
            </span>
         </p>
         </div>
      </div>
   </div>
</div>
<!-- end capital grain row -->
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-body">
            <h4 class="card-title">Subrub Growth</h4>
            <div class="chart-wrapper">
               <canvas id="double-line-graph"></canvas>
            </div>
         </div>
      </div>
   </div>
   <!-- growth chart -->
   <div class="col-12 col-md-6 col-lg-6">
      <div class="card h-100 mb-lg-0">
         <div class="card-body">
            <h4 class="card-title">Rental Median</h4>
            <div class="chart-wrapper">
               <div id="growthChart"></div>
            </div>
            <div class="list-group-wrapper">
               <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                     Rental Growth 
                     <span class="badge">$300</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                     Capital Growth 
                     <span class="badge">$834.35</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                     Area Growth 
                     <span class="badge">$507.38</span>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <!-- end growth chart -->
   <!-- product sale 30 days -->
   <div class="col-12 col-md-6 col-lg-6">
      <div class="card h-100">
         <div class="card-body">
            <h4 class="card-title">Population Growth</h4>
            <div class="chart-wrapper">
               <div id="productSale"></div>
            </div>
         </div>
      </div>
   </div>
   <!-- end product sale 30 days-->
</div>
<!-- reserve property -->
<!--<div class="row">-->
<!--   <div class="col-12 mt-30">-->
<!--      <div class="">-->
<!--         <div class="">-->
<!--            <div class="input-group">-->
<!--               <div class="input-group-prepend">-->
<!--                  <span class="input-group-text">Two Bedroom</span>-->
<!--               </div>-->
<!--               <div class="input-group-prepend">-->
<!--                  <span class="input-group-text">x</span>-->
<!--                  <input type="number" class="form-control text-center" value="3">-->
<!--               </div>-->
<!--               <input type="text" class="form-control" value="$1,298,000 USD">-->
<!--               <div class="input-group-append">-->
<!--                  <input class="btn btn-primary" type="submit" name="" value="Reserve">-->
<!--               </div>-->
<!--            </div>-->
<!--         </div>-->
<!--      </div>-->
<!--   </div>-->
<!--</div>-->
<!-- end reserve property -->



 <?php
 $i=$i+1;
}
?>


<?php include"footer.php"; ?>
<!-- apexchart -->
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/js/apexcharts.min.js"></script>
<script type="text/javascript">
//----------------------------------
//--------10 year Growth
//----------------------------------

    var options = {
    chart: {
        height: 500,
        type: 'area',
        shadow: {
            enabled: false,
            color: '#bbb',
            top: 3,
            left: 2,
            blur: 3,
            opacity: 1
        },
        toolbar:{
          show:false
        },
    },
    stroke: {
        width: 7,   
        curve: 'smooth'
    },
    series: [{
        name: 'Groth Rate',
        data: [400000, 300000, 1000000, 900000, 2900000, 1900000, 2200000, 900000, 1200000, 700000]
    }],
    xaxis: {
        type: '10 Years Growth',
        categories: ['1/11/20010', '2/11/2011', '3/11/2012', '4/11/2013', '5/11/2014', '6/11/2015', '7/11/2016', '8/11/2017', '9/11/2018', '10/11/2019', '11/11/2020'],
    },
    fill: {
        type: 'gradient',
        gradient: {
            shade: 'dark',
            gradientToColors: [ '#FDD835'],
            shadeIntensity: 1,
            type: 'horizontal',
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100, 100, 100]
        },
    },
    markers: {
        size: 4,
        opacity: 0.9,
        colors: ["#FFA41B"],
        strokeColor: "#fff",
        strokeWidth: 2,
         
        hover: {
            size: 7,
        }
    },
    yaxis: {
        min: 0,
        max: 4000000,
        title: {
            text: 'Capital Grain',
            style: {
              fontSize: '18px',
              fontFamily: 'Roboto',
            },
        },                
    },
    responsive: [{
      breakpoint: 1440,
      options: {
        chart: {
          height: 350,
        }
      }
    }]
}

var chart = new ApexCharts(
    document.querySelector("#capitalGrain1"),
    options
);

chart.render();
   
   
   
   //progressive circle growth chart
   var options = {
   chart: {
     width:"100%",
     height: 350,
     type: 'radialBar',
   },
   legend: {
     show: false
   },
   plotOptions: {
     radialBar: {
       dataLabels: {
         name: {
           fontSize: '22px',
         },
         value: {
           fontSize: '16px',
         },
         total: {
           show: false,
           label: 'Total',
           formatter: function (w) {
             // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
             return 249
           }
         }
       }
     }
   },
   
   series: [44, 55, 67],
   labels: ['Rental Growth', 'Capital Growth', 'Area Growth'],
   responsive: [{
     breakpoint: [1280,1440],
     options: {
       chart: {
         height: [300,350],
       }
     }
   }]
   }
   
   var grainChart = new ApexCharts(
   document.querySelector("#growthChart"),
   options
   );
   
   grainChart.render();
   

   //progressive circle growth chart
   var options = {
   chart: {
     width:"100%",
     height: 350,
     type: 'radialBar',
   },
   legend: {
     show: false
   },
   plotOptions: {
     radialBar: {
       dataLabels: {
         name: {
           fontSize: '22px',
         },
         value: {
           fontSize: '16px',
         },
         total: {
           show: false,
           label: 'Total',
           formatter: function (w) {
             // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
             return 249
           }
         }
       }
     }
   },
   
   series: [44, 55, 67,12],
   labels: ['Median listing price', '1 yr listing price growth', 'Median weekly rent','Median gross yield'],
   responsive: [{
     breakpoint: 1440,
     options: {
       chart: {
         height: 300,
       }
     }
   }]
   }
   
   var grainChart = new ApexCharts(
   document.querySelector("#medianChart"),
   options
   );
   
   grainChart.render();
   
   //----------------------------------
   //--------product sale 30 days
   //----------------------------------
   var options = {
         series: [{
         name: 'Cash Flow p/a(pre-tax)',
         data: [6268, 4777, 3196, 1192]
       }, {
         name: 'Cash Flow p/a(after-tax)',
         data: [6269, 4778, 3196, 1192]
       },
   
       {
         name: 'Gross yield',
         data: [5.04, 3.81, 4.05, 4.69]
       },
       {
         name: 'Net yield',
         data: [3.59, 3.81, 4.05, 4.69]
       },
        {
         name: 'Total return(cash & growth)',
         data: [34531, 113309, 206217, 510225]
       }],
         chart: {
         type: 'bar',
         height: 450
       },
       plotOptions: {
         bar: {
           horizontal: false,
           columnWidth: '55%',
           endingShape: 'rounded'
         },
       },
       dataLabels: {
         enabled: false
       },
       stroke: {
         show: true,
         width: 2,
         colors: ['transparent']
       },
       xaxis: {
         categories: ['Year1', 'Year3', 'Year5', 'Year10' ],
       },
       yaxis: {
         title: {
           text: '$ (thousands)'
         }
       },
       fill: {
         opacity: 1
       },
       tooltip: {
         y: {
           formatter: function (val) {
             return "$ " + val + " thousands"
           }
         }
       }
       };
   
       var chart = new ApexCharts(document.querySelector("#productSale"), options);
       chart.render();
</script>

<script src="<?php echo SITE_BASE_URL;?>assets/plugins/chartjs/Chart.bundle.js"></script>
<script type="text/javascript">
$(function () {
    "use strict";

    //Double Line Graph 
    var ctx = document.getElementById("double-line-graph");
    ctx.height = 100;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
            type: 'line',

            datasets: [{
                label: "My First dataset",
                data: [50, 26, 36, 30, 46, 38, 60],
                backgroundColor: "rgba(255,117,136,0.12)",
                borderColor: "#FF4961",
                pointRadius: 0,
                lineTension: 0,
            },
            {
                label: "My First dataset",
                data: [35, 40, 48, 25, 35, 45, 40],
                backgroundColor: "rgba(76,132,255,0.12)",
                borderColor: "#4c84ff",
                pointRadius: 0,
                lineTension: 0,
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
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
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

});
</script>