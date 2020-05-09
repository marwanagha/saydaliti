<?php

include '../include/config.php';

if (isset($_POST['action']) && $_POST['action'] == 'show-list-types') {

    $respons = api_post('Listing/GetAdvertismentTypesList', $_POST);

    if ($respons->code == 1) {
        echo json_encode($respons->data->dropDownListItems);
    } else {
        echo -1;
    }
}
else if (isset($_POST['submit-ad'])) {



    $Type = isset($_POST['type-select']) ? make_safe($_POST['type-select']) : null;

    if($Type==1)
    {
        $TypeId = isset($_POST['manufacture-select']) ? make_safe($_POST['manufacture-select']) : null;
    }else if ($Type==2)
    {
        $TypeId = isset($_POST['offer-select']) ? make_safe($_POST['offer-select']) : null;
    }
    else
    {
        $TypeId = isset($_POST['warehouse-select']) ? make_safe($_POST['warehouse-select']) : null;
    }


    $post_array = array(

        'Type' => $Type,
        'TypeId' => $TypeId
    );


//var_dump($post_array);exit();
    $respons = api_post('AdvertismentsAdmin/AddAdvertisment', $post_array);
//    var_dump($respons);exit;

    if ($respons->code == 1) {
        $_SESSION['error_msg'] = $lang['successfully_done'];
        $_SESSION['msg_type'] = 1;
        redirect('../ads-list');
    } else {

        general_error('../' . 'ads-list', $respons->message);
    }

}

else if ((isset($_POST['action']) && $_POST['action'] == 'delete')) {
    $TypeId = isset($_POST['ad_id']) ? make_safe($_POST['ad_id']) : null;
    $status = 3;

    $post_array = array(
        'Status' => $status,
        'Id' => $TypeId
    );

    $respons = api_post('AdvertismentsAdmin/ChangeAdvertismentStatus', $post_array);
    if ($respons->code == 1) {
        echo 1;
    } else {
        echo -1;
    }


}

else if (isset($_POST['draw'])) {

    $respons = api_post('AdvertismentsAdmin/LoadAdvertismentsList', $_POST);
    echo json_encode($respons);

}