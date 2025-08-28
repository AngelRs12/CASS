<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/cass/configs/connectDB.php');
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$correo = trim($input['correo']);
$password = $input['password'];

if (empty($correo) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
    exit;
}

try {
    $stmt = $conn->prepare("SELECT idUsuario,nombre,ap_pat, mail, contra, tipo FROM usuarios WHERE mail = :mail");
    $stmt->bindParam(':mail', $correo, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        echo json_encode(['success' => false, 'message' => 'Correo o contraseña incorrectos']);
        exit;
    }

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $user['contra'])) {
        $_SESSION['idUsuario'] = $user['idusuario'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['apellido'] = $user['ap_pat'];
        $_SESSION['correo'] = $user['mail'];
        $_SESSION['tipo'] = $user['tipo'];

        echo json_encode(['success' => true, 'message' => 'Inicio de sesión exitoso']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Correo o contraseña incorrectos']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error en el servidor']);
}
?>
