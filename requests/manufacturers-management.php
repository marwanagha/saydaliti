<?php


include '../include/config.php';

if (isset($_POST['action']) && $_POST['action'] == 'show-list') {
    $respons = api_post('Listing/GetManufacturesList', $_POST);

    if ($respons->code == 1) {
        echo json_encode($respons->data->dropDownListItems);
    } else {
        echo -1;
    }
} else if (isset($_POST['add-man'])) {


    $Status = 1;
    $Name = isset($_POST['Name']) ? make_safe($_POST['Name']) : null;
    $Address = isset($_POST['Address']) ? make_safe($_POST['Address']) : null;
    $Longitude = isset($_POST['Longitude']) ? make_safe($_POST['Longitude']) : null;
    $Phones = isset($_POST['Phones']) ? make_safe($_POST['Phones']) : null;
    $Latidude = isset($_POST['Latidude']) ? make_safe($_POST['Latidude']) : null;
    $CityId = isset($_POST['city-select']) ? make_safe($_POST['city-select']) : null;


    $Image = isset($_FILES['Image']) ? make_safe($_FILES['Image']) : null;


    $pics = array();
    $allowed_files = array(
        "image/png",
        "image/jpeg",
    );

    if ($Image['error'] != 4 && in_array($Image['type'], $allowed_files) == false) {
        $_SESSION['error_msg'] = $lang['only_image'];
        $_SESSION['msg_type'] = -1;
        redirect('manufacturer-form', $path);
        exit;
    }

    $new_image='';

    if ($Image['error'] != 4) {
        $uploadPath = 'manufacturers';
        $upload_result = @upload_image($Image, $uploadPath, $image_sizes['services'], '../');
        $new_image = $upload_result['data']['file_name'];

    }


    $post_array = array(

        'Status' => $Status,
        'Name' => $Name,
        'Address' => $Address,
        'Longitude' => $Longitude,
        'Phones' => $Phones,
        'Latidude' => $Latidude,
        'CityId' => $CityId,
        'Icon' => $new_image,


    );
//var_dump($post_array);exit();
    $respons = api_post('ManufacturesAdmin/AddManufacture', $post_array);
//    var_dump($respons);exit();
    if ($respons->code == 1) {
        $_SESSION['error_msg'] = $lang['successfully_done'];
        $_SESSION['msg_type'] = 1;
        redirect('../manufacturers');
    } else {
//        general_error('../manufacturers');
        general_error('../' . 'manufacturers', $respons->message);
    }

} else if ((isset($_POST['action']) && $_POST['action'] == 'delete')) {
    $man_id = isset($_POST['man_id']) ? make_safe($_POST['man_id']) : null;
    $status = 2;

    $post_array = array(
        'Status' => $status,
        'Id' => $man_id
    );

    $respons = api_post('ManufacturesAdmin/ChangeManufactureStatus', $post_array);
    if ($respons->code == 1) {
        echo 1;
    } else {
        echo -1;
    }


} else if ((isset($_POST['action']) && $_POST['action'] == 'change-status')) {
//var_dump(2);exit();
//    cat_id: $(this).data('id'),
//                action: 'change-status',
//                status: 1,

    $status = isset($_POST['status']) ? make_safe($_POST['status']) : null;
    $man_id = isset($_POST['man_id']) ? make_safe($_POST['man_id']) : null;

    $post_array = array(
        'Status' => $status,
        'Id' => $man_id
    );

    $respons = api_post('ManufacturesAdmin/ChangeManufactureStatus', $post_array);

    if ($respons->code == 1) {
        echo 1;
    } else {
        echo -1;
    }


} else if (isset($_POST['draw'])) {

    $respons = api_post('ManufacturesAdmin/LoadManufacturesList', $_POST);
    echo json_encode($respons);

} else if (isset($_POST['edit-man'])) {


    $Status = 1;
    $Name = isset($_POST['Name']) ? make_safe($_POST['Name']) : null;
    $Address = isset($_POST['Address']) ? make_safe($_POST['Address']) : null;
    $Longitude = isset($_POST['Longitude']) ? make_safe($_POST['Longitude']) : null;
    $Phones = isset($_POST['Phones']) ? make_safe($_POST['Phones']) : null;
    $Latidude = isset($_POST['Latidude']) ? make_safe($_POST['Latidude']) : null;
    $CityId = isset($_POST['city-select']) ? make_safe($_POST['city-select']) : null;
    $Id = isset($_POST['id']) ? make_safe($_POST['id']) : null;

    $Image = isset($_FILES['Image']) ? make_safe($_FILES['Image']) : null;
    $OldImage = isset($_POST['old-img']) ? make_safe($_POST['old-img']) : null;


    $pics = array();
    $allowed_files = array(
        "image/png",
        "image/jpeg",
    );

    if ($Image['error'] != 4 && in_array($Image['type'], $allowed_files) == false) {
        $_SESSION['error_msg'] = $lang['only_image'];
        $_SESSION['msg_type'] = -1;
        redirect('manufacturer-form', $path);
        exit;
    }
    $new_image='';

    if ($Image['error'] != 4) {
        $uploadPath = 'manufacturers';
        $upload_result = @upload_image($Image, $uploadPath, $image_sizes['services'], '../');
        $new_image = $upload_result['data']['file_name'];
        if($OldImage!=NULL)
        unlink('../files/images/manufacturers/large/' . $OldImage);

    }


if($new_image=='' && $OldImage!=null)
{
    $new_image=$OldImage;
}
    $post_array = array(

        'Status' => $Status,
        'Name' => $Name,
        'Address' => $Address,
        'Longitude' => $Longitude,
        'Phones' => $Phones,
        'Latidude' => $Latidude,
        'CityId' => $CityId,
        'Id' => $Id,
        'Icon' => $new_image,


    );
//    var_dump($post_array);exit;
    $respons = api_post('ManufacturesAdmin/EditManufacture', $post_array);
    if ($respons->code == 1) {
        $_SESSION['error_msg'] = $lang['successfully_done'];
        $_SESSION['msg_type'] = 1;
        redirect('../' . 'manufacturer-form/' . $Id);
    } else {
//        general_error('../' . 'manufacturers');
        general_error('../' . 'manufacturers', $respons->message);
    }


}

//else if (isset($_POST['add-man'])) {
//
//    $Status = 1;
//    $Name = isset($_POST['Name']) ? make_safe($_POST['Name']) : null;
//    $Address = isset($_POST['Address']) ? make_safe($_POST['Address']) : null;
//    $Longitude = isset($_POST['Longitude']) ? make_safe($_POST['Longitude']) : null;
//    $Phones = isset($_POST['Phones']) ? make_safe($_POST['Phones']) : null;
//    $Latidude = isset($_POST['Latidude']) ? make_safe($_POST['Latidude']) : null;
//    $CityId = isset($_POST['city-select']) ? make_safe($_POST['city-select']) : null;
//
//
//
//
//        $post_array = array(
//
//            'Status' => $Status,
//            'Name' => $Name,
//            'Address' => $Address,
//            'Longitude' => $Longitude,
//            'Phones' => $Phones,
//            'Latidude' => $Latidude,
//            'CityId' => $CityId,
//
//
//        );
//        $respons = api_post('ManufacturesAdmin/AddManufacture', $post_array);
//
//        if ($respons->code == 1) {
//            $_SESSION['error_msg'] = $lang['successfully_done'];
//            $_SESSION['msg_type'] = 1;
//            redirect('../' . 'manufacturers');
//        } else {
////            general_error('../' . 'manufacturers');
//            general_error('../' . 'manufacturers',$respons->message);
//        }
//
//    }

