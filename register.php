<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include 'db.php'; // Include the database connection file
    include 'functions.php'; // Include functions for registration logic

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <section>
            <h2>Welcome to the registration</h2>
            <p>This is the registration content.</p>
        </section>

        <!-- Registration Form -->
<form id="registerForm" action="user.php" method="post" enctype="multipart/form-data">
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
