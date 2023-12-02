<?php
session_start();
include("includes/openDbConn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $billingID = mysqli_real_escape_string($db, $_POST['new_billingID']);
    $name = mysqli_real_escape_string($db, $_POST['new_name']);
    $address = mysqli_real_escape_string($db, $_POST['new_address']);
    $city = mysqli_real_escape_string($db, $_POST['new_city']);
    $state = mysqli_real_escape_string($db, $_POST['new_state']);
    $zip = mysqli_real_escape_string($db, $_POST['new_zip']);
    $cardType = mysqli_real_escape_string($db, $_POST['new_cardtype']);
    $cardNumber = mysqli_real_escape_string($db, $_POST['new_cardnumber']);
    $expDate = mysqli_real_escape_string($db, $_POST['new_expdate']);
    $username = $_SESSION['username'];
	
	if (strlen($cardNumber) !== 16) {
        header("Location: billing.php?error=1");
        exit();
    }
	
	
    $checkQuery = "SELECT * FROM P2Billing WHERE BillingID = '$billingID'";
    $checkResult = mysqli_query($db, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        header("Location: billing.php?error=3");
        exit();
    }

    $query = "INSERT INTO P2Billing (BillingID, Login, BillName, BillAddress, BillCity, BillState, BillZip, CardType, CardNumber, ExpDate) 
              VALUES ('$billingID', '$username', '$name', '$address', '$city', '$state', '$zip', '$cardType', '$cardNumber', '$expDate')";

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