<?php
  // Most popular  Data
  $get_data = CallAPI('GET',SITE_URL.'api/followus/read', false);
  $response = json_decode($get_data, true);
  
  $follow_error = $response['error'];
  $follow_data = $response['data'];
  $follow_message = $response['message'];
  

?>
      <!-- Footer -->
  <footer class="footer font-small bg-dark pt-4" style="color:azure">

  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-6 mt-md-0 mt-3">

        <!-- Content -->
        <h5 class="text-uppercase">Footer Content</h5>
        <p>Here you can use rows and columns to organize your footer content.</p>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none pb-3">

      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase">Links</h5>

        <ul class="list-unstyled">
          <li>
            <a href="#!">Link 1</a>
          </li>
          <li>
            <a href="#!">Link 2</a>
          </li>
          <li>
            <a href="#!">Link 3</a>
          </li>
          <li>
            <a href="#!">Link 4</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase">Subscribe</h5>

        <form action="../process/create-edit" method="POST">
          <div class="form-group">
            <label for="email">Email address</label>
            <input name='email' type="email" class="form-control" id="email" aria-describedby="emailHelp"/>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">  
            <label hidden for="page_name">Page Name</label>
            <input hidden class="form-control" name="page_name" id="page_name" value="<?php echo strtolower($title)?>" />
          </div>
          <input type="hidden" name="api" value="subscriber">

          <button name='submit' type="submit" class="btn btn-primary" value="create">Subscribe</button>
        </form>

        <?php
        
          foreach($follow_data as $data) {
            $thumbnail = '../../upload/'.'followus'.'/' ;
            $thumbnail = (isset($data['image']) && !empty($data['image']) && file_exists($thumbnail.$data['image'])) ? $thumbnail.$data['image'] : '../../upload/'.'noimg.jpg';
         
            echo '
              <a href='.$data['url'].'>
                <image src='.$thumbnail.' height="50" width="50"/>
              </a>
            ';
          }
        ?>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
  </div>
  <!-- Copyright -->

  </footer>
  <!-- Footer -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>