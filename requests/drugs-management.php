<?php

require '../include/config.php';
//var_dump($_POST);exit;
if(isset($_POST['delete']))
{
    $drug_id = isset($_POST['drug_id']) ? make_safe($_POST['drug_id']) : null;
    $post_array=array(
        'Id'=>$drug_id,
        'Status'=>2
    );

    $respons= api_post('DrugsAdmin/ChangeDrugStatus',$post_array);

    if ($respons->code == 1) {
       echo 1;
    } else {

        echo -1;
    }

}
else if (isset($_POST['draw'])) {

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
    $old_pic= isset($_POST['old-img']) ? make_safe($_POST['old-img']) : null;
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


    if ($Icon['error'] != 4) {
        $uploadPath = 'drugs';
        $upload_result = @upload_image($Icon, $uploadPath, $image_sizes['services'], '../');
        $uploaded_file_name = $upload_result['data']['file_name'];

                unlink('../files/images/drugs/large/' . $old_pic);

    }

if(!isset($uploaded_file_name))
    $uploaded_file_name='';

     $post_array = array(

        'Id'=> $id,
        'CommerceNameAr' => $CommerceNameAr,
        'CommerceNameEn' => $CommerceNameEn,
        'ScientificNameAr' => $ScientificNameAr,
        'ScientificNameEn' => $ScientificNameEn,
        'Strengths' => $Strengths,
        'Price' => $Price,
        'ManufactureId' => $ManufactureId,
        'CategoryId' => $CategoryId,
        'Icon' => $uploaded_file_name,
        'Status' => $Status

    );
//    var_dump($post_array);exit;
    $respons = api_post('DrugsAdmin/EditDrug', $post_array);
    if ($respons->code == 1) {
        $_SESSION['error_msg'] = $lang['successfully_done'];
        $_SESSION['msg_type'] = 1;
        redirect('../' . 'drug-form/'.$id);
    } else {
        general_error('../' . 'drug-list');
    }

} else if (isset($_POST['add-drug'])) {
    $CommerceNameAr = isset($_POST['CommerceNameAr']) ? make_safe($_POST['CommerceNameAr']) : null;
    $CommerceNameEn = isset($_POST['CommerceNameEn']) ? make_safe($_POST['CommerceNameEn']) : null;
    $ScientificNameAr = isset($_POST['ScientificNameAr']) ? make_safe($_POST['ScientificNameAr']) : null;
    $ScientificNameEn = isset($_POST['ScientificNameEn']) ? make_safe($_POST['ScientificNameEn']) : null;
    $Strengths = isset($_POST['Strengths']) ? make_safe($_POST['Strengths']) : null;
    $Price = isset($_POST['Price']) ? make_safe($_POST['Price']) : null;
    $ManufactureId = isset($_POST['manufacture-select']) ? make_safe($_POST['manufacture-select']) : null;
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


    if ($Icon['error'] != 4) {
        $uploadPath = 'drugs';
        $upload_result = @upload_image($Icon, $uploadPath, $image_sizes['services'], '../');
        $uploaded_file_name = $upload_result['data']['file_name'];

        $post_array = array(

            'CommerceNameAr' => $CommerceNameAr,
            'CommerceNameEn' => $CommerceNameEn,
            'ScientificNameAr' => $ScientificNameAr,
            'ScientificNameEn' => $ScientificNameEn,
            'Strengths' => $Strengths,
            'Price' => $Price,
            'ManufactureId' => $ManufactureId,
            'CategoryId' => $CategoryId,
            'Icon' => $uploaded_file_name,
            'Status' => $Status

        );
        $respons = api_post('DrugsAdmin/AddDrug', $post_array);

        if ($respons->code == 1) {
            $_SESSION['error_msg'] = $lang['successfully_done'];
            $_SESSION['msg_type'] = 1;
            redirect('../' . 'drug-list');
        } else {
            general_error('../' . 'drug-list');
        }

    }
    else
        general_error($APP_ROOT . 'drug-list');
} else
    general_error($APP_ROOT . 'drug-list');



