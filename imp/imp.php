<?php
require_once('../b.php');
require_once('../d.php');
require_once('bimp.php');

try {

    // First tests

    if (!isset($_FILES['file']) or $_FILES['file']['error'] != 0) throw new Exception("no file");
    if (!is_file($_FILES['file']['tmp_name'])) throw new Exception("no file");

    $dbid = getDbIdByToken($_REQUEST['token']);
    if (!$dbid) throw new Exception("token");

    $obj = new BanMovImpService();
    $msg = $obj->imp($dbid, $_FILES['file']);

    response($data);

} catch (Exception $e) {

    if ($e->getMessage() == 'token') {
        response([], 401, 'unauthorized');
    } else {
        response($data, 400, $e->getMessage());
    }

    
}


function response($data, $status = 200, $status_message = 'Ok') {

    header("HTTP/1.1 $status $status_message");
    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;

    $json_response = json_encode($response);
    echo $json_response;
}
?>