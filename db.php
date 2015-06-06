<?php
	define('DB_HOST',getenv('OPENSHIFT_MYSQL_DB_HOST'));
	define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
	define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
	define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
	$dbname = "dance";
	$dsn = 'mysql:dbname='.$dbname.';host='.DB_HOST.';port='.DB_PORT;
	$db = new PDO($dsn, DB_USER, DB_PASS);	
	
	
	function displayEntry($row)
	{
		echo "<div class='entry'>" . "<strong>" . $row['move_name'] . '</strong><br/><br/>';
		
		if (isset($row['link_code']))
		{
			echo '<iframe width="320" height="195" src="http://www.youtube.com/embed/' . $row['link_code'] . 
			"?start={$row['vid_start']}&end={$row['vid_end']}" . '" frameborder="0" 	allowfullscreen></iframe><br/>';
		}
		

		echo $row['description'] . '<br/>' . $row['style'] . "<br/>";
		if (isset($_SESSION['user']))
		{
			echo "{$row['coolness']}<br>{$row['hardness']}<br>";
		}
		echo "</div>";
	}
	
	function displayGen($row)
	{
		echo "<div class='entry'>" . "<strong>" . $row['move_name'] . '</strong>';
		if (isset($_SESSION['user']))
		{
			echo '<input type="button" value="Add to my list" style="float:right" id="' . $row['id'] . '" onclick="add(this.id)">';
		}
		echo '<br/><br/>';
		
		if (isset($row['link_code']))
		{
			echo '<iframe width="320" height="195" src="http://www.youtube.com/embed/' . $row['link_code'] . 
			"?start={$row['vid_start']}&end={$row['vid_end']}" . '" frameborder="0" 	allowfullscreen></iframe><br/>';
		}
		

		echo $row['description'] . '<br/>' . $row['style'] . "<br/>";
		
		echo "</div>";
	}
?>