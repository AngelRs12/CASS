<?php
session_start();
header('Content-Type: application/json');

require_once "../configs/connectDB.php"; // tu conexión a DB

// Leer datos JSON
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['id'])) {
    echo json_encode(["error" => "ID no proporcionado."]);
    exit;
}

$id = intval($input['id']); // asegurar que sea número

try {
    // Opcional: verificar que exista primero
    $stmt = $conn->prepare("SELECT id, ruta FROM noticias_eventos WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$registro) {
        echo json_encode(["error" => "Registro no encontrado."]);
        exit;
    }

    // Eliminar imagen del servidor si existe
    if (!empty($registro['ruta']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $registro['ruta'])) {
        unlink($_SERVER['DOCUMENT_ROOT'] . $registro['ruta']);
    }

    // Eliminar registro de la base de datos
    $stmt = $conn->prepare("DELETE FROM noticias_eventos WHERE id = :id");
    $stmt->execute([':id' => $id]);

    echo json_encode(["success" => true]);

} catch(PDOException $e) {
    echo json_encode(["error" => "Error al eliminar: " . $e->getMessage()]);
}
