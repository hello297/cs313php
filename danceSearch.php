<!DOCTYPE html>
<html>
	<body>
		<?php
			include 'db.php';
			session_start();
			$search = "%{$_POST['search']}%";
			if ($_POST['which'] == 'users')
			{
				$query = $db->prepare('select * from learned_moves inner join moves on (moves.id = learned_moves.move_id and learned_moves.user_id = :user) where description like :search or move_name like :search or style like :search');
				$query->bindParam(':user', $_SESSION['user']);
				$query->bindParam(':search', $search);
				$query->execute();
				
				if (!$row = $query->fetch())
				{
					echo "<h2>No matches found for '{$_POST['search']}'</h2>";
					die();
				}
				else
				{
					echo "<h2>Results for '{$_POST['search']}' in {$_SESSION['user']}'s moves</h2>";
					displayEntry($row);
				}
				while($row = $query->fetch())
				{
					displayEntry($row);
				}
			}
			else
			{
				$generalQ = $db->prepare('select * from moves where description like :search or move_name like :search or style like :search');
				$generalQ->bindParam(':search', $search);
				$generalQ->execute();
				
				if (!$gRow = $generalQ->fetch())
				{
					echo "<h2>No matches found for '{$_POST['search']}'</h2>";
					die();
				}
				else
				{
					echo "<h2>Results for '{$_POST['search']}'</h2>";
					displayGen($gRow);
				}
				while($gRow = $generalQ->fetch())
				{
					displayGen($gRow);
				}
			}
			
		?>
	</body>
</html>