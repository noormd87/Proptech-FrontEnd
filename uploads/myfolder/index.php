<?php
\Html\HtmlClass::Init();

echo \Html\HtmlClass::GetHeaderTemplate();
echo \Html\HtmlClass::GetSearchBar();
echo \Html\HtmlClass::GetSidebar();

?>
<div id="content">
    <?php
    echo \Html\HtmlClass::PrintFormHeaderName("Property Master");
    ?>
    <div class="container">
        <div class="grid-24">

            <div style="float:right; margin-bottom:10px; ">
                <form name="form1" method="post"  enctype="multipart/form-data" action="<?php echo SITE_BASE_URL; ?>Property/index.html?d=<?php echo time(); ?>">
                    <input type="hidden" name="is_submitted" id="is_submitted" value="Y" />
                    <?php
					if ( !isset($_POST["submit"]) ) { ?>

					<div  >
						<label for="exampleInputFile">File CSV Upload</label>
						<input type="file" name="file" id="file" size="150">
						<button type="submit" class="btn btn-default" name="submit" value="submit">Upload</button>

					</div>
				<?php }?>
                
            </div>	

            <div class="widget widget-table">
                <div class="widget-header">
                    <span class="icon-list"></span>
                    <h3 class="icon chart">Property Master - Datas</h3>		
                </div>

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
								<th>NO OF BEDROOMS</th> 
								<th>NO OF PARKINGSPACE</th> 
								<th>NO OF BATHROOM</th> 
								<th>RATE(SILVER)</th> 
								<th>RATE(GOLD)</th> 
								<th>RATE(PLATINAM)</th> 
								<th><input type="button" name="button" class="button2" value="Add PROPERTY" onClick="javaScript:AddRowPROPERTY('PROPERTY');"></th>
                            </tr>
                        </thead>
                        <tbody id="PROPERTYBody">
                            <?php
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
									?>
									<tr class=tablebg2 id="PROPERTYRow<?php echo $RowNum; ?>">
										<td style='display:no ne'><input class='tablebg2' type="text" name="Seq<?php echo $RowNum; ?>" id="Seq<?php echo $RowNum; ?>" value="<?php echo $RowNum; ?>" style="border:no ne;" size='2' readonly /> </td>
										<td valign="top">
											<input  type="text" name="PropertyName<?php echo $RowNum; ?>" id="PropertyName<?php echo $RowNum; ?>"  value="<?php echo $PropertyName; ?>" size="15" maxlength="11" autocomplete='off'>
										</td> 
										<td valign="top">
											<textarea name="PropertyAddress<?php echo $RowNum; ?>" id="PropertyAddress<?php echo $RowNum; ?>" rows="3" cols="4" autocomplete='off'><?php echo $PropertyAddress; ?></textarea>
										</td> 
										<td valign="top">
											<textarea name="Description<?php echo $RowNum; ?>" id="Description<?php echo $RowNum; ?>" rows="3" cols="4" autocomplete='off'><?php echo $Description; ?></textarea>
										</td> 
										<td valign="top">
											<input  type="text" name="PropertyType<?php echo $RowNum; ?>" id="PropertyType<?php echo $RowNum; ?>"  value="<?php echo $PropertyType; ?>" size="5" maxlength="11" autocomplete='off'>
										</td> 
										<td valign="top">
											<input  type="text" name="LandArea<?php echo $RowNum; ?>" id="LandArea<?php echo $RowNum; ?>"  value="<?php echo $LandArea; ?>" size="6" maxlength="11" autocomplete='off'>
										</td> 
										<td valign="top">
											<input  type="text" name="NoOfBedrooms<?php echo $RowNum; ?>" id="NoOfBedrooms<?php echo $RowNum; ?>"  value="<?php echo $NoOfBedrooms; ?>" size="3" maxlength="11" autocomplete='off'>
										</td> 
										<td valign="top">
											<input  type="text" name="NoOfParkingspace<?php echo $RowNum; ?>" id="NoOfParkingspace<?php echo $RowNum; ?>"  value="<?php echo $NoOfParkingspace; ?>" size="3" maxlength="11" autocomplete='off'>
										</td> 
										<td valign="top">
											<input  type="text" name="NoOfBathroom<?php echo $RowNum; ?>" id="NoOfBathroom<?php echo $RowNum; ?>"  value="<?php echo $NoOfBathroom; ?>" size="3" maxlength="11" autocomplete='off'>
										</td> 
										<td valign="top">
											<input  type="text" name="RateSilver<?php echo $RowNum; ?>" id="RateSilver<?php echo $RowNum; ?>"  value="<?php echo $RateSilver; ?>" size="6" maxlength="11" autocomplete='off'>
										</td> 
										<td valign="top">
											<input  type="text" name="RateGold<?php echo $RowNum; ?>" id="RateGold<?php echo $RowNum; ?>"  value="<?php echo $RateGold; ?>" size="6" maxlength="11" autocomplete='off'>
										</td> 
										<td valign="top">
											<input  type="text" name="RatePlatinum<?php echo $RowNum; ?>" id="RatePlatinum<?php echo $RowNum; ?>"  value="<?php echo $RatePlatinum; ?>" size="6" maxlength="6" autocomplete='off'>
										</td> 

										<td  width="4%" align=center>
											<a href="javascript:void(0)" name="Rem"  row_no="<?php echo $RowNum;?>" class="DeleteRow">
												<img width='30px' src="<?php echo SITE_BASE_URL; ?>images/delete_icon.png" border=0>
											</a>
											<input type="hidden" id="PropertyDtlStatus<?php echo $RowNum;?>" name="PropertyDtlStatus<?php echo $RowNum;?>" size='2'  value=""   />
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
								<td style='display:no ne'><input class='tablebg2' type="text" name="SeqXXXXX" id="SeqXXXXX" value="XXXXX" style="border:none;" size='2' readonly /> </td>
								<td valign="top">
									<input  type="text" name="PropertyNameXXXXX" id="PropertyNameXXXXX"  value="" size="15" maxlength="11" autocomplete='off'>
								</td> 
								<td valign="top">
									<textarea name="PropertyAddressXXXXX" id="PropertyAddressXXXXX" rows="3" cols="4" autocomplete='off'></textarea>
								</td> 
								<td valign="top">
									<textarea name="DescriptionXXXXX" id="DescriptionXXXXX" rows="3" cols="4" autocomplete='off'></textarea>
								</td> 
								<td valign="top">
									<input  type="text" name="PropertyTypeXXXXX" id="PropertyTypeXXXXX"  value="" size="5" maxlength="11" autocomplete='off'>
								</td> 
								<td valign="top">
									<input  type="text" name="LandAreaXXXXX" id="LandAreaXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
								</td> 
								<td valign="top">
									<input  type="text" name="NoOfBedroomsXXXXX" id="NoOfBedroomsXXXXX"  value="" size="3" maxlength="11" autocomplete='off'>
								</td> 
								<td valign="top">
									<input  type="text" name="NoOfParkingspaceXXXXX" id="NoOfParkingspaceXXXXX"  value="" size="3" maxlength="11" autocomplete='off'>
								</td> 
								<td valign="top">
									<input  type="text" name="NoOfBathroomXXXXX" id="NoOfBathroomXXXXX"  value="" size="3" maxlength="11" autocomplete='off'>
								</td>
								<td valign="top">
									<input  type="text" name="RateSilverXXXXX" id="RateSilverXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
								</td> 
								<td valign="top">
									<input  type="text" name="RateGoldXXXXX" id="RateGoldXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
								</td> 
								<td valign="top">
									<input  type="text" name="RatePlatinumXXXXX" id="RatePlatinumXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>
								</td> 

								<td  width="4%" align=center>
									<a href="javascript:void(0)" name="Rem"  row_no="XXXXX" class="DeleteRow">
										<img width='30px' src="<?php echo SITE_BASE_URL; ?>images/delete_icon.png" border=0>
									</a>
									<input type="hidden" id="PropertyDtlStatusXXXXX" name="PropertyDtlStatusXXXXX"  size='2' value=""   />
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
					<tr>
						<td colspan="10" align="center">
							<button class="btn btn-blue btn-small btn_class" name="button" id="button" type="button" value="Save">
								<span class="icon-mail"></span> Save
							</button>
						</td>
					</tr>
					<tr class='tableheader'><td align='right' colspan=7><input type="hidden" id="PROPERTYExistRowCount" name="PROPERTYExistRowCount" value='<?php echo $RowNum-1; ?>'><input type="hidden" name="TotalRowCount" id="TotalRowCount" value="<?php echo $TotalRowCount; ?>"></td></tr>
				</table>
		</form>

    </div> <!-- .container -->

</div>
<?php
\Html\HtmlClass::TopNavBar();

\Html\HtmlClass::Footer();
?>

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
    $( ".date_picker" ).datepicker({
    dateFormat: 'dd/mm/yy',
    //defaultDate: '+1w',
    changeMonth: false,
    numberOfMonths: 1,
    showOn: 'both'
    });


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

