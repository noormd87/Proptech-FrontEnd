<?php
\Html\HtmlClass::Init();
\login\loginClass::Init();
$checkSession = \login\loginClass::CheckUserSessionIp();
?>
<?php include "header.php"; ?>

<?php
$user_id            = \settings\session\sessionClass::GetSessionDisplayName();
$buttonaction   	= isset($_REQUEST["buttonaction"]) ? $_REQUEST["buttonaction"] : "";	

if ( $buttonaction == "edit"){
	
	$url = SITE_BASE_URL ."Property/index.html?d=".time()."&buttonaction=edit";
	
}else{
	
	
	$url = SITE_BASE_URL ."Property/index.html?d=" .time();
}

?>

    <div class="card">

        <div class="card-body">
            <h4 class="card-title">Floor Type</h4>
            <form name="form1" method="post"  enctype="multipart/form-data" action="<?php echo $url ;?>">
             <?php
				if ( !isset($_POST["submit"]) && $buttonaction !="edit" ) { ?>

    			<div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                    <th>PROJECT ID</th> 
                                    <th>PROJECT NAME</th>  
                                    <th>DESCRIPTION</th> 
                                    <!--<th>FLOOR TYPE</th> -->
                                    <th>COUNTRY</th>
                                    <th>EDIT</th> 
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                \Dashboard\DashboardClass::Init();
                                $rows = \Property\PropertyClass::GetProjectNew('');
                                $i = 1;
                                foreach ($rows as $row) 
                                {
                                    $CountryCodeNew=$row["COUNTRY_CODE_NEW"];
                                ?>
                                <tr>
                                  <td><?php echo $row["project_id"];?></td>
                                  <td><?php echo $row["project_name"];?></td>
                                  <td><?php echo $row["project_description"];?></td>
                                  <!--<td><?php //echo $row["floor_type"];?></td>-->
                                  <td><?php echo $CountryCodeNew;?></td>
                                  <td>
                                      <a class="btn btn-danger" href="javascript:void(0)" onclick="EditFn('<?php echo $row["project_id"];?>','<?php echo $row["floor_type"];?>')">
                                        <i class="fa fa-edit"></i>
                                     </a>
                                  </td>
                                </tr>
                                <?php
                                }
                                }?>
                              </tbody>
                            </table>
                            <?php 
                            $RowNum = 1; 
                            if ( $buttonaction =="edit" ) 
                            {
                            ?>
                                <table class="table table-bordered table-striped ">
                                    <thead>
                                        <tr>
                                            <th>PROJECT NAME</th>  
                                            <th>DESCRIPTION</th> 
                                            <th>FLOOR TYPE</th> 
                                            <th>COUNTRY</th> 
                                            <th>IMAGE</th>
                                        </tr>
                                    </thead>
                                    <tbody id="PROPERTYBody">
                                    
                                        <?php
                                            $RowNum = 1;
                                            $projectId  = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
                                            $FloorType  = isset($_REQUEST["floor"]) ? $_REQUEST["floor"] : "";
                                            
                                            $rows = \Property\PropertyClass::GetProjectFloor($projectId,$FloorType);
                                            $i = 1;
                                            foreach ($rows as $row) 
                                            {
                                                $CountryCodeNew=$row["COUNTRY_CODE_NEW"];
                                                    
                                                ?>
                                                <tr>
                                                  <td valign="top"><?php echo $row["project_name"];?><input type=hidden name='ProjectId' value='<?php echo $row["project_id"];?>'></td>
                                                  <td valign="top"><?php echo $row["project_description"];?></td>
                                                  <td valign="top"><?php echo $row["floor_type"];?><input type=hidden name='ProjectId' value='<?php echo $row["floor_type"];?>'></td>
                                                  <td valign="top"><?php echo $CountryCodeNew;?></td>
                                                   <td valign="top">
                                                        <div class="table row">
                                                             <?php echo \Property\PropertyClass::GetUploadedFiles($projectId,$row["floor_type"]); ?>
                                                          </div>
                                                          <Span id="Image<?php echo $projectId; ?><?php echo $row["floor_type"]; ?>">
                                                              
                                                          </Span>
                                                          <input class="form-control"  type="hidden" name="PropertyImage<?php echo $RowNum; ?>" id="PropertyImage<?php echo $RowNum; ?>"  value="<?php echo $PropertyImage; ?>" size="6" maxlength="200" autocomplete='off'>
                                                    </td> 
                                                    <td  width="4%" align=center>                                               
                                                        <input class="form-control" type="hidden" id="PropertyDtlStatus<?php echo $RowNum;?>" name="PropertyDtlStatus<?php echo $RowNum;?>" size='2'  value="Y"   />
                                                        <input class="form-control" type="hidden" id="propertyid<?php echo $RowNum;?>" name="propertyid<?php echo $RowNum;?>" size='2'  value="<?php echo $propertyid; ?>"   />
                                                        <input class="form-control" type="hidden" id="PROPERTYExistRowCount" name="PROPERTYExistRowCount" value='<?php echo $RowNum; ?>'>
                                                    </td> 
                                                </tr> 
                                                <?php
                                                $RowNum=$RowNum+1;
                                                
                                            }
                                           
            
                                         ?>                                                 
                                    </tbody>
                                </table>
                        <?php
                        }
                        ?>  
                          </div>
                </div>

            </div>

				<!-- <table width='100%' align='center'>
					<?php
    					if ( isset($_POST["submit"]) || $buttonaction =="edit") { 
						
							if ( $buttonaction =="edit")
								$NameVal = "Update";
							else
								$NameVal = "Save";
						?>
    				<tr>
						<td colspan="16" align="center">
							<button class="btn btn-blue btn-small btn_class bg-info" name="button" id="button" type="button" value="Save">
								<span class="icon-mail"></span> <?php echo $NameVal;?>
							</button>
						</td>
					</tr>
					<?php }?>
					<tr class='tableheader'>
    					<td align='right' colspan=16>
        					<input class="form-control" type="hidden" id="PROPERTYExistRowCount" name="PROPERTYExistRowCount" value='<?php echo $RowNum-1; ?>'>
        					<input class="form-control" type="hidden" name="TotalRowCount" id="TotalRowCount" value="<?php echo $TotalRowCount; ?>">
        					<input class="form-control" type="hidden" id="user_id" name="user_id" value='<?php echo $user_id; ?>'>
        					<input class="form-control" type="hidden" id="timeId" name="timeId" value='<?php echo $_REQUEST["d"]; ?>'>
    					</td>
					</tr>
				</table>-->
		</form>
        </div><!-- card body end -->
    </div><!-- card div end-->

</section>
</div><!-- end content-->
<?php include"footer.php"; ?>
<script>
    


    $(document).on("change", "[rel='Links']", function(){
        id = $(this).attr("client_id");
        menu_name = this.value;
        link_type = $(this).find('option:selected').attr("link_type");
        query_str = $(this).find('option:selected').attr("query_str");
        
        if (query_str == undefined){
            query_str = "";
        }
        
        if (query_str != ""){
            query_str = "&" + query_str;
        }
        
        //console.log("<?php echo SITE_BASE_URL; ?>" + link_type + ".html?d=<?php echo time(); ?>&id=" + id + query_str);
        //return false; 
        
        window.location.href = "<?php echo SITE_BASE_URL; ?>" + link_type + ".html?d=<?php echo time(); ?>&id=" + id + query_str; 
    });
    
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


        noOfClient	= $("[name='noOfClient']").val(); 

        if (isNaN(parseInt(noOfClient)))
                noOfClient = 0;

        if (parseInt(noOfClient) == 0){
                alert("Please type total client");
                return false; 
        }

        document.form1.submit();
});

    function EditFn(id,floor){ 
		window.location.href = "<?php echo SITE_BASE_URL; ?>Property/floortype.html?d=<?php echo time(); ?>&id=" + id +"&floor=" + floor +"&buttonaction=edit"; 
    }

    
	$(function () { 
    $(document).on("click", ".btn_add", function(){
    ProjectId	= $("[name='ProjectId']").val(); 
    if(ProjectId=="" || ProjectId==null)
    {
        alert("Select Project from the list");
        return false;
    }
    document.form1.submit();
    });


    });
    
	function AddFilesFn(id,floor){
	
	
    	$.colorbox({iframe:true, href:"<?php echo SITE_BASE_URL;?>Property/AddFiles.html?id=" + id +"&floor="+floor, innerWidth:700, innerHeight:350, onClosed:function(){
    	//window.location.reload();
    	//================================
    	
    	    URL = "<?php echo SITE_BASE_URL;?>Property/Refresh.html?id=" + id +"&floor="+floor;
    	    $.ajax({url: URL, success: function(result){
                //alert(result)
                //alert("Error while delete : \n" + result);
                document.getElementById("image11" + id+floor).innerHTML="";
                document.getElementById("Image" + id+floor).innerHTML=result;
                if(result!="" && result!=null)
                {
                    alert("Added Successfully");
                }
            }});
    	 //===============================   
    	    } 
    	
    	});
    
    
    }
    function DeleteFileFn(id,filename,floor){
        if (!confirm("Sure! Are you want to Delete File?")){
            return false;
        }
        
        URL = "<?php echo SITE_BASE_URL;?>Property/DeleteFile.html?FolderId=" + id + "&filename=" + filename +"&floor=" + floor;
        console.log(URL)
        $.ajax({url: URL, success: function(result){
            //alert(result)
            if (result.trim() == "success"){
                //alert("Deleted");
                //window.location.reload();
                //================================
            	    URL = "<?php echo SITE_BASE_URL;?>Property/Refresh.html?id=" + id +"&floor="+floor;
                    $.ajax({url: URL, success: function(result){
                        //alert(result)
                        //alert("Error while delete : \n" + result);
                        document.getElementById("image11" + id+floor).innerHTML="";
                        document.getElementById("Image" + id+floor).innerHTML=result;
                        if(result!="" && result!=null)
                        {
                            alert("Deleted Successfully");
                        }
                    }});
            	 //===============================   
            }
            else{
                alert("Error while delete : \n" + result);
            }
        }});
    }
</script>

</body>
</html>