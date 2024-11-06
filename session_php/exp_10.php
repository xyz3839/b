<?php
session_start(); // Start the session

// Database connection settings
$host = 'localhost';
$db = 'testdb'; // Your database name
$user = 'root'; // Change as necessary
$pass = 'root'; // Change as necessary

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_SESSION['username'])) {
    echo "<div class='result'>";
    echo "<strong>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</strong><br>";
    echo "<div class='logout'><a href='?logout=true' style='text-decoration:none; color:#4A90E2;'>Logout</a></div>";
    echo "</div>";
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Prepare and execute the insert statement
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => $username, 'password' => $password]);

        // Set session variable
        $_SESSION['username'] = $username;
        header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page
        exit;
    }
?>
    <form method="POST">
        <input type="text" name="username" placeholder="Enter your name" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
<?php
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page
    exit;
}
?>
