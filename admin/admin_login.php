<?php
// Include database connection file
include("../config/db.php");

session_start(); // Start the session to manage login state

$error = ""; // Initialize an error variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input data from the form
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]); // Plain password

    // Prepare SQL query to get the user details by email
    $stmt = $conn->prepare("SELECT * FROM users1 WHERE email = ?");
    
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    // Bind the parameter (email)
    $stmt->bind_param("s", $email);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the given email exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password using password_hash() and password_verify()
        if (password_hash($password, $user['password'])) { // Correct password
            // Login successful, set session variables
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $user['email']; // You can change this to the username if available

            // Redirect to admin dashboard
            header("Location: admin_dashboard.php");
            exit(); // Make sure no further code is executed after the redirect
        } else {
            $error = "Invalid credentials. Please try again.";
        }
    } else {
        $error = "No user found with that email address.";
    }

    // Close the statement
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom, #06A4A3, #0E307A);
            font-family: 'Arial', sans-serif;
        }

        .login-form-container {
            background-color: white;
            padding: 40px 50px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            width: 400px;
        }

        .login-form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 28px;
        }

        .input-field {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            outline: none;
            transition: border 0.3s ease;
        }

        .input-field:focus {
            border-color: #05b8d0;
        }

        .login-button {
            width: 100%;
            padding: 15px;
            background-color: #05b8d0;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-button:hover {
            background-color: #034f5f;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #05b8d0;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        img{

            width: 30px;
            margin-left: 60px;
            margin-bottom: -30px;
        }

    </style>
</head>
<body>

    <div class="login-form-container">
        <img src="loginn.png" alt="">
        <h2>Login</h2>
        <form method="POST" action="">
            <input type="email" name="email" class="input-field" placeholder="Enter your email" required>
            <input type="password" name="password" class="input-field" placeholder="Enter your password" required>
            <button class="login-button" type="submit">Login</button>
        </form>

        <div class="forgot-password">
            <a href="#">Forgot Password?</a>
        </div>
    </div>

</body>
</html>




