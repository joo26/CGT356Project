<!DOCTYPE html>
<?php
session_start();
include("includes/openDbConn.php");
$error = isset($_GET['error']) ? $_GET['error'] : 0;
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KiNomi - Login/Register</title>
    <link rel="stylesheet" href="index.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

    <div id="topWrapper" class="dark-theme">
        <div class="wrapper">
            <div id="top">
                <a id="logo" href="index.php"></a>
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
	
	<?php
		if ($error == 1) {
    		echo '<div class="error-message">Login failed. Please check your credentials.</div>';
		} elseif ($error == 2) {
			echo '<div class="error-message">The Username Already Exists. Please try again.</div>';
		} elseif ($error == 3) {
    		echo '<div class="error-message">Please Register or Log-In to access this page.</div>';
		}
	?>

    <div class="wrapper" id="auth-container">
        <div class="form-container" id="register-form">
    <h2>Register</h2>
    <form action="doRegister.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="newsletter">Newsletter:</label>
        <div class="newsletter-options">
            <input type="radio" id="newsletterYes" name="newsletter" value="Yes" required>
            <label for="newsletterYes">Yes</label>
            
            <input type="radio" id="newsletterNo" name="newsletter" value="No" required>
            <label for="newsletterNo">No</label>
        </div>

        <button type="submit">Register</button>
    </form>
</div>

        <div class="form-container" id="login-form">
            <h2>Login</h2>
			<?php
				if (isset($_SESSION['error_message'])) {
    			echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
    			unset($_SESSION['error_message']);
				}
			?>
            <form action="doLogin.php" method="post">
                <label for="login_username">Username:</label>
                <input type="text" id="login_username" name="login_username" required>

                <label for="login_password">Password:</label>
                <input type="password" id="login_password" name="login_password" required>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
    </script>

</body>

</html>