<?php include("includes/header.php");
session_start();
$edit_id = $_SESSION['edit_id'];
$query = mysqli_query($con, "SELECT * FROM player WHERE id='$edit_id'");
foreach ($query as $row){
    $nickname = $row["nickname"];
    $first_last_name = $row["first_last_name"];
    $country = $row["country"];
    $rating = $row["rating"];
    $team_id = $row["team_id"];
    $player_id = $row['id'];

}
?>
<div class="container add" id="welcome">
    <div id="edit">
        <h1>Edit</h1>
        <form action="" id="editform" method="post" name="editform">
            <p><label for="nickname">Nickname<br>
                    <input class="input" id="nickname" name="nickname"
                           type="text" value="<?php echo htmlspecialchars($nickname) ?>">
            <p><label for="first_last_name">Full name<br>
                    <input class="input" id="desription" name="first_last_name"
                           type="first_last_name"  value="<?php echo htmlspecialchars($first_last_name)?>">
            <p><label for="country">Country<br>
                    <input class="input" id="country" name="country"
                           type="country" value="<?php echo $country?>">
            <p><label for="rating">Rating<br>
                    <input class="input" id="rating" name="rating"
                            type="rating" value="<?php echo htmlspecialchars($rating) ?>">

                </label></p>
                <label for="team_id">Team</label>
            <select class="input" id="team_id" name="team_id">
                <?php
                $query = mysqli_query($con, "SELECT team_name, id FROM team");
                foreach ($query as $row)
                    if ($row["id"] == $team_id){
                        echo "<option value=".$row["id"]." selected>" . $row['team_name'] . "</option>";
                    }else
                        echo "<option value=".$row["id"].">" . $row['team_name'] . "</option>" ?>
            </select>

            <p class="submit"><input class="button_in" name="ok" type="submit" value="Ok"></p>
            <p class="submit"><input class="button_in" name="cancel" type="submit" value="Cancel"></p>

        </form>
    </div>
</div>

<?php
if (isset($_POST["ok"])) {

    if (!empty($_POST['nickname']) && !empty($_POST['first_last_name']) && !empty($_POST['country']) && !empty($_POST['rating']) && !empty($_POST['team_id'])) {

        $nickname = mysqli_real_escape_string($con, $_POST['nickname']);
        $first_last_name = mysqli_real_escape_string($con, $_POST['first_last_name']);
        $country = mysqli_real_escape_string($con, $_POST['country']);
        $rating = mysqli_real_escape_string($con, $_POST['rating']);
        $team_id = mysqli_real_escape_string($con, $_POST['team_id']);
        $player_id = mysqli_real_escape_string($con, $_POST['player_id']);


        $query = mysqli_query($con, "UPDATE player SET nickname='$nickname', first_last_name='$first_last_name', country='$country', rating='$rating', team_id='$team_id' WHERE id='$edit_id'");
        if (mysqli_error($con)) {
            $message = "country is not available!";
        } else {
            echo "<script>location.href='showplayers.php';</script>";
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
