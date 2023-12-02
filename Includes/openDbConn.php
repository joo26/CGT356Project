<?php

@ $db = mysqli_connect("goss.tech.purdue.edu", "cgt356web1j", "Graphical1j2959");
mysqli_select_db($db, "cgt356web1j") or die(mysqli_error());

if (!$db)
{
	echo("Error: Could not connect to database. Please try again later");
	exit;
		
}


?>

