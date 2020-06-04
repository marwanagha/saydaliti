<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title><?php echo $page_title; ?></title>
    <link  rel="shortcut icon" href="<?php echo $ASSET_URL ?>img/logo_saydaliti.png">
    <link rel="stylesheet" href="<?php echo $ASSET_URL ?>css/pages/404.css">
    <!--    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">-->
    <!--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">-->
    <?php

    foreach ($shared_css as $css) {
        if (isset($css)) {
            echo "<link href=\"{$css}\" rel=\"stylesheet\" />";
        }
    }

    $id = isset($_GET['id']) ? make_safe($_GET['id']) : null;

    ?>


</head>

<body style="background: #f6effb">

<!--====================================================
                         MAIN NAVBAR
======================================================-->
<header class="header">
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid ">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                    <a href="" class="navbar-brand">
                        <div class="brand-text brand-big hidden-lg-down"><img
                                    src="<?php echo $ASSET_URL ?>img/logo_saydaliti2.png" class="header-img icon-admin    " alt="Logo"
                                    class="img-fluid"></div>
                        <div class="brand-text brand-small admin-header-small-img"><img class="icon-admin"  src="<?php echo $ASSET_URL ?>img/logo3.png" alt="Logo" style="display: none;"></div>
                    </a>
                    <a href="" class="navbar-brand">
                        <div class="brand-text brand-big hidden-lg-down"> My Pharma Order</div>
                        <div class="brand-text brand-small admin-header-small-img"></div>
                    </a>
                    <a id="toggle-btn" href="#" class="menu-btn active">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
            </div>
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Expand-->
                <?php if (isset($_SESSION['role_id']) && !empty($_SESSION['role_id'])) { ?>
                    <li class="nav-item d-flex align-items-center full_scr_exp"><a id="logout" class="nav-link "
                                                                                   href="<?php if(isset($id) && $id!=null ) echo '../requests/logout.php'; else echo 'requests/logout.php';?>">Logout</a>
                    </li>
                <?php } ?>

<!--                <li class="nav-item d-flex align-items-center full_scr_exp"><a-->
<!--                            href="--><?php //if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') echo '?lang=ar'; else echo '?lang=en'; ?><!--">--><?php //if ($_SESSION['lang'] == 'ar') echo 'English'; else echo $lang['arabic'] ?><!--</a>-->
<!--                </li>-->
            </ul>
        </div>
    </nav>
</header>
<div id="loader" class=" hidden ">

</div>
<!--====================================================
                        PAGE CONTENT
======================================================-->


