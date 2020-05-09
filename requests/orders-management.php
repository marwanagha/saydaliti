<?php

require '../include/config.php';
//var_dump(json_encode($_POST));exit;
 if ((isset($_POST['action']) && $_POST['action'] == 'change-status')) {

    $status = isset($_POST['status']) ? make_safe($_POST['status']) : null;
    $order_id = isset($_POST['order_id']) ? make_safe($_POST['order_id']) : null;

    $post_array = array(
        'Status'=>$status,
        'Id'=>$order_id
    );

    $respons = api_post('OrdersAdmin/ChangeOrderStatus', $post_array);

    if ($respons->code == 1) {
        echo 1;
    } else {
        echo -1;
    }


}
else if (isset($_POST['draw'])) {

    $respons = api_post('OrdersAdmin/LoadOrderList', $_POST);

    echo json_encode($respons);

}







