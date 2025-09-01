<?php
session_start();
header('Content-Type: application/json');

// Incluir conexión a PostgreSQL
require_once "../configs/connectDB.php"; // ajusta la ruta según tu proyecto

try {
    // Consultar todas las noticias y eventos
    $stmt = $conn->prepare("SELECT id, tipo, titulo, contenido, ruta, lasteditdt 
                            FROM noticias_eventos
                            ORDER BY lasteditdt DESC");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Separar por tipo
    $noticias = [];
    $eventos = [];
    foreach ($result as $item) {
        if ($item['tipo'] === 'noticia') {
            $noticias[] = $item;
        } elseif ($item['tipo'] === 'evento') {
            $eventos[] = $item;
        }
    }

    echo json_encode([
        "success" => true,
        "noticias" => $noticias,
        "eventos" => $eventos
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

} catch(PDOException $e) {
    echo json_encode([
        "success" => false,
        "error" => "Error al consultar la base de datos: " . $e->getMessage()
    ]);
}
