<?php
session_start();
<<<<<<< HEAD
require_once "../configs/connectDB.php"; // asegúrate del nombre correcto
header("Content-Type: application/json");
=======
include($_SERVER['DOCUMENT_ROOT'] . '/cass/configs/connectDB.php');
header('Content-Type: application/json');
>>>>>>> 1f46bbd104b3cef27572390c545cb7484e3378a9

$input = json_decode(file_get_contents('php://input'), true);
$correo = trim($input['correo']);
$password = $input['password'];

<<<<<<< HEAD
    $correo = trim($_POST["Correo"] ?? '');
    $password = trim($_POST["password"] ?? '');

    if (empty($correo) || empty($password)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Validar formato de correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Formato de correo inválido.");
    }

    // Buscar usuario por correo
    $query = "SELECT idUsuario, mail, contra, tipo 
              FROM usuarios 
              WHERE mail = :mail";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":mail", $correo, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar credenciales
    if (!$user || !password_verify($password, $user["contra"])) {
        throw new Exception("Correo o contraseña incorrectos.");
    }

    // Guardar datos en sesión
    $_SESSION["usuario"] = $user["mail"];
    $_SESSION["user_id"] = $user["idUsuario"];
    $_SESSION["tipo"] = $user["tipo"];
    $_SESSION["nombre_usuario"] = $user["mail"]; // O un campo de nombre si lo tienes

    echo json_encode(["success" => true]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8')
    ]);
}
=======
if (empty($correo) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
    exit;
}

try {
    $stmt = $conn->prepare("SELECT idUsuario, mail, contra, tipo FROM usuarios WHERE mail = :mail");
    $stmt->bindParam(':mail', $correo, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        echo json_encode(['success' => false, 'message' => 'Correo o contraseña incorrectos']);
        exit;
    }

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $user['contra'])) {
        $_SESSION['idUsuario'] = $user['idusuario'];
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
>>>>>>> 1f46bbd104b3cef27572390c545cb7484e3378a9
