<?php
  // SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include '../config.php';

$followus = new followus();

$data = json_decode(file_get_contents("php://input"), true);

$res = update($followus, $data);

echo json_encode($res);
?>