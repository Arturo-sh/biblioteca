<?php
    session_start();
    require_once "../database.php";

    if (isset($_POST['btn_insert'])) {
        $usuario = htmlspecialchars(trim($_POST['usuario']), ENT_QUOTES, 'UTF-8');
        $contrasenia = htmlspecialchars(trim($_POST['contrasenia']), ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
        $telefono = htmlspecialchars(trim($_POST['telefono']), ENT_QUOTES, 'UTF-8');
        $correo = htmlspecialchars(trim($_POST['correo']), ENT_QUOTES, 'UTF-8');
        
        $contrasenia_segura = sha1($contrasenia);

        $query_user_insert = "INSERT INTO usuarios(id_usuario, usuario, contrasenia, nombre_usuario, telefono_usuario, correo_usuario) VALUES(NULL, '$usuario', '$contrasenia_segura', '$nombre', '$telefono', '$correo')";
        $result_user_insert = mysqli_query($conn, $query_user_insert);

        $error_msg = "Ha ocurrido un error al insertar el registro, intentelo de nuevo!";
        $_SESSION['user_insert'] = ["icon" => "error", "title" => $error_msg];

        if ($result_user_insert) {
            $_SESSION['user_insert'] = ["icon" => "success", "title" => "Usuario registrado!"];
        }
    }

    if (isset($_POST['btn_update'])) {
        $id_usuario = htmlspecialchars(trim($_POST['id_usuario']), ENT_QUOTES, 'UTF-8');
        $usuario = htmlspecialchars(trim($_POST['usuario']), ENT_QUOTES, 'UTF-8');
        $contrasenia = htmlspecialchars(trim($_POST['contrasenia']), ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
        $telefono = htmlspecialchars(trim($_POST['telefono']), ENT_QUOTES, 'UTF-8');
        $correo = htmlspecialchars(trim($_POST['correo']), ENT_QUOTES, 'UTF-8');
        $estatus = htmlspecialchars(trim($_POST['estatus']), ENT_QUOTES, 'UTF-8');
        
        if ($contrasenia == "") {
            $query_user_update = "UPDATE usuarios SET usuario = '$usuario', nombre_usuario = '$nombre', telefono_usuario = '$telefono', correo_usuario = '$correo', estado_usuario = '$estatus' WHERE id_usuario = $id_usuario";
        } else {
            $contrasenia_segura = sha1($contrasenia);
            $query_user_update = "UPDATE usuarios SET usuario = '$usuario', contrasenia = '$contrasenia_segura', nombre_usuario = '$nombre', telefono_usuario = '$telefono', correo_usuario = '$correo', estado_usuario = '$estatus' WHERE id_usuario = $id_usuario";
        }

        $result_user_update = mysqli_query($conn, $query_user_update);

        $error_msg = "Ha ocurrido un error al actualizar el registro, intentelo de nuevo!";
        $_SESSION['user_update'] = ["icon" => "error", "title" => $error_msg];

        if ($result_user_update) {
            $_SESSION['user_update'] = ["icon" => "success", "title" => "Datos del usuario actualizados!"];
        }
    }

    mysqli_close($conn);
    header("Location: ../../?module=usuarios");
?>