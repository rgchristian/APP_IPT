<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  
<div class="container">
  
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"">
    <a class="navbar-brand" href="#"><i class="fa fa-id-card-o">&nbsp;</i>Students' Information Records</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="fa fa-database">&nbsp;</i>Students' Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user-list.php"><i class="fa fa-group">&nbsp;</i>User List</a>
        </li>

        <?php if(!isset($_SESSION['verified_user_id'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="register.php"><i class="fa fa-book">&nbsp;</i>Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php"><i class="fa fa-key">&nbsp;</i>Login</a>
        </li>
        <?php else : ?>
          <li class="nav-item dropdown">
          <?php
              $uid = $_SESSION['verified_user_id'];
              $user = $auth->getUser($uid);
          ?>
          <a class="nav-link  btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-user-circle-o">&nbsp;</i>Hello,
            <?=$user->displayName;?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="my-profile.php"><i class="fa fa-user-circle-o">&nbsp;</i>My Profile</a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out">&nbsp;</i>Logout</a></li>
          </ul>
        </li>
        <?php endif; ?>


    </div>
  </div>
</nav>