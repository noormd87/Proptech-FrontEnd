<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * 
 */

namespace login; 



use Html; 

interface loginInterface {
    //put your code here
    /*
	public static function Init(); 
    
    public static function GetUserName();
    public static function SetUserName($username);
    public static function GetPassword(); 
    public static function SetPassword($password); 
    
    public function CheckLogin(); 
	*/
}


class loginClass implements loginInterface{
    
    private static $UserName;
    private static $Password; 
    
    public static $LoginMessage,$UploadedFiles; 
    
    private static $ThisFolderName; 
    
    //, , 
    
    private static $FbAccessToken, $FbUserId, $FbSignedRequest, $IsFbLogin; 
    private static $GoogleEmail, $GoogleUserId, $GoogleName, $IsGoogleLogin; 
    
    public function __construct($username = null, $password = null) {
        
    }
    
    public static function Init(){
        self::SetUserName($_REQUEST["email"]); 
        self::SetPassword($_REQUEST["password"]); 
        
        self::GetFormValues(); 
    }
    
    public static function GetFormValues(){
        self::$IsFbLogin        = false; 
        self::$FbAccessToken    = $_REQUEST["accessToken"];
        self::$FbUserId         = $_REQUEST["userID"];
        self::$FbSignedRequest  = $_REQUEST["signedRequest"];
        
        if (self::$FbUserId != ""){
            self::$IsFbLogin    = true;          
        }
        
        
        self::$IsGoogleLogin        = false; 
        self::$GoogleEmail          = $_REQUEST["GoogleEmail"];
        self::$GoogleUserId         = $_REQUEST["GoogleuserID"];
        self::$GoogleName           = $_REQUEST["GoogleName"];
        
        if (self::$GoogleUserId != ""){
            self::$IsGoogleLogin    = true;          
        }
    }
    
    public static function GetUserName() {
        return self::$UserName; 
    }
    
    public static function SetUserName($username) {
        self::$UserName = $username; 
    }
    
    public static function GetPassword() {
        return self::$Password; 
    }
    
    public static function SetPassword($password) {
        self::$Password = $password; 
    }
    
    public static function SetLoginMessage( $Message ){
        self::$LoginMessage = $Message; 
    }
    
    public static function GetLoginMessage(){
        return self::$LoginMessage; 
    }


    public static function register() {
		\Html\HtmlClass::init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/register.php" );
        
    }
    public static function signIn() {
		\Html\HtmlClass::init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/signIn.php" );
        
    }
    public static function ReferFriend() {
		\Html\HtmlClass::init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/referFriend.php" );
        
    }
    public static function ForgotPassWd() {
		\Html\HtmlClass::init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/ForgotPassWd.php" );
        
    }
    
    public static function howitworks() {
		\Html\HtmlClass::init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/how-it-works.php" );
        
    }
    
    public static function aboutus() {
		\Html\HtmlClass::init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/about-us.php" );
        
    }
    
    public static function ourfounders() {
		\Html\HtmlClass::init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/our-founders.php" );
        
    }
    
    public static function insight() {
		\Html\HtmlClass::init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/insight.php" );
        
    }
    
    public static function duvalrewards() {
		\Html\HtmlClass::init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/du-val-rewards.php" );
        
    }
    
    public static function developers() {
		\Html\HtmlClass::init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/developers.php" );
        
    }
    
    public static function insightinner() {
		\Html\HtmlClass::init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/insight-inner.php" );
        
    }
    
    public static function faq() {
		\Html\HtmlClass::init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/faq.php" );
        
    }
    
    public static function CheckCurrentPassword() {
        $Curpassword=$_REQUEST["Curpassword"];
        $id=$_REQUEST["id"];
        $isChecked="";
        $RsFName					= \DBConn\DBConnection::getQueryFetchAll("select password from user_master where id ='" . $id . "' "); 
            foreach($RsFName as $index => $row)
			{
			    $isChecked="Y";
    			if ($row["password"] == md5($Curpassword)){
    			    return "Yes";
    			}
    			else
    			{
    			     return "No";
    			}
			}
			if($isChecked=="")
			{
			    return "No";
			}
    }
    
    public static function ValidateGoogleLogin(){
        self::Init();
        
        $GoogleUid                  = "Google_" . self::$GoogleUserId;
        
        $NameArr            = explode(" ", self::$GoogleName);
        $FName              = isset($NameArr[0]) ? $NameArr[0] : ""; 
        $LName              = isset($NameArr[1]) ? $NameArr[1] : ""; 
        
        if ($FName == ""){
            $FName          = self::$GoogleUserId;
        }
        
        
        $UIdArr         = \DBConn\DBConnection::getQueryFetchColumn("(SELECT USER_ID FROM user_master where USER_ID = '{$GoogleUid}' )");
        $PrevUserId     = $UIdArr["0"];
        
        if ($PrevUserId == null)
            $PrevUserId = "";
            
        if ($PrevUserId == ""){
        
            $ArrQueries     = array();
            $queryStr       = "Insert Into user_master(USER_ID,user_name,FIRST_NAME,LAST_NAME,
                                PASSWORD,PHONE_NO,PHONE_NO1,SUBSCRIPTION_ID,CURRNT_POINTS,
                                CREATED_ON,CREATED_USER,ACTIVE_STATUS,ADDRESS,payment_type,user_type_id) 
                                values(:USER_ID, :user_name, :FIRST_NAME, :LAST_NAME, 
                                :PASSWORD, :PHONE_NO, :PHONE_NO1, :SUBSCRIPTION_ID, :CURRNT_POINTS, 
                                NOW(), :CREATED_USER, :ACTIVE_STATUS, :ADDRESS, :payment_type, :user_type_id)";
    		
    		$ColValarray    = array( "USER_ID"			=> $GoogleUid, 
                                    "user_name"			=> self::$GoogleEmail, 
                                    "FIRST_NAME"		=> $FName, 
                                    "LAST_NAME"			=> $LName, 
                                    "PASSWORD"			=> md5(self::$GoogleUserId), 
                                    "PHONE_NO"			=> "", 
                                    "PHONE_NO1"			=> "", 
                                    "SUBSCRIPTION_ID"	=> "1", 
                                    "CURRNT_POINTS"		=> "0", 
                                    "CREATED_USER"		=> "", 
                                    "ACTIVE_STATUS"		=> "Y", 
                                    "ADDRESS"			=> "", 
                                    "payment_type"		=> "", 
                                    "user_type_id"		=> "C" );
                                    
    		$Queryarray     = array($queryStr,$ColValarray);
    		$ArrQueries[]   = $Queryarray;
            $Msg            = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
            
            if ($Msg == "success"){
                self::$UserName = $GoogleUid;
                self::$Password = self::$GoogleUserId;
            }
            else{
                echo "Error while validate Google User ID.<br>" . $Msg;
                exit;
            }
        }
        else{
            self::$UserName = $GoogleUid;
            self::$Password = self::$GoogleUserId;
        }
        
        //echo self::$Password;
        //exit;
        
        self::CheckLogin();
    }
    
    public static function ValidateFbLogin(){
        self::Init();
        
        $FbUid                  = "fb_" . self::$FbUserId;
        
        $UIdArr         = \DBConn\DBConnection::getQueryFetchColumn("(SELECT USER_ID FROM user_master where USER_ID = '{$FbUid}' )");
        $PrevUserId     = $UIdArr["0"];
        
        if ($PrevUserId == null)
            $PrevUserId = "";
            
        if ($PrevUserId == ""){
        
            $ArrQueries     = array();
            $queryStr       = "Insert Into user_master(USER_ID,user_name,FIRST_NAME,LAST_NAME,
                                PASSWORD,PHONE_NO,PHONE_NO1,SUBSCRIPTION_ID,CURRNT_POINTS,
                                CREATED_ON,CREATED_USER,ACTIVE_STATUS,ADDRESS,payment_type,user_type_id) 
                                values(:USER_ID, :user_name, :FIRST_NAME, :LAST_NAME, 
                                :PASSWORD, :PHONE_NO, :PHONE_NO1, :SUBSCRIPTION_ID, :CURRNT_POINTS, 
                                NOW(), :CREATED_USER, :ACTIVE_STATUS, :ADDRESS, :payment_type, :user_type_id)";
    		
    		$ColValarray    = array( "USER_ID"			=> $FbUid, 
                                    "user_name"			=> self::$FbUserId, 
                                    "FIRST_NAME"		=> $FbUid, 
                                    "LAST_NAME"			=> "", 
                                    "PASSWORD"			=> md5(self::$FbUserId), 
                                    "PHONE_NO"			=> "", 
                                    "PHONE_NO1"			=> "", 
                                    "SUBSCRIPTION_ID"	=> "1", 
                                    "CURRNT_POINTS"		=> "0", 
                                    "CREATED_USER"		=> "", 
                                    "ACTIVE_STATUS"		=> "Y", 
                                    "ADDRESS"			=> "", 
                                    "payment_type"		=> "", 
                                    "user_type_id"		=> "C" );
                                    
    		$Queryarray     = array($queryStr,$ColValarray);
    		$ArrQueries[]   = $Queryarray;
            $Msg            = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
            
            if ($Msg == "success"){
                self::$UserName = $FbUid;
                self::$Password = self::$FbUserId;
            }
            else{
                echo "Error while validate FB User ID.";
                exit;
            }
        }
        else{
            self::$UserName = $FbUid;
            self::$Password = self::$FbUserId;
        }
        
        self::CheckLogin();
    }
    
    public static function CheckLogin() {
        //return self::$UserName . ", " . self::$Password . "<br>"; 
        $LoginSuccess = false; 
        $userIp=self::getUserIpAddr();
        
        //echo 'userIp='.$userIp;
        //exit;
        
        if (! (self::$IsFbLogin or self::$IsGoogleLogin)){
            self::Init(); 
        }
        
        if ( self::$UserName == "" or self::$Password == ""){
            // echo "in";exit;
            self::SetLoginMessage( "Sorry! Invalid Login" ); 
            return self::index1( "Sorry! Invalid Login" ); 
        }
        else{
           
			
			$RsFName					= \DBConn\DBConnection::getQueryFetchAll("select password,payment_type,id from user_master 
			where (user_id ='" . self::$UserName . "' or user_name ='" . self::$UserName . "') and user_type_id not in ('A') "); //Ghouse/19-08-2020
			foreach($RsFName as $index => $row){
			    $paymentType=$row["payment_type"];//Ghouse/19-08-2020
			    $RegId=$row["id"];//Ghouse/19-08-2020
				if ($row["password"] == md5(self::$Password)){
					//echo $row["PASSWORD"];
					\settings\session\sessionClass::SetSessionUserName( self::$UserName );
					\settings\session\sessionClass::SetSessionLastLogin( date("Y-m-d H:i:s") );
					\settings\session\sessionClass::SetSessionDisplayName( self::$UserName ); 
					$LoginSuccess = true; 
					$_SESSION['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'] 
             ? $_SERVER['HTTP_X_FORWARDED_FOR']
             : $_SERVER['REMOTE_ADDR'];
                    $ArrQueries             = array();
                    $queryStr= "update user_master set login_date=:login_date,user_ip=:user_ip 
                	where user_id=:user_id";
    				
    				$ColValarray = array(  "login_date" => date("Y-m-d H:i:s"),"user_ip"=>$userIp,"user_id"=> self::$UserName ) ; 
    				$Queryarray = array($queryStr,$ColValarray);
    				$ArrQueries[]=$Queryarray;
                    $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
					//self::schedulerDatas();
				}
				else{
					$LoginSuccess = false; 
				}
				
			}

            if(!$LoginSuccess){
				echo self::index1( "Sorry! Invalid Username / Password" ); 
				exit; 
			}
            //echo "Hai";
            
            $BaseUrl = \Html\HtmlClass::GetBaseUrl(); 
            //echo "FB===>".self::$IsFbLogin ."<br>Google==>". self::$IsGoogleLogin;
            //exit;
            //header("location: {$BaseUrl}page2.php"); 
            if ((self::$IsGoogleLogin!="" || self::$IsFbLogin!="") && ($paymentType==null||$paymentType==""))//Ghouse/19-08-2020
            {
                 header("location: {$BaseUrl}login/register.html?Id={$RegId}"); 
            }
            else
            {
                //header("location: {$BaseUrl}dashboard/index.html"); 
                header("location: {$BaseUrl}dashboard/profilesetup.html");
            }
            exit; 
        }
    }
    public static function CheckUserSessionIp() {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] 
             ? $_SERVER['HTTP_X_FORWARDED_FOR']
             : $_SERVER['REMOTE_ADDR'];
            if (isset($_SESSION['ip']) && $ip != $_SESSION['ip']) {
                session_destroy();
                /* redirect to your login pagge */ 
                header("location: {$BaseUrl}"); 
            }
    }
    
    public static function index1( $Msg = "" ){
        \Html\HtmlClass::init();
        //self::$ThisFolderName = \Html\HtmlClass::GetFolderName(); 
       
        
        self::SetLoginMessage( $Msg ); 
        //exit;
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/index1.php" );
        
        //return str_replace( "{@LOGIN_ERROR_MSG}", $Msg, file_get_contents( self::$ThisFolderName . "/templates/template.login.php" )) ;
    }
    
    public static function index( $Msg = "" ){
        \Html\HtmlClass::init();
        //self::$ThisFolderName = \Html\HtmlClass::GetFolderName(); 
       
        if ( \settings\session\sessionClass::GetSessionUserName() != ""){
            $BaseUrl = \Html\HtmlClass::GetBaseUrl(); 
            header("location: {$BaseUrl}dashboard/index.html"); 
        }
        
        self::SetLoginMessage( $Msg ); 
        //exit;
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/index.php" );
        
        //return str_replace( "{@LOGIN_ERROR_MSG}", $Msg, file_get_contents( self::$ThisFolderName . "/templates/template.login.php" )) ;
    }
    
    public static function MyAccount(){
        \Html\HtmlClass::init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/profile.php" );
    }
    public static function GetAccountDatas($UsrId=""){
        if($UsrId=="")
        {
            $UsrId=\settings\session\sessionClass::GetSessionDisplayName();
        }
        $AccountQry	= "SELECT
                        um.id,um.user_id,um.user_name,um.first_name,um.last_name,um.password,um.phone_no,um.phone_no1,
                        um.subscription_id,um.currnt_points,um.created_on,um.created_user,
                        um.active_status,um.address,um.current_acc_auto_id,um.user_type_id,utm.user_type,pm.period_type,ppm.plan_name,um.image_file,um.advisor,um.dob
                    FROM
                        user_master um,subscription_details sd,period_master pm,plan_master ppm ,user_type_master utm
                    WHERE 
                        um.subscription_id =sd.subscription_id 
                        and pm.period_code=sd.period_code 
                        and sd.plan_code=ppm.plan_code 
                        and utm.user_type_id=um.user_type_id
                        and um.id='" .$UsrId . "'" ;
        return \DBConn\DBConnection::getQuery( $AccountQry ); 
    }
    public static function GetUserDatas($UsrId=""){
        if($UsrId=="")
        {
            $UsrId=\settings\session\sessionClass::GetSessionDisplayName();
        }
        $AccountQry	= "SELECT
                        um.id,um.user_id,um.user_name,um.first_name,um.last_name,um.password,um.phone_no,um.phone_no1,
                        um.subscription_id,um.currnt_points,um.created_on,um.created_user,
                        um.active_status,um.address,um.current_acc_auto_id,um.user_type_id,um.image_file,um.advisor,um.dob
                    FROM
                        user_master um
                    WHERE 
                        um.id='" .$UsrId . "'" ;
        return \DBConn\DBConnection::getQuery( $AccountQry ); 
    }
    public static function GetAdvisorDatas(){
        $AdvisorQry	= "SELECT
                        um.id,um.user_id,um.first_name,um.last_name,um.password,um.phone_no,um.phone_no1,
                        um.subscription_id,um.currnt_points,um.created_on,um.created_user,
                        um.active_status,um.address,um.current_acc_auto_id,um.user_type_id,utm.user_type,pm.period_type,ppm.plan_name,um.image_file,um.advisor
                    FROM
                        user_master um,subscription_details sd,period_master pm,plan_master ppm ,user_type_master utm
                    WHERE 
                        um.subscription_id =sd.subscription_id 
                        and pm.period_code=sd.period_code 
                        and sd.plan_code=ppm.plan_code 
                        and utm.user_type_id=um.user_type_id
                        and utm.user_type_id='A' " ;
        return \DBConn\DBConnection::getQuery( $AdvisorQry );
        
    }
    public static function GetReferredCount(){
        $IndexQry	= "Select Count(*) as Count from user_master where referred_by='" . \settings\session\sessionClass::GetSessionDisplayName(). "' " ;
                                
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
                        
    }
    public static function GetReferredEarn(){
        $IndexQry	= "Select Count(*) as Count from user_points where user_id='" . \settings\session\sessionClass::GetSessionDisplayName(). "' 
        and child_user is not null and referral_code not in ('PURCHASE','REFERRED PURCHASE') " ;
                                
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
                        
    }
    public static function GetsubscriptionDtl(){
        
        $AccountQry	= "SELECT sd.subscription_id,pm.period_type,ppm.plan_name
                    FROM
                        subscription_details sd,period_master pm,plan_master ppm 
                    WHERE 
                        pm.period_code=sd.period_code 
                        and sd.plan_code=ppm.plan_code
                        and sd.subscription_id not in ('5') " ;
        return \DBConn\DBConnection::getQuery( $AccountQry ); 
    }
    public static function GetAccountCardDatas($UsrId=""){
        if($UsrId=="")
        {
            $UsrId=\settings\session\sessionClass::GetSessionDisplayName();
        }
        $AccountDtlQry	= "SELECT
                        uad.auto_id,uad.user_id,uad.cardholder_name,uad.card_number,uad.cvv,
                        uad.expiration_date,uad.country,uad.address1,uad.address2,uad.city,
                        uad.postal_code,uad.state,uad.email_address_for_invoice,uad.company_name
                    FROM
                        user_master um,user_account_details uad
                    WHERE 
                        um.id =uad.user_id 
                        and um.id='" . $UsrId. "'" ;
                        
                        //echo $AccountDtlQry;
        return \DBConn\DBConnection::getQuery( $AccountDtlQry ); 
    }
    public static function GetReferredFriends($id){
        
        $ReferredFriendsQry	= "SELECT if(um.active_status='Y','ACTIVE','DE-ACTIVE') as active_status, um.first_name, um.last_name, um.referral_code, Date_format(um.created_on, '%d-%m-%Y') AS created_on, um.user_id, temp.points, 
        um.image_file, (SELECT Date_format(UPDATE_TIME, '%d-%m-%Y') FROM referral_code WHERE referred_by=temp.USER LIMIT 1) as referred_date FROM user_master um,
        (SELECT child_user AS User_id, points, USER_ID AS USER FROM `user_points` a WHERE user_id = '" . $id. "' AND a.referral_code NOT IN ( 'PURCHASE' ) 
        AND a.referral_code NOT IN ( 'REFERRED PURCHASE' ))temp WHERE um.id = temp.user_id" ;
        
        //echo $ReferredFriendsQry;
        return \DBConn\DBConnection::getQuery( $ReferredFriendsQry ); 
    }
    public static function GetUserFullName(){
        
        $ReferredFriendsQry	= "SELECT um.id, um.first_name,um.last_name,um.user_id,um.image_file,cm.country_code,cm.country_name,cm.currency  FROM user_master um ,user_account_details uad,country_master cm
        where um.id='" . \settings\session\sessionClass::GetSessionDisplayName(). "' and uad.user_id=um.id and Upper(cm.country_code)=Upper(uad.country)" ;
        
        //echo $ReferredFriendsQry;
        
        return \DBConn\DBConnection::getQuery( $ReferredFriendsQry ); 
    }
    
    public static function Logout(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/login/logout.php" );
    }
	public static function save(){
        //\Html\HtmlClass::init();
        //\settings\session\sessionClass::CheckSession(); 
        //exit;
        //self::Init(); 
        
     #  echo "<pre>";        print_r($_REQUEST); echo "</pre>";
     #  die();
        
        $ArrQueries             = array();
        $ClientDtlIdArr         = array(); 

        $MaxIdArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(id), 0) + 1 ID FROM user_master)");
        $MaxId                  = $MaxIdArr["0"];
        $MaxAutoIdArr           = \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(auto_id), 0) + 1 ID FROM user_account_details)");
        $MaxAutoId              = $MaxAutoIdArr["0"];
   

			$action 		 = $_REQUEST["action1"];
			$UpdateFlag 	 = $_REQUEST["UpdateFlag"];
			$id 		     = $_REQUEST["id"];
			$auto_id	     = $_REQUEST["auto_id"];
			$user_name		 = $_REQUEST["user_name"];
			$first_name		 = $_REQUEST["first_name"];
			$last_name		 = $_REQUEST["last_name"];
			$mobile			 = $_REQUEST["mobile"];
			$mobile1		 = $_REQUEST["Phone"];
			$email			 = $_REQUEST["email"];
			$user_id		 = $_REQUEST["user_id"];
			if($_REQUEST["password"]!="" && $_REQUEST["password"]!=null)
			{
			    $password		 = md5($_REQUEST["password"]);
			}
			$Cardholder_Name = $_REQUEST["Cardholder_Name"];
			$Card_Number	 = $_REQUEST["Card_Number"];
			$CVV			 = $_REQUEST["CVV"];
			$month_list		 = $_REQUEST["month_list"]+1;
			$year_list		 = $_REQUEST["year_list"];
			$ExpDate		 = $year_list."-".$month_list."-00";
			$ExpDate		 = date("Y-m-d", strtotime($ExpDate));
			$created_on      = date("Y-m-d H:i:s");
			$country		 = $_REQUEST["country_selector_code"];
			$countryArr      = \DBConn\DBConnection::getQueryFetchColumn("(SELECT country_code FROM country_master where Upper(country_code_new)=Upper('".$country."') )");
            $country         = $countryArr["0"];
			$country1		 = $_REQUEST["country_selector1_code"];
			$Address1		 = $_REQUEST["Address1"];
			$Address		 = $_REQUEST["address"];
			$Address2		 = $_REQUEST["Address2"];
			$City			 = $_REQUEST["City"];
			$Postal_Code	 = $_REQUEST["Postal_Code"];
			if($Postal_Code=="" || $Postal_Code==null)
			{
			    $Postal_Code		 = null;
			}
			$State			 = $_REQUEST["State"];
			$Email_for_Inv	 = $_REQUEST["Email_Address_for_Invoice"];
			$Company_Name	 = $_REQUEST["Company_Name"];
			$ReferralCode	 = $_REQUEST["ReferralCode"];
			$PaymentType	 = $_REQUEST["PaymentType"];
			$Dob	         = $_REQUEST["Dob"];
			$Dob		     = date("Y-m-d", strtotime($Dob));
			$gender          = $_REQUEST["gender"];
			$form	         = $_REQUEST["form"];
			$Advisor	     = $_REQUEST["Advisor"];
			$ActivationMail=null;
			//echo $action;
			if($action=='Edit' ||$UpdateFlag=="Y")
			{
			    if($form==2)
			    {
			        $queryStr= "update user_account_details set cardholder_name=:cardholder_name,card_number=:card_number,cvv=:cvv,expiration_date=:expiration_date 
                	where auto_id=:auto_id and user_id=:user_id";
    				//,country=:country,address1=:address1,address2=:address2,city=:city,postal_code=:postal_code,state=:state,email_address_for_invoice=:email_address_for_invoice,company_name=:company_name
    				$ColValarray = array(  "cardholder_name" => $Cardholder_Name, "card_number"=> $Card_Number,
    				"cvv" => $CVV, "expiration_date"=> $ExpDate,"auto_id"=> $auto_id,"user_id"=> $id) ; 
    				//, "country" => $country, "address1" => $Address1, "address2" => $Address2, "city" => $City,"postal_code" => $Postal_Code, "state" => $State, "email_address_for_invoice" => $Email_for_Inv, "company_name" => $Company_Name
    				$Queryarray = array($queryStr,$ColValarray);
    				$ArrQueries[]=$Queryarray;
			    }
			    elseif($form==1)
			    {
			        if($_REQUEST["password"]!="" && $_REQUEST["password"]!=null)
        			{
        			    $password		 = md5($_REQUEST["password"]);
        			    echo "";
        			    $queryStr= "update user_master set user_id=:user_id,user_name=:user_name,first_name=:first_name,address=:address,last_name=:last_name,phone_no=:phone_no,phone_no1=:phone_no1,dob=:dob,password=:password where id=:id";
        		    	$ColValarray = array( "user_id"=>$user_id,"user_name"=>$user_name,"first_name"=>$first_name, "address"=>$Address1, "last_name"=>$last_name,"phone_no"=>$mobile,"phone_no1"=>$mobile1,"dob"=>$Dob,"password"=>$password, "id"=> $id) ; 
        			}
        			else
        			{
        			    $queryStr= "update user_master set user_id=:user_id,user_name=:user_name,first_name=:first_name,address=:address,last_name=:last_name,phone_no=:phone_no,phone_no1=:phone_no1,dob=:dob where id=:id";
        		    	//,address=:address,current_acc_auto_id=:current_acc_auto_id,advisor=:advisor
        				$ColValarray = array( "user_id"=>$user_id,"user_name"=>$user_name,"first_name"=>$first_name, "address"=>$Address1, "last_name"=>$last_name,"phone_no"=>$mobile,"phone_no1"=>$mobile1,"dob"=>$Dob, "id"=> $id) ; 
        				//,"address"=>$Address,"current_acc_auto_id"=> $auto_id,"advisor"=>$Advisor
        				
        			}
    				$Queryarray = array($queryStr,$ColValarray);
    				$ArrQueries[]=$Queryarray;
    				
			    }
            	elseif($UpdateFlag=="Y")
            	{
            	    $AdvisorArr               = \DBConn\DBConnection::getQueryFetchColumn("(select Advisor,uid from (SELECT Advisor,COUNT(Advisor) as uid FROM `user_master` where Advisor is not null GROUP BY Advisor)TEP order by uid limit 1)");
        			$Advisor                  = $AdvisorArr["0"];
        			
            	    if($_REQUEST["password"]!="" && $_REQUEST["password"]!=null)
        			{
        			    $password		 = md5($_REQUEST["password"]);
        			    $queryStr= "update user_master set user_id=:user_id,user_name=:user_name,first_name=:first_name,last_name=:last_name,phone_no=:phone_no,phone_no1=:phone_no1,dob=:dob,password=:password,gender=:gender,payment_type=:payment_type,advisor=:advisor where id=:id";
        		    	$ColValarray = array( "user_id"=>$email,"user_name"=>$user_name,"first_name"=>$first_name, "last_name"=>$last_name,"phone_no"=>$mobile,"phone_no1"=>$mobile1,"dob"=>$Dob,"password"=>$password,"gender"=>$gender,"payment_type"=>$PaymentType,"advisor"=>$Advisor, "id"=> $id) ; 
        			}
        			else
        			{
        			    $queryStr= "update user_master set user_id=:user_id,user_name=:user_name,first_name=:first_name,last_name=:last_name,phone_no=:phone_no,phone_no1=:phone_no1,dob=:dob,gender=:gender,payment_type=:payment_type,advisor=:advisor where id=:id";
        		    	$ColValarray = array( "user_id"=>$email,"user_name"=>$user_name,"first_name"=>$first_name, "last_name"=>$last_name,"phone_no"=>$mobile,"phone_no1"=>$mobile1,"dob"=>$Dob,"gender"=>$gender,"payment_type"=>$PaymentType,"advisor"=>$Advisor, "id"=> $id) ; 
        				
        			}
        			$Queryarray = array($queryStr,$ColValarray);   
        			$ArrQueries[]=$Queryarray;
        			
        			$queryStr="insert into user_account_details(auto_id, user_id, cardholder_name, card_number, cvv, expiration_date, country, address1, address2, city, postal_code,
        			state, email_address_for_invoice, company_name) values (:auto_id,:user_id,:cardholder_name,:card_number,:cvv,:expiration_date,:country,:address1,:address2,:city,
        			:postal_code,:state,:email_address_for_invoice,:company_name)";

    				$ColValarray = array("auto_id"=> $MaxAutoId, "user_id"=> $id, "cardholder_name" => $Cardholder_Name, "card_number"=> $Card_Number, "cvv" => $CVV,
    				"expiration_date"=> $ExpDate, "country" => $country, "address1" => $Address1, "address2" => $Address2, "city" => $City, "postal_code" => $Postal_Code,
    				"state" => $State, "email_address_for_invoice" => $Email_for_Inv, "company_name" => $Company_Name) ; 
    
    				$Queryarray = array($queryStr,$ColValarray);
    				$ArrQueries[]=$Queryarray;
    
    				$queryStr= "update user_master set current_acc_auto_id=:current_acc_auto_id where id=:id";
    
    				$ColValarray = array("current_acc_auto_id"=> $MaxAutoId, "id"=> $id) ; 
    
    				$Queryarray = array($queryStr,$ColValarray);
    
    				$ArrQueries[]=$Queryarray;
        			
            	}
            	
				$Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
			}
			else
			{
    			$checkcountArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(COUNT(id), 0) checkcount FROM user_master WHERE user_id='{$email}' or user_name='{$user_name}' )");
    			$checkcount                  = $checkcountArr["0"];
    			
    			$AdvisorArr               = \DBConn\DBConnection::getQueryFetchColumn("(select Advisor,uid from (SELECT Advisor,COUNT(Advisor) as uid FROM `user_master` where Advisor is not null GROUP BY Advisor)TEP order by uid limit 1)");
    			$Advisor                  = $AdvisorArr["0"];
    			
    			if($checkcount>0)	
    			{
    				$Msg="This User Id ".$email." or User Name ".$user_name." already exist";
    			}
    			else
    			{
    			    if($ReferralCode!='')
    			    {
    			        $referredByArr                   = \DBConn\DBConnection::getQueryFetchColumn("(SELECT referred_by FROM referral_code where hash_key='".$ReferralCode."' )");
                        $referredBy                      = $referredByArr["0"];
    			    }
    			    else
    			    {
    			        $referredBy=null;
    			    }
    				$queryStr="insert into user_master(id, user_id,user_name, first_name, last_name, password, phone_no,phone_no1,image_file, subscription_id,
    				currnt_points, created_on, created_user, active_status, address,referral_code,referred_by,payment_type,user_type_id,advisor,dob,gender) values 
    				(:id,:user_id,:user_name,:first_name,:last_name,:password,:phone_no,:phone_no1,:image_file,:subscription_id,:currnt_points,:created_on,
    				:created_user,:active_status,:address,:referral_code,:referred_by,:payment_type,:user_type_id,:advisor,:dob,:gender)";
    
    
    				$ColValarray = array("id" => $MaxId, "user_id"=>$email,"user_name"=>$user_name, "first_name"=>$first_name, "last_name"=>$last_name, "password"=>$password,
    				"phone_no"=>$mobile,"phone_no1"=>$mobile1,"image_file"=>'', "subscription_id"=>5, "currnt_points"=>0, "created_on"=>$created_on,
    				"created_user"=>'', "active_status"=>'N', "address"=>$Address1,"referral_code"=>$ReferralCode,"referred_by"=>$referredBy,
    				"payment_type"=>$PaymentType,"user_type_id"=>'C',"advisor"=>$Advisor,"dob"=>$Dob,"gender"=>$gender) ; 
    				$Queryarray = array($queryStr,$ColValarray);
    
    				$ArrQueries[]=$Queryarray;
    				$queryStr="insert into user_account_details(auto_id, user_id, cardholder_name, card_number, cvv, expiration_date, country, address1, address2, city, postal_code, state, email_address_for_invoice, company_name) values (:auto_id,:user_id,:cardholder_name,:card_number,:cvv,:expiration_date,:country,:address1,:address2,:city,:postal_code,:state,:email_address_for_invoice,:company_name)";
    
    				$ColValarray = array("auto_id"=> $MaxAutoId, "user_id"=> $MaxId, "cardholder_name" => $Cardholder_Name, "card_number"=> $Card_Number, "cvv" => $CVV, "expiration_date"=> $ExpDate, "country" => $country, "address1" => $Address1, "address2" => $Address2, "city" => $City, "postal_code" => $Postal_Code, "state" => $State, "email_address_for_invoice" => $Email_for_Inv, "company_name" => $Company_Name) ; 
    
    				$Queryarray = array($queryStr,$ColValarray);
    				$ArrQueries[]=$Queryarray;
    
    				$queryStr= "update user_master set current_acc_auto_id=:current_acc_auto_id where id=:id";
    
    				$ColValarray = array("current_acc_auto_id"=> $MaxAutoId, "id"=> $MaxId) ; 
    
    				$Queryarray = array($queryStr,$ColValarray);
    
    				$ArrQueries[]=$Queryarray;
                    $ActivationMail='Y';
                    $current_id=$MaxId;
    				
                    if($ReferralCode!='' && $ReferralCode!=null && '1'=='2')
                    {
                        $referredByArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT referred_by FROM referral_code WHERE hash_key='{$ReferralCode}')");
    			        $referredBy                  = $referredByArr["0"];
    			        $pointsArr                   = \DBConn\DBConnection::getQueryFetchColumn("(SELECT points FROM point_structure WHERE type='refer_friend')");
    			        $points                      = $pointsArr["0"];
    			        
    			        
    			        $date = date("Y-m-d H:i:s");
    			        
    			        $queryStr="insert into user_points(user_id,points,referral_code,updated_date) values (:user_id,:points,:referral_code,:updated_date)";
    
        				$ColValarray = array("user_id"=> $referredBy, "points"=> $points, "referral_code" => $ReferralCode, "updated_date" => $date) ; 
        
        				$Queryarray = array($queryStr,$ColValarray);
        				$ArrQueries[]=$Queryarray;
        				
        				 $queryStr="insert into user_points(user_id,points,referral_code,updated_date) values (:user_id,:points,:referral_code,:updated_date)";
    
        				$ColValarray = array("user_id"=> $email, "points"=> $points, "referral_code" => $ReferralCode, "updated_date" => $date) ; 
        
        				$Queryarray = array($queryStr,$ColValarray);
        				$ArrQueries[]=$Queryarray;
                    
                    }
                    
    				$Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
    				
    			}
			}
            
        
            if($UpdateFlag=="Y" && ($Msg == "success" || $Msg == "1"))
            {
                if($_REQUEST["password"]!="" && $_REQUEST["password"]!=null)
    			{
    			    $PassCode                  = $_REQUEST["password"];
    			}
    			else
    			{
                    $PassCode=$email;
    			}
                self::$UserName = $email;
                self::$Password = $PassCode;
                self::$IsFbLogin ="1";
                self::$IsGoogleLogin="1";
                self::CheckLogin();
            }
        //include"header.php";

		echo '	<div id="content">';
		if($action=='Edit')
		{
             echo		\Html\HtmlClass::PrintFormHeaderName("Account - Save");
             if ($Msg == "success"){
                $Msg    =   "Saved Successfully. <br><br>
                             <a href='#' onclick='javascript:history.go(-1)'>Back</a>  
                            ";
            }
            else{
                $Msg    =   "There is a error while save.(". $Msg.")<br><a href='#' onclick='javascript:history.go(-1)'>Back</a> ";
            }
		}
		else
		{
		     echo		\Html\HtmlClass::PrintFormHeaderName("Registration - Save");
		     echo '		<div class="container">
                            <div class="grid-24">';
            if ($Msg == "success"){
                $Msg    =   "Saved Successfully. <br><br>
                             <a href='" . SITE_BASE_URL . "login/index.html'>Login</a>  
                            ";
                if($ActivationMail=='Y')
                {
                    $MailId                  = $email;
                    $inputSubject="User Registration Activation Email";
                    $to = stripcslashes($MailId);
                    $subject = stripcslashes($inputSubject);
                    $actual_link =  SITE_BASE_URL . "login/activate.html?id=" . $current_id;
        			$message = "Click this link to activate your account. <a href='" . $actual_link . "'>Activate</a>";
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'Cc: '.$ccBcc.'' . "\r\n";
                    $headers .= "From: <info@duvalknowledge.co.nz>" . "\r\n";
                    $sent = mail($to,$subject,$message,$headers);
                    if($sent){
                        $message = "You have registered and the activation mail is sent to your email. Click the activation link to activate you account.";	
                        $Msg    =$Msg    ."<BR>".$message;
                    }
                }
            }
            else{
                $Msg    =   "There is a error while save.(". $Msg.")<br><a href='" . SITE_BASE_URL . "login/register.html'>Go to registration</a> ";
            }
		}
        
        echo '                  <div class="notify notify-success">
                                     <h3 align="center"><br/>' . $Msg .'</h3>
                                    
                                </div>';

        echo '			</div>
                                </div>
                        </div>';

        //include"footer.php";

        echo '</body></html>';
    }
    
    public static function activate(){
        $UserId=$_REQUEST["id"];
        $currentDate      = date("Y-m-d H:i:s");
        $CreatedDateArr                   = \DBConn\DBConnection::getQueryFetchColumn("(SELECT created_on FROM user_master WHERE id={$UserId})");
    	$CreatedDate                      = $CreatedDateArr["0"];
    	//echo $currentDate."<br>";
    	//echo $CreatedDate."<br>";
    	$diff_time=(strtotime($currentDate)-strtotime($CreatedDate))/60;
    	if($diff_time<60)
    	{
            $queryStr="update user_master set active_status=:active_status where id=:id";
    
    		$ColValarray = array("active_status"=> 'Y', "id"=> $UserId) ; 
    
    		$Queryarray = array($queryStr,$ColValarray);
    		$ArrQueries[]=$Queryarray;
    		
    		if($ArrQueries!=null)
    		{
    		    $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
    		}
    		else
    		{
    		    $Msg ="Problem in account activation";
    		}
            if($Msg=='success')
            {
                $Msg ="Your account is activated";
            }
    	}
    	else
    	{
    	    $Msg ="Activation link is expired";
    	}
        //include"header.php";

		echo '<div id="content">';
		
		echo	\Html\HtmlClass::PrintFormHeaderName("activation");
		echo '	<div class="container">
                    <div class="grid-24">';
        echo '			<div class="notify notify-success">
                            <h3 align="center"><br/>' . $Msg .' <a href="' . SITE_BASE_URL . 'login/index.html">Login</a></h3>
                        </div>';

        echo '		</div>
                 </div>
             </div>';

        //include"footer.php";

        echo '</body></html>';
    }
    public static function Subscription(){
        
        $UserId=$_REQUEST["user_id"];
        $SubscriptionId=$_REQUEST["subscription_id1"];
        $updatetime= date("Y-m-d");
        $PeriodArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT pm.period_code FROM subscription_details sd,period_master pm,plan_master ppm WHERE pm.period_code=sd.period_code and sd.plan_code=ppm.plan_code and sd.subscription_id not in ('{$SubscriptionId}'))");
        $Period                  = $PeriodArr["0"];
        $queryStr="update user_master set payment_type=:payment_type,subscription_id=:subscription_id where user_id=:user_id";

		$ColValarray = array("payment_type"=> $Period,"subscription_id"=>$SubscriptionId, "user_id"=> $UserId) ; 

		$Queryarray = array($queryStr,$ColValarray);
		$ArrQueries[]=$Queryarray;
		
		if($ArrQueries!=null)
		{
		    $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
		}
		else
		{
		    $Msg ="Error";
		}
        if($Msg=='success')
        {
            $Msg ="Successfully Updated";
        }
        include"header.php";

		echo '<div id="content">';
		
		echo	\Html\HtmlClass::PrintFormHeaderName("subscription");
		echo '	<div class="container">
                    <div class="grid-24">';
        echo '			<div class="notify notify-success">
                            <h3 align="center"><br/>' . $Msg .' <a href="' . SITE_BASE_URL . 'MemberShip/AddMember.html">Back</a></h3>
                        </div>';

        echo '		</div>
                 </div>
             </div>';

        include"footer.php";

        echo '</body></html>';
    }
    
    public static function schedulerDatas(){
        
      
      
        $UsersDtlQry	= "SELECT
                            um.user_id,um.referral_code,DATE_FORMAT(um.created_on, '%Y-%m-%d') as created_on,payment_type
                    FROM
                        user_master um
                    WHERE 
                        (um.referral_code is not null AND um.referral_code<>'') and um.user_id not in (select user_id from user_points where referral_code not in ('PURCHASE','REFERRED PURCHASE') )" ;
        
        
        $UsersDtlrows = \DBConn\DBConnection::getQuery( $UsersDtlQry ); 
		foreach ($UsersDtlrows as $UsersDtlrow) 
		{
		    $UserId=$UsersDtlrow["user_id"];
		    $ReferralCode=$UsersDtlrow["referral_code"];
		    $updatetime=$UsersDtlrow["created_on"];
		    $PaymentType=$UsersDtlrow["payment_type"];
		    if($PaymentType=='Y')
		    {
		        $Cond=" type='annual_purchase' ";
		    }
		    else
		    {
		        $Cond=" type='monthly_purchase' ";
		    }
		    
	        $referredByArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT referred_by FROM referral_code WHERE hash_key='{$ReferralCode}')");
	        $referredBy                  = $referredByArr["0"];
	        
	        $pointsArr                   = \DBConn\DBConnection::getQueryFetchColumn("(SELECT points FROM point_structure WHERE ".$Cond." )");
	        $points                      = $pointsArr["0"];
	        
	        $ReferralpointArr                   = \DBConn\DBConnection::getQueryFetchColumn("(SELECT points FROM point_structure WHERE type='refer_friend' )");
	        $Referralpoint                      = $ReferralpointArr["0"];
	        
	        $date = date("Y-m-d");
	        $date1 = strtotime($updatetime);  
            $date2 = strtotime($date);  
            $diff = abs($date2 - $date1); 
            $Diffdays = floor($diff / (60*60*24)); 
            //echo $referredBy."<br>";
            //echo $UserId."<br>";
            //echo $Diffdays."<br>";
	        if($Diffdays>30)
	        {
				
    			$queryStr="insert into user_points(user_id,points,referral_code,child_user,updated_date) values (:user_id,:points,:referral_code,:child_user,:updated_date)";
    
				$ColValarray = array("user_id"=> $referredBy, "points"=> $Referralpoint, "referral_code" => $ReferralCode,"child_user"=>$UserId, "updated_date" => $date) ; 

				$Queryarray = array($queryStr,$ColValarray);
				$ArrQueries[]=$Queryarray;
				
				 $queryStr="insert into user_points(user_id,points,referral_code,updated_date) values (:user_id,:points,:referral_code,:updated_date)";

				$ColValarray = array("user_id"=> $UserId, "points"=> $points, "referral_code" => $ReferralCode, "updated_date" => $date) ; 

				$Queryarray = array($queryStr,$ColValarray);
				
    			$ArrQueries[]=$Queryarray;
	        }
		}
		
		$UsersDtl1Qry	= "SELECT
                            um.user_id,um.referral_code,DATE_FORMAT(um.created_on, '%Y-%m-%d') as created_on,payment_type
                    FROM
                        user_master um
                    WHERE 
                        subscription_id in ('5')" ;
        $UsersDtl1rows = \DBConn\DBConnection::getQuery( $UsersDtl1Qry ); 
		foreach ($UsersDtl1rows as $UsersDtl1row) 
		{
		    $UserId1=$UsersDtl1row["user_id"];
		    $ReferralCode1=$UsersDtl1row["referral_code"];
		    $updatetime1=$UsersDtl1row["created_on"];
		    $PaymentType1=$UsersDtl1row["payment_type"];
		    $dateCur = date("Y-m-d");
	        $dateCur1 = strtotime($updatetime);  
            $dateCur2 = strtotime($date);  
            $diff = abs($dateCur2 - $dateCur1); 
            $Diffdays1 = floor($diff / (60*60*24));
            if($PaymentType1=='Y')
            {
                $subscriptionId='2';
            }
            else
            {
                $subscriptionId='1';
            }
	        if($Diffdays1>30)
	        {
	            $queryStr="update user_master set subscription_id=:subscription_id where user_id=:user_id";
    
				$ColValarray = array("subscription_id"=> $subscriptionId, "user_id"=> $UserId1) ; 

				$Queryarray = array($queryStr,$ColValarray);
				$ArrQueries[]=$Queryarray;
	        }
		}
		if($ArrQueries!=null)
		{
		    $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
		}
		else
		{
		    $Msg ="No Referrals";
		}
        echo $Msg;
        
        $countryQry	= "SELECT country_code_new,currency FROM country_master" ;
        
        $countryDtlrows = \DBConn\DBConnection::getQuery( $countryQry ); 
		foreach ($countryDtlrows as $countryDtlrow) 
		{
		    $CountryCode=$countryDtlrow["country_code_new"];
		    $currency=$countryDtlrow["currency"];
		    //echo '<br>'.$CountryCode;
        
		    echo \api\apiClass::GetNewsFeedApiDatas($CountryCode);
		    echo \api\apiClass::GetCurrExrateDatas($currency);
		    
		}
		//========================================================
		$UsersDtlQry	= "SELECT Distinct
		                        mail_id,pj.project_id,reminder_date-interval 1 day as reminder_date,is_sent,PROJECT_NAME,
		                        PROJECT_DESCRIPTION,COUNTRY,currency,DATE_FORMAT(effective_date, '%d-%b-%Y %r') as effective_date,expiry_date,image_file 
		                   FROM mail_reminder mr,project pj 
		                    WHERE pj.project_id=mr.project_id AND is_sent='N' and (reminder_date-interval 1 day)<NOW()" ;
        
        
        $ReminderDtlrows = \DBConn\DBConnection::getQuery( $UsersDtlQry ); 
		foreach ($ReminderDtlrows as $ReminderDtlrow) 
		{
		    $MailId=$ReminderDtlrow["mail_id"];
		    $ProjectName=$ReminderDtlrow["PROJECT_NAME"];
		    $ProjectDesc=$UsersDtlrow["PROJECT_DESCRIPTION"];
		    $LunchDate=$ReminderDtlrow["effective_date"];
		    $Image=$ReminderDtlrow["image_file"];
		    $projectId=$ReminderDtlrow["project_id"];
		    
		    $inputSubject="Reminder on Upcoming Project on DU VAL PRIVATE OFFIC";
            $to = stripcslashes($MailId);
            $subject = stripcslashes($inputSubject);
            
		    $message= '<div class="card-body">
            <h4 class="card-title">Upcoming Project</h4>
            <div class="upcoming-project">
                          <div class="row">
                <div class="col-2 align-self-cenetr">
                  <img src="https://duvalknowledge.com/PropTech/uploads/projectimage/'.$Image.'" class="img-fluid" width="200">
                </div>
                <div class="col-4 align-self-cenetr">
                  <h4><span class="flag-icon flag-icon-nz"></span> '.$ProjectName.'</h4><h5>'.$ProjectDesc.'</h5>
                </div>
                <div class="col-4 align-self-cenetr">
                  <div class="reminder">
                   <h5> Lunch On : '.$LunchDate.'</h5>
                  </div>
                </div>
              </div>
                          </div>
          </div>';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'Cc: '.$ccBcc.'' . "\r\n";
            $headers .= "From: <info@duvalknowledge.co.nz>" . "\r\n";
            $sent = mail($to,$subject,$message,$headers);
            if($sent){
                $ArrQueries						= array();
                $queryStr				 = "update mail_reminder set is_sent=:is_sent where project_id=:project_id and mail_id=:mail_id";
				$ColValarray			= array("is_sent" => 'Y',"project_id" =>$projectId,"mail_id"=>$MailId) ; 
				$Queryarray				= array($queryStr,$ColValarray);
                $ArrQueries[]=$Queryarray;
				
				$Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
				echo "===>".$Msg;
            }
		}   
		    
    }
    
    public static function SaveUploadFile(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        $ArrQueries						= array();
        
        $Id             = isset($_REQUEST["id"]) ?  $_REQUEST["id"] : ""; 
        if (isset($_FILES["UploadFile"]["tmp_name"]))
        {
            //echo "in";
            $tmpname = $_FILES["UploadFile"]["tmp_name"];
            $filename = $_FILES["UploadFile"]["name"];
            $actfilename = str_replace(",", "_", $filename); 
             $UplFilePath = "uploads/ProfilePic/" . $actfilename; 
           if (move_uploaded_file($tmpname, $UplFilePath) )
            {
                if ($UploadedFiles == ""){
                    $UploadedFiles = $actfilename;
                }
                else{
                    $UploadedFiles = $UploadedFiles . "," . $actfilename;
                }

				 if ($Id!='' && $Id!=null)
                 {
                     
                    $queryStr				 = "update user_master set image_file=:image_file where id=:id";
    				$ColValarray			= array("image_file" => $UploadedFiles,"id" =>$Id) ; 
    				$Queryarray				= array($queryStr,$ColValarray);
                    $ArrQueries[]=$Queryarray;
                    
    				
    				
    				$Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
    				if($Msg=="success")
    				{
    				    $Msg = "Profile Picture Updated successfully.<a href='" . SITE_BASE_URL . "login/MyAccount.html'>Profile</a>"; 
    				}
    				else
                     {
                        $Msg="Error while saving the uploaded file.<a href='" . SITE_BASE_URL . "login/MyAccount.html'>Profile</a>";
                     }
                 }
                 else
                 {
                    $Msg="Error while saving the uploaded file.<a href='" . SITE_BASE_URL . "login/MyAccount.html'>Profile</a>";
                 }
                
                include"header.php";

        		echo '<div id="content">';
        		
        		echo	\Html\HtmlClass::PrintFormHeaderName("Profile - Picture Upate");
        		echo '	<div class="container">
                            <div class="grid-24">';
                echo '			<div class="notify notify-success">
                                    <h3 align="center"><br/>' . $Msg .'</h3>
                                </div>';
        
                echo '		</div>
                         </div>
                     </div>';
        
                include"footer.php";
        
                echo '</body></html>';
            }
        }
    }
    
    
    public static function SaveFileUploads(){
		
		 \Html\HtmlClass::init();
         \settings\session\sessionClass::CheckSession();  
         $user_id   = \settings\session\sessionClass::GetSessionDisplayName();
         
         
         $ArrQueries						= array();
	    
	     $Mode      = isset($_REQUEST["mode"]) ? $_REQUEST["mode"] : "";
        
         $UploadID     = isset($_REQUEST["UploadID"]) ? $_REQUEST["UploadID"] : "";
         $UploadPDA     = isset($_REQUEST["UploadPDA"]) ? $_REQUEST["UploadPDA"] : "";
         
         
         
        // if ( $UploadID != "" ){
             
              $UploadIDName = \login\loginClass::myfolderfileupload("UploadID");
             
        // }
         
         
         
         //if ( $UploadPDA != "" ){
             
             $UploadPDAName = \login\loginClass::myfolderfileupload("UploadPDA");
             
         //}
         
 
        
        $queryStr       ="update user_master set upload_id =:upload_id , upload_pda =:upload_pda  where USER_ID=:user_id";
    
		$ColValarray    = array("upload_id"=> $UploadIDName, "upload_pda"=> $UploadPDAName,  "user_id"=> $user_id) ; 

		$Queryarray     = array($queryStr,$ColValarray);
		$ArrQueries[]   = $Queryarray;
		
		$Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
	    
	    
         include"header.php";
         
        $Msg = "Profile Picture Updated successfully.<a href='" . SITE_BASE_URL . "login/MyAccount.html'>Back</a>"; 

		echo '<div id="content">';
		
		echo	\Html\HtmlClass::PrintFormHeaderName("Profile - File Upload");
		echo '	<div class="container">
                    <div class="grid-24">';
        echo '			<div class="notify notify-success">
                            <h3 align="center"><br/>' . $Msg .'</h3>
                        </div>';

        echo '		</div>
                 </div>
             </div>';

        include"footer.php";

        echo '</body></html>';
        
    }
    
    
 
    
    public static function myfolderfileupload($UploadName){
       
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        

        if (isset($_FILES[$UploadName]["tmp_name"])){
            //echo "in";
            $tmpname = $_FILES[$UploadName]["tmp_name"];
            $filename = $_FILES[$UploadName]["name"];
            $actfilename = str_replace(",", "_", $filename); 
            $UplFilePath = "uploads/UserProofImage/" . $actfilename; 
            
            if (move_uploaded_file($tmpname, $UplFilePath) ){
                if (self::$UploadedFiles == ""){
                    self::$UploadedFiles = $actfilename;
                }
                else{
                    self::$UploadedFiles = self::$UploadedFiles . "," . $actfilename;
                }

				//echo self::$UploadedFiles;
            }
        }else{
            
            $filename = "";
            
        }
        
		return $filename;

    }
    
    //==================================
    public static function SendMail(){
        $UserId=$_REQUEST["email"];
        \Html\HtmlClass::Init();
        include "header.php";
        $MailIdArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT EMAIL_ADDRESS_FOR_INVOICE FROM user_master um,user_account_details uad WHERE um.id=uad.user_id and um.user_id='{$UserId}')");
	    $MailId                  = $MailIdArr["0"];
	    
	    $PasswordArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT PASSWORD FROM user_master um WHERE um.user_id='{$UserId}')");
	    $Password                    = $PasswordArr["0"];
        $Listpath =  SITE_BASE_URL. "login/index.html";
        echo '	<div id="content">';
        echo	    '<div class="widget-title pl-4">
                       <h3>Login - Forgot Password</h3>
                     </div>';
        echo '		<div class="container">
                        <div class="grid-24">';
       
    		$inputSubject="Resetting your password for DU VAL PRIVATE OFFIC";
            $to = stripcslashes($MailArr[$x]);
            $subject = stripcslashes($inputSubject);
    
            $message = '
            <!DOCTYPE html>
            <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
               <style>
               h1.img-caption {
                position: absolute;
                top: 0%;
                left: 37%;
                transform: translate(-50%, -50%);
                font-size: 44px;
                font-weight: 900;
                color: #fff;
            }
               </style>
               <body bgcolor="#FFFFFF" text="#919191" alink="#cccccc" vlink="#cccccc" style="margin: 0; padding: 0; background-color: #3f3f3f; color: #919191;">
                  <center>
                     <table role="presentation" class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#3f3f3f" style="background-color: #3f3f3f;" id="ko_sideArticleBlock_4">
                        <tbody>
                           <tr>
                              <td class="vb-outer" align="center" valign="top" style="padding-left: 9px; padding-right: 9px; font-size: 0;">
                                 <div style="margin: 0 auto; max-width: 570px; -mru-width: 0px;">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="9" bgcolor="#FFFF94" width="570" class="vb-row" style="border-collapse: separate; width: 100%; background-color: #FFFF94; mso-cellspacing: 9px; border-spacing: 9px; max-width: 570px; -mru-width: 0px;">
                                       <tbody>
                                          <tr>
                                             <td align="center" valign="top" style="font-size: 0;">
                                                <div style="width: 100%; max-width: 552px; -mru-width: 0px;">
                                                   <div class="mobile-full" style="display: inline-block; vertical-align: top; width: 100%; max-width: 184px; -mru-width: 0px; min-width: calc(33.333333333333336%); max-width: calc(100%); width: calc(304704px - 55200%);">
                                                      <table role="presentation" class="vb-content" border="0" cellspacing="9" cellpadding="0" width="184" align="left" style="border-collapse: separate; width: 100%; mso-cellspacing: 9px; border-spacing: 9px; -yandex-p: calc(2px - 3%);">
                                                         <tbody>
                                                            <tr>
                                                               <td width="100%" valign="top" align="center" class="links-color">
                                                                  
            													  <div class="img-wrapper gold-img">
            														<img border="0" hspace="0" align="center" vspace="0" width="166" style="border: 0px; display: block; vertical-align: top; height: auto; margin: 0 auto; color: #3f3f3f; font-size: 13px; font-family: Arial, Helvetica, sans-serif; width: 100%; max-width: 166px; height: auto;" src="https://duvalknowledge.com/dpo/assets/img/Layer-19.png" class="img-fluid">
            														<h1 class="img-caption">DPO</h1>
            													  </div>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                   <div class="mobile-full" style="display: inline-block; vertical-align: top; width: 100%; max-width: 368px; -mru-width: 0px; min-width: calc(66.66666666666667%); max-width: calc(100%); width: calc(304704px - 55200%);">
                                                      <table role="presentation" class="vb-content" border="0" cellspacing="9" cellpadding="0" width="368" align="left" style="border-collapse: separate; width: 100%; mso-cellspacing: 9px; border-spacing: 9px; -yandex-p: calc(2px - 3%);">
                                                         <tbody>
                                                            <tr>
                                                               <td width="100%" valign="top" align="left" style="font-weight: normal; color: #3f3f3f; font-size: 18px; font-family: Arial, Helvetica, sans-serif; text-align: left;"><span style="font-weight: normal;">DU VAL PRIVATE OFFICE</span></td>
                                                            </tr>
                                                            <tr>
                                                               <td class="long-text links-color" width="100%" valign="top" align="left" style="font-weight: normal; color: #3f3f3f; font-size: 13px; font-family: Arial, Helvetica, sans-serif; text-align: left; line-height: normal;">
                                                                  <p style="margin: 1em 0px; margin-bottom: 0px; margin-top: 0px;">
                                                                    Password for your Login.
                                                                  </p>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td valign="top" align="left">
                                                                  <table role="presentation" cellpadding="6" border="0" align="left" cellspacing="0" style="border-spacing: 0; mso-padding-alt: 6px 6px 6px 6px; padding-top: 4px;">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td width="auto" valign="middle" align="left" bgcolor="#444444" style="text-align: center; font-weight: normal;
                                                                           padding: 6px; padding-left: 18px; padding-right: 18px; background-color: #3f3f3f; color: #FFFFFF; font-size: 13px;
                                                                           font-family: Arial, Helvetica, sans-serif; border-radius: 4px;"><a style="text-decoration: none; font-weight: normal;
                                                                           color: #FFFFFF; font-size: 13px; font-family: Arial, Helvetica, sans-serif;" href="javascript:void(0)">' .$Password.'</a></td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </center>
               </body>
            </html>
            ';
            //echo $message;
            //exit;
            // $ccBcc="bathar.ghouse@gmail.com";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'Cc: '.$ccBcc.'' . "\r\n";
            $headers .= "From: <info@duvalknowledge.co.nz>" . "\r\n";
            $sent = mail($MailId,$subject,$message,$headers);
            $mailIds.=$MailId." ";
            if($sent){
             $ErrMsg= "Referred Successfully to";
            }
            else{
             $ErrMsg= "Sorry! Your submission is failed to .";
            }
        echo '          <div class="notify notify-success">
                            <h3 align="center">
                                <br/>New Password sent to '.$MailId.' <input type="hidden" value="' .$Listpath.'" id="myInput">
                                <br><br>
                                <a href="' .$Listpath.'">Back</a>
                            </h3>  
                            
                        </div>';
                            
            
        echo '			</div>
                    </div>
                </div>';

        echo '</body>
        </html>
        <script>
        function myFunction() {
          var copyText = document.getElementById("myInput");
          copyText.type="text";
          copyText.select();
          copyText.setSelectionRange(0, 99999)
          document.execCommand("copy");
          copyText.type="hidden";
        }
        </script>';
        include "footer.php";  
        
    }
    public static function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    
    //==================================    
}
