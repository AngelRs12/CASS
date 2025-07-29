<?php
session_start();
require_once "../config/db.php";
header("Content-Type: application/json");

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Método no permitido.");
    }

    $usuario = trim($_POST["usuario"] ?? '');
    $contraseña = trim($_POST["contraseña"] ?? '');

    if (empty($usuario) || empty($contraseña)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    if (!preg_match('/^[a-zA-Z0-9_]{4,50}$/', $usuario)) {
        throw new Exception("Formato de usuario inválido.");
    }

    $query = "SELECT idUsuario, usuario, contra, idRol FROM usuarios WHERE usuario = :usuario AND activo = TRUE";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($contraseña, $user["contra"])) {
        throw new Exception("Usuario o contraseña incorrectos.");
    }

    $_SESSION["usuario"] = $usuario;
    $_SESSION["user_id"] = $user["idusuario"];
    $_SESSION["rol"] = $user["idrol"];

    if ($user["idrol"] == 3) {
        $stmtDoctor = $conn->prepare("SELECT iddoctor, nombre FROM doctores WHERE idUsuario = :idUsuario");
        $stmtDoctor->bindParam(":idUsuario", $user["idusuario"], PDO::PARAM_INT);
        $stmtDoctor->execute();
        $doctor = $stmtDoctor->fetch(PDO::FETCH_ASSOC);
        $_SESSION["nombre_usuario"] = $doctor ? $doctor["nombre"] : $usuario;
        $_SESSION["id_doctor"] = $doctor["iddoctor"] ?? null;
    } else {
        $_SESSION["nombre_usuario"] = $usuario;
    }

    echo json_encode(["success" => true]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8')
    ]);
}

?>


