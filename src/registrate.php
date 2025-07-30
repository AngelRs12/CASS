
<?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/header.php'); 
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
}
?>

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
        <div class="container">
            <div class="row">
            <div class="row"  style="max-width:800px;margin-left: auto; margin-right: auto;">
                <div class="col-md-12">
                <br><br>
                    <form action="" method="post">
                        <div class="card border-radius-card">
                            <div class="card-body">
                                <h5 class="card-title">Registrate</h5>
                                <div class="mb-3">
                                    <label for="usuario" class="form-label">Correo Electronico</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="usuario"
                                        id="usuario"
                                        placeholder="Correo Electronico Institucional"
                                        required
                                    />
                                </div>

                                <div class="mb-3">
                                    <label for="contrasena" class="form-label">Contraseña</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        name="contrasena"
                                        id="contrasena"
                                        placeholder="Contraseña"
                                        required
                                    />
                                </div>

                                <div class="mb-3">
                                    <label for="confirmar_contrasena" class="form-label">Confirmar Contraseña</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        name="confirmar_contrasena"
                                        id="confirmar_contrasena"
                                        placeholder="Confirma tu contraseña"
                                        required
                                    />
                                </div>

                                <button class="btn btn-primary form-control border-radiusbtn" type="submit" name="submit">Registrar</button>
                                <button class="btn btn-secondary form-control border-radiusbtn mt-3" type="button" onclick="history.back()">Volver</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
    <br>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/footer.php'); ?>
    </body>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> 

</html>
