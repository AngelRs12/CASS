<?php
session_start();
header('Content-Type: application/json');
require_once($_SERVER['DOCUMENT_ROOT'] . '/cass/configs/connectDB.php');

// Solo rol 1 puede editar
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 1) {
    echo json_encode(["success" => false, "message" => "No autorizado"]);
    exit;
}

$folio      = $_POST['folio'] ?? null;
$estado     = $_POST['estado'] ?? null;
$comentarios= $_POST['comentarios'] ?? '';
$atendio = $_SESSION['idUsuario'] ?? null;

if (!$folio || !$estado) {
    echo json_encode(["success" => false, "message" => "Datos incompletos"]);
    exit;
}

try {
    $sql = "UPDATE solicitudes 
            SET estado = :estado, comentarios = :comentarios, atendidopor = :atendio
            WHERE folio = :folio";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':estado' => $estado,
        ':comentarios' => $comentarios,
        ':folio' => $folio,
        ':atendio' => $atendio
    ]);

    echo json_encode(["success" => true]);

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
