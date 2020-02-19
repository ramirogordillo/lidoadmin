<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../index.html');
  exit();
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'lidoadmin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$stmt = $con->prepare('SELECT email, nivel FROM cuentas WHERE id = ?');

$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email, $nivel);
$stmt->fetch();
$stmt->close();

if ($nivel == 'admin') {
	$nivel_show = 'Adminitrador';
		} else {
			$nivel_show = 'Usuario';
		}

?>
	<div class="container">
		<h2>Perfil del Usuario</h2>
		<div class="card sombreado">
			<div class="card-body">
				<p>Detalles de la cuenta del usuario:</p>
				<table>
					<tr>
						<td>Usuario:</td>
						<td><?=ucfirst($_SESSION['usuario'])?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
					<tr>
						<td>Nivel:</td>
						<td><?=$nivel_show?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>