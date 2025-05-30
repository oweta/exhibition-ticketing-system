<?php
$host = '127.0.0.1';
$port = '3307'; // <-- Important: XAMPP is using port 3307
$db   = 'exhibition_db';
$user = 'root';
$pass = 'YOUR_PASSWORD'; // Replace with the password you set for root
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connected successfully to exhibition_db";
} catch (\PDOException $e) {
    throw new \PDOException("Database connection failed: " . $e->getMessage(), (int)$e->getCode());
}
