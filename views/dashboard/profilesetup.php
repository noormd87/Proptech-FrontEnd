<?php 
include"header.php"; 

$rows = \login\loginClass::GetUserFullName();
$i = 1;
foreach ($rows as $row) 
{
    $LoginFirstName=$row["first_name"];
    $LoginLastName=$row["last_name"];
    $LoginUserName=$row["user_id"];
    $LoginUserId=$row["id"];
    $ProfilePic=$row["image_file"];
    $CountryName=$row["country_name"];
    if($_SESSION["BaseCurrency"]!="" && $_SESSION["BaseCurrency"]!=null)
    {
        $Currency=$_SESSION["BaseCurrency"];
    }
    else
    {
        $Currency       =   $row["currency"];
    }
    //echo "=====>".$Currency;
    //exit;
    if($_SESSION["BaseCountry"]!="" && $_SESSION["BaseCountry"]!=null)
    {
        $CountryCode    =   $_SESSION["BaseCountry"];
    }
    else
    {
        $CountryCode    =   $row["country_code"];
    }
    if($ProfilePic=='' || $ProfilePic==null)
    {
        $ProfilePic='NoProfile.jpg';
    }
    
    //echo '$CountryCode='.$CountryCode;
}

?>           
<link rel="stylesheet" type="text/css" href="assets/plugins/jquery-steps/jquery-steps.css">

<!-- Inner Content Start-->
<div class="inner-wrapper">
    <div class="search-time-holder">
        <div class="search-bar">
            <div class="input-group">
                <select class="form-control" name="choose" id="choose">
                    <option value="all">All</option>
                    <option value="1">Other</option>
                    <option value="2">Other</option>
                </select>
                <input type="text" class="form-control" placeholder="Rental Investment">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </div>
        <div class="time-slots">
            <div class="single-time">
                <p>03:24</p>
                <small>pst</small>
            </div>
            <div class="single-time">
                <p>03:24</p>
                <small>pst</small>
            </div>
            <div class="single-time">
                <p>03:24</p>
                <small>pst</small>
            </div>
            <button class="btn btn-dark">Add<br>Clock</button>
        </div>
    </div>


    <div class="panel panel-black panel-advisor">
        <div class="panel-title">
            <h2>My Profile Completion Scale</h2>
        </div>
        <div class="panel-body">
             <div class="d-flex align-items-center">
                            <div class="progress-bar-holder">
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"
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
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#tab1" role="tab"
                                        aria-controls="tab1" aria-selected="true">My Profile</a>
                    </li>
                    <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab11" role="tab"
                                        aria-controls="tab11" aria-selected="false">PAYMENT INFORMATION</a>
                    </li>
                    <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#tab111" role="tab"
                                        aria-controls="tab111" aria-selected="false">AML INFO</a>
                    </li>
                    <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab1111" role="tab"
                                        aria-controls="tab1111" aria-selected="false">INVESTMENT GOALS</a>
                    </li>
                </ul>
                            <div class="tab-content tab-panels" id="mytabs">
                                <div class="tab-pane fade" id="tab1" role="tabpanel"
                                    aria-labelledby="tab1-tab">

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="well well-action">
                                        <a href="#" class="float-right">edit</a>
                                        <h5>1. Profile Picture</h5>
                                                    <img src="assets/images/john-doe.jpg" alt=""
                                                        class="img-fluid rounded-circle mb-3 mt-3" />
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="well well-action">
                                        <a href="#" class="float-right">edit</a>
                                        <h5>2. Name & DOB</h5>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="namef">First Name</label>
                                                    <input type="text" id="namef" name="namef" class="form-control" value="<?= $LoginFirstName; ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="namel">Last Name</label>
                                                    <input type="text" id="namel" name="namel" class="form-control" value="<?= $LoginLastName;?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group mb-3">
                                                    <label for="email">Email</label>
                                                    <input type="text" id="email" name="email" class="form-control" value="jamesbond@bond.com"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group mb-3">
                                                    <label for="dob">DOB dd/mm/yyyy</label>
                                                    <input type="text" id="dob" name="dob" class="form-control" value="bond"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="well well-action">
                                <a href="#" class="float-right">edit</a>
                                <h5>2. Address & Phone</h5>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="address1">Street Number and Name</label>
                                            <input type="text" id="address1" name="address1" class="form-control" value="123 Disney Land"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="town">Town</label>
                                            <input type="text" id="town" name="town" class="form-control" value="Florida"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="phone">Phone Number</label>
                                            <div class="row no-gutters">
                                                <div class="col-sm-4">
                                                    <input type="text" id="phone" name="phone" class="form-control" value="+64"/>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" id="phone2" name="phone2" class="form-control" value="035 2151655"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="city">City</label>
                                            <input type="text" id="city" name="city" class="form-control" value="United States"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="country">Country</label>
                                            <input type="text" id="country" name="country" class="form-control" value="12345"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="mobile">Mobile Number</label>
                                            <div class="row no-gutters">
                                                <div class="col-sm-4">
                                                    <input type="text" id="mobile" name="mobile" class="form-control" value="+64"/>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" id="mobile2" name="mobile2" class="form-control" value="035 2151655"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="well well-action">
                                <a href="#" class="float-right">edit</a>
                                <h5>3. User Name & Password</h5>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="uuu">Username</label>
                                            <input type="text" id="uuu" name="uuu" class="form-control" value="jamesbond"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="pwww">Password</label>
                                            <input type="password" id="pwww" name="pwww" class="form-control" value="798456"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="well well-action well-white">
                                <a href="#" class="float-right">edit details</a>
                                <h5>4. Social Media Details</h5>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group mb-3 mt-3 icon">
                                            <img src="assets/images/fb.svg" />  jamesbond
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group mb-3 mt-3 icon">
                                            <img src="assets/images/in.svg" />  jamesbond
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group mb-3 mt-3 icon">
                                            <img src="assets/images/ins.svg" />  jamesbond
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group mb-3 mt-3 icon">
                                            <img src="assets/images/tw.svg" />  jamesbond
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="well well-action well-white">
                                <h5>5. Copy Link &Share</h5>
                                <div class="row sharing">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="http://google.com"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-secondary btn-block btn-secondary4">Copy</button>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-secondary btn-block btn-secondary4">Invite a Friend</button>
                                    </div>
                                </div>
                                <ul class="list-inline mt-3">
                                    <li>
                                        <img src="assets/images/fb.svg" alt=""/>
                                    </li>
                                    <li>
                                        <img src="assets/images/tw.svg" alt=""/>
                                    </li>
                                    <li>
                                        <img src="assets/images/in.svg" alt=""/>
                                    </li>
                                    <li>
                                        <img src="assets/images/ins.svg" alt=""/>
                                    </li>
                                </ul>
                            </div>
                            <hr />
                            <div class="text-right form-group mb-3 mt-3">
                                <button type="button" class="btn btn-default btn-max">Save</button>
                                <button type="button" class="btn btn-default btn-max">Next &raquo; </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab11" role="tabpanel" aria-labelledby="tab11-tab">
                        <div class="panel-body">
                            <a href="#" class="float-right">edit</a>
                            <h1>James Bond</h1>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="well well-action">
                                        <a href="#" class="float-right">edit</a>
                                        <h5>Credit Card Details</h5>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="card">Name on Credit Card</label>
                                                    <input type="text" id="card" name="card" class="form-control" value="name"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="exp">Expiry</label>
                                                    <div class="row no-gutters">
                                                        <div class="col-sm-4">
                                                            <input type="text" id="exp1" name="exp1" class="form-control" value="+64"/>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="exp2" name="exp2" class="form-control" value="035 2151655"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-64">
                                                <div class="form-group mb-3">
                                                    <label for="cnumber">Credit Card Number</label>
                                                    <input type="text" id="cnumber" name="cnumber" class="form-control" value="011 xxxxx xxxx"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="csv">CVC</label>
                                                    <input type="text" id="csv" name="csv" class="form-control" value="xxx"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img src="assets/images/Group 315.png" alt="" class="img-fluid mb-3 mt-3"/>
                                </div>
                            </div>
                            <div class="well well-action well-white">
                                <h5>NOTE TO US:</h5>
                                <p> We need to be able to show what info that havent yet filled in on each tab to help them complete 100% of My Profile.</p><p> Do we need Paypal link on this page?</p>
                            </div>
                            <hr />
                            <div class="text-right form-group mb-3 mt-3">
                                <button type="button" class="btn btn-default btn-max">Back</button>
                                <button type="button" class="btn btn-default btn-max">Next &raquo; </button>
                            </div>
                        </div>
                    </div>
                                <div class="tab-pane active" id="tab111" role="tabpanel" aria-labelledby="tab111-tab">
                            <div class="panel-body">
                                        <div class="well aml-well">
                                            <div class="d-flex align-items-start justify-content-between">
                                                <div class="col-xl-6 col-lg-8 p-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input class="form-control" type="text" placeholder="First Name">
                                                                <span>(proof required)</span>
                                    </div>
                                </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input class="form-control" type="text" placeholder="Last Name">
                                                                <span>(proof required)</span>
                                    </div>
                                </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control" type="email" placeholder="Email">
                                    </div>
                                </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Mobile</label>
                                                                <input class="form-control" type="email" placeholder="Email">
                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="doc-upload">
                                                    <div class="uploader">
                                                        <input type="file">
                                                        <img src="assets/images/upload.svg" alt="">
                                                    </div>
                                                    <p>A valid form of ID (This can be your New Zealand Driver’s License, your Passport or your Birth Certificate).</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="well aml-well">
                                            <div class="d-flex align-items-start justify-content-between">
                                                <div class="col-xl-6 col-lg-8 p-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Subscription</label>
                                                                <input class="form-control" type="text" placeholder="Username">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Subscription Units</label>
                                                                <input class="form-control" type="text" placeholder="Units">
                                                                <span>(being 1 Unit per $1 of Subscription Amount)</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Bank Account</label>
                                                                <input class="form-control" type="email" placeholder="Account Number">
                                                                <span>(proof required)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="doc-upload">
                                                    <div class="uploader">
                                                        <input type="file">
                                                        <img src="assets/images/upload.svg" alt="">
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
                                                                <label>Street Number</label>
                                                                <input class="form-control" type="text" placeholder="Street Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Street Name</label>
                                                                <input class="form-control" type="text" placeholder="Street Name">
                                                                <span>(proof required)</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input class="form-control" type="text" placeholder="City">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Suburb</label>
                                                                <input class="form-control" type="text" placeholder="Suburb">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <input class="form-control" type="text" placeholder="Country">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="doc-upload">
                                                    <div class="uploader">
                                                        <input type="file">
                                                        <img src="assets/images/upload.svg" alt="">
                                                    </div>
                                                    <p>A physical address (Bank Statement, Utility Bill etc)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="well aml-well">
                                            <div class="d-flex align-items-start justify-content-between">
                                                <div class="col-xl-6 col-lg-8 p-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><small>Subscriber IRD / Tax Identification Number</small></label>
                                                                <input class="form-control" type="text" placeholder="ID Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><small>Subscriber Source of Funds</small></label>
                                                                <input class="form-control" type="text" placeholder="Funds Source">
                                                                <span>(proof required)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="doc-upload">
                                                    <div class="uploader">
                                                        <input type="file">
                                                        <img src="assets/images/upload.svg" alt="">
                                                    </div>
                                                    <p>*Source of Funds (see list below)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="well aml-well">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><small>Subscriber Form of ID</small></label>
                                                        <input class="form-control" type="text" placeholder="ID">
                                                        <span>(proof required)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><small>Subscriber Form of Address</small></label>
                                                        <input class="form-control" type="text" placeholder="Funds Source">
                                                        <span>(proof required)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><small>Subscriber Source of Funds</small></label>
                                                        <input class="form-control" type="text" placeholder="Funds Source">
                                                        <span>(proof required)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                            <div class="text-right form-group mb-3 mt-3">
                                <button type="button" class="btn btn-default btn-max">Back</button>
                                <button type="button" class="btn btn-default btn-max">Next &raquo; </button>
                            </div>
                        </div>
                                </div>

                        <div class="tab-pane fade" id="tab1111" role="tabpanel" aria-labelledby="tab1111-tab">
                            <div class="panel-body">

                                <a href="#" class="float-right">edit</a>
                                <h1>James Bond</h1>

                                <h5>User ID</h5>
                                        <input type="text" readonly class="form-control-plaintext" id="userid"
                                            value="email@example.com">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="well well-file mb-4">
                                            <i class="far fa-file-alt"></i> filename.pdf
                                            <i class="fas fa-download"></i>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="well well-file mb-4">
                                            <i class="fas fa-download"></i>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>

                                        <p class="bg-secondary">NOTE: On completion of receipt of the AML documents you
                                            may begin to reserve properties through our online platform</p>



                                <hr />
                                <div class="text-right form-group mb-3 mt-3">
                                    <button type="button" class="btn btn-default btn-max">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                        <div class="pricing-panel">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade" id="gold">
                                    <div class="level">
                                        <span>Your Tier Level</span>
                                        <h4>Gold</h4>
            </div>
                                    <div class="points">
                                        <span>Your Points</span>
                                        <h3>30000</h3>
        </div>
                                    <p>You are upgraded to Diamond</p>
    </div>
                                <div class="tab-pane fade" id="platinum">
                                    <div class="level">
                                        <span>Your Tier Level</span>
                                        <h4>DIAMOND</h4>
</div>
                                    <div class="points">
                                        <span>Your Points</span>
                                        <h3>20000</h3>
                                    </div>
                                    <p>Need 30000 more points to upgrade to Jade</p>
                                </div>
                                <div class="tab-pane active" id="diamond">
                                    <div class="level">
                                        <span>Your Tier Level</span>
                                        <h4>DIAMOND</h4>
                                    </div>
                                    <div class="points">
                                        <span>Your Points</span>
                                        <h3>20000</h3>
                                    </div>
                                    <p>Need 30000 more points to upgrade to Jade</p>
                                </div>
                                <div class="tab-pane fade" id="jade">
                                    <div class="level">
                                        <span>Your Tier Level</span>
                                        <h4>DIAMOND</h4>
                                    </div>
                                    <div class="points">
                                        <span>Your Points</span>
                                        <h3>20000</h3>
                                    </div>
                                    <p>Need 30000 more points to upgrade to Jade</p>
    
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

                            <div class="d-flex align-items-center f-text">
                                <img src="assets/images/earn.svg" alt="">
                                <div class="text">
                                    <h6>Ways to earn</h6>
                                    <p>You will earn 1 Du Val Club point for every US$1 you spend on Du Val properties, and for every friend you refer who becomes a member you will earn an additional 1000 points.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="person-count">
                                        <div class="text">
                                            <span>40</span>
                                            <p>Total Referred</p>
                                        </div>
                                        <img src="assets/images/people-vector.png" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="person-count">
                                        <div class="text">
                                            <span>19</span>
                                            <p>Total Joined</p>
                                        </div>
                                        <img src="assets/images/people-vector.png" alt="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="p">The Du Val Rewards programme operates in much the same way as airline memberships: we reward you for buying property and for referring your friends or contacts to become part of the network. Depending on the subscription plan you choose, you’ll start as a Gold or Platinum member and as you earn points you’ll move up through the tiers and enjoy all the benefits that come with it.</p>
                                </div>
                                <div class="col-12">
                                    <h6>Points</h6>
                                    <p class="simple-p">
                                        For the collection of points, I think we should keep this very simple and points should be collected in the following ways:
                                    </p>
                                    <table>
                                        <tr>
                                            <td>
                                                1 Du Val Point 
                                            </td>
                                            <td>
                                                for every 1 USD spend purchasing property (credited at time of unconditional exchange of contracts) 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                50,000 Du Val Points 
                                            </td>
                                            <td>
                                                for purchasing an annual subscription 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                75,000 Du Val Points 
                                            </td>
                                            <td>
                                                for renewing an annual subscription 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                20,000 Du Val Points 
                                            </td>
                                            <td>
                                                for referring any friend who becomes an annual subscriber 
                                            </td>
                                        </tr> 
                                            <td>
                                                10,000 Du Val Points
                                            </td>
                                            <td>
                                                for referring a friend who subscribes to the platform (either monthly or 6 monthly membership)
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



            </div>
            <!-- Inner Content End-->

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