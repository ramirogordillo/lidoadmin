<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../index.html');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSS Personalizado -->
  <link rel="stylesheet" href="../assets/css/sisadmin.css">
  <!-- CSS Bootstrap -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">

  <title>Sis Admin</title>

  <script src="../assets/jquery/jquery-3.4.1.js"></script>
  <script src="../assets/popper/popper.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.js"></script>

  <script>
    $(document).ready(function(){
        var trigger = $('#nav a');
        var container = $('#contenido');
        
        trigger.on('click', function(){
          $("#toggle-dropdownmenu").removeClass('show');

          var $this = $(this),
          target = $this.data('target');        console.log(target);
          
          container.load(target + '.php');

          return false;
        });
      });
    </script>

  </head>
  <body>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <!-- Topbar Navbar -->
      <div id="nav">
      <a href="#" data-target="home"><h3>Sis Admin</h3></a>
      </div>
      <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        <p class="my-auto small text-muted"><?=ucfirst($_SESSION['usuario'])?></p>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="img-profile rounded-circle" src="../imagenes/usuario.svg">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" id="toggle-dropdownmenu">
            <div id="nav">
              <a class="dropdown-item" href="#" data-target="perfil">Perfil</a>
              <a class="dropdown-item" href="#" data-target="configuracion">Configuración</a>
              <a class="dropdown-item" href="#" data-target="registro">Registro</a>
              <a class="dropdown-item" href="#" data-target="cuentas">Cuentas</a>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">Cerrar Sesión</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- End of Topbar -->
    <div id="contenido">
      <?php include('home.php'); ?>
    </div>
  </body>
  </html>