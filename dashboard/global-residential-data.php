<?php include"header.php"; ?>

<div class="row no-gutters">
  <div class="col-md-6 p-r-3">
    <div class="card">
        <div class="card-header">
          <h4>Search global data</h4>
        </div>
        <div class="card-body">
          <ul class="country-flag-list justify-content-start">
            <li>
              <div class="img-card">
                <img src="assets/img/uk.png" class="img-fluid" alt="" width="100px">
                <p class="img-caption">United Kingdom</p>
              </div>
            </li>
            <li>
              <div class="img-card">
                <img src="assets/img/australia.png" class="img-fluid" alt="" width="100px">
                <p class="img-caption">Australia</p>
              </div>
            </li>
            <li>
              <div class="img-card">
                <img src="assets/img/newzealand.png" class="img-fluid" alt="" width="100px">
                <p class="img-caption">New Zealand</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header text-lg-right text-left">
        <h4>Coming Soon</h4>
      </div>
      <div class="card-body">
        <ul class="country-flag-list justify-content-end">
          <li>
            <div class="img-card">
              <img src="assets/img/us.png" class="img-fluid" alt="" width="100px">
              <p class="img-caption">Malaysia</p>
            </div>
          </li>
          <li>
            <div class="img-card">
              <img src="assets/img/us.png" class="img-fluid" alt="" width="100px">
              <p class="img-caption">Canada</p>
            </div>
          </li>
          <li>
            <div class="img-card">
              <img src="assets/img/us.png" class="img-fluid" alt="" width="100px">
              <p class="img-caption">USA</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card h-100">
      <div class="card-body">
        <div class="Vector-map-js">
            <div id="worldMap" class="vmap"></div>
        </div>
      </div>
    </div>
  </div>
</div>



<?php include"footer.php"; ?>

<!-- vector map-->
<script src="assets/plugins/vectormap/js/jquery.vmap.min.js"></script>
<script src="assets/plugins/vectormap/js/country/jquery.vmap.world.js"></script>

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
          var CountryCode = code.toUpperCase();
          //alert(CountryCode);
          if ( CountryCode == "GB" || CountryCode == "AU" || CountryCode =="NZ" ) {
             window.location.href = "global-residential-data-search.php";
          }else{
              
          }
       
      }
    });

</script>