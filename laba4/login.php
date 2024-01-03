<?php include("includes/header.php"); ?>
<body>
    <div class="container mlogin">
        <div id="login">
            <h1>Login</h1>
            <form action="" id="loginform" method="post" name="loginform">
                <p>
                    <label for="user_login">Username<br>
                        <input class="input" id="username" name="username" size="20" type="text" value="">
                    </label>
                </p>
                <p>
                    <label for="user_pass">Password<br>
                        <div style="position: relative;">
                            <input class="input" id="password" name="password" size="20" type="password" value="">
                            <span class="toggle-password" onclick="togglePasswordVisibility()">
                                <i class="fa fa-eye" id="toggleIcon"></i>
                            </span>
                        </div>
                        <input class="button" name="login" type="submit" value="Login" style="margin-top: 10px;">
                    </label>
                </p>
                <p class="regtext">Not registered yet? <a href="register.php">Registration</a>!</p>
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
			session_start();
			?>

			<?php require_once("includes/connection.php"); ?>
			<?php include("includes/header.php"); ?>	 
			<?php

			if(isset($_SESSION["session_username"])){
	// вывод "Session is set"; // в целях проверки
				header("Location: intropage.php");
			}

			if(isset($_POST["login"])){

				if(!empty($_POST['username']) && !empty($_POST['password'])) {
					$username=htmlspecialchars($_POST['username']);
					$password=htmlspecialchars($_POST['password']);
					$query = mysqli_query($con, "SELECT * FROM usertbl WHERE username='" . $username . "'");
					$numrows=mysqli_num_rows($query);
					if($numrows!=0)
					{
						while($row=mysqli_fetch_assoc($query))
						{
                            $dbSessionId=$row['id'];
							$dbusername=$row['username'];
							$dbpassword=$row['password'];
						}
						if ($username == $dbusername && password_verify($password, $dbpassword))
						{
							$_SESSION['session_username']=$username;	
							$_SESSION['session_id'] = $dbSessionId; 
							/* Перенаправление браузера */
							header("Location: intropage.php");
						}
					} else {

						echo  "Invalid username or password!";
					}
				} else {
					$message = "All fields are required!";
				}
			}
			?>


			<?php include("includes/footer.php"); ?>