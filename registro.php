<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: index.html');
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
  <link rel="stylesheet" href="assets/css/sisadmin.css">
  <!-- CSS Bootstrap -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

  <title>Sis Admin</title>

</head>
<body>
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Topbar Navbar -->
    <a href="dashboard.php"><h3>Sis Admin</h3></a>
    <ul class="navbar-nav ml-auto">
      <!-- Nav Item - User Information -->
      <p class="my-auto small text-muted"><?=ucfirst($_SESSION['name'])?></p>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="perfil.php" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="img-profile rounded-circle" src="imagenes/usuario.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="perfil.php">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Perfil
          </a>
          <a class="dropdown-item" href="configuracion.php">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Configuración
          </a>
          <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            Historial
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Cerrar Sesión
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- End of Topbar -->
  <div class="container">
    <div class="text-center">
      <h2 class="mb-4">Registro de Nuevo Usuario</h2>
    </div>
    <div class="centrado">
      <div class="card sombreado">
        <div class="card-body">  

          <form action="registrar.php" method="post" autocomplete="off">

            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="nombre">
            </div>

            <div class="form-group">
              <label for="apellido">Apellido</label>
              <input type="text" class="form-control" name="apellido" placeholder="Apellido" id="apellido">
            </div>

            <div class="form-group">
              <label for="usuario">Usuario</label>
              <input type="text" class="form-control" name="usuario" placeholder="Usuario" id="usuario" required>
            </div>

            <div class="form-group">
              <label for="contrasena">Contraseña</label>
              <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" id="contrasena" required>
            </div>

            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" class="form-control" name="email" placeholder="E-mail" id="email" required>
            </div>

            <div class="text-center card-body">
              <input type="submit" class="btn btn-primary" value="Registrar">
            </div>

            <div class="text-center">
              <a href="cuentas.php" class="text-danger"><p>Cancelar</p></a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<!-- JavaScript para Bootstrap-->
<!-- jQuery, Popper.js, Bootstrap JS -->     
<script src="assets/jquery/jquery-3.4.1.slim.min.js"></script>
<script src="assets/popper/popper.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>

</html>