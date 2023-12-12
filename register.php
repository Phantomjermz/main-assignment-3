<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>
    <?php
    include 'header.php';
    include 'db.php'; // Include the database connection file
    include 'functions.php'; // Include functions for registration logic

    // Handle registration logic
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
    ?>

    <main>
        <section>
            <h2>Welcome to the Home Page</h2>
            <p>This is the home page content.</p>
        </section>

        <!-- Registration Form -->
        <form id="registerForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <h2>Create Account</h2>
            <label for="registerUsername">Username:</label>
            <input type="text" id="registerUsername" name="username" required>
            <label for="registerPassword">Password:</label>
            <input type="password" id="registerPassword" name="password" required>
            <label for="registerEmail">Email:</label>
            <input type="email" id="registerEmail" name="email" required>
            <label for="profileImage">Profile Image:</label>
            <input type="file" id="profileImage" name="profileImage" accept="image/*" required>
            <button type="submit" name="register">Create Account</button>
        </form>

    </main>

    <?php include 'footer.php'; ?>
</body>

</html>
