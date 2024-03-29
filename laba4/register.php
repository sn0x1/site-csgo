<?php include("includes/header.php"); ?>
<body>
	<div class="container mregister">
		<div id="login">
			<h1>Registration</h1>
			<form action="register.php" id="registerform" method="post" name="registerform">
				<p>
					<label for="user_login">Full name<br>
						<input class="input" id="full_name" name="full_name" size="32" type="text" value="">
					</label>
				</p>
				<p>
					<label for="user_pass">E-mail<br>
						<input class="input" id="email" name="email" size="32" type="email" value="">
					</label>
				</p>
				<p>
					<label for="user_pass">Username<br>
						<input class="input" id="username" name="username" size="20" type="text" value="">
					</label>
				</p>
				<p>
					<label for="user_pass">Password<br>
						<div style="position: relative;">
							<input class="input" id="password" name="password" size="32" type="password" value="">
							<span class="toggle-password" onclick="togglePasswordVisibility()">
								<i class="fa fa-eye" id="toggleIcon"></i>
							</span>
						</div>
					</label>
				</p>
				<p class="submit">
					<input class="button" id="register" name= "register" type="submit" value="Register">
				</p>
				<p class="regtext">Already have account? <a href= "login.php">Login</a>!</p>
			</form>
		</div>
	</div>

	<style>
		.input {
			padding-right: 30px; 
		}

		.toggle-password {
			position: absolute;
			top: 50%;
			right: 5px;
			transform: translateY(-50%);
			cursor: pointer;
		}
	</style>

	<script>
		function togglePasswordVisibility() {
			const passwordField = document.getElementById("password");
			const icon = document.getElementById("toggleIcon");

			if (passwordField.type === "password") {
				passwordField.type = "text";
				icon.classList.remove("fa-eye");
				icon.classList.add("fa-eye-slash");
			} else {
				passwordField.type = "password";
				icon.classList.remove("fa-eye-slash");
				icon.classList.add("fa-eye");
			}
		}
	</script>
					<?php
					if(isset($_POST["register"])){
						if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
							$full_name= htmlspecialchars($_POST['full_name']);
							$email=htmlspecialchars(filter_var($_POST['email']), FILTER_VALIDATE_EMAIL);
							$username=htmlspecialchars($_POST['username']);
							$password=htmlspecialchars($_POST['password']);
							$hashed_password = password_hash($password, PASSWORD_DEFAULT);
							$query=mysqli_query($con,"SELECT * FROM usertbl WHERE username='".$username."'");
							$numrows=mysqli_num_rows($query);
							if($numrows==0)
							{
								$sql="INSERT INTO usertbl
								(full_name, email, username,password)
								VALUES('$full_name','$email', '$username', '$hashed_password')";
								$result=mysqli_query($con, $sql);
								if($result){
									$message = "Account Successfully Created";
								} else {
									$message = "Failed to insert data information!";
								}
							} else {
								$message = "That username already exists! Please try another one!";
							}
						} else {
							$message = "All fields are required!";
						}
					}
					?>

					<?php if (!empty($message)) {echo "<p class='error'>" . "MESSAGE: ". $message . "</p>";} ?>

					<?php include("includes/footer.php"); ?>

