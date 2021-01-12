<div class="modal fade guide-modal guide-modal-dark" id="infoGuide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
	<div class="modal-content">
	   	<a class="close" data-dismiss="modal" aria-label="Close">
	      <span aria-hidden="true"><i class="fal fa-times"></i></span>
	    </a>
		  <div class="modal-body">
		    <section class="header-section">
				<div class="container">
					<div class="row">
						<div class="col-md-9">
							<h2 class="">Du Val PropTech </h2>
							<h5 class="">Your guide to getting started…</h5>
						</div>
						<div class="col-md-3 align-self-center text-right">
							<img src="<?php echo SITE_BASE_URL;?>assets/img/logo.png">
						</div>
					</div>
				</div>
			</section>

			<section class="">
				<div class="container">
					<p>Welcome <?= $LoginFirstName . " " . $LoginLastName?>,
					<br><br>
					Welcome to Du Val PropTech, your total solution as a smart property investor. Our platform allows our members to take control of their residential investment journey.
					<br><br>
					To help you get the most out of our platform we recommend that you read through our short starter guide, this takes you through the key aspects of our revolutionary market leading platform.
				</p>

					<div id="accordion" class="mt-4">
			  <div class="card">
			    <a class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			          Features <span class="collapse-icon"><i class="fa fa-plus"></i></span>		
			        </a>

			    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
			      <div class="card-body">
			        <p>As a valued Du Val PropTech member, you have the ability to access amazing investment opportunities, world leading market data and analysis tools and more. You can access each of the different features of the platform from the navigation bar on the left of your screen, each has its own icon, simply click to access to the tool or service, these include:</p>
					<ul>
						<li><span class="font-weight-bold">Dashboard </span> – you will find a summary of new projects as well as your favourite projects and properties which you are tracking.</li>
						<li><span class="font-weight-bold">My Portfolio</span> – track your existing portfolio and its financial performance</li>
						<li><span class="font-weight-bold">My Portfolio Adviser</span> – you have your own Portfolio Adviser to help you on your investment journey, contact them here</li>
						<li><span class="font-weight-bold">Global Residential Data</span> – here you can search for the latest residential market data from around the world</li>
						<li><span class="font-weight-bold">Search New Properties</span> – all of our properties are sold via Du Val Dynamic Pricing™ search for properties here</li>
						<li><span class="font-weight-bold">Run an Investment Analysis</span> – prepare a financial model for a potential investment and compare multiple opportunities</li>
						<li><span class="font-weight-bold">Investor Library</span> – access our library with guides and news about property investment</li>
						<li><span class="font-weight-bold">Currency</span> – access the LMAX currency portal here for market leading FX rates</li>
						<li><span class="font-weight-bold">Refer a Friend</span> – refer your friends and earn Du Val Reward points</li>
						<li><span class="font-weight-bold">FAQ’s</span> – here you will find answers to commonly asked questions</li>
						<li><span class="font-weight-bold">My Profile</span> – update your information here</li>
					</ul>
			      </div>
			    </div>
			  </div>
			</div>

					
				</div>
			</section>

			<section class="">
				<div class="container">
					<h4>Du Val Proptech Video Guides</h4>
					<p>We have created simple videos to take you through various aspects of the platform. </p>

					<div class="row">
                <div class="col-md-4">
                	<div class="embed-responsive embed-responsive-16by9">
					  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/6dN-hJUe7qs"></iframe>
					</div>
	                <p class="link-warning mt-1 mb-2">PropTech Introduction</p>
	            </div>
                <div class="col-md-4">
                    <div class="embed-responsive embed-responsive-16by9">
					  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/4tI_82Q_3og"></iframe>
					</div>
            		<p class="link-warning mt-1 mb-2">Dynamic Pricing</p>
                </div>
                <div class="col-md-4">
                    <div class="embed-responsive embed-responsive-16by9">
					  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zI2liEaR_2E"></iframe>
					</div>
            		<p class="link-warning mt-1 mb-2">Portfolio Analyser</p>
                </div>
            </div>
										
				</div>
			</section>

			<section class="mt-4">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<h4 class="mt-0">FAQ’s</h4>
							<p>Click <a href="<?php echo SITE_BASE_URL;?>login/adminfaq.html" title="">HERE</a> to take you through to our frequently asked question’s page</p>

							<h4>Just want to speak to one of the team?</h4>
							<p>Our call centre is here to help. Click <a href="<?php echo SITE_BASE_URL;?>ClientMail/contact.html" title="">HERE</a> to go through to and talk to one of the team.</p>

							<p class="small-note mt-5">*T&C’s apply. See XXXXXXX for more information</p>
						</div>
						<div class="col-md-4 align-self-end text-right">
							<button type="button" id="cookieModalConsent" class="btn btn-orange">DON’T SHOW ME AGAIN</a>
						</div>
					</div>
				</div>
			</section>
		  </div>
		</div>
	</div>
</div>


<script>
jQuery(document).ready(function() {


$(".collapse.show").each(function(){
	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
});

// Toggle right and down arrow icon on show hide of collapse element
$(".collapse").on('show.bs.collapse', function(){
	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
}).on('hide.bs.collapse', function(){
	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
	 });


    
	(function () {
  "use strict";
 
  var cookieName = 'tplCookieConsent'; // The cookie name
  var cookieLifetime = 365; // Cookie expiry in days
 
  /**
   * Set a cookie
   * @param cname - cookie name
   * @param cvalue - cookie value
   * @param exdays - expiry in days
   */
  var _setCookie = function (cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  };
 
  /**
   * Get a cookie
   * @param cname - cookie name
   * @returns string
   */
  var _getCookie = function (cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  };
 
  /**
   * Should the cookie popup be shown?
   */
  var _shouldShowPopup = function () {
    if (_getCookie(cookieName)) {
      return false;
    } else {
      return true;
    }
  };
 
  // Show the cookie popup on load if not previously accepted
  if (_shouldShowPopup()) {
    $('#infoGuide').modal('show');
  }
 
  // Modal dismiss btn - consent
  $('#cookieModalConsent').on('click', function () {
    _setCookie(cookieName, 1, cookieLifetime);
    $('#infoGuide').modal('hide');
  });
 
})();		
});    
</script>