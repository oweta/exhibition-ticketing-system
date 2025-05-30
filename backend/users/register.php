<?php
// Include the database connection file
require_once '../database/connection.php'; // adjust the path if needed

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form inputs
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($name) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    try {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM officials WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            echo "Email already registered.";
            exit;
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert official into the database
        $stmt = $pdo->prepare("INSERT INTO officials (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $hashed_password]);

        echo "success"; // front-end checks for this
    } catch (PDOException $e) {
        echo "Registration failed: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
