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
$resultData = $statement->fetch(PDO::FETCH_ASSOC);

?>
<div class="container">
    <h1 style="margin: 0; display:inline-block">Update Post (<?php echo $resultData["post_title"]; ?>)</h1>
    <img src="<?php echo $resultData["post_image"]; ?>" width="150" height="150" alt="..." style="object-fit: cover; border-radius: 50%; margin-left: 50px;">
    <a href="mypost.php" class="btn btn-primary float-end" style="border: none; outline: none; margin: 50px 50px 0 0; padding: 7px 30px;">Back</a>
    <form style="margin-top: 20px" method="post" action="./post_images/zzz.updatepost.inc.php" enctype="multipart/form-data">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <div class="mb-3">
            <label for="fileImage" class="form-label">Image</label>
            <input type="file" name="fileImage" class="form-control" id="fileImage" aria-describedby="TextHelp">
            <div id="TextHelp" class="form-text">Insert your image file here.</div>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="TextHelp" value="<?php echo $resultData["post_title"]; ?>">
            <div id="TextHelp" class="form-text">Write your title here. (No Empty Input)</div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea cols="30" rows="10" name="description" class="form-control" id="description" aria-describedby="TextHelp"><?php echo $resultData["post_description"]; ?></textarea>
            <div id="TextHelp" class="form-text">Write your description here. (No Empty Input)</div>
        </div>
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<?php include "footer.php";