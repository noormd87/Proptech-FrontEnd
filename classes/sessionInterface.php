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

namespace settings\session; 

interface sessionInterface {
    //put your code here
    public static function SetSessionUserName( $SessionUserNameValue ); 
    public static function GetSessionUserName(); 
    
    public static function SetSessionLastLogin( $SessionLastLoginValue );
    public static function GetSessionLastLogin();
    
    public static function CheckSession();
}

class sessionClass implements sessionInterface{
    public static function SetSessionUserName( $SessionUserNameValue ){
        $_SESSION["UserName"]   =   $SessionUserNameValue; 
    }
    
    public static function GetSessionUserName(){
        return $_SESSION["UserName"]; 
    }
    
    public static function SetSessionLastLogin( $SessionLastLoginValue ){
        $_SESSION["LastLogin"]   =   $SessionLastLoginValue; 
    }
    
    public static function GetSessionLastLogin(){
        return $_SESSION["LastLogin"]; 
    }
    
    public static function SetSessionDisplayName( $SessionDisplayName ){
        $_SESSION["DisplayName"] = $SessionDisplayName; 
    }
    
    public static function GetDisplayName(){
        return $_SESSION["DisplayName"]; 
    }
    
     public static function GetSessionDisplayName(){ // We changed name to Id because auto id is not primary key
        $IsIdArr=\DBConn\DBConnection::getQueryFetchColumn("(SELECT ID FROM user_master where user_id='".$_SESSION["DisplayName"]."')");
        return $IsIdArr[0];
    }
    
    
    public static function GetSessionIsAdmin(){
        $IsAdminArr=\DBConn\DBConnection::getQueryFetchColumn("(SELECT user_type_id FROM user_master where user_id='".$_SESSION["DisplayName"]."')");
        return $IsAdminArr[0]; 
    }
    public static function CheckSession(){
        if ( self::GetSessionUserName() == "" )
        {
            header("Location:". SITE_BASE_URL."login/index1.html"); 
        }
    }
}