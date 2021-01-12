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

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">

    <div class="card">
        
        <div class="card-body">
            <h4 class="card-title">Property Master</h4>
            <form name="form1" method="post"  enctype="multipart/form-data" action="<?php echo $url ;?>">

             <?php

				if ( !isset($_POST["submit"]) && $buttonaction !="edit" && $buttonaction !="delete" ) { ?>



				<div class=form-group>

				    <input class="form-control Project "  type="text" name="ProjectName" id="ProjectName"  value="" size="10" maxlength="20" autocomplete='off' placeholder='Select Project'>

                    <input class="form-control"  type="hidden" name="ProjectId" id="ProjectId"  value="" size="3" maxlength="4" autocomplete='off'>

				</div>

                        <div class="form-group">
                            <label for="">File CSV Upload</label>
                               <div class="input-group">
                                    <div class="fileinput fileinput-new m-0" data-provides="fileinput">
                                        <span class="btn btn-primary btn-file"><span class="fileinput-new">CHOOSE FILE</span>
                                        <span class="fileinput-exists">Change</span><input type="file" name="file" id="file" size="150"></span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                                     </div>
                                     <div class="input-group-append">
                                        <button type="submit" class="btn btn-info btn_add" name="submit" value="submit">Upload</button>
                                     </div>
                                </div> 
                               <!-- <div class="fileinput fileinput-new" data-provides="fileinput">

                                  <span class="btn btn-primary btn-file"><span class="fileinput-new">CHOOSE FILE</span>

                                  <span class="fileinput-exists">Change</span><input type="file" name="file" id="file" size="150"></span>

                                  <span class="fileinput-filename"></span>

                                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>

                               </div> -->
                               <!-- <input class="form-control" type="file" name="file" id="file" size="150"> -->

                            

                            <a href="<?php echo SITE_BASE_URL;?>PropertyTemplete.csv">UPLOAD TEMPLETE</a>

                        </div>

    						
    					



    					<button type="submit" class="btn btn-info btn_add" name="submit" value="submit">Add New Property</button>

                        <hr>

                                                
                      <h4 class="mt-4">List of Reserved Property</h4>  
                      <div class="table-responsive">

                           <table class="table">

                              <thead>

                                <tr>

                                    <th>ID</th> 

                                    <th>BUILDING</th> 

                                    <th>APARTMENT NO</th> 

                                    <th>UNIT NO</th> 

                                    <th>LEVEL</th> 

                                    <th>ASPECT</th>  

                                    <th>PROJECT NAME</th> 

                                    <th>FLOOR TYPE</th> 

                                    <th>LAND AREA</th> 

                                    <th>APPROX<br>PATIO<br>BALCONY</th> 

                                    <th>NO OF BED<br>ROOMS</th> 

                                    <th>NO OF BATH<br>ROOM</th> 

                                    <th>NO OF PARKING<br>SPACE</th> 

                                    <th>ACTUAL PRICE</th>

                                    <th>START PRICE</th>

                                    <th>DPO NEGOTIATED<br>DEAL PRICE</th>

                                    <th>WEEKLY<br>RENT</th>

                                    <th>RESERVED BY</th> 

                                    <th>CANCEL <br>RESERVATION</th>

                                    <th>DELETE</th>

                                </tr>

                              </thead>

                              <tbody>

                                <?php

                                \Dashboard\DashboardClass::Init();

                                $rows = \Property\PropertyClass::GetPropertiesDatas('','');

                                $i = 1;

                                foreach ($rows as $row) 

                                {

                                ?>

                                <tr>

                                  <td>

                                      <a class="btn btn-success btn-sm" href="javascript:void(0)" onclick="EditFn('<?php echo $row["property_id"];?>')">

                                        <i class="fa fa-edit"><?php echo $row["property_id"];?></i>

                                      </a>

                                  </td>

                                  <td><?php echo $row["building"];?></td>

                                  <td><?php echo $row["apartment_no"];?></td>

                                  <td><?php echo $row["unit_no"];?></td>

                                  <td><?php echo $row["level"];?></td>

                                  <td><?php echo $row["aspect"];?></td>

                                  <td><?php echo $row["project_name"];?></td>

                                  <td><?php echo $row["floor_type"];?></td>

                                  <td><?php echo $row["land_area"];?></td>

                                  <td><?php echo $row["approx_patio_balcony"];?></td>

                                  <td><?php echo $row["no_of_bedrooms"];?></td>

                                  <td><?php echo $row["no_of_bathroom"];?></td>

                                  <td><?php echo $row["no_of_parkingspace"];?></td>

                                  <td><?php echo $row["rate"];?></td>

                                  <td><?php echo $row["start_rate"];?></td>

                                  <td><?php echo $row["dpo_rate"];?></td>

                                  <td><?php echo $row["weekly_rent"];?></td>

                                  <td><?php echo $row["reserved_by"];?></td>

                                  <td>

                                      <?php if($row["reserved_by"]!="" && $row["reserved_by"]!=null){?>

                                        <a class="btn btn-danger btn-sm" href="<?php echo SITE_BASE_URL; ?>Property/Cancel.html?id=<?php echo $row["property_id"]; ?>&ProjectId=<?php echo $row["project_id"]; ?>" nowrap>Cancel Reservasion</a>

                                      <?php }?>

                                  </td>

                                  <td>  

                                     <a class="btn btn-warning btn-sm" href="javascript:void(0)" onclick="DeleteFn('<?php echo $row["property_id"];?>')">

                                        <i class="fa fa-trash"></i>

                                     </a>

                                  </td>

                                </tr>

                                <?php

                                }?>

                              </tbody>

                            </table>

                     </div>

                </div>

    				<?php }?>

                        

                    <div class="widget-content">

    					

    				<?php 

    				$RowNum = 1; 

    				if ( isset($_POST["submit"]) || $buttonaction =="edit" || $buttonaction =="delete") 

    				{

    				    $ProjectId=$_REQUEST["ProjectId"];

    				    $ProjectName=$_REQUEST["ProjectName"];

    				?>

                        <table class="table table-bordered table-striped ">

                            <thead>

                                <tr>

                                    <th>S.NO</th> 

                                    <th>BUILDING</th> 

    								<th>APARTMENT NO</th> 

    								<th>UNIT NO</th> 

    								<th>LEVEL</th> 

    								<th>ASPECT</th>  

    								<th>FLOOR TYPE</th> 

    								<th>LAND AREA</th> 

    								<th>APPROX<br>PATIO<br>BALCONY</th> 

    								<th>NO OF BED<br>ROOMS</th> 

    								<th>NO OF BATH<br>ROOM</th> 

    								<th>NO OF PARKING<br>SPACE</th> 

    								<th>ACTUAL PRICE</th>

    								<th>START PRICE</th>

    								<th>DPO NEGOTIATED<br>DEAL PRICE</th>

    								<th>WEEKLY<br>RENT</th>

    								<?php

										if ($buttonaction != "edit" && $buttonaction !="delete")

										{

										?>		

    								<th>

    								    <button class="btn btn-upgrade-rounded bg-orange" onClick="javaScript:AddRowPROPERTY('PROPERTY');return false;">

                                          Add

                                        </button>

                                    </th>

    									<?php 

    									} 

    									?>

                                    </tr>

                            </thead>

							<?php

							

							if ($buttonaction =="edit" || $buttonaction =="delete")

							{

							

							?>							

							

							<tbody id="PROPERTYBody">

							

                                <?php

									$RowNum = 1;

									$propertyid 	= isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";

									

									$rows = \Property\PropertyClass::GetPropertiesDatas($propertyid,'');

									$i = 1;

									foreach ($rows as $row) 

									{

										$propertyid 		= $row["property_id"];

										$building    		= $row["building"];

										$ApartmentNo    	= $row["apartment_no"];

										$UnitNo     		= $row["unit_no"];

										$level       		= $row["level"];

										$aspect      		= $row["aspect"];

										$FloorType    		= $row["floor_type"];

										$LandArea 			= $row["land_area"];

										$ApproxPatioBalcony	= $row["approx_patio_balcony"];

										$NoOfBedrooms 		= $row["no_of_bedrooms"];

										$NoOfBathroom 		= $row["no_of_bathroom"];

										$NoOfParkingspace 	= $row["no_of_parkingspace"];

										$CreatedUser 		= $row["created_user"];

										$Rate        		= $row["rate"];

										$StartRate        	= $row["start_rate"];

										$DpoRate        	= $row["dpo_rate"];

										$WeeklyRent 		= $row["weekly_rent"];

										$ProjectId 		    = $row["project_id"];

										$projectName 		= $row["project_name"];

											

    									?>

    									<tr class=tablebg2 id="PROPERTYRow<?php echo $RowNum; ?>">

    									    

    										<td style='display:no ne'><input class="form-control" class='tablebg2' type="text" name="Seq<?php echo $RowNum; ?>" id="Seq<?php echo $RowNum; ?>" value="<?php echo $RowNum; ?>" style="border:no ne;" size='2' readonly /> </td>

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="building<?php echo $RowNum; ?>" id="building<?php echo $RowNum; ?>"  value="<?php echo $building; ?>" size="15" maxlength="30" autocomplete='off'>

    										</td> 

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="ApartmentNo<?php echo $RowNum; ?>" id="ApartmentNo<?php echo $RowNum; ?>"  value="<?php echo $ApartmentNo; ?>" size="15" maxlength="30" autocomplete='off'>

    										</td> 

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="UnitNo<?php echo $RowNum; ?>" id="UnitNo<?php echo $RowNum; ?>"  value="<?php echo $UnitNo; ?>" size="15" maxlength="30" autocomplete='off'>

    										</td> 

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="level<?php echo $RowNum; ?>" id="level<?php echo $RowNum; ?>"  value="<?php echo $level; ?>" size="15" maxlength="30" autocomplete='off'>

    										</td> 

    										<td valign="top">

    											<textarea class="form-control mandate" name="aspect<?php echo $RowNum; ?>" id="aspect<?php echo $RowNum; ?>" rows="2" cols="10" autocomplete='off'><?php echo $aspect; ?></textarea>

    										</td> 

    										<td valign="top" style="display:none">

    										    <input class="form-control mandate"  type="hidden" name="ProjectId<?php echo $RowNum; ?>" id="ProjectId<?php echo $RowNum; ?>"  value="<?php echo $ProjectId;?>" size="3" maxlength="4" autocomplete='off'>

    										</td>

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="FloorType<?php echo $RowNum; ?>" id="FloorType<?php echo $RowNum; ?>"  value="<?php echo $FloorType; ?>" size="15" maxlength="30" autocomplete='off'>

    										</td> 

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="LandArea<?php echo $RowNum; ?>" id="LandArea<?php echo $RowNum; ?>"  value="<?php echo $LandArea; ?>" size="6" maxlength="11" autocomplete='off'>

    										</td>

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="ApproxPatioBalcony<?php echo $RowNum; ?>" id="ApproxPatioBalcony<?php echo $RowNum; ?>"  value="<?php echo $ApproxPatioBalcony; ?>" size="6" maxlength="11" autocomplete='off'>

    										</td> 

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="NoOfBedrooms<?php echo $RowNum; ?>" id="NoOfBedrooms<?php echo $RowNum; ?>"  value="<?php echo $NoOfBedrooms; ?>" size="3" maxlength="11" autocomplete='off'>

    										</td> 

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="NoOfBathroom<?php echo $RowNum; ?>" id="NoOfBathroom<?php echo $RowNum; ?>"  value="<?php echo $NoOfBathroom; ?>" size="3" maxlength="11" autocomplete='off'>

    										</td> 

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="NoOfParkingspace<?php echo $RowNum; ?>" id="NoOfParkingspace<?php echo $RowNum; ?>"  value="<?php echo $NoOfParkingspace; ?>" size="3" maxlength="11" autocomplete='off'>

    										</td> 

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="Rate<?php echo $RowNum; ?>" id="Rate<?php echo $RowNum; ?>"  value="<?php echo $Rate; ?>" size="6" maxlength="11" autocomplete='off'>

    										</td> 

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="StartRate<?php echo $RowNum; ?>" id="Rate<?php echo $RowNum; ?>"  value="<?php echo $StartRate; ?>" size="6" maxlength="11" autocomplete='off'>

    										</td> 

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="DpoRate<?php echo $RowNum; ?>" id="Rate<?php echo $RowNum; ?>"  value="<?php echo $DpoRate; ?>" size="6" maxlength="11" autocomplete='off'>

    										</td> 

    										<td valign="top">

    											<input class="form-control mandate"  type="text" name="WeeklyRent<?php echo $RowNum; ?>" id="WeeklyRent<?php echo $RowNum; ?>"  value="<?php echo $WeeklyRent; ?>" size="6" maxlength="6" autocomplete='off'>

    										</td>   

    										<td  width="4%" align=center>    											

    											<input class="form-control" type="hidden" id="PropertyDtlStatus<?php echo $RowNum;?>" name="PropertyDtlStatus<?php echo $RowNum;?>" size='2'  value="Y"   />

    											<input class="form-control" type="hidden" id="propertyid<?php echo $RowNum;?>" name="propertyid<?php echo $RowNum;?>" size='2'  value="<?php echo $propertyid; ?>"   />

												<input class="form-control" type="hidden" id="PROPERTYExistRowCount" name="PROPERTYExistRowCount" value='<?php echo $RowNum; ?>' />

    										</td> 

    									</tr> 

    									<?php

    									$RowNum=$RowNum+1;

    									

    								}

    							   

    

    							 ?>													

                            </tbody>

								

								

							<?php

							

							} elseif( isset($_POST["submit"]) )

							

							{ 

							?>							

						

							



							

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

											$RowNum=0;

											while($data = fgetcsv($handle))

											  {

											    if ($RowNum == 0)

											    {

											        

											    }

                                                else

                                                {

												$building=$data[0];

												$ApartmentNo=$data[1];

												$UnitNo=$data[2];

												$level=$data[3];

												$aspect=$data[4];

												$FloorType=$data[5];

												$LandArea=$data[6];

												$ApproxPatioBalcony=$data[7];

												$NoOfBedrooms=$data[8];

												$NoOfBathroom=$data[9];

												$NoOfParkingspace=$data[10];

												$Rate=$data[11];

												$StartRate=$data[12];

												$DpoRate=$data[13];

												$WeeklyRent=$data[14];

												//if (\Property\PropertyClass::$Id == ""){

                            					//	\Property\PropertyClass::$Id = $_REQUEST["d"].$RowNum;

                            					//}

											?>

											<tr class=tablebg2 id="PROPERTYRow<?php echo $RowNum; ?>">

												<td style='display:no ne'><input class="form-control" class='tablebg2' type="text" name="Seq<?php echo $RowNum; ?>" id="Seq<?php echo $RowNum; ?>" value="<?php echo $RowNum; ?>" style="border:no ne;" size='2' readonly /> </td>

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="building<?php echo $RowNum; ?>" id="building<?php echo $RowNum; ?>"  value="<?php echo $building; ?>" size="15" maxlength="30" autocomplete='off'>

        										</td> 

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="ApartmentNo<?php echo $RowNum; ?>" id="ApartmentNo<?php echo $RowNum; ?>"  value="<?php echo $ApartmentNo; ?>" size="15" maxlength="30" autocomplete='off'>

        										</td> 

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="UnitNo<?php echo $RowNum; ?>" id="UnitNo<?php echo $RowNum; ?>"  value="<?php echo $UnitNo; ?>" size="15" maxlength="30" autocomplete='off'>

        										</td> 

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="level<?php echo $RowNum; ?>" id="level<?php echo $RowNum; ?>"  value="<?php echo $level; ?>" size="15" maxlength="30" autocomplete='off'>

        										</td> 

        										<td valign="top">

        											<textarea class="form-control mandate" name="aspect<?php echo $RowNum; ?>" id="aspect<?php echo $RowNum; ?>" rows="2" cols="10" autocomplete='off'><?php echo $aspect; ?></textarea>

        										</td> 

        										<td valign="top" style="display:none">

        										    <input class="form-control"  type="hidden" name="ProjectId<?php echo $RowNum; ?>" id="ProjectId<?php echo $RowNum; ?>"  value="<?php echo $ProjectId;?>" size="3" maxlength="4" autocomplete='off'>

        										</td>

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="FloorType<?php echo $RowNum; ?>" id="FloorType<?php echo $RowNum; ?>"  value="<?php echo $FloorType; ?>" size="15" maxlength="30" autocomplete='off'>

        										</td> 

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="LandArea<?php echo $RowNum; ?>" id="LandArea<?php echo $RowNum; ?>"  value="<?php echo $LandArea; ?>" size="6" maxlength="11" autocomplete='off'>

        										</td> 

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="ApproxPatioBalcony<?php echo $RowNum; ?>" id="ApproxPatioBalcony<?php echo $RowNum; ?>"  value="<?php echo $ApproxPatioBalcony; ?>" size="6" maxlength="11" autocomplete='off'>

        										</td> 

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="NoOfBedrooms<?php echo $RowNum; ?>" id="NoOfBedrooms<?php echo $RowNum; ?>"  value="<?php echo $NoOfBedrooms; ?>" size="3" maxlength="11" autocomplete='off'>

        										</td> 

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="NoOfBathroom<?php echo $RowNum; ?>" id="NoOfBathroom<?php echo $RowNum; ?>"  value="<?php echo $NoOfBathroom; ?>" size="3" maxlength="11" autocomplete='off'>

        										</td> 

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="NoOfParkingspace<?php echo $RowNum; ?>" id="NoOfParkingspace<?php echo $RowNum; ?>"  value="<?php echo $NoOfParkingspace; ?>" size="3" maxlength="11" autocomplete='off'>

        										</td> 

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="Rate<?php echo $RowNum; ?>" id="Rate<?php echo $RowNum; ?>"  value="<?php echo $Rate; ?>" size="6" maxlength="11" autocomplete='off'>

        										</td> 

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="StartRate<?php echo $RowNum; ?>" id="Rate<?php echo $RowNum; ?>"  value="<?php echo $StartRate; ?>" size="6" maxlength="11" autocomplete='off'>

        										</td> 

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="DpoRate<?php echo $RowNum; ?>" id="Rate<?php echo $RowNum; ?>"  value="<?php echo $DpoRate; ?>" size="6" maxlength="11" autocomplete='off'>

        										</td> 

        										<td valign="top">

        											<input class="form-control mandate"  type="text" name="WeeklyRent<?php echo $RowNum; ?>" id="WeeklyRent<?php echo $RowNum; ?>"  value="<?php echo $WeeklyRent; ?>" size="6" maxlength="6" autocomplete='off'>

        										</td>   

        										<td  width="4%" align=center>

													<a href="javascript:void(0)" name="Rem"  row_no="<?php echo $RowNum;?>" class="DeleteRow">

														<img width='30px' src="<?php echo SITE_BASE_URL; ?>assets/img/delete_icon.png" border=0>

													</a>

													<input class="form-control" type="hidden" id="PropertyDtlStatus<?php echo $RowNum;?>" name="PropertyDtlStatus<?php echo $RowNum;?>" size='2'  value=""   />

												</td> 

											</tr> 

											<?php

                                                }

											$RowNum=$RowNum+1;

											}

										}

									   

		

									} ?>													

								</tbody>

							    <tfoot id="PROPERTYTemplate" style="display:none">

        							<tr class=tablebg1 id="PROPERTYRowXXXXX">

        								<td style='display:no ne'><input class="form-control" class='tablebg2' type="text" name="SeqXXXXX" id="SeqXXXXX" value="XXXXX" style="border:no ne;" size='2' readonly /> </td>

										<td valign="top">

											<input class="form-control mandate"  type="text" name="buildingXXXXX" id="buildingXXXXX"  value="" size="15" maxlength="30" autocomplete='off'>

										</td> 

										<td valign="top">

											<input class="form-control mandate"  type="text" name="ApartmentNoXXXXX" id="ApartmentNoXXXXX"  value="" size="15" maxlength="30" autocomplete='off'>

										</td> 

										<td valign="top">

											<input class="form-control mandate"  type="text" name="UnitNoXXXXX" id="UnitNoXXXXX"  value="" size="15" maxlength="30" autocomplete='off'>

										</td> 

										<td valign="top">

											<input class="form-control mandate"  type="text" name="levelXXXXX" id="levelXXXXX"  value="" size="15" maxlength="30" autocomplete='off'>

										</td> 

										<td valign="top">

											<textarea class="form-control mandate" name="aspectXXXXX" id="aspectXXXXX" rows="2" cols="10" autocomplete='off'></textarea>

										</td> 

										<td valign="top" style="display:none">

										    <input class="form-control"  type="hidden" name="ProjectIdXXXXX" id="ProjectIdXXXXX"  value="<?php echo $ProjectId;?>" size="3" maxlength="4" autocomplete='off'>

										</td>

										<td valign="top">

											<input class="form-control mandate"  type="text" name="FloorTypeXXXXX" id="FloorTypeXXXXX"  value="" size="15" maxlength="30" autocomplete='off'>

										</td> 

										<td valign="top">

											<input class="form-control mandate"  type="text" name="LandAreaXXXXX" id="LandAreaXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>

										</td> 

										<td valign="top">

											<input class="form-control mandate"  type="text" name="ApproxPatioBalconyXXXXX" id="ApproxPatioBalconyXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>

										</td> 

										<td valign="top">

											<input class="form-control mandate"  type="text" name="NoOfBedroomsXXXXX" id="NoOfBedroomsXXXXX"  value="" size="3" maxlength="11" autocomplete='off'>

										</td> 

										<td valign="top">

											<input class="form-control mandate"  type="text" name="NoOfBathroomXXXXX" id="NoOfBathroomXXXXX"  value="" size="3" maxlength="11" autocomplete='off'>

										</td> 

										<td valign="top">

											<input class="form-control mandate"  type="text" name="NoOfParkingspaceXXXXX" id="NoOfParkingspaceXXXXX"  value="" size="3" maxlength="11" autocomplete='off'>

										</td> 

										<td valign="top">

											<input class="form-control mandate"  type="text" name="RateXXXXX" id="RateXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>

										</td> 

										<td valign="top">

											<input class="form-control mandate"  type="text" name="StartRateXXXXX" id="RateXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>

										</td> 

										<td valign="top">

											<input class="form-control mandate"  type="text" name="DpoRateXXXXX" id="RateXXXXX"  value="" size="6" maxlength="11" autocomplete='off'>

										</td> 

										<td valign="top">

											<input class="form-control mandate"  type="text" name="WeeklyRentXXXXX" id="WeeklyRentXXXXX"  value="" size="6" maxlength="6" autocomplete='off'>

										</td>   

    									

        								<td  width="4%" align=center>

        									<a href="javascript:void(0)" name="Rem"  row_no="XXXXX" class="DeleteRow">

        										<img width='30px' src="<?php echo SITE_BASE_URL; ?>assets/img/delete_icon.png" border=0>

        									</a>

        									<input class="form-control" type="hidden" id="PropertyDtlStatusXXXXX" name="PropertyDtlStatusXXXXX"  size='2' value=""   />

        								</td> 

        							</tr> 

    					    	</tfoot> 

							<?php

							}

							

    							 ?>		

                        </table>

    					

				<?php

				}

				?>	

                    </div>

    				

                </div>



            



			<div class="table-responsive">
       <table class="table table-striped">

                    <?php

                        if ( isset($_POST["submit"]) || $buttonaction =="edit"||$buttonaction =="delete") { 

                        

                            if ( $buttonaction =="edit")

                            {

                                $NameVal = "Update";

                                $Delval="";

                            }

                            elseif ( $buttonaction =="delete")

                            {

                                $NameVal = "Delete";

                                $Delval="D";

                            }

                            else

                            {

                                $NameVal = "Save";

                                $Delval="";

                            }

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

                            <input class="form-control" type="hidden" id="Delval" name="Delval" value='<?php echo $Delval; ?>'>

                        </td>

                    </tr>

                </table>         
            </div>

		</form>


        </div><!-- card body end -->

    </div><!-- card div end-->



<?php include"footer.php"; ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
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

		window.location.href = "<?php echo SITE_BASE_URL; ?>Property/index.html?d=<?php echo time(); ?>&id=" + id +"&buttonaction=edit"; 

	

		//document.form1.action = "<?php echo SITE_BASE_URL; ?>Property/" + this.value + ".html?d=<?php echo time(); ?>&id=" + id +"&action=edit";

		//document.form1.submit();

    }



    function DeleteFn(id){

    //alert('id=' + id)

    if (confirm("Sure! Are you want to Delete?") == false){

    return false;

    }



    window.location.href = "<?php echo SITE_BASE_URL; ?>Property/index.html?d=<?php echo time(); ?>&id=" + id +"&buttonaction=delete"; 

    }



    $(function () { 

    $(document).on("click", ".btn_class", function(){

    

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

    

	document.getElementsByName('form1').enctype = '';

    document.form1.action = "<?php echo SITE_BASE_URL; ?>Property/" + this.value + ".html";

    document.form1.submit();

    });





    });

	

	

	$(function () { 

    $(document).on("click", ".btn_add", function(){

    ProjectId	= $("[name='ProjectId']").val(); 

    if(ProjectId=="" || ProjectId==null)

    {

        alert("Select Project from the list");

        return false;

    }

    document.getElementsByName('form1').enctype = '';

    document.form1.submit();

    });





    });

    

	function AddFilesFn(id){

	

	

    	$.colorbox({iframe:true, href:"<?php echo SITE_BASE_URL;?>Property/AddFiles.html?id=" + id, innerWidth:700, innerHeight:350, onClosed:function(){

    	//window.location.reload();

    	//================================

    	

    	    URL = "<?php echo SITE_BASE_URL;?>Property/Refresh.html?id=" + id ;

            $.ajax({url: URL, success: function(result){

                //alert(result)

                //alert("Error while delete : \n" + result);

                document.getElementById("image11" + id).innerHTML="";

                document.getElementById("Image" + id).innerHTML=result;

                alert("Updated Successfully");

            }});

    	 //===============================   

    	    } 

    	

    	});

    

    

    }

    function DeleteFileFn(id,filename){

        if (!confirm("Sure! Are you want to Delete File?")){

            return false;

        }

        

        URL = "<?php echo SITE_BASE_URL;?>Property/DeleteFile.html?FolderId=" + id + "&filename=" + filename;

        console.log(URL)

        $.ajax({url: URL, success: function(result){

            //alert(result)

            if (result.trim() == "success"){

                //alert("Deleted");

                //window.location.reload();

                //================================

            	    URL = "<?php echo SITE_BASE_URL;?>Property/Refresh.html?id=" + id ;

                    $.ajax({url: URL, success: function(result){

                        //alert(result)

                        //alert("Error while delete : \n" + result);

                        document.getElementById("image11" + id).innerHTML="";

                        document.getElementById("Image" + id).innerHTML=result;

                        alert("Deleted Successfully");

                    }});

            	 //===============================   

            }

            else{

                alert("Error while delete : \n" + result);

            }

        }});

    }

</script>





<script>

//=======================================================ajax========================================================================

  $( function() {

    

	$(document).on("keyup", ".Project", function(){

		passquery	=	$(this).val();

		passtype	=	"Project";

		auto_complete1($(this));

	});

	

  } );



  function auto_complete1(e,otherwhr){ 

		if(otherwhr==null)

		{

			otherwhr	=	"{'1':1}"

		}

	    datavalues  = eval(  {type:  passtype  , query: passquery ,   otherwhr   } );

		



		e.autocomplete({

		   minLength: 2,

			   delay: 500,

			   autofocus: true,



			source: function (request, response) {

				$.ajax({

					type: "POST",

					url:"<?php echo SITE_BASE_URL;?>ajax/"+passtype+".html",

					data: datavalues,

					success: response,

					dataType: 'json' 

				});

			}, 

			

			select: function( event, ui ) {

			  $( this ).val( ui.item.DESCRIPTION );

			  //PropertyId

			  $(this).next("input").val( ui.item.PAGE_LINK);

			  //window.location.href = ui.item.PAGE_LINK

			  return false;

			},

			search: function(event, ui) { 

			  // $('.spinner').show();

			},

			open: function(){

				//$('.spinner').hide();

				$('.ui-autocomplete').css({'background-color': 'white', 'width': '300px'});

			}

		}) 

		

		.data( "ui-autocomplete" )._renderItem = function( ul, item ) {

		   return $( "<li >" )

		   .append( "<a>" + item.DESCRIPTION + "</a>" )

		   .appendTo( ul );

		};

		

		

		console.log("last")

	}



  </script>

</body>

</html>