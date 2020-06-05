<?php

  class users extends crudDatabase {
    function __construct()
    {
      crudDatabase::__construct('users');
    }

    
    // Read Dataa
    public function readUser($identifier, $method='', $is_die=false){
      switch ($method) {
        case 'getNameById':
          $args = array(
            'fields' => "username, email",
            'where' => array(
              'or' => array(
                'id' => $identifier,
              )
            )
          );
          break;
        case 'token':
          $args = array(
            'where' => array(
                'and' => array(
                  'session_token' => $identifier,
                  'status' => 'Active'
                )
              )
          );
          break;
        case 'email':
          $args = array(
            'where' => array(
                'and' => array(
                  'email' => $identifier,
                  'status' => 'Active'
                )
              )
          );
          break;
        default:
          return null;
      }
      return $this->getData($args, $is_die);
    }

    // Update data
    public function updateUser($identifier, $data, $is_die=false) {
      $args = array(
				'where' => array(
						'or' => array(
							'email' => $identifier,
						)
					)
			);
			return $this->updateData($data,$args,$is_die);
    }

  }
?>