<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function getShippingData($db, $username) {
    $query = "SELECT * FROM P2Shipping WHERE Login = '$username'";
    $result = mysqli_query($db, $query);

    if (!$result) {
        die("Error fetching shipping data: " . mysqli_error($db));
    }

    $shippingData = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $shippingData .= "<tr>";
        $shippingData .= "<td>" . $row['ShippingID'] . "</td>";
        $shippingData .= "<td>" . $row['Name'] . "</td>";
        $shippingData .= "<td>" . $row['Address'] . "</td>";
        $shippingData .= "<td>" . $row['City'] . "</td>";
        $shippingData .= "<td>" . $row['State'] . "</td>";
        $shippingData .= "<td>" . $row['Zip'] . "</td>";
        $shippingData .= "<td><a href='editShipping.php?id=" . $row['ShippingID'] . "'>Edit</a> | <a href='doDeleteShipping.php?id=" . $row['ShippingID'] . "'>Delete</a></td>";
        $shippingData .= "</tr>";
    }

    return $shippingData;
}
?>