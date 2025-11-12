<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "onlinestore";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the last inserted record
$sql = "SELECT * FROM users1 ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

// Store result to be used in HTML below
$lastUser = null;
if ($result && $result->num_rows > 0) {
    $lastUser = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Last Registered User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

body {
    margin: 0;
    padding: 0;
    font-family: 'Inter', sans-serif;
    background: linear-gradient(to right, #dfe9f3, #ffffff);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #1f2937;
}

.user-card {
    backdrop-filter: blur(12px);
    background: rgba(255, 255, 255, 0.75);
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
    border-radius: 16px;
    padding: 40px;
    width: 100%;
    max-width: 720px;
    animation: fadeIn 0.6s ease-in-out;
    transition: all 0.3s ease;
}

.user-card h2 {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 30px;
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 12px;
    color: #111827;
    letter-spacing: 0.3px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
}

.info-box {
    background: #f9fafb;
    border-radius: 12px;
    padding: 18px 22px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
}

.info-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
}

.info-box-label {
    font-size: 13px;
    text-transform: uppercase;
    color: #6b7280;
    margin-bottom: 6px;
    letter-spacing: 0.6px;
}

.info-box-value {
    font-size: 17px;
    font-weight: 500;
    color: #111827;
}

.no-records {
    background-color: #fff1f0;
    border-left: 6px solid #ff4d4f;
    border-radius: 12px;
    color: #a8071a;
    font-size: 16px;
    padding: 25px;
    text-align: center;
    max-width: 600px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
}

@media screen and (max-width: 480px) {
    .user-card {
        padding: 25px 20px;
    }

    .user-card h2 {
        font-size: 22px;
    }

    .info-box {
        padding: 14px 16px;
    }

    .info-box-value {
        font-size: 16px;
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}



    </style>
</head>
<body>

<?php if ($lastUser): ?>
    <div class="user-card">
        <h2>Latest Registered User</h2>
        <div class="info-grid">
            <div class="info-box">
                <div class="info-box-label">ID</div>
                <div class="info-box-value"><?= $lastUser['id'] ?></div>
            </div>
            <div class="info-box">
                <div class="info-box-label">Name</div>
                <div class="info-box-value"><?= htmlspecialchars($lastUser['name']) ?></div>
            </div>
            <div class="info-box">
                <div class="info-box-label">Email</div>
                <div class="info-box-value"><?= htmlspecialchars($lastUser['email']) ?></div>
            </div>
            <div class="info-box">
                <div class="info-box-label">Address</div>
                <div class="info-box-value"><?= htmlspecialchars($lastUser['address']) ?></div>
            </div>
            <div class="info-box">
                <div class="info-box-label">Phone</div>
                <div class="info-box-value"><?= htmlspecialchars($lastUser['phone']) ?></div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="no-records">No records found.</div>
<?php endif; ?>


</body>
</html>
