<?php
  include '../config.php';
  $pagename = '../pages/'.$_POST['page_name'];
  $pagename = (isset($_POST['blogid']) && !empty($_POST['blogid'])) ? $pagename.'?id='.$_POST['blogid'] : $pagename;
  if ($_POST) {
    if (isset($_POST['submit'])) {
  
      $datas = array(
        'id'=> (isset($_POST['comment_id']) && !empty($_POST['comment_id'])) ? $_POST['commentid'] : 1,
        'data' => array()
        );
      foreach($_POST as $key => $value) {
        if ($key != 'id' && !empty($key) && !empty($value) && $key != 'submit' && $key != 'page_name' && $key != 'api' ) 
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
          redirect($pagename, 'error', 'Undefined actioned called');
        }
              
        $res = CallAPI('POST',SITE_URL.'api/'.$_POST['api'].'/'.$_POST['submit'], json_encode($datas));  
        echo $res;
        $response = json_decode($res, true);
        $error = $response['error'];
        $data = $response['data'];
        $message = $response['message'];
      
        if (empty($error)) {
          redirect($pagename, 'success', 'Your Data Submitted. Thank You for your input');
        } else {
          redirect($pagename, 'error', 'Error Occured during '.$_POST['submit'].' categroy: '.$error);
        }
    
    } else {
      redirect($pagename, 'error', 'Data not submitted');
    }
  } else {
    redirect($pagename, 'error', 'Unauthorized access');
  }
?>