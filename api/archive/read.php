<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config.php';

$archive = new archive();

if (isset($_GET['id']) && !empty($_GET['id'])) {
  $res = read($archive, $_GET['id']);
} else {
  $res = read($archive, null ,true);
}
echo json_encode($res);
?>