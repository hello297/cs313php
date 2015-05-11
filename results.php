<!DOCTYPE html>
<html>
	<head>
		<title>Survey Results</title>
		<link rel="stylesheet" type="text/css" href="theme.css"/>
	</head>
	<body>
		<h1>Results</h1>
		<?php
			session_start();
			if (isset($_SESSION['visited'])) 
			{
				$_POST = array();
				if (isset($_SESSION['message']))
					echo $_SESSION['message'];
			}
			else
			{
				echo "<a href='survey.php'>To the Survey</a>";
			}
			
			$file = fopen("results.txt", "r+");
			$index = array('yes', 'no', 'blue', 'orange', 'red', 'yellow',
			'green', 'purple', 'brown', 'black', 'white', 'pink', 'sloth',
			'dog', 'cat', 'fox', 'kraft', 'western', 'shur', 'velveeta', 'home');
			$contents = explode(",", fgets($file));
			
			for ($x = 0; $x < 21; $x++)
			{
				$array[$index[$x]] = $contents[$x];
			}
			if (!empty($_POST))
			{
				$_SESSION['visited'] = true;
				$array[$_POST['dance']]++;
				$array[$_POST['color']]++;
				$array[$_POST['animal']]++;
				$array[$_POST['mac']]++;
				
			}
			
			echo "<h3 class='question'>Do you like to dance?</h3>";
			for ($x = 0; $x < 2; $x++)
			{	
				$count = $array[$index[$x]];
				$width = 50*$count + 75;
				echo "<div class='bar' style='width:$width" . "px'>$index[$x]: $count</div>";
			}
			
			echo "<h3 class='question'>What is your favorite color?</h3>";
			for ($x = 2; $x < 12; $x++)
			{	
				$count = $array[$index[$x]];
				$width = 50*$count + 75;
				echo "<div class='bar' style='width:$width" . "px'>$index[$x]: $count</div>";
			}
			
			echo "<h3 class='question'>What is your favorite animal?</h3>";
			for ($x = 12; $x < 16; $x++)
			{	
				$count = $array[$index[$x]];
				$width = 50*$count + 75;
				echo "<div class='bar' style='width:$width" . "px'>$index[$x]: $count</div>";
			}
			
			echo "<h3 class='question'>What is your favorite brand of Mac 'n Cheese?</h3>";
			for ($x = 16; $x < 21; $x++)
			{	
				$count = $array[$index[$x]];
				$width = 50*$count + 75;
				echo "<div class='bar' style='width:$width" . "px'>$index[$x]: $count</div>";
			}
			
			$contents = implode(",", $array);
			rewind($file);
			fwrite($file, $contents);
		?>
		
		<span class="footer" > <a href="index.html">HOME</a><span>
	</body>
</html>