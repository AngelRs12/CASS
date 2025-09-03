<?php
include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/header.php');
$tipoUsuario = $_SESSION['tipo'] ?? '0';
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
       <?php if ($tipoUsuario == 1): ?>
                        <div class="mb-4 d-flex justify-content-end">
                            <button class="btn btn-success btn-sm" id="btnNuevoNoticiaAviso" data-bs-toggle="modal" data-bs-target="#modalNoticias">Nuevo +</button>

                        </div>
                    <?php endif; ?>
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
<div class="modal fade" id="modalNoticias" tabindex="-1" aria-labelledby="nuevoNoticiaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header modal-header2 justify-content-center text-center text-white">
        <h5 class="modal-title w-100" id="nuevoNoticiaLabel">Añadir Nueva Noticia/Evento</h5>
        <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="formNuevaNoticia" enctype="multipart/form-data">
            <input type="hidden" id="idNoticia" name="idNoticia" value="">
          
          <!-- Radios para seleccionar tipo -->
          <div class="mb-3">
            <label class="form-label">Tipo:</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="tipo" id="tipoNoticia" value="noticia" checked>
              <label class="form-check-label" for="tipoNoticia">Noticia</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="tipo" id="tipoEvento" value="evento">
              <label class="form-check-label" for="tipoEvento">Evento</label>
            </div>
          </div>

          <div class="mb-3">
            <label for="tituloNoticia" class="form-label">Título</label>
            <input type="text" class="form-control" id="tituloNoticia" name="titulo" >
          </div>
          <div class="mb-3">
            <label for="textoNoticia" class="form-label">Texto</label>
            <textarea class="form-control" id="textoNoticia" name="texto" rows="4" ></textarea>
          </div>
          <div class="mb-3">
            <label for="imagenNoticia" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagenNoticia" name="imagen" accept="image/*">
          </div>

          <!-- Label para mostrar errores -->
          <div class="mb-3">
            <label id="errorNoticia" class="form-label text-danger d-none"></label>
          </div>

          <!-- Botones centrados -->
          <div class="d-flex justify-content-between gap-2 modalF">
              <button type="button" class="btn btn-secondary" id="prevDepto">&lt;</button>
            <button type="submit" class="btn btn-success">Guardar</button>
            
        <button type="button" class="btn btn-secondary" id="nextDepto">&gt;</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
</div>



<script src="/cass/scripts/bootstrap.bundle.min.js"></script>
<script src="/cass/scripts/tarjetas.js"></script>

<script>
    const tipoUsuario = <?php echo json_encode($tipoUsuario); ?>;
</script>
</body>
</html>