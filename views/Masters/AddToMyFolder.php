<?php

$DocName        = \Masters\MastersClass::$DocName;

$DocRemarks     = \Masters\MastersClass::$DocRemarks;

$Mode           = \Masters\MastersClass::$Mode;

$UploadedFiles  = \Masters\MastersClass::$UploadedFiles;

$BrochureFile   = \Masters\MastersClass::$BrochureFile;

?>

<?php //include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/css/style.css">
<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
<script src="<?php echo SITE_BASE_URL;?>assets/js/core/jquery.min.js"></script>



<div class="content">
  <div class="card">
        <div class="card-body">    

 

    <!-- Login Form -->

    <!--<form name='form1' method='post' action='" . SITE_BASE_URL . "/Masters/AddToMyFolderSave'>-->

    <form action="<?php echo SITE_BASE_URL;?>Masters/AddToMyFolderSave.html?filename=<?php echo $BrochureFile;?>" method="post" class="dpo-form" name='form1'>

	   <div class="widget-title">

	       <h3>SAVE BROCHURE TO MY FOLDERS</h3>

	   </div>

	   <div class="form-group">
    		 <label for="">Folder Name</label>
    	
    	      <select class="form-control" name="FolderId" id="FolderId" >

    	      <?php

    	        $IndexQry	= "SELECT `MY_FOLDER_ID`, `DOC_NAME` FROM `my_folders` where 1=1 " ;

                  

                $rows = \DBConn\DBConnection::getQuery( $IndexQry ); 

                $i = 1;

                foreach ($rows as $row){

                    echo "<option value=" . $row["MY_FOLDER_ID"] . ">" . $row["DOC_NAME"] . "</option>";

                }

    	      ?>

    		 </select>
             </div>
             <input type="button" class="btn btn-info" id="ViewBtn" value="Add Folder" onclick="AddToMyFolderSaveFn()">
	  </div>

		

	</form>

  </div>

</div>





<script>	

function AddToMyFolderSaveFn(){

	//$.colorbox({iframe:true, href:"<?php echo SITE_BASE_URL;?>Masters/SaveNewFolder.html", innerWidth:600, innerHeight:200});

	document.form1.submit();

}

</script>





	