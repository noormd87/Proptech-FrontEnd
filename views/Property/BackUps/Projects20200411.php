<?php include"header.php"; ?>
<!-- apexchart -->  
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/css/apexcharts.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/css/apexcharts.min.css.map">
<!-- property row -->
<!--<form  action="<?php echo SITE_BASE_URL;?>Property/Projects.html?project_id=<?php echo $_REQUEST["project_id"]; ?>&country=<?php echo $_REQUEST["country"]; ?>" method="post" class="" name='form1'>-->
<?php
 $country = $_REQUEST["country"];
 $project_id = $_REQUEST["project_id"];
 if($project_id=='' ||$project_id==null)
 {
     //$project_id=1;
 }
 \Property\PropertyClass::Init();
 $Projectrows = \Property\PropertyClass::GetPorjectDatas($country,$project_id);
 $i = 1;
 foreach ($Projectrows as $Projectrow) 
     {
         $project_id = isset($Projectrow["PROJECT_ID"]) ? $Projectrow["PROJECT_ID"] : ""; 
         $project_currency = isset($Projectrow["currency"]) ? $Projectrow["currency"] : ""; 
         
         $rowsells = \Property\PropertyClass::ProjectSellingDtl($project_id);
            foreach ($rowsells as $rowsell) 
            {
                $reservedCount=$rowsell["reserved_count"];
                $soldCount=$rowsell["sold_count"];
                $totalCount=$rowsell["total_count"];
                if($totalCount=='' ||$totalCount=='0' || $totalCount==null)
                {
                    $totalCount=1;
                }
                $Available=$totalCount-$reservedCount;
            }
     ?>




<div class="row">
   <!-- property content -->
   <div class="col-lg-8">
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
                            <span class="pull-right"><?php echo round((($Available)/$totalCount)*100,2);?>%</span>
                        </h6>
                        <div class="progress m-t-15 h-6px">
                            <div role="progressbar" class="progress-bar bg-warning wow animated progress-animated w-<?php echo round(((($Available)/$totalCount)/5)*100,0)*5;?>pc h-6px">
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
                  <img src="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $Projectrow["image_file"]; ?>" class="img-fluid preview-img-thumb" width="100%">
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
<!-- end property row -->

<!-- pricelist table -->
<!-- start row -->
<div class="row mb-30">
   <!-- start col -->
   <div class="col-12">
    <!-- accordion -->
      <div id="accordion" class="accordion mt-30">
        <div class="card mb-0">
            <div class="card-header collapsed" data-toggle="collapse" href="#collapsePricelistTable<?php echo $i;?>">
                <a class="card-title"> Pricelist and Property Investment Analysis </a>
            </div>
            <div id="collapsePricelistTable<?php echo $i;?>" class="card-body collapse" data-parent="#accordion">
                <div class="pricelist-table">
                    <form class="form-inline" name='form1' >
                      <div class="form-group mb-2">
                          <label class="mr-2">Currencies</label>
                          <select class="form-control ChangeCur">
                            <option value="1###<?php echo $Projectrow["PROJECT_ID"]?>###<?php echo $project_currency;?>" ><?php echo $project_currency;?></option>
                            <?php
                            $rowExRates = \Property\PropertyClass::GetCurrExrate($project_currency);
                            foreach ($rowExRates as $rowExRate) 
                            {?>
                                <option value="<?php echo $rowExRate["RATE"];?>###<?php echo $Projectrow["PROJECT_ID"]?>###<?php echo $rowExRate["currency"];?>"><?php echo $rowExRate["currency"];?></option> 
                            <?php 
                            }
                            ?>
                          </select>
                      </div>
                      <div class="form-group mx-sm-3 mb-2">
                            <label class="mr-2">Size in</label>
                            <select class="form-control ChangeSize">
                              <option value="1###<?php echo $Projectrow["PROJECT_ID"]?>###m" selected><sup>Meter</option>
                              <option value="10.7639###<?php echo $Projectrow["PROJECT_ID"]?>###ft" >Feet</option>  
                            </select>
                      </div>
                      <div class="form-group mx-sm-3 mb-2">
                            <a href="<?php echo SITE_BASE_URL;?>CSV_Downloads/<?php echo $Projectrow["PROJECT_NAME"];?>.csv" class="btn btn-primary btn-block">Save as CSV</a>
                      </div>
                      <!--<button type="button" class="btn btn-dark mb-2 Compare" data-toggle="modal" data-target="#exampleModalCenter">Compare</button>-->
                       <div class="table-responsive">
                          <table class="data-table table table-hover table-striped mb-0">
                         <thead class="">
                            <tr>
                               <th>#</th>
                               <th>Building</th>
                               <th>APT No</th>
                               <th>Level</th>
                               <th>Aspect</th>
                               <th>Floorplan</th>
                               <th>APT Size<br>(approx BOMA <span class='size<?php echo $Projectrow["PROJECT_ID"]?>'><a class="active apt-size" href="#">m<sup>2</sup></a></span>)</th>
                               <th>Approx Patio<br>Balcony (<span class='size<?php echo $Projectrow["PROJECT_ID"]?>'><a class="active apt-size" href="#">m<sup>2</sup></a></span>)</th>
                               <th>Car park</th>
                               <th>Bed</th>
                               <th>Bath</th>
                               <th>Price <br>GST Incl<br>(<span class='Curr<?php echo $Projectrow["PROJECT_ID"]?>'><a class="active apt-size" href="#">NZD</a></span>)</th>
                               <th>Compare</th>
                               <th>Reservation<br>Fee £2,500</th>
                               <th>Action</th>
                            </tr>
                         </thead>
                         <tbody class="tbody">
                          <?php
                          //=======================
                           $list = array (
                                array('#', 'Building', 'APT No', 'Level','Aspect','Floorplan','APT Size(approx BOMA m2 ft2)','Approx Patio Balcony(m2 ft2)','Car park','Bed','Bath','Price GST Incl','status')
                            );
                            
                            $fp = fopen('CSV_Downloads/'.$Projectrow["PROJECT_NAME"].'.csv', 'w');
                            
                           
                          //=======================
                        	$cond=" AND pj.project_id=$project_id";
                    		\Property\PropertyClass::Init();
                    		$rows = \Property\PropertyClass::GetPropertiesDatas('','',$cond);
                    		$j = 1;
                    		foreach ($rows as $row) 
                    		{
                    		    if(strpos(",".$_SESSION["CompareProperties"].",",",".$row["property_id"].",")>-1)
                                {
                                    $isChecked="checked";
                                }
                                else
                                {
                                    $isChecked="";
                                }
                                if($row["sold_to"]!='' && $row["sold_to"]!=null)
                                {
                                    $PropStatus="SOLD";
                                }
                                else if($row["reserved_by"]!='' && $row["reserved_by"]!=null)
                                {
                                    $PropStatus="RESERVED";
                                }
                                else
                                {
                                    $PropStatus="AVAILABLE";
                                }
                                
                                array_push($list, array($j, $row["building"], $row["apartment_no"], $row["level"],$row["aspect"],$row["floor_type"],$row["land_area"],$row["approx_patio_balcony"],$row["no_of_parkingspace"],$row["no_of_bedrooms"],$row["no_of_bathroom"],round($row["dynamic_rate"],0),$PropStatus));
                    		?>
                            <tr>
                                <td><input type="checkbox" name='CompareProperty' class="check1" value='<?php echo $row["property_id"];?>' style='width: 25px; height: 25px;' <?php echo $isChecked;?> >
                                </td>
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
                                <td><input type='hidden' value='<?php echo $row["land_area"];?>' class='Land'> <span class='spanLand<?php echo $Projectrow["PROJECT_ID"];?>' ><?php echo $row["land_area"];?></span></td>
                        		<td><input type='hidden' value='<?php echo $row["approx_patio_balcony"];?>' class='balcony'> <span class='spanbalcony<?php echo $Projectrow["PROJECT_ID"];?>' ><?php echo $row["approx_patio_balcony"];?></span></td>
                        		<td><?php echo $row["no_of_parkingspace"];?></td>
                        		<td><?php echo $row["no_of_bedrooms"];?></td>
                        		<td><?php echo $row["no_of_bathroom"];?></td>
                        		
                                <td><input type='hidden' value='<?php echo round($row["dynamic_rate"],0);?>' class='qty'> <span class='spanVal<?php echo $Projectrow["PROJECT_ID"]?>' ><?php echo round($row["dynamic_rate"],0);?>$</span></td>
                                <td><a class="btn btn-sm btn-info CompareRow" href="javascript:void(0)" >Add To Compare <i class="fa fa-chevron-right"></i></a>
                                </td>
                                <td style="min-width:175px;">
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
                        			  elseif($row["reserved_by"]!="" && $row["reserved_by"]!=null){
                        			  ?>
                        		            <button  class="btn btn-warning btn-sm"  disabled> Reserved </button>
                        		   <?php }
                        		   else{?>
                        		        <a class="btn btn-success btn-sm" href="<?php echo SITE_BASE_URL; ?>Property/Reserve.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $project_id; ?>">Reserve</a>
                        		   <?php } ?>
                                </td>
                                <td>
                                    <a class="btn btn-secondary btn-sm" href="<?php echo SITE_BASE_URL; ?>Property/PropertyFullDtl.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $project_id; ?>">ANALYSE</a>
                                </td>
                            </tr>
                            <?php
                            $j=$j+1;
		                    }
		                     
		                    foreach ($list as $fields) {
                                fputcsv($fp, $fields);
                            }
                            
                            fclose($fp);
		                    ?>
                         </tbody>
                      </table>
                       </div>
                    </form> 
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
<?php 
$LocationId = $row["location_id"];
$StreetId   = "";
$ZipcodeId  = "";
?>
<div class="row mb-30">
  <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    <div class="card h-100 mb-0">
      <div class="card-body">
          <h4 class="card-title">Recent Median Sale Prices</h4>
          <div class="table-wrapper">
              <table class="table">
                <thead>
                   <tr>
                    <td>&nbsp;</td>
                    <td align="right"><?php echo $Subrub; ?></td>
                  </tr>
                  <tr>
                    <td>Period </td>
                    <td align="right">Median Price</td>
                  </tr>
                </thead>
                <tbody>
                     <?php //include_once("corelogic-json-test.php"); 
                      
                      $MedianTablArr  =  \api\apiClass::ShowMedianTableValueApi($LocationId,$StreetId,$ZipcodeId); 
                       foreach($MedianTablArr as $MedianTabl){
                              
                              $Datas       = $MedianTabl["date"];
                          $Datas2      = $MedianTabl["value"];
                      ?>
                          <tr>
                             <td><?php echo $Datas; ?></td>
                             <td align="right"><?php echo $Datas2; ?></td>
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
    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="card h-100 mb-0">
            <div class="card-body">
              <div class="chart-wrapper">
                  <div id="medianChart<?php echo $i;?>"></div>
                 </div>
              </div>
        </div>
    </div>
</div>


<!-- apexchart -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.15.5/apexcharts.min.js"></script>
 <?php //include_once("corelogic-json-test.php"); 
            echo \api\apiClass::ShowMedianMapApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$i); 
?>

 <?php
 $i=$i+1;
}
if($i==1)
{
    echo '  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card h-100 mb-0">
                    <div class="card-body">
                        <div class="chart-wrapper">
                            <div>No Records</div>
                         </div>
                      </div>
                </div>
            </div>';
}
?>
<script>
    $(function () { 
        $(document).on("click", ".Compare", function(){
            properties=$("#CompareProperties").val();
            //================================
        	    URL = "<?php echo SITE_BASE_URL;?>Property/CompareProperty.html?properties=" + properties ;
                $.ajax({url: URL, success: function(result){
                    $("#ComparedData").html(result);
                }});
        	//===============================   
        });
        
        $(document).on("click", ".CompareRow", function(){
            if($(this).closest("tr").find(".check1").is(":checked"))
            {
                $(this).closest("tr").find(".check1").prop('checked', false); 
                Properties=$(this).closest("tr").find(".check1").val();
                URL = "<?php echo SITE_BASE_URL;?>dashboard/RemoveSessionCompare.html?Properties=" + Properties ;
                $.ajax({url: URL, success: function(result){
                    $("#CompareProperties").val(result);
                    if($("#CompareProperties").val().indexOf(",")>-1)
                    {
                        $("#ShowHide").show();
                    }
                    else
                    {
                        $("#ShowHide").hide();
                    }
                }});
            }
            else
            {
                $(this).closest("tr").find(".check1").prop('checked', true); 
                Properties=$(this).closest("tr").find(".check1").val();
                URL = "<?php echo SITE_BASE_URL;?>dashboard/SetSessionCompare.html?Properties=" + Properties ;
                $.ajax({url: URL, success: function(result){
                    $("#CompareProperties").val(result);
                    if($("#CompareProperties").val().indexOf(",")>-1)
                    {
                        $("#ShowHide").show();
                    }
                    else
                    {
                        $("#ShowHide").hide();
                    }
                }});
            }
            
        });
        
        $( ".ChangeCur" ).change(function() {
          ExRateArr=$(this).val().split("###");
          ExRate=ExRateArr["0"];
          ProjectId=ExRateArr["1"];
          Curr=ExRateArr["2"];
          $(".Curr"+ProjectId).html("<a class='active apt-size' href='#'>"+Curr+"</a>")
            $(".qty").each(function(){
                $(this).next(".spanVal"+ProjectId).html(Math.round($(this).val()*ExRate)+"$"); 
            });
        });
        
        $( ".ChangeSize" ).change(function() {
          SizeArr=$(this).val().split("###");
          SizeConversion=SizeArr["0"];
          ProjectId=SizeArr["1"];
          Size=SizeArr["2"];
            $(".size"+ProjectId).html("<a class='active apt-size' href='#'>"+Size+"<sup>2</sup></a>")
            $(".balcony").each(function(){
                $(this).next(".spanbalcony"+ProjectId).html(Math.round($(this).val()*SizeConversion)); 
            });
            $(".Land").each(function(){
                $(this).next(".spanLand"+ProjectId).html(Math.round($(this).val()*SizeConversion)); 
            });
        });
    });
    
</script>

<?php include"footer.php"; ?>
