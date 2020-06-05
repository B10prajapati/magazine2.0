<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config.php';

$comment = new comment();

if (isset($_GET['method']) && !empty($_GET['method'])) {
  $res = array(
    'error' => '',
    'data' => array(),
    'message' => ''
  );
  
  $data = $comment->readComments(
    $_GET['method'],
    (isset($_GET['blog_id']) && !empty($_GET['blog_id'])) ? $_GET['blog_id'] : 1,
    (isset($_GET['comment_id']) && !empty($_GET['comment_id'])) ? $_GET['comment_id'] : 1,
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
  $res = read($comment, $_GET['id']);
} else {
  $res = read($comment, null ,true);
}

echo json_encode($res);
?>