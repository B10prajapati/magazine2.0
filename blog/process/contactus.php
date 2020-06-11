<?php
  include '../config.php';

  if ($_POST) {
    if (isset($_POST['submit'])) {
  
      $datas = array(
        'id'=> (isset($_POST['comment_id']) && !empty($_POST['comment_id'])) ? $_POST['commentid'] : 1,
        'data' => array()
        );
      foreach($_POST as $key => $value) {
        if ($key != 'id' && !empty($key) && !empty($value) && $key != 'submit' && $key != 'page_name' ) 
          if($key != 'content')
            $datas['data'][$key] = sanitize($value); 
          else
            $datas['data'][$key] = htmlentities($value);
        }
        if ($_POST['submit'] == 'create') {
        } elseif ($_POST['submit'] == 'update') {
        } elseif ($_POST['submit'] == 'delete'){
          $datas = array(
            'id'=> $datas['commentid']
          );
        }else {
          redirect('../pages/'.$_POST['page_name'], 'error', 'Undefined actioned called');
        }
              
        $res = CallAPI('POST',SITE_URL.'api/'.$_POST['page_name'].'/'.$_POST['submit'], json_encode($datas));  
        echo $res;
        $response = json_decode($res, true);
        $error = $response['error'];
        $data = $response['data'];
        $message = $response['message'];
      
        if (empty($error)) {
          redirect('../pages/'.$_POST['page_name'], 'success', 'Comment has been sent for moderation. Thank You for your comment');
        } else {
          redirect('../pages/'.$_POST['page_name'], 'error', 'Error Occured during '.$_POST['submit'].' categroy: '.$error);
        }
    
    } else {
      redirect('../pages/'.$_POST['page_name'], 'error', 'Data not submitted');
    }
  } else {
    redirect('../pages/'.$_POST['page_name'], 'error', 'Unauthorized access');
  }
?>