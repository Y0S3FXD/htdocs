<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

      <ul class="navbar-nav ml-auto">
          <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
          </li>
           <li class="nav-item">
          <a class="nav-link" href="forum.php">Forum</a>
        </li>
        <?php if ($user->isLoggedIn()) : ?>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">
            <span class="glyphicon glyphicon-user"></span> Profile
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <span class="glyphicon glyphicon-log-out"></span> Logout
          </a>
        </li>
        </ul>
    <?php else : ?>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="register.php">
            <span class="glyphicon glyphicon-user"></span> Register
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">
            <span class="glyphicon glyphicon-log-in"></span> Log-in
          </a>
        </li>
      </ul>
    <?php endif; ?>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
  </div>
</nav>