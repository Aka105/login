<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Form</title>
  <link rel="stylesheet" href="style.css">

<!-- </head> -->
<!-- <body> -->
<!-- partial:index.partial.html -->
<!-- <!DOCTYPE html> -->
<!-- <head> -->
	<!-- <title>Slide Navbar</title> -->
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<?php
include 'dbconn.php';
if (isset($_POST['signup'])) {
	// echo "clicked";
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $emailquery = "select * from users where email='$email'";
    $query = mysqli_query($con, $emailquery);
    $emailcount = mysqli_num_rows($query);
    if ($emailcount > 0) {
        echo "Email already exists!!!";
    } else {
        if($password==$cpassword){
        $insertquery = "insert into users(username, email, password, cpassword, dt) values('$username', '$email', '$password', '$cpassword', current_timestamp())";
        $iquery = mysqli_query($con, $insertquery);
        if ($iquery) {
            // echo "Inserted Successfully";
            // header("location: login.php");
            ?>
    <script>
        alert("Registered Sucessfully");
		// document.querySelector(".login").style.transform="translateY(-500px)";
    </script>
	<style>
	.login{
	transform: translateY(-500px);
}
/* #chk{
	display: none;
} */
#chk:checked ~ .login{
	transform: translateY(-180px);
}
	</style>
    <?php
        }
    }else{
        echo "Passwords are not matching!!!";
    }
}
}
$login = "f";
if (isset($_POST['signin'])) {
    // error_reporting(0);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $sql = "select * from users where email='$email' and password='$password'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        // echo "login successful";
        header("location: dashboard.html");
    } else {
        $login = false;
        echo "Wrong Email or Password";
    }
}
?>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="" method="post">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="username" placeholder="User name" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<input type="password" name="cpassword" placeholder="Confirm Password" required="">
					<button type="signup" name="signup">Sign up</button>
				</form>
			</div>

			<div class="login">
				<form action="" method="post">
					<label for="chk" aria-hidden="true">Login</label>
					<p style="font-family: Josefin sans, sans-serif; font-weight: bold; font-size: 20px; text-align: center; margin-bottom: 55px; color: #573b8a;">Welcome Back</p>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button type="signin" name="signin">Login</button>
				</form>
				<p style="font-size: 10px; font-family: 'Lucida Sans'; padding-top: 10px; text-align: center;"><u>FORGOT PASSWORD</u></p>
			</div>
	</div>
	<div class="animation-area">
		<ul class="box-area">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</body>
<!-- </html> -->
<!-- partial -->
  
<!-- </body> -->
</html>
