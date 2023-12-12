<?php
include 'includes/functions.php';

// Check if the user is logged in
if (!isUserLoggedIn()) {
    header("Location: index.php");
    exit();
}

// Delete user if requested
if (isset($_POST['deleteUser'])) {
    $usernameToDelete = $_POST['usernameToDelete'];
    deleteUser($conn, $usernameToDelete);
}

// Get all registered users
$users = getAllUsers($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registered Users</title>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main>
        <div class="container">
            <h2>Registered Users</h2>
            
            <!-- Display registered users -->
            <ul>
                <?php foreach ($users as $user): ?>
                    <li>
                        <?php echo $user['username']; ?>
                        <form action="" method="post">
                            <input type="hidden" name="usernameToDelete" value="<?php echo $user['username']; ?>">
                            <button type="submit" name="deleteUser">Delete</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
