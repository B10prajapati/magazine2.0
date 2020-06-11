<?php
include '../config.php';
$title='FollowUs';
include '../inc/checkLogin.php';
include '../inc/header.php';
include '../inc/navbar.php';
?>
  <div class="container  col-lg-10 col-sm-12">
    <h2><?php echo $title ?></h2>
     <!-- Trigger the modal with a button -->
   <a class="btn btn-success btn-lg" id="myBtn">Add <?php echo$title?></a>

   <?php flashMessage(); ?>
    <table id="followus" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>image</th>
          <th>Thumbnail</th>
          <th>URL</th>
          <th>Status</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $get_data = CallAPI('GET',SITE_URL.'api/followus/read', false);
          $response = json_decode($get_data, true);
          
          $error = $response['error'];
          $data = $response['data'];
          $message = $response['message'];
          
          function renderTableData($data) {
            global $title;
            $thumbnail = '../../upload/'.strtolower($title).'/' ;
            $thumbnail = (isset($data['image']) && !empty($data['image']) && file_exists($thumbnail.$data['image'])) ? $thumbnail.$data['image'] : '../../upload/'.'noimg.jpg';
         
            echo '
              <tr>
                <td>'.$data['id'].'</td>
                <td>'.$data['followusname'].'</td>
                <td>'.$data['image'].'</td>
                <td><image src="'.$thumbnail.'"  height="100px" width="auto"/></td>
                <td>'.$data['url'].'</td>
                <td>'.$data['status'].'</td>
                <td>
                  <a class="btn btn-success" href="javascript:;" onClick="edit(this);" data-info=\''.json_encode($data).'\' data-thumbnail="'.$thumbnail.'">
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
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <h4 id='modal-title'><span class="glyphimage glyphimage-lock"></span> Create <?php echo $title?></h4>
        
          <button followusname="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
        <form id="form" role="form" method="POST" action="../process/create-edit" enctype="multipart/form-data">
          <div class="form-group">  
            <label for="id">ID</label>
            <input class="form-control" name="id" id="id" value="Auto Assigned" disabled/>
          </div>
          
          <div class="form-group">  
            <input hidden class="form-control" name="old_image" id="old_image" value="" disabled/>
          </div>
          <div class="form-group">  
            <label hidden for="page_name">Page Name</label>
            <input hidden class="form-control" name="page_name" id="page_name" value="<?php echo strtolower($title)?>" disabled/>
          </div>
          <div class="form-group">  
            <label for="followusname">Name</label>
            <input class="form-control" name="followusname" id="followusname"/>
          </div>
          <div class="form-group">  
            <label for="url">URL</label>
            <input class="form-control" name="url" id="url"/>
          </div>

        
          <div class="form-group"> 
            <label for="image">image</label>
            
            <input class="form-control" type="file" name="image" id="image" accept="image/*"></input>
          </div>
          <div class="form-group">  
            <label for="thumbnail">Thumbnail</label>
            <Image  name="thumbnail" id="thumbnail" height="100px" width="auto"/>
          </div>
          
          <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control">
              <option value="Active" selected>Active</option>
              <option value="Passive">Passive</option>
            </select>
          </div>
          <button type="submit" name="submit" value="create" class="btn btn-success btn-block" id="submit"><span class="glyphimage glyphimage-off"></span> Submit</button>
        </form>  
        </div>
        <div class="modal-footer">
          <button type="submit" name="cancel" value="Cancel" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphimage glyphimage-remove"></span> Cancel</button>
        </div>

      </div>

    </div>
  </div>

 <?php
include '../inc/footer.php';
?>

<script type="text/javascript">

  $('#followus').DataTable({
    responsive: true
  });

  $('#myBtn').click(function() {
    $('#confirm-text').remove();
    $('.form-group').removeAttr('hidden');
    $('#image').val('');
    $('#id').val('Auto Assigned');
    $('#status').val('Active');
    $('#followusname').val('Simple');
    $('#submit').val('create');
    $('#myModal').modal();

     
    $('#old_image').val('');
    $('#url').val('');
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
    $('#modal-title').html('Edit followus');
    $('#submit').val('update');
    $('#status').val(info.status);
    $('#followusname').val(info.followusname);
    $('#id').val(info.id);
    $('#myModal').modal();
    
    $('#old_image').val(info.image);
    $('#url').val(info.image);
    $('#thumbnail').attr('src', thumbnail);
   
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
    $('.form-group').attr('hidden', '');
    $('#submit').before('<p id="confirm-text" class="form-group">Are you sure you want to delete this?</p>')
    $('#modal-title').html('Delete followus');
    $('#submit').val('delete');
    $('#id').val(info.id);
    $('#myModal').modal();
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