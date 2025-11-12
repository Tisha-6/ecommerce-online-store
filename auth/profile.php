<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - E-commerce</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 20px;
        }

        header nav ul {
            list-style: none;
            display: flex;
            justify-content: flex-start;
        }

        header nav ul li {
            margin-right: 20px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
        }

        .profile-container {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-header h1 {
            font-size: 24px;
            font-weight: bold;
        }

        #editProfileBtn {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        #editProfileBtn:hover {
            background-color: #0056b3;
        }

        .profile-details {
            margin-bottom: 20px;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        ul {
            list-style: none;
        }

        ul li {
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/shop">Shop</a></li>
                <li><a href="/profile">Profile</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="profile-container">
        <div class="profile-header">
            <h1>Welcome, John Doe</h1>
            <button id="editProfileBtn">Edit Profile</button>
        </div>

        <div class="profile-details">
            <h2>Account Information</h2>
            <ul>
                <li><strong>Username:</strong> john_doe</li>
                <li><strong>Email:</strong> john@example.com</li>
                <li><strong>Phone:</strong> +1 234 567 890</li>
                <li><strong>Address:</strong> 123 Main St, City, Country</li>
            </ul>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 E-commerce. All rights reserved.</p>
    </footer>

    <script src="script.js">
        document.getElementById("editProfileBtn").addEventListener("click", function() {
    alert("You can add a feature to edit profile here.");
});

    </script>
</body>

</html>