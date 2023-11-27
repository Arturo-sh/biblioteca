<?php
session_start();
if (!isset($_SESSION['id_usuario'])) exit;

require_once "../database.php";

if ($_SESSION['rol_usuario'] == "Admin") {
    if (isset($_POST['users_table'])) {
        if ($_SESSION['id_usuario'] != 1) {
            $query_get_users = "SELECT id_usuario, rol_usuario, usuario, nombre_usuario, telefono_usuario, correo_usuario, creacion_cuenta, estado_usuario FROM usuarios WHERE id_usuario != 1";
        } else {
            $query_get_users = "SELECT id_usuario, rol_usuario, usuario, nombre_usuario, telefono_usuario, correo_usuario, DATE_FORMAT(creacion_cuenta, '%a. %d de %b. de %Y a las %r') AS creacion_cuenta, estado_usuario FROM usuarios";
        }

        $users_data = mysqli_query($conn, $query_get_users);
        $data = mysqli_fetch_all($users_data, MYSQLI_ASSOC);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['action']) && $_POST['action'] == "insert") {
        $usuario = htmlspecialchars(trim($_POST['usuario']), ENT_QUOTES, 'UTF-8');
        $contrasenia = htmlspecialchars(trim($_POST['contrasenia']), ENT_QUOTES, 'UTF-8');
        $contrasenia_hash = password_hash($contrasenia, PASSWORD_BCRYPT);
        $nombre_usuario = htmlspecialchars(trim($_POST['nombre_usuario']), ENT_QUOTES, 'UTF-8');
        $telefono_usuario = htmlspecialchars(trim($_POST['telefono_usuario']), ENT_QUOTES, 'UTF-8');
        $correo_usuario = htmlspecialchars(trim($_POST['correo_usuario']), ENT_QUOTES, 'UTF-8');

        $query_user_insert = "INSERT INTO usuarios(id_usuario, usuario, contrasenia, nombre_usuario, telefono_usuario, correo_usuario) VALUES(NULL, '$usuario', '$contrasenia_hash', '$nombre_usuario', '$telefono_usuario', '$correo_usuario')";
        $result_user_insert = mysqli_query($conn, $query_user_insert);

        if ($result_user_insert) echo json_encode(["icon" => "success", "msg" => "Usuario registrado!"], JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['edit_id'])) {
        $id_usuario = $_POST['edit_id'];

        $query_user_data = "SELECT id_usuario, rol_usuario, usuario, nombre_usuario, telefono_usuario, correo_usuario, estado_usuario FROM usuarios WHERE id_usuario = $id_usuario";
        $user_data = mysqli_query($conn, $query_user_data);
        $row = mysqli_fetch_all($user_data, MYSQLI_ASSOC);

        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {
        $id_usuario = htmlspecialchars(trim($_POST['id_usuario']), ENT_QUOTES, 'UTF-8');
        $usuario = htmlspecialchars(trim($_POST['usuario']), ENT_QUOTES, 'UTF-8');
        $contrasenia = htmlspecialchars(trim($_POST['contrasenia']), ENT_QUOTES, 'UTF-8');
        $nombre_usuario = htmlspecialchars(trim($_POST['nombre_usuario']), ENT_QUOTES, 'UTF-8');
        $telefono_usuario = htmlspecialchars(trim($_POST['telefono_usuario']), ENT_QUOTES, 'UTF-8');
        $correo_usuario = htmlspecialchars(trim($_POST['correo_usuario']), ENT_QUOTES, 'UTF-8');
        $estado_usuario = htmlspecialchars(trim($_POST['estado_usuario']), ENT_QUOTES, 'UTF-8');
        if ($_SESSION['id_usuario'] == $id_usuario) $_SESSION['nombre_usuario'] = $nombre_usuario;

        $response = ["icon" => "success", "msg" => "Datos del usuario actualizados!"];
        if ($_SESSION['id_usuario'] == $id_usuario) {
            $estado_usuario = "Activo";
            $response = ["icon" => "success", "msg" => "Datos del usuario actualizados (no se puede actualizar su propio estatus)!"];
        }

        if ($contrasenia == "") {
            $query_user_update = "UPDATE usuarios SET usuario = '$usuario', nombre_usuario = '$nombre_usuario', telefono_usuario = '$telefono_usuario', correo_usuario = '$correo_usuario', estado_usuario = '$estado_usuario' WHERE id_usuario = $id_usuario";
        } else {
            $contrasenia_hash = password_hash($contrasenia, PASSWORD_BCRYPT);
            $query_user_update = "UPDATE usuarios SET usuario = '$usuario', contrasenia = '$contrasenia_hash', nombre_usuario = '$nombre_usuario', telefono_usuario = '$telefono_usuario', correo_usuario = '$correo_usuario', estado_usuario = '$estado_usuario' WHERE id_usuario = $id_usuario";
        }

        $result_user_update = mysqli_query($conn, $query_user_update);
        if ($result_user_update) echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['delete_id'])) {
        $id_usuario = $_POST['delete_id'];

        if ($_SESSION['id_usuario'] == $id_usuario) {
            echo json_encode(["icon" => "error", "msg" => "No puede eliminar su propio usuario!"], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $query_user_delete = "DELETE FROM usuarios WHERE id_usuario = $id_usuario";
        $result_user_delete = mysqli_query($conn, $query_user_delete);

        if ($result_user_delete) echo json_encode(["icon" => "success", "msg" => "Usuario eliminado!"], JSON_UNESCAPED_UNICODE);
    }
}

mysqli_close($conn);
