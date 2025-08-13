<?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/header.php');
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
}
?>

<!doctype html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Registro | CASS</title>
    <link rel="stylesheet" href="/cass/styles/bootstrap.min.css">
    <link rel="stylesheet" href="/cass/styles/global.css">
</head>


<body>
    <div class="page-wrapper">
        <div class="content-wrapper">
            <div class="container form-container">
                <div class="row">
                    <!--<div class="row"  style="max-width:800px;margin-left: auto; margin-right: auto;">-->
                    <div class="col-md-12">
                        <form>
                            <div class="card border-radius-card my-5">
                                <div class="card-body">
                                    <h2>Registrate</h2>
                                    <div class="mb-3">
                                        <label for="usuario" class="form-label">Correo electrónico</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="usuario"
                                            id="usuario"
                                            placeholder="Correo institucional"
                                            required />
                                    </div>

                                    <div class="mb-3">
                                        <label for="contrasena" class="form-label">Contraseña</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            name="contrasena"
                                            id="contrasena"
                                            placeholder="Contraseña"
                                            required />
                                    </div>

                                    <div class="mb-3">
                                        <label for="confirmar_contrasena" class="form-label">Confirmar contraseña</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            name="confirmar_contrasena"
                                            id="confirmar_contrasena"
                                            placeholder="Confirma tu contraseña"
                                            required />
                                    </div>

                                    <button class="btn btn-danger form-control border-radiusbtn" type="submit" name="submit">Registrar</button>
                                    <button class="btn btn-secondary form-control border-radiusbtn mt-3" type="button" onclick="history.back()">Volver</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/footer.php'); ?>
    </div>


    <div class="modal fade" id="mensajeModal" tabindex="-1" aria-labelledby="mensajeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mensajeModalLabel">Mensaje</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body" id="mensajeModalBody">
      </div>
    </div>
  </div>
</div>


</body>
<!--el popper pa q es?-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="/cass/scripts/bootstrap.bundle.min.js"></script>
<script src="/cass/scripts/registro.js"></script>
<<<<<<< HEAD

=======
>>>>>>> 1f46bbd104b3cef27572390c545cb7484e3378a9

</html>