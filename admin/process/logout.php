<?php
include '../config.php';
 $datas = array(
  'id' => $_SESSION['user_email'],
  'data' => array(
    'session_token' => ''
  )
);
$update_data = CallAPI('POST', SITE_URL.'api/user/update', json_encode($datas));
$response = json_decode($update_data, true);

$error = $response['error'];
$user_info = $response['data'];
$message = $response['message'];

session_unset();

if (isset($_COOKIE['__auth_user']) && !empty($_COOKIE['__auth_user'])) {
  setcookie('__auth_user', '', time() - (60*60*24*7), '/');
}
redirect('../pages/login');

?>