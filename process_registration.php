<?php
// Database credentials
$servername = "localhost";
$db_username = "root"; // Default XAMPP username
$db_password = "";     // Default XAMPP password
$dbname = "user_database";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST["new_username"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    // Basic input validation (you can add more robust validation)
    if (empty($newUsername) || empty($newPassword) || $newPassword !== $confirmPassword) {
        header("Location: register.php?error=Please fill all fields correctly.");
        exit();
    }

    // Check if the username already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->bindParam(':username', $newUsername);
    $stmt->execute();

    if ($stmt->fetchColumn() > 0) {
        header("Location: register.php?error=Username already exists. Please choose another one.");
        exit();
    }

    // Hash the password securely
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert the new user
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $newUsername);
    $stmt->bindParam(':password', $hashedPassword);

    if ($stmt->execute()) {
        // Registration successful, redirect to the login page with a success message
        header("Location: login.php?registration_success=Account created successfully. You can now log in.");
        exit();
    } else {
        // Registration failed
        header("Location: register.php?error=Registration failed. Please try again.");
        exit();
    }
} else {
    // If the script is accessed directly without a POST request
    header("Location: register.php");
    exit();
}
?>