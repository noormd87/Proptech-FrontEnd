<?php include'HeaderCommon.php' ?>

  <!-- ======= Hero Section ======= -->
  <section class="d-flex align-items-center title-banner" style="background-image:url(<?php echo SITE_BASE_URL;?>assets/img/hong-kong-night-skyline.jpg);">

    <div class="container" data-aos="fade-up">
      <div class="row justify-content-center">
        <div class="col-lg-12 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 class="title-heading">About Du Val PropTech<h1>
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Section ======= -->
    <section class="">
      <div class="container">

        <div class="row">
          <div class="col-lg-10 offset-lg-1" data-aos="zoom-in" data-aos-delay="150">
            <p class="fs-26 text-center">Real estate ownership is the most effective way for people to achieve financial independence. We exist to make this a
reality for all rather than the privileged few.</p>
        <p class="fs-26 text-center">Disrupting traditional market inefficiencies, we seek to align the interests of investors, developers, governments and
communities alike, challenging outdated thinking and highlighting the valuable role small investors play in the
delivery of new housing.</p>

            <hr class="seprator-primary mt-5">
          </div>

          <div class="col-md-7 mt-5">
            <p class="mb-0">We help small investors achieve financial independence by making real estate investment accessible. Our market
leading technology empowers small investors with independent data, analysis tools and the purchasing power of
institutional investors</p>

            <div class="mt-5">
              <a class="btn btn-started" href="our-founders.html">OUR FOUNDERS</a>
            </div>
          </div>
          <div class="col-md-5 align-self-center mt-5 text-center">
            <img src="<?php echo SITE_BASE_URL;?>assets/img/du-val-logo.png" class="img-fluid" alt="Du Val Proptech">
          </div>
          
          
        </div>
          
                <p class="fs-26 text-center"> <a class="btn btn-started" href="signIn.html">Sign Up For A Free Trial</a></p>

      </div>
    </section><!-- End About Section -->



    <!-- ====== Call-Out===== -->
    <section class="callout">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-12 text-center text-md-left">
            <h6 class="subheading mt-md-2">Sign up to receive Du Val PropTech’s <br><br>Exclusive news and offers</h6>
          </div>
          <div class="col-lg-9 col-md-12">
            <form>
              <div class="row align-items-center">
                <div class="col-md-10 col-12">
                  <div class="row">
                    <div class="col-lg-3 col-md-auto col-12">
                      <div class="form-group">
                        <label class="" for="">First Name</label>
                        <input type="text" class="form-control mb-2" placeholder="First Name">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-auto col-12">
                      <div class="form-group">
                        <label class="" for="">Last Name</label>
                        <input type="text" class="form-control mb-2" placeholder="Last Name">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-auto col-12">
                      <div class="form-group">
                        <label class="" for="">Residency</label>
                        <select name="" class="form-control caret">
                          <option value="" selected="">Residency</option>
                          <option value=""></option>}
                        </select>
                        <i class="icofont-caret-down"></i>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-auto col-12">
                      <div class="form-group">
                        <label class="" for="">Email</label>
                        <input type="text" class="form-control mb-2" placeholder="Email">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-12">
                  <div class="" style="padding-top: 30px">
                    <button type="submit" class="btn btn-started mb-2">Sign Up</button>
                  </div>
                </div>
              </div>
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

 <?php include'FooterCommon.php' ?>
 
 

<!-- Speak To Portfolio Adviser -->
<div class="modal proptech-modal" id="portfolioAdviser">
  <div class="modal-dialog modal-xl modal-lg modal-md">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal"><i class="icofont-close"></i></button>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="row no-gutters">
            <div class="col-xl-6 pr-xl-5 col-lg-6  col-md-12 align-self-center">
              <div class="">
                <h4 class="modal-title">Speak to a Portfolio Adviser</h4>
                <p class="modal-para">We’re happy to assist you with any enquiries. Simply enter your details and one of our Portfolio Advisors will be in touch with you.</p>
              </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-12">
              <form class="form">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="">First Name</label>
                    <input type="text" class="form-control" name="first_name" placeholder="First Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Last Name</label>
                    <input type="text" class="form-control" name="first_name" placeholder="Last Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="first_name" placeholder="Email">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Mobile Number</label>
                    <input type="text" class="form-control" name="first_name" placeholder="Mobile Number">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Country</label>
                    <select name=""  class="form-control">
                      <option value="">Country</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">&nbsp;</label>
                    <button type="submit" class="btn btn-started btn-block">SUBMIT</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
