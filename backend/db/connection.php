<?php
$host = 'localhost';      // or 127.0.0.1
$db   = 'exhibition_db';  // we’ll create this DB in MySQL later
$user = 'root';           // your MySQL username
$pass = '';               // your MySQL password (leave blank for XAMPP default)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Uncomment the line below if you want to confirm connection success
    // echo "Connected to the database successfully!";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit();
}
?>
