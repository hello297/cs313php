<?php
	session_start();
	
	$user = $_SESSION['user'];
	$move = $_POST['move_id'];
	
	/*$query = $db->prepare('delete from learned_moves where user_id = :user and move_id = :move');
	$query->bindParam(':user', $user);
	$query->bindParam(':move', $move);
	$query->execute();*/
	
	echo "The move has been deleted";
?>