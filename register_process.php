<?php
include 'db.php';
include 'functions.php'; // Include your validation functions here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $profileImage = $_FILES["profile_image"];

    // Validate inputs
    $validationResult = validateUserInputs($username, $password, $email, $profileImage);

    if ($validationResult === true) {
        // Register user
        $result = registerUser($conn, $username, $password, $email, $profileImage);

        if ($result === true) {
            echo "Registration successful!";
        } else {
            echo "Registration failed: " . $result;
        }
    } else {
        echo "Invalid inputs: " . $validationResult;
    }
}
?>