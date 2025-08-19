<?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/header.php'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamentos</title>
    <link rel="stylesheet" href="/cass/styles/bootstrap.min.css">
    <link rel="stylesheet" href="/cass/styles/global.css">

    <style>
        .card-dep {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            border-radius: 0.25rem;
        }
        .card-dep:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-dep:hover .card-title {
            color: #8f0505;
            transition: color 0.3s ease;
        }

        .card-dep .card-img-top {

            object-fit: cover;
            object-position: center;
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div class="content-wrapper">
            <div class="container container-lar mb-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-radius-card my-5 px-4">
                            <div class="card-body">
                                <h2 class="my-4">Departamentos</h1>
                                    <section class="mb-4">
                                        <div id="departamentos-container" class="row">
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

    <div class="modal fade" id="departamentoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center text-center">
                    <h5 id="modalNombre" class="modal-title w-100"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-md-5 text-center">
                            <img id="modalImagen" class="img-fluid rounded mb-3" alt="Imagen del departamento">
                        </div>
                        <div class="col-md-7 mt-3">
                            <p id="modalDescripcion"></p>
                            <p><strong>Horario:</strong> <span id="modalHorario"></span></p>
                            <p><strong>Contacto:</strong> <a href="#" id="modalContacto"></a></p>
                            <p><strong>Ubicación:</strong> <span id="modalUbicacion"></span></p>
                            <p><strong>Información adicional:</strong> <span id="modalInfoAdicional"></span></p>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" id="prevDepto"><
                        </button>
                        <button type="button" class="btn btn-secondary" id="nextDepto">> 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="/cass/scripts/bootstrap.bundle.min.js"></script>
    <script src="/cass/scripts/deptos.js"></script>
</body>

</html>