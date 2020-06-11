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
                <li class="<?php echo $page == 'categories' ? 'active' : '' ?>">
                    <a
                            href="<?php echo $APP_ROOT . $pages['categories'] ?>">
                        <div class="row">
                            <div class="col col-xl-2"><img class="side-menu-icon mr-1"
                                                           src="<?php echo $ASSET_URL ?>img/categories.png"></div>
                            <div class="col col-xl-10">Categories Management
                            </div>
                        </div>
                    </a></li>
                <?php
            } ?>

            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                ?>
                <li class="<?php echo $page == 'manufacturers' ? 'active' : '' ?>"><a
                            href="<?php echo $APP_ROOT . $pages['manufacturers'] ?>">
                        <div class="row">
                            <div class="col col-xl-2"><img class="side-menu-icon mr-1"
                                                           src="<?php echo $ASSET_URL ?>img/manufacturer.png"></div>
                            <div class="col col-xl-10">Manufacturers
                                Management
                            </div>
                        </div>
                    </a></li>
                <?php
            } ?>

            <?php if (isset($_SESSION['role_id']) && ($_SESSION['role_id'] == 2)) {
                ?>
                <li class="<?php echo $page == 'wa-info' ? 'active' : '' ?>"><a
                            href="<?php echo $APP_ROOT . $pages['wa-info'] ?>">
                        <div class="row">
                            <div class="col col-xl-2"><img class="side-menu-icon mr-1"
                                                           src="<?php echo $ASSET_URL ?>img/settings.png"></div>

                            <div class="col col-xl-10"><?php echo $lang['my_warehouse_info'] ?>
                            </div>
                        </div>
                    </a></li>
                <?php
            } ?>

            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2) {
                ?>
                <li class="<?php echo $page == 'drug-list' ? 'active' : '' ?>"><a
                            href="<?php echo $APP_ROOT . $pages['drug-list'] ?>">
                        <div class="row">
                            <div class="col col-xl-2"><img class="side-menu-icon mr-1"
                                                           src="<?php echo $ASSET_URL ?>img/Drugs.png"></div>
                            <div class="col col-xl-10"><?php echo $lang['drugs_management'] ?>

                            </div>
                        </div>
                    </a></li>
                <?php
            } ?>

            <?php if (isset($_SESSION['role_id']) && ($_SESSION['role_id'] == 2)) {
                ?>
                <li class="<?php echo $page == 'wa-drugs' ? 'active' : '' ?>"><a
                            href="<?php echo $APP_ROOT . $pages['wa-drugs'] ?>">
                        <div class="row">
                            <div class="col col-xl-2"><img class="side-menu-icon mr-1"
                                                           src="<?php echo $ASSET_URL ?>img/my_drugs.png"></div>
                            <div class="col col-xl-10">
                                <?php echo $lang['my_drugs'] ?>

                            </div>
                        </div>
                    </a></li>
                <?php
            } ?>

            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                ?>
                <li class="<?php echo $page == 'pharmacies-list' ? 'active' : '' ?>"><a
                            href="<?php echo $APP_ROOT . $pages['pharmacies-list'] ?>">
                        <div class="row">
                            <div class="col col-xl-2"><img class="side-menu-icon mr-1"
                                                           src="<?php echo $ASSET_URL ?>img/pharmacy.png"></div>
                            <div class="col col-xl-10">Pharmacies
                                Management
                            </div>
                        </div>
                    </a></li>
                <?php
            } ?>

            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                ?>
                <li class="<?php echo $page == 'warehouses-list' ? 'active' : '' ?>"><a
                            href="<?php echo $APP_ROOT . $pages['warehouses-list'] ?>">
                        <div class="row">
                            <div class="col col-xl-2"><img class="side-menu-icon mr-1"
                                                           src="<?php echo $ASSET_URL ?>img/data-warehouse.png"></div>
                            <div class="col col-xl-10">Warehouses
                                Management
                            </div>
                        </div>
                    </a></li>
                <?php
            } ?>

            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                ?>
                <li class="<?php echo $page == 'ads-list' ? 'active' : '' ?>"><a
                            href="<?php echo $APP_ROOT . $pages['ads-list'] ?>">
                        <div class="row">
                            <div class="col col-xl-2"><img class="side-menu-icon mr-1"
                                                           src="<?php echo $ASSET_URL ?>img/ads_.png"></div>
                            <div class="col col-xl-10">Ads Management
                            </div>
                        </div>
                    </a>
                </li>
                <?php
            } ?>

            <?php if (isset($_SESSION['role_id']) && ($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2)) {
                ?>
                <li class="<?php echo $page == 'orders-list' ? 'active' : '' ?>"><a
                            href="<?php echo $APP_ROOT . $pages['orders-list'] ?>">
                        <div class="row">
                            <div class="col col-xl-2"><img class="side-menu-icon mr-1"
                                                           src="<?php echo $ASSET_URL ?>img/order.png"></div>
                            <div class="col col-xl-10"><?php echo $lang['orders_management'] ?>
                            </div>
                        </div>
                    </a></li>
                <?php
            } ?>

            <?php if (isset($_SESSION['role_id']) && ($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2)) {
                ?>
                <li class="<?php echo $page == 'offers-list' ? 'active' : '' ?>"><a
                            href="<?php echo $APP_ROOT . $pages['offers-list'] ?>">
                        <div class="row">
                            <div class="col col-xl-2"><img class="side-menu-icon mr-1"
                                                           src="<?php echo $ASSET_URL ?>img/offer.png"></div>
                            <div class="col col-xl-10"><?php echo $lang['offers_management'] ?>
                            </div>
                        </div>
                    </a></li>
                <?php
            } ?>


        </ul>
    </nav>
                                                                                                          