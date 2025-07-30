<?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/header.php'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>FAQ | CASS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/cass/styles/bootstrap.min.css">
    <link rel="stylesheet" href="/cass/styles/global.css">
</head>

<body>
    <div class="page-wrapper">
        <div class="content-wrapper">
            <div class="container container-lar mb-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-radius-card my-5 px-4">
                            <div class="card-body">
                                <h2 class="my-3">Preguntas Frecuentes (FAQs)</h2>

                                <!-- Índice de temas -->
                                <ul class="list-group list-group-horizontal-sm mb-4 flex-wrap">
                                    <li class="list-group-item"><a href="#cuentas">Cuentas institucionales</a></li>
                                    <li class="list-group-item"><a href="#wifi">Conexión a WiFi</a></li>
                                    <li class="list-group-item"><a href="#otros">Otros procesos comunes</a></li>
                                </ul>
                                <hr>
                                <section id="cuentas" class="mb-5 mt-4">
                                    <h3>Cuentas institucionales</h3>
                                    <div class="accordion" id="accordionCuentas">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingCuenta1">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCuenta1">
                                                    ¿Cómo obtengo mi cuenta institucional?
                                                </button>
                                            </h2>
                                            <div id="collapseCuenta1" class="accordion-collapse collapse" data-bs-parent="#accordionCuentas">
                                                <div class="accordion-body">
                                                    Respuesta.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingCuenta2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCuenta2">
                                                    Pregunta
                                                </button>
                                            </h2>
                                            <div id="collapseCuenta2" class="accordion-collapse collapse" data-bs-parent="#accordionCuentas">
                                                <div class="accordion-body">
                                                    Respuesta.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingCuenta3">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCuenta3">
                                                    Pregunta
                                                </button>
                                            </h2>
                                            <div id="collapseCuenta3" class="accordion-collapse collapse" data-bs-parent="#accordionCuentas">
                                                <div class="accordion-body">
                                                    Respuesta.
                                                </div>
                                            </div>
                                        </div>
                                        <!-- preguntas aquí -->
                                    </div>
                                </section>

                                <section id="wifi" class="mb-5">
                                    <h3>Conexión a WiFi</h3>
                                    <div class="accordion" id="accordionWifi">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingWifi1">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWifi1">
                                                    ¿Cuál es el nombre de la red WiFi del campus?
                                                </button>
                                            </h2>
                                            <div id="collapseWifi1" class="accordion-collapse collapse" data-bs-parent="#accordionWifi">
                                                <div class="accordion-body">
                                                    El nombre es <strong>nombre</strong>.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingWifi2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWifi2">
                                                    Pregunta
                                                </button>
                                            </h2>
                                            <div id="collapseWifi2" class="accordion-collapse collapse" data-bs-parent="#accordionWifi">
                                                <div class="accordion-body">
                                                    Respuesta
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingWifi1">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWifi3">
                                                    Pregunta
                                                </button>
                                            </h2>
                                            <div id="collapseWifi3" class="accordion-collapse collapse" data-bs-parent="#accordionWifi">
                                                <div class="accordion-body">
                                                    Respuesta
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </section>

                                <section id="otros" class="mb-5">
                                    <h3>Otros procesos comunes</h3>
                                    <div class="accordion" id="accordionOtros">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOtros1">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOtros1">
                                                    ¿Dónde reporto problemas con mis trámites?
                                                </button>
                                            </h2>
                                            <div id="collapseOtros1" class="accordion-collapse collapse" data-bs-parent="#accordionOtros">
                                                <div class="accordion-body">
                                                    Respuesta
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOtros1">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOtros2">
                                                    Pregunta
                                                </button>
                                            </h2>
                                            <div id="collapseOtros2" class="accordion-collapse collapse" data-bs-parent="#accordionOtros">
                                                <div class="accordion-body">
                                                    Respuesta
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOtros3">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOtros3">
                                                    Pregunta
                                                </button>
                                            </h2>
                                            <div id="collapseOtros3" class="accordion-collapse collapse" data-bs-parent="#accordionOtros">
                                                <div class="accordion-body">
                                                    Respuesta
                                                </div>
                                            </div>
                                        </div>

                                    </div>
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