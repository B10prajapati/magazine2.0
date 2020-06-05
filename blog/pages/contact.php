<?php 
  $title = 'Contact Us';
  include '../inc/header.php';
  include '../inc/navbar.php';

?>

<div class="container">
  <form>
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
      <input name='rememberMe' type="checkbox" class="form-check-input" id="rememberMe">
      <label class="form-check-label" for="rememberMe">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<?php
  include '../inc/footer.php';
?>