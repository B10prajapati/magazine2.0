<?php
include '../config.php';
if ($_POST) {
  if (isset($_POST['email']) && !empty($_POST['email'])) {
    $data['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if ($data['email']) {
      if (isset($_POST['password']) && !empty($_POST['password'])) {
        $data['password'] = sha1($_POST['email'].$_POST['password']);
        $get_data = CallAPI('GET', SITE_URL.'api/user/read?id='.$_POST['email'].'&method=email', false);
        $response = json_decode($get_data, true);
        
        $error = $response['error'];
        $user_info = $response['data'];
        $message = $response['message'];
        if (empty($error)) {
          if (isset($user_info[0]['email']) && !empty($user_info[0]['email'])) {
            if ($user_info[0]['password'] == $data['password']) {
              if ($user_info[0]['role']== 'Admin') {
                if ($user_info[0]['status'] == 'Active') {
                  $_SESSION['user_id'] = $user_info[0]['id'];
                  $_SESSION['user_username'] = $user_info[0]['username'];
                  $_SESSION['user_email'] = $user_info[0]['email'];
                  $_SESSION['user_role'] = $user_info[0]['role'];
                  $_SESSION['user_status'] = $user_info[0]['status'];
                  $token = tokenize();
                  $_SESSION['auth_token'] = $token;

                  $datas = array(
                    'id' => $user_info[0]['email'],
                    'data' => array(
                      'session_token' => $token
                    )
                  );
                  $update_data = CallAPI('POST', SITE_URL.'api/user/update', json_encode($datas));
                  $response = json_decode($update_data, true);
                  
                  $error = $response['error'];
                  $user_info = $response['data'];
                  $message = $response['message'];
                  if (empty($error)) {
                    if (isset($_POST['rememberme']) && !empty($_POST['rememberme']) && $_POST['rememberme']=='on') {
                      setcookie('__auth_user', $token, time() + (60*60*24*7), '/');
                    }
                    redirect('../pages/dashboard', 'success', 'Welcome to Dashboard');
                  } else {
                    redirect('../pages/login', 'error', 'Error Updating token');
                  }
                
                } else {
                  redirect('../pages/login', 'error', 'Contact admin to reactivate account');
                }
              } else {
                redirect('../pages/login', 'error', 'Only Admin access allowed');
              }
            } else {
              redirect('../pages/login', 'error', 'Password incorrect');
            }
          } else {
            redirect('../pages/login', 'error', 'Cannot find User');
          }
          
        } else {
          redirect('../pages/login', 'error', 'Error occured: '.$error);      
        }
      } else {
        redirect('../pages/login', 'error', 'Password is required');
      }
    } else {
      redirect('../pages/login', 'error', 'Email does not have proper format');
    }
  } else {
    redirect('../pages/login', 'error', 'Email is not set');
  }
} else {
  redirect('../pages/login', 'error', 'Unauthorized Access');
}

?>