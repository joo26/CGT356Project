<?php
session_start();
include("includes/openDbConn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $shippingID = mysqli_real_escape_string($db, $_POST['shippingID']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $state = mysqli_real_escape_string($db, $_POST['state']);
    $zip = mysqli_real_escape_string($db, $_POST['zip']);
    $username = $_SESSION['username'];

    $query = "UPDATE P2Shipping SET Name='$name', Address='$address', City='$city', State='$state', Zip='$zip' WHERE ShippingID='$shippingID' AND Login='$username'";

    $result = mysqli_query($db, $query);

    if ($result) {
        header("Location: shipping.php");
        exit();
    } else {
        header("Location: shipping.php?error=4");
        exit();
    }
} else {
    header("Location: shipping.php");
    exit();
}
?>