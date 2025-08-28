<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<div class="py-3 head-logos">
  <div class="d-flex justify-content-center align-items-center flex-wrap gap-5">
    <img src="/cass/assets/ITCJ logo.png" alt="Imagen 2" height="60">
    <img src="/cass/assets/LOGO TECNM.png" alt="Imagen 3" height="60">
    <img src="/cass/assets/logo sep.png" alt="img 4" height="60">

  </div>
</div>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="/cass/index.php">CASS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">

          <li class="nav-item ">
            <a class="nav-link" href="/cass/index.php">Inicio</a>
            
          </li>

        <li class="nav-item ">
            <a class="nav-link" href="/cass/src/noticias.php">Noticias y Eventos</a>
          </li>


          <li class="nav-item ">
            <a class="nav-link" href="/cass/src/deptos.php">Departamentos</a>
          </li>

          <!-- FAQ -->
          <li class="nav-item ">
            <a class="nav-link" href="/cass/src/faq.php">Soporte y FAQs</a>
          </li>

          

          <!-- FORMULARIOS (PROTEGIDO) 
          <?php if (isset($_SESSION["correo"])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="formulariosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Formularios en línea 
              </a>
              <ul class="dropdown-menu" aria-labelledby="formulariosDropdown">
                <li><a class="dropdown-item" href="solicitud_form.php">Solicitud de soporte técnico</a></li>
                <li><a class="dropdown-item" href="reporte_falla.php">Reporte de fallas</a></li>
                <li><a class="dropdown-item" href="otros_formularios.php">Otros trámites</a></li>
              </ul>
            </li>-->

            <li class="nav-item ">
            <a class="nav-link" href="solicitud_form.php">Solicitud de Soporte técnico</a>
          </li>

          <?php endif; ?>
    

          
          

          <!-- DOCUMENTOS -->
           <li class="nav-item ">
            <a class="nav-link" href="/cass/src/documentos.php">Documentos Oficiales</a>
          </li>

          <!-- SOBRE CASS -->
          <li class="nav-item ">
            <a class="nav-link" href="/cass/src/about_cass.php">Sobre CASS</a>
          </li>
        </ul>

        <!-- SESIÓN -->
        <ul class="navbar-nav ms-auto">
          <?php if (!isset($_SESSION["correo"])): ?>
            <li class="nav-item"><a class="nav-link" href="/cass/src/login.php">Iniciar Sesión</a></li>
            <li class="nav-item"><a class="nav-link" href="/cass/src/registrate.php">Registrarse</a></li>
          <?php else: ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Hola, <?php echo htmlspecialchars($_SESSION["correo"] ?? $_SESSION["usuario"]); ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usuarioDropdown">
                <li><a class="dropdown-item" href="ver_formularios.php">Mis Formularios</a></li>
                <li><a class="dropdown-item" href="/cass/src/edo_solicitudes.php">Estado de solicitudes</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/cass/auth/logout.php">Cerrar Sesión</a></li>
              </ul>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>
