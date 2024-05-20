<?php 
include('../includes/header.php');
require('../includes/db.php');

$query = "SELECT * FROM properties";
$result = $conn->query($query);
?>
<style>
    .card-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }
</style>

<h2 class="text-center my-4">Available Properties</h2>
<div class="container">
    <div class="row justify-content-center">
    <?php while ($property = $result->fetch_assoc()): ?>
<div class="col-md-6 col-lg-4 card-container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center"><?= $property['title'] ?></h5>
            <p class="card-text text-center"><?= $property['description'] ?></p>
            <div class="text-center">
                <a href="property_details.php?id=<?= $property['id'] ?>" class="btn btn-primary">View Details</a>
                <button class="btn btn-success like-btn" data-id="<?= $property['id'] ?>">Like (<span id="like-count-<?= $property['id'] ?>">0</span>)</button><br><br>
                <button class="btn btn-info interested-btn" data-id="<?= $property['id'] ?>">I'm Interested</button>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>

    </div>
</div>

<!-- Add this script in your HTML file -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Like button functionality
        $('.like-btn').click(function() {
            var propertyId = $(this).data('id');
            var likeCount = $('#like-count-' + propertyId);
            
            // Send AJAX request to like_property.php
            $.ajax({
                url: 'like_property.php',
                type: 'POST',
                data: { property_id: propertyId },
                success: function(response) {
                    // Update the like count on the page
                    likeCount.text(response);
                },
                error: function(xhr, status, error) {
                    // Handle errors if any
                    console.error(xhr.responseText);
                }
            });
        });

        // Interested button functionality
        $('.interested-btn').click(function() {
            var propertyId = $(this).data('id');
            
            // Check if user is logged in
            $.ajax({
                url: 'check_login.php',
                type: 'GET',
                success: function(response) {
                    if (response.logged_in) {
                        // Fetch and display seller details
                        $.ajax({
                            url: 'get_seller_details.php',
                            type: 'POST',
                            data: { property_id: propertyId },
                            success: function(data) {
                                alert('Seller details: ' + data);
                                // Optionally, send email
                                $.post('send_email.php', { property_id: propertyId });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    } else {
                        // Redirect to login page
                        window.location.href = 'login.php';
                    }
                }
            });
        });
    });
</script>


<?php include('../includes/footer.php'); ?>
