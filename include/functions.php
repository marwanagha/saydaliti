<?php
@ob_start();
//session_start();


function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


function general_error ($path,$msg=null)
{

if($msg!=null)
    $_SESSION['error_msg'] = $msg;
else
    $_SESSION['error_msg'] = 'General error';

    $_SESSION['msg_type'] = -1;
    redirect($path);
    exit();

}


function api_post ($service,$post_array)
{
//var_dump($_SESSION);
    global $API_ROOT;
    $ch = curl_init();
//    var_dump(json_encode($post_array));exit();
//    var_dump($API_ROOT.$service);
    curl_setopt($ch, CURLOPT_URL, $API_ROOT.$service);
    curl_setopt($ch, CURLOPT_POST, 1);

if(!empty($post_array))
{
//    var_dump(json_encode($post_array));exit;
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_array));
}
else
    curl_setopt($ch, CURLOPT_POSTFIELDS, '');



    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json","Session-ID: {$_SESSION['session']} "));

    curl_setopt($ch, CURLINFO_HEADER_OUT, true);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



    $server_output = json_decode(curl_exec($ch));

//    var_dump(curl_getinfo($ch));exit;


    curl_close($ch);


//var_dump($server_output);exit;
   return $server_output;


}


function elasticsearch_crud($root_path, $index, $factor, $type=null, $params=null,$q=null)
{

    //factor 1 add
    //factor 2 delete
    //factor 3 search

    if ($factor == 3) {

        $query="{
    \"query\": {
        \"multi_match\": {
            \"query\": \"".$q."\",
            \"fields\": [
                \"name\"
            ],
            \"type\": \"best_fields\",
            \"fuzziness\": \"auto\"
        }
    },
    \"suggest\": {
        \"text\": \"white t-shirt\",
        \"simple_phrase\": {
            \"phrase\": {
                \"field\": \"name.trigram\",
                \"confidence\": 0,
                \"collate\": {
                    \"query\": {
                        \"source\": {
                            \"match_phrase\": {
                                \"text\": \"{{suggestion}}\"
                            }
                        }
                    },
                    \"prune\": true
                },
                \"size\": 1,
                \"gram_size\": 3,
                \"direct_generator\": [
                    {
                        \"field\": \"name.trigram\",
                        \"suggest_mode\": \"always\"
                    }
                ],
                \"highlight\": {
                    \"pre_tag\": \"<em>\",
                    \"post_tag\": \"</em>\"
                }
            }
        }
    }
}";


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $root_path . $index . '_search');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Connection: Keep-Alive'
        ));





// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS,
//          http_build_query(array('postvar1' => 'value1')));
// Receive server response ...


        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        return $server_output;



    } else {
        $ch = curl_init();
        $id = $params['id'];
        curl_setopt($ch, CURLOPT_URL, $root_path . $index . $type . $id);

        $params = json_encode($params);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Connection: Keep-Alive'
        ));

        if ($factor == 1) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

        } else if ($factor == 2) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }


// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS,
//          http_build_query(array('postvar1' => 'value1')));
// Receive server response ...


        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);

    }


//    var_dump($server_output);

}





// function template ($path, $array)
// {
//     extract($array);
//     require ($path);
// }

// function post ($url,$array)
// {
//     $ch = curl_init();
//
//     curl_setopt($ch, CURLOPT_URL,$url);
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($array));
//
//
// // Receive server response ...
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//     $server_output = curl_exec($ch);
//     curl_close ($ch);
//
// return $server_output;
//
// }
function connectDb_mysqli()
{
    $link= mysqli_connect('localhost', 'root', '', 'itsource');
//    $link= mysqli_connect('localhost', 'id8912752_itsource', '@123#', 'id8912752_itsourcedb');
    return $link;
}
function GetRestURL($Function, $Service, $Params)
{
    $escapees = array('\r\n', '\u2019', '\u00bb', '\u00ab', '\u201d', '\u201c', '\u00d7');
    $replacements = array('\u003C\/br\u003E', '\"', '\"', '\"', '\"', '\"', '\"');
    global $rest_url;
    global $lang;
    global $error_code;
    $results['result'] = '';
    $results['full_result'] = '';
    $results['url'] = '';
    $results['params'] = str_replace($escapees, $replacements, json_encode($Params, true));
    $results['funcName'] = $Function;
    $results['exp'] = '';
    $results['code'] = '';
    $results['http-code'] = '';
    $results['TotalCount'] = '';

    $service_url = $rest_url . $Function;
    $results['url'] = $service_url;

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    //echo "cURL : ".$curl; // cURL : Resource id #11

    $HeaderLanguage = (isset($_SESSION[SESSION]['lang']) && !empty($_SESSION[SESSION]['lang']) ? $_SESSION[SESSION]['lang'] : "en");
    $headers = array('Accept: */*', 'Content-Type: application/json; charset=utf-8', 'lang:' . $HeaderLanguage);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, str_replace($escapees, $replacements, json_encode($Params, true)));
    $curl_response = curl_exec($curl);
    $curlInfo = curl_getinfo($curl);
    $results['http-code'] = $curlInfo['http_code'];
    $results['full_result'] = $curl_response;
    if (($curl_response == '') || ($curl_response === false)) {
        $results['exp'] = curl_error($curl);
        // $results['info']=$curlInfo;
        curl_close($curl);
        $results['exp'] = $lang['curl_error'];
        $results['code'] = $error_code['404'];
    } else {
        $TheResponse = json_decode($curl_response, true);
        if ($curlInfo['http_code'] == '200') {
            if (isset($TheResponse['msg']))
                $results['exp'] = $TheResponse['msg'];
            if (isset($TheResponse['code']))
                $results['code'] = $TheResponse['code'];
            if (isset($TheResponse['data']))
                $results['result'] = $TheResponse['data'];
            if (isset($TheResponse['data']['count']))
                $results['TotalCount'] = $TheResponse['data']['count'];
        } else {
            $results['exp'] = $lang['general_error'];
            $results['code'] = $curlInfo['http_code'];
        }
        curl_close($curl);

    }
    return $results;
}

function template($template, $data = array())
{
    global $roles_template;
    global $FILES_ROOT;
    global $lang;
    global $APP_ROOT;
    global $page;
    global $current_role_pages;
    extract($data);
    require $template;
}

function escape_db_chars($value)
{
    $search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a");
    $replace = array("\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z");

    return str_replace($search, $replace, $value);
}

function make_safe($data)
{
    if (is_array($data)) return $data;
    $data = trim($data);
    return $data;

}
function make_safe_array($data, $except = array())
{
    $new_array = array();
    foreach ($data as $key => $value) {
        if (in_array($key, $except)) {
            $new_array[$key] = $value;
            continue;
        }
        $new_array[$key] = make_safe($value);
    }
    return $new_array;
}

function redirect($pageName,$path='')
{

    @header("Location: " .$path.$pageName . "");
//    echo "<script language='JavaScript' type='text/JavaScript'>" .
//        "window.location='" . $pageName . "'</script>";

    exit;
}

function timestamp_to_date($timestamp)
{
    return '<div style="direction: rtl">' . date('Y/m/d', $timestamp) . " " . _AtHour . " " . date('H:m', $timestamp) . '</div>';
}

function response($code, $msg, $data = null)
{
    $response['code'] = $code;
    $response['msg'] = $msg;
    $response['data'] = $data;
    return $response;
}

function guid()
{
    if (function_exists('com_create_guid') === true) {
        return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function is_valid_timestamp($timestamp)
{
    return ((string)(int)$timestamp === $timestamp)
        && ($timestamp <= PHP_INT_MAX)
        && ($timestamp >= ~PHP_INT_MAX);
}

function generate_code()
{
    return md5(uniqid(rand()));
}

function encode_password($password)
{
    $salt = "shatha";
    return crypt($password, $salt);
}


function is_not_null_field($field)
{
    return isset($field) && strlen($field) != 0 ? true : false;
}

function is_nested_active($array, $page)
{
    // this function is used for side menu only
    foreach ($array as $item) {
        if ($item['link'] == $page) return true;
    }
    return false;
}

function is_current_role_page($array)
{
    global $current_role_pages;
    foreach ($array as $item) {
        if (in_array($item['link'], $current_role_pages)) return true;
    }
    return false;
}

function limit_string($str)
{
    return strlen($str) > 50 ? substr($str, 0, 50) . "..." : $str;
}
function normalize_files( &$files )
{
    $_files       = [ ];
    $_files_count = count( $files[ 'name' ] );
    $_files_keys  = array_keys( $files );

    for ( $i = 0; $i < $_files_count; $i++ )
        foreach ( $_files_keys as $key )
            $_files[ $i ][ $key ] = $files[ $key ][ $i ];

    return $_files;
}

function upload_image($pic, $path, $size,$root='../../'){

    require_once '../libs/upload/upload.php';
    global $error_code;
    global $lang;
    global $FILES_ROOT;

    $result = array();
    $file_name = guid();
//    if (!file_exists($FILES_ROOT . "images/$path/")) {
//        mkdir($FILES_ROOT . "images/$path/", 0777, true);
//    }

    while (file_exists( $FILES_ROOT."images/".$path."/" . $file_name . ".png")) {

        $file_name = guid();
    }

    if (isset($pic)) {

        @$handle = new upload($pic);
        if ($handle->uploaded) {
//            $handle->file_new_name_body = $file_name;
//            $handle->mime_check = true;
//            $handle->allowed = array('image/*');
//            $handle->image_convert = 'png';
//            $handle->image_resize = true;
//            $handle->image_ratio = true;
//            $handle->dir_auto_create = true;
//            $handle->image_ratio_fill = true;
//            $handle->image_x = $size['thumb']['image_x'];
//            $handle->image_y = $size['thumb']['image_y'];
//            $handle->process('files'."/images/".$path . '/thumb');
//            $handle->image_ratio = true;

//            $handle->file_new_name_body = $file_name;
//            $handle->mime_check = true;
//            $handle->image_resize = true;
//            $handle->image_convert = 'png';
//            $handle->dir_auto_create = true;
//            $handle->image_ratio_crop = false;
//            $handle->dir_auto_create = true;
//
//            $handle->image_x = $size['medium']['image_x'];
//            $handle->image_y = $size['medium']['image_y'];
//            $handle->process('files'."/images/".$path . '/medium');

            $handle->file_new_name_body = $file_name;
            $handle->mime_check = true;
            $handle->image_resize = false;
            $handle->image_convert = 'png';
            $handle->dir_auto_create = true;
            $handle->image_ratio_crop = false;
            $handle->dir_auto_create = true;


//            $handle->image_x = $size['large']['image_x'];
//            $handle->image_y = $size['large']['image_y'];

            $handle->process($root.'files/'."images/".$path . '/large');
            if ($handle->processed) {

                $data['file_name'] = $file_name . ".png";

                $result = response($error_code['success'], $lang['success'], $data);

            } else {
                $result = response($error_code['upload_error'], $handle->error);

            }
        }

    }

    return $result;
}


//function upload_file($file, $path)
//{
//    require_once 'libs/upload/upload.php';
//    global $error_code;
//    global $lang;
//    global $FILES_ROOT;
//    $result = array();
//    $file_name = guid();
////    if (!file_exists($FILES_ROOT . "images/$path/")) {
////        mkdir($FILES_ROOT . "images/$path/", 0777, true);
////    }
//    while (file_exists($FILES_ROOT . "images/$path/" . $file_name . ".png")) {
//        $file_name = guid();
//    }
//    if (isset($file)) {
//
//        @$handle = new upload($file);
//        if ($handle->uploaded) {
//            $handle->file_new_name_body = $file_name;
////            $handle->mime_check = true;
////            $handle->allowed = array('image/*');
////            $handle->image_convert = 'png';
////            $handle->image_resize = true;
////            $handle->image_ratio = true;
////            $handle->dir_auto_create = true;
////            $handle->image_ratio_fill = true;
////            $handle->image_x = $size['thumb']['image_x'];
////            $handle->image_y = $size['thumb']['image_y'];
//            $handle->process("files/$path" );
////            $handle->image_ratio = true;
////
////            $handle->file_new_name_body = $file_name;
////            $handle->mime_check = true;
////            $handle->image_resize = true;
////            $handle->image_convert = 'png';
////            $handle->dir_auto_create = true;
////            $handle->image_ratio_crop = true;
////            $handle->dir_auto_create = true;
////
////            $handle->image_x = $size['medium']['image_x'];
////            $handle->image_y = $size['medium']['image_y'];
////            $handle->process("files/images/$path/" . '/medium');
////
////            $handle->file_new_name_body = $file_name;
////            $handle->mime_check = true;
////            $handle->image_resize = true;
////            $handle->image_convert = 'png';
////            $handle->dir_auto_create = true;
////            $handle->image_ratio_crop = true;
////            $handle->dir_auto_create = true;
////
////
////            $handle->image_x = $size['large']['image_x'];
////            $handle->image_y = $size['large']['image_y'];
////            $handle->process("files/images/$path/" . '/large');
//            if ($handle->processed) {
//                $data['file_name'] = $file_name . ".png";
//                $result = response($error_code['success'], $lang['success'], $data);
//
//            } else {
//                $result = response($error_code['upload_error'], $handle->error);
//
//            }
//        }
//
//    }
//
//
//    return $result;
//}

function check_required_fields($fields)
{
    foreach ($fields as $field) {
        if (!isset($field)) return false;
    }
    return true;
}


function arrayToTable($rows, $idName = 'data', $settings = array('keyNameAsHeadingTitle'=>true, 'trClassClass'=>'', 'cellClasses'=>'', 'sumTr'=>false)) {
    $content ='';
    if (is_array($rows) && count($rows)) {
        $maxCellCounter = 0;
        foreach ($rows as $row) {
            $cellCounter = 0;
            foreach ($row as $col => $val) {
                $cellCounter++;
                if ($cellCounter >= $maxCellCounter) {
                    $maxCellCounter++;
                }
            }
        }
        $content .= '<table' . ($idName ? ' id="' . $idName . '"' : '') . ' class="">';
        $content .= '<thead><tr>';
        if ($settings['keyNameAsHeadingTitle']) {
            $cellCounter = 0;
            foreach ($rows[0] as $colName => $colVal) {
                $colspan = '';
                if (count($rows[0]) == ($cellCounter + 1) && count($rows[0]) < ($maxCellCounter)) {
                    $colspan = ' colspan="' . ($maxCellCounter - ($cellCounter + 1)) . '"';
                }
                $content .= '<th' . $colspan . '>' . $colName . '</th>';
                $cellCounter++;
            }
        } else {
            $cellCounter = 0;
            foreach ($rows[0] as $colName => $colVal) {
                $colspan = '';
                if (count($rows[0]) == ($cellCounter + 1) && count($rows[0]) < ($maxCellCounter)) {
                    $colspan = ' colspan="' . ($maxCellCounter - ($cellCounter + 1)) . '"';
                }
                $content .= '<th' . $colspan . '>' . $colVal . '</th>';
                $cellCounter++;
            }
        }
        $content .= '</tr></thead><tbody>';
        $rowCounter = 0;
        if ($settings['keyNameAsHeadingTitle']) {
            $rowCounter = 1;
        }
        foreach ($rows as $row) {
            if ($rowCounter) {
                $trClass = array();
                if (is_array($settings['trClassClass']) && $settings['trClassClass'][($rowCounter + 1)]) {
                    $trClass = array();
                    $trClass[] = $settings['trClassClass'][($rowCounter + 1)];
                }
                $content .= '<tr' . (count($trClass) ? ' class="' . implode(' ', $trClass) . '"' : '') . '>';
                $cellCounter = 0;
                foreach ($row as $col => $val) {
                    $classes = array();
                    if (is_array($settings['cellClasses']) && isset($settings['cellClasses'][$cellCounter])) {
                        $classes[] = $settings['cellClasses'][$cellCounter];
                    }
                    $classes[] = 'cell' . ($cellCounter + 1);
                    $colspan = '';
                    if (count($row) == ($cellCounter + 1) && count($row) < ($maxCellCounter)) {
                        $colspan = ' colspan="' . ($maxCellCounter - ($cellCounter + 1)) . '"';
                    }
                    $content .= '<td' . (count($classes) ? ' class="' . implode(' ', $classes) . '"' : '') . $colspan . '>' . $val . '</td>';
                    $cellCounter++;
                }
                $content .= '</tr>';
            }
            $rowCounter++;
        }
        $content .= '</tbody>';
        if ($settings['sumTr']) {
            $GLOBALS['TSFE']->additionalHeaderData['tablesorter_js_' . $idName] = '<script data-ignore="true">
            jQuery(document).ready(function($) {
                    $(\'#' . $idName . '\').tablesorter();
                    $(\'#' . $idName . '\').sumtr({
                        readValue : function(e) {
                            return Math.round(e.html().toString().replace(/[^\d.-]/g, \'\') * 100) / 100; return !isNaN(r) ? r : 0;
                        },
                        formatValue : function(val) { return Math.round(val*100)/100; }
                    });
                });
            </script>
            ';
            $content .= '
            <tfoot>
            <tr class="summary">
                <td class="text-right">Total:</td>
            ';
            $rowCounter = 0;
            foreach ($rows[0] as $colName => $colVal) {
                if ($rowCounter) {
                    $content .= '<td class="text-right grandTotal"></td>';
                }
                $rowCounter++;
            }
            $content .= '
            <tr>
            </tfoot>
            ';
        }
        $content .= '</table>';
        return $content;
    }
}
function getFullHost()
{
    $protocole = $_SERVER['REQUEST_SCHEME'].'://';
    $host = $_SERVER['HTTP_HOST'] . '/';
    $project = explode('/', $_SERVER['REQUEST_URI'])[1];
    return $protocole . $host . $project;
}
function getBaseDirectoryName(){
    return explode('/', $_SERVER['REQUEST_URI'])[1];
}

function generatePIN($digits = 5){
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while($i < $digits){
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}

function upload_file($file,$path,$allowed_files,&$msg)
{
    global $lang;
    global $FILES_ROOT;

$fileSize = $file["size"] / 1024;
//var_dump($file);
//exit;
if($file['type']=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
    {
        $fileExt=array(1=>'xlsx');

    }
else
$fileExt = explode('/', $file["type"]);

$fileType = $file["type"];
$fileTmpName = $file["tmp_name"];


//$allowed_files = array(
//
//    "application/pdf",
//    "application/doc",
//    "application/docx",
//    "application/txt",
//    "application/msword",
//    "application/xlsx",
//);

$newFileName = guid();
$newFileName = $newFileName . '.' . $fileExt[1];

if (in_array($fileType, $allowed_files)) {
    if ($fileSize <= 2000) {

        //File upload path
        $uploadPath = $FILES_ROOT . $path.$newFileName;

        //function for upload file
        if(move_uploaded_file($fileTmpName, '../'.$uploadPath))
        {
            return $uploadPath;
        }

    } else {
        $msg=$lang['maximum_size'];
    }

} else {
    $msg=$lang['file_type'];

}


}









?>
