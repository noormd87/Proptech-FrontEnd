<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Du Val Proptech</title>
      <meta content="" name="descriptison">
      <meta content="" name="keywords">
      <!-- Favicons -->
      <link href="<?php echo SITE_BASE_URL;?>assets/img/favicon.ico" rel="icon">
      <link href="<?php echo SITE_BASE_URL;?>assets/img/favicon.ico" rel="apple-touch-icon">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,200i,300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:200, 200i,300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/css/register.css">
      <!-- Vendor CSS Files -->
      <link href="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo SITE_BASE_URL;?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
      <link href="<?php echo SITE_BASE_URL;?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
      <!-- Template Main CSS File -->



      <!-- Template Main CSS File -->
	  <!-- icheck -->
	  <link href="<?php echo SITE_BASE_URL;?>assets/vendor/icheck/skins/all.css" rel="stylesheet">
	  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap-select-country/dist/css/bootstrap-select-country.min.css">
	  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/vendor/jquery-steps/jquery-steps.css">
	  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css">

	  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css">
	  <link rel="stylesheet" href="<?php echo SITE_BASE_URL;?>javascripts/country-picker-flags/build/css/countrySelect.css">


   </head>
   <body onload="addOption_list()">

   	<?php
    $Id=$_REQUEST["Id"];
    $rows = \login\loginClass::GetUserDatas($Id);
    //echo print_r($rows);
    //exit;
    if($Id!="" && $Id!=null)
    {
        foreach ($rows as $row) 
        {
            $id              = $row["id"];
            $user_id         = $row["user_id"];
            $user_name       = $row["user_name"];
            $first_name     = $row["first_name"];
	        $last_name      = $row["last_name"];
	        $phone_no       = $row["phone_no"];
	        $phone_no1      = $row["phone_no1"];
	        $subscription_id = $row["subscription_id"];
	        $currnt_points   = $row["currnt_points"];
	        $created_on     = $row["created_on"];
	        $address     = $row["address"];
	        $Acc_Auto_id    = $row["current_acc_auto_id"];
	        $IsAdmin     = $row["is_admin"];
	        $period_type    = $row["period_type"];
	        $plan_name      = $row["plan_name"];
	        $ProfilePic     = $row["image_file"];
	        $Dob         = $row["dob"];
	        $UpdateFlag      = "Y";
	        //echo "++++++>".$first_name;
	        //exit;
        }
    }
?>

      <div class="hero-wrapper">
      <div class="container container-expand">
         <nav class="navbar navbar-expand-lg login-nav">
            <a class="navbar-brand" href="<?php echo SITE_BASE_URL;?>"><img src="<?php echo SITE_BASE_URL;?>assets/img/logo.png" class="img-fluid" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item active"> <a class="nav-link" href="#">CONTACT US</a> </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#"> > BACK TO MAIN WEBSITE</a>
                     <div class="text-right">
                        <button type="button" class="currency-btn">USD</button>
                     </div>
                  </li>
               </ul>
            </div>
         </nav>
      </div>

      
      <div class="container">
         <section class="signup-step-container">
          <!-- <form role="form" action="" method ="post" id="registration" class="login-box" onsubmit="test(); return false;"> -->
          	<form class="login-form h-100 register-wizard" action="<?php echo SITE_BASE_URL;?>login/save.html" method="post" name="register_form" id="register_form" >
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
                              <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true">
                                 <div class="round-tab">
                                       <h2>1</h2>
                                       <span id="step_1">75% PROGRESS</span>
                                 </div>
                              </a>
                           </li>
                           <li role="presentation" class="disabled">
                              <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false">
                                 <div class="round-tab">
                                    <h2>2</h2>
                                    <span id="step_2">100% Completed</span>
                                 </div>
                              </a>
                           </li>
                           <li role="presentation" class="disabled">
                              <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab">
                                 <div class="round-tab">
                                    <span id="step_3">Completed</span>
                                    <h2>3</h2>
                                 </div>
                              </a>
                           </li>
                           <li role="presentation" class="disabled">
                              <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab">
                                 <div class="round-tab">
                                    <span id="step_4">Completed</span>
                                    <h2>4</h2>
                                 </div>
                              </a>
                           </li>
                           <li role="presentation" class="disabled">
                              <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab">
                                 <div class="round-tab">
                                    <span id="step_5">Completed</span>
                                    <h2>5</h2>
                                 </div>
                              </a>
                           </li>
                           <li role="presentation" class="disabled">
                              <a href="#step6" data-toggle="tab" aria-controls="step6" role="tab">
                                 <div class="round-tab">
                                    <span id="step_6">Completed</span>
                                    <h2>6</h2>
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
                                    <p>Fill in your Personal Details</p>
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
                                                 <input type="file" name="name-proof[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                                                 <label for="file-1"><img src="<?php echo SITE_BASE_URL;?>assets/img/download-icon.png" class="img-fluid" > <span>Upload Profile photo</span></label>
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
                                                <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo $first_name;?>">
								               <input type="hidden" class="form-control" name="ReferralCode" value=<?php echo $_REQUEST["ReferralCode"];?>>
								               <input type="hidden" class="form-control" name="id" value=<?php echo $id;?>>
								               <input type="hidden" class="form-control" name="UpdateFlag" value=<?php echo $UpdateFlag;?>>
                                             </div>

                                             <div class="form-group col-lg-6">
                                                <!-- <input class="form-control required" type="text" name="last_name" id="lastName" placeholder="Last Name"> 
                                                	<span class="error error-failed">*Required Information</span> -->
                                                <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo $last_name;?>">
                                                
                                             </div>

                                             <div class="form-group col-lg-6"  <?php if($Id!='' && $Id!=null) {?>style='display:none;'<?php }?>>
                                                <!-- <input class="form-control required" type="text" name="phone_number" id="phoneNumber" placeholder="Contact Number"> 
                                                	<span class="error error-failed">*Required Information</span> -->
                                                <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $user_id;?>">
                                             </div>

                                             <div class="form-group col-lg-6">
                                                <!-- <input class="form-control required" type="text" name="email" id="email" placeholder="Email"> 
                                                	<span class="error error-failed">*Required Information</span> -->
                                                <input type="text" class="form-control phone-selecter" name="mobile" placeholder="345374656" value="<?php echo $phone_no;?>">
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
                                    <p>Fill in your Personal Details</p>
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
                                          <input type="text" class="form-control" name="user_name" placeholder="Username" value='<?php echo $user_name;?>'>
                                       </div>
                                       <div class="col-lg-4 form-group">
                                          <label>Password</label>
                                          <!-- <input class="form-control" type="password" name="name" placeholder="Password"> -->
                                          <input type="password" class="form-control" name="password" placeholder="Password">
                                       </div>
                                       <div class="col-lg-4 form-group">
                                          <label>Confirm Password</label>
                                          <!-- <input class="form-control" type="password" name="confirm_password" placeholder="Password"> 
                                          	<span class="error error-failed"><i class="icofont-close"></i> Password did not match</span> -->
                                          <input type="password" class="form-control" name="Confirm_password" placeholder="Confirm Password">
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
                                    <p>Fill in your Personal Details</p>
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
                                          </select> -->
                                          	<input class="form-control" id="country_selector" type="text"  placeholder="Selected country" autocomplete="new-password">
               								<input type="hidden" class="form-control" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" autocomplete="new-password"/>
                                          	<!-- <i class="icofont-caret-down"></i> -->  
                                       </div>

                                       <div class="form-group col-lg-4">
                                          <!-- <select name="" class="form-control caret">
                                             <option value="">Select Counrty</option>
                                          </select>
                                          <i class="icofont-caret-down"></i> -->  
                                          <input type="text" class="form-control" name="City" placeholder="City">
                                       </div>

                                       <div class="form-group col-lg-4">
                                          <div class="input-group append-icon">
                                             <!-- <input type="text" class="form-control mydatepicker required" name="" placeholder="DD/MM/YY"> 
                                             	<span class="error error-failed">*Required Information</span> -->
                                             <input type="text" class="form-control date_picker" name="Dob" placeholder="Date of Birth"  value="<?php echo $Dob;?>"  placeholder="DD/MM/YY">
                                             <div class="input-group-append">
                                                <span class="input-group-text"><i class="icofont-calendar"></i></span>
                                             </div>
                                          </div>
                                          
                                       </div>

                                       <div class="form-group col-lg-4">
                                          <input type="text" class="form-control" name="Postal_Code" placeholder="Postal Code">  
                                       </div>

                                       <div class="form-group col-lg-4">
                                          <select name="PaymentType" class="form-control caret">
                                             	<option value="">Payment Type</option>
								                <option value="M">MONTHLY</option>
								                <option value="Y">YEARLY</option>
                                          </select>
                                          <i class="icofont-caret-down"></i>  
                                       </div>

                                       <div class="form-group col-lg-4">
                                          <label for="">Gender</label>
                                          <div class="d-flex justify-content-around flex-nowrap">
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
                                       </div>
                                       <div class="form-group col-lg-4">
                                          <!-- <select name="" class="form-control caret">
                                             <option value="">Select Counrty</option>
                                          </select>
                                          <i class="icofont-caret-down"></i>  --> 
                                          <input type="text" class="form-control" name="State" placeholder="State">
                                       </div>
                                       <div class="form-group col-lg-4">
                                          <!-- <select name="" class="form-control caret">
                                             <option value="">Select Counrty</option>
                                          </select>
                                          <i class="icofont-caret-down"></i> -->  
                                          <input type="text" class="form-control" name="Address1" placeholder="Address">
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
                                    <p>Fill in your Personal Details</p>
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
                                                
                                                <label class="form-check-label" for=""><a class="fs-10 link-primary" target="_blank" href="terms.html">Read Terms & Condition</a></label>
                                                
                                             </div>
                                          </div>
                                       </div>
                                             <!-- <span class="error error-failed">*Required Information</span> -->
                                                
                                       <div class="col-lg-4">
                                          <div class="step-nav">
                                             <ul class="list-inline">
                                                <li>
                                                   <!-- <button type="button" class="button-warning next-step">Save and Next</button> -->
                                                   <!-- <button class="btn btn-primary px-5 next-step" onlick='javascript:return false;'>NEXT <i class="icofont-simple-right"></i></button> -->
                                                   <a href="javascript:void(0)" onclick="next('1')"> Next</a>
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
                                    <h4 class="fs-18 fw-3">Now that you have completed the mandatory fields required on the Account Profile page, check your email for a verification code (don’t forget to check the junk folder!)</h4>
                                    <div class="verifiation-box mt-5">
                                       <h6 class="fs-14 fw-3 mb-4">Enter your verification code here</h6>
                                       <div class="digit-group">
                                          <input type="text" id="digit_1" name="digit_1" data-next="digit_2" />
                                          <input type="text" id="digit_1" name="digit_1" data-next="digit_3" data-previous="digit_1" />
                                          <input type="text" id="digit_1" name="digit_1" data-next="digit_4" data-previous="digit_1" />
                                          <input type="text" id="digit_1" name="digit_1" data-next="digit_5" data-previous="digit_1" />
                                          <input type="text" id="digit_1" name="digit_1" data-next="digit_6" data-previous="digit_1" />
                                          <input type="text" id="digit_1" name="digit_1" data-previous="digit_1" />
                                       </div><br>
                                    </div>
                                    <span class="error error-failed">*Required Information</span>
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
                              <div class="right-bar">
                                 <div class="form-box-transparent">
                                    <div class="row mt-4">
                                       <div class="col-lg-8">
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="step-nav">
                                             <ul class="list-inline pull-right">
                                                <li>
                                                   <!-- <button type="button" class="button-warning prev-step">Back</button> -->
                                                   <a href="javascript:void(0)"  onclick="back('1')"> Back</a>
                                                </li>
                                                <li>
                                                   <!-- <button type="button" class="button-warning next-step" id="verfication-btn">Continue</button> -->
                                                   <a href="javascript:void(0)" onclick="next('2')"> Next</a>
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
                                    <div class="row mb-4">
                                       <div class="col-lg-4">
                                          <h4 class="form-caption">1. What plan?</h4>
                                          <div class="card pricing-card basic-plan h-100">
                                             <div class="card-header">
                                                <h4 class="card-title">BASIC PLAN</h4>
                                             </div>
                                             <div class="card-body">
                                                <div class="plan-sm">
                                                   <div class="row no-gutters">
                                                      <div class="col-10">
                                                         <h2><sup>US</sup> $39</h2>
                                                      </div>
                                                      <div class="col-2 align-self-center">
                                                         <input type="radio" name="subscription_plan" id="monthBasicPlan">
                                                      </div>
                                                   </div>
                                                   <p>Per Month Paid <span class="">MONTHLY</span></p>
                                                </div>
                                                <div class="plan-sm">
                                                   <div class="row no-gutters">
                                                      <div class="col-10">
                                                         <h2><sup>US</sup> $39</h2>
                                                      </div>
                                                      <div class="col-2 align-self-center">
                                                         <input type="radio" name="subscription_plan" id="annualBasicPlan">
                                                      </div>
                                                   </div>
                                                   <p>Per Month Paid <span class="link-warning">ANNUALLY</span></p>
                                                </div>
                                                <div class="plan-list">
                                                   <ul>
                                                      <li>Select your plan, payment frequency.</li>
                                                      <li>Select your plan, payment frequency.</li>
                                                      <li>Select your plan, payment frequency.</li>
                                                      <li>Select your plan, payment frequency.</li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                          <!-- end card-->
                                       </div>
                                       <div class="col-lg-4">
                                          <h4 class="form-caption">&nbsp;</h4>
                                          <div class="card pricing-card premium-plan h-100">
                                             <div class="card-header">
                                                <h4 class="card-title">PREMIUM PLAN (BEST VALUE)</h4>
                                             </div>
                                             <div class="card-body">
                                                <div class="plan-sm">
                                                   <div class="row no-gutters">
                                                      <div class="col-10">
                                                         <h2><sup>US</sup> $39</h2>
                                                      </div>
                                                      <div class="col-2 align-self-center">
                                                         <input type="radio" name="subscription_plan" id="monthPremiumPlan">
                                                      </div>
                                                   </div>
                                                   <p>Per Month Paid <span class="">MONTHLY</span></p>
                                                </div>
                                                <div class="plan-sm">
                                                   <div class="row no-gutters">
                                                      <div class="col-10">
                                                         <h2><sup>US</sup> $588</h2>
                                                      </div>
                                                      <div class="col-2 align-self-center">
                                                         <input type="radio" name="subscription_plan" id="annualPremiumPlan">
                                                      </div>
                                                   </div>
                                                   <p>Per Month Paid <span class="link-warning">ANNUALLY</span></p>
                                                </div>
                                                <div class="plan-list">
                                                   <ul>
                                                      <li>Select your plan, payment frequency.</li>
                                                      <li>Select your plan, payment frequency.</li>
                                                      <li>Select your plan, payment frequency.</li>
                                                      <li>Select your plan, payment frequency.</li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                          <!-- end card-->
                                       </div>
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
                        <div class="row no-gutters">
                           <div class="col-lg-3">
                              <div class="sidebar-col">
                                 <div class="instruction-box">
                                    <p>If you are using your pay pal account, once you have click on this option, it will take you to the pay pal screen and process</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-9">
                              <div class="right-bar">
                                 <div class="form-box-transparent mt-3">
                                    <h4 class="form-caption">3. Select your payment option</h4>
                                    <div class="row">
                                       <div class="col-lg-4 form-group">
                                          <div class="payment-option h-100">
                                             <div class="row no-gutters">
                                                <div class="col-2 align-self-center">
                                                   <input type="radio" name="payment_option" id="" value="card_payment"> 
                                                </div>
                                                <div class="col-10">
                                                   <h4 class="text-right"><img src="<?php echo SITE_BASE_URL;?>assets/img/credit-card-sm.png" class="img-fluid" width="75px;"> Credit Card</h4>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-4 form-group">
                                          <div class="payment-option h-100">
                                             <div class="row no-gutters">
                                                <div class="col-2 align-self-center">
                                                   <input type="radio" name="payment_option" id="" value="paypal_payment">
                                                </div>
                                                <div class="col-10">
                                                   <h4><img src="<?php echo SITE_BASE_URL;?>assets/img/paypal-icon.png" class="img-fluid"></h4>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end row-->
                        <hr class="step-seprator">
                        <div class="row no-gutters card_payment box" id="">
                           <div class="col-lg-3">
                              <div class="sidebar-col">
                                 <div class="instruction-box">
                                    <p>Once you have confirmed your credit card details and payment has been confirmed, a receipt will be sent to your email</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-9">
                              <div class="right-bar">
                                 <div class="form-box-transparent" id="card-info">
                                    <h4 class="form-caption">4. Credit Card Payment</h4>
                                    <div class="row">
                                       <div class="form-group col-lg-4">
                                          <label for="">Credit Card Number</label>
                                          <input class="form-control" type="text" name="Card_Number"  placeholder="1234 1234 1245 1244">
                                       </div>
                                       <div class="form-group col-lg-4">
                                          <label for="">Expiry</label>
                                          <div class="row">
                                             <div class="col">
                                                <select name="month_list" class="form-control caret">
                                                   <option value="">Month</option>
                         							option
                                                </select>
                                                <i class="icofont-caret-down"></i>
                                             </div>
                                             <div class="col">
                                                <select name="year_list" class="form-control caret">
                                                   <option value="">Year</option>
                         							option
                                                </select>
                                                <i class="icofont-caret-down"></i>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-4"></div>
                                       <div class="form-group col-lg-4">
                                          <label for="">Name on Credit Card</label>
                                          <input class="form-control" type="text" name="Cardholder_Name" placeholder="Name on Credit Card">
                                          <span class="error error-failed">* Need the information</span>
                                       </div>
                                       <div class="form-group col-lg-2">
                                          <label for="">CVV <sup><a href="#">What is cvv?</a></sup></label>
                                          <input class="form-control" type="text" name="CVV" placeholder="CVV" max="3">
                                       </div>
                                       <div class="col-lg-3 offset-lg-3">
                                          <button class="button-info btn-block mt-4" id="confirm">CONFIRM</button>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="form-box-transparent" id="card-accept">
                                    <h4 class="fs-18 fw-3">Card has been accepted???</h4>
                                    <div class="verifiation-box mt-4">
                                       <h6 class="fs-14 fw-3 mb-4">Thanks for adding your card. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores</h6>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
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
                                       <!-- <button class="button-info">Pay with PayPal</button> -->
                                       <input type="button" value="Pay with PayPal" class="button-info" />
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
                                                   <!-- <button type="button" class="button-warning prev-step">Back</button> -->
                                                   <a href="javascript:void(0)" back="next('2')"> Next</a>
                                                </li>
                                                <li>
                                                   <!-- <button type="button" class="button-warning next-step">Continue</button> -->
                                                   <a href="javascript:void(0)" onclick="next('3')"> Next</a>
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
                                          <label>Existing Gross income(Excluding this property)($NZD)</label>
                                          <input type="text" id="existing_gross" name="existing_gross" class="form-control  required" placeholder="Existing Gross income(Excluding this property)($NZD)">
                                          <span class="error error-failed">*Required Information</span>
                                       </div>
                                       <div class="col-lg-5 offset-lg-1 form-group">
                                          <label>Mortgage Balance ($NZD)</label>
                                          <input type="text" id="mortage_balance" name="mortage_balance" class="form-control  required" placeholder="">
                                          <span class="error error-failed">*Required Information</span>
                                       </div>
                                       <div class="col-lg-5 form-group" id="loanAmountDiv">
                                          <label>Loan Amount ($)</label>
                                          <input type="text" class="form-control  required" placeholder="" name="loan_amount" id="loan_amount">
                                          <span class="error error-failed">*Required Information</span>
                                       </div>
                                       <div class="col-lg-1 form-group align-self-end ">
                                          <a class="add-more"  id="addMore"><i class="icofont-plus-circle"></i></a>
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
                                                   <button type="button" class="button-warning prev-step"><i class="icofont-simple-left"></i> Back</button>
                                                </li>
                                                <li>
                                                   <button type="button" class="button-warning next-step">Save & Next <i class="icofont-simple-right"></i></button>
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
                                          <img src="<?php echo SITE_BASE_URL;?>assets/img/ebook-download.png" class="img-fluid">
                                          <div class="form-check text-center mt-3">
                                             <input type="radio" class="form-check-input" id="own_property_yes" name="add_property">
                                             <label class="form-check-label" for="">YES</label>
                                          </div>
                                       </div>
                                       <div class="property-box">
                                          <img src="<?php echo SITE_BASE_URL;?>assets/img/ebook-download.png" class="img-fluid">
                                          <div class="form-check text-center mt-3">
                                             <input type="radio" class="form-check-input" id="own_property_no" name="add_property">
                                             <label class="form-check-label" for="">NO</label>
                                          </div>
                                       </div>
                                    </div>
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
                                    <p>Fill in your Personal Details</p>
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
                                                 <label for="file-1"><img src="<?php echo SITE_BASE_URL;?>assets/img/download-icon.png" class="img-fluid" > <span>Upload property photo</span></label>
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
                                                <span class="error error-failed">*Required Information</span>
                                             </div>
                                             <div class="form-group col-lg-6">
                                                <input class="form-control required" type="text" name="unit_name" placeholder="Unit Name">
                                                <span class="error error-failed">*Required Information</span>
                                             </div>
                                             <div class="form-group col-lg-6">
                                                <input class="form-control" type="text" name="name" placeholder="Suburb">
                                             </div>
                                             <div class="form-group col-lg-6">
                                                <input class="form-control" type="text" name="name" placeholder="City">
                                             </div>
                                             <div class="form-group col-lg-6">
                                                <input class="form-control" type="text" name="name" placeholder="Country">
                                             </div>
                                             <div class="form-group col-lg-6">
                                                <input class="form-control" type="text" name="name" placeholder="Post Code">
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
                                    <p>Fill in your Personal Details</p>
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
                                             
                                             <input type="text" class="form-control" aria-label="button" placeholder="Current Value">
                                             <div class="input-group-append">
                                                <select name="" class="form-control caret">
                                                   <option>FT</option>
                                                </select>
                                                <i class="icofont-caret-down"></i>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group col-lg-4">
                                          <div class="input-group append-icon">
                                             <input type="text" class="form-control mydatepicker" name="" placeholder="Date Purchased">
                                             <div class="input-group-append">
                                                <span class="input-group-text"><i class="icofont-calendar"></i></span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group col-lg-4">
                                          <div class="input-group append-icon">
                                             <input type="text" class="form-control mydatepicker" name="" placeholder="Date Purchased">
                                             <div class="input-group-append">
                                                <span class="input-group-text"><i class="icofont-calendar"></i></span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group col-lg-4">
                                          <div class="input-group append-icon">
                                             <input type="text" class="form-control mydatepicker" name="" placeholder="Date of Completion">
                                             <div class="input-group-append">
                                                <span class="input-group-text"><i class="icofont-calendar"></i></span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-4 form-group">
                                          <div class="input-group select-filter">
                                             <div class="input-group-prepend">
                                                <select name="country2" class="form-control caret">
                                                   <option>NZD</option>
                                                </select>
                                                <i class="icofont-caret-down"></i>
                                             </div>
                                             <input type="text" class="form-control" aria-label="button" placeholder="Current Value">
                                          </div>
                                       </div>
                                       <div class="col-lg-4 form-group">
                                          <div class="input-group select-filter">
                                             <div class="input-group-prepend">
                                                <select name="country2" class="form-control caret">
                                                   <option>NZD</option>
                                                </select>
                                                <i class="icofont-caret-down"></i>
                                             </div>
                                             <input type="text" class="form-control required" aria-label="button" placeholder="Purchase Price" name="purchase_price">
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
                                    <p>Fill in your Personal Details</p>
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
                                             <input type="text" class="form-control required" aria-label="button" placeholder="Annual Rental" name="annual_rental">
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
                                    <p>Fill in your Personal Details</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-9">
                              <div class="right-bar">
                                 <div class="form-box">
                                    <h4 class="form-caption">5. Expenses</h4>
                                    <div class="row">
                                       <div class="form-group col-lg-4">
                                          <input class="form-control required" type="text" name="rate_value" placeholder="Rates $ value">
                                          <span class="error error-failed">*Required Information</span>
                                       </div>
                                       <div class="form-group col-lg-4">
                                          <input class="form-control required" type="text" name="ground_rent" placeholder="Ground Rent">
                                          <span class="error error-failed">*Required Information</span>
                                       </div>
                                       <div class="form-group col-lg-2 pr-1">
                                          <input class="form-control" type="text" name="name" placeholder="Management Fee’s %">
                                       </div>
                                       <div class="form-group col-lg-2 pl-1">
                                          <input class="form-control" type="text" name="name" placeholder="Management Fee’s $">
                                       </div>
                                       <div class="form-group col-lg-4">
                                          <input class="form-control" type="text" name="name" placeholder="Adminstration fee Year $">
                                       </div>
                                       <div class="form-group col-lg-4">
                                          <input class="form-control" type="text" name="name" placeholder="Property Maintenance">
                                       </div>
                                       <div class="form-group col-lg-4">
                                          <input class="form-control" type="text" name="name" placeholder="Other Costs">
                                       </div>
                                       <div class="form-group col-lg-4">
                                          <input class="form-control" type="text" name="name" placeholder="Body Corporate fee $ Value">
                                       </div>
                                       <div class="form-group col-lg-4 offset-lg-4">
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text">Total Expense $</span>
                                             </div>
                                             <input class="form-control" type="text" name="name" value="$5,666.00">
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
                                          <input class="form-control required" type="text" name="capital_growth" placeholder="5-10 Yr Capital Growth">
                                          <span class="error error-failed">*Required Information</span>
                                       </div>
                                       <div class="form-group col-lg-4">
                                          <input class="form-control" type="text" name="name" placeholder="Yearly rental growth">
                                       </div>
                                       <div class="form-group col-lg-4">
                                          <input class="form-control" type="text" name="name" placeholder="Rates $ value">
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
                                                <a href="javascript:void(0)" onclick="back('5')">Back</a>
                                                   <!-- <button type="button" class="button-warning prev-step"><i class="icofont-simple-left"></i> Back</button> -->
                                                </li>
                                                <li>
                                                   <a href="javascript:void(0)" onclick="next('6')">Save & Next</a>
                                                   <button type="button" class="button-warning next-step">Save & Next <i class="icofont-simple-right"></i></button>
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
                                        <h2 class="fs-36 fw-3 mt-5 mb-0 text-center">You’re now ready to begin your free 7 day trial!</h2>
                                        <p class="fs-14 fw-3 mt-5 b-0 text-center">Haven’t received an email? Check your junk mail folder or feel free to contact us.</p>
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
      <script src="<?php echo SITE_BASE_URL;?>assets/vendor/jquery/jquery.min.js"></script>
      <script src="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?php echo SITE_BASE_URL;?>assets/vendor/aos/aos.js"></script>

      <!-- icheck -->
  		<!-- <script src="<?php echo SITE_BASE_URL;?>assets/plugins/icheck/icheck.min.js"></script> -->

      <!-- Date Picker Plugin JavaScript -->
      <script src="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

      <script src="<?php echo SITE_BASE_URL;?>assets/vendor/jquery-steps/jquery-steps.min.js"></script>

  		<!-- <script src="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script> -->

      <script src="https://cdn.jsdelivr.net/bootstrap.wizard/1.3.2/jquery.bootstrap.wizard.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js" ></script>
      <script src="<?php echo SITE_BASE_URL;?>assets/vendor/customfileinputs/jquery.custom-file-input.js"></script>





      <script>


      
var form = $("#register_form").show();
 
form.steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    titleTemplate: "#title#" ,
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

//   // Date Picker
//   jQuery('.mydatepicker, #datepicker').datepicker();

// });


var input = document.querySelector(".phone-selecter");
  window.intlTelInput(input, {
  // any initialisation options go here
  initialCountry:"nz",
  nationalMode:true,
  placeholderNumberType:"MOBILE",
  separateDialCode:false,
  });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="<?php echo SITE_BASE_URL;?>javascripts/country-picker-flags/build/js/countrySelect.js"></script>
	<script>
		$("#country_selector").countrySelect({
			preferredCountries: [ 'nz','in', 'us']
		});
	</script>
</body>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.15.5/apexcharts.min.js"></script>
<!-- <script src="<?php echo SITE_BASE_URL; ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
<script>


function next(id){
   if(id ==1){
      $("#step1").hide();
      $("#step2").show();
   }
   if(id ==2){
      $("#step2").hide();
      $("#step3").show();
   }

}
function back(id){
   if(id == 1){
      $("#step2").hide();   
      $("#step1").show();
   }
   if(id == 2){
      $("#step2").hode();
      $("#step2").show();   
   }
}

$(document).ready(function(){
 
 // $(".date_picker").datepicker({
   
 //      setDate: new Date(),
 //      format: 'yyyy-mm-dd',
 //      todayHighlight: true,
 //      autoclose: true,
   
 //   });
//   $("#Next").click(function(){
    
// 	$("#Acc").show();
//     $("#Pers").hide();
	
//   });
//   $("#Back").click(function(){
// 	 $("#Acc").hide();
// 	 $("#Pers").show();
//   });

       $('#register_form').on('submit', function(e){
            e.preventDefault();
            var first_name = $( "input[name='first_name']" ).val();
	        var last_name = $( "input[name='last_name']" ).val();
	        var email = $( "input[name='email']" ).val();
	        var password = $( "input[name='password']" ).val();
	        var Confirm_password = $( "input[name='Confirm_password']" ).val();
	        var user_name = $( "input[name='user_name']" ).val();
	        var tANDc = $( "input[name='tANDc']" ).prop("checked");

	    	var Cardholder_Name = $("input[name='Cardholder_Name']").val();
	        var Card_Number		= $("input[name='Card_Number']").val();
	        var CVV				= $("input[name='CVV']").val();
	        var month_list		= $("select[name='month_list']").val();
	        var PaymentType		= $("select[name='PaymentType']").val();
	        var Dob       		= $("input[name='Dob']").val();
	        var mobile  		= $("input[name='mobile']").val();
	        // var Phone  		    = $("input[name='Phone']").val();
	        var year_list		= $("select[name='year_list']").val();
	        var country			= $("input[name='country_selector_code']").val();
	        var Address1		= $("input[name='Address1']").val();
	        var City			= $("input[name='City']").val();
	        var Postal_Code		= $("input[name='Postal_Code']").val();
	        var State			= $("input[name='State']").val();
	        var Email_for_Inv	= $("input[name='Email_Address_for_Invoice']").val();
	        var gender      	= $("input[name='gender']:checked").val();

	        var digit_1 = $("input[name='digit_1']").val();
	        var subscription_plan      	= $("input[name='subscription_plan']:checked").val();
	        var payment_option      	= $("input[name='payment_option']:checked").val();


        
        //alert(gender);
        $(".error").remove();
     
        if (first_name.length < 1) {
          $("input[name='first_name']").focus();
    	  $("input[name='first_name']").after('<span  class="error" style="color:red;">This field is required</span>');
    	  alert("First Name required");
          return false;
        }
    	if (last_name.length < 1) {
    	  $("input[name='last_name']").focus();
          $("input[name='last_name']").after('<span  class="error" style="color:red;">This field is required</span>');
          alert("Last Name required");
    	  return false;
        }
        if (email.length < 1) {
          $("input[name='email']").focus();
          $("input[name='email']").after('<span  class="error" style="color:red;">This field is required</span>');
          alert("Email required");
    	  return false;
        } else {
          //var regEx = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          //var validEmail = regEx.test(email);
          //if (!validEmail) {
          //$("input[name='email']").focus();
          //$("input[name='email']").after('<span  class="error" style="color:red;">Enter a valid email</span>');
    		//return false;
          //}
        }
        if (mobile.length < 1) {
    	  $("input[name='mobile']").after('<span  class="error" style="color:red;">This field is required</span>');
    	  $("input[name='mobile']").focus();
    	  alert("mobile no required");
          return false;
        }
    //     if (Phone.length < 1) {
    // 	  $("input[name='Phone']").focus();
    //       $("input[name='Phone']").after('<span  class="error" style="color:red;">This field is required</span>');
    // 	  return false;
    //     }
        if (Dob.length < 1) {
    	  $("input[name='Dob']").focus();
          $("input[name='Dob']").after('<span  class="error" style="color:red;">This field is required</span>');
    	  alert("DOB required");
    	  return false;
        }
        if($('input[type=radio][name=gender]:checked').length == 0)
        {
              $("input[name='gender']").after('<span  class="error" style="color:red;">This field is required</span>');
        	  $("input[name='gender']").focus();
    	      alert("Gender no required");
              return false;
        }
        if (country.length < 1) {
		  $("input[name='country_selector_code']").after('<span  class="error" style="color:red;">This field is required</span>');
    	  alert("Country required");
		  return false;
		}
// 		if (City.length < 1) {
// 		  $("input[name='City']").focus();
//           $("input[name='City']").after('<span  class="error" style="color:red;">This field is required</span>');
// 		  return false;
// 		}
// 		if (Postal_Code.length < 1) {
// 		  $("input[name='Postal_Code']").focus();
//           $("input[name='Postal_Code']").after('<span  class="error" style="color:red;">This field is required</span>');
// 		  return false;
// 		}
		
		if (PaymentType.length < 1) {
		  $("input[name='PaymentType']").focus();
          $("select[name='PaymentType']").after('<span  class="error" style="color:red;">This field is required</span>');
    	  alert("Payment Type required");
		  return false;
		}
// 		if (State.length < 1) {
// 		  $("input[name='State']").focus();
//           $("input[name='State']").after('<span  class="error" style="color:red;">This field is required</span>');
// 		  return false;
// 		}
// 		if (Address1.length < 1) {
// 		  $("input[name='Address1']").focus();
//           $("input[name='Address1']").after('<span  class="error" style="color:red;">This field is required</span>');
// 		  return false;
// 		}
		if (user_name.length < 1) {
		  $("input[name='user_name']").focus();
          $("input[name='user_name']").after('<span  class="error" style="color:red;">This field is required</span>');
          alert("User name required");
		  return false;
		}
		if('<?php echo $Id;?>'=='' || '<?php echo $Id;?>'==null)
		{
    		if (password.length < 8) {
              $("input[name='password']").focus();
              $("input[name='password']").after('<span  class="error" style="color:red;">Password must be at least 8 characters long</span>');
              alert("Password must be at least 8 characters long");
        	  return false;
            }
            if (Confirm_password.length < 8) {
              $("input[name='Confirm_password']").focus();
              $("input[name='Confirm_password']").after('<span  class="error" style="color:red;">Confirm password must be at least 8 characters long</span>');
              alert("Confirm password must be at least 8 characters long");
        	  return false;
            }
        	if (password!=Confirm_password)
        	{
        		$("input[name='Confirm_password']").after('<span  class="error" style="color:red;">Password not matching</span>');
        		alert("Password not matching");
        		return false;
        	}
        	if (!tANDc)
        	{
        		alert("check T&C.");
        		$("input[name='tANDc']").focus();
                return false;
        	}
            
		}
    	/*if (Cardholder_Name.length < 1) {
    	  $(".Section1").hide();
    	  $(".Section2").show();
		  $("input[name='Cardholder_Name']").focus();
          $("input[name='Cardholder_Name']").after('<span  class="error" style="color:red;">This field is required</span>');
          alert("Cardholder Name required");
		  return false;
		}
		if (Card_Number.length < 1) {
		  $("input[name='Card_Number']").focus();
          $("input[name='Card_Number']").after('<span  class="error" style="color:red;">This field is required</span>');
          alert("Card Number required");
		  return false;
		}
		if (month_list.length < 1) {
		  $("input[name='month_list']").focus();
          $("select[name='month_list']").after('<span  class="error" style="color:red;">This field is required</span>');
          alert("Expiry required");
		  return false;
		}
		if (year_list.length < 1) {
		  $("input[name='year_list']").focus();
          $("select[name='year_list']").after('<span  class="error" style="color:red;">This field is required</span>');
          alert("Expiry required");
		  return false;
		}
		if (CVV.length < 1) {
		  $("input[name='CVV']").focus();
          $("input[name='CVV']").after('<span  class="error" style="color:red;">This field is required</span>');
          alert("CVV required");
		  return false;
		}
		if (Email_for_Inv!="")
		{
            var regEx = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			 var validEmail = regEx.test(Email_for_Inv);
			if (!validEmail) {
					$("input[name='Email_Address_for_Invoice']").after('<span  class="error" style="color:red;">Enter a valid email</span>');
					alert("Enter a valid email");
					return false;
			}
		}
		else
	   {
		  $("input[name='Email_Address_for_Invoice']").focus();
          $("input[name='Email_Address_for_Invoice']").after('<span  class="error" style="color:red;">This field is required</span>');
          alert("Email Address for Invoice required");
		  return false;
	   }
	   */
		
		document.register_form.submit();
    });

  
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
    for (var i=1; i <= 12;++i) {
        addOption(document.register_form.month_list,i,i);
    }
    for (var i=n; i < n+100;++i) {
        addOption(document.register_form.year_list,i,i);
    }
}


// ------------step-wizard-------------
         $(document).ready(function() {
           $('.nav-tabs > li a[title]').tooltip();
           //Wizard

           $('.error').hide();
           $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
              var target = $(e.target);
              if(target.parent().hasClass('disabled')) {
                return false;
              }
            });
            $(".next-step").click(function(e) {
              var active = $('.wizard .nav-tabs li.active');
              active.next().removeClass('disabled');
              nextTab(active);
            });
            $(".prev-step").click(function(e) {
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
         $('.nav-tabs').on('click', 'li', function() {
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