<?php
session_start(); // Start the session

// Database credentials
$servername = "localhost";
$db_username = "root"; // Default XAMPP username
$db_password = "";     // Default XAMPP password
$dbname = "user_database";

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare the SQL statement to fetch the user
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Fetch the user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to a protected page (e.g., dashboard.php)
            header("Location: dashboard.php");
            exit();
        } else {
            // Incorrect password
            header("Location: login.php?error=Incorrect username or password");
            exit();
        }
    } else {
        // User not found
        header("Location: login.php?error=Incorrect username or password");
        exit();
    }
} else {
    // If the script is accessed directly without a POST request
    header("Location: login.php");
    exit();
}
?>