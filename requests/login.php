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


if($response->code==1)
{

//    var_dump($response);exit;

    $_SESSION['role_id']=$response->data->RoleId;
    $_SESSION['admin_id']=$response->data->Id;
    $_SESSION['username']=$response->data->Username;

    redirect('categories', $path);

}else {

    $_SESSION['error_msg'] = $response->message;
    $_SESSION['msg_type']=-1;
    redirect('login', $path);
    exit();
}


?>