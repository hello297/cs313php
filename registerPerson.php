<?php
	session_start();
	if (isset($_SESSION['user']))
	{
		header("Location: http://php-hello297.rhcloud.com/danceDB.php");
	}
?>
<!DOCTYPE html>

<html>
	<head>
		<title>New dancer registration</title>
		<link rel="stylesheet" type="text/css" href="theme.css"/>
	</head>
	<body>
		<h1>Register to the Marvelous Dance Database</h1>
	<?php
			if (isset($_SESSION['invalid']) && $_SESSION['invalid'])
			{
				unset($_SESSION['invalid']);
		?>
				<script>alert('Username is already taken!!!!');</script>
		<?php
			}
			else if(isset($_SESSION['nomatch']))
			{
		?>
				<script>alert("You didn't match the password!!!!");</script>
		<?php 
				unset($_SESSION['nomatch']);
			}
		?>
		<div class="register">
			<form method="post" action="registerStuff.php">
				<label>Username: </label><input type="text" name="username" class="inputField"><br>
				<label>Password: </label><input type="password" name="password" class="inputField"><br>
				<label>Confirm Password: </label><input type="password" name="confirm" class="inputField"><br>
				<label>First Name: </label><input type="text" name="first" class="inputField"><br>
				<label>Last Name: </label><input type="text" name="last" class="inputField"><br>
				<label>Gender:</label>
				<select class="inputField" name="gender">
					<option value="m">Male</option>
					<option value="f">Female</option>
				</select><br>
				<input type="submit" value="Login">
			</form>
		</div>
		
		<div class="searchBar">
			<a href="index.html">HOME</a><br>
			<a href="assignments.html">ASSIGNMENTS</a><br>
			<a href="danceLogin.php">Back to Login</a><br>
			
			<?php
				if (isset($_SESSION['user']))
				{
			?>
				<a href='danceLogin.php'>The general list</a><br>
				<a onclick='logout();' href="">Logout</a>
			<?php 
				}
			?>
		</div>
	</body>
</html>