<?php

function registerUser($conn, $username, $password, $email) {
    // Validate input
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);

    // Check for duplicate username
    if (isUsernameExists($conn, $username)) {
        return "Username already exists";
    }

    // Check for duplicate email
    if (isEmailExists($conn, $email)) {
        return "Email already exists";
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";
    $result = $conn->query($sql);

    return $result;
}

function loginUser($conn, $username, $password) {
    // Validate input
    $username = mysqli_real_escape_string($conn, $username);

    // Fetch user from the database
    $sql = "SELECT * FROM users WHERE username='$username'";
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

function getUserByUsername($conn, $username) {
    $username = mysqli_real_escape_string($conn, $username);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    }

    return null; // User not found
}

function isUserLoggedIn() {
    return isset($_SESSION['username']);
}

function validateInputs($username, $password, $email, $profileImage) {
    // Check if username, password, email, and profileImage are not empty
    if (!empty($username) && !empty($password) && !empty($email) && !empty($profileImage)) {
        return true;
    } else {
        return false;
    }
}

function isUsernameExists($conn, $username) {
    // Check if the username already exists in the database
    $username = mysqli_real_escape_string($conn, $username);
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    return $result->num_rows > 0;
}

function isEmailExists($conn, $email) {
    // Check if the email already exists in the database
    $email = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    return $result->num_rows > 0;
}

function deleteUser($conn, $username) {
    $username = mysqli_real_escape_string($conn, $username);
    $sql = "DELETE FROM users WHERE username='$username'";
    $conn->query($sql);
}

// Function to get all registered users
function getAllUsers($conn) {
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    return $users;
}

function getContentByUserId($conn, $userId) {
    $userId = mysqli_real_escape_string($conn, $userId);

    $sql = "SELECT * FROM content WHERE user_id='$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    }

    return null; // Content not found
}

function uploadImage($image, $username, $conn) {
    // Specify the target directory where the file will be stored
    $targetDirectory = "uploads/";

    // Generate a unique filename based on the username and the original filename
    $targetFileName = $username . "_" . basename($image["name"]);

    // Construct the full path to the target file
    $targetPath = $targetDirectory . $targetFileName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($image["tmp_name"], $targetPath)) {
        // If the file was successfully moved, return the path to the uploaded file
        return $targetPath;
    } else {
        // If the file move operation failed, return false
        return false;
    }
}

?>
