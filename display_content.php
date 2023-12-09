<?php
include 'db.php'; // Database connection
$sql = "SELECT * FROM website_content";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h2>{$row['title']}</h2>";
        echo "<p>{$row['content']}</p>";
    }
} else {
    echo "No content available.";
}

$conn->close();
?>