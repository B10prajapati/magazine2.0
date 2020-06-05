<?php 
  include '../config.php';
  include '../inc/header.php';
?>

<br/><br/>
<div class="d-flex justify-content-center ">
  <div style="background-color:lightsteelblue">
  <h2 class="p-3  flex-row">Login</h2>
  <?php flashMessage();?>
  <form class= "p-3   flex-row" method="post" action="../process/login" style="width:100%">
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input name='email' type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input name='password' type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="form-group form-check">
      <input name='rememberme' type="checkbox" class="form-check-input" id="rememberme">
      <label class="form-check-label" for="rememberme">Remember Me</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  </div>
</div>

<?php
include '../inc/footer.php'
?>