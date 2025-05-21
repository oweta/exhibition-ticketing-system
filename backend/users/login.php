<?php
require_once '../db/connection.php';

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'];
$password = $data['password'];

try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Login successful
        echo json_encode([
            "message" => "Login successful.",
            "user" => [
                "id" => $user['id'],
                "name" => $user['full_name'],
                "email" => $user['email'],
                "role" => $user['role']
            ]
        ]);
    } else {
        // Login failed
        echo json_encode(["error" => "Invalid email or password."]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Login error: " . $e->getMessage()]);
}
?>
