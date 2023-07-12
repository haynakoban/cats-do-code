<?php include "header.php";?>
<?php
if (!empty($_SESSION["userData"])) {
    header("Location: ./mypost.php");
}
?>

<div class="container">
      <h1 class="display-5 fw-bolder pt-5" style="color: indigo">Sign Up</h1>
      <p class="card-text margin_left_signup"><small class="text-muted">Fill the form: do not leave an empty input otherwise we can't sign you up.</small></p>
      <main class="d-flex justify-content-between align-items-end .sign_up_main">
        <form method="post" class="sign_up_form" action="./requires/signup.req.php">
          <div class="first-row d-flex">
            <div class="input-group sign_up_in_form col-2" id="firstname">
              <label for="firstname">Firstname</label>
              <input type="text" name="firstname" id="firstname" />
            </div>
            <div class="age-gender d-flex">
              <div class="input-group sign_up_in_form col-2">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" />
              </div>
              <div class="input-group sign_up_in_form d-flex">
                <p class="me-5">Gender:</p>
                <label class="radio-inline" for="Male">
                  <input
                    class="gender"
                    type="radio"
                    name="gender"
                    id="Male"
                    value="Male"
                  />
                  Male
                </label>
                <label class="radio-inline" for="Female">
                  <input
                    class="gender"
                    type="radio"
                    name="gender"
                    id="Female"
                    value="Female"
                  />
                  Female
                </label>
              </div>
            </div>
          </div>

          <div class="m-l-name d-flex">
            <div class="input-group sign_up_in_form col-2">
              <label for="middlename">Middlename</label>
              <input type="text" name="middlename" id="middlename" />
            </div>
            <div class="input-group sign_up_in_form col-2">
              <label for="lastname">Lastname</label>
              <input type="text" name="lastname" id="lastname" />
            </div>
          </div>

          <div class="user-pass d-flex">
            <div class="input-group sign_up_in_form col-2">
              <label for="username">Username</label>
              <input type="text" name="su_username" id="username" />
            </div>
            <div class="input-group sign_up_in_form col-2">
              <label for="pass">Password</label>
              <input type="password" name="su_password" id="pass" />
            </div>
          </div>

          <div class="input-group sign_up_in_form">
            <button
              class="btn_sign_up animate__animated animate__bounce animate__delay-1s"
              type="submit"
              name="signup"
            >
              Sign up
            </button>
          </div>
        </form>
        <img
          class="
            img-fluid
            d-none d-sm-block
            w-50
            animate__animated animate__fadeIn animate__slower
          "
          src="./images/sign-up.png"
          alt="signup"
        />
      </main>

      <p>
        Already have an account?
        <a href="./signin.php" style="text-decoration: none">Sign in</a>
      </p>
    </div>

<?php include "footer.php";?>