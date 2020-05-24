<?php


include '../include/config.php';

if (isset($_POST['action']) && $_POST['action'] == 'show-list-warehouse') {
    $city_id = isset($_POST['city_id']) ? make_safe($_POST['city_id']) : null;
    $post_array = array(
        'Filter' => $city_id
    );
    $respons = api_post('Listing/GetWarehousesByCityList', $post_array);

    if ($respons->code == 1) {
        echo json_encode($respons->data->dropDownListItems);
    } else {
        echo -1;
    }
} else if ((isset($_POST['action']) && $_POST['action'] == 'delete')) {
    $warehouse_id = isset($_POST['warehouse_id']) ? make_safe($_POST['warehouse_id']) : null;
    $status = 2;

    $post_array = array(
        'Status' => $status,
        'Id' => $warehouse_id
    );

    $respons = api_post('WarehousesAdmin/ChangeWarehouseStatus', $post_array);
    if ($respons->code == 1) {
        echo 1;
    } else {
        echo -1;
    }


} else if ((isset($_POST['action']) && $_POST['action'] == 'change-status')) {


    $status = isset($_POST['status']) ? make_safe($_POST['status']) : null;
    $warehouse_id = isset($_POST['warehouse_id']) ? make_safe($_POST['warehouse_id']) : null;

    $post_array = array(
        'Status' => $status,
        'Id' => $warehouse_id
    );

    $respons = api_post('WarehousesAdmin/ChangeWarehouseStatus', $post_array);

    if ($respons->code == 1) {
        echo 1;
    } else {
        echo -1;
    }


} else if (isset($_POST['draw'])) {



    $respons = api_post('WarehousesAdmin/LoadWarehousesList', $_POST);
    echo json_encode($respons);

} else if (isset($_POST['edit-warehouse'])) {


    $Status = 1;
    $Name = isset($_POST['Name']) ? make_safe($_POST['Name']) : null;
    $Username = isset($_POST['Username']) ? make_safe($_POST['Username']) : null;
    $Password = isset($_POST['Password']) ? make_safe($_POST['Password']) : null;
    $Address = isset($_POST['Address']) ? make_safe($_POST['Address']) : null;
    $Longitude = isset($_POST['Longitude']) ? make_safe($_POST['Longitude']) : null;
    $Phones = isset($_POST['Phones']) ? make_safe($_POST['Phones']) : null;
    $Latidude = isset($_POST['Latitude']) ? make_safe($_POST['Latitude']) : null;
    $CityId = isset($_POST['city-select']) ? make_safe($_POST['city-select']) : null;
    $Id = isset($_POST['id']) ? make_safe($_POST['id']) : null;
    $Drugs = isset($_POST['drugs']) ? make_safe_array($_POST['drugs']) : null;
    $SubscriptionPrice = isset($_POST['profit']) ? make_safe($_POST['profit']) : null;
    $SubscriptionType = isset($_POST['SubscriptionType-select']) ? make_safe($_POST['SubscriptionType-select']) : null;


    $post_array = array(

        'Status' => $Status,
        'Name' => $Name,
        'Username' => $Username,
        'Password' => $Password,
        'Address' => $Address,
        'Longitude' => $Longitude,
        'Phones' => $Phones,
        'Latitude' => $Latidude,
        'CityId' => $CityId,
        'Id' => $Id,
        'Drugs' => $Drugs,
        'SubscriptionPrice' => $SubscriptionPrice,
        'SubscriptionType' => $SubscriptionType,


    );

//var_dump(json_encode($post_array));exit;
    $respons = api_post('WarehousesAdmin/EditWarehouse', $post_array);


    if ($respons->code == 1) {
        $_SESSION['error_msg'] = $lang['successfully_done'];
        $_SESSION['msg_type'] = 1;
        redirect('../' . 'warehouse-form/' . $Id);
    } else {
        general_error('../' . 'warehouses-list', $respons->message);
    }

} else if (isset($_POST['add-warehouse'])) {

    $Status = 1;
    $Name = isset($_POST['Name']) ? make_safe($_POST['Name']) : null;
    $Username = isset($_POST['Username']) ? make_safe($_POST['Username']) : null;
    $Password = isset($_POST['Password']) ? make_safe($_POST['Password']) : null;
    $Address = isset($_POST['Address']) ? make_safe($_POST['Address']) : null;
    $Longitude = isset($_POST['Longitude']) ? make_safe($_POST['Longitude']) : null;
    $Phones = isset($_POST['Phones']) ? make_safe($_POST['Phones']) : null;
    $Latidude = isset($_POST['Latitude']) ? make_safe($_POST['Latitude']) : null;
    $CityId = isset($_POST['city-select']) ? make_safe($_POST['city-select']) : null;
    $Drugs = isset($_POST['drugs']) ? make_safe_array($_POST['drugs']) : null;
    $SubscriptionPrice = isset($_POST['profit']) ? make_safe($_POST['profit']) : null;
    $SubscriptionType = isset($_POST['SubscriptionType-select']) ? make_safe($_POST['SubscriptionType-select']) : null;

    $post_array = array(

        'Status' => $Status,
        'Name' => $Name,
        'Username' => $Username,
        'Password' => $Password,
        'Address' => $Address,
        'Longitude' => $Longitude,
        'Phones' => $Phones,
        'Latidude' => $Latidude,
        'CityId' => $CityId,
        'Drugs' => $Drugs,
        'SubscriptionPrice' => $SubscriptionPrice,
        'SubscriptionType' => $SubscriptionType,


    );

    $respons = api_post('WarehousesAdmin/AddWarehouse', $post_array);

//     var_dump($respons);
    if ($respons->code == 1) {
        $_SESSION['error_msg'] = $lang['successfully_done'];
        $_SESSION['msg_type'] = 1;
        redirect('../' . 'warehouses-list');
    } else {

        general_error('../' . 'warehouses-list', $respons->message);
    }

} else if (isset($_POST['edit-wa-info'])) {


    $MinOrderValue = isset($_POST['MinOrderValue']) ? make_safe($_POST['MinOrderValue']) : null;
    $DeliveryStatus = isset($_POST['delivery-select']) ? make_safe($_POST['delivery-select']) : null;


    $post_array = array(

        'MinOrderValue' => $MinOrderValue,
        'DeliveryStatus' => $DeliveryStatus,


    );


    $respons = api_post('WarehousesAdmin/EditMyWarehouse', $post_array);


    if ($respons->code == 1) {
        $_SESSION['error_msg'] = $lang['successfully_done'];
        $_SESSION['msg_type'] = 1;
        redirect('../wa-info');
    } else {
        general_error('../wa-info', $respons->message);
    }

} else if (isset($_POST['submit-change-password'])) {

    $password = isset($_POST['change-password-field']) ? make_safe($_POST['change-password-field']) : null;


    $post_array = array(
        'Password' => $password
    );

    $respons = api_post('WarehousesAdmin/ChangeMyWarehousePassword', $post_array);

    if ($respons->code == 1) {
        redirect('logout.php');
    } else {
        general_error('../orders-list', $respons->message);
    }

}

