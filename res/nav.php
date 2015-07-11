<!-- Navbar -->

<nav class="navbar navbar-default">
  <div class="container-fluid">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="padding: 2px;" href="/"><img src="/img/logo.png" height="100%" alt="PCMRatings Glorious!" /></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    

    <div class="collapse navbar-collapse" id="navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        <li><a href="/">Home</a></li>
        <li><a href="/about.php">About</a></li>
        <?php
          if(Auth::checkIfAuthenticated()) {
              $user = Auth::getCurrentUser();
              if($user->getAdmin()) {
                  echo '<li><a href="admin.php"><b>Admin</b></a></li>';
              }
              ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><?php echo $user->getUsername(); ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <!--<li><a href="#">Profile [N/A]</a></li>-->
                  <li><a href="?logout=1">Log Out</a></li>
                </ul>
              </li>
              <?php
          } else {
              echo '<li><a href="auth.php">Login</a></li>';
          }
        ?>
      </ul>

      <form class="navbar-form navbar-right" role="search" action="search.php" method="post">
        <div class="form-group">
          <div class="input-group">
            <input name='txtSearch' type='text' class='form-control' value='<?php if(isset($_POST['txtSearch'])) echo $_POST['txtSearch']; ?>' placeholder='e.g. Deus Ex: Invisible War'>
            <span class="input-group-btn">
              <button name='btnSearch' type='submit' class='btn btn-success' aria-label='Left Align'>
                <span class='glyphicon glyphicon-search' aria-hidden='true'></span> Search
              </button>
            </span>
          </div>
        </div>
      </form>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </div>
</nav>
