<?php


require_once '../include/config.php';
require_once '../libs/upload/upload.php';

$pics = array();
$allowed_files = array(
    "image/png",
    "image/jpeg",
);

$response = array();
if (isset($_POST['action']) && $_POST['action'] == 'upload_image') {

    $Image = isset($_FILES['image']) ? make_safe($_FILES['image']) : null;
    $type = isset($_POST['type']) ? make_safe($_POST['type']) : null;



    if ($Image['error'] != 4 && in_array($Image['type'], $allowed_files) == false) {
        $response['code'] = -1;
        $response['message'] = 'File not allowed';

    }
    else if ($Image['error'] != 4) {

        $uploadPath = $type;
        $upload_result = @upload_image($Image, $uploadPath, $image_sizes['services'], '../');
        $file_name = $upload_result['data']['file_name'];

        $response['code'] = 1;
        $response['data']['file_name'] = $file_name;

    } else {
        $response['code'] = -1;
        $response['message'] = 'Error while uploading';
    }
} else {
    $response['code'] = -1;
    $response['message'] = 'General error';
}

echo json_encode($response);


