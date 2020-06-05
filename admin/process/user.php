<?php
  include '../config.php';
  include '../inc/checkLogin.php';
  if ($_POST) {
    if (isset($_POST['submit'])) {
      $datas = array(
        'id'=> $_POST['id'],
        'data' => array()
        );
      foreach($_POST as $key => $value) {
        if ($key != 'id' && !empty($key) && $key != 'submit')
          $datas['data'][$key] = $value ; 
      }
      if (!empty($datas['data']['email']) || $_POST['submit']=='delete') {
        

        if ($_POST['submit'] == 'create') {
          $datas['data']['added_by'] = $_SESSION['user_id'];
          
          $data = CallAPI('POST',SITE_URL.'api/user/create', json_encode($datas['data']));
        } elseif ($_POST['submit'] == 'update') {
          $datas['id'] = $datas['data']['email'];
          $data = CallAPI('POST',SITE_URL.'api/user/update', json_encode($datas));
        } elseif ($_POST['submit'] == 'delete'){
          $data = CallAPI('POST',SITE_URL.'api/user/delete', json_encode($datas));  
        }else {
          redirect('../pages/user', 'error', 'Undefine actioned called');
        }
        
        $response = json_decode($data, true);
        $error = $response['error'];
        $data = $response['data'];
        $message = $response['message'];

        if (empty($error)) {
          redirect('../pages/user', 'success', 'user '.$_POST['submit'].$message);
        } else {
          redirect('../pages/user', 'error', 'Error Occured during '.$_POST['submit'].' categroy: '.$error);
        }
      } else {
        redirect('../pages/user', 'error', 'Empty title');
        
      }
    } else {
      redirect('../pages/user', 'error', 'Data not submitted');
    }
  } else {
    redirect('../pages/user', 'error', 'Unauthorized access');
  }
?>