<?php
	echo "just work!";
	session_start();
	include 'db.php';
	
	// Verifying the password
	$pass = $db->prepare('select * from users where username=:user');
	$pass->bindParam(':user', $_POST['username']);
	echo $_POST['username'];
	$pass->execute();
	echo "not here";
	if ($passRow = $pass->fetch())
	{
		echo "there was a match";
		echo $_POST['password'] . "<br>";
		echo		$passRow['password'] . "<br>";
		if (password_verify($_POST['password'], $passRow['password']))
		{
			echo "in the pass if";
			$_SESSION['user'] = $passRow['username'];
		}
		else
		{
			echo "wrong password";
			$_SESSION['wrong'] = true;
		}
	}
	else
	{
		echo "invalid";
		$_SESSION['invalid'] = true;
	}
	echo $_SESSION['user'];
	header("Location: " . "http://php-hello297.rhcloud.com/danceLogin.php");
?>
<!DOCTYPE html>
<html>
</html>