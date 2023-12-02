<!DOCTYPE html>

<?php
session_start();
include("includes/openDbConn.php");
include("getShippingData.php");

function isUserLoggedIn() {
    return isset($_SESSION['username']);
}

if (!isUserLoggedIn()) {
    header("Location: register_login.php?error=3");
    exit();
}

$username = $_SESSION['username'];
$shippingData = getShippingData($db, $username);

if (isset($_SESSION['username'])) {
    $authOptions = '<div id="meta" style="display: block;">Welcome back, ' . $_SESSION['username'] . '! <span>(<a href="doLogout.php">Logout</a>)</span></div>';
} else {
    $authOptions = '<div id="meta2" style="display: block;"><a href="register_login.php">Register</a> or <a href="register_login.php">Login</a></div>';
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KiNomi - Shipping</title>
    <link rel="stylesheet" href="index.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

    <div id="topWrapper" class="dark-theme">
        <div class="wrapper">
            <div id="top">
                <a id="logo" href="index.php"></a>
                <div id="meta2" style="display: block; ">
                    <?php echo $authOptions; ?>
                </div>
                <div id="nav">
                    <ul>
                        <li><a href="index.php">Home<span class="current"></span></a></li>
                        <li><a href="shipping.php">Shipping<span style="opacity: 0;"></span></a></li>
                        <li><a href="billing.php">Billing<span style="opacity: 0;"></span></a></li>
                        <li><a href="account.php">Account Info<span style="opacity: 0;"></span></a></li>
                        <li><a href="readme.php">Readme<span style="opacity: 0;"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper" >
        <h1>Shipping Information</h1>
		<?php
        if (isset($_GET['error'])) {
            $errorCode = $_GET['error'];
            switch ($errorCode) {
                case 2:
                    echo '<div class="error-box" style="color: red;"><p>Error: Failed to insert data.</p></div>';
                    break;
                case 3:
                    echo '<div class="error-box" style="color: red;"><p>Error: Failed to Insert Data. ShipperID already exists.</p></div>';
                    break;
            }
        }
		if (isset($_GET['success']) && $_GET['success'] == 1) {
    		echo '<div class="success-box" style="color: green;"><p>Successfully deleted shipping information.</p></div>';
		}
        ?>
        <table style="border-collapse: collapse; width: 100%;" border="2">
            <tr>
                <th>Shipping ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Actions</th>
            </tr>
            <?php echo $shippingData; ?>
        </table>
    </div>
	
	<div class="shipping-form-wrapper">
    <div class="shipping-form">
        <h2>Add Shipping Address</h2>
        <form action="doInsertShipping.php" method="post">
			<label for="new_shippingid">ShippingID:</label>
            <input type="text" id="new_shippingid" name="new_shippingID" required>
			
            <label for="new_name">Name:</label>
            <input type="text" id="name" name="new_name" required>

            <label for="new_address">Address:</label>
            <input type="text" id="address" name="new_address" required>

            <label for="new_city">City:</label>
            <input type="text" id="city" name="new_city" required>

            <label for="new_state">State:</label>
            <input type="text" id="state" name="new_state" required>

            <label for="new_zip">Zip:</label>
            <input type="text" id="zip" name="new_zip" required>

            <button type="submit">Add Address</button>
        </form>
    </div>
</div>
	


</body>

</html>