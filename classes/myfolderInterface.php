<?php


namespace myfolder;

interface myfolderInterface {
    //put your code here
    
    
}

class myfolderClass implements myfolderInterface{
    
	public static function Country(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/myfolder/Country.php" );
    }
    public static function Init(){
         //self::GetFormValues();
         
         //self::$TotalAddRows    = 3;
    }
    public static function Properties(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/myfolder/Properties.php" );
    }
    public static function PropertDtl(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/myfolder/PropertDtl.php" );
    }
    public static function GetPropertiesDatas($Id,$country){
        
        if ($Id!="")
        {
            
            $cond=" Where Masters_id='" . $Id . "' ";
            
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
                        property_id, property_name, property_address,property_image,
						description, property_type, land_area,no_of_bedrooms, 
						no_of_parkingspace, no_of_bathroom,created_user,
						rate_silver, rate_gold, rate_platinum, country_code
                    FROM
                        property_details " . $cond . "
                    ORDER BY
                        property_name " ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    
    public static function GetCountriesDatas($country){
        
        
        if ($country!="")
        {
            
            $cond=" Where country_code='" . $country . "' ";
            
        }
        else
        {
            $cond="";
        }
        $IndexQry	= "SELECT
                        country_code,country_name,currency,image
                    FROM
                        country_master " . $cond . "
                    ORDER BY
                        country_name " ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    
    
    public static function save(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        $from                   = $_REQUEST["from"];
        $CountryName            = strtoupper($_REQUEST["CountryName"]);
        $CountryCode            = strtoupper($_REQUEST["CountryCode"]);
        $Currency               = strtoupper($_REQUEST["CurrencyCode"]);
        $FlagImg                = $_REQUEST["FlagImg"];
        $ArrQueries             = array();
        if($from=="Country")
        {
            
        $check_count               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(*) check_count FROM country_master where country_code='".$CountryCode."')");
        
            if ($check_count["0"]>0)
            {
                $Msg="Country Code already exist";
                
            }
            else
            {
                $queryStr="insert into country_master(country_code, country_name, currency, image) values (:country_code, :country_name, :currency, :image)";


				$ColValarray = array("country_code" => $CountryCode, "country_name"=>$CountryName, "currency"=>$Currency, "image"=>$FlagImg) ; 
				$Queryarray = array($queryStr,$ColValarray);

				$ArrQueries[]=$Queryarray;
                $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
            }
        }
        
        
        
        
        
        
        
        \Html\HtmlClass::Init();
        include "header.php";

        echo '	<div id="content">';
        echo	'<div class="widget-title pl-4">
                       <h3>Property - save</h3>
                     </div>';
        echo '		<div class="container">
                            <div class="grid-24">';
        
        if ($Msg == "success"){
            $Msg    =   "Saved Successfully. <br><br>";
        }
        else{
            $Msg    =   "There is a error while save.(".$Msg.")";
        }
        
        echo '                  <div class="notify notify-success">
                                     <h3 align="center"><br/>' . $Msg .'</h3>
                                    
                                </div>';

        echo '			</div>
                                </div>
                        </div>';

        echo '</body></html>';
        include "footer.php";
    }

    
}	