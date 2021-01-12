
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
		<div class="terms-container">
		<div class="terms-wrap">
			<h2>TERMS AND CONDITIONS (Payment Terms)</h2>
			<div class="terms-holder">
				<div class="text">
					<h5>You understand and acknowledge; </h5>
					<p>That in accordance with the Council of Estate Agents in Singapore, we (Du Val PropTech / Du Val Private Office) advise you that we represent the Developer (Vendor) in this transaction. That you are aware of the payments required to purchase the property and that mortgage funding or loans to purchase the property may be subject to applicable rules and restrictions (for example, TDSR in Singapore). That you are aware that if you are buying a property overseas in a foreign currency, that you may benefit from currency gains, or indeed losses as exchange rates fluctuate. That in the event of any dispute relating the purchase or the Sale and Purchase Agreement (or equivalent), the jurisdiction where the dispute will be resolved will be the country where the subject property is located. </p>
					<p>That our sales representatives work exclusively in relation to properties outside of Hong Kong and are not licensed under the Estate Agents Ordinance to deal with Hong Kong Properties. Purchasing uncompleted properties situated outside of Hong Kong is complicated and contains risk and you should review all relevant information and documents carefully before making a purchase decision and if in doubt, you should seek independent professional advice before making a purchase decision. </p>
					<h5>You also confirm</h5>
					<p>You have used the Du Val Property Analyser Tool and have read the buyer guide and property IM and confirm that you are aware of the various taxes applicable to foreign purchasers as they stand at the time of reservation. That if applicable you have downloaded a copy of the Consumer Code for Home Builders (note this only applies to properties in England which are covered by Checkmate, NHBC, Premier Guarantee, LABC Warranty) You have downloaded and reviewed the information held online including the site plan, general development information, floorplan and specification</p>
				</div>
			</div>
		    <form class="w-100" action="<?= SITE_BASE_URL;?>Property/ReserveWizardthird.html" method="GET">
			<div class="terms-act">
			        <input type="hidden" value="<?= $property_id; ?>" name="id" >
			        <input type="hidden" value="<?= $propject_id; ?>" name="ProjectId" >
    				<div class="terms-check">
    					<input type="checkbox" name="chk" value="1" id="t-check" required> 
    					<label for="t-check">I AGREE TO THE TERMS AND CONDITIONS</label>
    				</div>
    				<button class="btn btn-blue">AGREE AND CONTINUE</button>
    			</div>
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

