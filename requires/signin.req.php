<?php
if (isset($_POST["submit"])) {
    require_once "connection.req.php";
    require_once "function.req.php";

    $u_username = test_input($_POST["u_username"]);
    $u_password = test_input($_POST["u_password"]);

    if (emptyInputLogin($u_username, $u_password) !== false) {
        header("Location: ../signin.php?error=emptyinput");
        exit;
    }

    loginUser($conn, $u_username, $u_password);

} else {
    header("Location: ../signin.php");
    exit;
}
