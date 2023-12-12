<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'includes/db.php';
include 'includes/functions.php';




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
            <h2>Welcome to the Home Page</h2>
            <p>This is the home page content.</p>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>