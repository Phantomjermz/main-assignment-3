<?php

function registerUser($conn, $username, $password) {
    // Validate input (you can add more validation as needed)
    $username = mysqli_real_escape_string($conn, $username);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $sql = "INSERT INTO users2 (username, password) VALUES ('$username', '$hashedPassword')";
    $result = $conn->query($sql);

    return $result;
}

function loginUser($conn, $username, $password) {
    // Validate input
    $username = mysqli_real_escape_string($conn, $username);

    // Fetch user from the database
    $sql = "SELECT * FROM users2 WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            return true; // Login successful
        }
    }

    return false; // Login failed
}

?>