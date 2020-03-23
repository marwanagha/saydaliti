<?php
include '../include/config.php';

if (isset($_POST['action']) && $_POST['action'] == 'show-list') {
    $respons = api_post('Listing/GetCitiesList', $_POST);

    if ($respons->code == 1) {
        echo json_encode($respons->data->dropDownListItems);
    } else {
        echo -1;
    }
}