<?php
include '../config.php';
$url='Advertisement';
include '../inc/checkLogin.php';
include '../inc/header.php';
include '../inc/navbar.php';
?>

  <div class="container  col-lg-10 col-sm-12">
    <h2><?php echo $url ?></h2>
    <?php flashMessage(); ?>
    <br/>
     <!-- Trigger the modal with a button -->
   <a class="btn btn-success btn-lg" id="myBtn">Add <?php echo$url?></a>

    <table id="advertisement" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th>Id</th>
          <th>URL</th>
          <th>Type</th>
          <th>Image</th>
          <th>Status</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $get_data = CallAPI('GET',SITE_URL.'api/advertisement/read', false);
          $response = json_decode($get_data, true);
          
          $error = $response['error'];
          $data = $response['data'];
          $message = $response['message'];
          
          function renderTableData($data) {
            global $cat_data, $url;   
            $thumbnail = '../../upload/'.strtolower($url).'/' ;
            $thumbnail = (isset($data['image']) && !empty($data['image']) && file_exists($thumbnail.$data['image'])) ? $thumbnail.$data['image'] : '../../upload/'.'noimg.jpg';
            $_SESSION['cat_id'] = $data['type'];
        
            echo '
              <tr>
                <td>'.$data['id'].'</td>
                <td>'.$data['url'].'</td>
                <td>'.$data['type'].'</td>
                <td><image src="'.$thumbnail.'"  height="100px" width="auto"/></td>
                <td>'.$data['status'].'</td>
                <td>
                  <a class="btn btn-success" href="javascript:;" onClick="edit(this);" data-info=\''.json_encode($data).'\' data-thumbnail='.$thumbnail.' >
                    Edit
                  </a>
                  <a class="btn btn-danger" href="javascript:;" onClick="deleteData(this);" data-info=\''.json_encode($data).'\'>
                    Delete
                  </a>
                </td>
              </tr>
            ';
          }

          if (!empty($data)) {
            array_map('renderTableData', $data);
          }
        
        ?>
      </tbody>
    </table>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <h4 id='modal-url'><span class="glyphicon glyphicon-lock"></span> Create <?php echo $url?></h4>
        
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form id="form" enctype="multipart/form-data" method="POST" action="../process/create-edit">
            <div class="form-group">  
              <label for="id">ID</label>
              <input class="form-control" name="id" id="id" value="Auto Assigned" disabled/>
            </div>
            <div class="form-group">  
            <label hidden for="page_name">Page Name</label>
            <input hidden class="form-control" name="page_name" id="page_name" value="<?php echo strtolower($url)?>" disabled/>
          </div>
            <div class="form-group">  
              <label for="url">url</label>
              <input class="form-control" name="url" id="url"/>
            </div>
            <div class="form-group">
              <label for="type">State</label>
              <select id="type" name="type" class="form-control">
                <option value="Simple" selected>Simple</option>
                <option value="Wide">Wide</option>
              </select>
            </div>
            
            <div class="form-group">  
              <input class="form-control" type="file" name="image" id="image" accept="image/*"></input>
            </div>
            <div class="form-group">  
              <label for="thumbnail">Thumbnail</label>
              <Image  name="thumbnail" id="thumbnail" height="100" width="auto"/>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select id="status" name="status" class="form-control">
                <option value="Active" selected>Active</option>
                <option value="Passive">Passive</option>
              </select>
            </div>
            <button type="submit" name="submit" value="create" class="btn btn-success btn-block" id="submit"><span class="glyphicon glyphicon-off"></span> Submit</button>
          </form>  
        </div>
        <div class="modal-footer">
          <button type="submit" name="cancel" value="Cancel" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
        </div>
                  
      </div>

    </div>
  </div>

 <?php
include '../inc/footer.php';
?>

<script type="text/javascript">


  $('#myBtn').click(function() {
    $('#confirm-text').remove();
    $('.form-group').removeAttr('hidden');
    $('#url').val('');
    $('#id').val('Auto Assigned');
    $('#status').val('Active');
    $('#type').val('Simple');
    $('#content').val('');
    $('#image').val('');
    $('#submit').val('create');
    $('#myModal').modal();
    $('#thumbnail').attr('src', '');

  });
 
  function edit(element) {
    var info = $(element).data('info');
    if (typeof(info) != 'object') {
      info = JSON.parse(info);
    }
    var thumbnail = $(element).data('thumbnail');

    $('#confirm-text').remove();
    $('.form-group').removeAttr('hidden');
    $('#modal-url').html('Edit advertisement');
    $('#submit').val('update');
    $('#url').val(info.url);
    $('#status').val(info.status);
    $('#featured').val(info.featured);
    $('#featured').val(info.featured);
    $('#type').val(info.type);
    $('#content').val(info.content);
   
    $('#thumbnail').attr('src', thumbnail);
    $('#image').attr('src', '');
    $('#id').val(info.id);
    $('#myModal').modal();
  }

  
  $('form').submit(function(e) {
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    });
  });

  function deleteData(element) {
    var info = $(element).data('info');
    if (typeof(info) != 'object') {
      info = JSON.parse(info);
    }
    $('#submit').before('<p id="confirm-text" >Are you sure you want to delete this?</p>')
    $('#modal-url').html('Delete Category');
    $('#submit').val('delete');
    $('#id').val(info.id);
    $('#myModal').modal();
 
    $('.form-group').attr('hidden', '');
  }

  $('#image').change(function() {
    var reader = new FileReader();

    reader.onload = function(e) {
      // get loaded data and render thumbnail
      $('#thumbnail').attr('src', e.target.result);
    }
    // read the image file as data URL
    reader.readAsDataURL(this.files[0]);
  });

</script>