<?php
session_start();
header('Content-Type: application/json');

// Incluir tu conexión existente
require_once "../configs/connectDB.php"; 

// Validar que se reciban los datos esenciales
if (!isset($_POST['titulo'], $_POST['texto'], $_POST['tipo'])) {
    echo json_encode(["error" => "Faltan datos obligatorios."]);
    exit;
}

$titulo = trim($_POST['titulo']);
$texto = trim($_POST['texto']);
$tipo = trim($_POST['tipo']);
$id = isset($_POST['id']) ? trim($_POST['id']) : null; // id opcional para update
$imagen = isset($_FILES['imagen']) ? $_FILES['imagen'] : null;

// Validar tipo
$tiposPermitidos = ['noticia', 'evento'];
if (!in_array($tipo, $tiposPermitidos)) {
    echo json_encode(["error" => "Tipo no válido."]);
    exit;
}

// Inicializar ruta para DB
$rutaRelativa = null;

// Manejar imagen si existe
if ($imagen && $imagen['name']) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($imagen['type'], $allowedTypes)) {
        echo json_encode(["error" => "Tipo de imagen no permitido."]);
        exit;
    }

    // Definir carpeta según tipo
    $uploadsDir = $_SERVER['DOCUMENT_ROOT'] . '/cass/assets/';
    $uploadsDir .= $tipo === 'noticia' ? 'Noticias/' : 'Eventos/';
    if (!is_dir($uploadsDir)) mkdir($uploadsDir, 0755, true);

    $imagenNombre = time() . "_" . basename($imagen['name']);
    $imagenRuta = $uploadsDir . $imagenNombre;

    if (!move_uploaded_file($imagen['tmp_name'], $imagenRuta)) {
        echo json_encode(["error" => "Error al subir la imagen."]);
        exit;
    }

    $rutaRelativa = '/cass/assets/' . ($tipo === 'noticia' ? 'Noticias/' : 'Eventos/') . $imagenNombre;
}

try {
    if ($id) {
        // UPDATE
        if ($rutaRelativa) {
            $stmt = $conn->prepare("UPDATE noticias_eventos 
                                    SET tipo=:tipo, titulo=:titulo, contenido=:contenido, ruta=:ruta, lasteditdt=NOW() 
                                    WHERE id=:id");
            $stmt->execute([
                ':tipo' => $tipo,
                ':titulo' => $titulo,
                ':contenido' => $texto,
                ':ruta' => $rutaRelativa,
                ':id' => $id
            ]);
        } else {
            // UPDATE sin cambiar la imagen
            $stmt = $conn->prepare("UPDATE noticias_eventos 
                                    SET tipo=:tipo, titulo=:titulo, contenido=:contenido, lasteditdt=NOW() 
                                    WHERE id=:id");
            $stmt->execute([
                ':tipo' => $tipo,
                ':titulo' => $titulo,
                ':contenido' => $texto,
                ':id' => $id
            ]);
        }

        echo json_encode([
            "success" => true,
            "id" => $id,
            "imagen" => $rutaRelativa // puede ser null si no se subió imagen
        ]);

    } else {
        // INSERT
        if (!$rutaRelativa) {
            echo json_encode(["error" => "La imagen es obligatoria para nuevas noticias/eventos."]);
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO noticias_eventos (tipo, titulo, contenido, ruta, lasteditdt) 
                                VALUES (:tipo, :titulo, :contenido, :ruta, NOW()) RETURNING id");
        $stmt->execute([
            ':tipo' => $tipo,
            ':titulo' => $titulo,
            ':contenido' => $texto,
            ':ruta' => $rutaRelativa
        ]);
        $id = $stmt->fetchColumn();

        echo json_encode([
            "success" => true,
            "id" => $id,
            "imagen" => $rutaRelativa
        ]);
    }

} catch(PDOException $e) {
    echo json_encode(["error" => "Error al guardar en la base de datos: " . $e->getMessage()]);
}
