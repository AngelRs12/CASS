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
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-dep:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card-icon {
            font-size: 2rem;
            color: var(--bs-primary);
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
    <script src="/cass/scripts/bootstrap.bundle.min.js"></script>
    <script src="/cass/scripts/deptos.js"></script>
</body>

</html>