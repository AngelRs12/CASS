<?php
session_start();
header('Content-Type: application/json');

require_once($_SERVER['DOCUMENT_ROOT'] . "/cass/configs/connectDB.php");

try {
    $sql = "SELECT iddepto, nombre, descripcion, horario, contacto, ubicacion, imagen 
            FROM departamentos 
            ORDER BY iddepto ASC";
    $stmt = $conn->query($sql);
    $departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($departamentos, JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Error al cargar departamentos"]);
}
