<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config.php';

$blog = new blog();

if (isset($_GET['method']) && !empty($_GET['method'])) {
  $res = array(
    'error' => '',
    'data' => array(),
    'message' => ''
  );
  $data = $blog->readBlog(
    $_GET['method'],
    (isset($_GET['cat_id']) && !empty($_GET['cat_id'])) ? $_GET['cat_id'] : 1,
    (isset($_GET['offset']) && (!empty($_GET['offset']) || $_GET['offset'] == 0)) ? $_GET['offset'] : 0,
    (isset($_GET['no_of_data']) && !empty($_GET['no_of_data'])) ? $_GET['no_of_data'] : 10,
    (isset($_GET['date']) && !empty($_GET['date'])) ? $_GET['date'] : 2020
  );
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
  

} elseif (isset($_GET['id']) && !empty($_GET['id'])) {
  $res = read($blog, $_GET['id']);
} else {
  $res = read($blog, null ,true);
}

echo json_encode($res);
?>