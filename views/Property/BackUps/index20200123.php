<?php
\Html\HtmlClass::Init();
?>
<?php include "header.php"; ?>
<div class="content">
<section>
    <div class="card">
        <div class="card-header pb-3">
          <div class="widget-title row">
            <div class="col text-left"><h3>Property Master</h3></div>
            <!-- <div class="col text-right"><a class="nav-link requestfullscreen" href="#"><img class="img-fluid" src="assets/img/maxmize-icon.png" alt="Maximize"></a><a href="#" class="exitfullscreen" style="display: none"><img class="img-fluid" src="assets/img/minimize-icon.png" alt="Maximize"></a></div> -->
          </div>
       </div>
        <div class="card-body">
            <form name="form1" method="post"  enctype="multipart/form-data" action="<?php echo SITE_BASE_URL; ?>Property/index.html?d=<?php echo time(); ?>">
                     <?php
    					if ( !isset($_POST["submit"]) ) { ?>
    
    					<div class=form-group>
    						<label for="">File CSV Upload</label>
                            <div class="form-group">
               <div class="fileinput fileinput-new" data-provides="fileinput">
                  <span class="btn btn-primary btn-file"><span class="fileinput-new">CHOOSE FILE</span>
                  <span class="fileinput-exists">Change</span><input type="file" nname="file" id="file" size="150"></span>
                  <span class="fileinput-filename"></span>
                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
               </div>
               <label>Choose your CSV file to upload</label>
            </div>
    						<!-- <input class="form-control" type="file" name="file" id="file" size="150"> -->
    					</div>

    					<button type="submit" class="btn btn-info" name="submit" value="submit">Add New Property</button>
                        <hr>
    					<div class="table row">
                            <table class="table">
                              <thead>
                                <tr>
                                    <th>ID</th> 
    								<th>PROPERTY NAME</th> 
    								<th>PROPERTY ADDRESS</th> 
    								<th>DESCRIPTION</th> 
    								<th>PROPERTY TYPE</th> 
    								<th>LAND AREA</th> 
    								<th>NO OF BED<br>ROOMS</th> 
    								<th>NO OF PARKING<br>SPACE</th> 
    								<th>NO OF BATH<br>ROOM</th> 
    								<th>RATE<br>(SILVER)</th> 
    								<th>RATE<br>(GOLD)</th> 
    								<th>RATE<br>(PLATINAM)</th>
    								<th>WEEKLY<br>RENT</th> 
    								<th>COUNTRY<br>CODE</th> 
    								<th>PROPERTY<br>IMAGE</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                \Dashboard\DashboardClass::Init();
                                $rows = \Property\PropertyClass::GetPropertiesDatas('','');
                                $i = 1;
                                foreach ($rows as $row) 
                                {
                                    switch ($row["property_type"]) {
                                    case "1":
                                        $PropertyType= "House";
                                        break;
                                    case "2":
                                        $PropertyType= "Townhouse";
                                        break;
                                    case "3":
                                        $PropertyType= "Unit/Apartment";
                                        break;
                                    case "4":
                                        $PropertyType= "Block of Units";
                                        break;
                                    case "5":
                                        $PropertyType= "Land";
                                        break;
                                    case "6":
                                        $PropertyType= "Rural";
                                        break;
                                    case "7":
                                        $PropertyType= "Commercial";
                                        break;
                                    case "8":
                                        $PropertyType= "Other";
                                        break;
                                    default:
                                        $PropertyType= "";
                                }
                                ?>
                                <tr>
                                  <td><?php echo $row["property_id"];?></td>
                                  <td><?php echo $row["property_name"];?></td>
                                  <td><?php echo $row["property_address"];?></td>
                                  <td><?php echo $row["description"];?></td>
                                  <td><?php echo $PropertyType;?></td>
                                  <td><?php echo $row["land_area"];?></td>
                                  <td><?php echo $row["no_of_bedrooms"];?></td>
                                  <td><?php echo $row["no_of_parkingspace"];?></td>
                                  <td><?php echo $row["no_of_bathroom"];?></td>
                                  <td><?php echo $row["rate_silver"];?></td>
                                  <td><?php echo $row["rate_gold"];?></td>
                                  <td><?php echo $row["rate_platinum"];?></td>
                                  <td><?php echo $row["weekly_rent"];?></td>
                                  <td><?php echo $row["country_code"];?></td>
                                  <td><?php echo $row["property_image"];?></td>
                                </tr>
                                <?php
                                }?>
                              </tbody>
                            </table>
                          </div>
                        </div>
    				<?php }?>
                        
                    <div class="widget-content">
    					
    				<?php $RowNum = 1; 
    				if ( isset($_POST["submit"]) ) 
    				{?>
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>S.NO</th> 
    								<th>PROPERTY NAME</th> 
    								<th>PROPERTY ADDRESS</th> 
    								<th>DESCRIPTION</th> 
    								<th>PROPERTY TYPE</th> 
    								<th>LAND AREA</th> 
    								<th>NO OF BED<br>ROOMS</th> 
    								<th>NO OF PARKING<br>SPACE</th> 
    								<th>NO OF BATH<br>ROOM</th> 
    								<th>RATE<br>(SILVER)</th> 
    								<th>RATE<br>(GOLD)</th> 
    								<th>RATE<br>(PLATINAM)</th>
    								<th>WEEKLY<br>RENT</th> 
    								<th>COUNTRY<br>CODE</th> 
    								<th>PROPERTY<br>IMAGE</th>
    								<th>
    								    <button class="btn btn-upgrade-rounded bg-orange" onClick="javaScript:AddRowPROPERTY('PROPERTY');return false;">
                                          Add
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="PROPERTYBody">
                                <?php
                                if( $_FILES["file"]["name"]=="" || $_FILES["file"]["name"]==null)
                                {
                                    
                                    $_FILES["file"]["name"]="Property.csv";
                                    $_FILES["file"]["tmp_name"]="Property.csv";
                                }
                                if ($_FILES["file"]["name"]) 
    							{
    								$filename=explode(".",$_FILES["file"]["name"]);
    								if ($filename[1]=="csv")
    								{
    									$handle=fopen($_FILES["file"]["tmp_name"],"r");
    									$RowNum=1;
    									while($data = fgetcsv($handle))
    									  {
    										$PropertyName=$data[0];
    										$PropertyAddress=$data[1];
    										$Description=$data[2];
    										$PropertyType=$data[3];
    										$LandArea=$data[4];
    										$NoOfBedrooms=$data[5];
    										$NoOfParkingspace=$data[6];
    										$NoOfBathroom=$data[7];
    										$RateSilver=$data[8];
    										$RateGold=$data[9];
    										$RatePlatinum=$data[10];
    										$WeeklyRent=$data[11];
    										$CountryCode=$data[12];
    										$PropertyImage=$data[13];
    									?>
    									<tr class=tablebg2 id="PROPERTYRow<?php echo $RowNum; ?>">
    										<td style='display:no ne'><input class="form-control" class='tablebg2' type="text" name="Seq<?php echo $RowNum; ?>" id="Seq<?php echo $RowNum; ?>" value="<?php echo $RowNum; ?>" style="border:no ne;" size='2' readonly /> </td>
    										<td valign="top">
    											<input class="form-control"  type="text" name="PropertyName<?php echo $RowNum; ?>" id="PropertyName<?php echo $RowNum; ?>"  value="<?php echo $PropertyName; ?>" size="15" maxlength="11" autocomplete='off'>
    										</td> 
    										<td valign="top">
    											<textarea class="form-control" name="PropertyAddress<?php echo $RowNum; ?>" id="PropertyAddress<?php echo $RowNum; ?>" rows="3" cols="10" autocomplete='off'><?php echo $PropertyAddress; ?></textarea>
    										</td> 
    										<td valign="top">
    											<textarea class="form-control" name="Description<?php echo $RowNum; ?>" id="Description<?php echo $RowNum; ?>" rows="3" cols="10" autocomplete='off'><?php echo $Description; ?></textarea>
    										</td> 
    										<td valign="top">
    											<select name="PropertyType<?php echo $RowNum; ?>" id="PropertyType<?php echo $RowNum; ?>" required="" aria-required="true" class="form-control" >
    										        <option value="">Select</option>
    										        <option value="1" <?php if($PropertyType==1){?>SELECTED <?php }?>>House</option>
    										        <option value="2" <?php if($PropertyType==2){?>SELECTED <?php }?>>Townhouse</option>
    										        <option value="3" <?php if($PropertyType==3){?>SELECTED <?php }?>>Unit/Apartment</option>
    										        <option value="4" <?php if($PropertyType==4){?>SELECTED <?php }?>>Block of Units</option>
    										        <option value="5" <?php if($PropertyType==5){?>SELECTED <?php }?>>Land</option>
    										        <option value="6" <?php if($PropertyType==6){?>SELECTED <?php }?>>Rural</option>
    										        <option value="7" <?php if($PropertyType==7){?>SELECTED <?php }?>>Commercial</option>
    										        <option value="8" <?php if($PropertyType==8){?>SELECTED <?php }?>>Other</option>
    										    </select>
    										</td> 
    										<td valign="top">
    											<input class="form-control"  type="text" name="LandArea<?php echo $RowNum; ?>" id="LandArea<?php echo $RowNum; ?>"  value="<?php echo $LandArea; ?>" size="6" maxlength="11" autocomplete='off'>
    										</td> 
    										<td valign="top">
    											<input class="form-control"  type="text" name="NoOfBedrooms<?php echo $RowNum; ?>" id="NoOfBedrooms<?php echo $RowNum; ?>"  value="<?php echo $NoOfBedrooms; ?>" size="3" maxlength="11" autocomplete='off'>
    										</td> 
    										<td valign="top">
    											<input class="form-control"  type="text" name="NoOfParkingspace<?php echo $RowNum; ?>" id="NoOfParkingspace<?php echo $RowNum; ?>"  value="<?php echo $NoOfParkingspace; ?>" size="3" maxlength="11" autocomplete='off'>
    										</td> 
    										<td valign="top">
    											<input class="form-control"  type="text" name="NoOfBathroom<?php echo $RowNum; ?>" id="NoOfBathroom<?php echo $RowNum; ?>"  value="<?php echo $NoOfBathroom; ?>" size="3" maxlength="11" autocomplete='off'>
    										</td> 
    										<td valign="top">
    											<input class="form-control"  type="text" name="RateSilver<?php echo $RowNum; ?>" id="RateSilver<?php echo $RowNum; ?>"  value="<?php echo $RateSilver; ?>" size="6" maxlength="11" autocomplete='off'>
    										</td> 
    										<td valign="top">
    											<input class="form-control"  type="text" name="RateGold<?php echo $RowNum; ?>" id="RateGold<?php echo $RowNum; ?>"  value="<?php echo $RateGold; ?>" size="6" maxlength="11" autocomplete='off'>
    										</td> 
    										<td valign="top">
    											<input class="form-control"  type="text" name="RatePlatinum<?php echo $RowNum; ?>" id="RatePlatinum<?php echo $RowNum; ?>"  value="<?php echo $RatePlatinum; ?>" size="6" maxlength="6" autocomplete='off'>
    										</td> 
                                            <td valign="top">
    											<input class="form-control"  type="text" name="WeeklyRent<?php echo $RowNum; ?>" id="WeeklyRent<?php echo $RowNum; ?>"  value="<?php echo $WeeklyRent; ?>" size="6" maxlength="6" autocomplete='off'>
    										</td> 
    										<td valign="top">
    											<input class="form-control"  type="text" name="CountryCode<?php echo $RowNum; ?>" id="CountryCode<?php echo $RowNum; ?>"  value="<?php echo $CountryCode; ?>" size="3" maxlength="2" autocomplete='off'>
    										</td> 
    										<td valign="top">
    											<input class="form-control"  type="text" name="PropertyImage<?php echo $RowNum; ?>" id="PropertyImage<?php echo $RowNum; ?>"  value="<?php echo $PropertyImage; ?>" size="6" maxlength="200" autocomplete='off'>
    										</td> 
    										<td  width="4%" align=center>
    											<a href="javascript:void(0)" name="Rem"  row_no="<?php echo $RowNum;?>" class="DeleteRow">
    												<img width='30px' src="<?php echo SITE_BASE_URL; ?>assets/img/delete_icon.png" border=0>
    											</a>
    											<input class="form-control" type="hidden" id="PropertyDtlStatus<?php echo $RowNum;?>" name="PropertyDtlStatus<?php echo $RowNum;?>" size='2'  value=""   />
    										</td> 
    									</tr> 
    									<?php
    									$RowNum=$RowNum+1;
    									}
    								}
    							   
    
    							} ?>													
                            </tbody>
    						<tfoot id="PROPERTYTemplate" style="display:none">
    							<tr class=tablebg1 id="PROPERTYRowXXXXX">
    								<td style='display:no ne'><input class="form-control" class='tablebg2' type="text" name="SeqXXXXX" id="SeqXXXXX" value="XXXXX" style="border:none;" size='2' readonly /> </td>
    								<td valign="top">
    									<input class="form-control"  type="text" name="PropertyNameXXXXX" id="PropertyNameXXXXX"  value="" size="15" maxlength="11" autocomplete='off'>
    								</td> 
    								<td valign="top">
    									<textarea class="form-control" name="PropertyAddressXXXXX" id="PropertyAddressXXXXX" rows="3" cols="10" autocomplete='off'></textarea>
    								</td> 
    								<td valign="top">
    									<textarea class="form-control" name="DescriptionXXXXX" id="DescriptionXXXXX" rows="3" cols="10" autocomplete='off'></textarea>
    								</td> 
    								<td valign="top">
    									<select name="PropertyTypeXXXXX" id="PropertyTypeXXXXX" required="" aria-required="true" class="form-control" >
    									    <option value="">Select</option>
									        <option value="1">House</option>
									        <option value="2">Townhouse</option>
									        <option value="3">Unit/Apartment</option>
									        <option value="4">Block of Units</option>
									        <option value="5">Land</option>
									        <option value="6">Rural</option>
									        <option value="7">Commercial</option>
									        <option value="8">Other</option>
									    </select>
    								</td> 
    								<td valign="top">
    									<input class="form-control"  type="text" name="LandAreaXXXXX" id="LandAreaXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
    								</td> 
    								<td valign="top">
    									<input class="form-control"  type="text" name="NoOfBedroomsXXXXX" id="NoOfBedroomsXXXXX"  value="" size="3" maxlength="11" autocomplete='off'>
    								</td> 
    								<td valign="top">
    									<input class="form-control"  type="text" name="NoOfParkingspaceXXXXX" id="NoOfParkingspaceXXXXX"  value="" size="3" maxlength="11" autocomplete='off'>
    								</td> 
    								<td valign="top">
    									<input class="form-control"  type="text" name="NoOfBathroomXXXXX" id="NoOfBathroomXXXXX"  value="" size="3" maxlength="11" autocomplete='off'>
    								</td>
    								<td valign="top">
    									<input class="form-control"  type="text" name="RateSilverXXXXX" id="RateSilverXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
    								</td> 
    								<td valign="top">
    									<input class="form-control"  type="text" name="RateGoldXXXXX" id="RateGoldXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
    								</td> 
    								<td valign="top">
    									<input class="form-control"  type="text" name="RatePlatinumXXXXX" id="RatePlatinumXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
    								</td> 
                                    <td valign="top">
										<input class="form-control"  type="text" name="WeeklyRentXXXXX" id="WeeklyRentXXXXX"  value="" size="6" maxlength="6" autocomplete='off'>
									</td> 
									<td valign="top">
										<input class="form-control"  type="text" name="CountryCodeXXXXX" id="CountryCodeXXXXX"  value="" size="3" maxlength="2" autocomplete='off'>
									</td> 
									<td valign="top">
										<input class="form-control"  type="text" name="PropertyImageXXXXX" id="PropertyImageXXXXX"  value="" size="6" maxlength="200" autocomplete='off'>
									</td> 
									
    								<td  width="4%" align=center>
    									<a href="javascript:void(0)" name="Rem"  row_no="XXXXX" class="DeleteRow">
    										<img width='30px' src="<?php echo SITE_BASE_URL; ?>assets/img/delete_icon.png" border=0>
    									</a>
    									<input class="form-control" type="hidden" id="PropertyDtlStatusXXXXX" name="PropertyDtlStatusXXXXX"  size='2' value=""   />
    								</td> 
    							</tr> 
    							
    						</tfoot> 
                        </table>
    					
    				<?php
    				}?>	
                    </div>
    				
                </div>

            </div>

				<table width='100%' align='center'>
					<?php
    					if ( isset($_POST["submit"]) ) { ?>
    				<tr>
						<td colspan="10" align="center">
							<button class="btn btn-blue btn-small btn_class bg-info" name="button" id="button" type="button" value="Save">
								<span class="icon-mail"></span> Save
							</button>
						</td>
					</tr>
					<?php }?>
					<tr class='tableheader'><td align='right' colspan=7><input class="form-control" type="hidden" id="PROPERTYExistRowCount" name="PROPERTYExistRowCount" value='<?php echo $RowNum-1; ?>'><input class="form-control" type="hidden" name="TotalRowCount" id="TotalRowCount" value="<?php echo $TotalRowCount; ?>"></td></tr>
				</table>
		</form>
        </div><!-- card body end -->
    </div><!-- card div end-->

</section>
</div><!-- end content-->
<?php include"footer.php"; ?>
<script>
    function AddRowPROPERTY(arg)
	{
		ObjPorts		=	$("#"+ arg +"ExistRowCount")
		NumPorts		=	ObjPorts.val()
		NumPorts++			
		Reg				=	/XXXXX/gi;
		ObjTemplate		=	$("#"+ arg +"Template").html().replace(Reg,NumPorts) 
		$("#"+arg+"Body").append(ObjTemplate); 
		
		ObjPorts.val(NumPorts)  
		return false
	}
	$(document).on("click", ".DeleteRow ", function(){
		CurRowNo = $(this).attr("row_no");
		if (CurRowNo == undefined)
			return false; 
		$("#PROPERTYRow" + CurRowNo).hide(); 
		$("#PROPERTY1Row" + CurRowNo).hide(); 
		$('#PropertyDtlStatus' + CurRowNo).val('N')
		//PROPERTYRow1
	});


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

    function CreateNew(){
        alert();
    }
    
    function EditFn(id){
    window.location.href = "<?php echo SITE_BASE_URL; ?>client/edit.html?d=<?php echo time(); ?>&id=" + id; 
    }

    function DeleteFn(id){
    //alert('id=' + id)
    if (confirm("Sure! Are you want to Delete?") == false){
    return false;
    }

    window.location.href = "<?php echo SITE_BASE_URL; ?>client/delete.html?d=<?php echo time(); ?>&id=" + id; 
    }

    $(function () { 
    $(document).on("click", ".btn_class", function(){
    noOfClient	= $("[name='noOfClient']").val(); 

    if (isNaN(parseInt(noOfClient)))
    noOfClient = 0;

    if (parseInt(noOfClient) == 0){
    //alert("Please type total client");
    //return false; 
    }
	document.getElementsByName('form1').enctype = '';



    document.form1.action = "<?php echo SITE_BASE_URL; ?>Property/" + this.value + ".html";
    document.form1.submit();
    });


    });

</script>

</body>
</html>