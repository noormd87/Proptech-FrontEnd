<?php include"header.php"; 

$country = $_REQUEST["country"];

$project_id = $_REQUEST["project_id"];

if($_REQUEST["IsHurry"]=='Y')

{

    $Condition=" AND expiry_date< NOW() + INTERVAL 3 DAY and expiry_date > NOW() and effective_date < NOW() and pj.country='".$country."' ";

}

\login\loginClass::Init();

$checkSession = \login\loginClass::CheckUserSessionIp();

?>

<link rel="stylesheet" href="<?php echo SITE_BASE_URL;?>assets/plugins/magnific-popup/magnific-popup.css">

<script src="<?php echo SITE_BASE_URL;?>assets/plugins/magnific-popup/jquery.magnific-popup.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/css/apexcharts.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/apexcharts/css/apexcharts.min.css.map">

<script src="<?php echo SITE_BASE_URL; ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<style>

    .refine-search .form-control{

        background:none !important;

    }

</style>

<!--================================Search=====================================-->

<?php

$EstYield=$_REQUEST["EstYield"];

$MinPrice=$_REQUEST["MinPrice"];

$MaxPrice=$_REQUEST["MaxPrice"];

$City=$_REQUEST["$City"];

$Discount=$_REQUEST["Discount"];

$NoofBed=$_REQUEST["NoofBed"];

$Address=$_REQUEST["Address"];

$CompletionDate=$_REQUEST["CompletionDate"];

if($NoofBed!="")

{

    $condPropSearch.=" AND pd.no_of_bedrooms='" .$NoofBed. "'";

}

if($MinPrice!="")

{

    $condPropSearch.=" AND ( start_rate -( (start_rate - dpo_rate) *( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID AND reserved_by is NOT NULL ) /( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID ) ) )>='" .$MinPrice. "'";

}

if($MaxPrice!="")

{

    $condPropSearch.=" AND ( start_rate -( (start_rate - dpo_rate) *( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID AND reserved_by is NOT NULL ) /( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID ) ) )<='" .$MaxPrice. "'";

}

if($Discount!="")

{

    $condPropSearch.=" AND round(((rate-( start_rate -( (start_rate - dpo_rate) *( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID AND reserved_by is NOT NULL ) /

    ( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID ) ) ))/rate)*100) ='" .$Discount. "'";

}

if($CompletionDate!="")

{

    $Condition.=" AND pj.completion_date = STR_TO_DATE('" .$CompletionDate. "','%m/%d/%Y')";

}

if($City!="")

{

    $Condition.=" AND upper(pj.subrub) like upper('%" .$City. "%')";

}

if($Address!="")

{

    $Condition.=" AND upper(pj.Address) like upper('%" .$Address. "%')";

}

?>

<div class="inner-wrapper">

    <div class="grd-content">

        <div class="row">

            <div class="col-12">

                <h1 class="hero-title-dark">Property Search</h1>

            </div>

            <div class="col-12">

                <div class="sf-wrap">
                    <h2>
                    Search for new properties
                    </h2>
                    <div class="search-filters">
                        <form class="form-style-one" name="frmSearch" id="frmSearch" method="post" action="">
                            <div class="option mb-3">
                                <div class="group-drops">
                                    <select class="form-control" name="country">
           	  				        <?php
                                    \Portfolio\PortfolioClass::Init();
                                    $rows = \Portfolio\PortfolioClass::GetCountryData();
                                    foreach ($rows as $row) 
                                    {
                                    ?>
                                        <option value="<?php echo $row["COUNTRY_CODE"]; ?>"  <?php if( $_REQUEST['country'] == $row["COUNTRY_CODE"] ) {?>   selected <?php } ?>  > <?php echo $row["COUNTRY_NAME"]; ?> </option>
                                    <?php
                                    }
                                    ?>
               	  				    </select>
               	  				  </div>  
                            </div>
                            <div class="option mb-3">
                                <div class="group-drops">
                                    <input type="text" class="form-control" name="city" placeholder="City" value='<?= $_REQUEST['city'];?>'>
                                </div>
                            </div>
                            <div class="option mb-3">
                                <div class="group-drops">
                                    <select name="min_range" class="form-control" >
                                        <option value="">---Min Price---</option>
                                        <option <?= ($_REQUEST['min_range'] == '150000') ? 'selected' : '' ;?> value="150000">$150,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '200000') ? 'selected' : '' ;?> value="200000">$200,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '250000') ? 'selected' : '' ;?> value="250000">$250,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '300000') ? 'selected' : '' ;?> value="300000">$300,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '350000') ? 'selected' : '' ;?> value="350000">$350,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '400000') ? 'selected' : '' ;?> value="400000">$400,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '450000') ? 'selected' : '' ;?> value="450000">$450,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '500000') ? 'selected' : '' ;?> value="500000">$500,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '550000') ? 'selected' : '' ;?> value="550000">$550,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '600000') ? 'selected' : '' ;?> value="600000">$600,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '650000') ? 'selected' : '' ;?> value="650000">$650,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '700000') ? 'selected' : '' ;?> value="700000">$700,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '750000') ? 'selected' : '' ;?> value="750000">$750,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '800000') ? 'selected' : '' ;?> value="800000">$800,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '850000') ? 'selected' : '' ;?> value="850000">$850,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '900000') ? 'selected' : '' ;?> value="900000">$900,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '950000') ? 'selected' : '' ;?> value="950000">$950,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '1000000') ? 'selected' : '' ;?> value="1000000">$1,000,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '1100000') ? 'selected' : '' ;?> value="1100000">$1,100,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '1200000') ? 'selected' : '' ;?> value="1200000">$1,200,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '1300000') ? 'selected' : '' ;?> value="1300000">$1,300,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '1400000') ? 'selected' : '' ;?> value="1400000">$1,400,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '1500000') ? 'selected' : '' ;?> value="1500000">$1,500,000</option>
                                        <option <?= ($_REQUEST['min_range'] == '2000000') ? 'selected' : '' ;?> value="2000000">$2,000,000</option>
                                    </select>
                                </div>
                            </div>
                            <div class="option mb-3">
                                <div class="group-drops">
                                    <select name="max_range" class="form-control" >
                                        <option value="">---Max Price---</option>
                                        <option <?= ($_REQUEST['max_range'] == '150000' ) ? 'selected' : ''; ?> value="150000">$150,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '200000' ) ? 'selected' : ''; ?> value="200000">$200,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '250000' ) ? 'selected' : ''; ?> value="250000">$250,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '300000' ) ? 'selected' : ''; ?> value="300000">$300,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '350000' ) ? 'selected' : ''; ?> value="350000">$350,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '400000' ) ? 'selected' : ''; ?> value="400000">$400,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '450000' ) ? 'selected' : ''; ?> value="450000">$450,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '500000' ) ? 'selected' : ''; ?> value="500000">$500,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '550000' ) ? 'selected' : ''; ?> value="550000">$550,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '600000' ) ? 'selected' : ''; ?> value="600000">$600,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '650000' ) ? 'selected' : ''; ?> value="650000">$650,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '700000' ) ? 'selected' : ''; ?> value="700000">$700,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '750000' ) ? 'selected' : ''; ?> value="750000">$750,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '800000' ) ? 'selected' : ''; ?> value="800000">$800,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '850000' ) ? 'selected' : ''; ?> value="850000">$850,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '900000' ) ? 'selected' : ''; ?> value="900000">$900,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '950000' ) ? 'selected' : ''; ?> value="950000">$950,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '1000000' ) ? 'selected' : ''; ?> value="1000000">$1,000,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '1100000' ) ? 'selected' : ''; ?> value="1100000">$1,100,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '1200000' ) ? 'selected' : ''; ?> value="1200000">$1,200,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '1300000' ) ? 'selected' : ''; ?> value="1300000">$1,300,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '1400000' ) ? 'selected' : ''; ?> value="1400000">$1,400,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '1500000' ) ? 'selected' : ''; ?> value="1500000">$1,500,000</option>
                                        <option <?= ($_REQUEST['max_range'] == '2000000' ) ? 'selected' : ''; ?> value="2000000">$2,000,000</option>
                                    </select>
                                </div>
                            </div>
                            <div class="option mb-3">
                                <div class="group-drops">
                                    <input type="text" class="form-control" name="Discount" placeholder="Discount %" value='<?= $_REQUEST['Discount'];?>'>
                                </div>
                            </div>
                            <div class="option mb-3">
                                <div class="group-drops">
                                    <input type="text" class="form-control" name="EstYield" placeholder="Estimated yield" value='<?= $_REQUEST['EstYield'];?>'>
                                </div>
                            </div>
                            <div class="option mb-3">
                                <div class="group-drops">
                                    <input type="text" class="form-control" name="NoofBed" placeholder="Number of Bedrooms" value="<?= $_REQUEST['NoofBed'];?>">
                                </div>
                            </div>
                            <div class="option mb-3">
                                <div class="group-drops">
                                    <input type="text" class="form-control" name="days_uncl" placeholder="Days until closing" value="<?= $_REQUEST['days_uncl'];?>">
                                </div>
                            </div>
                            <div class="option text-right">
                                <button type="submit" name="btn_search" class="btn btn-orange ml-auto">SEARCH</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
                <div class="col-12">
                    <h1 class="hero-title-dark">Available Properties</h1>
                </div>
                <div class="col-12">
                    <div class="reserved-property">
                        <?php

                        \Property\PropertyClass::Init();
                        $condition = '';
                        if($_SERVER['REQUEST_METHOD'] == "POST")
                        {
                            if(isset($_REQUEST['btn_search']))
                            {
                                $estimated_yeild    = $_REQUEST['EstYield'];
                                $country            = $_REQUEST['country'];
                                $city               = $_REQUEST['city'];
                                $discount           = $_REQUEST['Discount'];
                                $no_of_bed          = $_REQUEST['NoofBed'];
                                $days_uncl          = $_REQUEST['days_uncl'];
                                $Condition .= "AND ( 1=1";
                                if($estimated_yeild != "")
                                {
                                    $Condition .= " AND pj.estimated_yield = '". $estimated_yeild  ."'";
                                }
                                if($country != "")
                                {
                                    $Condition .= " AND pj.COUNTRY = " . $country . "";
                                }
                                if($city != "")
                                {
                                    $Condition .= " AND pj.subrub LIKE '%".$city."%' ";
                                }
                                
                                if($city != "")
                                {
                                    $Condition .= " AND pj.subrub LIKE '%".$city."%' ";
                                }
                                
                                if($no_of_bed != '')
                                {
                                    $Condition .= " AND pj.NO_OF_PROPERTY = '" . $no_of_bed . "' ";
                                }
                                $Condition .= ")";
                                
                            }
                        }
                        
                        // print_r( $Condition );
                        // die();
                        
                        $Projectrows = \Property\PropertyClass::GetPorjectDatas($country,$project_id,$Condition);

                        $i = 1;

                        foreach ($Projectrows as $Projectrow) 

                        {

                            $project_id = isset($Projectrow["PROJECT_ID"]) ? $Projectrow["PROJECT_ID"] : ""; 

                            $project_currency = isset($Projectrow["currency"]) ? $Projectrow["currency"] : ""; 
                            
                            $projectDescription = $Projectrow["PROJECT_DESCRIPTION"];
                            
                             $key_features = $Projectrow['key_features'];

                            $date = date("Y-m-d h:i:s");

                            $expiry_date=$Projectrow["expiry_date"];

                            $createDate = new DateTime($expiry_date);

                            $strip = $createDate->format('Y-m-d');

                            $date1 = strtotime($date);

                            $expiry_date1 = strtotime($expiry_date);

                            $diff = abs($expiry_date1 - $date1);

                            $years = floor($diff / (365*60*60*24));

                            $days1 = floor(($diff - $years * 365*60*60*24 )/ (60*60*24));

                            if($_REQUEST["NoOfDays"]!=""  )

                            {

                                $NoOfday=$_REQUEST["NoOfDays"];

                            }

                            else

                            {

                                $NoOfday=1000;

                            }

                            if($days1<=$NoOfday )

                            {
                                $bedcount = 0;
                                $rowsells = \Property\PropertyClass::ProjectSellingDtl($project_id);

                                foreach ($rowsells as $rowsell) 

                                {

                                    $reservedCount=$rowsell["reserved_count"];

                                    $soldCount=$rowsell["sold_count"];

                                    $totalCount=$rowsell["total_count"];

                                    $Available=$totalCount-$reservedCount;

                                    $Start_dynamin_price=$rowsell["Start_dynamin_price"];

                                    $one_bet=$rowsell["one_bet"];

                                    $two_bet=$rowsell["two_bet"];

                                    $three_bet=$rowsell["three_bet"];
                                    
                                    $bedcount += ($one_bet*1) + ($two_bet*2) + ($three_bet*3);
                                    
                                    $Rent_one_bet=$rowsell["Rent_one_bet"];

                                    $Rent_two_bet=$rowsell["Rent_two_bet"];
                                    
                                    $AVG_Discount=round($rowsell["AVG_Discount"]);

                                    $Rent_three_bet=$rowsell["Rent_three_bet"];

                                    $Weekly_rent=$rowsell["Weekly_rent"];

                                    $Projcurr=$Projectrow["currency"];

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

                                    if($Xrate=="" || $Xrate==null)

                                    {

                                        $Xrate=1;

                                    }

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

                                }
                                $rowMinValues  = \Property\PropertyClass::get_lowest_property($Projectrow['PROJECT_ID']);
                                foreach($rowMinValues as $minVal)
                                {
                                    $askingPrice    = $minVal['asking_price'];
                                    $strikePrice    = $minVal['strike_price'];
                                    $dynamicPrice   = $minVal['dynamic_price'];
                                    $grossYeild     = $minVal['gross_yeild'];
                                }
                                if($_SERVER['REQUEST_METHOD'] == "POST")
                                {
                                    $min_range        = $_REQUEST['min_range'];
                                    $max_range        = $_REQUEST['max_range'];
                                    $flag = true;
                                    if($Start_dynamin_price > $min_range && $Start_dynamin_price < $max_range)
                                    {
                                        // echo "abc d";
                                        // die();
                                        ?>
                                        <div class="property-slot">

                                            <div class="prop-name-addr">
                    
                                                <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/prop-logo.svg" alt=""> <?php echo $Projectrow["PROJECT_NAME"].' | '.$Projectrow["subrub"];?></p>
                    
                                                <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/flag-icon.png" alt="">  </p>
                    
                                            </div>
                    
                                            <div class="ps-flex">
                    
                                                <!--<div class="mini-flex">-->
                    
                                                <div class="gallery-holder">
                    
                                                    <div id="soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" class="carousel slide" data-ride="carousel">
                    
                                                        <div class="carousel-inner">
                                                            <div class="carousel-item active">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file"];?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php if($Projectrow["image_file1"]!='') {?>
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }
                                                            if($Projectrow["image_file2"]!='') {?>
                                                            
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }
                                                            if($Projectrow["image_file3"]!='') {?>
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }?>
                                                        </div>
                                                        <ul class="carousel-indicators">
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="0" class="active">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file"];?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php if($Projectrow["image_file1"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="1">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php }
                                                            if($Projectrow["image_file2"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="2">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php }
                                                            if($Projectrow["image_file3"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="3">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
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

                                                        <div class="fav" id = "addtofav<?= $Projectrow["PROJECT_ID"]?>">

                                                        <?php
                                                        if (\Property\PropertyClass::check_project_fav($Projectrow["PROJECT_ID"], $LoginUserId)) {
                                                            ?>
                                                            <a  href="javascript:void(0);" onclick="removeFromFavourite(<?= $Projectrow['PROJECT_ID']; ?>,<?= $LoginUserId;?>, 'addtofav<?= $Projectrow['PROJECT_ID']?>')" >
                                                                <i class="fas fa-heart"></i> Remove From My Favourites</a>
                                                            <!--<a href="<?= SITE_BASE_URL; ?>Property/RemoveFavorite.html?ProjectId=<?php echo $Projectrow['PROJECT_ID']; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="fas fa-heart"></i> Remove From My Favourites</a>-->

                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a  href="javascript:void(0);" onclick="addToFavourite(<?= $Projectrow['PROJECT_ID']; ?>,<?= $LoginUserId; ?>, 'addtofav<?= $Projectrow['PROJECT_ID']?>')">
                                                                <i class="far fa-heart"></i> Add To My Favourites</a>

                                                            <!--<a href="<?= SITE_BASE_URL; ?>Property/AddToFavorite.html?ProjectId=<?php echo $Projectrow['PROJECT_ID']; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="far fa-heart"></i> Add To My Favourites</a>-->

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
                    
                                                                <span><?= number_format(round($Start_dynamin_price*$Xrate)); ?></span>
                    
                                                            </div>
                    
                                                            <table>
                    
                                                                <tr>
                    
                                                                    <td>Retail Asking Price From</td>
                    
                                                                    <td><?php echo number_format(round($askingPrice*$Xrate));?></td>
                    
                                                                    <td>Discount %</td>
                    
                                                                    <td><?php echo $AVG_Discount;?>%</td>
                    
                                                                </tr>
                    
                                                                <tr>
                                                                    <td>Strike Price From</td>
                    
                                                                    <td><?php echo number_format(round($strikePrice*$Xrate));?></td>
                    
                                                                    <td>Days Left</td>
                    
                                                                    <td><?php echo $days1;?></td>
                    
                                                                </tr>
                    
                                                                <tr>
                                                                    <td>Dynamic Price From</td>
                                                                    <td><?= number_format(round(($dynamicPrice == '' || $dynamicPrice == null ) ? ($askingPrice*$Xrate) : ($dynamicPrice*$Xrate) )); ?></td>
                                                                    <td>Reserved</td>
                                                                    <td>
                    
                                                                        <?php echo $reservedCount;?> / Avaialable <?= $totalCount - $reservedCount;?>
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
                                                                    <td><?= $grossYeild; ?></td>
                                                                    
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
                    
                                                    $rows_c = \Property\PropertyClass::getCountryDatas($Projectrow["Country"],'');
                    
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
                    
                                                        <div id='map<?= $Projectrow["PROJECT_ID"];?>'></div>
                    
                                                        <script>
                    
                                                            mapboxgl.accessToken = 'pk.eyJ1IjoibGluZXp0ZWNobm9sb2dpZXMiLCJhIjoiY2tnYWU1a2tiMDY3bDJ3bzRqZTNjMnp3bCJ9.8LTEpznqgfn98PokzO6TQQ';
                    
                                                            var map<?= $Projectrow["PROJECT_ID"];?> = new mapboxgl.Map({
                    
                                                                container: 'map<?= $Projectrow["PROJECT_ID"];?>',
                    
                                                                style: 'mapbox://styles/mapbox/streets-v11',
                    
                                                                center: [<?= $CountryLngDB; ?>, <?= $CountryLatDB; ?>],
                    
                                                                zoom: 12
                    
                                                            });
                    
                                                        </script>
                    
                                                    </div>
                    
                                                    <a href="<?php echo SITE_BASE_URL; ?>Property/ProjectView.html?project_id=<?php echo $Projectrow["PROJECT_ID"]; ?>" class="btn btn-green">Available Properties</a>
                    
                                                </div>
                    
                                            </div>
                    
                                        </div>
            
                                        <?php
                                    }
                                    else { $flag = false;}
                                    if($discount === $AVG_Discount)
                                    {
                                        // echo "abc d";
                                        // die();
                                        ?>
                                        <div class="property-slot">

                                            <div class="prop-name-addr">
                    
                                                <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/prop-logo.svg" alt=""> <?php echo $Projectrow["PROJECT_NAME"].' | '.$Projectrow["subrub"];?></p>
                    
                                                <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/flag-icon.png" alt="">  </p>
                    
                                            </div>
                    
                                            <div class="ps-flex">
                    
                                                <!--<div class="mini-flex">-->
                    
                                                <div class="gallery-holder">
                    
                                                    <div id="soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" class="carousel slide" data-ride="carousel">
                    
                                                        <div class="carousel-inner">
                                                            <div class="carousel-item active">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file"];?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php if($Projectrow["image_file1"]!='') {?>
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }
                                                            if($Projectrow["image_file2"]!='') {?>
                                                            
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }
                                                            if($Projectrow["image_file3"]!='') {?>
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }?>
                                                        </div>
                                                        <ul class="carousel-indicators">
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="0" class="active">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file"];?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php if($Projectrow["image_file1"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="1">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php }
                                                            if($Projectrow["image_file2"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="2">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php }
                                                            if($Projectrow["image_file3"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="3">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
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
                    
                                                        <div class="fav" id = "addtofav<?= $Projectrow["PROJECT_ID"]?>">

                                                            <?php
                                                            if (\Property\PropertyClass::check_project_fav($Projectrow["PROJECT_ID"], $LoginUserId)) {
                                                                ?>
                                                                <a  href="javascript:void(0);" onclick="removeFromFavourite(<?= $Projectrow['PROJECT_ID']; ?>,<?= $LoginUserId;?>, 'addtofav<?= $Projectrow['PROJECT_ID']?>')" >
                                                                    <i class="fas fa-heart"></i> Remove From My Favourites</a>
                                                                <!--<a href="<?= SITE_BASE_URL; ?>Property/RemoveFavorite.html?ProjectId=<?php echo $Projectrow['PROJECT_ID']; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="fas fa-heart"></i> Remove From My Favourites</a>-->

                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a  href="javascript:void(0);" onclick="addToFavourite(<?= $Projectrow['PROJECT_ID']; ?>,<?= $LoginUserId; ?>, 'addtofav<?= $Projectrow['PROJECT_ID']?>')">
                                                                    <i class="far fa-heart"></i> Add To My Favourites</a>

                                                                <!--<a href="<?= SITE_BASE_URL; ?>Property/AddToFavorite.html?ProjectId=<?php echo $Projectrow['PROJECT_ID']; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="far fa-heart"></i> Add To My Favourites</a>-->

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
                    
                                                                <span><?= number_format(round($Start_dynamin_price*$Xrate)); ?></span>
                    
                                                            </div>
                    
                                                            <table>
                    
                                                                <tr>
                    
                                                                    <td>Retail Asking Price From</td>
                    
                                                                    <td><?php echo number_format(round($askingPrice*$Xrate));?></td>
                    
                                                                    <td>Discount %</td>
                    
                                                                    <td><?php echo $AVG_Discount;?>%</td>
                    
                                                                </tr>
                    
                                                                <tr>
                                                                    <td>Strike Price From</td>
                    
                                                                    <td><?php echo number_format(round($strikePrice*$Xrate));?></td>
                    
                                                                    <td>Days Left</td>
                    
                                                                    <td><?php echo $days1;?></td>
                    
                                                                </tr>
                    
                                                                <tr>
                                                                    <td>Dynamic Price From</td>
                                                                    <td><?= number_format(round(($dynamicPrice == '' || $dynamicPrice == null ) ? ($askingPrice*$Xrate) : ($dynamicPrice*$Xrate) )); ?></td>
                                                                    <td>Reserved</td>
                                                                    <td>
                    
                                                                        <?php echo $reservedCount;?> / Avaialable <?= $totalCount - $reservedCount;?>
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
                                                                    <td><?= $grossYeild; ?></td>
                                                                    
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
                    
                                                    $rows_c = \Property\PropertyClass::getCountryDatas($Projectrow["Country"],'');
                    
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
                    
                                                        <div id='map<?= $Projectrow["PROJECT_ID"];?>'></div>
                    
                                                        <script>
                    
                                                            mapboxgl.accessToken = 'pk.eyJ1IjoibGluZXp0ZWNobm9sb2dpZXMiLCJhIjoiY2tnYWU1a2tiMDY3bDJ3bzRqZTNjMnp3bCJ9.8LTEpznqgfn98PokzO6TQQ';
                    
                                                            var map<?= $Projectrow["PROJECT_ID"];?> = new mapboxgl.Map({
                    
                                                                container: 'map<?= $Projectrow["PROJECT_ID"];?>',
                    
                                                                style: 'mapbox://styles/mapbox/streets-v11',
                    
                                                                center: [<?= $CountryLngDB; ?>, <?= $CountryLatDB; ?>],
                    
                                                                zoom: 12
                    
                                                            });
                    
                                                        </script>
                    
                                                    </div>
                    
                                                    <a href="<?php echo SITE_BASE_URL; ?>Property/ProjectView.html?project_id=<?php echo $Projectrow["PROJECT_ID"]; ?>" class="btn btn-green">Available Properties</a>
                    
                                                </div>
                    
                                            </div>
                    
                                        </div>
            
                                        <?php
                                    }
                                    else { $flag = false;}
                                    if($no_of_bed >= $bedcount)
                                    {
                                        // echo "abc d";
                                        // die();
                                        ?>
                                        <div class="property-slot">

                                            <div class="prop-name-addr">
                    
                                                <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/prop-logo.svg" alt=""> <?php echo $Projectrow["PROJECT_NAME"].' | '.$Projectrow["subrub"];?></p>
                    
                                                <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/flag-icon.png" alt="">  </p>
                    
                                            </div>
                    
                                            <div class="ps-flex">
                    
                                                <!--<div class="mini-flex">-->
                    
                                                <div class="gallery-holder">
                    
                                                    <div id="soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" class="carousel slide" data-ride="carousel">
                    
                                                        <div class="carousel-inner">
                                                            <div class="carousel-item active">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file"];?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php if($Projectrow["image_file1"]!='') {?>
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }
                                                            if($Projectrow["image_file2"]!='') {?>
                                                            
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }
                                                            if($Projectrow["image_file3"]!='') {?>
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }?>
                                                        </div>
                                                        <ul class="carousel-indicators">
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="0" class="active">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file"];?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php if($Projectrow["image_file1"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="1">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php }
                                                            if($Projectrow["image_file2"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="2">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php }
                                                            if($Projectrow["image_file3"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="3">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
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
                    
                                                        <div class="fav" id = "addtofav<?= $Projectrow["PROJECT_ID"]?>">

                                                        <?php
                                                        if (\Property\PropertyClass::check_project_fav($Projectrow["PROJECT_ID"], $LoginUserId)) {
                                                            ?>
                                                            <a  href="javascript:void(0);" onclick="removeFromFavourite(<?= $Projectrow['PROJECT_ID']; ?>,<?= $LoginUserId;?>, 'addtofav<?= $Projectrow['PROJECT_ID']?>')" >
                                                                <i class="fas fa-heart"></i> Remove From My Favourites</a>
                                                            <!--<a href="<?= SITE_BASE_URL; ?>Property/RemoveFavorite.html?ProjectId=<?php echo $Projectrow['PROJECT_ID']; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="fas fa-heart"></i> Remove From My Favourites</a>-->

                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a  href="javascript:void(0);" onclick="addToFavourite(<?= $Projectrow['PROJECT_ID']; ?>,<?= $LoginUserId; ?>, 'addtofav<?= $Projectrow['PROJECT_ID']?>')">
                                                                <i class="far fa-heart"></i> Add To My Favourites</a>

                                                            <!--<a href="<?= SITE_BASE_URL; ?>Property/AddToFavorite.html?ProjectId=<?php echo $Projectrow['PROJECT_ID']; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="far fa-heart"></i> Add To My Favourites</a>-->

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
                    
                                                                <span><?= number_format(round($Start_dynamin_price*$Xrate)); ?></span>
                    
                                                            </div>
                    
                                                            <table>
                    
                                                                <tr>
                    
                                                                    <td>Retail Asking Price From</td>
                    
                                                                    <td><?php echo number_format(round($askingPrice*$Xrate));?></td>
                    
                                                                    <td>Discount %</td>
                    
                                                                    <td><?php echo $AVG_Discount;?>%</td>
                    
                                                                </tr>
                    
                                                                <tr>
                                                                    <td>Strike Price From</td>
                    
                                                                    <td><?php echo number_format(round($strikePrice*$Xrate));?></td>
                    
                                                                    <td>Days Left</td>
                    
                                                                    <td><?php echo $days1;?></td>
                    
                                                                </tr>
                    
                                                                <tr>
                                                                    <td>Dynamic Price From</td>
                                                                    <td><?= number_format(round(($dynamicPrice == '' || $dynamicPrice == null ) ? ($askingPrice*$Xrate) : ($dynamicPrice*$Xrate) )); ?></td>
                                                                    <td>Reserved</td>
                                                                    <td>
                    
                                                                        <?php echo $reservedCount;?> / Avaialable <?= $totalCount - $reservedCount;?>
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
                                                                    <td><?= $grossYeild; ?></td>
                                                                    
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
                    
                                                    $rows_c = \Property\PropertyClass::getCountryDatas($Projectrow["Country"],'');
                    
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
                    
                                                        <div id='map<?= $Projectrow["PROJECT_ID"];?>'></div>
                    
                                                        <script>
                    
                                                            mapboxgl.accessToken = 'pk.eyJ1IjoibGluZXp0ZWNobm9sb2dpZXMiLCJhIjoiY2tnYWU1a2tiMDY3bDJ3bzRqZTNjMnp3bCJ9.8LTEpznqgfn98PokzO6TQQ';
                    
                                                            var map<?= $Projectrow["PROJECT_ID"];?> = new mapboxgl.Map({
                    
                                                                container: 'map<?= $Projectrow["PROJECT_ID"];?>',
                    
                                                                style: 'mapbox://styles/mapbox/streets-v11',
                    
                                                                center: [<?= $CountryLngDB; ?>, <?= $CountryLatDB; ?>],
                    
                                                                zoom: 12
                    
                                                            });
                    
                                                        </script>
                    
                                                    </div>
                    
                                                    <a href="<?php echo SITE_BASE_URL; ?>Property/ProjectView.html?project_id=<?php echo $Projectrow["PROJECT_ID"]; ?>" class="btn btn-green">Available Properties</a>
                    
                                                </div>
                    
                                            </div>
                    
                                        </div>
            
                                        <?php
                                    }
                                    else { $flag = false;}
                                    if($days1 >= $days_uncl )
                                    {
                                        // echo "abc d";
                                        // die();
                                        ?>
                                        <div class="property-slot">

                                            <div class="prop-name-addr">
                    
                                                <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/prop-logo.svg" alt=""> <?php echo $Projectrow["PROJECT_NAME"].' | '.$Projectrow["subrub"];?></p>
                    
                                                <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/flag-icon.png" alt="">  </p>
                    
                                            </div>
                    
                                            <div class="ps-flex">
                    
                                                <!--<div class="mini-flex">-->
                    
                                                <div class="gallery-holder">
                    
                                                    <div id="soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" class="carousel slide" data-ride="carousel">
                    
                                                        <div class="carousel-inner">
                                                            <div class="carousel-item active">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file"];?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php if($Projectrow["image_file1"]!='') {?>
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }
                                                            if($Projectrow["image_file2"]!='') {?>
                                                            
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }
                                                            if($Projectrow["image_file3"]!='') {?>
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }?>
                                                        </div>
                                                        <ul class="carousel-indicators">
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="0" class="active">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file"];?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php if($Projectrow["image_file1"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="1">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php }
                                                            if($Projectrow["image_file2"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="2">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php }
                                                            if($Projectrow["image_file3"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="3">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
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
                    
                                                        <div class="fav" id = "addtofav<?= $Projectrow["PROJECT_ID"]?>">

                                                        <?php
                                                        if (\Property\PropertyClass::check_project_fav($Projectrow["PROJECT_ID"], $LoginUserId)) {
                                                            ?>
                                                            <a  href="javascript:void(0);" onclick="removeFromFavourite(<?= $Projectrow['PROJECT_ID']; ?>,<?= $LoginUserId;?>, 'addtofav<?= $Projectrow['PROJECT_ID']?>')" >
                                                                <i class="fas fa-heart"></i> Remove From My Favourites</a>
                                                            <!--<a href="<?= SITE_BASE_URL; ?>Property/RemoveFavorite.html?ProjectId=<?php echo $Projectrow['PROJECT_ID']; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="fas fa-heart"></i> Remove From My Favourites</a>-->

                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a  href="javascript:void(0);" onclick="addToFavourite(<?= $Projectrow['PROJECT_ID']; ?>,<?= $LoginUserId; ?>, 'addtofav<?= $Projectrow['PROJECT_ID']?>')">
                                                                <i class="far fa-heart"></i> Add To My Favourites</a>

                                                            <!--<a href="<?= SITE_BASE_URL; ?>Property/AddToFavorite.html?ProjectId=<?php echo $Projectrow['PROJECT_ID']; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="far fa-heart"></i> Add To My Favourites</a>-->

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
                    
                                                                <span><?= number_format(round($Start_dynamin_price*$Xrate)); ?></span>
                    
                                                            </div>
                    
                                                            <table>
                    
                                                                <tr>
                    
                                                                    <td>Retail Asking Price From</td>
                    
                                                                    <td><?php echo number_format(round($askingPrice*$Xrate));?></td>
                    
                                                                    <td>Discount %</td>
                    
                                                                    <td><?php echo $AVG_Discount;?>%</td>
                    
                                                                </tr>
                    
                                                                <tr>
                                                                    <td>Strike Price From</td>
                    
                                                                    <td><?php echo number_format(round($strikePrice*$Xrate));?></td>
                    
                                                                    <td>Days Left</td>
                    
                                                                    <td><?php echo $days1;?></td>
                    
                                                                </tr>
                    
                                                                <tr>
                                                                    <td>Dynamic Price From</td>
                                                                    <td><?= number_format(round(($dynamicPrice == '' || $dynamicPrice == null ) ? ($askingPrice*$Xrate) : ($dynamicPrice*$Xrate) )); ?></td>
                                                                    <td>Reserved</td>
                                                                    <td>
                    
                                                                        <?php echo $reservedCount;?> / Avaialable <?= $totalCount - $reservedCount;?>
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
                                                                    <td><?= $grossYeild; ?></td>
                                                                    
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
                    
                                                    $rows_c = \Property\PropertyClass::getCountryDatas($Projectrow["Country"],'');
                    
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
                    
                                                        <div id='map<?= $Projectrow["PROJECT_ID"];?>'></div>
                    
                                                        <script>
                    
                                                            mapboxgl.accessToken = 'pk.eyJ1IjoibGluZXp0ZWNobm9sb2dpZXMiLCJhIjoiY2tnYWU1a2tiMDY3bDJ3bzRqZTNjMnp3bCJ9.8LTEpznqgfn98PokzO6TQQ';
                    
                                                            var map<?= $Projectrow["PROJECT_ID"];?> = new mapboxgl.Map({
                    
                                                                container: 'map<?= $Projectrow["PROJECT_ID"];?>',
                    
                                                                style: 'mapbox://styles/mapbox/streets-v11',
                    
                                                                center: [<?= $CountryLngDB; ?>, <?= $CountryLatDB; ?>],
                    
                                                                zoom: 12
                    
                                                            });
                    
                                                        </script>
                    
                                                    </div>
                    
                                                    <a href="<?php echo SITE_BASE_URL; ?>Property/ProjectView.html?project_id=<?php echo $Projectrow["PROJECT_ID"]; ?>" class="btn btn-green">Available Properties</a>
                    
                                                </div>
                    
                                            </div>
                    
                                        </div>
            
                                        <?php
                                    }
                                    else { $flag = false;}
                                    if($flag)
                                    {
                                        // echo "abc d";
                                        // die();
                                        ?>
                                        <div class="property-slot">

                                            <div class="prop-name-addr">
                    
                                                <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/prop-logo.svg" alt=""> <?php echo $Projectrow["PROJECT_NAME"].' | '.$Projectrow["subrub"];?></p>
                    
                                                <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/flag-icon.png" alt="">  </p>
                    
                                            </div>
                    
                                            <div class="ps-flex">
                    
                                                <!--<div class="mini-flex">-->
                    
                                                <div class="gallery-holder">
                    
                                                    <div id="soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" class="carousel slide" data-ride="carousel">
                    
                                                        <div class="carousel-inner">
                                                            <div class="carousel-item active">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file"];?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php if($Projectrow["image_file1"]!='') {?>
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }
                                                            if($Projectrow["image_file2"]!='') {?>
                                                            
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }
                                                            if($Projectrow["image_file3"]!='') {?>
                                                            <div class="carousel-item">
                                                                <div class="img-holder">
                                                                    <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <?php }?>
                                                        </div>
                                                        <ul class="carousel-indicators">
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="0" class="active">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file"];?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php if($Projectrow["image_file1"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="1">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php }
                                                            if($Projectrow["image_file2"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="2">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                            </li>
                                                            <?php }
                                                            if($Projectrow["image_file3"]!='') {?>
                                                            <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="3">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
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
                    
                                                        <div class="fav" id = "addtofav<?= $Projectrow["PROJECT_ID"]?>">

                                                        <?php
                                                        if (\Property\PropertyClass::check_project_fav($Projectrow["PROJECT_ID"], $LoginUserId)) {
                                                            ?>
                                                            <a  href="javascript:void(0);" onclick="removeFromFavourite(<?= $Projectrow['PROJECT_ID']; ?>,<?= $LoginUserId;?>, 'addtofav<?= $Projectrow['PROJECT_ID']?>')" >
                                                                <i class="fas fa-heart"></i> Remove From My Favourites</a>
                                                            <!--<a href="<?= SITE_BASE_URL; ?>Property/RemoveFavorite.html?ProjectId=<?php echo $Projectrow['PROJECT_ID']; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="fas fa-heart"></i> Remove From My Favourites</a>-->

                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a  href="javascript:void(0);" onclick="addToFavourite(<?= $Projectrow['PROJECT_ID']; ?>,<?= $LoginUserId; ?>, 'addtofav<?= $Projectrow['PROJECT_ID']?>')">
                                                                <i class="far fa-heart"></i> Add To My Favourites</a>

                                                            <!--<a href="<?= SITE_BASE_URL; ?>Property/AddToFavorite.html?ProjectId=<?php echo $Projectrow['PROJECT_ID']; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="far fa-heart"></i> Add To My Favourites</a>-->

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
                    
                                                                <span><?= number_format(round($Start_dynamin_price*$Xrate)); ?></span>
                    
                                                            </div>
                    
                                                            <table>
                    
                                                                <tr>
                    
                                                                    <td>Retail Asking Price From</td>
                    
                                                                    <td><?php echo number_format(round($askingPrice*$Xrate));?></td>
                    
                                                                    <td>Discount %</td>
                    
                                                                    <td><?php echo $AVG_Discount;?>%</td>
                    
                                                                </tr>
                    
                                                                <tr>
                                                                    <td>Strike Price From</td>
                    
                                                                    <td><?php echo number_format(round($strikePrice*$Xrate));?></td>
                    
                                                                    <td>Days Left</td>
                    
                                                                    <td><?php echo $days1;?></td>
                    
                                                                </tr>
                    
                                                                <tr>
                                                                    <td>Dynamic Price From</td>
                                                                    <td><?= number_format(round(($dynamicPrice == '' || $dynamicPrice == null ) ? ($askingPrice*$Xrate) : ($dynamicPrice*$Xrate) )); ?></td>
                                                                    <td>Reserved</td>
                                                                    <td>
                    
                                                                        <?php echo $reservedCount;?> / Avaialable <?= $totalCount - $reservedCount;?>
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
                                                                    <td><?= $grossYeild; ?></td>
                                                                    
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
                    
                                                    $rows_c = \Property\PropertyClass::getCountryDatas($Projectrow["Country"],'');
                    
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
                    
                                                        <div id='map<?= $Projectrow["PROJECT_ID"];?>'></div>
                    
                                                        <script>
                    
                                                            mapboxgl.accessToken = 'pk.eyJ1IjoibGluZXp0ZWNobm9sb2dpZXMiLCJhIjoiY2tnYWU1a2tiMDY3bDJ3bzRqZTNjMnp3bCJ9.8LTEpznqgfn98PokzO6TQQ';
                    
                                                            var map<?= $Projectrow["PROJECT_ID"];?> = new mapboxgl.Map({
                    
                                                                container: 'map<?= $Projectrow["PROJECT_ID"];?>',
                    
                                                                style: 'mapbox://styles/mapbox/streets-v11',
                    
                                                                center: [<?= $CountryLngDB; ?>, <?= $CountryLatDB; ?>],
                    
                                                                zoom: 12
                    
                                                            });
                    
                                                        </script>
                    
                                                    </div>
                    
                                                    <a href="<?php echo SITE_BASE_URL; ?>Property/ProjectView.html?project_id=<?php echo $Projectrow["PROJECT_ID"]; ?>" class="btn btn-green">Available Properties</a>
                    
                                                </div>
                    
                                            </div>
                    
                                        </div>
            
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>

                                    <div class="property-slot">

                                        <div class="prop-name-addr">
                
                                            <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/prop-logo.svg" alt=""> <?php echo $Projectrow["PROJECT_NAME"].' | '.$Projectrow["subrub"];?></p>
                
                                            <p><img src="<?php echo SITE_BASE_URL; ?>assets/images/flag-icon.png" alt="">  </p>
                
                                        </div>
                
                                        <div class="ps-flex">
                
                                            <!--<div class="mini-flex">-->
                
                                            <div class="gallery-holder">
                
                                                <div id="soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" class="carousel slide" data-ride="carousel">
                
                                                    <div class="carousel-inner">
                                                        <div class="carousel-item active">
                                                            <div class="img-holder">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file"];?>" class="img-fluid" alt="">
                                                            </div>
                                                        </div>
                                                        <?php if($Projectrow["image_file1"]!='') {?>
                                                        <div class="carousel-item">
                                                            <div class="img-holder">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                            </div>
                                                        </div>
                                                        <?php }
                                                        if($Projectrow["image_file2"]!='') {?>
                                                        
                                                        <div class="carousel-item">
                                                            <div class="img-holder">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                            </div>
                                                        </div>
                                                        <?php }
                                                        if($Projectrow["image_file3"]!='') {?>
                                                        <div class="carousel-item">
                                                            <div class="img-holder">
                                                                <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
                                                            </div>
                                                        </div>
                                                        <?php }?>
                                                    </div>
                                                    <ul class="carousel-indicators">
                                                        <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="0" class="active">
                                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file"];?>" class="img-fluid" alt="">
                                                        </li>
                                                        <?php if($Projectrow["image_file1"]!='') {?>
                                                        <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="1">
                                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file1"]; ?>" class="img-fluid" alt="">
                                                        </li>
                                                        <?php }
                                                        if($Projectrow["image_file2"]!='') {?>
                                                        <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="2">
                                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file2"]; ?>" class="img-fluid" alt="">
                                                        </li>
                                                        <?php }
                                                        if($Projectrow["image_file3"]!='') {?>
                                                        <li data-target="#soon-gallary<?= $Projectrow['PROJECT_ID']; ?>" data-slide-to="3">
                                                            <img src="<?php echo FILE_BASE_URL;?><?php echo $Projectrow["image_file3"]; ?>" class="img-fluid" alt="">
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
                
                                                    <div class="fav" id = "addtofav<?= $Projectrow["PROJECT_ID"]?>">

                                                        <?php
                                                        if (\Property\PropertyClass::check_project_fav($Projectrow["PROJECT_ID"], $LoginUserId)) {
                                                            ?>
                                                            <a  href="javascript:void(0);" onclick="removeFromFavourite(<?= $Projectrow['PROJECT_ID']; ?>,<?= $LoginUserId;?>, 'addtofav<?= $Projectrow['PROJECT_ID']?>')" >
                                                                <i class="fas fa-heart"></i> Remove From My Favourites</a>
                                                            <!--<a href="<?= SITE_BASE_URL; ?>Property/RemoveFavorite.html?ProjectId=<?php echo $Projectrow['PROJECT_ID']; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="fas fa-heart"></i> Remove From My Favourites</a>-->

                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a  href="javascript:void(0);" onclick="addToFavourite(<?= $Projectrow['PROJECT_ID']; ?>,<?= $LoginUserId; ?>, 'addtofav<?= $Projectrow['PROJECT_ID']?>')">
                                                                <i class="far fa-heart"></i> Add To My Favourites</a>

                                                            <!--<a href="<?= SITE_BASE_URL; ?>Property/AddToFavorite.html?ProjectId=<?php echo $Projectrow['PROJECT_ID']; ?>&UserId=<?php echo $LoginUserId; ?>"><i class="far fa-heart"></i> Add To My Favourites</a>-->

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
                
                                                            <span><?= number_format(round($Start_dynamin_price*$Xrate)); ?></span>
                
                                                        </div>
                
                                                        <table>
                
                                                            <tr>
                
                                                                <td>Retail Asking Price From</td>
                
                                                                <td><?php echo number_format(round($askingPrice*$Xrate));?></td>
                
                                                                <td>Discount %</td>
                
                                                                <td><?php echo $AVG_Discount;?>%</td>
                
                                                            </tr>
                
                                                            <tr>
                                                                <td>Strike Price From</td>
                
                                                                <td><?php echo number_format(round($strikePrice*$Xrate));?></td>
                
                                                                <td>Days Left</td>
                
                                                                <td><?php echo $days1;?></td>
                
                                                            </tr>
                
                                                            <tr>
                                                                <td>Dynamic Price From</td>
                                                                <td><?= number_format(round(($dynamicPrice == '' || $dynamicPrice == null ) ? ($askingPrice*$Xrate) : ($dynamicPrice*$Xrate) )); ?></td>
                                                                <td>Reserved</td>
                                                                <td>
                
                                                                    <?php echo $reservedCount;?> / Avaialable <?= $totalCount - $reservedCount;?>
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
                                                                <td><?= $grossYeild; ?></td>
                                                                
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
                
                                                $rows_c = \Property\PropertyClass::getCountryDatas($Projectrow["Country"],'');
                
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
                
                                                    <div id='map<?= $Projectrow["PROJECT_ID"];?>'></div>
                
                                                    <script>
                
                                                        mapboxgl.accessToken = 'pk.eyJ1IjoibGluZXp0ZWNobm9sb2dpZXMiLCJhIjoiY2tnYWU1a2tiMDY3bDJ3bzRqZTNjMnp3bCJ9.8LTEpznqgfn98PokzO6TQQ';
                
                                                        var map<?= $Projectrow["PROJECT_ID"];?> = new mapboxgl.Map({
                
                                                            container: 'map<?= $Projectrow["PROJECT_ID"];?>',
                
                                                            style: 'mapbox://styles/mapbox/streets-v11',
                
                                                            center: [<?= $CountryLngDB; ?>, <?= $CountryLatDB; ?>],
                
                                                            zoom: 12
                
                                                        });
                
                                                    </script>
                
                                                </div>
                
                                                <a href="<?php echo SITE_BASE_URL; ?>Property/ProjectView.html?project_id=<?php echo $Projectrow["PROJECT_ID"]; ?>" class="btn btn-green">Available Properties</a>
                
                                            </div>
                
                                        </div>
                
                                    </div>
    
                                    <?php
                                }

                            }

                            $i++;

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

                                            <h6>Description</h6>

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

                                                <div class="price">

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

                                                <div data-countdown="Alpha Beta Gamma" class="count-skin"></div>

                                            </div>

                                        </div>

                                        <div class="map">

                                            <img src="#" alt=""> Alpha Beta Gamma

                                            <div id="mapAlpha Beta Gamma"></div>

                                        </div>

                                        <a href="#" class="btn btn-green">More Info</a>

                                    </div>

                                </div>

                            </div>

                           <?php

                        }

                        ?>

                    </div>

                </div>

            </div>

      <!--      <div class="border-box">-->

      <!--        <div class='row'>-->

      <!--            <div class="form-group col-md-2">-->

      <!--                <select class="form-control ChangeSize">-->

      <!--                  <option value="1###<?php // echo $Projectrow["PROJECT_ID"]?>###m" selected><sup>Meter</option>-->

      <!--                  <option value="10.7639###<?php // echo $Projectrow["PROJECT_ID"]?>###ft" >Feet</option>  -->

      <!--                </select>-->

      <!--            </div>-->

      <!--            <div class="form-group col-md-3">-->

      <!--                <a href="<?php echo SITE_BASE_URL;?>CSV_Downloads/<?php // echo $Projectrow["PROJECT_NAME"];?>.csv" class="btn btn-primary btn-block">Save as CSV</a>-->

      <!--            </div>-->

      <!--        </div>  -->

              <?php

			 //  include"PropertyTbl.php";

			 //  $cond="";

			   ?>

      <!--     </div>-->

        </div>

    </div>



<?php include"footer.php"; ?>



<script src="<?php echo SITE_BASE_URL;?>assets/plugins/chartjs/Chart.bundle.js"></script>

<!-- dataTables -->

<script src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/datatables.min.js"></script>

<script src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>

<script src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>

<script src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>

<script src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/jszip.min.js"></script>

<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/pdfmake.min.js"></script>

<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/vfs_fonts.js"></script>

<script src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/datatables-init.js"></script>

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

   $(document).ready(function(){

   

   $(".date_picker").datepicker({

   

       dateFormat: 'dd-mm-yyyy',

   

       //defaultDate: '+1w',

   

       changeMonth: false,

   

       numberOfMonths: 1,

   

       showOn: 'both'

   

   });

   



   });

</script>



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


    $(function () { 

        $(document).on("click", ".Compare", function(){

            properties=$("#CompareProperties").val();

            //================================

        	    URL = "<?php echo SITE_BASE_URL;?>Property/CompareProperty.html?properties=" + properties ;

                $.ajax({url: URL, success: function(result){

                    $("#ComparedData").html(result);

                }});

        	//===============================   

        });

        

        

        

        $( ".ChangeCur" ).change(function() {

          ExRateArr=$(this).val().split("###");

          ExRate=ExRateArr["0"];

          ProjectId=ExRateArr["1"];

          Curr=ExRateArr["2"];

          $(".Curr"+ProjectId).html("<a class='active apt-size' href='#'>"+Curr+"</a>")

            $(".qty").each(function(){

                $(this).next(".spanVal"+ProjectId).html(Math.round($(this).val()*ExRate)+""); 

            });

        });

        

        $( ".ChangeSize" ).change(function() {

          SizeArr=$(this).val().split("###");

          SizeConversion=SizeArr["0"];

          ProjectId=SizeArr["1"];

          Size=SizeArr["2"];

            $(".size"+ProjectId).html("<a class='active apt-size' href='#'>"+Size+"<sup>2</sup></a>")

            $(".balcony").each(function(){

                $(this).next(".spanbalcony"+ProjectId).html(Math.round($(this).val()*SizeConversion)); 

            });

            $(".Land").each(function(){

                $(this).next(".spanLand"+ProjectId).html(Math.round($(this).val()*SizeConversion)); 

            });

        });

    });

</script>



<!--<form action="<?php echo PAYPAL_URL; ?>" method="post">-->

    <!-- Identify your business so that you can collect the payments -->

    <!--<input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">-->

    <!-- Specify a subscriptions button. -->

    <!--<input type="hidden" name="cmd" value="_xclick-subscriptions">-->

    <!-- Specify details about the subscription that buyers will purchase -->

    <!--<input type="hidden" class="item_name"  name="item_name" value="">-->

    <!--<input type="hidden" class="item_number" name="item_number" value="">-->

    <!--<input type="hidden" name="currency_code" value="USD">-->

    <!--<input type="hidden" name="a3" id="paypalAmt" value="10">-->

    <!--<input type="hidden" name="p3" id="paypalValid" value="1">-->

    <!--<input type="hidden" name="t3" value="M">-->

    <!-- Custom variable user ID -->

    <!-- <input type="hidden" name="custom" value="<?php //echo $loggedInUserID; ?>">

    <!-- Specify urls -->

    <!--<input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">-->

    <!--<input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">-->

    <!--<input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">-->

    <!-- Display the payment button -->

    <!--<input class="buy-btn" type="submit" value="Buy Subscription">-->

<!--</form>-->

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





<!--<script src="<?php echo SITE_BASE_URL; ?>assets/plugins/countdown-timezone/jquery.countdown.js"></script>-->

<script>

// Get the modal

var modal = document.getElementById("myModal");

// Get the button that opens the modal

var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal

var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal

btn.onclick = function() {

  modal.style.display = "block";

}

// When the user clicks on <span> (x), close the modal

span.onclick = function() {

  modal.style.display = "none";

}

// When the user clicks anywhere outside of the modal, close it

window.onclick = function(event) {

  if (event.target == modal) {

    modal.style.display = "none";

  }

}

</script>

<script>

    window.jQuery(function ($) {

    "use strict";



    // $('time').countDown({

    //     with_separators: false

    // });

    // $('.alt-1').countDown({

    //     css_class: 'countdown-alt-1'

    // });

    // $('.alt-2').countDown({

    //     css_class: 'countdown-alt-2'

    // });



});

</script>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>



<script>



$('table tr .paypal').on('click', function(e) {

  event.stopPropagation();

  $('#paypal-button').html('');

  $("#myBtn").click();

   var dataprice = $(this).attr('data-price');

   var buildingname = $(this).attr('data-buildingname');

   var productId = $(this).attr('data-propertyid');

   var userId = '<?php echo $LoginUserId; ?>';

   newprice = removeCommas(dataprice)

   alert(newprice);

   $("#subPrice").html('$'+newprice+' USD');

   if(newprice !='' && buildingname !=''){

    newprice =10;

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



      payment: function(data, actions) {

        return actions.payment.create({

            transactions: [{

                amount: {

                    total: newprice,

                    currency: '<?php echo PAYPAL_CURRENCY; ?>'

                }

            }]

      });

      },



      onAuthorize: function(data, actions) {

        return actions.payment.execute()

        .then(function () {

            // Show a confirmation message to the buyer

        //  window.alert('Thank you for your purchase!');

          //window.alert();

          console.log(JSON.stringify(data));

          //  return false;

            // Redirect to the payment process page

            url = "<?php echo SITE_BASE_URL; ?>Property/PaypalSuccess.html?paymentID="+data.paymentID+"&token="+data.paymentToken+"&payerID="+data.payerID+"&pid="+productId+"&uid="+userId+"";

            window.location = url;

        });

      },



      onCancel: function(data, actions) {

        /*

         * Buyer cancelled the payment

         */

      },



      onError: function(err) {

        /*

         * An error occurred during the transaction

         */

      }

    }, '#paypal-button');   

   }

});

</script>

<script type="text/javascript">

function removeCommas(str) {

    while (str.search(",") >= 0) {

        str = (str + "").replace(',', '');

    }

    return str;

};











// $('.image-expand').magnificPopup({

//   type: 'image'

//   // other options

// });

</script>



<script src="<?php echo SITE_BASE_URL; ?>/dashboard/assets/plugins/jquery.countdown-2.0.4/jquery.countdown.min.js"></script>

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

</script>

