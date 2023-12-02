<?php
session_start();
include("includes/openDbConn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $newsletter = mysqli_real_escape_string($db, $_POST['newsletter']);
	
	$sql = "SELECT Login FROM P2User WHERE Login='".$username."'";
	echo($sql."<br/>");

	$sqlresult = mysqli_query($db, $sql);

	if(empty($sqlresult))
	$num_results = 0;
		else 
	$num_results = mysqli_num_rows($sqlresult);
	
	if($num_results != 0)
	{
	header("Location: register_login.php?error=2");
	exit;
	}
	else
	{
	$_SESSION["errorMessage"] = "";
	}
	
	
	
	

    $query = "INSERT INTO P2User (Login, FirstName, LastName, Passwd, Email, NewsLetter) VALUES ('$username', '$firstName', '$lastName', '$password', '$email', '$newsletter')";
    
    $result = mysqli_query($db, $query);

    if ($result) {
        $_SESSION['username'] = $username;

        header("Location: index.php");
        exit();
    } else {
        header("Location: register_login.php?error=2");
        exit();
    } 
} else {
    header("Location: index.php");
    exit();
}
?>