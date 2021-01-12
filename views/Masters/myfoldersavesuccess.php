<?php include "header.php"; ?>
<?php
$Msg = \Masters\MastersClass::$SuccessMsg;

if ($Msg == "DeleteSuccess"){
    $MsgStr = "Successfully Deleted.";
}
else{
    $MsgStr = "Save Successfully.";
}
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
<div class="content">
  <div class="widget-title pl-4">
 
    <!-- Login Form -->
    <form action="<?php echo SITE_BASE_URL;?>Masters/myfolder.html?mode=upload" method="post" class="login-form" name='form1' enctype="multipart/form-data">
        <input type="hidden" name="UploadedFiles" id="UploadedFiles" class="mandate" value="<?php echo $UploadedFiles;?>" />
        
	   <div class="form-row">
	       <h3>MY FOLDERS</h3>
	   </div>
	   <div class="form-row">
    	  <div class="col-12">
    		 <strong><?php echo $MsgStr; ?></strong>
    		 
    		 <A HREF='<?php echo SITE_BASE_URL. "Masters/myfolder.html" ;?>'>Go Back</A>
    	  </div>
    	  
      </div>
      
		
	</form>
	
	
    
<div class="widget-content">
  </div>
</div>

</body>
</html>
<?php include"footer.php"; ?>