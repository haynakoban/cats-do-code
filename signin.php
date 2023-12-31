<?php include "header.php";?>

<?php
$user_id = "";
if (!empty($_SESSION["accountID"])) {
    header("Location: ./mypost.php");
}
?>
    <main class="form-signin">
      <form method="post" action="./requires/signin.req.php">
        <div class="top-section">
          <img
            class="mb-4"
            src="./images/logo.png"
            alt=""
            width="72"
            height="57"
          />
          <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        </div>
        <div class="form-floating">
          <input
            type="text"
            class="form-control"
            id="floatingInput"
            placeholder="Username"
            name="u_username"
          />
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
          <input
            type="password"
            class="form-control"
            id="floatingPassword"
            placeholder="Password"
            name="u_password"
          />
          <label for="floatingPassword">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">
          Sign in
        </button>
      </form>
    </main>

<?php include "footer.php";?>