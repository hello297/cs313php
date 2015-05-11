<!DOCTYPE html>
<html>
	<head>
		<title>Survey</title>
		<link rel="stylesheet" type="text/css" href="theme.css"/>
		<script src="survey.js" type="text/javascript"></script>
	</head>
	<body>
		<?php
			session_start();
			if (isset($_SESSION['visited'])) 
			{
				$_SESSION['message'] = "You've already taken the survey.  You can only take it once.";
				header('Location: results.php');
			}
		?>
		
		<h1>Survey</h1>
		<a href="results.php">See results</a>
		
		<form name ="myForm" method="post" action="results.php" onsubmit="return validateForm()">
			<h3 class="header">Do you like to dance?</h3>
			<input type="radio" name="dance" value="yes"/> Yes<br/>
			<input type="radio" name="dance" value="no" onclick="youDontSay('whynot')"/> No<br/>
			<img id="whynot"/>
			
			<h3 class="header">What is your favorite color?</h3>
			<input type="radio" name="color" value="blue"/> Blue<br/>
			<input type="radio" name="color" value="orange"/> Orange<br/>
			<input type="radio" name="color" value="red"/> Red<br/>
			<input type="radio" name="color" value="yellow"/> Yellow<br/>
			<input type="radio" name="color" value="green"/> Green<br/>
			<input type="radio" name="color" value="purple"/> Purple<br/>
			<input type="radio" name="color" value="brown"/> Brown<br/>
			<input type="radio" name="color" value="black"/> Black<br/>
			<input type="radio" name="color" value="white"/> White<br/>
			<input type="radio" name="color" value="pink"/> Pink<br/>
			
			<h3 class="header">What is your favorite animal?</h3>
			<input type="radio" name="animal" value="sloth"/> Sloth<br/>
			<input type="radio" name="animal" value="dog"/> Dog<br/>
			<input type="radio" name="animal" value="cat"/> Cat<br/>
			<input type="radio" name="animal" value="fox"/> Fox<br/>
			
			<h3 class="header">What is your favorite brand of Mac 'n Cheese?</h3>
			<input type="radio" name="mac" value="kraft"/> Kraft<br/>
			<input type="radio" name="mac" value="western"/> Western Family<br/>
			<input type="radio" name="mac" value="shur"/> Shur Savings<br/>
			<input type="radio" name="mac" value="velveeta"/> Velveeta<br/>
			<input type="radio" name="mac" value="home"/> Momma's Home Cookin'<br/><br/>
			<input type="submit" value="Submit the form!"/>
			
			<span class="footer" ><a href="index.html">HOME</a><span>
		</form>
	</body>
</html>