<?php
ob_start(); 
session_start(); 
include_once 'includes/settings.constants.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$cur_time = date('Y-m-d H:i:s',time());

if (isset($_SESSION["UserName"])){
    unset($_SESSION["UserName"]);
}

if (isset($_SESSION['LastLogin'])){
    unset($_SESSION['LastLogin']);
}

$BaseUrl = SITE_BASE_URL; 

header("Location: " . $BaseUrl);
exit;
?>
<?php
ob_end_flush();

