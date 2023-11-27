<?php
session_start();
require_once "modules/database.php";

$usuario = mysqli_real_escape_string($conn, stripslashes(strip_tags(htmlspecialchars(trim($_POST['usuario'])))));
$contrasenia = mysqli_real_escape_string($conn, stripslashes(strip_tags(htmlspecialchars(trim($_POST['contrasenia'])))));

$query_user_consult = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$result_user_consult = mysqli_query($conn, $query_user_consult) or die('Error');
$rows = mysqli_num_rows($result_user_consult);
mysqli_close($conn);

$module_redirect = "iniciar_sesion";
$_SESSION['invalid_credentials'] = ["msg" => "Usuario y/o contraseña invalidos!"];

if ($rows > 0) {
	while ($row = mysqli_fetch_assoc($result_user_consult)) {
		if (password_verify($contrasenia, $row['contrasenia']) && $row['estado_usuario'] == "Suspendido") {
			$msg = "Cuenta inhabilitada, solicite la activación con el administrador!";
			$_SESSION['invalid_credentials'] = ["msg" => $msg];
			break;
		} else if (password_verify($contrasenia, $row['contrasenia']) && $row['estado_usuario'] == "Activo") {
			session_regenerate_id(true);

			// Se obtiene la IP y el User Agent del usuario
			$_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

			// Configura el tiempo de vida de la sesión en segundos
			ini_set('session.gc_maxlifetime', 3600);

			$_SESSION['id_usuario'] = $row['id_usuario'];
			$_SESSION['rol_usuario'] = $row['rol_usuario'];
			$_SESSION['usuario'] = $row['usuario'];
			$_SESSION['nombre_usuario'] = $row['nombre_usuario'];

			$module_redirect = "inicio";

			if (isset($_SESSION['module_redirect'])) {
				$module_redirect = $_SESSION['module_redirect'];
				unset($_SESSION['module_redirect']);
			}
		}
	}
}

header("Location: $module_redirect");
