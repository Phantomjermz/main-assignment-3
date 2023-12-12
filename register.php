<?php

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

    // Check if a profile image is provided
    if (!empty($profileImage['name'])) {
        // Validate profile image
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = pathinfo($profileImage['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            $errors[] = "Invalid profile image. Please upload a valid image file (jpg, jpeg, png, gif).";
        }
    }

    // Return true if there are no errors, otherwise return the error messages
    return (empty($errors)) ? true : implode('<br>', $errors);
}

?>