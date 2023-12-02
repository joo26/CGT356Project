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
    <title>KiNomi - README</title>
    <link rel="stylesheet" href="index.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

    <div id="topWrapper" class="dark-theme">
        <div class="wrapper">
            <div id="top">
                <a id="logo" href="index.php"></a>
                <div id="meta2" style="display: flex; align-items: center;">
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
        <h1>KiNomi LLC <span> About Me </span></h1>
        <div id="about">
            <div id="introduction">
                <div id="photo">
                    <img src="headshot.jpg" alt="Headshot">
                </div>
                <div id="description">
                    <h2>My name is Yooto Joo</h2>
                    <p>This is a project showcasing a simple account management web page allowing users to create, insert, update, and delete, their own data.</p>
                    <p>The account system directly selects data associated to the user, in otherwords, data created or inserted by a different user cannot be seen or accessed by someone else. All data that the user creates is associated to their unique ID which is their login username. </p>
                </div>
            </div>
        </div>
    </div>


</body>

</html>