<?php
session_start();
include("includes/openDbConn.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $billingID = mysqli_real_escape_string($db, $_GET['id']);
    $username = $_SESSION['username'];

    $query = "DELETE FROM P2Billing WHERE BillingID='$billingID' AND Login='$username'";

    $result = mysqli_query($db, $query);

    if ($result) {
        header("Location: billing.php?success=1");
        exit();
    } else {
        header("Location: billing.php?error=5");
        exit();
    }
} else {
    header("Location: billing.php");
    exit();
}
?>