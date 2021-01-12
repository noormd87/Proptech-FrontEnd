<?php include "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<base href="<?php echo SITE_BASE_URL;?>">
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" hraef="images/favicon.png">
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
<div class="breadcrumb-area">
   <nav aria-label="breadcrumb" role="navigation">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page">Country Master</li>
      </ol>
   </nav>
</div>
<div class="content">
  <div class="widget-title pl-4">
 
    <!-- Login Form -->
    <form action="<?php echo SITE_BASE_URL;?>Masters/save.html" method="post" class="login-form" name='form1'>
	   <div class="form-row">
	       <h3>COUNTRY MASTER</h3>
	       <input type=hidden name='from' value='Country'>
	   </div>
	   <div class="form-row">
    	  <div class="col-1">
    		 <label class="form-check-label">
    		    <b>Country Name</b>
    		 </label>
    	  </div>
    	  <div class="col-2">
    		 <input type="text" class="form-control textbox mandate" name="CountryName" Maxlength=200>
    	  </div>
    	  <div class="col-1">
    		 <label class="form-check-label">
    			<b>Country Code</b>
    		 </label>
    	  </div>
    	  <div class="col-2">
    		 <input type="text" class="form-control textbox mandate" name="CountryCode" Maxlength=2>
    	  </div>
	  </div>
	  <div class="form-row">
    	  <div class="col-1">
    		 <label class="form-check-label">
    		    <b>Currency Code</b>
    		 </label>
    	  </div>
    	  <div class="col-2">
    		 <input type="text" class="form-control textbox mandate" name="CurrencyCode" Maxlength=3>
    	  </div>
    	  <div class="col-1">
    		 <label class="form-check-label">
    			<b>Flag image</b>
    		 </label>
    	  </div>
    	  <div class="col-2">
    		 <input type="text" class="form-control" name="FlagImg" Maxlength=200>
    	  </div>
	  </div>
	  <div class="form-row">
    	  <div class="col-6" align=center>
    		 <input type="button" class="btn btn-upgrade-rounded bg-orange addnewBtn" id="Save" value="Save">
    	  </div>
	  </div>
		
	</form>
    <div class="table row">
        <table class="table">
          <thead>
            <tr>
                <th>COUNTRY CODE</th> 
				<th>COUNTRY NAME</th> 
				<th>CURRENCY</th> 
				<th>IMAGE</th>
            </tr>
          </thead>
          <tbody>
            <?php
            \Masters\MastersClass::Init();
            $rows = \Masters\MastersClass::GetCountriesDatas('');
            $i = 1;
            foreach ($rows as $row) 
            {
            ?>
            <tr>
              <td><?php echo $row["country_code"];?></td>
              <td><?php echo $row["country_name"];?></td>
              <td><?php echo $row["currency"];?></td>
              <td><?php echo $row["image"];?></td>
            </tr>
            <?php
            }?>
          </tbody>
        </table>
      </div>
    
<div class="widget-content">
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
</script>