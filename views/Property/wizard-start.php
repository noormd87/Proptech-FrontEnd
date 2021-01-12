
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
    <div class="messages-container">
    	<div class="message-box">
    		<div class="row align-items-end">
    			<div class="col-lg-6">
    				<h2>Congratulations</h2>
    				<h3><span>on selecting your investment property.</span></h3>
    				<p>The reservation process is very straightforward, just follow the steps as we take you through the process. If you’re unclear at any stage simply contact your portfolio advisor</p>
    				<a type="button" href="<?= SITE_BASE_URL;?>/Property/ReserveWizardthird.html?id=<?= $property_id; ?>&ProjectId=<?= $propject_id;?>" class="btn btn-blue">Next</a>
    			</div>
    			<div class="col-lg-6">
    				<div class="img-holder">
    					<img src="<?= SITE_BASE_URL;?>dashboard/assets/images/congrats-vector.png" class="img-fluid" alt="">
    				</div>
    			</div>
    		</div>
    		<div class="wave">
    			<img src="<?= SITE_BASE_URL;?>dashboard/assets/images/wavy.png" class="img-fluid" alt="">
    		</div>
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

