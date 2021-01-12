<?php include "header.php";
\login\loginClass::Init();
$checkSession = \login\loginClass::CheckUserSessionIp();
?>

<!-- start form -->
<form action="<?php echo SITE_BASE_URL;?>Property/Properties.html?project_id=<?php echo $_REQUEST["project_id"]; ?>&country=<?php echo $_REQUEST["country"]; ?>" method="post" class="" name='form1'>
      <?php
         $country = $_REQUEST["country"];
         $project_id = $_REQUEST["project_id"];
         
         \Property\PropertyClass::Init();
         $rows = \Property\PropertyClass::GetProjectNew($project_id);
         $i = 1;
         foreach ($rows as $row) 
             {
                 $BrochureFile = isset($row["BROCHURE_FILE"]) ? $row["BROCHURE_FILE"] : ""; 
             ?>
               <!-- start row -->
               <?php
                \Property\PropertyClass::Init();
                $rowsells = \Property\PropertyClass::ProjectSellingDtl($project_id);
                $i = 1;
                foreach ($rowsells as $rowsell) 
                {
                    $reservedCount=$rowsell["reserved_count"];
                    $soldCount=$rowsell["sold_count"];
                    $totalCount=$rowsell["total_count"];
                }
                ?>
               <div class="row">
                  <div class="col-12">
                    <!--  <div class="card">
                        <div class="card-body"> -->
                           <!-- strat row -->
                           <!-- <div class="row">
                              <div class="col-6 col-sm-6 col-md-3">
                                 <div id="progress1">
                                    <p class="text-center smTxt">SOLD</p>
                                 </div>
                              </div>
                              <div class="col-6 col-sm-6 col-md-3">
                                 <div id="progress2">
                                    <p class="text-center smTxt">UNDER CONTRACT</p>
                                 </div>
                              </div>
                              <div class="col-6 col-sm-6 col-md-3">
                                 <div id="progress3">
                                    <p class="text-center smTxt">RESERVED</p>
                                 </div>
                              </div>
                              <div class="col-6 col-sm-6 col-md-3">
                                 <div id="progress4">
                                    <p class="text-center smTxt">AVAILABLE</p>
                                 </div>
                              </div>
                           </div> -->
                           <!-- end row -->
                        <!-- </div>
                     </div> -->
                  </div>
                  <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                          <h4>Available Property</h4>
                          <div class="progress m-t-20">
                              <div class="progress-bar bg-warning" style="width: 100%; height:15px;" role="progressbar">100%</div>
                          </div>
                        </div>
                      </div>
                    </div>
               </div>
               <!-- end row -->
               <!-- property row -->
               <div class="row">
                 <div class="col-lg-12">
                   <div class="card">
                     <div class="card-body">
                       <div class="row">
                          
                          <!-- property overview -->
                          <div class="col-9">
                             <div class="property-title">
                                <a class="property-title" href='#'>
                                 <b><?php echo $row["project_name"]; ?><br><?php echo $row["project_description"]; ?> <br> <?php echo $row["COUNTRY_CODE_NEW"]; ?></b>
                                 </a>
                              </div>

                             <div class="row" style='display:none'>
                                <div class="col-12 col-xxl-10">
                                   <ul class="list-inline facility-card-list">
                                      <?php
                                         $Proimagerows = self::GetProjectFloorWithImage($row["project_id"],'');
                                         foreach ($Proimagerows as $Proimagerow) 
                                         {
                                         //$imageFileName=$Proimagerow["image"];
                                         $FloorType=$Proimagerow["floor_type"];
                                         ?>
                                      <li class="list-inline-item">
                                         <div class="card facility-card">
                                            <div class="card-body">
                                               <div class="row no-gutters">
                                                  <div class="col-7 facility-left-col">
                                                     <div class="facility-icon">
                                                        <?php 
                                                           $Proimagerows = self::GetPropertyImages($row["project_id"],$FloorType);
                                                           foreach ($Proimagerows as $Proimagerow) 
                                                           {
                                                           $imageFileName1=$Proimagerow["image"];?>
                                                        <?php   
                                                           }
                                                                   ?>
                                                        <img src="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo$imageFileName1; ?>" class="img-fluid preview-img-thumb">
                                                        <?php
                                                           $Proimagerows = self::GetPropertyImages($row["project_id"],$FloorType);
                                                           foreach ($Proimagerows as $Proimagerow) 
                                                           {
                                                           $imageFileName=$Proimagerow["image"];
                                                           //echo $imageFileName;?>
                                                        <a class="preview-link" data-fancybox="gallery" href="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $imageFileName;?>">
                                                        <img src="<?php echo SITE_BASE_URL;?>uploads/propertyimage/Expands.png" class="img-fluid"></a>
                                                        <?php
                                                           }?>
                                                     </div>
                                                  </div>
                                                  <div class="col-5 facility-right-col parking-bg">
                                                     <div class="facility-quantity"><?php echo $FloorType; ?></div>
                                                  </div>
                                               </div>
                                            </div>
                                         </div>
                                      </li>
                                      <?php
                                         }?>
                                   </ul>
                                </div>
                             </div>
                          </div>
                          <!-- end property overview-->
                          <!-- rating and preview -->
                          <div class="col-3 rating-col">
                             <div class="ratingcol-inner">
                                <div class="preview-box">
                                   <div class="preview-img">
                                      <img src="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $row["image_file"]; ?>" class="img-fluid preview-img-thumb">
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
                                   <div class="customer-rating text-center">
                                      <h4>Customer-rating</h4>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <!-- end rating and preview -->
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
               <!-- end property row -->    

               
               <?php
                  if($_REQUEST["building"]!="")
                  {
                      $cond=" AND pd.building='" .$_REQUEST["building"]. "'";
                  }
                  if($_REQUEST["level"]!="")
                  {
                      $cond.=" AND pd.level='" .$_REQUEST["level"]. "'";
                  }
                  if($_REQUEST["aspect"]!="")
                  {
                      $cond.=" AND pd.aspect='" .$_REQUEST["aspect"]. "'";
                  }
                  if($_REQUEST["floor_type"]!="")
                  {
                      $cond.=" AND pd.floor_type='" .$_REQUEST["floor_type"]. "'";
                  }
                  if($_REQUEST["no_of_bedrooms"]!="")
                  {
                      $cond.=" AND pd.no_of_bedrooms='" .$_REQUEST["no_of_bedrooms"]. "'";
                  }
                  if($_REQUEST["no_of_bathroom"]!="")
                  {
                      $cond.=" AND pd.no_of_bathroom='" .$_REQUEST["no_of_bathroom"]. "'";
                  }
                  if($_REQUEST["rateFrom"]!="")
                  {
                      $cond.=" AND pd.rate >='" .$_REQUEST["rateFrom"]. "'";
                  }
                  if($_REQUEST["rateTo"]!="")
                  {
                      $cond.=" AND pd.rate <='" .$_REQUEST["rateTo"]. "'";
                  }
                  ?>
               <!-- start row -->   
               <div class="row">
                    <div class="col-12 col-lg-12">
                      <!-- filter accordion -->
                      <div id="accordion" class="pricelist-accordion accordion mt-30">
                         <div class="card">
                            <div class="card-header collapsed" data-toggle="collapse" href="#FilterTab">
                               <a class="card-title"> Pricelist </a>
                            </div>
                            <div id="FilterTab" class="card-body collapse <?php if($cond!=""){?> show<?php }?>" data-parent="#accordion">
                               <div class="row">
                                  <div class="col-lg-4 vcol-md-6 col-sm-12 col-12">
                                     <div class="form-group">
                                        <label>Building</label> 
                                        <select name='building' class="form-control">
                                           <option value="" >Select</option>
                                           <?php
                                              \Property\PropertyClass::Init();
                                              $rows = \Property\PropertyClass::building($project_id);
                                              $i = 1;
                                              foreach ($rows as $row) 
                                              {?>
                                           <option value="<?php echo $row["building"];?>" <?php if($_REQUEST["building"]== $row["building"]){?> selected<?php }?>><?php echo $row["building"];?></option>
                                           <?php
                                              }?>
                                        </select>
                                     </div>
                                  </div>
                                  <div class="col-lg-4 vcol-md-6 col-sm-12 col-12">
                                     <div class="form-group">
                                        <label>Level</label> 
                                        <select name='level' class="form-control">
                                           <option value="" >Select</option>
                                           <?php
                                              \Property\PropertyClass::Init();
                                              $rows = \Property\PropertyClass::level($project_id);
                                              $i = 1;
                                              foreach ($rows as $row) 
                                              {?>
                                           <option value="<?php echo $row["level"];?>" <?php if($_REQUEST["level"]== $row["level"]){?> selected<?php }?> ><?php echo $row["level"];?></option>
                                           <?php
                                              }?>
                                        </select>
                                     </div>
                                  </div>
                                  <div class="col-lg-4 vcol-md-6 col-sm-12 col-12">
                                     <div class="form-group">
                                        <label>Aspect</label>
                                        <select name='aspect' class="form-control">
                                           <option value="" >Select</option>
                                           <?php
                                              \Property\PropertyClass::Init();
                                              $rows = \Property\PropertyClass::aspect($project_id);
                                              $i = 1;
                                              foreach ($rows as $row) 
                                              {?>
                                           <option value="<?php echo $row["aspect"];?>" <?php if($_REQUEST["aspect"]== $row["aspect"]){?> selected<?php }?>><?php echo $row["aspect"];?></option>
                                           <?php
                                              }?>
                                        </select>
                                     </div>
                                  </div>
                                  <div class="col-lg-4 vcol-md-6 col-sm-12 col-12">
                                     <div class="form-group">
                                        <label>Type</label>
                                        <select name='floor_type' class="form-control">
                                           <option value="" >Select</option>
                                           <?php
                                              \Property\PropertyClass::Init();
                                              $rows = \Property\PropertyClass::floor_type($project_id);
                                              $i = 1;
                                              foreach ($rows as $row) 
                                              {?>
                                           <option value="<?php echo $row["floor_type"];?>" <?php if($_REQUEST["floor_type"]== $row["floor_type"]){?> selected<?php }?>><?php echo $row["floor_type"];?></option>
                                           <?php
                                              }?>
                                        </select>
                                     </div>
                                  </div>
                                  <div class="col-lg-4 vcol-md-6 col-sm-12 col-12">
                                     <div class="form-group">
                                        <label>Bedroom</label>
                                        <select name='no_of_bedrooms' class="form-control">
                                           <option value="" >Select</option>
                                           <?php
                                              \Property\PropertyClass::Init();
                                              $rows = \Property\PropertyClass::no_of_bedrooms($project_id);
                                              $i = 1;
                                              foreach ($rows as $row) 
                                              {?>
                                           <option value="<?php echo $row["no_of_bedrooms"];?>" <?php if($_REQUEST["no_of_bedrooms"]== $row["no_of_bedrooms"]){?> selected<?php }?> ><?php echo $row["no_of_bedrooms"];?></option>
                                           <?php
                                              }?>
                                        </select>
                                     </div>
                                  </div>
                                  <div class="col-lg-4 vcol-md-6 col-sm-12 col-12">
                                     <div class="form-group">
                                        <label>Bath room</label>
                                        <select name='no_of_bathroom' class="form-control">
                                           <option value="" >Select</option>
                                           <?php
                                              echo $_REQUEST["no_of_bathroom"];
                                              echo $row["no_of_bathroom"];
                                                \Property\PropertyClass::Init();
                                                $rows = \Property\PropertyClass::no_of_bathroom($project_id);
                                                $i = 1;
                                                foreach ($rows as $row) 
                                                {?>
                                           <option value="<?php echo $row["no_of_bathroom"];?>" <?php if($_REQUEST["no_of_bathroom"]== $row["no_of_bathroom"]){?> selected<?php }?> ><?php echo $row["no_of_bathroom"];?></option>
                                           <?php
                                              }?>
                                        </select>
                                     </div>
                                  </div>
                                  <div class="col-lg-4 vcol-md-6 col-sm-12 col-12">
                                     <div class="form-group">
                                        <label>Price From</label>
                                        <!--<select name='rate' class="form-control">
                                           <option value="" Selected>Select</option>
                                           <?php
                                              //\Property\PropertyClass::Init();
                                              //$rows = \Property\PropertyClass::rate($project_id);
                                              //$i = 1;
                                              //foreach ($rows as $row) 
                                              //{?>
                                                 <option value="<?php //echo $row["rate"];?>" <?php //if($_REQUEST["rate"]== $row["rate"]){?> selected<?php// }?> ><?php //echo $row["rate"];?></option>
                                             <?php
                                              //}?>
                                           </select>-->
                                        <input type="number" class="form-control" name="rateFrom" id="rateFrom" value="<?php echo $_REQUEST["rateFrom"];?>">
                                     </div>
                                  </div>
                                  <div class="col-lg-4 vcol-md-6 col-sm-12 col-12">
                                     <div class="form-group">
                                        <label>Price To</label>
                                        <input type="number" class="form-control" name="rateTo" id="rateTo" value="<?php echo $_REQUEST["rateTo"];?>">
                                     </div>
                                  </div>
                                  <div class="col-lg-4 vcol-md-6 col-sm-12 col-12" align=center>
                                     <div class="form-group">
                                        <label>&nbsp;</label>
                                        <input type="submit" class="btn btn-primary btn-block addnewBtn" id="Search" value="Search">
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                      <!-- end filter accordion --> 
                    </div>
                    <!-- end col-->
                </div><!-- end row -->
                <!-- start row -->
                <div class="row">    
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title">
                             <h4>LIST OF PROPERTY</h4>
                             <input type=hidden name='ProjectId' value='<?php echo $project_id; ?>'>
                          </div>
                          <div class="table table-responsive">
                               <?php include"PropertyTbl.php"; ?>
                            </div>
                         </div>
                      </div>
                    </div>
                </div>
               <!-- end row -->
                    
      <?php 
         $i++;
         } ?>
      <input type=hidden name='formcount' value='<?php echo $i-1;?>'/>
   </form>
    <!-- form -->
<?php include"footer.php"; ?>

<script>
   function AddToMyFolderFn(filename){
       url = "http://duvalknowledge.com/dpo/Masters/AddToMyFolder.html?filename=" + filename;
       
    $.colorbox({iframe:true, href:url, innerWidth:700, innerHeight:300 });
    //, onClosed:function(){window.location.reload();}
   }
</script>
<script type="text/javascript" src="<?php echo SITE_BASE_URL; ?>assets/plugins/progressbar/progressbar.js"></script>
<!--progress bar script-->
<script type="text/javascript">
   window.onload = function onLoad() {
   var semicircle = new ProgressBar.SemiCircle('#progress1', {
       color: '#DEA46C',
       duration: 3000,
       strokeWidth: 5,
       trailColor: '#2b2d49',
       trailWidth: 0.8,
       easing: 'easeInOut',
       svgStyle: null,
     text: {
       value: '',
       alignToBottom: false
     },
     from: {color: '#ffedcd'},
     to: {color: '#DEA46C'},
     // Set default step function for all animate calls
     step: (state, bar) => {
       bar.path.setAttribute('stroke', state.color);
       var value = Math.round(bar.value() * 100);
       if (value===0) {
         bar.setText(0);
       } else {
         bar.setText(value);
       }
       bar.text.style.color = '#000';
       bar.text.style.fontSize = '18px';
       bar.text.style.fontWeight = '600';
       bar.text.style.fontFamily = '"Oswald", sans-serif';
       bar.text.style.top = '10px';
     }
   });
   semicircle.animate('<?php echo $soldCount;?>'/'<?php echo $totalCount;?>');
   
   
   var semicircle = new ProgressBar.SemiCircle('#progress2', {
       color: '#DEA46C',
       duration: 3000,
       strokeWidth: 5,
       trailColor: '#2b2d49',
       trailWidth: 0.8,
       easing: 'easeInOut',
       svgStyle: null,
     text: {
       value: '',
       alignToBottom: false
     },
     from: {color: '#ffedcd'},
     to: {color: '#DEA46C'},
     // Set default step function for all animate calls
     step: (state, bar) => {
       bar.path.setAttribute('stroke', state.color);
       var value = Math.round(bar.value() * 100);
       if (value===0) {
         bar.setText(0);
       } else {
         bar.setText(value);
       }
       bar.text.style.color = '#000';
       bar.text.style.fontSize = '18px';
       bar.text.style.fontWeight = '600';
       bar.text.style.fontFamily = '"Oswald", sans-serif';
       bar.text.style.top = '10px';
     }
   });
   semicircle.animate(0/'<?php echo $totalCount;?>');
   
   var semicircle = new ProgressBar.SemiCircle('#progress3', {
       color: '#DEA46C',
       duration: 3000,
       strokeWidth: 5,
       trailColor: '#2b2d49',
       trailWidth: 0.8,
       easing: 'easeInOut',
       svgStyle: null,
     text: {
       value: '',
       alignToBottom: false
     },
     from: {color: '#ffedcd'},
     to: {color: '#DEA46C'},
     // Set default step function for all animate calls
     step: (state, bar) => {
       bar.path.setAttribute('stroke', state.color);
       var value = Math.round(bar.value() * 100);
       if (value===0) {
         bar.setText(0);
       } else {
         bar.setText(value);
       }
       bar.text.style.color = '#000';
       bar.text.style.fontSize = '18px';
       bar.text.style.fontWeight = '600';
       bar.text.style.fontFamily = '"Oswald", sans-serif';
       bar.text.style.top = '10px';
     }
   });
   semicircle.animate('<?php echo $reservedCount;?>'/'<?php echo $totalCount;?>');
   
   var semicircle = new ProgressBar.SemiCircle('#progress4', {
       color: '#DEA46C',
       duration: 3000,
       strokeWidth: 5,
       trailColor: '#2b2d49',
       trailWidth: 0.8,
       easing: 'easeInOut',
       svgStyle: null,
     text: {
       value: '',
       alignToBottom: false
     },
     from: {color: '#ffedcd'},
     to: {color: '#DEA46C'},
     // Set default step function for all animate calls
     step: (state, bar) => {
       bar.path.setAttribute('stroke', state.color);
       var value = Math.round(bar.value() * 100);
       if (value===0) {
         bar.setText(0);
       } else {
         bar.setText(value);
       }
       bar.text.style.color = '#000';
       bar.text.style.fontSize = '18px';
       bar.text.style.fontWeight = '600';
       bar.text.style.fontFamily = '"Oswald", sans-serif';
       bar.text.style.top = '10px';
     }
   });
   semicircle.animate('<?php echo $totalCount-($reservedCount);?>'/'<?php echo $totalCount;?>');
   };
</script>