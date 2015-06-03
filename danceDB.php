<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>The Marvelous Dance Database</title>
		<link rel="stylesheet" type="text/css" href="theme.css"/>
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="danceSearch.js"></script>
	</head>
	<body>
		<h1>The Marvelous Dance Database</h1>
		<div  id="data">
			<?php
				$message = "Type your username and password to login <br/>";
				$passCheck = false;
				$userCheck = false;
				
				include 'db.php';
				$_SESSION['user'] = $_POST['username'];
				$query = $db->prepare('select * from learned_moves inner join moves on (moves.id = learned_moves.move_id and learned_moves.user_id = :user)');
				$query->bindParam(':user', $_SESSION['user']);
				$query->execute();
				
				echo "<h2>{$_SESSION['user']}'s List</h2>";
				
				while($row = $query->fetch())
				{
					echo "<div class='entry'>" . $row['move_name'] . '<br/><iframe width="320" height="195" src="http://www.youtube.com/embed/' . $row['link_code'] . '" frameborder="0" allowfullscreen></iframe><br/>'. $row['description'] . '<br/>' . $row['style'] . "<br/></div>";
				}
				/*
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
							$_SESSION['user'] = $user;
							echo "<h2>$user's List</h2>";
							foreach($db->query("SELECT * FROM learned_moves WHERE user_id = '$user'") as $row)
							{
								$moveID = $row['move_id'];
								foreach($db->query("SELECT * FROM moves WHERE id = '$moveID'") as $moveRow)
								{
									echo "<div class='entry'>" . $moveRow['move_name'] . '<br/><iframe width="320" height="195" src="https://www.youtube.com/embed/' . $moveRow['link_code'] . '" frameborder="0" allowfullscreen></iframe><br/>'. $moveRow['description'] . '<br/>' . $moveRow['style'] . "<br/>";
								}
								echo "coolness: " . $row['coolness'] . '<br/>hardness: ' . $row['hardness'] . "</div>";
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
					//header('Location: ' . 'danceLogin.php');
				}*/
			?>
		</div>
		<form class="searchBar" action="javascript:void(0);">
			<input type="text" placeholder="Search" id="search" onKeyPress="if (event.which == 13) update();">
			<br><input type="button" value="Search" onclick="update();">
		</form>
		
		<span class="footer" ><a href="index.html">HOME</a></span>
	</body>
</html>