<!-- Side Bar Start -->
<div class="side-bar">
    <button class="btn hide-bar"><i class="far fa-arrow-left"></i></button>
    <div class="brand">
        <a href="<?php echo SITE_BASE_URL;?>dashboard/mydashboard.html">
             <img src="<?php echo SITE_BASE_URL;?>assets/images/logo.png" alt="">
        </a>
    </div>
    <div class="menu-list">
        <ul>
            <li>
                <a href="<?php echo SITE_BASE_URL;?>dashboard/mydashboard.html" <?php if($action == "mydashboard") echo 'class="active"';?>>
                    <i class="far fa-th-large"></i>
                    <span>My Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo SITE_BASE_URL;?>Portfolio/Portfolio.html" <?php if($action == "Portfolio") echo 'class="active"';?> >
                    <i class="fal fa-file-alt"></i>
                    <span>My Portfolio</span>
                </a>
            </li>
            <li>
                <a href="<?php echo SITE_BASE_URL;?>ClientMail/contact.html" <?php if($action == "contact") echo 'class="active"';?> >
                    <i class="fal fa-user-alt"></i>
                    <span>My Portfolio Advisor</span>
                </a>
            </li>
            <li>
                <a href="<?php echo SITE_BASE_URL;?>dashboard/GlobalLocation.html" <?php if($action == "GlobalLocation") echo 'class="active"';?> >
                    <i class="fal fa-globe"></i>
                    <span>Global Residential Data</span>
                </a>
            </li>
            <li>
                <a href="<?php echo SITE_BASE_URL;?>dashboard/SearchProperty.html" <?php if($action == "Projects") echo 'class="active"';?> >
                    <i class="fal fa-map-pin"></i>
                    <span>Search New Properties</span>
                </a>
                 <!-- <div class="right-drop">
                     <a href="<?php echo SITE_BASE_URL;?>Property/Projects.html?country="> <img src="<?= SITE_BASE_URL;?>dashboard/assets/images/newzeland.png" alt=""> All</a>
                     <a href="<?php echo SITE_BASE_URL;?>Property/Projects.html?country=1"> <img src="<?= SITE_BASE_URL;?>dashboard/assets/images/newzeland.png" alt=""> New Zealand</a>
                    <a href="<?php echo SITE_BASE_URL;?>Property/Projects.html?country=3"> <img src="<?= SITE_BASE_URL;?>dashboard/assets/images/united-kingdom.png" alt=""> United Kingdom</a>
                    <a href="<?php echo SITE_BASE_URL;?>Property/Projects.html?country=2"> <img src="<?= SITE_BASE_URL;?>dashboard/assets/images/australia.png" alt=""> Australia</a>
                </div> -->
            </li>
            <li>
                <a href="<?php echo SITE_BASE_URL;?>Portfolio/ProtfolioPropDetails.html?RecentAnalyse=Y" <?php if($action == "ProtfolioPropDetails") echo 'class="active"';?>>
                    <i class="fal fa-chart-line"></i>
                    <span>Run an Investment Analysis</span>
                </a>
            </li>
            <?php // echo "<script>alert('".$action."');</script>";?>
            <li>
                <a href="<?php echo SITE_BASE_URL;?>Portfolio/InvestorLibrary.html"  <?php if($action == "InvestorLibrary") echo 'class="active"';?>>
                    <i class="fal fa-university"></i>
                    <span>Investor Library</span>
                </a>
            </li>
            <li>
                <a href="<?php echo SITE_BASE_URL;?>login/currency.html" <?php if($action == "currency") echo 'class="active"';?>>
                    <i class="fal fa-dollar-sign"></i>
                    <span>Currency</span>
                </a>
            </li>
            <li>
                <a href="<?php echo SITE_BASE_URL;?>login/ReferFriend.html" <?php if($action == "ReferFriend") echo 'class="active"';?>>
                    <i class="fal fa-users"></i>
                    <span>Refer a Friend</span>
                </a>
            </li>
            <li> 
                <a href="<?php echo SITE_BASE_URL;?>login/adminfaq.html" <?php if($action == "adminfaq") echo 'class="active"';?>>
                    <i class="fal fa-circle"></i>
                    <span>FAQ's</span>
                </a>
            </li>
            <li>
                <a href="<?= SITE_BASE_URL; ?>login/MyAccount.html" <?php if($action == "MyAccount") echo 'class="active"';?>>
                    <div class="img-holder">
                        <img src="<?php echo SITE_BASE_URL;?>uploads/ProfilePic/<?php echo $ProfilePic;?>" alt="">
                    </div>
                    <span>My Profile</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Side Bar End -->