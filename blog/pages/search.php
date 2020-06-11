<?php
  include '../config.php';
  $title="Magazine";
  include '../inc/header.php';
  include '../inc/navbar.php';


  
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


  if(isset($_POST['search']) && !empty($_POST['search'])) {
    // Search  Data
    $get_data = CallAPI('GET',SITE_URL.'api/blog/read?method=searchWithLimit&offset=0&no_of_data=6&search='.$_POST['search'], false);
    $response = json_decode($get_data, true);
    
    $search_error = $response['error'];
    $search_data = $response['data'];
    $search_message = $response['message'];
  } else {
    redirect('index', 'error', '');
  }
  
  // Featured BLog Data 
  $get_data = CallAPI('GET',SITE_URL.'api/blog/read?method=getAllFeaturedBlogWithLimit&offset=0&no_of_data=6', false);
  $response = json_decode($get_data, true);
          
  $error = $response['error'];
  $featured_data = $response['data'];
  $message = $response['message'];


  
 
?>



<div class="container">
 
  <div class="row">
    <!-- Content Column -->
    <div class="col-lg-8">
      <!-- Most Recent -->
      <h6>Search Result:</h6>
      <?php array_map('renderMostPopular', getRandomData($search_data, 6, false));?>  
    </div> 
    <!-- Content Side Column -->
    <div class="col-lg-4">
      
      <!-- Most Popular -->
      <h6>Popular</h6>
      <?php array_map('renderMostPopular', getRandomData($popular_data, 2));?>  
      <!-- Feature Post -->
      <h6>Featured Post</h6>
      <?php array_map('renderFeaturedSide', getRandomData($featured_data, 2));?>
      <!-- AD -->
      <h6>Advertisement</h6>
      <?php array_map('renderAd', getRandomData($adv_simple_data, 1));?>  
  
 
    </div>
  </div>

  
</div>
<?php
  include '../inc/footer.php';
?>
