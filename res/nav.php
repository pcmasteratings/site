<!-- Navbar -->

<nav class="navbar navbar-default">
  <div class="container-fluid">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="padding: 2px;" href="/"><img src="/img/logo.png" height="100%" alt="PCMRatings Glorious!" /></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
          <li><a href="/">Home</a></li>
          <?php
            if(Auth::checkIfAuthenticated()) {
                $user = Auth::getCurrentUser();
                echo '<li><a href="?logout=1"><b>Log Out '.$user->getUsername().'</b></a></li>';
            } else {
                echo '<li><a href="auth.php">Login</a></li>';
            }
          ?>
          <div class='container'>
            <form action='search.php' method='post'> <!-- Submit search -->
              <div class='input-group'>
                <span class='input-group-btn'>
                  <button name='btnSearch' type='submit' class='btn btn-success' aria-label='Left Align'>
                    <span class='glyphicon glyphicon-search' aria-hidden='true'></span> Search
                  </button>
                </span>
                <input name='txtSearch' type='text' class='form-control' value='<?php if(isset($_POST['txtSearch'])) echo $_POST['txtSearch']; ?>' placeholder='e.g. Deus Ex: Invisible War'>
              </div>
            </form>
          </div>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </div>
</nav>
