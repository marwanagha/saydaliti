<?php//$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";////header('Location: include/pages/home.php');//var_dump($actual_link);//var_dump($_GET['page']);//?><?phprequire_once "include/config.php";if($page=='login'){    require_once "include/layout/header.php";    require_once "include/pages/login.php";    require_once "include/layout/footer.php";    exit;}if($page=='404'){    require_once "include/layout/header.php";    require_once "include/pages/404.php";    require_once "include/layout/footer.php";    exit;}//var_dump($page);exit;require_once "include/layout/header.php";require_once "include/layout/side-menu.php";require_once "include/pages/{$page}.php";require_once "include/layout/footer.php";?>