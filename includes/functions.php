<?php

function uploadImage($image, $userId, $conn) {
    // Specify the target directory where the file will be stored
    $targetDirectory = "uploads/";

    // Generate a unique filename based on the user ID and the original filename
    $targetFileName = $userId . "_" . basename($image["name"]);

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

function registerUser($conn, $username, $password, $email, $profileImage) {
    // Validate input
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);

    // Check for duplicate email
    $duplicateEmailCheck = "SELECT * FROM users2 WHERE email='$email'";
    $duplicateEmailResult = $conn->query($duplicateEmailCheck);

    if ($duplicateEmailResult->num_rows > 0) {
        return "Email already exists";
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $sql = "INSERT INTO users2 (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";
    $result = $conn->query($sql);

    if ($result) {
        // If the user was successfully inserted, upload the image
        $userId = $conn->insert_id;
        $imagePath = uploadImage($profileImage, $userId, $conn);

        if ($imagePath !== false) {
            // Update the user's image path in the database
            $updateImageSql = "UPDATE users2 SET image_path='$imagePath' WHERE id='$userId'";
            $updateImageResult = $conn->query($updateImageSql);

            if (!$updateImageResult) {
                // Handle image update failure as needed
            }
        }
    }

    return $result;
}

function validateUserInputs($username, $password, $email, $profileImage) {
    // Perform validation on each input
    $errors = [];

    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // Validate email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    // Validate profile image
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = pathinfo($profileImage['name'], PATHINFO_EXTENSION);

    if (empty($profileImage) || !in_array(strtolower($fileExtension), $allowedExtensions)) {
        $errors[] = "Invalid profile image. Please upload a valid image file (jpg, jpeg, png, gif).";
    }

    // Return true if there are no errors, otherwise return the error messages
    return (empty($errors)) ? true : implode('<br>', $errors);
}

function loginUser($conn, $username, $password) {
    // Fetch user from the database using prepared statement
    $stmt = $conn->prepare("SELECT * FROM users2 WHERE username=?");
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