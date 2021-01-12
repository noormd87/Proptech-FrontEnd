
 
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/js/jquery.js"></script>
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/js/bootstrap.js"></script>
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/js/owl.js"></script>
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/js/data-tables.js"></script>
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/wysihtml5/js/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/wysihtml5/js/bootstrap-wysihtml5.js"></script>
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/wysihtml5/js/wysihtml5-init.js"></script>
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/icheck/icheck.min.js"></script>
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/vectormap/js/jquery.vmap.min.js"></script>
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/vectormap/js/country/jquery.vmap.world.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function()
        {
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
                onRegionClick: function (element, code, region)
                {
                    var message = 'You clicked "' +
                    region +
                    '" which has the code: ' +
                    code.toUpperCase();
                    var CountryCode = code.toUpperCase();
                    if ( CountryCode == "GB" || CountryCode == "AU" || CountryCode =="NZ" )
                    {
                        window.location.href = "global-residential-data-search.php";
                    }
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {    
           $('.datepicker').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
        //startDate: '-3d'
  });
            //sidebar user card
            $('.nav-user-option').hide();
            $('#showUser').click(function() {
                if($('.nav-user').hasClass('user-card-sm')) {
                    $('.nav-user').removeClass('user-card-sm');
                } else {
                    $('.nav-user').addClass('user-card-sm');
                }
                $('.nav-user-option').slideToggle( "slow" );
                $("#showUser i").toggleClass("icofont-thin-up icofont-thin-down");
            });

  

        });

         window.onload = function(){
           // const ps = new PerfectScrollbar('.scroll-card', {
           //    wheelSpeed: 2,
           //    wheelPropagation: true,
           //    minScrollbarLength: 20
           //  });

            $('.scroll-card').each(function(){ const ps = new PerfectScrollbar($(this)[0]); });
            $('.scroll-div').each(function(){ const ps = new PerfectScrollbar($(this)[0]); });
            $('.news-card').each(function(){ const ps = new PerfectScrollbar($(this)[0]); });
            $('.scroll-card-sm').each(function(){ const ps = new PerfectScrollbar($(this)[0]); });
        } 


        // dynamic progressbar
        var i = 0;
        function makeProgress(){
            if(i < 60){
                i = i + 1;
                $(".meter-progress").css("width", i + "%");
            }
            // Wait for sometime before running this script again
            setTimeout("makeProgress()", 100);
        }
        makeProgress();
    </script>
    <script>
      $( function() {
    	$(document).on("keyup", "#search", function(){
    		passquery	=	$(this).val();
    		passtype	=	"Menus";
    		countrycode =  FnCheckNull($("#myportfoliocountry").val());
    		auto_complete($(this));
    	});
    	
    	
    	$(document).on("keyup", "#Suburb", function(){
    		passquery	=	$(this).val();
    		passtype	=	"SubUrb";
    		countrycode =  FnCheckNull($("#myportfoliocountry").val());
    		auto_complete_suburb($(this));
    	});
    	
    	$(document).on("keyup", "#Street", function(){
    		passquery	=	$(this).val();
    		passtype	=	"SubUrb";
    		countrycode =  FnCheckNull($("#myportfoliocountry").val());
    		auto_complete_address($(this));
    		//alert("street");
    	});
    	
    	//
      } );
    
      function auto_complete(e,otherwhr){ 
         
          
    		if(otherwhr==null)
    		{
    			otherwhr	=	"{'1':1}"
    		}
    
    		//console.log("passtype=" +passtype + ", passquery=" + passquery); 
    
    
    		datavalues  = eval(  {type:  passtype  , query: passquery , Propcountrycode: countrycode ,   otherwhr   } );
    		//console.log(e);
    
    		e.autocomplete({
    		   minLength: 2,
    			   delay: 500,
    			   autofocus: true,
    			   //data-auto-focus : true,
    
    			source: function (request, response) {
    			    //console.log("Call Ajax");
    				$.ajax({
    					type: "POST",
    					url:"<?php echo SITE_BASE_URL;?>ajax/menus.html",
    					data: datavalues,
    					success: response,
    					dataType: 'json' 
    				});
    				
    				//console.log("Call Ajax Done");
    			}, 
    			
    			select: function( event, ui ) {
    			  $( this ).val( ui.item.DESCRIPTION );
    			  window.location.href = ui.item.PAGE_LINK
    			  return false;
    			},
    			search: function(event, ui) { 
    			  // $('.spinner').show();
    			},
    			
    			open: function(){
    				$('.ui-autocomplete').css({'background-color': 'white', 'width': '300px'});
    			}
    		}) 
    		.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    		   return $( "<li >" )
    		   .append( "<a href='" + item.PAGE_LINK + "'>" + item.DESCRIPTION + "</a>" )
    		   .appendTo( ul );
    		};
    		
    		
    		//console.log("last")
    	}
    	
    	
    	
    	function auto_complete_suburb(e,otherwhr){ 
         
          
    		if(otherwhr==null)
    		{
    			otherwhr	=	"{'1':1}"
    		}
    
    
              
              if (passquery== "")
    	        $(".LoaderSuburb").hide();
    	      else
    		    $(".LoaderSuburb").show();
    		
    		//console.log("passtype=" +passtype + ", passquery=" + passquery + 'countrycode='+ countrycode ); 
    		
    		
    		UpperCountryCode = countrycode.toLocaleUpperCase();
    		
    		//console.log(UpperCountryCode);
    		
    		if (UpperCountryCode == "GB" || UpperCountryCode == "3" ){
    		    countryHtml = "suburbUK"
    		}else{
    		    countryHtml = "suburb"
    		}
    
            //console.log(countryHtml);
    
    		datavalues  = eval(  {type:  passtype  , query: passquery , Propcountrycode: countrycode ,   otherwhr   } );
    		//console.log(e);
    
    		e.autocomplete({
    		   minLength: 2,
    			   delay: 500,
    			   autofocus: true,
    			   //data-auto-focus : true,
    
    			source: function (request, response) {
    			    //console.log("Call Ajax");
    				$.ajax({
    					type: "POST",
    					url:"<?php echo SITE_BASE_URL;?>ajax/"+countryHtml+".html",
    					data: datavalues,
    					success: response,
    					dataType: 'json' 
    				});
    				//console.log("datavalues="+datavalues);
    			//	console.log("success="+response);
    				//console.log("Call Ajax Done");
    			}, 
    			
    			select: function( event, ui ) {
    			   $(".LoaderSuburb").hide();
    			  $( this ).val( ui.item.suggestion );
    			  $( "#LocationId" ).val( ui.item.localityId );
    			  $( "#CountryLng" ).val( ui.item.countrylng );
    			  $( "#CountryLat" ).val( ui.item.countrylat );
    			  $( "#CenterPoint1" ).val( ui.item.CenterPoint1 );
    			  $( "#CenterPoint2" ).val( ui.item.CenterPoint2 );
    			  
    			  
    			  
    			  //window.location.href = ui.item.PAGE_LINK
    			  
    			   var testdata = {
                        "KeyValue"   : ui.item.suggestion,
                        
                    };
    			  
    			 if (UpperCountryCode != "GB" || UpperCountryCode != "3" ){
						$.ajax({               
							url: "<?php echo SITE_BASE_URL;?>api/getMapScript.html",
							 type: "POST",
							 data:testdata,
							success : function(data){
							   $("#mapContainer").html(data)
							}
						 }); 
					}
    			  
    			
    				
    			  return false;
    			},
    			search: function(event, ui) { 
    			  // $('.spinner').show();
    			},
    			
    			open: function(){
    				$('.ui-autocomplete').css({'background-color': 'white', 'width': '300px'});
    			}
    		}) 
    		.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    		   return $( "<li >" )
    		   //.append( "<a href='" + item.PAGE_LINK + "'>" + item.DESCRIPTION + "</a>" )
    		   .append( item.suggestion )
    		   .appendTo( ul );
    		};
    		
    		
    		console.log("lastEnd")
    	}
    	
    	
    	
    	
    	
    	function auto_complete_address(e,otherwhr){ 
         
          
    		if(otherwhr==null)
    		{
    			otherwhr	=	"{'1':1}"
    		}
    
    		//console.log("passtype111=" +passtype + ", passquery=" + passquery); 
    		
  
    		
    		if (passquery == "")
    	        $(".LoaderStreet").hide();
    	      else
    		    $(".LoaderStreet").show();
    		
    		
    		UpperCountryCode = countrycode.toLocaleUpperCase();
    		
    		//alert(UpperCountryCode);
    		
    		if (UpperCountryCode == "GB" ){
    		    countryHtml = "addressUK"
    		}else{
    		    countryHtml = "address"
    		}
    
    
    
    		datavalues  = eval(  {type:  passtype  , query: passquery , Propcountrycode: countrycode ,   otherwhr   } );
    		console.log(e);
    
    		e.autocomplete({
    		   minLength: 2,
    			   delay: 500,
    			   autofocus: true,
    			   //data-auto-focus : true,
    
    			source: function (request, response) {
    			    //console.log("Call Ajax");
    				$.ajax({
    					type: "POST",
    					url:"<?php echo SITE_BASE_URL;?>ajax/"+countryHtml+".html",
    					data: datavalues,
    					success: response,
    					dataType: 'json' 
    				});
    				
    				//console.log("Call Ajax Done");
    			}, 
    			
    			select: function( event, ui ) {
    			    $(".LoaderStreet").hide();
    			  $( this ).val( ui.item.suggestion );
    			  $( "#LocationId" ).val( ui.item.localityId );
    			  $( "#PropertyIds" ).val( ui.item.propertyId );
    			  
    			  //window.location.href = ui.item.PAGE_LINK
    			  return false;
    			},
    			search: function(event, ui) { 
    			  // $('.spinner').show();
    			},
    			
    			open: function(){
    				$('.ui-autocomplete').css({'background-color': 'white', 'width': '300px'});
    				
    			}
    		}) 
    		.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    		   return $( "<li >" )
    		   //.append( "<a href='" + item.PAGE_LINK + "'>" + item.DESCRIPTION + "</a>" )
    		   .append( item.suggestion )
    		   .appendTo( ul );
    		};
    		
    		
    		//console.log("last")
    	}
    	
    	
    	
       var FnCheckNull = function(FnValue){

           if (FnValue == undefined) 

               FnValue = "";  

           return FnValue;

       };

    

    
      </script>
      
</body>
</html>