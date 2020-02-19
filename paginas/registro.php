<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: index.html');
  exit();
}
?>

<div class="container">
  <div class="text-center">
    <h2 class="mb-4">Registro de Nuevo Usuario</h2>
  </div>
  <div class="centrado">
    <div class="card sombreado">
      <div class="card-body">  

        <form action="registrar.php" method="post" autocomplete="off">

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

          <div class="form-group">
            <label for="nivel">Nivel</label>
            <input type="text" class="form-control" name="nivel" placeholder="Nivel" id="nivel" required>
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
