<?php include"header.php"; ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css">
<style type="text/css" media="screen">
    .lSSlideOuter .lSPager.lSpg>li a{
        height: 14px !important;
        width: 14px !important;
    }
    .fav-slider .c-pointer {
        cursor: pointer;
        padding: 5px 5px;
    }
</style>

<h4>My Favourite Projects</h4>

<div class="row">
   <div class="col-12">
      <div class="fav-slider mb-30">
         <ul id="favProject">
            <?php
            $condFavPj=" AND pj.project_id in (Select project_id from Add_favorite_project where user_id='".$LoginUserId."') ";
            $rowFavs = \Property\PropertyClass::GetPorjectDatas('','',$condFavPj);
            $p = 1;
            foreach ($rowFavs as $rowFav)
            {
                $rowFavsells = \Property\PropertyClass::ProjectSellingDtl($rowFav["PROJECT_ID"]);
                $effective_date=$rowFav["effective_date"];
                $Country=$rowFav["Country"];
                $expiry_date=$rowFav["expiry_date"];
                $date = date("Y-m-d h:i:s");
                $effective_date1 = strtotime($effective_date);
                $expiry_date1 = strtotime($expiry_date);
                $date1 = strtotime($date);
                foreach ($rowFavsells as $rowFavsell)
                {
                    $reservedCount=$rowFavsell["reserved_count"];
                    $soldCount=$rowFavsell["sold_count"];
                    $totalCount=$rowFavsell["total_count"];
                    $Start_dynamin_price=$rowFavsell["Start_dynamin_price"];
                    $Projcurr=$row["currency"];
                    if($totalCount=='' ||$totalCount=='0' || $totalCount==null)
                    {
                        $totalCount=1;
                    }
                    if($Currency==$Projcurr)
                      {
                          $Xrate=1;
                      }
                      else
                      {
                           $Xraterows = \Property\PropertyClass::GetCurrExrate($Projcurr,$Currency);
                           $j = 1;
                           foreach ($Xraterows as $Xraterow)
                           {
                               $Xrate=$Xraterow["RATE"];
                           }
                      }
                      if($Xrate=="" || $Xrate==null){
                          $Xrate=1;
                      }
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
                }?>
            <li>
               <div class="property-card" id="property<?php echo $p;?>">
                  <div class="property-card-body">
                     <div class="select-box">
                        <div class="pull-right">
                           <div class="dropdown custom-dropdown">
                              <div data-toggle="dropdown">
                                 <i class="ti-more-alt rotate-90 d-inline-block c-pointer"></i>
                              </div>
                              <div class="dropdown-menu dropdown-menu-right">
                                 <a href="#" class="dropdown-item f-s-12">Edit</a>
                                 <a href="#" class="dropdown-item f-s-12">Delete</a>
                                 <a href="#" class="dropdown-item f-s-12">Analyse</a>
                              </div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                     <div class="property-card-img">
                        <img src="<?php echo SITE_BASE_URL;?>uploads/projectimage/<?php echo $rowFav["image_file"]; ?>" class="img-responsive">
                     </div>
                     <div class="property-card-table">
                        <table class="table">
                           <tr>
                              <td>Country</td>
                              <td align="right"><?php echo $Country;?></td>
                           </tr>
                           <tr>
                              <td>Project Name</td>
                              <td align="right"><?php echo $rowFav["PROJECT_NAME"];?></td>
                           </tr>
                           <tr>
                              <td>Status</td>
                              <td align="right">
                                  <span class="label label-success">
                                    <?php
                                      if($totalCount==$soldCount){?>
                                           Purchased
                                           <?php }
                                      elseif($totalCount==$reservedCount){?>
                                           Reserved
                                           <?php }
                                      else{
                                                  echo 'Available';
                                        }?>
                                  </span>
                              </td>
                           </tr>
                           <tr>
                               <td>Price</td>
                               <td align="right"><h4 class="price-heading"><?php echo $Prefix." ".round($Start_dynamin_price*$Xrate);?><ion-icon name="trending-up-sharp"></ion-icon></h4></td>
                           </tr>
                        </table>
                     </div>
                  </div>
               </div>
            </li>
            <?php
             $p=$p+1;
             }?>
         </ul>
      </div>
   </div>
</div>

<h4>My Favourite Properties..</h4>
<form name='form2'>
<div class="row">
   <div class="col-12">
      <div class="fav-slider mb-30">
         <ul id="favProp">
            <?php
               $condFav=" and pd.property_id in (Select property_id from Add_favorite_property where user_id='".$LoginUserId."') ";
               \Property\PropertyClass::Init();
               $rows1 = \Property\PropertyClass::GetPropertiesDatas('','',$condFav);
               $j = 1;
               foreach ($rows1 as $row1)
               {
                $effective_date=$row["effective_date"];
                $projectName=$row1["project_name"];
                $country=$row1["country"];
                $ProjectIdd=$row1["project_id"];
                $floortype=$row1["floor_type"];
    	        $Country=$row["country_name"];
    	        $Projectcurrency=$row["currency"];
    	        $expiry_date=$row["expiry_date"];
    	        $NoOfProperty=$row1["No_of_property"];
    	        $NoOfAvProperty=$row1["No_of_Av_property"];
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
            <li>
               <div class="property-card" id="property<?php echo $j;?>">
                  <div class="property-card-body">
                     <div class="select-box">
                        <div class="pull-left">
                           <input type="checkbox" name="ComPropertyId" Id="ComPropertyId" class="check property-check" value="<?php echo $row1["property_id"];?>" >
                        </div>
                        <div class="pull-right">
                           <div class="dropdown custom-dropdown">
                              <div data-toggle="dropdown">
                                 <i class="ti-more-alt rotate-90 d-inline-block c-pointer"></i>
                              </div>
                              <div class="dropdown-menu dropdown-menu-right">
                                 <a href="#" class="dropdown-item f-s-12">Edit</a>
                                 <a href="#" class="dropdown-item f-s-12">Delete</a>
                                 <a href="#" class="dropdown-item f-s-12">Analyse</a>
                              </div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                     <div class="property-card-img">
                         <?php
                        $Proimagerows = \Property\PropertyClass::GetPropertyImages($ProjectIdd,$floortype);
                        foreach ($Proimagerows as $Proimagerow)
                        {
                        $imageFileName=$Proimagerow["image"];
                        }?>
                        <img src="<?php echo SITE_BASE_URL; ?>uploads/propertyimage/<?php echo $imageFileName; ?>" class="img-responsive">
                     </div>
                     <div class="property-card-table">
                        <table class="table">
                           <tr>
                              <td>Country</td>
                              <td><?php echo $country;?></td>
                           </tr>
                           <tr>
                              <td>Project</td>
                              <td><?php echo $projectName;?></td>
                           </tr>
                           <tr>
                              <td>building</td>
                              <td><?php echo $row1["building"];?></td>
                           </tr>
                           <tr>
                              <td>Price</td>
                              <td><?php echo $Prefix." ".number_format(round($row1["dynamic_rate"]*$Xrate,2));?></td>
                           </tr>
                        </table>
                     </div>
                  </div>
               </div>
            </li>
            <?php
               $j=$j+1;
               }?>
         </ul>
      </div>
   </div>
   <div class="col-12" align=center>
        <button type="button" class="btn btn-dark mb-2 Compare1" data-toggle="modal" data-target="#exampleModalCenter">Compare</button>
    </div>
</div>
</form>




<?php
$Mode             = \Masters\MastersClass::$Mode;
if ($Mode == "edit"){
    \Masters\MastersClass::GetMyFolderDbValues();
    $FormUrl = "myfolderfileupdate.html";
}
else{
    $FormUrl = "myfolderfileupload.html";
}

$Id             = \Masters\MastersClass::$Id;
$DocName        = \Masters\MastersClass::$DocName;
$DocRemarks     = \Masters\MastersClass::$DocRemarks;
$Mode           = \Masters\MastersClass::$Mode;
$UploadedFiles  = \Masters\MastersClass::$UploadedFiles;

$FinYr          = \Masters\MastersClass::$FinYr;
$Category       = \Masters\MastersClass::$Category;
$Amount         = \Masters\MastersClass::$Amount;

$ProjectId      = \Masters\MastersClass::$ProjectId;
$ProjectName    = \Masters\MastersClass::$ProjectName;
$UnitNo         = \Masters\MastersClass::$UnitNo;

$PropertyCountryId = \Masters\MastersClass::$PropertyCountryId;
$currencyId = \Masters\MastersClass::$currencyId;

$BrochureFile  = \Masters\MastersClass::$BrochureFile;
$FilePath      = "";

//echo "File => " . $BrochureFile; 
//exit;

if ($BrochureFile != ""){
    $FilePath       = "uploads/myfolder/" . $BrochureFile; 
}

?>

<div class="row mt-30">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <form action="<?php echo SITE_BASE_URL;?>Masters/<?php echo $FormUrl; ?>?id=<?php echo $Id; ?>&mode=<?php echo $Mode; ?>" method="post" class="dpo-form" name='form1' enctype="multipart/form-data">
          <div class="form-group">
            <label>Property</label>
            
            <?php 
            $CurSession = \settings\session\sessionClass::GetSessionUserName();
            /*
            echo \Html\Elements\InputsClass::plotCombo( "ProjectId", array(), "SELECT property_master_auto_id as id, location_name as description FROM my_portfolio_property_hdr 
                                                                where user_id='{$CurSession}' and location_name <> ''", $ProjectId, "Select Category", "class='form-control input-default'"); 
            */
            
            ?>
            <input class="form-control input-default" type="text" name="ProjectName" id="ProjectName" value="<?php echo $ProjectName?>" placeholder="Property Name">
          </div>
          
          
          <div class="form-group">
            <label>Unit No</label>
            <input class="form-control input-default" type="text" name="UnitNo" id="UnitNo" value="<?php echo $UnitNo?>" placeholder="Unit No">
          </div>
          
          
          
          <div class="form-group">
            <label>Country</label>
            <?php echo \Html\Elements\InputsClass::plotCombo( "PropertyCountryId" , array() , "SELECT COUNTRY_CODE id, COUNTRY_NAME description FROM `country_master` ORDER BY COUNTRY_NAME" , 
                                                              $PropertyCountryId , "Select Country", "class='form-control input-default'"); ?>
          </div>
          
          <div class="form-group">
            <label>Currency</label>
            <!--<input readonly class="form-control input-default" type="text" name="currencyId" id="currencyId" value="<?php echo $currencyId?>" placeholder="NZD">-->
            <?php echo \Html\Elements\InputsClass::plotCombo( "currencyId" , array() , "SELECT currency_id id, description FROM currency_master order by description" , 
                                                              $currencyId , "Select Currency", "class='form-control input-default'"); ?>
          </div>
          
          <div class="form-group">
            <label>Tax Year</label>
            <span id="TaxYrContainer">
                <?php echo \Html\Elements\InputsClass::ShowFinYrDropdown( "FinYr" , array() , $FinYr, "Select Finance Year", "class='form-control input-default'", $PropertyCountryId ); ?>
            </span>
          </div>
          
          
          <div class="form-group">
            <label>Category</label>
            
            <?php echo \Html\Elements\InputsClass::plotArrayCombo( "Category", "CATEGORY", $Category, "Select Category", "class='form-control input-default'"); ?>
            
          </div>
          <div class="form-group">
            <label>Amount</label>
            <input class="form-control input-default" type="text" name="Amount" id="Amount" value="<?php echo $Amount?>" placeholder="$210000">
          </div>
          
          <div class="form-group">
            <input type="file" name="UploadFile" id="UploadFile">
            
            <?php
            if ($FilePath != ""){
                echo "<a href='" . SITE_BASE_URL . $FilePath . "' target='_blank'>Uploaded File</a>";
            }
            ?>
          </div>
          
          <?php 
          if ($Mode == "edit"){
              ?>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?php echo SITE_BASE_URL;?>Masters/myfolder.html">Back</a>
        <?php } else{ ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>






<div class="row mt-30">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        
        
    		 <table class="table table-striped">
              <thead>
                <tr>
                    <th>PROPERTY NAME</th> 
    				<th>UNIT NO</th> 
    				<th>TAX YEAR</th> 
    				<th>CATEGORY</th> 
    				<th>AMOUNT</th>
                    <th>ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php
                \Masters\MastersClass::Init();
                $rows = \Masters\MastersClass::GetMyFolderDatas();
                $i = 1;
                foreach ($rows as $row) 
                {
                    $FinYr      = isset($row["FINANCE_YR"]) ? $row["FINANCE_YR"] : ""; 
                    $Cat        = isset($row["CATEGORY"]) ? $row["CATEGORY"] : ""; 
                    $FinYrText  = Html\Elements\InputsClass::GetFinYrValue($FinYr);
                    $Category   = Html\Elements\InputsClass::GetProjCategoryValue($Cat);
                    $UnitNo     = isset($row["UNIT_NO"]) ? $row["UNIT_NO"] : ""; 
                ?>
                <tr>
                  <td><?php echo $row["PROJECT_NAME"];?></td>
                  <td><?php echo $UnitNo;?></td>
                  <td><?php echo $FinYrText;?></td>
                  <td><?php echo $Category;?></td>
                  <td><?php echo $row["AMOUNT"];?></td>
                  <td>
                    <button type="button" class="btn btn-primary btn-sm" onclick="FnEdit('<?php echo $row["MY_FOLDER_ID"];?>')">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="FnDelete('<?php echo $row["MY_FOLDER_ID"];?>')">Delete</button>
                  </td>
                  
                </tr>
                <?php
                }?>
              </tbody>
            </table>
        
        
      </div>
    </div>
  </div>
</div>

<!-- compare Modal -->
<div class="modal fade" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Property Comparison</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="ComparedData" >
                  </table>
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
                
                
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            
        </div>
        
      
        
    </div>
</div>

<!-- apexchart -->
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/js/apexcharts.min.js"></script>
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/chartjs/Chart.bundle.js"></script>
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

<!-- compare Modal-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css">

<?php include"footer.php"; ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
<!-- apexchart -->
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/js/apexcharts.min.js"></script>
<!-- owl crousal -->
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/owl-crousal/js/owl.carousel.min.js"></script>
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/chartjs/Chart.bundle.js"></script>
<script>

function DeleteFolderFn(id){

    if (!confirm("Sure! Are you want to Delete Folder?")){

        return false;

    }

    

    URL = "<?php echo SITE_BASE_URL;?>Masters/DeleteFolder.html?FolderId=" + id;

    //console.log(URL)

    $.ajax({url: URL, success: function(result){

        //console.log(result)

        if (result.trim() == "success"){

            //alert("Deleted");

            window.location.reload();

        }

        else{

            alert("Error while delete : \n" + result);

        }

    }});

}


/*
$(document).on("change", "[name='ProjectId']", function(){
    URL = "<?php echo SITE_BASE_URL;?>Masters/GetPropertyDtls.html?id=" + this.value;

    $.ajax({url: URL, dataType: 'JSON', success: function(result){
        $("[name='PropertyCountryId']").val(result.CountryId); 
        $("[name='currencyId']").val(result.currencyId); 
    }});
});
*/

$(document).on("change", "[name='PropertyCountryId']", function(){
    URL = "<?php echo SITE_BASE_URL;?>Masters/GetFinYrDtls.html?PropertyCountryId=" + this.value;
    

    $.ajax({url: URL, dataType: 'JSON', success: function(result){
        //console.log(result); 
        //$("[name='PropertyCountryId']").val(result.CountryId); 
        $("[name='currencyId']").val(result.currencyId); 
        
        $("#TaxYrContainer").html(result.DpStr); 
    }});
});






function DeleteFileFn(id, filename){

    if (!confirm("Sure! Are you want to Delete File?")){

        return false;

    }

    

    URL = "<?php echo SITE_BASE_URL;?>Masters/DeleteFile.html?FolderId=" + id + "&filename=" + filename;

    console.log(URL)

    $.ajax({url: URL, success: function(result){

        //console.log(result)

        if (result.trim() == "success"){

            //alert("Deleted");

            window.location.reload();

        }

        else{

            alert("Error while delete : \n" + result);

        }

    }});

}



function AddFolderFn(){

	$.colorbox({iframe:true, href:"<?php echo SITE_BASE_URL;?>Masters/AddFolder.html", innerWidth:700, innerHeight:400, onClosed:function(){window.location.reload();} });

}



function AddFilesFn(id){

	$.colorbox({iframe:true, href:"<?php echo SITE_BASE_URL;?>Masters/AddFiles.html?id=" + id, innerWidth:700, innerHeight:350, onClosed:function(){window.location.reload();} });

}



function ViewFn(id){

    window.location.href = "<?php echo SITE_BASE_URL;?>Masters/myfolder.html?id=" + id;





    //window.location.href = "<?php echo SITE_BASE_URL;?>Masters/myfolderview.html?id=" + id;

}



function FnEdit(id){

    window.location.href = "<?php echo SITE_BASE_URL;?>Masters/myfolder.html?mode=edit&id=" + id;

}

function FnDelete(id){
    if (confirm("Are you sure want to Delete?") == false){
        return false; 
    }
    
    window.location.href = "<?php echo SITE_BASE_URL;?>Masters/DeleteFolder.html?mode=delete&id=" + id;

}


function AddFn(id){

    window.location.href = "<?php echo SITE_BASE_URL;?>Masters/myfolderadd.html";

}

</script>
<!-- owl crousal -->
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/owl-crousal/js/owl.carousel.min.js"></script>
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/chartjs/Chart.bundle.js"></script>
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#favProject').lightSlider({
        item:4,
        loop:false,
        slideMove:2,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed:600,
        responsive : [
            {
                breakpoint:800,
                settings: {
                    item:3,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:480,
                settings: {
                    item:2,
                    slideMove:1
                  }
            }
        ]
    });

    //Fav Property
    $('#favProp').lightSlider({
        item:4,
        loop:false,
        slideMove:2,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed:600,
        responsive : [
            {
                breakpoint:800,
                settings: {
                    item:3,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:480,
                settings: {
                    item:2,
                    slideMove:1
                  }
            }
        ]
    });
});

$(function () { 
    $(document).on("click", ".Compare1", function(){
        property=document.form2.ComPropertyId;
        properties=''
        for (var i=0, len=property.length; i<len; i++) {
            if(property[i].checked)
            {
                if(properties=='' || properties==null)
                {
                    properties=property[i].value;
                }
                else
                {
                    properties+=','+property[i].value;
                }
            }
        }
        //alert(properties);
        if(properties=="" || properties==null)
        {
            alert("select any property from My Favourite Properties to compare.")
            return false;
        }
        //================================
    	    URL = "<?php echo SITE_BASE_URL;?>Property/CompareProperty.html?Remove=N&properties=" + properties ;
            $.ajax({url: URL, success: function(result){
                $("#ComparedData").html(result);
               
            }});
            // MapFn();
    	//===============================   
    });
});


</script>


