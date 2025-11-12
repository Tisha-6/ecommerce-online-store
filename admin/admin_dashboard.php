<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to login page if not logged in
    header("Location: admin_login.php"); // Redirect to the login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f7f9fc;
            padding: 50px 0;
        }

        .dashboard-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .dashboard-container h2 {
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
            font-size: 32px;
            text-align: center;
        }

        .card {
            border: none;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .card-body {
            text-align: center;
            padding: 30px;
        }

        .btn-logout {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 50px;
            width: 100%;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background-color: #c9302c;
        }

        .logout-container {
            text-align: center;
            margin-top: 20px;
        }

        .welcome-message {
            margin-bottom: 30px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="dashboard-container">
        <h2>Welcome to the Admin Dashboard</h2>

        <div class="welcome-message">
            <p>Hello, <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong>! You're logged in as an admin.</p>
        </div>

        <!-- Dashboard Content - Add more content like stats, user management, etc. here -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Admin Dashboard Overview</h5>
                <p class="card-text">You can manage your store, view reports, and more from the admin dashboard.</p>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="logout-container">
            <a href="logout.php">
                <button class="btn-logout">Logout</button>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
