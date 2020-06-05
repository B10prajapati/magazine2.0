<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'config/init.php';

  //DRY - DONOT REPEAT YOURSELF
  // Create
  function create($obj, $data) {
    $res = array(
      'error' => '',
      'data' => array(),
      'message' => ''
    );
    
    if (isset($data) && !empty($data)) {
      $success = $obj->create($data);
    
      if ($success) {
        $res['message'] = 'Data Created Succesfully';
      } else {
        $res['error'] = 'Data Not Created';
      }
    } else {
      $res['error'] = 'Fill out all fields';
    }

    return $res;
  }

  // Read
  function read($obj, $id = 1 ,$all=false) {
    $res = array(
      'error' => '',
      'data' => array(),
      'message' => ''
    );
    if ($all) {
      $data = $obj->readAll();
    } else {
      if(isset($id) && !empty($id)) { 
        $data = $obj->read($id);
      } else {
        $res['error'] = 'Error Occurred no id found';
        return $res;
      }
    }
    
    if (isset($data)) {
      if (!empty($data)) {
        $res['message'] = 'Data successfully read';
        $res['data'] = $data;
      } else {
        $res['error'] = 'Data doesnt exist';
      }
    } else {
      $res['error'] = 'Error while reading data';
    }
    
    return $res;
  }

  // Update 
  function update($obj, $data) {
    $res = array(
      'error' => '',
      'data' => array(),
      'message' => ''
    );
    
    if (isset($data) && !empty($data)) {
      $success = $obj->update($data['id'], $data['data']);
    
      if ($success) {
        $res['message'] = 'Data Updated Succesfully';
      } else {
        $res['error'] = 'Data Not Updated';
      }
    } else {
      $res['error'] = 'Fill out all fields';
    }
    return $res;
  }

  // Delete
  function delete($obj, $data) {
    $res = array(
      'error' => '',
      'data' => array(),
      'message' => ''
    );
    if (isset($data['id']) && !empty($data['id'])) {
      //$success =true;
      $success = $obj->delete($data['id']);
      if ($success) {
        $res['message'] = 'Data deleted successfully';
      } else {
        $res['error'] = 'Problem while deleting data';  
      }
    } else {
      $res['error'] = 'No Delete id specified';
    }
    return $res;
  }
?>