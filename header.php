<?php
\login\loginClass::Init();
\settings\session\sessionClass::CheckSession(); 
$rows = \login\loginClass::GetUserFullName();
$i = 1;
foreach ($rows as $row) 
{
    // print_r($row);
    $LoginFirstName         = $row["first_name"];
    $LoginLastName          = $row["last_name"];
    $LoginUserName          = $row["user_id"];
    $LoginUserId            = $row["id"];
    $ProfilePic             = $row["image_file"];
    $CountryName            = $row["country_name"];
    $portifolioAdvisorId    = $row["Advisor"];
    if($_SESSION["BaseCurrency"]!="" && $_SESSION["BaseCurrency"]!=null)
    {
        $Currency   = $_SESSION["BaseCurrency"];
    }
    else
    {
        $Currency       =   $row["currency"];
    }
    if($_SESSION["BaseCountry"]!="" && $_SESSION["BaseCountry"]!=null)
    {
        $CountryCode    =   $_SESSION["BaseCountry"];
    }
    else
    {
        $CountryCode    =   $row["country_code"];
    }
    if($ProfilePic=='' || $ProfilePic==null)
    {
        $ProfilePic='NoProfile.jpg';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DU VAL PRIVATE OFFICE</title>
    <link rel="icon" type="image/ico" sizes="16x16" href="<?php echo SITE_BASE_URL;?>dashboard/assets/img/favicon.ico">
    <link type="text/css" rel="stylesheet" href="<?php echo SITE_BASE_URL;?>dashboard/assets/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo SITE_BASE_URL;?>dashboard/assets/css/owl.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo SITE_BASE_URL;?>dashboard/assets/fontawesome/css/all.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo SITE_BASE_URL;?>dashboard/assets/css/data-table.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/vectormap/css/jqvmap.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo SITE_BASE_URL;?>dashboard/assets/css/master.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo SITE_BASE_URL;?>dashboard/assets/css/grand-master.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo SITE_BASE_URL;?>dashboard/assets/css/custom.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>dashboard//assets/plugins/wysihtml5/css/bootstrap-wysihtml5.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css">
    <script src="<?php echo SITE_BASE_URL;?>dashboard/assets/plugins/common/common.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="666360874265-78llhedddolcdjv5g9h3m3artaqklaao.apps.googleusercontent.com">
            <link rel="stylesheet" type="text/css" href="https://duvalknowledge.com/latest-dpo/assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css">

</head>
<body>
    <?php
    global $controller,$action;
    if ($action == "PropertyInvestar")
    {
        $WrpperChk ="main-wrapper-1234";
    }
    else
    {
        $WrpperChk ="main-wrapper";
    } 
    ?>
    <!-- Main Wrapper -->
    <div class="main-flex" id="<?php echo $WrpperChk;?>">
        <?php include'SideBar.php'; ?>
        <?php include'HeaderBar.php'; ?>
               