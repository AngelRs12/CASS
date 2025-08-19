<?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/header.php');

$correoUsuario = isset($_SESSION['correo']) ? $_SESSION['correo'] : '';
require_once ($_SERVER['DOCUMENT_ROOT'] . '/cass/auth/auth.php');
verificarAcceso(["1"]); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud</title>
    <link rel="stylesheet" href="/cass/styles/bootstrap.min.css">
    <link rel="stylesheet" href="/cass/styles/global.css">
</head>

<body>
    <div class="page-wrapper">
        <div class="content-wrapper">
            <div class="container container-med my-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-radius-card my-5 px-4">
                            <div class="card-body">
                                <h2 class="mb-4">Registrar Solicitud</h2>
                                <form id="solicitudForm">
                                    <div class="mb-3">
                                        <label for="usuarioMail" class="form-label">Correo electrónico</label>
                                        <input type="email" class="form-control" id="usuarioMail" name="usuarioMail"
                                            value="<?php echo $correoUsuario; ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tipo" class="form-label">Tipo de solicitud</label>
                                        <select class="form-select" id="tipo" name="tipo" required>
                                            <option value="">Seleccione...</option>
                                            <option value="Cambio de contraseña">Cambio de contraseña</option>
                                            <option value="Descarga SolidWorks">Descarga SolidWorks</option>
                                            <option value="Descarga Office">Descarga Office</option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label for="comentarios" class="form-label">Comentarios (opcional)</label>
                                        <textarea class="form-control" id="comentarios" name="comentarios" rows="3"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-danger form-control border-radiusbtn">Enviar Solicitud</button>
                                </form>

                                <div id="mensaje" class="mt-3"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/footer.php'); ?>
        </div>
    </div>
    <script src="/cass/scripts/bootstrap.bundle.min.js"></script>
    <script src="/cass/scripts/solicitud_form.js"></script>
</body>

</html>