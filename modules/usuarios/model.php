<?php
session_start();
require_once "../database.php";

if ($_SESSION['rol_usuario'] == "Admin") {
    if (isset($_POST['btn_insert'])) {
        $rol_usuario = htmlspecialchars(trim($_POST['rol_usuario']), ENT_QUOTES, 'UTF-8');
        $usuario = htmlspecialchars(trim($_POST['usuario']), ENT_QUOTES, 'UTF-8');
        $contrasenia = htmlspecialchars(trim($_POST['contrasenia']), ENT_QUOTES, 'UTF-8');
        $nombre_usuario = htmlspecialchars(trim($_POST['nombre_usuario']), ENT_QUOTES, 'UTF-8');
        $telefono_usuario = htmlspecialchars(trim($_POST['telefono_usuario']), ENT_QUOTES, 'UTF-8');
        $correo_usuario = htmlspecialchars(trim($_POST['correo_usuario']), ENT_QUOTES, 'UTF-8');
        $contrasenia_segura = sha1($contrasenia);
        $_SESSION['user_insert'] = ["icon" => "error", "action" => "insertar"];

        $query_user_insert = "INSERT INTO usuarios(id_usuario, rol_usuario, usuario, contrasenia, nombre_usuario, telefono_usuario, correo_usuario) VALUES(NULL, '$rol_usuario', '$usuario', '$contrasenia_segura', '$nombre_usuario', '$telefono_usuario', '$correo_usuario')";
        $result_user_insert = mysqli_query($conn, $query_user_insert);

        if ($result_user_insert) {
            $_SESSION['user_insert'] = ["icon" => "success", "title" => "Nuevo usuario registrado!"];
        }
        
        header("Location: ../../index.php?module=usuarios");
    }

    if (isset($_POST['edit_id'])) {
        $id_usuario = $_POST['edit_id'];

        $query_user_data = "SELECT id_usuario, rol_usuario, usuario, nombre_usuario, telefono_usuario, correo_usuario, estado_usuario FROM usuarios WHERE id_usuario = $id_usuario";
        $user_data = mysqli_query($conn, $query_user_data);
        $row = mysqli_fetch_all($user_data, MYSQLI_ASSOC);

        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['btn_update'])) {
        $id_usuario = htmlspecialchars(trim($_POST['id_usuario']), ENT_QUOTES, 'UTF-8');
        $rol_usuario = isset($_POST['rol_usuario']) ? htmlspecialchars(trim($_POST['rol_usuario']), ENT_QUOTES, 'UTF-8') : "Admin";
        $usuario = htmlspecialchars(trim($_POST['usuario']), ENT_QUOTES, 'UTF-8');
        $contrasenia = htmlspecialchars(trim($_POST['contrasenia']), ENT_QUOTES, 'UTF-8');
        $nombre_usuario = htmlspecialchars(trim($_POST['nombre_usuario']), ENT_QUOTES, 'UTF-8');
        $telefono_usuario = htmlspecialchars(trim($_POST['telefono_usuario']), ENT_QUOTES, 'UTF-8');
        $correo_usuario = htmlspecialchars(trim($_POST['correo_usuario']), ENT_QUOTES, 'UTF-8');
        $estado_usuario = isset($_POST['estado_usuario']) ? htmlspecialchars(trim($_POST['estado_usuario']), ENT_QUOTES, 'UTF-8') : "Activo";
        $_SESSION['user_update'] = ["icon" => "error", "action" => "actualizar"];
        if ($_SESSION['id_usuario'] == $id_usuario) $_SESSION['nombre_usuario'] = $nombre_usuario;
        
        if ($contrasenia == "") {
            $query_user_update = "UPDATE usuarios SET rol_usuario = '$rol_usuario', usuario = '$usuario', nombre_usuario = '$nombre_usuario', telefono_usuario = '$telefono_usuario', correo_usuario = '$correo_usuario', estado_usuario = '$estado_usuario' WHERE id_usuario = $id_usuario";
        } else {
            $contrasenia_segura = sha1($contrasenia);
            $query_user_update = "UPDATE usuarios SET rol_usuario = '$rol_usuario', usuario = '$usuario', contrasenia = '$contrasenia_segura', nombre_usuario = '$nombre_usuario', telefono_usuario = '$telefono_usuario', correo_usuario = '$correo_usuario', estado_usuario = '$estado_usuario' WHERE id_usuario = $id_usuario";
        }

        $result_user_update = mysqli_query($conn, $query_user_update);
        
        if ($result_user_update) {
            $_SESSION['user_update'] = ["icon" => "success", "title" => "Datos del usuario actualizados!"];
        }
        
        header("Location: ../../index.php?module=usuarios");
    }

    if (isset($_POST['delete_id'])) {
        $id_usuario = $_POST['delete_id'];
        
        $user_deleted = ["icon" => "error", "title" => "Ha ocurridó un error, inténtelo de nuevo!"];
        
        $query_user_delete = "DELETE FROM usuarios WHERE id_usuario = $id_usuario";
        $result_user_delete = mysqli_query($conn, $query_user_delete);    

        if ($result_user_delete) {
            $user_deleted = ["icon" => "success", "title" => "Usuario eliminado!"];
        }

        echo json_encode($user_deleted);
    }
}

mysqli_close($conn);
?>