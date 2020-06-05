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
        if ($key != 'id' && !empty($key) && !empty($value) && $key != 'submit' && $key != 'page_name') 
          $datas['data'][$key] = $value ; 
      }
        if ($_POST['submit'] == 'create') {
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