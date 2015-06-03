<?php
	include 'db.php';
	session_start();
	$search = "%{$_POST['search']}%";
	if (isset($_SESSION['user']))
	{
		echo $_SESSION['user'] . "<br/>";
		echo $search . "<br/>";
		$query = $db->prepare('select * from learned_moves inner join moves on (moves.id = learned_moves.move_id and learned_moves.user_id = :user) where description like :search or move_name like :search');
		$query->bindParam(':user', $_SESSION['user']);
		$query->bindParam(':search', $search);
		$query->execute();
		if (!$row = $query->fetch())
		{
			echo "<h2>No matches found for '{$_POST['search']}'</h2>";
			die();
		}
		echo "<h2>Results for '{$_POST['search']}' in {$_SESSION['user']}'s moves</h2>";
		while($row)
		{
			echo "<div class='entry'>" . "<h4>" . $row['move_name'] . '</h3><br/><iframe width="320" height="195" src="http://www.youtube.com/embed/' . $row['link_code'] . '" frameborder="0" allowfullscreen></iframe><br/>'. $row['description'] . '<br/>' . $row['style'] . "<br/></div>";
		}
	}
?>