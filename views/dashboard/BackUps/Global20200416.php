<?php include "header.php"; ?>
 <!-- Vectormap -->
<link href="assets/plugins/vectormap/css/jqvmap.min.css" rel="stylesheet">
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-12 order-2">
        <div class="card h-100 mb-0">
            <div class="card-body">
                <h4 class="card-title">World</h4>
                <div class="Vector-map-js">
                    <div id="worldMap" class="vmap"></div>
                </div>
            </div>
            <!-- /# card -->
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 col-12 order-1">
      <form action="<?php echo SITE_BASE_URL;?>Dashboard/Location.html" method="post" name='form1'>
        <div class="card h-100 mb-0">
          <div class="card-body">
            <div class="">
                 <h4 class="card-title">Either click to select a region or search for a particular area</h4>
                 <input class="form-control" type="hidden" id="CountryCode" name="CountryCode" size='2'  value=""   />
                 <input class="form-control" type="hidden" id="CountryName" name="CountryName" size='2'  value=""   />
               </div> 
               <div class="country-list">
                <div class="basic-list-group">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                          <a class="nav-link" href="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=NZ"><img src="<?php echo SITE_BASE_URL;?>assets/img/flags/nz.png"> &nbsp; New Zealand</a>
                        </li>
                        <li class="list-group-item"><a class="nav-link" href="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=UK"><img src="<?php echo SITE_BASE_URL;?>assets/img/flags/uk.png"> &nbsp;United Kingdom</a></li>
                        <li class="list-group-item"><a class="nav-link" href="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=AU"><img src="<?php echo SITE_BASE_URL;?>assets/img/flags/australia.png"> &nbsp; Australia</a></li>
                       <!--
                        <li class="list-group-item"><a class="nav-link" href="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=US"><img src="<?php echo SITE_BASE_URL;?>assets/img/flags/usa.png"> &nbsp; United States Of America</a></li>
                        
                        <li class="list-group-item"><a class="nav-link" href="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=MY"><img src="<?php echo SITE_BASE_URL;?>assets/img/flags/malaysia.png"> &nbsp; Malaysia</a></li>
                        <li class="list-group-item"><a class="nav-link" href="<?php echo SITE_BASE_URL;?>Property/PropertyInvestar.html?country=SG"><img src="<?php echo SITE_BASE_URL;?>assets/img/flags/singapore.png"> &nbsp;Singapore</a></li>
                        -->
                    </ul>
                </div>
               </div>
          </div>
        </div>
      </form>
    </div>
</div>
<!-- /# row -->


<?php include"footer.php"; ?>

  <!-- vector map-->
    <script src="<?php echo SITE_BASE_URL;?>assets/plugins/vectormap/js/jquery.vmap.min.js"></script>
    <script src="<?php echo SITE_BASE_URL;?>assets/plugins/vectormap/js/country/jquery.vmap.world.js"></script>

    <script type="text/javascript">
    //MAp 
    //world map
    jQuery('#worldMap').vectorMap({
      map: 'world_en',
      backgroundColor: '#fff',
      borderColor: '#fafafa',
      borderOpacity: 0.25,
      borderWidth: 1,
      color: '#94A3AC',
        colors: {
            'gb': '#B22234',
            'nz': '#000',
            'au': '#FCD116'
        },
      enableZoom: false,
      hoverColor: '#231be3',
      hoverOpacity: null,
      normalizeFunction: 'linear',
      scaleColors: ['#b6d6ff', '#005ace'],
      selectedColor: '#231be3',
      selectedRegions: null,
      showTooltip: true,
      onRegionClick: function (element, code, region) {
        var message = 'You clicked "' +
          region +
          '" which has the code: ' +
          code.toUpperCase();
        window.location.href = "<?php echo SITE_BASE_URL; ?>Property/PropertyInvestar.html?country=" + code.toUpperCase();
        //alert(message);
      }
    });

    </script>