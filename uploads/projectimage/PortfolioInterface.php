<?php


namespace Portfolio;

interface PortfolioInterface {
    //put your code here
    
    
}

class PortfolioClass implements PortfolioInterface{
    
	public static function Portfolio(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/Portfolio.php" );
    }
    public static function Init(){
         //self::GetFormValues();
         
         //self::$TotalAddRows    = 3;
    }
    public static function Properties(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/Properties.php" );
    }
    public static function PropertDtl(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/PropertDtl.php" );
    }
    public static function PortfolioFullDtl(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Portfolio/PortfolioFullDtl.php" );
    }
    public static function GetPropertiesDatas($Id,$country){
        
        if ($Id!="")
        {
            
            $cond=" Where Portfolio_id='" . $Id . "' ";
            
        }
        else
        {
            $cond=" Where 1=1 ";
        }
        if ($country!="")
        {
            
            $cond=$cond." and country_code='" . $country . "' ";
            
        }
        else
        {
            $cond=$cond."";
        }
        $IndexQry	= "SELECT
                        Portfolio_id, Portfolio_name, Portfolio_address,Portfolio_image,
						description, Portfolio_type, land_area,no_of_bedrooms, 
						no_of_parkingspace, no_of_bathroom,created_user,
						rate_silver, rate_gold, rate_platinum, country_code,weekly_rent
                    FROM
                        Portfolio_details " . $cond . "
                    ORDER BY
                        Portfolio_id " ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    public static function save(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        $ArrQueries             = array();
        $MaxIdArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(Portfolio_ID), 0) + 1 Portfolio_ID FROM Portfolio_details)");
        $MaxId                  = $MaxIdArr["0"];
        
                                    
        $PortfolioExistRowCount   = $_REQUEST["PortfolioExistRowCount"]; 
			
        for ($i = 1; $i <= intval($PortfolioExistRowCount); $i++){
			$PortfolioName=$_REQUEST["PortfolioName" . $i]; 
			$PortfolioAddress=$_REQUEST["PortfolioAddress" . $i]; 
			$Description=$_REQUEST["Description" . $i]; 
			$PortfolioType=$_REQUEST["PortfolioType" . $i]; 
			$LandArea=$_REQUEST["LandArea" . $i]; 
			$NoOfBedrooms=$_REQUEST["NoOfBedrooms" . $i]; 
			$NoOfParkingspace=$_REQUEST["NoOfParkingspace" . $i]; 
			$NoOfBathroom=$_REQUEST["NoOfBathroom" . $i]; 
			$RateSilver=$_REQUEST["RateSilver" . $i]; 
			$RateGold=$_REQUEST["RateGold" . $i]; 
			$RatePlatinum=$_REQUEST["RatePlatinum" . $i]; 
			$WeeklyRent=$_REQUEST["WeeklyRent" . $i]; 
			$CountryCode=$_REQUEST["CountryCode" . $i]; 
			$PortfolioImage=$_REQUEST["PortfolioImage" . $i]; 
			$PortfolioDtlStatus=$_REQUEST["PortfolioDtlStatus".$i];
			
           // $ConvertDOB         = \OtherFn\OtherFnClass::convertDate($date1, "%Y-%m-%d");
            if($PortfolioDtlStatus!="N")
            {
                $MaxIdArr[$i] = $MaxId;
    
    			$queryStr="insert into Portfolio_details(Portfolio_id, Portfolio_name, Portfolio_address, 
    			description, Portfolio_type, land_area, no_of_bedrooms, no_of_parkingspace, no_of_bathroom, created_user, 
    			rate_silver, rate_gold, rate_platinum,weekly_rent,country_code,Portfolio_image) values (:Portfolio_id, :Portfolio_name, :Portfolio_address, :description, :Portfolio_type, :land_area, 
    			:no_of_bedrooms, :no_of_parkingspace, :no_of_bathroom, :created_user, :rate_silver, :rate_gold, :rate_platinum,:weekly_rent,:country_code,:Portfolio_image)";
    
    				$ColValarray = array("Portfolio_id" => $MaxId, "Portfolio_name"=>$PortfolioName, "Portfolio_address"=>$PortfolioAddress,
    				"description"=>$Description, "Portfolio_type"=>$PortfolioType, "land_area"=>$LandArea, "no_of_bedrooms"=>$NoOfBedrooms,
    				"no_of_parkingspace"=>$NoOfParkingspace, "no_of_bathroom"=>$NoOfBathroom, "created_user"=>'', "rate_silver"=>$RateSilver,
    				"rate_gold"=>$RateGold, "rate_platinum"=>$RatePlatinum,"weekly_rent"=>$WeeklyRent,"country_code"=>$CountryCode,"Portfolio_image"=>$PortfolioImage) ; 
    				$Queryarray = array($queryStr,$ColValarray);
    
    				$ArrQueries[]=$Queryarray;
                $MaxId++;
            }
        }
        //echo print_r($ArrQueries);
		//exit;
        
        $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
        //echo "<pre>"; print_r($ArrQueries); echo "</pre>"; 
        
        //echo $Msg; 
        
        
        \Html\HtmlClass::Init();
        include "header.php";

        echo '	<div id="content">';
        echo	'<div class="widget-title pl-4">
                       <h3>Portfolio - save</h3>
                     </div>';
        echo '		<div class="container">
                            <div class="grid-24">';
        
        if ($Msg == "success"){
            $Msg    =   "Saved Successfully. <br><br>";
        }
        else{
            $Msg    =   "There is a error while save.";
        }
        
        echo '                  <div class="notify notify-success">
                                     <h3 align="center"><br/>' . $Msg .'</h3>
                                    
                                </div>';

        echo '			</div>
                                </div>
                        </div>';

        //\Html\HtmlClass::TopNavBar(); 

        //\Html\HtmlClass::Footer(); 

        echo '</body></html>';
    }

    
}	