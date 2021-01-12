<?php
$plans = \DBConn\DBConnection::getQuery("SELECT * FROM plans WHERE id > 0");
// \login\loginClass::createsubscription($fwd);
if (isset($_REQUEST['otp'])) {

  $email = $_REQUEST['email'];

  $UIdArr = \DBConn\DBConnection::getQueryFetchColumn("(SELECT USER_ID FROM user_master where USER_ID = '{$email}')");

  $PrevUserId = $UIdArr["0"];



  if ($PrevUserId == null)

    $PrevUserId = "";



  if ($PrevUserId == "") {



//  $rand = rand(111111, 999999);
//
//
//
//    $queryStr = "Insert Into  otp(email,code)  values(:email, :code)";
//
//    $ColValarray = array(
//
//        "email" => $_REQUEST['email'],
//
//        "code" => $rand,
//
//    );
//
//
//
//
//
//    $Queryarray = array($queryStr, $ColValarray);
//
//    $ArrQueries[] = $Queryarray;
//
//    $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
//
//
//
//
//
//    // Always set content-type when sending HTML email
//
//    $headers = "MIME-Version: 1.0" . "\r\n";
//
//    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//
//    $headers .= "From: <verify@duvalproptech.com>" . "\r\n";
//
//
//
//    mail($_REQUEST['email'], 'OTP for Registration', 'OTP: ' . $rand, $headers);

    echo 1;

  } else {

    echo 0;

  }



  die();

}

if (isset($_REQUEST['code'])) {

    $code = $_REQUEST['code'];

    $email = $_REQUEST['email'];



    $UIdArr = \DBConn\DBConnection::getQueryFetchColumn("(SELECT code FROM otp where email = '{$email}' order by id desc)");

    $PrevUserId = $UIdArr["0"];



    if ($PrevUserId == null)

        $PrevUserId = "";



    if ($PrevUserId == "") {

        echo 0;

    } else {

        if ($PrevUserId == $code) {

            echo 1;

        } else {

            echo 0;

        }

    }





    die();

}

?>



<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Du Val Proptech</title>

        <meta content="" name="descriptison">

        <meta content="" name="keywords">

        <!-- Favicons -->

        <link href="<?php echo SITE_BASE_URL; ?>assets/img/favicon.ico" rel="icon">

        <link href="<?php echo SITE_BASE_URL; ?>assets/img/favicon.ico" rel="apple-touch-icon">

        <!-- Google Fonts -->

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,200i,300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:200, 200i,300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">



        <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL; ?>assets/css/register.css">

        <!-- Vendor CSS Files -->

        <link href="<?php echo SITE_BASE_URL; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link href="<?php echo SITE_BASE_URL; ?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">

        <link href="<?php echo SITE_BASE_URL; ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->







        <!-- Template Main CSS File -->

        <!-- icheck -->

        <link href="<?php echo SITE_BASE_URL; ?>assets/vendor/icheck/skins/all.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL; ?>assets/vendor/bootstrap-select-country/dist/css/bootstrap-select-country.min.css">

        <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL; ?>assets/vendor/jquery-steps/jquery-steps.css">

        <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL; ?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css">



        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css">

        <link rel="stylesheet" href="<?php echo SITE_BASE_URL; ?>javascripts/country-picker-flags/build/css/countrySelect.css">



        <script type="text/javascript">
        
       

            function isNumber(evt,that) {

                var iKeyCode = (evt.which) ? evt.which : evt.keyCode

                if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))

                    return false;

if (that!=undefined) {
$(that).next().focus();
}
                return true;
                

            }

        </script>



        <style>



            span.error {

                font-size: 11px;

                font-weight: 500;

                display: inline-block;

                width: 100%;

                margin: 2px 0px 0;

            }



            .upload-one {

                height: 120px;

                width: 120px;

                border: 1px solid #ddd;

                overflow: hidden;

                border-radius: 100%;

                display: block;

                margin: 0 auto;

                position: relative;

            }

            .upload-one label

            {

                position: relative;

                top: 50%;

                transform: translateY(-50%);

                margin:0px;

            }

            .upload-one span

            {

                font-size: 12px;

                color: #1d1d1d;

                text-align: center;

                font-weight: 500;

                width: 100%;

                display: inline-block;

            }

            .upload-one input{

                position:absolute;

                top:0;

                left:0;

                height:100%;

                width:100%;

                z-index:1;

                opacity:0;

                cursor:pointer;

            }

            .upload-one:hover span

            {   

                color:#fb741d;

            }



            .checkbox-container {

                display: flex;

                align-items: center;

            }

            .checkbox-container label

            {

                margin:0px;

            }

            .checkbox-container span

            {

                line-height:17px !important;

            }

            .check-flex > div ~ div

            {

                margin-left:30px;

            }

            .form-box-transparent input[type="checkbox"]::before {

                top: 2px;

            }

            input[type="checkbox"]::before 

            {

                height: 18px !important;

                width: 18px !important;

            }

            input[type="checkbox"]::after

            {

                left:2px !important;

            }

            .country-select {

                width: 100% !important;

            }

            .align-caret

            {

                position: absolute;

                top: 50%;

                right: 20px;

                z-index: -1;

                transform: translateY(-50%);

            }

            select.with-custom-caret,

            select.with-custom-caret:focus {

                background: transparent;

            }

            .nav-tabs li .round-tab

            {

                border-radius: 100%;

                border: 3px dashed #017597;

                background-image:none !important;

            }

            .nav-tabs .active .round-tab

            {

                border-color:#FD6301 !important;

            }

            .wizard .nav-tabs > li a h2

            {

                top:50% !important;

            }



            .terms-text-holder

            {

                height:60vh;

                overflow-y:scroll;

            }

            .terms-close

            {

                text-align: right;

                padding: 8px 10px !important;

                outline: none !important;

                opacity: 1;

                text-shadow: none;

                width: 35px;

                display: block;

                margin: 0 0 0 auto;

            }

            .terms-close:hover{

                color:red;

            }

            .terms-text-holder p {

                font-size: 14px;

                color: #535353;

            }

            .terms-text-holder h2 

            {

                font-size:24px;

            }

            .terms-text-holder a {

                text-decoration: none;

                color: darkorange;

            }

            .terms-text-holder a:hover 

            {

                color: orangered;

            }

            .terms-text-holder {

                height: 60vh;

                overflow-y: scroll;

                margin-bottom: 40px;

                padding:0px 40px;

            }

            @media(max-width:767px){

                .terms-text-holder {

                    height: 86vh;

                }

            }

            .wizard .nav-tabs > li a h2

            {

                font-size:12px;

            }

            .wizard .nav-tabs > li.active a h2

            {

                font-size:16px;

            }
            
            .country-select .country-list .country-name {
                font-size: 12px !important;
            }
            .iti.iti--allow-dropdown {
                width: 100%;
            }

        </style>



    </head>

    <!--<body onload="addOption_list()">-->
        <body>



        <?php

        $Id = $_REQUEST["Id"];

        $rows = \login\loginClass::GetUserDatas($Id);

        //echo print_r($rows);

        //exit;

        if ($Id != "" && $Id != null) {

            foreach ($rows as $row) {

                $id = $row["id"];

                $user_id = $row["user_id"];

                $user_name = $row["user_name"];

                $first_name = $row["first_name"];

                $last_name = $row["last_name"];

                $phone_no = $row["phone_no"];

                $phone_no1 = $row["phone_no1"];

                $subscription_id = $row["subscription_id"];

                $currnt_points = $row["currnt_points"];

                $created_on = $row["created_on"];

                $address = $row["address"];

                $Acc_Auto_id = $row["current_acc_auto_id"];

                $IsAdmin = $row["is_admin"];

                $period_type = $row["period_type"];

                $plan_name = $row["plan_name"];

                $ProfilePic = $row["image_file"];

                $Dob = $row["dob"];
                
                $password = $row['password'];

                $UpdateFlag = "Y";

                //echo "++++++>".$first_name;

                //exit;

            }

        }

        ?>







        <!-- Terms Modal -->

        <div class="modal fade" id="terms-modal">

            <div class="modal-dialog modal-xl modal-dialog-centered">

                <div class="modal-content">

                    <button type="button" class="close terms-close" data-dismiss="modal">&times;</button>

                    <div class="modal-body terms-text-holder">



                        <h2>Terms and Conditions</h2>

                        <p>Please read the Terms and Conditions (the &lsquo;Terms&rsquo;) carefully before using the websites <a href="http://www.DuvalPropTech.com">www.DuvalPropTech.com</a> and <a href="http://www.duvalprivateoffice.com">www.duvalprivateoffice.com</a> (our&lsquo;Sites&rsquo;).&nbsp;&nbsp;&nbsp;</p>

                        <p>Our Terms set out the terms and conditions which you agree to whilst using (which includes browsing, accessing,

                            registering and purchasing) our Sites.&nbsp; Using our Sites is confirmation that you have understood and agree to

                            be bound by the Terms set out below.&nbsp;</p>

                        <p>The information contained in this website is for guidance and information only.&nbsp; Nothing on this website shall

                            be deemed to constitute professional financial, tax or legal advice and in the event that you wish to obtain such

                            advice, you should consult a professional financial advisor, &nbsp;tax advisor, solicitor or conveyancing

                            practitioner.</p>

                        <h2>About us</h2>

                        <p>Du Val PropTech / Du Val Private Office Limited of Suite 3708, Tower Two Lippo Centre,&nbsp;89 Queensway, Hong Kong</p>

                        <h2>Disclaimer</h2>

                        <p>We will use all reasonable efforts to ensure that the information published on this website is accurate, current, and

                            complete at the date of publication however no representations or warranties are made (express or implied) as to the

                            accuracy, currency or completeness of such information. &nbsp;&nbsp;Du Val PropTech / Du Val Private Office, its

                            employees, partners or agents do not accept any responsibility (to the extent permitted by law) for any loss arising

                            directly or indirectly from the use of, or any action taken in reliance on any information appearing on this website

                            or any other website to which it may be linked.</p>

                        <p>We make no warranty or guarantee that this website or content available on the site is free from defects, errors,

                            omissions or viruses.</p>

                        <h2>Privacy Policy</h2>

                        <p>When you register with us and use our Sites you will provide personal information and data.&nbsp; Our Privacy Policy

                            sets out how we will use this information that you provide.&nbsp; By using or registering with our websites, you

                            agree to your personal information being used in accordance with our Privacy Policy.&nbsp;</p>

                        <p>Should you purchase a property through our Sites you will enter into a separate sale and purchase agreement

                            (contract) with the developer which will be in addition to these terms and conditions.</p>

                        <h2>Security</h2>

                        <p>You will be provided with login and access codes when you subscribe to our platform.&nbsp; In order to ensure your

                            security we may revise our security procedure from time to time and we may request you provide additional

                            information as part of our security procedure.&nbsp; You should not disclose your login codes, access codes or

                            security details to any other person and your account may be disabled if you do so.&nbsp;&nbsp; Please advise us

                            immediately if any other person knows, or you suspect they know your security details.</p>

                        <p>Our websites and their content may at some times be interrupted and we do not guarantee that the Sites will always be

                            available and as such access is allowed on a temporary basis.&nbsp;&nbsp; All or part of the Sites may be suspended

                            or discontinued without prior notice and we are not liable if the site is unavailable for any period of time.</p>

                        <p>You will not use the Sites for any use that is unlawful or prohibited by these Terms or any applicable laws.</p>

                        <h2>Intellectual Property Rights and Copyright</h2>

                        <p>The entire contents of the Sites are the intellectual property of Du Val PropTech / Du Val Private Office and are

                            subject to copyright with all rights reserved.</p>

                        <p>Sections of the Sites and information contained on the Sites may (in whole in or in part) be downloaded and printed

                            for your personal use, provided that the information is not modified.&nbsp;&nbsp; You must not copy, reproduce or

                            transmit any information from our Sites for any commercial purpose without our prior written consent and you must

                            not misuse our trademarks.</p>

                        <h2>Trademarks</h2>

                        <p>The Sites include logos, service marks and brand identities (&lsquo;Marks&rsquo;) that are the property of Du Val

                            PropTech.&nbsp; Du Val PropTech do not grant any licence or right to use any of these Marks without the prior

                            written permission of Du Val PropTech.</p>

                        <h2>Limitation of our Liability</h2>

                        <p>We exclude all conditions, warranties, representations or other terms which may apply to our Sites or any content on

                            it, whether express or implied.</p>

                        <p>We disclaim all responsibility for any loss, claim, liability, damage or injury, whether in tort (including

                            negligence), breach of statutory duty or otherwise, arising from or in any way related to the use of our Sites, the

                            inability to use or Sites, any errors,&nbsp; omissions &nbsp;or inaccuracies on our Sites or reliance on any content

                            included within our Sites.</p>

                        <p>We will not be liable for any loss or damage caused by a virus, distributed denial-of-service attack, or other

                            technologically harmful material that may infect your computer equipment, devices, computer programs, data or other

                            proprietary material due to your use of our site or to your downloading of any content on it, or on any website

                            linked to it.</p>

                        <p>Any links to other websites on our Sites are not endorsed by us.&nbsp;&nbsp; We assume no responsibility for the

                            content of websites linked to our Sites and we will not be liable for any loss or damage that may arise from your

                            use of them.&nbsp; Viewing any third-party websites is entirely at your own risk.</p>

                        <p>You agree to hold Du Val PropTech / Du Val Private Offices harmless and to defend and indemnify us against any

                            claims, damages, costs or expenses including legal fees, arising from or related to your use of the site.</p>

                        <h2>Viruses</h2>

                        <p>Whilst care is taken, we are unable to guarantee that our Sites are secure and completely free of bugs or

                            viruses.&nbsp;</p>

                        <p>Viruses, Trojans, worms logic bombs or other malicious or technologically harmful materials must not be introduced by

                            you to our Sites.&nbsp; Any attempt to gain unauthorized access to our Sites, servers, data or databases is

                            prohibited.</p>

                        <h2>Applicable Law</h2>

                        <p>Any disputes arising from the use of this website shall be governed by the laws of Hong Kong.</p>

                    </div>

                </div>

            </div>

        </div>







        <div class="hero-wrapper">

            <div class="container container-expand">

                <nav class="navbar navbar-expand-lg login-nav">

                    <a class="navbar-brand" href="<?php echo SITE_BASE_URL; ?>"><img src="<?php echo SITE_BASE_URL; ?>assets/img/logo.png" class="img-fluid" alt=""></a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav ml-auto">

                            <!--<li class="nav-item active"> <a class="nav-link" href="#">CONTACT US</a> </li>-->

                            <li class="nav-item">

                                <a class="nav-link" href="<?php echo SITE_BASE_URL; ?>"> > BACK TO MAIN WEBSITE</a>

                                <!--                     <div class="text-right">

                                                        <button type="button" class="currency-btn">USD</button>

                                                     </div>-->

                            </li>

                        </ul>

                    </div>

                </nav>

            </div>





            <div class="container">

                <section class="signup-step-container">

                    <!-- <form role="form" action="" method ="post" id="registration" class="login-box" onsubmit="test(); return false;"> -->

                    <form class="login-form h-100 register-wizard" action="<?php echo SITE_BASE_URL; ?>login/save.html" enctype="multipart/form-data" method="post" name="register_form" id="register_form" >

                        <div class="wizard">

                            <div class="row no-gutters">

                                <div class="col-lg-3">

                                    <div class="sidebar-col">

                                        <div class="step-heading">

                                            <h1>step<span id="step-count">1</span></h1>

                                            <h4 class="step-title">ACCOUNT PROFILE</h4>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-9">

                                    <div class="wizard-inner">

                                        <div class="connecting-line"></div>

                                        <ul class="nav nav-tabs" role="tablist">

                                            <li role="presentation" class="active">

                                                <a data-id="step1" aria-controls="step1" role="tab" aria-expanded="true">

                                                    <div class="round-tab">

                                                        <h2>Step 1</h2>

                                                        <!--<span id="step_1">75% PROGRESS</span>-->

                                                    </div>

                                                </a>

                                            </li>

<!--                                            <li role="presentation" class="disabled">

                                                <a data-id="step2"   aria-controls="step2" role="tab" aria-expanded="false">

                                                    <div class="round-tab">

                                                        <h2>Step 2</h2>

                                                        <span id="step_2">100% Completed</span>

                                                    </div>

                                                </a>

                                            </li>-->

                                            <li role="presentation" class="disabled">

                                                <a data-id="step3"  aria-controls="step3" role="tab">

                                                    <div class="round-tab">

                                                        <!--<span id="step_3">Completed</span>-->

                                                        <h2>Step 2</h2>

                                                    </div>

                                                </a>

                                            </li>

                                            <li role="presentation" class="disabled">

                                                <a data-id="step4"  aria-controls="step4" role="tab">

                                                    <div class="round-tab">

                                                        <!--<span id="step_4">Completed</span>-->

                                                        <h2>Step 3</h2>

                                                    </div>

                                                </a>

                                            </li>

                                            <li role="presentation" class="disabled">

                                                <a data-id="step5"   aria-controls="step5" role="tab">

                                                    <div class="round-tab">

                                                        <!--<span id="step_5">Completed</span>-->

                                                        <h2>Step 4</h2>

                                                    </div>

                                                </a>

                                            </li>

                                            <li role="presentation" class="disabled">

                                                <a data-id="step6"  data-toggle="tab" aria-controls="step6" role="tab">

                                                    <div class="round-tab">

                                                        <!--<span id="step_6">Completed</span>-->

                                                        <h2>Step 5</h2>

                                                    </div>

                                                </a>

                                            </li>

                                        </ul>

                                    </div>

                                </div>

                            </div>



                            <div class="tab-content" id="main_form">

                                <div class="tab-pane active" role="tabpanel" id="step1">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3"></div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <h4>Welcome to the first step to create your PropTech account</h4>

                                            </div>

                                        </div>

                                    </div>

                                    <hr class="step-seprator">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <h4>Instructions</h4>

                                                    <p>Complete your Personal Details</p>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="row">

                                                    <div class="col-md-4">

                                                        <div class="form-box h-100">

                                                            <h4 class="form-caption text-center mb-4">1. Upload Profile Picture</h4>

                                                            <div class="form-group">

                                                                <div class="js upload-one">

                                                                    <input type="file" name="profile_pic" class="inputfile " />

                                                                    <label for="file-1"> <span>Upload Profile photo</span></label>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-8">

                                                        <div class="form-box h-100">

                                                            <h4 class="form-caption">2. Mandatory Fields</h4>

                                                            <div class="row">

                                                                <div class="form-group col-lg-6">

                                                                   <!-- <input class="form-control required" type="text" name="first_name" id="firstName" placeholder="First Name"> 

                                                                   <span class="error error-failed">*Required Information</span> -->

                                                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>">

                                                                    <input type="hidden" class="form-control" name="ReferralCode" value=<?php echo $_REQUEST["ReferralCode"]; ?>>

                                                                    <input type="hidden" class="form-control" name="id" value=<?php echo $id; ?>>

                                                                    <input type="hidden" class="form-control" name="UpdateFlag" value=<?php echo $UpdateFlag; ?>>

                                                                </div>



                                                                <div class="form-group col-lg-6">

                                                                   <!-- <input class="form-control required" type="text" name="last_name" id="lastName" placeholder="Last Name"> 

                                                                           <span class="error error-failed">*Required Information</span> -->

                                                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>">



                                                                </div>



                                                                <div class="form-group col-lg-6">

                                                                   <!-- <input class="form-control required" type="text" name="phone_number" id="phoneNumber" placeholder="Contact Number"> 

                                                                           <span class="error error-failed">*Required Information</span> -->

                                                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $user_name; ?>">

                                                                </div>



                                                                <div class="form-group col-lg-6">

                                                                   <!-- <input class="form-control required" type="text" name="email" id="email" placeholder="Email"> 

                                                                           <span class="error error-failed">*Required Information</span> -->

                                                                    <input type="text" class="form-control phone-selecter" name="mobile" placeholder="345374656" onkeypress="javascript:return isNumber(event)" value="<?php echo $phone_no; ?>">

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <div class="row no-gutters">

                                        <div class="col-lg-3">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <h4>Instructions</h4>

                                                    <p>Complete your Personal Details</p>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box mt-3">

                                                    <h4 class="form-caption">3. User name and Password</h4>

                                                    <div class="row">

                                                        <div class="col-lg-4 form-group">

                                                            <label>Username</label>

                                                            <!-- <input class="form-control" type="text" name="name" placeholder="Username"> <span class="error error-success"><i class="icofont-check"></i> Available</span> -->

                                                            <input type="text" class="form-control" name="user_name" placeholder="Username" value='<?php echo $user_name; ?>'>

                                                        </div>

                                                        <div class="col-lg-4 form-group">

                                                            <label>Password</label>

                                                            <!-- <input class="form-control" type="password" name="name" placeholder="Password"> -->

                                                            <input type="password" class="form-control" name="password" placeholder="Password" value="<?= $password?>">

                                                        </div>

                                                        <div class="col-lg-4 form-group">

                                                            <label>Confirm Password</label>

                                                            <!-- <input class="form-control" type="password" name="confirm_password" placeholder="Password"> 

                                                                  <span class="error error-failed"><i class="icofont-close"></i> Password did not match</span> -->

                                                            <input type="password" class="form-control" name="Confirm_password" placeholder="Confirm Password" value="<?= $password?>">

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <hr class="step-seprator">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <h4>Instructions</h4>

                                                    <p>Complete your Personal Details</p>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box-transparent h-100">

                                                    <h4 class="form-caption">4. Other Information</h4>

                                                    <div class="row">




                                                        <div class="form-group col-lg-4">

                                                           <!-- <select name="" class="form-control caret">

                                                              <option value="">Select Counrty</option>

                                                           </select>

                                                           <i class="icofont-caret-down"></i> -->  

                                                            <input type="text" class="form-control" name="Address1" placeholder="Address">

                                                        </div>

                                                        <div class="form-group col-lg-4">

                                                           <!-- <select name="" class="form-control caret">

                                                              <option value="">Select Counrty</option>

                                                           </select>

                                                           <i class="icofont-caret-down"></i> -->  

                                                            <input type="text" class="form-control" name="City" placeholder="City">

                                                        </div>


                                                        <div class="form-group col-lg-4">

                                                           <!-- <select name="" class="form-control caret">

                                                              <option value="">Select Counrty</option>

                                                           </select> -->

                                                            <input class="form-control" id="country_selector" type="text"  placeholder="Selected country" autocomplete="new-password">

                                                            <input type="hidden" class="form-control" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" autocomplete="new-password"/>

                                <!-- <i class="icofont-caret-down"></i> -->  

                                                        </div>
                                                        
                                                        <div class="form-group col-lg-4" >

                                                            <input type="text" class="form-control" name="Postal_Code" placeholder="Postal Code" onkeypress="javascript:return isNumber(event)">  

                                                        </div>

                                                        <div class="form-group col-lg-4">

                                                            <div class="input-group append-icon">

                                                               <!-- <input type="text" class="form-control mydatepicker required" name="" placeholder="DD/MM/YY"> 

                                                                  <span class="error error-failed">*Required Information</span> -->

                                                                <input type="text" class="form-control mydatepicker date_picker" name="Dob" placeholder="Date of Birth"  value="<?php echo $Dob; ?>"  placeholder="DD/MM/YY">

                                                                <div class="input-group-append">

                                                                    <span class="input-group-text"><i class="icofont-calendar"></i></span>

                                                                </div>

                                                            </div>

                                                            <span><input type="hidden" name="DOB_Error"></span>



                                                        </div>



                                                        <div class="form-group col-lg-4" style="display: none">

                                                           <!-- <select name="" class="form-control caret">

                                                              <option value="">Select Counrty</option>

                                                           </select>

                                                           <i class="icofont-caret-down"></i>  --> 

                                                            <input type="text" class="form-control" name="State" placeholder="State">

                                                        </div>

                                                        <div class="form-group col-lg-4" style="display:none">

                                                            <select name="PaymentType" class="form-control caret">

                                                                <option value="">Payment Type</option>

                                                                <option value="M"  >MONTHLY</option>

                                                                <!--<option value="Y" selected>YEARLY</option>-->

                                                            </select>

                                                            <i class="icofont-caret-down"></i>  

                                                            <span><input type="hidden" name="PaymentType_Error"></span>

                                                        </div>



                                                        <div class="form-group col-lg-4">

                                                            <label for="">Gender</label>

                                                            <div class="d-flex justify-content-start flex-nowrap check-flex">

                                                                <div class="">

                                                                    <div class="checkbox-container">

                                                                        <label class="checkbox-secondary">

                                                                            <input type="radio" name="gender" value='F'>

                                                                            <span class="checkbox-custom rectangular"></span>

                                                                        </label>

                                                                        <span class="checkbox-title-secondary">Female</span>

                                                                    </div>

                                                                </div>

                                                                <div class="">

                                                                    <div class="checkbox-container">

                                                                        <label class="checkbox-secondary">

                                                                            <input type="radio" name="gender" value='M'>

                                                                            <span class="checkbox-custom rectangular"></span>

                                                                        </label>

                                                                        <span class="checkbox-title-secondary">Male</span>

                                                                    </div>

                                                                </div>

                                                                <!-- <div class="">

                                                                   <div class="checkbox-container">

                                                                      <label class="checkbox-secondary">

                                                                      <input type="checkbox" id="signed-in">

                                                                      <span class="checkbox-custom rectangular"></span>

                                                                      </label>

                                                                      <span class="checkbox-title-secondary">Rather not say</span>

                                                                   </div>

                                                                </div> -->

                                                            </div>

                                                            <span><input type="hidden" name="gender_Error"></span>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <hr class="step-seprator">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <h4>Instructions</h4>

                                                    <p>Complete your Personal Details</p>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box-transparent">

                                                    <h4 class="form-caption">5. T&C's</h4>

                                                    <div class="row mt-4">

                                                        <div class="col-lg-8">

                                                            <div class="d-flex justify-content-start">

                                                                <h5 class="fs-16 fw-4 mb-0 mr-4">Accept Terms & Conditions,</h5>

                                                                <div class="form-check form-check-inline">

                                                                    <input class="form-check-input" type="checkbox" id="terms_cond" name="tANDc" value="">



                                                                    <label class="form-check-label" for=""><a data-toggle="modal" class="fs-10 link-primary" href="#terms-modal">Read Terms & Condition</a></label>



                                                                </div>

                                                            </div>

                                                            <span><input type="hidden" name="tANDc_Error"></span>

                                                        </div>

                                                              <!-- <span class="error error-failed">*Required Information</span> -->



                                                        <div class="col-lg-4">

                                                            <div class="step-nav">

                                                                <ul class="list-inline">

                                                                    <li>

                                                                        <!-- <button type="button" class="button-warning next-step">Save and Next</button> -->

                                                                        <!-- <button class="btn btn-primary px-5 next-step" onlick='javascript:return false;'>NEXT <i class="icofont-simple-right"></i></button> -->

                                                                        <a href="javascript:void(0)" class="button-warning next-step" onclick="next('1')"> Save & Next</a>

                                                                        <!-- <input type="button" class="btn btn-primary px-5 next-step" onlick='javascript:return false;' value="NEXT"> -->

                                                                    </li>

                                                                </ul>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                </div>

                                <!-- step 1 end here -->

                                <div class="tab-pane" role="tabpanel" id="step2">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3">

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box-transparent" id="verification-box">

                                                    <h4 class="fs-18 fw-3">Now that you have completed the mandatory fields required on the Account Profile page, check your email for a verification code (don't forget to check the junk folder!)</h4>

                                                    <div class="verifiation-box mt-5">

                                                        <h6 class="fs-14 fw-3 mb-4">Enter your verification code here</h6>

                                                        <div class="digit-group">

                                                            <input type="text" id="digit_1" name="digit_1" data-next="digit_2" maxlength="1" onkeypress="javascript:return isNumber(event,$(this));" />

                                                            <input type="text" id="digit_2" name="digit_2" data-next="digit_3" maxlength="1" data-previous="digit_1" onkeypress="javascript:return isNumber(event,$(this));" />

                                                            <input type="text" id="digit_3" name="digit_3" data-next="digit_4" maxlength="1" data-previous="digit_1" onkeypress="javascript:return isNumber(event,$(this));"  />

                                                            <input type="text" id="digit_4" name="digit_4" data-next="digit_5" maxlength="1" data-previous="digit_1" onkeypress="javascript:return isNumber(event,$(this));" />

                                                            <input type="text" id="digit_5" name="digit_5" data-next="digit_6" maxlength="1" data-previous="digit_1" onkeypress="javascript:return isNumber(event,$(this));"  />

                                                            <input type="text" id="digit_6" name="digit_6" data-previous="digit_1" maxlength="1" onkeypress="javascript:return isNumber(event,$(this))"  />

                                                        </div><br>

                                                    </div>

                                                    <span><input type="hidden" name="otp_verification"></span>

                                                    <!-- <span class="error error-failed">*Required Information</span> -->

                                                </div>

                                                <div class="form-box-transparent" id="verified-confirm">

                                                    <h4 class="fs-18 fw-3">Thanks for verifying your email</h4>

                                                    <div class="verifiation-box mt-4">

                                                        <h6 class="fs-14 fw-3 mb-4">We will take you through the setup step by step</h6>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <hr class="step-seprator">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3">

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="row" style="padding:20px 10px">

                                                <div class="col-lg-8">

                                                </div>

                                                <div class="col-lg-4">

                                                    <div class="step-nav">

                                                        <ul class="list-inline pull-right">

                                                            <li>

                                                                <!-- <button type="button" class="button-warning prev-step">Back</button> -->

                                                                <a href="javascript:void(0)" class="button-warning prev-step" onclick="back('1')"> Back</a>

                                                            </li>

                                                            <li>

                                                                <!-- <button type="button" class="button-warning next-step" id="verfication-btn">Continue</button> -->

                                                                <a href="javascript:void(0)" class="button-warning next-step" onclick="next('2')"> Next</a>

                                                            </li>

                                                        </ul>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                </div>

                                <!-- step 2 end here -->

                                <div class="tab-pane" role="tabpanel" id="step3">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3"></div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <h4>Select your plan, payment frequency plan and preferred method of payment.</h4>

                                            </div>

                                        </div>

                                    </div>

                                    <hr class="step-seprator">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <p>Select between the basic or premium plan options that you can pay annually or monthly</p>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box-transparent">
                                                    <h4 class="form-caption">1. What plan?</h4>
                                                    <input type="hidden" name="sub_plan_id" id="sub_plan_id">
                                                    <input type="hidden" name="ipn" id="ipn">
                                                    <div class="row mb-4">
                                                            <?php if(!empty($plans)){
                                                            foreach($plans as $value){ ?>
                                                        <div class="col-lg-4 mt-3 mb-3">

                                                            <div class="card pricing-card basic-plan h-100">

                                                                <div class="card-header">

                                                                    <h4 class="card-title"><?php echo $value['name']; ?></h4>

                                                                </div>

                                                                <!-- <span><input type="hidden" name="subscription_plan_Error"></span> -->

                                                                <div class="card-body">

                                                                    <div class="plan-sm">

                                                                        <div class="row no-gutters">

                                                                            <div class="col-10">

                                                                                <h2><sup><?php if( $value['currency'] ==1){echo "NZD";} if( $value['currency'] ==2){echo "$";} ?></sup> <?php echo $value['plan_price']; ?></h2>

                                                                            </div>

                                                                            <div class="col-2 align-self-center">

                                                                                <input type="radio" name="subscription_plan" id="plan_id" value="<?php echo $value['plan_id']; ?>">

                                                                            </div>

                                                                        </div>

                                                                        <span><input type="hidden" name="subscription_plan_Error"></span>

                                                                        <p>Per <?php if($value['type']==1){echo 'Fortnight';}if($value['type']==2){echo 'Month';} if($value['type']==3){echo 'Year';} ?> Paid <span class=""><?php if($value['type']==1){echo 'Fortnight';}if($value[type]==2){echo 'Monthly';} if($value[type]==3){echo 'Yearly';} ?></span></p>

                                                                    </div>

                                                                    <!--<div class="plan-sm">-->

                                                                    <!--    <div class="row no-gutters">-->

                                                                    <!--        <div class="col-10">-->

                                                                    <!--            <h2><sup>US</sup> $39</h2>-->

                                                                    <!--        </div>-->

                                                                    <!--        <div class="col-2 align-self-center">-->

                                                                    <!--            <input type="radio" name="subscription_plan[]" id="annualBasicPlan">-->

                                                                    <!--        </div>-->

                                                                    <!--    </div>-->



                                                                    <!--    <p>Per Month Paid <span class="link-warning">ANNUALLY</span></p>-->

                                                                    <!--</div>-->



                                                                    <div class="plan-list">

                                                                        <ul>

                                                                            <li>Setup Charges: <?php echo $value['s_price']; ?></li>
                                                                            
                                                                            <li>Trial: <?php if($value['trial_period'] ==1){echo "Fortnight";}if($value['trial_period'] ==2){echo "Monthly";}if($value['trial_period'] ==1){echo "Yearly";} ?></li>
                                                                            
                                                                            <li>Tax: <?php if( $value['tax_percentage'] ==0){ echo 'No Tax';} else{ echo $value[tax_percentage];} ?></li>

                                                                            <li>Auto Billing: <?php if($value['auto_billing'] ==1){echo "Yes";} else{echo "No";} ?></li>

                                                                            <li>Description: <?php echo $value['description']; ?></li>
                                                                            

                                                                        </ul>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- end card-->

                                                        </div>
                                                            <?php }}?>

                                                        <!--<div class="col-lg-4">-->

                                                        <!--    <h4 class="form-caption">&nbsp;</h4>-->

                                                        <!--    <div class="card pricing-card premium-plan h-100">-->

                                                        <!--        <div class="card-header">-->

                                                        <!--            <h4 class="card-title">PREMIUM PLAN (BEST VALUE)</h4>-->

                                                        <!--        </div>-->

                                                        <!--        <div class="card-body">-->

                                                        <!--            <div class="plan-sm">-->

                                                        <!--                <div class="row no-gutters">-->

                                                        <!--                    <div class="col-10">-->

                                                        <!--                        <h2><sup>US</sup> $39</h2>-->

                                                        <!--                    </div>-->

                                                        <!--                    <div class="col-2 align-self-center">-->

                                                        <!--                        <input type="radio" name="subscription_plan[]" id="monthPremiumPlan">-->

                                                        <!--                    </div>-->

                                                        <!--                </div>-->

                                                        <!--                <p>Per Month Paid <span class="">MONTHLY</span></p>-->

                                                        <!--            </div>-->

                                                        <!--            <div class="plan-sm">-->

                                                        <!--                <div class="row no-gutters">-->

                                                        <!--                    <div class="col-10">-->

                                                        <!--                        <h2><sup>US</sup> $588</h2>-->

                                                        <!--                    </div>-->

                                                        <!--                    <div class="col-2 align-self-center">-->

                                                        <!--                        <input type="radio" name="subscription_plan[]" id="annualPremiumPlan">-->

                                                        <!--                    </div>-->

                                                        <!--                </div>-->

                                                        <!--                <p>Per Month Paid <span class="link-warning">ANNUALLY</span></p>-->

                                                        <!--            </div>-->

                                                        <!--            <div class="plan-list">-->

                                                        <!--                <ul>-->

                                                        <!--                    <li>Select your plan, payment frequency.</li>-->

                                                        <!--                    <li>Select your plan, payment frequency.</li>-->

                                                        <!--                    <li>Select your plan, payment frequency.</li>-->

                                                        <!--                    <li>Select your plan, payment frequency.</li>-->

                                                        <!--                </ul>-->

                                                        <!--            </div>-->

                                                        <!--        </div>-->

                                                        <!--    </div>-->

                                                            <!-- end card-->

                                                        <!--</div>-->

                                                        <div class="col-md-4">

                                                            <h4 class="form-caption">2. Total cost and frequency</h4>

                                                            <div class="card pricing-card total-card">

                                                                <div class="card-header">

                                                                    <h4 class="card-title text-white">YOUR TOTAL</h4>

                                                                </div>

                                                                <div class="card-body">

                                                                    <div class="plan-lg text-center">

                                                                        <h2 class="text-white mt-2"><sup>US</sup> <span id="totalCost">$49</span></h2>

                                                                    </div>

                                                                    <div class="payment-method">

                                                                        <h4>PAYMENT METHOD: <b>MONTHLY</b></h4>

                                                                        <p>Recurring billing, cancle anytime</p>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- end card-->

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <hr class="step-seprator">

                                    <div class="row no-gutters" id="paypalcard"></div>

                                    <!-- end row-->

                                    <hr class="step-seprator">

                                    <!--<div class="row no-gutters card_payment box" id="">-->

                                    <!--    <div class="col-lg-3">-->

                                    <!--        <div class="sidebar-col">-->

                                    <!--            <div class="instruction-box">-->

                                    <!--                <p>Once you have confirmed your credit card details and payment has been confirmed, a receipt will be sent to your email</p>-->

                                    <!--            </div>-->

                                    <!--        </div>-->

                                    <!--    </div>-->

                                    <!--    <div class="col-lg-9">-->

                                    <!--        <div class="right-bar">-->

                                    <!--            <div class="form-box-transparent" id="card-info">-->

                                    <!--                <h4 class="form-caption">4. Credit Card Payment</h4>-->

                                    <!--                <div class="row">-->

                                    <!--                    <div class="form-group col-lg-4">-->

                                    <!--                        <label for="">Credit Card Number</label>-->

                                    <!--                        <input class="form-control" type="text" name="Card_Number"  placeholder="1234 1234 1245 1244" onkeypress="javascript:return isNumber(event)" maxlength="16">-->

                                    <!--                        <span><input type="hidden" name="Card_Number_Error"></span>-->

                                    <!--                    </div>-->

                                    <!--                    <div class="form-group col-lg-4">-->

                                    <!--                        <label for="">Expiry</label>-->

                                    <!--                        <div class="row">-->

                                    <!--                            <div class="col">-->

                                    <!--                                <select name="month_list" class="form-control caret with-custom-caret">-->

                                    <!--                                    <option value="">Month</option>-->

                                    <!--                                    option-->

                                    <!--                                </select>-->

                                    <!--                                <span><input type="hidden" name="month_list_Error"></span>-->

                                    <!--                                <i class="icofont-caret-down align-caret"></i>-->

                                    <!--                            </div>-->

                                    <!--                            <div class="col">-->

                                    <!--                                <select name="year_list" class="form-control caret with-custom-caret">-->

                                    <!--                                    <option value="">Year</option>-->

                                    <!--                                    option-->

                                    <!--                                </select>-->

                                    <!--                                <span><input type="hidden" name="year_list_Error"></span>-->

                                    <!--                                <i class="icofont-caret-down align-caret"></i>-->

                                    <!--                            </div>-->

                                    <!--                        </div>-->

                                    <!--                    </div>-->

                                    <!--                    <div class="col-lg-4"></div>-->

                                    <!--                    <div class="form-group col-lg-4">-->

                                    <!--                        <label for="">Name on Credit Card</label>-->

                                    <!--                        <input class="form-control" type="text" name="Cardholder_Name" placeholder="Name on Credit Card">-->

                                    <!--                        <span><input type="hidden" name="Cardholder_Name_Error"></span>-->

                                    <!--                    </div>-->

                                    <!--                    <div class="col-lg-4">-->

                                    <!--                        <div class="row">-->

                                    <!--                            <div class="form-group col-md-6">-->

                                    <!--                                <label for="">CVV <sup><a href="#">What is cvv?</a></sup></label>-->

                                    <!--                                <input class="form-control" type="text" name="CVV" placeholder="CVV" maxlength="3" onkeypress="javascript:return isNumber(event)">-->

                                    <!--                                <span><input type="hidden" name="CVV_Error"></span>-->

                                    <!--                            </div>-->

                                    <!--                            <div class="col-md-6">-->

                                    <!--                                <label class="d-block">&nbsp;</label>-->

                                                                    <!-- <button class="button-info btn-block mt-4" id="confirm">CONFIRM</button> -->

                                    <!--                                <input type="button" value="Confirm" class="button-info w-100" />-->

                                    <!--                            </div>-->

                                    <!--                        </div>-->

                                    <!--                    </div>-->

                                    <!--                </div>-->

                                    <!--            </div>-->



                                    <!--            <div class="form-box-transparent" id="card-accept">-->

                                    <!--                <h4 class="fs-18 fw-3">Card has been accepted???</h4>-->

                                    <!--                <div class="verifiation-box mt-4">-->

                                    <!--                    <h6 class="fs-14 fw-3 mb-4">Thanks for adding your card. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores</h6>-->

                                    <!--                </div>-->

                                    <!--            </div>-->

                                    <!--        </div>-->

                                    <!--    </div>-->

                                    <!--</div>-->

                                    <!-- end row-->

                                    <div class="row no-gutters paypal_payment box" id="">

                                        <div class="col-lg-3">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <p>Pay with PayPal</p>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box-transparent">

                                                    <h4 class="form-caption">4. Paypal</h4>

                                                    <div class="mt-5">
                                                        <div id="paypal-button-container"></div>
                                                        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                                                        <script src="https://www.paypal.com/sdk/js?client-id=AZAbN8uo_hC8FzdWeEGGsYxuTpFdvQ-fhkrXDYQo4niPlnpMICgdYvTR3WvGA2GlON7fzlehS56Rylao&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
                                                        <script>
                                                                $('#sub_plan_id').val("")
                                                                var thtml = '<div class="col-lg-3"><div class="sidebar-col"><div class="instruction-box"><p>If you are using your pay pal account, once you have click on this option, it will take you to the pay pal screen and process</p></div></div></div>';
                                        thtml+='<div class="col-lg-9"><div class="right-bar"><div class="form-box-transparent mt-3"><h4 class="form-caption">3. Select your payment option</h4><div class="row">';
                                                        <!--<div class="col-lg-4 form-group">-->

                                                        <!--    <div class="payment-option h-100">-->

                                                        <!--        <div class="row no-gutters">-->

                                                        <!--            <div class="col-2 align-self-center">-->

                                                        <!--                <input type="radio" name="payment_option[]" id="" value="card_payment"> -->

                                                        <!--            </div>-->

                                                        <!--            <div class="col-10">-->

                                                        <!--                <h4 class="text-right"><img src="<?php echo SITE_BASE_URL; ?>assets/img/credit-card-sm.png" class="img-fluid" width="55px;"> Credit Card</h4>-->

                                                        <!--            </div>-->

                                                        <!--        </div>-->

                                                        <!--    </div>-->

                                                        <!--    <span><input type="hidden" name="payment_option_Error"></span>-->

                                                        <!--</div>-->
                                                        thtml+='<div class="col-lg-4 form-group"><div class="payment-option h-100"><div class="row no-gutters"><div class="col-2 align-self-center"><input type="radio" checked name="payment_option[]" id="" value="paypal_payment"></div>';
                                                        thtml+='<div class="col-10"><h4><img src="<?php echo SITE_BASE_URL; ?>assets/img/paypal-icon.png" class="img-fluid"></h4></div></div></div></div><span><input type="hidden" name="payment_option_error"></span></div></div></div></div>';
                                                                $('input:radio[name=subscription_plan]').on('change', function() {
                                                                    // alert('asd');
                                                                    $('.paypal_payment.box').show();
                                                                    $('.paypal_payment.box').css('display', 'flex');
                                                                    $('#paypalcard').html(thtml);
                                                                    var t = this.value;
                                                                    $('#sub_plan_id').val(t);
                                                          paypal.Buttons({
                                                              style: {
                                                                  shape: 'rect',
                                                                  color: 'gold',
                                                                  layout: 'vertical',
                                                                  label: 'subscribe'
                                                              },
                                                              createSubscription: function(data, actions) {
                                                                return actions.subscription.create({
                                                                  'plan_id': t
                                                                });
                                                              },
                                                              onApprove: function(data, actions) {
                                                                $('#ipn').val(data.subscriptionID);
                                                                var ipn = data.subscriptionID;
                                                                var plan_id = t;
                                                                var email = $('#email').val();
                                                                // URL = "<?= SITE_BASE_URL;?>Property/AddToFavorite.html?ProjectId="+ proId +"&UserId="+ user_id,
                                                                URL="<?php echo SITE_BASE_URL; ?>Login/PaymentSuccessfull.html?email=" + email + "& ipn=" + ipn+ "& plan_id=" + plan_id
                                                                $.ajax({url: URL, success: function (result) {
                                                                    // $('#addtofav').html('<a href="javascript:void(0);" onclick="removeFromFavourite(¥'' + proId + '¥',¥'' + user_id + '¥')"><i class="fas fa-heart"></i> Remove From My Favourites</a>');
                                                                    next('3');
                                                                    console.log(result);
                                                                }
                                                                })
                                                              }
                                                          }).render('#paypal-button-container');
                                                                });
                                                        </script>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <hr class="step-seprator">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3">

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="row" style="padding:20px 10px;">

                                                <div class="col-lg-8">

                                                </div>

                                                <div class="col-lg-4">

                                                    <div class="step-nav">

                                                        <ul class="list-inline pull-right">

                                                            <li>

                                                                <!-- <button type="button" class="button-warning prev-step">Back</button> -->

                                                                <a href="javascript:void(0)" class="button-warning prev-step" onclick="back('1')"> Back</a>

                                                            </li>

                                                            <li>

                                                                <!-- <button type="button" class="button-warning next-step">Continue</button> -->

                                                                <a href="javascript:void(0)" class="button-warning next-step" onclick="next('3')"> Next</a>

                                                            </li>

                                                        </ul>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                </div>

                                <!-- step 3 end here -->

                                <div class="tab-pane" role="tabpanel" id="step4">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3 align-self-end">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <p>Simply add more by clicking on the +</p>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box-transparent">

                                                    <h4 class="fs-18 fw-3">Please enter your financial details as below. If you dont have all the information on hand, you can save and come back to it later.</h4>

                                                    <div class="row mt-4">

                                                        <div class="col-lg-5 form-group">

                                                            <label>Existing Gross income(NZD)</label>

                                                            <input type="text" id="existing_gross" name="existing_gross" class="form-control  required" placeholder="Existing Gross income(Excluding this property)($NZD)" onkeypress="javascript:return isNumber(event)">

                                                            <span class="error error-failed">*Required Information</span>

                                                        </div>

                                                        <div class="col-lg-5 offset-lg-1 form-group">

                                                            <label>Mortgage Balance (NZD)</label>

                                                            <input type="text" id="mortage_balance" name="mortage_balance" class="form-control  required" placeholder="" onkeypress="javascript:return isNumber(event)">

                                                            <span class="error error-failed">*Required Information</span>

                                                        </div>

                                                        <div class="col-lg-5 form-group" id="loanAmountDiv">

                                                            <label>Loan Amount (NZD)</label>

                                                            <input type="text" class="form-control  required" placeholder="" name="loan_amount" id="loan_amount" onkeypress="javascript:return isNumber(event)">

                                                            <span class="error error-failed">*Required Information</span>

                                                        </div>

                                                        <!--                                                        <div class="col-lg-1 form-group align-self-end ">

                                                                                                                    <a class="add-more"  id="addMore"><i class="icofont-plus-circle"></i></a>

                                                                                                                </div>-->

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <hr class="step-seprator">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3">

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="row" style="padding:20px 10px">

                                                <div class="col-lg-8">

                                                </div>

                                                <div class="col-lg-4">

                                                    <div class="step-nav">

                                                        <ul class="list-inline pull-right">

                                                            <li>

                                                               <!-- <button type="button" class="button-warning prev-step"><i class="icofont-simple-left"></i> Back</button> -->

                                                                <a href="javascript:void(0)" class="button-warning prev-step" onclick="back('3')"> Back</a>

                                                            </li>

                                                            <li>

                                                               <!-- <button type="button" class="button-warning next-step">Save & Next <i class="icofont-simple-right"></i></button> -->

                                                                <a href="javascript:void(0)" class="button-warning next-step" onclick="next('4')"> Next</a>

                                                            </li>

                                                        </ul>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                </div>

                                <!-- step 4 end here -->

                                <div class="tab-pane" role="tabpanel" id="step5">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3 align-self-center">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <p>Simply add more by clicking on the +</p>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box-transparent">

                                                    <h4 class="fs-18 fw-3 mb-4">Do you own a property</h4>

                                                    <div class="d-flex justify-content-start">

                                                        <div class="property-box mr-4">

                                                            <img src="<?php echo SITE_BASE_URL; ?>assets/img/ebook-download.png" class="img-fluid">

                                                            <div class="form-check text-center mt-3">

                                                                <input type="radio" class="form-check-input" id="own_property_yes" name="add_property[]" value="yes">

                                                                <label class="form-check-label" for="">YES</label>

                                                            </div>

                                                        </div>

                                                        <div class="property-box">

                                                            <img src="<?php echo SITE_BASE_URL; ?>assets/img/ebook-download.png" class="img-fluid">

                                                            <div class="form-check text-center mt-3">

                                                                <input type="radio" class="form-check-input" id="own_property_no" name="add_property[]" value="no">

                                                                <label class="form-check-label" for="">NO</label>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <span><input type="hidden" name="add_property_Error"></span>

                                                    <div class="mt-5 add-property-details">

                                                        <button type="button" id="" class="button-outline-warning">Add Property Details</button>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <hr class="step-seprator">

                                    <div class="row no-gutters add-property-details">

                                        <div class="col-lg-3">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <h4>Instructions</h4>

                                                    <p>Complete your Personal Details</p>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="row">

                                                    <div class="col-md-4">

                                                        <div class="form-box h-100">

                                                            <h4 class="form-caption text-center mb-4">1. Upload Property Photo</h4>

                                                            <div class="form-group">

                                                                <div class="js upload-one">

                                                                    <input type="file" name="name-proof[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />

                                                                    <label for="file-1"><span>Upload property photo</span></label>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-8">

                                                        <div class="form-box h-100">

                                                            <h4 class="form-caption">2. Property Details</h4>

                                                            <div class="row">

                                                                <div class="form-group col-lg-6">

                                                                    <input class="form-control required" type="text" name="property_name" placeholder="Property Name">

                                                                    <span><input type="hidden" name="property_name_Error"></span>

                                                                </div>

                                                                <div class="form-group col-lg-6">

                                                                    <input class="form-control required" type="text" name="property_unit_name" placeholder="Unit Name">

                                                                    <span><input type="hidden" name="property_unit_name_Error"></span>

                                                                </div>

                                                                <div class="form-group col-lg-6">

                                                                    <input class="form-control" type="text" name="property_suburb" placeholder="Suburb">

                                                                    <span><input type="hidden" name="property_suburb_Error"></span>

                                                                </div>

                                                                <div class="form-group col-lg-6">

                                                                    <input class="form-control" type="text" name="property_city" placeholder="City">

                                                                    <span><input type="hidden" name="property_city_Error"></span>

                                                                </div>

                                                                <div class="form-group col-lg-6">

                                                                    <input class="form-control" type="text" name="property_country" placeholder="Country">

                                                                    <span><input type="hidden" name="property_country_Error"></span>

                                                                </div>

                                                                <div class="form-group col-lg-6">

                                                                    <input class="form-control" type="text" name="property_postcode" placeholder="Post Code" onkeypress="javascript:return isNumber(event)">

                                                                    <span><input type="hidden" name="property_postcode_Error"></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <div class="row no-gutters add-property-details">

                                        <div class="col-lg-3">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <h4>Instructions</h4>

                                                    <p>Complete your Personal Details</p>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box mt-3">

                                                    <h4 class="form-caption">3. Property Type</h4>

                                                    <div class="row">

                                                        <div class="col-lg-4 form-group">

                                                            <input class="form-control required" type="text" name="property_type" placeholder="Property Type">

                                                            <span class="error error-failed">*Required Information</span>

                                                        </div>

                                                        <div class="col-lg-4 form-group">

                                                            <div class="input-group select-filter">



                                                                <input type="text" class="form-control" aria-label="button" placeholder="Current Value" name="current_value" onkeypress="javascript:return isNumber(event)">

                                                                <!--<div class="input-group-append">-->

                                                                <!--    <select name="" class="form-control caret">-->

                                                                <!--        <option>FT</option>-->

                                                                <!--    </select>-->

                                                                <!--    <i class="icofont-caret-down"></i>-->

                                                                <!--</div>-->

                                                            </div>

                                                        </div>

                                                        <div class="form-group col-lg-4">

                                                            <div class="input-group append-icon">

                                                                <input type="text" class="form-control mydatepicker" name="date_purchased" placeholder="Date Purchased">

                                                                <div class="input-group-append">

                                                                    <span class="input-group-text"><i class="icofont-calendar"></i></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <!-- <div class="form-group col-lg-4">

                                                           <div class="input-group append-icon">

                                                              <input type="text" class="form-control mydatepicker" name="" placeholder="Date Purchased">

                                                              <div class="input-group-append">

                                                                 <span class="input-group-text"><i class="icofont-calendar"></i></span>

                                                              </div>

                                                           </div>

                                                        </div> -->

                                                        <div class="form-group col-lg-4">

                                                            <div class="input-group append-icon">

                                                                <input type="text" class="form-control mydatepicker" name="date_compilation" placeholder="Date of Completion">

                                                                <div class="input-group-append">

                                                                    <span class="input-group-text"><i class="icofont-calendar"></i></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <!-- <div class="col-lg-4 form-group">

                                                           <div class="input-group select-filter">

                                                              <div class="input-group-prepend">

                                                                 <select name="country2" class="form-control caret">

                                                                    <option>NZD</option>

                                                                 </select>

                                                                 <i class="icofont-caret-down"></i>

                                                              </div>

                                                              <input type="text" class="form-control" aria-label="button" placeholder="Current Value">

                                                           </div>

                                                        </div> -->

                                                        <div class="col-lg-4 form-group">

                                                            <div class="input-group select-filter">

                                                                <div class="input-group-prepend">

                                                                    <select name="country2" class="form-control caret">

                                                                        <option>NZD</option>

                                                                    </select>

                                                                    <i class="icofont-caret-down"></i>

                                                                </div>

                                                                <input type="text" class="form-control required" aria-label="button" placeholder="Purchase Price" name="purchase_price" onkeypress="javascript:return isNumber(event)">

                                                                <span class="error error-failed">*Required Information</span>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <div class="row no-gutters add-property-details">

                                        <div class="col-lg-3">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <h4>Instructions</h4>

                                                    <p>Complete your Personal Details</p>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box h-100">

                                                    <h4 class="form-caption">4. Income</h4>

                                                    <div class="row">

                                                        <div class="col-lg-4 form-group mt-4">

                                                            <div class="input-group select-filter">

                                                                <div class="input-group-prepend">

                                                                    <select name="country2" class="form-control caret">

                                                                        <option>NZD</option>

                                                                    </select>

                                                                    <i class="icofont-caret-down"></i>

                                                                </div>

                                                                <input type="text" class="form-control required" aria-label="button" placeholder="Annual Rental" name="annual_rental" onkeypress="javascript:return isNumber(event)">

                                                                <span class="error error-failed">*Required Information</span>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <div class="row no-gutters add-property-details">

                                        <div class="col-lg-3">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <h4>Instructions</h4>

                                                    <p>Complete your Personal Details</p>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box">

                                                    <h4 class="form-caption">5. Expenses</h4>

                                                    <div class="row">

                                                        <div class="form-group col-lg-4">

                                                            <input class="form-control required" type="text" id="rates_value" name="rates_value" placeholder="Rates $ value" onkeypress="javascript:return isNumber(event)" onchange="calc_expense()">

                                                            <span class="error error-failed">*Required Information</span>

                                                        </div>

                                                        <div class="form-group col-lg-4">

                                                            <input class="form-control required" type="text" id="ground_rent" name="ground_rent" placeholder="Ground Rent" onkeypress="javascript:return isNumber(event)"onchange=" calc_expense()">

                                                            <span class="error error-failed">*Required Information</span>

                                                        </div>

                                                        <div class="form-group col-lg-2 pr-1">

                                                            <input class="form-control" type="text" id="management_fees" name="management_fees" placeholder="Management Fee" onkeypress="javascript:return isNumber(event)" onchange="calc_expense()">

                                                        </div>

                                                        <!-- <div class="form-group col-lg-2 pl-1">

                                                           <input class="form-control" type="text" name="name" placeholder="Management FeeÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¾ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢s $">

                                                        </div> -->

                                                        <div class="form-group col-lg-4">

                                                            <input class="form-control" type="text" id="adminstration_fee_year" name="adminstration_fee_year" placeholder="Adminstration fee Year $" onkeypress="javascript:return isNumber(event)" onchange="calc_expense()">

                                                        </div>

                                                        <div class="form-group col-lg-4">

                                                            <input class="form-control" type="text" id="property_maintenance" name="property_maintenance" placeholder="Property Maintenance" onchange="calc_expense()">

                                                        </div>

                                                        <div class="form-group col-lg-4">

                                                            <input class="form-control" type="text" id="other_costs" name="other_costs" placeholder="Other Costs" onkeypress="javascript:return isNumber(event)" onchange="calc_expense()">

                                                        </div>

                                                        <div class="form-group col-lg-4">

                                                            <input class="form-control" type="text" id="body_corporate_fees" name="body_corporate_fees" placeholder="Body Corporate fee $ Value" onkeypress="javascript:return isNumber(event)" onchange="calc_expense()">

                                                        </div>

                                                        <div class="form-group col-lg-4 offset-lg-4">

                                                            <div class="input-group">

                                                                <div class="input-group-prepend">

                                                                    <span class="input-group-text">Total Expense $</span>

                                                                </div>

                                                                <input class="form-control" readonly="" id="total_expense" type="text" name="name" value="" onkeypress="javascript:return isNumber(event)">

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <div class="row no-gutters mt-4 add-property-details">

                                        <div class="col-lg-3">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <h4>Instructions</h4>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box">

                                                    <h4 class="form-caption">6. Growth</h4>

                                                    <div class="row">

                                                        <div class="form-group col-lg-4">

                                                            <input class="form-control required" type="text" name="capital_growth" placeholder="5-10 Yr Capital Growth" onkeypress="javascript:return isNumber(event)">

                                                            <span class="error error-failed">*Required Information</span>

                                                        </div>

                                                        <div class="form-group col-lg-4">

                                                            <input class="form-control" type="text" name="yearly_rental_growth" placeholder="Yearly rental growth" onkeypress="javascript:return isNumber(event)">

                                                        </div>

                                                        <div class="form-group col-lg-4">

                                                            <input class="form-control" type="text" name="growth_rates_value" placeholder="Rates $ value" onkeypress="javascript:return isNumber(event)">

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <div class="row no-gutters add-property-details">

                                        <div class="col-lg-3">

                                            <div class="sidebar-col">

                                                <div class="instruction-box">

                                                    <h4>Instructions</h4>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-9">



                                            <div class="right-bar">

                                                <div class="form-box-transparent">

                                                    <div class="mt-5 text-right">

                                                        <button class="button-outline-warning" id="">Add Second Property Details</button>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <hr class="step-seprator">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3">

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box-transparent">

                                                    <div class="row mt-3">

                                                        <div class="col-lg-8">    

                                                        </div>

                                                        <div class="col-lg-4">

                                                            <div class="step-nav">

                                                                <ul class="list-inline pull-right">

                                                                    <li>

                                                                        <a href="javascript:void(0)" class="button-warning prev-step" onclick="back('4')">Back</a>

                                                                           <!-- <button type="button" class="button-warning prev-step"><i class="icofont-simple-left"></i> Back</button> -->

                                                                    </li>

                                                                    <li>

                                                                        <a href="javascript:void(0)" class="button-warning next-step" onclick="next('5')">Save</a>

                                                                        <!-- <button type="button" class="button-warning next-step">Save & Next <i class="icofont-simple-right"></i></button> -->

                                                                    </li>

                                                                </ul>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                </div>

                                <!-- step 5 end here -->

                                <div class="tab-pane" role="tabpanel" id="step6">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3">

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box-transparent">

                                                    <div class="row">

                                                        <div class="col-lg-8 offset-lg-2">

                                                            <h2 class="fs-36 fw-3 mt-5 mb-0 text-center">YouÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¾ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢re now ready to begin your free 7 day trial!</h2>

                                                            <p class="fs-14 fw-3 mt-5 b-0 text-center">HavenÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¾ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢t received an email? Check your junk mail folder or feel free to contact us.</p>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                    <hr class="step-seprator">

                                    <div class="row no-gutters">

                                        <div class="col-lg-3">

                                        </div>

                                        <div class="col-lg-9">

                                            <div class="right-bar">

                                                <div class="form-box-transparent">

                                                    <div class="row mt-4">

                                                        <div class="col-lg-8">    

                                                        </div>

                                                        <div class="col-lg-4">

                                                            <div class="step-nav">

                                                                <ul class="list-inline pull-right">

                                                                    <li>

                                                                        <a href="javascript:void(0)" onclick="back('5')">Back</a>

                                                                        <!-- <button type="button" class="button-warning prev-step"><i class="icofont-simple-left"></i> Back</button> -->

                                                                    </li>

                                                                    <li>

                                                                        <button type="submit" class="button-warning next-step">Save & Next <i class="icofont-simple-right"></i></button>

                                                                    </li>

                                                                </ul>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end row-->

                                </div>

                                <!-- step 6 end here -->

                                <div class="clearfix"></div>

                            </div>

                        </div>

                    </form>

                </section>

            </div>

            <!-- Vendor JS Files -->

            <script src="<?php echo SITE_BASE_URL; ?>assets/vendor/jquery/jquery.min.js"></script>

            <script src="<?php echo SITE_BASE_URL; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <script src="<?php echo SITE_BASE_URL; ?>assets/vendor/aos/aos.js"></script>


                <!--<script src="https://www.paypal.com/sdk/js?client-id=AZAbN8uo_hC8FzdWeEGGsYxuTpFdvQ-fhkrXDYQo4niPlnpMICgdYvTR3WvGA2GlON7fzlehS56Rylao&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>-->
            <!--<div id="paypal-button-container"></div>-->
<!--<script src="https://www.paypal.com/sdk/js?client-id=AZAbN8uo_hC8FzdWeEGGsYxuTpFdvQ-fhkrXDYQo4niPlnpMICgdYvTR3WvGA2GlON7fzlehS56Rylao&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>-->
<!--<script>-->
<!--  paypal.Buttons({-->
<!--      style: {-->
<!--          shape: 'rect',-->
<!--          color: 'gold',-->
<!--          layout: 'vertical',-->
<!--          label: 'subscribe'-->
<!--      },-->
<!--      createSubscription: function(data, actions) {-->
<!--        return actions.subscription.create({-->
<!--          'plan_id': 'P-91M87237LV803201KL63BWHA'-->
<!--        });-->
<!--      },-->
<!--      onApprove: function(data, actions) {-->
<!--        alert(data.subscriptionID);-->
<!--      }-->
<!--  }).render('#paypal-button-container');-->
<!--</script>-->
            <!-- icheck -->

                      <!-- <script src="<?php echo SITE_BASE_URL; ?>assets/plugins/icheck/icheck.min.js"></script> -->



            <!-- Date Picker Plugin JavaScript -->





            <script src="<?php echo SITE_BASE_URL; ?>assets/vendor/jquery-steps/jquery-steps.min.js"></script>



                <!-- <script src="<?php echo SITE_BASE_URL; ?>assets/vendor/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script> -->



            <script src="https://cdn.jsdelivr.net/bootstrap.wizard/1.3.2/jquery.bootstrap.wizard.min.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js" ></script>

            <script src="<?php echo SITE_BASE_URL; ?>assets/vendor/customfileinputs/jquery.custom-file-input.js"></script>









<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js" integrity="sha512-DNeDhsl+FWnx5B1EQzsayHMyP6Xl/Mg+vcnFPXGNjUZrW28hQaa1+A4qL9M+AiOMmkAhKAWYHh1a+t6qxthzUw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" integrity="sha512-yye/u0ehQsrVrfSd6biT17t39Rg9kNc+vENcCXZuMz2a+LWFGvXUnYuWUW6pbfYj1jcBb/C39UZw2ciQvwDDvg==" crossorigin="anonymous" />

            <script>







                                                                            var form = $("#register_form").show();



                                                                            form.steps({

                                                                                headerTag: "h3",

                                                                                bodyTag: "section",

                                                                                transitionEffect: "slideLeft",

                                                                                titleTemplate: "#title#",

                                                                                enableAllSteps: true,

                                                                                enablePagination: false,



                                                                            });





                                                                            // $(document).delegate('.next-step', 'click', function () {

                                                                            //  var a = $(".wizard").steps("next");

                                                                            //  if (!a) {

                                                                            //  $(".wizard").steps("finish");

                                                                            //  }

                                                                            //  });

                                                                            //  $(document).delegate('.previous', 'click', function () {

                                                                            //  var a = $(".wizard").steps("previous");

                                                                            //  if (!a) {

                                                                            //  $(".wizard").steps("finish");

                                                                            //  }

                                                                            //  });





                                                                            // $(document).ready(function(){

                                                                            //   $('.icheck').iCheck({

                                                                            //     checkboxClass: 'icheckbox_square',

                                                                            //     radioClass: 'iradio_square',

                                                                            //     increaseArea: '20%' // optional

                                                                            //   });

                                                                            //   $('.icheck-blue').iCheck({

                                                                            //     checkboxClass: 'icheckbox_square-blue',

                                                                            //     radioClass: 'iradio_square-blue',

                                                                            //     increaseArea: '20%' // optional

                                                                            //   });







                                                                            // });





                                                                            var input = document.querySelector(".phone-selecter");

                                                                            window.intlTelInput(input, {

                                                                                // any initialisation options go here

                                                                                initialCountry: "nz",

                                                                                nationalMode: true,

                                                                                placeholderNumberType: "MOBILE",

                                                                                separateDialCode: false,

                                                                            });

            </script>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

            <script src="<?php echo SITE_BASE_URL; ?>javascripts/country-picker-flags/build/js/countrySelect.js"></script>

            <script>

                                                                            $("#country_selector").countrySelect({

                                                                                preferredCountries: ['hk', 'cn', 'my', 'sg', 'in', 'tw']

                                                                            });

            </script>

    </body>



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.15.5/apexcharts.min.js"></script>

    <script src="<?php echo SITE_BASE_URL; ?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>

    <script>
    



                                                                            function calc_expense() {

                                                                                var total = parseFloat($('#rates_value').val()) +

                                                                                        parseFloat($('#ground_rent').val()) +

                                                                                        parseFloat($('#management_fees').val() )+

                                                                                        parseFloat($('#adminstration_fee_year').val()) +

                                                                                        parseFloat($('#property_maintenance').val()) +

                                                                                        parseFloat($('#other_costs').val() )+

                                                                                        parseFloat($('#body_corporate_fees').val());



                                                                                $('#total_expense').val(total)

                                                                            }

                                                                            function next(id) {

                                                                                var first_name = $("input[name='first_name']").val();

                                                                                var last_name = $("input[name='last_name']").val();

                                                                                var email = $("input[name='email']").val();

                                                                                var mobile = $("input[name='mobile']").val();

                                                                                var password = $("input[name='password']").val();

                                                                                var Confirm_password = $("input[name='Confirm_password']").val();

                                                                                var user_name = $("input[name='user_name']").val();

                                                                                var country = $("input[name='country_selector_code']").val();

                                                                                var City = $("input[name='City']").val();

                                                                                var Dob = $("input[name='Dob']").val();

                                                                                var Postal_Code = $("input[name='Postal_Code']").val();

                                                                                var PaymentType = $("select[name='PaymentType']").val();

                                                                                var gender = $("input[name='gender']:checked").val();

                                                                                var State = $("input[name='State']").val();

                                                                                var Address1 = $("input[name='Address1']").val();

                                                                                var tANDc = $("input[name='tANDc']").prop("checked");



                                                                                var digit_1 = $("input[name='digit_1']").val();

                                                                                var digit_2 = $("input[name='digit_2']").val();

                                                                                var digit_3 = $("input[name='digit_3']").val();

                                                                                var digit_4 = $("input[name='digit_4']").val();

                                                                                var digit_5 = $("input[name='digit_5']").val();

                                                                                var digit_6 = $("input[name='digit_6']").val();



                                                                                var subscription_plan = $('input[name="subscription_plan[]"]:checked').length;

                                                                                var payment_option = $('input[name="payment_option[]"]:checked').length;

                                                                                var payment_option_value = $('input[name="payment_option[]"]:checked').val();



                                                                                var add_property = $('input[name="add_property[]"]:checked').length;

                                                                                var add_property_value = $('input[name="add_property[]"]:checked').val();



                                                                                var Card_Number = $("input[name='Card_Number']").val();

                                                                                var CVV = $("input[name='CVV']").val();

                                                                                var Cardholder_Name = $("input[name='Cardholder_Name']").val();

                                                                                var month_list = $("select[name='month_list']").val();

                                                                                var year_list = $("select[name='year_list']").val();



                                                                                var existing_gross = $("input[name='existing_gross']").val();

                                                                                var mortage_balance = $("input[name='mortage_balance']").val();

                                                                                var loan_amount = $("input[name='loan_amount']").val();



                                                                                var property_name = $("input[name='property_name']").val();

                                                                                var property_unit_name = $("input[name='property_unit_name']").val();

                                                                                var property_suburb = $("input[name='property_suburb']").val();

                                                                                var property_city = $("input[name='property_city']").val();

                                                                                var property_country = $("input[name='property_country']").val();

                                                                                var property_postcode = $("input[name='property_postcode']").val();

                                                                                var property_type = $("input[name='property_type']").val();

                                                                                var current_value = $("input[name='current_value']").val();

                                                                                var date_purchased = $("input[name='date_purchased']").val();

                                                                                var date_compilation = $("input[name='date_compilation']").val();

                                                                                var purchase_price = $("input[name='purchase_price']").val();

                                                                                var annual_rental = $("input[name='annual_rental']").val();

                                                                                var rates_value = $("input[name='rates_value']").val();

                                                                                var ground_rent = $("input[name='ground_rent']").val();

                                                                                var management_fees = $("input[name='management_fees']").val();

                                                                                var adminstration_fee_year = $("input[name='adminstration_fee_year']").val();

                                                                                var property_maintenance = $("input[name='property_maintenance']").val();

                                                                                var other_costs = $("input[name='other_costs']").val();

                                                                                var body_corporate_fees = $("input[name='body_corporate_fees']").val();

                                                                                var capital_growth = $("input[name='capital_growth']").val();

                                                                                var yearly_rental_growth = $("input[name='yearly_rental_growth']").val();

                                                                                var growth_rates_value = $("input[name='growth_rates_value']").val();



                                                                                if (id == 1) {

                                                                                    $(".error").remove();

                                                                                    if (first_name.length < 1) {

                                                                                        $("input[name='first_name']").focus();

                                                                                        $("input[name='first_name']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                        // alert("First Name required");

                                                                                        return false;

                                                                                    }



                                                                                    if (last_name.length < 1) {

                                                                                        $("input[name='last_name']").focus();

                                                                                        $("input[name='last_name']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                        // alert("Last Name required");

                                                                                        return false;

                                                                                    }



                                                                                    if (email.length < 1) {

                                                                                        $("input[name='email']").focus();

                                                                                        $("input[name='email']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                        // alert("Email required");

                                                                                        return false;

                                                                                    } else {

                                                                                        var regEx = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                                                                                        var validEmail = regEx.test(email);

                                                                                        if (!validEmail) {

                                                                                            $("input[name='email']").focus();

                                                                                            $("input[name='email']").after('<span  class="error" style="color:red;">Enter a valid email</span>');

                                                                                            return false;

                                                                                        }

                                                                                    }



                                                                                    if (mobile.length < 1) {

                                                                                        $("input[name='mobile']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                        $("input[name='mobile']").focus();

                                                                                        // alert("mobile no required");

                                                                                        return false;

                                                                                    }





                                                                                    if (user_name.length < 1) {

                                                                                        $("input[name='user_name']").focus();

                                                                                        $("input[name='user_name']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                        // alert("Password must be at least 8 characters long");

                                                                                        return false;

                                                                                    }



                                                                                    if (password.length < 8) {

                                                                                        $("input[name='password']").focus();

                                                                                        $("input[name='password']").after('<span  class="error" style="color:red;">Password must be at least 8 characters long</span>');

                                                                                        // alert("Password must be at least 8 characters long");

                                                                                        return false;

                                                                                    }



                                                                                    if (Confirm_password.length < 8) {

                                                                                        $("input[name='Confirm_password']").focus();

                                                                                        $("input[name='Confirm_password']").after('<span  class="error" style="color:red;">Confirm password must be at least 8 characters long</span>');

                                                                                        // alert("Confirm password must be at least 8 characters long");

                                                                                        return false;

                                                                                    }



                                                                                    if (password != Confirm_password) {

                                                                                        $("input[name='Confirm_password']").after('<span  class="error" style="color:red;">Password not matching</span>');

                                                                                        // alert("Password not matching");

                                                                                        return false;

                                                                                    }



                                                                                    if (country.length < 1) {

                                                                                        $("input[name='country_selector_code']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                        return false;

                                                                                    }



//                                                                                    if (Dob.length < 1) {
//
//                                                                                        $("input[name='DOB_Error']").focus();
//
//                                                                                        $("input[name='DOB_Error']").after('<span  class="error" style="color:red;">This field is required</span>');
//
//                                                                                        // alert("DOB required");
//
//                                                                                        return false;
//
//                                                                                    }


/*
                                                                                    if (PaymentType.length == "") {

                                                                                        $("input[name='PaymentType_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                        $("input[name='PaymentType_Error']").focus();

                                                                                        // alert("mobile no required");

                                                                                        return false;

                                                                                    }
*/


                                                                                    if ($('input[type=radio][name=gender]:checked').length == 0) {

                                                                                        $("input[name='gender_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                        $("input[name='gender_Error']").focus();

                                                                                        // alert("Gender no required");

                                                                                        return false;

                                                                                    }



                                                                                    if (!tANDc) {

                                                                                        // alert("check T&C.");

                                                                                        $("input[name='tANDc_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                        $("input[name='tANDc_Error']").focus();

                                                                                        return false;

                                                                                    }





                                                                                    $.ajax({

                                                                                        type: "POST",

                                                                                        url: "<?php echo SITE_BASE_URL; ?>login/register.html",

                                                                                        data: {email: email, otp: 1},

                                                                                        async: false,

                                                                                    }).done(function (result) {

if (result==1 ) {



                                                                                        $("#step1").hide();

                                                                                        $("#step3").show();

                                                                                        $('.nav-tabs li').removeClass('active disabled')

                                                                                        $('a[data-id="step3"]').parent().addClass('active')

} else {

                                                                                       alert('Email address already exists.');

}

                                                                                    });

                                                                                }



                                                                                if (id == 2) {

                                                                                    $(".error").remove();



                                                                                    if (digit_1.length < 1) {

                                                                                        $("input[name='otp_verification']").focus();

                                                                                        $("input[name='otp_verification']").after('<span  class="error" style="color:red;">All field is required</span>');

                                                                                        return false;

                                                                                    }



                                                                                    if (digit_2.length < 1) {

                                                                                        $("input[name='otp_verification']").focus();

                                                                                        $("input[name='otp_verification']").after('<span  class="error" style="color:red;">All field is required</span>');

                                                                                        return false;

                                                                                    }



                                                                                    if (digit_3.length < 1) {

                                                                                        $("input[name='otp_verification']").focus();

                                                                                        $("input[name='otp_verification']").after('<span  class="error" style="color:red;">All field is required</span>');

                                                                                        return false;

                                                                                    }



                                                                                    if (digit_4.length < 1) {

                                                                                        $("input[name='otp_verification']").focus();

                                                                                        $("input[name='otp_verification']").after('<span  class="error" style="color:red;">All field is required</span>');

                                                                                        return false;

                                                                                    }



                                                                                    if (digit_5.length < 1) {

                                                                                        $("input[name='otp_verification']").focus();

                                                                                        $("input[name='otp_verification']").after('<span  class="error" style="color:red;">All field is required</span>');

                                                                                        return false;

                                                                                    }



                                                                                    if (digit_6.length < 1) {

                                                                                        $("input[name='otp_verification']").focus();

                                                                                        $("input[name='otp_verification']").after('<span  class="error" style="color:red;">All field is required</span>');

                                                                                        return false;

                                                                                    }



                                                                                    /*$.ajax({

                                                                                        type: "POST",

                                                                                        url: "<?php echo SITE_BASE_URL; ?>login/register.html",

                                                                                        data: {email: email, code: $("#digit_1").val() + $("#digit_2").val() + $("#digit_3").val() + $("#digit_4").val() + $("#digit_5").val() + $("#digit_6").val(), otp_check: 1},

                                                                                        async: false,

                                                                                    }).done(function (result) {

                                                                                        if (result == 1) {

                                                                                            $("#step2").hide();

                                                                                            $("#step3").show();

                                                                                            $('.nav-tabs li').removeClass('active disabled')

                                                                                            $('a[data-id="step3"]').parent().addClass('active')

                                                                                        } else {

                                                                                            alert('Invalid OTP');

                                                                                        }

                                                                                    });
                                                                                    */
                                                                                    
                                                                                    $("#step2").hide();

                                                                                    $("#step3").show();

                                                                                    $('.nav-tabs li').removeClass('active disabled')

                                                                                    $('a[data-id="step3"]').parent().addClass('active')


                                                                                }



                                                                                if (id == 3) {

                                                                                    $(".error").remove();



                                                                                    // if (subscription_plan == 0) {

                                                                                    //     $("input[name='subscription_plan_Error']").focus();

                                                                                    //     $("input[name='subscription_plan_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                    //     return false;

                                                                                    // }

                                                                                    // // var payment_option       = $("input[name='payment_option']:checked").val();



                                                                                    // if (payment_option == 0) {

                                                                                    //     $("input[name='payment_option_Error']").focus();

                                                                                    //     $("input[name='payment_option_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                    //     return false;

                                                                                    // }



                                                                                    if (payment_option_value == "card_payment") {

                                                                                        if (Card_Number.length < 1) {

                                                                                            $("input[name='Card_Number_Error']").focus();

                                                                                            $("input[name='Card_Number_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                            return false;

                                                                                        }



                                                                                        if (Cardholder_Name.length < 1) {

                                                                                            $("input[name='Cardholder_Name_Error']").focus();

                                                                                            $("input[name='Cardholder_Name_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                            return false;

                                                                                        }



                                                                                        if (CVV.length < 1) {

                                                                                            $("input[name='CVV_Error']").focus();

                                                                                            $("input[name='CVV_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                            return false;

                                                                                        }



                                                                                        if (month_list.length < 1) {

                                                                                            $("input[name='month_list_Error']").focus();

                                                                                            $("input[name='month_list_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                            return false;

                                                                                        }



                                                                                        if (year_list.length < 1) {

                                                                                            $("input[name='year_list_Error']").focus();

                                                                                            $("input[name='year_list_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                            return false;

                                                                                        }

                                                                                    }







                                                                                    $("#step3").hide();

                                                                                    $("#step4").show();

                                                                                    $('.nav-tabs li').removeClass('active disabled')

                                                                                    $('a[data-id="step4"]').parent().addClass('active')

                                                                                }



                                                                                if (id == 4) {

                                                                                    $(".error").remove();

/*

                                                                                    if (existing_gross.length < 1) {

                                                                                        $("input[name='existing_gross']").focus();

                                                                                        $("input[name='existing_gross']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                        return false;

                                                                                    }



                                                                                    if (mortage_balance.length < 1) {

                                                                                        $("input[name='mortage_balance']").focus();

                                                                                        $("input[name='mortage_balance']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                        return false;

                                                                                    }



                                                                                    if (loan_amount.length < 1) {

                                                                                        $("input[name='loan_amount']").focus();

                                                                                        $("input[name='loan_amount']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                        return false;

                                                                                    }*/

                                                                                    $("#step4").hide();

                                                                                    $("#step5").show();

                                                                                    $('.nav-tabs li').removeClass('active disabled')

                                                                                    $('a[data-id="step5"]').parent().addClass('active')

                                                                                }



                                                                                if (id == 5) {

                                                                                    $(".error").remove();



                                                                                    if (add_property == 0) {

                                                                                        $("input[name='add_property_Error']").focus();

                                                                                        $("input[name='add_property_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                        return false;

                                                                                    }



                                                                                    if (add_property_value == "yes") {

                                                                                        if (property_name.length < 1) {

                                                                                            $("input[name='property_name_Error']").focus();

                                                                                            $("input[name='property_name_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                            return false;

                                                                                        }



                                                                                        if (property_unit_name.length < 1) {

                                                                                            $("input[name='property_unit_name_Error']").focus();

                                                                                            $("input[name='property_unit_name_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                            return false;

                                                                                        }



                                                                                        if (property_suburb.length < 1) {

                                                                                            $("input[name='property_suburb_Error']").focus();

                                                                                            $("input[name='property_suburb_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                            return false;

                                                                                        }



                                                                                        if (property_city.length < 1) {

                                                                                            $("input[name='property_city_Error']").focus();

                                                                                            $("input[name='property_city_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                            return false;

                                                                                        }



                                                                                        if (property_country.length < 1) {

                                                                                            $("input[name='property_country_Error']").focus();

                                                                                            $("input[name='property_country_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                            return false;

                                                                                        }



                                                                                        if (property_postcode.length < 1) {

                                                                                            $("input[name='property_postcode_Error']").focus();

                                                                                            $("input[name='property_postcode_Error']").after('<span  class="error" style="color:red;">This field is required</span>');

                                                                                            return false;

                                                                                        }

                                                                                    }







                                                                                    document.register_form.submit();

                                                                                }



                                                                            }









                                                                            function back(id) {

                                                                                $('.nav-tabs li').removeClass('active disabled')

                                                                                if (id == 1) {

                                                                                    $("#step2").hide();
                                                                                    $("#step3").hide();

                                                                                    $("#step1").show();

                                                                                    $('a[data-id="step1"]').parent().addClass('active')

                                                                                }

                                                                                if (id == 2) {

                                                                                    $("#step3").hide();

                                                                                    $("#step2").show();

                                                                                    $('a[data-id="step2"]').parent().addClass('active')

                                                                                }

                                                                                if (id == 3) {

                                                                                    $("#step4").hide();

                                                                                    $("#step3").show();

                                                                                    $('a[data-id="step3"]').parent().addClass('active')

                                                                                }

                                                                                if (id == 4) {

                                                                                    $("#step5").hide();

                                                                                    $("#step4").show();

                                                                                    $('a[data-id="step4"]').parent().addClass('active')

                                                                                }

                                                                                if (id == 5) {

                                                                                    // $("#step6").hide();

                                                                                    $("#step5").show();

                                                                                    $('a[data-id="step5"]').parent().addClass('active')



                                                                                }

                                                                            }





                                                                            /*$(document).ready(function() {

                                                                             

                                                                             $('.paypal_payment').hide();

                                                                             $('.card_payment').hide();

                                                                             $('#card-accept').hide()

                                                                             $('.add-property-details').hide();

                                                                             

                                                                             

                                                                             

                                                                             'onTabClick': function(activeTab, navigation, currentIndex, nextIndex) {

                                                                             if (nextIndex <= currentIndex) {

                                                                             return;

                                                                             }

                                                                             var $valid = $("#registration").valid();

                                                                             if (!$valid) {

                                                                             $validator.focusInvalid();

                                                                             return false;

                                                                             }

                                                                             if (nextIndex > currentIndex+1){

                                                                             return false;

                                                                             }

                                                                             

                                                                             $('.payment-option input[type="radio"]').click(function(){

                                                                             var inputValue = $(this).attr("value");

                                                                             var targetBox = $("." + inputValue);

                                                                             $(".box").not(targetBox).hide();

                                                                             $(targetBox).show();

                                                                             });

                                                                             

                                                                             // $('#confirm').click(function(){

                                                                             //   if($('#card-info input').val() === 0){

                                                                             //     $('#card-info').fadeOut();

                                                                             //   $('#card-accept').fadeIn();

                                                                             //   }  

                                                                             // });

                                                                             

                                                                             

                                                                             $('#own_property_yes').click(function(){

                                                                             $('.add-property-details').show();

                                                                             })

                                                                             $('#own_property_no').click(function(){

                                                                             $('.add-property-details').hide();

                                                                             })

                                                                             

                                                                             

                                                                             }

                                                                             });*/





















                                                                            $(document).ready(function () {
                                                                                
                                                                                 $("#digit_1").bind("paste", function(e){
    var pastedData = e.originalEvent.clipboardData.getData('text');
    
    var digits = pastedData.toString().split('');
var realDigits = digits.map(Number);

jQuery.each( realDigits, function( i, val ) {
$('#digit_'+(i+1)).val(val)
});
   
} );

                                                                                jQuery('.mydatepicker, #datepicker').datepicker({

                                                                                      autoclose: true,
                                                        format: 'dd/mm/yyyy',
                                                        todayHighlight: true,
                                                        autoclose: true,


                                                                                });

                                                                                $(".date_picker").datepicker({

                                                                                    setDate: new Date(),

                                                                                    format: 'yyyy-mm-dd',

                                                                                    todayHighlight: true,

                                                                                    autoclose: true,

                                                                                });



                                                                                $('.paypal_payment').hide();

                                                                                $('.card_payment').hide();

                                                                                $('#card-accept').hide()

                                                                                $('.add-property-details').hide();



                                                                                $('.payment-option input[type="radio"]').click(function () {

                                                                                    var inputValue = $(this).attr("value");

                                                                                    var targetBox = $("." + inputValue);

                                                                                    $(".box").not(targetBox).hide();

                                                                                    $(targetBox).show();

                                                                                });



                                                                                $('#confirm').click(function () {

                                                                                    if ($('#card-info input').val() === 0) {

                                                                                        $('#card-info').fadeOut();

                                                                                        $('#card-accept').fadeIn();

                                                                                    }

                                                                                });





                                                                                $('#own_property_yes').click(function () {

                                                                                    $('.add-property-details').show();

                                                                                })

                                                                                $('#own_property_no').click(function () {

                                                                                    $('.add-property-details').hide();

                                                                                })



                                                                            });







                                                                            function addOption(selectbox, text, value) {

                                                                                var optn = document.createElement("option");

                                                                                optn.text = text;

                                                                                optn.value = value;

                                                                                selectbox.options.add(optn);

                                                                            }

                                                                            function addOption_list() {

                                                                                var d = new Date();

                                                                                var n = d.getFullYear();

                                                                                for (var i = 1; i <= 12; ++i) {

                                                                                    addOption(document.register_form.month_list, i, i);

                                                                                }

                                                                                for (var i = n; i < n + 100; ++i) {

                                                                                    addOption(document.register_form.year_list, i, i);

                                                                                }

                                                                            }





                                                                            // ------------step-wizard-------------

                                                                            $(document).ready(function () {

                                                                                // $('.nav-tabs > li a[title]').tooltip();

                                                                                //Wizard



                                                                                $('.error').hide();

                                                                                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

                                                                                    var target = $(e.target);

                                                                                    if (target.parent().hasClass('disabled')) {

                                                                                        return false;

                                                                                    }

                                                                                });

                                                                                $(".next-step").click(function (e) {

                                                                                    var active = $('.wizard .nav-tabs li.active');

                                                                                    active.next().removeClass('disabled');

                                                                                    nextTab(active);

                                                                                });

                                                                                $(".prev-step").click(function (e) {

                                                                                    var active = $('.wizard .nav-tabs li.active');

                                                                                    prevTab(active);

                                                                                });

                                                                            });



                                                                            function nextTab(elem) {

                                                                                $(elem).next().find('a[data-toggle="tab"]').click();



                                                                                // $("#step_1").html("100% Complete");

                                                                                // $("#step_2").html("100% Complete");

                                                                                // $("#step_3").html("100% Complete");

                                                                                // $("#step_4").html("100% Complete");

                                                                                // $("#step_5").html("100% Complete");

                                                                                // $("#step_6").html("100% Complete");



                                                                            }



                                                                            function prevTab(elem) {

                                                                                $(elem).prev().find('a[data-toggle="tab"]').click();

                                                                            }

                                                                            $('.nav-tabs').on('click', 'li', function () {

                                                                                $('.nav-tabs li.active').removeClass('active');

                                                                                $(this).addClass('active');



                                                                                if ($(".nav-tabs li:nth-child(1").hasClass("active")) {

                                                                                    $('#step-count').html('1');

                                                                                    $("#step_1").html("100% Complete");

                                                                                }



                                                                                if ($(".nav-tabs li:nth-child(2)").hasClass("active")) {

                                                                                    $('#step-count').html('2');

                                                                                    $("#step_2").html("100% Complete");

                                                                                }

                                                                                if ($(".nav-tabs li:nth-child(3)").hasClass("active")) {

                                                                                    $('#step-count').html('3');

                                                                                    $("#step_3").html("100% Complete");

                                                                                }

                                                                                if ($(".nav-tabs li:nth-child(4)").hasClass("active")) {

                                                                                    $('#step-count').html('4');

                                                                                    $("#step_4").html("100% Complete");

                                                                                }

                                                                                if ($(".nav-tabs li:nth-child(5)").hasClass("active")) {

                                                                                    $('#step-count').html('5');

                                                                                    $("#step_5").html("100% Complete");

                                                                                }

                                                                                if ($(".nav-tabs li:nth-child(6)").hasClass("active")) {

                                                                                    $('#step-count').html('6');

                                                                                    $("#step_6").html("100% Complete");

                                                                                }



                                                                            });



    </script>





</body>

</html>