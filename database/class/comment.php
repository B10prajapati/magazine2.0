<?php

  class comment extends crudDatabase {
    function __construct()
    {
      crudDatabase::__construct('comments');
    }

    // Read Dataa
    public function readComments($method, $blog_id=1, $comment_id=1, $is_die=false){
      switch ($method) {
        case 'getAllWaiting':
          $args = array(
            'where' => array(
                'and' => array(
                  'status'=>'Active',
                  'state'=>'waiting'
                )
              ),
            'order'=>'ASC'
          );
        break;
        case 'getAllAcceptedInBlog':
          $args = array(
            'where' => array(
                'and' => array(
                  'status'=>'Active',
                  'state'=>'accept',
                  'blogid'=>$blog_id,
                  'commentType'=>'comment'
                )
              ),
            'order'=>'ASC'
          );
        break;
        case 'getAllAcceptedReplyInBlog':
          $args = array(
            'where' => array(
                'and' => array(
                  'status'=>'Active',
                  'state'=>'accept',
                  'blogid'=>$blog_id,
                  'commentType'=>'reply',
                  'commentid'=>$comment_id
                )
              ),
            'order'=>'ASC'
          );
        break;
        case 'getNumberOfCommentInBlog':
          $args = array(
            'fields' => ['COUNT(id) as total'],
            'where' => array(
                'and' => array(
                  'status'=>'Active',
                  'state'=>'accept',
                  'blogid'=>$blog_id
                )
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