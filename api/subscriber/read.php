<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config.php';

$subscriber = new subscriber();
$res = array(
  'error' => '',
  'data' => array(),
  'message' => ''
);
if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['method']) && !empty($_GET['method']) ) { 
  
  $data = $subscriber->readSubscriber($_GET['id'], $_GET['method']);

  if (isset($data)) {
    if (!empty($data)) {
      $res['message'] = 'Data successfully read';
      $res['data'] = $data;
    } else {
      $res['message'] = 'Data doesnt exist';
    }
  } else {
    $res['error'] = 'Error while reading data';
  }
} else {
  $res = read($subscriber, null, true);
}

echo json_encode($res);
?>