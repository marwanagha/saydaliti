<?php

include '../include/config.php';

if (isset($_POST['action']) && $_POST['action'] == 'show-list-offer') {
    $respons = api_post('Listing/GetOffersList', $_POST);

    if ($respons->code == 1) {
        echo json_encode($respons->data->dropDownListItems);
    } else {
        echo -1;
    }
} else if (isset($_POST['draw'])) {

    $respons = api_post('OffersAdmin/LoadOffersList', $_POST);

    echo json_encode($respons);

} else if ((isset($_POST['action']) && $_POST['action'] == 'delete-offer')) {


    $offer_id = isset($_POST['offer_id']) ? make_safe($_POST['offer_id']) : null;

    $post_array = array(
        'Status' => 0,
        'Id' => $offer_id
    );

    $respons = api_post('OffersAdmin/ChangeOfferStatus', $post_array);

    if ($respons->code == 1) {
        echo 1;
    } else {
        echo -1;
    }


} else if (isset($_POST['edit-offer'])) {


    $Id = isset($_POST['offer-id']) ? make_safe($_POST['offer-id']) : null;
    $Description = isset($_POST['Description']) ? make_safe($_POST['Description']) : null;
    $DurgId = isset($_POST['drug-id']) ? make_safe($_POST['drug-id']) : null;
    $Quantity = isset($_POST['Quantity']) ? make_safe($_POST['Quantity']) : null;
    $Price = isset($_POST['Price']) ? make_safe($_POST['Price']) : null;
    $Status = 1;
    $Gift = isset($_POST['Gift']) ? make_safe($_POST['Gift']) : null;
    $Notes = isset($_POST['Notes']) ? make_safe($_POST['Notes']) : null;
    $ExpiryDate = isset($_POST['ExpiryDate']) ? make_safe($_POST['ExpiryDate']) : null;
    $Discount = isset($_POST['Discount']) ? make_safe($_POST['Discount']) : null;


    $post_array = array(

        'Id' => $Id,
        'Description' => $Description,
        'DurgId' => $DurgId,
        'Quantity' => $Quantity,
        'Price' => $Price,
        'Status' => $Status,
        'Gift' => $Gift,
        'Notes' => $Notes,
        'ExpiryDate' => $ExpiryDate,
        'Discount' => $Discount,


    );

//    var_dump(json_encode($post_array));exit;
    $respons = api_post('OffersAdmin/EditOffer', $post_array);


    if ($respons->code == 1) {
        $_SESSION['error_msg'] = $lang['successfully_done'];
        $_SESSION['msg_type'] = 1;
        redirect('../' . 'offer-form/' . $Id);
    } else {

        general_error('../' . 'offers-list', $respons->message);
    }

} else if (isset($_POST['add-offer'])) {


    $Description = isset($_POST['Description']) ? make_safe($_POST['Description']) : null;
    $DurgId = isset($_POST['drug-id']) ? make_safe($_POST['drug-id']) : null;
    $Quantity = isset($_POST['Quantity']) ? make_safe($_POST['Quantity']) : null;
    $Price = isset($_POST['Price']) ? make_safe($_POST['Price']) : null;
    $Status = 1;
    $Gift = isset($_POST['Gift']) ? make_safe($_POST['Gift']) : null;
    $Notes = isset($_POST['Notes']) ? make_safe($_POST['Notes']) : null;
    $ExpiryDate = isset($_POST['ExpiryDate']) ? make_safe($_POST['ExpiryDate']) : null;
    $Discount = isset($_POST['Discount']) ? make_safe($_POST['Discount']) : null;


    $post_array = array(


        'Description' => $Description,
        'DurgId' => $DurgId,
        'Quantity' => $Quantity,
        'Price' => $Price,
        'Status' => $Status,
        'Gift' => $Gift,
        'Notes' => $Notes,
        'ExpiryDate' => $ExpiryDate,
        'Discount' => $Discount,


    );

//var_dump(json_encode($post_array));exit;
    $respons = api_post('OffersAdmin/AddOffer', $post_array);

    if ($respons->code == 1) {
        $_SESSION['error_msg'] = $lang['successfully_done'];
        $_SESSION['msg_type'] = 1;
        redirect('../' . 'offers-list');


    } else {


        general_error('../' . 'offers-list', $respons->message);
    }

}