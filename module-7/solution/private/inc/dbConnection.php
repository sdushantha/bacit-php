<?php
$host = "db";
$port = 3306;
$dbname = "bookingsystem";
$username = "root";
$password = "root";
try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);

    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>