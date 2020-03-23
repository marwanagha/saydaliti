<?php
/**
 * Created by PhpStorm.
 * User: Marwan
 * Date: 2019-02-16
 * Time: 2:27 AM
 */
include "../include/functions.php";
$path='../';


unset($_SESSION['admin_id']);
unset($_SESSION['ad_role']);
unset($_SESSION['admin_name']);
unset($_SESSION['error_msg']);
unset($_SESSION['change_password_admin']);
unset($_SESSION['msg_type']);

//var_dump($_SESSION);
    redirect('login',$path);