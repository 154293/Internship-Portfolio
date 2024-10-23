<?php

$host = 'localhost';
$dbname = 'foodblog';
$username = 'bit_academy';
$password = 'bit_academy';
$charset = 'utf8mb4';

$dsn = "mysql:host=" . $host . ";dbname=" . $dbname . ";";

try {
    $pdo = new PDO($dsn, $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection Succesful";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
