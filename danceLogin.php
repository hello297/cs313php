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
		<?php
			if (isset($_SESSION['wrong']))
			{
				unset($_SESSION['wrong']);
		?>	
			<script>alert('You entered an incorrect password');</script>
		<?php	
			}
			if (isset($_SESSION['invalid']))
			{
				unset($_SESSION['invalid']);
		?>
				<script>alert('You entered an incorrect username');</script>
		<?php
			}				
		?>
		<h1>The Marvelous Dance Database</h1>
		<?php
			if (!isset($_SESSION['user']))
			{
		?>
		<form class="register" method="POST" action="loginAction.php">
			<label>Username: </label><input type="text" value="guest" name="username"/> <br/>
			<label>Password: </label> <input type="password" value="1234" name="password"/><br/>
			<input type="submit" value="Login"/>
		</form>
		<?php 
			}
			else
			{
				echo "Welcome {$_SESSION['user']}<br>";
			}
		?>
		<div id="data">
			<?php
				include 'db.php';
				
				echo "<h2>The General List</h2>";
				
				foreach($db->query("SELECT * FROM moves") as $moveRow)
				{
					echo "<div class='entry'>" . "<strong>" . $moveRow['move_name'] . '</strong>';
					if (isset($_SESSION['user']))
					{
						echo '<input type="button" value="Add to my list" style="float:right" id="' . $moveRow['id'] . '" onclick="add(this.id)">';
					}
					echo "<br/><br/>";
					if (isset($moveRow['link_code']))
					{
						echo '<iframe width="320" height="195" src="http://www.youtube.com/embed/' . $moveRow['link_code'] . 
						"?start={$moveRow['vid_start']}&end={$moveRow['vid_end']}" . '" frameborder="0" 	allowfullscreen></iframe><br/>';
					}
					echo $moveRow['description'] . '<br/>' . $moveRow['style'] . "<br/></div>";
				}
			?>
		</div>
		<div class='searchBar'>
			<a href="index.html">HOME</a><br>
			<a href="assignments.html">ASSIGNMENTS</a><br>
			<?php
				if (isset($_SESSION['user']))
				{
			?>
				<a href='danceDB.php'>Your dance moves</a><br>
				<a onclick='logout();' href="">Logout</a>
			<?php 
				}
				else
				{
			?>
				<a href='registerPerson.php'>Register</a><br>
			<?php
				}
			?>
			<br><br>
			<strong>Search</strong><br>
			<form action="javascript:void(0);">
				<input type="text" placeholder="Search" id="search" onKeyPress="if (event.which == 13) update('login');">
				<br><input type="button" value="Search" onclick="update('login');">
				<br><br>
				
				
				<strong>Register a new move</strong><br>				
				<input style="width:184px" type="text" id="name" placeholder="*Move name" onKeyPress="if (event.which == 13) register();" name="moveName"><br>
				<textarea style="width:182px" rows="6" cols="21" id="desc" placeholder="*Enter Description"></textarea><br>
				Youtube code: 
				<input style="width:85px; float: right" type="text" id="code" placeholder="F5_z5TbG2y8" maxlength="11" name="link"><br>
				<span style="float: left">Start Time: </span><input id="start" style="width:85px; float:right" type='text'><br>
				<span style="float: left">End Time: </span><input id="end" style="width:85px; float: right;" type='text'><br><br>
				*Style: <select id="style">
					<option value="Lindy Hop">Lindy Hop</option>
					<option value="Charleston">Charleston</option>
					<option value="Blues">Blues</option>
				</select><br>
				<input type="button" value="Submit" onclick="register()">
			</form>
		
		</div>
		<span class="footer" ><a href="index.html">HOME</a></span>
	</body>
</html>