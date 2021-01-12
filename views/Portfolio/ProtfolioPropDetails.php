<?php include"header.php"; 
$IsProtFolio   	               = $_REQUEST["IsProtFolio"] ? $_REQUEST["IsProtFolio"] : "N";
$RecentAnalyse   	           = $_REQUEST["RecentAnalyse"] ? $_REQUEST["RecentAnalyse"] : "N";
$UploadedImagefile             = $_REQUEST["UploadedImagefile"] ? $_REQUEST["UploadedImagefile"] : "";
$LocationId                    = $_REQUEST["LocationId"] ? $_REQUEST["LocationId"] : "";
$UploadFile                    = $_REQUEST["UploadFile"] ? $_REQUEST["UploadFile"] : "";
$Subrub                        = $_REQUEST["Subrub"] ? $_REQUEST["Subrub"] : "";
$myportfolioCurrency           = $_REQUEST["myportfolioCurrency"] ? $_REQUEST["myportfolioCurrency"] : "";
$MyPortfolioPropAddress        = $_REQUEST["MyPortfolioPropAddress"] ? $_REQUEST["MyPortfolioPropAddress"] : "";
$MyPortFolioName               = $_REQUEST["MyPortFolioName"] ? $_REQUEST["MyPortFolioName"] : "";
$myportfoliocountry            = $_REQUEST["myportfoliocountry"] ? $_REQUEST["myportfoliocountry"] : "";
$user_id   = \settings\session\sessionClass::GetSessionDisplayName();
if($IsProtFolio == "Y"){
    $FileHtml = "PortfolioFulDtl.html";
}else{
    $FileHtml = "PropertyFullDtl.html";
}
\login\loginClass::Init();
$rows = \login\loginClass::GetUserFullName();
$i = 1;
foreach ($rows as $row)
{
    $LoginFirstName = $row["first_name"];
    $LoginLastName = $row["last_name"];
    $LoginUserName = $row["user_id"];
    $LoginUserId = $row["id"];
    $ProfilePic = $row["image_file"];
}
?>
<!-- Inner Content Start-->
<div class="inner-wrapper">
    <div class="global-search pt-0" style="background-image:url('<?php echo SITE_BASE_URL;?>dashboard/assets/images/ria-bg.png');">
        <div class="g-search-holder pt-0">
            <div class="text">
                <?php
                    if($IsProtFolio == "Y"){
                        ?>
                        <h1>Add a Property to My Portfolio</h1>
                        <p>To add a property to your portfolio, first name your property in the boxes below and press GO!</p>
                        <?php
                    }
                    else
                    {
                        ?>
                        <h1>Build a Financial Model</h1>
                        <p>Want to prepare a financial model for a potential investment? Simply enter some information about the property and press Go!</p>
                        <?php
                    }
                ?>
            </div>
            <form class="form-style-one"  action="<?php echo SITE_BASE_URL;?>Property/<?php echo $FileHtml;?>?id=&autoid=" name='frm' method="post" onsubmit="return validateForm()" >     
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="text-light">Country</label>
                                <select class="form-control" name="myportfoliocountry" id="myportfoliocountry" >
       	  				        <?php
                                \Portfolio\PortfolioClass::Init();
                                $rows = \Portfolio\PortfolioClass::GetCountryData();
                                foreach ($rows as $row) 
                                {
                                ?>
                                    <option value="<?php echo $row["COUNTRY_CODE"]; ?>"  <?php if( $myportfoliocountry == $row["COUNTRY_CODE"] ) {?>   selected <?php } ?>  > <?php echo $row["COUNTRY_NAME"]; ?> </option>
                                <?php
                                }
                                ?>
           	  				    </select>
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="text-light">Suburb</label>
                                <input class="form-control class_sub " type="text" name="Subrub" id="Suburb" placeholder="Suburb" value="<?php echo $Subrub;?>"  /> 
                                <input class="form-control" type="hidden" name="LocationId" id="LocationId" placeholder="LocationId" value="<?php echo $LocationId;?>" >
                                <input class="form-control" type="hidden" name="IsProtFolio" id="IsProtFolio"  value="<?php echo $IsProtFolio;?>" >
                                <input class="form-control" type="hidden" name="RecentAnalyse" id="RecentAnalyse"  value="<?php echo $RecentAnalyse;?>" >
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="text-light">Property Name</label>
                                <input class="form-control" type="text" name="MyPortFolioName" id ="MyPortFolioName" value="<?php echo $MyPortFolioName; ?>" >
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="text-light">Property Address</label>
                                <input class="form-control" type="text" name="MyPortfolioPropAddress" id ="MyPortfolioPropAddress" value="<?php echo $MyPortfolioPropAddress; ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="text-right mb-4 mt-4">
                        <button type="submit" class="btn btn-orange d-block ml-auto">Go</button>
                    </div>
                </form>
        </div>
    </div>
</div>
<!-- Inner Content End-->

  
 <script>
        var FnNulltoAmt = function(Value){
            if (isNaN(parseFloat(Value)))
                Value = 0;
                
            return Value;
        };
    
       
     function validateForm() {
        
        
        var MyPortFolioName         =  $("#MyPortFolioName").val();
        var myportfoliocountry      =  $("#myportfoliocountry").val();
        var Subrub                  =  $("#Suburb").val();
        var MyPortfolioPropAddress  =  $("#MyPortfolioPropAddress").val();
        var LocationId              =  $("#LocationId").val();
        
        var RecentAnalyse           =  $("#RecentAnalyse").val();
        var IsProtFolio             =  $("#IsProtFolio").val();
        
        

      
       
        if (myportfoliocountry == "" ){
            
            alert("Please Fill Property Name");
            $("#MyPortFolioName").focus();
            return false;
            
        }
        
        
        if (MyPortFolioName == "" ){
            
            alert("Please Fill Property Name");
            $("#MyPortFolioName").focus();
            return false;
            
        }
        

       //document.frm.submit();

         
    }
   
     function compareFn(){
    
        
        document.frm.action='<?php echo SITE_BASE_URL;?>Portfolio/Portfolio.html?ViewCompare=R&IsEligible=Y&compareVal=Y';
        document.frm.submit();
        
        //alert();
        
    }
       
     

</script>
  

                <?php include"footer.php"; ?>