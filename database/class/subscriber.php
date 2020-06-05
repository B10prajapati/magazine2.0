<?php
class subscriber extends crudDatabase{
  public function __construct() {
    crudDatabase::__construct('subscribers');
  }

  public function readSubscriber($method, $blog_id=1, $subscriber_id=1, $is_die=false) {
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
      case 'getAllAcceptByBlog':
        $args = array(
          'where' => array(
              'and' => array(
                'status'=>'Active',
                'state'=>'accept',
                'blogid'=>$blog_id,
                'subscriberType'=>'subscriber'
              )
            ),
          'order'=>'ASC'
        );
      break;
      case 'getAllAcceptReplyByBlogBySubscriber':
        $args = array(
          'where' => array(
              'and' => array(
                'status'=>'Active',
                'state'=>'accept',
                'blogid'=>$blog_id,
                'subscriberType'=>'reply',
                'subscriberid'=>$subscriber_id
              )
            ),
          'order'=>'ASC'
        );
      break;
      case 'getNoOfSubscriberByBlog':
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
		return $this->getData($args,$is_die);
  } 
}
?>