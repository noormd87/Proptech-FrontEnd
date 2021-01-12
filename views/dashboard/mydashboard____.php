<?php include"header.php"; ?>
<?php
$IsSameCurr          = $_REQUEST["IsSameCurr"] ? $_REQUEST["IsSameCurr"] : "2";
$currentCurrency     =  $_SESSION["BaseCurrency"] ? $_SESSION["BaseCurrency"] : "NZD";
?>
<!-- apexchart -->  
<link rel="stylesheet" type="text/css" href="assets/plugins/apexcharts/css/apexcharts.min.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/apexcharts/css/apexcharts.min.css.map">
<script type="text/javascript" src="assets/plugins/owl-crousal/js/owl.carousel.min.js"></script>
<script src="assets/plugins/chartjs/Chart.bundle.js"></script>
<style type="text/css" media="screen">
   <i class="icofont-listing-box"></i>
</style>
    <div class="inner-wrapper">
        <!-- Search Bar Start -->
        <div class="search-time-holder">
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
            <div class="time-slots">
                <div class="single-time">
                    <p>03:24</p>
                    <small>pst</small>
                </div>
                <div class="single-time">
                    <p>03:24</p>
                    <small>pst</small>
                </div>
                <div class="single-time">
                    <p>03:24</p>
                    <small>pst</small>
                </div>
                <button class="btn btn-dark">Add<br>Clock</button>
            </div>
        </div>
        <!-- Search Bar End -->
        <div class="available-property">
            <h1 class="hero-title-dark">Property Availability</h1>
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#soon">Clossing Soon!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#adays">Closing 15 Days</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#bdays">Closing 30 Days</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="soon">
                    <?php
                    $cond1=" and pd.reserved_by='".$LoginUserId."' ";
                    \Property\PropertyClass::Init();
                    $rows1 = \Property\PropertyClass::GetPropertiesDatas('','',$cond1);
                    $j = 1;
                    foreach ($rows1 as $row1)
                    {
                        $effective_date=$row1["effective_date"];
                        $projectName=$row1["project_name"];
                        $country=$row1["country"];
                        $strike_price=$row1["strike_price"];
                        $CountryCodeNew=$row1["Country_Code_New"];
                        $ProjectIdd=$row1["project_id"];
                        $floortype=$row1["floor_type"];
                        $CountryName=$row1["COUNTRY_NAME"];
                        $Projectcurrency=$row1["currency"];
                        $expiry_date=$row1["expiry_date"];
                        $NoOfProperty=$row1["No_of_property"];
                        $NoOfAvProperty=$row1["No_of_Av_property"];
                        $image_file=$row1["image_file"];
                        if($Currency==$Projectcurrency)
                        {
                            $Xrate=1;
                        }
                        else
                        {
                            $Xraterows = \Property\PropertyClass::GetCurrExrate($Projectcurrency,$Currency);
                            foreach ($Xraterows as $Xraterow)
                            {
                                $Xrate=$Xraterow["RATE"];
                            }
                        }
                        if($Xrate=="" || $Xrate==null)
                        {
                            $Xrate=1;
                        }
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
                        $days1 = floor(($diff - $years * 365*60*60*24)/ (60*60*24));
                        $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                        $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
                        $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
                        if($Currency=="NZD")
                        {
                            $Prefix="NZ $";
                        }
                        elseif($Currency=="AUD")
                        {
                            $Prefix="AU $";
                        }
                        elseif($Currency=="GBP")
                        {
                            $Prefix="£";
                        }
                        else
                        {
                            $Prefix=$Currency." ";
                        }
                        ?>
                        <div class="property-slot">
                            <div class="name-bed">
                                <p><?php echo $projectName;?></p>
                                <p><i class="fas fa-bed"></i><?php echo $row1["no_of_bedrooms"];?></p>
                            </div>
                            <div class="ps-flex">
                                <!--<div class="mini-flex">-->
                                    
                                    <div class="img-holder">
                                        <picture>
                                            <source media="(min-width:1600px)" srcset="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $image_file; ?>">
                                            <img src="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $image_file; ?>" alt="Flowers">
                                        </picture>
                                    </div>
                                    <div class="graph-holder">
                                        <canvas id="lineChart<?php echo $j;?>"></canvas>
                                        <?php
                                        $DynamicRaterows = \Property\PropertyClass::GetPropertiesDynamicFlow($ProjectIdd,$row1["property_id"]);
                                        $Label='[';
                                        $Value='[';
                                        $Value2='[';
                                        foreach ($DynamicRaterows as $DynamicRaterow)
                                        {
                                            if($DynamicRaterow["dynamic_rate"]!=null)
                                            {
                                               $graphVal=$DynamicRaterow["dynamic_rate"];
                                            }
                                            if($Label=='[')
                                            {
                                                $UpadtedDate = new DateTime($DynamicRaterow["updated_date"]);
                                                $X_axis = $UpadtedDate->format('d-m-Y');
                                                $Label=$Label.'"'.$X_axis.'"';
                                                $Value=$Value.$graphVal;
                                                $Value2=$Value2.$strike_price;
                                            }
                                            else
                                            {
                                               $UpadtedDate = new DateTime($DynamicRaterow["updated_date"]);
                                               $X_axis = $UpadtedDate->format('d-m-Y');
                                               //$Label=$Label.','.(intval($DynamicRaterow["version_no"])-1);
                                               $Label=$Label.','.'"'.$X_axis.'"';
                                               $Value=$Value.','.$graphVal;
                                               $Value2=$Value2.','.$strike_price;
                                            }
                                        }
                                        $Label=$Label.']';
                                        $Value=$Value.']';
                                        $Value2=$Value2.']';
                                        ?>
                                        <script type="text/javascript">
                                            var speedCanvas = document.getElementById("lineChart<?php echo $j;?>");
                                            Chart.defaults.global.defaultFontFamily = "Poppins";
                                            Chart.defaults.global.defaultFontSize = 18;
                                            var dataFirst = {
                                                label: "Strike Price",
                                                data: <?php echo $Value2;?>,
                                                lineTension: 0,
                                                fill: false,
                                                borderColor: '#C70000'
                                            };
                                            var dataSecond = {
                                                label: "Dynamic Price",
                                                data: <?php echo $Value;?>,
                                                lineTension: 0,
                                                fill: false,
                                                borderWidth: 2,
                                                pointBorderWidth: 2,
                                                pointHoverRadius: 5,
                                                borderDash: [5,2],
                                                borderColor: '#012145'
                                            };
                                            var speedData = {
                                                labels: <?php echo $Label;?>,
                                                datasets: [dataFirst, dataSecond]
                                            };
                                            var lineChart = new Chart(speedCanvas, {
                                                type: 'line',
                                                data: speedData,
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
                                    </div>
                                <!--</div>-->
                                <div class="prop-info">
                                    <div class="price mb-4">
                                        <span><?= $Prefix; ?> </span>
                                        <span><?php echo number_format(round($row1["rate"]*$Xrate,2));?></span>
                                    </div>
                                    <table>
                                        <tr>
                                            <td>Current Discount</td>
                                            <td><?php echo round((($row1["rate"]-$row1["dynamic_rate"])/$row1["rate"])*100,2);?>%  <i class="fas fa-caret-down"></i></td></td>
                                        </tr>
                                        <tr>
                                            <td>Strike Price</td>
                                            <td><?php echo $Prefix." ".number_format(round($row1["strike_price"]*$Xrate,2));?>
                                        </tr>
                                        <tr>
                                            <td>Current Du Val Dynamic Price</td>
                                            <td><?php echo $Prefix." ".number_format(round($row1["dynamic_rate"]*$Xrate,2));?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="actions">
                                    <div class="time-holder">
                                        <p>Time Left to take actions</p>
                                        <div class="timer">
                                            <div data-countdown="<?php echo $strip ?>" class="count-skin"></div>
                                        </div>
                                    </div>
                                    <div class="save-property">
                                        <a href="#"><i class="far fa-heart"></i> Add To My Fav</a> 
                                        <a href="#"><i class="fas fa-folder-open"></i> Add To My Folder</a> 
                                    </div>
                                    <div class="place">
                                        <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/uploads/<?= "".$row1["IMAGE"];?>" alt=""> <?= $row1["subrub"];?>
                                    </div>
                                    <a href="<?php echo SITE_BASE_URL; ?>Property/PropertyFullDtl.html?id=<?php echo $row1["property_id"]; ?>" class="btn btn-green">Analyze Property</a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $j=$j+1;
                    }
                    if($j==1)
                    {
                       echo '<div class="card-header">No Records</div>';
                    }
                    ?>
                    <div class="more">
                        <a href="#">
                            <i class="fas fa-arrow-to-bottom"></i>
                        </a>
                    </div>
                </div>
                <div class="tab-pane fade" id="adays">
                    <?php
                    $condFav=" and pd.property_id in (Select property_id from Add_favorite_property where user_id='".$LoginUserId."') ";
                    \Property\PropertyClass::Init();
                    $rows1 = \Property\PropertyClass::GetPropertiesDatas('','',$condFav);
                    $k = 1;
                    foreach ($rows1 as $row1)
                    {
                        $effective_date=$row1["effective_date"];
                        $projectName=$row1["project_name"];
                        $country=$row1["country"];
                        $strike_price=$row1["strike_price"];
                        $CountryCodeNew=$row1["Country_Code_New"];
                        $ProjectIdd=$row1["project_id"];
                        $floortype=$row1["floor_type"];
                        $CountryName=$row1["COUNTRY_NAME"];
                        $Projectcurrency=$row1["currency"];
                        $expiry_date=$row1["expiry_date"];
                        $NoOfProperty=$row1["No_of_property"];
                        $NoOfAvProperty=$row1["No_of_Av_property"];
                        $image_file=$row1["image_file"];
                        if($Currency==$Projectcurrency)
                        {
                            $Xrate=1;
                        }
                        else
                        {
                            $Xraterows = \Property\PropertyClass::GetCurrExrate($Projectcurrency,$Currency);
                            foreach ($Xraterows as $Xraterow)
                            {
                                $Xrate=$Xraterow["RATE"];
                            }
                        }
                        if($Xrate=="" || $Xrate==null)
                        {
                            $Xrate=1;
                        }
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
                        $days1 = floor(($diff - $years * 365*60*60*24)/ (60*60*24));
                        $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                        $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
                        $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
                        if($Currency=="NZD")
                        {
                            $Prefix="NZ $";
                        }
                        elseif($Currency=="AUD")
                        {
                            $Prefix="AU $";
                        }
                        elseif($Currency=="GBP")
                        {
                            $Prefix="£";
                        }
                        else
                        {
                            $Prefix=$Currency." ";
                        }
                    ?>
                    <div class="property-slot">
                        <div class="name-bed">
                            <p><?php echo $projectName;?></p>
                            <p><i class="fas fa-bed"></i><?php echo $row1["no_of_bedrooms"];?></p>
                        </div>
                        <div class="ps-flex">
                            <!--<div class="mini-flex">-->
                                
                                <div class="img-holder">
                                    <picture>
                                        <source media="(min-width:1600px)" srcset="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $image_file; ?>">
                                        <img src="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $image_file; ?>" alt="Flowers">
                                    </picture>
                                    <!-- <img src="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $image_file; ?>" alt=""> -->
                                </div>
                                <div class="graph-holder">
                                    <canvas id="lineChart<?php echo $j;?>"></canvas>
                                    <?php
                                        $DynamicRaterows = \Property\PropertyClass::GetPropertiesDynamicFlow($ProjectIdd,$row1["property_id"]);
                                    $Label='[';
                                    $Value='[';
                                    $Value2='[';
                                    foreach ($DynamicRaterows as $DynamicRaterow)
                                    {
                                        if($DynamicRaterow["dynamic_rate"]!=null)
                                        {
                                           $graphVal=$DynamicRaterow["dynamic_rate"];
                                        }
                                        if($Label=='[')
                                        {
                                            $UpadtedDate = new DateTime($DynamicRaterow["updated_date"]);
                                            $X_axis = $UpadtedDate->format('d-m-Y');
                                            $Label=$Label.'"'.$X_axis.'"';
                                            $Value=$Value.$graphVal;
                                            $Value2=$Value2.$strike_price;
                                        }
                                        else
                                        {
                                           $UpadtedDate = new DateTime($DynamicRaterow["updated_date"]);
                                           $X_axis = $UpadtedDate->format('d-m-Y');
                                           //$Label=$Label.','.(intval($DynamicRaterow["version_no"])-1);
                                           $Label=$Label.','.'"'.$X_axis.'"';
                                           $Value=$Value.','.$graphVal;
                                           $Value2=$Value2.','.$strike_price;
                                        }
                                    }
                                    $Label=$Label.']';
                                    $Value=$Value.']';
                                    $Value2=$Value2.']';
                                    ?>
                                    <script type="text/javascript">
                                        var speedCanvas = document.getElementById("lineChart<?php echo $j;?>");
                                        Chart.defaults.global.defaultFontFamily = "Poppins";
                                        Chart.defaults.global.defaultFontSize = 18;
                                        var dataFirst = {
                                            label: "Strike Price",
                                            data: <?php echo $Value2;?>,
                                            lineTension: 0,
                                            fill: false,
                                            borderColor: '#C70000'
                                        };
                                        var dataSecond = {
                                            label: "Dynamic Price",
                                            data: <?php echo $Value;?>,
                                            lineTension: 0,
                                            fill: false,
                                            borderWidth: 2,
                                            pointBorderWidth: 2,
                                            pointHoverRadius: 5,
                                            borderDash: [5,2],
                                            borderColor: '#012145'
                                        };
                                        var speedData = {
                                            labels: <?php echo $Label;?>,
                                            datasets: [dataFirst, dataSecond]
                                        };
                                        var lineChart = new Chart(speedCanvas, {
                                            type: 'line',
                                            data: speedData,
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
                                </div>
                            <!--</div>-->
                            <div class="prop-info">
                                <div class="price mb-4">
                                    <span><?= $Prefix; ?> </span>
                                    <span><?php echo number_format(round($row1["rate"]*$Xrate,2));?></span>
                                </div>
                                <table>
                                    <tr>
                                        <td>Current Discount</td>
                                        <td><?php echo round((($row1["rate"]-$row1["dynamic_rate"])/$row1["rate"])*100,2);?>%  <i class="fas fa-caret-down"></i></td></td>
                                    </tr>
                                    <tr>
                                        <td>Strike Price</td>
                                        <td><?php echo $Prefix." ".number_format(round($row1["strike_price"]*$Xrate,2));?>
                                    </tr>
                                    <tr>
                                        <td>Current Du Val Dynamic Price</td>
                                        <td><?php echo $Prefix." ".number_format(round($row1["dynamic_rate"]*$Xrate,2));?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="actions">
                                <div class="time-holder">
                                    <p>Time Left to take actions</p>
                                    <div class="timer">
                                        <div data-countdown="<?php echo $strip ?>" class="count-skin"></div>
                                    </div>
                                </div>
                                <div class="save-property">
                                    <a href="#"><i class="far fa-heart"></i> Add To My Fav</a> 
                                    <a href="#"><i class="fas fa-folder-open"></i> Add To My Folder</a> 
                                </div>
                                <div class="place">
                                    <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/uploads/<?= "".$row1["IMAGE"];?>" alt=""> <?= $row1["subrub"];?>
                                </div>
                                <a href="<?php echo SITE_BASE_URL; ?>Property/PropertyFullDtl.html?id=<?php echo $row1["property_id"]; ?>" class="btn btn-green">Analyze Property</a>
                            </div>
                        </div>
                    </div>
                        <?php
                        $j=$j+1;
                    }
                    if($j==1)
                    {
                       echo '<div class="card-header">No Records</div>';
                    }
                    ?>
                    <div class="more">
                        <a href="#">
                            <i class="fas fa-arrow-to-bottom"></i>
                        </a>
                    </div>
                </div>
                <div class="tab-pane" id="bdays">
                    <?php
                    $cond1=" and pd.reserved_by='".$LoginUserId."' ";
                    \Property\PropertyClass::Init();
                    $rows1 = \Property\PropertyClass::GetPropertiesDatas('','',$cond1);
                    $j = 1;
                    foreach ($rows1 as $row1)
                    {
                        $effective_date=$row1["effective_date"];
                        $projectName=$row1["project_name"];
                        $country=$row1["country"];
                        $strike_price=$row1["strike_price"];
                        $CountryCodeNew=$row1["Country_Code_New"];
                        $ProjectIdd=$row1["project_id"];
                        $floortype=$row1["floor_type"];
                        $CountryName=$row1["COUNTRY_NAME"];
                        $Projectcurrency=$row1["currency"];
                        $expiry_date=$row1["expiry_date"];
                        $NoOfProperty=$row1["No_of_property"];
                        $NoOfAvProperty=$row1["No_of_Av_property"];
                        $image_file=$row1["image_file"];
                        if($Currency==$Projectcurrency)
                        {
                            $Xrate=1;
                        }
                        else
                        {
                            $Xraterows = \Property\PropertyClass::GetCurrExrate($Projectcurrency,$Currency);
                            foreach ($Xraterows as $Xraterow)
                            {
                                $Xrate=$Xraterow["RATE"];
                            }
                        }
                        if($Xrate=="" || $Xrate==null)
                        {
                            $Xrate=1;
                        }
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
                        $days1 = floor(($diff - $years * 365*60*60*24)/ (60*60*24));
                        $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                        $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
                        $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
                        if($Currency=="NZD")
                        {
                            $Prefix="NZ $";
                        }
                        elseif($Currency=="AUD")
                        {
                            $Prefix="AU $";
                        }
                        elseif($Currency=="GBP")
                        {
                            $Prefix="£";
                        }
                        else
                        {
                            $Prefix=$Currency." ";
                        }
                        ?>
                        <div class="property-slot">
                            <div class="name-bed">
                                <p><?php echo $projectName;?></p>
                                <p><i class="fas fa-bed"></i><?php echo $row1["no_of_bedrooms"];?></p>
                            </div>
                            <div class="ps-flex">
                                <!--<div class="mini-flex">-->
                                    
                                    <div class="img-holder">
                                        <picture>
                                            <source media="(min-width:1600px)" srcset="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $image_file; ?>">
                                            <img src="<?php echo SITE_BASE_URL;?>uploads/propertyimage/<?php echo $image_file; ?>" alt="Flowers">
                                        </picture>
                                    </div>
                                    <div class="graph-holder">
                                        <canvas id="lineChart<?php echo $j;?>"></canvas>
                                        <?php
                                        $DynamicRaterows = \Property\PropertyClass::GetPropertiesDynamicFlow($ProjectIdd,$row1["property_id"]);
                                        $Label='[';
                                        $Value='[';
                                        $Value2='[';
                                        foreach ($DynamicRaterows as $DynamicRaterow)
                                        {
                                            if($DynamicRaterow["dynamic_rate"]!=null)
                                            {
                                               $graphVal=$DynamicRaterow["dynamic_rate"];
                                            }
                                            if($Label=='[')
                                            {
                                                $UpadtedDate = new DateTime($DynamicRaterow["updated_date"]);
                                                $X_axis = $UpadtedDate->format('d-m-Y');
                                                $Label=$Label.'"'.$X_axis.'"';
                                                $Value=$Value.$graphVal;
                                                $Value2=$Value2.$strike_price;
                                            }
                                            else
                                            {
                                               $UpadtedDate = new DateTime($DynamicRaterow["updated_date"]);
                                               $X_axis = $UpadtedDate->format('d-m-Y');
                                               //$Label=$Label.','.(intval($DynamicRaterow["version_no"])-1);
                                               $Label=$Label.','.'"'.$X_axis.'"';
                                               $Value=$Value.','.$graphVal;
                                               $Value2=$Value2.','.$strike_price;
                                            }
                                        }
                                        $Label=$Label.']';
                                        $Value=$Value.']';
                                        $Value2=$Value2.']';
                                        ?>
                                        <script type="text/javascript">
                                            var speedCanvas = document.getElementById("lineChart<?php echo $j;?>");
                                            Chart.defaults.global.defaultFontFamily = "Poppins";
                                            Chart.defaults.global.defaultFontSize = 18;
                                            var dataFirst = {
                                                label: "Strike Price",
                                                data: <?php echo $Value2;?>,
                                                lineTension: 0,
                                                fill: false,
                                                borderColor: '#C70000'
                                            };
                                            var dataSecond = {
                                                label: "Dynamic Price",
                                                data: <?php echo $Value;?>,
                                                lineTension: 0,
                                                fill: false,
                                                borderWidth: 2,
                                                pointBorderWidth: 2,
                                                pointHoverRadius: 5,
                                                borderDash: [5,2],
                                                borderColor: '#012145'
                                            };
                                            var speedData = {
                                                labels: <?php echo $Label;?>,
                                                datasets: [dataFirst, dataSecond]
                                            };
                                            var lineChart = new Chart(speedCanvas, {
                                                type: 'line',
                                                data: speedData,
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
                                    </div>
                                <!--</div>-->
                                <div class="prop-info">
                                    <div class="price mb-4">
                                        <span><?= $Prefix; ?> </span>
                                        <span><?php echo number_format(round($row1["rate"]*$Xrate,2));?></span>
                                    </div>
                                    <table>
                                        <tr>
                                            <td>Current Discount</td>
                                            <td><?php echo round((($row1["rate"]-$row1["dynamic_rate"])/$row1["rate"])*100,2);?>%  <i class="fas fa-caret-down"></i></td></td>
                                        </tr>
                                        <tr>
                                            <td>Strike Price</td>
                                            <td><?php echo $Prefix." ".number_format(round($row1["strike_price"]*$Xrate,2));?>
                                        </tr>
                                        <tr>
                                            <td>Current Du Val Dynamic Price</td>
                                            <td><?php echo $Prefix." ".number_format(round($row1["dynamic_rate"]*$Xrate,2));?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="actions">
                                    <div class="time-holder">
                                        <p>Time Left to take actions</p>
                                        <div class="timer">
                                            <div data-countdown="<?php echo $strip ?>" class="count-skin"></div>
                                        </div>
                                    </div>
                                    <div class="save-property">
                                        <a href="#"><i class="far fa-heart"></i> Add To My Fav</a> 
                                        <a href="#"><i class="fas fa-folder-open"></i> Add To My Folder</a> 
                                    </div>
                                    <div class="place">
                                        <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/uploads/<?= "".$row1["IMAGE"];?>" alt=""> <?= $row1["subrub"];?>
                                    </div>
                                    <a href="<?php echo SITE_BASE_URL; ?>Property/PropertyFullDtl.html?id=<?php echo $row1["property_id"]; ?>" class="btn btn-green">Analyze Property</a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $j=$j+1;
                    }
                    if($j==1)
                    {
                       echo '<div class="card-header">No Records</div>';
                    }
                    ?>
                    <div class="more">
                        <a href="#">
                            <i class="fas fa-arrow-to-bottom"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <h1 class="hero-title-teal">Ways to Increase Growth</h1>
                
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <h1 class="hero-title-dark">Run an Investment Analysis</h1>
                        <div class="invest-panel">
                            <div class="img-holder" style="background-image: url('assets/images/road@2x.png');">
                                <div class="mask">
                                    <a href="#">
                                        Run an Investment Analysis
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <h1 class="hero-title-dark">Run an Investment Analysis</h1>
                        <div class="globe-panel">
                            <div class="g-mask">
                                <p>Lorem Ipsum is a simple dummy text of the printing and typesetting industry</p>
                                <button class="btn btn-orange">Countinue</button>
                            </div>
                            <div class="d-flex">
                                <img src="assets/images/globe.png" class="img-fluid globe-img" alt="">
                                <div class="comming-countries">
                                    <h6>Comming Soon</h6>
                                    <div class="country">
                                        <img src="assets/images/usa.png" alt="">
                                        <span>USA</span>
                                    </div>
                                    <div class="country">
                                        <img src="assets/images/singapor.png" alt="">
                                        <span>Singapore</span>
                                    </div>
                                    <div class="country">
                                        <img src="assets/images/malaysia.png" alt="">
                                        <span>Malaysia</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 no-gutters">
                                <div class="col-4 text-center">
                                    <img src="assets/images/united-kingdom.png" alt="">
                                    <span>United Kingdom</span>
                                </div>
                                <div class="col-4 text-center">
                                    <img src="assets/images/united-kingdom.png" alt="">
                                    <span>United Kingdom</span>
                                </div>
                                <div class="col-4 text-center">
                                    <img src="assets/images/united-kingdom.png" alt="">
                                    <span>United Kingdom</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <h1 class="hero-title-dark">Analyse My Portfolio</h1>
                        <div class="analyze-panel">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Property">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fas fa-plus"></i> ADD</button>
                                </div>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" value=""> Option 1
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optradio"> Option 1
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" value=""> All
                                </label>
                            </div>
                            <div class="filter-checks">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value=""> Avenue Apartments
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value=""> Verge Apartments
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value=""> Lakewood Plaza
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value=""> Mountain Vista Estate
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-green">Analyse Property</button>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <h1 class="hero-title-dark">Run an Investment Analysis</h1>
                        <div class="library-panel">
                            <div class="img-holder" style="background-image: url('assets/images/road@2x.png');">
                                <button class="btn btn-orange">Download Country Guides</button>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row mt-4">
                    <div class="col-xl-9">
                        <h1 class="hero-title-dark">Property Notification <a href="#">Upcoming Property</a></h1>
                        <div class="prop-notification">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="pn-box">
                                        <h2>Rata Terraces</h2>
                                        <div class="flex">
                                            <img src="assets/images/pn-img.png" class="w-100" alt="">
                                            <div class="text">
                                                <span>Start Price: $599,000</span>
                                                <span>Available: 101</span>
                                                <button class="btn btn-add"><i class="fas fa-calendar-alt"></i> Add to My Calendar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="pn-box">
                                        <h2>Verge Apartments</h2>
                                        <div class="flex">
                                            <img src="assets/images/pn-img.png" class="w-100" alt="">
                                            <div class="text">
                                                <span>Start Price: $599,000</span>
                                                <span>Available: 101</span>
                                                <button class="btn btn-add"><i class="fas fa-calendar-alt"></i> Add to My Calendar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="pn-box">
                                        <h2>Verge Apartments</h2>
                                        <div class="flex">
                                            <img src="assets/images/pn-img.png" class="w-100" alt="">
                                            <div class="text">
                                                <span>Start Price: $599,000</span>
                                                <span>Available: 101</span>
                                                <button class="btn btn-add"><i class="fas fa-calendar-alt"></i> Add to My Calendar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="more">
                                <a href="#">
                                    <i class="fas fa-arrow-to-bottom"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <h1 class="hero-title-dark">Automative Valuation Model Report</h1>
                        <div class="avm-report">
                            <div class="d-flex align-items-center">
                                <div class="text">
                                    <h2>NZ & AUS ONLY</h2>
                                    <p>Click on the below button to get your Automative Valuation Model Report for your property</p>
                                </div>
                                <img src="assets/images/avm.svg" alt="">
                            </div>
                            <button class="btn btn-download">Download Report</button>
                        </div>
                    </div>
                </div>



                <div class="row mt-4">
                    <div class="col-xl-4">
                        <h1 class="hero-title-dark">My Portfolio</h1>
                        <div class="v-panel">
                            <div class="text">
                                <div class="tags">
                                    <div class="tag-name">
                                        TOTAL DEBT
                                    </div>
                                    <div class="tag-name red">
                                        TOTAL VALUE
                                    </div>
                                    <div class="tag-name">
                                        ROI/YEILD
                                    </div>
                                    <div class="tag-name">
                                        GROSS ANNUAL RENT
                                    </div>
                                </div>
                                <div class="amount">
                                    <span class="big">[</span><sup>$</sup>15,460M<span class="big">]</span>
                                </div>
                                <button class="btn btn-detail">More Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <h1 class="hero-title-dark">My Contracted Property(s)</h1>
                        <div class="v-panel">
                            <div class="text">
                                <div class="tags">
                                    <div class="tag-name">
                                        TOTAL DEBT
                                    </div>
                                    <div class="tag-name">
                                        TOTAL VALUE
                                    </div>
                                    <div class="tag-name green">
                                        ROI/YEILD
                                    </div>
                                    <div class="tag-name">
                                        GROSS ANNUAL RENT
                                    </div>
                                </div>
                                <div class="amount">
                                    <span class="big">[</span><sup>$</sup>5,260M<span class="big">]</span>
                                </div>
                                <button class="btn btn-detail">More Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <h1 class="hero-title-dark">My Reserved Property(s)</h1>
                        <div class="v-panel">
                            <div class="text">
                                <div class="tags">
                                    <div class="tag-name">
                                        TOTAL DEBT
                                    </div>
                                    <div class="tag-name">
                                        TOTAL VALUE
                                    </div>
                                    <div class="tag-name">
                                        ROI/YEILD
                                    </div>
                                    <div class="tag-name blue">
                                        GROSS ANNUAL RENT
                                    </div>
                                </div>
                                <div class="amount">
                                    <span class="big">[</span><sup>$</sup>850,000K<span class="big">]</span>
                                </div>
                                <button class="btn btn-detail">More Details</button>
                            </div>
                        </div>
                    </div>
                </div>












                


        <!-- <div class="row mt-4">
            <div class="col-12">
                <h1 class="hero-title-dark">My Favorite Project(s)</h1>
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
                            foreach ($rowFavs as $rowFav)
                            {
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
                                        $Prefix="NZ $";
                                    }
                                    elseif($Currency=="AUD")
                                    {
                                        $Prefix="AU $";
                                    }
                                    elseif($Currency=="GBP")
                                    {
                                        $Prefix="£";
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
                                ?> 
                                <div class="item">
                                    <h3><?= $rowFav["PROJECT_NAME"]; ?></h3>
                                    <img src="<?php echo SITE_BASE_URL; ?>uploads/projectimage/<?php echo $rowFav["image_file"];?>" class="w-100" alt="">
                                    <table>
                                        <tbody>
                                            
                                            <tr>
                                                <td>Start Price</td>
                                                <td><?php echo $Prefix." ".round($Start_dynamin_price*$Xrate);?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Status</td>
                                                <td><?= ($AvailableCount > 0) ? "<span class='text-success'>Active</span>" :  '<span class="text-danger">Not Active</span>'?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Dynamic Price Discount%</td>
                                                <td><?php echo $AVG_Discount;?></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                <td>Reserved</td>
                                                <td>
                                                    <?php echo $reservedCount;?>
                                                    <progress max="100" value="<?php echo round(($reservedCount/$totalCount)*100);?>" class="price-progress">
                                                        <div class="progress-bar">
                                                            <span style="width: <?php echo round(($reservedCount/$totalCount)*100);?>%"><?php $reservedCount?></span>
                                                        </div>
                                                    </progress>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Time Left</td>
                                                <td>
                                                    <div class="time-holder">
                                                        <div data-countdown="<?php echo $strip ?>" class="count-skin"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>1 Bedroom</td>
                                                <td><?php echo $one_bet;?> Available</td>
                                            </tr>
                                            <tr>
                                                <td>2 Bedroom</td>
                                                <td><?php echo $two_bet;?> Available</td>
                                            </tr>
                                            <tr>
                                                <td>3 Bedroom</td>
                                                <td><?php echo $three_bet;?> Available</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Estimated Weekly Rent</td>
                                                <td><?php echo $Weekly_rent." ".$Projcurr;?></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                <td>Estimated Yield</td>
                                                <td>8%</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-between">
                                        <a href="<?php echo SITE_BASE_URL;?>Property/ProjectView.html?project_id=<?php echo $rowFav["PROJECT_ID"];?>" class="btn btn-green">More Info</a>
                                    </div>
                                </div>
                                <?php
                                $p=$p+1;
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
                <h1 class="hero-title-dark">My Portfolio</h1>
            </div>
            <div class="col-12">
                <div class="fav-panel">
                    <div class="row">
                        <div class="col-12">
                            <div class="fprop-slider owl-carousel">
                                <?php
                                \Property\PropertyClass::Init();
                                $rows = \Property\PropertyClass::GetPropertyComparison("","","","",$ViewCompare);
                                $IsSameCountry = "Y";
                                $PrevCountryId = "";
                                foreach ($rows as $row) 
                                {
                                    $autoid                = $row["autoid"] ? $row["autoid"] : "" ;
                                    $MyPortFolioName       = $row["property_name"] ?  $row["property_name"] : "";
                                    $Countryname           = $row["country_name"];
                                    $PropertyCountryCode   = $row["country_id"];
                                    $CountryId             = $row["country_id"];
                                    $UnitNumber            = $row["UNIT_NO"] ?  $row["UNIT_NO"] : "";
                                    $DateBought            = $row["purschase_date"] ?  $row["purschase_date"] : "";
                                    $DateCompletion        = $row["completion_date"] ?  $row["completion_date"] : "";
                                    $marketprice           = $row["marketprice"] ?  $row["marketprice"] : "0";
                                    $CurrentValue          = $row["duvaldynamicprice"] ?  $row["duvaldynamicprice"] : "0";
                                    $ProprtyId             = $row["property_id"];
                                    $weeklyrental          = $row["weeklyrental"] ?  $row["weeklyrental"] : "0";
                                    $TotalRentperweek      = floatval($weeklyrental) * 52;
                                    $managementfee         = round($row["managementfees"] ? $row["managementfees"] : "0");
                                    $adminstrationfee      = 0;
                                    $GroundRent            = $row["landleaserentpa"] ?  $row["landleaserentpa"] : "0";
                                    $OtherCosts            = $row["other"] ?  $row["other"] : "0";
                                    $ltv                    = $row["ltv"] ?  $row["ltv"] : "0";
                                    $interestrate           = $row["interestrate"] ?  $row["interestrate"] : "0";
                                    $initialloanamt         = $row["initialloanamt"] ?  $row["initialloanamt"] : "0";
                                    $currtemp               = $row["baseCur"]  ? $row["baseCur"] : "1" ;
                                    $locationame            = $row["location_name"] ?$row["location_name"] :"";
                                    if ( $PrevCountryId != "")
                                    {
                                        if ($PrevCountryId != $CountryId)
                                        {
                                            $IsSameCountry= "N";
                                        }
                                    }
                                    $UsdExRate = "";
                                    $IndexQry = " SELECT currency_id,symbol,country_code FROM currency_master WHERE currency_id ='{$currentCurrency}' ";
                                    $RowsArr = \DBConn\DBConnection::getQuery( $IndexQry );
                                    foreach($RowsArr as $Rows)
                                    {
                                        $Currency1      = $Rows["currency_id"];
                                        $CurrencySym    = $Rows["symbol"];
                                        $countrycode    = $Rows["country_code"];
                                        if($countrycode == "3")
                                        {
                                            $CurrencySym = "£";
                                        }
                                        elseif($countrycode == "5")
                                        {
                                            $CurrencySym = "€";
                                        }
                                    }
                                    $MapCurrecncy = $CurrencySym ." ".$Currency1;
                                    $UsdExRateArr =  \Property\PropertyClass::GetCurrExrate($currentCurrency,$currtemp);
                                    foreach($UsdExRateArr as $UsdEx)
                                    {
                                        $UsdExRate = $UsdEx["RATE"] ? $UsdEx["RATE"] :"1";
                                    }
                                    if ($UsdExRate == "")
                                    {
                                        $UsdExRate = 1;
                                    }    
                                    if($IsSameCurr == "2")
                                    {
                                        $ExrateUsd = "(USD)";
                                    }
                                    else
                                    {
                                        $ExrateUsd = $currtemp;
                                    }
                                    $initialloanamt =  floatval($initialloanamt) / floatval($UsdExRate);
                                    $FinanceCosts           = ((($interestrate / 12) * $initialloanamt) * 12) /100;
                                    \ajax\ajaxClass::Init();
                                    $Prop           =  \ajax\ajaxClass::AnalyzerResult($autoid,"ARRAY");
                                    $PropertyValue            =  floatval($Prop[1]["PropertyValue"])/ floatval($UsdExRate);
                                    $GrossIncome              =  floatval($Prop[1]["GrossIncome"]) / floatval($UsdExRate);
                                    $MortgagePayment          =  floatval($Prop[1]["MortgagePayment"])/ floatval($UsdExRate);
                                    $OperatigExpTotal         =  floatval($Prop[1]["OperatigExpTotal"])/ floatval($UsdExRate);
                                    $NetAnnualReturn          =  $GrossIncome - $OperatigExpTotal;
                                    $NetCashFlow              =  floatval($Prop[1]["NetCashFlow"])/ floatval($UsdExRate);
                                    $NetCashFlowAfterTax      =  floatval($Prop[1]["NetCashFlowAfterTax"])/ floatval($UsdExRate);
                                    $TotalInitialCashCost     =  floatval($Prop[0]["TotalInitialCashCost"])/ floatval($UsdExRate);
                                    $ROI    = ($NetCashFlowAfterTax / $TotalInitialCashCost) * 100 ;
                                    $TotalYieldroi           = $TotalYieldroi + $ROI;
                                    $marketprice   =   floatval($marketprice) / floatval($UsdExRate);
                                ?>
                                <div class="item">
                                    <h3><?php echo $MyPortFolioName;?></h3>
                                    <img src="assets/img/placeholder-img.png" class="w-100" alt="">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Country</td>
                                                <td><?php echo $Countryname; ?></td>
                                            </tr>
                                            <tr>
                                                <td>City</td>
                                                <td><?php echo $locationame;?></td>
                                            </tr>
                                            <tr>
                                                <td>Annual Income</td>
                                                <td><?php echo $CurrencySym; ?><?php echo number_format($NetAnnualReturn);?></td>
                                            </tr>
                                            <tr>
                                                <td>Market Value (E)</td>
                                                <td><?php echo $CurrencySym; ?><?php echo number_format($marketprice);?></td>
                                            </tr>
                                            <tr>
                                                <td>Gross Yield</td>
                                                <td><?php echo number_format($ROI,2);?>%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-green">Analyse</button>
                                        <button class="btn btn-orange">Remove</button>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        

                

                

                

                <div class="row mt-4">
                    <div class="col-12">
                        <h1 class="hero-title-dark">My Favourite Properties</h1>
                    </div>
                    <div class="col-12">
                        <div class="fav-panel">
                            <div class="row">
                                <div class="col-12">
                                    <div class="fprop-slider owl-carousel">
                                        <div class="item">
                                            <h3>Avenue Apartment</h3>
                                            <img src="assets/images/hall.png" class="w-100" alt="">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td>New Zealand</td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td>Auckland</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Annual Income</td>
                                                        <td>$30,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Market Value (E)</td>
                                                        <td>$600,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gross Yield</td>
                                                        <td>5%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-green">Analyse</button>
                                                <button class="btn btn-orange">Remove</button>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <h3>Avenue Apartment</h3>
                                            <img src="assets/images/living.png" class="w-100" alt="">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td>New Zealand</td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td>Auckland</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Annual Income</td>
                                                        <td>$30,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Market Value (E)</td>
                                                        <td>$600,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gross Yield</td>
                                                        <td>5%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-green">Analyse</button>
                                                <button class="btn btn-orange">Remove</button>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <h3>Avenue Apartment</h3>
                                            <img src="assets/images/plaza.png" class="w-100" alt="">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td>New Zealand</td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td>Auckland</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Annual Income</td>
                                                        <td>$30,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Market Value (E)</td>
                                                        <td>$600,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gross Yield</td>
                                                        <td>5%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-green">Analyse</button>
                                                <button class="btn btn-orange">Remove</button>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <h3>Avenue Apartment</h3>
                                            <img src="assets/images/bed.png" class="w-100" alt="">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td>New Zealand</td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td>Auckland</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Annual Income</td>
                                                        <td>$30,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Market Value (E)</td>
                                                        <td>$600,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gross Yield</td>
                                                        <td>5%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-green">Analyse</button>
                                                <button class="btn btn-orange">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row mt-4">
                    <div class="col-12">
                        <h1 class="hero-title-dark">My Favourite Properties</h1>
                    </div>
                    <div class="col-12">
                        <div class="fav-panel">
                            <div class="row">
                                <div class="col-12">
                                    <div class="fprop-slider owl-carousel">
                                        <div class="item">
                                            <h3>Avenue Apartment</h3>
                                            <img src="assets/images/hall.png" class="w-100" alt="">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td>New Zealand</td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td>Auckland</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Annual Income</td>
                                                        <td>$30,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Market Value (E)</td>
                                                        <td>$600,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gross Yield</td>
                                                        <td>5%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-green">Analyse</button>
                                                <button class="btn btn-orange">Remove</button>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <h3>Avenue Apartment</h3>
                                            <img src="assets/images/living.png" class="w-100" alt="">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td>New Zealand</td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td>Auckland</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Annual Income</td>
                                                        <td>$30,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Market Value (E)</td>
                                                        <td>$600,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gross Yield</td>
                                                        <td>5%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-green">Analyse</button>
                                                <button class="btn btn-orange">Remove</button>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <h3>Avenue Apartment</h3>
                                            <img src="assets/images/plaza.png" class="w-100" alt="">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td>New Zealand</td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td>Auckland</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Annual Income</td>
                                                        <td>$30,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Market Value (E)</td>
                                                        <td>$600,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gross Yield</td>
                                                        <td>5%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-green">Analyse</button>
                                                <button class="btn btn-orange">Remove</button>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <h3>Avenue Apartment</h3>
                                            <img src="assets/images/bed.png" class="w-100" alt="">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Country</td>
                                                        <td>New Zealand</td>
                                                    </tr>
                                                    <tr>
                                                        <td>City</td>
                                                        <td>Auckland</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Annual Income</td>
                                                        <td>$30,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Market Value (E)</td>
                                                        <td>$600,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gross Yield</td>
                                                        <td>5%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-green">Analyse</button>
                                                <button class="btn btn-orange">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="row mt-4">
                    <div class="col-12">
                        <h1 class="hero-title-dark">View Recently Viewed Properties</h1>
                    </div>
                    <div class="col-12">
                        <div class="viewed-panel">
                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <h3>Avenue Apartments | Auckland , New Zealand</h3>
                                    <p>
                                        <i class="fas fa-bed"></i> <span>1 Bed</span> <i class="fal fa-car"></i> 1 Car Park <i class="fal fa-bath"></i> 1 Bath
                                    </p>
                                    <div class="d-flex alig-items-start">
                                        <img src="assets/images/rv.png" alt="">
                                        <div class="text">
                                            <div class="slot">
                                                <span>Retail Asking Price</span>
                                                <span>NZ $550,000</span>
                                            </div>
                                            <div class="slot">
                                                <span>Strike Price</span>
                                                <span>NZ $520,450</span>
                                            </div>
                                            <div class="slot">
                                                <span>Discount</span>
                                                <span>8.8%</span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" style="width:80%"></div>
                                            </div>
                                            <div class="prog-text d-flex justify-content-between">
                                                <span>Reserved 80</span>
                                                <span>Reserved 20</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <h3>Avenue Apartments | Auckland , New Zealand</h3>
                                    <p>
                                        <i class="fas fa-bed"></i> <span>1 Bed</span> <i class="fal fa-car"></i> 1 Car Park <i class="fal fa-bath"></i> 1 Bath
                                    </p>
                                    <div class="d-flex alig-items-start">
                                        <img src="assets/images/rv.png" alt="">
                                        <div class="text">
                                            <div class="slot">
                                                <span>Retail Asking Price</span>
                                                <span>NZ $550,000</span>
                                            </div>
                                            <div class="slot">
                                                <span>Strike Price</span>
                                                <span>NZ $520,450</span>
                                            </div>
                                            <div class="slot">
                                                <span>Discount</span>
                                                <span>8.8%</span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" style="width:80%"></div>
                                            </div>
                                            <div class="prog-text d-flex justify-content-between">
                                                <span>Reserved 80</span>
                                                <span>Reserved 20</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <h3>Avenue Apartments | Auckland , New Zealand</h3>
                                    <p>
                                        <i class="fas fa-bed"></i> <span>1 Bed</span> <i class="fal fa-car"></i> 1 Car Park <i class="fal fa-bath"></i> 1 Bath
                                    </p>
                                    <div class="d-flex alig-items-start">
                                        <img src="assets/images/rv.png" alt="">
                                        <div class="text">
                                            <div class="slot">
                                                <span>Retail Asking Price</span>
                                                <span>NZ $550,000</span>
                                            </div>
                                            <div class="slot">
                                                <span>Strike Price</span>
                                                <span>NZ $520,450</span>
                                            </div>
                                            <div class="slot">
                                                <span>Discount</span>
                                                <span>8.8%</span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" style="width:80%"></div>
                                            </div>
                                            <div class="prog-text d-flex justify-content-between">
                                                <span>Reserved 80</span>
                                                <span>Reserved 20</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <h3>Avenue Apartments | Auckland , New Zealand</h3>
                                    <p>
                                        <i class="fas fa-bed"></i> <span>1 Bed</span> <i class="fal fa-car"></i> 1 Car Park <i class="fal fa-bath"></i> 1 Bath
                                    </p>
                                    <div class="d-flex alig-items-start">
                                        <img src="assets/images/rv.png" alt="">
                                        <div class="text">
                                            <div class="slot">
                                                <span>Retail Asking Price</span>
                                                <span>NZ $550,000</span>
                                            </div>
                                            <div class="slot">
                                                <span>Strike Price</span>
                                                <span>NZ $520,450</span>
                                            </div>
                                            <div class="slot">
                                                <span>Discount</span>
                                                <span>8.8%</span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" style="width:80%"></div>
                                            </div>
                                            <div class="prog-text d-flex justify-content-between">
                                                <span>Reserved 80</span>
                                                <span>Reserved 20</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Inner Content End-->

        </div>
        <!-- Right Wrapper End -->

    </div>

    </div>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css">
<?php include"footer.php"; ?>
<link rel="stylesheet" href="<?php echo SITE_BASE_URL;?>assets/plugins/magnific-popup/magnific-popup.css">
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/magnific-popup/jquery.magnific-popup.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
     $('#lightSlider').lightSlider({
         item:4,
         loop:false,
         slideMove:1,
         easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
         slideMargin:15,
         speed:600,
         enableDrag:false,
         responsive : [
             {
                 breakpoint:800,
                 settings: {
                     item:3,
                     slideMove:1,
                     slideMargin:4,
                   }
             },
             {
                 breakpoint:480,
                 settings: {
                     item:2,
                     slideMove:1,
                     slideMargin:4,
                   }
             }
         ]
     });
   });
</script>
<!-- owl crousal -->
<!-- dataTables -->
<script src="assets/plugins/datatables/datatables.min.js"></script>
<script src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/jszip.min.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/pdfmake.min.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/datatables-init.js"></script>
<script>
   $('.data-table').dataTable({
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       // dom: 'Bfrtip',
       // buttons: [
       //     'excelHtml5',
       //     'csvHtml5',
       //     'pdfHtml5'
       // ]
   });
   
   $('.data-table2').dataTable({
       "lengthMenu": [[5, 15, 50, -1], [5, 15, 50, "All"]],
       // dom: 'Bfrtip',
       // buttons: [
       //     'excelHtml5',
       //     'csvHtml5',
       //     'pdfHtml5'
       // ]
   });
   
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
        // $('.image-expand').magnificPopup({
        //   type: 'image'
        //   // other options
        // });
</script>

<script src="assets/plugins/jquery.countdown-2.0.4/jquery.countdown.min.js"></script>
<script>
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


</script>