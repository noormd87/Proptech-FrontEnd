<?php include "header.php"; 
   $user_id            = \settings\session\sessionClass::GetSessionDisplayName();
   
   $buttonaction    = isset($_REQUEST["buttonaction"]) ? $_REQUEST["buttonaction"] : "";    
   
   if ( $buttonaction == "edit"){
    $url = SITE_BASE_URL ."Masters/ProjectMaster.html?d=".time()."&buttonaction=edit";
   }else{
    $url = SITE_BASE_URL ."Masters/ProjectMaster.html?d=" .time();
   }
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <base href="<?php echo SITE_BASE_URL;?>">
      <meta charset="utf-8" />
      <link rel="icon" type="image/png" href="images/favicon.png">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
      <title>
         DU VAL PRIVATE OFFICE
      </title>
      <style>
         input.textbox {
         /*text-transform: uppercase;*/
         }
      </style>
      <!--     Fonts and icons     -->
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
   </head>
   <body>
      <?php
         $LocationId     = \Property\PropertyClass::$LocationId;
         
            $Suburb         = \Property\PropertyClass::$Suburb;
         
                                
         
         if ($buttonaction =="edit")
         
         {
         
             $ProjectId=$_REQUEST["id"];
         
             $rows = \Masters\MastersClass::GetPorjectDatas($ProjectId);
         
            foreach ($rows as $row) 
         
            {
         
                
         
                $ProjectId      = $row["PROJECT_ID"];
         
                $ProjectName    = $row["PROJECT_NAME"];
         
                $Description    = $row["PROJECT_DESCRIPTION"];
                
                $KeyFeatures    = $row["key_features"];
                
                $AoutProperty   = $row["about_project"];
                
                $ShortDescription= $row["short_description"];
                
                $NoOfProperty= $row["no_of_property"];
         
                $CountryStateId= $row["country_state_code"];
         
                $Country        = $row["COUNTRY"];
         
                $imageFile      = $row["image_file"];
         
                $imageFile1     = $row["image_file1"];
         
                $imageFile2     = $row["image_file2"];
         
                $imageFile3     = $row["image_file3"];
         
                $Suburb         = $row["subrub"];
         
                $LocationId     = $row["location_id"];
         
                $currency       = $row["currency"];
         
                $CompletionDate = $row["completion_date"];
         
                $ExpiryDate     = $row["expiry_date"];
         
                $StartDate      = $row["effective_date"];
                
                $myportfoliocountry      = $Country;
         
            }
         
         }
         
         else
         
         {
         
             $ProjectName   = $_REQUEST["ProjectName"];
         
            $Description    = $_REQUEST["Description"];
         
            $Country        = $_REQUEST["CountryId"];
         
            $imageFile      = $_REQUEST["imageFile"];
         
            $Suburb         = $_REQUEST["Suburb"];
         
            $LocationId     = $_REQUEST["LocationId"];
         
            $currency       = $_REQUEST["currency"];
            
            $myportfoliocountry       = $_REQUEST["myportfoliocountry"];
         
         }
         
         
         if($myportfoliocountry=="" || $myportfoliocountry==null)
         {
             $myportfoliocountry='NZ';
         }
         ?>
      <!-- Login Form action="<?php echo SITE_BASE_URL;?>Masters/Projectsave.html" -->
      <form method="post" name='form1' action="<?php echo $url ;?>" enctype="multipart/form-data">
        <div class="card">
         <div class="card-body">
            <div class="card-title">
                <h4>PROJECT MASTER</h4>  
                <input type=hidden name='ProjectId' value='<?php echo $ProjectId; ?>'>
            </div>
            <div class="row">
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                     <label>Project Name</label>
                     <input type="text" class="form-control textbox mandate" name="ProjectName" Maxlength=200 value="<?php echo $ProjectName; ?>">
                  </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                     <label>Description</label>
                     <textarea class="form-control textbox mandate" name="Description" rows="1"><?php echo $Description;?></textarea>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                     <label>Key Features</label>
                     <textarea rows=5 class="form-control textbox mandate" name="KeyFeatures" rows="1"><?php echo $KeyFeatures;?></textarea>
                     <script>
                            CKEDITOR.replace( 'KeyFeatures' );
                    </script>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                     <label>About Property</label>
                     <textarea rows=5 class="form-control textbox mandate" name="AoutProperty" rows="1"><?php echo $AoutProperty;?></textarea>
                     <script>
                            CKEDITOR.replace( 'AoutProperty' );
                    </script>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                     <label>Country</label>
                     <select name="CountryId" id="CountryId" required="" aria-required="true" class="form-control mandate" onClick="javaScript:AddState();">
                        <option value="">Select</option>
                        <?php
                           $Projectrows = \Masters\MastersClass::GetCountriesDatas();
                           
                           foreach ($Projectrows as $Projectrow) 
                           
                           {
                           
                               $CountryId=$Projectrow["country_code"];
                           
                               $CountryName=$Projectrow["country_name"];
                           
                           ?>
                        <option value="<?php echo $CountryId;?>" <?php if($CountryId==$Country){?>SELECTED
                           <?php }?> >
                           <?php echo $CountryName;?>
                        </option>
                        <?php
                           }
                           
                           ?>
                     </select>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                     <label>Currency</label>
                     <select name="currency" id="currency" required="" aria-required="true" class="form-control mandate">
                        <option value="">Select</option>
                        <option value="NZD" <?php if($currency=='NZD'){?>SELECTED <?php }?>>NZD</option>
                        <option value="AUD" <?php if($currency=='AUD'){?>SELECTED <?php }?>>AUD</option>
                        <option value="MYR" <?php if($currency=='MYR'){?>SELECTED <?php }?>>MYR</option>
                        <option value="SGD" <?php if($currency=='SGD'){?>SELECTED <?php }?>>SGD</option>
                        <option value="GBP" <?php if($currency=='GBP'){?>SELECTED <?php }?>>GBP</option>
                        <option value="USD" <?php if($currency=='USD'){?>SELECTED <?php }?>>USD</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-3 col-md-2 col-sm-12 col-12">
                  <div class="form-group">
                     <label>Image 1</label>
                     <div class="table row">
                        <?php echo \Property\PropertyClass::GetUploadedFiles('','NN'); ?><br>
                        <input type="hid den" class="form-control mandate" name="imageFile" id="imageFile" value='<?php echo $imageFile; ?>' readonly style="background-color:white;border: transparent;">
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-2 col-sm-12 col-12">
                  <div class="form-group">
                     <label>Image 2</label>
                     <div class="table row">
                        <?php echo \Property\PropertyClass::GetUploadedFiles('1','NN'); ?><br>
                        <input type="hid den" class="form-control" name="imageFile1" id="imageFile1" value='<?php echo $imageFile1; ?>' readonly style="background-color:white;border: transparent;">
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-2 col-sm-12 col-12">
                  <div class="form-group">
                     <label>Image 3</label>
                     <div class="table row">
                        <?php echo \Property\PropertyClass::GetUploadedFiles('2','NN'); ?><br>
                        <input type="hid den" class="form-control" name="imageFile2" id="imageFile2" value='<?php echo $imageFile2; ?>' readonly style="background-color:white;border: transparent;">
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-2 col-sm-12 col-12">
                  <div class="form-group">
                     <label>Image 4</label>
                     <div class="table row">
                        <?php echo \Property\PropertyClass::GetUploadedFiles('3','NN'); ?><br>
                        <input type="hid den" class="form-control" name="imageFile3" id="imageFile3" value='<?php echo $imageFile3; ?>' readonly style="background-color:white;border: transparent;">
                     </div>
                  </div>
               </div>
               
               <div class="col-lg-6 col-md-2 col-sm-12 col-12">
                  <div class="form-group">
                     <label>Suburb</label>
                     <input class="form-control" type="text" name="Suburb" id="Suburb" placeholder="Suburb" value="<?php echo $Suburb;?>"/>
                     <input class="form-control" type="hidden" name="LocationId" id="LocationId" placeholder="LocationId" value="<?php echo $LocationId;?>">
                     <input class="form-control" type="hidden" name="myportfoliocountry" id="myportfoliocountry"  value="<?php echo $myportfoliocountry;?>" >
                  </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                     <label>Country state</label>
                     <span id='states'>
                     <select name="CountryStateId" id="CountryStateId"  class="form-control">
                        <option value="">Select</option>
                        <?php
                           $ContryStaterows = \Masters\MastersClass::GetCountriesStateDatas($Country);
                           
                           foreach ($ContryStaterows as $ContryStaterow) 
                           
                           {
                           
                               $CountrystateCode=$ContryStaterow["country_state_code"];
                           
                               $Countrystate=$ContryStaterow["country_state"];
                           
                           ?>
                        <option value="<?php echo $CountrystateCode;?>" <?php if($CountryStateId==$CountrystateCode){?>SELECTED
                           <?php }?> >
                           <?php echo $Countrystate;?>
                        </option>
                        <?php
                           }
                           
                           ?>
                     </select>
                     </span>
                  </div>
               </div>
               <?php if ( !isset($_POST["submit"]) && $buttonaction !="edit" && $buttonaction !="delete" ) { ?>
               <div class="col-lg-6 col-sm-12 col-12">
                  <div class="form-group">
                     <label>Property CSV Upload</label>
                     
                        <div class="input-group">
                            <div class="fileinput fileinput-new m-0" data-provides="fileinput">
                                <span class="btn btn-primary btn-file"><span class="fileinput-new">CHOOSE FILE</span>
                                <span class="fileinput-exists">Change</span><input type="file" name="file" id="file" size="150"></span>
                                <span class="fileinput-filename"></span>
                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                             </div>
                             <div class="input-group-append">
                                <button type="submit" class="btn btn-info btn_add" name="submit" value="submit">Upload</button>
                             </div>
                        </div>
                         
                        <!-- <div class="fileinput fileinput-new" data-provides="fileinput">
                           <span class="btn btn-primary btn-file  col-md-4"><input type="file" name="file" id="file" size="150"></span>
                           <span class="fileinput-filename"></span>
                           <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                           <button type="submit" class="btn btn-info btn_add col-md-2" name="submit" value="submit">Upload</button>
                        </div> -->
                     <a class="mt-2" href="<?php echo SITE_BASE_URL;?>PropertyTemplete.csv">UPLOAD TEMPLETE</a>   
                     
                     
                  </div>
               </div>
               <?php
                  } ?>
               <div class="col-lg-6 col-md-2 col-sm-12 col-12">
                  <!-- <div class="form-group">
                     <label>Completion Date</label>
                     <input type="text" name="CompletionDate" id="CompletionDate" rel="CompletionDate" class="form-control date_picker  mandate" value="<?php echo $CompletionDate;?>" />
                  </div> -->

                  <div class="form-group">
                        <label>Completion Date</label>
                        <div class="input-group">
                            <input type="text" name="CompletionDate" id="CompletionDate" rel="CompletionDate" class="form-control date_picker" value="<?php echo $CompletionDate; ?>">
                            <span class="input-group-append">
                                <span class="input-group-text">
                                    <i class="icon-calender"></i>
                                </span>
                            </span>
                        </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-2 col-sm-12 col-12">
                  <!-- <div class="form-group">
                     <label><b>Start Date</b></label>
                     <input type="text" name="StartDate" id="StartDate" rel="StartDate" class="date_picker  mandate" value="<?php echo $StartDate;?>" />
                  </div> -->
                  <div class="form-group">
                        <label>Start Date</label>
                        <div class="input-group">
                            <input type="text" name="StartDate" id="StartDate" rel="StartDate" class="date_picker  form-control" value="<?php echo $StartDate; ?>">
                            <span class="input-group-append">
                                <span class="input-group-text">
                                    <i class="icon-calender"></i>
                                </span>
                            </span>
                        </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-2 col-sm-12 col-12">
                  <!-- <div class="form-group">
                     <label>Expiry Date</label>
                     <input type="text" name="ExpiryDate" id="ExpiryDate" rel="ExpiryDate" class="date_picker  mandate" value="<?php echo $ExpiryDate;?>" />
                  </div> -->
                  <div class="form-group">
                        <label>Expiry Date</label>
                        <div class="input-group">
                            <input type="text" name="ExpiryDate" id="ExpiryDate" rel="ExpiryDate" class="date_picker form-control mandate" value="<?php echo $ExpiryDate;?>">
                            <span class="input-group-append">
                                <span class="input-group-text">
                                    <i class="icon-calender"></i>
                                </span>
                            </span>
                        </div>
                  </div>  
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                     <label>No Of Property Limit<br>For discount</label>
                     <input type="number" name="NoOfProperty" id="NoOfProperty" rel="NoOfProperty" class="form-control mandate" value="<?php echo $NoOfProperty;?>">
                  </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                     <label>Short Description</label>
                     <textarea rows=5 class="form-control textbox mandate" name="ShortDescription" rows="1"><?php echo $ShortDescription;?></textarea>
                     <script>
                            CKEDITOR.replace( 'ShortDescription' );
                    </script>
                  </div>
               </div>
               <!-- ==========================================================================Upload=================================================================== -->
               <?php
                  if( isset($_POST["submit"]) || $_REQUEST["buttonaction"]=="edit")
                  
                  { ?>
               <div class="card mb-0">
                  <div id="collapsePricelistTable" class="card-body">
                     <div class="">
                        <div class="table-responsive">
                           <table class="table table-hover table-striped">
                              <thead class="">
                                 <tr>
                                    <td colspan=1>
                                       <button class="btn btn-success" onClick="javaScript:AddRowPROPERTY('PROPERTY');return false;">
                                       Add
                                       </button>
                                    </td>
                                    <td colspan=15> </td>
                                 </tr>
                                 <tr>
                                    <th>S.NO</th>
                                    <th>BUILDING</th>
                                    <th>APARTMENT NO</th>
                                    <th>UNIT NO</th>
                                    <th>BLOCK</th>
                                    <th>LEVEL</th>
                                    <th>ASPECT</th>
                                    <th>FLOOR TYPE</th>
                                    <th>LAND AREA</th>
                                    <th>APPROX<br>PATIO<br>BALCONY</th>
                                    <th>UNIT</th>
                                    <th>NO OF BED<br>ROOMS</th>
                                    <th>NO OF BATH<br>ROOM</th>
                                    <th>NO OF PARKING<br>SPACE</th>
                                    <th>ACTUAL PRICE</th>
                                    <th>START PRICE</th>
                                    <th>DPO NEGOTIATED<br>DEAL PRICE</th>
                                    <th>WEEKLY<br>RENT</th>
                                    <th>ESTIMATED COUNCI<br>TAX P.A.</th>
                                    <th>ESTIMATED SERVICE<br>CHARGE P.A.</th>
                                    <th>ESTIMATED GROUND<br>RENT P.A.</th>
                                    <th>RESERVATION FEE</th>
                                    <th>EXCHANGE DEPOSIT(%)</th>
                                    <th>STAGE PAYMENT 1</th>
                                    <th>TIMING 1</th>
                                    <th>STAGE PAYMENT 2</th>
                                    <th>TIMING 2</th>
                                    <?php if($_REQUEST["buttonaction"]=="edit"){?>
                                    <th>RESERVED BY</th>
                                    <th>CANCEL <br>RESERVATION</th>
                                    <?php }?>
                                 </tr>
                              </thead>
                              <tbody id="PROPERTYBody">
                                 <?php
                                    if( $_FILES["file"]["name"]=="" || $_FILES["file"]["name"]==null)
                                    
                                    {
                                    
                                        
                                    
                                        $_FILES["file"]["name"]="Property.csv";
                                    
                                        $_FILES["file"]["tmp_name"]="Property.csv";
                                    
                                    }
                                    
                                    if ($_FILES["file"]["name"] && $_REQUEST["buttonaction"]!="edit") 
                                    
                                    {
                                    
                                        $filename=explode(".",$_FILES["file"]["name"]);
                                    
                                        if ($filename[1]=="csv")
                                    
                                        {
                                    
                                            $handle=fopen($_FILES["file"]["tmp_name"],"r");
                                    
                                            $RowNum=0;
                                    
                                            while($data = fgetcsv($handle))
                                    
                                              {
                                    
                                                if ($RowNum == 0)
                                    
                                                {
                                    
                                                
                                    
                                                }
                                    
                                                else
                                    
                                                {
                                    
                                                $building           = $data[0];
                                    
                                                $ApartmentNo        = $data[1];
                                    
                                                $UnitNo             = $data[2];
                                    
                                                $Block              = $data[3];
                                    
                                                $level              = $data[4];
                                    
                                                $aspect             = $data[5];
                                    
                                                $FloorType          = $data[6];
                                    
                                                $LandArea           = $data[7];
                                    
                                                $ApproxPatioBalcony = $data[8];
                                    
                                                $Unit               = $data[9];
                                    
                                                $NoOfBedrooms       = $data[10];
                                    
                                                $NoOfBathroom       = $data[11];
                                    
                                                $NoOfParkingspace   = $data[12];
                                    
                                                $Rate               = $data[13];
                                    
                                                $StartRate          = $data[14];
                                    
                                                $DpoRate            = $data[15];
                                    
                                                $WeeklyRent         = $data[16];
                                    
                                                $EstCounciTax       = $data[17];
                                    
                                    $EstServiceCharge   = $data[18];
                                    
                                    $EstGroundRent      = $data[19];
                                    
                                    $ReservationFee     = $data[20];
                                    
                                    $ExchangeDepositPer = $data[21];
                                    
                                    $StagePayment1      = $data[22];
                                    
                                    $timing1            = $data[23];
                                    
                                    $StagePayment2      = $data[24];
                                    
                                    $timing2            = $data[25];
                                    
                                            ?>
                                 <tr id="PROPERTYRow<?php echo $RowNum; ?>">
                                    <td>
                                       <?php echo $RowNum; ?>
                                       <input class="form-control" type="checkbox" style="top: .5rem;width: 1.0rem;height: 1.0rem;" name="Delval<?php echo $RowNum; ?>" id="Delval<?php echo $RowNum; ?>" value="Y" checked>
                                       <input class="form-control" class='tablebg2' type="hidden" name="Seq<?php echo $RowNum; ?>" id="Seq<?php echo $RowNum; ?>" value="<?php echo $RowNum; ?>" style="border:no ne;" size='2' readonly />
                                       <input class="form-control"  type="hidden" name="ProjectId<?php echo $RowNum; ?>" id="ProjectId<?php echo $RowNum; ?>"  value="<?php echo $ProjectId;?>" size="3" maxlength="4" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="building<?php echo $RowNum; ?>" id="building<?php echo $RowNum; ?>"  value="<?php echo $building; ?>" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="ApartmentNo<?php echo $RowNum; ?>" id="ApartmentNo<?php echo $RowNum; ?>"  value="<?php echo $ApartmentNo; ?>" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="UnitNo<?php echo $RowNum; ?>" id="UnitNo<?php echo $RowNum; ?>"  value="<?php echo $UnitNo; ?>" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="Block<?php echo $RowNum; ?>" id="Block<?php echo $RowNum; ?>"  value="<?php echo $Block; ?>" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="level<?php echo $RowNum; ?>" id="level<?php echo $RowNum; ?>"  value="<?php echo $level; ?>" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <textarea class="form-control mandate" name="aspect<?php echo $RowNum; ?>" id="aspect<?php echo $RowNum; ?>" rows="2" cols="10" autocomplete='off'><?php echo $aspect; ?></textarea>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="FloorType<?php echo $RowNum; ?>" id="FloorType<?php echo $RowNum; ?>"  value="<?php echo $FloorType; ?>" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="LandArea<?php echo $RowNum; ?>" id="LandArea<?php echo $RowNum; ?>"  value="<?php echo $LandArea; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="ApproxPatioBalcony<?php echo $RowNum; ?>" id="ApproxPatioBalcony<?php echo $RowNum; ?>"  value="<?php echo $ApproxPatioBalcony; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <select class="form-control mandate"  name="Unit<?php echo $RowNum; ?>" id="Unit<?php echo $RowNum; ?>" >
                                          <option value='m' <?php if($Unit=='m' || $Unit==null|| $Unit==""){?>Selected<?php }?>>m2</option>
                                          <option value='ft' <?php if($Unit=='ft'){?>Selected<?php }?> >ft2</option>
                                       </select>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="NoOfBedrooms<?php echo $RowNum; ?>" id="NoOfBedrooms<?php echo $RowNum; ?>"  value="<?php echo $NoOfBedrooms; ?>" size="3" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="NoOfBathroom<?php echo $RowNum; ?>" id="NoOfBathroom<?php echo $RowNum; ?>"  value="<?php echo $NoOfBathroom; ?>" size="3" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="NoOfParkingspace<?php echo $RowNum; ?>" id="NoOfParkingspace<?php echo $RowNum; ?>"  value="<?php echo $NoOfParkingspace; ?>" size="3" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="Rate<?php echo $RowNum; ?>" id="Rate<?php echo $RowNum; ?>"  value="<?php echo $Rate; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="StartRate<?php echo $RowNum; ?>" id="StartRate<?php echo $RowNum; ?>"  value="<?php echo $StartRate; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="DpoRate<?php echo $RowNum; ?>" id="DpoRate<?php echo $RowNum; ?>"  value="<?php echo $DpoRate; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="WeeklyRent<?php echo $RowNum; ?>" id="WeeklyRent<?php echo $RowNum; ?>"  value="<?php echo $WeeklyRent; ?>" size="6" maxlength="6" autocomplete='off'>
                                       <input class="form-control" type="hidden" id="PropertyDtlStatus<?php echo $RowNum;?>" name="PropertyDtlStatus<?php echo $RowNum;?>" size='2'  value=""   />
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="EstCounciTaxs<?php echo $RowNum; ?>" id="EstCounciTaxs<?php echo $RowNum; ?>"  value="<?php echo $EstCounciTax; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="EstServiceCharge<?php echo $RowNum; ?>" id="EstServiceCharge<?php echo $RowNum; ?>"  value="<?php echo $EstServiceCharge; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="EstGroundRent<?php echo $RowNum; ?>" id="EstGroundRent<?php echo $RowNum; ?>"  value="<?php echo $EstGroundRent; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="ReservationFee<?php echo $RowNum; ?>" id="ReservationFee<?php echo $RowNum; ?>"  value="<?php echo $ReservationFee; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="ExchangeDepositPer<?php echo $RowNum; ?>" id="ExchangeDepositPer<?php echo $RowNum; ?>"  value="<?php echo $ExchangeDepositPer; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="StagePayment1<?php echo $RowNum; ?>" id="StagePayment1<?php echo $RowNum; ?>"  value="<?php echo $StagePayment1; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="timing1<?php echo $RowNum; ?>" id="timing1<?php echo $RowNum; ?>"  value="<?php echo $timing1; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="StagePayment2<?php echo $RowNum; ?>" id="StagePayment2<?php echo $RowNum; ?>"  value="<?php echo $StagePayment2; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="timing2<?php echo $RowNum; ?>" id="timing2<?php echo $RowNum; ?>"  value="<?php echo $timing2; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                 </tr>
                                 <?php
                                    }
                                    
                                    $RowNum=$RowNum+1;
                                    
                                    }
                                    
                                    }
                                    
                                    
                                    
                                    
                                    
                                    }
                                    
                                    elseif($_REQUEST["buttonaction"]=="edit")
                                    
                                    {
                                    
                                     $RowNum = 1;
                                    
                                    $propertyid     = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
                                    
                                    $conds=" AND pj.project_id='".$ProjectId."' ";
                                    
                                    $rows = \Property\PropertyClass::GetPropertiesDatas('','',$conds);
                                    
                                    $i = 1;
                                    
                                    foreach ($rows as $row) 
                                    
                                    {
                                    
                                    $propertyid         = $row["property_id"];
                                    
                                    $building           = $row["building"];
                                    
                                    $ApartmentNo        = $row["apartment_no"];
                                    
                                    $UnitNo             = $row["unit_no"];
                                    
                                    $level              = $row["level"];
                                    
                                    $aspect             = $row["aspect"];
                                    
                                    $FloorType          = $row["floor_type"];
                                    
                                    $LandArea           = $row["land_area"];
                                    
                                    $ApproxPatioBalcony = $row["approx_patio_balcony"];
                                    
                                    $NoOfBedrooms       = $row["no_of_bedrooms"];
                                    
                                    $NoOfBathroom       = $row["no_of_bathroom"];
                                    
                                    $NoOfParkingspace   = $row["no_of_parkingspace"];
                                    
                                    $CreatedUser        = $row["created_user"];
                                    
                                    $Rate               = $row["rate"];
                                    
                                    $StartRate          = $row["start_rate"];
                                    
                                    $DpoRate            = $row["dpo_rate"];
                                    
                                    $WeeklyRent         = $row["weekly_rent"];
                                    
                                    $ProjectId          = $row["project_id"];
                                    
                                    $projectName        = $row["project_name"];
                                    
                                    $Block              = $row["Block"];
                                    
                                    $Unit               = $row["area_unit"];
                                    
                                    $EstCounciTax       = $row["Est_Counci_Tax"];
                                    
                                    $EstServiceCharge   = $row["Est_Service_Charge"];
                                    
                                    $EstGroundRent      = $row["Est_Ground_Rent"];
                                    
                                    $ReservationFee     = $row["Reservation_Fee"];
                                    
                                    $ExchangeDepositPer = $row["Exchange_Deposit_Per"];
                                    
                                    $StagePayment1     =  $row["Stage_Payment1"];
                                    
                                    $timing1            = $row["timing1"];
                                    
                                    $StagePayment2     =  $row["Stage_Payment2"];
                                    
                                    $timing2            = $row["timing2"];
                                    
                                    ?>
                                 <tr class=tablebg2 id="PROPERTYRow<?php echo $RowNum; ?>">
                                    <td>
                                       <?php echo $RowNum; ?>
                                       <input class="form-control" type="checkbox" style="top: .5rem;width: 1.0rem;height: 1.0rem;" name="Delval<?php echo $RowNum; ?>" id="Delval<?php echo $RowNum; ?>" value="Y" checked>
                                       <input class="form-control" class='tablebg2' type="hidden" name="Seq<?php echo $RowNum; ?>" id="Seq<?php echo $RowNum; ?>" value="<?php echo $RowNum; ?>" style="border:no ne;" size='2' readonly /> 
                                       <input class="form-control mandate"  type="hidden" name="ProjectId<?php echo $RowNum; ?>" id="ProjectId<?php echo $RowNum; ?>"  value="<?php echo $ProjectId;?>" size="3" maxlength="4" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="building<?php echo $RowNum; ?>" id="building<?php echo $RowNum; ?>"  value="<?php echo $building; ?>" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="ApartmentNo<?php echo $RowNum; ?>" id="ApartmentNo<?php echo $RowNum; ?>"  value="<?php echo $ApartmentNo; ?>" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="UnitNo<?php echo $RowNum; ?>" id="UnitNo<?php echo $RowNum; ?>"  value="<?php echo $UnitNo; ?>" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="Block<?php echo $RowNum; ?>" id="Block<?php echo $RowNum; ?>"  value="<?php echo $Block; ?>" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="level<?php echo $RowNum; ?>" id="level<?php echo $RowNum; ?>"  value="<?php echo $level; ?>" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <textarea class="form-control mandate" name="aspect<?php echo $RowNum; ?>" id="aspect<?php echo $RowNum; ?>" rows="2" cols="10" autocomplete='off'><?php echo $aspect; ?></textarea>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="FloorType<?php echo $RowNum; ?>" id="FloorType<?php echo $RowNum; ?>"  value="<?php echo $FloorType; ?>" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="LandArea<?php echo $RowNum; ?>" id="LandArea<?php echo $RowNum; ?>"  value="<?php echo $LandArea; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="ApproxPatioBalcony<?php echo $RowNum; ?>" id="ApproxPatioBalcony<?php echo $RowNum; ?>"  value="<?php echo $ApproxPatioBalcony; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <select class="form-control mandate"  name="Unit<?php echo $RowNum; ?>" id="Unit<?php echo $RowNum; ?>" >
                                          <option value='m' <?php if($Unit=='m' || $Unit==null|| $Unit==""){?>Selected<?php }?>>m2</option>
                                          <option value='ft' <?php if($Unit=='ft'){?>Selected<?php }?> >ft2</option>
                                       </select>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="NoOfBedrooms<?php echo $RowNum; ?>" id="NoOfBedrooms<?php echo $RowNum; ?>"  value="<?php echo $NoOfBedrooms; ?>" size="3" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="NoOfBathroom<?php echo $RowNum; ?>" id="NoOfBathroom<?php echo $RowNum; ?>"  value="<?php echo $NoOfBathroom; ?>" size="3" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="NoOfParkingspace<?php echo $RowNum; ?>" id="NoOfParkingspace<?php echo $RowNum; ?>"  value="<?php echo $NoOfParkingspace; ?>" size="3" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="Rate<?php echo $RowNum; ?>" id="Rate<?php echo $RowNum; ?>"  value="<?php echo $Rate; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="StartRate<?php echo $RowNum; ?>" id="Rate<?php echo $RowNum; ?>"  value="<?php echo $StartRate; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="DpoRate<?php echo $RowNum; ?>" id="Rate<?php echo $RowNum; ?>"  value="<?php echo $DpoRate; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="WeeklyRent<?php echo $RowNum; ?>" id="WeeklyRent<?php echo $RowNum; ?>"  value="<?php echo $WeeklyRent; ?>" size="6" maxlength="6" autocomplete='off'>
                                       <input class="form-control" type="hidden" id="PropertyDtlStatus<?php echo $RowNum;?>" name="PropertyDtlStatus<?php echo $RowNum;?>" size='2'  value="Y"   />
                                       <input class="form-control" type="hidden" id="propertyid<?php echo $RowNum;?>" name="propertyid<?php echo $RowNum;?>" size='2'  value="<?php echo $propertyid; ?>"   />
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="EstCounciTaxs<?php echo $RowNum; ?>" id="EstCounciTaxs<?php echo $RowNum; ?>"  value="<?php echo $EstCounciTax; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="EstServiceCharge<?php echo $RowNum; ?>" id="EstServiceCharge<?php echo $RowNum; ?>"  value="<?php echo $EstServiceCharge; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="EstGroundRent<?php echo $RowNum; ?>" id="EstGroundRent<?php echo $RowNum; ?>"  value="<?php echo $EstGroundRent; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="ReservationFee<?php echo $RowNum; ?>" id="ReservationFee<?php echo $RowNum; ?>"  value="<?php echo $ReservationFee; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="ExchangeDepositPer<?php echo $RowNum; ?>" id="ExchangeDepositPer<?php echo $RowNum; ?>"  value="<?php echo $ExchangeDepositPer; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="StagePayment1<?php echo $RowNum; ?>" id="StagePayment1<?php echo $RowNum; ?>"  value="<?php echo $StagePayment1; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="timing1<?php echo $RowNum; ?>" id="timing1<?php echo $RowNum; ?>"  value="<?php echo $timing1; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="StagePayment2<?php echo $RowNum; ?>" id="StagePayment2<?php echo $RowNum; ?>"  value="<?php echo $StagePayment2; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="timing2<?php echo $RowNum; ?>" id="timing2<?php echo $RowNum; ?>"  value="<?php echo $timing2; ?>" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <?php if($_REQUEST["buttonaction"]=="edit"){?>
                                    <td><?php echo $row["reserved_by"];?></td>
                                    <td>
                                       <?php if($row["reserved_by"]!="" && $row["reserved_by"]!=null){?>
                                       <a class="btn btn-danger btn-sm" href="<?php echo SITE_BASE_URL; ?>Property/Cancel.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $row["project_id"]; ?>" nowrap>Cancel Reservation</a>
                                       <?php }?>
                                    </td>
                                    <?php }?>
                                 </tr>
                                 <?php
                                    $RowNum=$RowNum+1;
                                    
                                    
                                    
                                    }
                                    
                                                    }
                                    
                                                    ?>
                                 <input class="form-control" type="hidden" id="PROPERTYExistRowCount" name="PROPERTYExistRowCount" value='<?php echo $RowNum-1; ?>'>
                              </tbody>
                              <tfoot id="PROPERTYTemplate" style="display:none">
                                 <tr class=tablebg1 id="PROPERTYRowXXXXX">
                                    <td>
                                       XXXXX<input class="form-control" type="checkbox" style="top: .5rem;width: 1.0rem;height: 1.0rem;" name="DelvalXXXXX" id="DelvalXXXXX" value="Y" checked>
                                       <input class="form-control" class='tablebg2' type="hidden" name="SeqXXXXX" id="SeqXXXXX" value="XXXXX" style="border:no ne;" size='2' readonly />
                                       <input class="form-control"  type="hidden" name="ProjectIdXXXXX" id="ProjectIdXXXXX"  value="<?php echo $ProjectId;?>" size="3" maxlength="4" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="buildingXXXXX" id="buildingXXXXX"  value="" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="ApartmentNoXXXXX" id="ApartmentNoXXXXX"  value="" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="UnitNoXXXXX" id="UnitNoXXXXX"  value="" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="BlockXXXXX" id="BlockXXXXX"  value="" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="levelXXXXX" id="levelXXXXX"  value="" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <textarea class="form-control mandate" name="aspectXXXXX" id="aspectXXXXX" rows="2" cols="10" autocomplete='off'></textarea>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="FloorTypeXXXXX" id="FloorTypeXXXXX"  value="" size="15" maxlength="30" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="LandAreaXXXXX" id="LandAreaXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="ApproxPatioBalconyXXXXX" id="ApproxPatioBalconyXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <select class="form-control mandate"  name="UnitXXXXX" id="UnitXXXXX" >
                                          <option value='m' >m2</option>
                                          <option value='ft' >ft2</option>
                                       </select>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="NoOfBedroomsXXXXX" id="NoOfBedroomsXXXXX"  value="" size="3" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="NoOfBathroomXXXXX" id="NoOfBathroomXXXXX"  value="" size="3" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="NoOfParkingspaceXXXXX" id="NoOfParkingspaceXXXXX"  value="" size="3" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="RateXXXXX" id="RateXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="StartRateXXXXX" id="RateXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="DpoRateXXXXX" id="RateXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="WeeklyRentXXXXX" id="WeeklyRentXXXXX"  value="" size="6" maxlength="6" autocomplete='off'>
                                       <input class="form-control" type="hidden" id="PropertyDtlStatusXXXXX" name="PropertyDtlStatusXXXXX"  size='2' value=""   />
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="EstCounciTaxsXXXXX" id="EstCounciTaxsXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="EstServiceChargeXXXXX" id="EstServiceChargeXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="EstGroundRentXXXXX" id="EstGroundRentXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="ReservationFeeXXXXX" id="ReservationFeeXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="ExchangeDepositPerXXXXX" id="ExchangeDepositPerXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="StagePayment1XXXXX" id="StagePayment1XXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="timing1XXXXX" id="timing1XXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="StagePayment2XXXXX" id="StagePayment2XXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <td valign="top">
                                       <input class="form-control mandate"  type="text" name="timing2XXXXX" id="timing2XXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
                                    </td>
                                    <?php if($_REQUEST["buttonaction"]=="edit"){?>
                                    <td></td>
                                    <td></td>
                                    <?php }?>
                                 </tr>
                              </tfoot>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <?php
                  } ?>      
               <!-- ==========================================================================Upload end=============================================================== -->
               <?php
                  if ( $buttonaction =="edit")
                  
                    $NameVal = "Update";
                  
                  else
                  
                    $NameVal = "SaveProject";
                  
                  ?>
               <div class="col-lg-4 col-md-6 col-sm-12 col-12">
               </div>
               <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                  <div class="form-group">
                     <input type="button" class="btn btn-warning addnewBtn" id="<?php echo $NameVal;?>" value="<?php echo $NameVal;?>">
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-12 col-12">
               </div>
            </div>
         </div>
        </div>
         <?php 
            if ($buttonaction !="edit" && !isset($_POST["submit"]))
            
            {?>
         <div class="card">
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th>PROJECT NAME</th>
                           <th>PROJECT DESCREPTION</th>
                           <th>COUNTRY</th>
                           <th>IMAGE</th>
                           <th>EDIT</th>
                           <th>DELETE</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           \Masters\MastersClass::Init();
                           
                           $rows = \Masters\MastersClass::GetPorjectDatas('');
                           
                           $i = 1;
                           
                           foreach ($rows as $row) 
                           
                           {
                               
                               $countrycodenew = $row["COUNTRY"];
                               
                                if ($countrycodenew =="1")
                                    $countrycodenew = "NZ";
                                else if ($countrycodenew =="2")
                                    $countrycodenew = "AU";
                                else if ($countrycodenew =="3")
                                    $countrycodenew = "GB";
                           
                           ?>
                        <tr>
                           
                           <td>
                              <?php echo $row["PROJECT_NAME"];?>
                           </td>
                           <td>
                              <?php echo $row["PROJECT_DESCRIPTION"];?>
                           </td>
                           <td>
                              <?php echo $countrycodenew;?>
                           </td>
                           <td>
                              <?php echo $row["image_file"];?>
                           </td>
                           <td align="center">
                              <a class="btn btn-sm btn-success" href="javascript:void(0)" onclick="EditFn('<?php echo $row["PROJECT_ID"];?>')">
                              <i class="fa fa-edit"></i>
                              </a>
                           </td>
                           <td align="center">
                              <a class="btn btn-sm btn-warning" href="javascript:void(0)" onclick="DeleteFn('<?php echo $row["PROJECT_ID"];?>')">
                              <i class="fa fa-trash"></i>
                              </a>
                           </td>
                        </tr>
                        <?php
                           }?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <?php 
            }?>

        </form>    
   </body>
   
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.15.5/apexcharts.min.js"></script>
<script src="<?php echo SITE_BASE_URL; ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
</html>
<?php include"footer.php"; ?>
<script>
   function DeleteFn(id){
   
       if (!confirm("Sure! Are you want to Delete File?")){
   
           return false;
   
       }
   
       
   
       URL = "<?php echo SITE_BASE_URL;?>Masters/DeleteProject.html?ProjectId=" + id;
   
       window.location.href = URL;
   
   }
   
   
   
   $(document).on("click", ".addnewBtn", function(){
   
   ErrCount = 0;
   
   if(document.getElementById("LocationId").value=="")
   
   {
   
       //alert("Select Subrub from the list");
   
       //return false;
   
   }
   if(document.getElementById("CountryStateId").value=="" && document.getElementById("CountryId").value=='AU')
   
   {
   
       alert("Select Country State from the list");
   
       return false;
   
   }
   
   $(".mandate:visible").each(function(){
   
           if (this.value == ""){
   
               alert("Please select field : " + this.name);
   
               $(this).focus();
   
               ErrCount++;
   
               return false;
   
           }
   
   });
   
   
   
   if (ErrCount != 0){
   
           return false;
   
   }
   
   $(".btn_add").remove();
   
   document.getElementsByName('form1').enctype = '';
   
   document.form1.action = "<?php echo SITE_BASE_URL; ?>Masters/" + this.value + ".html";
   
   document.form1.submit();
   
   });
   
   $(function () { 
   
   $(document).on("click", ".btn_add", function(){
   
   document.getElementsByName('form1').enctype = '';
   
   document.form1.submit();
   
   });
   
   
   
   
   
   });
   
   function EditFn(id){ 
   
   window.location.href = "<?php echo SITE_BASE_URL; ?>masters/projectMaster.html?d=<?php echo time(); ?>&id=" + id +"&buttonaction=edit"; 
   
   }
   
   function AddFilesFn(id,floorId){
   
       $.colorbox({iframe:true, href:"<?php echo SITE_BASE_URL;?>Property/AddFiles.html?id=" + id + "&floor="+floorId, innerWidth:700, innerHeight:350, onClosed:function(){
       
       //window.location.reload();
       
       //================================
       URL = "<?php echo SITE_BASE_URL;?>Property/Refresh1.html";
       
       $.ajax({url: URL, success: function(result){
       
           UplStr = "<table class='table'><tbody><tr><td>"+result+"</td></tr></tbody></table>";
       
           //document.getElementById("image11").innerHTML=UplStr;
       
           document.getElementById("imageFile"+id).value=result;
       
           alert("Updated Successfully");
       
       }});
       //===============================   
       
       } 
       });
   }
   function AddState(){
       CountryId=$("#CountryId").val();
       //================================
       URL = "<?php echo SITE_BASE_URL;?>masters/CountryState.html?CountryIdS="+CountryId;
       
       $.ajax({url: URL, success: function(result){
           document.getElementById("states").innerHTML=result;
       }});
       //===============================  
       $("#myportfoliocountry").val(CountryId);
       
   }
   
   function DeleteFileFn(id,filename){
   
   if (!confirm("Sure! Are you want to Delete File?")){
   
   return false;
   
   }
   
   
   
   URL = "<?php echo SITE_BASE_URL;?>Property/DeleteFile.html?FolderId=" + id + "&filename=" + filename;
   
   console.log(URL)
   
   $.ajax({url: URL, success: function(result){
   
   //alert(result)
   
   if (result.trim() == "success"){
   
       //alert("Deleted");
   
       //window.location.reload();
   
       //================================
   
        URL = "<?php echo SITE_BASE_URL;?>Property/Refresh.html?id=" + id ;
   
           $.ajax({url: URL, success: function(result){
   
               //alert(result)
   
               //alert("Error while delete : \n" + result);
   
               document.getElementById("imageFile").value=result;
   
               alert("Deleted Successfully");
   
           }});
   
     //===============================   
   
   }
   
   else{
   
       alert("Error while delete : \n" + result);
   
   }
   
   }});
   
   }
   
   function AddRowPROPERTY(arg)
   
   {
   
   ObjPorts     =   $("#"+ arg +"ExistRowCount")
   
   NumPorts     =   ObjPorts.val()
   
   NumPorts++           
   
   Reg              =   /XXXXX/gi;
   
   ObjTemplate      =   $("#"+ arg +"Template").html().replace(Reg,NumPorts) 
   
   $("#"+arg+"Body").append(ObjTemplate); 
   
   
   
   ObjPorts.val(NumPorts)  
   
   return false
   
   }
   
   $(document).ready(function(){
   
   $(".date_picker").datepicker({
   
      setDate: new Date(),
      format: 'yyyy-mm-dd',
      todayHighlight: true,
      autoclose: true,
   
   });
   

   });
   
</script>