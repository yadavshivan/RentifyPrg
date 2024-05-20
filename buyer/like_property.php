<?php
require('../includes/db.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo 'Unauthorized';
    exit;
}

// Check if property_id is sent via POST
if (!isset($_POST['property_id'])) {
    echo 'Property ID is missing';
    exit;
}

// Get user_id and property_id from session and POST data
$user_id = $_SESSION['user_id'];
$property_id = $_POST['property_id'];

// Prepare and execute insert query
$query = "INSERT INTO likes (user_id, property_id) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $user_id, $property_id);

if ($stmt->execute()) {
    // Query to count likes for the property
    $count_query = "SELECT COUNT(*) as count FROM likes WHERE property_id = ?";
    $count_stmt = $conn->prepare($count_query);
    $count_stmt->bind_param('i', $property_id);
    $count_stmt->execute();
    
    // Get count of likes
    $count_result = $count_stmt->get_result();
    $count = $count_result->fetch_assoc()['count'];
    
    // Output count of likes
    echo $count;
} else {
    // Output error message if insert fails
    echo 'Error: ' . $conn->error;
}
?>
