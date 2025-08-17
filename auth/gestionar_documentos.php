<?php
session_start();
$tipoUsuario = $_SESSION['tipo'] ?? '1';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'eliminar' && $tipoUsuario === '1') {
        $ruta = $_SERVER['DOCUMENT_ROOT'] . $_POST['ruta'];
        if (file_exists($ruta)) {
            unlink($ruta);
        }
    }

    if ($accion === 'subir' && ($tipoUsuario === '1' || $tipoUsuario === '2')) {
        $categoria = $_POST['categoria'];
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/cass/assets/" . $categoria . "/";

        if (!empty($_FILES['archivo']['name'])) {
            $nombreArchivo = basename($_FILES['archivo']['name']);
            move_uploaded_file($_FILES['archivo']['tmp_name'], $directorio . $nombreArchivo);
        }
    }
}

header("Location: /cass/src/documentos.php");
exit;
