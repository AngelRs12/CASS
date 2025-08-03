<?php
session_start();
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'] . '/cass/configs/connectDB.php');

$correoUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';

if (!$correoUsuario) {
    echo json_encode([]);
    exit;
}


$sql = "SELECT folio, tipo, TO_CHAR(fechaSolicitud, 'YYYY-MM-DD') as fecha, estado, COALESCE(comentarios, '') as comentarios 
        FROM solicitudes WHERE usuarioMail = :correo";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':correo', $correoUsuario);
$stmt->execute();

$solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($solicitudes);
?>
