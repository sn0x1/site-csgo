<?php

session_start();

if(!isset($_SESSION["session_username"])):
	header("location:login.php");
else:
	?>
	
	<?php include("includes/header.php"); include("menu.php");?>

		<div id="welcome" style="width: 25%">
			<h2>Welcome, <span><?php echo $_SESSION['session_username'];?></span>!</h2>
			<p><a href="logout.php">Logout</a> from system</p>
		</div>
		<?php include("includes/footer.php"); ?>

	<?php endif; ?>


