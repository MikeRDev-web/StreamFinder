<?php

$host = 'localhost';
$dbname = 'streamfinder';
$username = 'mike';
$password = 'mangeL.123';

try {
    $connect = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

?>