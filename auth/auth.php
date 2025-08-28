<?php

$tiempoInactividad = 600; 


function verificarAcceso(array $rolesPermitidos = []) {
    global $tiempoInactividad;

    if (!isset($_SESSION["idUsuario"])) {
        header("Location: /cass/src/login.php");
        exit;
    }

    if (isset($_SESSION["ultimaActividad"]) && (time() - $_SESSION["ultimaActividad"]) > $tiempoInactividad) {
        session_unset();
        session_destroy();
        header("Location: /cass/src/login.php?timeout=1");
        exit;
    }

    $_SESSION["ultimaActividad"] = time();

    if (!isset($_SESSION["tipo"]) || (!empty($rolesPermitidos) && !in_array($_SESSION["tipo"], $rolesPermitidos))) {
        header("Location: /cass/src/login.php");
        exit;
    }
}
