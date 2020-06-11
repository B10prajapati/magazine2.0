
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo SITE_URL.'blog/'?>">Home</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITE_URL.'blog/'?>">View Website</a>
            </li>
            
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="<?php echo SITE_URL.'blog/'?>">Magazine</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item m-2 ">
            <form action="../pages/search.php" method="POST">
              <input type="text" name="search" placeholder="Search..">
            </form>
          </li>
        
        </ul>
    </div>
</nav>
