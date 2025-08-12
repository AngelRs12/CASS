<?php
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'] . '/cass/configs/connectDB.php');

$usuarioCorreo = trim($_POST['usuarioMail'] ?? $_POST['usuariomail'] ?? '');
$tipo = trim($_POST['tipo'] ?? '');
$comentarios = trim($_POST['comentarios'] ?? '');

if (empty($usuarioCorreo) || empty($tipo)) {
    echo json_encode(["success" => false, "message" => "Todos los campos obligatorios deben completarse."]);
    exit;
}

try {
    $stmt = $conn ->prepare("SELECT idusuario FROM usuarios WHERE mail = :mail");
    $stmt->execute([':mail' => $usuarioCorreo]);
    $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuarioData) {
        echo json_encode(["success" => false, "message" => "El usuario no está registrado."]);
        exit;
    }

    $idUsuario = $usuarioData['idusuario'];

    $stmt = $conn ->prepare("
        INSERT INTO solicitudes (idusuario, tipo, comentarios)
        VALUES (:idusuario, :tipo, :comentarios)
    ");

    if ($stmt->execute([
        ':idusuario' => $idUsuario,
        ':tipo' => $tipo,
        ':comentarios' => $comentarios
    ])) {
        echo json_encode(["success" => true, "message" => "Solicitud registrada con éxito."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al registrar la solicitud."]);
    }

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error de base de datos: " . $e->getMessage()]);
}
