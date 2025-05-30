<?php
// Connect to your database
$host = "localhost";
$user = "root";
$pass = ""; // default for XAMPP
$db = "exhibition_system"; // make sure this matches your database name

$conn = new mysqli($host, $user, $pass, $db);

// Check DB connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from request
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validate inputs
if (empty($name) || empty($email) || empty($password)) {
  echo "All fields are required.";
  exit;
}

// Check if email already exists
$sql = "SELECT * FROM officials WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  echo "Email is already registered.";
  exit;
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert new official
$insert = "INSERT INTO officials (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($insert);
$stmt->bind_param("sss", $name, $email, $hashedPassword);

if ($stmt->execute()) {
  echo "success";
} else {
  echo "Registration failed. Try again.";
}

$conn->close();
?>
