<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../index.html');
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

$stmt = $con->prepare('SELECT nombre, apellido, contrasena, email FROM accounts WHERE id = ?');

$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($nombre, $apellido, $contrasena, $email);
$stmt->fetch();
$stmt->close();
?>
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