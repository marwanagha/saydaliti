<?php


$standalone_pages = array(
    $pages['404'],
    $pages['login'],
    $pages['index'],

);

$Super_Admin_pages = array_merge(
    $standalone_pages,

    array(


        $pages['categories'],
        $pages['manufacturers'],
        $pages['drug-form'],
        $pages['drug-list'],
        $pages['manufacturer-form'],
        $pages['pharmacy-form'],
        $pages['pharmacies-list'],
        $pages['warehouses-list'],
        $pages['ads-list'],
        $pages['warehouse-form'],
        $pages['orders-list'],
        $pages['offers-list'],
        $pages['offer-form'],

    )

);


$Admin_pages = array_merge(
    $standalone_pages,

    array(

        $pages['orders-list'],
        $pages['wa-info'],
        $pages['drug-list'],
        $pages['wa-drugs'],
        $pages['offers-list'],
        $pages['offer-form'],


    )

);


if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
    $current_role_pages = $Super_Admin_pages;
} else if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2) {
    $current_role_pages = $Admin_pages;
}


if (!isset($_SESSION['role_id']) && empty($_SESSION['role_id'])) {

    $page = 'login';

} else {

    $page = isset($_GET['page']) ? $_GET['page'] : null;

    if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {


        $page = empty($page) ? 'categories' : make_safe($page);
    } else {

        $page = empty($page) ? 'orders-list' : make_safe($page);

    }

    $page = in_array($page, $current_role_pages) ? $page : $pages['404'];


}

