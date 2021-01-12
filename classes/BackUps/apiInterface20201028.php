<?php
namespace api;

interface apiInterface {
    //put your code here getMapScript
    
    
}

class apiClass implements apiInterface{
	public static $AuthToken, $KeyValue, $MapLattitude, $MapLongtitude;
    
	public static function index(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
	    //include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/index.php" );
    }
    public static function Init(){
         //self::GetFormValues();
		 self::GetCoreLogicToken(); 
    }
    
    
    public static function GetFormValues(){
        //self::$DocName        = isset($_REQUEST["DocName"]) ?  $_REQUEST["DocName"] : ""; 
        self::$KeyValue = isset($_REQUEST["KeyValue"]) ?  $_REQUEST["KeyValue"] : ""; 
        
        if (self::$KeyValue == ""){
	        self::$KeyValue = "new zealand"; 
	    }
	    
	    
	    self::$KeyValue = urlencode(self::$KeyValue);
	    
	    self::$MapLattitude = isset($_REQUEST["MapLattitude"]) ?  $_REQUEST["MapLattitude"] : ""; 
	    self::$MapLongtitude= isset($_REQUEST["MapLongtitude"]) ?  $_REQUEST["MapLongtitude"] : ""; 
	    
    }

	public static function GetCoreLogicToken(){
		$AuthUrl		= "https://api-uat.corelogic.asia/access/oauth/token?client_id=jqhrXN8FIcA8LgMHvijARfAqzy0PD2Cp&client_secret=qWSAAO7n0XPjhMvT&grant_type=client_credentials";

		$JsonRet		= file_get_contents($AuthUrl);

		$JsonDecode		= json_decode($JsonRet); 

		self::$AuthToken= $JsonDecode->access_token;
	}
	
	public static function getLatLongAddress(){
	    self::GetFormValues();
	    
	    $AuthUrl		= "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=" . self::$KeyValue . "&inputtype=textquery&fields=photos,formatted_address,name,rating,opening_hours,geometry&key=AIzaSyDmPfnhPm0JDemtnhAaJGdOldwe8NiKS8w";

		$JsonRet		= file_get_contents($AuthUrl);

		$JsonDecode		= json_decode($JsonRet); 
		
		//echo "<pre>"; print_r($JsonDecode->candidates[0]->geometry->location); echo "</pre>";
		
		self::$MapLattitude = isset($JsonDecode->candidates[0]->geometry->location->lat) ? $JsonDecode->candidates[0]->geometry->location->lat : "-37.0082476"; 
	    self::$MapLongtitude= isset($JsonDecode->candidates[0]->geometry->location->lng) ? $JsonDecode->candidates[0]->geometry->location->lng : "174.7850358";
	}
	
	public static function getMapScript($countryId="",$MapVal ="EMPTY" ){
	    
	    
	    if ( $MapVal != "EMPTY" ) 
	    
	    {
	    
	    
    	    $rows = \Property\PropertyClass::getCountryDatas($countryId,'');
            foreach ($rows as $row) 
            {
                
                $countryName = $row["COUNTRY_NAME"];
                $CountryUrl  = $row["country_map_url"];
                $CountryLat  = $row["Country_Lat"];
                $CountryLng  = $row["Country_Lng"];
                $ZoomVal     = "5";
            }
            
            
	    }else{
	            self::getLatLongAddress(); 
	            
	            $CountryLat  = self::$MapLattitude;
	            $CountryLng  = self::$MapLongtitude;
	            $ZoomVal     = "10";
	        
	    }

	    
	    
	    
	    
	?>
	
	     <input id="pac-input" class="controls" type="text" placeholder="Search Box" style='display:none;'>
                        <div id="map"></div>
                        
                         <script>
                         function initAutocomplete() {
        
                            //alert();
                            var map;
                            //{lat: -41.4362, lng: 168.6493},
                            var map = new google.maps.Map(document.getElementById('map'), {
                              center: {lat: <?php echo $CountryLat; ?>, lng: <?php echo $CountryLng; ?>},
                              zoom: <?php echo $ZoomVal; ?>,
                              mapTypeId: 'roadmap'
                            });
                    
                            // Create the search box and link it to the UI element.
                            //var input = document.getElementById('Subrub');
                            var input = document.getElementById('pac-input');
                            var searchBox = new google.maps.places.SearchBox(input);
                            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                    
                            // Bias the SearchBox results towards current map's viewport.
                            map.addListener('bounds_changed', function() {
                              searchBox.setBounds(map.getBounds());
                            });
                    
                            var markers = [];
                            // Listen for the event fired when the user selects a prediction and retrieve
                            // more details for that place.
                            searchBox.addListener('places_changed', function() {
                              var places = searchBox.getPlaces();
                    
                              if (places.length == 0) {
                                return;
                              }
                    
                              // Clear out the old markers.
                              markers.forEach(function(marker) {
                                marker.setMap(null);
                              });
                              markers = [];
                    
                              // For each place, get the icon, name and location.
                              var bounds = new google.maps.LatLngBounds();
                              places.forEach(function(place) {
                                if (!place.geometry) {
                                  console.log("Returned place contains no geometry");
                                  return;
                                }
                                var icon = {
                                  url: place.icon,
                                  size: new google.maps.Size(71, 71),
                                  origin: new google.maps.Point(0, 0),
                                  anchor: new google.maps.Point(17, 34),
                                  scaledSize: new google.maps.Size(25, 25)
                                };
                    
                                // Create a marker for each place.
                                markers.push(new google.maps.Marker({
                                  map: map,
                                  icon: icon,
                                  title: place.name,
                                  position: place.geometry.location
                                }));
                    
                                if (place.geometry.viewport) {
                                  // Only geocodes have viewport.
                                  bounds.union(place.geometry.viewport);
                                } else {
                                  bounds.extend(place.geometry.location);
                                }
                              });
                              map.fitBounds(bounds);
                            });
                        }
                      
                      </script>
                       <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmPfnhPm0JDemtnhAaJGdOldwe8NiKS8w&libraries=places&callback=initAutocomplete"
         async defer></script>
         
	<?php    
  }
  
  public static function getMapBoxScriptRender($countryId="",$MapVal ="EMPTY" ){
	    
	    
    if ( $MapVal != "EMPTY" ) 
    
    {
    
    
        $rows = \Property\PropertyClass::getCountryDatas($countryId,'');
          foreach ($rows as $row) 
          {
              
              $countryName = $row["COUNTRY_NAME"];
              $CountryUrl  = $row["country_map_url"];
              $CountryLat  = $row["Country_Lat"];
              $CountryLng  = $row["Country_Lng"];
              $ZoomVal     = "5";
          }
          
          
    }else{
            self::getLatLongAddress(); 
            
            $CountryLat  = self::$MapLattitude;
            $CountryLng  = self::$MapLongtitude;
            $ZoomVal     = "10";
        
    }
    
?>
<script src="https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css" rel="stylesheet" />
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
<link
rel="stylesheet"
href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"
type="text/css"
/>
<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<style>
.geocoder {
position: absolute;
z-index: 1;
width: 50%;
left: 50%;
margin-left: -25%;
top: 10px;
}
.mapboxgl-ctrl-geocoder {
min-width: 100%;
}
#map {
margin-top: 75px;
}
</style>
<div id="map"></div>
<script src="https://unpkg.com/es6-promise@4.2.4/dist/es6-promise.auto.min.js"></script>
<script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
 
<script>
//   mapboxgl.accessToken = 
//   'pk.eyJ1IjoiY3B5YWRhdiIsImEiOiJja2I0amdsZHQwZzhlMnpvNnE5Ymw5Mjh4In0.YPNBnmuJX9KWfNzemJqlqQ';
// var map = new mapboxgl.Map({
// container: 'map',
// style: 'mapbox://styles/mapbox/streets-v11',
// center: [-79.4512, 43.6568],
// zoom: 13
// });
 
// var geocoder = new MapboxGeocoder({
// accessToken: mapboxgl.accessToken,
// mapboxgl: mapboxgl
// });
 
// document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
mapboxgl.accessToken = 'pk.eyJ1IjoiY3B5YWRhdiIsImEiOiJjaWVtaGtwMmkwMDc5cnNrbXQwMGRheHZqIn0.tlEUXj14r-jWmk3Nkh075g';
var mapboxClient = mapboxSdk({ accessToken: mapboxgl.accessToken });
mapboxClient.geocoding
.forwardGeocode({
query: '<?php echo ($_REQUEST['Suburb']) ?$_REQUEST['Suburb'] : 'New Delhi' ?>',
autocomplete: false,
limit: 1
})
.send()
.then(function(response) {
if (
response &&
response.body &&
response.body.features &&
response.body.features.length
) {
var feature = response.body.features[0];
 
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11',
center: feature.center,
zoom: 10
});
new mapboxgl.Marker().setLngLat(feature.center).addTo(map);
}
});
</script>       
       
<?php    
}
	
public static function GetMedianPriceApiDatas($RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $propertyTypeId = "6", $fromDate = "2019-01-01", $toDate = "2020-02-20" , $metricTypeId = "21" , $interval = 12 ){ //formap, fortable 
	
	    
	    $fromDate = date("Y-m-d", strtotime("-10 years"));
	    $toDate = date('Y-m-d');
	    
	    //echo 'fromDate='. $fromDate .'<br>';
	    //echo 'toDate='. $toDate .'<br>';
	    
	    
	    $PostData       = array("seriesRequestList" => array( "locationId"      => $locationId,
                                                      "locationTypeId"  => $locationTypeId,
                                                      "propertyTypeId"  => $propertyTypeId,
                                                      "fromDate"        => $fromDate,
                                                      "toDate"          => $toDate,
                                                      "metricTypeId"    => $metricTypeId,
                                                      "interval"        => $interval
                                                      )
                 ); 

		$PostJsonData   = json_encode($PostData); 
		$PostJsonData   = str_replace(":{", ":[{", $PostJsonData);
		$PostJsonData   = str_replace("}}", "}]}", $PostJsonData);



		$url = "https://api-uat.corelogic.asia/statistics/v1/statistics.json"; 

		$data_json = $PostJsonData; 

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . self::$AuthToken, 'Content-Length: ' . strlen($data_json)));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response  = curl_exec($ch);
		curl_close($ch);


		$response_arr = json_decode($response); 

		$TempArr1   = array();
		$TempArr2   = array(); 
		$IsValueOccured = false;
		$AllArray   = array(); 

		if (isset($response_arr->seriesResponseList)){
			$SeriesListArr  = $response_arr->seriesResponseList[0]->seriesDataList;
			//echo "<pre>"; print_r($SeriesListArr); 
			
			foreach($SeriesListArr as $SeriesListArr1){
			   
			    $yrdata= strtotime($SeriesListArr1->dateTime);
				$TempArr1[] = date('M-Y', $yrdata);
				
				$TempArr2[] = number_format(round($SeriesListArr1->value,4), 4, ".", "");  
				$TempArr3[] = round(floatval($SeriesListArr1->value) + 2000,2);  // dummy
				
				
				$dateTimeval = date('M-Y', $yrdata);
				
			    $AllArray[] = array("date" => $dateTimeval, "value" => round($SeriesListArr1->value,4)); 
			    
			    $IsValueOccured = true;
			}
			
		}
		
		if ($IsValueOccured == false) {
		    
		    $TempArr2 = "";
		    $TempArr1 = "";
		    $TempArr3 = "";
		}
        
        if ($RetType == "formap"){
		    return $FinalArr       = array("values" =>  $TempArr2, "dateTime" => $TempArr1, "values2" => $TempArr3);
        }
        else{
            return $AllArray; 
        }
	}

	public static function ShowMedianMapApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$Row = "",$propertyTypeId ="",$countryId=""){
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,8,$propertyTypeId); 
        
        $MapCurrecncy = self::GetCurrencyDetails($countryId); 
        
        
		
		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($FinalArr); echo "</pre>";

		//echo json_encode($FinalArr); 
		$FinalStr = "";
		 if ($TempArr2!=""){

		$Datas = implode(",", $TempArr2) ; 
		if ($TempArr3!="" ||$TempArr3!=null){
		$Datas2 = implode(",", $TempArr3) ; 
		}
		$Categories = "'" . implode("','", $TempArr1) . "'";



		$FinalStr = "<script>//Recent Median Sale Prices
              var colors1 = [ '#00E396'];
              var options = {
              chart: {
                toolbar:{
                  show:false
                },
                height: 380,
                type: 'bar',
                stacked: false
              },
              colors: colors1,
              dataLabels: {
                enabled: false
              },
              series: [
                {
                  name: '" .$Subrub. "',
                  type: 'column',
                  data: [" . $Datas . "]
                }
              ],
              xaxis: {
                categories: [" . $Categories . "],
                title: {
                    text: 'Year',
                    style: {
                      fontSize:  '10 px',
                      fontWeight:  'normal',
                      fontFamily:  undefined,
                      color:  '#263238'
                    },
                  },
              },
              yaxis: [
                {
                  axisTicks: {
                    show: true
                  },
                  axisBorder: {
                    show: true,
                    color: '#3f51b5'
                  },
                  title: {
                    text: 'Median Price ". $MapCurrecncy ."',
                    style: {
                      fontSize:  '10 px',
                      fontWeight:  'normal',
                      fontFamily:  undefined,
                      color:  '#263238'
                    },
                  },
                  labels: {
                    formatter: function (value) {
                      return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); 
                    },
                    style: {
                      color: '#3f51b5'
                    }
                  }
                },
                {
                  axisTicks: {
                    show: false
                  },
                  axisBorder: {
                    show: false,
                    color: '#FFA600'
                  },
                  labels: {
                    show: false,
                    style: {
                      color: '#FFA600'
                    }
                  }
                }
              ],
              tooltip: {
                followCursor: true,
                y: {
                  formatter: function(y) {
                    if (typeof y !== 'undefined') {
                      return y ;
                    }
                    return y;
                  }
                }
              },
              markers: {
                size: 5,
                hover: {
                  size: 9
                }
              }
            };
            
            var chart = new ApexCharts(document.querySelector('#medianChart$Row'), options);
            
            chart.render();
            
            </script>
            ";
		 }		

		//echo $FinalStr; 
		return $FinalStr; 
	}
    
    
    
    public static function ShowMedianTableValueApi($LocationId,$StreetId,$ZipcodeId,$propertyTypeId){
		self::Init(); 

        $TempMedianData = self::GetMedianPriceApiDatas("forTbl",$LocationId,"8",$propertyTypeId,"2010-01-01","2020-02-20","21","12");
        

		return $TempMedianData; 
	}
	
	


	public static function ChangeMedianPriceApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId){
		self::Init(); 
		
		//echo "propertyTypeId=".$propertyTypeId;

		$FinalStr		= "";

        $TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,"8",$propertyTypeId,"2010-01-01","2020-02-20","69","12");
       

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";
        
     
	
        if ($TempArr2 !="" ){
            
    		$Datas = implode(",",$TempArr2) ; 
    		$Datas2 = implode(",",$TempArr3) ; 
    		$Categories = "'" . implode("','",$TempArr1) . "'"; 
    		
    	
    
        		$FinalStr = "<script>
                          var colors2 = [ '#E9F312'];
                          var options = {
                          chart: {
                            toolbar:{
                              show:false
                            },
                            height: 380,
                            type: 'bar',
                            stacked: false
                          },
                          colors: colors2,
                          dataLabels: {
                            enabled: false
                          },
                          series: [
                            {
                              name: '" .$Subrub. "',
                              type: 'column',
                              data: [" . $Datas . "]
                            }
                          ],
                          xaxis: {
                            categories: [" . $Categories . "],
                            title: {
                                text: 'Year',
                                style: {
                                  fontSize:  '10 px',
                                  fontWeight:  'normal',
                                  fontFamily:  undefined,
                                  color:  '#263238'
                                },
                              }
                          },
                          yaxis: [
                            {
                              axisTicks: {
                                show: true
                              },
                              axisBorder: {
                                show: true,
                                color: '#3f51b5'
                              },
                              labels: {
                                formatter: function (value) {
                                  return value.toFixed(3) + '%';
                                },
                                style: {
                                  color: '#3f51b5'
                                }
                              },
                              title: {
                                text: 'Change in Median Price',
                                style: {
                                  fontSize:  '10 px',
                                  fontWeight:  'normal',
                                  fontFamily:  undefined,
                                  color:  '#263238'
                                },
                              },
                            },
                            {
                              axisTicks: {
                                show: false
                              },
                              axisBorder: {
                                show: false,
                                color: '#FFA600'
                              },
                              labels: {
                                show: false,
                                style: {
                                  color: '#FFA600'
                                }
                              }
                            }
                          ],
                          tooltip: {
                            followCursor: true,
                            y: {
                              formatter: function(y) {
                                if (typeof y !== 'undefined') {
                                  return y.toFixed(3) + ' %';
                                }
                                return y;
                              }
                            }
                          },
                          markers: {
                            size: 5,
                            hover: {
                              size: 9
                            }
                          }
                        };
                        
                        var chart = new ApexCharts(document.querySelector('#changemedianprice'), options);
                        
                        chart.render();
                        
                        </script>
                        ";
		}else{
		    
		    $FinalStr = "";
		}

		//echo $FinalStr; 
		return $FinalStr;
	}
    
    
      public static function ChangeMedianPriceTableVal($LocationId,$StreetId,$ZipcodeId,$propertyTypeId){
		self::Init(); 

        $TempMedianData = self::GetMedianPriceApiDatas ("forTbl",$LocationId,"8",$propertyTypeId,"2010-01-01","2020-02-20","69","12"); 
       

		return $TempMedianData; 
	}
    
    
    public static function RentalStatisticsApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$Metrics="77",$countryId=""){
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,"8",$propertyTypeId,"2010-01-01","2020-02-20",$Metrics,"12");
        
        $MapCurrecncy = self::GetCurrencyDetails($countryId); 

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";
		
		//	echo "<pre>..."; print_r($TempMedianData); echo "</pre>";
		//exit;

		//echo json_encode($FinalArr);  
		
		//exit();
		$FinalStr = "";
		if ($TempArr2!=""){
    
    		$Datas = implode(",", $TempArr2) ; 
    		$Datas2 = implode(",", $TempArr3) ; 
    		$Categories = "'" . implode("','", $TempArr1) . "'"; 
    
    		$FinalStr = "<script>//
                      var colors3 = [ '#F32312'];
                      var options = {
                      chart: {
                        toolbar:{
                          show:false
                        },
                        height: 380,
                        type: 'bar',
                        stacked: false
                      },
                      colors: colors3,
                      dataLabels: {
                        enabled: false
                      },
                      series: [
                        {
                          name: '" .$Subrub. "', 
                          type: 'column',
                          data: [" . $Datas . "]
                        }
                      ],
                      xaxis: {
                        categories: [" . $Categories . "],
                        title: {
                            text: 'Year',
                            style: {
                              fontSize:  '10 px',
                              fontWeight:  'normal',
                              fontFamily:  undefined,
                              color:  '#263238'
                            },
                          }
                        
                      },
                      yaxis: [
                        {
                          axisTicks: {
                            show: true
                          },
                          axisBorder: {
                            show: true,
                            color: '#3f51b5'
                          },
                          labels: {
                            formatter: function (value) {
                              return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); ;;
                            },
                            style: {
                              color: '#3f51b5'
                            }
                          },
                          title: {
                            text: 'Rental Price ". $MapCurrecncy ."',
                            style: {
                              fontSize:  '10 px',
                              fontWeight:  'normal',
                              fontFamily:  undefined,
                              color:  '#263238'
                            },
                          }
                        },
                        {
                          axisTicks: {
                            show: false
                          },
                          axisBorder: {
                            show: false,
                            color: '#FFA600'
                          },
                          labels: {
                            show: false,
                            style: {
                              color: '#FFA600'
                            }
                          }
                        }
                      ],
                      tooltip: {
                        followCursor: true,
                        y: {
                          formatter: function(y) {
                            if (typeof y !== 'undefined') {
                              return '$ '+ y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            }
                            return y;
                          }
                        }
                      },
                      markers: {
                        size: 5,
                        hover: {
                          size: 9
                        }
                      }
                    };
                    
                    var chart = new ApexCharts(document.querySelector('#rentalstatistics'), options);
                    
                    chart.render();
                    
                    </script>
                    ";
		}else{
		    $FinalStr = "";
		}
				

		//echo $FinalStr; 
		return $FinalStr; 
	}
	
	
	public static function RentalRateObservationApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$MetricsRentalRate,$countryId=""){
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,"8",$propertyTypeId,"2010-01-01","2020-02-20",$MetricsRentalRate,"12");
        
        $MapCurrecncy = self::GetCurrencyDetails($countryId); 

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";

		//echo json_encode($FinalArr);  
		
		//exit();
		
		$FinalStr = "";
		if ($TempArr2!=""){

		$Datas = implode(",", $TempArr2) ; 
		$Datas2 = implode(",", $TempArr3) ; 
		$Categories = "'" . implode("','", $TempArr1) . "'"; 

		$FinalStr = "<script>//
                  var colors4 = [ '#5DF312'];
                  var options = {
                  chart: {
                    toolbar:{
                      show:false
                    },
                    height: 380,
                    type: 'bar',
                    stacked: false
                  },
                  colors: colors4,
                  dataLabels: {
                    enabled: false
                  },
                  series: [
                    {
                      name: '" .$Subrub. "', 
                      type: 'column',
                      data: [" . $Datas . "]
                    }
                  ],
                  xaxis: {
                    categories: [" . $Categories . "],
                    title: {
                        text: 'Year',
                        style: {
                          fontSize:  '10 px',
                          fontWeight:  'normal',
                          fontFamily:  undefined,
                          color:  '#263238'
                        },
                      }
                  },
                  yaxis: [
                    {
                      axisTicks: {
                        show: true
                      },
                      axisBorder: {
                        show: true,
                        color: '#3f51b5'
                      },
                      labels: {
                        formatter: function (value) {
                          return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');;
                        },
                        style: {
                          color: '#3f51b5'
                        }
                      },
                      title: {
                        text: 'Rental Rate Observations ". $MapCurrecncy ."',
                        style: {
                          fontSize:  '10 px',
                          fontWeight:  'normal',
                          fontFamily:  undefined,
                          color:  '#263238'
                        },
                      }
                    },
                    {
                      axisTicks: {
                        show: false
                      },
                      axisBorder: {
                        show: false,
                        color: '#FFA600'
                      },
                      labels: {
                        show: false,
                        style: {
                          color: '#FFA600'
                        }
                      }
                    }
                  ],
                  tooltip: {
                    followCursor: true,
                    y: {
                      formatter: function(y) {
                        if (typeof y !== 'undefined') {
                          return '$ '+ y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        }
                        return y;
                      }
                    }
                  },
                  markers: {
                    size: 5,
                    hover: {
                      size: 9
                    }
                  }
                };
                
                var chart = new ApexCharts(document.querySelector('#rentalrateobservation'), options);
                
                chart.render();
                
                </script>
                ";
		}

		//echo $FinalStr; 
		return $FinalStr; 
	}
	
	
	public static function ChangerenatalRateApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$MetricsChangerenatalRate,$countryId=""){
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,"8",$propertyTypeId,"2010-01-01","2020-02-20",$MetricsChangerenatalRate,"12");
        
        $MapCurrecncy = self::GetCurrencyDetails($countryId); 

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";

		//echo json_encode($FinalArr);  
		
		//exit();
		$FinalStr = "";
		if ($TempArr2!=""){

		$Datas = implode(",", $TempArr2) ; 
		$Datas2 = implode(",", $TempArr3) ; 
		$Categories = "'" . implode("','", $TempArr1) . "'"; 

		$FinalStr = "<script>//
                  var colors5 = [ '#3A6922'];  
                  var options = {
                  chart: {
                    toolbar:{
                      show:false
                    },
                    height: 380,
                    type: 'bar',
                    stacked: false
                  },
                  colors: colors5,
                  dataLabels: {
                    enabled: false
                  },
                  series: [
                    {
                      name: '" .$Subrub. "', 
                      type: 'column',
                      data: [" . $Datas . "]
                    }
                  ],
                  xaxis: {
                    categories: [" . $Categories . "],
                    title: {
                        text: 'Year',
                        style: {
                          fontSize:  '10 px',
                          fontWeight:  'normal',
                          fontFamily:  undefined,
                          color:  '#263238'
                        },
                      }
                  },
                  yaxis: [
                    {
                      axisTicks: {
                        show: true
                      },
                      axisBorder: {
                        show: true,
                        color: '#3f51b5'
                      },
                      labels: {
                        formatter: function (value) {
                          return (value.toFixed(2)) + '%';
                          
                        },
                        style: {
                          color: '#3f51b5'
                        }
                      },
                      title: {
                        text: 'Change In Rental Rate',
                        style: {
                          fontSize:  '10 px',
                          fontWeight:  'normal',
                          fontFamily:  undefined,
                          color:  '#263238'
                        },
                      }
                      
                    },
                    {
                      axisTicks: {
                        show: false
                      },
                      axisBorder: {
                        show: false,
                        color: '#FFA600'
                      },
                      labels: {
                        show: false,
                        style: {
                          color: '#FFA600'
                        }
                      }
                    }
                  ],
                  tooltip: {
                    followCursor: true,
                    y: {
                      formatter: function(y) {
                        if (typeof y !== 'undefined') {
                          return y.toFixed(2) + ' %';
                        }
                        return y;
                      }
                    }
                  },
                  markers: {
                    size: 5,
                    hover: {
                      size: 9
                    }
                  }
                };
                
                var chart = new ApexCharts(document.querySelector('#changerenatalrate'), options);
                
                chart.render();
                
                </script>
                ";
				
		}
		//echo $FinalStr; 
		return $FinalStr; 
	}

    	public static function GrossRentalYieldApi($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$MetricsGrossRentalYield,$countryId=""){
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,"8",$propertyTypeId,"2010-01-01","2020-02-20",$MetricsGrossRentalYield,"12");
        
        $MapCurrecncy = self::GetCurrencyDetails($countryId); 
       

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";

		//echo json_encode($FinalArr);  
		
		//exit();
		
		$FinalStr = "";
		if ($TempArr1!=""){

		$Datas = implode(",", $TempArr2) ; 
		$Datas2 = implode(",", $TempArr3) ; 
		$Categories = "'" . implode("','", $TempArr1) . "'"; 

		$FinalStr = "<script>//
                  var colors6 = [ '#5BBDFA'];
                  var options = {
                  chart: {
                    toolbar:{
                      show:false
                    },
                    height: 380,
                    type: 'bar',
                    stacked: false
                  },
                  colors: colors6,
                  dataLabels: {
                    enabled: false
                  },
                  series: [
                    {
                      name: '" .$Subrub. "', 
                      type: 'column',
                      data: [" . $Datas . "]
                    }
                  ],
                  xaxis: {
                    categories: [" . $Categories . "],
                    title: {
                        text: 'Year',
                        style: {
                          fontSize:  '10 px',
                          fontWeight:  'normal',
                          fontFamily:  undefined,
                          color:  '#263238'
                        },
                      }
                  },
                  yaxis: [
                    {
                      axisTicks: {
                        show: true
                      },
                      axisBorder: {
                        show: true,
                        color: '#3f51b5'
                      },
                      labels: {
                        formatter: function (value) {
                          return value.toFixed(2) + '%';
                        },
                        style: {
                          color: '#3f51b5'
                        }
                      },
                      title: {
                        text: 'Gross Rental Yield',
                        style: {
                          fontSize:  '10 px',
                          fontWeight:  'normal',
                          fontFamily:  undefined,
                          color:  '#263238'
                        },
                      }
                      
                    },
                    {
                      axisTicks: {
                        show: false
                      },
                      axisBorder: {
                        show: false,
                        color: '#FFA600'
                      },
                      labels: {
                        show: false,
                        style: {
                          color: '#FFA600'
                        }
                      }
                    }
                  ],
                  tooltip: {
                    followCursor: true,
                    y: {
                      formatter: function(y) {
                        if (typeof y !== 'undefined') {
                          return y.toFixed(2) + ' %';
                        }
                        return y;
                      }
                    }
                  },
                  markers: {
                    size: 5,
                    hover: {
                      size: 9
                    }
                  }
                };
                
                var chart = new ApexCharts(document.querySelector('#grossrentalyield'), options);
                
                chart.render();
                
                </script>
                ";
		}		

		//echo $FinalStr; 
		return $FinalStr; 
	}
/*----------------------------------------------*/




    public static function GetCensusHouseholdApiDatas($RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $metricGroupId = "118" ){ //formap, fortable 
        self::Init(); 
        
        //echo 'locationId='. $locationId .'<br>';
       // echo '$locationTypeId='. $locationTypeId .'<br>';
        //echo '$metricGroupId='. $metricGroupId .'<br>';
	
	    $PostData       = array("censusRequestList" => array( "locationId"      => $locationId, //"200452", // 
                                                      "locationTypeId"  => $locationTypeId,
                                                      "metricTypeGroupId"  => $metricGroupId
                                                      )
                 ); 

		$PostJsonData   = json_encode($PostData); 
		$PostJsonData   = str_replace(":{", ":[{", $PostJsonData);
		$PostJsonData   = str_replace("}}", "}]}", $PostJsonData);
        
        //echo $PostJsonData; 
        
        /*
        {"censusRequestList":[{"locationId":"200299","locationTypeId":"8","metricTypeGroupId":"118"}]}
        
        {
        "censusRequestList":[
                {
                "locationId":"200452", - Taken from suggest service (highlighted in yellow)
                "locationTypeId":"8", - - 8 relates to the suburb
                "metricTypeGroupId":"118" - Find this on the census metrics type page on dev portal
                }
        ]
        }

        */


		$url = "https://api-uat.corelogic.asia/statistics/census"; 
		
		//https://api-uat.corelogic.asia/statistics/census
		
		//echo self::$AuthToken; 

		$data_json = $PostJsonData; 

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . self::$AuthToken, 'Content-Length: ' . strlen($data_json)));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response  = curl_exec($ch);
		curl_close($ch);


		$response_arr = json_decode($response); 

		$TempArr1   = array();
		$TempArr2   = array(); 
		
		$AllArray   = array(); 
		
		

		if (isset($response_arr->censusResponseList)){
			$SeriesListArr  = $response_arr->censusResponseList; //->seriesDataList;
			
			
			foreach($SeriesListArr as $SeriesListArr2){
			    //echo "<pre>"; print_r($SeriesListArr2); echo $SeriesListArr2->metricTypeShort; echo "</pre>";  
			    
			    $SeriesListArr1 = $SeriesListArr2->seriesDataList; 
			    //echo "<pre style='display:none;'>"; echo $SeriesListArr2->metricTypeShort; print_r($SeriesListArr2); echo "</pre>";  
			    
			    //echo "Value=>" . (string)$SeriesListArr1[0]->value; 
			    
			   
			    $yrdata= strtotime($SeriesListArr1[0]->dateTime);
				//$TempArr1[] = date('M-Y', $yrdata);
				
				$TempArr1[] = $SeriesListArr2->metricTypeShort; 
				
				$TempArr2[] = (string)$SeriesListArr1[0]->value; 
				
				
				$TempArr3[] = floatval((string)$SeriesListArr1[0]->value);  // dummy
				
				//echo "<div style='display:none'>" . $SeriesListArr2->metricTypeShort . "</div>";
				
				
				$dateTimeval = date('M-Y', $yrdata);
				
				// -20K
				
			    $AllArray[] = array("date" => $dateTimeval, "value" => (string)$SeriesListArr1[0]->value , "metricTypeShort" => $SeriesListArr2->metricTypeShort); 
			}
			
			
			
		}
        
        if ($RetType == "formap"){
            //echo "In";
		    return $FinalArr       = array("values" =>  $TempArr2, "dateTime" => $TempArr1, "values2" => $TempArr3,"metricTypeShort" => $TempArr1 );
        }
        else{
            return $AllArray; 
        }
	}
	
	
	
	public static function ShowCensusHouseholdMapApi( $RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $metricGroupId = "118" ){  //$RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $metricGroupId = "118" 
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetCensusHouseholdApiDatas("formap", $locationId, $locationTypeId, $metricGroupId);
       

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($TempArr2); echo "</pre>";

		//echo json_encode($FinalArr);  
		
		//exit();

		$Datas = implode(",", $TempArr2) ; 
		$Datas2 = implode(",", $TempArr3) ; 
		$Categories = "'" . implode("','", $TempArr1) . "'"; 

		$FinalStr = "<script type='text/javascript'>
        
             var options = {
          series: [" . $Datas . "],
          chart: {
          width: 500,
          type: 'pie',
        },
        labels: [" . $Categories . "],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 300
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector('#census'), options);
        chart.render();
        </script>
                ";
                
		//echo $FinalStr; 
		return $FinalStr; 
	}
    
	//public static function AgeRatioApi($LocationId,$StreetId,$ZipcodeId,$Subrub){
	public static function AgeRatioApi( $RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $metricGroupId = "113" ){
		self::Init(); 

		$FinalStr		= "";
		
		//echo $locationId;

        //$TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,"8","6","2010-01-01","2020-02-20","78","12");
         $TempMedianData = self::GetCensusHouseholdApiDatas("formap", $locationId, $locationTypeId, $metricGroupId);
       
        
        //echo "<pre>"; print_r($TempMedianData); echo "</pre>";

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		$TempArr4       = $TempMedianData["metricTypeShort"]; 
		
		
		
		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";

		//echo json_encode($FinalArr);  
		
//	exit();

		$Datas = implode(",", $TempArr2) ; 
		$Datas2 = implode(",", $TempArr3) ; 
		$Categories = "'" . implode("','", $TempArr1) . "'"; 
		
		$Categories1 = implode(",", $TempArr4) ; 

		$FinalStr = "<script>//
                  var colors7 = [ '#3E217A'];
                  var options = {
                  chart: {
                    toolbar:{
                      show:false
                    },
                    height: 380,
                    type: 'bar',
                    stacked: false
                  },
                  colors: colors7,
                  dataLabels: {
                    enabled: false
                  },
                  series: [
                    {
                      name: '" .$Subrub. "', 
                      type: 'column',
                      data: [" . $Datas . "]
                    }
                  ],
                  xaxis: {
                    categories: [" . $Categories . "],
                    title: {
                        text: 'Age',
                        style: {
                          fontSize:  '10 px',
                          fontWeight:  'normal',
                          fontFamily:  undefined,
                          color:  '#263238'
                        },
                      }
                  },
                  yaxis: [
                    {
                      axisTicks: {
                        show: true
                      },
                      axisBorder: {
                        show: true,
                        color: '#3f51b5'
                      },
                      labels: {
                        formatter: function (value) {
                          return value.toFixed(0) +'%' ;
                        },
                        style: {
                          color: '#3f51b5'
                        }
                      },
                      title: {
                        text: 'Age Ratio',
                        style: {
                          fontSize:  '10 px',
                          fontWeight:  'normal',
                          fontFamily:  undefined,
                          color:  '#263238'
                        },
                      }
                    },
                    {
                      axisTicks: {
                        show: false
                      },
                      axisBorder: {
                        show: false,
                        color: '#FFA600'
                      },
                      labels: {
                        show: false,
                        style: {
                          color: '#FFA600'
                        }
                      }
                    }
                  ],
                  tooltip: {
                    followCursor: true,
                    y: {
                      formatter: function(y) {
                        if (typeof y !== 'undefined') {
                          return y.toFixed(0) +'%' ;
                        }
                        return y;
                      }
                    }
                  },
                  markers: {
                    size: 5,
                    hover: {
                      size: 9
                    }
                  }
                };
                
                var chart = new ApexCharts(document.querySelector('#AgeRatio'), options);
                
                chart.render();
                
                </script>
                ";
				

		//echo $FinalStr; 
		return $FinalStr; 
	}
	
	
	public static function HouseholdIncomeTableVal($LocationId,$StreetId,$ZipcodeId,$propertyTypeId,$MetricsHouseholdIncome="117"){
		self::Init(); 

       $TempMedianData = self::GetCensusHouseholdApiDatas("forTbl", $LocationId, 8, $MetricsHouseholdIncome);
       

		return $TempMedianData; 
	}
	
	
    
    	public static function HouseholdIncomeApi( $RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $metricGroupId = "117" ){
		self::Init(); 

		$FinalStr		= "";
		
		//echo $locationId;

        //$TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,"8","6","2010-01-01","2020-02-20","78","12");
         $TempMedianData = self::GetCensusHouseholdApiDatas("formap", $locationId, $locationTypeId, $metricGroupId);
       
        
       

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		$TempArr4       = $TempMedianData["metricTypeShort"]; 
		
		
		
		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";

		//echo json_encode($FinalArr);  
		
//	exit();

		$Datas = implode(",", $TempArr2) ; 
		$Datas2 = implode(",", $TempArr3) ; 
		$Categories = "'" . implode("','", $TempArr1) . "'"; 
		
		$Categories1 = implode(",", $TempArr4) ; 

		$FinalStr = "<script>//
                  var colors8 = ['#7AD46A'];
                  var options = {
                  chart: {
                    toolbar:{
                      show:false
                    },
                    height: 380,
                    type: 'line',
                    stacked: false
                  },
                  colors: colors8,
                  dataLabels: {
                    enabled: false
                  },
                  series: [
                    {
                      name: '" .$Subrub. "', 
                      type: 'column',
                      data: [" . $Datas . "]
                    }
                  ],
                  xaxis: {
                    categories: [" . $Categories . "],
                    title: {
                        text: 'Household Income',
                        style: {
                          fontSize:  '10 px',
                          fontWeight:  'normal',
                          fontFamily:  undefined,
                          color:  '#263238'
                        },
                      }
                  },
                  yaxis: [
                    {
                      axisTicks: {
                        show: true
                      },
                      axisBorder: {
                        show: true,
                        color: '#3f51b5'
                      },
                      labels: {
                        formatter: function (value) {
                          return value + '%';
                        },
                        style: {
                          color: '#3f51b5'
                        }
                      }
                    },
                    {
                      axisTicks: {
                        show: false
                      },
                      axisBorder: {
                        show: false,
                        color: '#FFA600'
                      },
                      labels: {

                        show: false,
                        style: {
                          color: '#FFA600'
                        }
                      }
                    }
                  ],
                  tooltip: {
                    followCursor: true,
                    y: {
                      formatter: function(y) {
                        if (typeof y !== 'undefined') {
                          return y + ' %';
                        }
                        return y;
                      }
                    }
                  },
                  markers: {
                    size: 5,
                    hover: {
                      size: 9
                    }
                  }
                };
                
                var chart = new ApexCharts(document.querySelector('#HouseholdIncome'), options);
                
                chart.render();
                
                </script>
                ";
				

		//echo $FinalStr; 
		return $FinalStr; 
	}
	
	
	
		public static function EducationByQfApi( $RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $metricGroupId = "114" ){  //$RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $metricGroupId = "118" 
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetCensusHouseholdApiDatas("formap", $locationId, $locationTypeId, $metricGroupId);
       

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($TempArr2); echo "</pre>";

		//echo json_encode($FinalArr);  
		
		//exit();

		$Datas = implode(",", $TempArr2) ; 
		$Datas2 = implode(",", $TempArr3) ; 
		$Categories = "'" . implode("','", $TempArr1) . "'"; 

		$FinalStr = "<script type='text/javascript'>
        
             var options = {
          series: [" . $Datas . "],
          chart: {
          width: 500,
          type: 'pie',
        },
        labels: [" . $Categories . "],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 300
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector('#EducationByQf'), options);
        chart.render();
        </script>
                ";
                
		//echo $FinalStr; 
		return $FinalStr; 
	}
	
	
		public static function EducationByOccpationApi( $RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $metricGroupId = "115" ){  //$RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $metricGroupId = "118" 
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetCensusHouseholdApiDatas("formap", $locationId, $locationTypeId, $metricGroupId);
       

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($TempArr2); echo "</pre>";

		//echo json_encode($FinalArr);  
		
		//exit();

		$Datas = implode(",", $TempArr2) ; 
		$Datas2 = implode(",", $TempArr3) ; 
		$Categories = "'" . implode("','", $TempArr1) . "'"; 

		$FinalStr = "<script type='text/javascript'>
        
             var options = {
          series: [" . $Datas . "],
          chart: {
          width: 500,
          type: 'pie',
        },
        labels: [" . $Categories . "],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 300
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector('#EducationByOccpation'), options);
        chart.render();
        </script>
                ";
                
		//echo $FinalStr; 
		return $FinalStr; 
	}
	
	
	public static function EducationByLevelApi( $RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $metricGroupId = "116" ){
		self::Init(); 

		$FinalStr		= "";
		
		//echo $locationId;

        //$TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,"8","6","2010-01-01","2020-02-20","78","12");
         $TempMedianData = self::GetCensusHouseholdApiDatas("formap", $locationId, $locationTypeId, $metricGroupId);
       
        
       

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		$TempArr4       = $TempMedianData["metricTypeShort"]; 
		
		
		
		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";

		//echo json_encode($FinalArr);  
		
//	exit();

		$Datas = implode(",", $TempArr2) ; 
		$Datas2 = implode(",", $TempArr3) ; 
		$Categories = "'" . implode("','", $TempArr1) . "'"; 
		
		$Categories1 = implode(",", $TempArr4) ; 

		$FinalStr = "<script>//
                  var colors9 = ['#685F25'];
                  var options = {
                  chart: {
                    toolbar:{
                      show:false
                    },
                    height: 380,
                    type: 'bar',
                    stacked: false
                  },
                  plotOptions: {
                    bar: {
                      horizontal: false,
                      columnWidth: '50px',
                      endingShape: 'flat',
                      colors: {
                          backgroundBarColors: ['#eee'],
                          backgroundBarOpacity: 1,
                      },
                    },
                  },
                  colors: colors9,
                  dataLabels: {
                    enabled: false
                  },
                  series: [
                    {
                      name: '" .$Subrub. "', 
                      type: 'column',
                      data: [" . $Datas . "]
                    }
                  ],
                  xaxis: {
                    categories: [" . $Categories . "]
                  },
                  yaxis: [
                    {
                      axisTicks: {
                        show: true
                      },
                      axisBorder: {
                        show: true,
                        color: '#3f51b5'
                      },
                      labels: {
                        formatter: function (value) {
                          return value + '%';
                        },
                        style: {
                          color: '#3f51b5'
                        }
                      }
                    },
                    {
                      axisTicks: {
                        show: false
                      },
                      axisBorder: {
                        show: false,
                        color: '#FFA600'
                      },
                      labels: {
                        show: false,
                        style: {
                          color: '#FFA600'
                        }
                      }
                    }
                  ],
                  tooltip: {
                    followCursor: true,
                    y: {
                      formatter: function(y) {
                        if (typeof y !== 'undefined') {
                          return y + ' %';
                        }
                        return y;
                      }
                    }
                  },
                  markers: {
                    size: 5,
                    hover: {
                      size: 9
                    }
                  }
                };
                
                var chart = new ApexCharts(document.querySelector('#EducationByLevel'), options);
                
                chart.render();
                
                </script>
                ";
				

		//echo $FinalStr; 
		return $FinalStr; 
	}

	
	//=====================================NewsFeed===================================================================================
	public static function GetNewsFeedApiDatas($country = "nz"){  
	    $PostData       = array("seriesRequestList" => array( "country"      => $locationId,
                                                      "apiKey"  => $apiKey
                                                      )
                 ); 

		$PostJsonData   = json_encode($PostData); 
		$PostJsonData   = str_replace(":{", ":[{", $PostJsonData);
		$PostJsonData   = str_replace("}}", "}]}", $PostJsonData);
       


		$url = "http://newsapi.org/v2/top-headlines?country=".$country."&apiKey=cb2c817045ea41a180709807a5b2929b"; 

		$data_json = $PostJsonData; 

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . self::$AuthToken, 'Content-Length: ' . strlen($data_json)));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response  = curl_exec($ch);
		curl_close($ch);


		$response_arr = json_decode($response); 
        $queryStr="delete from newsfeed where country=:country";

		$ColValarray = array("country"=> $country) ; 

		$Queryarray = array($queryStr,$ColValarray);
		$ArrQueries[]=$Queryarray;
		if ($response_arr->status=='ok'){
			$SeriesListArr  = $response_arr->articles;
			$i=1;
			foreach($SeriesListArr as $SeriesListArr1){
			    $date1=date_create($SeriesListArr1-> publishedAt);
			    $urlToImage=$SeriesListArr1-> urlToImage;
                $publishedAt= date_format($date1,"d-F-Y H:i:s");
                $publishedAt1= date_format($date1,"Y-m-d H:i:s");
                
                
                
                $queryStr="insert into newsfeed(country,publishedAt,title,description,content,author,url,urlToImage) values
				(:country,:publishedAt,:title,:description,:content,:author,:url,:urlToImage)";

				$ColValarray = array("country"=> $country, "publishedAt"=> $publishedAt1, "title" => $SeriesListArr1->title, "description" => $SeriesListArr1->description
				,"content"=>$SeriesListArr1->content ,"author"=>$SeriesListArr1->author ,"url"=>$SeriesListArr1->url ,"urlToImage"=>$urlToImage) ; 

				$Queryarray = array($queryStr,$ColValarray);
				
    			$ArrQueries[]=$Queryarray;
    			//echo $publishedAt1;
    			
    	
			$i=$i+1;     
			}
			$Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
			return $Msg;
		}
	}
	//=====================================NewsFeed===================================================================================
	//=====================================Currency===================================================================================
	public static function GetCurrExrateDatas($Currency = "EUR"){  
	    $PostData       = array("seriesRequestList" => array( "base"      => $locationId,
                                                      "apiKey"  => $apiKey
                                                      )
                 ); 
                 
     
		$PostJsonData   = json_encode($PostData); 
		$PostJsonData   = str_replace(":{", ":[{", $PostJsonData);
		$PostJsonData   = str_replace("}}", "}]}", $PostJsonData);
       


		$url = "http://data.fixer.io/api/latest?access_key=8ff9756492277bb2fb2ee63d022d57be&base=".$Currency; 
		
		//echo $url;

		$data_json = $PostJsonData; 

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . self::$AuthToken, 'Content-Length: ' . strlen($data_json)));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response  = curl_exec($ch);
		curl_close($ch);

		$response_arr = json_decode($response); 
		
		//echo "<pre>"; print_r($response_arr); "<.pre>";
        
		if ($response_arr->success=='true'){
		    $date  = date($response_arr->date);
			$rateListArr  = $response_arr->rates;
			
			$queryStr="delete from api_currency_exchange where updated_date=:updated_date";

    		$ColValarray = array("updated_date"=> $date) ; 
    
    		$Queryarray = array($queryStr,$ColValarray);
    		$ArrQueries[]=$Queryarray;
    		$Countryrows = \Masters\MastersClass::GetCountriesDatas('');
           $i = 1;
           foreach ($Countryrows as $Countryrow) 
           {
               $Currencies=$Countryrow["currency"];
                if($Currencies!=$Currency){
                 $queryStr="insert into api_currency_exchange(base_currency,currency,RATE,updated_date) values
        				(:base_currency,:currency,:RATE,:updated_date)";
        
        			$ColValarray = array("base_currency"=> $Currency, "currency"=> $Currencies,"RATE"=>$rateListArr->$Currencies, "updated_date" => $date) ; 
        
        			$Queryarray = array($queryStr,$ColValarray);
        			$ArrQueries[]=$Queryarray;
        			//echo $rateListArr->$Currencies;
               }
           }
			
			
			$Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
			echo $Msg;
			return $rateListArr;
		}
	}
	//=================================================Currency===================================================================================

	//===============================================Education By Level Uk===================================================================================
	
	
		public static function EducationByLevelApiUK($locationId,$datefilter1,$datefilter2,$formap = "graph"){
		self::Init(); 

		$FinalStr		= "";
		$AllArray       = array(); 
		$TempArr1       = array();
		$TempArr2       = array();

		
		$FromDate       = \api\apiClass::convertDate($datefilter1, "%Y-%m");
		$ToDate         = \api\apiClass::convertDate($datefilter2, "%Y-%m");
		
	    //	echo "FromDate=".$FromDate."<br>";
		//	echo "ToDate=".$ToDate."<br>" ;
		//	exit();

        
        $encodedAuth        = "TnpBd09qSTVZbVV6WW1aaFltSTNZMkkzTVRKaVl6a3dOMlU1TWpCak9EQmhaV1poOg==";
        $curl                = curl_init();
        $Url                = "https://api.realyse.com/v1/demographics/features";
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $Url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        //curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\"areaName\":\"London\",\"mode\":\"Postcode\" }" ); 
        curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\r\n  \"indicators\": [\r\n    490,491,492,493,494,495\r\n  ],\r\n  \"dateFrom\": \"{$FromDate}\",\r\n  \"dateTo\": \"{$ToDate}\",\r\n  \"areaIds\": [\r\n    \"{$locationId}\"\r\n  ]\r\n}" ); 
         
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Basic ". $encodedAuth , 'Content-Type: text/plain'));

        //curl_setopt($ch, CURLOPT_HTTPHEADER,     array("Authorization: Basic ". $encodedAuth, 'Content-Type: text/plain')); 
        
        $response   = curl_exec ($ch);
        $err        = curl_error($curl);
        
        curl_close($curl);
        
  
        if ($err) {
          $RetArr = array(); 
            
        } else {
            
 
          $RetDecode = json_decode($response); 
          
          //echo '<pre>'; print_r($RetDecode); echo '</pre>';
         // exit;
          
          $SuggestArr = array();
          
          $indicatorIdTemp  = "";
          $valueTemp        = "";
          
          $GCSEDorLessEquivalentTemp = "";
          $GCSEDorLessEquivalentTempTotal = "";
          $GCSEDorgrtrEquivalentTemp = "";
          $GCSEDorgrtrEquivalentTempTotal ="";
          $ALevelorEquivalentTemp = "";
          $ALevelorEquivalentTempTotal ="";
          $HigherEducationorEquivalentTemp = "";
          $HigherEducationorEquivalentTempTotal ="";
          $OtherQualificationsTemp ="";
          $OtherQualificationsTempTotal ="";
          $NoQualificationsTemp  ="";
          $NoQualificationsTempTotal ="";
          $dateToTemp = "";
          $indicatorId = "";
          $i = 1;
          foreach($RetDecode->data as $RetArr1)
          {
              
                $indicatorId    =  $RetArr1->indicatorId;
                $value          =  $RetArr1->feature->v;
                $dateTo         =  $RetArr1->dateTo;
                $dateTo         =  $RetArr1->dateTo;
                
                if ($indicatorId == "490"){
                    
                    if ( $dateToTemp == "" ){
                         $dateToTemp = $dateTo;
                         
                     }else{
                         $dateToTemp = $dateToTemp ."' , '". $dateTo;
                     }
                    
                }
                
                
                if ($indicatorId == "490"){
                    $indicatorName = "GCSE<DorEquivalent";
                    
                    if ( $GCSEDorLessEquivalentTemp == "" ){
                         $GCSEDorLessEquivalentTemp = $value;
                         $GCSEDorLessEquivalentTempTotal = $value;
                         
                     }else{
                         $GCSEDorLessEquivalentTemp         = $GCSEDorLessEquivalentTemp .",". $value;
                         $GCSEDorLessEquivalentTempTotal    = $GCSEDorLessEquivalentTempTotal + $value;
                     }
                    
                    
                }else if ($indicatorId == "491"){
                    
                    $indicatorName = "GCSE>DorEquivalent";
                    
                    if ( $GCSEDorgrtrEquivalentTemp == "" ){
                         $GCSEDorgrtrEquivalentTemp = $value;
                          $GCSEDorgrtrEquivalentTempTotal = $value;
                     }else{
                         $GCSEDorgrtrEquivalentTemp = $GCSEDorgrtrEquivalentTemp .",". $value;
                         $GCSEDorgrtrEquivalentTempTotal = $GCSEDorgrtrEquivalentTempTotal + $value;
                     }
                    
                    
                }else if ($indicatorId == "492"){
                    
                    $indicatorName = "ALevelorEquivalent";
                    
                    if ( $ALevelorEquivalentTemp == "" ){
                         $ALevelorEquivalentTemp = $value;
                         $ALevelorEquivalentTempTotal = $value;
                     }else{
                         $ALevelorEquivalentTemp = $ALevelorEquivalentTemp .",". $value;
                         $ALevelorEquivalentTempTotal = $ALevelorEquivalentTempTotal + $value;
                     }
                    
                    
                }else if ($indicatorId == "493"){
                    $indicatorName = "HigherEducationorEquivalent"; 
                    
                    if ( $HigherEducationorEquivalentTemp == "" ){
                         $HigherEducationorEquivalentTemp = $value;
                         $HigherEducationorEquivalentTempTotal = $value;
                     }else{
                         $HigherEducationorEquivalentTemp = $HigherEducationorEquivalentTemp .",". $value;
                         $HigherEducationorEquivalentTempTotal = $HigherEducationorEquivalentTempTotal + $value;
                     }
                }else if ($indicatorId == "494"){
                    $indicatorName = "NoQualifications"; 
                  
                    
                    if ( $NoQualificationsTemp == "" ){
                         $NoQualificationsTemp = $value;
                         $NoQualificationsTempTotal = $value;
                         
                     }else{
                         $NoQualificationsTemp = $NoQualificationsTemp .",". $value;
                         $NoQualificationsTempTotal = $NoQualificationsTempTotal + $value;
                     }
                    
                }else if ($indicatorId == "495"){
                    $indicatorName = "OtherQualifications"; 
                    
                    if ( $OtherQualificationsTemp == "" ){
                         $OtherQualificationsTemp = $value;
                         $OtherQualificationsTempTotal = $value;
                     }else{
                         $OtherQualificationsTemp = $OtherQualificationsTemp .",". $value;
                         $OtherQualificationsTempTotal = $OtherQualificationsTempTotal + $value;
                     }
                }
                
              
                 
                $preindicatorId =  $indicatorId;
                
                $i++;
    
         }
   
            //echo "hii" .$indicatorIdTemp;
           // exit();
          // $FinalArr       = array("indicatorId" =>  $TempArr1, "value" => $TempArr2);  
          
        }    
        
     
        
        if($formap == "Tbl"){
            
            $DateCount = $i - 1;
        
            $AllArray[] = array("GCSEDorLessEquivalentTempTotal" => $GCSEDorLessEquivalentTempTotal,
                                "GCSEDorgrtrEquivalentTempTotal" => $GCSEDorgrtrEquivalentTempTotal,
                                "ALevelorEquivalentTempTotal" => $ALevelorEquivalentTempTotal,
                                "HigherEducationorEquivalentTempTotal" => $HigherEducationorEquivalentTempTotal,
                                "NoQualificationsTempTotal" => $NoQualificationsTempTotal,
                                "OtherQualificationsTempTotal" => $OtherQualificationsTempTotal,
                                "DateCount" => $DateCount
                                ); 
            return $AllArray;
            
        }
        
        

		$Categories = "'" .$dateToTemp. "'"; 
	  

		
	//	echo 'Categories='. $Categories .'<br>';
	
		
	
        $indicatorIdTemp = "'" . $indicatorIdTemp . "'"; 
		$FinalStr = "<script>//
                    var options = {
                          series: [{
                          name: 'GCSE < D or Equivalent',
                          data: [".$GCSEDorLessEquivalentTemp."]
                        }, {
                          name: 'GCSE > D or Equivalent',
                          data: [".$GCSEDorgrtrEquivalentTemp."]
                        }, {
                          name: 'A Level or Equivalent',
                          data: [".$ALevelorEquivalentTemp."]
                        }, {
                          name: 'Higher Educationor Equivalent',
                          data: [".$HigherEducationorEquivalentTemp."]
                        }, {
                          name: 'No Qualifications',
                          data: [".$OtherQualificationsTemp."]
                        }, {
                          name: 'Other Qualifications',
                          data: [".$NoQualificationsTemp."]
                        }],
                          chart: {
                          type: 'bar',
                          height: 350,
                          stacked: true,
                          toolbar: {
                            show: true
                          },
                          zoom: {
                            enabled: true
                          }
                        },
                        responsive: [{
                          breakpoint: 480,
                          options: {
                            legend: {
                              position: 'bottom',
                              offsetX: -10,
                              offsetY: 0
                            }
                          }
                        }],
                        plotOptions: {
                          bar: {
                            horizontal: false,
                          },
                        },
                        yaxis: [
                        {
                          axisTicks: {
                            show: true
                          },
                          axisBorder: {
                            show: true,
                            color: '#3f51b5'
                          },
                          labels: {
                            formatter: function (value) {
                              return value + '%';
                            },
                            style: {
                              color: '#3f51b5'
                            }
                          }
                        }],
                        xaxis: {
                          type: 'datetime',
                          categories: ['". $dateToTemp ."'],
                        },
                         tooltip: {
                            followCursor: true,
                            y: {
                              formatter: function(y) {
                                if (typeof y !== 'undefined') {
                                  return y + ' %';
                                }
                                return y;
                              }
                            }
                          },
                        legend: {
                          position: 'right',
                          offsetY: 40
                        },
                        fill: {
                          opacity: 1
                        }
                        };
                
                        var chart = new ApexCharts(document.querySelector('#EducationByLevel'), options);
                        chart.render();
                
                </script>
                ";
				

		//echo $FinalStr; 
		return $FinalStr; 
	}

    //===============================================Education By Level Uk===================================================================================
    
    //=============================================== Mortgage Affordability Start ================================================================================

        public static function MortgageAffordabilityUK($locationId,$datefilter1,$datefilter2,$GraphDtl ="")
        {
        	
        	    if($GraphDtl == "MortgageAffordability"){
        	        
        	         $GraphDtlId = "526,527,528,529,530,531,532,533,534,535,536,537,538,539,540,541,542,543,544";
        	         $DateId = "526";
        	         
        	    }elseif($GraphDtl == "IncomeAge")
        	    {
        	        
        	        $GraphDtlId = "437,438,439,440,441,442,443,444,445,446,447,448,449";
        	        $DateId = "437";
        	    }
        	
        	 
        		self::Init(); 
        
        		$FinalStr		= "";
        		$AllArray       = array(); 
        		$TempArr1       = array();
        		$TempArr2       = array();
        		
        		$FromDate       = \api\apiClass::convertDate($datefilter1, "%Y-%m");
        		$ToDate         = \api\apiClass::convertDate($datefilter2, "%Y-%m");

                
                $encodedAuth        = "TnpBd09qSTVZbVV6WW1aaFltSTNZMkkzTVRKaVl6a3dOMlU1TWpCak9EQmhaV1poOg==";
                $curl                = curl_init();
                $Url                = "https://api.realyse.com/v1/demographics/features";
                
                $ch = curl_init();
        
                curl_setopt($ch, CURLOPT_URL,            $Url );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt($ch, CURLOPT_POST,           1 );
                //curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\"areaName\":\"London\",\"mode\":\"Postcode\" }" ); 
                curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\r\n  \"indicators\": [\r\n ".$GraphDtlId."\r\n  ],\r\n  \"dateFrom\": \"{$FromDate}\",\r\n  \"dateTo\": \"{$ToDate}\",\r\n  \"areaIds\": [\r\n    \"{$locationId}\"\r\n  ]\r\n}" ); 
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Basic ". $encodedAuth , 'Content-Type: text/plain'));
                //curl_setopt($ch, CURLOPT_HTTPHEADER,     array("Authorization: Basic ". $encodedAuth, 'Content-Type: text/plain')); 
                
                $response   = curl_exec ($ch);
                $err        = curl_error($curl);
                
                curl_close($curl);
                
          
                if ($err) {
                  $RetArr = array(); 
                    
                } else {
                    
         
                  $RetDecode = json_decode($response); 
                  
                  //echo '<pre>'; print_r($RetDecode); echo '</pre>';
                 // exit;
                  
                  $SuggestArr = array();
                  
                  $indicatorIdTemp  = "";
                  $valueTemp        = "";
                  
                  $MortgageAffordability1Bed1EarnerTemp = "";
                  $MortgageAffordability1Bed2EarnerTemp = "";
                  $MortgageAffordability2Bed1EarnerTemp = "";
                  $MortgageAffordability2Bed2EarnerTemp = "";
                  $MortgageAffordability2Bed3EarnerTemp = "";
                  $MortgageAffordability2Bed4EarnerTemp = "";
                  $MortgageAffordability3Bed1EarnerTemp = "";
                  $MortgageAffordability3Bed2EarnerTemp = "";
                  $MortgageAffordability3Bed4EarnerTemp = "";
                  $MortgageAffordability3Bed4EarnerTemp = "";
                  $MortgageAffordability3Bed5EarnerTemp = "";
                  $MortgageAffordability4Bed2EarnerTemp = "";
                  $MortgageAffordability4Bed3EarnerTemp = "";
                  $MortgageAffordability4Bed4EarnerTemp = "";
                  $MortgageAffordability4Bed5EarnerTemp = "";
                  $MortgageAffordability5Bed2EarnerTemp = "";
                  $MortgageAffordability5Bed3EarnerTemp = "";
                  $MortgageAffordability5Bed4EarnerTemp = "";
                  $MortgageAffordability5Bed5EarnerTemp = "";
                  
                  $IncomeAgeLess20Temp 	= "";
                  $IncomeAgeBet2024Temp	= "";
                  $IncomeAgeBet2529Temp	= "";
                  $IncomeAgeBet3034Temp	= "";
                  $IncomeAgeBet3539Temp	= "";
                  $IncomeAgeBet4044Temp	= "";
                  $IncomeAgeBet4549Temp	= "";
                  $IncomeAgeBet5054Temp	= "";
                  $IncomeAgeBet5559Temp	= "";
                  $IncomeAgeBet6064Temp	= "";
                  $IncomeAgeBet6569Temp	= "";
                  $IncomeAgeBet7074Temp	= "";
                  $IncomeAgeGreater75Temp	= "";
                  
                  
                  $OtherQualificationsTemp ="";
                  $NoQualificationsTemp  ="";
                  $dateToTemp = "";
                  $indicatorId = "";
                  
                  foreach($RetDecode->data as $RetArr1)
                  {
                      
                        $indicatorId    =  $RetArr1->indicatorId;
                        $value          =  $RetArr1->feature->v;
                        $dateTo         =  $RetArr1->dateTo;
                        $dateTo         =  $RetArr1->dateTo;
                        
                        if ($indicatorId == $DateId){
                            
                            if ( $dateToTemp == "" ){
                                 $dateToTemp = $dateTo;
                                 
                             }else{
                                 $dateToTemp = $dateToTemp ."' , '". $dateTo;
                             }
                            
                        }
                        
                        //526,527,528,529,530,531,532,533,534,535,536,537,538,539,540,541,542,543,544
                        
                        
                        
                        if($GraphDtl == "MortgageAffordability")
                        {
                        
                            if ($indicatorId == "526"){
                                $indicatorName = "MortgageAffordability1Bed1Earner";
                                
                                if ( $MortgageAffordability1Bed1EarnerTemp == "" ){
                                     $MortgageAffordability1Bed1EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability1Bed1EarnerTemp = $MortgageAffordability1Bed1EarnerTemp .",". $value;
                                 }
                                
                                
                            }else if ($indicatorId == "527"){
                                
                                $indicatorName = "MortgageAffordability1Bed2Earner";
                                
                                if ( $MortgageAffordability1Bed2EarnerTemp == "" ){
                                     $MortgageAffordability1Bed2EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability1Bed2EarnerTemp = $MortgageAffordability1Bed2EarnerTemp .",". $value;
                                 }
                                
                                
                            }else if ($indicatorId == "528"){
                                
                                $indicatorName = "MortgageAffordability2Bed1Earner";
                                
                                if ( $MortgageAffordability2Bed1EarnerTemp == "" ){
                                     $MortgageAffordability2Bed1EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability2Bed1EarnerTemp = $MortgageAffordability2Bed1EarnerTemp .",". $value;
                                 }
                                
                                
                            }else if ($indicatorId == "529"){
                                $indicatorName = "MortgageAffordability2Bed2Earner"; 
                                
                                if ( $MortgageAffordability2Bed2EarnerTemp == "" ){
                                     $MortgageAffordability2Bed2EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability2Bed2EarnerTemp = $MortgageAffordability2Bed2EarnerTemp .",". $value;
                                 }
                                 
                            }else if ($indicatorId == "530"){
                                $indicatorName = "MortgageAffordability2Bed3Earner"; 
                              
                                
                                if ( $MortgageAffordability2Bed3EarnerTemp == "" ){
                                     $MortgageAffordability2Bed3EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability2Bed3EarnerTemp = $MortgageAffordability2Bed3EarnerTemp .",". $value;
                                 }
                                
                            }else if ($indicatorId == "531"){
                                $indicatorName = "MortgageAffordability2Bed4Earner"; 
                                
                                if ( $MortgageAffordability2Bed4EarnerTemp == "" ){
                                     $MortgageAffordability2Bed4EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability2Bed4EarnerTemp = $MortgageAffordability2Bed4EarnerTemp .",". $value;
                                 }
                            }else if ($indicatorId == "532"){
                                $indicatorName = "MortgageAffordability3Bed1Earner"; 
                                
                                if ( $MortgageAffordability3Bed1EarnerTemp == "" ){
                                     $MortgageAffordability3Bed1EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability3Bed1EarnerTemp = $MortgageAffordability3Bed1EarnerTemp .",". $value;
                                 }
                            }else if ($indicatorId == "533"){
                                $indicatorName = "MortgageAffordability3Bed2Earner"; 
                                
                                if ( $MortgageAffordability3Bed2EarnerTemp == "" ){
                                     $MortgageAffordability3Bed2EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability3Bed2EarnerTemp = $MortgageAffordability3Bed2EarnerTemp .",". $value;
                                 }
                            }else if ($indicatorId == "534"){
                                $indicatorName = "MortgageAffordability3Bed3Earner"; 
                                
                                if ( $MortgageAffordability3Bed3EarnerTemp == "" ){
                                     $MortgageAffordability3Bed3EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability3Bed3EarnerTemp = $MortgageAffordability3Bed3EarnerTemp .",". $value;
                                 }
                            }else if ($indicatorId == "535"){
                                $indicatorName = "MortgageAffordability3Bed4Earner"; 
                                
                                if ( $MortgageAffordability3Bed4EarnerTemp == "" ){
                                     $MortgageAffordability3Bed4EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability3Bed4EarnerTemp = $MortgageAffordability3Bed4EarnerTemp .",". $value;
                                 }
                            }else if ($indicatorId == "536"){
                                $indicatorName = "MortgageAffordability3Bed5Earner"; 
                                
                                if ( $MortgageAffordability3Bed5EarnerTemp == "" ){
                                     $MortgageAffordability3Bed5EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability3Bed5EarnerTemp = $MortgageAffordability3Bed5EarnerTemp .",". $value;
                                 }
                            }else if ($indicatorId == "537"){
                                $indicatorName = "MortgageAffordability4Bed2Earner"; 
                                
                                if ( $MortgageAffordability4Bed2EarnerTemp == "" ){
                                     $MortgageAffordability4Bed2EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability4Bed2EarnerTemp = $MortgageAffordability4Bed2EarnerTemp .",". $value;
                                 }
                            }else if ($indicatorId == "538"){
                                $indicatorName = "MortgageAffordability4Bed3Earner"; 
                                
                                if ( $MortgageAffordability4Bed3EarnerTemp == "" ){
                                     $MortgageAffordability4Bed3EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability4Bed3EarnerTemp = $MortgageAffordability4Bed3EarnerTemp .",". $value;
                                 }
                            }else if ($indicatorId == "539"){
                                $indicatorName = "MortgageAffordability4Bed4Earner"; 
                                
                                if ( $MortgageAffordability4Bed4EarnerTemp == "" ){
                                     $MortgageAffordability4Bed4EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability4Bed4EarnerTemp = $MortgageAffordability4Bed4EarnerTemp .",". $value;
                                 }
                            }else if ($indicatorId == "540"){
                                $indicatorName = "MortgageAffordability4Bed5Earner"; 
                                
                                if ( $MortgageAffordability4Bed5EarnerTemp == "" ){
                                     $MortgageAffordability4Bed5EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability4Bed5EarnerTemp = $MortgageAffordability4Bed5EarnerTemp .",". $value;
                                 }
                            }else if ($indicatorId == "541"){
                                $indicatorName = "MortgageAffordability5Bed2Earner"; 
                                
                                if ( $MortgageAffordability5Bed2EarnerTemp == "" ){
                                     $MortgageAffordability5Bed2EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability5Bed2EarnerTemp = $MortgageAffordability5Bed2EarnerTemp .",". $value;
                                 }
                            }else if ($indicatorId == "542"){
                                $indicatorName = "MortgageAffordability5Bed3Earner"; 
                                
                                if ( $MortgageAffordability5Bed3EarnerTemp == "" ){
                                     $MortgageAffordability5Bed3EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability5Bed3EarnerTemp = $MortgageAffordability5Bed3EarnerTemp .",". $value;
                                 }
                            }else if ($indicatorId == "543"){
                                $indicatorName = "MortgageAffordability5Bed4Earner"; 
                                
                                if ( $MortgageAffordability5Bed4EarnerTemp == "" ){
                                     $MortgageAffordability5Bed4EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability5Bed4EarnerTemp = $MortgageAffordability5Bed4EarnerTemp .",". $value;
                                 }
                            }else if ($indicatorId == "544"){
                                $indicatorName = "MortgageAffordability5Bed5Earner"; 
                                
                                if ( $MortgageAffordability5Bed5EarnerTemp == "" ){
                                     $MortgageAffordability5Bed5EarnerTemp = $value;
                                     
                                 }else{
                                     $MortgageAffordability5Bed5EarnerTemp = $MortgageAffordability5Bed5EarnerTemp .",". $value;
                                 }
                            }
                        
                        }
                        
                        //437,438,439,440,441,442,443,444,445,446,447,448,449
                        
                        if($GraphDtl == "IncomeAge")
                        {
                        
                            if ($indicatorId == "437"){
                                $indicatorName = "IncomeAge<20";
                                
                                if ( $IncomeAgeLess20Temp == "" ){
                                     $IncomeAgeLess20Temp = $value;
                                     
                                 }else{
                                     $IncomeAgeLess20Temp = $IncomeAgeLess20Temp .",". $value;
                                 }
                                
                                
                            }else if ($indicatorId == "438"){
                                
                                $indicatorName = "IncomeAgeBet2024";
                                
                                if ( $IncomeAgeBet2024Temp == "" ){
                                     $IncomeAgeBet2024Temp = $value;
                                     
                                 }else{
                                     $IncomeAgeBet2024Temp = $IncomeAgeBet2024Temp .",". $value;
                                 }
                                
                                
                            }else if ($indicatorId == "439"){
                                
                                $indicatorName = "IncomeAgeBet2529";
                                
                                if ( $IncomeAgeBet2529Temp == "" ){
                                     $IncomeAgeBet2529Temp = $value;
                                     
                                 }else{
                                     $IncomeAgeBet2529Temp = $IncomeAgeBet2529Temp .",". $value;
                                 }
                                
                                
                            }else if ($indicatorId == "440"){
                                $indicatorName = "IncomeAgeBet3034"; 
                                
                                if ( $IncomeAgeBet3034Temp == "" ){
                                     $IncomeAgeBet3034Temp = $value;
                                     
                                 }else{
                                     $IncomeAgeBet3034Temp = $IncomeAgeBet3034Temp .",". $value;
                                 }
                                 
                            }else if ($indicatorId == "441"){
                                $indicatorName = "IncomeAgeBet3539"; 
                              
                                
                                if ( $IncomeAgeBet3539Temp == "" ){
                                     $IncomeAgeBet3539Temp = $value;
                                     
                                 }else{
                                     $IncomeAgeBet3539Temp = $IncomeAgeBet3539Temp .",". $value;
                                 }
                                
                            }else if ($indicatorId == "442"){
                                $indicatorName = "IncomeAgeBet4044"; 
                                
                                if ( $IncomeAgeBet4044Temp == "" ){
                                     $IncomeAgeBet4044Temp = $value;
                                     
                                 }else{
                                     $IncomeAgeBet4044Temp = $IncomeAgeBet4044Temp .",". $value;
                                 }
                            }else if ($indicatorId == "443"){
                                $indicatorName = "IncomeAgeBet4549"; 
                                
                                if ( $IncomeAgeBet4549Temp == "" ){
                                     $IncomeAgeBet4549Temp = $value;
                                     
                                 }else{
                                     $IncomeAgeBet4549Temp = $IncomeAgeBet4549Temp .",". $value;
                                 }
                            }else if ($indicatorId == "444"){
                                $indicatorName = "IncomeAgeBet5054"; 
                                
                                if ( $IncomeAgeBet5054Temp == "" ){
                                     $IncomeAgeBet5054Temp = $value;
                                     
                                 }else{
                                     $IncomeAgeBet5054Temp = $IncomeAgeBet5054Temp .",". $value;
                                 }
                            }else if ($indicatorId == "445"){
                                $indicatorName = "IncomeAgeBet5559"; 
                                
                                if ( $IncomeAgeBet5559Temp == "" ){
                                     $IncomeAgeBet5559Temp = $value;
                                     
                                 }else{
                                     $IncomeAgeBet5559Temp = $IncomeAgeBet5559Temp .",". $value;
                                 }
                            }else if ($indicatorId == "446"){
                                $indicatorName = "IncomeAgeBet6064"; 
                                
                                if ( $IncomeAgeBet6064Temp == "" ){
                                     $IncomeAgeBet6064Temp = $value;
                                     
                                 }else{
                                     $IncomeAgeBet6064Temp = $IncomeAgeBet6064Temp .",". $value;
                                 }
                            }else if ($indicatorId == "447"){
                                $indicatorName = "IncomeAgeBet6569"; 
                                
                                if ( $IncomeAgeBet6569Temp == "" ){
                                     $IncomeAgeBet6569Temp = $value;
                                     
                                 }else{
                                     $IncomeAgeBet6569Temp = $IncomeAgeBet6569Temp .",". $value;
                                 }
                            }else if ($indicatorId == "448"){
                                $indicatorName = "IncomeAgeBet7074"; 
                                
                                if ( $IncomeAgeBet7074Temp == "" ){
                                     $IncomeAgeBet7074Temp = $value;
                                     
                                 }else{
                                     $IncomeAgeBet7074Temp = $IncomeAgeBet7074Temp .",". $value;
                                 }
                            }else if ($indicatorId == "449"){
                                $indicatorName = "IncomeAgeGreater75"; 
                                
                                if ( $IncomeAgeGreater75Temp == "" ){
                                     $IncomeAgeGreater75Temp = $value;
                                     
                                 }else{
                                     $IncomeAgeGreater75Temp = $IncomeAgeGreater75Temp .",". $value;
                                 }
                            }
                        
                        }
                         
                        $preindicatorId =  $indicatorId;
            
                 }
                    //echo "hii" .$indicatorIdTemp;
                   // exit();
                  // $FinalArr       = array("indicatorId" =>  $TempArr1, "value" => $TempArr2);  
                  
                }    
                
               /* 
                $GraphDtlIdNew =  explode(",",$GraphDtlId);
                
                $GraphArrayTemp = "[";
                foreach($GraphDtlIdNew as $GraphSrc){
                    
                    
                    if($GraphArrayTemp == "["){
                        
                        $GraphArrayTemp = "{ name: '1 Bed 1 Earner', data: [".$MortgageAffordability1Bed1EarnerTemp."] },";
                        
                    }else{
                        
                        
                    }
                    
                }
                */
                
                
                
        		//$Categories = "'" .$dateToTemp. "'"; 
                //$indicatorIdTemp = "'" . $indicatorIdTemp . "'"; 
                
             
                if($GraphDtl == "MortgageAffordability")
                {
            		$FinalStr = "<script>//
                                var options = {
                                      series: [{
                                      name: '1 Bed 1 Earner',
                                      data: [".$MortgageAffordability1Bed1EarnerTemp."]
                                    }, {
                                      name: '1 Bed 2 Earners',
                                      data: [".$MortgageAffordability1Bed2EarnerTemp."]
                                    }, {
                                      name: '2 Bed 1 Earners',
                                      data: [".$MortgageAffordability2Bed1EarnerTemp."]
                                    }, {
                                      name: '2 Bed 2 Earners',
                                      data: [".$MortgageAffordability2Bed2EarnerTemp."]
                                    }, {
                                      name: '2 Bed 3 Earners',
                                      data: [".$MortgageAffordability2Bed3EarnerTemp."]
                                    }, {
                                      name: '2 Bed 4 Earners',
                                      data: [".$MortgageAffordability2Bed4EarnerTemp."]
                                    }, {
                                      name: '3 Bed 1 Earners',
                                      data: [".$MortgageAffordability3Bed1EarnerTemp."]
                                    }, {
                                      name: '3 Bed 2 Earners',
                                      data: [".$MortgageAffordability3Bed2EarnerTemp."]
                                    }, {
                                      name: '3 Bed 3 Earners',
                                      data: [".$MortgageAffordability3Bed3EarnerTemp."]
                                    }, {
                                      name: '3 Bed 4 Earners',
                                      data: [".$MortgageAffordability3Bed4EarnerTemp."]
                                    }, {
                                      name: '3 Bed 5 Earners',
                                      data: [".$MortgageAffordability3Bed5EarnerTemp."]
                                    }, {
                                      name: '4 Bed 2 Earners',
                                      data: [".$MortgageAffordability4Bed2EarnerTemp."]
                                    }, {
                                      name: '4 Bed 3 Earners',
                                      data: [".$MortgageAffordability4Bed3EarnerTemp."]
                                    }, {
                                      name: '4 Bed 4 Earners',
                                      data: [".$MortgageAffordability4Bed4EarnerTemp."]
                                    }, {
                                      name: '4 Bed 5 Earners',
                                      data: [".$MortgageAffordability4Bed5EarnerTemp."]
                                    }, {
                                      name: '5 Bed 2 Earners',
                                      data: [".$MortgageAffordability5Bed2EarnerTemp."]
                                    }, {
                                      name: '5 Bed 3 Earners',
                                      data: [".$MortgageAffordability5Bed3EarnerTemp."]
                                    }, {
                                      name: '5 Bed 4 Earners',
                                      data: [".$MortgageAffordability5Bed4EarnerTemp."]
                                    }, {
                                      name: '5 Bed 5 Earners',
                                      data: [".$MortgageAffordability5Bed5EarnerTemp."]
                                    }
                                    ],
                                      chart: {
                                      type: 'bar',
                                      height: 350,
                                      stacked: true,
                                      toolbar: {
                                        show: true
                                      },
                                      zoom: {
                                        enabled: true
                                      }
                                    },
                                    responsive: [{
                                      breakpoint: 480,
                                      options: {
                                        legend: {
                                          position: 'bottom',
                                          offsetX: -10,
                                          offsetY: 0
                                        }
                                      }
                                    }],
                                    plotOptions: {
                                      bar: {
                                        horizontal: false,
                                      },
                                    },
                                    yaxis: [
                                    {
                                      axisTicks: {
                                        show: true
                                      },
                                      axisBorder: {
                                        show: true,
                                        color: '#3f51b5'
                                      },
                                      labels: {
                                        formatter: function (value) {
                                          return value + '%';
                                        },
                                        style: {
                                          color: '#3f51b5'
                                        }
                                      }
                                    }],
                                    xaxis: {
                                      type: 'datetime',
                                      categories: ['". $dateToTemp ."'],
                                    },
                                     tooltip: {
                                        followCursor: true,
                                        y: {
                                          formatter: function(y) {
                                            if (typeof y !== 'undefined') {
                                              return y + ' %';
                                            }
                                            return y;
                                          }
                                        }
                                      },
                                    legend: {
                                      position: 'right',
                                      offsetY: 40
                                    },
                                    fill: {
                                      opacity: 1
                                    }
                                    };
                            
                                    var chart = new ApexCharts(document.querySelector('#MortgageAffordability'), options);
                                    chart.render();
                            
                            </script>
                            ";
                }else{
                    
                      // echo $IncomeAgeGreater75Temp;
                //exit;
                
                    
                    $FinalStr = "<script>//
                                var options = {
                                      series: [{
                                      name: 'Income Age < 20',
                                      data: [".$IncomeAgeLess20Temp."]
                                    }, {
                                      name: 'Income Age 20-24',
                                      data: [".$IncomeAgeBet2024Temp."]
                                    }, {
                                      name: 'Income Age 25-29',
                                      data: [".$IncomeAgeBet2529Temp."]
                                    }, {
                                      name: 'Income Age 30-34',
                                      data: [".$IncomeAgeBet3034Temp."]
                                    }, {
                                      name: 'Income Age 35-39',
                                      data: [".$IncomeAgeBet3539Temp."]
                                    }, {
                                      name: 'Income Age 40-44',
                                      data: [".$IncomeAgeBet4044Temp."]
                                    }, {
                                      name: 'Income Age 45-49',
                                      data: [".$IncomeAgeBet4549Temp."]
                                    }, {
                                      name: 'Income Age 50-54',
                                      data: [".$IncomeAgeBet5054Temp."]
                                    }, {
                                      name: 'Income Age 55-59',
                                      data: [".$IncomeAgeBet5559Temp."]
                                    }, {
                                      name: 'Income Age 60-64',
                                      data: [".$IncomeAgeBet6064Temp."]
                                    }, {
                                      name: 'Income Age 65-69',
                                      data: [".$IncomeAgeBet6569Temp."]
                                    }, {
                                      name: 'Income Age 70-74',
                                      data: [".$IncomeAgeBet7074Temp."]
                                    }, {
                                      name: 'Income Age 75 +',
                                      data: [".$IncomeAgeGreater75Temp."]
                                    }
                                    ],
                                      chart: {
                                      type: 'bar',
                                      height: 350,
                                      stacked: true,
                                      toolbar: {
                                        show: true
                                      },
                                      zoom: {
                                        enabled: true
                                      }
                                    },
                                    responsive: [{
                                      breakpoint: 480,
                                      options: {
                                        legend: {
                                          position: 'bottom',
                                          offsetX: -10,
                                          offsetY: 0
                                        }
                                      }
                                    }],
                                    plotOptions: {
                                      bar: {
                                        horizontal: false,
                                      },
                                    },
                                    yaxis: [
                                    {
                                      axisTicks: {
                                        show: true
                                      },
                                      axisBorder: {
                                        show: true,
                                        color: '#3f51b5'
                                      },
                                      labels: {
                                        formatter: function (value) {
                                          return '£'+ value ;
                                        },
                                        style: {
                                          color: '#3f51b5'
                                        }
                                      }
                                    }],
                                    xaxis: {
                                      type: 'datetime',
                                      categories: ['". $dateToTemp ."'],
                                    },
                                     tooltip: {
                                        followCursor: true,
                                        y: {
                                          formatter: function(y) {
                                            if (typeof y !== 'undefined') {
                                              return '£'+ y ;
                                            }
                                            return y;
                                          }
                                        }
                                      },
                                    legend: {
                                      position: 'right',
                                      offsetY: 40
                                    },
                                    fill: {
                                      opacity: 1
                                    }
                                    };
                            
                                    var chart = new ApexCharts(document.querySelector('#IncomeAge'), options);
                                    chart.render();
                            
                            </script>
                            ";
                    
                }
        				
        
        		//echo $FinalStr; 
        		return $FinalStr; 
        	}

    
    //=============================================== Mortgage Affordability End ================================================================================
    
    public static function PeopleAndPopulationApiClass($locationId,$datefilter1,$datefilter2){
		self::Init(); 

		$FinalStr		= "";
		$AllArray       = array(); 
		$TempArr1       = array();
		$TempArr2       = array();
		
	/*	
		//echo "datefilter=".$datefilter ."<br>";
		$FromYearDate      = substr("{$datefilter}",0,-13);
	    //	echo "FromYearDate=".$FromYearDate."<br>";
		$ToYearDate       = substr("{$datefilter}",13);
		//echo "ToYearDate=".$ToYearDate."<br>";
		$FromYear       = substr("{$FromYearDate}",6);
			//echo "FromYear=".$FromYear."<br>";
        $FromMonth      = substr("{$FromYearDate}",0,-8);
        //echo "FromMonth=".$FromMonth."<br>";
        $ToYear         = substr("{$ToYearDate}",6);
        //echo "ToYear=".$ToYear."<br>";
        $ToMonth        = substr("{$ToYearDate}",0,-8);
        //	echo "ToMonth=".$ToMonth."<br>";
        
    */
        
        $FromDate       = \api\apiClass::convertDate($datefilter1, "%Y-%m");
		$ToDate         = \api\apiClass::convertDate($datefilter2, "%Y-%m");
		
	//	echo "FromDate=".$FromDate."<br>";
		//	echo "ToDate=".$ToDate."<br>" ;
			
		//	exit();

		

        
        $encodedAuth        = "TnpBd09qSTVZbVV6WW1aaFltSTNZMkkzTVRKaVl6a3dOMlU1TWpCak9EQmhaV1poOg==";
        $encodedAuth        = "TnpBd09qSTVZbVV6WW1aaFltSTNZMkkzTVRKaVl6a3dOMlU1TWpCak9EQmhaV1poOg==";
        $curl                = curl_init();
        $Url                = "https://api.realyse.com/v1/demographics/features";
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $Url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        //curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\"areaName\":\"London\",\"mode\":\"Postcode\" }" ); 
        curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\r\n  \"indicators\": [\r\n    420,157,493,474,475,476,477,478,479,480,481,482,483,484,485,486,487,488\r\n  ],\r\n  \"dateFrom\": \"{$FromDate}\",\r\n  \"dateTo\": \"{$ToDate}\",\r\n  \"areaIds\": [\r\n    \"{$locationId}\"\r\n  ]\r\n}" ); 
         
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Basic ". $encodedAuth , 'Content-Type: text/plain'));

        //curl_setopt($ch, CURLOPT_HTTPHEADER,     array("Authorization: Basic ". $encodedAuth, 'Content-Type: text/plain')); 
        
        $response   = curl_exec ($ch);
        $err        = curl_error($curl);
        
        curl_close($curl);
        
  
        if ($err) {
          $RetArr = array(); 
            
        } else {
            
       // echo $response;
       // exit();
          $RetDecode = json_decode($response); 
          
          $SuggestArr = array();
          
          $indicatorIdTemp  = "";
          $valueTemp        = "";
          
          
          
          foreach($RetDecode->data as $RetArr1){
              
                  $indicatorId             =  $RetArr1->indicatorId;
                  //$TempArr1["{$indicatorId}"]  =  $indicatorId;

                  $Value      =  $RetArr1->feature->v;
                  //$TempArr1["{$indicatorId}_Val"]  =  $Value;
                
       
                 $AllArray[] = array("{$indicatorId}" => $indicatorId, "{$indicatorId}_Val" => $Value); 
          }
          
          
        }
  
		return $AllArray; 
	}
	
	
	//===============================================Product Feature Api Uk===================================================================================
    
    public static function ProductFeatureApiUkDecimal($RetType,$LocationId,$datasource,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$Cnt,$dcml="2"){
		self::Init(); 


		$FinalStr		= "";
		$AllArray       = array(); 
		$TempArr1       = array();
		$TempArr2       = array();
		
			/*
		echo 'RetType='. $RetType .'<br>';
	    echo 'datasource='. $datasource .'<br>' ;
		echo 'LocationId='. $LocationId .'<br>';	
		echo 'BuildType='. $BuildType .'<br>';
		echo  'bedrooms='. $bedrooms .'<br>' ;
		echo 'propertyType='. $propertyType .'<br>';
		echo 'datefilter1='. $datefilter1 .'<br>' ;
		echo 'datefilter2='. $datefilter2 .'<br>' ;
		echo 'Cnt='. $Cnt .'<br>';
		
	
		
	    //echo "datefilter=".$datefilter ."<br>";
		$FromYearDate      = substr("{$datefilter}",0,-13);
	    //	echo "FromYearDate=".$FromYearDate."<br>";
		
		$ToYearDate       = substr("{$datefilter}",13);
		//echo "ToYearDate=".$ToYearDate."<br>";
		
		$FromYear       = substr("{$FromYearDate}",6);
		
			//echo "FromYear=".$FromYear."<br>";
        $FromMonth      = substr("{$FromYearDate}",0,-8);
        
        	//echo "FromMonth=".$FromMonth."<br>";
        	
        	
        $ToYear         = substr("{$ToYearDate}",6);
        
        	//echo "ToYear=".$ToYear."<br>";
        $ToMonth        = substr("{$ToYearDate}",0,-8);
        
        //	echo "ToMonth=".$ToMonth."<br>";
        
        $FromDate       = $FromYear ."-". $FromMonth;
		$ToDate         = $ToYear ."-". $ToMonth;
		
		*/
		
		
        $FromDate       = \api\apiClass::convertDate($datefilter1, "%Y-%m");
		$ToDate         = \api\apiClass::convertDate($datefilter2, "%Y-%m");
		
	//	echo "FromDate=".$FromDate."<br>";
	//	echo "ToDate=".$ToDate."<br>" ;
			
		//	exit();
		
		$MainKeyword = $LocationId;


        
        $encodedAuth        = "TnpBd09qSTVZbVV6WW1aaFltSTNZMkkzTVRKaVl6a3dOMlU1TWpCak9EQmhaV1poOg==";
        $encodedAuth        = "TnpBd09qSTVZbVV6WW1aaFltSTNZMkkzTVRKaVl6a3dOMlU1TWpCak9EQmhaV1poOg==";
        
        
        $curl                = curl_init();
        $Url                = "https://api.realyse.com/v1/data/features";
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $Url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        //curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\"areaName\":\"London\",\"mode\":\"Postcode\" }" ); 
        curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\n    \"areaIds\": [\n        \"{$MainKeyword}\"\n    ],\n    \"dataset\": {\n        \"bedrooms\":{$bedrooms},\n        \"dataSource\": \"{$BuildType}\",\n        \"propertyType\": \"{$propertyType}\"\n    },\n    \"dateFrom\": \"{$FromDate}\",\n    \"dateTo\": \"{$ToDate}\"\n}" ); 
         
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Basic ". $encodedAuth , 'Content-Type: text/plain'));

        //curl_setopt($ch, CURLOPT_HTTPHEADER,     array("Authorization: Basic ". $encodedAuth, 'Content-Type: text/plain')); 
        
        $response   = curl_exec ($ch);
        $err        = curl_error($curl);
        
        curl_close($curl);
        
  
        if ($err) {
          $RetArr = array(); 
            
        } else {
            
       //echo $response;
       //exit();
          $RetDecode = json_decode($response); 
          
          //echo "<pre>"; print_r($RetDecode); echo "</pre>";
          
          $SuggestArr = array();
          

          $MonthdateTemp  = "" ;
          $sProductValTemp = "" ;
          foreach($RetDecode->data as $RetArr1){
              
                $MonthdateCnt        =  strtotime($RetArr1->date);
                $Monthdate            = date('M-Y', $MonthdateCnt);
                  
               if( $datasource == "Discnt"){
                    $sProductVal      =  $RetArr1->sDiscount->v;
                    $NinthPercentile  = $RetArr1->sDiscount->p90;
                    $UpperQuartile    = $RetArr1->sDiscount->p75;
                    $Median           = $RetArr1->sDiscount->v;
                    $LowerQuartile    = $RetArr1->sDiscount->p25;
                    $Supply           = $RetArr1->sDiscount->hr;
                    $ProductName      = "Average Discount (Sales)";
                }
                  
                if( $datasource == "GrsYld"){
                    $sProductVal      =  $RetArr1->yield->v;
                    $NinthPercentile  = $RetArr1->yield->p90;
                    $UpperQuartile    = $RetArr1->yield->p75;
                    $Median           = $RetArr1->yield->v;
                    $LowerQuartile    = $RetArr1->yield->p25;
                    $Supply           = $RetArr1->yield->hr;
                    $ProductName = "Average Gross Yield Per Month";
                }
                    
                if( $datasource == "PriAsk"){
                    $sProductVal      =  $RetArr1->sPriceAsked->v;
                    $NinthPercentile  = $RetArr1->sPriceAsked->p90;
                    $UpperQuartile    = $RetArr1->sPriceAsked->p75;
                    $Median           = $RetArr1->sPriceAsked->v;
                    $LowerQuartile    = $RetArr1->sPriceAsked->p25;
                    $Supply           = $RetArr1->sPriceAsked->hr;
                    $ProductName = "Average Asking Price (Sales)";
                }
                
                if( $datasource == "RentAsk"){
                    $sProductVal      =  $RetArr1->rRentAsked->v;
                    $NinthPercentile  = $RetArr1->rRentAsked->p90;
                    $UpperQuartile    = $RetArr1->rRentAsked->p75;
                    $Median           = $RetArr1->rRentAsked->v;
                    $LowerQuartile    = $RetArr1->rRentAsked->p25;
                    $Supply           = $RetArr1->rRentAsked->hr;
                     $ProductName = "Average Asking Monthly Rental";
                }
                    
                if( $datasource == "sqfiRent"){
                    $sProductVal      =  $RetArr1->rPricePerSqft->v;
                    $NinthPercentile  = $RetArr1->rPricePerSqft->p90;
                    $UpperQuartile    = $RetArr1->rPricePerSqft->p75;
                    $Median           = $RetArr1->rPricePerSqft->v;
                    $LowerQuartile    = $RetArr1->rPricePerSqft->p25;
                    $Supply           = $RetArr1->rPricePerSqft->hr;
                    $ProductName = "Average Annual Asking Rent £ per ft²";
                }
                    
                if( $datasource == "sqfiSales"){
                    $sProductVal      =  $RetArr1->sPricePerSqft->v;
                    $NinthPercentile  = $RetArr1->sPricePerSqft->p90;
                    $UpperQuartile    = $RetArr1->sPricePerSqft->p75;
                    $Median           = $RetArr1->sPricePerSqft->v;
                    $LowerQuartile    = $RetArr1->sPricePerSqft->p25;
                    $Supply           = $RetArr1->sPricePerSqft->hr;
                    $ProductName = "Average Asking Price £ per ft² (Sales)";
                }
                    
                if( $datasource == "PriPaid"){
                    $sProductVal      =  $RetArr1->sPricePaid->v;
                    $NinthPercentile  = $RetArr1->sPricePaid->p90;
                    $UpperQuartile    = $RetArr1->sPricePaid->p75;
                    $Median           = $RetArr1->sPricePaid->v;
                    $LowerQuartile    = $RetArr1->sPricePaid->p25;
                    $Supply           = $RetArr1->sPricePaid->hr;
                    $ProductName = "Average Price Paid (Sales)";
                }
                    
                if( $datasource == "DaysMarRent"){
                    $sProductVal      =  $RetArr1->rDaysOnMarket->v;
                    $NinthPercentile  = $RetArr1->rDaysOnMarket->p90;
                    $UpperQuartile    = $RetArr1->rDaysOnMarket->p75;
                    $Median           = $RetArr1->rDaysOnMarket->v;
                    $LowerQuartile    = $RetArr1->rDaysOnMarket->p25;
                    $Supply           = $RetArr1->rDaysOnMarket->hr;
                    $ProductName = "Average Days on Market (Rentals)";
                }
                    
                if( $datasource == "PropSize"){
                    $sProductVal      =  $RetArr1->sSize->v;
                    $NinthPercentile  = $RetArr1->sSize->p90;
                    $UpperQuartile    = $RetArr1->sSize->p75;
                    $Median           = $RetArr1->sSize->v;
                    $LowerQuartile    = $RetArr1->sSize->p25;
                    $Supply           = $RetArr1->sSize->hr;
                    $ProductName = "Average Area (Rentals)";
                }
                    
                if( $datasource == "DaysMarSales"){
                    $sProductVal      =  $RetArr1->sDaysOnMarket->v;
                    $NinthPercentile  = $RetArr1->sDaysOnMarket->p90;
                    $UpperQuartile    = $RetArr1->sDaysOnMarket->p75;
                    $Median           = $RetArr1->sDaysOnMarket->v;
                    $LowerQuartile    = $RetArr1->sDaysOnMarket->p25;
                    $Supply           = $RetArr1->sDaysOnMarket->hr;
                    $ProductName = "Average days on Market (Sales)";
                }
                    
                if( $datasource == "RentList"){
                    $sProductVal      =  $RetArr1->rListings->v;
                    $NinthPercentile  = $RetArr1->rListings->p90;
                    $UpperQuartile    = $RetArr1->rListings->p75;
                    $Median           = $RetArr1->rListings->v;
                    $LowerQuartile    = $RetArr1->rListings->p25;
                    $Supply           = $RetArr1->rListings->hr;
                    $ProductName = "Rent Listing Month";
                }
                    
                if( $datasource == "NewRentList"){
                    $sProductVal      =  $RetArr1->rNewListings->v;
                    $NinthPercentile  = $RetArr1->rNewListings->p90;
                    $UpperQuartile    = $RetArr1->rNewListings->p75;
                    $Median           = $RetArr1->rNewListings->v;
                    $LowerQuartile    = $RetArr1->rNewListings->p25;
                    $Supply           = $RetArr1->rNewListings->hr;
                    $ProductName = "Number of new Rental Listing's per Month";
                }
                    
                if( $datasource == "SalesList"){
                    $sProductVal      =  $RetArr1->sListings->v;
                    $NinthPercentile  = $RetArr1->sListings->p90;
                    $UpperQuartile    = $RetArr1->sListings->p75;
                    $Median           = $RetArr1->sListings->v;
                    $LowerQuartile    = $RetArr1->sListings->p25;
                    $Supply           = $RetArr1->sListings->hr;
                    $ProductName = "Sales Listing";
                }
                    
                if( $datasource == "NewSalesList"){
                    $sProductVal      =  $RetArr1->sNewListings->v;
                    $NinthPercentile  = $RetArr1->sNewListings->p90;
                    $UpperQuartile    = $RetArr1->sNewListings->p75;
                    $Median           = $RetArr1->sNewListings->v;
                    $LowerQuartile    = $RetArr1->sNewListings->p25;
                    $Supply           = $RetArr1->sNewListings->hr;
                    $ProductName = "Number of new Sales Listing's per Month";
                }
                    
                if( $datasource == "SalesTrans"){
                    $sProductVal      =  $RetArr1->sTransactions->v;
                    $NinthPercentile  = $RetArr1->sTransactions->p90;
                    $UpperQuartile    = $RetArr1->sTransactions->p75;
                    $Median           = $RetArr1->sTransactions->v;
                    $LowerQuartile    = $RetArr1->sTransactions->p25;
                    $Supply           = $RetArr1->sTransactions->hr;
                    $ProductName = "Sales Transactions";
                }
                
                  
                 if ( $MonthdateTemp == "" ){
                     $MonthdateTemp = $Monthdate;
                 }else{
                     $MonthdateTemp = $Monthdate ."','". $MonthdateTemp ;
                 }
                 
                 if ( $sProductValTemp == "" ){
                     $sProductValTemp = $sProductVal;
                 }else{
                     $sProductValTemp = $sProductVal .",". $sProductValTemp ;
                 }
                 
                  
                 $AllArray[] = array("MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
          }
          
          
        }
        //echo $Cnt;
        //echo $MonthdateTemp;
       // echo $sPricePaidTemp;
        //exit();
        
        //echo 'dcml='. $dcml . '<br>';
        
        $MonthdateTemp = "'" . $MonthdateTemp . "'"; 
        

        $FinalStr ="<script>
                            var options = {
                              series: [{
                                name: '" .$ProductName. "',
                                data: [". $sProductValTemp ."]
                            }],
                              chart: {
                              height: 350,
                              type: 'line',
                              zoom: {
                                enabled: false
                              }
                            },
                            dataLabels: {
                              enabled: false
                            },
                            stroke: {
                              curve: 'straight'
                            },
                            title: {
                              text: '',
                              align: 'left'
                            },
                            grid: {
                              row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                              },
                            },
                            yaxis: {
                              type: 'numeric',
                              title: {
                                text: '{$ProductName}',
                                style: {
                                  fontSize:  '18px',
                                  fontWeight:  'bold',
                                  fontFamily:  undefined,
                                  color:  '#263238'
                                },
                              },
                              labels: {
                                show:true,
                                formatter: function (value) {
                                  return value.toFixed({$dcml})  + ' %';
                                }
                              },
                    
                            },
                            xaxis: {
                              categories: [". $MonthdateTemp . "],
                                title: {
                                    text: 'Month',
                                    style: {
                                      fontSize:  '10 px',
                                      fontWeight:  'normal',
                                      fontFamily:  undefined,
                                      color:  '#263238'
                                    },
                                  }
                            }, 
                            tooltip: {
                               y: {
                                  formatter: function(y) {
                                    if (typeof y !== 'undefined') {
                                      return y.toFixed({$dcml})  + ' %';
                                    }
                                    return y;
                                  }
                                }
                            }
                            };
                    
                            var chart = new ApexCharts(document.querySelector('#chart{$Cnt}'), options);
                            chart.render(); 
                            
                            </script>
                        ";
                  //echo $Cnt     ; 
                        
        if ($RetType == "formap"){
            
		    return $FinalStr; 
        }
        else{
            return $AllArray; 
        }
        
		
	}
	
	
		//===============================================Product Feature Api Uk===================================================================================
    
        
    public static function ProductFeatureApiUkValue($RetType,$LocationId,$datasource,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$Cnt){
		self::Init(); 


		$FinalStr		= "";
		$AllArray       = array(); 
		$TempArr1       = array();
		$TempArr2       = array();

		
        $FromDate       = \api\apiClass::convertDate($datefilter1, "%Y-%m");
		$ToDate         = \api\apiClass::convertDate($datefilter2, "%Y-%m");
		

		$MainKeyword = $LocationId;


        
        $encodedAuth        = "TnpBd09qSTVZbVV6WW1aaFltSTNZMkkzTVRKaVl6a3dOMlU1TWpCak9EQmhaV1poOg==";
        
        
        
        $curl                = curl_init();
        $Url                = "https://api.realyse.com/v1/data/features";
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $Url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        //curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\"areaName\":\"London\",\"mode\":\"Postcode\" }" ); 
        curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\n    \"areaIds\": [\n        \"{$MainKeyword}\"\n    ],\n    \"dataset\": {\n        \"bedrooms\":{$bedrooms},\n        \"dataSource\": \"{$BuildType}\",\n        \"propertyType\": \"{$propertyType}\"\n    },\n    \"dateFrom\": \"{$FromDate}\",\n    \"dateTo\": \"{$ToDate}\"\n}" ); 
         
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Basic ". $encodedAuth , 'Content-Type: text/plain'));

        //curl_setopt($ch, CURLOPT_HTTPHEADER,     array("Authorization: Basic ". $encodedAuth, 'Content-Type: text/plain')); 
        
        $response   = curl_exec ($ch);
        $err        = curl_error($curl);
        
        curl_close($curl);
        
  
        if ($err) {
          $RetArr = array(); 
            
        } else {
            
       //echo $response;
      // exit();
       
           //$response = arsort($response);
           
           /* $response = usort($response, function($a, $b) { //Sort the array using a user defined function
                return $a->date > $b->date ? -1 : 1; //Compare the scores
            });  
            */
           // $response = array_reverse($response);
            
           // echo "<pre>"; print_r($response); echo "</pre>";
            
          $RetDecode = json_decode($response); 
          
          //echo "<pre>"; print_r($RetDecode); echo "</pre>";
          
          
          
          
         
          
          
          
          $SuggestArr = array();
          

          $MonthdateTemp  = "" ;
          $sProductValTemp = "" ;
          foreach($RetDecode->data as $RetArr1){
              
                $MonthdateCnt        =  strtotime($RetArr1->date);
                $Monthdate            = date('M-Y', $MonthdateCnt);
                  
                if( $datasource == "Discnt"){
                    $sProductVal      =  $RetArr1->sDiscount->v;
                    $NinthPercentile  = $RetArr1->sDiscount->p90;
                    $UpperQuartile    = $RetArr1->sDiscount->p75;
                    $Median           = $RetArr1->sDiscount->v;
                    $LowerQuartile    = $RetArr1->sDiscount->p25;
                    $Supply           = $RetArr1->sDiscount->hr;
                    $ProductName      = "Average Discount (Sales)";
                }
                  
                if( $datasource == "GrsYld"){
                    $sProductVal      =  $RetArr1->yield->v;
                    $NinthPercentile  = $RetArr1->yield->p90;
                    $UpperQuartile    = $RetArr1->yield->p75;
                    $Median           = $RetArr1->yield->v;
                    $LowerQuartile    = $RetArr1->yield->p25;
                    $Supply           = $RetArr1->yield->hr;
                    $ProductName = "Average Gross Yield Per Month";
                }
                    
                if( $datasource == "PriAsk"){
                    $sProductVal      =  $RetArr1->sPriceAsked->v;
                    $NinthPercentile  = $RetArr1->sPriceAsked->p90;
                    $UpperQuartile    = $RetArr1->sPriceAsked->p75;
                    $Median           = $RetArr1->sPriceAsked->v;
                    $LowerQuartile    = $RetArr1->sPriceAsked->p25;
                    $Supply           = $RetArr1->sPriceAsked->hr;
                    $ProductName = "Average Asking Price (Sales)";
                }
                
                if( $datasource == "RentAsk"){
                    $sProductVal      =  $RetArr1->rRentAsked->v;
                    $NinthPercentile  = $RetArr1->rRentAsked->p90;
                    $UpperQuartile    = $RetArr1->rRentAsked->p75;
                    $Median           = $RetArr1->rRentAsked->v;
                    $LowerQuartile    = $RetArr1->rRentAsked->p25;
                    $Supply           = $RetArr1->rRentAsked->hr;
                     $ProductName = "Average Asking Monthly Rental";
                }
                    
                if( $datasource == "sqfiRent"){
                    $sProductVal      =  $RetArr1->rPricePerSqft->v;
                    $NinthPercentile  = $RetArr1->rPricePerSqft->p90;
                    $UpperQuartile    = $RetArr1->rPricePerSqft->p75;
                    $Median           = $RetArr1->rPricePerSqft->v;
                    $LowerQuartile    = $RetArr1->rPricePerSqft->p25;
                    $Supply           = $RetArr1->rPricePerSqft->hr;
                    $ProductName = "Average Annual Asking Rent £ per ft²";
                }
                    
                if( $datasource == "sqfiSales"){
                    $sProductVal      =  $RetArr1->sPricePerSqft->v;
                    $NinthPercentile  = $RetArr1->sPricePerSqft->p90;
                    $UpperQuartile    = $RetArr1->sPricePerSqft->p75;
                    $Median           = $RetArr1->sPricePerSqft->v;
                    $LowerQuartile    = $RetArr1->sPricePerSqft->p25;
                    $Supply           = $RetArr1->sPricePerSqft->hr;
                    $ProductName = "Average Asking Price £ per ft² (Sales)";
                }
                    
                if( $datasource == "PriPaid"){
                    $sProductVal      =  $RetArr1->sPricePaid->v;
                    $NinthPercentile  = $RetArr1->sPricePaid->p90;
                    $UpperQuartile    = $RetArr1->sPricePaid->p75;
                    $Median           = $RetArr1->sPricePaid->v;
                    $LowerQuartile    = $RetArr1->sPricePaid->p25;
                    $Supply           = $RetArr1->sPricePaid->hr;
                    $ProductName = "Average Price Paid (Sales)";
                }
                    
                if( $datasource == "DaysMarRent"){
                    $sProductVal      =  $RetArr1->rDaysOnMarket->v;
                    $NinthPercentile  = $RetArr1->rDaysOnMarket->p90;
                    $UpperQuartile    = $RetArr1->rDaysOnMarket->p75;
                    $Median           = $RetArr1->rDaysOnMarket->v;
                    $LowerQuartile    = $RetArr1->rDaysOnMarket->p25;
                    $Supply           = $RetArr1->rDaysOnMarket->hr;
                    $ProductName = "Average Days on Market (Rentals)";
                }
                    
                if( $datasource == "PropSize"){
                    $sProductVal      =  $RetArr1->sSize->v;
                    $NinthPercentile  = $RetArr1->sSize->p90;
                    $UpperQuartile    = $RetArr1->sSize->p75;
                    $Median           = $RetArr1->sSize->v;
                    $LowerQuartile    = $RetArr1->sSize->p25;
                    $Supply           = $RetArr1->sSize->hr;
                    $ProductName = "Average Area (Rentals)";
                }
                    
                if( $datasource == "DaysMarSales"){
                    $sProductVal      =  $RetArr1->sDaysOnMarket->v;
                    $NinthPercentile  = $RetArr1->sDaysOnMarket->p90;
                    $UpperQuartile    = $RetArr1->sDaysOnMarket->p75;
                    $Median           = $RetArr1->sDaysOnMarket->v;
                    $LowerQuartile    = $RetArr1->sDaysOnMarket->p25;
                    $Supply           = $RetArr1->sDaysOnMarket->hr;
                    $ProductName = "Average days on Market (Sales)";
                }
                    
                if( $datasource == "RentList" || $datasource="SalesOverView" ){
                    $sProductVal      =  $RetArr1->rListings->v;
                    $NinthPercentile  = $RetArr1->rListings->p90;
                    $UpperQuartile    = $RetArr1->rListings->p75;
                    $Median           = $RetArr1->rListings->v;
                    $LowerQuartile    = $RetArr1->rListings->p25;
                    $Supply           = $RetArr1->rListings->hr;
                    $ProductName = "Rent Listing Month";
                }
                    
                if( $datasource == "NewRentList"  ){
                    $sProductVal      =  $RetArr1->rNewListings->v;
                    $NinthPercentile  = $RetArr1->rNewListings->p90;
                    $UpperQuartile    = $RetArr1->rNewListings->p75;
                    $Median           = $RetArr1->rNewListings->v;
                    $LowerQuartile    = $RetArr1->rNewListings->p25;
                    $Supply           = $RetArr1->rNewListings->hr;
                    $ProductName = "Number of new Rental Listing's per Month";
                }
                    
                if( $datasource == "SalesList"){
                    $sProductVal      =  $RetArr1->sListings->v;
                    $NinthPercentile  = $RetArr1->sListings->p90;
                    $UpperQuartile    = $RetArr1->sListings->p75;
                    $Median           = $RetArr1->sListings->v;
                    $LowerQuartile    = $RetArr1->sListings->p25;
                    $Supply           = $RetArr1->sListings->hr;
                    $ProductName = "Sales Listing";
                }
                    
                if( $datasource == "NewSalesList"){
                    $sProductVal      =  $RetArr1->sNewListings->v;
                    $NinthPercentile  = $RetArr1->sNewListings->p90;
                    $UpperQuartile    = $RetArr1->sNewListings->p75;
                    $Median           = $RetArr1->sNewListings->v;
                    $LowerQuartile    = $RetArr1->sNewListings->p25;
                    $Supply           = $RetArr1->sNewListings->hr;
                    $ProductName = "Number of new Sales Listing's per Month";
                }
                    
                if( $datasource == "SalesTrans"){
                    $sProductVal      =  $RetArr1->sTransactions->v;
                    $NinthPercentile  = $RetArr1->sTransactions->p90;
                    $UpperQuartile    = $RetArr1->sTransactions->p75;
                    $Median           = $RetArr1->sTransactions->v;
                    $LowerQuartile    = $RetArr1->sTransactions->p25;
                    $Supply           = $RetArr1->sTransactions->hr;
                    $ProductName = "Sales Transactions";
                }
                
                  
                 if ( $MonthdateTemp == "" ){
                     $MonthdateTemp = $Monthdate;
                 }else{
                     $MonthdateTemp = $Monthdate ."','". $MonthdateTemp ;
                 }
                 
                 if ( $sProductValTemp == "" ){
                     $sProductValTemp = $sProductVal;
                 }else{
                     $sProductValTemp = $sProductVal .",". $sProductValTemp ;
                 }
                 
                  
                 $AllArray[] = array("MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
          }
          
          
        }
        //echo $Cnt;
        //echo $MonthdateTemp;
       // echo $sPricePaidTemp;
        //exit();
        
        //echo 'dcml='. $dcml . '<br>';
        
        $MonthdateTemp = "'" . $MonthdateTemp . "'"; 
        

        $FinalStr ="<script>
                            var options = {
                              series: [{
                                name: '" .$ProductName. "',
                                data: [". $sProductValTemp ."]
                            }],
                              chart: {
                              height: 350,
                              type: 'line',
                              zoom: {
                                enabled: false
                              }
                            },
                            dataLabels: {
                              enabled: false
                            },
                            stroke: {
                              curve: 'straight'
                            },
                            title: {
                              text: '',
                              align: 'left'
                            },
                            grid: {
                              row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                              },
                            },
                            yaxis: {
                              type: 'numeric',
                              title: {
                                text: '{$ProductName}',
                                style: {
                                  fontSize:  '18px',
                                  fontWeight:  'bold',
                                  fontFamily:  undefined,
                                  color:  '#263238'
                                },
                              },
                              labels: {
                                show:true,
                                formatter: function (value) {
                                  return '£ '+ value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                                }
                              },
                    
                            },
                            xaxis: {
                              categories: [". $MonthdateTemp . "],
                                title: {
                                    text: 'Month',
                                    style: {
                                      fontSize:  '10 px',
                                      fontWeight:  'normal',
                                      fontFamily:  undefined,
                                      color:  '#263238'
                                    },
                                  }
                            }, 
                            tooltip: {
                               y: {
                                  formatter: function(y) {
                                    if (typeof y !== 'undefined') {
                                      return '£ '+ y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                                    }
                                    return y;
                                  }
                                }
                            }
                            };
                    
                            var chart = new ApexCharts(document.querySelector('#chart{$Cnt}'), options);
                            chart.render(); 
                            
                            </script>
                        ";
                  //echo $Cnt     ; 
                        
        if ($RetType == "formap"){
            
		    return $FinalStr; 
        }
        else{
            return $AllArray; 
        }
        
		
	}
	
	
	
	//============================  Population Graph ====================
	
	public static function PopulationApiUK($locationId,$datefilter1,$datefilter2){
		self::Init(); 

		$FinalStr		= "";
		$AllArray       = array(); 
		$TempArr1       = array();
		$TempArr2       = array();
	
		
		$FromDate       = \api\apiClass::convertDate($datefilter1, "%Y-%m");
		$ToDate         = \api\apiClass::convertDate($datefilter2, "%Y-%m");
		
	     $PeopleAndPopulationArr  =  \api\apiClass::PeopleAndPopulationApiClass($locationId,$datefilter1,$datefilter2); 
                                         //echo "<pre>"; print_r($PeopleAndPopulationArr); echo "</pre>"; 
                                         
                                         
        $j = 0;
                                       
        foreach($PeopleAndPopulationArr as $RsPap){
                
                //420,157,493,474,475,476,477,478,479,480,481,482,483,484,485,486,487,488
                
                if ($RsPap["420"] == 420) { 
                
                    $MedianAgeVal           = isset($RsPap["420_Val"]) ? $RsPap["420_Val"] : "0";
                   $TotMedianAgeVal         = floatval($TotMedianAgeVal) + floatval($MedianAgeVal);
                   
                   $j++;
                   
                  
                }
                
                if ($RsPap["157"] == 157) { 
                
                    $PopulationDensity       = isset($RsPap["157_Val"]) ? $RsPap["157_Val"] : "0";
                    $TotPopulationDensity    = floatval($TotPopulationDensity) + floatval($PopulationDensity);
                  
                }
                
                
                if ($RsPap["493"] == 493) { 
                
                    $HigherEducationEQI     = isset($RsPap["493_Val"]) ? $RsPap["493_Val"] : "0";
                    $TotHigherEducationEQI  = floatval($TotHigherEducationEQI) + floatval($HigherEducationEQI);
                  
                }
                
                
                
                if ($RsPap["474"] == 474) { 
                
                    $PopulationAgeLess20     = isset($RsPap["474_Val"]) ? $RsPap["474_Val"] : "0";
                    $TotPopulationAgeLess20  = floatval($TotPopulationAgeLess20) + floatval($PopulationAgeLess20);
                    
                    //echo 'TotPopulationAgeLess20='. $TotPopulationAgeLess20 .'<br>';
        
                  
                }
                
                if ($RsPap["475"] == 475) { 
                
                    $PopulationAgeBet2024     = isset($RsPap["475_Val"]) ? $RsPap["475_Val"] : "0";
                    $TotPopulationAgeBet2024  = floatval($TotPopulationAgeBet2024) + floatval($PopulationAgeBet2024);
                  
                }
                
                if ($RsPap["476"] == 476) { 
                
                    $PopulationAgeBet2529     = isset($RsPap["476_Val"]) ? $RsPap["476_Val"] : "0";
                    $TotPopulationAgeBet2529  = floatval($TotPopulationAgeBet2529) + floatval($PopulationAgeBet2529);
               
                  
                }
                
                if ($RsPap["477"] == 477) { 
                
                    $PopulationAgeBet3034     = isset($RsPap["477_Val"]) ? $RsPap["477_Val"] : "0";
                    $TotPopulationAgeBet3034  = floatval($TotPopulationAgeBet3034) + floatval($PopulationAgeBet3034);
                   
                  
                }
                
                if ($RsPap["478"] == 478) { 
                
                    $PopulationAgeBet3539     = isset($RsPap["478_Val"]) ? $RsPap["478_Val"] : "0";
                    $TotPopulationAgeBet3539  = floatval($TotPopulationAgeBet3539) + floatval($PopulationAgeBet3539);
                  
                  
                }
               
                
                if ($RsPap["479"] == 479) { 
                
                    $PopulationAgeBet4044     = isset($RsPap["479_Val"]) ? $RsPap["479_Val"] : "0";
                    $TotPopulationAgeBet4044  = floatval($TotPopulationAgeBet4044) + floatval($PopulationAgeBet4044);
                    
                    
                  
                }
                
                if ($RsPap["480"] == 480) { 
                
                    $PopulationAgeBet4549     = isset($RsPap["480_Val"]) ? $RsPap["480_Val"] : "0";
                    $TotPopulationAgeBet4549  = floatval($TotPopulationAgeBet4549) + floatval($PopulationAgeBet4549);
                    
                    
                  
                }
                
                if ($RsPap["481"] == 481) { 
                
                    $PopulationAgeBet5054     = isset($RsPap["481_Val"]) ? $RsPap["481_Val"] : "0";
                    $TotPopulationAgeBet5054  = floatval($TotPopulationAgeBet5054) + floatval($PopulationAgeBet5054);
                   
                  
                }
                
                if ($RsPap["482"] == 482) { 
                
                    $PopulationAgeBet5559     = isset($RsPap["482_Val"]) ? $RsPap["482_Val"] : "0";
                    $TotPopulationAgeBet5559  = floatval($TotPopulationAgeBet5559) + floatval($PopulationAgeBet5559);
                    
                   
                  
                }
                
                if ($RsPap["483"] == 483) { 
                
                    $PopulationAgeBet6064     = isset($RsPap["483_Val"]) ? $RsPap["483_Val"] : "0";
                    $TotPopulationAgeBet6064  = floatval($TotPopulationAgeBet6064) + floatval($PopulationAgeBet6064);
                    
                   
                  
                }
                
                 if ($RsPap["484"] == 484) { 
                
                    $PopulationAgeBet6569     = isset($RsPap["484_Val"]) ? $RsPap["484_Val"] : "0";
                    $TotPopulationAgeBet6569  = floatval($TotPopulationAgeBet6569) + floatval($PopulationAgeBet6569);
                    
                  
                  
                }
                
                if ($RsPap["485"] == 485) { 
                
                    $PopulationAgeBet7074     = isset($RsPap["485_Val"]) ? $RsPap["485_Val"] : "0";
                    $TotPopulationAgeBet7074  = floatval($TotPopulationAgeBet7074) + floatval($PopulationAgeBet7074);
                  
                  
                }
                
                
                
                if ($RsPap["486"] == 486 ) { 
                
                    $PopulationAgeBet7579     = isset($RsPap["486_Val"]) ? $RsPap["486_Val"] : "0";
                    $TotPopulationAgeBet7579  = floatval($TotPopulationAgeBet7579) + floatval($PopulationAgeBet7579);
                    
                 
                  
                }
                
                if ($RsPap["487"] == 487 ) { 
                
                    $PopulationAgeBet8084     = isset($RsPap["487_Val"]) ? $RsPap["487_Val"] : "0";
                    $TotPopulationAgeBet8084  = floatval($TotPopulationAgeBet8084) + floatval($PopulationAgeBet8084);
                  
                  
                }
                
                if ($RsPap["488"] == 488 ) { 
                
                    $PopulationAgeAbove85     = isset($RsPap["488_Val"]) ? $RsPap["488_Val"] : "0";
                    $TotPopulationAgeAbove85  = floatval($TotPopulationAgeAbove85) + floatval($PopulationAgeAbove85);
                   
                  
                }

              $i++;
         }
         
         //echo $TotMedianAgeVal;
               
       $valueTemp = $TotPopulationAgeLess20 .",". $TotPopulationAgeBet2024 .",". $TotPopulationAgeBet2529  .",". $TotPopulationAgeBet3034 .",". $TotPopulationAgeBet3539 .",". $TotPopulationAgeBet4044 .",". $TotPopulationAgeBet4549
                    .",". $TotPopulationAgeBet5054 .",". $TotPopulationAgeBet5559 .",". $TotPopulationAgeBet6064 .",". $TotPopulationAgeBet6569 .",". $TotPopulationAgeBet7074 .",". $TotPopulationAgeBet7579 .",". $TotPopulationAgeBet8084
                    .",". $TotPopulationAgeAbove85 ;
       $indicatorIdTemp = "20,20-24,25-29,30-34,35-39,40-44,45-49,5054,5559,6064,6569,7074,7579,8084,85";
       
       /*
        
         $TotalPopulation =  floatval($TotPopulationAgeLess20) +  floatval($TotPopulationAgeBet2024) + floatval($TotPopulationAgeBet2529) + floatval($TotPopulationAgeBet3034) 
                                        					 + floatval($TotPopulationAgeBet3539) + floatval($TotPopulationAgeBet4044)+ floatval($TotPopulationAgeBet4549) + floatval($TotPopulationAgeBet5054)
                                        					 + floatval($TotPopulationAgeBet5559) + floatval($TotPopulationAgeBet6064)+ floatval($TotPopulationAgeBet6569) + floatval($TotPopulationAgeBet7074) 
                                        					 + floatval($TotPopulationAgeBet7579) + floatval($TotPopulationAgeBet8084) + floatval($TotPopulationAgeAbove85);
                                        					 
          */                              					 
       
		$FinalStr = "<script>//
                  var colors9 = ['#685F25'];
                  var options = {
                  chart: {
                    toolbar:{
                      show:false
                    },
                    height: 380,
                    type: 'bar',
                    stacked: false
                  },
                  plotOptions: {
                    bar: {
                      horizontal: false,
                      columnWidth: '50px',
                      endingShape: 'flat',
                      colors: {
                          backgroundBarColors: ['#eee'],
                          backgroundBarOpacity: 1,
                      },
                    },
                  },
                  colors: colors9,
                  dataLabels: {
                    enabled: false
                  },
                  series: [
                    {
                      name: 'Population', 
                      type: 'column',
                      data: [" . $valueTemp . "] 
                    }
                  ],
                  xaxis: {
                    categories: ['20','20-24','25-29','30-34','35-39','40-44','45-49','50-54','55-59','60-64','65-69','70-74','75-79','80-84','85+'],
                    title: {
                        text: 'Age Ratio',
                        style: {
                          fontSize:  '10 px',
                          fontWeight:  'normal',
                          fontFamily:  undefined,
                          color:  '#263238'
                        },
                      }
                  },
                  yaxis: [
                    {
                      axisTicks: {
                        show: true
                      },
                      axisBorder: {
                        show: true,
                        color: '#3f51b5'
                      },
                      labels: {
                        formatter: function (value) {
                          return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); ;
                        },
                        style: {
                          color: '#3f51b5'
                        }
                      },
                      title: {
                        text: 'Population',
                        style: {
                          fontSize:  '10 px',
                          fontWeight:  'normal',
                          fontFamily:  undefined,
                          color:  '#263238'
                        },
                      }
                    },
                    {
                      axisTicks: {
                        show: false
                      },
                      axisBorder: {
                        show: false,
                        color: '#FFA600'
                      },
                      labels: {
                        show: false,
                        style: {
                          color: '#FFA600'
                        }
                      }
                    }
                  ],
                  tooltip: {
                    followCursor: true,
                        y: {
                          formatter: function(y) {
                            if (typeof y !== 'undefined') {
                              return y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); 
                            }
                            return y;
                          }
                        },
                        x: {
                            show:true,
                            formatter: function (value) {
                              return 'Age Ratio ' + value;
                            }
                          }
                  },
                  markers: {
                    size: 5,
                    hover: {
                      size: 9
                    }
                  }
                };
                
                var chart = new ApexCharts(document.querySelector('#Population'), options);
                
                chart.render();
                
                </script>
                ";
				

		//echo $FinalStr; 
		return $FinalStr; 
	}
	
	
	//============================  Poupation Graph End ===============
	
	
	public static function convertDate($date , $dateFormat = '%d-%m-%Y %H:%M:%S'){
		$date       = str_replace("/" , "-" , $date);
		$timestamp  = strftime($date);
		return strftime($dateFormat , strtotime($timestamp));
    }
    
    
    public static function GetCurrencyDetails($countryId){
        
        $ChkCntArr  = \DBConn\DBConnection::getQueryFetchColumn("(SELECT CURRENCY FROM country_master WHERE COUNTRY_CODE ='{$countryId}')");
        $Currency   = $ChkCntArr["0"];
        
        $ChkSymbolArr   = \DBConn\DBConnection::getQueryFetchColumn("(SELECT Currency_Symbol FROM country_master WHERE COUNTRY_CODE ='{$countryId}')");
        $CurrencySym    = $ChkSymbolArr["0"] ;
        
        if($countryId == "3")
            $CurrencySym = "£";
        
        $MapCurrecncy = $CurrencySym ." ".$Currency;
        
        return $MapCurrecncy; 
    }
    
    
    
    	
	//============================  Population Graph ====================
	
	public static function FeatureCommonApiUkValue($GraphDetails,$locationId,$DataSrc,$datefilter1,$datefilter2,$m="0",$ProductName="",$graphpoint="D"){
	    
	  
		self::Init(); 

		$FinalStr		= "";
		$AllArray       = array(); 
		$TempArr1       = array();
		$TempArr2       = array();
	
		
		$FromDate       = \api\apiClass::convertDate($datefilter1, "%Y-%m");
		$ToDate         = \api\apiClass::convertDate($datefilter2, "%Y-%m");
		
	     $ApiReturnArr  =  \api\apiClass::CommonApiClass($locationId,$datefilter1,$datefilter2,$DataSrc); 
        //echo "<pre>"; print_r($ApiReturnArr); echo "</pre>"; 
        //exit;
        $i = 1;
        $TotalValueArr = "";
        $MonthValueArr = "";
        foreach($ApiReturnArr as $RsArr){
            
                
          
                
                    $ValueArr       = isset($RsArr["{$DataSrc}_Val"]) ? $RsArr["{$DataSrc}_Val"] : "0";
                    
                    //echo 'ValueArr='. $ValueArr .'<br>';
                    
                    $MonthDateArr       = isset($RsArr["MonthDate"]) ? $RsArr["MonthDate"] : "0";
                    
                    
                    
                     //echo 'MonthDateArr='. $MonthDateArr .'<br>';
                    
                    if($TotalValueArr == ""){
                        $TotalValueArr  = $ValueArr;
                    }else{
                        
                        $TotalValueArr  = $TotalValueArr .",". $ValueArr;
                        
                    }
                    
          
                    
                    if ( $MonthValueArr == "" ){
                         $MonthValueArr = $MonthDateArr;
                     }else{
                         $MonthValueArr = $MonthValueArr ."','". $MonthDateArr ;
                     }
                    
                    
                
              
              $i++;
         }
         
         //echo $TotMedianAgeVal;
               
       $valueTemp = "" ;
       $indicatorIdTemp = "";
       
       $MonthdateTemp = "'" . $MonthValueArr . "'"; 
       
                  // echo 'graphpoint='. $graphpoint .'<br>';        
             // echo '$MonthdateTemp='. $MonthdateTemp .'<br>';  
                     //exit;
                     
        if($graphpoint == "R"){
            
            
        
       
    		$FinalStr = "<script>//
                      var colors9 = ['#685F25'];
                      var options = {
                      chart: {
                        toolbar:{
                          show:false
                        },
                        height: 380,
                        type: 'bar',
                        stacked: false
                      },
                      plotOptions: {
                        bar: {
                          horizontal: false,
                          columnWidth: '50px',
                          endingShape: 'flat',
                          colors: {
                              backgroundBarColors: ['#eee'],
                              backgroundBarOpacity: 1,
                          },
                        },
                      },
                      colors: colors9,
                      dataLabels: {
                        enabled: false
                      },
                      series: [
                        {
                          name: '{$ProductName}', 
                          type: 'column',
                          data: [" . $TotalValueArr . "] 
                        }
                      ],
                      xaxis: {
                        categories: [". $MonthdateTemp ."],
                        title: {
                            text: 'Month',
                            style: {
                              fontSize:  '10 px',
                              fontWeight:  'normal',
                              fontFamily:  undefined,
                              color:  '#263238'
                            },
                          }
                      },
                      yaxis: [
                        {
                          axisTicks: {
                            show: true
                          },
                          axisBorder: {
                            show: true,
                            color: '#3f51b5'
                          },
                          labels: {
                            formatter: function (value) {
                              return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); ;
                            },
                            style: {
                              color: '#3f51b5'
                            }
                          },
                          title: {
                            text: '{$ProductName}',
                            style: {
                              fontSize:  '10 px',
                              fontWeight:  'normal',
                              fontFamily:  undefined,
                              color:  '#263238'
                            },
                          }
                        },
                        {
                          axisTicks: {
                            show: false
                          },
                          axisBorder: {
                            show: false,
                            color: '#FFA600'
                          },
                          labels: {
                            show: false,
                            style: {
                              color: '#FFA600'
                            }
                          }
                        }
                      ],
                      tooltip: {
                        followCursor: true,
                            y: {
                              formatter: function(y) {
                                if (typeof y !== 'undefined') {
                                  return Math.round(y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); 
                                }
                                return y;
                              }
                            },
                            x: {
                                show:true,
                                formatter: function (value) {
                                  return value;
                                }
                              }
                      },
                      markers: {
                        size: 5,
                        hover: {
                          size: 9
                        }
                      }
                    };
                    
                    var chart = new ApexCharts(document.querySelector('#AppGraph{$DataSrc}'), options);
                    
                    chart.render();
                    
                    </script>
                    ";
                    
        }elseif($graphpoint == "D"){
            
                $FinalStr = "<script>//
                      var colors9 = ['#685F25'];
                      var options = {
                      chart: {
                        toolbar:{
                          show:false
                        },
                        height: 380,
                        type: 'bar',
                        stacked: false
                      },
                      plotOptions: {
                        bar: {
                          horizontal: false,
                          columnWidth: '50px',
                          endingShape: 'flat',
                          colors: {
                              backgroundBarColors: ['#eee'],
                              backgroundBarOpacity: 1,
                          },
                        },
                      },
                      colors: colors9,
                      dataLabels: {
                        enabled: false
                      },
                      series: [
                        {
                          name: '{$ProductName}', 
                          type: 'column',
                          data: [" . $TotalValueArr . "] 
                        }
                      ],
                      xaxis: {
                        categories: [". $MonthdateTemp ."],
                        title: {
                            text: 'Month',
                            style: {
                              fontSize:  '10 px',
                              fontWeight:  'normal',
                              fontFamily:  undefined,
                              color:  '#263238'
                            },
                          }
                      },
                      yaxis: [
                        {
                          axisTicks: {
                            show: true
                          },
                          axisBorder: {
                            show: true,
                            color: '#3f51b5'
                          },
                          labels: {
                            formatter: function (value) {
                              return value.toFixed(2) + '%';
                            },
                            style: {
                              color: '#3f51b5'
                            }
                          },
                          title: {
                            text: '{$ProductName}',
                            style: {
                              fontSize:  '10 px',
                              fontWeight:  'normal',
                              fontFamily:  undefined,
                              color:  '#263238'
                            },
                          }
                        },
                        {
                          axisTicks: {
                            show: false
                          },
                          axisBorder: {
                            show: false,
                            color: '#FFA600'
                          },
                          labels: {
                            show: false,
                            style: {
                              color: '#FFA600'
                            }
                          }
                        }
                      ],
                      tooltip: {
                        followCursor: true,
                            y: {
                              formatter: function(y) {
                                if (typeof y !== 'undefined') {
                                  return y.toFixed(2) + '%';
                                }
                                return y;
                              }
                            },
                            x: {
                                show:true,
                                formatter: function (value) {
                                  return value;
                                }
                              }
                      },
                      markers: {
                        size: 5,
                        hover: {
                          size: 9
                        }
                      }
                    };
                    
                    var chart = new ApexCharts(document.querySelector('#AppGraph{$DataSrc}'), options);
                    
                    chart.render();
                    
                    </script>
                    ";
                    
        }elseif($graphpoint == "N"){
                
                $FinalStr = "<script>//
                      var colors9 = ['#685F25'];
                      var options = {
                      chart: {
                        toolbar:{
                          show:false
                        },
                        height: 380,
                        type: 'bar',
                        stacked: false
                      },
                      plotOptions: {
                        bar: {
                          horizontal: false,
                          columnWidth: '50px',
                          endingShape: 'flat',
                          colors: {
                              backgroundBarColors: ['#eee'],
                              backgroundBarOpacity: 1,
                          },
                        },
                      },
                      colors: colors9,
                      dataLabels: {
                        enabled: false
                      },
                      series: [
                        {
                          name: '{$ProductName}', 
                          type: 'column',
                          data: [" . $TotalValueArr . "] 
                        }
                      ],
                      xaxis: {
                        categories: [". $MonthdateTemp ."],
                        title: {
                            text: 'Month',
                            style: {
                              fontSize:  '10 px',
                              fontWeight:  'normal',
                              fontFamily:  undefined,
                              color:  '#263238'
                            },
                          }
                      },
                      yaxis: [
                        {
                          axisTicks: {
                            show: true
                          },
                          axisBorder: {
                            show: true,
                            color: '#3f51b5'
                          },
                          labels: {
                            formatter: function (value) {
                              return value.toFixed(0);
                            },
                            style: {
                              color: '#3f51b5'
                            }
                          },
                          title: {
                            text: '{$ProductName}',
                            style: {
                              fontSize:  '10 px',
                              fontWeight:  'normal',
                              fontFamily:  undefined,
                              color:  '#263238'
                            },
                          }
                        },
                        {
                          axisTicks: {
                            show: false
                          },
                          axisBorder: {
                            show: false,
                            color: '#FFA600'
                          },
                          labels: {
                            show: false,
                            style: {
                              color: '#FFA600'
                            }
                          }
                        }
                      ],
                      tooltip: {
                        followCursor: true,
                            y: {
                              formatter: function(y) {
                                if (typeof y !== 'undefined') {
                                  return y.toFixed(0);
                                }
                                return y;
                              }
                            },
                            x: {
                                show:true,
                                formatter: function (value) {
                                  return value;
                                }
                              }
                      },
                      markers: {
                        size: 5,
                        hover: {
                          size: 9
                        }
                      }
                    };
                    
                    var chart = new ApexCharts(document.querySelector('#AppGraph{$DataSrc}'), options);
                    
                    chart.render();
                    
                    </script>
                    ";
            
        }else{
            
             $FinalStr = "<script>//
                      var colors9 = ['#685F25'];
                      var options = {
                      chart: {
                        toolbar:{
                          show:false
                        },
                        height: 380,
                        type: 'bar',
                        stacked: false
                      },
                      plotOptions: {
                        bar: {
                          horizontal: false,
                          columnWidth: '50px',
                          endingShape: 'flat',
                          colors: {
                              backgroundBarColors: ['#eee'],
                              backgroundBarOpacity: 1,
                          },
                        },
                      },
                      colors: colors9,
                      dataLabels: {
                        enabled: false
                      },
                      series: [
                        {
                          name: '{$ProductName}', 
                          type: 'column',
                          data: [" . $TotalValueArr . "] 
                        }
                      ],
                      xaxis: {
                        categories: [". $MonthdateTemp ."],
                        title: {
                            text: 'Month',
                            style: {
                              fontSize:  '10 px',
                              fontWeight:  'normal',
                              fontFamily:  undefined,
                              color:  '#263238'
                            },
                          }
                      },
                      yaxis: [
                        {
                          axisTicks: {
                            show: true
                          },
                          axisBorder: {
                            show: true,
                            color: '#3f51b5'
                          },
                          labels: {
                            formatter: function (value) {
                              return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); ;
                            },
                            style: {
                              color: '#3f51b5'
                            }
                          },
                          title: {
                            text: '{$ProductName}',
                            style: {
                              fontSize:  '10 px',
                              fontWeight:  'normal',
                              fontFamily:  undefined,
                              color:  '#263238'
                            },
                          }
                        },
                        {
                          axisTicks: {
                            show: false
                          },
                          axisBorder: {
                            show: false,
                            color: '#FFA600'
                          },
                          labels: {
                            show: false,
                            style: {
                              color: '#FFA600'
                            }
                          }
                        }
                      ],
                      tooltip: {
                        followCursor: true,
                            y: {
                              formatter: function(y) {
                                if (typeof y !== 'undefined') {
                                  return y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); 
                                }
                                return y;
                              }
                            },
                            x: {
                                show:true,
                                formatter: function (value) {
                                  return value;
                                }
                              }
                      },
                      markers: {
                        size: 5,
                        hover: {
                          size: 9
                        }
                      }
                    };
                    
                    var chart = new ApexCharts(document.querySelector('#AppGraph{$DataSrc}'), options);
                    
                    chart.render();
                    
                    </script>
                    ";
        }
				

		//echo $FinalStr; 
		return $FinalStr; 
	}
	
	
	 public static function CommonApiClass($locationId,$datefilter1,$datefilter2,$DataSrc){
		self::Init(); 

		$FinalStr		= "";
		$AllArray       = array(); 
		$TempArr1       = array();
		$TempArr2       = array();

        
        $FromDate       = \api\apiClass::convertDate($datefilter1, "%Y-%m");
		$ToDate         = \api\apiClass::convertDate($datefilter2, "%Y-%m");
		

       
        $encodedAuth        = "TnpBd09qSTVZbVV6WW1aaFltSTNZMkkzTVRKaVl6a3dOMlU1TWpCak9EQmhaV1poOg==";
        $curl                = curl_init();
        $Url                = "https://api.realyse.com/v1/demographics/features";
        
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $Url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        //curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\"areaName\":\"London\",\"mode\":\"Postcode\" }" ); 
        curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\r\n  \"indicators\": [\r\n    {$DataSrc}\r\n  ],\r\n  \"dateFrom\": \"{$FromDate}\",\r\n  \"dateTo\": \"{$ToDate}\",\r\n  \"areaIds\": [\r\n    \"{$locationId}\"\r\n  ]\r\n}" ); 
         
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Basic ". $encodedAuth , 'Content-Type: text/plain'));

        //curl_setopt($ch, CURLOPT_HTTPHEADER,     array("Authorization: Basic ". $encodedAuth, 'Content-Type: text/plain')); 
        
        $response   = curl_exec ($ch);
        $err        = curl_error($curl);
        
        curl_close($curl);
        
  
        if ($err) {
          $RetArr = array(); 
            
        } else {
            
    
          $RetDecode = json_decode($response); 
          
          //echo "<pre>"; print_r($RetDecode); echo "</pre>";
         /// exit;
          
          $SuggestArr = array();
          
          $indicatorIdTemp  = "";
          $valueTemp        = "";
          
          
          
          foreach($RetDecode->data as $RetArr1){
              
                  $indicatorId             =  $RetArr1->indicatorId;
                  //$TempArr1["{$indicatorId}"]  =  $indicatorId;

                  $Value      =  $RetArr1->feature->v;
                  //$TempArr1["{$indicatorId}_Val"]  =  $Value;
                  
                  $MonthdateCnt        =  $RetArr1->dateTo;
                  //$Monthdate            = date('M-Y', $MonthdateCnt);
                
       
                 $AllArray[] = array("{$indicatorId}" => $indicatorId, "{$indicatorId}_Val" => $Value, "MonthDate" => $MonthdateCnt); 
          }
          
          
        }
  
		return $AllArray; 
	}
	
	
	 	
	//============================  Population Graph ====================
	
	public static function FeatureCommonApiUkValueAjax($GraphDetails,$locationId,$DataSrc,$datefilter1,$datefilter2,$m="0",$ProductName="",$graphpoint="D")
	{
	    
	  
		self::Init(); 

		$FinalStr		= "";
		$AllArray       = array(); 
		$TempArr1       = array();
		$TempArr2       = array();
	
		
		$FromDate       = \api\apiClass::convertDate($datefilter1, "%Y-%m");
		$ToDate         = \api\apiClass::convertDate($datefilter2, "%Y-%m");
		
		
		
	     $ApiReturnArr  =  \api\apiClass::CommonApiClass($locationId,$datefilter1,$datefilter2,$DataSrc); 
      // echo "<pre> hiii"; print_r($ApiReturnArr); echo "</pre>"; 
     //  exit;
        $i = 0;
        $TotalValueArr = "";
        $MonthValueArr = "";
        $TotAreaLeverage = 0;
        $TotDebtPerBuilding = 0;
        $TotMortgageLending = 0;
        $TotCreditScore = 0;
        $TotMeanIncome = 0;
        $TotHomelessnessCount = 0;
        $TotRepossessionsCount = 0;
        $TotUnemploymentLevel = 0;
        $TotViolentSexualCrimes = 0;
        $TotCrimesDishonesty = 0;
        $TotOtherCrimes = 0;
        $TotMortgageDebtPerCapital = 0;
        $TotBusStationsStops = 0;
        $TotNationalRailStations = 0;
        $TotDwellings = 0;
        $TotBroadbandSpeed = 0;
        $TotBroadbandSpeedArr = "";
        $TotMonthDetailArr ="";
        $TotMeanIncomeArr = "";
        $TotReportedCrimesArr = "";
        
        foreach($ApiReturnArr as $RsPap){
                
                    
                if ($RsPap["162"] == 162) { 
                
                    $AreaLeverage           = isset($RsPap["162_Val"]) ? $RsPap["162_Val"] : "0";
                   $TotAreaLeverage         = floatval($TotAreaLeverage) + floatval($AreaLeverage);
                   
                   //echo "TotAreaLeverageTop=". $TotAreaLeverage ."=AreaLeverage=". $AreaLeverage ."<br>";
                   
                   $i++;
                   
                   $MonthDate = isset($RsPap["MonthDate"]) ? $RsPap["MonthDate"] : "";
                   if($TotMonthDetailArr == ""){
                      $TotMonthDetailArr = $MonthDate;
                   }else{
                      $TotMonthDetailArr = $TotMonthDetailArr ."','". $MonthDate;
                   }
                   
                  
                }
                
                if ($RsPap["160"] == 160) { 
                
                    $DebtPerBuilding       = isset($RsPap["160_Val"]) ? $RsPap["160_Val"] : "0";
                    $TotDebtPerBuilding    = floatval($TotDebtPerBuilding) + floatval($DebtPerBuilding);
                  
                }
                
                
                 
                if ($RsPap["500"] == 500) { 
                
                    $MortgageLending       = isset($RsPap["500_Val"]) ? $RsPap["500_Val"] : "0";
                    $TotMortgageLending    = floatval($TotMortgageLending) + floatval($MortgageLending);
                    
                    //echo "TotMortgageLendingTop=". $TotMortgageLending ."=MortgageLending=". $MortgageLending ."<br>";
                  
                }
                
                 if ($RsPap["161"] == 161) { 
                
                    $MortgageDebtPerCapital       = isset($RsPap["161_Val"]) ? $RsPap["161_Val"] : "0";
                    $TotMortgageDebtPerCapital    = floatval($TotMortgageDebtPerCapital) + floatval($MortgageDebtPerCapital);
                  
                }
               
                
                if ($RsPap["163"] == 163) { 
                
                    $CreditScore       = isset($RsPap["163_Val"]) ? $RsPap["163_Val"] : "0";
                    $TotCreditScore    = floatval($TotCreditScore) + floatval($CreditScore);
                  
                }
                
                if ($RsPap["436"] == 436) { 
                
                    $MeanIncome       = isset($RsPap["436_Val"]) ? $RsPap["436_Val"] : "0";
                    $TotMeanIncome    = floatval($TotMeanIncome) + floatval($MeanIncome);
                  
                      if($TotMeanIncomeArr == ""){
                          $TotMeanIncomeArr = $MeanIncome;
                       }else{
                          $TotMeanIncomeArr = $TotMeanIncomeArr .",". $MeanIncome;
                       }
                }
                
                if ($RsPap["431"] == 431) { 
                
                    $HomelessnessCount       = isset($RsPap["431_Val"]) ? $RsPap["431_Val"] : "0";
                    $TotHomelessnessCount    = floatval($TotHomelessnessCount) + floatval($HomelessnessCount);
                  
                }
                
                if ($RsPap["433"] == 433) { 
                
                    $RepossessionsCount       = isset($RsPap["433_Val"]) ? $RsPap["433_Val"] : "0";
                    $TotRepossessionsCount    = floatval($TotRepossessionsCount) + floatval($RepossessionsCount);
                    
                }
                
                if ($RsPap["456"] == 456) { 
                
                    $UnemploymentLevel       = isset($RsPap["456_Val"]) ? $RsPap["456_Val"] : "0";
                    $TotUnemploymentLevel    = floatval($TotUnemploymentLevel) + floatval($UnemploymentLevel);
                     
                    //echo "TotUnemploymentLevel=". $TotUnemploymentLevel ."=UnemploymentLevel=". $UnemploymentLevel ."<br>";
                }
                
                if ($RsPap["496"] == 496) { 
                
                    $ViolentSexualCrimes       = isset($RsPap["496_Val"]) ? $RsPap["496_Val"] : "0";
                    $TotViolentSexualCrimes    = floatval($TotViolentSexualCrimes) + floatval($ViolentSexualCrimes);
                  
                }
                
                if ($RsPap["497"] == 497) { 
                
                    $CrimesDishonesty       = isset($RsPap["497_Val"]) ? $RsPap["497_Val"] : "0";
                    $TotCrimesDishonesty    = floatval($TotCrimesDishonesty) + floatval($CrimesDishonesty);
                  
                }
                
                if ($RsPap["498"] == 498) { 
                
                    $OtherCrimes       = isset($RsPap["498_Val"]) ? $RsPap["498_Val"] : "0";
                    $TotOtherCrimes    = floatval($TotOtherCrimes) + floatval($OtherCrimes);
                  
                }
             
                
                if ($RsPap["435"] == 435) { 
                
                    $BusStationsStops       = isset($RsPap["435_Val"]) ? $RsPap["435_Val"] : "0";
                    $TotBusStationsStops    = floatval($TotBusStationsStops) + floatval($BusStationsStops);
                  
                }
                
                if ($RsPap["432"] == 432) { 
                
                    $NationalRailStations       = isset($RsPap["432_Val"]) ? $RsPap["432_Val"] : "0";
                    $TotNationalRailStations    = floatval($TotNationalRailStations) + floatval($NationalRailStations);
                  
                }
                
                if ($RsPap["159"] == 159) { 
                
                    $Dwellings       = isset($RsPap["159_Val"]) ? $RsPap["159_Val"] : "0";
                    $TotDwellings    = floatval($TotDwellings) + floatval($Dwellings);
                  
                }
                
                if ($RsPap["428"] == 428) { 
                
                    $BroadbandSpeed       = isset($RsPap["428_Val"]) ? $RsPap["428_Val"] : "0";
                    $TotBroadbandSpeed    = floatval($TotBroadbandSpeed) + floatval($BroadbandSpeed);
                    
                    if($TotBroadbandSpeedArr == "" ){
                        
                        $TotBroadbandSpeedArr = $BroadbandSpeed;
                    }else{
                        
                        $TotBroadbandSpeedArr = $TotBroadbandSpeedArr.",".$BroadbandSpeed;
                    }
                  
                }
                
                if ($RsPap["434"] == 434) { 
                
                    $ReportedCrimes       = isset($RsPap["434_Val"]) ? $RsPap["434_Val"] : "0";
                    $TotReportedCrimes    = floatval($TotReportedCrimes) + floatval($ReportedCrimes);
                    
                    if($TotReportedCrimesArr == "" ){
                        
                        $TotReportedCrimesArr = $ReportedCrimes;
                    }else{
                        
                        $TotReportedCrimesArr = $TotReportedCrimesArr.",".$ReportedCrimes;
                    }
                  
                }
  
         }
         
        //echo "TotAreaLeverage=". $TotAreaLeverage ."=i=".$i."<br>";
         
        if($i >0)$TotAreaLeverage =  $TotAreaLeverage / $i ;
        if($i >0)$TotDebtPerBuilding=  $TotDebtPerBuilding / $i ;
        if($i >0)$TotMortgageLending=  $TotMortgageLending / $i ;
        if($i >0)$TotCreditScore=  $TotCreditScore / $i ;
        if($i >0)$TotMeanIncome=  $TotMeanIncome / $i ;
        if($i >0)$TotHomelessnessCount=  $TotHomelessnessCount / $i ;
        if($i >0)$TotRepossessionsCount=  $TotRepossessionsCount / $i ;
        if($i >0)$TotUnemploymentLevel=  $TotUnemploymentLevel / $i ;
        if($i >0)$TotViolentSexualCrimes=  $TotViolentSexualCrimes / $i ;
        if($i >0)$TotCrimesDishonesty=  $TotCrimesDishonesty / $i ;
        if($i >0)$TotOtherCrimes=  $TotOtherCrimes / $i ;
        if($i >0)$TotMortgageDebtPerCapital=  $TotMortgageDebtPerCapital / $i ;
        if($i >0)$TotBusStationsStops=  $TotBusStationsStops / $i ;
        if($i >0)$TotNationalRailStations=  $TotNationalRailStations / $i ;
        if($i >0)$TotDwellings=  $TotDwellings / $i ;
        if($i >0)$TotBroadbandSpeed=  $TotBroadbandSpeed / $i ;
        
        
        
         
          $AllArray[] = array( "AreaLeverage" => $TotAreaLeverage, 
                                "DebtPerBuilding" => $TotDebtPerBuilding, 
                                "MortgageLending"  => $TotMortgageLending, 
                                "CreditScore"  => $TotCreditScore, 
                                "MeanIncome"  => $TotMeanIncome, 
                                "HomelessnessCount"  => $TotHomelessnessCount, 
                                "RepossessionsCount"  => $TotRepossessionsCount, 
                                "UnemploymentLevel"  => $TotUnemploymentLevel, 
                                "ViolentSexualCrimes"  => $TotViolentSexualCrimes, 
                                "CrimesDishonesty"  => $TotCrimesDishonesty, 
                                "OtherCrimes"  => $TotOtherCrimes, 
                                "MortgageDebtPerCapital"  => $TotMortgageDebtPerCapital, 
                                "BusStationsStops"  => $TotBusStationsStops, 
                                "NationalRailStations"  => $TotNationalRailStations, 
                                "Dwellings"  => $TotDwellings, 
                                "BroadbandSpeed"  => $TotBroadbandSpeed,
                                "BroadbandSpeedGraph" => $TotBroadbandSpeedArr,
                                "MonthDetailGraph" => $TotMonthDetailArr,
                                "MeanIncomeGraph" => $TotMeanIncomeArr,
                                "ReportedCrimes" => $TotReportedCrimesArr
                                ); 
         /*
            $IndexQry = "SELECT auto_id, api_id, api_name, display_name,graphpoint FROM api_common_details WHERE api_id = '{$DataSrc}' ";
            
            $Rows = \DBConn\DBConnection::getQuery( $IndexQry );
                        
            foreach($Rows as $Row){
                
                $ProductName = $Row["display_name"];
                $graphpoint = $Row["graphpoint"];
            }
        */

      
    	
				

		//echo $FinalStr; 
		return $AllArray; 
	}
	
	
		//===============================================Product Feature Api Uk===================================================================================
    
        
    public static function ProductFeatureApiUkValueAjax($RetType,$LocationId,$datasource,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$Cnt){
		self::Init(); 


		$FinalStr		= "";
		$AllArray       = array(); 
		$TempArr1       = array();
		$TempArr2       = array();

		
        $FromDate       = \api\apiClass::convertDate($datefilter1, "%Y-%m");
		$ToDate         = \api\apiClass::convertDate($datefilter2, "%Y-%m");
		

		$MainKeyword = $LocationId;


        
        $encodedAuth        = "TnpBd09qSTVZbVV6WW1aaFltSTNZMkkzTVRKaVl6a3dOMlU1TWpCak9EQmhaV1poOg==";
        
        
        
        $curl                = curl_init();
        $Url                = "https://api.realyse.com/v1/data/features";
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $Url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        //curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\"areaName\":\"London\",\"mode\":\"Postcode\" }" ); 
        curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\n    \"areaIds\": [\n        \"{$MainKeyword}\"\n    ],\n    \"dataset\": {\n        \"bedrooms\":{$bedrooms},\n        \"dataSource\": \"{$BuildType}\",\n        \"propertyType\": \"{$propertyType}\"\n    },\n    \"dateFrom\": \"{$FromDate}\",\n    \"dateTo\": \"{$ToDate}\"\n}" ); 
         
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Basic ". $encodedAuth , 'Content-Type: text/plain'));

        //curl_setopt($ch, CURLOPT_HTTPHEADER,     array("Authorization: Basic ". $encodedAuth, 'Content-Type: text/plain')); 
        
        $response   = curl_exec ($ch);
        $err        = curl_error($curl);
        
        curl_close($curl);
        
  
        if ($err) {
          $RetArr = array(); 
            
        } else {
            
       //echo $response;
       //exit();
       
           //$response = arsort($response);
           
           /* $response = usort($response, function($a, $b) { //Sort the array using a user defined function
                return $a->date > $b->date ? -1 : 1; //Compare the scores
            });  
            */
           // $response = array_reverse($response);
            
           // echo "<pre>"; print_r($response); echo "</pre>";
            
          $RetDecode = json_decode($response); 
          
      
          
          
          $SuggestArr = array();
          

          $MonthdateTemp  = "" ;
          $sProductValTemp = "" ;
          foreach($RetDecode->data as $RetArr1){
              
                $MonthdateCnt        =  strtotime($RetArr1->date);
                $Monthdate            = date('M-Y', $MonthdateCnt);
                  
                if( $datasource == "Discnt" || $datasource="SalesOverView" ){
                    $sProductVal      =  $RetArr1->sDiscount->v;
                    $NinthPercentile  = $RetArr1->sDiscount->p90;
                    $UpperQuartile    = $RetArr1->sDiscount->p75;
                    $Median           = $RetArr1->sDiscount->v;
                    $LowerQuartile    = $RetArr1->sDiscount->p25;
                    $Supply           = $RetArr1->sDiscount->hr;
                    $ProductName      = "Average Discount (Sales)";
                    
                    $AllArray[] = array("datasource"=> "Discnt","MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
       
                }
                  
                if( $datasource == "GrsYld" || $datasource="SalesOverView" ){
                    $sProductVal      =  $RetArr1->yield->v;
                    $NinthPercentile  = $RetArr1->yield->p90;
                    $UpperQuartile    = $RetArr1->yield->p75;
                    $Median           = $RetArr1->yield->v;
                    $LowerQuartile    = $RetArr1->yield->p25;
                    $Supply           = $RetArr1->yield->hr;
                    $ProductName = "Average Gross Yield Per Month";
                    $AllArray[] = array("datasource"=> "GrsYld","MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
                }
                    
                if( $datasource == "PriAsk"){
                    $sProductVal      =  $RetArr1->sPriceAsked->v;
                    $NinthPercentile  = $RetArr1->sPriceAsked->p90;
                    $UpperQuartile    = $RetArr1->sPriceAsked->p75;
                    $Median           = $RetArr1->sPriceAsked->v;
                    $LowerQuartile    = $RetArr1->sPriceAsked->p25;
                    $Supply           = $RetArr1->sPriceAsked->hr;
                    $ProductName = "Average Asking Price (Sales)";
                    $AllArray[] = array("datasource"=> "PriAsk","MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
                }
                
                if( $datasource == "RentAsk"){
                    $sProductVal      =  $RetArr1->rRentAsked->v;
                    $NinthPercentile  = $RetArr1->rRentAsked->p90;
                    $UpperQuartile    = $RetArr1->rRentAsked->p75;
                    $Median           = $RetArr1->rRentAsked->v;
                    $LowerQuartile    = $RetArr1->rRentAsked->p25;
                    $Supply           = $RetArr1->rRentAsked->hr;
                    $ProductName = "Average Asking Monthly Rental";
                    $AllArray[] = array("datasource"=> "RentAsk","MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
                }
                    
                if( $datasource == "sqfiRent" || $datasource="SalesOverView" ){
                    $sProductVal      =  $RetArr1->rPricePerSqft->v;
                    $NinthPercentile  = $RetArr1->rPricePerSqft->p90;
                    $UpperQuartile    = $RetArr1->rPricePerSqft->p75;
                    $Median           = $RetArr1->rPricePerSqft->v;
                    $LowerQuartile    = $RetArr1->rPricePerSqft->p25;
                    $Supply           = $RetArr1->rPricePerSqft->hr;
                    $ProductName = "Average Annual Asking Rent £ per ft²";
                    $AllArray[] = array("datasource"=> "sqfiRent","MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
                }
                    
                if( $datasource == "sqfiSales" || $datasource="SalesOverView" ){
                    $sProductVal      =  $RetArr1->sPricePerSqft->v;
                    $NinthPercentile  = $RetArr1->sPricePerSqft->p90;
                    $UpperQuartile    = $RetArr1->sPricePerSqft->p75;
                    $Median           = $RetArr1->sPricePerSqft->v;
                    $LowerQuartile    = $RetArr1->sPricePerSqft->p25;
                    $Supply           = $RetArr1->sPricePerSqft->hr;
                    $ProductName = "Average Asking Price £ per ft² (Sales)";
                    $AllArray[] = array("datasource"=> "sqfiSales","MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
                }
                    
                if( $datasource == "PriPaid" || $datasource="SalesOverView" ){
                    $sProductVal      =  $RetArr1->sPricePaid->v;
                    $NinthPercentile  = $RetArr1->sPricePaid->p90;
                    $UpperQuartile    = $RetArr1->sPricePaid->p75;
                    $Median           = $RetArr1->sPricePaid->v;
                    $LowerQuartile    = $RetArr1->sPricePaid->p25;
                    $Supply           = $RetArr1->sPricePaid->hr;
                    $ProductName = "Average Price Paid (Sales)";
                    $AllArray[] = array("datasource"=> "PriPaid","MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
               
                }
                    
                if( $datasource == "DaysMarRent"){
                    $sProductVal      =  $RetArr1->rDaysOnMarket->v;
                    $NinthPercentile  = $RetArr1->rDaysOnMarket->p90;
                    $UpperQuartile    = $RetArr1->rDaysOnMarket->p75;
                    $Median           = $RetArr1->rDaysOnMarket->v;
                    $LowerQuartile    = $RetArr1->rDaysOnMarket->p25;
                    $Supply           = $RetArr1->rDaysOnMarket->hr;
                    $ProductName = "Average Days on Market (Rentals)";
                    $AllArray[] = array("datasource"=> "DaysMarRent","MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
               
                }
                    
                if( $datasource == "PropSize"){
                    $sProductVal      =  $RetArr1->sSize->v;
                    $NinthPercentile  = $RetArr1->sSize->p90;
                    $UpperQuartile    = $RetArr1->sSize->p75;
                    $Median           = $RetArr1->sSize->v;
                    $LowerQuartile    = $RetArr1->sSize->p25;
                    $Supply           = $RetArr1->sSize->hr;
                    $ProductName = "Average Area (Rentals)";
                    $AllArray[] = array("datasource"=> "PropSize","MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
               
                }
                    
                if( $datasource == "DaysMarSales" || $datasource="SalesOverView" )
                {
                    $sProductVal      =  $RetArr1->sDaysOnMarket->v;
                    $NinthPercentile  = $RetArr1->sDaysOnMarket->p90;
                    $UpperQuartile    = $RetArr1->sDaysOnMarket->p75;
                    $Median           = $RetArr1->sDaysOnMarket->v;
                    $LowerQuartile    = $RetArr1->sDaysOnMarket->p25;
                    $Supply           = $RetArr1->sDaysOnMarket->hr;
                    $ProductName = "Average days on Market (Sales)";
                    $AllArray[] = array("datasource"=> "DaysMarSales","MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
               
                }
                    
                if( $datasource == "RentList" || $datasource="SalesOverView" ){
                    $sProductVal      =  $RetArr1->rListings->v;
                    $NinthPercentile  = $RetArr1->rListings->p90;
                    $UpperQuartile    = $RetArr1->rListings->p75;
                    $Median           = $RetArr1->rListings->v;
                    $LowerQuartile    = $RetArr1->rListings->p25;
                    $Supply           = $RetArr1->rListings->hr;
                    $ProductName = "Rent Listing Month";
                    $AllArray[] = array("datasource"=> "RentList","MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
               
                }
                    
                if( $datasource == "NewRentList" || $datasource="SalesOverView" ){
                    $sProductVal      =  $RetArr1->rNewListings->v;
                    $NinthPercentile  = $RetArr1->rNewListings->p90;
                    $UpperQuartile    = $RetArr1->rNewListings->p75;
                    $Median           = $RetArr1->rNewListings->v;
                    $LowerQuartile    = $RetArr1->rNewListings->p25;
                    $Supply           = $RetArr1->rNewListings->hr;
                    $ProductName = "Number of new Rental Listing's per Month";
                    $AllArray[] = array("datasource"=> "NewRentList","MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
               
                }
                    
                if( $datasource == "SalesList" || $datasource="SalesOverView" ){
                    $sProductVal      =  $RetArr1->sListings->v;
                    $NinthPercentile  = $RetArr1->sListings->p90;
                    $UpperQuartile    = $RetArr1->sListings->p75;
                    $Median           = $RetArr1->sListings->v;
                    $LowerQuartile    = $RetArr1->sListings->p25;
                    $Supply           = $RetArr1->sListings->hr;
                    $ProductName = "Sales Listing";
                    $AllArray[] = array( "datasource"=> "SalesList" , "MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
               
                }
                    
                if( $datasource == "NewSalesList"){
                    $sProductVal      =  $RetArr1->sNewListings->v;
                    $NinthPercentile  = $RetArr1->sNewListings->p90;
                    $UpperQuartile    = $RetArr1->sNewListings->p75;
                    $Median           = $RetArr1->sNewListings->v;
                    $LowerQuartile    = $RetArr1->sNewListings->p25;
                    $Supply           = $RetArr1->sNewListings->hr;
                    $ProductName = "Number of new Sales Listing's per Month";
                    $AllArray[] = array( "datasource"=> "NewSalesList","MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
               
                }
                    
                if( $datasource == "SalesTrans" || $datasource="SalesOverView" ){
                    $sProductVal      =  $RetArr1->sTransactions->v;
                    $NinthPercentile  = $RetArr1->sTransactions->p90;
                    $UpperQuartile    = $RetArr1->sTransactions->p75;
                    $Median           = $RetArr1->sTransactions->v;
                    $LowerQuartile    = $RetArr1->sTransactions->p25;
                    $Supply           = $RetArr1->sTransactions->hr;
                    $ProductName = "Sales Transactions";
                    $AllArray[] = array( "datasource"=> "SalesTrans" , "MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
               
                }
                
                  
                 if ( $MonthdateTemp == "" ){
                     $MonthdateTemp = $Monthdate;
                 }else{
                     $MonthdateTemp = $Monthdate ."','". $MonthdateTemp ;
                 }
                 
                 if ( $sProductValTemp == "" ){
                     $sProductValTemp = $sProductVal;
                 }else{
                     $sProductValTemp = $sProductVal .",". $sProductValTemp ;
                 }
                 
                  
                // $AllArray[] = array("MonthYr" => $Monthdate, "NinthPercentile" => $NinthPercentile , "UpperQuartile" => $UpperQuartile , "Median" => $Median , "LowerQuartile" => $LowerQuartile , "Supply" => $Supply ); 
          }
          
          
        }
        //echo $Cnt;
        //echo $MonthdateTemp;
       // echo $sPricePaidTemp;
        //exit();
        
         //echo "<pre>"; print_r($AllArray); echo "</pre>";
         //exit;
        //echo 'dcml='. $dcml . '<br>';
        
        $MonthdateTemp = "'" . $MonthdateTemp . "'"; 
        

        $FinalStr ="<script>
                            var options = {
                              series: [{
                                name: '" .$ProductName. "',
                                data: [". $sProductValTemp ."]
                            }],
                              chart: {
                              height: 350,
                              type: 'line',
                              zoom: {
                                enabled: false
                              }
                            },
                            dataLabels: {
                              enabled: false
                            },
                            stroke: {
                              curve: 'straight'
                            },
                            title: {
                              text: '',
                              align: 'left'
                            },
                            grid: {
                              row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                              },
                            },
                            yaxis: {
                              type: 'numeric',
                              title: {
                                text: '{$ProductName}',
                                style: {
                                  fontSize:  '18px',
                                  fontWeight:  'bold',
                                  fontFamily:  undefined,
                                  color:  '#263238'
                                },
                              },
                              labels: {
                                show:true,
                                formatter: function (value) {
                                  return '£ '+ value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                                }
                              },
                    
                            },
                            xaxis: {
                              categories: [". $MonthdateTemp . "],
                                title: {
                                    text: 'Month',
                                    style: {
                                      fontSize:  '10 px',
                                      fontWeight:  'normal',
                                      fontFamily:  undefined,
                                      color:  '#263238'
                                    },
                                  }
                            }, 
                            tooltip: {
                               y: {
                                  formatter: function(y) {
                                    if (typeof y !== 'undefined') {
                                      return '£ '+ y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                                    }
                                    return y;
                                  }
                                }
                            }
                            };
                    
                            var chart = new ApexCharts(document.querySelector('#chart{$Cnt}'), options);
                            chart.render(); 
                            
                            </script>
                        ";
                  //echo $Cnt     ; 
                        
        if ($RetType == "formap"){
            
		    return $FinalStr; 
        }
        else{
            return $AllArray; 
        }
        
		
	}
	
	
	
	//============================  Population Graph ====================
	
	
		//===============================================New===================================================================================
    
        //("FORDET",$LOCATIONID,$COUNTRYLNG,$COUNTRYLAT,$CENTERPOINT1,$CENTERPOINT2,$DATEFILTER1,$DATEFILTER2);
    public static function PropertyImageAjax($RetType,$LocationId,$CountryLng,$CountryLat,$CenterPoint1,$CenterPoint2,$datefilter1,$datefilter2){
		self::Init(); 

        
		$FinalStr		= "";
		$AllArray       = array(); 
		$TempArr1       = array();
		$TempArr2       = array();

		
        $FromDate       = \api\apiClass::convertDate($datefilter1, "%Y-%m-%d");
		$ToDate         = \api\apiClass::convertDate($datefilter2, "%Y-%m-%d");
		


		$MainKeyword = $LocationId;
        
        /*
        $ApiReturnArr  =  \api\apiClass::suburbUK($LocationId,$Cnt); 
        foreach($ApiReturnArr as $RsArr){
                    $ArrType = $RsArr["type"];
                    $Arrcountrylng = $RsArr["countrylng"];
                    $Arrcountrylat = $RsArr["countrylat"];
                    $Arrcountrylng1 = $RsArr["countrylng1"];
                    $Arrcountrylat1 = $RsArr["countrylat1"];
                    $Arrcountrylng2 = $RsArr["countrylng2"];
                    $Arrcountrylat2 = $RsArr["countrylat2"];
                    $Arrcountrylng3 = $RsArr["countrylng3"];
                    $Arrcountrylat3 = $RsArr["countrylat3"];
                    $Arrcountrylng4 = $RsArr["countrylng4"];
                    $Arrcountrylat4 = $RsArr["countrylat4"];
                    
         }
         
         //exit;
        echo $FromDate."<br>";
        echo $ToDate."<br>";
        echo $CountryLng."<br>";
        echo $CountryLat."<br>";
        echo $CenterPoint1."<br>";
        echo $CenterPoint2."<br>";
       */
        
        $encodedAuth        = "TnpBd09qSTVZbVV6WW1aaFltSTNZMkkzTVRKaVl6a3dOMlU1TWpCak9EQmhaV1poOg==";
        
        
        
        $curl                = curl_init();
        $Url                = "https://api.realyse.com/v1/comparables/transactions";
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $Url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        
 
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n    \"geometries\": {\n\"type\": \"Feature\",\n\"geometry\": {\n    \"type\": \"Polygon\",\n    \"coordinates\": [\n[\n    \n    [\n{$CountryLng},\n{$CountryLat}\n    ],   \n    [\n{$CenterPoint1},\n{$CenterPoint2}\n    ]\n]\n    ]\n}\n    },\n    \"dateFrom\": \"{$FromDate}\",\n    \"dateTo\": \"{$ToDate}\",\n    \"indicatorCategory\": \"soldPrice\",\n    \"indicatorRangeValue\": [\n10000,\n50000000\n    ],\n    \"propertyType\": null,\n    \"propertyFeatures\": null,\n    \"bedrooms\": null,\n    \"dataSource\": \"STANDARD\",\n    \"limit\": 5,\n    \"offset\": 0\n}" ); 
       
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Basic ". $encodedAuth , 'Content-Type: text/plain'));

        
        $response   = curl_exec ($ch);
        $err        = curl_error($curl);
        
        curl_close($curl);
        
  
        if ($err) {
          $RetArr = array(); 
            
        } else {
       
            
          $RetDecode = json_decode($response); 
          
        
          
         // echo '<pre>'; print_r($RetDecode); echo '</pre>';
          //exit;
        
         $IsValCmg = 0;
  
          
          $SuggestArr = array();

          $MonthdateTemp  = "" ;
          $sProductValTemp = "" ;
          foreach($RetDecode->data as $RetArr1){
              
                $address            =  $RetArr1->address;
                $askingPrice        =  $RetArr1->askingPrice;
                $askingPriceSqft    =  $RetArr1->askingPriceSqft;
                $askingRent         =  $RetArr1->askingRent;
                $askingRentSqft     =  $RetArr1->askingRentSqft;
                $bedRooms           =  $RetArr1->bedRooms ? $RetArr1->bedRooms : "1";
                $bathRooms          =  $RetArr1->bathRooms ? $RetArr1->bathRooms : "1";
                $dateAppeared       =  $RetArr1->dateAppeared;
                $dateRemoved        =  $RetArr1->dateRemoved;
                $dateSold           =  $RetArr1->dateSold;
                $ownership          =  $RetArr1->ownership;
                $estimatedPrice     =  $RetArr1->estimatedPrice;
                $estimatedRent      =  $RetArr1->estimatedRent;
                $images             =  $RetArr1->images[0] ? $RetArr1->images[0] : "";
                $latitude           =  $RetArr1->latitude ? $RetArr1->latitude : "";
                $longitude          =  $RetArr1->longitude ? $RetArr1->longitude : "";
                $postcode           =  $RetArr1->postcode ? $RetArr1->postcode : "";
                $rentalYield        =  $RetArr1->rentalYield ? $RetArr1->rentalYield : "";
                $size               =  $RetArr1->size ? $RetArr1->size : "";
                $soldPrice          =  $RetArr1->soldPrice ? $RetArr1->soldPrice : "";
                $soldPriceSqft      =  $RetArr1->soldPriceSqft ? $RetArr1->soldPriceSqft : "";
                $value              =  $RetArr1->value ? $RetArr1->value : "";
                $agentName          =  $RetArr1->agentName ? $RetArr1->agentName : "";
                $agentAddress       =  $RetArr1->agentAddress ? $RetArr1->agentAddress : "";
                $description        =  $RetArr1->description ? $RetArr1->description : "";
                
                /* 
                if($dateAppeared !="" )
                    $dateAppeared   = date('Y-M-d', $dateAppeared);
                    
                if($dateRemoved !="" )
                    $dateRemoved   = date('Y-M-d', $dateRemoved);
                    
                if($dateSold !="" )
                    $dateSold   = date('Y-M-d', $dateSold);
                */
                  
                $AllArray[] = array("address" => $address, 
                                    "askingPrice" => $askingPrice ,
                                    "askingPriceSqft" => $askingPriceSqft ,
                                    "askingRent" => $askingRent , 
                                    "askingRentSqft" => $askingRentSqft , 
                                    "bedRooms" => $bedRooms , 
                                    "bathRooms" => $bathRooms,
                                    "dateAppeared" => $dateAppeared ,
                                    "dateRemoved" => $dateRemoved ,
                                    "dateSold" => $dateSold ,
                                    "ownership" => $ownership ,
                                    "estimatedPrice" => $estimatedPrice ,
                                    "estimatedRent" => $estimatedRent ,
                                    "images" => $images ,
                                    "latitude" => $latitude ,
                                    "longitude" => $longitude ,
                                    "postcode" => $postcode ,
                                    "rentalYield" => $rentalYield ,
                                    "size" => $size ,
                                    "soldPrice" => $soldPrice ,
                                    "soldPriceSqft" => $soldPriceSqft ,
                                    "value" => $value,
                                    "agentName" => $agentName,
                                    "agentAddress" => $agentAddress,
                                    "description" => $description
                                    ); 
                                    
                                    
                $IsValCmg = 1;
          }
          
          
        }
        
        
     //echo '<pre>'; print_r($AllArray); echo '</pre>';
      //    exit;
      
      
       if ( $IsValCmg == 1)
            return $AllArray; 
       else
            return ""; 
       
        
		
	}
	public static function suburbUK($LocationId,$Subrub){
        self::Init();
        
        $MainKeyword = $Subrub;
        
        $encodedAuth        = "TnpBd09qSTVZbVV6WW1aaFltSTNZMkkzTVRKaVl6a3dOMlU1TWpCak9EQmhaV1poOg==";
        $curl                = curl_init();
        $Url                = "https://api.realyse.com/v1/geometry/addresses";
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $Url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS,     "{\"areaName\":\"{$MainKeyword}\",\"mode\":\"Council\" }" ); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Basic ". $encodedAuth , 'Content-Type: text/plain'));

        $response   =curl_exec ($ch);
        $err        = curl_error($curl);
        
        curl_close($curl);
        
  
        if ($err) {
          $RetArr = array(); 
            
        } else {
     
          $RetDecode = json_decode($response); 
          
          //echo '<pre>'; print_r($RetDecode); echo '</pre>';
          //exit;
          
          $SuggestArr = array();
          
          foreach($RetDecode->data as $RetArr1){
              
              
              if($LocationId==$RetArr1->name)
              {
                  $CountryLng1 = isset($RetArr1->geometry->geometry->coordinates[0][0][0][0]) ? $RetArr1->geometry->geometry->coordinates[0][0][0][0] : 0; 
                  $CountryLat1 = isset($RetArr1->geometry->geometry->coordinates[0][0][0][1]) ? $RetArr1->geometry->geometry->coordinates[0][0][0][1] : 0; 
                  $CountryLng2 = isset($RetArr1->geometry->geometry->coordinates[0][0][1][0]) ? $RetArr1->geometry->geometry->coordinates[0][0][1][0] : 0; 
                  $CountryLat2 = isset($RetArr1->geometry->geometry->coordinates[0][0][1][1]) ? $RetArr1->geometry->geometry->coordinates[0][0][1][1] : 0; 
                  $CountryLng3 = isset($RetArr1->geometry->geometry->coordinates[0][0][2][0]) ? $RetArr1->geometry->geometry->coordinates[0][0][2][0] : 0; 
                  $CountryLat3 = isset($RetArr1->geometry->geometry->coordinates[0][0][2][1]) ? $RetArr1->geometry->geometry->coordinates[0][0][2][1] : 0; 
                  $CountryLng4 = isset($RetArr1->geometry->geometry->coordinates[0][0][3][0]) ? $RetArr1->geometry->geometry->coordinates[0][0][3][0] : 0; 
                  $CountryLat4 = isset($RetArr1->geometry->geometry->coordinates[0][0][3][1]) ? $RetArr1->geometry->geometry->coordinates[0][0][3][1] : 0; 
                  $CountryLng5 = isset($RetArr1->geometry->geometry->coordinates[0][0][4][0]) ? $RetArr1->geometry->geometry->coordinates[0][0][4][0] : 0; 
                  $CountryLat5 = isset($RetArr1->geometry->geometry->coordinates[0][0][4][1]) ? $RetArr1->geometry->geometry->coordinates[0][0][4][1] : 0; 
              $RetArr[] = array( "localityId"   => $RetArr1->name, 
                                 "type"         => $RetArr1->geometry->geometry->type,
                                 "suggestion"   => $RetArr1->areaName, 
                                 "countrylng"   => $CountryLng1, 
                                 "countrylat"   => $CountryLat1,
                                 "countrylng1"   => $CountryLng2, 
                                 "countrylat1"   => $CountryLat2,
                                 "countrylng2"   => $CountryLng3, 
                                 "countrylat2"   => $CountryLat3,
                                 "countrylng3"   => $CountryLng4, 
                                 "countrylat3"   => $CountryLat4,
                                 "countrylng4"   => $CountryLng5, 
                                 "countrylat4"   => $CountryLat5 
                                );
              }
              
          }
          
        }
        //echo '<br>Ghouse<pre>'; print_r($RetArr); echo '</pre>';
        //header('Content-Type: application/json');
        //echo json_encode($RetArr); 
        
        return $RetArr;
        
    }
	
	
	//============================  Population Graph ====================
	
    //============================  RECENT MEDIAN SALE PRICES ====================

	    
    public static function RentalStatisticsApiAjax($LocationId,$StreetId,$ZipcodeId,$Subrub,$propertyTypeId,$Metrics,$countryId){
		self::Init(); 


        $TempMedianData = self::GetMedianPriceApiDatas("forTbl",$LocationId,"8",$propertyTypeId,"2010-01-01","2020-02-20",$Metrics,"12");

		return $TempMedianData; 
	}
	
	
	//============================  Population Graph ====================
	
	//============================  Overview Sales Rent Start ====================
	public static function OverviewSalesRentAjax(){
	    

             ob_flush(); flush();
             $OverViewDataSrc="SalesOverView";
             
             $TempArr = array();
             $TempSalesListArr = array();
             
            // $RetArr = array(); 
           
             $LocationId        = $_REQUEST["LocationId"]       ?    $_REQUEST["LocationId"] : "";
             $OverViewDataSrc   = $_REQUEST["OverViewDataSrc"]  ?    $_REQUEST["OverViewDataSrc"] : "";
             $BuildType         = $_REQUEST["BuildType"]        ?    $_REQUEST["BuildType"] : "";
             $bedrooms          = $_REQUEST["bedrooms"]         ?    $_REQUEST["bedrooms"] : "";
             $propertyType      = $_REQUEST["propertyType"]     ?    $_REQUEST["propertyType"] : "";
             $datefilter1       = $_REQUEST["datefilter1"]      ?    $_REQUEST["datefilter1"] : "";
             $datefilter2       = $_REQUEST["datefilter2"]      ?    $_REQUEST["datefilter2"] : "";

             $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValueAjax("forDet",$LocationId,$OverViewDataSrc,$BuildType,$bedrooms,$propertyType,$datefilter1,$datefilter2,$m);
            
             $TotalPriPaid = 0;
             $TotalsqfiSales = 0;
             $TotalDiscnt = 0;
             $TotalGrsYld = 0;
             $TotalSalesList = 0;
             $TotalSalesTrans = 0;
             $TotalsqfiRent = 0;
             $TotalRentList = 0;
             $TotalDaysMarSales = 0;
             $TotalDaysMarSalesGraph = "";
             $TotalGraphPricePaid = "";
             $MonthdateTemp = "";
             $TotalSalesListGraph = "";
             $m = 0;
             foreach($productDetailsArr as $RsPD){
                 
                  $DatasourcePoint           = isset($RsPD["datasource"]) ? $RsPD["datasource"] : "0"; 
                  
                  $DataMonthYr               = isset($RsPD["MonthYr"]) ? $RsPD["MonthYr"] : ""; 
               
                   
                   
                  
                  if($DatasourcePoint == "PriPaid" ){
                       $MedianPriPaid         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalPriPaid          = floatval($TotalPriPaid) + floatval($MedianPriPaid);
                       $m++;
                       
                       if ( $TotalGraphPricePaid == "" )
                        {
                            $TotalGraphPricePaid = round($MedianPriPaid);
                        }
                        else
                        {
                            $TotalGraphPricePaid = round($MedianPriPaid). "," .$TotalGraphPricePaid;
                        }
                        
                        if ( $MonthdateTemp == "" ){
                             $MonthdateTemp = $DataMonthYr;
                        }else{
                             $MonthdateTemp = $DataMonthYr ."','". $MonthdateTemp ;
                        }
                  }
                  
                  if($DatasourcePoint == "sqfiSales" ){
                       $MediansqfiSales         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalsqfiSales          = floatval($TotalsqfiSales) + floatval($MediansqfiSales);
                  }
                  
                  if($DatasourcePoint == "Discnt" ){
                       $MedianDiscnt         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalDiscnt          = floatval($TotalDiscnt) + floatval($MedianDiscnt);
                  }
                  
                  if($DatasourcePoint == "GrsYld" ){
                       $MedianGrsYld         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalGrsYld          = floatval($TotalGrsYld) + floatval($MedianGrsYld);
                  }
                  
                  if($DatasourcePoint == "SalesList" ){
                       $MedianSalesList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalSalesList          = floatval($TotalSalesList) + floatval($MedianSalesList);
                       
                        if ( $TotalSalesListGraph == "" )
                        {
                            $TotalSalesListGraph = round($MedianSalesList);
                        }
                        else
                        {
                            $TotalSalesListGraph = round($MedianSalesList). "," .$TotalSalesListGraph;
                        }
                        
                        
                          
                       $NinthPercentileSales    = isset($RsPD["NinthPercentile"]) ? $RsPD["NinthPercentile"] : "0";
                       $UpperQuartileSales      = isset($RsPD["UpperQuartile"]) ? $RsPD["UpperQuartile"] : "0";
                       $LowerQuartileSales      = isset($RsPD["LowerQuartile"]) ? $RsPD["LowerQuartile"] : "0";
                       $SupplySales             = isset($RsPD["Supply"]) ? $RsPD["Supply"] : "0";
                       
                       $TempSalesListArr[] = array(  
                                            "MonthDate_".$m => $DataMonthYr,
                                            "NinthPercentile_".$m => $NinthPercentileSales, 
                                            "UpperQuartile_".$m => $UpperQuartileSales , 
                                            "LowerQuartile_".$m => $LowerQuartileSales , 
                                            "Supply_".$m => $SupplySales , 
                                            "Median_".$m => $MedianDaysMarSales  
                                        ); 
                  }
                  
                  if($DatasourcePoint == "SalesTrans" ){
                       $MedianSalesTrans         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalSalesTrans          = floatval($TotalSalesTrans) + floatval($MedianSalesTrans);
                  }
                 
                 if($DatasourcePoint == "sqfiRent" ){
                       $MediansqfiRent         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalsqfiRent          = floatval($TotalsqfiRent) + floatval($MediansqfiRent);
                  }
                  
                  if($DatasourcePoint == "RentList" ){
                       $MedianRentList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalRentList        = floatval($TotalRentList) + floatval($MedianRentList);
                  }
                  
                  if($DatasourcePoint == "DaysMarSales" ){
                       $MedianDaysMarSales   = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalDaysMarSales   = floatval($TotalDaysMarSales) + floatval($MedianDaysMarSales);
                       
                       $NinthPercentileSales    = isset($RsPD["NinthPercentile"]) ? $RsPD["NinthPercentile"] : "0";
                       $UpperQuartileSales      = isset($RsPD["UpperQuartile"]) ? $RsPD["UpperQuartile"] : "0";
                       $LowerQuartileSales      = isset($RsPD["LowerQuartile"]) ? $RsPD["LowerQuartile"] : "0";
                       $SupplySales             = isset($RsPD["Supply"]) ? $RsPD["Supply"] : "0";
                       
                       $TempArr[] = array(  
                                            "MonthDate_".$m => $DataMonthYr,
                                            "NinthPercentile_".$m => $NinthPercentileSales, 
                                            "UpperQuartile_".$m => $UpperQuartileSales , 
                                            "LowerQuartile_".$m => $LowerQuartileSales , 
                                            "Supply_".$m => $SupplySales , 
                                            "Median_".$m => $MedianDaysMarSales  
                                        ); 
                
                       
                        if ( $TotalDaysMarSalesGraph == "" )
                        {
                            $TotalDaysMarSalesGraph = round($MedianDaysMarSales);
                        }
                        else
                        {
                            $TotalDaysMarSalesGraph = round($MedianDaysMarSales). "," .$TotalDaysMarSalesGraph;
                        }
                  }
                  
              
                  
                  
             }
             
             $PricePaid             =  $TotalPriPaid / $m;
             $scift                 =  $TotalsqfiSales / $m;
             $PaidDiscount          =  $TotalDiscnt / $m;
             $GrossYield            =  $TotalGrsYld / $m;
             $SalesListing          =  $TotalSalesList / $m;
             $SalesTransactions     =  $TotalSalesTrans / $m;
             $sqfiRent              =  $TotalsqfiRent / $m;
             $RentList              =  $TotalRentList / $m;
             
             $TempEachArr           = $TempArr;
             $TempSalesList         = $TempSalesListArr;
             
             ob_flush(); flush();
             
              
             
             //PriPaid,sqfiSales,Discnt,GrsYld,SalesList,SalesTrans
             
             $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValueAjax("forDet",$LocationId,$OverViewDataSrc,$BuildType,1,$propertyType,$datefilter1,$datefilter2,$m);
            
             $TotalPriPaidBd1 = 0;
             $TotalsqfiSalesBd1 = 0;
             $TotalDiscntBd1 = 0;
             $TotalGrsYldBd1 = 0;
             $TotalSalesListBd1 = 0;
             $TotalSalesTransBd1 = 0;
             $TotalsqfiRentBd1 = 0;
             $TotalRentListBd1 = 0;
             $TotalGraphPricePaid1 = "";
             $n = 0;
             foreach($productDetailsArr as $RsPD){
                 
                  $DatasourcePoint           = isset($RsPD["datasource"]) ? $RsPD["datasource"] : "0"; 
                  
                  if($DatasourcePoint == "PriPaid" ){
                       $MedianPriPaid         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalPriPaidBd1          = floatval($TotalPriPaidBd1) + floatval($MedianPriPaid);
                       $n++;
                       
                        if ( $TotalGraphPricePaid1 == "" )
                        {
                            $TotalGraphPricePaid1 = round($MedianPriPaid);
                        }
                        else
                        {
                            $TotalGraphPricePaid1 =  $TotalGraphPricePaid1. "," .round($MedianPriPaid);
                        }
                        
                  }
                  
                  if($DatasourcePoint == "sqfiSales" ){
                       $MediansqfiSales         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalsqfiSalesBd1          = floatval($TotalsqfiSalesBd1) + floatval($MediansqfiSales);
                  }
                  
                  if($DatasourcePoint == "sqfiRent" ){
                       $MediansqfiRent         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalsqfiRentBd1          = floatval($TotalsqfiRentBd1) + floatval($MediansqfiRent);
                  }
                 
                  if($DatasourcePoint == "Discnt" ){
                       $MedianDiscnt         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalDiscntBd1          = floatval($TotalDiscntBd1) + floatval($MedianDiscnt);
                  }
                  
                  if($DatasourcePoint == "GrsYld" ){
                       $MedianGrsYld         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalGrsYldBd1          = floatval($TotalGrsYldBd1) + floatval($MedianGrsYld);
                  }
                  
                  if($DatasourcePoint == "SalesList" ){
                       $MedianSalesList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalSalesListBd1          = floatval($TotalSalesListBd1) + floatval($MedianSalesList);
                  }
                  
                  if($DatasourcePoint == "RentList" ){
                       $MedianRentList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalRentListBd1    = floatval($TotalRentListBd1) + floatval($MedianRentList);
                  }
                  
                  
                  if($DatasourcePoint == "SalesTrans" ){
                       $MedianSalesTrans         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalSalesTransBd1          = floatval($TotalSalesTransBd1) + floatval($MedianSalesTrans);
                  }
                 
             }
             
            
            
             
             $PricePaidBd1             =  $TotalPriPaidBd1 / $n;
             $sciftBd1                 =  $TotalsqfiSalesBd1 / $n;
             $PaidDiscountBd1          =  $TotalDiscntBd1 / $n;
             $GrossYieldBd1            =  $TotalGrsYldBd1 / $n;
             $SalesListingBd1          =  $TotalSalesListBd1 / $n;
             $SalesTransactionsBd1     =  $TotalSalesTransBd1 / $n;
             $sqfiRentBd1              =  $TotalsqfiRentBd1 / $n;
             $RentListBd1              =  $TotalRentListBd1 / $n;
             

             
             ob_flush(); flush();
             
               //PriPaid,sqfiSales,Discnt,GrsYld,SalesList,SalesTrans
             
             $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValueAjax("forDet",$LocationId,$OverViewDataSrc,$BuildType,2,$propertyType,$datefilter1,$datefilter2,$m);
            
             $TotalPriPaidBd2 = 0;
             $TotalsqfiSalesBd2 = 0;
             $TotalDiscntBd2 = 0;
             $TotalGrsYldBd2 = 0;
             $TotalSalesListBd2 = 0;
             $TotalSalesTransBd2 = 0;
             $TotalsqfiRentBd2 = 0;
             $TotalRentListBd2 = 0;
             $TotalGraphPricePaid2 = "";
             $n = 0;
             foreach($productDetailsArr as $RsPD){
                 
                  $DatasourcePoint           = isset($RsPD["datasource"]) ? $RsPD["datasource"] : "0"; 
                  
                  if($DatasourcePoint == "PriPaid" ){
                       $MedianPriPaid         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalPriPaidBd2          = floatval($TotalPriPaidBd2) + floatval($MedianPriPaid);
                       $n++;
                       
                       if ( $TotalGraphPricePaid2 == "" )
                        {
                            $TotalGraphPricePaid2 = round($MedianPriPaid);
                        }
                        else
                        {
                            $TotalGraphPricePaid2 = $TotalGraphPricePaid2. "," .round($MedianPriPaid) ;
                        }
                  }
                  
                  if($DatasourcePoint == "sqfiSales" ){
                       $MediansqfiSales         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalsqfiSalesBd2          = floatval($TotalsqfiSalesBd2) + floatval($MediansqfiSales);
                  }
                  
                  if($DatasourcePoint == "Discnt" ){
                       $MedianDiscnt         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalDiscntBd2          = floatval($TotalDiscntBd2) + floatval($MedianDiscnt);
                  }
                  
                  if($DatasourcePoint == "GrsYld" ){
                       $MedianGrsYld         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalGrsYldBd2          = floatval($TotalGrsYldBd2) + floatval($MedianGrsYld);
                  }
                  
                  if($DatasourcePoint == "SalesList" ){
                       $MedianSalesList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalSalesListBd2          = floatval($TotalSalesListBd2) + floatval($MedianSalesList);
                  }
                  
                  if($DatasourcePoint == "SalesTrans" ){
                       $MedianSalesTrans         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalSalesTransBd2          = floatval($TotalSalesTransBd2) + floatval($MedianSalesTrans);
                  }
                  
                  if($DatasourcePoint == "sqfiRent" ){
                       $MediansqfiRent         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalsqfiRentBd2        = floatval($TotalsqfiRentBd2) + floatval($MediansqfiRent);
                  }
                  
                  if($DatasourcePoint == "RentList" ){
                       $MedianRentList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalRentListBd2        = floatval($TotalRentListBd2) + floatval($MedianRentList);
                  }
                 
             }
             
             $PricePaidBd2             =  $TotalPriPaidBd2 / $n;
             $sciftBd2                 =  $TotalsqfiSalesBd2 / $n;
             $PaidDiscountBd2          =  $TotalDiscntBd2 / $n;
             $GrossYieldBd2            =  $TotalGrsYldBd2 / $n;
             $SalesListingBd2          =  $TotalSalesListBd2 / $n;
             $SalesTransactionsBd2     =  $TotalSalesTransBd2 / $n;
             $sqfiRentBd2              =  $TotalsqfiRentBd2 / $n;
             $RentListBd2              =  $TotalRentListBd2 / $n;
             
             ob_flush(); flush();
             
             
              //PriPaid,sqfiSales,Discnt,GrsYld,SalesList,SalesTrans
             
             $productDetailsArr  =  \api\apiClass::ProductFeatureApiUkValueAjax("forDet",$LocationId,$OverViewDataSrc,$BuildType,3,$propertyType,$datefilter1,$datefilter2,$m);
            
             $TotalPriPaidBd3 = 0;
             $TotalsqfiSalesBd3 = 0;
             $TotalDiscntBd3 = 0;
             $TotalGrsYldBd3 = 0;
             $TotalSalesListBd3 = 0;
             $TotalSalesTransBd3 = 0;
             $TotalsqfiRentBd3 = 0;
             $TotalRentListBd3 = 0;
             $TotalGraphPricePaid3 = "";
             $n = 0;
             foreach($productDetailsArr as $RsPD){
                 
                  $DatasourcePoint           = isset($RsPD["datasource"]) ? $RsPD["datasource"] : "0"; 
                  
                  if($DatasourcePoint == "PriPaid" ){
                       $MedianPriPaid         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalPriPaidBd3          = floatval($TotalPriPaidBd3) + floatval($MedianPriPaid);
                       $n++;
                       
                       if ( $TotalGraphPricePaid3 == "" )
                        {
                            $TotalGraphPricePaid3 = round($MedianPriPaid);
                        }
                        else
                        {
                            $TotalGraphPricePaid3 = round($MedianPriPaid). "," . $TotalGraphPricePaid3;
                        }
                  }
                  
                  if($DatasourcePoint == "sqfiSales" ){
                       $MediansqfiSales         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalsqfiSalesBd3          = floatval($TotalsqfiSalesBd3) + floatval($MediansqfiSales);
                  }
                  
                  if($DatasourcePoint == "Discnt" ){
                       $MedianDiscnt         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalDiscntBd3          = floatval($TotalDiscntBd3) + floatval($MedianDiscnt);
                  }
                  
                  if($DatasourcePoint == "GrsYld" ){
                       $MedianGrsYld         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalGrsYldBd3          = floatval($TotalGrsYldBd3) + floatval($MedianGrsYld);
                  }
                  
                  if($DatasourcePoint == "SalesList" ){
                       $MedianSalesList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalSalesListBd3          = floatval($TotalSalesListBd3) + floatval($MedianSalesList);
                  }
                  
                  if($DatasourcePoint == "SalesTrans" ){
                       $MedianSalesTrans         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalSalesTransBd3          = floatval($TotalSalesTransBd3) + floatval($MedianSalesTrans);
                  }
                  
                   if($DatasourcePoint == "sqfiRent" ){
                       $MediansqfiRent         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalsqfiRentBd3        = floatval($TotalsqfiRentBd3) + floatval($MediansqfiRent);
                  }
                  
                  if($DatasourcePoint == "RentList" ){
                       $MedianRentList         = isset($RsPD["Median"]) ? $RsPD["Median"] : "0";
                       $TotalRentListBd3        = floatval($TotalRentListBd3) + floatval($MedianRentList);
                  }
                 
             }
             
             $PricePaidBd3             =  $TotalPriPaidBd3 / $n;
             $sciftBd3                 =  $TotalsqfiSalesBd3 / $n;
             $PaidDiscountBd3          =  $TotalDiscntBd3 / $n;
             $GrossYieldBd3            =  $TotalGrsYldBd3 / $n;
             $SalesListingBd3          =  $TotalSalesListBd3 / $n;
             $SalesTransactionsBd3     =  $TotalSalesTransBd3 / $n;
             $sqfiRentBd3              =  $TotalsqfiRentBd3 / $n;
             $RentListBd3              =  $TotalRentListBd3 / $n;
             ob_flush(); flush(); 
             
        
             $PricePaidBd1             =  $TotalPriPaidBd1 / $n;
             $sciftBd1                 =  $TotalsqfiSalesBd1 / $n;
             $PaidDiscountBd1          =  $TotalDiscntBd1 / $n;
             $GrossYieldBd1            =  $TotalGrsYldBd1 / $n;
             $SalesListingBd1          =  $TotalSalesListBd1 / $n;
             $SalesTransactionsBd1     =  $TotalSalesTransBd1 / $n;
             $sqfiRentBd1              =  $TotalsqfiRentBd1 / $n;
             $RentListBd1              =  $TotalRentListBd1 / $n;
             
            $RetArr = array("PricePaid"    => $PricePaid,
                             "scift"   => $scift, 
                             "PaidDiscount"   => $PaidDiscount,
                             "GrossYield"   => $GrossYield,
                             "SalesListing"   => $SalesListing, 
                             "SalesTransactions"   => $SalesTransactions,
                             "sqfiRent"   => $sqfiRent, 
                             "RentList"   => $RentList, 
                             "PricePaidBd1"    => $PricePaidBd1,
                             "sciftBd1"   => $sciftBd1, 
                             "PaidDiscountBd1"   => $PaidDiscountBd1,
                             "GrossYieldBd1"   => $GrossYieldBd1,
                             "SalesListingBd1"   => $SalesListingBd1, 
                             "SalesTransactionsBd1"   => $SalesTransactionsBd1,
                             "sqfiRentBd1"   => $sqfiRentBd1, 
                             "RentListBd1"   => $RentListBd1,
                             "PricePaidBd2"    => $PricePaidBd2,
                             "sciftBd2"   => $sciftBd2, 
                             "PaidDiscountBd2"   => $PaidDiscountBd2,
                             "GrossYieldBd2"   => $GrossYieldBd2,
                             "SalesListingBd2"   => $SalesListingBd2, 
                             "SalesTransactionsBd2"   => $SalesTransactionsBd2,
                             "sqfiRentBd2"   => $sqfiRentBd2, 
                             "RentListBd2"   => $RentListBd2,
                             "PricePaidBd3"    => $PricePaidBd3,
                             "sciftBd3"   => $sciftBd3, 
                             "PaidDiscountBd3"   => $PaidDiscountBd3,
                             "GrossYieldBd3"   => $GrossYieldBd3,
                             "SalesListingBd3"   => $SalesListingBd3, 
                             "SalesTransactionsBd3"   => $SalesTransactionsBd3,
                             "sqfiRentBd3"   => $sqfiRentBd3, 
                             "RentListBd3"   => $RentListBd3
                            );
                            
            header('Content-Type: application/json');
            echo json_encode($RetArr); 
	    
	}
	
	//============================  Overview Sales Rent End ====================
	
	//================================== Property Details ========================================
	
	public static function PropertyDetailsApi($PropertyIds){
        self::Init();
        
        $JsonRet            = file_get_contents("https://api-uat.corelogic.asia/access/oauth/token?client_id=jqhrXN8FIcA8LgMHvijARfAqzy0PD2Cp&client_secret=qWSAAO7n0XPjhMvT&grant_type=client_credentials");
        
        $JsonDecode         = json_decode($JsonRet); 
        
        $token              = $JsonDecode->access_token;
        
        $curl               = curl_init();
        
        
        curl_setopt_array($curl, array(
         // CURLOPT_URL => "https://api-uat.corelogic.asia/property/".self::$Propcountrycode."/v2/suggest.json?q=".self::$Keyword."&suggestionTypes=address&limit=10" , //. self::$Query
          CURLOPT_URL => "https://api-uat.corelogic.asia/property-details/nz/properties/".$PropertyIds."/location" , //. self::$Query
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          /*CURLOPT_POSTFIELDS => array(
                                    'grant_type' => 'authorization_code', 
                                    'code' => $token
                                    ), */
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $token,
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Length: 0"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
       
        
        curl_close($curl);
        
        if ($err) {
          $RetArr = array(); 
        } else {
          $RetDecode = json_decode($response); 
          
            // echo "<pre>"; print_r($RetDecode); echo "</pre>";
        //exit;

          $SuggestArr = array();
          
          $locallyFormattedAddress  = $RetDecode->locallyFormattedAddress ;
          $longitude                = $RetDecode->longitude ;
          $latitude                 = $RetDecode->latitude ;
          
   
          $RetArr[] = array( "locallyFormattedAddress" => $locallyFormattedAddress,
                              "longitude" => $longitude,
                              "latitude" => $latitude); 
        }
        
      
        
        return $RetArr;
    }
	
	//==========================================================================
	
	
	
}	