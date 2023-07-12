<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link rel="shortcut icon" href="./images/logo.png" type="image/png" />
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="./styles/signin.css" />
    <link rel="stylesheet" href="./styles/about.css" />
    <link rel="stylesheet" href="./styles/signup.css" />

    <title>CatsDoCode</title>
</head>
<body>
    <!-- Navigatin Bar -->
    <nav class="navbar navbar-expand-lg navbar-light p-3">
      <div class="container">
        <a
          href="index.php"
          class="navbar-brand fw-bold justify-content-start col-sm"
        >
          <img src="./images/logo.png" alt="CatsDoCode-logo" width="80rem" />
          CatsDoCode
        </a>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navmenu"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">
          <ul class="navbar-nav justify-content-center col-sm">
            <li class="nav-item px-2">
              <a href="index.php" class="nav-link nav-b-code"> Home </a>
            </li>
            <li class="nav-item px-2">
              <a href="devabout.php" class="nav-link nav-b-code"> About </a>
            </li>
            <li class="nav-item px-2">
              <a href="findblogs.php" class="nav-link nav-b-code"> Find Blogs </a>
            </li>
            <?php
if (isset($_SESSION["userData"])) {
    echo '<li class="nav-item px-2">';
    echo '<a href="mypost.php" class="nav-link nav-b-code"> My Post </a>';
    echo '</li>';
} else {
    echo '<li class="nav-item px-2">';
    echo '<a href="signin.php" class="nav-link nav-b-code"> My Post </a>';
    echo '</li>';
}
?>
          </ul>
          <ul class="navbar-nav justify-content-end col-sm">
            <?php
if (isset($_SESSION["userData"])) {?>
      <li class="nav-item px-2">
      <a href="viewmyprofile.php" class="nav-link nav-b-code"><?php echo $_SESSION["userData"]; ?></a>
      </li>
<?php
echo '<li class="nav-item px-1">';
    echo '<a href="./requires/logout.req.php" id="login" class="nav-link bg-secondary text-light px-4 nav-button"';
    echo '>Log Out</a';
    echo '>';
    echo '</li>';
} else { ?>
    <li class="nav-item px-2">
    <a href="signup.php" class="nav-link nav-b-code">Sign Up</a>
    </li>
<?php
echo '<li class="nav-item px-1">';
    echo '<a href="signin.php" id="login" class="nav-link bg-primary text-light px-4 nav-button"';
    echo '>Log In</a';
    echo '>';
    echo '</li>';
}
?>
          </ul>
        </div>
      </div>
    </nav>
