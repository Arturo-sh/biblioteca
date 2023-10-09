<?php

session_start();
require_once "modules/database.php";

$usuario = mysqli_real_escape_string($conn, stripslashes(strip_tags(htmlspecialchars(trim($_POST['usuario'])))));
$contrasenia = sha1(mysqli_real_escape_string($conn, stripslashes(strip_tags(htmlspecialchars(trim($_POST['contrasenia']))))));

$query_user_consult = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasenia = '$contrasenia' AND estado_usuario = 'Activo'";
$result_user_consult = mysqli_query($conn, $query_user_consult) or die('Error');
$rows = mysqli_num_rows($result_user_consult);

mysqli_close($conn);
if ($rows > 0) {
    $row  = mysqli_fetch_assoc($result_user_consult);

	$_SESSION['id_usuario'] = $row['id_usuario'];
	$_SESSION['rol_usuario'] = $row['rol_usuario'];
	$_SESSION['usuario'] = $row['usuario'];
	$_SESSION['nombre_usuario'] = $row['nombre_usuario'];
	
	header("Location: index.php?module=home");
} else {
    $_SESSION['invalid_credentials'] = true;
    header("Location: login.php");
}
?>