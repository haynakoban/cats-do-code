<?php include "header.php";?>

<?php
require_once "./requires/connection.req.php";
$userId = "";
if (!empty($_SESSION["accountID"])) {
    $userId = $_SESSION["accountID"];
}
$statement = $conn->prepare('SELECT post_id, post_image, post_title, post_description, post_created_date, first_name FROM user_posts, user_account WHERE user_posts.account_id = user_account.account_id GROUP BY user_posts.post_id ORDER BY post_created_date DESC');
$statement->execute();
$resultData = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<div style="margin: 20px auto 0; padding: 10px 75px; display:flex; align-items: center; justify-content: space-between;" class="container">
    <?php if (!empty($resultData)) {?>
    <h1 style="margin: 0; display:inline-block">Recent Blogs</h1>
    <a href="createpost.php" class="btn btn-success" style="margin: 0;">Write Post</a>
    <?php } else {?>
    <h1 style="margin: 0; display:inline-block">No Blogs</h1>
    <a href="createpost.php" class="btn btn-success" style="margin: 0;">Write Post</a>
    <?php }?>
</div>
<div class="container" style="margin: 30px auto 200px;">
    <div class="row row-cols-auto" style="gap: 60px 30px; justify-content: space-evenly;">
<?php if (!empty($resultData)) {?>
    <?php
foreach ($resultData as $i => $value): ?>
            <form action="viewfindblogs.php" class="post" method="post" style="max-width: 352px; max-height: 500px;">
                <input type="hidden" name="post_id" value="<?php echo $value["post_id"]; ?>">
                <button name="submit" type="submit" style="border: none; outline: none; background: none;">
                <div class="card mx-3" style="width: 20rem; box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.2),
          5px 5px 0px rgba(0, 0, 0, 0.15);">
                    <img
                    src="<?php echo $value["post_image"] ?>"
                    class="card-img-top"
                    alt="..."
                    width="100%"
                    height="200"
                    style="object-fit: cover;"
                    />
                    <div class="card-body m-3" style="text-align: left;">
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $value["post_created_date"]; ?>  (<?php echo $value["first_name"] ?>)</h6>
                        <h2 class="card-title" style="max-height: 80px; overflow: hidden;"><?php echo $value["post_title"]; ?></h2>
                        <p class="card-text" style="max-height: 90px; overflow: hidden;">
                        <?php echo $value["post_description"]; ?>
                        </p>
                        <hr />
                        <div class="float-start">
                            <i class="fas fa-comment fa-fw"></i>
                            896
                            <i class="fas fa-eye fa-fw ms-3"></i>
                            5648
                        </div>
                        <div class="float-end">
                            <i class="fas fa-share-alt fa-fw"></i>
                        </div>
                    </div>
                </div>
                </button>
            </form>
        <?php endforeach;?>
        <?php }?>
    </div>
</div>

<?php include "footer.php";?>