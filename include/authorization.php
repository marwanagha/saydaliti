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

    )

);

//todo admin pages


//var_dump($_SESSION);exit;/

if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
$current_role_pages = $Super_Admin_pages;
}

//todo
//else if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2) {
//    $current_role_pages = $Admin_pages;
//}

//var_dump($Super_Admin_pages);
//var_dump($_SESSION);

if(!isset($_SESSION['role_id']) && empty($_SESSION['role_id']))
{

    $page='login';

}

else
{

    $page = isset($_GET['page']) ? $_GET['page'] : null;
    $page = empty($page) ? 'categories' : make_safe($page);
    $page = in_array($page, $current_role_pages) ? $page : $pages['404'];

}