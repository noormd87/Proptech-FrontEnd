<?php
namespace index;
//ob_start(); 
session_start(['cache_limiter' => 'private' /*, 'read_and_closed' => true*/ ]); 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

//echo "hiiii";
require_once('includes/settings.constants.php');        // Define constants here..
require_once('includes/settings.config');               // Define db configuration arrays here

require_once('includes/DBConnection.php');              // Connection Class
require_once('classes/sessionInterface.php');              // Connection Class
require_once 'classes/HtmlInterface.php';
require_once 'classes/loginInterface.php';
require_once 'classes/dashboardInterface.php';


require_once 'classes/MastersInterface.php';
require_once 'classes/ajaxInterface.php';
require_once 'classes/PropertyInterface.php';
require_once 'classes/PortfolioInterface.php';
require_once 'classes/myfolderInterface.php';
require_once 'classes/ClientMailInterface.php';  // Arzath - 15-01-2020
require_once 'classes/MemberShipInterface.php';  // Arzath - 16-01-2020
require_once 'classes/apiInterface.php';  // Arzath - 16-01-2020
require_once 'classes/inputsInterface.php';  // Arzath - 16-01-2020
require_once 'includes/financial_class.php';  // Yasir - 19-04-2020
require_once 'classes/pdfcrowd.php';  // Yasir - 23-04-2020


//echo $_SERVER["PHP_SELF"];
//exit;

use Html;
use Html\Elements; 
use settings\session;
use DBConn; 
use login; 

//use settings\session; 

$controller     =   $_REQUEST["controller"];
$action         =   $_REQUEST["action"];
$msg            =   $_REQUEST["msg"];
//echo "$controller";



if ($controller == ""){  
    $controller     =   "login";
}

if ($action == ""){
    $action         =   "index";
}

//echo "{$controller},{$action}";exit;

$ClassName          =   "\\{$controller}\\{$controller}Class";
$MethodName         =   $action;


//Property/PropertyInvestar.html?country=3

//echo "$ClassName";exit;

if ($controller == "Property" and $MethodName == "PropertyInvestar"){
    //echo "hai"; exit;
    //require_once("header.php");
}

$ClassName::init();
echo $ClassName::$MethodName( $msg );


//ob_end_flush(); // outputs HELLO