<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="Login_v1/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/css/util.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/css/main.css">

</head>
<body>

<?php
require('db.php');
if (isset($_REQUEST['username'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $query1 ="SELECT username FROM `canditates` WHERE username='$username'";
    $result1= mysqli_query($con,$query1);
    $row1 = mysqli_fetch_array($result1);
    if($row1)
	{
		echo"<script>
		alert('Username already exist');
        window.location.replace('register.php');
		</script>";
        
		
    }
    
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $query    = "INSERT INTO `canditates` (username,password) VALUES ('$username','".md5($password)."')";
    $result   = mysqli_query($con, $query);

    if ($result) {
        echo "<div class='form'>
              <script>alert('You are registered successfully');
              window.location.replace('login.php');</script>
              </div>";
    } 
}

else{
    ?>
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="Login_v1/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="" method="post" name="register">
					<span class="login100-form-title">
						Member Register
					</span>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="username" placeholder="username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" >
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Register
						</button>
					</div>


					<div class="text-center p-t-136">
						<a class="txt2" href="login.php">
							Login to your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

    <script src="Login_v1/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="Login_v1/vendor/bootstrap/js/popper.js"></script>
	<script src="Login_v1/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="Login_v1/vendor/select2/select2.min.js"></script>
	<script src="Login_v1/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="Login_v1/js/main.js"></script>
        <?php } ?>
</body>
</html>