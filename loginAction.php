<?php
	session_start();
	include 'db.php';
	
	// Verifying the password
	$pass = $db->prepare('select * from users where username=:user');
	$pass->bindParam(':user', $_POST['username']);
	$pass->execute();
	if ($passRow = $pass->fetch())
	{
		if ($_POST['password'] == $passRow['password'])
		{
			$_SESSION['user'] = $passRow['username'];
		}
		else
		{
			$_SESSION['wrong'] = true;
		}
	}
	else
	{
		$_SESSION['invalid'] = true;
	}
	header("Location: " . "http://examples-hello297.rhcloud.com/danceLogin.php");
?>
