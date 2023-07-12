<?php

require_once "../requires/connection.req.php";

$post_id = "";
if (empty($_POST["post_id"])) {
    header("Location: ../mypost.php");
    exit;
} else {
    $post_id = $_POST["post_id"];

    deleteFile($conn, $post_id);

    $statement = $conn->prepare('DELETE FROM user_posts WHERE post_id = :post_id');
    $statement->bindValue(':post_id', $post_id);
    $statement->execute();

    header("Location: ../mypost.php?succ=deletePost");
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
