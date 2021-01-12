<?php
$DocName        = \Masters\MastersClass::$DocName;
$DocRemarks     = \Masters\MastersClass::$DocRemarks;
$Mode           = \Masters\MastersClass::$Mode;
$UploadedFiles  = \Masters\MastersClass::$UploadedFiles;

?>
<?php //include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/css/style.css">
<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
<script src="<?php echo SITE_BASE_URL;?>assets/js/core/jquery.min.js"></script>

<div class="content">
  <div class="card">
    <div class="card-body">
        <form action="<?php echo SITE_BASE_URL;?>Masters/SaveNewFolder.html?mode=upload" method="post" class="dpo-form" name='form1' enctype="multipart/form-data">
        <input type="hidden" name="UploadedFiles" id="UploadedFiles" class="mandate" value="<?php echo $UploadedFiles;?>" />
    
       <div class="widget-title">
           <h3>MY FOLDERS</h3>
       </div>       
       <div class="form-group">
            <label class="">Folder Name</label>
            <input type="text" class="form-control textbox mandate" name="DocName" value="<?php echo $DocName;?>" Maxlength=100>
        </div>

        <div class="form-group">
            <label>Remarks</label>
            <input type="text" class="form-control textbox mandate" name="DocRemarks" value="<?php echo $DocRemarks;?>" Maxlength="200">
        </div>


          <div class="form-group">
            <input type="button" class="btn btn-info" id="ViewBtn" value="Add Folder" onclick="SaveNewFolderFn()">
          </div>
      </div>
        
    </form>
    </div>
    <!-- Login Form -->
    
  </div>
</div>


<script>	
function SaveNewFolderFn(){
	//$.colorbox({iframe:true, href:"<?php echo SITE_BASE_URL;?>Masters/SaveNewFolder.html", innerWidth:600, innerHeight:200});
	document.form1.submit();
}
</script>


	