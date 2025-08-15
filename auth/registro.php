<?php
include($_SERVER['DOCUMENT_ROOT'] . '/cass/configs/connectDB.php');
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$usuario = trim($input['usuario']);
$contrasena = $input['contrasena'];
$nombre = $input['nombre'];
$appat = $input['appat'];
$apmat = $input['apmat'];

// Validaciones extra de seguridad
if (!preg_match('/^[a-zA-Z0-9._%+-]+@cd\.te\.mx$/', $usuario)) {
    echo json_encode(['success' => false, 'message' => 'Correo no válido']);
    exit;
}

if (strlen($contrasena) < 5) {
    echo json_encode(['success' => false, 'message' => 'Contraseña muy corta']);
    exit;
}

// Verificar si el correo ya existe
$stmt = $conn->prepare("SELECT mail FROM usuarios WHERE mail = :mail");
$stmt->bindParam(':mail', $usuario, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo json_encode(['success' => false, 'message' => 'Este correo ya está registrado']);
    exit;
}

// Insertar usuario
$hash = password_hash($contrasena, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO usuarios (mail, contra, tipo, nombre,ap_pat,ap_mat) VALUES (:mail, :contra, '1',:nombre, :appat,:apmat)");
$stmt->bindParam(':mail', $usuario, PDO::PARAM_STR);
$stmt->bindParam(':contra', $hash, PDO::PARAM_STR);
$stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$stmt->bindParam(':appat', $appat, PDO::PARAM_STR);
$stmt->bindParam(':apmat', $apmat, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar']);
}
?>
