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

$datos = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/cass/assets/datos_noticias_eventos.json'), true);

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
        

    </style>
</head>
<body>
<div class="page-wrapper">
    <div class="content-wrapper">
        <div class="container container-lar my-5">
            <div class="card border-radius-card px-4">
                <div class="card-body">
                    <h2 class="my-4">Noticias y Eventos</h2>
                    <ul class="list-group list-group-horizontal-sm mb-4 flex-wrap">
                        <li class="list-group-item border-top-0 border-bottom-0 "><a href="#noticias">Noticias</a></li>
                        <li class="list-group-item border-top-0 border-bottom-0"><a href="#eventos">Eventos</a></li>
                    </ul>

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
<!-- Modal Detalle Noticia/Evento -->
<div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header justify-content-center text-center text-white">
        <h5 class="modal-title w-100" id="detalleModalLabel">Detalle</h5>
        <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="row align-items-center">
          <!-- Imagen a la izquierda -->
          <div class="col-md-5 text-center">
            <img id="modalImagen" src="" class="img-fluid rounded mb-3 mb-md-0" alt="Imagen detalle" style="max-height: 300px;">
          </div>

          <!-- Texto a la derecha -->
          <div class="col-md-7">
            <p id="modalDescripcion" class="mb-4"></p>
            <div class="text-center">
              <a id="modalArchivoLink" href="#" target="_blank" class="btn btn-danger">Ver documento completo</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    const datos = <?php echo json_encode($datos, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
</script>
<script src="/cass/scripts/tarjetas.js"></script>
<script src="/cass/scripts/bootstrap.bundle.min.js"></script>
</body>
</html>