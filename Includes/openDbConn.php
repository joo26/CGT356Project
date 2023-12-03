<?php

@ $db = mysqli_connect("-", "-", "-");
mysqli_select_db($db, "cgt356web1j") or die(mysqli_error());

if (!$db)
{
	echo("Error: Could not connect to database. Please try again later");
	exit;
		
}


?>

