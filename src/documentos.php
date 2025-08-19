<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/header.php'); 

function listarArchivos($ruta_relativa) {
    $ruta = $_SERVER['DOCUMENT_ROOT'] . $ruta_relativa;
    $archivos = [];

    if (is_dir($ruta)) {
        $contenido = scandir($ruta);
        foreach ($contenido as $archivo) {
            if ($archivo !== '.' && $archivo !== '..') {
                $archivos[] = [
                    'nombre' => pathinfo($archivo, PATHINFO_FILENAME),
                    'archivo' => $archivo,
                    'ruta' => $ruta_relativa . '/' . $archivo
                ];
            }
        }
    }

    return $archivos;
}

$documentos = [
    'guias' => listarArchivos('/cass/assets/Guias'),
    'formatos' => listarArchivos('/cass/assets/Formatos'),
    'manuales' => listarArchivos('/cass/assets/Manuales')
];

// Rol del usuario
$tipoUsuario = $_SESSION['tipo'] ?? '0';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Documentos Oficiales</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/cass/styles/bootstrap.min.css">
    <link rel="stylesheet" href="/cass/styles/global.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/cass/styles/documentos.css">
</head>

<script>
    const documentos = <?php echo json_encode($documentos, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
    const tipoUsuario = "<?php echo $tipoUsuario; ?>"; // <-- IMPORTANTE
</script>
<script src="/cass/scripts/documentos.js"></script>

<body>
    <div class="page-wrapper">
        <div class="content-wrapper">
            <div class="container container-lar mb-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-radius-card my-5 px-4">
                            <div class="card-body">
                                <h2 class="my-3">Documentos Oficiales</h2>
                                <ul class="list-group list-group-horizontal-sm mb-4 flex-wrap">
                                    <li class="list-group-item border-top-0 border-bottom-0"><a href="#guias">Guías de procesos</a></li>
                                    <li class="list-group-item border-top-0 border-bottom-0"><a href="#formatos">Formatos descargables</a></li>
                                    <li class="list-group-item border-top-0 border-bottom-0"><a href="#Manualess">Manuales</a></li>
                                </ul>
                                <hr>
                                <section id="cuentas" class="mb-5 mt-4">
                                    <h3>Guías de procesos</h3>
                                </section>

                                <section id="formatos" class="mb-5">
                                    <h3>Formatos descargables</h3>
                                </section>

                                <section id="Manualess" class="mb-5">
                                    <h3>Manuales</h3>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/footer.php'); ?>
    </div>
    <!-- Scripts -->
    <script src="/cass/scripts/bootstrap.bundle.min.js"></script>
</body>
</html>
