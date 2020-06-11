<?php 
  include '../config.php';
  $title = 'Contact';
  include '../inc/header.php';
  include '../inc/navbar.php';
  flashMessage();
?>
<div class="container" >
  <h3>Contact Us</h3>
  <form action="../process/contactus" method="POST">
    <div class="form-group">
      <label for="email">Email address</label>
      <input name='email' type="email" class="form-control" id="email" aria-describedby="emailHelp"/>
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="subject">Subject</label>
      <input name='subject' type="text" class="form-control" id="subject"/>
    </div>
    <div class="form-group">
      <label for="message">Mesage</label>
      <textarea name='message' type="message" class="form-control" id="message" >

      </textarea>
    </div>
    <div class="form-group">  
      <label hidden for="page_name">Page Name</label>
      <input hidden class="form-control" name="page_name" id="page_name" value="<?php echo strtolower($title)?>" />
    </div>
    <button name='submit' type="submit" class="btn btn-primary" value="create">Submit</button>
  </form>
</div>
<?php
  include '../inc/footer.php';
?>