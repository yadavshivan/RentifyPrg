<?php

require('../includes/header.php');
require('../includes/db.php');


// Check if the user is logged in as a seller
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'seller') {
    header('Location: ../login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM properties WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<h2>My Properties</h2>
<a href="add_property.php" class="btn btn-success">Add New Property</a>
<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Place</th>
            <th>Area</th>
            <th>Bedrooms</th>
            <th>Bathrooms</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($property = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $property['title'] ?></td>
            <td><?= $property['place'] ?></td>
            <td><?= $property['area'] ?></td>
            <td><?= $property['bedrooms'] ?></td>
            <td><?= $property['bathrooms'] ?></td>
            <td>
                <a href="edit_property.php?id=<?= $property['id'] ?>" class="btn btn-warning">Edit</a>
                <a href="delete_property.php?id=<?= $property['id'] ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php require('../includes/footer.php'); ?>
