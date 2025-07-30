<?php include('templates/header.php'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Inicio | CASS</title>

    <link rel="stylesheet" href="/cass/styles/bootstrap.min.css">
    <link rel="stylesheet" href="/cass/styles/global.css">
    <link rel="stylesheet" href="/cass/styles/variables.css">
</head>

<body>
    <div class="page-wrapper">
        <div class="content-wrapper mb-5">
            <div class="container mt-5">
                
                <div class="hero">
                    <h1 class="display-5">Bienvenido a CASS</h1>
                    <p class="lead">Centro de Atención, Soporte y Servicios del Campus</p>
                    <p>Tu espacio integral para resolver trámites, consultar información institucional y acceder a servicios digitales.</p>
                </div>

                
                <h2 class="mb-4">Accesos directos</h2>
                <div class="row shortcuts text-center">
                    <div class="col-md-4 mb-4">
                        <a href="departamentos.php" class="text-decoration-none text-dark">
                            <div class="card h-100 p-3">
                                <div class="card-icon mb-2">🏢</div>
                                <h5 class="card-title">Departamentos</h5>
                                <p class="card-text">Conoce las áreas de servicio como biblioteca, centro de cómputo y más.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="faq.php" class="text-decoration-none text-dark">
                            <div class="card h-100 p-3">
                                <div class="card-icon mb-2">❓</div>
                                <h5 class="card-title">Preguntas Frecuentes</h5>
                                <p class="card-text">Resuelve tus dudas sobre cuentas, conexión y procesos comunes.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="formularios.php" class="text-decoration-none text-dark">
                            <div class="card h-100 p-3">
                                <div class="card-icon mb-2">📝</div><!-- se puede poner img o emoji-->
                                <h5 class="card-title">Formularios</h5>
                                <p class="card-text">Accede a trámites como solicitudes y reportes (requiere iniciar sesión).</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/footer.php'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="/cass/scripts/bootstrap.bundle.min.js"></script>
</body>

</html>