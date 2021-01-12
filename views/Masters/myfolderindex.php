<?php include"header.php"; ?>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL; ?>assets/plugins/customfileinputs/component.css">

<!-- My Folder Property Grid View -->
         <div class="title-wrapper row">
           <div class="col">
             <div class="">
               <h2 class="page-title">My Folder</h2>
             </div>
           </div>
         </div>
         
<?php
$Mode             = \Masters\MastersClass::$Mode;
if ($Mode == "edit"){
    \Masters\MastersClass::GetMyFolderDbValues();
    $FormUrl = "myfolderfileupdate.html";
}
else{
    $FormUrl = "myfolderfileupload.html";
}

$Id             = \Masters\MastersClass::$Id;
$DocName        = \Masters\MastersClass::$DocName;
$DocRemarks     = \Masters\MastersClass::$DocRemarks;
$Mode           = \Masters\MastersClass::$Mode;
$UploadedFiles  = \Masters\MastersClass::$UploadedFiles;

$FinYr          = \Masters\MastersClass::$FinYr;
$Category       = \Masters\MastersClass::$Category;
$Amount         = \Masters\MastersClass::$Amount;

$ProjectId      = \Masters\MastersClass::$ProjectId;
$ProjectName    = \Masters\MastersClass::$ProjectName;
$UnitNo         = \Masters\MastersClass::$UnitNo;

$PropertyCountryId = \Masters\MastersClass::$PropertyCountryId;
$currencyId = \Masters\MastersClass::$currencyId;

$BrochureFile  = \Masters\MastersClass::$BrochureFile;
$FilePath      = "";

//echo "File => " . $BrochureFile; 
//exit;

if ($BrochureFile != ""){
    $FilePath       = "uploads/myfolder/" . $BrochureFile; 
}

?>
   <!-- start compare properties row -->
   <div class="card mb-3 h-90">
      <div class="card-header">
         <h4>Title Heading</h4>
      </div>
      <div class="card-body">
        <form action="<?php echo SITE_BASE_URL;?>Masters/<?php echo $FormUrl; ?>?id=<?php echo $Id; ?>&mode=<?php echo $Mode; ?>" method="post" class="form-style-one" name='form1' onsubmit="return validateForm()"  enctype="multipart/form-data">
         <div class="row pt-4 pb-5 px-md-5 px-3">
            <div class="form-group col-md-6">
              <label for="">Property Name</label>
              <?php $CurSession = \settings\session\sessionClass::GetSessionUserName();?>
                <input class="form-control mandate" type="text" name="ProjectName" id="ProjectName" value="<?php echo $ProjectName?>" placeholder="Property Name">
            </div>
            <div class="form-group col-md-6">
              <label for="">Unit Number</label>
              <input class="form-control input-default" type="text" name="UnitNo" id="UnitNo" value="<?php echo $UnitNo?>" placeholder="Unit No">
            </div>
            <div class="form-group col-md-6">
              <label for="">Country</label>
              <?php echo \Html\Elements\InputsClass::plotCombo( "PropertyCountryId" , array() , "SELECT COUNTRY_CODE id, COUNTRY_NAME description FROM `country_master` ORDER BY COUNTRY_NAME" , 
                                                              $PropertyCountryId , "Select Country", "class='form-control'"); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="">Currency</label>
              <?php echo \Html\Elements\InputsClass::plotCombo( "currencyId" , array() , "SELECT currency_id id, description FROM currency_master order by description" , 
                                                              $currencyId , "Select Currency", "class='form-control'"); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="">Tax Year</label>
              <?php echo \Html\Elements\InputsClass::ShowFinYrDropdown( "FinYr" , array() , $FinYr, "Select Finance Year", "class='form-control'", $PropertyCountryId ); ?>
            </div>
            <div class="form-group col-md-6">
              <label for="">Category</label>
              <?php echo \Html\Elements\InputsClass::plotArrayCombo( "Category", "CATEGORY", $Category, "Select Category", "class='form-control'"); ?>
            </div>
            <div class="form-group col-md-6"> 
              <label for="">Amount</label>
              <input class="form-control" type="text" name="Amount" id="Amount" value="<?php echo $Amount?>" placeholder="$210000">
            </div>
            <div class="form-group col-md-6">
              <label for="">Upload Property Images</label>
              <div class="js">
                  <!--<input type="file" name="UploadFile" id="UploadFile" class="inputfile inputfile-1">-->
                  <input type="file" name="UploadFile" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple="">
                    <?php
                    if ($FilePath != ""){
                        echo "<a href='" . SITE_BASE_URL . $FilePath . "' target='_blank'>Uploaded File</a>";
                    }
                    ?>
                 <!--<input type="file" name="name-proof[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />-->
                 <label for="file-1"><img src="https://duvalknowledge.com/dpo/assets/img/download-icon-sm.png" class="img-fluid"> <span>Choose Files…</span></label>
              </div>
            </div>

            <div class="col-md-12">
                <?php 
                  if ($Mode == "edit"){
                      ?>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?php echo SITE_BASE_URL;?>Masters/myfolder.html">Back</a>
                <?php } else{ ?>
                    <button type="submit" class="btn btn-primary">Submit</button>
                <?php } ?>
              <!--<input type="submit" class="btn btn-primary" name="" value="Submit">-->
            </div>
         </div> 
         <div class="table-responsive">
           <table class="table table-hover table-striped table-bordered">
             <tbody>
               <tr class="bg-white">
                 <th class="t3">PROPERTY NAME</th>
                 <th class="t3">UNIT NO</th>
                 <th class="t3">TAX YEAR</th>
                 <th class="t3">CATEGORY</th>
                 <th class="t3">AMOUNT</th>
                 <th class="t3">ACTION</th>
               </tr>
               <?php
                \Masters\MastersClass::Init();
                $rows = \Masters\MastersClass::GetMyFolderDatas();
                $i = 1;
                foreach ($rows as $row) 
                {
                    $FinYr      = isset($row["FINANCE_YR"]) ? $row["FINANCE_YR"] : ""; 
                    $Cat        = isset($row["CATEGORY"]) ? $row["CATEGORY"] : ""; 
                    $FinYrText  = Html\Elements\InputsClass::GetFinYrValue($FinYr);
                    $Category   = Html\Elements\InputsClass::GetProjCategoryValue($Cat);
                    $UnitNo     = isset($row["UNIT_NO"]) ? $row["UNIT_NO"] : ""; 
                ?>
               <tr>
                 <td><?php echo $row["PROJECT_NAME"];?></td>
                  <td><?php echo $UnitNo;?></td>
                  <td><?php echo $FinYrText;?></td>
                  <td><?php echo $Category;?></td>
                  <td><?php echo $row["AMOUNT"];?></td>
                  <td>
                    <button type="button" class="btn btn-primary btn-sm" onclick="FnEdit('<?php echo $row["MY_FOLDER_ID"];?>')">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="FnDelete('<?php echo $row["MY_FOLDER_ID"];?>')">Delete</button>
                  </td>   
               </tr>
               <?php
                }?>
             </tbody>
           </table>
         </div>
         </form>
      </div>
   </div>
   <!-- end row -->



<?php include"footer.php"; ?>
<script src="<?php echo SITE_BASE_URL; ?>assets/plugins/customfileinputs/custom-file-input.js"></script>
<script>
function DeleteFolderFn(id){
    if (!confirm("Sure! Are you want to Delete Folder?")){
        return false;
    }
    URL = "<?php echo SITE_BASE_URL;?>Masters/DeleteFolder.html?FolderId=" + id;
    $.ajax({url: URL, success: function(result){
        if (result.trim() == "success"){
            window.location.reload();
        }
        else{
            alert("Error while delete : \n" + result);
        }
    }});
}

$(document).on("change", "[name='PropertyCountryId']", function(){
    URL = "<?php echo SITE_BASE_URL;?>Masters/GetFinYrDtls.html?PropertyCountryId=" + this.value;
    $.ajax({url: URL, dataType: 'JSON', success: function(result){
        $("[name='currencyId']").val(result.currencyId); 
        
        $("#TaxYrContainer").html(result.DpStr); 
    }});
});

function DeleteFileFn(id, filename){
    if (!confirm("Sure! Are you want to Delete File?")){
        return false;
    }
    URL = "<?php echo SITE_BASE_URL;?>Masters/DeleteFile.html?FolderId=" + id + "&filename=" + filename;
    console.log(URL)
    $.ajax({url: URL, success: function(result){
        if (result.trim() == "success"){
            window.location.reload();
        }
        else{
            alert("Error while delete : \n" + result);
        }
    }});
}

function AddFolderFn(){
	$.colorbox({iframe:true, href:"<?php echo SITE_BASE_URL;?>Masters/AddFolder.html", innerWidth:700, innerHeight:400, onClosed:function(){window.location.reload();} });
}

function AddFilesFn(id){
	$.colorbox({iframe:true, href:"<?php echo SITE_BASE_URL;?>Masters/AddFiles.html?id=" + id, innerWidth:700, innerHeight:350, onClosed:function(){window.location.reload();} });
}

function ViewFn(id){
    window.location.href = "<?php echo SITE_BASE_URL;?>Masters/myfolder.html?id=" + id;
}

function FnEdit(id){
    window.location.href = "<?php echo SITE_BASE_URL;?>Masters/myfolder.html?mode=edit&id=" + id;
}

function FnDelete(id){
    if (confirm("Are you sure want to Delete?") == false){
        return false; 
    }
    window.location.href = "<?php echo SITE_BASE_URL;?>Masters/DeleteFolder.html?mode=delete&id=" + id;
}

function AddFn(id){
    window.location.href = "<?php echo SITE_BASE_URL;?>Masters/myfolderadd.html";
}

function validateForm() {
    //PropertyCountryId,currencyId,FinYr,Category,Amount,file-1
    var ProjectName         =  $("#ProjectName").val();
    var UnitNo      =  $("#UnitNo").val();
    var PropertyCountryId      =  $("#PropertyCountryId").val();
    var currencyId      =  $("#currencyId").val();
    //var FinYr      =  $("#FinYr").val();
    var Category      =  $("#Category").val();
    var Amount      =  $("#Amount").val();
    var UpoadFile      =  $("#file-1").val();
    
    if (ProjectName == "" ){
        alert("Please Fill Project Name");
        $("#ProjectName").focus();
        return false;
    }
    if (UnitNo == "" ){
        alert("Please Fill Unit No");
        $("#UnitNo").focus();
        return false;
    }
    if (PropertyCountryId == "" ){
        alert("Please Fill Country");
        $("#PropertyCountryId").focus();
        return false;
    }
    if (currencyId == "" ){
        alert("Please Fill currency");
        $("#currencyId").focus();
        return false;
    }
    if (Category == "" ){
        alert("Please Fill Category");
        $("#Category").focus();
        return false;
    }
    if (UpoadFile == "" ){
        alert("Please Fill UpoadFile");
        $("#file-1").focus();
        return false;
    }
    
    /*
    $(".mandate:visible").each(function(){
       
           if (this.value == ""){
    
               alert("Please select field : " + this.name);
    
               $(this).focus();
    
               ErrCount++;
    
               return false;
    
           }
    
    });
    */
}

</script>
