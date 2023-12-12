<!-- About / Content Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website Content">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <title>Home</title>
</head>
<body>
    <!-- Header Section  -->
    <header>
        <?php include 'includes/header.php'; ?>
    </header>

    <main>
        <section>
            <?php
            // Check if the user is logged in
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                echo "<h2>Welcome, $username!</h2>";
            } else {
                // If not logged in, display general content
                echo "<h2>$title</h2>";
                echo "<p>$body</p>";
            }
            ?>
        </section>
    </main>

    <!-- global footer here) -->
    <footer>
        <?php include 'includes/footer.php'; ?>
    </footer>
</body>
</html>