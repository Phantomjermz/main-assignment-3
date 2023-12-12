<?php
session_start();
include 'includes/db.php';
include 'includes/functions.php';



// Process registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $profileImage = $_FILES["profileImage"];

    // Validate inputs
    if (validateInputs($username, $password, $email, $profileImage)) {
        // Additional validation if needed

        // Check for duplicate email
        $duplicateEmailCheck = "SELECT * FROM users WHERE email='$email'";
        $duplicateEmailResult = $conn->query($duplicateEmailCheck);

        if ($duplicateEmailResult->num_rows > 0) {
            echo "Email already exists.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into the database
            $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";
            $result = $conn->query($sql);

            if ($result) {
                // If the user was successfully inserted, upload the image
                $imagePath = uploadImage($profileImage, $username, $conn);

                if ($imagePath !== false) {
                    // Update the user's image path in the database
                    $updateImageSql = "UPDATE users SET image_path='$imagePath' WHERE username='$username'";
                    $updateImageResult = $conn->query($updateImageSql);

                    if (!$updateImageResult) {
                        // Handle image update failure as needed
                    }
                }

                echo "Registration successful.";
            } else {
                echo "Registration failed.";
            }
        }
    } else {
        echo "All fields are required.";
    }
}


// Process registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $profileImage = $_FILES["profileImage"];

    // Call the registerUser function
    $registrationResult = registerUser($conn, $username, $password, $email, $profileImage);

    // Output the result
    echo $registrationResult;
}
?>
