<header>
    <div class="logo">
        <h1>Welcome to my Website</h1>
    </div>

    <div class="login-form">
        <?php
        // Check if the user is logged in
        if (isUserLoggedIn()) {
            echo '<form action="logout.php" method="post">';
            echo '<button type="submit" name="logout">Logout</button>';
            echo '</form>';
        } else {
            // If not logged in, display the login form
            echo '<form action="login.php" method="post">';
            echo '<label for="username">Username:</label>';
            echo '<input type="text" id="username" name="username" required>';
            echo '<label for="password">Password:</label>';
            echo '<input type="password" id="password" name="password" required>';
            echo '<button type="submit">Login</button>';
            echo '</form>';
        }
        ?>
    </div>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="dashboard.html">Content</a></li>
            <li><a href="register.php">Register</a></li>
            <?php
            // Check if the user is logged in
            if (isUserLoggedIn()) {
                // If logged in, display additional links
                echo '<li><a href="users.php">Registered Users</a></li>';
                echo '<li><a href="content.php">Update Content</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>