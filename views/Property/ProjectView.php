<?php
include"header.php";
\login\loginClass::Init();
$checkSession = \login\loginClass::CheckUserSessionIp();
?>
<script src="<?php echo SITE_BASE_URL; ?>dashboard/assets/plugins/chartjs/Chart.bundle.js"></script>
<!--<form action="<?php echo SITE_BASE_URL; ?>Property/ProjectView.html?project_id=<?php echo $_REQUEST["project_id"] ?>" 
method="post" class="" name='form1'>-->
<?php $projectlatlong = \Property\PropertyClass::GetProjectLatlong($_REQUEST["project_id"]); foreach($projectlatlong as $key=>$value){}?>
<?php $PropertyUnit = \Property\PropertyClass::GetPropDtl($_REQUEST["project_id"]); foreach($PropertyUnit as $k=>$unit){}?>
    <?php
    $country = $_REQUEST["country"];
    $project_id = $_REQUEST["project_id"];
    if ($project_id == '' || $project_id == null) {
        $project_id = 1;
    }
    $IsView = "Y";
    $rowsells = \Property\PropertyClass::ProjectSellingDtl($_REQUEST["project_id"]);
    foreach ($rowsells as $rowsell) {
        $reservedCount = $rowsell["reserved_count"];
        $soldCount = $rowsell["sold_count"];
        $totalCount = $rowsell["total_count"];
        if ($totalCount == '' || $totalCount == '0' || $totalCount == null) {
            //$totalCount=1;
        }
        $Available = $totalCount - $reservedCount;
        $Start_dynamin_price = $rowsell["Start_dynamin_price"];
        $one_bet = $rowsell["one_bet"];
        $two_bet = $rowsell["two_bet"];
        $three_bet = $rowsell["three_bet"];
        $Rent_one_bet = $rowsell["Rent_one_bet"];
        $Rent_two_bet = $rowsell["Rent_two_bet"];
        $Rent_three_bet = $rowsell["Rent_three_bet"];
        $Weekly_rent = $rowsell["Weekly_rent"];
        
    }
    $rowMinValues  = \Property\PropertyClass::get_lowest_property($_REQUEST['project_id']);
    foreach($rowMinValues as $minVal)
    {
        $askingPrice    = $minVal['asking_price'];
        $strikePrice    = $minVal['strike_price'];
        $dynamicPrice   = $minVal['dynamic_price'];
        $grossYeild     = $minVal['gross_yeild'];
    }

    \Property\PropertyClass::Init();
    $Projectrows = \Property\PropertyClass::GetPorjectDatas($country, $project_id);
    $i =1;
    
    $noOfProperties = 0;
    $noOfreserved = 0;
    foreach ($Projectrows as $Projectrow) {
        // echo "<pre>";
        // print_r($Projectrow);
        // die();
        $noOfProperties = $Projectrow['no_prop_dynamic_price'];
        
        // echo $noOfProperties;
        // die();
        
        $PropCount = \Property\PropertyClass::GetReservedPreperties($project_id);
        foreach ($PropCount as $cnt) {
            $noOfreserved = $cnt['count'];
        }
        
        
        
        
        $project_id = isset($Projectrow["PROJECT_ID"]) ? $Projectrow["PROJECT_ID"] : "";
        $Projcurr = $Projectrow["currency"];
        $countryName = $Projectrow["country_name"];
        $expiry_date = $Projectrow["expiry_date"];
        $Projcurr    = $Projectrow["currency"];
        $createDate = new DateTime($expiry_date);
        $strip = $createDate->format('Y-m-d');
        if ($Currency == $Projcurr) {
            $Xrate = 1;
        } else {
            $Xraterows = \Property\PropertyClass::GetCurrExrate($Projcurr, $Currency);
            $j = 1;
            foreach ($Xraterows as $Xraterow) {
                $Xrate = $Xraterow["RATE"];
            }
        }
        if ($Xrate == "" || $Xrate == null) {
            $Xrate = 1;
        }
        if ($Currency == "NZD") {
            $Prefix = "NZ$";
        } elseif ($Currency == "AUD") {
            $Prefix = "AU$";
        } elseif ($Currency == "GBP") {
            $Prefix = "Â£";
        } else {
            $Prefix = $Currency . " ";
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
        
        $minRowVal = \Property\PropertyClass::get_lowest_property($project_id);
        foreach($minRowVal as $minVal)
        {
            $ground_rent    = $minVal['ground_rent'];
            $service_charge = $minVal['service_charges'];
        }
        
        ?>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL; ?>dashbaord/assets/plugins/flexslider/css/flexslider.min.css">
        <script src="https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js"></script>
        <link href="https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css" rel="stylesheet" />
        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
        <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css" type="text/css" />
        <div class="inner-wrapper">
            <div class="grd-content">
                <div class="row">
                    <div class="col-12">
                        <h1 class="hero-title-dark">Project Overview</h1>
                    </div>
                    <div class="col-12">
                        <div class="p-overview-panel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex alig-items-center justify-content-between society-title">
                                        <h1><img src="<?= SITE_BASE_URL; ?>dashboard/assets/images/prop-logo.svg" alt=""><?php echo $Projectrow["PROJECT_NAME"] . ', ' . $Projectrow["subrub"]  ?></h1>
                                        
                                        <div class="fav" id ="addtofav">
						
                                            <?php
                                            if (\Property\PropertyClass::check_project_fav($project_id, $LoginUserId)) {
                                                ?>
                                                <a  href="javascript:void(0);" onclick="removeFromFavourite(<?= $project_id; ?>,<?= $LoginUserId;?>)" >
                                                    <i class="fas fa-heart"></i> Remove From My Favourites</a>
                                                <!--<a href="<?= SITE_BASE_URL; ?>Property/RemoveFavorite.html?ProjectId=<?php echo $project_id; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="fas fa-heart"></i> Remove From My Favourites</a>-->

                                                <?php
                                            } else {
                                                ?>
                                                <a  href="javascript:void(0);" onclick="addToFavourite(<?= $project_id; ?>,<?= $LoginUserId; ?>)">
                                                    <i class="far fa-heart"></i> Add To My Favourites</a>

                                                <!--<a href="<?= SITE_BASE_URL; ?>Property/AddToFavorite.html?ProjectId=<?php echo $project_id; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="far fa-heart"></i> Add To My Favourites</a>-->

                                                <?php
                                            }
                                            ?>

                                        </div>

                                    </div>
                                    <div class="row align-items-end">
                                        <div class="col-xl-8">
                                            <div class="price-text">
                                                <p>Strike Price from: <?= $Prefix; ?><?= number_format(round($askingPrice*$Xrate)); ?></p>
                                            </div>
                                            <div class="descript-text">
                                                <h5>Description</h5>
                                                <p><?php echo $Projectrow["short_description"]; ?></p>   
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="f-text">
                                                
                                                <span> 1 Bed &nbsp;<br><i class="fas fa-bed"></i> &nbsp;<?php echo $one_bet;?></span>

                                                <span> 2 Bed &nbsp;<br><i class="fas fa-bed"></i> &nbsp;<?php echo $two_bet;?></span>
        
                                                <span> 3 Bed &nbsp;<br><i class="fas fa-bed"></i> &nbsp;<?php echo $three_bet;?></span>
                                                    <!--<span><i class="fas fa-bed"></i> 1 - 2</span>-->
                                                    <!--<span> <i class="fas fa-car"></i> 1</span>-->
                                                    <!--<span> <i class="fas fa-bath"></i> 1</span>-->
                                            </div>
                                            <div class="map" id="map">
                                                <script>
													mapboxgl.accessToken = 'pk.eyJ1IjoicGFzc2ltY3luaWMiLCJhIjoiY2todWk4cTR5MDVpNDMxbW9tY3UwaGxqcSJ9.x3rvW8rJowM8h3lFWYMFQw';
													var map = new mapboxgl.Map({
													container: 'map',
													style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
													center: [<?= $value['langi'].','.$value['latit'] ?>], // starting position [lng, lat]
													zoom: 5 // starting zoom
													});
													</script>
                                            </div>
                                            <p class="map-address">
                                                <?php echo $Projectrow["subrub"] ?>|<?php echo $countryName; ?>|<?php echo $Projectrow["postcode"] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <h1 class="hero-title-dark sm-title">Scheme Details</h1>
                                    <table class="table property-details-table bg-white">
                                        <tr>
                                            <td>
                                                <span>Total No. Units in Development</span>
                                                <strong><?= $Projectrow['NO_OF_PROPERTY'];?></strong>
                                            </td>
                                            <td>
                                                <span>Total No. Units in Current Phase</span>
                                                <strong><?= $Projectrow['no_prop_current_phase'];?></strong>
                                            </td>
                                            <td>
                                                <span>Total No. Units available for Du Val Members</span>
                                                <strong><?= $Projectrow['no_prop_duval_allocation'];?></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span>No. units sold in previous phases</span>
                                                <strong>0</strong>
                                            </td>
                                             <td>
                                                <span>Estimated ground rents p.a. from</span>
                                                <strong>$<?= $ground_rent; ?></strong>
                                            </td>
                                            <td>
                                                <span>Estimated Service Charge(per ft2 p.a) From</span>
                                                <strong>$<?= number_format($service_charge,2); ?></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span>Contract Exchange Date</span>
                                                <strong><?= $Projectrow['ContractExchagedate'];?></strong>
                                            </td>
                                            <td>
                                                <span>Amount due on exchange of contracts (%)</span>
                                                <strong><?= $Projectrow['ExchangeDeposit'];?>%</strong>
                                            </td>
                                            <td>
                                                <span>Stage Payment 1</span>
                                                <strong><?= ($Projectrow['StagePayment1'] > 0) ? $Projectrow['StagePayment1'] : 0;?>%</strong>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                <span>Estimated Competition Date</span>
                                                <strong><?= $Projectrow['completion_date'];?></strong>
                                            </td>
                                            <td>
                                                <span>Stage Payment 2</span>
                                                <strong><?= ($Projectrow['StagePayment2'] > 0) ? $Projectrow['StagePayment2'] : 0;?>%</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <div id="property-gallary" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="img-holder">
                                                    <img src="<?php echo FILE_BASE_URL; ?><?php echo $Projectrow["image_file"]; ?>" class="img-fluid" alt="">
                                                </div>
                                            </div>
                                            <?php if ($Projectrow["image_file1"] != '') { ?>
                                                <div class="carousel-item">
                                                    <div class="img-holder">
                                                        <img src="<?php echo FILE_BASE_URL; ?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            if ($Projectrow["image_file2"] != '') {
                                                ?>

                                                <div class="carousel-item">
                                                    <div class="img-holder">
                                                        <img src="<?php echo FILE_BASE_URL; ?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            if ($Projectrow["image_file3"] != '') {
                                                ?>
                                                <div class="carousel-item">
                                                    <div class="img-holder">
                                                        <img src="<?php echo FILE_BASE_URL; ?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <ul class="carousel-indicators">
                                            <li data-target="#property-gallary" data-slide-to="0" class="active">
                                                <img src="<?php echo FILE_BASE_URL; ?><?php echo $Projectrow["image_file"]; ?>" class="img-fluid" alt="">
                                            </li>
                                            <?php if ($Projectrow["image_file1"] != '') { ?>
                                                <li data-target="#property-gallary" data-slide-to="1">
                                                    <img src="<?php echo FILE_BASE_URL; ?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                </li>
                                                <?php
                                            }
                                            if ($Projectrow["image_file2"] != '') {
                                                ?>
                                                <li data-target="#property-gallary" data-slide-to="2">
                                                    <img src="<?php echo FILE_BASE_URL; ?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                </li>
                                                <?php
                                            }
                                            if ($Projectrow["image_file3"] != '') {
                                                ?>
                                                <li data-target="#property-gallary" data-slide-to="3">
                                                    <img src="<?php echo FILE_BASE_URL; ?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="row justify-content-end px-4 pb-4">
                                        <div class="col-12">
                                            <div class="avm-text">
                                                <div class="d-flex align-items-start">
                                                    <div class="text">
                                                        <h6>Project Information</h6>
                                                        <p class="m-0">Full of information you can download and read anytime, including our Investment Memorandum and Suburb Report (Australia and New Zealand Only) and Project Presentation.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="avm-files">
                                                <div class="single-file no-file">
                                                    <i class="fas fa-file-pdf"></i>
                                                    <button class="btn btn-orange">Download</button>
                                                </div>
                                                <div class="single-file no-file">
                                                    <i class="fas fa-file-pdf"></i>
                                                    <button class="btn btn-orange">Download</button>
                                                </div>
                                                <div class="single-file no-file">
                                                    <i class="fas fa-file-pdf"></i>
                                                    <button class="btn btn-orange">Download</button>
                                                </div>
                                                <div class="single-file no-file">
                                                    <i class="fas fa-file-pdf"></i>
                                                    <button class="btn btn-orange">Download</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h1 class="hero-title-dark sm-title">Location Overview and Amenities</h1>
                                    <div class="row p-4">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <table class="table borderless-table">
                                                        <?php
                                                        $amentitie = \Property\PropertyClass::get_amininties_data($_REQUEST["project_id"]);
                                                        foreach ($amentitie as $amData)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?= $amData['aminity_name'];?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </table>
                                                </div>
                                                <!--<div class="col-xl-6">-->
                                                <!--    <table class="table borderless-table">-->
                                                        
                                                <!--        <tr>-->
                                                <!--            <td>-->
                                                <!--                State Highway 20 -->
                                                <!--            </td>-->
                                                <!--            <td>11 min</td>-->
                                                <!--        </tr>-->
                                                <!--        <tr>-->
                                                <!--            <td>-->
                                                <!--                Mangere Bridge Village -->
                                                <!--            </td>-->
                                                <!--            <td>-->
                                                <!--                13 min-->
                                                <!--            </td>-->
                                                <!--        </tr>-->
                                                <!--        <tr>-->
                                                <!--            <td>-->
                                                <!--                Otahuhu Transport Station-->
                                                <!--            </td>-->
                                                <!--            <td>-->
                                                <!--                9 min-->
                                                <!--            </td>-->
                                                <!--        </tr>-->
                                                <!--        <tr>-->
                                                <!--            <td>-->
                                                <!--                Gym-->
                                                <!--            </td>-->
                                                <!--            <td>-->
                                                <!--                5 min-->
                                                <!--            </td>-->
                                                <!--        </tr>-->
                                                <!--        <tr>-->
                                                <!--            <td>-->
                                                <!--                Concierge-->
                                                <!--            </td>-->
                                                <!--            <td>-->
                                                <!--                8 min-->
                                                <!--            </td>-->
                                                <!--        </tr>-->
                                                <!--        <tr>-->
                                                <!--            <td>-->
                                                <!--                Landscaped Gardens-->
                                                <!--            </td>-->
                                                <!--            <td>-->
                                                <!--                14 min-->
                                                <!--            </td>-->
                                                <!--        </tr>-->
                                                <!--    </table>-->
                                                <!--</div>-->
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="map" id="map2">
                                                <script>
													mapboxgl.accessToken = 'pk.eyJ1IjoicGFzc2ltY3luaWMiLCJhIjoiY2todWk4cTR5MDVpNDMxbW9tY3UwaGxqcSJ9.x3rvW8rJowM8h3lFWYMFQw';
													var map = new mapboxgl.Map({
													container: 'map2',
													style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
													center: [<?= $value['langi'].','.$value['latit'] ?>], // starting position [lng, lat]
													zoom: 5 // starting zoom
													});
													</script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>

                    $(document).ready(function () {
                        $('.btn-accordian').on('click', function () {
                            if ($('.accordian-panel').hasClass('vanish')) {
                                $('.accordian-panel').removeClass('vanish');
                                $('.btn-accordian .fas').removeClass('fa-chevron-up').addClass('fa-chevron-down');
                                $('.accordian-panel').slideDown();
                            } else {
                                $('.accordian-panel').addClass('vanish');
                                $('.btn-accordian .fas').addClass('fa-chevron-up').removeClass('fa-chevron-down');
                                $('.accordian-panel').slideUp();
                            }

                        });
                    });

                </script>

                <div class="row mt-4">
                    <div class="col-12">
                        <h1 class="hero-title-dark">Available Properties</h1>
                    </div>
                    <div class="col-12">
                        <div class="refine-search">
                                <form class="form-group" id="searchform" name="searchform" method="post">
                            <div class="d-flex">
                                    <div class="column">
                                        <div class="d-inline-flex align-items-center">
                                            <select class="form-control mr-0" name="bedroomfrom" id="bedfrom">
                                                <option <?= ($_REQUEST['bedroomfrom'] == '1') ? "selected" : "" ?> value="1">1 Bed</option>
                                                <option <?= ($_REQUEST['bedroomfrom'] == '2') ? "selected" : "" ?> value="2">2 Bed</option>
                                                <option <?= ($_REQUEST['bedroomfrom'] == '3') ? "selected" : "" ?> value="3">3 Bed</option>
                                                <option <?= ($_REQUEST['bedroomfrom'] == '4') ? "selected" : "" ?> value="4">4 Bed</option>
                                            </select>
                                            <span>to</span>
                                            <select class="form-control" name="bedroomto" id="bedto">
                                                <option <?= ($_REQUEST['bedroomto'] == '1') ? "selected" : "" ?> value="1">1 Bed</option>
                                                <option <?= ($_REQUEST['bedroomto'] == '2') ? "selected" : "" ?> value="2">2 Bed</option>
                                                <option <?= ($_REQUEST['bedroomto'] == '3') ? "selected" : "" ?> value="3">3 Bed</option>
                                                <option <?= ($_REQUEST['bedroomto'] == '4') ? "selected" : "" ?> value="4">4 Bed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div class="d-inline-flex align-items-center w-100">
                                            <div class="d-inline-flex align-items-center">
                                                <label>Price Range <?= $Prefix; ?></label>
                                                <select class="form-control" name="price" id="price">
                                                    <option value=""> Min Price</option>
                                                    <option <?= ($_REQUEST['price'] == '150000') ? "selected" : "" ?> value="150000">150,000</option>
                                                    <option <?= ($_REQUEST['price'] == '200000') ? "selected" : "" ?> value="200000">200,000</option>
                                                    <option <?= ($_REQUEST['price'] == '250000') ? "selected" : "" ?> value="250000">250,000</option>
                                                    <option <?= ($_REQUEST['price'] == '300000') ? "selected" : "" ?> value="300000">300,000</option>
                                                    <option <?= ($_REQUEST['price'] == '350000') ? "selected" : "" ?> value="300000">350,000</option>
                                                    <option <?= ($_REQUEST['price'] == '450000') ? "selected" : "" ?> value="450000">450,000</option>
                                                    <option <?= ($_REQUEST['price'] == '500000') ? "selected" : "" ?> value="500000">500,000</option>
                                                    <option <?= ($_REQUEST['price'] == '550000') ? "selected" : "" ?> value="550000">550,000</option>
                                                    <option <?= ($_REQUEST['price'] == '600000') ? "selected" : "" ?> value="600000">600,000</option>
                                                    <option <?= ($_REQUEST['price'] == '650000') ? "selected" : "" ?> value="650000">650,000</option>
                                                    <option <?= ($_REQUEST['price'] == '700000') ? "selected" : "" ?> value="700000">700,000</option>
                                                    <option <?= ($_REQUEST['price'] == '750000') ? "selected" : "" ?> value="750000">750,000</option>
                                                    <option <?= ($_REQUEST['price'] == '800000') ? "selected" : "" ?> value="800000">800,000</option>
                                                    <option <?= ($_REQUEST['price'] == '850000') ? "selected" : "" ?> value="850000">850,000</option>
                                                    <option <?= ($_REQUEST['price'] == '900000') ? "selected" : "" ?> value="900000">900,000</option>
                                                    <option <?= ($_REQUEST['price'] == '950000') ? "selected" : "" ?> value="950000">950,000</option>
                                                    <option <?= ($_REQUEST['price'] == '1000000') ? "selected" : "" ?> value="1000000">1,000,000</option>
                                                    <option <?= ($_REQUEST['price'] == '1100000') ? "selected" : "" ?> value="1100000">1,100,000</option>
                                                    <option <?= ($_REQUEST['price'] == '1200000') ? "selected" : "" ?> value="1200000">1,200,000</option>
                                                    <option <?= ($_REQUEST['price'] == '1300000') ? "selected" : "" ?> value="1300000">1,300,000</option>
                                                    <option <?= ($_REQUEST['price'] == '1400000') ? "selected" : "" ?> value="1400000">1,400,000</option>
                                                    <option <?= ($_REQUEST['price'] == '1500000') ? "selected" : "" ?> value="1500000">1,500,000</option>
                                                       <option <?= ($_REQUEST['price'] == '2000000') ? "selected" : "" ?> value="2000000">2,000,000</option>
                                                </select>
                                                <span>to</span>
                                                <select class="form-control" name="eprice" id="eprice">
                                                    <option value=""> Max Price</option>
                                                    <option <?= ($_REQUEST['eprice'] == '200000') ? "selected" : "" ?> value="200000">200,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '250000') ? "selected" : "" ?> value="250000">250,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '300000') ? "selected" : "" ?> value="300000">300,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '350000') ? "selected" : "" ?> value="300000">350,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '450000') ? "selected" : "" ?> value="450000">450,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '500000') ? "selected" : "" ?> value="500000">500,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '550000') ? "selected" : "" ?> value="550000">550,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '600000') ? "selected" : "" ?> value="600000">600,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '650000') ? "selected" : "" ?> value="650000">650,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '700000') ? "selected" : "" ?> value="700000">700,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '750000') ? "selected" : "" ?> value="750000">750,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '800000') ? "selected" : "" ?> value="800000">800,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '850000') ? "selected" : "" ?> value="850000">850,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '900000') ? "selected" : "" ?> value="900000">900,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '950000') ? "selected" : "" ?> value="950000">950,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '1000000') ? "selected" : "" ?> value="1000000">1,000,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '1100000') ? "selected" : "" ?> value="1100000">1,100,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '1200000') ? "selected" : "" ?> value="1200000">1,200,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '1300000') ? "selected" : "" ?> value="1300000">1,300,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '1400000') ? "selected" : "" ?> value="1400000">1,400,000</option>
                                                    <option <?= ($_REQUEST['eprice'] == '1500000') ? "selected" : "" ?> value="1500000">1,500,000</option>
                                                       <option <?= ($_REQUEST['eprice'] == '2000000') ? "selected" : "" ?> value="2000000">2,000,000</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div class="col-12 text-left">
                                            <input type="hidden" name="project_id" value="<?= $project_id ?>">
                                            <input type="hidden" name="country" value="<?= $country ?>">
                                            <input type="button" value="Search" onClick="submitDetailsForm()" name="btn_search" class="btn btn-orange mr-auto mt-3">
                                        </div>
                                    </div>
                            </div>
<div class='d-flex'>
	<select class="form-control ChangeSize">
		<option 
		value="1###<?php echo $Projectrow["PROJECT_ID"] ?>###m" 
		<?php if(isset($unit) && $unit['area_unit'] == "m"){ echo 'selected';} ?>
		>Meter m²</option>
		<option 
		value="1###<?php echo $Projectrow["PROJECT_ID"] ?>###ft" 
		<?php if(isset($unit) && $unit['area_unit'] == "ft"){ echo 'selected';} ?> 
		>Feet ft²</option>  
	</select>    
</div> 
						</form>
                        </div>
                        <div id="searchresult"><?php
                        include"PropertyTbl.php";
                        $cond = "";
                        ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $i = $i + 1;
    }
    ?>
    <form action="<?php echo PAYPAL_URL; ?>" method="post">
        <!-- Identify your business so that you can collect the payments -->
        <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
        <!-- Specify a subscriptions button. -->
        <input type="hidden" name="cmd" value="_xclick-subscriptions">
        <!-- Specify details about the subscription that buyers will purchase -->
        <input type="hidden" class="item_name"  name="item_name" value="">
        <input type="hidden" class="item_number" name="item_number" value="">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="a3" id="paypalAmt" value="10">
        <input type="hidden" name="p3" id="paypalValid" value="1">
        <input type="hidden" name="t3" value="M">
        <!-- Custom variable user ID -->
        <input type="hidden" name="custom" value="<?php //echo $loggedInUserID;   ?>">
        <!-- Specify urls -->
        <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
        <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
        <input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">
        <!-- Display the payment button -->
        <input class="buy-btn d-none" type="submit" value="Buy Subscription">
    </form>
    <span id="myBtn" style="display:none;">Open Modal</span>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p><div class="form-group">
                <p><b>Total Price:</b> <span id="subPrice"></span></p>
                <div id="paypal-button"></div>
            </div>
        </div>
        <?php include"footer.php"; ?>
        <script>
            //chart1
            //   new Chart(document.getElementById("doughnut-chart"), {
            //     type: 'doughnut',
            //     data: {
            //       labels: ["Available", "Not Available"],
            //       datasets: [
            //         {
            //           label: "Property Status)",
            //           backgroundColor: ["#85BE1A", "#C70000"],
            //           data: [30,70]
            //         }
            //       ]
            //     },
            //     responsive: true,
            //     options: {
            //       legend: {
            //         display: false
            //       },
            //       title: {
            //         display: false,
            //         text: 'Property Status'
            //       }
            //     }
            // });  

        </script>
		
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />


        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
        <script src="<?php echo SITE_BASE_URL; ?>dashboard/assets/plugins/jquery.countdown-2.0.4/jquery.countdown.min.js"></script>
        <script>
            function favouritePro(postid)
            {
                postid = postid.split("####")
                PropertyId = postid[0];
                UserId = postid[1];
                URL = "<?php echo SITE_BASE_URL; ?>Property/AddToFavoritePro.html?PropertyId=" + PropertyId + "& UserId=" + UserId
                $.ajax({url: URL, success: function (result) {
                        $('#Prop' + PropertyId).html('<a  class="col-lg-3 text-success" href="javascript:void(0)" onclick=\'CanfavouritePro("' + PropertyId + "####" + UserId + '")\'  title="Remove Favorite"><i class="fas fa-star"></i></a>');
                    }});

            }
            
            function addToFavourite(proId,user_id)
            {
                URL = "<?= SITE_BASE_URL;?>Property/AddToFavorite.html?ProjectId="+ proId +"&UserId="+ user_id,
                $.ajax({url: URL, success: function (result) {
                    $('#addtofav').html('<a href="javascript:void(0);" onclick="removeFromFavourite(\'' + proId + '\',\'' + user_id + '\')"><i class="fas fa-heart"></i> Remove From My Favourites</a>');
                }
                });

            }
            function removeFromFavourite(proId,user_id){

                URL = "<?= SITE_BASE_URL;?>Property/RemoveFavorite.html?ProjectId="+ proId +"&UserId="+ user_id,
                $.ajax({url: URL, success: function (result) {
                    $('#addtofav').html('<a href="javascript:void(0);" onclick="addToFavourite(\'' + proId + '\',\'' + user_id + '\')"><i class="far fa-heart"></i> Add To My Favourites</a>');
                    }
                });
            }
            function submitDetailsForm()
            {
                var formData = new FormData();
                var other_data = $('#searchform').serializeArray();
                $.each(other_data, function (key, input) {
                  formData.append(input.name, input.value);
                });
                $.ajax({
                  type: "POST",
                  url: "<?= SITE_BASE_URL;?>Property/GetProjectDatasSearch.html",
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false,
                  beforeSend: function () { },
                  success: function (data) {
                      if(data.length <=0 || data != ""){
                          console.log('here');
                    $("#searchresult").empty();
                       $("#searchresult").html(data);
                          }
                          else{
                              $("#searchresult").empty();
                          }
                  }
                });
            }
            
            function CanfavouritePro(postid)
            {
                postid = postid.split("####")
                PropertyId = postid[0];
                UserId = postid[1];
                //$LoginUserId
                URL = "<?php echo SITE_BASE_URL; ?>Property/RemoveFavoritePro.html?PropertyId=" + PropertyId + "& UserId=" + UserId;
                $.ajax({url: URL, success: function (result) {
                        $('#Prop' + PropertyId).html('<a class="col-lg-3 text-danger" href="javascript:void(0)" onclick=\'favouritePro("' + PropertyId + "####" + UserId + '")\' title="Add To Favorite"><i class="far fa-star"></i></a>')
                    }});

            }
            function removeCommas(str) {
                while (str.search(",") >= 0) {
                    str = (str + "").replace(',', '');
                }
                return str;
            };
            $(document).ready(function () {

                $('[data-countdown]').each(function () {
                    var $this = $(this), finalDate = $(this).data('countdown');
                    $this.countdown(finalDate, function (event) {
                        $this.html(event.strftime(''
                                + '<div><span>%D</span> days</div>'
                                + '<div><span>%H</span> hr</div>'
                                + '<div><span>%M</span> min</div>'
                                + '<div><span>%S</span> sec</div>'));
                    });
                });
				
				// $( document ).ready(function() {
				// 	var t = $('#unit').val();
				// 	 SizeArr = $('#unit').val().split("###");
                //     SizeConversion = SizeArr["0"];
                //     ProjectId = SizeArr["1"];
                //     Size = SizeArr["2"];
                //     $(".size" + ProjectId).html("<a class='active apt-size' href='#'>" + Size + "<sup>2</sup></a>")
                //     $(".balcony").each(function () {
                //         $(this).next(".spanbalcony" + ProjectId).html(Math.round($(this).val() * SizeConversion));
                //     });
                //     $(".Land").each(function () {
                //         $(this).next(".spanLand" + ProjectId).html(Math.round($(this).val() * SizeConversion));
                //     });
				// });

                $(".ChangeSize").change(function () {
                    SizeArr = $(this).val().split("###");
                    SizeConversion = SizeArr["0"];
                    ProjectId = SizeArr["1"];
                    Size = SizeArr["2"];
        			$(".size" + ProjectId).html("<a class='active apt-size' href='#'>" + Size + "<sup>2</sup></a>")
    if(Size == "ft")
    {
        $(".Land").each(function ()
        {
        	var value = $(this).val();
            $(this).next(".spanLand" + ProjectId).html(Math.round($(this).val() * 3.2808));
            $(this).val(Math.round(value * 3.2808));
        });
    }
    else
    {
        $(".Land").each(function () {

            var value = $(this).val();
            $(this).next(".spanLand" + ProjectId).html(Math.round(value / 3.2808));
            $(this).val(Math.round(value / 3.2808));
        }); 
    }
                });
                $('table tr .paypal').on('click', function (e) {
                    event.stopPropagation();
                    $('#paypal-button').html('');
                    $("#myBtn").click();
                    var dataprice = $(this).attr('data-price');
                    var buildingname = $(this).attr('data-buildingname');
                    var productId = $(this).attr('data-propertyid');
                    var userId = '<?php echo $LoginUserId; ?>';
                    newprice = removeCommas(dataprice);
                    $("#subPrice").html('$' + newprice + ' USD');
                    if (newprice != '' && buildingname != '')
                    {
                        newprice = 10;
                        paypal.Button.render({
                            env: 'sandbox', // Or 'sandbox',
                            commit: true, // Show a 'Pay Now' button
                            client: {
                                sandbox: '<?php echo PAYPAL_EXPRESS_CLIENTID; ?>',
                                production: ''
                            },
                            style: {
                                color: 'gold',
                                size: 'small'
                            },
                            payment: function (data, actions) {
                                return actions.payment.create({
                                    transactions: [{
                                            amount: {
                                                total: newprice,
                                                currency: '<?php echo PAYPAL_CURRENCY; ?>'
                                            }
                                        }]
                                });
                            },
                            onAuthorize: function (data, actions) {
                                return actions.payment.execute().then(function () {
                                    console.log(JSON.stringify(data));
                                    url = "<?php echo SITE_BASE_URL; ?>Property/PaypalSuccess.html?paymentID=" + data.paymentID + "&token=" + data.paymentToken + "&payerID=" + data.payerID + "&pid=" + productId + "&uid=" + userId + "";
                                    window.location = url;
                                });
                            },
                            onCancel: function (data, actions) {
                            },
                            onError: function (err) {
                            }
                        }, '#paypal-button');
                    }
                });
            });
        </script>