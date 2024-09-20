<?php
require_once 'functions.php';

header('Content-Type: application/json');
$formData = isset($_REQUEST['formData']) ? $_REQUEST['formData'] : array();

if (!empty($formData)) {
    $getInsertResponse    =   send_data_via_api($formData);
    $getRetrieveResponse    =   get_data_via_api();
    echo json_encode(array(
        'insert_response'   =>  $getInsertResponse,
        'retrieve_response' =>  $getRetrieveResponse,
    ));
} else {
    echo json_encode(array('status' => 'false', 'message' => 'Data not received.'));
}
