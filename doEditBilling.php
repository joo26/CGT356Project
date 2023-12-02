<?php
session_start();
include("includes/openDbConn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateData'])) {
    $billingID = mysqli_real_escape_string($db, $_POST['billingID']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $state = mysqli_real_escape_string($db, $_POST['state']);
    $zip = mysqli_real_escape_string($db, $_POST['zip']);
    $cardType = mysqli_real_escape_string($db, $_POST['cardtype']);
    $cardNumber = mysqli_real_escape_string($db, $_POST['cardnumber']);
    $expDate = mysqli_real_escape_string($db, $_POST['expdate']);
    $username = $_SESSION['username'];

    if (strlen($cardNumber) !== 16) {
        header("Location: billing.php?error=1");
        exit();
    }

    $query = "UPDATE P2Billing SET BillName='$name', BillAddress='$address', BillCity='$city', BillState='$state', BillZip='$zip', CardType='$cardType', CardNumber='$cardNumber', ExpDate='$expDate' WHERE BillingID='$billingID' AND Login='$username'";

    $result = mysqli_query($db, $query);

    if ($result) {
        header("Location: billing.php");
        exit();
    } else {
        header("Location: billing.php?error=2");
        exit();
    }
} else {
    header("Location: billing.php");
    exit();
}
?>