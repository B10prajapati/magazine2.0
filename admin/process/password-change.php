<?php
  include '../config.php';
  include '../inc/checkLogin.php';

  if ($_POST) {
    if (isset($_POST['oldpassword']) && !empty($_POST['oldpassword'])) {
      if (isset($_POST['newpassword']) && !empty($_POST['newpassword'])) {
        if ($_POST['password'] == $_POST['newpassword']) {
          $get_data = CallAPI('GET', SITE_URL.'api/user/read?id='.$_SESSION['user_email'].'&method=email', false);
          $response = json_decode($get_data, true);
          
          $error = $response['error'];
          $user_info = $response['data'];
          $message = $response['message'];
          if (empty($error)) {
            if ($user_info) {
              $password = sha1($_SESSION['user_email'].$_POST['oldpassword']);
              if ($password == $user_info[0]['password']) {
                $data = array(
                  'id'=> $user_info[0]['email'],
                  'data'=> array(
                    'password'=> sha1($user_info[0]['email'].$_POST['password'])
                  )
                );
                $update_data = CallAPI('POST', SITE_URL.'api/user/update', json_encode($data));
                $response = json_decode($update_data, true);

                $error = $response['error'];
                $user_info = $response['data'];
                $message = $response['message'];
            
                if (empty($error)) {
                  redirect('../pages/password-change', 'success', 'Password Changed successfully');
                } else {
                  redirect('../pages/password-change', 'error', 'Error whille changinig password');
                }
              } else {
                redirect('../pages/password-change', 'error', 'Old password doesnot match');
              }
            } else {
              redirect('../pages/password-change', 'error', 'User doesnot exist');
            }
          } else {
            redirect('../pages/password-change', 'error', 'Problem while retreiving data from database');
          }      
        } else {
          redirect('../pages/password-change', 'error', 'New Passwords do not mathc');
        }
      } else {
        redirect('../pages/password-change', 'error', 'New Passwords do not exist');
      }
    } else {
      redirect('../pages/password-change', 'error', 'New Passwords do not exists');
    }
  } else {
    redirect('../pages/password-change', 'error', 'Unauthorized access');
  }

?>  