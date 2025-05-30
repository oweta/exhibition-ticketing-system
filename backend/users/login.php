<?php
session_start();
require_once '../../database/connection.php'; // Adjust path to your connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo "Email and password are required.";
        exit;
    }

    try {
        // Fetch official by email
        $stmt = $pdo->prepare("SELECT * FROM officials WHERE email = ?");
        $stmt->execute([$email]);
        $official = $stmt->fetch();

        if ($official && password_verify($password, $official['password'])) {
            // Password is correct, start session
            $_SESSION['official_id'] = $official['id'];
            $_SESSION['official_name'] = $official['name'];
            echo "success"; // Signal to frontend that login worked
        } else {
            echo "Invalid email or password.";
        }
    } catch (PDOException $e) {
        echo "Login failed: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
