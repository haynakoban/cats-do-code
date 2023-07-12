<?php
function emptyInputLogin($u_username, $u_password)
{
    if (empty($u_username) || empty($u_password)) {
        return true;
    } else {
        return false;
    }
}

function emptyUserInput($first_name, $age, $middle_name, $last_name, $su_username, $su_password)
{
    if (empty($first_name) || empty($age) || empty($middle_name) || empty($last_name) || empty($su_username) || empty($su_password)) {
        return true;
    } else {
        return false;
    }
}

function userExists($conn, $u_username)
{
    $statement = $conn->prepare('SELECT * FROM user_account WHERE acc_username = :u_username');
    $statement->bindValue('u_username', $u_username);
    $statement->execute();

    $resultData = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (empty($resultData)) {
        return true;
    } else {
        return false;
    }

}

function uidExists($conn, $u_username)
{
    $statement = $conn->prepare('SELECT * FROM user_account WHERE acc_username = :u_username');
    $statement->bindValue('u_username', $u_username);
    $statement->execute();

    $resultData = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($row = $resultData) {
        return $row;
    } else {
        return false;
    }

}

function loginUser($conn, $u_username, $u_password)
{
    $userExist = uidExists($conn, $u_username);

    if ($userExist === false) {
        header("Location: ../signin.php?error=wrongLogin");
        exit;
    }

    $pass = $userExist[0]["acc_password"];

    if ($u_password !== $pass) {
        header("Location: ../signin.php?error=incorrectLogin");
        exit;
    } else if ($u_password === $pass) {
        session_start();
        $_SESSION["accountID"] = $userExist[0]["account_id"];
        $_SESSION["userData"] = $userExist[0]["acc_username"];
        $_SESSION["UserName"] = $userExist[0]["first_name"];
        header("Location: ../index.php");
        exit;
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function emptyInputPost($p_image, $p_title, $p_description)
{

    if (empty($p_image) || empty($p_title) || empty($p_description)) {
        return true;
    } else {
        return false;
    }
}

function isEmptyInputTrue($acc_username, $acc_password, $first_name, $last_name, $middle_name, $age, $gender)
{
    if (empty($acc_username) || empty($acc_password) || empty($first_name) || empty($last_name) || empty($middle_name) || empty($age) || empty($gender)) {
        return true;
    } else {
        return false;
    }
}

function createPost($conn, $p_account_id, $p_image, $p_title, $p_description, $p_date)
{
    $acc_id = (int) $p_account_id;
    $prePathImg = "./post_images/" . $p_image;

    $statement = $conn->prepare("INSERT INTO user_posts(account_id, post_image, post_title, post_description, post_created_date) VALUES (?, ?, ?, ?, ?)");
    $statement->bindValue(1, $acc_id, PDO::PARAM_INT);
    $statement->bindValue(2, $prePathImg, PDO::PARAM_STR);
    $statement->bindValue(3, $p_title, PDO::PARAM_STR);
    $statement->bindValue(4, $p_description, PDO::PARAM_STR);
    $statement->bindValue(5, $p_date, PDO::PARAM_STR);
    $statement->execute();

}

function randomString($n)
{
    $character = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($character) - 1);
        $str .= $character[$index];
    }

    return $str;
}

function selectData($conn, $post_id)
{
    $statement = $conn->prepare('SELECT * FROM user_posts WHERE post_id = :post_id');
    $statement->bindValue('post_id', $post_id);
    $statement->execute();
    $resultData = $statement->fetch(PDO::FETCH_ASSOC);

    return $resultData;

}

function updateData($conn, $post_id, $post_title, $post_description, $post_created_date)
{
    $data = selectData($conn, $post_id);

    $post_id = (int) $data["post_id"];
    $post_image = $data["post_image"];

    $statement = $conn->prepare("UPDATE user_posts SET post_image = ?, post_title = ?, post_description = ?, post_created_date = ? WHERE post_id = ?");
    $statement->bindValue(1, $post_image, PDO::PARAM_STR);
    $statement->bindValue(2, $post_title, PDO::PARAM_STR);
    $statement->bindValue(3, $post_description, PDO::PARAM_STR);
    $statement->bindValue(4, $post_created_date, PDO::PARAM_STR);
    $statement->bindValue(5, $post_id, PDO::PARAM_INT);
    $product = $statement->execute();

}

function updateMyInfo($conn, $account_id, $acc_username, $acc_password, $first_name, $middle_name, $last_name, $gender, $age)
{
    $int_age = (int) $age;
    $id = (int) $account_id;

    $statement = $conn->prepare("UPDATE user_account SET acc_username = ?, acc_password = ?, first_name = ?, middle_name = ?, last_name = ?,  gender = ?, age = ? WHERE account_id = ?");
    $statement->bindValue(1, $acc_username, PDO::PARAM_STR);
    $statement->bindValue(2, $acc_password, PDO::PARAM_STR);
    $statement->bindValue(3, $first_name, PDO::PARAM_STR);
    $statement->bindValue(4, $middle_name, PDO::PARAM_STR);
    $statement->bindValue(5, $last_name, PDO::PARAM_STR);
    $statement->bindValue(6, $gender, PDO::PARAM_STR);
    $statement->bindValue(7, $int_age, PDO::PARAM_INT);
    $statement->bindValue(8, $id, PDO::PARAM_INT);
    $result = $statement->execute();

}

function UpdatePostData($conn, $post_id, $files, $post_title, $post_description, $post_created_date)
{
    $r_id = (int) $post_id;
    $r_image = "./post_images/" . $files;

    $statement = $conn->prepare("UPDATE user_posts SET post_image = ?, post_title = ?, post_description = ?, post_created_date = ? WHERE post_id = ?");
    $statement->bindValue(1, $r_image, PDO::PARAM_STR);
    $statement->bindValue(2, $post_title, PDO::PARAM_STR);
    $statement->bindValue(3, $post_description, PDO::PARAM_STR);
    $statement->bindValue(4, $post_created_date, PDO::PARAM_STR);
    $statement->bindValue(5, $r_id, PDO::PARAM_INT);
    $statement->execute();

}

function postExist($conn, $id)
{

    $statement = $conn->prepare('SELECT DISTINCT account_id FROM user_posts WHERE account_id = ?');
    $statement->bindValue(1, $id, PDO::PARAM_INT);
    $statement->execute();
    $resultData = $statement->fetch(PDO::FETCH_ASSOC);

    if (empty($resultData)) {
        return true;
    } else {
        return false;
    }

}
