<?php include("includes/header.php"); ?>
    <div class="container add" id="welcome">
        <div id="add">
            <h1>Add new player</h1>
            <form action="" id="addform" method="post" name="addform">
                <p><label for="nickname">Nickname<br>
                        <input class="input" id="nickname" name="nickname"
                               type="text" value=""></label></p>
                <p><label for="first_last_name">Full name<br>
                        <input class="input" id="desription" name="first_last_name"
                               type="first_last_name" value=""></label></p>
                <p><label for="country">Country<br>
                        <input class="input" id="country" name="country"
                               type="country" value="">
                <p><label for="rating">Rating<br>
                        <input class="input" id="rating" name="rating"
                                type="rating" value="">

                    </label></p>
                <select class="input" id="team_id" name="team_id">
                    <?php
                    $query = mysqli_query($con, "SELECT team_name, id FROM team");
                    foreach ($query as $row)
                        echo "<option value=".$row["id"].">" . $row['team_name'] . "</option>" ?>

                </select>

                <p class="submit"><input class="button_in" name="ok" type="submit" value="Ok"></p>
                <p class="submit"><input class="button_in" name="cancel" type="submit" value="Cancel"></p>

            </form>
        </div>
    </div>

<?php
if (isset($_POST["ok"])) {

if (!empty($_POST['nickname']) && !empty($_POST['first_last_name']) && !empty($_POST['country']) && !empty($_POST['team_id'])) {

    $nickname = mysqli_real_escape_string($con, $_POST['nickname']);
    $first_last_name = mysqli_real_escape_string($con, $_POST['first_last_name']);
    $country = mysqli_real_escape_string($con, $_POST['country']);
    $rating = mysqli_real_escape_string($con, filter_var($_POST['rating'], FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
    $team_id = mysqli_real_escape_string($con, $_POST['team_id']);

    $query = mysqli_query($con, "INSERT INTO player(nickname, first_last_name, country, rating, team_id) VALUES ('$nickname','$first_last_name','$country', '$rating','$team_id')");
    
    if (mysqli_error($con)) {
        $message = "Nickname is not available!";
    } else {
        header("Location: showplayers.php");
    }
    header("Location: showteams.php");
}
} else {
    $message = "All fields are required!";
}
}?>
<?php
if (isset($_POST["cancel"])) {
    header("Location: showplayers.php");
}
?>

<?php
if (!empty($message)) {
    echo "<p class='error'>" . "MESSAGE: " . $message . "</p>";
}
?>


<?php include("includes/footer.php"); ?>
