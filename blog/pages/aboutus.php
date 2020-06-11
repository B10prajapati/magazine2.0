				


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
     
						<div class="row">
							<p>Lorem ipsum dolor sit amet, ea eos tibique expetendis, tollit viderer ne nam. No ponderum accommodare eam, purto nominavi cum ea, sit no dolores tractatos. Scripta principes quaerendum ex has, ea mei omnes eruditi. Nec ex nulla mandamus, quot omnesque mel et. Amet habemus ancillae id eum, justo dignissim mei ea, vix ei tantas aliquid. Cu laudem impetus conclusionemque nec, velit erant persius te mel. Ut eum verterem perpetua scribentur.</p>
							<figure class="figure-img">
								<img width="100%" src="https://picsum.photos/id/237/800/600" alt="">
							</figure>
							<p>Vix mollis admodum ei, vis legimus voluptatum ut, vis reprimique efficiendi sadipscing ut. Eam ex animal assueverit consectetuer, et nominati maluisset repudiare nec. Rebum aperiam vis ne, ex summo aliquando dissentiunt vim. Quo ut cibo docendi. Suscipit indoctum ne quo, ne solet offendit hendrerit nec. Case malorum evertitur ei vel.</p>
						</div>
						<div class="row ">
							<div class="col-lg-6">
								<figure class="figure-img">
									<img  width="100%"  src="https://picsum.photos/id/237/800/600" alt="">
								</figure>
							</div>
							<div class="col-lg-6">
								<h3>Our Mission</h3>
								<p>Id usu mutat debet tempor, fugit omnesque posidonium nec ei. An assum labitur ocurreret qui, eam aliquid ornatus tibique ut.</p>
								<ul class="list-style">
									<li><p>Vix mollis admodum ei, vis legimus voluptatum ut.</p></li>
									<li><p>Cu cum alia vide malis. Vel aliquid facilis adolescens.</p></li>
									<li><p>Laudem rationibus vim id. Te per illum ornatus.</p></li>
								</ul>
							</div>
						</div>
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
