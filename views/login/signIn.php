
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Du Val Proptech</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">
  


  <!-- Favicons -->
  <link href="<?php echo SITE_BASE_URL;?>admin/assets/img/favicon.ico" rel="icon">
  <link href="<?php echo SITE_BASE_URL;?>admin/assets/img/favicon.ico" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,200i,300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:200, 200i,300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  
  <!-- Vendor CSS Files -->
  <link href="<?php echo SITE_BASE_URL;?>admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo SITE_BASE_URL;?>admin/assets/plugins/icofont/icofont.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>admin/assets/css/login.css">
  
  
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <meta name="google-signin-client_id" content="666360874265-78llhedddolcdjv5g9h3m3artaqklaao.apps.googleusercontent.com">

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '3206864422754269',
      cookie     : true,
      xfbml      : true,
      version    : 'v8.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
 
    function checkLoginState()//Ghouse /20-08-2020
    {
        FB.login(function(response) {
            statusChangeCallback(response);
        }, {
            scope: 'public_profile,email'
        });
    }
    function statusChangeCallback(response){
        console.log(response);
        
        if (response.status == "connected"){
            //alert("Login Success");
            //accessToken
            //signedRequest
            //userID
            
            accessToken     = response.authResponse.accessToken;
            userID          = response.authResponse.userID;
            signedRequest   = response.authResponse.signedRequest;
            
            window.location.href = "<?php echo SITE_BASE_URL;?>login/ValidateFbLogin.html?accessToken=" + accessToken + "&userID=" + userID + "&signedRequest=" + signedRequest;
            return false;
        }
    }
    
    
    function onSignIn(googleUser) {
      var profile = googleUser.getBasicProfile();
      console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
      console.log('Name: ' + profile.getName());
      console.log('Image URL: ' + profile.getImageUrl());
      console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
      
      window.location.href = "<?php echo SITE_BASE_URL;?>login/ValidateGoogleLogin.html?GoogleuserID=" + profile.getId() + "&GoogleName=" + profile.getName() + "&GoogleEmail=" + profile.getEmail();
    }

</script>
</head>
<body>


   <div class="main-wrapper">
    <header id="header" class="bg-dark py-3 px-5">
    <div  class="text-white"><img src="<?php echo SITE_BASE_URL;?>assets/img/logo.png" class="img-fluid" alt="Du Val Proptech"></div>
  </header><!-- /header -->
    <div class="container h-100">
      <div class="mt-5">
        <h2 class="heading1">Welcome to the Du Val PropTech</h2>
        <h4 class="heading4">3 Step Sign Up</h4>
        <hr class="seprator">
        <div class="v-align-middle">
          <form id="loginForm" action="#" class="login-form">
          <div class="row">
            <div class="col-5">
              To begin your free 30 day trial, we’ll need a few details from you. Once you’ve completed this, you will receive an email to activate your account.
            </div>
            <div class="col-md-7">
              
            </div>
            <div class="col-md-5 mt-5">
              <div class="btn-login-group login-buttons">
                <!--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>-->
                <div class="google-login g-signin2" data-onsuccess="onSignIn"></div>
                <a href="#" onclick="checkLoginState();" class="btn btn-login fb-login btn-block"><img src="<?php echo SITE_BASE_URL;?>assets/img/facebook-logo.png" class="img-fluid" alt=""> Log in with Facebook</a><!--Ghouse/20-08-2020-->
                <!--<button class="btn btn-login fb-login btn-block" onclick="checkLoginState();"><img src="<?php echo SITE_BASE_URL;?>assets/img/facebook-logo.png" class="img-fluid" alt=""> Log in with Facebook</button>
                <!--<button class="btn btn-login google-login btn-block"><img src="<?php echo SITE_BASE_URL;?>assets/img/google-logo.png" class="img-fluid" alt=""> Log in with Google</button>-->
                <a href="<?php echo SITE_BASE_URL;?>login/register.html" class="btn btn-login email-login btn-block"><img src="<?php echo SITE_BASE_URL;?>assets/img/email-logo.png" class="img-fluid" alt=""><img src="<?php echo SITE_BASE_URL;?>assets/img/email-icon.png" class="img-fluid" alt=""> Register with your email</a>
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div style="height: 100%;background-color: #EAEAEA;width: 100%;border-radius: 5px;"></div>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Vendor JS Files -->
  <script src="<?php echo SITE_BASE_URL;?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>