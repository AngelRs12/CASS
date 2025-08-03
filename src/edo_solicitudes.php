<?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/header.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Solicitudes | CASS</title>
    <link rel="stylesheet" href="/cass/styles/bootstrap.min.css">
    <link rel="stylesheet" href="/cass/styles/global.css">
</head>
<body>
<div class="page-wrapper">
    <div class="content-wrapper">
        <div class="container my-5">
            <h2 class="mb-4">Mis Solicitudes</h2>
            <div class="card p-4 border-radius-card">
                <table class="table table-hover">
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
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/footer.php'); ?>
</div>

<script src="/cass/scripts/edo_solicitudes.js"></script>
<script src="/cass/scripts/bootstrap.bundle.min.js"></script>
</body>
</html>
