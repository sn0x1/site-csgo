<?php
include("includes/header.php");
session_start();
include("menu.php");

if (!isset($_SESSION["session_id"])) {
    echo "<p class='error'>User not logged in.</p>";
    header("Location: login.php");
    exit();
}
?>

<div id="welcome" style="width: 90%;">
    <h1><span>Teams:</span></h1><br>
    <div class="teams-container">
        <?php
        $query_teams = mysqli_query($con, "SELECT * FROM team");

        if (mysqli_num_rows($query_teams) > 0) {
            echo "<div class='teams-container'>";

            while ($row = mysqli_fetch_assoc($query_teams)) {
                $team_id = $row['id'];
                $team_name = $row['team_name'];
                $team_image_url = $row['image_url'];

                echo "<div class='team-tile'>";
                echo "<div class='background-image' style='background-image: url(\"$team_image_url\");'></div>"; 
                echo "<div class='content'>";
                echo "<div class='front'>";
                echo "<p>" . $team_name . "</p>";
                echo "</div>";

                echo "<div class='back'>";
                $query_players = mysqli_query($con, "SELECT nickname FROM player WHERE team_id='$team_id'");
                if (mysqli_num_rows($query_players) > 0) {
                    echo "<p>Players:</p><br>";
                    while ($player = mysqli_fetch_assoc($query_players)) {
                        echo "<li>" . $player['nickname'] . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>Players not found.</p>";
                }
                echo "</div>";

                echo "</div>"; 
                echo "</div>"; 
            }
            echo "</div>"; 
        } else {
            echo "<p>Team not found.</p>";
        }
        ?>
    </div>
</div>

<style>
    .teams-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .team-tile {
        position: relative;
        width: 250px;
        height: 250px;
        border: 2px solid transparent;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.8s;
        perspective: 1000px;
    }

    .team-tile .background-image {
        width: 150px;
        height: 150px;
        background-size: cover;
        background-position: center;
        position: absolute;
        top: 25%;
        left: 20%;
        transition: transform 0.8s, filter 0.8s;;
    }
    .team-tile:hover .background-image {
        transform: rotateY(180deg); 
        filter: blur(12px);
    }
    .team-tile .front,
    .team-tile .back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        transition: transform 0.8s, border 0.8s, border-radius 0.8s;
        padding: 20px;
        box-sizing: border-box;
        justify-content: center;
        align-items: center;
        text-align: center;
        border-radius: 10px;
        z-index: 1;
    }

    .team-tile .front {
        transform: rotateY(0deg);
        border: 2px solid #ccc;
        color: black; 
        font-size: 22px;
        text-shadow: -0.5px -0.5px 0 #888, 0.5px -0.5px 0 #888, -0.5px 0.5px 0 #888, 0.5px 0.5px 0 #888;
    }

    .team-tile .back {
        transform: rotateY(180deg);
        border: 2px solid #ccc;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: black; 
        font-size: 20px;
        text-shadow: -0.5px -0.5px 0 #888, 0.5px -0.5px 0 #888, -0.5px 0.5px 0 #888, 0.5px 0.5px 0 #888;
    }

    .team-tile:hover .front {
        transform: rotateY(-180deg);
        border: 2px solid #ccc;
    }

    .team-tile:hover .back {
        transform: rotateY(0deg);
        border: 2px solid #ccc;
    }

    .team-tile p {
        margin: 0;
    }

    <?php
    $query_image_urls = mysqli_query($con, "SELECT id, image_url FROM team");

    while ($row = mysqli_fetch_assoc($query_image_urls)) {
        $team_id = $row['id'];
        $team_image_url = $row['image_url'];

        echo ".team-tile:nth-child($team_id) .background-image {";
        echo "background-image: url('$team_image_url');";
        echo "}";
    }
    ?>
</style>

<?php
if (!empty($message)) {
    echo "<p class='error'>" . "MESSAGE: " . $message . "</p>";
}
?>

<?php include("includes/footer.php"); ?>
