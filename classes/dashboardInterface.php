<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace dashboard; 

interface dashboardInterface {
    //put your code here
    public static function Init();
    public static function index(); 
    
    public static function SetMsg(); 
    public static function GetMsg(); 
}


class dashboardClass implements dashboardInterface{
    private static $Msg; 

    public static function Init(){
        /*if ( \settings\session\sessionClass::GetSessionUserName() == "" ){
            header("location:./?controller=login&action=index&msg=Session Timeout"); 
        }*/
        
        //echo "In"; 
        \Html\HtmlClass::SetPageTitle("Dashboard");
        
        self::SetMsg(); 
    }
    
    public static function index(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        $IsAdmin=\settings\session\sessionClass::GetSessionIsAdmin();
        if($IsAdmin=="Y")
        {
            include_once ( \Html\HtmlClass::GetFolderName() . "/views/dashboard/mydashboard.php" );
        }
        else if($IsAdmin=="A")
        {
            include_once ( \Html\HtmlClass::GetFolderName() . "/views/dashboard/mydashboard.php" );
        }
        else
        {
            include_once ( \Html\HtmlClass::GetFolderName() . "/views/dashboard/mydashboard.php" );
        }
    }
    
    public static function GlobalLocation(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/dashboard/Global.php" );
    }
	public static function SearchProperty(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/dashboard/searchProperty.php" );
    }

    public static function Location(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/dashboard/Location.php" );
    }
    
    public static function mydashboard(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/dashboard/mydashboard.php" );
    }
    
    public static function profilesetup(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/dashboard/profilesetup.php" );
    }
    
    
   
    public static function SetMsg() {
        self::$Msg = $_REQUEST["msg"]; 
    }


    public static function GetMsg(){
        return self::$Msg; 
    }
    public static function GetPropertiesDatas(){
        $IndexQry	= "SELECT
                        property_id, property_name, property_address,property_image,
						description, property_type, land_area,no_of_bedrooms, 
						no_of_parkingspace, no_of_bathroom,created_user,
						rate_silver, rate_gold, rate_platinum, country_code
                    FROM
                        property_details 
                    ORDER BY
                        property_name 
                    LIMIT 3" ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    public static function GetPointsDatas($id){
        $IndexQry	= "SELECT
                        sum(up.points*pc.point_rate) as points
                    FROM
                        user_points up,point_conversion pc
                    where user_id='".$id."'" ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    public static function GetLocProjectDtl($id="",$userId=""){
        $IndexQry	= "SELECT
                        (SELECT count(sold_to) as sold_count FROM project pj,property_details pd where pj.PROJECT_ID=pd.PROJECT_ID and sold_to='".$userId."') as settled_project,
                        (SELECT count(*) as AV_prop FROM property_details pd,project pj WHERE pj.project_id=pd.project_id and pd.reserved_by is null and pj.country='".$id."') as AV_prop,
                        (SELECT Count(PROJECT_ID) as Hurry FROM project pj where `expiry_date`< NOW() + INTERVAL 3 DAY and expiry_date> NOW() and `effective_date`<NOW() and pj.country='".$id."') as Hurry
                    FROM
                        DUAL
                    where 1=1 " ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    public static function GetPointsStructure($id){
        if($id!='' && $id!=null)
        {
            $Cond=" where type='".$id."'";
        }
        $IndexQry	= "SELECT
                        type,points
                    FROM
                        point_structure
                    ".$Cond."" ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    public static function GetProjectDatas(){
        $IndexQry	= "SELECT
                        Distinct pj.project_id, project_name, project_description,image_file,
						country
                    FROM
                        project pj,property_details pd
                    where pj.project_id=pd.project_id
                    ORDER BY
                        project_name 
                    LIMIT 3" ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    public static function GetNewsFeed($country=""){
        if($country!="" && $country!=null)
        {
            $cond=" and cm.country_code='".$country."'";
        }
        $IndexQry	= "SELECT
                        country,publishedAt,title,description,content,author,url,urlToImage
                    FROM
                        newsfeed Ns,country_master cm
                    WHERE cm.country_code_new=Ns.country $cond " ;
                    
                    //echo $IndexQry;
                    
                    
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    public static function SetCurrencies(){
        $_SESSION["BaseCurrency"]   =   $_REQUEST["Currencies"]; 
        return $_REQUEST["Currencies"]; 
    }
    public static function SetCountry(){
        $_SESSION["BaseCountry"]   =   $_REQUEST["Country"]; 
        return $_REQUEST["Currencies"]; 
    }
    public static function SetSessionCompare(){
        if($_SESSION["CompareProperties"]==""||$_SESSION["CompareProperties"]==null)
        {
            $_SESSION["CompareProperties"]   =   $_REQUEST["Properties"];   
        }
        else
        {
            $_SESSION["CompareProperties"]   =   $_SESSION["CompareProperties"].",".$_REQUEST["Properties"];   
        }
        return $_SESSION["CompareProperties"];
    }
    public static function RemoveSessionCompare(){
        if(strpos($_SESSION["CompareProperties"],$_REQUEST["Properties"].",")>-1)
        {
            $_SESSION["CompareProperties"]   =   str_replace($_REQUEST["Properties"].",","",$_SESSION["CompareProperties"]);  
        }
        else if(strpos($_SESSION["CompareProperties"],",".$_REQUEST["Properties"])>-1)
        {
            $_SESSION["CompareProperties"]   =   str_replace(",".$_REQUEST["Properties"],"",$_SESSION["CompareProperties"]);  
        }
        else if(strpos($_SESSION["CompareProperties"],",")=='' || strpos($_SESSION["CompareProperties"],",")==null )
        {
            $_SESSION["CompareProperties"]   =   str_replace($_REQUEST["Properties"],"",$_SESSION["CompareProperties"]);
        }
        return $_SESSION["CompareProperties"];
    }
    
    public static function MailReminder(){
        \Html\HtmlClass::init();
        
            
        $cond1=" and project_id ='".$_REQUEST["project"]."' ";
        $Userid= \settings\session\sessionClass::GetSessionUserName();
        \Property\PropertyClass::Init();
        $rows1 = \Property\PropertyClass::GetProjectDatas($cond1);
        foreach ($rows1 as $row1) 
        {
            $effective_date=$row1["effective_date"];
            $projectName=$row1["project_name"];
            $projectidUp=$row1["project_id"];
            $project_description=$row1["project_description"];
            $country=$row1["country"];
            $image_file=$row1["image_file"];
            $ProjectIdd=$row1["project_id"];
            $queryStr		= "INSERT INTO mail_reminder(mail_id, project_id, reminder_date, is_sent) VALUES( :mail_id, :project_id, :reminder_date, :is_sent )";

    		$ColValarray	= array("mail_id" => $Userid, "project_id"=>$_REQUEST["project"], "reminder_date"=>$effective_date, "is_sent"=> 'N') ; 
    
    		$Queryarray		= array($queryStr,$ColValarray);
    
    		$ArrQueries[]	= $Queryarray;
        }
        $Msg			= \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
                
        return $Msg;
    }
    public static function CancelMailReminder(){
        \Html\HtmlClass::init();
        
            
        $Userid= \settings\session\sessionClass::GetSessionUserName();
        
        $queryStr		= "Delete from mail_reminder where mail_id=:mail_id and project_id=:project_id ";

		$ColValarray	= array("mail_id" => $Userid, "project_id"=>$_REQUEST["project"]) ; 

		$Queryarray		= array($queryStr,$ColValarray);

		$ArrQueries[]	= $Queryarray;
        $Msg			= \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
                
        return $Msg;
    }
    
}