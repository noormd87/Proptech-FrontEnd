<?php include "header.php"; 

$buttonaction   	= isset($_REQUEST["buttonaction"]) ? $_REQUEST["buttonaction"] : "";	
$url = ($buttonaction == "update") ? SITE_BASE_URL ."Masters/save.html?d=".time() : SITE_BASE_URL ."Masters/save.html?d=" .time() ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<base href="<?php echo SITE_BASE_URL;?>">
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="images/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    DU VAL PRIVATE OFFICE
  </title>
  <style>
  input.textbox {
        text-transform: uppercase;
    }
  </style>
  
  <!--     Fonts and icons     -->
</head>
<body>
<div class="card">
  <div class="card-body">
    <?php
    
      if ($buttonaction =="update")
        {
            $CountryCode=$_REQUEST["id"];
            $rowscountry = \Masters\MastersClass::GetCountyDataByCode($CountryCode);
              foreach ($rowscountry as $row) 
              {
                $CountryName1 		= $row["country_name"];
                $Country_Code1	    = $row["country_code"];
                $FlagImg 	        = $row["image"];
                $currency12    	    = $row["currency"];
                $IsActivate1 	    = $row["is_activate"];
              }
        }
    ?>
    <!-- Login Form -->
    <h4 class="card-title">COUNTRY MASTER</h4>
    <form action="<?php echo $url; ?>" method="post" name='form1'>
	   <input type=hidden name='from' value='Country'>
         <input type=hidden name='countryCode' value='<?php echo $CountryCode; ?>'>
	   <div class="form-row">
    	  <div class="col-md-4 col-12">
          <div class="form-group ">
            <label>Country Name</label>
            <input type="text" class="form-control textbox mandate" value="<?php echo $CountryName1; ?>" name="CountryName" Maxlength=200>
          </div>
        </div>
    	  <div class="col-md-4 col-12">
          <div class="form-group ">
          <label>Country Code</label>
         <input type="text" class="form-control textbox mandate" value="<?php echo $Country_Code1; ?>" name="CountryCode" Maxlength=2>
        </div>
    		 
    	  </div>

        <div class="col-md-4 col-12">
          <div class="form-group">
            <label>Currency Code</label>
         <select class="form-control mandate" name="CurrencyCode" id='CurrencyCode' onchange='SetCurrencies()'>
              <?php 
              \login\loginClass::Init();
               $Countryrows = \Masters\MastersClass::GetCurrencyDtl('');
               $i = 1;
               foreach ($Countryrows as $Countryrow) 
               {
                   $Currencies=$Countryrow["currency_id"];
                ?>
                <option value="<?php echo $Currencies;?>" <?php if($Currencies==$currency12){?>selected<?php }?> ><?php echo $Currencies;?></option>  
             <?php       
               }
               ?>
            </select>
          </div>
        </div>
        <div class="form-group col-12 text-center"> 
         <label class="form-check-label">Is Active</label>
         <input type=checkbox name="IsActivate" value="Y"  <?php if($IsActivate1!="N"){ ?> checked<?php } ?>> 
         <input type="button" class="btn btn-danger addnewBtn ml-md-2" id="Save" value="<?php echo ($buttonaction =="update") ? 'Update' : 'Save'; ?>">
        </div>
	  </div>
		
	</form>
</div>
</div>

<div class="card">
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
          <thead>
            <tr>
          <th>COUNTRY CODE</th> 
        <th>COUNTRY NAME</th> 
        <th>CURRENCY</th> 
        <th>ACTIVE STATUS</th>
        <th>EDIT</th> 
        <th>DELETE</th>
            </tr>
          </thead>
          <tbody>
            <?php
            //\Masters\MastersClass::Init();
            $rows = \Masters\MastersClass::GetCountyDataByCode('');
            $i = 1;
            foreach ($rows as $row) 
            {
            ?>
            <tr>
            
              <td><?php echo $row["country_code"];?></td>
              <td><?php echo $row["country_name"];?></td>
              <td><?php echo $row["currency"];?></td>
              <td><?php echo $row["is_activate"];?></td>
              <td align="left">
            <a class="btn btn-success btn-sm" href="javascript:void(0)" onclick="updateCountry('<?php echo $row['country_code']?>')">
              <i class="fa fa-edit"></i>
            </a>
              </td>
              <td><a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteCountry('<?php echo $row['country_code'];?>')">
                          <i class="fa fa-trash"></i>
                        </a></td>

            </tr>
            <?php
            }?>
          </tbody>
        </table>
      </div>
  </div>  
</div>

</body>
</html>
<?php include"footer.php"; ?>
<script>
$(document).on("click", ".addnewBtn", function(){
    ErrCount = 0;
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

    document.form1.submit();
});
function updateCountry(id){ 
		window.location.href = "<?php echo SITE_BASE_URL; ?>Masters/Country.html?d=<?php echo time(); ?>&id=" + id +"&buttonaction=update"; 
}

function deleteCountry(id){
        if (!confirm("Sure! Are you want to Delete country ?")){
            return false;
        }
        
        URL = "<?php echo SITE_BASE_URL;?>Masters/DeleteCountry.html?countryCode=" + id;
        window.location.href = URL;
    }
</script>