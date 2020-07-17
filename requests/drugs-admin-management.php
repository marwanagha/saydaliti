<?php

require '../include/config.php';


if (isset($_POST['draw'])) {

    $respons = api_post('DrugsAdmin/LoadWarehouseDrugsList', $_POST);
//    var_dump($respons);exit();
    echo json_encode($respons);

} else if (isset($_POST['action']) && $_POST['action']=='delete') {
    $drug_id = isset($_POST['drug_id']) ? make_safe($_POST['drug_id']) : null;
    $post_array = array(
        'Id' => $drug_id,

    );

    $respons = api_post('WarehousesAdmin/UnLinkDrugFromWarehouse', $post_array);

    if ($respons->code == 1) {
        echo 1;
    } else {

        echo $respons->message;
    }

}




