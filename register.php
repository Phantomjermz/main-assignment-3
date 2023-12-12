<?php

include 'includes/db.php';
include 'includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Validate and register user
    if (!empty($username) && !empty($password) && !empty($email)) {
        // Perform server-side validation if needed

        $result = registerUser($conn, $username, $password , $email);
        if ($result) {
            echo "Registration successful!";
        } else {
            echo "Error registering user.";
        }
    } else {
        echo "Username and password are required.";
    }
}
?>