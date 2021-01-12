<?php include"header.php"; ?>
<script src="<?php echo SITE_BASE_URL;?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<?php
\login\loginClass::Init();
$rows = \login\loginClass::GetAccountDatas();
$i = 1;
$key=hash("sha256", $LoginUserName, false);
foreach ($rows as $row) 
{
    $id              = $row["id"];
    $user_id         = $row["user_id"];
    $user_name       = $row["user_name"];
    $first_name		 = $row["first_name"];
	$last_name		 = $row["last_name"];
	$phone_no		 = $row["phone_no"];
	$phone_no1		 = $row["phone_no1"];
	$subscription_id = $row["subscription_id"];
	$currnt_points   = $row["currnt_points"];
	$created_on 	 = $row["created_on"];
	$address		 = $row["address"];
	$Acc_Auto_id	 = $row["current_acc_auto_id"];
	$IsAdmin		 = $row["is_admin"];
	$period_type	 = $row["period_type"];
	$plan_name		 = $row["plan_name"];
	$ProfilePic		 = $row["image_file"];
	$Dob    		 = $row["dob"];
}
?>
<script>
$(document).ready(function(){
       $('#form1').on('submit', function(e){
            e.preventDefault();
        var first_name = $( "input[name='first_name']" ).val();
        var last_name = $( "input[name='last_name']" ).val();
        var mobile = $( "input[name='mobile']" ).val();
        var Phone = $( "input[name='Phone']" ).val();
        var user_id = $( "input[name='user_id']" ).val();
        var id = $( "input[name='id']" ).val();
        var password = $( "input[name='password']" ).val();
        var Confirm_password = $( "input[name='Confirm_password']" ).val();
        var Curpassword = $( "input[name='Curpassword']" ).val();
        var user_name = $( "input[name='user_name']" ).val();
        var Dob = $( "input[name='Dob']" ).val();
        
        $(".error").remove();
     
        if (user_id.length < 1) {
          $("input[name='user_id']").focus();
    	  $("input[name='user_id']").after('<span  class="error" style="color:red;">This field is required</span>');
          return false;
        }
        if (mobile.length < 1) {
          $("input[name='mobile']").focus();
    	  $("input[name='mobile']").after('<span  class="error" style="color:red;">This field is required</span>');
          return false;
        }
        if (Phone.length < 1) {
          $("input[name='Phone']").focus();
    	  $("input[name='Phone']").after('<span  class="error" style="color:red;">This field is required</span>');
          return false;
        }
        if (Dob.length < 1) {
          $("input[name='Dob']").focus();
    	  $("input[name='Dob']").after('<span  class="error" style="color:red;">This field is required</span>');
          return false;
        }
        if (first_name.length < 1) {
          $("input[name='first_name']").focus();
    	  $("input[name='first_name']").after('<span  class="error" style="color:red;">This field is required</span>');
          return false;
        }
        if (last_name.length < 1) {
          $("input[name='last_name']").focus();
    	  $("input[name='last_name']").after('<span  class="error" style="color:red;">This field is required</span>');
          return false;
        }
        if (user_name.length < 1) {
          $("input[name='user_name']").focus();
    	  $("input[name='user_name']").after('<span  class="error" style="color:red;">This field is required</span>');
          return false;
        }
        if (password.length > 0) {
            
            if (Curpassword.length < 1) {
              $("input[name='Curpassword']").focus();
        	  $("input[name='Curpassword']").after('<span  class="error" style="color:red;">This field is required</span>');
              return false;
            }
            else
            {
               if (Confirm_password.length < 1) {
    			    
                  $("input[name='Confirm_password']").focus();
            	  $("input[name='Confirm_password']").after('<span  class="error" style="color:red;">This field is required</span>');
                  return false;
                }
                if (password!=Confirm_password)
            	{
            		$("input[name='Confirm_password']").after('<span  class="error" style="color:red;">Password not matching</span>');
            		return false;
            	}
            }
             URL = "<?php echo SITE_BASE_URL;?>login/CheckCurrentPassword.html?Curpassword=" + Curpassword +"&id=" +id;
                $.ajax({url: URL, success: function(result){
                    if(result!='Yes'){
                        $("input[name='Curpassword']").focus();
                    	$("input[name='Curpassword']").after('<span  class="error" style="color:red;">Wrong password</span>');
                        return false;
                    }
                    else
                    {
                        document.form1.submit();
                    }
                }});
        }
        else
        {
            document.form1.submit();
        }
		//
    });

  
});
</script>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/customfileinputs/component.css">
  
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
              <form class="profile-form"  method="post" accept-charset="utf-8"  action="<?php echo SITE_BASE_URL;?>login/save.html?form=1" method="post" name=form1 id=form1>
                <div class="my-profile-box">
                  <div class="profile-thumb">
                    <img src="<?php echo SITE_BASE_URL?>uploads/ProfilePic/<?php echo $ProfilePic;?>" class="img-fluid" alt="">
                    <p class="text-center"><a href="#" title="" class="change-profile" data-toggle="modal" data-target="#updatePhotoModal" class="btn btn-primary btn-addon" id="">Change Picture</a></p>
                  </div>
                  <div class="profile-details " id="contactInfo">
                    <h2 class="heading-two t3"><?php echo $first_name." ".$last_name;?> <a href="#" class="edit" id="editContact"><i class="icofont-ui-edit"></i> Edit details</a></h2>

                    <div class="row">
                      <div class="col-md-3 form-group">
                        <label>Email</label>
                        <input type="text" class="form-control-plaintext input-select" name="user_id" placeholder="<?php echo $user_id;?>" value="<?php echo $user_id;?>">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control-plaintext input-select" name="mobile" placeholder="<?php echo $phone_no;?>" value="<?php echo $phone_no;?>">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control-plaintext input-select" name="Phone" placeholder="<?php echo $phone_no1;?>"  value="<?php echo $phone_no1;?>">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Date of Birth</label>
                        <input type="text" class="form-control-plaintext input-select date_picker" name="Dob" value="<?php echo $Dob;?>" placeholder="<?php echo $Dob;?>">
                        <span class="input-group-append">
                            <span class="input-group-text">
                                <i class="icon-calender"></i>
                            </span>
                        </span>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-12">
                        <h4 class="t3">Username Details <a href="#" class="edit"><i class="icofont-ui-edit"></i> Edit details</a></h4>
                      </div>
                      <div class="col-md-3 form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control-plaintext input-select" name="first_name" placeholder="<?php echo $first_name;?>" value="<?php echo $first_name;?>">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control-plaintext input-select" name="last_name" placeholder="<?php echo $last_name;?>" value="<?php echo $last_name;?>">
                      </div>
                      
                      <div class="col-md-3 form-group">
                        <label>Username</label>
                        <input type="text" class="form-control-plaintext input-select" name="user_name" placeholder="<?php echo $user_name;?>" value="<?php echo $user_name;?>">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Current Password</label>
                        <input type="password" class="form-control-plaintext input-select" name="Curpassword" placeholder="********">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Change Password</label>
                        <input type="password" class="form-control-plaintext input-select" name="password" placeholder="********">
                      </div>
                      
                      <div class="col-md-3 form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control-plaintext input-select" name="Confirm_password" placeholder="********">
                      </div>
                      <div class="col-md-12">
                        <div class="mt-4">
                          <button type="submit" id="updateContact" class="btn btn-primary br-0">Submit</button>
                          <input type="hidden" class="form-control input-select" value="<?php echo $id;?>" name="id" >
                          <input type="hidden" class="form-control input-select" value="Edit" name="action1" >
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-12">
                        <h4 class="mb-4 t3">Social Media Details <a id="edit-profilr" class="edit"><i class="icofont-ui-edit"></i> Edit details</a></h4>
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
                        <h4 class="mb-3 t3">Copy link & Share</h4>
                      </div>
                      <div class="col-md-5 form-group">
                        <input type="text" id="referLink" class="form-control" placeholder="<?php echo SITE_BASE_URL;?>login/register.html?ReferralCode=<?php echo $key;?>" value="<?php echo SITE_BASE_URL;?>login/register.html?ReferralCode=<?php echo $key;?>">
                      </div>
                      <div class="col-md-3 form-group">
                        <!--<button type="" class="btn btn-outline-primary" onclick="copyText()">Copy</button>-->
                        <a onclick="copyText()" href="#" class="btn btn-outline-primary">Copy</a>
                        <input type='hidden' id='Hashkey1' value='<?php echo $key;?>'>
                      </div>
                      <div class="col-md-3 form-group">
                        <!--<button type="" class="btn btn-outline-primary" data-toggle="modal" data-target="#referFriend">Refer a Friend</button>-->
                        <a class="btn btn-outline-primary" data-toggle="modal" data-target="#referFriend">Refer a Friend</a>
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
       </div>
      <div class="tab-pane fade" id="typeB" role="tabpanel" aria-labelledby="typeB-tab">
        <div class="card h-90">
          <div class="card-body">
            <form class="card-form" method="POST" accept-charset="utf-8" action="<?php echo SITE_BASE_URL;?>login/save.html?form=2" method="post" name=form2 id=form2>
            <body onload="addOption_list()">
              <h2 class="heading-two"><?php echo $first_name." ".$last_name;?></h2>

              <h5 class="sm-heading mb-0">User ID</h5>
              <h4><?php echo $user_id;?></h4>

              <h5 class="sm-heading mt-5">Credit Card Details <a id="editCard" class="edit ml-2"><i class="icofont-ui-edit"></i> Edit card details</a></h5>
            <?php
            \login\loginClass::Init();
            $rows = \login\loginClass::GetAccountCardDatas();
            $i = 1;

            foreach ($rows as $row) 
            {
               
                $auto_id         = $row["auto_id"];
                $id              = $row["user_id"];
                $cardholderName  = $row["cardholder_name"];
                $cardNumber      = $row["card_number"];
                $cvv             = $row["cvv"];
                $expirationDate  = $row["expiration_date"];
                //list($year,$month, $day) = split('[/.-]', $expirationDate);
                $country         = $row["country"];
                $address1        = $row["address1"];
                $address2        = $row["address2"];
                $city            = $row["city"];
                $postalCode      = $row["postal_code"];
                $state           = $row["state"];
                $emailForInvoice = $row["email_address_for_invoice"];
                $companyName     = $row["company_name"];

            ?>
            <div class="cc-deatils mt-4">
             <div class="row">
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Name on Credit Card</label>
                  <input type="text" class="form-control input-select" name="Cardholder_Name" value="<?php echo $cardholderName;?>" placeholder="Name on Credit Card">
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group">
                   <label>Credit Card Number</label>
                  <input type="text" class="form-control input-select" name="Card_Number" value="<?php echo $cardNumber;?>" placeholder="1234 1234 1245 1244">
                 </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group">
                   <label>Expiry</label> 
                   <div class="row">
                     <div class="col">
                       <select class="form-control" name="month_list" >
                         <option value="">Month</option>
                         <option value="<?php echo $month;?>" selected><?php echo $month;?></option>
                         option
                       </select>
                     </div>
                     <div class="col">
                       <select class="form-control" name="year_list">
                         <option value="">Year</option>
                         <option value="<?php echo $year;?>" selected><?php echo $year;?></option>
                         option
                       </select>
                     </div>
                   </div>
                 </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group">
                   <label>CVC <small>What is CVC?</small></label> 
                   <input type="text" class="form-control input-select" value="<?php echo $cvv;?>" name="CVV" placeholder="XXXXX">
                   <input type="hidden" class="form-control input-select" value="<?php echo $id;?>" name="id" >
                   <input type="hidden" class="form-control input-select" value="<?php echo $auto_id;?>" name="auto_id">
                   <input type="hidden" class="form-control input-select" value="Edit" name="action1" >
                 </div>
               </div>
             </div>
           </div>
           <?php 
            }
            ?>  
              <div class="col-md-12">
                <div class="mt-4">
                  <button type="submit" id="updateCard" class="btn btn-primary br-0">Submit</button>
                </div>
              </div>
            </body>
            </form>
        </div>
        </div>
      </div>
      <!-- The Modal -->
        <div class="modal" id="updatePhotoModal">
          <div class="modal-dialog">
            <div class="modal-content">
    
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">CHANGE PROFILE PIC</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
    
              <!-- Modal body -->
              <div class="modal-body">
               <form action="<?php echo SITE_BASE_URL;?>login/SaveUploadFile.html?id=<?php echo $id; ?>" method="post" class="dpo-form" name='form3' enctype="multipart/form-data">
                   <div class="form-group">
                       <input type="file" name="UploadFile">
                   </div>
                   <input class="btn btn-primary" type="submit" name="submit" value="Update">
               </form>
              </div>
            </div>
          </div>
        </div>
      <div class="tab-pane fade" id="typeC" role="tabpanel" aria-labelledby="typeC-tab">
        <div class="card h-90">
          <div class="card-body">
            <form class="profile-form" action="" method="POST" accept-charset="utf-8" >
            
              <h2 class="heading-two"><?php echo $first_name." ".$last_name;?> <a class="edit"><i class="icofont-ui-edit"></i> Edit details</a></h2>

              <h5 class="sm-heading mb-0">User ID</h5>
              <h4>James.bond@bond.com</h4>

              <h5 class="sm-heading mt-5">Credit Card Details <a class="edit ml-2"><i class="icofont-ui-edit"></i> Edit card details</a></h5>

              <div class="row">
                <div class="col-lg-8">
                  <div class="aml-box mt-5">
                <div class="aml-box-inner">
                  <label>Upload id</label>
                  <div class="js">
                     <input type="file" name="name-proof[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                     <label for="file-1"><img src="<?php echo SITE_BASE_URL;?>assets/img/download-icon-sm.png" class="img-fluid" > <span>Upload Proof&hellip;</span></label>
                  </div>
                </div>
                <div class="aml-box-inner">
                  <label>Upload POA</label>
                  <div class="js">
                     <input type="file" name="name-proof[]" id="file-2" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                     <label for="file-2"><img src="<?php echo SITE_BASE_URL;?>assets/img/download-icon-sm.png" class="img-fluid" > <span>Upload Proof&hellip;</span></label>
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
                  <a href="" class="edit-btn" id="target-investment"><img src="<?php echo SITE_BASE_URL;?>assets/img/edit-icon-sm.png" class="img-fluid"> Edit details</a>
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
                  <a href="" class="edit-btn"><img src="<?php echo SITE_BASE_URL;?>assets/img/edit-icon-sm.png" class="img-fluid"> Edit details</a>
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
                  <a href="" class="edit-btn"><img src="<?php echo SITE_BASE_URL;?>assets/img/edit-icon-sm.png" class="img-fluid"> Edit details</a>
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
  <!--===========================Refer a friend=================================-->
  <div class="modal fade dpo-modal" id="referFriend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content dpo-form">
          <div class="modal-header">
            <h5 class="modal-title" id="entityModalLabel">REFER FRIEND</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="<?php echo SITE_BASE_URL;?>Masters/Refer.html" method="post" name='form12'>    
              <!-- refer frien section -->
              <div class="card-body">
                  <div class="widget-title">
                    <h3>Refer To Your Friends</h3>
                    <input type='hidden' Name='Hashkey' value='<?php echo $key;?>'>
                  </div>
                  <form class="dpo-form">
                    <div class="input_fields_wrap">
                    
                      <div class="form-group">
                        <label>Friend's Email</label>
                        <input class="form-control" type="text" name="friend_email[]" placeholder="Email Address">
                      </div>

                    </div>
                    <button class="btn btn-info add_field_button">Add More Freind</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                  </form>
                </div>       
              <!-- end refer friend section -->
              </form>

               
            </div>
          </div>
      </div>
    </div>
  <!--==========================================================================-->

<?php include"footer.php"; ?>

<script src="<?php echo SITE_BASE_URL;?>assets/plugins/customfileinputs/custom-file-input.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
         $(".date_picker").datepicker({
   
          setDate: new Date(),
          format: 'yyyy-mm-dd',
          todayHighlight: true,
          autoclose: true,
       
       });
       
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
<script>
    function addOption(selectbox, text, value) {
        var optn = document.createElement("option");
        optn.text = text;
        optn.value = value;
        selectbox.options.add(optn);
    }
    function addOption_list() {
        alert();
        var d = new Date();
    	var n = d.getFullYear();
        for (var i=1; i <= 12;++i) {
            addOption(document.form2.month_list,i,i);
        }
        for (var i=n; i < n+100;++i) {
            addOption(document.form2.year_list,i,i);
        }
    }
    function copyText() {
  /* Get the text field */
  var copyText = document.getElementById("referLink");
  var Hashkey = document.getElementById("Hashkey1").value;
  URL = "<?php echo SITE_BASE_URL;?>Masters/CopyText.html?ReferralCode=" + Hashkey;
  $.ajax({url: URL, success: function(result){
        if (result.trim() == "success"){
        	    $.ajax({url: URL, success: function(result){
                    alert("copied Successfully");
                }});  
        }
        else{
            alert("Error while copy : \n" + result);
        }
    }});
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");

  var btn = document.getElementById("copyBtn");

  btn.innerHTML = 'Copied';

  $("#copyBtn").addClass('newBtn');
}
</script>