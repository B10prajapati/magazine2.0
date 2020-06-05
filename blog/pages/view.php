<?php
  include '../config.php';
  if (!isset($_GET['id']) || empty($_GET['id'])) {
    redirect('404');
  }


  // Blog data
  $get_data = CallAPI('GET',SITE_URL.'api/blog/read?id='.$_GET['id'], false);
  $response = json_decode($get_data, true);

  $error = $response['error'];
  $data = $response['data'];
  $message = $response['message'];


 // $title used by header
  $title = $data[0]['title'];
 
  include '../inc/header.php';
  include '../inc/navbar.php';
  // Blog View update
    $updated_data = $datas = array(
      'id' => $_GET['id'],
      'data' => array(
        'view' => $data[0]['view'] + 1
      )
    );
    $get_data = CallAPI('POST',SITE_URL.'api/blog/update?id='.$_GET['id'], json_encode($updated_data));
    $response = json_decode($get_data, true);
  
    $error = $response['error'];
    $message = $response['message'];
  
  // Archive data
  $get_data = CallAPI('GET',SITE_URL.'api/archive/read', false);
  $response = json_decode($get_data, true);

  $archive_error = $response['error'];
  $archive_data = $response['data'];
  $archive_message = $response['message'];

  // Category Data
  $get_data = CallAPI('GET',SITE_URL.'api/category/read', false);
  $response = json_decode($get_data, true);
  
  $cat_error = $response['error'];
  $cat_data = $response['data'];
  $cat_message = $response['message'];

  // Advertisement Simple Data
  $get_data = CallAPI('GET',SITE_URL.'api/advertisement/read?method=getAllAdvertisementByTypeWithLimit&offset=0&no_of_data=2&type=Simple', false);
  $response = json_decode($get_data, true);
  
  $adv_error = $response['error'];
  $adv_simple_data = $response['data'];
  $adv_message = $response['message'];
  
  // Advertisement Wide Data
  $get_data = CallAPI('GET',SITE_URL.'api/advertisement/read?method=getAllAdvertisementByTypeWithLimit&offset=0&no_of_data=2&type=Wide', false);
  $response = json_decode($get_data, true);
  
  $adv_error = $response['error'];
  $adv_wide_data = $response['data'];
  $adv_message = $response['message'];
  
  // Most popular  Data
  $get_data = CallAPI('GET',SITE_URL.'api/blog/read?method=getAllPopularBlogWithLimit&offset=0&no_of_data=6', false);
  $response = json_decode($get_data, true);
  
  $popular_error = $response['error'];
  $popular_data = $response['data'];
  $popular_message = $response['message'];
  
  
  // Featured BLog Data 
  $get_data = CallAPI('GET',SITE_URL.'api/blog/read?method=getAllFeaturedBlogWithLimit&offset=0&no_of_data=6', false);
  $response = json_decode($get_data, true);
          
  $error = $response['error'];
  $featured_data = $response['data'];
  $message = $response['message'];

  // Blog Writer Data
  $get_data = CallAPI('GET',SITE_URL.'api/user/read?id='.$data[0]['added_by'].'&method=getNameById', false);
  $response = json_decode($get_data, true);

  $user_error = $response['error'];
  $user_data = $response['data'];
  $user_message = $response['message'];
  
  // Comment Data
  $get_data = CallAPI('GET',SITE_URL.'api/comment/read?method=getAllAcceptedInBlog&blog_id='.$_GET['id'], false);
  $response = json_decode($get_data, true);

  $comment_error = $response['error'];
  $comment_data = $response['data'];
  $comment_message = $response['message'];
  
  // Comment Reply Data
  $get_data = CallAPI('GET',SITE_URL.'api/comment/read?method=getAllAcceptedReplyInBlog&blog_id='.$_GET['id'].'&comment_id=1', false);
  $response = json_decode($get_data, true);

  $reply_error = $response['error'];
  $reply_data = $response['data'];
  $reply_message = $response['message'];
  
  // Number of Comment in Blog Data
  $get_data = CallAPI('GET',SITE_URL.'api/comment/read?method=getNumberOfCommentInBlog&blog_id='.$_GET['id'], false);
  $response = json_decode($get_data, true);

  $comment_number_error = $response['error'];
  $comment_number_data = $response['data'];
  $comment_number_message = $response['message'];

  
  function renderComments($comment) {
    // Comment Reply Data
    $get_data = CallAPI('GET',SITE_URL.'api/comment/read?method=getAllAcceptedReplyInBlog&blog_id='.$_GET['id'].'&comment_id='.$comment['id'], false);
    $response = json_decode($get_data, true);

    $reply_error = $response['error'];
    $reply_data = $response['data'];
    $reply_message = $response['message'];
    ?>
    <div class="container-fluid">
      <p><?php echo $comment['name']?></p>
      <p><?php echo $comment['message']?></p>
    
    <?php
      array_map('renderReply',$reply_data);
    ?>
    </div>
    <?php
  }

  function renderReply($reply) {
    ?>
    <div class="container">
      <p><?php echo $reply['name']?></p>
      <p><?php echo $reply['message']?></p>
    </div>
    
    <?php
  }
?>

<?php renderBlogHeader($data[0])?>
<?php flashMessage()?>
<div class="container">
  <div class="row">
  <!-- Content Column -->
  <div class="col-lg-8">

    <!-- Blog content -->
    <?php echo html_entity_decode($data[0]['content'])?>
    <hr />
    <!-- User Info -->
    <div >
      <h6>Blog Writer: <?php echo $user_data[0]['username']?></h6>
      <h6>Email: <?php echo $user_data[0]['email']?></h6>
    </div>
    <hr />
    <!-- AD -->
    <h6>Advertisement</h6>
    <?php array_map('renderAd', getRandomData($adv_simple_data, 1));?>  
    <!-- Form -->
    <div class="container">
      <div class="section-row" id="ReplySection">
        <div class="section-title">
          <h2>Leave a reply</h2>
          <h6>your email address will not be published. required fields are marked *</h6>
        </div>
        <form class="form" action="../process/create-edit" method="post">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <span>Name *</span>
                <input class="form-control" type="text" name="name">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <span>Email *</span>
                <input class="form-control" type="email" name="email">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <span>Website</span>
                <input class="form-control" type="text" name="website">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <textarea class="form-control" name="message" placeholder="Message"></textarea>
              </div>
              <input type="hidden" name="commentid" id="comment_id" value="">
              <input type="hidden" name="blogid" value="<?php echo($_GET['id']) ?>">
              <input type="hidden" name="page_name" value="view">
              <button class="btn btn-primary" type="submit" name="submit" value="create">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- Comments -->
    <h4>Comments</h4>
    <?php array_map('renderComments', $comment_data);?>
  </div> 
  <!-- Content Side Column -->
  <div class="col-lg-4">
    <!-- AD -->
    <h6>Advertisement</h6>
    <?php array_map('renderAd', getRandomData($adv_wide_data, 1));?>  
    <!-- Most Popular -->
    <h6>Popular</h6>
    <?php array_map('renderMostPopular', getRandomData($popular_data, 2));?>  
    <!-- Feature Post -->
    <h6>Featured Post</h6>
    <?php array_map('renderFeaturedSide', getRandomData($featured_data, 2));?>
    <!-- Categories -->
    <h6>Category</h6>
    <?php array_map('renderCategory', $cat_data);?>
    <!-- Archive -->
    <h6>Archive</h6>
    <?php array_map('renderArchive', $archive_data);?>
  </div>
  </div>
</div>
<?php
  include '../inc/footer.php';
?>