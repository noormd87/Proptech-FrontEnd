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


<!--<div class="card">-->
<!--   <div class="card-body custom-scrollbar">-->
<!--       <div class="row">-->
<!--          <div class="col-lg-10">-->
            <?php
//            \Dashboard\DashboardClass::Init();
  //          $NewsFeedrows = \Dashboard\DashboardClass::GetNewsFeed($CountryCode);
    //        $i = 1;
      //      foreach ($NewsFeedrows as $NewsFeedrow) 
        //    {
          //  ?>
            <!--<div class="media-section">-->
            <!--   <div class="row no-gutters">-->
            <!--      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 h-100">-->
            <!--         <div class="media-img-thumb">-->
            <!--            <a href="<?php //echo $NewsFeedrow["url"];?>">-->
            <!--               <img class="media-object img-fluid" src="<?php //echo $NewsFeedrow["urlToImage"];?>" alt="..." >-->
            <!--            </a>-->
            <!--         </div>-->
            <!--      </div>-->
            <!--      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 h-100">-->
            <!--         <div class="media-text">-->
            <!--            <h5 class="media-slug"><?php //echo $NewsFeedrow["author"];?><br><?php //echo $NewsFeedrow["publishedAt"];?></h5>-->
            <!--            <h4 class="media-title"><a href="<?php //echo $NewsFeedrow["url"];?>"> <?php //echo $NewsFeedrow["title"];?></a></h4>-->
            <!--            <p class="media-description"><?php //echo $NewsFeedrow["description"].'<br>'.$NewsFeedrow["content"];?></p>-->
            <!--            <div class="comments">-->
            <!--               <a href="<?php //echo $NewsFeedrow["url"];?>"><i class="icofont-comment"></i> 150</a>-->
            <!--            </div>-->
            <!--         </div>-->
            <!--      </div>-->
            <!--   </div>-->
            <!--</div>-->
            <?php
            //}
            ?>
<!--         </div>-->
<!--      </div>-->
<!--   </div>-->
<!--</div>-->



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
<!--<div class="card">-->
<!--   <div class="card-body">-->
<!--        <h4 class="card-title">Trending Now</h4>-->
<!--        <div class="table-responsive">-->
<!--           <table class="table verticle-middle table-property">-->
<!--              <thead>-->
<!--                 <tr>-->
<!--                    <th scope="col">Project Image</th>-->
<!--                    <th scope="col">Location</th>-->
<!--                    <th scope="col">Project Name</th>-->
<!--                    <th scope="col">Time left</th>-->
<!--                    <th>Start Price<br>(<?php echo $Currency;?>)</th>-->
<!--                    <th scope="col">Reserved</th>-->
<!--                    <th scope="col">Status</th>-->
<!--                    <th>Action</th>-->
<!--                 </tr>-->
<!--              </thead>-->
<!--              <tbody>-->
                 <?php
                    //$rows = \Property\PropertyClass::GetPorjectDatas('','');
                    //$i = 1;
                    //foreach ($rows as $row) 
                    //{ 
                      //  $rowsells = \Property\PropertyClass::ProjectSellingDtl($row["PROJECT_ID"]);
                        // $effective_date=$row["effective_date"];
                        // $Country=$row["country_name"];
                        // $expiry_date=$row["expiry_date"];
                        // $date = date("Y-m-d h:i:s");
                        // $effective_date1 = strtotime($effective_date);  
                        // $expiry_date1 = strtotime($expiry_date);  
                        // $date1 = strtotime($date);  
                        // $diff = abs($expiry_date1 - $date1); 
                        
                        // $years = floor($diff / (365*60*60*24));  
                        // $months = floor(($diff - $years * 365*60*60*24) 
                        //                               / (30*60*60*24)); 
                        // $days = floor(($diff - $years * 365*60*60*24 -  
                        //              $months*30*60*60*24)/ (60*60*24)); 
                        // $days1 = floor(($diff - $years * 365*60*60*24 )/ (60*60*24)); 
                                     
                        // $hours = floor(($diff - $years * 365*60*60*24  
                        //       - $months*30*60*60*24 - $days*60*60*24) 
                        //                                   / (60*60));  
                        // $minutes = floor(($diff - $years * 365*60*60*24  
                        //          - $months*30*60*60*24 - $days*60*60*24  
                        //                           - $hours*60*60)/ 60);  
                        // $seconds = floor(($diff - $years * 365*60*60*24  
                        //          - $months*30*60*60*24 - $days*60*60*24 
                        //                 - $hours*60*60 - $minutes*60)); 
                        // if($date1>$effective_date1 && $date1< $expiry_date1)
                        //     {
                        //     $i = 1;
                        //     foreach ($rowsells as $rowsell) 
                        //     {
                        //         $reservedCount=$rowsell["reserved_count"];
                        //         $soldCount=$rowsell["sold_count"];
                        //         $totalCount=$rowsell["total_count"];
                        //         $Start_dynamin_price=$rowsell["Start_dynamin_price"];
                        //         $Projcurr=$row["currency"];
                        //         if($totalCount=='' ||$totalCount=='0' || $totalCount==null)
                        //         {
                        //             $totalCount=1;
                        //         }
                        //         if($Currency==$Projcurr)
                        //           {
                        //               $Xrate=1;
                        //           }
                        //           else
                        //           {
                        //               $Xraterows = \Property\PropertyClass::GetCurrExrate($Projcurr,$Currency);
                        //               $j = 1;
                        //               foreach ($Xraterows as $Xraterow) 
                        //               {
                        //                   $Xrate=$Xraterow["RATE"];
                        //               }
                        //           }
                        //           if($Xrate=="" || $Xrate==null){
                        //               $Xrate=1;
                           //       }
                            //}?>
                 <!--<tr>-->
                 <!--   <td align="center">-->
                 <!--       <a href="<?php echo SITE_BASE_URL;?>Property/Projects.html?project_id=<?php //echo $row["PROJECT_ID"]; ?>">-->
                 <!--           <img src="<?php echo SITE_BASE_URL;?>uploads/projectimage/<?php //echo $row["image_file"]; ?>"  class="img-thumbnail prop-thumb">-->
                 <!--       </a>-->
                 <!--  </td>-->
                 <!--   <td><?php //echo $Country;?></td>-->
                 <!--   <td><a class="text-muted" href="<?php echo SITE_BASE_URL;?>Property/ProjectView.html?project_id=<?php //echo $row["PROJECT_ID"];?>"><?php //echo $row["PROJECT_NAME"];?></a></td>-->
                 <!--   <td><?php //echo $days1." Days ";?></td>-->
                 <!--   <td><h4 class="price-heading"><?php //echo round($Start_dynamin_price*$Xrate);?> </h4></td>-->
                 <!--   <td>-->
                 <!--      <div class="progress progress-bar-striped progress-rounded box-shadow">-->
                 <!--         <div class="progress-bar progress-color <?php //if( $reservedCount==0) { ?> bg-info<?php  //}  ?>" style="width:<?php //if( $reservedCount==0) { ?>100<?php  //}  ?><?php //echo round(($reservedCount/$totalCount)*100,2);?>%;" role="progressbar"><?php //echo round(($reservedCount/$totalCount)*100,2);?>%</div>-->
                 <!--      </div>-->
                 <!--   </td>-->
                 <!--   <td>-->
                 <!--      <span class="label label-success">-->
                        <?php 
                          //if($totalCount==$soldCount){
                 ?>
                 <!--      Purchased-->
                       <?php //} 
                          //elseif($totalCount==$reservedCount){?>
                 <!--      Reserved -->
                       <?php 
                       //}
                 //         else{
                              //echo 'Available';
                         //}?>
                 <!--      </span>-->
                 <!--   </td>-->
                 <!--   <td>-->
                 <!--       <a class="btn btn-warning btn-sm" href="<?php //echo SITE_BASE_URL;?>Property/ProjectView.html?project_id=<?php //echo $row["PROJECT_ID"];?>"><i class="fa fa-link"></i>Take Action</a>-->
                 <!--   </td>-->
                 <!--</tr>-->
                 <?php// }
                    ?>   
                 <?php //} ?>   
<!--              </tbody>-->
<!--           </table>-->
<!--        </div>-->
<!--     </div>-->
<!--</div>-->


<div class="card" style='display:none'>
   <div class="card-body">
      <h4 class="card-title">My favourite</h4>
      <div class="table-responsive">
         <table class="table verticle-middle table-property">
            <thead>
               <tr>
                  <th>Property Image</th>
                  <th>Location</th>
                  <th>Project Name</th>
                  <th>Current Price</th>
                  <th>Time left</th>
                  <th>Reserved</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td><img src="assets/img/placeholder-img.png" class="img-thumbnail prop-thumb"></td>
                  <td>NZ</td>
                  <td><a class="text-muted" href="https://duvalknowledge.com/PropTech/Property/ProjectView.html?project_id=1">Avenue Apartments</a></td>
                  <td><h4 class="price-heading">$ 720000 <ion-icon name="trending-up-sharp"></ion-icon></h4></td>
                  <td>27 Days </td>
                  
                  <td>
                     <div class="progress progress-bar-striped progress-rounded box-shadow">
                        <div class="progress-bar progress-color " style="width: 50%; background-color: rgb(255, 0, 0);" role="progressbar">50%</div>
                     </div>
                  </td>
                  <td>
                     <span class="label label-success">
                     Available                           </span>
                  </td>
                  <td><div class="btn-group" role="group" aria-label="Basic example">

  <a class="btn btn-warning btn-sm" href="https://duvalknowledge.com/PropTech/Property/ProjectView.html?project_id=3"><i class="fa fa-link"></i>Take Action</a> <button class="btn btn-sm btn-close" data-toggle="tooltip" data-placement="top" title="Remove From Favourite"><i class="icofont-close"></i></button>
</div></td>
               </tr>

               <tr>
                  <td><img src="assets/img/placeholder-img.png" class="img-thumbnail prop-thumb"></td>
                  <td>NZ</td>
                  <td><a class="text-muted" href="https://duvalknowledge.com/PropTech/Property/ProjectView.html?project_id=2">McKenzie Terraces</a></td>
                  <td><h4 class="price-heading">$ 720000 <ion-icon name="trending-up-sharp"></ion-icon></h4></td>
                  <td>27 Days </td>
                  
                  <td>
                     <div class="progress progress-bar-striped progress-rounded box-shadow">
                        <div class="progress-bar progress-color " style="width: 14.29%; background-color: rgb(255, 0, 0);" role="progressbar">14.29%</div>
                     </div>
                  </td>
                  <td>
                     <span class="label label-success">
                     Available                           </span>
                  </td>
                  <td><div class="btn-group" role="group" aria-label="Basic example">

  <a class="btn btn-warning btn-sm" href="https://duvalknowledge.com/PropTech/Property/ProjectView.html?project_id=3"><i class="fa fa-link"></i>Take Action</a> <button class="btn btn-sm btn-close" data-toggle="tooltip" data-placement="top" title="Remove From Favourite"><i class="icofont-close"></i></button>
</div></td>
               </tr>
                  
                  <tr>
                     <td><img src="assets/img/placeholder-img.png" class="img-thumbnail prop-thumb"></td>
                  <td>NZ</td>
                  <td><a class="text-muted" href="https://duvalknowledge.com/PropTech/Property/ProjectView.html?project_id=3">Verge Apartments</a></td>
                  <td><h4 class="price-heading">$ 720000 <ion-icon name="trending-up-sharp"></ion-icon></h4></td>
                  <td>27 Days </td>
                  
                  <td>
                     <div class="progress progress-bar-striped progress-rounded box-shadow">
                        <div class="progress-bar progress-color  bg-info" style="width: 1000%; background-color: rgb(255, 0, 0);" role="progressbar">0%</div>
                     </div>
                  </td>
                  <td>
                     <span class="label label-success">
                        Available
                     </span>
                  </td>
                  <td><div class="btn-group" role="group" aria-label="Basic example">

  <a class="btn btn-warning btn-sm" href="https://duvalknowledge.com/PropTech/Property/ProjectView.html?project_id=3"><i class="fa fa-link"></i>Take Action</a> <button class="btn btn-sm btn-close" data-toggle="tooltip" data-placement="top" title="Remove From Favourite"><i class="icofont-close"></i></button>
</div></td>
               </tr>
                  
                  
                  
            </tbody>
         </table>
      </div>
   </div>
</div>






<?php include"footer.php"; ?>



