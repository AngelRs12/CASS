<?php
session_start();
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'] . '/cass/configs/connectDB.php');

$usuario = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : '';
$rol     = isset($_SESSION['tipo']) ? $_SESSION['tipo'] : '0';

if (!$usuario) {
    echo json_encode([]);
    exit;
}

    if ($rol == 1) {
        
        $sql = "SELECT s.folio, s.tipo, TO_CHAR(s.fechaSolicitud, 'YYYY-MM-DD') as fecha, s.estado, 
                       COALESCE(s.comentarios, '') as comentarios, concat(u.nombre,' ', u.ap_pat) as atendido
                FROM solicitudes s left join usuarios u on u.idusuario = s.atendidopor order by s.folio asc";
        $stmt = $conn->prepare($sql);
    } else {
        
        $sql = "SELECT folio, tipo, TO_CHAR(fechaSolicitud, 'YYYY-MM-DD') as fecha, estado, 
                       COALESCE(comentarios, '') as comentarios 
                FROM solicitudes 
                WHERE idusuario = :usr order by folio asc";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usr', $usuario, PDO::PARAM_INT);
    }

    $stmt->execute();
    $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($solicitudes);

