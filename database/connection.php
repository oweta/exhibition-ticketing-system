<?php
$host = '127.0.0.1';  // <<< instead of 'localhost'
$db   = 'exhibition_db';
$user = 'root';
$pass = '';           // leave blank since phpMyAdmin root has no password

try {
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
