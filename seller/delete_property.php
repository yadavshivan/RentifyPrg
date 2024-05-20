<?php
require('../includes/db.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'seller') {
    header('Location: ../login.php');
    exit;
}

// Check if property ID is provided
if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    // Prepare and execute DELETE query
    $query = "DELETE FROM properties WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $property_id);

    if ($stmt->execute()) {
        // Redirect back to Dashboard page after successful deletion
        header('Location: dashboard.php');
        exit;
    } else {
        echo "Error: Unable to delete property.";
    }
} else {
    echo "Error: Property ID not provided.";
}
?>
