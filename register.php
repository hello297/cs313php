<?php
	session_start();
	include 'db.php';
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$style = $_POST['style'];
	$coolness = $_POST['coolness'];
	$hardness = $_POST['hardness'];
	
	if ($_POST['code'] != '')
	{
		$code = $_POST['code'];
		$start = $_POST['start'];
		$end = $_POST['end'];
		$query = $db->prepare('insert into moves (move_name, description, style, link_code, vid_start, vid_end) values (:name, :desc, :style, :code, :start, :end)');
		$query->bindParam(':name',  $name);
		$query->bindParam(':desc',  $desc);
		$query->bindParam(':style', $style);
		$query->bindParam(':code',  $code);
		$query->bindParam(':start', $start);
		$query->bindParam(':end',   $end);
		$query->execute();
	}
	else
	{
		$query = $db->prepare('insert into moves (move_name, description, style) values (:name, :desc, :style)');
		$query->bindParam(':name',  $name);
		$query->bindParam(':desc',  $desc);
		$query->bindParam(':style', $style);
		$query->execute();
	}
	echo $_SESSION['user'];
	if (isset($_SESSION['user']))
	{
		$last = $db->lastInsertId();
		$user = $db->prepare('insert into learned_moves (user_id, move_id, coolness, hardness) values (:user_id, :move_id, :coolness, :hardness)');
		$user->bindParam(':user_id',  $_SESSION['user']);
		$user->bindParam(':move_id',  $last);
		$user->bindParam(':coolness', $coolness);
		$user->bindParam(':hardness', $hardness);
		$user->execute();
	}
?>