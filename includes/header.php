<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentify</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/rentify/css/styles.css">
    <style>
        /* Additional styles for the header */
        .navbar-brand {
            color: #3498db; /* Change the color as needed */
            font-weight: bold;
            font-size: 28px; /* Increased font size */
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #2980b9; /* Change the hover color as needed */
        }

        .navbar-nav .nav-link {
            color: #333; /* Change the color as needed */
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #555; /* Change the hover color as needed */
        }

        /* Animation for navbar */
        @keyframes slideInDown {
            0% {
                transform: translateY(-100%);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .navbar {
            animation: slideInDown 0.5s ease;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/rentify/index.php" style="font-size: 28px; color: #3498db;">Rentify</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item"><a class="nav-link" href="/rentify/includes/logout.php">Logout</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="/rentify/login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/rentify/register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="container">
    <!-- Your content goes here -->
</div>
</body>
</html>
