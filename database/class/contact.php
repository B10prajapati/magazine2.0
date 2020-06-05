<?php
class contact extends crudDatabase{
  public function __construct() {
    crudDatabase::__construct('contacts');
  }

  public function readContact($method, $contact_id=1, $offset=1, $no_of_data=1, $is_die=false) {
    switch ($method) {
      case 'getAll':
        $args = array(
          'where' => array(
              'or' => array(
                'state' => 'waiting',
              )
            ),
          'order'=>'ASC'
        );
      break;
      case 'getById':
        $args = array(
          'where' => array(
              'or' => array(
                'id' => $contact_id,
              )
            )
        );
      break;
      case 'getAllContactWithLimit':
        $args = array(         
          'where' => array(
              'or' => array(
                'state' => 'waiting',
              )
            ),
          'order'=>'ASC',
          'limit' => array(
                'offset' => $offset,
                'no_of_data' => $no_of_data	
               )
        );
      break;
      default:
    
        return null;
    }
    
		return $this->getData($args,$is_die);
  } 
}
?>