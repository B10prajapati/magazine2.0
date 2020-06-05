<?php
  include '../config.php';
  include '../inc/checkLogin.php';
  function upload() {
    $success = uploadImage($_FILES['image'], $_POST['page_name']);
    if ($success) {
      
      if (isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_PATH.$_POST['page_name'].'/'.$_POST['old_image'])) {
        unlink(UPLOAD_PATH.$_POST['page_name'].'/'.$_POST['old_image']);
      }
      return $success;
    } else {
      redirect('../pages/'.$_POST['page_name'], 'error', 'Error while uploading image');
    }
  }
  if ($_POST) {
    if (isset($_POST['submit'])) {
      
      $datas = array(
        'id'=> $_POST['id'],
        'data' => array()
        );
      if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image'] && $_FILES['image']['error'] == 0)) {
        $datas['data']['image'] = upload();
      }
      foreach($_POST as $key => $value) {
        if ($key != 'id' && !empty($key) && !empty($value) && $key != 'submit' && $key != 'page_name' && $key != 'old_image') 
          if($key != 'content')
            $datas['data'][$key] = sanitize($value); 
          else
            $datas['data'][$key] = htmlentities($value);
        }
        if ($_POST['submit'] == 'create') {
          $datas['data']['added_by'] = $_SESSION['user_id'];
        } elseif ($_POST['submit'] == 'update') {
        } elseif ($_POST['submit'] == 'delete'){
          $datas = array(
            'id'=> $datas['id']
          );
        }else {
          redirect('../pages/'.$_POST['page_name'].'', 'error', 'Undefined actioned called');
        }
        $res = CallAPI('POST',SITE_URL.'api/'.$_POST['page_name'].'/'.$_POST['submit'], json_encode($datas));  
        echo $res;
        $response = json_decode($res, true);
        $error = $response['error'];
        $data = $response['data'];
        $message = $response['message'];
      
        if (empty($error)) {
          redirect('../pages/'.$_POST['page_name'].'', 'success', ''.$_POST['page_name'].' '.$_POST['submit'].$message);
        } else {
          redirect('../pages/'.$_POST['page_name'].'', 'error', 'Error Occured during '.$_POST['submit'].' categroy: '.$error);
        }
    
    } else {
      redirect('../pages/'.$_POST['page_name'].'', 'error', 'Data not submitted');
    }
  } else {
    redirect('../pages/'.$_POST['page_name'].'', 'error', 'Unauthorized access');
  }
?>