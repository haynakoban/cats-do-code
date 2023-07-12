<?php
if (isset($_POST["submit"])) {
    require_once "../requires/connection.req.php";
    require_once "../requires/function.req.php";

    $post_id = test_input($_POST["post_id"]);
    $post_title = test_input($_POST["title"]);
    $post_description = test_input($_POST["description"]);
    $post_created_date = date('Y-m-d H:i:s');

    if ($_FILES["fileImage"]["name"] == "") {
        if (emptyInputLogin($post_title, $post_description) !== false) {
            header("Location: ../updatepost.php?error=emptyinput");
            exit;
        } else {
            updateData($conn, $post_id, $post_title, $post_description, $post_created_date);
            header("Location: ../updatepost.php");
            exit;
        }
    } else {

        $p_image = $_FILES['fileImage']['name'];
        $temp_file = $_FILES['fileImage']['tmp_name'];
        $imageSize = $_FILES['fileImage']['size'];
        $pathImage = "";

        if (emptyInputPost($p_image, $post_title, $post_description) !== false) {
            header("Location: ../updatepost.php?error=emptyinput");
            exit;
        } else {
            $imageFileType = strtolower(pathinfo($p_image, PATHINFO_EXTENSION));

            if ($imageSize > 4050000) {
                header("Location: ../updatepost.php?error=toolargefile");
                exit;
            } else {

                $allowedFileType = array("jpg", "jpeg", "png");
                if (in_array($imageFileType, $allowedFileType)) {

                    deleteFile($conn, $post_id);

                    if ($p_image) {
                        $pathImage .= randomString(10) . '/' . $p_image;
                        mkdir(dirname($pathImage));
                        move_uploaded_file($temp_file, $pathImage);

                    } else {
                        header("Location: ../updatepost.php.php?error=emptyfile");
                        exit;
                    }

                    UpdatePostData($conn, $post_id, $pathImage, $post_title, $post_description, $post_created_date);
                    header("Location: ../updatepost.php");
                    exit;

                } else {
                    header("Location: ../updatepost.php?error=invalidfiletype");
                    exit;
                }

            }
        }
    }

} else {
    header("Location: ../updatepost.php");
    exit;
}

function deleteFile($conn, $post_id)
{
    $statement = $conn->prepare('SELECT * FROM user_posts WHERE post_id = :post_id');
    $statement->bindValue('post_id', $post_id);
    $statement->execute();
    $resultData = $statement->fetch(PDO::FETCH_ASSOC);

    $path = substr($resultData["post_image"], 14);
    unlink($path);
}
