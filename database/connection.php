<?php
$host = 'localhost';
$db   = 'exhibition_db';
$user = 'root';
$pass = ''; // leave it blank as you said
$charset = 'utf8mb4';

try {
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
