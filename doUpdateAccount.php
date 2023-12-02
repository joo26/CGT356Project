<?php
session_start();
include("includes/openDbConn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateData'])) {
    $username = $_SESSION['username'];
    $newPassword = mysqli_real_escape_string($db, $_POST['new_password']);
    $newFirstName = mysqli_real_escape_string($db, $_POST['new_firstname']);
    $newLastName = mysqli_real_escape_string($db, $_POST['new_lastname']);
    $newEmail = mysqli_real_escape_string($db, $_POST['new_email']);
    $newsletter = mysqli_real_escape_string($db, $_POST['newsletter']);
	
	$newPassword = isset($_POST['new_password']) ? mysqli_real_escape_string($db, $_POST['new_password']) : null;
	$hashedPassword = !empty($newPassword) ? ", Passwd='$newPassword'" : '';


	


    $query = "SELECT * FROM P2User WHERE Login = '$username'";
    $result = mysqli_query($db, $query);

    if (!$result) {
        die("Error fetching user data: " . mysqli_error($db));
    }

    $row = mysqli_fetch_assoc($result);


    $updateQuery = "UPDATE P2User SET FirstName='$newFirstName', LastName='$newLastName', Email='$newEmail', NewsLetter='$newsletter' $hashedPassword WHERE Login='$username'";	

    $updateResult = mysqli_query($db, $updateQuery);


    if ($updateResult) {
  
        header("Location: account.php?success=1");
        exit();
    } else {
        header("Location: account.php?error=2");
        exit();
    }
} else {
    header("Location: account.php");
    exit();
}

?>