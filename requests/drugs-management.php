<?php

require '../include/config.php';

if (isset($_POST['action']) && $_POST['action'] == 'link-drug') {


    $id = isset($_POST['id']) ? make_safe($_POST['id']) : null;
    $price = isset($_POST['price']) ? make_safe($_POST['price']) : null;
    $expiry_date = isset($_POST['expiry_date']) ? make_safe($_POST['expiry_date']) : null;

    $post_array = array(
        'Id' => $id,
        'Price' => $price,
        'DrugExpiryDate' => $expiry_date
    );


    $respons = api_post('WarehousesAdmin/LinkDrugToWarehouse', $post_array);

    if ($respons->code == 1) {
        echo 1;
    } else {
        echo $respons->message;
    }
} else
    if (isset($_POST['action']) && $_POST['action'] == 'show-list-forms') {

        $respons = api_post('Listing/GetDrugsFormsList', $_POST);

        if ($respons->code == 1) {
            echo json_encode($respons->data->dropDownListItems);
        } else {
            echo -1;
        }
    } else if (isset($_POST['action']) && $_POST['action'] == 'show-list') {
        $respons = api_post('Listing/GetDrugsList', $_POST);

        if ($respons->code == 1) {
            echo json_encode($respons->data->dropDownListItems);
        } else {
            echo -1;
        }
    } else if (isset($_POST['delete'])) {
        $drug_id = isset($_POST['drug_id']) ? make_safe($_POST['drug_id']) : null;
        $post_array = array(
            'Id' => $drug_id,
            'Status' => 2
        );

        $respons = api_post('DrugsAdmin/ChangeDrugStatus', $post_array);

        if ($respons->code == 1) {
            echo 1;
        } else {

            echo -1;
        }

    } else if (isset($_POST['draw'])) {

        $respons = api_post('DrugsAdmin/LoadDrugsList', $_POST);
        echo json_encode($respons);

    } else if (isset($_POST['edit-drug'])) {


        $id = isset($_POST['drug-id']) ? make_safe($_POST['drug-id']) : null;
        $CommerceNameAr = isset($_POST['CommerceNameAr']) ? make_safe($_POST['CommerceNameAr']) : null;
        $CommerceNameEn = isset($_POST['CommerceNameEn']) ? make_safe($_POST['CommerceNameEn']) : null;
        $ScientificNameAr = isset($_POST['ScientificNameAr']) ? make_safe($_POST['ScientificNameAr']) : null;
        $ScientificNameEn = isset($_POST['ScientificNameEn']) ? make_safe($_POST['ScientificNameEn']) : null;
        $Strengths = isset($_POST['Strengths']) ? make_safe($_POST['Strengths']) : null;
        $Price = isset($_POST['Price']) ? make_safe($_POST['Price']) : null;
        $ManufactureId = isset($_POST['manufacture-select']) ? make_safe($_POST['manufacture-select']) : null;
        $CategoryId = isset($_POST['category-select']) ? make_safe($_POST['category-select']) : null;
        $FormId = isset($_POST['drug-forms-select']) ? make_safe($_POST['drug-forms-select']) : null;
        $old_pic = isset($_POST['old-img']) ? make_safe($_POST['old-img']) : null;
        $Status = 1;
        $Icon = isset($_FILES['Icon']) ? make_safe($_FILES['Icon']) : null;

//var_dump($old_pic);exit;
        $pics = array();
        $allowed_files = array(
            "image/png",
            "image/jpeg",
        );


        if ($Icon['error'] != 4 && in_array($Icon['type'], $allowed_files) == false) {
            $_SESSION['error_msg'] = $lang['only_image'];
            $_SESSION['msg_type'] = -1;
            redirect('drug-form', $path);
            exit;
        }

        $uploaded_file_name = '';

        if ($Icon['error'] != 4) {
            $uploadPath = 'drugs';
            $upload_result = @upload_image($Icon, $uploadPath, $image_sizes['services'], '../');
            $uploaded_file_name = $upload_result['data']['file_name'];
            if ($old_pic != NULL)
                unlink('../files/images/drugs/large/' . $old_pic);

        }


        if ($uploaded_file_name == '' && $old_pic != null) {
            $uploaded_file_name = $old_pic;
        }


        $post_array = array(

            'Id' => $id,
            'CommerceNameAr' => $CommerceNameAr,
            'CommerceNameEn' => $CommerceNameEn,
            'ScientificNameAr' => $ScientificNameAr,
            'ScientificNameEn' => $ScientificNameEn,
            'Strengths' => $Strengths,
//            'Price' => 0,
            'ManufactureId' => $ManufactureId,
            'CategoryId' => $CategoryId,
            'FormId' => $FormId,
            'Icon' => $uploaded_file_name,
            'Status' => $Status

        );

        $respons = api_post('DrugsAdmin/EditDrug', $post_array);


        if ($respons->code == 1) {
            $_SESSION['error_msg'] = $lang['successfully_done'];
            $_SESSION['msg_type'] = 1;
            redirect('../' . 'drug-form/' . $id);
        } else {
//        general_error('../' . 'drug-list');
            general_error('../' . 'drug-list', $respons->message);

        }

    } else if (isset($_POST['add-drug'])) {

        $CommerceNameAr = isset($_POST['CommerceNameAr']) ? make_safe($_POST['CommerceNameAr']) : null;
        $CommerceNameEn = isset($_POST['CommerceNameEn']) ? make_safe($_POST['CommerceNameEn']) : null;
        $ScientificNameAr = isset($_POST['ScientificNameAr']) ? make_safe($_POST['ScientificNameAr']) : null;
        $ScientificNameEn = isset($_POST['ScientificNameEn']) ? make_safe($_POST['ScientificNameEn']) : null;
        $Strengths = isset($_POST['Strengths']) ? make_safe($_POST['Strengths']) : null;
        $Price = isset($_POST['Price']) ? make_safe($_POST['Price']) : null;
        $ManufactureId = isset($_POST['manufacture-select']) ? make_safe($_POST['manufacture-select']) : null;
        $FormId = isset($_POST['drug-forms-select']) ? make_safe($_POST['drug-forms-select']) : null;
        $CategoryId = isset($_POST['category-select']) ? make_safe($_POST['category-select']) : null;
        $Status = 1;
        $Icon = isset($_FILES['Icon']) ? make_safe($_FILES['Icon']) : null;


        $pics = array();
        $allowed_files = array(
            "image/png",
            "image/jpeg",
        );


        if ($Icon['error'] != 4 && in_array($Icon['type'], $allowed_files) == false) {
            $_SESSION['error_msg'] = $lang['only_image'];
            $_SESSION['msg_type'] = -1;
            redirect('drug-form', $path);
            exit;
        }

        $uploaded_file_name = '';
        if ($Icon['error'] != 4) {
            $uploadPath = 'drugs';
            $upload_result = @upload_image($Icon, $uploadPath, $image_sizes['services'], '../');
            $uploaded_file_name = $upload_result['data']['file_name'];


        }

        $post_array = array(

            'CommerceNameAr' => $CommerceNameAr,
            'CommerceNameEn' => $CommerceNameEn,
            'ScientificNameAr' => $ScientificNameAr,
            'ScientificNameEn' => $ScientificNameEn,
            'Strengths' => $Strengths,
//            'Price' => $Price,
            'ManufactureId' => $ManufactureId,
            'CategoryId' => $CategoryId,
            'FormId' => $FormId,
            'Icon' => $uploaded_file_name,
            'Status' => $Status

        );
//        var_dump($post_array);
        $respons = api_post('DrugsAdmin/AddDrug', $post_array);
//        var_dump($respons);exit;

        if ($respons->code == 1) {
            $_SESSION['error_msg'] = $lang['successfully_done'];
            $_SESSION['msg_type'] = 1;
            redirect('../' . 'drug-list');
        } else {
//            general_error('../' . 'drug-list');
            general_error('../' . 'drug-list', $respons->message);
        }

    } else
        general_error($APP_ROOT . 'drug-list');



