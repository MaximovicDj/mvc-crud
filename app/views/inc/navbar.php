<nav class="navbar navbar-dark bg-dark navbar-expand-lg">

  <div class="container">

    <a href="<?php echo URLROOT ?>" class="navbar-brand text-light"><?php echo SITENAME ?></a>

    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">

      <ul class="navbar-nav">

        <li class="nav-item">
          <a href="<?php echo URLROOT ?>" class="nav-link text-light">Home</a>
        </li>
        <li class="nav-item">
          <a href="<?php echo URLROOT ?>/pages/about" class="nav-link text-light">About</a>
        </li>

      </ul>

      <ul class="navbar-nav ms-auto">

        <?php if(!isset($_SESSION['user_id'])): ?>

        <li class="nav-item">
          <a href="<?php echo URLROOT ?>/users/register" class="nav-link text-light">Register</a>
        </li>
        <li class="nav-item">
          <a href="<?php echo URLROOT ?>/users/login" class="nav-link text-light">Login</a>
        </li>

      <?php else: ?>

        <li class="nav-item">
          <a href="<?php echo URLROOT ?>/posts/index" class="nav-link text-light">Posts</a>
        </li>
        <li class="nav-item">
          <a href="<?php echo URLROOT ?>/users/logout" class="nav-link text-light">Logout (<?php echo $_SESSION['email'] ?>)</a>
        </li>

      <?php endif; ?>

      </ul>

    </div>

  </div>

</nav>
