<?php

if (isset($_POST["submit"]) && isset($_FILES["fileImage"])) {
    require_once "../requires/connection.req.php";
    require_once "../requires/function.req.php";

    $pathImage = "";
    $p_account_id = test_input($_POST["accountid"]);
    $p_image = test_input($_FILES['fileImage']['name'] ?? null);
    $p_title = test_input($_POST["title"]);
    $p_description = test_input($_POST["description"]);
    $p_date = date('Y-m-d H:i:s');

    $temp_file = $_FILES['fileImage']['tmp_name'];
    $imageFileType = strtolower(pathinfo($p_image, PATHINFO_EXTENSION));
    $imageSize = $_FILES['fileImage']['size'];

    if ($imageSize > 4050000) {
        header("Location: ../createpost.php?error=toolargefile");
        exit;
    } else {

        $allowedFileType = array("jpg", "jpeg", "png");
        if (in_array($imageFileType, $allowedFileType)) {

            if (emptyInputPost($p_image, $p_title, $p_description) !== false) {
                header("Location: ../createpost.php?error=emptyinput");
                exit;
            } else {
                if ($p_image) {
                    $pathImage .= randomString(10) . '/' . $p_image;
                    mkdir(dirname($pathImage));
                    move_uploaded_file($temp_file, $pathImage);

                } else {
                    header("Location: ../createpost.php?error=emptyfile");
                    exit;
                }

            }

            createPost($conn, $p_account_id, $pathImage, $p_title, $p_description, $p_date);
            header("Location: ../mypost.php");

        } else {
            header("Location: ../createpost.php?error=invalidfiletype");
            exit;
        }
    }
} else {
    header("Location: ../createpost.php");
    exit;
}
