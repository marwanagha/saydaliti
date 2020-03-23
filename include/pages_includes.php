<?php
//exploding css arrays in the header
//exploding js arrays in the footer
$id = isset($_GET['id']) ? make_safe($_GET['id']) : null;
$rtl = isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar' ? $ASSET_URL.'css/rtl.css' : null;
$rtl_js = isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar' ? $ASSET_URL.'js/lang/ar.js' : $ASSET_URL.'js/lang/en.js';
$rtl_js1 = isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar' ? 'assets/site/js/lang/ar.js' : 'assets/site/js/lang/en.js';
$page_title = $lang['site_name'];

$shared_css = array(
    "https://fonts.googleapis.com/css?family=Roboto+Condensed",
    $ASSET_URL."css/bootstrap.min.css",
    $ASSET_URL."css/datatable.css",
    $ASSET_URL."font-awesome-4.7.0/css/font-awesome.min.css",
    $ASSET_URL."css/font-icon-style.css",
    $ASSET_URL."css/style.default.css",
    $ASSET_URL."css/ui-elements/card.css",
    $ASSET_URL."css/ui-elements/buttons.css",
    $ASSET_URL."css/pages/login.css",
    $ASSET_URL."css/pages/404.css",
    $ASSET_URL."css/style.css",
    $ASSET_URL."css/bootstrap-select.css",
//    $rtl
    );


$shared_js = array(
    $ASSET_URL."js/jquery.min.js",
    $ASSET_URL."js/datatable-jquery.js",
    $ASSET_URL."js/datatable-bootstrap.js",
    $ASSET_URL."js/popper/popper.min.js",
    $ASSET_URL."js/tether.min.js",
    $ASSET_URL."js/bootstrap.min.js",
    $ASSET_URL."js/bootstrap-dropdownhover.min.js",
    $ASSET_URL."js/bootstrap-select.js",
    $ASSET_URL."js/jquery.lwtCountdown-1.0.js",
    $ASSET_URL."js/jquery.cookie.js",
    $ASSET_URL."js/jquery.validate.min.js",
    $ASSET_URL."js/chart.min.js",
    $ASSET_URL."js/front.js",
    $ASSET_URL . "js/notify.min.js",
    $ASSET_URL."js/custom.js",
    $rtl_js,
    $rtl_js1
    );


$page_css = array(


    );
$page_js = array(

    );

