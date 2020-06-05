<?php
class advertisement extends crudDatabase{
  public function __construct() {
    crudDatabase::__construct('advertisements');
  }

  public function readAdvertisement($method,$type='Simple', $offset=1, $no_of_data=1, $is_die=false) {
    switch ($method) {
      case 'getAllAdvertisementByTypeWithLimit':
        $args = array( 
          'where' => array(
              'and' => array(
                'status'=>'Active',
                'type' =>$type
              )
            ),
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