<?php include "header.php";?>

<?php
$user_id = "";
if (empty($_SESSION["accountID"])) {
    header("Location: ./signin.php");
} else {
    $user_id = $_SESSION["accountID"];
}
?>
<div class="container">
    <h1 style="margin: 0; display:inline-block">Write New Post</h1>
    <form style="margin-top: 20px" method="post" action="./post_images/zzz.uploadpost.inc.php" enctype="multipart/form-data">
        <input type="hidden" name="accountid" value="<?php echo $user_id; ?>">
        <div class="mb-3">
            <label for="fileImage" class="form-label">Image</label>
            <input type="file" name="fileImage" class="form-control" id="fileImage" aria-describedby="TextHelp">
            <div id="TextHelp" class="form-text">Insert your image file here. (No Empty Input)</div>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="TextHelp">
            <div id="TextHelp" class="form-text">Write your title here. (No Empty Input)</div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea cols="30" rows="10" name="description" class="form-control" id="description" aria-describedby="TextHelp"></textarea>
            <div id="TextHelp" class="form-text">Write your description here. (No Empty Input)</div>
        </div>
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include "footer.php";?>