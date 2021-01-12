<?php
\login\loginClass::Init();
$rows = \login\loginClass::GetUserFullName();
$IsAdmin=\settings\session\sessionClass::GetSessionIsAdmin();
$checkSession = \login\loginClass::CheckUserSessionIp();

$ChkCodeArr     = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_CODE_NEW FROM country_master WHERE COUNTRY_CODE ='{$CountryCode}')");
$CountryCodeNew = $ChkCodeArr["0"];

\Dashboard\DashboardClass::Init();
$Pointrows = \Dashboard\DashboardClass::GetPointsDatas($LoginUserId);
foreach ($Pointrows as $Pointrow) 
{
    $points=$Pointrow["points"];
}
$LocDtlrows = \Dashboard\DashboardClass::GetLocProjectDtl($CountryCode,$LoginUserId);
foreach ($LocDtlrows as $LocDtlrow) 
{
    $AvailableProp=$LocDtlrow["AV_prop"];
    $SettledProject=$LocDtlrow["settled_project"];
    $Hurry=$LocDtlrow["Hurry"];
}
?>
<!-- Right Wrapper Start -->
<div class="right-wrapper">
<!-- Top Bar Start-->
<div class="top-bar">
    <button class="btn btn-toggler">
        <i class="fal fa-bars"></i>
    </button>
    <h1>Welcome <?php echo $LoginFirstName." ".$LoginLastName; ?></h1>
    <div class="bar-options">
        <div class="v-drop-container">
            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                <div class="icon"><i class="fa fa-play" aria-hidden="true"></i></div> Video Guides <i class="fas fa-angle-down"></i>
            </button>
            <div class="dropdown-menu v-drop">
                <div class="d-flex">
                    <a data-toggle="modal" data-target="#proptechIntro">
                        <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/video-one-btn.png">
                        <img class="v-play" src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/video-play.svg">
                    </a>
                    <a data-toggle="modal" data-target="#dynamicPricing">
                        <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/video-two-btn.png">
                        <img class="v-play" src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/video-play.svg">
                    </a>
                    <a data-toggle="modal" data-target="#portfolioAdviser">
                        <img src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/video-three-btn.png">
                        <img class="v-play" src="<?php echo SITE_BASE_URL;?>dashboard/assets/images/video-play.svg">
                    </a>
                </div>
            </div>
        </div>
        <div class="drop-filter">
            <label for="lang">Language</label>
            <select name="lang" id="lang">
                <option value="English">English</option>
                <option value="Traditional Chinese">Traditional Chinese</option>
                <option value="Simplified Chinese">Simplified Chinese</option>
            </select>
        </div>
        <div class="drop-filter">
            <label for="currency">Currency</label>
            <select name="currency" id="currency" onchange="SetCurrencies($(this).find('option:selected').val())">
                <?php 
                \login\loginClass::Init();
                $Countryrows = \Masters\MastersClass::GetCurrencyDtl('');
                $i = 1;
                foreach ($Countryrows as $Countryrow) 
                {
                    $Currencies=$Countryrow["currency_id"];
                ?>
                <option <?= ($Currency == $Currencies) ? 'selected' : '';?> value="<?php echo $Currencies;?>"><?php echo $Currencies;?></option>
                <?php       
                }
                ?>
            </select>
        </div>
        
<!--        <div class="drop-filter">
            <label for="country">Country</label>
            <select name="country" id="country" onchange="SetCountry($(this).find('option:selected').val())">
                <?php 
                \login\loginClass::Init();
                $Countryrows = \Masters\MastersClass::GetCountriesDatas('');
                $i = 1;
                foreach ($Countryrows as $Countryrow) 
                {
                   $CountryCodes=$Countryrow["country_code"];
                   $CountryCodeNew1=$Countryrow["COUNTRY_CODE_NEW"];
                   $CountryNames=$Countryrow["country_name"];
                   $Currencies=$Countryrow["currency"];
                ?>
                <option <?= ($CountryCodeNew == $CountryCodeNew1) ? 'selected' : '';?> value="<?php echo $CountryCodes;?>"><?php echo $CountryCodeNew1;?></option>
                <?php       
                }
                ?>
            </select>
        </div>-->
        
        <div class="points-box">
            <span>Your Points</span>
            <p>
                <?php if ($IsAdmin!="Y" && $IsAdmin!="A") echo number_format($points) ?>
                <input type='hidden' id='CompareProperties' value="<?php echo $_SESSION["CompareProperties"];?>">
            </p>
        </div>
        <ul class="list-inline">
            <!--<li>
                <a href="javascript:void(0)" class="unread">
                    <i class="fal fa-envelope"></i>
                </a>
                <div class="notify-drop">
                    <p>Recent Notifications</p>
                    <div class="notifications-list">
                        <a href="#">
                            <img class="pull-left m-r-10 avatar-img" src="<?php echo SITE_BASE_URL;?>dashboard/assets/img/avatar/1.jpg" alt="" />
                            <div class="text">
                                <small class="float-right">02:34 PM</small>
                                <h6>Mr. Saifun</h6>
                                <p>5 members joined today</p>
                            </div>
                        </a>
                        <a href="#">
                            <img class="pull-left m-r-10 avatar-img" src="<?php echo SITE_BASE_URL;?>dashboard/assets/img/avatar/2.jpg" alt="" />
                            <div class="text">
                                <small class="float-right">02:34 PM</small>
                                <h6>Mariam</h6>
                                <p>likes a photo of you</p>
                            </div>
                        </a>
                        <a href="#">
                            <img class="pull-left m-r-10 avatar-img" src="<?php echo SITE_BASE_URL;?>dashboard/assets/img/avatar/3.jpg" alt="" />
                            <div class="text">
                                <small class="float-right">02:23AM</small>
                                <h6>Tasnim</h6>
                                <p>Hi Teddy, Just wanted to let you ...</p>
                            </div>
                        </a>
                        <a href="#">
                            <img class="pull-left m-r-10 avatar-img" src="<?php echo SITE_BASE_URL;?>dashboard/assets/img/avatar/4.jpg" alt="" />
                            <div class="text">
                                <small class="float-right">02:23AM</small>
                                <h6>Ishrat Jahan</h6>
                                <p>Hi Teddy, Just wanted to let you ...</p>
                            </div>
                        </a>
                    </div>
                    <a href="#">See All</a>
                </div>
            </li>-->
            <li>
                <a href="#">
                    <i class="fal fa-bell"></i>
                </a>
                <div class="notify-drop">
                    <p>Recent Messages</p>
                    <div class="notifications-list">
                        <?php
                        $advisor_data = \DBConn\DBConnection::getQuery("select * from user_master where ID ='" . $portifolioAdvisorId . "' ");
                        foreach ($advisor_data as $ad_index => $ad_row) {
                            // echo "<pre>";
                            // print_r($ad_row);
                            $ad_name = $ad_row['FIRST_NAME'] . " " . $ad_row['LAST_NAME'];
                            $ad_email = $ad_row['user_name'];
                            $ad_phone = $ad_row['PHONE_NO'];
                            $ad_HMIHY = $ad_row['HMIHY_TEXT'];
                            $ad_image = $ad_row['image_file'];
                            $Advisor = $ad_row['ID'];
                        }
                        $advisor_data = \DBConn\DBConnection::getQuery("select * from user_advisor_message where user_id ='" . $LoginUserId . "' and  msg_read=0");
                            $advisor_id = '';
                            $i = 0;
                            foreach ($advisor_data as $ad_index => $ad_row) {
                                $i++;
                                if ($ad_row['sent_by'] == 0) {
                                    $idd = $ad_row['user_id'];
                                    // user
                                } else {
                                    $idd = $ad_row['advisor_id'];
                                    // advisor
                                }
                                $advisor_id = $ad_row['advisor_id'];
                                $advisor_data1 = \DBConn\DBConnection::getQuery("select image_file,FIRST_NAME,LAST_NAME from user_master where ID ='" . $idd . "' ");
                        foreach ($advisor_data1 as $ad_index2 => $ad_row2) {
                            $image_file = $ad_row2['image_file'];
                            if ($image_file == '') {
                                $image_file = SITE_BASE_URL . 'assets/images/user-pic.png';
                            } else {
                                $image_file = SITE_BASE_URL . 'uploads/ProfilePic/' . $image_file;
                            }
                            ?> 
                                    
                        <a href="<?php echo SITE_BASE_URL;?>ClientMail/contact.html">
                            <img class="pull-left m-r-10 avatar-img" src="<?= $image_file; ?>" alt="" />
                            <div class="text">
                                <small class="float-right"><?= date('H:i a', strtotime($ad_row2['timestamp']));?></small>
                                <h6><?=$ad_name ?></h6>
                                <p><?= $ad_row['body'] ?></p>
                            </div>
                        </a>
                                    <?php
                                }
                                
                              
                            }
                            ?>
                    </div>
                    <a href="<?php echo SITE_BASE_URL;?>ClientMail/contact.html">See All</a>
                </div>
            </li>
            <li>
                <a href="#">
                    <i class="fal fa-cog"></i>
                </a>
                <div class="cog-drop">
                    <a href="<?php echo SITE_BASE_URL;?>ClientMail/contact.html">
                        <i class="fal fa-envelope"> </i> Messages
                    </a>
                    <a href="<?php echo SITE_BASE_URL;?>login/MyAccount.html">
                        <i class="fal fa-cog"> </i> My Profile
                    </a>
                    <a href="<?php echo SITE_BASE_URL;?>login/Logout.html">
                        <i class="fal fa-sign-out"> </i> Sign Out
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- Top Bar End -->
<!-- compare Modal -->
<div class="modal fade" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Property Comparison</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <!--<tr>-->
                      <!--  <td>Development Name</td>-->
                      <!--  <td>Phase Name</td>-->
                      <!--  <td>Building</td>-->
                      <!--  <td>Floor plan</td>-->
                      <!--  <td>Price GST Incl</td>-->
                      <!--  <td>Availablity</td>-->
                      <!--  <td>Est. Completion</td>-->
                      <!--  <td>Bed</td>-->
                      <!--  <td>remove</td>-->
                      <!--</tr>-->
                    </thead>
                    <tbody id="ComparedData">
                      
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- compare Modal-->
        
<script type=''>
    function SetCurrencies(Currencies){
        
        //alert("hii");
        
        URL = "<?php echo SITE_BASE_URL;?>dashboard/SetCurrencies.html?Currencies=" + Currencies ;
        $.ajax({url: URL, success: function(result){
            //alert(result);
            window.location.reload(); // Arzath  - 2020-04-11
        }});
    }
    
    //alert(Country);
    
    function SetCountry(Country){
        
        //alert();
        
        URL = "<?php echo SITE_BASE_URL;?>dashboard/SetCountry.html?Country=" + Country ;
        $.ajax({url: URL, success: function(result){
            window.location.reload();
        }});
    }
</script>
<script>
    $(function () { 
        $(document).on("click", ".Compare", function(){
            properties=$("#CompareProperties").val();
            //alert(properties);
            if(properties=="" || properties==null)
            {
                alert("select any property from project to compare.")
                return false;
            }
            //================================
        	    URL = "<?php echo SITE_BASE_URL;?>Property/CompareProperty.html?properties=" + properties ;
                $.ajax({url: URL, success: function(result){
                    $("#ComparedData").html(result);
                }});
        	//===============================   
        });
    });
    
    function DeleteFn(property)
    {
        URL = "<?php echo SITE_BASE_URL;?>dashboard/RemoveSessionCompare.html?Properties=" + property ;
        $.ajax({url: URL, success: function(result){
            $("#CompareProperties").val(result);
            properties=$("#CompareProperties").val();
            if(properties=="" || properties==null)
            {
                alert("select any property from project to compare.")
                return false;
            }
            //================================
        	    URL = "<?php echo SITE_BASE_URL;?>Property/CompareProperty.html?properties=" + properties ;
                $.ajax({url: URL, success: function(result){
                    $("#ComparedData").html(result);
                }});
        	//===============================   
        }});
        
    }
</script>

<?php include'videos-modal.php'; ?>