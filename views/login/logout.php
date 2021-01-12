<?php include "header.php"; ?>

<script>
     function onLoad() {
        location.reload();
        gapi.load('auth2', function() {
        gapi.auth2.init();
      });
    }
</script>
<!--<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>-->
<script src="https://apis.google.com/js/platform.js" async defer></script
<script src="https://apis.google.com/js/api.js"></script>


<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
  
  
  onLoad();
      signOut();
      
      function logout(){
  FB.getLoginStatus(function(response) {
    FB.logout(function(response){
      console.log("Logged Out!");
      window.location = "/";
    });
  });
}
      
</script>




<html>
<head>
   <meta name="google-signin-client_id" content="692176514941-8etrj8n27jb0tsa8np4sm8redo21hg2u.apps.googleusercontent.com">
</head>
<body>
  <script>
    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log('User signed out.');
      });
    }

    function onLoad() {
      gapi.load('auth2', function() {
        gapi.auth2.init();
      });
    }
  </script>
  <a href="#" onclick="signOut();">Sign out</a>

  <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
</body>
</html>


<?php
//exit;

echo SITE_BASE_URL.'includes/settings.constants.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$cur_time = date('Y-m-d H:i:s',time());

if (isset($_SESSION["UserName"])){
    unset($_SESSION["UserName"]);
}

if (isset($_SESSION['LastLogin'])){
    unset($_SESSION['LastLogin']);
}

if (isset($_SESSION['CompareProperties'])){
    unset($_SESSION['CompareProperties']);
}

if (isset($_SESSION['BaseCurrency'])){
    unset($_SESSION['BaseCurrency']);
}
if (isset($_SESSION['BaseCountry'])){
    unset($_SESSION['BaseCountry']);
}

$BaseUrl = SITE_BASE_URL; 

header("Location: " . $BaseUrl);
exit;
?>
<?php
ob_end_flush();

