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
		<form method="POST" action="danceDB.php">
			<label>Username: </label><input type="text" value="guest" name="username"/> <br/>
			<label>Password: </label> <input type="password" value="1234" name="password"/><br/>
			<input type="submit" value="Login"/>
		</form>
		<div id="data">
			<?php
				include 'db.php';
				
				echo "<h2>The General List</h2>";
				
				foreach($db->query("SELECT * FROM moves") as $moveRow)
				{
					echo "<div class='entry'>" . "<h3>" . $moveRow['move_name'] . "</h3>" .
					'<br/><iframe width="320" height="195" src="https://www.youtube.com/embed/' . 
					$moveRow['link_code'] . '" frameborder="0" allowfullscreen></iframe><br/>'. 
					$moveRow['description'] . '<br/>' . $moveRow['style'] . "<br/></div>";
				}
			?>
		</div>
		<div class='searchBar'>
			<form action="javascript:void(0);">
				<input type="text" placeholder="Search" id="search" onKeyPress="if (event.which == 13) update();">
				<br><input type="button" value="Search" onclick="update();">
			</form>
		</div>
		<span class="footer" ><a href="index.html">HOME</a></span>
	</body>
</html>