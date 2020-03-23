<?php
/**test**/

//var_dump($_GET['iDisplayLength']);
//var_dump($_GET['iDisplayStart']);
//var_dump($_GET['iSortCol_0']);
//var_dump($_GET['sSortDir_0']);
//var_dump($_GET['sSearch']);


 $API_ROOT='http://mypharma-001-site1.atempurl.com/api/';
$ch = curl_init();
//    var_dump(json_encode($API_ROOT.'DrugsAdmin/LoadDrugsList'));exit;
curl_setopt($ch, CURLOPT_URL, $API_ROOT.'DrugsAdmin/LoadDrugsList');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_POST));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = json_decode(curl_exec($ch));
curl_close($ch);




//var_dump(api_post('DrugsAdmin/LoadDrugsList',$_POST));exit();

echo json_encode($server_output);exit();

//var_dump($_POST);exit();

$array2= array();
for($i=0; $i<10; $i++)
{
    $array = array(

        'col1'=>$i,
        'col2'=>$i,
        'col3'=>$i
    );

    array_push($array2,$array);
}






//$array3['iTotalRecords']=sizeof($array2);
//$array3['iTotalDisplayRecords']=sizeof($array2);
$array3['recordsTotal']=30;
$array3['recordsFiltered']=30;
$array3['aaData']=$array2;

echo json_encode($array3);