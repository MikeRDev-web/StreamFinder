<?php

$host = 'localhost';
$dbname = '***';
$username = '***';
$password = '***';

try {
    $connect = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

?>
