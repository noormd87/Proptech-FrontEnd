<?php include"header.php"; ?>
<script src="<?php echo SITE_BASE_URL; ?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<?php






\login\loginClass::Init();
$rows = \login\loginClass::GetAccountDatas();
//print_r($rows);
$i = 1;
$key = hash("sha256", $LoginUserName, false);
foreach ($rows as $row) {
//    print_r($row);
    $id = $row["id"];
    $user_id = $row["user_id"];
    $user_name = $row["user_name"];
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $phone_no = $row["phone_no"];
    $default_language = $row["default_language"];
    $phone_no1 = $row["phone_no1"];
    $subscription_id = $row["subscription_id"];
    $tags = $row["tags"];
    $currnt_points = $row["currnt_points"];
    $created_on = $row["created_on"];
    $address = $row["address"];
    $Acc_Auto_id = $row["current_acc_auto_id"];
    $IsAdmin = $row["is_admin"];
    $period_type = $row["period_type"];
    $plan_name = $row["plan_name"];
    $ProfilePic = $row["image_file"];
    $Dob = $row["dob"];
    $Dob = date('d/m/Y', strtotime($Dob));
    
    
    $UIdArr = \DBConn\DBConnection::getQuery("(SELECT COUNTRY,CITY,POSTAL_CODE FROM user_account_details where USER_ID = '{$id}')");
   

    
        foreach ($UIdArr as $UIdAr) {
//             print_r($id);
    $Postal_Code =$UIdAr['POSTAL_CODE'];
$country= strtolower($UIdAr['COUNTRY']);
$country1= strtolower($UIdAr['COUNTRY']);
        $City=$UIdAr['CITY'];
        
        
           $countryArr = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNTRY_NAME FROM country_master where Upper(country_code_new)=Upper('" . $country . "') )");
        $country = $countryArr["0"];
        
        }

    $aml_fname = $row["aml_fname"];
    $aml_lname = $row["aml_lname"];
    $aml_email = $row["aml_email"];
    $aml_mobile = $row["aml_mobile"];
    $aml_subscription = $row["aml_subscription"];
    $aml_subscription_unit = $row["aml_subscription_unit"];
    $aml_bank_account = $row["aml_bank_account"];
    $aml_street_number = $row["aml_street_number"];
    $aml_street_name = $row["aml_street_name"];
    $aml_city = $row["aml_city"];
    $aml_suburb = $row["aml_suburb"];
    $aml_country = $row["aml_country"];
    $aml_tax_number = $row["aml_tax_number"];
    $aml_source_funds = $row["aml_source_funds"];
    $aml_subscription_form_id = $row["aml_subscription_form_id"];
    $aml_subscription_form_address = $row["aml_subscription_form_address"];
    $aml_subscriber_funds_source = $row["aml_subscriber_funds_source"];
    $aml_upload_id = $row["aml_upload_id"];
    $aml_upload_bank_statement = $row["aml_upload_bank_statement"];
    $aml_upload_address = $row["aml_upload_address"];
    $aml_upload_source_funds = $row["aml_upload_source_funds"];
    $invest_upload_1 = $row["invest_upload_1"];
    $invest_upload_2= $row["invest_upload_2"];
    
    
    
 $ArrQueries = array();
                    $queryStr = "update user_master set is_first_time=:is_first_time
                	where user_id=:user_id";
                    $ColValarray = array("is_first_time" => 1, "user_id" => $user_id);
                    $Queryarray = array($queryStr, $ColValarray);
                    $ArrQueries[] = $Queryarray;
                    $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
}
//echo $aml_upload_id;
?>
<script>
    $(document).ready(function () {
        $('#form1').on('submit', function (e) {
            e.preventDefault();
            var first_name = $("input[name='first_name']").val();
            var last_name = $("input[name='last_name']").val();
            var mobile = $("input[name='mobile']").val();
            // var Phone = $( "input[name='Phone']" ).val();
            var user_id = $("input[name='user_id']").val();
            var id = $("input[name='id']").val();
            var password = $("input[name='password']").val();
            var Confirm_password = $("input[name='Confirm_password']").val();
            var Curpassword = $("input[name='Curpassword']").val();
            var user_name = $("input[name='user_name']").val();
            var Dob = $("input[name='Dob']").val();

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
            //  if (Phone.length < 1) {
            //   $("input[name='Phone']").focus();
            //	  $("input[name='Phone']").after('<span  class="error" style="color:red;">This field is required</span>');
            //    return false;
            //   }
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
                if (password.length < 8) {
                    $("input[name='password']").focus();
                    $("input[name='password']").after('<span  class="error" style="color:red;">Min. 8 characters required</span>');
                    return false;
                }
                if (Curpassword.length < 1) {
                    $("input[name='Curpassword']").focus();
                    $("input[name='Curpassword']").after('<span  class="error" style="color:red;">This field is required</span>');
                    return false;
                } else
                {

                    if (Confirm_password.length < 1) {

                        $("input[name='Confirm_password']").focus();
                        $("input[name='Confirm_password']").after('<span  class="error" style="color:red;">This field is required</span>');
                        return false;
                    } else
                    {
                        if (Confirm_password.length < 8) {
                            $("input[name='Confirm_password']").focus();
                            $("input[name='Confirm_password']").after('<span  class="error" style="color:red;">Min. 8 characters required</span>');
                            return false;
                        }
                    }
                    if (password != Confirm_password)
                    {
                        $("input[name='Confirm_password']").after('<span  class="error" style="color:red;">Password not matching</span>');
                        return false;
                    }
                }
                URL = "<?php echo SITE_BASE_URL; ?>login/CheckCurrentPassword.html?Curpassword=" + Curpassword + "&id=" + id;
                $.ajax({url: URL, success: function (result) {
                        if (result != 'Yes') {
                            $("input[name='Curpassword']").focus();
                            $("input[name='Curpassword']").after('<span  class="error" style="color:red;">Wrong password</span>');
                            return false;
                        } else
                        {
                            document.form1.submit();
                        }
                    }});
            } else
            {
                document.form1.submit();
            }
            //
        });


    });
</script>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL; ?>assets/plugins/customfileinputs/component.css">
<div class="inner-wrapper">
    <div class="panel panel-black panel-advisor d-none">
        <div class="panel-title">
            <h2>My Profile Completion Scale</h2>
        </div>
        <div class="panel-body">
            <div class="d-flex align-items-center">
                <div class="progress-bar-holder">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 75%"
                             aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="progress-text d-flex justify-content-between">
                        <span>0%</span>
                        <span>25%</span>
                        <span>50%</span>
                        <span>75%</span>
                        <span>100%</span>
                    </div>
                </div>
                <div class="progress-circle">
                    <div class="circle-text">
                        GOAL REACHED 1000 POINTS
                    </div>
                </div>
            </div>

            <p class="progress-descriptions">Well Done! Your Profile is sitting at <span
                    class="text-primary">78%</span> completed. Hit 100% within 30 days of signing up and
                receive 1000 points as a gift from us to get you going.</p>


        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-black panel-advisor">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab1" role="tab"
                           aria-controls="tab1" aria-selected="true">My Profile</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab11" role="tab"
                           aria-controls="tab11" aria-selected="false">PAYMENT INFORMATION</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " id="contact-tab" data-toggle="tab" href="#tab111" role="tab"
                           aria-controls="tab111" aria-selected="false">AML INFO</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab1111" role="tab"
                           aria-controls="tab1111" aria-selected="false">INVESTMENT GOALS</a>
                    </li>
                </ul>
                <div class="tab-content tab-panels" id="mytabs">
                    <div class="tab-pane fade active show" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                        <form class="profile-form"  method="post" accept-charset="utf-8"  action="<?php echo SITE_BASE_URL; ?>login/save.html?form=1" method="post" name=form1 id=form1>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="well well-action">
                                            <a href="#" title="" class="float-right change-profile" data-toggle="modal" data-target="#updatePhotoModal" class="btn btn-primary btn-addon" id="">edit</a>
                                            <h5>1. Profile Picture</h5>
                                            <?php
                                            if ($ProfilePic=='') {
                                                 ?><img src="<?php echo SITE_BASE_URL ?>assets/images/john-doe.jpg" alt="" class="d-block img-fluid rounded-circle mb-3 mt-3"/><?php    
                                            } else{
                                            ?><img src="<?php echo SITE_BASE_URL ?>uploads/ProfilePic/<?php echo $ProfilePic; ?>" alt="" class="d-block img-fluid rounded-circle mb-3 mt-3"/><?php    
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="well well-action">
                                            <a href="#" class="float-right edit" id="editContact">edit</a>
                                            <h5>2. Name & DOB</h5>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-3">
                                                        <label for="first_name">First Name</label>
                                                        <input type="text" id="first_name" name="first_name" class="form-control" value="<?= $first_name; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-3">
                                                        <label for="last_name">Last Name</label>
                                                        <input type="text" id="last_name" name="last_name" class="form-control" value="<?= $last_name; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group mb-3">
                                                        <label for="email">Email</label>
                                                        <input type="text" class="form-control input-select" name="user_id" placeholder="<?php echo $user_id; ?>" value="<?php echo $user_id; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group mb-3">
                                                        <label for="dob">DOB dd/mm/yyyy</label>

                                                        <input type="text" id="dob" name="Dob" class="form-control mydatepicker date_picker" value="<?php echo $Dob; ?>"  placeholder="<?php echo $Dob; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="well well-action">
                                    <a href="#" class="float-right edit">edit</a>
                                    <h5>3. Address & Phone</h5>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group mb-3">
                                                <label for="address1">Address</label>
                                                <input type="text" class="form-control input-select" name="Address1" placeholder="Address" value="<?php echo $address; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-3">
                                                <label for="City">Town / City</label>
                                                <input type="text" id="City" name="City" class="form-control" value="<?=$City?>"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-3">
                                                <label for="country_selector">Country</label>
                                                <input class="form-control" id="country_selector" name="country_selector" type="text"  placeholder="" autocomplete="new-password" value="<?=$country?>">

                                                <input value="<?= strtolower($country1)?>" type="hidden" class="form-control" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" autocomplete="new-password"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-lg-4" >
                                            <div class="form-group mb-3">

                                                <label for="Postal_Code">Postal Code</label>
                                                <input type="text" class="form-control" name="Postal_Code" id="Postal_Code" placeholder="Postal Code" value="<?=$Postal_Code?>">  

                                                        </div>
                                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-3">
                                                <label for="mobile">Phone Number</label>
                                                <input type="text" class="form-control phone-selecter" name="mobile" placeholder="<?php echo $phone_no; ?>" value="<?php echo $phone_no; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group mb-3">
                                                <label for="default_language">Language Preference </label>
                                                <select class="form-control" data-selected="<?=$default_language?>" name="default_language" id="default_language" >
                                                    <option <?if ($default_language =='English') echo 'selected';?> value="English">English</option>
                                                    <option <?if ($default_language =='TraditionalChinese') echo 'selected';?>  value="TraditionalChinese">Traditional Chinese</option>
                                                    <option <?if ($default_language =='SimplifiedChinese') echo 'selected';?>  value="SimplifiedChinese">Simplified Chinese</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="well well-action">
                                    <a href="#none" class="float-right edit" onclick="$('.passchange').show();  $('#updateContact').fadeIn();">edit</a>
                                    <h5>4. User Name & Password</h5>
                                    <div class="row passchange" style="display:none">
                                        <div class="col-sm-4">
                                            <div class="form-group mb-3">
                                                <label for="uuu">Username</label>
                                                <input type="text" class="form-control input-select" name="user_name" placeholder="<?php echo $user_name; ?>" value="<?php echo $user_name; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-3">
                                                <label for="pwww">current Password</label>
                                                <input type="password" class="form-control input-select" name="Curpassword" placeholder="********">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-3">
                                                <label for="pwww">Change Password</label>
                                                <input type="password" class="form-control input-select" name="password" placeholder="********">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-3">
                                                <label for="pwww">Confirm Password</label>
                                                <input type="password" class="form-control input-select" name="Confirm_password" placeholder="********">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mt-4">
                                        <button type="submit" id="updateContact" class="btn btn-default btn-max">Submit</button>
                                        <input type="hidden" class="form-control input-select" value="<?php echo $id; ?>" name="id" >
                                        <input type="hidden" class="form-control input-select" value="Edit" name="action1" >
                                    </div>
                                </div>



                                <div class="well well-action well-white">
                                    <a href="#" class="float-right">edit details</a>
                                    <h5>5. Social Media Details</h5>
                                    <p>Link your social media accounts to keep up to dates with our exclusive offers</p>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group mb-3 mt-3 icon">
                                                <img src="<?php echo SITE_BASE_URL; ?>assets/images/fb.svg" />  jamesbond
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group mb-3 mt-3 icon">
                                                <img src="<?php echo SITE_BASE_URL; ?>assets/images/in.svg" />  jamesbond
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group mb-3 mt-3 icon">
                                                <img src="<?php echo SITE_BASE_URL; ?>assets/images/ins.svg" />  jamesbond
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group mb-3 mt-3 icon">
                                                <img src="<?php echo SITE_BASE_URL; ?>assets/images/tw.svg" />  jamesbond
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="well well-action well-white">
                                    <h5>5. Copy Link &Share</h5>
                                    <div class="row sharing">
                                        <div class="col-sm-6">
                                            <input type="text" id="referLink" class="form-control" placeholder="<?php echo SITE_BASE_URL; ?>login/register.html?ReferralCode=<?php echo $key; ?>" value="<?php echo SITE_BASE_URL; ?>login/register.html?ReferralCode=<?php echo $key; ?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type='hidden' id='Hashkey1' value='<?php echo $key; ?>'>
                                            <button type="button" onclick="copyText()" class="btn btn-secondary btn-block btn-secondary4">Copy</button>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" data-toggle="modal" data-target="#referFriend" class="btn btn-secondary btn-block btn-secondary4">Invite a Friend</button>
                                        </div>
                                    </div>
                                    <ul class="list-inline mt-3">
                                        <li>
                                            <img src="<?php echo SITE_BASE_URL; ?>assets/images/fb.svg" alt=""/>
                                        </li>
                                        <li>
                                            <img src="<?php echo SITE_BASE_URL; ?>assets/images/tw.svg" alt=""/>
                                        </li>
                                        <li>
                                            <img src="<?php echo SITE_BASE_URL; ?>assets/images/in.svg" alt=""/>
                                        </li>
                                        <li>
                                            <img src="<?php echo SITE_BASE_URL; ?>assets/images/ins.svg" alt=""/>
                                        </li>
                                    </ul>
                                </div>
                                <!--<hr />-->
                                <!--<div class="text-right form-group mb-3 mt-3">-->
                                <!--    <button type="button" class="btn btn-default btn-max">Save</button>-->
                                <!--    <button type="button" class="btn btn-default btn-max">Next &raquo; </button>-->
                                <!--</div>-->
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="tab11" role="tabpanel" aria-labelledby="tab11-tab">
                        <div class="panel-body">
                            <a href="#" class="float-right">edit</a>
                            <h1 class="d-none"><?= $$LoginFirstName . " " . $LoginLastName ?></h1>
                            <form class="card-form" method="POST" accept-charset="utf-8" action="<?php echo SITE_BASE_URL; ?>login/save.html?form=2" method="post" name=form2 id=form2>
                                <div class="row">
<?php
\login\loginClass::Init();
$rows = \login\loginClass::GetAccountCardDatas();
$i = 1;
foreach ($rows as $row) {

    $auto_id = $row["auto_id"];
    $id = $row["user_id"];
    $cardholderName = $row["cardholder_name"];
    $cardNumber = $row["card_number"];
    $cvv = $row["cvv"];
    $expirationDate = $row["expiration_date"];
    $country = $row["country"];
    $address1 = $row["address1"];
    $address2 = $row["address2"];
    $city = $row["city"];
    $postalCode = $row["postal_code"];
    $state = $row["state"];
    $emailForInvoice = $row["email_address_for_invoice"];
    $companyName = $row["company_name"];
}
?>
                                    <div class="col-md-8">
                                        <div class="well well-action">
                                            <a href="#" id="editCard" class="float-right">edit</a>
                                            <h5>Credit Card Details</h5>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-3">
                                                        <label for="card">Name on Credit Card</label>
                                                        <input type="text" class="form-control input-select" name="Cardholder_Name" value="<?php echo $cardholderName; ?>" placeholder="Name on Credit Card">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-3">
                                                        <label for="exp">Expiry</label>
                                                        <div class="row no-gutters">
                                                            <div class="col-sm-4">
                                                                <input type="text" id="exp1"  name="month_list" class="form-control" value="05"/>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="exp2" name="year_list" class="form-control" value="2025"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-3">
                                                        <label for="cnumber">Credit Card Number</label>
                                                        <input type="text" class="form-control input-select" name="Card_Number" value="<?php echo $cardNumber; ?>" placeholder="1234 1234 1245 1244">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-3">
                                                        <label for="csv">CVC</label>
                                                        <input type="text" id="csv" name="CVV" class="form-control" value="<?php echo $cvv; ?>"/>
                                                        <input type="hidden" class="form-control input-select" value="<?php echo $id; ?>" name="id" >
                                                        <input type="hidden" class="form-control input-select" value="<?php echo $auto_id; ?>" name="auto_id">
                                                        <input type="hidden" class="form-control input-select" value="Edit" name="action1" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="<?php echo SITE_BASE_URL; ?>assets/images/Group 315.png" alt="" class="img-fluid mb-3 mt-3"/>
                                    </div>
                                </div>
                               
                                <hr />
                                <div class="text-right form-group mb-3 mt-3">
                                    <button type="submit" id="updateCard" class="btn btn-default btn-max">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab111" role="tabpanel" aria-labelledby="tab111-tab">
                        <form enctype="multipart/form-data" class="card-form" method="POST" accept-charset="utf-8" action="<?php echo SITE_BASE_URL; ?>login/save.html?form=3" method="post" name=form3 id=form3> 
                            <input type="hidden" class="form-control input-select" value="<?php echo $id; ?>" name="id" >
                            <div class="panel-body">

                                <div class="well aml-well">
                                    <div class="d-flex align-items-start justify-content-between">
                                        <div class="col-xl-6 col-lg-8 p-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_fname">First Name</label>
                                                        <input class="form-control" type="text" placeholder="First Name" name="aml_fname" id="aml_fname" value="<?= $aml_fname ?>">
                                                        <span>(proof required)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_lname">Last Name</label>
                                                        <input class="form-control" type="text" placeholder="Last Name" id="aml_lname" name="aml_lname" value="<?= $aml_lname ?>">
                                                        <span>(proof required)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_email">Email</label>
                                                        <input class="form-control" type="email" placeholder="Email" id="aml_email" name="aml_email" value="<?= $aml_email ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_mobile">Mobile</label>
                                                        <input class="form-control phone-selecter" type="text" placeholder="Mobile" id="aml_mobile" name="aml_mobile" value="<?= $aml_mobile ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-upload">
<?
if ($aml_upload_id != '') {
    ?> <img src="<?php echo SITE_BASE_URL ?>uploads/ProfilePic/<?php echo $aml_upload_id; ?>" alt="" class="img-fluid rounded-circle mb-3 mt-3"/><p><a target="_BLANK" href="<?php echo SITE_BASE_URL ?>uploads/ProfilePic/<?php echo $aml_upload_id; ?>">Download</a></p><?
}
?>
                                            <div class="uploader">
                                                <input type="file" name="aml_upload_id" id="aml_upload_id">
                                                <img src="<?php echo SITE_BASE_URL; ?>assets/images/upload.svg" alt="">
                                            </div>
                                            <p>Drivers Licence</p>
                                            <p>Passport</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="well aml-well" style="display: none">
                                    <div class="d-flex align-items-start justify-content-between">
                                        <div class="col-xl-6 col-lg-8 p-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_subscription">Subscription</label>
                                                        <input class="form-control" type="text" placeholder="Username" id="aml_subscription" name="aml_subscription" value="<?= $aml_subscription ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_subscription_unit">Subscription Units</label>
                                                        <input class="form-control" type="text" placeholder="Units" id="aml_subscription_unit" name="aml_subscription_unit" value="<?= $aml_subscription_unit ?>">
                                                        <span>(being 1 Unit per $1 of Subscription Amount)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_bank_account">Bank Account</label>
                                                        <input class="form-control" type="email" placeholder="Account Number" id="aml_bank_account" name="aml_bank_account" value="<?= $aml_bank_account ?>">
                                                        <span>(proof required)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-upload">
<?
if ($aml_upload_bank_statement != '') {
    ?> <img src="<?php echo SITE_BASE_URL ?>uploads/ProfilePic/<?php echo $aml_upload_bank_statement; ?>" alt="" class="img-fluid rounded-circle mb-3 mt-3"/><p><a target="_BLANK" href="<?php echo SITE_BASE_URL ?>uploads/ProfilePic/<?php echo $aml_upload_bank_statement; ?>">Download</a></p><?
}
?>
                                            <div class="uploader">
                                                <input type="file" id="aml_upload_bank_statement" name="aml_upload_bank_statement">
                                                <img src="<?php echo SITE_BASE_URL; ?>assets/images/upload.svg" alt="">
                                            </div>
                                            <p>Bank statement showing sources of business revenue or income.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="well aml-well">
                                    <h5>ADDRESS</h5>
                                    <div class="d-flex align-items-start justify-content-between">
                                        <div class="col-xl-6 col-lg-8 p-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_street_number">Street Number</label>
                                                        <input class="form-control" type="text" placeholder="Street Number" id="aml_street_number" name="aml_street_number" value="<?= $aml_street_number ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_street_name">Street Name</label>
                                                        <input class="form-control" type="text" placeholder="Street Name" name="aml_street_name" id="aml_street_name" value="<?= $aml_street_name ?>">
                                                        <span>(proof required)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_city">City</label>
                                                        <input class="form-control" type="text" placeholder="City" id="aml_city" name="aml_city" value="<?= $aml_city ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_suburb">Suburb</label>
                                                        <input class="form-control" type="text" placeholder="Suburb" id="aml_suburb" name="aml_suburb" value="<?= $aml_suburb ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_country">Country</label>
                                                        <input class="form-control" type="text" placeholder="Country" id="aml_country" name="aml_country" value="<?= $aml_country ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-upload">
<?
if ($aml_upload_address != '') {
    ?> <img src="<?php echo SITE_BASE_URL ?>uploads/ProfilePic/<?php echo $aml_upload_address; ?>" alt="" class="img-fluid rounded-circle mb-3 mt-3"/><p><a target="_BLANK" href="<?php echo SITE_BASE_URL ?>uploads/ProfilePic/<?php echo $aml_upload_address; ?>">Download</a></p><?
}
?>
                                            <div class="uploader">
                                                <input type="file" id="aml_upload_address" name="aml_upload_address">
                                                <img src="<?php echo SITE_BASE_URL; ?>assets/images/upload.svg" alt="">
                                            </div>
                                            <p>A physical address (Bank statement, utility bill etc dated within the last 3 months)</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="well aml-well" style="display: none">
                                    <div class="d-flex align-items-start justify-content-between">
                                        <div class="col-xl-6 col-lg-8 p-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_tax_number"><small>Subscriber IRD / Tax Identification Number</small></label>
                                                        <input class="form-control" type="text" placeholder="ID Number" id="aml_tax_number" name="aml_tax_number" value="<?= $aml_tax_number ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="aml_source_funds"><small>Subscriber Source of Funds</small></label>
                                                        <input class="form-control" type="text" placeholder="Funds Source" id="aml_source_funds" name="aml_source_funds" value="<?= $aml_source_funds ?>">
                                                        <span>(proof required)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-upload">
<?
if ($aml_upload_source_funds != '') {
    ?> <img src="<?php echo SITE_BASE_URL ?>uploads/ProfilePic/<?php echo $aml_upload_source_funds; ?>" alt="" class="img-fluid rounded-circle mb-3 mt-3"/><p><a target="_BLANK" href="<?php echo SITE_BASE_URL ?>uploads/ProfilePic/<?php echo $aml_upload_source_funds; ?>">Download</a></p><?
}
?>
                                            <div class="uploader">
                                                <input type="file" id="aml_upload_source_funds" name="aml_upload_source_funds">
                                                <img src="<?php echo SITE_BASE_URL; ?>assets/images/upload.svg" alt="">
                                            </div>
                                            <p>*Source of Funds (see list below)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="well aml-well" style="display: none">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="aml_subscription_form_id"><small>Subscriber Form of ID</small></label>
                                                <input class="form-control" type="text" placeholder="ID" id="aml_subscription_form_id" name="aml_subscription_form_id" value="<?= $aml_subscription_form_id ?>">
                                                <span>(proof required)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="aml_subscription_form_address"><small>Subscriber Form of Address</small></label>
                                                <input class="form-control" type="text" placeholder="Funds Source" id="aml_subscription_form_address" name="aml_subscription_form_address" value="<?= $aml_subscription_form_address ?>">
                                                <span>(proof required)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="aml_subscriber_funds_source"><small>Subscriber Source of Funds</small></label>
                                                <input class="form-control" type="text" placeholder="Funds Source" name="aml_subscriber_funds_source" id="aml_subscriber_funds_source" value="<?= $aml_subscriber_funds_source ?>">
                                                <span>(proof required)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="bg-secondary" >NOTE: On completion of receipt of the AML documents you may begin to reserve properties through our online platform</p>
                                <hr />
                            </div>
                            <div class="col-12">
                                <div class="text-right form-group mb-3 mt-3">
                                    <button type="submit" class="btn btn-default btn-max"  id="updateAML">Update</button>
                                </div>
                            </div>
                            <input type="hidden" class="form-control input-select" name="user_id" placeholder="<?php echo $user_id; ?>" value="<?php echo $user_id; ?>">

                            <input type="hidden" class="form-control input-select" value="<?php echo $auto_id; ?>" name="auto_id">
                            <input type="hidden" class="form-control input-select" value="Edit" name="action1" >
                        </form>
                    </div>
                    <div class="tab-pane fade" id="tab1111" role="tabpanel" aria-labelledby="tab1111-tab">
                        <form enctype="multipart/form-data" class="card-form" method="POST" accept-charset="utf-8" action="<?php echo SITE_BASE_URL; ?>login/save.html?form=4" method="post" name=form4 id=form4> 
                            <input type="hidden" class="form-control input-select" value="<?php echo $id; ?>" name="id" >
                            <div class="panel-body">
                                <a href="#" class="float-right d-none">edit</a>
                                <h1 class="d-none">James Bond</h1>
                                <!--<h5>User ID</h5>-->
                                <div class="mb-3">
                                <input type="text" style="margin-bottom: 30px;" class="form-control" id="tags" name="tags" value="<?=$tags?>">
                                </div>
                                <div class="row d-none">
                                    <div class="col-sm-6">
                                        <div class="well aml-well mb-4">
                                            <div class="doc-upload">
<?
if ($invest_upload_1 != '') {
    ?> <img src="<?php echo SITE_BASE_URL ?>uploads/ProfilePic/<?php echo $invest_upload_1; ?>" alt="" class="img-fluid rounded-circle mb-3 mt-3"/><?
}
?>
                                                <div class="uploader">
                                                    <input type="file" name="invest_upload_1" id="invest_upload_1">
                                                    <img src="<?php echo SITE_BASE_URL; ?>assets/images/upload.svg" alt="">
                                                </div>
                                            </div>
                                            <i class="far fa-file-alt"></i> <?= $invest_upload_1 ?>
<?
if ($invest_upload_1 != '') {
    ?> <p class="download-item"><a target="_BLANK" href="<?php echo SITE_BASE_URL ?>uploads/ProfilePic/<?php echo $invest_upload_1; ?>"><i class="fas fa-download"></i></a></p><?
}
?>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="well aml-well mb-4">
                                            <div class="doc-upload">
<?
if ($invest_upload_2 != '') {
    ?> <img src="<?php echo SITE_BASE_URL ?>uploads/ProfilePic/<?php echo $invest_upload_2; ?>" alt="" class="img-fluid rounded-circle mb-3 mt-3"/><?
}
?>
                                                <div class="uploader">
                                                    <input type="file" name="invest_upload_2" id="invest_upload_2">
                                                    <img src="<?php echo SITE_BASE_URL; ?>assets/images/upload.svg" alt="">
                                                </div>
                                            </div>
                                           <i class="far fa-file-alt"></i> <?= $invest_upload_2 ?>
<?
if ($invest_upload_2 != '') {
    ?> <p class="download-item"><a target="_BLANK" href="<?php echo SITE_BASE_URL ?>uploads/ProfilePic/<?php echo $invest_upload_2; ?>"><i class="fas fa-download"></i></a></p><?
}
?>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right form-group mb-3 mt-3">
                                    <button type="submit" class="btn btn-default btn-max">Submit</button>
                                </div>
                            </div> <input type="hidden" class="form-control input-select" name="user_id" placeholder="<?php echo $user_id; ?>" value="<?php echo $user_id; ?>">

                            <input type="hidden" class="form-control input-select" value="<?php echo $auto_id; ?>" name="auto_id">
                            <input type="hidden" class="form-control input-select" value="Edit" name="action1" >
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="pricing-panel mt-0">

                <div class="text way-text">
                    <h6>Ways to earn</h6>
                    <!--<p>You will earn 1 Du Val Club point for every US$1 you spend on Du Val properties, and for every friend you refer who becomes a member you will earn an additional 1000 points.</p>-->
                </div>
                 <?php
    \login\loginClass::Init();
    $rows = \login\loginClass::GetReferredCount();
    $i = 1;
    foreach ($rows as $row) {
        $ReferredCount = $row["Count"];
    }
    $rows1 = \login\loginClass::GetReferredEarn();
    $i = 1;
    foreach ($rows1 as $row1) {
        $ReferredEarn = $row1["Count"];
    }
    ?>  
                <div class="row">
                    <div class="col-md-6">
                        <div class="person-count">
                            <div class="text">
                                <span><?php echo $ReferredCount; ?></span>
                                <p>Total Referred</p>
                            </div>
                            <div class="pc-img-holder">
                                <img src="<?php echo SITE_BASE_URL; ?>dashboard/assets/images/total_referred.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="person-count">
                            <div class="text">
                                <span><?php echo $ReferredCount; ?></span>
                                <p>Total Joined</p>
                            </div>
                            <div class="pc-img-holder">
                                <img src="<?php echo SITE_BASE_URL; ?>dashboard/assets/images/total_joined.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="p">The Du Val Rewards programme operates in much the same way as airline memberships: we
reward you for buying property and for referring your friends the network. Earn points and move up through the tiers
and enjoy all the benefits that come with it.</p>
                    </div>
                    <div class="col-12">
                        <h6>Ways to Collect Du Val Points</h6>
                        
                        <table>
                            <tr>
                                <td>
                                    1 Point 
                                </td>
                                <td>
                                    for every 1 USD spend purchasing property (credited at time of unconditional exchange of contracts) 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    50,000 Points 
                                </td>
                                <td>
                                    for purchasing an annual subscription 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    75,000 Points 
                                </td>
                                <td>
                                    for renewing an annual subscription 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    20,000 Points 
                                </td>
                                <td>
                                    for referring any friend who becomes an annual subscriber 
                                </td>
                            </tr> 
                        </table>
                    </div>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade" id="gold">
                        <div class="level">
                            <span>Your Tier Level</span>
                            <h4>Gold</h4>
                        </div>
                        <div class="points">
                            <span>Your Points</span>
                            <h3>30,000</h3>
                        </div>
                        <p>You require XXXX points to upgrade to the next tier</p>
                    </div>
                    <div class="tab-pane fade" id="platinum">
                        <div class="level">
                            <span>Your Tier Level</span>
                            <h4>DIAMOND</h4>
                        </div>
                        <div class="points">
                            <span>Your Points</span>
                            <h3>20,000</h3>
                        </div>
                        <p>Need 30,000 more points to upgrade to Jade</p>
                    </div>
                    <div class="tab-pane active" id="diamond">
                        <div class="level">
                            <span>Your Tier Level</span>
                            <h4>DIAMOND</h4>
                        </div>
                        <div class="points">
                            <span>Your Points</span>
                            <h3>20,000</h3>
                        </div>
                        <p>Need 30,000 more points to upgrade to Jade</p>
                    </div>
                    <div class="tab-pane fade" id="jade">
                        <div class="level">
                            <span>Your Tier Level</span>
                            <h4>DIAMOND</h4>
                        </div>
                        <div class="points">
                            <span>Your Points</span>
                            <h3>20,000</h3>
                        </div>
                        <p>Need 30,000 more points to upgrade to Jade</p>

                    </div>
                </div>
                <!-- Nav pills -->
                <div class="center-pills">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#gold">Gold</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#platinum">Platinum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#diamond">Diamond</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#jade">Jade</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
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
                <form action="<?php echo SITE_BASE_URL; ?>login/SaveUploadFile.html?id=<?php echo $id; ?>" method="post" class="dpo-form" name='form3' enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="UploadFile">
                        <input type="hidden" name="previous_image" value="uploads/ProfilePic/<?php echo $ProfilePic; ?>" >
                    </div>
                    <input class="btn btn-primary" type="submit" name="submit" value="Update">
                </form>
            </div>
        </div>
    </div>
</div>
<?php include"footer.php"; ?>

<script src="<?php echo SITE_BASE_URL; ?>javascripts/country-picker-flags/build/js/countrySelect.js"></script>
        <link rel="stylesheet" href="<?php echo SITE_BASE_URL; ?>javascripts/country-picker-flags/build/css/countrySelect.css">

            <script>

                                                                            $("#country_selector").countrySelect({
 // defaultCountry: "<?=$country?>",
                                                                                preferredCountries: ['hk', 'cn', 'my', 'sg', 'in', 'tw']

                                                                            });

            </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js" integrity="sha512-DNeDhsl+FWnx5B1EQzsayHMyP6Xl/Mg+vcnFPXGNjUZrW28hQaa1+A4qL9M+AiOMmkAhKAWYHh1a+t6qxthzUw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" integrity="sha512-yye/u0ehQsrVrfSd6biT17t39Rg9kNc+vENcCXZuMz2a+LWFGvXUnYuWUW6pbfYj1jcBb/C39UZw2ciQvwDDvg==" crossorigin="anonymous" />

<script src="<?php echo SITE_BASE_URL; ?>assets/plugins/customfileinputs/custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js" integrity="sha512-wTIaZJCW/mkalkyQnuSiBodnM5SRT8tXJ3LkIUA/3vBJ01vWe5Ene7Fynicupjt4xqxZKXA97VgNBHvIf5WTvg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css" integrity="sha512-uKwYJOyykD83YchxJbUxxbn8UcKAQBu+1hcLDRKZ9VtWfpMb1iYfJ74/UIjXQXWASwSzulZEC1SFGj+cslZh7Q==" crossorigin="anonymous" />
<script type="text/javascript">
                                                $(document).ready(function () {
                                                    
                                                                            var input = document.querySelector(".phone-selecter");

                                                                            window.intlTelInput(input, {

                                                                                // any initialisation options go here

                                                                                initialCountry: "nz",

                                                                                nationalMode: true,

                                                                                placeholderNumberType: "MOBILE",

                                                                                separateDialCode: false,

                                                                            });
                                               jQuery('.mydatepicker, #datepicker').datepicker({

                                                                                    autoclose: true,
                                                        format: 'dd/mm/yyyy',
                                                        todayHighlight: true,
                                                        autoclose: true,

                                                                                });      
      $('#tags').tagsInput({width:'auto'});
//                                                    $(".date_picker").datepicker({
//
//                                                        setDate: new Date(),
//                                                        format: 'yyyy-mm-dd',
//                                                        todayHighlight: true,
//                                                        autoclose: true,
//
//                                                    });

                                                    $("#updateContact").hide();
                                                    $("#editContact").click(function (e) {
                                                        e.preventDefault();

                                                        if (!confirm('Are you sure you want to continue?')) {
                                                            return false;
                                                        } else {
                                                            $("#updateContact").fadeIn();
                                                            $('#contactInfo .input-select').removeClass('form-control-plaintext').addClass('form-control');
                                                            $('.basic-information .input-select').removeClass('form-control-plaintext').addClass('form-control');

                                                            $('#contactInfo .input-select').css('pointer-events', 'all');
                                                            return true;
                                                        }
                                                    });


                                                    //edit card info
                                                    $("#editCard").click(function (e) {
                                                        e.preventDefault();

                                                        if (!confirm('Are you sure you want to continue?')) {
                                                            return false;
                                                        } else {
                                                            $("#updateCard").fadeIn();
                                                            $('.card-form .input-select').css('pointer-events', 'all');
                                                            return true;
                                                        }
                                                    });


                                                    $('#updateCard').hide();
                                                    $('.card-info .input-select').attr("readonly", "readonly");
                                                    $('.card-info select').attr("disabled", "disabled");
                                                    $("#editCard").click(function (e) {
                                                        e.preventDefault()

                                                        if (!confirm('Are you sure you want to continue?')) {
                                                            return false;
                                                        } else {
                                                            $('#updateCard').fadeIn();
                                                            $('.card-info .input-select').removeAttr("readonly", "readonly");
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
        for (var i = 1; i <= 12; ++i) {
            addOption(document.form2.month_list, i, i);
        }
        for (var i = n; i < n + 100; ++i) {
            addOption(document.form2.year_list, i, i);
        }
    }
    function copyText() {
        /* Get the text field */
        var copyText = document.getElementById("referLink");
        var Hashkey = document.getElementById("Hashkey1").value;
        URL = "<?php echo SITE_BASE_URL; ?>Masters/CopyText.html?ReferralCode=" + Hashkey;
        $.ajax({url: URL, success: function (result) {
                if (result.trim() == "success") {
                    $.ajax({url: URL, success: function (result) {
                            alert("copied Successfully");
                        }});
                } else {
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