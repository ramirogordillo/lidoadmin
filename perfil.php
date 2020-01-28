<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT nombre, apellido, password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($nombre, $apellido, $password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
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
		<h2>Perfil del Usuario</h2>
		<div class="card sombreado">
			<div class="card-body">
				<p>Detalles de la cuenta del usuario:</p>
				<table>
					<tr>
						<td>Usuario:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Contraseña:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Nombre:</td>
						<td><?=$nombre?></td>
					</tr>
					<tr>
						<td>Apellido:</td>
						<td><?=$apellido?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<script src="assets/jquery/jquery-3.4.1.slim.min.js"></script>
	<script src="assets/popper/popper.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>