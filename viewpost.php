<?php include "header.php";?>
<?php
require_once "./requires/connection.req.php";
$post_id = "";
if (empty($_POST["post_id"])) {
    header("Location: ./mypost.php");
} else {
    $post_id = $_POST["post_id"];
}
$statement = $conn->prepare('SELECT * FROM user_posts WHERE post_id = :post_id');
$statement->bindValue(':post_id', $post_id);
$statement->execute();
$resultData = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<?php if (empty($_SESSION["UserName"])) {
    header("Location: ./signin.php");
} else {?>
<div style="margin: 20px auto 0; padding: 10px 75px; display:flex; align-items: center; justify-content: space-between;" class="container">
    <h1 style="margin: 0; display:inline-block">My Post (<?php echo $_SESSION["UserName"]; ?>)</h1>
    <?php foreach ($resultData as $i => $value): ?>
    <div class="btn-forms">
        <form class="act-forms" action="updatepost.php" method="post">
            <input type="hidden" name="post_id" value="<?php echo $value["post_id"]; ?>">
            <button name="submit" type="submit" class="btn btn-success" style="border: none; outline: none;">Update Post</button>
        </form>
        <form class="act-forms" action="./post_images/zzz.deletepost.inc.php" method="post">
            <input type="hidden" name="post_id" value="<?php echo $value["post_id"]; ?>">
            <button name="submit" type="submit" class="btn btn-danger" style="border: none; outline: none;">Delete Post</button>
        </form>
    </div>
    <?php endforeach;?>
</div>
<?php foreach ($resultData as $i => $value): ?>
    <div class="container" style="padding: 0; height: 70vh; display: flex; box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.2),
            5px 5px 0px rgba(0, 0, 0, 0.15);">
        <div class="cont-img">
            <img src="<?php echo $value["post_image"]; ?>" alt="..." class="image-view-edit">
        </div>
        <div class="card-body m-3" style="text-align: left; display:flex; flex-direction: column; justify-content: center;">
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $value["post_created_date"]; ?></h6>
                <h2 class="card-title"><?php echo $value["post_title"]; ?></h2>
                <p class="card-text">
                    <?php echo $value["post_description"]; ?>
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
<?php endforeach;?>
<?php }
;?>
<?php include "footer.php";