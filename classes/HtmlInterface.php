<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Yasir
 */

namespace Html; 

use SplFileInfo;

interface HtmlInterface {
    //put your code here
    public static function PrintHeader( $file_name = null ); 
    public static function PrintFooter( $file_name = null ); 
    public static function SideBarLeft( $file_name = null ); 
    public static function SideBarRight( $file_name = null ); 
    
    public static function GetHeaderTemplate( $file_name = null ); 
    
    public static function SetPageTitle( $TitleName ); 
    public static function GetPageTitle(); 
    
}

class HtmlClass implements HtmlInterface{
    public static $CurFileName;
    public static $CurFolderName;
    public static $ClsSplFileInfo;    
   
    private static $HeaderStr; 
    private static $SidebarStr; 
    public static $PageTitle; 
    
    public static $UnderConstMsg; 


    public static function Init() {
        $ScriptName             =   $_SERVER["SCRIPT_FILENAME"];
        $ClsSplFileInfo         =   new \SplFileInfo( $ScriptName );
        
        self::SetFileName( $ClsSplFileInfo->getFilename() );
        self::SetFolderName( $ClsSplFileInfo->GetPath() );
    }
    
    public static function SetPageTitle($TitleName) {
        self::$PageTitle = $TitleName; 
    }
    
    public static function GetPageTitle() {
        return self::$PageTitle; 
    }
    
    public static function PrintHeader( $file_name = null  ){
        if ($file_name == null || $file_name == ""){
            $file_name          = self::CurFileName; 
        }
    }
    
    public static function PrintFooter( $file_name = null ) {
         if ($file_name == null || $file_name == ""){
            $file_name          = self::CurFileName; 
        }
    }
    
    public static function SideBarLeft( $file_name = null ){
         if ($file_name == null || $file_name == ""){
            $file_name          = self::CurFileName; 
        }
    }
    
    public static function SideBarRight( $file_name = null ){
         if ($file_name == null || $file_name == ""){
            $file_name          = self::CurFileName; 
        }
    }
    
    public static function PrintMenus( $file_name = null ){
         if ($file_name == null || $file_name == ""){
            $file_name          = self::CurFileName; 
        }
    }
    
    public static function SetFileName($file_name){
        self::$CurFileName = $file_name; 
    }
    
    public static function SetFolderName($folder_name){
        self::$CurFolderName = $folder_name; 
    }
    
    public static function SetUnderConstMsg( $message ){
        self::$UnderConstMsg = $message; 
    }
    
    public static function GetFileName(){
        return self::$CurFileName;
    }
    
    public static function GetFolderName(){
        return self::$CurFolderName; 
    }
    
    public static function GetUnderConstMsg(){
        return self::$UnderConstMsg;
    }
    
    public static function GetHeaderTemplate( $file_name = null , $page_title = null ){
        //self::$HeaderStr = file_get_contents( self::$CurFolderName . "/templates/template.headers.php" );
        //self::$HeaderStr = str_replace("{TITLE_NAME}", $page_title, self::$HeaderStr); 
        //return self::$HeaderStr; 
        include_once( self::$CurFolderName . "/templates/template.headers.php" );
    }
    
    public static function GetSidebar( $file_name = null ){
        //self::$SidebarStr = file_get_contents( self::$CurFolderName . "/templates/template.sidebar.php" );
        //self::$SidebarStr = str_replace("{TITLE_NAME}", "Welcome Home", self::$SidebarStr); 
        //return self::$SidebarStr; 
        include_once ( self::$CurFolderName . "/templates/template.sidebar.php" );
    }
    
    public static function GetSearchBar( $file_name = null ){
        include_once( self::$CurFolderName . "/templates/template.search.php" );
    }
    
    public static function PrintFormHeaderName( $StrFormName = null ){
        return "<div id=\"contentHeader\">
			<h1>{$StrFormName}</h1>
		</div> <!-- #contentHeader -->	"; 
    }
    
    public static function TopNavBar(){
        include_once( self::$CurFolderName . "/templates/template.topnav.php" );
    }
    
    public static function Footer(){
        include_once( self::$CurFolderName . "/templates/template.footer.php" );
    }
    
    public static function GetBaseUrl(){
        return SITE_BASE_URL; 
    }
}