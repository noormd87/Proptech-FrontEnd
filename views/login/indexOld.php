

<!DOCTYPE html>

<html lang="en">

<head>

  <base href="<?php echo SITE_BASE_URL;?>">

  <meta charset="utf-8" />

  <link rel="icon" type="image/png" href="images/favicon.png">

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>

    DU VAL PRIVATE OFFICE

  </title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!--     Fonts and icons     -->

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

  <!-- CSS Files -->

  <link href="stylesheets/bootstrap.min.css" rel="stylesheet" />

  <link href="stylesheets/style.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="stylesheets/main.css">

  <link rel="stylesheet" type="text/css" href="stylesheets/responsive.css">
  
  <!-- PushAlert -->
    <script type="text/javascript">
        (function(d, t) {
            var g = d.createElement(t),
            s = d.getElementsByTagName(t)[0];
            g.src = "https://cdn.pushalert.co/integrate_4f1f469a131e416759c3471de012680c.js";
            s.parentNode.insertBefore(g, s);
        }(document, "script"));
    </script>
    <!-- End PushAlert -->

</head>



	<body class="">

	<div class="wrapper formWrapper bg-image">

	  <div class="formContent  fadeInDown">

		<!-- Tabs Titles -->

		<!-- Icon -->

		<div class="form-caption mb-4">

		  <img src="images/Layer-19.png" class="img-fluid"  alt=""/>

		  <h2>DPO</h2>

		</div>



		<!-- Login Form -->

		<form action="./login/Checklogin.html" name='login' method="post" accept-charset="utf-8" class="login-form">

			<input type="text" class="form-control" name="email" tabindex="1" placeholder="email@example.com" >

			<input type="password" class="form-control"  name="password" value="" id="password" tabindex="2" placeholder="password" />

			<span style='font-weight:bold; color:red; '>

				<?php echo \login\loginClass::GetLoginMessage();  ?>

			</span>

		  <input type="submit" class="btn btn-block btn-login"  value="Login">

		</form>

		

		<!-- Remind Passowrd -->

		<form action="<?php echo SITE_BASE_URL; ?>login/register.html"  name='register' method="post" accept-charset="utf-8">

			<div class="formFooter">

			 <a class="underlineHover" href="<?php echo SITE_BASE_URL; ?>login/register.html" >Registration?</a>

			</div>

			<div class="formFooter">

			  <a class="underlineHover" href="<?php echo SITE_BASE_URL; ?>login/ForgotPassWd.html">Forgot Password?</a>

			</div>

		</form>

	  </div>

	</div>





  <!--   Core JS Files   -->

  <script src="javascripts/core/jquery.min.js"></script>

  <script src="javascripts/core/popper.min.js"></script>

  <script src="javascripts/core/bootstrap.min.js"></script>



  <script src="javascripts/custom.js" type="text/javascript"></script>





</body>

</html>