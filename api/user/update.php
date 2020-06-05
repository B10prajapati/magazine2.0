<?php
  // SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include '../config.php';

$users = new users();

$data = json_decode(file_get_contents("php://input"), true);
$res = array(
  'error' => '',
  'data' => array(),
  'message' => ''
);

if (isset($data['id']) && !empty($data['id']) && isset($data['data']) && !empty($data['data'])) {
  if (gettype($data['id']) == 'string') {
    $success = $users->updateUser($data['id'], $data['data']);
    if ($success) {
      $res['message'] = 'Data Updated Succesfully';
    } else {
      $res['message'] = 'Data Not Created';
    }
  } else {
    $res = update($users, $data);
  }
 
} else {
  $res['message'] = 'Fill out all fields';
}

echo json_encode($res);
?>