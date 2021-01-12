<?php


namespace MemberShip;

interface MemberShipInterface {
    //put your code here
    
    
}


class MemberShipClass implements MemberShipInterface{
    public static $Id;
	
	public static function AddMember(){
        \Html\HtmlClass::init();
		self::Init(); 
		
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/MemberShip/MemberShip.php" );
    }
	
	public static function GetFormValues(){
		self::$Id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
		
	}
	
    public static function Init(){
		self::GetFormValues();
         
         //self::$TotalAddRows    = 3;
    }
   
    
}	