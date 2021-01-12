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
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap-select-country/dist/css/bootstrap-select-country.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/vendor/jquery-steps/jquery-steps.css">
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="692176514941-8etrj8n27jb0tsa8np4sm8redo21hg2u.apps.googleusercontent.com">
    <meta name="google-site-verification" content="2MCYy75TsvwU_2uyc5b9VtJB1FW2lK9eOc3QpY0Z-XA" />
<!--// google sign in code starts here-->
<script>
    function onSignIn(googleUser) {
      var profile = googleUser.getBasicProfile();
      console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
      console.log('Name: ' + profile.getName());
      console.log('Image URL: ' + profile.getImageUrl());
      console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
      window.location.href = "<?php echo SITE_BASE_URL;?>login/ValidateGoogleLogin.html?GoogleuserID=" + profile.getId() + "&GoogleName=" + profile.getName() + "&GoogleEmail=" + profile.getEmail();
    }
</script>
<!--// google sign incode ends here-->

<script>
    // $(document).ready(function() {
    //   $.ajaxSetup({ cache: true });
    //   $.getScript('https://connect.facebook.net/en_US/sdk.js', function(){
    //     FB.init({
    //       appId: '663838230972988',
    //       cookie     : true,                     // Enable cookies to allow the server to access the session.
    //       xfbml      : true,
    //       version: 'v9.0' // or v2.1, v2.2, v2.3, ...
    //     });     
    //     $('#loginbutton,#feedbutton').removeAttr('disabled');
    //     // FB.getLoginStatus(updateStatusCallback);
    //     FB.getLoginStatus(statusChangeCallback);
    //   });
    // });
    
        
//      function statusChangeCallback(response){
//         if (response.status == "connected"){
//              FB.api('/me',{fields: 'first_name,last_name,email'}, function(data) {
//             //  fb_name = data.first_name+" "+data.last_name+" "+data.email;
//             // console.log(fb_name);
//             // return;
//             // console.log(data);
//             // console.log(response);
//             accessToken     = response.authResponse.accessToken;
//             userID          = response.authResponse.userID;
//             signedRequest   = response.authResponse.signedRequest;
//             window.location.href = "<?php echo SITE_BASE_URL;?>login/ValidateFbLogin.html?accessToken=" + accessToken + "&userID=" + userID + "&signedRequest=" + signedRequest
//             + "&first_name=" + data.first_name+ "&last_name=" + data.last_name+ "&email=" + data.email;
//             });
//         }
//     }
    
    
//     function checkLoginState() {               // Called when a person is finished with the Login Button.
//     FB.getLoginStatus(function(response) {   // See the onlogin handler
//       statusChangeCallback(response);
//     });
//   }
</script>
</head>

<body>

  <div class="hero-wrapper">
    <div class="container container-expand">
      <nav class="navbar navbar-expand-lg login-nav">
        <a class="navbar-brand" href="<?php echo SITE_BASE_URL;?>"><img src="<?php echo SITE_BASE_URL;?>assets/img/logo.png" class="img-fluid" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <!--<li class="nav-item active">
              <a class="nav-link" href="<?php echo SITE_BASE_URL;?>">CONTACT US</a>
            </li>-->
            <li class="nav-item">
              <a class="nav-link" href="<?php echo SITE_BASE_URL;?>"> > BACK TO MAIN WEBSITE</a>
              <!--<div class="text-right">-->
              <!--  <button type="button" class="currency-btn">USD</button>-->
              <!--</div>-->
            </li>
          </ul>
          
        </div>
      </nav>
    </div>
    <div class="container wrapper-inner">
        <div class="row h-100">
          <div class="col-xl-7 col-lg-6">
            <div class="form-wrap-text">
              <h1>Welcome <span>To Du Val PropTech</span></h1>
              
              <p>Log In here or let us take you through the easy step by step process guide to create your account</p>
            </div>
          </div>
          <div class="col-xl-5 col-lg-6">
            <div class="login-form-wrapper">
              <div class="form-wrapper-inner bgc-dark">
                <p class="form-title mb-4">LET’S START HERE</p>
                <div class="form-btn-group"><a href="<?php echo SITE_BASE_URL;?>login/register.html" class="button-primary btn-sm fs-12 d-inline-block w-100" title="">CREATE ACCOUNT</a></div>
                <div class="clearfix"></div>
                <!-- <form action="create-account.html" accept-charset="utf-8"> -->
                  <form id="loginForm" action="<?php echo SITE_BASE_URL;?>login/CheckLogin.html" method='post' class="login-form">
                  <div class="form-group mb-4">
                    <span style="color:red"><?php echo \login\loginClass::GetLoginMessage();  ?></span>
                  </div>

                  <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="USERNAME" required >
                    <p class="text-right"><a class="forgot-link" href="ForgotPassWd.html" title="">Forgot Emal?</a></p>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="PASSWORD" required>
                      <div class="float-left mt-1">
                        <div class="checkbox-container">
                          <label class="checkbox-label">
                              <input type="checkbox" id="signed-in">
                              <span class="checkbox-custom rectangular"></span>
                          </label>
                          <span class="checkbox-title">Keep me signed in</span>
                        </div>
                      </div>
                      <div class="float-right">
                        <a class="forgot-link" href="ForgotPassWd.html" title="">Forgot Password?</a>
                      </div>
                      <div class="clearfix"></div>
                  </div>

                  <div class="text-center my-4">
                    <button type="submit" class="button-warning btn-sm w-160">LOG IN</button> 
                  </div>
                
                    <div class="row">
                        <!--<div class="col-12">-->
                        <!--    <div class="g-signin2" data-onsuccess="onSignIn"></div>-->
                        <!--</div>-->
                        <!--<div class="col-12 text-center mb-4">-->
                                <!--<div id="fb-root"></div>-->
                                <!--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v9.0&appId=663838230972988&autoLogAppEvents=1" nonce="WwfD0NHM"></script>-->
                            <!--<div class="fb-login-button" data-size="medium" data-button-type="continue_with" data-layout="rounded" data-auto-logout-link="false" data-use-continue-as="true" data-width=""></div>-->
                        <!--    <fb:login-button scope="public_profile , email" onlogin="checkLoginState();">-->
                        <!--</div>-->
                    </div>
                    
                  <p class="form-notes">This is a secure site and you will need to provide your log in details to access the site</p>
                </form>

                <a class="form-link float-left" href="terms.html" title="">Terms & Conditions</a>
                <a class="form-link float-right" href="privacy.html" title="">Privacy Policy</a>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="<?php echo SITE_BASE_URL;?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo SITE_BASE_URL;?>assets/vendor/aos/aos.js"></script>

  <!-- Date Picker Plugin JavaScript -->
  <script src="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput-jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>



  <script>


      
      var form = $("#loginForm").show();
 
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
</body>

</html>