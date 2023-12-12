<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="register" content="registration">
       <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/footer.css">
        <title>Home</title>
    </head>
<body>
    <!-- global header here-->
    <header>
        <?php include 'includes/header.php'; ?>
        </header>

    <div class="container">
        <form action="register.php" method="post" enctype="multipart/form-data">
            <h2>Create Account</h2>

            <!-- Username -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <!-- Password -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>


            <!-- Submit Button -->
            <button type="submit" name="register">Create Account</button>
        </form>
    </div>
    
    
     <!-- global footer here) -->
     <footer>
     <?php include 'includes/footer.php'; ?>
    </footer>
</body>
</html>