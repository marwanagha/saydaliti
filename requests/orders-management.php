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
 else  if ((isset($_POST['action']) && $_POST['action'] == 'calculate-profits')) {

     $FromDate = isset($_POST['from_date']) ? make_safe($_POST['from_date']) : null;
     $ToDate = isset($_POST['to_date']) ? make_safe($_POST['to_date']) : null;
     $WarehouseId = isset($_POST['warehouse_id']) ? make_safe($_POST['warehouse_id']) : null;

     $post_array = array(
         'FromDate'=>$FromDate,
         'ToDate'=>$ToDate,
         'WarehouseId'=>$WarehouseId
     );
//     var_dump(json_encode($post_array));exit;

     $respons = api_post('OrdersAdmin/GetProfits', $post_array);

    $array = array ();
     if ($respons->code == 1) {
         $array['code']=1;
         $array['data']=$respons->data->ProfitValue;
         echo json_encode($array);
     } else {
         $array['code']=-1;
         $array['message']=$respons->message;
         echo json_encode($array);
     }


 }
 else  if ((isset($_POST['action']) && $_POST['action'] == 'order-details')) {


     $order_Id = isset($_POST['order_id']) ? make_safe($_POST['order_id']) : null;

     $post_array = array(

         'Id'=>$order_Id
     );

     $respons = api_post('OrdersAdmin/GetOrderDetails', $post_array);
//var_dump($respons);exit;
     $array = array ();




     if ($respons->code == 1) {
         $array['code']=1;
         $array['data']=$respons->data->OrderItems;
         echo json_encode($array);
     } else {
         $array['code']=-1;
         $array['message']=$respons->message;
         echo json_encode($array);
     }


 }
else if (isset($_POST['draw'])) {
//var_dump(json_encode($_POST));exit;
//var_dump($_SESSION);exit;

    $respons = api_post('OrdersAdmin/LoadOrderList', $_POST);

    echo json_encode($respons);

}







