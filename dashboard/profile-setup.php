<?php include"header.php"; ?>
               
<link rel="stylesheet" type="text/css" href="assets/plugins/jquery-steps/jquery-steps.css">
<div class="row no-gutters">
  <div class="col-md-12">
    <div class="card">
        <div class=" text-center pt-3">
          <h4 class="fs-20 t3">Get the most out of Du Val PropTech</h4>
        </div>
        <div id="profile-steps" class="profile-setup">
              <h3>Your Details</h3>
              <section>
                  <div class="">
                    <h4>Hi James Bond</h4>

                    <h2 class="mt-5">What would you like to do today?</h2>
                    <div class="row mt-5">
                      <div class="col-12 col-md-4 col-lg-3">
                        <div class="icon-box-one border-after">
                          <span class="text-dark-secondary"><i class="icon-globe"></i></span>
                          <p class="text-three t3">Research the property market in Australia, New Zealand, the UK</p>
                          <a class="btn btn-primary btn-block" href="">Global Research Data</a>
                        </div>
                      </div>
                      <div class="col-12 col-md-4 col-lg-3">
                        <div class="icon-box-one border-after">
                          <span class="text-dark-secondary"><i class="icofont-chart-histogram-alt"></i></span>
                          <p class="text-three t3">I’m thinking of buying a property run an investment analysis</p>
                          <a class="btn btn-primary btn-block" href="">Run a Investment analysis</a>
                        </div>
                      </div>
                      <div class="col-12 col-md-4 col-lg-3">
                        <div class="icon-box-one">
                          <span class="text-dark-secondary"><i class="icofont-tack-pin"></i></span>
                          <p class="text-three t3">Check out what properties are trending right now</p>
                          <a class="btn btn-primary btn-block" href="">Trending page</a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-md-4 col-lg-3">
                        <div class="icon-box-one border-after">
                          <span class="text-secondary"><i class="icofont-copy"></i></span>
                          <p class="text-three t3">Check how my portfolio is performing</p>
                          <a class="btn btn-info btn-block" href="">My portfolio</a>
                        </div>
                      </div>
                      <div class="col-12 col-md-4 col-lg-3">
                        <div class="icon-box-one border-after">
                          <span class="text-dark-secondary"><i class="icon-home"></i></span>
                          <p class="text-three t3">Check out your Home Page</p>
                          <a class="btn btn-primary btn-block" href="">My Home Page</a>
                        </div>
                      </div>
                      <div class="col-12 col-md-4 col-lg-3">
                        <div class="icon-box-one">
                          <span class="text-warning"><i class="icon-grid"></i></span>
                          <p class="text-three t3">Dashboard</p>
                          <a class="btn btn-primary btn-block" href="">My Dashboard</a>
                        </div>
                      </div>
                    </div>
                  </div>
              </section>
              <h3>Payments Details</h3>
              <section>
                  <p></p>
              </section>
              <h3>My Portfolio</h3>
              <section>
                  <p></p>
              </section>
              <h3>Complete your profile now.</h3>
              <section>
                
              </section>
          </div>
      </div>
  </div>
</div>


<?php include"footer.php"; ?>

<script src="assets/plugins/jquery-steps/jquery-steps.min.js"></script>
<script>
  $("#profile-steps").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    titleTemplate: "#title#",
    autoFocus: true
});
</script>