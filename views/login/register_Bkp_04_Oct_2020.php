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

  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/css/login.css">

  <!-- Vendor CSS Files -->
  <link href="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo SITE_BASE_URL;?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo SITE_BASE_URL;?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">


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
            $first_name		 = $row["first_name"];
        	$last_name		 = $row["last_name"];
        	$phone_no		 = $row["phone_no"];
        	$phone_no1		 = $row["phone_no1"];
        	$subscription_id = $row["subscription_id"];
        	$currnt_points   = $row["currnt_points"];
        	$created_on 	 = $row["created_on"];
        	$address		 = $row["address"];
        	$Acc_Auto_id	 = $row["current_acc_auto_id"];
        	$IsAdmin		 = $row["is_admin"];
        	$period_type	 = $row["period_type"];
        	$plan_name		 = $row["plan_name"];
        	$ProfilePic		 = $row["image_file"];
        	$Dob    		 = $row["dob"];
        	$UpdateFlag      = "Y";
        	//echo "++++++>".$first_name;
        	//exit;
        }
    }
?>
<div class="main-wrapper">
  <header id="header" class="bg-dark py-3 px-5">
    <div  class="text-white"><img src="<?php echo SITE_BASE_URL;?>assets/img/logo.png" alt="Du Val Proptech"></div>
  </header><!-- /header -->
    <div class="container h-100">
      <div class="mt-5 h-100">
        <form class="login-form h-100 register-wizard" action="<?php echo SITE_BASE_URL;?>login/save.html" method="post" name="register_form" id="register_form" >
        <h3>Enter your Details</h3>
        <section id="form-inner" class="Section1">
           <h2>Welcome to the first step of the PropTech sign up process!</h2>
           <p>To start, simply enter a few quick details about yourself.</p>

           <hr class="seprator">

           <div class="row">
             <div class="col-md-3 form-group align-self-top">
               <img src="<?php echo SITE_BASE_URL;?>assets/img/users/" class="img-fluid" alt="">
             </div>
             <div class="col-md-3 form-group align-self-end">
               <label>First Name*</label>
               <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo $first_name;?>">
               <input type="hidden" class="form-control" name="ReferralCode" value=<?php echo $_REQUEST["ReferralCode"];?>>
               <input type="hidden" class="form-control" name="id" value=<?php echo $id;?>>
               <input type="hidden" class="form-control" name="UpdateFlag" value=<?php echo $UpdateFlag;?>>
             </div>
             <div class="col-md-3 form-group align-self-end">
               <label>Last Name*</label>
               <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo $last_name;?>">
             </div>
             <div class="col-md-3 form-group align-self-end" <?php if($Id!='' && $Id!=null) {?>style='display:none;'<?php }?>><!--Ghouse/26-08-2020-->
               <label>Email*</label>
               <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $user_id;?>">
             </div>
           </div>

           <div class="row pt-5">
             <div class="col-md-3 form-group align-self-end">
               <label>Mobile Number*</label>
               <input type="text" class="form-control phone-selecter" name="mobile" placeholder="345374656" value="<?php echo $phone_no;?>">
             </div>

             <div class="col-md-3 form-group align-self-end">
               <label>Phone Number</label>
               <input type="text" class="form-control" name="Phone" placeholder="12345678" value="<?php echo $phone_no1;?>">
             </div>
             <div class="col-md-3 form-group align-self-end">
               <label>Date of birth*</label>
               <div class="input-group">
               
               <span class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icofont-calendar"></i>
                    </span>
                </span>
               <input type="text" class="form-control date_picker" name="Dob" placeholder="Date of Birth"  value="<?php echo $Dob;?>" autocomplete="new-password">
                
                </div>
             </div>  
             <div class="col-md-3 form-group align-self-end">
               <label>Gender*</label>
               <div>
                 <input type="radio" class="icheck" name="gender" value='F'> <span class="pr-5 text-sm pl-2"> Female</span>

                 <input type="radio" class="icheck" name="gender" value='M'> <span class="text-sm pl-2">Male</span>
               </div>
               
             </div>  
           </div>
              

           <div class="row py-5">
             <div class="col-md-3 form-group align-self-end">
               <label>Country*</label>
               <input class="form-control" id="country_selector" type="text"  placeholder="Selected country" autocomplete="new-password">
               <input type="hidden" class="form-control" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" autocomplete="new-password"/>
             </div>
             <div class="col-md-3 form-group align-self-end">
               <label>City</label>
               <input type="text" class="form-control" name="City" placeholder="City">
             </div>
             <div class="col-md-3 form-group align-self-end">
               <label>Post Code</label>
               <input type="text" class="form-control" name="Postal_Code" placeholder="12345">
             </div>
             <div class="col-md-3 form-group align-self-end">
               <label>Payment Type*</label>
               <select name="PaymentType" class="form-control">
			      <option value="">Payment Type</option>
			      <option value="M">MONTHLY</option>
			      <option value="Y">YEARLY</option>
			 </select>
             </div>
           </div>
           
            <div class="row py-5">
             <div class="col-md-3 form-group align-self-end">
               <label>State</label>
               <input type="text" class="form-control" name="State" placeholder="State">
             </div>
             <div class="col-md-3 form-group align-self-end">
               <label>Address1</label>
               <input type="text" class="form-control" name="Address1" placeholder="Address1">
             </div>
             <div class="col-md-3 form-group align-self-end">
               <label>Address2</label>
               <input type="text" class="form-control" name="Address2" placeholder="Address2">
             </div>
           </div>

           <hr class="seprator" <?php if($Id!='' && $Id!=null) {?>style='display:none;'<?php } ?>>
           <label for="" <?php if($Id!='' && $Id!=null) {?>style='display:none;'<?php }?>>Create a username</label><!--Ghouse/26-08-2020-->
           <div class="row mt-4" <?php if($Id!='' && $Id!=null) {?>style='display:none;'<?php }?>><!--Ghouse/26-08-2020-->
             <div class="col-md-3 form-group">
               <label>Username*</label>
               <input type="text" class="form-control" name="user_name" placeholder="Username" value='<?php echo $user_name;?>' autocomplete="new-password">
             </div>
             <div class="col-md-3 form-group">
               <label>Password*</label>
               <input type="password" class="form-control" name="password" placeholder="Password"  autocomplete="new-password">
             </div>
             <div class="col-md-3 form-group">
               <label>Confirm Password*</label>
               <input type="password" class="form-control" name="Confirm_password" placeholder="Confirm Password"  autocomplete="new-password">
             </div>
             <div class="col-md-3 form-group">
               <label>Accept Terms & Conditions.</label>
               <div>
                 <input type="checkbox" class="icheck" name="tANDc"/> <span class="pl-2 text-sm text-primary">Read Terms & Conditions.</span>
               </div>
             </div>
           </div>
           <div class="text-right py-5">
             <button class="btn btn-primary px-5 next-step" onlick='javascript:return false;'>NEXT <i class="icofont-simple-right"></i></button>
           </div>
        </section> 
     
        <h3>Payment Details</h3>
        <section id="form-inner"  class="Section2">
           <h2 class="py-5">Nearly there! All we need are your payment details and you’re all ready to go.</h2>
           <hr class="seprator">
           <div class="row">
             <div class="col-md-8">
               <div class="payment-via row no-gutters">
                 <div class="credit-card col-6">
                   <img src="<?php echo SITE_BASE_URL;?>assets/img/credit-card.png" class="img-fluid" alt=""> <span>Credit Card</span>

                   <span class="pull-right-checkbox"><input type="radio" class="icheck-blue" name="paymet-via" /></span>
                 </div>
                 <div class="paypal col-6 align-self-center">
                   <img src="<?php echo SITE_BASE_URL;?>assets/img/paypal-icon.png" class="img-fluid" alt="">
                   <span class="pull-right-checkbox"><input type="radio" class="icheck-blue" name="paymet-via" /></span>
                 </div>
               </div>
             </div>
             <div class="col-md-4 align-self-center">
               <div class="text-right">
                 <button class="btn btn-primary px-5 mr-4">SKIP</button>
                 <button class="btn btn-primary px-5 next-step">NEXT <i class="icofont-simple-right"></i></button>
               </div>
             </div>
           </div>

           <div class="relative add-card-div">
             <img src="<?php echo SITE_BASE_URL;?>assets/img/credit-card.png" class="img-fluid" alt="">
             <a class="add-card-btn" id="" href="#"><i class="icofont-plus-circle"></i> Add New Credit Card</a>
           </div>

           <hr class="seprator">


           <div class="cc-deatils mt-5">
             <div class="row">
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Name on Credit Card*</label>
                  <input type="text" class="form-control" name="Cardholder_Name" placeholder="Name on Credit Card">
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Credit Card Number*</label>
                  <input type="text" class="form-control" name="Card_Number" placeholder="1234 1234 1245 1244">
                 </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group">
                   <label>Expiry*</label> 
                   <div class="row">
                     <div class="col">
                       <select class="form-control" name="month_list" >
                         <option value="">Month</option>
                         option
                       </select>
                     </div>
                     <div class="col">
                       <select class="form-control" name="year_list">
                         <option value="">Year</option>
                         option
                       </select>
                     </div>
                   </div>
                 </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group">
                   <label>CVC* <small>What is CVC?</small></label> 
                   <input type="text" class="form-control" name="CVV" placeholder="CVC">
                 </div>
               </div>
             </div>
           </div>
            
            <div class="cc-deatils mt-5">
                
             <div class="row">
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Email Address for Invoice*</label>
                  <input type="text" class="form-control" name="Email_Address_for_Invoice" placeholder="Email Address for Invoice">
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Company Name</label>
                  <input type="text" class="form-control" name="Company_Name" placeholder="Company Name">
                 </div>
               </div>
               
             </div>
           </div>


           <div class="text-right py-5">
              <input type="submit" class="btn btn-primary"  value="Register">
           </div>

           <hr class="seprator">
        </section> 
     
        <h3>Done</h3>
        <section id="form-inner"  class="Section3">
           <div class="row">
             <div class="col-md-6 h-100">
               <div class="align-self-top">
                 <h1>You’re now ready to begin your free 30 day trial!</h1>
                 <p>We’ve sent you an email confirmation. Simply follow the link to start using your account.</p>
               </div>

               <div class="align-baseline-end">
                 <div class="">
                   <p>Haven’t received an email?<br> Check your junk mail folder or feel free to contact us.</p>
                 </div>
                 <hr class="seprator">
                 <div class="py-5">
                    <button class="btn btn-primary">FINISH</button>
                 </div>
               </div>
             </div>
             <div class="col-md-6">
               <div style="height: 450px; width: 100%;background-color: #DEDEDE;border-radius: 37px;"></div>
             </div>
           </div>
        </section> 


    </form>
      </div>
    </div>
  </div>
  </div>


  <!-- Vendor JS Files -->
  <script src="<?php echo SITE_BASE_URL;?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo SITE_BASE_URL;?>assets/vendor/aos/aos.js"></script>

  <!-- icheck -->
  <script src="<?php echo SITE_BASE_URL;?>assets/plugins/icheck/icheck.min.js"></script>
  <!-- Date Picker Plugin JavaScript -->
  <script src="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo SITE_BASE_URL;?>assets/vendor/jquery-steps/jquery-steps.min.js"></script>

  <script src="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput-jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>



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


$(document).delegate('.next-step', 'click', function () {
 var a = $(".wizard").steps("next");
 if (!a) {
 $(".wizard").steps("finish");
 }
 });
 $(document).delegate('.previous', 'click', function () {
 var a = $(".wizard").steps("previous");
 if (!a) {
 $(".wizard").steps("finish");
 }
 });


$(document).ready(function(){
  $('.icheck').iCheck({
    checkboxClass: 'icheckbox_square',
    radioClass: 'iradio_square',
    increaseArea: '20%' // optional
  });
  $('.icheck-blue').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
  });

  // Date Picker
  jQuery('.mydatepicker, #datepicker').datepicker();

});


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
<script src="<?php echo SITE_BASE_URL; ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
<script>
$(document).ready(function(){
 
 $(".date_picker").datepicker({
   
      setDate: new Date(),
      format: 'yyyy-mm-dd',
      todayHighlight: true,
      autoclose: true,
   
   });
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
        var Phone  		    = $("input[name='Phone']").val();
        var year_list		= $("select[name='year_list']").val();
        var country			= $("input[name='country_selector_code']").val();
        var Address1		= $("input[name='Address1']").val();
        var City			= $("input[name='City']").val();
        var Postal_Code		= $("input[name='Postal_Code']").val();
        var State			= $("input[name='State']").val();
        var Email_for_Inv	= $("input[name='Email_Address_for_Invoice']").val();
        var gender      	= $("input[name='gender']:checked").val();
        
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
    	if (Cardholder_Name.length < 1) {
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
</script>
</html>