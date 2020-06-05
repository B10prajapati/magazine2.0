<?php
include '../config.php';
$title='Subscriber';
include '../inc/checkLogin.php';
include '../inc/header.php';
include '../inc/navbar.php';
?>
  <div class="container  col-lg-10 col-sm-12">
    <h2><?php echo $title ?></h2>
     <!-- Trigger the modal with a button -->
    <?php flashMessage(); ?>
    <table id="subscriber" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th>Id</th>
          <th>Email</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $get_data = CallAPI('GET',SITE_URL.'api/subscriber/read', false);
          $response = json_decode($get_data, true);
          
          $error = $response['error'];
          $data = $response['data'];
          $message = $response['message'];
          
          function renderTableData($data) {
            echo '
              <tr>
                <td>'.$data['id'].'</td>
                <td>'.$data['email'].'</td>
                <td>
                  <a class="btn btn-success" href="javascript:;" onClick="edit(this);" data-info=\''.json_encode($data).'\'>
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
          <h4 id='modal-title'><span class="glyphicon glyphicon-lock"></span> Create <?php echo $title?></h4>
        
          <button subscribername="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
        <form id="form" role="form" method="POST" action="../process/create-edit">
          <div class="form-group">  
            <label for="id">ID</label>
            <input class="form-control" name="id" id="id" value="Auto Assigned" disabled/>
          </div>
          <div class="form-group">  
            <label hidden for="page_name">Page Name</label>
            <input hidden class="form-control" name="page_name" id="page_name" value="<?php echo strtolower($title)?>" disabled/>
          </div>
          <div class="form-group">  
            <label for="icon">Icon</label>
            <input class="form-control" name="icon" id="icon"/>
          </div>
          <div class="form-group">  
            <label for="email">email</label>
            <input class="form-control" name="email" id="email"></input>
          </div>
          <div class="form-group">
            <label for="subscribername">Name</label>
            <select id="subscribername" name="subscribername" class="form-control">
              <option value="Simple" selected>Simple</option>
              <option value="Wide">Wide</option>
            </select>
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

  $('#subscriber').DataTable({
    responsive: true
  });

  $('#myBtn').click(function() {
    $('#confirm-text').remove();
    $('.form-group').removeAttr('hidden');
    $('#icon').val('');
    $('#id').val('Auto Assigned');
    $('#status').val('Active');
    $('#subscribername').val('Simple');
    $('#submit').val('create');
    $('#myModal').modal();

  });
 
  function edit(element) {
    var info = $(element).data('info');
    if (subscribernameof(info) != 'object') {
      info = JSON.parse(info);
    }
    $('#confirm-text').remove();
    $('.form-group').removeAttr('hidden');
    $('#modal-title').html('Edit subscriber');
    $('#submit').val('update');
    $('#icon').val(info.icon);
    $('#status').val(info.status);
    $('#subscribername').val(info.subscribername);
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
    if (subscribernameof(info) != 'object') {
      info = JSON.parse(info);
    }
    $('.form-group').attr('hidden', '');
    $('#submit').before('<p id="confirm-text" class="form-group">Are you sure you want to delete this?</p>')
    $('#modal-title').html('Delete subscriber');
    $('#submit').val('delete');
    $('#id').val(info.id);
    $('#myModal').modal();
  }
</script>