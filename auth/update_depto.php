<?php
session_start();
header('Content-Type: application/json');
require_once($_SERVER['DOCUMENT_ROOT'] . "/cass/configs/connectDB.php");

// Verificar rol
if (!isset($_SESSION['tipo']) || intval($_SESSION['tipo']) !== 1) {
    http_response_code(403);
    echo json_encode(["success" => false, "message" => "No autorizado"]);
    exit;
}

// Solo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
    exit;
}

$accion = $_POST['accion'] ?? 'guardar';

try {
    if ($accion === "eliminar") {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null || $id <= 0) {
            throw new Exception("ID inválido");
        }

        $stmt = $conn->prepare("DELETE FROM departamentos WHERE iddepto = ?");
        $stmt->execute([$id]);

        echo json_encode(["success" => true]);
        exit;
    } else {
        $isNew = isset($_POST['isNew']) && $_POST['isNew'] === "1";

        // Imagen
        $imagenPath = "";
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/cass/assets/Img/departamentos/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }
            $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid("depto_") . "." . strtolower($ext);
            $destino = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
                $imagenPath = "/cass/assets/Img/departamentos/" . $fileName;
            }
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $horario = trim($_POST['horario'] ?? '');
        $contacto = trim($_POST['contacto'] ?? '');
        $ubicacion = trim($_POST['ubicacion'] ?? '');
        // usar imagen_actual si no se subió nueva
        $imagen = $imagenPath ?: trim($_POST['imagen_actual'] ?? '');

        if ($isNew) {
            $stmt = $conn->prepare("INSERT INTO departamentos (nombre, descripcion, horario, contacto, ubicacion, imagen) 
                                   VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $descripcion, $horario, $contacto, $ubicacion, $imagen]);
        } else {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            if ($id === false || $id === null || $id <= 0) {
                throw new Exception("ID inválido");
            }

            $stmt = $conn->prepare("UPDATE departamentos 
                                   SET nombre = ?, descripcion = ?, horario = ?, contacto = ?, ubicacion = ?, imagen = ?, lastedit = NOW()
                                   WHERE iddepto = ?");
            $stmt->execute([$nombre, $descripcion, $horario, $contacto, $ubicacion, $imagen, $id]);
        }

        echo json_encode(["success" => true]);
        exit;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
