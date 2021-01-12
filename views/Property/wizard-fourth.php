<?php
include "header.php";
?>
<div class="duval-header">
	<div class="container-fluid p-0">
		<div class="d-flex justify-content-between align-items-center">
			<h1 class="text-light text-uppercase m-0">Reservation Agreement</h1>
			<div class="brand">
				<img src="<?= SITE_BASE_URL;?>dashboard/assets/images/full-logo.png" alt="">
			</div>
		</div>
	</div>
</div>
<?php
$project_id = $_POST["project_id"];
$prperty_id = $_POST["id"];
if ($project_id == '' || $project_id == null) {
echo "<script>window.history.go(-1);</script>";
    }
\Property\PropertyClass::Init();
$Projectrows = \Property\PropertyClass::GetPorjectDatas('', $project_id);
$i = 1;
foreach ($Projectrows as $Projectrow)
{
    $project_id = isset($Projectrow["PROJECT_ID"]) ? $Projectrow["PROJECT_ID"] : "";
    $countryName = $Projectrow["country_name"];
    $expiry_date = $Projectrow["expiry_date"];
    $Projcurr    = $Projectrow["currency"];
    $createDate = new DateTime($expiry_date);
    $strip = $createDate->format('Y-m-d');
	$Xrate=1;
    if ($Projcurr == "NZD") {
        $Prefix = "NZ$";
    } elseif ($Projcurr == "AUD") {
        $Prefix = "AU$";
    } elseif ($Projcurr == "GBP") {
        $Prefix = "Â£";
    } else {
        $Prefix = $Projcurr . " ";
    }
	
    $cond.=" AND pd.PROPERTY_ID=$prperty_id";
    $row = \Property\PropertyClass::GetPropertiesDatas('','',$cond);
    $j = 1;
    // echo "<pre>";
    foreach ($row as $rows) 
    {
        ?>
        <form action="<?= SITE_BASE_URL;?>Property/ReserveWizardfifth.html" method="post">
            <input type="hidden" value="<?= $project_id; ?>" name="ProjectId">
            <input type="hidden" value="<?= $prperty_id; ?>" name="id">
            <input type="hidden" value="<?= $rows['Reservation_Fee'];?>" name="reservation_fees">
            
            <div class="reservation-details">
        	<div class="container-fluid p-0">
        		<h5>Reservation Details</h5>
        		<div class="row">
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Plot No</label>
        					<p><?= $rows['UNIT_NO'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Development Name</label>
        					<p><?= $Projectrow['DevelopmentName'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Development Address</label>
        					<p><?= $Projectrow['Address'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Retail Market Price</label>
        					<p><?= $Projcurr." ".number_format(round($rows["rate"])*$Xrate,0);?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Strike Price (Maximum Price Payable for plot)</label>
        					<p><?= $Projcurr." ".number_format(round($rows["strike_price"])*$Xrate,0);?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Discount from Retail Market Price @strike price</label>

        					<p><?= 100 - round(( ($rows["strike_price"] / $rows["rate"]) * 100 ));?>%</p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Car Parking Space(s)</label>
        					<p><?= $rows['no_of_parkingspace'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-6 col-lg-8 col-12">
        				<div class="static-field">
        					<label>The FINAL PURCHASE PRICE may be LESS than the Strike Price which will be confirmed to you via email on</label>
							<p>
                                <?php 
                                if(!empty($Projectrow['Reservationclosingdate']))
                                {
                                    $dateExp = explode('/', $Projectrow['Reservationclosingdate']);
                                    $data = $dateExp[2].'-'.$dateExp[1].'-'.$dateExp[0];
                                    echo date('d/m/Y',strtotime($data.'+1 day'));
                                }
                                else
                                {
                                    echo date('m-d-Y', strtotime("+1 day"));
                                }
                                ?>
                            </p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Reservation Fee</label>
        					<p><?=  $Projcurr.$rows['Reservation_Fee'];?></p>
        				</div>
        			</div>
        			<div class="col-12">
        				<div class="static-field">
        					<label>First Deposit due 14 days after Exchange of Contract</label>
        					<div class="row">
        						<div class="col-xl-6 col-12">
        							<div class="d-flex align-items-center">
									<?php // echo '<pre>';print_r($Projectrow); die; ?>
        								<p><?= $Projcurr ?>(<?= $Projectrow['ExchangeDeposit'];?> % of <?= $rows['RATE'];?>)</p>
        						
        								<p><?= $Projcurr ?> <?= ($Projectrow['ExchangeDeposit']/100)*$rows['RATE']?></p>
        							</div>
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="col-12">
        				<em>Note: The Reservation Fee will be refunded when the 10% deposit has been paid in full.</em>
        			</div>
        			<div class="col-xl-6 col-12">
        				<div class="static-field">
        					<label>Stage Payment 1 Due</label>
        					<div class="d-flex align-items-center">
        						<!-- <p><?= $rows['timing1'];?></p>
        						<label>Heldby</label>
        						<p>Autofill</p> -->
								<p><?= $Projectrow['StagePayment1Date']?></p>
								<label>£</label>
        						<p><?= $rows['timing1'];?> (<?= $Projectrow['Stage_Payment1'];?> % of Purchase price)</p>
        					</div>
        				</div>
        			</div>
        			<div class="col-xl-6 col-12">
        				<div class="static-field">
        					<label>Stage Payment 2 Due</label>
        					<div class="d-flex align-items-center">
        						<!-- <p><?= $rows['timing2'];?></p>
        						<label>Heldby</label>
        						<p>Autofill</p> -->
								<p><?= $Projectrow['StagePayment2Date']?></p>
								<label>£</label>
        						<p><?= $rows['timing2'];?> (<?= $Projectrow['Stage_Payment2'];?> % of Purchase price)</p>
        					</div>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Legal Fee Contribution</label>
        					<p><?= $rows['legal_fee_contribution'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Area</label>
        					<div class="d-flex align-items-center">
        						<p><?php if($rows['area_unit'] == "m"){echo $rows['LAND_AREA'];} else{ echo round(($rows['LAND_AREA']) / 3.2,2);}  ?></p>
        						<label>m<sup>2</sup></label>
        						<p><?php if($rows['area_unit'] == "m"){echo round(($rows['LAND_AREA'])*3.2,2);} else{ echo $rows['LAND_AREA'];}  ?></p>
        						<label>ft<sup>2</sup></label>
        					</div>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Bedrooms</label>
        					<p><?= $rows['NO_OF_BEDROOMS'];?></p>
        				</div>
        			</div>
        		
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Estimated Service Charge per ft² p.a.</label>
        					<p><?= $rows['Est_Service_Charge'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Estimated Ground Rent p.a.</label>
        					<p><?= $rows['Est_Ground_Rent'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Estimated Completion</label>
        					<p><?= $Projectrow['completion_date'];?></p>
        				</div>
        			</div>
        			
        		</div>
        	</div>
        </div>
            <div class="purchaser-details">
        	<div class="container-fluid p-0">
        		<h5>Purchaser Details</h5>
        		<div class="row">
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>*Title</label>
        					<input type="text" name="" class="grey-field" placeholder="Purchaser Input">
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>*First Name: (As appears in ID)</label>
        					<input type="text" name="" class="grey-field" placeholder="Purchaser Input">
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>*Last Name: (As appears in ID)</label>
        					<input type="text" name="" class="grey-field" placeholder="Purchaser Input">
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>*Email address:</label>
        					<input type="text" name="" class="grey-field" placeholder="Purchaser Input">
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>*Contact Telephone No: Mobile</label>
        					<input type="text" name="" class="grey-field" placeholder="Purchaser Input">
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Contact Telephone No: Landline (+XX)</label>
        					<input type="text" name="" class="grey-field" placeholder="Purchaser Input">
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Mortgage / Cash / Unknown</label>
        					<input type="text" name="" class="grey-field" placeholder="Purchaser Input">
        				</div>
        			</div>
        			<div class="col-12">
        				<div class="row">
        					<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        						<div class="static-field">
        							<label>*Home Address</label>
        							<input name="" type="text" class="grey-field" placeholder="Purchaser Input">
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="col-12">
        				<div class="row">
        					<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        						<div class="static-field">
        							<label>*Investor / Owner Occupier/Accommodation for family member</label>
        							<input name="" type="text" class="grey-field" placeholder="Purchaser Input">
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="col-12">
        				<em>*these fields MUST be completed</em>
        			</div>	
        		</div>
        		<h5>PURCHASER SOLICITOR DETAILS</h5>
        		<div class="row">
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Company Name</label>
        					<p><?= $Projectrow['PurchasersSolicitorCompanyName'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Solicitor Acting</label>
        					<p><?= $Projectrow['PurchasersActingSolicitorName'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Email</label>
        					<p><?= $Projectrow['PurchasersActingSolicitorEmail'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Contact Telephone No</label>
        					<p><?= $Projectrow['PurchasersActingSolicitorContactNumber'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Contact Telephone No (Mobile)</label>
        					<p><?= $Projectrow['PurchasersActingSolicitorContactNumber'];?></p>
        				</div>
        			</div>
        		</div>
        		<h5>DEVELOPER DETAILS</h5>
        		<div class="row">
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Company Name</label>
        					<p><?= $Projectrow['DevelopersSolicitorCompanyName'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Purchaser Details</label>
        					<p><?= $Projectrow['DevelopersSolicitorCompanyName'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Email</label>
        					<p><?= $Projectrow['DevelopersSolicitorCompanyName'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Contact Telephone No</label>
        					<p><?= $Projectrow['DevelopersSolicitorCompanyName'];?></p>
        				</div>
        			</div>
        		</div>
        		<h5>DEVELOPER SOLICITOR DETAILS</h5>
        		<div class="row">
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Company Name</label>
        					<p><?= $Projectrow['DevelopersSolicitorCompanyName'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Solicitor Acting</label>
        					<p><?= $Projectrow['DevelopersSolicitorPersonActing'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Email</label>
        					<p><?= $Projectrow['DevelopersSolcitorEmailaddress'];?></p>
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Contact Telephone No</label>
        					<p><?= $Projectrow['DevelopersSolicitorContactNumber'];?></p>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
            <div class="reservation-terms">
        	<div class="container-fluid p-0">
        		<h5>Terms</h5>
        		<div class="text-box">
        			<h6>FINAL PURCHASE PRICE</h6> 
        			<p>
        				The final price of the plot will be the Strike Price, as detailed in this Agreement, or a price less than the Strike Price, depending on the number of sales achieved. The reservation WILL NOT PROCEED TO EXCHANGE OF CONTRACTS if the required number of sales are not reached (and therefore the Strike Price is not reached) by the closing date for reservations on <?= $Projectrow['Reservationclosingdate'] ?>. 
        			</p>
        			<p>
        				You will be notified on <?php $dateExp = explode('/', $Projectrow['Reservationclosingdate']); $data = $dateExp[2].'-'.$dateExp[1].'-'.$dateExp[0]; echo date('d/m/Y',strtotime($data.'+1 day'));?>
						 date of either the Final PURCHASE PRICE of the unit or advised if the sale will not proceed due to the Strike Price not being met.<br>If the unit reaches the strike price BEFORE the closing date, you will be notified by email. You can also track the price of your unit online at any point by logging in to your account.<br>At the point the plot reaches the Strike Price, you will be advised and your solicitor will be advised. At this point, the you will proceed towards Exchange of Contracts.<br>You are required to Exchange Contracts 7 days after the closing date for reservations on <?= $Projectrow['ExchangeDepositduedate'] ?> (7 days after closing). The developer reserves the right to terminate the reservation if Exchange of Contracts does not take place by this date. The Agreement will remain Subject to Contract until Exchange of Contracts.<br>The 10% deposit is due within 14 days of Exchange of Contract.
        			</p>
        			<p>
        				<span>RESERVATION FEE</span><br>The reservation fee paid will form part of the deposit due on exchange of
contracts.
        			</p>
        		</div>
        		<h5>PERMISSION AND APPROVAL</h5>
        		<div class="text-box">
        		
        			<p>
        			
        				Until the time of completion, you acknowledge that the developer and Du Val will contact you to guide you through the process. Details of your reservation and your contact details will be passed to your Solicitor.<br>
        				You acknowledge you have read and understand all the information contained in this Reservation Agreement and agree to enter into the Reservation Agreement.<br>
        			If the Strike Price is met and you fail to proceed to exchange of contracts, the
reservation fee paid is non-refundable.
        			</p>
        		</div>
        		<div class="row">
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>SIGNATURE of Buyer</label>
        					<input name="" type="text" class="grey-field" placeholder="Purchaser Input">
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Date</label>
        					<input name="" type="text" value="<?= $_POST['txt_witness_date'];?>" class="grey-field" placeholder="Purchaser Input">
        				</div>
        			</div>
        		<!--	<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>SIGNATURE on behalf of the Developer</label>
        					<input name="" type="text" class="grey-field" placeholder="Input by Du Val Team leader">
        				</div>
        			</div>-->
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>SIGNATURE on behalf of the Developer</label>
        					<input name="" type="text" class="grey-field" placeholder="Input by Du Val Team leader">
        				</div>
        			</div>
        			<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Name of Buyer</label>
        					<input name="" type="text" value="<?= $_POST['txt_purchase_one'];?>" class="grey-field" placeholder="Purchaser Input">
        				</div>
        			</div>
        			<!--	<div class="col-xl-3 col-lg-4 col-md-6 col-12">
        				<div class="static-field">
        					<label>Name and Company of Signatory</label>
        					<input name="" type="text" class="grey-field" placeholder="Input by Du Val Team leader">
        				</div>
        			</div>-->
        		</div>
        		<div class="action-text d-flex align-items-center justify-content-between">
        			<p>On receipt of the Reservation Agreement this will be checked and signed on behalf of the developer. A copy will be sent to your email address and saved in ‘My Account’ area of Du Val PropTech.</p>
                    <?php
                    if($_SERVER['REQUEST_METHOD'] == "POST")
                    {
                        $tmpname = $_FILES["txt_sign_one"]["tmp_name"];
                        $filename = $_FILES["txt_sign_one"]["name"];
                        $actfilename = str_replace(",", "_", $filename);
                        $UplFilePath = "uploads/propertyimage/" . $actfilename;
                        move_uploaded_file($tmpname, $UplFilePath);
                        
                        ?>
                        <input type="hidden" name="txt_sign_one" value="<?= $actfilename; ?>">
                        <?php
                        
                        $tmpname = $_FILES["txt_sign_one"]["tmp_name"];
                        $filename = $_FILES["txt_sign_one"]["name"];
                        $actfilename = str_replace(",", "_", $filename);
                        $UplFilePath = "uploads/propertyimage/" . $actfilename;
                        move_uploaded_file($tmpname, $UplFilePath);
                        
                        ?>
                        <input type="hidden" name="txt_sign_two" value="<?= $actfilename; ?>">
                        <?php
                        
                        foreach($_POST as $key => $val)
                        {
                           ?>
                           <input type="hidden" name="<?= $key; ?>" value="<?= $val; ?>">
                           <?php
                        }
                    }
                    ?>
                    
        			<button class="btn btn-blue">Next</button>
        		</div>
        	</div>
        </div>
        </form>
        <?php
    }
}
?>
<?php include "footer.php"; ?>
