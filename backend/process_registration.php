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
$ticket_type = isset($_POST['ticket_type']) ? trim($_POST['ticket_type']) : '';

// Step 3: Simple validation
if (empty($name) || empty($email) || empty($phone) || empty($ticket_type)) {
    echo json_encode(["success" => false, "message" => "All fields are required."]);
    exit;
}

// Step 4: Prepare and execute query
$sql = "INSERT INTO users (name, email, phone, ticket_type) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $phone, $ticket_type);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Registration successful!"]);
} else {
    echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
}

$stmt->close();
$conn->close();
