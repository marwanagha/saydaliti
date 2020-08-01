<?php
session_start();
//var_dump($_SESSION);
require_once "functions.php";
//$API_ROOT = 'mypharmavv-001-site1.gtempurl.com/api/';
$API_ROOT = 'mypharmavv-001-site1.gtempurl.com/api/';
$API_ROOT = 'http://api.mypharma-order.com:8080/APIS/api/';
$APP_ROOT = "/saydaliti/";
//$APP_ROOT = "https://saydaliti2.000webhostapp.com/";
//$APP_ROOT = "http://mypharma-order.com/";

$FILES_ROOT = $APP_ROOT.'files/';
$ASSET_URL = $APP_ROOT . 'assets/';
//$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
define("DEFAULT_LANGUAGE", "en");
if (isset($_GET['lang']) || !empty($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
if (!isset($_SESSION['lang']) || empty($_SESSION['lang'])) {
    $_SESSION['lang'] = DEFAULT_LANGUAGE;
}
setcookie('language', DEFAULT_LANGUAGE);
$current_lang = $_SESSION['lang'];
require_once "page_names.php";
require_once "enum.php";
if ($current_lang == 'en')
    require_once "lang/en.php";
else
    require_once "lang/ar.php";
require_once "authorization.php";
require_once "pages_includes.php";









