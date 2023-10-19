<?php
$HOST = "db";
$PORT = 3306;
$DBNAME = "bookingsystem";
$USERNAME = "root";
$PASSWORD = "root";
try {
    $pdo = new PDO("mysql:host=$HOST;port=$PORT;dbname=$DBNAME", $USERNAME, $PASSWORD);

    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
