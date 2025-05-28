<?php
$host = 'localhost';      // or 127.0.0.1
$db   = 'exhibition_db';
$user = 'root';
$pass = '';               // Leave empty for default XAMPP setup

try {
    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
