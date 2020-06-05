<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'config/init.php';

  function renderAd($adv) {
    // Thumbnail Load
    $thumbnail = '../../upload/advertisement/' ;
    $thumbnail = (isset($adv['image']) && !empty($adv['image']) && file_exists($thumbnail.$adv['image'])) ? $thumbnail.$adv['image'] : '../../upload/'.'noimg.jpg'; 
    
    // Background added with thumbnail data
    $style = "height:300px;width: 100%;
    background-image: url(".$thumbnail.");
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow:inset 0 0 0 2000px rgba(0, 0, 0, 0.3);
    color: white;
    margin-bottom: 20px;
    ";
      ?>
    
    <a href="<?php echo $adv['url']?>">
      <div class="d-flex align-items-end" id="heading" style="<?php echo $style?>">
        <div >
          <div class=" container">
          </div>
          <div class="container" >
          </div>  
        </div>
      </div>
    </a>
    <?php
  }

  function renderCategory($category) {

    // Number of Blog in category data
    $get_data = CallAPI('GET',SITE_URL.'api/blog/read?method=getNumberOfBlogByCategory&cat_id='.$category['id'], false);
    $response = json_decode($get_data, true);

    $error = $response['error'];
    $cat = $response['data'];
    $message = $response['message'];
      ?>
    
    <div class="d-flex align-items-end">
      <div >
        <div class=" container">
          <a href="../pages/category?id=<?php echo $category['id']?>"><?php echo $category['categoryname']?> : Total Blogs : <?php echo $cat[0]['total']?></a>
        </div>
        <div class="container" >
        </div>  
      </div>
    </div>
    <?php
  }

  function renderMostPopular($blog) {
    // Thumbnail Load
    $thumbnail = '../../upload/blog/' ;
    $thumbnail = (isset($blog['image']) && !empty($blog['image']) && file_exists($thumbnail.$blog['image'])) ? $thumbnail.$blog['image'] : '../../upload/'.'noimg.jpg'; 
    
    // Background added with thumbnail data
    $style = "height:300px;width: 100%;
    background-image: url(".$thumbnail.");
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow:inset 0 0 0 2000px rgba(0, 0, 0, 0.3);
    color: white;
    margin-bottom: 20px;
    ";
      ?>
    
    <a href="view?id=<?php echo $blog['id']?>">
      <div class="d-flex align-items-end" id="heading" style="<?php echo $style?>">
        <div >
          <div class=" container">
            <h1 class="" style="color:linen"><?php echo $blog['title']?></h1>
          </div>
          <div class="container" >
            <a class="btn btn-success" style="background-color:<?php echo getColor($blog['categoryid'])?>" href="<?php echo SITE_URL.'blog/pages/category?id='.$blog['categoryid']?>"><?php echo $blog['category']?></a>
          
            <p><?php echo date("M d, Y",strtotime($blog['created_date']))?></p>
          </div>  
        </div>
      </div>
    </a>
    <?php
  }

  function renderRecent($blog) {
    // Thumbnail Load
    $thumbnail = '../../upload/blog/' ;
    $thumbnail = (isset($blog['image']) && !empty($blog['image']) && file_exists($thumbnail.$blog['image'])) ? $thumbnail.$blog['image'] : '../../upload/'.'noimg.jpg'; 
    
    // Background added with thumbnail data
    $style = "height:300px;width: 100%;
    background-image: url(".$thumbnail.");
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow:inset 0 0 0 2000px rgba(0, 0, 0, 0.3);
    color: white;
    margin-bottom: 20px;
    ";
      ?>
      <a href="view?id=<?php echo $blog['id']?>">
        <div class="col-lg-4"> 
        
          <div class="d-flex align-items-end" id="heading" style="<?php echo $style?>">
            <div >
              <div class=" container">
                <h1 class="" style="color:linen"><?php echo $blog['title']?></h1>
              </div>
              <div class="container" >
                <a class="btn btn-success" style="background-color:<?php echo getColor($blog['categoryid'])?>" href="<?php echo SITE_URL.'blog/pages/category?id='.$blog['categoryid']?>"><?php echo $blog['category']?></a>
              
                <p><?php echo date("M d, Y",strtotime($blog['created_date']))?></p>
              </div>  
            </div>
          </div>
            
        </div>
      </a>
    <?php
  }

  function renderFeatured($blog) {
    // Thumbnail Load
    $thumbnail = '../../upload/blog/' ;
    $thumbnail = (isset($blog['image']) && !empty($blog['image']) && file_exists($thumbnail.$blog['image'])) ? $thumbnail.$blog['image'] : '../../upload/'.'noimg.jpg'; 
    
    // Background added with thumbnail data
    $style = "height:300px;width: 100%;
    background-image: url(".$thumbnail.");
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow:inset 0 0 0 2000px rgba(0, 0, 0, 0.3);
    color: white;
    margin-bottom: 20px;
    ";
      ?>
    <a href="view?id=<?php echo $blog['id']?>">
      <div class="col-lg-6 col-sm-12">
        <div class="d-flex align-items-end" id="heading" style="<?php echo $style?>">
          <div >
            <div class=" container">
              <h1 class="" style="color:linen"><?php echo $blog['title']?></h1>
            </div>
            <div class="container" >
              <a class="btn btn-success" style="background-color:<?php echo getColor($blog['categoryid'])?>" href="<?php echo SITE_URL.'blog/pages/category?id='.$blog['categoryid']?>"><?php echo $blog['category']?></a>
            
              <p><?php echo date("M d, Y",strtotime($blog['created_date']))?></p>
            </div>  
          </div>
        </div>
      </div>
    </a>
    <?php
  }

  function renderFeaturedSide($blog) {
    // Thumbnail Load
    $thumbnail = '../../upload/blog/' ;
    $thumbnail = (isset($blog['image']) && !empty($blog['image']) && file_exists($thumbnail.$blog['image'])) ? $thumbnail.$blog['image'] : '../../upload/'.'noimg.jpg'; 
    
    // Background added with thumbnail data
    $style = "height:300px;width: 100%;
    background-image: url(".$thumbnail.");
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow:inset 0 0 0 2000px rgba(0, 0, 0, 0.3);
    color: white;
    margin-bottom: 20px;
    ";
      ?>
    <a href="view?id=<?php echo $blog['id']?>">
      <div class="d-flex align-items-end" id="heading" style="width:100%;<?php echo $style?>">
        <div >
          <div class=" container">
            <h1 class="" style="color:linen"><?php echo $blog['title']?></h1>
          </div>
          <div class="container" >
            <a class="btn btn-success" style="background-color:<?php echo getColor($blog['categoryid'])?>" href="<?php echo SITE_URL.'blog/pages/category?id='.$blog['categoryid']?>"><?php echo $blog['category']?></a>
          
            <p><?php echo date("M d, Y",strtotime($blog['created_date']))?></p>
          </div>  
        </div>
      </div>
    </a>
    <?php
  }

  function renderBlogHeader($blog) {
    // Thumbnail Load
    $thumbnail = '../../upload/blog/' ;
    $thumbnail = (isset($blog['image']) && !empty($blog['image']) && file_exists($thumbnail.$blog['image'])) ? $thumbnail.$blog['image'] : '../../upload/'.'noimg.jpg'; 
    
    // Background added with thumbnail data
    $style = "height:300px;width: 100%;
    background-image: url(".$thumbnail.");
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow:inset 0 0 0 2000px rgba(0, 0, 0, 0.3);
    color: white;
    margin-bottom: 20px;
    ";
      ?>
    
    <div class="d-flex align-items-end" id="heading" style="<?php echo $style?>">
      <div >
        <div class=" container">
          <h1 class="" style="color:linen"><?php echo $blog['title']?></h1>
        </div>
        <div class="container" >
          <a class="btn btn-success" style="background-color:<?php echo getColor($blog['categoryid'])?>" href="<?php echo SITE_URL.'blog/pages/category?id='.$blog['categoryid']?>"><?php echo categoryName($blog['categoryid'])?></a>
        
          <p><?php echo date("M d, Y",strtotime($blog['created_date']))?></p>
        </div>  
      </div>
    </div>
    <?php
  }

  function renderArchive($archive) {
      ?>
    
    <div class="d-flex align-items-end" >
      <div >
        <div class=" container">
          <a href="../pages/archive?date=<?php echo date("Y-m",strtotime($archive['date']))?>"><?php echo date("M Y",strtotime($archive['date']))?></a>
        </div>
        <div class="container" >
        </div>  
      </div>
    </div>
    <?php
  }

  // categoryName getter
  function categoryName($cat_id = 1) {
    global $cat_data;
    $b = array_filter($cat_data, function($cat) use($cat_id) {
      return $cat_id == $cat['id'];
    });
    return (isset($b) && !empty($b)) ? ($b[array_keys($b)[0]]['categoryname']) : 'Uncategorized';
  }

  function getRandomData(&$data, $no_of_data=2, $shuffled=true) {
    $data_select = array();
    $count = 0;
    if(isset($data) && !empty($data)){
      if(count($data) > $no_of_data) {  
        if ($shuffled)
        shuffle($data);
        while($count < $no_of_data) {
          array_push($data_select,$data[count($data)-1]);
          unset($data[count($data)-1]); 
          $count++;
        }
        return $data_select;  
      } else {
        return $data;
      }
    } else {
      return $data_select;
    }
    
    
  }

  function getColor($id) {
    $rand = array('red','azure','brown', 'blue','grey', 'purple','yellow','magenta','aqua','green');
    $color = $rand[ $id % (sizeof($rand) -1)];
    return $color; 
  }

?>