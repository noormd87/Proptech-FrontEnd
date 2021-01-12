<?php include"header.php"; ?>

  
  <div class="title-wrapper row">
   <div class="col">
     <div class="">
       <h2 class="page-title">My Profile</h2>
     </div>
   </div>
   <div class="col">
   </div>
 </div>

<div class="card">
 <div class="tab-content-one">
    <ul class="nav nav-tabs tab-style-one nav-justified" id="typeTab" role="tablist">
       <li class="nav-item">
          <a class="nav-link active" id="typeA-tab" data-toggle="tab" href="#typeA" role="tab" aria-controls="typeA" aria-selected="true">My Profile</a>
       </li>
       <li class="nav-item">
          <a class="nav-link" id="typeB-tab" data-toggle="tab" href="#typeB" role="tab" aria-controls="typeA" aria-selected="false">Payments Information</a>
       </li>
       <li class="nav-item">
          <a class="nav-link" id="typeC-tab" data-toggle="tab" href="#typeC" role="tab" aria-controls="typeC" aria-selected="false">AML INFO</a>
       </li>
       <li class="nav-item">
          <a class="nav-link" id="typeD-tab" data-toggle="tab" href="#typeD" role="tab" aria-controls="typeD" aria-selected="false">Investments Goals</a>
       </li>
    </ul>
    <div class="tab-content" id="typeTabContent">
      <div class="tab-pane fade show active" id="typeA" role="tabpanel" aria-labelledby="typeA-tab">
        <div class="card-body">
            <form class="profile-form" action="" method="POST" accept-charset="utf-8" >
              <div class="my-profile-box">
                <div class="profile-thumb">
                  <img src="<?php echo SITE_BASE_URL;?>assets/img/default-avatar.png" class="img-fluid" alt="">
                </div>
                <div class="profile-details">
                  <h2 class="heading-two">James Bond <a class="edit"><i class="icofont-ui-edit"></i> Edit details</a></h2>

                  <div class="row">
                    <div class="col-md-3 form-group">
                      <label>Email</label>
                      <input type="text" class="form-control-plaintext" name="" placeholder="James.bond@bond.com">
                    </div>
                    <div class="col-md-3 form-group">
                      <label>Mobile Number</label>
                      <input type="text" class="form-control-plaintext" name="" placeholder="+64 023 88000">
                    </div>
                    <div class="col-md-3 form-group">
                      <label>Phone Number</label>
                      <input type="text" class="form-control-plaintext" name="" placeholder="+64 023 88000">
                    </div>
                    <div class="col-md-3 form-group">
                      <label>Date of Birth</label>
                      <input type="text" class="form-control-plaintext" name="" placeholder="12/02/1999">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-12">
                      <h4 class="">Username Details <a class="edit"><i class="icofont-ui-edit"></i> Edit details</a></h4>
                    </div>
                    <div class="col-md-3 form-group">
                      <label>Username</label>
                      <input type="text" class="form-control-plaintext" name="" placeholder="jamesbond">
                    </div>
                    <div class="col-md-3 form-group">
                      <label>Password</label>
                      <input type="password" class="form-control-plaintext" name="" placeholder="James.bond@bond.com">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-12">
                      <h4 class="mb-4">Social Media Details <a class="edit"><i class="icofont-ui-edit"></i> Edit details</a></h4>
                    </div>
                    <div class="col-md-3 form-group">
                      <img src="<?php echo SITE_BASE_URL;?>assets/img/facebook.png" alt=""> jamesbond
                    </div>
                    <div class="col-md-3 form-group">
                      <img src="<?php echo SITE_BASE_URL;?>assets/img/linkedin.png" alt=""> jamesbond
                    </div>
                    <div class="col-md-3 form-group">
                      <img src="<?php echo SITE_BASE_URL;?>assets/img/twitter.png" alt=""> jamesbond
                    </div>
                    <div class="col-md-3 form-group">
                      <img src="<?php echo SITE_BASE_URL;?>assets/img/instagram.png" alt=""> jamesbond
                    </div>
                  </div>

                  <div class="row mt-5">
                    <div class="col-12">
                      <h4 class="mb-3">Copy link & Share</h4>
                    </div>
                    <div class="col-md-5 form-group">
                      <input type="text" class="form-control" name="" placeholder="James.bond@bond.com">
                    </div>
                    <div class="col-md-3 form-group">
                      <button type="" class="btn btn-outline-primary">Copy</button>
                    </div>
                    <div class="col-md-3 form-group">
                      <button type="" class="btn btn-outline-primary">Refer a Friend</button>
                    </div>
                    <div class="col-12">
                      <a href="#"><img src="<?php echo SITE_BASE_URL;?>assets/img/facebook.png" alt=""></a>
                      <a href="#"><img src="<?php echo SITE_BASE_URL;?>assets/img/linkedin.png" alt=""></a>
                      <a href="#"><img src="<?php echo SITE_BASE_URL;?>assets/img/twitter.png" alt=""></a>
                      <a href="#"><img src="<?php echo SITE_BASE_URL;?>assets/img/instagram.png" alt=""></a>
                    </div>
                  </div>
                </div>
              </div>
            </form>
        </div>
      </div>
      <div class="tab-pane fade" id="typeB" role="tabpanel" aria-labelledby="typeB-tab">
        <div class="card-body">
            <form class="profile-form" action="" method="POST" accept-charset="utf-8" >
              <h2 class="heading-two">James Bond <a class="edit"><i class="icofont-ui-edit"></i> Edit details</a></h2>

              <h5 class="sm-heading mb-0">User ID</h5>
              <h4>James.bond@bond.com</h4>

              <h5 class="sm-heading mt-5">Credit Card Details <a class="edit ml-2"><i class="icofont-ui-edit"></i> Edit card details</a></h5>

              <div class="cc-deatils mt-4">
             <div class="row">
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Name on Credit Card</label>
                  <input type="text" class="form-control" name="" placeholder="Name on Credit Card">
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Credit Card Number</label>
                  <input type="text" class="form-control" name="" placeholder="1234 1234 1245 1244">
                 </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group">
                   <label>Expiry</label> 
                   <div class="row">
                     <div class="col">
                       <select class="form-control" name="">
                         <option value="">xx</option>
                       </select>
                     </div>
                     <div class="col">
                       <select class="form-control" name="">
                         <option value="">xxx</option>
                       </select>
                     </div>
                   </div>
                 </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group">
                   <label>CVC <small>What is CVC?</small></label> 
                   <input type="text" class="form-control" name="" placeholder="XXXXX">
                 </div>
               </div>
             </div>
           </div>
            </form>
        </div>
      </div>
      <div class="tab-pane fade" id="typeC" role="tabpanel" aria-labelledby="typeC-tab">
        <div class="card-body">
            <form class="profile-form" action="" method="POST" accept-charset="utf-8" >
              <h2 class="heading-two">James Bond <a class="edit"><i class="icofont-ui-edit"></i> Edit details</a></h2>

              <h5 class="sm-heading mb-0">User ID</h5>
              <h4>James.bond@bond.com</h4>

              <h5 class="sm-heading mt-5">Credit Card Details <a class="edit ml-2"><i class="icofont-ui-edit"></i> Edit card details</a></h5>

              <div class="cc-deatils mt-4">
             <div class="row">
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Name on Credit Card</label>
                  <input type="text" class="form-control" name="" placeholder="Name on Credit Card">
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Credit Card Number</label>
                  <input type="text" class="form-control" name="" placeholder="1234 1234 1245 1244">
                 </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group">
                   <label>Expiry</label> 
                   <div class="row">
                     <div class="col">
                       <select class="form-control" name="">
                         <option value="">xx</option>
                       </select>
                     </div>
                     <div class="col">
                       <select class="form-control" name="">
                         <option value="">xxx</option>
                       </select>
                     </div>
                   </div>
                 </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group">
                   <label>CVC <small>What is CVC?</small></label> 
                   <input type="text" class="form-control" name="" placeholder="XXXXX">
                 </div>
               </div>
             </div>
           </div>
            </form>
        </div>
      </div>
      <div class="tab-pane fade" id="typeD" role="tabpanel" aria-labelledby="typeD-tab">
        <div class="card-body">
            <form class="profile-form" action="" method="POST" accept-charset="utf-8" >
              <h2 class="heading-two">James Bond <a class="edit"><i class="icofont-ui-edit"></i> Edit details</a></h2>

              <h5 class="sm-heading mb-0">User ID</h5>
              <h4>James.bond@bond.com</h4>

              <h5 class="sm-heading mt-5">Credit Card Details <a class="edit ml-2"><i class="icofont-ui-edit"></i> Edit card details</a></h5>

              <div class="cc-deatils mt-4">
             <div class="row">
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Name on Credit Card</label>
                  <input type="text" class="form-control" name="" placeholder="Name on Credit Card">
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Credit Card Number</label>
                  <input type="text" class="form-control" name="" placeholder="1234 1234 1245 1244">
                 </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group">
                   <label>Expiry</label> 
                   <div class="row">
                     <div class="col">
                       <select class="form-control" name="">
                         <option value="">xx</option>
                       </select>
                     </div>
                     <div class="col">
                       <select class="form-control" name="">
                         <option value="">xxx</option>
                       </select>
                     </div>
                   </div>
                 </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group">
                   <label>CVC <small>What is CVC?</small></label> 
                   <input type="text" class="form-control" name="" placeholder="XXXXX">
                 </div>
               </div>
             </div>
           </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/flexslider/css/flexslider.min.css">

<?php include"footer.php"; ?>