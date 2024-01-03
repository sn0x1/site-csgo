<?php
session_start();
if (!isset($_SESSION["session_id"])) {
    echo "<p class='error'>User not logged in.</p>";
    header("Location: login.php");
    exit();
}
if(!isset($_SESSION["session_username"])):
    header("location:login.php");
else:
    include("includes/header.php");
    include("menu.php");
    ?>

    <body>
        <div id="welcome" style="width: 90%;">
            <h1 style="font-size: 1.5em;"><span>Current user information:</span></h1>
            <?php
            $query = mysqli_query($con, "SELECT * FROM usertbl WHERE id='" . $_SESSION["session_id"] . "'");
            $message = mysqli_error($con);

            foreach ($query as $row) {
                echo "<p style='font-size: 1.2em;'><strong>ID:</strong> " . $row["id"] . "</p>";
                echo "<p style='font-size: 1.2em;'><strong>Full name:</strong> " . $row["full_name"] . "</p>";
                echo "<p style='font-size: 1.2em;'><strong>Email:</strong> " . $row["email"] . "</p>";
                echo "<p style='font-size: 1.2em;'><strong>Username:</strong> " . $row["username"] . "</p>";
                if (!empty($row["user_team_name"])) {
                    echo "<p style='font-size: 1.2em;'><strong>Team:</strong> " . $row["user_team_name"] . "</p>";
                } else {
                    echo "<p style='font-size: 1.2em;'><strong>Team:</strong> No team assigned</p>";
                }
            }
            ?>
            <p><a href="logout.php">Logout</a> from system</p>
            <p></p>
        </div>

        <?php
        if (!empty($message)) {
            echo "<p class='error' style='font-size: 1.2em;'>" . "MESSAGE: " . $message . "</p>";
        }
        ?>
        <?php include("includes/footer.php"); ?>
        <?php endif; ?>