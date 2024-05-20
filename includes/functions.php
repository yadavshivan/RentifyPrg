<?php
// Database connection function
function db_connect() {
    $servername = "localhost"; // change this to your database server
    $username = "root"; // change this to your database username
    $password = ""; // change this to your database password
    $dbname = "rentify"; // change this to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// User authentication function
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function is_seller() {
    return is_logged_in() && $_SESSION['user_type'] == 'seller';
}

function is_buyer() {
    return is_logged_in() && $_SESSION['user_type'] == 'buyer';
}

// Redirect to login if not authenticated
function require_login() {
    if (!is_logged_in()) {
        header('Location: ../login.php');
        exit;
    }
}

// Redirect to login if not a seller
function require_seller() {
    if (!is_seller()) {
        header('Location: ../login.php');
        exit;
    }
}

// Redirect to login if not a buyer
function require_buyer() {
    if (!is_buyer()) {
        header('Location: ../login.php');
        exit;
    }
}

// Sanitize user input to prevent XSS
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Display a success message
function display_success_message($message) {
    echo "<div class='alert alert-success'>$message</div>";
}

// Display an error message
function display_error_message($message) {
    echo "<div class='alert alert-danger'>$message</div>";
}

// Send email function (stub, implement actual email sending logic)
function send_email($to, $subject, $message) {
    // Use PHP mail() function or an email library like PHPMailer
    // mail($to, $subject, $message);
}

// Example: Send email to buyer and seller when "I'm Interested" button is clicked
function notify_interest($buyer_email, $seller_email, $property_details) {
    $buyer_subject = "Interest in Property: " . $property_details['title'];
    $buyer_message = "You have expressed interest in the property titled '" . $property_details['title'] . "'. Here are the details:\n\n" . $property_details['description'];

    $seller_subject = "A Buyer is Interested in Your Property: " . $property_details['title'];
    $seller_message = "A buyer is interested in your property titled '" . $property_details['title'] . "'. Here are the buyer's details:\n\nEmail: $buyer_email";

    send_email($buyer_email, $buyer_subject, $buyer_message);
    send_email($seller_email, $seller_subject, $seller_message);
}
?>
