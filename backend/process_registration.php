<?php
// Enable CORS if you're testing from different ports
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

// Step 1: Include database connection
require_once(__DIR__ . "/../database/connection.php");

// Step 2: Capture and sanitize POST data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';

// Step 3: Simple validation
if (empty($name) || empty($email) || empty($phone)) {
    echo json_encode(["success" => false, "message" => "All fields are required."]);
    exit;
}

// Step 4: Prepare and execute query
$sql = "INSERT INTO users (name, email, phone) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $phone);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Registration successful!"]);
} else {
    echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
}

$stmt->close();
$conn->close();
