<?php
$servername = "172.31.22.43";
$username = "Jermaine200551273";
$password = "DggZ3qGI7h";
$dbname = "Jermaine200551273";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>