

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

		<form action="<?php echo SITE_BASE_URL; ?>login/SendMail.html" name='login' method="post" accept-charset="utf-8" class="login-form">
            <h3>Forgot Your Password ?</h3>
			<input type="text" class="form-control" name="email" tabindex="1" placeholder="email@example.com" >

			<!--<input type="password" class="form-control"  name="password" value="" id="password" tabindex="2" placeholder="password" />-->

			<span style='font-weight:bold; color:red; '>

				<?php echo \login\loginClass::GetLoginMessage();  ?>

			</span>

		  <input type="submit" class="btn btn-block btn-login"  value="Send mail">

		</form>

		

		<!-- Remind Passowrd -->

		<form action="./login/register.html"  name='register' method="post" accept-charset="utf-8">

			<div class="formFooter">

			 <a class="underlineHover" href="#" onclick="document.register.submit()">Registration?</a>

			</div>

			<div class="formFooter">

			  <a class="underlineHover" href="<?php echo SITE_BASE_URL; ?>login/index.html">Back</a>

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