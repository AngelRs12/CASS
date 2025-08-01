<?php
include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/header.php');

function listarArchivos($ruta_relativa) {
    $ruta = $_SERVER['DOCUMENT_ROOT'] . $ruta_relativa;
    $archivos = [];

    if (is_dir($ruta)) {
        foreach (scandir($ruta) as $archivo) {
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

$datos = [
    'noticias' => listarArchivos('/cass/assets/Noticias'),
    'eventos' => listarArchivos('/cass/assets/Eventos')
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Noticias y Eventos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/cass/styles/bootstrap.min.css">
    <link rel="stylesheet" href="/cass/styles/global.css">
      <link rel="stylesheet" href="/cass/styles/noticias.css">
    <style>
        .card-img-top {
            height: 180px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    <div class="content-wrapper">
        <div class="container container-lar my-5">
            <div class="card border-radius-card px-4">
                <div class="card-body">
                    <h2 class="my-4">Noticias y Eventos</h2>

                    <section id="noticias" class="mb-5">
                        <h3>Noticias</h3>
                        <div class="row" id="contenedor-noticias"></div>
                    </section>

                    <section id="eventos" class="mb-5">
                        <h3>Eventos</h3>
                        <div class="row" id="contenedor-eventos"></div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/footer.php'); ?>
</div>

<script>
    const datos = <?php echo json_encode($datos, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
</script>
<script src="/cass/scripts/tarjetas.js"></script>
<script src="/cass/scripts/bootstrap.bundle.min.js"></script>
</body>
</html>