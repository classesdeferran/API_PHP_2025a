<?php

$host = 'localhost';
$port = '3307';
$dbname = 'world';
$charset = 'utf8mb4';
$user = 'root';
$password = 'root';
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión establecida";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
} 
