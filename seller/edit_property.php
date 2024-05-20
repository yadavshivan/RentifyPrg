<?php
require('../includes/header.php');
require('../includes/db.php');
session_start(); // Ensure the session is started

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'seller') {
    header('Location: ../login.php');
    exit;
}

// Check if property ID is provided
if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    // Query to fetch property details
    $query = "SELECT * FROM properties WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $property = $result->fetch_assoc();

    // Display form to update property details
    if ($property) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle form submission
            $title = $_POST['title'];
            $place = $_POST['place'];
            $area = $_POST['area'];
            $bedrooms = $_POST['bedrooms'];
            $bathrooms = $_POST['bathrooms'];
            $description = $_POST['description'];
            $nearby_facilities = $_POST['nearby_facilities'];

            // Update property details in the database
            $update_query = "UPDATE properties SET title = ?, place = ?, area = ?, bedrooms = ?, bathrooms = ?, description = ?, nearby_facilities = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param('sssiissi', $title, $place, $area, $bedrooms, $bathrooms, $description, $nearby_facilities, $property_id);

            if ($update_stmt->execute()) {
                // Assuming the update was successful
                header('Location: dashboard.php');
                exit; // Ensure no further code is executed after redirection
            } else {
                $error_message = "Error updating property: " . $update_stmt->error;
            }
        }
?>
<style>
    /* Styles for the Edit Property page */
    .container {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        margin-top: 5px;
    }

    textarea {
        height: 100px;
    }

    button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    form {
        margin-left: auto;
        margin-right: auto;
        max-width: 500px;
    }

    .alert {
        margin-top: 20px;
    }
</style>
       
        <form action="edit_property.php?id=<?= $property_id ?>" method="post">
            <h2>Edit Property</h2>
            <input type="hidden" name="property_id" value="<?= $property['id'] ?>">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="<?= $property['title'] ?>" required>
            </div>
            <div class="form-group">
                <label for="place">Place</label>
                <input type="text" name="place" class="form-control" value="<?= $property['place'] ?>" required>
            </div>
            <div class="form-group">
                <label for="area">Area (in sq ft)</label>
                <input type="text" name="area" class="form-control" value="<?= $property['area'] ?>" required>
            </div>
            <div class="form-group">
                <label for="bedrooms">Bedrooms</label>
                <input type="number" name="bedrooms" class="form-control" value="<?= $property['bedrooms'] ?>" required>
            </div>
            <div class="form-group">
                <label for="bathrooms">Bathrooms</label>
                <input type="number" name="bathrooms" class="form-control" value="<?= $property['bathrooms'] ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control"><?= $property['description'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="nearby_facilities">Nearby Facilities</label>
                <textarea name="nearby_facilities" class="form-control"><?= $property['nearby_facilities'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Property</button>
        </form>
<?php
        if (isset($success_message)) {
            echo "<div class='alert alert-success'>$success_message</div>";
        }
        if (isset($error_message)) {
            echo "<div class='alert alert-danger'>$error_message</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Property not found.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Error: Property ID not provided.</div>";
}

require('../includes/footer.php');
?>
