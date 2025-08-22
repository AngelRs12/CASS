<?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/cass/auth/auth.php');
verificarAcceso(["1", "2", "3"]);

$tipoUsuario = $_SESSION['tipo'] ?? '0';
$nombre = $_SESSION['nombre'] ?? '';
$apellido = $_SESSION['apellido'] ?? '';
$idUsr = $_SESSION['idUsuario'];

?>
<script>
    const tipoUsuario = "<?php echo $tipoUsuario; ?>";
    const usuarioNombre = "<?php echo $nombre; ?>";
    const usuarioApellido = "<?php echo $apellido; ?>";
    const idUsr = "<?php echo $idUsr; ?>";
</script>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solicitudes</title>
    <link rel="stylesheet" href="/cass/styles/bootstrap.min.css">
    <link rel="stylesheet" href="/cass/styles/global.css">

</head>

<body>
    <div class="page-wrapper">
        <div class="content-wrapper">
            <div class="container container-lar my-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-radius-card my-5 px-4">
                            <div class="card-body">
                                <h2 class="mb-4">Mis solicitudes</h2>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>Folio</th>
                                                <th>Tipo</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Comentarios</th>
                                                <?php if ($tipoUsuario == 1): ?>
                                                    <th>Atendio</th>
                                                    <th>Editar</th>
                                                <?php endif; ?>

                                            </tr>
                                        </thead>
                                        <tbody id="tabla-solicitudes">
                                            <tr>
                                                <td colspan="5" class="text-center">Cargando solicitudes...</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/footer.php'); ?>
    </div>

    <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar solicitud</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditar">
                        <input type="hidden" id="folio" name="folio">

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Rechazado">Rechazado</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comentarios" class="form-label">Comentarios</label>
                            <textarea class="form-control" id="comentarios" name="comentarios" rows="4"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="atendido" class="form-label">Atendido por</label>
                            <input type="text" class="form-control" id="atendido" name="atendido" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>


    <script src="/cass/scripts/bootstrap.bundle.min.js"></script>
    <script src="/cass/scripts/edo_solicitudes.js"></script>

</body>

</html>