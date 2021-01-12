<?php include"header.php";?>

<link rel="stylesheet" type="text/css" href="assets/icons/icofont/icofont.min.css">
<style type="text/css">
 @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
  
 .media-section:not(:last-child){
   margin-bottom: 30px;
 }
 .media-text{
   padding-left: 15px;
   position: relative;
 }
.comments{
   text-align: center;
    display: inline-block;
    position: absolute;
    right: 0px;
    top: 0px;
}
.comments a{
   font-size: 14px;
   line-height: 12px;
   color: #4C6CBF;
}
.media-slug{
   font-family: 'Poppins', sans-serif;
   font-weight: 600;
   font-size: 14px;
   letter-spacing: .35px;
   color: #4c4c4c;
}
.media-title a{
   font-family: 'Poppins', sans-serif;
   font-weight: 400;
   color: #B89B30;
   font-size: 18px;
}
.media-title a:hover{
   color: #DFC667;
}
.media-description{
   font-family: 'Montserrat', sans-serif;
   color: #4c4c4c;
   font-weight: 400;
}
</style>
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<style type="text/css">
   .prop-thumb{
      max-width: 120px;
   }
   .price-heading{
      font-family: 'Oswald';
      font-weight: 500;
      color: #7ADE40 !important;
      min-width: 120px;
   }
   .price-heading ion-icon {
      color: #000;
   }
   .table-property .label, .table-property .btn{
      border-radius: 0px;
      text-transform: capitalize;
      font-family: Poppins;
      font-weight: 400;
      height: 30px;
   }
   .table-property thead tr th{
      font-family: Poppins;
      color: #000;
      font-weight: 500;
   }
   .table-property > thead > tr > th, .table-property > thead > tr > td,.table-property > tbody > tr > td{
      border-top: 1px solid transparent !important;
      border-bottom: 1px solid transparent !important;
   }
   .table-property tbody tr:nth-of-type(odd){
      box-shadow: 0px 1px 10px rgba(200,200,200,.35);
   }


   .btn-close{
      color: #fff;
      background: #4c4c4c;
   }
   .btn-close:hover{
      background-color: #F0EAEA;
      color: #4c4c4c;
   }
</style>
<div class="card">
   <div class="card-body">
        <h4 class="card-title">MY CLIENTS</h4>
        <div class="table-responsive">
           <table class="table verticle-middle table-property">
              <thead>
                 <tr>
                    <th scope="col">USER IMAGE</th>
                    <th scope="col">USER ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">LOCATION</th>
                    <th scope="col">FAVORITE PROJECTS</th>
                    <th scope="col">FAVORITE PROPERTIES</th>
                 </tr>
              </thead>
              <tbody>
                 <?php
                    \Masters\MastersClass::Init();
                     $cond1=" AND Advisor='".$LoginUserId."'";
                     $rows = \Masters\MastersClass::GetUserData($cond1);

                     $i = 1;

                     foreach ($rows as $row) 

                     {
                    ?>
                 <tr>
                    <td>
                       <img src="<?php echo SITE_BASE_URL; ?>uploads/ProfilePic/<?php echo $row["image_file"];?>" alt="" class="rounded-circle" width=70px height=70px>
                    </td>
                    
                    <td>
                        <?php echo $row["user_id"];?>
                    </td>
                    
                    <td>
                        <?php echo $row["first_name"]." ".$row["last_name"];?>
                    </td>
                    <td>
                        <?php echo $row["country_name"];?>
                    </td>
                    <td>
                        <button class="btn bttn-tog<?php echo $row["id"];?> btn-sm active" name="Action<?php echo $row["id"];?>">expand/collapse</button><span class='Proj<?php echo $row["id"];?>'></span>
                    </td>
                    <td>
                        <button class="btn bttnPro-togPro<?php echo $row["id"];?> btn-sm active" name="ProAction<?php echo $row["id"];?>">expand/collapse</button><span class='Prop<?php echo $row["id"];?>'></span>
                    </td>
                 </tr>
                 <tr class="Action<?php echo $row["id"];?>">
                    <td colspan=5>
                  <!--====================================Favorite project =======================================-->
                     <div class="card">
                         <div class="card-body">
                            <h4 class="card-title">My Favourites(Project)</h4>
                            <div class="table-responsive">
                               <table class="table verticle-middle table-property">
                                  <thead>
                                     <tr>
                                        <th>Project Image</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Project Name</th>
                                        <th scope="col">Reserved</th>
                                        <th scope="col">Status</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                     <?php
                                        $condFavPj=" AND pj.project_id in (Select project_id from Add_favorite_project where user_id='".$row["id"]."') ";
                                        $rowFavs = \Property\PropertyClass::GetPorjectDatas('','',$condFavPj);
                                        $p = 1;
                                        foreach ($rowFavs as $rowFav)
                                        {
                                            $rowFavsells = \Property\PropertyClass::ProjectSellingDtl($rowFav["PROJECT_ID"]);
                                            $effective_date=$rowFav["effective_date"];
                                            $Country=$rowFav["country_name"];
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
                                                    if($totalCount=='' ||$totalCount=='0' || $totalCount==null)
                                                    {
                                                        $totalCount=1;
                                                    }
                                                }?>
                                     <tr>
                                        <td><img src="<?php echo SITE_BASE_URL; ?>uploads/projectimage/<?php echo $rowFav["image_file"];?>" class="img-thumbnail prop-thumb"></td>
                                        <td><?php echo $Country;?></td>
                                        <td><a class="text-muted" href="<?php echo SITE_BASE_URL;?>Property/ProjectView.html?project_id=<?php echo $rowFav["PROJECT_ID"];?>"><?php echo $rowFav["PROJECT_NAME"];?></a></td>
                                        <td>
                                           <div class="progress progress-bar-striped progress-rounded box-shadow">
                                              <div class="progress-bar progress-color <?php if( $reservedCount==0) { ?> bg-info<?php  }  ?>" style="width:<?php if( $reservedCount==0) { ?>100<?php  }  ?><?php echo round(($reservedCount/$totalCount)*100,2);?>%;" role="progressbar"><?php echo round(($reservedCount/$totalCount)*100,2);?>%</div>
                                           </div>
                                        </td>
                                        <td>
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
                                        <td>
                                          <div class="btn-group" role="group">
                                          <a class="btn btn-warning btn-sm" href="<?php echo SITE_BASE_URL;?>Property/ProjectView.html?project_id=<?php echo $rowFav["PROJECT_ID"];?>"><i class="fa fa-link"></i>Take Action</a><button class="btn btn-sm btn-close" data-toggle="tooltip" data-placement="top" title="Remove From Favourite"><i class="icofont-close"></i></button>
                                          </div>
                                        </td>
                                     </tr>
                                     <?php
                                     $p=$p+1;
                                     }if($p==1)
                                     {
                                         echo "<tr><td align=center colspan=8><b>No Records</b></td></tr>";
                                     }
                                     ?>
                                     <script>
                                        $(".Proj<?php echo $row["id"];?>").html("<b>(<?php echo $p-1;?>)</b>");
                                     </script>
                                  </tbody>
                               </table>
                            </div>
                         </div>
                      </div>
                      <!--====================================Favorite Project end=======================================-->
                    </td>
                 </tr>
                 <tr class="ProAction<?php echo $row["id"];?>">
                    <td colspan=5>
                  <!--====================================Favorite project =======================================-->
                     <div class="card">
                         <div class="card-body">
                            <h4 class="card-title">My Favourites(Property)</h4>
                            <div class="table-responsive">
                               <table class="table verticle-middle table-property">
                                  <thead>
                                     <tr>
                                        <th>Property Image</th>
                                        <th scope="col">Project Name</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Price</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                     <?php
                                       $condFav=" and pd.property_id in (Select property_id from Add_favorite_property where user_id='".$row["id"]."') ";
                                       \Property\PropertyClass::Init();
                                       $rows1 = \Property\PropertyClass::GetPropertiesDatas('','',$condFav);
                                       $w = 1;
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
                            	        //echo $Xrate;
                            	        $date = date("Y-m-d h:i:s");
                            	        $effective_date1 = strtotime($effective_date);
                            	        $expiry_date1 = strtotime($expiry_date);
                            	        $date1 = strtotime($date);
                            	        $diff = abs($expiry_date1 - $date1);
                            
                            	        $years = floor($diff / (365*60*60*24));
                            	        $months = floor(($diff - $years * 365*60*60*24)
                            					     / (30*60*60*24));
                            	        $days = floor(($diff - $years * 365*60*60*24 -
                            			   $months*30*60*60*24)/ (60*60*24));
                            
                            	        $days1 = floor(($diff - $years * 365*60*60*24)/ (60*60*24));
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
                                     <tr>
                                        <td>
                                            <?php
                                            $Proimagerows = \Property\PropertyClass::GetPropertyImages($ProjectIdd,$floortype);
                                            foreach ($Proimagerows as $Proimagerow)
                                            {
                                            $imageFileName=$Proimagerow["image"];
                                            }?>
                                            <img src="<?php echo SITE_BASE_URL; ?>uploads/propertyimage/<?php echo $imageFileName; ?>" class="img-thumbnail prop-thumb">
                                        </td>
                                        <td><?php echo $projectName;?></td>
                                        <td><?php echo $Country;?></td>
                                        <td><?php echo $Prefix." ".number_format(round($row1["dynamic_rate"]*$Xrate,2));?></td>
                                     </tr>
                                     <?php
                                     $w=$w+1;
                                     }if($w==1)
                                     {
                                         echo "<tr><td align=center colspan=8><b>No Records</b></td></tr>";
                                     }
                                     ?>
                                  </tbody>
                                  <script>
                                    $(".Prop<?php echo $row["id"];?>").html("<b>(<?php echo $w-1;?>)</b>");
                                 </script>
                               </table>
                            </div>
                         </div>
                      </div>
                      <!--====================================Favorite Project end=======================================-->
                    </td>
                 </tr>
                 <script>
                    $(".bttn-tog<?php echo $row["id"];?>.active").each(function() {
                        var column = "table ." + $(this).attr("name");
                        $(column).hide();
                        return false;
                    });
                    
                    $(".bttn-tog<?php echo $row["id"];?>").click(function(){
                        var column = "table ." + $(this).attr("name");
                        $(column).toggle();
                        $(this).toggleClass('active');
                        return false;
                    });
                    
                    $(".bttnPro-togPro<?php echo $row["id"];?>.active").each(function() {
                        var column = "table ." + $(this).attr("name");
                        $(column).hide();
                        return false;
                    });
                    
                    $(".bttnPro-togPro<?php echo $row["id"];?>").click(function(){
                        var column = "table ." + $(this).attr("name");
                        $(column).toggle();
                        $(this).toggleClass('active');
                        return false;
                    });
                
                </script>

                 <?php }
                    ?>     
              </tbody>
           </table>
        </div>
     </div>
</div>
<?php include"footer.php"; ?>


