<?php 
  include '../config.php';
  include '../inc/header.php';
  include '../inc/navbar.php';
?>

<div class="container">
  <?php flashMessage();?>
  <form method="post" action="../process/password-change">

    <div class="form-group">
      <label for="oldpassword">Old Password</label>
      <input name='oldpassword' type="password" class="form-control" id="oldpassword">
    </div>
    <div class="form-group">
      <label for="password">New Password</label>
      <input name='password' type="password" class="form-control" id="password">
    </div>
    <div class="form-group">
      <label for="newpassword">Repeat New Password</label>
      <input name='newpassword' type="password" class="form-control" id="newpassword">
    </div>
   
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<?php
include '../inc/footer.php'
?>