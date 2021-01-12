<?php include"header.php"; ?>

<?php
\login\loginClass::Init();
$u_data_rows = \login\loginClass::GetUserDatas();
foreach($u_data_rows as $u_row)
{
    $LoginUserId = $u_row['id'];
}
// die();
// echo "<script>alert('".$LoginUserId."');</script>";

$IsSameCurr          = $_REQUEST["IsSameCurr"] ? $_REQUEST["IsSameCurr"] : "2";

$currentCurrency     = $_SESSION["BaseCurrency"] ? $_SESSION["BaseCurrency"] : "NZD";

if($Currency=="NZD")

{

    $Prefix="$";

}

elseif($Currency=="AUD")

{

    $Prefix="$";

}

elseif($Currency=="GBP")

{

    $Prefix="£";

}

else if($Currency=="USD")

{

    $Prefix="$";

}

else

{

    $Prefix= "";

}

?>

<link rel="stylesheet" type="text/css" href="<?= SITE_BASE_URL;?>dashboard/assets/plugins/apexcharts/css/apexcharts.min.css">

<link rel="stylesheet" type="text/css" href="<?= SITE_BASE_URL;?>dashboard/assets/plugins/apexcharts/css/apexcharts.min.css.map">

<script src="<?= SITE_BASE_URL;?>dashboard/assets/plugins/chartjs/Chart.bundle.js"></script>

<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>

<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />

<div class="inner-wrapper">

    <div class="search-time-holder d-none">

        <div class="search-bar">

            <div class="input-group">

                <select class="form-control" name="choose" id="choose">

                    <option value="all">All</option>

                    <option value="1">Other</option>

                    <option value="2">Other</option>

                </select>

                <input type="text" class="form-control" placeholder="Rental Investment">

            </div>

            <button type="submit" class="btn btn-default">Search</button>

        </div>

    </div>

    <div class="available-property">

        <h1 class="hero-title-dark">Available Properties</h1>

        <ul class="nav nav-pills av-pills">

            <li class="nav-item">

                <a class="nav-link active" data-toggle="pill" href="#soon">Closing Soon!</a>

            </li>

            <li class="nav-item">

                <a class="nav-link" data-toggle="pill" href="#adays">Closing 15 Days</a>

            </li>

            <li class="nav-item">

                <a class="nav-link" data-toggle="pill" href="#bdays">Closing 30 Days</a>

            </li>

        </ul>

        <div class="tab-content av-content">

            <div class="tab-pane active" id="soon">

                <?php

                $date = strtotime(date('Y-m-d'));

                $expiryDate = date('Y-m-d', strtotime("+7 day", $date));

                $currentDate = date('Y-m-d', $date);

                $cond1  = " AND DATE(pj.expiry_date) <= '".$expiryDate."' AND DATE(pj.expiry_date) > '".$currentDate."'";
                
                \Property\PropertyClass::Init();

                $rowFavs = \Property\PropertyClass::GetPorjectDatas('','',$cond1,3);

                $j = 1;

                // echo "<pre>";

                foreach ($rowFavs as $rowFav)

                {

                    // print_r($rowFav);
                    // die;

                    $rowFavsells                = \Property\PropertyClass::ProjectSellingDtl($rowFav["PROJECT_ID"]);

                    $effective_date             = $rowFav["effective_date"];

                    $Country                    = $rowFav["country_name"];

                    $CountryCodeNew             = $rowFav["Country_Code_New"];

                    $projectDescription         = $rowFav["PROJECT_DESCRIPTION"];

                    $expiry_date                = $rowFav["expiry_date"];

                    $date                       = date("Y-m-d h:i:s");

                    $effective_date1            = strtotime($effective_date);

                    $expiry_date1               = strtotime($expiry_date);

                    $date1                      = strtotime($date);

                    $diff                       = abs($expiry_date1 - $date1);

                    $createDate                 = new DateTime($expiry_date);

                    $strip                      = $createDate->format('Y-m-d');

                    $years                      = floor($diff / (365*60*60*24));

                    $months                     = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

                    $days                       = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                    $days1                      = floor(($diff - $years * 365*60*60*24 ) / (60*60*24));

                    $hours                      = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));

                    $minutes                    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);

                    $seconds                    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));

                    $key_features               = $rowFav['key_features'];

                    foreach ($rowFavsells as $rowFavsell)

                    {

                        $reservedCount          = $rowFavsell["reserved_count"];

                        $soldCount              = $rowFavsell["sold_count"];

                        $totalCount             = $rowFavsell["total_count"];

                        $AvailableCount         = $totalCount-$reservedCount;

                        $Start_dynamin_price    = $rowFavsell["Start_dynamin_price"];

                        

                        $one_bet                = $rowFavsell["one_bet"];

                        $two_bet                = $rowFavsell["two_bet"];

                        $three_bet              = $rowFavsell["three_bet"];

                        $Weekly_rent            = $rowFavsell["Weekly_rent"];

                        $Projcurr               = $rowFav["currency"];

                        if($Currency=="NZD")

                        {

                            $Prefix="$";

                        }

                        elseif($Currency=="AUD")

                        {

                            $Prefix="$";

                        }

                        elseif($Currency=="GBP")

                        {

                            $Prefix="£";

                        }

                        else if($Currency=="USD")

                        {

                            $Prefix="$";

                        }

                        else

                        {

                            $Prefix=$Currency." ";

                        }

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

                            //$j = 1;

                            foreach ($Xraterows as $Xraterow)

                            {

                                $Xrate=$Xraterow["RATE"];

                            }

                        }

                        if($Xrate=="" || $Xrate==null)

                        {

                            $Xrate=1;

                        }

                    }
                    $rowMinValues  = \Property\PropertyClass::get_lowest_property($rowFav['PROJECT_ID']);
                    foreach($rowMinValues as $minVal)
                    {
                        $askingPrice    = $minVal['asking_price'];
                        $atrikePrice    = $minVal['strike_price'];
                        $dynamicPrice   = $minVal['dynamic_price'];
                        $start_price    = $minVal['start_price'];
                        $grossYeild     = $minVal['gross_yeild'];
                        $dynamic_price  = $askingPrice - (($askingPrice - $start_price) * $reservedCount / $totalCount);

                        // $dynamic_price = number_format(round($dynamic_price*$Xrate));

                        $AVG_Discount   = $askingPrice - $dynamic_price;
                        if($reservedCount == 0)
                        {
                            $dynamic_price = $askingPrice;
                            $AVG_Discount = 0;
                        }
                    }

                    ?>

                    <div class="property-slot">

                        <div class="prop-name-addr">

                            <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/prop-logo.svg" alt=""> <a href="<?php echo SITE_BASE_URL?>Property/ProjectView.html?project_id=<?= $rowFav["PROJECT_ID"] ?>"><?php echo $rowFav["PROJECT_NAME"].' | '.$rowFav["subrub"] .' | '. $rowFav["Postcode"].' | '.$rowFav["COUNTRY_NAME"];?></a></p>
                            
                            <?php
                            if($rowFav['IMAGE'] != "" && $rowFav['IMAGE'] != null)
                            {
                                ?>
                                <p><img src="<?php echo SITE_BASE_URL . $rowFav['IMAGE']; ?>" alt="">  </p>
                                <?php
                            }
                            ?>

                        </div>

                        <div class="ps-flex">

                            <!--<div class="mini-flex">-->

                            <div class="gallery-holder">

                                <div id="soon-gallary<?= $rowFav['PROJECT_ID']; ?>" class="carousel slide" data-ride="carousel">

                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="img-holder">
                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file"];?>" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <?php if($rowFav["image_file1"]!='') {?>
                                        <div class="carousel-item">
                                            <div class="img-holder">
                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file1"]; ?>" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <?php }
                                        if($rowFav["image_file2"]!='') {?>
                                        
                                        <div class="carousel-item">
                                            <div class="img-holder">
                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file2"]; ?>" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <?php }
                                        if($rowFav["image_file3"]!='') {?>
                                        <div class="carousel-item">
                                            <div class="img-holder">
                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file3"]; ?>" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <?php }?>
                                    </div>
                                    <ul class="carousel-indicators">
                                        <li data-target="#soon-gallary<?= $rowFav['PROJECT_ID']; ?>" data-slide-to="0" class="active">
                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file"];?>" class="img-fluid" alt="">
                                        </li>
                                        <?php if($rowFav["image_file1"]!='') {?>
                                        <li data-target="#soon-gallary<?= $rowFav['PROJECT_ID']; ?>" data-slide-to="1">
                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file1"]; ?>" class="img-fluid" alt="">
                                        </li>
                                        <?php }
                                        if($rowFav["image_file2"]!='') {?>
                                        <li data-target="#soon-gallary<?= $rowFav['PROJECT_ID']; ?>" data-slide-to="2">
                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file2"]; ?>" class="img-fluid" alt="">
                                        </li>
                                        <?php }
                                        if($rowFav["image_file3"]!='') {?>
                                        <li data-target="#soon-gallary<?= $rowFav['PROJECT_ID']; ?>" data-slide-to="3">
                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file3"]; ?>" class="img-fluid" alt="">
                                        </li>
                                        <?php }?>
                                    </ul>

                                </div>

                                <div class="prop-overview">

                                    <div class="f-text">

                                        <span> 1 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo $one_bet;?></span>

                                        <span> 2 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo $two_bet;?></span>

                                        <span> 3 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo $three_bet;?></span>
                                    </div>
                                    <p><?= $projectDescription; ?></p>

                                    <h6>Development Info</h6>

                                    <?= $key_features;?>

                                </div>

                            </div>

                            <div class="prop-info">

                                <div class="d-flex align-items-center justify-content-between">

                                    <h5>Starting From</h5>

                                    <div class="fav" id = "addtofav<?= $rowFav["PROJECT_ID"]?>">

                                            <?php
                                            if (\Property\PropertyClass::check_project_fav($rowFav["PROJECT_ID"], $LoginUserId)) {
                                                ?>
                                                <a  href="javascript:void(0);" onclick="removeFromFavourite(<?= $rowFav["PROJECT_ID"]; ?>,<?= $LoginUserId;?>, 'addtofav<?= $rowFav["PROJECT_ID"]?>')" >
                                                    <i class="fas fa-heart"></i> Remove From My Favourites</a>
                                                <!--<a href="<?= SITE_BASE_URL; ?>Property/RemoveFavorite.html?ProjectId=<?php echo $project_id; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="fas fa-heart"></i> Remove From My Favourites</a>-->

                                                <?php
                                            } else {
                                                ?>
                                                <a  href="javascript:void(0);" onclick="addToFavourite(<?= $rowFav["PROJECT_ID"]; ?>,<?= $LoginUserId; ?>, 'addtofav<?= $rowFav["PROJECT_ID"]?>')">
                                                    <i class="far fa-heart"></i> Add To My Favourites</a>

                                                <!--<a href="<?= SITE_BASE_URL; ?>Property/AddToFavorite.html?ProjectId=<?php echo $project_id; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="far fa-heart"></i> Add To My Favourites</a>-->

                                                <?php
                                            }
                                            ?>

                                        </div>

                                </div>

                                <!-- Tab panes -->

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab_<?php echo $j; ?>">

                                        <div class="price mb-4">

                                            <span><?= $Currency; ?> </span>

                                            <span><?= number_format(round($askingPrice*$Xrate)); ?></span>

                                        </div>

                                        <table>

                                            <tr>

                                                <td>Retail Asking Price From</td>

                                                <td><?php echo number_format(round($askingPrice*$Xrate));?></td>

                                                <td>Discount</td>

                                                <td><?php echo number_format($AVG_Discount);?></td>

                                            </tr>

                                            <tr>
                                                <td>Strike Price From</td>

                                                <td><?php echo number_format(round($atrikePrice*$Xrate));?></td>

                                                <td>Days Left</td>

                                                <td><?php echo $days1;?></td>

                                            </tr>

                                            <tr>
                                                <td>Dynamic Price From</td>
                                                <td><?= number_format(round(($dynamic_price == '' || $dynamic_price == null  || $dynamic_price <= 0 ) ? ($dynamic_price*$Xrate) : ($dynamic_price*$Xrate) )); ?></td>
                                                <td>Reserved </td>
                                                <td>

                                                    <?= $reservedCount;?> / Available <?= $totalCount - $reservedCount; ?>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="width: <?php echo round(($reservedCount/$totalCount)*100);?>%"></div>
                                                    </div>
                                                    <!--<progress max="100" value="<?php //echo round(($reservedCount/$totalCount)*100);?>" class="price-progress">-->

                                                    <!--    <div class="progress-bar">-->

                                                    <!--        <span style="width: <?php // echo round(($reservedCount/$totalCount)*100);?>%"><?php $reservedCount?></span>-->

                                                    <!--    </div>-->

                                                    <!--</progress>-->
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Estimated Yield From*</td>
                                                <td><?= ($grossYeild > 0 && $grossYeild != null && $grossYeild != '') ? $grossYeild : '0'; ?>%</td>
                                                
                                            </tr>

                                        </table>

                                    </div>

                                    <div class="tab-pane fade" id="tab2_<?php echo $j; ?>">

                                        <!--<div class="graph-holder">-->

                                        <!--    <canvas id="lineChart<?php echo $j; ?>"></canvas>-->

                                            <?php

                                            // $DynamicRaterows = \Property\PropertyClass::GetPropertiesDynamicFlow($ProjectIdd, $rowFav["PROJECT_ID"]);

                                            // $Label = '[';

                                            // $Value = '[';

                                            // $Value2 = '[';

                                            // foreach ($DynamicRaterows as $DynamicRaterow) {

                                            //     if ($DynamicRaterow["dynamic_rate"] != null) {

                                            //         $graphVal = $DynamicRaterow["dynamic_rate"];

                                            //     }

                                            //     if ($Label == '[') {

                                            //         $UpadtedDate = new DateTime($DynamicRaterow["updated_date"]);

                                            //         $X_axis = $UpadtedDate->format('d-m-Y');

                                            //         $Label = $Label . '"' . $X_axis . '"';

                                            //         $Value = $Value . $graphVal;

                                            //         $Value2 = $Value2 . $strike_price;

                                            //     } else {

                                            //         $UpadtedDate = new DateTime($DynamicRaterow["updated_date"]);

                                            //         $X_axis = $UpadtedDate->format('d-m-Y');

                                            //         //$Label=$Label.','.(intval($DynamicRaterow["version_no"])-1);

                                            //         $Label = $Label . ',' . '"' . $X_axis . '"';

                                            //         $Value = $Value . ',' . $graphVal;

                                            //         $Value2 = $Value2 . ',' . $strike_price;

                                            //     }

                                            // }

                                            // $Label = $Label . ']';

                                            // $Value = $Value . ']';

                                            // $Value2 = $Value2 . ']';

                                            ?>

                                            <script type="text/javascript">

                                                // var speedCanvas = document.getElementById("lineChart<?php echo $j; ?>");

                                                // Chart.defaults.global.defaultFontFamily = "Poppins";

                                                // Chart.defaults.global.defaultFontSize = 18;

                                                // var dataFirst = {

                                                //     label: "Strike Price",

                                                //     data: <?php echo $Value2; ?>,

                                                //     lineTension: 0,

                                                //     fill: false,

                                                //     borderColor: '#C70000'

                                                // };

                                                // var dataSecond = {

                                                //     label: "Dynamic Price",

                                                //     data: <?php echo $Value; ?>,

                                                //     lineTension: 0,

                                                //     fill: false,

                                                //     borderWidth: 2,

                                                //     pointBorderWidth: 2,

                                                //     pointHoverRadius: 5,

                                                //     borderDash: [5,2],

                                                //     borderColor: '#012145'

                                                // };

                                                // var speedData = {

                                                //     labels: <?php echo $Label; ?>,

                                                //     datasets: [dataFirst, dataSecond]

                                                // };

                                                // var lineChart = new Chart(speedCanvas, {

                                                //     type: 'line',

                                                //     data: speedData,

                                                //     options: {

                                                //         responsive: true,

                                                //         tooltips: {

                                                //             enabled: false,

                                                //         },

                                                //         legend: {

                                                //             display: false,

                                                //             labels: {

                                                //                 usePointStyle: false,

                                                //             },

                                                //         },

                                                //         scales: {

                                                //             xAxes: [{

                                                //                 display: true,

                                                //                 gridLines: {

                                                //                     display: true,

                                                //                     drawBorder: true

                                                //                 },

                                                //                 scaleLabel: {

                                                //                     display: false,

                                                //                     labelString: 'Month'

                                                //                 }

                                                //             }],

                                                //             yAxes: [{

                                                //                 display: true,

                                                //                 gridLines: {

                                                //                     display: true,

                                                //                     drawBorder: true

                                                //                 },

                                                //                 scaleLabel: {

                                                //                     display: true,

                                                //                     labelString: 'Value'

                                                //                 }

                                                //             }]

                                                //         },

                                                //         title: {

                                                //             display: false,

                                                //         }

                                                //     }

                                                // });

                                            </script>

                                        <!--</div>-->

                                    </div>

                                </div>

                            </div>

                            <!--</div>-->

                            <div class="actions">

                                <div class="time-holder">

                                    <p>Time Left to take actions</p>

                                    <div class="timer">

                                        <div data-countdown="<?php echo $strip ?>" class="count-skin"></div>

                                    </div>

                                </div>

                                <?php

                                $rows_c = \Property\PropertyClass::getCountryDatas($rowFav["Country"],'');

                                // echo "<pre>";

                                foreach ($rows_c as $row_c) 

                                {

                                    // print_r($row_c);

                                    $countryName    = $row_c["COUNTRY_NAME"];

                                    $CountryUrl     = $row_c["country_map_url"];

                                    $CountryLatDB   = $row_c["Country_Lat"];

                                    $CountryLngDB   = $row_c["Country_Lng"];

                                }

                                ?>

                                <div class="map">

                                    <div id='map<?= $rowFav["PROJECT_ID"];?>'></div>

                                    <script>

                                        mapboxgl.accessToken = 'pk.eyJ1IjoibGluZXp0ZWNobm9sb2dpZXMiLCJhIjoiY2tnYWU1a2tiMDY3bDJ3bzRqZTNjMnp3bCJ9.8LTEpznqgfn98PokzO6TQQ';

                                        var map<?= $rowFav["PROJECT_ID"];?> = new mapboxgl.Map({

                                            container: 'map<?= $rowFav["PROJECT_ID"];?>',

                                            style: 'mapbox://styles/mapbox/streets-v11',

                                            center: [<?= $CountryLngDB; ?>, <?= $CountryLatDB; ?>],

                                            zoom: 12

                                        });

                                    </script>

                                </div>

                                <a href="<?php echo SITE_BASE_URL; ?>Property/ProjectView.html?project_id=<?php echo $rowFav["PROJECT_ID"]; ?>" class="btn btn-green">Available Properties</a>

                            </div>

                        </div>

                    </div>

                    <?php

                    $j=$j+1;

                }

                if($j==1)

                {

                   ?>

                   <div class="property-slot placer">

                        <div class="prop-name-addr">

                            <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/prop-logo.svg" alt=""> </p>

                            <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/flag-icon.png" alt="">  </p>

                        </div>

                        <div class="ps-flex">

                            <!--<div class="mini-flex">-->

                            <div class="gallery-holder">

                                <div id="prop-gallary" class="carousel slide" data-ride="carousel">

                                    <div class="carousel-inner">

                                        <div class="carousel-item active">

                                            <div class="img-holder">

                                                <img src="#" class="img-fluid" alt="">

                                            </div>

                                        </div>

                                    </div>

                                    <ul class="carousel-indicators">

                                        <li data-target="#prop-gallary" data-slide-to="0" class="active">

                                            <img src="#" class="img-fluid" alt="">

                                        </li>

                                    </ul>

                                </div>

                                <div class="prop-overview">

                                    <div class="f-text">

                                        <span> 1 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo "1 Bed";?></span>

                                        <span> 2 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo "1 Bed";?></span>

                                        <span> 3 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo "1 Bed";?></span>

                                    </div>

                                    <p>Alpha Beta Gamma</p>

                                    <h6>Development Info</h6>

                                    Alpha Beta Gamma

                                </div>

                            </div>

                            <div class="prop-info">

                                <div class="d-flex align-items-center justify-content-between">

                                    <h5>Du Val Dynamic Pricing</h5>

                                    <div class="fav">

                                        <a href="#"><i class="far fa-heart"></i> Add to my favourties</a>

                                    </div>

                                </div>

                                <!-- Tab panes -->

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab_Alpha Beta Gamma">

                                        <div class="price mb-4">

                                            <span>Alpha Beta Gamma </span>

                                            <span>Alpha Beta Gamma</span>

                                        </div>

                                        <table>

                                            <tr>

                                                <td>Retail Asking Price From</td>

                                                <td><?php echo number_format(round($askingPrice*$Xrate));?></td>

                                                <td>Discount</td>

                                                <td><?php echo number_format($AVG_Discount);?></td>

                                            </tr>

                                            <tr>

                                                <td>Estimated Yield From*</td>

                                                <td><?= ($grossYeild > 0 && $grossYeild != null && $grossYeild != '') ? $grossYeild : '0'; ?>%</td>

                                                <td>Days Left</td>

                                                <td><?php echo $days1;?></td>

                                            </tr>

                                            <tr>
                                                <td>Dynamic Price</td>
                                                <td><?= number_format(round(($dynamicPrice == '' || $dynamicPrice == null  || $dynamicPrice <= 0 ) ? ($askingPrice*$Xrate) : ($dynamicPrice*$Xrate) )); ?></td>
                                                <td>Reserve</td>
                                                <td>

                                                    <?php echo $reservedCount;?>

                                                    <progress max="100" value="<?php echo round(($reservedCount/$totalCount)*100);?>" class="price-progress">

                                                        <div class="progress-bar">

                                                            <span style="width: <?php echo round(($reservedCount/$totalCount)*100);?>%"><?php $reservedCount?></span>

                                                        </div>

                                                    </progress>

                                                </td>

                                            </tr>

                                        </table>

                                    </div>

                                    <div class="tab-pane fade" id="tab2_Alpha Beta Gamma">

                                    </div>

                                </div>

                            </div>

                            <div class="actions">

                                <div class="time-holder">

                                    <p>Time Left to take actions</p>

                                    <div class="timer">

                                        <div data-countdown="2020-12-12" class="count-skin"></div>

                                    </div>

                                </div>

                                <div class="map">

                                    <img src="#" alt=""> Alpha Beta Gamma

                                    <div id="mapAlpha Beta Gamma"></div>

                                </div>

                                <a href="<?= SITE_BASE_URL;?>Property/Projects.html?country=" class="btn btn-green">Available Properties</a>

                            </div>

                        </div>

                    </div>

                   <?php

                }

                ?>

                <div class="more show-soon" data-tab="soon" data-action="show_more" >

                    <a href="#">

                        <i class="fas fa-arrow-to-bottom"></i>

                    </a>

                </div>

                <div class="more all-soon all-slots" data-tab="soon" data-action="redirect" >

                    <a href="<?= SITE_BASE_URL;?>Property/Projects.html?country=">

                        view More

                    </a>

                </div>

                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmPfnhPm0JDemtnhAaJGdOldwe8NiKS8w&libraries=places&callback=initAutocomplete" async defer></script>

            </div>

            <div class="tab-pane" id="adays">

                <?php

                $date = strtotime(date('Y-m-d'));

                $expiryDate = date('Y-m-d', strtotime("+15 day", $date));

                $currentDate = date('Y-m-d', strtotime("+7 day", $date)); 

                $cond1  = " AND DATE(pj.expiry_date)<='".$expiryDate."' AND DATE(pj.expiry_date) > '".$currentDate."'";
                // echo $cond1;
                // die();
                \Property\PropertyClass::Init();

                $rowFavs = \Property\PropertyClass::GetPorjectDatas('','',$cond1,3);

                $j = 1;

                // echo "<pre>";

                foreach ($rowFavs as $rowFav)

                {

                    // print_r($rowFav);

                    $rowFavsells                = \Property\PropertyClass::ProjectSellingDtl($rowFav["PROJECT_ID"]);

                    $effective_date             = $rowFav["effective_date"];

                    $Country                    = $rowFav["country_name"];

                    $CountryCodeNew             = $rowFav["Country_Code_New"];

                    $projectDescription         = $rowFav["PROJECT_DESCRIPTION"];

                    $expiry_date                = $rowFav["expiry_date"];

                    $date                       = date("Y-m-d h:i:s");

                    $effective_date1            = strtotime($effective_date);

                    $expiry_date1               = strtotime($expiry_date);

                    $date1                      = strtotime($date);

                    $diff                       = abs($expiry_date1 - $date1);

                    $createDate                 = new DateTime($expiry_date);

                    $strip                      = $createDate->format('Y-m-d');

                    $years                      = floor($diff / (365*60*60*24));

                    $months                     = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

                    $days                       = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                    $days1                      = floor(($diff - $years * 365*60*60*24 ) / (60*60*24));

                    $hours                      = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));

                    $minutes                    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);

                    $seconds                    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));

                    $key_features               = $rowFav['key_features'];

                    foreach ($rowFavsells as $rowFavsell)

                    {

                        $reservedCount          = $rowFavsell["reserved_count"];

                        $soldCount              = $rowFavsell["sold_count"];

                        $totalCount             = $rowFavsell["total_count"];

                        $AvailableCount         = $totalCount-$reservedCount;

                        $Start_dynamin_price    = $rowFavsell["Start_dynamin_price"];

                        $one_bet                = $rowFavsell["one_bet"];

                        $two_bet                = $rowFavsell["two_bet"];

                        $three_bet              = $rowFavsell["three_bet"];

                        $Weekly_rent            = $rowFavsell["Weekly_rent"];

                        $Projcurr               = $rowFav["currency"];

                        if($Currency=="NZD")

                        {

                            $Prefix="$";

                        }

                        elseif($Currency=="AUD")

                        {

                            $Prefix="$";

                        }

                        elseif($Currency=="GBP")

                        {

                            $Prefix="£";

                        }

                        else if($Currency=="USD")

                        {

                            $Prefix="$";

                        }

                        else

                        {

                            $Prefix=$Currency." ";

                        }

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

                            //$j = 1;

                            foreach ($Xraterows as $Xraterow)

                            {

                                $Xrate=$Xraterow["RATE"];

                            }

                        }

                        if($Xrate=="" || $Xrate==null)

                        {

                            $Xrate=1;

                        }

                    }
                    $rowMinValues  = \Property\PropertyClass::get_lowest_property($rowFav['PROJECT_ID']);
                    foreach($rowMinValues as $minVal)
                    {
                        $askingPrice    = $minVal['asking_price'];
                        $atrikePrice    = $minVal['strike_price'];
                        $dynamicPrice   = $minVal['dynamic_price'];
                        $start_price    = $minVal['start_price'];
                        $grossYeild     = $minVal['gross_yeild'];
                        $dynamic_price  = $askingPrice - (($askingPrice - $start_price) * $reservedCount / $totalCount);

                        $dynamic_price = number_format(round($dynamic_price*$Xrate));
                        $AVG_Discount   = $askingPrice - $dynamic_price;
                        if($reservedCount == 0)
                        {
                            $dynamic_price = $askingPrice;
                            $AVG_Discount = 0;
                        }
                    }
                    
                    
                    ?>

                    <div class="property-slot">

                        <div class="prop-name-addr">

                            <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/prop-logo.svg" alt=""> <?php echo $rowFav["PROJECT_NAME"].'|'.$rowFav["subrub"];?></p>

                            <?php
                            if($rowFav['IMAGE'] != "" && $rowFav['IMAGE'] != null)
                            {
                                ?>
                                <p><img src="<?php echo SITE_BASE_URL . $rowFav['IMAGE']; ?>" alt="">  </p>
                                <?php
                            }
                            ?>

                        </div>

                        <div class="ps-flex">

                            <!--<div class="mini-flex">-->
                            
                            <div class="gallery-holder">

                                <div id="adays-gallary<?= $rowFav['PROJECT_ID']; ?>" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="img-holder">
                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file"];?>" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <?php if($rowFav["image_file1"]!='') {?>
                                        <div class="carousel-item">
                                            <div class="img-holder">
                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file1"]; ?>" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <?php }
                                        if($rowFav["image_file2"]!='') {?>
                                        
                                        <div class="carousel-item">
                                            <div class="img-holder">
                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file2"]; ?>" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <?php }
                                        if($rowFav["image_file3"]!='') {?>
                                        <div class="carousel-item">
                                            <div class="img-holder">
                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file3"]; ?>" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <?php }?>
                                    </div>
                                    <ul class="carousel-indicators">
                                        <li data-target="#adays-gallary<?= $rowFav['PROJECT_ID']; ?>" data-slide-to="0" class="active">
                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file"];?>" class="img-fluid" alt="">
                                        </li>
                                        <?php if($rowFav["image_file1"]!='') {?>
                                        <li data-target="#adays-gallary<?= $rowFav['PROJECT_ID']; ?>" data-slide-to="1">
                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file1"]; ?>" class="img-fluid" alt="">
                                        </li>
                                        <?php }
                                        if($rowFav["image_file2"]!='') {?>
                                        <li data-target="#adays-gallary<?= $rowFav['PROJECT_ID']; ?>" data-slide-to="2">
                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file2"]; ?>" class="img-fluid" alt="">
                                        </li>
                                        <?php }
                                        if($rowFav["image_file3"]!='') {?>
                                        <li data-target="#adays-gallary<?= $rowFav['PROJECT_ID']; ?>" data-slide-to="3">
                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file3"]; ?>" class="img-fluid" alt="">
                                        </li>
                                        <?php }?>
                                    </ul>
                                </div>

                                <div class="prop-overview">

                                    <div class="f-text">

                                        <span> 1 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo $one_bet;?></span>

                                        <span> 2 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo $two_bet;?></span>

                                        <span> 3 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo $three_bet;?></span>
                                    </div>

                                    <p><?= $projectDescription; ?></p>

                                    <h6>Development Info</h6>

                                    <?= $key_features;?>
                                </div>

                            </div>

                            <div class="prop-info">

                                <div class="d-flex align-items-center justify-content-between">

                                    <h5>Starting From</h5>

                                    <!-- Nav pills -->

                                    <!--<ul class="nav nav-pills">-->

                                    <!--    <span>View Graph</span>-->

                                    <!--    <li class="nav-item">-->

                                    <!--        <a class="nav-link active" data-toggle="pill" href="#tab_<?php echo $j; ?>"><i class="fas fa-table"></i></a>-->

                                    <!--    </li>-->

                                    <!--    <li class="nav-item">-->

                                    <!--        <a class="nav-link" data-toggle="pill" href="#tab2_<?php echo $j; ?>"><i class="fas fa-chart-line"></i></a>-->

                                    <!--    </li>-->

                                    <!--</ul>-->

                                    <div class="fav" id ="addtofav<?= $rowFav["PROJECT_ID"]?>">

                                            <?php
                                            if (\Property\PropertyClass::check_project_fav($rowFav["PROJECT_ID"], $LoginUserId)) {
                                                ?>
                                                <a  href="javascript:void(0);" onclick="removeFromFavourite(<?= $rowFav["PROJECT_ID"]; ?>,<?= $LoginUserId;?>, 'addtofav<?= $rowFav["PROJECT_ID"]?>')" >
                                                    <i class="fas fa-heart"></i> Remove From My Favourites</a>
                                                <!--<a href="<?= SITE_BASE_URL; ?>Property/RemoveFavorite.html?ProjectId=<?php echo $project_id; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="fas fa-heart"></i> Remove From My Favourites</a>-->

                                                <?php
                                            } else {
                                                ?>
                                                <a  href="javascript:void(0);" onclick="addToFavourite(<?= $rowFav["PROJECT_ID"]; ?>,<?= $LoginUserId; ?>, 'addtofav<?= $rowFav["PROJECT_ID"]?>')">
                                                    <i class="far fa-heart"></i> Add To My Favourites</a>

                                                <!--<a href="<?= SITE_BASE_URL; ?>Property/AddToFavorite.html?ProjectId=<?php echo $project_id; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="far fa-heart"></i> Add To My Favourites</a>-->

                                                <?php
                                            }
                                            ?>

                                        </div>

                                </div>

                                <!-- Tab panes -->

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab_<?php echo $j; ?>">

                                        <div class="price mb-4">

                                            <span><?= $Currency; ?> </span>

                                            <span><?= number_format(round($atrikePrice*$Xrate)); ?></span>

                                        </div>

                                        <table>

                                            <tr>

                                                <td>Retail Asking Price From</td>

                                                <td><?php echo number_format(round($askingPrice*$Xrate));?></td>

                                                <td>Discount</td>

                                                <td><?php echo number_format($AVG_Discount);?></td>

                                            </tr>

                                            <tr>
                                                <td>Strike Price From</td>

                                                <td><?php echo number_format(round($atrikePrice*$Xrate));?></td>

                                                <td>Days Left</td>

                                                <td><?php echo $days1;?></td>

                                            </tr>

                                            <tr>
                                                <td>Dynamic Price From</td>
                                                <td><?= number_format(round(($dynamic_price == '' || $dynamic_price == null  || $dynamic_price <= 0 ) ? ($dynamic_price*$Xrate) : ($dynamic_price*$Xrate) )); ?></td>
                                                <td>Reserved</td>
                                                <td>

                                                    <?= $reservedCount;?> / Available <?= $totalCount - $reservedCount; ?>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="width: <?php echo round(($reservedCount/$totalCount)*100);?>%"></div>
                                                    </div>
                                                    <!--<progress max="100" value="<?php // echo round(($reservedCount/$totalCount)*100);?>" class="price-progress">-->

                                                    <!--    <div class="progress-bar">-->

                                                    <!--        <span style="width: <?php // echo round(($reservedCount/$totalCount)*100);?>%"><?php $reservedCount?></span>-->

                                                    <!--    </div>-->

                                                    <!--</progress>-->
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Estimated Yield From*</td>
                                                <td><?= ($grossYeild > 0 && $grossYeild != null && $grossYeild != '') ? $grossYeild : '0' ;?>%</td>
                                                
                                            </tr>

                                        </table>

                                    </div>

                                    <div class="tab-pane fade" id="tab2_<?php echo $j; ?>">

                                        <!--<div class="graph-holder">-->

                                        <!--    <canvas id="lineChart<?php echo $j; ?>"></canvas>-->

                                            <?php

                                            // $DynamicRaterows = \Property\PropertyClass::GetPropertiesDynamicFlow($ProjectIdd, $rowFav["PROJECT_ID"]);

                                            // $Label = '[';

                                            // $Value = '[';

                                            // $Value2 = '[';

                                            // foreach ($DynamicRaterows as $DynamicRaterow) {

                                            //     if ($DynamicRaterow["dynamic_rate"] != null) {

                                            //         $graphVal = $DynamicRaterow["dynamic_rate"];

                                            //     }

                                            //     if ($Label == '[') {

                                            //         $UpadtedDate = new DateTime($DynamicRaterow["updated_date"]);

                                            //         $X_axis = $UpadtedDate->format('d-m-Y');

                                            //         $Label = $Label . '"' . $X_axis . '"';

                                            //         $Value = $Value . $graphVal;

                                            //         $Value2 = $Value2 . $strike_price;

                                            //     } else {

                                            //         $UpadtedDate = new DateTime($DynamicRaterow["updated_date"]);

                                            //         $X_axis = $UpadtedDate->format('d-m-Y');

                                            //         //$Label=$Label.','.(intval($DynamicRaterow["version_no"])-1);

                                            //         $Label = $Label . ',' . '"' . $X_axis . '"';

                                            //         $Value = $Value . ',' . $graphVal;

                                            //         $Value2 = $Value2 . ',' . $strike_price;

                                            //     }

                                            // }

                                            // $Label = $Label . ']';

                                            // $Value = $Value . ']';

                                            // $Value2 = $Value2 . ']';

                                            ?>

                                            <script type="text/javascript">

                                                // var speedCanvas = document.getElementById("lineChart<?php echo $j; ?>");

                                                // Chart.defaults.global.defaultFontFamily = "Poppins";

                                                // Chart.defaults.global.defaultFontSize = 18;

                                                // var dataFirst = {

                                                //     label: "Strike Price",

                                                //     data: <?php echo $Value2; ?>,

                                                //     lineTension: 0,

                                                //     fill: false,

                                                //     borderColor: '#C70000'

                                                // };

                                                // var dataSecond = {

                                                //     label: "Dynamic Price",

                                                //     data: <?php echo $Value; ?>,

                                                //     lineTension: 0,

                                                //     fill: false,

                                                //     borderWidth: 2,

                                                //     pointBorderWidth: 2,

                                                //     pointHoverRadius: 5,

                                                //     borderDash: [5,2],

                                                //     borderColor: '#012145'

                                                // };

                                                // var speedData = {

                                                //     labels: <?php echo $Label; ?>,

                                                //     datasets: [dataFirst, dataSecond]

                                                // };

                                                // var lineChart = new Chart(speedCanvas, {

                                                //     type: 'line',

                                                //     data: speedData,

                                                //     options: {

                                                //         responsive: true,

                                                //         tooltips: {

                                                //             enabled: false,

                                                //         },

                                                //         legend: {

                                                //             display: false,

                                                //             labels: {

                                                //                 usePointStyle: false,

                                                //             },

                                                //         },

                                                //         scales: {

                                                //             xAxes: [{

                                                //                 display: true,

                                                //                 gridLines: {

                                                //                     display: true,

                                                //                     drawBorder: true

                                                //                 },

                                                //                 scaleLabel: {

                                                //                     display: false,

                                                //                     labelString: 'Month'

                                                //                 }

                                                //             }],

                                                //             yAxes: [{

                                                //                 display: true,

                                                //                 gridLines: {

                                                //                     display: true,

                                                //                     drawBorder: true

                                                //                 },

                                                //                 scaleLabel: {

                                                //                     display: true,

                                                //                     labelString: 'Value'

                                                //                 }

                                                //             }]

                                                //         },

                                                //         title: {

                                                //             display: false,

                                                //         }

                                                //     }

                                                // });

                                            </script>

                                        <!--</div>-->

                                    </div>

                                </div>

                            </div>

                            <!--</div>-->

                            <div class="actions">

                                <div class="time-holder">

                                    <p>Time Left to take actions</p>

                                    <div class="timer">

                                        <div data-countdown="<?php echo $strip ?>" class="count-skin"></div>

                                    </div>

                                </div>

                                <?php

                                $rows_c = \Property\PropertyClass::getCountryDatas($rowFav["Country"],'');

                                // echo "<pre>";

                                foreach ($rows_c as $row_c) 

                                {

                                    // print_r($row_c);

                                    $countryName    = $row_c["COUNTRY_NAME"];

                                    $CountryUrl     = $row_c["country_map_url"];

                                    $CountryLatDB   = $row_c["Country_Lat"];

                                    $CountryLngDB   = $row_c["Country_Lng"];

                                }

                                ?>

                                <div class="map">

                                    <div id='map<?= $rowFav["PROJECT_ID"];?>'></div>

                                    <script>

                                        mapboxgl.accessToken = 'pk.eyJ1IjoibGluZXp0ZWNobm9sb2dpZXMiLCJhIjoiY2tnYWU1a2tiMDY3bDJ3bzRqZTNjMnp3bCJ9.8LTEpznqgfn98PokzO6TQQ';

                                        var map<?= $rowFav["PROJECT_ID"];?> = new mapboxgl.Map({

                                            container: 'map<?= $rowFav["PROJECT_ID"];?>',

                                            style: 'mapbox://styles/mapbox/streets-v11',

                                            center: [<?= $CountryLngDB; ?>, <?= $CountryLatDB; ?>],

                                            zoom: 12

                                        });

                                    </script>

                                </div>

                                <a href="<?php echo SITE_BASE_URL; ?>Property/ProjectView.html?project_id=<?php echo $rowFav["PROJECT_ID"]; ?>" class="btn btn-green">Available Properties</a>

                            </div>

                        </div>

                    </div>

                    <?php

                    $j=$j+1;

                }

                if($j==1)

                {

                   ?>

                   <div class="property-slot placer">

                        <div class="prop-name-addr">

                            <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/prop-logo.svg" alt=""> </p>

                            <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/flag-icon.png" alt="">  </p>

                        </div>

                        <div class="ps-flex">

                            <!--<div class="mini-flex">-->

                            <div class="gallery-holder">

                                <div id="prop-gallary" class="carousel slide" data-ride="carousel">

                                    <div class="carousel-inner">

                                        <div class="carousel-item active">

                                            <div class="img-holder">

                                                <img src="#" class="img-fluid" alt="">

                                            </div>

                                        </div>

                                    </div>

                                    <ul class="carousel-indicators">

                                        <li data-target="#prop-gallary" data-slide-to="0" class="active">

                                            <img src="#" class="img-fluid" alt="">

                                        </li>

                                    </ul>

                                </div>

                                <div class="prop-overview">

                                    <div class="f-text">

                                        <span> 1 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo "1 Bed";?></span>

                                        <span> 2 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo "1 Bed";?></span>

                                        <span> 3 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo "1 Bed";?></span>

                                    </div>

                                    <p>Alpha Beta Gamma</p>

                                    <h6>Development Info</h6>

                                    Alpha Beta Gamma

                                </div>

                            </div>

                            <div class="prop-info">

                                <div class="d-flex align-items-center justify-content-between">

                                    <h5>Du Val Dynamic Pricing</h5>

                                    <div class="fav">

                                        <a href="#"><i class="far fa-heart"></i> Add To My Fav</a>

                                    </div>

                                </div>

                                <!-- Tab panes -->

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab_Alpha Beta Gamma">

                                        <div class="price mb-4">

                                            <span>Alpha Beta Gamma </span>

                                            <span>Alpha Beta Gamma</span>

                                        </div>

                                        <table>

                                            <tr>

                                                <td>Discount</td>

                                                <td><?php echo "Alpha Beta Gamma";?></td>

                                                <td>&nbsp;</td>

                                                <td>&nbsp;</td>

                                            </tr>

                                            <tr>

                                                <td>Estimated Yield*</td>

                                                <td>From 8%</td>

                                                <td>&nbsp;</td>

                                                <td>&nbsp;</td>

                                            </tr>

                                            <tr>

                                                <td>Days Left</td>

                                                <td><?php echo "Alpha Beta Gamma";?></td>

                                                <td>&nbsp;</td>

                                                <td>&nbsp;</td>

                                            </tr>

                                        </table>

                                    </div>

                                    <div class="tab-pane fade" id="tab2_Alpha Beta Gamma">

                                    </div>

                                </div>

                            </div>

                            <div class="actions">

                                <div class="time-holder">

                                    <p>Time Left to take actions</p>

                                    <div class="timer">

                                        <div data-countdown="2020-12-12" class="count-skin"></div>

                                    </div>

                                </div>

                                <div class="map">

                                    <img src="#" alt=""> Alpha Beta Gamma

                                    <div id="mapAlpha Beta Gamma"></div>

                                </div>

                                <a href="#" class="btn btn-green">Available Properties</a>

                            </div>

                        </div>

                    </div>

                   <?php

                }

                ?>

                <div class="more show-adays" data-tab="adays" data-action="show_more" >

                    <a href="#">

                        <i class="fas fa-arrow-to-bottom"></i>

                    </a>

                </div>

                <div class="more all-adays all-slots" data-tab="adays" data-action="redirect" >

                    <a href="<?= SITE_BASE_URL;?>Property/Projects.html?country=">

                        view More

                    </a>

                </div>

                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmPfnhPm0JDemtnhAaJGdOldwe8NiKS8w&libraries=places&callback=initAutocomplete" async defer></script>

            </div>

            <div class="tab-pane" id="bdays">

                <?php

                $date = strtotime(date('Y-m-d'));

                $expiryDate = date('Y-m-d', strtotime("+30 day", $date));

                $currentDate = date('Y-m-d', strtotime("+15 day", $date)); 

                $cond1  = " AND DATE(pj.expiry_date)<='".$expiryDate."' AND DATE(pj.expiry_date) > '".$currentDate."'";

                \Property\PropertyClass::Init();

                $rowFavs = \Property\PropertyClass::GetPorjectDatas('','',$cond1,3);

                $j = 1;


                // echo "<pre>";

                foreach ($rowFavs as $rowFav)

                {

                    // print_r($rowFav);

                    $rowFavsells                = \Property\PropertyClass::ProjectSellingDtl($rowFav["PROJECT_ID"]);

                    $effective_date             = $rowFav["effective_date"];

                    $Country                    = $rowFav["country_name"];

                    $CountryCodeNew             = $rowFav["Country_Code_New"];

                    $projectDescription         = $rowFav["PROJECT_DESCRIPTION"];

                    $expiry_date                = $rowFav["expiry_date"];

                    $date                       = date("Y-m-d h:i:s");

                    $effective_date1            = strtotime($effective_date);

                    $expiry_date1               = strtotime($expiry_date);

                    $date1                      = strtotime($date);

                    $diff                       = abs($expiry_date1 - $date1);

                    $createDate                 = new DateTime($expiry_date);

                    $strip                      = $createDate->format('Y-m-d');

                    $years                      = floor($diff / (365*60*60*24));

                    $months                     = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

                    $days                       = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                    $days1                      = floor(($diff - $years * 365*60*60*24 ) / (60*60*24));

                    $hours                      = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));

                    $minutes                    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);

                    $seconds                    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));

                    $key_features               = $rowFav['key_features'];

                    foreach ($rowFavsells as $rowFavsell)

                    {

                        $reservedCount          = $rowFavsell["reserved_count"];

                        $soldCount              = $rowFavsell["sold_count"];

                        $totalCount             = $rowFavsell["total_count"];

                        $AvailableCount         = $totalCount-$reservedCount;

                        $Start_dynamin_price    = $rowFavsell["Start_dynamin_price"];

                        $one_bet                = $rowFavsell["one_bet"];

                        $two_bet                = $rowFavsell["two_bet"];

                        $three_bet              = $rowFavsell["three_bet"];

                        $Weekly_rent            = $rowFavsell["Weekly_rent"];

                        $Projcurr               = $rowFav["currency"];

                        if($Currency=="NZD")

                        {

                            $Prefix="$";

                        }

                        elseif($Currency=="AUD")

                        {

                            $Prefix="$";

                        }

                        elseif($Currency=="GBP")

                        {

                            $Prefix="£";

                        }

                        else if($Currency=="USD")

                        {

                            $Prefix="$";

                        }

                        else

                        {

                            $Prefix=$Currency." ";

                        }

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

                            //$j = 1;

                            foreach ($Xraterows as $Xraterow)

                            {

                                $Xrate=$Xraterow["RATE"];

                            }

                        }

                        if($Xrate=="" || $Xrate==null)

                        {

                            $Xrate=1;

                        }

                    }
                    $rowMinValues  = \Property\PropertyClass::get_lowest_property($rowFav['PROJECT_ID']);
                    foreach($rowMinValues as $minVal)
                    {
                        $askingPrice    = $minVal['asking_price'];
                        $atrikePrice    = $minVal['strike_price'];
                        $dynamicPrice   = $minVal['dynamic_price'];
                        $start_price    = $minVal['start_price'];
                        $grossYeild     = $minVal['gross_yeild'];
                        $dynamic_price  = $askingPrice - (($askingPrice - $start_price) * $reservedCount / $totalCount);

                        $dynamic_price = number_format(round($dynamic_price*$Xrate));
                        $AVG_Discount   = $askingPrice - $dynamic_price;
                        if($reservedCount == 0)
                        {
                            $dynamic_price = $askingPrice;
                            $AVG_Discount = 0;
                        }
                    }
                    ?>

                    <div class="property-slot">

                        <div class="prop-name-addr">

                            <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/prop-logo.svg" alt=""> <?php echo $rowFav["PROJECT_NAME"].'|'.$rowFav["subrub"];?></p>

                            <?php
                            if($rowFav['IMAGE'] != "" && $rowFav['IMAGE'] != null)
                            {
                                ?>
                                <p><img src="<?php echo SITE_BASE_URL . $rowFav['IMAGE']; ?>" alt="">  </p>
                                <?php
                            }
                            ?>

                        </div>

                        <div class="ps-flex">

                            <!--<div class="mini-flex">-->

                            <div class="gallery-holder">

                                <div id="bdays-gallary<?= $rowFav['PROJECT_ID']; ?>" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="img-holder">
                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file"];?>" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <?php if($rowFav["image_file1"]!='') {?>
                                        <div class="carousel-item">
                                            <div class="img-holder">
                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file1"]; ?>" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <?php }
                                        if($rowFav["image_file2"]!='') {?>
                                        
                                        <div class="carousel-item">
                                            <div class="img-holder">
                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file2"]; ?>" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <?php }
                                        if($rowFav["image_file3"]!='') {?>
                                        <div class="carousel-item">
                                            <div class="img-holder">
                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file3"]; ?>" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <?php }?>
                                    </div>
                                    <ul class="carousel-indicators">
                                        <li data-target="#bdays-gallary<?= $rowFav['PROJECT_ID']; ?>" data-slide-to="0" class="active">
                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file"];?>" class="img-fluid" alt="">
                                        </li>
                                        <?php if($rowFav["image_file1"]!='') {?>
                                        <li data-target="#bdays-gallary<?= $rowFav['PROJECT_ID']; ?>" data-slide-to="1">
                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file1"]; ?>" class="img-fluid" alt="">
                                        </li>
                                        <?php }
                                        if($rowFav["image_file2"]!='') {?>
                                        <li data-target="#bdays-gallary<?= $rowFav['PROJECT_ID']; ?>" data-slide-to="2">
                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file2"]; ?>" class="img-fluid" alt="">
                                        </li>
                                        <?php }
                                        if($rowFav["image_file3"]!='') {?>
                                        <li data-target="#bdays-gallary<?= $rowFav['PROJECT_ID']; ?>" data-slide-to="3">
                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $rowFav["image_file3"]; ?>" class="img-fluid" alt="">
                                        </li>
                                        <?php }?>
                                    </ul>
                                </div>

                                <div class="prop-overview">

                                    <div class="f-text">

                                        <span> 1 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo $one_bet;?></span>

                                        <span> 2 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo $two_bet;?></span>

                                        <span> 3 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo $three_bet;?></span>

                                    </div>

                                    <p><?= $projectDescription; ?></p>

                                    <h6>Development Info</h6>

                                    <?= $key_features;?>
                                </div>

                            </div>

                            <div class="prop-info">

                                <div class="d-flex align-items-center justify-content-between">

                                    <h5>Starting From</h5>

                                    <!-- Nav pills -->

                                    <!--<ul class="nav nav-pills">-->

                                    <!--    <span>View Graph</span>-->

                                    <!--    <li class="nav-item">-->

                                    <!--        <a class="nav-link active" data-toggle="pill" href="#tab_<?php echo $j; ?>"><i class="fas fa-table"></i></a>-->

                                    <!--    </li>-->

                                    <!--    <li class="nav-item">-->

                                    <!--        <a class="nav-link" data-toggle="pill" href="#tab2_<?php echo $j; ?>"><i class="fas fa-chart-line"></i></a>-->

                                    <!--    </li>-->

                                    <!--</ul>-->

                                   <div class="fav" id = "addtofav<?= $rowFav['PROJECT_ID']; ?>">
    
                                        <?php
                                        if ( \Property\PropertyClass::check_project_fav($rowFav["PROJECT_ID"], $LoginUserId)) {
                                            ?>
                                            <a  href="javascript:void(0);" onclick="removeFromFavourite(<?= $rowFav["PROJECT_ID"]; ?>,<?= $LoginUserId;?>, 'addtofav<?= $rowFav['PROJECT_ID']; ?>' )" >
                                                <i class="fas fa-heart"></i> Remove From My Favourites</a>
                                            <!--<a href="<?= SITE_BASE_URL; ?>Property/RemoveFavorite.html?ProjectId=<?php echo $project_id; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="fas fa-heart"></i> Remove From My Favourites</a>-->
    
                                            <?php
                                        } else {
                                            ?>
                                            <a  href="javascript:void(0);" onclick="addToFavourite(<?= $rowFav["PROJECT_ID"]; ?>,<?= $LoginUserId; ?>, 'addtofav<?= $rowFav['PROJECT_ID']; ?>')">
                                                <i class="far fa-heart"></i> Add To My Favourites</a>
    
                                            <!--<a href="<?= SITE_BASE_URL; ?>Property/AddToFavorite.html?ProjectId=<?php echo $project_id; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="far fa-heart"></i> Add To My Favourites</a>-->
    
                                            <?php
                                        }
                                        ?>
                                    </div>

                                </div>

                                <!-- Tab panes -->

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab_<?php echo $j; ?>">

                                        <div class="price mb-4">

                                            <span><?= $Currency; ?> </span>

                                            <span><?= number_format(round($atrikePrice*$Xrate)); ?></span>

                                        </div>

                                        <table>

                                            <tr>

                                                <td>Retail Asking Price From</td>

                                                <td><?php echo number_format(round($askingPrice*$Xrate));?></td>

                                                <td>Discount %</td>

                                                <td><?php echo number_format($AVG_Discount);?>%</td>

                                            </tr>

                                            <tr>
                                                <td>Strike Price From</td>

                                                <td><?php echo number_format(round($atrikePrice*$Xrate));?></td>

                                                <td>Days Left</td>

                                                <td><?php echo $days1;?></td>

                                            </tr>

                                            <tr>
                                                <td>Dynamic Price From</td>
                                                <td><?= number_format(round(($dynamic_price == '' || $dynamic_price == null  || $dynamic_price <= 0 ) ? ($dynamic_price*$Xrate) : ($dynamic_price*$Xrate) )); ?></td>
                                                <td>Reserved</td>
                                                <td>

                                                    <?= $reservedCount;?> / Available <?= $totalCount - $reservedCount; ?>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="width: <?php echo round(($reservedCount/$totalCount)*100);?>%"></div>
                                                    </div>
                                                    <!--<div class="prog-text d-flex justify-content-between">-->
                                                    <!--    <span>Reserved 80</span>-->
                                                    <!--    <span>Reserved 20</span>-->
                                                    <!--</div>-->
                                                    <!--<progress max="100" value="<?php // echo round(($reservedCount/$totalCount)*100);?>" class="price-progress">-->

                                                    <!--    <div class="progress-bar">-->

                                                    <!--        <span ><?php //$reservedCount?></span>-->

                                                    <!--    </div>-->

                                                    <!--</progress>-->
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Estimated Yield From*</td>
                                                <td><?= ($grossYeild > 0 && $grossYeild != null && $grossYeild != '') ? $grossYeild : '0'; ?>%</td>
                                                
                                            </tr>

                                        </table>

                                    </div>

                                    <div class="tab-pane fade" id="tab2_<?php echo $j; ?>">

                                        <!--<div class="graph-holder">-->

                                        <!--    <canvas id="lineChart<?php echo $j; ?>"></canvas>-->

                                            <?php

                                            // $DynamicRaterows = \Property\PropertyClass::GetPropertiesDynamicFlow($ProjectIdd, $rowFav["PROJECT_ID"]);

                                            // $Label = '[';

                                            // $Value = '[';

                                            // $Value2 = '[';

                                            // foreach ($DynamicRaterows as $DynamicRaterow) {

                                            //     if ($DynamicRaterow["dynamic_rate"] != null) {

                                            //         $graphVal = $DynamicRaterow["dynamic_rate"];

                                            //     }

                                            //     if ($Label == '[') {

                                            //         $UpadtedDate = new DateTime($DynamicRaterow["updated_date"]);

                                            //         $X_axis = $UpadtedDate->format('d-m-Y');

                                            //         $Label = $Label . '"' . $X_axis . '"';

                                            //         $Value = $Value . $graphVal;

                                            //         $Value2 = $Value2 . $strike_price;

                                            //     } else {

                                            //         $UpadtedDate = new DateTime($DynamicRaterow["updated_date"]);

                                            //         $X_axis = $UpadtedDate->format('d-m-Y');

                                            //         //$Label=$Label.','.(intval($DynamicRaterow["version_no"])-1);

                                            //         $Label = $Label . ',' . '"' . $X_axis . '"';

                                            //         $Value = $Value . ',' . $graphVal;

                                            //         $Value2 = $Value2 . ',' . $strike_price;

                                            //     }

                                            // }

                                            // $Label = $Label . ']';

                                            // $Value = $Value . ']';

                                            // $Value2 = $Value2 . ']';

                                            ?>

                                            <script type="text/javascript">

                                                // var speedCanvas = document.getElementById("lineChart<?php echo $j; ?>");

                                                // Chart.defaults.global.defaultFontFamily = "Poppins";

                                                // Chart.defaults.global.defaultFontSize = 18;

                                                // var dataFirst = {

                                                //     label: "Strike Price",

                                                //     data: <?php echo $Value2; ?>,

                                                //     lineTension: 0,

                                                //     fill: false,

                                                //     borderColor: '#C70000'

                                                // };

                                                // var dataSecond = {

                                                //     label: "Dynamic Price",

                                                //     data: <?php echo $Value; ?>,

                                                //     lineTension: 0,

                                                //     fill: false,

                                                //     borderWidth: 2,

                                                //     pointBorderWidth: 2,

                                                //     pointHoverRadius: 5,

                                                //     borderDash: [5,2],

                                                //     borderColor: '#012145'

                                                // };

                                                // var speedData = {

                                                //     labels: <?php echo $Label; ?>,

                                                //     datasets: [dataFirst, dataSecond]

                                                // };

                                                // var lineChart = new Chart(speedCanvas, {

                                                //     type: 'line',

                                                //     data: speedData,

                                                //     options: {

                                                //         responsive: true,

                                                //         tooltips: {

                                                //             enabled: false,

                                                //         },

                                                //         legend: {

                                                //             display: false,

                                                //             labels: {

                                                //                 usePointStyle: false,

                                                //             },

                                                //         },

                                                //         scales: {

                                                //             xAxes: [{

                                                //                 display: true,

                                                //                 gridLines: {

                                                //                     display: true,

                                                //                     drawBorder: true

                                                //                 },

                                                //                 scaleLabel: {

                                                //                     display: false,

                                                //                     labelString: 'Month'

                                                //                 }

                                                //             }],

                                                //             yAxes: [{

                                                //                 display: true,

                                                //                 gridLines: {

                                                //                     display: true,

                                                //                     drawBorder: true

                                                //                 },

                                                //                 scaleLabel: {

                                                //                     display: true,

                                                //                     labelString: 'Value'

                                                //                 }

                                                //             }]

                                                //         },

                                                //         title: {

                                                //             display: false,

                                                //         }

                                                //     }

                                                // });

                                            </script>

                                        <!--</div>-->

                                    </div>

                                </div>

                            </div>

                            <!--</div>-->

                            <div class="actions">

                                <div class="time-holder">

                                    <p>Time Left to take actions</p>

                                    <div class="timer">

                                        <div data-countdown="<?php echo $strip ?>" class="count-skin"></div>

                                    </div>

                                </div>

                                <?php

                                $rows_c = \Property\PropertyClass::getCountryDatas($rowFav["Country"],'');

                                // echo "<pre>";

                                foreach ($rows_c as $row_c) 

                                {

                                    // print_r($row_c);

                                    $countryName    = $row_c["COUNTRY_NAME"];

                                    $CountryUrl     = $row_c["country_map_url"];

                                    $CountryLatDB   = $row_c["Country_Lat"];

                                    $CountryLngDB   = $row_c["Country_Lng"];

                                }

                                ?>

                                <div class="map">

                                    <div id='map<?= $rowFav["PROJECT_ID"];?>'></div>

                                    <script>

                                        mapboxgl.accessToken = 'pk.eyJ1IjoibGluZXp0ZWNobm9sb2dpZXMiLCJhIjoiY2tnYWU1a2tiMDY3bDJ3bzRqZTNjMnp3bCJ9.8LTEpznqgfn98PokzO6TQQ';

                                        var map<?= $rowFav["PROJECT_ID"];?> = new mapboxgl.Map({

                                            container: 'map<?= $rowFav["PROJECT_ID"];?>',

                                            style: 'mapbox://styles/mapbox/streets-v11',

                                            center: [<?= $CountryLngDB; ?>, <?= $CountryLatDB; ?>],

                                            zoom: 12

                                        });

                                    </script>

                                </div>

                                <a href="<?php echo SITE_BASE_URL; ?>Property/ProjectView.html?project_id=<?php echo $rowFav["PROJECT_ID"]; ?>" class="btn btn-green">Available Properties</a>

                            </div>

                        </div>

                    </div>

                    <?php

                    $j=$j+1;

                }

                if($j==1)

                {

                   ?>

                   <div class="property-slot placer">

                        <div class="prop-name-addr">

                            <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/prop-logo.svg" alt=""> </p>

                            <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/flag-icon.png" alt="">  </p>

                        </div>

                        <div class="ps-flex">

                            <!--<div class="mini-flex">-->

                            <div class="gallery-holder">

                                <div id="prop-gallary" class="carousel slide" data-ride="carousel">

                                    <div class="carousel-inner">

                                        <div class="carousel-item active">

                                            <div class="img-holder">

                                                <img src="#" class="img-fluid" alt="">

                                            </div>

                                        </div>

                                    </div>

                                    <ul class="carousel-indicators">

                                        <li data-target="#prop-gallary" data-slide-to="0" class="active">

                                            <img src="#" class="img-fluid" alt="">

                                        </li>

                                    </ul>

                                </div>

                                <div class="prop-overview">

                                    <div class="f-text">

                                        <span> 1 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo "1 Bed";?></span>

                                        <span> 2 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo "1 Bed";?></span>

                                        <span> 3 Bed &nbsp;<i class="fas fa-bed"></i> &nbsp;<?php echo "1 Bed";?></span>

                                    </div>

                                    <p>Alpha Beta Gamma</p>

                                    <h6>Development Info</h6>

                                    Alpha Beta Gamma

                                </div>

                            </div>

                            <div class="prop-info">

                                <div class="d-flex align-items-center justify-content-between">

                                    <h5>Du Val Dynamic Pricing</h5>

                                    <div class="fav">

                                        <a href="#"><i class="far fa-heart"></i> Add To My Fav</a>

                                    </div>

                                </div>

                                <!-- Tab panes -->

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab_Alpha Beta Gamma">

                                        <div class="price mb-4">

                                            <span>Alpha Beta Gamma </span>

                                            <span>Alpha Beta Gamma</span>

                                        </div>

                                        <table>

                                            <tr>

                                                <td>Discount</td>

                                                <td><?php echo "Alpha Beta Gamma";?></td>

                                                <td>&nbsp;</td>

                                                <td>&nbsp;</td>

                                            </tr>

                                            <tr>

                                                <td>Estimated Yield*</td>

                                                <td>From 8%</td>

                                                <td>&nbsp;</td>

                                                <td>&nbsp;</td>

                                            </tr>

                                            <tr>

                                                <td>Days Left</td>

                                                <td><?php echo "Alpha Beta Gamma";?></td>

                                                <td>&nbsp;</td>

                                                <td>&nbsp;</td>

                                            </tr>

                                        </table>

                                    </div>

                                    <div class="tab-pane fade" id="tab2_Alpha Beta Gamma">

                                    </div>

                                </div>

                            </div>

                            <div class="actions">

                                <div class="time-holder">

                                    <p>Time Left to take actions</p>

                                    <div class="timer">

                                        <div data-countdown="2020-12-12" class="count-skin"></div>

                                    </div>

                                </div>

                                <div class="map">

                                    <img src="#" alt=""> Alpha Beta Gamma

                                    <div id="mapAlpha Beta Gamma"></div>

                                </div>

                                <a href="#" class="btn btn-green">Available Properties</a>

                            </div>

                        </div>

                    </div>

                   <?php

                }

                ?>

                <div class="more show-bdays" data-tab="bdays" data-action="show_more" >

                    <a href="#">

                        <i class="fas fa-arrow-to-bottom"></i>

                    </a>

                </div>

                <div class="more all-bdays all-slots" data-tab="bdays" data-action="redirect" >

                    <a href="<?= SITE_BASE_URL;?>Property/Projects.html?country=">

                        view More

                    </a>

                </div>

                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmPfnhPm0JDemtnhAaJGdOldwe8NiKS8w&libraries=places&callback=initAutocomplete" async defer></script>

            </div>

        </div>

    </div>

    <h1 class="hero-title-teal">Improve Your Investments</h1>

    <div class="row four-hero-panels">

        <div class="col-xl-3 col-lg-6">

            <h1 class="hero-title-dark">Run an Investment Analysis</h1>

            <div class="invest-panel">

                <div class="img-holder invester-common-text" style="background-image: url('assets/images/road@2x.png');">

                    <h4 class="text-light">Access a world of property investment data</h4>

                    <a class="btn btn-orange" href="<?= SITE_BASE_URL;?>Portfolio/ProtfolioPropDetails.html?RecentAnalyse=Y">Run an Investment Analysis</a>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-lg-6">

            <h1 class="hero-title-dark">Search Global Residential Data</h1>
            <div class="globe-panel">
                <div class="g-mask px-4">
                    <h4 class="text-light">Access a world of property investment data</h4>
                    <a class="btn btn-orange" href="<?= SITE_BASE_URL;?>Dashboard/Global.html">Search Global Residential Data</a>
                </div>
                <div class="d-flex">
                    <img src="<?= SITE_BASE_URL;?>dashboard/assets/images/globe.png" class="img-fluid globe-img" alt="">
                    <div class="comming-countries">
                        <h6>Comming Soon</h6>
                        <div class="country">
                            <img src="<?= SITE_BASE_URL;?>dashboard/assets/images/usa.png" alt="">
                            <span>USA</span>
                        </div>
                        <div class="country">
                            <img src="<?= SITE_BASE_URL;?>dashboard/assets/images/singapor.png" alt="">
                            <span>Singapore</span>
                        </div>
                        <div class="country">
                            <img src="<?= SITE_BASE_URL;?>dashboard/assets/images/malaysia.png" alt="">
                            <span>Malaysia</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 no-gutters">
                    <div class="col-4 text-center">
                        <a href="<?= SITE_BASE_URL;?>Property/Projects.html?country=2">
                            <img src="<?= SITE_BASE_URL;?>dashboard/assets/images/australia.png" alt="">
                            <span>Australia</span>
                        </a>
                    </div>
                    <div class="col-4 text-center">
                        <a href="<?= SITE_BASE_URL;?>Property/Projects.html?country=1">
                            <img src="<?= SITE_BASE_URL;?>dashboard/assets/images/newzeland.png" alt="">
                            <span>New Zealand</span>
                        </a>
                    </div>
                    <div class="col-4 text-center">
                        <a href="<?= SITE_BASE_URL;?>Property/Projects.html?country=3">
                            <img src="<?= SITE_BASE_URL;?>dashboard/assets/images/united-kingdom.png" alt="">
                            <span>United Kingdom</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">

            <h1 class="hero-title-dark">Analyse My Portfolio</h1>
            <div class="library-panel">

                <div class="img-holder" style="background-image: url('<?= SITE_BASE_URL;?>dashboard/assets/images/analyse-bg.png');">
                    <div class="btns-flex">
                        <h4 class="text-light mb-5 text-center px-3">Access a world of property investment data</h4>
                        <a href="<?= SITE_BASE_URL;?>Portfolio/Portfolio.html" class="btn btn-orange">View My Portfolio</a>
                        <a href="<?= SITE_BASE_URL;?>Portfolio/ProtfolioPropDetails.html?IsProtFolio=Y" class="btn btn-green">Add Property</a>
                    </div>  

                </div>

            </div>
        </div>

        <div class="col-xl-3 col-lg-6">

            <h1 class="hero-title-dark">Search the Library</h1>

            <div class="library-panel">

                <div class="img-holder invester-common-text" style="background-image: url('assets/images/road@2x.png');">
                    
                    <h4 class="text-light">Access a world of property investment data</h4>
                    <a href="<?= SITE_BASE_URL;?>Portfolio/InvestorLibrary.html" class="btn btn-green">View our Investor Library</a>

                </div>

            </div>

        </div>

    </div>

    <div class="row mt-4 report-row">

        <div class="col-xl-9">

            <h1 class="hero-title-dark">Upcoming Property </h1>

            <div class="prop-notification owl-carousel">

                <?php

                $cond2 = " and effective_date > NOW() ";

                \Property\PropertyClass::Init();

                $rows1 = \Property\PropertyClass::GetProjectDatas($cond2);

                $r = 1;

                $post = 0;

                foreach ($rows1 as $row1)

                {

                    $post++;

                    if($post > 3)

                    {

                        $post = 0;

                    }

                    $effective_date             = $row1["effective_date"];

                    $projectName                = $row1["project_name"];
                    
                    $projectuburb               = $row1["country_name"];

                    $projectidUp                = $row1["project_id"];

                    $rowsells = \Property\PropertyClass::ProjectSellingDtl($projectidUp);

                    foreach ($rowsells as $rowsell)

                    {

                        $reservedCount          = $rowsell["reserved_count"];

                        $soldCount              = $rowsell["sold_count"];

                        $totalCount             = $rowsell["total_count"];

                        $AvailableCount         = $totalCount - $reservedCount;

                        $Start_dynamin_price    = $rowsell["Start_dynamin_price"];

                        $AVG_Discount           = round($rowsell["AVG_Discount"]);

                        $Projcurr               = $row["currency"];

                        $property_count         = $row1['total_properties'];

                        if ($Currency == "NZD")

                        {

                            $Prefix="$";

                        }

                        elseif($Currency=="AUD")

                        {

                            $Prefix="$";

                        }

                        elseif($Currency=="GBP")

                        {

                            $Prefix="£";

                        }

                        else if($Currency=="USD")

                        {

                            $Prefix="$";

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

                    $project_description    = $row1["project_description"];

                    $country                = $row1["country_name"];

                    $CountryCodeNew         = $row["Country_Code_New"];

                    $image_file             = $row1["image_file"];

                    $expiry_date            = $row1["expiry_date"];

                    $date                   = date("Y-m-d h:i:s");

                    $effective_date1        = strtotime($effective_date);

                    $expiry_date1           = strtotime($expiry_date);

                    $date1                  = strtotime($date);

                    $diff                   = abs($effective_date1 - $date1);

                    $years                  = floor($diff / (365 * 60 * 60 * 24));

                    $months                 = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));

                    $days                   = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                    $days1                  = floor(($diff - $years * 365 * 60 * 60 * 24) / (60 * 60 * 24));

                    $hours                  = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));

                    $minutes                = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);

                    $seconds                = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));

                    ?>

                    <div class="item">

                        <div class="addeventatc">

                            <div class="pn-box">

                                <h2><?= $projectName . ', ' . $projectuburb; ?></h2>

                                <div class="flex">
                                    <div class="pn-img-holder">
                                        <img src="<?php echo FILE_BASE_URL;?><?php echo $image_file; ?>" class="w-50" alt="">
                                    </div>

                                    <div class="text" >

                                        <span>Strike Prices From: <?php echo $Prefix . " " . number_format(round($askingPrice * $Xrate, 2)); ?></span>

                                        <span>Available: <?php echo $property_count;?></span>

                                        <?php

                                        $from_name = "DU VAL";

                                        $from_address = "info@duvalknowledge.co.nz";

                                        $to_name = $LoginFirstName . ' ' . $LoginLastName;

                                        $to_address = $LoginUserName;

                                        $startTime = date("m/d/Y H:i:s", $effective_date1);

                                        $endTime = date("m/d/Y H:i:s", $expiry_date1);

                                        $subject = "Upcoming Projects " . $projectName;

                                        $description = $projectName . "<br>" . $project_description;

                                        $location = $country;

                                        ?>

                                        

                                            <button class="btn btn-add " onclick="MailEvent('<?php echo $from_name; ?>', '<?php echo $from_address; ?>', '<?php echo $to_name; ?>', '<?php echo $to_address; ?>', '<?php echo $startTime; ?>', '<?php echo $endTime; ?>', '<?php echo $subject; ?>', '<?php //echo $description;?>', '<?php echo $location; ?>');"><i class="fas fa-calendar-alt"></i> Add to My Calendar</button>

                                            <!--<span class="start"><?php echo $effective_date; ?></span>-->

                                            <!--<span class="end"><?php echo $expiry_date; ?></span>-->

                                            <!--<span class="timezone"><?php echo $country; ?></span>-->

                                            <!--<span class="title">Upcoming Project <?php echo $projectName; ?></span>-->

                                            <!--<span class="description"><?php echo $projectName . "<br>" . $description; ?></span>-->

                                        

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <?php

                    $j=$j+1;

                }

                if($post >= 0 )

                {

                    for ($m = $post; $m < 3 ; $m++ )

                    {

                        ?>

                        <div class="item">

                            <div class="pn-box place-holder">
                                
                                <div class="placer-image">
                                    <img src="<?= SITE_BASE_URL; ?>dashboard/assets/images/upcoming-placer.png" alt="">
                                </div>

                                <h2>Rata Terraces</h2>

                                <div class="flex">

                                    <img src="assets/images/pn-placeholder.png" class="w-100" alt="">

                                    <div class="text">

                                        <span>Start Price: $599,000</span>

                                        <span>Available: 101</span>

                                        <button class="btn btn-add"><i class="fas fa-calendar-alt"></i> Add to My Calendar</button>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <?php

                    }

                }

                ?>

            </div>

        </div>

        <div class="col-xl-3 avm-flex">

            <h1 class="hero-title-dark">Automative Valuation Model Report</h1>

            <div class="avm-report">

                <div class="d-flex align-items-center">

                    <div class="text">

                        <h2>NZ & AUS ONLY</h2>

                        <p>Click on the below button to get your Automative Valuation Model Report for your property</p>

                    </div>

                    <img src="assets/images/avm.svg" alt="">

                </div>

                <button class="btn btn-orange">Coming Soon</button>

            </div>

        </div>

    </div>

    <?php

    // echo $TotalNetAnnualReturn;

    // die();

    ?>

    

    <div class="row mt-4">

        <div class="col-xl-4">

            <h1 class="hero-title-dark">My Portfolio</h1>

            <div class="v-panel">

                <div class="text">

                    <div class="tags">

                        <div class="tag-name yellow" id="portfolio_total_debt" onclick="return total_debt('total_debt');">

                            TOTAL DEBT

                        </div>

                        <div class="tag-name" id="portfolio_total_value" onclick="return total_value('total_value');">

                            TOTAL VALUE

                        </div>

                        <div class="tag-name" id="portfolio_roi_yeild" onclick="return roi_yeild('roi_yeild');">

                            ROI/YEILD

                        </div>

                        <div class="tag-name"  id="portfolio_gross_annual_rent"onclick="return gross_annual_rent('gross_annual_rent');">

                            GROSS ANNUAL RENT

                        </div>

                    </div>

                    <?php

                    \Property\PropertyClass::Init();

                    $summaryPortfolio = \Property\PropertyClass::GetPropertyComparison("","","","","");

                    // echo "<pre>";

                    $i = 1;

                    foreach($summaryPortfolio as $pf_prop)

                    {

                        $autoid         = $pf_prop["autoid"] ;

                        $CountryId      = $pf_prop["country_id"] ;

                        $propertyid     = $pf_prop["property_id"] ;

                        $propertyname   = $pf_prop["property_name"] ;

                        $currtemp       = $pf_prop["baseCur"]  ? $pf_prop["baseCur"] : "NZD" ;

                        $UsdExRateArr =  \Property\PropertyClass::GetCurrExrate($currentCurrency,$currtemp);

                        foreach($UsdExRateArr as $UsdEx)

                        {

                            $UsdExRate = $UsdEx["RATE"] ? $UsdEx["RATE"] :"1";

                        }

                        if ($UsdExRate == "")

                        {

                            $UsdExRate = 1;

                        }

                        \ajax\ajaxClass::Init();

                        $Prop                       = \ajax\ajaxClass::AnalyzerResult($autoid,"ARRAY");

                        $GrossIncome                = floatval($Prop[1]["GrossIncome"]) / floatval($UsdExRate) ;

                        $OperatigExpTotal           = floatval($Prop[1]["OperatigExpTotal"]) / floatval($UsdExRate) ;

                        $PropertyValue              = floatval($Prop[1]["PropertyValue"]) / floatval($UsdExRate);

                        $weeklyrental               = $Prop["weeklyrental"]              ? $Prop["weeklyrental"]              : "0"; 

                        $NetAnnualReturn            = $GrossIncome - $OperatigExpTotal;

                        $TotalNetAnnualReturn       = floatval($TotalNetAnnualReturn)  + ($NetAnnualReturn);

                        $TotalPropertyValue         = floatval($TotalPropertyValue)  + floatval($PropertyValue);

                        $TotalGrossIncome           = floatval($TotalGrossIncome)  + ($GrossIncome);

                        $Totalweeklyrental          = floatval($Totalweeklyrental) + floatval($weeklyrental) ;

                        $NetCashFlowAfterTax        = floatval($Prop[1]["NetCashFlowAfterTax"]) / floatval($UsdExRate) ;

                        $TotalInitialCashCost       = floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate);

                         if($TotalInitialCashCost>0){

                            $ROI    = ($NetCashFlowAfterTax / $TotalInitialCashCost)* 100 ;

                        } else {

                            $ROI    = "0" ;

                        }

                        $TotalYieldroi              = $TotalYieldroi + $ROI;

                        $i++;

                    }

                    // echo $TotalNetAnnualReturn;

                    // die();

                    ?>

                    <div class="amount">

                        <div id="total_debt">

                            <span class="big">[</span>

                            <?= $Prefix . number_format($TotalNetAnnualReturn,0); ?>

                            <span class="big">]</span>

                        </div>

                        <div id="total_value" style="display:none;">

                            <span class="big">[</span>

                            <?= $Prefix . number_format($TotalPropertyValue,0); ?>

                            <span class="big">]</span>

                        </div>

                        <?php

                        $Totalrentperweek = floatval($Totalweeklyrental) * 53;

                        $PropList = floatval($i)-1;

                        // echo "<script>alert('".$TotalPropertyValue."');</script>";

                        if ( floatval($TotalPropertyValue) > 0)

                        {

                            $Totalportfoliogrowth = floatval($Totalportfoliogrowth) / floatval($PropList);

                        }

                        else

                        {

                            $Totalportfoliogrowth = 0;

                        }

                        if ( floatval($TotalYieldroi) > 0 && $PropList > 0)

                        {

                           $TotalYieldroi  = $TotalYieldroi / $PropList;

                        }

                        ?>

                        <div id="roi_yeild" style="display:none;">

                            <span class="big">[</span>

                            %  <?=  number_format($TotalYieldroi,2); ?>

                            <span class="big">]</span>

                        </div>

                        <div id="gross_annual_rent" style="display:none;">

                            <span class="big">[</span>

                            <?= $Prefix . number_format($TotalGrossIncome,0); ?>

                            <span class="big">]</span>

                        </div>

                    </div>

                    <button class="btn btn-detail">More Details</button>

                </div>

            </div>

        </div>

        <script>

            function total_debt(name){

                document.getElementById("portfolio_total_debt").classList.add("yellow");

                document.getElementById("portfolio_total_value").classList.remove("red");

                document.getElementById("portfolio_roi_yeild").classList.remove("green");

                document.getElementById("portfolio_gross_annual_rent").classList.remove("blue");

                document.getElementById("total_debt").style.display = "block";

                document.getElementById("total_value").style.display = "none";

                document.getElementById("roi_yeild").style.display = "none";

                document.getElementById("gross_annual_rent").style.display = "none";

            }

            function total_value(name){

                document.getElementById("portfolio_total_debt").classList.remove("yellow");

                document.getElementById("portfolio_total_value").classList.add("red");

                document.getElementById("portfolio_roi_yeild").classList.remove("green");

                document.getElementById("portfolio_gross_annual_rent").classList.remove("blue");

                document.getElementById("total_value").style.display = "block";

                document.getElementById("total_debt").style.display = "none";

                document.getElementById("roi_yeild").style.display = "none";

                document.getElementById("gross_annual_rent").style.display = "none";

            }

            function roi_yeild(name){

                document.getElementById("portfolio_total_debt").classList.remove("yellow");

                document.getElementById("portfolio_total_value").classList.remove("red");

                document.getElementById("portfolio_roi_yeild").classList.add("green");

                document.getElementById("portfolio_gross_annual_rent").classList.remove("blue");

                document.getElementById("roi_yeild").style.display = "block";

                document.getElementById("total_value").style.display = "none";

                document.getElementById("total_debt").style.display = "none";

                document.getElementById("gross_annual_rent").style.display = "none";

            }

            function gross_annual_rent(name){

                document.getElementById("portfolio_total_debt").classList.remove("yellow");

                document.getElementById("portfolio_total_value").classList.remove("red");

                document.getElementById("portfolio_roi_yeild").classList.remove("green");

                document.getElementById("portfolio_gross_annual_rent").classList.add("blue");

                document.getElementById("gross_annual_rent").style.display = "block";

                document.getElementById("total_value").style.display = "none";

                document.getElementById("roi_yeild").style.display = "none";

                document.getElementById("total_debt").style.display = "none";

            }

        </script>

        <div class="col-xl-4">

            <h1 class="hero-title-dark">My Contracted Property</h1>

            <div class="v-panel v-placer">
    
                <div class="v-placer-image">
                    <img src="<?= SITE_BASE_URL; ?>dashboard/assets/images/upcoming-placer.png" alt=>
                </div>

                <div class="text d-none">

                    <!--<div class="tags">-->

                    <!--    <div class="tag-name yellow" id="portfolio_total_debt2" onclick="return total_debt2('total_debt');">-->

                    <!--        TOTAL DEBT-->

                    <!--    </div>-->

                    <!--    <div class="tag-name" id="portfolio_total_value2" onclick="return total_value2('total_value');">-->

                    <!--        TOTAL VALUE-->

                    <!--    </div>-->

                    <!--    <div class="tag-name" id="portfolio_roi_yeild2" onclick="return roi_yeild2('roi_yeild');">-->

                    <!--        ROI/YEILD-->

                    <!--    </div>-->

                    <!--    <div class="tag-name"  id="portfolio_gross_annual_rent2"onclick="return gross_annual_rent2('gross_annual_rent');">-->

                    <!--        GROSS ANNUAL RENT-->

                    <!--    </div>-->

                    <!--</div>-->

                   <div class="amount">

                        <div id="total_debt2">

                            <span>Still Looking</span>

                        </div>

                   <div class="d-none">
                            <div id="total_value2" style="display:none;">
    
                                <span class="big">[</span>
    
                                <?= $Prefix . number_format($TotalPropertyValue,0); ?>
    
                                <span class="big">]</span>
    
                            </div>
    
                            <?php
    
                            $Totalrentperweek = floatval($Totalweeklyrental) * 53;
    
                            $PropList = floatval($i)-1;
    
                            if ( floatval($TotalPropertyValue) > 0)
    
                            {
    
                                $Totalportfoliogrowth = floatval($Totalportfoliogrowth) / floatval($PropList);
    
                            }
    
                            else
    
                            {
    
                                $Totalportfoliogrowth = 0;
    
                            }
    
                            if ( floatval($TotalYieldroi) > 0 && $PropList > 0)
    
                            {
    
                               $TotalYieldroi  = $TotalYieldroi / $PropList;
    
                            }
    
                            ?>
    
                            <div id="roi_yeild2" style="display:none;">
    
                                <span class="big">[</span>
    
                                %  <?=  number_format($TotalYieldroi,2); ?>
    
                                <span class="big">]</span>
    
                            </div>
    
                            <div id="gross_annual_rent2" style="display:none;">
    
                                <span class="big">[</span>
    
                                <?= $Prefix . number_format($TotalGrossIncome,0); ?>
    
                                <span class="big">]</span>
    
                            </div>
    
                        </div>
                    
                    </div>

                </div>

                <script>

            function total_debt2(name){

                document.getElementById("portfolio_total_debt2").classList.add("yellow");

                document.getElementById("portfolio_total_value2").classList.remove("red");

                document.getElementById("portfolio_roi_yeild2").classList.remove("green");

                document.getElementById("portfolio_gross_annual_rent2").classList.remove("blue");

                document.getElementById("total_debt2").style.display = "block";

                document.getElementById("total_value2").style.display = "none";

                document.getElementById("roi_yeild2").style.display = "none";

                document.getElementById("gross_annual_rent2").style.display = "none";

            }

            function total_value2(name){

                document.getElementById("portfolio_total_debt2").classList.remove("yellow");

                document.getElementById("portfolio_total_value2").classList.add("red");

                document.getElementById("portfolio_roi_yeild2").classList.remove("green");

                document.getElementById("portfolio_gross_annual_rent2").classList.remove("blue");

                document.getElementById("total_value2").style.display = "block";

                document.getElementById("total_debt2").style.display = "none";

                document.getElementById("roi_yeild2").style.display = "none";

                document.getElementById("gross_annual_rent2").style.display = "none";

            }

            function roi_yeild2(name){

                document.getElementById("portfolio_total_debt2").classList.remove("yellow");

                document.getElementById("portfolio_total_value2").classList.remove("red");

                document.getElementById("portfolio_roi_yeild2").classList.add("green");

                document.getElementById("portfolio_gross_annual_rent2").classList.remove("blue");

                document.getElementById("roi_yeild2").style.display = "block";

                document.getElementById("total_value2").style.display = "none";

                document.getElementById("total_debt2").style.display = "none";

                document.getElementById("gross_annual_rent2").style.display = "none";

            }

            function gross_annual_rent2(name){

                document.getElementById("portfolio_total_debt2").classList.remove("yellow");

                document.getElementById("portfolio_total_value2").classList.remove("red");

                document.getElementById("portfolio_roi_yeild2").classList.remove("green");

                document.getElementById("portfolio_gross_annual_rent2").classList.add("blue");

                document.getElementById("gross_annual_rent2").style.display = "block";

                document.getElementById("total_value2").style.display = "none";

                document.getElementById("roi_yeild2").style.display = "none";

                document.getElementById("total_debt2").style.display = "none";

            }

        </script>

            </div>

        </div>
        <div class="col-xl-4">
            <h1 class="hero-title-dark">My Reserved Property</h1>
            <div class="v-panel">
                <div class="v-placer-image d-none" <?= ($TotalPropertyValue > 0) ? 'style="display:none;"': ''?> >
                    <img src="<?= SITE_BASE_URL; ?>dashboard/assets/images/upcoming-placer.png" alt=>
                </div>
                <div class="text"  <?= ($TotalPropertyValue > 0) ? '': 'style="display:none;"'?>>
                    <div class="tags">
                        <div class="tag-name yellow" id="portfolio_total_debt3" onclick="return total_debt3('total_debt');"> TOTAL DEBT </div>
                        <div class="tag-name" id="portfolio_total_value3" onclick="return total_value3('total_value');"> TOTAL VALUE </div>
                        <div class="tag-name" id="portfolio_roi_yeild3" onclick="return roi_yeild3('roi_yeild');"> ROI/YEILD </div>
                        <div class="tag-name"  id="portfolio_gross_annual_rent3"onclick="return gross_annual_rent3('gross_annual_rent');"> GROSS ANNUAL RENT </div>
                    </div>
                   <div class="amount">
                        <div class="">
                            <div id="total_debt3"><span class="big">[</span><?= $Prefix . number_format($TotalNetAnnualReturn,0); ?><span class="big">]</span></div>
                            <div id="total_value3" style="display:none">
                                <span class="big">[</span> <?= $Prefix . number_format($TotalPropertyValue,0); ?> <span class="big">]</span>
                            </div>
                            <?php
                            $Totalrentperweek = floatval($Totalweeklyrental) * 53;
                            $PropList = floatval($i)-1;
                            if ( floatval($TotalPropertyValue) > 0)
                            {
                                $Totalportfoliogrowth = floatval($Totalportfoliogrowth) / floatval($PropList);
                            }
                            else
                            {
                                $Totalportfoliogrowth = 0;
                            }
                            if ( floatval($TotalYieldroi) > 0 && $PropList > 0)
                            {
                               $TotalYieldroi  = $TotalYieldroi / $PropList;
                            }
                            ?>
                            <div id="roi_yeild3" style="display:none" ><span class="big">[</span> % <?= number_format($TotalYieldroi,2); ?><span class="big">]</span></div>
                            <div id="gross_annual_rent3" style="display:none" ><span class="big">[</span> <?= $Prefix . number_format($TotalGrossIncome,0); ?> <span class="big">]</span></div>
                        </div>
                    </div>
                </div>
                <script>
                    function total_debt3(name)
                    {
                        document.getElementById("portfolio_total_debt3").classList.add("yellow");
                        document.getElementById("portfolio_total_value3").classList.remove("red");
                        document.getElementById("portfolio_roi_yeild3").classList.remove("green");
                        document.getElementById("portfolio_gross_annual_rent3").classList.remove("blue");
                        document.getElementById("total_debt3").style.display = "block";
                        document.getElementById("total_value3").style.display = "none";
                        document.getElementById("roi_yeild3").style.display = "none";
                        document.getElementById("gross_annual_rent3").style.display = "none";
                    }
                    function total_value3(name)
                    {
                        document.getElementById("portfolio_total_debt3").classList.remove("yellow");
                        document.getElementById("portfolio_total_value3").classList.add("red");
                        document.getElementById("portfolio_roi_yeild3").classList.remove("green");
                        document.getElementById("portfolio_gross_annual_rent3").classList.remove("blue");
                        document.getElementById("total_value3").style.display = "block";
                        document.getElementById("total_debt3").style.display = "none";
                        document.getElementById("roi_yeild3").style.display = "none";
                        document.getElementById("gross_annual_rent3").style.display = "none";
                    }
                    function roi_yeild3(name)
                    {
                        document.getElementById("portfolio_total_debt3").classList.remove("yellow");
                        document.getElementById("portfolio_total_value3").classList.remove("red");
                        document.getElementById("portfolio_roi_yeild3").classList.add("green");
                        document.getElementById("portfolio_gross_annual_rent3").classList.remove("blue");
                        document.getElementById("roi_yeild3").style.display = "block";
                        document.getElementById("total_value3").style.display = "none";
                        document.getElementById("total_debt3").style.display = "none";
                        document.getElementById("gross_annual_rent3").style.display = "none";
                    }
                    function gross_annual_rent3(name)
                    {
                        document.getElementById("portfolio_total_debt3").classList.remove("yellow");
                        document.getElementById("portfolio_total_value3").classList.remove("red");
                        document.getElementById("portfolio_roi_yeild3").classList.remove("green");
                        document.getElementById("portfolio_gross_annual_rent3").classList.add("blue");
                        document.getElementById("gross_annual_rent3").style.display = "block";
                        document.getElementById("total_value3").style.display = "none";
                        document.getElementById("roi_yeild3").style.display = "none";
                        document.getElementById("total_debt3").style.display = "none";
                    }
                </script>
            </div>
        </div>

    </div>

    <div class="row mt-4">

        <div class="col-12">

            <h1 class="hero-title-dark">My Favorite Projects</h1>

        </div>

        <div class="col-12">

            <div class="fav-panel">

                <div class="row">

                    <div class="col-12">

                        <div class="fprop-slider owl-carousel">

                        <?php

                        $condFavPj=" AND pj.project_id in (Select project_id from Add_favorite_project where user_id='".$LoginUserId."') ";

                        $rowFavs = \Property\PropertyClass::GetPorjectDatas('','',$condFavPj);

                        $p = 1;

                        $post = 0;

                        foreach ($rowFavs as $rowFav)

                        {

                             $post++;

                    

                            if($post == 4)

                            {

                                $post = 0;

                            }

                            $rowFavsells = \Property\PropertyClass::ProjectSellingDtl($rowFav["PROJECT_ID"]);

                            $effective_date=$rowFav["effective_date"];

                            $Country=$rowFav["country_name"];

                            $CountryCodeNew=$row["Country_Code_New"];

                            $expiry_date=$rowFav["expiry_date"];

                            $date = date("Y-m-d h:i:s");

                            $effective_date1 = strtotime($effective_date);

                            $expiry_date1 = strtotime($expiry_date);

                            $date1 = strtotime($date);

                            $diff = abs($expiry_date1 - $date1);

                            $createDate = new DateTime($expiry_date);

                            $strip = $createDate->format('Y-m-d');

                            $years = floor($diff / (365*60*60*24));

                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                            $days1 = floor(($diff - $years * 365*60*60*24 )/ (60*60*24));

                            $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));

                            $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);

                            $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));

                            foreach ($rowFavsells as $rowFavsell)

                            {

                                $reservedCount=$rowFavsell["reserved_count"];

                                $soldCount=$rowFavsell["sold_count"];

                                $totalCount=$rowFavsell["total_count"];

                                $AvailableCount=$totalCount-$reservedCount;

                                $Start_dynamin_price=$rowFavsell["Start_dynamin_price"];

                                $AVG_Discount=round($rowFavsell["AVG_Discount"]);

                                $one_bet=$rowFavsell["one_bet"];

                                $two_bet=$rowFavsell["two_bet"];

                                $three_bet=$rowFavsell["three_bet"];

                                $Weekly_rent=$rowFavsell["Weekly_rent"];

                                $Projcurr=$rowFav["currency"];

                                if($Currency=="NZD")

                                {

                                    $Prefix="$";

                                }

                                elseif($Currency=="AUD")

                                {

                                    $Prefix="$";

                                }

                                elseif($Currency=="GBP")

                                {

                                    $Prefix="£";

                                }

                                else if($Currency=="USD")

                                {

                                    $Prefix="$";

                                }

                                else

                                {

                                    $Prefix=$Currency." ";

                                }

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

                                    foreach ($Xraterows as $Xraterow)

                                    {

                                       $Xrate=$Xraterow["RATE"];

                                    }

                                }

                                if($Xrate=="" || $Xrate==null)

                                {

                                    $Xrate=1;

                                }

                            }
                            $noOfProperties = $rowFav['NO_OF_PROPERTY'];
                    $PropCount = \Property\PropertyClass::GetReservedPreperties($rowFav['PROJECT_ID']);
                    foreach ($PropCount as $cnt) {
                        $noOfreserved = $cnt['count'];
                    }
                            $rowMinValues  = \Property\PropertyClass::get_lowest_property($rowFav['PROJECT_ID']);
                            foreach($rowMinValues as $minVal)
                            {
                                $askingPrice    = $minVal['asking_price'];
                                $atrikePrice    = $minVal['strike_price'];
                                $dynamicPrice   = $minVal['dynamic_price'];
                                $start_price    = $minVal['start_price'];
                                $grossYeild     = $minVal['gross_yeild'];
                                $dynamic_price  = number_format(round(($askingPrice - (($askingPrice - $start_price) * $noOfreserved / $noOfProperties)))*$Xrate,0);
                                $AVG_Discount   = $askingPrice - $dynamic_price;
                            }

                            ?> 

                            <div class="item">

                                <h3><?= $rowFav["PROJECT_NAME"].' | '.$rowFav["subrub"];?></h3>

                                <div class="fav-img-holder">

                                    <img src="<?php echo FILE_BASE_URL; ?><?php echo $rowFav["image_file"];?>" class="w-100" alt="">

                                </div>

                                <table>

                                    <tbody>
                                        <tr>
                                            <td>Retail Asking Price From</td>
                                            <td><?php echo $Prefix." ".number_format(round($askingPrice*$Xrate));?></td>
                                        </tr>
                                        <tr>
                                            <td>Strike Price From</td>
                                            <td><?php echo $Prefix." ".number_format(round($strikePrice*$Xrate));?></td>
                                        </tr>
                                        <tr>
                                            <td>Current DU VAL Dynamic Price From</td>
                                            <td><?php echo $Prefix." ".number_format(round($dynamicPrice*$Xrate));?></td>
                                        </tr>
                                        <tr>
                                            <td>Estimated Gross Yields From</td>
                                            <td><?= ($grossYeild > 0 && $grossYeild != null && $grossYeild != '') ? $grossYeild : '0'; ?>%</td>
                                        </tr>
                                        <tr>
                                            <td>Days Left To Closing</td>
                                            <td><?= $days1; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Reserved</td>
                                            <td>
                                                <?php echo $reservedCount;?> / Available <?= $totalCount - $reservedCount;?>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: <?php echo round(($reservedCount/$totalCount)*100);?>%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>

                                <div class="d-flex justify-content-between">

                                    <a href="<?= SITE_BASE_URL;?>Property/ProjectView.html?project_id=<?php echo $rowFav["PROJECT_ID"];?>" class="btn btn-green">More Info</a>

                                    <a href="<?= SITE_BASE_URL;?>Property/delete_favourite_project.html?id=<?php echo $rowFav["PROJECT_ID"];?>&user=<?= $LoginUserId;?>" class="btn btn-orange">Remove</a>

                                </div>

                            </div>

                            <?php

                            $p=$p+1;

                        }

                        if($post > 0)

                        {

                            for ($i = $post; $i < 4 ; $i++ )

                            {

                            ?>

                            <div class="item placeholder-box">
                                
                                <div class="placer-image">
                                    <img src="<?= SITE_BASE_URL; ?>dashboard/assets/images/fav-project-placer.png" alt=>
                                </div>

                                <h3>McKenzie Terraces</h3>

                                <img src="<?= SITE_BASE_URL; ?>dashboard/assets/img/placeholderimg.png" class="w-100" alt="">

                                <table>

                                    <tbody>
                                        <tr>
                                            <td>Retail Asking Price From</td>
                                            <td>2323342</td>
                                        </tr>
                                        <tr>
                                            <td>Strike Price From</td>
                                            <td>13242342</td>
                                        </tr>
                                        <tr>
                                            <td>Current DU VAL Dynamic Price From</td>
                                            <td>32323</td>
                                        </tr>
                                        <tr>
                                            <td>Estimated Gross Yield</td>
                                            <td>4%</td>
                                        </tr>
                                        <tr>
                                            <td>Days Left To Closing</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>Reserve</td>
                                            <td>
                                                1
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 50%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>

                                <div class="d-flex justify-content-between">

                                    <a href="https://duvalknowledge.com/new-dpo/Property/ProjectView.html?project_id=2" class="btn btn-green">More Info</a>

                                </div>

                            </div>

                            <?php

                            }

                        }

                        if($p==1)

                        {

                            echo "<div><b>No Records</b></div>";

                        }

                        ?> 

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-12">

            <h1 class="hero-title-dark">My Favourite Properties</h1>

        </div>

        <div class="col-12">

            <div class="fav-panel">

                <div class="row">

                    <div class="col-12">

                        <div class="fprop-slider owl-carousel">

                        <?php

                        $condFav=" and pd.property_id in (Select property_id from Add_favorite_property where user_id='".$LoginUserId."') ";

                        \Property\PropertyClass::Init();

                        $rows1 = \Property\PropertyClass::GetPropertiesDatas('','',$condFav);

                        $k = 1;

                        $post                       = 0;
                        // echo "<pre>";
                        foreach ($rows1 as $row1)

                        {
                            // print_r($row1);
                           $post++;

                            if($post > 4)

                            {

                                $post = 0;

                            }

                            

                            $effective_date     = $row1["effective_date"];

                            $projectName        = $row1["project_name"];

                            $country            = $row1["country"];

                            $strike_price       = $row1["strike_price"];

                            $CountryCodeNew     = $row1["Country_Code_New"];

                            $ProjectIdd         = $row1["project_id"];

                            $floortype          = $row1["floor_type"];

                            $CountryName        = $row1["COUNTRY_NAME"];

                            $Projectcurrency    = $row1["currency"];

                            $expiry_date        = $row1["expiry_date"];

                            $NoOfProperty       = $row1["No_of_property"];

                            $NoOfAvProperty     = $row1["No_of_Av_property"];

                            $image_file         = $row1["image_file"];

                            if($Currency==$Projectcurrency)

                            {

                                $Xrate=1;

                            }

                            else

                            {

                               $Xraterows = \Property\PropertyClass::GetCurrExrate($Projectcurrency,$Currency);

                               //$j = 1;

                               foreach ($Xraterows as $Xraterow)

                               {

                                   $Xrate=$Xraterow["RATE"];

                               }

                            }

                            if($Xrate=="" || $Xrate==null){

                              $Xrate=1;

                            }

                            $date               = date("Y-m-d h:i:s");

                            $effective_date1    = strtotime($effective_date);

                            $expiry_date1       = strtotime($expiry_date);

                            $date1              = strtotime($date);

                            $diff               = abs($expiry_date1 - $date1);

                            $createDate         = new DateTime($expiry_date);

                            $strip              = $createDate->format('Y-m-d');

                            $years              = floor($diff / (365*60*60*24));

                            $months             = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

                            $days               = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                            $days1              = floor(($diff - $years * 365*60*60*24)/ (60*60*24));

                            $hours              = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));

                            $minutes            = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);

                            $seconds            = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));

                            if($Currency=="NZD")

                            {

                                $Prefix="$";

                            }

                            elseif($Currency=="AUD")

                            {

                                $Prefix="$";

                            }

                            elseif($Currency=="GBP")

                            {

                                $Prefix="£";

                            }

                            else if($Currency=="USD")

                            {

                                $Prefix="$";

                            }

                            else

                            {

                                $Prefix=$Currency." ";

                            }

                            ?>

                            <div class="item">

                                <h3><?php echo $projectName.' | '.$row1["subrub"];?> | <?php echo $CountryName;?></h3>

                                <div class="fav-img-holder">

                                    <img src="<?php echo FILE_BASE_URL; ?><?php echo $image_file; ?>" class="w-100" alt="">

                                </div>

                                <table>

                                    <tbody>

                                        <tr>

                                            <td>Retail Asking Price:</td>

                                            <td><?php echo $Prefix." ".number_format(round($row1['rate']));?></td>

                                        </tr>

                                        <tr>

                                            <td>Strike Price</td>

                                            <td><?php echo $Prefix." ".number_format(round($strike_price));?></td>

                                        </tr>

                                        <tr>

                                            <td>Current DU VAL Dynamic Price</td>

                                            <td><?php echo $Prefix." ".number_format(round($row1["dynamic_rate"]*$Xrate,2));?></td>

                                        </tr>
                                        
                                        <tr>

                                            <td>Estimated Gross Yield</td>

                                            <td><?php echo $row1['gross_yield'];?>%</td>

                                        </tr>
                                        
                                        <tr>

                                            <td>Days Left to Closing</td>

                                            <td><?php echo $days1; ?></td>

                                        </tr>

                                    </tbody>

                                </table>

                                <div class="d-flex justify-content-between">

                                    <a href="<?php echo SITE_BASE_URL; ?>Property/PropertyFullDtl.html?id=<?php echo $row1["property_id"]; ?>"><button class="btn btn-green">Analyse</button></a>
                                    <a href="<?php echo SITE_BASE_URL; ?>Property/ProjectView.html?project_id=<?= $ProjectIdd; ?>"><button class="btn btn-default">More info</button></a>
                                    
                                    <a href="<?= SITE_BASE_URL;?>Property/delete_favourite_property.html?id=<?php echo $row1["property_id"];?>&user=<?= $LoginUserId;?>" class="btn btn-orange">Remove</a>

                                </div>

                            </div>

                            <?php

                            $k=$k+1;

                            $j=$j+1;

                        }

                        

                        if($post >= 0 )

                        {

                            for ($m = $post; $m < 4 ; $m++ )

                            {

                                ?>

                                <div class="item placeholder-box">
                                    
                                    <div class="placer-image">
                                        <img src="<?= SITE_BASE_URL; ?>dashboard/assets/images/fav-property-placer.png" alt=>
                                    </div>

                                    <h3>Alpha Beta</h3>

                                    <img src="<?= SITE_BASE_URL; ?>dashboard/assets/img/placeholderimg.png" class="w-100" alt="">

                                    <table>

                                        <tbody>

                                            <tr>

                                                <td>Country</td>

                                                <td>Alpha Beta</td>

                                            </tr>

                                            <tr>

                                                <td>City</td>

                                                <td>Alpha Beta</td>

                                            </tr>

                                            <tr>

                                                <td>Annual Income</td>

                                                <td>$120</td>

                                            </tr>

                                            <tr>

                                                <td>Market Value (E)</td>

                                                <td>$190</td>

                                            </tr>

                                            <tr>

                                                <td>Gross Yield</td>

                                                <td>5%</td>

                                            </tr>

                                        </tbody>

                                    </table>

                                    <div class="d-flex justify-content-between">

                                        <a href="#"><button class="btn btn-green">Analyse</button></a>

                                        <a href="#" class="btn btn-orange">Remove</a>

                                    </div>

                                </div>

                                <?php

                            }

                        }

                        ?>            

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!--<div class="row mt-4">-->

    <!--    <div class="col-12">-->

    <!--        <h1 class="hero-title-dark">Recently viewed Properties</h1>-->

    <!--    </div>-->

    <!--    <div class="col-12">-->

    <!--        <div class="viewed-panel">-->

    <!--            <div class="row">-->

    <!--                <div class="col-xl-3 col-md-6">-->

    <!--                    <h3>Avenue Apartments | Auckland , New Zealand</h3>-->

    <!--                    <p>-->

    <!--                        <i class="fas fa-bed"></i> <span>1 Bed</span> <i class="fal fa-car"></i> 1 Car Park <i class="fal fa-bath"></i> 1 Bath-->

    <!--                    </p>-->

    <!--                    <div class="d-flex alig-items-start">-->

    <!--                        <img src="assets/images/rv.png" alt="">-->

    <!--                        <div class="text">-->

    <!--                            <div class="slot">-->

    <!--                                <span>Retail Asking Price</span>-->

    <!--                                <span>NZ $550,000</span>-->

    <!--                            </div>-->

    <!--                            <div class="slot">-->

    <!--                                <span>Strike Price</span>-->

    <!--                                <span>NZ $520,450</span>-->

    <!--                            </div>-->

    <!--                            <div class="slot">-->

    <!--                                <span>Discount</span>-->

    <!--                                <span>8.8%</span>-->

    <!--                            </div>-->

    <!--                            <div class="progress">-->

    <!--                                <div class="progress-bar" style="width:80%"></div>-->

    <!--                            </div>-->

    <!--                            <div class="prog-text d-flex justify-content-between">-->

    <!--                                <span>Reserved 80</span>-->

    <!--                                <span>Available 20</span>-->

    <!--                            </div>-->

    <!--                        </div>-->

    <!--                    </div>-->

    <!--                </div>-->

    <!--                <div class="col-xl-3 col-md-6">-->

    <!--                    <h3>Avenue Apartments | Auckland , New Zealand</h3>-->

    <!--                    <p>-->

    <!--                        <i class="fas fa-bed"></i> <span>1 Bed</span> <i class="fal fa-car"></i> 1 Car Park <i class="fal fa-bath"></i> 1 Bath-->

    <!--                    </p>-->

    <!--                    <div class="d-flex alig-items-start">-->

    <!--                        <img src="assets/images/rv.png" alt="">-->

    <!--                        <div class="text">-->

    <!--                            <div class="slot">-->

    <!--                                <span>Retail Asking Price</span>-->

    <!--                                <span>NZ $550,000</span>-->

    <!--                            </div>-->

    <!--                            <div class="slot">-->

    <!--                                <span>Strike Price</span>-->

    <!--                                <span>NZ $520,450</span>-->

    <!--                            </div>-->

    <!--                            <div class="slot">-->

    <!--                                <span>Discount</span>-->

    <!--                                <span>8.8%</span>-->

    <!--                            </div>-->

    <!--                            <div class="progress">-->

    <!--                                <div class="progress-bar" style="width:80%"></div>-->

    <!--                            </div>-->

    <!--                            <div class="prog-text d-flex justify-content-between">-->

    <!--                                <span>Reserved 80</span>-->

    <!--                                <span>Available 20</span>-->

    <!--                            </div>-->

    <!--                        </div>-->

    <!--                    </div>-->

    <!--                </div>-->

    <!--                <div class="col-xl-3 col-md-6">-->

    <!--                    <h3>Avenue Apartments | Auckland , New Zealand</h3>-->

    <!--                    <p>-->

    <!--                        <i class="fas fa-bed"></i> <span>1 Bed</span> <i class="fal fa-car"></i> 1 Car Park <i class="fal fa-bath"></i> 1 Bath-->

    <!--                    </p>-->

    <!--                    <div class="d-flex alig-items-start">-->

    <!--                        <img src="assets/images/rv.png" alt="">-->

    <!--                        <div class="text">-->

    <!--                            <div class="slot">-->

    <!--                                <span>Retail Asking Price</span>-->

    <!--                                <span>NZ $550,000</span>-->

    <!--                            </div>-->

    <!--                            <div class="slot">-->

    <!--                                <span>Strike Price</span>-->

    <!--                                <span>NZ $520,450</span>-->

    <!--                            </div>-->

    <!--                            <div class="slot">-->

    <!--                                <span>Discount</span>-->

    <!--                                <span>8.8%</span>-->

    <!--                            </div>-->

    <!--                            <div class="progress">-->

    <!--                                <div class="progress-bar" style="width:80%"></div>-->

    <!--                            </div>-->

    <!--                            <div class="prog-text d-flex justify-content-between">-->

    <!--                                <span>Reserved 80</span>-->

    <!--                                <span>Available 20</span>-->

    <!--                            </div>-->

    <!--                        </div>-->

    <!--                    </div>-->

    <!--                </div>-->

    <!--                <div class="col-xl-3 col-md-6">-->

    <!--                    <h3>Avenue Apartments | Auckland , New Zealand</h3>-->

    <!--                    <p>-->

    <!--                        <i class="fas fa-bed"></i> <span>1 Bed</span> <i class="fal fa-car"></i> 1 Car Park <i class="fal fa-bath"></i> 1 Bath-->

    <!--                    </p>-->

    <!--                    <div class="d-flex alig-items-start">-->

    <!--                        <img src="assets/images/rv.png" alt="">-->

    <!--                        <div class="text">-->

    <!--                            <div class="slot">-->

    <!--                                <span>Retail Asking Price</span>-->

    <!--                                <span>NZ $550,000</span>-->

    <!--                            </div>-->

    <!--                            <div class="slot">-->

    <!--                                <span>Strike Price</span>-->

    <!--                                <span>NZ $520,450</span>-->

    <!--                            </div>-->

    <!--                            <div class="slot">-->

    <!--                                <span>Discount</span>-->

    <!--                                <span>8.8%</span>-->

    <!--                            </div>-->

    <!--                            <div class="progress">-->

    <!--                                <div class="progress-bar" style="width:80%"></div>-->

    <!--                            </div>-->

    <!--                            <div class="prog-text d-flex justify-content-between">-->

    <!--                                <span>Reserved 80</span>-->

    <!--                                <span>Available 20</span>-->

    <!--                            </div>-->

    <!--                        </div>-->

    <!--                    </div>-->

    <!--                </div>-->

    <!--            </div>-->

    <!--        </div>-->

    <!--    </div>-->

    <!--</div>-->



            </div>

            <!-- Inner Content End-->



        </div>

        <!-- Right Wrapper End -->

<?php include"footer.php"; ?>

<script>

    function addToFavourite(proId,user_id, elemen_id)
    {
        URL = "<?= SITE_BASE_URL;?>Property/AddToFavorite.html?ProjectId="+ proId +"&UserId="+ user_id,
        $.ajax({url: URL, success: function (result) {
            $("#"+elemen_id).html('<a href="javascript:void(0);" onclick="removeFromFavourite(\'' + proId + '\',\'' + user_id + '\', \'' + elemen_id + '\')"><i class="fas fa-heart"></i> Remove From My Favourites</a>');
        }
        });

    }
    function removeFromFavourite(proId,user_id, elemen_id){

        URL = "<?= SITE_BASE_URL;?>Property/RemoveFavorite.html?ProjectId="+ proId +"&UserId="+ user_id,
        $.ajax({url: URL, success: function (result) {
            $("#"+elemen_id).html('<a href="javascript:void(0);" onclick="addToFavourite(\'' + proId + '\',\'' + user_id + '\', \'' + elemen_id + '\')"><i class="far fa-heart"></i> Add To My Favourites</a>');
            }
        });
    }

   function compareCurrencyFn(){

    

    var IsSameCurr = $("#IsSameCurr").val();

   

    //alert(IsSameCurr);

    

    document.frm.action='<?php echo SITE_BASE_URL;?>dashboard/mydashboard.html?IsEligible=Y&IsSameCurr='+IsSameCurr;

    document.frm.submit();

    

   

}


$(document).ready(function(){

    

    //IsSameCountryFn();

    

      $('#listView').hide();

      $('#list_view').on('click',

        function() {

          $('#listView').fadeIn(1500);

          $('#gridView').fadeOut(700);

        });



      $('#grid_view').on('click',

        function() {

          $('#listView').fadeOut(700);

          $('#gridView').fadeIn(1500);

      });  





});

     var FnNulltoEmpty = function(Value){

        

        if (Value == undefined)

            Value = "";

   

        return Value;

   

    };

    

        var IsSameCountryFn = function(){

    

            //alert("enter");

            

            

            var IsSameCountry = FnNulltoEmpty($("#IsSameCountry").val());

            

           // alert(IsSameCountry);

            

            if (IsSameCountry == "" || IsSameCountry == undefined )

                IsSameCountry = "N";

                

                

             if(IsSameCountry == "Y")  {

                 

                 $("#compareCurrency").show();

             }

             

            

            

            

        };

</script>

<script src="https://apis.google.com/js/platform.js" async defer></script>

<meta name="google-signin-client_id" content="666360874265-78llhedddolcdjv5g9h3m3artaqklaao.apps.googleusercontent.com">

<!--<script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js" async defer></script>-->

<script src="assets/plugins/jquery.countdown-2.0.4/jquery.countdown.min.js"></script>

<script>

function MailEvent(from_name, from_address, to_name, to_address, startTime, endTime, subject, description, location)

{

     URL = "<?php echo SITE_BASE_URL; ?>Property/sendIcalEvent.html?from_name=" + from_name + "& from_address=" + from_address + "& to_name=" + to_name + "& to_address=" + to_address + "& startTime=" + startTime + "& endTime=" + endTime + "& subject=" + subject+ "& description=" + description + "& location=" + location ;

        /*
        $.ajax({url: URL, success: function(result){

            if(result=="1")

            {

                // alert("Mail Sent !")

            }
            else{
                alert(result)
            }

        }});
        */
        
        $.ajax({

            type: "POST",

            url: URL,

            async: false,

        }).done(function (result) {

            if (result == 1) {

                 alert("Upcoming Notification sent to your mail")

            } else {

                alert('Mail not sent');

            }

        });
        

    

}


// window.addeventasync = function(){



//     addeventatc.settings({



//         appleical  : {show:true, text:"Apple Calendar"},



//         google     : {show:true, text:"Google <em>(online)</em>"},



//         office365  : {show:true, text:"Office 365 <em>(online)</em>"},



//         outlook    : {show:true, text:"Outlook"},



//         outlookcom : {show:true, text:"Outlook.com <em>(online)</em>"},



//         yahoo      : {show:true, text:"Yahoo <em>(online)</em>"}



//     });



// };


  $('[data-countdown]').each(function() {

  var $this = $(this), finalDate = $(this).data('countdown');

  $this.countdown(finalDate, function(event) {

    $this.html(event.strftime(''

    //+ '<div><span>%w</span> weeks</div>'

    + '<div><span>%D</span> days</div>'

    + '<div><span>%H</span> hr</div>'

    + '<div><span>%M</span> min</div>'

    + '<div><span>%S</span> sec</div>'));

  });

});



$(document).ready(function(){

    $(".div_compare").change(function(){

        if($(this).val() == "analyze")

        {

            $(".compare_div").hide();

            $(".analyze_div").show();

        }

        else

        {

            $(".compare_div").show();

            $(".analyze_div").hide();

        }

    });

    $(".available-property .property-slot ~ .property-slot").hide();

    $('.available-property .all-slots').hide();

    

    

    

    $(".available-property .more").on('click', function(){

        var tab = $(this).attr('data-tab');

        var action = $(this).attr('data-action');

        

        if(action == "show_more")

        {

            $(".show-"+tab).hide();

            $(".all-"+tab).show();

            $(".available-property .property-slot ~ .property-slot").fadeIn();

        }

    });

    


});



</script>


<?php include 'info-guide-modal.php'; ?>