<?php
	session_start();
	include 'db.php';
	
	$currentID = $_POST['move_id'];
	$coolness = $_POST['cool'];
	$hardness = $_POST['hard'];
	
	$user = $db->prepare('select * from learned_moves where user_id = :name');
	$user->bindParam(':name', $_SESSION['user']);
	$user->execute();
	
	while ($row = $user->fetch())
	{
		if ($row['move_id'] == $currentID)
		{
			echo "You already know this move!!!!";
			die();
		}
	}
	
	$query = $db->prepare('insert into learned_moves (user_id, move_id, coolness, hardness) values (:name, :move, :cool, :hard)');
	$query->bindParam(':name', $_SESSION['user']);
	$query->bindParam(':move', $currentID);
	$query->bindParam(':cool', $coolness);
	$query->bindParam(':hard', $hardness);
	$query->execute();
	
	echo "The move has been added";
?>