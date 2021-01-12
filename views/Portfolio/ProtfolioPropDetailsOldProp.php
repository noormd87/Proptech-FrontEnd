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





?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			
				<form class="dpo-form"  action="<?php echo SITE_BASE_URL;?>Property/PropertyFullDtl.html?id=&autoid=" name='frm' method="post" onsubmit="return validateForm()"  >
				    
				    <?php
				      
                        
                        $TodayDate = date('Y-m-d');
                        $ChkAnalysisArr     = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(*) AS CNT FROM property_analyzer_inputs WHERE fromflag ='R' AND userid ='{$user_id}' and DATE_FORMAT(created_date, '%Y-%m-%d') ='{$TodayDate}')");
                        $RecentAnaysisCnt   = $ChkAnalysisArr["0"]; // Arzath - 2020-08-02
                        
				        if($RecentAnalyse == "Y" && $RecentAnaysisCnt > 0 ){
				    ?>
				     <div class="pull-right">
                        <span id='compare' class="btn btn-primary" onclick='compareFn()' >View Compare</span>
                        <input type='hidden' name='MultiPropertyVal' id='MultiPropertyVal' value="<?php echo $MultiPropertyVal; ?>">
                    </div>
                    
				    <?php
				        }
				    ?>
	                <div id="saveProperty">
	               	  <!-- summary -->
	               	  <h3>Summary</h3>
	               	  <section>
	               	  	<div class="row">
	               	  		<div class="col-12">	
	               	  			<div class="card">
	               	  				<div class="card-body">
		               	  				<div class="row">
				               	  			<div class="col-md-4">
				               	  				<div class="form-group">
				               	  					<label>Country</label>
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
				               	  			<div class="col-md-4">
				               	  				<div class="form-group">
				               	  					<label>Property Name</label>
				               	  					<input class="form-control" type="text" name="MyPortFolioName" id ="MyPortFolioName" value="<?php echo $MyPortFolioName; ?>" >
				               	  				</div>
				               	  			</div>
				               	  			<div class="col-md-4">
				               	  				<div class="form-group">
				               	  					<label>Property Address</label>
				               	  					<input class="form-control" type="text" name="MyPortfolioPropAddress" id ="MyPortfolioPropAddress" value="<?php echo $MyPortfolioPropAddress; ?>" >
				               	  				</div>
				               	  			</div>
				               	  		</div>
				               	  		
				               	  	
				               	  			
				               	  		<div class="row"> 
				               	  		    <div class="col-md-3" style='display:none;' >
				               	  				<div class="form-group">
				               	  					<label>Currency</label>
					               	  				<select class="form-control" name="myportfolioCurrency" id="myportfolioCurrency" >
					               	  				     <?php
                                                            \Portfolio\PortfolioClass::Init();
                                                            $rows = \Portfolio\PortfolioClass::GetCountryData();
                                                            foreach ($rows as $row) 
                                                            {
                                                            ?>
                                                            <option value="<?php echo $row["CURRENCY"]; ?>"  <?php if( $myportfolioCurrency == $row["CURRENCY"] ) {?>   selected <?php } ?>  > <?php echo $row["CURRENCY"]; ?> </option>
                                                            <?php
                                                            }
                                                            
                                                            ?>
					               	  					
					               	  				
					               	  				</select>
				               	  				</div>
				               	  			</div>
				               	  			
				               	  			<div class="col-md-3">
				               	  					<div class="form-group">
				               	  					<label>Location</label>
				               	  					  <input class="form-control" type="text" name="Subrub" id="Suburb" placeholder="Suburb" value="<?php echo $Subrub;?>" />
                                                      <input class="form-control" type="hidden" name="LocationId" id="LocationId" placeholder="LocationId" value="<?php echo $LocationId;?>" >
                                                      <input class="form-control" type="hidden" name="IsProtFolio" id="IsProtFolio"  value="<?php echo $IsProtFolio;?>" >
                                                      <input class="form-control" type="hidden" name="RecentAnalyse" id="RecentAnalyse"  value="<?php echo $RecentAnalyse;?>" >
				               	  				</div> 
				               	  			</div>
				               	  			

				               	  			<div class="col-md-3" style='display:none;' >
				               	  			
				               	  			 	<div class="col-lg-4 col-md-5 col-sm-12 col-12">
                                    				<div class="form-group">
                                    					<label><b>image</b></label>
                                                        <input type="file" class="form-control mandate" name="UploadFile" id="UploadFile" Maxlength=200  value="<?php echo $UploadFile; ?>" ><span id='fp'></span>
                                                        
                                                        <?php
                                                        if ( $UploadedImagefile != "notupload" ){
                                                            
                                                        ?>
                                                         <a href='<?php SITE_BASE_URL ."uploads/portfolioimage/" .$imagefile; ?>'><?php echo $UploadedImagefile;?></a>
                                                        <?php
                                                        }
                                                        ?>
                                                        <input type='hidden' name="UploadedImagefile" id="UploadedImagefile"  value="<?php echo $UploadedImagefile; ?>" >
                                                        
                                    				</div>
                                			    </div>
                                			</div>
                                			
                                			
				               	  		</div>
				               	  		
				               	  		<div class="row"> 
				               	  		    <div class="col-9">
                                               <div class="analyser-submit-section">
                                                  <div class="btn-div text-left pt-4">
                                                     <ul class="list-inline">									
                                                        <li class="list-inline-item"> <button class="btn btn-outline-dark" type="submit"  >Click to Proceed</button></li>
                                                  </div>
                                               </div>
                                            </div>
                                        </div>
                	                                 
				               	  		
		               	  			</div>
	               	  			</div>
	               	  		</div>
	               	  	</div>
	               	  </section>
	               	  <!-- end summary -->	
	                  
	               </div>
	            </form>
			</div>
		</div>
	</div>
</div>

<!-- end row -->

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


