<?php
 ini_set('display_errors','1');
    error_reporting(E_ALL);
ob_start();
session_start();
$filePath = realpath(dirname(__FILE__));
// echo $filePath;
define("_APP_RUN", true);
require ($filePath.'/../AppINIT.php');
// require('../Classes/Auto_responder_class.php');

require ($filePath.'/../lib/admin.init.php');
require ($filePath.'/../lib/permission.php');



// $db = new Database();

// check admin login or not....................
_isadmin();


// check session and cookie for go to index page
$slid = $_SESSION['lid'];
$ulid = $_COOKIE["_lid"];
if ($slid != $ulid) {
    conf('login.php','e','Invalid Token Please Login Again');
}
$aid=$_SESSION['aid'];
$theme=  appconfig('admintheme');
$xbrand = appconfig('BrandName');



?>

