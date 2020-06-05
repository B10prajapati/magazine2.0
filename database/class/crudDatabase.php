<?php

  class crudDatabase extends database {
    function __construct($table)
    {
      $this->table = $table;
      database::__construct();
    }

    // Create Data
    public function create($data, $is_die=false) {
      return $this->addData($data, $is_die);
    }
    // Read Data
    public function read($id, $is_die=false){
      $args = array(
        'fields' => " * ",
        'where' => array(
          'or' => array(
            'id' => $id,
          )
        )
      );
      return $this->getData($args, $is_die);
    }

    public function readAll($is_die=false) {
      $args = array(
				'where' => array(
						'and' => array(
							'status'=>'Active',
						)
					),
				'order'=>'ASC'
			);
			return $this->getData($args,$is_die);
    }
    // Update data
    public function update($id, $data, $is_die=false) {
      $args = array(
				'where' => array(
						'or' => array(
							'id' => $id,
						)
					)
			);
			return $this->updateData($data,$args,$is_die);
    }

    // Delete Data
    public function delete($id, $is_die=false) {
      $args = array(
				'where' => array(
						'or' => array(
							'id' => $id,
						)
					)
      );
      
			return $this->deleteData($args, $is_die);
    }
  }
?>