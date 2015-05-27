<!DOCTYPE html>
<html>
	<head>
		<title>The Marvelous Dance Database</title>
		<link rel="stylesheet" type="text/css" href="theme.css"/>
	</head>
	<body>
		<h1>The Marvelous Dance Database</h1>
		<form method="POST" action="danceDB.php">
			<label>Username: </label><input type="text" name="username"/> <br/>
			<label>Password: </label> <input type="password" name="password"/><br/>
			<input type="submit" value="Login"/>
		</form>
		<?php
			$message = "Type your username and password to login <br/>";
			$passCheck = false;
			$userCheck = false;
			$db = new PDO('mysql:host=localhost; dbname=dance; charset=utf8', 'php', 'php-pass');
			
			if (!empty($_POST['username']))
			{
				$userCheck = true;
				if (!empty($_POST['password']))
				{
					$passCheck = true;
					$user = $_POST['username'];
					$pass = $_POST['password'];
					
					
					$userDB = $db->prepare("SELECT * FROM users WHERE username = :user AND password = :pass");
					
					$userDB->bindParam(':user', $user);
					$userDB->bindParam(':pass', $pass);	
					$userDB->execute();
					
					$rows = $userDB->fetch(PDO::FETCH_NUM);
					if ($rows > 0)
					{
						echo "<h2>$user's List</h2>";
						foreach($db->query("SELECT * FROM learned_moves WHERE user_id = '$user'") as $row)
						{
							$moveID = $row['move_id'];
							foreach($db->query("SELECT * FROM moves WHERE id = '$moveID'") as $moveRow)
							{
								echo $moveRow['move_name'] . '<br/><iframe width="320" height="195" src="https://www.youtube.com/embed/' . $moveRow['link_code'] . '" frameborder="0" allowfullscreen></iframe><br/>'. $moveRow['comment'] . '<br/>' . $moveRow['style'] . "<br/>";
							}
							echo "coolness: " . $row['coolness'] . '<br/>hardness: ' . $row['hardness'] . "<br/><br/>";
						}
					}
					else
					{
						$passCheck = false;
						echo "<script>alert('Type a valid username and password combination');</script>";
					}
				}
				else
				{
					$passCheck = false;
					$message = "Enter a password<br/>";
				}
			}
			else 
			{
				$userCheck = false;
				$message = "Enter a username <br/>";
			}
			
			if (!$passCheck || !$userCheck)
			{
				echo $message;
				echo "<h2>The General List</h2>";
				foreach($db->query("SELECT * FROM moves") as $moveRow)
				{
					echo $moveRow['move_name'] . '<br/><iframe width="320" height="195" src="https://www.youtube.com/embed/' . $moveRow['link_code'] . '" frameborder="0" allowfullscreen></iframe><br/>'. $moveRow['comment'] . '<br/>' . $moveRow['style'] . "<br/>";
				}
			}
		?>
		
		<span class="footer" ><a href="index.html">HOME</a><span>
	</body>
</html>