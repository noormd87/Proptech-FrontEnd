<?php include "header.php";?>
<form action="<?php echo SITE_BASE_URL;?>Property/Properties.html?project_id=<?php echo $_REQUEST["project_id"]; ?>&country=<?php echo $_REQUEST["country"]; ?>" method="post" class="" name='form1'>	
<?php
 $country = $_REQUEST["country"];
 $project_id = $_REQUEST["project_id"];
 if($project_id=='' ||$project_id==null)
 {
     $project_id=1;
 }
 $IsView="Y";
$rowsells = \Property\PropertyClass::ProjectSellingDtl($_REQUEST["project_id"]);
foreach ($rowsells as $rowsell) 
{
    $reservedCount=$rowsell["reserved_count"];
    $soldCount=$rowsell["sold_count"];
    $totalCount=$rowsell["total_count"];
    if($totalCount=='' ||$totalCount=='0' || $totalCount==null)
    {
        //$totalCount=1;
    }
    $Available=$totalCount-$reservedCount;
}

\Property\PropertyClass::Init();
 $Projectrows = \Property\PropertyClass::GetPorjectDatas($country,$project_id);
 $i = 1;
 foreach ($Projectrows as $Projectrow) 
     {
         $project_id = isset($Projectrow["PROJECT_ID"]) ? $Projectrow["PROJECT_ID"] : ""; 
     ?>
  <div class="row mb-30">
   <!-- property content -->
   <div class="col-lg-8">
      <div class="card h-100 mb-0">
         <div class="card-body">
            <div class="card-title"><a class="text-dark" href="#">
                <?php echo $Projectrow["PROJECT_NAME"];?>
              </a>
              <h5 class="mt-2 text-success"><?php echo $Projectrow["PROJECT_DESCRIPTION"];?></h5></div>
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
            <div class="row">
              <div class="col-lg-6">
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
              <div class="col-lg-6">
                <div>
                  <div class="text-right">
                    <h2 class="f-s-30 m-b-0 oswald text-warning"><?php echo $totalCount;?></h2>
                    <span class="f-w-600"> Total Property</span>
                  </div>
                    <div class="m-t-30">
                        <h4 class="f-w-600 oswald text-danger"><?php echo $Available;?></h4>
                        <h6 class="m-t-10 text-muted">Available Property
                            <span class="pull-right">
                                <?php 
                                if($totalCount=='' ||$totalCount=='0' || $totalCount==null)
                                {
                                    echo "NO PROPERTIES";   
                                }
                                else
                                {
                                    echo round((($Available)/$totalCount)*100,2)."%";
                                }
                                ?>
                            </span>
                        </h6>
                        <div class="progress m-t-15 h-6px">
                            <div role="progressbar" class="progress-bar bg-warning wow animated progress-animated w-<?php if($totalCount=='' ||$totalCount=='0' || $totalCount==null){ echo 0;   }else{ echo round(((($Available)/$totalCount)/5)*100,0)*5;} ?>pc h-6px">
                            </div>
                        </div>
                    </div>
                </div>
              </div>
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
   <div class="col-lg-4">
      <div class="card rating-card h-100 mb-0">
         <div class="card-body">
            <a href="#">
               <div class="">
                  <img src="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $Projectrow["image_file"]; ?>" class="img-fluid preview-img-thumb">
               </div>
            </a>
            <!-- <div class="rating row no-gutters">
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
            </div> -->
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

	<div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">





            <h4>Your Reserved Property</h4>




             <div class="table-wrapper">
              <div class="table-responsive">
                    

                  <thead class='bg-b1'>
                   <table class="table">
                    <!--<tr>-->
                    <!--  <th>BUILDING</th>-->
                    <!--  <th>APT NO</th>-->
                    <!--  <th>LEVEL</th>-->
                    <!--  <th>LOCK-IN PRICE($)</th>-->
                    <!--  <th>CURRENT PRICE($)</th>-->
                    <!--  <th>DISCOUNT($)</th>-->
                    <!--  <th>DEAL PRICE($)</th>-->
                    <!--  <th>TIME LEFT TO DEAL($)</th>-->
                    <!--</tr>-->
                  </thead>
                  <tbody> 
                    <?php
                	$project_id=$_REQUEST["project_id"];
            		$cond1.=" AND pj.project_id=$project_id and pd.reserved_by='".$LoginUserId."' ";
            		\Property\PropertyClass::Init();
            		$rows1 = \Property\PropertyClass::GetPropertiesDatas('','',$cond1);
            		$j = 1;
            		foreach ($rows1 as $row1) 
            		{
            		    $effective_date=$row["effective_date"];
            		    $projectName=$row1["project_name"];
            		    $country=$row1["country"];
            		    $ProjectIdd=$row1["project_id"];
            		    $floortype=$row1["floor_type"];
                        $CountryName=$row["country_name"];
                        $expiry_date=$row["expiry_date"];
                        $date = date("Y-m-d h:i:s");
                        $effective_date1 = strtotime($effective_date);  
                        $expiry_date1 = strtotime($expiry_date);  
                        $date1 = strtotime($date);  
                        $diff = abs($expiry_date1 - $date1); 
                        $Projectcurrency=$row["currency"];
                          if($Currency==$Projectcurrency)
                          {
                              $Xrate=1;
                          }
                          else
                          {
                               $Xraterows = \Property\PropertyClass::GetCurrExrate($Projectcurrency,$Currency);
                               $j = 1;
                               foreach ($Xraterows as $Xraterow) 
                               {
                                   $Xrate=$Xraterow["RATE"];
                               }
                          }
                          if($Xrate=="" || $Xrate==null){
                              $Xrate=1;
                          }
                        
                        $years = floor($diff / (365*60*60*24));  
                        $months = floor(($diff - $years * 365*60*60*24) 
                                                       / (30*60*60*24)); 
                        $days = floor(($diff - $years * 365*60*60*24 -  
                                     $months*30*60*60*24)/ (60*60*24)); 
                        $hours = floor(($diff - $years * 365*60*60*24  
                               - $months*30*60*60*24 - $days*60*60*24) 
                                                           / (60*60));  
                        $minutes = floor(($diff - $years * 365*60*60*24  
                                 - $months*30*60*60*24 - $days*60*60*24  
                                                  - $hours*60*60)/ 60);  
                        $seconds = floor(($diff - $years * 365*60*60*24  
                                 - $months*30*60*60*24 - $days*60*60*24 
                                        - $hours*60*60 - $minutes*60));
                        if($Currency=="NZD"){
                            $Prefix="NZ $";   
                        }
                        elseif($Currency=="AUD"){
                            $Prefix="AU $";   
                        }
                        elseif($Currency=="GBP"){
                            $Prefix="£";   
                        }
                        else
                        {
                            $Prefix=$Currency." ";   
                        }
            		?>



<div class="row justify-content-between">
         <div class="col border-right-1 align-self-center">
            <div class="project-img">
                <?php
               
                
					$Proimagerows = \Property\PropertyClass::GetPropertyImages($ProjectIdd,$floortype);
					foreach ($Proimagerows as $Proimagerow) 
					{
					$imageFileName=$Proimagerow["image"];
					}?>
               <div class="project-img-inner">
                  <img src="<?php echo SITE_BASE_URL; ?>uploads/propertyimage/<?php echo $imageFileName; ?>" class="img-fluid">
               </div>
            </div>
         </div>
         <div class="col border-right-1 align-self-center">
            <div class="properties-details-wrapper">
               <div class="properties-details-inner">
                  <h5 class="project-name"><?php echo $projectName;?></h5>
                  <p class="project-location"><?php echo $CountryName;?></p>
                  <div class="prop-details">
                    <div class="d-flex justify-content-between ">
                        <div class="bg-primary prop-detail-list"><?php echo $row1["no_of_bedrooms"];?> <i class="fa fa-bed"></i></div>
                        <div class="bg-warning prop-detail-list"><?php echo $row1["no_of_bathroom"];?> <i class="fa fa-shower"></i></div>
                        <div class="bg-info prop-detail-list"><?php echo $row1["no_of_parkingspace"];?> <i class="fa fa-car"></i></div>
                    </div>
                  </div>
                  <div class="">
                    <h5 class="alt-1"><?php echo $days;?> days <?php echo $hours;?>h<?php echo $minutes;?>m<?php echo $seconds;?>s</h5>
                  </div>
               </div>
            </div>
         </div>
         <div class="col border-right-1 align-self-center">
            <div class="property-price-list">
                <div class="prop-price-list-inner">
                     <p>Current Price<br><span class="price text-dark"><s><?php echo $Prefix." ".number_format(round($row1["dynamic_rate"]*$Xrate,2));?></s></span> <img src="<?php echo SITE_BASE_URL; ?>assets/img/icon/price-drop-dark.png" class="img-fluid"></p>
                        <hr>
                        <p>Discount<br><span class="price text-success"><?php echo $Prefix." ".number_format(round(($row1["lockin_rate"]-$row1["dynamic_rate"])*$Xrate,2));?></span> <img src="<?php echo SITE_BASE_URL; ?>assets/img/icon/decrease-graph.png" class="img-fluid"></p>
                        <hr>
                        <p>Market Price<br><span class="price text-danger"><s><?php echo $Prefix." ".number_format(round($row1["start_rate"]*$Xrate,2));?></s></span> <img src="<?php echo SITE_BASE_URL; ?>assets/img/icon/price-drop-dark.png" class="img-fluid"></p>
                        <hr>
                        <p>Deal Price<br><span class="price text-warning"><?php echo $Prefix." ".number_format(round($row1["dpo_rate"]*$Xrate,2));?></span> <img src="<?php echo SITE_BASE_URL; ?>assets/img/icon/decrease-graph.png" class="img-fluid"></p>
                        
                </div>
            </div>
         </div>
         <div class="col align-self-center">
            <div class="property-price-list">
                <div class="prop-price-list-inner">
                    <p class="mb-1">Lock-In Price<br><span class="price text-primary"><?php echo $Prefix." ".number_format(round($row1["lockin_rate"]*$Xrate,2));?></span> <img src="<?php echo SITE_BASE_URL; ?>assets/img/icon/price-drop-dark.png" class="img-fluid"></p>
                </div>
            </div>
            <div class="action-btn-group">
                <!--<a <?php if($row["reserved_by"]!="" &&$row["reserved_by"]!=null){?>disabled<?php } ?> class="btn btn-rounded btn-sm btn-warning btn-block" href="<?php echo SITE_BASE_URL; ?>Property/Reserve.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $project_id; ?>" nowrap>Reserve</a>-->
                <!--<br>-->
                <a class="btn btn-rounded btn-sm btn-primary btn-block" href="<?php echo SITE_BASE_URL; ?>Property/PropertyFullDtl.html?id=<?php echo $row1["property_id"]; ?>" nowrap>ANALYSE</a>
                          
            </div>
         </div>
      </div>

                     <!-- <tr>
                      <td><?php //echo $row1["building"];?></td>
                      <td><?php //echo $row1["apartment_no"];?></td>
                      <td><?php //echo $row1["level"];?></td>
                      <td><span class="bg-success"><?php //echo $row1["lockin_rate"];?></span></td>
                      <td><?php //echo $row1["dynamic_rate"];?></td>
                      <td> <?php //echo $row1["lockin_rate"]-$row1["dynamic_rate"];?></td>
                      <td><?php //echo $row1["dpo_rate"];?></td> -->
                      <!--<th><?php //echo $days."Days ".$hours."Hrs ".$minutes."Mins ".$seconds."Sec";?></th>-->
                      <!-- <th><?php //echo $days." Days";?></th>
                    </tr> -->
                    <?php
                    $j=$j+1;
            		}
                    if($j==1)
                    {
                        echo "<tr><td align=center colspan=8><b>No Records</b></td></tr>";
                    }
                    ?>
                     </tbody>
                </table>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>

	 <div class="row">

		<div class="col-12">
		  <div class="card">
			<div class="card-body">
			  <div class="mb-30">
			  	  <h4>Available Property</h4>
	              <div class="progress-outer m-t-20">
	              	<div class="progress">
		                  <div class="progress-bar progress-bar-warning progress-bar-striped active <?php if( $Available==0) { ?> bg-info<?php  }  ?>" style="width: <?php if( $Available==0) { ?>100<?php  }  ?><?php echo round(($Available/$totalCount)*100,2);?>%; height:15px;" role="progressbar"><?php echo round((($Available)/$totalCount)*100,2);?>%</div>
		              </div>
	              </div>
			  </div>		
			  <div class="card-title">
				 <h4>List of Available Property</h4>
				 <input type=hidden name='ProjectId' value='<?php echo $project_id; ?>'>
			  </div>
			  <div class="table-responsive pricelist-table-responsive">
				   <?php 
				   $IsAvailable="Y";
				   include"PropertyTbl.php"; ?>
				</div>
			 </div>
			 </div>
		  </div>
		</div>
		
		<div class="row">
  		<div class="col-12">
  		  <div class="card">
  		    <div class="card-body">    
  			  <div class="card-title">
  				 <h4>List of Reserved Property</h4>
  				 <input type=hidden name='ProjectId' value='<?php echo $project_id; ?>'>
  			  </div>
  			  <div class="table-responsive pricelist-table-responsive">
  				   <?php
  				   $IsAvailable='';
  				   $IsReserved="Y";
  				   include"PropertyTbl.php"; 
  				   ?>
  				</div>
  			 </div>
  		  </div>
  		 </div>
		  </div>
		
	</div>
<?php
 $i=$i+1;
}

$LocationId = "201576";
$StreetId   = "";
$ZipcodeId  = "";
?>
  <input type=hidden name='formcount' value='<?php echo $i-1;?>'/>
</form>
    <!-- form -->
<?php include"footer.php"; ?>


<script src="<?php echo SITE_BASE_URL; ?>assets/plugins/countdown-timezone/jquery.countdown.js"></script>
<script>
    window.jQuery(function ($) {
    "use strict";

    $('time').countDown({
        with_separators: false
    });
    $('.alt-1').countDown({
        css_class: 'countdown-alt-1'
    });
    $('.alt-2').countDown({
        css_class: 'countdown-alt-2'
    });

});
</script>