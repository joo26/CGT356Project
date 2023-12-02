<!DOCTYPE html>

<?php
session_start();
include("includes/openDbConn.php");

function isUserLoggedIn() {
    return isset($_SESSION['username']);
}

if (!isUserLoggedIn()) {
    header("Location: register_login.php?error=3");
    exit();
}

$username = $_SESSION['username'];

$query = "SELECT * FROM P2User WHERE Login = '$username'";
$result = mysqli_query($db, $query);

if (!$result) {
    die("Error fetching account data: " . mysqli_error($db));
}

$row = mysqli_fetch_assoc($result);
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KiNomi - Account Info</title>
    <link rel="stylesheet" href="index.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #333;
            margin: 0;
            padding: 0;
        }

        .account-info-wrapper {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .account-info,
        .account-form {
            width: 45%; 
            padding: 20px;
            background-color: #555;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .account-form {
            margin-right: 0;
        }

        .account-form form {
            display: flex;
            flex-direction: column;
        }

        .account-form label,
        .account-form input,
        .account-form button {
            margin-bottom: 10px;
        }

        .account-form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .account-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <div id="topWrapper" class="dark-theme">
        <div class="wrapper">
            <div id="top">
                <a id="logo" href="index.php"></a>
                <div id="meta2" style="display: block; ">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<div id="meta" style="display: block;">Welcome back, ' . $_SESSION['username'] . '! <span>(<a href="doLogout.php">Logout</a>)</span></div>';
                    } else {
                        echo '<div id="meta2" style="display: block;"><a href="register_login.php">Register</a> or <a href="register_login.php">Login</a></div>';
                    }
                    ?>
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
        <h1>Account Information</h1>
		
		<?php
        if (isset($_GET['error'])) {
            $errorCode = $_GET['error'];
            switch ($errorCode) {
					
                case 2:
                    echo '<div class="error-box" style="color: red;"><p>Error: Failed to Update data.</p></div>';
                    break;
                case 3:
                    echo '<div class="error-box" style="color: red;"><p>Error: Failed to Insert Data. BillingID already exists.</p></div>';
                    break;
            }
        }
		if (isset($_GET['success']) && $_GET['success'] == 1) {
    		echo '<div class="success-box" style="color: green;"><p>Successfully Updated Account information.</p></div>';
		}
		
        ?>

        <div class="account-info-wrapper">
            <div class="account-info">
                <h2>Your Account Information</h2>
                <p><strong>Username:</strong> <?php echo $row['Login']; ?></p>
                <p><strong>First Name:</strong> <?php echo $row['FirstName']; ?></p>
                <p><strong>Last Name:</strong> <?php echo $row['LastName']; ?></p>
                <p><strong>Email:</strong> <?php echo $row['Email']; ?></p>
				<p><strong>NewsLetter:</strong> <?php echo $row['NewsLetter']; ?></p>
            </div>

            <div class="account-form">
                <h2>Update Your Account</h2>
                <form action="doUpdateAccount.php" method="post">
					<label for="username">Username:</label>
                    <input type="text" name="username" disabled = "disabled" value="<?php echo $username; ?>">
					
					<label for="new_firstname">New Password</label>
                    <input type="password" id="new_password" name="new_password" value="">

                    <label for="new_firstname">New First Name:</label>
                    <input type="text" id="new_firstname" name="new_firstname" value="<?php echo $row['FirstName']; ?>" required>

                    <label for="new_lastname">New Last Name:</label>
                    <input type="text" id="new_lastname" name="new_lastname" value="<?php echo $row['LastName']; ?>" required>

                    <label for="new_email">New Email:</label>
                    <input type="email" id="new_email" name="new_email" value="<?php echo $row['Email']; ?>" required>
					
					<label for="newsletter">Newsletter:</label>
						<div class="newsletter-options">
							<input type="radio" id="newsletterYes" name="newsletter" value="Yes" <?php echo ($row['NewsLetter'] == 'Yes') ? 'checked' : ''; ?> required>
							<label for="newsletterYes">Yes</label>

							<input type="radio" id="newsletterNo" name="newsletter" value="No" <?php echo ($row['NewsLetter'] == 'No') ? 'checked' : ''; ?> required>
							<label for="newsletterNo">No</label>
						</div>

                    <button type="submit" name="updateData">Update Account</button>
                </form>
            </div>
        </div>

    </div>


</body>

</html>