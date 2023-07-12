<?php include "header.php";?>
<?php
require_once "./requires/connection.req.php";
$post_id = "";
if (empty($_POST["post_id"])) {
    header("Location: ./findblogs.php");
} else {
    $post_id = (int) $_POST["post_id"];

    $statement = $conn->prepare("SELECT post_id, post_image, post_title, post_description, post_created_date, acc_username, first_name FROM user_posts, user_account WHERE user_posts.post_id = ? AND user_posts.account_id = user_account.account_id");
    $statement->bindValue(1, $post_id, PDO::PARAM_INT);
    $statement->execute();
    $resultData = $statement->fetch(PDO::FETCH_ASSOC);
}
?>

<div style="margin: 20px auto 0; padding: 10px 75px; display:flex; align-items: center; justify-content: space-between;" class="container">
    <h1 style="margin: 0; display:inline-block">Posted by <?php echo $resultData['first_name']; ?> (<?php echo $resultData['acc_username']; ?>)</h1>
    <div class="btn-forms">
            <a href="findblogs.php" class="btn btn-primary" style="border: none; outline: none;">Back</a>
    </div>
</div>
    <div class="container" style="padding: 0; height: 70vh; display: flex; box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.2),
            5px 5px 0px rgba(0, 0, 0, 0.15);">
        <div class="cont-img">
            <img src="<?php echo $resultData["post_image"]; ?>" alt="..." class="image-view-edit">
        </div>
        <div class="card-body m-3" style="text-align: left; display:flex; flex-direction: column; justify-content: center;">
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $resultData["post_created_date"]; ?></h6>
                <h2 class="card-title"><?php echo $resultData["post_title"]; ?></h2>
                <p class="card-text">
                    <?php echo $resultData["post_description"]; ?>
                </p>
                <hr />
                <div class="float-start">
                    <i class="fas fa-comment fa-fw"></i>
                        896
                    <i class="fas fa-eye fa-fw ms-3"></i>
                        5648
                    <div class="float-end">
                        <i class="fas fa-share-alt fa-fw"></i>
                    </div>
                </div>
        </div>
    </div>

<?php include "footer.php";