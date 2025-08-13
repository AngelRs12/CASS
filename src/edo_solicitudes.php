<?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/header.php'); ?>

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

    <script src="/cass/scripts/bootstrap.bundle.min.js"></script>
    <script src="/cass/scripts/edo_solicitudes.js"></script>
</body>

</html>