<?php

require '../include/config.php';


if (isset($_POST['delete'])) {
    $drug_id = isset($_POST['pharmacy_id']) ? make_safe($_POST['pharmacy_id']) : null;
    $post_array = array(
        'Id' => $drug_id,
        'Status' => 3
    );

    $respons = api_post('PharmacistsAdmin/ChangePharmacistStatus', $post_array);

    if ($respons->code == 1) {
        echo 1;
    } else {

        echo -1;
    }

} else if ((isset($_POST['action']) && $_POST['action'] == 'change-status')) {

    $status = isset($_POST['status']) ? make_safe($_POST['status']) : null;
    $pharmacy_id = isset($_POST['pharmacy_id']) ? make_safe($_POST['pharmacy_id']) : null;

    $post_array = array(
        'Status' => $status,
        'Id' => $pharmacy_id
    );

    $respons = api_post('PharmacistsAdmin/ChangePharmacistStatus', $post_array);

    if ($respons->code == 1) {
        echo 1;
    } else {
        echo -1;
    }


} else if (isset($_POST['draw'])) {

    $respons = api_post('PharmacistsAdmin/LoadPharmacistsList', $_POST);
//var_dump($respons);exit;

    echo json_encode($respons);

} else if (isset($_POST['edit-pharmacy'])) {


    $id = isset($_POST['pharmacy-id']) ? make_safe($_POST['pharmacy-id']) : null;
    $PharmacyName = isset($_POST['PharmacyName']) ? make_safe($_POST['PharmacyName']) : null;
    $PharmacistName = isset($_POST['PharmacistName']) ? make_safe($_POST['PharmacistName']) : null;
    $LicenseNumber = isset($_POST['LicenseNumber']) ? make_safe($_POST['LicenseNumber']) : null;
    $CityId = isset($_POST['city-select']) ? make_safe($_POST['city-select']) : null;
    $Address = isset($_POST['Address']) ? make_safe($_POST['Address']) : null;
    $Longitude = isset($_POST['Longitude']) ? make_safe($_POST['Longitude']) : null;
    $Latidute = isset($_POST['Latidute']) ? make_safe($_POST['Latidute']) : null;
    $WorkingHours = isset($_POST['WorkingHours']) ? make_safe($_POST['WorkingHours']) : null;
    $Phone = isset($_POST['phone']) ? make_safe($_POST['phone']) : null;
    $MobileNumber = isset($_POST['mobile']) ? make_safe($_POST['mobile']) : null;
    $Status = isset($_POST['status']) ? make_safe($_POST['status']) : null;
    $old_pic_PharmacyPhoto = isset($_POST['old-img-PharmacyPhoto']) ? make_safe($_POST['old-img-PharmacyPhoto']) : null;
    $old_pic_SyndicateIdPhoto = isset($_POST['old-img-SyndicateIdPhoto']) ? make_safe($_POST['old-img-SyndicateIdPhoto']) : null;


    $SyndicateNumber = isset($_POST['SyndicateNumber']) ? make_safe($_POST['SyndicateNumber']) : null;
    $PharmacyPhoto = isset($_FILES['PharmacyPhoto']) ? make_safe($_FILES['PharmacyPhoto']) : null;
    $SyndicateIdPhoto = isset($_FILES['SyndicateIdPhoto']) ? make_safe($_FILES['SyndicateIdPhoto']) : null;


    $pics = array();
    $allowed_files = array(
        "image/png",
        "image/jpeg",
    );


    if ($PharmacyPhoto['error'] != 4 && in_array($PharmacyPhoto['type'], $allowed_files) == false) {
        $_SESSION['error_msg'] = $lang['only_image'];
        $_SESSION['msg_type'] = -1;
        redirect('pharmacy-form', $path);
        exit;
    }
    if ($SyndicateIdPhoto['error'] != 4 && in_array($SyndicateIdPhoto['type'], $allowed_files) == false) {
        $_SESSION['error_msg'] = $lang['only_image'];
        $_SESSION['msg_type'] = -1;
        redirect('pharmacy-form', $path);
        exit;
    }

    $pp = '';
    if ($PharmacyPhoto['error'] != 4) {
        $uploadPath = 'pharmacies';
        $upload_result = @upload_image($PharmacyPhoto, $uploadPath, $image_sizes['services'], '../');
        $pp = $upload_result['data']['file_name'];
        if ($old_pic_PharmacyPhoto != NULL)
            unlink('../files/images/pharmacies/large/' . $old_pic_PharmacyPhoto);

    }
    $sp = '';
    if ($SyndicateIdPhoto['error'] != 4) {
        $uploadPath = 'pharmacies';
        $upload_result = @upload_image($SyndicateIdPhoto, $uploadPath, $image_sizes['services'], '../');
        $sp = $upload_result['data']['file_name'];
        if ($old_pic_SyndicateIdPhoto != NULL)
            unlink('../files/images/pharmacies/large/' . $old_pic_SyndicateIdPhoto);


    }


    if ($pp == '' && $old_pic_PharmacyPhoto != null) {
        $pp = $old_pic_PharmacyPhoto;
    }

    if ($sp == '' && $old_pic_SyndicateIdPhoto != null) {
        $sp = $old_pic_SyndicateIdPhoto;
    }

    $post_array = array(



        'Id' => $id,
        'PharmacyName' => $PharmacyName,
        'PharmacistName' => $PharmacistName,
        'LicenseNumber' => $LicenseNumber,
        'CityId' => $CityId,
        'Address' => $Address,
        'Longitude' => $Longitude,
        'Latidute' => $Latidute,
        'WorkingHours' => $WorkingHours,
        'Phone' => $Phone,
        'Mobile' => $MobileNumber,
        'Status' => $Status,
        'SyndicateNumber' => $SyndicateNumber,
        'PharmacyPhoto' => $pp,
        'SyndicateIdPhoto' => $sp

    );

//var_dump(json_encode($post_array));
    $respons = api_post('PharmacistsAdmin/EditPharmacist', $post_array);
//var_dump($respons);exit;

    if ($respons->code == 1) {
        $_SESSION['error_msg'] = $lang['successfully_done'];
        $_SESSION['msg_type'] = 1;
        redirect('../' . 'pharmacy-form/' . $id);
    } else {
//        general_error('../' . 'pharmacies-list');

        general_error('../' . 'pharmacies-list', $respons->message);
    }

} else if (isset($_POST['add-pharmacy'])) {


    $PharmacyName = isset($_POST['PharmacyName']) ? make_safe($_POST['PharmacyName']) : null;
    $PharmacistName = isset($_POST['PharmacistName']) ? make_safe($_POST['PharmacistName']) : null;
    $LicenseNumber = isset($_POST['LicenseNumber']) ? make_safe($_POST['LicenseNumber']) : null;
    $CityId = isset($_POST['city-select']) ? make_safe($_POST['city-select']) : null;
    $Address = isset($_POST['Address']) ? make_safe($_POST['Address']) : null;
    $Longitude = isset($_POST['Longitude']) ? make_safe($_POST['Longitude']) : null;
    $Latidute = isset($_POST['Latidute']) ? make_safe($_POST['Latidute']) : null;
    $WorkingHours = isset($_POST['WorkingHours']) ? make_safe($_POST['WorkingHours']) : null;
    $Phone = isset($_POST['phone']) ? make_safe($_POST['phone']) : null;
    $MobileNumber = isset($_POST['mobile']) ? make_safe($_POST['mobile']) : null;
    $Status = 4;

    $SyndicateNumber = isset($_POST['SyndicateNumber']) ? make_safe($_POST['SyndicateNumber']) : null;
    $PharmacyPhoto = isset($_FILES['PharmacyPhoto']) ? make_safe($_FILES['PharmacyPhoto']) : null;
    $SyndicateIdPhoto = isset($_FILES['SyndicateIdPhoto']) ? make_safe($_FILES['SyndicateIdPhoto']) : null;


    $pics = array();
    $allowed_files = array(
        "image/png",
        "image/jpeg",
    );


    if ($PharmacyPhoto['error'] != 4 && in_array($PharmacyPhoto['type'], $allowed_files) == false) {
        $_SESSION['error_msg'] = $lang['only_image'];
        $_SESSION['msg_type'] = -1;
        redirect('pharmacy-form', $path);
        exit;
    }
    if ($SyndicateIdPhoto['error'] != 4 && in_array($SyndicateIdPhoto['type'], $allowed_files) == false) {
        $_SESSION['error_msg'] = $lang['only_image'];
        $_SESSION['msg_type'] = -1;
        redirect('pharmacy-form', $path);
        exit;
    }

    $pp = '';
    if ($PharmacyPhoto['error'] != 4) {
        $uploadPath = 'pharmacies';
        $upload_result = @upload_image($PharmacyPhoto, $uploadPath, $image_sizes['services'], '../');
        $pp = $upload_result['data']['file_name'];


    }
    $sp = '';
    if ($SyndicateIdPhoto['error'] != 4) {
        $uploadPath = 'pharmacies';
        $upload_result = @upload_image($SyndicateIdPhoto, $uploadPath, $image_sizes['services'], '../');
        $sp = $upload_result['data']['file_name'];

    }

    $post_array = array(

        'PharmacyName' => $PharmacyName,
        'PharmacistName' => $PharmacistName,
        'LicenseNumber' => $LicenseNumber,
        'CityId' => $CityId,
        'Address' => $Address,
        'Longitude' => $Longitude,
        'Latidute' => $Latidute,
        'WorkingHours' => $WorkingHours,
        'Phone' => $Phone,
        'Mobile' => $MobileNumber,
        'Status' => $Status,
        'SyndicateNumber' => $SyndicateNumber,
        'PharmacyPhoto' => $pp,
        'SyndicateIdPhoto' => $sp

    );


    $respons = api_post('PharmacistsAdmin/AddPharmacist', $post_array);

    if ($respons->code == 1) {
        $_SESSION['error_msg'] = $lang['successfully_done'];
        $_SESSION['msg_type'] = 1;
        redirect('../' . 'pharmacies-list');
    } else {
//            general_error('../' . 'pharmacies-list');

        general_error('../' . 'pharmacies-list', $respons->message);
    }


} else
    general_error($APP_ROOT . 'pharmacies-list');



