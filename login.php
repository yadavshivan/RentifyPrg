<?php include('includes/header.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('includes/db.php');
    require('includes/functions.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['user_type'];

        if (is_seller()) {
            header('Location: seller/dashboard.php');
        } elseif (is_buyer()) {
            header('Location: buyer/properties.php');
        } else {
            // Handle other user types (if any)
            // Redirect them to a default page or show an error message
            header('Location: index.php');
        }

        exit;
    } else {
        display_error_message("Invalid email or password.");
    }

}
?>
<style>
    /* Custom styles for the login form */
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 20vh; /* Full viewport height */
    }

    .login-form {
        width: 300px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        height: 40px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 10px;
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
</style>

<div class="container">
    <form class="login-form" action="login.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
