<?php include"header.php"; ?>
<link rel="stylesheet" type="text/css" href="assets/plugins/customfileinputs/component.css">
  
  <div class="title-wrapper row">
   <div class="col">
     <div class="">
       <h2 class="page-title">My Profile</h2>
     </div>
   </div>
   <div class="col">
   </div>
 </div>

 <div class="tab-content-one">
    <ul class="nav nav-tabs tab-style-one" id="typeTab" role="tablist">
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
        <div class="card h-90">
          <div class="card-body">
              <form class="profile-form" action="" method="POST" accept-charset="utf-8" >
                <div class="my-profile-box">
                  <div class="profile-thumb">
                    <img src="assets/img/oval-profile.png" class="img-fluid" alt="">
                    <p class="text-center"><a href="#" title="" class="change-profile" class="" id="">Change Picture</a></p>
                  </div>
                  <div class="profile-details " id="contactInfo">
                    <h2 class="heading-two t3">James Bond <a href="#" class="edit" id="editContact"><i class="icofont-ui-edit"></i> Edit details</a></h2>

                    <div class="row">
                      <div class="col-md-3 form-group">
                        <label>Email</label>
                        <input type="text" class="form-control-plaintext input-select" name="" placeholder="James.bond@bond.com">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control-plaintext input-select" name="" placeholder="+64 023 88000">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control-plaintext input-select" name="" placeholder="+64 023 88000">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Date of Birth</label>
                        <input type="text" class="form-control-plaintext input-select" name="" placeholder="12/02/1999">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-12">
                        <h4 class="t3">Username Details <a href="#" class="edit"><i class="icofont-ui-edit"></i> Edit details</a></h4>
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Username</label>
                        <input type="text" class="form-control-plaintext input-select" name="" placeholder="jamesbond">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Password</label>
                        <input type="password" class="form-control-plaintext input-select" name="" placeholder="James.bond@bond.com">
                      </div>
                      <div class="col-md-12">
                        <div class="mt-4">
                          <button type="submit" id="updateContact" class="btn btn-primary br-0">Submit</button>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-12">
                        <h4 class="mb-4 t3">Social Media Details <a id="edit-profilr" class="edit"><i class="icofont-ui-edit"></i> Edit details</a></h4>
                      </div>
                      <div class="col-md-3 form-group">
                        <img src="assets/img/facebook.png" alt=""> jamesbond
                      </div>
                      <div class="col-md-3 form-group">
                        <img src="assets/img/linkedin.png" alt=""> jamesbond
                      </div>
                      <div class="col-md-3 form-group">
                        <img src="assets/img/twitter.png" alt=""> jamesbond
                      </div>
                      <div class="col-md-3 form-group">
                        <img src="assets/img/instagram.png" alt=""> jamesbond
                      </div>
                    </div>
                    <div class="row mt-5">
                      <div class="col-12">
                        <h4 class="mb-3 t3">Copy link & Share</h4>
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
                        <a href="#"><img src="assets/img/facebook.png" alt=""></a>
                        <a href="#"><img src="assets/img/linkedin.png" alt=""></a>
                        <a href="#"><img src="assets/img/twitter.png" alt=""></a>
                        <a href="#"><img src="assets/img/instagram.png" alt=""></a>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
          </div>
        </div>
       </div>
      <div class="tab-pane fade" id="typeB" role="tabpanel" aria-labelledby="typeB-tab">
        <div class="card h-90">
          <div class="card-body">
            <form class="card-form" action="" method="POST" accept-charset="utf-8" >
              <h2 class="heading-two">James Bond</h2>

              <h5 class="sm-heading mb-0">User ID</h5>
              <h4>James.bond@bond.com</h4>

              <h5 class="sm-heading mt-5">Credit Card Details <a id="editCard" class="edit ml-2"><i class="icofont-ui-edit"></i> Edit card details</a></h5>

            <div class="cc-deatils mt-4">
             <div class="row">
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Name on Credit Card</label>
                  <input type="text" class="form-control input-select" name="" placeholder="Name on Credit Card">
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Credit Card Number</label>
                  <input type="text" class="form-control input-select" name="" placeholder="1234 1234 1245 1244">
                 </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group">
                   <label>Expiry</label> 
                   <div class="row">
                     <div class="col">
                       <select class="form-control input-select" name="">
                         <option value="">xx</option>
                       </select>
                     </div>
                     <div class="col">
                       <select class="form-control input-select" name="">
                         <option value="">xxx</option>
                       </select>
                     </div>
                   </div>
                 </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group">
                   <label>CVC <small>What is CVC?</small></label> 
                   <input type="text" class="form-control input-select" name="" placeholder="XXXXX">
                 </div>
               </div>
             </div>
           </div>

           <div class="col-md-12">
                        <div class="mt-4">
                          <button type="submit" id="updateCard" class="btn btn-primary br-0">Submit</button>
                        </div>
                      </div>
            </form>
        </div>
        </div>
      </div>
      <div class="tab-pane fade" id="typeC" role="tabpanel" aria-labelledby="typeC-tab">
        <div class="card h-90">
          <div class="card-body">
            <form class="profile-form" action="" method="POST" accept-charset="utf-8" >
              <h2 class="heading-two">James Bond <a class="edit"><i class="icofont-ui-edit"></i> Edit details</a></h2>

              <h5 class="sm-heading mb-0">User ID</h5>
              <h4>James.bond@bond.com</h4>

              <h5 class="sm-heading mt-5">Credit Card Details <a class="edit ml-2"><i class="icofont-ui-edit"></i> Edit card details</a></h5>

              <div class="row">
                <div class="col-lg-8">
                  <div class="aml-box mt-5">
                    <div class="aml-box-inner mr-5">
                      <label>Upload id</label>
                      <div class="js">
                         <input type="file" name="name-proof[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                         <label for="file-1"><img src="assets/img/download-icon-sm.png" class="img-fluid" > <span>Upload Proof&hellip;</span></label>
                      </div>
                    </div>
                    <div class="aml-box-inner">
                      <label>Upload POA</label>
                      <div class="js">
                         <input type="file" name="name-proof[]" id="file-2" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                         <label for="file-2"><img src="assets/img/download-icon-sm.png" class="img-fluid" > <span>Upload Proof&hellip;</span></label>
                      </div>
                  </div>
              </div>
              <p class="fs-14 t4 mt-3">Note : On completion of receipt of the AML documents you may begin to reserve properties through our online platform.</p>
              <div class="text-right mt-4">
                <button type="submit" class="btn btn-primary br-0">Submit</button>
              </div>
                </div>
              </div>
            </form>
            
        </div>
        </div>
      </div>
      <div class="tab-pane fade" id="typeD" role="tabpanel" aria-labelledby="typeD-tab">
        <div class="card h-90">
          <div class="card-body">
            <form class="profile-form" action="" method="POST" accept-charset="utf-8" >
              <div class="row mt-4">
                <div class="col-lg-6">
                  <div class="">
                    <label>Target investment locations</label>
                    <textarea name="" class="form-control custom-textarea" rows="5"></textarea>
                  </div>
                </div>
                <div class="col-lg-6 align-self-end">
                  <a href="" class="edit-btn" id="target-investment"><img src="assets/img/edit-icon-sm.png" class="img-fluid"> Edit details</a>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-lg-6">
                  <div class="">
                    <label>Target investment locations</label>
                    <textarea name="" class="form-control custom-textarea" rows="5"></textarea>
                  </div>
                </div>
                <div class="col-lg-6 align-self-end">
                  <a href="" class="edit-btn"><img src="assets/img/edit-icon-sm.png" class="img-fluid"> Edit details</a>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-lg-6">
                  <div class="">
                    <label>Target investment locations</label>
                    <textarea name="" class="form-control custom-textarea" rows="5"></textarea>
                  </div>
                </div>
                <div class="col-lg-6 align-self-end">
                  <a href="" class="edit-btn"><img src="assets/img/edit-icon-sm.png" class="img-fluid"> Edit details</a>
                </div>
                <div class="col-md-6">
                  <div class="text-right mt-4">
                    <button type="submit" class="btn btn-primary br-0">Submit</button>
                  </div>
                </div>
              </div>

            </form>
        </div>
        </div>
      </div>
    </div>
  </div>
  

<?php include"footer.php"; ?>

<script src="assets/plugins/customfileinputs/custom-file-input.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#updateContact").hide();
        $("#editContact").click(function(e){
            e.preventDefault();

            if( !confirm('Are you sure you want to continue?')) {
                    return false;
            }else{
                $("#updateContact").fadeIn();
                 $('#contactInfo .input-select').removeClass('form-control-plaintext').addClass('form-control');
                 $('.basic-information .input-select').removeClass('form-control-plaintext').addClass('form-control');
         
                 $('#contactInfo .input-select').css('pointer-events', 'all');
                 return true;
            }
        });


        //edit card info
        $("#editCard").click(function(e){
            e.preventDefault();

            if( !confirm('Are you sure you want to continue?')) {
                    return false;
            }else{
                $("#updateCard").fadeIn();
                 $('.card-form .input-select').css('pointer-events', 'all');
                 return true;
            }
        });


        $('#updateCard').hide();
        $('.card-info .input-select').attr("readonly","readonly");
        $('.card-info select').attr("disabled", "disabled");
        $("#editCard").click(function(e){
            e.preventDefault()
            
            if( !confirm('Are you sure you want to continue?')) {
                    return false;
            }else{
                $('#updateCard').fadeIn();
                 $('.card-info .input-select').removeAttr("readonly","readonly");
                 $('.card-info select').removeAttr("disabled", "disabled");   
                 $('.card-info .input-select').removeClass('form-control-plaintext').addClass('form-control'); 
                 $('.card-info select').removeClass('form-control-plaintext').addClass('form-control');
                 return true;
            }

            

        });
    });
</script>