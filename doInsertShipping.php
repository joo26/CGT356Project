<?php
session_start();
include("includes/openDbConn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$shippingid = mysqli_real_escape_string($db, $_POST['new_shippingID']);
    $name = mysqli_real_escape_string($db, $_POST['new_name']);
	$address = mysqli_real_escape_string($db, $_POST['new_address']);
	$city = mysqli_real_escape_string($db, $_POST['new_city']);
	$state = mysqli_real_escape_string($db, $_POST['new_state']);
	$zip = mysqli_real_escape_string($db, $_POST['new_zip']);
	$username = $_SESSION['username'];
	
    $checkQuery = "SELECT * FROM P2Shipping WHERE ShippingID = '$shippingid'";
    $checkResult = mysqli_query($db, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        header("Location: shipping.php?error=3");
        exit();
    }

    $query = "INSERT INTO P2Shipping (ShippingID, Name, Address, City, State, Zip, Login) 
              VALUES ('$shippingid','$name', '$address', '$city', '$state', '$zip', '$username')";

    $result = mysqli_query($db, $query);

    if ($result) {
        header("Location: shipping.php");
        exit();
    } else {
        header("Location: shipping.php?error=2");
        exit();
    }
} else {
    header("Location: shipping.php");
    exit();
}
?>