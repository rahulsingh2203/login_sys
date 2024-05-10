<?php
$loggedIn = false;
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  $loggedIn = true;
};

echo '<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="/login_sys">iSecure</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">';

if ($loggedIn) {
  echo '
        <li class="nav-item">
          <a class="nav-link text-light" href="/login_sys/login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="/login_sys/signup.php">Signup</a>
        </li>';
}
if (!$loggedIn) {
  echo '
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="/login_sys/welcome.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="/login_sys/logout.php">Logout</a>
        </li>';
}
echo '</ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav> ';
