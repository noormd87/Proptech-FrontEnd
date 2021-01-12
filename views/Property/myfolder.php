<?php
$DocName        = \Masters\MastersClass::$DocName;
$DocRemarks     = \Masters\MastersClass::$DocRemarks;
$Mode           = \Masters\MastersClass::$Mode;
$UploadedFiles  = \Masters\MastersClass::$UploadedFiles;
\login\loginClass::Init();
$checkSession = \login\loginClass::CheckUserSessionIp();
?>
<?php include "header.php"; ?>
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
    <form action="<?php echo SITE_BASE_URL;?>Masters/myfolderadd.html?mode=upload" method="post" class="login-form" name='form1' enctype="multipart/form-data">
        <input type="hidden" name="UploadedFiles" id="UploadedFiles" class="mandate" value="<?php echo $UploadedFiles;?>" />
        
	   <div class="form-row">
	       <h3>MY FOLDERS</h3>
	   </div>
	   <div class="form-row">
    	  <div class="col-2">
    		 <label class="form-check-label">
    		    <b>Document Name</b>
    		 </label>
    	  </div>
    	  <div class="col-3">
    		 <input type="text" class="form-control textbox mandate" name="DocName" value="<?php echo $DocName;?>" Maxlength=100>
    	  </div>
    	  <div class="col-1">
    		 <label class="form-check-label">
    			<b>Remarks</b>
    		 </label>
    	  </div>
    	  <div class="col-3">
    		 <input type="text" class="form-control textbox mandate" name="DocRemarks" value="<?php echo $DocRemarks;?>" Maxlength="200">
    	  </div>
	  </div>
	  
	  <?php if (self::$Mode != "view"){ ?>
	  
	  <div class="form-row">
    	  <div class="col-2">
    		 <label class="form-check-label">
    		    <b>Upload</b>
    		 </label>
    	  </div>
    	  <div class="col-3">
    		 <input type="file" class="form-control" name="UploadFile" id="UploadFile" />
    	  </div>
    	  <div class="col-2">
    		 <input type="button" class="btn btn-upgrade-rounded bg-orange UploadBtn" id="Upload" value="Upload">
    	  </div>
    	  
      </div>
      <?php } ?>
      
      <?php/*
	  <div class="form-row">
    	  <div class="col-8">
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
      </div>
      */?>
      
      
      <div class="table row">
         <?php echo \Masters\MastersClass::GetUploadedFiles(); ?>
      </div>
      
      
      <?php if (self::$Mode != "view"){ ?>
      
	  <div class="form-row">
    	  <div class="col-6" align=center>
    		 <input type="button" class="btn btn-upgrade-rounded bg-orange addnewBtn" id="Save" value="Save">
    	  </div>
	  </div>
	  
	  <?php } ?>
		
	</form>
	
	
	
	<!--
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
              <td><?php echo $row["COUNTRY_CODE_NEW"];?></td>
              <td><?php echo $row["country_name"];?></td>
              <td><?php echo $row["currency"];?></td>
              <td><?php echo $row["image"];?></td>
            </tr>
            <?php
            }?>
          </tbody>
        </table>
      </div>
      --->
    
<div class="widget-content">
  </div>
</div>

</body>
</html>
<?php include"footer.php"; ?>
<script>

function DeleteFile(seq, filename){
    var UploadedFiles = $("[name='UploadedFiles']").val();
    var TmpUploadedFiles = "";
    
    if (UploadedFiles != ""){
        ArrUploadedFiles = UploadedFiles.split(",");
        
        for (i = 0; i <= ArrUploadedFiles.length-1; i++){
            //alert(ArrUploadedFiles[i])
            if (filename != ArrUploadedFiles[i]){
                if (TmpUploadedFiles == ""){
                    TmpUploadedFiles = ArrUploadedFiles[i];
                }
                else{
                    TmpUploadedFiles = TmpUploadedFiles + "," + ArrUploadedFiles[i];
                }
            }
        }
    }
    
    //alert(TmpUploadedFiles)
    $("[name='UploadedFiles']").val(TmpUploadedFiles);
    
    $(".filestable tr[trrow='" + seq + "']").remove();
    
    alert("removed")
}

$(document).on("click", ".UploadBtn", function(){
    ErrCount = 0;
    
    Obj = $("[name='UploadFile']");
    
    if (Obj.value == ""){
            alert("Please select field : " + Obj.name);
            Obj.focus();
            ErrCount++;
            return false;
        }

    if (ErrCount != 0){
            return false;
    }

    document.form1.submit();
});

$(document).on("click", ".addnewBtn", function(){
    ErrCount = 0;
    $(".mandate").each(function(){
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
    
    document.form1.action = "<?php echo SITE_BASE_URL;?>Masters/myfoldersave.html"
    document.form1.submit();
});
</script>