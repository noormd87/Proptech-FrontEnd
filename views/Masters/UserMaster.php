<?php include "header.php"; 

$user_id            = \settings\session\sessionClass::GetSessionDisplayName();

$buttonaction   	= isset($_REQUEST["buttonaction"]) ? $_REQUEST["buttonaction"] : "";	



if ( $buttonaction == "edit"){

	

	$url = SITE_BASE_URL ."Masters/UserMaster.html?d=".time()."&buttonaction=edit";

	

}else{

	

	

	$url = SITE_BASE_URL ."Masters/UserMaster.html?d=" .time();

}



?>

<!DOCTYPE html>

<html lang="en">

<head>

<base href="<?php echo SITE_BASE_URL;?>">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="javascripts/country-picker-flags/build/css/countrySelect.css">

  <meta charset="utf-8" />

  <link rel="icon" type="image/png" href="images/favicon.png">

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>

    DU VAL PRIVATE OFFICE

  </title>

  <style>

  input.textbox {

        /*text-transform: uppercase;*/

    }

  </style>

  

  <!--     Fonts and icons     -->

</head>

<body>

<div class="card">

  <div class="card-body">

    <?php

	$LocationId     = \Property\PropertyClass::$LocationId;

    $Suburb         = \Property\PropertyClass::$Suburb;

							

	if ($buttonaction =="edit")

	{
	    \login\loginClass::Init();
        $rows = \login\loginClass::GetAccountDatas($_REQUEST["id"]);
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
        	$UserType		 = $row["user_type"];
        	$Advisor		 = $row["advisor"];
        	
        }
	 
     ?>
	    <!-- billing info -->
            <div class="tab-pane fade show" id="billingTab" role="tabpanel">
                <form action="<?php echo SITE_BASE_URL;?>login/save.html" method="post" name=form1 id=form1>
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
                                <label>USER TYPE</label>
                                <input type="text" readonly class="form-control-plaintext" name="User_type" value="<?php echo $UserType;?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>ADVISOR</label>
                                <select name='Advisor'class="form-control">
                                    <option value=''>--Select--</option>
                                <?php
                                \login\loginClass::Init();
                                $rowAdvisors = \login\loginClass::GetAdvisorDatas();
                                $i = 1;
                                foreach ($rowAdvisors as $rowAdvisor) 
                                {
                                    $Advisoruser_id         = $rowAdvisor["user_id"];
                                    $Advisorfirst_name		 = $rowAdvisor["first_name"];
                                	$Advisorlast_name		 = $rowAdvisor["last_name"];
                                	echo $Advisoruser_id."<br>";
                                ?>
                                    <option value="<?php echo $Advisoruser_id;?>" <?php if($Advisoruser_id==$Advisor){?> Selected<?php }?>><?php echo $Advisorfirst_name." ".$Advisorlast_name ?></option>
                                <?
                                }
                                ?>
                                </select>
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
                        $rows = \login\loginClass::GetAccountCardDatas($_REQUEST["id"]);
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
                            $address1        = $row["address1"];
                            $address2        = $row["address2"];
                            $city            = $row["city"];
                            $postalCode      = $row["postal_code"];
                            $state           = $row["state"];
                            $emailForInvoice = $row["email_address_for_invoice"];
                            $companyName     = $row["company_name"];

                        ?>
                        
                            <body onload="addOption_list()">
                           
                               <div class="row">
                                   <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>CARDHOLDER NAME</label>
                                            <input type="text" class="form-control input-select" name="Cardholder_Name" value="<?php echo $cardholderName;?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>CARD NUMBER</label>
                                            <input type="password" class="form-control input-select " name="Card_Number" value="<?php echo $cardNumber;?>">
                                        </div>
                                    </div>
                               </div>
                               <div class="row">
                                   <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>CVV</label>
                                            <input type="password" class="form-control input-select" name="CVV" value="<?php echo $cvv;?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>EXPIRED MONTH</label>
                                            <select name="month_list" class="form-control">
                                                <option value="<?php echo $month;?>"><?php echo $month;?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>EXPIRED YEAR</label>
                                            <select name="year_list" class="form-control">
                                                <option value="<?php echo $year;?>"><?php echo $year;?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>ADDRESS LINE 1</label>
                                            <input type="text" class="form-control input-select" name="Address1" value="<?php echo $address1;?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>ADDRESS LINE 2</label>
                                            <input type="text" class="form-control input-select" name="Address2" value="<?php echo $address2;?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>CITY</label>
                                            <input type="text" class="form-control input-select" name="City" value="<?php echo $city;?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>STATE</label>
                                            <input type="text" class="form-control input-select" name="State" value="<?php echo $state;?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>PINCODE</label>
                                            <input type="text" class="form-control input-select" name="Postal_Code" value="<?php echo $postalCode;?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>COUNTRY</label>
                                            <input class="form-control  input-select" id="country_selector" type="text"  placeholder="Selected country">
                                            <input type="hidden" class="form-control" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>EMAIL FOR INVOICE</label>
                                            <input type="text" class="form-control input-select" name="Email_Address_for_Invoice" value="<?php echo $emailForInvoice;?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>COMPANY NAME</label>
                                            <input type="text" class="form-control input-select" name="Company_Name" value="<?php echo $companyName;?>">
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
                       
                       <?php 
                        }
                        ?>   
                </div>

                        </div>
                    </div>
                </div>
                </form>
            </div>
            <!-- end billing info -->
            
    <?
	}

	else

	{

	    $ProjectName	= $_REQUEST["ProjectName"];

		$Description 	= $_REQUEST["Description"];

		$Country     	= $_REQUEST["CountryId"];

		$imageFile     	= $_REQUEST["imageFile"];

		$Suburb     	= $_REQUEST["Suburb"];

		$LocationId  	= $_REQUEST["LocationId"];

		$currency  	    = $_REQUEST["currency"];
	?>

    <!-- Login Form action="<?php echo SITE_BASE_URL;?>Masters/Projectsave.html" -->

    <form method="post" name='form1' action="<?php echo $url ;?>" enctype="multipart/form-data">

        <h4 class="card-title">USER LIST</h4>
        <input type=hidden name='ProjectId' value='<?php echo $ProjectId; ?>'>

            

        <?php 

        if ($buttonaction !="edit" && !isset($_POST["submit"]))

        {?>

        	<div class="table-responsive">

        		<table class="table table-striped mb-0">

                            <thead>

                                <tr>

                                    <th>USER ID</th>

                                    <th>USER NAME</th>

                                    <th>PHONE NO</th>

                                    <th>ADDRESS</th>

                                    <th>USER TYPE</th>

                                    <th>REFERRED BY</th>

                                    <th>PAYMENT TYPE</th>

                                    <th>ADVISOR</th>

                                    <th>ACTIVE STATUS</th>

                                    <th>LOGIN DATE</th>
                                    
                                    <th>EDIT</th>

                                </tr>

                            </thead>

                            <tbody>

                                 <?php

                                 \Masters\MastersClass::Init();

                                 $rows = \Masters\MastersClass::GetUserData();

                                 $i = 1;

                                 foreach ($rows as $row) 

                                 {
                                ?>

                                <tr>

                                    <td align="left">

                                        <?php echo $row["user_id"];?>

                                    </td>

                                    <td>

                                        <?php echo $row["first_name"]." ".$row["last_name"];?>

                                    </td>

                                    <td>

                                        <?php echo $row["phone_no"];?>

                                    </td>

                                    <td>

                                        <?php echo $row["address"];?>

                                    </td>

                                    <td>

                                        <?php echo $row["user_type"];?>

                                    </td>

                                    <td align="center">

                                        <?php echo $row["referred_by"];?>

                                    </td>

                                    <td align="center">

                                        <?php 

                                        if($row["payment_type"]=='M')

                                        {

                                            echo "MONTHLY";

                                        }

                                        else

                                        {

                                            echo "YEARLY";

                                        }

                                        ?>

                                    </td>
                                    
                                    <td align="center">
                                        <?php echo $row["advisor"];?>
                                    </td>
                                    <td align="center">

                                        <?php 

                                        if($row["active_status"]=='Y')

                                        {

                                            echo "YES";

                                        }

                                        else

                                        {

                                            echo "NO";

                                        }

                                        ?>

                                    </td>

                                    <td align="center">

                                        <?php 

                                            echo $row["login_date"];

                                        ?>

                                    </td>
                                    <td align="center">
                                      <a class="btn btn-sm btn-success" href="javascript:void(0)" onclick="EditFn('<?php echo $row["user_id"];?>')">
                                      <i class="fa fa-edit"></i>
                                      </a>
                                   </td>    

                                </tr>

                                <?php

                                 }?>

                            </tbody>

                        </table>

        	</div>

        <?php 

        }?>
    </form>
    <?php }?>
</div>
</div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.15.5/apexcharts.min.js"></script>

</html>

<?php include"footer.php"; ?>

<script>

    function DeleteFn(id){

        if (!confirm("Sure! Are you want to Delete File?")){

            return false;

        }

        

        URL = "<?php echo SITE_BASE_URL;?>Masters/DeleteProject.html?ProjectId=" + id;

        window.location.href = URL;

    }

    

$(document).on("click", ".addnewBtn", function(){

    ErrCount = 0;

    if(document.getElementById("LocationId").value=="")

    {

        alert("Select Subrub from the list");

        return false;

    }

    $(".mandate:visible").each(function(){

            if (this.value == ""){

                alert("Please select field : " + this.name);

                $(this).focus();

                ErrCount++;

                return false;

            }

    });



    if (ErrCount != 0){

            return false;

    }

    $(".btn_add").remove();

    document.getElementsByName('form1').enctype = '';

    document.form1.action = "<?php echo SITE_BASE_URL; ?>Masters/" + this.value + ".html";

    document.form1.submit();

});

$(function () { 

    $(document).on("click", ".btn_add", function(){

    document.getElementsByName('form1').enctype = '';

    document.form1.submit();

    });





    });

function EditFn(id){ 

		window.location.href = "<?php echo SITE_BASE_URL; ?>masters/UserMaster.html?d=<?php echo time(); ?>&id=" + id +"&buttonaction=edit"; 

    }

function AddFilesFn(id){

	

	

$.colorbox({iframe:true, href:"<?php echo SITE_BASE_URL;?>Property/AddFiles.html?id=" + id, innerWidth:700, innerHeight:350, onClosed:function(){

//window.location.reload();

//================================



    URL = "<?php echo SITE_BASE_URL;?>Property/Refresh1.html";

    $.ajax({url: URL, success: function(result){

        UplStr = "<table class='table'><tbody><tr><td>"+result+"</td></tr></tbody></table>";

        document.getElementById("image11").innerHTML=UplStr;

        document.getElementById("imageFile").value=result;

        alert("Updated Successfully");

    }});

 //===============================   

    } 



});





}

function DeleteFileFn(id,filename){

if (!confirm("Sure! Are you want to Delete File?")){

    return false;

}



URL = "<?php echo SITE_BASE_URL;?>Property/DeleteFile.html?FolderId=" + id + "&filename=" + filename;

console.log(URL)

$.ajax({url: URL, success: function(result){

    //alert(result)

    if (result.trim() == "success"){

        //alert("Deleted");

        //window.location.reload();

        //================================

    	    URL = "<?php echo SITE_BASE_URL;?>Property/Refresh.html?id=" + id ;

            $.ajax({url: URL, success: function(result){

                //alert(result)

                //alert("Error while delete : \n" + result);

                document.getElementById("imageFile").value=result;

                alert("Deleted Successfully");

            }});

    	 //===============================   

    }

    else{

        alert("Error while delete : \n" + result);

    }

}});

}

$(document).ready(function(){

    $(".date_picker").datepicker({

        dateFormat: 'dd/mm/yy',

        //defaultDate: '+1w',

        changeMonth: false,

        numberOfMonths: 1,

        showOn: 'both'

    });

});

</script>
<script src="javascripts/country-picker-flags/build/js/countrySelect.js"></script>
<script>
	$("#country_selector").countrySelect({
		preferredCountries: [ '<?php echo strtolower($country);?>']
	});
	$("#country_selector1").countrySelect({
		preferredCountries: [ '<?php echo strtolower($country);?>']
	});
</script>