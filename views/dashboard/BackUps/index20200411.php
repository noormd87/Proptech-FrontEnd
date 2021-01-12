<?php include"header.php"; 
   \login\loginClass::Init();
   $rows = \login\loginClass::GetUserFullName();
   $i = 1;
   foreach ($rows as $row) 
   {
       $LoginFirstName=$row["first_name"];
       $LoginLastName=$row["last_name"];
       $LoginUserId=$row["user_id"];
   }
   ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL; ?>assets/plugins/flexslider/css/flexslider.min.css">
<?php
   $id= \settings\session\sessionClass::GetSessionUserName();
   \Dashboard\DashboardClass::Init();
   $Pointrows = \Dashboard\DashboardClass::GetPointsDatas($id);
   $i = 1;
   foreach ($Pointrows as $Pointrow) 
   {
      $points=$Pointrow["points"];
   }
   $Goldrows = \Dashboard\DashboardClass::GetPointsStructure('GOLD');
   foreach ($Goldrows as $Goldrow) 
   {
      $GoldPoint=$Goldrow["points"];
   }
   $Diamondrows = \Dashboard\DashboardClass::GetPointsStructure('DIAMOND');
   foreach ($Diamondrows as $Diamondrow) 
   {
      $DiamondPoint=$Diamondrow["points"];
   }
   if(($points)>($DiamondPoint))
   {
      $Diamond=100;
      $Gold=100;
   }
   elseif($points>$GoldPoint)
   {
      
      $Gold=100;
      $Diamond=round(($points/$DiamondPoint)*100);
      
   }
   else
   {
      $Gold=round(($points/$GoldPoint)*100);
      $Diamond=round(($points/$DiamondPoint)*100);
   }
   
   ?>
<div class="row">
   <div class="col-12 col-xl-4">
      <div class="card h-100 mb-0">
         <div class="card-body">
            <h4 class="card-title">Qualify Status Points</h4>
            <div class="deals">
               <img src="<?php echo SITE_BASE_URL;?>assets/img/deals.png" class="img-fluid">
               <div class="deals-heading">
                  <h1>DEALS</h1>
               </div>
            </div>
            <div class="mt-3">
               <div class="deals-progress">
                  <div class="progress m-t-20">
                     <div class="progress-bar bg-warning" style="width: <?php echo $Diamond;?>%; height:15px;" role="progressbar"><?php echo $Diamond;?>%</div>
                  </div>
                  <span>To upgrade to DIAMOND</span>
               </div>
               <div class="deals-progress">
                  <div class="progress m-t-20">
                     <div class="progress-bar bg-primary" style="width: <?php echo $Gold;?>%; height:15px;" role="progressbar"><?php echo $Gold;?>%</div>
                  </div>
                  <span>My Portfolio</span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-12 col-lg-8">
      <div class="card h-100">
         <div class="card-body">
            <h4 class="card-title">Trending Now</h4>
            <div class="table-responsive">
               <table class="table verticle-middle">
                  <thead>
                     <tr>
                        <!-- <th scope="col">Project Id</th> -->
                        <th scope="col">Location</th>
                        <th scope="col">Project Name</th>
                        <th scope="col">Time left</th>
                        <th scope="col">Reserved</th>
                        <!-- <th scope="col">Description</th> -->
                        <!--<th scope="col">Apartment no</th>-->
                        <!--<th scope="col">Unit no</th>-->
                        <!--<th scope="col">Level</th>-->
                        <!--<th scope="col">Market Price</th>-->
                        <!--<th scope="col">Lock-in Price</th>-->
                        <!--<th scope="col">Trending Price</th>-->
                        <!--<th scope="col">Lock-in(-)Trending Price</th>-->
                        <!--<th scope="col">Settle/Exchange Price</th>-->
                        <!--<th scope="col">Sold Progress</th>-->
                        <!--<th scope="col">Sold Label</th>-->
                        <!-- <th scope="col">Reserved Progress</th>
                           <th scope="col">Reserved Label</th> -->
                        <th scope="col">Status</th>
                        <th>Action</th>
                        <!-- <th scope="col">Action</th> -->
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        //$cond.=" AND pj.project_id=3";
                        $rows = \Property\PropertyClass::GetPorjectDatas('','');
                        $i = 1;
                        foreach ($rows as $row) 
                        { 
                            $rowsells = \Property\PropertyClass::ProjectSellingDtl($row["PROJECT_ID"]);
                            $effective_date=$row["effective_date"];
                            $Country=$row["country_name"];
                            $expiry_date=$row["expiry_date"];
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
                            $hours = floor(($diff - $years * 365*60*60*24  
                                   - $months*30*60*60*24 - $days*60*60*24) 
                                                               / (60*60));  
                            $minutes = floor(($diff - $years * 365*60*60*24  
                                     - $months*30*60*60*24 - $days*60*60*24  
                                                      - $hours*60*60)/ 60);  
                            $seconds = floor(($diff - $years * 365*60*60*24  
                                     - $months*30*60*60*24 - $days*60*60*24 
                                            - $hours*60*60 - $minutes*60)); 
                            if($date1>$effective_date1 && $date1< $expiry_date1)
                                {
                                $i = 1;
                                foreach ($rowsells as $rowsell) 
                                {
                                    $reservedCount=$rowsell["reserved_count"];
                                    $soldCount=$rowsell["sold_count"];
                                    $totalCount=$rowsell["total_count"];
                                    if($totalCount=='' ||$totalCount=='0' || $totalCount==null)
                                    {
                                        $totalCount=1;
                                    }
                                }?>
                     <tr>
                        <td><?php echo $Country;?></td>
                        <td><a class="text-muted" href="<?php echo SITE_BASE_URL;?>Property/ProjectView.html?project_id=<?php echo $row["PROJECT_ID"];?>"><?php echo $row["PROJECT_NAME"];?></a></td>
                        <td><?php echo $days." Days ";?></td>
                        <!--<td><?php //echo $row["apartment_no"];?></td>-->
                        <!--<td><?php //echo $row["unit_no"];?></td>-->
                        <!--<td><?php //echo $row["level"];?></td>-->
                        <!--<td><?php //echo $row["rate"];?></td>-->
                        <!--<td>-->
                        <?php 
                           //if($row["reserved_by"]!='' && $row["reserved_by"]!=null){?>
                        <?php //echo $row["lockin_rate"];?>
                        <?php //}?>
                        <!--</td>-->
                        <!--<td><?php //echo $row["dynamic_rate"];?></td>-->
                        <!--<td>-->
                        <?php 
                           //if($row["reserved_by"]!='' && $row["reserved_by"]!=null){?>
                        <?php //echo $row["lockin_rate"]-$row["dynamic_rate"];?>
                        <?php// }?>
                        <!--</td>-->
                        <!--<td><?php //echo $row["dpo_rate"];?></td>-->
                        <!--<td>-->
                        <!--    <div class="progress progress-xs">-->
                        <!--        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25" role="progressbar" class="progress-bar bg-primary w-<?php //echo round(($soldCount/$totalCount)*100);?>pc"></div>-->
                        <!--    </div>-->
                        <!--</td>-->
                        <!--<td>-->
                        <!--    <span class="label label-primary"><?php //echo round(($soldCount/$totalCount)*100,2);?>%</span>-->
                        <!--</td>-->
                        <td>
                           <div class="progress progress-bar-striped progress-rounded box-shadow">
                              <div class="progress-bar progress-color <?php if( $reservedCount==0) { ?> bg-info<?php  }  ?>" style="width:<?php if( $reservedCount==0) { ?>100<?php  }  ?><?php echo round(($reservedCount/$totalCount)*100,2);?>%;" role="progressbar"><?php echo round(($reservedCount/$totalCount)*100,2);?>%</div>
                           </div>
                        </td>
                        <!-- <td>
                           <div class="progress progress-xs">
                               <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25" role="progressbar" class="progress-bar bg-danger w-<?php //echo round(($reservedCount/$totalCount)*100);?>pc"></div>
                           </div>
                           </td>
                           <td>
                           <span class="label label-danger"><?php //echo round(($reservedCount/$totalCount)*100,2);?>%</span>
                           </td> -->
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
                        <td><a class="btn btn-warning btn-sm" href="<?php echo SITE_BASE_URL;?>Property/ProjectView.html?project_id=<?php echo $row["PROJECT_ID"];?>"><i class="fa fa-link"></i>Take Action</a></td>
                        <!-- <td>
                           <span>
                               <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Analyse in full">
                                   <img src="<?php //echo SITE_BASE_URL ?>assets/img/research.svg" class="img-fluid" width="32px">
                               </a>
                               <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Reserve">
                                   <i class="fa fa-close color-danger"></i>
                               </a>
                           </span>
                           </td> -->
                     </tr>
                     <?php }
                        ?>   
                     <?php } ?>   
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <!-- <div class="col-12 col-xl-4">
      <div class="card h-100 mb-0">
          <div class="p-3">
              <div class="float-right">
                  <a href="<?php echo SITE_BASE_URL;?>login/MyAccount.html" class="btn btn-success btn-sm mt-3">View Profile</a>
              </div>
              <div class="image mr-3  float-left">
                   <img src="<?php echo SITE_BASE_URL;?>uploads/ProfilePic/<?php echo $ProfilePic;?>" alt="" class="rounded-circle" width="100px" height="100px">
              </div>
              <div>
                  <h6 class="pt-4"><?php echo $LoginFirstName;?> <?php echo $LoginLastName;?></h6>
                  <?php echo $LoginUserId;?>
              </div>
          </div>
          <ul class="list-group list-group-flush">
              <li class="list-group-item">
                  <i class="icon-home"></i> Home
              </li>
              <li class="list-group-item">
                  <i class="icon-envelope"></i> Messages
                  <span class="badge badge-primary float-right r-3">3</span>
              </li>
              <li class="list-group-item">
                  <i class="icon-user"></i> Profile
              </li>
              <li class="list-group-item">
                  <i class="icon-settings"></i> Settings
              </li>
          </ul>
      </div>
      </div> -->
</div>
<!-- status points progress bar -->
<div class="row">
   <div class="col-lg-8 mt-30">
      <div class="card">
         <div class="card-body">
            <h4>Your Reserved Property</h4>
            <!-- <div class="table-wrapper table-responsive">
               <div class="table">
                 <thead class='bg-b1'>
                    <table>
                         <tr>
                           <th>BUILDING</th>
                           <th>APT NO</th>
                           <th>LEVEL</th>
                           <th>LOCK-IN PRICE($)</th>
                           <th>CURRENT PRICE($)</th>
                           <th>DISCOUNT($)</th>
                           <th>DEAL PRICE($)</th>
                           <th>TIME LEFT TO DEAL($)</th>
                         </tr>
                       </thead>
                       <tbody> -->
            <?php
               $cond1.=" and pd.reserved_by='".$LoginUserId."' ";
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
                      $Country=$row["country_name"];
                      $expiry_date=$row["expiry_date"];
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
                      $hours = floor(($diff - $years * 365*60*60*24  
                             - $months*30*60*60*24 - $days*60*60*24) 
                                                         / (60*60));  
                      $minutes = floor(($diff - $years * 365*60*60*24  
                               - $months*30*60*60*24 - $days*60*60*24  
                                                - $hours*60*60)/ 60);  
                      $seconds = floor(($diff - $years * 365*60*60*24  
                               - $months*30*60*60*24 - $days*60*60*24 
                                      - $hours*60*60 - $minutes*60)); 
               ?>
            <div class="row justify-content-between">
               <div class="col-lg-2 col-md-2 col-sm-12 col-12 border-right-1 align-self-center">
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
               <div class="col-lg-4 col-md-4 col-sm-12 col-12 border-right-1 align-self-center">
                  <div class="properties-details-wrapper">
                     <div class="properties-details-inner">
                        <h5 class="project-name"><?php echo $projectName;?></h5>
                        <p class="project-location"><?php echo $country;?></p>
                        <div class="prop-details">
                           <div class="d-flex justify-content-between ">
                              <div class="bg-primary prop-detail-list"><?php echo $row1["no_of_bedrooms"];?> <i class="fa fa-bed"></i></div>
                              <div class="bg-warning prop-detail-list"><?php echo $row1["no_of_bathroom"];?> <i class="fa fa-shower"></i></div>
                              <div class="bg-info prop-detail-list"><?php echo $row1["no_of_parkingspace"];?> <i class="fa fa-car"></i></div>
                           </div>
                        </div>
                        <div class="dashboard-timer">
                           <h5 class="alt-1"><?php echo $days;?> days <?php echo $hours;?>h<?php echo $minutes;?>m<?php echo $seconds;?>s</h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-12 col-12 border-right-1 align-self-center">
                  <div class="property-price-list">
                     <div class="prop-price-list-inner">
                        <p>Current Price<br><span class="price text-dark"><s>$<?php echo round($row1["dynamic_rate"],2);?></s></span> <img src="<?php echo SITE_BASE_URL; ?>assets/img/icon/price-drop-dark.png" class="img-fluid"></p>
                        <hr>
                        <p>Discount<br><span class="price text-success">$<?php echo round($row1["lockin_rate"]-$row1["dynamic_rate"],2);?></span> <img src="<?php echo SITE_BASE_URL; ?>assets/img/icon/decrease-graph.png" class="img-fluid"></p>
                        <hr>
                        <p>Deal Price<br><span class="price text-warning">$<?php echo round($row1["dpo_rate"],2);?></span> <img src="<?php echo SITE_BASE_URL; ?>assets/img/icon/decrease-graph.png" class="img-fluid"></p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-12 col-12 align-self-center">
                  <div class="property-price-list">
                     <div class="prop-price-list-inner">
                        <p class="mb-1">Lock-In Price<br><span class="price text-primary">$<?php echo round($row1["lockin_rate"],2);?></span> <img src="<?php echo SITE_BASE_URL; ?>assets/img/icon/price-drop-dark.png" class="img-fluid"></p>
                     </div>
                  </div>
                  <div class="action-btn-group mt-2">
                     <!--<a <?php if($row["reserved_by"]!="" &&$row["reserved_by"]!=null){?>disabled<?php } ?> class="btn btn-rounded btn-sm btn-warning btn-block" href="<?php echo SITE_BASE_URL; ?>Property/Reserve.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $project_id; ?>" nowrap>Reserve</a>-->
                     <!--<br>-->
                     <a class="btn btn-rounded btn-sm btn-primary btn-block" href="<?php echo SITE_BASE_URL; ?>Property/PropertyFullDtl.html?id=<?php echo $row1["property_id"]; ?>" nowrap>ANALYSE</a>
                  </div>
               </div>
            </div>
            <hr>
            <!-- <tr>
               <td><?php //echo $row1["building"];?></td>
               <td><?php //echo $row1["apartment_no"];?></td>
               <td><?php //echo $row1["level"];?></td>
               <td><span class="bg-success"><?php //echo $row1["lockin_rate"];?></span></td>
               <td><?php //echo $row1["dynamic_rate"];?></td>
               <td> <?php //echo $row1["lockin_rate"]-$row1["dynamic_rate"];?></td>
               <td><?php //echo $row1["dpo_rate"];?></td>
               <th><?php //echo $days." Days";?></th>
               </tr> -->
            <?php
               $j=$j+1;
               }
               if($j==1)
               {
                   //echo "<tr><td align=center colspan=8><b>No Records</b></td></tr>";
               }
               ?>
            <!-- </tbody>
               </table> -->
            <!-- </div>
               </div> -->
         </div>
      </div>
      <div class="posts posts--cards post-grid row" >
         <div class="post-grid__item col-sm-6 col-md-12"  >
            <div class="posts__item posts__item--card posts__item--category-1 card" >
               
               <div class="custom-scrollbar">
                   <?php
                  \Dashboard\DashboardClass::Init();
                  $NewsFeedrows = \Dashboard\DashboardClass::GetNewsFeed($CountryCode);
                  $i = 1;
                  foreach ($NewsFeedrows as $NewsFeedrow) 
                  {
                    echo  '
        			    <figure class="posts__thumb">
                          <div class="posts__cat"><span class="label posts__cat-label">Business</span></div>
                          <a href="'.$NewsFeedrow["url"].'" target=blank><img src="'.$NewsFeedrow["urlToImage"].'" alt=""></a>
                       </figure>
        			    <div class="posts__inner card__content">
                          <a  href="'.$NewsFeedrow["url"].'" target=blank class="posts__cta"></a> <span datetime="2016-08-23" class="posts__date">'.$publishedAt.'</span>
                          <h6 class="posts__title"><a href="'.$NewsFeedrow["url"].'" target=blank>'.$NewsFeedrow["title"].'</a></h6>
                          <div class="posts__excerpt">'.$NewsFeedrow["description"].'<br>'.$NewsFeedrow["content"].'</div>
                       </div>
                       <footer class="posts__footer card__footer">
                          <div class="post-author">
                             <figure class="post-author__avatar"><img src="'.SITE_BASE_URL.'assets/img/avatar/4.jpg" alt="Post Author Avatar"></figure>
                             <div class="post-author__info">
                                <h4 class="post-author__name">'.$NewsFeedrow["author"].'</h4>
                             </div>
                          </div>
                          <ul class="post__meta meta">
                             <li class="meta__item meta__item--views">2369</li>
                             <li class="meta__item meta__item--likes"><a href="#"><i class="meta-like icon-heart"></i> 530</a></li>
                             <li class="meta__item meta__item--comments"><a href="#">18</a></li>
                          </ul>
                       </footer>
                       ';
                  
                  }
                    //echo \api\apiClass::GetNewsFeedApiDatas($CountryCode); 
                    ?>
               </div>
            </div>
         </div>
         <!-- <div class="col-sm-6">
            <div class="card">
               <div class="card__content">
                  <ul class="posts posts--simple-list posts--simple-list--lg">
                     <li class="posts__item posts__item--category-1">
                        <div class="posts__inner">
                           <div class="posts__cat"><span class="label posts__cat-label">The Team</span></div>
                           <h6 class="posts__title"><a href="#">Trainings are getting really hard reaching the final</a></h6>
                           <span datetime="2017-08-23" class="posts__date">August 23rd, 2018</span>
                           <div class="posts__excerpt">Lorem ipsum dolor sit amet, consectetur adipisi ng elit, sed do eiusmod tempor incididunt ut labore...</div>
                        </div>
                     </li>
                     <li class="posts__item posts__item--category-3">
                        <div class="posts__inner">
                           <div class="posts__cat"><span class="label posts__cat-label">Playoffs</span></div>
                           <h6 class="posts__title"><a href="#">The victory againts The Sharks brings us closer to the Final</a></h6>
                           <span datetime="2017-08-23" class="posts__date">February 2nd, 2018</span>
                           <div class="posts__excerpt">Lorem ipsum dolor sit amet, consectetur adipisi ng elit, sed do eiusmod tempor incididunt ut labore...</div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div> -->
          <div class="col-12 mt-30">
         <div class="card">
            <div class="card-body">
              <h4 class="card-title">Currencies - Base Currency(EUR)</h4>
              
              <div id="market-cap" class="table-responsive">
                  <table class="table mb-0 table-responsive-tiny">
                      <thead>
                          <tr>
                              <th>Currency</th>
                              <th>Exchange Rate</th>
                              <!--<th>Change</th>-->
                              <!--<th>Net Change</th>-->
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                              \login\loginClass::Init();
                               $Countryrows = \Masters\MastersClass::GetExchangeRate('EUR');
                               $i = 1;
                               foreach ($Countryrows as $Countryrow) 
                               {
                                   $RATE=$Countryrow["RATE"];
                                   $Currencies=$Countryrow["currency"];
                                    if($Currencies!='EUR'){
                                    ?>
                                    <tr>
                                        <td><strong><?php echo $Currencies;?></strong></td>
                                        <td><?php echo $RATE;?></td>
                                    </tr>  
                                    <?php 
                                   }
                               }
                               ?>
                             
                          <!--<tr>-->
                          <!--    <td><strong>NZD</strong></td>-->
                          <!--    <td>$12,623.40</td>-->
                          <!--    <td>$12,623.40</td>-->
                          <!--    <td class="change">-->
                          <!--        <i class="fa fa-angle-up"></i>-->
                          <!--        <span>+6.50%</span>-->
                          <!--    </td>-->
                          <!--</tr>-->
                          <!--<tr>-->
                          <!--    <td><strong>EUR</strong></td>-->
                          <!--    <td>$12,623.40</td>-->
                          <!--    <td>$12,623.40</td>-->
                          <!--    <td class="change">-->
                          <!--        <i class="fa fa-angle-up"></i>-->
                          <!--        <span>+6.50%</span>-->
                          <!--    </td>-->
                          <!--</tr>-->
                          <!--<tr>-->
                          <!--    <td><strong>GBP</strong></td>-->
                          <!--    <td>$12,623.40</td>-->
                          <!--    <td>$12,623.40</td>-->
                          <!--    <td class="change">-->
                          <!--        <i class="fa fa-angle-up"></i>-->
                          <!--        <span>+6.50%</span>-->
                          <!--    </td>-->
                          <!--</tr>-->
                          <!--<tr>-->
                          <!--    <td><strong> KYD</strong></td>-->
                          <!--    <td>$12,623.40</td>-->
                          <!--    <td>$12,623.40</td>-->
                          <!--    <td class="change">-->
                          <!--        <i class="fa fa-angle-up"></i>-->
                          <!--        <span>+6.50%</span>-->
                          <!--    </td>-->
                          <!--</tr>-->
                      </tbody>
                  </table>
                  <a href="#" class="btn btn-sm btn-outline-dark mt-2">VIEW ALL CURRENCIES <i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
          </div>
       </div>
      </div>
   </div>
   <div class="col-lg-4 h-100 mt-30">
      <div class="row no-gutters">
         <div class="col-4 mb-30 px-1">
            <div class="card h-100 mb-0">
               <div class="p-2">
                  <div class="white text-center">
                     <h6 class="mb-2">Project Settled</h6>
                     <img src="<?php echo SITE_BASE_URL ?>assets/img/icon/profit.png" class="img-fluid" width="56px">
                     <div class="mt-2"><span class="badge badge-success r-30">10</span></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-4 mb-30 px-1">
            <div class="card h-100 mb-0">
               <div class="p-2">
                  <div class="white text-center">
                     <h6 class="mb-2">Properties Available</h6>
                     <img src="<?php echo SITE_BASE_URL ?>assets/img/icon/property.png" class="img-fluid" width="56px">
                     <div class="mt-2"><span class="badge badge-success r-30"><?php echo $points;?></span></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-4 mb-30 px-1">
            <div class="card h-100 mb-0">
               <div class="p-2">
                  <div class="white text-center">
                     <h6 class="mb-2">Hurry</h6>
                     <img src="<?php echo SITE_BASE_URL ?>assets/img/icon/graph.png" class="img-fluid" width="56px">
                     <div class="mt-2"><span class="badge badge-danger r-30">5</span></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="card">
         <div class="card-body">
            <div class="">
               <div class="bg-white pull-left">
                  <h4 class="card-title text-uppercase">Referred Friends</h4>
               </div>
               <div class="pull-right avatar-group">
                  <span class="avatar">
                  <img src="<?php echo SITE_BASE_URL;?>assets/img/avatar/1.jpg" class="rounded-circle w-35px" alt="">
                  </span>
                  <span class="avatar">
                  <img src="<?php echo SITE_BASE_URL;?>assets/img/avatar/2.jpg" class="rounded-circle w-35px" alt="">
                  </span>
                  <span class="avatar">
                  <img src="<?php echo SITE_BASE_URL;?>assets/img/avatar/3.jpg" class="rounded-circle w-35px" alt="">
                  </span>
                  <span class="avatar">
                  <img src="<?php echo SITE_BASE_URL;?>assets/img/avatar/4.jpg" class="rounded-circle w-35px" alt="">
                  </span>
                  <span class="avatar">
                  <img src="<?php echo SITE_BASE_URL;?>assets/img/avatar/5.jpg" class="rounded-circle w-35px" alt="">
                  </span>
                  <a href="#" class="btn btn-xs btn-primary btn-rounded">+ more</a>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="mt-3">
               <div class="table-responsive">
                  <table class="table table-xs mb-0">
                     <thead>
                        <tr>
                           <th>Name</th>
                           <th>Point Earned</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $id= \settings\session\sessionClass::GetSessionUserName();
                           \login\loginClass::Init();
                           $rows = \login\loginClass::GetReferredFriends($id);
                           $i = 1;
                           foreach ($rows as $row) 
                           {
                              $Users=$row["first_name"];
                              $points=$row["points"];
                              $Image=$row["image_file"];
                              if($Image=='' || $Image==null)
                              {
                                  $Image='NoProfile.jpg';
                              }
                           ?>   
                        <tr>
                           <td align="center">
                              <img src="<?php echo SITE_BASE_URL;?>uploads/ProfilePic/<?php echo $Image; ?>" class="rounded-circle" width=50px height=50px><br><?php echo $Users;?>
                           </td>
                           <td><?php echo $points;?></td>
                           <td>56952</td>
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
      <div class="card mb-0">
         <div class="card-body">
            <div class="text-center">
               <img src="<?php echo SITE_BASE_URL;?>assets/img/avatar/kenyon.jpg" class="rounded-circle media-thumb" alt="">
               <h4 class="m-t-15 m-b-2">KENYON</h4>
               <p class="text-muted"> CEO</p>
               <p class="p-l-30 p-r-30">New apartments not for sale Developer Kenyon Clarke
               </p>
               <ul class="list-inline">
                  <li class="list-inline-item">
                     <a href="#">
                     <img src="<?php echo SITE_BASE_URL;?>assets/img/icon/insta-dark.png" class="img-fluid" width="22px">
                     </a>
                  </li>
                  <li class="list-inline-item">
                     <a href="#">
                     <img src="<?php echo SITE_BASE_URL;?>assets/img/icon/fb-dark.png" class="img-fluid" width="22px">
                     </a>
                  </li>
                  <li class="list-inline-item">
                     <a href="#">
                     <img src="<?php echo SITE_BASE_URL;?>assets/img/icon/youtube-dark.png" class="img-fluid" width="22px">
                     </a>
                  </li>
                  <li class="list-inline-item">
                     <a href="#">
                     <img src="<?php echo SITE_BASE_URL;?>assets/img/icon/linkedin-dark.png" class="img-fluid" width="22px">
                     </a>
                  </li>
               </ul>
               <a href="#" class="btn btn-sm btn-primary btn-block m-t-15">READ THE STORY</a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end status points progress bar -->

<!-- Place somewhere in the <body> of your page -->
<div class="flexslider carousel project-slider">
  <ul class="slides">
    <?php
      \Dashboard\DashboardClass::Init();
      $rows = \Dashboard\DashboardClass::GetProjectDatas();
      $i = 1;
      foreach ($rows as $row) 
      {
      ?>
    <li>
      <div class="card h-100 mb-0">
         <a href="<?php echo SITE_BASE_URL;?>Property/Projects.html?country=<?php echo $row["country"]; ?>&project_id=<?php echo $row["project_id"]; ?>">
            <img src="<?php echo SITE_BASE_URL;?>uploads/projectimage/<?php echo $row["image_file"]; ?>" class="img-fluid" alt="">
            <div class="card-body">
               <h5 class="m-b-0"><?php echo $row["project_name"]; ?></h5>
               <div>
                  <span class="f-s-12 text-dark"><?php echo $row["project_description"]; ?></span>
               </div>
            </div>
         </a>
      </div>
    </li>
    <?php
      }
      ?>
      <!-- <li>
      <div class="card h-100 mb-0">
         <a href="property-details.php">
            <img src="<?php //echo SITE_BASE_URL; ?>assets/img/verge_prop_img_001.jpg" class="img-fluid" alt="">
            <div class="card-body">
               <h5 class="m-b-0">Verge Apartments</h5>
               <div>
                  <span class="f-s-12 text-dark">59 stunning apartments from only $649,000</span>
               </div>
            </div>
         </a>
      </div>
    </li> -->
    <!-- items mirrored twice, total of 12 -->
  </ul>
</div>

<!-- properties cards -->
<!-- <div class="row"> -->
   <?php
      // \Dashboard\DashboardClass::Init();
      // $rows = \Dashboard\DashboardClass::GetProjectDatas();
      // $i = 1;
      // foreach ($rows as $row) 
      // {
      ?>
   <!-- <div class="col-lg-4 no-card-border mt-30">
      <div class="card h-100 mb-0">
         <a href="<?php echo SITE_BASE_URL;?>Property/Projects.html?country=<?php echo $row["country"]; ?>&project_id=<?php echo $row["project_id"]; ?>">
            <img src="<?php echo SITE_BASE_URL;?>uploads/projectimage/<?php echo $row["image_file"]; ?>" class="img-fluid" alt="">
            <div class="card-body">
               <h5 class="m-b-0"><?php echo $row["project_name"]; ?></h5>
               <div>
                  <span class="f-s-12 text-dark"><?php echo $row["project_description"]; ?></span>
               </div>
            </div>
         </a>
      </div>
   </div> -->
   <?php
      //}
      ?>
<!-- </div> -->
<!-- end properties card -->
<?php include"footer.php"; ?>
<script>
   // this function asigns color depending on value
   $(document).ready(function () {
   var value = ( 100 * parseFloat($('.progressbar').css('width')) / parseFloat($('.progressbar').parent().css('width')) ) ;
   
   console.log(value);
   if ( value > 99 ) {
     progressColor = "green";
   } else if (value > 33) {
     progressColor = "yellow";
   } else {
     progressColor = "red";
   }
   $( '.progress' ).find(".progress-color").css("background-color", progressColor);
   });
   
</script> 
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


<script type="text/javascript" src="<?php echo SITE_BASE_URL; ?>assets/plugins/flexslider/js/flexslider.min.js"></script>
<script type="text/javascript">
  // Can also be used with $(document).ready()
  $(document).ready(function() {
    $('.project-slider').flexslider({
      animation: "slide",
      animationLoop: false,
      itemWidth: 210,
      itemMargin: 30,
      minItems: 2,
      maxItems: 3,
      controlNav: false
    });
  });
</script>