<?php include "header.php"; ?>
<!-- main content -->

<div class="content">
<form action="<?php echo SITE_BASE_URL;?>Property/PropertDtl.html" method="post" class="login-form" name='form1'>
<?php
$country = $_REQUEST["country"];
$project_id = $_REQUEST["project_id"];

\Property\PropertyClass::Init();
$rows = \Property\PropertyClass::GetPropertiesDatas('',$country);
$i = 1;
foreach ($rows as $row) 
    {
        $BrochureFile = isset($row["BROCHURE_FILE"]) ? $row["BROCHURE_FILE"] : ""; 
    ?>
   <section class="property-section mt-5">
       <div class="card">
         <div class="card-body">
      <!-- property row -->
      <div class="row">
         <!-- property overview -->
         <div class="col-9">
            <div class="title-area">
               <h2 class="heading-primary">
                   <a class="property-title" href='<?php echo SITE_BASE_URL; ?>Property/PropertDtl.html?id=<?php echo $row["property_id"]; ?>'>
                       <?php echo $row["apartment_no"]; ?>|<?php echo $row["building"]; ?>|<?php echo $row["project_name"]; ?> | <?php echo $row["country"]; ?>
                   </a>
               </h2>
            </div>
            <div class="row">
               <div class="col-12 col-xxl-10">
                  <ul class="list-inline facility-card-list">
                     <li class="list-inline-item">
                        <div class="card facility-card">
                           <div class="card-body">
                              <div class="row no-gutters">
                                 <div class="col-7 facility-left-col">
                                    <div class="facility-icon">
                                       <img src="<?php echo SITE_BASE_URL;?>assets/img/parking-icon.png" class="img-fluid">
                                    </div>
                                    <span class="facility-text">
                                    PARKING
                                    </span>
                                 </div>
                                 <div class="col-5 facility-right-col parking-bg">
                                    <div class="facility-quantity"><?php echo $row["no_of_parkingspace"]; ?></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li class="list-inline-item">
                        <div class="card facility-card">
                           <div class="card-body">
                              <div class="row no-gutters">
                                 <div class="col-7 facility-left-col">
                                    <div class="facility-icon">
                                       <img src="<?php echo SITE_BASE_URL;?>assets/img/bedroom-icon.png" class="img-fluid">
                                    </div>
                                    <span class="facility-text">
                                    ROOM
                                    </span>
                                 </div>
                                 <div class="col-5 facility-right-col room-bg">
                                    <div class="facility-quantity"><?php echo $row["no_of_bedrooms"]; ?></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li class="list-inline-item">
                        <div class="card facility-card">
                           <div class="card-body">
                              <div class="row no-gutters">
                                 <div class="col-7 facility-left-col">
                                    <div class="facility-icon">
                                       <img src="<?php echo SITE_BASE_URL;?>assets/img/bathroom-icon.png" class="img-fluid">
                                    </div>
                                    <span class="facility-text">
                                    ROOM
                                    </span>
                                 </div>
                                 <div class="col-5 facility-right-col bathroom-bg">
                                    <div class="facility-quantity"><?php echo $row["no_of_bathroom"]; ?></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
               <div class="col-8 mt-3">
                  <div class="list-group-wrapper">
                     <div class="">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>OVERVIEW</th>
                              <th>Year 1</th>
                              <th>Year 3</th>
                              <th>Year 5</th>
                              <th>Year 10</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Cash flow p/a (pre-tax)</td>
                              <td class="text-warning">($6,268)</td>
                              <td class="text-warning">($4,777)</td>
                              <td class="text-warning">($3,196)</td>
                              <td>$1,192</td>
                           </tr>
                           <tr>
                              <td>Cash flow p/a (after-tax)</td>
                              <td class="text-warning">($6,268)</td>
                              <td class="text-warning">($4,777)</td>
                              <td class="text-warning">($3,196)</td>
                              <td>$1,192</td>
                           </tr>
                           <tr>
                              <td>Gross yield</td>
                              <td>5.04%</td>
                              <td>5.35%</td>
                              <td>5.67%</td>
                              <td>6.58%</td>
                           </tr>
                           <tr>
                              <td>Net yield</td>
                              <td>3.59%</td>
                              <td>3.81%</td>
                              <td>4.05%</td>
                              <td>4.69%</td>
                           </tr>
                           <tr>
                              <td>Total returns (cash & growth)</td>
                              <td>$34,531</td>
                              <td>$113,309</td>
                              <td>$206,217</td>
                              <td>$510,925</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end property overview-->
         <!-- rating and preview -->
         <div class="col-3 rating-col">
            <div class="ratingcol-inner">
               <div class="preview-box">
                  <div class="preview-img">
                     <img src="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $row["property_image"]; ?>" class="img-fluid preview-img-thumb">
                     <?php
                   $Proimagerows = self::GetPropertyImages($row["project_id"],$row["floor_type"]);
        			foreach ($Proimagerows as $Proimagerow) 
        			{
        			    $imageFileName=$Proimagerow["image"];?>
        			    <a class="preview-link" data-fancybox="gallery" href="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $imageFileName;?>"><img src="<?php echo SITE_BASE_URL;?>uploads/propertyimage/expand.png" class="img-fluid"></a>
        			<?php
        			}?>
                  </div>
               </div>
               <div class="rating-box">
                  <div class="stars">
                     <nav class="navbar navbar-expand-sm">
                        <ul class="navbar-nav">
                           <li class="nav-item"><span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star empty-star"></span>
                           </li>
                        </ul>
                        <ul class="nav navbar-nav ml-auto">  
                           <span class="rating-number">(12,775)</span>
                        </ul>
                     </nav>
                  </div>
                  <div class="customer-rating">
                     <h4>Customer-rating</h4>
                  </div>
                  <div class="property-action mt-5">
                     <div class="property-btn-group">
                        
                        <?php if ($BrochureFile != ""){ ?>
                            <a class="btn btn-outline-primary btn-block" href="javascript:void(0)" onclick="AddToMyFolderFn('<?php echo $BrochureFile; ?>')">Save Brochure to My Folder</a>
                            <a class="btn btn-outline-primary btn-block" target="blank" href="<?php echo SITE_BASE_URL; ?>uploads/brochure/<?php echo $row["BROCHURE_FILE"]; ?>">Download Brochure</a>
                        <?php } ?>
                        
                        <a class="btn btn-outline-primary btn-block" href="<?php echo SITE_BASE_URL; ?>Property/PropertyFullDtl.html?id=<?php echo $row["property_id"]; ?>">Analyse in full</a>
                        <a class="btn btn-outline-primary btn-block" href="<?php echo SITE_BASE_URL; ?>Property/PropertDtl.html?id=<?php echo $row["property_id"]; ?>">Property Details</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end rating and preview -->
      </div><!-- end property row -->
      <div class="row">
         <!-- line chart col-->
         <div class="col-12">
            <!--chart-->
            <div class="chart-wrapper">
               <h2 class="heading-secondary">Capital Growth</h2>
               <div class="chart-div" id="linechart<?php echo $i;?>"></div>
            </div>
         </div>
         <!-- end line chart col-->
      </div>
      </div>
      </div>
   </section>
<?php 
    $i++;
} ?>
<input type=hidden name='formcount' value='<?php echo $i-1;?>'/>
</form>
</div>
<!-- end main content -->
<?php include"footer.php"; ?>


<script>
function AddToMyFolderFn(filename){
    url = "http://duvalknowledge.com/dpo/Masters/AddToMyFolder.html?filename=" + filename;
    
	$.colorbox({iframe:true, href:url, innerWidth:700, innerHeight:300 });
	//, onClosed:function(){window.location.reload();}
}
</script>