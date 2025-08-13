<?php
<<<<<<< HEAD
session_start();
require_once "../configs/connectDB.php"; // conexión a la BD
header("Content-Type: application/json");

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Método no permitido.");
    }

    $correo = trim($_POST["usuario"] ?? '');
    $password = trim($_POST["contrasena"] ?? '');
    $confirmar = trim($_POST["confirmar_contrasena"] ?? '');

    // Validar campos vacíos
    if (empty($correo) || empty($password) || empty($confirmar)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Validar formato de correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Formato de correo inválido.");
    }

    // Validar contraseñas iguales
    if ($password !== $confirmar) {
        throw new Exception("Las contraseñas no coinciden.");
    }

    // Verificar si el correo ya existe
    $query = "SELECT idUsuario FROM usuarios WHERE mail = :mail";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":mail", $correo, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        throw new Exception("El correo ya está registrado.");
    }

    // Hashear contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insertar nuevo usuario
    $insert = "INSERT INTO usuarios (mail, contra, tipo) VALUES (:mail, :contra, 'usuario')";
    $stmtInsert = $conn->prepare($insert);
    $stmtInsert->bindParam(":mail", $correo, PDO::PARAM_STR);
    $stmtInsert->bindParam(":contra", $passwordHash, PDO::PARAM_STR);

    if (!$stmtInsert->execute()) {
        throw new Exception("Error al registrar el usuario.");
    }

    // Guardar sesión automáticamente al registrarse
    $_SESSION["usuario"] = $correo;
    $_SESSION["user_id"] = $conn->lastInsertId();
    $_SESSION["tipo"] = "usuario";
    $_SESSION["nombre_usuario"] = $correo;

    echo json_encode(["success" => true]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8')
    ]);
}
=======
include($_SERVER['DOCUMENT_ROOT'] . '/cass/configs/connectDB.php');
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$usuario = trim($input['usuario']);
$contrasena = $input['contrasena'];

// Validaciones extra de seguridad
if (!preg_match('/^[a-zA-Z0-9._%+-]+@cd\.te\.mx$/', $usuario)) {
    echo json_encode(['success' => false, 'message' => 'Correo no válido']);
    exit;
}

if (strlen($contrasena) < 8) {
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

$stmt = $conn->prepare("INSERT INTO usuarios (mail, contra, tipo) VALUES (:mail, :contra, '1')");
$stmt->bindParam(':mail', $usuario, PDO::PARAM_STR);
$stmt->bindParam(':contra', $hash, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar']);
}
?>
>>>>>>> 1f46bbd104b3cef27572390c545cb7484e3378a9
