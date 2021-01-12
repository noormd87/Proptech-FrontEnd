<?php include"header.php"; ?>
<?php
\login\loginClass::Init();
$rows = \login\loginClass::GetAccountDatas();
$i = 1;

foreach ($rows as $row) 
{
    $user_id         = $row["user_id"];
    $first_name		 = $row["first_name"];
	$last_name		 = $row["last_name"];
	$phone_no		 = $row["phone_no"];
	$phone_no1		 = $row["phone_no1"];
	$subscription_id = $row["subscription_id"];
	$currnt_points   = $row["currnt_points"];
	$created_on 	 = $row["created_on"];
	$address		 = $row["address"];
	$Acc_Auto_id	 = $row["current_acc_auto_id"];
	$IsAdmin		 = $row["user_type_id"];
	$period_type	 = $row["period_type"];
	$plan_name		 = $row["plan_name"];
	$ProfilePic		 = $row["image_file"];
}

$PropertyCountrows = \Property\PropertyClass::OwnPropertyDtl();

foreach ($PropertyCountrows as $PropertyCountrow) 
{
    $reservedCount=$PropertyCountrow["reserved_count"];
    $soldCount=$PropertyCountrow["sold_count"];
}
?> 
    <!-- New-->
    <div class="row">
        <?php
        $PlanDtlrows= \Property\PropertyClass::GetPlanDtl();
        foreach ($PlanDtlrows as $PlanDtlrow) 
        {
            $PlanNames=$PlanDtlrow["PLAN_NAME"];
            $Price=$PlanDtlrow["PRICE"];
        ?>
                 <div class="col-md-4">
                    <div class="block block-pricing <?php if(strtoupper($plan_name)==$PlanNames){ ?>block-raised<?php }?>">
                        <div class="table <?php if(strtoupper($plan_name)==$PlanNames){ ?>table-warning<?php }?>">
                            <!-- <h6 class="category">Free</h6> -->
                            <div class="icon">
                              <div class="membership">
                                <?php echo $PlanNames;?>  
                              </div>
                            </div>
                            <h3 class="block-caption"><?php echo '$'.$Price;?> per month</h3>
                            <h3 class="block-caption"><?php echo '$'.$Price*11;?> per Annum<br>(one month free)</h3>
                            <p class="block-description"> Member.</p> <?php if(strtoupper($plan_name)==$PlanNames){ ?><a href="#" class="btn btn-white btn-round">Active</a><?php }else{?><a href="#" class="btn btn-warning btn-round">Get Points</a><?php }?> 
                         </div>
                    </div>
                </div>
            
        <?php
        }
        ?> 
    </div>
    <!--end-->

    <div class="card">
    <div class="card-header bg-white">
        <h4 class="mb-0">Membership Benifits</h4>
    </div>
</div>  

<div id="accordion-three" class="accordion accordion-membership mt-4">
     <?php
        $PlanDtlrows= \Property\PropertyClass::GetPlanDtl();
        $o=1;
        foreach ($PlanDtlrows as $PlanDtlrow) 
        {
            $PlanNames=$PlanDtlrow["PLAN_NAME"];
            $AnalyserCount=$PlanDtlrow["Analyser_count"];
            $ReservationStarts=$PlanDtlrow["Reserve_start"];
        ?>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOne<?php echo $o;?>" aria-expanded="false" aria-controls="collapseOne<?php echo $o;?>">
                    <i class="fa" aria-hidden="true"></i>
                    <?php echo $PlanNames;?>
                </h5>
            </div>
    
            <div id="collapseOne<?php echo $o;?>" class="collapse" data-parent="#accordion-three">
                <div class="card-body">
                    <ul class="price_list">
                        <li>
                            <i class="ion-checkmark"></i> Personal Portfolio Advisor</li>
                        <li>
                            <i class="ion-checkmark"></i> Property Analyser – Add <?Php echo $AnalyserCount;?> properties to your personal portfolio analyser. Unlimited Du Val Properties can be added.</li>
                        <li>
                            <i class="ion-checkmark"></i> Dynamic Pricing</li>
                        <li>
                            <i class="ion-checkmark"></i> Global Research</li>
                        <li>
                            <i class="ion-checkmark"></i> Calculators</li>
                        <li>
                            <i class="ion-checkmark"></i> Reserve online <?php if($ReservationStarts!='0'){?>Early release <?php echo $ReservationStarts;?> hours before launch to Gold members<?php }?></li>
                        <li>
                            <i class="ion-checkmark"></i> FX transfers - XXXX</li>
                        <?php if($PlanNames!='GOLD'){?><li>
                            <i class="ion-checkmark"></i> Exclusive Du Val investor’s pack – hard copies of our buyers’ guides, membership card, Ashley’s book</li>
                        <?php }?>
                        <?php if($PlanNames!='GOLD'){?>
                        <li>
                            <i class="ion-checkmark"></i> Invitations to our regular Members only Events</li>
                        <?php }?>
                        <?php if($PlanNames=='DIAMOND'){?>
                        <li>
                            <i class="ion-checkmark"></i> Annual ‘financial health check’ by Wealth Manager</li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        $o=$o+1;
        }?>
    
</div>
    
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="stat-widget-one">
                    <div class="stat-content">
                        <div class="stat-text">Total Property</div>
                        <div class="stat-digit"><?php echo $soldCount;?></div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary w-75pc" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="stat-widget-one">
                    <div class="stat-content">
                        <div class="stat-text">Reserved Property</div>
                        <div class="stat-digit"><?php echo $reservedCount;?></div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning w-50pc" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 mb-30">
            <div class="card h-100 mb-0">
                <div class="card-body">
                    <h4 class="card-title">Your Benefits</h4>
                    <div class="table-responsive">
                        <table class="table table-de mb-0">
                            <tbody>
                                <tr>
                                    <td>Recognition Upgrades</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>eVouchers Available</td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td>Status Boost Journeys</td>
                                    <td>3/10</td>
                                </tr>
                                <tr>
                                    <td>Gold Benefits</td>
                                    <td>100</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Membership</h4>
                    <div class="flex-parent">
                        <div class="input-flex-container">
                            <div class="input  active">
                                <span data-year="1St Step" data-info="1 property Gold"></span>
                            </div>
                            <div class="input">
                                <span data-year="2nd Step" data-info="2 property Gold"></span>
                            </div>
                            <div class="input">
                                <span data-year="3 Property" data-info="3 property Gold"></span>
                            </div>
                            <div class="input">
                                <span data-year="4 Property" data-info="4 property Gold"></span>
                            </div>
                            <div class="input">
                                <span data-year="5 Proeprty" data-info="5 property Platinum"></span>
                            </div>
                            <div class="input">
                                <span data-year="6 Property" data-info="6 property Platinum"></span>
                            </div>
                            <div class="input">
                                <span data-year="7 Proeprty" data-info="7 property Platinum"></span>
                            </div>
                            <div class="input">
                                <span data-year="8 Proeprty" data-info="8 property Diamond"></span>
                            </div>
                            <div class="input">
                                <span data-year="9 Property" data-info="9 property Diamond"></span>
                            </div>
                            <div class="input">
                                <span data-year="10 Property" data-info="Final Jade"></span>
                            </div>
                        </div>
                        <div class="description-flex-container">
                            <p class="active">4 more Property to become Platinum</p>
                            <p>3 more Property to become Platinum</p>
                            <p>2 more Property to become Platinum</p>
                            <p>1 more Property to become Platinum</p>
                            <p>3 more Property to become Diamond</p>
                            <p>2 more Property to become Diamond</p>
                            <p>1 more Property to become Diamond</p>
                            <p>2 more Property to become Jade</p>
                            <p>1 more Property to become Jade</p>
                            <p>Jade Member</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <div class="membership-card">
        <div class="row">
            <div class="col-lg-9">
                <div class="card h-100 mb-0">
                    <div class="card-body">
                        <h4 class="card-title">
                            Gold Memebership <span class="label label-primary"><small>Active</small></span>
                        </h4>
                        <small>Membership ID: 100394949</small>
                        <div class="table-resposnive mt-30">
                            <table class="table mb-0">
                                <tr>
                                    <td>Started On <br><span>Oct 12, 2020</span></td>
                                    <td>Recuring <br> Yes</td>
                                    <td>Amount <br> $ 9999999</td>
                                    <td>Access <br> 2 Property</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card h-100 mb-0" style="border: 1px solid #dedfdf !important;">
                    <div class="card-body card-inner">
                        <a class="btn btn-primary" href="#">Change Plan</a>
                        <p class="pt-3">Next Billing on Oct 11, 2020</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php include"footer.php"; ?>


<script src="assets/plugins/chartjs/Chart.bundle.js"></script>
<style type="text/css">
  .card-pricing.current {
    z-index: 1;
    border: 3px solid #007bff !important;
  }
  .card-pricing .list-unstyled li {
      padding: .5rem 0;
      color: #6c757d;
  }
  .pricing{
    padding: 90px 0 60px 0;
  }
  /* ======= BLOCK PRICING ======= */

.block {
    display: inline-block;
    position: relative;
    width: 100%;
    margin-bottom: 30px;
    border-radius: 6px;
    color: rgba(0, 0, 0, 0.87);
    background: #fff;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}

.block-caption {
    font-weight: 700;
    /* font-family: "", serif; */
    color: #3C4857;
}

.block-plain {
    background: transparent;
    box-shadow: none;
}

.block .category:not([class*="text-"]) {
    color: #3C4857;
}

.block-background {
    background-position: center center;
    background-size: cover;
    text-align: center;
}

.block-raised {
    box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}

.block-background .table {
    position: relative;
    z-index: 2;
    min-height: 280px;
    padding-top: 40px;
    padding-bottom: 40px;
    max-width: 440px;
    margin: 0 auto;
}

.block-background .block-caption {
    color: #FFFFFF;
    margin-top: 10px;
}

.block-pricing.block-background:after {
    background-color: rgba(0, 0, 0, 0.7);
}

.block-background:after {
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 100%;
    display: block;
    left: 0;
    top: 0;
    content: "";
    background-color: rgba(0, 0, 0, 0.56);
    border-radius: 6px;
}

[class*="pricing-"] {
    padding: 90px 0 60px 0;
}



.block-pricing {
    text-align: center;
}

.block-pricing .block-caption {
    margin-top: 30px;
}

.block-pricing .table {
    padding: 15px !important;
    margin-bottom: 0px;
}

.block-pricing .icon {
    padding: 10px 0 0px;
    color: #3C4857;
}

.block-pricing .icon .membership {
    font-size: 32px;
    border: 3px solid #ececec;
    border-radius: 50%;
    width: 150px;
    line-height: 140px;
    height: 150px;
    font-family: Oswald;
    display: inline-block;
    font-weight: 600;
    text-transform: uppercase;
}

.block-pricing h1 small {
    font-size: 18px;
}

.block-pricing h1 small:first-child {
    position: relative;
    top: -17px;
    font-size: 26px;
}

.block-pricing ul {
    list-style: none;
    padding: 0;
    max-width: 240px;
    margin: 10px auto;
}

.block-pricing ul li {
    color: #3C4857;
    text-align: center;
    padding: 12px 0;
    border-bottom: 1px solid rgba(153, 153, 153, 0.3);
}

.block-pricing ul li:last-child {
    border: 0;
}

.block-pricing ul li b {
    color: #3C4857;
}

.block-pricing ul li i {
    top: 6px;
    position: relative;
}

.block-pricing.block-background ul li,
.block-pricing [class*="table-"] ul li {
    color: #FFFFFF;
    border-color: rgba(255, 255, 255, 0.3);
}

.block-pricing.block-background ul li b,
.block-pricing [class*="table-"] ul li b {
    color: #FFFFFF;
}

.block-pricing.block-background [class*="text-"],
.block-pricing [class*="table-"] [class*="text-"] {
    color: #FFFFFF;
}

.block-pricing.block-background:after {
    background-color: rgba(0, 0, 0, 0.7);
}

.block-background:not(.block-pricing) .btn {
    margin-bottom: 0;
}

.block .table-primary {
    background: linear-gradient(60deg, #ab47bc, #7b1fa2);
}


.block [class*="table-"] .block-caption a,
.block [class*="table-"] .block-caption,
.block [class*="table-"] .icon .membership {
    color: #FFFFFF;
}

.block-pricing .block-caption {
    margin-top: 30px;
}

.block [class*="table-"] h1 small,
.block [class*="table-"] h2 small,
.block [class*="table-"] h3 small {
    color: rgba(255, 255, 255, 0.8);
}
/* ======= BLOCK TABLE COLOR ======= */

.block .table-primary {
    background: linear-gradient(60deg, #ab47bc, #7b1fa2);
    border-radius: 6px;
    box-shadow: 0 16px 26px -10px rgba(156, 39, 176, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(156, 39, 176, 0.2);
}

.block .table-info {
    background: linear-gradient(60deg, #26c6da, #0097a7);
    border-radius: 6px;
    box-shadow: 0 2px 2px 0 rgba(0, 188, 212, 0.14), 0 3px 1px -2px rgba(0, 188, 212, 0.2), 0 1px 5px 0 rgba(0, 188, 212, 0.12);
}

.block .table-success {
    background: linear-gradient(60deg, #66bb6a, #388e3c);
    border-radius: 6px;
    box-shadow: 0 14px 26px -12px rgba(76, 175, 80, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(76, 175, 80, 0.2);
}

.block .table-warning {
    background: linear-gradient(60deg, #ffa726, #f57c00);
    border-radius: 6px;
}

.block .table-danger {
    background: linear-gradient(60deg, #ef5350, #d32f2f);
    border-radius: 6px;
    box-shadow: 0 2px 2px 0 rgba(221, 75, 57, 0.14), 0 3px 1px -2px rgba(221, 75, 57, 0.2), 0 1px 5px 0 rgba(221, 75, 57, 0.12);
}

.block .table-rose {
    background: linear-gradient(60deg, #ec407a, #c2185b);
    border-radius: 6px;
    box-shadow: 0 14px 26px -12px rgba(233, 30, 99, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(233, 30, 99, 0.2);
}

.block [class*="table-"] .category,
.block [class*="table-"] .block-description {
    color: rgba(255, 255, 255, 0.8);
}
.btn-round{
  border-radius: 50px;
  font-weight: 700;
}
.btn-white{
  background-color: #fff;
  color: #3C4857;
}
.btn-white:hover{
  color: #3C4857;
}
</style>
<script>
    $(function () {
        var inputs = $('.input');
        var paras = $('.description-flex-container').find('p');
        $(inputs).click(function () {
            var t = $(this),
                ind = t.index(),
                matchedPara = $(paras).eq(ind);

            $(t).add(matchedPara).addClass('active');
            $(inputs).not(t).add($(paras).not(matchedPara)).removeClass('active');
        });
    });
</script>