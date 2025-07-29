<?php include ('templates/header.php');?>

<!doctype html>

<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <style>
            .container{
                display: flex;
         justify-content: center; /* Centra horizontalmente */
             align-items: center;    /* Centra verticalmente */
            }
            .row{
                width: 50%;
            }
        </style>
    </head>

    <body>
        <div class = "container">
            <div class="row">
                <div class="col-md-12">
                <br><br>
                    <form action="" method="post">
                        <div class="card">
                            <div class="card-header">
                                Inicio de Sesión
                            </div>
                                
                            
                            <div class="card-body">
                            <?php if (isset($mensaje) && !empty($mensaje)) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong><?php echo $mensaje; ?> </strong>
                                </div>
                            <?php } ?>

                                <div class="mb-3">
                                    <label for="" class="form-label">Usuario</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="usuario"
                                        id="usuario"
                                        aria-describedby="helpId"
                                        placeholder="Usuario"
                                        value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>"
                                    />
                                    <small id="helpId" class="form-text text-muted">Ingresa tu usuario</small>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="" class="form-label">Contraseña</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        id="password"
                                        aria-describedby="helpId"
                                        placeholder=""
                                    />
                                    <small id="helpId" class="form-text text-muted">Ingresa tu contraseña</small>
                                </div>
                                <small id="helpId" class="form-text text-muted">¿No tienes una cuenta? <a href="registrate.php">Registrate</a></small><br><br>
                                    <button class="btn btn-primary">Iniciar Sesión</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
        </div>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
