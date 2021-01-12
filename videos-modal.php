<div class="modal fade video-modal" id="proptechIntro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	<div class="modal-content">
	   	<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	      <span aria-hidden="true"><i class="icofont-close"></i></span>
	    </button> -->
		  <div class="modal-body">
		    <div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/6dN-hJUe7qs" allowfullscreen></iframe>
			</div>
		  </div>
		</div>
	</div>
</div>


<div class="modal fade video-modal" id="dynamicPricing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	<div class="modal-content">
	   	<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	      <span aria-hidden="true"><i class="icofont-close"></i></span>
	    </button> -->
		  <div class="modal-body">
		    <div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/4tI_82Q_3og" allowfullscreen></iframe>
			</div>
		  </div>
		</div>
	</div>
</div>

<div class="modal fade video-modal" id="portfolioAdviser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	<div class="modal-content">
	   	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	      <span aria-hidden="true"><i class="icofont-close"></i></span>
	    </button>
		  <div class="modal-body">
		    <div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zI2liEaR_2E" allowfullscreen></iframe>
			</div>
		  </div>
		</div>
	</div>
</div>


<!-- 
<iframe width="1280" height="720" src="https://www.youtube.com/embed/6dN-hJUe7qs" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


<iframe width="1280" height="720" src="https://www.youtube.com/embed/4tI_82Q_3og" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

<iframe width="1280" height="720" src="https://www.youtube.com/embed/zI2liEaR_2E" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->





<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>



	jQuery(document).ready(function() {
    
    //PropTech Introduction
    $("#proptechIntro").on('hidden.bs.modal', function(e) {
        $("#proptechIntro iframe").attr("src", $("#proptechIntro iframe").attr("src"));
    });

    // Dynamic Pricing
    $("#dynamicPricing").on('hidden.bs.modal', function(e) {
        $("#dynamicPricing iframe").attr("src", $("#dynamicPricing iframe").attr("src"));
    });

    // Portfolio Analyser
    $("#portfolioAdviser").on('hidden.bs.modal', function(e) {
        $("#portfolioAdviser iframe").attr("src", $("#portfolioAdviser iframe").attr("src"));
    });
    

});
</script>