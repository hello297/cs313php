<?php 
	session_start();
	if (!isset($_SESSION['user']))
	{
		header("Location: danceLogin.php");
	}
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
				
				$passCheck = false;
				$userCheck = false;
				
				include 'db.php';
				
				if (isset($_POST['username']))
				{
					$_SESSION['user'] = $_POST['username'];
				}
				
				
				$query = $db->prepare('select * from learned_moves inner join moves on (moves.id = learned_moves.move_id and learned_moves.user_id = :user)');
				$query->bindParam(':user', $_SESSION['user']);
				$query->execute();
				
				echo "<h2>{$_SESSION['user']}'s List</h2>";
				
				if (!$row = $query->fetch())
				{
					echo "You have no moves registered";
				}
				else
				{
					displayEntry($row);
				}
				
				while($row = $query->fetch())
				{
					displayEntry($row);
				}
			?>
		</div>
		<div class="searchBar">
			<a href="index.html">HOME</a><br>
			<a href="assignments.html">ASSIGNMENTS</a><br><?php
				if (isset($_SESSION['user']))
				{
			?>
				<a href='danceLogin.php'>The general list</a><br>
				<a onclick='logout();' href="">Logout</a>
			<?php 
				}
			?><br><br>
			<strong>Search</strong><br>
			<form action="javascript:void(0);">
				<input type="text" placeholder="Search" id="search" onKeyPress="if (event.which == 13) update('users');">
				<br><input type="button" value="Search" onclick="update('users');">
				<br><br>
				<strong>Register a new move</strong><br>
				<input style="width:184px" type="text" id="name" placeholder="*Move name" onKeyPress="if (event.which == 13) register();" name="moveName"><br>
				<textarea style="width:182px" rows="6" cols="21" id="desc" placeholder="*Enter Description"></textarea><br>
				Youtube code: 
				<input style="width:85px; float: right" type="text" id="code" placeholder="F5_z5TbG2y8" maxlength="11" name="link"><br>
				<span style="float: left">Start Time: </span><input id="start" style="width:85px; float:right" type='text'><br>
				<span style="float: left">End Time: </span><input id="end" class="inputField" type='text'><br><br>
				*Style: <select id="style">
					<option value="Lindy Hop">Lindy Hop</option>
					<option value="Charleston">Charleston</option>
					<option value="Blues">Blues</option>
				</select><br>
				<label>Coolness: </label><input type="range" value="1" min="1" max="9" id="coolness" onchange="display(this.id)"/>
				<span style="width: 20px" id="coolnessLabel"> </span><br>
				<label>Hardness: </label><input type="range" value="1" min="1" max="9" id="hardness"onchange="display(this.id)"/>
				<span style="width: 20px" id="hardnessLabel"> </span><br>
				<input type="button" value="Submit" onclick="register()">
			</form>
			
		</div>
	</body>
</html>