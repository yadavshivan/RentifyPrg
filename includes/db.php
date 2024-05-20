<?php
$servername = "localhost";
$username = "root";  // Default for XAMPP, WAMP, and MAMP
$password = "";      // Default for XAMPP, WAMP, and MAMP
$dbname = "rentify";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
