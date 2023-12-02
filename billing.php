<!DOCTYPE html>

<?php
session_start();
include("includes/openDbConn.php");
include("getBillingData.php");

function isUserLoggedIn() {
    return isset($_SESSION['username']);
}

if (!isUserLoggedIn()) {
    header("Location: register_login.php?error=3");
    exit();
}

$username = $_SESSION['username'];
$billingData = getBillingData($db, $username);

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
    <title>KiNomi - Billing</title>
    <link rel="stylesheet" href="index.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<style> table { font-size: 12px; }</style>
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
        <h1>Billing Information</h1>
		<?php
        if (isset($_GET['error'])) {
            $errorCode = $_GET['error'];
            switch ($errorCode) {
				case 1:
					echo '<div class="error-box" style="color: red;"><p>Error: Credit Card Must Be 16 Characters</p></div>';
                    break;
					
                case 2:
                    echo '<div class="error-box" style="color: red;"><p>Error: Failed to insert data.</p></div>';
                    break;
                case 3:
                    echo '<div class="error-box" style="color: red;"><p>Error: Failed to Insert Data. BillingID already exists.</p></div>';
                    break;
            }
        }
		if (isset($_GET['success']) && $_GET['success'] == 1) {
    		echo '<div class="success-box" style="color: green;"><p>Successfully deleted billing information.</p></div>';
		}
		
        ?>
        <table style="border-collapse: collapse; width: 100%;" border="2">
            <tr>
                <th>Billing ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Card Type</th>
                <th>Card Number</th>
                <th>Exp Date</th>
                <th>Actions</th>
            </tr>
            <?php echo $billingData; ?>
        </table>
    </div>
	
	<div class="billing-form-wrapper">
    <div class="billing-form">
        <h2>Add Billing Information</h2>
        <form action="doInsertBilling.php" method="post">
			<label for="new_billingid">BillingID:</label>
            <input type="text" id="new_billingid" name="new_billingID" required>
			
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

            <label for="new_cardtype">Card Type:</label>
            <input type="text" id="cardtype" name="new_cardtype" required>

            <label for="new_cardnumber">Card Number:</label>
            <input type="text" id="cardnumber" name="new_cardnumber" required>

            <label for="new_expdate">Exp Date:</label>
            <input type="text" id="expdate" name="new_expdate" required>

            <button type="submit">Add Billing Information</button>
        </form>
    </div>
</div>




</body>

</html>