<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <?php
    include('../includes/header.php');
    require('../includes/db.php');

    // Check if property ID is provided
    if(isset($_GET['id'])) {
        // Sanitize property ID
        $propertyId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        // Prepare and execute query
        $query = "SELECT * FROM properties WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $propertyId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if property exists
        if($result->num_rows > 0) {
            $property = $result->fetch_assoc();
    ?>
            <div class="property-details">
                <h2><?= $property['title'] ?></h2>
                <p>Place: <?= $property['place'] ?></p>
                <p>Area: <?= $property['area'] ?></p>
                <p>Bedrooms: <?= $property['bedrooms'] ?></p>
                <p>Bathrooms: <?= $property['bathrooms'] ?></p>
                <p>Description: <?= $property['description'] ?></p>
                <!-- Add more property details here as needed -->
            </div>
    <?php
        } else {
            echo "Property not found";
        }
    } else {
        echo "Property ID not provided";
    }

    include('../includes/footer.php');
    ?>
</body>
</html>
