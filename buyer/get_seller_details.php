<?php
require('../includes/db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo "Unauthorized";
    exit;
}

if (isset($_POST['property_id'])) {
    $propertyId = $_POST['property_id'];

    // Assuming the properties table has a user_id column that links to the users table for seller details
    $query = "
        SELECT users.first_name, users.email, properties.title, properties.description 
        FROM properties 
        JOIN users ON properties.user_id = users.id 
        WHERE properties.id = ?";
    
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        http_response_code(500);
        echo "Failed to prepare statement";
        exit;
    }

    $stmt->bind_param("i", $propertyId);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $sellerDetails = $result->fetch_assoc();
        echo json_encode($sellerDetails); // Return the details as JSON
    } else {
        http_response_code(404);
        echo "Property not found";
    }
} else {
    http_response_code(400);
    echo "Invalid request";
}
?>
