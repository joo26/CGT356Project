<?php
session_start();
include("includes/openDbConn.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $shippingID = mysqli_real_escape_string($db, $_GET['id']);
    $username = $_SESSION['username'];

    $query = "DELETE FROM P2Shipping WHERE ShippingID='$shippingID' AND Login='$username'";

    $result = mysqli_query($db, $query);

    if ($result) {
        header("Location: shipping.php?success=1");
        exit();
    } else {
        header("Location: shipping.php?error=5");
        exit();
    }
} else {
    header("Location: shipping.php");
    exit();
}
?>