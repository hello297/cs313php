<?php
	session_start();	
	if (isset($_SESSION['user']))
	{
		header("Location: http://examples-hello297.rhcloud.com/danceLogin.php");
	}
	
	include 'db.php';
	unset($_SESSION['invalid']);
	$statement = $db->prepare('select * from users where username = :user');
	$statement->bindParam(':user', $_POST['username']);
	echo $_POST['username'];
	$statement->execute();

	if (!$row = $statement->fetch())
	{
		if ($_POST['password'] == $_POST['confirm'])
		{
			echo "password";
			$password_hash = $_POST['password'];
			//$password_hash  = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$statements = $db->prepare('Insert into users (username, password, first_name, last_name, gender) values (:username, :password, :first, :last, :gender)');
			$statements->bindParam(':password', $password_hash);
			$statements->bindParam(':username', $_POST['username']);
			$statements->bindParam(':first', $_POST['first']);
			$statements->bindParam(':last', $_POST['last']);
			$statements->bindParam(':gender', $_POST['gender']);
			$statements->execute();
			$_SESSION['user'] = $_POST['username'];
			header("Location: http://examples-hello297.rhcloud.com/danceLogin.php");
		}
		else
		{
			$_SESSION['nomatch'] = true;
			header("Location: http://examples-hello297.rhcloud.com/registerPerson.php");
		}
	}
	else 
	{
		$_SESSION['invalid'] = true;
		header("Location: http://examples-hello297.rhcloud.com/registerPerson.php");
	}
	header("Location: http://examples-hello297.rhcloud.com/danceLogin.php");
?>
