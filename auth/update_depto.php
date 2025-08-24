<?php

session_start();
header('Content-Type: application/json');
// Verificar rol explícitamente
if (!isset($_SESSION['tipo']) || intval($_SESSION['tipo']) !== 1) {
    http_response_code(403);
    echo json_encode(["success" => false, "message" => "No autorizado"]);
    exit;
}

// Solo permitir POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
    exit;
}

$jsonFile = $_SERVER['DOCUMENT_ROOT'] . '/cass/assets/deptos.json';
if (!file_exists($jsonFile)) {
    echo json_encode(['success' => false, 'message' => 'Archivo JSON no encontrado']);
    exit;
}

$departamentos = json_decode(file_get_contents($jsonFile), true);
if (!is_array($departamentos)) {
    $departamentos = [];
}

$accion = $_POST['accion'] ?? 'guardar';

if ($accion === "eliminar") {
    $index = filter_input(INPUT_POST, 'index', FILTER_VALIDATE_INT);
    if ($index === false || !isset($departamentos[$index])) {
        echo json_encode(['success' => false, 'message' => 'Departamento no válido']);
        exit;
    }
    array_splice($departamentos, $index, 1);

} else {
    $isNew = isset($_POST['isNew']) && $_POST['isNew'] === "1";
    
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

    // Sanitizar entradas
    $nuevoDepto = [
        'nombre'      => htmlspecialchars(trim($_POST['nombre'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'descripcion' => htmlspecialchars(trim($_POST['descripcion'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'horario'     => htmlspecialchars(trim($_POST['horario'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'contacto'    => htmlspecialchars(trim($_POST['contacto'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'ubicacion'   => htmlspecialchars(trim($_POST['ubicacion'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'imagen'      => $imagenPath ?: filter_var(trim($_POST['imagen'] ?? ''), FILTER_SANITIZE_URL)
    ];

    if ($isNew) {
        $departamentos[] = $nuevoDepto;
    } else {
        $index = filter_input(INPUT_POST, 'index', FILTER_VALIDATE_INT);
        if ($index === false || !isset($departamentos[$index])) {
            echo json_encode(['success' => false, 'message' => 'Departamento no válido']);
            exit;
        }
        $departamentos[$index] = $nuevoDepto;
    }
}

// Guardar archivo de forma segura
$result = file_put_contents(
    $jsonFile,
    json_encode($departamentos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
    LOCK_EX // evita condiciones de carrera
);

if ($result === false) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al guardar el archivo']);
    exit;
}

echo json_encode(['success' => true]);
