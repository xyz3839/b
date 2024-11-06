<?php
session_start(); // Start the session

// Database connection settings
$host = 'localhost';
$db = 'CookieManagement'; // Your database name
$user = 'root'; // Change as necessary
$pass = 'root'; // Change as necessary

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $name = htmlspecialchars($_POST['name']);
    $expiration = time() + ($_POST['expiration'] * 60); // Convert minutes to seconds
    $color = htmlspecialchars($_POST['color']);

    // Set cookies for username, color, and last visit time
    setcookie("username", $name, $expiration, "/"); // Cookie will be available site-wide
    setcookie("color", $color, $expiration, "/");
    setcookie("lastVisit", date("Y-m-d H:i:s"), $expiration, "/");

    // Insert user data into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, color, last_visit) VALUES (:username, :color, :last_visit)");
    $stmt->execute([
        'username' => $name,
        'color' => $color,
        'last_visit' => date("Y-m-d H:i:s") // Store current time as last visit
    ]);

    header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page
    exit;
}

// Check if cookies are set
$username = isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : '';
$lastVisit = isset($_COOKIE['lastVisit']) ? htmlspecialchars($_COOKIE['lastVisit']) : '';
$themeColor = isset($_COOKIE['color']) ? htmlspecialchars($_COOKIE['color']) : '#f0f0f0';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced PHP Cookie Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: <?= $themeColor ?>;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        h1 {
            color: #4A90E2;
            font-size: 2em;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="number"],
        select {
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .clear {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Enhanced Cookie Management</h1>

        <?php if ($username): ?>
            <div class="result">
                <strong>Welcome back, <?= $username ?>!</strong><br>
                <?php if ($lastVisit): ?>
                    <small>Last visit: <?= $lastVisit ?></small>
                <?php endif; ?>
                <div class="clear">
                    <a href="?clear=true" style="text-decoration:none; color:#4A90E2;">Clear Cookie</a>
                </div>
            </div>
        <?php else: ?>
            <form method="POST">
                <input type="text" name="name" placeholder="Enter your name" required>
                <label for="expiration">Cookie Expiration (minutes):</label>
                <input type="number" name="expiration" value="60" min="1" required>
                
                <label for="color">Select Theme Color:</label>
                <select name="color" required>
                    <option value="#f0f0f0">Default</option>
                    <option value="#fdd835">Yellow</option>
                    <option value="#4A90E2">Blue</option>
                    <option value="#8bc34a">Green</option>
                    <option value="#e57373">Red</option>
                </select>
                
                <button type="submit">Set Cookie</button>
            </form>
        <?php endif; ?>

        <?php
        // Clear cookies if requested
        if (isset($_GET['clear'])) {
            setcookie("username", "", time() - 3600, "/");
            setcookie("color", "", time() - 3600, "/");
            setcookie("lastVisit", "", time() - 3600, "/");
            header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page
            exit;
        }
        ?>
    </div>
</body>
</html>
