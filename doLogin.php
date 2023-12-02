<?php
session_start();
include("includes/openDbConn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($db, $_POST['login_username']);
    $password = mysqli_real_escape_string($db, $_POST['login_password']);

    $query = "SELECT * FROM P2User WHERE Login = '$username' AND Passwd = '$password'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;

        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error_message'] = 'Login failed. Please check your username and password.';
        header("Location: register_login.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>