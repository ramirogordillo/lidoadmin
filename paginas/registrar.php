<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'lidoadmin';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Falla de conección a MySQL: ' . mysqli_connect_error());
}

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['usuario'], $_POST['contrasena'], $_POST['email'], $_POST['nivel'])) {
	// Could not get the data that should have been sent.
	die ('Por favor complete todos los datos de registro!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['usuario']) || empty($_POST['contrasena']) || empty($_POST['email']) || empty($_POST['nivel'])) {
	// One or more values are empty.
	echo '2';
	die ('Por favor complete todos los datos de registro');
}
if (preg_match('/[A-Za-z0-9]+/', $_POST['usuario']) == 0) {
    die ('Usuario no valido, solo letras y números!');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	die ('Email no valido!');
}
if (strlen($_POST['contrasena']) > 15 || strlen($_POST['contrasena']) < 8) {
	die ('Contraseña debe tener entre 8 y 15 caracteres!');
}
// We need to check if the account with that usuario exists.
if ($stmt = $con->prepare('SELECT id, contrasena FROM cuentas WHERE usuario = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the contrasena using the PHP contrasena_hash function.
	$stmt->bind_param('s', $_POST['usuario']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// usuario already exists
		echo 'El usuario ya existe, por favor ingrese otro usuario!';
	} else {
	// usuario doesnt exists, inserts new account
		if ($stmt = $con->prepare('INSERT INTO cuentas (usuario, contrasena, email, nivel) VALUES (?, ?, ?, ?)')) {
	// We do not want to expose contrasenas in our database, so hash the contrasena and use contrasena_verify when a user logs in.
			$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
			$stmt->bind_param('ssss', $_POST['usuario'], $contrasena, $_POST['email'], $_POST['nivel']);
			$stmt->execute();
			header('Location: cuentas.php');
		} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			echo 'No se pudo prosesar el requerimiento!';
		}
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'No se pudo prosesar el requerimiento!';
}
$con->close();
?>