<?php include('../includes/header.php'); ?>
<?php
require('../includes/db.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $place = $_POST['place'];
    $area = $_POST['area'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $description = $_POST['description'];
    $nearby_facilities = $_POST['nearby_facilities'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO properties (user_id, title, place, area, bedrooms, bathrooms, description, nearby_facilities) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isssddss', $user_id, $title, $place, $area, $bedrooms, $bathrooms, $description, $nearby_facilities);

    if ($stmt->execute()) {
        header('Location: dashboard.php');
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
}
?>
<style>
    /* Styles for the Add Property page */
/* Styles for the Add Property page */

/* Container */
.container {
    padding: 20px;
}

/* Form */
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

/* Add left margin to the form */
form {
    margin-left: auto; /* Adjust the left margin */
    margin-right: auto;
    max-width: 500px; /* Adjust the max-width if needed */
}


</style>
<form action="add_property.php" method="post">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="place">Place</label>
        <input type="text" name="place" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="area">Area (in sq ft)</label>
        <input type="text" name="area" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="bedrooms">Bedrooms</label>
        <input type="number" name="bedrooms" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="bathrooms">Bathrooms</label>
        <input type="number" name="bathrooms" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="nearby_facilities">Nearby Facilities</label>
        <textarea name="nearby_facilities" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Property</button>
</form>
<?php include('../includes/footer.php'); ?>
