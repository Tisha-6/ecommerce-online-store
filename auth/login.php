<?php
session_start();
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT id, name, password FROM users1 WHERE email = ?");

    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error); // Check for prepare errors
    }

    // Bind the email parameter
    $stmt->bind_param("s", $email);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            header("Location: ../index.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No user found with this email!";
    }

    $stmt->close(); // Close the statement
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Online Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(90deg, rgb(57, 190, 202) 0%, rgb(23, 142, 182) 100%);
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

        /* Navbar Styling */
        .navbar {
            background: linear-gradient(90deg, rgb(57, 190, 202) 0%, rgb(23, 142, 182) 66%);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: bold;
            color: black !important;
        }

        .nav-link {
            color: black !important;
            font-weight: 500;
        }

        .nav-link:hover {
            opacity: 0.8;
        }

        /* Login Box */
        .login-box {
            z-index: 2;
            width: 90%;
            max-width: 400px;
            padding: 30px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            background: rgba(255, 254, 254, 0.15);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin-top: 80px;
            /* Adjusted for navbar */
        }

        .login-box h3 {
            font-weight: bold;
            color: black;
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
            background: rgba(254, 254, 254, 0.3);
            color: #fff;
            box-shadow: none;
        }

        ::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }

        .btn-login {
            background: linear-gradient(135deg, rgb(57, 190, 202), rgb(23, 142, 182));
            border: none;
            padding: 12px;
            border-radius: 50px;
            font-size: 1.1rem;
            color: black;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0 0 10px rgba(52, 201, 187, 0.6);
        }

        .btn-login:hover {
            background: linear-gradient(90deg, rgb(57, 190, 202) 0%, rgb(23, 142, 182) 66%);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
        }


        .error-message {
            color: #ff8585;
            font-weight: bold;
            margin-bottom: 15px;
        }

        

        .text-light a {
            color: rgb(48, 216, 199);
            text-decoration: none;
            transition: 0.3s;
        }

        .text-light a:hover {
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 10px;
            }

            .login-box {
                width: 90%;
                padding: 20px;
            }

            .btn-login {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">E-Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-white" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="products.php">Products</a></li>

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

    <!-- Login Box -->
    <div class="login-box">
        <h3>Login</h3>
        
        <?php if (isset($error)) {
            echo '<p class="error-message">' . $error . '</p>';
        } ?>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>
        <p class="text-light mt-3">Don't have an account? <a href="register.php">Register</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>