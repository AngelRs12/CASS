<?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/header.php'); ?>

<!doctype html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Ingresar | CASS</title>
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
                        <form action="" method="post">
                            <div class="card border-radius-card my-5">
                                <div class="card-body">
                                    <h2>Iniciar Sesión</h2>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Correo electrónico</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="Correo"
                                            id="Correo"
                                            placeholder="Correo electrónico"
                                            value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Contraseña</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            name="password"
                                            id="password"
                                            aria-describedby="helpId"
                                            placeholder="Ingresa tu contraseña" />
                                    </div>
                                    <small id="helpId" class="form-text text-muted">¿No tienes una cuenta? <a href="registrate.php">Registrate</a></small><br><br>
                                    <button class="btn btn-danger form-control border-radiusbtn">Continuar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/footer.php'); ?>
    </div>
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="modalBody">
                
            </div>
        </div>
    </div>
</div>


    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="/cass/scripts/bootstrap.bundle.min.js"></script>
    <script src="/cass/scripts/login.js"></script>

</html>