<link rel="stylesheet" type="text/css" href="<?= SITE_BASE_URL; ?>dashboard/assets/plugins/flexslider/css/flexslider.min.css">
<?php
if($project_id=='' || $project_id==null)
{   
    $project_id=$_REQUEST["project_id"];
}

\Property\PropertyClass::Init();
$rowse = \Property\PropertyClass::GetProjectDatas($cond);
foreach ($rowse as $row1)
{
    $Projectcurrency=$row1["currency"];
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
    if($Xrate=="" || $Xrate==null)
    {
        $Xrate=1;
    }
    if($Currency=="NZD")
    {
        $Prefix="NZ$";
    }
    elseif($Currency=="AUD")
    {
        $Prefix="AU$";
    }
    elseif($Currency=="GBP")
    {
        $Prefix="£";
    }
    else
    {
        $Prefix=$Currency." ";
    }
}
?>
<!--<div class="toggle-column">
    <div class="toggle-btn py-3">
       <button class="btn btn-orange d-block mr-auto bttn-tog<?php echo $IsAvailable.$project_id.$IsReserved;?>" name="PRICE<?php echo $IsAvailable.$project_id.$IsReserved;?>">expand/collapse</button>
    </div>
</div>-->
<div>
    <div class="projects-panel">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="available-properties">
                <thead>
                    <th class="Building<?php echo $IsAvailable.$project_id.$IsReserved;?>">Building</th>
                    <th class="APT_No<?php echo $IsAvailable.$project_id.$IsReserved;?>">APT No</th>
                    <th class="Level<?php echo $IsAvailable.$project_id.$IsReserved;?>">Level</th>
                    <th class="Aspect<?php echo $IsAvailable.$project_id.$IsReserved;?>">Aspect</th>
                    <th class="Floorplan<?php echo $IsAvailable.$project_id.$IsReserved;?>">Floorplan</th>
                    <th class="Size<?php echo $IsAvailable.$project_id.$IsReserved;?>">Area (Apartment) <br> <span class='size<?php echo $Projectrow["PROJECT_ID"]?>'><a class="active apt-size" href="#"><?php if(isset($unit) && $unit['area_unit'] == "m"){ echo 'm<sup>2</sup>';} else {
                        echo 'ft<sup>2</sup>';
                    } ?></a></span></th>
                    <th class="Balcony<?php echo $IsAvailable.$project_id.$IsReserved;?>">Area</th>
                    <th class="Bed<?php echo $IsAvailable.$project_id.$IsReserved;?>">Bed</th>
                    <th class="Bath<?php echo $IsAvailable.$project_id.$IsReserved;?>">Bath</th>
                    <th class="PRICE<?php echo $IsAvailable.$project_id.$IsReserved;?>">Retail Asking Price <br>(<?Php echo $Prefix;?>)</th>
                    <th class="PRICE<?php echo $IsAvailable.$project_id.$IsReserved;?>">Strike Price</th>
                    <th class="PRICE<?php echo $IsAvailable.$project_id.$IsReserved;?>">Discount at Strike Price <br>(%)</th>
                    <th class="PRICE<?php echo $IsAvailable.$project_id.$IsReserved;?>">Current Dynamic Price<br>(<?Php echo $Prefix;?>)</th>
                    <th class="PRICE<?php echo $IsAvailable.$project_id.$IsReserved;?>">Reservation Fee</th>
                    <?php
                    if($IsReserved!="Y")
                    {?>
                        <?php if($IsAvailable!="Y"){?><th class="CompareA<?php echo $IsAvailable.$project_id.$IsReserved;?>">Favourites</th><?php }?>
                        <th class="Reservation<?php echo $IsAvailable.$project_id.$IsReserved;?>">Reservation</th>
                        <th class="Action<?php echo $IsAvailable.$project_id.$IsReserved;?>">Action</th>
                    <?php
                    }?>
                </thead>
                <tbody>
                <?php
                $list = array (
                    array('#', 'Building', 'APT No', 'Level','Aspect','Floorplan','APT Size(approx BOMA m2 ft2)','Approx Patio Balcony(m2 ft2)','Car park','Bed','Bath','Price GST Incl','status')
                );
                $fp = fopen('CSV_Downloads/'.$Projectrow["PROJECT_NAME"].'.csv', 'w');
        	    if($IsAvailable=="Y")
    	        {
    	            $cond=" AND pd.reserved_by is null  ";
    	        }
    	        if($IsReserved=="Y")
    	        {
    	            $cond=" AND pd.reserved_by is not null and pd.reserved_by not in ('".$LoginUserId."') ";
    	        }
                $cond.=" AND ( pj.project_id=$project_id";
                
                if($_SERVER['REQUEST_METHOD'] == "POST")
                {
                    if(isset($_REQUEST['btn_search']))
                    {
                        $bedroomfrm = $_REQUEST['bedroomfrom'];
                        $bedroomtoo = $_REQUEST['bedroomto'];
                        $priceStart = $_REQUEST['price'];
                        $priceEnd   = $_REQUEST['eprice'];
                        
                        if($bedroomfrm != "" && $bedroomtoo != "")
                        {
                            $cond .= " AND ( NO_OF_BEDROOMS >= '". $bedroomfrm ."' AND NO_OF_BEDROOMS <= '". $bedroomtoo ."' ) ";
                        }
                        
                        if($priceStart != "" && $priceEnd != "")
                        {
                            $cond .= " AND ( dynamic_rate > '". $priceStart ."' AND dynamic_rate < '". $priceEnd ."' ) ";
                        }
                    }
                }
                
                $cond.=")";
                // echo $cond;
                // die();
                \Property\PropertyClass::Init();
                $rows = \Property\PropertyClass::GetPropertiesDatas('','',$cond);
                $j = 1;
                // echo "<pre>";
                foreach ($rows as $row) 
                {
                    // print_r($row);
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
                        
                        <td class="Building<?php echo $IsAvailable.$project_id.$IsReserved;?>"><?php echo $row["building"];?></td>
            		    <td class="APT_No<?php echo $IsAvailable.$project_id.$IsReserved;?>"><?php echo $row["UNIT_NO"];?></td>
            		    <td class="Level<?php echo $IsAvailable.$project_id.$IsReserved;?>"><?php echo $row["level"];?></td>
            		    <td class="Aspect<?php echo $IsAvailable.$project_id.$IsReserved;?>"><?php echo $row["aspect"];?></td>
            		    <td class="Floorplan<?php echo $IsAvailable.$project_id.$IsReserved;?>"> <?php echo $row["floor_type"];?></td>
                        <td class="Size<?php echo $IsAvailable.$project_id.$IsReserved;?>"><input type='hidden' value='<?php echo $row["land_area"];?>' class='Land'> <span class='spanLand<?php echo $Projectrow["PROJECT_ID"];?>' ><?php echo $row["land_area"];?></span></td>
            		    <td class="balcony_terrace<?php echo $IsAvailable.$project_id.$IsReserved;?>"><span class='spanbalcony<?php echo $Projectrow["PROJECT_ID"];?>' ><?php echo $row["balcony_terrace"];?></span></td>
            		    
            		    <td class="Bed<?php echo $IsAvailable.$project_id.$IsReserved;?>"><?php echo $row["no_of_bedrooms"];?></td>
            		    <td class="Bath<?php echo $IsAvailable.$project_id.$IsReserved;?>"><?php echo $row["no_of_bathroom"];?></td>
            		    <td class="PRICE<?php echo $IsAvailable.$project_id.$IsReserved;?>">
            		        <!--<img class="price-icon" src="<?php echo SITE_BASE_URL; ?>assets/img/icon/bars-profit.png" class="img-fluid"><br>-->
            			    <div class="price-wrap"><?php //echo $Prefix;?><span class="price-text text-primary"><?php echo number_format(round($row["rate"])*$Xrate,0);?></span></div>
            		    </td>
            		    <td class="PRICE<?php echo $IsAvailable.$project_id.$IsReserved;?>">
            		        <!--<img class="price-icon" src="<?php echo SITE_BASE_URL; ?>assets/img/icon/bars-profit.png" class="img-fluid">-->
            			    <div class="price-wrap"><?php //echo $Prefix;?><span class="price-text text-primary"><?php echo number_format(round($row["dpo_rate"])*$Xrate,0);?></span></div>
            		    </td>
          <td class="PRICE<?php echo $IsAvailable.$project_id.$IsReserved;?>"><?php echo round((($row["rate"]-$row["strike_price"])/$row["rate"])*100,2);?>%</td>
            		    <td class="PRICE<?php echo $IsAvailable.$project_id.$IsReserved;?>">
            			    <div class="price-wrap"><?php //echo $Prefix;?>
            			        <!-- <img class="price-icon" src="<?php echo SITE_BASE_URL; ?>assets/img/icon/bars-loss.png" class="img-fluid"> -->
            			        <br>
            			        <span class="price-text text-danger">
            			            <?php

            			            // echo  "Rate: " .$row['rate'] . "<br>";
            			            // echo  "start_rate: " .$row['start_rate'] . "<br>";
            			            // echo  "noOfreserved: " .$noOfreserved . "<br>";
            			            // echo  "noOfProperties: " .$noOfProperties . "<br>";
            			            // die();
                                    if($noOfreserved > $noOfProperties)
                                    {
                                       $noOfreserved = $noOfProperties;
                                    }
            			            $val1 = $row['rate'] - $row['start_rate'];
            			            $val2 = $val1 * $noOfreserved;
            			            $val3 = $val2 / $noOfProperties;
            			            $val4 = $row['rate'] - $val3;
            			            echo number_format($val4);

            			            ?>
                                </span>
                            </div>
            		    </td>
            		    <td class="PRICE<?php echo $IsAvailable.$project_id.$IsReserved;?>"><?php echo number_format(round($row["Reservation_Fee"])*$Xrate,0);?></td>
            		    <!-- <td class="PRICE<?php // echo $IsAvailable.$project_id.$IsReserved;?>">
            			   <div class="price-wrap"><span class="price-text text-danger">%</span></div>
            			    <?php // echo round((($row["rate"]-$row["dynamic_rate"])/$row["rate"])*100,2);?>
            		    </td>-->
                        <?php
                        $IsFavPro="";
                        $CondiPro=" And property_id='".$row["property_id"]."' AND user_id='".$LoginUserId."' ";
                        $rowProFavs = \Property\PropertyClass::GetFavoriteProperty($CondiPro);
                        foreach ($rowProFavs as $rowProFav) 
                        {
                            if($rowProFav["property_id"]!="" && $rowProFav["property_id"]!=null)
                            {
                                $IsFavPro="Y";
                            }
                            else
                            { 
                                $IsFavPro=""; 
                                
                            }
                        }
                        if($IsReserved!="Y")
                        {
                            if($IsAvailable!="Y"){
                            ?>
                            <td class="CompareA<?php echo $IsAvailable.$project_id.$IsReserved;?>" align='center'>
                                <span id="Prop<?php echo $row["property_id"];?>">
                                <?php
                                    $postProid=$row["property_id"]."####".$LoginUserId;
                                    if($IsFavPro=="Y")
                                    {
                                        ?>
                                        <a class="text-success" href="javascript:CanfavouritePro('<?php echo $postProid;?>')" title="Remove Favorite" data-id='<?php echo $postProid;?>' ><i class="fas fa-star"></i></a>
                                        <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <a class="text-danger" href="javascript:favouritePro('<?php echo $postProid;?>')" title="Add To Favorite" data-id='<?php echo $postProid;?>' ><i class="far fa-star"></i></a>
                                    <?php
                                    }
                                ?>
                               <span>
                            </td>
                            <?php
                            }
                            ?>
                            <td  class="Reservation<?php echo $IsAvailable.$project_id.$IsReserved;?>">
                            <?php 
                            if($row["sold_to"]!='' && $row["sold_to"]!=null && '1'=='2')
                            {
            			        echo "<span style='color:green;background-color:yellow'><b><br>PURCHASED</b></span>";
            		        }
            		        elseif($row["reserved_by"]==\settings\session\sessionClass::GetSessionDisplayName() && '1'=='2')
            		        {
            		        ?>
            		            <a class="btn btn-danger btn-sm" href="<?php echo SITE_BASE_URL; ?>Property/Cancel.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $project_id; ?>">Cancel</a>
                			    <?php
                				if($reservedCount==$totalCount)
                				{
                				?>
                                    <a class="btn btn-dark btn-sm" href="<?php echo SITE_BASE_URL; ?>Property/Purchase.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $project_id; ?>">Purchase</a>
                			    <?php
                				}
            		        }
            			    elseif($row["reserved_by"]!="" && $row["reserved_by"]!=null)
            			    {
            			    ?>
                                <button  class="btn btn-danger btn-sm"  disabled> Reserved </button>
                                <!--<a  data-buildingname="<?php echo $row["building"];?>" data-propertyid="<?php echo $row["property_id"]; ?>" data-price="<?php echo number_format(round($row["dpo_rate"]*$Xrate,0));?>" class="btn btn-secondary btn-sm paypal" href="javascript:void(0)" nowrap>Pay now</a>-->
            		        <?php
            			    }
            		        else
            		        {
            		        ?>
            		            <a class="btn btn-success btn-sm" href="<?php echo SITE_BASE_URL; ?>Property/ReserveWizardStart.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $project_id; ?>">Reserve</a>
                            <?php
                            }
                            ?>
                            </td>
                            <td class="Action<?php echo $IsAvailable.$project_id.$IsReserved;?>">
                                <a class="btn btn-dark btn-sm" href="<?php echo SITE_BASE_URL; ?>Property/PropertyFullDtl.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $project_id; ?>">ANALYSE</a>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                    $j=$j+1;
                }
                // die();
                foreach ($list as $fields)
                {
                    fputcsv($fp, $fields);
                }
                fclose($fp);
                ?>
               </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).on("click", ".CompareRow", function(){
    if($(this).is(":checked"))
    {
        Properties=$(this).val();
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
    else
    {
        Properties=$(this).val();
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
    
});

   $(".bttn-tog<?php echo $IsAvailable.$project_id.$IsReserved;?>.active").each(function() {
    var column = "table ." + $(this).attr("name");
    $(column).hide();
    return false;
});

$(".bttn-tog<?php echo $IsAvailable.$project_id.$IsReserved;?>").click(function(){
    var column = "table ." + $(this).attr("name");
    $(column).toggle();
    $(this).toggleClass('active');
    return false;
});

</script>