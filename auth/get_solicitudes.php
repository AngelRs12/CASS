<?php
session_start();
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'] . '/cass/configs/connectDB.php');

$usuario = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : '';

if (!$usuario) {
    echo json_encode([]);
    exit;
}


$sql = "SELECT folio, tipo, TO_CHAR(fechaSolicitud, 'YYYY-MM-DD') as fecha, estado, COALESCE(comentarios, '') as comentarios 
        FROM solicitudes WHERE idusuario = :usr";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':usr', $usuario);
$stmt->execute();

$solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($solicitudes);
?>
