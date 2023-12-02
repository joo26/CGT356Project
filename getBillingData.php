<?php

function getBillingData($db, $username) {
    $query = "SELECT * FROM P2Billing WHERE Login = '$username'";
    $result = mysqli_query($db, $query);


    if (!$result) {
        die("Error fetching billing data: " . mysqli_error($db));
    }

    $billingData = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $billingData .= "<tr>";
        $billingData .= "<td>" . $row['BillingID'] . "</td>";
        $billingData .= "<td>" . $row['BillName'] . "</td>";
        $billingData .= "<td>" . $row['BillAddress'] . "</td>";
        $billingData .= "<td>" . $row['BillCity'] . "</td>";
        $billingData .= "<td>" . $row['BillState'] . "</td>";
        $billingData .= "<td>" . $row['BillZip'] . "</td>";
        $billingData .= "<td>" . $row['CardType'] . "</td>";
		
        $lastFourDigits = substr($row['CardNumber'], -4);
    	$formattedCardNumber = 'xxxx-xxxx-xxxx-' . $lastFourDigits;
    	$billingData .= "<td>" . $formattedCardNumber . "</td>";
		
        $billingData .= "<td>" . $row['ExpDate'] . "</td>";
        $billingData .= "<td><a href='editBilling.php?id=" . $row['BillingID'] . "'>Edit</a> | <a href='doDeleteBilling.php?id=" . $row['BillingID'] . "'>Delete</a></td>";
        $billingData .= "</tr>";
    }

    return $billingData;
}
?>
