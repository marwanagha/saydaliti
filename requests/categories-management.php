<?php

include '../include/config.php';

if (isset($_POST['action']) && $_POST['action'] == 'show-list') {
    $respons = api_post('Listing/GetCategoriesList', $_POST);

    if ($respons->code == 1) {
        echo json_encode($respons->data->dropDownListItems);
    } else {
        echo -1;
    }
} else if (isset($_POST['add-cat'])) {



  $ar = isset($_POST['category-name-en']) ? make_safe($_POST['category-name-en']) : null;
    $en = isset($_POST['category-name-ar']) ? make_safe($_POST['category-name-ar']) : null;
    $post_array = array(
        'Status'=>1,
        'NameEn'=>$en,
        'NameAr'=>$ar
    );

    $respons = api_post('CategoriesAdmin/AddCategory', $post_array);
    if ($respons->code == 1) {
        $_SESSION['error_msg'] = $lang['successfully_done'];
        $_SESSION['msg_type'] = 1;
        redirect(  '../categories');
    } else {
        general_error('../categories');
    }

} else if ((isset($_POST['action']) && $_POST['action'] == 'delete')) {
    $cat_id = isset($_POST['cat_id']) ? make_safe($_POST['cat_id']) : null;
    $status=2;

    $post_array = array(
        'Status'=>$status,
        'Id'=>$cat_id
    );

    $respons = api_post('CategoriesAdmin/ChangeCategoryStatus', $post_array);
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
    $cat_id = isset($_POST['cat_id']) ? make_safe($_POST['cat_id']) : null;

    $post_array = array(
        'Status'=>$status,
        'Id'=>$cat_id
    );

    $respons = api_post('CategoriesAdmin/ChangeCategoryStatus', $post_array);

    if ($respons->code == 1) {
        echo 1;
    } else {
        echo -1;
    }


} else if (isset($_POST['draw'])) {

    $respons = api_post('CategoriesAdmin/LoadCategoriesList', $_POST);
    echo json_encode($respons);

}



