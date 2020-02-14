<?php
session_start();
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
$query = "SELECT * FROM accounts";
$results=mysqli_query($con,$query);
?>
<div class="container">
	<h2 class="mb-4">Cuentas de Usuarios Registrados</h2>
	<a href="registro.php" class="btn btn-primary mb-4">Crear nueva cuenta de usuario</a>
	<?php
	while($row = mysqli_fetch_assoc($results)) {
		echo '<div class="card sombreado mb-4">';
		echo '<div class="card-body">';	
		foreach ($row as $col => $val) {
			echo ucfirst($col)."= ".$val."<br>";
		}
		echo '<a href="#" class="btn btn-primary mt-4 mr-4">Editar</a>';
		echo '<a href="#" class="btn btn-danger mt-4">Eliminar</a>';
		echo "</div>";
		echo "</div>";
	}
	mysqli_close($con);
	?>
</div>