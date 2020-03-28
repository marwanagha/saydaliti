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

        <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
            ?>
            <li class="<?php echo $page=='drug-list' ? 'active':''?>"><a href="<?php echo $APP_ROOT . $pages['drug-list'] ?>"><i class="fa fa-cog"></i>Drugs Management</a></li>
            <?php
        } ?>





    </ul>
</nav>                                                                                                      