<?php

// Paràmetres de connexió
$DB_HOST = 'mysql';
$DB_NAME = 'videojocs_mvc';
$DB_USER = 'root';
$DB_PASS = 'root';

// Connexió amb PDO
$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die("Error de connexió: " . $e->getMessage());
}

?>