<?php include"header.php"; ?>
<?php
\login\loginClass::Init();
$rows = \login\loginClass::GetAccountDatas();
$i = 1;

foreach ($rows as $row) 
{
    $user_id         = $row["user_id"];
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
}
?>    
<head>
   <base href="<?php echo SITE_BASE_URL;?>">
   <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="javascripts/country-picker-flags/build/css/countrySelect.css">
</head>

    <div class="profile-section">
        <!-- Nav tabs -->
        <div class="custom-tab-1">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#homeTab"><i class="fa fa-home"></i> HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#billingTab"><i class="fa fa-file"></i> Payments information</a>
                </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#cardTab"><i class="fa fa-credit-card"></i> CARD INFO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#editProfileTab"><i class="fa fa-user-circle"></i > EDIT PROFILE</a>
                    </li> -->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#amlTab"><i class="fa fa-edit"></i > AML Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#editInvestmentGols"><i class="fa fa-money"></i> Investment goals</a>
                </li>
            </ul>
            <div class="tab-content mt-30">
                <!-- home tab -->
                <div class="tab-pane fade show active" id="homeTab" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-profile">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="user-photo m-b-30">
                                                    <img class="img-responsive" src="<?php echo SITE_BASE_URL?>uploads/ProfilePic/<?php echo $ProfilePic;?>" alt="" />
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="user-profile-name"><?php echo $first_name." ".$last_name;?></div>
                                                <div class="user-Location">
                                                    <i class="ti-location-pin"></i> NY, USA</div>
                                                <!-- <div class="user-job-title">Senior Advisor</div>
                                                <div class="ratings">
                                                    <h4>Ratings</h4>
                                                    <div class="rating-star">
                                                        <span>8.9</span>
                                                        <i class="ti-star color-primary"></i>
                                                        <i class="ti-star color-primary"></i>
                                                        <i class="ti-star color-primary"></i>
                                                        <i class="ti-star color-primary"></i>
                                                        <i class="ti-star"></i>
                                                    </div>
                                                </div> -->
                                                <div class="user-send-message">
                                                    <button class="btn btn-primary btn-addon" type="button" data-toggle="modal" data-target="#updatePhotoModal">
                                                        <i class="ti-image m-r-10"></i>CHANGE PICTURE</button>
                                                </div>
                                                <div class="contact-information" id="contactInfo">
                                                    <h4>Contact information <button class="btn btn-link" type="button" id="editContact"><i class="fa fa-edit"></i></button></h4>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-2">Phone:</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control-plaintext input-select" value="<?php echo $phone_no;?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-2">
                                                            Address:
                                                        </label>
                                                        <div class="col-10">
                                                            <input type="text" class="form-control-plaintext input-select" name="" value="<?php echo $address;?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-2">
                                                            Email:
                                                        </label>
                                                        <div class="col-10">
                                                            <input type="text" class="form-control-plaintext input-select" name="" value="<?php echo $user_id;?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-2">
                                                            Website:
                                                        </label>
                                                        <div class="col-10">
                                                            <input type="text" class="form-control-plaintext input-select" name="" value="www.example.com">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-2">
                                                            Skype:
                                                        </label>
                                                        <div class="col-10">
                                                            <input type="text" class="form-control-plaintext input-select" name="" value="sporsho9">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="basic-information">
                                                    <h4>Basic information</h4>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-2">
                                                            Birthday:
                                                        </label>
                                                        <div class="col-10">
                                                            <input type="text" class="form-control-plaintext input-select" name="" value="January 31, 1990">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-2">
                                                            Gender:
                                                        </label>
                                                        <div class="col-10">
                                                            <input type="text" class="form-control-plaintext input-select" name="" value="Male">
                                                        </div>
                                                    </div>
                                                    <input type="submit" id="updateContact" class="btn btn-primary btn-sm" name="" value="Update">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <!-- end home tab -->
                <!-- billing info -->
                <div class="tab-pane fade show" id="billingTab" role="tabpanel">
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>User ID</label>
                                    <input type="text" readonly class="form-control-plaintext" name='user_id' value="<?php echo $user_id;?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>SUBSCRIPTION TYPE</label>
                                    <input type="text" readonly class="form-control-plaintext" value="<?php echo $plan_name."/".$period_type;?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>FIRST NAME</label>
                                    <input type="text" class="form-control" name="first_name" value="<?php echo $first_name;?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>LAST NAME</label>
                                    <input type="text" class="form-control" name="last_name" value="<?php echo $last_name;?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>PHONE NUMBER</label>
                                    <input type="text" class="form-control" name="mobile"  value="<?php echo $phone_no;?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>ADDRESS</label>
                                    <input type="text" class="form-control"name="address"  value="<?php echo $address;?>">
                                </div>
                            </div>
                        </div>

<div class="card-info" name=''>
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
                                list($year,$month, $day) = split('[/.-]', $expirationDate);
                                $country         = $row["country"];
                                echo "===>".$country;
                                $address1        = $row["address1"];
                                $address2        = $row["address2"];
                                $city            = $row["city"];
                                $postalCode      = $row["postal_code"];
                                $state           = $row["state"];
                                $emailForInvoice = $row["email_address_for_invoice"];
                                $companyName     = $row["company_name"];

                            ?>
                            
                                <form action="<?php echo SITE_BASE_URL;?>login/save.html?form=1" method="post" name=form1 id=form1>
                               <body onload="addOption_list()">
                               
                                   <div class="edit-card-info m-b-20">
                                       <button type="submit" class="btn btn-primary" id="editCard">EDIT CARD INFO</button>
                                   </div> 
                                   <div class="row">
                                       <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>CARDHOLDER NAME</label>
                                                <input type="text" class="form-control-plaintext input-select" name="Cardholder_Name" value="<?php echo $cardholderName;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>CARD NUMBER</label>
                                                <input type="password" class="form-control-plaintext input-select " name="Card_Number" value="<?php echo $cardNumber;?>">
                                            </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>CVV</label>
                                                <input type="password" class="form-control-plaintext input-select" name="CVV" value="<?php echo $cvv;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>EXPIRED MONTH</label>
                                                <select name="month_list" class="form-control-plaintext">
                                                    <option value="<?php echo $month;?>"><?php echo $month;?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>EXPIRED YEAR</label>
                                                <select name="year_list" class="form-control-plaintext">
                                                    <option value="<?php echo $year;?>"><?php echo $year;?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>ADDRESS LINE 1</label>
                                                <input type="text" class="form-control-plaintext input-select" name="Address1" value="<?php echo $address1;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>ADDRESS LINE 2</label>
                                                <input type="text" class="form-control-plaintext input-select" name="Address2" value="<?php echo $address2;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>CITY</label>
                                                <input type="text" class="form-control-plaintext input-select" name="City" value="<?php echo $city;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>STATE</label>
                                                <input type="text" class="form-control-plaintext input-select" name="State" value="<?php echo $state;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>PINCODE</label>
                                                <input type="text" class="form-control-plaintext input-select" name="Postal_Code" value="<?php echo $postalCode;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>COUNTRY</label>
                                                <!--<select class="form-control-plaintext input-select" name="">-->
                                                <!--    <option>New Zealand</option>-->
                                                <!--</select>-->
                                                <input class="form-control-plaintext" id="country_selector" type="text"  placeholder="Selected country">
                                                <input type="hidden" class="form-control" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>EMAIL FOR INVOICE</label>
                                                <input type="text" class="form-control-plaintext input-select" name="Email_Address_for_Invoice" value="<?php echo $emailForInvoice;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>COMPANY NAME</label>
                                                <input type="text" class="form-control-plaintext input-select" name="Company_Name" value="<?php echo $companyName;?>">
                                                <input type="hidden" class="form-control" name="id" value='<?php echo $id;?>'>
                                                <input type="hidden" class="form-control" name="auto_id" value='<?php echo $auto_id;?>'>
                                                  <input type="hidden" class="form-control" name="action1" value='Edit'>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="">
                                                <input type="submit" class="btn btn-secondary" id="updateCard" name="update_card" value="Update">
                                            </div>
                                        </div>
                                   </div> 
                 
                               </body>
                               </form>
                           
                           <?php 
                            }
                            ?>   
                    </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end billing info -->
                <!-- card info -->
				<div class="tab-pane fade" id="cardTab">
                    <div class="card-info" name=''>
                        <?php
							\login\loginClass::Init();
							$rows = \login\loginClass::GetAccountCardDatas();
							$i = 1;

							foreach ($rows as $row) 
							{
							   
								$auto_id         = $row["auto_id"];
								$id     		 = $row["user_id"];
								$cardholderName  = $row["cardholder_name"];
								$cardNumber		 = $row["card_number"];
								$cvv             = $row["cvv"];
								$expirationDate  = $row["expiration_date"];
								list($year,$month, $day) = split('[/.-]', $expirationDate);
								$country    	 = $row["country"];
								$address1		 = $row["address1"];
								$address2		 = $row["address2"];
								$city       	 = $row["city"];
								$postalCode		 = $row["postal_code"];
								$state      	 = $row["state"];
								$emailForInvoice = $row["email_address_for_invoice"];
								$companyName     = $row["company_name"];

							?>
							
							    <form action="<?php echo SITE_BASE_URL;?>login/save.html?form=1" method="post" name=form1 id=form1>
							   <body onload="addOption_list()">
                               
                                   <div class="edit-card-info m-b-20">
                                       <button type="submit" class="btn btn-primary" id="editCard">EDIT CARD INFO</button>
                                   </div> 
                                   <div class="row">
                                       <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>CARDHOLDER NAME</label>
                                                <input type="text" class="form-control-plaintext input-select" name="Cardholder_Name" value="<?php echo $cardholderName;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>CARD NUMBER</label>
                                                <input type="password" class="form-control-plaintext input-select " name="Card_Number" value="<?php echo $cardNumber;?>">
                                            </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>CVV</label>
                                                <input type="password" class="form-control-plaintext input-select" name="CVV" value="<?php echo $cvv;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>EXPIRED MONTH</label>
                                                <select name="month_list" class="form-control-plaintext">
                                                    <option value="<?php echo $month;?>"><?php echo $month;?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>EXPIRED YEAR</label>
                                                <select name="year_list" class="form-control-plaintext">
                                                    <option value="<?php echo $year;?>"><?php echo $year;?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>ADDRESS LINE 1</label>
                                                <input type="text" class="form-control-plaintext input-select" name="Address1" value="<?php echo $address1;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>ADDRESS LINE 2</label>
                                                <input type="text" class="form-control-plaintext input-select" name="Address2" value="<?php echo $address2;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>CITY</label>
                                                <input type="text" class="form-control-plaintext input-select" name="City" value="<?php echo $city;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>STATE</label>
                                                <input type="text" class="form-control-plaintext input-select" name="State" value="<?php echo $state;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>PINCODE</label>
                                                <input type="text" class="form-control-plaintext input-select" name="Postal_Code" value="<?php echo $postalCode;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>COUNTRY</label>
                                                <!--<select class="form-control-plaintext input-select" name="">-->
                                                <!--    <option>New Zealand</option>-->
                                                <!--</select>-->
                                                <input class="form-control-plaintext" id="country_selector" type="text"  placeholder="Selected country">
                                                <input type="hidden" class="form-control" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>EMAIL FOR INVOICE</label>
                                                <input type="text" class="form-control-plaintext input-select" name="Email_Address_for_Invoice" value="<?php echo $emailForInvoice;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>COMPANY NAME</label>
                                                <input type="text" class="form-control-plaintext input-select" name="Company_Name" value="<?php echo $companyName;?>">
                                                <input type="hidden" class="form-control" name="id" value='<?php echo $id;?>'>
                                                <input type="hidden" class="form-control" name="auto_id" value='<?php echo $auto_id;?>'>
                                                  <input type="hidden" class="form-control" name="action1" value='Edit'>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="">
                                                <input type="submit" class="btn btn-secondary" id="updateCard" name="update_card" value="Update">
                                            </div>
                                        </div>
                                   </div> 
                 
                               </body>
                               </form>
                           
						   <?php 
							}
							?>   
                    </div>
                </div>
                <!-- end card info -->
                <!-- edit profile info -->
                <div class="tab-pane fade" id="editProfileTab">
                    <div class="">
                       <form action="<?php echo SITE_BASE_URL;?>login/save.html?form=2" method="post" name=form2 id=form2>
                        <div class="card">
                           <div class="card-body">
                                 <div class="row">
                                       <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>FIRST NAME</label>
                                                <input type="text" class="form-control" name="first_name" value="<?php echo $first_name;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>LAST NAME</label>
                                                <input type="text" class="form-control" name="last_name" value="<?php echo $last_name;?>">
                                            </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-lg-4 col-md-2 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>EMAIL</label>
                                                <input type="text" class="form-control" name="user_id" value="<?php echo $user_id;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>MOBILE NUMBER</label>
                                                <input class="form-control" type="text" name="mobile" value ="<?php echo $phone_no;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>ALTERNATE MOBILE NUMBER</label>
                                                <input class="form-control" type="text" name="mobile1" value="<?php echo $phone_no1;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>ADDRESS LINE 1</label>
                                                <input type="text" class="form-control" name="Address1" value="<?php echo $address1;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>ADDRESS LINE 2</label>
                                                <input type="text" class="form-control" name="Address2" value="<?php echo $address2;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>CITY</label>
                                                <input type="text" class="form-control" name="City" value="<?php echo $city;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>STATE</label>
                                                <input type="text" class="form-control" name="State" value="<?php echo $state;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>PINCODE</label>
                                                <input type="text" class="form-control" name="Postal_Code" value="<?php echo $postalCode;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>COUNTRY</label>
                                                <!--<select class="form-control" name="">-->
                                                <!--    <option></option>-->
                                                <!--</select>-->
                                                <input class="form-control-plaintext" id="country_selector1" type="text"  placeholder="Selected country">
                                                <input type="hidden" class="form-control" id="country_selector1_code" name="country_selector1_code" data-countrycodeinput="1" readonly="readonly" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>EMAIL FOR INVOICE</label>
                                                <input type="text" class="form-control" name="Email_Address_for_Invoice" value="<?php echo $emailForInvoice;?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>COMPANY NAME</label>
                                                <input type="text" class="form-control" name="Company_Name" value="<?php echo $companyName;?>">
                                                <input type="hidden" class="form-control" name="id" value='<?php echo $id;?>'>
                                                <input type="hidden" class="form-control" name="auto_id" value='<?php echo $auto_id;?>'>
                                                <input type="hidden" class="form-control" name="action1" value='Edit'>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="">
                                                <input type="submit" class="btn btn-secondary" name="" value="submit">
                                            </div>
                                        </div>
                                   </div>
                                   
                           </div>
                       </div>
                    </form>
                    </div>
                </div>
                <!-- end edit profile -->
                <!-- aml info -->
                <div class="tab-pane fade" id="amlTab">
                    <div class="">
                       <div class="card">
                           <div class="card-body">
                                 <form action="<?php echo SITE_BASE_URL;?>Login/SaveFileUploads.html?mode=upload" method="post" name='form4' enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Upload ID</label>
                                            <div class="custom-file">
                                            <input type="file" name='UploadID' class="custom-file-input" id="UploadID">
                                            <label class="custom-file-label" for="UploadID">Choose file</label> 
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>Upload POA</label>
                                        <div class="custom-file">
                                            <input type="file"  name='UploadPDA' class="custom-file-input" id="UploadPDA">
                                            <label class="custom-file-label" for="UploadPDA">Choose file</label>
                                        </div>
                                    </div> 
                                    <div class="form-group mt-3">
                                        <label>Note  :  On completion of receipt of the AML documents you may begin to reserve properties through our online platform.</label>
                                    </div> 
                                    <input type="submit" class="btn btn-secondary" name="Upload" value="submit">
                               </form> 
                           </div>
                       </div>
                    </div>
                </div>
                <!-- end aml info tab -->
                
                <!-- InvestmentGols info -->
                <div class="tab-pane fade" id="editInvestmentGols">
                    <div class="">
                       <div class="card">
                           <div class="card-body">
                                <form>
                                   <div class="row">
                                       <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Target investment locations</label>
                                                <input type="text" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Investment timeline</label>
                                                <input type="text" class="form-control" value="">
                                            </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Investment objectives</label>
                                                <input type="text" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="">
                                                <input type="submit" class="btn btn-secondary" name="" value="submit">
                                            </div>
                                        </div>
                                   </div>
                               </form> 
                           </div>
                       </div>
                    </div>
                </div>
                <!-- end InvestmentGols info tab -->
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

<?php include"footer.php"; ?>

<script src="assets/plugins/chartjs/Chart.bundle.js"></script>
<script type="text/javascript">

$('.datepicker').datepicker({
    format: "dd-mm-yy",
    format: "dd-mm-yy"
});

    
$(function () {   

    //Double Line Graph 
    var ctx = document.getElementById("double-line-graph");
    ctx.height = 100;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
            type: 'line',

            datasets: [{
                label: "My First dataset",
                data: [50, 26, 36, 30, 46, 38, 60],
                backgroundColor: "rgba(255,117,136,0.12)",
                borderColor: "#FF4961",
                pointRadius: 0,
                lineTension: 0,
            },
            {
                label: "My First dataset",
                data: [35, 40, 48, 25, 35, 45, 40],
                backgroundColor: "rgba(76,132,255,0.12)",
                borderColor: "#4c84ff",
                pointRadius: 0,
                lineTension: 0,
            }]
        },
        options: {
            responsive: true,
            tooltips: {
                enabled: false,
            },
            legend: {
                display: false,
                labels: {
                    usePointStyle: false,

                },


            },
            scales: {
                xAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }
                }]
            },
            title: {
                display: false,
            }
        }
    });

});
</script>

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
        var d = new Date();
    	var n = d.getFullYear();
        for (var i=1; i <= 12;++i) {
            addOption(document.form1.month_list,i,i);
        }
        for (var i=n; i < n+100;++i) {
            addOption(document.form1.year_list,i,i);
        }
    }
</script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script src="javascripts/country-picker-flags/build/js/countrySelect.js"></script>
<script>
	$("#country_selector").countrySelect({
		preferredCountries: [ '<?php echo strtolower($country);?>']
	});
	$("#country_selector1").countrySelect({
		preferredCountries: [ '<?php echo strtolower($country);?>']
	});
</script>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>