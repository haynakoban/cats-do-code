<?php
if (isset($_POST["signup"]) and isset($_POST["gender"])) {
    require_once "connection.req.php";
    require_once "function.req.php";

    $first_name = test_input($_POST["firstname"]);
    $age = test_input($_POST["age"]);
    $gender = test_input($_POST["gender"]);
    $middle_name = test_input($_POST["middlename"]);
    $last_name = test_input($_POST["lastname"]);
    $su_username = test_input($_POST["su_username"]);
    $su_password = test_input($_POST["su_password"]);
    $p_date = date('Y-m-d H:i:s');

    if (emptyUserInput($first_name, $age, $middle_name, $last_name, $su_username, $su_password) !== false) {
        header("Location: ../signup.php?err=emptyfield");
        exit;
    }

    if (userExists($conn, $su_username) === false) {
        header("Location: ../signup.php?err=userexist");
        exit;
    } else {

        $statement = $conn->prepare("INSERT INTO user_account(acc_username, acc_password, first_name, middle_name, last_name, gender, age, acc_created_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bindValue(1, $su_username, PDO::PARAM_STR);
        $statement->bindValue(2, $su_password, PDO::PARAM_STR);
        $statement->bindValue(3, $first_name, PDO::PARAM_STR);
        $statement->bindValue(4, $middle_name, PDO::PARAM_STR);
        $statement->bindValue(5, $last_name, PDO::PARAM_STR);
        $statement->bindValue(6, $gender, PDO::PARAM_STR);
        $statement->bindValue(7, $age, PDO::PARAM_INT);
        $statement->bindValue(8, $p_date, PDO::PARAM_STR);
        $statement->execute();

        header("Location: ../signin.php?succ=acc_created");
    }
} else {
    header("Location: ../signup.php");
    exit;
}
