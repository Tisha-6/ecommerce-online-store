<?php

$servername = "localhost"; // Change if your database is hosted elsewhere
$username = "root"; // Change this if using a different MySQL user
$password = ""; // Change if you have set a password
$database = "onlinestore"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $address = trim($_POST["address"]);
    $phone = trim($_POST["phone"]);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    }

    // Validate phone number (simple example, adjust pattern as needed)
    if (!preg_match("/^\+?[0-9]{10,15}$/", $phone)) {
        $error = "Invalid phone number.";
    }

    // Check if email already exists
    if (!isset($error)) {
        $check_email = $conn->prepare("SELECT * FROM users1 WHERE email = ?");
        $check_email->bind_param("s", $email);
        $check_email->execute();
        $result = $check_email->get_result();

        if ($result->num_rows > 0) {
            $error = "Email is already registered!";
        }
    }

    // If no errors, hash the password and insert into the database
    if (!isset($error)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Use prepared statement to insert the data
        $stmt = $conn->prepare("INSERT INTO users1 (name, email, password, address, phone) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $hashed_password, $address, $phone);  // Bind all parameters

        if ($stmt->execute()) {
            $_SESSION["user_id"] = $stmt->insert_id;
            $_SESSION["user_name"] = $name;
            header("Location: login.php");
            exit();
        } else {
            $error = "Registration failed! Please try again.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Online Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(90deg, rgb(52, 201, 187) 0%, rgb(24, 90, 157) 100%);
            position: relative;
            color: white;
            /* Ensures text is readable on the gradient background */
        }

        /* Dark Overlay */
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            top: 0;
            left: 0;
            z-index: 1;
        }

        /* navbar styling*/
        .navbar {
            background: linear-gradient(90deg, rgb(52, 201, 187) 0%, rgb(24, 90, 157) 66%);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: bold;
            color: white !important;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
        }

        .nav-link:hover {
            opacity: 0.8;
        }

        /* Glassmorphic Container */
        .register-box {
            z-index: 2;
            width: 90%;
            max-width: 400px;
            padding: 30px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin-top: 80px;
            /* Adjusted for navbar*/
        }

        .register-box h3 {
            font-weight: bold;
            color: #fff;
            margin-bottom: 20px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
            border-radius: 8px;
            transition: 0.3s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            color: #fff;
            box-shadow: none;
        }

        ::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }

        .btn-register {
            background: linear-gradient(135deg, rgb(52, 201, 187), rgb(24, 90, 157));
            border: none;
            padding: 12px;
            border-radius: 50px;
            font-size: 1.1rem;
            color: white;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0 0 10px rgba(52, 201, 187, 0.6);

        }

        .btn-register:hover {
            background: linear-gradient(135deg, rgb(24, 90, 157), rgb(52, 201, 187));
            box-shadow: 0 0 15px rgba(24, 90, 157, 0.8);
        }

        .error-message {
            color: #ff8585;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .text-light a {
            color: rgb(52, 201, 187);
            text-decoration: none;
            transition: 0.3s;
        }

        .text-light a:hover {
            color: #fff;
        }
    </style>
</head>

<body>



    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.html">E-Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item"><a class="nav-link text-white" href="../index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="products.html">Products</a></li>

                    <?php if (isset($_SESSION["user_id"])): ?>
                        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Registration Form -->
    <div class="register-box">
        <h3>Register</h3>
        <?php if (isset($error)) {
            echo '<p class="error-message">' . $error . '</p>';
        } ?>
        <form action="register.php" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Full Name" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="address" placeholder="Address" required>
            </div>
            <div class="mb-3">
                <input type="tel" class="form-control" name="phone" placeholder="Phone Number" required>
            </div>

            <button type="submit" class="btn btn-register w-100">Register</button>
        </form>
        <p class="text-light mt-3">Already have an account? <a href="login.php">Login</a></p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


