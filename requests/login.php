<?php

include '../include/config.php';


$name = isset($_POST['username']) ? make_safe($_POST['username']) : null;
$password = isset($_POST['password']) ? make_safe($_POST['password']) : null;
$path = '../';

$post_array= array (
    'Username'=>$name,
    'Password'=>$password
);

$response = api_post('Admin/Login',$post_array);
//var_dump($response);exit;

if($response->code==1)
{



    $_SESSION['role_id']=$response->data->RoleId;
    $_SESSION['admin_id']=$response->data->Id;
    $_SESSION['username']=$response->data->Username;
    $_SESSION['session']=$response->data->Session;

    if($_SESSION['role_id']==2)
    {
        $_SESSION['change_password']=$response->data->RequireRestPassword;

    }

    if($_SESSION['role_id']==1)
    redirect('categories', $path);
    else
        redirect('orders-list', $path);

}else {


    if($response->message=='USERS0004')
    {
        $_SESSION['error_msg'] = $lang['blocked_warehouse'];
    }else {
        $_SESSION['error_msg'] = $response->message;
    }
    $_SESSION['msg_type']=-1;
    redirect('login', $path);
    exit();
}


?>