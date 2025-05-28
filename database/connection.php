<?php
$host = 'localhost';      // or 127.0.0.1
$db   = 'exhibition_db';
$user = 'root';           // your MySQL username
$pass = '';               // your MySQL password (leave blank for XAMPP default)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
