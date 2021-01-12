<?php
namespace api;

interface apiInterface {
    //put your code here
    
    
}

class apiClass implements apiInterface{
	public static $AuthToken;
    
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
    }

	public static function GetCoreLogicToken(){
		$AuthUrl		= "https://api-uat.corelogic.asia/access/oauth/token?client_id=jqhrXN8FIcA8LgMHvijARfAqzy0PD2Cp&client_secret=qWSAAO7n0XPjhMvT&grant_type=client_credentials";

		$JsonRet		= file_get_contents($AuthUrl);

		$JsonDecode		= json_decode($JsonRet); 

		self::$AuthToken= $JsonDecode->access_token;
	}
	
	
	public static function GetMedianPriceApiDatas($RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $propertyTypeId = "6", $fromDate = "2010-01-01", $toDate = "2020-02-20" , $metricTypeId = "21" , $interval = 12 ){ //formap, fortable 
	
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
		
		$AllArray   = array(); 

		if (isset($response_arr->seriesResponseList)){
			$SeriesListArr  = $response_arr->seriesResponseList[0]->seriesDataList;
			//echo "<pre>"; print_r($SeriesListArr); 
			
			foreach($SeriesListArr as $SeriesListArr1){
			   
			    $yrdata= strtotime($SeriesListArr1->dateTime);
				$TempArr1[] = date('M-Y', $yrdata);
				
				$TempArr2[] = $SeriesListArr1->value;  
				$TempArr3[] = floatval($SeriesListArr1->value) + 2000;  // dummy
				
				
				$dateTimeval = date('M-Y', $yrdata);
				
			    $AllArray[] = array("date" => $dateTimeval, "value" => $SeriesListArr1->value); 
			}
			
		}
        
        if ($RetType == "formap"){
		    return $FinalArr       = array("values" =>  $TempArr2, "dateTime" => $TempArr1, "values2" => $TempArr3);
        }
        else{
            return $AllArray; 
        }
	}

	public static function ShowMedianMapApi($LocationId,$StreetId,$ZipcodeId,$Subrub){
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId); 
		
		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($FinalArr); echo "</pre>";

		//echo json_encode($FinalArr); 

		$Datas = implode(",", $TempArr2) ; 
		$Datas2 = implode(",", $TempArr3) ; 
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
          return '$' + value ;
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
          return y + ' thousand crores';
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

var chart = new ApexCharts(document.querySelector('#medianChart'), options);

chart.render();

</script>
";
				

		//echo $FinalStr; 
		return $FinalStr; 
	}
    
    
    
    public static function ShowMedianTableValueApi($LocationId){
		self::Init(); 

        $TempMedianData = self::GetMedianPriceApiDatas("forTbl",$LocationId,"8","6","2010-01-01","2020-02-20","21","12");
        

		return $TempMedianData; 
	}
	
	


	public static function ChangeMedianPriceApi($LocationId,$StreetId,$ZipcodeId,$Subrub){
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,"8","6","2010-01-01","2020-02-20","69","12");
       

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";

		//echo json_encode($FinalArr);  
		
		//exit();

		$Datas = implode(",", $TempArr2) ; 
		$Datas2 = implode(",", $TempArr3) ; 
		$Categories = "'" . implode("','", $TempArr1) . "'"; 

		$FinalStr = "<script>//
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
                
                var chart = new ApexCharts(document.querySelector('#changemedianprice'), options);
                
                chart.render();
                
                </script>
                ";
				

		//echo $FinalStr; 
		return $FinalStr; 
	}
    
    
      public static function ChangeMedianPriceTableVal($LocationId){
		self::Init(); 

        $TempMedianData = self::GetMedianPriceApiDatas ("forTbl",$LocationId,"8","6","2010-01-01","2020-02-20","69","12"); 
       

		return $TempMedianData; 
	}
    
    
    public static function RentalStatisticsApi($LocationId,$StreetId,$ZipcodeId,$Subrub){
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,"8","6","2010-01-01","2020-02-20","77","12");
        
       

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";

		//echo json_encode($FinalArr);  
		
		//exit();

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
                          return '$' + value;
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
                          return y + ' $';
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
				

		//echo $FinalStr; 
		return $FinalStr; 
	}
	
	
	public static function RentalRateObservationApi($LocationId,$StreetId,$ZipcodeId,$Subrub){
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,"8","6","2010-01-01","2020-02-20","78","12");
        
       

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";

		//echo json_encode($FinalArr);  
		
		//exit();

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
                          return '$' + value;
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
                          return y + ' $';
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
				

		//echo $FinalStr; 
		return $FinalStr; 
	}
	
	
	public static function ChangerenatalRateApi($LocationId,$StreetId,$ZipcodeId,$Subrub){
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,"8","6","2010-01-01","2020-02-20","79","12");
        
       

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";

		//echo json_encode($FinalArr);  
		
		//exit();

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
                
                var chart = new ApexCharts(document.querySelector('#changerenatalrate'), options);
                
                chart.render();
                
                </script>
                ";
				

		//echo $FinalStr; 
		return $FinalStr; 
	}

    	public static function GrossRentalYieldApi($LocationId,$StreetId,$ZipcodeId,$Subrub){
		self::Init(); 

		$FinalStr		= "";

        $TempMedianData = self::GetMedianPriceApiDatas("formap",$LocationId,"8","6","2010-01-01","2020-02-20","80","12");
        
       

		$TempArr1       = $TempMedianData["dateTime"];
		$TempArr2       = $TempMedianData["values"];
		$TempArr3       = $TempMedianData["values2"];
		
		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";

		//echo json_encode($FinalArr);  
		
		//exit();

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
                
                var chart = new ApexCharts(document.querySelector('#grossrentalyield'), options);
                
                chart.render();
                
                </script>
                ";
				

		//echo $FinalStr; 
		return $FinalStr; 
	}
/*----------------------------------------------*/




    public static function GetCensusHouseholdApiDatas($RetType = "formap" , $locationId = "200452", $locationTypeId = "8" , $metricGroupId = "118" ){ //formap, fortable 
        self::Init(); 
	
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
				
				echo "<div style='display:none'>" . $SeriesListArr2->metricTypeShort . "</div>";
				
				
				$dateTimeval = date('M-Y', $yrdata);
				
				//
				
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
                
                var chart = new ApexCharts(document.querySelector('#AgeRatio'), options);
                
                chart.render();
                
                </script>
                ";
				

		//echo $FinalStr; 
		return $FinalStr; 
	}
	
	
	public static function HouseholdIncomeTableVal($locationId){
		self::Init(); 

       $TempMedianData = self::GetCensusHouseholdApiDatas("forTbl", $locationId, 8, 117);
       

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

	
	
	
	
	
}	