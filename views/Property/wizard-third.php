<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//db.onlinewebfonts.com/c/05b6b46e1d924515522a0f53ef5e6d86?family=FGJordanW01-Regular" rel="stylesheet" type="text/css"/>
</head>
<style>
@font-face {font-family: "FGJordanW01-Regular"; src: url("//db.onlinewebfonts.com/t/05b6b46e1d924515522a0f53ef5e6d86.eot"); src: url("//db.onlinewebfonts.com/t/05b6b46e1d924515522a0f53ef5e6d86.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/05b6b46e1d924515522a0f53ef5e6d86.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/05b6b46e1d924515522a0f53ef5e6d86.woff") format("woff"), url("//db.onlinewebfonts.com/t/05b6b46e1d924515522a0f53ef5e6d86.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/05b6b46e1d924515522a0f53ef5e6d86.svg#FGJordanW01-Regular") format("svg"); }</style>
<?php
if(isset($_GET['id']) && isset($_GET['ProjectId']) && $_GET['id'] != null && $_GET['id'] != "" && $_GET['ProjectId'] != null && $_GET['ProjectId'] != "")
{
    $property_id = $_GET['id'];
    $propject_id = $_GET['ProjectId'];
    ?>
    <?php
    include"header.php";
    \login\loginClass::Init();
    $checkSession        = \login\loginClass::CheckUserSessionIp();
    ?>
    <div class="duval-header">
		<div class="container-fluid p-0">
			<div class="brand">
				<img src="<?= SITE_BASE_URL;?>dashboard/assets/images/full-logo.png" alt="">
			</div>
		</div>
	</div>
	<?php $projet_details = \Property\PropertyClass::GetProjectLatlong($_GET['ProjectId']);
foreach($projet_details as $key => $value){}?>
	<div class="notice-text">
		<div class="container-fluid p-0">
			<p class="solid-p">ADVISORY NOTICE</p>
			<p class="solid-p">YOU UNDERSTAND AND ACKNOWLEDGE:</p>
			<ol>
				<li>That Du Val PropTech are responsible for marketing the foreign property known as ‘<?php echo $value['PROJECT_NAME'] ?>’ located at ‘<?php echo $value['Address'] ?>’.</li>
				<li>That Du Val PropTech and Private Office represent the Developer (Vendor) in this transaction.</li>
				<li>That you are aware of the payments required to purchase the property and that mortgage funding or loans to purchase the property may be subject to applicable rules and restrictions (for example, TDSR in Singapore).</li>
				<li>That you are aware that if you are buying a property overseas in a foreign currency, that you may benefit from currency gains, or indeed losses as exchange rates fluctuate.</li>
				<li>That you are aware that there are risks involved with the purchase of foreign properties and the transaction is subject to the laws of the country where the property is located. The transaction is also subject to any future changes in these foreign laws. As such, you are advised to conduct your own due diligence before committing to the purchase of the Property, (you may choose to conduct due diligence on the vendor or on any claims made in relation to the Property). You are also advised to seek your own independent legal advice if in doubt about any aspect relating to the purchase of the Property, including the terms and conditions of the transaction documents (e.g. Sale and Purchase Agreement or contract).</li>
				<li>That in the event of any dispute relating the purchase or the Sale and Purchase Agreement (or equivalent), the jurisdiction where the dispute will be resolved will be the country where the subject property is located.</li>
				<li>That our sales representatives work exclusively in relation to properties outside of Hong Kong and are not licensed under the Estate Agents Ordinance to deal with Hong Kong Properties. Purchasing uncompleted properties situated outside of Hong Kong (or outside of your country of residence) is complicated and contains risk and you should review all relevant information and documents carefully before making a purchase decision and if in doubt, you should seek independent professional advice before making a purchase decision.</li>
				<li>That the reservation fee paid is non-refundable during the 30-day sales campaign. At the end of the 30 day sales campaign (which you can track online) if the Dynamic Price of the property has dropped to the Strike Price or less, the reservation fee is non-refundable and will form part of your 10% deposit. Should the Dynamic Price have remained above the Strike Price, there is no sale and your reservation fee will be refunded in full.</li>
			</ol>
			<p class="solid-p">You also confirm:</p>
			<ol>
			    <li>You are aware of the various Stamp Duty taxes applicable to foreign purchasers as they stand at the time of reservation.</li>	
			    <li>That if applicable you have downloaded a copy of the Consumer Code for Home Builders</li>	
			    <li>You have downloaded and reviewed the information held online such as including the site plan, general development information, floorplan and specification.</li>	
			</ol>
			<p>Du Val PropTech can confirm that they have not identified any adverse or potentially adverse finding in the course of the due diligence carried out on the Developer or the development.</p>
			<p>Yours Sincerely</p>
			<p>Ashley Osborne</p>
			<p style="font-family:FGJordanW01-Regular;font-size:30px;">Ashley Osborne</p>
			<p>Co-founder and CEO of Du Val PropTech</p>
			
			<p class="solid-p">Adverse/Potentially Adverse Findings</p>
			<p>‘None Found’</p>
			<div class="date-field">
				<label class="dv-date">Date</label>
				<div class="sign-holder">
					<div class="sign-box"></div>
					<span>Signed by KEO or Senior Director of Du Val Private Office</span>
				</div>
			</div>
		</div>
	</div>

	<div class="abp-fields">
		<div class="container-fluid p-0">
			<h5>ACKNOWLEDGEMENT BY PURCHASER(S)</h5>
			<p>I/We hereby acknowledge and understand the content of the advisory notice in relation to the purchase of the property</p>
			<form action="<?= SITE_BASE_URL?>Property/ReserveWizardfourth.html" method="post" >
			    <input type="hidden" value="<?= $property_id; ?>" name="id">
			    <input type="hidden" value="<?= $propject_id; ?>" name="project_id">
			    <div class="row">
    				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
    					<div class="form-group">
    						<label for="">Purchaser 1</label>
    						<input type="text" name="txt_purchase_one" required class="form-control">
    					</div>
    				</div>
    				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
    					<div class="form-group">
    						<label for="">Signed by</label>
    							<input type="text" style='font-family: "FGJordanW01-Regular"; font-size:30px;' required name="txt_sign_one" class="form-control">
    					</div>
    				</div>
    				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
    					<div class="form-group">
    						<label for="">Purchaser 2</label>
    						<input type="text" name="txt_purchase_two" class="form-control">
    					</div>
    				</div>
    				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
    					<div class="form-group">
    						<label for="">Signed by</label>
    							<input type="text" style='font-family: "FGJordanW01-Regular"; font-size:30px;' name="txt_sign_two" class="form-control">
    					</div>
    				</div>
    				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
    					<div class="form-group">
    						<label for="">NRIC/ FIN/ Passport Number</label>
    						<input type="text" name="cnic_pur_one" required class="form-control">
    					</div>
    				</div>
    				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
    					<div class="form-group">
    						<label for="">Date</label>
							<input type="text" placeholder="<?php echo date('d-m-Y'); ?>" onfocus="this.type='date'" name="date_pur_one" required class="form-control">

    					</div>
    				</div>
    				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
    					<div class="form-group">
    						<label for="">NRIC/ FIN/ Passport Number</label>
    						<input type="text" name="cnic_pur_two"  class="form-control">
    					</div>
    				</div>
    				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
    					<div class="form-group">
    						<label for="">Date</label>
							<input type="text" placeholder="<?php echo date('d-m-Y'); ?>" onfocus="this.type='date'" name="date_pur_two" class="form-control">
    					</div>
    				</div>
    			</div>
			    <hr>
			    <div class="row">
    				<div class="col-12">
    					<h6>Witnessed by</h6>
    				</div>
    				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
    					<div class="form-group">
    						<label for="">Salesperson (representing the Vendor)</label>
    						<input type="text" name="sales_person_vendor" required class="form-control">
    					</div>
    				</div>
    				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
    					<div class="form-group">
    						<label for="">CEA Registration Number where applicable</label>
    						<input type="text" name="cea_registration" required class="form-control">
    					</div>
    				</div>
    			</div>
			    <div class="row">
    				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
    					<div class="form-group">
    						<label for="">Name of Estate Agent</label>
    						<input type="text" required name="estate_agent" class="form-control">
    					</div>
    				</div>
    				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
    					<div class="form-group">
    						<label for="">CEA Licence Number where applicable</label>
    						<input type="text" required name="cea_license" class="form-control">
    					</div>
    				</div>
    				<div class="col-xl-3 col-lg-4 col-md-6 col-12">
    					<div class="form-group">
    						<label for="">Date</label>
    						<input type="text" placeholder="<?php echo date('d-m-Y'); ?>" onfocus="this.type='date'" required name="txt_witness_date" class="form-control">
    					</div>
    				</div>
    			</div>
			    <div class="col-12">
    				<button type="submit" class="btn btn-blue d-block ml-auto">Agree and Continue</button>
    			</div>
			    <hr class="solid-hr">
			</form>
		</div>
	</div>
	<?php include"footer.php"; ?>
    <?php
}
else
{
    echo "<script>window.history.go(-1)</script>";
}
?>