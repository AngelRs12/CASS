<?php
session_start();
$timeout = isset($_GET['timeout']) && $_GET['timeout'] == '1';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include "header.php"; ?>

    <main class="container my-5 py-5 px-4">
        <?php if ($timeout): ?>
            <div class="alert alert-warning text-center">
                Tu sesión ha expirado. Vuelve a iniciar sesión.
            </div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Iniciar Sesión</h2>
                <form id="loginForm" novalidate>
                    <div class="form-floating mb-4">
                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario"
                            pattern="^[a-zA-Z0-9_]{4,50}$" maxlength="50" required>
                        <label for="usuario" class="form-label">Usuario</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="contraseña" name="contraseña"
                            placeholder="Contraseña" minlength="6" required>
                        <label for="contraseña">Contraseña</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                </form>
                <p id="mensaje" class="mt-3 text-danger text-center"></p>
            </div>

        </div>


    </main>

    <script src="../scripts/bootstrap.bundle.min.js"></script>
    <script src="../scripts/login.js"></script>
</body>

</html>