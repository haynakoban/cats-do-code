<?php
if (isset($_POST["submit"])) {
    require_once "connection.req.php";
    require_once "function.req.php";

    $account_id = test_input($_POST["accountid"]);
    $acc_username = test_input($_POST["u_username"]);
    $acc_password = test_input($_POST["u_password"]);
    $first_name = test_input($_POST["firstname"]);
    $last_name = test_input($_POST["lastname"]);
    $middle_name = test_input($_POST["middlename"]);
    $age = test_input($_POST["age"]);
    $gender = test_input($_POST["gender"]);

    if (isEmptyInputTrue($acc_username, $acc_password, $first_name, $last_name, $middle_name, $age, $gender) !== false) {
        header("Location: ../viewmyprofile.php?err=emptyInput");
        exit;
    } else {
        updateMyInfo($conn, $account_id, $acc_username, $acc_password, $first_name, $middle_name, $last_name, $gender, $age);
        header("Location: ../mypost.php?succ=updateSuccess");
        exit;
    }
    exit;

} else {
    header("Location: ../viewmyprofile.php");
    exit;
}
