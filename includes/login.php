<?php
session_start();
include 'includes/db.php';
include 'includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate and login user
    if (!empty($username) && !empty($password)) {
        // Perform server-side validation if needed

        if (loginUser($conn, $username, $password)) {
            $_SESSION['username'] = $username;
            header("Location: content.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Username and password are required.";
    }
}
?>