<?php

require '../include/config.php';


if(isset($_POST['delete']))
{
    $drug_id = isset($_POST['pharmacy_id']) ? make_safe($_POST['pharmacy_id']) : null;
    $post_array=array(
        'Id'=>$drug_id,
        'Status'=>3
    );

    $respons= api_post('PharmacistsAdmin/ChangePharmacistStatus',$post_array);

    if ($respons->code == 1) {
        echo 1;
    } else {

        echo -1;
    }

}
else if ((isset($_POST['action']) && $_POST['action'] == 'change-status')) {

    $status = isset($_POST['status']) ? make_safe($_POST['status']) : null;
    $pharmacy_id = isset($_POST['pharmacy_id']) ? make_safe($_POST['pharmacy_id']) : null;

    $post_array = array(
        'Status'=>$status,
        'Id'=>$pharmacy_id
    );

    $respons = api_post('PharmacistsAdmin/ChangePharmacistStatus', $post_array);

    if ($respons->code == 1) {
        echo 1;
    } else {
        echo -1;
    }


}
else if (isset($_POST['draw'])) {

    $respons = api_post('PharmacistsAdmin/LoadPharmacistsList', $_POST);
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
    $Status = isset($_POST['status']) ? make_safe($_POST['status']) : null;




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
        'Status' => $Status

    );

//    var_dump(json_encode($post_array));exit;


    $respons = api_post('PharmacistsAdmin/EditPharmacist', $post_array);


    if ($respons->code == 1) {
        $_SESSION['error_msg'] = $lang['successfully_done'];
        $_SESSION['msg_type'] = 1;
        redirect('../' . 'pharmacy-form/'.$id);
    } else {
//        general_error('../' . 'pharmacies-list');

        general_error('../' . 'pharmacies-list',$respons->message);
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
    $Status = 4;




    $post_array = array(

        'PharmacyName' => $PharmacyName,
        'PharmacistName' => $PharmacistName,
        'LicenseNumber' => $LicenseNumber,
        'CityId' => $CityId,
        'Address' => $Address,
        'Longitude' => $Longitude,
        'Latidute' => $Latidute,
        'WorkingHours' => $WorkingHours,
        'Status' => $Status

    );



        $respons = api_post('PharmacistsAdmin/AddPharmacist', $post_array);

        if ($respons->code == 1) {
            $_SESSION['error_msg'] = $lang['successfully_done'];
            $_SESSION['msg_type'] = 1;
            redirect('../' . 'pharmacies-list');
        } else {
//            general_error('../' . 'pharmacies-list');

            general_error('../' . 'pharmacies-list',$respons->message);
        }

} else
    general_error($APP_ROOT . 'pharmacies-list');



