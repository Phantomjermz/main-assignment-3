<?php

function registerUser($conn, $username, $password, $email) {
    // Validate input (you can add more validation as needed)
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database using prepared statement
    $stmt = $conn->prepare("INSERT INTO users2 (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $email);

    if ($stmt->execute()) {
        return true; // Registration successful
    } else {
        // Handle registration failure (e.g., duplicate username or email)
        return false;
    }
}

function loginUser($conn, $username, $password) {
    // Validate input
    $username = mysqli_real_escape_string($conn, $username);

    // Fetch user from the database using prepared statement
    $stmt = $conn->prepare("SELECT * FROM users2 WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

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