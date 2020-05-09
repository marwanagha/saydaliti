<div class="page-content d-flex align-items-stretch" style=" min-height:660px; height: 100% ">
<nav class="side-navbar">
    <div class="sidebar-header d-flex align-items-center">
        <div class="row">

            <div class="col-3">

                <i class="fa fa-user-circle fa-3x"></i>
            </div>
            <div class="col-9" style="margin-top: 13px">
                <div class="title" STYLE="margin: auto">
                    <h5 class="h5 text-center"><?php echo $_SESSION['username']; ?></h5>
                </div>
            </div>
        </div>

    </div>
    <hr>
    <!-- Sidebar Navidation Menus-->
    <ul class="list-unstyled">


        <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
            ?>
            <li class="<?php echo $page=='categories' ? 'active':''?>" ><a href="<?php echo $APP_ROOT . $pages['categories'] ?>"><i class="fa fa-cog"></i>Categories
                    Management</a></li>
            <?php
        } ?>

        <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
            ?>
            <li class="<?php echo $page=='manufacturers' ? 'active':''?>"><a href="<?php echo $APP_ROOT . $pages['manufacturers'] ?>"><i class="fa fa-cog"></i>Manufacturers
                    Management</a></li>
            <?php
        } ?>

        <?php if (isset($_SESSION['role_id']) && ($_SESSION['role_id'] == 2 )) {
            ?>
            <li class="<?php echo $page=='wa-info' ? 'active':''?>"><a href="<?php echo $APP_ROOT . $pages['wa-info'] ?>"><i class="fa fa-cog"></i>My Warehouse Info</a></li>
            <?php
        } ?>

        <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2 ) {
            ?>
            <li class="<?php echo $page=='drug-list' ? 'active':''?>"><a href="<?php echo $APP_ROOT . $pages['drug-list'] ?>"><i class="fa fa-cog"></i>Drugs Management</a></li>
            <?php
        } ?>

        <?php if (isset($_SESSION['role_id']) && ($_SESSION['role_id'] == 2 )) {
            ?>
            <li class="<?php echo $page=='wa-drugs' ? 'active':''?>"><a href="<?php echo $APP_ROOT . $pages['wa-drugs'] ?>"><i class="fa fa-cog"></i>My Drugs List</a></li>
            <?php
        } ?>

        <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
            ?>
            <li class="<?php echo $page=='pharmacies-list' ? 'active':''?>"><a href="<?php echo $APP_ROOT . $pages['pharmacies-list'] ?>"><i class="fa fa-cog"></i>Pharmacies Management</a></li>
            <?php
        } ?>

        <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
            ?>
            <li class="<?php echo $page=='warehouses-list' ? 'active':''?>"><a href="<?php echo $APP_ROOT . $pages['warehouses-list'] ?>"><i class="fa fa-cog"></i>Warehouses Management</a></li>
            <?php
        } ?>

        <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
            ?>
            <li class="<?php echo $page=='ads-list' ? 'active':''?>"><a href="<?php echo $APP_ROOT . $pages['ads-list'] ?>"><i class="fa fa-cog"></i>Ads Management</a></li>
            <?php
        } ?>

        <?php if (isset($_SESSION['role_id']) && ($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2 )) {
            ?>
            <li class="<?php echo $page=='orders-list' ? 'active':''?>"><a href="<?php echo $APP_ROOT . $pages['orders-list'] ?>"><i class="fa fa-cog"></i>Orders Management</a></li>
            <?php
        } ?>

        <?php if (isset($_SESSION['role_id']) && ($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2 )) {
            ?>
            <li class="<?php echo $page=='offers-list' ? 'active':''?>"><a href="<?php echo $APP_ROOT . $pages['offers-list'] ?>"><i class="fa fa-cog"></i>Offers Management</a></li>
            <?php
        } ?>












    </ul>
</nav>                                                                                                      