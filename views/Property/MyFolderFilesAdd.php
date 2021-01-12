<?php
//$DocName        = \Property\PropertyInterface::$DocName;
//$DocRemarks     = \Property\PropertyInterface::$DocRemarks;
//$Mode           = \Property\PropertyInterface::$Mode;
//$UploadedFiles  = \Property\PropertyInterface::$UploadedFiles;
$Id				= \Property\PropertyClass::$Id;
$floor				= \Property\PropertyClass::$floor;
\login\loginClass::Init();
$checkSession = \login\loginClass::CheckUserSessionIp();

?>
<?php //include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/css/style.css">
<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
<!-- jasny -->
<link href="<?php echo SITE_BASE_URL;?>assets/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
<script src="<?php echo SITE_BASE_URL;?>assets/js/core/jquery.min.js"></script>
<!-- Jasny -->
<script src="<?php echo SITE_BASE_URL;?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<div class="content">
    <div class="card">
        <div class="card-body">  
  
 
    <form action="<?php echo SITE_BASE_URL;?>Property/SaveNewFile.html?id=<?php echo $Id; ?>&floor=<?php echo $floor; ?>&mode=upload" method="post" class="dpo-form" name='form1' enctype="multipart/form-data">
        <input type="hidden" name="UploadedFiles" id="UploadedFiles" class="mandate" value="<?php echo $UploadedFiles;?>" />
        
	   <div class="widget-title">
	       <h3>UPLOAD FILE</h3>
	   </div>
	   <div class="form-group">
		  <p><?php echo $DocName;?></p>
		  <p><i><?php echo $DocRemarks;?></i></p>
	   </div>
	  
	  <?php
	  $Mode="Upload";
	  if ($Mode != "view"){ ?>
	  
	  <div class="form-group">
          <div class="form-group pb-3">
               <div class="fileinput fileinput-new pt-3" data-provides="fileinput">
                  <span class="btn btn-primary btn-file"><span class="fileinput-new">CHOOSE FILE</span>
                  <span class="fileinput-exists">Change</span><input type="file" name="UploadFile" id="UploadFile"></span>
                  <span class="fileinput-filename"></span>
                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
               </div>
               <label>Choose your file to upload</label>
            </div>
    	   <!-- <input type="file" class="form-control" name="UploadFile" id="UploadFile" /> -->
        </div>
        <div class="form-group">
    		 <input type="button" class="btn btn-info UploadBtn" id="Upload" value="Upload" onclick="SaveNewFolderFn();">
    	</div>
    	  
      </div>
      <?php } ?>
      
      
      
      <?php /*if (self::$Mode != "view"){ ?>
      
	  <div class="form-row">
    	  <div class="col-6" align=center>
    		 <input type="button" class="btn btn-info addnewBtn" id="Save" value="Save">
    	  </div>
	  </div>
	  
	  <?php }*/ ?>
		
	</form>
    </div>  
    </div>
  </div>
</div>


<script>	
function SaveNewFolderFn(){
	//$.colorbox({iframe:true, href:"<?php echo SITE_BASE_URL;?>Masters/SaveNewFolder.html", innerWidth:600, innerHeight:200});
	document.form1.submit();
}
</script>


	