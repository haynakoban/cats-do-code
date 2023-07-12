<?php include "header.php";?>
<?php
require_once "./requires/connection.req.php";
require_once "./requires/function.req.php";

if (empty($_SESSION["accountID"])) {
    header("Location: ./signin.php");
    exit;
} else {
    $id = $_SESSION["accountID"];
    if (postExist($conn, $id) === true) {
        $statement = $conn->prepare("SELECT * FROM user_account WHERE account_id = ?");
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();
        $resultData = $statement->fetch(PDO::FETCH_ASSOC);
        $is_post_exist = false;
    } else {

        $statement = $conn->prepare("SELECT A.account_id, acc_username, acc_password, first_name, middle_name, last_name, gender, age, acc_created_date, COUNT(P.account_id) AS total_post FROM user_posts AS P, user_account AS A WHERE P.account_id = ? && A.account_id = P.account_id GROUP BY account_id");
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();
        $resultData = $statement->fetch(PDO::FETCH_ASSOC);
        $is_post_exist = true;
    }
}
?>

<div class="container">
    <h1 style="margin: 0 0 25px 0; text-align: center;">Edit Profile</h1>
    <div class="container edit_my_profile">
        <div class="left-part-profile">
            <div style="padding: 0 50px; width: 100%; height: 150px;">
                <h1 style="margin: 0 0 25px 0;"><?php echo $resultData["acc_username"] ?></h1>
                <h5 class="nav-b-code">POST: <?php if (!$is_post_exist) {echo 0;} else {echo $resultData["total_post"];}?></h5>
                <p class="card-text float-end"><small class="text-muted">Account Created Date : <?php echo $resultData["acc_created_date"] ?></small></p>
            </div>
            <form action="./requires/updatemyinfo.req.php" method="post">
            <input type="hidden" name="accountid" value="<?php echo $id; ?>">
                <div class="two_per_row">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="floatingUserName"
                            placeholder="User Name"
                            name="u_username"
                            value="<?php echo $resultData["acc_username"] ?>"
                        />
                        <label for="floatingUserName">User Name</label>
                        <div id="TextHelp" class="form-text padding-left-desc">Edit your user name here.</div>
                    </div>
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="floatingPassword"
                            placeholder="Password"
                            name="u_password"
                            value="<?php echo $resultData["acc_password"] ?>"
                        />
                        <label for="floatingPassword">Password</label>
                        <div id="TextHelp" class="form-text padding-left-desc">Edit your password here.</div>
                    </div>
                </div>
                <div class="two_per_row">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="floatingFirstName"
                            placeholder="First Name"
                            name="firstname"
                            value="<?php echo $resultData["first_name"] ?>"
                        />
                        <label for="floatingFirstName">First Name</label>
                        <div id="TextHelp" class="form-text padding-left-desc">Edit your first name here.</div>
                    </div>
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="floatingLastName"
                            placeholder="Last Name"
                            name="lastname"
                            value="<?php echo $resultData["last_name"] ?>"
                        />
                        <label for="floatingLastName">Last Name</label>
                        <div id="TextHelp" class="form-text padding-left-desc">Edit your last name here.</div>
                    </div>
                </div>
                <div class="two_per_row">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="floatingMiddleName"
                            placeholder="Middle Name"
                            name="middlename"
                            value="<?php echo $resultData["middle_name"] ?>"
                        />
                        <label for="floatingMiddleName">Middle Name</label>
                        <div id="TextHelp" class="form-text padding-left-desc">Edit your middle name here.</div>
                    </div>
                    <div class="form-floating">
                        <input
                            type="number"
                            class="form-control"
                            id="floatingAge"
                            placeholder="Age"
                            name="age"
                            value="<?php echo $resultData["age"] ?>"
                        />
                        <label for="floatingAge">Age</label>
                        <div id="TextHelp" class="form-text padding-left-desc">Edit your age here.</div>
                    </div>
                </div>
                <div class="two_per_row">
                    <div class="gender_per_row">
                        <p>Gender:</p>
                        <div>
                            <div>
                                <input
                                    type="radio"
                                    class="gender"
                                    id="floatingGenderMale"
                                    placeholder="Male"
                                    name="gender"
                                    value="Male"
                                    <?php if (isset($resultData["gender"]) && $resultData["gender"] === "Male") {
    echo "checked";
}
?>


                                />
                                <label for="floatingGenderMale" >Male</label>
                            </div>
                            <div>
                                <input
                                    type="radio"
                                    class="gender"
                                    id="floatingGenderFemale"
                                    placeholder="Female"
                                    name="gender"
                                    value="Female"
                                    <?php if (isset($resultData["gender"]) && $resultData["gender"] === "Female") {
    echo "checked";
}
?>
                                />
                                <label for="floatingGenderFemale" >Female</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button name="submit" type="submit" class="btn btn-success d-flex justify-content-center" style="margin: auto; padding: 6px 15px;">Update</button>
            </form>
        </div>
        <div class="right-part-profile">
            <img src="./images/sign-up.png" alt="..." width="600" height="560" style="margin:50px 0 0 20px; object-fit:cover;">
        </div>
    </div>
</div>

<?php include "footer.php";?>
