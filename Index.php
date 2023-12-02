<!DOCTYPE html>

<?php
session_start();
include("includes/openDbConn.php");

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
    <title>KiNomi - Home</title>
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
    <div class="wrapper">

        <h1>Welcome to <span>KiNomi</span></h1>
        <div id="about">
            <h2>Account Management System</h2>
            <p>This webpage allows you edit data inside of a database. You will not have access to the SHIPPING, BILLING, and ACCOUNT page until you login. If you attempt to access the pages, you will be flown to the REGISTER-LOGIN page. After logging in or registering an account, you can add shipping addresses and billing information using the two pages. You can also edit your own account information in the ACCOUNT page. If you log-out you will be flown to the HOME page. </p>
        </div>
    </div>


</body>

</html>