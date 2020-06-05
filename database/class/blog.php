<?php

  class blog extends crudDatabase {
    function __construct()
    {
      crudDatabase::__construct('blogs');
    }

    // Read Dataa
    public function readBlog($method, $cat_id, $offset, $no_of_data, $date,$is_die=false){

      switch ($method) {
        case 'byDate':
          $args = array(
            'fields' => ['id',
                          'title',
                          'content',
                          'featured',
                          'categoryid',
                          '(SELECT categoryname from categories where id = categoryid) as category',
                          'view',
                          'image',
                        'created_date'],
            'where' => " where created_date LIKE '".$date."%'"
          );
        break;
        case 'getAllFeaturedBlogByCategoryWithLimit':
          $args = array(
            'fields' => ['id',
                          'title',
                          'content',
                          'featured',
                          'categoryid',
                          '(SELECT categoryname from categories where id = categoryid) as category',
                          'view',
                          'image',
                        'created_date'],
                          
            'where' => array(
                'and' => array(
                  'status'=>'Active',
                  'featured' =>"Featured",
                  'categoryid'=>$cat_id
                )
              ),
            'limit' => array(
                  'offset' => $offset,
                  'no_of_data' => $no_of_data	
                 )
          );
        break;
        case 'getAllRecentBlogByCategoryWithLimit':
          $args = array(
            'fields' => ['id',
                          'title',
                          'content',
                          'featured',
                          'categoryid',
                          '(SELECT categoryname from categories where id = categoryid) as category',
                          'view',
                          'image',
                        'created_date'],
                          
            'where' => array(
                'and' => array(
                  'status'=>'Active',
                  'categoryid'=>$cat_id
                )
              ),
            'limit' => array(
                  'offset' => $offset,
                  'no_of_data' => $no_of_data	
                 )
          );
        break;
        case 'getNumberOfBlogByCategory':
          $args = array(
            'fields' => ['COUNT(id) as total'],
            'where' => array(
                'and' => array(
                  'status'=>'Active',
                  'categoryid'=>$cat_id
                )
              )
          );
        break;
        case 'getAllPopularBlogByCategoryWithLimit':
          $args = array(
            'fields' => ['id',
                          'title',
                          'content',
                          'featured',
                          'categoryid',
                          '(SELECT categoryname from categories where id = categoryid) as category',
                          'view',
                          'image',
                        'created_date'],
                          
            'where' => array(
                'and' => array(
                  'status'=>'Active',
                  'categoryid'=>$cat_id
                )
              ),
            'order' =>array(
                'columnname'=>'view',
                'orderType'=>'DESC'
              ),
            'limit' => array(
                  'offset' => $offset,
                  'no_of_data' => $no_of_data	
                 )
          );

        break;
        case 'getAllFeaturedBlogWithLimit':
          $args = array(
            'fields' => ['id',
                          'title',
                          'content',
                          'featured',
                          'categoryid',
                          '(SELECT categoryname from categories where id = categoryid) as category',
                          'view',
                          'image',
                        'created_date'],
                          
            'where' => array(
                'and' => array(
                  'status'=>'Active',
                  'featured' =>"Featured",
                )
              ),
            'limit' => array(
                  'offset' => $offset,
                  'no_of_data' => $no_of_data	
                 )
          );
        break;
        case 'getAllRecentBlogWithLimit':
          $args = array(
            'fields' => ['id',
                          'title',
                          'content',
                          'featured',
                          'categoryid',
                          '(SELECT categoryname from categories where id = categoryid) as category',
                          'view',
                          'image',
                        'created_date'],
                          
            'where' => array(
                'and' => array(
                  'status'=>'Active',
                )
              ),
            'limit' => array(
                  'offset' => $offset,
                  'no_of_data' => $no_of_data	
                 )
          );
        break;
        case 'getNumberOfBlog':
          $args = array(
            'fields' => ['COUNT(id) as total'],
            'where' => array(
                'and' => array(
                  'status'=>'Active',
                )
              )
          );
        break;
        case 'getAllPopularBlogWithLimit':
          $args = array(
            'fields' => ['id',
                          'title',
                          'content',
                          'featured',
                          'categoryid',
                          '(SELECT categoryname from categories where id = categoryid) as category',
                          'view',
                          'image',
                        'created_date'],
                          
            'where' => array(
                'and' => array(
                  'status'=>'Active',
                )
              ),
            'order' =>array(
                'columnname'=>'view',
                'orderType'=>'DESC'
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
      return $this->getData($args, $is_die);
    }
  }
?>