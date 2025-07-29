<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<div class="py-3 head-logos">
  <div class="d-flex justify-content-center align-items-center flex-wrap gap-5">
    <img src="../img/sep-blanco.png" alt="Imagen 2" height="60">
    <img src="../img/TECNM-B.png" alt="Imagen 3" height="60">
    <img src="../img/ITCJ-blanco.png" alt="" height="60">
  </div>
</div>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">CuídaTec</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">

          <!-- INICIO -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="inicioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Inicio
            </a>
            <ul class="dropdown-menu" aria-labelledby="inicioDropdown">
              <li><a class="dropdown-item" href="bienvenida.php">Bienvenida</a></li>
              <li><a class="dropdown-item" href="accesos.php">Accesos Directos</a></li>
            </ul>
          </li>

          <!-- NOTICIAS Y EVENTOS -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="noticiasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Noticias y Eventos
            </a>
            <ul class="dropdown-menu" aria-labelledby="noticiasDropdown">
              <li><a class="dropdown-item" href="noticias.php">Noticias del campus</a></li>
              <li><a class="dropdown-item" href="eventos.php">Próximos eventos</a></li>
            </ul>
          </li>

          <!-- DEPARTAMENTOS -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="departamentosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Departamentos
            </a>
            <ul class="dropdown-menu" aria-labelledby="departamentosDropdown">
              <li><a class="dropdown-item" href="centro_computo.php">Centro de Cómputo</a></li>
              <li><a class="dropdown-item" href="servicios_escolares.php">Servicios Escolares</a></li>
              <li><a class="dropdown-item" href="biblioteca.php">Biblioteca</a></li>
              <li><a class="dropdown-item" href="otros_departamentos.php">Otros departamentos</a></li>
            </ul>
          </li>

          <!-- FAQ -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="faqDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Soporte y FAQ
            </a>
            <ul class="dropdown-menu" aria-labelledby="faqDropdown">
              <li><a class="dropdown-item" href="cuentas.php">Cuentas institucionales</a></li>
              <li><a class="dropdown-item" href="wifi.php">Conexión a WiFi</a></li>
              <li><a class="dropdown-item" href="correo.php">Correo institucional</a></li>
              <li><a class="dropdown-item" href="faq.php">Otros procesos comunes</a></li>
            </ul>
          </li>

          <!-- FORMULARIOS (PROTEGIDO) -->
          <?php if (isset($_SESSION["usuario"])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="formulariosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Formularios en línea 🔒
              </a>
              <ul class="dropdown-menu" aria-labelledby="formulariosDropdown">
                <li><a class="dropdown-item" href="solicitud_soporte.php">Solicitud de soporte técnico</a></li>
                <li><a class="dropdown-item" href="reporte_falla.php">Reporte de fallas</a></li>
                <li><a class="dropdown-item" href="otros_formularios.php">Otros trámites</a></li>
              </ul>
            </li>
          <?php endif; ?>

          <!-- DOCUMENTOS -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="documentosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Documentos Oficiales
            </a>
            <ul class="dropdown-menu" aria-labelledby="documentosDropdown">
              <li><a class="dropdown-item" href="guias.php">Guías de procesos</a></li>
              <li><a class="dropdown-item" href="formatos.php">Formatos descargables</a></li>
              <li><a class="dropdown-item" href="manuales.php">Manuales</a></li>
            </ul>
          </li>

          <!-- SOBRE CASS -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="cassDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Sobre CASS
            </a>
            <ul class="dropdown-menu" aria-labelledby="cassDropdown">
              <li><a class="dropdown-item" href="objetivo.php">Objetivo del proyecto</a></li>
              <li><a class="dropdown-item" href="aviso_privacidad.php">Aviso de privacidad</a></li>
            </ul>
          </li>
        </ul>

        <!-- SESIÓN -->
        <ul class="navbar-nav ms-auto">
          <?php if (!isset($_SESSION["usuario"])): ?>
            <li class="nav-item"><a class="nav-link" href="signin.php">Iniciar Sesión</a></li>
            <li class="nav-item"><a class="nav-link" href="registro.php">Registrarse</a></li>
          <?php else: ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Hola, <?php echo htmlspecialchars($_SESSION["nombre_usuario"] ?? $_SESSION["usuario"]); ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usuarioDropdown">
                <li><a class="dropdown-item" href="ver_formularios.php">Mis Formularios</a></li>
                <li><a class="dropdown-item" href="estado_solicitudes.php">Estado de solicitudes</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../auth/logout.php">Cerrar Sesión</a></li>
              </ul>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>
