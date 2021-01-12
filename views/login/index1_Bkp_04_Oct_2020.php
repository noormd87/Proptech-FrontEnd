
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
   
   
   function checkLoginState() {
      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
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
    <header id="header" class="bg-primary py-3 px-5">
    <div  class="text-white"><img src="<?php echo SITE_BASE_URL;?>admin/assets/img/logo.png" class="img-fluid" alt="Du Val Proptech"></div>
  </header><!-- /header -->
  
  <form id="loginForm" action="<?php echo SITE_BASE_URL;?>login/CheckLogin.html" method='post' class="login-form">
    <div class="form-inner">
      <div class="container h-100">
        <div class="row align-items-center h-100">
          <div class="col-lg-6  col-md-6 col-12">
             <h2 class="heading1">Welcome to the Du Val PropTech</h2>
             <h4 class="heading4">Sign in</h4> 
             <div class="form-inputs">
                <div class="form-group mb-4">
                  <span style="color:red"><?php echo \login\loginClass::GetLoginMessage();  ?></span>
                </div>
                <div class="form-group mb-4">
                  <label for="">Username</label>
                  <input type="text" class="form-control" name="email" placeholder="Username">
                </div>
                <div class="form-group mb-4">
                  <label for="">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <button class="btn btn-warning btn-block">Sign in</button>

                <p class="forgot-link"><a href="#" title="">Forgot Password</a> </p>
                
                <p class="forgot-link">
                    <fb:login-button 
                      scope="public_profile,email"
                      onlogin="checkLoginState();">
                    </fb:login-button>
                </p>
                
                <div class="g-signin2" data-onsuccess="onSignIn"></div>
             </div>
             <p class="tc">Terms and Conditions | Privacy Policy</p>
          </div>
          <div class="col-lg-5 offset-lg-1 col-md-5 offset-md-1 col-12 offset-0">
             <div style="height: 450px;background-color: #EAEAEA;width: 100%;border-radius: 5px;"></div>
          </div>
        </div>
      </div>
    </div>
  </form>  

  

  <!-- Vendor JS Files -->
  <script src="<?php echo SITE_BASE_URL;?>admin/assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo SITE_BASE_URL;?>admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>