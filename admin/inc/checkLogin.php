<?php
  
  if (isset($_SESSION['auth_token']) && !empty($_SESSION['auth_token'])) {
    $get_data = CallAPI('GET', SITE_URL.'api/user/read?id='.$_SESSION['auth_token'].'&method=token', false);
    $response = json_decode($get_data, true);
    
    $error = $response['error'];
    $user_info = $response['data'];
    $message = $response['message'];
    
    if (!isset($user_info[0]['session_token']) && empty($user_info[0]['session_token'])) {
      redirect('../process/logout');
    } else {
      //logged in
			if (pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)=='login') {
				redirect('../index','success','Session You are already logged in.');
			}
    }
  } else {
    // session token not available
    if (isset($_COOKIE['__auth_user']) && !empty($_COOKIE['__auth_user'])) {
      if (isset($user_info[0]['session_token']) && !empty($user_info[0]['session_token'])) {
        $_SESSION['user_id'] = $user_info[0]['id'];
				$_SESSION['user_name'] = $user_info[0]['username'];
				$_SESSION['user_email'] = $user_info[0]['email'];
				$_SESSION['user_role'] = $user_info[0]['role'];
				$_SESSION['user_status'] = $user_info[0]['status'];
				$token = tokenize();
				$_SESSION['auth_token'] = $token;
				$data = array(
          'id' => $_SESSION['user_email'],
          'data' => array('session_token' => $token)
        );
        $update_data = CallAPI('POST', SITE_URL.'api/user/update', json_encode($data));
        $response = json_decode($update_data, true);
        
        $error = $response['error'];
        $user_info = $response['data'];
        $message = $response['message'];
                  
				setcookie('_auth_user',$token,time()+(60*60*24*7),'/');
				if (pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)=='login') {
					redirect('../pages/dashboard','success','Cookie Welcome to Dashboard');
				}
      }else{
        // logged out 
        setcookie('_auth_user','',time()-100,'/');
        if (pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)=='index') {
          redirect('pages/login','error','NO cookie also You must logged in first.');
        }
        if (pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)!='login') {
          redirect('../pages/login','error','No cookie also You must logged in first.');
        } 
      }
    } 
    //logged out
    if (pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)=='index') {
      redirect('pages/login','error','No session You must logged in first.');
    }
    if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) != 'login') {
      redirect('../pages/login', 'error', 'NOsession Login First');
    }
    
  }

?>