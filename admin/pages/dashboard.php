<?php
include '../config.php';
$title='Dashboard';
include '../inc/checkLogin.php';
include '../inc/header.php';
include '../inc/navbar.php';
?>
<div class="container col-lg-10 col-sm-12">
  <?php flashMessage()?>
  <h2>Welcom to Dashboard</h2>
  <p>Vivamus est odio, maximus eu cursus sit amet, sodales in risus. Donec quis ligula fermentum, placerat velit sed, vulputate nisl. Curabitur euismod gravida dolor. Nulla porta, ligula in scelerisque dignissim, ante augue pharetra sem, vel suscipit nibh dolor id dui. Curabitur ut ligula quis nisi sagittis tincidunt. Aliquam erat volutpat. Nam convallis tincidunt velit non mattis. Aenean rhoncus mi id viverra viverra. Donec pretium nibh nibh, quis interdum diam lobortis non. Donec quis dui pellentesque, placerat tellus sed, hendrerit justo. Quisque mollis, metus quis molestie tempus, odio odio fringilla enim, sed feugiat dui dolor a erat. Pellentesque pharetra blandit sem, non elementum justo vestibulum in. Ut rhoncus lobortis metus in dapibus. Nam vitae tristique risus.</p>
</div>
<?php include '../inc/footer.php';
?>