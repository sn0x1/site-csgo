<?php
include("includes/header.php");
session_start();
if (!isset($_SESSION["session_id"])) {
	echo "<p class='error'>User not logged in.</p>";
	header("Location: login.php");
	exit();
}
?>
<div class="container" id="welcome">
	<div id="add">
		<h1>Create new team</h1>
		<form action="" id="addform" method="post" name="addform">
				<p><label for="team_name">Team name<br>
					<input class="input" id="team_name" name="team_name"
					type="text" value=""></label></p>
					<p><label for="image_url">Logo (url)<br>
						<input class="input" id="image_url" name="image_url"
						type="text" value=""></label></p>

						<p class="submit"><input class="button_in" name="ok" type="submit" value="Ok"></p>
						<p class="submit"><input class="button_in" name="cancel" type="submit" value="Cancel"></p>
					</form>
				</div>
			</div>
			<?php
			if (isset($_POST["ok"])) {
				if (!empty($_POST['team_name']) && !empty($_POST['image_url'])) {
					$team_name = mysqli_real_escape_string($con, $_POST['team_name']);
					$image_url = mysqli_real_escape_string($con, $_POST['image_url']);
					$query = mysqli_query($con, "INSERT INTO team(team_name, image_url) VALUES ('$team_name','$image_url')");
					if ($query) {
						$user_id = $_SESSION['session_id']; 
						$update_query = mysqli_query($con, "UPDATE usertbl SET user_team_name = '$team_name' WHERE id = '$user_id'");
					} else {
						echo "<p>Failed to create team.</p>";
					}
					
				} else {
					echo "<p>All fields are required!</p>"; 
				}
				header("Location: showteams.php");
			}

			if (isset($_POST["cancel"])) {
				header("Location: showteams.php");
				exit();
			}

			if (!empty($message)) {
				echo "<p class='error'>MESSAGE: " . $message . "</p>";
			}

			include("includes/footer.php");
			?>