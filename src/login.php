<?php include ('../templates/header.php');?>

<!doctype html>

<html lang="en">
    <link rel="stylesheet" href="/cass/styles/global.css">
   <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Inicio | CASS</title>

    <link rel="stylesheet" href="/cass/styles/bootstrap.min.css">
    <link rel="stylesheet" href="/cass/styles/global.css">
    <link rel="stylesheet" href="/cass/styles/variables.css">

    <style>
        .hero {
            background: #f8f9fa;
            padding: 3rem 1rem;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .shortcuts .card {
            transition: transform 0.2s;
            cursor: pointer;
        }

        .shortcuts .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .card-icon {
            font-size: 2.5rem;
            color: #0d6efd;
        }
    </style>
</head>

    <body>
        <div class = "container">
            <div class="row"  style="max-width:800px;margin-left: auto; margin-right: auto;">
                <div class="col-md-12">
                <br><br>
                    <form action="" method="post">
                        <div class="card border-radius-card">
                            <div class="card-body">
                                <h5 class="card-title">Iniciar Sesión</h5>
                                <div class="mb-3">
                                    <label for="" class="form-label">Correo</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="Correo"
                                        id="Correo"
                                        placeholder="Correo Electronico"
                                        value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>"
                                    />
                                </div>
                                
                                <div class="mb-3">
                                    <label for="" class="form-label">Contraseña</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        id="password"
                                        aria-describedby="helpId"
                                        placeholder="Ingresa tu contraseña"
                                    />
                                </div>
                                <small id="helpId" class="form-text text-muted">¿No tienes una cuenta? <a href="registrate.php">Registrate</a></small><br><br>
                                    <button class="btn btn-primary form-control border-radiusbtn">Continuar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
                <br>
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
         <?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/footer.php'); ?>
    </body>
</html>
