<?php
include '../config.php';
$title='Blog';
include '../inc/checkLogin.php';
include '../inc/header.php';
include '../inc/navbar.php';
?>

  <div class="container  col-lg-10 col-sm-12">
    <h2><?php echo $title ?></h2>
    <?php flashMessage(); ?>
    <br/>
     <!-- Trigger the modal with a button -->
   <a class="btn btn-success btn-lg" id="myBtn">Add <?php echo$title?></a>

    <table id="blog" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Content</th>
          <th>Featured</th>
          <th>Category Id</th>
          <th>Category Name</th>
          <th>View</th>
          <th>Image</th>
          <th>Status</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $get_data = CallAPI('GET',SITE_URL.'api/blog/read', false);
          $response = json_decode($get_data, true);
          
          $error = $response['error'];
          $data = $response['data'];
          $message = $response['message'];
          

          $get_data = CallAPI('GET',SITE_URL.'api/category/read', false);
          $response = json_decode($get_data, true);
          $cat_error = $response['error'];
          $cat_data = $response['data'];
          $cat_message = $response['message'];
          function categoryName() {
            global $cat_data;
            $b = array_filter($cat_data, function($data) {
                    return $_SESSION['cat_id'] == $data['id'];
                  });
            return (isset($b) && !empty($b))? ($b[array_keys($b)[0]]['categoryname']) : 'Category Does not exist';
          }
          function renderTableData($data) {
            global $cat_data, $title;   
            $thumbnail = '../../upload/'.strtolower($title).'/' ;
            $thumbnail = (isset($data['image']) && !empty($data['image']) && file_exists($thumbnail.$data['image'])) ? $thumbnail.$data['image'] : '../../upload/'.'noimg.jpg';
            $_SESSION['cat_id'] = $data['categoryid'];
            $dataJson=$data;
            $dataJson['content'] = '';
          echo '
              <tr>
                <td>'.$data['id'].'</td>
                <td>'.$data['title'].'</td>
                <td>'.substr((($data['content'])),0,100).'...'.'</td>
                <td>'.$data['featured'].'</td>
                <td>'.$data['categoryid'].'</td>
                <td>'.categoryName().'</td>
                <td>'.$data['view'].'</td>
                <td><image src="'.$thumbnail.'"  height="100px" width="auto"/></td>
                <td>'.$data['status'].'</td>
                <td>
                  <a class="btn btn-success" href="javascript:;" onClick="edit(this);" data-info=\''.json_encode($dataJson).'\' data-thumbnail='.$thumbnail.' data-content=\''.$data['content'].'\'>
                    Edit
                  </a>
                  <a class="btn btn-danger" href="javascript:;" onClick="deleteData(this);" data-info=\''.($data['id']).'\'>
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
          <h4 id='modal-title'><span class="glyphicon glyphicon-lock"></span> Create <?php echo $title?></h4>
        
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form id="form" enctype="multipart/form-data" method="POST" action="../process/create-edit">
            <div class="form-group">  
              <label for="id">ID</label>
              <input class="form-control" name="id" id="id" value="Auto Assigned" disabled/>
            </div>
            <div class="form-group">  
            <input hidden class="form-control" name="page_name" id="page_name" value="<?php echo strtolower($title)?>" disabled/>
          </div>
          <div class="form-group">  
            <input hidden class="form-control" name="old_image" id="old_image" value="" disabled/>
          </div>
            <div class="form-group">  
              <label for="title">Title</label>
              <input class="form-control" name="title" id="title"/>
            </div>
            <div class="form-group">
              <label for="featured">State</label>
              <select id="featured" name="featured" class="form-control">
                <option value="Featured" selected>Featured</option>
                <option value="notFeatured">Not Featured</option>
              </select>
            </div>
            <div class="form-group">
              <label for="categoryid">Category Id</label>
              <select id="categoryid" name="categoryid" class="form-control">
                <?php
                  function renderOption($data) {
                    echo '
                      <option value="'.$data['id'].'">'.$data['categoryname'].'</option>
                    ';
                  }
                  array_map('renderOption', $cat_data);
                ?>
              </select>
            </div>
            <div class="form-group">  
              <label for="content">Content</label>
              <textarea class="form-control" name="content" id="content" ></textarea>
            </div>
            <div class="form-group">  
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
<script src="https://cdn.ckeditor.com/ckeditor5/19.1.1/classic/ckeditor.js"></script>
<script type="text/javascript">
  
  
  $('#blog').DataTable({
    responsive: true
  });

  $('#myBtn').click(function() {
    ckeditor();
    $('#confirm-text').remove();
    $('.form-group').removeAttr('hidden');
    $('#title').val('');
    $('#id').val('Auto Assigned');
    $('#status').val('Active');
    $('#featured').val('Featured');
    $('#categoryid').val('');
    $('#content').val('');
    $('#old_image').val('');
    $('#submit').val('create');
    $('#myModal').modal();
    $('#thumbnail').attr('src', '');

  });
 
  function edit(element) {
    var info = $(element).data('info');
    if (typeof(info) != 'object') {
      console.log(info);
      info = JSON.parse(info);
    }
    var thumbnail = $(element).data('thumbnail');
    var content = $(element).data('content');

    $('#confirm-text').remove();
    $('.form-group').removeAttr('hidden');
    $('#modal-title').html('Edit Blog');
    $('#submit').val('update');
    $('#title').val(info.title);
    $('#status').val(info.status);
    $('#featured').val(info.featured);
    $('#categoryid').val(info.categoryid);
    $('#content').val(content);
    $('#old_image').val(info.image);
   
    $('#thumbnail').attr('src', thumbnail);
    $('#image').attr('src', '');
    $('#id').val(info.id);
    ckeditor(content);
    $('#myModal').modal();
  }

  function ckeditor(data=""){
      ClassicEditor
      .create( document.querySelector( '#content' ), {
        alignment: {
            options: [ 'left', 'right' ]
        },
        toolbar: [
            'heading', '|', 'bulletedList', 'numberedList', 'alignment', 'undo', 'redo'
        ]
      })
      .then( editor => {
          editor.setData(data);
      } )
      .catch( error => {
          console.error( error );
      } );
    }

  
  $('form').submit(function(e) {
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    });
  });

  function deleteData(element) {
    var info = $(element).data('info');
    
    $('#submit').before('<p id="confirm-text" >Are you sure you want to delete this?</p>')
    $('#modal-title').html('Delete Category');
    $('#submit').val('delete');
    $('#id').val(info);
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