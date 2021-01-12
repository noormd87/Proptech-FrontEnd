<?php include "header.php";
\login\loginClass::Init();
$rows = \login\loginClass::GetUserFullName();
$i = 1;
foreach ($rows as $row)
{
    $LoginFirstName = $row["first_name"];
    $LoginLastName = $row["last_name"];
    $LoginUserName = $row["user_id"];
    $LoginUserId = $row["id"];
    $ProfilePic = $row["image_file"];
}
$key = hash("sha256", $LoginUserName, false);
?>



        <script src="<?php echo SITE_BASE_URL; ?>assets/plugins/chartjs/Chart.bundle.js"></script>



          <div class="row no-gutters mb-3">

            <div class="col-lg-12 col-md-12 col-md-12 col-xl-8 pr-lg-3 mb-3">
      <div class="card h-100">
        <div class="card-header">
          <h4>Search Available Property</h4>
        </div>
        <div class="card-body">
            <form class="form-primary" name="frmSearch" id="frmSearch" method="post" action="<?php echo SITE_BASE_URL; ?>dashboard/index.html">
                             <div class="row">
                                  <div class="col-xl-2 col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                      <label for="">Country</label>
                                      <select name="CountryId" id="CountryId"  class="form-control">
                                        <option value="">Select</option>
                                        <?php
$Projectrows = \Masters\MastersClass::GetCountriesDatas();

foreach ($Projectrows as $Projectrow)

{

    $CountryId1 = $Projectrow["country_code"];

    $CountryName = $Projectrow["country_name"];

?>
                                        <option value="<?php echo $CountryId1; ?>" <?php if ($CountryId1 == $_REQUEST["CountryId"])
    { ?>SELECTED
                                           <?php
    } ?> >
                                           <?php echo $CountryName; ?>
                                        </option>
                                        <?php
}

?>
                                     </select>
                                    </div>
                                  </div>
                                  <div class="col-xl-2 col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                      <label for="">City</label>
                                      <input type="text" class="form-control" name="City" placeholder="City" value='<?php echo $_REQUEST["City"]; ?>'>
                                    </div>
                                  </div>
                                  <div class="col-xl-2 col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                      <label for="">Min Price</label>
                                      <input type="text" class="form-control" name="MinPrice" placeholder="Min Price range" value='<?php echo $_REQUEST["MinPrice"]; ?>'>
                                    </div>
                                  </div>
                                  <div class="col-xl-2 col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                      <label for="">Max Price</label>
                                      <input type="text" class="form-control" name="MaxPrice" placeholder="Max Price range" value='<?php echo $_REQUEST["MaxPrice"]; ?>'>
                                    </div>
                                  </div>
                                  <div class="col-xl-2 col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                      <label for="">Close in</label>
                                      <input type="number" class="form-control" name="NoOfDays" placeholder="No Of Days" value='<?php echo $_REQUEST["NoOfDays"]; ?>'>
                                    </div>
                                  </div>
                                  <div class="col-xl-2 col-lg-4 col-md-4 col-12 align-self-center">
                                    <div class="mt-3">
                                      <input class="btn btn-primary  SearchBtn" type="submit" name="SearchBtn" id="SearchBtn" value="search">
                                    </div>
                                  </div>
                                </div>
                           </form>
            </div>
        </div>
        </div>

            <div class="col-md-12 col-xl-4 p-r-3 mb-3">

                
    
              <div class="card h-100">


                <div class="card-header">
              <h4>Global Research Data</h4>
            </div>
                <div class="card-body">



                  <div class="navbar inline-card">



                    <ul class="nav"></ul>



                      <li>



                        <div class="img-card">

                           <a class="nav-link" href="<?php echo SITE_BASE_URL; ?>Property/PropertyInvestar.html?country=3">
                                <img src="assets/img/uk-round-flag.png" class="img-fluid" alt="" width="100px">
                                <p class="img-caption">United Kingdom</p>
                            </a>

                        </div>



                      </li>



                      <li>



                        <div class="img-card">



                           <a class="nav-link" href="<?php echo SITE_BASE_URL; ?>Property/PropertyInvestar.html?country=1">
                            <img src="assets/img/newzealand.png" class="img-fluid" alt="" width="100px">
                            <p class="img-caption">New Zealand</p>
                         </a>



                        </div>



                      </li>



                      <li>



                        <div class="img-card">



                          <a class="nav-link" href="<?php echo SITE_BASE_URL; ?>Property/PropertyInvestar.html?country=2">
                            <img src="assets/img/australia-round-flag.png" class="img-fluid" alt="" width="100px">
                            <p class="img-caption">Australia</p>
                         </a>



                        </div>



                      </li>



                    </ul>



                    <ul class="nav ml-auto">



                      <li class="pr-15">


                        <p class="mb-0 fs-12 fw-500">Coming Soon</p>    
                        <div class="img-card disable">



                          <img src="assets/img/usa-round-flag.png" class="img-fluid" alt="" width="100px">



                          <p class="img-caption">United States</p>



                        </div>



                      </li>



                    </ul>



                  </div>



                </div>



              </div>



            </div>



            <!-- <div class="col-md-6 m-b-3">



              <div class="card h-100 mb-0">



                <div class="card-header">



                  <h4>Video Guide</h4>



                </div>



                <div class="card-body">



                  <div class="">



                    <div class="row video-guide-list">



                      <div class="col-auto video-guide">



                        <a href="#" title=""><i class="icofont-ui-play"></i> Intro Video</a>



        



                      </div>



                      <div class="col-auto video-guide">



                        <a href="#" title=""><i class="icofont-ui-play"></i> Global Residential Data Video</a>



        



                      </div>



                      <div class="col-auto video-guide">



                        <a href="#" title=""><i class="icofont-ui-play"></i> Investment Analysis Video</a>



        



                      </div>



                      <div class="col-auto video-guide">



                        <a href="#" title=""><i class="icofont-ui-play"></i> My Portfolio Page</a>



        



                      </div>



                      <div class="col-auto video-guide">



                        <a href="#" title=""><i class="icofont-ui-play"></i> Refer A Friend Video</a>



        



                      </div>



                    </div>



                  </div>



                </div>



              </div>



            </div> -->



            <div class="col-lg-8 col-md-12 col-12 pr-md-3 pr-0 mb-3">



              <!-- Trending Property-->



              <div class="card ">



                <div class="card-header">
                  <h4>Available Now</h4>
                </div>
                  
                    <div class="card-body scroll-card">
                           
                         

                <?php

if ($_REQUEST["CountryId"] != "")
{
    $Condition .= " AND pj.country = '" . $_REQUEST["CountryId"] . "' ";
}
if ($_REQUEST["City"] != "")
{
    $Condition .= " AND UPPER(pj.subrub) like UPPER('%" . $_REQUEST["City"] . "%') ";
}

//echo $Condition;
$rows = \Property\PropertyClass::GetPorjectDatas('', '', $Condition);
//echo print_r($rows);
$i = 1;
foreach ($rows as $row)
{
    $rowsells = \Property\PropertyClass::ProjectSellingDtl($row["PROJECT_ID"]);
    $effective_date = $row["effective_date"];
    $CountryName = $row["country_name"];
    $CountryCodeNew = $row["Country_Code_New"];
    $expiry_date = $row["expiry_date"];
    $StarDynamic = $row["Start_dynamin_price"];
    //sahil code
    $createDate = new DateTime($expiry_date);
    $strip = $createDate->format('Y-m-d');
    //echo $strip;
    //end here
    $flag = "Y";
    $date = date("Y-m-d h:i:s");
    $effective_date1 = strtotime($effective_date);
    $expiry_date1 = strtotime($expiry_date);
    $date1 = strtotime($date);
    $diff = abs($expiry_date1 - $date1);
    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $days1 = floor(($diff - $years * 365 * 60 * 60 * 24) / (60 * 60 * 24));
    $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
    $minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
    $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));
    foreach ($rowsells as $rowsell)
    {
        $reservedCount = $rowsell["reserved_count"];
        $soldCount = $rowsell["sold_count"];
        $totalCount = $rowsell["total_count"];
        $AvailableCount = $totalCount - $reservedCount;
        $Start_dynamin_price = $rowsell["Start_dynamin_price"];
        $AVG_Discount = round($rowsell["AVG_Discount"]);
        $Projcurr = $row["currency"];

        if ($Currency == "NZD")
        {
            $Prefix = "NZ $";
        }
        elseif ($Currency == "AUD")
        {
            $Prefix = "AU $";
        }
        elseif ($Currency == "GBP")
        {
            $Prefix = "£";
        }
        else
        {
            $Prefix = $Currency . " ";
        }

        if ($totalCount == '' || $totalCount == '0' || $totalCount == null)
        {
            $totalCount = 1;
        }
        if ($Currency == $Projcurr)
        {
            $Xrate = 1;
        }
        else
        {
            $Xraterows = \Property\PropertyClass::GetCurrExrate($Projcurr, $Currency);
            //echo print_r($Xraterows);
            $j = 1;

            foreach ($Xraterows as $Xraterow)
            {
                $Xrate = $Xraterow["RATE"];
            }
        }
        if ($Xrate == "" || $Xrate == null)
        {
            $Xrate = 1;
        }
    }
    if ($_REQUEST["NoOfDays"] != "")
    {
        $NoOfday = $_REQUEST["NoOfDays"];
    }
    else
    {
        $NoOfday = 1000;
    }
    if ($_REQUEST["MinPrice"] != "")
    {
        if ($Start_dynamin_price < $_REQUEST["MinPrice"])
        {
            $flag = "N";
        }
    }
    if ($_REQUEST["MaxPrice"] != "")
    {
        if ($Start_dynamin_price > $_REQUEST["MaxPrice"])
        {
            $flag = "N";
        }
    }
    if ($date1 > $effective_date1 && $date1 < $expiry_date1 && $days1 <= $NoOfday && $flag == 'Y')
    {
?>



                  <!-- trending now properties-->



                    



                      <div class="trending-project mb-3">

                        <div class="trending-project-thumb">
                            <a class="image-expand" href="<?php echo SITE_BASE_URL;?>uploads/projectimage/<?php echo $row["image_file"]; ?>" >
                              <img src="<?php echo SITE_BASE_URL; ?>uploads/projectimage/<?php echo $row["image_file"]; ?>" alt="" class="img-fluid">
                            </a>
                        </div>

                        <div class="trending-project-details">

                           <div class="project-title">

                              <h4 class="float-left"><?php echo $row["PROJECT_NAME"] . '|' . $row["subrub"]; ?></h4>

                              <h4 class="float-right">|<?php echo $CountryName; ?></h4>

                              <div class="clearfix"></div>

                            </div>



                            <div class="row">

                                <div class="col-md-12 col-xl-9">

                                  <div class="project-details-inner">

                                      <div class="d-flex justify-content-start trend-row">

                                        <div class="ternding-first-col"><h4>Start Price</h4></div>

                                        <div class="ternding-last-col"><h4><?php echo $Prefix . " " . number_format(round($Start_dynamin_price * $Xrate, 2)); ?></h4></div>

                                      </div> 
                                      <div class="d-flex justify-content-start trend-row">

                                        <div class="ternding-first-col"><h4>Dynamic Price Discount%</h4></div>

                                        <div class="ternding-last-col"><h4><?php echo $AVG_Discount; ?></h4></div>

                                      </div> 

                                      <div class="d-flex justify-content-start trend-row">
                                      <div class="ternding-first-col"><h4>Reserved</h4></div>
                                      <div class="price-progressbar ternding-last-col">
                                        <p class="progress-label" style="width:<?php echo round(($reservedCount / $totalCount) * 100); ?>%" data-value="<?php echo round(($reservedCount / $totalCount) * 100); ?>"><?php echo $reservedCount; ?></p>
                                        <progress max="100" value="<?php echo round(($reservedCount / $totalCount) * 100); ?>" class="price-progress">
                                            <div class="progress-bar">
                                                <span style="width: <?php echo round(($reservedCount / $totalCount) * 100); ?>%"><?php $reservedCount ?></span>
                                            </div>
                                        </progress>
                                      </div>
                                    </div> 

                                    <div class="d-flex justify-content-start trend-row">

                                      <div class="ternding-first-col"><h4>Time Left</h4></div>

                                      <div class="timer-wrapper ternding-last-col">
                       
                                           
               
                                           <div data-countdown="<?php echo $strip ?>" class="count-skin"></div>

                                      </div>

                                    </div>

                                 </div>

                                </div>

                                <div class="col-md-12 col-xl-3">

                                  <div class="trending-project-action">

                                    <h4>Status</h4>
                                    <?php if ($AvailableCount > 0)
        { ?>
                                        <style>
                                        .status-list li.active:before{
                                          background-color: #6bea1b;  
                                        }
                                        </style>
                                    <?php
        } ?>
                                    <ul class="status-list">

                                      <li <?php if ($AvailableCount > 0)
        { ?>class="active" style='color:#6bea1b'<?php
        } ?> >Available</li>
                                      <li <?php if ($AvailableCount < 1)
        { ?>class="active"<?php
        } ?>>Not Available</li>

                                    </ul>

                                    <a href="<?php echo SITE_BASE_URL; ?>Property/ProjectView.html?project_id=<?php echo $row["PROJECT_ID"]; ?>" class="btn btn-action mt-4">More Info</a>

                                    </div> 

                                </div>

                            </div>

                        </div>

                      </div>



                    



                  <!-- end trending now properties-->



                  <script>



                  new Chart(document.getElementById("doughnut-chart<?php echo $i; ?>"), {



                    type: 'doughnut',



                    data: {



                      labels: ["Available", "Not Available"],



                      datasets: [



                        {



                          label: "Property Status)",



                          backgroundColor: ["#85BE1A", "#C70000"],



                          data: [<?php echo round(((intval($totalCount) - intval($reservedCount)) / $totalCount) * 100); ?>,<?php echo round(($reservedCount / $totalCount) * 100); ?>]



                        }



                      ]



                    },



                    responsive: true,



                    options: {



                      legend: {



                        display: false



                      },



                      title: {



                        display: false,



                        text: 'Property Status'



                      }



                    }



                });



                </script>



                  <?php
    }

    $i = $i + 1;

} ?>



              </div>



            </div>
          </div>



            <div class="col-lg-4 col-md-12 col-12 mb-3">



              <div class="card">



                <div class="card-header">



                  <h4 class="h4">News</h4>



                </div>



                <div class="card-body scroll-card">



                  <div class="post-grid">



                  <?php

\Dashboard\DashboardClass::Init();

$NewsFeedrows = \Dashboard\DashboardClass::GetNewsFeed($CountryCode);

$q = 1;

foreach ($NewsFeedrows as $NewsFeedrow)

{

    if ($q == 1)

    {

?>



                    <div class="top-post-thumb">


                    <a class="image-expand" id="LoadImage1" href="<?php echo $NewsFeedrow["urlToImage"]; ?>" >
                      <img id="LoadImage" src="<?php echo $NewsFeedrow["urlToImage"]; ?>" class="img-fluid br" alt="">
                    </a>



                    </div>



                    <?php

    }

?> 



                    <div class="post-list">



                      <div class="post-list-thumb">


                        <img src="<?php echo $NewsFeedrow["urlToImage"]; ?>" class="img-fluid br" alt="" onclick="LoadImg('<?php echo $NewsFeedrow["urlToImage"]; ?>');">
                        


                      </div>



                      <div class="post-list-content">



                        <h4 class="media-title"><a href="<?php echo $NewsFeedrow["url"]; ?>"> <?php echo $NewsFeedrow["title"]; ?></a></h4>



                        <p class="text-three post-excerpt"><?php echo $NewsFeedrow["description"] . '<br>' . $NewsFeedrow["content"]; ?></p>



                        <a class="read-more-link text-two" class="" href="<?php echo $NewsFeedrow["url"]; ?>" target=blank>Read More</a>



                      </div>



                    </div>



                   <?php

    $q = $q + 1;

}

?> 



                  </div>



                </div>



              </div>



            </div>



          </div>







          <!-- Upcoming Project -->



          <div class="card mb-3">



            <div class="card-header">



              <div class="row">



              <div class="col-md-12">



                  <h4>Upcoming Projects</h4>



                </div>  



              <!-- <div class="col-md-6">



                  <div class="text-right py-15">



                    <span class="text-two">Be First to get notify</span> <a class="btn btn-danger" href="#" title="">Notify Me</a>



                  </div>



                </div>   -->



              </div>



            </div>



            <div class="card-body">



                <div class="row">



                <?php

$cond2 = " and effective_date> NOW() ";

\Property\PropertyClass::Init();

$rows1 = \Property\PropertyClass::GetProjectDatas($cond2);

$r = 1;

foreach ($rows1 as $row1)

{

    $effective_date = $row1["effective_date"];

    $projectName = $row1["project_name"];

    $projectidUp = $row1["project_id"];

    $rowsells = \Property\PropertyClass::ProjectSellingDtl($projectidUp);
    foreach ($rowsells as $rowsell)
    {
        $reservedCount = $rowsell["reserved_count"];
        $soldCount = $rowsell["sold_count"];
        $totalCount = $rowsell["total_count"];
        $AvailableCount = $totalCount - $reservedCount;
        $Start_dynamin_price = $rowsell["Start_dynamin_price"];
        $AVG_Discount = round($rowsell["AVG_Discount"]);
        $Projcurr = $row["currency"];

        if ($Currency == "NZD")
        {
            $Prefix = "NZ $";
        }
        elseif ($Currency == "AUD")
        {
            $Prefix = "AU $";
        }
        elseif ($Currency == "GBP")
        {
            $Prefix = "£";
        }
        else
        {
            $Prefix = $Currency . " ";
        }

        if ($totalCount == '' || $totalCount == '0' || $totalCount == null)
        {
            $totalCount = 1;
        }
        if ($Currency == $Projcurr)
        {
            $Xrate = 1;
        }
        else
        {
            $Xraterows = \Property\PropertyClass::GetCurrExrate($Projcurr, $Currency);
            //echo print_r($Xraterows);
            $j = 1;

            foreach ($Xraterows as $Xraterow)
            {
                $Xrate = $Xraterow["RATE"];
            }
        }
        if ($Xrate == "" || $Xrate == null)
        {
            $Xrate = 1;
        }
    }

    $project_description = $row1["project_description"];

    $country = $row1["country_name"];

    //echo $country;
    $CountryCodeNew = $row["Country_Code_New"];

    $image_file = $row1["image_file"];

    $expiry_date = $row1["expiry_date"];

    $date = date("Y-m-d h:i:s");

    $effective_date1 = strtotime($effective_date);

    $expiry_date1 = strtotime($expiry_date);

    $date1 = strtotime($date);

    $diff = abs($effective_date1 - $date1);

    $years = floor($diff / (365 * 60 * 60 * 24));

    $months = floor(($diff - $years * 365 * 60 * 60 * 24)
 / (30 * 60 * 60 * 24));

    $days = floor(($diff - $years * 365 * 60 * 60 * 24 -

    $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

    $days1 = floor(($diff - $years * 365 * 60 * 60 * 24) / (60 * 60 * 24));

    $hours = floor(($diff - $years * 365 * 60 * 60 * 24
 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24)
 / (60 * 60));

    $minutes = floor(($diff - $years * 365 * 60 * 60 * 24
 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
 - $hours * 60 * 60) / 60);

    $seconds = floor(($diff - $years * 365 * 60 * 60 * 24
 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
 - $hours * 60 * 60 - $minutes * 60));

?>



                  <div class="col-md-4">



                    <div class="row no-gutters">



                      <div class="col-md-5">



                        <div class="h-100">


                            <a class="image-expand" href="<?php echo SITE_BASE_URL; ?>uploads/projectimage/<?php echo $image_file; ?>" >
                                <img src="<?php echo SITE_BASE_URL; ?>uploads/projectimage/<?php echo $image_file; ?>" class="img-fluid" alt="">
                            </a>



                        </div>



                      </div>



                      <div class="col-md-7 pl-2">



                        <div class="h-100 relative">



                          <h4 class="mb-2"><? echo $projectName; ?></h4>



                          <p class="mb-2"><?php echo $row1["subrub"]; ?></p>
                          
                          
                          <p class="mb-2"><?php echo strtolower($country); ?></p>



                          <p class="mb-2"><b></b><?php echo $Prefix . " " . number_format(round($Start_dynamin_price * $Xrate, 2)); ?></p>



                           <p class="notify">



                               <span class="pr-15">

                                   <?php
    $from_name = "DU VAL";
    $from_address = "info@duvalknowledge.co.nz";
    $to_name = $LoginFirstName . ' ' . $LoginLastName;
    $to_address = $LoginUserName; //$LoginUserName
    $startTime = date("m/d/Y H:i:s", $effective_date1);
    $endTime = date("m/d/Y H:i:s", $expiry_date1);
    $subject = "Upcoming Projects " . $projectName;
    $description = $projectName . "<br>" . $project_description;
    $location = $country;
    //\Property\PropertyClass:: sendIcalEvent($from_name, $from_address, $to_name, $to_address, $startTime, $endTime, $subject, $description, $location);
    

    
?>

                                   <div title="Add to Calendar"  ><!--class="addeventatc"-->


                                        <span onclick="MailEvent('<?php echo $from_name; ?>', '<?php echo $from_address; ?>', '<?php echo $to_name; ?>', '<?php echo $to_address; ?>', '<?php echo $startTime; ?>', '<?php echo $endTime; ?>', '<?php echo $subject; ?>', '<?php //echo $description;
     ?>', '<?php echo $location; ?>');"><!--Ghouse/25-08-2020 start-->
                                        Add to Calendar
                                        </span>


                                        <span class="start"><?php echo $effective_date; ?></span>



                                        <span class="end"><?php echo $expiry_date; ?></span>



                                        <span class="timezone"><?php echo $country; ?></span>



                                        <span class="title">Upcoming Project <?php echo $projectName; ?></span>



                                        <span class="description"><?php echo $projectName . "<br>" . $description; ?></span>



                                    </div>



                               </span> 



                            </p>



                        </div>



                       



                      </div>



                    </div>



                  </div>



                <?php

    $r = $r + 1;

}

if ($r == 1)

{ ?>



                  <div class="col-md-4">



                    <div class="row no-gutters">



                      <div class="col-md-12 pl-2">



                        <div class="h-100 relative">



                          <h4 class="mb-2">No Records</h4>



                        </div>



                       



                      </div>



                    </div>



                  </div>



                <?php

}

?>  



                </div>



            </div>



          </div><!-- end upcoming Projetc -->







  <!-- Reserve , Favourite Propert , Favourite Project  Tabs-->



  <!-- <div class="card m-t-3">



    <div class="card-header py-0">



      <div class="row">



        <div class="col-md-8">



          <nav class="card-tab">



            <div class="nav nav-tabs" id="nav-tab" role="tablist">



              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Reserve</a>



              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">My Favourites Project</a>



              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">My Favourites Property</a>



            </div>



          </nav>



        </div>



        <div class="col-md-4">



          <div class="text-right py-15">



            <span class="text-two">Win/Win By Referring your friend</span> <a class="btn btn-danger" href="#" title="">Refer a Friend</a>



          </div>



        </div>



      </div>



    </div>



    



    <div class="tab-content card-body" id="nav-tabContent">



      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">



        <div class="card">



          <div class="card-header">



            <div class="row">



              <div class="col-lg-4 col-md-4">



                <div class="">



                  <h4>Avenue Apartments | Auckland, New Zealand</h4>



                </div>



              </div>



              <div class="col-lg-4 col-md-4">



                <div>



                  <ul class="inline-lists">



                    <li class="pr-3"><img src="<?php echo SITE_BASE_URL; ?>assets/img/bed.png" class="img-fluid pr-1" alt=""> 1 BED</li>



                    <li class="pr-3"><img src="<?php echo SITE_BASE_URL; ?>assets/img/car.png" class="img-fluid pr-1" alt=""> 1 Car park</li>



                    <li><img src="<?php echo SITE_BASE_URL; ?>assets/img/bath.png" class="img-fluid pr-1" alt=""> 1 Bath</li>



                  </ul>



                </div>



              </div>



              <div class="col-lg-4 col-md-4">



                <div class="text-right">



                  <p class="mb-0">Total Property <b>100</b></p>



                </div>



              </div>



            </div>



          </div>



          <div class="card-body">



            <div class="row">



              <div class="col-md-5">



                <div class="property-row">



                  <div class="property-col">



                    <div class="property-thumb">



                      <img src="<?php echo SITE_BASE_URL; ?>assets/img/property-thumb.png" class="img-fluid" alt="">



                    </div>



                  </div>



                  <div class="property-col">



                      <div class="property-details">



                          <div class="detail-list mb-3 bg-box bg-light-warning">



                            <div class="col-first">Retail Asking Price</div>



                            <span>NZ $669,999</span>



                          </div>



                          <div class="detail-list mb-3 mb-3 bg-box bg-light-danger">



                            <div class="col-first">Current Price</div>



                            <span>NZ $669,999</span>



                          </div>



                          <div class="detail-list mb-3 mb-3 bg-box bg-light-primary">



                            <div class="col-first">Discount</div>



                            <span>NZ $669,999</span>



                          </div>



                      </div>



                  </div>



                </div>



              </div>



              <div class="col-lg-7">



                <div class="row">



                  <div class="col-md-8">



                    <div class="prop-info">



                      <p class="text-two fw-500">Du Val Dynamic Price</p>



                      <h4 class="text-lg-one fw-600 text-right">NZ $527,778</h4>



                      <div class=""> -->



                        <!-- Strike Price Chart -->



                        <!-- <canvas id="lineChart"></canvas>



                      </div>



                      



                    </div>



                  </div>



                  <div class="col-md-4">



                    <div class="prop-info">



                      <div class="h4 mb-15">Closing In</div>



                      <div class="">



                          <div class="timer-wrapper">



                            <div class="days-wrap timer-inner">



                              <div class="timer-skin-sm">00</div>



                              <span class="text-sm">Days</span>



                            </div>



                            <div class="hour-wrap timer-inner">



                              <div class="timer-skin-sm">00</div>



                              <span class="text-sm">Hours</span>



                            </div>



                            <div class="minute-wrap timer-inner">



                               <div class="timer-skin-sm">00</div>



                               <span class="text-sm">Mins</span>



                            </div>



                            <div class="second-wrap timer-inner">



                              <div class="timer-skin-sm">00</div>



                              <span class="text-sm">Secs</span>



                            </div>



                          </div>



                        </div>



                      <p class="text-center"><small>Until Release to the Market</small></p>







                      <div class="meter bg-danger">



                        <span class="" style="width:70%; background-color: #C70000"></span>



                      </div>



                      <div class="progress-text mt-3">



                        <h5 class="text-left text-red1 pull-left">Reserved <span>80</span></h5> <h5 class="text-right text-red2 pull-right">Available <span>80</span></h5>



                      </div>







                      <div class="prop-action">



                        <a class="btn btn-success" href="#" title="">Analyse Property</a>



                      </div>



                    </div>



                  </div>



                </div>



              </div>



            </div>



          </div>



        </div>



        <div class="card">



          <div class="card-header">



            <div class="row">



              <div class="col-lg-4 col-md-4">



                <div class="">



                  <h4>Avenue Apartments | Auckland, New Zealand</h4>



                </div>



              </div>



              <div class="col-lg-4 col-md-4">



                <div>



                  <ul class="inline-lists">



                    <li class="pr-3"><img src="<?php echo SITE_BASE_URL; ?>assets/img/bed.png" class="img-fluid pr-1" alt=""> 1 BED</li>



                    <li class="pr-3"><img src="<?php echo SITE_BASE_URL; ?>assets/img/car.png" class="img-fluid pr-1" alt=""> 1 Car park</li>



                    <li><img src="<?php echo SITE_BASE_URL; ?>assets/img/bath.png" class="img-fluid pr-1" alt=""> 1 Bath</li>



                  </ul>



                </div>



              </div>



              <div class="col-lg-4 col-md-4">



                <div class="text-right">



                  <p class="mb-0">Total Property <b>100</b></p>



                </div>



              </div>



            </div>



          </div>



          <div class="card-body">



            <div class="row">



              <div class="col-md-5">



                <div class="property-row">



                  <div class="property-col">



                    <div class="property-thumb">



                      <img src="<?php echo SITE_BASE_URL; ?>assets/img/property-thumb.png" class="img-fluid" alt="">



                    </div>



                  </div>



                  <div class="property-col">



                      <div class="property-details">



                          <div class="detail-list mb-3 bg-box bg-light-warning">



                            <div class="col-first">Retail Asking Price</div>



                            <span>NZ $669,999</span>



                          </div>



                          <div class="detail-list mb-3 mb-3 bg-box bg-light-danger">



                            <div class="col-first">Current Price</div>



                            <span>NZ $669,999</span>



                          </div>



                          <div class="detail-list mb-3 mb-3 bg-box bg-light-primary">



                            <div class="col-first">Discount</div>



                            <span>NZ $669,999</span>



                          </div>



                      </div>



                  </div>



                </div>



              </div>



              <div class="col-lg-7">



                <div class="row">



                  <div class="col-md-8">



                    <div class="prop-info">



                      <p class="text-two fw-500">Du Val Dynamic Price</p>



                      <h4 class="text-lg-one fw-600 text-right">NZ $527,778</h4>



                      <div class=""> -->



                        <!-- Strike Price Chart -->



                        <!-- <canvas id="lineChart2"></canvas>



                      </div>



                    </div>



                  </div>



                  <div class="col-md-4">



                    <div class="prop-info">



                      <div class="h4 mb-15">Closing In</div>



                      <div class="">



                          <div class="timer-wrapper">



                            <div class="days-wrap timer-inner">



                              <div class="timer-skin-sm" id="days">00</div>



                              <span class="text-sm">Days</span>



                            </div>



                            <div class="hour-wrap timer-inner">



                              <div class="timer-skin-sm" id="hours">00</div>



                              <span class="text-sm">Hours</span>



                            </div>



                            <div class="minute-wrap timer-inner">



                               <div class="timer-skin-sm" id="minutes">00</div>



                               <span class="text-sm">Mins</span>



                            </div>



                            <div class="second-wrap timer-inner">



                              <div class="timer-skin-sm" id="seconds">00</div>



                              <span class="text-sm">Secs</span>



                            </div>



                          </div>



                        </div>



                      <p class="text-center"><small>Until Release to the Market</small></p>



                      <div class="prop-action">



                        <a class="btn btn-success" href="#" title="">Analyse Property</a>



                      </div>



                    </div>



                  </div>



                </div>



              </div>



            </div>



          </div>



        </div>



      </div>



      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">My Favourites Project</div>



      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">My Favourites Property</div>



    </div>



  </div> -->



  <!-- End Reserve , Favourite Propert , Favourite Project  Tabs-->



              <div class="row no-gutters">



                <!-- Currencies -->



                <div class="col-md-4 pr-3">



                  <div class="card h-100">



                    <div class="card-header">



                      <h4>Currencies - Base Currency (USD)</h4>



                    </div>



                    <div class="card-body pt-0">



                    <?php /*<table class="table mb-0">



<tr>



  <td>Currency</td>



  <td>Exchange Rate</td>



</tr>



<?php



\login\loginClass::Init();



$Countryrows = \Masters\MastersClass::GetExchangeRate('USD');



$i = 1;



foreach ($Countryrows as $Countryrow)



{



   $RATE=$Countryrow["RATE"];



   $Currencies=$Countryrow["currency"];



    if($Currencies!='USD'){



    ?>



    <tr>



        <td class="f-w-400"><?php echo $Currencies;?></td>



        <td align="center"><?php echo $RATE;?></td>



    </tr>



    <?php



   }



}



?>



</table> */ ?>

<iframe scrolling="no" id="LMAXibs" sandbox="allow-same-origin allow-scripts allow-popups allow-forms" src="https://lmax-resprime.mtp-cdn.com/resprime2.html?ld4=1&amp;depth=0&amp;resmode=light&amp;show=10&amp;dpage=6&amp;cdn=2&amp;bodycss=ns+cm+nbt+nbb+dcb+lp+np+iben" frameborder="0" width="100%" height="100%" style="top:0;left:0;margin: auto;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;"></iframe>





                    </div>



                  </div>



                </div><!-- End Currencies -->



            



                <!-- Kenyon Clarke Posts -->

         <div class="col-md-4 pr-md-3 pr-0">

            <div class="card h-100">

               <div class="card-body scroll-card">

                  <div class="row no-gutters">

                     <div class="col-md-5">

                        <div class="kenyon-thumb">

                           <img src="<?php echo SITE_BASE_URL; ?>assets/img/kenyon-thumb.png" class="img-fluid" alt="">

                        </div>

                     </div>

                     <div class="col-md-7">

                        <div class="kenyon-info">

                           <h4>Kenyon Clarke</h4>

                           <h5 class="text-two">CEO - Du Val Insights</h5>

                           <ul class="inline-lists">

                              <li><a href="https://www.linkedin.com/in/kenyonclarke/"><img src="assets/img/linkedin.png" class="img-fluid"></a> </li>

                              <li><a href="https://www.facebook.com/duvalgroup/"><img src="assets/img/facebook.png" class="img-fluid"></a> </li>

                              <li><a href="https://www.instagram.com/kenyonclarke/"><img src="assets/img/instagram.png" class="img-fluid"></a> </li>

                              <li><a href="https://www.youtube.com/channel/UC5cpKLjqaigtq6fbtt3BHbw"><img src="assets/img/youtube.png" class="img-fluid"></a> </li>

                           </ul>

                        </div>

                     </div>

                  </div>

                  <div class="mt-3">

                     <h5 class="text-two">Blogs by Kenyon</h5>

                     <div class="post-list">

                        <div class="post-list-thumb">

                           <img src="https://www.kenyonclarke.com/img/new_zealand_four_horsemen_of_property_development_thumbnail.jpg" class="img-fluid br" alt="">

                        </div>

                        <div class="post-list-content">

                           <p class="text-three post-excerpt">The Four Horsemen of NZ Property Development: Banks, Council, Builders & the incompetence of the Real Estate industry</p>

                           <a class="read-more-link text-two" class="" href="https://www.kenyonclarke.com/blogs/four-horsemen-of-property-development" target="_blank">Read More</a>

                        </div>

                     </div>

                     <div class="post-list">

                        <div class="post-list-thumb">

                           <img src="https://www.kenyonclarke.com/img/rental-demand.jpg" class="img-fluid br" alt="">

                        </div>

                        <div class="post-list-content">

                           <p class="text-two">Well, the statistics are starting to come in and it would appear that we are in for a period of suburban rental growth in Auckland. Conversely, I expect to see a rental softening</p>

                           <a class="read-more-link text-two" class="" href="https://www.kenyonclarke.com/blogs/rental-demand-out-south" target="_blank">Read More</a>

                        </div>

                     </div>

                     <div class="post-list">

                        <div class="post-list-thumb">

                           <img src="https://www.kenyonclarke.com/img/Kenyon-Clarke-The-Cult-of-Investment-Ideology.jpg" class="img-fluid br" alt="">

                        </div>

                        <div class="post-list-content">

                           <p class="text-two">It’s interesting to see that the cult of investment ideology is alive and well. We have all come across property zealots in person or online who claim to have the “best” strategy.</p>

                           <a class="read-more-link text-two" class="" href="https://www.kenyonclarke.com/blogs/the-cult-of-investment-ideology" target="_blank">Read More</a>

                        </div>

                     </div>

                     <div class="post-list">

                        <div class="post-list-thumb">

                           <img src="https://www.kenyonclarke.com/img/Kenyon-Clarke-The-Economic-Impact-of-COVID19.jpg" class="img-fluid br" alt="">

                        </div>

                        <div class="post-list-content">

                           <p class="text-two">There are a lot of people who will be feeling financially vulnerable right now and with good reason.</p>

                           <a class="read-more-link text-two" class="" href="https://www.kenyonclarke.com/blogs/the-economic-Impact-of-covid-19" target="_blank">Read More</a>

                        </div>

                     </div>

                     <div class="post-list">

                        <div class="post-list-thumb">

                           <img src="https://www.kenyonclarke.com/img/Kenyon-Clarke-COVID-19-UPDATE.jpg" class="img-fluid br" alt="">

                        </div>

                        <div class="post-list-content">

                           <p class="text-two">We have had one of our strongest weeks ever for sales with over $20m signed. Buyer inquiry is at an all-time high with investors seeking to move into more stable real assets</p>

                           <a class="read-more-link text-two" class="" href="kenyonclarke.com/blogs/covid-19-update" target="_blank">Read More</a>

                        </div>

                     </div>

                     <div class="post-list">

                        <div class="post-list-thumb">

                           <img src="https://www.kenyonclarke.com/img/Kenyon-Clarke-Property-Haters-In-A-Crisis.jpg" class="img-fluid br" alt="">

                        </div>

                        <div class="post-list-content">

                           <p class="text-two">I've had a few people ask about what impact COVID-19 might have on the property market. These people are (understandably) </p>

                           <a class="read-more-link text-two" class="" href="https://www.kenyonclarke.com/blogs/property-haters-in-a-crisis" target="_blank">Read More</a>

                        </div>

                     </div>

                  </div>

               </div>

            </div>

         </div>

         <!-- End Kenyon Clarke -->



                <!-- Refer Friend -->



                <div class="col-md-4 pr-0">



                  <div class="card">



                    <div class="card-header">



                      <h4>Refer a Friend</h4>
                      <div class="row mt-2">
                        <div class="col-md-6">
                          <input type='hidden' id='Hashkey1' value='<?php echo $key; ?>'>
                          <input type="text" id="referLink" class="form-control" placeholder="<?php echo SITE_BASE_URL; ?>login/register.html?ReferralCode=<?php echo $key; ?>" value="<?php echo SITE_BASE_URL; ?>login/register.html?ReferralCode=<?php echo $key; ?>">
                        </div>
                        <div class="col-md-3">
                            <button type="" class="btn btn-outline-primary" onclick="copyText()">Copy</button>
                        </div>
                      </div>     
    
                    </div>



                    <div class="card-body scroll-card pr-4">

                      <table class="table refer-table">
                              <thead>
                                <tr>
                                  <th></th>
                                  <th>Points</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>

                      <?php

$id = \settings\session\sessionClass::GetSessionDisplayName();

\login\loginClass::Init();

$rows = \login\loginClass::GetReferredFriends($id);

$i = 1;

foreach ($rows as $row)

{

    $Users = $row["first_name"];

    $points = $row["points"];

    $Image = $row["image_file"];

    if ($Image == '' || $Image == null)

    {

        $Image = 'NoProfile.jpg';

    }

?>
                


                      <tr>
                        <td>
                            <a class="image-expand" href="<?php echo SITE_BASE_URL; ?>uploads/ProfilePic/<?php echo $Image; ?>" >
                                <img src="<?php echo SITE_BASE_URL; ?>uploads/ProfilePic/<?php echo $Image; ?>" class="img-fluid rounded-circle" alt="" width=50px> <?php echo $Users; ?>
                            </a>
                        </td>
                        <td align="middle"><?php echo number_format($points); ?></td>
                        <td></td>
                      </tr>
                             


                      <?php

}

if ($str != '' && $str != null)

{ ?>

   </tbody>
                            </table>
                      </div> 

                      <tr>
                        <td>NO record Found</td>
                      </tr>



                       <?php

}

?>



                    </div>



                  </div>



                </div><!-- End Refer Friend-->



              </div>







                </div>



            <!-- #/ container -->



        </div>



        <!-- #/ content body -->



        



 <?php include "footer.php"; ?> 





<script src="assets/plugins/chartjs/Chart.bundle.js"></script>

<script>

//linechart

var ctx = document.getElementById("lineChart");

   ctx.height = 100;

   var myChart = new Chart(ctx, {

       type: 'line',

       data: {

           labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],

           type: 'line',

   

           datasets: [{

               label: "Property Status)",

                borderColor: "#ED6161",

                borderWidth: 1,

                pointBorderWidth: 5,

                pointHoverRadius: 5,

                borderDash: [5,3],

                backgroundColor: ["#85BE1A"],

                data: [80,70,50,90,50,20,40],

                fill: false,

           }]

       },

       options: {

           responsive: true,

           tooltips: {

               enabled: false,

           },

           legend: {

               display: false,

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



//linechart2

var ctx = document.getElementById("lineChart2");

   ctx.height = 100;

   var myChart = new Chart(ctx, {

       type: 'line',

       data: {

           labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],

           type: 'line',

   

           datasets: [{

               label: "Property Status)",

                borderColor: "#ED6161",

                borderWidth: 1,

                pointBorderWidth: 5,

                pointHoverRadius: 5,

                borderDash: [5,3],

                backgroundColor: ["#85BE1A"],

                data: [80,70,50,90,50,20,40],

                fill: false,

           }]

       },

       options: {

           responsive: true,

           tooltips: {

               enabled: false,

           },

           legend: {

               display: false,

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







<script>

  // Set the date we're counting down to

  var countDownDate = new Date("July 2, 2020 12:00:00").getTime();



  // Update the count down every 1 second

  var x = setInterval(function() {



    // Get today's date and time

    var now = new Date().getTime();

      

    // Find the distance between now and the count down date

    var distance = countDownDate - now;

      

    // Time calculations for days, hours, minutes and seconds

    var days = Math.floor(distance / (1000 * 60 * 60 * 24));

    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      

    // Output the result in an element with id="demo"

  



    document.getElementById("days").innerHTML = days ;

    document.getElementById("hours").innerHTML = hours;

    document.getElementById("minutes").innerHTML = minutes;

    document.getElementById("seconds").innerHTML = minutes;

      

    // If the count down is over, write some text 

    if (distance < 0) {

      clearInterval(x);

      document.getElementById("days").innerHTML = "00" ;

      document.getElementById("hours").innerHTML = "00" ;

      document.getElementById("minutes").innerHTML = "00" ;

    }

  }, 1000);

  </script>



 



<script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js" async defer></script>







<!-- AddEvent Settings -->



<script type="text/javascript">


/*
window.addeventasync = function(){



    addeventatc.settings({



        appleical  : {show:true, text:"Apple Calendar"},



        google     : {show:true, text:"Google <em>(online)</em>"},



        office365  : {show:true, text:"Office 365 <em>(online)</em>"},



        outlook    : {show:true, text:"Outlook"},



        outlookcom : {show:true, text:"Outlook.com <em>(online)</em>"},



        yahoo      : {show:true, text:"Yahoo <em>(online)</em>"}



    });



};
*/


</script>
<link rel="stylesheet" href="<?php echo SITE_BASE_URL;?>assets/plugins/magnific-popup/magnific-popup.css">
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?php echo SITE_BASE_URL; ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="assets/plugins/jquery.countdown-2.0.4/jquery.countdown.min.js"></script>
<script>
  $('[data-countdown]').each(function() {
  var $this = $(this), finalDate = $(this).data('countdown');
  $this.countdown(finalDate, function(event) {
    $this.html(event.strftime(''
    //+ '<div><span>%w</span> <p>weeks</p></div>'
    + '<div><span>%D</span> <p>days</p></div>'
    + '<div><span>%H</span> <p>hours</p></div>'
    + '<div><span>%M</span> <p>min</p></div>'
    + '<div><span>%S</span> <p>Sec</p></div>'));
  });
});
//====================================Ghouse/25-08-2020 start=============================
function MailEvent(from_name, from_address, to_name, to_address, startTime, endTime, subject, description, location)
{
     URL = "<?php echo SITE_BASE_URL; ?>Property/sendIcalEvent.html?from_name=" + from_name + "& from_address=" + from_address + "& to_name=" + to_name + "& to_address=" + to_address + "& startTime=" + startTime + "& endTime=" + endTime + "& subject=" + subject+ "& description=" + description + "& location=" + location ;
        $.ajax({url: URL, success: function(result){
            if(result=="1")
            {
                alert("Mail Sent !")
            }
        }});
    
}
//====================================Ghouse/25-08-2020 end=============================
$(document).ready(function(){
   
   $(".date_picker").datepicker({
   
       dateFormat: 'dd-mm-yyyy',
   
       //defaultDate: '+1w',
   
       changeMonth: false,
   
       numberOfMonths: 1,
   
       showOn: 'both'
   
   });
   

   });
   
    function copyText() {
  /* Get the text field */
  var copyText = document.getElementById("referLink");
  var Hashkey = document.getElementById("Hashkey1").value;
  //===================================================
  URL = "<?php echo SITE_BASE_URL; ?>Masters/CopyText.html?ReferralCode=" + Hashkey;
  $.ajax({url: URL, success: function(result){
        if (result.trim() == "success"){
            //================================
              $.ajax({url: URL, success: function(result){
                    alert("copied Successfully");
                }});
           //===============================   
        }
        else{
            alert("Error while copy : \n" + result);
        }
    }});
  //=====================================================
  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");
}
$('.image-expand').magnificPopup({
  type: 'image'
  // other options
});

function LoadImg(what){
    document.getElementById("LoadImage").src = what;
    document.getElementById("LoadImage1").href = what;
}
</script>
