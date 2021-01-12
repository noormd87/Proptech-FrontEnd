<?php include"header.php"; ?>
<style>
    .Vector-map-js .vmap svg{
        min-height:90vh !important;
    }
</style>
<div class="inner-wrapper">
    <div class="global-search pt-0" style="background-image:url('<?php echo SITE_BASE_URL;?>dashboard/assets/images/gloabal-bg.png');">
        <div class="g-search-holder pt-0">
            <div class="text">
                <h1>Global Residential<br>Data Search</h1>
                <p>Enter the country you want to search and press GO!</p>
            </div>
            <form method="get" action="<?= SITE_BASE_URL;?>Property/PropertyInvestar.html">
                <div class="search-time-holder">
                    <div class="search-bar">
                        <div class="input-group py-0" style="max-width:100%;">
                            <select name="country" id="country" class="form-control py-0">
                                <option value="3">United Kingdom</option>
                                <option value="2">Australia</option>
                                <option value="1">New Zealand</option>
                            </select>
                        </div>
                        <button class="btn btn-orange" type="submit">Go</button>
                    </div>
                </div>
            </form>
        </div>
        <ul class="list-inline list-country float-none">
            <li>
                <a class="nav-link" href="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=3">
                    <img src="assets/images/united-kingdom.png" alt=""/>
                    United Kingdom
                </a>
            </li>
            <li>
                <a class="nav-link" href="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=2">
                    <img src="assets/images/australia.png" alt=""/>
                    Australia
                </a>
            </li>
            <li>
                <a class="nav-link" href="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=1">
                    <img src="assets/images/newzeland.png" alt=""/>
                    New Zealand
                </a>
            </li>
        </ul>
    </div>
    
   
</div>
<?php include"footer.php"; ?>