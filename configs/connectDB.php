<?php
$host = 'localhost';
$db = 'cass';
$user = 'postgres';
$pass = '12345';
$dsn = "pgsql:host=$host;dbname=$db";

try {
    $conn = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}
?>
