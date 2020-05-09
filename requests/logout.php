<?php
/**
 * Created by PhpStorm.
 * User: Marwan
 * Date: 2019-02-16
 * Time: 2:27 AM
 */


include "../include/config.php";
$path = '../';


unset($_SESSION['admin_id']);
unset($_SESSION['role_id']);
unset($_SESSION['username']);
unset($_SESSION['error_msg']);
unset($_SESSION['session']);
unset($_SESSION['msg_type']);
if (isset($_SESSION['change_password']))
    unset($_SESSION['change_password']);

//var_dump($_SESSION);
redirect('login', $path);