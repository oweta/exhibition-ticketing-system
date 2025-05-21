<?php
require_once '../db/connection.php';

// Get user input
$data = json_decode(file_get_contents("php://input"), true);

$full_name = $data['full_name'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_BCRYPT);
$role = isset($data['role']) ? $data['role'] : 'customer';

try {
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$full_name, $email, $password, $role]);

    echo json_encode(["message" => "User registered successfully."]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Registration failed: " . $e->getMessage()]);
}
?>
